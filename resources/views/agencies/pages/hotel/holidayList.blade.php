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

    <!-- loader part  -->

    <div id="loading_overlay1" class="hidden">
            <div class="fixed inset-0 justify-center flex h-screen w-full bg-ternary items-center z-50 opacity-90"> </div>

            <div class="z-50 fixed inset-0  justify-center  flex  h-screen w-full items-center p-4">
                <div class="w-max rounded-[10px]  bg-white gap-6 shadow-lg shadow-black/60 flex flex-col items-center px-6 py-12 ">
                    <div class="relative flex justify-center items-center">
                        <div class="absolute animate-spin rounded-full h-20 w-20 border-t-4 border-b-4 border-secondary"></div>
                        <img src="https://www.svgrepo.com/show/509001/avatar-thinking-9.svg"  class="rounded-full h-16 w-16">
                    </div>
                    <div class="w-full mt-4 flex justify-center flex items-center flex-col">
                    
                    <span class="font-medium text-md text-secondary">Please wait. We are fetching data</span>
                    <div class="flex">
                    <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
                        <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
                        <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
                        <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
                    </div>
                    </div>
                    
                </div>
            </div>
    </div>

    <!-- end of the loader part  -->

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
                    <button class="mr-4 lg:hidden text-lg">+</button>
                </div>
               
                <div  class="border-[1px] border-primaryColor/30 border-t-[0px]">
                        <form  class=" w-full h-max px-2 pt-2">
                                <div class="">
                                <div class="flex justify-between items-center text-sm bg-primaryColor/20 px-2 py-0.5 text-blackColor font-semibold">
                                    <h3 class=" ">Property Name</h3>
                                    <button  onclick="toggleDiv(event)" data-target="propertysearchDiv" class="text-xl">+</button>
                                </div>
                                <div id="propertysearchDiv" class="py-2 border-b-[1px] border-b-primaryColor/30 relative hidden" >
                                    <input type="text" name="property_name" id="property_name" placeholder="Search Hotels"
                                    class="w-full p-2.5 font-medium text-primaryDarkColor text-sm rounded-t-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"
                                   />

                                

                                        <div  id="hotelSuggestions" class="flex flex-col justify-between items-center bg-primaryDarkColor propertydata text-white px-2 py-0.5">
                                        
                                    
                                         
                                        </div>
                                       
                                 </div>
                               </div>
                       </form>

                       <form  class=" w-full px-2 ">
                            <div class="distance-filter mt-2">
                                <div  class="flex justify-between items-center text-sm bg-primaryColor/20 px-2 py-0.5 text-blackColor font-semibold">
                                    <h3 class=" ">Locations</h3>
                                    <button  onclick="toggleDiv(event)" data-target="locationDiv" class="text-xl">+</button>
                                </div>

                                <div   id="locationDiv" class="filter-view p-2 border-b-[1px] border-b-primaryColor/30 hidden">
                                    <div  class="locations-list mt-2 h-64 overflow-y-scroll">
                                        <div class="border-b-[1px] border-b-primaryColor/30 mb-2">
                                            <h1 class="text-md font-bold text-black">Airports</h1>
                                        </div>
                                        <div class="text-sm mb-1.5" >
                                            <input class="rounded-sm border-primaryDarkColor text-primaryDarkColor shadow-sm focus:border-primaryDarkColor focus:ring-0 focus:outline-none disabled:opacity-50" type="checkbox" />
                                            <label  class="ml-2 text-sm font-semibold text-black/70">Airport Name</label>
                                        </div>

                                        <div class="border-b-[1px] border-b-primaryColor/30 mb-2">
                                            <h1 class="text-md font-bold text-black">Areas</h1>
                                        </div>
                                        <div  class="text-sm mb-1.5">
                                            <input class="rounded-sm border-primaryDarkColor text-primaryDarkColor shadow-sm focus:border-primaryDarkColor focus:ring-0 focus:outline-none disabled:opacity-50" type="checkbox"/>
                                            <label  class="ml-2 text-sm font-semibold text-black/70">Location name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--        ratingfilter-->
                            <div class="rating-filter mt-2">
                                <div class="flex justify-between items-center text-sm bg-primaryColor/20 px-2 py-0.5 text-blackColor font-semibold">
                                    <h3 class=" ">Star Ratings</h3>
                                    <button  onclick="toggleDiv(event)" data-target="ratingDiv" class="text-xl">+</button>
                                </div>
                                <hr>
                                <div id="ratingDiv" class="filter-view p-2 border-b-[1px] border-b-primaryColor/30 hidden">
                                    <div class="mt-1">
                                        <input name="rating" value="1" class="rounded-sm border-primaryDarkColor text-primaryDarkColor shadow-sm focus:border-primaryDarkColor focus:ring-0 focus:outline-none disabled:opacity-50" type="checkbox" >
                                        <label for="rating_3" class="ml-2 text-sm font-semibold text-black/70">1 star</label>
                                    </div>
                                    <div class="mt-1">
                                        <input name="rating" value="2" class="rounded-sm border-primaryDarkColor text-primaryDarkColor shadow-sm focus:border-primaryDarkColor focus:ring-0 focus:outline-none disabled:opacity-50" type="checkbox" >
                                        <label for="rating_3" class="ml-2 text-sm font-semibold text-black/70">2 star</label>
                                    </div>
                                    <div class="mt-1">
                                        <input name="rating" value="3" class="rounded-sm border-primaryDarkColor text-primaryDarkColor shadow-sm focus:border-primaryDarkColor focus:ring-0 focus:outline-none disabled:opacity-50" type="checkbox">
                                        <label for="rating_3" class="ml-2 text-sm font-semibold text-black/70">3 star</label>
                                    </div>

                                    <div class="mt-1">
                                        <input name="rating" value="4" class="rounded-sm border-primaryDarkColor text-primaryDarkColor shadow-sm focus:border-primaryDarkColor focus:ring-0 focus:outline-none disabled:opacity-50" type="checkbox">
                                        <label for="rating_4" class="ml-2 text-sm font-semibold text-black/70">4 star</label>
                                    </div>

                                    <div class="mt-1">
                                        <input name="rating" value="5" class="rounded-sm border-primaryDarkColor text-primaryDarkColor shadow-sm focus:border-primaryDarkColor focus:ring-0 focus:outline-none disabled:opacity-50" type="checkbox">
                                        <label for="rating_5" class="ml-2 text-sm font-semibold text-black/70">5 star</label>
                                    </div>
                                </div>
                            </div>
                            <!--        boardtype fitler-->
                            <div class="board-type-filter mt-2">
                                <div class="flex justify-between items-center text-sm bg-primaryColor/20 px-2 py-0.5 text-blackColor font-semibold">
                                    <h3 class=" ">Board Types</h3>
                                    <button onclick="toggleDiv(event)" data-target="showBoardTypes"  class="text-xl">+</button>
                                </div>
                                <hr>
                                <div id="showBoardTypes" class="filter-view p-2 border-b-[1px] border-b-primaryColor/30 hidden">
                                    <div class="mb-2">
                                        <input class="rounded-sm border-primaryDarkColor text-primaryDarkColor shadow-sm focus:border-primaryDarkColor focus:ring-0 focus:outline-none disabled:opacity-50" type="checkbox" />
                                        <label  class="ml-2 text-sm font-semibold text-black/70"></label>
                                    </div>
                                </div>
                            </div>
                            <!--        range filter-->
                            <!-- <div class="range-filter mt-2">
                                <div class="flex justify-between items-center text-sm bg-primaryColor/20 px-2 py-0.5 text-blackColor font-semibold">
                                    <h3 class=" ">Price Range :</h3>
                                    <span class="mr-[2.8rem]"></span>
                                    <button  onclick="toggleDiv(event)" data-target="showPriceRange" class="text-xl">+</button>
                                </div>
                                <hr>
                                <div id="showPriceRange" class="filter-view p-2 border-b-[1px] border-b-primaryColor/3 hidden">
                                    <div class="flex justify-between gap-4">
                                        <div class="flex items-center">
                                            <span class="text-black text-sm font-semibold">£</span>
                                            <span class="text-black text-sm font-semibold ml-1">1000</span>
                                        </div>
                                        <input type="range" id="priceRange" class="range range-xs [--range-shdw:yellow] mt-2"  step="10" />

                                        {{-- <span class="text-black text-sm font-semibold"> £ {{ maxPrice }}</span> --}}
                                        <div class="flex items-center">
                                            <span class="text-black text-sm font-semibold">£</span>
                                            <span class="text-black text-sm font-semibold ml-1">10</span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="range-filter mt-2">
                                <div class="flex justify-between items-center text-sm bg-primaryColor/20 px-2 py-0.5 text-blackColor font-semibold">
                                    <h3 class="">Price Range :</h3>
                                    <span class="mr-[2.8rem]"></span>
                                    <button onclick="toggleDiv(event)" data-target="showPriceRange" class="text-xl">+</button>
                                </div>
                                <hr>
                                <div id="showPriceRange" class="filter-view p-2 border-b-[1px] border-b-primaryColor/3 hidden">
                                    <div class="flex justify-between gap-4 items-center">
                                        <div class="flex items-center">
                                            <span class="text-black text-sm font-semibold">£</span>
                                            <span id="minPrice" class="text-black text-sm font-semibold ml-1">10</span> <!-- Static Min -->
                                        </div>

                                        <input 
                                            type="range" 
                                            id="priceRange" 
                                            class="range range-xs [--range-shdw:yellow] mt-2"  
                                            min="10" 
                                            max="1300" 
                                            step="10" 
                                            value="10"
                                            oninput="updatePriceValue(this.value)"
                                        />

                                        <div class="flex items-center">
                                            <span class="text-black text-sm font-semibold">£</span>
                                            <span id="currentPrice" class="text-black text-sm font-semibold ml-1">1300</span> <!-- Dynamic Price -->
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="py-2 flex justify-between">
                                    <button type="submit" class="w-max h-max text-center font-semibold text-sm bg-primaryDarkColor/80 text-white/90 px-2 py-1 rounded-[3px] border-[1px] border-primaryDarkColor hover:bg-primaryDarkColor hover:text-white transition ease-in duration-2000" @click="applyFilter">Apply Filters
                                    </button>

                                    <button type="button" id="resetFilters" class="w-max h-max text-center font-semibold text-sm bg-redColor/80 text-white/90 px-2 py-1 rounded-[3px] border-[1px] border-redColor hover:bg-redColor hover:text-white transition ease-in duration-2000" >Reset Filters
                                    </button>
                            </div>


                       </form>
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
                                      <a href="{{ route('hotel.details', ['hotelIdd' => $hotel['HotelId']]) }}" class="showloader w-full">
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
                            <!-- <div class="mt-12 w-full flex justify-center">
                                <button class="w-max text-center showLoader font-semibold text-md bg-primaryDarkColor/80 text-white/90 px-6 py-2 rounded-[3px] border-[1px] border-primaryDarkColor hover:bg-primaryDarkColor hover:text-white transition ease-in duration-2000" v-if="hasMoreData" @click="loadMore">Load More <i class="fa fa-download ml-2"></i> </button>
                            </div>
                    -->
                    
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

 

