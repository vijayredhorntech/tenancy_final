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
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga ipsum tempore harum iste, quidem, qui ad asperiores iure dignissimos rem, sunt aspernatur quia alias in voluptatum impedit commodi officiis sapiente dolorem quas quaerat. Aperiam ipsa similique illo distinctio nobis maiores dolorum sit nostrum, libero error ea corporis consectetur necessitatibus? Atque libero eos maxime. Iste beatae mollitia consequatur ipsa illum nisi optio alias dolorem architecto et, unde modi repudiandae minus sed vel eius enim natus, hic vitae sapiente voluptatibus laudantium. Ipsa libero asperiores, error possimus id omnis. Consequatur neque, odio voluptatem tempore tenetur at nulla hic, veritatis repellendus, nostrum velit. Unde illo id ex laboriosam provident animi possimus magni, earum corrupti. Veritatis, est. Saepe maiores doloremque quam amet soluta odit architecto non id quisquam temporibus. Repellat alias accusamus distinctio recusandae fugit tenetur non quaerat! Ea quae enim consequuntur necessitatibus cum amet porro fugiat fugit hic cumque harum accusamus excepturi at distinctio quam ratione blanditiis, obcaecati rerum deleniti vero quos, commodi nisi? Consequuntur magnam ipsum, repellat minus illum animi placeat impedit unde mollitia nobis quasi exercitationem ex! Eligendi eaque soluta libero sint repudiandae autem quis aliquam minima maiores accusamus, quo, odio sequi. Iure, facere repellat. Blanditiis natus autem beatae, sit incidunt corporis aut sed eveniet deleniti harum, deserunt quasi delectus totam quos necessitatibus dolor perferendis alias! Doloribus eius consequuntur quidem ipsa, nemo esse quia dolore porro perspiciatis, unde optio laudantium officia odio reprehenderit praesentium! Fugiat cumque quasi sint molestiae non porro corrupti obcaecati! Beatae voluptate aspernatur quasi rem ipsa error impedit dolorem. Vitae reiciendis eius impedit minima suscipit, placeat cupiditate, tempora necessitatibus ipsa voluptatibus commodi molestias fugiat quod distinctio officiis beatae. Corrupti facilis dolor eum alias consequuntur hic illum eveniet debitis minus excepturi ex aperiam vero nobis accusamus sapiente error ad expedita, mollitia reprehenderit, animi fugit consectetur. Sed, a quasi! Modi, inventore.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui voluptates quasi magnam voluptas. Commodi reiciendis animi et repellat consequuntur fugiat molestias. Possimus vitae maxime autem voluptatem placeat culpa tenetur magnam esse ex molestiae nisi voluptatum illo quisquam inventore excepturi doloribus quis, repellat mollitia delectus itaque officiis adipisci quas numquam! Harum velit laboriosam, odio explicabo alias, reiciendis eius culpa nulla consequatur beatae vitae vel ex rerum quibusdam tempore nesciunt sit? Hic excepturi aliquid, assumenda perspiciatis ad eveniet animi nobis in dolorum deleniti, esse blanditiis, quos tenetur. Hic voluptatum, iure error corrupti omnis quasi consequuntur, deserunt aut commodi est cupiditate eaque sed a. Consequatur earum distinctio optio facere beatae voluptates, doloribus nostrum mollitia libero, esse delectus nisi excepturi assumenda omnis sed ex deleniti tempore? Rem nostrum eius dolor doloribus repellat fugiat, deserunt odio cupiditate facere, nulla temporibus dolorum cum incidunt soluta aspernatur fugit sed at ad molestias magni laudantium facilis. Molestias incidunt eaque eligendi nemo possimus sint corporis consequuntur harum, cupiditate eius, autem hic necessitatibus exercitationem dignissimos, veniam assumenda consectetur ea temporibus dolores vitae perspiciatis voluptatem debitis ut numquam. Id in molestias libero nulla ea consectetur adipisci aliquid iusto officiis, laboriosam, expedita laborum labore tenetur accusamus iure maxime quidem eius! Ipsam nulla perferendis minus voluptas maiores ipsum inventore nihil vero minima odio et reprehenderit nemo, modi reiciendis blanditiis illo? Qui reprehenderit nam, corrupti aspernatur inventore vel similique autem accusantium vero blanditiis unde porro deleniti molestias ad quia asperiores maxime! Voluptas iste atque minus ducimus dolores nam officiis odio earum? Expedita perspiciatis enim, assumenda animi aperiam eveniet aliquam vero voluptas sed molestiae dolorum possimus at repudiandae id repellat dolorem accusantium minima culpa! Asperiores et omnis optio perferendis quisquam ad veniam repellendus molestias minima? Veritatis odit impedit nostrum autem provident aliquid, facilis quisquam deserunt labore quis quam, officiis quibusdam doloremque! Non laborum explicabo nam inventore ad, delectus qui asperiores dignissimos placeat facere aperiam hic officia tempora, a voluptates modi iure. Sapiente, odio neque soluta dolore repudiandae commodi sit recusandae laborum possimus sint nam quisquam temporibus officiis ducimus quo. Impedit excepturi animi expedita praesentium dolore mollitia sint cupiditate? Ea quibusdam culpa amet, recusandae cupiditate consectetur neque iste distinctio. Molestias, accusantium dolorem! Nesciunt quae corrupti dignissimos commodi magni rerum. Hic ratione quibusdam quam. Sed ducimus, aperiam, deleniti animi dicta vitae asperiores provident praesentium, veritatis voluptas adipisci tempore. Doloremque perspiciatis quidem libero ea aut vel nam pariatur minus, ipsum dolor ex quo. Saepe, delectus ipsam. Nihil cumque incidunt asperiores assumenda porro rerum facere quam odit, illo voluptatem. Eius vitae voluptas aperiam porro et tempora illo, reiciendis quisquam, quas esse omnis tenetur neque corrupti earum ipsam facilis quam vero temporibus eos. Culpa totam repellat nostrum qui cumque sequi! Quibusdam eos, excepturi inventore facere delectus praesentium libero itaque expedita quas optio enim, culpa nesciunt! Eveniet adipisci ratione aut, at aliquid alias. Qui ipsum quam nam atque voluptate? Sapiente tenetur quis, voluptas exercitationem minima aliquam sint necessitatibus molestias dolorem ipsum incidunt ullam laboriosam. Repellendus omnis laboriosam provident, rem deleniti beatae. Perspiciatis, tempore perferendis. Deleniti atque expedita sapiente voluptates deserunt tempora.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde rerum cupiditate veritatis blanditiis, dolor natus repellat eaque ab voluptatum possimus incidunt porro impedit molestias mollitia nisi a cumque minus quisquam? Voluptas tenetur sequi accusantium magni consequuntur illo rem sunt quibusdam aliquam, officia dignissimos quia porro quod, praesentium non assumenda numquam! Consequuntur dolor blanditiis, quod rerum dolore repellendus? Ducimus veritatis quam cum doloremque in magni. Minus facilis quos numquam aspernatur praesentium cupiditate similique blanditiis assumenda earum nesciunt, quas quia beatae tempore laboriosam consequuntur, eos voluptatem, autem debitis dignissimos? Ipsum officiis iste magnam aliquid quis maxime esse quidem ab recusandae obcaecati quas, nihil rem delectus blanditiis quibusdam aliquam fugiat molestiae minus id laborum amet, maiores perferendis adipisci? Ipsa exercitationem cum excepturi deleniti quam ad enim incidunt, consequatur iusto, ut dolorem! Nemo recusandae commodi blanditiis, assumenda ratione, sint et hic quia corporis perferendis deserunt vel placeat totam nihil error sunt reiciendis ducimus delectus dolorem. Similique, assumenda et. In officia velit excepturi iusto corrupti dolor iure aliquam aspernatur! In consectetur magni amet rem et aut, ducimus, consequatur fugit quod odit maxime magnam mollitia saepe non adipisci! Vitae at culpa dolorem obcaecati, aliquid suscipit maiores minima facere quibusdam ab ullam dolorum dignissimos aperiam doloremque consequatur minus. In eum aspernatur aut, architecto quisquam modi harum autem illo magnam suscipit totam adipisci eos. Beatae harum animi distinctio, possimus dicta libero necessitatibus molestias veniam id blanditiis repellendus debitis dolorum maiores suscipit aspernatur sapiente consectetur corporis. Totam molestiae quod dolorem. Rerum ab provident nulla quia cum doloribus, ipsam excepturi perferendis quod porro maiores corporis, dolores iure odit officia quo sit ex qui. Iste ipsam dignissimos modi? Vel dignissimos perferendis quisquam sit, asperiores, tenetur corporis ipsam fugit, aliquid hic optio? Praesentium commodi aperiam nemo quod adipisci illum assumenda? Magnam perferendis consequatur nulla nihil unde est aspernatur recusandae aliquam animi, voluptate suscipit at dolorem, neque quo quas itaque! Voluptatibus distinctio, nobis repellat est facilis placeat pariatur odio quia, rerum, labore voluptate cum? Impedit, officia? Doloremque, minima modi. Quibusdam, iusto tempore repellendus repellat, laborum ipsum commodi magnam provident delectus inventore iste beatae doloremque officia omnis in recusandae facere deserunt asperiores deleniti. Sapiente molestiae quae doloribus quaerat accusamus. Quod tempore odio reprehenderit harum nesciunt. In cupiditate quas voluptatem! Excepturi vitae doloremque corrupti, provident culpa quaerat facilis perspiciatis iste dolorem consequuntur quo aut atque aliquam eveniet. Hic, facilis? Tenetur totam tempore sit at quod, hic maiores dicta expedita corporis? Blanditiis dolore ad adipisci magni molestiae doloremque fugiat exercitationem accusantium veniam vero, eaque illum. Et quas accusamus hic, consectetur inventore cumque unde quis maxime, earum iusto nisi veritatis. Repudiandae expedita accusamus aliquid commodi consequatur soluta, recusandae quae perspiciatis illum adipisci dicta incidunt, omnis pariatur. Deserunt, minima adipisci error sapiente fugiat distinctio magni molestias omnis, quis ea facere vero, voluptatum odit non blanditiis illum exercitationem libero eos necessitatibus temporibus soluta ducimus? Ratione, cum, ad voluptates magnam sunt impedit vel ex nobis blanditiis quam quasi at nam sapiente fuga consectetur repellat qui facilis alias quisquam nesciunt velit voluptas porro molestiae? Placeat, vitae unde quaerat vero obcaecati suscipit at ipsum quia repellendus reiciendis nihil non architecto, maxime qui recusandae ut voluptatibus? Ducimus quos consectetur nobis optio porro, ad alias blanditiis sed fugiat ea tempora voluptatibus facere aut eum illo, asperiores odit suscipit voluptas aliquam. Deleniti id enim quibusdam animi doloribus expedita veritatis nemo, in nostrum sint? Magnam atque blanditiis delectus, odit, fugit porro odio aliquam eos dolorum, eum fugiat animi? Consequuntur atque possimus adipisci iusto consectetur obcaecati esse a, quod nisi culpa debitis eius, qui ipsam asperiores optio magnam, quae quas totam pariatur enim voluptate! Unde voluptas consectetur natus, vero amet officiis deserunt tempora nesciunt alias excepturi praesentium adipisci nisi reiciendis incidunt id architecto, sunt ducimus omnis, accusantium et. Nam possimus ipsa voluptatum at natus eum quia, numquam quis nesciunt laboriosam totam quae consequatur earum aliquam ab sit cupiditate minima rerum. Dolores architecto recusandae optio debitis distinctio, laboriosam assumenda molestiae maxime porro eaque velit omnis unde, consectetur deserunt suscipit ipsum? Laudantium quasi ex iure aliquid neque, eos nisi pariatur temporibus incidunt, expedita nobis sint, placeat quas non magnam perspiciatis cupiditate. In placeat at cupiditate officia unde corporis soluta quos voluptate consectetur veniam laudantium tempora minus velit, quam nemo quaerat tenetur aliquid? Dolor sapiente natus ipsa eum veniam quisquam. Numquam vitae magnam est quaerat, temporibus esse voluptas fuga eligendi nisi? Cumque quasi recusandae deleniti aspernatur facere ipsam atque, iste est quidem nostrum quam, reprehenderit explicabo vero laborum hic. Facere tenetur officiis, alias veritatis cumque incidunt quam perferendis! Sunt nobis tempora accusantium, in non laborum possimus consectetur, voluptatibus adipisci, ullam harum laudantium dicta omnis nam. Molestiae voluptatem, quisquam eos dolore nihil aut pariatur recusandae impedit, deleniti dolorum unde quaerat enim architecto veniam soluta obcaecati dignissimos officiis adipisci dicta reiciendis. Mollitia iure quam optio, hic molestiae ipsum quos minima, labore fugit itaque delectus repellat pariatur fuga, facere maiores illum ab architecto possimus dolorem excepturi voluptates vero? Vel iure, amet obcaecati eos consequatur pariatur eaque neque dicta itaque illum dolor quia perferendis voluptates veniam, aliquam quod voluptatum ullam alias sint deserunt numquam odit quisquam. Blanditiis aliquid aspernatur tempore repudiandae perspiciatis itaque officiis, autem, corrupti alias commodi voluptates, iste tempora incidunt culpa minima fugiat possimus consequatur. Eum qui voluptatem perferendis delectus molestias modi non a excepturi iste magni aspernatur veniam, harum labore culpa. Maxime id aperiam, delectus sit iure et voluptatem est optio vero ea eum exercitationem. Quam expedita culpa optio nostrum laudantium minus quidem aut eius officiis facilis? Nobis minus ducimus eos, excepturi saepe inventore tempore iure quae doloremque nihil autem molestiae accusantium porro optio quam odio aspernatur. Officia sapiente commodi sit quidem nostrum nobis rem tempora magni ducimus praesentium facilis eaque esse ex reprehenderit ullam vero eligendi tenetur, possimus earum iste nesciunt? Aliquid necessitatibus expedita temporibus, aspernatur explicabo eveniet aliquam aut, at quisquam possimus deleniti soluta non perspiciatis deserunt sint cupiditate quidem dignissimos ut assumenda? Neque vel ducimus tenetur, eos quod atque qui quam officiis consectetur voluptate temporibus modi deserunt numquam placeat explicabo. Animi est deserunt illum et iste? Esse nemo laudantium, neque iste accusamus corporis eligendi consequuntur et culpa explicabo.
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique possimus quasi eos, excepturi nesciunt consectetur ducimus, dolorem praesentium officiis, molestiae recusandae ut voluptatem eaque nam aperiam! Possimus sunt sit inventore. Sint, id numquam nemo illum esse officiis repellat consequatur corporis porro, unde sapiente! Illo vel earum eum eaque sunt repudiandae aliquam. Voluptatibus, incidunt. Tempora quibusdam iusto libero eos corporis inventore animi temporibus distinctio. Beatae voluptatibus temporibus ullam ratione at molestiae rerum voluptas sapiente, quae cumque placeat corporis, pariatur eos reiciendis, animi esse expedita praesentium rem obcaecati. Veniam modi labore officia fugit quisquam dolore temporibus, error non minima vero, pariatur voluptas enim sunt fuga ullam, obcaecati iusto expedita. Voluptatum quae minima quibusdam illo impedit doloribus repudiandae. Iusto praesentium cum incidunt voluptatibus esse. Quia repellendus voluptas corporis. Earum beatae dolores consectetur iste id accusamus, culpa nostrum aut est distinctio molestiae voluptates vel officiis vero eum. Quaerat dolorum soluta vel amet aliquam quia. Assumenda sed consectetur consequuntur officia. Hic asperiores similique ut, saepe quae sunt explicabo quo neque, ea, suscipit eligendi illo ducimus sit esse beatae maxime temporibus in tempore distinctio id omnis minus aperiam iste? Dolorem, enim. Nam aliquam non quae molestias consectetur laboriosam assumenda blanditiis, ducimus debitis deserunt ad maxime maiores.
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