<form  class="ajax-form w-full grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4" method="post"> 
    <div class="w-full relative group flex flex-col gap-1">
        <input type="hidden" name="agency_id" id="agency_id" value="{{ $agency->id ?? '' }}" readonly>

        <label for="first_name" class="font-semibold text-ternary/90 text-sm">First Name *</label>
        <div class="w-full relative">
            <input type="text" name="first_name" id="first_name"
                value="{{ $bookingData->clint->first_name ?? '' }}"
                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                @error('first_name') border-red-500 @enderror">
            <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
        </div>
        @error('first_name')
        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
        @enderror
    </div>

    <div class="w-full relative group flex flex-col gap-1">
        <label for="last_name" class="font-semibold text-ternary/90 text-sm">Last Name *</label>
        <div class="w-full relative">
            <input type="text" name="last_name" id="last_name"
                value="{{ $bookingData->clint->last_name ?? '' }}"
                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                @error('last_name') border-red-500 @enderror">
            <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
        </div>
        @error('last_name')
        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
        @enderror
    </div>

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

        <div class="mb-4">
                                        <label class="font-semibold text-sm text-ternary/90">Do you have a previous name?</label>
                                        <div class="flex gap-4 mt-1">
                                            
                                        <label>
                                                <input type="radio" name="has_previous_name" value="yes" onclick="togglePreviousName(true)"
                                                {{ $bookingData->clint->clientinfo->previous_name ? 'checked' : '' }}> Yes
                                                
                                                 </label>
                                            <label>
                                                <input type="radio" name="has_previous_name" value="no" onclick="togglePreviousName(false)"
                                                {{ !$bookingData->clint->clientinfo->previous_name ? 'checked' : '' }}> No
                                               
                                            </label>
                                        </div>
        </div>

    <div id="previousNameSection" class="hidden group flex flex-col gap-2 mb-4" >
                                            <!-- Previous First Name -->
                                            <div class="w-full relative group flex flex-col gap-1">
                                                <label for="previous_name" class="font-semibold text-ternary/90 text-sm">Previous Name (if any)</label>
                                                <div class="w-full relative">
                                                    <input type="text" name="previous_name" id="previous_name"
                                                        value="{{ $bookingData->clint->clientinfo->previous_name ?? '' }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                    <i class="fa fa-user-tag absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                                </div>
                                            </div>
    </div>
  
    <div class="w-full relative group flex flex-col gap-1">
                                            <label for="gender" class="font-semibold text-ternary/90 text-sm">Gender *</label>
                                            <div class="w-full relative">
                                                <select name="gender" id="gender" requiresdd
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                        @error('gender') border-red-500 @enderror">
                                                     @if(!$bookingData->clint->gender) 
                                                    <option value="">Select Gender</option>
                                                    @endif
                                                    <option value="MALE" {{ old('gender', $bookingData->clint->gender) == 'MALE' ? 'selected' : '' }}>Male</option>
                                                    <option value="FEMALE" {{ old('gender', $bookingData->clint->gender) == 'FEMALE' ? 'selected' : '' }}>Female</option>
                                                    <option value="OTHER" {{ old('gender', $bookingData->clint->gender) == 'OTHER' ? 'selected' : '' }}>Other</option>
                                                  </select>
                                                <i class="fa fa-venus-mars absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                            @error('gender')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
    </div>

    <div class="w-full relative group flex flex-col gap-1">
                                            <label for="marital_status" class="font-semibold text-ternary/90 text-sm">Marital Status *</label>
                                            <div class="w-full relative">
                                                <select name="marital_status" id="marital_status" requiresdd
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                                        @error('marital_status') border-red-500 @enderror">
                                                        @if(!$bookingData->clint->marital_status) 
                                                           <option value="">Select Status</option>
                                                       @endif
                                                    <option value="single" {{ old('marital_status', $bookingData->clint->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
                                                    <option value="married" {{ old('marital_status', $bookingData->clint->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
                                                    <option value="divorced" {{ old('marital_status', $bookingData->clint->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                                    <option value="widowed" {{ old('marital_status', $bookingData->clint->marital_status) == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                                </select>
                                                <i class="fa fa-heart absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                            </div>
                                            @error('marital_status')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                            @enderror
    </div>
  
    <div class="w-full flex justify-end pb-4 gap-2 xl:col-span-4 lg:col-span-3 md:col-span-2 col-span-1">
        <input type="hidden" name="previewstep" value="">
        <input type="hidden" name="step" value="previewname_permission">

       
        <button type="submit" class="text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
            Next: Contact Details  <i class="fa fa-arrow-right ml-1"></i>
        </button>
    </div>
</form>
