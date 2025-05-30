<form class="visaajax-form w-full grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4" method="post">
                                      

                                @if(in_array('Funding Source', $permission))
                                <div class="relative mb-4">
                                <label for="funding_source" class="font-semibold text-ternary/90 text-sm">Funding Source</label>
                                <input type="text" name="funding_source" id="funding_source"
                                value="{{ $bookingData->funding_source ?? '' }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('patient_name') border-red-500 @enderror">
                                <!-- <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                </div>
                                @endif

                                 @if(in_array('Sponsor Name', $permission))
                                 <div class="relative mb-4">
                                    <label for="sponsor_name" class="font-semibold text-ternary/90 text-sm">Sponsor Name</label>
                                    <input type="text" name="sponsor_name" id="sponsor_name"
                                        value="{{ $bookingData->sponsor_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('medical_diagnosis') border-red-500 @enderror">
                                    <!-- <i class="fa fa-notes-medical absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                    @if(in_array('Financial Host Name', $permission))
                                 <div class="relative mb-4">
                                    <label for="Financial_host_name" class="font-semibold text-ternary/90 text-sm">Financial Host Name</label>
                                    <input type="text" name="Financial_host_name" id="Financial_host_name"
                                        value="{{ $bookingData->Financial_host_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('medical_diagnosis') border-red-500 @enderror">
                                    <!-- <i class="fa fa-notes-medical absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif
                                    
                                    
                                    @if(in_array('Financial Documents', $permission))
                                    <div class="relative mb-4">
                                        <label for="financial_documents" class="font-semibold text-ternary/90 text-sm">Financial Documents</label>
                                    <input type="text" name="financial_documents" id="financial_documents"
                                        value="{{ $bookingData->financial_documents ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif


                                     @if(in_array('Financial Monthly Income', $permission))
                                    <div class="relative mb-4">
                                        <label for="financial_monthly_income" class="font-semibold text-ternary/90 text-sm">Financial Monthly Income</label>
                                    <input type="text" name="financial_monthly_income" id="financial_monthly_income"
                                        value="{{ $bookingData->financial_monthly_income ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Means of Financial Support', $permission))
                                    <div class="relative mb-4">
                                    <label for="means_of_financial_support" class="font-semibold text-ternary/90 text-sm">Means of Financial Support</label>
                                    <input type="text" name="means_of_financial_support" id="means_of_financial_support"
                                        value="{{ $bookingData->means_of_financial_supportl ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Travel Insurance Company', $permission))
                                    <div class="relative mb-4">
                                        <label for="travel_insurance_company" class="font-semibold text-ternary/90 text-sm">Travel Insurance Company</label>
                                    <input type="text" name=travel_insurance_company" id="travel_insurance_company"
                                        value="{{ $bookingData->travel_insurance_company ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Travel Insurance Policy Number', $permission))
                                    <div class="relative mb-4">
                                        <label for="travel_insurance_policy_number" class="font-semibold text-ternary/90 text-sm">Travel Insurance Policy Number</label>
                                    <input type="text" name="travel_insurance_policy_number" id="travel_insurance_policy_number"
                                        value="{{ $bookingData->travel_insurance_policy_number ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                    @if(in_array('Insurance Validity', $permission))
                                    <div class="relative mb-4">
                                        <label for="insurance_validity" class="font-semibold text-ternary/90 text-sm">Insurance Validity</label>
                                    <input type="text" name="insurance_validity" id="insurance_validity"
                                        value="{{ $bookingData->insurance_validity ?? '' }}"
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
                                    

