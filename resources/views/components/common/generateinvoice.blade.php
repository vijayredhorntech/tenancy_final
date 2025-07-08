<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
    <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
        <span class="font-semibold text-ternary text-xl">Generate Inovice</span>
    </div>


    <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20">
        <form action="{{ route('generateinvoice') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">
                {{-- Visa Information Section --}}

                {{-- Original Form Fields --}}
                <div class="w-full relative group flex flex-col gap-1 xl:col-span-1">
                    <label for="name" class="font-semibold text-ternary/90 text-sm">Name</label>
                    <div class="w-full relative">
                        <input type="text" name="clientname" id="clientname" readonly value="{{$clientData->clint->client_name}}" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                        <input type="hidden" name="bookingid" value="{{$clientData->id}}">
                        <input type="hidden" name="clientid" value="{{$clientData->clint->id}}">
                        <input type="hidden" name="invoicenumber" value="{{$clientData->application_number}}">

                    </div>
                    @error('clientname')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                @php
                    $defaultDate = old('invoicedate') 
                        ?? (isset($clientData) && isset($clientData->invoice_date) 
                            ? \Carbon\Carbon::parse($clientData->invoice_date)->format('Y-m-d') 
                            : \Carbon\Carbon::now()->format('Y-m-d'));
                @endphp

                <div class="w-full relative group flex flex-col gap-1 xl:col-span-1">
                    <label for="invoicedate" class="font-semibold text-ternary/90 text-sm">Invoice Date</label>
                    <div class="w-full relative">
                        <input
                            type="date"
                            name="invoicedate"
                            id="invoicedate"
                            value="{{ $defaultDate }}"
                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"
                        >
                    </div>
                    @error('invoicedate')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div class="flex items-center mt-2">
                    <input
                        type="checkbox"
                        id="invoiceDifferentName"
                        class="h-4 w-4 text-secondary border-gray-300 rounded focus:ring-secondary"
                    >
                    <label for="invoiceDifferentName" class="ml-2 block text-sm text-gray-700">
                        Create invoice for Different Name
                    </label>
                </div>

                <!-- Hidden input (shown only if checkbox is checked) -->
                <div id="altNameWrapper" class="mt-2" style="display:none;">
                    <label for="alternate_name" class="block text-sm text-gray-600 mb-1">Alternate Invoice Name</label>
                    <input
                        type="text"
                        id="alternate_name"
                        name="alternate_name"
                        class="w-full pl-2 pr-8 py-1 rounded border border-gray-300 focus:outline-none focus:border-secondary/70"
                        placeholder="Enter alternate name"
                    >
                </div>
                
                <div class="w-full relative group flex flex-col xl:col-span-4 gap-1">
                    <label for="address" class="font-semibold text-ternary/90 text-sm">Address</label>

                    <div class="w-full relative">
                        <textarea
                            name="address"
                            id="address"
                            rows="6"
                            class="w-full pl-2 pr-8 py-1 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                        >{{ old('address', isset($clientData) ? $clientData->clint->address : '') }}</textarea>

                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>


                <!-- <div class="w-full relative group flex flex-col gap-1 xl:col-span-2">
                    <label class="font-semibold text-ternary/90 text-sm">Select Service</label>
                    <div class="w-full relative">
                        <input type="text" value="{{$clientData->visa->name}}" readonly class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                    </div>
                </div> -->

                <div class="w-full relative group flex flex-col gap-1 xl:col-span-2">
                    <label class="font-semibold text-ternary/90 text-sm">Name Of Visa Applicant</label>
                    <div class="w-full relative">
                        <input type="text" value="{{$clientData->clint->client_name}}" readonly class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                    </div>
                </div>

                <div class="w-full relative group flex flex-col gap-1 xl:col-span-1">
                    <label class="font-semibold text-ternary/90 text-sm">Passport Origin</label>
                    <div class="w-full relative">
                        <input type="text" readonly value="{{$clientData->clint->clientinfo->passport_issue_place}}" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                    </div>
                </div>

                <div class="w-full relative group flex flex-col gap-1 xl:col-span-1">
                    <label class="font-semibold text-ternary/90 text-sm">Password No.</label>
                    <div class="w-full relative">
                        <input type="text" readonly value="{{$clientData->clint->clientinfo->passport_ic_number}}" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                    </div>
                </div>

                <div class="w-full relative group flex flex-col gap-1 xl:col-span-1">
                    <label class="font-semibold text-ternary/90 text-sm">Passport Member DOB</label>
                    <div class="w-full relative">
                        <input type="date" value="{{$clientData->clint->date_of_birth}}" readonly class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                    </div>
                </div>

                <div class="w-full relative group flex flex-col gap-1 xl:col-span-1">
                    <label class="font-semibold text-ternary/90 text-sm">Visa Country</label>
                    <div class="w-full relative">
                        <input type="text" value="{{$clientData->destination->countryName}}" readonly class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                    </div>
                </div>

                <div class="w-full relative group flex flex-col gap-1 xl:col-span-1">
                    <label class="font-semibold text-ternary/90 text-sm">Visa Type</label>
                    <div class="w-full relative">
                        <input type="text" readonly value="{{$clientData->visa->name}}" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                    </div>
                </div>

                <div class="w-full relative group flex flex-col gap-1 xl:col-span-1">
                    <label class="font-semibold text-ternary/90 text-sm">Visa Fee</label>
                    <div class="w-full relative">
                        <input type="text" readonly  value="{{$clientData->visasubtype->price}}" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                    </div>
                </div>

          
                <div class="w-full relative group flex flex-col gap-1 xl:col-span-1">
                    <label class="font-semibold text-ternary/90 text-sm">Service Charge</label>
                    <div class="w-full relative">
                        <input type="text" readonly value="{{$clientData->visasubtype->commission}}" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                    </div>
                </div>

                <div class="w-full relative group flex flex-col gap-1 xl:col-span-1">
                    <label class="font-semibold text-ternary/90 text-sm">Amount</label>
                    <div class="w-full relative">
                        <input type="text" readonly value="{{$clientData->total_amount}}"  class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                    </div>
                </div>

                @php
                $currency = '£';
                $subtotal = $clientData->total_amount ?? 0;
            @endphp
                    <hr class="xl:col-span-4 my-2">

                    {{-- Currency and Totals Section --}}
                    <div class="w-full relative group flex flex-col gap-1 xl:col-span-4">
                        <div class="flex justify-between items-center border-b pb-2 mb-2">
                            <label class="font-semibold text-ternary/90">CURRENCY</label>
                            <input type="text" value="{{ $currency }}" readonly class="max-w-xl pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                        </div>

                        <div class="flex justify-between items-center">
                            <label class="font-semibold text-ternary/90">SUB TOTAL:</label>
                            <input type="text" name="subtotalInput" id="subtotalInput" value="{{ number_format($subtotal, 2) }}" readonly class="max-w-xl pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                        </div>

                        <div class="flex justify-between items-center">
                            <label class="font-semibold text-ternary/90">DISCOUNT:</label>
                            <input type="number" name="discountInput" id="discountInput" value="0.00" step="0.01" class="max-w-xl pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                        </div>

                        <div class="flex justify-between items-center border-t pt-2 mt-2">
                            <label class="font-semibold text-ternary/90 text-lg">TOTAL:</label>
                            <input type="text" name="totalInput" id="totalInput" value="{{ $currency . number_format($subtotal, 2) }}" readonly class="max-w-xl pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                        </div>
                    </div>

                    <hr class="xl:col-span-4 my-2">

                    {{-- Payment Methods Section --}}
                    <div class="w-full relative group flex flex-col gap-1 xl:col-span-4">
                        <label class="font-semibold text-ternary/90 text-lg mb-2">PAYMENT METHODS</label>
                    `        
                            <div class="flex items-center gap-4 mb-2">
                                <input type="radio" id="cash" name="paymentMethod" value="cash" 
                                    class="h-4 w-4 text-secondary border-gray-300 rounded focus:ring-secondary"
                                    checked>
                                <label for="cash" class="block text-sm text-gray-700">CASH</label>
                            </div>

                            <div class="flex items-center gap-4 mb-2">
                                <input type="radio" id="creditCard" name="paymentMethod" value="creditCard" 
                                    class="h-4 w-4 text-secondary border-gray-300 rounded focus:ring-secondary">
                                <label for="creditCard" class="block text-sm text-gray-700">CREDIT CARD</label>
                            </div>

                            <div class="flex items-center gap-4 mb-2">
                                <input type="radio" id="debitCard" name="paymentMethod" value="debitCard" 
                                    class="h-4 w-4 text-secondary border-gray-300 rounded focus:ring-secondary">
                                <label for="debitCard" class="block text-sm text-gray-700">DEBIT CARD</label>
                            </div>

                            <div class="flex items-center gap-4">
                                <input type="radio" id="bankTransfer" name="paymentMethod" value="bankTransfer" 
                                    class="h-4 w-4 text-secondary border-gray-300 rounded focus:ring-secondary">
                                <label for="bankTransfer" class="block text-sm text-gray-700">BANK TRANSFER</label>
                            </div>
                        </div>`
                </div>



                            
                                </div>
                                <div class="w-full flex justify-end px-4 pb-4 gap-2">
                                    <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Generate Invoice</button>
                                </div>
                            </form>
                        </div>
                    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const chk = document.getElementById('invoiceDifferentName');
    const wrapper = document.getElementById('altNameWrapper');

    chk.addEventListener('change', function () {
        wrapper.style.display = this.checked ? 'block' : 'none';
    });
});

    document.addEventListener('DOMContentLoaded', function () {
       
        const discountInput = document.getElementById('discountInput');
        const totalInput = document.getElementById('totalInput');
        const subtotal = parseFloat(document.getElementById('subtotalInput').value);
        const currency = @json($currency);

        function updateTotal() {
            let discount = parseFloat(discountInput.value) || 0;
            let total = subtotal - discount;
            if (total < 0) total = 0;
            totalInput.value = currency + total.toFixed(2);
        }

        discountInput.addEventListener('input', updateTotal);
    });
</script>
</script>