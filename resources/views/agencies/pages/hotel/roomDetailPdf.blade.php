<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Cloud Travels </title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="https://kit.fontawesome.com/4e2c7ef5ef.js" crossorigin="anonymous"></script>


    <style>
        .image-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        @media (max-width: 600px) {
            .image-container {
                grid-template-columns: 1fr;
                /* Switch to a single column layout on small screens */
            }
        }
    </style>

</head>

<body style="padding: 24px;">

    {{-- @dd("pdf loading page",$selectedHotelDetails,$selectedHotelMoreDetails) --}}

    <div>

        @php
            use Carbon\Carbon;
            $checkIn = Carbon::parse($searchParams['checkInDate']);
            $checkOut = Carbon::parse($searchParams['checkOutDate']);
            $durationInDays = $checkOut->diffInDays($checkIn);

            $cityName = App\Models\City::where('cityID', '=', $searchParams['city'])->first();
            // $countryName = $cityName->country->countryName;
            $cityName = $cityName['CityName'];

        @endphp
        <div
            style="width: 100%; padding-bottom: 4px; border-bottom: 1px solid #000; display: flex; justify-content: space-between; align-items: center ;">
            <img style="height: 4rem;" src="https://cloud-travel.co.uk/software/public/images/logo.png" alt="">
            <div style="display: flex; flex-direction: column; align-items: flex-end; max-width: fit-content;">
                <span style="font-weight: normal; font-size: 0.75rem;">
                    Cloud Travel
                </span>
                <span style="font-weight: normal; font-size: 0.75rem;">
                    62 King Street, Southall
                </span>
                <span style="font-weight: normal; font-size: 0.75rem;">
                    02035000000
                </span>
            </div>
        </div>

        <div style="width: 100%; padding: 1rem; box-sizing: border-box; margin-top: 1rem;">
            <div style="margin-top:6px; display:flex; flex-direction:row;">

                 <div>
                    <span style="font-weight: bold; font-size: 1.25rem; color: #0b3dea;">{{ $selectedHotelDetails['HotelName'] }}</span>
                </div>

                <div>
                <span style=" float: right;">
                    {{-- <<span class="text-md mt-2"> --}}
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $selectedHotelDetails['StarRating'])
                            {{-- <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i> --}}
                            {{-- <i style="color: deepskyblue;font-size: 2rem; margin-right: 5px;">*</i> --}}
                            <span>
                               <img src="https://imagedelivery.net/5MYSbk45M80qAwecrlKzdQ/4b3c3700-1fd2-43c2-1f1a-706685bd4100/preview" alt="" style="width: 28px; height:23px"/>
                            </span>

                        @else
                            {{-- <i class="fa-solid fa-star" style="color: lightgray; margin-right: 5px"></i> --}}
                            {{-- <i style="color: lightgray;font-size: 2rem; margin-right: 5px;">*</i> --}}
                            <span>
                                {{-- <img src="{{ asset('assets/images/grayStar.png') }}" alt="" style="width: 20px; height:14px"/>  --}}
                                <img src="https://www.pngkey.com/png/detail/441-4413786_grey-star-icon-png.png" alt="Grey Star Icon Png@pngkey.com" style="width: 32px; height:21px">
                            </span>

                        @endif
                    @endfor
                    {{-- </span> --}}
                </span>
            </div>
            </div>
            <div style="display: flex; gap: 0.5rem; margin-top: 0.5rem;">
                <div style="flex: 0 0 auto; width: 70px; font-style: italic; font-weight: bold; font-size: 0.75rem;">
                    <span>Address</span>
                    <span>:</span>
                </div>
                <div style="font-style: italic; font-weight: bold; font-size: 0.75rem;">
                    <span>{{ $selectedHotelMoreDetails['Address'] }}</span>
                </div>
            </div>
            <div style="display: flex; gap: 0.5rem; margin-top: 0.5rem;">
                <div style="flex: 0 0 auto; width: 70px; font-style: italic; font-weight: bold; font-size: 0.75rem;">
                    <span>Location</span>
                    <span>:</span>
                </div>
                <div style="font-style: italic; font-weight: bold; font-size: 0.75rem;">
                    <span>{{ $cityName }}</span>
                </div>
            </div>
        </div>



        <div class="image-container" style="display: flex;">
            <img style="width: 31%; height: 200px; object-fit: cover; margin: 0; box-sizing: border-box;"
                src="{{ $selectedHotelMoreDetails['Images']['Image'][0] }}" alt="">
            <img style="width: 31%; height: 200px; object-fit: cover; margin: 0; margin-left:10px; box-sizing: border-box;"
                src="{{ $selectedHotelMoreDetails['Images']['Image'][1] }}" alt="">
            <img style="width: 31%; height: 200px; object-fit: cover; margin: 0; margin-left:10px; box-sizing: border-box;"
                src="{{ $selectedHotelMoreDetails['Images']['Image'][2] }}" alt="">
        </div>



        <div style="width: 100%; padding: 1rem; margin-top: 1rem;">
            <div>
                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Rates and Availability</span>
            </div>
            <div
                style="display: flex; flex-direction: column; font-weight: bold; font-size: 0.75rem; margin-top: 0.25rem;">
                <span>From {{ dateFormat( $searchParams['checkInDate']) }} to {{  dateFormat($searchParams['checkOutDate']) }}
                    ({{ $durationInDays }} {{ Str::plural('Night', $durationInDays) }} & {{$durationInDays+1}} Days) </span> <br>

