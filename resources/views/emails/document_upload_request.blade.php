<!DOCTYPE html>
<html>
<head>
    <title>Document Upload Request</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #444444;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f7f9fc;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .header {
            background-color: #4f46e5;
            padding: 25px;
            text-align: center;
        }
        .header h1 {
            color: white;
            margin: 0;
            font-size: 22px;
        }
        .content {
            padding: 30px;
        }
        .alert-badge {
            background-color: #fef3c7;
            color: #92400e;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .details-card {
            background-color: #f8fafc;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #4f46e5;
        }
        .detail-row {
            margin-bottom: 8px;
        }
        .detail-label {
            font-weight: bold;
            color: #64748b;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #4f46e5;
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
        }
        .highlight {
            color: #4f46e5;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Document Upload Required</h1>
        </div>
        
        <div class="content">
            <div class="alert-badge">ACTION REQUIRED</div>
            <p>Dear <span class="highlight">{{ $agencyName }}</span>,</p>
            
            <p>We require additional documents to process the following application:</p>
            
            <div class="details-card">
                <div class="detail-row">
                    <span class="detail-label">Invoice Number:</span>
                    <strong>{{ $invoiceNumber }}</strong>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Request Date:</span>
                    {{ now()->format('F j, Y') }}
                </div>
            </div>
            
            <p>Please log in to the admin portal and upload the required documents at your earliest convenience.</p>
            
            
            
            <p>If you have any questions about which documents are needed, please contact our support team.</p>
            
            <p>Thank you for your prompt attention to this matter.</p>
            
            <p>Best regards,<br>
            <strong>The {{ $agencyName }} Team</strong></p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ $agencyName }}. All rights reserved.</p>
            <p>This is an automated notification - please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html>