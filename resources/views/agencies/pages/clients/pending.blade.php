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
       <form id="filter-form" method="GET" action="{{ route('client.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Search -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                    placeholder="Clientid, Name, Email, Payment Number">
                            </div>
                            <div>
                                <label for="date_from" class="block text-sm font-medium text-gray-700">Date Range</label>
                                <div class="flex gap-2">
                                    <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                    <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                </div>
                            </div>

                         </div>

                        <!-- Filter Actions -->
                        <div class="flex justify-between items-center mt-4">
                            <div class="flex gap-2">
                                <button type="submit" class="bg-success text-white px-4 py-2 rounded-md hover:bg-success/90">
                                    Apply Filters
                                </button>
                                <a href="{{ route('client.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
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
                                <a href="{{ route('agencies.funddownloade') }}?{{ http_build_query(request()->all()) }}" 
                                class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                    Export CSV
                                </a>
                                <a href="{{ route('agencies.exportfundpdf') }}?{{ http_build_query(request()->all()) }}"
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
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Document </th>
            
               
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Total</th> 
                  
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Booking Date  </th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Document Submit</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Application status</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>




                    <!-- <td class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Description</td> -->
                    <!-- <td class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Sub Type</td> -->
                  
         
                </tr>
               

                
                @forelse($allbookings as $booking)

              
                    <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$booking->application_number}}</td>

                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">
                        @php

                                    $fullName = isset($booking->clint->client_name) && isset($booking->clint->client_name) && isset($booking->clint->client_name) 
                                                ? $booking->clint->client_name 
                                                : '';
                                    $cleanName = str_replace(',', '', $fullName);

                                    $email = isset($booking->clint) && isset($booking->clint) && isset($booking->clint->email) 
                                            ? $booking->clint->email 
                                            : '';

                                    $phone = isset($booking->clint) && isset($booking->clint) && isset($booking->clint->phone_number) 
                                            ? $booking->clint->phone_number 
                                            : '';
                                @endphp

                                <span>{{ $cleanName }}</span><br>
                                <span class="font-medium text-xs">{{ $email }}</span><br>
                                <span class="font-medium text-xs">{{ $phone }}</span>
                        </td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                             <span>{{$booking->visa->name }}</span><br>
                            <span class="font-medium text-xs">{{$booking->visasubtype->name }}</span><br> 
                          

                
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$booking->origin->countryName }} To {{$booking->destination->countryName }}</td>
                      
                        <!-- <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                        
                                <span class="font-medium text-xs" >Total :  {{ $booking->clientapplciation->count() ?: 0 }}</span><br>
                                <span class="font-medium text-xs"> Pending :  {{ $booking->clientapplciation()->where('document_status', '0')->count() }}</span><br>
                                <span class="font-medium text-xs"> Done :      {{ $booking->clientapplciation()->where('document_status', '1')->count() }}</span>
                            </td> -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex justify-between items-center">
                                <span class="font-medium text-xs border p-4 rounded-md block">
                                        Total: {{ $booking->clientapplciation->count() ?: 0 }}<br>
                                        Pending: {{ $booking->clientapplciation->whereIn('document_status', [0, 2])->count() }}<br>
                                        Done: {{ $booking->clientapplciation->where('document_status', 1)->count() }}
                                    </span>

                                    <span class="font-medium text-xs">
                                        <i class="fas fa-eye text-blue-500 cursor-pointer"></i> <!-- Single View Icon -->
                                    </span>
                                </div>
                            </td>




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
                                            'Rejected' => ['bg' => 'bg-red-200', 'text' => 'text-red-700'],
                                            'Custom Message' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-600']
                                        ];
                                        $colors = $statusColors[$status] ?? ['bg' => 'bg-gray-200', 'text' => 'text-gray-700'];
                                    @endphp

                                            @if($status === 'Custom Message' && !empty($booking->custom_message))
            <span class="px-2 py-1 rounded-[3px] font-medium cursor-pointer text-sm" 
                  style="background-color: #26ace2; color: white;"
                  title="Click on it"
                  onclick="showCustomMessage('{{ addslashes($booking->custom_message) }}')">
                Message
            </span>
        @else
            <span class="{{ $colors['bg'] }} {{ $colors['text'] }} px-2 py-1 rounded-[3px] font-medium">
                {{ $status }}
            </span>
        @endif
                                </td>

                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                            <div class="flex gap-2 items-center">
                                @if($booking->applicationworkin_status == "Complete")              
                                    <div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                        <i class="fa fa-check"></i> <!-- FontAwesome icon -->
                                    </div> 
                                @else
                                        @php
                                            $pendingCount = $booking->clientapplciation->whereIn('document_status', [0, 2])->count();
                                        @endphp

                                        @if($pendingCount > 0)
                                            <!-- <a href="{{route('clientuplaode.document',['id' => $booking->id])}}" title="Upload Document">
                                                <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                                    <i class="fas fa-upload"></i>
                                                </div>
                                            </a> -->
                                            <a href="{{ route('clientuplaode.document', ['id' => $booking->id, 'type' => 'agency']) }}" title="Upload Document">
                                            <div class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                                <i class="fas fa-upload"></i>
                                            </div>
                                        </a>

                                        @endif

                                
                                @endif

                             

                                <a href="{{ route('superadminvisa.applicationview', ['id' => $booking->id]) }}" title="Assign to Visa Request">
                                    <div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                        <i class="fa fa-eye"></i> <!-- FontAwesome icon -->
                                    </div>
                                </a>

                           
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
          


        </div>

<script>
    // Custom Message Modal Functions
    function showCustomMessage(message) {
        // Create modal if it doesn't exist
        let modal = document.getElementById('customMessageModal');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'customMessageModal';
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            modal.innerHTML = `
                <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4 relative">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Custom Message</h3>
                        <button onclick="closeCustomMessage()" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                    </div>
                    <div class="mb-4">
                        <p class="text-gray-700 leading-relaxed" id="customMessageText"></p>
                    </div>
                    <div class="flex justify-end">
                        <button onclick="closeCustomMessage()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                            Close
                        </button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
        }
        
        // Set the message content
        document.getElementById('customMessageText').textContent = message;
        
        // Show modal
        modal.style.display = 'flex';
    }

    function closeCustomMessage() {
        const modal = document.getElementById('customMessageModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('customMessageModal');
        if (modal && e.target === modal) {
            closeCustomMessage();
        }
    });
</script>

 </x-agency.layout>