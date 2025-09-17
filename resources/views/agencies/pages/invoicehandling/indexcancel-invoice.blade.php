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
                                    $paymentProcessedAmount = false;
                                    if ($invoice->invoice && $invoice->invoice->cancel_invoices) {
                                        // Check if any cancel_invoice record has type 'payment'
                                        $paymentProcessedAmount = $invoice->invoice->cancel_invoices->where('type', 'payment')->isNotEmpty();
                                    }
                                @endphp
                                @if($paymentProcessedAmount)
                                    £{{ number_format($refundAmount, 2) }}
                                @else
                                    £0.00
                                @endif
                            </td>

                            <!-- Refunded Status -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1">
                                @php
                                    // Check if payment has been processed for this refund
                                    $paymentProcessed = false;
                                    if ($invoice->invoice && $invoice->invoice->cancel_invoices) {
                                        // Check if any cancel_invoice record has type 'payment'
                                        $paymentProcessed = $invoice->invoice->cancel_invoices->where('type', 'payment')->isNotEmpty();
                                    }
                                @endphp
                                @if($paymentProcessed)
                                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-sm font-medium">
                                        Paid
                                    </span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded text-sm font-medium">
                                        Yet to Refund
                                    </span>
                                @endif
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
                                @php
                                    // Check if payment has been processed for this refund (reuse same logic)
                                    $paymentProcessedStatus = false;
                                    if ($invoice->invoice && $invoice->invoice->cancel_invoices) {
                                        // Check if any cancel_invoice record has type 'payment'
                                        $paymentProcessedStatus = $invoice->invoice->cancel_invoices->where('type', 'payment')->isNotEmpty();
                                    }
                                @endphp
                                @if($paymentProcessedStatus)
                                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-sm font-medium">
                                        Refunded
                                    </span>
                                @else
                                    <span class="bg-orange-100 text-orange-600 px-2 py-1 rounded text-sm font-medium">
                                        Pending Refund
                                    </span>
                                @endif
                            </td>

                            <!-- Action -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="relative inline-block">
                                    <!-- Action Dropdown Button -->
                                    <button onclick="toggleDropdown('action-{{ $invoice->id }}')" 
                                            class="bg-blue-100 text-blue-600 px-3 py-1 rounded-[3px] hover:bg-blue-200 text-xs flex items-center gap-1">
                                        Action
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    
                                    <!-- Dropdown Menu -->
                                    <div id="action-{{ $invoice->id }}" 
                                        class="absolute right-0 mt-1 w-32 bg-white rounded-[3px] shadow-lg border border-gray-200 z-50 hidden"
                                        style="display: none;">
                                        
                                        <!-- View Invoice Option -->
                                        <a href="{{ route('viewinvoice', $invoice->flight_booking_id) }}"
                                        class="flex justify-center items-center w-full px-3 py-2 text-xs text-white bg-cyan-500 hover:bg-cyan-600 rounded-t-[3px]">
                                            <i class="fa fa-eye mr-1"></i> View Invoice
                                        </a>
                                        
                                        @php
                                            $paymentProcessedAction = false;
                                            if ($invoice->invoice && $invoice->invoice->cancel_invoices) {
                                                // Check if any cancel_invoice record has type 'payment'
                                                $paymentProcessedAction = $invoice->invoice->cancel_invoices->where('type', 'payment')->isNotEmpty();
                                            }
                                        @endphp
                                        
                                        @if(!$paymentProcessedAction)
                                            <!-- Pay Option -->
                                            <button onclick="openPaymentModal('{{ $invoice->id }}', '{{ $invoice->invoice->new_invoice_number ?? $invoice->invoice_number }}', '{{ $invoice->amount ?? 0 }}', '{{ $invoice->invoice->cancel_invoice->safi ?? 0 }}', '{{ $invoice->invoice->cancel_invoice->atol ?? 0 }}', '{{ $invoice->invoice->cancel_invoice->credit_charge ?? 0 }}', '{{ $invoice->invoice->cancel_invoice->penalty ?? 0 }}', '{{ $invoice->invoice->cancel_invoice->admin ?? 0 }}', '{{ $invoice->invoice->cancel_invoice->misc ?? 0 }}')"
                                                    class="flex justify-center items-center w-full px-3 py-2 text-xs text-white bg-blue-500 hover:bg-blue-600">
                                                <i class="fa fa-credit-card mr-1"></i> Pay
                                            </button>
                                        @endif
                                        
                                        <!-- Adjustment Option -->
                                        <button onclick="openAdjustmentModal('{{ $invoice->id }}', '{{ $invoice->invoice->new_invoice_number ?? $invoice->invoice_number }}', '{{ $invoice->amount ?? 0 }}')"
                                                class="flex justify-center items-center w-full px-3 py-2 text-xs text-white  bg-purple-500 hover:bg-purple-600 rounded-b-[3px]">
                                            <i class="fa fa-adjust mr-1"></i> Adjustment
                                        </button>
                                    </div>
                                </div>
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

        <!-- Payment Modal -->
        <div id="paymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-3 border-b">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-2 rounded-full mr-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Process Refund Payment</h3>
                    </div>
                    <button onclick="closePaymentModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                    
                <!-- Modal Body -->
                <form id="paymentForm" method="POST" action="{{ route('invoice.refund.payment') }}">
                    @csrf
                    <input type="hidden" id="paymentInvoiceId" name="invoice_id" value="">
                    
                    <div class="mt-6 space-y-6">
                        <!-- Invoice Details Section -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-md font-semibold text-gray-700 mb-4">Invoice Details</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Invoice Number</label>
                                    <input type="text" id="paymentInvoiceNumber" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Paid Amount</label>
                                    <input type="text" id="paymentPaidAmount" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                                </div>
                            </div>
                        </div>

                        <!-- Charges Breakdown Section -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-md font-semibold text-gray-700 mb-4">Charges Breakdown</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">SAFI</label>
                                    <input type="text" id="paymentSafi" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">ATOL</label>
                                    <input type="text" id="paymentAtol" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Credit Charge</label>
                                    <input type="text" id="paymentCreditCharge" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Penalty Charges</label>
                                    <input type="text" id="paymentPenalty" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Admin Charges</label>
                                    <input type="text" id="paymentAdmin" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Miscellaneous</label>
                                    <input type="text" id="paymentMisc" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Total Charges</label>
                                    <input type="text" id="paymentTotalCharges" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Final Refund Amount</label>
                                    <input type="text" id="paymentFinalAmount" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-green-100 text-green-600 font-semibold">
                                </div>
                            </div>
                        </div>

                        <!-- Payment Methods Section -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="text-md font-semibold text-gray-700 mb-4">Payment Methods</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Paid</label>
                                    <input type="text" id="paymentPaidDisplay" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Pending Amount</label>
                                    <input type="text" id="paymentPendingAmount" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-red-100 text-red-600 font-semibold">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Card Last 4 Digit</label>
                                    <input type="text" name="card_last_4_digit" maxlength="4" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                           placeholder="Enter last 4 digits">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Credit Card</label>
                                    <input type="number" name="credit_card_amount" step="0.01" min="0" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                           placeholder="0.00">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Debit Card</label>
                                    <input type="number" name="debit_card_amount" step="0.01" min="0" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                           placeholder="0.00">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Cash</label>
                                    <input type="number" name="cash_amount" step="0.01" min="0" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                           placeholder="0.00">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Bank Transfer</label>
                                    <input type="number" name="bank_transfer_amount" step="0.01" min="0" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                           placeholder="0.00">
                                </div>
                            </div>
                        </div>

                        <!-- Remarks Section -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Remarks <span class="text-red-500">*</span></label>
                            <textarea name="remarks" rows="3" required 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Enter payment remarks..."></textarea>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end space-x-3 mt-6 pt-4 border-t">
                        <button type="button" onclick="closePaymentModal()" 
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-200">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200">
                            Direct Refund
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Adjustment Modal -->
        <div id="adjustmentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
            <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 shadow-lg rounded-md bg-white">
                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-3 border-b">
                    <div class="flex items-center">
                        <div class="bg-orange-100 p-2 rounded-full mr-3">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">Invoice Adjustments</h3>
                    </div>
                    <button onclick="closeAdjustmentModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                    
                <!-- Modal Body -->
                <form id="adjustmentForm" method="POST" action="{{ route('invoice.adjustment') }}">
                    @csrf
                    <input type="hidden" id="adjustmentInvoiceId" name="invoice_id" value="">
                    
                    <div class="mt-6 space-y-6">
                        <!-- Current Invoice Section -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-700 mb-4">Current Invoice Details</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Invoice Number</label>
                                    <input type="text" id="adjustmentCurrentInvoiceNumber" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Amount</label>
                                    <input type="text" id="adjustmentCurrentAmount" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <input type="text" value="Pending Adjustment" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-orange-100 text-orange-600">
                                </div>
                            </div>
                        </div>

                        <!-- All Retail Invoices Section -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-700 mb-4">All Retail Invoices</h4>
                            <div class="overflow-x-auto">
                                <table class="w-full border border-gray-300 border-collapse">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th class="border border-gray-300 px-3 py-2 text-left text-xs font-medium text-gray-700">Invoice No.</th>
                                            <th class="border border-gray-300 px-3 py-2 text-left text-xs font-medium text-gray-700">Date</th>
                                            <th class="border border-gray-300 px-3 py-2 text-left text-xs font-medium text-gray-700">Receiver</th>
                                            <th class="border border-gray-300 px-3 py-2 text-left text-xs font-medium text-gray-700">Total</th>
                                            <th class="border border-gray-300 px-3 py-2 text-left text-xs font-medium text-gray-700">Paid</th>
                                            <th class="border border-gray-300 px-3 py-2 text-left text-xs font-medium text-gray-700">Select</th>
                                        </tr>
                                    </thead>
                                    <tbody id="adjustmentInvoicesTable">
                                        @forelse($retailInvoices ?? [] as $adjInvoice)
                                        <tr class="hover:bg-gray-100">
                                            <td class="border border-gray-300 px-3 py-2 text-xs">
                                                @if($adjInvoice->invoice && $adjInvoice->invoice->new_invoice_number)
                                                    {{ $adjInvoice->invoice->new_invoice_number }}
                                                @else
                                                    {{ $adjInvoice->invoice_number ?? 'N/A' }}
                                                @endif
                                            </td>
                                            <td class="border border-gray-300 px-3 py-2 text-xs">
                                                {{ $adjInvoice->created_at ? $adjInvoice->created_at->format('Y-m-d') : 'N/A' }}
                                            </td>
                                            <td class="border border-gray-300 px-3 py-2 text-xs">
                                                {{ $adjInvoice->visaBooking->clientDetailsFromUserDB->client_name ?? $adjInvoice->visaBooking->clint->client_name ?? 'N/A' }}
                                            </td>
                                            <td class="border border-gray-300 px-3 py-2 text-xs">
                                                £{{ number_format($adjInvoice->invoice->total_amount ?? $adjInvoice->amount ?? 0, 2) }}
                                            </td>
                                            <td class="border border-gray-300 px-3 py-2 text-xs">
                                                £{{ number_format($adjInvoice->amount ?? 0, 2) }}
                                            </td>
                                            <td class="border border-gray-300 px-3 py-2 text-center">
                                                <input type="checkbox" name="selected_invoices[]" value="{{ $adjInvoice->id }}" 
                                                       class="w-4 h-4 text-orange-600 bg-gray-100 border-gray-300 rounded focus:ring-orange-500">
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="border border-gray-300 px-3 py-2 text-center text-xs text-gray-500">No retail invoices available</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Additional Information Section -->
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-700 mb-4">Additional Information</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Processed By</label>
                                    <input type="text" name="processed_by" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500" 
                                           placeholder="Staff member name">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Internal Notes</label>
                                    <textarea name="internal_notes" rows="2" 
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                              placeholder="Internal notes for record keeping..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end space-x-3 mt-6 pt-4 border-t">
                        <button type="button" onclick="closeAdjustmentModal()" 
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-200">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-6 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600 transition duration-200">
                            Process Adjustment
                        </button>
                    </div>
                </form>
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

            // Payment Modal Functions
            function openPaymentModal(invoiceId, invoiceNumber, paidAmount, safi, atol, creditCharge, penalty, admin, misc) {
                document.getElementById('paymentModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                
                // Parse the amounts
                const paid = parseFloat(paidAmount) || 0;
                const safiCharge = parseFloat(safi) || 0;
                const atolCharge = parseFloat(atol) || 0;
                const creditChargeAmount = parseFloat(creditCharge) || 0;
                const penaltyCharge = parseFloat(penalty) || 0;
                const adminCharge = parseFloat(admin) || 0;
                const miscCharge = parseFloat(misc) || 0;
                
                // Calculate totals
                const totalChargesAmount = safiCharge + atolCharge + creditChargeAmount + penaltyCharge + adminCharge + miscCharge;
                const refundAmount = paid - totalChargesAmount;
                
                // Update the payment modal with values
                document.getElementById('paymentInvoiceId').value = invoiceId;
                document.getElementById('paymentInvoiceNumber').value = invoiceNumber;
                document.getElementById('paymentPaidAmount').value = '£' + paid.toFixed(2);
                
                // Update payment methods section
                document.getElementById('paymentPaidDisplay').value = '£0.00';
                document.getElementById('paymentPendingAmount').value = '£' + refundAmount.toFixed(2);
                
                // Update breakdown
                document.getElementById('paymentSafi').value = '£' + safiCharge.toFixed(2);
                document.getElementById('paymentAtol').value = '£' + atolCharge.toFixed(2);
                document.getElementById('paymentCreditCharge').value = '£' + creditChargeAmount.toFixed(2);
                document.getElementById('paymentPenalty').value = '£' + penaltyCharge.toFixed(2);
                document.getElementById('paymentAdmin').value = '£' + adminCharge.toFixed(2);
                document.getElementById('paymentMisc').value = '£' + miscCharge.toFixed(2);
                document.getElementById('paymentTotalCharges').value = '£' + totalChargesAmount.toFixed(2);
                document.getElementById('paymentFinalAmount').value = '£' + refundAmount.toFixed(2);
                
                console.log('Opening payment modal for invoice:', invoiceId, invoiceNumber, 'Refund Amount:', refundAmount);
            }

            function closePaymentModal() {
                document.getElementById('paymentModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
                // Reset form
                document.getElementById('paymentForm').reset();
            }

            // Close payment modal when clicking outside
            document.getElementById('paymentModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closePaymentModal();
                }
            });

            // Close payment modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !document.getElementById('paymentModal').classList.contains('hidden')) {
                    closePaymentModal();
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

            // Dropdown Functions
            function toggleDropdown(dropdownId) {
                // Close all other dropdowns first
                const allDropdowns = document.querySelectorAll('[id^="action-"]');
                allDropdowns.forEach(dropdown => {
                    if (dropdown.id !== dropdownId) {
                        dropdown.classList.add('hidden');
                        dropdown.style.display = 'none';
                    }
                });
                
                // Toggle the clicked dropdown
                const dropdown = document.getElementById(dropdownId);
                if (dropdown) {
                    dropdown.classList.toggle('hidden');
                    
                    // Ensure dropdown is visible and positioned correctly
                    if (!dropdown.classList.contains('hidden')) {
                        dropdown.style.display = 'block';
                        dropdown.style.position = 'absolute';
                        dropdown.style.zIndex = '50';
                    } else {
                        dropdown.style.display = 'none';
                    }
                }
            }

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(event) {
                const allDropdowns = document.querySelectorAll('[id^="action-"]');
                allDropdowns.forEach(dropdown => {
                    const button = dropdown.previousElementSibling;
                    if (!dropdown.contains(event.target) && 
                        !event.target.closest('button[onclick*="toggleDropdown"]') &&
                        !button.contains(event.target)) {
                        dropdown.classList.add('hidden');
                        dropdown.style.display = 'none';
                    }
                });
            });

            // Ensure dropdowns are properly initialized
            document.addEventListener('DOMContentLoaded', function() {
                const allDropdowns = document.querySelectorAll('[id^="action-"]');
                allDropdowns.forEach(dropdown => {
                    dropdown.style.display = 'none';
                });
            });

            // Adjustment Modal Functions
            function openAdjustmentModal(invoiceId, invoiceNumber, amount) {
                document.getElementById('adjustmentModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                
                // Parse the amounts
                const currentAmount = parseFloat(amount) || 0;
                
                // Update the adjustment modal with values
                document.getElementById('adjustmentInvoiceId').value = invoiceId;
                document.getElementById('adjustmentCurrentInvoiceNumber').value = invoiceNumber;
                document.getElementById('adjustmentCurrentAmount').value = '£' + currentAmount.toFixed(2);
                
                console.log('Opening adjustment modal for invoice:', invoiceId, invoiceNumber, 'Amount:', currentAmount);
            }

            function closeAdjustmentModal() {
                document.getElementById('adjustmentModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
                // Reset form
                document.getElementById('adjustmentForm').reset();
            }

            // Close adjustment modal when clicking outside
            document.getElementById('adjustmentModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeAdjustmentModal();
                }
            });

            // Close adjustment modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !document.getElementById('adjustmentModal').classList.contains('hidden')) {
                    closeAdjustmentModal();
                }
            });
        </script>
</x-agency.layout>
