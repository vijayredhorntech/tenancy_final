
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
/* Hide everything by default in print */
@media print {
    body * {
        visibility: hidden;        /* still occupies space but invisible */
    }

    /* Make the invoice and its children visible */
    #ViewApplicationDiv,
    #ViewApplicationDiv * {
        visibility: visible;
    }

    /* Keep the invoice at the top‑left and use full width */
    #ViewApplicationDiv {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    
    /* Optionally hide buttons or other screen‑only elements */
    .no-print {
        display: none !important;
    }
}
</style>

</head>


<body class="bg-gray-200 flex justify-center">
<div class="bg-white shadow-md rounded-lg p-6 max-w-7xl">
    <div class="flex items-center  flex-col justify-between">
        <div class="flex items-center border-b-[2px] border-gray-700 w-full">
        @if(isset($booking->agency->profile_picture))
        <img src="{{ asset('images/agencies/logo/' . $booking->agency->profile_picture) }}" alt="{{$booking->agency->name}}" class="h-16 w-auto" class="h-24 mr-4" />
        @else
        <img src="{{asset('assets/images/logo.png')}}" class="h-16 w-auto" alt="">
        @endif
      
            <!-- <img src="https://cloud-travel.co.uk/software/public/images/logo.png" alt="" class="h-24 mr-4"/> -->
        </div>
    </div>
    @php
    use Carbon\Carbon;       // Carbon alias
    use Illuminate\Support\Str;

    /* 1. Safely grab the Invoice model (may be null) */
    $invoice = $booking->visaInvoiceStatus?->invoice;

    /* 2. Split “TO” address if it exists, otherwise empty array */
    $toParts = $invoice && $invoice->address
        ? array_filter(array_map('trim', explode(',', $invoice->address)))
        : [];

    /* 3. Split “ISSUED BY” address if it exists, otherwise empty array */
    $issue = $booking->agency && $booking->agency->address
        ? array_filter(array_map('trim', explode(',', $booking->agency->address)))
        : [];

    /* 4. Human‑readable date or ‘N/A’ */
    $date = $invoice && $invoice->invoice_date
        ? Carbon::parse($invoice->invoice_date)->format('d F Y')
        : 'N/A';

    /* 5. Filter term‑conditions collection if present */
    $termtype = $termconditon
        ? $termconditon->where('type', 'VISA APPLICATION')
        : collect();   // empty collection if $termconditon is null

