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
        /* Print-specific styles */
        @media print {
            /* Hide navbar and other non-invoice elements */
            nav, .navbar, header, .header, .no-print, .debugbar, .phpdebugbar {
                display: none !important;
                visibility: hidden !important;
            }
            
            /* Hide everything except the invoice content */
            body * {
                visibility: hidden;
            }
            
            /* Show only the invoice container and its contents */
            #ViewApplicationDiv,
            #ViewApplicationDiv * {
                visibility: visible !important;
            }
            
            /* Position the invoice properly */
            #ViewApplicationDiv {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0 !important;
                padding: 0 !important;
                font-size: 12px !important;
                line-height: 1.2 !important;
            }
            
            /* Remove any shadows and background colors for printing */
            .bg-white, .shadow-md, .rounded-lg {
                box-shadow: none !important;
                border-radius: 0 !important;
                background: white !important;
            }
            
            /* Ensure text is black for better printing */
            body, .text-black, .text-gray-700, .text-sm {
                color: black !important;
            }
            
            /* Optimize spacing for print - more aggressive */
            .p-4, .p-6 { padding: 4px !important; }
            .py-4, .py-6 { padding-top: 4px !important; padding-bottom: 4px !important; }
            .px-4, .px-6 { padding-left: 4px !important; padding-right: 4px !important; }
            .mt-4, .mt-6 { margin-top: 4px !important; }
            .mb-4, .mb-6 { margin-bottom: 4px !important; }
            .space-y-4 > * + *, .space-y-6 > * + * { margin-top: 4px !important; }
            
            /* Reduce all margins and padding */
            * { margin: 2px !important; padding: 2px !important; }
            .p-0 { padding: 0 !important; }
            .m-0 { margin: 0 !important; }
            
            /* Ensure terms and conditions are visible */
            .flex.flex-col.mt-4,
            ul.list-disc,
            li,
            section.footer,
            span,
            p,
            div {
                visibility: visible !important;
                display: block !important;
                page-break-inside: avoid !important;
            }
            
            /* Force page break avoidance for critical sections */
            .invoice-content {
                page-break-inside: avoid !important;
            }
            
            /* Reduce font sizes for better fit - more aggressive */
            .text-lg { font-size: 11px !important; }
            .text-xl { font-size: 12px !important; }
            .text-2xl { font-size: 13px !important; }
            .text-sm { font-size: 8px !important; }
            .text-xs { font-size: 7px !important; }
            .text-base { font-size: 9px !important; }
            
            /* Force smaller fonts for all text */
            body, p, span, div, td, th { font-size: 8px !important; line-height: 1.1 !important; }
            
            /* Ensure all content is visible and fits on one page */
            * {
                max-height: none !important;
                overflow: visible !important;
            }
            
            /* Force terms and conditions to be visible */
            .terms-conditions,
            .footer-content,
            .print-visible {
                visibility: visible !important;
                display: block !important;
                opacity: 1 !important;
            }
            
            /* Compress the entire invoice to fit on one page */
            .invoice-content {
                transform: scale(0.7) !important;
                transform-origin: top left !important;
                width: 143% !important;
                height: auto !important;
                max-height: 100vh !important;
            }
            
            /* Force single page layout */
            @page {
                size: A4;
                margin: 0.5in;
            }
            
            /* Ensure everything fits on one page */
            body {
                height: 100vh !important;
                overflow: hidden !important;
            }
            
            /* Remove excessive whitespace */
            .space-y-2 > * + * { margin-top: 1px !important; }
            .space-y-3 > * + * { margin-top: 2px !important; }
            .space-y-4 > * + * { margin-top: 2px !important; }
            .space-y-6 > * + * { margin-top: 3px !important; }
            
            /* Improve table appearance for print - more compact */
            table {
                border-collapse: collapse;
                width: 100%;
                font-size: 7px !important;
                margin: 0 !important;
            }
            
            td, th {
                border: 1px solid #ddd;
                padding: 1px 2px !important;
                font-size: 7px !important;
                line-height: 1.1 !important;
            }
            
            /* Make tables more compact */
            .table-auto { table-layout: fixed !important; }
            .w-full { width: 100% !important; }
            
            /* Ensure background colors print (with increased contrast) */
            .bg-\\[\\#aed6f1\\], .bg-\\[\\#26ace2\\] {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
                background-color: #d1e8f7 !important;
            }
            
            .bg-\\[\\#26ace2\\] {
                background-color: #26ace2 !important;
                color: white !important;
            }
            
            /* Reduce padding and margins for better fit */
            .p-6 {
                padding: 0.5rem !important;
            }
            
            .mt-4 {
                margin-top: 0.25rem !important;
            }
            
            .mb-4 {
                margin-bottom: 0.25rem !important;
            }
            
            /* Ensure terms and conditions are fully visible */
            .flex.flex-col.mt-4 {
                page-break-inside: avoid;
                break-inside: avoid;
                margin-top: 0.5rem !important;
                visibility: visible !important;
                display: block !important;
            }
            
            ul.list-disc {
                page-break-inside: avoid;
                break-inside: avoid;
                visibility: visible !important;
                display: block !important;
            }
            
            .flex.flex-col.mt-4 li {
                page-break-inside: avoid;
                break-inside: avoid;
                visibility: visible !important;
                display: list-item !important;
            }
            
            /* Ensure all text elements are visible */
            p, span, div, section, footer {
                visibility: visible !important;
                display: block !important;
            }
            
            /* Reduce font sizes for better fit */
            .text-sm {
                font-size: 0.75rem !important;
            }
            
            .text-xs {
                font-size: 0.65rem !important;
            }
            
            /* Ensure footer is visible and properly positioned */
            section.footer {
                page-break-inside: avoid;
                break-inside: avoid;
                visibility: visible !important;
                display: block !important;
            }
        }

        /* Screen-only styles */
        @media screen {
            .bg-white {
                background-color: white;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                border-radius: 0.5rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
<div class="bg-white shadow-md rounded-lg p-6 invoice-content" id="ViewApplicationDiv">
    <div class="flex items-center flex-col justify-between">
        <div class="flex items-center border-b-[2px] border-gray-700 w-full">
            @if(isset($booking->agency->profile_picture))
            <img src="{{ asset('images/agencies/logo/' . $booking->agency->profile_picture) }}" alt="{{$booking->agency->name}}" class="h-16 w-auto mr-4" />
            @else
            <img src="{{asset('assets/images/logo.png')}}" class="h-16 w-auto" alt="">
            @endif
        </div>
    </div>
    
    @php
    use Carbon\Carbon;
    use Illuminate\Support\Str;

    $invoice = $booking->deduction; // Get the deduction from visa booking
    $invoiceData = $invoice->invoice ?? null; // Get updated invoice data

    // Use updated invoice data if available, otherwise fall back to original data
    $clientName = $invoiceData?->receiver_name ?? ($booking->clint->client_name ?? '');
    $clientPhone = $invoiceData?->visa_applicant ?? ($booking->clint->phone_number ?? 'N/A');
    $clientEmail = $booking->clint->email ?? 'N/A';
    $clientAddress = $invoiceData?->address ?? ($booking->clint->permanent_address ?? '');
    
    // Get passport and visa details
    $passportOrigin = $booking->origin->countryName ?? 'N/A';
    $passportNumber = $booking->clint->passport_number ?? 'N/A';
    $passportDob = $booking->clint->date_of_birth ?? 'N/A';
    $visaCountry = $booking->destination->countryName ?? 'N/A';
    $visaType = $booking->visasubtype->name ?? 'N/A';
    
    $visaFee = is_numeric($invoiceData?->visa_fee ?? $booking->visa->price ?? 'N/A') ? (float)($invoiceData?->visa_fee ?? $booking->visa->price ?? 0) : 0.00;
    $paymentMode = $invoiceData?->payment_type ?? 'CASH';
    $currency = '£'; // Default currency

    $toParts = $clientAddress
        ? array_filter(array_map('trim', explode(',', $clientAddress)))
        : [];

    $issue = $booking->agency && $booking->agency->address
        ? array_filter(array_map('trim', explode(',', $booking->agency->address)))
        : [];

    $date = $invoice && $invoice->date
        ? Carbon::parse($invoice->date)->format('d F Y')
        : 'N/A';

    $termtype = $termconditon
        ? $termconditon->where('type', 'VISA APPLICATION')
        : collect();
    @endphp

    <div class="grid grid-cols-3 gap-2 mt-4">
        <div class="w-full">
            &nbsp;
        </div>
        <div class="w-full flex justify-center">
            <h1 class="text-2xl font-bold">INVOICE</h1>
        </div>
        <div class="w-full text-right flex flex-col">
            <div class="flex justify-end items-center">
                <h1 class="font-bold text-sm">Invoice Date:</h1>
                <span class="font-normal text-sm ml-2">{{$booking->created_at->format('d F Y')}}</span>
            </div>

          
            <div class="flex justify-end items-center">
                <h1 class="font-bold text-sm">Invoice No:</h1>
                <span class="font-normal text-sm ml-2">{{$booking->visaInvoiceStatus->invoice_number}}</span>
            </div>
            <div class="flex justify-end items-center">
                <h1 class="font-bold text-sm">Client ID:</h1>
                <span class="font-normal text-sm ml-2">{{$invoice->billing_id ?? ''}}</span>
            </div>
        </div>
    </div>
    
    <div class="mt-4 grid grid-cols-2">
        <div class="w-full">
            <h2 class="text-lg font-bold text-[#26ace2]">TO</h2>
            <p class="text-sm">
                {{ strtoupper($clientName) }}
            </p>
            @foreach($toParts as $line)
                <p class="text-sm">{{ strtoupper($line) }}</p>
            @endforeach
            <p class="text-sm"><strong>TEL:</strong> {{ $clientPhone }}</p>
            <p class="text-sm"><strong>Email:</strong> {{ $clientEmail }}</p>
        </div>

        <div class="w-full text-right">
            <h2 class="text-lg font-bold text-[#26ace2]">ISSUED BY</h2>
            @foreach($issue as $line)
                <p class="text-sm">{{ strtoupper($line) }}</p>
            @endforeach
            <p class="text-sm"><strong>TEL:</strong> {{$booking->agency->phone}}</p>
            <p class="text-sm"><strong>E-MAIL:</strong> {{$booking->agency->email}}</p>
        </div>
    </div>
    
    <div class="mt-4 w-full">
        <h2 class="text-md font-bold bg-[#26ace2] p-3 w-max text-white">VISA SERVICES</h2>
        
        <div class="w-full overflow-hidden mt-2">
            <table class="w-full">
                <tr class="bg-[#aed6f1] text-black font-bold text-sm">
                    <td class="p-1 border-r-[1px] border-gray-100">SNO.</td>
                    <td class="p-1 border-r-[1px] border-gray-100">APPLICANT NAME</td>
                    <td class="p-1 border-r-[1px] border-gray-100">PASSPORT ORIGIN</td>
                    <td class="p-1 border-r-[1px] border-gray-100">VISA COUNTRY</td> 
                    <td class="p-1 border-r-[1px] border-gray-100">VISA TYPE</td>
                    <td class="p-1 border-r-[1px] border-gray-100">VISA FEES</td>
                    <td class="p-1 border-r-[1px] border-gray-100">SERVICE CHARGE</td>
                    <td class="p-1 border-r-[1px] border-gray-100">AMOUNT</td>
                </tr>
                <tr class="text-black text-sm border-b-[1px] border-blue-100">
                    <td class="p-1">1.</td>
                    <td class="p-1">{{ strtoupper($clientName) }}</td>
                    <td class="p-1">{{ strtoupper($passportOrigin) }}</td>
                    <td class="p-1">{{ strtoupper($visaCountry) }}</td>
                    <td class="p-1">{{ strtoupper($visaType) }}</td>
                    <td class="p-1">{{ $currency }}{{ number_format($visaFee, 2) }}</td>
                    <td class="p-1">{{ $currency }}{{ number_format(is_numeric($invoiceData?->service_charge ?? 0) ? (float)($invoiceData?->service_charge ?? 0) : 0, 2) }}</td>
                    <td class="p-1">{{ $currency }}{{ number_format(is_numeric($invoiceData?->amount ?? $booking->total_amount ?? 0) ? (float)($invoiceData?->amount ?? $booking->total_amount ?? 0) : 0, 2) }}</td>
                </tr>
            </table>
        </div>
        
        <div class="w-full flex justify-end mt-2">
            <span class="text-sm font-bold">Total: <span class="text-blue-600">{{ $currency }}{{ number_format(is_numeric($invoiceData?->amount ?? $booking->total_amount ?? 0) ? (float)($invoiceData?->amount ?? $booking->total_amount ?? 0) : 0, 2) }}</span></span>
        </div>
        
        

        <div class="w-auto max-w-xs mt-2">
            <table class="w-full">
                <tr class="bg-[#aed6f1] text-black font-bold text-xs">
                    <td class="p-1 border-r-[1px] border-gray-100">PAYMENT MODE</td>
                    <td class="p-1 border-r-[1px] border-gray-100">AMOUNT</td>
                    <td class="p-1 border-r-[1px] border-gray-100">DATE</td>
                </tr>
                <tr class="text-black text-xs border-b-[1px] border-blue-100">
                    <td class="p-1">{{strtoupper($invoiceData?->payment_type ?? 'Cash')}}</td>
                    <td class="p-1">{{ $currency }}{{ number_format(is_numeric($invoiceData?->amount ?? $booking->total_amount ?? 0) ? (float)($invoiceData?->amount ?? $booking->total_amount ?? 0) : 0, 2) }}</td>
                    <td class="p-1">{{$booking->created_at->format('Y-m-d')}}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="flex flex-col mt-4">
        <span>Terms and Conditions</span>
        <ul class="list-disc pl-6 mt-4">
            @foreach ($termtype as $type)
                @foreach ($type->terms as $term)
                    @if($term->display_invoice==1)
                        <li>
                            <strong>{{ $term->heading }}</strong><br>
                            {{ $term->description }}
                        </li>
                    @endif
                @endforeach
            @endforeach
        </ul>

        <div class="flex flex-col items-end">
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

        <div class="flex justify-center mt-4 no-print">
            <button onclick="printInvoice()" class="bg-[#28a745] text-white text-sm px-2 py-1 rounded-sm">
                Print Invoice
            </button>
        </div>
    </div>
</div>

<script>
function printInvoice() {
    // Hide debug bar and other non-printable elements
    const debugBar = document.querySelector('.phpdebugbar, .debugbar');
    if (debugBar) {
        debugBar.style.display = 'none';
    }
    
    // Hide the print button before printing
    const printButton = document.querySelector('.no-print');
    if (printButton) {
        printButton.style.display = 'none';
    }
    
    // Ensure all content is visible
    const invoiceContent = document.getElementById('ViewApplicationDiv');
    if (invoiceContent) {
        invoiceContent.style.visibility = 'visible';
        invoiceContent.style.display = 'block';
    }
    
    // Print the page
    window.print();
    
    // Show the print button again after printing
    setTimeout(() => {
        if (printButton) {
            printButton.style.display = 'flex';
        }
        if (debugBar) {
            debugBar.style.display = 'block';
        }
    }, 1000);
}
</script>

</body>
</html>