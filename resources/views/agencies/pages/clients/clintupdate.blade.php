<x-agency.layout>
    @section('title')Client @endsection





        <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

            {{-- === Heading Section === --}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Edit Client Details</span>
            </div>
            {{-- === heading section code ends here===--}}

            {{-- Display Validation Errors --}}
            @if ($errors->any())
                <div class="mx-4 mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Validation Error!</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Display Success Message --}}
            @if (session('success'))
                <div class="mx-4 mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- === Form Section === --}}
            <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 p-4">

                <form action="{{ isset($client) ? route('updateclient.store', $client->id) : route('client.store') }}" method="POST" enctype="multipart/form-data" id="multiStepForm">
                    @csrf
                 

                    {{-- Step 1: Personal Information --}}
                    <div class="form-step active" data-step="1">
                        <div class="w-full flex flex-col gap-2 px-4 mt-4">

                            <div class="w-full grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4">
                                <div class="w-full relative group flex flex-col gap-1">
                                    <input type="hidden" name="agency_id" id="agency_id" value="{{ $agency->id }}" readonly>
                                    <input type="hidden" name="clint_id" id="client_id" value="{{ $client->id}}" readonly>
                                  
                                    <label for="first_name" class="font-semibold text-ternary/90 text-sm">First Name *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="first_name" id="first_name" required
                                            value="{{ old('first_name', $client->first_name ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('first_name') border-red-500 @enderror">
                                        <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('first_name')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="last_name" class="font-semibold text-ternary/90 text-sm">Last Name *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="last_name" id="last_name" required
                                            value="{{ old('last_name', $client->last_name ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('last_name') border-red-500 @enderror">
                                        <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('last_name')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="nationality" class="font-semibold text-ternary/90 text-sm">Nationality *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="nationality" id="nationality" required
                                            value="{{ old('nationality', $client->clientInfo->nationality ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('nationality') border-red-500 @enderror">
                                        <i class="fa fa-flag absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('nationality')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="passport_no" class="font-semibold text-ternary/90 text-sm">Passport Number</label>
                                    <div class="w-full relative">
                                        <input type="text" name="passport_no" id="passport_no"
                                            value="{{ old('passport_no', $client->passport_no ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-passport absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('passport_no')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="date_of_birth" class="font-semibold text-ternary/90 text-sm">Date of Birth</label>
                                    <div class="w-full relative">
                                        <input type="date" name="date_of_birth" id="date_of_birth"
                                            value="{{ old('date_of_birth', $client->date_of_birth ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-calendar absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('date_of_birth')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="date_of_issue" class="font-semibold text-ternary/90 text-sm">Date of Issue</label>
                                    <div class="w-full relative">
                                        <input type="date" name="date_of_issue" id="date_of_issue"
                                            value="{{ old('date_of_issue', $client->date_of_issue ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-calendar-check absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('date_of_issue')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="date_of_expire" class="font-semibold text-ternary/90 text-sm">Date of Expiry</label>
                                    <div class="w-full relative">
                                        <input type="date" name="date_of_expire" id="date_of_expire"
                                            value="{{ old('date_of_expire', $client->date_of_expire ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-calendar-times absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('date_of_expire')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="phone_number" class="font-semibold text-ternary/90 text-sm">Phone Number *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="phone_number" id="phone_number" required
                                            value="{{ old('phone_number', $client->phone_number ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('phone_number') border-red-500 @enderror">
                                        <i class="fa fa-phone-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('phone_number')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="zip_code" class="font-semibold text-ternary/90 text-sm">Zip/Postal Code</label>
                                    <div class="w-full relative flex items-center gap-2">
                                        <input type="text" name="zip_code" id="zip_code"
                                            value="{{ old('zip_code', $client->zip_code ?? '') }}"
                                            class="w-full pl-2 pr-2 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <button type="button" id="searchAddress"
                                            class="px-3 py-1 bg-secondary text-white rounded hover:bg-secondary/80">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="w-full mt-2 hidden" id="address-wrapper">
                                    <label for="address-select" class="text-sm font-semibold text-ternary/90">Select Address</label>
                                    <select id="address-select" name="address"
                                        class="w-full px-2 py-1 border border-secondary/40 rounded focus:outline-none focus:border-secondary/70">
                                    </select>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1 col-span-3">
                                    <label for="permanent_address" class="font-semibold text-ternary/90 text-sm">Permanent Address *</label>
                                    <div class="w-full relative">
                                        <textarea name="permanent_address" id="permanent_address" required
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                @error('permanent_address') border-red-500 @enderror">{{ old('permanent_address', $client->permanent_address ?? '') }}</textarea>
                                        <i class="fa fa-home absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                    @error('permanent_address')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="street" class="font-semibold text-ternary/90 text-sm">Street</label>
                                    <div class="w-full relative">
                                        <input type="text" name="street" id="street"
                                            value="{{ old('street', $client->street ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-road absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="city" class="font-semibold text-ternary/90 text-sm">City *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="city" id="city" required
                                            value="{{ old('city', $client->city ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('city') border-red-500 @enderror">
                                        <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('city')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="place_of_issue" class="font-semibold text-ternary/90 text-sm">Place of Issue</label>
                                    <div class="w-full relative">
                                        <input type="text" name="place_of_issue" id="place_of_issue"
                                            value="{{ old('place_of_issue', $client->place_of_issue ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-map-marker absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('place_of_issue')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="country" class="font-semibold text-ternary/90 text-sm">Country *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="country" id="country" required
                                            value="{{ old('country', $client->country ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('country') border-red-500 @enderror">
                                        <i class="fa fa-globe-americas absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('country')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>  
                        </div>

                        {{-- Family Members / Dependents Section --}}
                            <div class="w-full flex flex-col gap-2 px-4 mt-8">
                                <div class="border-b-[2px] border-b-secondary/50 w-max pr-20 flex items-center justify-between">
                                    <span class="text-lg font-bold text-ternary">Family Members / Dependents</span>
                                </div>
                                <p class="text-sm text-gray-600 mb-4">Add family members or dependents who will be traveling with the main applicant.</p>

                                <div class="w-full flex justify-start mb-4">
                                    <button type="button" id="addFamilyMemberBtn"
                                        class="px-4 py-2 text-sm font-semibold rounded-[3px] rounded-tr-[8px] border-[1px] border-success text-success bg-success/10 hover:bg-success hover:text-white transition ease-in duration-200">
                                        <i class="fa fa-plus mr-2"></i>Add Family Member
                                    </button>
                                </div>

                                {{-- Dynamic Family Members Container --}}
                                <div id="familyMembersContainer">
                                    {{-- Existing family members will be populated here --}}
                                </div>
                            </div>

                        <div class="w-full flex justify-between px-4 pb-4 gap-2 mt-8">
                            <a href="{{ route('client.index') }}" 
                                class="text-sm bg-gray-300 px-4 py-2 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-gray-400 text-ternary hover:text-white hover:bg-gray-500 hover:border-gray-600 transition ease-in duration-200">
                                <i class="fa fa-times mr-1"></i> Cancel
                            </a>
                            <button type="submit" 
                                class="text-sm bg-success/30 px-4 py-2 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-200">
                                <i class="fa fa-check mr-1"></i> Update Client Details
                            </button>
                        </div>
</div>
                    </div>




                  
                    </div>
                </form>
            </div>
            {{-- === form section code ends here===--}}
        </div>
        @php
            $familyMembersData = isset($client)
                ? $client->familyMembers()->orderBy('created_at')->get()->map(function ($member) {
                    return [
                        'id' => $member->id,
                        'first_name' => $member->first_name,
                        'last_name' => $member->last_name,
                        'relationship' => $member->relationship,
                        'date_of_birth' => $member->date_of_birth ? \Carbon\Carbon::parse($member->date_of_birth)->format('Y-m-d') : null,
                        'nationality' => $member->nationality,
                        'passport_number' => $member->passport_number,
                        'email_address' => $member->email_address,
                        'phone_number' => $member->phone_number,
                    ];
                })->values()
                : collect();
        @endphp

        <script>
           $(document).ready(function () {
                    $("#searchAddress").on("click", function (e) {
                        e.preventDefault();

                        const postcode = $("#zip_code").val().trim();

                        if (!postcode) {
                            alert("Please enter a postcode.");
                            return;
                        }

                        $.ajax({
                            url: `https://api.getaddress.io/find/${postcode}?api-key=uz1Ks6ukRke3TO_XZBrjeA22850&expand=true&sort=true`,
                            method: "GET",
                            dataType: "json",
                            success: function (response) {
                                const select = $('#address-select');
                                const wrapper = $('#address-wrapper');
                                select.empty();

                                if (response && response.addresses && response.addresses.length > 0) {
                                    select.append(`<option value="">Select an address</option>`);

                                    response.addresses.forEach((address) => {
                                        const labelText = address.formatted_address.filter(Boolean).join(', ');
                                        const option = $(`
                                            <option value="${labelText}"
                                                    data-street="${address.line_1 || ''}${address.line_2 ? ', ' + address.line_2 : ''}"
                                                    data-county="${address.county || ''}"
                                                    data-city="${address.town_or_city || ''}"
                                                    data-country="${address.country || ''}">
                                                ${labelText}
                                            </option>
                                        `);
                                        select.append(option);
                                    });

                                    wrapper.removeClass('hidden');
                                } else {
                                    wrapper.addClass('hidden');
                                    alert("Invalid postcode or no addresses found.");
                                }
                            },
                            error: function () {
                                alert("Could not fetch postcode data. Please try again.");
                            }
                        });
                    });

                    $("#address-select").on("change", function () {
                        const selected = $(this).find(":selected");

                        $("#permanent_address").val(selected.val() || "");
                        $("#street").val(selected.data("street") || "");
                        $("#city").val(selected.data("city") || "");
                        $("#country").val(selected.data("country") || "");
                    });
                });
//  address 
                        document.addEventListener('DOMContentLoaded', function() {
                    // Navigation between steps
                    const form = document.getElementById('multiStepForm');
                    const nextButtons = form.querySelectorAll('.next-step');
                    const prevButtons = form.querySelectorAll('.prev-step');
                    const formSteps = form.querySelectorAll('.form-step');
                    const stepIndicators = document.querySelectorAll('.step-indicator');
                    
                    // Initialize first step as active
                    let currentStep = 1;
                    const totalSteps = formSteps.length;
                    
                    // Next button click handler
                    nextButtons.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();
                            
                            // Validate current step before proceeding
                            if (validateStep(currentStep)) {
                                // Hide current step and remove active class
                                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
                                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('hidden');
                                
                                // Show next step and add active class
                                currentStep++;
                                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('hidden');
                                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('active');
                                
                                // Update progress indicators
                                updateStepIndicators(currentStep);
                            }
                        });
                    });
                    
                    // Previous button click handler
                    prevButtons.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();
                            
                            // Hide current step and remove active class
                            document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
                            document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('hidden');
                            
                            // Show previous step and add active class
                            currentStep--;
                            document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('hidden');
                            document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('active');
                            
                            // Update progress indicators
                            updateStepIndicators(currentStep);
                        });
                    });
                    
                    // Step indicator click handler
                    stepIndicators.forEach(indicator => {
                        indicator.addEventListener('click', function() {
                            const step = parseInt(this.getAttribute('data-step'));
                            
                            // Only allow navigation to steps that come before the current step
                            if (step < currentStep) {
                                // Hide current step and remove active class
                                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
                                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('hidden');
                                
                                // Show selected step and add active class
                                currentStep = step;
                                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('hidden');
                                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('active');
                                
                                // Update progress indicators
                                updateStepIndicators(currentStep);
                            }
                        });
                    });
                    
                    // Function to update step indicators
                    function updateStepIndicators(step) {
                        stepIndicators.forEach(indicator => {
                            const indicatorStep = parseInt(indicator.getAttribute('data-step'));
                            
                            // Remove all active/completed classes first
                            indicator.classList.remove('active', 'completed');
                            
                            if (indicatorStep < step) {
                                indicator.classList.add('completed');
                            } else if (indicatorStep === step) {
                                indicator.classList.add('active');
                            }
                        });
                    }
                    
                    // Function to validate current step
                    function validateStep(step) {
                        let isValid = true;
                        const currentStepElement = document.querySelector(`.form-step[data-step="${step}"]`);
                        
                        // Remove all existing error messages first
                        currentStepElement.querySelectorAll('.text-red-500').forEach(el => {
                            if (el.classList.contains('text-red-500')) {
                                el.remove();
                            }
                        });
                        
                        // Check all required fields in current step
                        const requiredFields = currentStepElement.querySelectorAll('[required]');
                        requiredFields.forEach(field => {
                            field.classList.remove('border-red-500');
                            
                            if (!field.value.trim()) {
                                field.classList.add('border-red-500');
                                isValid = false;
                                
                                // Add error message
                                const errorSpan = document.createElement('span');
                                errorSpan.className = 'text-red-500 text-xs mt-1 block';
                                errorSpan.textContent = 'This field is required';
                                field.closest('.group').appendChild(errorSpan);
                            }
                        });
                        
                        // Additional validation for specific fields
                        if (step === 2) {
                            // Validate email format
                            const emailField = document.getElementById('email');
                            if (emailField && emailField.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailField.value)) {
                                emailField.classList.add('border-red-500');
                                isValid = false;
                                
                                const errorSpan = document.createElement('span');
                                errorSpan.className = 'text-red-500 text-xs mt-1 block';
                                errorSpan.textContent = 'Please enter a valid email address';
                                emailField.closest('.group').appendChild(errorSpan);
                            }
                        }
                        
                        return isValid;
                    }
                });

                (function () {
                    const existingFamilyMembers = @json($familyMembersData);
                    const container = document.getElementById('familyMembersContainer');
                    const addFamilyMemberBtn = document.getElementById('addFamilyMemberBtn');

                    if (!container) {
                        return;
                    }

                    if (addFamilyMemberBtn) {
                        addFamilyMemberBtn.addEventListener('click', function () {
                            const nextIndex = container.querySelectorAll('.family-member-section').length + 1;
                            const wrapper = buildFamilyMemberSection(nextIndex);
                            container.appendChild(wrapper);
                            updateFamilyMemberNumbers();
                        });
                    }

                    function buildFamilyMemberSection(memberNumber, memberData = {}, existingId = null) {
                        const wrapper = document.createElement('div');
                        wrapper.classList.add('family-member-section', 'border-[1px]', 'border-secondary/30', 'rounded-md', 'p-4', 'mb-4', 'bg-gray-50');
                        wrapper.dataset.memberIndex = memberNumber;

                        const headerDiv = document.createElement('div');
                        headerDiv.classList.add('flex', 'justify-between', 'items-center', 'mb-4', 'pb-2', 'border-b', 'border-secondary/20');

                        const headerTitle = document.createElement('h4');
                        headerTitle.classList.add('text-md', 'font-semibold', 'text-ternary');
                        headerTitle.textContent = `Family Member ${memberNumber}`;

                        const removeBtn = document.createElement('button');
                        removeBtn.type = 'button';
                        removeBtn.classList.add('px-3', 'py-1', 'text-xs', 'font-semibold', 'rounded-sm', 'border-[1px]', 'border-red-500', 'text-red-500', 'bg-red-500/10', 'hover:bg-red-500', 'hover:text-white', 'transition', 'ease-in', 'duration-200');
                        removeBtn.innerHTML = '<i class="fa fa-trash mr-1"></i>Remove';
                        removeBtn.addEventListener('click', function () {
                            wrapper.remove();
                            updateFamilyMemberNumbers();
                        });

                        headerDiv.appendChild(headerTitle);
                        headerDiv.appendChild(removeBtn);

                        const hiddenIdInput = document.createElement('input');
                        hiddenIdInput.type = 'hidden';
                        hiddenIdInput.dataset.baseName = 'family_member_ids';
                        hiddenIdInput.name = `family_member_ids[${memberNumber}]`;
                        hiddenIdInput.value = existingId ? existingId : '';

                        const gridContainer = document.createElement('div');
                        gridContainer.classList.add('w-full', 'grid', 'xl:grid-cols-3', 'lg:grid-cols-3', 'md:grid-cols-2', 'sm:grid-cols-2', 'grid-cols-1', 'gap-4');

                        const firstNameDiv = createFormField('text', 'family_first_name', memberNumber, 'First Name', 'fa-user', true, memberData.first_name || '');
                        const lastNameDiv = createFormField('text', 'family_last_name', memberNumber, 'Last Name', 'fa-user', true, memberData.last_name || '');
                        const relationshipDiv = createSelectField('family_relationship', memberNumber, 'Relationship', [
                            { value: '', text: 'Select Relationship' },
                            { value: 'spouse', text: 'Spouse' },
                            { value: 'child', text: 'Child' },
                            { value: 'parent', text: 'Parent' },
                            { value: 'sibling', text: 'Sibling' },
                            { value: 'other', text: 'Other' }
                        ], 'fa-users', true, memberData.relationship || '');
                        const dobDiv = createFormField('date', 'family_date_of_birth', memberNumber, 'Date of Birth', 'fa-calendar', true, memberData.date_of_birth || '');
                        const nationalityDiv = createFormField('text', 'family_nationality', memberNumber, 'Nationality', 'fa-flag', true, memberData.nationality || '');
                        const passportDiv = createFormField('text', 'family_passport_number', memberNumber, 'Passport Number', 'fa-passport', false, memberData.passport_number || '');
                        const emailDiv = createFormField('email', 'family_email', memberNumber, 'Email Address', 'fa-envelope', false, memberData.email_address || '');
                        const phoneDiv = createFormField('text', 'family_phone', memberNumber, 'Phone Number', 'fa-phone', false, memberData.phone_number || '');

                        gridContainer.appendChild(firstNameDiv);
                        gridContainer.appendChild(lastNameDiv);
                        gridContainer.appendChild(relationshipDiv);
                        gridContainer.appendChild(dobDiv);
                        gridContainer.appendChild(nationalityDiv);
                        gridContainer.appendChild(passportDiv);
                        gridContainer.appendChild(emailDiv);
                        gridContainer.appendChild(phoneDiv);

                        wrapper.appendChild(headerDiv);
                        wrapper.appendChild(hiddenIdInput);
                        wrapper.appendChild(gridContainer);

                        return wrapper;
                    }

                    function createFormField(type, baseName, memberNumber, label, icon, required = false, value = '') {
                        const fieldDiv = document.createElement('div');
                        fieldDiv.classList.add('w-full', 'relative', 'group', 'flex', 'flex-col', 'gap-1');

                        const labelElement = document.createElement('label');
                        labelElement.classList.add('font-semibold', 'text-ternary/90', 'text-sm');
                        labelElement.textContent = label + (required ? ' *' : '');

                        const inputWrapper = document.createElement('div');
                        inputWrapper.classList.add('w-full', 'relative');

                        const inputElement = document.createElement('input');
                        inputElement.type = type;
                        inputElement.value = value || '';
                        inputElement.classList.add('w-full', 'pl-2', 'pr-8', 'py-1', 'rounded-[3px]', 'rounded-tr-[8px]', 'border-[1px]', 'border-b-[2px]', 'border-r-[2px]', 'border-secondary/40', 'focus:outline-none', 'focus:ring-0', 'focus:border-secondary/70', 'placeholder-ternary/70', 'transition', 'ease-in', 'duration-200');
                        setFieldMetadata(inputElement, baseName, memberNumber, required);

                        const iconElement = document.createElement('i');
                        iconElement.classList.add('fa', icon, 'absolute', 'right-3', 'top-[50%]', 'translate-y-[-50%]', 'text-sm', 'text-secondary/80');

                        inputWrapper.appendChild(inputElement);
                        inputWrapper.appendChild(iconElement);

                        fieldDiv.appendChild(labelElement);
                        fieldDiv.appendChild(inputWrapper);

                        return fieldDiv;
                    }

                    function createSelectField(baseName, memberNumber, label, options, icon, required = false, value = '') {
                        const fieldDiv = document.createElement('div');
                        fieldDiv.classList.add('w-full', 'relative', 'group', 'flex', 'flex-col', 'gap-1');

                        const labelElement = document.createElement('label');
                        labelElement.classList.add('font-semibold', 'text-ternary/90', 'text-sm');
                        labelElement.textContent = label + (required ? ' *' : '');

                        const inputWrapper = document.createElement('div');
                        inputWrapper.classList.add('w-full', 'relative');

                        const selectElement = document.createElement('select');
                        selectElement.classList.add('w-full', 'pl-2', 'pr-8', 'py-1', 'rounded-[3px]', 'rounded-tr-[8px]', 'border-[1px]', 'border-b-[2px]', 'border-r-[2px]', 'border-secondary/40', 'focus:outline-none', 'focus:ring-0', 'focus:border-secondary/70', 'placeholder-ternary/70', 'transition', 'ease-in', 'duration-200');
                        options.forEach(option => {
                            const optionElement = document.createElement('option');
                            optionElement.value = option.value;
                            optionElement.textContent = option.text;
                            selectElement.appendChild(optionElement);
                        });
                        selectElement.value = value || '';
                        setFieldMetadata(selectElement, baseName, memberNumber, required);

                        const iconElement = document.createElement('i');
                        iconElement.classList.add('fa', icon, 'absolute', 'right-3', 'top-[50%]', 'translate-y-[-50%]', 'text-sm', 'text-secondary/80');

                        inputWrapper.appendChild(selectElement);
                        inputWrapper.appendChild(iconElement);

                        fieldDiv.appendChild(labelElement);
                        fieldDiv.appendChild(inputWrapper);

                        return fieldDiv;
                    }

                    function setFieldMetadata(element, baseName, memberNumber, required) {
                        const fieldName = `${baseName}[${memberNumber}]`;
                        element.name = fieldName;
                        element.id = `${baseName}_${memberNumber}`;
                        element.dataset.baseName = baseName;
                        if (required) {
                            element.setAttribute('required', 'required');
                        }
                    }

                    function updateFamilyMemberNumbers() {
                        const familyMembers = container.querySelectorAll('.family-member-section');
                        familyMembers.forEach((member, index) => {
                            const headerTitle = member.querySelector('h4');
                            const memberNumber = index + 1;
                            member.dataset.memberIndex = memberNumber;
                            if (headerTitle) {
                                headerTitle.textContent = `Family Member ${memberNumber}`;
                            }

                            const fields = member.querySelectorAll('input, select');
                            fields.forEach(field => {
                                const baseName = field.dataset.baseName;
                                if (!baseName) {
                                    return;
                                }
                                const isRequired = field.hasAttribute('required');
                                field.name = `${baseName}[${memberNumber}]`;
                                field.id = `${baseName}_${memberNumber}`;
                                if (isRequired) {
                                    field.setAttribute('required', 'required');
                                }
                            });
                        });
                    }

                    existingFamilyMembers.forEach((member, index) => {
                        const wrapper = buildFamilyMemberSection(index + 1, member, member.id);
                        container.appendChild(wrapper);
                    });

                    updateFamilyMemberNumbers();
                })();

    </script>
    <style>
        .step-indicator {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #e2e8f0;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }
        
        .step-label {
            font-size: 12px;
            color: #64748b;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .step-connector {
            height: 2px;
            width: 40px;
            background-color: #e2e8f0;
            margin: 0 5px;
        }
        
        .step-indicator.active .step-number {
            background-color: #3b82f6;
            color: white;
        }
        
        .step-indicator.active .step-label {
            color: #3b82f6;
            font-weight: 600;
        }
        
        .step-indicator.completed .step-number {
            background-color: #10b981;
            color: white;
        }
        
        .step-indicator.completed .step-label {
            color: #10b981;
        }
        
        .form-step {
            display: none;
        }
        
        .form-step.active {
            display: block;
        }
    </style>
</x-agency.layout>