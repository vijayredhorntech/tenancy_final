<x-agency.layout>
    @section('title')Staff @endsection
    <div class="w-full grid xl:grid-cols-5 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 mb-4">

    </div>

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl"> Visa Application  </span>
            </div>
{{--        === heading section code ends here===--}}

{{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
                     <!-- search function  -->
                <form id="filter-form" method="GET" action="{{ route('invoice.index',['type'=>'agencies']) }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Search -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                    placeholder="Name, Email, Transaction ID">
                            </div>

                            <!-- Date Range -->
                            <div>
                                    <label for="date_from" class="block text-sm font-medium text-gray-700">Date Range</label>
                                    <div class="flex gap-2">
                                        <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" max="9999-12-31"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                        <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" max="9999-12-31"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                    </div>
                                </div>


                            <!-- Price Range -->
                            <div>
                                <label for="min_price" class="block text-sm font-medium text-gray-700">Price Range</label>
                                <div class="flex gap-2">
                                    <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" min='0'
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                        placeholder="Min price">
                                    <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" min='0'
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                        placeholder="Max price">
                                </div>
                            </div>

                            <!-- Invoice Status -->
                            <div>
                                <label for="application_status" class="block text-sm font-medium text-gray-700">
                                    Invoice Status
                                </label>
                                <select name="application_status" id="application_status" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                    <option value="">All</option>
                                    <option value="Complete" {{ request('application_status') == 'Complete' ? 'selected' : '' }}>Paid</option>
                                    <option value="Cancelled" {{ request('application_status') == 'Cancelled' ? 'selected' : '' }}>Cancel</option>
                                    <option value="Edit" {{ request('application_status') == 'Edit' ? 'selected' : '' }}>Edit</option>
                                    <option value="Parcel" {{ request('application_status') == 'Parcel' ? 'selected' : '' }}>Parcel</option>
                                </select>
                            </div>

                             <!-- Invoice Status -->
                             <div>
                                <label for="application_status" class="block text-sm font-medium text-gray-700">
                                   Service 
                                </label>
                                <select name="application_status" id="application_status" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                    <option value="">All</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ request('service_id') == $service->id?'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                
                                </select>
                            </div>

                        </div>

                        <!-- Filter Actions -->
                        <div class="flex justify-between items-center mt-4">
                            <div class="flex gap-2">
                                <button type="submit" class="bg-success text-white px-4 py-2 rounded-md hover:bg-success/90">
                                    Apply Filters
                                </button>
                                <a href="{{ route('invoice.index',['type'=>'agencies']) }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                                    Clear Filters
                                </a>
                            </div>
                            <div class="flex gap-2 items-center">
                                <label for="per_page" class="text-sm font-medium text-gray-700">Show:</label>
                                <select name="per_page" id="per_page" class="rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                        onchange="this.form.submit()">
                                    @foreach([10, 25, 50, 100] as $perPage)
                                        <option value="{{ $perPage }}" {{ request('per_page', 10) == $perPage ? 'selected' : '' }}>
                                            {{ $perPage }}
                                        </option>
                                    @endforeach
                                </select>
                                <a href="{{ route('superadmin.visaexportexcel') }}?{{ http_build_query(request()->all()) }}" 
                                class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                    Export CSV
                                </a>
                                <a href="{{ route('superadmin.visaexportpdf') }}?{{ http_build_query(request()->all()) }}"
                                    class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                        Export PDF
                                    </a>
                            </div>
                        </div>
              </form>
            
            

              <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice Number</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Client Details</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Service Type</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Amount</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice Date</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>
                    </tr>

                    @forelse($invoices as $invoice)
                        <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-200">
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $loop->iteration }}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">{{ $invoice->invoice_number ?? 'N/A' }}</td>

                            <!-- Client Details (Assuming relation is client or user) -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                {{ $invoice->client->name ?? 'N/A' }}<br>
                                <span class="text-xs text-gray-500">{{ $invoice->client->email ?? '' }}</span>
                            </td>

                            <!-- Service Type -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                {{ $invoice->service_name->name ?? 'N/A' }}
                            </td>

                            <!-- Amount -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                £ {{ number_format($invoice->amount ?? 0, 2) }}
                            </td>

                            <!-- Invoice Date -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                {{ $invoice->created_at ? $invoice->created_at->format('d M Y') : 'N/A' }}
                            </td>

                            <!-- Actions (e.g., View, Download, Edit) -->
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                 <a href="{{route('invoice.view',['id'=>$invoice->id])}}" title="View">
                                        <div class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </a>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm text-center">No Record Found</td>
                        </tr>
                    @endforelse
            </table>

                            <br>
                 
            </div>
{{--        === table section code ends here===--}}

        </div>
        <script>
    document.querySelectorAll('input[type="date"]').forEach(function(input) {
        input.addEventListener('input', function () {
            const value = this.value;
            const year = value.split('-')[0];

            if (year.length > 4) {
                alert('Year must be exactly 4 digits.');
                this.value = '';
            }
        });
    });
</script>
</x-agency.layout>
