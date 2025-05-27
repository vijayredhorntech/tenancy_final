
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <!-- Include your Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
<div class="w-full relative">
    <img class="absolute -top-20 left-0 w-full opacity-20" style="z-index: -1" src="{{asset('assets/images/bgImage.png')}}" alt="">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Application Header -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-primary to-secondary p-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-white">Visa Application Form</h1>
                        <div class="flex items-center mt-2 text-white/90">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm">Submitted on {{ $bookingData->created_at ? $bookingData->created_at->format('d M Y, h:i A') : 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white border border-white/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Application in Progress
                            </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Form Content -->
        <form action="{{ route('comfirm.application') }}" method="POST" id="confirmform" class="space-y-6">
            @csrf
            <input type="hidden" value="{{ $bookingData->id }}" name="bookingid">
            <input type="hidden" name="type" value="{{ $type ?? 'agency' }}">

            <!-- Personal Details Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="personal">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-user-circle text-primary mr-2"></i>
                        Personal Details
                    </h2>
                    <button type="button" class=" text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="personal">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- First Name -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="first_name" class="font-semibold text-ternary/90 text-sm">First Name <span class="text-danger">*</span></label>
                            <div class="w-full relative">
                                <input type="text" name="first_name" id="first_name"
                                       value="{{ $bookingData->clint->first_name ?? '' }}"
                                       required class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-user absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="last_name" class="font-semibold text-ternary/90 text-sm">Last Name</label>
                            <div class="w-full relative">
                                <input type="text" name="last_name" id="last_name"
                                       value="{{ $bookingData->clint->last_name ?? '' }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-user absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Previous Name -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label class="font-semibold text-ternary/90 text-sm">Previous Name (if any)</label>
                            <div class="w-full relative">
                                <input type="text"  name="previous_name" id="previous_name"
                                value="{{ $bookingData->clint->clientinfo->previous_name ?? '' }}"
                                 class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-history absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="email" class="font-semibold text-ternary/90 text-sm">Email Address <span class="text-danger">*</span></label>
                            <div class="w-full relative">
                                <input type="email" name="email" id="email"
                                       value="{{ $bookingData->clint->email ?? '' }}"
                                       required class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-envelope absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="phone_number" class="font-semibold text-ternary/90 text-sm">Phone Number</label>
                            <div class="w-full relative">
                                <input type="tel" name="phone_number" id="phone_number"
                                       value="{{ $bookingData->clint->phone_number ?? '' }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-phone absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="gender" class="font-semibold text-ternary/90 text-sm">Gender <span class="text-danger">*</span></label>
                            <div class="w-full relative">
                                <select name="gender" id="gender" required
                                        class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200 appearance-none bg-white">
                                    <option value="MALE" {{ old('gender', $bookingData->clint->gender) == 'MALE' ? 'selected' : '' }}>Male</option>
                                    <option value="FEMALE" {{ old('gender', $bookingData->clint->gender) == 'FEMALE' ? 'selected' : '' }}>Female</option>
                                    <option value="OTHER" {{ old('gender', $bookingData->clint->gender) == 'OTHER' ? 'selected' : '' }}>Other</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                            </div>
                        </div>

                        <!-- Marital Status -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="marital_status" class="font-semibold text-ternary/90 text-sm">Marital Status</label>
                            <div class="w-full relative">
                                <select name="marital_status" id="marital_status"
                                        class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200 appearance-none bg-white">
                                    <option value="single" {{ old('marital_status', $bookingData->clint->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
                                    <option value="married" {{ old('marital_status', $bookingData->clint->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
                                    <option value="divorced" {{ old('marital_status', $bookingData->clint->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                    <option value="widowed" {{ old('marital_status', $bookingData->clint->marital_status) == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                            </div>
                        </div>

                        <!-- Mobile/Cell No -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="phone_number" class="font-semibold text-ternary/90 text-sm">Mobile/Cell No <span class="text-danger">*</span></label>
                            <div class="w-full relative">
                                <input type="tel" name="phone_number" id="phone_number"
                                       value="{{ $bookingData->clint->phone_number ?? '' }}"
                                       required class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-mobile-alt absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Other Details Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="other">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-info-circle text-primary mr-2"></i>
                        Other Details
                    </h2>
                    <button type="button" class="section-edit-btn text-primary hover:text-primary-dark text-sm font-medium" data-section="other">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Date of Birth -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="date_of_birth" class="font-semibold text-ternary/90 text-sm">Date of Birth <span class="text-danger">*</span></label>
                            <div class="w-full relative">
                                <input type="date" name="date_of_birth" id="date_of_birth" required
                                  value="{{ old('date_of_birth', optional($bookingData->clint->clientinfo)->date_of_birth ? \Carbon\Carbon::parse($bookingData->clint->clientinfo->date_of_birth)->format('d-m-Y') : '') }}"

                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-calendar-day absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Place of Birth -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="place_of_birth" class="font-semibold text-ternary/90 text-sm">Place of Birth</label>
                            <div class="w-full relative">
                                <input type="text" name="place_of_birth" id="place_of_birth"
                                       value="{{ old('place_of_birth', $bookingData->clint->clientinfo->place_of_birth ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-map-marker-alt absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Religion -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="religion" class="font-semibold text-ternary/90 text-sm">Religion</label>
                            <div class="w-full relative">
                                <input type="text" name="religion" id="religion"
                                       value="{{ old('religion', $bookingData->clint->clientinfo->religion ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-pray absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Country of Birth -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="country_of_birth" class="font-semibold text-ternary/90 text-sm">Country of Birth <span class="text-danger">*</span></label>
                            <div class="w-full relative">
                                <input type="text" name="country_of_birth" id="country_of_birth"
                                       value="{{ old('country_of_birth', $bookingData->clint->clientinfo->country_of_birth ?? '') }}"
                                       required class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-globe absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="address">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-home text-primary mr-2"></i>
                        Address Information
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="address">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <!-- Present Address -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label class="font-semibold text-ternary/90 text-sm">Present Address <span class="text-danger">*</span></label>
                            <div class="w-full relative">
                                    <textarea rows="3" name="permanent_address" id="permanent_address" required
                                              class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">{{ old('permanent_address', $bookingData->clint->permanent_address ?? '') }}</textarea>
                                <i class="fas fa-map-pin absolute right-3 top-4 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Permanent Address -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label class="font-semibold text-ternary/90 text-sm">Permanent Address <span class="text-danger">*</span></label>
                            <div class="w-full relative">
                                <textarea rows="3" class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">{{ old('permanent_address', $bookingData->clint->permanent_address ?? '') }}</textarea>
                                <i class="fas fa-map-marked-alt absolute right-3 top-4 text-gray-400"></i>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Citizenship/National ID No -->
                            <div class="w-full relative group flex flex-col gap-1">
                                <label class="font-semibold text-ternary/90 text-sm">Citizenship/National ID No</label>
                                <div class="w-full relative">
                                    <input type="text" class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                    <i class="fas fa-id-card absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                            </div>

                            <!-- Educational Qualification -->
                            <div class="w-full relative group flex flex-col gap-1">
                                <label class="font-semibold text-ternary/90 text-sm">Educational Qualification</label>
                                <div class="w-full relative">
                                    <input type="text"  name="educational_qualification" id="educational_qualification"
                                              value="{{ old('educational_qualification', $bookingData->clint->clientinfo->educational_qualification ?? '') }}"
                                    class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                    <i class="fas fa-graduation-cap absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                            </div>

                            <!-- Visible identification marks -->
                            <div class="w-full relative group flex flex-col gap-1">
                                <label class="font-semibold text-ternary/90 text-sm">Visible identification marks</label>
                                <div class="w-full relative">
                                    <input type="text" name="identification_marks" id="identification_marks"
                                              value="{{ old('identification_marks', $bookingData->clint->clientinfo->identification_marks ?? '') }}"
                                           
                                    class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                    <i class="fas fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                            </div>

                            <!-- Current Nationality -->
                            <div class="w-full relative group flex flex-col gap-1">
                                <label class="font-semibold text-ternary/90 text-sm">Current Nationality <span class="text-danger">*</span></label>
                                <div class="w-full relative">
                                    <input type="text" name="nationality" id="nationality" requiresdd
                                    value="{{ old('nationality', $bookingData->clint->clientinfo->nationality ?? '') }}"
                                    required class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                    <i class="fas fa-passport absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                            </div>

                            <!-- Nationality by Birth/Naturalization -->
                            <div class="w-full relative group flex flex-col gap-1">
                                <label class="font-semibold text-ternary/90 text-sm">Nationality by Birth/Naturalization</label>
                                <div class="w-full relative">
                                    <input type="text" name="nationality" id="nationality" requiresdd
                                              value="{{ old('nationality', $bookingData->clint->clientinfo->nationality ?? '') }}"
                                     class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                    <i class="fas fa-flag absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                            </div>
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
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="passport">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Passport No -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="passport_country" class="font-semibold text-ternary/90 text-sm">Passport No. <span class="text-danger">*</span></label>
                            <div class="w-full relative">
                                <input type="text" name="passport_country" id="passport_country" required
                                       value="{{ old('passport_country', $bookingData->clint->clientinfo->passport_country ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-id-card absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Date of Issue -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="passport_issue_date" class="font-semibold text-ternary/90 text-sm">Date of Issue <span class="text-danger">*</span></label>
                            <div class="w-full relative">
                                <input type="date" name="passport_issue_date" id="passport_issue_date" required
                                       value="{{ old('passport_issue_date', $bookingData->clint->clientinfo->passport_issue_date ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-calendar-alt absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Date of Expiry -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="passport_expiry_date" class="font-semibold text-ternary/90 text-sm">Date of Expiry <span class="text-danger">*</span></label>
                            <div class="w-full relative">
                                <input type="date" name="passport_expiry_date" id="passport_expiry_date" required
                                       value="{{ old('passport_expiry_date', $bookingData->clint->clientinfo->passport_expiry_date ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-calendar-times absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Place of Issue -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="passport_issue_place" class="font-semibold text-ternary/90 text-sm">Place of Issue <span class="text-danger">*</span></label>
                            <div class="w-full relative">
                                <input type="text" name="passport_issue_place" id="passport_issue_place" requiresdd
                                             value="{{ old('passport_issue_place', $bookingData->clint->clientinfo->passport_issue_place ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-map-marker-alt absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @php
                            $permission = [];

                            if ($bookingData && $bookingData->clientrequiremtsinfo && $bookingData->clientrequiremtsinfo->name_of_field) {
                                $permission = json_decode($bookingData->clientrequiremtsinfo->name_of_field, true);
                            }

                            // Fields to be removed
                            $fieldsToRemove = [
                                'citizenship_id',
                                'educational_qualification',
                                'identification_marks',
                                'nationality',
                                'additional_passport_info_permission'
                            ];

                            // Filter the array to remove unwanted fields
                            $alreadySelect = array_values(array_diff($permission, $fieldsToRemove));
                        @endphp
                        
            @php
            $other_passport_details = json_decode($bookingData->clint->clientinfo->other_passport_details);
            @endphp

            @if(in_array('additional_passport_info_permission', $permission))
            <!-- Other Passport/Identity Certificate Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="otherpassport">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-id-badge text-primary mr-2"></i>
                        Other Passport/Identity Certificate
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="otherpassport">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Country of Issue -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="other_passport_country" class="font-semibold text-ternary/90 text-sm">Country of Issue</label>
                            <div class="w-full relative">
                                <input type="text" name="other_passport_country" id="other_passport_country" required
                                       value="{{ old('other_passport_country', $other_passport_details->country ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-globe-americas absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Place of Issue -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="other_passport_issue_place" class="font-semibold text-ternary/90 text-sm">Place of Issue</label>
                            <div class="w-full relative">
                                <input type="text" name="other_passport_issue_place" id="other_passport_issue_place" required
                                       value="{{ old('other_passport_issue_place', $other_passport_details->issue_place ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-map-marked absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Passport/IC No -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="other_passport_ic_number" class="font-semibold text-ternary/90 text-sm">Passport/IC No.</label>
                            <div class="w-full relative">
                                <input type="text" name="other_passport_ic_number" id="other_passport_ic_number" required
                                       value="{{ old('other_passport_ic_number', $other_passport_details->ic_number ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-id-card-alt absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Date of issue -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="other_passport_issue_date" class="font-semibold text-ternary/90 text-sm">Date of issue</label>
                            <div class="w-full relative">
                                <input type="date" name="other_passport_issue_date" id="other_passport_issue_date" required
                                       value="{{ old('other_passport_issue_date', $other_passport_details->issue_date ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-calendar-check absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Nationality/Status -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label class="font-semibold text-ternary/90 text-sm">Nationality/Status</label>
                            <div class="w-full relative">
                                <input type="text" class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-flag-usa absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Profession/Occupation Details Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="profession">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-primary mr-2"></i>
                        Profession/Occupation Details
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="profession">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Present Occupation -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="present_occupation" class="font-semibold text-ternary/90 text-sm">Present Occupation</label>
                            <div class="w-full relative">
                                <input type="text" name="present_occupation" id="present_occupation"
                                       value="{{ old('present_occupation', $bookingData->clint->clientinfo->present_occupation ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-user-tie absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Designation/Rank -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="designation" class="font-semibold text-ternary/90 text-sm">Designation/Rank</label>
                            <div class="w-full relative">
                                <input type="text" name="designation" id="designation"
                                       value="{{ old('designation', $bookingData->clint->clientinfo->designation ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-user-shield absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Employer name/business -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Employer name</label>
                            <div class="w-full relative">
                                <input type="text" name="employer_name" id="employer_name"
                                       value="{{ old('employer_name', $bookingData->clint->clientinfo->employer_name ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Employer Address</label>
                            <div class="w-full relative">
                            <textarea name="employer_address" id="employer_address"
                                                class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">{{ old('employer_address', $bookingData->clint->clientinfo->employer_address ?? '') }}</textarea>
                                        <i class="fa fa-map-pin absolute right-3 top-4 text-sm text-secondary/80"></i>
                               
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Employer Phone</label>
                            <div class="w-full relative">
                                <input type="text"  name="employer_phone" id="employer_phone"
                                           value="{{ old('employer_phone', $bookingData->clint->clientinfo->employer_phone ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Past Occupation</label>
                            <div class="w-full relative">
                                <input type="text" name="past_occupation" id="past_occupation"
                                             value="{{ old('past_occupation', $bookingData->clint->clientinfo->past_occupation ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>



                        <!-- Employer Phone Number -->
                    </div>
                </div>
            </div>


             <!-- Father Details -->
             <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="father">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-primary mr-2"></i>
                        Father Details
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="father">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                    @php
                    $fatherdetails = $bookingData->clint->clientinfo->father_details ? json_decode($bookingData->clint->clientinfo->father_details) : null;
                    $motherdetails = $bookingData->clint->clientinfo->father_details ? json_decode($bookingData->clint->clientinfo->father_details) : null;
                
                    
                @endphp
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Present Occupation -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="present_occupation" class="font-semibold text-ternary/90 text-sm">Father Name</label>
                            <div class="w-full relative">
                                <input type="text" name="father_name" id="father_name"
                                           value="{{ old('father_name', $fatherdetails->name ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-user-tie absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Designation/Rank -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="designation" class="font-semibold text-ternary/90 text-sm">Nationality</label>
                            <div class="w-full relative">
                                
                                <input type="text" name="father_nationality" id="father_nationality"
                                           value="{{ old('father_nationality', $fatherdetails->nationality ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-user-shield absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Employer name/business -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Previous Nationality</label>
                            <div class="w-full relative">
                                <input type="text" name="father_previous_nationality" id="father_previous_nationality"
                                           value="{{ old('father_previous_nationality', $fatherdetails->previous_nationality ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Date of Birth</label>
                            <div class="w-full relative">
                            <input type="date" name="father_dob" id="father_dob"
                                          value="{{ old('father_dob', isset($fatherdetails->father_dob) ? \Carbon\Carbon::parse($father->father_dob)->format('Y-m-d') : '') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">

                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Employment Status</label>
                            <div class="w-full relative">
                                <input type="text" name="father_employment" id="father_employment"
                                           value="{{ old('father_employment', $fatherdetails->employementstatus ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Address</label>
                            <div class="w-full relative">
                                <input type="text"  name="father_address" id="father_address"
                                           value="{{ old('father_address', $fatherdetails->address ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                      

                        <!-- Employer Phone Number -->
                    </div>
                </div>
            </div>


             <!-- Mother  Details Section -->
             <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="mother">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-primary mr-2"></i>
                       Mother Details 
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="mother">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Present Occupation -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="present_occupation" class="font-semibold text-ternary/90 text-sm">Mother Name</label>
                            <div class="w-full relative">
                                <input type="text" name="mother_name" id="mother_name"
                                           value="{{ old('mother_name', $motherdetails->name ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-user-tie absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Designation/Rank -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="designation" class="font-semibold text-ternary/90 text-sm">Nationality</label>
                            <div class="w-full relative">
                                
                                <input type="text" name="mother_nationality" id="mother_nationality"
                                           value="{{ old('mother_nationality', $motherdetails->nationality ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-user-shield absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Employer name/business -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Previous Nationality</label>
                            <div class="w-full relative">
                                <input type="text" name="mother_previous_nationality" id="mother_previous_nationality"
                                           value="{{ old('mother_previous_nationality', $motherdetails->previous_nationality ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Date of Birth</label>
                            <div class="w-full relative">
                            <input type="date"  name="mother_dob" id="mother_dob"
                                          value="{{ old('mother_dob', isset($motherdetails->father_dob) ? $motherdetails->father_dob : '') }}"
                                         class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">

                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Employment Status</label>
                            <div class="w-full relative">
                                <input type="text" name="mother_employment" id="mother_employment"
                                           value="{{ old('mother_employment', $motherdetails->employementstatus ?? '') }}"
                                            class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Address</label>
                            <div class="w-full relative">
                                <input type="text"  name="mother_address" id="mother_address"
                                           value="{{ old('mother_address', $motherdetails->address ?? '') }}"
                                          class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>



                        <!-- Employer Phone Number -->
                    </div>
                </div>
            </div>


            <!-- Visa   Details Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="visadetails">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-primary mr-2"></i>
                       Visa Details 
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="visadetails">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Present Occupation -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="present_occupation" class="font-semibold text-ternary/90 text-sm">Type Of Visa Required</label>
                            <div class="w-full relative">
                                <input type="text" 
                                            value="{{ old('visatype', $bookingData->visa->name?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-user-tie absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Designation/Rank -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="designation" class="font-semibold text-ternary/90 text-sm">No of Entries</label>
                            <div class="w-full relative">
                                
                                <input type="text"  value="{{ old('visatype', $bookingData->visasubtype->name?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-user-shield absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Employer name/business -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Period of Visa ( Month) *</label>
                            <div class="w-full relative">
                                <input type="text" name="periodofvisa" id="periodofvisa" requiresdd
                                                
                                                value="{{ old('periodofvisa', $bookingData->visarequireddocument->period_of_visa_month ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Expected Date of Journey *</label>
                            <div class="w-full relative">
                            <input type="date" name="expecteddate" id="expecteddate"  readonly="" requiresdd
                                             value="{{ old('country', $bookingData->dateofentry ?? '') }}" readonly=""
                                         class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">

                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Port Of Arrival *</label>
                            <div class="w-full relative">
                                <input type="text" name="portofarrival" id="portofarrival" requiresdd
                                             value="{{ old('portofarrival', $bookingData->visarequireddocument->port_of_arrival ?? '') }}"
                                            class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Port of Exit *</label>
                            <div class="w-full relative">
                                <input type="text"  name="portofexit" id="portofexit" requiresdd
                                            value="{{ old('portofexit', $bookingData->visarequireddocument->port_of_exit ?? '') }}"
                                          class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm"> Required Detail of *</label>
                            <div class="w-full relative">
                                <input type="text"   requiresdd
                                               value="{{ old('requireddetailsof', $bookingData->visa->name?? '') }}"
                                          class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>



                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Places to be Visited *</label>
                            <div class="w-full relative">
                                <input type="text"  name="placeofvisit" id="placeofvisit" requiresdd
                                               value="{{ old('placeofvisit', $bookingData->visarequireddocument->places_to_be_visited ?? '') }}"
                                          class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Purpose of Visit *</label>
                            <div class="w-full relative">
                                <input type="text"  name="purposeofvisit" id="purposeofvisit" requiresdd
                                              value="{{ old('purposeofvisit', $bookingData->visarequireddocument->purpose_of_visit ?? '') }}"
                                          class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>


                        

                        <!-- Employer Phone Number -->
                    </div>
                </div>
            </div>




            <!-- Mother  Details Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="previewvisadetails">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-primary mr-2"></i>
                       Other  Visa Details
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="previewvisadetails">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Present Occupation -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="present_occupation" class="font-semibold text-ternary/90 text-sm">Cities Visited Before (if any)</label>
                            <div class="w-full relative">
                                <input type="text" name="mother_name" id="mother_name"
                                           value="{{ old('mother_name', $motherdetails->name ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-user-tie absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Designation/Rank -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="designation" class="font-semibold text-ternary/90 text-sm">Previous Visa Number</label>
                            <div class="w-full relative">
                                
                                <input type="text" name="previous_visa_number" id="previous_visa_number"
                                            value="{{ old('previous_visa_number', $bookingData->visarequireddocument->previous_visa_number ?? '') }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-user-shield absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Employer name/business -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Previous Visa Issue Date</label>
                            <div class="w-full relative">
                                 <input type="date" name="previous_visa_issue_date" id="previous_visa_issue_date"
                                            value="{{ old('previous_visa_issue_date', $bookingData->visarequireddocument->previous_visa_issue_date ?? '') }}"
                                            class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Countries Visited in Last 10 Years</label>
                            <div class="w-full relative">
                            <textarea name="countries_visited_last_10_years" id="countries_visited_last_10_years"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('countries_visited_last_10_years', $bookingData->visarequireddocument->countries_visited_last_10_years ?? '')  }}</textarea>
                                        <i class="fa fa-globe-europe absolute right-3 top-4 text-sm text-secondary/80"></i>
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Employment Status</label>
                            <div class="w-full relative">
                                <input type="text" name="mother_employment" id="mother_employment"
                                           value="{{ old('mother_employment', $motherdetails->employementstatus ?? '') }}"
                                            class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-building absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>


                     



                        <!-- Employer Phone Number -->
                    </div>
                </div>
            </div>


               <!-- Mother  Details Section -->
               <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="previewvisadetails">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-primary mr-2"></i>
                        Details of Two Reference
I
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="previewvisadetails">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">In India </label>
                            <div class="w-full relative">
                            <textarea name="countries_visited_last_10_years" id="countries_visited_last_10_years"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200"></textarea>
                                        <i class="fa fa-globe-europe absolute right-3 top-4 text-sm text-secondary/80"></i>
                            </div>
                        </div>

                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">In United Kindone</label>
                            <div class="w-full relative">
                            <textarea name="countries_visited_last_10_years" id="countries_visited_last_10_years"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('permanent_address', $bookingData->clint->permanent_address ?? '') }}</textarea>
                                        <i class="fa fa-globe-europe absolute right-3 top-4 text-sm text-secondary/80"></i>
                            </div>
                        </div>




                        <!-- Employer Phone Number -->
                    </div>
                </div>
            </div>




             <!-- Buttons Section -->
        <div class="flex justify-between mt-8">
        <!-- <a href="{{ route('download.fillapplication', ['id' => $bookingData->id]) }}">
            <button class="bg-success text-white px-6 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-success focus:ring-opacity-50">
                Download
            </button>
        </a> -->

        
            <button class="bg-success text-white px-6 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-success focus:ring-opacity-50">
                Submit
            </button>
        </div>
        </form>
    </div>
</div>
</body>

<script>
$(document).ready(function() {
    // Disable all inputs/selects/textareas inside only this form initially
    $('#confirmform').find('input, select, textarea').prop('disabled', true);
    
    // Handle edit button clicks
    $('.section-edit-btn').click(function() {
        const section = $(this).data('section');

        // Loop through all section containers within the form
        $('#confirmform').find('.section-container').each(function() {
            const currentSection = $(this).data('section');
            const isActive = currentSection === section;

            // Enable/disable inputs/selects/textareas only in the target section
            $(this).find('input, select, textarea').prop('disabled', !isActive);

            // Update edit button styles and icon
            const btn = $(this).find('.section-edit-btn');
            if (isActive) {
                btn.html('<i class="fas fa-times mr-1"></i> Cancel');
                btn.removeClass('text-primary').addClass('text-danger');
            } else {
                btn.html('<i class="fas fa-edit mr-1"></i> Edit');
                btn.removeClass('text-danger').addClass('text-primary');
            }
        });
    });

    // Optional: Re-enable all inputs before submission
    $('#confirmform').submit(function() {
        $(this).find('input, select, textarea').prop('disabled', false);
        return true;
    });
});
</script>



</html>