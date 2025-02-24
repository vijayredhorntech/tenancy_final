<x-front.layout>
    @section('title')
    Terms Conditions 
    @endsection


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Terms  List </span>
                <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Terms</button>
            </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 hidden">
        

                 <form action="{{route('superadmin.termsstore')}}" method="POST" enctype="multipart/form-data">
                 @csrf
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                         {{--               === textarea input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Description</label>
                             <div class="w-full relative">
                                 <textarea   name="description" id="description" rows="1" placeholder="Description....." class="quill-editor w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"></textarea>
                                 <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div>



                         {{--               === radio input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <span class="font-semibold text-ternary/90 text-sm">Assign for Invoice</span>
                             <div class="flex gap-4">
                                 <label class="flex items-center gap-2">
                                     <input type="radio" name="assign" value="1" class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                   Yes
                                 </label>
                                 <label class="flex items-center gap-2">
                                     <input type="radio" name="assign" value="0" class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                    No
                                 </label>
                             </div>
                         </div>


                     
                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                          <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button>
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Create Agency</button>
                     </div>
                 </form>
             </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
     
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Description</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Created date</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">User</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Status</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                    </tr>
    


                    @forelse($terms as $term)
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>

                            @php
                                            $description = $term['description'];
                                            $shortDescription = Str::limit($description, 100); // Limit to 100 characters
                                        @endphp

                                        <p class="description">
                                        <td>  <span class="short-text">{!! $shortDescription !!}</span> 
                                          <span class="full-text" style="display: none;">{{$description}}</span>
                                        </p>

                                        @if(strlen($description) > 100)
                                             <button class="read-more-btn primary" onclick="toggleReadMore(this)">Read More</button>
                                        @endif  </td> 

                            <!-- <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$term['description']}}</td> -->
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$term['created_at']}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">super admin</td>
                           
                           
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                            <span class="bg-{{$term['status']==='0'?'danger':'success'}}/10 text-{{$term['status']==='0'?'danger':'success'}} px-2 py-1 rounded-[3px] font-bold"> {{ $term['status'] == 1 ? 'Active' : 'Inactive' }}</span>
                            

                                  </td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">
                                    <a href="" title="Remind for funds">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </a>
                                    <a href="{{route('superadmin.termedit',['id' => $term->id])}}" title="View Invoices">
                                        <div class=" bg-success/10 text-info h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-info hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                    </a>
                               


                                </div>
                            </td>
                        </tr>


                    @empty
                        <tr>
                            <td colspan="9" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                        </tr>
                    @endforelse


                </table>
            </div>
{{--        === table section code ends here===--}}

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
