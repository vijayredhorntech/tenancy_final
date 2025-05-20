<!DOCTYPE html>
<html>
<head>
    <title>New Application Submission</title>
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
            color: white;
            font-size: 24px;
            margin: 0;
        }
        .content {
            padding: 30px;
        }
        .alert-badge {
            background-color: #ffeb3b;
            color: #333;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 15px;
        }
        .details-card {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 5px solid #4a6ee0;
        }
        .detail-row {
            margin-bottom: 10px;
            display: flex;
        }
        .detail-label {
            font-weight: bold;
            width: 150px;
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
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #7f8c8d;
            border-top: 1px solid #eee;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>New Application Received</h1>
        </div>
        
        <div class="content">
            <div class="alert-badge">ACTION REQUIRED</div>
            <p>Hello Super Admin,</p>
            <p>A new application has been submitted and requires your attention.</p>
            
            <div class="details-card">
                <h2 style="margin-top: 0; color: #4a6ee0;">Application Details</h2>
                
                <div class="detail-row">
                    <div class="detail-label">Booking ID:</div>
                    <div>{{ $deduction->invoice_number }}</div>
                </div>
              
                
                <div class="detail-row">
                    <div class="detail-label">Submission Date:</div>
                    <div>{{ now()->format('F j, Y H:i') }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Application Type:</div>
                    <div>New Visa Application </div>
                </div>
            </div>
            
            
            
            <p>Please process this application at your earliest convenience.</p>
            
            <p>Best regards,<br>
            <strong>System Notification</strong></p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>This is an automated notification - no reply needed.</p>
        </div>
    </div>
</body>
</html>