<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flight Search Results</title>
    
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
    <!-- Navigation Header -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ url()->previous() }}" class="text-gray-500 hover:text-gray-700">
                        <i class="fa fa-arrow-left text-xl"></i>
                    </a>
                    <h1 class="ml-4 text-xl font-semibold text-ternary">Flight Search Results</h1>
                </div>
            </div>
        </div>
    </nav>

    <div class="w-full min-h-screen bg-gray-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Comprehensive Flight & Passenger Information -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6 border-t-[4px] border-t-primary">
                <h2 class="text-xl font-semibold text-ternary mb-6">Flight & Passenger Information</h2>
                
                <!-- Flight Details Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-ternary mb-4 text-primary">Flight Details</h3>
                    
                    <!-- Route Information -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center space-x-4">
                                <div class="text-center">
                                    <i class="fa fa-plane-departure text-2xl text-primary mb-2"></i>
                                    <p class="text-sm text-gray-600">Departure</p>
                                    <p class="font-semibold text-ternary">{{ $flightSearch['route'][0]['origin'] ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-500">{{ $flightSearch['route'][0]['deptime'] ?? 'N/A' }}</p>
                                </div>
                                
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-0.5 bg-primary"></div>
                                    <i class="fa fa-plane text-primary"></i>
                                    <div class="w-8 h-0.5 bg-primary"></div>
                                </div>
                                
                                <div class="text-center">
                                    <i class="fa fa-plane-arrival text-2xl text-secondary mb-2"></i>
                                    <p class="text-sm text-gray-600">Arrival</p>
                                    <p class="font-semibold text-ternary">{{ $flightSearch['route'][0]['destination'] ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-500">{{ $flightSearch['route'][0]['deptime'] ?? 'N/A' }}</p>
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <p class="text-sm text-gray-600">Travel Class</p>
                                <p class="font-semibold text-ternary">{{ $flightSearch['cabinClass'] ?? 'Economy' }}</p>
                            </div>
                        </div>
                    </div>


                    <!-- Additional Flight Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                            <div class="flex items-center space-x-2">
                                <i class="fa fa-clock text-blue-600"></i>
                                <span class="text-sm font-medium text-blue-800">Flight Type</span>
                            </div>
                            <p class="text-lg font-semibold text-blue-900">{{ ucfirst($flightSearch['type'] ?? 'oneWay') }}</p>
                        </div>
                        
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                            <div class="flex items-center space-x-2">
                                <i class="fa fa-users text-blue-600"></i>
                                <span class="text-sm font-medium text-blue-800">Total Passengers</span>
                            </div>
                            <p class="text-lg font-semibold text-blue-900">{{ ($flightSearch['adult'] ?? 0) + ($flightSearch['child'] ?? 0) + ($flightSearch['infant'] ?? 0) }}</p>
                        </div>
                        
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                            <div class="flex items-center space-x-2">
                                <i class="fa fa-money-bill text-blue-600"></i>
                                <span class="text-sm font-medium text-blue-800">Currency</span>
                            </div>
                            <p class="text-lg font-semibold text-blue-900">{{ $flightSearch['currency'] ?? 'GBP' }}</p>
                        </div>
                        
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                            <div class="flex items-center space-x-2">
                                <i class="fa fa-ticket text-blue-600"></i>
                                <span class="text-sm font-medium text-blue-800">Fare Type</span>
                            </div>
                            <p class="text-lg font-semibold text-blue-900">{{ $flightSearch['fareType'] ?? 'Public' }}</p>
                        </div>
                    </div>

                    @if($flightSearch['type'] == 'return' && isset($flightSearch['route'][1]))
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h4 class="text-md font-medium text-ternary mb-4 text-secondary">Return Journey Details</h4>
                        <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center space-x-4">
                                <div class="text-center">
                                    <i class="fa fa-plane-departure text-2xl text-secondary mb-2"></i>
                                    <p class="text-sm text-gray-600">Return From</p>
                                    <p class="font-semibold text-ternary">{{ $flightSearch['route'][1]['origin'] ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-500">{{ $flightSearch['route'][1]['deptime'] ?? 'N/A' }}</p>
                                </div>
                                
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-0.5 bg-secondary"></div>
                                    <i class="fa fa-plane text-secondary"></i>
                                    <div class="w-8 h-0.5 bg-secondary"></div>
                                </div>
                                
                                <div class="text-center">
                                    <i class="fa fa-plane-arrival text-2xl text-primary mb-2"></i>
                                    <p class="text-sm text-gray-600">Return To</p>
                                    <p class="font-semibold text-ternary">{{ $flightSearch['route'][1]['destination'] ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-500">{{ $flightSearch['route'][1]['deptime'] ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Passenger Details Section -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-ternary mb-4 text-secondary">Passenger Details</h3>
                    <div class="flex items-center justify-center space-x-8">
                        <div class="text-center">
                            <div class="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center mb-2">
                                <i class="fa fa-user text-primary text-lg"></i>
                            </div>
                            <p class="text-sm text-gray-600">Adults</p>
                            <p class="text-lg font-semibold text-ternary">{{ $flightSearch['adult'] ?? 1 }}</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 rounded-full bg-secondary/20 flex items-center justify-center mb-2">
                                <i class="fa fa-child text-secondary text-lg"></i>
                            </div>
                            <p class="text-sm text-gray-600">Children</p>
                            <p class="text-lg font-semibold text-ternary">{{ $flightSearch['child'] ?? 0 }}</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 rounded-full bg-ternary/20 flex items-center justify-center mb-2">
                                <i class="fa fa-baby text-ternary text-lg"></i>
                            </div>
                            <p class="text-sm text-gray-600">Infants</p>
                            <p class="text-lg font-semibold text-ternary">{{ $flightSearch['infant'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-lg shadow-md p-6 border-t-[4px] border-t-success">
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('public.flight.form', $flightSearch) }}" 
                       class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                        <i class="fa fa-paper-plane mr-2"></i>
                        Submit Flight Request
                    </a>
                    
                    <a href="{{ url()->previous() }}" 
                       class="inline-flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                        <i class="fa fa-search mr-2"></i>
                        Modify Search
                    </a>
                </div>
                
                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600">
                        <i class="fa fa-info-circle mr-1"></i>
                        Need assistance? Contact our support team for help with your flight booking.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
