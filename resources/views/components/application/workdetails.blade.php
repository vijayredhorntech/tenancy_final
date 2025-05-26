                          
                <form id="" class="ajax-form" method="post"> 
                         
                         <div class="w-full grid xl:grid-cols-2 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4">

                         <div class="w-full relative group flex flex-col gap-1">
                                    <label for="present_occupation" class="font-semibold text-ternary/90 text-sm">Present Occupation</label>
                                    <div class="w-full relative">
                                        <input type="text" name="present_occupation" id="present_occupation"
                                            value="{{ old('present_occupation', $bookingData->clint->clientinfo->present_occupation ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-briefcase absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="designation" class="font-semibold text-ternary/90 text-sm">Designation</label>
                                    <div class="w-full relative">
                                        <input type="text" name="designation" id="designation"
                                            value="{{ old('designation', $bookingData->clint->clientinfo->designation ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-user-tie absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Employer Name</label>
                                    <div class="w-full relative">
                                        <input type="text" name="employer_name" id="employer_name"
                                           value="{{ old('employer_name', $bookingData->clint->clientinfo->employer_name ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-building absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1 col-span-3">
                                    <label for="employer_address" class="font-semibold text-ternary/90 text-sm">Employer Address</label>
                                    <div class="w-full relative">
                                        <textarea name="employer_address" id="employer_address"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">{{ old('employer_address', $bookingData->clint->clientinfo->employer_address ?? '') }}</textarea>
                                        <i class="fa fa-map-pin absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="employer_phone" class="font-semibold text-ternary/90 text-sm">Employer Phone</label>
                                    <div class="w-full relative">
                                        <input type="text" name="employer_phone" id="employer_phone"
                                           value="{{ old('employer_phone', $bookingData->clint->clientinfo->employer_phone ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-phone-square-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="past_occupation" class="font-semibold text-ternary/90 text-sm">Past Occupation</label>
                                    <div class="w-full relative">
                                        <input type="text" name="past_occupation" id="past_occupation"
                                             value="{{ old('past_occupation', $bookingData->clint->clientinfo->past_occupation ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-history absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
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