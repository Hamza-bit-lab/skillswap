# SMTP Email Configuration for SkillSwap

## Overview
SkillSwap uses a 4-digit OTP (One-Time Password) system for email verification. This system sends verification codes via email using SMTP.

## Current Configuration
The application is currently configured to use the 'log' mailer, which means emails are logged to the Laravel log file instead of being sent. This is perfect for development and testing.

## Setting Up SMTP for Production

### 1. Create .env File
Create a `.env` file in your project root with the following email configuration:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="SkillSwap"
```

### 2. Gmail SMTP Setup
If using Gmail:

1. Enable 2-Factor Authentication on your Google account
2. Generate an App Password:
   - Go to Google Account settings
   - Security → 2-Step Verification → App passwords
   - Generate a new app password for "Mail"
   - Use this password in your .env file

### 3. Other SMTP Providers
You can use any SMTP provider. Common configurations:

**Outlook/Hotmail:**
```env
MAIL_HOST=smtp-mail.outlook.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
```

**Yahoo:**
```env
MAIL_HOST=smtp.mail.yahoo.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
```

**Custom SMTP Server:**
```env
MAIL_HOST=your-smtp-server.com
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

## Testing Email Configuration

### 1. Test with Log Driver (Current)
Emails are logged to `storage/logs/laravel.log`. Check this file to see the OTP codes.

### 2. Test with Real SMTP
After setting up SMTP, you can test by:
1. Registering a new user
2. Checking the verification page
3. Requesting an OTP
4. Checking your email for the verification code

## OTP System Features

- **4-digit numeric codes**
- **10-minute expiration**
- **3 attempt limit**
- **Automatic resend functionality**
- **Beautiful email template**
- **Responsive verification page**

## Email Template
The OTP emails use a custom template located at `resources/views/emails/otp.blade.php` with:
- SkillSwap branding
- Clear 4-digit code display
- Security information
- Professional styling

## Security Features
- OTP codes expire after 10 minutes
- Maximum 3 failed attempts before requiring new OTP
- Session-based storage with automatic cleanup
- Input validation and sanitization

## Troubleshooting

### Emails not sending
1. Check your SMTP credentials
2. Verify your email provider allows SMTP
3. Check Laravel logs for errors
4. Ensure your .env file is properly configured

### OTP not working
1. Check if OTP is being generated (check logs)
2. Verify session storage is working
3. Check if user is properly authenticated

### Verification page not loading
1. Ensure user is logged in
2. Check if email_verified_at is null
3. Verify routes are properly registered 