
<!-- Do you have a child? -->
<form id="" class="ajax-form" method="post"> 
                         
                         <div class="w-full grid xl:grid-cols-2 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4">


           @php
                   $socicalmedia = $bookingData->clint->clientinfo->social_media ? json_decode($bookingData->clint->clientinfo->social_media) : null;
           
                   
            @endphp
                        <!-- email address -->
                                    @if(in_array('Facebook', $permission))
                                        <div class="w-full relative group flex flex-col gap-1">
                                            <label for="facebook" class="font-semibold text-ternary/90 text-sm">Facebook *</label>
                                            <div class="w-full relative">
                                                <input type="text" name="facebook" id="facebook"
                                                    value="{{ $socicalmedia->facebook ?? '' }}"
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
                                    @if(in_array('Instagram', $permission))
                                        <div class="w-full relative group flex flex-col gap-1">
                                            <label for="instagram" class="font-semibold text-ternary/90 text-sm">Instagram*</label>
                                            <div class="w-full relative">
                                                <input type="text" name="instagram" id="instagram"
                                                     value="{{ $socicalmedia->instagram ?? '' }}"
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
                                    @if(in_array('Twitter', $permission))
                                        <!-- zip code -->
                                        <div class="w-full relative group flex flex-col gap-1">
                                                    <label for="twitter" class="font-semibold text-ternary/90 text-sm">Twitter</label>
                                                    <div class="w-full relative flex items-center gap-2">
                                                        <input type="text" name="twitter" id="twitter"
                                                            value="{{ $socicalmedia->twitter ?? '' }}"
                                                            class="w-full pl-2 pr-2 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                        
                                                    </div>
                                        </div>
                                    @endif
                                    

                                      <!-- address -->
                                      @if(in_array('LinkedIn', $permission))
                                        <!-- zip code -->
                                        <div class="w-full relative group flex flex-col gap-1">
                                                    <label for="linkedIn" class="font-semibold text-ternary/90 text-sm">LinkedIn</label>
                                                    <div class="w-full relative flex items-center gap-2">
                                                        <input type="text" name="linkedIn" id="linkedIn"
                                                            value="{{ $socicalmedia->linkedIn ?? '' }}"
                                                            class="w-full pl-2 pr-2 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                        
                                                    </div>
                                        </div>
                                    @endif

                                      <!-- address -->
                                      @if(in_array('Other Social Media Accounts', $permission))
                                        <!-- zip code -->
                                        <div class="w-full relative group flex flex-col gap-1">
                                                    <label for="othersocialmediaaccounts" class="font-semibold text-ternary/90 text-sm">Other Social Media Accounts</label>
                                                    <div class="w-full relative flex items-center gap-2">
                                                        <input type="text" name="othersocialmediaaccounts" id="othersocialmediaaccounts"
                                                            value="{{ $socicalmedia->other_social_media_accounts ?? '' }}"
                                                            class="w-full pl-2 pr-2 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                        
                                                    </div>
                                        </div>
                                    @endif

                                      <!-- address -->
                                      @if(in_array('Personal Website', $permission))
                                        <!-- zip code -->
                                        <div class="w-full relative group flex flex-col gap-1">
                                                    <label for="linkedIn" class="font-semibold text-ternary/90 text-sm">Personal Website</label>
                                                    <div class="w-full relative flex items-center gap-2">
                                                        <input type="text" name="personalwebsite" id="personalwebsite"
                                                           value="{{ $socicalmedia->personal_website ?? '' }}"
                                                            class="w-full pl-2 pr-2 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                        
                                                    </div>
                                        </div>
                                    @endif


                                      <!-- address -->
                                      @if(in_array('Blog URLs', $permission))
                                        <!-- zip code -->
                                        <div class="w-full relative group flex flex-col gap-1">
                                                    <label for="blogurl" class="font-semibold text-ternary/90 text-sm">Blog URLs</label>
                                                    <div class="w-full relative flex items-center gap-2">
                                                        <input type="text" name="blogurl" id="blogurl"
                                                             value="{{ $socicalmedia->blog_url ?? '' }}"
                                                            class="w-full pl-2 pr-2 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                                        
                                                    </div>
                                        </div>
                                    @endif
                                  <input type="hidden" name="step" value="socialmedia">
         
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
