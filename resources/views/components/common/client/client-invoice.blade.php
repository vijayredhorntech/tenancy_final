
<table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
    <tr>
        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>          
        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice No.</td>
        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice Date</td>            

        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Service</td>   
                 

        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Total</td>            
        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Status</td>
        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
    </tr>



    @if($invoices->isNotEmpty())

    @foreach($invoices as $index => $invoice)
    
   


        <tr>
            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">
                {{ $index + 1 }}
            </td>    

            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">
                {{ $invoice->invoice_number ?? '—' }}
            </td>      
            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">
                {{ $invoice->date ? \Carbon\Carbon::parse($invoice->date)->format('d-m-Y') : '—' }}
            </td>

            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">
                {{ $invoice->service_name->name ?? '—' }}
            </td>     
            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">
                {{ $invoice->amount  ?? '—' }}
            </td>                      

            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">    
               
                        <span class="font-semibold text-green-600">Paid</span>
                     
            </td>

            <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">
                <div class="flex gap-3 items-center justify-center" onclick="showPopupFUnction($invoice->flight_booking_id)">
                    {{-- <a href="{{ route('documents.view', ['document' => $invoice->flight_booking_id]) }}"
                        class="text-blue-600 hover:text-blue-800"
                        title="View Document">
                         <i class="fas fa-eye"></i>
                     </a> --}}
                     <a href="{{ route('documents.downloade', ['document' => $invoice->flight_booking_id]) }}"
                        class="text-blue-600 hover:text-blue-800"
                        title="View Document">
                         <i class="fas fa-eye"></i>
                     </a>
        
                   

                        {{-- <a href="{{ route('documents.view', ['document' => $invoice->flight_booking_id]) }}"
                           class="text-purple-600 hover:text-purple-800"
                           title="Sign Document">
                            <i class="fas fa-pen-fancy"></i>
                        </a> --}}
              
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="border-[1px] border-secondary/50 px-4 py-2 text-center text-ternary/80">
            No Record Found
        </td>
    </tr>
@endif


</table>


