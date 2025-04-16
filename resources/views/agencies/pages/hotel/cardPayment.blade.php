
@php
    $sessionData = session()->get('searchParams');
    //      dd($sessionData);
    //dd(session()->all());
@endphp
{{--@dd(session()->all())--}}

@php
//    $hotelMoreDetails = hotelDetails($bookingDetails['HotelId'], app(App\Services\PriceAggregatorService::class));

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
//     dd($bookingDetails,$hotelMoreDetails,$sessionData);
     $totalPrice= $bookingDetails['selectedOption'][0]['TotalPrice'] ;
//     dd($totalPrice);
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
            <div class="w-full bg-primaryDarkColor text-white p-2 rounded-t-[3px] font-semibold">
                <button onclick="goBack()">
                    <i class="fa fa-backward"></i>
                    Back
                </button>

            </div>
            <Timer/>
            <form method="get" action="{{route('hotel.cardPayment')}}">
                @csrf
                    <div class="w-full  text-black p-2 rounded-t-[3px] font-semibold mt-4">
                        Secure payment Info
                    </div>
                    <div class="p-2 border-b-[1px] border-b-primaryColor/30 flex gap-2 flew-wrap">
                        <div class="p-2 text-black">
                            <label for="type1" class="flex mb-4 items-center cursor-pointer">
                                <input type="radio" class="form-radio h-5 w-5 text-buttonColor1" name="type"
                                       id="type1" checked>
                                <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png"
                                     class="h-8 ml-3">
                            </label>
                            <span class="font-semibold">Card Payment</span>
                        </div>
                        <div class="p-2 text-black">
                            <label for="type2" class="flex items-center cursor-pointer">
                                <input type="radio" class="form-radio h-5 w-5 text-buttonColor1" name="type"
                                       id="type2">
                                {{--                                                        <img src="https://i.postimg.cc/g03pSj12/paypal.webp" class="h-16 ml-3">--}}
                                <img src="{{ asset('assets/images/net-banking1.png') }}" class="h-8 ml-3">
                            </label>
                            <span class="font-semibold">Net Banking</span>
                        </div>
                        <div id="cashier" class="p-2 text-black">

                            <label for="type3" class="flex mb-2 items-center cursor-pointer">
                                <input type="radio" class="form-radio h-5 w-5 text-buttonColor1" name="type"
                                       id="type3">
                                {{--                                                        <img src="https://i.postimg.cc/W1BFqDMN/main-qimg-eb7037139aad1014bf0ce229052f1218.webp" class="h-12 ml-3">--}}
                                <img src="{{ asset('assets/images/cashImg1.png') }}" class="h-8 ml-3">
                            </label>
                            <span class="font-semibold">Cash Payment</span>
                        </div>
                    </div>

                <div id="inputForm">
                         <form method="get" action="{{route('hotel.cardPayment')}}" class="p-2">
                             @csrf
                              <div class="w-full grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 grid-col-1 gap-2">
                                  <div class="w-full relative flex flex-col">
                                      <label for="travelClass" class="text-black/80 font-medium text-sm">Name on card</label>
                                      <input type="text" name="nameOnCard"  placeholder="John Smith" required
                                             class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>
                                      <span id="lookupAddressError" class="error text-xs text-redColor"></span>

                                  </div>
                                  <div class="w-full relative flex flex-col">
                                      <label for="travelClass" class="text-black/80 font-medium text-sm">Card Number</label>
                                      <input type="number" name="nameOnCard"  placeholder="0000 0000 0000 0000" required
                                             class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>
                                      <span id="lookupAddressError" class="error text-xs text-redColor"></span>

                                  </div>
                                  <div class="w-full relative flex flex-col">
                                      <label for="country" class="text-black/80 font-medium text-sm">Expiration Date</label>
                                      <div class="grid grid-cols-2 gap-1">
                                          <select
                                              class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80">
                                              <option value="01">01 - January</option>
                                              <option value="02">02 - February</option>
                                              <option value="03">03 - March</option>
                                              <option value="04">04 - April</option>
                                              <option value="05">05 - May</option>
                                              <option value="06">06 - June</option>
                                              <option value="07">07 - July</option>
                                              <option value="08">08 - August</option>
                                              <option value="09">09 - September</option>
                                              <option value="10">10 - October</option>
                                              <option value="11">11 - November</option>
                                              <option value="12">12 - December</option>
                                          </select>
                                          <select
                                              class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80">
                                              <option value="2024">2024</option>
                                              <option value="2025">2025</option>
                                              <option value="2026">2026</option>
                                              <option value="2027">2027</option>
                                              <option value="2028">2028</option>
                                              <option value="2029">2029</option>
                                              <option value="2027">2030</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="w-full relative flex flex-col">
                                      <label for="travelClass" class="text-black/80 font-medium text-sm">Security Code</label>
                                      <input type="number" name="nameOnCard"  placeholder="000" required
                                             class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>
                                      <span id="lookupAddressError" class="error text-xs text-redColor"></span>

                                  </div>
                              </div>
                             <div class="w-full p-2 flex justify-end">
                                 <button id="submitButton" type="subit" class="showLoader w-max font-semibold text-md bg-primaryDarkColor/80 text-white/90 px-6 py-2 rounded-[3px] border-[1px] border-primaryDarkColor hover:bg-primaryDarkColor hover:text-white transition ease-in duration-2000">Proceed to
                                     Pay  £ {{$totalPrice}}</button>
                             </div>
                         </form>
                     </div>
                    <div id="paypalInfoForm" style="display: none; ">
                        <form method="get" action="{{route('hotel.cardPayment')}}" class="p-2">
                            @csrf
                            <div class="w-full grid lg:grid-cols-4 md:grid-cols-4 sm:grid-cols-2 grid-col-1 gap-2">
                                <div class="w-full relative flex flex-col">
                                    <label for="travelClass" class="text-black/80 font-medium text-sm">Select Bank</label>
                                    <select id="bank" name="bank" required
                                        class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80">
                                        <option value="sbi">State Bank of India (SBI)</option>
                                        <option value="hdfc">HDFC Bank</option>
                                        <option value="icici">ICICI Bank</option>
                                        <option value="axis">Axis Bank</option>
                                        <option value="pnb">Punjab National Bank (PNB)</option>
                                    </select>

                                </div>

                                <div class="w-full relative flex flex-col">
                                    <label for="travelClass" class="text-black/80 font-medium text-sm">Account Number</label>
                                    <input type="text" id="account-number" name="account-number"
                                           class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>

                                </div>
                                <div class="w-full relative flex flex-col">
                                    <label for="travelClass" class="text-black/80 font-medium text-sm">IFSC Code</label>
                                    <input type="text" id="ifsc-code" name="ifsc-code"
                                           class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>

                                </div>
                                <div class="w-full relative flex flex-col">
                                    <label for="travelClass" class="text-black/80 font-medium text-sm">Amount</label>
                                    <input type="text" id="amount" value="£ {{$totalPrice}}" name="amount" disabled
                                           class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>

                                </div>
                            </div>
                            <div class="w-full p-2 flex justify-end">
                                <button type="subit" class="showLoader w-max font-semibold text-md bg-primaryDarkColor/80 text-white/90 px-6 py-2 rounded-[3px] border-[1px] border-primaryDarkColor hover:bg-primaryDarkColor hover:text-white transition ease-in duration-2000">Proceed to
                                    Pay  £ {{$totalPrice}}</button>
                            </div>
                        </form>
                    </div>





                    <form id="paymentForm" method="get" action="{{route('hotel.cardPayment')}}">
                            @csrf
                        <h3 class="hidden  text-md text-center m-2" id="paymentMessage">

                             <div class="w-full p-2">
                                <button type="subit" class="showLoader w-full font-semibold text-md bg-primaryDarkColor/80 text-white/90 px-6 py-2 rounded-[3px] border-[1px] border-primaryDarkColor hover:bg-primaryDarkColor hover:text-white transition ease-in duration-2000">Proceed to
                                    Pay  £ {{$totalPrice}}</button>
                            </div>
                        </h3>
                        </form>

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

    function goBack() {
        event.preventDefault();

        console.log("go back clicked")
        window.history.back();
    }
    document.addEventListener("DOMContentLoaded", function () {
        const type1 = document.getElementById("type1");
        const type2 = document.getElementById("type2");
        const type3 = document.getElementById("type3");
        const inputForm = document.getElementById("inputForm");
        const paypalInfoForm = document.getElementById('paypalInfoForm');
        const paymentMessage = document.getElementById('paymentMessage');

        type1.addEventListener("change", function () {
            inputForm.style.display = "block"; // Show the input form when not selected
            paypalInfoForm.style.display = "none";
            paymentMessage.style.display = "none";
        });

        type2.addEventListener("change", function () {
            inputForm.style.display = "none"; // Hide the input form when selected
            paypalInfoForm.style.display = "block";
            paymentMessage.style.display = "none";
        });

        type3.addEventListener("change", function () {
            inputForm.style.display = "none"; // Hide the input form when selected
            paypalInfoForm.style.display = "none";
            paymentMessage.style.display = "block";
        });

    });

</script>


