<x-main.layout>


{{--    banner and search section--}}
    <div class=" w-full relative bg-white">

         {{--    home slider section here--}}
         <div class="w-full">
             <div class="homeBanner">
            
                 @php

                     $sliderImages = [
                         'https://cloud-travel.co.uk/live_flight/frontend/assets/images/book-holiday.jpg',
                         'https://cloud-travel.co.uk/live_flight/frontend/assets/images/flight-discount2.jpg',
                         'https://cloud-travel.co.uk/live_flight/frontend/assets/images/book-holiday.jpg',
                         'https://cloud-travel.co.uk/live_flight/frontend/assets/images/flight-discount2.jpg',
                     ];
                 @endphp

                 @foreach($sliderImages as $image)
                     <div><img src="{{ $image }}"
                               class="w-full lg:h-[500px] md:h-[400px] sm:h-[400px] h-[350px]  object-cover" alt="Image 1">
                     </div>
                 @endforeach

             </div>
         </div>
         {{--    home slider section ends here--}}


                        <div class="w-full">
                            <div class="w-full bg-white p-4 flex flex-col gap-2 rounded-t-md mx-auto">
                            <span class="font-semibold lg:text-3xl md:text-2xl sm:text-xl text-lg"> Discover, Explore the World with Ease</span>
                <div class="flex gap-2 py-2 w-full border-b-[1px] border-b-ternary/20">
                    <Link href="{{ route('home') }}">
                    <button
                        class=" @if(Route::currentRouteName() == 'home') bg-ternary text-white @else text-ternary bg-transparent hover:bg-ternary/20 hover:text-black @endif  py-1 px-4 font-medium text-sm rounded-md transition ease-in duration-2000">
                        Flights
                    </button>
                    </Link>
                    <Link href="{{ route('home') }}">
                    <button
                        class=" @if(Route::currentRouteName() == 'hotels') bg-ternary text-white @else text-ternary bg-transparent hover:bg-ternary/20 hover:text-black @endif  py-1 px-4 font-medium text-sm rounded-md transition ease-in duration-2000">
                        Hotels
                    </button>
                    </Link>
                    
                </div>
                </div>
                  <div class="flex gap-2 py-2 w-full border-b-[1px] border-b-ternary/20">
                     
                  
                  </div>
             </div>
             <div class="w-full mx-auto bg-white rounded-b-md shadow-lg shadow-ternary/30">
          
                     <x-flight-search></x-flight-search>               

             </div>
         </div>

{{--    banner and search section ends here--}}


{{--    popular destinations section--}}
    <div class="w-full lg:px-6 px-4 lg:mt-[300px] md:mt-[420px] sm:mt-[600px] mt-[650px] bg-white">
         <div class="w-full ">
             <div class="w-max pb-2 border-b-[2px] border-b-secondary pr-12 mb-2">
                 <span class="font-medium lg:text-3xl text-2xl">Popular Destinations</span>
             </div>
             <span class="font-medium text-md text-black/50">Most popular destinations around the world, from historical places to natural wonders</span>
         </div>

         <div class="flightOfferSlider py-12">
             <a href="">
              <div class="lg:pr-6 md:pr-6 sm:pr-6 pr-0">
                  <div class="w-full rounded-md lg:h-[500px] md:h-[400px] sm:h-[400px] h-[300px] bg-center bg-cover bg-no-repeat " style="background-image: url({{asset('assets/images/india.jpg')}})">
                      <div class="w-full h-full bg-ternary/10 rounded-md flex flex-col justify-end">
                          <div class="bg-ternary/60 p-3 flex flex-col rounded-b-md">
                              <span class="text-white font-bold text-2xl">Taj Mahal</span>
                              <span class="text-white/80 text-md font-medium"><i class="fa fa-location-dot mr-2 text-secondary "></i> Agra, India</span>
                          </div>
                      </div>
                  </div>
              </div>
             </a>
             <a href="">
                 <div class="lg:pr-6 md:pr-6 sm:pr-6 pr-0">
                 <div class="w-full rounded-md lg:h-[500px] md:h-[400px] sm:h-[400px] h-[300px] bg-center bg-cover bg-no-repeat" style="background-image: url({{asset('assets/images/berlin.jpg')}})">
                     <div class="w-full h-full bg-ternary/10 rounded-md flex flex-col justify-end">
                         <div class="bg-ternary/60 p-3 flex flex-col rounded-b-md">
                             <span class="text-white font-bold text-2xl">Monument of Berlin</span>
                             <span class="text-white/80 text-md font-medium"><i class="fa fa-location-dot mr-2 text-secondary "></i> Berlin, Germany</span>
                         </div>
                     </div>
                 </div>
                 </div>
             </a>
             <a href="">
                 <div class="lg:pr-6 md:pr-6 sm:pr-6 pr-0">
                 <div class="w-full rounded-md lg:h-[500px] md:h-[400px] sm:h-[400px] h-[300px] bg-center bg-cover bg-no-repeat" style="background-image: url({{asset('assets/images/india2.jpg')}})">
                     <div class="w-full h-full bg-ternary/10 rounded-md flex flex-col justify-end">
                         <div class="bg-ternary/60 p-3 flex flex-col rounded-b-md">
                             <span class="text-white font-bold text-2xl">Red Fort</span>
                             <span class="text-white/80 text-md font-medium"><i class="fa fa-location-dot mr-2 text-secondary "></i> New Delhi, India</span>
                         </div>
                     </div>
                 </div>
                 </div>
             </a>
             <a href="">
                 <div class="lg:pr-6 md:pr-6 sm:pr-6 pr-0">
                 <div class="w-full rounded-md lg:h-[500px] md:h-[400px] sm:h-[400px] h-[300px] bg-center bg-cover bg-no-repeat" style="background-image: url({{asset('assets/images/italy.jpg')}})">
                     <div class="w-full h-full bg-ternary/10 rounded-md flex flex-col justify-end">
                         <div class="bg-ternary/60 p-3 flex flex-col rounded-b-md">
                             <span class="text-white font-bold text-2xl">Rialto Bridge</span>
                             <span class="text-white/80 text-md font-medium"><i class="fa fa-location-dot mr-2 text-secondary "></i> Venice, Italy</span>
                         </div>
                     </div>
                 </div>
                 </div>
             </a>
             <a href="">
                 <div class="lg:pr-6 md:pr-6 sm:pr-6 pr-0">
                 <div class="w-full rounded-md lg:h-[500px] md:h-[400px] sm:h-[400px] h-[300px] bg-center bg-cover bg-no-repeat" style="background-image: url({{asset('assets/images/india.jpg')}})">
                     <div class="w-full h-full bg-ternary/10 rounded-md flex flex-col justify-end">
                         <div class="bg-ternary/60 p-3 flex flex-col rounded-b-md">
                             <span class="text-white font-bold text-2xl">Taj Mahal</span>
                             <span class="text-white/80 text-md font-medium"><i class="fa fa-location-dot mr-2 text-secondary "></i> Agra, India</span>
                         </div>
                     </div>
                 </div>
                 </div>
             </a>
             <a href="">
                 <div class="lg:pr-6 md:pr-6 sm:pr-6 pr-0">
                 <div class="w-full rounded-md lg:h-[500px] md:h-[400px] sm:h-[400px] h-[300px] bg-center bg-cover bg-no-repeat" style="background-image: url({{asset('assets/images/berlin.jpg')}})">
                     <div class="w-full h-full bg-ternary/10 rounded-md flex flex-col justify-end">
                         <div class="bg-ternary/60 p-3 flex flex-col rounded-b-md">
                             <span class="text-white font-bold text-2xl">Monument of Berlin</span>
                             <span class="text-white/80 text-md font-medium"><i class="fa fa-location-dot mr-2 text-secondary "></i> Berlin, Germany</span>
                         </div>
                     </div>
                 </div>
                 </div>
             </a>
             <a href="">
                 <div class="lg:pr-6 md:pr-6 sm:pr-6 pr-0">
                 <div class="w-full rounded-md lg:h-[500px] md:h-[400px] sm:h-[400px] h-[300px] bg-center bg-cover bg-no-repeat" style="background-image: url({{asset('assets/images/india2.jpg')}})">
                     <div class="w-full h-full bg-ternary/10 rounded-md flex flex-col justify-end">
                         <div class="bg-ternary/60 p-3 flex flex-col rounded-b-md">
                             <span class="text-white font-bold text-2xl">Red Fort</span>
                             <span class="text-white/80 text-md font-medium"><i class="fa fa-location-dot mr-2 text-secondary "></i> New Delhi, India</span>
                         </div>
                     </div>
                 </div>
                 </div>
             </a>

         </div>

     </div>
{{--    popular destinations section ends here--}}


