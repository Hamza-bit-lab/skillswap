<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange Proposal Status</title>
    <style>
        body { font-family: 'Inter', Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f8f9fa; }
        .container { max-width: 600px; margin: 0 auto; background-color: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #4B9CD3, #3a7bb3); color: white; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 2rem; font-weight: 700; }
        .header p { margin: 10px 0 0 0; opacity: 0.9; }
        .content { padding: 40px 30px; }
        .status-box { background: #f8f9fa; border: 2px solid #e9ecef; border-radius: 10px; padding: 20px; margin: 30px 0; text-align: center; }
        .status-accepted { color: #3a7bb3; font-weight: bold; }
        .status-rejected { color: #dc3545; font-weight: bold; }
        .btn { display: inline-block; background: #4B9CD3; color: white; padding: 12px 30px; text-decoration: none; border-radius: 25px; font-weight: 600; margin: 20px 0; }
        .btn:hover { background: #3a7bb3; }
        .footer { background: #f8f9fa; padding: 20px 30px; text-align: center; color: #6c757d; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fa fa-exchange"></i> SkillSwap</h1>
            <p>Exchange Proposal {{ ucfirst($status) }}</p>
        </div>
        <div class="content">
            <h2>Hello {{ $user->name }}!</h2>
            <div class="status-box">
                @if($status === 'accepted')
                    <span class="status-accepted">Your exchange proposal was accepted by {{ $participantName }}!</span>
                @else
                    <span class="status-rejected">Your exchange proposal was rejected by {{ $participantName }}.</span>
                @endif
            </div>
            <p><strong>Proposal Title:</strong> {{ $exchange->title }}</p>
            <a href="{{ $actionUrl }}" class="btn">View Exchange</a>
            <p>If you have any questions or need assistance, feel free to reach out to our support team.</p>
            <p>Best regards,<br><strong>The SkillSwap Team</strong></p>
        </div>
        <div class="footer">
            <p>&copy; 2024 SkillSwap. All rights reserved.</p>
            <p>This email was sent to {{ $user->email }}. If you didn't request this, please ignore this email.</p>
        </div>
    </div>
</body>
</html>