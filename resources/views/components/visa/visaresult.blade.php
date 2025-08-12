
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
    
    .select2-container--default .select2-selection--single:focus
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

@php
    // Collect all non-null title images into an array
    $titleImages = collect();

    foreach($visas as $visa) {
        if (!empty($visa->title_image)) {
            $titleImages->push($visa->title_image);
        }
    }

    // Pick one random image or fallback to default image
    $randomImage = $titleImages->isNotEmpty()
        ? asset('images/visa/titleimages/' . $titleImages->random())
        : asset('assets/images/india-visa-application-requirements.jpg');
@endphp

        <div class=" w-full ">
            <!-- <div class="w-full lg:h-[400px] md:h-[400px] sm:h-[300px] h-[200px] bg-black rounded-md bg-center bg-cover bg-no-repeat relative z-20" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url({{asset('assets/images/india-visa-application-requirements.jpg')}});"> -->
            <div class="w-full lg:h-[400px] md:h-[400px] sm:h-[300px] h-[200px] bg-black rounded-md bg-center bg-cover bg-no-repeat relative z-20"
            style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ $randomImage }}');">
            <div class="absolute flex justify-center  w-full h-max bottom-0 lg:translate-y-[50%] md:translate-y-[50%] sm:translate-y-[70%] translate-y-[100%] left-0 z-10">
                    <div class="lg:w-[80%] bg-white shadow-lg shadow-black/10 rounded-xs">
                        <div class="w-full  p-4 flex flex-col gap-2 mx-auto">
                            <span class=" text-secondary font-semibold lg:text-2xl md:text-2xl sm:text-xl text-lg">Travel Visa Requirements</span>
                            <p class="lg:text-sm">Sometimes a journey of a thousand miles begins with a visa. Check your destination and apply online for any visa in the world.</p>
                        </div>
                        <div class="w-full border-b-[1px] border-b-secondary"></div>
                        <form action="{{ route('searchvisa') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{--add this div if there are 4 inputs--}}
                            <div class=" grid grid lg:grid-cols-4 md:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-2 p-4">

                                {{--add this div if there are 2 inputs--}}
                                {{--                                    <div class=" grid grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 p-4">--}}
                                <div class="w-full flex flex-col gap-1">
                                    <label for="leavingFrom" class="text-ternary font-bold text-sm">Your Travel Destination</label>
                                    <div class="w-full relative">
                                           <select name="destinationcountry" id="destinationcountry" class="visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                                <option value="">---Select Country---</option>
                                                @forelse($countries as $country)
                                                    <option value="{{ $country->id }}" {{ $country->id == $destination ? 'selected' : '' }}>{{ $country->countryName }}</option>
                                                @empty
                                                    <option value="">No record found</option>
                                                @endforelse
                                            </select>
                                         
                                        <i class="fa fa-location-dot text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                        <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                    </div>
                                </div>

                                <div class="w-full flex flex-col gap-1">
                                    <label for="arriveTo" class="text-ternary font-bold text-sm">Visa Type </label>
                                    <div class="w-full relative">
                                        <select name="visatype" id="visatype" class="visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                                @forelse($visas as $visa)
                                                    <option value=" {{ $visa->VisaServices->name }}"> {{ $visa->VisaServices->name }}</option>
                                                @empty
                                                    <option value="">No record found</option>
                                                @endforelse
                                       </select>

                                        <i class="fa fa-location-dot text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                        <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                    </div>
                                </div>
                                <div class="w-full flex flex-col gap-1">
                                    <label for="arriveTo" class="text-ternary font-bold text-sm">Your Citizenship</label>
                                    <div class="w-full relative">
                                        <select name="origincountry" id="origincountry" class="visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                            
                                               @forelse($countries as $country)
                                                    <option value="{{$country->id}}" {{ $country->id == $orgin ? 'selected' : '' }}>{{$country->countryName}}</option>
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
                                        <select name="livingCountry" id="livingCountry" class="visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                            <option value="">---Select Country---</option>
                                            @forelse($countries as $country)
                                                <option value="{{$country->id}}" {{ $country->id == $orgin ? 'selected' : '' }}>{{$country->countryName}}</option>

                                            @empty
                                                <option value="">No record found</option>
                                            @endforelse
                                        </select>

                                        <i class="fa fa-location-dot text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                        <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                                    </div>
                                </div>
                                {{--add this div if there are 4 inputs--}}
                                <div class="w-full lg:col-span-4 md:col-span-4 sm:col-span-2 col-span-1 flex justify-end ">
                                    {{--add this div if there are 2 inputs--}}
                                    {{--                                            <div class="w-full lg:col-span-2 md:col-span-2 sm:col-span-2 col-span-1 flex justify-end ">--}}
                                    <input type="submit" id="searchFlightButton" value="Check Requirements" class=" cursor-pointer mt-2 w-max showLoader font-bold text-lg bg-secondary text-white px-6 py-2 rounded-[3px]  hover:bg-secondary hover:text-white transition ease-in duration-2000">
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
                <div class="w-full m-auto h-auto flex flex-col justify-center px-4 pb-6 rounded-b-md">
                    @if(!$visas->isEmpty())
                        <div class="w-full gap-2 flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-col sm:flex-col flex-col ">
                            <div class="sticky top-20 2xl:w-1/5 xl:w-1/5 lg:w-1/5 md:w-full sm:w-full w-full h-max flex flex-wrap border-2 border-secondary/30 border-b-[0px]">
                                @forelse($visas as $visa)
                                    <div class="tab p-2 flex border-b-2 border-b-secondary/30 2xl:w-full xl:w-full lg:w-full md:w-1-5 sm:w-1/3 w-1/2 flex-col hover:bg-primary/10 cursor-pointer transition ease-in duration-2000
                                            {{ $loop->first ? 'border-l-4 border-l-red-500 bg-secondary/10' : '' }}" data-tab="{{$visa->id}}">
                                        <span class="text-black text-xl">{{ $visa->VisaServices->name }}</span>
                                        @if($visa->required == 0)
                                            <span class="text-red-500 font-bold text-lg">Required</span>
                                        @endif
                                    </div>
                                @empty
                                    <div class="p-2 flex 2xl:w-full xl:w-full lg:w-full md:w-1-5 sm:w-1/3 w-1/2 flex-col border-l-4 border-l-red-500">
                                        <span class="text-black font-semibold text-xl">No Record found</span>
                                    </div>
                                @endforelse
                            </div>
                            @forelse($visas as $visa)
                                <div class="tabdata 2xl:w-4/5 xl:w-4/5 lg:w-4/5 md:w-full sm:w-full w-full 2xl:mt-0 xl:mt-0 lg:mt-0 md:mt-4 sm:mt-4 mt-4 px-5 py-3 border-2 border-secondary/30 {{ $loop->first ? '' : 'hidden' }}" id="tab-{{$visa->id}}">
                                    <div>
                                        <span class="text-black font-semibold ">NOTE:</span>
                                        <span class="ml-3 text-black text-sm">E-visa is not available to </span>
                                        <span class=" text-red-500 text-sm">Diplomatic/Official Passport</span>
                                        <span class=" text-black text-sm">or</span>
                                        <span class=" text-red-500 text-sm">Laissez-passer travel document holders </span>
                                        <span class=" text-black text-sm">as well as </span>
                                        <span class=" text-red-500 text-sm">International Travel Document Holders.</span>
                                    </div>

                                    <div class=" px-5 py-4 flex flex-col bg-gray-200 rounded-md mt-4 ">
                                        <span class="m-auto text-gray-700 2xl:text-xl xl:text-xl lg:text-xl md:text-xl sm:text-lg text-md">Fill out India tourist e-visa application form online </span>
                                        <a href="{{route('visa.payment',['id'=>$visa->id])}}" class="m-auto text-white bg-red-600 py-1.5 px-10 mt-4 text-lg font-semibold rounded-md">GET STARTED</a>
                                        <!-- <a href="{{route('visa.payment',['id'=>$visa->id])}}" class="m-auto text-white bg-red-600 py-3 px-10 mt-4 text-xl font-semibold rounded-md"><span class="m-auto text-white bg-red-600 py-3 px-10 mt-4 text-xl font-semibold rounded-md">GET STARTED</span> </a>-->
                                        <span class="m-auto text-gray-700 2xl:text-xl xl:text-xl lg:text-xl md:text-xl sm:text-lg text-md mt-4">and provide digital copies of the following documents:</span>
                                    </div>

                                    <div>
                                        {!!$visa->description!!}
                                    </div>
                                    {{-- Price Table for Large Screens --}}
                                    <div class="2xl:flex xl:flex lg:flex md:flex sm:hidden hidden flex-col">
                                        <div class="flex justify-between px-3 font-semibold text-black text-lg mt-2">
                                            <div class="flex w-full">
                                                <div class="w-1/5">
                                                    <span>Type of visa</span>
                                                </div>
                                            </div>
                                        </div>

                                        <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                                            <tr>
                                                <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Type of visa</th>
                                                <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Validity</th>
                                                <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Processing</th>
                                                <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Embassy fee</th>
                                                <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Service fee</th>
                                                <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">VAT (20%)</th>
                                                <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Total cost</th>
                                            </tr>



                                            @forelse($visa->Subvisas as $subvisa)
                                                <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$subvisa->name}}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{ $subvisa->validity}}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{ $subvisa->processing }}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$subvisa->price}}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$subvisa->commission}}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{ $subvisa->gstin ?? 'N/A' }} %</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$subvisa->price+$subvisa->commission}}</td>

                                                </tr>


                                            @empty
                                                <tr>
                                                    <td colspan="9" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                                                </tr>
                                            @endforelse
                                        </table>
                                    </div>
                                    {{-- Price Table for Large Screens Ends --}}

                                    <div class="mt-5">
                                        <span class="text-lg text-red-600 font-bold">Maximum stay in India: 30 Days? </span>
                                    </div>

                                    <div class="mt-5 flex mb-16">
                                        <a href="{{route('visa.payment',['id'=>$visa->id])}}"> <span class="text-lg bg-red-700 text-white px-10 py-3 rounded-sm font-bold m-auto">GET STARTED</span></a>
                                    </div>
                                </div>
                            @empty
                                <div class="p-2 flex 2xl:w-full xl:w-full lg:w-full md:w-1/5 sm:w-1/3 w-1/2 flex-col border-l-4 border-l-red-500">
                                    <span class="text-black font-semibold text-xl">No Record found</span>
                                </div>
                            @endforelse
                        </div>
                    @else
                        <div class="w-full  flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-col sm:flex-col flex-col mt-10 ">
                            No Record Found
                        </div>
                    @endif
                </div>
            </div>
        </div>



        @section('scripts')
            <script>
                
                        $(document).ready(function() {
                            $('#origincountry').select2({
                                placeholder: "---Select Country---",
                                allowClear: true,
                                containerCssClass: 'visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60'
                            });
                            $('#destinationcountry').select2({
                                placeholder: "---Select Country---",
                                allowClear: true,
                                containerCssClass: 'visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60'
                            });
                            $('#livingCountry').select2({
                                placeholder: "---Select Country---",
                                allowClear: true,
                                containerCssClass: 'visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60'
                            });
                            $('#visatype').select2({
                                placeholder: "---Select Country---",
                                allowClear: true,
                                containerCssClass: 'visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60'
                            });

                            
                 });
                jQuery(document).ready(function () {
                    jQuery(document).on("click", ".tab", function () {
                        var tab = jQuery(this).data('tab');

                        // Remove active class from all tabs and add to the clicked one
                        jQuery(".tab").removeClass("border-l-4 border-l-red-500 bg-secondary/10");
                        jQuery(this).addClass("border-l-4 border-l-red-500 bg-secondary/10");

                        // Hide all tab contents and show the selected one
                        jQuery(".tabdata").hide();
                        jQuery("#tab-" + tab).show();
                    });
                });
            </script>

        @endsection