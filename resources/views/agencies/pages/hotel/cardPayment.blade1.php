<x-navigation-front />

@php 
$hotelMoreDetails = hotelDetails($bookingDetails['HotelId'], app(App\Services\PriceAggregatorService::class));
@endphp
<div class="lg:w-3/4 md:w-3/4 sm:w-full w-full h-max m-auto bg-white ">
        <div class="w-full flex lg:flex-row md:flex-row sm:flex-row flex-col mt-10">
            <div class="lg:w-3/4  md:w-3/4 sm:w-3/4  w-full h-max bg-sky-100 py-4 px-12">
                <Timer />

                <div class="w-full flex gap-4">
                    <div class="p-4 flex flex-col">
                        <div class="w-8 h-8 rounded-full bg-white border-2 border-sky-500 text-black flex justify-center m-auto ">
                            <span class="m-auto">1</span>
                        </div>
                        <span class="text-xs text-gray-500 mt-2">Passenger</span>
                    </div>
                    <div class="p-4 flex flex-col">
                        <div class="w-8 h-8 rounded-full bg-white border-2 border-sky-500 text-black flex justify-center m-auto ">
                            <span class="m-auto">2</span>
                        </div>
                        <span class="text-xs text-gray-500 mt-2">Your Deails</span>
                    </div>
                    <div class="p-4 flex flex-col">
                        <div class="w-8 h-8 rounded-full bg-sky-500 border-none text-white flex justify-center m-auto ">
                            <span class="m-auto">3</span>
                        </div>
                        <span class="text-xs text-gray-500 mt-2">Book</span>
                    </div>
 
                </div>
 
                <div class="w-full px-3 py-1.5 bg-gray-200 ">
                    <span class="text-lg text-black font-semibold">Card Payment</span>
                </div>
 
                <div class="w-full flex py-6 border-b-2 border-b-gray-200">
                    <div class="w-4/5">
                        <div class="flex flex-wrap">
                            <span class="text-black font-semibold text-lg">Important Information</span>
                        </div>
                        <div class="flex flex-wrap">
                            <span class="text-black font-semibold text-sm">By clicking to confirm your booking, your are agreeing to the following:</span>
                        </div>
                        <div class="flex flex-wrap">
                            <span class="text-black font-normal text-xs">Holiday availability and price are subjected to change</span>
                        </div>
 
 
                    </div>
                    <div class="w-1/5 h-12 ">
                      <img class="w-full h-full object-cover" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSOWYsllCSzvfl1ojLGy9_a-sUKCJHohLJJBQ&usqp=CAU" alt="">
                    </div>
                </div>
       
             <x-splade-form :action="route('hotel.cardPayment')">   
                <div class="w-full py-4 border-b-2 border-gray-200">
 
                    <div class="w-full">
                        <div class=" w-full mt-4">
                        <x-splade-input name="cardNumber" label="Card Number" required
                        placeholder="1234 5678 9101"/>
                            <!-- <span class="text-black text-sm font-semibold">Card Number</span>
                            <input type="text" id="number" class=" mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-0 focus:border-gray-300 block w-full py-2 px-3" placeholder="1234 5678 9101" required> -->
                        </div>
                    </div>
                    <div class="w-full flex gap-6">
                        <div class="lg:w-1/2 md:w-1/2 sm:w-1/2 w-full mt-4">
                        <x-splade-input name="cardExpiryDate" label="Expiry Date" required
                        placeholder="mm/yy"/>
                            <!-- <span class="text-black text-sm font-semibold">Expiry Date</span>
                            <input type="date" id="phone" class=" mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-0 focus:border-gray-300 block w-full py-2 px-3" placeholder="mm/yy" required> -->
                        </div>
                        <div class="lg:w-1/2 md:w-1/2 sm:w-1/2 w-full mt-4">
                        <x-splade-input name="cardCVV" label="CVC / CVV" required
                        placeholder="123"/>
                            <!-- <span class="text-black text-sm font-semibold">CVC / CVV</span>
                            <input type="number" id="email" class=" mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-0 focus:border-gray-300 block w-full py-2 px-3" placeholder="123" required> -->
                        </div>
                    </div>
                </div>
 
                <div class="w-full mt-12">
                    <div class="w-full">
                    <x-splade-submit label="Pay  £ {{$totalPrice}}"  class="rounded-md bg-sky-500 text-white py-2 px-12 font-semibold text-lg"/>

                      <!-- <button><a  class="rounded-md bg-sky-500 text-white py-2 px-16 font-semibold text-lg"> <i class="fa-solid fa-lock mr-2"></i>Pay ₹349.15</a></button> -->
                    </div>
 
                </div>
                </x-splade-form>   
 
            </div>
 
            <div class="lg:w-1/4 md:w-1/4 sm:w-1/4 w-full bg-white border-2 border-gray-300">
 
                <div class="w-full border-b border-gray-300">
                    <div class="h-48">
                        <img class=" h-full w-full object-fill" src="{{$hotelMoreDetails['Images']['Image'][0]}}" alt="">
                    </div>
                    <div class="flex justify-between bg-white p-2">
                        <div class="flex flex-col">
                            <span class="text-black font-semibold text-md">{{$bookingDetails['HotelName']}}</span>
                            <span class="text-lg">
                                <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                                <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                                <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                                <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                                <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                            </span>
 
 
                            <span  class="text-gray-600 font-semibold text-xs mt-1">{{$hotelMoreDetails['Address']}}</span>
                            <!-- <span  class="text-gray-600 font-semibold text-xs mt-1">Antalys</span>
                            <span  class="text-gray-600 font-semibold text-xs mt-1">Turky </span>
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
                        <span class="text-gray-500 font-semibold text-md">{{$searchParams['adults']}} adults</span>
                        <span class="text-gray-500 mt-[2px] font-semibold text-md">{{$searchParams['children']}} children</span>  
                      </div>
                    <div class="w-full flex flex-col py-2">
                        <span class="text-black font-semibold text-lg">Dates:</span>
                        <span class="text-gray-500 font-semibold text-md">{{dateFormat($searchParams['checkInDate'])}} to {{dateFormat($searchParams['checkOutDate'])}}</span>
                    </div>
                       
                    @php
                    use Carbon\Carbon;
                       $checkIn = Carbon::parse($searchParams['checkInDate']);
                       $checkOut = Carbon::parse($searchParams['checkOutDate']);

                        $durationInDays = $checkOut->diffInDays($checkIn);
                    @endphp
                    <div class="w-full flex flex-col py-2">
                        <span class="text-black font-semibold text-lg">Duration:</span>
                        <span class="text-gray-500 font-semibold text-md">{{ $durationInDays }} Nights</span>
                    </div>
                    <div class="w-full flex flex-col py-2">
                        <span class="text-black font-semibold text-lg">Board Basis:</span>
                        <span class="text-gray-500 font-semibold text-md">{{$bookingDetails['selectedOption'][0]['BoardType']}}</span>
                    </div>
                    <div class="w-full flex flex-col py-2">
                        <span class="text-black font-semibold text-lg">Rooms:</span>
                        {{-- start --}}
