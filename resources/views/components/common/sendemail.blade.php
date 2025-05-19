<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">


          <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Send Email  </span>
          </div>

     <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
         <form action="{{ route('sendclintemail') }}" method="POST" enctype="multipart/form-data">
               @csrf
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
              

                      

                         <div class="w-full relative group flex flex-col gap-1  xl:col-span-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm ">Email Id</label>
                             <div class="w-full relative">
                                 <input type="text" name="emailid" id="title_image" readonly=""  value="{{$clientData->clint->email}}" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <input type="hidden" name="visa_id" value="{{$clientData->id}}">
                             </div>
                             @error('visa_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                         </div>
                     
                         <div class="w-full relative group flex flex-col gap-1 xl:col-span-1">
                                <label for="name" class="font-semibold text-ternary/90 text-sm">Document</label>
                                <div class="w-full relative">
                                    <input type="file" name="formupload" accept="application/pdf" 
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                </div>
                                @error('message')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
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

   
