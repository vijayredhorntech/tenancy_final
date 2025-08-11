<x-agency.layout>
    @section('title')
       Hotel Booking 
    @endsection

        {{--    home slider section here--}}
        <div class="w-full">
            <div class="homeBanner">
            @php
                    $sliderImages = [
                        //`  'https://cloud-travel.co.uk/live_flight/frontend/assets/images/book-holiday.jpg', // This is the image you want to display
                         'https://cloud-travel.co.uk/live_flight/frontend/assets/images/flight-discount2.jpg',
                        // 'https://cloud-travel.co.uk/live_flight/frontend/assets/images/book-holiday.jpg',
                        // 'https://cloud-travel.co.uk/live_flight/frontend/assets/images/flight-discount2.jpg',
                    ];
           @endphp

                <!-- Swiffy Slider Container -->
                    <div class="swiffy-slider" data-swiffy-slider>
                        @foreach($sliderImages as $image)
                            <div class="swiffy-slide">
                             <img src="{{ $image }}" class="w-full lg:h-[500px] md:h-[400px] sm:h-[250px] h-[150px] object-cover" alt="Slider Image">

                            </div>
                        @endforeach
                    </div>

            </div>
        </div>
        {{--    home slider section ends here--}}

        {{--   Popup  --}}
        <div id="loading_overlay1" class="hidden">
                <div class="fixed inset-0 justify-center flex h-screen w-full bg-ternary items-center z-30 opacity-90"> </div>

                <div class="z-40 fixed inset-0  justify-center  flex  h-screen w-full items-center p-4">
                    <div class="lg:w-[50%] md:w-[80%] w-full rounded-[30px]  bg-white p-4 pt-8 shadow-lg shadow-black/60 flex flex-col items-center">
                        <div class="relative flex justify-center items-center">
                            <div class="absolute animate-spin rounded-full h-20 w-20 border-t-4 border-b-4 border-secondary"></div>
                            <img src="https://www.svgrepo.com/show/509001/avatar-thinking-9.svg"  class="rounded-full h-16 w-16">
                        </div>
                        <div class="w-full mt-4 flex justify-center flex items-center">
                            <span class="font-medium text-md text-secondary">Searching Hotel</span>
                            <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
                            <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
                            <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
                            <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
                        </div>
                        <div id="loaderFlightPath" class=" w-full grid lg:grid-cols-3 md:grid-cols-3 grid-cols-1 gap-6 mt-2">
                            <div class="w-full flex flex-col px-4 ">
                                <span class="font-medium text-sm text-gray-600"><i class="fas fa-hotel text-sm text-secondary mr-2" ></i> Check-in Date</span>
                                <div class="mt-2 mb-1"> <span class="font-semibold text-gray-600 text-md" id="coutnry-name"></span> </div>
                                <span class="font-medium text-sm text-secondary" id="checkin"></span>
                            </div>
                            <div class="flex flex-col justify-center items-center px-4">
                                <div class="w-full flex  items-center">
                                    <div class="h-16 w-16 flex-none rounded-full flex justify-center items-center bg-secondary/20 border-[1px] border-secondary/10">
                                        <div class="h-12 w-12 rounded-full flex justify-center items-center bg-secondary/20 border-[1px] border-secondary/10">
                                            <div class="h-8 w-8 rounded-full flex justify-center items-center bg-secondary">
                                                <i class="fas fa-hotel text-white text-xs"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full grow bg-[#f3f4f6] flex justify-center">
                                        <span class="font-medium text-xs text-secondary" id="loaderFlightType"> Hotel </span>
                                    </div>
                                    <div class="w-8 h-8 flex-none rounded-full bg-secondary flex justify-center items-center">
                                        <i class="fas fa-hotel text-white text-xs"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full flex flex-col px-4">
                                <span class="font-medium text-sm text-gray-600"><i class="fas fa-hotel text-sm text-secondary mr-2" ></i>Check-out Date</span>
                                <div class="mt-2 mb-1"><span class="font-semibold text-gray-600 text-md"  id="city-name"></span></div>
                                <span class="font-medium text-sm text-secondary" id="checkout"></span>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        {{--    End Popup Here--}}



                     <x-hotel-search></x-hotel-search>     
                   



</x-agency.layout>