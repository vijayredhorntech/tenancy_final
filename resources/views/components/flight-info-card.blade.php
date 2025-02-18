@if($flightSearch['type'] == 'return')
    <div data-price="{{ $flightPrice }}" data-flight-time="{{ $flight['outbound']['totalFlightTime'] +  $flight['inbound']['totalFlightTime'] }}" data-airline="{{$flight['outbound']['airline']}}" data-stops="{{$flight['outbound']['stops']}}" class="flight-card grid lg:grid-cols-5 mb-8 bg-white rounded-[3px]  border-[1px] border-ternary/20 airline">
        <div class="w-full lg:col-span-4 flex flex-col gap-4 lg:border-r-[1px] border-r-[0px] lg:border-b-[0px] border-b-[1px] border-ternary/20 px-2 lg:py-2 py-4">
            <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-3 grid-cols-1">
                <div class="w-full p-2 flex items-center gap-2 lg:col-span-1 md:col-span-3 sm:col-span-3 col-span-1">
                    <img class="w-9 h-6 object-cover" src="https://goprivate.wspan.com/sharedservices/images/airlineimages/logoAir{{ $flight['outbound']['airline'] }}.gif" alt="">
                    <div class="flex flex-col">
                    {{--    <span class="text-md text-primaryDarkColor font-semibold ">{{ getAirlineName($flight['outbound']['airline'], $airlines) }}</span> --}}
                        <p class="text-black text-xs font-semibold">{{$flight['outbound']['airline']}}</p>
                    </div>

                </div>

                <div class="w-full p-2 flex flex-col items-center justify-center">
                                       <span class="text-secondary text-xs font-semibold text-center">
                                           <i class="fa-solid fa-plane-departure mr-2"></i>
                                           <span>{{$flight['outboundDepartureDate']['formatted']}}</span>
                                       </span>
                    <span class="font-semibold text-md text-black text-center"><i class="fa-regular fa-clock"></i> {{ $flight['outbound']['departureTime'] }}</span>
                    <p class="text-black/60 font-semibold text-xs text-center">{{ airportName($flight['outbound']['origin']) }}</p>
                </div>


                <div class="w-full py-2 flex flex-col justify-center items-center  lg:pb-0 md:pb-0 sm:pb-0 pb-8">
                    <div class="w-full flex  items-center">
                        <div class="h-10 w-10 flex-none rounded-full flex justify-center items-center bg-secondary/20 border-[1px] border-secondary/10">
                                <div class="w-6 h-6 rounded-full flex justify-center items-center bg-secondary">
                                    <i class="fa fa-plane-departure text-white text-[10px]"></i>
                                </div>
                        </div>
                        <div class="w-full grow  flex flex-col justify-center items-center text-center ">
                            <span class="font-semibold xl:text-sm lg:text-xs md:text-xs sm:text-xs text-sm text-primaryDarkColor"><i class="fa fa-hourglass"></i> {{ $flight['outbound']['totalTimeTakenFromOriginToDestination'] }}</span>
                              <div class="w-full bg-secondary/20 h-1"></div>
                            <span class="font-semibold xl:text-sm lg:text-xs md:text-xs sm:text-xs text-sm text-primaryDarkColor">{{ $flight['outbound']['stops'] == 1 ? 'Non Stop': (int)$flight['outbound']['stops'] .' Stops' }}</span>
                        </div>
                        <div class="w-6 h-6 flex-none rounded-full bg-secondary flex justify-center items-center">
                            <i class="fa fa-plane-arrival text-white text-[10px]"></i>
                        </div>
                    </div>
                </div>



                <div class="w-full p-2 flex flex-col items-center justify-center">
                                       <span class="text-secondary text-xs font-semibold text-center">
                                           <i class="fa-solid fa-plane-arrival mr-2"></i>
                                           <span>{{$flight['outboundArrivalDate']['formatted']}}</span>
                                       </span>
                    <span class="font-semibold text-md text-black text-center"><i class="fa-regular fa-clock"></i> {{ $flight['outbound']['arrivalTime'] }}</span>
                    <p class="text-black/60 font-semibold text-xs text-center">{{ airportName($flight['outbound']['destination']) }}</p>
                </div>
            </div>
            <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-3 grid-cols-1">
                <div class="w-full p-2 flex items-center gap-2 lg:col-span-1 md:col-span-3 sm:col-span-3 col-span-1">
                    <img class="w-9 h-6 object-cover" src="https://goprivate.wspan.com/sharedservices/images/airlineimages/logoAir{{ $flight['inbound']['airline'] }}.gif" alt="">
                    <div class="flex flex-col">
                      {{-- <span class="text-md text-primaryDarkColor font-semibold ">{{ getAirlineName($flight['inbound']['airline'], $airlines) }}</span>--}}
                        <p class="text-black text-xs font-semibold">{{ $flight['inbound']['airline'] }}</p>
                    </div>

                </div>
                <div class="w-full p-2 flex flex-col items-center justify-center">
                                       <span class="text-secondary text-xs font-semibold text-center">
                                           <i class="fa-solid fa-plane-departure mr-2"></i>
                                           <span>{{$flight['inboundDepartureDate']['formatted']}}</span>
                                       </span>
                    <span class="font-semibold text-md text-black text-center"><i class="fa-regular fa-clock"></i> {{ $flight['inbound']['departureTime'] }}</span>
                    <p class="text-black/60 font-semibold text-xs text-center">{{ airportName($flight['inbound']['origin']) }}</p>
                </div>
                <div class="w-full py-2 flex flex-col justify-center items-center lg:pb-0 md:pb-0 sm:pb-0 pb-8">
                    <div class="w-full flex  items-center">
                        <div class="h-10 w-10 flex-none rounded-full flex justify-center items-center bg-secondary/20 border-[1px] border-secondary/10">
                            <div class="w-6 h-6 rounded-full flex justify-center items-center bg-secondary">
                                <i class="fa fa-plane-departure text-white text-[10px]"></i>
                            </div>
                        </div>
                        <div class="w-full grow  flex flex-col justify-center items-center text-center ">
                            <span class="font-semibold xl:text-sm lg:text-xs md:text-xs sm:text-xs text-sm text-primaryDarkColor"><i class="fa fa-hourglass"></i> {{ $flight['inbound']['totalTimeTakenFromOriginToDestination'] }}</span>
                            <div class="w-full bg-secondary/20 h-1"></div>
                            <span class="font-semibold xl:text-sm lg:text-xs md:text-xs sm:text-xs text-sm text-primaryDarkColor">{{ $flight['inbound']['stops'] == 1 ? 'Non Stop': (int)$flight['inbound']['stops'] - 1 .' Stops' }}</span>
                        </div>
                        <div class="w-6 h-6 flex-none rounded-full bg-secondary flex justify-center items-center">
                            <i class="fa fa-plane-arrival text-white text-[10px]"></i>
                        </div>
                    </div>
                </div>
                <div class="w-full p-2 flex flex-col items-center justify-center">
                                       <span class="text-secondary text-xs font-semibold text-center">
                                           <i class="fa-solid fa-plane-arrival mr-2"></i>
                                           <span>{{$flight['inboundArrivalDate']['formatted']}}</span>
                                       </span>
                    <span class="font-semibold text-md text-black text-center"><i class="fa-regular fa-clock"></i> {{ $flight['inbound']['arrivalTime'] }}</span>
                    <p class="text-black/60 font-semibold text-xs text-center">{{ airportName($flight['inbound']['destination']) }}</p>
                </div>
            </div>
        </div>
        <div class="w-full flex flex-col justify-center items-center p-2 gap-2">
            <span class="text-primaryDarkColor font-bold text-2xl">{{ currencySymbol($flight['currency']) }} {{ $flightPrice }}</span>
            <form method="POST" action="{{ route('flight.pricing') }}"
                           :default="['flight'=>json_encode($flight),'flightSearch'=>$flightSearch]">
                <input name="flight" class="hidden">
                <input name="flightSearch" class="hidden">
                <input type="submit" class="showLoader font-semibold text-md bg-secondary/80 text-white/90 px-6 py-2 rounded-[2px] border-[1px] border-secondary/80 hover:bg-secondary hover:text-white transition ease-in duration-2000"
                                 label="Book Now"/>
            </form>


            <label for="{{ $id }}" class="text-xs animate-bounce cursor-pointer text-secondary mt-4 group">
                Flight Details
                <i class="fa fa-plane ml-1 group-hover:rotate-[-45deg] transition ease-in duration-2000"></i>
            </label>
        </div>
    </div>
  