{{--    special flight offers section--}}
    <div class="w-full lg:px-6 px-4 mt-8 bg-white">
        <div class="w-full ">
            <div class="w-max pb-2 border-b-[2px] border-b-secondary pr-12 mb-2">
                <span class="font-medium lg:text-3xl text-2xl">Special Flight Offers</span>
            </div>
            <span class="font-medium text-md text-black/50">Check out our special offers and discounts</span>
        </div>

        <div class="flightOfferSlider py-12">
            <div class="lg:pr-6 md:pr-6 sm:pr-6 pr-0">
                <div class="w-full rounded-md  bg-center bg-cover bg-no-repeat ">
                    <img src="{{asset('assets/images/italy.jpg')}}" class="h-[150px] w-full object-cover rounded-t-md" alt="">
                    <div class="w-full h-full bg-gray-100 rounded-b-md flex flex-col p-4">
                       <span class="text-gray-600 text-md">Cuba</span>
                        <div class="flex gap-2 my-1 text-secondary text-sm">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half"></i>
                        </div>
                        <div class="my-2 flex flex-col">
                            <span class="text-black text-sm">Drive the dream in Cuba</span>
                            <span class="text-black text-md">Cuba is brimming with boundless day trip adventure</span>
                        </div>
                        <span class="text-gray-600 text-sm">Starts From <span class="text-2xl text-secondary font-semibold"> £ 500</span></span>
                    </div>
                    <div class="pt-4 bg-gray-100">
                        <button class="w-full rounded-b-md bg-secondary  text-white px-4 py-2 text-lg font-semibold transition ease-in duration-2000 ">DETAILS</button>
                    </div>
                </div>
            </div>
            <div class="lg:pr-6 md:pr-6 sm:pr-6 pr-0">
                <div class="w-full rounded-md  bg-center bg-cover bg-no-repeat ">
                    <img src="{{asset('assets/images/italy.jpg')}}" class="h-[150px] w-full object-cover rounded-t-md" alt="">
                    <div class="w-full h-full bg-gray-100 rounded-b-md flex flex-col p-4">
                        <span class="text-gray-600 text-md">Cuba</span>
                        <div class="flex gap-2 my-1 text-secondary text-sm">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half"></i>
                        </div>
                        <div class="my-2 flex flex-col">
                            <span class="text-black text-sm">Drive the dream in Cuba</span>
                            <span class="text-black text-md">Cuba is brimming with boundless day trip adventure</span>
                        </div>
                        <span class="text-gray-600 text-sm">Starts From <span class="text-2xl text-secondary font-semibold"> £ 500</span></span>
                    </div>
                    <div class="pt-4 bg-gray-100">
                        <button class="w-full rounded-b-md bg-secondary  text-white px-4 py-2 text-lg font-semibold transition ease-in duration-2000 ">DETAILS</button>
                    </div>
                </div>
            </div>
            <div class="lg:pr-6 md:pr-6 sm:pr-6 pr-0">
                <div class="w-full rounded-md  bg-center bg-cover bg-no-repeat ">
                    <img src="{{asset('assets/images/italy.jpg')}}" class="h-[150px] w-full object-cover rounded-t-md" alt="">
                    <div class="w-full h-full bg-gray-100 rounded-b-md flex flex-col p-4">
                        <span class="text-gray-600 text-md">Cuba</span>
                        <div class="flex gap-2 my-1 text-secondary text-sm">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half"></i>
                        </div>
                        <div class="my-2 flex flex-col">
                            <span class="text-black text-sm">Drive the dream in Cuba</span>
                            <span class="text-black text-md">Cuba is brimming with boundless day trip adventure</span>
                        </div>
                        <span class="text-gray-600 text-sm">Starts From <span class="text-2xl text-secondary font-semibold"> £ 500</span></span>
                    </div>
                    <div class="pt-4 bg-gray-100">
                        <button class="w-full rounded-b-md bg-secondary  text-white px-4 py-2 text-lg font-semibold transition ease-in duration-2000 ">DETAILS</button>
                    </div>
                </div>
            </div>
            <div class="lg:pr-6 md:pr-6 sm:pr-6 pr-0">
                <div class="w-full rounded-md  bg-center bg-cover bg-no-repeat ">
                    <img src="{{asset('assets/images/italy.jpg')}}" class="h-[150px] w-full object-cover rounded-t-md" alt="">
                    <div class="w-full h-full bg-gray-100 rounded-b-md flex flex-col p-4">
                        <span class="text-gray-600 text-md">Cuba</span>
                        <div class="flex gap-2 my-1 text-secondary text-sm">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half"></i>
                        </div>
                        <div class="my-2 flex flex-col">
                            <span class="text-black text-sm">Drive the dream in Cuba</span>
                            <span class="text-black text-md">Cuba is brimming with boundless day trip adventure</span>
                        </div>
                        <span class="text-gray-600 text-sm">Starts From <span class="text-2xl text-secondary font-semibold"> £ 500</span></span>
                    </div>
                    <div class="pt-4 bg-gray-100">
                        <button class="w-full rounded-b-md bg-secondary  text-white px-4 py-2 text-lg font-semibold transition ease-in duration-2000 ">DETAILS</button>
                    </div>
                </div>
            </div>
            <div class="lg:pr-6 md:pr-6 sm:pr-6 pr-0">
                <div class="w-full rounded-md  bg-center bg-cover bg-no-repeat ">
                    <img src="{{asset('assets/images/italy.jpg')}}" class="h-[150px] w-full object-cover rounded-t-md" alt="">
                    <div class="w-full h-full bg-gray-100 rounded-b-md flex flex-col p-4">
                        <span class="text-gray-600 text-md">Cuba</span>
                        <div class="flex gap-2 my-1 text-secondary text-sm">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half"></i>
                        </div>
                        <div class="my-2 flex flex-col">
                            <span class="text-black text-sm">Drive the dream in Cuba</span>
                            <span class="text-black text-md">Cuba is brimming with boundless day trip adventure</span>
                        </div>
                        <span class="text-gray-600 text-sm">Starts From <span class="text-2xl text-secondary font-semibold"> £ 500</span></span>
                    </div>
                    <div class="pt-4 bg-gray-100">
                        <button class="w-full rounded-b-md bg-secondary  text-white px-4 py-2 text-lg font-semibold transition ease-in duration-2000 ">DETAILS</button>
                    </div>
                </div>
            </div>
            <div class="lg:pr-6 md:pr-6 sm:pr-6 pr-0">
                <div class="w-full rounded-md  bg-center bg-cover bg-no-repeat ">
                    <img src="{{asset('assets/images/italy.jpg')}}" class="h-[150px] w-full object-cover rounded-t-md" alt="">
                    <div class="w-full h-full bg-gray-100 rounded-b-md flex flex-col p-4">
                        <span class="text-gray-600 text-md">Cuba</span>
                        <div class="flex gap-2 my-1 text-secondary text-sm">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half"></i>
                        </div>
                        <div class="my-2 flex flex-col">
                            <span class="text-black text-sm">Drive the dream in Cuba</span>
                            <span class="text-black text-md">Cuba is brimming with boundless day trip adventure</span>
                        </div>
                        <span class="text-gray-600 text-sm">Starts From <span class="text-2xl text-secondary font-semibold"> £ 500</span></span>
                    </div>
                    <div class="pt-4 bg-gray-100">
                        <button class="w-full rounded-b-md bg-secondary  text-white px-4 py-2 text-lg font-semibold transition ease-in duration-2000 ">DETAILS</button>
                    </div>
                </div>
            </div>
            <div class="lg:pr-6 md:pr-6 sm:pr-6 pr-0">
                <div class="w-full rounded-md  bg-center bg-cover bg-no-repeat ">
                    <img src="{{asset('assets/images/italy.jpg')}}" class="h-[150px] w-full object-cover rounded-t-md" alt="">
                    <div class="w-full h-full bg-gray-100 rounded-b-md flex flex-col p-4">
                        <span class="text-gray-600 text-md">Cuba</span>
                        <div class="flex gap-2 my-1 text-secondary text-sm">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half"></i>
                        </div>
                        <div class="my-2 flex flex-col">
                            <span class="text-black text-sm">Drive the dream in Cuba</span>
                            <span class="text-black text-md">Cuba is brimming with boundless day trip adventure</span>
                        </div>
                        <span class="text-gray-600 text-sm">Starts From <span class="text-2xl text-secondary font-semibold"> £ 500</span></span>
                    </div>
                    <div class="pt-4 bg-gray-100">
                        <button class="w-full rounded-b-md bg-secondary  text-white px-4 py-2 text-lg font-semibold transition ease-in duration-2000 ">DETAILS</button>
                    </div>
                </div>
            </div>


        </div>

    </div>
{{--    special flight offers section ends here--}}


