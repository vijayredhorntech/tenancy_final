<x-navigation-front />


<div class="lg:w-3/4 md:w-3/4 sm:w-full w-full h-max m-auto bg-sky-100 shadow">

    @php
        $sessionData = session()->get('searchParams');
        //  dd($bookingDetails);
    @endphp


    @php
        $hotelMoreDetails = hotelDetails($bookingDetails['HotelId'], app(App\Services\PriceAggregatorService::class));
        session(['selectedHotelMoreDetails' => $hotelMoreDetails]);
        session(['selectedHotelDetails' => $bookingDetails]);
        // dd($bookingDetails,$hotelMoreDetails,$sessionData);
        // dd($bookingDetails['fetchPolicies']['Response']['Body']['CancellationDeadline']);
    @endphp

    <div class="w-full flex lg:flex-row md:flex-row sm:flex-row flex-col h-max m-auto mt-10 border-2 ">
        {{-- <div class="lg:w-3/4  md:w-3/4 sm:w-3/4  w-full h-max bg-sky-100"> --}}
        <div class="lg:w-full w-full h-max bg-sky-100">

            <Timer />

            <span class="float-right text-base font-semibold mr-2 mt-1 hover:text-gray-400 hover:font-semibold">
                <Link href="{{ route('hotel.roomDetailsPdf', ['hotelId' => $bookingDetails['HotelId']]) }}">Download PDF
                Offer
                </Link>
            </span>

            <div class="px-6 w-full py-3  mt-2 flex " style="margin-bottom: 20px">
                <div class=" w-3/5 flex flex-col">
                    <div class=" w-full h-65">
                        <img class=" h-full w-full object-cover" src="{{ $hotelMoreDetails['Images']['Image'][0] }}"
                            alt="">
                        <span class="mt-2">
                            <div class="flex justify-between mt-2 pt-1">
                                <div>
                                    <span class="text-md mt-2 ">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $hotelMoreDetails['StarRating'])
                                                <i class="fa-solid fa-star"
                                                    style="color: deepskyblue; margin-right: 5px"></i>
                                            @else
                                                <i class="fa-solid fa-star"
                                                    style="color: lightgray; margin-right: 5px"></i>
                                            @endif
                                        @endfor

                                    </span>
                                </div>
                                <div>
                                    <div class="flex flex-col">
{{--                                        <span class="text-xl font-bold" style="color: deepskyblue"><i--}}
{{--                                                class="fa-solid fa-comment"></i>--}}
{{--                                            {{ $hotelMoreDetails['StarRating'] }}</span>--}}
                                        {{-- <span class="text-black font-semibold text-md">Excellent</span> --}}
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>


                </div>

                <div class="w-full ml-2 justify-between bg-white p-2">
                    {{-- <div class="flex justify-between bg-white p-2"> --}}
                    <div class="flex flex-col ml-2">
                        <span class="text-black font-semibold text-xl ">Hotel :{{ $bookingDetails['HotelName'] }}
                        </span>
                        <span class="text-black font-semibold text-base md:text-lg mt-1">Address : <span
                                class="text-gray-600 text-sm md:text-base">{{ $hotelMoreDetails['Address'] }}</span>
                        </span>

                        @php
                            $roomName = $bookingDetails['selectedOption'][0]['Rooms']['Room'];

                            if (!isset($roomName[0])) {
                                // dd('cxx');
                                $roomName = makeArrayWithIndex($roomName); //calling helper function to make 0 index
                                // dd( $bookingDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert']);
                            }
                        @endphp

                        <span class="text-black font-semibold text-base mt-1">Room : <span
                                class="text-gray-600 text-sm md:text-base"> {{ $roomName[0]['RoomName'] }}</span></span>
                        @php
                            $formatDate = dateFormat($sessionData['checkInDate']); //helper function
                        @endphp
                        <span class="text-black font-semibold text-base mt-1">Check-in Date : <span
                                class="text-gray-600 text-sm md:text-base">{{ $formatDate }}</span></span>

                        <span class="text-black font-semibold text-base mt-1">Check-out Date : <span
                                class="text-gray-600 text-sm md:text-base"> {{ dateFormat($sessionData['checkOutDate']) }}</span>
                        </span>

                        <span class="text-black font-semibold text-base mt-1">Board Type : <span
                                class="text-gray-600 text-sm md:text-base">{{ $bookingDetails['selectedOption'][0]['BoardType'] }}</span>
                        </span>
                        <span class="text-black font-semibold text-base mt-1">
                            Total Passenger:
                            <span class="text-gray-600 text-sm md:text-base">
                                {{ $sessionData['adults'] }}
                                {{ Illuminate\Support\Str::plural('adult', $sessionData['adults']) }}
                                & {{ $sessionData['children'] }}
                                {{ Illuminate\Support\Str::plural('child', $sessionData['children']) }}
                            </span>
                        </span>
                          <span class="text-black font-semibold text-base mt-4">Status :
                             <span class="text-green-500 font-semibold text-sm md:text-base">Available
                             </span>
                         </span>
                    </div>


                    {{-- </div> --}}
                </div>

            </div>

            <div class="w-full bg-gray-300 px-4 py-2 mt-8" >
                <span class="text-black font-semibold text-lg">Booking Price</span>
            </div>
            <div class="w-full flex justify-between px-4 py-3">
                <span class="text-gray-500 font-semibold text-md">Selling Price</span>
                <span class="text-black font-semibold text-md">£
                    {{ $bookingDetails['selectedOption'][0]['TotalPrice'] }}</span>
            </div>
            <div class="w-full flex bg-gray-200 justify-between px-4 py-3 mb-2">
                <span class="text-black font-semibold text-md">Total Price</span>
                <span class="text-sky-600  font-semibold text-md">£
                    {{ $bookingDetails['selectedOption'][0]['TotalPrice'] }}</span>
            </div>

            <x-splade-form method="POST" :action="route('hotel.bookingStage2')">

                <div class="w-[91%]  ml-[11px] px-6 border-2 border-t-gray-300 border-b-gray-300 py-4">
                    <div class="text-lg text-bold" style="text-decoration: underline; font-weight:bold;">Cancellation
                        Policy
                    </div>
                    <ol>
                        @if (isset($bookingDetails['fetchPolicies']['Response']['Body']['CancellationDeadline']))
                            @php
                                // Assuming $bookingDetails['fetchPolicies']['Response']['Body']['CancellationDeadline'] is a valid date string
                                $cancellationDeadline = \Carbon\Carbon::parse($bookingDetails['fetchPolicies']['Response']['Body']['CancellationDeadline']);
                                $currentDate = now();
                                if ($cancellationDeadline->lessThan($currentDate)) {
                                    echo 'Not available';
                                } else {
                                    echo 'Available';
                                }
                                $today = \Carbon\Carbon::now();
                                $daysLeft = $today->diffInDays($cancellationDeadline);
                            @endphp
                            <li class="text-black">Cancellation Deadline:
                                {{ dateFormat($bookingDetails['fetchPolicies']['Response']['Body']['CancellationDeadline']) }}
                                {{-- {{ \Carbon\Carbon::parse($bookingDetails['fetchPolicies']['Response']['Body']['CancellationDeadline'] )->format('d-m-Y') }} --}}
                                {{-- {{ $bookingDetails['fetchPolicies']['Response']['Body']['CancellationDeadline'] }} --}}
                                [{{ $daysLeft }} days left]
                            </li>
                        @endif

                        @if (isset($bookingDetails['fetchPolicies']['Response']['Body']['Policies']['Policy']))
                            {{-- @dd("nnnn",$bookingDetails['fetchPolicies']['Response']['Body']['Policies']['Policy'][0]) --}}
                            @php
                                $data = $bookingDetails['fetchPolicies']['Response']['Body']['Policies']['Policy'];

                                if(isset($data[0]))
                                {
                                 $data=$data;
                                }
                                else{
                                    $data = [$data];
                                }
                                // dd($data);
                            @endphp
                            @if (isset($data[0]))
                                @foreach ($data as $record)
                                    <ol>
                                        <li class="font-sans">From {{ dateFormat($record['From']) }} the amount
                                            {{ $record['Value'] }}
                                            {{ $record['Type'] === 'Percentage' ? '%' : $record['Type'] }}
                                            of full stay will be charged.
                                        </li>
                                    </ol>
                                @endforeach
                            @else
                                <ol>
                                    <li class="font-sans">From {{ dateFormat($record['From']) }} the amount
                                        {{ $record['Value'] }}
                                        {{ $record['Type'] === 'Percentage' ? '%' : $record['Type'] }}
                                        of full stay will be charged.
                                    </li>
                                </ol>
                            @endif
                        @endif
                        {{-- @dd($bookingDetails['fetchPolicies']['Response']['Body']['Alerts']) --}}

                        @php
                            // dd($bookingDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert']);
                            if (isset($bookingDetails['fetchPolicies']['Response']['Body']['Alerts']) && !empty($bookingDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert'])) {
                                // if (!isset($bookingDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert'][0])) {
                                $alerts = $bookingDetails['fetchPolicies']['Response']['Body']['Alerts'];
                                if (!is_array($alerts['Alert'])) {
                                    // dd('cxx');
                                    $bookingDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert'] = makeArrayWithIndex($bookingDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert']); //calling helper function to make 0 index
                                    // dd( $bookingDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert']);
                                }
                                // }
                            }
                        @endphp
                        @if (isset($bookingDetails['fetchPolicies']['Response']['Body']['Alerts']))
                            @if (isset($bookingDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert']) &&
                                    count($bookingDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert']) > 0)

                                <div class="text-lg text-bold items-center mt-2"
                                    style="text-decoration: underline; font-weight:bold;">Important Information
                                </div>

                                @foreach ($bookingDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert'] as $data)
                                    <li class="font-sans" style="text-align: justify; text-justify: inter-word;">{{ $data }}</li>

                                @endforeach
                            @endif
                        @endif


                    </ol>

                    <div class='mt-[8px]'>
                        <x-splade-group name="termConditions">
                            <x-splade-checkbox name="termConditions[]" :show-errors="false"
                                value="I accept the essential information for this booking"
                                label="I accept the essential information for this booking" required />
                            <x-splade-checkbox name="termConditions[]" :show-errors="false"
                                value="I accept the cancellation information for this booking"
                                label="I accept the cancellation information for this booking" required />
                        </x-splade-group>
                        <!-- <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-0 mr-2">
                             <span class="text-black font-semibold">I accept the essential information for this booking</span> -->
                    </div>
                    <!-- <div class="mt-3">
                             <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-0 mr-2">
                             <span class="text-black font-semibold">I accept the cancellation information for this booking</span>
                         </div> -->
                </div>

                <div class="w-full py-4 px-6">
                    <div class="w-full">
                        {{-- <span class="text-gray-500 font-semibold">Room 1: Main Building standard land view - all inclusive</span> --}}
                    </div>

                    @php($i = 1)
                    @while ($i <= $sessionData['adults'])
                        <span class="font-bold"> Adult {{ $i }} Details:</span>
                        <div
                            class="lg:w-4/5 md:w-4/5 sm:w-4/5 w-full grid lg:grid-cols-7 md:grid-cols-7 sm:grid-cols-7 grid-cols-3 gap-3 mt-5">
                            <div class="w-full " style="margin-bottom:60px; ">
                                <x-splade-select label="Title" name="titleAdults[{{ $i }}]"
                                    placeholder="Title" :options="['Mr.' => 'Mr', 'Mrs.' => 'Mrs']"
                                    class="title w-1/2 p-1 mt-[20px] text-gray-900 text-xs   block w-full py-2 px-3 "
                                    style="width: 110px;" required />
                            </div>

                            <div class="w-full ml-8 lg:col-span-3 md:col-span-3 sm:col-span-3 col-span-1 ">
                                <x-splade-input name="firstNameAdults[{{ $i }}]" label="First Name" required
                                    placeholder="First Name" />
                                <!-- <input type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-0 focus:border-gray-300 block w-full py-2 px-3" placeholder="First Name" required> -->
                            </div>
                            <div class="w-full  ml-8 lg:col-span-3 md:col-span-3 sm:col-span-3 col-span-1 ">
                                <x-splade-input name="lastNameAdults[{{ $i }}]" label="Last Name" required
                                    placeholder="Last Name" />
                                <!-- <input type="text" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-0 focus:border-gray-300 block w-full py-2 px-3" placeholder="Last Name" required> -->
                            </div>

                        </div>
                        @php($i++)
                    @endwhile


                    @php($i = 1)
                    @while ($i <= $sessionData['children'])
                        <span class="font-bold"> Child {{ $i }} Details:</span>
                        <div
                            class="lg:w-4/5 md:w-4/5 sm:w-4/5 w-full grid lg:grid-cols-7 md:grid-cols-7 sm:grid-cols-7 grid-cols-3 gap-3 mt-8">
                            <div class="w-full ">
                                <x-splade-select class="w-1/2 p-1" name="titleChilds[{{ $i }}]"
                                    :options="['Mr.' => 'Mr', 'Mrs.' => 'Mrs']"
                                    class="title mt-[20px] text-gray-900 text-xs   block w-full py-2 px-3 "
                                    style="width: 110px;" placeholder="Title" required />

                            </div>
                            <div class="w-full ml-8 lg:col-span-3 md:col-span-3 sm:col-span-3 col-span-1 ">
                                <x-splade-input name="firstNameChilds[{{ $i }}]" label="First Name"
                                    required placeholder="First Name" />
                                <!-- <input type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-0 focus:border-gray-300 block w-full py-2 px-3" placeholder="First Name" required> -->
                            </div>
                            <div class="w-full ml-8 lg:col-span-3 md:col-span-3 sm:col-span-3 col-span-1 ">
                                <x-splade-input name="lastNameChilds[{{ $i }}]" label="Last Name" required
                                    placeholder="Last Name" />
                                <!-- <input type="text" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-0 focus:border-gray-300 block w-full py-2 px-3" placeholder="Last Name" required> -->

                            </div>
                        </div>

                        @php($i++)
                    @endwhile

                </div>

                <div class="w-full py-4 px-6">
                    <div class="lg:w-1/3 md:w-1/3 sm:w-1/2 w-full">
                        <x-splade-input name="reference" label="Your Reference (Optional)"
                            placeholder="Your Reference" class="text-black" />
                    </div>
                </div>

                <div class="w-full py-4 px-6">
                    <div class="flex justify-end lg:w-4/5 md:w-4/5 sm:w-4/5 w-full">
                        <!-- <a class="text-white bg-sky-500 rounded-md py-2 px-4 font-semibold">Continue</a> -->

                    </div>
                </div>


                <div id="filterModal" class="w-full h-max bg-white border-2 border-gray-200">
                    {{-- <div class="w-full h-max py-3 px-6 flex justify-between bg-gray-100">
                        <span class="text-lg text-black font-semibold">More Filters</span>

                    </div> --}}

                    {{-- <div class="border-b-2 border-b-gray-200 w-full h-max p-3 flex ">
                        <div class="w-full">
                            <x-splade-group name="rooms" label="Room">
                                <x-splade-checkbox name="rooms[]" :show-errors="false" value="low floor"
                                    label="Low Floor" />
                                <x-splade-checkbox name="rooms[]" :show-errors="false" value="high floor"
                                    label="High Floor" />
                                <x-splade-checkbox name="rooms[]" :show-errors="false" value="add joining"
                                    label="Add Joining" />
                                <x-splade-checkbox name="rooms[]" :show-errors="false" value="interconnection"
                                    label="Interconnection" />
                                <x-splade-checkbox name="rooms[]" :show-errors="false" value="smoking"
                                    label="Smoking" />
                                <x-splade-checkbox name="rooms[]" :show-errors="false" value="non-smoking"
                                    label="Non-Smoking" />
                                <x-splade-checkbox name="rooms[]" :show-errors="false" value="vip" label="VIP" />

                            </x-splade-group>


                            <div class="w-full">
                                <x-splade-group name="beddings" label="Bedding">
                                    <x-splade-checkbox name="beddings[]" :show-errors="false" value="double"
                                        label="Double" />
                                    <x-splade-checkbox name="beddings[]" :show-errors="false" value="twin"
                                        label="Twin" />
                                </x-splade-group>


                            </div>

                            <div class="w-full">
                                <x-splade-group name="checkInCheckOuts" label="Check In/Out">
                                    <x-splade-checkbox name="checkInCheckOuts[]" :show-errors="false"
                                        value="late check out" label="Late Check out" />
                                    <x-splade-checkbox name="checkInCheckOuts[]" :show-errors="false"
                                        value="early check in" label="Early Check in" />
                                </x-splade-group>

                            </div>

                            <div class="w-full">
                                <x-splade-group name="ocassions" label="Occasion">
                                    <x-splade-checkbox name="ocassions[]" :show-errors="false" value="birthday"
                                        label="Birthday" />
                                    <x-splade-checkbox name="ocassions[]" :show-errors="false" value="anniversary"
                                        label="Anniversary" />
                                    <x-splade-checkbox name="ocassions[]" :show-errors="false" value="homeyMoon"
                                        label="HomeyMoon" />
                                </x-splade-group>

                            </div>

                        </div>

                        <div class="mt-4 p-6 ">
                            <span class="text-sm text-gray-500 font-semibold">We will insure your request is passed to
                                the property, but cannot guarantee your requirement can always be met</span>


                        </div>
                    </div> --}}

                    <div class="flex justify-end mt-3 mb-8">
                        <!-- <a class="text-white bg-sky-500 rounded-md py-2 px-4 font-semibold">Continue</a> -->
                        <x-splade-submit class="text-white bg-sky-500 rounded-md py-2 px-4 font-semibold" />
                    </div>
                </div>

            </x-splade-form>


        </div>


        {{-- <div class="lg:w-1/4 md:w-1/4 sm:w-1/4 w-full bg-white">
            <div class="w-full bg-gray-300 px-4 py-2">
                <span class="text-black font-semibold text-lg">Booking Price</span>
            </div>
            <div class="w-full flex justify-between px-4 py-3">
                <span class="text-gray-500 font-semibold text-sm">Selling Price</span>
                <span class="text-black font-semibold text-sm">£
                    {{ $bookingDetails['selectedOption'][0]['TotalPrice'] }}</span>
            </div>
            <div class="w-full flex bg-gray-300 justify-between px-4 py-3">
                <span class="text-black font-semibold text-sm">Total Price</span>
                <span class="text-sky-400 font-semibold text-sm">£
                    {{ $bookingDetails['selectedOption'][0]['TotalPrice'] }}</span>
            </div>
        </div> --}}


    </div>


</div>


<x-footer />
