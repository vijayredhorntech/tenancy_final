<x-agency.layout>
    @section('title')Canceled Invoices @endsection
    <div class="w-full grid xl:grid-cols-5 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 mb-4">

    </div>

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Canceled Invoices</span>
            </div>
{{--        === heading section code ends here===--}}

{{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
                     <!-- search function  -->
         
            
            

              <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice Number</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Client Details</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Service Type</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Amount</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice Date</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Status</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>
                    </tr>

                    @forelse($invoices as $invoice)
      
               
                        <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-200">
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $loop->iteration }}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">{{ $invoice->invoice_number ?? 'N/A' }}</td>

                            <!-- Client Details (Assuming relation is client or user) -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                {{ $invoice->visaBooking->clientDetailsFromUserDB->client_name ?? 'N/A' }}<br>
                                <span class="text-xs text-gray-500">{{ $invoice->visaBooking->clientDetailsFromUserDB->email ?? '' }}</span> <br>
                                <span class="text-xs text-gray-500">{{ $invoice->visaBooking->clientDetailsFromUserDB->phone_number ?? '' }}</span>
                                
                            </td>

                            <!-- Service Type -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                {{ $invoice->service_name->name ?? 'N/A' }}
                            </td>

                            <!-- Amount -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                @if($invoice->invoice && $invoice->invoice->status === 'edited')
                                    {{ $invoice->invoice->new_price }}
                                @else
                                    {{ $invoice->amount ?? 'N/A' }}
                                @endif
                            </td>

                            <!-- Invoice Date -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                {{ $invoice->date ? \Carbon\Carbon::parse($invoice->date)->format('d-m-Y') : '—' }}
                            </td>

                            <!-- Status -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-semibold">
                                    Canceled
                                </span>
                            </td>

                            <!-- Action -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">
                                    <!-- View Button -->
                                    <a href="{{ route('viewinvoice', $invoice->flight_booking_id) }}"
                                    class="bg-blue-100 text-blue-600 px-2 py-1 rounded-[3px] hover:bg-blue-200 text-xs">
                                        View
                                    </a>


                                    <!-- Retrieve Button -->
                                    <a href="{{ route('retrieve.invoice', $invoice->id) }}"
                                       onclick="return confirm('Are you sure you want to retrieve this invoice?')"
                                       class="bg-green-100 text-green-600 px-2 py-1 rounded-[3px] hover:bg-green-200 text-xs">
                                        Retrieve
                                    </a>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm text-center">
                                No Canceled Invoices Found
                            </td>
                        </tr>
                    @endforelse

                </table>
            </div>
{{--        === table section code ends here===--}}

    </div>

</x-agency.layout>
