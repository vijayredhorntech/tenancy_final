<x-agency.layout>
@section('title') Visa Application @endsection



<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl"> Download Center  </span>
        
         </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}

<div class="w-full overflow-x-auto p-4">
  
        <div class="grid grid-cols-3 gap-4">
         
            @php
            $documents = json_decode($booking->downloadDocument->documents, true);
          
            @endphp
            @foreach($documents as $doc)
             
                <div class="flex flex-col gap-2">
                    <label for="documentfile }}" class="text-sm font-semibold text-ternary">
                        {{ $doc['name'] }}
                    </label>

                    <a href="{{ route('clientupload.documentdownloadjson', ['file' => urlencode($doc['file'])]) }}"
                        class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">
                            Download
                        </a>

                </div>
            @endforeach
        </div>

    </form>
</div>


</x-agency.layout>