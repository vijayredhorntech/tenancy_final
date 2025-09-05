
<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Upload Document  </span>
            <!-- <a href="{{route('visa.create')}}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000"> Create New Visa </a>  -->
  
        
         </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}

<div class="w-full overflow-x-auto p-4">
    <form action="{{ route('client.document.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        {{-- <input type="hidden" name="type" value="agency"> --}}
        <input type="hidden" name="type" value="{{ $type }}">

        <div class="grid grid-cols-2 gap-4">
            @foreach($booking->clientapplciation as $doc)
                <div class="flex flex-col gap-2">
                    <label for="documentfile_{{ $doc->id }}" class="text-sm font-semibold text-ternary">
                        {{ $doc->document_name }}
                    </label>

                    @if($doc->document_status == 0)
                      <input 
                            type="file" 
                            name="documents[{{ $doc->id }}]" 
                            id="documentfile_{{ $doc->id }}" 
                            class="border border-secondary/40 rounded-lg px-3 py-2 text-sm text-ternary focus:outline-none focus:ring-2 focus:ring-primary/50 file:mr-4 file:py-1 file:px-3 file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition"
                        />
                        @error('document_file')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    @elseif($doc->document_status == 2)
                        <span class="text-red-500">Document Pending for Approval</span>
                    @elseif($doc->document_status == 1)
                        <span class="text-green-500">Document Done </span>
                    @endif

                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded">Upload Documents</button>
        </div>
    </form>
</div>
</div>