{{--    why choose us section --}}
    <div class="w-full lg:px-6 px-4 lg:py-20 md:py-16 sm:py-12 py-8">
        <div class="lg:w-[70%] md:w-[90%] w-full mx-auto">
            <div class="w-full flex flex-col items-center">
                <div class="w-max pb-2 border-b-[2px] border-b-secondary px-12 mb-2 flex">
                    <span class="font-medium lg:text-3xl text-2xl">Why Choose Us</span>
                </div>
            </div>
            <div class="w-full grid lg:grid-cols-3 md::grid-cols-3 sm:grid-cols-3 grid-cols-1 gap-2 lg:pt-12 md:pt-12 sm:pt-12 pt-6">
                <div class="w-full p-4">
                    <div class="flex flex-col items-center text-center lg:w-[70%] md:w-[90%] w-full mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80"  viewBox="0 0 680.83858 584.23207" data-src="https://cdn.undraw.co/illustrations/done_i0ak.svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img" artist="Katerina Limpitsouni" source="https://undraw.co/"><path id="b9ccae5a-ffdd-4f5c-9c1e-05af9f0f3372-198" data-name="Path 438" d="M310.70569,694.02818a24.21459,24.21459,0,0,0,23.38269-4.11877c8.18977-6.87441,10.758-18.196,12.8467-28.68191l6.17973-31.01657-12.9377,8.90837c-9.30465,6.40641-18.81826,13.01866-25.26011,22.29785s-9.25223,21.94707-4.07792,31.988" transform="translate(-259.58071 -157.88396)" fill="#e6e6e6"/><path id="f4ad1d06-bd03-4ced-a5c4-c19a65ab4ee5-199" data-name="Path 439" d="M312.7034,733.73874c-1.62839-11.86368-3.30382-23.88078-2.15884-35.87167,1.01467-10.64932,4.26373-21.04881,10.87831-29.57938a49.20592,49.20592,0,0,1,12.62466-11.44039c1.26215-.79648,2.42409,1.20354,1.16733,1.997a46.77949,46.77949,0,0,0-18.50446,22.32562c-4.02857,10.24607-4.67545,21.41582-3.98154,32.3003.41944,6.58218,1.31074,13.1212,2.20588,19.65251a1.19817,1.19817,0,0,1-.808,1.42251,1.16348,1.16348,0,0,1-1.42253-.808Z" transform="translate(-259.58071 -157.88396)" fill="#f2f2f2"/><path id="baf785f8-b4c6-42cf-85bd-8a16037845f7-200" data-name="Path 442" d="M324.42443,714.70229a17.82513,17.82513,0,0,0,15.53141,8.01862c7.8644-.37318,14.41806-5.85973,20.31713-11.07027l17.452-15.4088-11.54987-.55281c-8.30619-.39784-16.82672-.771-24.73813,1.79338s-15.20758,8.72639-16.654,16.91541" transform="translate(-259.58071 -157.88396)" fill="#e6e6e6"/><path id="a14e4330-7125-4e03-a856-d6453c34f6cc-201" data-name="Path 443" d="M308.10042,740.55843c7.83972-13.87142,16.93234-29.28794,33.1808-34.21552a37.02609,37.02609,0,0,1,13.95545-1.441c1.48189.128,1.11179,2.41174-.367,2.28454a34.39833,34.39833,0,0,0-22.27164,5.89215c-6.27994,4.27453-11.16975,10.21755-15.30781,16.51907-2.53511,3.86051-4.80576,7.88445-7.07642,11.903C309.48824,742.78513,307.36641,741.85759,308.10042,740.55843Z" transform="translate(-259.58071 -157.88396)" fill="#f2f2f2"/><path id="ac20a106-7eb8-4a45-8835-674ef3bf3222-202" data-name="Path 141" d="M935.3957,569.31654H503.18092a5.03014,5.03014,0,0,1-5.02359-5.02359V162.90754a5.03017,5.03017,0,0,1,5.02359-5.02358H935.3957a5.03017,5.03017,0,0,1,5.02359,5.02358V564.292a5.02922,5.02922,0,0,1-5.02359,5.02359Z" transform="translate(-259.58071 -157.88396)" fill="#fff"/><path id="a8878079-c7cd-406f-a434-8b15b914b9b4-203" data-name="Path 141" d="M935.3957,569.31654H503.18092a5.03014,5.03014,0,0,1-5.02359-5.02359V162.90754a5.03017,5.03017,0,0,1,5.02359-5.02358H935.3957a5.03017,5.03017,0,0,1,5.02359,5.02358V564.292a5.02922,5.02922,0,0,1-5.02359,5.02359ZM503.18092,159.88944a3.01808,3.01808,0,0,0-3.01152,3.01151V564.292a3.01808,3.01808,0,0,0,3.01152,3.01152H935.3957a3.01717,3.01717,0,0,0,3.01153-3.01152V162.90754a3.01809,3.01809,0,0,0-3.01153-3.01151Z" transform="translate(-259.58071 -157.88396)" fill="#cacaca"/><path id="af64f961-e9a2-4c53-a333-5060c7f850d2-204" data-name="Path 142" d="M707.41023,262.18528a3.41053,3.41053,0,0,0,0,6.82105H894.55305a3.41053,3.41053,0,0,0,0-6.82105Z" transform="translate(-259.58071 -157.88396)" fill="#e4e4e4"/><path id="baad4cfb-158d-4439-9cc3-22475bf47b22-205" data-name="Path 143" d="M707.41023,282.65037a3.41054,3.41054,0,0,0,0,6.82106h95.54019a3.41054,3.41054,0,0,0,0-6.82106Z" transform="translate(-259.58071 -157.88396)" fill="#e4e4e4"/><path id="f3456279-91e5-49ad-aa43-9838b26fb6ca-206" data-name="Path 142" d="M543.84146,392.7046a3.41054,3.41054,0,0,0,0,6.82106h350.8937a3.41054,3.41054,0,0,0,0-6.82106Z" transform="translate(-259.58071 -157.88396)" fill="#e4e4e4"/><path id="a3288adf-49f8-485f-8ae9-1e4f1a13d849-207" data-name="Path 143" d="M543.84146,413.1697a3.41054,3.41054,0,0,0,0,6.82106H803.13254a3.41054,3.41054,0,0,0,0-6.82106Z" transform="translate(-259.58071 -157.88396)" fill="#e4e4e4"/><path id="e63a5b48-5a7d-40a2-b9b0-6adec326348a-208" data-name="Path 142" d="M543.84146,433.17177a3.41054,3.41054,0,0,0,0,6.82106h350.8937a3.41054,3.41054,0,0,0,0-6.82106Z" transform="translate(-259.58071 -157.88396)" fill="#e4e4e4"/><path id="a1c669b4-dfc3-4cfa-a7be-66b71399844d-209" data-name="Path 143" d="M543.84146,453.63687a3.41054,3.41054,0,0,0,0,6.82106H803.13254a3.41054,3.41054,0,0,0,0-6.82106Z" transform="translate(-259.58071 -157.88396)" fill="#e4e4e4"/><path id="bfec50d1-ffb1-4de6-a9ef-a1085e40e016-210" data-name="Path 142" d="M543.84146,474.17177a3.41054,3.41054,0,0,0,0,6.82106h350.8937a3.41054,3.41054,0,0,0,0-6.82106Z" transform="translate(-259.58071 -157.88396)" fill="#e4e4e4"/><path id="bc9696ec-ec99-41d5-9116-3ad9737a38ac-211" data-name="Path 143" d="M543.84146,494.63687a3.41054,3.41054,0,0,0,0,6.82106H803.13254a3.41054,3.41054,0,0,0,0-6.82106Z" transform="translate(-259.58071 -157.88396)" fill="#e4e4e4"/><path d="M599.41943,324.82812a49,49,0,1,1,48.99952-49A49.05567,49.05567,0,0,1,599.41943,324.82812Z" transform="translate(-259.58071 -157.88396)" fill="#ff4216"/><path d="M450.67833,510.10041a12.24754,12.24754,0,0,0-14.953-11.36231l-16.19641-22.82521-16.27138,6.45945,23.32519,31.91237a12.31392,12.31392,0,0,0,24.09559-4.1843Z" transform="translate(-259.58071 -157.88396)" fill="#a0616a"/><path d="M419.11211,508.40888l-49.00774-63.57777L388.46714,387.12c1.34563-14.50936,10.425-18.56089,10.81135-18.72645l.5893-.25281,15.979,42.6119-11.73235,31.28625,28.79671,48.4319Z" transform="translate(-259.58071 -157.88396)" fill="#3f3d56"/><path d="M589.30794,312.41993a12.24758,12.24758,0,0,0-10.17219,15.78672l-21.50463,17.91269,7.69816,15.72326,30.01343-25.72272a12.31392,12.31392,0,0,0-6.03477-23.69995Z" transform="translate(-259.58071 -157.88396)" fill="#a0616a"/><path d="M590.06206,344.02244l-59.59835,53.77665-58.95815-13.84578c-14.57-.21979-19.31136-8.9587-19.50629-9.33113l-.29761-.568,41.2489-19.22578,32.0997,9.27828,46.06046-32.45509Z" transform="translate(-259.58071 -157.88396)" fill="#3f3d56"/><polygon points="227.248 568.437 243.261 568.436 250.878 506.672 227.245 506.673 227.248 568.437" fill="#a0616a"/><path d="M483.39733,721.74476h50.32614a0,0,0,0,1,0,0V741.189a0,0,0,0,1,0,0h-36.207a14.11914,14.11914,0,0,1-14.11914-14.11914v-5.32505A0,0,0,0,1,483.39733,721.74476Z" transform="translate(757.57348 1305.02654) rotate(179.99738)" fill="#2f2e41"/><polygon points="163.247 568.437 179.26 568.436 186.878 506.672 163.245 506.673 163.247 568.437" fill="#a0616a"/><path d="M419.397,721.74476H469.7231a0,0,0,0,1,0,0V741.189a0,0,0,0,1,0,0h-36.207A14.11914,14.11914,0,0,1,419.397,727.06981v-5.32505a0,0,0,0,1,0,0Z" transform="translate(629.57273 1305.02946) rotate(179.99738)" fill="#2f2e41"/><polygon points="157.552 342.991 158.858 434.42 160.165 554.584 188.899 551.972 203.267 386.094 221.553 551.972 251.218 551.972 254.206 384.788 243.757 348.216 157.552 342.991" fill="#2f2e41"/><path d="M473.37417,513.1531c-31.26533.00239-60.04471-14.14839-60.43319-14.34263l-.32273-.16136-2.62373-62.96637c-.76082-2.22509-15.74263-46.13091-18.28-60.08625-2.57083-14.13882,34.68842-26.54742,39.213-27.99853l1.02678-11.37405,41.75366-4.49918,5.292,14.5536,14.97942,5.6168a7.40924,7.40924,0,0,1,4.59212,8.7043l-8.32539,33.85619,20.33325,112.01266-4.37755.18946C495.709,511.39658,484.38425,513.1525,473.37417,513.1531Z" transform="translate(-259.58071 -157.88396)" fill="#3f3d56"/><circle cx="454.46738" cy="294.45965" r="30.06284" transform="matrix(0.87745, -0.47966, 0.47966, 0.87745, -345.12824, 96.19037)" fill="#a0616a"/><path d="M430.1166,323.56132c5.72926,6.10289,16.36927,2.82672,17.1158-5.51069a10.07153,10.07153,0,0,0-.01268-1.94523c-.38544-3.69311-2.519-7.046-2.008-10.94542a5.73974,5.73974,0,0,1,1.05046-2.687c4.56548-6.11359,15.28263,2.73444,19.59138-2.8,2.642-3.39359-.46364-8.73664,1.56381-12.52956,2.67591-5.006,10.60183-2.53654,15.57222-5.27809,5.53017-3.05032,5.1994-11.53517,1.55907-16.6961-4.43955-6.294-12.22348-9.65241-19.91044-10.13643s-15.32094,1.59394-22.4974,4.39069c-8.15392,3.17767-16.23969,7.56925-21.25749,14.739-6.10218,8.71919-6.68942,20.44132-3.6376,30.63677C419.10222,311.0013,425.43805,318.57766,430.1166,323.56132Z" transform="translate(-259.58071 -157.88396)" fill="#2f2e41"/><path d="M641.58071,741.9626h-381a1,1,0,0,1,0-2h381a1,1,0,0,1,0,2Z" transform="translate(-259.58071 -157.88396)" fill="#cacaca"/><path d="M596.58984,294.33545a3.488,3.488,0,0,1-2.38134-.93555l-16.15723-15.00732a3.49994,3.49994,0,0,1,4.76367-5.12891l13.68555,12.71192,27.07666-27.07618a3.5,3.5,0,1,1,4.94922,4.9502l-29.46094,29.46094A3.49275,3.49275,0,0,1,596.58984,294.33545Z" transform="translate(-259.58071 -157.88396)" fill="#fff"/></svg>
                        <span class="text-lg font-semibold text-black mt-4">Best price guarantee</span>
                        <p class="text-sm font-medium text-black/70">Find our low price to destinations worldwide guarantee   </p>
                    </div>
                </div>
                <div class="w-full p-4">
                    <div class="flex flex-col items-center text-center lg:w-[70%] md:w-[90%] w-full mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80"  viewBox="0 0 853.11745 565" data-src="https://cdn.undraw.co/illustrations/booking_1ztt.svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img" artist="Katerina Limpitsouni" source="https://undraw.co/"><path d="M993.2113,545.61c-6.16016,6.73-13.79981,11.74-22.08985,15.63h-.01025c-.77979.37-1.56006.73-2.3501,1.07h-.00977l-.01025.01-.00977-.01h-.00976a.00988.00988,0,0,1-.01025.01H968.701l-.00976-.01c-.00977.01-.00977.01-.02,0l-.00977.01-.01025-.01h-.00977c-.01025.01-.01025.01-.02,0h-.01025a139.77437,139.77437,0,0,1-17.06006,6.1,236.6512,236.6512,0,0,1-105.10986,5.49c-.66993-.12-1.33008-.24-2-.36V492.43c.66015-.28,1.33007-.56,2-.83q6.55516-2.715,13.27-4.99,9.65991-3.3,19.58984-5.66a212.16658,212.16658,0,0,1,66.04-5.34q6.0454.45,12.06006,1.3c8.39013,1.17005,17.18994,3.21,24.93017,6.75h.00977c1.13037.53,2.24023,1.08,3.34033,1.67005,6.87988,3.73,12.67969,8.86,16.21973,15.89a30.57258,30.57258,0,0,1,2.72021,7.99v.02c.19971.96.33985,1.93.44971,2.89C1006.33141,523.96,1001.42126,536.63,993.2113,545.61Z" transform="translate(-173.44128 -167.5)" fill="#f2f2f2"/><path d="M1005.07116,512.12a1.35827,1.35827,0,0,1-.29981.04q-25.69482,1.125-51.32031,3.34h-.02978c-.06983.01-.12989.01-.19971.02Q926.91149,517.8,900.7113,521.23c-.73975.1-1.47022.2-2.2002.29q-18.11939,2.415-36.16992,5.36-7.96509,1.305-15.8999,2.72c-.66993.12-1.33008.23-2,.36v-3.03c.66992-.13,1.33984-.24,2-.36q26.43016-4.68,53.04-8.17,6.69-.9,13.39991-1.7,19.37988-2.34,38.81982-4.04c.9502-.08,1.89014-.16,2.84033-.24q24.88477-2.115,49.83985-3.21a.939.939,0,0,1,.24023.02C1006.22155,509.37,1006.56139,511.77,1005.07116,512.12Z" transform="translate(-173.44128 -167.5)" fill="#fff"/><path d="M969.49743,559.36319c-21.33986.15682-42.36351-8.89183-57.45793-23.86936a77.82614,77.82614,0,0,1-11.18417-14.07c-1.01743-1.63171-3.39758.16767-2.38888,1.78539,11.7227,18.80042,31.24951,32.19306,52.77823,37.11736a80.81149,80.81149,0,0,0,18.63625,1.99418c1.91362-.01407,1.51718-2.97155-.3835-2.95758Z" transform="translate(-173.44128 -167.5)" fill="#fff"/><path d="M879.30114,480.95a1.6922,1.6922,0,0,1-1.25,1.13,65.2198,65.2198,0,0,0-14.07959,5.5,68.40608,68.40608,0,0,0-17.53027,13.25c-.27.27-.52979.54-.77979.82-.42041.44-.82031.89-1.22021,1.35v-4.36c.64013-.68,1.31005-1.35,2-1.99a71.91209,71.91209,0,0,1,13.27-10.04Q869.37121,483.31,879.30114,480.95Z" transform="translate(-173.44128 -167.5)" fill="#fff"/><path d="M984.1,482.87181a69.40228,69.40228,0,0,0-32.42171,28.58557,1.49955,1.49955,0,0,0,.79261,1.95385,1.5276,1.5276,0,0,0,1.95385-.79261A66.04852,66.04852,0,0,1,985.221,485.635c1.76525-.75416.64785-3.51882-1.12092-2.76316Z" transform="translate(-173.44128 -167.5)" fill="#fff"/><path d="M1025.02135,397.94c-2.32031,8.82-6.77,16.81-12.2998,24.1l-.01025.01c-.51026.68-1.04,1.37-1.58985,2.03v.01a139.27064,139.27064,0,0,1-12.41015,13.39,233.4288,233.4288,0,0,1-53.37012,38.13c-30.66992,16.02-64.94971,25.49-98.8999,26.03-.25977.01-.52.01-.77979.01-.41016.01-.82031.01-1.22021.01V456.21c.6499-1.24,1.31982-2.48,2-3.71a219.52414,219.52414,0,0,1,32.03027-43.82c.2998-.33.60986-.66.91992-.98q7.01953-7.41,14.71973-14.11a210.81877,210.81877,0,0,1,67.29-39.85c7.97021-2.86,16.71-5.15,25.21-5.6,1.25-.07,2.49023-.1,3.74023-.09,7.83008.11,15.33985,1.96,21.75,6.54a30.99854,30.99854,0,0,1,6.12012,5.81c.61963.77,1.18994,1.56,1.73975,2.37v.01C1026.58141,372.68,1028.12145,386.17,1025.02135,397.94Z" transform="translate(-173.44128 -167.5)" fill="#f2f2f2"/><path d="M1019.9613,362.77v.01a1.46123,1.46123,0,0,1-.23975.17q-22.20043,12.915-43.84033,26.77c-.02.01-.02979.02-.04981.03a1.73947,1.73947,0,0,1-.18017.11q-22.24512,14.25-43.85987,29.46c-.60009.42-1.21.85-1.81982,1.28q-14.9253,10.545-29.54,21.54-27.60059,20.79-53.99023,43.12c-.66993.56-1.33008,1.13-2,1.7v-3.89c.66015-.57,1.33007-1.14,2-1.7q10.11035-8.535,20.3999-16.83c2.05029-1.65,4.10986-3.3,6.16992-4.93q27.45043-21.855,56.13037-42.08h.00977q5.64037-3.975,11.2998-7.88,16.08033-11.07,32.52051-21.61c.78955-.51,1.58984-1.02,2.38965-1.53q21.0454-13.44,42.64013-26a1.48864,1.48864,0,0,1,.22022-.11C1019.72155,359.8,1021.13122,361.78,1019.9613,362.77Z" transform="translate(-173.44128 -167.5)" fill="#fff"/><path d="M1010.4094,421.13341c-18.82492,10.05171-41.64595,11.80452-61.97038,5.55268a77.82663,77.82663,0,0,1-16.44008-7.26456c-1.659-.97236-2.93089,1.72674-1.28615,2.69076,19.11437,11.20348,42.62774,13.99287,63.9802,8.35308a80.81169,80.81169,0,0,0,17.42988-6.891c1.6881-.90137-.03679-3.33625-1.71347-2.441Z" transform="translate(-173.44128 -167.5)" fill="#fff"/><path d="M869.56249,457.72184a68.55277,68.55277,0,0,1-.95241-15.86924,72.31889,72.31889,0,0,1,10.7807-34.15065q7.02818-7.4075,14.72332-14.11226a1.70457,1.70457,0,0,1-.58619,1.58483,65.45128,65.45128,0,0,0-9.91171,11.40756,69.12172,69.12172,0,0,0-11.08214,50.89232,1.21242,1.21242,0,0,1-.31374,1.14283A1.62455,1.62455,0,0,1,869.56249,457.72184Z" transform="translate(-173.44128 -167.5)" fill="#fff"/><path d="M987.809,346.61236a69.40222,69.40222,0,0,0-15.43281,40.37487,1.49954,1.49954,0,0,0,1.60951,1.36207,1.52761,1.52761,0,0,0,1.36207-1.60951,66.04848,66.04848,0,0,1,14.73742-38.20118c1.21291-1.48785-1.06086-3.41707-2.27619-1.92625Z" transform="translate(-173.44128 -167.5)" fill="#fff"/><path d="M884.25133,379.47v.01c-.06982.86005-.1499,1.71-.24023,2.56v.02a141.29936,141.29936,0,0,1-3.25,17.96c-.69971,2.9-1.46,5.78-2.28955,8.66-.1001.37-.21045.74-.32031,1.1v.01a229.52292,229.52292,0,0,1-8.73975,24.65,238.91849,238.91849,0,0,1-22.97021,42.22c-.64991.97-1.31983,1.94-2,2.9V322.96c.66992-.04,1.33007-.04,2-.02q.47973,0,.96.03a30.32184,30.32184,0,0,1,8.28027,1.61005c.93994.31,1.84961.66,2.75,1.05,10.90967,4.78,19.48,15.32,23.19971,26.91C884.42126,361.22,884.98131,370.35,884.25133,379.47Z" transform="translate(-173.44128 -167.5)" fill="#f2f2f2"/><path d="M858.43151,325.63a1.07625,1.07625,0,0,1-.11035.28q-6.07471,11.80509-11.87988,23.73c-.66993,1.37-1.33985,2.75-2,4.12v-6.8q.99023-2.04006,2-4.08,4.48535-9.09,9.12011-18.1a1.30351,1.30351,0,0,1,.12012-.2C856.60143,323.26,858.88122,324.16,858.43151,325.63Z" transform="translate(-173.44128 -167.5)" fill="#fff"/><path d="M884.57116,381.08c-.17969.32-.35986.63995-.56006.96a79.81637,79.81637,0,0,1-10.41992,14.24,85.91629,85.91629,0,0,1-27.1499,19.77c-.66016.32-1.33008.62-2,.9V413.7c.66992-.3,1.33984-.61,2-.93a80.866,80.866,0,0,0,35.37011-32.82,1.64488,1.64488,0,0,1,2.43994-.47A1.15274,1.15274,0,0,1,884.57116,381.08Z" transform="translate(-173.44128 -167.5)" fill="#fff"/><path d="M846.44128,200.5v76h-2v-.81h-669v.81h-2v-76a33.03244,33.03244,0,0,1,33-33h607A33.03244,33.03244,0,0,1,846.44128,200.5Z" transform="translate(-173.44128 -167.5)" fill="#ff4216"/><path d="M813.44128,167.5h-607a33.03244,33.03244,0,0,0-33,33v434a33.03244,33.03244,0,0,0,33,33h607a33.03244,33.03244,0,0,0,33-33v-434A33.03244,33.03244,0,0,0,813.44128,167.5Zm31,467a31.03964,31.03964,0,0,1-31,31h-607a31.03963,31.03963,0,0,1-31-31v-434a31.03963,31.03963,0,0,1,31-31h607a31.03964,31.03964,0,0,1,31,31Z" transform="translate(-173.44128 -167.5)" fill="#3f3d56"/><circle cx="136" cy="54.5" r="20" fill="#fff"/><circle cx="537" cy="54.5" r="20" fill="#fff"/><path d="M367.22591,445.00191H248.24968a19.033,19.033,0,0,1-19.01145-19.01144V369.75784a19.033,19.033,0,0,1,19.01145-19.01144H367.22591a19.033,19.033,0,0,1,19.01145,19.01144v56.23263A19.033,19.033,0,0,1,367.22591,445.00191Z" transform="translate(-173.44128 -167.5)" fill="#ff4216"/><path d="M569.62448,445.00191H450.64824a19.033,19.033,0,0,1-19.01144-19.01144V369.75784a19.033,19.033,0,0,1,19.01144-19.01144H569.62448a19.033,19.033,0,0,1,19.01144,19.01144v56.23263A19.033,19.033,0,0,1,569.62448,445.00191Z" transform="translate(-173.44128 -167.5)" fill="#ff4216"/><path d="M569.62448,590.29329H450.64824a19.60963,19.60963,0,0,1-19.58755-19.58755V514.47255A19.60962,19.60962,0,0,1,450.64824,494.885H569.62448A19.60962,19.60962,0,0,1,589.212,514.47255v56.23319A19.60962,19.60962,0,0,1,569.62448,590.29329Z" transform="translate(-173.44128 -167.5)" fill="#f2f2f2"/><path d="M366.83575,590.29329H247.85951A19.60963,19.60963,0,0,1,228.272,570.70574V514.47255A19.60962,19.60962,0,0,1,247.85951,494.885H366.83575a19.60962,19.60962,0,0,1,19.58755,19.58754v56.23319A19.60963,19.60963,0,0,1,366.83575,590.29329Z" transform="translate(-173.44128 -167.5)" fill="#f2f2f2"/><path d="M772.023,590.29329H653.0468a19.60962,19.60962,0,0,1-19.58754-19.58755V514.47255A19.60962,19.60962,0,0,1,653.0468,494.885H772.023a19.60962,19.60962,0,0,1,19.58755,19.58754v56.23319A19.60963,19.60963,0,0,1,772.023,590.29329Z" transform="translate(-173.44128 -167.5)" fill="#f2f2f2"/><path d="M772.023,445.115H653.0468a19.60962,19.60962,0,0,1-19.58754-19.58754V369.29426a19.60962,19.60962,0,0,1,19.58754-19.58755H772.023a19.60963,19.60963,0,0,1,19.58755,19.58755v56.23319A19.60962,19.60962,0,0,1,772.023,445.115Z" transform="translate(-173.44128 -167.5)" fill="#f2f2f2"/><circle cx="134.29652" cy="230.37416" r="32.26184" fill="#fff"/><path d="M304.5399,410.1813a3.34586,3.34586,0,0,1-2.01323-.66875l-.036-.027-7.58175-5.80486a3.3684,3.3684,0,1,1,4.09732-5.34756l4.91089,3.7656,11.6052-15.13487a3.36827,3.36827,0,0,1,4.72263-.62342l-.07215.098.074-.09655a3.3722,3.3722,0,0,1,.62341,4.72267l-13.6505,17.80224A3.36974,3.36974,0,0,1,304.5399,410.1813Z" transform="translate(-173.44128 -167.5)" fill="#ff4216"/><circle cx="337.27119" cy="229.91085" r="32.26184" fill="#fff"/><path d="M507.51457,409.718a3.3459,3.3459,0,0,1-2.01324-.66874l-.036-.027-7.58176-5.80486a3.3684,3.3684,0,1,1,4.09733-5.34756l4.91088,3.7656,11.6052-15.13488a3.3683,3.3683,0,0,1,4.72264-.62341l-.07215.098.074-.09654a3.37217,3.37217,0,0,1,.62341,4.72266l-13.65049,17.80224A3.36974,3.36974,0,0,1,507.51457,409.718Z" transform="translate(-173.44128 -167.5)" fill="#ff4216"/><path d="M728.75351,549.64979a10.74269,10.74269,0,0,0-2.18282-16.32737l-18.01117-96.17273-21.90458,8.12263,24.59219,91.98054a10.80091,10.80091,0,0,0,17.50638,12.39693Z" transform="translate(-173.44128 -167.5)" fill="#a0616a"/><path d="M553.96858,402.90038a11.40614,11.40614,0,0,1,.02187,1.79608l42.59,32.77955,12.0777-4.95957,9.86722,17.24911-20.528,10.85781a8.66955,8.66955,0,0,1-10.27652-1.62745l-42.571-43.8892a11.37563,11.37563,0,1,1,8.81868-12.20633Z" transform="translate(-173.44128 -167.5)" fill="#a0616a"/><polygon points="480.028 552.849 467.769 552.849 461.936 515.561 480.031 515.562 480.028 552.849" fill="#a0616a"/><path d="M656.59617,732.23337l-39.53051-.00146v-.5a15.38605,15.38605,0,0,1,15.38647-15.38623h.001l24.1438.001Z" transform="translate(-173.44128 -167.5)" fill="#2f2e41"/><polygon points="526.028 552.849 513.769 552.849 507.936 515.561 526.031 515.562 526.028 552.849" fill="#a0616a"/><path d="M702.59617,732.23337l-39.53051-.00146v-.5a15.38605,15.38605,0,0,1,15.38647-15.38623h.001l24.1438.001Z" transform="translate(-173.44128 -167.5)" fill="#2f2e41"/><path d="M638.6643,712.9793a4.49017,4.49017,0,0,1-4.47485-4.07226L623.50586,565.21758l.50488-.041,73.521-6.043.01978.52246L703.396,708.50664a4.49964,4.49964,0,0,1-4.49707,4.668H684.48339a4.475,4.475,0,0,1-4.44751-3.81543L660.45971,589.11407a.5.5,0,0,0-.99414.07226L658.57763,707.91a4.50454,4.50454,0,0,1-4.26318,4.46192l-15.40869.60058C638.82495,712.97735,638.74414,712.9793,638.6643,712.9793Z" transform="translate(-173.44128 -167.5)" fill="#2f2e41"/><circle cx="477.7719" cy="191.56438" r="24.56103" fill="#a0616a"/><path d="M655.96792,574.38164a121.03726,121.03726,0,0,1-31.76839-4.34179,4.51046,4.51046,0,0,1-3.2358-4.68653c3.30645-49.69336,4.08385-88.25683-2.86906-114.939-2.96342-11.37207-1.618-23.34912,3.69108-32.85986,7.98992-14.313,22.67547-23.02442,38.34016-22.72364h0q1.12287.02124,2.26805.08008c23.7729,1.22412,42.29735,22.73047,41.29428,47.9419l-4.78177,120.16845a4.43993,4.43993,0,0,1-2.81538,4.04395A114.24513,114.24513,0,0,1,655.96792,574.38164Z" transform="translate(-173.44128 -167.5)" fill="#3f3d56"/><path d="M622.13643,459.64084l-18.39762-22.54449a5.76149,5.76149,0,0,1,1.51427-8.59185l24.92148-14.85005a16.00071,16.00071,0,0,1,20.16015,24.85261l-19.47729,21.37306a5.7615,5.7615,0,0,1-8.721-.23928Z" transform="translate(-173.44128 -167.5)" fill="#3f3d56"/><path d="M680.01136,456.81194a5.7553,5.7553,0,0,1-3.16409-3.60611l-8.282-27.70526A16.00071,16.00071,0,0,1,697.50865,411.849L713.525,436.03743a5.7615,5.7615,0,0,1-2.36144,8.3986l-26.35426,12.3361A5.755,5.755,0,0,1,680.01136,456.81194Z" transform="translate(-173.44128 -167.5)" fill="#3f3d56"/><path d="M663.35014,379.21724l-18.206-4.16705c-1.87794-.42983-4.13413-1.24991-4.39457-3.15873-.35-2.56513,3.34149-4.35213,3.001-6.91854-.32983-2.48578-3.69254-2.80615-6.09035-3.53991a9.11065,9.11065,0,0,1-5.67236-11.34023c-2.59437,3.656-8.52155,3.96913-11.88655,1.00712s-4.01043-8.33613-1.98963-12.33777a14.28744,14.28744,0,0,1,10.724-7.2405,22.61663,22.61663,0,0,1,13.02306,2.42787c.26664-2.83339,3.80421-3.98207,6.65-4.00735a28.43074,28.43074,0,0,1,26.64315,19.4463c3.492,11.25212,1.15619,23.58635-8.6142,30.16993Z" transform="translate(-173.44128 -167.5)" fill="#2f2e41"/><path d="M846.72868,732.5h-381a1,1,0,1,1,0-2h381a1,1,0,1,1,0,2Z" transform="translate(-173.44128 -167.5)" fill="#3f3d56"/></svg>
                        <span class="text-lg font-semibold text-black mt-4">Easy booking</span>
                        <p class="text-sm font-medium text-black/70">Easy booking Search , Select and Save -  the fastest way to book your trip.</p>
                    </div>
                </div>
                <div class="w-full p-4">
                    <div class="flex flex-col items-center text-center lg:w-[70%] md:w-[90%] w-full mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80"  viewBox="0 0 660.67004 513.66796" data-src="https://cdn.undraw.co/illustrations/showing-support_ixfc.svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img" artist="Katerina Limpitsouni" source="https://undraw.co/"><polygon points="476.60745 95.10262 428.21881 95.10262 428.21881 17.88672 476.60745 33.3299 476.60745 95.10262" fill="#2f2e41"/><g><polygon points="485.19781 487.15109 475.21198 487.38674 469.64572 442.52422 484.38226 442.1755 485.19781 487.15109" fill="#a0616a"/><path d="M450.93774,507.98449h0c0,1.68692,1.19714,3.05447,2.67392,3.05447h19.82098s1.95056-7.8407,9.90323-11.21497l.54886,11.21497h10.22495l-1.23886-18.03317s2.73523-9.6478-2.94525-14.5795c-5.68054-4.93167-1.07953-4.24515-1.07953-4.24515l-2.23462-11.16116-15.45102,1.81693-.11362,17.52042-7.49826,17.39066-10.99814,5.43289c-.97888,.48355-1.61258,1.5853-1.61258,2.80356l-.00012,.00003,.00006,.00003Z" fill="#2f2e41"/></g><g><polygon points="434.01981 487.15109 424.034 487.38674 418.46774 442.52422 433.20428 442.1755 434.01981 487.15109" fill="#a0616a"/><path d="M399.75974,507.98449h0c0,1.68692,1.19714,3.05447,2.67392,3.05447h19.82098s1.95056-7.8407,9.90323-11.21497l.54886,11.21497h10.22498l-1.23886-18.03317s2.73523-9.6478-2.94525-14.5795c-5.68054-4.93167-1.07953-4.24515-1.07953-4.24515l-2.23462-11.16116-15.45102,1.81693-.11362,17.52042-7.49826,17.39066-10.99814,5.43289c-.97888,.48355-1.61258,1.5853-1.61258,2.80356l-.00012,.00003,.00003,.00003Z" fill="#2f2e41"/></g><path d="M479.69608,179.52535l-63.83182,38.09319-14.41364,58.6841,7.20682,181.19998h31.60785l7.00009-174.50793,14.01236,174.50793h32.10236l8.11957-195.96588c2.23615-14.24153,.47134-28.82428-5.09747-42.12126l-16.70612-39.89014v.00002Z" fill="#2f2e41"/><path d="M465.28244,63.18671l-26.76819-2.05909-7.20682,14.41364-20.59091,5.14773-5.14774,63.83183c10.18344,26.45763,16.57611,51.74094,10.29544,73.09772l78.24545-4.11818-13.06387-35.32477s-.32022-13.06387,6.8866-30.56615-4.11819-62.80227-4.11819-62.80227l-16.47272-4.11818-2.05908-17.50227h.00003Z" fill="#ff4216"/><g><path d="M285.04523,88.01722c2.60648,.08077,5.01508-.43385,6.90954-1.35578l24.78147,2.33778,.76745-11.82457-25.22097-1.09834c-1.83374-1.03748-4.20587-1.70024-6.81235-1.781-5.95447-.1845-10.87667,2.73767-10.99407,6.52688s4.61443,7.0105,10.56888,7.19503h.00004Z" fill="#a0616a"/><path d="M431.63758,124.1151s-.87513-37.66936-9.13728-43.3234c-3.40733-2.33173-55.79835-2.86144-57.70688-3.05922-11.7705-1.21982-20.14619-5.89291-30.05665-6.40513-24.15143-1.24822-36.36142,4.61263-36.36142,4.61263l-.4261,12.09401,133.68833,36.08112h0Z" fill="#ff4216"/></g><circle id="b" cx="449.61813" cy="38.77752" r="21.37412" fill="#a0616a"/><path d="M443.13531,6.9502c-4.59747,2.89805-7.96442,.82321-11.24823,2.2848-6.41595,2.85567-17.2478,22.91289-16.27109,31.31003,1.38333,11.89259,5.75455,12.38228,5.62411,20.91467-.20944,13.70108-1.29807,13.64424,1.50778,18.42823,3.12073,5.3209,20.79678,3.87619,24.07825-3.33932,.64737-1.42351-6.54358-.86368-14.48914-19.53917-3.98712-9.37141-1.36966-17.91088,0-21.62045,.32068-.86851,.46719-7.03431,1.15149-6.35002,6,6,9.36322,1.61404,12.98618,1.11071,7.43539-1.03298,13.03461,4.9656,15.29056,2.81206,1.67871-1.60251-.46268-5.83954,.3515-6.15137,.86807-.33248,3.74231,4.31568,5.62411,9.31494,1.21353,3.22392,1.82028,4.83586,1.75754,6.67864-.19379,5.69077-1.64487,21.82578-4.21591,26.56006-5.55215,10.22368,1.43896,14.08128,5.7977,13.336,3.52148-.60214,19.08893,1.76859,19.94095,.04809,.759-1.53272-.97482-17.29877-2.79672-31.95602-2.18982-17.61713-10.96655-33.80629-24.72836-45.02108-.80704-.65767-1.409-1.10891-1.7308-1.28132-.76224-.40838-8.62128-4.48915-14.4118-1.23027-2.13171,1.19972-1.78458,2.15685-4.21808,3.69082l-.00003-.00003Z" fill="#2f2e41"/><g><polygon points="176.13661 503.83715 164.2775 503.83599 158.63605 458.09316 176.13899 458.09438 176.13661 503.83715" fill="#ffb6b6"/><path d="M135.50577,503.56811h0c-.36925,.62189-.56409,2.62906-.56409,3.35226h0c0,2.22293,1.80202,4.02502,4.02502,4.02502h36.72632c1.51648,0,2.7459-1.22934,2.7459-2.74591v-1.52902s1.8168-4.59555-1.92369-10.2598c0,0-4.64894,4.43521-11.59566-2.51151l-2.04852-3.71106-14.82851,10.84482-8.21921,1.01172c-1.7982,.22131-3.39246-.03436-4.31743,1.52347h-.00014Z" fill="#2f2e41"/></g><g><polygon points="226.13661 503.83715 214.2775 503.83599 208.63605 458.09316 226.13899 458.09438 226.13661 503.83715" fill="#ffb6b6"/><path d="M185.50577,503.56811h0c-.36925,.62189-.56409,2.62906-.56409,3.35226h0c0,2.22293,1.80202,4.02502,4.02502,4.02502h36.72632c1.51648,0,2.7459-1.22934,2.7459-2.74591v-1.52902s1.8168-4.59555-1.92369-10.2598c0,0-4.64894,4.43521-11.59566-2.51151l-2.04852-3.71106-14.82851,10.84482-8.21921,1.01172c-1.7982,.22131-3.39246-.03436-4.31743,1.52347h-.00014Z" fill="#2f2e41"/></g><polygon points="228.48848 215.03898 141.48848 214.03898 132.48848 271.03896 154.48848 468.03896 183.33099 468.03896 189.98848 284.53896 201.98848 471.53896 231.51997 471.53896 244.98848 258.53896 228.48848 215.03898" fill="#2f2e41"/><g><path d="M597.3208,495.98068c2.06592,.12936,3.2077-2.43738,1.64465-3.93332l-.15552-.61819c.02045-.0495,.04108-.09897,.06177-.14838,2.08923-4.98181,9.16992-4.94742,11.24139,.04178,1.83856,4.42816,4.17944,8.86389,4.7558,13.54593,.25836,2.0668,.14215,4.17236-.31647,6.20047,4.30804-9.41058,6.57513-19.68661,6.57513-30.02078,0-2.59653-.14215-5.19302-.43274-7.78296-.23901-2.11853-.56842-4.22409-.99469-6.31033-2.30573-11.27719-7.29852-22.01825-14.50012-30.98962-3.46198-1.89249-6.34906-4.85065-8.09296-8.39651-.62646-1.2789-1.11737-2.65463-1.34991-4.05618,.39398,.05167,1.48553-5.94867,1.18842-6.3168,.54907-.83316,1.5318-1.24734,2.13147-2.06033,2.9823-4.0434,7.09119-3.3374,9.23621,2.15726,4.58221,2.31265,4.62659,6.14807,1.81494,9.83682-1.78876,2.34683-2.03455,5.52234-3.60406,8.03479,.1615,.2067,.32947,.40695,.49091,.61365,2.96106,3.79788,5.52209,7.88,7.68103,12.16858-.61017-4.7662,.29065-10.50821,1.82642-14.20959,1.74817-4.21732,5.0249-7.76917,7.91046-11.41501,3.466-4.37924,10.57336-2.46805,11.18402,3.08331,.00592,.05374,.01166,.10745,.01733,.16119-.42859,.24179-.84851,.49866-1.25867,.76993-2.33948,1.54724-1.53094,5.17386,1.24109,5.60175l.06274,.00967c-.15503,1.54367-.41986,3.07443-.80731,4.57938,3.70178,14.3158-4.2901,19.52991-15.70148,19.76413-.25189,.12915-.49738,.25833-.74927,.3811,1.15619,3.25525,2.07983,6.59448,2.7644,9.97891,.61359,2.99042,1.03992,6.01318,1.27887,9.04889,.29718,3.83005,.2713,7.6796-.0517,11.50323l.01941-.13562c.82025-4.21115,3.10669-8.14462,6.42657-10.87027,4.94562-4.06265,11.9328-5.55869,17.26825-8.82425,2.56836-1.57196,5.85944,.45944,5.41119,3.43707l-.02179,.14261c-.79443,.32288-1.56946,.69754-2.31873,1.11734-.42859,.24185-.84845,.49866-1.25867,.76993-2.33948,1.5473-1.53094,5.17392,1.24109,5.60181l.06281,.00964c.04523,.00647,.08398,.01294,.12909,.01944-1.36279,3.23581-3.26166,6.23923-5.63855,8.82922-2.31464,12.49713-12.25604,13.68283-22.8902,10.04355h-.00647c-1.1626,5.06378-2.86127,10.01126-5.04437,14.72623h-18.0202c-.06464-.20023-.12274-.40692-.18091-.60718,1.66638,.10342,3.3457,.0065,4.98627-.29703-1.33704-1.64059-2.67395-3.2941-4.01099-4.93463-.03229-.03229-.05817-.06461-.08398-.09689-.67816-.8396-1.36279-1.67282-2.04102-2.51245l-.00037-.00101c-.04248-2.57755,.26654-5.14661,.87878-7.63983l.00055-.00034,.00006-.00009Z" fill="#f2f2f2"/><path d="M0,512.47796c0,.66003,.53003,1.19,1.19006,1.19H659.48004c.65997,0,1.19-.52997,1.19-1.19,0-.65997-.53003-1.19-1.19-1.19H1.19006c-.66003,0-1.19006,.53003-1.19006,1.19Z" fill="#ccc"/></g><polygon points="198.98848 65.53897 168.02391 65.53897 161.98848 77.53897 132.48848 91.08621 142.98848 168.53898 134.98848 219.53898 234.92155 219.53898 225.98848 160.53898 237.98848 89.53897 204.98848 76.53897 198.98848 65.53897" fill="#e6e6e6"/><path d="M302.63635,253.22138c-1.35047-2.75524-1.96668-5.58707-1.89691-8.06518l-14.52297-25.43477,12.30503-6.55655,13.40724,26.50697c2.00147,1.46292,3.86228,3.6847,5.21277,6.43994,3.08516,6.29436,2.33906,12.98845-1.66643,14.95171-4.00549,1.96326-9.75355-1.54773-12.83871-7.84209v-.00003Z" fill="#ffb6b6"/><path d="M206.90837,86.12585s9.7973-10.08042,20.78782-3.06555c10.99052,7.01487,51.08317,78.79864,51.08317,78.79864l30.92691,61.71237-21.82984,10.17021-26.33701-59.09482-55.31011-59.5213,.67909-28.99957-.00002,.00002Z" fill="#e6e6e6"/><circle cx="182.19489" cy="31.72918" r="27.96054" fill="#ffb6b6"/><path d="M173.42004,54.23213c.12943,2.73928,.19415,4.10893-.2267,4.27447-1.26678,.49829-17.57945-9.13559-19.50031-15.5487-.89589-2.99112-.13937-3.05075-.7933-11.56027-.62544-8.13874-1.32661-8.2036-.49765-10.21717,.92139-2.238,3.73517-4.99537,9.36273-10.51014,2.12782-2.08517,3.19174-3.12776,3.86336-3.66681,2.03552-1.63376,9.61858-7.72008,16.57198-6.93375,2.9146,.32961,2.41647,1.49329,13.30482,7.39793,.93784,.50858,2.19548,1.17994,3.93233,1.95076,4.22417,1.87472,6.84479,2.36074,8.22437,2.88354,8.36092,3.16845,5.90727,20.81824,5.1888,20.91941-.26189,.03688-.33296-2.25184-1.70499-2.44106-1.23499-.17032-2.02139,1.56761-3.14391,1.63086-3.06528,.17273,.33879-2.76164-7.1635-6.02074-2.9165-1.26696,5.19873,4.44557-2.5266,4.35285-12.08104-.14501-4.35448,.6239-8.94247,3.03394-3.34595,1.75761-16.80617-7.91495-16.25926-4.82419,.38574,2.18,1.96767,2.80764,1.73946,5.24985-.22108,2.36604-1.99922,4.91621-3.5677,5.00992-1.44562,.08636-2.23788-1.94234-2.72009-1.74821-.52454,.21117,.05157,2.75692,1.18263,5.37242,1.43588,3.32038,2.29295,3.3464,3.05023,5.9001,.43558,1.46882,.49896,2.81088,.62579,5.495h-.00002Z" fill="#2f2e41"/><path d="M393.7945,245.01136l-180.15781-45.83693c-11.5164-2.93008-18.50203-14.68339-15.57195-26.19979l22.41268-88.09098c2.93008-11.5164,14.68339-18.50203,26.19979-15.57195l180.15781,45.83693c11.5164,2.93008,18.50203,14.68339,15.57195,26.19979l-22.41268,88.09097c-2.93008,11.5164-14.68339,18.50203-26.19979,15.57195h0Z" fill="#fff"/><path d="M393.7945,245.01136l-180.15781-45.83693c-5.7582-1.46504-10.38371-5.13589-13.68797-10.00331-4.80751-7.08182-6.06196-15.99784-3.95144-24.29302l18.79461-73.87046c2.11051-8.29518,7.47354-15.52754,15.081-19.45067,5.2287-2.69641,11.04613-3.7103,16.80433-2.24526l180.15781,45.83693c11.53495,2.9348,18.50675,14.66484,15.57195,26.19979l-22.41268,88.09097c-2.93008,11.5164-14.68339,18.50203-26.19979,15.57195h0ZM246.18408,71.24996c-10.46448-2.66244-7.72944,6.81486-10.39189,17.27934l-.00002,.00009c-12.98962,51.05451,13.87706,103.83737,62.80805,123.35791,26.41344,10.53738,48.38357,19.15044,48.38357,19.15044,36.58969,9.30939,73.79823-12.80567,83.10762-49.39536l10.37732-40.7871c2.66244-10.46448-3.66236-21.10595-14.12684-23.76839l-180.15781-45.83692Z" fill="#3f3d56"/><path d="M330.47886,140.66837l-.00006-.00002c-1.25546-10.32043-10.63949-17.66902-20.95986-16.4136l-.00006-.00002c-10.22249,1.24352-17.52398,10.46277-16.44173,20.66702l-.29938,.03641,4.54631,37.37348,34.39032-4.18341c1.08685,.05877,2.19263,.02961,3.31059-.10642l.00006,.00002c10.3204-1.25545,17.66902-10.63951,16.41356-20.95991v-.00004c-1.25545-10.32041-10.63949-17.669-20.95985-16.41356l.0001,.00009h0Z" fill="#ff4216"/><path d="M264.55969,493.7224h-.00003c-1.45657-3.7532-5.67987-5.61499-9.43306-4.15845h-.00002c-3.71759,1.44272-5.57742,5.5997-4.19696,9.32584l-.10889,.04224,5.27463,13.59152,12.50662-4.85361c.41348-.08173,.82568-.19824,1.23224-.35605h.00003c3.75317-1.45657,5.61499-5.6799,4.15842-9.43307v-.00003c-1.45657-3.7532-5.67987-5.61499-9.43304-4.15842l.00006,.00003Z" fill="#e6e6e6"/><path d="M544.55969,493.7224h0c-1.45654-3.7532-5.67987-5.61499-9.43304-4.15845h0c-3.71759,1.44272-5.57745,5.5997-4.19696,9.32584l-.10889,.04224,5.27466,13.59152,12.50665-4.85361c.41351-.08173,.82568-.19824,1.23224-.35605h0c3.75317-1.45657,5.61499-5.6799,4.15845-9.43307v-.00003c-1.45654-3.7532-5.67987-5.61499-9.43304-4.15842l.00006,.00003h-.00012Z" fill="#e6e6e6"/><circle cx="315.71168" cy="224.38595" r="24" fill="#ff4216"/><path d="M206.61116,127.053c-2.57521,1.66838-5.31372,2.61681-7.78256,2.84207l-23.52834,17.4431-7.97261-11.43854,24.72554-16.46272c1.21465-2.16116,3.19952-4.27285,5.77473-5.94123,5.88306-3.81141,12.61836-3.86623,15.04379-.12248,2.42543,3.74376-.3775,9.86837-6.26054,13.67979h-.00002v.00002Z" fill="#ffb6b6"/><path d="M151.50369,86.34849s-18-2-21,5-9,76.99999-9,76.99999l10,17,65.57875-49.63223-13.28033-13.28034-28.10548,13.28034-4.19292-49.36777h-.00002Z" fill="#e6e6e6"/><g><path d="M412.21765,108.9675c2.13898,2.19999,4.5975,3.73446,6.95416,4.50389l19.05283,22.24487,10.31979-9.37574-20.43829-21.55572c-.70285-2.37739-2.1676-4.87808-4.30658-7.07807-4.88651-5.02587-11.44046-6.57928-14.6387-3.46969-3.19827,3.10959-1.82968,9.70462,3.05679,14.73047h0Z" fill="#a0616a"/><path d="M475.0062,81.5578s17.99335,2.05887,19.3591,9.55119-8.37411,77.07058-8.37411,77.07058l-13.53482,14.34604-52.8786-62.99034,15.90439-9.98926,24.44208,19.20599,15.08194-47.1942h.00003Z" fill="#ff4216"/></g><circle cx="232.39196" cy="147.33817" r="15.00444" fill="#e6e6e6"/></svg>
                        <span class="text-lg font-semibold text-black mt-4">Award-winning support </span>
                        <p class="text-sm font-medium text-black/70">Receive free support from our friendly and reliable team. </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
{{--     why choose us section ends here--}}


