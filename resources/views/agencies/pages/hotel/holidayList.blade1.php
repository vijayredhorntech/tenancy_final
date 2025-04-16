@stack('customStyle')
<Style>

</Style>
{{-- @dd("hotels are",$hotels->items()) --}}
{{-- @dd($searchParams) --}}
{{-- @dd($hotels['Response']['Body']['HotelsReturned']) --}}

@php
    if (session()->get('allFilters')) {
        $sessionget = session()->get('allFilters');
    } else {
        $sessionget = [];
    }
@endphp
{{-- @dd($sessionget); --}}


<x-layout>
    @php
        $cityName = App\Models\City::where('cityID', '=', $searchParams['city'])->first();

        $countryName = $cityName->country->countryName;
        // dd($countryName);

        $cityName = $cityName['CityName'];
        //  dd("city iss", $cityName)
        session(['filterRatings' => [], 'moreFilter' => []]);

    @endphp


    <div class="w-full h-max ">
        <div
            class="w-full h-96 bg-no-repeat bg-center bg-cover bg-[url('https://plus.unsplash.com/premium_photo-1682145930966-712ce7177919?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')]">

        </div>
    </div>

    {{-- <Search :searchParams="{{ json_encode($searchParams) }}" /> --}}
    <div class="container w-[95%] mx-auto bg-sky-400 border-2 border-sky-400 p-2  rounded-lg m-3">
        {{-- @dd("hh",$searchParams) --}}
        <Search :cityName="$cityName" :CountryName="{{ json_encode($countryName) }}"
            :searchParams="{{ json_encode($searchParams) }}" />

    </div>

    <div class="lg:w-3/4 md:w-3/4 sm:w-full w-full h-max m-auto  py-4 bg-white ">
        <Timer />
        @if ($sessionget)
            <div class="container border-2 border-gray-200 space-y-6 ">
                <span class="text-red-500 text-md font-bold">Selected Filters </span>
                <div class="container flex flex-row items-center space-x-12">
                    <div class="container w-24 ">
                        <a href="{{ route('hotel.resetFilter') }}">
                            <span class="text-base uppercase border-2 p-2 rounded-lg border-gray-200">Reset</span>
                        </a>

                    </div>

                    <div class="flex flex-row space-x-8 items-center ">

                        @foreach ($sessionget as $key => $selectedFiltered)
                            <div class="selectedItems space-x-6  p-2 flex ">
                                <div class="border-2 border-gray-200 rounded-lg shadow-lg p-2 flex items-center">
                                    <span class="text-base  uppercase text-red-500">{{ $key }}</span> ->
                                    @foreach ($selectedFiltered as $selectedFilteredValue)
                                        {{-- @dd($selectedFiltered) --}}
                                        {{-- @dd($selectedFilteredValue[0]) --}}
                                        {{ $selectedFilteredValue[0] }},
                                    @endforeach
                                    <a href="{{ route('hotel.removeFilter', ['selectedFiltered' => $key]) }}"
                                        class="text-xs shadow-none font-bold border-none">
                                        <span class=" m-2 text-xl text-black-500">x</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
