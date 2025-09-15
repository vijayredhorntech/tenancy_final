<x-agency.layout>
    @section('title')Staff @endsection
    <div class="w-full grid xl:grid-cols-5 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 mb-4">

    </div>

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl"> Refund Invoice</span>
            </div>
{{--        === heading section code ends here===--}}

{{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
                     <!-- search function  -->
         
            
            

              <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice No.</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice Date</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Receiver Name</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Total</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Paid</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Total Refunded Amount</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Refunded Status</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Refund Details</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Status</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>
                    </tr>

                    @forelse($invoices as $invoice)
      
               
                        <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-200">
                            <!-- Invoice No. -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                @if($invoice->invoice && $invoice->invoice->new_invoice_number)
                                    {{ $invoice->invoice->new_invoice_number }}
                                @else
                                    {{ $invoice->invoice_number ?? 'N/A' }}
                                @endif
                            </td>

                            <!-- Invoice Date -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                {{ $invoice->created_at ? $invoice->created_at->format('Y-m-d') : 'N/A' }}
                            </td>

                            <!-- Receiver Name -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm uppercase">
                                {{ $invoice->visaBooking->clientDetailsFromUserDB->client_name ?? 'N/A' }}
                            </td>


                            <!-- Total -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                £{{ number_format($invoice->invoice->total_amount ?? 0, 2) }}
                            </td>

                            <!-- Paid -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                £{{ number_format($invoice->amount ?? 0, 2) }}
                            </td>

                            <!-- Total Refunded Amount (Paid - Charges) -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                @php
                                    $paidAmount = $invoice->amount ?? 0; // Original amount from Deduction
                                    $totalCharges = ($invoice->invoice->cancel_invoice->safi ?? 0) + 
                                                   ($invoice->invoice->cancel_invoice->atol ?? 0) + 
                                                   ($invoice->invoice->cancel_invoice->credit_charge ?? 0) + 
                                                   ($invoice->invoice->cancel_invoice->penalty ?? 0) + 
                                                   ($invoice->invoice->cancel_invoice->admin ?? 0) + 
                                                   ($invoice->invoice->cancel_invoice->misc ?? 0);
                                    $refundAmount = $paidAmount - $totalCharges;
                                @endphp
                                £{{ number_format($refundAmount, 2) }}
                            </td>

                            <!-- Refunded Status -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1">
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-sm font-medium">
                                    Paid
                                </span>
                            </td>

                            <!-- Refund Details -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                <button onclick="openRefundDetailsModal('{{ $invoice->id }}', '{{ $invoice->invoice->new_invoice_number ?? $invoice->invoice_number }}', '{{ $invoice->amount ?? 0 }}', '{{ $invoice->invoice->cancel_invoice->safi ?? 0 }}', '{{ $invoice->invoice->cancel_invoice->atol ?? 0 }}', '{{ $invoice->invoice->cancel_invoice->credit_charge ?? 0 }}', '{{ $invoice->invoice->cancel_invoice->penalty ?? 0 }}', '{{ $invoice->invoice->cancel_invoice->admin ?? 0 }}', '{{ $invoice->invoice->cancel_invoice->misc ?? 0 }}')" 
                                        class="bg-blue-500 text-white px-3 py-1 rounded text-sm font-medium hover:bg-blue-600 transition ease-in duration-200">
                                    View Now
                                </button>
                            </td>

                            <!-- Status -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1">
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-sm font-medium">
                                    Refunded
                                </span>
                            </td>

                            <!-- Action -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                <a href="{{ route('viewinvoice', $invoice->flight_booking_id) }}"
                                    title="View"
                                    class="inline-flex items-center gap-1 bg-success/10 text-success px-2 py-1 rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-200">
                                    <i class="fa fa-eye"></i> View Invoice
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm text-center">No Record Found</td>
                        </tr>
                    @endforelse
            </table>

                            <br>
                 
            </div>
{{--        === table section code ends here===--}}

        </div>

        <!-- Refund Details Modal -->
        <div id="refundDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                    <!-- Modal Header -->
                    <div class="bg-blue-500 text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
                        <h3 class="text-lg font-semibold">Refund Charges</h3>
                        <button onclick="closeRefundDetailsModal()" class="text-white hover:text-gray-200 text-xl font-bold">
                            ×
                        </button>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b">
                                <span class="font-medium">SAFI</span>
                                <span class="font-bold" id="safiCharge">£0.00</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b">
                                <span class="font-medium">ATOL</span>
                                <span class="font-bold" id="atolCharge">£0.00</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b">
                                <span class="font-medium">CreditCharge</span>
                                <span class="font-bold" id="creditCharge">£0.00</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b">
                                <span class="font-medium">ServiceCharges</span>
                                <span class="font-bold" id="serviceCharge">£0.00</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b">
                                <span class="font-medium">PenalityCharges</span>
                                <span class="font-bold" id="penaltyCharge">£0.00</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b">
                                <span class="font-medium">AdminCharges</span>
                                <span class="font-bold" id="adminCharge">£0.00</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b">
                                <span class="font-medium">MiscellaneousCharges</span>
                                <span class="font-bold" id="miscCharge">£0.00</span>
                            </div>
                        </div>
                        
                        <!-- Total Charges and Refund Amount -->
                        <div class="mt-4 pt-4 border-t-2 border-gray-200">
                            <div class="flex justify-between items-center py-2">
                                <span class="font-semibold text-lg">Total Charges:</span>
                                <span class="font-bold text-lg" id="totalCharges">£0.00</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="font-semibold text-lg">Paid Amount:</span>
                                <span class="font-bold text-lg" id="paidAmount">£0.00</span>
                            </div>
                            <div class="flex justify-between items-center py-2 bg-green-50 px-3 py-2 rounded">
                                <span class="font-bold text-lg text-green-700">Refund Amount:</span>
                                <span class="font-bold text-lg text-green-700" id="refundAmount">£0.00</span>
                            </div>
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="mt-6 flex justify-end">
                            <button onclick="closeRefundDetailsModal()" 
                                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition ease-in duration-200">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Refund Details Modal Functions
            function openRefundDetailsModal(invoiceId, invoiceNumber, paidAmount, safi, atol, creditCharge, penalty, admin, misc) {
                document.getElementById('refundDetailsModal').classList.remove('hidden');
                
                // Parse the amounts
                const paid = parseFloat(paidAmount) || 0;
                const safiCharge = parseFloat(safi) || 0;
                const atolCharge = parseFloat(atol) || 0;
                const creditChargeAmount = parseFloat(creditCharge) || 0;
                const penaltyCharge = parseFloat(penalty) || 0;
                const adminCharge = parseFloat(admin) || 0;
                const miscCharge = parseFloat(misc) || 0;
                
                // Update the modal with actual charge values
                document.getElementById('safiCharge').textContent = '£' + safiCharge.toFixed(2);
                document.getElementById('atolCharge').textContent = '£' + atolCharge.toFixed(2);
                document.getElementById('creditCharge').textContent = '£' + creditChargeAmount.toFixed(2);
                document.getElementById('serviceCharge').textContent = '£0.00'; // Service charges not stored separately
                document.getElementById('penaltyCharge').textContent = '£' + penaltyCharge.toFixed(2);
                document.getElementById('adminCharge').textContent = '£' + adminCharge.toFixed(2);
                document.getElementById('miscCharge').textContent = '£' + miscCharge.toFixed(2);
                
                // Calculate totals
                const totalChargesAmount = safiCharge + atolCharge + creditChargeAmount + penaltyCharge + adminCharge + miscCharge;
                const refundAmount = paid - totalChargesAmount;
                
                // Update totals in modal
                document.getElementById('totalCharges').textContent = '£' + totalChargesAmount.toFixed(2);
                document.getElementById('paidAmount').textContent = '£' + paid.toFixed(2);
                document.getElementById('refundAmount').textContent = '£' + refundAmount.toFixed(2);
                
                console.log('Opening refund details for invoice:', invoiceId, invoiceNumber, 'Paid:', paid, 'Total Charges:', totalChargesAmount, 'Refund:', refundAmount);
            }

            function closeRefundDetailsModal() {
                document.getElementById('refundDetailsModal').classList.add('hidden');
            }

            // Close modal when clicking outside
            document.getElementById('refundDetailsModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeRefundDetailsModal();
                }
            });

            // Date input validation
            document.querySelectorAll('input[type="date"]').forEach(function(input) {
                input.addEventListener('input', function () {
                    const value = this.value;
                    const year = value.split('-')[0];

                    if (year.length > 4) {
                        alert('Year must be exactly 4 digits.');
                        this.value = '';
                    }
                });
            });
        </script>
</x-agency.layout>
