                          
                <form id="" class="ajax-form" method="post"> 
                 
                @php
                    $eduEmployData = $bookingData->clint->clientinfo->employment  ? json_decode($bookingData->clint->clientinfo->employment) : null;


                @endphp     
         
                         <div class="w-full grid xl:grid-cols-2 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4">
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

                                @if(in_array('Name of your employer', $permission))
                                <!-- Duration of Employment  -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="name_of_your_employer" class="font-semibold text-ternary/90 text-sm">Name of your employer</label>
                                    <div class="w-full relative">
                                        <input type="text" name="name_of_your_employer" id="name_of_your_employer"
                                              value="{{ $eduEmployData->name_of_your_employer ?? '' }}"
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
                                                 value="{{ $eduEmployData->employment_monthly_income ?? '' }}"
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
            <!-- Date From -->
            <div class="w-full relative">
                <input type="date" name="date_from" id="date_from" max="9999-12-31"
                    value="{{ old('date_from', isset($eduEmployData->date_from) ? \Carbon\Carbon::parse($eduEmployData->date_from)->format('Y-m-d') : '') }}"
                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                <i class="fa fa-calendar absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
            </div>

            <!-- Date To -->
            <div class="w-full relative">
                <input type="date" name="date_to" id="date_to" max="9999-12-31"
                    value="{{ old('date_to', isset($eduEmployData->date_to) ? \Carbon\Carbon::parse($eduEmployData->date_to)->format('Y-m-d') : '') }}"
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
                            @php
                              
                            
                            @endphp

                     
                        <div id="military_section" class="lg:col-span-4 md:col-span-4 grid lg:grid-cols-4 gap-4 md:grid-cols-4 sm:grid-cols-2 grid-cols-1 ">                                {{-- Organization --}}
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="military_organization" class="font-semibold text-ternary/90 text-sm">Organization *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="military_organization" id="military_organization" requireed
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
                                        <input type="text" name="military_designation" id="military_designation" requireed
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
                                        <input type="text" name="military_rank" id="military_rank" requireed
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
                                        <input type="text" name="military_posting_place" id="military_posting_place" requireed
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


                        <input type="hidden" name="previewstep" value="7">                            
                        <input type="hidden" name="step" value="employment">
                                

                            <div class="w-full flex justify-end  pb-4 gap-2 xl:col-span-4 lg:col-span-3 md:col-span-2 col-span-1 mt-4">

                                         <button type="submit" data-current=3 data-previewtab=2 class="backbutton text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                                                Back <i class="fa fa-arrow-right ml-1"></i>
                                         </button>
                                                <button type="submit" class="next-step text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                                    Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
                                                </button>
                            </div>
                        </div>
                        </form>

                 {{-- JavaScript --}}
          
     


