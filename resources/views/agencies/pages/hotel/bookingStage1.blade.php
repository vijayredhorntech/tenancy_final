
@php
    $sessionData = session()->get('searchParams');
    //      dd($sessionData);
    //dd(session()->all());
@endphp


@php

    if(session()->get('selectedVendor') ==='Travellanda'){

        $hotelMoreDetails = hotelDetails($bookingDetails['HotelId'], app(App\Services\PriceAggregatorService::class));
    }
    if(session()->get('selectedVendor') === 'Stuba'){

        $hotelMoreDetails = stubaHotelDetails($bookingDetails['HotelId'], app(App\Services\PriceAggregatorService::class));
    }
    if(session()->get('selectedVendor') === 'RateHawk'){

        $hotelMoreDetails = ratehawkHotelDetails($bookingDetails['HotelId'], app(App\Services\PriceAggregatorService::class));
    }


        session(['selectedHotelMoreDetails' => $hotelMoreDetails]);
        session(['selectedHotelDetails' => $bookingDetails]);
    //    dd(session()->all());
        // dd($bookingDetails,$hotelMoreDetails,$sessionData);
        // dd($bookingDetails['fetchPolicies']['Response']['Body']['CancellationDeadline']);
@endphp

@php
    use Carbon\Carbon;
    $checkIn = Carbon::parse($sessionData['checkInDate']);
    $checkOut = Carbon::parse($sessionData['checkOutDate']);
    $durationInDays = $checkOut->diffInDays($checkIn);