{{--    holiday inspiration section--}}
    <div class="w-full lg:px-6 px-4 mt-8 bg-primary/20 lg:py-20 md:py-16 sm:py-12 py-8">
        <div class="w-full ">
            <div class="w-max pb-2 border-b-[2px] border-b-secondary pr-12 mb-2">
                <span class="font-medium lg:text-3xl text-2xl">Holidays to inspire you </span>
            </div>
            <span class="font-medium text-md text-black/50">Search Flights & Places Hire to our most popular destinations</span>
        </div>

        <div class="w-full grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-6 pt-12">
            @php
                $destinations = [
                     ['image' => 'india.jpg', 'title' => 'Agra, India', 'description' => 'Flights - Hotels - Resorts', 'link'=>'#'],
                     ['image' => 'berlin.jpg', 'title' => 'Berlin, Germany', 'description' => 'Flights - Hotels - Resorts', 'link'=>'#'],
                     ['image' => 'india2.jpg', 'title' => 'New Delhi, India', 'description' => 'Flights - Hotels - Resorts', 'link'=>'#'],
                     ['image' => 'italy.jpg', 'title' => 'Venice, Italy', 'description' => 'Flights - Hotels - Resorts', 'link'=>'#'],
                     ['image' => 'berlin.jpg', 'title' => 'Berlin, Germany', 'description' => 'Flights - Hotels - Resorts', 'link'=>'#'],
                     ['image' => 'india2.jpg', 'title' => 'New Delhi, India', 'description' => 'Flights - Hotels - Resorts', 'link'=>'#'],
                     ['image' => 'italy.jpg', 'title' => 'Venice, Italy', 'description' => 'Flights - Hotels - Resorts', 'link'=>'#'],
                     ['image' => 'berlin.jpg', 'title' => 'Berlin, Germany', 'description' => 'Flights - Hotels - Resorts', 'link'=>'#'],
                     ['image' => 'india2.jpg', 'title' => 'New Delhi, India', 'description' => 'Flights - Hotels - Resorts', 'link'=>'#'],
                     ['image' => 'italy.jpg', 'title' => 'Venice, Italy', 'description' => 'Flights - Hotels - Resorts', 'link'=>'#'],
                     ['image' => 'berlin.jpg', 'title' => 'Berlin, Germany', 'description' => 'Flights - Hotels - Resorts', 'link'=>'#'],
                     ['image' => 'india2.jpg', 'title' => 'New Delhi, India', 'description' => 'Flights - Hotels - Resorts', 'link'=>'#'],
                ];
            @endphp

            @foreach($destinations as $destination)
                <a href="{{$destination['link']}}" class="group">
                    <div class="w-full h-full bg-white rounded-md p-2 flex gap-2 group-hover:scale-90 transition ease-in duration-2000">
                        <div class="w-max ">
                            <img src="{{asset('assets/images/'.$destination['image'])}}" class="w-24 h-20 object-cover rounded-md" alt="">
                        </div>
                        <div class="flex flex-col gap-1 justify-center h-full ">
                            <span class="text-black font-semibold text-lg">{{$destination['title']}}</span>
                            <span class="text-black/70 font-medium text-sm ">{{$destination['description']}}</span>
                        </div>
                    </div>
                </a>
            @endforeach


        </div>

    </div>
{{--    holiday inspiration section ends here--}}


