
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
                         @php
                        
                    $permission = [];

                            if ($bookingData && $bookingData->clientrequiremtsinfo && $bookingData->clientrequiremtsinfo->name_of_field) {
                                $permission = json_decode($bookingData->clientrequiremtsinfo->name_of_field, true);
                            }

                            $alreadySelect = [];
                            if($bookingData && $bookingData->clientrequiremtsinfo && $bookingData->clientrequiremtsinfo->section_name){
                                $alreadySelect =json_decode($bookingData->clientrequiremtsinfo->section_name);
                            }
                     @endphp

                        
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
                            <label for="first_name" class="font-semibold text-ternary/90 text-sm">Family Name<span class="text-danger">*</span></label>
                            <div class="w-full relative">
                                <input type="text" name="first_name" id="first_name"
                                       value="{{ $bookingData->clint->first_name ?? '' }}"
                                       required class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-user absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        @if(in_array('Preview Name', $permission))
                            <!-- Previous Name -->
                            <div class="w-full relative group flex flex-col gap-1">
                                <label class="font-semibold text-ternary/90 text-sm">Former Family Name (if any)</label>
                                <div class="w-full relative">
                                    <input type="text"  name="previous_name" id="previous_name"
                                    value="{{ $bookingData->clint->clientinfo->previous_name ?? '' }}"
                                    class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                    <i class="fas fa-history absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                            </div>
                        @endif


                        <!-- Last Name -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="last_name" class="font-semibold text-ternary/90 text-sm">Given Name</label>
                            <div class="w-full relative">
                                <input type="text" name="last_name" id="last_name"
                                       value="{{ $bookingData->clint->last_name ?? '' }}"
                                       class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                <i class="fas fa-user absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        @if(in_array('Date of Birth', $permission))
                            <!-- Date of Birth -->
                            <div class="w-full relative group flex flex-col gap-1">
                                        <label for="date_of_birth" class="font-semibold text-ternary/90 text-sm">Date of Birth *</label>
                                        <div class="w-full relative">
                                            <input type="date" name="date_of_birth" max="9999-12-31" id="date_of_birth" requiresdd
                                                 value="{{ old('date_of_birth', $bookingData->clint->date_of_birth ?? '') }}"class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                @error('date_of_birth') border-red-500 @enderror">
                                            <i class="fa fa-calendar absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                        </div>
                                        @error('date_of_birth')
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                            </div>
                        @endif 

                         @if(in_array('Place of Birth', $permission))
                            <!-- Place of Birth -->
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="place_of_birth" class="font-semibold text-ternary/90 text-sm">Place of Birth</label>
                                <div class="w-full relative">
                                    <input type="text" name="place_of_birth" id="place_of_birth"
                                        value="{{ old('place_of_birth', $bookingData->clint->clientinfo->place_of_birth ?? '') }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                     <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                 </div>
                            </div>
                        @endif

                         @if(in_array('Country of Citizenship', $permission))
                            <!-- Country of Birth -->
                            <div class="w-full relative group flex flex-col gap-1">
                                 <label for="country_of_birth" class="font-semibold text-ternary/90 text-sm">Country of Birth</label>
                                 <div class="w-full relative">
                                     <input type="text" name="country_of_birth" id="country_of_birth"
                                         value="{{ old('country_of_birth', $bookingData->clint->clientinfo->country_of_birth ?? '') }}"
                                         class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                     <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                 </div>
                            </div>
                        @endif

                        @if(in_array('Nationality at Birth', $permission))
                                <!-- Nationality -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="nationality" class="font-semibold text-ternary/90 text-sm">Nationality *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="nationality" id="nationality" requiresdd
                                            value="{{ old('nationality', $bookingData->clint->clientinfo->nationality ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('nationality') border-red-500 @enderror">
                                        <i class="fa fa-flag absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('nationality')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif

                            <!-- Gender -->
                        @if(in_array('Gender', $permission)) 
                            <div class="w-full relative group flex flex-col gap-1">
                                            <label for="gender" class="font-semibold text-ternary/90 text-sm">Gender *</label>
                                            <div class="w-full relative">
                                                <select name="gender" id="gender" requiresdd
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                        @error('gender') border-red-500 @enderror">
                                                     @if(!$bookingData->clint->gender) 
                                                    <option value="">Select Gender</option>
                                                    @endif
                                                    <option value="MALE" {{ old('gender', $bookingData->clint->gender) == 'MALE' ? 'selected' : '' }}>Male</option>
                                                    <option value="FEMALE" {{ old('gender', $bookingData->clint->gender) == 'FEMALE' ? 'selected' : '' }}>Female</option>
                                                    <option value="OTHER" {{ old('gender', $bookingData->clint->gender) == 'OTHER' ? 'selected' : '' }}>Other</option>
                                                  </select>
                                                <i class="fa fa-venus-mars absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                            @error('gender')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                            </div>
                        @endif

                         @if(in_array('Marital Status', $permission))
                             <div class="w-full relative group flex flex-col gap-1">
                                            <label for="marital_status" class="font-semibold text-ternary/90 text-sm">Marital Status *</label>
                                            <div class="w-full relative">
                                                <select name="marital_status" id="marital_status" requiresdd
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                        @error('marital_status') border-red-500 @enderror">
                                                        @if(!$bookingData->clint->marital_status) 
                                                           <option value="">Select Status</option>
                                                       @endif
                                                    <option value="single" {{ old('marital_status', $bookingData->clint->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
                                                    <option value="married" {{ old('marital_status', $bookingData->clint->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
                                                    <option value="divorced" {{ old('marital_status', $bookingData->clint->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                                    <option value="widowed" {{ old('marital_status', $bookingData->clint->marital_status) == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                                </select>
                                                <i class="fa fa-heart absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                            @error('marital_status')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                            </div>
                         @endif

                        <!-- Phone Number -->
                          @if(in_array('Phone Number', $permission))
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="phone_number" class="font-semibold text-ternary/90 text-sm">Phone Number</label>
                                <div class="w-full relative">
                                    <input type="tel" name="phone_number" id="phone_number"
                                        value="{{ $bookingData->clint->phone_number ?? '' }}"
                                        class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200">
                                    <i class="fas fa-phone absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>
                            </div>
                         @endif

                         @if(in_array('Religion', $permission)) 
                                <!-- religion -->
                                  <div class="w-full relative group flex flex-col gap-1">
                                                                    <label for="religion" class="font-semibold text-ternary/90 text-sm">Religion</label>
                                                                    <div class="w-full relative">
                                                                        <input type="text" name="religion" id="religion"
                                                                            value="{{ old('religion', $bookingData->clint->clientinfo->religion ?? '') }}"
                                                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                                        <i class="fa fa-pray absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                                                    </div>
                                </div>
                        @endif


                        @if(in_array('Mobile/Cell No ', $permission)) 
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
                        @endif


                            @if(in_array('Nationality at Birth', $permission))
                                <!-- Past Nationality (if any) -->
                                <div class="w-full relative group flex flex-col gap-1">
                                        <label for="past_nationality" class="font-semibold text-ternary/90 text-sm">Past Nationality (if any)</label>
                                        <div class="w-full relative">
                                            <input type="text" name="past_nationality" id="past_nationality"
                                                value="{{ old('past_nationality', $bookingData->clint->clientinfo->past_nationality ?? '') }}"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                            <i class="fa fa-passport absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                        </div>
                                </div>
                            @endif

                            @if(in_array('Visible Identification Marks', $permission))
                                <!-- Identification Marks -->
                                <div class="w-full relative group flex flex-col gap-1">
                                        <label for="identification_marks" class="font-semibold text-ternary/90 text-sm">Identification Marks</label>
                                        <div class="w-full relative">
                                            <input type="text" name="identification_marks" id="identification_marks"
                                                value="{{ old('identification_marks', $bookingData->clint->clientinfo->identification_marks ?? '') }}"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                            <i class="fa fa-id-card absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                        </div>
                                </div>
                            @endif

                            @if(in_array('Languages Spoken', $permission))
                                <!-- Languages Spoken  -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="identification_marks" class="font-semibold text-ternary/90 text-sm">Languages Spoken</label>
                                    <div class="w-full relative">
                                        <input type="text" name="languages_spoken" id="languages_spoken"
                                              value="{{ old('languages_spoken', $bookingData->clint->clientinfo->language_spoken ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-id-card absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                  </div>
  
                            @endif

                            @if(in_array('Citizenship', $permission))
        
                            <div class="w-full relative group flex flex-col gap-1">
                                                            <label for="identification_marks" class="font-semibold text-ternary/90 text-sm">Citizenship</label>
                                                            <div class="w-full relative">
                                                                <input type="text" name="citizenship_id" id="citizenship_id"
                                                                    value="{{ old('citizenship_id', $bookingData->clint->clientinfo->citizenship_id ?? '') }}"
                                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                                <i class="fa fa-id-card absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                                            </div>
                            </div>
                            @endif
                    </div>
                </div>
            </div>




            @if(in_array('travel_information', $alreadySelect))
            <!-- Social Media Links Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="travel">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-primary mr-2"></i>
                        Travel Information
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="travel">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                @php
                   $socicalmedia = $bookingData->clint->clientinfo->social_media ? json_decode($bookingData->clint->clientinfo->social_media) : null;
              @endphp
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- issueg authority country -->
                          @if(in_array('Passport Type', $permission))    
                                <div class="w-full relative group flex flex-col gap-1">
                                        <label for="passport_type" class="font-semibold text-ternary/90 text-sm">Passport Type *</label>
                                        <div class="w-full relative">
                                            <input type="text" name="passport_type" id="passport_type" requiresdd
                                                value="{{ old('passport_type', $bookingData->clint->clientinfo->passport_type ?? '') }}"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                @error('passport_type') border-red-500 @enderror">
                                            <i class="fa fa-passport absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                        </div>
                                        @error('passport_country')
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                </div>
                                @endif
                                
                                @if(in_array('Number of Entries Requested', $permission))
                                <!-- noofentries -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="noofentries" class="font-semibold text-ternary/90 text-sm"> No of Travel Documents</label>
                                    <div class="w-full relative">
                                        <input type="text" name="noofentries" id="noofentries"
                                        value="{{ old('visatype', $bookingData->visasubtype->name?? '') }}" readonly=""
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                            <i class="fa fa-sign-in-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif

                                <!-- passport issue date -->
                                @if(in_array('Date of Issue', $permission))
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="passport_issue_date" max="9999-12-31" class="font-semibold text-ternary/90 text-sm">Date of Issue*</label>
                                    <div class="w-full relative">
                                        <input type="date" name="passport_issue_date" max="9999-12-31" id="passport_issue_date" requiresdd
                                            value="{{ old('passport_issue_date', $bookingData->clint->clientinfo->passport_issue_date ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('passport_issue_date') border-red-500 @enderror">
                                        <i class="fa fa-calendar-check absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('passport_issue_date')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif

                                @if(in_array('Previous Passport Number', $permission))
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="passport_expiry_date" class="font-semibold text-ternary/90 text-sm">Valid Until *</label>
                                    <div class="w-full relative">
                                        <input type="date" name="passport_expiry_date" max="9999-12-31" id="passport_expiry_date" requiresdd
                                            value="{{ old('passport_expiry_date', $bookingData->clint->clientinfo->passport_expiry_date ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('passport_expiry_date') border-red-500 @enderror">
                                        <i class="fa fa-calendar-times absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('passport_expiry_date')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif

                                   <!-- issue of place  -->
                                @if(in_array('Place of Issue', $permission))
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="passport_issue_place" class="font-semibold text-ternary/90 text-sm">Issued By *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="passport_issue_place" id="passport_issue_place" requiresdd
                                             value="{{ old('passport_issue_place', $bookingData->clint->clientinfo->passport_issue_place ?? '') }}"
                                            
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('passport_issue_place') border-red-500 @enderror">
                                        <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('passport_issue_place')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif


                                @if(in_array('Period of Visa', $permission))
                                <!-- periodofvisa -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="periodofvisa" class="font-semibold text-ternary/90 text-sm">Period of Visa ( Month) *</label>
                                            <div class="w-full relative">
                                                <input type="text" name="periodofvisa" id="periodofvisa" requiresdd
                                                
                                                    value="{{ old('periodofvisa', $bookingData->visarequireddocument->period_of_visa_month ?? '') }}"
                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                    @error('city') border-red-500 @enderror">
                                                    <i class="fa fa-calendar-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            @error('city')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div>
                                @endif

                               
                                @if(in_array('Port of Exit', $permission))
                                <!-- port of exit -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="portofexit" class="font-semibold text-ternary/90 text-sm"> Port of Exit *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="portofexit" id="portofexit" requiresdd
                                            value="{{ old('portofexit', $bookingData->visarequireddocument->port_of_exit ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('country') border-red-500 @enderror">
                                        <i class="fa fa-globe-americas absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('portofexit')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif
                                @if(in_array('Required Detail of', $permission))
                                <!-- Required Detail of * -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="country" class="font-semibold text-ternary/90 text-sm">  Required Detail of *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="requireddetailsof" id="requireddetailsof"  readonly="" requiresdd
                                               value="{{ old('requireddetailsof', $bookingData->visa->name?? '') }}" 
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('country') border-red-500 @enderror">
                                            <i class="fa fa-plane-arrival absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('country')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif
                                @if(in_array('Place of Visit', $permission)) 
                                <!-- Places to be Visited * -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="country" class="font-semibold text-ternary/90 text-sm">  Places to be Visited *</label>
                                    <div class="w-full relative">
                                    
                                        <input type="text" name="placeofvisit" id="placeofvisit" requiresdd
                                               value="{{ old('placeofvisit', $bookingData->visarequireddocument->places_to_be_visited ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('country') border-red-500 @enderror">
                                        <i class="fa fa-globe-americas absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('country')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif
                                @if(in_array('Countries to Visit', $permission)) 
                                <!-- Places to be Visited * -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="country" class="font-semibold text-ternary/90 text-sm">  Countries to Visit *</label>
                                    <div class="w-full relative">
                                    
                                        <input type="text" name="countriesofvisit" id="countriesofvisit" requiresdd
                                               value="{{ old('countriesofvisit', $bookingData->origin->countryName ?? '') }}" readonly=""
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('country') border-red-500 @enderror">
                                        <i class="fa fa-globe-americas absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('country')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif

                                @if(in_array('Purpose of Travel', $permission))
                                <!-- Purpose of Visit * -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="country" class="font-semibold text-ternary/90 text-sm">  Purpose of Visit *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="purposeofvisit" id="purposeofvisit" requiresdd
                                              value="{{ old('purposeofvisit', $bookingData->visarequireddocument->purpose_of_visit ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('purposeofvisit') border-red-500 @enderror">
                                        <i class="fa fa-globe-americas absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('purposeofvisit')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif
                    </div>
                </div>
            </div>
          @endif

            <!-- contact_details -->
            @if(in_array('contact_details', $alreadySelect))
                <!-- Other Details Section -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="contact_details">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-info-circle text-primary mr-2"></i>
                            Contact Details
                        </h2>
                        <button type="button" class="section-edit-btn text-primary hover:text-primary-dark text-sm font-medium" data-section="contact_details">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </button>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                          
                                 <!-- email address -->
                                   @if(in_array('Email Address', $permission))
                                        <div class="w-full relative group flex flex-col gap-1">
                                            <label for="email" class="font-semibold text-ternary/90 text-sm">Email Address *</label>
                                            <div class="w-full relative">
                                                <input type="email" name="email" id="email"
                                                    value="{{ $bookingData->clint->email ?? '' }}"
                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                    @error('email') border-red-500 @enderror">
                                                <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                            @error('email')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif

                                     <!-- address -->
                                    @if(in_array('Postal Code', $permission))
                                        <!-- zip code -->
                                        <div class="w-full relative group flex flex-col gap-1">
                                                    <label for="zip_code" class="font-semibold text-ternary/90 text-sm">Zip/Postal Code</label>
                                                    <div class="w-full relative flex items-center gap-2">
                                                        <input type="text" name="zip_code" id="zip_code"
                                                            value="{{ old('zip_code', $bookingData->clint->zip_code ?? '') }}"
                                                            class="w-full pl-2 pr-2 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                        <button type="button" id="searchAddress"
                                                            class="px-3 py-1 bg-secondary text-white rounded hover:bg-secondary/80">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                        </div>
                                    @endif

                                    @if(in_array('Current Residential Address', $permission))
                                    <!-- Select Address -->
                                        <div class="w-full mt-2 hidden" id="address-wrapper">
                                                    <label for="address-select" class="text-sm font-semibold text-ternary/90">Select Address</label>
                                                    <select id="address-select" name="address"
                                                        class="w-full px-2 py-1 border border-secondary/40 rounded focus:outline-none focus:border-secondary/70">
                                                    </select>
                                            </div>
                                    @endif
                                    @if(in_array('Current Residential Address', $permission))
                                    <!-- Select Address -->
                                        <div class="w-full relative group flex flex-col gap-1">
                                            <label for="permanent_address" class="font-semibold text-ternary/90 text-sm">Permanent Address *</label>
                                            <div class="w-full relative">
                                                <textarea name="permanent_address" id="permanent_address" requiresdd
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                        @error('permanent_address') border-red-500 @enderror"> {{ old('permanent_address', $bookingData->clint->permanent_address ?? '') }}</textarea>
                                                <i class="fa fa-home absolute right-3 top-4 text-sm text-secondary/80"></i>
                                            </div>
                                            @error('permanent_address')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif
                                    @if(in_array('City', $permission))
                                    <!-- Street -->
                                        <div class="w-full relative group flex flex-col gap-1">
                                            <label for="street" class="font-semibold text-ternary/90 text-sm">Street</label>
                                            <div class="w-full relative">
                                                <input type="text" name="street" id="street"
                                                    value="{{ old('street', $bookingData->clint->street ?? '') }}"
                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                <i class="fa fa-road absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                        </div>
                                    @endif
                                    <!-- City -->
                                    @if(in_array('State', $permission))
                                        <div class="w-full relative group flex flex-col gap-1">
                                            <label for="city" class="font-semibold text-ternary/90 text-sm">City *</label>
                                            <div class="w-full relative">
                                                <input type="text" name="city" id="city" requiresdd
                                                
                                                    value="{{ old('city', $bookingData->clint->city ?? '') }}"
                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                    @error('city') border-red-500 @enderror">
                                                <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                            @error('city')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif
                                    <!-- country  -->
                                    @if(in_array('Country of Residence', $permission))
                                        <div class="w-full relative group flex flex-col gap-1">
                                            <label for="country" class="font-semibold text-ternary/90 text-sm">Country *</label>
                                            <div class="w-full relative">
                                                <input type="text" name="country" id="country" requiresdd
                                                    value="{{ old('country', $bookingData->clint->country ?? '') }}"
                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                    @error('country') border-red-500 @enderror">
                                                <i class="fa fa-globe-americas absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                            @error('country')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif

                                    <!-- phone number -->
                                    @if(in_array('Phone Number (Mobile)', $permission))
                                        <div class="w-full relative group flex flex-col gap-1">
                                            <label for="phone_number" class="font-semibold text-ternary/90 text-sm">Phone Number *</label>
                                            <div class="w-full relative">
                                                <input type="text" name="phone_number" id="phone_number"
                                                    value="{{ $bookingData->clint->phone_number ?? '' }}"
                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                    @error('phone_number') border-red-500 @enderror">
                                                <i class="fa fa-phone-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                            @error('phone_number')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif
                            
                        </div>
                    </div>
                </div>
            @endif



        @if(in_array('employment_education_details', $alreadySelect))
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
                @php
                    $eduEmployData = $bookingData->clint->clientinfo->employment  ? json_decode($bookingData->clint->clientinfo->employment) : null;
                @endphp     
         
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if(in_array('Occupation', $permission))   
                         <!-- present Occupation -->
                             <div class="w-full relative group flex flex-col gap-1">
                                    <label for="present_occupation" class="font-semibold text-ternary/90 text-sm">Present Occupation</label>
                                    <div class="w-full relative">
                                        <input type="text" name="present_occupation" id="present_occupation"
                                            value="{{ old('present_occupation', $bookingData->clint->clientinfo->present_occupation ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-briefcase absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                             </div>
                             @endif


                             @if(in_array('Employer Name', $permission))
               <!-- Employer Name -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Employer Name</label>
                                    <div class="w-full relative">
                                        <input type="text" name="employer_name" id="employer_name"
                                           value="{{ old('employer_name', $bookingData->clint->clientinfo->employer_name ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-building absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif
                                 @if(in_array('Employer Address', $permission))
              <!-- Employer Address -->
                                <div class="w-full relative group flex flex-col gap-1 col-span-2">
                                    <label for="employer_address" class="font-semibold text-ternary/90 text-sm">Employer Address</label>
                                    <div class="w-full relative">
                                        <textarea name="employer_address" id="employer_address"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('employer_address', $bookingData->clint->clientinfo->employer_address ?? '') }}</textarea>
                                        <i class="fa fa-map-pin absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif
                                 @if(in_array('Employer Phone Number', $permission))
               <!-- Employer Phone Number -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="employer_phone" class="font-semibold text-ternary/90 text-sm">Employer Phone</label>
                                    <div class="w-full relative">
                                        <input type="text" name="employer_phone" id="employer_phone"
                                           value="{{ old('employer_phone', $bookingData->clint->clientinfo->employer_phone ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-phone-square-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif

                              @if(in_array('Designation', $permission))
               <!-- Designation -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="designation" class="font-semibold text-ternary/90 text-sm">Designation</label>
                                    <div class="w-full relative">
                                        <input type="text" name="designation" id="designation"
                                            value="{{ old('designation', $bookingData->clint->clientinfo->designation ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-user-tie absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif

                                
                                 @if(in_array('Past Occupaton', $permission))
                <!-- past Occupaton  -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="past_occupation" class="font-semibold text-ternary/90 text-sm">Past Occupation</label>
                                    <div class="w-full relative">
                                        <input type="text" name="past_occupation" id="past_occupation"
                                             value="{{ old('past_occupation', $bookingData->clint->clientinfo->past_occupation ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-history absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif
                                 @if(in_array('Business Name', $permission))
                                <!-- Business Name  -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="past_occupation" class="font-semibold text-ternary/90 text-sm">Business Name</label>
                                    <div class="w-full relative">
                                        <input type="text" name="business_name" id="business_name"
                                             value="{{ $eduEmployData->business_name ?? '' }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-history absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif
                                 @if(in_array('School Name', $permission))
                                <!-- School Name  -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="school_name" class="font-semibold text-ternary/90 text-sm">School Name</label>
                                    <div class="w-full relative">
                                        <input type="text" name="school_name" id="school_name"
                                             value="{{ $eduEmployData->school_name ?? '' }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-history absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif
                                 @if(in_array('Duration of Employment', $permission))
                                <!-- Duration of Employment  -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="duration_of_employment" class="font-semibold text-ternary/90 text-sm">Duration of Employment</label>
                                    <div class="w-full relative">
                                        <input type="text" name="duration_of_employment" id="duration_of_employment"
                                              value="{{ $eduEmployData->duration_of_study ?? '' }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-history absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif

                                   @if(in_array('Duty', $permission))
                                <!-- Duty  -->
                                 
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="duty" class="font-semibold text-ternary/90 text-sm">Duty</label>
                                    <div class="w-full relative">
                                        <input type="text" name="duty" id="duty"
                                              value="{{ $bookingData->clint->clientinfo->duty ?? '' }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-history absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif
                                
                                 @if(in_array('Duration of Study', $permission))
                                <!-- Duration of Study  -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="duration_of_study" class="font-semibold text-ternary/90 text-sm">Duration of Study</label>
                                    <div class="w-full relative">
                                        <input type="text" name="duration_of_study" id="duration_of_study"
                                             value="{{ $eduEmployData->duration_of_study ?? '' }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-history absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif
                                 @if(in_array('Employment Monthly Income', $permission))
                               <!-- Monthly Income  -->
                                 <div class="w-full relative group flex flex-col gap-1">
                                    <label for="employment_monthly_income" class="font-semibold text-ternary/90 text-sm">Employment Monthly Income</label>
                                    <div class="w-full relative">
                                        <input type="text" name="employment_monthly_income" id="employment_monthly_income"
                                            value="{{ $eduEmployData->employment_monthly_income ?? '' }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-history absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif
                                 @if(in_array('Educational Qualifications', $permission))
                                <!-- Educational Qualifications  -->
                                <div class="w-full relative group flex flex-col gap-1">
                                        <label for="educational_qualification" class="font-semibold text-ternary/90 text-sm">Educational Qualification</label>
                                        <div class="w-full relative">
                                            <input type="text" name="educational_qualification" id="educational_qualification"
                                                 value="{{ $bookingData->clint->clientinfo->educational_qualification ?? '' }}"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                            <i class="fa fa-graduation-cap absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                         </div>
                                </div>
                                @endif
                                 @if(in_array('Employment History', $permission))
                                <!-- Employment History  -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="past_occupation" class="font-semibold text-ternary/90 text-sm">Employment History</label>
                                    <div class="w-full relative">
                                        <input type="text" name="employment_history" id="employment_history"
                                             value="{{ $eduEmployData->employment_history ?? '' }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-history absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif
                                 @if(in_array('Education History', $permission))

                                <!-- Employment History  -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="past_occupation" class="font-semibold text-ternary/90 text-sm">Education History</label>
                                    <div class="w-full relative">
                                        <input type="text" name="education_history" id="education_history"
                                             value="{{ $eduEmployData->education_history ?? '' }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-history absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                              @endif  


                              @if(in_array('A Date from Date to', $permission))
                                <!-- Date Range -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label class="font-semibold text-ternary/90 text-sm">Date Range</label>
                                    <div class="flex gap-2 w-full">
                                        <div class="w-full relative">
                                            <input type="date" name="date_from" max="9999-12-31" id="date_from" max="2099-12-31"
                                                value="{{ request('date_from') }}"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                            <i class="fa fa-calendar absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                        </div>

                                        <div class="w-full relative">
                                            <input type="date" name="date_to" id="date_to" max="2099-12-31"
                                                value="{{ request('date_to') }}"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                            <i class="fa fa-calendar-check absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                        </div>
                                    </div>
                                </div>
                            @endif


                              @if(in_array('Military Status', $permission))
                              @php
                                $armsDetails = isset($bookingData->clint->clientinfo->arms_details)
                                    ? json_decode($bookingData->clint->clientinfo->arms_details)
                                    : null;
                                   
                            @endphp

                            <div class="mb-4">
                                <label class="font-semibold text-sm text-ternary/90">Are/were you in a Military/Semi-Military/Police/Security Organization?</label>
                                <div class="flex gap-4 mt-1">
                                    <label>
                                        <input type="radio" name="military_status" value="1"
                                            onclick="toggleMilitary(true)"
                                            {{ $bookingData->clint->clientinfo->armed_permission ? 'checked' : '' }}> Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="military_status" value="0"
                                            onclick="toggleMilitary(false)"
                                            {{ !$bookingData->clint->clientinfo->armed_permission ? 'checked' : '' }}> No
                                    </label>
                                </div>
                            </div>

                            <div id="military_section" class="{{ $armsDetails ? '' : 'hidden' }} lg:col-span-4 md:col-span-4 grid lg:grid-cols-4 gap-4 md:grid-cols-4 sm:grid-cols-2 grid-cols-1">
                                {{-- Organization --}}
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="military_organization" class="font-semibold text-ternary/90 text-sm">Organization *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="military_organization" id="military_organization" 
                                            value="{{ old('military_organization', $armsDetails->organization ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('military_organization') border-red-500 @enderror">
                                        <i class="fa fa-building-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('military_organization')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Designation --}}
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="military_designation" class="font-semibold text-ternary/90 text-sm">Designation *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="military_designation" id="military_designation" 
                                            value="{{ old('military_designation', $armsDetails->designation ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('military_designation') border-red-500 @enderror">
                                        <i class="fa fa-user-tie absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('military_designation')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Rank --}}
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="military_rank" class="font-semibold text-ternary/90 text-sm">Rank *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="military_rank" id="military_rank" 
                                            value="{{ old('military_rank', $armsDetails->rank ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('military_rank') border-red-500 @enderror">
                                        <i class="fa fa-shield-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('military_rank')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Place of Posting --}}
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="military_posting_place" class="font-semibold text-ternary/90 text-sm">Place of Posting *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="military_posting_place" id="military_posting_place" 
                                            value="{{ old('military_posting_place', $armsDetails->posting_place ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('military_posting_place') border-red-500 @enderror">
                                        <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('military_posting_place')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        @endif
                        
                    </div>
                </div>
            </div>
        @endif


        @if(in_array('visa_history_background', $alreadySelect))
            <!-- Social Media Links Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="visahistory">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-primary mr-2"></i>
                        Visa History Background
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="visahistory">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                @php
                                $visahistory = null;
                                if ($bookingData->visarequireddocument && $bookingData->visarequireddocument->visa_history_background) {
                                    $visahistory = json_decode($bookingData->visarequireddocument->visa_history_background);
                                }
                            @endphp
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="w-full relative group flex flex-col gap-1">
                                        <label for="type_of_visa" class="font-semibold text-ternary/90 text-sm">Type of Visa</label>
                                        <div class="w-full relative">
                                            <span id="type_of_visa"
                                                class="w-full block pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-red-400 text-ternary/90 focus:outline-none placeholder-ternary/70 transition ease-in duration-200">
                                                {{ $bookingData->visa->name ?? '________' }}
                                            </span>
                                            <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-red-400"></i>
                                        </div>
                                    </div>

                                    @if(in_array('Port of Entry', $permission))
                                <!-- port of arival -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="portofarrival" class="font-semibold text-ternary/90 text-sm">State of First Entry *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="portofarrival" id="portofarrival" requiresdd
                                             value="{{ old('portofarrival', $bookingData->visarequireddocument->port_of_arrival ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('country') border-red-500 @enderror">
                                        <i class="fa fa-globe-americas absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('country')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif

                                @if(in_array('Number of Entries Requested', $permission))
                                <!-- noofentries -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="noofentries" class="font-semibold text-ternary/90 text-sm">Number of Entries Requested</label>
                                    <div class="w-full relative">
                                        <input type="text" name="noofentries" id="noofentries"
                                        value="{{ old('visatype', $bookingData->visasubtype->name?? '') }}" readonly=""
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                            <i class="fa fa-sign-in-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif

                                @if(in_array('Duration of Stay', $permission))
                                    <div class="w-full relative group flex flex-col gap-1 ">
                                        <label for="cities_visited" class="font-semibold text-ternary/90 text-sm">Duration of Stay</label>
                                        <div class="w-full relative">
                                            <textarea name="previous_visas_held" id="previous_visas_held"
                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">   {{ old('previous_visas_held', $visahistory->previous_visas_held ?? '') }}</textarea>

                                        </div>
                                    </div>
                                    @endif

                                @if(in_array('Previous Schengen Travel', $permission)) 
                                <div class="mb-4">
                                        <label class="font-semibold text-sm text-ternary/90">Schengen visas issued during the past three years?</label>
                                        <div class="flex gap-4 mt-1">
                                            
                                        <label>
                                                <input type="radio" name="previousschengentravel" value="yes" {{ old('previousschengentravel', $visahistory->previousschengentravel ?? '') == 'yes' ? 'checked' : '' }}> Yes
                                                
                                                 </label>
                                            <label>
                                                <input type="radio" name="previousschengentravel" value="no" {{ old('previousschengentravel', $visahistory->previousschengentravel ?? '') == 'no' ? 'checked' : '' }}> No
                                               
                                            </label>
                                        </div>
                               </div>
                               <div class="mt-2" id="previousschengentravel_details" style="{{ old('previousschengentravel', $visahistory->previousschengentravel ?? '') == 'yes' ? '' : 'display:none;' }}">
                                        <label class="block text-sm font-medium text-gray-700">Please provide details:</label>
                                        <textarea name="previousschengentravel_details" id="previousschengentravel_details"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('previousschengentravel_details', $visahistory->previousschengentravel_details ?? '') }}</textarea>
                                       
                                    </div>
                                @endif


                                    @if(in_array('Main Destination Country', $permission)) 
                                <!-- Main Destination Country * -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="country" class="font-semibold text-ternary/90 text-sm">  Main Destination Country *</label>
                                    <div class="w-full relative">
                                    
                                        <input type="text" name="maindestinationcountry" id="maindestinationcountry" requiresdd
                                               value="{{ old('maindestinationcountry', $bookingData->destination->countryName ?? '') }}" readonly=""
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('country') border-red-500 @enderror">
                                        <i class="fa fa-globe-americas absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('country')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif

                                @if(in_array('Intended Arrival Date', $permission))
                                <!-- expected date of journey -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="expecteddate" class="font-semibold text-ternary/90 text-sm">Intended Date of Arrival *</label>
                                    <div class="w-full relative">
                                        <input type="date" name="expecteddate" max="9999-12-31" id="expecteddate"  readonly="" requiresdd
                                             value="{{ old('country', $bookingData->dateofentry ?? '') }}" readonly=""
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('country') border-red-500 @enderror">
                                        <i class="fa fa-globe-americas absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('expecteddate')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif

                    @if(in_array('Previous Visas Held', $permission)) 
                                <div class="w-full relative group flex flex-col gap-1 ">
                                    <label for="cities_visited" class="font-semibold text-ternary/90 text-sm">Previous Visas Held</label>
                                    <div class="w-full relative">
                                        <textarea name="previous_visas_held" id="previous_visas_held"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">   {{ old('previous_visas_held', $visahistory->previous_visas_held ?? '') }}</textarea>
                                        <i class="fa fa-city absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif
                                @if(in_array('Visa Rejections', $permission)) 
                                <div class="w-full relative group flex flex-col gap-1 ">
                                    <label for="visarejections" class="font-semibold text-ternary/90 text-sm">Visa Rejections</label>
                                    <div class="w-full relative">
                                        <textarea name="visarejections" id="visarejections"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('visarejections', $visahistory->visarejections ?? '') }}</textarea>
                                        <i class="fa fa-city absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif
                                
                                @if(in_array('Overstays', $permission)) 
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="overstays" class="font-semibold text-ternary/90 text-sm">Overstays</label>
                                    <div class="w-full relative">
                                        <input type="text" name="overstays" id="overstays"
                                             value="{{ old('overstays', $visahistory->overstays ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif

                               
                                @if(in_array('Countries Visited (Last 5 Years)', $permission)) 
                                <div class="w-full relative group flex flex-col gap-1 ">
                                    <label for="countries_visited_last_10_years" class="font-semibold text-ternary/90 text-sm">Countries Visited in Last 10 Years</label>
                                    <div class="w-full relative">
                                        <textarea name="countries_visited_last_10_years" id="countries_visited_last_10_years"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('countries_visited_last_10_years', $bookingData->visarequireddocument->countries_visited_last_10_years ?? '')  }}</textarea>
                                        <i class="fa fa-globe-europe absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                                @endif
                                @if(in_array('Previous UK Travel', $permission)) 
                                    <div class="mb-4">
                                            <label class="font-semibold text-sm text-ternary/90">Previous UK Travel ?</label>
                                            <div class="flex gap-4 mt-1">
                                                
                                            <label>
                                                    <input type="radio" name="has_previous_uktravel" value="yes"  {{ old('has_previous_uktravel', $visahistory->has_previous_uktravel ?? '') == 'yes' ? 'checked' : '' }}> Yes
                                                    
                                                    </label>
                                                <label>
                                                    <input type="radio" name="has_previous_uktravel" value="no" {{ old('has_previous_uktravel', $visahistory->has_previous_uktravel ?? '') == 'no' ? 'checked' : '' }} > No
                                                
                                                </label>
                                            </div>
                                </div>
                                <div class="mt-2" id="uk-travel-details" style="{{ old('has_previous_uktravel', $visahistory->has_previous_uktravel ?? '') == 'yes' ? '' : 'display:none;' }}">
                                            <label class="block text-sm font-medium text-gray-700">Please provide details:</label>
                                            <textarea name="uk_travel_details" id="uk_travel_details"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('previous_visas_held', $visahistory->uk_travel_details ?? '') }}</textarea>
                                        </div>
                                @endif

                                @if(in_array('Previous USA Travel', $permission)) 
                                    <div class="mb-4">
                                            <label class="font-semibold text-sm text-ternary/90">Previous USA Travel?</label>
                                            <div class="flex gap-4 mt-1">
                                                
                                            <label>
                                                    <input type="radio" name="previous_usa_travel" value="yes" {{ old('previous_usa_travel', $visahistory->previous_usa_travel ?? '') == 'yes' ? 'checked' : '' }}> Yes
                                                
                                                    </label>
                                                <label>
                                                    <input type="radio" name="previous_usa_travel" value="no" {{ old('previous_usa_travel', $visahistory->previous_usa_travel ?? '') == 'no' ? 'checked' : '' }}> No
                                                
                                                </label>
                                            </div>
                                            
                                </div>
                                <div class="mt-2" id="usa-travel-details" style="{{ old('previous_usa_travel', $visahistory->previous_usa_travel ?? '') == 'yes' ? '' : 'display:none;' }}">
                                            <label class="block text-sm font-medium text-gray-700">Please provide details:</label>
                                            <textarea name="usa_travel_details" id="usa_travel_details"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('usa-travel-details', $visahistory->usa_travel_details ?? '') }}</textarea>
                                    </div>
                                @endif


                                @if(in_array('Previous China Travel', $permission)) 
                                <div class="mb-4">
                                        <label class="font-semibold text-sm text-ternary/90">Previous China Travel?</label>
                                        <div class="flex gap-4 mt-1">
                                            
                                        <label>
                                                <input type="radio" name="previouschinatravel" value="yes" {{ old('previouschinatravel', $visahistory->previouschinatravel ?? '') == 'yes' ? 'checked' : '' }}> Yes
                                                
                                                 </label>
                                            <label>
                                                <input type="radio" name="previouschinatravel" value="no" {{ old('previouschinatravel', $visahistory->previouschinatravel ?? '') == 'no' ? 'checked' : '' }}> No
                                               
                                            </label>
                                        </div>
                               </div>

                                @endif

                                @if(in_array('Previous China Travel', $permission)) 
                                        <div class="mb-4">
                                                <label class="font-semibold text-sm text-ternary/90">Previous China Travel?</label>
                                                <div class="flex gap-4 mt-1">                   
                                                <label>
                                                        <input type="radio" name="previouschinatravel" value="yes" {{ old('previouschinatravel', $visahistory->previouschinatravel ?? '') == 'yes' ? 'checked' : '' }}> Yes
                                                        
                                                        </label>
                                                    <label>
                                                        <input type="radio" name="previouschinatravel" value="no" {{ old('previouschinatravel', $visahistory->previouschinatravel ?? '') == 'no' ? 'checked' : '' }}> No
                                                    
                                                    </label>
                                                </div>
                                    </div>

                                    <div class="mt-2" id="china-travel-details" style="{{ old('previouschinatravel', $visahistory->previouschinatravel ?? '') == 'yes' ? '' : 'display:none;' }}">
                                                <label class="block text-sm font-medium text-gray-700">Please provide details:</label>
                                                <textarea name="china_travel_details" id="china_travel_details"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('china_travel_details', $visahistory->china_travel_details ?? '') }}</textarea>
                                    </div>
                                @endif


                                @if(in_array('Previous Russia Travel', $permission)) 
                                        <div class="mb-4">
                                                <label class="font-semibold text-sm text-ternary/90">Previous Russia Travel?</label>
                                                <div class="flex gap-4 mt-1">
                                                    
                                                <label>
                                                        <input type="radio" name="previousrussiatravel" value="yes" {{ old('previousrussiatravel', $visahistory->previousrussiatravel ?? '') == 'yes' ? 'checked' : '' }}
                                                        > Yes
                                                        
                                                        </label>
                                                    <label>
                                                        <input type="radio" name="previousrussiatravel" value="no"  {{ old('previousrussiatravel', $visahistory->previousrussiatravel ?? '') == 'no' ? 'checked' : '' }}
                                                        > No
                                                    
                                                    </label>
                                                </div>
                                    </div>

                                    <div class="mt-2" id="russia-travel-details" style="{{ old('previousrussiatravel', $visahistory->previousrussiatravel ?? '') == 'yes' ? '' : 'display:none;' }}">
                                                <label class="block text-sm font-medium text-gray-700">Please provide details:</label>
                                                <textarea name="russia_travel_details" id="russia_travel_details"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('previous_visas_held', $visahistory->russia_travel_details ?? '') }}</textarea>
                                    </div>
                                @endif

                               @if(in_array('Previous India Travel', $permission)) 
                                        <div class="mb-4">
                                                    <label class="font-semibold text-sm text-ternary/90">Previous India Travel?</label>
                                                    <div class="flex gap-4 mt-1">
                                                        
                                                    <label>
                                                            <input type="radio" name="previoustndiatravel" value="yes" {{ old('previoustndiatravel', $visahistory->previoustndiatravel ?? '') == 'yes' ? 'checked' : '' }}>Yes
                                                            
                                                            </label>
                                                        <label>
                                                            <input type="radio" name="previoustndiatravel" value="no"  {{ old('previoustndiatravel', $visahistory->previoustndiatravel ?? '') == 'no' ? 'checked' : '' }}> No
                                                        
                                                        </label>
                                                    </div>
                                        </div>

                                    
                                        <div class="mt-2" id="india-travel-details" class="flex flex-wrap gap-4 mt-2" style="{{ old('previoustndiatravel', $visahistory->previoustndiatravel ?? '') == 'yes' ? '' : 'display:none;' }}">
                                                <label class="block text-sm font-medium text-gray-700">Address where You stayed in
                                                India:</label>
                                                <textarea name="indiaaddressstay" id="addressstay"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('indiaaddressstay', $visahistory->indiaaddressstay ?? '') }}</textarea>
                                    


                                                <label class="block text-sm font-medium text-gray-700">Cities in India Visited:</label>
                                                <input type="text" name="indiacityvisit" id="cityvisitindia" value="{{ old('indiacityvisit', $visahistory->indiacityvisit ?? '') }}"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                  
                                                <label class="block text-sm font-medium text-gray-700">Type of Visa:</label>
                                                <input type="text" name="indiatypeofvisa" id="typeofvisa" value="{{ old('indiatypeofvisa', $visahistory->indiatypeofvisa ?? '') }}"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                      
                                         


                                                <label class="block text-sm font-medium text-gray-700">Visa Number:</label>
                                                <input type="text" name="indiavisanumber" id="visanumber" value="{{ old('indiavisanumber', $visahistory->indiavisanumber ?? '') }}"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                     

                                                <label class="block text-sm font-medium text-gray-700">Visa Issued Place:</label>
                                                <input type="text" name="indiavisaissueplace" id="visaissueplace" value="{{ old('indiavisaissueplace', $visahistory->indiavisaissueplace ?? '') }}"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                          
                                    

                                                <label class="block text-sm font-medium text-gray-700">Date of Issue:</label>
                                                <input type="date" name="indiadateofissue" max="9999-12-31" id="dateofissue" value="{{ old('indiadateofissue', $visahistory->indiadateofissue ?? '') }}"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                          
                                              
                                    </div>

                            @endif
                            @if(in_array('Criminal History', $permission))                                 
                                        <div class="mb-4">
                                                <label class="font-semibold text-sm text-ternary/90">Criminal History?</label>
                                                <div class="flex gap-4 mt-1">
                                                    
                                                <label>
                                                        <input type="radio" name="criminalhistory" value="yes" {{ old('criminalhistory', $visahistory->criminalhistory ?? '') == 'yes' ? 'checked' : '' }}> Yes
                                                        
                                                        </label>
                                                    <label>
                                                        <input type="radio" name="criminalhistory" value="no" {{ old('criminalhistory', $visahistory->criminalhistory ?? '') == 'no' ? 'checked' : '' }}> No
                
                                                    </label>
                                                </div>
                                    </div>

                                    <div class="mt-2" id="criminal-history" style="{{ old('criminalhistory', $visahistory->criminalhistory ?? '') == 'yes' ? '' : 'display:none;' }}">
                                                <label class="block text-sm font-medium text-gray-700">Please provide details:</label>
                                                <textarea name="criminal_history" id="criminal_history"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('previous_visas_held', $visahistory->criminal_history ?? '') }}</textarea>
                                    </div>
                                @endif

                                @if(in_array('Denied Entry Anywhere', $permission)) 
                                        <div class="mb-4">
                                                <label class="font-semibold text-sm text-ternary/90">Denied Entry Anywhere?</label>
                                                <div class="flex gap-4 mt-1">
                                                    
                                                <label>
                                                        <input type="radio" name="deniedentryanywhere" value="yes" {{ old('deniedentryanywhere', $visahistory->deniedentryanywhere ?? '') == 'yes' ? 'checked' : '' }}> Yes
                                                        
                                                        </label>
                                                    <label>
                                                        <input type="radio" name="deniedentryanywhere" value="no" {{ old('deniedentryanywhere', $visahistory->deniedentryanywhere ?? '') == 'no' ? 'checked' : '' }}> No
                                                    
                                                    </label>
                                                </div>
                                    </div>

                                    <div class="mt-2" id="denied-entery-details" style="{{ old('deniedentryanywhere', $visahistory->deniedentryanywhere ?? '') == 'yes' ? '' : 'display:none;' }}">
                                                <label class="block text-sm font-medium text-gray-700">Please provide details:</label>
                                                <textarea name="denied_entry_anywhere" id="denied_entry_anywhere"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('previous_visas_held', $visahistory->denied_entry_anywhere ?? '') }}</textarea>
                                    </div>
                                @endif

                                @if(in_array('Security Background Questions', $permission)) 
                                <div class="w-full relative group flex flex-col gap-1 ">
                                    <label for="securitybackgroundquestions" class="font-semibold text-ternary/90 text-sm">Security Background Questions</label>
                                    <div class="w-full relative">
                                        <textarea name="securitybackgroundquestions" id="securitybackgroundquestions"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('securitybackgroundquestions', $visahistory->securitybackgroundquestions ?? '') }}</textarea>
                                        <i class="fa fa-globe-europe absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                @endif

                    </div>
                </div>
            </div>
        @endif


        
          @if(in_array('accommodation_details', $alreadySelect))
            <!-- Social Media Links Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="accommodation">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-primary mr-2"></i>
                        Accommodation Details
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="accommodation">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                @php
                            $accommodation_details = null;
                            if ($bookingData->visarequireddocument && $bookingData->visarequireddocument->accommodation_details) {
                                $accommodation_details = json_decode($bookingData->visarequireddocument->accommodation_details);
                            }
                @endphp
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                    @if(in_array('Hotel Name', $permission))
                                 <div class="relative mb-4">
                                    <label for="hotel _name" class="font-semibold text-ternary/90 text-sm">Hotel Name</label>
                                    <input type="text" name="hotel_name" id="hotel_name"
                                        value="{{ $accommodation_details->hotel_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('medical_diagnosis') border-red-500 @enderror">
                                    <!-- <i class="fa fa-notes-medical absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif


                                     @if(in_array('Full Address of Stay', $permission))
                                    <div class="relative mb-4">
                                        <label for="full_address_of_stay" class="font-semibold text-ternary/90 text-sm">Full Address of Stay</label>
                                    <input type="text" name="full_address_of_stay" id="full_address_of_stay"
                                        value="{{ $accommodation_details->full_address_of_stay ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                    @if(in_array('Contact Number of Host', $permission))
                                    <div class="relative mb-4">
                                        <label for="contact_number_of_host" class="font-semibold text-ternary/90 text-sm">Contact Number of Host</label>
                                    <input type="text" name="contact_number_of_host" id="contact_number_of_host"
                                        value="{{ $accommodation_details->contact_number_of_host ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif


                                @if(in_array('Accommodation Type', $permission))
                                <div class="relative mb-4">
                                <label for="accommodation_type" class="font-semibold text-ternary/90 text-sm">Accommodation Type</label>
                                <input type="text" name="accommodation_type" id="accommodation_type"
                                value="{{ $accommodation_details->accommodation_type ?? '' }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('patient_name') border-red-500 @enderror">
                                <!-- <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                </div>
                                @endif


                                    @if(in_array('Accommodation Host Name', $permission))
                                    <div class="relative mb-4">
                                        <label for="accommodation_host_name" class="font-semibold text-ternary/90 text-sm">Accommodation Host Name</label>
                                    <input type="text" name="accommodation_host_name" id="accommodation_host_name"
                                        value="{{ $accommodation_details->accommodation_host_name?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_name') border-red-500 @enderror">
                                    <!-- <i class="fa fa-hospital absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif
                                
                                    @if(in_array('Contact Number of Hotel', $permission))
                                    <div class="relative mb-4">
                                        <label for="Contact_number_of_hotel" class="font-semibold text-ternary/90 text-sm">Contact Number of Hotel</label>
                                    <input type="text" name="Contact_number_of_hotel" id="Contact_number_of_hotel"
                                        value="{{ $accommodation_details->Contact_number_of_hotel ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Relationship to Host', $permission))
                                    <div class="relative mb-4">
                                        <label for="relationship_to_host" class="font-semibold text-ternary/90 text-sm">Relationship to Host</label>
                                    <input type="text" name="relationship_to_host" id="relationship_to_host"
                                        value="{{ $accommodation_details->relationship_to_host ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Relationship to Host', $permission))
                                    <div class="relative mb-4">
                                        <label for="relationship_to_host" class="font-semibold text-ternary/90 text-sm">Relationship to Host</label>
                                    <input type="text" name="relationship_to_host" id="relationship_to_host"
                                        value="{{ $accommodation_details->relationship_to_host ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                    </div>
                </div>
            </div>
          @endif
          
                    @if(in_array('financial_support_details', $alreadySelect))
            <!-- Financial  Links Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="financial">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-primary mr-2"></i>
                        Financial Support Details
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="financial">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                @php
                    $funding = null;
                    if ($bookingData->visarequireddocument && $bookingData->visarequireddocument->financial_support_details) {
                        $funding = json_decode($bookingData->visarequireddocument->financial_support_details);
                    }
                @endphp
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if(in_array('Funding Source', $permission))
                                <div class="relative mb-4">
                                <label for="funding_source" class="font-semibold text-ternary/90 text-sm">Funding Source</label>
                                <input type="text" name="funding_source" id="funding_source"
                                value="{{ $funding->funding_source ?? '' }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('patient_name') border-red-500 @enderror">
                                <!-- <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                </div>
                                @endif

                                 @if(in_array('Sponsor Name', $permission))
                                 <div class="relative mb-4">
                                    <label for="sponsor_name" class="font-semibold text-ternary/90 text-sm">Sponsor Name</label>
                                    <input type="text" name="sponsor_name" id="sponsor_name"
                                        value="{{ $funding->sponsor_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('medical_diagnosis') border-red-500 @enderror">
                                    <!-- <i class="fa fa-notes-medical absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                    @if(in_array('Financial Host Name', $permission))
                                 <div class="relative mb-4">
                                    <label for="Financial_host_name" class="font-semibold text-ternary/90 text-sm">Financial Host Name</label>
                                    <input type="text" name="Financial_host_name" id="Financial_host_name"
                                        value="{{ $funding->Financial_host_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('medical_diagnosis') border-red-500 @enderror">
                                    <!-- <i class="fa fa-notes-medical absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif
                                    
                                    
                                    @if(in_array('Financial Documents', $permission))
                                    <div class="relative mb-4">
                                        <label for="financial_documents" class="font-semibold text-ternary/90 text-sm">Financial Documents</label>
                                    <input type="text" name="financial_documents" id="financial_documents"
                                        value="{{ $funding->financial_documents ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif


                                     @if(in_array('Financial Monthly Income', $permission))
                                    <div class="relative mb-4">
                                        <label for="financial_monthly_income" class="font-semibold text-ternary/90 text-sm">Financial Monthly Income</label>
                                    <input type="text" name="financial_monthly_income" id="financial_monthly_income"
                                        value="{{ $funding->financial_monthly_income ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Means of Financial Support', $permission))
                                    <div class="relative mb-4">
                                    <label for="means_of_financial_support" class="font-semibold text-ternary/90 text-sm">Means of Financial Support</label>
                                    <input type="text" name="means_of_financial_support" id="means_of_financial_support"
                                        value="{{ $funding->means_of_financial_support ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Travel Insurance Company', $permission))
                                    <div class="relative mb-4">
                                        <label for="travel_insurance_company" class="font-semibold text-ternary/90 text-sm">Travel Insurance Company</label>
                                    <input type="text" name="travel_insurance_company" id="travel_insurance_company"
                                        value="{{ $funding->travel_insurance_company ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Travel Insurance Policy Number', $permission))
                                    <div class="relative mb-4">
                                        <label for="travel_insurance_policy_number" class="font-semibold text-ternary/90 text-sm">Travel Insurance Policy Number</label>
                                    <input type="text" name="travel_insurance_policy_number" id="travel_insurance_policy_number"
                                        value="{{ $funding->travel_insurance_policy_number ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                    @if(in_array('Insurance Validity', $permission))
                                    <div class="relative mb-4">
                                        <label for="insurance_validity" class="font-semibold text-ternary/90 text-sm">Insurance Validity</label>
                                    <input type="text" name="insurance_validity" id="insurance_validity"
                                        value="{{ $funding->insurance_validity ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif
                    </div>
                </div>
            </div>
          @endif

          <!-- Start father details -->
                       @if(in_array('Father Section', $permission))
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



                                                                @endphp
                                                                <div class="p-6">
                                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                                                                @if(in_array('Father’s Full Name', $permission))
                                                                                    <div>
                                                                                    <label for="father_name" class="font-semibold text-sm text-ternary/90">Father Name</label>
                                                                                    <input type="text" name="father_name" id="father_name" value="{{ old('father_name', $fatherdetails->name ?? '') }}"
                                                                                        class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                                                    </div>
                                                                                    @endif

                                                                                    @if(in_array('Father Nationality', $permission))
                                                                                    <div>
                                                                                    <label for="father_nationality" class="font-semibold text-sm text-ternary/90">Nationality</label>
                                                                                    <input type="text" name="father_nationality" id="father_nationality" value="{{ old('father_nationality', $fatherdetails->nationality ?? '') }}"
                                                                                        class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                                                    </div>
                                                                                    @endif

                                                                                    @if(in_array('Father’s DOB', $permission))
                                                                                        <div>
                                                                                            <label for="father_dob" class="font-semibold text-sm text-ternary/90">Date of Birth</label>
                                                                                            <input type="date" max="9999-12-31"  name="father_dob" id="father_dob"
                                                                                                value="{{ old('father_dob', isset($fatherdetails->dob) ? \Carbon\Carbon::parse($fatherdetails->dob)->format('Y-m-d') : '') }}"
                                                                                                class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                                                        </div>
                                                                                    @endif

                                                                                     @if(in_array('Status in China', $permission))
                                                                                    <div>
                                                                                    <label for="father_status_in_china" class="font-semibold text-sm text-ternary/90">Status in China</label>
                                                                                    <input type="text" name="father_status_in_china" id="father_status_in_china" value="{{ old('father_status_in_china', $fatherdetails->status_in_china ?? '') }}"
                                                                                        class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                                                    </div>
                                                                                    @endif


                                                                                    @if(in_array('Father Place of Birth', $permission))
                                                                                    <div>
                                                                                    <label for="father_birth_place" class="font-semibold text-sm text-ternary/90">Place of Birth</label>
                                                                                    <input type="text" name="father_birth_place" id="father_birth_place" value="{{ old('father_birth_place', $fatherdetails->birth_place ?? '') }}"
                                                                                        class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                                                    </div>
                                                                                    @endif

                                                                                    @if(in_array('Father Previous Nationality', $permission))
                                                                                    <div>
                                                                                    <label for="father_previous_nationality" class="font-semibold text-sm text-ternary/90">Previous Nationality</label>
                                                                                    <input type="text" name="father_previous_nationality" id="father_previous_nationality" value="{{ old('father_previous_nationality', $fatherdetails->previous_nationality ?? '') }}"
                                                                                        class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                                                    </div>
                                                                                    @endif

                                                                                    @if(in_array('Father Country of birth', $permission))
                                                                                    <div>
                                                                                    <label for="father_country_of_birth" class="font-semibold text-sm text-ternary/90">Country of Birth</label>
                                                                                    <input type="text" name="father_country_of_birth" id="father_country_of_birth" value="{{ old('father_country_of_birth', $fatherdetails->country_of_birth ?? '') }}"
                                                                                        class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                                                    </div>
                                                                                    @endif


                                                                                    @if(in_array('Father Employment', $permission))
                                                                                    <div>
                                                                                    <label for="father_employment" class="font-semibold text-sm text-ternary/90">Employment Status</label>
                                                                                    <input type="text" name="father_employment" id="father_employment" value="{{ old('father_employment', $fatherdetails->employment ?? '') }}"
                                                                                        class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                                                    </div>
                                                                                    @endif

                                                                                    @if(in_array('Father Employment Address', $permission))
                                                                                    <div>
                                                                                    <label for="father_address" class="font-semibold text-sm text-ternary/90">Employment Address</label>
                                                                                    <input type="text" name="father_address" id="father_address" value="{{ old('father_address', $fatherdetails->address ?? '') }}"
                                                                                        class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                                                    </div>
                                                                                    @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <!-- end father details -->
            @if(in_array('Mother Section', $permission))
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
                    @php
                    $motherdetails = $bookingData->clint->clientinfo->mother_details ? json_decode($bookingData->clint->clientinfo->mother_details) : null;
               
                    @endphp
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                     @if(in_array('Mother’s Full Name', $permission))
                                        <div>
                                        <label for="mother_name" class="font-semibold text-sm text-ternary/90">Mother Name</label>
                                        <input type="text" name="mother_name" id="mother_name" value="{{ old('mother_name', $motherdetails->name ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Mother Nationality', $permission))
                                        <div>
                                        <label for="mother_nationality" class="font-semibold text-sm text-ternary/90">Nationality</label>
                                        <input type="text" name="mother_nationality" id="mother_nationality" value="{{ old('mother_nationality', $motherdetails->nationality ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Mother Place of Birth', $permission))
                                        <div>
                                        <label for="mother_birth_place" class="font-semibold text-sm text-ternary/90">Place of Birth</label>
                                        <input type="text" name="mother_birth_place" id="mother_birth_place" value="{{ old('mother_birth_place', $motherdetails->birth_place ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Mother Previous Nationality', $permission))
                                        <div>
                                        <label for="mother_previous_nationality" class="font-semibold text-sm text-ternary/90">Previous Nationality</label>
                                        <input type="text" name="mother_previous_nationality" id="mother_previous_nationality" value="{{ old('mother_previous_nationality', $motherdetails->previous_nationality ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Mother Country of birth', $permission))
                                        <div>
                                        <label for="mother_country_of_birth" class="font-semibold text-sm text-ternary/90">Country of Birth</label>
                                        <input type="text" name="mother_country_of_birth" id="mother_country_of_birth" value="{{ old('mother_country_of_birth', $motherdetails->country_of_birth ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Mother’s DOB', $permission))
                                        <div>
                                        <label for="mother_dob" class="font-semibold text-sm text-ternary/90">Date of Birth</label>
                                        <input type="date" name="mother_dob" max="9999-12-31" id="mother_dob" value="{{ old('mother_dob', isset($motherdetails->dob) ? \Carbon\Carbon::parse($motherdetails->dob)->format('Y-m-d') : '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Mother Employment', $permission))
                                        <div>
                                        <label for="mother_employment" class="font-semibold text-sm text-ternary/90">Employment Status</label>
                                        <input type="text" name="mother_employment" id="mother_employment" value="{{ old('mother_employment', $motherdetails->employment ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Status in China', $permission))
                                        <div>
                                        <label for="mother_status_in_china" class="font-semibold text-sm text-ternary/90">Status in China</label>
                                        <input type="text" name="mother_status_in_china" id="mother_status_in_china" value="{{ old('mother_status_in_china', $motherdetails->status_in_china ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Employment Address', $permission))
                                        <div>
                                        <label for="mother_address" class="font-semibold text-sm text-ternary/90">Employment Address</label>
                                        <input type="text" name="mother_address" id="mother_address" value="{{ old('mother_address', $motherdetails->address ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                    @endif
                            <!-- Employer Phone Number -->
                        </div>
                    </div>
                </div>
            @endif

            @if(in_array('Spouse Section', $permission))
                <!-- Spouse  Details Section -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="spouse">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-briefcase text-primary mr-2"></i>
                            Spouse Details 
                        </h2>
                        <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="spouse">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </button>
                    </div>
                    @php
                    $spouse = $bookingData->clint->clientinfo->spouse_details ? json_decode($bookingData->clint->clientinfo->spouse_details) : null;
                    @endphp
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                @if(in_array('Spouse’s Full Name', $permission))
                                                        <div class="w-full">
                                                        <label for="spouse_name" class="font-semibold text-ternary/90 text-sm">Husband / Wife Name</label>
                                                        <input type="text" name="spouse_name" id="spouse_name"
                                                            value="{{ old('spouse_name', $spouse->name ?? '') }}"
                                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                        </div>
                                                @endif

                                               @if(in_array('Spouse’s Place of Birth', $permission))
                                                 <div class="w-full">
                                                      <label for="spouse_birth_place" class="font-semibold text-ternary/90 text-sm">Place of Birth</label>
                                                        <input type="text" name="spouse_birth_place" id="spouse_birth_place"
                                                            value="{{ old('spouse_birth_place', $spouse->birth_place ?? '') }}"
                                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                 </div>
                                                @endif

                                                        @if(in_array('Spouse’s Nationality', $permission))
                                                        <div class="w-full">
                                                        <label for="spouse_nationality" class="font-semibold text-ternary/90 text-sm">Nationality</label>
                                                        <input type="text" name="spouse_nationality" id="spouse_nationality"
                                                            value="{{ old('spouse_nationality', $spouse->nationality ?? '') }}"
                                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                        </div>
                                                        @endif

                                                        @if(in_array('Spouse’s Previous Nationality', $permission))
                                                        <div class="w-full">
                                                        <label for="spouse_previous_nationality" class="font-semibold text-ternary/90 text-sm">Previous Nationality</label>
                                                        <input type="text" name="spouse_previous_nationality" id="spouse_previous_nationality"
                                                            value="{{ old('spouse_previous_nationality', $spouse->previous_nationality ?? '') }}"
                                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                        </div>
                                                        @endif

                                                        @if(in_array('Spouse’s DOB', $permission))
                                                        <div class="w-full">
                                                        <label for="spouse_dob" class="font-semibold text-ternary/90 text-sm">Date of Birth</label>
                                                        <input type="date" max="9999-12-31" name="spouse_dob" id="spouse_dob"
                                                        value="{{ old('spouse_dob', isset($spouse->dob) ? \Carbon\Carbon::parse($spouse->dob)->format('Y-m-d') : '') }}"
                                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                        </div>
                                                        @endif

                                                        @if(in_array('Spouse’s Employment Status', $permission))
                                                        <div class="w-full">
                                                        <label for="spouse_employment" class="font-semibold text-ternary/90 text-sm">Employment Status</label>
                                                        <input type="text" name="spouse_employment" id="spouse_employment"
                                                            value="{{ old('spouse_employment', $spouse->employment ?? '') }}"
                                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                        </div>
                                                        @endif

                                                        @if(in_array('Spouse’s Address', $permission))
                                                        <div class="w-full">
                                                        <label for="spouse_address" class="font-semibold text-ternary/90 text-sm">Address</label>
                                                        <input type="text" name="spouse_address" id="spouse_address"
                                                            value="{{ old('spouse_address', $spouse->address ?? '') }}"
                                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                        </div>
                                                         @endif
                                                         

            </div>
      
