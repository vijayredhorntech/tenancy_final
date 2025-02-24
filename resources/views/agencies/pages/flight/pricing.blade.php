<x-agency.layout>

    @if ($errors->any())
        <div class="rounded-md bg-red-300 py-4 px-8">
            <ol class="list-disc font-semibold">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ol>
        </div>
    @endif

    <section class=" w-full mx-auto grid lg:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-8 py-6 px-4">
        <div class="w-full h-max bg-white lg:col-span-3 md:col-span-2 col-span-1 ">
            <div class="p-2 font-semibold  text-black text-lg ">
                <span>ITINERARY DETAILS </span>
            </div>
            <div class="w-full p-2 ">
           
                @foreach ($flightSearch->route as $route)
                      
                    <i class="fa-solid fa-plane-{{ $loop->iteration / 2 == 1 ? 'arrival' : 'departure' }} mr-2 text-md text-secondary"></i>
                    <span class="text-secondary text-sm font-semibold"> {{ airport(strtoupper($route->origin), $airports)->airport }}
                    - {{ airport(strtoupper($route->destination), $airports)->airport }}
                    | {{ \Carbon\Carbon::parse($route->deptime)->format('d M Y') }}</span>
                    <br />
                @endforeach
            </div>
            <div class="mt-4">
                @foreach ($details[0]['journey'] as $journey)
                    <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-3 grid-cols-1 bg-white border-[1px] border-ternary/20">
                        <div class="w-full p-2 flex items-center gap-2 lg:col-span-1 md:col-span-3 sm:col-span-3 col-span-1">
                            <img class="w-9 h-6 object-cover" src="https://goprivate.wspan.com/sharedservices/images/airlineimages/logoAir{{ $journey['Carrier'] }}.gif" alt="">
                            <div class="flex flex-col">
                                <span class="text-md text-primaryDarkColor font-semibold ">{{ $journey['Carrier'] }}</span>
                                <p class="text-black text-xs font-semibold">Class: {{ $journey['ClassOfService'] }}</p>
                                <p class="text-black text-xs font-semibold">({{ $journey['Carrier'] }}-{{ $journey['FlightNumber'] }})</p>
                            </div>
                        </div>
                        <div class="w-full p-2 flex flex-col items-center justify-center">
                                       <span class="text-secondary text-xs font-semibold text-center">
                                           <i class="fa-solid fa-plane-departure mr-2"></i>
                                           <span>{{ \Carbon\Carbon::parse($journey['DepartureTime'])->format('D F d,Y') }}</span>
                                       </span>
                            <span class="font-semibold text-md text-black text-center"><i class="fa-regular fa-clock"></i> {{ $journey['Origin'] }}
                                {{ \Carbon\Carbon::parse($journey['DepartureTime'])->format('h:i A') }}</span>
                            @php
                                $airport = airport($journey['Origin'], $airports);
                            @endphp
                            <p class="text-black/60 font-semibold text-xs text-center">{{ $airport->airport . ', ' . $airport->country }}</p>
                        </div>
                        <div class="w-full py-2 flex flex-col justify-center items-center gap-3 lg:pb-0 md:pb-0 sm:pb-0 pb-8">
                            <div class="w-full flex  items-center">
                                <div class="h-10 w-10 flex-none rounded-full flex justify-center items-center bg-secondary/20 border-[1px] border-secondary/10">
                                    <div class="w-6 h-6 rounded-full flex justify-center items-center bg-secondary">
                                        <i class="fa fa-plane-departure text-white text-[10px]"></i>
                                    </div>
                                </div>
                                <div class="w-full grow  flex flex-col justify-center items-center text-center ">
                                    <span class="font-semibold xl:text-sm lg:text-xs md:text-xs sm:text-xs text-sm text-primaryDarkColor"><i class="fa fa-hourglass"></i> {{ hoursandmins($journey['FlightTime']) }}</span>
                                    <div class="w-full bg-secondary/20 h-1"></div>
                                </div>
                                <div class="w-6 h-6 flex-none rounded-full bg-secondary flex justify-center items-center">
                                    <i class="fa fa-plane-arrival text-white text-[10px]"></i>
                                </div>
                            </div>

                        </div>
                        <div class="w-full p-2 flex flex-col items-center justify-center">
                                       <span class="text-secondary text-xs font-semibold text-center">
                                           <i class="fa-solid fa-plane-arrival mr-2"></i>
                                           <span>{{ \Carbon\Carbon::parse($journey['ArrivalTime'])->format('D F d,Y') }}</span>
                                       </span>
                            <span class="font-semibold text-md text-black text-center"><i class="fa-regular fa-clock"></i> {{ $journey['Destination'] }}
                                {{ \Carbon\Carbon::parse($journey['ArrivalTime'])->format('h:i A') }}</span>
                            @php
                                $airport = airport($journey['Destination'], $airports);
                            @endphp
                            <p class="text-black/60 font-semibold text-xs text-center">{{ $airport->airport . ', ' . $airport->country }}</p>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-4 md:grid-cols-4 sm:grid-cols-2 grid-cols-1 justify-between bg-gray-100 rounded-b-[3px] p-2 mb-4">
                        <div class="font-semibold"><span class="text-secondary">Cabin:</span> Economy</div>
                        <div class="font-semibold"><span class="text-secondary">Aircraft:</span> {{ $journey['FlightNumber'] }}</div>
                        <div class="font-semibold"><span class="text-secondary">Baggage Allowance:</span> 15KG</div>
                        <div class="font-semibold"><span class="text-secondary">Miles:</span> -</div>
                    </div>
                @endforeach
            </div>
        </div>




        <div class="w-full h-max bg-white rounded-xl border-[1px] border-ternary/20 shadow-lg shadow-ternary/10 p-4">
            <div class="p-2 font-semibold bg-secondary/20 text-secondary text-lg rounded-t-[3px] flex flex-col">
                <span>FARE SUMMARY</span>
                <span class="mt-2 text-xs text-secondary ">Travelers:
                    {{ $flightSearch->adult }} Adult
                    @if ($flightSearch->child != 0)
                        , {{ $flightSearch->child }} Child
                    @endif
                    @if ($flightSearch->infant != 0)
                        , {{ $flightSearch->infant }} Infant
                    @endif
                </span>
            </div>

            @foreach ($details[3]['AirPricingInfo'] as $key => $paxPricing)
                <div class="p-1 font-semibold text-black text-lg rounded-t-[3px] flex flex-col">
                    <span>Passenger Type: @if ($key == 0)
                            {{ $flightSearch->adult . ' Adults' }}
                        @elseif($key == 1)
                            {{ $flightSearch->child. ' Children' }}
                        @elseif($key == 2)
                            {{ $flightSearch->infant . ' Infants' }}
                        @endif
                    </span>
                    @php
                        $count = 1;
                        if ($key == 0) {
                            $count = $flightSearch->adult;
                        } elseif ($key == 1) {
                            $count = $flightSearch->child;
                        } elseif ($key == 2) {
                            $count = $flightSearch->infant;
                        }
                    @endphp
                </div>
                <div class="flex justify-between px-2 py-1">
                    <span class="text-primaryDarkColor font-semibold text-md">Base Fare x 1</span>
                    <span class="text-secondary font-semibold text-sm">{{ currencySymbol($flightSearch->currency) }}
                        {{ (float) str_replace($flightSearch->currency, '', $paxPricing['BasePrice']) }}</span>
                </div>
                <div class="flex justify-between px-2 py-1">
                    <span class="text-primaryDarkColor font-semibold text-md">Fee & Surcharge x 1</span>
                    <span class="text-secondary font-semibold text-sm">{{ currencySymbol($flightSearch->currency) }}
                        {{ (float) str_replace($flightSearch->currency, '', $paxPricing['ApproximateTaxes']) }}</span>
                </div>
                <div class="flex justify-between px-2 py-1 border-b-[1px] border-b-secondary">
                    <span class="text-primaryDarkColor font-semibold text-md">Total</span>
                    <span class="text-secondary font-semibold text-sm">{{ currencySymbol($flightSearch->currency) }}
                        {{ ((float) str_replace($flightSearch->currency, '', $paxPricing['TotalPrice'])) * $count }}</span>
                </div>
            @endforeach
            <div class="flex justify-between px-2 py-3">
                <span class="text-primaryDarkColor font-semibold text-lg">Total</span>
                <span class="text-secondary font-semibold text-md">{{ $details[2]['price']['TotalPrice'] }}</span>
            </div>
            @php
                $amount = $details[2]['price']['TotalPrice'];
                $price = floatval(preg_replace('/[^0-9.]/', '', $amount)); // Convert to float
                $balanceAmount  = isset($balance->balance) ? floatval($balance->balance) : 0.0;
    
                // Ensure balance is also a float

                $status = $price <= $balanceAmount; // Check if balance is sufficient

             

        @endphp

        @if($status)
            <form method="POST" class="p-2" action="{{ route('flight.passenger-details') }}" :default="['details' => json_encode($details), 'flightSearch' => $flightSearch]">
                 @csrf
            
                <input  name="details" class="hidden" style="display: none" value="{{json_encode($details)}}">
                <input name="flightSearch" class="hidden" style="display: none" value='@json($flightSearch)'>
   
                <input type ="submit" class="showLoader w-full font-semibold text-md bg-secondary/80 text-white/90 px-6 py-2 rounded-[3px] border-[1px] border-danger hover:bg-danger hover:text-white transition ease-in duration-2000"
                                 label="Book Now" value="Book Now" />
            </form>
          @else
          <button class="showLoader w-full font-semibold text-md bg-danger/80 text-white/90 px-6 py-2 rounded-[3px] border-[1px] border-danger hover:bg-danger hover:text-white transition ease-in duration-2000"
          label="Book Now"> Insufficient Balance </button>
          <div class="flex justify-center text-center mt-2 font-semibold text-danger">
              <p >*** Please contect administrator for funds </p>
          </div>
          @endif
        </div>
    </section>



    </x-agency.layout>