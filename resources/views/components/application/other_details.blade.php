
                <form id="" class="ajax-form" method="post"> 
                         
                         <div class="w-full grid xl:grid-cols-2 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4">

                         <div class="w-full relative group flex flex-col gap-1">
                                    <label for="religion" class="font-semibold text-ternary/90 text-sm">Religion</label>
                                    <div class="w-full relative">
                                        <input type="text" name="religion" id="religion"
                                              value="{{ old('religion', $bookingData->clint->clientinfo->religion ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-pray absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="date_of_birth" class="font-semibold text-ternary/90 text-sm">Date of Birth *</label>
                                    <div class="w-full relative">
                                        <input type="date" name="date_of_birth" id="date_of_birth" requiresdd
                                              value="{{ old('date_of_birth', $bookingData->clint->clientinfo->date_of_birth ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('date_of_birth') border-red-500 @enderror">
                                        <i class="fa fa-calendar absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('date_of_birth')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="place_of_birth" class="font-semibold text-ternary/90 text-sm">Place of Birth</label>
                                    <div class="w-full relative">
                                        <input type="text" name="place_of_birth" id="place_of_birth"
                                              value="{{ old('place_of_birth', $bookingData->clint->clientinfo->place_of_birth ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="country_of_birth" class="font-semibold text-ternary/90 text-sm">Country of Birth</label>
                                    <div class="w-full relative">
                                        <input type="text" name="country_of_birth" id="country_of_birth"
                                              value="{{ old('country_of_birth', $bookingData->clint->clientinfo->country_of_birth ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

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

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="past_nationality" class="font-semibold text-ternary/90 text-sm">Past Nationality (if any)</label>
                                    <div class="w-full relative">
                                        <input type="text" name="past_nationality" id="past_nationality"
                                              value="{{ old('past_nationality', $bookingData->clint->clientinfo->past_nationality ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-passport absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="educational_qualification" class="font-semibold text-ternary/90 text-sm">Educational Qualification</label>
                                    <div class="w-full relative">
                                        <input type="text" name="educational_qualification" id="educational_qualification"
                                              value="{{ old('educational_qualification', $bookingData->clint->clientinfo->educational_qualification ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-graduation-cap absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="identification_marks" class="font-semibold text-ternary/90 text-sm">Identification Marks</label>
                                    <div class="w-full relative">
                                        <input type="text" name="identification_marks" id="identification_marks"
                                              value="{{ old('identification_marks', $bookingData->clint->clientinfo->identification_marks ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-id-card absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
         
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