@endif




@if($flightSearch['type'] == 'oneWay')
    <div data-price="{{ $flightPrice }}" data-flight-time="{{ $flight['totalFlightTime'] }}" data-airline="{{$flight['airline']}}" data-stops="{{$flight['stops']}}" class="flight-card grid lg:grid-cols-5 mb-4 bg-white rounded-[3px] shadow-lg shadow-black/10 border-[1px] border-black/20 airline">
        <div class="w-full lg:col-span-4 flex flex-col gap-4 lg:border-r-[1px] border-r-[0px] lg:border-b-[0px] border-b-[1px] border-primaryColor/30 px-2 lg:py-2 py-4">
            <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-3 grid-cols-1">
                <div class="w-full p-2 flex items-center gap-2 lg:col-span-1 md:col-span-3 sm:col-span-3 col-span-1">
                    <img class="w-9 h-6 object-cover" src="https://goprivate.wspan.com/sharedservices/images/airlineimages/logoAir{{ $flight['airline'] }}.gif" alt="">
                    <div class="flex flex-col">
                    {{--  <span class="text-md text-primaryDarkColor font-semibold ">{{ getAirlineName($flight['airline'], $airlines) }}</span>--}}
                        <p class="text-black text-xs font-semibold">{{$flight['airline']}}-{{$flight['flight']}}</p>
                    </div>

                </div>
                <div class="w-full p-2 flex flex-col items-center justify-center">
                                       <span class="text-secondary text-xs font-semibold text-center">
                                           <i class="fa-solid fa-plane-departure mr-2"></i>
                                           <span>{{$flight['departureDateFormatted']['formatted']}}</span>
                                       </span>
                    <span class="font-semibold text-md text-black text-center"><i class="fa-regular fa-clock"></i> {{ $flight['departureTime'] }}</span>
                    <p class="text-black/60 font-semibold text-xs text-center">{{ $flight['origin'] }}</p>
                </div>
                <div class="w-full py-2 flex flex-col justify-center items-center gap-3 lg:pb-0 md:pb-0 sm:pb-0 pb-8">
                    <div class="w-full flex  items-center">
                        <div class="h-10 w-10 flex-none rounded-full flex justify-center items-center bg-secondary/20 border-[1px] border-secondary/10">
                            <div class="w-6 h-6 rounded-full flex justify-center items-center bg-secondary">
                                <i class="fa fa-plane-departure text-white text-[10px]"></i>
                            </div>
                        </div>
                        <div class="w-full grow  flex flex-col justify-center items-center text-center ">
                            <span class="font-semibold xl:text-sm lg:text-xs md:text-xs sm:text-xs text-sm text-primaryDarkColor"><i class="fa fa-hourglass"></i> {{ $flight['flightDuration'] }}</span>
                            <div class="w-full bg-secondary/20 h-1"></div>
                            <span class="font-semibold xl:text-sm lg:text-xs md:text-xs sm:text-xs text-sm text-primaryDarkColor">{{ $flight['stops'] == 1 ? 'Non Stop': $flight['stops'] .' Stops' }}</span>
                        </div>
                        <div class="w-6 h-6 flex-none rounded-full bg-secondary flex justify-center items-center">
                            <i class="fa fa-plane-arrival text-white text-[10px]"></i>
                        </div>
                    </div>
                </div>
                <div class="w-full p-2 flex flex-col items-center justify-center">
                                       <span class="text-secondary text-xs font-semibold text-center">
                                           <i class="fa-solid fa-plane-arrival mr-2"></i>
                                           <span>{{$flight['departureDateFormatted']['formatted']}}</span>
                                       </span>
                    <span class="font-semibold text-md text-black text-center"><i class="fa-regular fa-clock"></i> {{ $flight['arrivalTime'] }}</span>
                    <p class="text-black/60 font-semibold text-xs text-center">{{ $flight['destination'] }}</p>
                </div>
            </div>
        </div>
        <div class="w-full flex flex-col justify-center items-center p-2 gap-2">
            <span class="text-primaryDarkColor font-bold text-2xl">{{ currencySymbol($flight['currency']) }} {{ $flightPrice }}</span>
            <form method="POST" action="{{ route('flight.pricing') }}" :default="['flight'=>json_encode($flight),'flightSearch'=>$flightSearch]">
                <input name="flight" class="hidden">
                <input name="flightSearch" class="hidden">
                <input type="submit"> class="showLoader font-semibold text-md bg-secondary/80 text-white/90 px-6 py-2 rounded-[2px] border-[1px] border-secondary/80 hover:bg-secondary hover:text-white transition ease-in duration-2000"
                                 label="Book Now"/>
            </form>
            <label for="{{ $id }}" class="text-xs animate-bounce cursor-pointer text-secondary mt-4 group">
                Flight Details
                <i class="fa fa-plane ml-1 group-hover:rotate-[-45deg] transition ease-in duration-2000"></i>
            </label>
        </div>
    </div>
   

@endif
