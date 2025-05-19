<x-front.layout>
    @section('title') Agency @endsection

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        {{-- === Heading Section === --}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Update Sub Type </span>
        </div>

        {{-- === Error Display === --}}
        @if ($errors->any())
            <div class="text-red-500 mb-4 px-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- === Form Section === --}}
        <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20">

            <form action="{{ route('updatesubtype') }}" method="POST" enctype="multipart/form-data">
                @csrf
               <input type="hidden" value="{{$visasubType->id}}" name="visasubtypeid"> 
                <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 px-4 py-6">

                    {{-- Subtype Name --}}
                    <div class="w-full flex flex-col gap-1">
                        <label class="font-semibold text-ternary/90 text-sm">Subtype Name</label>
                        <input type="text" name="subtypename" value="{{$visasubType->name}}" placeholder="Subtype name..."
                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                        @error('subtypename')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Validity --}}
                    <div class="w-full flex flex-col gap-1">
                        <label class="font-semibold text-ternary/90 text-sm">Validity</label>
                        <input type="text" name="validity" value="{{$visasubType->validity}}" placeholder="Validity..."
                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                        @error('validity')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Processing --}}
                    <div class="w-full flex flex-col gap-1">
                        <label class="font-semibold text-ternary/90 text-sm">Processing</label>
                        <input type="text" name="processing" value="{{$visasubType->processing}}" placeholder="Processing..."
                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                        @error('processing')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Subtype Price --}}
                    <div class="w-full flex flex-col gap-1">
                        <label class="font-semibold text-ternary/90 text-sm">Subtype Price</label>
                        <input type="number" name="subtypeprice" value="{{$visasubType->price}}" placeholder="Subtype price..."
                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                        @error('subtypeprice')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Commission --}}
                    <div class="w-full flex flex-col gap-1">
                        <label class="font-semibold text-ternary/90 text-sm">Commission</label>
                        <input type="number" name="commission" value="{{$visasubType->commission}}" placeholder="Commission..."
                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                        @error('commission')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- GSTIN --}}
                    <div class="w-full flex flex-col gap-1">
                        <label class="font-semibold text-ternary/90 text-sm">GSTIN (18%)</label>
                        <input type="number" name="gstin" value="{{$visasubType->gstin}}" placeholder="GSTIN..."
                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                        @error('gstin')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- + Add More Button --}}
                @if(isset($eid))
                    <div class="px-4 mt-4">
                        <button type="button" id="showButton" class="px-4 py-2 bg-blue-600 text-white rounded shadow">+ Add More</button>
                    </div>
                @endif

                <!-- <div class="px-4 mt-4">
                    <button type="button" id="addMore" class="clickedit px-4 py-2 bg-blue-600 text-white rounded shadow" style="{{ isset($eid) ? 'display: none;' : '' }}">+ Add More</button>
                </div> -->

                {{-- Submit Button --}}
                <div class="w-full flex justify-end px-4 pb-4 gap-2">
                    <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-200">Update Sub type </button>
                </div>

            </form>

        </div>
        {{-- === End Form Section === --}}

    </div>
</x-front.layout>
