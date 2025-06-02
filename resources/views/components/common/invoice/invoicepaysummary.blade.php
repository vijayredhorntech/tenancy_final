<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
 <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
     <span class="font-semibold text-ternary text-xl"> Flight Booking </span>
 </div>
  {{--        === heading section code ends here===--}}

  {{--        === this is code for table section ===--}}
 <div class="w-full overflow-x-auto p-4">
    


     <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
     <tr>
             <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>          
              <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice No.</td>
              <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Service</td>            
              <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">  Payable Amount</td>
             <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Paid</td>     
             <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Payment Type</td>  
             <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Transaction Number</td>           
             <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Pay Date</td>
             <!-- <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td> -->
         </tr>

         
         @forelse($booking->paymenthistory as $payment)
           

                     <tr>
                         <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>                         
                         <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">
                        {{$booking['invoice_number']}}  </td> 
                         <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$booking->service_name['name']}}</td>
                         <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">£ {{$booking['amount']}}</td>
                         <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">£ {{$payment['paying_amount']}}</td>

                             <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">
                             {{ $payment->payment_type ?? 'N/A' }}
                             </td>

                             

                             <td class="border-[1px] border-secondary/50 px-4 py-1 text-sm font-medium">
                             {{ $payment->transaction_number ?? 'N/A' }}
                                 @if($payment->receipt)
                                <br> <a href="{{ asset('storage/' . $payment->receipt) }}" target="_blank">
                                    View Attachment
                                 </a>  
                                 @endif
                              </td>

                             <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">
                             {{ $payment->payment_date ?? 'N/A' }}
                             </td>
                       
                     </tr>


                 @empty
                     <tr>
                         <td colspan="6" class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm text-center">No Record Found</td>
                     </tr>
                 @endforelse


     </table>
 </div>
  {{--        === table section code ends here===--}}

</div>