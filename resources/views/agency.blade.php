<x-front.layout>
    @section('title')Agency @endsection


{{--    === this is code for model ===--}}
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
{{--        === model code ends ===--}}
    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Agency List </span>
                <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Agency</button>
            </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 hidden">
                 <form action="">
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Agency Name</label>
                             <div class="w-full relative">
                                 <input type="text" name="name" id="name" placeholder="Agency name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>

                         {{--               === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Phone</label>
                             <div class="w-full relative">
                                 <input type="number" name="name" id="name" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         {{--                === date type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Date</label>
                             <div class="w-full relative">
                                 <input type="date" name="date" id="datePicker"
                                        class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-calendar-day absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"
                                    onclick="document.getElementById('datePicker').showPicker();"></i>
                             </div>
                         </div>


                         {{--               === textarea input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Description</label>
                             <div class="w-full relative">
                                 <textarea   name="name" id="name" rows="1" placeholder="Description....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"></textarea>
                                 <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         {{-- === select input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Select box</label>
                             <div class="w-full relative">
                                 <select  name="date" id="datePicker"
                                          class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                     <option value="">---Select---</option>
                                     <option value="">Option 1</option>
                                     <option value="">Option 2</option>
                                     <option value="">Option 3</option>
                                     <option value="">Option 4</option>
                                 </select>
                                 <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                             </div>
                         </div>


                         {{--               === radio input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <span class="font-semibold text-ternary/90 text-sm">Select an Option</span>
                             <div class="flex gap-4">
                                 <label class="flex items-center gap-2">
                                     <input type="radio" name="option" value="option1" class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                     Option 1
                                 </label>
                                 <label class="flex items-center gap-2">
                                     <input type="radio" name="option" value="option2" class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                     Option 2
                                 </label>
                             </div>
                         </div>


                         {{--               === checkbox input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="agree" class="font-semibold text-ternary/90 text-sm flex items-center gap-2">
                                 <input type="checkbox" name="agree" id="agree" class="appearance-none w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                 I Agree to Terms
                             </label>
                         </div>
                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                          <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button>
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Create Agency</button>
                     </div>
                 </form>
             </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
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
                            <td colspan="9" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                        </tr>
                    @endforelse


                </table>
            </div>
{{--        === table section code ends here===--}}
        </div>
</x-front.layout>
