{{-- @dd("nbm",$selectedHotelID['HotelId'],$hotelDetailsData) --}}
{{-- @dd($searchParams); --}}
@php
    $cityName = App\Models\City::where('cityID', '=', $searchParams['city'])->first();
$selectedVendor = session('selectedVendor');

    // dd($cityName->country->name)
    // @dd($recommendHotels);

    $cityName = App\Models\City::where('cityID', '=', $searchParams['city'])->first();
    $CityName = $cityName['CityName'];
    // dd($CityName);
@endphp
{{--@dd('hey its working');--}}
@php
    $totalAdults = 0;
    $totalChildrens = 0;

    $roomDetails = json_decode($searchParams['roomDetails'], true);
    // dd($roomDetails);
    foreach ($roomDetails as $key => $roomDetail) {
        $totalAdults += $roomDetail['numberofAdults'];
        $totalChildrens += $roomDetail['numberOfChildren'];
    }

@endphp

<x-agency.layout>
    <div
        class="lg:w-[80%] md:w-[90%] w-full px-2 mx-auto pt-6 bg-[#f3f4f6] rounded-[3px] z-40 lg:sticky md:sticky sm:sticky static top-[70px]">
        <div class="w-full bg-primaryDarkColor rounded-[3px] grid lg:grid-cols-2 ">
            <div class="w-full grid grid-cols-3 lg:border-b-[0px] border-b-[1px] border-b-white">
                <div
                    class="w-full flex flex-col justify-center items-center px-2 py-3 text-white border-r-[1px] border-r-white">
                    <span class="lg:text-sm md:text-sm sm:text-sm text-xs font-normal text-white/80">Hotel In </span>
                    <span class="lg:text-lg md:text-lg sm:text-lg text-sm font-semibold"><i
                            class="fa fa-location-dot mr-1 text-sm"></i> {{ $CityName }}</span>
                </div>
                <div
                    class="w-full flex flex-col justify-center items-center px-2 py-3 text-white border-r-[1px] border-r-white">
                    <span class="lg:text-sm md:text-sm sm:text-sm text-xs font-normal text-white/80">Check In  </span>
                    <span class="lg:text-lg md:text-lg sm:text-lg text-sm font-semibold"><i
                            class="fa fa-calendar-days mr-1 text-sm"></i> {{ $searchParams['checkInDate'] }}</span>
                </div>
                <div
                    class="w-full flex flex-col justify-center items-center px-2 py-3 text-white lg:border-r-[1px] lg:border-r-white">
                    <span class="lg:text-sm md:text-sm sm:text-sm text-xs font-normal text-white/80">Check Out  </span>
                    <span class="lg:text-lg md:text-lg sm:text-lg text-sm font-semibold"><i
                            class="fa fa-calendar-days mr-1 text-sm"></i>{{ $searchParams['checkOutDate'] }}</span>
                </div>
            </div>
            <div class="w-full grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-3 grid-cols-1">
                <div
                    class="w-full flex lg:col-span-2 md:col-span-2 sm:col-span-2 col-span-1 justify-evenly gap-2 lg:border-r-[1px] md:lg:border-r-[1px] sm:lg:border-r-[1px] border-r-[0px] border-r-white lg:border-b-[0px] md:border-b-[0px] sm:border-b-[0px] border-b-[1px] border-b-white">
                    <div class="flex flex-col justify-center items-center px-2 py-3 text-white">
                        <span class="text-sm font-medium text-white/80">Adults  </span>
                        <span class="text-lg font-semibold"><i class="fa fa-person mr-1 text-sm"></i> {{ $totalAdults }}</span>
                    </div>
                    <div class="flex flex-col justify-center items-center px-2 py-3 text-white">
                        <span class="text-sm font-medium text-white/80">Child  </span>
                        <span class="text-lg font-semibold"><i class="fa fa-child mr-1 text-sm"></i> {{ $totalChildrens }}</span>
                    </div>
                    @php
                        $totalNights = \Carbon\Carbon::parse($searchParams['checkOutDate'])->diffInDays(\Carbon\Carbon::parse($searchParams['checkInDate']));
                    @endphp
                    <div class="flex flex-col justify-center items-center px-2 py-3 text-white">
                        <span class="text-sm font-medium text-white/80">Nights  </span>
                        <span class="text-lg font-semibold"><i
                                class="fa fa-moon mr-1 text-sm"></i> {{ $totalNights }}</span>
                    </div>
                    <div class="flex flex-col justify-center items-center px-2 py-3 text-white">
                        <span class="text-sm font-medium text-white/80">Days  </span>
                        <span class="text-lg font-semibold"><i class="fa fa-sun mr-1 text-sm"></i> {{ $totalNights + 1 }}</span>
                    </div>
                    <div class="flex flex-col justify-center items-center px-2 py-3 text-white">
                        <span class="text-sm font-medium text-white/80">Rooms  </span>
                        <span class="text-lg font-semibold"><i class="fa fa-house mr-1 text-sm"></i> {{ count($roomDetails) }}</span>
                    </div>
                </div>
                <div class="w-full flex justify-center items-center px-2 py-3">
                    <Link href="#modifySearch"
                          class="w-max h-max text-center showLoader font-semibold text-md bg-transparent text-white lg:px-4 md:px-6 px-2 py-2 rounded-[3px] border-[1px] border-white/80 hover:bg-white hover:text-primaryDarkColor transition ease-in duration-2000">
                        Modify Search
                    </Link>
                </div>
            </div>


           {{-- <x-splade-modal name="modifySearch" class="rounded-lg" position="center" max-width="7xl">
                <div class=" w-full max-w-7xl px-2 py-3 ">
                    <Search :searchParams="{{ json_encode($searchParams) }}"/>
                </div>
            </x-splade-modal>--}}
        </div>
    </div>


    @php
        $hotelId = is_array($selectedHotelID) ? $selectedHotelID['HotelId'] : null;
    if($selectedVendor === 'Stuba'){
            $availableHotels = session('stubaHotels');

        $allRecommendHotels = $availableHotels['Response']['Body']['Hotels']['Hotel'];
        $recommendHotels = array_slice($allRecommendHotels, 0, 15);
                $hotelMoreDetails = $hotelId ? stubaHotelDetails($hotelId, app(App\Services\PriceAggregatorService::class)) : null;
    }else if ($selectedVendor === 'RateHawk'){
          $availableHotels = session('rateHawkHotels');

        $allRecommendHotels = $availableHotels['Response']['Body']['Hotels']['Hotel'];
        $recommendHotels = array_slice($allRecommendHotels, 0, 15);
         $hotelMoreDetails = $hotelId ? ratehawkHotelDetails($hotelId, app(App\Services\PriceAggregatorService::class)) : null;
    }
      else{
        $availableHotels = session('availableHotels');

        $allRecommendHotels = $availableHotels['Response']['Body']['Hotels']['Hotel'];
        $recommendHotels = array_slice($allRecommendHotels, 0, 15);
            $hotelMoreDetails = $hotelId ? hotelDetails($hotelId, app(App\Services\PriceAggregatorService::class)) : null;
      }

    @endphp


    <section class="lg:w-[80%] md:w-[90%] w-full px-2 mx-auto pt-6 bg-[#f3f4f6] rounded-[3px] " style="position: relative">
        <div class="w-full grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-2">
            <div class="w-full bg-white shadow-lg shadow-primaryColor/20 border-[1px] border-primaryColor/30 rounded-[3px]">
                    <div class="flex justify-between bg-white">

                                    <div class="flex flex-col">
                                        <div class="w-full bg-primaryDarkColor text-white p-2 rounded-t-[3px] font-semibold">
                                           <button onclick="goBack()">
                                                  <i class="fa fa-backward"></i>
                                                    Back
                                                </button>

                                        </div>
                                        <Timer/>
                                        <div class="p-2 border-b-[1px] border-b-primaryColor/30">
                                            <span class=" font-bold text-primaryDarkColor text-xl mb-4 mt-4">{{strtoupper($hotelMoreDetails['HotelName'])}}</span>
                                            <div class="flex flex-col ">

                                <span class="text-black font-semibold text-md ">
                                    <i class=" text-redColor text-lg mr-2 fa-regular fa-calendar"></i>{{$hotelMoreDetails['Facilities']['Facility'][0]['FacilityName']}}</span>
                                                <span class="text-black font-semibold text-md ">
                                                <i class=" text-redColor text-lg mr-2 fa-regular fa-calendar"></i>{{$hotelMoreDetails['Facilities']['Facility'][1]['FacilityName']}}</span>

                                            </div>
                                        </div>

                                        <div class="w-full bg-primaryDarkColor text-white p-2 rounded-t-[3px] font-semibold mt-4">
                                            Hotel Description
                                        </div>
                                        <div class="p-2 border-b-[1px] border-b-primaryColor/30">
                                            @if($hotelMoreDetails['Description'])
                                                <span class="text-sm font-medoum text-black mt-2"> {!! $hotelMoreDetails['Description'] !!}</span>
                                            @else
                                                <span class="text-sm font-medoum text-black mt-2"> NA</span>
                                            @endif
                                        </div>
                                        <div class="w-full bg-primaryDarkColor text-white p-2 rounded-t-[3px] font-semibold mt-4">
                                            Hotel Facility
                                        </div>
                                        <div class="p-2 border-b-[1px] border-b-primaryColor/30">
                                            @foreach ($hotelMoreDetails['Facilities']['Facility'] as $index => $record)
                                                @if ($index < 10)
                                                    <ol style="width: 100%;" class="text-primaryDarkColor text-sm font-semibold">
                                                        <li class="mb-2">
                                                            {!! strtolower(formatFacility($record)) !!}
                                                        </li>
                                                     </ol>
                                                @else
                                                    @break
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="py-4 px-2">
                                            <Link href="#hotelFacilityModal" class="w-max text-center showLoader font-semibold text-md bg-primaryDarkColor/80 text-white/90 px-6 py-2 rounded-[3px] border-[1px] border-primaryDarkColor hover:bg-primaryDarkColor hover:text-white transition ease-in duration-2000">View All Facilities</Link>
                                        </div>
                                    </div>
                                </div>

          {{--<x-splade-modal name="hotelFacilityModal" class="rounded-lg px-2 py-8" position="center" max-width="7xl">
                        <div class="bg-primaryDarkColor p-2 rounded-t-[3px] text-white font-semibold text-md mt-4">
                            Hotel Facilities
                        </div>

                        <div class="grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 p-4 rounded-b-[3px] bg-white shadow-lg shadow-primaryColor/20 border-[1px] border-primaryColor/30 border-t-[0px]">
                            @php
                                $totalFacilities = count($hotelMoreDetails['Facilities']['Facility']);
                                $halfTotalFacilities = ceil($totalFacilities / 2);
                                $firstHalfFacilities = array_slice($hotelMoreDetails['Facilities']['Facility'], 0, $halfTotalFacilities);
                                $secondHalfFacilities = array_slice($hotelMoreDetails['Facilities']['Facility'], $halfTotalFacilities);
                            @endphp
                            <div class="w-full ">
                                @foreach ($firstHalfFacilities as $facility)
                                    <li style="width: 100%;" class="text-primaryDarkColor text-sm font-semibold">{{ $facility['FacilityName'] }}</li>
                                @endforeach
                            </div>
                            <div class="w-full ">
                                @foreach ($secondHalfFacilities as $facility)
                                    <li style="width: 100%;" class="text-primaryDarkColor text-sm font-semibold">{{ $facility['FacilityName'] }}</li>
                                @endforeach
                            </div>
                        </div>

                </x-splade-modal> --}}

            </div>


            <div class=" w-full">
                <div class="w-full ">
                    @if (isset($hotelMoreDetails['Images']['Image']) && is_array($hotelMoreDetails['Images']['Image']))
                        <div class="w-full">
                            <div class="hotelPhotos">
                                @foreach ($hotelMoreDetails['Images']['Image'] as $image)
                                    <div>
                                        <a href="{{ $image }}" target="_blank" class=" ">
                                            <img src="{{ $image }}" class="w-full h-32  object-cover" alt="Image 1">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="flex flex-col w-full bg-white p-2 rounded-b-[3px] border-[1px] border-primaryColor/30 border-t-[0px]]">
                            <span class="text-primaryDarkColor font-bold text-md mt-2 w-42"><i class="fa fa-hotel mr-1"></i> {{ $hotelMoreDetails['HotelName'] ?? 'Hotel Name not available' }}</span>
                            <span class="text-redColor font-semibold text-sm mt-1"><i class="fa fa-location-dot mr-1"></i>
                                @if (isset($hotelMoreDetails['Address']))
                                    {{ $hotelMoreDetails['Address'] }}
                                @else
                                   Address not available
                                @endif
                            </span>
                    </div>
                </div>
                <div class="w-full h-max mt-4">
                    <div class="w-full flex bg-primaryDarkColor text-white rounded-t-[3px] grid grid-cols-6">
                        <div class="w-full border-r-[1px] border-r-white p-2 col-span-2">
                            <span class="text-white font-bold text-sm">Room Types</span>
                        </div>
                        <div class="w-full border-r-[1px] border-r-white p-2   ">
                            <span class="text-white font-bold text-sm "> Board</span>
                        </div>
                        <div class="w-full border-r-[1px] border-r-white p-2   ">
                            <span class="text-white font-bold text-sm">Avg/ Night</span>
                        </div>
                        <div class="w-full p-2 col-span-2">
                            <span class="text-white font-bold text-sm">Total Price</span>
                        </div>
                    </div>


                    <div id="hotelOptionsContainer " class="">
                        @php
                            $count = 0;
                            if (!isset($hotelDetailsData['hotelDetails']['Options']['Option'][0])) {
                                $hotelDetailsData['hotelDetails']['Options']['Option'] = makeArrayWithIndex($hotelDetailsData['hotelDetails']['Options']['Option']);
                            }
                        @endphp
                        @php
                            $optionsArray = $optionsArrayPagination->items();

                            if (!isset($optionsArray[0])) {
                                $optionsArray = makeArrayWithIndex($optionsArray);
                                $optionsArrayPagination->setCollection(collect($optionsArray));
                            }
                        @endphp
                        @foreach ($optionsArrayPagination->items() as $roomTypeList)
                            <div class="w-full grid grid-cols-6 bg-white border-[1px] border-primaryColor/30 border-t-[0px]">

                                <div class="w-full p-2 border-r-[1px] border-r-primaryColor/30 col-span-2 ">
                                    @php
                                        if(array_key_exists('RoomName',$roomTypeList['Rooms']['Room'])){
                                            $roomTypeList['Rooms']['Room']=[$roomTypeList['Rooms']['Room']];
                                        }
                                    @endphp
                                    @if (isset($roomTypeList['Rooms']['Room'][0]))
                                        <span class="text-black font-semibold text-sm">{{ ucwords($roomTypeList['Rooms']['Room'][0]['RoomName']) }}</span>
                                    @endif
                                </div>


                                <div class="w-full p-2 border-r-[1px] border-r-primaryColor/30 flex items-center ">
                                    <span class="text-black font-semibold text-sm">{{ $roomTypeList['BoardType'] }}</span>
                                </div>

                                <div class="w-full p-2 border-r-[1px] border-r-primaryColor/30 flex lg:flex-row md:flex-row sm:flex-row flex-col lg:justify-start md:justify-start sm:justify-start justify-center gap-2 items-center">
                                    @php
                                        $totalAdults = 0;
                                        $totalChildrens = 0;

                                        $roomDetails = json_decode($searchParams['roomDetails'], true);
                                        // dd($roomDetails);
                                        foreach ($roomDetails as $key => $roomDetail) {
                                            $totalAdults += $roomDetail['numberofAdults'];
                                            $totalChildrens += $roomDetail['numberOfChildren'];
                                        }
                                        // dd($totalAdults,$totalChildrens);
                                    @endphp

                                    <div>
                                        <span> <i class="fa-solid fa-person"></i>x{{ $totalAdults }}</span>
                                        @if($totalChildrens)
                                            <span class="text-sm"><i class="fa-solid fa-person "></i>x{{ $totalChildrens }}</span>
                                        @endif
                                    </div>

                                    @php
                                        if (!isset($roomTypeList['Rooms']['Room'][0])) {
                                            $roomTypeList['Rooms']['Room'] = makeArrayWithIndex($roomTypeList['Rooms']['Room']);
                                        }
                                    @endphp

                                    @if (isset($roomTypeList['Rooms']['Room'][0]['DailyPrices']['DailyPrice']))
                                        <div class="text-black font-semibold text-sm">
                                            <div class="group relative">
                                               <span class="cursor-pointer text-[#16a34a] z-30 "><i class="fa fa-eye" aria-hidden="true"></i></span>
                                                <div class=" flex flex-row invisible absolute top-100 left-[50%] translate-x-[-50%] rounded-md bg-white p-1 text-white opacity-0 shadow-md transition-opacity duration-300 ease-in-out group-hover:visible group-hover:opacity-100">
                                                    @php

                                                        $checkInDate = \Carbon\Carbon::parse($searchParams['checkInDate']);
                                                        $checkOutDate = \Carbon\Carbon::parse($searchParams['checkOutDate']);
                                                        $dateArray = [];

                                                        while ($checkInDate->lte($checkOutDate)) {
                                                            $dateArray[] = $checkInDate->format('M j');

                                                            $checkInDate->addDay();
                                                        }
                                                    @endphp
                                                    @if (isset($roomTypeList['Rooms']['Room'][0]['DailyPrices']['DailyPrice']))
                                                        @php
                                                            $dailyPriceDetail = $roomTypeList['Rooms']['Room'][0]['DailyPrices']['DailyPrice'];

                                                            if (!is_array($dailyPriceDetail)) {
                                                                $dailyPrices = makeArrayWithIndex($dailyPriceDetail);
                                                            } else {
                                                                $dailyPrices = $dailyPriceDetail;
                                                            }
                                                        @endphp
                                                        @foreach ($dailyPrices as $index => $dailyPrice)
                                                            <div class="flex  justify-center items-center text-xs px-2 z-40">
                                                                <div class="w-16 border-1 border-gray-200 ml-[0.8px]">
                                                                    <div class="bg-sky-200 text-blue-600 text-bold">
                                                                        <span class="">{{ $dateArray[$index] }}</span>
                                                                        <br/>
                                                                    </div>
                                                                    <hr>
                                                                    <span class=" text-black">£ {{ $dailyPrice }} </span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class=" text-redColor font-semibold text-sm">N/A</span>
                                    @endif
                                </div>
                                @php
                                    // use Carbon\Carbon;
                                    $checkIn = Carbon\Carbon::parse($searchParams['checkInDate']);
                                    $checkOut = Carbon\Carbon::parse($searchParams['checkOutDate']);

                                    $durationInDays = $checkOut->diffInDays($checkIn);
                                @endphp

                                <div class="w-full p-2 col-span-2 flex lg:flex-row md:flex-row sm:flex-row flex-col lg:justify-between md:justify-between sm:justify-between justify-center gap-2 items-center">
                                      <span class="text-black font-semibold text-sm">£ {{ $roomTypeList['TotalPrice'] }}</span>
                                    <a href="{{ route('hotel.bookingStage1', ['bookingDetails' => urlencode(json_encode(['selectedHotelID' => $selectedHotelID['HotelId'],'selectedOption' => $roomTypeList['OptionId'], ]), ), ]) }}"
                                       class="w-max text-center showLoader font-semibold text-md bg-primaryDarkColor/80 text-white/90 px-4 py-0.5 rounded-[3px] border-[1px] border-primaryDarkColor hover:bg-primaryDarkColor hover:text-white transition ease-in duration-2000">Book</a>

                                </div>
                            </div>
                            @php
                                $count++;
                            @endphp

                            @if ($count >= 10)
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div id="data-wrapper" class="w-full "></div>
                    <div class="py-4 flex justify-end gap-4">
                                  @if (count($hotelDetailsData['hotelDetails']['Options']['Option']) > 3)
                            <button id="loadmore"
                                    class="w-max text-center showLoader font-semibold text-sm bg-primaryDarkColor/80 text-white/90 px-4 py-1 rounded-[3px] border-[1px] border-primaryDarkColor hover:bg-primaryDarkColor hover:text-white transition ease-in duration-2000">Load More</button>
                        @endif
                            <button id="showless"
                                    class="w-max text-center showLoader font-semibold text-sm bg-redColor/80 text-white/90 px-4 py-1 rounded-[3px] border-[1px] border-redColor hover:bg-redColor hover:text-white transition ease-in duration-2000 hidden">Show Less</button>
                </div>
                </div>
            </div>
        </div>
    </section>


    <section class="lg:w-[80%] md:w-[90%] w-full px-2 mx-auto pt-6 bg-[#f3f4f6] rounded-[3px] "
             style="position: relative">
        <div
            class="px-2 py-3 font-semibold bg-primaryDarkColor rounded-t-[3px] text-md text-white w-full flex items-center justify-between border-b-[1px] border-b-white">
            <div class="flex items-center gap-2">
                <div class="w-max border-r-[1px] border-r-white px-2">
                    <i class="fa-solid fa-hotel mr-2 text-lg"></i> Recommended Hotels
                </div>

            </div>
        </div>
        <div
            class="w-full grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-2 bg-white p-2 border-[1px] border-primaryColor/30">
            @foreach ($recommendHotels as $recommendHotel)
                {{-- helper function caling to make array --}}
                @php
                    $arrayRoomPrice = null;
                    if (!isset($recommendHotel['Options']['Option'][0])) {
                        $recommendHotel['Options']['Option'] = makeArrayWithIndex($recommendHotel['Options']['Option']);
                    }
                @endphp
                @if (is_array($recommendHotel) &&
                        is_array($selectedHotelID) &&
                        $recommendHotel['HotelId'] != $selectedHotelID['HotelId']
                )
                    @if (is_array($recommendHotel['Options']['Option']))
                        @foreach ($recommendHotel['Options']['Option'] as $record)
                            @if (is_array($record) && isset($record['TotalPrice']))
                                @php
                                    $arrayRoomPrice[] = $record['TotalPrice'];
                                @endphp
                            @endif
                        @endforeach
                    @else
                        <p>Options are not available or are not in the expected format.</p>
                    @endif

                    {{-- @dd($arrayRoomPrice) --}}

                    @php

                        //                $recommendHotelMoreDetails = hotelDetails($recommendHotel['HotelId'], app(App\Services\PriceAggregatorService::class));
                                        if($selectedVendor === 'Stuba'){
                                    $recommendHotelMoreDetails =stubaHotelDetails($recommendHotel['HotelId'], app(App\Services\PriceAggregatorService::class));

                        }else if ($selectedVendor === 'RateHawk'){
                             $recommendHotelMoreDetails =  ratehawkHotelDetails($recommendHotel['HotelId'], app(App\Services\PriceAggregatorService::class));
                        }

                          else{

                                $recommendHotelMoreDetails = hotelDetails($recommendHotel['HotelId'], app(App\Services\PriceAggregatorService::class));
                          }


                    @endphp
                    <RecomendedHotelCard :HotelName="{{ json_encode($recommendHotel['HotelName'] )}}"
                                         :CityName="{{ json_encode($CityName)}}"
                                         :StarRating="{{json_encode($recommendHotel['StarRating'])}}"
                                         :RatingStatus="{{json_encode($recommendHotel['StarRating'] > 4 ? 'Excellent' : 'Good' )}}"
                                         :Price="{{json_encode(empty($arrayRoomPrice) ? 'N/A' : '£ ' . min($arrayRoomPrice))}}"
                                         :HotelImageList="{{ json_encode($recommendHotelMoreDetails['Images']['Image'] ?? []) }}"
                                         :HotelId="{{json_encode($recommendHotel['HotelId'])}}"
                                         :TotalNights="{{json_encode($totalNights)}}"
                    />

                @endif
            @endforeach
        </div>


    </section>

    <div id="loading_overlay1" class="hidden">

        <div class="fixed inset-0  justify-center container flex  h-screen w-full items-center border border-2 z-30 bg-white opacity-70">

        </div>
        <div class="z-40 fixed inset-0  justify-center container flex  h-screen w-full items-center">
            <div class="loader4 "></div>
            <div class="loader3 "></div>
        </div>
    </div>
   </x-agency.layout>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>


