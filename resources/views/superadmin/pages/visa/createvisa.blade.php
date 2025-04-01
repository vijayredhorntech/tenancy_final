<x-front.layout>
    @section('title')Agency @endsection

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Assign Country</span>
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Agency</button> -->
            </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
             <form action="{{ isset($eid) ? route('visa.editstore') : route('visa.store') }}" method="POST" enctype="multipart/form-data">


                    @csrf
                    @if(isset($eid))
                    <input type="hidden" name="vid" value="{{$eid}}">
                    @endif
                    <div class="w-full grid  gap-2 px-4 py-6">
                        <!-- Visa Name -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Visa Name</label>
                            <div class="w-full relative">
                                <input type="text" name="name" id="name" value="{{ old('name', isset($visa) ? $visa->name : '') }}"  placeholder="Visa name..."
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px]
                                    border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description (Quill Editor) -->
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="description" class="font-semibold text-ternary/90 text-sm">Description</label>
                            <div class="w-full relative">
                                <div id="editor" class="w-full pl-2 pr-8 py-1 border border-gray-300 rounded focus:outline-none focus:border-blue-500" style="height: 200px;">{!! old('description',isset($visa) ? $visa->description : '') !!}</div>

                                <input type="hidden" name="description" id="description" value="{{ old('description',isset($visa) ? $visa->description : '') }}">
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Subtype Fields Container -->



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
                    </tr>



                    @forelse($visa->VisavisaSubtype as $subvisa)
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$subvisa->name}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">up to 10 years</td>
                           <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">15 business days</td>
                           <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$subvisa->price}}</td>
                           <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$subvisa->commission}}</td>
                           <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">0</td>
                           <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$subvisa->price+$subvisa->commission}}</td>

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


                    <!-- Add More Button -->

                    <!-- Submit & Cancel Buttons -->
                    <div class="w-full flex justify-end px-4 pb-4 gap-2">

                    <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">
                    {{ isset($eid) ? 'Edit Visa' : 'Create Visa' }}

                    </button>
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
