<!DOCTYPE html>
<html>
<head>
    <title>{{ $data['subject'] }}</title>
    <style type="text/css">
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .email-container {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }
        .email-header {
            background-color: #3f51b5;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .email-body {
            padding: 30px;
            background-color: #ffffff;
        }
        .email-footer {
            background-color: #f5f5f5;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #777777;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 15px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3f51b5;
            color: white !important;
            text-decoration: none;
            border-radius: 4px;
            margin: 15px 0;
        }
        .signature {
            margin-top: 30px;
            border-top: 1px solid #eeeeee;
            padding-top: 20px;
        }
        .content-block {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <!-- Replace with your logo -->
            <!-- <img src="https://yourcompany.com/logo.png" alt="Company Logo" class="logo"> -->
            <h1>{{ $data['subject'] }}</h1>
        </div>
        
        <div class="email-body">
            <div class="content-block">
                {!! $data['message'] !!}
            </div>
            
      
            
            <div class="signature">
                <p>Best regards,</p>
                <p><strong>The {{$agency->name}} Team</strong></p>
            </div>
        </div>
        
        <div class="email-footer">
            <p>&copy; {{ date('Y') }}.  {{$agency->name}} All rights reserved.</p>
            <p>
                <a href="{{ config('app.url') }}" style="color: #3f51b5;">Visit our website</a> | 
                <a href="#" style="color: #3f51b5;">Privacy Policy</a>
            </p>
        </div>
    </div>
</body>
</html>