<x-front.layout>
    @section('title')Agency @endsection
           <div id="viewServiceModel" class="w-full h-full absolute top-0 left-0 bg-white/40 z-20 flex hidden  justify-center items-center cursor-pointer" >
                 <div class="rounded-[3px] bg-white px-8 py-12 shadow-lg shadow-gray-300 border-[2px] border-gray-400/50 max-w-7xl relative">
                     <div class="absolute top-1 right-1 h-6 w-6 flex rounded-full justify-center items-center bg-danger/30 border-[1px] border-danger/70 text-ternary hover:bg-danger hover:text-white transition ease-in duration-2000" onclick="document.getElementById('viewServiceModel').classList.toggle('hidden')">
                          <i class="fa fa-xmark"></i>
                     </div>
                         <span class="font-medium text-lg ">Services for agency  <i class="font-semibold text-secondary"><u>Skyline Tours</u></i></span>

                         <div class="w-full grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-3 mt-4">
                             <div class="w-full flex justify-center">
                                 <span class="font-semibold"># Flight</span>
                             </div>
                             <div class="w-full flex justify-center">
                                 <span class="font-semibold"># Hotel</span>
                             </div>
                             <div class="w-full flex justify-center">
                                 <span class="font-semibold"># Visas</span>
                             </div>
                         </div>
                 </div>
           </div>
          <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20">
                <span class="font-semibold text-ternary text-xl">Agency Bookings/ Service </span>
            </div>

            <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex justify-between gap-2 items-center">
                     <div class="flex gap-2">
                         <button title="Export to excel" class="bg-success/20 text-success h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white  cursor-pointer transition ease-in duration-2000">
                             <i class="fa fa-file-excel"></i>
                         </button>
                         <button title="Export to pdf" class="bg-danger/20 text-danger h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white  cursor-pointer transition ease-in duration-2000">
                               <i class="fa fa-file-pdf"></i>
                         </button>
                     </div>
                    <div class="flex items-center gap-2">
                           <input type="text" placeholder="Agency name....." class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000" >
                           <button class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                                <i class="fa fa-search mr-1"></i> Search
                           </button>
                    </div>
                </div>
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Agency Name</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Created At</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Services</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Fund Allotted</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Fund Remaining</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Status</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                    </tr>
                    @php
                        $bookings = [
                                         ['name' => 'Skyline Tours', 'created_at' => '12-02-2025', 'service' => '5', 'fund_allotted' => '£ 1,50,000.00', 'fund_remaining' => '£ 75,000.00', 'status' => 'Active'],
                                         ['name' => 'Elite Voyages', 'created_at' => '25-01-2025', 'service' => '2', 'fund_allotted' => '£ 3,00,000.00', 'fund_remaining' => '£ 1,25,000.00', 'status' => 'Inactive'],
                                         ['name' => 'Global Getaways', 'created_at' => '08-12-2024', 'service' => '4', 'fund_allotted' => '£ 2,50,000.00', 'fund_remaining' => '£ 90,000.00', 'status' => 'Active'],
                                         ['name' => 'Sunshine Holidays', 'created_at' => '19-11-2024', 'service' => '1', 'fund_allotted' => '£ 1,75,000.00', 'fund_remaining' => '£ 60,000.00', 'status' => 'Active'],
                                         ['name' => 'Oceanic Travels', 'created_at' => '30-01-2025', 'service' => '3', 'fund_allotted' => '£ 2,00,000.00', 'fund_remaining' => '£ 80,000.00', 'status' => 'Inactive'],
                                         ['name' => 'Mountain Peak Adventures', 'created_at' => '14-02-2025', 'service' => '6', 'fund_allotted' => '£ 4,00,000.00', 'fund_remaining' => '£ 1,75,000.00', 'status' => 'Active'],
                                         ['name' => 'Nomad Travel Co.', 'created_at' => '05-01-2025', 'service' => '2', 'fund_allotted' => '£ 2,75,000.00', 'fund_remaining' => '£ 1,00,000.00', 'status' => 'Active'],
                                         ['name' => 'Blue Horizon Tours', 'created_at' => '22-12-2024', 'service' => '5', 'fund_allotted' => '£ 3,50,000.00', 'fund_remaining' => '£ 1,50,000.00', 'status' => 'Active'],
                                         ['name' => 'Wanderlust Ventures', 'created_at' => '10-02-2025', 'service' => '4', 'fund_allotted' => '£ 2,25,000.00', 'fund_remaining' => '£ 85,000.00', 'status' => 'Active'],
                                         ['name' => 'Exotic Escape', 'created_at' => '28-01-2025', 'service' => '3', 'fund_allotted' => '£ 1,80,000.00', 'fund_remaining' => '£ 70,000.00', 'status' => 'Inactive'],

                                     ];
                    @endphp

                    @forelse($bookings as $booking)
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$booking['name']}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$booking['created_at']}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                              <div class="flex  gap-2">
                                  {{$booking['service']}}
                                  <button type="button" title="View Services" onclick="document.getElementById('viewServiceModel').classList.toggle('hidden')">
                                      <div class=" bg-primary/10 text-primary h-6 w-6 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                          <i class="fa fa-eye"></i>
                                      </div>
                                  </button>
                              </div>
                            </td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex justify-between gap-2">
                                    {{$booking['fund_allotted']}}
                                    <a href="" title="Add Funds">
                                        <div class=" bg-success/10 text-success h-6 w-6 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-database"></i>
                                        </div>
                                    </a>
                                </div>
                            </td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm"> {{$booking['fund_remaining']}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <span class="bg-{{$booking['status']==='Inactive'?'danger':'success'}}/10 text-{{$booking['status']==='Inactive'?'danger':'success'}} px-2 py-1 rounded-[3px] font-bold">{{$booking['status']}}</span>
                            </td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">
                                    <a href="" title="Remind for funds">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-bell"></i>
                                        </div>
                                    </a>
                                    <a href="" title="View Invoices">
                                        <div class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-file"></i>
                                        </div>
                                    </a>
                                    <a href="" title="View Dashboard">
                                        <div class=" bg-danger/10 text-danger h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-computer"></i>
                                        </div>
                                    </a>


                                </div>
                            </td>
                        </tr>


                    @empty
                        <tr>
                            <td colspan="8" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                        </tr>
                    @endforelse


                </table>
            </div>
        </div>
</x-front.layout>
