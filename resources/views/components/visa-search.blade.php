
                                <div class="w-full  p-4 flex flex-col gap-2 mx-auto">
                                    <span class=" text-secondary font-semibold lg:text-2xl md:text-2xl sm:text-xl text-lg">Travel Visa Requirements</span>
                                    <p class="lg:text-sm">Sometimes a journey of a thousand miles begins with a visa. Check your destination and apply online for any visa in the world.</p>
                                </div>
                                <div class="w-full border-b-[1px] border-b-secondary"></div>
                                    <form action="{{ route('searchvisa') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                {{--add this div if there are 4 inputs--}}
                                                <div class=" grid grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 p-4">

                                                {{--add this div if there are 2 inputs--}}
                                                {{-- <div class=" grid grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 p-4">--}}
                                                <div class="w-full flex flex-col gap-1">
                                                    <label for="leavingFrom" class="text-ternary font-bold text-sm">Visa From</label>
                                                    <div class="w-full relative">
                                                    <select name="origincountry" id="origincountry" class="visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                                            <option value="">---Select Country---</option>
                                                            @forelse($countries as $country)
                                                                <option value="{{ $country->id }}">{{ $country->countryName }}</option>
                                                            @empty
                                                                <option value="">No record found</option>
                                                            @endforelse
                                                        </select>
                                                        <!-- <select name="origincountry" id="origincountry" class="visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                                            <option value="">---Select Country---</option>
                                                            @forelse($countries as $country)
                                                                <option value="{{$country->id}}">{{$country->countryName}}</option>
                                                            @empty
                                                                <option value="">No record found</option>
                                                            @endforelse
                                                        </select> -->
                                                        <i class="fa fa-location-dot text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                                        <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                                    </div>
                                                </div>

                                                    <div class="w-full flex flex-col gap-1">
                                                        <label for="arriveTo" class="text-ternary font-bold text-sm">Visa To</label>
                                                        <div class="w-full relative">
                                                            <!-- <select name="destinationcountry" id="destinationcountry" class="visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                                                <option value="">---Select Country---</option>
                                                                @forelse($countries as $country)
                                                                    <option value="{{$country->id}}">{{$country->countryName}}</option>
                                                                @empty
                                                                    <option value="">No record found</option>
                                                                @endforelse
                                                            </select> -->
                                                            <select name="destinationcountry" id="destinationcountry" class="visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                                            <option value="">---Select Country---</option>
                                                            @forelse($countries as $country)
                                                                <option value="{{ $country->id }}">{{ $country->countryName }}</option>
                                                            @empty
                                                                <option value="">No record found</option>
                                                            @endforelse
                                                        </select>
                                                    

                                                            <i class="fa fa-location-dot text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                                            <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="w-full flex flex-col gap-1">
                                                        <label for="arriveTo" class="text-ternary font-bold text-sm">Your Citizenship</label>
                                                        <div class="w-full relative">
                                                            <select name="" id="destinationcountry" class="visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                                                <option value="">---Select Country---</option>
                                                                @forelse($countries as $country)
                                                                    <option value="{{$country->id}}">{{$country->countryName}}</option>
                                                                @empty
                                                                    <option value="">No record found</option>
                                                                @endforelse
                                                            </select>

                                                            <i class="fa fa-location-dot text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                                            <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                                        </div>
                                                    </div>
                                                    <div class="w-full flex flex-col gap-1">
                                                        <label for="arriveTo" class="text-ternary font-bold text-sm">Living In</label>
                                                        <div class="w-full relative">
                                                            <select name="" id="destinationcountry" class="visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                                                <option value="">---Select Country---</option>
                                                                @forelse($countries as $country)
                                                                    <option value="{{$country->id}}">{{$country->countryName}}</option>
                                                                @empty
                                                                    <option value="">No record found</option>
                                                                @endforelse
                                                            </select>

                                                            <i class="fa fa-location-dot text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                                            <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                                        </div>
                                                    </div>
                                                    {{--add this div if there are 4 inputs--}} -->
                                                    <div class="w-full lg:col-span-4 md:col-span-4 sm:col-span-2 col-span-1 flex justify-end ">
                                                        {{--add this div if there are 2 inputs--}}
                                                    {{--  <div class="w-full lg:col-span-2 md:col-span-2 sm:col-span-2 col-span-1 flex justify-end ">--}}
                                                        <input type="submit" id="searchFlightButton" value="Check Requirements" class="cursor-pointer mt-2 w-max showLoader font-bold text-lg bg-secondary text-white px-6 py-2 rounded-[3px]  hover:bg-secondary hover:text-white transition ease-in duration-2000">
                                                    </div>
                                                </div>

                                    </form>
                                   <div class="w-full border-b-[2px] border-b-secondary/10"></div>
                                <div class="w-full flex lg:gap-8 md:gap-8 sm:gap-6 gap-4 justify-center items-center flex-wrap py-4">
                                        <div class="flex gap-1 items-center group cursor-pointer">
                                            <i class="fa fa-comment text-secondary text-lg group-hover:scale-105 transition ease-in duration-2000"></i><span class="font-semibold ">Live Chat</span>
                                        </div>
                                        <div class="flex gap-1 items-center group cursor-pointer">
                                            <i class="fa-brands fa-square-whatsapp text-secondary text-lg group-hover:scale-105 transition ease-in duration-2000"></i><span class="font-semibold ">Whatsapp</span>
                                        </div>
                                        <div class="flex gap-1 items-center group cursor-pointer">
                                            <i class="fa fa-phone text-secondary text-lg group-hover:scale-105 transition ease-in duration-2000"></i><span class="font-semibold ">Call +440000000000</span>
                                        </div>
                                </div>
                            </div>
              