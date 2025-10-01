<x-agency.layout>
    @section('title') Visa Application @endsection

    <!-- Success Alert for Updated Applications -->
    @if (session('success'))
        <div id="success-alert" class="alert flex items-center justify-between p-4 mb-4 text-sm font-medium text-white border-2 border-success/30 rounded-lg bg-success shadow-md transition-all duration-300" role="alert">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-4l-3-3 1.414-1.414L9 11.172l4.586-4.586L15 8l-6 6z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="dismissAlert('success-alert')" class="alert ml-4 text-white hover:text-gray-200 focus:outline-none">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Info Alert for Updated Applications -->
    @if (session('info'))
        <div id="info-alert" class="alert flex items-center justify-between p-4 mb-4 text-sm font-medium text-white border-2 border-blue-500/30 rounded-lg bg-blue-500 shadow-md transition-all duration-300" role="alert">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('info') }}</span>
            </div>
            <button onclick="dismissAlert('info-alert')" class="alert ml-4 text-white hover:text-gray-200 focus:outline-none">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include jQuery (required by Select2) and Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<style>
    .action-dropdown {
        position: relative;
        display: inline-flex;
        align-items: stretch;
        border-radius: 0.375rem;
        overflow: visible;
        border: 1px solid rgba(22, 163, 74, 0.25);
        background-color: #dcfce7;
        z-index: 10;
    }

    .action-dropdown .primary-action {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 0.85rem;
        font-weight: 600;
        font-size: 0.85rem;
        color: #15803d;
        text-decoration: none;
        transition: background-color 0.2s ease, color 0.2s ease;
        white-space: nowrap;
        background-color: transparent;
    }

    .action-dropdown .primary-action:hover {
        background-color: #16a34a;
        color: #ffffff;
    }

    .action-dropdown .dropdown-toggle {
        display: inline-flex;
        align-items: center;
        padding: 0.4rem 0.55rem;
        border: none;
        background-color: transparent;
        color: #15803d;
        cursor: pointer;
        border-left: 1px solid rgba(22, 163, 74, 0.25);
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .action-dropdown .dropdown-toggle:hover,
    .action-dropdown.open .dropdown-toggle {
        background-color: #16a34a;
        color: #ffffff;
    }

    .action-dropdown-menu {
        display: none;
        position: absolute;
        left: 0;
        top: calc(100% + 0.3rem);
        padding: 0;
        background-color: transparent;
        border: none;
        min-width: 11rem;
        width: 100%;
        box-shadow: none;
        z-index: 999;
        flex-direction: column;
    }

    .action-dropdown.open .action-dropdown-menu {
        display: flex;
    }

    .action-dropdown-menu .dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.45rem 0.85rem;
        font-weight: 600;
        transition: background-color 0.2s ease, color 0.2s ease;
        font-size: 0.85rem;
        white-space: nowrap;
        width: 100%;
    }

    .action-dropdown-menu .dropdown-item i {
        width: 1rem;
        text-align: center;
    }

    .action-dropdown-menu .dropdown-item.amendment-item {
        background-color: #6b21a8;
        color: #ffffff;
        border-radius: 0.375rem;
        border: 1px solid #581c87;
    }

    .action-dropdown-menu .dropdown-item.amendment-item:hover {
        background-color: #581c87;
    }
