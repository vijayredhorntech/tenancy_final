<x-front.layout>
    @section('title')
        Agency
    @endsection


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">{{ $agency->name ?? 'N/A' }}</span>
                <button type="button" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000"> Balance :: {{ '£'. $agency->balance->balance ?? '' }}</button>
            </div>

            <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex flex-wrap ">
                <div data-tid ="fundsDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] bg-secondary/40 border-[2px] border-secondary/60 border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer ">
                        Funds
                    </div>
                    <div data-tid ="bookingDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer ">
                        Bookings
                    </div>
                    <div data-tid ="profileDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60   text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer   ">
                        Profile
                    </div>
                </div>

                <div class="w-full mt-4 ">
                    <div id="fundsDiv" class="tab  ">
                        <div class="w-full grid xl:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="w-full ">
                                <div class="  border-[2px] border-primary/70 ">
                                    <div class="flex justify-center bg-primary/40 px-4 py-0.5">
                                        <span class="font-semibold text-ternary text-xl">Credit</span>
                                    </div>
                                    <div class="mt-2 overflow-x-auto px-4 py-0.5">
                                        <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">
                                            <tr>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice Number</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Amount </td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Created At</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Payment type</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Payment Number</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Remarks</td>

                                            </tr>



                                            @forelse($credits as $credit)

                                                <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{  $credit['invoice_number'] ?? '' }}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{ '£'. $credit['amount'] ?? 'No Amount' }}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{ $credit['created_at'] ? $credit['created_at'] : 'No Date' }}</td>

                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{  $credit['payment_type'] ?? '' }}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{  $credit['payment_number'] ?? '' }}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{  $credit['remark'] ?? '' }}</td>

                                                </tr>


                                            @empty
                                                <tr>
                                                    <td colspan="9" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                                                </tr>
                                            @endforelse


                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full ">
                                <div class="  border-[2px] border-danger/70 ">
                                    <div class="flex justify-center bg-danger/40 px-4 py-0.5">
                                        <span class="font-semibold text-ternary text-xl">Debit</span>
                                    </div>
                                    <div class="mt-2 overflow-x-auto px-4 py-0.5">
                                        <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">
                                            <tr>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Service</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Created At</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Amount</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Payment Type</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Payment number</td>

                                            </tr>

                                            @forelse($deductions  as $deduction)


                                                <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm"> {{ $deduction->service_name ? $deduction->service_name->name : 'No Service' }}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{ $deduction['created_at'] ? $deduction['created_at'] : 'No Date' }}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">  {{ '£'.$deduction['amount'] ?? 'No Amount' }}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm"></td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm"> </td>

                                                </tr>


                                            @empty
                                                <tr>
                                                    <td colspan="9" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                                                </tr>
                                            @endforelse


                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="bookingDiv" class="tab hidden">
                         <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">
                                                    <tr>
                                                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Service</td>
                                                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Created At</td>
                                                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Amount</td>
                                                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Payment Type</td>
                                                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Payment number</td>

                                                            </tr>

                                                                                    @forelse($deductions  as $deduction)


                                                                                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                                                                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                                                                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm"> {{ $deduction->service_name ? $deduction->service_name->name : 'No Service' }}</td>
                                                                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{ $deduction['created_at'] ? $deduction['created_at']->format('Y-m-d') : 'No Date' }}</td>
                                                                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">  {{ '£'.$deduction['amount'] ?? 'No Amount' }}</td>
                                                                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm"></td>
                                                                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm"> </td>
                                                                                        </tr>



                                                                                    @empty
                                                                                        <tr>
                                                                                            <td colspan="9" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                                                                                        </tr>
                                                                                                      @endforelse


                                                                              </table>
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
                                            <img src="{{asset('assets/images/profile_photo.jpg')}}" class="h-40 rounded-md w-auto " alt="">
                                        </div>
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Agency name: </span>
                                            <span class="text-ternary text-medium italic">   {{$agency->name}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Vat number: </span>
                                            <span class="text-ternary text-medium italic"></span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Services</span>
                                            <span class="text-ternary text-medium italic">FLIGHT, HOTEL </span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Contact person name</span>
                                            <span class="text-ternary text-medium italic">{{$agency->contact_person}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Contact person contact</span>
                                            <span class="text-ternary text-medium italic">{{$agency->contact_phone}}</span>
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
                                            <span class="text-ternary text-medium italic">{{$agency->email}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Telephone: </span>
                                            <span class="text-ternary text-medium italic">01780-200705 </span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Phone:</span>
                                            <span class="text-ternary text-medium italic">{{$agency->phone}}</span>
                                        </div>
                                    </div>

                                    <div class="pb-2 pr-12 border-b-[2px] border-b-success mt-8">
                                        <span class="font-semibold text-ternary text-lg">Database Information:</span>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Domain:</span>
                                            <span class="text-ternary text-medium italic">AGENCY DOMAIN </span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Database: </span>
                                            <span class="text-ternary text-medium italic">{{$agency->database_name}} </span>
                                        </div>

                                    </div>
                                </div>
                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-2 pr-12 border-b-[2px] border-b-success">
                                        <span class="font-semibold text-ternary text-lg">Address Information:</span>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Address:</span>
                                            <span class="text-ternary text-medium italic">{{$agency->address}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">City: </span>
                                            <span class="text-ternary text-medium italic"> </span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">State:</span>
                                            <span class="text-ternary text-medium italic"></span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Country:</span>
                                            <span class="text-ternary text-medium italic">{{$agency->country}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Zip Code:</span>
                                            <span class="text-ternary text-medium italic"></span>
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
