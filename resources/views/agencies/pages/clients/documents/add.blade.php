<x-agency.layout>
@section('title') Add Emergency Message @endsection

<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
    <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between items-center">
        <span class="font-semibold text-ternary text-xl">Current Movements</span>
        <div class="flex items-center gap-2">
            <a href="{{ route('client.documents.movement') }}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary">Back to Movement</a>
        </div>
    </div>

    <div class="w-full overflow-x-auto p-4">
        <!-- Movements Table -->
        <table class="w-full border-[2px] border-secondary/40 border-collapse mt-2">
            <tr>
                <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Sno.</th>
                <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Date</th>
                <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Client Name</th>
                <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Phone No.</th>
                <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa Applicant Name</th>
                <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">DOB</th>
                <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Passport Origin</th>
                <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Passport No.</th>
                <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa Country</th>
                <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa Type</th>
                <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>
            </tr>
            @forelse($selected as $sel)
                @php
                    $booking = $sel->booking;
                    $client = ($sel instanceof \App\Models\ClientDocumentSelection) ? ($sel->client ?? optional($booking)->clint) : null;
                    $clientName = $client ? ($client->client_name ?? trim(($client->first_name ?? '').' '.($client->last_name ?? ''))) : 'N/A';
                    $visaCountry = optional(optional($booking)->destination)->countryName ?? '';
                    $visaType = optional(optional($booking)->visasubtype)->name ?? 'VISA';
                @endphp
                <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : '' }}">
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $selected->firstItem() ? $selected->firstItem() + $loop->index : $loop->iteration }}</td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ optional($sel->created_at)->format('Y-m-d') }}</td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $clientName }}</td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $client->phone_number ?? 'N/A' }}</td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">
                        @if($client)
                            <label class="inline-flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    class="client-checkbox h-4 w-4 text-primary border-gray-300 rounded"
                                    data-client-id="{{ $client->id }}"
                                    data-client-email="{{ $client->email }}"
                                    data-client-name="{{ $clientName }}"
                                    checked
                                >
                                <span>{{ $clientName }}</span>
                            </label>
                        @else
                            <span class="text-gray-500 text-sm">Client unavailable</span>
                        @endif
                    </td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $client->date_of_birth ?? 'N/A' }}</td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $client->passport_issue_place ?? 'NA' }}</td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $client->passport_no ?? 'NA' }}</td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $visaCountry }}</td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $visaType }}</td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">
                        <form method="POST" action="{{ route('client.documents.movement.remove', $sel->booking_id) }}">
                            @csrf
                            <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition duration-200">Remove</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="border-[2px] border-secondary/40 px-4 py-2 text-center text-sm">No Record Added</td>
                </tr>
            @endforelse
        </table>

        <!-- Pagination -->
        @if($selected->hasPages())
            <div class="mt-4">
                {{ $selected->links() }}
            </div>
        @endif

        <!-- Emergency Message Section -->
        @php
            $selectedItems = method_exists($selected, 'items') ? $selected->items() : $selected;

            $collection = collect($selectedItems)->filter(function ($item) {
                if (!($item instanceof \App\Models\ClientDocumentSelection)) {
                    return false;
                }
                $client = $item->client ?? optional($item->booking)->clint;
                return $client !== null;
            });

            $groupedSelections = $collection->groupBy(function ($item) {
                $client = $item->client ?? optional($item->booking)->clint;
                return $client->client_name ?? trim(($client->first_name ?? '').' '.($client->last_name ?? '')) ?? 'Unknown Client';
            });

            $initialClientIds = $collection->map(function ($selection) {
                $client = $selection->client ?? optional($selection->booking)->clint;
                return optional($client)->id;
            })->filter()->unique()->implode(',');
        @endphp

        @if($groupedSelections->isNotEmpty())
        <div class="mt-8 border-t-4 border-red-500 pt-6">
            <h2 class="text-2xl font-bold text-center text-ternary mb-6">Emergency Message</h2>

            <div class="space-y-4">
                @foreach($groupedSelections as $clientName => $clientSelections)
                    <div class="border border-gray-200 bg-white rounded px-4 py-3">
                        <p class="font-semibold text-ternary mb-1">{{ $loop->iteration }}. Client Name: <span class="font-bold">{{ strtoupper($clientName) }}</span></p>
                        <div class="text-sm text-ternary">
                            <span class="font-semibold mr-2">Visa Applicants:</span>
                            @foreach($clientSelections as $selection)
                                @php
                                    $client = $selection->client ?? optional($selection->booking)->clint;
                                    if (!$client) {
                                        continue;
                                    }
                                    $clientLabel = $client->client_name ?? trim(($client->first_name ?? '').' '.($client->last_name ?? ''));
                                @endphp
                                <label class="inline-flex items-center gap-2 mr-4 align-middle">
                                    <input
                                        type="checkbox"
                                        class="client-checkbox h-4 w-4 text-primary border-gray-300 rounded"
                                        data-client-id="{{ $client->id }}"
                                        data-client-email="{{ $client->email }}"
                                        data-client-name="{{ $clientLabel }}"
                                        checked
                                    >
                                    <span class="uppercase tracking-wide text-xs sm:text-sm">{{ $clientLabel }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <form method="POST" action="{{ route('client.documents.movement.add.store') }}" class="mt-6 flex flex-col md:flex-row md:items-center md:gap-4" id="emergencyMessageForm">
                @csrf
                <input type="hidden" name="client_ids" id="selectedClientIds" value="{{ $initialClientIds }}">
                <textarea
                    name="message"
                    rows="2"
                    placeholder="ENTER MESSAGE"
                    class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                    required
                ></textarea>
                <button
                    type="submit"
                    class="mt-3 md:mt-0 md:w-auto px-6 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition duration-200 font-semibold uppercase text-sm"
                >
                    Send
                </button>
            </form>
        </div>
        @else
        <div class="mt-6 pt-6 border-t-2 border-red-500">
            <p class="text-center text-gray-500">No clients selected. Go back to add clients from the movement page.</p>
        </div>
        @endif

        
</div>
</div>
</div>

</x-agency.layout>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const updateSelectedClients = () => {
            const selectedIds = new Set();
            document.querySelectorAll('.client-checkbox:checked').forEach((checkbox) => {
                selectedIds.add(checkbox.dataset.clientId);
            });
            document.getElementById('selectedClientIds').value = Array.from(selectedIds).join(',');
        };

        document.querySelectorAll('.client-checkbox').forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                updateSelectedClients();
            });
        });

        updateSelectedClients();
    });
</script>
@endpush
