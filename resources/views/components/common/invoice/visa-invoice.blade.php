<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* @media print {
            .no-print { display: none; }
            body { margin: 0; padding: 0; }
            .container { width: 100%; max-width: 100%; }
        } */
            @media print {
    /* Hide everything by default */
    body * {
        visibility: hidden !important;
    }
    
    /* Show only the print area and its children */
    #print-area, #print-area * {
        visibility: visible !important;
    }
    
    #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        margin: 0;
        padding: 15px;
    }
    
    /* Hide specific elements */
    .no-print, .phpdebugbar, .debugbar {
        display: none !important;
    }
    
    /* Clean print layout */
    body {
        margin: 0;
        padding: 0;
        background: white !important;
    }
    
    .container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 15px;
    }
}

        /* body {
            background-color: #f5f5f5;
            padding: 20px;
            font-family: 'Verdana', sans-serif;
            font-size: 14px;
        } */

        .outer-div {
            background-color: #fff;
            width: 100%;
        }

        .outer-div-inner {
            margin: 2% auto;
            padding: 20px 25px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.07);
        }

        .header-section {
            border-bottom: 2px solid #797777;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .invoice-title {
            text-align: center;
            font-size: 35px;
            font-weight: 600;
            text-transform: uppercase;
            margin: 20px 0;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin: 30px 0;
        }

        .invoice-info-box {
            flex: 1;
        }

        .invoice-info-right {
            text-align: right;
            flex: 1;
        }

        .to-from-section {
            display: flex;
            gap: 40px;
            margin: 30px 0;
        }

        .to-section, .from-section {
            flex: 1;
        }

        .to-section h3, .from-section h3 {
            font-size: 24px;
            font-weight: 600;
            color: #26ace2;
            margin-bottom: 10px;
        }

        .section-header {
            background-color: #26ace2;
            color: white;
            padding: 12px 15px;
            font-size: 18px;
            font-weight: 600;
            margin-top: 30px;
            margin-bottom: 15px;
        }

        .table {
            margin-top: 15px;
            border-collapse: collapse;
            width: 100%;
        }

        .table th {
            background-color: #AED6F1;
            color: #000;
            font-weight: 600;
            padding: 10px;
            border: 1px solid #dee2e6;
            text-transform: uppercase;
        }

        .table td {
            padding: 10px;
            border: 1px solid #dee2e6;
        }

        .text-light-blue {
            color: #26ace2;
            font-weight: 600;
        }

        .summary-section {
            margin-top: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .summary-item.total-row {
            font-weight: 600;
            font-size: 16px;
            border-bottom: 2px solid #333;
            border-top: 2px solid #333;
            padding: 12px 0;
            margin-top: 10px;
        }

        .terms-section {
            margin-top: 40px;
            padding: 20px;
            background-color: #f8f9fa;
            border-left: 4px solid #26ace2;
        }

        .terms-section h4 {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .terms-section ul {
            margin-left: 20px;
        }

        .terms-section li {
            margin-bottom: 10px;
            text-align: justify;
            line-height: 1.6;
        }

        .signature-section {
            margin-top: 50px;
            text-align: right;
        }

        .signature-line {
            display: inline-block;
            border-top: 2px solid #333;
            padding-top: 10px;
            margin-top: 60px;
        }

        .button-section {
            text-align: center;
            margin-top: 30px;
            gap: 10px;
        }

        .float-right {
            float: right;
        }

        .responsive-center {
            text-align: center;
        }

        h1, h2, h3, h4 {
            margin-top: 0;
        }

        .print-button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .print-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>



<div id="print-area">
<div class="outer-div" id="ViewApplicationDiv">
    <div class="outer-div-inner container">
        <!-- <div class="header-section">
            @if(isset($booking->agency->profile_picture))
                <div style="text-align: center; margin-bottom: 20px;">
                    <img src="{{ asset('images/agencies/logo/' . $booking->agency->profile_picture) }}" alt="{{$booking->agency->name}}" style="height: 50px; margin: 0 auto;" />
                </div>
            @else
                <div style="text-align: center; margin-bottom: 20px;">
                    <img src="{{asset('assets/images/logo.png')}}" style="height: 50px; margin: 0 auto;" alt="">
                </div>
            @endif
        </div> -->
       @if(isset($booking->agency->profile_picture))
            <div style="text-align: left; margin-bottom: 20px;">
                <img src="{{ asset('images/agencies/logo/' . $booking->agency->profile_picture) }}" 
                    alt="{{ $booking->agency->name }}" 
                    style="height: 50px;">
            </div>
        @else
            <div style="text-align: left; margin-bottom: 20px;">
                <img src="{{ asset('assets/images/logo.png') }}" 
                    style="height: 50px;" 
                    alt="">
            </div>
        @endif


    
    @php
    use Carbon\Carbon;
    use Illuminate\Support\Str;

  
    $invoice = $booking->deduction; // Get the deduction from visa booking
 
    $invoiceData = $invoice->invoice ?? null; // Get updated invoice data

    $otherClientInfo = $booking->otherclients ?? [];
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

         $price = 0;

    if (optional($invoiceData)->status === 'edited') {
        
        $price = (float) $invoiceData->new_price;
    } else {
        
   
        $price = is_numeric(optional($invoiceData)->amount ?? $booking->total_amount ?? 0)
            ? (float) (optional($invoiceData)->amount ?? $booking->total_amount ?? 0)
            : 0;
    }


    $price = number_format($price, 2);

    @endphp

    <div class="invoice-title">INVOICE</div>

    <div class="invoice-info">
        <div class="invoice-info-box"></div>
        <div class="invoice-info-right">
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="border: none; font-weight: bold; padding: 5px;">Invoice Date :</td>
                    <td style="border: none; padding: 5px;">{{$booking->created_at->format('d F Y')}}</td>
                </tr>
                <tr>
                    <td style="border: none; font-weight: bold; padding: 5px;">Invoice No :</td>
                    <td style="border: none; padding: 5px;">{{$booking->visaInvoiceStatus->invoice_number}}</td>
                </tr>
                <tr>
                    <td style="border: none; font-weight: bold; padding: 5px;">Client ID :</td>
                    <td style="border: none; padding: 5px;">{{$invoice->billing_id ?? ''}}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="to-from-section" style="display: flex; justify-content: space-between; align-items: flex-start; gap: 40px; margin: 30px 0;">
    <!-- TO SECTION (Left) -->
    <div class="to-section" style="flex: 1; text-align: left;">
        <h3 style="font-size: 24px; font-weight: 600; color: #26ace2; margin-bottom: 10px;">To</h3>
        <p style="margin: 0;">
            {{ strtoupper($clientName) }}<br>
            @foreach($toParts as $line)
                {{ strtoupper($line) }}<br>
            @endforeach
            <strong>TEL:</strong> {{ $clientPhone }}<br>
            <strong>Email:</strong> {{ $clientEmail }}
        </p>
    </div>

    <!-- FROM SECTION (Right) -->
    <div class="from-section" style="flex: 1; text-align: right;">
        <h3 style="font-size: 24px; font-weight: 600; color: #26ace2; margin-bottom: 10px;">Issued By</h3>
        <p style="margin: 0;">
            @foreach($issue as $line)
                {{ strtoupper($line) }}<br>
            @endforeach
            <strong>TEL:</strong> {{ $booking->agency->phone }}<br>
            <strong>E-MAIL:</strong> {{ $booking->agency->email }}
        </p>
    </div>
</div>

    
    <div class="section-header">VISA SERVICES</div>
    
    <table class="table">
        <thead>
            <tr>
                <th>SNO.</th>
                <th>APPLICANT NAME</th>
                <th>PASSPORT ORIGIN</th>
                <th>VISA COUNTRY</th>
                <th>VISA TYPE</th>
                <th>VISA FEES</th>
                <th>SERVICE CHARGE</th>
                <th>AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1.</td>
                <td>{{ strtoupper($clientName) }}</td>
                <td>{{ strtoupper($passportOrigin) }}</td>
                <td>{{ strtoupper($visaCountry) }}</td>
                <td>{{ strtoupper($visaType) }}</td>
                <td>{{ $currency }}{{ number_format($visaFee, 2) }}</td>
                <td>{{ $currency }}{{ number_format(is_numeric($invoiceData?->service_charge ?? 0) ? (float)($invoiceData?->service_charge ?? 0) : 0, 2) }}</td>
                <td>{{ $currency }}{{ $price }}</td>
            </tr>
            @forelse($otherClientInfo as $client)
                <tr>
                    <td>{{ $loop->iteration + 1 }}.</td>
                    <td>{{ strtoupper($client->name) }}</td>
                    <td>{{ strtoupper($client->passport_number) }}</td>
                    <td>{{ strtoupper($visaCountry) }}</td>
                    <td>{{ strtoupper($visaType) }}</td>
                    <td>{{ $currency }}{{ number_format($visaFee, 2) }}</td>
                    <td>{{ $currency }}{{ number_format(is_numeric($invoiceData?->service_charge ?? 0) ? (float)($invoiceData?->service_charge ?? 0) : 0, 2) }}</td>
                    <td>{{ $currency }}{{ $price }}</td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    
    <h4 style="text-align: right; margin-top: 15px;"><strong>Total: <span class="text-light-blue">{{ $currency }}{{ $price }}</span></strong></h4>

    <div style="margin-top: 20px;">
        <h4><strong>Payment Details</strong></h4>
        <table class="table">
            <thead>
                <tr>
                    <th>PAYMENT MODE</th>
                    <th>AMOUNT</th>
                    <th>DATE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{strtoupper($invoiceData?->payment_type ?? 'Cash')}}</td>
                    <td>{{ $price }}</td>
                    <td>{{$booking->created_at->format('Y-m-d')}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="terms-section">
        <h4>Terms and Conditions</h4>
        <ul>
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
    </div>

    <div class="signature-section">
        <p><strong>Yours Sincerely,</strong></p>
        <div class="signature-line">
            <strong>{{$booking->agency->name ?? 'Authorized Signatory'}}</strong><br>
            Authorized Signatory
        </div>
    </div>

    <div style="margin-top: 50px; text-align: center; color: #666; font-size: 12px; padding-top: 20px; border-top: 1px solid #26ace2;">
        <section class="footer">
            <div class="row" style="display: flex; justify-content: space-between; margin: 0;">
                <div class="col-md-6" style="flex: 1; text-align: left;">
                    <img src="bottom.png" style="height: 40px; width: auto;" alt="">
                </div>
                <div class="col-md-6" style="flex: 1; text-align: right;">
                    <img src="https://seeklogo.com/images/I/information-commissioners-office-logo-1743AEAE1C-seeklogo.com.png" style="height: 40px; width: auto;" alt="">
                </div>
            </div>
        </section>
    </div>

    <div class="button-section no-print">
        <button onclick="printInvoice()" class="print-button">
            <i class="fas fa-print"></i> Print Invoice
        </button>
    </div>
</div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function printInvoice() {
        window.print();
    }
    </script>
</body>
</html>