<x-front.layout>
    @section('title')Agency @endsection



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

         {{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Visa Assign for Country</span>
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Agency</button> -->
                    <div class="flex gap-2">
                            {{-- Back Button --}}
                            <a href="{{ url()->previous() }}" class="text-sm bg-red-200 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-red-400 text-red-800 hover:text-white hover:bg-red-500 hover:border-red-600 transition duration-300">
                                ⬅ Back
                            </a>
                    </div>
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
              
             <form action="{{ route('assignupdatestore') }}" method="POST" enctype="multipart/form-data">
               @csrf
                     <div class="w-full grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-4  sm:grid-cols-2 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Title Images</label>
                             <div class="w-full relative">
                                 <input type="file" name="title_image" id="title_image"  placeholder="Agency name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                 
                             </div>
                         </div>

                       
                         <input type="hidden" name="selectcoutnry" value="{{$sectedvisa->id}}">
                      
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Visa Type</label>
                             <div class="w-full relative">
                             <select name="visa_id" id="datePicker"
                                        class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                        
                                        <option value="">---Select---</option>
                                        
                                        @forelse($visa as $single_visa)
                                            <option value="{{ $single_visa->id }}" {{ isset($sectedvisa) && $sectedvisa->visa_id == $single_visa->id ? 'selected' : '' }}>
                                                {{ $single_visa->name }}
                                            </option>
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


                

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Origin</label>
                             <div class="w-full relative">
                                 <select  name="origincoutnry" id="origincoutnry"
                                          class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                     <option value="">---Select---</option>
                                     @forelse($countries as $country)
                                            <option value="{{ $country->id }}" {{ isset($sectedvisa) && $sectedvisa->origin == $country->id ? 'selected' : '' }}>
                                                {{ $country->countryName }}
                                            </option>
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
                             <select name="destination" id="destination"
                                        class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                        <option value="">---Select---</option>
                                        @forelse($countries as $country)
                                            <option value="{{ $country->id }}" {{ isset($sectedvisa) && $sectedvisa->destination == $country->id ? 'selected' : '' }}>
                                                {{ $country->countryName }}
                                            </option>
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
                                        <input type="radio" name="required" value="0"
                                            {{ old('required', isset($sectedvisa) ? $sectedvisa->required : '') == 0 ? 'checked' : '' }}
                                            class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px] checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                        Required
                                    </label>

                                    <label class="flex items-center gap-2">
                                        <input type="radio" name="required" value="1"
                                            {{ old('required', isset($sectedvisa) ? $sectedvisa->required : '') == 1 ? 'checked' : '' }}
                                            class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px] checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                        Not Required
                                    </label>
                             </div>
                         </div>
                       


                      


                         {{--               === textarea input field ===--}}
                         <div class="w-full relative group flex flex-col xl:col-span-4  lg:col-span-3 md:col-span-4 sm:col-span-2 gap-1 ">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Description</label>
                             <div class="w-full relative">
                             <div id="editor"
                                            class="w-full pl-2 pr-8 py-1 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                                            style="height: 200px;">{!! old('description', isset($sectedvisa) ? $sectedvisa->description : '') !!}</div>

                                        <input type="hidden" name="description" id="description"
                                            value="{{ old('description', isset($sectedvisa) ? $sectedvisa->description : '') }}">

                                        @error('description')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                                </div>
                           </div>
                     </div>
<!-- add subtype  -->
                    <div id="subtypeContainer" class="px-4"   >

                            @if(isset($eid))
                            <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                            <tr>
                                <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Type of visa</th>
                                <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Validity</th>
                                <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Processing</th>
                                <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Embassy fee</th>
                                <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Service fee</th>
                                <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">GSTIN (18%)</th>
                                <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Total cost</th>
                                <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>
                         


                            </tr>



                            @forelse($sectedvisa->Subvisas as $subvisa)
                                <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$subvisa->name}}</td>
                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$subvisa->validity}}</td>
                                <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$subvisa->processing}}</td>
                                <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">£ {{$subvisa->price}}</td>
                                <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">£ {{$subvisa->commission}}</td>
                                    @php
                                            $price = $subvisa->price;
                                            $commission = $subvisa->commission;
                                            $gstPercent = 18;

                                            $subtotal = $price + $commission;
                                            $gstAmount = ($subtotal * $gstPercent) / 100;
                                            $total = $subtotal + $gstAmount;
                                        @endphp
                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                        {{ number_format($gstAmount, 2) }} 
                                        </td>

                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                        £ {{ number_format($total, 2) }}
                                        </td>
                                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                        {{-- Edit Icon --}}
                                        <div class="flex gap-2 items-center">
                                                <a href="{{ route('visaedit.subtype', ['id' => $subvisa->id]) }}" title="Remind for funds" onclick="return confirm('Are you sure you want to edit this item?');">
                                                    <div class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-200">
                                                        <i class="fa fa-pencil"></i>
                                                    </div>
                                                </a>


                                                <a href="{{ route('visasubtype.delete', ['id' => $subvisa->id]) }}" title="Remind for funds" onclick="return confirm('Are you sure you want to Delete this item?');">
                                                    <div class="bg-danger/10 text-danger h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white transition ease-in duration-200">
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
                            @endif


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
