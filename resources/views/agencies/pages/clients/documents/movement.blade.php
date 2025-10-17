<x-agency.layout>
@section('title') Client Document Movement @endsection

<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
    <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
        <span class="font-semibold text-ternary text-xl">Client Document Movement</span>
        <a href="{{ route('client.documents.movement.add.form') }}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-200">View Selected</a>
    </div>

    <div class="w-full overflow-x-auto p-4">
        <!-- Search Form -->
        <form id="filter-form" method="GET" action="{{ route('client.documents.movement') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Search -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                        placeholder="Client Name, UID, Phone">
                </div>

                <!-- Date Range -->
                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700">Date Range</label>
                    <div class="flex gap-2">
                        <input type="date" name="date_from" id="date_from" max="2099-12-31" value="{{ request('date_from') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                        <input type="date" name="date_to" id="date_to" max="2099-12-31" value="{{ request('date_to') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                    </div>
                </div>
            </div>

            <!-- Filter Actions -->
            <div class="flex justify-between items-center mt-4">
                <div class="flex gap-2">
                    <button type="submit" class="bg-success text-white px-4 py-2 rounded-md hover:bg-success/90">
                        Apply Filters
                    </button>
                    <a href="{{ route('client.documents.movement') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                        Clear Filters
                    </a>
                </div>
                <div class="flex gap-2 items-center">
                    <label for="per_page" class="text-sm font-medium text-gray-700">Show:</label>
                    <select name="per_page" id="per_page" class="rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                            onchange="this.form.submit()">
                        @foreach([10, 25, 50, 100] as $perPage)
                            <option value="{{ $perPage }}" {{ request('per_page', 25) == $perPage ? 'selected' : '' }}>
                                {{ $perPage }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
            <tr>
                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Client Name</td>
                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Phone No.</td>
                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Date</td>
                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa Applicant Name</td>
                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">DOB</td>
                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Passport Origin</td>
                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Passport No.</td>
                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa Country</td>
                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa Type</td>
                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
            </tr>
                    @forelse($bookings as $booking)
                        @php $client = $booking->clint; @endphp
                        <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : 'bg-white' }}">
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $loop->iteration }}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $client->client_name ?? (trim(($client->first_name ?? '').' '.($client->last_name ?? ''))) }}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $client->phone_number ?? '' }}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ optional($booking->created_at)->format('Y-m-d') }}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $client->client_name ?? (trim(($client->first_name ?? '').' '.($client->last_name ?? ''))) }}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $client->date_of_birth ?? '' }}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $client->passport_issue_place ?? 'NA' }}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $client->passport_no ?? 'NA' }}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $booking->destination->countryName ?? '' }}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $booking->visasubtype->name ?? 'VISA' }}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm text-center">
                                <form method="POST" action="{{ route('client.documents.movement.add', $booking->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="px-4 py-1 bg-green-500 text-white rounded hover:bg-green-600 transition duration-200 text-sm">Add</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="border-[2px] border-secondary/40 px-4 py-3 text-center text-sm text-ternary/80">No clients found.</td>
                        </tr>
                    @endforelse
        </table>
        <div class="mt-3">{{ $bookings->links() }}</div>
    </div>
</div>

</x-agency.layout>
