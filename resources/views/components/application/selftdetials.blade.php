                          
                <form id="" class="ajax-form" method="post"> 
                         
                <div class="w-full grid xl:grid-cols-2 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4">
                                @php
                                    $spouse = $bookingData->clint->clientinfo->spouse_details ? json_decode($bookingData->clint->clientinfo->spouse_details) : null;
                                  
                                @endphp
                           <!-- Conditional Fields: Show only if married -->
                            @if($spouse)
                                <div id="spouseDetailsSection" class=" p-4 border-[1px] border-primary/70 rounded-md  bg-black/10 shadow-lg shadow-black/10  mt-4 xl:col-span-3 lg:col-span-3 md:col-span-3 col-span-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                                    <div class="w-full">
                                        <label for="spouse_name" class="font-semibold text-ternary/90 text-sm">Husband / Wife Name</label>
                                        <input type="text" name="spouse_name" id="spouse_name"
                                            value="{{ old('spouse_name', $spouse->name ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                    </div>

                                    <div class="w-full">
                                        <label for="spouse_nationality" class="font-semibold text-ternary/90 text-sm">Nationality</label>
                                        <input type="text" name="spouse_nationality" id="spouse_nationality"
                                            value="{{ old('spouse_nationality', $spouse->nationality ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                    </div>

                                    <div class="w-full">
                                        <label for="spouse_birth_place" class="font-semibold text-ternary/90 text-sm">Place of Birth</label>
                                        <input type="text" name="spouse_birth_place" id="spouse_birth_place"
                                            value="{{ old('spouse_birth_place', $spouse->birth_place ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                    </div>

                                    <div class="w-full">
                                        <label for="spouse_previous_nationality" class="font-semibold text-ternary/90 text-sm">Previous Nationality</label>
                                        <input type="text" name="spouse_previous_nationality" id="spouse_previous_nationality"
                                            value="{{ old('spouse_previous_nationality', $spouse->previous_nationality ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                    </div>

                                    <div class="w-full">
                                        <label for="spouse_dob" class="font-semibold text-ternary/90 text-sm">Date of Birth</label>
                                        <input type="date" name="spouse_dob" id="spouse_dob"
                                           value="{{ old('spouse_dob', isset($spouse->spouse_dob) ? \Carbon\Carbon::parse($spouse->spouse_dob)->format('Y-m-d') : '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                    </div>

                                    <div class="w-full">
                                        <label for="spouse_employment" class="font-semibold text-ternary/90 text-sm">Employment Status</label>
                                        <input type="text" name="spouse_employment" id="spouse_employment"
                                            value="{{ old('spouse_employment', $spouse->employementstatus ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                    </div>

                                    <div class="w-full">
                                        <label for="spouse_address" class="font-semibold text-ternary/90 text-sm">Address</label>
                                        <input type="text" name="spouse_address" id="spouse_address"
                                            value="{{ old('spouse_address', $spouse->address ?? '') }}"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
                                    </div>

                                </div>
                             @endif


                             <input type="hidden" name="previewstep" value="3">                            
                            
                           <input type="hidden" name="step" value="4">



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