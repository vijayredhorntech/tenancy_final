
<table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
    <tr>
        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>          
        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice No.</td>
        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Document Name</td>            
        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Status</td>
        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
    </tr>

    @if($document)
    
    @php
                            $sign        = $document->sign;                     // may be null
                            $isSent      = ! is_null($sign);                    // process row exists
                            $isPending   =  $sign?->status === 'pending';
                            $isSigned    =  $sign?->status === 'signed';        // adjust if you use ‘completed’
                                      // may be null
                        @endphp  
                        
        <tr>
            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">1</td>    
            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $booking->application_number ?? '—' }}</td>      
            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $document->name ?? '—' }}</td>                         
            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">    
                @switch(true)
                                            @case($isSigned)
                                                <span class="font-semibold text-green-600">Signed</span>
                                                @break

                                            @case($isPending)
                                                <span class="font-semibold text-yellow-600">Pending</span>
                                                @break

                                            @default
                                                <span class="font-semibold text-red-600">Not sent yet</span>
                                        @endswitch</td>
            
            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">
                <div class="flex gap-3 items-center justify-center">
                    {{-- View --}}

                    @if ($sign && $sign->signing_token && $isSigned)
                    <a href="{{ route('document.sign', $sign->signing_token) }}"
                       class="text-blue-600 hover:text-blue-800"
                       title="View Document">
                        <i class="fas fa-eye"></i>
                    </a>
                    @else
                    <a href="{{ route('documents.view', ['document' => $booking->visaInvoiceStatus->docsign->related_id]) }}"
                       class="text-blue-600 hover:text-blue-800"
                       title="View Document">
                        <i class="fas fa-eye"></i>
                    </a>
                    @endif

                            {{-- Email Icon --}}
                       <a href="{{ route('senddocdocument.email', $document->id) }}"
                           class="text-green-600 hover:text-green-800"
                                title="Send Email">
                                <i class="fas fa-envelope"></i>
                        </a>

                                          
                        @if ($sign && $sign->signing_token && $isPending)
                            <a href="{{ route('document.sign', $sign->signing_token) }}"
                             class="text-purple-600 hover:text-purple-800"
                            title="Sign Document">
                             <i class="fas fa-pen-fancy"></i>
                            </a>
                         @else
                            <a href="{{ route('downloade.signdocument', ['document' => $booking->visaInvoiceStatus->docsign->related_id]) }}"
                                class="text-purple-600 hover:text-purple-800"
                                title="Sign Document">
                                <i class="fas fa-download"></i>
                            </a>   
                        @endif
                </div>
            </td>
        </tr>
    @else
        <tr>
            <td colspan="5" class="border-[1px] border-secondary/50 px-4 py-2 text-center text-ternary/80">
                No Record Found
            </td>
        </tr>
    @endif
</table>
