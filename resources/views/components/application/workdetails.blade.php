                          
                <form id="" class="ajax-form" method="post"> 
                         
                    
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
                                             value="{{ old('business_name', $bookingData->clint->clientinfo->business_name ?? '') }}"
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
                                             value="{{ old('school_name', $bookingData->clint->clientinfo->school_name ?? '') }}"
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
                                             value="{{ old('duration_of_employment', $bookingData->clint->clientinfo->duration_of_employment ?? '') }}"
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
                                             value="{{ old('duration_of_study', $bookingData->clint->clientinfo->duration_of_study ?? '') }}"
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
                                             value="{{ old('employment_monthly_income', $bookingData->clint->clientinfo->employment_monthly_income ?? '') }}"
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
                                                value="{{ old('educational_qualification', $bookingData->clint->clientinfo->educational_qualification ?? '') }}"
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
                                             value="{{ old('employment_history', $bookingData->clint->clientinfo->employment_history ?? '') }}"
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
                                             value="{{ old('education_history', $bookingData->clint->clientinfo->education_history ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-history absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                              @endif 
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