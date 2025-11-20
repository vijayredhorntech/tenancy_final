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
               
    .page-break-before {
        page-break-before: always !important;
    }
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
            background-color: #d0dfea;
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

            table.paymenttable {
                width: 50%;
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
            <div style="text-align: left; margin-bottom: 0px; ">
                <img src="{{asset('assets/images/header.jpeg')}}" width="100%" >
            </div>
      


    
    @php
    use Carbon\Carbon;
    use Illuminate\Support\Str;



  
    $invoice = $booking->deduction; // Get the deduction from visa booking
 
    $invoiceData = $invoice->invoice ?? null; // Get updated invoice data

    $otherClientInfo = $booking->otherclients ?? [];
    // Use updated invoice data if available, otherwise fall back to original data
    $agencyName = $booking->agency->name ?? '';
    $clientPhone = $invoiceData?->visa_applicant ?? ($booking->clint->phone_number ?? 'N/A');
    $clientEmail = $booking->clint->email ?? 'N/A';
    $clientAddress = $invoiceData?->address ?? ($booking->clint->permanent_address ?? '');

    
    // Get passport and visa details
    $passportOrigin = $booking->origin->countryName ?? 'N/A';
    $passportNumber = $booking->clint->passport_number ?? 'N/A';
    $passportDob = $booking->clint->date_of_birth ?? 'N/A';
    $visaCountry = $booking->destination->countryName ?? 'N/A';
    $visaName=$booking->visa->name ?? 'N/A';
    $visaType = $booking->visasubtype->name ?? 'N/A';
    
  
   /**  
   $visaFee = is_numeric($invoiceData?->visa_fee ?? $booking->visasubtype->price ?? 'N/A') ? (float)($invoiceData?->visa_fee ?? $booking->visasubtype->price ?? 0) : 0.00; 
  */

  $visaFee = (float) (
    ($invoiceData?->service_charge > 0)
        ? $invoiceData->service_charge
        : ($booking->visasubtype->price ?? 0)
);

 $serviceCharge = (float) (
    ($invoiceData?->service_charge > 0)
        ? $invoiceData->service_charge
        : ($booking->visasubtype->commission ?? 0)
);

$vatPercent=(float)($booking->visasubtype->commission ?? 0);


$amountBase = ($visaFee + $serviceCharge);

$vatCharge = ($amountBase * $vatPercent) / 100;





    $paymentMode = $invoiceData?->payment_type ?? 'CASH';
    $currency = '£'; // Default currency

        $client = $booking->clint;

        $fullAddress = $client->address ?? $client->permanent_address ?? '';
        $parts = array_map('trim', explode(',', $fullAddress));
        $detectedCounty = $parts[3] ?? $parts[2] ?? 'County Missing';
   
        // Build a clean formatted address
        $toParts = [
            'street'   => $client->street ?? 'Street Missing',
            'city'     => $client->city ?? 'City Missing',
            'county'   => $detectedCounty ?? 'County Missing',
            'postcode' => $client->zip_code ?? 'Postcode Missing',
            'country'  => $client->country ?? 'Country Missing',
        ];

        // If street is empty but address exists → extract first part
        if (empty($toParts['street']) && !empty($client->address)) {
            $addressParts = array_filter(array_map('trim', explode(',', $client->address)));
            $toParts['street'] = $addressParts[0] ?? 'Street Missing';
        }

  

        // ========== ISSUED BY ADDRESS FORMAT ==========
      // === AGENCY DETAILS STRUCTURED ===
$agency = $booking->agency;
$agencyDetails = $booking->agency->details ?? null;

// RAW ADDRESS (fallback)
$rawAgencyAddress = $booking->agency->address ?? '';

// 1. Split raw address into parts
$parts = array_map('trim', explode(',', $rawAgencyAddress));


// 2. Detect county from raw address (3rd or 4th part)
$detectedCounty = $parts[3] ?? $parts[2] ?? 'County Missing';

// 3. Build final structured array
    $issuedBy = [
        'street'   => $agencyDetails->state 
                        ?? ($parts[0] . ', ' . ($parts[1] ?? 'Street Missing')),    
        'city'     => $agencyDetails->city 
                        ?? $parts[2] 
                        ?? 'City Missing',    
        'county'   => $agencyDetails->county 
                        ?? $detectedCounty 
                        ?? 'County Missing',
        'postcode' => $agencyDetails->zipcode ?? 'Postcode Missing',
        'country'  => $agencyDetails->country 
                        ?? 'United Kingdom',
    ];

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

    $subTotal = $visaFee + $serviceCharge + $vatCharge;
    

    $price = number_format($price, 2)+ $vatCharge;

    @endphp

    <div class="invoice-title">INVOICE</div>

    <div class="invoice-info">
        <div class="invoice-info-box"></div>
        <div class="invoice-info-right">
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="border: none; font-weight: bold;">Invoice Date :</td>
                    <td style="border: none;">{{$booking->created_at->format('d F Y')}}</td>
                </tr>
                <tr>
                    <td style="border: none; font-weight: bold;">Invoice No :</td>
                    <td style="border: none;">{{$booking->visaInvoiceStatus->invoice_number}}</td>
                </tr>
                <tr>
                    <td style="border: none; font-weight: bold;">Client ID :</td>
                 
             
                    <td style="border: none;">{{$booking->clint->clientuid ?? ''}}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="to-from-section" style="display: flex; justify-content: space-between; align-items: flex-start; gap: 40px; margin: 30px 0;">
    <!-- TO SECTION (Left) -->
    <div class="to-section" style="flex: 1; text-align: left;">
        <h3 style="font-size: 24px; font-weight: 600; color: #26ace2; margin-bottom: 10px;">To</h3>
        <p style="margin: 0;">
            {{ strtoupper($issuedBy['street']) }}<br>
            {{ strtoupper($issuedBy['city']) }}<br>
            {{ strtoupper($issuedBy['county']) }}<br>
            {{ strtoupper($issuedBy['postcode']) }}<br>
            {{ strtoupper($issuedBy['country']) }}<br>
            <!-- <strong>TEL:</strong> {{ $clientPhone }}<br>
            <strong>Email:</strong> {{ $clientEmail }} -->
        </p>
    </div>

    <!-- FROM SECTION (Right) -->
    <div class="from-section" style="flex: 1; text-align: right;">
        <h3 style="font-size: 24px; font-weight: 600; color: #26ace2; margin-bottom: 10px;">Issued By</h3>
          <div class="w-full ">
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
    </div>
</div>

    
    <div class="section-header">VISA SERVICES</div>
    
    <table class="table">
        <thead>
            <tr>
                <th>Agency Name</th>
                <th>COUNTRY</th>
                <th>VISA TYPE</th>
                <th>PASSENGER</th>
                <th>VISA FEES</th>
                <th>SERVICE CHARGE</th>
                <th>VAT CHARGE</th>
                <th>AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ strtoupper($agencyName) }}</td>
                <td>{{ strtoupper($passportOrigin) }} <br>
                        To <br>
                    {{ strtoupper($visaCountry) }}
                </td>

                <td>
                {{ strtoupper($visaName) }}<br>

                {{ strtoupper($visaType) }}
                  </td>
                 <td>{{ $currency }}{{ number_format($visaFee, 2) }}</td>
                <td>{{ $currency }}{{ number_format($visaFee, 2) }}</td>
                 <td>{{ $currency }}{{ number_format($serviceCharge, 2) }}</td>
                 <td>{{ $currency }}{{ number_format($vatCharge, 2) }}</td>




                <td>{{ $currency }}{{ $subTotal }}</td>
            </tr>
 
        </tbody>
    </table>
    
    <h4 style="text-align: right; margin-top: 15px;"><strong>Total: <span class="text-light-blue">{{ $currency }}{{ $price }}</span></strong></h4>



    <div class="terms-section page-break-before">
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