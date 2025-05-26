<x-front.layout>
    @section('title')Agency @endsection



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
                        

                      <!-- <div class="flex flex-col gap-2 ">
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
                      </div> -->
                     </div>
                     <div class="flex items-center gap-2">
                     <!-- <div class="w-full relative group flex flex-col gap-1">
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
                         </div> -->
                    </div>

                    <div class="flex items-center gap-2">
                    <!-- <div class="w-full relative group flex flex-col gap-1">
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
                         </div> -->
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
                           <!-- <input type="text" placeholder="Agency name....." class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000" >
                           <button class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                                <i class="fa fa-search mr-1"></i> Search
                           </button> -->
                    </div>
                </div>
                <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-warning bg-white flex gap-2 flex-col ">
            <div class="bg-warning/10 px-4 py-2 border-b-[2px] border-b-warning/20">
                <span class="font-semibold text-ternary text-xl">Recent Bookings</span>
            </div>
            <div class="flex space-x-2">
                    <button class="px-4 py-2 text-white bg-danger rounded-md border border-danger shadow  service active" data-id="flight">Flight Booking</button>
                    <button class="px-4 py-2  border border-danger rounded-md service" data-id="visa" >Visa Application</button>
                    <button class="px-4 py-2  border border-danger rounded-md service"  data-id="hotel" >Hotel Booking</button>
             </div>

            <div class="w-full overflow-x-auto p-4">
                <table class="w-full border-[1px] border-secondary/30 border-collapse recentbooking" id="flight" >
                    <tr>
                        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>          
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Agency Name</td>
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice No.</td>
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Service</td>                       
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Amount</td>                 
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Supplier Name</td>
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Booking Date</td>
                        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                    </tr>

                    
                    @forelse($flight_recent_booking as $booking)

                    @php 
                    if($booking->service==2){
                    $flight_name=json_decode($booking->flightBooking['details'], true);
                    $flight_code=$flight_name[0]['journey'][0]['Carrier'];
                    $carrier = \App\Models\Airline::where('iata', $flight_code)->first();
                    $carrierName = $carrier ? $carrier->name : 'Unknown Carrier';
                    }
                    @endphp
     
                        <tr>
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$booking->agency['name']}}</td>
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">
                            <a href="{{ route('superadminbooking', ['booking_number' => $booking['invoice_number'] ?? '']) }}">{{$booking['invoice_number']}} </a> </td> 
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$booking->service_name['name']}}</td>
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">£ {{$booking['amount']}}</td>
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{ isset($carrierName) ? $carrierName : '' }}</td>
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-bold text-sm"> {{$booking['date']}}</td>
                           
                    


                           
                          
                            
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">
                                                <a href="{{ route('superadminbooking', ['booking_number' => $booking['invoice_number'] ?? '']) }}" title="View Invoice">
                                        <div class=" bg-danger/10 text-danger h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-file-pdf"></i>
                                        </div>
                                    </a>

                                </div>
                            </td>
                        </tr>


                    @empty
                        <tr>
                            <td colspan="6" class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm text-center">No Record Found</td>
                        </tr>
                    @endforelse


                </table>

                <table class="w-full border-[1px] border-secondary/30 border-collapse recentbooking" id="visa"  style="display:none">
                    <tr>
                        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>          
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Agency Name</td>
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice No.</td>
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Client</td>   
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Service</td>                       
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">No of Applicant</td>  
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Destination</td>
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Amount</td>  
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Booking Date</td>
                        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                    </tr>

                    
                    @forelse($visa_recent_booking as $booking)

                 
              
                  
                        <tr>
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$booking->agency['name']}}</td>
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">
                            <a href="{{ route('superadminbooking', ['booking_number' => $booking['invoice_number'] ?? '']) }}">{{$booking['invoice_number']}} </a> </td> 
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">
                            @php
                                        $fullName = isset($booking->visaBooking) && isset($booking->visaBooking->clint) && isset($booking->visaBooking->clint->name) 
                                                    ? $booking->visaBooking->clint->name 
                                                    : '';
                                        $cleanName = str_replace(',', '', $fullName);

                                        $email = isset($booking->visaBooking) && isset($booking->visaBooking->clint) && isset($booking->visaBooking->clint->email) 
                                                ? $booking->visaBooking->clint->email 
                                                : '';

                                        $phone = isset($booking->visaBooking) && isset($booking->visaBooking->clint) && isset($booking->visaBooking->clint->phone_number) 
                                                ? $booking->visaBooking->clint->phone_number 
                                                : '';
                                    @endphp

                                    <span>{{ $cleanName }}</span><br>
                                    <span class="font-medium text-xs">{{ $email }}</span><br>
                                    <span class="font-medium text-xs">{{ $phone }}</span>

                           
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">  {{ isset($booking->service_name['name']) ? $booking->service_name['name'] : '' }}</td>
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{ isset($booking->visaApplicant) ? $booking->visaApplicant->count() + 1 : 0 + 1 }}
                            </td>
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">    {{ isset($booking->visaBooking) && isset($booking->visaBooking->origin) && isset($booking->visaBooking->origin->name) ? $booking->visaBooking->origin->name : '' }} 
                                    To 
                                    {{ isset($booking->visaBooking) && isset($booking->visaBooking->destination) && isset($booking->visaBooking->destination->name) ? $booking->visaBooking->destination->name : '' }}</td>
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm"> £ {{ isset($booking['amount']) ? $booking['amount'] : '0.00' }}</td>
                           
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-bold text-sm">  {{ isset($booking['date']) ? $booking['date'] : '' }}</td>
                           
                    


                           
                          
                            
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">
                                                <a href="{{ route('superadminbooking', ['booking_number' => $booking['invoice_number'] ?? '']) }}" title="View Invoice">
                                        <div class=" bg-danger/10 text-danger h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-file-pdf"></i>
                                        </div>
                                    </a>

                                </div>
                            </td>
                        </tr>


                    @empty
                        <tr>
                            <td colspan="6" class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm text-center">No Record Found</td>
                        </tr>
                    @endforelse


                </table>

                <table class="w-full border-[1px] border-secondary/30 border-collapse recentbooking" id="hotel"  style="display:none">
                    <tr>
                        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>          
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Agency Name</td>
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice No.</td>
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Client</td>   
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Service</td>                       
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">No of Applicant</td>  
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Destination</td>
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Amount</td>  
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Booking Date</td>
                        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                    </tr>

                        <tr>
                            <td colspan="6" class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm text-center">No Record Found</td>
                        </tr>
    
                </table>
            </div>
        </div>
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
                    jQuery(document).ready(function (){
                        jQuery(document).on("click", ".service", function () {
                            jQuery(".service").removeClass('active text-white bg-danger'); 
                            jQuery(this).addClass('active text-white bg-danger'); // Add active class to clicked button
                            jQuery(".recentbooking").hide(); 

                            var id = jQuery(this).data('id'); // Store the data-id value
                            jQuery("#" + id).show(); // Show the corresponding section
                        });
                    });

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
