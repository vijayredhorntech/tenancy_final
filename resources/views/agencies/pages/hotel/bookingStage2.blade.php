<x-navigation-front/>
<Timer/>

@php
    $sessionData = session()->get('searchParams');
    //      dd($sessionData);
    //dd(session()->all());
@endphp


@php
    $hotelMoreDetails = hotelDetails($bookingDetails['HotelId'], app(App\Services\PriceAggregatorService::class));
    session(['selectedHotelMoreDetails' => $hotelMoreDetails]);
    session(['selectedHotelDetails' => $bookingDetails]);
    // dd($bookingDetails,$hotelMoreDetails,$sessionData);
    // dd($bookingDetails['fetchPolicies']['Response']['Body']['CancellationDeadline']);
@endphp

@php
    use Carbon\Carbon;
    $checkIn = Carbon::parse($sessionData['checkInDate']);
    $checkOut = Carbon::parse($sessionData['checkOutDate']);
    $durationInDays = $checkOut->diffInDays($checkIn);
@endphp

<div class="lg:w-[70%] md:w-[90%] w-full p-4 mx-auto">

    <div class="w-full grid lg:grid-cols-4 md:grid-cols-4 grid-cols-1 gap-2 bg-sky-100 ">

        <div class="w-full lg:col-span-3 md:col-span-3 col-span-1 shadow-gray-400 shadow-lg ">
            <div class="w-full py-2 px-4">
                <span class="font-bold text-black text-[15px]">Your Personal Information </span>
                <span class="float-right text-md font-semibold mr-2 hover:text-black hover:font-bold">
                    <a href="{{ route('hotel.roomDetailsPdf', ['hotelId' => $bookingDetails['HotelId']]) }}">Download
                    PDF
                    Offer
                    </a>
                </span>
            </div>

            <div class="px-4">
                <div class="w-full rounded-md bg-white px-2 shadow-md shadow-gray-400 py-6">

                    @php($i = 0)
                    @for ($i = 0; $i < $sessionData['rooms']; $i++)
                        <div class=" pt-2">
                            <div class="w-full">
                                <span class="font-bold bg-sky-200 text-black text-[15px]">Room :
                                    {{ $i + 1 }}</span>
                            </div>
                            @if (array_key_exists($i, $sessionData['roomDetails']))
                                    <?php
                                    $numberofAdults = $sessionData['roomDetails'][$i]['numberofAdults'];
                                    $numberOfChildren = $sessionData['roomDetails'][$i]['numberOfChildren'];
                                    ?>

                                @php($adultCount = 1)
                                @while ($adultCount <= $numberofAdults)
                                    <span class="font-bold"> Adult {{ $adultCount }} Details:</span>
                                    <div class="w-full grid grid-cols-3 gap-6 mt-4">
                                        <div class="w-full max-w-xs">
                                            <label for="title"
                                                   class="block text-sm font-medium text-gray-700">Title</label>
                                            <select id="title" name="title"
                                                    class="mt-1 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="mr">Mr</option>
                                                <option value="mrs">Mrs</option>
                                            </select>
                                        </div>

                                        <div class="w-full flex flex-col gap-1">
                                            <label class="text-gray-600 text-sm font-medium" for="">Adult
                                                First Name</label>
                                            <input placeholder="First Name" type="text"
                                                   class="w-full rounded-md bg-white border-[1px] border-gray-600 p-2 focus:ring-0 focus:outline-none  focus:border-[#56a9de]">
                                        </div>
                                        <div class="w-full flex flex-col gap-1">
                                            <label class="text-gray-600 text-sm font-medium" for="">Last Name</label>
                                            <input placeholder="Last Name" type="text"
                                                   class="w-full rounded-md bg-white border-[1px] border-gray-600 p-2 focus:ring-0 focus:outline-none  focus:border-[#56a9de]">
                                        </div>
                                    </div>
                                    @php($adultCount++)
                                @endwhile

                                @php($childCount = 1)
                                @while ($childCount <= $numberOfChildren)
                                    <span class="font-bold"> Child {{ $childCount }} Details:</span>
                                    <div class="w-full grid grid-cols-3 gap-6 mt-4">
                                        <div class="w-full max-w-xs">
                                            <label for="title"
                                                   class="block text-sm font-medium text-gray-700">Title</label>
                                            <select id="title" name="title"
                                                    class="mt-1 block w-full py-2 px-3 border border-gray-600 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="mr">Mr</option>
                                                <option value="mrs">Mrs</option>
                                            </select>
                                        </div>

                                        <div class="w-full flex flex-col gap-1">
                                            <label class="text-gray-600 font-medium text-sm" for="">Child
                                                First Name</label>
                                            <input placeholder="First Name" type="text"
                                                   class="w-full rounded-md bg-white border-[1px] border-gray-600 p-2 focus:ring-0 focus:outline-none  focus:border-[#56a9de]">
                                        </div>
                                        <div class="w-full flex flex-col gap-1">
                                            <label class="text-gray-600 font-medium text-sm" for="">Last Name</label>
                                            <input placeholder="Last Name" type="text"
                                                   class="w-full rounded-md bg-white border-[1px] border-gray-600 p-2 focus:ring-0 focus:outline-none  focus:border-[#56a9de]">
                                        </div>
                                    </div>
                                    @php($childCount++)
                                @endwhile
                        </div>
                        @endif
                    @endfor

                </div>

            </div>

            <div class="w-full px-4 pt-6">
                <span class="font-bold text-black text-[15px]">Billing Details</span>
            </div>

            <div class="px-4 mt-2 ">
                <div class="w-full rounded-md bg-white px-2 shadow-md shadow-gray-400 py-6">
                    <div class="w-full grid grid-cols-2 gap-6 mt-4">
                        <div class="w-full flex flex-col gap-1">
                            <label class="text-gray-600 text-sm" for="">Lookup Address</label>
                            <input placeholder="Enter post code" type="text"
                                   class="w-full rounded-md bg-white border-[1px] border-gray-600 p-2 focus:ring-0 focus:outline-none  focus:border-[#56a9de]">
                        </div>
                        <div class="w-full flex flex-col gap-1">
                            <label class="text-gray-600 text-sm" for="">Address Line 1</label>
                            <input placeholder="Address Line" type="text"
                                   class="w-full rounded-md bg-white border-[1px] border-gray-600 p-2 focus:ring-0 focus:outline-none  focus:border-[#56a9de]">
                        </div>
                    </div>
                    <div class="w-full grid grid-cols-2 gap-6 mt-4">
                        <div class="w-full flex flex-col gap-1">
                            <label class="text-gray-600 text-sm" for="">Address Line 2</label>
                            <input placeholder="Address Line" type="text"
                                   class="w-full rounded-md bg-white border-[1px] border-gray-600 p-2 focus:ring-0 focus:outline-none  focus:border-[#56a9de]">
                        </div>
                        <div class="w-full flex flex-col gap-1">
                            <label class="text-gray-600 text-sm" for="">City</label>
                            <input placeholder="City" type="text"
                                   class="w-full rounded-md bg-white border-[1px] border-gray-600 p-2 focus:ring-0 focus:outline-none  focus:border-[#56a9de]">
                        </div>
                    </div>
                    <div class="w-full grid grid-cols-2 gap-6 mt-4">
                        <div class="w-full flex flex-col gap-1">
                            <label class="text-gray-600 text-sm" for="">Country </label>
                            <input placeholder="Country" type="text"
                                   class="w-full rounded-md bg-white border-[1px] border-gray-600 p-2 focus:ring-0 focus:outline-none  focus:border-[#56a9de]">
                        </div>
                        <div class="w-full flex flex-col gap-1">
                            <label class="text-gray-600 text-sm" for="">Postal Code</label>
                            <input placeholder="Code" type="text"
                                   class="w-full rounded-md bg-white border-[1px] border-gray-600 p-2 focus:ring-0 focus:outline-none  focus:border-[#56a9de]">
                        </div>
                    </div>
                    <div class="w-full grid grid-cols-2 gap-6 mt-4">
                        <div class="w-full flex flex-col gap-1">
                            <label class="text-gray-600 text-sm" for="">Contact No. </label>
                            <input placeholder="Number" type="text"
                                   class="w-full rounded-md bg-white border-[1px] border-gray-600 p-2 focus:ring-0 focus:outline-none  focus:border-[#56a9de]">
                        </div>
                        <div class="w-full flex flex-col gap-1">
                            <label class="text-gray-600 text-sm" for="">Email</label>
                            <input placeholder="Email" type="text"
                                   class="w-full rounded-md bg-white border-[1px] border-gray-600 p-2 focus:ring-0 focus:outline-none  focus:border-[#56a9de]">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="w-full bg-white rounded-md shadow-gray-500 shadow-lg">
            <div class="w-full p-2">
                <span class="font-bold text-black text-[15px]">Booking Details</span>
            </div>
            {{--           <div class="w-full h-64">--}}
            {{--                <img class="w-full h-full object-cover" src="{{ $hotelMoreDetails['Images']['Image'][0] }}" alt="">--}}
            {{--            </div>--}}

            <div class="w-full relative">
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


            <div class="w-full bg-gray-200 p-2">
                <p class="font-bold text-black text-[15px]">{{ $bookingDetails['HotelName'] }}</p>
            </div>
            <div class="w-full  p-2 border-b-[1px] border-gray-300">
                <p class="font-semibold text-gray-600 text-[14px]">{{ $hotelMoreDetails['Address'] }}</p>
            </div>
            <div class="w-full flex flex-col  border-b-[1px] border-gray-300 p-2">
                <span class="font-semibold text-red-700 text-[16px]">Check In </span>
                <span class="font-semibold text-black text-[14px]"><i class="fa fa-calendar-days mr-1"></i>
                    {{ dateFormat($sessionData['checkInDate']) }}</span>
            </div>


            <div class="w-full flex flex-col border-b-[1px] border-gray-300  p-2">
                {{-- <span class="font-semibold text-black text-[14px] ml-3"><i class="fa fa-clock mr-1"></i> {{$durationInDays}}, Night</span> --}}
                <span class="font-semibold text-black text-[14px] ml-3"><i class="fa fa-clock mr-1"></i>
                    {{ $durationInDays }} {{ $durationInDays == 1 ? 'Night' : 'Nights' }} & {{ $durationInDays + 1 }}
                    Days</span>

            </div>
            <div class="w-full flex flex-col  border-b-[1px] border-gray-300 p-2">
                <span class="font-semibold text-red-700 text-[16px]">Check Out </span>
                <span class="font-semibold text-black text-[14px]"><i class="fa fa-calendar-days mr-1 "></i>
                    {{ dateFormat($sessionData['checkOutDate']) }}</span>
            </div>
            <div class="w-full flex flex-col  border-b-[1px] border-gray-300 p-2">
                <span class="font-semibold text-red-700 text-[16px]">Total Passenger</span>
                <span class="font-semibold text-black text-[14px]"><i class="fa-regular fa-user mr-1 "></i>
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

            <div class="w-full bg-gray-200 p-2">
                <p class="font-bold text-black text-[15px]">Other Details</p>
            </div>


            <div class="flex flex-col">
                <div class="w-full flex justify-between  border-b-[1px] border-gray-300 p-2">
                    <span class="font-semibold text-red-700 text-[16px]">Room Type </span>
                    <span class="font-semibold text-black text-[14px]"> {{ucwords( session('selectedOptionRoom')[0]['RoomName'])}}</span>
                </div>
                <div class="w-full flex justify-between  border-b-[1px] border-gray-300 p-2">
                    <span class="font-semibold text-red-700 text-[16px]">Per Room Price:</span>
                    <span class="font-semibold text-black text-[14px]">£ {{session('dailyPriceOfRoom')[0]}}</span>
                </div>
                <div class="w-full flex justify-between  border-b-[1px] border-gray-300 p-2">
                    <span class="font-semibold text-red-700 text-[16px]">Total Price</span>
                    <span class="font-bold text-black text-[14px]">£
                        {{ $bookingDetails['selectedOption'][0]['TotalPrice'] }}</span>
                </div>
            </div>

            <div class="w-full bg-gray-200 p-2">
                <p class="font-bold text-black text-[15px]">Cancellation Policy</p>
            </div>
            <div class="w-full p-2">

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
                        @if ($availabilityText !== '<span class="text-red-500">Not available</span>')
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

                            <ol class="font-sans font-semibold text-sm text-red-700">*From {{ dateFormat($policy['From']) }} the
                                amount
                                {{ $policy['Value'] }}
                                {{ $policy['Type'] === 'Percentage' ? '%' : $policy['Type'] }}
                                of the full stay will be charged.
                            </ol>

                        @endforeach
                    @endif
                @endif


                @if (session('imporatnatNote'))
                    <div class="w-full bg-gray-200 p-2 mt-1">
                        <p class="font-bold text-black text-[15px]">Important Information</p>
                    </div>
                    @foreach (session('imporatnatNote') as $data)
                        <li class="font-sans text-black text-sm text-justify"
                            style="text-align: justify; text-justify: inter-word; word-wrap: break-word;"> {!! trim(ucwords(strtolower(str_replace(['*', '#'], '', $data)))) !!}</li>

                    @endforeach
                @endif

                {{--                <p class="font-bold text-red-700 text-[15px] text-center">After Cancellation charge of GBP 40 will be--}}
                {{--                    applied</p>--}}
            </div>
            <div class="w-full bg-green-100 p-2 cursor-pointer">
                <p class="font-bold text-green-700 text-[15px]"><i class="fa-solid fa-hand-point-up mr-1"></i>Check
                    In Instructions</p>
            </div>
            <div class="w-full p-2">

                <p class="font-bold text-black text-[12px] text-center">{{$hotelMoreDetails['Facilities']['Facility'][0]['FacilityName']}} & {{$hotelMoreDetails['Facilities']['Facility'][1]['FacilityName']}}
                </p>
            </div>
        </div>
    </div>

</div>

<x-footer/>


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
