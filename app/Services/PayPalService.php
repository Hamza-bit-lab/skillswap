<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Plan;

class PayPalService
{
    private $baseUrl;
    private $clientId;
    private $secret;
    private $accessToken;

    public function __construct()
    {
        $this->baseUrl = config('services.paypal.mode') === 'live' 
            ? 'https://api-m.paypal.com' 
            : 'https://api-m.sandbox.paypal.com';
        $this->clientId = config('services.paypal.client_id');
        $this->secret = config('services.paypal.secret');
    }

    private function getAccessToken()
    {
        if ($this->accessToken) {
            return $this->accessToken;
        }

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Accept-Language' => 'en_US',
        ])->withBasicAuth($this->clientId, $this->secret)
        ->asForm()
        ->post($this->baseUrl . '/v1/oauth2/token', [
            'grant_type' => 'client_credentials'
        ]);

        if ($response->successful()) {
            $this->accessToken = $response->json('access_token');
            return $this->accessToken;
        }

        throw new \Exception('Failed to get PayPal access token');
    }

    public function createProduct($name, $description = null)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/v1/catalogs/products', [
            'name' => $name,
            'description' => $description ?? $name,
            'type' => 'SERVICE',
            'category' => 'SOFTWARE',
        ]);

        if ($response->successful()) {
            return $response->json('id');
        }

        throw new \Exception('Failed to create PayPal product');
    }

    public function createPlan($productId, $name, $price, $billingPeriod)
    {
        $billingCycle = $billingPeriod === 'yearly' ? 'YEAR' : 'MONTH';
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/v1/billing/plans', [
            'product_id' => $productId,
            'name' => $name,
            'description' => $name,
            'status' => 'ACTIVE',
            'billing_cycles' => [
                [
                    'frequency' => [
                        'interval_unit' => $billingCycle,
                        'interval_count' => 1
                    ],
                    'tenure_type' => 'REGULAR',
                    'sequence' => 1,
                    'total_cycles' => 0, // Unlimited
                    'pricing_scheme' => [
                        'fixed_price' => [
                            'value' => $price,
                            'currency_code' => config('services.paypal.currency', 'USD')
                        ]
                    ]
                ]
            ],
            'payment_preferences' => [
                'auto_bill_outstanding' => true,
                'setup_fee' => [
                    'value' => '0',
                    'currency_code' => config('services.paypal.currency', 'USD')
                ],
                'setup_fee_failure_action' => 'CONTINUE',
                'payment_failure_threshold' => 3
            ]
        ]);

        if ($response->successful()) {
            return $response->json('id');
        }

        throw new \Exception('Failed to create PayPal plan');
    }

    public function createSubscription($planId, $returnUrl, $cancelUrl)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/v1/billing/subscriptions', [
            'plan_id' => $planId,
            // PayPal expects ISO8601 string; Carbon provides toIso8601String
            'start_time' => now()->addMinutes(1)->toIso8601String(),
            'subscriber' => [
                'name' => [
                    'given_name' => auth()->user()->name ?? 'User',
                    'surname' => ''
                ],
                'email_address' => auth()->user()->email
            ],
            'application_context' => [
                'brand_name' => 'SkillSwap',
                'locale' => 'en-US',
                'shipping_preference' => 'NO_SHIPPING',
                'user_action' => 'SUBSCRIBE_NOW',
                'payment_method' => [
                    'payer_selected' => 'PAYPAL',
                    'payee_preferred' => 'IMMEDIATE_PAYMENT_REQUIRED'
                ],
                'return_url' => $returnUrl,
                'cancel_url' => $cancelUrl
            ]
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to create PayPal subscription');
    }

    public function getSubscription($subscriptionId)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
        ])->get($this->baseUrl . '/v1/billing/subscriptions/' . $subscriptionId);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to get PayPal subscription');
    }

    public function cancelSubscription($subscriptionId, $reason = 'User cancelled')
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/v1/billing/subscriptions/' . $subscriptionId . '/cancel', [
            'reason' => $reason
        ]);

        return $response->successful();
    }

    public function verifyWebhookSignature($headers, $body)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/v1/notifications/verify-webhook-signature', [
            'auth_algo' => $headers['PAYPAL-AUTH-ALGO'] ?? '',
            'cert_url' => $headers['PAYPAL-CERT-URL'] ?? '',
            'transmission_id' => $headers['PAYPAL-TRANSMISSION-ID'] ?? '',
            'transmission_sig' => $headers['PAYPAL-TRANSMISSION-SIG'] ?? '',
            'transmission_time' => $headers['PAYPAL-TRANSMISSION-TIME'] ?? '',
            'webhook_id' => config('services.paypal.webhook_id'),
            'webhook_event' => json_decode($body, true)
        ]);

        return $response->successful();
    }
}
