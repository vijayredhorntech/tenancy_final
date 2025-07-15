<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice</title>
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

<body>
    <!-- Decorative corner elements -->
    <div class="top-left"></div>
    <div class="top-right"></div>
    <div class="bottom-left"></div>
    <div class="bottom-right"></div>

    <!-- Header section -->
    <section class="header">
        <div class="row">
            <div class="left-header">
            <img src="{{ public_path('images/agencies/logo/' . $booking->agency->profile_picture) }}" alt="{{ $booking->agency->name }}" style="height: 70px; width: auto;" />
            </div>
            <div class="right-header">
                <!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS96s_5RFcK7qero5zH0q8hhOOa3H4b83GBTbcnTyE&s" alt="Partner Logo"> -->
            </div>
        </div>
    </section>

    <!-- Main content -->

    <section>
    <h1 style="text-transform: uppercase;">Hello, {{ $booking->clint->client_name }}</h1>
        <!-- Add your actual invoice content here -->
    </section>

    @php 
    $termtype = $termconditon
        ? $termconditon->where('type', 'VISA APPLICATION')
        : collect();   // empty collection if $termconditon is null
      
  
                    // null‑safe chain; returns null if any link is missing
                    // $signature = $booking->visaInvoiceStatus?->docsign?->sign?->signature_data;
                    // dd($booking);
                    $signature = $booking->visaDocSign?->docsign?->signature_data;
          
                
    @endphp
    <!-- Repeat sections as needed -->
    <section>
        
    <ul class="list-disc pl-6 mt-4">
                @foreach ($termtype as $type) {{-- each TermType --}}
                    @foreach ($type->terms as $term) {{-- its related TermsCondition rows --}}
                 
                       @if($term->display_invoice==1)
                        <li>
                            <strong>{{ $term->heading }}</strong><br>
                            {{ $term->description }}
                        </li>
                    @endif
                    @endforeach
                @endforeach
            </ul>
</section>

    <!-- Signature line -->
    <section style="display: flex; flex-direction:column; align-items:end; padding-right: 10vh; padding-top: 2vh; padding-bottom: 2vh;">
                 <div style="width:max-content; padding:0px 20px; border-bottom:2px solid #2d9ec3; display:flex; justify-content:center">
                 @if($signature)
                       <img src="{{ $signature }}" alt="Signature" style="height: 100px; width:200px">
                @endif
                 </div>
                 <div style="display: flex; flex-direction:column; align-items:end; margin-top:10px">
                    <span>{{ \Illuminate\Support\Str::upper($booking->clint->client_name) }}</span>
                    <span>{{$booking->visaDocSign->docsign->signed_at}}</span>
                 </div>
    </section>

    <!-- Footer section -->
    <section class="footer">
        <div class="row">
            <div class="left-footer">
                <!-- <img src="bottom.png" alt="Footer Logo"> -->
            </div>
            <div class="right-footer">
                {{-- <img src="https://seeklogo.com/images/I/information-commissioners-office-logo-1743AEAE1C-seeklogo.com.png" alt="Certification Logo"> --}}
            </div>
        </div>
    </section>
</body>
</html>