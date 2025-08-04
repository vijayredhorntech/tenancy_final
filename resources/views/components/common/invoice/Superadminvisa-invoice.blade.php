<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
            .sign-line {
                border-bottom: 1px solid #000;
                width: 200px;
                margin-top: 20px;
                height: 1px;
            }

        #footer {
            counter-increment: pages;
        }
        #footer .page {
            position: absolute;
            bottom:2.8cm;
            right:0.4cm;
            color: black;
        }
        #footer .page:after {
            content: counter(page,decimal);
        }

        @page {
            margin: 0cm 0cm;
        }
        body {
            counter-reset: page;
            position:relative;
            margin-top: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
            text-align: justify;
            padding-top: 50px;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2.5cm;
        /border-top: 10px #2d9ec3 solid;/
        border-bottom: 1px #2d9ec3 solid;
        /border-top: solid 1px rgb(45, 158, 195);/

        text-align: left;
            line-height: 1.5cm;

        }
        footer {
            position: fixed;
            bottom: 1.1cm;
            left: 0cm;
            right: 0cm;
            height: 1.1cm;
        /background-color: 	#0598FF;/
        color: white;
            text-align: left;
            line-height: 1cm;
            font-size: 13px;
            padding-bottom: 5%;
        /padding-top: 0.5%;/
        margin:auto;
            border-top: solid 1px rgb(45, 158, 195);
        }
        main {
            padding-top: 4px;
            position: relative;
        }
        .signature{

        }
    </style>
</head>
<body>

<header  style="text-align: left;" id="header">
    <div>
        <img src="{{asset('assets/images/header.jpeg')}}" width="100%" style="float: left;">
    </div>

</header>

<footer id="footer">
    <img src="{{asset('assets/images/footer.jpeg')}}" width="100%">
    <span class="page">Page </span>
</footer>

<!-- Wrap the content of your PDF inside a main tag -->
<main>
    <div class="main-container" style="padding:10px; padding-top: 100px">
        <section>
            @php
            use Carbon\Carbon;       // Carbon alias
            use Illuminate\Support\Str;

            // dd($booking->clint);
            /* 1. Safely grab the Invoice model (may be null) */
            $invoice = $booking;

            /* 2. Split "TO" address if it exists, otherwise empty array */
            $toParts = $invoice && $invoice->clint->permanent_address
            ? array_filter(array_map('trim', explode(',', $invoice->clint->permanent_address)))
            : [];

            /* 3. Split "ISSUED BY" address if it exists, otherwise empty array */
            $issue = $booking->agency && $booking->agency->address
            ? array_filter(array_map('trim', explode(',', $booking->agency->address)))
            : [];

            /* 4. Human-readable date or 'N/A' */
            $date = $invoice && $invoice->invoice_date
            ? Carbon::parse($invoice->invoice_date)->format('d F Y')
            : 'N/A';

            /* 5. Filter term-conditions collection if present */
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
                        <span class="font-normal text-sm ml-2">{{ $invoice->dateofentry ? \Carbon\Carbon::parse($invoice->dateofentry)->format('d-m-Y') : '—' }}</span>
                    </div>
                    <div class="flex justify-end items-center">
                        <h1 class="font-bold text-sm ">Invoice No:</h1>
                        <!-- CLDI0006044 -->
                        <span class="font-normal text-sm ml-2">{{ $booking->deduction->superadmin_invoice_number}}</span>
                    </div>
                    <div class="flex justify-end items-center">
                        <h1 class="font-bold text-sm ">Order Id:</h1>
                        <!-- CLDI0006044 -->
                        <span class="font-normal text-sm ml-2">{{$booking->visaInvoiceStatus->invoice_number}}</span>
                    </div>
                    <div class="flex justify-end items-center">
                        <h1 class="font-bold text-sm ">Client ID:</h1>
                        <!-- CLDI0006044 -->
                        <span class="font-normal text-sm ml-2">{{$invoice->client_id ??''}}</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 grid grid-cols-2 ">
                <div class="w-full ">
                    <h2 class="text-lg font-bold text-[#26ace2]">TO</h2>
                    <p class="text-sm">
                        62 KING STREET,
                    </p>
                    <p class="text-sm">
                        SOUTHALL,
                    </p>
                    <p class="text-sm">
                        MIDDLESEX,
                    </p>
                    <p class="text-sm">
                        UB2 4DB
                    </p>
                    <p class="text-sm"><strong>TEL:</strong>02035000000</p>
                    <p class="text-sm"><strong>Email:</strong>info@cloudtravels.co.uk</p>
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

            </div>

        </section>

        <!-- Repeat sections as needed -->
        <span>Terms and Conditions</span>
        <strong>Notes:</strong>
        <ul class="list-disc pl-6 mt-4">
            @foreach ($termtype as $type)   {{-- each TermType --}}
           
            @foreach ($type->terms as $term)  {{-- its related TermsCondition rows --}}
            <section>
                <li>
                    <strong>{{ $term->heading }}</strong>
                    <strong>{{ $term->description }}</strong>
                </li>
                @endforeach
            </section>
            @endforeach
        </ul>

      
        @php
        // null-safe chain; returns null if any link is missing
        $signature = $booking->visaInvoiceStatus?->docsign?->sign?->signature_data;
        @endphp

        <div class="flex flex-col items-end">
            <div>
                <span class="mt-20 text-right">Yours sincerely</span>
            </div>
        </div>


        <!-- Signature line -->
        <section style="display: flex; justify-content: flex-end; padding-right: 10vh; padding-top: 2vh; padding-bottom: 2vh;">
            <div class="sign-line"></div>
        </section>
        <div class="mt-4 pl-6 w-full">
            <table class="min-w-[500px] max-w-xs w-auto">
                <tr class="bg-[#aed6f1] text-black  font-bold text-sm">
                    <td class="p-1 border-r-[1px] border-gray-100">PAYMENT MODE</td>
                    <td class="p-1 border-r-[1px] border-gray-100">AMOUNT</td>
                    <td class="p-1 border-r-[1px] border-gray-100">Date</td>
                </tr>
                <tr class="text-black text-sm border-b-[1px] border-blue-100">
                    <td class="p-1">{{strtoupper($invoice->payment_type??'')}}</td>
                    <td class="p-1">{{$booking->total_amount??''}}</td>
                    <td class="p-1">{{ $invoice->dateofentry ? \Carbon\Carbon::parse($invoice->dateofentry)->format('d-m-Y') : '—' }}</td>
                </tr>
            </table>
        </div>
    </div>



    <div class="no-print flex justify-center mt-6 mb-8">
        <button onclick="window.print()" class="bg-blue-500 text-white px-6 py-2 rounded shadow hover:bg-blue-600">
            Print Invoice
        </button>
    </div>

</main>


<script>
    // This script ensures footer only appears on last page
    document.addEventListener('DOMContentLoaded', function() {
        // For print view
        window.onbeforeprint = function() {
            // Move footer to the very end of the document
            const footer = document.querySelector('#footer');
            const container = document.querySelector('.invoice-container');
            container.appendChild(footer);

            // Show footer only for print
            footer.style.display = 'block';
        };

        // For screen view
        window.onafterprint = function() {
            // Move footer back to its original position
            const footer = document.querySelector('#footer');
            const lastPageContent = document.querySelector('.last-page-content');
            lastPageContent.appendChild(footer);

            // Hide footer for screen view
            footer.style.display = 'none';
        };
    });
</script>
</body>
</html>