{{--                <span>{{$selectedHotelMoreDetails['Facilities']['Facility'][0]['FacilityName']}}</span>--}}
                {{-- Total for {{ $durationInDays }} {{ Str::plural('Night', $durationInDays) }} --}}

                <span>The rates and availability were valid at the time of generation and can change at any time.</span>
            </div>
        </div>

        {{-- <div style="width: 100%; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; background-color: #e5e5e5; padding: 1rem; margin-top: 1rem;">

        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            @php
            if (!isset($selectedHotelDetails['selectedOption'][0]['Rooms']['Room'][0])) {
                $selectedHotelDetails['selectedOption'][0]['Rooms']['Room'] = makeArrayWithIndex($selectedHotelDetails['selectedOption'][0]['Rooms']['Room']);
              }
            @endphp
            <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                <span style="font-weight: bold; font-size: 0.75rem;">{{$selectedHotelDetails['selectedOption'][0]['Rooms']['Room'][0]['RoomName']}}</span>
                <span style="font-weight: bold; font-size: 1rem; color: #26ace2;">{{$selectedHotelDetails['selectedOption'][0]['BoardType']}}</span>
            </div>

            <div style="display: flex; height: max-content; align-items: center; gap: 0.25rem;">
                <i class="fa fa-user" style="font-size: 0.875rem;"></i>
            </div>

        </div>

        <div style="display: flex; justify-content: space-between; align-items: center;">

            <div style="display: flex; align-items: flex-end; height: 100%;">
                <span style="font-weight: bold; font-size: 1rem; color: #228B22;">Available</span>
            </div>
        </div>
    </div> --}}

        <div
            style="width: 100%; display: flex; justify-content: space-between; gap: 1.5rem; background-color: #e5e5e5; padding: 1rem; margin-top: 1rem;">

            @php
                if (!isset($selectedHotelDetails['selectedOption'][0]['Rooms']['Room'][0])) {
                    $selectedHotelDetails['selectedOption'][0]['Rooms']['Room'] = makeArrayWithIndex($selectedHotelDetails['selectedOption'][0]['Rooms']['Room']);
                }
            @endphp

            <div>
                <span
                    style="font-weight: bold; font-size: 0.75rem;">{{ $selectedHotelDetails['selectedOption'][0]['Rooms']['Room'][0]['RoomName'] }}</span>
                <span
                    style="font-weight: bold;margin-left:2rem; font-size: 1rem; color: #26ace2;">{{ $selectedHotelDetails['selectedOption'][0]['BoardType'] }}</span>
            </div>

            <div style="display: flex; align-items: center; gap: 0.25rem;">
                <i class="fa fa-user" style="font-size: 0.875rem;"></i>
            </div>

            <div style="display: flex; align-items: center;">
                <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                    <span style="font-weight: bold; font-size: 1rem; color: #228B22;">Available</span>
                </div>
            </div>
        </div>


        <div style="width: 100%; padding: 1rem; margin-top: 1rem;">
            <div>
                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">General Description</span>
            </div>
            <div
                style="display: flex;font-family:sans-serif; flex-direction: column; font-weight: normal; font-size: 0.75rem; margin-top: 0.25rem;">
                <span>{!! $selectedHotelMoreDetails['Description'] !!}</span>

                {{-- <span style="margin-top: 1rem;">The hotel has 54 suites, 188 single rooms and 95 double rooms, which are located on 14 storeys and are reachable by lift. Guests are warmly welcomed by multilingual staff at the 24-hour reception desk in the lobby. Check-in/check-out service is available round the clock. Amenities available at the hotel include a baggage storage service, a safe and a currency exchange service. Wireless internet access allows guests to stay connected while on holiday. The tour desk offers assistance with booking excursions. Wheelchair-accessible facilities are available. There are also a number of shops that make for great strolling and browsing. Additional amenities include a TV room and a playroom. Guests arriving by car can park their vehicles in the garage or in the car park. Further services and facilities include a babysitting service, medical assistance, a transfer service, room service, a laundry service, a hairdresser, a coin-operated laundry, a page service and a hotel shuttle bus.</span>
            <span style="margin-top: 1rem;">Complimentary newspapers are available.</span> --}}
            </div>
        </div>

