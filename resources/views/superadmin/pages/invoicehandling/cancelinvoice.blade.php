<x-front.layout>
    @section('title')Staff @endsection
    <div class="w-full grid xl:grid-cols-5 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 mb-4">

    </div>


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl"> Cancel Booking Invoice </span>
            </div>
            <div class="w-full overflow-x-auto p-4">
            <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}

        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Pay Bill ({{$invoice->invoice_number}}) </span>
            <span class="font-semibold text-ternary text-xl">Amount £ {{ isset($invoice->paymenthistory) && isset($invoice->paymenthistory[0]->balance) ? $invoice->paymenthistory[0]->balance : $invoice['amount'] }}

            </span>

          </div>
{{--        === heading section code ends here===--}}



       @if(isset($invoice) && isset($invoice->invoicestatus) && $invoice->invoicestatus == '1')
    
       @if($invoice->cancelinvoice->status==0)
   
       <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
            <form action="{{ route('superadmin.update.cancelinvoice') }}" method="POST" enctype="multipart/form-data"  onsubmit="return confirmCancel()">
                @csrf

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))

                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
              @endif
                 <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                     {{--               === text type input field ===--}}
                     <input type="hidden" name="id" value="{{ old('id', $invoice->id ?? '')  }}" id="id" placeholder="Agency name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                     

                     
                     <div class="w-full relative group flex flex-col gap-1">
                         <label for="name" class="font-semibold text-ternary/90 text-sm">Invoice Number </label>
                         <div class="w-full relative">
                         <input 
                                type="text" 
                                name="refundamount" 
                                value="{{$invoice->invoice_number}}" 
                               readonly=""
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"
                            >

                             <i class="fas fa-money-bill absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                         </div>
                         @error('add_ammount')
                         <div class="text-danger">{{ $message }}</div> @enderror
                     </div>


                     <div class="w-full relative group flex flex-col gap-1">
                         <label for="name" class="font-semibold text-ternary/90 text-sm">Invoice Amount </label>
                         <div class="w-full relative">
                         <input 
                                type="number" 
                                name="refundamount" 
                                value="{{$invoice['amount']}}" 
                               readonly=""
                         
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"
                            >

                             <i class="fas fa-money-bill absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                         </div>
                         @error('add_ammount')
                         <div class="text-danger">{{ $message }}</div> @enderror
                     </div>


                 <div class="w-full relative group flex flex-col gap-1">
                           <label for="name" class="font-semibold text-ternary/90 text-sm">Refund Amount</label>
                           <div class="w-full relative">
                         <input 
                                type="number" 
                                name="refundamount" 
                                value="{{ old('refundamount') }}" 
                                step="0.01" 
                                id="phone" 
                                placeholder="Enter refund amount ....." 
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"
                            >

                             <i class="fas fa-money-bill absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                         </div>
                         @error('add_ammount')
                         <div class="text-danger">{{ $message }}</div> @enderror
             </div>  
 

                  <div class="w-full relative group flex flex-col gap-1">
                         <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Invoice Status </label>
                         <div class="w-full relative">
                             <select  name="invoicestatus" id="invoicestatus"
                                      class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">

                                 <option value="1">Canceled</option>
                                
                             </select>
                             <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                         </div>
            </div> 



                     <div class="w-full relative group flex flex-col gap-1 paymentdata ">
                         <label for="name" class="font-semibold text-ternary/90 text-sm">Reason</label>
                         <div class="w-full relative">
                             <textarea   name="reason" id="reason" rows="2" placeholder="Description....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"></textarea>
                             <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                         </div>
                     </div>
                 </div>

                 <div class="w-full flex justify-end px-4 pb-4 gap-2">
                       <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000"> Cancel Invoice </button>
                 </div>
            </form>
         </div>


          </div>
       @else 
       <div class="bg-success/10 px-4 py-2 border-b-[2px] border-b-success/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">  Invoice is Canceled</span>
       
            </span>

          </div>
        @endif
     

       @endif


    </div>

   <script>
    function confirmCancel() {
        return confirm("Are you sure you want to cancel the invoice?");
    }


    jQuery(document).ready(function () {

        jQuery("#modepayment").on("change", function () {
            var value = jQuery(this).val();

            // Hide payment data if creditnote selected, otherwise show
            if (value === 'creditnote') {
                jQuery(".paymentdata").hide();
            } else {
                jQuery(".paymentdata").show();
            }

            // Show bank-details only if banktransfer selected
            if (value === 'banktransfer') {
                jQuery("#bank-details").removeClass('hidden');
            } else {
                jQuery("#bank-details").addClass('hidden');
            }
        });

    });
</script>
 
 
            
       
            </div>
            

    </div>
</x-front.layout>
