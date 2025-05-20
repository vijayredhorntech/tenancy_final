<!DOCTYPE html>
<html>
<head>
    <title>Document Verification Required</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f7fa;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .header {
            background-color: #10b981;
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
        .notification-badge {
            background-color: #d1fae5;
            color: #065f46;
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
            border-left: 4px solid #10b981;
        }
        .detail-row {
            margin-bottom: 10px;
            display: flex;
        }
        .detail-label {
            font-weight: bold;
            min-width: 120px;
            color: #64748b;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #10b981;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
            font-weight: bold;
            text-align: center;
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
            color: #10b981;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Document Verification Required</h1>
        </div>
        
        <div class="content">
            <div class="notification-badge">NEW DOCUMENTS SUBMITTED</div>
            <p>Dear <span class="highlight">Super Admin</span>,</p>
            
            <p>New documents have been uploaded for verification regarding the following application:</p>
            
            <div class="details-card">
                <div class="detail-row">
                    <div class="detail-label">Application Number:</div>
                    <div><strong>{{ $applicationNumber }}</strong></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Submission Time:</div>
                    <div>{{ now()->format('F j, Y \a\t H:i') }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Status:</div>
                    <div>Pending Verification</div>
                </div>
            </div>
            
            <p>Please review and verify the submitted documents at your earliest convenience.</p>
            
        
            
            <p>For security purposes, please verify all documents within <strong>48 hours</strong> of submission.</p>
            
            <p>Best regards,<br>
            <strong>System Notification</strong><br>
            {{ config('app.name') }}</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>This is an automated system notification. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>