<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test SMTP email configuration by sending a test email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Please provide a valid email address.');
            return 1;
        }

        $this->info('Testing SMTP configuration...');
        $this->info('Sending test email to: ' . $email);

        try {
            // Generate a test OTP
            $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            
            // Create a test user object
            $user = (object) [
                'name' => 'Test User',
                'email' => $email
            ];

            // Send test email
            Mail::send('emails.otp', ['otp' => $otp, 'user' => $user], function ($message) use ($email) {
                $message->to($email, 'Test User')
                        ->subject('SkillSwap - Test Email (OTP: ' . $otp . ')');
            });

            $this->info('✅ Test email sent successfully!');
            $this->info('📧 Check your email for the test message.');
            $this->info('🔢 Test OTP Code: ' . $otp);
            
            return 0;

        } catch (\Exception $e) {
            $this->error('❌ Failed to send email: ' . $e->getMessage());
            $this->error('Please check your SMTP configuration in .env file.');
            
            return 1;
        }
    }
}