{{--        <div style="width: 100%; padding: 1rem; margin-top: 1rem;">--}}
{{--            <div>--}}
{{--                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Category</span>--}}
{{--            </div>--}}
{{--            <ul--}}
{{--                style="display: flex; flex-direction: column; font-weight: bold; font-size: 0.75rem; margin-top: 0.25rem; list-style-type: disc; padding-left: 1rem;">--}}
{{--                <li>Category (Official): 5</li>--}}
{{--            </ul>--}}
{{--        </div>--}}

{{--        <div style="width: 100%; padding: 1rem; margin-top: 1rem;">--}}
{{--            <div>--}}
{{--                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Building Information</span>--}}
{{--            </div>--}}
{{--            <ul--}}
{{--                style="display: grid;font-family:sans-serif; grid-template-columns: repeat(2, 1fr); gap: 0.5rem; font-weight: normal; font-size: 0.75rem; margin-top: 0.25rem; list-style-type: disc; padding-left: 1rem;">--}}
{{--                <li style="width: 100%;">Year of construction: 2012</li>--}}
{{--                <li style="width: 100%;">Number of Floors - Main building: 14</li>--}}
{{--                <li style="width: 100%;">Number of Rooms (total): 337</li>--}}
{{--                <li style="width: 100%;">Number of Single Rooms: 188</li>--}}
{{--                <li style="width: 100%;">Number of Double Rooms: 95</li>--}}
{{--                <li style="width: 100%;">Number of Suites: 54</li>--}}
{{--                <li style="width: 100%;">Number of Rooms (total): 337</li>--}}
{{--                <li style="width: 100%;">Number of Single Rooms: 188</li>--}}
{{--                <li style="width: 100%;">Number of Double Rooms: 95</li>--}}
{{--                <li style="width: 100%;">Number of Suites: 54</li>--}}
{{--            </ul>--}}
{{--        </div>--}}

