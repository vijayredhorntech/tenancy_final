@stack('customStyle')
@php
    if (session()->get('allFilters')) {
        $sessionget = session()->get('allFilters');
    } else {
        $sessionget = [];
    }
@endphp
<x-layout>
    @php
        session(['filterRatings' => [], 'moreFilter' => []]);
        $cityName = App\Models\City::where('cityID', '=', $searchParams['city'])->first();
        $countryName = $cityName->country->countryName;

        $cityName = $cityName['CityName'];
        // dd($countryName,$cityName);
        // dd("city iss", $cityName)
    @endphp
    <div class="holidaylist">
        <div class="w-full h-max ">
            <div
                class="w-full h-96 bg-no-repeat bg-center bg-cover bg-[url('https://plus.unsplash.com/premium_photo-1682145930966-712ce7177919?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')]">

            </div>
        </div>
    </div>

    <div class="lg:w-3/4 md:w-3/4 sm:w-full w-full h-max m-auto  py-4 bg-white ">
        <div class="container mx-auto bg-sky-400 border-2 border-sky-400 p-2 rounded-lg m-3">
            <Search :cityName="$cityName" :CountryName="{{ json_encode($countryName) }}"
                :searchParams="{{ json_encode($searchParams) }}" />

            {{--
            <Timer :initial='true' /> --}}
            <Timer />
        </div>
    </div>


    {{-- <div class="container holidayvue">
        <HolidayList :hotelLists="{{ json_encode($hotels) }}" :searchParams="{{ json_encode($searchParams) }}"
            :countryName="{{ json_encode($countryName) }}" :cityName="{{ json_encode($cityName) }}" />
    </div> --}}


    <x-splade-lazy>
        <x-slot:placeholder>

            {{-- <h1 class="text-2xl font-bold text-center">Please Wait Hotels Are Loading......</h1> --}}
            <div class="container mx-auto grid grid-cols-5 mx-auto rounded-lg ">

                <div class="filterbar grid col-span-1 rounded-lg">

                    <div>
                        <!-- Rating Filter Skeleton Loader -->
                        <div
                            class="skeleton-loader border-b-2 border-b-gray-200 w-full h-max p-3 space-y-6 animate-pulse">
                            <!-- Rating Filter -->
                            <div class="rating-filter border-2 border-gray-200 rounded-lg p-2">
                                <div class="mt-2 bg-gray-300 h-4 w-16"></div>
                                <div class="mt-2 bg-gray-300 h-4 w-16"></div>
                                <div class="mt-2 bg-gray-300 h-4 w-16"></div>
                            </div>

                            <!-- Board Type Filter Skeleton Loader -->
                            <div class="board-type-filter border-2 border-gray-200 rounded-lg p-2">
                                <div v-for="(_, index) in 3" :key="index" class="mt-2 bg-gray-300 h-4 w-24">
                                </div>
                            </div>

                            <!-- Range Filter Skeleton Loader -->
                            <div class="range-filter border-2 border-gray-200 rounded-lg p-2 flex flex-col space-y-4">
                                <div class="mt-2 bg-gray-300 h-4 w-24"></div>
                                <div class="mt-2 bg-gray-300 h-4 w-24"></div>
                            </div>

                            <!-- Distance Filter Skeleton Loader -->
                            <div
                                class="distance-filter border-2 border-gray-200 rounded-lg p-2 flex flex-col space-y-4">
                                <div class="mt-2 bg-gray-300 h-4 w-24"></div>
                                <div class="mt-2 bg-gray-300 h-4 w-24"></div>
                                <div class="mt-2 bg-gray-300 h-4 w-24"></div>
                            </div>

                            <!-- Apply Button Skeleton Loader -->
                            <div class="mt-4 flex justify-end">
                                <div
                                    class="bg-sky-500 rounded-lg text-white py-2 px-12 font-semibold text-lg h-12 w-32">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="hotellist grid col-span-4">
                    <div class="container">
                        <div class=" grid grid-cols-4 gap-4 my-6 ">
                            <div v-for="index in 4" :key="index">
                                <a class=" ">
                                    <div class="h-[340px] w-full animate-pulse  overflow-hidden">
                                        <div class="h-[200px] w-full rounded-lg bg-gray-200"></div>
                                        <div class="mt-[12px] flex h-[250px] justify-between bg-white p-2">
                                            <div class="mt-2 flex justify-between bg-white pl-2">
                                                <div class="flex flex-col">
                                                    <span class="text-md"> </span>
                                                    <span
                                                        class="text-md mt-2 w-24 rounded-lg border-4 border-gray-200 font-semibold text-black"></span>
                                                    <span
                                                        class="text-md mt-8 w-24 rounded-lg border-4 border-gray-200 font-semibold text-black"></span>
                                                    <span
                                                        class="mt-2 w-24 rounded-lg border-4 border-gray-200 text-sm font-normal text-gray-600"></span>
                                                    <span
                                                        class="text-md w-16 rounded-lg border-4 border-gray-200 font-semibold text-gray-400"></span>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="text-md w-1 rounded-lg border-4 border-gray-200 font-semibold text-black"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </x-slot:placeholder>

        @php

            if ($hotels['Response']['Body']['HotelsReturned'] > 0) {
                $hotelData = $hotels['Response']['Body']['Hotels']['Hotel'];
                if (count($hotelData) > 0) {
                    session()->put('availableHotels', $hotels);
                }
            } else {
                $hotelData = [];
            }

        @endphp
        {{-- @dd($hotelData); --}}
        <div class="container w-full holidayvue mx-auto">
            <HolidayList :hotelLists="{{ json_encode($hotelData) }}" :searchParams="{{ json_encode($searchParams) }}"
                :countryName="{{ json_encode($countryName) }}" :cityName="{{ json_encode($cityName) }}" />
        </div>

    </x-splade-lazy>
    <div id="loading_overlay1" class="hidden">
        <div
            class="fixed inset-0  justify-center container flex  h-screen w-full items-center border border-2 z-30 bg-white opacity-70">

        </div>
        <div class="z-40 fixed inset-0  justify-center container flex  h-screen w-full items-center">
            <div class="loader4 "></div>
            <div class="loader3 "></div>
        </div>
    </div>


</x-layout>
{{-- <script>
    import HotelList from "../../js/Components/HotelList.vue";
    import FilterBar from "../../js/Components/FilterBar.vue";
    export default {
        components: {FilterBar, HotelList}
    }
</script> --}}
