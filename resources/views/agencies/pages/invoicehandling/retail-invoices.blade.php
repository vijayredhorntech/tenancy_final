<x-agency.layout>
    @section('title')Retail Invoices @endsection

    <div class="w-full grid xl:grid-cols-5 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 mb-4">
    </div>

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Retail Invoices</span>
        </div>

        <div class="w-full overflow-x-auto px-4 ">
            <div style="margin-bottom: 30px;">
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>          
                        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice No.</td>
                        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Service</td>
                        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice Date</td>
                        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Amount</td>
                        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                    </tr>

                    @php $invoices = $invoices ?? collect(); @endphp

                    @forelse($invoices as $invoice)
                        <tr>
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>                         
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$invoice->superadmin_invoice_number ?? $invoice->invoice_number ?? 'N/A'}}</td> 
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$invoice->service_name->name ?? '—'}}</td>
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$invoice->date ? \Carbon\Carbon::parse($invoice->date)->format('d-m-Y') : optional($invoice->created_at)->format('d-m-Y')}}</td>
                            <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$invoice->amount ?? '—'}}</td>

                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">
                                    <a href="{{ $invoice->flight_booking_id ? route('superadmin.retail.invoice.view', ['id' => $invoice->flight_booking_id]) : '#' }}"
                                       @if(!$invoice->flight_booking_id) onclick="return false" @endif
                                       class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white"
                                       title="View Invoice">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm text-center">No Record Found</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>

        <form method="GET" action="{{ route('retail.invoices', ['type' => 'agencies']) }}" class="w-full flex justify-end items-center flex-wrap gap-2 px-4 pb-2">
            <div class="flex gap-2 items-center">
                <label for="per_page" class="text-sm font-medium text-gray-700">Show:</label>
                <select name="per_page" id="per_page"
                        class="rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                        onchange="this.form.submit()">
                    @foreach([10, 25, 50, 100] as $perPage)
                        <option value="{{ $perPage }}" {{ request('per_page', 10) == $perPage ? 'selected' : '' }}>
                            {{ $perPage }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

    </div>
</x-agency.layout>


