<!-- Pay Invoice Modal -->
<div id="payModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 shadow-lg rounded-md bg-white">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-3 border-b">
            <div class="flex items-center">
                <div class="bg-blue-100 p-2 rounded-full mr-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Pay Invoice</h3>
            </div>
            <button onclick="closePayModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <form id="payForm" method="POST" action="{{ route('invoice.pay.process') }}">
            @csrf
            <input type="hidden" id="pay_invoice_id" name="invoice_id" value="">
            
            <div class="mt-6 space-y-6">
                <!-- Invoice Details Section -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Receiver Details -->
                        <div>
                            <h4 class="text-md font-semibold text-gray-700 mb-4">To, RECEIVER (BILL TO)</h4>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Receiver Name</label>
                                    <input type="text" id="pay_receiver_name" name="receiver_name" readonly
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <textarea id="pay_receiver_address" name="receiver_address" readonly rows="3"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600 resize-none"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Invoice Info -->
                        <div>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Invoice Number</label>
                                    <input type="text" id="pay_invoice_number" readonly
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-blue-50 text-blue-700 font-semibold">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Invoice Date</label>
                                    <input type="text" id="pay_invoice_date" readonly
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-blue-50 text-blue-700 font-semibold">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Financial Summary Section -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h4 class="text-md font-semibold text-gray-700 mb-4">Financial Summary</h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <label class="text-sm font-medium text-gray-700">SubTotal:</label>
                            <input type="text" id="pay_subtotal" readonly
                                   class="w-32 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600 text-right">
                        </div>
                        <div class="flex justify-between items-center">
                            <label class="text-sm font-medium text-gray-700">Discount:</label>
                            <input type="text" id="pay_discount" readonly
                                   class="w-32 px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600 text-right">
                        </div>
                        <div class="flex justify-between items-center">
                            <label class="text-sm font-medium text-gray-700">Total:</label>
                            <input type="text" id="pay_total" readonly
                                   class="w-32 px-3 py-2 border border-blue-300 rounded-md bg-blue-50 text-blue-700 font-semibold text-right">
                        </div>
                    </div>
                </div>

                <!-- Payment Methods Section -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-md font-semibold text-gray-700">Payment Methods</h4>
                        <div class="text-sm">
                            <span class="text-green-600 font-medium">Paid: £ <span id="pay_paid_amount">0</span></span>
                            <span class="text-red-600 font-medium ml-4">Pending Amount: £ <span id="pay_pending_amount">0</span></span>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <label class="text-sm font-medium text-gray-700">Card Last 4 Digit:</label>
                            <input type="text" name="card_last_4_digit" id="pay_card_last_4" maxlength="4"
                                   class="w-32 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="1234">
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input type="checkbox" name="payment_methods[]" value="credit_card" id="pay_credit_card"
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="pay_credit_card" class="ml-2 text-sm font-medium text-gray-700">Credit card:</label>
                                <input type="number" name="credit_card_amount" step="0.01" min="0"
                                       class="ml-4 w-32 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="0.00" disabled>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" name="payment_methods[]" value="debit_card" id="pay_debit_card"
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="pay_debit_card" class="ml-2 text-sm font-medium text-gray-700">Debit card:</label>
                                <input type="number" name="debit_card_amount" step="0.01" min="0"
                                       class="ml-4 w-32 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="0.00" disabled>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" name="payment_methods[]" value="cash" id="pay_cash"
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="pay_cash" class="ml-2 text-sm font-medium text-gray-700">Cash:</label>
                                <input type="number" name="cash_amount" step="0.01" min="0"
                                       class="ml-4 w-32 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="0.00" disabled>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" name="payment_methods[]" value="bank_transfer" id="pay_bank_transfer"
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="pay_bank_transfer" class="ml-2 text-sm font-medium text-gray-700">Bank Transfer:</label>
                                <input type="number" name="bank_transfer_amount" step="0.01" min="0"
                                       class="ml-4 w-32 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="0.00" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-center mt-8 pt-4 border-t">
                <button type="submit" 
                        class="px-8 py-3 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200 font-medium text-lg">
                    Pay
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openPayModal(invoiceId, invoiceNumber, totalAmount, receiverName, receiverAddress) {
    // Set invoice details
    document.getElementById('pay_invoice_id').value = invoiceId;
    document.getElementById('pay_invoice_number').value = invoiceNumber;
    document.getElementById('pay_receiver_name').value = receiverName;
    document.getElementById('pay_receiver_address').value = receiverAddress;
    
    // Set financial details
    document.getElementById('pay_subtotal').value = '£ ' + totalAmount;
    document.getElementById('pay_discount').value = '£ 0.00';
    document.getElementById('pay_total').value = '£ ' + parseFloat(totalAmount).toFixed(2);
    
    // Set payment status
    document.getElementById('pay_paid_amount').textContent = '0';
    document.getElementById('pay_pending_amount').textContent = parseFloat(totalAmount).toFixed(2);
    
    // Set current date
    const today = new Date();
    const formattedDate = today.toLocaleDateString('en-GB');
    document.getElementById('pay_invoice_date').value = formattedDate;
    
    // Reset form
    document.getElementById('payForm').reset();
    document.getElementById('pay_invoice_id').value = invoiceId;
    document.getElementById('pay_invoice_number').value = invoiceNumber;
    document.getElementById('pay_receiver_name').value = receiverName;
    document.getElementById('pay_receiver_address').value = receiverAddress;
    document.getElementById('pay_subtotal').value = '£ ' + totalAmount;
    document.getElementById('pay_discount').value = '£ 0.00';
    document.getElementById('pay_total').value = '£ ' + parseFloat(totalAmount).toFixed(2);
    document.getElementById('pay_invoice_date').value = formattedDate;
    document.getElementById('pay_paid_amount').textContent = '0';
    document.getElementById('pay_pending_amount').textContent = parseFloat(totalAmount).toFixed(2);
    
    // Show modal
    document.getElementById('payModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closePayModal() {
    document.getElementById('payModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Enable/disable amount inputs based on checkbox selection
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="payment_methods[]"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const amountInput = this.parentElement.querySelector('input[type="number"]');
            if (this.checked) {
                amountInput.disabled = false;
                amountInput.required = true;
            } else {
                amountInput.disabled = true;
                amountInput.required = false;
                amountInput.value = '';
            }
        });
    });
});

// Close modal when clicking outside
document.getElementById('payModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePayModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePayModal();
    }
});
</script>
