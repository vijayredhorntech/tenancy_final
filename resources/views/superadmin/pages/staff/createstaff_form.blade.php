   <x-front.layout>
    @section('title')Staff @endsection

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Staff Create </span>
                   </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
             <form action="{{ route('superadmin_staffstore') }}" method="POST" enctype="multipart/form-data"> 
                  @csrf
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="profile" class="font-semibold text-ternary/90 text-sm">Profile</label>
                             <div class="w-full relative">
                                 <input type="file" name="profile" id="profile" placeholder="Staff name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-file absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>



                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Name</label>
                             <div class="w-full relative">
                                 <input type="text" name="name" id="name" placeholder="Staff name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>
                        
                        
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="email" class="font-semibold text-ternary/90 text-sm">Email</label>
                             <div class="w-full relative">
                                 <input type="email" name="email" id="email" placeholder="Email....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Phone</label>
                             <div class="w-full relative">
                                 <input type="number" name="staff_phone" id="staff_phone" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
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
                                 <input type="number" name="bankdetails" id="zip_code" placeholder="" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Sort Code</label>
                             <div class="w-full relative">
                                 <input type="text" name="short_code" id="short_code" placeholder="Short Code....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Bank Name</label>
                             <div class="w-full relative">
                                 <input type="text" name="bank_name" id="bank_name" placeholder="Bank Name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                  


                         {{--   === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Zip Code</label>
                             <div class="w-full relative">
                                 <input type="text" name="zip_code" id="zip_code" placeholder="zip code....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                           <!-- <div class="address"> </div>  -->
                           <label for="name" class="font-semibold text-ternary/90 text-sm">Address</label>
                             <div class="w-full relative">
                                 <input type="text" name="address" id="address" placeholder="Address....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">City</label>
                             <div class="w-full relative">
                                 <input type="text" name="city" id="city" placeholder="City....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">State</label>
                             <div class="w-full relative">
                                 <input type="text" name="state" id="state" placeholder="State....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-flag absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Country</label>
                             <div class="w-full relative">
                                 <input type="text" name="country" id="country" placeholder="Country....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>

                       




                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Emergency Person Name</label>
                             <div class="w-full relative">
                                 <input type="text" name="emergencyperson_name" id="emergencyperson_name" placeholder="" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Emergency Person contact</label>
                             <div class="w-full relative">
                                 <input type="text" name="emergencyperson_contact" id="emergencyperson_contact" placeholder="" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Emergency Person Email</label>
                             <div class="w-full relative">
                                 <input type="text" name="emergencyperson_email" id="emergencyperson_email" placeholder="" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>
                         

                         {{-- === select input field ===--}}

                   

                         <div class="w-full relative group flex flex-col gap-1">
                            
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Passport Number</label>
                             <div class="w-full relative">
                                 <input type="text" name="passport_number" id="passport_number" placeholder="Passport Number....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Place of Issue</label>
                             <div class="w-full relative">
                                 <input type="text" name="place_of_issue" id="place_of_issue" placeholder="Place of Issue....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
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
                                 <input type="date" name="passport_issuedate" id="passport_issuedate"  max=""
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

                         <div class="w-full relative group flex flex-col gap-1">
                                <label class="font-semibold text-ternary/90 text-sm">Other Doc</label>
                                
                                <!-- File Input Container -->
                                    <div id="fileInputContainer" class="w-full relative flex flex-col gap-2">
                                        <div class="flex items-center gap-2">
                                            <input type="file" name="otherdocument[]" class="file-input w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                            
                                            <!-- Plus Button -->
                                            <button type="button" id="addFileBtn" class="p-2 bg-secondary/40 text-white rounded-full hover:bg-secondary/70 transition">
                                                +
                                            </button>
                                        </div>
                                    </div>
                          </div>

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


                         <div class="w-full relative group flex flex-col gap-1">
                            <label class="font-semibold text-ternary/90 text-sm">Tax Slab</label>
                            <div id="taxSlabContainer" class="w-full relative flex flex-col gap-2">
                                <div class="flex items-center gap-2">
                                    <input type="text" name="tax_slab[]" placeholder="Enter tax slab" 
                                        class="w-full px-2 py-1 rounded-[3px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                    <!-- Plus Button -->
                                    <button type="button" id="addTaxSlabBtn" class="p-2 bg-secondary/40 text-white rounded-full hover:bg-secondary/70 transition"> + </button>
                                </div>
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Accommandation</label>
                             <div class="w-full relative">
                                 <input type="text" name="accommandation" id="accommandation" placeholder="Accommandation....."
                                        class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                              
                             </div>
                         </div>

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Cab</label>
                             <div class="w-full relative">
                                 <input type="text" name="cab" id="cab" placeholder="Wages....."
                                        class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                              
                             </div>
                         </div>

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Food</label>
                             <div class="w-full relative">
                                 <input type="text" name="food" id="food" placeholder="Wages....."
                                        class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                             </div>
                         </div>

                         <div class="w-full relative group flex flex-col gap-1">
                            <label class="font-semibold text-ternary/90 text-sm">Other</label>
                            <div id="wagesContainer" class="w-full relative flex flex-col gap-2">
                                <div class="flex items-center gap-2">
                                    <input type="text" name="otherdeduction[]" placeholder="Enter Deduction..."
                                        class="w-full px-2 py-1 rounded-[3px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                    <!-- Plus Button -->
                                    <button type="button" id="addWagesBtn" class="p-2 bg-secondary/40 text-white rounded-full hover:bg-secondary/70 transition"> + </button>
                                </div>
                            </div>
                        </div>




                        
                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                          <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button>
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Create Staff</button>
                     </div>
                 </form>
             </div>
{{--        === form section code ends here===--}}


{{--        === table section code ends here===--}}

            <script>

//check for validate
                document.addEventListener("DOMContentLoaded", function () {
                        let today = new Date().toISOString().split('T')[0]; 

                        const issuedate = document.getElementById('passport_issuedate');
                        const birthdate = document.getElementById('date_ofbirth');
                        const expiredate = document.getElementById('passport_expiredate');

                        if (issuedate) issuedate.setAttribute('max', today);
                        if (birthdate) birthdate.setAttribute('max', today);
                        if (expiredate) expiredate.setAttribute('min', today);

                        function validateDateInput(input, type) {
                            input.addEventListener("change", function () {
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

                document.getElementById('addFileBtn').addEventListener('click', function() {
                    let container = document.getElementById('fileInputContainer');
                    let fileInputs = container.getElementsByTagName('input');

                    if (fileInputs.length < 10) { // Limit to 10 inputs
                        // Create a new wrapper div for input and button
                        let fileWrapper = document.createElement('div');
                        fileWrapper.className = "flex items-center gap-2";

                        // Create new file input
                        let newInput = document.createElement('input');
                        newInput.type = 'file';
                        newInput.name = 'otherdocument[]';
                        newInput.className = "file-input w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200";

                        // Append input to wrapper
                        fileWrapper.appendChild(newInput);

                        // Append wrapper to container
                        container.appendChild(fileWrapper);
                    } else {
                        alert("You can only upload up to 10 files.");
                    }
                });


    //add functionality for tax
                function addTextInput() {
                        let container = document.getElementById('taxSlabContainer');
                        let textInputs = container.getElementsByTagName('input');

                        if (textInputs.length < 5) { // Limit to 10 inputs
                            let textWrapper = document.createElement('div');
                            textWrapper.className = "flex items-center gap-2";

                            let newInput = document.createElement('input');
                            newInput.type = 'text';
                            newInput.name = 'tax_slab[]';
                            newInput.placeholder = "Enter tax slab";
                            newInput.className = "w-full px-2 py-1 rounded-[3px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200";

                            textWrapper.appendChild(newInput);
                            container.appendChild(textWrapper);
                        } else {
                            alert("You can only add up to 10 tax slabs.");
                        }
         }

    // Event listener for adding tax slab inputs
    document.getElementById('addTaxSlabBtn').addEventListener('click', addTextInput);


    //add functionlity for dedution

    document.getElementById('addWagesBtn').addEventListener('click', function () {
        let container = document.getElementById('wagesContainer');
        let inputs = container.getElementsByTagName('input');

        if (inputs.length < 10) { // Limit to 10 inputs
            let inputWrapper = document.createElement('div');
            inputWrapper.className = "flex items-center gap-2";

            let newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'otherdeduction[]';
            newInput.placeholder = "Enter wages...";
            newInput.className = "w-full px-2 py-1 rounded-[3px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200";

            inputWrapper.appendChild(newInput);
            container.appendChild(inputWrapper);
        } else {
            alert("You can only add up to 10 wage inputs.");
        }
    });
            </script>



        </div>
</x-front.layout>
