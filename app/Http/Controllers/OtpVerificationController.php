<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class OtpVerificationController extends Controller
{
    /**
     * Show the OTP verification page
     */
    public function showVerificationForm()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        if ($user->email_verified_at) {
            return redirect()->route('user.dashboard');
        }

        return view('auth.otp-verify');
    }

    /**
     * Send OTP to user's email
     */
    public function sendOtp(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        if ($user->email_verified_at) {
            return redirect()->route('user.dashboard');
        }

        // Generate 4-digit OTP
        $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        
        // Store OTP in session with expiration (10 minutes)
        Session::put('otp', [
            'code' => $otp,
            'expires_at' => now()->addMinutes(10),
            'attempts' => 0
        ]);

        // Send OTP email
        try {
            Mail::send('emails.otp', ['otp' => $otp, 'user' => $user], function ($message) use ($user) {
                $message->to($user->email, $user->name)
                        ->subject('Verify Your SkillSwap Account - OTP Code');
            });

            return back()->with('success', 'OTP sent to your email address!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to send OTP. Please try again.']);
        }
    }

    /**
     * Verify OTP and mark email as verified
     */
    public function verifyOtp(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        if ($user->email_verified_at) {
            return redirect()->route('user.dashboard');
        }

        $request->validate([
            'otp' => 'required|string|size:4|regex:/^[0-9]+$/',
        ], [
            'otp.required' => 'Please enter the OTP code.',
            'otp.size' => 'OTP must be 4 digits.',
            'otp.regex' => 'OTP must contain only numbers.',
        ]);

        $storedOtp = Session::get('otp');

        if (!$storedOtp) {
            return back()->withErrors(['error' => 'OTP expired. Please request a new one.']);
        }

        if (now()->isAfter($storedOtp['expires_at'])) {
            Session::forget('otp');
            return back()->withErrors(['error' => 'OTP expired. Please request a new one.']);
        }

        if ($storedOtp['attempts'] >= 3) {
            Session::forget('otp');
            return back()->withErrors(['error' => 'Too many failed attempts. Please request a new OTP.']);
        }

        if ($request->otp !== $storedOtp['code']) {
            $storedOtp['attempts']++;
            Session::put('otp', $storedOtp);
            
            $remainingAttempts = 3 - $storedOtp['attempts'];
            return back()->withErrors(['error' => "Invalid OTP. {$remainingAttempts} attempts remaining."]);
        }

        // OTP is valid - mark email as verified
        $user->email_verified_at = now();
        $user->save();

        // Clear OTP from session
        Session::forget('otp');

        // Log the successful verification
        \Log::info('Email verified successfully for user: ' . $user->email);

        return redirect()->route('user.dashboard')->with('success', 'Email verified successfully! Welcome to SkillSwap!');
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request)
    {
        return $this->sendOtp($request);
    }
}
