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
            padding-top: 15vh;
            min-height: 100vh;
            max-width: 768px;
            font-family: Arial, sans-serif;
        }
        
        /* Decorative corner elements */
        .top-left, .top-right, .bottom-left, .bottom-right {
            height: 20px;
            background-color: rgb(45, 158, 195);
            position: fixed;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            z-index: 10;
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
            max-width: 768px;
            height: 10vh;
            position: fixed;
            top: 0;
            left: 0;
            background: white;
            z-index: 100;
            border-bottom: 1px solid #e5e7eb;
        }
        .header .row {
            padding: 0 2%;
            display: flex;
            justify-content: space-between;
            height: 100%;
        }
        .left-header, .right-header {
            width: 50%;
            height: 10vh;
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
        
        /* Main content wrapper */
        .main-content {
            padding: 20px;
        }
        
        /* Signature line */
        .sign-line {
            width: 150px;
            height: 2px;
            background-color: rgb(45, 158, 195);
        }
        
        /* Footer styles */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            height: 10vh;
            width: 100%;
            max-width: 768px;
            background: white;
            z-index: 100;
            border-top: 1px solid #e5e7eb;
        }
        .footer .row {
            padding: 0 2%;
            display: flex;
            justify-content: space-between;
            height: 100%;
        }
        .left-footer, .right-footer {
            width: 50%;
            height: 10vh;
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
            height: 7vh;
            width: auto;
        }
        
        /* Print styles */
        @media print {
            /* Ensure fixed positioning works in print */
            .header {
                position: fixed !important;
                top: 0 !important;
                width: 100% !important;
                background: white !important;
                z-index: 100 !important;
                page-break-inside: avoid;
            }
            
            .footer {
                position: fixed !important;
                bottom: 0 !important;
                width: 100% !important;
                background: white !important;
                z-index: 100 !important;
                page-break-inside: avoid;
            }
            
            /* Hide decorative elements in print */
            .top-left, .top-right, .bottom-left, .bottom-right {
                display: none !important;
            }
            
            /* Adjust body padding for print */
            /* body {
                padding-top: 12vh !important;
                padding-bottom: 12vh !important;
            } */
            
            .main-content {
                margin-top: 0 !important;
                margin-bottom: 0 !important;
            }
            
            /* Prevent page breaks inside important sections */
            section {
                page-break-inside: avoid;
            }
            
            /* Add page margins */
            @page {
                margin: 1cm;
                size: A4;
            }
            
            /* Ensure content doesn't overlap with fixed header/footer */
          
        }
        
        /* Container styles */
        .invoice-container {
            max-width: 768px;
            margin: 0 auto;
            position: relative;
            min-height: 100vh;
        }
    </style>
</head>

