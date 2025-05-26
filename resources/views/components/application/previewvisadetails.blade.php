
<form class="visaajax-form w-full grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4" method="post">
                                      

                         <div class="w-full relative group flex flex-col gap-1 col-span-3">
                                    <label for="cities_visited" class="font-semibold text-ternary/90 text-sm">Cities Visited Before (if any)</label>
                                    <div class="w-full relative">
                                        <textarea name="cities_visited" id="cities_visited"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('cities_visited', $bookingData->visarequireddocument->cities_visited_in_india ?? '')  }}</textarea>
                                        <i class="fa fa-city absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="previous_visa_number" class="font-semibold text-ternary/90 text-sm">Previous Visa Number</label>
                                    <div class="w-full relative">
                                        <input type="text" name="previous_visa_number" id="previous_visa_number"
                                            value="{{ old('previous_visa_number', $bookingData->visarequireddocument->previous_visa_number ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-file-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="previous_visa_place" class="font-semibold text-ternary/90 text-sm">Previous Visa Place</label>
                                    <div class="w-full relative">
                                        <input type="text" name="previous_visa_place" id="previous_visa_place"
                                             value="{{ old('previous_visa_place', $bookingData->visarequireddocument->previous_visa_issued_place ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="previous_visa_issue_date" class="font-semibold text-ternary/90 text-sm">Previous Visa Issue Date</label>
                                    <div class="w-full relative">
                                        <input type="date" name="previous_visa_issue_date" id="previous_visa_issue_date"
                                            value="{{ old('previous_visa_issue_date', $bookingData->visarequireddocument->previous_visa_issue_date ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-calendar-day absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1 col-span-3">
                                    <label for="countries_visited_last_10_years" class="font-semibold text-ternary/90 text-sm">Countries Visited in Last 10 Years</label>
                                    <div class="w-full relative">
                                        <textarea name="countries_visited_last_10_years" id="countries_visited_last_10_years"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('countries_visited_last_10_years', $bookingData->visarequireddocument->countries_visited_last_10_years ?? '')  }}</textarea>
                                        <i class="fa fa-globe-europe absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                               
                                <input type="hidden" name="preview" value="previewvisadetails">
                                <input type="hidden" name="step" value="Done">
                                
                                <div class="w-full flex justify-end  pb-4 gap-2 xl:col-span-4 lg:col-span-3 md:col-span-2 col-span-1">
<!--                                             
                                        <button type="submit" data-current=5 data-previewtab=4 class="backbutton text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                                                Back <i class="fa fa-arrow-right ml-1"></i>
                                         </button> -->
                                   
                                        <button type="submit" class="text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                            Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
                                        </button>                                    
                                </div>
                           
</form>