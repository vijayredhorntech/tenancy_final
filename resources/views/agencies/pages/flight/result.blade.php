<x-agency.layout>

<style>
    .h-max.mx-auto.md\:w-\[90\%\].w-full.relative.bg-white.rounded-md.pt-12.px-4.pb-0 {
    display: none;
}
</style>

    @if ($errors->any())
        <div class="rounded-md bg-red-300 py-4 px-8">
            <ol class="list-disc font-semibold">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ol>
        </div>
    @endif


    @php
        $selectedDepartureTimes = []; // Initialize here

        foreach ($flights as $flight) {
            if (isset($flight['departureTime']) && strtotime($flight['departureTime']) <= strtotime('06:00 AM')) {
                $selectedDepartureTimes[] = $flight['departureTime'];
            }
        }
    @endphp

    <!-- loader -->

    
<div id="loading_overlay1" class="hidden">
    <div class="fixed inset-0 justify-center flex h-screen w-full bg-ternary items-center z-50 opacity-90"> </div>

    <div class="z-50 fixed inset-0  justify-center  flex  h-screen w-full items-center p-4">
        <div class="w-max rounded-[10px]  bg-white gap-6 shadow-lg shadow-black/60 flex flex-col items-center px-6 py-12 ">
            <div class="relative flex justify-center items-center">
                <div class="absolute animate-spin rounded-full h-20 w-20 border-t-4 border-b-4 border-secondary"></div>
                <img src="https://www.svgrepo.com/show/509001/avatar-thinking-9.svg"  class="rounded-full h-16 w-16">
            </div>
             <div class="w-full mt-4 flex justify-center flex items-center flex-col">
               
              <span class="font-medium text-md text-secondary">Please wait. We are fetching data</span>
              <div class="flex">
              <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
                <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
                <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
                <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
              </div>
              </div>
            
        </div>
    </div>
