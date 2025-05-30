
<form class="visaajax-form w-full grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4" method="post">
                                      
<!-- type of visa  -->

                              @if(in_array('Visa type', $permission))
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="visatype" class="font-semibold text-ternary/90 text-sm"> Type Of Visa Required</label>
                                    <div class="w-full relative">
                                        <input type="text" name="visatype" id="visatype"
                                            value="{{ old('visatype', $bookingData->visa->name?? '') }}"  readonly=""  class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                       {{-- <textarea name="visatype" id="visatype" requiresdd
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                @error('permanent_address') border-red-500 @enderror"> {{ old('permanent_address', $bookingData->clint->permanent_address ?? '') }}</textarea>--}}
                                                <i class="fa fa-passport absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                    @error('visatype')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif
                                @if(in_array('Number of Entries Requested', $permission))
                                <!-- noofentries -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="noofentries" class="font-semibold text-ternary/90 text-sm"> No of Entries</label>
                                    <div class="w-full relative">
                                        <input type="text" name="noofentries" id="noofentries"
                                        value="{{ old('visatype', $bookingData->visasubtype->name?? '') }}" readonly=""
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                            <i class="fa fa-sign-in-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
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
                                @if(in_array('Intended Arrival Date', $permission))
                                <!-- expected date of journey -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="expecteddate" class="font-semibold text-ternary/90 text-sm">Expected Date of Journey *</label>
                                    <div class="w-full relative">
                                        <input type="date" name="expecteddate" id="expecteddate"  readonly="" requiresdd
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
                                 @if(in_array('Port of Entry', $permission))
                                <!-- port of arival -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="portofarrival" class="font-semibold text-ternary/90 text-sm">Port Of Arrival *</label>
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

                              <input type="hidden" name="preview" value="detailsofvisasought">
                                <input type="hidden" name="step" value="travelinfo">
                                
                               
                                <div class="w-full flex justify-end  pb-4 gap-2 xl:col-span-4 lg:col-span-3 md:col-span-2 col-span-1">
                                            
                                        <button type="submit" data-current=5 data-previewtab=4 class="backbutton text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                                                Back <i class="fa fa-arrow-right ml-1"></i>
                                         </button>
                                   
                                        <button type="submit" class="text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                            Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
                                        </button>                                    
                                </div>
                           
</form>