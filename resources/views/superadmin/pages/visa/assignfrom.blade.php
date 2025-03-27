<x-front.layout>
    @section('title') Visa From  @endsection



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Assign Country </span>
              
            </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
             <form action="{{ route('visaform.assigncountry') }}" method="POST" enctype="multipart/form-data">  
                   @csrf
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Form Name</label>
                             <div class="w-full relative">
                                <input type="hidden" name="form_id" value="{{$form->id}}">
                                 <input type="text" name="name" id="name"  readonly="" value="{{$form->form_name}}" placeholder="Form name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-from absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
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


 


                    
                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                     
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Assign Country</button>
                     </div>
                 </form>
             </div>
{{--        === form section code ends here===--}}


        </div>
</x-front.layout>