{{--    trip planner section--}}
    <div class="w-full lg:px-6 px-4 mt-8 lg:py-20 md:py-16 sm:py-12 py-8">
        <div class="w-full grid lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-2 gap-6 ">
                 <div class="w-full  h-full flex flex-col justify-between">
                     <div>
                         <div class="w-max pb-2 border-b-[2px] border-b-secondary pr-12 mb-2">
                             <span class="font-medium lg:text-3xl text-2xl">Trip Planners</span>
                         </div>
                         <span class="font-medium text-md text-black/50 mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, minima minus molestias placeat provident similique tenetur? Obcaecati quisquam temporibus tenetur rovident similique tenetur? Obcaecati quisquam temporibus tenetur.</span>

                     </div>

                    <div class="w-full pt-20 relative mt-4">
                        <div class=" h-10 w-10 bg-black absolute top-0 left-0 z-10"> </div>
                        <div class=" h-10 w-10 bg-ternary/50 absolute bottom-[0px] right-0 z-10"> </div>
                        <div class="px-4 py-3 absolute top-0 left-0 w-full z-20">
                            <button class="w-full p-4 rounded-md bg-secondary text-white font-semibold text-md border-[1px] border-secondary hover:bg-white hover:text-secondary transition ease-in duration-2000">View all trip plans</button>
                        </div>
                    </div>


                 </div>
            <a href="" class="group">
                <div class="w-full rounded-xl group-hover:scale-95 transition ease-in duration-2000">
                    <img src="{{asset('assets/images/india.jpg')}}" class="rounded-xl w-full lg:h-[350px] md:h-[350px] sm:h-[350px] object-cover" alt="">
                </div>
            </a>
            <a href="" class="group">
                <div class="w-full rounded-xl group-hover:scale-95 transition ease-in duration-2000">
                    <img src="{{asset('assets/images/italy.jpg')}}" class="rounded-xl w-full lg:h-[350px] md:h-[350px] sm:h-[350px] object-cover" alt="">
                </div>
            </a>
            <a href="" class="group">
                <div class="w-full rounded-xl group-hover:scale-95 transition ease-in duration-2000">
                    <img src="{{asset('assets/images/india2.jpg')}}" class="rounded-xl w-full lg:h-[350px] md:h-[350px] sm:h-[350px] object-cover" alt="">
                </div>
            </a>
            <a href="" class="group">
                <div class="w-full rounded-xl group-hover:scale-95 transition ease-in duration-2000">
                    <img src="{{asset('assets/images/london.jpg')}}" class="rounded-xl w-full lg:h-[350px] md:h-[350px] sm:h-[350px] object-cover" alt="">
                </div>
            </a>
        </div>

    </div>
{{--    trip planner section ends here--}}