@endphp
<x-layout>

    <section class="lg:w-[80%] md:w-[90%] w-full px-2 mx-auto pt-6 bg-[#f3f4f6] rounded-[3px] " style="position: relative">
        <div class="w-full grid lg:grid-cols-4 md:grid-cols-3  grid-cols-1 gap-2">
            <div class="lg:col-span-3 md:col-span-2 col-span-1 bg-white shadow-lg shadow-primaryColor/20 border-[1px] border-primaryColor/30 rounded-[3px] h-max">
                <div class="w-full bg-primaryDarkColor text-white p-2 rounded-t-[3px] font-semibold flex items-center justify-between">
                    <div class="w-max flex flex-col ">
                        <button onclick="window.history.back();">
                            <i class="fa fa-backward"></i>
                            Back
                        </button>
                    </div>
                    <div class="w-max">
                        <a class="mx-auto" href="{{ route('hotel.roomDetailsPdf', ['hotelId' => $bookingDetails['HotelId']]) }}"><i class="fa fa-download mr-1"></i> Download PDF Offer</a>
                    </div>


                </div>


                <form onsubmit="return validateForm()" method="get" action="{{ route('hotel.bookingStage4') }}">
                    @csrf

                            @php($i = 0)
                            @for ($i = 0; $i < $sessionData['rooms']; $i++)

                                    <div class="px-2 py-1 font-semibold bg-primaryDarkColor text-white text-sm rounded-t-[3px] flex  mt-4">
                                       <i class="fa fa-house mr-2"></i>Room : {{ $i + 1 }}
                                    </div>


                                    @if (array_key_exists($i, $sessionData['roomDetails']))
                                        <?php
                                        $numberofAdults = $sessionData['roomDetails'][$i]['numberofAdults'];
                                        $numberOfChildren = $sessionData['roomDetails'][$i]['numberOfChildren'];
                                        ?>

                                        @php($adultCount = 1)
                                        @while ($adultCount <= $numberofAdults)
                                                <div class="px-2 py-1 font-semibold  text-black text-sm mt-2">
                                                    <i class="fa fa-person mr-2"></i>Adult {{ $adultCount }} Details:
                                                </div>
                                                <div class="p-2 border-b-[1px] border-b-primaryColor/40 shadow-lg shadow-gray-200 rounded-b-[3px]">
                                                    <div class="w-full grid lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-2">
                                                        <div class="w-full relative flex flex-col">
                                                            <label for="title" class="text-black/80 font-medium text-sm">Title*</label>
                                                            <select id="title"  name="room{{$i}}[titleAdult{{$i}}{{ $adultCount}}]"
                                                                    class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80">
                                                                <option value="mr">Mr.</option>
                                                                <option value="mrs">Mrs.</option>
                                                            </select>
                                                        </div>
                                                        <div class="w-full relative flex flex-col lg:col-span-2 col-span-1">
                                                            <label for="firstNameInput" class="text-black/80 font-medium text-sm">First Name*</label>
                                                            <input type="text"  id="firstNameInput" required oninput="validateName(this,'nameError[{{$i}}}{{ $adultCount}}]')" name="room{{$i}}[adultFirstName{{$i}}{{ $adultCount}}]" placeholder="First Name"
                                                                   class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>
                                                        </div>
                                                        <div class="w-full relative flex flex-col lg:col-span-2 col-span-1">
                                                            <label for="firstNameInput" class="text-black/80 font-medium text-sm">Last Name*</label>
                                                            <input type="text"  id="lastNameInput" required oninput="validateName(this,'lastNameError[{{$i}}}{{ $adultCount}}]')" name="room{{$i}}[adultLastName{{$i}}{{ $adultCount}}]" placeholder="Last Name"
                                                                   class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>
                                                            <span id="lastNameError[{{$i}}}{{ $adultCount}}]" class="error text-xs text-redColor"></span>

                                                        </div>

                                                    </div>
                                                </div>

                                            @php($adultCount++)
                                        @endwhile

                                        @php($childCount = 1)
                                        @while ($childCount <= $numberOfChildren)
                                                <div class="px-2 py-1 font-semibold  text-black text-sm mt-2">
                                                    <i class="fa fa-child mr-2"></i>Child {{ $adultCount }} Details:
                                                </div>
                                                <div class="p-2 border-b-[1px] border-b-primaryColor/40 shadow-lg shadow-gray-200 rounded-b-[3px]">
                                                    <div class="w-full grid lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-2">
                                                        <div class="w-full relative flex flex-col">
                                                            <label for="title" class="text-black/80 font-medium text-sm">Title*</label>
                                                            <select id="title"  name="room{{$i}}[titleChild{{$i}}{{ $childCount}}]"
                                                                    class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80">
                                                                <option value="mr">Mr.</option>
                                                                <option value="mrs">Mrs.</option>
                                                            </select>
                                                            <span id="nameError" class="error text-xs text-redColor"></span>

                                                        </div>
                                                        <div class="w-full relative flex flex-col lg:col-span-2 col-span-1">
                                                            <label for="firstNameInput" class="text-black/80 font-medium text-sm">First Name*</label>
                                                            <input type="text"  id="firstNameInput" required oninput="validateName(this,'nameError')" name="room{{$i}}[childFirstName{{$i}}{{ $childCount}}]" placeholder="First Name"
                                                                   class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>
                                                            <span id="nameError" class="error text-xs text-redColor"></span>

                                                        </div>
                                                        <div class="w-full relative flex flex-col lg:col-span-2 col-span-1">
                                                            <label for="firstNameInput" class="text-black/80 font-medium text-sm">Last Name*</label>
                                                            <input type="text"  id="lastName" required oninput="validateName(this,'nameError')" name="room{{$i}}[childLastName{{$i}}{{ $childCount}}]" placeholder="Last Name"
                                                                   class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>
                                                            <span id="nameError" class="error text-xs text-redColor"></span>

                                                        </div>

                                                    </div>
                                                </div>

                                            @php($childCount++)
                                        @endwhile
                                @endif
                            @endfor


                    <div class="p-2 font-semibold bg-primaryDarkColor text-white text-lg rounded-t-[3px] flex flex-col ">
                        <span>Billing Details</span>
                    </div>
                    <div class="p-2 border-b-[1px] border-b-primaryColor/40 shadow-lg shadow-gray-200 rounded-b-[3px]">
                        <div class="w-full grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 grid-col-1 gap-2">
                            <div class="w-full relative flex flex-col">
                                <label for="country" class="text-black/80 font-medium text-sm">Country*</label>
                                <select id="countrySelect" onchange="populateCity(this)" name="country"
                                        class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80">
                                    <option value="">--Select Country--</option>
                                </select>
                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="country" class="text-black/80 font-medium text-sm">City*</label>
                                <select id="citySelect" required name="city"
                                        class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80">
                                    <option value="">--Select City--</option>
                                </select>
                                <span id="cityError" class="error text-xs text-redColor"></span>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black/80 font-medium text-sm">Lookup Address*</label>
                                <input id="lookupAddressInput" oninput="validateAddress(this, 'lookupAddressError')" name="lookupAddress"
                                       placeholder="Lookup Address" type="text" required
                                       class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>
                                <span id="lookupAddressError" class="error text-xs text-redColor"></span>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black/80 font-medium text-sm">Address Line 1*</label>
                                <input id="addressLineOneInput" required oninput="validateAddress(this, 'addressLineOneError')" placeholder="Address Line"
                                       type="text" name="address1"
                                       class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>
                                <span id="addressLineOneError" class="error text-xs text-redColor"></span>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black/80 font-medium text-sm">Address Line 2</label>
                                <input id="addressLineTwoInput"  placeholder="Address Line"
                                       type="text" name="address2"
                                       class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>
                                <span id="addressLineTwoInput" class="error text-xs text-redColor"></span>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black/80 font-medium text-sm">Postal Code*</label>
                                <input placeholder="Code" type="text" required  name="postalCode"
                                       id="postalCodeInput" oninput="validatePostalCode(this, 'postalCodeError')"  maxlength="6"
                                       class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>
                                <span id="postalCodeError" class="error text-xs text-redColor"></span>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black/80 font-medium text-sm">Country Code</label>
                                <div class="flex gap-2">
                                <img src="" class="h-12" alt="" id="countryFlag">
                                <select id="callingCode" name="countryContactCode"
                                        class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80">
                                    <option value="">--Select Country First--</option>
                                </select>
                                </div>
                                <span id="contactNoError" class="error text-xs text-redColor"></span>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black/80 font-medium text-sm">Contact No*</label>

                                <input placeholder="Number" type="text" required
                                       id="contactNoInput" oninput="validatePhone(this,'contactNoError')" name="phone" maxlength="10"
                                       class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>

                                <span id="contactNoError" class="error text-xs text-redColor"></span>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black/80 font-medium text-sm">Email*</label>
                                <input placeholder="Email" type="email" id="emailInput" required oninput="validateEmail(this,'emailError')" name="email"
                                       class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>
                                <span id="emailError" class="error text-xs text-redColor"></span>

                            </div>



                        </div>
                    </div>

                    <div class="w-full p-2">
                        <button id="submitButton" class="showLoader w-full font-semibold text-md bg-primaryDarkColor/80 text-white/90 px-6 py-2 rounded-[3px] border-[1px] border-primaryDarkColor hover:bg-primaryDarkColor hover:text-white transition ease-in duration-2000">Proceed to
                            Payment </button>
                    </div>
                </form>
            </div>
            <div class="w-full bg-white rounded-[3px] shadow-primaryColor/20 border-[1px] border-primaryColor/30 shadow-lg">
                <div class="w-full bg-primaryDarkColor text-white p-2 rounded-t-[3px] font-semibold">
                    Booking Details
                </div>
                <div class="p-2 border-b-[1px] border-b-primaryColor/30 relative">
                    <div class="w-full h-64">
                        <img class="w-full h-full object-cover" src="{{ $hotelMoreDetails['Images']['Image'][0] }}" alt="">
                    </div>
                    <button
                        class="absolute top-0 bottom-0 left-0 ml-2 my-auto hover:text-[2.4rem] text-3xl text-white px-2 py-1 rounded"
                        onclick="prevImage()"> &lt;
                    </button>
                    <button
                        class="absolute top-0 bottom-0 right-0 mr-2 my-auto text-3xl hover:text-[2.4rem] text-white px-2 py-1 rounded"
                        onclick="nextImage()"> &gt;
                    </button>
                </div>
                <div class="w-full bg-primaryDarkColor text-white p-2 rounded-t-[3px] font-semibold mt-4">
                    {{ $bookingDetails['HotelName'] }}
                </div>
                <div class="p-2 border-b-[1px] border-b-primaryColor/30">
                    <p class="font-semibold text-gray-600 text-[12px]">{{ $hotelMoreDetails['Address'] }}</p>
                    <div class="w-full flex flex-col  border-b-[1px] border-primaryColor/20 p-2">
                        <span class="font-semibold text-redColor text-[14px]">Check In </span>
                        <span class="font-semibold text-black text-[12px]"><i class="fa fa-calendar-days mr-1"></i>
                    {{ dateFormat($sessionData['checkInDate']) }}</span>
                    </div>

                    <div class="w-full flex flex-col  border-b-[1px] border-primaryColor/20 p-2">
                        <span class="font-semibold text-redColor text-[14px]">Check Out </span>
                        <span class="font-semibold text-black text-[12px]"><i class="fa fa-calendar-days mr-1 "></i>
                    {{ dateFormat($sessionData['checkOutDate']) }}</span>
                    </div>
                    <div class="w-full flex flex-col border-b-[1px] border-primaryColor/20  p-2">
                        {{-- <span class="font-semibold text-black text-[14px] ml-3"><i class="fa fa-clock mr-1"></i> {{$durationInDays}}, Night</span> --}}
                        <span class="font-semibold text-black text-[12px] "><i class="fa fa-clock mr-1"></i>
                    {{ $durationInDays }} {{ $durationInDays == 1 ? 'Night' : 'Nights' }} & {{ $durationInDays + 1 }}
                    Days</span>
                    </div>
                    <div class="w-full flex flex-col  border-b-[1px] border-primaryColor/20 p-2">
                        <span class="font-semibold text-redColor text-[14px]">Total Passenger</span>
                        <span class="font-semibold text-black text-[12px]"><i class="fa-regular fa-user mr-1 "></i>
                   @if($sessionData['adults'] == 1)
                                {{$sessionData['adults']}} Adult
                            @else
                                {{$sessionData['adults']}} Adults
                            @endif
                            @if($sessionData['children'] > 0)
                                & {{$sessionData['children']}}
                                @if($sessionData['children'] == 1)
                                    Child
                                @else
                                    Childs
                                @endif
                            @endif
                </span>
                    </div>
                </div>
                <div class="w-full bg-primaryDarkColor text-white p-2 rounded-t-[3px] font-semibold mt-4">
                    Other Details
                </div>
                <div class="p-2 border-b-[1px] border-b-primaryColor/30">
                    <div class="flex flex-col">
                        <div class="w-full flex justify-between  border-b-[1px] border-primaryColor/20 p-2">
                            <span class="font-semibold text-redColor text-[14px]">Room Type </span>
                            <span class="font-semibold text-black text-[12px]"> {{ucwords( session('selectedOptionRoom')[0]['RoomName'])}}</span>
                        </div>

                        <div class="w-full flex justify-between  border-b-[1px] border-primaryColor/20 p-2">
                            <span class="font-semibold text-redColor text-[14px]">Daily Price:</span>
                            @if(session('dailyPriceOfRoom'))
                                <span class="font-semibold text-black text-[14px]">£ {{session('dailyPriceOfRoom')[0]}}</span>
                            @else
                                <span class="font-semibold text-black text-[14px]">NA</span>
                            @endif
                        </div>

                        <div class="w-full flex justify-between  border-b-[1px] border-primaryColor/20 p-2">
                            <span class="font-semibold text-redColor text-[14px]">Total Price</span>
                            <span class="font-bold text-black text-[14px]">£
                        {{ $bookingDetails['selectedOption'][0]['TotalPrice'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="w-full bg-primaryDarkColor text-white p-2 rounded-t-[3px] font-semibold mt-4">
                    Cancellation Policy
                </div>
                <div class="p-2 border-b-[1px] border-b-primaryColor/30">
                    @if (isset($bookingDetails['fetchPolicies']['Response']['Body']['CancellationDeadline']))
                        <?php
                        $cancellationDeadline = \Carbon\Carbon::parse($bookingDetails['fetchPolicies']['Response']['Body']['CancellationDeadline']);
                        $currentDate = now();
                        if ($cancellationDeadline->lessThan($currentDate)) {
                            // echo 'Not available';
                            $availabilityText = '<span class="font-medium text-red-500">Not Available</span>';
                        } else {
                            $availabilityText = '<span class="font-medium text-green-500">Available</span>';
                        }
                        $today = \Carbon\Carbon::now();
                        $daysLeft = $today->diffInDays($cancellationDeadline);
                        ?>
                        <ol class="text-black text-sm font-semibold mb-1">Cancellation Deadline: <br>
                            {!! $availabilityText !!} <br>
                            @if ($availabilityText !== '<span class="font-medium text-red-500">Not Available</span>')
                                {{ dateFormat($bookingDetails['fetchPolicies']['Response']['Body']['CancellationDeadline']) }}
                                [{{ $daysLeft }} days left]
                            @endif
                        </ol>

                    @endif

                    @if ($cancellationDeadline->greaterThanOrEqualTo($currentDate))
                        @if (isset($bookingDetails['fetchPolicies']['Response']['Body']['Policies']['Policy']))
                            <?php
                            $policies = $bookingDetails['fetchPolicies']['Response']['Body']['Policies']['Policy'];
                            if (!is_array($policies)) {
                                $policies = [$policies];
                            }
                            ?>
                            @foreach ($policies as $policy)

                                <ol class="font-sans font-semibold text-sm text-redColor">*From {{ dateFormat($policy['From']) }} the
                                    amount
                                    {{ $policy['Value'] }}
                                    {{ $policy['Type'] === 'Percentage' ? '%' : $policy['Type'] }}
                                    of the full stay will be charged.
                                </ol>

                            @endforeach
                        @endif
                    @endif


                    @if(session('imporatnatNote'))
                            <div class="text-center w-full py-3">
                                <Link href="#importantInformation" class="w-max text-center showLoader font-semibold text-sm bg-primaryDarkColor/80 text-white/90 px-4 py-1.5 rounded-[3px] border-[1px] border-primaryDarkColor hover:bg-primaryDarkColor hover:text-white transition ease-in duration-2000">
                                    Load More Information</Link>
                            </div>

                        <x-splade-modal name="importantInformation" class="rounded-lg px-2 py-8" position="center" max-width="5xl">
                            @if (session('imporatnatNote'))
                                <div class="bg-primaryDarkColor p-2 rounded-t-[3px] text-white font-semibold text-md mt-4">
                                    Information
                                </div>
                                @foreach (session('imporatnatNote') as $data)
                                    @if(!empty($data))
                                        <li class="text-primaryDarkColor text-sm font-semibold"
                                            style="text-align: justify; text-justify: inter-word; word-wrap: break-word;">
                                            {!! trim(ucwords(strtolower(str_replace(['*', '#'], '', $data)))) !!}
                                        </li>
                                    @endif

                                @endforeach
                            @endif
                        </x-splade-modal>
                    @endif

                </div>
                <div class="w-full bg-primaryDarkColor text-white p-2 rounded-t-[3px] font-semibold mt-4">
                    <i class="fa-solid fa-hand-point-up mr-1"></i>Check
                    In Instructions
                </div>
                <div class="p-2 border-b-[1px] border-b-primaryColor/30">
                    <p class="font-bold text-black text-[12px] text-center">{{$hotelMoreDetails['Facilities']['Facility'][0]['FacilityName']}} & {{$hotelMoreDetails['Facilities']['Facility'][1]['FacilityName']}}
                    </p>
                </div>



            </div>
        </div>
    </section>



</x-layout>

<script>
    let currentImageIndex = 0;
    const images = {!! json_encode($hotelMoreDetails['Images']['Image']) !!};

    function showImage(index) {
        const imgElement = document.querySelector('.w-full.h-full.object-cover');
        imgElement.src = images[index];
        currentImageIndex = index;
    }

    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        showImage(currentImageIndex);
    }

    function prevImage() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        showImage(currentImageIndex);
    }
</script>


<script>

    function validateName(inputElement, errorId) {
        var errorElement = document.getElementById(errorId);
        var name = inputElement.value.trim();

        // Check if the name is not empty and contains only letters
        if (name === '' || !/^[a-zA-Z]+$/.test(name)) {
            errorElement.textContent = 'Please enter a valid name with only letters.';
            return false;
            // You can add more styling or feedback here if needed
        } else {
            errorElement.textContent = ''; // Clear the error message if the name is valid
            return true;
        }

    }
    function validateEmail(inputElement, errorId) {
        // console.log('inputElement.value',inputElement.value)
        var email = inputElement.value.trim();
        var errorElement = document.getElementById(errorId);
        // Basic email format check using a regular expression
        var emailRegex = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;


        if (!emailRegex.test(email)) {
            errorElement.textContent = 'Please enter a valid email address.';
            return false;
            // You can add more styling or feedback here if needed
        } else {
            errorElement.textContent = ''; // Clear the error message if the email is valid
            return true;
        }
    }
    function validatePhone(inputElement, errorId) {
        var errorElement = document.getElementById(errorId);
        var phoneNumber = inputElement.value.trim();
        console.log('ttt', phoneNumber, errorId)
        var numericPhoneNumberRegex = /^\d+$/;
        if (phoneNumber === '' || !numericPhoneNumberRegex.test(phoneNumber)) {
            errorElement.textContent = 'Please enter a valid numeric phone number.';
            return false;
        } else {
            // Set the minimum and maximum limits (adjust as needed)
            var minLength = 7; // Example minimum length
            var maxLength = 15; // Example maximum length

            if (phoneNumber.length < minLength || phoneNumber.length > maxLength) {
                errorElement.textContent = 'Phone number must be between ' + minLength + ' and ' + maxLength + ' digits.';
                return false;
            } else {
                errorElement.textContent = ''; // Clear the error message if the phone number is valid
                return true;
            }
        }
    }

    function validatePostalCode(inputElement, errorId) {
        var errorElement = document.getElementById(errorId);
        var postalCode = inputElement.value.trim();

        // Regex for exactly 5 digits
        var postalCodeRegex = /^\d{6}$/;

        if (postalCode === '' || !postalCodeRegex.test(postalCode)) {
            errorElement.textContent = 'Please enter a valid 6-digit postal code.';
            return false;
        } else {
            errorElement.textContent = ''; // Clear the error message if the postal code is valid
            return true;
        }
    }

    function validateAddress(inputElement, errorId) {
        var errorElement = document.getElementById(errorId);
        var address = inputElement.value.trim();

        // Your address validation logic goes here
        // For example, you can check if the address is not empty

        if (address === '') {
            errorId.textContent = 'Please enter a valid address.';
            return false;
            // You can add more styling or feedback here if needed
        } else {
            errorId.textContent = ''; // Clear the error message if the address is valid
            return true;
        }
    }



    async function getCallingCode(){
        try {
            const callingCodeResponse = await fetch('https://api.npoint.io/0ecf23da91cd001eeb5c');
            const callingCodeResponseData = await callingCodeResponse.json();
            return callingCodeResponseData;
        }
        catch(error){
            console.log('errro',error)
        }


    }
    async function populateCountryOptions() {
        const countrySelect = $('#countrySelect'); // Use jQuery selector
        try {
            const response = await fetch('/api/countries');
            const data = await response.json();
            const callingCodeResponseData = await getCallingCode();

            if (callingCodeResponseData && Object.keys(callingCodeResponseData).length > 0) {
                countrySelect.empty(); // Clear existing options
                countrySelect.append(new Option("--Select Country--", "")); // Add placeholder option

                Object.entries(callingCodeResponseData).forEach(([countryCode, singleData]) => {
                    // Add each country as an option
                    countrySelect.append(new Option(singleData.name, singleData.iso['alpha-2']));
                });

                countrySelect.trigger('change'); // Trigger the change event to update Select2
            } else {
                console.error('No data received from the API.');
            }
        } catch (error) {
            console.error('Error fetching data from the API:', error);
        }
    }

    async function populateCity(selectedCountry) {
        const citySelect = $('#citySelect'); // Use jQuery selector
        const callingCode = $('#callingCode');
        const countryFlag = $('#countryFlag');
        citySelect.empty(); // Clear city dropdown options

        citySelect.append(new Option("--Select City--", "")); // Add placeholder option
        callingCode.empty(); // Clear calling code options

        try {
            const response = await fetch(`/api/cities/${selectedCountry.value}`);
            const data = await response.json();

            // Get calling code data and set the flag image
            const callingCodeResponseData = await getCallingCode();
            const selectedCountryCodeData = callingCodeResponseData[selectedCountry.value];

            if (selectedCountryCodeData) {
                countryFlag.attr('src', selectedCountryCodeData.image); // Set the flag image source

                // Populate calling code dropdown
                selectedCountryCodeData.phone.forEach(element => {
                    callingCode.append(new Option(element, element));
                });
            }

            // Add city options to the Select2 dropdown
            data.forEach(element => {
                citySelect.append(new Option(element.CityName, element.CityId));
            });

            citySelect.trigger('change'); // Trigger the change event to update Select2
        } catch (error) {
            console.error('Error fetching city data:', error);
        }
    }

    populateCountryOptions();


    function validateForm() {
        // Validate each input field
        // var isFirstNameValid = validateName(document.getElementById('firstNameInput'), 'nameError');
        // var isLastNameValid = validateName(document.getElementById('lastNameInput'), 'lastNameError');
        var isLookupAddressValid = validateAddress(document.getElementById('lookupAddressInput'), 'lookupAddressError');
        var isAddressLineOneValid = validateAddress(document.getElementById('addressLineOneInput'), 'addressLineOneError');
        var isAddressLineTwoValid = validateAddress(document.getElementById('addressLineTwoInput'), 'addressLineTwoError');

        var isEmailValid = validateEmail(document.getElementById('emailInput'), 'emailError');
        var isContactNoValid = validatePhone(document.getElementById('contactNoInput'), 'contactNoError');
        var isPostalCodeValid = validatePostalCode(document.getElementById('postalCodeInput'), 'postalCodeError');
        // var isAddressValid = validateAddress(document.getElementById('addressInput'), 'addressError');

        // Return true only if all validations pass
        //     console.log('sssss',isFirstNameValid && isLastNameValid && isLookupAddressValid && isAddressLineOneValid && isAddressLineTwoValid &&
        //    isEmailValid && isContactNoValid && isPostalCodeValid) ;

        return  isLookupAddressValid && isAddressLineOneValid && isAddressLineTwoValid &&
            isEmailValid && isContactNoValid && isPostalCodeValid ;
        // return isFirstNameValid && isLastNameValid && isLookupAddressValid && isAddressLineOneValid && isAddressLineTwoValid &&
        //     isEmailValid && isContactNoValid && isPostalCodeValid ;
    }
    // Call the function to populate options when the page loads
    window.onload = populateCountryOptions;


function sharePDf() {
    var hotelId = @json($bookingDetails['HotelId']);
    fetch('/sharePdf/' + hotelId)
        .then(response => response.json())
        .then(data => {
            window.location.href = data.pdfUrl;
        })
        .catch(error => {
            console.error('Failed to get PDF URL:', error);
        });
}

    {{--function sharePdf() {--}}
    {{--    // URL of the PDF to share--}}
    {{--    var hotelID=@json($bookingDetails['HotelId']);--}}
    {{--    console.log("hotelID",hotelID);--}}
    {{--    var pdfUrl = "{{ route('hotel.roomDetailsPdf', ['hotelId' => $bookingDetails['HotelId']]) }}";--}}

    {{--    if (navigator.share) {--}}
    {{--        navigator.share({--}}
    {{--            title: 'Hotel Room Details PDF',--}}
    {{--            text: 'Check out this PDF for hotel room details',--}}
    {{--            url: pdfUrl--}}
    {{--        }).then(() => {--}}
    {{--            console.log('Successfully shared');--}}
    {{--        }).catch((error) => {--}}
    {{--            console.error('Error sharing:', error);--}}
    {{--        });--}}
    {{--    } else {--}}
    {{--        alert('Web Share API is not supported in your browser');--}}
    {{--    }--}}
    {{--}--}}

</script>


