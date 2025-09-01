
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CloudTravel - Your Complete Travel Solution</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">



    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>




    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {

                        primaryDeeper: '#155F7C',
                        primaryDeep: '#076E97',
                        primary: '#26ACE2',
                        primaryLight: '#D4ECFA',
                        primaryLighter: '#DBF5FF',



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
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="" style="  font-family: 'Bricolage Grotesque', sans-serif;">


{{--Header section starts here--}}
    <div class="w-full absolute top-0 left-0 flex justify-center z-50 p-4 ">
    <div id="mainNavBarDiv" class="xl:w-[70%] lg:w-[80%] md:w-[90%] w-full px-2 py-2 bg-white rounded-full transition ease-in duration-2000 shadow-md shadow-primaryDeep/50 border-[1px] border-primaryDeep/50 flex xl:flex-row lg:flex-row flex-col xl:justify-between lg:justify-between justify-start">
        <div class="flex justify-between xl:w-max lg:w-max w-full">
            <div class="xl:h-16 lg:h-16 h-12 pl-4">
                <img class="h-full w-auto" src="{{asset('assets/images/cloudHome/logo.png')}}" alt="">
            </div>
            <div class="lg:hidden flex xl:h-16 lg:h-16  h-12 xl:w-16 lg:w-16 md:w-16 w-12 rounded-full  justify-center items-center text-primary transition ease-in-out duration-2000"
                 onclick="
                               document.getElementById('mainNavBarDiv').classList.toggle('rounded-full');
                               document.getElementById('mainNavBarDiv').classList.toggle('rounded-sm');
                               document.getElementById('navListDiv').classList.toggle('hidden');
                               document.getElementById('navListDiv').classList.toggle('flex');
                            ">
                <i class="fa fa-bars text-[20px] "></i>
            </div>
        </div>

        <div id="navListDiv" class="xl:w-max lg:w-max w-full h-full xl:flex lg:flex hidden items-center xl:static lg:static xl:px-0 lg:px-0 px-6 xl:py-0 lg:py-0 py-6">
            <ul class="flex xl:flex-row lg:flex-row flex-col gap-2">
                <li class="text-2xl xl:pr-4 lg:pr-4 relative hover:scale-110 transition ease-in duration-2000"><a href="">Home</a></li>
                <li class="text-2xl xl:pr-4 lg:pr-4 relative hover:scale-110 transition ease-in duration-2000"><a href="">About</a></li>
                <li class="text-2xl xl:pr-4 lg:pr-4 relative hover:scale-110 transition ease-in duration-2000"><a href="">Services</a></li>
                <li class="text-2xl xl:pr-4 lg:pr-4 relative hover:scale-110 transition ease-in duration-2000"><a href="">Agencies</a></li>
                <li class="text-2xl xl:pr-4 lg:pr-4 relative hover:scale-110 transition ease-in duration-2000"><a href="">Contact</a></li>
                <li class="xl:hidden lg:hidden block text-2xl xl:pr-4 relative hover:scale-110 transition ease-in duration-2000"><a href="">Login</a></li>
            </ul>
        </div>


        <div class="h-full xl:flex lg:flex hidden items-center">
            <a href="{{route('login')}}" >
                <div class="h-16 w-16 rounded-full flex justify-center items-center text-primary hover:bg-primaryDeeper hover:text-white transition ease-in-out duration-2000 hover:shadow-md hover:shadow-primaryDeep">
                    <i class="fa-regular fa-user text-[25px] "></i>
                </div>
            </a>
        </div>
    </div>
</div>
{{--Header section ends here--}}

{{--Hero banner section starts here--}}
   <div class="relative w-full">
       <div class="swiper hero-slider">
           <div class="swiper-wrapper">
               <div class="swiper-slide relative  bg-center bg-cover bg-no-repeat flex justify-center xl:pt-40 lg:pt-36 md:pt-32 pt-28 sm:pb-16 pb-8 px-4"
                    style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url({{ asset('assets/images/cloudHome/banner3.jpg') }});">
                   <div class="xl:w-[70%] lg:w-[80%] md:w-[90%] w-full xl:rounded-l-[60px] lg:rounded-l-[60px] md:rounded-l-[40px] rounded-l-[20px] flex flex-col" style="background-image: linear-gradient(to right, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.8) 40%, rgba(255,255,255,0.5) 50%,
                         rgba(255,255,255,0.4) 60%,
                        rgba(255,255,255,0.3) 70%, rgba(255,255,255,0.1) 80%,
                         rgba(255,255,255,0.05) 90%, transparent 100%);">

                              <div class="lg:bg-transparent md:bg-transparent sm:bg-transparent bg-white/60 sm:rounded-lg rounded-[20px] flex flex-col xl:px-12 lg:px-12 md:px-10 px-8 xl:py-16 lg:py-16 md:py-12 py-6">
                                    <span class="text-black font-medium xl:text-6xl lg:text-5xl md:text-4xl sm:text-3xl text-3xl tracking-wider">Discover Your Next</span>
                                    <span class="text-black font-medium xl:text-6xl lg:text-5xl md:text-4xl sm:text-3xl text-3xl tracking-wider">Adventure</span>
                                    <p class="text-primaryDeep font-medium xl:text-xl lg:text-xl md:text-md text-sm sm:mt-6 mt-2"> Cloud Travel brings you the best travel experiences</p>

                                    <div class="w-full flex gap-4 xl:mt-12 lg:mt-12 md:mt-12 mt-6 ">
                                         <button class="bg-primary text-white xl:py-2.5 lg:py-2 md:py-1.5 py-1 xl:px-6 lg:px-6 md:px-6 px-4 rounded-md font-semibold lg:text-lg md:text-lg sm:text-md text-sm border-primary border-[2px] hover:bg-transparent hover:text-primary transition ease-in duration-2000">Explore Service</button>

                                         <button class="bg-transparent text-primaryDeeper xl:py-2.5 lg:py-2 md:py-1.5 py-1 xl:px-6 lg:px-6 md:px-6 px-4 rounded-md font-semibold lg:text-lg md:text-lg sm:text-md text-sm border-primaryDeeper border-[2px] hover:bg-primaryDeeper hover:text-white transition ease-in duration-2000">Contact Us</button>
                                    </div>
                                </div>
                                   <div class="w-full bg-white py-2  rounded-b-[60px] xl:grid lg:grid md:grid hidden xl:grid-cols-5 lg:grid-cols-5 md:grid-cols-5">
                                         <div class="w-full flex flex-col items-center py-4">
                                                  <span class="font-bold text-2xl text-black">12500+</span>
                                                  <span class="font-semibold text-md text-black">Happy Travelers</span>
                                         </div>
                                         <div class="w-full flex flex-col items-center py-4">
                                                  <span class="font-bold text-2xl text-black">320+</span>
                                                  <span class="font-semibold text-md text-black">Agencies</span>
                                         </div>

                                         <div class="w-full flex flex-col items-center py-4">
                                                  <span class="font-bold text-2xl text-black">200%</span>
                                                  <span class="font-semibold text-md text-black">Countries</span>
                                         </div>
                                         <div class="w-full flex flex-col items-center py-4">
                                                  <span class="font-bold text-2xl text-black">95%</span>
                                                  <span class="font-semibold text-md text-black">Satisfaction Rate</span>
                                         </div>
                                         <div class="w-full flex flex-col items-center py-4">
                                                  <span class="font-bold text-2xl text-black">24/7</span>
                                                  <span class="font-semibold text-md text-black">Customer Support</span>
                                         </div>
                                   </div>
                     </div>


               </div>
           </div>
           <div class="swiper-pagination"></div>
           <div class="swiper-button-prev text-white"></div>
           <div class="swiper-button-next text-white"></div>
       </div>
   </div>
{{--Hero banner section ends here--}}


