<x-agency.layout>
    @section('title') Visa Application @endsection



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">


            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Send Email  </span>
                <!-- <a href="{{route('visa.create')}}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000"> Create New Visa </a>  -->
                
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Visa</button> -->
            </div>

            <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
             <form action="" method="POST" enctype="multipart/form-data">
               @csrf
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
              

                         <div class="w-full relative group flex flex-col gap-1  xl:col-span-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm ">Document Name</label>
                             <div class="w-full relative">
                                 <input type="text" name="document_name" id="title_image" readonly=""  value="{{$document->title}}" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <input type="hidden" name="visa_id" value="">
                             </div>
                             @error('visa_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                         </div>


                         <div class="w-full relative group flex flex-col gap-1  xl:col-span-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm ">Custom Email</label>
                             <div class="w-full relative">
                                 <input type="text" name="customemail" id="title_image" placeholder="Enter Email id" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <input type="hidden" name="visa_id" value="">
                             </div>
                             @error('customemail')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                         </div>
                     
                    <!-- custom email  -->
                    <div class="w-full relative group flex flex-col gap-1">
                                <label for="staff" class="font-semibold text-ternary/90 text-sm">Staff</label>
                                <div class="w-full relative">
                                    <select name="staff" id="staff"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('staff') border-red-500 @enderror">
                                        <option value="">Select</option>
                                </select>
                                    <i class="fa fa-user-tie absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('staff')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="w-full relative group flex flex-col gap-1 ">
                                <label for="client" class="font-semibold text-ternary/90 text-sm">Client</label>
                                <div class="w-full relative">
                                    <select name="client" id="client"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('client') border-red-500 @enderror">
                                        <option value="">Select</option>
                                    </select>
                                    <i class="fa fa-address-card absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('client')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>



                         <div class="w-full relative group flex flex-col gap-1  xl:col-span-2">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Subject</label>
                             <div class="w-full relative">
                                 <input type="text" name="subject"   value="" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                               
                             </div>
                             @error('message')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                         </div>
                
                     

               
                         <div class="w-full relative group flex flex-col xl:col-span-4 gap-1">
                            <label for="description" class="font-semibold text-ternary/90 text-sm">Message</label>
                            <div class="w-full relative">
                                <div id="editor" class="w-full pl-2 pr-8 py-1 border border-gray-300 rounded focus:outline-none focus:border-blue-500" style="height: 200px;">{!! old('description',isset($visa) ? $visa->description : '') !!}</div>

                                <input type="hidden" name="message" id="description" value="{{ old('description',isset($visa) ? $visa->description : '') }}">
                                @error('message')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
  
                    
                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Send Email</button>
                     </div>
                 </form>
             </div>

            
             </div>

   

        
    </x-agency.layout>
