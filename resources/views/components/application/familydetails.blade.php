             @php
                   $fatherdetails = $bookingData->clint->clientinfo->father_details ? json_decode($bookingData->clint->clientinfo->father_details) : null;
                   $motherdetails = $bookingData->clint->clientinfo->father_details ? json_decode($bookingData->clint->clientinfo->father_details) : null;
            
                   
            @endphp
                <form id="" class="ajax-form" method="post"> 
                        
                               <div id="fathersection" class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 bg-black/10 shadow-lg shadow-black/10 border-[1px] border-secondary/40">

                                   <div class="w-full">
                                       <label for="father_name" class="font-semibold text-ternary/90 text-sm">Father Name</label>
                                       <input type="text" name="father_name" id="father_name"
                                           value="{{ old('father_name', $fatherdetails->name ?? '') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                   </div>

                                   <div class="w-full">
                                       <label for="father_nationality" class="font-semibold text-ternary/90 text-sm">Nationality</label>
                                       <input type="text" name="father_nationality" id="father_nationality"
                                           value="{{ old('father_nationality', $fatherdetails->nationality ?? '') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                   </div>

                                   <div class="w-full">
                                       <label for="father_birth_place" class="font-semibold text-ternary/90 text-sm">Place of Birth</label>
                                       <input type="text" name="father_birth_place" id="father_birth_place"
                                           value="{{ old('father_birth_place', $fatherdetails->birth_place ?? '') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                   </div>

                                   <div class="w-full">
                                       <label for="father_previous_nationality" class="font-semibold text-ternary/90 text-sm">Previous Nationality</label>
                                       <input type="text" name="father_previous_nationality" id="father_previous_nationality"
                                           value="{{ old('father_previous_nationality', $fatherdetails->previous_nationality ?? '') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                   </div>

                                   <div class="w-full">
                                       <label for="father_dob" class="font-semibold text-ternary/90 text-sm">Date of Birth</label>
                                       <input type="date" name="father_dob" id="father_dob"
                                          value="{{ old('father_dob', isset($fatherdetails->father_dob) ? \Carbon\Carbon::parse($father->father_dob)->format('Y-m-d') : '') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                   </div>

                                   <div class="w-full">
                                       <label for="father_employment" class="font-semibold text-ternary/90 text-sm">Employment Status</label>
                                       <input type="text" name="father_employment" id="father_employment"
                                           value="{{ old('father_employment', $fatherdetails->employementstatus ?? '') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                   </div>

                                   <div class="w-full">
                                       <label for="father_address" class="font-semibold text-ternary/90 text-sm">Address</label>
                                       <input type="text" name="father_address" id="father_address"
                                           value="{{ old('father_address', $fatherdetails->address ?? '') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                   </div>

                               </div>

                               <div id="mothersection" class="mt-4 p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 bg-black/10 shadow-lg shadow-black/10 border-[1px] border-secondary/40">

                                   <div class="w-full">
                                       <label for="father_name" class="font-semibold text-ternary/90 text-sm">Mother Name</label>
                                       <input type="text" name="mother_name" id="mother_name"
                                           value="{{ old('mother_name', $motherdetails->name ?? '') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                   </div>

                                   <div class="w-full">
                                       <label for="mother_nationality" class="font-semibold text-ternary/90 text-sm">Nationality</label>
                                       <input type="text" name="mother_nationality" id="mother_nationality"
                                           value="{{ old('mother_nationality', $motherdetails->nationality ?? '') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                   </div>

                                   <div class="w-full">
                                       <label for="father_birth_place" class="font-semibold text-ternary/90 text-sm">Place of Birth</label>
                                       <input type="text" name="mother_birth_place" id="mother_birth_place"
                                           value="{{ old('mother_birth_place', $motherdetails->birth_place ?? '') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                   </div>

                                   <div class="w-full">
                                       <label for="mother_previous_nationality" class="font-semibold text-ternary/90 text-sm">Previous Nationality</label>
                                       <input type="text" name="mother_previous_nationality" id="mother_previous_nationality"
                                           value="{{ old('mother_previous_nationality', $motherdetails->previous_nationality ?? '') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                   </div>

                                   <div class="w-full">
                                       <label for="father_dob" class="font-semibold text-ternary/90 text-sm">Date of Birth</label>
                                       <input type="date" name="mother_dob" id="mother_dob"
                                          value="{{ old('mother_dob', isset($motherdetails->father_dob) ? \Carbon\Carbon::parse($motherdetails->father_dob)->format('Y-m-d') : '') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                   </div>

                                   <div class="w-full">
                                       <label for="mother_employment" class="font-semibold text-ternary/90 text-sm">Employment Status</label>
                                       <input type="text" name="mother_employment" id="mother_employment"
                                           value="{{ old('mother_employment', $motherdetails->employementstatus ?? '') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                   </div>

                                   <div class="w-full">
                                       <label for="mother_address" class="font-semibold text-ternary/90 text-sm">Address</label>
                                       <input type="text" name="mother_address" id="mother_address"
                                           value="{{ old('mother_address', $motherdetails->address ?? '') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                   </div>

                               </div>
          
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