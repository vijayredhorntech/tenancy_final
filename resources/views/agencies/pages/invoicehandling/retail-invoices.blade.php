<x-agency.layout>


<div class="p-4">
    <h1 class="text-2xl font-semibold mb-4">Retail Invoices</h1>

    <div class="bg-white shadow rounded-md overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-3 py-2 text-left">Sr. No.</th>
                    <th class="px-3 py-2 text-left">Invoice No.</th>
                    <th class="px-3 py-2 text-left">Service</th>
                    <th class="px-3 py-2 text-left">Invoice Date</th>
                    <th class="px-3 py-2 text-left">Amount</th>
                    <th class="px-3 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($invoices as $index => $invoice)
                <tr>
                    <td class="px-3 py-2">{{ $index + 1 }}</td>
                    <td class="px-3 py-2">{{ $invoice->superadmin_invoice_number ?? '—' }}</td>
                    <td class="px-3 py-2">Visa</td>
                    <td class="px-3 py-2">{{ optional($invoice->created_at)->format('d-m-Y') }}</td>
                    <td class="px-3 py-2">{{ $invoice->amount ? number_format($invoice->amount, 2) : '—' }}</td>
                    <td class="px-3 py-2">
                        @if($invoice->flight_booking_id)
                            <a href="{{ route('superadmin.retail.invoice.view', ['id' => $invoice->flight_booking_id]) }}" class="text-primary hover:underline">View</a>
                        @else
                            <span class="opacity-60">N/A</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-3 py-4 text-center text-gray-500">No records found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-agency.layout>