@endphp

    <div class="grid grid-cols-3 gap-2 mt-4">

        <div class="w-full ">
            &nbsp
        </div>
        <div class="w-full flex justify-center">
            <h1 class="text-2xl font-bold">INVOICE</h1>
        </div>
        <div class=" w-full text-right flex flex-col">
            <div class="flex justify-end items-center">
                <h1 class="font-bold text-sm ">Invoice Date:</h1>
                <span class="font-normal text-sm ml-2">{{$date}}</span>
            </div>
            <div class="flex justify-end items-center">
                <h1 class="font-bold text-sm ">Invoice No:</h1>
                <!-- CLDI0006044 -->
                <span class="font-normal text-sm ml-2">{{$booking->visaInvoiceStatus->invoice_number}}</span>
            </div>
            <div class="flex justify-end items-center">
                <h1 class="font-bold text-sm ">Client ID:</h1>
                <!-- CLDI0006044 -->
                <span class="font-normal text-sm ml-2">{{$invoice->billing_id ??''}}</span>
            </div>


        </div>
    </div>
    <div class="mt-4 grid grid-cols-2 ">
        <div class="w-full ">
            <h2 class="text-lg font-bold text-[#26ace2]">TO</h2>
            <p class="text-sm">
            {{ !empty($invoice->different_name) ? $invoice->different_name : (!empty($invoice->receiver_name) ? $invoice->receiver_name : '') }}

            </p>
            @foreach($toParts as $line)
                <p class="text-sm">{{ strtoupper($line) }}</p>
            @endforeach

            <p class="text-sm"><strong>TEL:</strong> {{ $invoice->phone ?? 'N/A' }}</p>
        
        </div>

        <div class="w-full text-right">
            <h2 class="text-lg font-bold text-[#26ace2]">ISSUED BY</h2>
                    
            @foreach($issue as $line)
                <p class="text-sm">{{ strtoupper($line) }}</p>
            @endforeach
            <p class="text-sm"><strong>TEL:</strong> {{$booking->agency->phone}}</p>
            <p class="text-sm"><strong>E-MAIL:</strong>  {{$booking->agency->email}}</p>
        </div>
    </div>
    <div class="mt-4 w-full">
        <h2 class="text-md font-bold  bg-[#26ace2] p-3 w-max text-white">OTHER FACILITIES</h2>
        <h3 class="text-md font-bold text-black mt-6">1. Passenger Details</h3>
        <div class="w-full overflow-hidden mt-2">
            <table class="w-full ">
                <tr class="bg-[#aed6f1] text-black  font-bold text-sm">
                    <td class="p-1 border-r-[1px] border-gray-100">S#</td>
                    <td class="p-1 border-r-[1px] border-gray-100">OTHER FACILITIES REMARK</td>
                    <td class="p-1 border-r-[1px] border-gray-100">AMOUNT</td>
                    

                </tr>
                <tr class="text-black text-sm border-b-[1px] border-blue-100">
                    <td class="p-1">1</td>
                    <td class="p-1">{{$booking->visa->name}}</td>
                    <td class="p-1">{{$invoice->amount??''}}</td>

                </tr>
            </table>
            <p style="float:right"> {{$invoice->amoun??''}}</p>

            
        </div>
        <table class="min-w-[500px] max-w-xs w-auto">
                <tr class="bg-[#aed6f1] text-black  font-bold text-sm">
                    <td class="p-1 border-r-[1px] border-gray-100">PAYMENT MODE</td>
                    <td class="p-1 border-r-[1px] border-gray-100">AMOUNT</td>
                    <td class="p-1 border-r-[1px] border-gray-100">Date</td>
                    

                </tr>
                <tr class="text-black text-sm border-b-[1px] border-blue-100">
                    <td class="p-1">{{strtoupper($invoice->payment_type??'')}}</td>
                    <td class="p-1">{{$invoice->amount??''}}</td>
                    <td class="p-1">{{$date}}</td>

                </tr>
            </table>
</div>


    <div class="flex flex-col mt-4">
        <span>Terms and Conditions</span>
        <strong>Notes:</strong>
        <ul class="list-disc pl-6 mt-4">
            @foreach ($termtype as $type)                 {{-- each TermType --}}
                @foreach ($type->terms as $term)      {{-- its related TermsCondition rows --}}
                    <li>
                        <strong>{{ $term->heading }}</strong>
                    </li>
                @endforeach
            @endforeach
        </ul>
        
            @php
                    // null‑safe chain; returns null if any link is missing
                    $signature = $booking->visaInvoiceStatus?->docsign?->sign?->signature_data;
                @endphp

                <div class="flex flex-col items-end">
                    <div class="flex justify-end">
                        @if($signature)
                       
                        <img src="{{ $signature }}" alt="Signature" style="height: 100px; width:200px">
                           
                        @endif
                     </div>
                     <div>
                        <span class="mt-20 text-right">Yours sincerely</span>
                   </div> 
             </div>

                <section class="footer">
                    <div class="row" style="margin: 0px; padding: 0px; box-sizing: border-box; padding-left: 2%; padding-right: 2%; display: flex; justify-content: space-between;">
                        <div class="col-md-6 col-sm-6 col-6 left-footer" style="margin: 0px; width: 50%; padding: 0px; box-sizing: border-box; display: flex; padding-left: 2%; align-items: center; height: 7vh; border-top: solid 1px rgb(45, 158, 195);">
                            <img src="bottom.png" style="margin: 0px; padding: 0px; box-sizing: border-box; height: 5vh; width: auto;" alt="">
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 right-footer" style="margin: 0px; width: 50%; padding: 0px; box-sizing: border-box; display: flex; padding-right: 2%; justify-content: end; align-items: center; height: 7vh; border-top: solid 1px rgb(45, 158, 195);">
                            <img src="https://seeklogo.com/images/I/information-commissioners-office-logo-1743AEAE1C-seeklogo.com.png" style="margin: 0px; padding: 0px; box-sizing: border-box; height: 5vh; width: auto;" alt="">
                        </div>
                    </div>
               </section>   


    </div>


</div>

</body>


</html>