{{--        <div style="width: 100%; padding: 1rem; margin-top: 1rem;">--}}
{{--            <div>--}}
{{--                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Hotel Type</span>--}}
{{--            </div>--}}
{{--            <ul--}}
{{--                style="display: grid;font-family:sans-serif; grid-template-columns: repeat(2, 1fr); gap: 0.5rem; font-weight: normal; font-size: 0.75rem; margin-top: 0.25rem; list-style-type: disc; padding-left: 1rem;">--}}
{{--                <li style="width: 100%;">City Hotel</li>--}}
{{--                <li style="width: 100%;">Family-friendly Hotel</li>--}}
{{--                <li style="width: 100%;">Business Hotel</li>--}}
{{--            </ul>--}}
{{--        </div>--}}

{{--        <div style="width: 100%; padding: 1rem; margin-top: 1rem;">--}}
{{--            <div>--}}
{{--                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Payment</span>--}}
{{--            </div>--}}
{{--            <ul--}}
{{--                style="display: grid;font-family:sans-serif; grid-template-columns: repeat(2, 1fr); gap: 0.5rem; font-weight: normal; font-size: 0.75rem; margin-top: 0.25rem; list-style-type: disc; padding-left: 1rem;">--}}
{{--                <li style="width: 100%;">American Express</li>--}}
{{--                <li style="width: 100%;">VISA</li>--}}
{{--                <li style="width: 100%;">MasterCard</li>--}}
{{--                <li style="width: 100%;">Diners Club</li>--}}
{{--                <li style="width: 100%;">JCB</li>--}}
{{--                <li style="width: 100%;">EC Card</li>--}}
{{--            </ul>--}}
{{--        </div>--}}

        <div style="width: 100%; padding: 1rem; margin-top: 1rem;">
            <div>
                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Hotel Facilities</span>
            </div>
            <ul style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.5rem; font-family: sans-serif; font-weight: normal; font-size: 0.75rem; margin-top: 0.25rem; list-style-type: disc; padding-left: 1rem;">
                @foreach ($selectedHotelMoreDetails['Facilities']['Facility'] as $record)
                    <li style="width: 100%;">{{ $record['FacilityName'] }}</li>
                @endforeach



                {{-- <li style="width: 100%;">24-hour reception</li>
            <li style="width: 100%;">24-hour check-in</li>
            <li style="width: 100%;">Hotel Safe: 1</li>
            <li style="width: 100%;">Currency Exchange: 1</li>
            <li style="width: 100%;">Lifts: 1</li>
            <li style="width: 100%;">Café: 1</li>
            <li style="width: 100%;">Shops: 1</li>
            <li style="width: 100%;">Hairdresser: 1</li>
            <li style="width: 100%;">Bar(s): 1</li>
            <li style="width: 100%;">Games room: 1</li>
            <li style="width: 100%;">Restaurant(s): 1</li>
            <li style="width: 100%;">Restaurant(s) with air conditioning: 1</li>
            <li style="width: 100%;">Restaurant(s) with non-smoking area: 1</li>
            <li style="width: 100%;">Restaurant(s) with high-chairs: 1</li>
            <li style="width: 100%;">Conference Room: 1</li>
            <li style="width: 100%;">Internet access</li>
            <li style="width: 100%;">WLAN access</li>
            <li style="width: 100%;">Room Service</li>
            <li style="width: 100%;">Laundry Service</li>
            <li style="width: 100%;">Medical Assistance</li>
            <li style="width: 100%;">Car Park</li>
            <li style="width: 100%;">Garage</li>
            <li style="width: 100%;">Kids Club</li> --}}
            </ul>
        </div>