@endif
                    
             <!-- details of children -->
            @if(in_array('Children Section', $permission))
                                                            <div class="mb-4 mt-4 p-6">
                                                                <label class="font-semibold text-sm text-ternary/90">Do you have a child?</label>
                                                                <div class="flex gap-4 mt-1">
                                                                    <label>
                                                                        <input type="radio" name="has_child" value="yes"
                                                                            {{ !empty($bookingData->clint->clientinfo->children) ? 'checked' : '' }}> Yes
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" name="has_child" value="no"
                                                                            {{ empty($bookingData->clint->clientinfo->children) ? 'checked' : '' }}> No
                                                                    </label>
                                                                </div>
                                                            </div>
                                                           <div class="w-full lg:col-span-2">
                                                        @php
                                                                $childrenJson = $bookingData->clint->clientinfo->children ?? '[]';
                                                                $children = json_decode($childrenJson);

                                                                $childsection = is_array($children) && count($children) > 0;
                                                            @endphp
                                                        <div id="childInfoSection" class="{{ !$childsection ? 'hidden' : '' }} mb-4 p-6">
                                                            <div id="childFieldsContainer" class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4">
                                                                @if($childsection)
                                                                    @forelse($children as $child)
                                                                        <div class="child-fields border p-4 mb-4 rounded-[3px] rounded-tr-[8px] border-secondary/40 bg-white shadow-sm relative bg-black/10 shadow-lg shadow-black/10">
                                                                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 pt-6">
                                                                                <div>
                                                                                    <label class="font-semibold text-sm text-ternary/90">Name</label>
                                                                                    <input type="text" name="child_name[]" value="{{ $child->name }}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                                                                                </div>

                                                                                 <div>
                                                                                    <label class="font-semibold text-sm text-ternary/90">Nationality</label>
                                                                                    <input type="text" name="child_nationality[]" value="{{ $child->nationality }}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                                                                                </div>

                                                                                <div>
                                                                                    <label class="font-semibold text-sm text-ternary/90">Date of Birth</label>
                                                                                    <input type="date" name="child_dob[]" value="{{ $child->dob }}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                                                                                </div>

                                                                                <div class="col-span-full">
                                                                                    <label class="font-semibold text-sm text-ternary/90">Address</label>
                                                                                    <input type="text" name="child_address[]" value="{{ $child->address }}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                                                                                </div>
                                                                            </div>

                                                                            <button type="button" class="removeChildBtn absolute top-2 right-2 text-red-500 hover:text-white text-xs border border-red-500 hover:bg-red-500 rounded px-2 py-[1px]">
                                                                                Remove
                                                                            </button>
                                                                        </div>
                                                                    @empty
                                                                        <p>No children data found.</p>
                                                                    @endforelse
                                                                @endif
                                                            </div>

                                                        @if(in_array('Relative Information', $permission))
                                                <!-- Relative Information -->

                                                <div class="w-full relative group flex flex-col gap-1 col-span-2">
                                                    <label for="relative_information" class="font-semibold text-ternary/90 text-sm">Relative Information</label>
                                                    <div class="w-full relative">
                                                        <textarea name="relative_information" id="relative_information"
                                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('relative_information', $bookingData->clint->clientinfo->relative_information ?? '') }}</textarea>
                                                        <i class="fa fa-info-circle absolute right-3 top-4 text-sm text-secondary/80"></i>
                                                    </div>
                                                </div>
                                            @endif
                                                            <!-- Add More Button -->
                                                            <!-- <div class="w-full flex justify-start">
                                                                <button type="button" class="bg-primary/30 text-ternary font-semibold border-[2px] border-primary/90 px-4 py-1 rounded-[3px] rounded-tr-[8px] hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200" id="addMoreChild">
                                                                    Add More
                                                                </button>
                                                            </div> -->
                                                        </div>
                                                   </div>
                                                    @endif

  </div>
    </div>
                                                    
        

            
              
             

     
         @if(in_array('passport_information', $alreadySelect))
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

                              @if(in_array('Issuing Authority', $permission))    
                                <div class="w-full relative group flex flex-col gap-1">
                                        <label for="passport_country" class="font-semibold text-ternary/90 text-sm">Passport Country *</label>
                                        <div class="w-full relative">
                                            <input type="text" name="passport_country" id="passport_country" requiresdd
                                                value="{{ old('passport_country', $bookingData->clint->clientinfo->passport_country ?? '') }}"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                @error('passport_country') border-red-500 @enderror">
                                            <i class="fa fa-passport absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                        </div>
                                        @error('passport_country')
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                </div>
                                @endif

                                <!-- passport number  -->
                                @if(in_array('Passport Number', $permission))
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="passport_ic_number" class="font-semibold text-ternary/90 text-sm">Passport Number *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="passport_ic_number" id="passport_ic_number" requiresdd
                                            value="{{ old('passport_ic_number', $bookingData->clint->clientinfo->passport_ic_number ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('passport_ic_number') border-red-500 @enderror">
                                        <i class="fa fa-id-card absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('passport_ic_number')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif

                                @php
                                $other_passport_details = isset($bookingData->clint->clientinfo->other_passport_details)
                                    ? json_decode($bookingData->clint->clientinfo->other_passport_details)
                                    : null;
                                    

                            @endphp
                            @if(in_array('Previous Passport Number', $permission))
                          
                                <div class="mb-4">
                                    <label class="font-semibold text-sm text-ternary/90">Any Other Valid Passport/Identity Certificate held</label>
                                    <div class="flex gap-4 mt-1">
                                        <label>
                                            <input type="radio" name="haspassportidenty" value="yes"
                                                onclick="togglePassportidentity(true)"
                                                {{ $other_passport_details ? 'checked' : '' }}> Yes
                                        </label>
                                        <label>
                                            <input type="radio" name="haspassportidenty" value="no"
                                                onclick="togglePassportidentity(false)"
                                                {{ !$other_passport_details ? 'checked' : '' }}> No
                                        </label>
                                    </div>
                                </div>

                                <div id="passport_identity_section" class="{{ $other_passport_details ? '' : 'hidden' }} lg:col-span-4 md:col-span-4 grid lg:grid-cols-4 gap-4 md:grid-cols-4 sm:grid-cols-2 grid-cols-1">
                                            <div class="w-full relative group flex flex-col gap-1">
                                                <label for="other_passport_country" class="font-semibold text-ternary/90 text-sm">Country Of issue *</label>
                                                <div class="w-full relative">
                                                    <input type="text" name="other_passport_country" id="other_passport_country" requireed
                                                        value="{{ old('other_passport_country', $other_passport_details->country ?? '') }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('other_passport_country') border-red-500 @enderror">
                                                    <i class="fa fa-passport absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                                </div>
                                                @error('other_passport_country')
                                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="w-full relative group flex flex-col gap-1">
                                                <label for="other_passport_issue_place" class="font-semibold text-ternary/90 text-sm">Passport Issue Place *</label>
                                                <div class="w-full relative">
                                                    <input type="text" name="other_passport_issue_place" id="other_passport_issue_place" requiredd
                                                        value="{{ old('other_passport_issue_place', $other_passport_details->issue_place ?? '') }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('other_passport_issue_place') border-red-500 @enderror">
                                                    <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                                </div>
                                                @error('other_passport_issue_place')
                                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="w-full relative group flex flex-col gap-1">
                                                <label for="other_passport_ic_number" class="font-semibold text-ternary/90 text-sm">Passport/IC Number *</label>
                                                <div class="w-full relative">
                                                    <input type="text" name="other_passport_ic_number" id="other_passport_ic_number" requireed
                                                        value="{{ old('other_passport_ic_number', $other_passport_details->ic_number ?? '') }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('other_passport_ic_number') border-red-500 @enderror">
                                                    <i class="fa fa-id-card absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                                </div>
                                                @error('other_passport_ic_number')
                                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="w-full relative group flex flex-col gap-1">
                                                <label for="other_passport_issue_date" class="font-semibold text-ternary/90 text-sm">Passport Issue Date *</label>
                                                <div class="w-full relative">
                                                    <input type="date" name="other_passport_issue_date" max="9999-12-31"  id="other_passport_issue_date" requireed
                                                        value="{{ old('other_passport_issue_date', $other_passport_details->issue_date ?? '') }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('other_passport_issue_date') border-red-500 @enderror">
                                                    <i class="fa fa-calendar-check absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                                </div>
                                                @error('other_passport_issue_date')
                                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                </div>
                            @endif
                </div>
            </div>
         @endif
                </div>
             <!-- Father Details -->

        <!-- end part  -->
                    <!-- Employer Phone Number -->
                    


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
                                <input type="date" name="other_passport_issue_date" max="9999-12-31" id="other_passport_issue_date" required
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

        @if(in_array('social_media_online_presence', $alreadySelect))
            <!-- Social Media Links Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="socialmedia">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-primary mr-2"></i>
                        Social Media 
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="socialmedia">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                @php
                   $socicalmedia = $bookingData->clint->clientinfo->social_media ? json_decode($bookingData->clint->clientinfo->social_media) : null;
              @endphp
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                       <!-- email address -->
                       @if(in_array('Facebook', $permission))
                                        <div class="w-full relative group flex flex-col gap-1">
                                            <label for="facebook" class="font-semibold text-ternary/90 text-sm">Facebook *</label>
                                            <div class="w-full relative">
                                                <input type="text" name="facebook" id="facebook"
                                                    value="{{ $socicalmedia->facebook ?? '' }}"
                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                    @error('email') border-red-500 @enderror">
                                                <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                            @error('email')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                        @endif

                                    <!-- phone number -->
                                    @if(in_array('Instagram', $permission))
                                        <div class="w-full relative group flex flex-col gap-1">
                                            <label for="instagram" class="font-semibold text-ternary/90 text-sm">Instagram*</label>
                                            <div class="w-full relative">
                                                <input type="text" name="instagram" id="instagram"
                                                     value="{{ $socicalmedia->instagram ?? '' }}"
                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                    @error('phone_number') border-red-500 @enderror">
                                                <i class="fa fa-phone-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                            @error('phone_number')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif
                        
                                    <!-- address -->
                                    @if(in_array('Twitter', $permission))
                                        <!-- zip code -->
                                        <div class="w-full relative group flex flex-col gap-1">
                                                    <label for="twitter" class="font-semibold text-ternary/90 text-sm">Twitter</label>
                                                    <div class="w-full relative flex items-center gap-2">
                                                        <input type="text" name="twitter" id="twitter"
                                                            value="{{ $socicalmedia->twitter ?? '' }}"
                                                            class="w-full pl-2 pr-2 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                        
                                                    </div>
                                        </div>
                                    @endif
                                    

                                      <!-- address -->
                                      @if(in_array('LinkedIn', $permission))
                                        <!-- zip code -->
                                        <div class="w-full relative group flex flex-col gap-1">
                                                    <label for="linkedIn" class="font-semibold text-ternary/90 text-sm">LinkedIn</label>
                                                    <div class="w-full relative flex items-center gap-2">
                                                        <input type="text" name="linkedIn" id="linkedIn"
                                                            value="{{ $socicalmedia->linkedIn ?? '' }}"
                                                            class="w-full pl-2 pr-2 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                        
                                                    </div>
                                        </div>
                                    @endif

                                      <!-- address -->
                                    @if(in_array('Other Social Media Accounts', $permission))
                                        <!-- zip code -->
                                        <div class="w-full relative group flex flex-col gap-1">
                                                    <label for="othersocialmediaaccounts" class="font-semibold text-ternary/90 text-sm">Other Social Media Accounts</label>
                                                    <div class="w-full relative flex items-center gap-2">
                                                        <input type="text" name="othersocialmediaaccounts" id="othersocialmediaaccounts"
                                                            value="{{ $socicalmedia->other_social_media_accounts ?? '' }}"
                                                            class="w-full pl-2 pr-2 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                        
                                                    </div>
                                        </div>
                                    @endif

                                      <!-- address -->
                                    @if(in_array('Personal Website', $permission))
                                        <!-- zip code -->
                                        <div class="w-full relative group flex flex-col gap-1">
                                                    <label for="linkedIn" class="font-semibold text-ternary/90 text-sm">Personal Website</label>
                                                    <div class="w-full relative flex items-center gap-2">
                                                        <input type="text" name="personalwebsite" id="personalwebsite"
                                                           value="{{ $socicalmedia->personal_website ?? '' }}"
                                                            class="w-full pl-2 pr-2 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                        
                                                    </div>
                                        </div>
                                    @endif


                                      <!-- address -->
                                    @if(in_array('Blog URLs', $permission))
                                        <!-- zip code -->
                                        <div class="w-full relative group flex flex-col gap-1">
                                                    <label for="blogurl" class="font-semibold text-ternary/90 text-sm">Blog URLs</label>
                                                    <div class="w-full relative flex items-center gap-2">
                                                        <input type="text" name="blogurl" id="blogurl"
                                                             value="{{ $socicalmedia->blog_url ?? '' }}"
                                                            class="w-full pl-2 pr-2 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                        
                                                    </div>
                                        </div>
                                    @endif

                    </div>
                </div>
            </div>
        @endif
        


          @if(in_array('medical_visa_specifics', $alreadySelect))
            <!-- Social Media Links Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="medical">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-primary mr-2"></i>
                        Medical Visa
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="medical">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                @php
                                $medical = null;
                                if ($bookingData->visarequireddocument && $bookingData->visarequireddocument->medical_visa_specifics) {
                                    $medical = json_decode($bookingData->visarequireddocument->medical_visa_specifics);
                                }
                            @endphp

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if(in_array('Patient Name', $permission))
                                                <div class="relative mb-4">
                                                        <label for="patient_name" class="font-semibold text-ternary/90 text-sm">Patient Name </label>
                                                    <input type="text" name="patient_name" id="patient_name"
                                                        value="{{ $medical->patient_name ?? '' }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('patient_name') border-red-500 @enderror">
                                                    <!-- <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                            </div>
                                @endif
                             
                                @if(in_array('Medical Diagnosis', $permission))
                                 <div class="relative mb-4">
                                    <label for="medical_diagnosis" class="font-semibold text-ternary/90 text-sm">Medical Diagnosis</label>
                                    <input type="text" name="medical_diagnosis" id="medical_diagnosis"
                                        value="{{ $medical->medical_diagnosis ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('medical_diagnosis') border-red-500 @enderror">
                                    <!-- <i class="fa fa-notes-medical absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                             </div>
                                    @endif

                                    @if(in_array('Hospital Name', $permission))
                                    <div class="relative mb-4">
                                        <label for="hospital_name" class="font-semibold text-ternary/90 text-sm">Hospital Name</label>
                                    <input type="text" name="hospital_name" id="hospital_name"
                                        value="{{ $medical->hospital_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_name') border-red-500 @enderror">
                                    <!-- <i class="fa fa-hospital absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif
                                    

                                    @if(in_array('Hospital Address', $permission))
                                    <div class="relative mb-4">
                                        <label for="hospital_address" class="font-semibold text-ternary/90 text-sm">Hospital Address</label>
                                    <input type="text" name="hospital_address" id="hospital_address"
                                        value="{{ $medical->hospital_address ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif
                     

                                     @if(in_array('Treatment Duration', $permission))
                                    <div class="relative mb-4">
                                        <label for="treatment_duration" class="font-semibold text-ternary/90 text-sm">Treatment Duration</label>
                                    <input type="text" name="treatment_duration" id="treatment_duration"
                                        value="{{ $medical->treatment_duration ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Treatment Cost', $permission))
                                    <div class="relative mb-4">
                                        <label for="treatment_cost" class="font-semibold text-ternary/90 text-sm">Treatment Cost</label>
                                    <input type="text" name="treatment_cost" id="treatment_cost"
                                        value="{{ $medical->treatment_cost ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Attendant Name', $permission))
                                    <div class="relative mb-4">
                                        <label for="attendant_name" class="font-semibold text-ternary/90 text-sm">Attendant Name</label>
                                    <input type="text" name="attendant_name" id="attendant_name"
                                        value="{{ $medical->attendant_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Attendant Details', $permission))
                                    <div class="relative mb-4">
                                        <label for="attendant_details" class="font-semibold text-ternary/90 text-sm">Attendant Details</label>
                                    <input type="text" name="attendant_details" id="attendant_details"
                                        value="{{ $medical->attendant_details ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                 
                  </div>
                </div>
            </div>
          @endif



          @if(in_array('student_visa_specifics', $alreadySelect))
            <!-- Social Media Links Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="student">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-primary mr-2"></i>
                        Student Visa Specifics
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="student">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                   @php
                            $student_visa_specifics = null;
                            if ($bookingData->visarequireddocument && $bookingData->visarequireddocument->student_visa_specifics) {
                                $student_visa_specifics = json_decode($bookingData->visarequireddocument->student_visa_specifics);
                            }
                        @endphp

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  
                    @if(in_array('Course Name', $permission))
                                 <div class="relative mb-4">
                                     <label for="course_name" class="font-semibold text-ternary/90 text-sm">Course Name</label>
                                     <input type="text" name="course_name" id="course_name"
                                    value="{{ $student_visa_specifics->course_name ?? '' }}"
                                     class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('patient_name') border-red-500 @enderror">
                                                        <!-- <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                @endif

                                 @if(in_array('Institution Name', $permission))
                                 <div class="relative mb-4">
                                    <label for="institution_name" class="font-semibold text-ternary/90 text-sm">Institution Name</label>
                                    <input type="text" name="institution_name" id="institution_name"
                                        value="{{ $student_visa_specifics->institution_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('medical_diagnosis') border-red-500 @enderror">
                                    <!-- <i class="fa fa-notes-medical absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                    @if(in_array('Institution Address', $permission))
                                    <div class="relative mb-4">
                                        <label for="institution_address" class="font-semibold text-ternary/90 text-sm">Institution Address</label>
                                    <input type="text" name="institution_address" id="institution_address"
                                        value="{{ $student_visa_specifics->institution_address ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_name') border-red-500 @enderror">
                                    <!-- <i class="fa fa-hospital absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif
                                

                                    @if(in_array('Institution Phone', $permission))
                                    <div class="relative mb-4">
                                        <label for="institution_phone" class="font-semibold text-ternary/90 text-sm">Institution Phone</label>
                                    <input type="text" name="institution_phone" id="institution_phone"
                                        value="{{ $student_visa_specifics->institution_phone ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('SEVIS ID', $permission))
                                    <div class="relative mb-4">
                                        <label for="sevis_id" class="font-semibold text-ternary/90 text-sm">SEVIS ID</label>
                                    <input type="text" name="sevis_id" id="sevis_id"
                                        value="{{ $student_visa_specifics->sevis_id ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Tuition Fee Estimate', $permission))
                                    <div class="relative mb-4">
                                        <label for="tuition_fee_estimate" class="font-semibold text-ternary/90 text-sm">Tuition Fee Estimate</label>
                                    <input type="text" name="tuition_fee_estimate" id="tuition_fee_estimate"
                                        value="{{ $student_visa_specifics->tuition_fee_estimate ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Living Expenses Estimate', $permission))
                                    <div class="relative mb-4">
                                        <label for="living_expenses_estimate" class="font-semibold text-ternary/90 text-sm">Living Expenses Estimate</label>
                                    <input type="text" name="living_expenses_estimate" id="living_expenses_estimate"
                                        value="{{ $student_visa_specifics->living_expenses_estimate ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Attendant Name', $permission))
                                    <div class="relative mb-4">
                                        <label for="attendant_name" class="font-semibold text-ternary/90 text-sm">Attendant Name</label>
                                    <input type="text" name="attendant_name" id="attendant_name"
                                        value="{{ $student_visa_specifics->attendant_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Financial Sponsor Name', $permission))
                                    <div class="relative mb-4">
                                        <label for="financial_sponsor_name" class="font-semibold text-ternary/90 text-sm">Financial Sponsor Name</label>
                                    <input type="text" name="financial_sponsor_name" id="financial_sponsor_name"
                                        value="{{ $student_visa_specifics->financial_sponsor_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Sponsor Details', $permission))
                                    <div class="relative mb-4">
                                        <label for="sponsor_details" class="font-semibold text-ternary/90 text-sm">Sponsor Details</label>
                                    <input type="text" name="sponsor_details" id="sponsor_details"
                                        value="{{ $student_visa_specifics->sponsor_details ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif


                    </div>
                </div>
            </div>
          @endif

          @if(in_array('host_sponsor_inviter_details', $alreadySelect))
            <!-- Social Media Links Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden section-container" data-section="hostsponsor">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-briefcase text-primary mr-2"></i>
                        Host Sponsor Inviter
                    </h2>
                    <button type="button" class="text-primary hover:text-primary-dark text-sm font-medium section-edit-btn" data-section="hostsponsor">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                </div>
                          @php
                            $host_sponsor_inviter_details = null;
                            if ($bookingData->visarequireddocument && $bookingData->visarequireddocument->host_sponsor_inviter_details) {
                                $host_sponsor_inviter_details = json_decode($bookingData->visarequireddocument->host_sponsor_inviter_details);
                            }
                        @endphp
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if(in_array('Host Full Name', $permission))
                                <div class="relative mb-4">
                                <label for="host Full_name" class="font-semibold text-ternary/90 text-sm">Host Full Name</label>
                                <input type="text" name="host_Full_name" id="host_Full_name"
                                value="{{ $host_sponsor_inviter_details->host_Full_name ?? '' }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('patient_name') border-red-500 @enderror">
                                <!-- <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                </div>
                                @endif

                                 @if(in_array('Company Name', $permission))
                                 <div class="relative mb-4">
                                    <label for="company_name" class="font-semibold text-ternary/90 text-sm">Company Name</label>
                                    <input type="text" name="company_name" id="company_name"
                                        value="{{ $host_sponsor_inviter_details->company_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('medical_diagnosis') border-red-500 @enderror">
                                    <!-- <i class="fa fa-notes-medical absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif
                                    
                                    @if(in_array('Relationship to Applicant', $permission))
                                    <div class="relative mb-4">
                                        <label for="relationship_to_applicant" class="font-semibold text-ternary/90 text-sm">Relationship to Applicant</label>
                                    <input type="text" name="relationship_to_applicant" id="relationship_to_applicant"
                                        value="{{ $host_sponsor_inviter_details->relationship_to_applicant ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif
                                    @if(in_array('Host Address', $permission))
                                    <div class="relative mb-4">
                                        <label for="host_address" class="font-semibold text-ternary/90 text-sm">Host Address</label>
                                    <input type="text" name="host_address" id="host_address"
                                        value="{{ $host_sponsor_inviter_details->host_address ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Host Phone Number', $permission))
                                    <div class="relative mb-4">
                                        <label for="host_phone_number" class="font-semibold text-ternary/90 text-sm">Host Phone Number</label>
                                    <input type="text" name="host_phone_number" id="host_phone_number"
                                        value="{{ $host_sponsor_inviter_details->host_phone_number ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Host Email', $permission))
                                    <div class="relative mb-4">
                                        <label for="host_email" class="font-semibold text-ternary/90 text-sm">Host Email</label>
                                    <input type="text" name="host_email" id="host_email"
                                        value="{{ $host_sponsor_inviter_details->host_email ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Company Registration', $permission))
                                    <div class="relative mb-4">
                                        <label for="company_registration" class="font-semibold text-ternary/90 text-sm">Company Registration</label>
                                    <input type="text" name="company_registration" id="company_registration"
                                        value="{{ $host_sponsor_inviter_details->company_registration ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                    </div>
                </div>
            </div>
          @endif

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
                            <label for="employer_name" class="font-semibold text-ternary/90 text-sm">In United Kingdom</label>
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
            <div class="flex justify-end mt-4">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                        Submit
                    </button>
            </div>
            
        </form>
    </div>