{{--    testimonials section--}}
    <div class="w-full lg:px-6 px-4 mt-8 bg-white">
        <div class="w-full ">
            <div class="w-max pb-2 border-b-[2px] border-b-secondary pr-12 mb-2">
                <span class="font-medium lg:text-3xl text-2xl">Traveler's Experience</span>
            </div>
            <span class="font-medium text-md text-black/50">Here are awesome feedback from the travelers</span>
        </div>

        <div class="TravelersExperience py-12">
            <div class=" relative lg:pr-10 md:pr-10 sm:pr-10 pr-0">
                <img src="{{asset('assets/images/italy.jpg')}}" class="h-16 w-16 rounded-full object-cover absolute left-4 top-0" alt="">
              <div class="p-6 mt-8 bg-gray-100 rounded-md pt-12">
                  <p class="text-sm text-white/7">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad aperiam aspernatur commodi dicta esse explicabo fuga hic illum, impedit in laborum maiores maxime minus non odit perferendis, quas quibusdam quis quod ratione reiciendis repellendus veniam voluptatibus voluptatum? Accusantium modi nemo numquam qui vitae. Beatae facilis nemo tempora tempore voluptates!
                  </p>
                  <div class="flex gap-2 mt-4">
                      <i class="fa fa-star text-secondary text-md"></i>
                      <i class="fa fa-star text-secondary text-md"></i>
                      <i class="fa fa-star text-secondary text-md"></i>
                      <i class="fa fa-star text-secondary text-md"></i>
                      <i class="fa fa-star text-secondary text-md"></i>
                  </div>
                  <div  class="mt-4 flex flex-col ">
                      <span class="text-md text-black/80 font-bold">John Doe</span>
                      <span class="text-sm text-black/60 font-medium">Accountant</span>
                  </div>
              </div>

            </div>
            <div class=" relative lg:pr-10 md:pr-10 sm:pr-10 pr-0">
                <img src="{{asset('assets/images/italy.jpg')}}" class="h-16 w-16 rounded-full object-cover absolute left-4 top-0" alt="">
                <div class="p-6 mt-8 bg-gray-100 rounded-md pt-12">
                    <p class="text-sm text-white/7">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad aperiam aspernatur commodi dicta esse explicabo fuga hic illum, impedit in laborum maiores maxime minus non odit perferendis, quas quibusdam quis quod ratione reiciendis repellendus veniam voluptatibus voluptatum? Accusantium modi nemo numquam qui vitae. Beatae facilis nemo tempora tempore voluptates!
                    </p>
                    <div class="flex gap-2 mt-4">
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                    </div>
                    <div  class="mt-4 flex flex-col ">
                        <span class="text-md text-black/80 font-bold">John Doe</span>
                        <span class="text-sm text-black/60 font-medium">Accountant</span>
                    </div>
                </div>

            </div>
            <div class=" relative lg:pr-10 md:pr-10 sm:pr-10 pr-0">
                <img src="{{asset('assets/images/italy.jpg')}}" class="h-16 w-16 rounded-full object-cover absolute left-4 top-0" alt="">
                <div class="p-6 mt-8 bg-gray-100 rounded-md pt-12">
                    <p class="text-sm text-white/7">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad aperiam aspernatur commodi dicta esse explicabo fuga hic illum, impedit in laborum maiores maxime minus non odit perferendis, quas quibusdam quis quod ratione reiciendis repellendus veniam voluptatibus voluptatum? Accusantium modi nemo numquam qui vitae. Beatae facilis nemo tempora tempore voluptates!
                    </p>
                    <div class="flex gap-2 mt-4">
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                    </div>
                    <div  class="mt-4 flex flex-col ">
                        <span class="text-md text-black/80 font-bold">John Doe</span>
                        <span class="text-sm text-black/60 font-medium">Accountant</span>
                    </div>
                </div>

            </div>
            <div class=" relative lg:pr-10 md:pr-10 sm:pr-10 pr-0">
                <img src="{{asset('assets/images/italy.jpg')}}" class="h-16 w-16 rounded-full object-cover absolute left-4 top-0" alt="">
                <div class="p-6 mt-8 bg-gray-100 rounded-md pt-12">
                    <p class="text-sm text-white/7">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad aperiam aspernatur commodi dicta esse explicabo fuga hic illum, impedit in laborum maiores maxime minus non odit perferendis, quas quibusdam quis quod ratione reiciendis repellendus veniam voluptatibus voluptatum? Accusantium modi nemo numquam qui vitae. Beatae facilis nemo tempora tempore voluptates!
                    </p>
                    <div class="flex gap-2 mt-4">
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                    </div>
                    <div  class="mt-4 flex flex-col ">
                        <span class="text-md text-black/80 font-bold">John Doe</span>
                        <span class="text-sm text-black/60 font-medium">Accountant</span>
                    </div>
                </div>

            </div>
            <div class=" relative lg:pr-10 md:pr-10 sm:pr-10 pr-0">
                <img src="{{asset('assets/images/italy.jpg')}}" class="h-16 w-16 rounded-full object-cover absolute left-4 top-0" alt="">
                <div class="p-6 mt-8 bg-gray-100 rounded-md pt-12">
                    <p class="text-sm text-white/7">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad aperiam aspernatur commodi dicta esse explicabo fuga hic illum, impedit in laborum maiores maxime minus non odit perferendis, quas quibusdam quis quod ratione reiciendis repellendus veniam voluptatibus voluptatum? Accusantium modi nemo numquam qui vitae. Beatae facilis nemo tempora tempore voluptates!
                    </p>
                    <div class="flex gap-2 mt-4">
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                    </div>
                    <div  class="mt-4 flex flex-col ">
                        <span class="text-md text-black/80 font-bold">John Doe</span>
                        <span class="text-sm text-black/60 font-medium">Accountant</span>
                    </div>
                </div>

            </div>
            <div class=" relative lg:pr-10 md:pr-10 sm:pr-10 pr-0">
                <img src="{{asset('assets/images/italy.jpg')}}" class="h-16 w-16 rounded-full object-cover absolute left-4 top-0" alt="">
                <div class="p-6 mt-8 bg-gray-100 rounded-md pt-12">
                    <p class="text-sm text-white/7">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad aperiam aspernatur commodi dicta esse explicabo fuga hic illum, impedit in laborum maiores maxime minus non odit perferendis, quas quibusdam quis quod ratione reiciendis repellendus veniam voluptatibus voluptatum? Accusantium modi nemo numquam qui vitae. Beatae facilis nemo tempora tempore voluptates!
                    </p>
                    <div class="flex gap-2 mt-4">
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                    </div>
                    <div  class="mt-4 flex flex-col ">
                        <span class="text-md text-black/80 font-bold">John Doe</span>
                        <span class="text-sm text-black/60 font-medium">Accountant</span>
                    </div>
                </div>

            </div>
            <div class=" relative lg:pr-10 md:pr-10 sm:pr-10 pr-0">
                <img src="{{asset('assets/images/italy.jpg')}}" class="h-16 w-16 rounded-full object-cover absolute left-4 top-0" alt="">
                <div class="p-6 mt-8 bg-gray-100 rounded-md pt-12">
                    <p class="text-sm text-white/7">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad aperiam aspernatur commodi dicta esse explicabo fuga hic illum, impedit in laborum maiores maxime minus non odit perferendis, quas quibusdam quis quod ratione reiciendis repellendus veniam voluptatibus voluptatum? Accusantium modi nemo numquam qui vitae. Beatae facilis nemo tempora tempore voluptates!
                    </p>
                    <div class="flex gap-2 mt-4">
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                        <i class="fa fa-star text-secondary text-md"></i>
                    </div>
                    <div  class="mt-4 flex flex-col ">
                        <span class="text-md text-black/80 font-bold">John Doe</span>
                        <span class="text-sm text-black/60 font-medium">Accountant</span>
                    </div>
                </div>

            </div>
        </div>

    </div>
{{--    testimonials section ends here--}}


