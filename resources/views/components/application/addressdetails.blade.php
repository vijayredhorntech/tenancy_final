
<form class="ajax-form w-full grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4" method="post">
                                <div class="w-full relative group flex flex-col gap-1">
                                            <label for="zip_code" class="font-semibold text-ternary/90 text-sm">Zip/Postal Code</label>
                                            <div class="w-full relative flex items-center gap-2">
                                                <input type="text" name="zip_code" id="zip_code"
                                                    value="{{ old('zip_code', $bookingData->clint->zip_code ?? '') }}"
                                                    class="w-full pl-2 pr-2 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                <button type="button" id="searchAddress"
                                                    class="px-3 py-1 bg-secondary text-white rounded hover:bg-secondary/80">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                </div>

                                <div class="w-full mt-2 hidden" id="address-wrapper">
                                            <label for="address-select" class="text-sm font-semibold text-ternary/90">Select Address</label>
                                            <select id="address-select" name="address"
                                                class="w-full px-2 py-1 border border-secondary/40 rounded focus:outline-none focus:border-secondary/70">
                                            </select>
                                    </div>


                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="permanent_address" class="font-semibold text-ternary/90 text-sm">Permanent Address *</label>
                                    <div class="w-full relative">
                                        <textarea name="permanent_address" id="permanent_address" requiresdd
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                @error('permanent_address') border-red-500 @enderror"> {{ old('permanent_address', $bookingData->clint->permanent_address ?? '') }}</textarea>
                                        <i class="fa fa-home absolute right-3 top-4 text-sm text-secondary/80"></i>
                                    </div>
                                    @error('permanent_address')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="street" class="font-semibold text-ternary/90 text-sm">Street</label>
                                    <div class="w-full relative">
                                        <input type="text" name="street" id="street"
                                            value="{{ old('street', $bookingData->clint->street ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-road absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="city" class="font-semibold text-ternary/90 text-sm">City *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="city" id="city" requiresdd
                                          
                                            value="{{ old('city', $bookingData->clint->city ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('city') border-red-500 @enderror">
                                        <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('city')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="country" class="font-semibold text-ternary/90 text-sm">Country *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="country" id="country" requiresdd
                                             value="{{ old('country', $bookingData->clint->country ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('country') border-red-500 @enderror">
                                        <i class="fa fa-globe-americas absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('country')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                              <input type="hidden" name="previewstep" value="5">                            
                                <input type="hidden" name="step" value="6">
                               
                                <div class="w-full flex justify-end  pb-4 gap-2 xl:col-span-4 lg:col-span-3 md:col-span-2 col-span-1">
                                            
                                        <button type="submit" data-current=5 data-previewtab=4 class="backbutton text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                                                Back <i class="fa fa-arrow-right ml-1"></i>
                                         </button>
                                   
                                        <button type="submit" class="text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                            Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
                                        </button>                                    
                                </div>
                           
</form>