@stack('customStyle')
@php
    if (session()->get('allFilters')) {
        $sessionget = session()->get('allFilters');
    } else {
        $sessionget = [];
    }
@endphp

@php
    $totalAdults = 0;
    $totalChildrens = 0;

    $roomDetails = json_decode($searchParams['roomDetails'], true);
    foreach ($roomDetails as $key => $roomDetail) {
        $totalAdults += $roomDetail['numberofAdults'];
        $totalChildrens += $roomDetail['numberOfChildren'];
    }
@endphp

<x-agency.layout>
    @php
        session(['filterRatings' => [], 'moreFilter' => []]);
        $cityName = App\Models\City::where('cityID', '=', $searchParams['city'])->first();
        $countryName = $cityName->country->countryName;
        $cityName = $cityName['CityName'];
        
     
        
        $totalNights = \Carbon\Carbon::parse($searchParams['checkOutDate'])->diffInDays(\Carbon\Carbon::parse($searchParams['checkInDate']));
    @endphp

    <div class="lg:w-[80%] md:w-[90%] w-full px-2 mx-auto pt-6 bg-[#f3f4f6] rounded-[3px] z-40 lg:sticky md:sticky sm:sticky static top-[70px]">
        <div class="w-full bg-primaryDarkColor rounded-[3px] grid lg:grid-cols-2">
            <!-- Search summary header -->
            <div class="w-full grid grid-cols-3 lg:border-b-[0px] border-b-[1px] border-b-white">
                <div class="w-full flex flex-col justify-center items-center px-2 py-3 text-white border-r-[1px] border-r-white">
                    <span class="lg:text-sm md:text-sm sm:text-sm text-xs font-normal text-white/80">Hotel In </span>
                    <span class="lg:text-lg md:text-lg sm:text-lg text-sm font-semibold"><i class="fa fa-location-dot mr-1 text-sm"></i> {{ $cityName }}</span>
                </div>
                <div class="w-full flex flex-col justify-center items-center px-2 py-3 text-white border-r-[1px] border-r-white">
                    <span class="lg:text-sm md:text-sm sm:text-sm text-xs font-normal text-white/80">Check In  </span>
                    <span class="lg:text-lg md:text-lg sm:text-lg text-sm font-semibold"><i class="fa fa-calendar-days mr-1 text-sm"></i> {{ $searchParams['checkInDate'] }}</span>
                </div>
                <div class="w-full flex flex-col justify-center items-center px-2 py-3 text-white lg:border-r-[1px] lg:border-r-white">
                    <span class="lg:text-sm md:text-sm sm:text-sm text-xs font-normal text-white/80">Check Out  </span>
                    <span class="lg:text-lg md:text-lg sm:text-lg text-sm font-semibold"><i class="fa fa-calendar-days mr-1 text-sm"></i> {{ $searchParams['checkOutDate'] }}</span>
                </div>
            </div>
            <div class="w-full grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-3 grid-cols-1">
                <div class="w-full flex lg:col-span-2 md:col-span-2 sm:col-span-2 col-span-1 justify-evenly gap-2 lg:border-r-[1px] md:lg:border-r-[1px] sm:lg:border-r-[1px] border-r-[0px] border-r-white lg:border-b-[0px] md:border-b-[0px] sm:border-b-[0px] border-b-[1px] border-b-white">
                    <div class="flex flex-col justify-center items-center px-2 py-3 text-white">
                        <span class="text-sm font-medium text-white/80">Adults  </span>
                        <span class="text-lg font-semibold"><i class="fa fa-person mr-1 text-sm"></i> {{ $totalAdults }}</span>
                    </div>
                    <div class="flex flex-col justify-center items-center px-2 py-3 text-white">
                        <span class="text-sm font-medium text-white/80">Child  </span>
                        <span class="text-lg font-semibold"><i class="fa fa-child mr-1 text-sm"></i> {{ $totalChildrens }}</span>
                    </div>
                    <div class="flex flex-col justify-center items-center px-2 py-3 text-white">
                        <span class="text-sm font-medium text-white/80">Nights  </span>
                        <span class="text-lg font-semibold"><i class="fa fa-moon mr-1 text-sm"></i> {{ $totalNights }}</span>
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
                    <Link href="#modifySearch" class="w-max h-max text-center showLoader font-semibold text-md bg-transparent text-white lg:px-4 md:px-6 px-2 py-2 rounded-[3px] border-[1px] border-white/80 hover:bg-white hover:text-primaryDarkColor transition ease-in duration-2000">
                        Modify Search</Link>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full  holidayvue mx-auto">
    <section class="lg:w-[80%] md:w-[90%] w-full px-2 mx-auto pt-6 bg-[#f3f4f6] rounded-[3px] grid lg:grid-cols-4 gap-4" style="position: relative">
        <div class="w-full " style="position: relative;">
            <div class="bg-white rounded-md shadow-lg shadow-black/10" style="position: sticky; top: 190px;">
             <div class="w-full p-2 bg-primaryDarkColor text-white font-semibold text-lg rounded-t-[3px] flex justify-between">
                <span>Filter Result</span>
                <button class="mr-4 lg:hidden text-lg" ></button>
                   <div v-show="toggleFilterBy" class="border-[1px] border-primaryColor/30 border-t-[0px]">
                   </div>
              </div>
            </div>
        </div>
        <div class="w-full lg:col-span-3">
            <div class="w-full flex flex-wrap rounded-t-[3px]">
               <!-- holiday list -->
               <div class="px-2 py-3 font-semibold bg-primaryDarkColor rounded-t-[3px] text-md text-white w-full flex items-center justify-between border-b-[1px] border-b-white">
                    <div class="flex items-center gap-2">
                        <div class="w-max border-r-[1px] border-r-white px-2">
                            <i class="fa-solid fa-hotel mr-2 text-lg"></i> Hotels ( {{ count($hotels) }} <span class="text-xs"> Found </span>)
                        </div>
                        <div class="px-2">
                            <button v-if="!showMap" class="text-lg font-semibold" title="Show Map" @click="showMaps"><i class="fa fa-map"></i></button>
                            <button v-if="showMap" class="text-lg font-semibold" title="Hide Map" @click="closeMaps"><i class="fa fa-eye-slash"></i></button>
                        </div>
                    </div>
                    <div class="w-max">
                                <select v-model="sortBy"  class="w-full px-6 py-0.5 bg-white font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-white/80 focus:border-white bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80">
                                    <option value="lowPrice">Low price</option>
                                    <option value="highPrice">High price</option>
                                </select>
                            </div>
               </div>

               <div class="w-full">
                <div class="p:0  w-full grid grid-cols-1 gap-2">
                    <div class="hotel-div order-last lg:order-first ">
                        
                            <div class=" w-full  gap-2">
                                <div id="divContainingHotels" class="w-full grid col-span-2 grid-cols-1 sm:grid-cols-2  md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-2">


                                    @foreach($hotels as $hotel)
                                    <div class="w-full bg-white shadow-primaryDarkColor/30 shadow-lg mt-4 rounded-[3px] border-[1px] border-primaryColor/50">
                                        <a href="#" class="w-full">
                                            <div class="w-full h-auto rounded-[3px]">

                                                <div class="h-[200px] relative overflow-hidden rounded-t-[3px]">
                                                       <div class="absolute -right-8 top-0 h-16 w-32 rotate-45 z-50">
                                                                <div class="bg-redColor text-xs text-center font-semibold text-white z-50">
                                                                    {{ ($hotel['Vendor'] ?? 'TR') === 'Stuba' ? 'ST' : (($hotel['Vendor'] ?? 'TR') === 'RateHawk' ? 'RH' : 'TR') }}
                                                                </div>
                                                        </div>

                                                    <!-- Placeholder for image -->
                                                    <!-- slider -->
                                                    <div class="swiffy-slider slider-item-ratio slider-item-ratio-16x9 slider-nav-animation slider-nav-animation-fadein">
                                                            <ul class="slider-container">
                                                                @if (isset($hotel['Details']['Image']) && is_array($hotel['Details']['Image']))
                                                                    @foreach (array_slice($hotel['Details']['Image'], 0, 5) as $key => $image)
                                                                        <li>
                                                                            <img src="{{ $image }}" alt="Hotel Image" loading="lazy" class="object-cover w-full h-40 rounded-md">
                                                                        </li>
                                                                    @endforeach
                                                                @endif
                                                            </ul>

                                                            <button type="button" class="slider-nav" aria-label="Go to previous"></button>
                                                            <button type="button" class="slider-nav slider-nav-next" aria-label="Go to next"></button>

                                                            <!-- <div class="slider-indicators">
                                                                @if (isset($hotel['Details']['Image']) && is_array($hotel['Details']['Image']))
                                                                    @foreach (array_slice($hotel['Details']['Image'], 0, 5) as $key => $image)
                                                                        <button aria-label="Go to slide" class="{{ $loop->first ? 'active' : '' }}"></button>
                                                                    @endforeach
                                                                @endif
                                                            </div> -->
                                                        </div>

                                                        <!-- slider -->

                                                    </div>
                                                    
                                                <!-- Hotel Info -->
                                               
                                                </div>
                                            <div class="flex justify-between bg-white p-2">
                                                    <div class="flex flex-col w-full">
                                                        <!-- Star Rating and Status -->
                                                        <div class="flex justify-between w-full">
                                                            <div class="w-max">
                                                                <span class="text-xs">
                                                                    @for($i = 1; $i <= 5; $i++)
                                                                        <i class="fa-solid fa-star" style="color: {{ $i <= $hotel['StarRating'] ? '#16a34a' : 'gray' }}; margin-right: 2px;"></i>
                                                                    @endfor
                                                                </span>
                                                            </div>
                                                            <div class="w-max px-2">
                                                                <span class="text-green-600 font-semibold text-sm">
                                                                    {{ $hotel['StarRating'] >= 4.5 ? 'Excellent' : 'Good' }}
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <!-- Hotel Name and Location -->
                                                        <span class="text-primaryDarkColor font-bold text-md mt-2 w-42">
                                                            <i class="fa fa-hotel mr-1"></i> {{ $hotel['HotelName'] }}
                                                        </span>
                                                        <span class="text-redColor font-semibold text-sm mt-1">
                                                            <i class="fa fa-location-dot mr-1"></i> {{ $cityName }}, {{ $countryName }}
                                                        </span>

                                                        <!-- Pricing -->
                                                        <span class="mt-2 text-gray-600 font-medium text-sm">
                                                            from <span class="font-bold text-xl text-primaryDarkColor">£ {{ $hotel['Options']['Option'][0]['TotalPrice'] ?? 'N/A' }}</span>
                                                        </span>
                                                        <span class="font-semibold text-[#16a34a] text-xs text-redColor">
                                                            (Total for {{ $totalNights }} {{ $totalNights > 1 ? 'Nights' : 'Night' }} & {{ $totalNights + 1 }} Days)
                                                        </span>
                                                    </div>
                                                </div>
                                        </a>
                                    </div>
                                   @endforeach
                                      

                                </div>
                                <!--                        <SkeletonLoader v-if="showSkeleton" />-->

                            </div>
                            <div class="mt-12 w-full flex justify-center">
                                <button class="w-max text-center showLoader font-semibold text-md bg-primaryDarkColor/80 text-white/90 px-6 py-2 rounded-[3px] border-[1px] border-primaryDarkColor hover:bg-primaryDarkColor hover:text-white transition ease-in duration-2000" v-if="hasMoreData" @click="loadMore">Load More <i class="fa fa-download ml-2"></i> </button>
                            </div>
                   
                    
                        <!--                <SkeletonLoader v-if="showSkeleton" />-->
                    </div>

                 
                </div>
              </div>

               <!-- end holiday list -->
            </div>
        </div>
    </section>
    
      

        <!-- Hotel listing -->
        <div class="w-full">
            <div :class="{ 'w-full grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-2': showMap, 'p:0 w-full grid grid-cols-1 gap-2': !showMap }">
                <div class="hotel-div order-last lg:order-first">
             
                </div>

                <!-- Map Section -->
                <div class="map w-full pt-4" v-show="showMap">
                    <!-- Map content would go here -->
                </div>
            </div>
        </div>
    </div>

    <div id="loading_overlay1" class="hidden">
        <div class="fixed inset-0 justify-center container flex h-screen w-full items-center border border-2 z-30 bg-white opacity-70"></div>
        <div class="z-40 fixed inset-0 justify-center container flex h-screen w-full items-center">
            <div class="loader4"></div>
            <div class="loader3"></div>
        </div>
    </div>
</x-agency.layout>