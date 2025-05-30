
<form class="visaajax-form w-full grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4" method="post">
                                       
             @php                 
                   $visahistory = $bookingData->visarequireddocument->visa_history_background ? json_decode($bookingData->visarequireddocument->visa_history_background) : null;
               
            @endphp
            
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
                                @endif
                                @if(in_array('Previous Schengen Travel', $permission)) 
                                <div class="mb-4">
                                        <label class="font-semibold text-sm text-ternary/90">Previous Schengen Travel?</label>
                                        <div class="flex gap-4 mt-1">
                                            
                                        <label>
                                                <input type="radio" name="previousschengentravel" value="yes" {{ old('previousschengentravel', $visahistory->previousschengentravel ?? '') == 'yes' ? 'checked' : '' }}> Yes
                                                
                                                 </label>
                                            <label>
                                                <input type="radio" name="previousschengentravel" value="no" {{ old('previousschengentravel', $visahistory->previousschengentravel ?? '') == 'no' ? 'checked' : '' }}> No
                                               
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

                                <input type="hidden" name="step" value="visahistory">


                                <div class="w-full flex justify-end  pb-4 gap-2 xl:col-span-4 lg: md:col-span-2 col-span-1">
                                            
                                        <button type="submit" data-current=5 data-previewtab=4 class="backbutton text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                                                Back <i class="fa fa-arrow-right ml-1"></i>
                                         </button>
                                   
                                        <button type="submit" class="text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                            Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
                                        </button>                                    
                                </div>
                           
</form>