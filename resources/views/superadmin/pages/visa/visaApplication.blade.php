<x-agency.layout>
    @section('title') Visa Application @endsection



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Applications List  </span>
                <!-- <a href="{{route('visa.create')}}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000"> Create New Visa </a>  -->
      
            
             </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
         
            <form id="filter-form" method="GET" action="{{ route('agency.application',['all']) }}" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <!-- Search -->
                                    <div>
                                        <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                            placeholder="Name, Email, Transaction ID">
                                    </div>

                            

                                    <!-- Date Range -->
                                    <div>
                                        <label for="date_from" class="block text-sm font-medium text-gray-700">Date Range</label>
                                        <div class="flex gap-2">
                                            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                            <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                        </div>
                                    </div>


                                    <div>
                                            <label for="origin_id" class="block text-sm font-medium text-gray-700">Country Range</label>
                                            <div class="flex gap-2">
                                                <!-- Origin Country -->
                                                <select name="origin_id" id="origin_id"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                                    <option value="">Select Origin Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" {{ request('origin_id') == $country->id ? 'selected' : '' }}>
                                                            {{ $country->countryName }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <!-- Destination Country -->
                                                <select name="destination_id" id="destination_id"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                                    <option value="">Select Destination Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" {{ request('destination_id') == $country->id ? 'selected' : '' }}>
                                                            {{ $country->countryName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                         

                                    <!-- Payment Method Filter -->
                                    <div>
                                            <label for="supplier" class="block text-sm font-medium text-gray-700">Application Status</label>
                                            <select name="application_status" id="application_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                                <option value="">All</option>
                                                <option value="Complete" {{ request('supplier') == 'Complete' ? 'selected' : '' }}>Complete</option>
                                                <option value="Pending" {{ request('supplier') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            </select>
                                        </div>



                                    {{--<div>
                                        <label for="payment_method" class="block text-sm font-medium text-gray-700">Agency</label>
                                        <select name="agencyid" id="agencyid" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                            <option value="">All Agency</option>
                                            @foreach($agencies as $agency)
                                                <option value="{{ $agency->id }}" {{ request('agencyid') == $agency->id?'selected' : '' }}>
                                                    {{ $agency->name }}
                                                </option>
                                                @endforeach
                                        </select>     
                                    </div> --}}


                                

                                
                                </div>

                                <!-- Filter Actions -->
                                <div class="flex justify-between items-center mt-4">
                                    <div class="flex gap-2">
                                        <button type="submit" class="bg-success text-white px-4 py-2 rounded-md hover:bg-success/90">
                                            Apply Filters
                                        </button>
                                        <a href="{{ route('agency.application',['all']) }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                                            Clear Filters
                                        </a>
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <label for="per_page" class="text-sm font-medium text-gray-700">Show:</label>
                                        <select name="per_page" id="per_page" class="rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                                onchange="this.form.submit()">
                                            @foreach([10, 25, 50, 100] as $perPage)
                                                <option value="{{ $perPage }}" {{ request('per_page', 10) == $perPage ? 'selected' : '' }}>
                                                    {{ $perPage }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <a href="{{ route('superadmin.visaexportexcel') }}?{{ http_build_query(request()->all()) }}" 
                                        class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                            Export CSV
                                        </a>
                                        <a href="{{ route('superadmin.visaexportpdf') }}?{{ http_build_query(request()->all()) }}"
                                            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                                Export PDF
                                            </a>
                                    </div>
                                </div>
        </form> 
            
         
         
              <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Application Number</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Client Details</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa To </th>
                
                   
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Total</th> 
                      
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Booking Date  </th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Passport Submit</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Application status</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>




                        <!-- <td class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Description</td> -->
                        <!-- <td class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Sub Type</td> -->
                      
             
                    </tr>
                   
                    @forelse($allbookings as $booking)
                   
                      
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$booking->application_number}}</td>

                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                    @php
                                        if (isset($booking->otherclientid) && isset($booking->otherapplicationDetails)) {
                                            $firstName = $booking->otherapplicationDetails?->name ?? '';
                                            $lastName = $booking->otherapplicationDetails?->lastname ?? '';
                                            $fullName = trim($firstName . ' ' . $lastName);

                                            $email = $booking->clint?->email ?? '';
                                            $phone = $booking->clint?->phone_number ?? '';
                                        } else {
                                            $fullName = $booking->clint?->client_name ?? '';
                                            $email = $booking->clint?->email ?? '';
                                            $phone = $booking->clint?->phone_number ?? '';
                                        }
                                    @endphp

                                    <span>{{ $fullName }}</span><br>
                                    <span class="font-medium text-xs">{{ $email }}</span><br>
                                    <span class="font-medium text-xs">{{ $phone }}</span>
                                </td>

                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                 <span>{{$booking->visa->name }}</span><br>
                                <span class="font-medium text-xs">{{$booking->visasubtype->name }}</span><br> 
                              

                         
                       
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$booking->origin->countryName }} To {{$booking->destination->countryName }}</td>
                          
                       
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$booking->total_amount}}</td>
                          
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{ $booking->created_at->format('d M Y') }}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                        <span class="bg-{{ $booking->document_status === 'Pending' ? 'danger' : 'success' }}/10 
                                                    text-{{ $booking->document_status === 'Pending' ? 'danger' : 'success' }} 
                                                    px-2 py-1 rounded-[3px] font-medium">
                                            {{ $booking->document_status }}
                                        </span>
                                    </td>

                            {{--        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                        <span class="bg-{{ $booking->applicationworkin_status === 'Pending' ? 'danger' : 'success' }}/10 
                                                    text-{{ $booking->applicationworkin_status === 'Pending' ? 'danger' : 'success' }} 
                                                    px-2 py-1 rounded-[3px] font-medium">
                                            {{ $booking->applicationworkin_status }}
                                        </span>
                                    </td> --}}

                                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                        @php
                                            $status = $booking->applicationworkin_status;
                                            $statusColors = [
                                                'Pending' => ['bg' => 'bg-red-200', 'text' => 'text-red-700'],
                                                'Complete' => ['bg' => 'bg-green-200', 'text' => 'text-green-700'],
                                                'Under Process' => ['bg' => 'bg-blue-200', 'text' => 'text-blue-700'],
                                                'Rejected' => ['bg' => 'bg-red-200', 'text' => 'text-red-700']
                                            ];
                                            $colors = $statusColors[$status] ?? ['bg' => 'bg-gray-200', 'text' => 'text-gray-700'];
                                        @endphp

                                        <span class="{{ $colors['bg'] }} {{ $colors['text'] }} px-2 py-1 rounded-[3px] font-medium">
                                            {{ $status }}
                                        </span>
                                    </td>

                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                @if($booking->confirm_application==0)
                                <a href="{{ route('verify.application', ['id' => $booking->id]) }}" title="Remind for funds">
                                    <div class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-200">
                                        <i class="fa fa-hourglass-half"></i>
                                    </div>
                                </a>
                                @else
                                <div class="flex gap-2 items-center">
                                    @if($booking->applicationworkin_status == "Complete")              
                                     
                                    @else
                                      {{--  <a href="{{ route('visaedit.application', ['id' => $booking->id]) }}" title="Remind for funds">
                                            <div class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-200">
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                        </a>

                                        <a href="{{ route('visasendemail.application', ['id' => $booking->id]) }}" title="Remind for funds">
                                            <div class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-200">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </a>

                                        <a href="{{route('agencychat.client',['id' => $booking->client_id])}}" title="Edit">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fas fa-comment-dots"></i>
                                        </div>
                                      </a>--}}
                                    @endif

                                    {{-- <a href="{{ route('visa.assign', ['id' => $booking->id]) }}" title="Assign to Visa Request">
                                        <div class="bg-blue-100 text-blue-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-blue-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-clipboard-check"></i> 
                                        </div>
                                    </a> --}}

                                    <a href="{{ route('visa.applicationview', ['id' => $booking->id]) }}" title="Assign to Visa Request">
                                        <div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-eye"></i> <!-- FontAwesome icon -->
                                        </div>
                                    </a>

                                    @if($booking->sendtoadmin == 0)  
                                  {{--  <a href="{{ route('visa.sendtoadmin', ['id' => $booking->id]) }}" title="Send to Admin" onclick="return confirm('Are you sure you want to send this application to admin?');">
                                        <div class="bg-blue-100 text-blue-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-blue-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-paper-plane"></i> <!-- "Send" icon -->
                                        </div>
                                    </a>--}}
                                   
                                  
                                    @endif
                                    @endif
                                    <!-- <a href="" title="View Dashboard">
                                        <div class=" bg-danger/10 text-danger h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-computer"></i>
                                        </div>
                                    </a> -->


                                </div>
                            </td>
                        </tr>


                    @empty
                        <tr>
                            <td colspan="9" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                        </tr>
                    @endforelse


            </table>
                {{ $allbookings->onEachSide(0)->links() }}


            </div>


        
    </x-agency.layout>