<script>
    // Toggle visibility of a target div
    function toggleDiv(e) {
        e.preventDefault();
        const targetId = e.currentTarget.getAttribute('data-target');
        const targetDiv = document.getElementById(targetId);
        if (targetDiv) {
            targetDiv.classList.toggle('hidden');
        }
    }

    // Function to construct hotel details HTML
    function generateHotelDetails(hotel) {
        return `
            <div class="w-full bg-white shadow-primaryDarkColor/30 shadow-lg mt-4 rounded-[3px] border-[1px] border-primaryColor/50">
                <a href="/agencies/hotel/hotel-details?hotelIdd=${hotel.HotelId}" class="showloader w-full">
                    <div class="w-full h-auto rounded-[3px]">
                        <div class="h-[200px] relative overflow-hidden rounded-t-[3px]">
                            <div class="absolute -right-8 top-0 h-16 w-32 rotate-45 z-50">
                                <div class="bg-redColor text-xs text-center font-semibold text-white z-50">
                                    ${hotel.Vendor === 'Stuba' ? 'ST' : hotel.Vendor === 'RateHawk' ? 'RH' : 'TR'}
                                </div>
                            </div>

                            <div class="swiffy-slider slider-item-ratio slider-item-ratio-16x9 slider-nav-animation slider-nav-animation-fadein">
                                <ul class="slider-container">
                                    ${hotel.HotelImage.slice(0, 5).map(image => `
                                        <li>
                                            <img src="${image}" alt="Hotel Image" loading="lazy" class="object-cover w-full h-40 rounded-md">
                                        </li>
                                    `).join('')}
                                </ul>

                                <button type="button" class="slider-nav" aria-label="Go to previous"></button>
                                <button type="button" class="slider-nav slider-nav-next" aria-label="Go to next"></button>
                            </div>
                        </div>

                        <div class="flex justify-between bg-white p-2">
                            <div class="flex flex-col w-full">
                                <div class="flex justify-between w-full">
                                    <div class="w-max">
                                        <span class="text-xs">
                                            ${Array.from({ length: 5 }).map((_, i) => `
                                                <i class="fa-solid fa-star" style="color: ${i < hotel.StarRating ? '#16a34a' : 'gray'}; margin-right: 2px;"></i>
                                            `).join('')}
                                        </span>
                                    </div>
                                    <div class="w-max px-2">
                                        <span class="text-green-600 font-semibold text-sm">
                                            ${hotel.StarRating >= 4.5 ? 'Excellent' : 'Good'}
                                        </span>
                                    </div>
                                </div>

                                <span class="text-primaryDarkColor font-bold text-md mt-2 w-42">
                                    <i class="fa fa-hotel mr-1"></i> ${hotel.HotelName}
                                </span>
                                <span class="text-redColor font-semibold text-sm mt-1">
                                    <i class="fa fa-location-dot mr-1"></i> ${hotel.City}, ${hotel.Country}
                                </span>

                                <span class="mt-2 text-gray-600 font-medium text-sm">
                                    from <span class="font-bold text-xl text-primaryDarkColor">£ ${hotel.TotalPrice ?? 'N/A'}</span>
                                </span>
                                <span class="font-semibold text-[#16a34a] text-xs text-redColor">
                                    (Total for ${hotel.TotalNights} ${hotel.TotalNights > 1 ? 'Nights' : 'Night'} & ${hotel.TotalNights + 1} Days)
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        `;
    }

    // Function to handle hotel details fetching and displaying
    function getHotelDetails(hotelId) {
        const container = $('#divContainingHotels');
        container.html('<p>Loading hotel details...</p>'); // Show loading indicator

        $.ajax({
            url: '{{ route('hotel.getDetails') }}',
            type: 'GET',
            data: { hotel_id: hotelId },
            success: function(response) {
                if (response.status === 'success') {
                    const hotel = response.hotel;
                    container.html(generateHotelDetails(hotel)); // Populate hotel details
                } else {
                    container.html('<p>Error fetching hotel details.</p>');
                }
            },
            error: function() {
                container.html('<p>Error fetching hotel details.</p>');
            }
        });
    }

    $(document).ready(function () {
        // Show loader on button click
        $(document).on('click', '.showloader', function () {
            $('#loading_overlay1').removeClass('hidden');
        });

        // Handle property name search and fetch hotel suggestions
        $('#property_name').on('keyup', function () {
            const propertyName = $(this).val();
            if (propertyName.length > 0) {
                $.ajax({
                    url: '{{ route('hotel.suggestions') }}',
                    type: 'GET',
                    data: { property_name: propertyName },
                    success: function (response) {
                        $('#hotelSuggestions').empty();
                        if (response.length > 0) {
                            response.forEach(function (hotel) {
                                $('#hotelSuggestions').append(`
                                    <div class="flex  justify-between items-center bg-primaryDarkColor propertydata text-white px-2 py-0.5 hotel-item"
                                        data-hotel-id="${hotel.HotelId}" data-hotel-name="${hotel.HotelName}">
                                        <span class="text-base ml-1 flex-grow">${hotel.HotelName}</span>
                                        <span><button class="text-redColor font-bold"><i class="fa fa-xmark"></i></button></span>
                                    </div>
                                `);
                            });
                        } else {
                            $('#hotelSuggestions').append(`
                                <div class="flex justify-between items-center bg-primaryDarkColor propertydata text-white px-2 py-0.5">
                                    <span class="text-base ml-1 flex-grow">No hotels found</span>
                                </div>
                            `);
                        }
                    },
                    error: function () {
                        $('#propertyNameSpan').text('Error fetching name');
                    }
                });
            } else {
                $('#propertyNameSpan').text('');
                $('#hotelSuggestions').empty();
            }
        });

        // Remove hotel suggestion when 'X' button is clicked
        $(document).on('click', '.propertydata button', function (e) {
            e.stopPropagation();
            $(this).closest('.propertydata').remove();
        });

        // Handle hotel item click to fetch details
        $(document).on('click', '.hotel-item', function() {
            const hotelId = $(this).data('hotel-id');
            getHotelDetails(hotelId);
        });

        // Handle apply filter and AJAX call for filters
        $('button[type="submit"]').on('click', function (e) {
            e.preventDefault();

            const filters = {
                airports: [],
                areas: [],
                ratings: [],
                priceRange: $('#priceRange').val(),
            };

            // Collect selected airports, areas, and ratings
            $('input[type="checkbox"][name="airport"]:checked').each(function () {
                filters.airports.push($(this).val());
            });
            $('input[type="checkbox"][name="area"]:checked').each(function () {
                filters.areas.push($(this).val());
            });
            $('input[type="checkbox"][name="rating"]:checked').each(function () {
                filters.ratings.push($(this).val());
            });

            // Make AJAX request to apply filters
            $.ajax({
                url: '{{ route('applyFilters') }}',
                method: 'GET',
                data: filters,
                success: function (response) {
                    if (response.status === 'success') {
                        const hotels = response.hotels;
                        const hotelDetailsHtml = hotels.map(generateHotelDetails).join('');
                        $('#divContainingHotels').html(hotelDetailsHtml);
                    } else {
                        $('#divContainingHotels').html('<p>No hotels found for the applied filters.</p>');
                    }
                },
                error: function (error) {
                    console.error('Error applying filters:', error);
                }
            });
        });
    });


    /****Reset form *** */
    $(document).ready(function() {
        $('#resetFilters').click(function() {
            $.ajax({
                url: '{{ route('resetFilters') }}',
                method: "GET",
                success: function(response) {
                    if (response.status === 'success') {
                        const hotels = response.hotels;
                        const hotelDetailsHtml = hotels.map(generateHotelDetails).join('');
                        $('#divContainingHotels').html(hotelDetailsHtml);
                    } else {
                        $('#divContainingHotels').html('<p>No hotels found for the applied filters.</p>');
                    }
                },
                error: function(xhr) {
                    console.log('Error while resetting filters', xhr);
                }
            });
        });
    });
</script>


</x-agency.layout>