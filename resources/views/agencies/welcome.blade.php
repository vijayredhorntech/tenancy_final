<x-main.layout>

{{-- Banner and search section --}}
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


         {{-- <div class="w-full absolute top-[60%]">
             <div class="lg:w-[80%] md:w-[90%] w-[95%] bg-white p-4 flex flex-col gap-2 rounded-t-md mx-auto">

                 <span class="font-semibold lg:text-3xl md:text-2xl sm:text-xl text-lg"> Discover, Explore the World with Ease</span>
                  <div class="flex gap-2 py-2 w-full border-b-[1px] border-b-ternary/20">
                      <Link href="{{ route('home') }}">
                      <button
                        class="service-part bg-black text-white hover:bg-black/80 hover:text-white py-1 px-4 font-medium text-sm rounded-md transition ease-in duration-200" data-tab-id>
                            Flights
                        </button>

                      </Link>
                      <Link href="{{ route('home') }}">
                      <button
                          class=" @if(Route::currentRouteName() == 'hotels') bg-ternary text-white @else text-ternary bg-transparent hover:bg-ternary/20 hover:text-black @endif  py-1 px-4 font-medium text-sm rounded-md transition ease-in duration-2000">
                          Hotels
                      </button>

                        <button
                          class=" @if(Route::currentRouteName() == 'hotels') bg-ternary text-white @else text-ternary bg-transparent hover:bg-ternary/20 hover:text-black @endif  py-1 px-4 font-medium text-sm rounded-md transition ease-in duration-2000">
                         Visa
                      </button>
                      </Link>
                  </div>
             </div>
             <div class="lg:w-[80%] md:w-[90%] w-full mx-auto bg-white rounded-b-md shadow-lg shadow-ternary/30 ">
                    <x-flight-search></x-flight-search>     
               
             </div>
         </div> --}}
         <div class="w-full absolute top-[60%]">
            <div class="lg:w-[80%] md:w-[90%] w-[95%] bg-white p-4 flex flex-col gap-2 rounded-t-md mx-auto">
                <span class="font-semibold lg:text-3xl md:text-2xl sm:text-xl text-lg">
                    Discover, Explore the World with Ease
                </span>

                {{-- Tabs --}}
                <div class="flex gap-2 py-2 w-full border-b border-b-ternary/20">
                    <button onclick="openTab(event, 'flights')"
                        class="tab-btn bg-black text-white hover:bg-black/80 hover:text-white py-1 px-4 font-medium text-sm rounded-md transition ease-in duration-200 active" data-id="flights">
                        Flights
                    </button>

                    <button onclick="openTab(event, 'hotels')"
                        class="tab-btn text-ternary bg-transparent hover:bg-ternary/20 hover:text-black py-1 px-4 font-medium text-sm rounded-md transition ease-in duration-2000" data-id="hotels">
                        Hotels
                    </button>

                    <button onclick="openTab(event, 'visa')"
                        class="tab-btn text-ternary bg-transparent hover:bg-ternary/20 hover:text-black py-1 px-4 font-medium text-sm rounded-md transition ease-in duration-2000" data-id="Visa">
                        Visa
                    </button>
                </div>
            </div>

            {{-- Tab Content --}}
            <div class="lg:w-[80%] md:w-[90%] w-full mx-auto bg-white rounded-b-md shadow-lg shadow-ternary/30">
                <div id="flights" class="tab-content p-4 block">
                     <x-flight-search></x-flight-search>     
                </div>

                <div id="hotels" class="tab-content p-4 hidden">
                         <x-hotel-search></x-hotel-search>     
                </div>

                <div id="visa" class="tab-content p-4 hidden">
           
                      <x-visa-search :countries="$countries" />

                </div>
            </div>
     </div>

     </div>

{{-- Rest of your existing content --}}
{{-- popular destinations section --}}
<div class="w-full lg:px-6 px-4 lg:mt-[300px] md:mt-[420px] sm:mt-[600px] mt-[650px] bg-white">
    <!-- ... rest of your existing content ... -->
</div>

<script>
    function openTab(evt, tabName) {
        // Hide all content
        document.querySelectorAll(".tab-content").forEach(el => {
            el.classList.add("hidden");
            el.classList.remove("block");
        });

        // Show the selected content
        document.getElementById(tabName).classList.remove("hidden");
        document.getElementById(tabName).classList.add("block");

        // Remove active styles from all buttons
        document.querySelectorAll(".tab-btn").forEach(btn => {
            btn.classList.remove("bg-black", "text-white");
            btn.classList.add("text-ternary", "bg-transparent");
        });

        // Add active styles to clicked button
        evt.currentTarget.classList.add("bg-black", "text-white");
        evt.currentTarget.classList.remove("text-ternary", "bg-transparent");
    }
</script>


</x-main.layout>