{{--        <div style="width: 100%; padding: 1rem; margin-top: 1rem;">--}}
{{--            <div>--}}
{{--                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Room Facilities</span>--}}
{{--            </div>--}}
{{--            <ul--}}
{{--                style="display: grid;font-family:sans-serif; grid-template-columns: repeat(2, 1fr); gap: 0.5rem; font-weight: normal; font-size: 0.75rem; margin-top: 0.25rem; list-style-type: disc; padding-left: 1rem;">--}}
{{--                <li style="width: 100%;">Bathroom</li>--}}
{{--                <li style="width: 100%;">Shower</li>--}}
{{--                <li style="width: 100%;">Bathtub</li>--}}
{{--                <li style="width: 100%;">Bidet</li>--}}
{{--                <li style="width: 100%;">Hairdryer</li>--}}
{{--                <li style="width: 100%;">Satellite/cable TV</li>--}}
{{--                <li style="width: 100%;">Radio</li>--}}
{{--                <li style="width: 100%;">Stereo</li>--}}
{{--                <li style="width: 100%;">Internet access</li>--}}
{{--                <li style="width: 100%;">Minibar</li>--}}
{{--                <li style="width: 100%;">King-size Bed</li>--}}
{{--                <li style="width: 100%;">Carpeting</li>--}}
{{--                <li style="width: 100%;">Air conditioning (centrally regulated)</li>--}}
{{--                <li style="width: 100%;">Central Heating</li>--}}
{{--                <li style="width: 100%;">Safe</li>--}}
{{--                <li style="width: 100%;">TV</li>--}}
{{--                <li style="width: 100%;">Air conditioning (individually regulated)</li>--}}
{{--                <li style="width: 100%;">Heating (individually regulated)</li>--}}
{{--            </ul>--}}
{{--        </div>--}}

        {{-- <div style="width: 100%; padding: 1rem; margin-top: 1rem;">
            <div>
                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Meals</span>
            </div>
            <ul
                style="display: grid;font-family:sans-serif; grid-template-columns: repeat(2, 1fr); gap: 0.5rem; font-weight: bold; font-size: 0.75rem; margin-top: 0.25rem; list-style-type: disc; padding-left: 1rem;">
                <li style="width: 100%;">Half Board</li>
                <li style="width: 100%;">Full Board</li>
                <li style="width: 100%;">Breakfast Buffet</li>
                <li style="width: 100%;">Lunch Buffet</li>
                <li style="width: 100%;">à la carte Lunch</li>
                <li style="width: 100%;">Set menu lunch</li>
                <li style="width: 100%;">Evening Buffet</li>
                <li style="width: 100%;">à la carte Dinner</li>
                <li style="width: 100%;">Set menu dinner</li>
                <li style="width: 100%;">Special Offer</li>
            </ul>
        </div> --}}

        {{-- <div style="width: 100%; padding: 1rem; margin-top: 1rem;">
            <div>
                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Sport/Entertainment</span>
            </div>
            <ul
                style="display: grid;font-family:sans-serif; grid-template-columns: repeat(2, 1fr); gap: 0.5rem; font-weight: bold; font-size: 0.75rem; margin-top: 0.25rem; list-style-type: disc; padding-left: 1rem;">
                <li style="width: 100%;">Outdoor Pool(s): 1</li>
                <li style="width: 100%;">Children's Pool: 1</li>
                <li style="width: 100%;">Pool bar: 1</li>
                <li style="width: 100%;">Sun loungers: 1</li>
                <li style="width: 100%;">Steam bath: 1</li>
                <li style="width: 100%;">Golf: 1</li>
                <li style="width: 100%;">Children's Entertainment: 1</li>
                <li style="width: 100%;">Tennis: 1</li>
                <li style="width: 100%;">Number of Pools: 2</li>
            </ul>
        </div> --}}

