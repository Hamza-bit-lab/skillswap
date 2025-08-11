<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Transaction;
use App\Services\PayPalService;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $paypalService;

    public function __construct(PayPalService $paypalService)
    {
        $this->paypalService = $paypalService;
    }

    public function initiatePayment(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        $plan = Plan::findOrFail($request->plan_id);
        $user = auth()->user();

        Log::info('Payment initiation started', [
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'plan_name' => $plan->name,
            'amount' => $plan->price
        ]);

        try {
            // Create or get PayPal product and plan
            if (!$plan->paypal_product_id) {
                $productId = $this->paypalService->createProduct($plan->name);
                $plan->paypal_product_id = $productId;
                $plan->save();
            }

            if (!$plan->paypal_plan_id) {
                $planId = $this->paypalService->createPlan(
                    $plan->paypal_product_id,
                    $plan->name,
                    $plan->price,
                    $plan->billing_period
                );
                $plan->paypal_plan_id = $planId;
                $plan->save();
            }

            // Create transaction record
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'amount' => $plan->price,
                'currency' => config('services.paypal.currency', 'USD'),
                'status' => 'pending',
                'payment_type' => 'subscription',
                'billing_period' => $plan->billing_period,
            ]);

            // Create PayPal subscription
            $returnUrl = route('payment.success', ['transaction_id' => $transaction->id]);
            $cancelUrl = route('payment.cancel', ['transaction_id' => $transaction->id]);

            $subscription = $this->paypalService->createSubscription(
                $plan->paypal_plan_id,
                $returnUrl,
                $cancelUrl
            );

            // Update transaction with PayPal subscription ID
            $transaction->update([
                'paypal_subscription_id' => $subscription['id'],
                'paypal_response' => $subscription
            ]);

            Log::info('PayPal subscription created', [
                'transaction_id' => $transaction->id,
                'subscription_id' => $subscription['id']
            ]);

            // Redirect to PayPal
            $approvalUrl = null;
            if (isset($subscription['links']) && is_array($subscription['links'])) {
                foreach ($subscription['links'] as $link) {
                    if (($link['rel'] ?? '') === 'approve' && !empty($link['href'])) {
                        $approvalUrl = $link['href'];
                        break;
                    }
                }
            }

            if ($approvalUrl) {
                return redirect()->away($approvalUrl);
            }

            throw new \Exception('PayPal approval URL not found');

        } catch (\Exception $e) {
            Log::error('Payment initiation failed', [
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('price')->with('error', 'Payment initiation failed. Please try again.');
        }
    }

    public function success(Request $request)
    {
        $transaction = Transaction::findOrFail($request->transaction_id);
        
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        try {
            // Get subscription details from PayPal
            $subscription = $this->paypalService->getSubscription($transaction->paypal_subscription_id);
            
            // Update transaction
            $transaction->update([
                'status' => 'completed',
                'paid_at' => now(),
                'paypal_response' => $subscription
            ]);

            // Update user subscription
            $user = auth()->user();
            // Per request: mark users.plan as 'premium' regardless of plan name
            $planName = 'premium';
            $user->update([
                'is_pro' => true,
                'plan' => $planName,
                'paypal_subscription_id' => $transaction->paypal_subscription_id,
                'subscription_status' => 'active',
                'subscribed_at' => now(),
                'current_period_end' => $this->calculatePeriodEnd($transaction->billing_period)
            ]);

            return redirect()->route('user.dashboard')->with('success', 'Payment successful! Your subscription is now active.');

        } catch (\Exception $e) {
            Log::error('Payment success processing failed', [
                'transaction_id' => $transaction->id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('dashboard')->with('error', 'Payment verification failed. Please contact support.');
        }
    }

    public function cancel(Request $request)
    {
        $transaction = Transaction::findOrFail($request->transaction_id);
        
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $transaction->update(['status' => 'cancelled']);

        return redirect()->route('price')->with('info', 'Payment was cancelled.');
    }

    public function webhook(Request $request)
    {
        $headers = $request->headers->all();
        $body = $request->getContent();

        // Verify webhook signature
        if (!$this->paypalService->verifyWebhookSignature($headers, $body)) {
            Log::warning('PayPal webhook signature verification failed');
            return response('Unauthorized', 401);
        }

        $event = $request->all();
        $eventType = $event['event_type'] ?? '';

        Log::info('PayPal webhook received', ['event_type' => $eventType]);

        try {
            switch ($eventType) {
                case 'BILLING.SUBSCRIPTION.CREATED':
                    $this->handleSubscriptionCreated($event);
                    break;
                case 'BILLING.SUBSCRIPTION.ACTIVATED':
                    $this->handleSubscriptionActivated($event);
                    break;
                case 'BILLING.SUBSCRIPTION.CANCELLED':
                    $this->handleSubscriptionCancelled($event);
                    break;
                case 'BILLING.SUBSCRIPTION.EXPIRED':
                    $this->handleSubscriptionExpired($event);
                    break;
                case 'PAYMENT.SALE.COMPLETED':
                    $this->handlePaymentCompleted($event);
                    break;
                default:
                    Log::info('Unhandled PayPal webhook event', ['event_type' => $eventType]);
            }

            return response('OK', 200);

        } catch (\Exception $e) {
            Log::error('PayPal webhook processing failed', [
                'event_type' => $eventType,
                'error' => $e->getMessage()
            ]);

            return response('Internal Server Error', 500);
        }
    }

    private function handleSubscriptionCreated($event)
    {
        $subscriptionId = $event['resource']['id'] ?? null;
        if (!$subscriptionId) return;

        $transaction = Transaction::where('paypal_subscription_id', $subscriptionId)->first();
        if ($transaction) {
            $transaction->update(['status' => 'completed']);
            
            $user = $transaction->user;
            $user->update([
                'is_pro' => true,
                'plan' => 'premium',
                'paypal_subscription_id' => $subscriptionId,
                'subscription_status' => 'active',
                'subscribed_at' => now(),
                'current_period_end' => $this->calculatePeriodEnd($transaction->billing_period)
            ]);
            
            Log::info('User subscription created via webhook', [
                'user_id' => $user->id,
                'subscription_id' => $subscriptionId
            ]);
        }
    }

    private function handleSubscriptionActivated($event)
    {
        $subscriptionId = $event['resource']['id'] ?? null;
        if (!$subscriptionId) return;

        $transaction = Transaction::where('paypal_subscription_id', $subscriptionId)->first();
        if ($transaction) {
            $transaction->update(['status' => 'completed']);
            
            $user = $transaction->user;
            $user->update([
                'is_pro' => true,
                'plan' => 'premium',
                'paypal_subscription_id' => $subscriptionId,
                'subscription_status' => 'active',
                'subscribed_at' => now(),
                'current_period_end' => $this->calculatePeriodEnd($transaction->billing_period)
            ]);
            
            Log::info('User subscription activated via webhook', [
                'user_id' => $user->id,
                'subscription_id' => $subscriptionId
            ]);
        }
    }

    private function handleSubscriptionCancelled($event)
    {
        $subscriptionId = $event['resource']['id'] ?? null;
        if (!$subscriptionId) return;

        $user = \App\Models\User::where('paypal_subscription_id', $subscriptionId)->first();
        if ($user) {
            $user->update([
                'subscription_status' => 'cancelled',
                'is_pro' => false
            ]);
        }
    }

    private function handleSubscriptionExpired($event)
    {
        $subscriptionId = $event['resource']['id'] ?? null;
        if (!$subscriptionId) return;

        $user = \App\Models\User::where('paypal_subscription_id', $subscriptionId)->first();
        if ($user) {
            $user->update([
                'subscription_status' => 'expired',
                'is_pro' => false
            ]);
        }
    }

    private function handlePaymentCompleted($event)
    {
        $paymentId = $event['resource']['id'] ?? null;
        if (!$paymentId) return;

        $transaction = Transaction::where('paypal_payment_id', $paymentId)->first();
        if ($transaction) {
            $transaction->update([
                'status' => 'completed',
                'paid_at' => now()
            ]);
        }
    }

    private function calculatePeriodEnd($billingPeriod)
    {
        return $billingPeriod === 'yearly' 
            ? now()->addYear() 
            : now()->addMonth();
    }
}
