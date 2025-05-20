<!DOCTYPE html>
<html>
<head>
    <title>Document Downloaded Notification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8fafc;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .header {
            background-color: #3b82f6;
            padding: 25px;
            text-align: center;
            color: white;
        }
        h1 {
            margin: 0;
            font-size: 22px;
        }
        .content {
            padding: 30px;
        }
        .confirmation-badge {
            background-color: #dbeafe;
            color: #1e40af;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .details-card {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #3b82f6;
        }
        .detail-row {
            margin-bottom: 12px;
            display: flex;
        }
        .detail-label {
            font-weight: bold;
            min-width: 160px;
            color: #64748b;
        }
        .status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: bold;
            background-color: #e0f2fe;
            color: #0369a1;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            background-color: #f9fafb;
        }
        .highlight {
            color: #3b82f6;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Documents Downloaded Successfully</h1>
        </div>
        
        <div class="content">
            <div class="confirmation-badge">DOCUMENTS RECEIVED</div>
            <p>Dear <span class="highlight">{{ $booking->agency->name }}</span>,</p>
            
            <p>We confirm that your documents for the following visa application have been successfully downloaded:</p>
            
            <div class="details-card">
                <div class="detail-row">
                    <div class="detail-label">Invoice Number:</div>
                    <div><strong>{{ $booking->application_number }}</strong></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Current Status:</div>
                    <div><span class="status">{{ ucfirst($booking->applicationworkin_status) }}</span></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Download Time:</div>
                    <div>{{ now()->format('F j, Y \a\t H:i') }}</div>
                </div>
            </div>
            
            <p>The application is now under review by our processing team. You'll be notified of any updates or if additional documents are required.</p>
            
            <p>For your reference, here's what happens next:</p>
            <ul style="margin-top: 0; padding-left: 20px;">
                <li>Document verification by our team</li>
                <li>Processing of your application</li>
                <li>Notification of approval or any additional requirements</li>
            </ul>
            
            <p>Thank you for choosing our services. We appreciate your trust in us.</p>
            
            <p>Best regards,<br>
            <strong>The Processing Team</strong></p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>This is an automated notification. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>