{{--    subscribe to our mailing list section--}}
    <div class="w-full px-4 lg:py-32 md:py-20 py-16 bg-center bg-cover bg-no-repeat" style="background-image: url({{asset('assets/images/background.png')}})">
        <div class="w-full lg:pl-64 md:pl-16">
            <div class="w-full flex flex-col">
               <span class="text-white font-bold lg:text-4xl md:text-2xl text-2xl">Subscribe To Our Mailing List</span>
               <span class="text-white font-bold lg:text-4xl md:text-2xl text-2xl">And Stay Up To Date</span>
               <span class="mt-4 font-medium text-md text-white/80">Subscribe to our newsletter and get exclusive deals you won't find anywhere else straight to your inbox!</span>
            </div>


            <div class="w-max p-2 bg-white/10 mt-12 rounded-md flex justify-between">
                <input type="text" class="lg:w-[400px] md:w-[400px] bg-transparent border-[0px] focus:outline-none focus:ring-0 text-sm text-white/80 placeholder-white/80" placeholder="Your Email.....">
                <button class="bg-white text-ternary p-4 px-8 rounded-md font-semibold text-sm hover:scale-105 transition ease-in duration-2000">Subscribe</button>
            </div>

        </div>
    </div>
{{--    subscribe to our mailing list section ends here--}}


</x-main.layout>
