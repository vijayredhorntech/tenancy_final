<x-agency.frontlayout>
    @section('title')Client Application @endsection

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
        {{-- Form Heading --}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Visa Application Form</span>
        </div>

        {{-- Progress Steps --}}
        <div class="w-full px-4 py-3 border-b border-ternary/10">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="step-indicator active" data-step="1">
                        <div class="step-number">1</div>
                        <div class="step-label">Personal Info</div>
                    </div>
                    <div class="step-connector"></div>

                    <div class="step-indicator" data-step="2">
                        <div class="step-number">2</div>
                        <div class="step-label">Family Details</div>
                    </div>
                    <div class="step-connector"></div>

                    <div class="step-indicator" data-step="3">
                        <div class="step-number">3</div>
                        <div class="step-label">Contact Details</div>
                    </div>
                    <div class="step-connector"></div>

                    <div class="step-indicator" data-step="4">
                        <div class="step-number">4</div>
                        <div class="step-label">Passport Info</div>
                    </div>
                    <div class="step-connector"></div>

                    <div class="step-indicator" data-step="5">
                        <div class="step-number">5</div>
                        <div class="step-label">Travel Details</div>
                    </div>
                    <div class="step-connector"></div>
                    <div class="step-indicator" data-step="6">
                        <div class="step-number">6</div>
                        <div class="step-label">Employment</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Content --}}
        <form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data" id="multiStepForm">
                    @csrf

                    {{-- Step 1: Personal Information --}}
                    <div class="form-step active" data-step="1">
                        <div class="w-full flex flex-col gap-2 px-4 mt-4">
                            <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                                <span class="text-lg font-bold text-ternary">Personal Information</span>
                            </div>

                            <div class="w-full grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4">
                                <div class="w-full relative group flex flex-col gap-1">
                                    <input type="hidden"  name="agency_id" id="agency_id" value="{{ $agency->id }}" readonly>
                                    <label for="first_name" class="font-semibold text-ternary/90 text-sm">First Name *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="first_name" id="first_name" requiresdd
                                            value="{{ old('first_name') }}"
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
                                        <input type="text" name="last_name" id="last_name" requiresdd
                                            value="{{ old('last_name') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('last_name') border-red-500 @enderror">
                                        <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('last_name')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="previous_name" class="font-semibold text-ternary/90 text-sm">Previous Name (if any)</label>
                                    <div class="w-full relative">
                                        <input type="text" name="previous_name" id="previous_name"
                                            value="{{ old('previous_name') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-user-tag absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="gender" class="font-semibold text-ternary/90 text-sm">Gender *</label>
                                    <div class="w-full relative">
                                        <select name="gender" id="gender" requiresdd
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                @error('gender') border-red-500 @enderror">
                                            <option value="">Select Gender</option>
                                            <option value="MALE" {{ old('gender') == 'MALE' ? 'selected' : '' }}>Male</option>
                                            <option value="FEMALE" {{ old('gender') == 'FEMALE' ? 'selected' : '' }}>Female</option>
                                            <option value="OTHER" {{ old('gender') == 'OTHER' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        <i class="fa fa-venus-mars absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('gender')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="marital_status" class="font-semibold text-ternary/90 text-sm">Marital Status *</label>
                                    <div class="w-full relative">
                                        <select name="marital_status" id="marital_status" requiresdd
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                @error('marital_status') border-red-500 @enderror">
                                            <option value="">Select Status</option>
                                            <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Single</option>
                                            <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Married</option>
                                            <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                            <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                        </select>
                                        <i class="fa fa-heart absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('marital_status')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="religion" class="font-semibold text-ternary/90 text-sm">Religion</label>
                                    <div class="w-full relative">
                                        <input type="text" name="religion" id="religion"
                                            value="{{ old('religion') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-pray absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="date_of_birth" class="font-semibold text-ternary/90 text-sm">Date of Birth *</label>
                                    <div class="w-full relative">
                                        <input type="date" name="date_of_birth" id="date_of_birth" requiresdd
                                            value="{{ old('date_of_birth') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('date_of_birth') border-red-500 @enderror">
                                        <i class="fa fa-calendar absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('date_of_birth')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="place_of_birth" class="font-semibold text-ternary/90 text-sm">Place of Birth</label>
                                    <div class="w-full relative">
                                        <input type="text" name="place_of_birth" id="place_of_birth"
                                            value="{{ old('place_of_birth') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="country_of_birth" class="font-semibold text-ternary/90 text-sm">Country of Birth</label>
                                    <div class="w-full relative">
                                        <input type="text" name="country_of_birth" id="country_of_birth"
                                            value="{{ old('country_of_birth') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="nationality" class="font-semibold text-ternary/90 text-sm">Nationality *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="nationality" id="nationality" requiresdd
                                            value="{{ old('nationality') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('nationality') border-red-500 @enderror">
                                        <i class="fa fa-flag absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('nationality')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="past_nationality" class="font-semibold text-ternary/90 text-sm">Past Nationality (if any)</label>
                                    <div class="w-full relative">
                                        <input type="text" name="past_nationality" id="past_nationality"
                                            value="{{ old('past_nationality') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-passport absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="educational_qualification" class="font-semibold text-ternary/90 text-sm">Educational Qualification</label>
                                    <div class="w-full relative">
                                        <input type="text" name="educational_qualification" id="educational_qualification"
                                            value="{{ old('educational_qualification') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-graduation-cap absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="identification_marks" class="font-semibold text-ternary/90 text-sm">Identification Marks</label>
                                    <div class="w-full relative">
                                        <input type="text" name="identification_marks" id="identification_marks"
                                            value="{{ old('identification_marks') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-id-card absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full flex justify-between px-4 pb-4 gap-2 mt-8">
                            <button type="button" class="next-step text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Step 2: Family Information --}}
                    <div class="form-step hidden" data-step="2">
                        <div class="w-full flex flex-col gap-2 px-4 mt-4">
                            <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                                <span class="text-lg font-bold text-ternary">Family Information</span>
                            </div>

                            <div class="w-full grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4">
                           
                                                            <!-- Father's Name -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="father_name" class="font-semibold text-ternary/90 text-sm">Father's Name *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="father_name" id="father_name"
                                            value="{{ old('father_name') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('father_name') border-red-500 @enderror">
                                        <i class="fa fa-user-tie absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('father_name')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Mother's Name -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="mother_name" class="font-semibold text-ternary/90 text-sm">Mother's Name *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="mother_name" id="mother_name"
                                            value="{{ old('mother_name') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('mother_name') border-red-500 @enderror">
                                        <i class="fa fa-user-nurse absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('mother_name')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Spouse Name -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="spouse_name" class="font-semibold text-ternary/90 text-sm">Spouse Name</label>
                                    <div class="w-full relative">
                                        <input type="text" name="spouse_name" id="spouse_name"
                                            value="{{ old('spouse_name') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-ring absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <!-- Number of Children -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="children" class="font-semibold text-ternary/90 text-sm">Number of Children</label>
                                    <div class="w-full relative">
                                        <input type="number" name="children" id="children"
                                            value="{{ old('children') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-child absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="w-full flex justify-between px-4 pb-4 gap-2 mt-8">
                            <button type="button" class="next-step text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>


                    {{-- Step 2: Contact Information --}}
                    <div class="form-step hidden" data-step="3">
                        <div class="w-full flex flex-col gap-2 px-4 mt-4">
                            <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                                <span class="text-lg font-bold text-ternary">Contact Information</span>
                            </div>

                            <div class="w-full grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4">
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="email" class="font-semibold text-ternary/90 text-sm">Email Address *</label>
                                    <div class="w-full relative">
                                        <input type="email" name="email" id="email" requiresdd
                                            value="{{ old('email') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('email') border-red-500 @enderror">
                                        <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('email')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="phone_number" class="font-semibold text-ternary/90 text-sm">Phone Number *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="phone_number" id="phone_number" requiresdd
                                            value="{{ old('phone_number') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('phone_number') border-red-500 @enderror">
                                        <i class="fa fa-phone-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('phone_number')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="citizenship_id" class="font-semibold text-ternary/90 text-sm">Citizenship ID</label>
                                    <div class="w-full relative">
                                        <input type="text" name="citizenship_id" id="citizenship_id"
                                            value="{{ old('citizenship_id') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-id-card absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <!-- <div class="w-full relative group flex flex-col gap-1">
                                    <label for="zip_code" class="font-semibold text-ternary/90 text-sm">Zip/Postal Code</label>
                                    <div class="w-full relative">
                                        <input type="text" name="zip_code" id="zip_code"
                                            value="{{ old('zip_code') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-mail-bulk absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div> -->
                                <div class="w-full relative group flex flex-col gap-1">
                                            <label for="zip_code" class="font-semibold text-ternary/90 text-sm">Zip/Postal Code</label>
                                            <div class="w-full relative flex items-center gap-2">
                                                <input type="text" name="zip_code" id="zip_code"
                                                    value="{{ old('zip_code') }}"
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
                                        <textarea name="permanent_address" id="permanent_address" requiresdd
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                @error('permanent_address') border-red-500 @enderror">{{ old('permanent_address') }}</textarea>
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
                                            value="{{ old('street') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-road absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="city" class="font-semibold text-ternary/90 text-sm">City *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="city" id="city" requiresdd
                                            value="{{ old('city') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('city') border-red-500 @enderror">
                                        <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('city')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="country" class="font-semibold text-ternary/90 text-sm">Country *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="country" id="country" requiresdd
                                            value="{{ old('country') }}"
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

                        <div class="w-full flex justify-between px-4 pb-4 gap-2 mt-8">
                            <button type="button" class="prev-step text-sm bg-ternary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/90 text-ternary hover:text-white hover:bg-ternary hover:border-ternary/30 transition ease-in duration-200">
                                <i class="fa fa-arrow-left mr-1"></i> Previous
                            </button>
                            <button type="button" class="next-step text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                Next: Passport Info <i class="fa fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Step 3: Passport Information --}}
                    <div class="form-step hidden" data-step="4">
                        <div class="w-full flex flex-col gap-2 px-4 mt-4">
                            <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                                <span class="text-lg font-bold text-ternary">Passport Information</span>
                            </div>

                            <div class="w-full grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4">
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="passport_country" class="font-semibold text-ternary/90 text-sm">Passport Country *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="passport_country" id="passport_country" requiresdd
                                            value="{{ old('passport_country') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('passport_country') border-red-500 @enderror">
                                        <i class="fa fa-passport absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('passport_country')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="passport_issue_place" class="font-semibold text-ternary/90 text-sm">Passport Issue Place *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="passport_issue_place" id="passport_issue_place" requiresdd
                                            value="{{ old('passport_issue_place') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('passport_issue_place') border-red-500 @enderror">
                                        <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('passport_issue_place')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="passport_ic_number" class="font-semibold text-ternary/90 text-sm">Passport/IC Number *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="passport_ic_number" id="passport_ic_number" requiresdd
                                            value="{{ old('passport_ic_number') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('passport_ic_number') border-red-500 @enderror">
                                        <i class="fa fa-id-card absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('passport_ic_number')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="passport_issue_date" class="font-semibold text-ternary/90 text-sm">Passport Issue Date *</label>
                                    <div class="w-full relative">
                                        <input type="date" name="passport_issue_date" id="passport_issue_date" requiresdd
                                            value="{{ old('passport_issue_date') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('passport_issue_date') border-red-500 @enderror">
                                        <i class="fa fa-calendar-check absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('passport_issue_date')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="passport_expiry_date" class="font-semibold text-ternary/90 text-sm">Passport Expiry Date *</label>
                                    <div class="w-full relative">
                                        <input type="date" name="passport_expiry_date" id="passport_expiry_date" requiresdd
                                            value="{{ old('passport_expiry_date') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('passport_expiry_date') border-red-500 @enderror">
                                        <i class="fa fa-calendar-times absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('passport_expiry_date')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- <div class="w-full relative group flex flex-col gap-1">
                                    <label for="number_of_entries" class="font-semibold text-ternary/90 text-sm">Number of Entries</label>
                                    <div class="w-full relative">
                                        <input type="text" name="number_of_entries" id="number_of_entries"
                                            value="{{ old('number_of_entries') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-sign-in-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="visa_period" class="font-semibold text-ternary/90 text-sm">Visa Period (Days)</label>
                                    <div class="w-full relative">
                                        <input type="number" name="visa_period" id="visa_period"
                                            value="{{ old('visa_period') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-clock absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div> -->
                            </div>
                        </div>

                        <div class="w-full flex justify-between px-4 pb-4 gap-2 mt-8">
                            <button type="button" class="prev-step text-sm bg-ternary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/90 text-ternary hover:text-white hover:bg-ternary hover:border-ternary/30 transition ease-in duration-200">
                                <i class="fa fa-arrow-left mr-1"></i> Previous
                            </button>
                            <button type="button" class="next-step text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                Next: Travel Details <i class="fa fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Step 4: Travel Details --}}
                    <div class="form-step hidden" data-step="5">
                        <div class="w-full flex flex-col gap-2 px-4 mt-4">
                            <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                                <span class="text-lg font-bold text-ternary">Travel Details</span>
                            </div>

                            <div class="w-full grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4">
                                <!-- <div class="w-full relative group flex flex-col gap-1">
                                    <label for="expected_journey_date" class="font-semibold text-ternary/90 text-sm">Expected Journey Date</label>
                                    <div class="w-full relative">
                                        <input type="date" name="expected_journey_date" id="expected_journey_date"
                                            value="{{ old('expected_journey_date') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-plane-departure absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="port_of_arrival" class="font-semibold text-ternary/90 text-sm">Port of Arrival</label>
                                    <div class="w-full relative">
                                        <input type="text" name="port_of_arrival" id="port_of_arrival"
                                            value="{{ old('port_of_arrival') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-plane-arrival absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="port_of_exit" class="font-semibold text-ternary/90 text-sm">Port of Exit</label>
                                    <div class="w-full relative">
                                        <input type="text" name="port_of_exit" id="port_of_exit"
                                            value="{{ old('port_of_exit') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-plane absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1 col-span-3">
                                    <label for="places_to_visit" class="font-semibold text-ternary/90 text-sm">Places to Visit</label>
                                    <div class="w-full relative">
                                        <textarea name="places_to_visit" id="places_to_visit"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('places_to_visit') }}</textarea>
                                        <i class="fa fa-map-marked-alt absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="visited_india_before" class="font-semibold text-ternary/90 text-sm">Visited India Before?</label>
                                    <div class="w-full relative">
                                        <select name="visited_india_before" id="visited_india_before"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                            <option value="0" {{ old('visited_india_before') == '0' ? 'selected' : '' }}>No</option>
                                            <option value="1" {{ old('visited_india_before') == '1' ? 'selected' : '' }}>Yes</option>
                                        </select>
                                        <i class="fa fa-question-circle absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1 col-span-2">
                                    <label for="address_in_india" class="font-semibold text-ternary/90 text-sm">Address in India</label>
                                    <div class="w-full relative">
                                        <textarea name="address_in_india" id="address_in_india"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('address_in_india') }}</textarea>
                                        <i class="fa fa-hotel absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                </div> -->

                                <div class="w-full relative group flex flex-col gap-1 col-span-3">
                                    <label for="cities_visited" class="font-semibold text-ternary/90 text-sm">Cities Visited Before (if any)</label>
                                    <div class="w-full relative">
                                        <textarea name="cities_visited" id="cities_visited"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('cities_visited') }}</textarea>
                                        <i class="fa fa-city absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="previous_visa_number" class="font-semibold text-ternary/90 text-sm">Previous Visa Number</label>
                                    <div class="w-full relative">
                                        <input type="text" name="previous_visa_number" id="previous_visa_number"
                                            value="{{ old('previous_visa_number') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-file-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="previous_visa_place" class="font-semibold text-ternary/90 text-sm">Previous Visa Place</label>
                                    <div class="w-full relative">
                                        <input type="text" name="previous_visa_place" id="previous_visa_place"
                                            value="{{ old('previous_visa_place') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="previous_visa_issue_date" class="font-semibold text-ternary/90 text-sm">Previous Visa Issue Date</label>
                                    <div class="w-full relative">
                                        <input type="date" name="previous_visa_issue_date" id="previous_visa_issue_date"
                                            value="{{ old('previous_visa_issue_date') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-calendar-day absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1 col-span-3">
                                    <label for="countries_visited_last_10_years" class="font-semibold text-ternary/90 text-sm">Countries Visited in Last 10 Years</label>
                                    <div class="w-full relative">
                                        <textarea name="countries_visited_last_10_years" id="countries_visited_last_10_years"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('countries_visited_last_10_years') }}</textarea>
                                        <i class="fa fa-globe-europe absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full flex justify-between px-4 pb-4 gap-2 mt-8">
                            <button type="button" class="prev-step text-sm bg-ternary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/90 text-ternary hover:text-white hover:bg-ternary hover:border-ternary/30 transition ease-in duration-200">
                                <i class="fa fa-arrow-left mr-1"></i> Previous
                            </button>
                            <button type="button" class="next-step text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                Next: Employment <i class="fa fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Step 5: Employment Information --}}
                    <div class="form-step hidden" data-step="6">
                        <div class="w-full flex flex-col gap-2 px-4 mt-4">
                            <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                                <span class="text-lg font-bold text-ternary">Employment Information</span>
                            </div>

                            <div class="w-full grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4">
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="present_occupation" class="font-semibold text-ternary/90 text-sm">Present Occupation</label>
                                    <div class="w-full relative">
                                        <input type="text" name="present_occupation" id="present_occupation"
                                            value="{{ old('present_occupation') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-briefcase absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="designation" class="font-semibold text-ternary/90 text-sm">Designation</label>
                                    <div class="w-full relative">
                                        <input type="text" name="designation" id="designation"
                                            value="{{ old('designation') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-user-tie absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Employer Name</label>
                                    <div class="w-full relative">
                                        <input type="text" name="employer_name" id="employer_name"
                                            value="{{ old('employer_name') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-building absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1 col-span-3">
                                    <label for="employer_address" class="font-semibold text-ternary/90 text-sm">Employer Address</label>
                                    <div class="w-full relative">
                                        <textarea name="employer_address" id="employer_address"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('employer_address') }}</textarea>
                                        <i class="fa fa-map-pin absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="employer_phone" class="font-semibold text-ternary/90 text-sm">Employer Phone</label>
                                    <div class="w-full relative">
                                        <input type="text" name="employer_phone" id="employer_phone"
                                            value="{{ old('employer_phone') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-phone-square-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="past_occupation" class="font-semibold text-ternary/90 text-sm">Past Occupation</label>
                                    <div class="w-full relative">
                                        <input type="text" name="past_occupation" id="past_occupation"
                                            value="{{ old('past_occupation') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-history absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="reference_name" class="font-semibold text-ternary/90 text-sm">Reference Name</label>
                                    <div class="w-full relative">
                                        <input type="text" name="reference_name" id="reference_name"
                                            value="{{ old('reference_name') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-user-friends absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1 col-span-3">
                                    <label for="reference_address" class="font-semibold text-ternary/90 text-sm">Reference Address</label>
                                    <div class="w-full relative">
                                        <textarea name="reference_address" id="reference_address"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('reference_address') }}</textarea>
                                        <i class="fa fa-map-marked absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full flex justify-between px-4 pb-4 gap-2 mt-8">
                            <button type="button" class="prev-step text-sm bg-ternary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/90 text-ternary hover:text-white hover:bg-ternary hover:border-ternary/30 transition ease-in duration-200">
                                <i class="fa fa-arrow-left mr-1"></i> Previous
                            </button>
                            <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-200">
                                Submit Application <i class="fa fa-check ml-1"></i>
                            </button>
                        </div>
                    </div>
        </form>
    </div>

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

                        $("#street").val(selected.data("street") || "");
                        $("#city").val(selected.data("city") || "");
                        $("#county").val(selected.data("county") || "");
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
    
    </x-agency.frontlayout>