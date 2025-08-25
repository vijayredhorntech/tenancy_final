<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flight Request Form</title>
    
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
        select {
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
            background: #f3f4f6 !important;
        }
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
                    <h1 class="ml-4 text-xl font-semibold text-ternary">Flight Request Form</h1>
                </div>
            </div>
        </div>
    </nav>

    <div class="w-full min-h-screen bg-gray-50 py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Form Header -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6 border-t-[4px] border-t-primary">
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-ternary mb-2">Submit Your Flight Request</h2>
                    <p class="text-gray-600">Fill out the form below and we'll get back to you with the best flight options</p>
                </div>
            </div>

            <!-- Flight Request Form -->
            <div class="bg-white rounded-lg shadow-md p-6 border-t-[4px] border-t-secondary">
                <h3 class="text-xl font-semibold text-ternary mb-4">Flight Details</h3>
                
                <form action="{{ route('public.flight.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Hidden fields from search -->
                    <input type="hidden" name="origin" value="{{ $flightSearch['route'][0]['origin'] ?? '' }}">
                    <input type="hidden" name="destination" value="{{ $flightSearch['route'][0]['destination'] ?? '' }}">
                    <input type="hidden" name="departure_date" value="{{ $flightSearch['route'][0]['deptime'] ?? '' }}">
                    @if(isset($flightSearch['route'][1]))
                        <input type="hidden" name="return_date" value="{{ $flightSearch['route'][1]['deptime'] ?? '' }}">
                    @endif
                    <input type="hidden" name="trip_type" value="{{ $flightSearch['type'] ?? 'oneWay' }}">
                    <input type="hidden" name="adults" value="{{ $flightSearch['adult'] ?? 1 }}">
                    <input type="hidden" name="children" value="{{ $flightSearch['child'] ?? 0 }}">
                    <input type="hidden" name="infants" value="{{ $flightSearch['infant'] ?? 0 }}">
                    <input type="hidden" name="cabin_class" value="{{ $flightSearch['cabinClass'] ?? 'Economy' }}">
                    <input type="hidden" name="currency" value="{{ $flightSearch['currency'] ?? 'GBP' }}">

                    <!-- Trip Summary -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h4 class="font-medium text-ternary mb-3">Trip Summary</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div>
                                <span class="text-gray-600">From:</span>
                                <span class="font-medium text-ternary ml-2">{{ $flightSearch['route'][0]['origin'] ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">To:</span>
                                <span class="font-medium text-ternary ml-2">{{ $flightSearch['route'][0]['destination'] ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Date:</span>
                                <span class="font-medium text-ternary ml-2">{{ $flightSearch['route'][0]['deptime'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="space-y-4">
                        <h4 class="font-medium text-ternary text-lg">Personal Information</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="first_name" class="font-semibold text-ternary/90 text-sm">First Name *</label>
                                <div class="w-full relative">
                                    <input type="text" name="first_name" id="first_name" required 
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200"
                                           placeholder="Enter your first name">
                                    <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="last_name" class="font-semibold text-ternary/90 text-sm">Last Name *</label>
                                <div class="w-full relative">
                                    <input type="text" name="last_name" id="last_name" required 
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200"
                                           placeholder="Enter your last name">
                                    <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="email" class="font-semibold text-ternary/90 text-sm">Email Address *</label>
                                <div class="w-full relative">
                                    <input type="email" name="email" id="email" required 
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200"
                                           placeholder="Enter your email address">
                                    <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="phone_number" class="font-semibold text-ternary/90 text-sm">Phone Number *</label>
                                <div class="w-full relative">
                                    <input type="tel" name="phone_number" id="phone_number" required 
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200"
                                           placeholder="Enter your phone number">
                                    <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="nationality" class="font-semibold text-ternary/90 text-sm">Nationality *</label>
                                <div class="w-full relative">
                                    <input type="text" name="nationality" id="nationality" required 
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200"
                                           placeholder="Enter your nationality">
                                    <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="date_of_entry" class="font-semibold text-ternary/90 text-sm">Date of Entry *</label>
                                <div class="w-full relative">
                                    <input type="date" name="date_of_entry" id="date_of_entry" required 
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 transition ease-in duration-200"
                                           placeholder="Select date of entry">
                                    <i class="fa fa-calendar absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>
                        </div>

                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="address" class="font-semibold text-ternary/90 text-sm">Address *</label>
                            <div class="w-full relative">
                                <input type="text" name="address" id="address" required 
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200"
                                       placeholder="Enter your complete address">
                                <i class="fa fa-home absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="city" class="font-semibold text-ternary/90 text-sm">City *</label>
                                <div class="w-full relative">
                                    <input type="text" name="city" id="city" required 
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200"
                                           placeholder="Enter your city">
                                    <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="zipcode" class="font-semibold text-ternary/90 text-sm">Zip Code</label>
                                <div class="w-full relative">
                                    <input type="text" name="zipcode" id="zipcode" 
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200"
                                           placeholder="Enter your zip code">
                                    <i class="fa fa-map-marker absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Requirements -->
                    <div class="space-y-4">
                        <h4 class="font-medium text-ternary text-lg">Additional Requirements</h4>
                        
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="special_requirements" class="font-semibold text-ternary/90 text-sm">Special Requirements</label>
                            <textarea name="special_requirements" id="special_requirements" rows="3" 
                                      class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200"
                                      placeholder="Any special requirements or preferences..."></textarea>
                        </div>

                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="budget_range" class="font-semibold text-ternary/90 text-sm">Budget Range</label>
                            <select name="budget_range" id="budget_range" 
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 transition ease-in duration-200">
                                <option value="">Select Budget Range</option>
                                <option value="Economy">Economy</option>
                                <option value="Mid-Range">Mid-Range</option>
                                <option value="Premium">Premium</option>
                                <option value="Luxury">Luxury</option>
                            </select>
                            <i class="fa fa-money-bill absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center pt-4">
                        <button type="submit" 
                                class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                            <i class="fa fa-paper-plane mr-2"></i>
                            Submit Flight Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
