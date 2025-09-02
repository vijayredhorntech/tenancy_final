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
            /* Hide everything initially */
            body * {
                visibility: hidden;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
            }
            
            /* Only show the invoice container and its contents */
            #ViewApplicationDiv,
            #ViewApplicationDiv * {
                visibility: visible;
                box-shadow: none !important;
            }
            
            /* Position the invoice properly */
            #ViewApplicationDiv {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
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
            
            /* Hide print button when printing */
            .no-print {
                display: none !important;
            }
            
            /* Improve table appearance for print */
            table {
                border-collapse: collapse;
                width: 100%;
            }
            
            td, th {
                border: 1px solid #ddd;
                padding: 4px;
            }
            
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
            
            /* Remove any potential spacing issues */
            .p-6 {
                padding: 1rem !important;
            }
            
            .mt-4 {
                margin-top: 0.5rem !important;
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
<div class="bg-white shadow-md rounded-lg p-6" id="ViewApplicationDiv">
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

    $invoice = $booking;

    $toParts = $invoice && $invoice->clint->permanent_address
        ? array_filter(array_map('trim', explode(',', $invoice->clint->permanent_address)))
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
                {{ strtoupper(!empty($invoice->clint->client_name) ? $invoice->clint->client_name : '') }}
            </p>
            @foreach($toParts as $line)
                <p class="text-sm">{{ strtoupper($line) }}</p>
            @endforeach
            <p class="text-sm"><strong>TEL:</strong> {{ $invoice->clint->phone_number ?? 'N/A' }}</p>
            <p class="text-sm"><strong>Email:</strong> {{ $invoice->clint->email ?? 'N/A' }}</p>
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
        <h2 class="text-md font-bold bg-[#26ace2] p-3 w-max text-white">OTHER FACILITIES</h2>
        <h3 class="text-md font-bold text-black mt-6">1. Passenger Details</h3>
        <div class="w-full overflow-hidden mt-2">
            <table class="w-full">
                <tr class="bg-[#aed6f1] text-black font-bold text-sm">
                    <td class="p-1 border-r-[1px] border-gray-100">S#</td>
                    <td class="p-1 border-r-[1px] border-gray-100">OTHER FACILITIES REMARK</td>
                    <td class="p-1 border-r-[1px] border-gray-100">AMOUNT</td>
                </tr>
                <tr class="text-black text-sm border-b-[1px] border-blue-100">
                    <td class="p-1">1</td>
                    <td class="p-1">{{$booking->visa->name}}</td>
                    <td class="p-1">{{$booking->total_amount ?? ''}}</td>
                </tr>
            </table>
        </div>
        
        <table class="min-w-[700px] max-w-xs w-auto mt-7">
            <tr class="bg-[#aed6f1] text-black font-bold text-sm">
                <td class="p-1 border-r-[1px] border-gray-100">PAYMENT MODE</td>
                <td class="p-1 border-r-[1px] border-gray-100">AMOUNT</td>
                <td class="p-1 border-r-[1px] border-gray-100">Date</td>
            </tr>
            <tr class="text-black text-sm border-b-[1px] border-blue-100">
                <td class="p-1">{{strtoupper($invoice->payment_type ?? 'Cash')}}</td>
                <td class="p-1">{{$booking->total_amount ?? ''}}</td>
                <td class="p-1">{{$booking->created_at->format('d F Y')}}</td>
            </tr>
        </table>
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
            <button onclick="window.print()" class="bg-[#28a745] text-white text-sm px-2 py-1 rounded-sm">
                Print Invoice
            </button>
        </div>
    </div>
</div>
</body>
</html>