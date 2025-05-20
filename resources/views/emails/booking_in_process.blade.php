<!DOCTYPE html>
<html>
<head>
    <title>Application Under Process</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #444;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f7fa;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background-color: #4a6ee0;
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
        .status-card {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
            border-left: 5px solid #4a6ee0;
        }
        .status-icon {
            font-size: 40px;
            color: #4a6ee0;
            margin-bottom: 15px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #7f8c8d;
            border-top: 1px solid #eee;
            background-color: #f9f9f9;
        }
        .highlight {
            color: #4a6ee0;
            font-weight: bold;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #4a6ee0;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 15px 0;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1 style="color: white; margin: 0;">Application Under Process</h1>
        </div>
        
        <div class="content">
            <p>Dear <span class="highlight">{{ $client->client->client_name ?? 'Valued Customer' }}</span>,</p>
            
            <p>Thank you for submitting your application with us. We're pleased to inform you that your application is currently being processed by our team.</p>
            
            <div class="status-card">
                <div class="status-icon">⏳</div>
                <h3>Application Status: In Process</h3>
                <p>Our team is carefully reviewing your submission and will connect with you soon regarding the next steps.</p>
            </div>
            
            <p>Here's what you can expect next:</p>
            <ul>
                <li>Our team will review all submitted documents</li>
                <li>We may contact you if additional information is required</li>
                <li>You'll receive notification once processing is complete</li>
            </ul>
            
            <p>Should you have any questions in the meantime, please don't hesitate to contact us.</p>
            
            <p>Best regards,</p>
            <p><strong>The {{ $agency->name ?? 'Our' }} Team</strong></p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ $agency->name ?? 'Our Company' }}. All rights reserved.</p>
            <p>{{ $agency->address ?? 'Company Address' }}</p>
            <p>This is an automated notification - please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html>