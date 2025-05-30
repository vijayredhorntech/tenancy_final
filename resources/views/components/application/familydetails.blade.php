@php
                   $fatherdetails = $bookingData->clint->clientinfo->father_details ? json_decode($bookingData->clint->clientinfo->father_details) : null;
                   $motherdetails = $bookingData->clint->clientinfo->father_details ? json_decode($bookingData->clint->clientinfo->father_details) : null;
                   $spouse = $bookingData->clint->clientinfo->spouse_details ? json_decode($bookingData->clint->clientinfo->spouse_details) : null;
                   
            @endphp
                <form id="" class="ajax-form" method="post"> 
                        

                @if(in_array('Father Section', $permission))
                {{-- Father Section --}}
                    <div id="fathersection" class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 bg-black/10 shadow-lg border border-secondary/40">
                                        @if(in_array('Father’s Full Name', $permission))
                                        <div>
                                        <label for="father_name" class="font-semibold text-sm text-ternary/90">Father Name</label>
                                        <input type="text" name="father_name" id="father_name" value="{{ old('father_name', $fatherdetails->name ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Father Nationality', $permission))
                                        <div>
                                        <label for="father_nationality" class="font-semibold text-sm text-ternary/90">Nationality</label>
                                        <input type="text" name="father_nationality" id="father_nationality" value="{{ old('father_nationality', $fatherdetails->nationality ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Father Place of Birth', $permission))
                                        <div>
                                        <label for="father_birth_place" class="font-semibold text-sm text-ternary/90">Place of Birth</label>
                                        <input type="text" name="father_birth_place" id="father_birth_place" value="{{ old('father_birth_place', $fatherdetails->birth_place ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Father Previous Nationality', $permission))
                                        <div>
                                        <label for="father_previous_nationality" class="font-semibold text-sm text-ternary/90">Previous Nationality</label>
                                        <input type="text" name="father_previous_nationality" id="father_previous_nationality" value="{{ old('father_previous_nationality', $fatherdetails->previous_nationality ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Father Country of birth', $permission))
                                        <div>
                                        <label for="father_country_of_birth" class="font-semibold text-sm text-ternary/90">Country of Birth</label>
                                        <input type="text" name="father_country_of_birth" id="father_country_of_birth" value="{{ old('father_country_of_birth', $fatherdetails->father_country_of_birth ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Father’s DOB', $permission))
                                        <div>
                                        <label for="father_dob" class="font-semibold text-sm text-ternary/90">Date of Birth</label>
                                        <input type="date" name="father_dob" id="father_dob" value="{{ old('father_dob', isset($fatherdetails->father_dob) ? \Carbon\Carbon::parse($fatherdetails->father_dob)->format('Y-m-d') : '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Father Employment', $permission))
                                        <div>
                                        <label for="father_employment" class="font-semibold text-sm text-ternary/90">Employment Status</label>
                                        <input type="text" name="father_employment" id="father_employment" value="{{ old('father_employment', $fatherdetails->employementstatus ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Father Employment Address', $permission))
                                        <div>
                                        <label for="father_address" class="font-semibold text-sm text-ternary/90">Employment Address</label>
                                        <input type="text" name="father_address" id="father_address" value="{{ old('father_address', $fatherdetails->address ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif
                    </div>

                    @endif
                    @if(in_array('Mother Section', $permission))
                    {{-- Mother Section --}}
                    <div id="mothersection" class="mt-4 p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 bg-black/10 shadow-lg border border-secondary/40">
                                        @if(in_array('Mother’s Full Name', $permission))
                                        <div>
                                        <label for="mother_name" class="font-semibold text-sm text-ternary/90">Mother Name</label>
                                        <input type="text" name="mother_name" id="mother_name" value="{{ old('mother_name', $motherdetails->name ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Mother Nationality', $permission))
                                        <div>
                                        <label for="mother_nationality" class="font-semibold text-sm text-ternary/90">Nationality</label>
                                        <input type="text" name="mother_nationality" id="mother_nationality" value="{{ old('mother_nationality', $motherdetails->nationality ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Mother Place of Birth', $permission))
                                        <div>
                                        <label for="mother_birth_place" class="font-semibold text-sm text-ternary/90">Place of Birth</label>
                                        <input type="text" name="mother_birth_place" id="mother_birth_place" value="{{ old('mother_birth_place', $motherdetails->birth_place ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Mother Previous Nationality', $permission))
                                        <div>
                                        <label for="mother_previous_nationality" class="font-semibold text-sm text-ternary/90">Previous Nationality</label>
                                        <input type="text" name="mother_previous_nationality" id="mother_previous_nationality" value="{{ old('mother_previous_nationality', $motherdetails->previous_nationality ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Mother’s DOB', $permission))
                                        <div>
                                        <label for="mother_dob" class="font-semibold text-sm text-ternary/90">Date of Birth</label>
                                        <input type="date" name="mother_dob" id="mother_dob" value="{{ old('mother_dob', isset($motherdetails->father_dob) ? \Carbon\Carbon::parse($motherdetails->father_dob)->format('Y-m-d') : '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Mother Employment Stauts', $permission))
                                        <div>
                                        <label for="mother_employment" class="font-semibold text-sm text-ternary/90">Employment Status</label>
                                        <input type="text" name="mother_employment" id="mother_employment" value="{{ old('mother_employment', $motherdetails->employementstatus ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                        @endif

                                        @if(in_array('Employment Address', $permission))
                                        <div>
                                        <label for="mother_address" class="font-semibold text-sm text-ternary/90">Employment Address</label>
                                        <input type="text" name="mother_address" id="mother_address" value="{{ old('mother_address', $motherdetails->address ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                        </div>
                                    @endif
                    </div>

                    @endif
                    @if(in_array('Spouse Section', $permission))
                    {{-- Spouse Section --}}
                    <div id="spouseDetailsSection" class=" p-4 border-[1px] border-primary/70 rounded-md  bg-black/10 shadow-lg shadow-black/10  mt-4 xl:col-span-3 lg:col-span-3 md:col-span-3 col-span-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                                                    @if(in_array('Spouse’s Full Name', $permission))
                                                    <div class="w-full">
                                                    <label for="spouse_name" class="font-semibold text-ternary/90 text-sm">Husband / Wife Name</label>
                                                    <input type="text" name="spouse_name" id="spouse_name"
                                                        value="{{ old('spouse_name', $spouse->name ?? '') }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                    </div>
                                                    @endif

                                                    @if(in_array('Spouse’s  Place of Birth', $permission))
                                                    <div class="w-full">
                                                    <label for="spouse_nationality" class="font-semibold text-ternary/90 text-sm">Nationality</label>
                                                    <input type="text" name="spouse_nationality" id="spouse_nationality"
                                                        value="{{ old('spouse_nationality', $spouse->nationality ?? '') }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                    </div>
                                                    @endif
                                                    @if(in_array('Spouse’s  Nationality', $permission))
                                                    <div class="w-full">
                                                    <label for="spouse_birth_place" class="font-semibold text-ternary/90 text-sm">Place of Birth</label>
                                                    <input type="text" name="spouse_birth_place" id="spouse_birth_place"
                                                        value="{{ old('spouse_birth_place', $spouse->birth_place ?? '') }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                    </div>
                                                    @endif
                                                    @if(in_array('Spouse’s  Previous Nationality', $permission))
                                                    <div class="w-full">
                                                    <label for="spouse_previous_nationality" class="font-semibold text-ternary/90 text-sm">Previous Nationality</label>
                                                    <input type="text" name="spouse_previous_nationality" id="spouse_previous_nationality"
                                                        value="{{ old('spouse_previous_nationality', $spouse->previous_nationality ?? '') }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                    </div>
                                                    @endif
                                                    @if(in_array('Spouse’s DOB', $permission))
                                                    <div class="w-full">
                                                    <label for="spouse_dob" class="font-semibold text-ternary/90 text-sm">Date of Birth</label>
                                                    <input type="date" name="spouse_dob" id="spouse_dob"
                                                    value="{{ old('spouse_dob', isset($spouse->spouse_dob) ? \Carbon\Carbon::parse($spouse->spouse_dob)->format('Y-m-d') : '') }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                    </div>
                                                    @endif
                                                    @if(in_array('Spouse’s  Employment Status', $permission))
                                                    <div class="w-full">
                                                    <label for="spouse_employment" class="font-semibold text-ternary/90 text-sm">Employment Status</label>
                                                    <input type="text" name="spouse_employment" id="spouse_employment"
                                                        value="{{ old('spouse_employment', $spouse->employementstatus ?? '') }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                    </div>
                                                    @endif
                                                    @if(in_array('Spouse’s  Address', $permission))
                                                    <div class="w-full">
                                                    <label for="spouse_address" class="font-semibold text-ternary/90 text-sm">Address</label>
                                                    <input type="text" name="spouse_address" id="spouse_address"
                                                        value="{{ old('spouse_address', $spouse->address ?? '') }}"
                                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                                    </div>
                                                    @endif
                    </div>
                    @endif
                    @if(in_array('Children Section', $permission))
                    {{-- Childreen  Section --}}

                   <div class="mb-4">
                    <label class="font-semibold text-sm text-ternary/90">Do you have a child?</label>
                    <div class="flex gap-4 mt-1">
                        <label>
                            <input type="radio" name="has_child" value="yes"
                                {{ !empty($bookingData->clint->clientinfo->children) ? 'checked' : '' }}> Yes
                        </label>
                        <label>
                            <input type="radio" name="has_child" value="no"
                                {{ empty($bookingData->clint->clientinfo->children) ? 'checked' : '' }}> No
                        </label>
                    </div>
                   </div>

                @php
                    $childrenJson = $bookingData->clint->clientinfo->children ?? '[]';
                    $children = json_decode($childrenJson);
                  
                    $childsection = is_array($children) && count($children) > 0;
                @endphp

            <!-- Child Info Section -->
            <!-- Children Section -->
            <div id="childInfoSection" class="{{ !$childsection ? 'hidden' : '' }} mb-4">
                <div id="childFieldsContainer" class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4">
                    @if($childsection)
                        @forelse($children as $child)
                            <div class="child-fields border p-4 mb-4 rounded-[3px] rounded-tr-[8px] border-secondary/40 bg-white shadow-sm relative bg-black/10 shadow-lg shadow-black/10">
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div>
                                        <label class="font-semibold text-sm text-ternary/90">Name</label>
                                        <input type="text" name="child_name[]" value="{{ $child->name }}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                                    </div>

                                    <div>
                                        <label class="font-semibold text-sm text-ternary/90">Date of Birth</label>
                                        <input type="date" name="child_dob[]" value="{{ $child->dob }}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                                    </div>

                                    <div>
                                        <label class="font-semibold text-sm text-ternary/90">Nationality</label>
                                        <input type="text" name="child_nationality[]" value="{{ $child->nationality }}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                                    </div>

                                    <div class="col-span-full">
                                        <label class="font-semibold text-sm text-ternary/90">Address</label>
                                        <input type="text" name="child_address[]" value="{{ $child->address }}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                                    </div>
                                </div>

                                <button type="button" class="removeChildBtn absolute top-2 right-2 text-red-500 hover:text-white text-xs border border-red-500 hover:bg-red-500 rounded px-2 py-[1px]">
                                    Remove
                                </button>
                            </div>
                        @empty
                            <p>No children data found.</p>
                        @endforelse
                    @endif
                </div>
                  <!-- Add More Button -->
                  <div class="w-full flex justify-start">
                    <button type="button" class="bg-primary/30 text-ternary font-semibold border-[2px] border-primary/90 px-4 py-1 rounded-[3px] rounded-tr-[8px] hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200" id="addMoreChild">
                        Add More
                    </button>
                </div>
            </div>
            @endif
              
      
                                <input type="hidden" name="previewstep" value="6">                            
                                <input type="hidden" name="step" value="7">
                                

                            <div class="w-full flex justify-end  pb-4 gap-2 xl:col-span-4 lg:col-span-3 md:col-span-2 col-span-1 mt-4">

                                         <button type="submit" data-current=3 data-previewtab=2 class="backbutton text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                                                Back <i class="fa fa-arrow-right ml-1"></i>
                                         </button>
                                                <button type="submit" class="next-step text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                                    Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
                                                </button>
                            </div>
               </form>