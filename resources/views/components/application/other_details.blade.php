
                <form id="" class="ajax-form" method="post"> 
                         
                         <div class="w-full grid xl:grid-cols-2 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4">


                                    <!-- email address -->
                                    @if(in_array('Email Address', $permission))
                                        <div class="w-full relative group flex flex-col gap-1">
                                            <label for="email" class="font-semibold text-ternary/90 text-sm">Email Address *</label>
                                            <div class="w-full relative">
                                                <input type="email" name="email" id="email"
                                                    value="{{ $bookingData->clint->email ?? '' }}"
                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                    @error('email') border-red-500 @enderror">
                                                <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                            @error('email')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif

                                    <!-- phone number -->
                                    @if(in_array('Phone Number (Mobile)', $permission))
                                        <div class="w-full relative group flex flex-col gap-1">
                                            <label for="phone_number" class="font-semibold text-ternary/90 text-sm">Phone Number *</label>
                                            <div class="w-full relative">
                                                <input type="text" name="phone_number" id="phone_number"
                                                    value="{{ $bookingData->clint->phone_number ?? '' }}"
                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                    @error('phone_number') border-red-500 @enderror">
                                                <i class="fa fa-phone-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                            @error('phone_number')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif

                                    

                                    
                        
                                    <!-- address -->
                                    @if(in_array('Postal Code', $permission))
                                        <!-- zip code -->
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
                                    @endif

                                    @if(in_array('Current Residential Address', $permission))
                                    <!-- Select Address -->
                                        <div class="w-full mt-2 hidden" id="address-wrapper">
                                                    <label for="address-select" class="text-sm font-semibold text-ternary/90">Select Address</label>
                                                    <select id="address-select" name="address"
                                                        class="w-full px-2 py-1 border border-secondary/40 rounded focus:outline-none focus:border-secondary/70">
                                                    </select>
                                            </div>
                                    @endif
                                    @if(in_array('Current Residential Address', $permission))
                                    <!-- Select Address -->
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
                                    @endif
                                    @if(in_array('City', $permission))
                                    <!-- Street -->
                                        <div class="w-full relative group flex flex-col gap-1">
                                            <label for="street" class="font-semibold text-ternary/90 text-sm">House No/Street</label>
                                            <div class="w-full relative">
                                                <input type="text" name="street" id="street"
                                                    value="{{ old('street', $bookingData->clint->street ?? '') }}"
                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                <i class="fa fa-road absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                        </div>
                                    @endif
                                    <!-- City -->
                                    @if(in_array('State', $permission))
                                        <div class="w-full relative group flex flex-col gap-1">
                                            <label for="city" class="font-semibold text-ternary/90 text-sm">Village/Town/City *</label>
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
                                    @endif
                                    
                               

                                 @if(in_array('State', $permission))
                                           <div class="w-full relative group flex flex-col gap-1">
                                            <label for="city" class="font-semibold text-ternary/90 text-sm">State/District/County  *</label>
                                            <div class="w-full relative">
                                                <input type="text" name="county" id="county" requiresdd
                                                
                                                    value="{{ old('county', $bookingData->clint->county ?? '') }}"
                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                    @error('city') border-red-500 @enderror">
                                                <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                      
                                        </div>
                                     @endif
                                    <!-- country  -->
                                    @if(in_array('Country of Residence', $permission))
                                        <div class="w-full relative group flex flex-col gap-1">
                                            <label for="country" class="font-semibold text-ternary/90 text-sm">Country *</label>
                                            <div class="w-full relative">
                                                  @php
                                                    $selectedCountry = old('country', $bookingData->clint->country ?? '');
                                                @endphp
                                                <select name="country" id="country" 
                                                    class="visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                                    <option value="">--- Select Country ---</option>

                                                    @forelse($countries as $country)
                                                        <option value="{{ $country->countryName }}" {{ $selectedCountry == $country->countryName ? 'selected' : '' }}>
                                                            {{ $country->countryName }}
                                                        </option>
                                                    @empty
                                                        <option value="">No record found</option>
                                                    @endforelse
                                                </select>
                                                <!-- <input type="text" name="country" id="country" requiresdd
                                                    value="{{ old('country', $bookingData->clint->country ?? '') }}"
                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                    @error('country') border-red-500 @enderror"> -->
                                                <i class="fa fa-globe-americas absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                            @error('country')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif
                                   @if(in_array('Postal Code', $permission))
                                            <div class="w-full relative group flex flex-col gap-1">
                                            <label for="city" class="font-semibold text-ternary/90 text-sm">Postal Code/Zip Code  *</label>
                                            <div class="w-full relative">
                                                <input type="text" name="zip_code" id="postcode" requiresdd
                                                
                                                   value="{{ old('zip_code', $bookingData->clint->zip_code ?? '') }}"
                                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                    @error('city') border-red-500 @enderror">
                                                <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                        </div>
                                    @endif
                                  

                                    <input type="hidden" name="step" value="address">
                               

                         
         
                                     <div class="w-full flex justify-end  pb-4 gap-2 xl:col-span-4 lg:col-span-3 md:col-span-2 col-span-1 mt-4">
                                             <button type="submit" data-current=3 data-previewtab=2 class="backbutton text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                                 <i class="fa fa-arrow-left mr-1"></i> Back 
                                                 </button>
                                                         <button type="submit" class="next-step text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                                             Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
                                                         </button>
                                     </div>
                                 </div>
                         </form>   