</style>



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
                                            class="select2 mt-1 block w-full text-gray-200 rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                            <option value="">Select Origin Country</option>
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
                                            <option value="">Select Destination Country</option>
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
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa To  </th>
                
                   
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Total</th> 
                      
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Booking Date  </th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Document Submit</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Application status</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Update Status</th>
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
                                            {{-- <span class="px-2 py-1 rounded-[3px] font-medium cursor-pointer text-sm" 
                                                  style="background-color: #26ace2; color: white;"
                                                  title="Click on it"
                                                  onclick="showCustomMessage('{{ addslashes($booking->custom_message) }}')">
                                              {{$booking->custom_message}}
                                            </span> --}}
                                          <p>  {{$booking->custom_message}} </p>
                                        @else
                                            <span class="{{ $colors['bg'] }} {{ $colors['text'] }} px-2 py-1 rounded-[3px] font-medium">
                                                {{ $status }}
                                            </span>
                                        @endif
                                    </td>

                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                @if($booking->sendtoadmin == 3)
                                    <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded-[3px] font-medium" title="Application has been updated and needs to be sent to admin again">
                                        <i class="fas fa-sync-alt mr-1"></i>Updated
                                    </span>
                                    <br><span class="text-xs text-orange-600">Needs re-send</span>
                                @elseif($booking->sendtoadmin == 2)
                                    <span class="bg-blue-200 text-blue-700 px-2 py-1 rounded-[3px] font-medium" title="Client has filled application, waiting for agency review">
                                        <i class="fas fa-user-edit mr-1"></i>Client Filled
                                    </span>
                                    <br><span class="text-xs text-blue-600">Ready for review</span>
                                @elseif($booking->sendtoadmin == 1)
                                    <span class="bg-green-200 text-green-700 px-2 py-1 rounded-[3px] font-medium" title="Application has been sent to admin">
                                        <i class="fas fa-check mr-1"></i>Sent
                                    </span>
                                @else
                                    <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded-[3px] font-medium" title="Application is pending">
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    </span>
                                @endif
                            </td>

                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                @if($booking->confirm_application==0 || $booking->confirm_application==2 )
                                <a href="{{ route('verify.application', ['id' => $booking->id]) }}" title="Remind for funds">
                                    <div class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-200">
                                        <i class="fa fa-hourglass-half"></i>
                                    </div>
                                </a>
                                @else
                                <div class="flex gap-2 items-center">
                               
                             

                                    <div class="action-dropdown">
                                        <a href="{{ route('visa.applicationview', ['id' => $booking->id]) }}" class="primary-action" title="View Application">
                                            <i class="fa fa-eye text-sm"></i>
         	                                <span>View Application</span>
                                        </a>
                                           </div>
                                    </div>

                                    @endif

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

            <script>
                (function initActionDropdowns() {
                    const dropdowns = document.querySelectorAll('.action-dropdown');

                    if (!dropdowns.length) {
                        return;
                    }

                    function closeAllDropdowns(except = null) {
                        dropdowns.forEach((dropdown) => {
                            if (dropdown !== except) {
                                dropdown.classList.remove('open');
                            }
                        });
                    }

                    dropdowns.forEach((dropdown) => {
                        const toggleButton = dropdown.querySelector('.dropdown-toggle');

                        if (!toggleButton) {
                            return;
                        }

                        toggleButton.addEventListener('click', function (event) {
                            event.preventDefault();
                            event.stopPropagation();

                            const isOpen = dropdown.classList.contains('open');
                            closeAllDropdowns();

                            if (!isOpen) {
                                dropdown.classList.add('open');
                            }
                        });
                    });

                    document.addEventListener('click', function () {
                        closeAllDropdowns();
                    });
                })();
            </script>

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
</script>

<script>
    // Auto-hide all alerts with class 'alert' after 5 seconds
    setTimeout(() => {
        const alerts = [...document.getElementsByClassName('alert')];
        alerts.forEach(hideAlert);
    }, 5000);

    function hideAlert(element) {
        if (!element) return;

        // Add Tailwind classes to fade out and collapse
        element.classList.add('opacity-0', 'h-0', 'overflow-hidden', 'mb-0', 'transition-all', 'duration-300');

        // Remove the element after transition (300ms)
        setTimeout(() => {
            element.style.display = 'none';
        }, 300);
    }

    function dismissAlert(alertId) {
        const alert = document.getElementById(alertId);
        if (alert) {
            hideAlert(alert);
        }
    }

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
