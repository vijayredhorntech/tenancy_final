@php
    $permission = [];
    if ($bookingData && $bookingData->clientrequiremtsinfo && $bookingData->clientrequiremtsinfo->name_of_field) {
        $permission = json_decode($bookingData->clientrequiremtsinfo->name_of_field, true);
    }

    $alreadySelect = [];
    if($bookingData && $bookingData->clientrequiremtsinfo && $bookingData->clientrequiremtsinfo->section_name){
        $alreadySelect = json_decode($bookingData->clientrequiremtsinfo->section_name);
    }
@endphp

<!-- Main Form Content -->
<form action="{{ route('comfirm.application') }}" method="POST" id="confirmform" class="space-y-6">
    @csrf
    <input type="hidden" value="{{ $bookingData->id }}" name="bookingid">
    <input type="hidden" name="type" value="{{ $type ?? 'client' }}">

    <!-- Personal Details Section -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="personal">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-user-circle text-primary mr-2"></i>
                Personal Details
            </h2>
            <div class="flex items-center space-x-2">
                <button type="button" class="edit-section-btn bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition-colors" data-section="personal">
                    <i class="fas fa-edit mr-1"></i> Edit
                </button>
                <button type="button" class="save-section-btn bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition-colors hidden" data-section="personal">
                    <i class="fas fa-save mr-1"></i> Save
                </button>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- First Name -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                    <input type="text" name="first_name" value="{{ $bookingData->client->first_name ?? '' }}" 
                           class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required>
                </div>

                <!-- Last Name -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                    <input type="text" name="last_name" value="{{ $bookingData->client->last_name ?? '' }}" 
                           class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required>
                </div>

                <!-- Date of Birth -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth *</label>
                    <input type="date" name="date_of_birth" value="{{ $bookingData->client->date_of_birth ?? '' }}" 
                           class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required>
                </div>

                <!-- Gender -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gender *</label>
                    <select name="gender" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <option value="">Select Gender</option>
                        <option value="Male" {{ ($bookingData->client->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ ($bookingData->client->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ ($bookingData->client->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <!-- Nationality -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nationality *</label>
                    <input type="text" name="nationality" value="{{ $bookingData->client->nationality ?? '' }}" 
                           class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required>
                </div>

                <!-- Place of Birth -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth *</label>
                    <input type="text" name="place_of_birth" value="{{ $bookingData->client->place_of_birth ?? '' }}" 
                           class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required>
                </div>
            </div>
        </div>
    </div>

    <!-- Passport Details Section -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="passport">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-passport text-primary mr-2"></i>
                Passport Details
            </h2>
            <div class="flex items-center space-x-2">
                <button type="button" class="edit-section-btn bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition-colors" data-section="passport">
                    <i class="fas fa-edit mr-1"></i> Edit
                </button>
                <button type="button" class="save-section-btn bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition-colors hidden" data-section="passport">
                    <i class="fas fa-save mr-1"></i> Save
                </button>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Passport Number -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Passport Number *</label>
                    <input type="text" name="passport_number" value="{{ $bookingData->client->passport_number ?? '' }}" 
                           class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent uppercase" 
                           required>
                </div>

                <!-- Passport Issue Date -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Passport Issue Date *</label>
                    <input type="date" name="passport_issue_date" value="{{ $bookingData->client->passport_issue_date ?? '' }}" 
                           class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required>
                </div>

                <!-- Passport Expiry Date -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Passport Expiry Date *</label>
                    <input type="date" name="passport_expiry_date" value="{{ $bookingData->client->passport_expiry_date ?? '' }}" 
                           class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required>
                </div>

                <!-- Passport Issuing Authority -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Passport Issuing Authority *</label>
                    <input type="text" name="passport_issuing_authority" value="{{ $bookingData->client->passport_issuing_authority ?? '' }}" 
                           class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Details Section -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="contact">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-address-book text-primary mr-2"></i>
                Contact Details
            </h2>
            <div class="flex items-center space-x-2">
                <button type="button" class="edit-section-btn bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition-colors" data-section="contact">
                    <i class="fas fa-edit mr-1"></i> Edit
                </button>
                <button type="button" class="save-section-btn bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition-colors hidden" data-section="contact">
                    <i class="fas fa-save mr-1"></i> Save
                </button>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Email -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                    <input type="email" name="email" value="{{ $bookingData->client->email ?? '' }}" 
                           class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required>
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                    <input type="tel" name="phone" value="{{ $bookingData->client->phone ?? '' }}" 
                           class="form-input w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required>
                </div>

                <!-- Address -->
                <div class="form-group md:col-span-2 lg:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Address *</label>
                    <textarea name="address" rows="3" 
                              class="form-textarea w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                              required>{{ $bookingData->client->address ?? '' }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-center">
        <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <i class="fas fa-paper-plane mr-2"></i>
            Submit Application
        </button>
    </div>
</form>

<style>
    :root {
        --primary: #3B82F6;
        --secondary: #10B981;
        --ternary: #6B7280;
        --danger: #EF4444;
    }
    
    .text-primary { color: var(--primary) !important; }
    .text-secondary { color: var(--secondary) !important; }
    .text-ternary { color: var(--ternary) !important; }
    .text-danger { color: var(--danger) !important; }
    
    .bg-primary { background-color: var(--primary) !important; }
    .bg-secondary { background-color: var(--secondary) !important; }
    .bg-ternary { background-color: var(--ternary) !important; }
    .bg-danger { background-color: var(--danger) !important; }
    
    .border-primary { border-color: var(--primary) !important; }
    .border-secondary { border-color: var(--secondary) !important; }
    .border-ternary { border-color: var(--ternary) !important; }
    .border-danger { border-color: var(--danger) !important; }
    
    .from-primary { --tw-gradient-from: var(--primary) !important; }
    .to-secondary { --tw-gradient-to: var(--secondary) !important; }
    
    .hover\:bg-primary:hover { background-color: var(--primary) !important; }
    .hover\:bg-secondary:hover { background-color: var(--secondary) !important; }
    .hover\:text-primary:hover { color: var(--primary) !important; }
    .hover\:text-secondary:hover { color: var(--secondary) !important; }
    
    .focus\:border-primary:focus { border-color: var(--primary) !important; }
    .focus\:border-secondary:focus { border-color: var(--secondary) !important; }
    .focus\:ring-primary:focus { --tw-ring-color: var(--primary) !important; }
    .focus\:ring-secondary:focus { --tw-ring-color: var(--secondary) !important; }

    .form-input:disabled,
    .form-select:disabled,
    .form-textarea:disabled {
        background-color: #f3f4f6;
        cursor: not-allowed;
    }

    .section-container {
        transition: all 0.3s ease;
    }

    .edit-section-btn,
    .save-section-btn {
        transition: all 0.2s ease;
    }
</style>

<script>
$(document).ready(function() {
    // Edit section functionality
    $('.edit-section-btn').click(function() {
        const section = $(this).data('section');
        const container = $(`.section-container[data-section="${section}"]`);
        
        // Enable all form inputs in this section
        container.find('input, select, textarea').prop('disabled', false);
        
        // Show save button, hide edit button
        $(this).addClass('hidden');
        container.find('.save-section-btn').removeClass('hidden');
    });

    // Save section functionality
    $('.save-section-btn').click(function() {
        const section = $(this).data('section');
        const container = $(`.section-container[data-section="${section}"]`);
        
        // Disable all form inputs in this section
        container.find('input, select, textarea').prop('disabled', true);
        
        // Show edit button, hide save button
        $(this).addClass('hidden');
        container.find('.edit-section-btn').removeClass('hidden');
    });

    // Auto-resize textareas
    $('textarea').on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Uppercase input for passport number
    $('input[name="passport_number"]').on('input', function() {
        this.value = this.value.toUpperCase();
    });

    // Initially disable all form inputs
    $('input, select, textarea').prop('disabled', true);
});
</script>