@else
    <div></div>
    @endif
    </div>
    {{-- <x-common.search-bar></x-common.search-bar> --}}
    <x-common.filter-bar></x-common.filter-bar>



    <div class="lg:w-3/4 md:w-3/4 sm:w-full w-full h-max m-auto  py-4 bg-sky-200 ">

        <div class="w-full h-max flex justify-between lg:flex-row md:flex-row sm:flex-col flex-col relative ">



            <h1 class="text-xl text-red-500"> {{ $hotels->total() }} Hotels found...</h1>

        </div>

        <div class="w-full mt-10 relative ">


            {{-- <x-models.map-modal></x-models.map-modal> --}}

            <x-common.hotel-card-heading title="Trending with other Agents"
                address="https://www.google.com"></x-common.hotel-card-heading>
            {{-- @if (isset($hotels['Response']['Body']) && is_array($hotels['Response']['Body'])) --}}
            @if ($hotels->total() > 0)

                @php
                    $searchParams = session('searchParams');
                    $cityName = App\Models\City::where('cityID', '=', $searchParams['city'])->first();
                @endphp

                <div class="px-6 w-full mt-2 grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1  gap-6">
                    <div id="divContainingHotels"
                        class="w-full grid col-span-2 lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2">
                        @php
                            $hotelData = $hotels->items();
                            if (!isset($hotelData[0])) {
                                $hotels = makeArrayWithIndex($hotels->items());

                                // dd($hotels);
                            } else {
                                $hotels1 = $hotels;
                                $hotels = $hotels->items();
                            }
                        @endphp

                        {{-- @dd("nnn", $hotels); --}}
                        @foreach ($hotels as $hotel)
                            @php
                                $arrayRoomPrice = null;
                                //    dd($hotel);
                            @endphp
                            {{-- @dd("mm",$hotels) --}}
                            @foreach ($hotel['Options']['Option'] as $record)
                                @if (is_array($record) && isset($record['TotalPrice']))
                                    @php
                                        $arrayRoomPrice[] = $record['TotalPrice'];
                                    @endphp
                                @endif
                                {{-- @if (is_array($record) && isset($record['TotalPrice']))
                      @php
                          $arrayRoomPrice[] = $record['TotalPrice'];
                      @endphp
                  @endif --}}
                            @endforeach

                            @php
                                $hotelDetails = hotelDetails($hotel['HotelId'], app(App\Services\PriceAggregatorService::class));
                                // dd($hotelDetails);
                            @endphp

                            {{-- @dd($hotelDetails) --}}
                            @php

                            @endphp
                            <x-common.hotel-card
                                hotel-url="{{ route('hotel.details', ['hotelIdd' => $hotel['HotelId']]) }}"
                                hotel-name="{{ $hotel['HotelName'] }}" city-name="{{ $cityName['CityName'] }}"
                                hotel-desc="" rating-count="{{ $hotel['StarRating'] }}"
                                rating-status="{{ $hotel['StarRating'] > 4 ? 'Excellent' : 'Good' }}"
                                price="{{ empty($arrayRoomPrice) ? 'N/A' : '£ ' . min($arrayRoomPrice) }}"
                                {{-- price="£ {{ empty($arrayRoomPrice) ? 'N/A' : min($arrayRoomPrice) }} to £ {{ empty($arrayRoomPrice) ? 'N/A' : max($arrayRoomPrice) }}" --}} {{-- price="£ {{ min($arrayRoomPrice) }} to  £ {{ max($arrayRoomPrice) }}" --}}
                                hotel-image="{{ $hotelDetails['Images']['Image'][0] }}"></x-common.hotel-card>
                        @endforeach
                        {{-- <button wire:click="loadMore">Load More</button> --}}

                    </div>

                    <div id="mapDiv"
                        class='map  w-full p-2 h-max bg-white border-4 border-sky-400 rounded-lg hidden'>
                        <div class="flex brder-2 border-black border-2 border-black" id="map-container">
                            <div id='map' class='w-full h-full border-2 border-red-600'
                                style='width: 900px; height: 600px;'>
                                <div class="mx-8 w-full h-max my-8 text-lg " id='infoElement'
                                    style='width: 100%; height: 100%;'></div>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <p class="text-3xl ml-12  font-semibold">No Hotels Found</p>
            @endif

            <div id="data-wrapper" class="w-full ">

            </div>

            {{-- @dd("working",$hotels1->total()); --}}
            @if ($hotels1->total() > 12)
                <button id="loadmore" class="text-md text-white bg-cyan-400 p-2 text-center">Load More</button>
            @endif

            <div class="loader hidden">
                <div class=" flex items-center justify-center">
                    <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500 border-solid"></div>
                </div>
                {{-- <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500 border-solid"></div>
                    </div> --}}

            </div>
        </div>

    </div>
    <!-- Button to open the modal -->


    <div id="loading_overlay1" class="hidden">
        <div
            class="fixed inset-0  justify-center container flex  h-screen w-full items-center border border-2 z-30 bg-white opacity-70">

        </div>
        <div class="z-40 fixed inset-0  justify-center container flex  h-screen w-full items-center">
            <div class="loader4 "></div>
            <div class="loader3 "></div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script>
        // var searchParams = {!! json_encode($searchParams) !!};
        var searchParams = @json($searchParams);
        var hotelLastPage = @json($hotels1);
        var lastPage = hotelLastPage['last_page'];

        var ENDPOINT = "{{ route('hotel.holidayList') }}";
        var page = 1;
        $(document).ready(function() {
            console.log('document is ready')
            // $(window).scroll(function() {
            //     if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
            //         console.log('firstPage', page);
            //         console.log('lastPage', lastPage);
            //         while (page < lastPage) {
            //             $('.loader').show();
            //             page++;
            //             LoadMore(page);
            //         }
            //     }
            // });


            $('#loadmore').click(function() {
                // alert('Please wait working');
                console.log('loadmore is working');
                console.log('currentPage', page);
                console.log('lastPage', lastPage);
                $('.loader').show();
                while (page < lastPage) {
                    page++;
                    LoadMore(page);
                    if (page == lastPage) {
                        $('#loadmore').hide();
                    }
                    break;
                }
            })

        })

        // $('.loader').hide();


        function LoadMore(page) {
            // alert("Page : " + page);
            // console.log('dataparams', ENDPOINT + JSON.stringify(searchParams) + "?page=" + page);
            var endpointUrl = ENDPOINT + "?" + $.param(searchParams) + "&page=" + page;
            var currentUrl = window.location.href;
            console.log('currentUrl url', currentUrl + "&page=" + page);

            $.ajax({
                    url: currentUrl + "&page=" + page,
                    datatype: "html",
                    type: "get",
                    beforeSend: function() {
                        $('.loader').show();
                    }
                })
                .done(function(response) {
                    console.log('response is ', response);
                    if (response.html == '') {
                        $('.loader').hide();
                        $('.loader').html("End");
                        return;
                    }

                    $('.loader').hide();
                    $("#data-wrapper").append(response.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }
    </script>



    {{-- newslatter --}}
    <x-common.news-letter></x-common.news-letter>


    <x-splade-script>
        document.getElementById('toggleMapShow').addEventListener('click', function () {


        var mapContainer = document.querySelector('.map');
        var showMap = document.querySelector('.showMap');
        var hideMap = document.querySelector('.hideMap');
        var divContainingHotels = document.querySelector('#divContainingHotels');
        mapContainer.classList.toggle('hidden');
        showMap.classList.toggle('hidden');
        hideMap.classList.toggle('hidden');


        divContainingHotels.classList.remove('col-span-2');
        divContainingHotels.classList.remove('lg:grid-cols-4');
        divContainingHotels.classList.remove('md:grid-cols-4');
        divContainingHotels.classList.remove('sm:grid-cols-2');


        divContainingHotels.classList.add('lg:grid-cols-2');
        divContainingHotels.classList.add('md:grid-cols-2');
        divContainingHotels.classList.add('sm:grid-cols-1');

        {{--      divContainingHotels.classList.toggle('grid-cols-1'); --}}
        {{--      divContainingHotels.classList.toggle('grid-cols-2'); --}}
        });

        document.getElementById('toggleMapHide').addEventListener('click', function () {
        var mapContainer = document.querySelector('.map');
        var showMap = document.querySelector('.showMap');
        var hideMap = document.querySelector('.hideMap');
        var divContainingHotels = document.querySelector('#divContainingHotels');
        mapContainer.classList.toggle('hidden');
        showMap.classList.toggle('hidden');
        hideMap.classList.toggle('hidden');


        divContainingHotels.classList.add('col-span-2');
        divContainingHotels.classList.add('lg:grid-cols-4');
        divContainingHotels.classList.add('md:grid-cols-4');
        divContainingHotels.classList.add('sm:grid-cols-2');
        {{--      divContainingHotels.classList.toggle('grid-cols-1'); --}}
        {{--      divContainingHotels.classList.toggle('grid-cols-2'); --}}

        divContainingHotels.classList.remove('lg:grid-cols-2');
        divContainingHotels.classList.remove('md:grid-cols-2');
        divContainingHotels.classList.remove('sm:grid-cols-1');
        });


        var yourVariable = @json($hotels);
        console.log("hotelss is",yourVariable)
        var cityDetails = @json($cityName['CityName']);
        var cityName = cityDetails;

        var hotelNames= yourVariable;
        console.log("thissdddd is my hotel is",hotelNames);
        console.log("thissdddd is my city", cityName);


        mapboxgl.accessToken =
            'pk.eyJ1Ijoicm56YWo2MCIsImEiOiJjbHB6M3U4NTYxM3owMmlwZmcxbnFyZ3Z1In0.dOAVa2Dq7btKxFdPlihPnA';
        const
        accessToken =
            'pk.eyJ1Ijoicm56YWo2MCIsImEiOiJjbHB6M3U4NTYxM3owMmlwZmcxbnFyZ3Z1In0.dOAVa2Dq7btKxFdPlihPnA';


        const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [76.7794, 30.7333], // Chandigarh coordinates
        zoom: 10,
        });


        <!-- // using location  -->


        hotelNames.forEach(async hotelName => {
        const response = await fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${hotelName.HotelName},
        ${cityName}.json?access_token=${accessToken}`);
        <!-- const response = await fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${hotelName.HotelName},Anshun.json?access_token=${accessToken}`); -->

        const moreHotelDetails = await fetch(`/api/fetchhotelmoredetails/${hotelName.HotelId}`);
        const moreHotelDetailsData = await moreHotelDetails.json();
        {{-- console.log('morehotelDetails', moreHotelDetails,moreHotelDetailsData); --}}
        const image = moreHotelDetailsData.Images.Image[0];

        const data = await response.json();
        const coordinates = data.features[0].center;
        const placeName = data.features[0].place_name;
        map.setCenter(coordinates);
        console.log('map is',map)
        const marker = new mapboxgl.Marker()
        .setLngLat(coordinates)
        .addTo(map);

        {{-- const popup = new mapboxgl.Popup({ offset: 25 })
            .setHTML(`<h3>${hotelName.HotelName}</h3><p>${placeName}</p>`); --}}


        const popup = new mapboxgl.Popup({ offset: 25 })
        .setHTML(`<img src=${image} alt="">
        <h3>${hotelName.HotelName}</h3>
        <p>${placeName}</p>`);
        <!-- //when user click on marked location ,Displaying message on right side of map -->
        marker.getElement().addEventListener('click', () => {
        <!-- // Update the info element with location details -->
        {{-- infoElement.innerHTML = `<p class="border border-gray-400 ml-2 p-2 text-black font-serif">${placeName}</p>`; --}}
        });

        marker.setPopup(popup);

        <!-- // Show popup on mouse enter -->
        marker.getElement().addEventListener('mouseenter', () => {
        popup.addTo(map);
        });

        <!-- // Hide popup on mouse leave -->
        marker.getElement().addEventListener('mouseleave', () => {
        popup.remove();
        });

        <!-- //   // Show popup on marker click -->
        marker.on('click', () => {
        marker.togglePopup();
        });
        });
    </x-splade-script>


</x-layout>