</div>

        <div class=" w-full px-4 mx-auto  z-40 mt-4 lg:sticky" style=" top:85px;">
            <div class="w-full bg-white border-[1px] border-ternary/10 shadow-md shadow-ternary/10 rounded-[10px] p-2 flex xl:flex-row lg:flex-row flex-col gap-4">
                <div class="xl:w-[45%] lg:w-[50%] flex xl:flex-row lg:flex-row md:flex-row flex-col  bg-[#f4f6ff] rounded-[10px]">
                    <div class="xl:w-[45%] lg:w-[45%] flex gap-1 relative xl:p-4 lg:px-4 lg:py-2 p-4 ">
                        <div class="flex">
                            <i class="fa fa-plane-departure  xl:text-md lg:text-sm text-secondary font-bold mr-2"></i>
                            <span class=" text-ternary/80 font-bold xl:text-sm lg:text-[10px] text-sm">  {{ airportName($flightSearch['route'][0]['origin']) }}</span>
                        </div>
                    </div>
                    <div class="xl:w-[10%] lg:w-[10%] flex justify-center items-center">
                        <div class=" h-8 w-8 flex justify-center items-center bg-secondary border-[1px] border-secondary rounded-full">
                            <i class="fa-solid fa-arrow-right-arrow-left text-white"></i>
                        </div>
                    </div>
                    <div class="xl:w-[45%] lg:w-[45%] flex gap-1 xl:p-4 lg:px-4 lg:py-2 p-4 ">
                       <div class="flex">
                           <i class="fa fa-plane-arrival xl:text-md lg:text-sm text-secondary font-bold mr-2"></i>
                               <span class="text-ternary/80 font-bold xl:text-sm lg:text-[10px] text-sm"> {{ airportName($flightSearch['route'][0]['destination']) }}</span>
                       </div>
                    </div>
                </div>
                <div class="xl:w-[55%] lg:w-[50%] grid xl:grid-cols-7 lg:grid-cols-7 md:grid-cols-5 grid-cols-1 rounded-[10px] gap-4">
                    <div class="w-full bg-[#f4f6ff] rounded-[10px] xl:col-span-6 lg:col-span-6 md:col-span-4 col-span-1 grid xl:grid-cols-{{$flightSearch['type'] == 'return'?'4':'3'}} lg:grid-cols-{{$flightSearch['type'] == 'return'?'4':'3'}} md:grid-cols-{{$flightSearch['type'] == 'return'?'4':'3'}} grid-cols-{{$flightSearch['type'] == 'return'?'2':'2'}}">
                        <div class=" w-full  flex flex-col justify-center border-white border-r-[1px] lg:border-b-[0px] md:border-b-[0px] border-b-[1px] xl:p-4 lg:px-4 lg:py-2 p-4">
                            <span class="xl:text-xs lg:text-[10px] text-sm text-ternary/80 font-normal">Departure Date </span>
                            <span class="text-ternary/80 font-bold xl:text-sm lg:text-[10px] text-sm"> <i class="fa fa-calendar-days text-secondary font-bold mr-2 mt-1"></i> {{ $flightSearch['route'][0]['deptime'] }}</span>
                        </div>


                        @if ($flightSearch['type'] == 'return')
                            <div class=" w-full flex flex-col justify-center border-white lg:border-r-[1px] md:border-r-[1px]  lg:border-b-[0px] md:border-b-[0px] border-b-[1px] xl:p-4 lg:px-4 lg:py-2 p-4 ">
                                <span class="xl:text-xs lg:text-[10px] text-sm text-ternary/80 font-normal">Returning Date </span>
                                <span class="text-ternary/80 font-bold xl:text-sm lg:text-[10px] text-sm"> <i class="fa fa-calendar-days text-secondary font-bold mr-2 mt-1"></i> {{ $flightSearch['route'][1]['deptime'] }}</span>
                            </div>
                        @endif

                        
                        <div class=" w-full  flex flex-col justify-center border-white border-r-[1px] lg:border-b-[0px] md:border-b-[0px] border-b-[1px] xl:p-4 lg:px-4 lg:py-2 p-4">
                            <span class="xl:text-xs lg:text-[10px] text-sm text-ternary/80 font-normal">Passengers</span>
                            <span class="text-ternary/80 font-bold xl:text-sm lg:text-[10px] text-sm">
                                @if ($flightSearch['adult'])
                                    <i class="fa fa-person text-secondary font-bold mr-1"></i> {{ $flightSearch['adult'] }} Adult,
                                @endif
                                @if ($flightSearch['child'])
                                    <i class="fa fa-child text-secondary font-bold mr-1"></i> {{ $flightSearch['child'] }},
                                @endif
                                @if ($flightSearch['infant'])
                                    <i class="fa fa-wheelchair text-secondary font-bold mr-1"></i>{{ $flightSearch['infant'] }},
                                @endif
                            </span>
                        </div>

                        <div class=" w-full flex flex-col justify-center border-white xl:p-4 lg:px-4 lg:py-2 p-4">
                            <span class="xl:text-xs lg:text-[10px] text-sm text-ternary/80 font-normal"> Class</span>
                            <span class="text-ternary/80 font-bold xl:text-sm lg:text-[10px] text-sm"><i class="fa fa-plane text-secondary font-bold mr-1"></i> {{ $flightSearch['cabinClass'] }}</span>

                        </div>
                    </div>
                    <div class="w-full bg-secondary/80 hover:bg-secondary transition ease-in duration-2000 rounded-[10px] xl:p-2 lg:p-2 md:p-2 p-4" id="modifySearch">
                        <label for="modify-search" class="w-full h-full text-white font-normal xl:text-sm lg:text-[10px] flex xl:flex-col lg:flex-col md:flex-col flex-row justify-center items-center cursor-pointer">
                            <span>Modify</span>
                            <span>Search</span>
                        </label>
                    </div>

                </div>
            </div>

        </div>
      
    </div>



    {{-- @dd($flights) --}}
    @php
        $departureTimes = [];

        foreach ($flights as $flight) {
            // Check if the 'departureTime' key exists in the current flight
            if (isset($flight['departureTime'])) {
                // Add the 'departureTime' value to the $departureTimes array
                $departureTimes[] = $flight['departureTime'];
            }
        }
        // dd($departureTimes);
    @endphp




    <div class="h-max mx-auto md:w-[90%] w-full relative bg-white rounded-md pt-12 px-4 pb-0 ">
                <label for="modify-search">
                    <div class=" absolute right-2 top-2 bg-secondary/20 border-[1px] border-secondary/40 text-secondary flex justify-center items-center rounded-full text-center drop-shadow-2xl h-10 w-10 ">
                        <i class="fa fa-xmark"></i>
                    </div>
                </label>

                <x-flight-search :defaults="[
                'departureDate' => $flightSearch['route'][0]['deptime'],
                'returnDate' => $flightSearch['type'] == 'return' ? $flightSearch['route'][1]['deptime'] : '',
                'origin' => airportName($flightSearch['route'][0]['origin']),
                'destination' => airportName($flightSearch['route'][0]['destination']),
                'directFlight' => $flightSearch['directFlight'],
                'fareType' => $flightSearch['fareType'],
                'type' => $flightSearch['type'],
                'adult' => $flightSearch['adult'],
                'child' => $flightSearch['child'],
                'infant' => $flightSearch['infant'],
                'cabinClass' => $flightSearch['cabinClass'],
                'currency' => $flightSearch['currency'],
                'preferredAirline' => $flightSearch['preferredAirline'],
            ]"></x-flight-search>
            </div>


    @if ($flights->count())

        <section class="w-full px-4 mx-auto py-8 bg-white rounded-[3px] grid xl:grid-cols-5 lg:grid-cols-4 gap-8" style="position: relative">

            {{-- section left div starts here --}}
            <div class="w-full " style="position: relative;">
                <div class="bg-white rounded-md border-[1px] border-ternary/20 shadow-lg shadow-ternary/10 p-4" style="position: sticky; top: 190px;">
                        <div class="w-full text-black font-semibold text-lg ">
                        <span>Filter Result</span>
                    </div>

                        <div class="bg-secondary/10 px-3 py-1.5 flex justify-between items-center mt-4">
                            <span class="font-semibold text-md text-secondary">Stops </span>

                            <div id="flightStopFiltersShow" class="h-6 w-6 flex justify-center items-center rounded-full border-[1px] text-secondary border-secondary cursor-pointer hover:bg-secondary hover:text-white transition ease-in duration-2000 hidden"
                                 onclick="
                              document.getElementById('flightStopFilters').classList.toggle('hidden')
                                document.getElementById('flightStopFiltersShow').classList.toggle('hidden')
                                document.getElementById('flightStopFiltershide').classList.toggle('hidden')">
                                <i class="fa-solid fa-plus text-sm font-bold"></i>
                            </div>
                            <div id="flightStopFiltershide" class="h-6 w-6 flex justify-center items-center rounded-full border-[1px] text-secondary border-secondary cursor-pointer hover:bg-secondary hover:text-white transition ease-in duration-2000 "
                                 onclick="
                              document.getElementById('flightStopFilters').classList.toggle('hidden')
                                document.getElementById('flightStopFiltersShow').classList.toggle('hidden')
                                document.getElementById('flightStopFiltershide').classList.toggle('hidden')">
                                <i class="fa-solid fa-minus text-sm font-bold"></i>
                            </div>
                        </div>
                        <div id="flightStopFilters" class="bg-white p-3 flex flex-col gap-2 ">
                            <div class="flex items-center">
                                <input type="checkbox" class="stopsCheckbox rounded-sm border-secondary text-secondary shadow-sm focus:border-secondary focus:ring-0 focus:outline-none disabled:opacity-50" value="1">
                                <span class="ml-2 text-sm font-semibold text-black">Non Stop</span>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="stopsCheckbox rounded-sm border-secondary text-secondary shadow-sm focus:border-secondary focus:ring-0 focus:outline-none disabled:opacity-50" value="3">
                                <span class="ml-2 text-sm font-semibold text-black">1 Stop</span>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="stopsCheckbox rounded-sm border-secondary text-secondary shadow-sm focus:border-secondary focus:ring-0 focus:outline-none disabled:opacity-50" value="2">
                                <span class="ml-2 text-sm font-semibold text-black">2 Stop</span>
                            </div>
                        </div>

                        @foreach ($departureTimes as $time)
                                @if (strtotime($time) <= strtotime('06:00 AM'))
                                    <div class="flex items-center mt-3">
                                        @php
                                            $selectedDepartureTimes[] = $time;
                                        @endphp
                                    </div>
                                @endif
                            @endforeach


                        <div class="bg-secondary/10 px-3 py-1.5 flex justify-between items-center mt-2">
                            <span class="font-semibold text-md text-secondary">Departure </span>
                            <div id="departureFilterShow" class="h-6 w-6 flex justify-center items-center rounded-full border-[1px] text-secondary border-secondary cursor-pointer hover:bg-secondary hover:text-white transition ease-in duration-2000 hidden"
                                 onclick="
                                      document.getElementById('departureFilter').classList.toggle('hidden')
                                        document.getElementById('departureFilterShow').classList.toggle('hidden')
                                        document.getElementById('departureFilterhide').classList.toggle('hidden')">
                                <i class="fa-solid fa-plus text-sm font-bold"></i>
                            </div>
                            <div id="departureFilterhide" class="h-6 w-6 flex justify-center items-center rounded-full border-[1px] text-secondary border-secondary cursor-pointer hover:bg-secondary hover:text-white transition ease-in duration-2000 "
                                 onclick="
                                      document.getElementById('departureFilter').classList.toggle('hidden')
                                        document.getElementById('departureFilterShow').classList.toggle('hidden')
                                        document.getElementById('departureFilterhide').classList.toggle('hidden')">
                                <i class="fa-solid fa-minus text-sm font-bold"></i>
                            </div>
                        </div>
                        <div id="departureFilter" class="bg-white p-3 flex flex-col gap-2 ">
                            <div class="flex items-center">
                                <input value="{{ json_encode($selectedDepartureTimes) }}"  type="checkbox" class="rounded-sm border-secondary text-secondary shadow-sm focus:border-secondary focus:ring-0 focus:outline-none disabled:opacity-50">
                                <span class="ml-2 text-sm font-semibold text-black">Before 6AM</span>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="rounded-sm border-secondary text-secondary shadow-sm focus:border-secondary focus:ring-0 focus:outline-none disabled:opacity-50">
                                <span class="ml-2 text-sm font-semibold text-black">6AM - 12Noon </span>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="rounded-sm border-secondary text-secondary shadow-sm focus:border-secondary focus:ring-0 focus:outline-none disabled:opacity-50">
                                <span class="ml-2 text-sm font-semibold text-black">12Noon - 6PM</span>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="rounded-sm border-secondary text-secondary shadow-sm focus:border-secondary focus:ring-0 focus:outline-none disabled:opacity-50">
                                <span class="ml-2 text-sm font-semibold text-black">After 6 PM </span>
                            </div>

                        </div>


                        <div class="bg-secondary/10 px-3 py-1.5 flex justify-between items-center mt-2">
                            <span class="font-semibold text-md text-secondary">Price Range  </span>
                            <div id="flightPriceFilterShow" class="h-6 w-6 flex justify-center items-center rounded-full border-[1px] text-secondary border-secondary cursor-pointer hover:bg-secondary hover:text-white transition ease-in duration-2000"
                                 onclick="
                              document.getElementById('flightPriceFilter').classList.toggle('hidden')
                                document.getElementById('flightPriceFilterShow').classList.toggle('hidden')
                                document.getElementById('flightPriceFilterhide').classList.toggle('hidden')">
                                <i class="fa-solid fa-plus text-sm font-bold"></i>
                            </div>
                            <div id="flightPriceFilterhide" class="h-6 w-6 flex justify-center items-center rounded-full border-[1px] text-secondary border-secondary cursor-pointer hover:bg-secondary hover:text-white transition ease-in duration-2000 hidden"
                                 onclick="
                              document.getElementById('flightPriceFilter').classList.toggle('hidden')
                                document.getElementById('flightPriceFilterShow').classList.toggle('hidden')
                                document.getElementById('flightPriceFilterhide').classList.toggle('hidden')">
                                <i class="fa-solid fa-minus text-sm font-bold"></i>
                            </div>
                        </div>
                        <div id="flightPriceFilter" class="bg-white p-3 flex flex-col gap-2 hidden">
                            <div class="flex flex-col justify-center">
                                <span class="text-sm font-semibold text-black">{{ currencySymbol($flightSearch['currency']) }}
                                    {{ $cheapestPrice }} - {{ $costliestPrice }}</span>
                                <input type="range" min="{{ $cheapestPrice }}" max="{{ $costliestPrice }}" value="{{ $costliestPrice }}" class="range [--range-shdw:yellow] mt-2" id="priceSlider" />
                            </div>
                        </div>


                        <div class="bg-secondary/10 px-3 py-1.5 flex justify-between items-center mt-2">
                            <span class="font-semibold text-md text-secondary">Airlines</span>
                            <div id="airlineFilterShow" class="h-6 w-6 flex justify-center items-center rounded-full border-[1px] text-secondary border-secondary cursor-pointer hover:bg-secondary hover:text-white transition ease-in duration-2000"
                                 onclick="
                              document.getElementById('airlineFilter').classList.toggle('hidden')
                                document.getElementById('airlineFilterShow').classList.toggle('hidden')
                                document.getElementById('airlineFilterhide').classList.toggle('hidden')">
                                <i class="fa-solid fa-plus text-sm font-bold"></i>
                            </div>
                            <div id="airlineFilterhide" class="h-6 w-6 flex justify-center items-center rounded-full border-[1px] text-secondary border-secondary cursor-pointer hover:bg-secondary hover:text-white transition ease-in duration-2000 hidden"
                                 onclick="
                              document.getElementById('airlineFilter').classList.toggle('hidden')
                                document.getElementById('airlineFilterShow').classList.toggle('hidden')
                                document.getElementById('airlineFilterhide').classList.toggle('hidden')">
                                <i class="fa-solid fa-minus text-sm font-bold"></i>
                            </div>
                        </div>
                        <div id="airlineFilter" class="bg-white p-3 flex flex-col gap-2 hidden h-[300px] overflow-y-auto">
                          @foreach ($uniqueAirlines as $airline)
                            <div class="flex items-center flex items-center justify-between">
                                <div>
                                    <input type="checkbox" value="{{ $airline }}" class="airlinesCheckbox rounded-sm border-secondary text-secondary shadow-sm focus:border-secondary focus:ring-0 focus:outline-none disabled:opacity-50" >
                                    <span class="ml-2 text-sm font-semibold text-black"></span>
                                </div>
                                <div>
                                    <img class="ml-4 w-6 h-auto object-cover"
                                         src="https://goprivate.wspan.com/sharedservices/images/airlineimages/logoAir{{ $airline }}.gif"
                                         alt="">
                                </div>
                            </div>
                          @endforeach
                        </div>
                </div>
            </div>
            {{-- section left div ends here --}}

            {{--       section right div starts here --}}
            <div class="w-full xl:col-span-4 lg:col-span-3">

                <div class="w-full  flex flex-wrap">
                    <div class="px-2 font-semibold text-md text-black border-r-[1px] border-ternary flex items-center">
                        <i class="fa-solid fa-plane-departure mr-2 text-lg"></i> Flights ({{ $flights->count() }} <span class="text-xs"> Found </span>)
                    </div>
                    <div class="px-2 font-semibold text-md text-black flex items-center">
                        <i class="fa-solid fa-sterling-sign mr-2 text-lg"></i> Cheapest ({{ $cheapestPrice }}<span class="text-xs"> {{ currencySymbol($flightSearch['currency']) }}  </span>)
                    </div>
                </div>


                <div class="flights-container mt-4">
                @foreach ($flights as $flight)
                        <x-flight-info-card :flight="$flight" :flightSearch="$flightSearch" :id="uniqid()" :custom-settings="$customSettings"
                                            :default-settings="$defaultSettings" :airlines="$airlines" />
                    @endforeach
                </div>
            </div>
            {{--   section right div ends here --}}
        </section>
    @else
   
        <div class="w-full px-2 mx-auto pt-6 rounded-[3px]">
                <img src="{{ asset('assets/images/no_results.jpg') }}" alt="No Flights Found" class="rounded-md m-auto">
        </div>
    @endif

    <script> 
        jQuery(document).ready(function (){
               
               jQuery(document).on("click",".showLoader",function (){
      
                jQuery("#loading_overlay1").show(); 
            
                // setTimeout(function () {
                //     $('#loading_overlay1').hide();
                // }, 20000); 
               })
            // jQuery(".modify_flight").hide(); 

            // jQuery("#modifySearch").on("click",function (){
            //     jQuery(".modify_flight").show(); 
            // });

            
        });

    </script> 
</x-agency.layout>

