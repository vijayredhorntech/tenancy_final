<form class="visaajax-form w-full grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4" method="post">


                             @if(in_array('Course Name', $permission))
                                 <div class="relative mb-4">
                                     <label for="course_name" class="font-semibold text-ternary/90 text-sm">Course Name</label>
                                     <input type="text" name="course_name" id="course_name"
                                    value="{{ $bookingData->course_name ?? '' }}"
                                     class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('patient_name') border-red-500 @enderror">
                                                        <!-- <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                @endif

                                 @if(in_array('Institution Name', $permission))
                                 <div class="relative mb-4">
                                    <label for="institution_name" class="font-semibold text-ternary/90 text-sm">Institution Name</label>
                                    <input type="text" name="institution_name" id="institution_name"
                                        value="{{ $bookingData->institution_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('medical_diagnosis') border-red-500 @enderror">
                                    <!-- <i class="fa fa-notes-medical absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                    @if(in_array('Institution Address', $permission))
                                    <div class="relative mb-4">
                                        <label for="institution_address" class="font-semibold text-ternary/90 text-sm">Institution Address</label>
                                    <input type="text" name="institution_address" id="institution_address"
                                        value="{{ $bookingData->institution_address ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_name') border-red-500 @enderror">
                                    <!-- <i class="fa fa-hospital absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif
                                

                                    @if(in_array('Institution Phone', $permission))
                                    <div class="relative mb-4">
                                        <label for="institution_phone" class="font-semibold text-ternary/90 text-sm">Institution Phone</label>
                                    <input type="text" name="institution_phone" id="institution_phone"
                                        value="{{ $bookingData->institution_phone ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('SEVIS ID', $permission))
                                    <div class="relative mb-4">
                                        <label for="sevis_id" class="font-semibold text-ternary/90 text-sm">SEVIS ID</label>
                                    <input type="text" name="sevis_id" id="sevis_id"
                                        value="{{ $bookingData->sevis_id ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Tuition Fee Estimate', $permission))
                                    <div class="relative mb-4">
                                        <label for="tuition_fee_estimate" class="font-semibold text-ternary/90 text-sm">Tuition Fee Estimate</label>
                                    <input type="text" name="tuition_fee_estimate" id="tuition_fee_estimate"
                                        value="{{ $bookingData->tuition_fee_estimate ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Living Expenses Estimate', $permission))
                                    <div class="relative mb-4">
                                        <label for="living_expenses_estimate" class="font-semibold text-ternary/90 text-sm">Living Expenses Estimate</label>
                                    <input type="text" name="living_expenses_estimate" id="living_expenses_estimate"
                                        value="{{ $bookingData->living_expenses_estimate ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Attendant Name', $permission))
                                    <div class="relative mb-4">
                                        <label for="attendant_name" class="font-semibold text-ternary/90 text-sm">Attendant Name</label>
                                    <input type="text" name="attendant_name" id="attendant_name"
                                        value="{{ $bookingData->attendant_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Financial Sponsor Name', $permission))
                                    <div class="relative mb-4">
                                        <label for="financial_sponsor_name" class="font-semibold text-ternary/90 text-sm">Financial Sponsor Name</label>
                                    <input type="text" name="financial_sponsor_name" id="financial_sponsor_name"
                                        value="{{ $bookingData->financial_sponsor_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Sponsor Details', $permission))
                                    <div class="relative mb-4">
                                        <label for="sponsor_details" class="font-semibold text-ternary/90 text-sm">Sponsor Details</label>
                                    <input type="text" name="sponsor_details" id="sponsor_details"
                                        value="{{ $bookingData->sponsor_details ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif



                                    
                                <div class="w-full flex justify-end  pb-4 gap-2 xl:col-span-4 lg: md:col-span-2 col-span-1">
                                            
                                        <button type="submit" data-current=5 data-previewtab=4 class="backbutton text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                                                Back <i class="fa fa-arrow-right ml-1"></i>
                                         </button>
                                   
                                        <button type="submit" class="text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                            Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
                                        </button>                                    
                                </div>
                           
</form>