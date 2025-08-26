<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
    <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20">
        <span class="font-semibold text-ternary text-xl">Fill Visa Application</span>
        <p class="text-sm text-ternary/70 mt-1">Complete your visa application details below. Agency will review and send to admin.</p>
    </div>

    <div class="w-full p-4">
        <form id="clientApplicationForm" class="space-y-6">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $bookingData->id }}">
            
            <!-- Personal Information -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-ternary mb-4">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-ternary mb-2">First Name</label>
                        <input type="text" name="first_name" value="{{ $bookingData->clint->first_name ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ternary mb-2">Last Name</label>
                        <input type="text" name="last_name" value="{{ $bookingData->clint->last_name ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ternary mb-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ $bookingData->clint->date_of_birth ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ternary mb-2">Gender</label>
                        <select name="gender" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ ($bookingData->clint->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ ($bookingData->clint->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ ($bookingData->clint->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ternary mb-2">Marital Status</label>
                        <select name="marital_status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                            <option value="">Select Status</option>
                            <option value="Single" {{ ($bookingData->clint->marital_status ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ ($bookingData->clint->marital_status ?? '') == 'Married' ? 'selected' : '' }}>Married</option>
                            <option value="Divorced" {{ ($bookingData->clint->marital_status ?? '') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                            <option value="Widowed" {{ ($bookingData->clint->marital_status ?? '') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-ternary mb-4">Contact Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-ternary mb-2">Email</label>
                        <input type="email" name="email" value="{{ $bookingData->clint->email ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ternary mb-2">Phone Number</label>
                        <input type="tel" name="phone_number" value="{{ $bookingData->clint->phone_number ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-ternary mb-2">Permanent Address</label>
                        <textarea name="permanent_address" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">{{ $bookingData->clint->permanent_address ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Passport Information -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-ternary mb-4">Passport Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-ternary mb-2">Passport Number</label>
                        <input type="text" name="passport_number" value="{{ $bookingData->clientinfo->passport_ic_number ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ternary mb-2">Place of Issue</label>
                        <input type="text" name="passport_issue_place" value="{{ $bookingData->clientinfo->passport_issue_place ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ternary mb-2">Date of Issue</label>
                        <input type="date" name="passport_issue_date" value="{{ $bookingData->clientinfo->passport_issue_date ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ternary mb-2">Date of Expiry</label>
                        <input type="date" name="passport_expiry_date" value="{{ $bookingData->clientinfo->passport_expiry_date ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-ternary mb-4">Additional Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-ternary mb-2">Religion</label>
                        <input type="text" name="religion" value="{{ $bookingData->clientinfo->religion ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-ternary mb-2">Nationality</label>
                        <input type="text" name="nationality" value="{{ $bookingData->clientinfo->past_nationality ?? '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="resetForm()" 
                        class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition duration-200">
                    Reset Form
                </button>
                <button type="submit" 
                        class="px-6 py-2 bg-primary text-white rounded-md hover:bg-primary/90 transition duration-200">
                    Submit Application
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('clientApplicationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const applicationData = {};
    
    // Convert form data to structured format
    for (let [key, value] of formData.entries()) {
        if (key === 'booking_id') continue;
        
        if (['first_name', 'last_name', 'date_of_birth', 'gender', 'marital_status', 'email', 'phone_number', 'permanent_address'].includes(key)) {
            if (!applicationData.client_details) applicationData.client_details = {};
            applicationData.client_details[key] = value;
        } else if (['passport_number', 'passport_issue_place', 'passport_issue_date', 'passport_expiry_date', 'religion', 'nationality'].includes(key)) {
            if (!applicationData.passport_details) applicationData.passport_details = {};
            applicationData.passport_details[key] = value;
        }
    }
    
    // Add booking ID
    applicationData.booking_id = formData.get('booking_id');
    
    // Submit the application
    submitApplication(applicationData);
});

function submitApplication(data) {
    fetch('{{ route("client.submit.application") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            window.location.href = data.redirect;
        } else {
            alert('Error: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while submitting the application.');
    });
}

function resetForm() {
    document.getElementById('clientApplicationForm').reset();
}
</script>
