
{{-- @dd($selectedHotelID['HotelId'],$hotelDetailsData) --}}

@php
$cityName = App\Models\City::where('cityID', '=', $searchParams['city'])->first();
$availableHotels = session('availableHotels');
$allRecommendHotels = $availableHotels['Response']['Body']['Hotels']['Hotel'];
$recommendHotels = array_slice($allRecommendHotels, 0, 10);

@endphp

<x-navigation-front />
<div class="container mx-auto p-8 bg-sky-100">
    <div class="container bg-sky-400 border-2 border-sky-400 p-2 rounded-lg m-3">
        <Search :searchParams="{{ json_encode($searchParams) }}" />
    </div>

</div>


{{-- @dd($hotelDetailsData); --}}
@php
    $hotelId = is_array($selectedHotelID) ? $selectedHotelID['HotelId'] : null;
    $hotelMoreDetails = $hotelId ? hotelDetails($hotelId, app(App\Services\PriceAggregatorService::class)) : null;
@endphp


<div class="w-full flex lg:flex-row md:flex-row sm:flex-row flex-col-reverse">
 
    <div class="lg:w-2/5  md:w-2/5 sm:w-2/5  w-full h-max">
        <div class="w-full mt-10 relative ">
            <div class="px-6 w-full mt-6 grid grid-cols-1 gap-6">
                <div class="w-full">
                    <div class="h-48">
                            <a href=""> 
                                @if(isset($hotelMoreDetails['Images']['Image'][0]))
                                <img class="h-full w-full object-cover"
                                     src="{{ $hotelMoreDetails['Images']['Image'][0] }}"
                                     alt="">
                            @else
                                <img class="h-full w-full object-cover"
                                     src="{{ asset('path/to/placeholder-image.jpg') }}"  {{-- Provide a placeholder image path --}}
                                     alt="Placeholder Image">
                            @endif
                        </a>
        
                    </div>
                    <div class="flex justify-between bg-white p-2">
                        <div class="flex flex-col">
                    <span class="text-xl">
                        @for ($i = 1; $i <= 5; $i++)
                        @if (isset($hotelMoreDetails['StarRating']) && $i <= $hotelMoreDetails['StarRating'])
                           <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                        @else
                           <i class="fa-solid fa-star" style="color: lightgray; margin-right: 5px"></i>
                        @endif
                      @endfor
                    </span>
                                
                            <span class="text-black font-semibold text-lg mt-2">{{$hotelDetailsData['hotelDetails']['HotelName']}}</span>
                            @if (!is_null($hotelMoreDetails) && isset($hotelMoreDetails['Address']))
                            <span class="text-black font-semibold text-md mt-8">{{ $hotelMoreDetails['Address'] }}</span>
                        @else
                            <span class="text-black font-semibold text-md mt-8">Address not available</span>
                        @endif                           
                    </div>
                        <div class="flex flex-col">
                            @if (!is_null($hotelMoreDetails) && isset($hotelMoreDetails['StarRating']))
                            <span class="text-xl font-bold" style="color: deepskyblue"><i class="fa-solid fa-comment"></i>{{ $hotelMoreDetails['StarRating'] }}</span>
                        @else
                            <span class="text-xl font-bold" style="color: deepskyblue"><i class="fa-solid fa-comment"></i> Star Rating not available</span>
                        @endif
                           </div>
                    </div>
                </div>
                
              
           
            @foreach ($recommendHotels as $recommendHotel)

            {{-- helper function caling to make array --}}
            @php
                 $arrayRoomPrice=null;
                 if (!isset($recommendHotel['Options']['Option'][0])) {
                    $recommendHotel['Options']['Option'] = makeArrayWithIndex($recommendHotel['Options']['Option']);
                }

            @endphp
            @if(is_array($recommendHotel) && is_array($selectedHotelID) && $recommendHotel['HotelId'] != $selectedHotelID['HotelId'])
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
                 $recommendHotelMoreDetails = hotelDetails($recommendHotel['HotelId'], app(App\Services\PriceAggregatorService::class));
                 @endphp
               
               {{-- @dd("Before Debugging", $hotelDetailsData) --}}
               <Link href="{{ route('hotel.details', ['amp;hotelDetails' => $recommendHotel, 'hotelDetails' => $recommendHotel]) }}">
                <div class="w-full">                    <div class="h-48">
                        <a href=""> <img class=" h-full w-full object-cover" src="{{$recommendHotelMoreDetails['Images']['Image'][0]}}" alt="">
                        </a>
                    </div>
                    <div class="flex justify-between bg-white p-2">
                        <div class="flex flex-col">
                    <span class="text-xl">
                        @for ($i = 1; $i <= 5; $i++)
                         @if ($i <= $recommendHotelMoreDetails['StarRating'])
                            <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                         @else
                            <i class="fa-solid fa-star" style="color: lightgray; margin-right: 5px"></i>
                         @endif
                       @endfor
                    
                    </span>
                 
 
                            <span class="text-black font-semibold text-lg mt-2">{{$recommendHotel['HotelName']}}</span>
                            <span  class="text-black font-semibold text-md mt-8">{{$recommendHotelMoreDetails['Address']}}</span>
                            <!-- <span class="mt-8 text-gray-600 font-normal">from <span class="font-bold text-black">₹ 877</span></span> -->
                            @if ($arrayRoomPrice)
                            <span class="font-semibold mt-2 text-md text-gray-400">
                                <span>from <span class="text-black">£ {{ min($arrayRoomPrice) }}</span> to <span class="text-black">£ {{ max($arrayRoomPrice) }}</span></span>
                                total for 1 room
                            </span>
                        @else
                            <!-- Handle the case when $arrayRoomPrice is null or empty -->
                            <span class="font-semibold mt-2 text-md text-gray-400">Room prices not available</span>
                        @endif
                                                </div>
                        <div class="flex flex-col">
                            <span class="text-xl font-bold" style="color: deepskyblue"><i class="fa-solid fa-comment"></i>{{ $recommendHotelMoreDetails['StarRating']}}</span>
                            {{-- <span class="text-black font-semibold text-md">Excellent</span> --}}
                        </div>
                    </div>
                  </div>
                 </Link>
               @endif  
         @endforeach
         

            </div>
        </div>
 
    </div>
  
    <div class="lg:w-3/5 md:w-3/5 sm:w-3/5 w-full">
        <div class="w-full mt-10">
 
            
