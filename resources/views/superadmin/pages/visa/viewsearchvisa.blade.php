<x-agency.layout>
    @section('title') Visa View @endsection


        <div class="p-4 w-full ">
                <div class="w-full bg-white p-4 flex flex-col gap-2 rounded-t-md mx-auto">

                    <span class="font-semibold lg:text-3xl md:text-2xl sm:text-xl text-lg">Cloud-travel.co.uk</span>
                    <p>India visa for Singapore passport holder living in United Kingdom</p>
                        <div id="item1" class="carousel-item w-full" style="height: 300px">
                            <img  src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1474&q=80" class="w-full h-full object-cover" />
                        </div>
                </div>
                <div class="w-full mx-auto bg-white rounded-b-md shadow-lg shadow-ternary/30">
                    <div class="w-full m-auto h-auto flex flex-col justify-center  bg-white px-4 pb-6  rounded-b-md">
                        @if(!$visas->isEmpty())
                            <div class="w-full  flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-col sm:flex-col flex-col ">

                                <div class="2xl:w-1/5 xl:w-1/5 lg:w-1/5 md:w-full sm:w-full w-full h-max flex flex-wrap border-2 border-secondary/30">

                                    @forelse($visas as $visa)
                                        <div class="tab p-2 flex 2xl:w-full xl:w-full lg:w-full md:w-1-5 sm:w-1/3 w-1/2 flex-col
                {{ $loop->first ? 'border-l-4 border-l-red-500' : '' }}" data-tab="{{$visa->id}}">
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

                                    <div class="tabdata 2xl:w-4/5 xl:w-4/5 lg:w-4/5 md:w-full sm:w-full w-full
      2xl:mt-0 xl:mt-0 lg:mt-0 md:mt-4 sm:mt-4 mt-4 px-5 py-3 border-2 border-secondary/30
      {{ $loop->first ? '' : 'hidden' }}" id="tab-{{$visa->id}}">

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
                                                    <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">GSTIN (18%)</th>
                                                    <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Total cost</th>
                                                </tr>



                                                @forelse($visa->Subvisas as $subvisa)
                                                    <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                                                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$subvisa->name}}</td>
                                                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">up to 10 years</td>
                                                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">15 business days</td>
                                                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$subvisa->price}}</td>
                                                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$subvisa->commission}}</td>
                                                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">0</td>
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
        jQuery(document).ready(function () {
            jQuery(document).on("click", ".tab", function () {
                var tab = jQuery(this).data('tab');

                // Remove active class from all tabs and add to the clicked one
                jQuery(".tab").removeClass("border-l-4 border-l-red-500");
                jQuery(this).addClass("border-l-4 border-l-red-500");

                // Hide all tab contents and show the selected one
                jQuery(".tabdata").hide();
                jQuery("#tab-" + tab).show();
            });
        });
    </script>
@endsection


    </x-agency.layout>
