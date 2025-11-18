

                <form id="" class="ajax-form grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4" method="post"> 
                           <!-- issueg authority country -->
                            @if(in_array('Passport Type', $permission))    
                                <div class="w-full relative group flex flex-col gap-1 mb-4">
                                    <label for="passport_type" class="font-semibold text-ternary/90 text-sm">
                                        Passport Type *
                                    </label>
                                    <div class="w-full relative">
                                        <select name="passport_type" id="passport_type"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] 
                                                border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 
                                                transition ease-in duration-200 @error('passport_type') border-red-500 @enderror">

                                            <option value="" disabled {{ old('passport_type', $bookingData->clint->clientinfo->passport_type ?? '') == '' ? 'selected' : '' }}>
                                                Select Passport Type
                                            </option>
                                            <option value="Ordinary" {{ old('passport_type', $bookingData->clint->clientinfo->passport_type ?? '') == 'Ordinary' ? 'selected' : '' }}>
                                                Ordinary
                                            </option>
                                            <option value="Diplomatic" {{ old('passport_type', $bookingData->clint->clientinfo->passport_type ?? '') == 'Diplomatic' ? 'selected' : '' }}>
                                                Diplomatic
                                            </option>
                                            <option value="Official" {{ old('passport_type', $bookingData->clint->clientinfo->passport_type ?? '') == 'Official' ? 'selected' : '' }}>
                                                Official
                                            </option>
                                            <option value="Service" {{ old('passport_type', $bookingData->clint->clientinfo->passport_type ?? '') == 'Service' ? 'selected' : '' }}>
                                                Service
                                            </option>
                                            <option value="Emergency" {{ old('passport_type', $bookingData->clint->clientinfo->passport_type ?? '') == 'Emergency' ? 'selected' : '' }}>
                                                Emergency
                                            </option>
                                            <option value="Other" {{ old('passport_type', $bookingData->clint->clientinfo->passport_type ?? '') == 'Other' ? 'selected' : '' }}>
                                                Other
                                            </option>
                                        </select>

                                        <i class="fa fa-passport absolute right-3 top-1/2 transform -translate-y-1/2 text-sm text-secondary/80 pointer-events-none"></i>
                                    </div>

                                    @error('passport_type')
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif


                              @if(in_array('Issuing Authority', $permission))    
                                <div class="w-full relative group flex flex-col gap-1">
                                        <label for="passport_country" class="font-semibold text-ternary/90 text-sm">Passport Country *</label>
                                        <div class="w-full relative">
                                             @php
                                                $selectedCountry = old('passport_country', $bookingData->clint->clientinfo->passport_country ?? '');
                                            @endphp
                                            <select name="passport_country" id="passport_country" 
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
                                            <!-- <input type="text" name="passport_country" id="passport_country" requiresdd
                                                value="{{ old('passport_country', $bookingData->clint->clientinfo->passport_country ?? '') }}"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                @error('passport_country') border-red-500 @enderror"> -->
                                            <i class="fa fa-passport absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                        </div>
                                        @error('passport_country')
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                </div>
                                @endif
                                <!-- issue of place  -->
                                @if(in_array('Place of Issue', $permission))
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="passport_issue_place" class="font-semibold text-ternary/90 text-sm">Passport Issue Place *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="passport_issue_place" id="passport_issue_place" requiresdd
                                             value="{{ old('passport_issue_place', $bookingData->clint->clientinfo->passport_issue_place ?? '') }}"
                                            
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('passport_issue_place') border-red-500 @enderror">
                                        <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('passport_issue_place')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif

                                <!-- passport number  -->
                                @if(in_array('Passport Number', $permission))
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="passport_ic_number" class="font-semibold text-ternary/90 text-sm">Passport Number *</label>
                                    <div class="w-full relative">
                                        <input type="text" name="passport_ic_number" id="passport_ic_number" requiresdd
                                            value="{{ old('passport_ic_number', $bookingData->clint->clientinfo->passport_ic_number ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('passport_ic_number') border-red-500 @enderror">
                                        <i class="fa fa-id-card absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('passport_ic_number')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif

                                @php
                                    function normalizeDate($date) {
                                        if (!$date) return null;

                                        // If Carbon, format directly
                                        if ($date instanceof \Carbon\Carbon) {
                                            return $date->format('Y-m-d');
                                        }

                                        // If string like "25/11/2026"
                                        try {
                                            return \Carbon\Carbon::parse(str_replace('/', '-', $date))->format('Y-m-d');
                                        } catch (\Exception $e) {
                                            return null;
                                        }
                                    }

                                    $passportIssueDate  = normalizeDate($bookingData->clint->clientinfo->passport_issue_date ?? null);
                                    $passportExpiryDate = normalizeDate($bookingData->clint->clientinfo->passport_expiry_date ?? null);
                                @endphp
                                <!-- passport issue date -->
                                @if(in_array('Date of Issue', $permission))
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="passport_issue_date" class="font-semibold text-ternary/90 text-sm">Passport Issue Date *</label>
                                    <div class="w-full relative">
                                       <input type="date" name="passport_issue_date" id="passport_issue_date"
                                            value="{{ old('passport_issue_date', $passportIssueDate) }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] border" >
                                        <i class="fa fa-calendar-check absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('passport_issue_date')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif
                                @if(in_array('Date of Expiry', $permission))
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="passport_expiry_date" class="font-semibold text-ternary/90 text-sm">Passport Expiry Date *</label>
                                    <div class="w-full relative">
                                        <input type="date" name="passport_expiry_date" id="passport_expiry_date"
                                            value="{{ old('passport_expiry_date', $passportExpiryDate) }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] border" >

                                        <i class="fa fa-calendar-times absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                    @error('passport_expiry_date')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif
          
                     
                        
                          
                            @if(in_array('Previous Passport Number', $permission))
                            @php
                                $other_passport_details = isset($bookingData->clint->clientinfo->other_passport_details)
                                    ? json_decode($bookingData->clint->clientinfo->other_passport_details)
                                    : null;
                                

                            @endphp
                                <div class="mb-4">
                                    <label class="font-semibold text-sm text-ternary/90">Any Other Valid Passport/Identity Certificate held</label>
                                    <div class="flex gap-4 mt-1">
                                        <label>
                                            <input type="radio" name="haspassportidenty" value="yes"
                                                onclick="togglePassportidentity(true)"
                                                {{ $other_passport_details ? 'checked' : '' }}> Yes
                                        </label>
                                        <label>
                                            <input type="radio" name="haspassportidenty" value="no"
                                                onclick="togglePassportidentity(false)"
                                                {{ !$other_passport_details ? 'checked' : '' }}> No
                                        </label>
                                    </div>
                                </div>

                                <div id="passport_identity_section" class="{{ $other_passport_details ? '' : 'hidden' }} lg:col-span-4 md:col-span-4 grid lg:grid-cols-4 gap-4 md:grid-cols-4 sm:grid-cols-2 grid-cols-1">
                                            <div class="w-full relative group flex flex-col gap-1">
                                                <label for="other_passport_country" class="font-semibold text-ternary/90 text-sm">Country Of issue *</label>
                                                <div class="w-full relative">

                                                        @php
                                                $selectedOtherCountry = old('other_passport_country', $other_passport_details->country ?? '');
                                            @endphp
                                            <select name="other_passport_country" id="other_passport_country" 
                                                class="visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                                <option value="">--- Select Country ---</option>

                                                @forelse($countries as $country)
                                                    <option value="{{ $country->countryName }}" {{ $selectedOtherCountry == $country->countryName ? 'selected' : '' }}>
                                                        {{ $country->countryName }}
                                                    </option>
                                                @empty
                                                    <option value="">No record found</option>
                                                @endforelse
                                            </select>
                                                    <!-- <input type="text" name="other_passport_country" id="other_passport_country" requireed
                                                        value="{{ old('other_passport_country', $other_passport_details->country ?? '') }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('other_passport_country') border-red-500 @enderror"> -->
                                                    <i class="fa fa-passport absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                                </div>
                                                @error('other_passport_country')
                                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="w-full relative group flex flex-col gap-1">
                                                <label for="other_passport_issue_place" class="font-semibold text-ternary/90 text-sm">Passport Issue Place *</label>
                                                <div class="w-full relative">
                                                    <input type="text" name="other_passport_issue_place" id="other_passport_issue_place" requiredd
                                                        value="{{ old('other_passport_issue_place', $other_passport_details->issue_place ?? '') }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('other_passport_issue_place') border-red-500 @enderror">
                                                    <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                                </div>
                                                @error('other_passport_issue_place')
                                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="w-full relative group flex flex-col gap-1">
                                                <label for="other_passport_ic_number" class="font-semibold text-ternary/90 text-sm">Passport/IC Number *</label>
                                                <div class="w-full relative">
                                                    <input type="text" name="other_passport_ic_number" id="other_passport_ic_number" requireed
                                                        value="{{ old('other_passport_ic_number', $other_passport_details->ic_number ?? '') }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('other_passport_ic_number') border-red-500 @enderror">
                                                    <i class="fa fa-id-card absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                                </div>
                                                @error('other_passport_ic_number')
                                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="w-full relative group flex flex-col gap-1">
                                                <label for="other_passport_issue_date" class="font-semibold text-ternary/90 text-sm">Passport Issue Date *</label>
                                                <div class="w-full relative">
                                                    <input type="date" name="other_passport_issue_date" id="other_passport_issue_date" requireed
                                                        value="{{ old('other_passport_issue_date', $other_passport_details->issue_date ?? '') }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200 @error('other_passport_issue_date') border-red-500 @enderror">
                                                    <i class="fa fa-calendar-check absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                                </div>
                                                @error('other_passport_issue_date')
                                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                </div>
                            @endif

                      

                             <input type="hidden" name="previewstep" value="7">                            
                             <input type="hidden" name="step" value="8">

                             <div class="w-full flex justify-end  pb-4 gap-2 xl:col-span-4 lg:col-span-3 md:col-span-2 col-span-1 mt-4">
                                    <button type="submit" data-current=3 data-previewtab=2 class="backbutton text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                                        <i class="fa fa-arrow-left mr-1"></i> Back 
                                    </button>
                                    <button type="submit" class="next-step text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                        Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
                                    </button>
             </div>



               </form>   
               {{-- JavaScript --}}
               @if(in_array('Previous Passport Number', $permission))
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // const hasOtherPassport = {{ $other_passport_details ? 'true' : 'false' }};
                        const hasOtherPassport = {{ isset($other_passport_details) && $other_passport_details ? 'true' : 'false' }};
                        
                        if (hasOtherPassport) {
                            togglePassportidentity(true);
                        } else {
                            togglePassportidentity(false);
                        }
                    });

                    function togglePassportidentity(show) {
                        const section = document.getElementById('passport_identity_section');
                        if (show) {
                            section.classList.remove('hidden');
                        } else {
                            section.classList.add('hidden');
                        }
                    }
                </script>
 @endif

          