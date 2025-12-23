<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code</title>
    <style>
        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f7f5f0;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #5325c7;
            margin-bottom: 10px;
        }
        .title {
            font-size: 24px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 20px;
        }
        .content {
            color: #6b7280;
            font-size: 16px;
            margin-bottom: 30px;
        }
        .otp-box {
            background-color: #ede9fe;
            border: 2px solid #5325c7;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-code {
            font-size: 32px;
            font-weight: 700;
            color: #5325c7;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e4dfd6;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        .warning {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 12px 16px;
            margin: 20px 0;
            border-radius: 6px;
            font-size: 14px;
            color: #92400e;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">SolarReviews India</div>
        </div>
        
        <h1 class="title">Your Verification Code</h1>
        
        <div class="content">
            <p>Hello,</p>
            <p>You requested a verification code to login to your SolarReviews account. Use the code below to complete your login:</p>
        </div>
        
        <div class="otp-box">
            <div class="otp-code">{{ $otp }}</div>
        </div>
        
        <div class="content">
            <p>This code will expire in <strong>10 minutes</strong>.</p>
            <p>If you didn't request this code, please ignore this email.</p>
        </div>
        
        <div class="warning">
            <strong>Security Tip:</strong> Never share this code with anyone. SolarReviews will never ask for your verification code.
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} SolarReviews India. All rights reserved.</p>
            <p>This is an automated email, please do not reply.</p>
        </div>
    </div>
</body>
</html>

