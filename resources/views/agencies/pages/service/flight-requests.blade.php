<x-agency.layout>
@section('title') Flight Requests @endsection

<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-warning bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
    {{-- Header Section --}}
    <div class="bg-warning/10 px-4 py-2 border-b-[2px] border-b-warning/20 flex justify-between items-center">
        <span class="font-semibold text-ternary text-xl">Flight Requests</span>
        <span class="text-sm text-gray-600">Manage flight requests from clients</span>
    </div>

    {{-- Content Section --}}
    <div class="w-full overflow-x-auto p-4">
        @if($flightRequests && $flightRequests->count() > 0)
            <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                <thead>
                    <tr>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Request Date</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Client Details</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Flight Details</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Trip Type</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Status</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flightRequests as $flightRequest)
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000">
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $flightRequest->created_at->format('d M Y') }}</td>
                            
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                <div class="font-semibold">{{ $flightRequest->full_name }}</div>
                                <div class="text-xs text-gray-600">{{ $flightRequest->email }}</div>
                                <div class="text-xs text-gray-600">{{ $flightRequest->phone_number }}</div>
                                @if($flightRequest->zipcode)
                                    <div class="text-xs text-gray-600">Zip: {{ $flightRequest->zipcode }}</div>
                                @endif
                            </td>
                            
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="text-xs">
                                    <div class="font-semibold">{{ $flightRequest->origin }} → {{ $flightRequest->destination }}</div>
                                    <div class="text-gray-600">{{ $flightRequest->departure_date->format('d M Y') }}</div>
                                    @if($flightRequest->return_date)
                                        <div class="text-gray-600">Return: {{ $flightRequest->return_date->format('d M Y') }}</div>
                                    @endif
                                </div>
                            </td>
                            
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-[3px] font-medium text-xs">
                                    {{ ucfirst($flightRequest->trip_type) }}
                                </span>
                            </td>
                            
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                @php
                                    $status = $flightRequest->status ?? 'pending';
                                    // Normalize status to lowercase for consistent matching
                                    $status = strtolower(trim($status));
                                    
                                    $statusColors = [
                                        'pending' => ['bg' => 'bg-yellow-200', 'text' => 'text-yellow-700'],
                                        'approved' => ['bg' => 'bg-green-200', 'text' => 'text-green-700'],
                                        'rejected' => ['bg' => 'bg-red-200', 'text' => 'text-red-700'],
                                        'completed' => ['bg' => 'bg-blue-200', 'text' => 'text-blue-700']
                                    ];
                                    
                                    // Get colors with fallback to default grey
                                    $colors = $statusColors[$status] ?? ['bg' => 'bg-gray-200', 'text' => 'text-gray-700'];
                                @endphp
                                
                                <span class="{{ $colors['bg'] }} {{ $colors['text'] }} px-2 py-1 rounded-[3px] font-medium">
                                    {{ ucfirst($flightRequest->status ?? 'Pending') }}
                                </span>
                            </td>
                            
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">
                                    <a href="{{ route('flight.request.view', $flightRequest->id) }}" title="View Details">
                                        <div class="bg-blue-100 text-blue-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-blue-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </a>
                                    
                                    <button onclick="updateStatus({{ $flightRequest->id }})" title="Update Status">
                                        <div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-edit"></i>
                                        </div>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{-- Pagination --}}
            <div class="mt-4">
                {{ $flightRequests->onEachSide(0)->links() }}
            </div>
        @else
            <div class="text-center py-8">
                <div class="text-gray-500 text-lg mb-2">No flight requests found</div>
                <div class="text-gray-400 text-sm">Flight requests from clients will appear here</div>
            </div>
        @endif
    </div>
</div>

{{-- Status Update Modal --}}
<div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-xl p-6 w-96">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-ternary">Update Flight Request Status</h3>
                <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            
            <form id="statusForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeStatusModal()" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary/90">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function updateStatus(requestId) {
    const modal = document.getElementById('statusModal');
    const form = document.getElementById('statusForm');
    
    // Simple and reliable URL construction
    form.action = `/agencies/flight-requests/${requestId}/update-status`;
    modal.classList.remove('hidden');
}

function closeStatusModal() {
    const modal = document.getElementById('statusModal');
    modal.classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('statusModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeStatusModal();
    }
});
</script>

</x-agency.layout>
