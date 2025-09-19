<x-agency.layout>
    @section('title')Adjustment History @endsection
    
    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
        
        {{-- Heading section --}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Invoice Adjustment History</span>
            <a href="{{ route('invoice.refund', ['type' => 'agencies']) }}" 
               class="bg-blue-500 text-white px-4 py-2 rounded text-sm font-medium hover:bg-blue-600 transition ease-in duration-200">
                Back to Refund Invoices
            </a>
        </div>
        
        {{-- Table section --}}
        <div class="w-full overflow-x-auto p-4">
            @if($adjustments->count() > 0)
                <table class="w-full border-[2px] border-secondary/40 border-collapse">
                    <thead>
                        <tr>
                            <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Adjustment Number</th>
                            <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Original Invoice</th>
                            <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Original Amount</th>
                            <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Selected Application</th>
                            <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Client Name</th>
                            <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Application Amount</th>
                            <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Processed By</th>
                            <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Adjustment Date</th>
                            <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Status</th>
                            <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($adjustments as $adjustment)
                            <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-200">
                                <!-- Adjustment Number -->
                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                    {{ $adjustment->adjustment_number }}
                                </td>
                                
                                <!-- Original Invoice -->
                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                    {{ $adjustment->original_invoice_number }}
                                </td>
                                
                                <!-- Original Amount -->
                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                    {{ $adjustment->formatted_original_amount }}
                                </td>
                                
                                <!-- Selected Application -->
                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                    {{ $adjustment->selected_application_number ?? 'N/A' }}
                                </td>
                                
                                <!-- Client Name -->
                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm uppercase">
                                    {{ $adjustment->selected_client_name ?? 'N/A' }}
                                </td>
                                
                                <!-- Application Amount -->
                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                    {{ $adjustment->formatted_selected_application_amount ?? 'N/A' }}
                                </td>
                                
                                <!-- Processed By -->
                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                    {{ $adjustment->processed_by ?? 'N/A' }}
                                    @if($adjustment->processedByUser)
                                        <br><small class="text-gray-500">({{ $adjustment->processedByUser->name }})</small>
                                    @endif
                                </td>
                                
                                <!-- Adjustment Date -->
                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                    {{ $adjustment->adjustment_date->format('Y-m-d H:i') }}
                                </td>
                                
                                <!-- Status -->
                                <td class="border-[2px] border-secondary/40 px-4 py-1">
                                    @if($adjustment->status === 'completed')
                                        <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-sm font-medium">
                                            Completed
                                        </span>
                                    @elseif($adjustment->status === 'pending')
                                        <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded text-sm font-medium">
                                            Pending
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-sm font-medium">
                                            Cancelled
                                        </span>
                                    @endif
                                </td>
                                
                                <!-- Action -->
                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                    <button onclick="viewAdjustmentDetails({{ $adjustment->id }})" 
                                            class="bg-blue-500 text-white px-3 py-1 rounded text-sm font-medium hover:bg-blue-600 transition ease-in duration-200">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $adjustments->links() }}
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-gray-500 text-lg">No adjustment records found.</div>
                    <p class="text-gray-400 mt-2">Adjustment records will appear here once you process invoice adjustments.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Adjustment Details Modal -->
    <div id="adjustmentDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <!-- Modal Header -->
                <div class="bg-blue-500 text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
                    <h3 class="text-lg font-semibold">Adjustment Details</h3>
                    <button onclick="closeAdjustmentDetailsModal()" class="text-white hover:text-gray-200 text-xl font-bold">
                        ×
                    </button>
                </div>
                
                <!-- Modal Body -->
                <div class="p-6" id="adjustmentDetailsContent">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>

    <script>
        function viewAdjustmentDetails(adjustmentId) {
            // Show modal
            document.getElementById('adjustmentDetailsModal').classList.remove('hidden');
            
            // Load adjustment details
            const contentDiv = document.getElementById('adjustmentDetailsContent');
            contentDiv.innerHTML = '<div class="text-center py-4">Loading...</div>';
            
            // Find adjustment data from the current page
            const adjustments = @json($adjustments->items());
            const adjustment = adjustments.find(adj => adj.id === adjustmentId);
            
            if (adjustment) {
                contentDiv.innerHTML = `
                    <div class="space-y-6">
                        <!-- Basic Information -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-700 mb-4">Basic Information</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Adjustment Number</label>
                                    <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-700">
                                        ${adjustment.adjustment_number}
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Adjustment Type</label>
                                    <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-700">
                                        ${adjustment.adjustment_type.replace('_', ' ').toUpperCase()}
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Original Invoice Number</label>
                                    <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-700">
                                        ${adjustment.original_invoice_number}
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <div class="w-full px-3 py-2 border border-gray-300 rounded-md ${adjustment.status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'}">
                                        ${adjustment.status.toUpperCase()}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Amount Information -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-700 mb-4">Amount Information</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Original Amount</label>
                                    <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-700">
                                        ${adjustment.formatted_original_amount}
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Adjusted Amount</label>
                                    <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-700">
                                        ${adjustment.formatted_adjusted_amount}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Selected Application Information -->
                        ${adjustment.selected_application_number ? `
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-700 mb-4">Selected Application Information</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Application Number</label>
                                    <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-700">
                                        ${adjustment.selected_application_number}
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Client Name</label>
                                    <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-700">
                                        ${adjustment.selected_client_name}
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Application Amount</label>
                                    <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-700">
                                        ${adjustment.formatted_selected_application_amount}
                                    </div>
                                </div>
                            </div>
                        </div>
                        ` : ''}

                        <!-- Processing Information -->
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-700 mb-4">Processing Information</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Processed By</label>
                                    <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-700">
                                        ${adjustment.processed_by || 'N/A'}
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Adjustment Date</label>
                                    <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-700">
                                        ${new Date(adjustment.adjustment_date).toLocaleString()}
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Internal Notes</label>
                                    <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-700 min-h-[60px]">
                                        ${adjustment.internal_notes || 'No additional notes'}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
        }

        function closeAdjustmentDetailsModal() {
            document.getElementById('adjustmentDetailsModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('adjustmentDetailsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAdjustmentDetailsModal();
            }
        });
    </script>
</x-agency.layout>
