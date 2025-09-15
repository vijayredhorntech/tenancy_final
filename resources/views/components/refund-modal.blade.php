<!-- Refund Invoice Modal -->
<div id="refundModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-3 border-b">
            <div class="flex items-center">
                <div class="bg-blue-100 p-2 rounded-full mr-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Refund Invoice</h3>
            </div>
            <button onclick="closeRefundModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <form id="refundForm" method="POST" action="{{ route('invoice.refund.process') }}">
            @csrf
            <input type="hidden" id="refund_invoice_id" name="invoice_id" value="">
            
            <div class="mt-6 space-y-6">
                <!-- Invoice Details Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="text-md font-semibold text-gray-700 mb-4">Invoice Details</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Invoice No</label>
                            <input type="text" id="refund_invoice_number" readonly 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Total Amount</label>
                            <input type="text" id="refund_total_amount" readonly 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                        </div>
                    </div>
                </div>

                <!-- Charges Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="text-md font-semibold text-gray-700 mb-4">Charges Breakdown</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">SAFI</label>
                            <input type="number" name="safi" id="refund_safi" value="0.00" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">ATOL</label>
                            <input type="number" name="atol" id="refund_atol" value="0.00" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Credit Charge 1%</label>
                            <input type="number" name="credit_charge" id="refund_credit_charge" value="0.00" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Service Charges</label>
                            <input type="number" name="service_charges" id="refund_service_charges" value="0.00" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Penalty Charges</label>
                            <input type="number" name="penalty_charges" id="refund_penalty_charges" value="0.00" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Admin Charges</label>
                            <input type="number" name="admin_charges" id="refund_admin_charges" value="0.00" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Other Miscellaneous Charges</label>
                            <input type="number" name="misc_charges" id="refund_misc_charges" value="0.00" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    
                    <!-- Calculate Button -->
                    <div class="mt-4">
                        <button type="button" onclick="calculateRefundAmount()" 
                                class="bg-teal-500 hover:bg-teal-600 text-white px-6 py-2 rounded-md font-medium transition duration-200">
                            Calculate Final Refund Amount
                        </button>
                    </div>
                </div>

                <!-- Refund Amount Section -->
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h4 class="text-md font-semibold text-gray-700 mb-4">Refund Amount</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Enter Amount To Refund</label>
                            <input type="number" name="refund_amount" id="refund_amount" step="0.01" min="0" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Calculated Amount</label>
                            <input type="text" id="calculated_amount" readonly 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                        </div>
                    </div>
                </div>

                <!-- Remarks Section -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Remarks</label>
                    <textarea name="remarks" id="refund_remarks" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Enter refund remarks..."></textarea>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end space-x-3 mt-6 pt-4 border-t">
                <button type="button" onclick="closeRefundModal()" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-200">
                    Cancel
                </button>
                <button type="submit" 
                        class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200">
                    Process Refund
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openRefundModal(invoiceId, invoiceNumber, totalAmount) {
    // Set invoice details
    document.getElementById('refund_invoice_id').value = invoiceId;
    document.getElementById('refund_invoice_number').value = invoiceNumber;
    document.getElementById('refund_total_amount').value = totalAmount;
    
    // Reset form
    document.getElementById('refundForm').reset();
    document.getElementById('refund_invoice_id').value = invoiceId;
    document.getElementById('refund_invoice_number').value = invoiceNumber;
    document.getElementById('refund_total_amount').value = totalAmount;
    
    // Show modal
    document.getElementById('refundModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeRefundModal() {
    document.getElementById('refundModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function calculateRefundAmount() {
    const totalAmount = parseFloat(document.getElementById('refund_total_amount').value) || 0;
    const safi = parseFloat(document.getElementById('refund_safi').value) || 0;
    const atol = parseFloat(document.getElementById('refund_atol').value) || 0;
    const creditCharge = parseFloat(document.getElementById('refund_credit_charge').value) || 0;
    const serviceCharges = parseFloat(document.getElementById('refund_service_charges').value) || 0;
    const penaltyCharges = parseFloat(document.getElementById('refund_penalty_charges').value) || 0;
    const adminCharges = parseFloat(document.getElementById('refund_admin_charges').value) || 0;
    const miscCharges = parseFloat(document.getElementById('refund_misc_charges').value) || 0;
    
    // Calculate total charges
    const totalCharges = safi + atol + creditCharge + serviceCharges + penaltyCharges + adminCharges + miscCharges;
    
    // Calculate refund amount (total - charges)
    const refundAmount = totalAmount - totalCharges;
    
    // Update calculated amount field
    document.getElementById('calculated_amount').value = refundAmount.toFixed(2);
    
    // Auto-fill refund amount field
    document.getElementById('refund_amount').value = refundAmount.toFixed(2);
}

// Close modal when clicking outside
document.getElementById('refundModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRefundModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeRefundModal();
    }
});
</script>