<script>

    function goBack() {
        event.preventDefault();

        console.log("go back clicked")
        window.history.back();
    }


    var searchParams = @json($searchParams);
    var optionLastPage = @json($optionsArrayPagination);
    var lastPage = optionLastPage['last_page'];
    var page = 1;
    var totalItemsDisplayed = 0;

    $(document).ready(function () {

        $('#loadmore').click(function () {
            $('.loader').show();
            while (page < lastPage) {
                page++;
                console.log('pageno is ', page);
                LoadMore(page);
                if (page == lastPage) {
                    $('#loadmore').hide();
                }
                break;
            }
        });

        $('#showless').click(function () {
            $('#data-wrapper').children().remove();
            page = 1;
            if (page = 1) {
                $('#showless').hide();
                $('#loadmore').show();
            }
            return;

        });


    });

    function LoadMore(page) {
        var currentUrl = window.location.href;
        $.ajax({
            url: currentUrl + "&page=" + page,
            datatype: "html",
            type: "get",
            beforeSend: function () {
                $('.loader').show();
            }
        })
            .done(function (response) {
                if (response.html == '') {
                    $('.loader').hide();
                    $('.loader').html("End");
                    return;
                }

                $('.loader').hide();
                $("#data-wrapper").append(response.html);
                console.log(' $("#data-wrapper").children()', $("#data-wrapper").children());

                totalItemsDisplayed = $("#data-wrapper").children().length;
                console.log("totalItemsDisplayed more", totalItemsDisplayed);
                if (totalItemsDisplayed >= 5) {
                    $('#showless').show();
                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occurred');
            });
    }
</script>





