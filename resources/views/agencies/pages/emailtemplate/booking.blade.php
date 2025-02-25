<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f0f8ff;
        }
        .header {
            background-color: #2196F3;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 5px;
        }
        .logo {
            width: 60px;
            height: 60px;
        }
        .company-name {
            font-size: 28px;
            font-weight: bold;
            margin: 0;
        }
        .agency-name {
            font-size: 20px;
            margin: 5px 0;
            font-style: italic;
        }
        .content {
            padding: 20px;
            background: #ffffff;
            background-image: repeating-linear-gradient(45deg, 
                rgba(33, 150, 243, 0.03) 0px, 
                rgba(33, 150, 243, 0.03) 2px,
                transparent 2px, 
                transparent 10px);
            border-radius: 5px;
            margin-top: 20px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .content::before {
            content: 'Cloud Travels';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 60px;
            color: rgba(33, 150, 243, 0.08);
            white-space: nowrap;
            pointer-events: none;
            font-weight: bold;
            z-index: 0;
        }
        .booking-details {
            background: white;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            position: relative;
            z-index: 1;
            border: 1px solid rgba(33, 150, 243, 0.1);
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
        h2, p {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-container">
        @if(!empty($agency->profile_picture))
            <img src="{{ config('app.DOMAIN') . '/images/agencies/logo/' . $agency->profile_picture }}" alt="Cloud Travel" class="h-24 mr-4" />
        @else
            <img src="{{ config('app.DOMAIN') . '/images/agencies/logo/default.png' }}" alt="Cloud Travel" class="h-24 mr-4" />
        @endif

            <!-- <svg class="logo" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"> -->
                <!-- Globe design -->
                <circle cx="50" cy="50" r="40" fill="none" stroke="white" stroke-width="2"/>
                <ellipse cx="50" cy="50" rx="40" ry="15" fill="none" stroke="white" stroke-width="2"/>
                <line x1="10" y1="50" x2="90" y2="50" stroke="white" stroke-width="2"/>
                <line x1="50" y1="10" x2="50" y2="90" stroke="white" stroke-width="2"/>
                <path d="M 30 30 Q 50 0 70 30" fill="none" stroke="white" stroke-width="2"/>
            </svg>
          
        </div>
        <div class="agency-name"></div>
        <h1>Booking Confirmation</h1>
    </div>
    
    <div class="content">
        <h2>Dear {{ $booking->user->name }},</h2>
        
        <p>Thank you for your booking! Here are your booking details:</p>
        
        <div class="booking-details">
            <h3>Booking Information</h3>
            <p><strong>Booking Number:</strong> {{ $booking->booking_number }}</p>
           
        
        </div>
        
        <p>If you need to modify or cancel your booking, please contact us at least 24 hours before your scheduled time.</p>
        
        <p>For any questions or concerns, please don't hesitate to reach out to our support team.</p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</body>
</html>