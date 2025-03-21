   <x-front.layout>
       @section('title')Staff @endsection

       <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

           {{-- === this is code for heading section ===--}}
           <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
               <span class="font-semibold text-ternary text-xl">Staff Create </span>
           </div>
           {{-- === heading section code ends here===--}}



           {{-- === this is code for form section ===--}}
           <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
               <form action="{{ route('superadmin_staffstore') }}" method="POST" enctype="multipart/form-data">
                   @csrf
                   <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">


                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="profile" class="font-semibold text-ternary/90 text-sm">Profile</label>
                           <div class="w-full relative">
                               <input type="file" name="profile" id="profile" placeholder="Staff name....."
                                   value="{{ old('profile') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('profile') border-red-500 @enderror">
                               <i class="fa fa-file absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('profile')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>



                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="name" class="font-semibold text-ternary/90 text-sm">Name</label>
                           <div class="w-full relative">
                               <input type="text" name="name" id="name" placeholder="Staff name....."
                                   value="{{ old('name') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('name') border-red-500 @enderror">
                               <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('name')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>


                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="email" class="font-semibold text-ternary/90 text-sm">Email</label>
                           <div class="w-full relative">
                               <input type="email" name="email" id="email" placeholder="Email....."
                                   value="{{ old('email') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('email') border-red-500 @enderror">
                               <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('email')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>

                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="name" class="font-semibold text-ternary/90 text-sm">Phone</label>
                           <div class="w-full relative">
                               <input type="number" name="staff_phone" id="staff_phone" placeholder="Phone....."
                                   value="{{ old('staff_phone') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('staff_phone') border-red-500 @enderror">
                               <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('staff_phone')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>


                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Date of Birth</label>
                           <div class="w-full relative">
                               <input type="date" name="date_ofbirth" id="date_ofbirth" max=""
                                   class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                               <i class="fa fa-calendar-day absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"
                                   onclick="document.getElementById('date_ofbirth').showPicker();"></i>
                           </div>
                       </div>






                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="name" class="font-semibold text-ternary/90 text-sm">Account Number</label>
                           <div class="w-full relative">
                               <input type="number" name="bankdetails" id="bankdetails" placeholder=""
                                   value="{{ old('bankdetails') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('bankdetails') border-red-500 @enderror">
                               <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('bankdetails')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>


                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="name" class="font-semibold text-ternary/90 text-sm">Sort Code</label>
                           <div class="w-full relative">
                               <input type="text" name="short_code" id="short_code" placeholder="Short Code....."
                                   value="{{ old('short_code') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('short_code') border-red-500 @enderror">
                               <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('short_code')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>

                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="name" class="font-semibold text-ternary/90 text-sm">Bank Name</label>
                           <div class="w-full relative">
                               <input type="text" name="bank_name" id="bank_name" placeholder="Bank Name....."
                                   value="{{ old('bank_name') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('bank_name') border-red-500 @enderror">
                               <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('bank_name')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>





                       {{-- === number type input field ===--}}
                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="name" class="font-semibold text-ternary/90 text-sm">Zip Code</label>
                           <div class="w-full relative">
                               <input type="text" name="zip_code" id="zip_code" placeholder="zip code....."
                                   value="{{ old('zip_code') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('zip_code') border-red-500 @enderror">
                               <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('zip_code')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror

                           <button id="searchAddress" type="button" class="mt-2 w-full px-4 py-2 bg-secondary text-white font-semibold rounded-md shadow-md hover:bg-secondary/80 transition duration-200 flex items-center justify-center gap-2">
                               <i class="fa fa-search"></i> Search
                           </button>
                       </div>


                       <div class="w-full relative group flex flex-col gap-1">

                           <label for="name" class="font-semibold text-ternary/90 text-sm">Address</label>
                           <div class="w-full relative">
                               <input type="text" name="address" id="address" placeholder="Address....."
                                   value="{{ old('address') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('address') border-red-500 @enderror">
                               <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('address')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>


                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="name" class="font-semibold text-ternary/90 text-sm">City</label>
                           <div class="w-full relative">
                               <input type="text" name="city" id="city" placeholder="City....."
                                   value="{{ old('city') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('city') border-red-500 @enderror">
                               <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('city')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>


                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="name" class="font-semibold text-ternary/90 text-sm">State</label>
                           <div class="w-full relative">
                               <input type="text" name="state" id="state" placeholder="State....."
                                   value="{{ old('state') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('state') border-red-500 @enderror">
                               <i class="fa fa-flag absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('state')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>


                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="name" class="font-semibold text-ternary/90 text-sm">Country</label>
                           <div class="w-full relative">
                               <input type="text" name="country" id="country" placeholder="Country....."
                                   value="{{ old('country') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('country') border-red-500 @enderror">
                               <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('country')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>







                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="name" class="font-semibold text-ternary/90 text-sm">Emergency Person Name</label>
                           <div class="w-full relative">
                               <input type="text" name="emergencyperson_name" id="emergencyperson_name" placeholder=""
                                   value="{{ old('emergencyperson_name') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('emergencyperson_name') border-red-500 @enderror">
                               <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('emergencyperson_name')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>

                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="name" class="font-semibold text-ternary/90 text-sm">Emergency Person contact</label>
                           <div class="w-full relative">
                               <input type="text" name="emergencyperson_contact" id="emergencyperson_contact" placeholder=""
                                   value="{{ old('emergencyperson_contact') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('emergencyperson_contact') border-red-500 @enderror">
                               <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('emergencyperson_contact')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>

                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="name" class="font-semibold text-ternary/90 text-sm">Emergency Person Email</label>
                           <div class="w-full relative">
                               <input type="text" name="emergencyperson_email" id="emergencyperson_email" placeholder=""
                                   value="{{ old('emergencyperson_email') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('emergencyperson_email') border-red-500 @enderror">
                               <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('emergencyperson_email')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>


                       {{-- === select input field ===--}}



                       <div class="w-full relative group flex flex-col gap-1">

                           <label for="name" class="font-semibold text-ternary/90 text-sm">Passport Number</label>
                           <div class="w-full relative">
                               <input type="text" name="passport_number" id="passport_number" placeholder="Passport Number....."
                                   value="{{ old('passport_number') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('passport_number') border-red-500 @enderror">
                               <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('passport_number')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>

                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="name" class="font-semibold text-ternary/90 text-sm">Place of Issue</label>
                           <div class="w-full relative">
                               <input type="text" name="place_of_issue" id="place_of_issue" placeholder="Place of Issue....."
                                   value="{{ old('place_of_issue') }}"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                   @error('place_of_issue') border-red-500 @enderror">
                               <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                           </div>

                           @error('place_of_issue')
                           <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                           @enderror
                       </div>


                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Passport Expire Date</label>
                           <div class="w-full relative">
                               <input type="date" name="passport_expiredate" id="passport_expiredate" min=""
                                   class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                               <i class="fa fa-calendar-day absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"
                                   onclick="document.getElementById('passport_expiredate').showPicker();"></i>
                           </div>
                       </div>


                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Date of Issue</label>
                           <div class="w-full relative">
                               <input type="date" name="passport_issuedate" id="passport_issuedate" max=""
                                   class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                               <i class="fa fa-calendar-day absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"
                                   onclick="document.getElementById('passport_issuedate').showPicker();"></i>
                           </div>
                       </div>


                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Password Front</label>
                           <div class="w-full relative">
                               <input type="file" name="passportfront" id="datePicker"
                                   class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">

                           </div>
                       </div>

                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Passport back</label>
                           <div class="w-full relative">
                               <input type="file" name="passport_back" id="datePicker"
                                   class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">

                           </div>
                       </div>

                       <!-- <div class="w-full relative group flex flex-col gap-1">
                                <label class="font-semibold text-ternary/90 text-sm">Other Doc</label>
                                
                            
                                    <div id="fileInputContainer" class="w-full relative flex flex-col gap-2">
                                        <div class="flex items-center gap-2">
                                            <input type="file" name="otherdocument[]" class="file-input w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                            
                                            <button type="button" id="addFileBtn" class="p-2 bg-secondary/40 text-white rounded-full hover:bg-secondary/70 transition">
                                                +
                                            </button>
                                        </div>
                                    </div>
                          </div> -->

                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="wagesSelect" class="font-semibold text-ternary/90 text-sm">Wages type</label>
                           <div class="w-full relative">
                               <select name="wages_type" id="wagesSelect"
                                   class="appearance-none w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                   <option value="hourly">Hourly</option>
                                   <option value="weekly">Weekly</option>
                                   <option value="monthly">Monthly</option>
                               </select>

                               <!-- Custom Dropdown Arrow -->
                               <i class="fa fa-angle-down absolute right-3 top-1/2 -translate-y-1/2 text-sm text-secondary/80 pointer-events-none"></i>
                           </div>
                       </div>



                       <div class="w-full relative group flex flex-col gap-1">
                           <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Wage</label>
                           <div class="w-full relative">
                               <input type="text" name="wage" id="wage" placeholder="Wages....."
                                   class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">

                           </div>
                       </div>

                   </div>


                   <!-- eduction -->

                   <div class="w-full flex flex-col gap-2 px-4 mt-8">

                       <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                           <span class="text-lg font-bold text-ternary">Education Information</span>
                       </div>


                       <!-- Document Container -->
                       <div id="educationContainer">
                           <!-- Initial Document and Attachment Fields -->
                           <div id="inputGroup1" class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">
                               <div class="w-full relative group flex flex-col gap-1">
                                   <label for="eductionname1" class="font-semibold text-ternary/90 text-sm">Education</label>
                                   <div class="w-full relative">
                                       <input type="text" name="eductionname1" id="eductionname1" placeholder="Education  name..."
                                           value="{{ old('eductionname1') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                           @error('eductionname1') border-red-500 @enderror">
                                       <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                   </div>

                                   @error('eductionname1')
                                   <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                   @enderror
                               </div>

                               <div class="w-full relative group flex flex-col gap-1">
                                   <label for="attachment1" class="font-semibold text-ternary/90 text-sm">Marksheet</label>
                                   <div class="w-full relative">
                                       <input type="file" name="eductionfile1" id="eductionfile1"
                                           value="{{ old('eductionfile1') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                           @error('eductionfile1') border-red-500 @enderror">
                                       <i class="fa fa-database absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                   </div>

                                   @error('eductionfile1')
                                   <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                   @enderror
                               </div>

                               <button id="addEducationBtn" class="px-4 py-2 bg-blue-500 text-black rounded">Add More</button>

                               <!-- File Inputs Container -->
                               <div id="educationInputContainer" class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2"></div>
                           </div>
                       </div>

                   </div>

                   <!-- endeducation -->


                   <!-- taxsab -->
                   <div class="w-full flex flex-col gap-2 px-4 mt-8">

                       <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                           <span class="text-lg font-bold text-ternary">Tax Information</span>
                       </div>


                       <!-- Document Container -->
                       <div id="taxContainer">
                           <!-- Initial Document and Attachment Fields -->
                           <div id="inputGroup1" class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">



                               <div class="w-full relative group flex flex-col gap-1">
                                   <label for="attachment1" class="font-semibold text-ternary/90 text-sm">Tax Name</label>
                                   <div class="w-full relative">
                                       <input type="text" name="tax1" id="deductionname1" placeholder="Tax name..."
                                           value="{{ old('tax1') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                           @error('tax1') border-red-500 @enderror">
                                       <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                   </div>

                                   @error('tax1')
                                   <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                   @enderror
                               </div>

                               <div class="w-full relative group flex flex-col gap-1">
                                   <label for="attachment1" class="font-semibold text-ternary/90 text-sm">Tax Value </label>
                                   <div class="w-full relative">
                                       <input type="text" name="taxvalue1" id="taxvalue1" placeholder="Tax Value..."
                                           value="{{ old('taxvalue1') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                           @error('taxvalue1') border-red-500 @enderror">
                                       <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                   </div>
                                   @error('taxvalue1')
                                   <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                   @enderror
                               </div>

                               <button id="addTaxBtn" class="px-4 py-2 bg-blue-500 text-black rounded">Add Tax</button>

                               <!-- File Inputs Container -->
                               <div id="fileInputContainer" class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2"></div>
                           </div>
                       </div>
                   </div>

                   <!-- end sab -->


                   <!-- deduction -->
                   <div class="w-full flex flex-col gap-2 px-4 mt-8">

                       <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                           <span class="text-lg font-bold text-ternary">Deductions Information</span>
                       </div>


                       <!-- Document Container -->
                       <div id="deductionsContainer">
                           <!-- Initial Document and Attachment Fields -->
                           <div id="inputGroup1" class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">

                               <div class="w-full relative group flex flex-col gap-1">
                                   <label for="document1" class="font-semibold text-ternary/90 text-sm">Accommandation</label>
                                   <div class="w-full relative">
                                       <input type="number" name="accommandation" id="accommandation" placeholder="Amount..."
                                           value="{{ old('accommandation') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                           @error('accommandation') border-red-500 @enderror">
                                       <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                   </div>

                                   @error('accommandation')
                                   <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                   @enderror
                               </div>

                               <div class="w-full relative group flex flex-col gap-1">
                                   <label for="document1" class="font-semibold text-ternary/90 text-sm">Cab</label>
                                   <div class="w-full relative">
                                       <input type="number" name="cab" id="cab" placeholder="..."
                                           value="{{ old('cab') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                           @error('cab') border-red-500 @enderror">
                                       <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                   </div>

                                   @error('cab')
                                   <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                   @enderror
                               </div>



                               <div class="w-full relative group flex flex-col gap-1">
                                   <label for="document1" class="font-semibold text-ternary/90 text-sm">Food</label>
                                   <div class="w-full relative">
                                       <input type="numbber" name="food" id="food" placeholder="..."
                                           value="{{ old('food') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                           @error('food') border-red-500 @enderror">
                                       <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                   </div>

                                   @error('food')
                                   <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                   @enderror
                               </div>

                               <div class="w-full relative group flex flex-col gap-1">
                                   <label for="attachment1" class="font-semibold text-ternary/90 text-sm">Other Deductions </label>
                                   <div class="w-full relative">
                                       <input type="text" name="deduction1" id="deduction1" placeholder="Tax name..."
                                           value="{{ old('deduction1') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                           @error('deduction1') border-red-500 @enderror">
                                       <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                   </div>

                                   @error('deduction1')
                                   <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                   @enderror
                               </div>

                               <div class="w-full relative group flex flex-col gap-1">
                                   <label for="attachment1" class="font-semibold text-ternary/90 text-sm">Deductions Value </label>
                                   <div class="w-full relative">
                                       <input type="number" name="deductionvalue1" id="deductionvalue1" placeholder="Tax Value..."
                                           value="{{ old('deductionvalue1') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                           @error('deductionvalue1') border-red-500 @enderror">
                                       <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                   </div>

                                   @error('deductionvalue1')
                                   <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                   @enderror
                               </div>

                               <button id="addDeductionsBtn" class="px-4 py-2 bg-blue-500 text-black rounded">Add Deductions</button>

                               <!-- File Inputs Container -->
                               <div id="fileInputContainer" class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2"></div>
                           </div>
                       </div>
                   </div>
                   <!-- deduction  -->



                   <div class="w-full flex flex-col gap-2 px-4 mt-8">

                       <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                           <span class="text-lg font-bold text-ternary">Document Information</span>
                       </div>


                       <!-- Document Container -->
                       <div id="documentContainer">
                           <!-- Initial Document and Attachment Fields -->
                           <div id="inputGroup1" class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">
                               <div class="w-full relative group flex flex-col gap-1">
                                   <label for="document1" class="font-semibold text-ternary/90 text-sm">Document Name</label>
                                   <div class="w-full relative">
                                       <input type="text" name="document1" id="document1" placeholder="Document name..."
                                           value="{{ old('document1') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                           @error('document1') border-red-500 @enderror">
                                       <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                   </div>

                                   @error('document1')
                                   <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                   @enderror
                               </div>

                               <div class="w-full relative group flex flex-col gap-1">
                                   <label for="attachment1" class="font-semibold text-ternary/90 text-sm">Attachment</label>
                                   <div class="w-full relative">
                                       <input type="file" name="file1" id="file1"
                                           value="{{ old('file1') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                           @error('file1') border-red-500 @enderror">
                                       <i class="fa fa-database absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                   </div>

                                   @error('file1')
                                   <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                   @enderror
                               </div>

                               <button id="addDocumentBtn" class="px-4 py-2 bg-blue-500 text-black rounded">Add File</button>

                               <!-- File Inputs Container -->
                               <div id="fileInputContainer" class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2"></div>
                           </div>
                       </div>

                   </div>



                   <div class="w-full flex justify-end px-4 pb-4 gap-2">
                       <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button>
                       <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Create Staff</button>
                   </div>
               </form>
           </div>
           {{-- === form section code ends here===--}}


           {{-- === table section code ends here===--}}




       </div>

       @section('scripts')


       <script>
           $(document).ready(function() {
               $("#searchAddress").on("click", function(e) {
                   e.preventDefault(); // Stop the default behavior

                   var postcode = $("#zip_code").val().trim(); // Get postcode input

                   if (postcode === "") {
                       alert("Please enter a postcode.");
                       return;
                   }

                   $.ajax({
                       url: `https://api.postcodes.io/postcodes/${postcode}`,
                       method: "GET",
                       dataType: "json",
                       success: function(response) {
                           if (response.status === 200) {
                               let data = response.result;
                               let address = `${data.nuts}, ${data.admin_ward}`;

                               console.log("API Response:", data);

                               let country = data.country;
                               let state = data.region;
                               let city = data.admin_district || data.parish;


                               // Fill the input fields
                               $("#address").val(address);
                               $("#country").val(country);
                               $("#state").val(state);
                               $("#city").val(city);

                           } else {
                               alert("Invalid postcode. Please try again.");
                           }
                       },
                       error: function(xhr, status, error) {
                           console.error("Error fetching postcode data:", error);
                           alert("Could not fetch postcode data. Please try again.");
                       }
                   });

                   return false; // Extra safeguard to prevent page refresh
               });
           });

           document.addEventListener('DOMContentLoaded', function() {
               let taxCounter = 1,
                   deductionCounter = 1; // Start counters
               const maxEntries = 5; // Maximum allowed entries

               function addField(type, containerId, counter) {
                   if (counter >= maxEntries) {
                       alert(`You can only add up to ${maxEntries} ${type === 'tax' ? 'taxes' : 'deductions'}.`);
                       return counter;
                   }

                   counter++; // Increment counter

                   const container = document.getElementById(containerId);
                   const wrapper = document.createElement('div');
                   wrapper.className = "p-4 border border-gray-300 rounded-lg flex flex-col gap-2";
                   wrapper.dataset.type = type;

                   wrapper.innerHTML = `
            <div class="w-full flex flex-col gap-1">
                <label class="font-semibold text-ternary/90 text-sm">${type === 'tax' ? 'Tax Name' : 'Other Deductions'}</label>
                <div class="w-full relative">
                    <input type="text" name="${type}${counter}" id="${type}${counter}" placeholder="${type === 'tax' ? 'Tax' : 'Deduction'} name..."
                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                        @error('${type}${counter}') border-red-500 @enderror">
                    <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                </div>
            </div>

            <div class="w-full flex flex-col gap-1">
                <label class="font-semibold text-ternary/90 text-sm">${type === 'tax' ? 'Tax Value' : 'Deductions Value'}</label>
                <div class="w-full relative">
                    <input type="text" name="${type}value${counter}" id="${type}value${counter}" placeholder="${type === 'tax' ? 'Tax' : 'Deduction'} Value..."
                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                        @error('${type}value${counter}') border-red-500 @enderror">
                    <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                </div>
            </div>

            <button type="button" class="mt-2 px-4 py-1 bg-red-500 text-black rounded remove-btn">Remove</button>
        `;

                   container.appendChild(wrapper);
                   return counter;
               }

               document.getElementById('addTaxBtn').addEventListener('click', function(event) {
                   event.preventDefault();
                   taxCounter = addField('tax', 'taxContainer', taxCounter);
               });

               document.getElementById('addDeductionsBtn').addEventListener('click', function(event) {
                   event.preventDefault();
                   deductionCounter = addField('deduction', 'deductionsContainer', deductionCounter);
               });

               // Event delegation for removing elements
               document.addEventListener('click', function(event) {
                   if (event.target.classList.contains('remove-btn')) {
                       const wrapper = event.target.closest('div');
                       if (wrapper.dataset.type === 'tax') taxCounter--;
                       else deductionCounter--;
                       wrapper.remove();
                   }
               });
           });


           //check for validate
           document.addEventListener("DOMContentLoaded", function() {
               let today = new Date().toISOString().split('T')[0];

               let minBirthDate = new Date();
               minBirthDate.setFullYear(minBirthDate.getFullYear() - 14);
               let minBirthDateString = minBirthDate.toISOString().split('T')[0];

               const issuedate = document.getElementById('passport_issuedate');
               const birthdate = document.getElementById('date_ofbirth');
               const expiredate = document.getElementById('passport_expiredate');

               if (issuedate) issuedate.setAttribute('max', today);
               if (birthdate) birthdate.setAttribute('max', minBirthDateString);
               if (expiredate) expiredate.setAttribute('min', today);

               function validateDateInput(input, type) {
                   input.addEventListener("change", function() {
                       // Ensure the input is fully entered (YYYY-MM-DD is 10 characters long)
                       if (this.value.length !== 10) return;

                       let selectedDate = new Date(this.value);

                       let minDate = this.getAttribute("min") ? new Date(this.getAttribute("min")) : null;
                       let maxDate = this.getAttribute("max") ? new Date(this.getAttribute("max")) : null;

                       // Check if the entered date is within the allowed range
                       if ((minDate && selectedDate < minDate) || (maxDate && selectedDate > maxDate)) {
                           alert(`Invalid ${type}! Please select a valid date.`);
                           this.value = ""; // Reset invalid value
                       }
                   });
               }

               if (issuedate) validateDateInput(issuedate, "Issue Date");
               if (birthdate) validateDateInput(birthdate, "Birth Date");
               // if (expiredate) validateDateInput(expiredate, "Expiry Date");
           });


           ///add functionality for document
       </script>


       @endsection
   </x-front.layout>