{{--Services section starts here--}}
    <div class="w-full p-2 flex justify-center">
        <div  class="xl:w-[70%] lg:w-[80%] md:w-[90%] w-full ">
               <div class="w-full flex flex-col items-center px-4 py-3 rounded-sm mt-10 relative">
                   <div class="w-full absolute top-0 left-0 h-[1px]  bg-gradient-to-r from-transparent via-primaryDeeper to-transparent"></div>
                   <div class="w-full absolute bottom-0 left-0 h-[1px]  bg-gradient-to-r from-transparent via-primaryDeeper to-transparent"></div>
                     <span class="font-semibold lg:text-3xl md:text-3xl sm:text-3xl text-2xl text-primaryDeeper text-center">Our Services</span>
                     <p class="font-medium mt-2 sm:text-md text-xs text-center">We offer comprehensive travel solutions to make your journey seamless from starts to finish.</p>
               </div>
                <div class="servicesCarousel mt-12">
                    <div class="mr-2 h-full">
                        <div class="h-full bg-primaryLighter  lg:rounded-tl-[70px] md:rounded-tl-[40px] rounded-tl-[40px]  lg:rounded-br-[70px] md:rounded-br-[40px] rounded-br-[40px] rounded-tr-[10px] rounded-bl-[10px] border-[1px] border-black/10 shadow-md shadow-black/10">
                            <img src="{{asset('assets/images/cloudHome/service1.jfif')}}" class="lg:h-64 md:h-64 sm:h-64 h-48 w-full object-cover lg:rounded-tl-[70px] md:rounded-tl-[40px] rounded-tl-[40px] rounded-tr-[10px] " alt="">

                            <div class="w-full flex flex-col p-4">
                                <span class="text-primaryDeeper font-semibold lg:text-3xl md:text-2xl text-xl">Cab Service</span>
                                <p class="text-black font-normal text-xs mt-1">Reliable airport transfer and local transportation in over 100 cities worldwide</p>
                                <ul class="mt-4">
                                    <li class="text-black font-medium mb-1 text-black">
                                        <i class="fa fa-circle-check text-primaryDeeper mr-2"></i> 24/7 availability
                                    </li>
                                    <li class="text-black font-medium mb-1 text-black">
                                        <i class="fa fa-circle-check text-primaryDeeper mr-2"></i> Professional drivers
                                    </li>
                                    <li class="text-black font-medium mb-1 text-black">
                                        <i class="fa fa-circle-check text-primaryDeeper mr-2"></i> Fixed price quotes
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mr-2 h-full">
                        <div class="h-full bg-primaryLighter  lg:rounded-tl-[70px] md:rounded-tl-[40px] rounded-tl-[40px]  lg:rounded-br-[70px] md:rounded-br-[40px] rounded-br-[40px] rounded-tr-[10px] rounded-bl-[10px] border-[1px] border-black/10 shadow-md shadow-black/10">
                            <img src="{{asset('assets/images/cloudHome/service2.jfif')}}" class="lg:h-64 md:h-64 sm:h-64 h-48 w-full object-cover lg:rounded-tl-[70px] md:rounded-tl-[40px] rounded-tl-[40px] rounded-tr-[10px] " alt="">

                            <div class="w-full flex flex-col p-4">
                                <span class="text-primaryDeeper font-semibold lg:text-3xl md:text-2xl text-xl">Visa Assistance</span>
                                <p class="text-black font-normal text-xs mt-1">Expert guidance and processing for all your visa requirements across countries. </p>
                                <ul class="mt-4">
                                    <li class="text-black font-medium mb-1 text-black">
                                        <i class="fa fa-circle-check text-primaryDeeper mr-2"></i> Document checklist
                                    </li>
                                    <li class="text-black font-medium mb-1 text-black">
                                        <i class="fa fa-circle-check text-primaryDeeper mr-2"></i> Application review
                                    </li>
                                    <li class="text-black font-medium mb-1 text-black">
                                        <i class="fa fa-circle-check text-primaryDeeper mr-2"></i> Process priority
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mr-2 h-full">
                        <div class="h-full bg-primaryLighter  lg:rounded-tl-[70px] md:rounded-tl-[40px] rounded-tl-[40px]  lg:rounded-br-[70px] md:rounded-br-[40px] rounded-br-[40px] rounded-tr-[10px] rounded-bl-[10px] border-[1px] border-black/10 shadow-md shadow-black/10">
                            <img src="{{asset('assets/images/cloudHome/service3.jfif')}}" class="lg:h-64 md:h-64 sm:h-64 h-48 w-full object-cover lg:rounded-tl-[70px] md:rounded-tl-[40px] rounded-tl-[40px] rounded-tr-[10px] " alt="">

                            <div class="w-full flex flex-col p-4">
                                <span class="text-primaryDeeper font-semibold lg:text-3xl md:text-2xl text-xl">Hotel Reservation</span>
                                <p class="text-black font-normal text-xs mt-1">From budget stays to luxury resorts, find the perfect accommodation for your travel needs. </p>
                                <ul class="mt-4">
                                    <li class="text-black font-medium mb-1 text-black">
                                        <i class="fa fa-circle-check text-primaryDeeper mr-2"></i> Verified guest review
                                    </li>
                                    <li class="text-black font-medium mb-1 text-black">
                                        <i class="fa fa-circle-check text-primaryDeeper mr-2"></i> Exclusive member rates
                                    </li>
                                    <li class="text-black font-medium mb-1 text-black">
                                        <i class="fa fa-circle-check text-primaryDeeper mr-2"></i> Free Cancellation order
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mr-2 h-full">
                        <div class="h-full bg-primaryLighter  lg:rounded-tl-[70px] md:rounded-tl-[40px] rounded-tl-[40px]  lg:rounded-br-[70px] md:rounded-br-[40px] rounded-br-[40px] rounded-tr-[10px] rounded-bl-[10px] border-[1px] border-black/10 shadow-md shadow-black/10">
                            <img src="{{asset('assets/images/cloudHome/service2.jfif')}}" class="lg:h-64 md:h-64 sm:h-64 h-48 w-full object-cover lg:rounded-tl-[70px] md:rounded-tl-[40px] rounded-tl-[40px] rounded-tr-[10px] " alt="">

                            <div class="w-full flex flex-col p-4">
                                <span class="text-primaryDeeper font-semibold lg:text-3xl md:text-2xl text-xl">Flight Bookings</span>
                                <p class="text-black font-normal text-xs mt-1">Expert guidance and processing for all your visa requirements across countries. </p>
                                <ul class="mt-4">
                                    <li class="text-black font-medium mb-1 text-black">
                                        <i class="fa fa-circle-check text-primaryDeeper mr-2"></i> Document checklist
                                    </li>
                                    <li class="text-black font-medium mb-1 text-black">
                                        <i class="fa fa-circle-check text-primaryDeeper mr-2"></i> Application review
                                    </li>
                                    <li class="text-black font-medium mb-1 text-black">
                                        <i class="fa fa-circle-check text-primaryDeeper mr-2"></i> Process priority
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
    </div>
{{--Services section ends here--}}


