<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flight Request Submitted</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#26ace2',
                        secondary: '#26ace2',
                        ternary: '#172432',
                        white: '#ffffff',
                        black: '#000000',
                        danger: '#ff0000',
                        success: '#28a745',
                        warning: '#ffcc00',
                    },
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Public Sans', serif; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="w-full min-h-screen bg-gray-50 py-6">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Success Message -->
            <div class="bg-white rounded-lg shadow-md p-8 text-center border-t-[4px] border-t-success">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-success/20 mb-6">
                    <i class="fa fa-check text-success text-2xl"></i>
                </div>
                
                <h1 class="text-3xl font-bold text-ternary mb-4">Thank You!</h1>
                <p class="text-lg text-gray-600 mb-6">
                    Your flight request has been submitted successfully. Our team will review your requirements and get back to you with the best flight options.
                </p>
                
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-6">
                    <h3 class="font-medium text-ternary mb-2">What happens next?</h3>
                    <ul class="text-sm text-gray-600 space-y-1 text-left">
                        <li class="flex items-center">
                            <i class="fa fa-clock text-primary mr-2"></i>
                            We'll review your request within 24 hours
                        </li>
                        <li class="flex items-center">
                            <i class="fa fa-envelope text-primary mr-2"></i>
                            You'll receive an email confirmation
                        </li>
                        <li class="flex items-center">
                            <i class="fa fa-phone text-primary mr-2"></i>
                            Our travel experts will contact you
                        </li>
                        <li class="flex items-center">
                            <i class="fa fa-plane text-primary mr-2"></i>
                            We'll provide customized flight options
                        </li>
                    </ul>
                </div>
                
                <div class="flex justify-center">
                    <a href="{{ route('agency.homepage', ['d' => request()->segment(1) ?: 'default']) }}"  
                       class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                        <i class="fa fa-home mr-2"></i>
                        Go to Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
