<x-front.layout>
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

            <form action="{{ route('allinvoices.updateinvoice', $invoice->id) }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block font-semibold text-sm text-ternary/90 mb-1">Invoice No</label>
                    <input type="text" name="invoice_number" value="{{ $invoice->invoice_number }}" readonly
                    class="w-full bg-gray-100 border border-secondary/40 rounded-md px-3 py-2 text-sm cursor-not-allowed">
                </div>


                <div>
                    <label class="block font-semibold text-sm text-ternary/90 mb-1">Amount (£) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="amount" value="{{ old('amount', $invoice->amount) }}"
                        class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm" required>
                </div>

                <div>
                    <label class="block font-semibold text-sm text-ternary/90 mb-1">Service Name</label>
                    <input type="text" value="{{ $invoice->service_name->name ?? 'N/A' }}" readonly
                        class="w-full bg-gray-100 border border-secondary/40 rounded-md px-3 py-2 text-sm cursor-not-allowed">
                </div>

                <div>
                    <label class="block font-semibold text-sm text-ternary/90 mb-1">Client Id</label>
                    <input type="text" value="{{ $invoice->visaBooking->client_id ?? 'N/A' }}" 
                        class="w-full bg-gray-100 border border-secondary/40 rounded-md px-3 py-2 text-sm">
                </div>

                <div>
                    <label class="block font-semibold text-sm text-ternary/90 mb-1">Agency Name</label>
                    <input type="text" value="{{ $invoice->agency->name ?? 'N/A' }}" 
                        class="w-full bg-gray-100 border border-secondary/40 rounded-md px-3 py-2 text-sm">
                </div>

                

                <div class="flex justify-end gap-2 pt-4">
                    <a href="{{ route('superadmin.allinvoices') }}"
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
    </div>
</x-front.layout>
