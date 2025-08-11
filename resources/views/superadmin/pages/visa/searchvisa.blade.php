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
                {{-- search form componnet --}}
             <x-visa-search :countries="$countries" />
             
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
