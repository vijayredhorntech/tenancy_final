<form class="visaajax-form w-full grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4" method="post">
                                      
              @php      
         
              $accommodation_details = $bookingData->visarequireddocument->accommodation_details ? json_decode($bookingData->visarequireddocument->accommodation_details) : null;
             
              @endphp
                                 @if(in_array('Accommodation Type', $permission))
                                <div class="relative mb-4">
                                <label for="accommodation_type" class="font-semibold text-ternary/90 text-sm">Accommodation Type</label>
                                <input type="text" name="accommodation_type" id="accommodation_type"
                                value="{{ $accommodation_details->accommodation_type ?? '' }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('patient_name') border-red-500 @enderror">
                                <!-- <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                </div>
                                @endif
                                 @if(in_array('Hotel Name', $permission))
                                 <div class="relative mb-4">
                                    <label for="hotel _name" class="font-semibold text-ternary/90 text-sm">Hotel Name</label>
                                    <input type="text" name="hotel_name" id="hotel_name"
                                        value="{{ $accommodation_details->hotel_name ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('medical_diagnosis') border-red-500 @enderror">
                                    <!-- <i class="fa fa-notes-medical absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
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
                                    

                                    @if(in_array('Full Address of Stay', $permission))
                                    <div class="relative mb-4">
                                        <label for="full_address_of_stay" class="font-semibold text-ternary/90 text-sm">Full Address of Stay</label>
                                    <input type="text" name="full_address_of_stay" id="full_address_of_stay"
                                        value="{{ $accommodation_details->full_address_of_stay ?? '' }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('hospital_address') border-red-500 @enderror">
                                    <!-- <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
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

                                     @if(in_array('Contact Number of Host', $permission))
                                    <div class="relative mb-4">
                                        <label for="contact_number_of_host" class="font-semibold text-ternary/90 text-sm">Contact Number of Host</label>
                                    <input type="text" name="contact_number_of_host" id="contact_number_of_host"
                                        value="{{ $accommodation_details->contact_number_of_host ?? '' }}"
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

                                    <input type="hidden" name="step" value="accommondation">
                                    
                                    
                                <div class="w-full flex justify-end  pb-4 gap-2 xl:col-span-4 lg: md:col-span-2 col-span-1">
                                            
                                        <button type="submit" data-current=5 data-previewtab=4 class="backbutton text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                                                Back <i class="fa fa-arrow-right ml-1"></i>
                                         </button>
                                   
                                        <button type="submit" class="text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                            Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
                                        </button>                                    
                                </div>
                           
</form>
                                    

