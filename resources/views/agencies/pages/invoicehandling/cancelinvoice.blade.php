<x-agency.layout>
    @section('title')Edit Invoices @endsection

    <div class="w-full grid xl:grid-cols-5 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 mb-4">
        <!-- Add any additional headers if needed -->
    </div>

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        {{-- === Heading Section === --}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Cancel Invoice</span>
        </div>

        {{-- === Form Section === --}}
        <div class="px-4 py-4">


            <form action="{{ route('cancelinvoices.update') }}" method="POST" class="space-y-6">
    @csrf

    {{-- Service Details Section --}}
    <div class="bg-gray-50 p-4 rounded-lg">
        <h3 class="text-lg font-semibold text-ternary mb-4">Service Details</h3>
        @php 
            // $invoiceNumber = $invoice->invoice->invoice_number;
            // if($invoice->invoice->status=='edited'){
            //     $invoiceNumber = $invoice->invoice->new_invoice_number;
            //     $amount=$invoice->invoice->new_price;
            // }else{
            //     $invoiceNumber = $invoice->invoice_number;
            //     $amount=$invoice->amount;
            // }
              if ($invoice->invoice) {
                        $invoiceNumber = $invoice->invoice->status === 'edited'
                            ? $invoice->invoice->new_invoice_number
                            : $invoice->invoice->invoice_number;

                        $amount = $invoice->invoice->status === 'edited'
                            ? $invoice->invoice->new_price
                            : $invoice->amount ?? 0;
                    } else {
                        // Fallback if invoice relation is missing
                        $invoiceNumber = $invoice->invoice_number ?? 'N/A';
                        $amount = $invoice->amount ?? 0;
                    }
        @endphp

 
        <input type="hidden" name="application_id" value="{{ $invoice->id }}">
        <input type="hidden" name="invoice_id" value="{{ $invoice->invoice->id }}">
        <input type="hidden" name="application_number" value="{{ $invoiceNumber }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-sm text-ternary/90 mb-1">Invoice Number<span class="text-red-500">*</span></label>
                <input type="text" name="visa_applicant_name" value="{{ $invoiceNumber }}"
                    class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm" disabled>
            </div>

            <div>
                <label class="block font-semibold text-sm text-ternary/90 mb-1">Total Amount<span class="text-red-500">*</span></label>
                <input type="number" name="visa_applicant_name" value="{{ $amount }}"
                    class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm" disabled>
            </div>
        </div>
    </div>

    {{-- Payment Methods Section --}}
    <div class="bg-gray-50 p-4 rounded-lg">
        <h3 class="text-lg font-semibold text-ternary mb-4">Payment Methods</h3>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <label class="flex items-center">
                <input type="radio" name="payment_mode" value="CREDIT CARD" 
                    {{ old('payment_mode', $invoice->invoice->payment_type ?? 'CASH') == 'CREDIT CARD' ? 'checked' : '' }}
                    class="mr-2 text-primary focus:ring-primary">
                <span class="text-sm text-ternary/80">Credit Card</span>
            </label>
            
            <label class="flex items-center">
                <input type="radio" name="payment_mode" value="DEBIT CARD" 
                    {{ old('payment_mode', $invoice->invoice->payment_type ?? 'CASH') == 'DEBIT CARD' ? 'checked' : '' }}
                    class="mr-2 text-primary focus:ring-primary">
                <span class="text-sm text-ternary/80">Debit Card</span>
            </label>
            
            <label class="flex items-center">
                <input type="radio" name="payment_mode" value="CASH" 
                    {{ old('payment_mode', $invoice->invoice->payment_type ?? 'CASH') == 'CASH' ? 'checked' : '' }}
                    class="mr-2 text-primary focus:ring-primary">
                <span class="text-sm text-ternary/80">Cash</span>
            </label>
            
            <label class="flex items-center">
                <input type="radio" name="payment_mode" value="BANK TRANSFER" 
                    {{ old('payment_mode', $invoice->invoice->payment_type ?? 'CASH') == 'BANK TRANSFER' ? 'checked' : '' }}
                    class="mr-2 text-primary focus:ring-primary">
                <span class="text-sm text-ternary/80">Bank Transfer</span>
            </label>
        </div>
    </div>

    {{-- Summary Section --}}
    <div class="bg-gray-50 p-4 rounded-lg">
        <h3 class="text-lg font-semibold text-ternary mb-4">Summary</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Subtotal -->
            <div>
                <label class="block font-semibold text-sm text-ternary/90 mb-1">Subtotal (£)</label>
                <input type="number" step="0.01" id="subtotal" value="{{ $amount }}" readonly
                    class="w-full bg-gray-100 border border-secondary/40 rounded-md px-3 py-2 text-sm cursor-not-allowed">
            </div>

            <!-- SAFI -->
            <div>
                <label class="block font-semibold text-sm text-ternary/90 mb-1">SAFI (£)</label>
                <input type="number" step="0.01" id="safi" name="safi" 
                    value="{{ old('safi', $invoice->invoice->visa_fee ?? 0) }}"
                    oninput="calculateTotal()" 
                    class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">
            </div>

            <!-- ATOL -->
            <div>
                <label class="block font-semibold text-sm text-ternary/90 mb-1">ATOL (£)</label>
                <input type="number" step="0.01" id="atol" name="atol" 
                    value="{{ old('atol', $invoice->invoice->service_charge ?? 0) }}"
                    oninput="calculateTotal()" 
                    class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">
            </div>

            <!-- Credit Charge -->
            <div>
                <label class="block font-semibold text-sm text-ternary/90 mb-1">Credit Charge (£)</label>
                <input type="number" step="0.01" id="credit_charge" name="credit_charge"
                    value="{{ old('credit_charge', $invoice->invoice->discount ?? 0) }}"
                    oninput="calculateTotal()" 
                    class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">
            </div>

            <!-- Penalty Charges -->
            <div>
                <label class="block font-semibold text-sm text-ternary/90 mb-1">Penalty Charges (£)</label>
                <input type="number" step="0.01" id="penalty" name="penalty"
                    value="{{ old('penalty', $invoice->invoice->penalty ?? 0) }}"
                    oninput="calculateTotal()" 
                    class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">
            </div>

            <!-- Admin Charges -->
            <div>
                <label class="block font-semibold text-sm text-ternary/90 mb-1">Admin Charges (£)</label>
                <input type="number" step="0.01" id="admin" name="admin"
                    value="{{ old('admin', $invoice->invoice->admin ?? 0) }}"
                    oninput="calculateTotal()" 
                    class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">
            </div>

            <!-- Miscellaneous Charges -->
            <div>
                <label class="block font-semibold text-sm text-ternary/90 mb-1">Miscellaneous Charges (£)</label>
                <input type="number" step="0.01" id="misc" name="misc"
                    value="{{ old('misc', $invoice->invoice->misc ?? 0) }}"
                    oninput="calculateTotal()" 
                    class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">
            </div>

            <!-- Final Total -->
            <div>
                <label class="block font-semibold text-sm text-ternary/90 mb-1">Total (£) <span class="text-red-500">*</span></label>
                <input type="number" step="0.01" id="total" name="total" value="{{ old('total', $invoice->amount ?? 0) }}" readonly
                    class="w-full bg-gray-100 border border-secondary/40 rounded-md px-3 py-2 text-sm cursor-not-allowed">
            </div>
        </div>
    </div>

    {{-- Remark and Reason --}}
    <div class="bg-gray-50 p-4 rounded-lg">
        <h3 class="text-lg font-semibold text-ternary mb-4">Additional Info</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-sm text-ternary/90 mb-1">Remark</label>
                <textarea name="remark" rows="3"
                    class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">{{ old('remark', $invoice->invoice->remark ?? '') }}</textarea>
            </div>

            <div>
                <label class="block font-semibold text-sm text-ternary/90 mb-1">Reason</label>
                <textarea name="reason" rows="3"
                    class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">{{ old('reason', $invoice->invoice->reason ?? '') }}</textarea>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex justify-end gap-2 pt-4">
        <a href="{{ route('invoice.all', ['type' => 'agencies']) }}"
           class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 text-sm">
            Cancel
        </a>
        <button type="submit"
                class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primaryDark text-sm">
            Update Invoice
        </button>
    </div>
</form>

        </div>

     <script>
function calculateTotal() {
    let subtotal = parseFloat(document.getElementById("subtotal").value) || 0;
    let safi = parseFloat(document.getElementById("safi").value) || 0;
    let atol = parseFloat(document.getElementById("atol").value) || 0;
    let creditCharge = parseFloat(document.getElementById("credit_charge").value) || 0;
    let penalty = parseFloat(document.getElementById("penalty").value) || 0;
    let admin = parseFloat(document.getElementById("admin").value) || 0;
    let misc = parseFloat(document.getElementById("misc").value) || 0;

    // Deduct all charges
    let total = subtotal - (safi + atol + creditCharge + penalty + admin + misc);

    document.getElementById("total").value = total.toFixed(2);
}
</script>

    </div>
</x-agency.layout>