@if(isset($roomTypeList['Rooms']['Room'][0])) 
{{-- <span class="text-gray-500 font-semibold text-sm">
    {{$roomTypeList['Rooms']['Room'][0]['RoomName'] }}
</span> --}}
<span class="text-gray-500 font-semibold text-md">{{$searchParams['rooms']}}X {{$bookingDetails['selectedRoom']['Rooms']['Room'][0]['RoomName']}} </span>
@else 
{{-- <span class="text-gray-500 font-semibold text-sm">
{{$roomTypeList['Rooms']['Room']['RoomName'] }}
</span> --}}
@php
if (!isset($bookingDetails['selectedOption'][0]['Rooms']['Room'][0])) {
    $bookingDetails['selectedOption'][0]['Rooms']['Room'] = makeArrayWithIndex($bookingDetails['selectedOption'][0]['Rooms']['Room']);   //calling helper function to make 0 index
}

@endphp

<span class="text-gray-500 font-semibold text-md">{{$searchParams['rooms']}}X {{$bookingDetails['selectedOption'][0]['Rooms']['Room'][0]['RoomName']}} </span>
                        
    @endif
{{-- end --}}
                        {{-- <span class="text-gray-500 font-semibold text-md">{{$searchParams['rooms']}}X {{$bookingDetails['selectedRoom']['Rooms']['Room'][0]['RoomName']}}</span> --}}
                    </div>
                    <div class="w-full flex flex-col py-2">
                        <span class="text-gray-500 font-semibold text-xs">Hotel supplied through Elevate Tourism LLC (USD)</span>
                    </div>
 
                </div>
 
                {{-- <div class="w-full border-b border-gray-300 p-4">
                    <div class="w-full">
                        <span class="text-red-500 font-semibold text-xl">Flight Information</span>
                    </div>
                    <div class="w-full py-2">
                        <i class="fa-solid fa-plane mr-2 text-sky-500 text-lg"></i>
                        <span class="text-sky-500 font-semibold text-lg mr-4">Out Bound</span>
                        <span class="text-gray-500 font-semibold text-lg">Sun 25 Jul 2023</span>
                    </div>
                    <div class="w-full py-2">
                        <span class="text-black font-normal text-lg mr-4">Flight EK 2X</span>
                    </div>
                    <div class="w-full py-2">
                        <div class="w-full flex justify-between h-max bg-gray-200 p-4">
                            <div class="flex flex-col ">
                                <span class="text-gray-900 font-semibold text-md">Antalya Coast</span>
                                <span class="text-xs text-black font-semibold">14.20</span>
                                <span class="text-xs text-black font-semibold">Duration: 7h om</span>
                            </div>
                            <div class=" flex justify-center">
                                <i class="fa-solid fa-plane mr-2 text-sky-500 text-lg"></i>
                            </div>
                            <div class="flex flex-col ">
                                <span class="text-gray-900 font-semibold text-md">Dubai</span>
                                <span class="text-xs text-black font-semibold">00.20 <span class="text-red-400">(1 Day)</span></span>
                            </div>
 
                        </div>
                        <div class="w-full bg-gray-200 p-4">
                            <span class="text-black font-semibold text-xs border-4 border-sky-300 py-1 px-2 rounded-md">20kg hold luggage included</span>
                        </div>
 
                    </div>
                </div>
 
                <div class="w-full border-b border-gray-300 p-4">
 
                    <div class="w-full py-2">
                        <i class="fa-solid fa-plane fa-rotate-180 mr-2 text-sky-500 text-lg"></i>
                        <span class="text-sky-500 font-semibold text-lg mr-4">In Bound</span>
                        <span class="text-gray-500 font-semibold text-lg">Sun 25 Jul 2023</span>
                    </div>
                    <div class="w-full py-2">
                        <span class="text-black font-normal text-lg mr-4">Flight EK 2X</span>
                    </div>
                    <div class="w-full py-2">
                        <div class="w-full flex justify-between h-max bg-gray-200 p-4">
                            <div class="flex flex-col ">
                                <span class="text-gray-900 font-semibold text-md">Dubai</span>
                                <span class="text-xs text-black font-semibold">14.20</span>
                                <span class="text-xs text-black font-semibold">Duration: 7h om</span>
                            </div>
                            <div class=" flex justify-center">
                                <i class="fa-solid fa-plane fa-rotate-180 mr-2 text-sky-500 text-lg"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-gray-900 font-semibold text-md">Antalya Coast</span>
                                <span class="text-xs text-black font-semibold">00.20 <span class="text-red-400">(1 Day)</span></span>
                            </div>
 
                        </div>
                        <div class="w-full bg-gray-200 p-4">
                            <span class="text-black font-semibold text-xs border-4 border-sky-300 py-1 px-2 rounded-md">20kg hold luggage included</span>
                        </div>
 
                    </div>
                </div>
 
                <div class="w-full p-4">
                    <div class="w-full flex justify-between">
                        <span class="text-lg font-normal text-gray-600">Hold Luggage: 2 x Hold Bags</span>
                        <span class="text-lg font-normal text-gray-600">Included</span>
                    </div>
                    <div class="w-full flex justify-between py-4">
                        <div class="flex flex-col " >
                            <span class="text-black font-semibold text-lg ">Total Price</span>
                            <span class="text-xs text-gray-500">Ref: B104112568</span>
                        </div>
                        <div class="flex justify-center">
                            <span class="text-xl text-sky-500 font-bold"> ₹ 356.25</span>
 
                        </div>
 
                    </div>
                </div>
 
                <div class="w-full p-4">
                    <button class="w-full py-2 bg-sky-400 text-white  font-semibold text-lg rounded-md">Continue to Checkout</button>
                </div> --}}
 
            </div>
        </div>
 
    </div>
    <x-footer/>