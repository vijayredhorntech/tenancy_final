<x-agency.layout>
    @section('title') Visa View @endsection

        <div class="p-4 w-full ">
            <div class="w-full">
                <div class="w-full bg-white p-4 flex flex-col gap-2 rounded-t-md mx-auto">

                    <span class="font-semibold lg:text-3xl md:text-2xl sm:text-xl text-lg">Assign Country</span>
                    <p>Travel Visa Requirements Sometimes a journey of a thousand miles begins with a visa. Check your destination and apply online for any visa in the world.
                    </p>
                    <div class="flex gap-2 py-2 w-full border-b-[1px] border-b-ternary/20">


                    </div>
                </div>
                <div class="w-full mx-auto bg-white rounded-b-md shadow-lg shadow-ternary/30">
                    <div class="w-full m-auto h-auto flex flex-col justify-center  bg-white px-4 pb-6  rounded-b-md">
                        <form action="{{ route('searchvisa') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                            <div class="mt-8 grid lg:grid-cols-6 md:grid-cols-4 grid-cols-2 gap-x-2 gap-y-4">
                                <div class="lg:col-span-2 col-span-1 w-full relative flex flex-col" style="height: max-content;">
                                    <label for="leavingFrom" class="text-ternary font-bold text-sm">Visa From</label>
                                    <div class="w-full relative">
                                        <select name="origincountry" id="origincountry" class="visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                            <option value="">---Select Country---</option>
                                            @forelse($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @empty
                                                <option value="">No record found</option>
                                            @endforelse
                                        </select>
                                        <i class="fa fa-location-dot text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                        <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                    </div>
                                </div>
                                <div class="lg:col-span-2 col-span-1 w-full relative flex flex-col">
                                    <label for="arriveTo" class="text-ternary font-bold text-sm">Visa To</label>
                                    <div class="w-full relative">
                                        <select name="destinationcountry" id="destinationcountry" class="visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                            <option value="">---Select Country---</option>
                                            @forelse($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @empty
                                                <option value="">No record found</option>
                                            @endforelse
                                        </select>

                                        <i class="fa fa-location-dot text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                        <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                    </div>


                                </div>
                                <div class="w-full flex flex-col">
                                    <label for="arriveTo" class="text-ternary font-bold text-sm">&nbsp</label>

                                    <input type="submit" id="searchFlightButton" value="Check Requirements" class="mt-2 showLoader font-bold text-lg bg-secondary text-white px-6 py-2 rounded-[3px]  hover:bg-secondary hover:text-white transition ease-in duration-2000">
                                    <!-- Search Flight <i class="fa fa-arrow-right ml-2"></i>
                            </button> -->
                                </div>



                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
</x-agency.layout>
