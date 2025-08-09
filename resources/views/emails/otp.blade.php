<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your SkillSwap Account</title>
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #4B9CD3, #3a7bb3);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
        }
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
        }
        .otp-container {
            text-align: center;
            margin: 30px 0;
        }
        .otp-code {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            display: inline-block;
        }
        .otp-digits {
            font-size: 2.5rem;
            font-weight: 700;
            color: #3a7bb3;
            letter-spacing: 10px;
            font-family: 'Courier New', monospace;
        }
        .info-box {
            background: #e9f3fb;
            border-left: 4px solid #4B9CD3;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .info-box h3 {
            margin: 0 0 10px 0;
            color: #3a7bb3;
            font-size: 1.1rem;
        }
        .info-box p {
            margin: 0;
            color: #495057;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
        }
        .btn {
            display: inline-block;
            background: #4B9CD3;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            margin: 20px 0;
        }
        .btn:hover { background: #3a7bb3; }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
            color: #856404;
        }
        .warning strong {
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fa fa-exchange"></i> SkillSwap</h1>
            <p>Verify Your Email Address</p>
        </div>
        
        <div class="content">
            <h2>Hello {{ $user->name }}!</h2>
            
            <p>Thank you for joining SkillSwap! To complete your registration and start exchanging skills with other professionals, please verify your email address.</p>
            
            <div class="otp-container">
                <h3>Your Verification Code</h3>
                <div class="otp-code">
                    <div class="otp-digits">{{ $otp }}</div>
                </div>
                <p><strong>Enter this 4-digit code on the verification page</strong></p>
            </div>
            
            <div class="info-box">
                <h3><i class="fa fa-info-circle"></i> What happens next?</h3>
                <p>After verifying your email, you'll have full access to SkillSwap where you can:</p>
                <ul>
                    <li>Browse and connect with other professionals</li>
                    <li>Create skill exchange proposals</li>
                    <li>Build your professional network</li>
                    <li>Grow your career through skill collaboration</li>
                </ul>
            </div>
            
            <div class="warning">
                <strong>Security Notice:</strong> This code will expire in 10 minutes for your security. If you didn't request this verification, please ignore this email.
            </div>
            
            <p>If you have any questions or need assistance, feel free to reach out to our support team.</p>
            
            <p>Best regards,<br>
            <strong>The SkillSwap Team</strong></p>
        </div>
        
        <div class="footer">
            <p>&copy; 2024 SkillSwap. All rights reserved.</p>
            <p>This email was sent to {{ $user->email }}. If you didn't create a SkillSwap account, please ignore this email.</p>
        </div>
    </div>
</body>
</html> 