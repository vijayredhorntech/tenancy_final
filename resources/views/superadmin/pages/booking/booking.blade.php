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
                <span class="font-semibold text-ternary text-xl">Booking List </span>
                </div>
{{--        === heading section code ends here===--}}


                  


{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex justify-between gap-2 items-center">
                     <div class="flex gap-4">
                      <div class="flex flex-col gap-2   border-r-[1px] border-r-black/30 pr-4">
                         <div>
                                 <span class="font-semibold ">Export All</span>
                         </div>
                         <div class="flex gap-2">
                         <a href="{{route('superadmin.exportexcel')}}"> 
                         <button title="Export to excel" class="bg-success/20 text-success h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white  cursor-pointer transition ease-in duration-2000">
                             <i class="fa fa-file-excel"></i>
                         </button>
                        </a>

                        <a href="{{route('superadmin.exportpdf')}}"> 
                         <button title="Export to pdf" class="bg-danger/20 text-danger h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white  cursor-pointer transition ease-in duration-2000">
                               <i class="fa fa-file-pdf"></i>
                         </button>
                        </a>
                         </div>
                      </div>
                        

                      <div class="flex flex-col gap-2 ">
                         <div>
                                 <span class="font-semibold ">Export Displayed</span>
                         </div>
                            <div class="flex gap-2">
                            <a href="{{route('superadmin.exportexcel')}}"> 
                            <button title="Export to excel" class="bg-success/20 text-success h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white  cursor-pointer transition ease-in duration-2000">
                                <i class="fa fa-file-excel"></i>
                            </button>
                            </a>

                            <a href="{{route('superadmin.exportpdf')}}"> 
                            <button title="Export to pdf" class="bg-danger/20 text-danger h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white  cursor-pointer transition ease-in duration-2000">
                                <i class="fa fa-file-pdf"></i>
                            </button>
                            </a>
                            </div>
                      </div>
                     </div>
                     <div class="flex items-center gap-2">
                     <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Search By Service</label>
                             <div class="w-full relative">
                                 <select  name="searchbyservice" id="searchbyservice"
                                          class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                     <option value="">---Select---</option>
                                     @forelse($services as $service)
                                     <option value="{{$service->id}}">{{$service->name}}</option>
                                     @empty
                                     <option> No Service create </option> 
                                     @endforelse
                                 </select>
                                 <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                             </div>
                         </div>
                    </div>

                    <div class="flex items-center gap-2">
                    <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Search By Service supplier</label>
                             <div class="w-full relative">
                             <select  name="supplier" id="searchbysupplier"
                                          class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                     <option value="">---Select---</option>
                                     @forelse($flights as $flight =>$value)
                                        <option value="{{ $flight }}">{{ $value }}</option> 
                                    @empty
                                        <option>No Service created</option>
                                    @endforelse
                                 </select>
                   
                                 <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                             </div>
                         </div>
                    </div>

                    <!-- <div class="flex items-center gap-2">
                    <div class="w-full relative group flex flex-col gap-1">
                    <form method="GET" action="" class="flex items-center gap-2">
                            <div class="flex flex-col">
                                <label for="start_date" class="font-semibold text-ternary/90 text-sm">Start Date</label>
                                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                                    class="px-2 py-1 rounded-[3px] border-[1px] border-secondary/40 focus:outline-none">
                            </div>

                            <div class="flex flex-col">
                                <label for="end_date" class="font-semibold text-ternary/90 text-sm">End Date</label>
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                                    class="px-2 py-1 rounded-[3px] border-[1px] border-secondary/40 focus:outline-none">
                            </div>

                            <button type="submit"
                                class="px-4 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                                Filter
                            </button>
                        </form>
                     </div>
                    </div> -->



                  


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
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md"> Name</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md"> Price</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md"> Service Name</td>  
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md"> Total Passenger</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md"> Booking Date</td>
                        <!-- <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Created At</td> -->
                        <!-- <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td> -->
                    </tr>

                    
                    @forelse($bookings as $booking)

                            @php 
                            $flight_name=json_decode($booking->flightBooking['details'], true);
                            // Decode the JSON
                            // First decode
                            $passengers = json_decode(json_decode($booking->flightBooking->flightSearch, true), true);
                            $totalPassengers = (int) ($passengers['adult'] ?? 0) + 
                                                        (int) ($passengers['child'] ?? 0) + 
                                                        (int) ($passengers['infant'] ?? 0);
                            $flight_code=$flight_name[0]['journey'][0]['Carrier'];
                            $carrier = \App\Models\Airline::where('iata', $flight_code)->first();
                            $carrierName = $carrier ? $carrier->name : 'Unknown Carrier';
                            
                            @endphp
                       
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$booking->agency['name']}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$booking['amount']}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$booking->service_name['name']}}<br> 
                                <span> ({{$carrierName}}) </span>
                            </td>

                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm"> {{$totalPassengers}}
                            </td>

                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$booking['date']}}</td>
                         
                          
                            <!-- <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
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
                            </td> -->
                        </tr>


                    @empty
                        <tr>
                            <td colspan="8" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                        </tr>
                    @endforelse


                </table>

                  <!-- Pagination Links -->
          <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                     
                    </div>
   
                    <div>
                      
                    </div>
          </div>
            </div>
{{--        === table section code ends here===--}}
      


        <script>
                $(document).ready(function () {
                    $('#searchbyservice, #searchbysupplier').change(function () {
                        let serviceId = $('#searchbyservice').val();
                        let supplier = $('#searchbysupplier').val();

                        $.ajax({
                            url: "{{ route('bookings.filter') }}",  // Route for filtering
                            type: "GET",
                            data: {
                                service_id: serviceId,
                                supplier_name: supplier
                            },
                            success: function (response) {
                                $('#filtered-results').html(response);
                            }
                        });
                    });
                });
            </script>

        </div>
        
</x-front.layout>