{{--        <div style="width: 100%; padding: 1rem; margin-top: 1rem;">--}}
{{--            <div>--}}
{{--                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Distances</span>--}}
{{--            </div>--}}
{{--            <ul--}}
{{--                style="display: grid;font-family:sans-serif; grid-template-columns: repeat(2, 1fr); gap: 0.5rem; font-weight: normal; font-size: 0.75rem; margin-top: 0.25rem; list-style-type: disc; padding-left: 1rem;">--}}
{{--                <li style="width: 100%;">Beach: 7500 m</li>--}}
{{--                <li style="width: 100%;">Golf Course: 8800 m</li>--}}
{{--                <li style="width: 100%;">Train Station: 5800 m</li>--}}
{{--            </ul>--}}
{{--        </div>--}}

        {{-- <div style="width: 100%; padding: 1rem; margin-top: 1rem;">
            <div>
                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Hygiene</span>
            </div>
            <ul
                style="display: grid;font-family:sans-serif; grid-template-columns: repeat(2, 1fr); gap: 0.5rem; font-weight: bold; font-size: 0.75rem; margin-top: 0.25rem; list-style-type: disc; padding-left: 1rem;">
                <li style="width: 100%;">Protective hygiene screens</li>
                <li style="width: 100%;">Social distancing regulations</li>
                <li style="width: 100%;">Enhanced cleaning programme</li>
                <li style="width: 100%;">Protective masks for guests</li>
                <li style="width: 100%;">Hand sanitiser</li>
                <li style="width: 100%;">Health checks on staff</li>
                <li style="width: 100%;">Use of commercially available disinfectants</li>
                <li style="width: 100%;">Protective equipment for employees</li>
            </ul>
        </div> --}}

