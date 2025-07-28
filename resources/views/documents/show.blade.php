<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
/* Hide everything by default in print */
@media print {
    /* body * {
        visibility: hidden;        
    } */

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
    <style>
        /* Base styles */
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            position: relative;
            padding-bottom: 15vh;
            padding-top: 20px;
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }
        
        /* Decorative corner elements */
        .top-left, .top-right, .bottom-left, .bottom-right {
            height: 20px;
            background-color: rgb(45, 158, 195);
            position: absolute;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .top-left {
            width: 30%;
            border-bottom-right-radius: 3rem;
            top: 0;
            left: 0;
        }
        .top-right {
            width: 20%;
            top: 0;
            right: 0;
        }
        .bottom-left {
            width: 60%;
            bottom: 0;
            left: 0;
        }
        .bottom-right {
            width: 20%;
            border-top-left-radius: 3rem;
            bottom: 0;
            right: 0;
        }
        
        /* Header styles */
        .header {
            width: 100%;
            height: 10vh;
        }
        .header .row {
            padding: 0 2%;
            display: flex;
            justify-content: space-between;
        }
        .left-header, .right-header {
            width: 50%;
            height: 10vh;
            border-bottom: solid 1px rgb(45, 158, 195);
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0 2%;
            box-sizing: border-box;
        }
        .right-header {
            justify-content: flex-end;
        }
        .header img {
            height: 7vh;
            width: auto;
        }
        
        /* Content styles */
        section {
            margin: 0;
            box-sizing: border-box;
            padding: 10px;
        }
        
        /* Signature line */
        .sign-line {
            width: 150px;
            height: 2px;
            background-color: rgb(45, 158, 195);
        }
        
        /* Footer styles */
        .footer {
            position: absolute;
            bottom: 30px;
            left: 0;
            height: 7vh;
            width: 100%;
        }
        .footer .row {
            padding: 0 2%;
            display: flex;
            justify-content: space-between;
        }
        .left-footer, .right-footer {
            width: 50%;
            height: 7vh;
            border-top: solid 1px rgb(45, 158, 195);
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0 2%;
            box-sizing: border-box;
        }
        .right-footer {
            justify-content: flex-end;
        }
        .footer img {
            height: 5vh;
            width: auto;
        }
        
        /* Print styles */
        @media print {
            /* Hide decorative elements */
            .top-left, .top-right, .bottom-left, .bottom-right {
                display: none !important;
            }
            
            /* Fix header and footer positions */
            .header {
                position: fixed;
                top: 0;
                width: 100%;
                background: white;
            }
            
            .footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                background: white;
            }
            
            /* Adjust body padding to avoid content overlap */
            body {
                padding-top: 10vh !important;
                padding-bottom: 10vh !important;
            }
            
            /* Prevent page breaks inside important sections */
            section {
                page-break-inside: avoid;
            }
            
            /* Add page margins */
            @page {
                margin: 1cm;
            }
        }
    </style>
</head>

<body style="display:flex ; justify-content:center; max-width:768px; margin:0px auto; border:1px solid black">
    <div style="">
    <!-- Decorative corner elements -->
    <div class="top-left"></div>
    <div class="top-right"></div>
    <div class="bottom-left"></div>
    <div class="bottom-right"></div>

    <!-- Header section -->
    <section class="header">
        <div class="row">
            <div class="left-header">
            @if(isset($booking->agency->profile_picture))
                <img src="{{ asset('images/agencies/logo/' . $booking->agency->profile_picture) }}" alt="{{$booking->agency->name}}" class="h-16 w-auto" class="h-24 mr-4" />
                @else
                <img src="{{asset('assets/images/logo.png')}}" class="h-16 w-auto" alt="">
                @endif
            </div>
            <div class="right-header">
                <!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS96s_5RFcK7qero5zH0q8hhOOa3H4b83GBTbcnTyE&s" alt="Partner Logo"> -->
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section>
    @php
    use Carbon\Carbon;       // Carbon alias
    use Illuminate\Support\Str;

    // dd($booking->clint);
    /* 1. Safely grab the Invoice model (may be null) */
    $invoice = $booking;

    /* 2. Split “TO” address if it exists, otherwise empty array */
    $toParts = $invoice && $invoice->clint->permanent_address
        ? array_filter(array_map('trim', explode(',', $invoice->clint->permanent_address)))
        : [];

    /* 3. Split “ISSUED BY” address if it exists, otherwise empty array */
    $issue = $booking->agency && $booking->agency->address
        ? array_filter(array_map('trim', explode(',', $booking->agency->address)))
        : [];

    /* 4. Human‑readable date or ‘N/A’ */
    $date = $invoice && $invoice->date
        ? Carbon::parse($invoice->date)->format('d F Y')
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
                <span class="font-normal text-sm ml-2">{{$booking->application_number}}</span>
            </div>
            <div class="flex justify-end items-center">
                <h1 class="font-bold text-sm ">Client ID:</h1>
                <!-- CLDI0006044 -->
                <span class="font-normal text-sm ml-2">{{$booking->clint->id ??''}}</span>
            </div>


        </div>
    </div>
    
    <div class="mt-4 grid grid-cols-2 ">
        <div class="w-full ">
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
                    <td class="p-1">{{$booking->total_amount??''}}</td>

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

    </section>

    <!-- Repeat sections as needed -->

    
    
    <span>Terms and Conditions</span>
        <strong>Notes:</strong>
        <ul class="list-disc pl-6 mt-4">
            @foreach ($termtype as $type)                 {{-- each TermType --}}
            
                @foreach ($type->terms as $term)      {{-- its related TermsCondition rows --}}
                <section>
                    
                    <li>
                        <strong>{{ $term->heading }}</strong>
                    </li>
                @endforeach
          </section>
            @endforeach
        </ul>
        
            @php
                    // null‑safe chain; returns null if any link is missing
                    $signature = $booking->visaInvoiceStatus?->docsign?->sign?->signature_data;
                @endphp

                <div class="flex flex-col items-end">
                    {{--
                    <div class="flex justify-end">
                        @if($signature)
                       
                        <img src="{{ $signature }}" alt="Signature" style="height: 100px; width:200px">
                           
                        @endif
                     </div>--}}
                     <div>
                        <span class="mt-20 text-right">Yours sincerely</span>
                   </div> 
             </div>
         
    <!-- Signature line -->
    <section style="display: flex; justify-content: flex-end; padding-right: 10vh; padding-top: 2vh; padding-bottom: 2vh;">
        <div class="sign-line"></div>
    </section>
                 <div class="no-print flex justify-center mt-6 mb-8">
            <button onclick="window.print()" class="bg-blue-500 text-white px-6 py-2 rounded shadow hover:bg-blue-600">
                Print Invoice
            </button>
        </div>

    <!-- Footer section -->
    <section class="footer">
        <div class="row">
            <div class="left-footer">
                 @if(isset($booking->agency->profile_picture))
                <img src="{{ asset('images/agencies/logo/' . $booking->agency->profile_picture) }}" alt="{{$booking->agency->name}}" class="h-16 w-auto" class="h-24 mr-4" />
                @else
                <img src="{{asset('assets/images/logo.png')}}" class="h-16 w-auto" alt="">
                @endif
            </div>
            <div class="right-footer">
                <img src="https://seeklogo.com/images/I/information-commissioners-office-logo-1743AEAE1C-seeklogo.com.png" alt="Certification Logo">
            </div>
        </div>
    </section>
</div>
</body>
</html>