<x-front.layout>
    @section('title') Visa From  @endsection



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Form List </span>
                <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New From</button>
            </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 hidden">
             <form action="{{ route('visaform.store') }}" method="POST" enctype="multipart/form-data">  
                   @csrf
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Form Name</label>
                             <div class="w-full relative">
                                 <input type="text" name="name" id="name" placeholder="Form name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>



                         {{-- === select input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Origin</label>
                             <div class="w-full relative">
                                 <select  name="origincoutnry" id="origincoutnry"
                                          class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                     <option value="">---Select---</option>
                                     @forelse($countries as $country)
                                     <option value="{{$country->id}}">{{$country->name}}</option>
                                     @empty
                                     <option value="">NO record found</option>
                                     @endforelse
                          
                                 </select>
                                 <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                                 @error('origincoutnry')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Destination</label>
                             <div class="w-full relative">
                                 <select  name="destination" id="datePicker"
                                          class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                     <option value="">---Select---</option>
                                     @forelse($countries as $country)
                                     <option value="{{$country->id}}">{{$country->name}}</option>
                                     @empty
                                     <option value="">NO record found</option>
                                     @endforelse
                                 </select>
                                 <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                                 @error('destination')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                </div>
                         </div>

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Form Uploade</label>
                             <div class="w-full relative">
                                 <input type="file" name="form_uploade" id="formuploade" placeholder="Form name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


 
                         {{--               === textarea input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Description</label>
                             <div class="w-full relative">
                                 <textarea   name="description" id="description" rows="5" placeholder="Description....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"></textarea>
                                 <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div>


                    
                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                          <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button>
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Create Form</button>
                     </div>
                 </form>
             </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex justify-between gap-2 items-center">
                     <div class="flex gap-2">
                         <!-- <button title="Export to excel" class="bg-success/20 text-success h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white  cursor-pointer transition ease-in duration-2000">
                             <i class="fa fa-file-excel"></i>
                         </button>
                         <button title="Export to pdf" class="bg-danger/20 text-danger h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white  cursor-pointer transition ease-in duration-2000">
                               <i class="fa fa-file-pdf"></i>
                         </button> -->
                     </div>

                    <!-- <div class="flex items-center gap-2">
                           <input type="text" placeholder="Form name....." class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000" >
                           <button class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                                <i class="fa fa-search mr-1"></i> Search
                           </button>
                    </div> -->
                    <div class="flex items-center gap-2">
                    
               <form action="{{ route('search') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 <input type="hidden" name="type" value="form">
                    <input type="text" placeholder="Form name....." name="search"

                           class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000">
                    <button type="submit"
                        class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                        <i class="fa fa-search mr-1"></i> Search
                    </button>
                </form>
               @if(isset($searchback))
                <a href="{{route('visa.forms')}}">   <button type="button" 
                    class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">
                Back
                    </button>
                </a> 

                @endif
                </div>
                </div>
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Form Name</td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Form Description</td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Total Assign Country</td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">View Form</td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>

                    </tr>
                   


                    @forelse($forms as $form)
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$form['form_name']}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$form['form_description']}}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                {{ $form->countries ? $form->countries->count() : 0 }}
                            </td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                            <a href="{{asset($form['document'])}}" target="_blank">  
                               View form
                           </a> 
                            </td>
                           
                            
                    
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">
                                    <!-- <a href="" title="View All Form">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </a> -->
                                    <!-- <a href="" title="View Edit">
                                        <div class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-edit"></i>
                                        </div>
                                    </a> -->

                                    <a href="{{route('form.assigncountry',['id' => $form->id])}}" title="AssignCountry From">
                                        <div class=" bg-warning/10 text-warning h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-warning hover:text-white transition ease-in duration-2000">
                                        <i class="fa fa-globe"></i>
                                        </div>
                                    </a>
                                    <a href="{{route('form.delete',['id' => $form->id])}}" title="Delete From">
                                        <div class=" bg-danger/10 text-danger h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-trash"></i>
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
        </div>
</x-front.layout>
