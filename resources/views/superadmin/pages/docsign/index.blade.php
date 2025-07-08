<x-front.layout>
    @section('title')Document Sign Managment @endsection


{{--        === model code ends ===--}}
    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
               
                <span class="font-semibold text-ternary text-xl">  <i class="fas fa-file-signature mr-2 text-sm"></i> Document Sign </span>
               <a href="{{route('add.signdocument')}}">
                  <button type="button" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Add Document</button>
               </a>

            </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 hidden">
               
             </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
        
             
               <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex justify-between gap-2 items-center">
                  
                </div>
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md"> Document Name </td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Date/Time</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Client Details </td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice </td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sign Status </td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action </td>
                    </tr>
           

               @forelse($documents as $document)
            
                         @php
                            $sign        = $document->sign;                     // may be null
                            $isSent      = ! is_null($sign);                    // process row exists
                            $isPending   =  $sign?->status === 'pending';
                            $isSigned    =  $sign?->status === 'signed';        // adjust if you use ‘completed’
                            $agency      = $document->agency;                   // may be null
                        @endphp    
                       <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$document['name']}}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">
                                {{ $sign ? $sign->created_at->format('d M Y') : "Not Send yet" }}
                            </td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="mb-2 leading-tight">
                                        <span class="font-semibold">{{ $document->agency->name }}</span><br>
                                        <span class="text-xs">{{ $document->agency->phone }}</span><br>
                                        <span class="text-xs">{{ $document->agency->email }}</span>
                                    </div>
                             </td>
                                
                             <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 text-sm">
                                 {{-- first row: clip + count --}}
                                    <div class="flex items-center gap-2 mb-1">
                                        <i class="fa fa-paperclip"></i>
                                        {{ count($document->document_file ?? []) }}
                                    </div>

                                       {{-- each stored path --}}
                                        @foreach ($document->document_file as $path)
                                            @php
                                                $url      = Storage::url($path);
                                                $ext      = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                                                $isImage  = in_array($ext, ['jpg','jpeg','png','gif','webp','bmp','svg']);
                                            @endphp

                                            @if ($isImage)
                                                {{-- image thumbnail (click to open full) --}}
                                                <a href="{{ $url }}" target="_blank" class="inline-block mb-1">
                                                    <img src="{{ $url }}"
                                                        alt="attachment {{ $loop->iteration }}"
                                                        class="h-12 w-12 object-cover rounded border" />
                                                </a>
                                            @else
                                                {{-- generic file link --}}
                                                <a href="{{ $url }}"
                                                target="_blank"
                                                class="flex items-center gap-1 text-blue-600 underline mb-1">
                                                    <i class="fa fa-file-alt"></i>
                                                    File {{ $loop->iteration }}
                                                </a>
                                            @endif
                                        @endforeach
                            </td>

                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-sm">
                                    @switch(true)
                                            @case($isSigned)
                                                <span class="font-semibold text-green-600">Signed</span>
                                                @break

                                            @case($isPending)
                                                <span class="font-semibold text-yellow-600">Pending</span>
                                                @break

                                            @default
                                                <span class="font-semibold text-red-600">Not sent yet</span>
                                        @endswitch
                            </td>

                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                 
                              <div class="flex gap-3 items-center justify-center">
                                        {{-- Edit Icon --}}
                                        <a href=""
                                        class="text-blue-600 hover:text-blue-800" title="Edit Document">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Email Icon --}}
                                        <a href="{{ route('senddocdocument.email', $document->id) }}"
                                            class="text-green-600 hover:text-green-800"
                                            title="Send Email">
                                                <i class="fas fa-envelope"></i>
                                            </a>

                                          
                                            @if ($sign && $sign->signing_token)
                                                <a href="{{ route('document.sign', $sign->signing_token) }}"
                                                class="text-purple-600 hover:text-purple-800"
                                                title="Sign Document">
                                                    <i class="fas fa-pen-fancy"></i>
                                                </a>
                                            @endif
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
            </div>
              
{{--        === table section code ends here===--}}
     
</x-front.layout>
