


<!-- Do you have a child? -->
{{--<form class="ajax-form" method="post">
                    <div class="mb-4">
                        <label class="font-semibold text-sm text-ternary/90">Do you have a child?</label>
                        <div class="flex gap-4 mt-1">
                            <label>
                                <input type="radio" name="has_child" value="yes"
                                {{ $bookingData->clint->clientinfo->children ? 'checked' : '' }} > Yes
                            </label>
                            <label>
                                <input type="radio" name="has_child" value="no"
                                {{ !$bookingData->clint->clientinfo->children ? 'checked' : '' }}> No
                            </label>
                        </div>
                    </div>

               

  @php
  $childrenJson = $bookingData->clint->clientinfo->children ?? '[]';  // fallback to empty JSON if null
   $children = json_decode($childrenJson, true);

  $childCount = count($children);
  if($childCount > 0){
    $childsection = true;
  }else{
    $childsection = false; // Set the flag to false if there are no children
  }


  @endphp
  {{dd($bookingData->clint->clientinfo->children)}}    
                    <!-- Child Info Section -->
                    <div id="childInfoSection" class="@if( $childsection=true hidden remove }hidden mb-4 ">
                        <div id="childFieldsContainer" class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4">
                            @if($childsection)
                            @forelse($children as $child)
                            <div class="child-fields border p-4 mb-4 rounded-[3px] rounded-tr-[8px] border-secondary/40 bg-white shadow-sm relative bg-black/10 shadow-lg shadow-black/10">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div>
                                <label class="font-semibold text-sm text-ternary/90">Name</label>
                                <input type="text" name="child_name[]" value="{{$child->name}}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                            </div>

                            <div>
                                <label class="font-semibold text-sm text-ternary/90">Date of Birth</label>
                                <input type="date" name="child_dob[]" value="{{$child->dob}}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                            </div>

                            <div>
                                <label class="font-semibold text-sm text-ternary/90">Nationality</label>
                                <input type="text" name="child_nationality[]" value="{{$child->nationality}}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                            </div>

                            <div class="col-span-full">
                                <label class="font-semibold text-sm text-ternary/90">Address</label>
                                <input type="text" name="child_address[]" value="{{$child->address}}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                            </div>
                        </div>

                        <button type="button" class="removeChildBtn absolute top-2 right-2 text-red-500 hover:text-white text-xs border border-red-500 hover:bg-red-500 rounded px-2 py-[1px]">
                            Remove
                        </button>
                    </div>
                           @empty
                           not found
                            @else
                          
                           
                        </div>

                            <!-- Add More Button -->
                            <div class="w-full flex justify-start">
                                <button type="button" class="bg-primary/30 text-ternary font-semibold border-[2px] border-primary/90 px-4 py-1 rounded-[3px] rounded-tr-[8px] hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200" id="addMoreChild">
                                    Add More
                                </button>
                            </div>
                           
                               <input type="hidden" name="previewstep" value="4">                            

                                <input type="hidden" name="step" value="5">
                                  
                    </div>
                                <div class="w-full flex justify-end  pb-4 gap-2 xl:col-span-4 lg:col-span-3 md:col-span-2 col-span-1">
                                   
                                    <button type="submit" data-current=4 data-previewtab=3 class="backbutton text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                                                Back <i class="fa fa-arrow-right ml-1"></i>
                                         </button>
                                        <button type="submit" class="text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                            Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
                                        </button>                                    
                                  </div>
</form> --}}


<!-- Do you have a child? -->
<form class="ajax-form" method="post">
    <div class="mb-4">
        <label class="font-semibold text-sm text-ternary/90">Do you have a child?</label>
        <div class="flex gap-4 mt-1">
            <label>
                <input type="radio" name="has_child" value="yes"
                    {{ !empty($bookingData->clint->clientinfo->children) ? 'checked' : '' }}> Yes
            </label>
            <label>
                <input type="radio" name="has_child" value="no"
                    {{ empty($bookingData->clint->clientinfo->children) ? 'checked' : '' }}> No
            </label>
        </div>
    </div>

    @php
        $childrenJson = $bookingData->clint->clientinfo->children ?? '[]';
        $children = json_decode($childrenJson);
        $childsection = is_array($children) && count($children) > 0;
    @endphp

    <!-- Child Info Section -->
    <div id="childInfoSection" class="{{ !$childsection ? 'hidden' : '' }} mb-4">
        <div id="childFieldsContainer" class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4">
            @if($childsection)
                @forelse($children as $child)
                    <div class="child-fields border p-4 mb-4 rounded-[3px] rounded-tr-[8px] border-secondary/40 bg-white shadow-sm relative bg-black/10 shadow-lg shadow-black/10">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div>
                                <label class="font-semibold text-sm text-ternary/90">Name</label>
                                <input type="text" name="child_name[]" value="{{ $child->name }}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                            </div>

                            <div>
                                <label class="font-semibold text-sm text-ternary/90">Date of Birth</label>
                                <input type="date" name="child_dob[]" value="{{ $child->dob }}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                            </div>

                            <div>
                                <label class="font-semibold text-sm text-ternary/90">Nationality</label>
                                <input type="text" name="child_nationality[]" value="{{ $child->nationality }}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                            </div>

                            <div class="col-span-full">
                                <label class="font-semibold text-sm text-ternary/90">Address</label>
                                <input type="text" name="child_address[]" value="{{ $child->address }}" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                            </div>
                        </div>

                        <button type="button" class="removeChildBtn absolute top-2 right-2 text-red-500 hover:text-white text-xs border border-red-500 hover:bg-red-500 rounded px-2 py-[1px]">
                            Remove
                        </button>
                    </div>
                @empty
                    <p>No children data found.</p>
                @endforelse
            @endif
        </div>

        <!-- Add More Button -->
        <div class="w-full flex justify-start">
            <button type="button" class="bg-primary/30 text-ternary font-semibold border-[2px] border-primary/90 px-4 py-1 rounded-[3px] rounded-tr-[8px] hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200" id="addMoreChild">
                Add More
            </button>
        </div>

        <input type="hidden" name="previewstep" value="4">
        <input type="hidden" name="step" value="5">
    </div>

    <div class="w-full flex justify-end pb-4 gap-2 xl:col-span-4 lg:col-span-3 md:col-span-2 col-span-1">
        <button type="submit" data-current="4" data-previewtab="3" class="backbutton text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
            Back <i class="fa fa-arrow-right ml-1"></i>
        </button>
        <button type="submit" class="text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
            Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
        </button>
    </div>
</form>
