<x-agency.layout>
    @section('title') Edited Invoices @endsection
    
    <div class="w-full grid xl:grid-cols-5 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 mb-4">
        <!-- Optional filter/header area -->
    </div>

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        {{-- === Heading Section === --}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Edited Invoices</span>
        </div>

        {{-- === Table Section === --}}
        <div class="w-full overflow-x-auto px-4 py-4">
            <table class="w-full border-[2px] border-secondary/40 border-collapse">
                <thead class="bg-gray-100/90">
                    <tr>
                        <th class="border-[1px] border-secondary/50 px-4 py-1.5 text-ternary/80 font-bold text-sm">Sr. No.</th>
                        <th class="border-[1px] border-secondary/50 px-4 py-1.5 text-ternary/80 font-bold text-sm">New Invoice No</th>
                        <th class="border-[1px] border-secondary/50 px-4 py-1.5 text-ternary/80 font-bold text-sm">Old Invoice No</th>
                        <th class="border-[1px] border-secondary/50 px-4 py-1.5 text-ternary/80 font-bold text-sm">Amount (£)</th>
                        <th class="border-[1px] border-secondary/50 px-4 py-1.5 text-ternary/80 font-bold text-sm">Service</th>
                        <th class="border-[1px] border-secondary/50 px-4 py-1.5 text-ternary/80 font-bold text-sm">Agency</th>
                        <th class="border-[1px] border-secondary/50 px-4 py-1.5 text-ternary/80 font-bold text-sm">Client ID</th>
                        <th class="border-[1px] border-secondary/50 px-4 py-1.5 text-ternary/80 font-bold text-sm">Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invoices as $invoice)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $loop->iteration }}</td>
                            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $invoice->invoice_number }}</td>
                            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $invoice->oldinvoiceno ?? 'N/A' }}</td>
                            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">£{{ $invoice->amount }}</td>
                            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $invoice->service_name->name ?? 'N/A' }}</td>
                            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $invoice->agency->name ?? 'N/A' }}</td>
                            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $invoice->visaBooking->client_id ?? 'N/A' }}</td>
                            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $invoice->updated_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-500">No edited invoices found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-agency.layout>
