<x-front.layout>
    @section('title')
        Agency
    @endsection


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">{{ $user->name ?? 'N/A' }}</span>
        
        </div>


        <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex flex-wrap ">
                <div data-tid ="fundsDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] bg-secondary/40 border-[2px] border-secondary/60 border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer ">
                        Logs
                    </div>
                    <div data-tid ="bookingDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer ">
                       
                    </div>
                    <div data-tid ="profileDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60   text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer   ">
                        Profile
                    </div>
                </div>

                <div class="w-full mt-4 ">
                    <div id="fundsDiv" class="tab  ">
                        <div class="w-full grid xl:grid-cols-1 lg:grid-cols-1 gap-4">
                            <div class="w-full ">
                                <div class="  border-[2px] border-primary/70 ">
                                    <div class="flex justify-center bg-primary/40 px-4 py-0.5">
                                        <span class="font-semibold text-ternary text-xl">Logs</span>
                                    </div>
                                    <div class="mt-2 overflow-x-auto px-4 py-0.5">
                                        <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">
                                            <tr>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">User Name</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Url </td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Date</td>
                                        


                                            </tr>



                                            @forelse($user->log as $log)

                                                <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{ $user->name ?? 'N/A' }}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$log->url}}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$log->created_at}}</td>
                                              

                                                </tr>


                                            @empty
                                                <tr>
                                                    <td colspan="8" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm text-center">No Record Found</td>
                                                </tr>
                                            @endforelse


                                        </table>
                                    </div>
                                </div>
                            </div>
                         
                        </div>
                    </div>
                    <div id="bookingDiv" class="tab hidden">
                      
                     </div>
                    <div id="profileDiv" class="tab hidden ">
                        <div class="w-full border-[1px] border-success/40">
                            <div class="flex bg-success/40 px-4 py-0.5">
                                <span class="font-semibold text-ternary text-xl">Agency Details</span>
                            </div>
                            <div class="w-full p-4 grid lg:grid-cols-3 gap-x-4 gap-y-8 ">
                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-2 pr-12 border-b-[2px] border-b-success">
                                        <span class="font-semibold text-ternary text-lg">Basic Information:</span>
                                    </div>
                                    <div class="flex flex-col mt-4 overflow-x-auto">
                                        <div class="w-full pb-4">
                                      
                                        @if(isset($user->profile))
                                            <img src="{{ asset('images/user/profile/' . $user->profile) }}" alt="Cloud Travel"  class="h-24 mr-4" />
                                        @else
                                        <img src="{{asset('assets/images/profile_photo.jpg')}}" class="h-40 rounded-md w-auto " alt="">
                                        @endif
                                           
                                        </div>
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">User name: </span>
                                            <span class="text-ternary text-medium italic">   {{$user->name}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Role </span>
                                            <span class="text-ternary text-medium italic"></span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary"></span>
                                            <span class="text-ternary text-medium italic"> </span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Emergency Person name</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->emergency_person_name}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Emergency Person number</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->emergency_contact_number}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-2 pr-12 border-b-[2px] border-b-success">
                                        <span class="font-semibold text-ternary text-lg">Contact Information:</span>
                                    </div>
                                    <div class="flex flex-col mt-4 ">
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Email:</span>
                                            <span class="text-ternary text-medium italic">{{$user->email}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Telephone: </span>
                                            <span class="text-ternary text-medium italic">01780-200705 </span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Phone:</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->phone_number}}</span>
                                        </div>
                                    </div>

                                    <!-- <div class="pb-2 pr-12 border-b-[2px] border-b-success mt-8">
                                        <span class="font-semibold text-ternary text-lg">Address :</span>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Address</span>
                                            <span class="text-ternary text-medium italic"> </span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Database: </span>
                                            <span class="text-ternary text-medium italic"> </span>
                                        </div>

                                    </div>  -->

                                    
                                </div>
                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-2 pr-12 border-b-[2px] border-b-success">
                                        <span class="font-semibold text-ternary text-lg">Address Information:</span>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Address:</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->address}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">City: </span>
                                            <span class="text-ternary text-medium italic"> </span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">State:</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->state}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Country:</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->country}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Zip Code:</span>
                                            <span class="text-ternary text-medium italic"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-2 pr-12 border-b-[2px] border-b-success">
                                        <span class="font-semibold text-ternary text-lg">Bank Details:</span>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Account Number</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->account_number}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Short Code </span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->short_code}} </span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Bank Name</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->bank_name}}</span>
                                        </div>
                                       
                                    </div>
                                </div>




                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script>
        jQuery(document).ready(function () {
            jQuery(document).on("click", ".agency_tab", function () {
                                var id = jQuery(this).data('tid');
                                  jQuery(".agency_tab").removeClass("bg-secondary/40 border-[2px] border-secondary/60");
                                jQuery(this).addClass("bg-secondary/40 border-[2px] border-secondary/60");

                                // Hide all tabs and show the selected one
                                jQuery(".tab").hide();
                                jQuery("#" + id).show();
                            });
                });

        </script>

</x-front.layout>
