<form  class="ajax-form w-full grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4" method="post"> 

    @if(in_array('Title', $permission))
        <div class="w-full relative group flex flex-col gap-1">
            <label for="title" class="font-semibold text-ternary/90 text-sm">Title</label>
            <div class="w-full relative">
               @php
                    $selectedTitle = old('title', $bookingData->clint->clientinfo->title ?? '');
                @endphp

                <select name="title" id="title"
                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                    
                    <option value="">Select Title</option>
                    <option value="Mr"   {{ $selectedTitle == 'Mr' ? 'selected' : '' }}>Mr</option>
                    <option value="Ms"   {{ $selectedTitle == 'Ms' ? 'selected' : '' }}>Ms</option>
                    <option value="Mrs"  {{ $selectedTitle == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                    <option value="Dr"   {{ $selectedTitle == 'Dr' ? 'selected' : '' }}>Dr</option>
                    <option value="Prof" {{ $selectedTitle == 'Prof' ? 'selected' : '' }}>Prof</option>
                </select>
            </div>
            @error('title')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>
    @endif

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
 


   <!-- preview details -->
              {{-- @if(in_array('Preview Name', $permission))
                    <input type="hidden" name="previous_name" value="">
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
             @endif --}}

             
@if(in_array('Preview Name', $permission))
    <input type="hidden" name="previous_name" value="">

    <div class="mb-4">
        <label class="font-semibold text-sm text-ternary/90">Do you have a previous name?</label>

        <div class="flex gap-4 mt-1">
            <!-- Yes Option -->
            <label>
                <input 
                    type="radio" 
                    name="has_previous_name" 
                    value="yes" 
                    onclick="togglePreviousName(true)"
                    {{ $bookingData->clint?->clientinfo?->previous_name ? 'checked' : '' }}
                > Yes
            </label>

            <!-- No Option -->
            <label>
                <input 
                    type="radio" 
                    name="has_previous_name" 
                    value="no" 
                    onclick="togglePreviousName(false)"
                    {{ !$bookingData->clint?->clientinfo?->previous_name ? 'checked' : '' }}
                > No
            </label>
        </div>
    </div>

    <!-- Previous Name Section -->
    <div 
        id="previousNameSection" 
        class="{{ $bookingData->clint?->clientinfo?->previous_name ? 'flex flex-col gap-2 mb-4' : 'hidden flex flex-col gap-2 mb-4' }}"
    >
        <!-- Previous First Name -->
        <div class="w-full relative group flex flex-col gap-1">
            <label for="previous_name" class="font-semibold text-ternary/90 text-sm">
                Previous Name (if any)
            </label>
            <div class="w-full relative">
                <input 
                    type="text" 
                    name="previous_name" 
                    id="previous_name"
                    value="{{ $bookingData->clint?->clientinfo?->previous_name ?? '' }}"
                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] 
                           border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 
                           focus:outline-none focus:ring-0 focus:border-secondary/70 
                           placeholder-ternary/70 transition ease-in duration-200"
                    placeholder="Enter your previous name"
                >
                <i class="fa fa-user-tag absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
            </div>
        </div>
    </div>

    <!-- JS to toggle section -->

@endif

             


   @if(in_array('Gender', $permission)) 
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
   @endif
   @if(in_array('Marital Status', $permission))
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
  @endif

   @if(in_array('Religion', $permission)) 
  <!-- religion -->
        <div class="w-full relative group flex flex-col gap-1">
                                    <label for="religion" class="font-semibold text-ternary/90 text-sm">Religion</label>
                                    <div class="w-full relative">
                                        <input type="text" name="religion" id="religion"
                                              value="{{ old('religion', $bookingData->clint->clientinfo->religion ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-pray absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
    </div>
                @endif
            @if(in_array('Date of Birth', $permission))
                <!-- Date of Birth -->

                @php
                $dob = $bookingData->clint->date_of_birth ?? null;
                if ($dob instanceof \Carbon\Carbon) {
                    $dobValue = $dob->format('Y-m-d');
                } else {
                    try {
                        $dobValue = \Carbon\Carbon::parse(str_replace('/', '-', $dob))->format('Y-m-d');
                    } catch (\Exception $e) {
                        $dobValue = null; // fallback
                    }
                }
            @endphp

    <div class="w-full relative group flex flex-col gap-1">
                                    <label for="date_of_birth" class="font-semibold text-ternary/90 text-sm">Date of Birth *</label>
                                    <div class="w-full relative">
                                        <input type="date"
                                            name="date_of_birth"
                                            id="date_of_birth"
                                            value="{{ old('date_of_birth', $dobValue) }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] border">

                                        <!-- <input type="date" name="date_of_birth" id="date_of_birth" requiresdd
                                              value="{{ old('date_of_birth', $bookingData->clint->date_of_birth ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                            @error('date_of_birth') border-red-500 @enderror">
                                        <i class="fa fa-calendar absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                                    </div>
                                    @error('date_of_birth')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
    </div>
    @endif
    @if(in_array('Place of Birth', $permission))
    <!-- Place of Birth -->
    <div class="w-full relative group flex flex-col gap-1">
                                    <label for="place_of_birth" class="font-semibold text-ternary/90 text-sm">Place of Birth</label>
                                    <div class="w-full relative">
                                        <input type="text" name="place_of_birth" id="place_of_birth"
                                              value="{{ old('place_of_birth', $bookingData->clint->clientinfo->place_of_birth ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
    </div>
    @endif
    @if(in_array('Country of Citizenship', $permission))
    <!-- Country of Birth -->
 <div class="w-full relative group flex flex-col gap-1">
    <label for="country_of_birth" class="font-semibold text-ternary/90 text-sm">Country of Birth</label>
    <div class="w-full relative">
        @php
            $selectedCountry = old('country_of_birth', $bookingData->clint->clientinfo->country_of_birth ?? '');
        @endphp
        <select name="country_of_birth" id="country_of_birth" 
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

        <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
    </div>
</div>

    @endif
    @if(in_array('Nationality at Birth', $permission))
    <!-- Nationality -->
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
    @endif
    @if(in_array('Past Nationality', $permission))
    <!-- Past Nationality (if any) -->
    <div class="w-full relative group flex flex-col gap-1">
                                    <label for="past_nationality" class="font-semibold text-ternary/90 text-sm">Past Nationality (if any)</label>
                                    <div class="w-full relative">
                                        <input type="text" name="past_nationality" id="past_nationality"
                                              value="{{ old('past_nationality', $bookingData->clint->clientinfo->past_nationality ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-passport absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
    </div>
    @endif
    @if(in_array('Visible Identification Marks', $permission))
    <!-- Identification Marks -->
    <div class="w-full relative group flex flex-col gap-1">
                                    <label for="identification_marks" class="font-semibold text-ternary/90 text-sm">Identification Marks</label>
                                    <div class="w-full relative">
                                        <input type="text" name="identification_marks" id="identification_marks"
                                              value="{{ old('identification_marks', $bookingData->clint->clientinfo->identification_marks ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-id-card absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
    </div>
    @endif
    @if(in_array('Languages Spoken', $permission))
    <!-- Languages Spoken  -->
    <div class="w-full relative group flex flex-col gap-1">
                                    <label for="identification_marks" class="font-semibold text-ternary/90 text-sm">Languages Spoken</label>
                                    <div class="w-full relative">
                                        <input type="text" name="languages_spoken" id="languages_spoken"
                                              value="{{ old('languages_spoken', $bookingData->clint->clientinfo->language_spoken ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-id-card absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
    </div>
    @endif

    @if(in_array('Citizenship', $permission))
    <!-- Languages Spoken  -->
    <div class="w-full relative group flex flex-col gap-1">
                                    <label for="identification_marks" class="font-semibold text-ternary/90 text-sm">Citizenship</label>
                                    <div class="w-full relative">
                                        <input type="text" name="citizenship_id" id="citizenship_id"
                                              value="{{ old('citizenship_id', $bookingData->clint->clientinfo->citizenship_id ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                        <i class="fa fa-id-card absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
    </div>
    @endif


    <div class="w-full flex justify-end pb-4 gap-2 xl:col-span-4 lg:col-span-3 md:col-span-2 col-span-1">
        <input type="hidden" name="previewstep" value="">
        <input type="hidden" name="step" value="previewname_permission">

       
        <button type="submit" class="text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
            Next: Contact Details  <i class="fa fa-arrow-right ml-1"></i>
        </button>
    </div>

</form>          

<script>
    function togglePreviousName(show) {
        const section = document.getElementById('previousNameSection');
        const input = document.getElementById('previous_name');

        if (show) {
            section.style.display = 'block';
        } else {
            section.style.display = 'none';
            input.value = ''; // Clear value so nothing is saved
        }
    }


</script>

                  