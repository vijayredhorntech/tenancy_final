<x-navigation-front/>


@php
    // dd($adultDetails);
    $adultDetails = array_map(function ($adult) {
        return $adult['title'] . ' ' . $adult['firstName'] . ' ' . $adult['lastName'];
    }, $adultDetails);
    // $adultDetails = array_map(function ($adult) {
    //     return $adult['title'] . ' ' . $adult['firstName'] . ' ' . $adult['lastName'];
    // }, $adultDetails);

    // $childDetails = array_map(function ($child) {
    //     return $child['title'] . ' ' . $child['firstName'] . ' ' . $child['lastName'];
    // }, $childDetails);
    // $childDetails = array_map(function ($child) {
    //     return $child['title'] . ' ' . $child['firstName'] . ' ' . $child['lastName'];
    // }, $childDetails);

    // $allPassengerDetails = array_merge($adultDetails, $childDetails);
    // dd($adultDetails);
@endphp

@php
    // dd($bookingDetails);
    $hotelMoreDetails = hotelDetails($bookingDetails['HotelId'], app(App\Services\PriceAggregatorService::class));
//     dd($bookingDetails);
    // $hotelMoreDetails = hotelDetails($bookingDetails['HotelId'], app(App\Services\PriceAggregatorService::class));
@endphp
{{-- @dd($bookingDetails); --}}
<div class="lg:w-3/4 md:w-3/4 sm:w-full w-full h-max m-auto bg-sky-100 ">
    <div class="w-full flex lg:flex-row md:flex-row sm:flex-row flex-col mt-10">
        <div class="lg:w-3/4  md:w-3/4 sm:w-3/4  w-full h-max bg-sky-100 py-4 px-12">
            <Timer/>

            <div class="w-full flex gap-4">
                <div class="p-4 flex flex-col">
                    <div class="w-8 h-8 rounded-full bg-sky-500 border-none text-white flex justify-center m-auto ">
                        <span class="m-auto">1</span>
                    </div>
                    <span class="text-xs text-gray-500 mt-2">Passengers</span>
                </div>
                <div class="p-4 flex flex-col">
                    <div
                        class="w-8 h-8 rounded-full bg-white border-2 border-sky-500 text-black flex justify-center m-auto ">
                        <span class="m-auto">2</span>
                    </div>
                    <span class="text-xs text-gray-500 mt-2">Your Details</span>
                </div>

                <div class="p-4 flex flex-col">
                    <div
                        class="w-8 h-8 rounded-full bg-white border-2 border-sky-500 text-black flex justify-center m-auto ">
                        <span class="m-auto">3</span>
                    </div>
                    <span class="text-xs text-gray-500 mt-2">Book</span>
                </div>
            </div>
            <div class="w-full">
                <span class=" font-semibold text-black text-lg ">Passenger Details</span>
            </div>

            <div class="w-full">
                <span class=" font-normal text-gray-500 text-xs">(First and Last name as on passport)</span>
            </div>

            <div id="leadPassengerError" class="text-red-500 mt-2" style="display: none;">
                Lead passengers cannot have the same name. Please choose a different name for Passenger 2.
            </div>

            <div class="w-full mt-4">
                <span class=" font-semibold text-black text-lg ">Lead Passenger 1</span>
            </div>

            <div class="w-11/12 bg-green-200 py-1 px-4 mt-2 rounded-sm">
                <span class=" font-semibold text-black text-xs">We can only discuss the booking with the lead or
                    authorised passengers.</span>
            </div>


            <!-- Passenger Lead -->
            <x-splade-form method="POST" :action="route('hotel.bookingStage3')" id="myFormId">
                <div class="w-full py-4 border-b-2 border-gray-200">
                    <div class="lg:w-1/5 md:w-1/3 sm:w-1/2 w-full">
                        <x-splade-select class="w-1/2" name="leadPassenger1" :options="$adultDetails"
                                         id="leadPassenger1"
                                         class=" text-gray-900 text-xs   block w-full py-2 px-3 " placeholder="Select"
                                         required/>
                    </div>

                    <div class="w-1/2 flex">
                        <div class="lg:w-1/2 md:w-1/2 sm:w-1/2 w-full mt-4">
                            <!-- <span class="text-black text-sm font-semibold">Date of Birth</span> -->
                            <!-- <input type="date" id="first_name" class=" mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-0 focus:border-gray-300 block w-full py-2 px-3" placeholder="First Name" required> -->
                            <x-splade-input name="lead_pasenger1_dob" required date placeholder="yyy-mm-dd"
                                            label="Date of birth"/>
                        </div>
                    </div>

                </div>


                {{-- @dd($adultDetails,count($adultDetails)); --}}
                {{-- @dd($adultDetails,count($adultDetails)); --}}

                <!-- <passenger 2 -->
                <!-- <passenger 2 -->
                {{--                 @dd(count($adultDetails))--}}
                @if (count($adultDetails) > 1)
                    <div class="w-full mt-10">
                        <span class=" font-semibold text-black text-lg ">Passenger 2</span>
                    </div>
                    <div class="w-full py-4 border-b-2 border-gray-200">
                        <div class="lg:w-1/5 md:w-1/3 sm:w-1/2 w-full">
                            <x-splade-select class="w-1/2 " name="leadPassenger2" :options="$adultDetails"
                                             id="leadPassenger2"
                                             class=" text-gray-900 text-xs block w-full py-2 px-3 "
                                             placeholder="Select"/>

                        </div>

                        <div class="w-1/2 flex">
                            <div class="lg:w-1/2 md:w-1/2 sm:w-1/2 w-full mt-4">
                                <!-- <span class="text-black text-sm font-semibold">Date of Birth</span>
                                    <input type="date" id="first_name" class=" mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-0 focus:border-gray-300 block w-full py-2 px-3" placeholder="First Name" required> -->
                                <x-splade-input name="lead_pasenger2_dob" date placeholder="yyy-mm-dd"
                                                label="Date of birth"/>
                            </div>
                        </div>

                    </div>
                @endif


                <x-splade-script>

                    function checkLeadPassengerNames() {
                    console.log("heloo");

                    var leadPassenger1Value = document.getElementById('leadPassenger1').value;

                    {{--                    var leadPassenger2Value = document.getElementById('leadPassenger2').value;--}}
                    var errorMessageElement = document.getElementById('leadPassengerError');
                    console.log("leadPassenger1Value",leadPassenger1Value);

                    if (leadPassenger1Value === leadPassenger2Value) {
                    errorMessageElement.style.display = 'block';
                    document.getElementById('submitBtn').disabled = true
                    }
                    else {
                    errorMessageElement.style.display = 'none';
                    document.getElementById('submitBtn').disabled = false;
                    }
                    }

                    function preventFormSubmission(event) {
                    if (errorMessageElement.style.display === 'block') {
                    event.preventDefault();
                    }
                    }

                    document.getElementById('leadPassenger1').addEventListener('change', checkLeadPassengerNames);
                    document.getElementById('leadPassenger2').addEventListener('change', checkLeadPassengerNames);
                    var errorMessageElement = document.getElementById('leadPassengerError');
                    var form = document.getElementById('myFormId');


                </x-splade-script>


                <div class="w-full mt-8">
                    <div class="w-full">
                        <span class="font-semibold text-black text-xl ">Disability support</span>
                    </div>
                    <div class="w-full mt-4 ">
                        <div class="w-full">
                            <x-splade-group name="disability_support">
                                <x-splade-checkbox name="disability_support[]" :show-errors="false" value="yes"
                                                   label="Does anyone in your party require any disability support on your flight, with transfer or at your hotel."/>
                            </x-splade-group>
                            <!-- <span class="text-black font-semibold m-auto">Does anyone in your party require any disability support on your flight, with transfer or at your hotel.</span> -->
                        </div>
                    </div>
                </div>

                <div class="w-full mt-12">
                    <div class="w-1/2">
                        <!-- <a  class="rounded-md bg-sky-500 text-white py-2 px-12 font-semibold text-lg">Continue</a> -->
                        <x-splade-submit id="submitBtn"
                                         class="rounded-md bg-sky-500 text-white py-2 px-12 font-semibold text-lg"/>

                    </div>

                </div>
            </x-splade-form>
        </div>


        <div class="lg:w-1/4 md:w-1/4 sm:w-1/4 w-full bg-white border-2 border-gray-300">

            <div class="w-full border-b border-gray-300">
                <div class="h-48">
                    <img class=" h-full w-full object-fill" src="{{ $hotelMoreDetails['Images']['Image'][0] }}"
                         alt="">
                </div>
                <div class="flex justify-between bg-white p-2">
                    <div class="flex flex-col">
                        <span class="text-black font-semibold text-lg">{{ $bookingDetails['HotelName'] }}</span>
                        <span class="text-lg">
                            <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                            <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                            <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                            <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                            <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                        </span>


                        <span
                            class="text-gray-600 font-semibold text-base mt-1">{{ $hotelMoreDetails['Address'] }}</span>
                        <!-- <span  class="text-gray-600 font-semibold text-xs mt-1">Turky </span>
                            <span  class="text-gray-600 font-semibold text-xs mt-1">7110</span> -->
                    </div>

                </div>
            </div>


            <div class="w-full border-b border-gray-300 p-4">
                <div class="w-full">
                    <span class="text-red-500 font-semibold text-xl">Hotel Information</span>
                </div>
                <div class="w-full flex flex-col py-2">
                    <span class="text-black font-semibold text-lg">Passengers:</span>
                    <span class="text-gray-500 font-semibold text-md">{{ $searchParams['adults'] }} adults</span>
                    <span class="text-gray-500 mt-[2px] font-semibold text-md">{{ $searchParams['children'] }}
                children</span>

                </div>
            </div>

            <div class="w-full flex flex-col py-2 p-4">
                <span class="text-black font-semibold text-lg">Dates:</span>
                <span class="text-gray-500 font-semibold text-md">{{ dateFormat($searchParams['checkInDate']) }} to
            {{ dateFormat($searchParams['checkOutDate']) }}</span>
            </div>

            @php

                use Carbon\Carbon;
                $checkIn = Carbon::parse($searchParams['checkInDate']);
                $checkOut = Carbon::parse($searchParams['checkOutDate']);

                $durationInDays = $checkOut->diffInDays($checkIn);
            @endphp

            <div class="w-full flex flex-col py-2 p-4">
                <span class="text-black font-semibold text-lg">Duration:</span>
                <span class="text-gray-500 font-semibold text-md">{{ $durationInDays }} Nights</span>
            </div>

            <div class="w-full flex flex-col py-2 p-4">
                <span class="text-black font-semibold text-lg">Board Basis:</span>
                <span
                    class="text-gray-500 font-semibold text-md">{{ $bookingDetails['selectedOption'][0]['BoardType'] }}</span>
            </div>
            <div class="w-full flex flex-col py-2 p-4">
                <span class="text-black font-semibold text-lg">Rooms:</span>


                @if (isset($roomTypeList['Rooms']['Room'][0]))
                    {{-- <span class="text-gray-500 font-semibold text-sm">
                                        {{$roomTypeList['Rooms']['Room'][0]['RoomName'] }}
                                    </span> --}}
                    <span class="text-gray-500 font-semibold text-md">{{ $searchParams['rooms'] }}X
                {{ $bookingDetails['selectedOption'][0]['Rooms']['Room'][0]['RoomName'] }} </span>
                @else
                    {{-- <span class="text-gray-500 font-semibold text-sm">
                                   {{$roomTypeList['Rooms']['Room']['RoomName'] }}
                                      </span> --}}
                    {{-- @dd($bookingDetails) --}}
                    @php
                        if (!isset($bookingDetails['selectedOption'][0]['Rooms']['Room'][0])) {
                            $bookingDetails['selectedOption'][0]['Rooms']['Room'] = makeArrayWithIndex($bookingDetails['selectedOption'][0]['Rooms']['Room']); //calling helper function to make 0 index
                        }

                    @endphp


                    <span class="text-gray-500 font-semibold text-md">{{ $searchParams['rooms'] }}X
                {{ $bookingDetails['selectedOption'][0]['Rooms']['Room'][0]['RoomName'] }}
            </span>
                @endif
                {{-- end --}}







                {{-- <span class="text-gray-500 font-semibold text-md">{{$searchParams['rooms']}}X {{$bookingDetails['selectedRoom']['Rooms']['Room'][0]['RoomName']}} </span> --}}
            </div>
            {{-- <div class="w-full flex flex-col py-2 p-4">
                <span class="text-gray-500 font-semibold text-xs">Hotel supplied through Elevate Tourism LLC
                    (USD)</span>
            </div> --}}

        </div>
    </div>
</div>
{{-- </div> --}}

{{-- </div>  --}}

<x-footer/>
