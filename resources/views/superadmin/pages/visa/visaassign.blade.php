<x-front.layout>
    @section('title')Agency @endsection



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Visa Assign for Country</span>
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Agency</button> -->
            </div>
{{--        === heading section code ends here===--}}

@if ($errors->any())
    <div class="text-red-500 mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
                
             <form action="{{ route('assignstore') }}" method="POST" enctype="multipart/form-data">
               @csrf
                     <div class="w-full grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-4  sm:grid-cols-2 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Title Images</label>
                             <div class="w-full relative">
                                 <input type="file" name="title_image" id="title_image"  placeholder="Agency name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                 
                             </div>
                         </div>

                         @if(isset($single_visa->name))

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Visa Type</label>
                             <div class="w-full relative">
                                 <input type="text" name="visa_name" id="title_image" readonly=""  value="{{$single_visa->name}}"placeholder="Agency name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <input type="hidden" name="visa_id" value="{{$single_visa->id}}">
                             </div>
                         </div>
                         @else
                         
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Visa Type</label>
                             <div class="w-full relative">
                                 <select  name="visa_id" id="datePicker"
                                          class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                
                                   
                                     <option value="">---Select---</option>
                                     @forelse($visa as $single_visa)
                                     <option value="{{$single_visa->id}}">{{$single_visa->name}}</option>
                                     @empty
                                     <option value="">NO record found</option>
                                     @endforelse
                                 </select>
                                 <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                                 @error('visa_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                </div>
                         </div>


                         @endif

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Origin</label>
                             <div class="w-full relative">
                                 <select  name="origincoutnry" id="origincoutnry"
                                          class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                     <option value="">---Select---</option>
                                     @forelse($countries as $country)
                                     <option value="{{$country->id}}">{{$country->countryName}}</option>
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


                         <div class="w-full relative group flex flex-col  gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Destination</label>
                             <div class="w-full relative">
                                 <select  name="destination" id="datePicker"
                                          class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                     <option value="">---Select---</option>
                                     @forelse($countries as $country)
                                     <option value="{{$country->id}}">{{$country->countryName}}</option>
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


                   



                         {{--               === radio input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <span class="font-semibold text-ternary/90 text-sm">Required </span>
                             <div class="flex gap-4">
                                 <label class="flex items-center gap-2">
                                     <input type="radio" name="required" value="0" class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                    Required
                                 </label>
                                 <label class="flex items-center gap-2">
                                     <input type="radio" name="required" value="1"  checked  class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                    Not Required
                                 </label>
                             </div>
                         </div>
                       


                      


                         {{--               === textarea input field ===--}}
                         <div class="w-full relative group flex flex-col xl:col-span-4  lg:col-span-3 md:col-span-4 sm:col-span-2 gap-1 ">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Description</label>
                             <div class="w-full relative">
                                <div id="editor" class="w-full pl-2 pr-8 py-1 border border-gray-300 rounded focus:outline-none focus:border-blue-500" style="height: 200px;">{!! old('description') !!}</div>
                                    <input type="hidden" name="description" id="description" value="{{ old('description') }}">
                                    @error('description')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                                </div>
                           </div>
                     </div>
<!-- add subtype  -->
                    <div id="subtypeContainer" class="px-4"   >

               

                            @php

                                    $oldSubtypes = old('subtype', ['']); // Default empty array if no old values
                                    $oldSubtypePrices = old('subtypeprice', ['']);
                                    $oldCommissions = old('commission', ['']);
                            
                                @endphp

                                @foreach($oldSubtypes as $index => $subtype)
                                    <div class="subtypeGroup clickedit w-full grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-2 px-4 py-6" style="{{ isset($eid) ? 'display: none;' : '' }}">
                                    <!-- Visa Name -->
                                            <div class="w-full relative group flex flex-col gap-1">
                                                <label for="name" class="font-semibold text-ternary/90 text-sm">Subtype Name</label>
                                                    <div class="w-full relative">
                                                        <input type="text" name="subtype[]" value="{{ $subtype }}" placeholder="Subtype name..."
                                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px]
                                                            border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                                        @error('subtype.$index')
                                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                            </div>

                                
                                            <div class="w-full relative group flex flex-col gap-1">
                                                <label for="name" class="font-semibold text-ternary/90 text-sm">Validity</label>
                                                    <div class="w-full relative">
                                                        <input type="text" name="validity[]"  placeholder="Validity..."
                                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px]
                                                            border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                                        @error('validity.$index')
                                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                            </div>

                                            <div class="w-full relative group flex flex-col gap-1">
                                                <label for="name" class="font-semibold text-ternary/90 text-sm">Processing</label>
                                                    <div class="w-full relative">
                                                        <input type="text" name="processing[]"  placeholder="Processing..."
                                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px]
                                                            border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                                        @error('processing.$index')
                                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                            </div>

                                        

                                            <div class="w-full relative group flex flex-col gap-1">
                                                <label for="name" class="font-semibold text-ternary/90 text-sm">Subtype Price</label>
                                                    <div class="w-full relative">
                                                        <input type="number" name="subtypeprice[]" value="{{ $oldSubtypePrices[$index] }}" placeholder="Subtype price..."
                                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px]
                                                            border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                                        @error('subtypeprice.$index')
                                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                            </div>

                                            <div class="w-full relative group flex flex-col gap-1">
                                                <label for="name" class="font-semibold text-ternary/90 text-sm">Commission</label>
                                                    <div class="w-full relative">
                                                        <input type="number" name="commission[]" value="{{ $oldCommissions[$index] }}" placeholder="Commission..."
                                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px]
                                                            border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                                        @error('commission.$index')
                                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                            </div>

                                            <div class="w-full relative group flex flex-col gap-1">
                                                <label for="name" class="font-semibold text-ternary/90 text-sm">GSTIN(18%)</label>
                                                    <div class="w-full relative">
                                                        <input type="number" name="gstin[]" placeholder="GSTIN..."
                                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px]
                                                            border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                                        @error('gstin.$index')
                                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                            </div>

                                            <span class="removeField {{ $index == 0 ? 'hidden' : '' }} w-max cursor-pointer mt-3 px-3 py-1 bg-red-500 text-white text-xs rounded">Remove</span>
                                </div>
                                @endforeach



                            </div>
                            @if(isset($eid))
                            <div class="px-4 mt-4">
                                <button type="button" id="showButton" class="px-4 py-2 bg-blue-600 text-white rounded shadow">+ Add More</button>
                            </div>
                            @endif

                            <div class="px-4 mt-4">
                                <button type="button" id="addMore" class="clickedit px-4 py-2 bg-blue-600 text-white rounded shadow"  style="{{ isset($eid) ? 'display: none;' : '' }}">+ Add More</button>
                            </div>
                      


<!-- add sub type -->
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Assign Country</button>
                     </div>
                 </form>
                 
             </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
          
{{--        === table section code ends here===--}}
        </div>
        @section('scripts')
      <script>

              jQuery("#showButton").on("click",function (){
                     jQuery(".clickedit").show();
                     jQuery(this).hide();
              });
                document.addEventListener("DOMContentLoaded", function () {
                    const container = document.getElementById("subtypeContainer");
                    const addMoreButton = document.getElementById("addMore");

                    addMoreButton.addEventListener("click", function () {
                        let original = document.querySelector(".subtypeGroup");
                        let clone = original.cloneNode(true);

                        // Clear input values in cloned fields
                        clone.querySelectorAll("input").forEach(input => input.value = "");

                        // Show remove button in cloned elements
                        clone.querySelector(".removeField").classList.remove("hidden");

                        // Append the cloned field
                        container.appendChild(clone);
                    });

                    container.addEventListener("click", function (event) {
                        console.log(event);
                        if (event.target.classList.contains("removeField")) {
                            event.target.parentElement.remove();
                        }
                    });
                });
            </script>
            @endsection
</x-front.layout>
