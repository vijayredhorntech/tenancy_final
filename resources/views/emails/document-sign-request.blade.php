<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document Signing Request</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eeeeee;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 15px;
        }
        .content {
            padding: 20px 0;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white !important;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 4px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eeeeee;
            font-size: 12px;
            color: #777777;
            text-align: center;
        }
        .signature {
            margin-top: 30px;
            font-style: italic;
            color: #555555;
        }
        .highlight {
            background-color: #f8f8f8;
            padding: 15px;
            border-left: 4px solid #4CAF50;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <!-- Replace with your logo -->
        <img src="https://via.placeholder.com/150x50?text=Your+Logo" alt="Company Logo" class="logo">
        <h2 style="color: #2c3e50;">Document Signature Required</h2>
    </div>

    <div class="content">
        <p>Dear {{ $clientName }},</p>

        <div class="highlight">
            <p>{{ $customMessage }}</p>
        </div>

        <p>We kindly request your signature on an important document. Please review and sign at your earliest convenience.</p>

        <div style="text-align: center; margin: 25px 0;">
            <a href="{{ $documentLink }}" class="button">SIGN DOCUMENT NOW</a>
        </div>

        <p>If the button above doesn't work, copy and paste this link into your browser:</p>
        <p style="word-break: break-all; font-size: 12px; color: #666666;">{{ $documentLink }}</p>

        <div class="signature">
            <p>Best regards,</p>
            <p><strong>Your Company Name Team</strong></p>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2023 Your Company Name. All rights reserved.</p>
        <p>
          
        </p>
        <p>If you received this email by mistake, please disregard it.</p>
    </div>
</body>
</html>