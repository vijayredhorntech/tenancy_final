<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">


<div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
    <span class="font-semibold text-ternary text-xl">Visa Type</span>
    <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Agency</button> -->
</div>

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



        <!-- Add More Button -->

        <!-- Submit & Cancel Buttons -->
        <div class="w-full flex justify-end px-4 pb-4 gap-2">

        <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">
        {{ isset($eid) ? 'Edit Visa' : 'Create Visa' }}

        </button>
        </div>
    </form>

 </div>


</div>