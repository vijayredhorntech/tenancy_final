<form class="visaajax-form w-full grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4" method="post">
                                      

                                @if(in_array('Patient Name', $permission))
                                                        <div class="relative mb-4">
                                                        <label for="patient_name" class="font-semibold text-ternary/90 text-sm">Patient Name </label>
                                                    <input type="text" name="patient_name" id="patient_name"
                                                        value="{{ $bookingData->patient_name ?? '' }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('patient_name') border-red-500 @enderror">
                                                    <!-- <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                                    </div>
                                @endif
                                 @if(in_array('Medical Diagnosis', $permission))
                                 <div class="relative mb-4">
                                    <label for="medical_diagnosis" class="font-semibold text-ternary/90 text-sm">Medical Diagnosis</label>
                                    <input type="text" name="medical_diagnosis" id="medical_diagnosis"
                                        value="{{ $bookingData->medical_diagnosis ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('medical_diagnosis') border-red-500 @enderror">
                                    <!-- <i class="fa fa-notes-medical absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                    @if(in_array('Hospital Name', $permission))
                                    <div class="relative mb-4">
                                        <label for="hospital_name" class="font-semibold text-ternary/90 text-sm">Hospital Name</label>
                                    <input type="text" name="hospital_name" id="hospital_name"
                                        value="{{ $bookingData->hospital_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_name') border-red-500 @enderror">
                                    <!-- <i class="fa fa-hospital absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif
                                    

                                    @if(in_array('Hospital Address', $permission))
                                    <div class="relative mb-4">
                                        <label for="hospital_address" class="font-semibold text-ternary/90 text-sm">Hospital Address</label>
                                    <input type="text" name="hospital_address" id="hospital_address"
                                        value="{{ $bookingData->hospital_address ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif
                                    @if(in_array('Doctor’s Letter', $permission))
                                    <div class="relative mb-4">
                                        <label for="doctor's_letter" class="font-semibold text-ternary/90 text-sm">Hospital Address</label>
                                    <input type="text" name="doctor's_letter" id="doctor's_letter"
                                        value="{{ $bookingData->doctors_letter ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Doctor’s Letter', $permission))
                                    <div class="relative mb-4">
                                        <label for="doctor's_letter" class="font-semibold text-ternary/90 text-sm">Hospital Address</label>
                                    <input type="text" name="doctor's_letter" id="doctor's_letter"
                                        value="{{ $bookingData->doctors_letter ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Treatment Duration', $permission))
                                    <div class="relative mb-4">
                                        <label for="treatment_duration" class="font-semibold text-ternary/90 text-sm">Treatment Duration</label>
                                    <input type="text" name="treatment_duration" id="treatment_duration"
                                        value="{{ $bookingData->treatment_duration ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @endif

                                     @if(in_array('Treatment Cost', $permission))
                                    <div class="relative mb-4">
                                        <label for="treatment_cost" class="font-semibold text-ternary/90 text-sm">Treatment Cost</label>
                                    <input type="text" name="treatment_cost" id="treatment_cost"
                                        value="{{ $bookingData->treatment_cost ?? '' }}"
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

                                     @if(in_array('Attendant Details', $permission))
                                    <div class="relative mb-4">
                                        <label for="attendant_details" class="font-semibold text-ternary/90 text-sm">Attendant Details</label>
                                    <input type="text" name="attendant_details" id="attendant_details"
                                        value="{{ $bookingData->attendant_deatils ?? '' }}"
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
                                    