{{--        <div style="width: 100%; padding: 1rem; margin-top: 1rem;">--}}
{{--            <div>--}}
{{--                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Rooms</span>--}}
{{--            </div>--}}
{{--            <div--}}
{{--                style="display: flex;font-family:sans-serif; flex-direction: column; font-weight: normal; font-size: 0.75rem; margin-top: 0.25rem;">--}}
{{--                <span>Air conditioning and individually adjustable heating ensure that rooms maintain comfortable--}}
{{--                    temperatures. All--}}
{{--                    rooms are carpeted and have a double bed or a king-size bed. For a fee, extra beds or children's--}}
{{--                    beds can be--}}
{{--                    provided for little travellers. A safe, a minibar and a desk are also available. Guests will also--}}
{{--                    find a tea/coffee--}}
{{--                    station included among the standard features. An ironing set is provided for guests' convenience. A--}}
{{--                    telephone, a--}}
{{--                    television with satellite/cable channels, a radio, a stereo system and WiFi (no extra charge) are--}}
{{--                    provided as well.--}}
{{--                    Guests can take advantage of the nightly turndown service. A selection of pillows ensures a--}}
{{--                    comfortable stay.--}}
{{--                    Bathrooms are equipped with a shower, a bathtub and a bidet. A hairdryer and bathrobes are provided.--}}
{{--                    For extra--}}
{{--                    comfort in the bathrooms, guests are offered cosmetic products. Wheelchair-friendly rooms with--}}
{{--                    wheelchairaccessible--}}
{{--                    bathrooms are also available. The hotel has family rooms and non-smoking rooms.</span>--}}
{{--            </div>--}}
{{--        </div>--}}

        {{-- <div style="width: 100%; padding: 1rem; margin-top: 1rem;">
            <div>
                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Sports / Entertainment</span>
            </div>
            <div
                style="display: flex;font-family:sans-serif; flex-direction: column; font-weight: normal; font-size: 0.75rem; margin-top: 0.25rem;">
                <span>The pool complex guarantees comfortable swimming with its 2 pools and pleasantly heated water.
                    There is also
                    special swimming area just for little ones. Guests can treat themselves to refreshing drinks at the
                    poolside snack
                    bar and a relaxing soak in the hot tub. A short break or an entire afternoon on the sun terrace,
                    which features sun
                    loungers and parasols, is time well spent. For guests who wish to keep active, tennis and golf are
                    available. Sport
                    and leisure facilities at the hotel include a gym and aerobics. Various wellness options are
                    available at the hotel,
                    including a spa, a sauna, a steam bath, a beauty salon, massage treatments and a solarium.
                    Additional amenities
                    include an entertainment programme for children with a number of fun activities. Copyright GIATA
                    2004 - 2023.
                    Multilingual, powered by www.giata.com for client no. 124815</span>
            </div>
        </div> --}}

{{--        <div style="width: 100%; padding: 1rem; margin-top: 1rem;">--}}
{{--            <div>--}}
{{--                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Meals</span>--}}
{{--            </div>--}}
{{--            <div--}}
{{--                style="display: flex;font-family:sans-serif; flex-direction: column; font-weight: normal; font-size: 0.75rem; margin-top: 0.25rem;">--}}
{{--                <span>Dining facilities include a dining room, a breakfast room, a café and a bar. A non-smoking--}}
{{--                    restaurant with air--}}
{{--                    conditioning, high chairs and a separate area for smokers is available to guests. Catering options--}}
{{--                    include bed and--}}
{{--                    breakfast, half board and full board. A continental breakfast buffet guarantees a great start to the--}}
{{--                    day. At lunch--}}
{{--                    and dinner, guests can choose between a buffet, à la carte and a set menu. Special meals, including--}}
{{--                    diet meals,--}}
{{--                    are also available. The hotel also offers special catering options.</span>--}}
{{--            </div>--}}
{{--        </div>--}}

        {{-- <div style="width: 100%; padding: 1rem; margin-top: 1rem;">
            <div>
                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Payment</span>
            </div>
            <div
                style="display: flex;font-family:sans-serif; flex-direction: column; font-weight: bold; font-size: 0.75rem; margin-top: 0.25rem;">
                <span>The following credit cards are accepted: American Express, VISA, Diners Club, JCB and
                    MasterCard.</span>
            </div>
        </div> --}}

        <div style="width: 100%; padding: 1rem; margin-top: 1rem;">
            <div>
                <span style="font-weight: normal; font-size: 1.125rem; color: #26ace2;">Important Notes</span>
            </div>
            @php
                if (isset($selectedHotelDetails['fetchPolicies']['Response']['Body']['Alerts']) && !empty($selectedHotelDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert'])) {
                    $alerts = $selectedHotelDetails['fetchPolicies']['Response']['Body']['Alerts'];
                    if (!is_array($alerts['Alert'])) {
                        $selectedHotelDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert'] = makeArrayWithIndex($selectedHotelDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert']); //calling helper function to make 0 index
                    }
                }
            @endphp
            @if (isset($selectedHotelDetails['fetchPolicies']['Response']['Body']['Alerts']))
                @if (isset($selectedHotelDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert']) &&
                        count($selectedHotelDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert']) > 0)

                    {{-- <div class="text-lg text-bold mt-2" style="text-decoration: underline; font-weight:bold;">
                        Important Information</div> --}}

                    @foreach ($selectedHotelDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert'] as $data)
                    <ul
                        style="display: flex;font-family:sans-serif; flex-direction: column; font-weight: normal; font-size: 0.75rem; margin-top: 0.25rem; list-style-type: disc; padding-left: 1rem;">
{{--                        <li >{{ $data }}</li>--}}
                        <li> {!! trim(ucwords(strtolower(str_replace(['*', '#'], '', $data)))) !!}</li>
                    </ul>
                    @endforeach
                @endif
            @endif
        </div>



        <div style="position: relative; padding-top: 0.5rem; padding-top: 1rem; padding-top: 1.5rem;">
            <div style="width: 100%; height: 400px; padding-top: 0.5rem;">
                @php
                $latitude = $selectedHotelMoreDetails['Latitude'];
                $longitude = $selectedHotelMoreDetails['Longitude'];
                $mapboxAccessToken = 'pk.eyJ1Ijoicm56YWo2MCIsImEiOiJjbHB6M3U4NTYxM3owMmlwZmcxbnFyZ3Z1In0.dOAVa2Dq7btKxFdPlihPnA'; // Replace with your Mapbox access token
                $mapImageURL = "https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/pin-s+FF0000({$longitude},{$latitude})/{$longitude},{$latitude},14,0,0/600x400?access_token={$mapboxAccessToken}";
                @endphp
                <span style="margin-bottom: 6px">Hotel Map</span>
                <img style="width: 100%; height: 100%;" src="{{ $mapImageURL }}" alt="Hotel Location Map">
            </div>
        </div>

    </div>
</body>

</html>
