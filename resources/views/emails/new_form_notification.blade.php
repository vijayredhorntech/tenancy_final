<!DOCTYPE html>
<html>
<head>
    <title>New Visa Form Added</title>
    <style>
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 0;
            background-color: #f5f7fa;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin: 20px auto;
        }
        .header {
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .content {
            padding: 30px;
        }
        .form-card {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
            border-left: 5px solid #4361ee;
        }
        .detail-row {
            display: flex;
            margin-bottom: 12px;
            align-items: flex-start;
        }
        .detail-label {
            font-weight: 600;
            color: #3a0ca3;
            min-width: 150px;
        }
        .detail-value {
            color: #495057;
            flex-grow: 1;
        }
        .flag-icon {
            width: 20px;
            height: 15px;
            margin-right: 8px;
            vertical-align: middle;
            border: 1px solid #ddd;
        }
        .download-btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            color: white !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            margin: 20px 0;
            text-align: center;
            transition: all 0.3s ease;
        }
        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: #6c757d;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>New Visa Form Available</h1>
        </div>
        
        <div class="content">
            <p>Dear User,</p>
            
            <p>We're pleased to announce a new visa application form has been added to our system for your convenience:</p>
            
            <div class="form-card">
                <div class="detail-row">
                    <span class="detail-label">Form Name:</span>
                    <span class="detail-value">{{ $formName }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Description:</span>
                    <span class="detail-value">{{ $formDescription }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Origin Country:</span>
                    <span class="detail-value">
                      
                        {{ $originCountry }}
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Destination Country:</span>
                    <span class="detail-value">
                     
                        {{ $destinationCountry }}
                    </span>
                </div>
            </div>
            
        
            
            <p>Please use this updated form for all new applications to ensure smooth processing. The form includes all current requirements and regulations.</p>
            
            <p>Should you need any assistance with the new form, our support team is available to help.</p>
            
            <p>Best regards,<br>
            <strong>Visa Processing Team</strong></p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Visa Services. All rights reserved.</p>
            <p>This is an automated notification. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>