{{--Agency registration form section here--}}
    <div class="w-full px-2 py-8 flex justify-center mt-10 bg-center bg-cover bg-no-repeat" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.42)), url({{ asset('assets/images/cloudHome/registrationBanner.jpg') }});">
    <div  class="xl:w-[70%] lg:w-[80%] md:w-[90%] w-full ">
        <div class="w-full flex flex-col items-center px-4 py-3 rounded-sm mt-10 relative">
            <div class="w-full absolute top-0 left-0 h-[1px]  bg-gradient-to-r from-transparent via-white to-transparent"></div>
            <div class="w-full absolute bottom-0 left-0 h-[1px]  bg-gradient-to-r from-transparent via-white to-transparent"></div>
            <span class="font-semibold lg:text-3xl md:text-3xl sm:text-3xl text-2xl text-white text-center">For Travel Agencies</span>
            <p class="font-medium mt-2 sm:text-md text-xs text-center text-white">Join Cloud Travel's network fo trusted partners and expand your business opportunities</p>
        </div>

        <div class="w-full h-max flex md:flex-row flex-col mt-10 bg-white rounded-lg">
            <div class="w-full max-w-[700px] h-full bg-white md:rounded-l-lg md:rounded-t-0 rounded-t-lg p-8">
                    <div class="w-full flex flex-col gap-6">
                         <span class="font-semibold text-xl text-primaryDeeper mb-4">Why Partner with Cloud Travel?</span>
                          <div class="w-full flex gap-4">
                               <div class="w-12 h-12 flex-none rounded-full bg-primaryDeeper text-white flex justify-center items-center shadow-md shadow-black/50 border-[2px] border-black/20">
                                   <i class="fas fa-chart-line"></i>
                               </div>
                              <div class="w-full flex flex-col">
                                   <span class="text-primaryDeeper text-lg">Increased Revenue</span>
                                  <p class="text-sm ">Access to exclusive rates and inventory that boost your profit margins</p>
                              </div>
                          </div>
                          <div class="w-full flex gap-4">
                               <div class="w-12 h-12 flex-none rounded-full bg-primaryDeeper text-white flex justify-center items-center shadow-md shadow-black/50 border-[2px] border-black/20">
                                   <i class="fas fa-desktop"></i>
                               </div>
                              <div class="w-full flex flex-col">
                                   <span class="text-primaryDeeper text-lg">Advanced Technology</span>
                                  <p class="text-sm ">User-friendly booking platform with real-time availability and confirmations</p>
                              </div>
                          </div>
                          <div class="w-full flex gap-4">
                               <div class="w-12 h-12 flex-none rounded-full bg-primaryDeeper text-white flex justify-center items-center shadow-md shadow-black/50 border-[2px] border-black/20">
                                   <i class="fas fa-headset"></i>
                               </div>
                              <div class="w-full flex flex-col">
                                   <span class="text-primaryDeeper text-lg">Dedicated Support</span>
                                  <p class="text-sm ">24/7 assistance from our team of travel experts</p>
                              </div>
                          </div>
                          <div class="w-full flex gap-4">
                               <div class="w-12 h-12 flex-none rounded-full bg-primaryDeeper text-white flex justify-center items-center shadow-md shadow-black/50 border-[2px] border-black/20">
                                   <i class="fas fa-graduation-cap"></i>
                               </div>
                              <div class="w-full flex flex-col">
                                   <span class="text-primaryDeeper text-lg">Training Programs</span>
                                  <p class="text-sm ">Regular webinars and training to keep your team updated</p>
                              </div>
                          </div>
                        <div class="w-full flex gap-4">
                            <div class="w-12 h-12 flex-none rounded-full bg-primaryDeeper text-white flex justify-center items-center shadow-md shadow-black/50 border-[2px] border-black/20">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="w-full flex flex-col">
                                <span class="text-primaryDeeper text-lg">Trusted Partnerships</span>
                                <p class="text-sm ">Collaborate with top-tier suppliers and global brands for reliable service</p>
                            </div>
                        </div>
                        <div class="w-full flex gap-4">
                            <div class="w-12 h-12 flex-none rounded-full bg-primaryDeeper text-white flex justify-center items-center shadow-md shadow-black/50 border-[2px] border-black/20">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="w-full flex flex-col">
                                <span class="text-primaryDeeper text-lg">Global Reach</span>
                                <p class="text-sm ">Access worldwide travel options to serve clients wherever they want to go</p>
                            </div>
                        </div>
                        <div class="w-full flex gap-4">
                            <div class="w-12 h-12 flex-none rounded-full bg-primaryDeeper text-white flex justify-center items-center shadow-md shadow-black/50 border-[2px] border-black/20">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <div class="w-full flex flex-col">
                                <span class="text-primaryDeeper text-lg">Faster Bookings</span>
                                <p class="text-sm">Instant confirmations and streamlined workflows to save valuable time</p>
                            </div>
                        </div>
                        <div class="w-full flex gap-4">
                            <div class="w-12 h-12 flex-none rounded-full bg-primaryDeeper text-white flex justify-center items-center shadow-md shadow-black/50 border-[2px] border-black/20">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <div class="w-full flex flex-col">
                                <span class="text-primaryDeeper text-lg">Actionable Insights</span>
                                <p class="text-sm">Analytics and reporting tools to help you optimize your business strategy</p>
                            </div>
                        </div>




                    </div>
            </div>
             <div class="w-full flex flex-col gap-4 md:rounded-r-lg md:rounded-b-0 rounded-b-lg bg-primaryLighter p-8">
                <form action="{{ route('superadmin.agency.submit') }}" class="flex flex-col gap-4" method="POST">
                    <span class="font-semibold text-xl text-black mb-4">Agency Registration</span>

                    <div class="flex flex-col gap-1">
                        <label class="text-primaryDeeper font-medium" for="agency-name">Agency Name <span class="text-red-600">*</span></label>
                        <input type="text" id="agency-name" name="agency_name" value="{{ old('agency_name') }}" placeholder="Enter agency name....." class="placeholder-black w-full rounded-full px-4 py-2 focus:ring-0 focus:outline-none border-[1px] border-black/20 focus:border-black/40 shadow-md shadow-black/10 transition ease-in duration-2000" required>
                        @error('agency_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="grid lg:grid-cols-2 md:grid-cols-1 sm:grid-cols-2 grid-cols-1 gap-4">
                       <div class="flex flex-col gap-1">
                           <label class="text-primaryDeeper font-medium" for="first-name">First Name*</label>
                           <input type="text" id="first-name" name="first_name" value="{{ old('first_name') }}" placeholder="Enter first name....." class="placeholder-black w-full rounded-full px-4 py-2 focus:ring-0 focus:outline-none border-[1px] border-black/20 focus:border-black/40 shadow-md shadow-black/10 transition ease-in duration-2000" required>
                           @error('first_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                       </div>
                       <div class="flex flex-col gap-1">
                           <label class="text-primaryDeeper font-medium" for="last-name">Last Name*</label>
                           <input type="text" id="last-name" name="last_name" value="{{ old('last_name') }}" placeholder="Enter last name....." class="placeholder-black w-full rounded-full px-4 py-2 focus:ring-0 focus:outline-none border-[1px] border-black/20 focus:border-black/40 shadow-md shadow-black/10 transition ease-in duration-2000" required>
                           @error('last_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                       </div>
                   </div>
                    <div class="grid lg:grid-cols-2 md:grid-cols-1 sm:grid-cols-2 grid-cols-1 gap-4">

                        <div class="flex flex-col gap-1">
                            <label class="text-primaryDeeper font-medium" for="email">Email*</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email....." class="placeholder-black w-full rounded-full px-4 py-2 focus:ring-0 focus:outline-none border-[1px] border-black/20 focus:border-black/40 shadow-md shadow-black/10 transition ease-in duration-2000" required>
                            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-primaryDeeper font-medium" for="phone">Phone*</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter phone....." class="placeholder-black w-full rounded-full px-4 py-2 focus:ring-0 focus:outline-none border-[1px] border-black/20 focus:border-black/40 shadow-md shadow-black/10 transition ease-in duration-2000" required>
                            @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-2 md:grid-cols-1 sm:grid-cols-2 grid-cols-1 gap-4">

                    <div class="flex flex-col gap-1">
                        <label class="text-primaryDeeper font-medium" for="business-type">Business Type*</label>
                        <select id="business-type" name="business_type" class="placeholder-black w-full rounded-full px-4 py-2 focus:ring-0 focus:outline-none border-[1px] border-black/20 focus:border-black/40 shadow-md shadow-black/10 transition ease-in duration-2000" required>
                            <option value="">Select Business Type</option>
                            @foreach ($siteData['business_types'] as $type)
                                <option value="{{ strtolower(str_replace(' ', '-', $type)) }}" {{ old('business_type') == strtolower(str_replace(' ', '-', $type)) ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        @error('business_type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-primaryDeeper font-medium" for="experience">Years of Experience*</label>
                        <select id="experience" name="experience" class="placeholder-black w-full rounded-full px-4 py-2 focus:ring-0 focus:outline-none border-[1px] border-black/20 focus:border-black/40 shadow-md shadow-black/10 transition ease-in duration-2000" required>
                            <option value="">Select Experience</option>
                            <option value="0-1" {{ old('experience') == '0-1' ? 'selected' : '' }}>0-1 years</option>
                            <option value="1-3" {{ old('experience') == '1-3' ? 'selected' : '' }}>1-3 years</option>
                            <option value="3-5" {{ old('experience') == '3-5' ? 'selected' : '' }}>3-5 years</option>
                            <option value="5+" {{ old('experience') == '5+' ? 'selected' : '' }}>5+ years</option>
                        </select>
                        @error('experience') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-primaryDeeper font-medium">Services Interested In*</label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach ($siteData['services'] as $service)
                                <div class="flex items-center">
                                    <input type="checkbox" id="service-{{ strtolower(str_replace(' ', '-', $service['title'])) }}" name="services[]" value="{{ $service['title'] }}" class="placeholder-black h-4 w-4 mr-2 rounded-full  focus:ring-0 focus:outline-none border-[1px] border-black/20 focus:border-black/40 shadow-md shadow-black/10 transition ease-in duration-2000"
                                        {{ (is_array(old('services')) && in_array($service['title'], old('services'))) ? 'checked' : '' }}>
                                    <label class="text-primaryDeeper font-normal" for="service-{{ strtolower(str_replace(' ', '-', $service['title'])) }}">{{ $service['title'] }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('services') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-primaryDarkColor text-white py-3 px-4 rounded-md font-medium transition duration-300">
                        Register Your Agency
                    </button>
                    @if(session('success'))
                        <p class="text-green-500 text-sm mt-4">{{ session('success') }}</p>
                    @endif

                    <p class="text-center mt-4 text-gray-600">Already registered? <button onclick="openLoginModal()" class="text-primary hover:underline">Login to your account</button></p>


                </form>
             </div>
        </div>

    </div>
</div>
{{--Agency registration form section ends here--}}


{{--Contact us section here--}}
    <div class="w-full px-2 py-8 flex justify-center  bg-center bg-cover bg-no-repeat" >
    <div  class="xl:w-[70%] lg:w-[80%] md:w-[90%] w-full ">
        <div class="w-full flex flex-col items-center px-4 py-3 rounded-sm  relative">
            <div class="w-full absolute top-0 left-0 h-[1px]  bg-gradient-to-r from-transparent via-primaryDeeper to-transparent"></div>
            <div class="w-full absolute bottom-0 left-0 h-[1px]  bg-gradient-to-r from-transparent via-primaryDeeper to-transparent"></div>
            <span class="font-semibold lg:text-3xl md:text-3xl sm:text-3xl text-2xl text-primaryDeeper text-center">Contact Cloud Travel</span>
            <p class="font-medium mt-2 sm:text-md text-xs text-center text-primaryDeeper">Have questions? Our travel experts are ready to assist you with any inquiries</p>
        </div>
        <div class="w-full grid lg:grid-cols-2 gap-4 mt-10  rounded-lg">
            <div class=" w-full">
                <div class="w-full bg-primaryLighter rounded-lg p-8">
                    <div class="w-full flex flex-col gap-2">
                        <span class="font-semibold text-xl text-primaryDeeper   ">Headquarter</span>
                        <div class="w-full flex items-center gap-4">
                            <div class="w-8 h-8 flex-none rounded-full bg-primaryDeeper text-white flex justify-center items-center shadow-md shadow-black/50 border-[2px] border-black/20">
                                <i class="fas fa-location-dot"></i>
                            </div>
                            <div class="w-full flex flex-col">
                                <span class="text-primaryDeeper text-lg">Location</span>
                                <p class="text-sm ">82 King Street Town Center Southall UB2 4DB</p>
                            </div>
                        </div>
                        <div class="w-full flex items-center gap-4">
                            <div class="w-8 h-8 flex-none rounded-full bg-primaryDeeper text-white flex justify-center items-center shadow-md shadow-black/50 border-[2px] border-black/20">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="w-full flex flex-col">
                                <span class="text-primaryDeeper text-lg">Phone</span>
                                <p class="text-sm ">020 3500 0000</p>
                            </div>
                        </div>
                        <div class="w-full flex items-center gap-4">
                            <div class="w-8 h-8 flex-none rounded-full bg-primaryDeeper text-white flex justify-center items-center shadow-md shadow-black/50 border-[2px] border-black/20">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="w-full flex flex-col">
                                <span class="text-primaryDeeper text-lg">Email</span>
                                <p class="text-sm ">info@cloudtravel.com</p>
                            </div>
                        </div>

                        <span class="font-semibold text-xl text-primaryDeeper mt-6">Regional Office</span>
                        <div class="w-full flex items-center gap-4">
                            <div class="w-8 h-8 flex-none rounded-full bg-primaryDeeper text-white flex justify-center items-center shadow-md shadow-black/50 border-[2px] border-black/20">
                                <i class="fas fa-location-dot"></i>
                            </div>
                            <div class="w-full flex flex-col">
                                <span class="text-primaryDeeper text-lg">Location</span>
                                <p class="text-sm ">82 King Street Town Center Southall UB2 4DB</p>
                            </div>
                        </div>
                        <div class="w-full flex items-center gap-4">
                            <div class="w-8 h-8 flex-none rounded-full bg-primaryDeeper text-white flex justify-center items-center shadow-md shadow-black/50 border-[2px] border-black/20">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="w-full flex flex-col">
                                <span class="text-primaryDeeper text-lg">Phone</span>
                                <p class="text-sm ">020 3500 0000</p>
                            </div>
                        </div>
                        <div class="w-full flex items-center gap-4">
                            <div class="w-8 h-8 flex-none rounded-full bg-primaryDeeper text-white flex justify-center items-center shadow-md shadow-black/50 border-[2px] border-black/20">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="w-full flex flex-col">
                                <span class="text-primaryDeeper text-lg">Email</span>
                                <p class="text-sm ">info@cloudtravel.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" w-full">
                <div class="w-full flex flex-col gap-4 rounded-lg bg-primaryLighter p-8">
                    <form action="{{ route('superadmin.contact.submit') }}" class="flex flex-col gap-4" method="POST">
                        <span class="font-semibold text-xl text-black mb-4">Send Us a Message</span>

                        <div class="grid lg:grid-cols-2 md:grid-cols-1 sm:grid-cols-2 grid-cols-1 gap-4">
                            <div class="flex flex-col gap-1">
                                <label class="text-primaryDeeper font-medium" for="first-name">Your Name*</label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}" placeholder="Enter your name....." class="placeholder-black w-full rounded-full px-4 py-2 focus:ring-0 focus:outline-none border-[1px] border-black/20 focus:border-black/40 shadow-md shadow-black/10 transition ease-in duration-2000" required>
                                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="text-primaryDeeper font-medium" for="last-name">Email*</label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}" placeholder="Enter email....." class="placeholder-black w-full rounded-full px-4 py-2 focus:ring-0 focus:outline-none border-[1px] border-black/20 focus:border-black/40 shadow-md shadow-black/10 transition ease-in duration-2000" required>
                                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-primaryDeeper font-medium" for="experience">Subject*</label>
                            <select id="subject"
                                    name="subject" class="placeholder-black w-full rounded-full px-4 py-2 focus:ring-0 focus:outline-none border-[1px] border-black/20 focus:border-black/40 shadow-md shadow-black/10 transition ease-in duration-2000" required>
                                <option value="">Select a subject</option>
                                <option value="booking" {{ old('subject') == 'booking' ? 'selected' : '' }}>Booking Inquiry</option>
                                <option value="agency" {{ old('subject') == 'agency' ? 'selected' : '' }}>Agency Partnership</option>
                                <option value="support" {{ old('subject') == 'support' ? 'selected' : '' }}>Customer Support</option>
                                <option value="feedback" {{ old('subject') == 'feedback' ? 'selected' : '' }}>Feedback</option>
                                <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('subject') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                            <label class="text-primaryDeeper font-medium" for="last-name">Message*</label>
                            <textarea  id="message"
                                       name="message"
                                       rows="4" placeholder="Enter message....." class="placeholder-black w-full rounded-xl px-4 py-2 focus:ring-0 focus:outline-none border-[1px] border-black/20 focus:border-black/40 shadow-md shadow-black/10 transition ease-in duration-2000" required>
                       {{ old('message') }}
                        </textarea>
                            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="w-full bg-primary hover:bg-primaryDarkColor text-white py-3 px-4 rounded-md font-medium transition duration-300">
                            Send Message
                        </button>
                        @if(session('success'))
                            <p class="text-green-500 text-sm mt-4">{{ session('success') }}</p>
                        @endif
                    </form>
                </div>
            </div>

        </div>
        <div class="w-full md:h-[400px] h-[300px] mt-4">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d620.9302725632467!2d-0.38384423949559093!3d51.49998553479225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48760d52956b5cb9%3A0xf7c975d392a773ce!2sCloud%20Travel%C2%AE!5e0!3m2!1sen!2sin!4v1756729183213!5m2!1sen!2sin"  style="border:0; border-radius: 20px; height:100%; width: 100%" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </div>
</div>
{{--Contact us section ends here--}}

{{--Footer section here--}}
<div class="w-full px-2 py-8 flex justify-center bg-primaryLight" >
    <div  class="xl:w-[70%] lg:w-[80%] md:w-[90%] w-full ">
         <div class="w-full grid md:grid-cols-2 gap-4">
              <div class="w-full flex flex-col ">
                  <img src="{{asset('assets/images/cloudHome/logo.png')}}" class="w-40 h-auto" alt="">
                  <span class="font-medium text-black text-md mt-4">Your trusted partner for all travel needs.</span>
                  <span class="font-medium text-black text-md">We Make your journey's memorable and hassle-free</span>
              </div>

             <div class="w-full grid md:grid-cols-3 grid-cols-2 gap-4">
                  <div class="w-full flex flex-col">
                          <span class="text-xl font-semibold text-black">Quick Links</span>
                           <div class="flex flex-col gap-1 mt-4">
                               <a href="" class="font-medium hover:text-primaryDeeper transition ease-in duration-2000">Home</a>
                               <a href="" class="font-medium hover:text-primaryDeeper transition ease-in duration-2000">Services</a>
                               <a href="" class="font-medium hover:text-primaryDeeper transition ease-in duration-2000">For Agencies</a>
                               <a href="" class="font-medium hover:text-primaryDeeper transition ease-in duration-2000">Contact</a>
                               <a href="" class="font-medium hover:text-primaryDeeper transition ease-in duration-2000">Privacy Policy</a>
                           </div>
                  </div>
                  <div class="w-full flex flex-col">
                          <span class="text-xl font-semibold text-black">Services</span>
                           <div class="flex flex-col gap-1 mt-4">
                               <a href="" class="font-medium hover:text-primaryDeeper transition ease-in duration-2000">Flight Bookings</a>
                               <a href="" class="font-medium hover:text-primaryDeeper transition ease-in duration-2000">Hotel Reservations</a>
                               <a href="" class="font-medium hover:text-primaryDeeper transition ease-in duration-2000">Visa Assistance</a>
                               <a href="" class="font-medium hover:text-primaryDeeper transition ease-in duration-2000">Cab Services</a>
                               <a href="" class="font-medium hover:text-primaryDeeper transition ease-in duration-2000">Tour Packages</a>
                           </div>
                  </div>
                  <div class="w-full flex flex-col">
                          <span class="text-xl font-semibold text-black">Social Media</span>
                           <div class="flex md:flex-col flex-row gap-1 mt-4">
                               <a href="" class="font-medium hover:text-primaryDeeper transition ease-in duration-2000"><i class="fa-brands fa-facebook"></i></a>
                               <a href="" class="font-medium hover:text-primaryDeeper transition ease-in duration-2000"><i class="fa-brands fa-twitter"></i></a>
                               <a href="" class="font-medium hover:text-primaryDeeper transition ease-in duration-2000"><i class="fa-brands fa-instagram"></i></a>
                               <a href="" class="font-medium hover:text-primaryDeeper transition ease-in duration-2000"><i class="fa-brands fa-linkedin"></i></a>
                               <a href="" class="font-medium hover:text-primaryDeeper transition ease-in duration-2000"><i class="fa-brands fa-youtube"></i></a>
                           </div>
                  </div>
             </div>
         </div>

    </div>
</div>

<div class="w-full px-2 py-2 flex justify-center bg-primaryDeeper" >
    <div class="xl:w-[70%] lg:w-[80%] md:w-[90%] w-full flex md:justify-center ">
         <span class="text-white">Copyright 2025| <span class="ml-2 mr-2 font-bold">Cloud Travels| </span>Developed by <span class="ml-2 font-bold"><a href="https://himsoftsolution.com">Him Soft Solution</a></span></span>
    </div>
</div>
{{--Footer section ends here--}}





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



<!-- Include jQuery and Slick Carousel JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    $(document).ready(function(){
        $('.servicesCarousel').slick({
            slidesToShow: 4, // Number of visible slides at a time
            slidesToScroll: 1,
            prevArrow: '<button class="slick-prev">Previous</button>',
            nextArrow: '<button class="slick-next">Next</button>',
            responsive: [
                {
                    breakpoint: 1500,
                    settings: {
                        slidesToShow: 3, // Adjust for smaller screens
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2, // Adjust for smaller screens
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1, // Adjust for smaller screens
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
</script>
</body>
</html>
