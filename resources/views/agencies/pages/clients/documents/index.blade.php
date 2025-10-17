<x-agency.layout>
@section('title') Client Documents @endsection

<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
    <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between items-center">
        <span class="font-semibold text-ternary text-xl">Client Documents</span>
        <div class="flex gap-2">
            <a href="{{ route('client.documents.export', request()->query()) }}"
                class="text-sm bg-green-500 px-4 py-1 rounded-[3px] font-semibold border-[2px] border-green-600 text-white hover:bg-green-600 transition ease-in duration-2000">
                Export Excel
            </a>
            <button onclick="document.getElementById('addDocModal').classList.remove('hidden')"
                class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">
                Add Client Document
            </button>
        </div>
    </div>

    <div class="w-full overflow-x-auto p-4">
        <form id="filter-form" method="GET" action="{{ route('client.documents.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Search -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                        placeholder="Client Name, Phone, Document Name">
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
                    <a href="{{ route('client.documents.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
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
                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Document Name</td>
                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Received On</td>
                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Returned On</td>
                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
            </tr>
            @forelse($documents as $doc)
                <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : '' }}">
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $loop->iteration }}</td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm uppercase">{{ $doc->client->client_name ?? 'N/A' }}</td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ $doc->client->phone_number ?? 'N/A' }}</td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">{{ strtoupper($doc->document_name) }}</td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">
                        {{ optional($doc->received_on)->format('Y-m-d H:i:s') }}<br>
                        <span class="text-xs">{{ $doc->remarks }}</span>
                    </td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">
                        {{ optional($doc->returned_on)->format('Y-m-d H:i:s') ?? 'N/A' }}<br>
                        <span class="text-xs">{{ $doc->return_remarks }}</span>
                    </td>
                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">
                        <div class="flex gap-2">
                            @if(!$doc->returned_on)
                                <button onclick="openReturnModal({{ $doc->id }})" class="text-xs bg-success text-white px-3 py-1 rounded-[3px] border-[2px] border-success hover:bg-success/90 transition ease-in duration-200">Return Document</button>
                            @endif
                            <form method="POST" action="{{ route('client.documents.destroy', $doc->id) }}" onsubmit="return confirm('Are you sure you want to delete this document?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs bg-red-600 text-white px-3 py-1 rounded-[3px] border-[2px] border-red-700 hover:bg-red-700 transition ease-in duration-200">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="border-[2px] border-secondary/40 px-4 py-2 text-center text-sm">No records</td>
                </tr>
            @endforelse
        </table>
        <div class="mt-3">{{ $documents->links() }}</div>
    </div>
</div>

<!-- Add Document Modal -->
<div id="addDocModal" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden">
    <div class="bg-white rounded-md w-full max-w-md shadow-lg">
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20">
            <span class="font-semibold text-ternary text-lg">Add Document</span>
        </div>
        <form action="{{ route('client.documents.store') }}" method="POST">
            @csrf
            <div class="p-4 space-y-3">
                <div>
                    <label class="text-sm font-semibold text-ternary">Select Client</label>
                    <select name="client_id" class="w-full border p-2 rounded-md" required>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ trim(($client->first_name ?? '').' '.($client->last_name ?? '')) }} ({{ $client->phone_number }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-sm font-semibold text-ternary">Document</label>
                    <div id="docNamesWrapper" class="space-y-2">
                        <input type="text" name="document_names[]" class="w-full border p-2 rounded-md" placeholder="Document Name" required>
                    </div>
                    <button type="button" id="btnAddMoreDoc" class="mt-2 text-xs bg-success text-white px-3 py-1 rounded-[3px] border-[2px] border-success hover:bg-success/90 transition ease-in duration-200">Add more</button>
                </div>
                <div>
                    <label class="text-sm font-semibold text-ternary">Received On</label>
                    <input type="datetime-local" name="received_on" class="w-full border p-2 rounded-md" required>
                </div>
                <div>
                    <label class="text-sm font-semibold text-ternary">Remarks</label>
                    <textarea name="remarks" class="w-full border p-2 rounded-md" placeholder="Remarks"></textarea>
                </div>
            </div>
            <div class="px-4 py-3 flex justify-between bg-gray-50">
                <button type="button" onclick="document.getElementById('addDocModal').classList.add('hidden')" class="text-sm bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition ease-in duration-200">Close</button>
                <button type="submit" class="text-sm bg-success text-white px-4 py-2 rounded-md hover:bg-success/90 transition ease-in duration-200">Add Document</button>
            </div>
        </form>
    </div>
    </div>

<!-- Return Document Modal -->
<div id="returnDocModal" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden">
    <div class="bg-white rounded-md w-full max-w-md shadow-lg">
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20">
            <span class="font-semibold text-ternary text-lg">Return Document</span>
        </div>
        <form id="returnForm" method="POST">
            @csrf
            <div class="p-4 space-y-3">
                <div>
                    <label class="text-sm font-semibold text-ternary">Returned On</label>
                    <input type="datetime-local" name="returned_on" class="w-full border p-2 rounded-md" required>
                </div>
                <div>
                    <label class="text-sm font-semibold text-ternary">Remarks</label>
                    <textarea name="remarks" class="w-full border p-2 rounded-md" placeholder="Remarks"></textarea>
                </div>
            </div>
            <div class="px-4 py-3 flex justify-between bg-gray-50">
                <button type="button" onclick="document.getElementById('returnDocModal').classList.add('hidden')" class="text-sm bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition ease-in duration-200">Close</button>
                <button type="submit" class="text-sm bg-success text-white px-4 py-2 rounded-md hover:bg-success/90 transition ease-in duration-200">Return Document</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openReturnModal(id) {
        const modal = document.getElementById('returnDocModal');
        const form = document.getElementById('returnForm');
        form.action = '{{ route('client.documents.return', ':documentId') }}'.replace(':documentId', id);
        modal.classList.remove('hidden');
    }
</script>
<script>
    document.getElementById('btnAddMoreDoc')?.addEventListener('click', function(){
        const wrapper = document.getElementById('docNamesWrapper');
        const input = document.createElement('div');
        input.innerHTML = '<div class="flex items-center gap-2"><input type="text" name="document_names[]" class="w-full border p-2 rounded-md" placeholder="Document Name" required><button type="button" class="text-xs bg-red-600 text-white px-3 py-1 rounded-[3px] border-[2px] border-red-700 hover:bg-red-700 transition ease-in duration-200 removeDocBtn">Remove</button></div>';
        wrapper.appendChild(input);
        input.querySelector('.removeDocBtn').addEventListener('click', function(){
            input.remove();
        });
    });
</script>

</x-agency.layout>
