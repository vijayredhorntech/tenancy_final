<x-client.layout>
    @section('title')All Invoices @endsection



    <!-- new model  -->



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

           {{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Client Invoices</span>
            </div>
             {{--        === heading section code ends here===--}}

             {{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto px-4 min-h-[600px]">
                <div style="margin-bottom: 30px;">
                    <form id="filter-form" method="GET" action="" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <!-- Search -->
                                <div>
                                    <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                        placeholder="Name, Email, Transaction ID">
                                </div>

                                <!-- Depart ment Range -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Service</label>
                                    <select name="department" id="department" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                           <option value="">All Status</option>
                                             <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Flight</option>
                                            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Hotel</option>
                                             <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Visa</option>

                                    </select>
                                </div>

                                <!-- Date Range -->
                                <div>
                                    <label for="date_from" class="block text-sm font-medium text-gray-700">Date Range</label>
                                    <div class="flex gap-2">
                                        <input type="date" name="date_from" id="date_from" max="2099-12-31" value="{{ request('date_from') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                        <input type="date" name="date_to" id="date_to" max="2099-12-31" value="{{ request('date_to') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                    </div>
                                </div>

                                <!-- Status Filter -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                        <option value="">All Status</option>
                                        <option value="confirm" {{ request('status') == 'confirm' ? 'selected' : '' }}>Confirm</option>
                                        <option value="edited" {{ request('status') == 'edited' ? 'selected' : '' }}>Edit</option>
                                        <option value="Adjusted" {{ request('status') == 'Adjusted' ? 'selected' : '' }}>Adjusted</option>
                                    </select>
                                </div>

                              

                            
                            </div>

                            <!-- Filter Actions -->
                            <div class="flex justify-between items-center mt-4">
                                <div class="flex gap-2">
                                    <button type="submit" class="bg-success text-white px-4 py-2 rounded-md hover:bg-success/90">
                                        Apply Filters
                                    </button>
                                    <a href="{{ route('invoice.all', ['type' => 'agencies']) }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                                        Clear Filters
                                    </a>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <label for="PerPage" class="text-sm font-medium text-gray-700">Show:</label>
                                    <select name="PerPage" id="PerPage" class="rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                            onchange="this.form.submit()">
                                        @foreach([10, 25, 50, 100] as $PerPage)
                                            <option value="{{ $PerPage }}" {{ request('per_page', 10) == $PerPage ? 'selected' : '' }}>
                                                {{ $PerPage }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- @canany(['export excel', 'manage everything'])
                                    <a href="{{ route('studentgenerate.excel') }}?{{ http_build_query(request()->all()) }}" 
                                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                        Export CSV
                                    </a>
                                    @endcanany
                                    @canany(['export pdf', 'manage everything'])
                                    <a href="{{ route('studentgenerate.pdf') }}?{{ http_build_query(request()->all()) }}"
                                        class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                            Export PDF
                                    </a>
                                    @endcanany --}}
                                </div>
                            </div>
                    </form> 
                    <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                        <tr>
                            <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>          
                            <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice No.</td>
                            <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Receiver Name</td>
                            <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Service</td>
                            <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice Date</td>
                            <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Amount</td>
                            <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                        </tr>

                        

                        @forelse($invoices as $invoice)

                              


                                    <tr>
                                        <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>                         
                                        <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">
                                            @if($invoice->invoice && $invoice->invoice->status === 'edited')
                                                {{ $invoice->invoice->new_invoice_number }} 
                                            @elseif($invoice->invoicestatus === 'Adjusted')
                                                {{ $invoice->invoice->new_invoice_number ?? $invoice->invoice_number ?? 'N/A' }} <span class="bg-purple-100 text-purple-600 px-2 py-1 rounded text-xs font-medium">Adjusted</span>
                                            @elseif($invoice->invoicestatus === 'Retrieved')
                                                {{ $invoice->invoice_number ?? 'N/A' }} <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs font-medium">Retrieved</span>
                                            @elseif($invoice->invoicestatus === 'amendment')
                                                {{ $invoice->invoice_number ?? 'N/A' }} <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs font-medium">Amendment</span>
                                           
                                            @else
                                                {{ $invoice->invoice_number ?? 'N/A' }}
                                            @endif
                                        </td>
                                                                                
                                        <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">
                                            @php
                                                $receiverName = 'N/A';
                                                // Priority: Use receiver_name from invoice if available (for edited invoices)
                                                if (!empty($invoice->invoice->receiver_name)) {
                                                    $receiverName = strtoupper($invoice->invoice->receiver_name);
                                                } elseif (!empty($invoice->visaBooking->clint->client_name)) {
                                                    $receiverName = strtoupper($invoice->visaBooking->clint->client_name);
                                                } elseif (!empty($invoice->visaBooking->clientDetailsFromUserDB->client_name)) {
                                                    $receiverName = strtoupper($invoice->visaBooking->clientDetailsFromUserDB->client_name);
                                                } else {
                                                    // Try to manually load client details if needed
                                                    try {
                                                        $clientDetails = \App\Models\ClientDetails::where('id', $invoice->visaBooking->client_id)->first();
                                                        if ($clientDetails && !empty($clientDetails->client_name)) {
                                                            $receiverName = strtoupper($clientDetails->client_name);
                                                        }
                                                    } catch (\Exception $e) {
                                                        // If all else fails, show N/A
                                                    }
                                                }
                                            @endphp
                                            {{ $receiverName }}
                                        </td>
                                        
                                        <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$invoice->service_name->name}}</td>
                                        <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$invoice->date ? \Carbon\Carbon::parse($invoice->date)->format('d-m-Y') : '—'}}</td>
                                        {{-- <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm"> {{$invoice['amount']}}</td> --}}
                                          <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">
                                            @if($invoice->invoice && $invoice->invoice->status === 'edited')
                                                £{{ number_format($invoice->invoice->new_price ?? 0, 2) }}
                                            @elseif($invoice->invoicestatus === 'Adjusted')
                                                £{{ number_format($invoice->invoice->amount ?? $invoice->amount ?? 0, 2) }}
                                            @else
                                                £{{ number_format($invoice['amount'] ?? 0, 2) }}
                                            @endif
                                        </td>
                                     <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                            <div class="flex gap-2 items-center">
                                                <a href="{{ route('client.viewinvoice', ['id' => $invoice->flight_booking_id]) }}"
                                                class="bg-success/10 text-success px-3 h-7 flex items-center justify-center gap-1 
                                                        rounded-[3px] hover:bg-success hover:text-white transition">
                                                    <i class="fa fa-eye text-xs"></i>
                                                    <span>View</span>
                                                </a>
                                            </div>
                                        </td>

                                </tr>


                                @empty
                                    <tr>
                                        <td colspan="7" class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm text-center">No Record Found</td>
                                    </tr>
                                @endforelse


                        </table>
                </div>
            </div>



    </div>


</x-client.layout>
