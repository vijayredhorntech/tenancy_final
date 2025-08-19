
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CloudTravel - Your Complete Travel Solution</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primaryColor: '#3abff8',
                        primaryDarkColor: '#1e7ebc',
                        whiteColor: '#ffffff',
                        blackColor: '#000000',
                        redColor: '#ff0000',
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
        .swiper {
            width: 100%;
            height: 100%;
        }
        .swiper-slide {
            background-position: center;
            background-size: cover;
        }
        .swiper-slide::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.3);
        }
        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: white;
            opacity: 0.6;
        }
        .swiper-pagination-bullet-active {
            background: #26ace2;
            opacity: 1;
        }
        .hero-slider {
            height: 70vh;
            max-height: 700px;
        }
        @media (max-width: 768px) {
            .hero-slider {
                height: 60vh;
            }
        }
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 2rem;
            border-radius: 0.5rem;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover {
            color: black;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="font-sans bg-gray-50">
  
    <!-- Navigation -->
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('assets/images/logo.png') }}" alt="CloudTravel Logo" class="h-[60px] w-auto">
                {{-- <span class="text-2xl font-bold text-ternary">CloudTravel</span> --}}
            </div>


            <div class="hidden md:flex space-x-8">
                <a href="#" class="text-ternary hover:text-primary font-medium">Home</a>
                <a href="#services" class="text-ternary hover:text-primary font-medium">Services</a>
                <a href="#agency" class="text-ternary hover:text-primary font-medium">For Agencies</a>
                <a href="#contact" class="text-ternary hover:text-primary font-medium">Contact</a>
            </div>
            <div class="flex items-center space-x-4">
                {{-- <button onclick="openLoginModal()" class="bg-primary hover:bg-primaryDarkColor text-white px-4 py-2 rounded-md font-medium transition duration-300">Agency Login</button> --}}
                   <a href="{{ route('login') }}" class="bg-primary hover:bg-primaryDarkColor text-white px-4 py-2 rounded-md font-medium transition duration-300">
                        Login
                    </a> 
                {{-- <button onclick="openLoginModal()" class="bg-primary hover:bg-primaryDarkColor text-white px-4 py-2 rounded-md font-medium transition duration-300"> Login</button> --}}

                <button class="md:hidden text-ternary" id="mobile-menu-button">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
        <!-- Mobile menu -->
        <div class="md:hidden hidden bg-white py-2 px-4" id="mobile-menu">
            <a href="#" class="block py-2 text-ternary hover:text-primary">Home</a>
            <a href="#services" class="block py-2 text-ternary hover:text-primary">Services</a>
            <a href="#agency" class="block py-2 text-ternary hover:text-primary">For Agencies</a>
            <a href="#contact" class="block py-2 text-ternary hover:text-primary">Contact</a>
        </div>
    </nav>

    <!-- Hero Slider -->

      @if(session('success'))
            <div
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 4000)"
                class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50"
            >
                {{ session('success') }}
            </div>
        @endif

    <div class="swiper hero-slider">

        <div class="swiper-wrapper">
            <?php foreach ($siteData['hero_slides'] as $slide): ?>
            <div class="swiper-slide relative" style="background-image: url('<?php echo $slide['image']; ?>')">
                <div class="absolute inset-0 flex items-center justify-center text-center z-10 px-4">
                    <div class="max-w-4xl">
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-6"><?php echo $slide['title']; ?></h1>
                        <p class="text-xl text-white mb-8"><?php echo $slide['description']; ?></p>
                        <div class="flex flex-col md:flex-row justify-center gap-4">
                            <?php foreach ($slide['buttons'] as $button): ?>
                            <a href="<?php echo $button['link']; ?>" class="<?php echo $button === $slide['buttons'][0] ? 'bg-primary hover:bg-primaryDarkColor text-white' : 'bg-transparent border-2 border-white text-white hover:bg-white hover:text-primary'; ?> px-6 py-3 rounded-md font-bold transition duration-300">
                                <?php echo $button['text']; ?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- Add pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add navigation buttons -->
        <div class="swiper-button-prev text-white"></div>
        <div class="swiper-button-next text-white"></div>
    </div>

    <!-- Services Section -->
    <section id="services" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-ternary mb-4">Our Services</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">We offer comprehensive travel solutions to make your journey seamless from start to finish.</p>
            </div>
            
            <!-- Services Slider -->
            <div class="swiper servicesSwiper pb-12">
                <div class="swiper-wrapper">
                    <?php foreach ($siteData['services'] as $service): ?>
                    <div class="swiper-slide">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl hover:-translate-y-2 h-full mx-2">
                            <div class="h-48 bg-cover bg-center" style="background-image: url('<?php echo $service['image']; ?>')"></div>
                            <div class="p-6">
                                <div class="flex items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded-full mr-4">
                                        <i class="<?php echo $service['icon']; ?> text-primary text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-ternary"><?php echo $service['title']; ?></h3>
                                </div>
                                <p class="text-gray-600 mb-4"><?php echo $service['description']; ?></p>
                                <ul class="text-sm text-gray-600 space-y-2 mb-4">
                                    <?php foreach ($service['features'] as $feature): ?>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-primary mt-1 mr-2"></i>
                                        <span><?php echo $feature; ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                           
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!-- Add pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Agency Section -->
    <section id="agency" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-ternary mb-4">For Travel Agencies</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Join CloudTravel's network of trusted travel partners and expand your business opportunities.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <h3 class="text-2xl font-bold text-ternary mb-4">Why Partner With CloudTravel?</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-full mr-4">
                                <i class="fas fa-chart-line text-primary"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-ternary">Increased Revenue</h4>
                                <p class="text-gray-600">Access to exclusive rates and inventory that boost your profit margins</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-full mr-4">
                                <i class="fas fa-desktop text-primary"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-ternary">Advanced Technology</h4>
                                <p class="text-gray-600">User-friendly booking platform with real-time availability and confirmations</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-full mr-4">
                                <i class="fas fa-headset text-primary"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-ternary">Dedicated Support</h4>
                                <p class="text-gray-600">24/7 assistance from our team of travel experts</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-full mr-4">
                                <i class="fas fa-graduation-cap text-primary"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-ternary">Training Programs</h4>
                                <p class="text-gray-600">Regular webinars and training to keep your team updated</p>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <h3 class="text-2xl font-bold text-ternary mb-6 text-center">Agency Registration</h3>
                    {{-- <form>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="agency-name">Agency Name*</label>
                            <input type="text" id="agency-name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 mb-2" for="first-name">First Name*</label>
                                <input type="text" id="first-name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2" for="last-name">Last Name*</label>
                                <input type="text" id="last-name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="email">Email*</label>
                            <input type="email" id="email" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="phone">Phone*</label>
                            <input type="tel" id="phone" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="business-type">Business Type*</label>
                            <select id="business-type" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                                <option value="">Select Business Type</option>
                                <?php foreach ($siteData['business_types'] as $type): ?>
                                <option value="<?php echo strtolower(str_replace(' ', '-', $type)); ?>"><?php echo $type; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Services Interested In*</label>
                            <div class="grid grid-cols-2 gap-2">
                                <?php foreach ($siteData['services'] as $service): ?>
                                <div class="flex items-center">
                                    <input type="checkbox" id="service-<?php echo strtolower(str_replace(' ', '-', $service['title'])); ?>" class="mr-2 rounded border-gray-300 text-primary focus:ring-primary">
                                    <label for="service-<?php echo strtolower(str_replace(' ', '-', $service['title'])); ?>"><?php echo $service['title']; ?></label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-gray-700 mb-2" for="experience">Years of Experience*</label>
                            <select id="experience" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                                <option value="">Select Experience</option>
                                <option value="0-1">0-1 years</option>
                                <option value="1-3">1-3 years</option>
                                <option value="3-5">3-5 years</option>
                                <option value="5+">5+ years</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="w-full bg-primary hover:bg-primaryDarkColor text-white py-3 px-4 rounded-md font-medium transition duration-300">
                            Register Your Agency
                        </button>
                    </form> --}}
                    <form action="{{ route('superadmin.agency.submit') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="agency-name">Agency Name*</label>
                            <input type="text" id="agency-name" name="agency_name" value="{{ old('agency_name') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                            @error('agency_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 mb-2" for="first-name">First Name*</label>
                                <input type="text" id="first-name" name="first_name" value="{{ old('first_name') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                                @error('first_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2" for="last-name">Last Name*</label>
                                <input type="text" id="last-name" name="last_name" value="{{ old('last_name') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                                @error('last_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="email">Email*</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="phone">Phone*</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                            @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="business-type">Business Type*</label>
                            <select id="business-type" name="business_type" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                                <option value="">Select Business Type</option>
                                @foreach ($siteData['business_types'] as $type)
                                    <option value="{{ strtolower(str_replace(' ', '-', $type)) }}" {{ old('business_type') == strtolower(str_replace(' ', '-', $type)) ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('business_type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Services Interested In*</label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach ($siteData['services'] as $service)
                                    <div class="flex items-center">
                                        <input type="checkbox" id="service-{{ strtolower(str_replace(' ', '-', $service['title'])) }}" name="services[]" value="{{ $service['title'] }}" class="mr-2 rounded border-gray-300 text-primary focus:ring-primary" 
                                        {{ (is_array(old('services')) && in_array($service['title'], old('services'))) ? 'checked' : '' }}>
                                        <label for="service-{{ strtolower(str_replace(' ', '-', $service['title'])) }}">{{ $service['title'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('services') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 mb-2" for="experience">Years of Experience*</label>
                            <select id="experience" name="experience" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                                <option value="">Select Experience</option>
                                <option value="0-1" {{ old('experience') == '0-1' ? 'selected' : '' }}>0-1 years</option>
                                <option value="1-3" {{ old('experience') == '1-3' ? 'selected' : '' }}>1-3 years</option>
                                <option value="3-5" {{ old('experience') == '3-5' ? 'selected' : '' }}>3-5 years</option>
                                <option value="5+" {{ old('experience') == '5+' ? 'selected' : '' }}>5+ years</option>
                            </select>
                            @error('experience') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="w-full bg-primary hover:bg-primaryDarkColor text-white py-3 px-4 rounded-md font-medium transition duration-300">
                            Register Your Agency
                        </button>

                        @if(session('success'))
                            <p class="text-green-500 text-sm mt-4">{{ session('success') }}</p>
                        @endif
                    </form>

                    {{-- <p class="text-center mt-4 text-gray-600">Already registered? <button onclick="openLoginModal()" class="text-primary hover:underline">Login to your account</button></p> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="py-16 bg-primary text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">What Our Clients Say</h2>
                <p class="max-w-2xl mx-auto">Hear from travelers and agencies who have partnered with us.</p>
            </div>
            
            <div class="swiper reviewsSwiper">
                <div class="swiper-wrapper pb-12">
                    <?php foreach ($siteData['reviews'] as $review): ?>
                    <div class="swiper-slide">
                        <div class="bg-white bg-opacity-10 p-8 rounded-lg backdrop-blur-sm h-full">
                            <div class="flex items-center mb-6">
                                <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center text-primary mr-6">
                                    <i class="fas fa-user text-3xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-xl"><?php echo $review['name']; ?></h4>
                                    <p class="text-sm opacity-80"><?php echo $review['role']; ?></p>
                                    <div class="flex mt-1 text-yellow-400">
                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                            <i class="fas fa-<?php echo $i < $review['rating'] ? 'star' : ($i == floor($review['rating']) && $review['rating'] - $i > 0 ? 'star-half-alt' : 'star'); ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                            <p>"<?php echo $review['content']; ?>"</p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!-- Add pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-ternary text-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold mb-2"><span class="counter" data-target="12500">0</span>+</div>
                    <div class="text-primary font-medium">Happy Travelers</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2"><span class="counter" data-target="320">0</span>+</div>
                    <div class="text-primary font-medium">Partner Agencies</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2"><span class="counter" data-target="95">0</span>%</div>
                    <div class="text-primary font-medium">Satisfaction Rate</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2"><span class="counter" data-target="24">0</span>/7</div>
                    <div class="text-primary font-medium">Customer Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-ternary mb-4">Contact CloudTravel</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Have questions? Our travel experts are ready to assist you with any inquiries.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-ternary mb-4">Our Offices</h3>
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-bold text-lg text-ternary mb-2">Headquarters</h4>
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-primary mt-1 mr-3"></i>
                                <span><?php echo $siteData['contact_info']['headquarters']['address']; ?></span>
                            </div>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-phone-alt text-primary mr-3"></i>
                                <span><?php echo $siteData['contact_info']['headquarters']['phone']; ?></span>
                            </div>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-envelope text-primary mr-3"></i>
                                <span><?php echo $siteData['contact_info']['headquarters']['email']; ?></span>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg text-ternary mb-2">Regional Office</h4>
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-primary mt-1 mr-3"></i>
                                <span><?php echo $siteData['contact_info']['regional_office']['address']; ?></span>
                            </div>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-phone-alt text-primary mr-3"></i>
                                <span><?php echo $siteData['contact_info']['regional_office']['phone']; ?></span>
                            </div>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-envelope text-primary mr-3"></i>
                                <span><?php echo $siteData['contact_info']['regional_office']['email']; ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-ternary mt-8 mb-4">Business Hours</h3>
                    <div class="space-y-2">
                        <?php foreach ($siteData['contact_info']['business_hours'] as $day => $hours): ?>
                        <div class="flex justify-between">
                            <span><?php echo $day; ?></span>
                            <span><?php echo $hours; ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-ternary mt-8 mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-ternary hover:bg-primary hover:text-white transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-ternary hover:bg-primary hover:text-white transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-ternary hover:bg-primary hover:text-white transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-ternary hover:bg-primary hover:text-white transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-lg shadow-md">
                    <h3 class="text-2xl font-bold text-ternary mb-6">Send Us a Message</h3>
                    <form action="{{ route('superadmin.contact.submit') }}" method="POST" class="space-y-4">
                            @csrf

                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="name">Your Name*</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary @error('name') border-red-500 @enderror"
                                    required
                                >
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="email">Email*</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary @error('email') border-red-500 @enderror"
                                    required
                                >
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2" for="subject">Subject*</label>
                                <select
                                    id="subject"
                                    name="subject"
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary @error('subject') border-red-500 @enderror"
                                    required
                                >
                                    <option value="">Select a subject</option>
                                    <option value="booking" {{ old('subject') == 'booking' ? 'selected' : '' }}>Booking Inquiry</option>
                                    <option value="agency" {{ old('subject') == 'agency' ? 'selected' : '' }}>Agency Partnership</option>
                                    <option value="support" {{ old('subject') == 'support' ? 'selected' : '' }}>Customer Support</option>
                                    <option value="feedback" {{ old('subject') == 'feedback' ? 'selected' : '' }}>Feedback</option>
                                    <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('subject')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 mb-2" for="message">Message*</label>
                                <textarea
                                    id="message"
                                    name="message"
                                    rows="4"
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary @error('message') border-red-500 @enderror"
                                    required
                                >{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                class="w-full bg-primary hover:bg-primaryDarkColor text-white py-3 px-4 rounded-md font-medium transition duration-300"
                            >
                                Send Message
                            </button>
                   </form>

                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-ternary text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-cloud text-3xl text-primary"></i>
                        <span class="text-2xl font-bold">CloudTravel</span>
                    </div>
                    <p class="mb-4">Your trusted partner for all travel needs. We make your journeys memorable and hassle-free.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-primary transition duration-300"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white hover:text-primary transition duration-300"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white hover:text-primary transition duration-300"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white hover:text-primary transition duration-300"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-primary transition duration-300">Home</a></li>
                        <li><a href="#services" class="hover:text-primary transition duration-300">Services</a></li>
                        <li><a href="#agency" class="hover:text-primary transition duration-300">For Agencies</a></li>
                        <li><a href="#contact" class="hover:text-primary transition duration-300">Contact</a></li>
                        <li><a href="#" class="hover:text-primary transition duration-300">Privacy Policy</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Services</h4>
                    <ul class="space-y-2">
                        <?php foreach (array_slice($siteData['services'], 0, 5) as $service): ?>
                        <li><a href="#" class="hover:text-primary transition duration-300"><?php echo $service['title']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Newsletter</h4>
                    <p class="mb-4">Subscribe to get travel tips and exclusive offers delivered to your inbox.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email" class="px-4 py-2 rounded-l-md w-full text-gray-800 focus:outline-none">
                        <button type="submit" class="bg-primary hover:bg-primaryDarkColor px-4 py-2 rounded-r-md transition duration-300">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                    <p class="text-sm mt-2 text-gray-400">We'll never share your email with anyone else.</p>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p>&copy; 2023 CloudTravel. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('loginModal')">&times;</span>
            <h2 class="text-2xl font-bold text-ternary mb-6">Agency Login</h2>
            <form id="loginForm">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="login-email">Email Address*</label>
                    <input type="email" id="login-email" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                </div>
                <button type="button" onclick="sendVerification()" class="w-full bg-primary hover:bg-primaryDarkColor text-white py-3 px-4 rounded-md font-medium transition duration-300">
                    Continue
                </button>
                <p class="text-center mt-4 text-gray-600">Don't have an account? <a href="#agency" class="text-primary hover:underline">Register here</a></p>
            </form>
        </div>
    </div>

    <!-- Verification Modal -->
    <div id="verificationModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('verificationModal')">&times;</span>
            <h2 class="text-2xl font-bold text-ternary mb-6">Verify Your Email</h2>
            <p class="mb-6">We've sent a verification code to <span id="userEmail" class="font-semibold"></span>. Please enter it below:</p>
            <form id="verificationForm">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="verification-code">Verification Code*</label>
                    <input type="text" id="verification-code" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                </div>
                <button type="button" onclick="verifyCode()" class="w-full bg-primary hover:bg-primaryDarkColor text-white py-3 px-4 rounded-md font-medium transition duration-300">
                    Verify & Login
                </button>
                <p class="text-center mt-4 text-gray-600">Didn't receive the code? <button onclick="resendCode()" class="text-primary hover:underline">Resend</button></p>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        // Initialize hero slider
        const heroSwiper = new Swiper('.hero-slider', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
        
        // Initialize services slider
        const servicesSwiper = new Swiper('.servicesSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
                1280: {
                    slidesPerView: 4,
                }
            }
        });

        // Initialize reviews slider
        const reviewsSwiper = new Swiper('.reviewsSwiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                }
            }
        });
        
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Counter animation
        const counters = document.querySelectorAll('.counter');
        const speed = 200;
        
        function animateCounters() {
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / speed;
                
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(animateCounters, 1);
                } else {
                    counter.innerText = target;
                }
            });
        }
        
        // Start counter animation when stats section is in view
        const statsSection = document.querySelector('section.bg-ternary');
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                animateCounters();
                observer.unobserve(statsSection);
            }
        }, { threshold: 0.5 });
        
        observer.observe(statsSection);

        // Modal functions
        function openLoginModal() {
            document.getElementById('loginModal').style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function sendVerification() {
            const email = document.getElementById('login-email').value;
            if (!email) {
                alert('Please enter your email address');
                return;
            }
            
            // In a real app, you would send the email to your backend here
            console.log('Sending verification code to:', email);
            
            // Show the verification modal
            document.getElementById('userEmail').textContent = email;
            document.getElementById('loginModal').style.display = 'none';
            document.getElementById('verificationModal').style.display = 'block';
            
            // Simulate sending a code (in production, this would come from your backend)
            const code = Math.floor(100000 + Math.random() * 900000);
            console.log('Verification code (simulated):', code);
            // Store the code for verification
            window.tempVerificationCode = code;
        }

        function verifyCode() {
            const enteredCode = document.getElementById('verification-code').value;
            const expectedCode = window.tempVerificationCode;
            
            if (!enteredCode) {
                alert('Please enter the verification code');
                return;
            }
            
            // In a real app, you would verify this against your backend
            if (enteredCode == expectedCode) {
                alert('Verification successful! Redirecting to dashboard...');
                // In a real app, you would redirect or set the login state here
                closeModal('verificationModal');
                // Redirect to dashboard or show success message
                window.location.href = 'dashboard.html'; // This would be your actual dashboard page
            } else {
                alert('Invalid verification code. Please try again.');
            }
        }

        function resendCode() {
            // In a real app, you would request a new code from your backend
            console.log('Resending verification code...');
            const code = Math.floor(100000 + Math.random() * 900000);
            console.log('New verification code (simulated):', code);
            window.tempVerificationCode = code;
            alert('A new verification code has been sent to your email.');
        }
    </script>
</body>
</html>