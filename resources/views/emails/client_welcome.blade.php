<!DOCTYPE html>
<html>
<head>
    <title>Your Account Has Been Created</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #444;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .header {
            background-color: #2c3e50;
            padding: 30px 20px;
            text-align: center;
            color: white;
        }
        h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .content {
            padding: 30px;
        }
        .account-details {
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
            padding: 15px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #7f8c8d;
            border-top: 1px solid #eee;
        }
        .highlight {
            color: #3498db;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1 style="color: white; margin: 0;">Your Account Is Ready</h1>
        </div>
        
        <div class="content">
            <p>Dear <span class="highlight">{{ $client->name }}</span>,</p>
            
            <p>We're pleased to inform you that <strong>{{ $agency->name }}</strong> has successfully created your account in our system. This account has been specially configured to meet your needs.</p>
            
            <div class="account-details">
                <p><strong>Account Details:</strong></p>
                <p>• Client Name: {{ $client->name }}</p>
                <p>• Created On: {{ now()->format('F j, Y') }}</p>
                <p>• Managed By: {{ $agency->name }}</p>
            </div>
            
            <p>This email serves as confirmation that your account is now active in our records. There's no action required on your part at this time.</p>
            
            <p>Our team at {{ $agency->name }} will be managing all aspects of your account, ensuring you receive the best possible service.</p>
            
            <p>Should you have any questions about your account or need additional information, please don't hesitate to contact our support team.</p>
            
            <p>Warm regards,</p>
            <p><strong>The {{ $agency->name }} Team</strong></p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ $agency->name }}. All rights reserved.</p>
            <p>This is an automated notification - please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>