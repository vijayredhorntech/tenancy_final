<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <!-- Include your Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <h1 class="text-3xl font-bold text-center text-ternary mb-8">Application Form</h1>
        <form action="{{ route('comfirm.application') }}" method="POST">
            @csrf
         
        <input type="hidden"value="{{ $bookingData->id }}" name="bookingid">
        <input type="hidden" name="type" value="{{ $type ?? 'agency' }}">
       
        <!-- Personal Details Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-primary border-l-4 border-primary pl-3 mb-4">1. Personal Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 after:content-['*'] after:text-danger">First Name</label>
                    <input type="text"  name="first_name" id="first_name"
                value="{{ $bookingData->clint->first_name ?? '' }}"
                requiredd class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="last_name" id="last_name"
                value="{{ $bookingData->clint->last_name ?? '' }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Previous Name (if any)</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 after:content-['*'] after:text-danger">Email Address</label>
                    <input type="email" name="email" id="email"
                   value="{{ $bookingData->clint->email ?? '' }}"
               requiredd class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone No</label>
                    <input type="tel" name="phone_number" id="phone_number"
                    value="{{ $bookingData->clint->phone_number ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 after:content-['*'] after:text-danger">Gender</label>
                    <select name="gender" id="gender" requiresdd
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                        @error('gender') border-red-500 @enderror">
                                                    <option value="MALE" {{ old('gender', $bookingData->clint->gender) == 'MALE' ? 'selected' : '' }}>Male</option>
                                                    <option value="FEMALE" {{ old('gender', $bookingData->clint->gender) == 'FEMALE' ? 'selected' : '' }}>Female</option>
                                                    <option value="OTHER" {{ old('gender', $bookingData->clint->gender) == 'OTHER' ? 'selected' : '' }}>Other</option>
                                                  </select>
                </div>  
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 after:content-['*'] after:text-danger">Gender</label>
                    <select name="gender" id="gender" requiresdd
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                        @error('gender') border-red-500 @enderror">
                                                    <option value="MALE" {{ old('gender', $bookingData->clint->gender) == 'MALE' ? 'selected' : '' }}>Male</option>
                                                    <option value="FEMALE" {{ old('gender', $bookingData->clint->gender) == 'FEMALE' ? 'selected' : '' }}>Female</option>
                                                    <option value="OTHER" {{ old('gender', $bookingData->clint->gender) == 'OTHER' ? 'selected' : '' }}>Other</option>
                                                  </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Marital Status</label>
                    <select name="marital_status" id="marital_status" requiresdd
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                        @error('marital_status') border-red-500 @enderror">
                                        
                                                    <option value="single" {{ old('marital_status', $bookingData->clint->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
                                                    <option value="married" {{ old('marital_status', $bookingData->clint->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
                                                    <option value="divorced" {{ old('marital_status', $bookingData->clint->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                                    <option value="widowed" {{ old('marital_status', $bookingData->clint->marital_status) == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                                </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 after:content-['*'] after:text-danger">Mobile/Cell No</label>
                    <input type="tel" name="phone_number" id="phone_number"
                    value="{{ $bookingData->clint->phone_number ?? '' }}" requiredd class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>

                 <button> Edit </button>
            </div>
        </div>

        <!-- Other Details Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-primary border-l-4 border-primary pl-3 mb-4">2. Other Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 after:content-['*'] after:text-danger">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" requiresdd
                                              value="{{ old('date_of_birth', $bookingData->clint->clientinfo->date_of_birth ?? '') }}"
                             requiredd class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Birth</label>
                    <input type="text" name="place_of_birth" id="place_of_birth"
                                              value="{{ old('place_of_birth', $bookingData->clint->clientinfo->place_of_birth ?? '') }}"
                                             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Religion</label>
                    <input type="text" name="religion" id="religion"
                                              value="{{ old('religion', $bookingData->clint->clientinfo->religion ?? '') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 after:content-['*'] after:text-danger">Country of Birth</label>
                    <input type="text" name="country_of_birth" id="country_of_birth"
                                              value="{{ old('country_of_birth', $bookingData->clint->clientinfo->country_of_birth ?? '') }}"
                                             requiredd class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                
            </div>
            <button> Edit </button>
        </div>

        <!-- Address Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-primary border-l-4 border-primary pl-3 mb-4">3. Address</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 after:content-['*'] after:text-danger">Present Address</label>
                    <textarea rows="3"  name="permanent_address" id="permanent_address" requiredd class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">{{ old('permanent_address', $bookingData->clint->permanent_address ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 after:content-['*'] after:text-danger">Permanent Address</label>
                    <textarea rows="3"  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">{{ old('permanent_address', $bookingData->clint->permanent_address ?? '') }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Citizenship/National ID No</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Educational Qualification</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Visible identification marks</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 after:content-['*'] after:text-danger">Current Nationality</label>
                        <input type="text" requiredd class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nationality by Birth/Naturalization</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                </div>
            </div>
            <button> Edit </button>
        </div>

        <!-- Passport Details Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-primary border-l-4 border-primary pl-3 mb-4">4. Passport Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 after:content-['*'] after:text-danger">Passport No.</label>
                    <input type="text" name="passport_country" id="passport_country" requiresdd
                                            value="{{ old('passport_country', $bookingData->clint->clientinfo->passport_country ?? '') }}"
                                             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 after:content-['*'] after:text-danger">Date of Issue</label>
                    <input type="date" name="passport_issue_date" id="passport_issue_date" requiresdd
                                            value="{{ old('passport_issue_date', $bookingData->clint->clientinfo->passport_issue_date ?? '') }}"
                                             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 after:content-['*'] after:text-danger">Date of Expiry</label>
                    <input type="date" name="passport_expiry_date" id="passport_expiry_date" requiresdd
                                            value="{{ old('passport_expiry_date', $bookingData->clint->clientinfo->passport_expiry_date ?? '') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 after:content-['*'] after:text-danger">Place of Issue</label>
                    <input type="text" name="passport_issue_place" id="passport_issue_place" requiresdd
                                             value="{{ old('passport_issue_place', $bookingData->clint->clientinfo->passport_issue_place ?? '') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
            </div>
        </div>

        @php
                              $other_passport_details = json_decode($bookingData->clint->clientinfo->other_passport_details);

                          @endphp
                          
                          @if(in_array('additional_passport_info_permission', $permission))
        <!-- Other Passport/Identity Certificate Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-primary border-l-4 border-primary pl-3 mb-4">5. Any other Passport/Identity Certificate held</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Country of Issue</label>
                    <input type="text" name="other_passport_country" id="other_passport_country" requiredd
                                                    value="{{ old('other_passport_country', $other_passport_details->country ?? '') }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Issue</label>
                    <input type="text" name="other_passport_issue_place" id="other_passport_issue_place" requiredd
                                                    value="{{ old('other_passport_issue_place', $other_passport_details->issue_place ?? '') }}"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Passport/IC No.</label>
                    <input type="text" name="other_passport_ic_number" id="other_passport_ic_number" requiredd
                                                    value="{{ old('other_passport_ic_number', $other_passport_details->ic_number ?? '') }}"
                                                     class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of issue</label>
                    <input type="date" name="other_passport_issue_date" id="other_passport_issue_date" requiredd
                                                    value="{{ old('other_passport_issue_date', $other_passport_details->issue_date ?? '') }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nationality/Status</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
            </div>
        </div>
        <button> Edit </button>
        @endif

        <!-- Family Details Section -->
        <!-- <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-primary border-l-4 border-primary pl-3 mb-4">6. Family Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Relation</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nationality</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Prev. Nationality</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place/Country of Birth</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
            </div>
        </div> -->

        <!-- Profession/Occupation Details Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-primary border-l-4 border-primary pl-3 mb-4">8. Profession/Occupation Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Present Occupation</label>
                    <input type="text" name="present_occupation" id="present_occupation"
                                            value="{{ old('present_occupation', $bookingData->clint->clientinfo->present_occupation ?? '') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Designation/Rank</label>
                    <input type="text" name="designation" id="designation"
                                            value="{{ old('designation', $bookingData->clint->clientinfo->designation ?? '') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employer name/business</label>
                    <input type="text" name="employer_name" id="employer_name"
                                           value="{{ old('employer_name', $bookingData->clint->clientinfo->employer_name ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employer  Phone Number</label>
                    <input type="text" name="employer_phone" id="employer_phone"
                                           value="{{ old('employer_phone', $bookingData->clint->clientinfo->employer_phone ?? '') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Past occupation if any</label>
                    <input type="text"  name="past_occupation" id="past_occupation"
                                             value="{{ old('past_occupation', $bookingData->clint->clientinfo->past_occupation ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
            </div>

            <button> Edit </button>
        </div>

        <!-- Armed Forces Section -->
        <!-- <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-primary border-l-4 border-primary pl-3 mb-4">9. Are/have you worked with Armed forces/ Police/ Para Military forces?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Organization</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Posting</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rank</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
            </div>
        </div> -->

        <!-- Visa Details Section -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h2 class="text-xl font-semibold text-primary border-l-4 border-primary pl-3 mb-4">10. Details of Visa</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Type Of Visa requiredd</label>
            <input type="text"  name="visatype" id="visatype"
            value="{{ old('visatype', $bookingData->visa->name?? '') }}"  readonly=""  class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                              
         
                                       
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">No of Entries</label>
            <input type="text"name="noofentries" id="noofentries"
                                        value="{{ old('visatype', $bookingData->visasubtype->name?? '') }}" readonly=""
                                            
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Period of Visa (Month)</label>
            <input type="text" name="periodofvisa" id="periodofvisa" requiresdd
                                                value="{{ old('periodofvisa', $bookingData->visarequireddocument->period_of_visa_month ?? '') }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Expected Date of Journey</label>
            <input type="date" name="expecteddate" id="expecteddate"  readonly="" requiresdd
                                             value="{{ old('country', $bookingData->dateofentry ?? '') }}" readonly=""
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Port Of Arrival</label>
            <input type="text" name="portofarrival" id="portofarrival" requiresdd
                                             value="{{ old('portofarrival', $bookingData->visarequireddocument->port_of_arrival ?? '') }}"
                                             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Port of Exit</label>
            <input type="text" name="portofexit" id="portofexit" requiresdd
                                            value="{{ old('portofexit', $bookingData->visarequireddocument->port_of_exit ?? '') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
    </div>
    <button> Edit </button>
</div>

<!-- requiredd Details Section -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h2 class="text-xl font-semibold text-primary border-l-4 border-primary pl-3 mb-4">11. requiredd Details</h2>
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Places to be Visited</label>
            <textarea rows="3" name="placeofvisit" id="placeofvisit" requiresdd
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">{{ old('placeofvisit', $bookingData->visarequireddocument->places_to_be_visited ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Purpose of Visit</label>
            <textarea rows="3" name="purposeofvisit" id="purposeofvisit" requiresdd
                                         
                                            requiresdd
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">{{ old('purposeofvisit', $bookingData->visarequireddocument->purpose_of_visit ?? '') }}</textarea>
        </div>
    </div>
    <button> Edit </button>
</div>

<!-- Previous Visit Details Section -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h2 class="text-xl font-semibold text-primary border-l-4 border-primary pl-3 mb-4">12. Previous Visit Details</h2>
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Have You Ever visited India?</label>
            <div class="flex items-center space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="visited_india" value="yes" class="text-primary focus:ring-primary">
                    <span class="ml-2">Yes</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="visited_india" value="no" class="text-primary focus:ring-primary">
                    <span class="ml-2">No</span>
                </label>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Address where You stayed in India</label>
                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cities in  Visited</label>
                <input type="text" name="cities_visited" value="{{ old('cities_visited', $bookingData->visarequireddocument->cities_visited_in_india ?? '')  }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type of Visa</label>
                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Previous Visa Number</label>
                <input type="text" name="previous_visa_number" value="{{ old('previous_visa_number', $bookingData->visarequireddocument->previous_visa_number ?? '')  }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Visa Issued Place</label>
                <input type="text" name="previous_visa_place" id="previous_visa_place"
                value="{{ old('previous_visa_place', $bookingData->visarequireddocument->previous_visa_issued_place ?? '') }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date of Issue</label>
                <input type="date" name="previous_visa_issue_date" id="previous_visa_issue_date"
                                            value="{{ old('previous_visa_issue_date', $bookingData->visarequireddocument->previous_visa_issue_date ?? '') }}"           
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Countries visited in last 10 years</label>
            <textarea rows="3" name="countries_visited_last_10_years" id="countries_visited_last_10_years" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">{{ old('countries_visited_last_10_years', $bookingData->visarequireddocument->countries_visited_last_10_years ?? '')  }}</textarea>
        </div>
        <!-- <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Have you been refused an Indian Visa or extension of the same previously or deported from India?</label>
            <div class="flex items-center space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="refused_visa" value="yes" class="text-primary focus:ring-primary">
                    <span class="ml-2">Yes</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="refused_visa" value="no" class="text-primary focus:ring-primary">
                    <span class="ml-2">No</span>
                </label>
            </div>
        </div> -->
    </div>
</div>

<!-- References Section -->
<!-- <div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h2 class="text-xl font-semibold text-primary border-l-4 border-primary pl-3 mb-4">13. Details of Two References</h2>
    
    <h3 class="text-lg font-medium text-gray-800 mb-3">Reference in India</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
            <input type="tel" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
    </div>
    
    <h3 class="text-lg font-medium text-gray-800 mb-3">Reference in United States</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
            <input type="tel" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
        </div>
    </div>
</div> -->

        <!-- Buttons Section -->
        <div class="flex justify-between mt-8">
            <button class="bg-warning text-white px-6 py-2 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-warning focus:ring-opacity-50">
                Edit
            </button>
            <button class="bg-success text-white px-6 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-success focus:ring-opacity-50">
                Submit
            </button>
        </div>
    </div>
</body>
</html>