</div>
</body>
@php
    $other_passport_details = optional($bookingData->clint->clientinfo)->other_passport_details
        ? json_decode($bookingData->clint->clientinfo->other_passport_details)
        : null;
@endphp
<script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // const hasOtherPassport = {{ $other_passport_details ? 'true' : 'false' }};
                        const hasOtherPassport = {{ isset($other_passport_details) && $other_passport_details ? 'true' : 'false' }};
                        
                        if (hasOtherPassport) {
                            togglePassportidentity(true);
                        } else {
                            togglePassportidentity(false);
                        }
                    });

                    function togglePassportidentity(show) {
                        const section = document.getElementById('passport_identity_section');
                        if (show) {
                            section.classList.remove('hidden');
                        } else {
                            section.classList.add('hidden');
                        }
                    }
</script>

<script>
                   function toggleMilitary(show) {
                   
                   const section = document.getElementById('military_section');
                   if (section) {
                       if (show === true || show === 1 || show === '1') {
                           section.classList.remove('hidden');
                       } else {
                           section.classList.add('hidden');
                       }
                   }
               }

               document.addEventListener('DOMContentLoaded', function () {
                   const hasMilitary = {{ $bookingData->clint->clientinfo->armed_permission ?? 0 }};
                   toggleMilitary(hasMilitary);
                   // Call the function to toggle the military section based on the valu
               });
                </script>
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
<script>
    function toggleTravelDetails(radioName, detailsId) {
        const selected = $(`input[name="${radioName}"]:checked`).val();
        $(`#${detailsId}`)[selected === 'yes' ? 'slideDown' : 'slideUp']();
    }

    
    $(document).ready(function () {
        // Define mapping of radio names to detail section IDs
        const travelMappings = [
            { name: 'has_previous_uktravel', id: 'uk-travel-details' },
            { name: 'previousschengentravel', id: 'previousschengentravel_details' },
            { name: 'previous_usa_travel', id: 'usa-travel-details' },
            { name: 'previouschinatravel', id: 'china-travel-details' },
            { name: 'previousrussiatravel', id: 'russia-travel-details' },
            { name: 'previoustndiatravel', id: 'india-travel-details' },
            { name: 'criminalhistory', id: 'criminal-history' },
            { name: 'deniedentryanywhere', id: 'denied-entery-details' }
        ];

        // Initialize and bind change event
        travelMappings.forEach(({ name, id }) => {
            toggleTravelDetails(name, id);
            $(`input[name="${name}"]`).on('change', () => toggleTravelDetails(name, id));
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('confirmform');

        if (form) {
            form.querySelectorAll('input, textarea').forEach(function (el) {
                const excludedTypes = ['email', 'tel', 'date', 'hidden', 'number', 'password', 'checkbox', 'radio', 'file'];
                const type = el.getAttribute('type');

                if (!excludedTypes.includes(type)) {
                    el.addEventListener('input', function () {
                        this.value = this.value.toUpperCase();
                    });

                    // Make it appear uppercase as user types
                    el.style.textTransform = 'uppercase';
                }
            });
        }
    });
</script>
</html>