<x-agency.layout>
    @section('title')Edit Invoices @endsection

    <div class="w-full grid xl:grid-cols-5 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 mb-4">
        <!-- Add any additional headers if needed -->
    </div>

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        {{-- === Heading Section === --}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Edit Invoice</span>
        </div>

        {{-- === Form Section === --}}
        <div class="px-4 py-4">

            <form action="{{ route('allinvoices.updateinvoice', $invoice->id) }}" method="POST" class="space-y-6">
                @csrf

                {{-- Receiver (Bill To) Section --}}
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center mb-4">
                        <h3 class="text-lg font-semibold text-ternary">Receiver (Bill To)</h3>
                        <label class="ml-4 flex items-center">
                            <input type="checkbox" id="updateReceiver" onchange="toggleReceiverFields()" 
                                class="mr-2 rounded border-gray-300 text-primary focus:ring-primary">
                            <span class="text-sm text-ternary/80">Update invoice for Different Name</span>
                        </label>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div id="receiverNameField" class="hidden">
                            <label class="block font-semibold text-sm text-ternary/90 mb-1">Receiver Name <span class="text-red-500">*</span></label>
                            <input type="text" name="receiver_name" value="{{ old('receiver_name', $invoice->invoice->receiver_name ?? '') }}"
                                class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">
                        </div>
                        
                        <div id="receiverAddressField" class="hidden">
                            <label class="block font-semibold text-sm text-ternary/90 mb-1">Receiver Address <span class="text-red-500">*</span></label>
                            <textarea name="receiver_address" rows="3"
                                class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">{{ old('receiver_address', $invoice->invoice->address ?? $invoice->visaBooking->clint->permanent_address ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Service Details Section --}}
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-ternary mb-4">Service Details</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-sm text-ternary/90 mb-1">Name Of Visa Applicant <span class="text-red-500">*</span></label>
                            <input type="text" name="visa_applicant_name" value="{{ old('visa_applicant_name', $invoice->invoice->visa_applicant ?? $invoice->visaBooking->clint->client_name ?? '') }}"
                                class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm" disabled>
                        </div>
                        
                        <div>
    
                            <label class="block font-semibold text-sm text-ternary/90 mb-1">Passport Origin</label>
                            <input type="text" name="passport_origin" value="{{ old('passport_origin', $invoice->visaBooking->origin->countryName ?? 'N/A') }}"
                                class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm" disabled>
                        </div>
                        
                        
                        
                        <div>
                            <label class="block font-semibold text-sm text-ternary/90 mb-1">Visa Country</label>
                            <input type="text" name="visa_country" value="{{ old('visa_country', $invoice->visaBooking->destination->countryName ?? 'N/A') }}"
                                class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm" disabled>
                        </div>
                         
                         <div>
                            <label class="block font-semibold text-sm text-ternary/90 mb-1">Visa Name</label>
                            <input type="text" name="visa_type" value="{{ old('visa_type', $invoice->visaBooking->visa->name ?? 'N/A') }} "
                                class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm" disabled>
                        </div>

                        <div>
                            <label class="block font-semibold text-sm text-ternary/90 mb-1">Visa Sub Type</label>
                            <input type="text" name="visa_type" value="{{ old('visa_type', $invoice->visaBooking->visasubtype->name ?? 'N/A') }} "
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
                 
                    @php
                                /* ================= MEMBER COUNT ================= */

                                // Safe count of other members
                                $otherMemberCount = $invoice->visaBooking->otherMembersFromUserDB
                                    ? $invoice->visaBooking->otherMembersFromUserDB->count()
                                    : 0;
                              
                                // If otherclientid is NULL → include main applicant
                                if ($invoice->visaBooking->otherclientid === null) {
                                    $totalMember = 1 + $otherMemberCount;
                                } else {
                                    $totalMember = $otherMemberCount;
                                }

                                // Ensure at least 1 member (safety)
                                $totalMember = max(1, $totalMember);
                                

                                /* ================= PRICING ================= */

                                // Visa fee per person
                                $visaFeePerPerson = ($invoice->invoice->visa_fee > 0)
                                    ? $invoice->invoice->visa_fee/$totalMember
                                    : ($invoice->visaBooking->visasubtype->price ?? 0);
                                                              // Total visa fee for all members
                                $defaultVisaFee = $visaFeePerPerson * $totalMember;
 
                                $visaServiceChargePerPerson=($invoice->invoice?->service_charge > 0)
                                    ? $invoice->invoice->service_charge/$totalMember
                                    : ($invoice->visaBooking->visasubtype->commission ?? 0);
                                // Service charge (one time)
                                $defaultServiceCharge =$visaServiceChargePerPerson * $totalMember;

                                // VAT %
                                $defaultServiceVatCharge = $invoice->visaBooking->visasubtype->gstin ?? 0;

                                // VAT amount
                                $gstAmount = (($defaultVisaFee + $defaultServiceCharge) * $defaultServiceVatCharge) / 100;

                                // Final total (before discount if needed)
                                $finalTotal = $defaultVisaFee + $defaultServiceCharge + $gstAmount - ($invoice->invoice->discount ?? 0);
                            @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-sm text-ternary/90 mb-1">SubTotal (£)</label>
                            <input type="number" step="0.01" id="subtotal" value="{{ old('subtotal', $invoice->amount ?? 0) }}" readonly
                                class="w-full bg-gray-100 border border-secondary/40 rounded-md px-3 py-2 text-sm cursor-not-allowed">
                        </div>
                        
                        <div>
                            <label class="block font-semibold text-sm text-ternary/90 mb-1">Visa Fee (£)</label>
                            <input type="number" step="0.01" id="visa_fee" name="visa_fee" value="{{ old('visa_fee', $defaultVisaFee  ?? 0) }}" 
                                oninput="calculateTotal()" class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">
                        </div>
                        
                        <div>
                            <label class="block font-semibold text-sm text-ternary/90 mb-1">Service Charge (£)</label>
                            <input type="number" step="0.01" id="service_charge" name="service_charge" value="{{ old('service_charge', $defaultServiceCharge ?? 0) }}" 
                                oninput="calculateTotal()" class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">
                        </div>

                      
                        
                        <div>
                            <label class="block font-semibold text-sm text-ternary/90 mb-1">Discount (£)</label>
                            <input type="number" step="0.01" id="discount" name="discount" value="{{ old('discount', $invoice->invoice->discount ?? 0) }}" 
                                oninput="calculateTotal()" class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">
                        </div>
       
                            <div>
                            <label class="block font-semibold text-sm text-ternary/90 mb-1">VAT  (£)</label>
                            <input type="hidden" value="{{  $defaultServiceVatCharge  }}" id="gstpercentage"> 
                            <input type="number" step="0.01" id="gstAmount" readonly name="gstAmount" value="{{ old('service_charge', $gstAmount ?? 0) }}" 
                                oninput="calculateTotal()" class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">
                        </div>

                        <div>
                            <label class="block font-semibold text-sm text-ternary/90 mb-1">Total (£) <span class="text-red-500">*</span></label>
                            <input type="number" step="0.01" id="total" name="total" value="{{ old('total', $invoice->amount ?? 0) }}" 
                                class="w-full bg-gray-100 border border-secondary/40 rounded-md px-3 py-2 text-sm cursor-not-allowed">
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
            function toggleReceiverFields() {
                const checkbox = document.getElementById('updateReceiver');
                const receiverNameField = document.getElementById('receiverNameField');
                const receiverAddressField = document.getElementById('receiverAddressField');
                
                if (checkbox.checked) {
                    receiverNameField.classList.remove('hidden');
                    receiverAddressField.classList.remove('hidden');
                } else {
                    receiverNameField.classList.add('hidden');
                    receiverAddressField.classList.add('hidden');
                }
            }

            function calculateTotal() {
                const subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
                const visaFee = parseFloat(document.getElementById('visa_fee').value) || 0;
                const serviceCharge = parseFloat(document.getElementById('service_charge').value) || 0;
                const discount = parseFloat(document.getElementById('discount').value) || 0;
                const gstpercentage = parseFloat(document.getElementById('gstpercentage').value) || 0;
                const gstAmount = ((visaFee + serviceCharge) * gstpercentage) / 100;

                
             
                
                
                // const total = subtotal + visaFee + serviceCharge - discount;
                // const total =  visaFee + serviceCharge - discount;
                const total = visaFee + serviceCharge + gstAmount - discount;

                const finalTotal = Math.max(0, total);
                document.getElementById('gstAmount').value = gstAmount.toFixed(2);
                document.getElementById('total').value = finalTotal.toFixed(2);
            }

            // Calculate total on page load
            document.addEventListener('DOMContentLoaded', function() {
                calculateTotal();
            });
        </script>
    </div>
</x-agency.layout>