<body style="display:flex; justify-content:center;">
    <div class="invoice-container">
        <!-- Decorative corner elements -->
       

        <!-- Header section -->
        <section class="header">
            <div class="row">
                <div class="left-header">
                   <img src="{{asset('assets/images/logo.png')}}" class=" w-auto" alt="" style="height: 80px;">
                </div>
                <div class="right-header">
                    <!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS96s_5RFcK7qero5zH0q8hhOOa3H4b83GBTbcnTyE&s" alt="Partner Logo"> -->
                </div>
            </div>
        </section>

        <!-- Main content -->
        <div class="main-content" >
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

            /* 4. Human‑readable date or 'N/A' */
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
                        <span class="font-normal text-sm ml-2">{{ $invoice->dateofentry ? \Carbon\Carbon::parse($invoice->dateofentry)->format('d-m-Y') : '—' }}</span>
                    </div>
                    <div class="flex justify-end items-center">
                        <h1 class="font-bold text-sm ">Invoice No:</h1>
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
                <table class="min-w-[500px] max-w-xs w-auto">
                        <tr class="bg-[#aed6f1] text-black  font-bold text-sm">
                            <td class="p-1 border-r-[1px] border-gray-100">PAYMENT MODE</td>
                            <td class="p-1 border-r-[1px] border-gray-100">AMOUNT</td>
                            <td class="p-1 border-r-[1px] border-gray-100">Date</td>
                            

                        </tr>
                        <tr class="text-black text-sm border-b-[1px] border-blue-100">
                            <td class="p-1">{{strtoupper($invoices->payment_type??'')}}</td>
                            <td class="p-1">{{$booking->total_amount??''}}</td>
                            <td class="p-1">{{ $invoice->dateofentry ? \Carbon\Carbon::parse($invoice->dateofentry)->format('d-m-Y') : '—' }}</td>

                        </tr>
                    </table>
        </div>

            </section>

            <!-- Repeat sections as needed -->

            
            
            <span>Terms and Conditions</span>
                <strong>Notes:</strong>
                <ul class="list-disc pl-6 mt-4">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita, pariatur, voluptatibus animi ut quae ullam repellendus magni dolores delectus neque labore vel ea, perspiciatis enim sint vitae voluptate magnam voluptatem modi aspernatur distinctio quidem. Accusamus, velit! Vitae doloremque odit earum. Nisi quibusdam incidunt praesentium dicta facilis pariatur aut voluptatem magnam minus sint dolorem culpa velit perspiciatis enim nihil consectetur nulla, aliquam id ipsa tenetur. Consectetur dolor quae facere? Pariatur eaque, quas odio dolores architecto unde accusantium, neque vitae quia itaque deleniti voluptatem, numquam dolorum asperiores sit dolore mollitia eveniet sequi sunt qui delectus. Possimus fuga deleniti accusamus corporis voluptatibus odit alias ad animi vel eius earum ipsa optio accusantium illum tenetur est dolor, soluta pariatur distinctio quod sunt, ipsam, nesciunt harum! Totam aut tempore blanditiis dolorum officiis, doloribus optio aliquid dicta adipisci rem cum voluptatum hic esse, beatae laborum! Fugiat vel tempora sapiente aspernatur voluptatibus nobis quasi ullam? Officia sunt quidem velit tempore animi? Aliquid necessitatibus ad temporibus minus veritatis, maiores nobis aperiam esse ipsum cum hic sequi enim minima quasi voluptatum fugiat. Dolor earum incidunt pariatur minus ab iste alias a nesciunt reiciendis placeat, corporis cupiditate ex ad in quaerat, veniam nobis! Minus molestiae perspiciatis quis sapiente accusamus pariatur nihil odio vitae, perferendis expedita, omnis veniam corrupti aut quo placeat excepturi porro accusantium obcaecati. Libero, blanditiis? Eos dolorum quam dolorem. Cumque ad placeat repellendus magnam consectetur porro officia modi molestiae ullam ipsa quo, deleniti veniam quaerat molestias laborum earum nulla facilis. Non at ratione accusantium quas eum quo quisquam, quos et perspiciatis earum, sit provident sunt commodi quidem itaque, voluptatem architecto optio id error. Minima saepe expedita, reprehenderit excepturi optio illo, provident nihil voluptates explicabo itaque non dicta eligendi doloremque, impedit voluptatem omnis quas sint? Possimus recusandae officia sunt velit cum. Tempora quas maiores voluptate vitae excepturi obcaecati at facere odit veniam, accusantium consequuntur fugiat quos cupiditate accusamus nam pariatur laudantium deleniti tempore repellat molestiae quae culpa dolor? Nihil magni error aliquid! Eaque officiis distinctio soluta quod veritatis ducimus deserunt dolores corporis minima cupiditate est quasi animi molestias explicabo ex non quis hic, autem in odit. Dicta libero dolore labore et aspernatur sint aperiam, quam sit. Aperiam quas dignissimos, impedit libero ad tempore doloremque asperiores ex eveniet tempora, earum voluptate perspiciatis quasi qui suscipit temporibus unde officia est amet aut! Ducimus quia consectetur facere vero ab at nihil? Saepe reprehenderit dolore earum amet magnam placeat rem aliquid assumenda quaerat fugit, inventore sint ea, at dolorem laboriosam corporis minus, quis tenetur unde vero quae tempore quisquam? Ullam quia similique explicabo rem, voluptate culpa, veniam quam non labore facere laboriosam quasi unde doloribus ut. Mollitia ipsum a sunt quibusdam perspiciatis quaerat nihil. Possimus eum sunt officiis ut debitis dolores at natus nostrum voluptate, ad fugit doloremque laborum aspernatur quae dolorem sapiente laboriosam. Provident ullam nobis unde quam, atque molestiae sed facilis minus recusandae fugiat facere aliquid velit a laudantium et veniam ipsum laboriosam aliquam sunt dolorum illo ut? Amet quia soluta fugit repudiandae alias voluptates enim corporis cum, omnis quidem officiis sint quisquam facere nobis eum dolore debitis suscipit saepe nulla ad facilis unde aut. Nesciunt nihil dignissimos est numquam ullam nulla minima, vel consequatur harum sit voluptates distinctio culpa aspernatur aperiam quibusdam quis in commodi ad deleniti nostrum? Mollitia laboriosam, nobis, nesciunt quia temporibus facere itaque libero labore illum maiores fugit harum reiciendis vero quis delectus distinctio, ex nam ullam quam ducimus dolore. Libero fugiat animi, amet non natus quae rem debitis beatae accusamus quod ex iusto eos illo reiciendis quaerat pariatur laboriosam recusandae? Neque nisi assumenda dolor provident illum earum! Omnis officiis aliquid debitis aperiam eveniet voluptates, consectetur, tempore odio earum esse corrupti, enim vel. In numquam odio facilis iusto, architecto rem, veritatis cum officiis, molestias repudiandae quos tempore ipsum accusamus? Consequatur fugiat cum suscipit! Excepturi ab exercitationem suscipit placeat possimus veritatis sunt, dolorum tenetur dolorem illum voluptate eum iste culpa odio natus numquam quia! Adipisci doloremque, cumque voluptates, accusantium inventore nisi soluta ab, nesciunt quasi non fugit ex? Ad sit eum, ducimus est debitis dolor animi fugit libero asperiores laborum rerum quibusdam possimus blanditiis, praesentium beatae corporis culpa quis deleniti nobis autem delectus cupiditate! Delectus, voluptas. Officia rerum asperiores ex voluptas molestias ad totam laborum natus illum aliquam soluta est, nam accusamus quas ratione voluptatem cupiditate adipisci. Omnis excepturi error impedit! Laboriosam, vel id? Reiciendis error consequuntur dolore totam repudiandae exercitationem, modi animi earum explicabo, necessitatibus dolorum, vero dignissimos laudantium consequatur velit quidem accusantium magnam et. Adipisci ipsam eius delectus nesciunt alias, temporibus placeat dolor culpa ex exercitationem voluptatum dicta voluptates beatae itaque, commodi labore sapiente laborum deserunt non veniam et explicabo quod unde! Sapiente soluta officia reiciendis molestias, similique expedita magnam eius magni, commodi repudiandae ab aliquid inventore! Quam accusamus dolorum minima sunt ipsa corporis tempore expedita reprehenderit quas magnam praesentium eveniet maiores placeat natus explicabo vitae, suscipit deserunt quos reiciendis ipsam? Error dolores voluptatem voluptas architecto, quia quae voluptate aliquid. Expedita sed sapiente eum sit cumque corrupti odio molestias fuga a voluptatibus. Nam porro voluptatum temporibus? Porro officiis placeat soluta in fugit. Sapiente eveniet dolor, nihil veritatis ducimus impedit, iusto voluptates, quibusdam officia maxime id eaque vel ratione? Suscipit delectus repudiandae fuga mollitia molestiae rem, nihil enim labore vero dolorum iusto quasi tempora reprehenderit dolorem rerum, earum quis illum, velit ex veritatis beatae quia magnam! Animi amet deleniti deserunt aliquam sed ea, maxime in laboriosam ducimus possimus nulla reprehenderit cum ex maiores eveniet necessitatibus a. Cumque suscipit sint provident reiciendis hic cupiditate fugiat numquam obcaecati, quae natus unde, repellat, ullam perferendis? Pariatur ut reiciendis iusto tempora cupiditate quae laborum esse, sed voluptas commodi expedita et ex corporis? Et modi esse nesciunt est obcaecati. Dolore sed a ad magnam, quos, aspernatur vero modi accusamus error, totam fuga et labore! Totam impedit alias, nam excepturi facilis accusantium perspiciatis reprehenderit ut iste magnam? Atque voluptatem veniam aspernatur necessitatibus nesciunt unde adipisci quas, temporibus saepe modi laborum quam ex aperiam laudantium, explicabo ab deleniti autem vitae dolorum expedita. Assumenda nesciunt doloremque, nisi aut totam ducimus saepe corporis id. Provident, aliquid!
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
        </div>

        <!-- Footer section -->
        <section class="footer">
            <div class="row">
                <div class="left-footer">
                                       <img src="{{asset('assets/images/logo.png')}}" class="h-16 w-auto" alt="">

                </div>
                <div class="right-footer">
                    <img src="https://seeklogo.com/images/I/information-commissioners-office-logo-1743AEAE1C-seeklogo.com.png" alt="Certification Logo">
                </div>
            </div>
        </section>
    </div>
</body>
</html>