<x-front.layout>
@section('title') Visa Application @endsection
<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include jQuery (required by Select2) and Select2 JS -->   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Applications List  </span>
            <!-- <a href="{{route('visa.create')}}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000"> Create New Visa </a>  -->
  
        
         </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
        <div class="w-full overflow-x-auto p-4">

        <form id="filter-form" method="GET" action="{{ route('superadminview.allapplication') }}" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <!-- Search -->
                                    <div>
                                        <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                            placeholder="Application Number">
                                    </div>

                            

                                    <!-- Date Range -->
                                    <div>
                                        <label for="date_from" class="block text-sm font-medium text-gray-700">Date Range</label>
                                        <div class="flex gap-2">
                                            <input type="date" name="date_from" id="date_from" max="9999-12-31" value="{{ request('date_from') }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                            <input type="date" name="date_to" id="date_to" max="9999-12-31" value="{{ request('date_to') }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                        </div>
                                    </div>


                                    <div>
                                            <label for="origin_id" class="block text-sm font-medium text-gray-700">Country Range</label>
                                           <div class="flex gap-2 mt-1">
                                        <!-- Origin Country -->
                                        <select name="origin_id" id="origin_id"
                                            class="select2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                            <option value="">Origin Country</option>
                                            @foreach($countries as $country)
                                                <option 
                                                    value="{{ $country->id }}" 
                                                    data-flag="{{ $country->getFlagUrlAttribute() }}"
                                                    {{ request('origin_id') == $country->id ? 'selected' : '' }}>
                                                    {{ $country->countryName }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <!-- Destination Country -->
                                        <select name="destination_id" id="destination_id"
                                            class="select2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                            <option value="">Destination Country</option>
                                            @foreach($countries as $country)
                                                <option 
                                                    value="{{ $country->id }}" 
                                                    data-flag="{{ $country->getFlagUrlAttribute() }}"
                                                    {{ request('destination_id') == $country->id ? 'selected' : '' }}>
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
                                                <option value="Complete" {{ request('application_status') == 'Complete' ? 'selected' : '' }}>Complete</option>
                                                <option value="Pending" {{ request('application_status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Under Process" {{ request('application_status') == 'Under Process' ? 'selected' : '' }}>Under Process</option>
                                                <option value="Rejected" {{ request('application_status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                <option value="Custom Message" {{ request('application_status') == 'Custom Message' ? 'selected' : '' }}>Custom Message</option>
                                            </select>
                                        </div>



                                    <div>
                                        <label for="payment_method" class="block text-sm font-medium text-gray-700">Agency</label>
                                        <select name="agencyid" id="agencyid" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                            <option value="">All Agency</option>
                                            @foreach($agencies as $agency)
                                                <option value="{{ $agency->id }}" {{ request('agencyid') == $agency->id?'selected' : '' }}>
                                                    {{ $agency->name }}
                                                </option>
                                                @endforeach
                                        </select>     
                                    </div>


                                

                                
                                </div>

                                <!-- Filter Actions -->
                                <div class="flex justify-between items-center mt-4">
                                    <div class="flex gap-2">
                                        <button type="submit" class="bg-success text-white px-4 py-2 rounded-md hover:bg-success/90">
                                            Apply Filters
                                        </button>
                                        <a href="{{ route('superadminview.allapplication') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
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

<div class="max-h-[900px] overflow-auto mt-4 border border-gray-300 rounded-md">
        <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                <tr>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md whitespace-nowrap">Sr. No.</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md whitespace-nowrap">Application Number</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md whitespace-nowrap">Agency Details</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-mdwhitespace-nowrap">Client Details</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md whitespace-nowrap ">Visa</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md ">Document </th>
            
               
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md whitespace-nowrap">Total Amount(£)</th> 
                  
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md whitespace-nowrap">Application Submission Date  </th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md whitespace-nowrap">Passport Submit</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md whitespace-nowrap">Application status</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md ">Action</th>




                    <!-- <td class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Description</td> -->
                    <!-- <td class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Sub Type</td> -->
                  
         
                </tr>
            
                @forelse($allbookings as $booking)
                      
                    <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm whitespace-nowrap">{{ $booking->deduction->superadmin_invoice_number}}
                            <br><span class="font-medium text-xs"> <i class="fa fa-user mr-1"></i> Order Id:{{$booking->application_number}} </span>
                            
                        </td>
                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm {{ request('agencyid') == $booking->agency->id ? 'bg-yellow-100' : '' }}">
                            {{ $booking->agency->name }}
                            
                        </td>


                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm whitespace-nowrap">
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

                                    <span><i class="fa fa-user mr-1"></i>{{ $fullName }}</span><br>
                                    <span class="font-medium text-xs"><i class="fa fa-envelope mr-1"></i>{{ $email }}</span><br>
                                    <span class="font-medium text-xs"><i class="fa fa-phone mr-1"></i>{{ $phone }}</span>
                                    
                                </td>
                        <td class="border-[2px] border-secondary/40 px-4 py-0.5 text-ternary/80 font-medium text-sm ">
                            <span class="text-sm text-ternary/80 font-medium flex items-center gap-2 mr-6 whitespace-nowrap">
                                <img src="{{ asset('assets/flags/64x48/' . strtolower($booking->origin->countryCode) . '.png') }}" 
                                    alt="{{ $booking->origin->countryCode }}" 
                                    class="w-5 h-4 object-cover rounded-sm" />
                                {{ $booking->origin->countryName }}

                                <span class="mx-1">to</span>

                                <img src="{{ asset('assets/flags/64x48/' . strtolower($booking->destination->countryCode) . '.png') }}" 
                                    alt="{{ $booking->destination->countryCode }}" 
                                    class="w-5 h-4 object-cover rounded-sm" />
                                {{ $booking->destination->countryName }}
                            </span>
                            <span class="block leading-tight text-sm">{{ $booking->visa->name }}</span>
                            <span class="block font-medium text-xs leading-tight">{{ $booking->visasubtype->name }}</span>
                        </td>

                      
                        <!-- <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                        
                                <span class="font-medium text-xs" >Total :  {{ $booking->clientapplciation->count() ?: 0 }}</span><br>
                                <span class="font-medium text-xs"> Pending :  {{ $booking->clientapplciation()->where('document_status', '0')->count() }}</span><br>
                                <span class="font-medium text-xs"> Done :      {{ $booking->clientapplciation()->where('document_status', '1')->count() }}</span>
                            </td> -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm whitespace-nowrap">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-xs ">
                                        <i class="fa fa-file mr-1"></i>Total: {{ $booking->clientapplciation->count() ?: 0 }}<br>
                                        <i class="fa fa-hourglass-half mr-1"></i>Pending: {{ $booking->clientapplciation->where('document_status', '0')->count() }}<br>
                                        <i class="fa fa-check mr-1"></i> Done: {{ $booking->clientapplciation->where('document_status', '1')->count() }}
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
                                    {{--<div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                        <i class="fa fa-check"></i> <!-- FontAwesome icon -->
                                    </div> 

                                    <a href="{{ route('superadminaad.document.upload', ['id' => $booking->id]) }}" title="Uploade Document">
                                    <div class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-200">
                                       <i class="fas fa-upload"></i><!-- FontAwesome icon -->
                                        </div> 
                                    </a> --}}
                                @else
                                
                                 {{--<a href="{{ route('superadminaad.document.application', ['id' => $booking->id]) }}" title="Remind for funds">
                                    <div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-plus"></i> <!-- FontAwesome icon -->
                                        </div> 
                                    </a>
                                    <a href="{{ route('superadminvisaedit.application', ['id' => $booking->id]) }}" title="Remind for funds">
                                        <div class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                    </a>

                                    <a href="{{ route('superadminvisasendemail.application', ['id' => $booking->id]) }}" title="Remind for funds">
                                        <div class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                    </a> --}}

                                    {{-- <a href="{{route('superadminvisachat.client',['id' => $booking->client_id,'token'->$booking->agency->agencytoken])}}" title="Edit">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fas fa-comment-dots"></i>
                                        </div>
                                      </a> --}}
                                    {{--  <a href="{{ route('superadminvisachat.client', ['id' => $booking->client_id, 'token' => $booking->agency->agencytoken]) }}" title="Edit">
                                        <div class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fas fa-comment-dots"></i>
                                        </div>
                                    </a>--}}

                                @endif

                                <!-- <a href="{{ route('visa.assign', ['id' => $booking->id]) }}" title="Assign to Visa Request">
                                    <div class="bg-blue-100 text-blue-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-blue-600 hover:text-white transition ease-in duration-200">
                                        <i class="fa fa-clipboard-check"></i> 
                                    </div>
                                </a> -->

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
            {{ $allbookings->onEachSide(0)->links() }}


        </div>

 
        <script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%', // keep full-width like Tailwind
            placeholder: 'Select a country',
            allowClear: true
        });
    });
</script>
<script>
    $(document).ready(function () {
        function formatCountry (country) {
            if (!country.id) {
                return country.text;
            }

            const flagUrl = $(country.element).data('flag');
            const countryName = country.text;

            if (flagUrl) {
                return $(`
                    <span class="flex items-center gap-2">
                        <img src="${flagUrl}" class="w-5 h-4 object-cover rounded-sm" />
                        <span>${countryName}</span>
                    </span>
                `);
            }

            return countryName;
        }

        // Initialize all select2 elements with flag template
        $('.select2').select2({
            templateResult: formatCountry,
            templateSelection: formatCountry,
            width: '100%'
        });
    });

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




</x-front.layout>