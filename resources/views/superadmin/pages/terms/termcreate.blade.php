<x-front.layout>
    @section('title')
    Terms Conditions 
    @endsection


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Term Create </span>
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Terms</button> -->
            </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
   

                 <form action="{{route('superadmin.termsstore')}}" method="POST" enctype="multipart/form-data">
                 @csrf
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                     <input type="hidden" name="termid" value="{{$termtype->id}}">
                     {{--               === textarea input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1 xl:col-span-2">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Term Name</label>
                             <div class="w-full relative">
                                  <input type="text" name="name"  value="{{$termtype->type}}" readonly="" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"> 
                                 <i class="fa-regular fa-user absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div>

                         {{--               === textarea input field ===--}}
                        


                         {{--               === textarea input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1 xl:col-span-2">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Term Heading</label>
                             <div class="w-full relative">
                                  <input type="text" name="termheading"   radonly="" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"> 
                                 <i class="fa-regular fa-user absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div>



                         {{--               === textarea input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1 xl:col-span-2">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Description</label>
                             <div class="w-full relative">
                                 <textarea   name="description" id="description" rows="2" placeholder="Description....." class="quill-editor w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"></textarea>
                                 <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div>



                         {{--               === radio input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <span class="font-semibold text-ternary/90 text-sm">Display Invoice</span>
                             <div class="flex gap-4">
                                 <label class="flex items-center gap-2">
                                     <input type="radio" name="displayinvoice" value="1" class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                   Yes
                                 </label>
                                 <label class="flex items-center gap-2">
                                     <input type="radio" name="displayinvoice" value="0" class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0" checked>
                                    No
                                 </label>
                             </div>
                         </div>


                     
                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                          <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button> -->
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Create Term</button>
                     </div>
                 </form>
             </div>
{{--        === form section code ends here===--}}




<script>
    function toggleReadMore(button) {
        let parent = button.previousElementSibling; // The paragraph containing text
        let shortText = parent.querySelector(".short-text");
        let fullText = parent.querySelector(".full-text");

        if (fullText.style.display === "none") {
            fullText.style.display = "inline";
            shortText.style.display = "none";
            button.textContent = "Read Less";
        } else {
            fullText.style.display = "none";
            shortText.style.display = "inline";
            button.textContent = "Read More";
        }
    }
</script>

        </div>
</x-front.layout>
