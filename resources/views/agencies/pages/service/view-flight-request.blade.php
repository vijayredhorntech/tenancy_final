<x-agency.layout>
@section('title') Flight Request Details @endsection

<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-warning bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
    {{-- Header Section --}}
    <div class="bg-warning/10 px-4 py-2 border-b-[2px] border-b-warning/20 flex justify-between items-center">
        <span class="font-semibold text-ternary text-xl">Flight Request Details</span>
        <a href="{{ route('flight.requests') }}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">
            <i class="fa fa-arrow-left mr-1"></i> Back to List
        </a>
    </div>

    {{-- Content Section --}}
    <div class="w-full p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            {{-- Client Information --}}
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h3 class="text-lg font-semibold text-ternary mb-4 border-b border-gray-300 pb-2">
                    <i class="fa fa-user mr-2 text-primary"></i>Client Information
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Full Name:</span>
                        <span class="text-ternary">{{ $flightRequest->full_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Email:</span>
                        <span class="text-ternary">{{ $flightRequest->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Phone:</span>
                        <span class="text-ternary">{{ $flightRequest->phone_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Nationality:</span>
                        <span class="text-ternary">{{ $flightRequest->nationality }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Address:</span>
                        <span class="text-ternary">{{ $flightRequest->address }}, {{ $flightRequest->city }}</span>
                    </div>
                    @if($flightRequest->zipcode)
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Zip Code:</span>
                        <span class="text-ternary">{{ $flightRequest->zipcode }}</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Flight Details --}}
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h3 class="text-lg font-semibold text-ternary mb-4 border-b border-gray-300 pb-2">
                    <i class="fa fa-plane mr-2 text-primary"></i>Flight Details
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Origin:</span>
                        <span class="text-ternary">{{ $flightRequest->origin }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Destination:</span>
                        <span class="text-ternary">{{ $flightRequest->destination }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Departure Date:</span>
                        <span class="text-ternary">{{ $flightRequest->departure_date->format('d M Y') }}</span>
                    </div>
                    @if($flightRequest->return_date)
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Return Date:</span>
                        <span class="text-ternary">{{ $flightRequest->return_date->format('d M Y') }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Trip Type:</span>
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm font-medium">
                            {{ ucfirst($flightRequest->trip_type) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Cabin Class:</span>
                        <span class="text-ternary">{{ $flightRequest->cabin_class }}</span>
                    </div>
                </div>
            </div>

            {{-- Passenger Information --}}
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h3 class="text-lg font-semibold text-ternary mb-4 border-b border-gray-300 pb-2">
                    <i class="fa fa-users mr-2 text-primary"></i>Passenger Information
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Adults:</span>
                        <span class="text-ternary">{{ $flightRequest->adults }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Children:</span>
                        <span class="text-ternary">{{ $flightRequest->children }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Infants:</span>
                        <span class="text-ternary">{{ $flightRequest->infants }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Total Passengers:</span>
                        <span class="text-ternary font-semibold">{{ $flightRequest->adults + $flightRequest->children + $flightRequest->infants }}</span>
                    </div>
                </div>
            </div>

            {{-- Preferences & Status --}}
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h3 class="text-lg font-semibold text-ternary mb-4 border-b border-gray-300 pb-2">
                    <i class="fa fa-cog mr-2 text-primary"></i>Preferences & Status
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Status:</span>
                        @php
                            $status = $flightRequest->status ?? 'Pending';
                            $statusColors = [
                                'Pending' => ['bg' => 'bg-yellow-200', 'text' => 'text-yellow-700'],
                                'Approved' => ['bg' => 'bg-green-200', 'text' => 'text-green-700'],
                                'Rejected' => ['bg' => 'bg-red-200', 'text' => 'text-red-700'],
                                'Completed' => ['bg' => 'bg-blue-200', 'text' => 'text-blue-700']
                            ];
                            $colors = $statusColors[$status] ?? ['bg' => 'bg-gray-200', 'text' => 'text-gray-700'];
                        @endphp
                        <span class="{{ $colors['bg'] }} {{ $colors['text'] }} px-3 py-1 rounded-full text-sm font-medium">
                            {{ ucfirst($status) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Currency:</span>
                        <span class="text-ternary">{{ $flightRequest->currency }}</span>
                    </div>
                    @if($flightRequest->preferred_airline)
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Preferred Airline:</span>
                        <span class="text-ternary">{{ $flightRequest->preferred_airline }}</span>
                    </div>
                    @endif
                    @if($flightRequest->budget_range)
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Budget Range:</span>
                        <span class="text-ternary">{{ $flightRequest->budget_range }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Direct Flight:</span>
                        <span class="text-ternary">{{ $flightRequest->direct_flight ? 'Yes' : 'No' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-600">Flexible Dates:</span>
                        <span class="text-ternary">{{ $flightRequest->flexi_dates ? 'Yes' : 'No' }}</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Special Requirements --}}
        @if($flightRequest->special_requirements)
        <div class="mt-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-ternary mb-4 border-b border-gray-300 pb-2">
                <i class="fa fa-clipboard-list mr-2 text-primary"></i>Special Requirements
            </h3>
            <p class="text-ternary">{{ $flightRequest->special_requirements }}</p>
        </div>
        @endif

        {{-- Request Information --}}
        <div class="mt-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-ternary mb-4 border-b border-gray-300 pb-2">
                <i class="fa fa-info-circle mr-2 text-primary"></i>Request Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex justify-between">
                    <span class="font-medium text-gray-600">Request Date:</span>
                    <span class="text-ternary">{{ $flightRequest->created_at->format('d M Y, h:i A') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-600">Last Updated:</span>
                    <span class="text-ternary">{{ $flightRequest->updated_at->format('d M Y, h:i A') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-600">Request ID:</span>
                    <span class="text-ternary font-mono">{{ $flightRequest->id }}</span>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-6 flex justify-center gap-4">
            <button onclick="updateStatus({{ $flightRequest->id }})" class="bg-primary text-white px-6 py-2 rounded-md hover:bg-primary/90 transition-colors">
                <i class="fa fa-edit mr-2"></i>Update Status
            </button>
            <a href="{{ route('flight.requests') }}" class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600 transition-colors">
                <i class="fa fa-arrow-left mr-2"></i>Back to List
            </a>
        </div>
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
                        <option value="pending" {{ $flightRequest->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $flightRequest->status == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $flightRequest->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="completed" {{ $flightRequest->status == 'completed' ? 'selected' : '' }}>Completed</option>
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