<!-- {{--                       images and details of selected hotel--}} -->
            <div class="px-6 w-full mt-6 ">
                <div class="w-full h-32 overflow-hidden relative grid lg:grid-cols-4 md:grid-cols-4 sm:grid-cols-2 grid-cols-2 gap-4 relative">
                    @if(isset($hotelMoreDetails['Images']['Image']) && is_array($hotelMoreDetails['Images']['Image']))
                    @foreach ($hotelMoreDetails['Images']['Image'] as $image)
            
                             {{-- @foreach ($hotelDetailsData['hotelDetails']['Options']['Option'] as $record)
                                @if (isset($record['Rooms']['Room']) && is_array($record['Rooms']['Room']))
                                    @foreach ($record['Rooms']['Room'] as $room)
                                    @endforeach
                                @endif
 
                             @endforeach --}}
                  
                       <div class=" w-full h-96">
 
                        <a href="{{$image}}" data-lightbox="hotelPhotos">
                            <img class=" h-full w-full object-fill cursor-pointer"   src="{{$image}}" alt="">
                        </a>
                      </div>
                    @endforeach
                    @endif
                    <div class=" w-1/4 h-32 absolute right-0 bg-no-repeat bg-center bg-cover bg-blend-darken" style="background-image: url(https://images.unsplash.com/photo-1573676564862-0e57e7eef951?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80);">
                        <a href="https://images.unsplash.com/photo-1573676564862-0e57e7eef951?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" data-lightbox="hotelPhotos">
                            <div class="w-full h-full bg-white/80 flex justify-center align-middle">
                                <span class="m-auto text-black font-semibold"><span>5</span> More Images</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="w-full">
                    <div class="flex justify-between bg-white p-2">
                        <div class="flex flex-col">
                    <span class="text-md">
                       @for ($i = 1; $i <= 5; $i++)
                       @if(isset($hotelMoreDetails['StarRating']) && $i <= $hotelMoreDetails['StarRating'])                            <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                         @else
                            <i class="fa-solid fa-star" style="color: lightgray; margin-right: 5px"></i>
                         @endif
                       @endfor
                      
                    </span>
                        </div>
 
                        <div class="flex flex-col">
 
                       
                            <span class="text-black font-semibold text-md ">{{ $hotelMoreDetails['HotelName'] ?? 'Hotel Name not available' }}</span>
                            <span  class="text-gray-600 font-semibold text-xs mt-1">
                                @if(isset($hotelMoreDetails['Address']))
                                {{$hotelMoreDetails['Address']}}</span>
                                {{ $hotelMoreDetails['Address'] }}
                                @else
                                    Address not available
                                @endif
                          
 
                       </div>
 
 
 
                        <div class="flex flex-col">
                            <span class="text-xl font-bold" style="color: deepskyblue"><i class="fa-solid fa-comment"></i>{{ $hotelMoreDetails['StarRating']}}</span>
                        </div>
                    </div>
                </div>
            </div>
            {{--                       images and details of selected hotel--}}
        </div>
        <div class="w-full h-max flex flex-wrap  px-6">
            <div class="flex justify-between lg:w-1/2 md:w-3/4 sm:w-3/4 w-3/4 bg-sky-300 p-2">
                <button class="text-gray-600 font-semibold">Rates</button>
                <button class="text-gray-600 font-semibold">Over View</button>
                <button class="text-gray-600 font-semibold">Reviews</button>
                <button class="text-gray-600 font-semibold">Location</button>
 
            </div>
            <div class="lg:w-1/2 md:w-1/4 sm:w-1/4 w-1/4 bg-sky-300 flex justify-end align-middle p-2">
                <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-0 mr-2 m-auto">
                <span class="text-gray-600 font-semibold">Share Quotes</span>
            </div>
        </div>
        <div class="w-full h-max px-6 mt-4">
            <div class="w-full flex p-3">
                <div class="w-1/5  h-max">
                    <span class="text-gray-600 font-bold text-sm">Room Types</span>
                </div>
                <div class="w-1/5  h-max">
                    <span class="text-gray-600 font-bold text-sm">Board</span>
                </div>
                <div class="w-1/5  h-max">
                    <span class="text-gray-600 font-bold text-sm">Avg/ Night</span>
                </div>
                <div class="w-1/5  h-max">
                    <span class="text-gray-600 font-bold text-sm">Total Price</span>
                </div>
 
            </div>
 
 
 
            {{-- new one start  --}}
            <div id="hotelOptionsContainer">
                @php
                    $count = 0;
                  
                 if (!isset($hotelDetailsData['hotelDetails']['Options']['Option'][0])) {
                    $hotelDetailsData['hotelDetails']['Options']['Option'] = makeArrayWithIndex($hotelDetailsData['hotelDetails']['Options']['Option']);
                }
                @endphp

            @foreach ($hotelDetailsData['hotelDetails']['Options']['Option'] as $roomTypeList)
                  
             <div
                class="w-full flex mt-3 border-2 border-gray-300 rounded-lg p-3 bg-white shdow-md shadow-gray-500">

                <div class="w-1/5 flex h-max flex flex-col">
                    @if(isset($roomTypeList['Rooms']['Room'][0]))
                        <span class="text-gray-500 font-semibold text-sm">
                            {{ $roomTypeList['Rooms']['Room'][0]['RoomName'] }}
                        </span>
                        @php
                            if (
                                isset($roomTypeList['Rooms']['Room'][0]['DailyPrices']) &&
                                is_array($roomTypeList['Rooms']['Room'][0]['DailyPrices']) &&
                                isset($roomTypeList['Rooms']['Room'][0]['DailyPrices']['DailyPrice']) &&
                                is_array($roomTypeList['Rooms']['Room'][0]['DailyPrices']['DailyPrice']) &&
                                isset($roomTypeList['Rooms']['Room'][0]['DailyPrices']['DailyPrice'][0])
                            ) {
                                $dailyPrice1 = $roomTypeList['Rooms']['Room'][0]['DailyPrices']['DailyPrice'][0];
                                // dd("if",$dailyPrice1);
                               
                            } else {
                                // Provide a default value for $dailyPrice in the else block
                                $dailyPrice[] = 0; // You can change this to whatever default value you want
                            }
                            
                        @endphp
                    @else
                    
                        <span class="text-gray-500 font-semibold text-sm">
                            {{ $roomTypeList['Rooms']['Room']['RoomName'] }}
                        </span>
                        @php
                            if (
                                isset($roomTypeList['Rooms']['Room']['DailyPrices']) &&
                                 isset($roomTypeList['Rooms']['Room']['DailyPrices']['DailyPrice'])
                              ) {
                              $dailyPrice = $roomTypeList['Rooms']['Room']['DailyPrices']['DailyPrice'];
                              }   else {
                                    $dailyPrice[] = 0;
                                }

                            // $dailyPrice = $roomTypeList['Rooms']['Room']['DailyPrices']['DailyPrice'];
                                // dd("else",$dailyPrice);
                        @endphp
                    @endif
                </div>

                
                <div class="w-1/5 flex h-max">
                    <span class="text-gray-500 font-semibold text-sm">{{ $roomTypeList['BoardType'] }}</span>
                </div>
                
                @if(!empty($dailyPrice1))
                 <div class="w-1/5 flex h-max">
                    <span class="text-gray-500 font-semibold text-sm">£ {{ $dailyPrice1 }} <span
                            class="font-bold text-black">/</span>
                        Room</span>
                 </div>
                @else
                <div class="w-1/5 flex h-max">
                    <span class="text-gray-500 font-semibold text-sm">£ {{ $dailyPrice[0]>0?$dailyPrice[0]:'N/A' }} <span
                            class="font-bold text-black">/</span>
                        Room</span>
                </div>
                @endif
                
                {{-- @dd($roomTypeList) --}}
                @php
                // use Carbon\Carbon;
                   $checkIn = Carbon\Carbon::parse($searchParams['checkInDate']);
                   $checkOut = Carbon\Carbon::parse($searchParams['checkOutDate']);

                    $durationInDays = $checkOut->diffInDays($checkIn);
                @endphp

                <div class="w-1/5 flex h-max flex flex-col">
                    <span class="text-gray-500 font-semibold text-sm">£ {{ $roomTypeList['TotalPrice'] }} 
                        </span>
                    <span class="text-sky-600 font-semibold text-xs">Refundable till Jul 23 2023</span>
                </div>
                <div class="w-1/5 flex justify-center h-max">
                    <a href="{{ route('hotel.bookingStage1', ['bookingDetails' => ['selectedHotelDetails' => $hotelDetailsData,'selectedHotelID'=>$selectedHotelID['HotelId'], 'selectedRoom' => $roomTypeList, 'selectedOption' => $roomTypeList]]) }}"
                        class="text-sky-600 border-b-2 border-b-sky-400 font-semibold">Book</a>
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

        @if (count($hotelDetailsData['hotelDetails']['Options']['Option']) > 10)
            <button id="loadMoreBtn" class="bg-blue-500 text-white p-2 mt-3">Load More</button>
        @endif


        
           
        </div>
    </div>
 
</div>

<x-footer/>