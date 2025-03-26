<x-agency.layout>
    @section('title') Visa Application @endsection


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Edit Visa Application </span>
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Agency</button> -->
            </div>
{{--        === heading section code ends here===--}}


{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
             <form action="{{route('updatevisa.application') }}" method="POST" enctype="multipart/form-data">     
                    @csrf
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                            <input type="hidden" name="applciationid" value="{{$clientData->id}}">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Application Id</label>
                             <div class="w-full relative">
                                 <input type="text" name="name" id="name" value="{{$clientData->application_number}}" readonly="" readonly="" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <!-- <i class="fa fa-applicaiton absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                             </div>
                         </div>

                         {{--               === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Full Name</label>
                             <div class="w-full relative">
                                 <input type="text" name="name" id="name" value="{{$clientData->clint->name}}" readonly="" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <!-- <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                             </div>
                         </div>

                         {{--               === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Phone Number</label>
                             <div class="w-full relative">
                                 <input type="number" name="name" id="name" value="{{$clientData->clint->phone_number}}" readonly="" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <!-- <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                             </div>
                         </div>

                         {{--               === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Visa Type</label>
                             <div class="w-full relative">
                                 <input type="text" name="name" id="name" value="{{$clientData->visa->name}}" readonly="" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <!-- <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                             </div>
                         </div>

                         {{--               === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Origin</label>
                             <div class="w-full relative">
                                 <input type="text" name="name" id="name" value="{{$clientData->origin->name}}" readonly="" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <!-- <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                             </div>
                         </div>
                         

                         {{--               === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Destination:</label>
                             <div class="w-full relative">
                                 <input type="text" name="name" id="name" value="{{$clientData->destination->name}}" readonly="" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <!-- <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                             </div>
                         </div>
                         {{--               === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Fee </label>
                             <div class="w-full relative">
                                 <input type="number" name="name" id="name" value="{{$clientData->total_amount}}" readonly="" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>
                  


                         {{--               === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Total Applicant</label>
                             <div class="w-full relative">
                                 <input type="number" name="name" id="name" value="{{$clientData->id}}" readonly="" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         {{--                === date type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Date</label>
                             <div class="w-full relative">
                                 <input type="date" name="date" id="datePicker"
                                        class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-calendar-day absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"
                                    onclick="document.getElementById('datePicker').showPicker();"></i>
                             </div>
                         </div>


                         {{--               === textarea input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Description</label>
                             <div class="w-full relative">
                                 <textarea   name="name" id="name" rows="1" placeholder="Description....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"></textarea>
                                 <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         {{-- === select input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Select box</label>
                             <div class="w-full relative">
                                 <select  name="date" id="datePicker"
                                          class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                     <option value="">---Select---</option>
                                     <option value="">Option 1</option>
                                     <option value="">Option 2</option>
                                     <option value="">Option 3</option>
                                     <option value="">Option 4</option>
                                 </select>
                                 <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                             </div>
                         </div>


                         {{--               === radio input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <span class="font-semibold text-ternary/90 text-sm">Select an Option</span>
                             <div class="flex gap-4">
                                 <label class="flex items-center gap-2">
                                     <input type="radio" name="option" value="option1" class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                     Option 1
                                 </label>
                                 <label class="flex items-center gap-2">
                                     <input type="radio" name="option" value="option2" class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                     Option 2
                                 </label>
                             </div>
                         </div>


              
                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                          <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button>
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Update Application</button>
                     </div>
                 </form>
             </div>

                </div>
            <!-- </div>

        </div> -->

        
    </x-agency.layout>
