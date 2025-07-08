
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


<body>
<div class="bg-white shadow-md rounded-lg p-6">
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
        <strong class="mt-2">Notes:</strong>
        <p>Reconfirmation of any onward / return journey is passengers’ responsibility.</p>
        <p>Valid travel documentation such as valid passport, visa, and health precautions are passengers’
            responsibility.</p>
        <p>Timings are subject to change, please reconfirming with your airline operator before you fly.</p>
        <p>Any reissue / revalidation / cancellation will incur a fee. Any passengers under 18 years on age travelling
            to South Africa will be denied boarding if not carrying their original birth certificate. Any passengers who
            hold an OCI who travel to INDIA without their original OCI card will be denied boarding.</p>


        <strong>Your Financial Protection</strong>
        <p>When you buy an ATOL protected fight or flight inclusive holiday from us you will receive an ATOL
            Certificate. This lists what is financially protected, where you can get information on what this means for
            you and who to contact is things go wrong.</p>


        <strong>Travelling against the FCO’s advice</strong>
        <p class="mt-2">Critically, you may invalidate your insurance cover, including healthcare protections, or be
            unable to obtain it, if you’ve not yet bought any.</p>

        <p class="mt-2">So, call your insurer/check the wording of your insurance policy if you’re planning to take this
            risk. If you get ill while you’re travelling, you may not be able to get the treatment you need – or
            treatment may end up being very delayed and incredibly costly.</p>
        <p>Expect disruption to your travel arrangements, both:</p>
        <ul class="list-disc pl-6 mt-4">
            <li>while you’re in-country (many countries are operating Covid-19 screening procedures as a condition of
                entry and, in some cases, quarantine measures preventing you from any contact with local resident at
                your destination)
            </li>
            <li>on your return, including the risk that you may not be able to get back home if borders close and/or
                that you may face quarantine and self-isolation obligations when you get back. This will mean being away
                from your workplace, school/place of study and ensuring you have no social interactions for that period
                of quarantine
            </li>
        </ul>

        <strong class="mt-2">Passenger Notice:</strong>
        <p>Carriage and other services provided by the carrier are subject to conditions of contract, which are hereby
            incorporated by reference. These conditions may be obtained from the issuing carrier. The itinerary/receipt
            constitutes the passenger ticket for the purposes of Article 3 of the Warsaw convention, except where the
            carrier delivers to the passenger another document complying with the requirements of Article 3. If the
            passenger's journey involves an ultimate destination or stop in a country other than the country of
            departure the Warsaw Convention may be applicable, and the convention governs, and in most cases limits, the
            liability of carriers for death or personal injury and in respect of loss of or damage to baggage. See also
            notices headed Advice to International Passengers on limitation of liability and notice of baggage liability
            limitations. Full conditions can be found at www.iata.org If you are travelling to USA, all qualified Visa
            Waiver Program travellers will be required to obtain electronic travel authorization prior to boarding an
            air or sea carrier to the United States.</p>
        <p>Electronic System for Travel Authorization (ESTA) to USA</p>
        <p>Travellers who do not receive travel authorization prior to their departure may be denied boarding,
            experience delays or be denied admission into the United States. Applications may be submitted at any time
            prior to travel, but no less than 72 hours prior to departure.</p>
        <p>Travel Authorization is obtained through an online registration system known as the Electronic System for
            <strong>Travel Authorization (ESTA).</strong></p>
        <p>If your registration is successful, it will be valid for multiple applications for two years or until the
            date on which your passport expires, whichever comes first.</p>
        <p>Submit your ESTA Application at <a
                href="https://cloud-travel.co.uk/software/public/invoice/view/www.iata.org" class="text-[#26ace2]">www.iata.org</a>
        </p>
        <strong class="mt-2">Note/Disclaimer: It is the sole responsibility of the passenger to ensure his/her
            eligibility to enter the destination country. Cloud Travel accepts no liability in this regard.</strong>
        <strong>In case of Visa, Flight suspensions, cancellation or not operating in that case we will apply for a full
            refund from airline and we will only Deduct our Service charge and all other ATOL/IATA protections, cash
            handling fee, administration charges will be applied</strong>
            @php
                    // null‑safe chain; returns null if any link is missing
                    $signature = $booking->visaInvoiceStatus?->docsign?->sign?->signature_data;
                @endphp

            @if($signature)
                    <div class="my-4">
                        <img src="{{ $signature }}" alt="Signature" style="height: 100px;">
                    </div>
                @endif

                <span class="mt-20 text-right">Yours sincerely</span>

        <div class="flex justify-center mt-4">

        </div>

    </div>


</div>

</body>


</html>
