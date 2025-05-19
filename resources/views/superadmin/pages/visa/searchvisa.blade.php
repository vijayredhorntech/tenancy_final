<x-agency.layout>
<style>
    .select2-container
    {
        padding: 4px 22px !important;
        border: 1px solid #ff4216 !important;
        width: 100% !important;
        border-radius: 4px!important;
        

    }
    .select2-container--default .select2-selection--single
    {
        border:0px !important;
        border-radius: 0px!important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
   
    display: none !important;
    }
</style>


    @section('title') Visa View @endsection
    <!-- In your Blade template head section -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Before closing body tag -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


        <div class=" w-full ">
            <div class="w-full lg:h-[400px] md:h-[400px] sm:h-[300px] h-[200px] bg-black rounded-md bg-center bg-cover bg-no-repeat relative z-20" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://www.goodwind.in/static/images/world-bg.jpg');">
                <div class="absolute flex justify-center  w-full h-max bottom-0 lg:translate-y-[50%] md:translate-y-[50%] sm:translate-y-[70%] translate-y-[100%] left-0 z-10">
                    <div class="lg:w-[70%] bg-white shadow-lg shadow-black/10 rounded-xs">
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
{{--                                    <div class=" grid grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 p-4">--}}
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
{{--                                            <div class="w-full lg:col-span-2 md:col-span-2 sm:col-span-2 col-span-1 flex justify-end ">--}}
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
                </div>
            </div>
        </div>

        <div class="w-full relative">
            <img class="w-full absolute left-0 top-0 lg:translate-y-[-70%] md:translate-y-[-20%]  object-cover opacity-20" src="{{asset('assets/images/bgImage.png')}}" alt="">
                   <div class="p-4 lg:pt-[200px] md:pt-[200px] sm:pt-[350px] pt-[700px]">
                       <div class="w-full flex justify-center pt-16">
                           <span class=" text-primary font-semibold lg:text-3xl md:text-2xl sm:text-xl text-lg">Top 5 Most Requested Visas</span>
                       </div>

                       <div class="w-full grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-4 mt-8">
                            <div class="w-full bg-white shadow-lg shadow-black/20">
                                <img class="w-full h-48 object-cover" src="{{asset('assets/images/turkey-visa-requirements.jpg')}}" alt="">
                                <div class="p-4 flex flex-col ">
                                    <a href="javascript:void(0)" class="text-lg font-semibold text-secondary">Turkish Visa</a>
                                    <span class="text-black font-normal text-sm">From: <span class="text-primary font-bold text-lg">£66</span></span>
                                </div>
                                <div class="border-b-[2px] border-b-secondary/20"></div>
                                <div class="w-full p-4">
                                      <span class="text-normal text-sm"><i class="fa-regular fa-clock text-secondary mr-2 text-md"></i>2-3 business days </span>
                                </div>
                            </div>
                            <div class="w-full bg-white shadow-lg shadow-black/20">
                                <img class="w-full h-48 object-cover" src="{{asset('assets/images/nigeria-visa-requirements.jpg')}}" alt="">
                                <div class="p-4 flex flex-col ">
                                    <a href="javascript:void(0)" class="text-lg font-semibold text-secondary">Nigerian Visa</a>
                                    <span class="text-black font-normal text-sm">From: <span class="text-primary font-bold text-lg">£297</span></span>
                                </div>
                                <div class="border-b-[2px] border-b-secondary/20"></div>
                                <div class="w-full p-4">
                                      <span class="text-normal text-sm"><i class="fa-regular fa-clock text-secondary mr-2 text-md"></i>3-5 business days </span>
                                </div>
                            </div>
                            <div class="w-full bg-white shadow-lg shadow-black/20">
                                <img class="w-full h-48 object-cover" src="{{asset('assets/images/united-arab-emirates-visa-requirements.jpg')}}" alt="">
                                <div class="p-4 flex flex-col ">
                                    <a href="javascript:void(0)" class="text-lg font-semibold text-secondary">United Arab Emirates Visa</a>
                                    <span class="text-black font-normal text-sm">From: <span class="text-primary font-bold text-lg">£167</span></span>
                                </div>
                                <div class="border-b-[2px] border-b-secondary/20"></div>
                                <div class="w-full p-4">
                                      <span class="text-normal text-sm"><i class="fa-regular fa-clock text-secondary mr-2 text-md"></i>3-5 business days </span>
                                </div>
                            </div>
                            <div class="w-full bg-white shadow-lg shadow-black/20">
                                <img class="w-full h-48 object-cover" src="{{asset('assets/images/tanzania-visa-requirements.jpg')}}" alt="">
                                <div class="p-4 flex flex-col ">
                                    <a href="javascript:void(0)" class="text-lg font-semibold text-secondary">Tanzania Visa</a>
                                    <span class="text-black font-normal text-sm">From: <span class="text-primary font-bold text-lg">£110</span></span>
                                </div>
                                <div class="border-b-[2px] border-b-secondary/20"></div>
                                <div class="w-full p-4">
                                      <span class="text-normal text-sm"><i class="fa-regular fa-clock text-secondary mr-2 text-md"></i>10 business days </span>
                                </div>
                            </div>
                            <div class="w-full bg-white shadow-lg shadow-black/20">
                                <img class="w-full h-48 object-cover" src="{{asset('assets/images/australia-visa-requirements.jpg')}}" alt="">
                                <div class="p-4 flex flex-col ">
                                    <a href="javascript:void(0)" class="text-lg font-semibold text-secondary">Australian Visa</a>
                                    <span class="text-black font-normal text-sm">From: <span class="text-primary font-bold text-lg">£51.30</span></span>
                                </div>
                                <div class="border-b-[2px] border-b-secondary/20"></div>
                                <div class="w-full p-4">
                                      <span class="text-normal text-sm"><i class="fa-regular fa-clock text-secondary mr-2 text-md"></i>2-3 business days </span>
                                </div>
                            </div>
                       </div>
                   </div>
        </div>

        <script>
    $(document).ready(function() {
        $('#origincountry').select2({
            placeholder: "---Select Country---",
            allowClear: true,
            containerCssClass: 'visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60'
        });
    });
    $(document).ready(function() {
        $('#destinationcountry').select2({
            placeholder: "---Select Country---",
            allowClear: true,
            containerCssClass: 'visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60'
        });
    });
</script>

</x-agency.layout>
