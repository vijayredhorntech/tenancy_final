<x-front.layout>
    @section('title')Cancel Invoice @endsection

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
            <form action="{{ route('cancelinvoice.submit', ['id' => $invoice->id]) }}" method="POST" class="space-y-4" onsubmit="return confirm('Are you sure you want to cancel this invoice?')">
                @csrf

                {{-- Hidden ID --}}
                <input type="hidden" name="id" value="{{ old('id', $invoice->id) }}">

                <div>
                    <label class="block font-semibold text-sm text-ternary/90 mb-1">Invoice No</label>
                    <input type="text" value="{{ $invoice->invoice_number }}" readonly
                        class="w-full bg-gray-100 border border-secondary/40 rounded-md px-3 py-2 text-sm cursor-not-allowed">
                </div>

                <div>
                    <label class="block font-semibold text-sm text-ternary/90 mb-1">Refund Amount (£) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="refundamount" value="{{ old('refundamount') }}"
                        class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm" required>
                </div>

                <div>
                    <label class="block font-semibold text-sm text-ternary/90 mb-1">Reason <span class="text-red-500">*</span></label>
                    <textarea name="reason" rows="3" placeholder="Enter reason for cancellation..." required
                        class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">{{ old('reason') }}</textarea>
                </div>

                <div>
                    <label class="block font-semibold text-sm text-ternary/90 mb-1">Invoice Status</label>
                    <select name="invoicestatus"
                        class="w-full border border-secondary/40 rounded-md px-3 py-2 focus:ring-primary focus:border-primary text-sm">
                        <option value="1">Canceled</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2 pt-4">
                    <a href="{{ route('superadmin.allinvoices') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 text-sm">
                        Back
                    </a>
                    <button type="submit"
                            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 text-sm">
                        Submit Cancellation
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-front.layout>
