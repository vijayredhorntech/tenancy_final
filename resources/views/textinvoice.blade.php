<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        @media print {
            .no-print { display: none; }
            body { margin: 0; padding: 0; }
            .container { width: 100%; max-width: 100%; }
        }

        body {
            background-color: #f5f5f5;
            padding: 20px;
            font-family: 'Verdana', sans-serif;
            font-size: 14px;
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
    <div class="outer-div">
        <div class="outer-div-inner container">
            <!-- Header -->
            <div class="header-section">
                <div style="text-align: center; margin-bottom: 20px;">
                    <div style="width: 200px; height: 50px; background-color: #26ace2; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 600; font-size: 18px;">
                        CLOUD TRAVEL
                    </div>
                </div>
            </div>

            <!-- Invoice Title and Info -->
            <div class="invoice-title">Invoice</div>

            <div class="invoice-info">
                <div class="invoice-info-box"></div>
                <div class="invoice-info-right">
                    <table style="width: 100%; border: none;">
                        <tr>
                            <td style="border: none; font-weight: bold; padding: 5px;">Invoice Date :</td>
                            <td style="border: none; padding: 5px;">15 October 2024</td>
                        </tr>
                        <tr>
                            <td style="border: none; font-weight: bold; padding: 5px;">Invoice No :</td>
                            <td style="border: none; padding: 5px;">INV-2024-001</td>
                        </tr>
                        <tr>
                            <td style="border: none; font-weight: bold; padding: 5px;">Client ID :</td>
                            <td style="border: none; padding: 5px;">CLD-0001</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- To/From Section -->
            <div class="to-from-section">
                <div class="to-section">
                    <h3>To</h3>
                    <p>
                        JOHN SMITH<br>
                        123 MAIN STREET<br>
                        LONDON<br>
                        ENGLAND<br>
                        SW1A 1AA<br>
                        <strong>TEL:</strong> +44 20 7946 0958
                    </p>
                </div>
                <div class="from-section">
                    <h3>Issued By</h3>
                    <p>
                        62 KING STREET,<br>
                        SOUTHALL,<br>
                        MIDDLESEX,<br>
                        UB2 4DB<br>
                        <strong>TEL:</strong> 02035000000<br>
                        <strong>E-MAIL:</strong> info@cloudtravels.co.uk
                    </p>
                </div>
            </div>

            <!-- Flight Section -->
            <div class="section-header">✈ Flight</div>

            <h4 style="margin-top: 20px;"><strong>1. Passenger Details</strong></h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>S#</th>
                        <th>Pax Type</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Adult</td>
                        <td>John</td>
                        <td>Smith</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Adult</td>
                        <td>Sarah</td>
                        <td>Smith</td>
                    </tr>
                </tbody>
            </table>
            <p><em>Note - * denotes the lead passenger</em></p>

            <h4 style="margin-top: 20px;"><strong>FLIGHT DETAILS (ROUND TRIP)</strong></h4>
            <p>AIRLINE REF: EK-123456 | PNR: ABC123 | UN PNR: ABC123XY | E-TICKET: 1234567890123 | BOOKING DATE: 14/10/2024</p>

            <table class="table">
                <thead>
                    <tr>
                        <th>Airline</th>
                        <th>Departure</th>
                        <th>Arrival</th>
                        <th>Class</th>
                        <th>Baggage</th>
                        <th>Duration</th>
                        <th>Stops</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>EMIRATES EK-001</td>
                        <td>London Heathrow (LHR)<br>20/10/2024 10:30 AM<br>Terminal: 3</td>
                        <td>Dubai (DXB)<br>20/10/2024 08:45 PM<br>Terminal: 1</td>
                        <td>Economy</td>
                        <td>23 kg</td>
                        <td>7h 15m</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>EMIRATES EK-002</td>
                        <td>Dubai (DXB)<br>25/10/2024 11:00 AM<br>Terminal: 1</td>
                        <td>London Heathrow (LHR)<br>25/10/2024 02:15 PM<br>Terminal: 3</td>
                        <td>Economy</td>
                        <td>23 kg</td>
                        <td>7h 15m</td>
                        <td>0</td>
                    </tr>
                </tbody>
            </table>
            <h4 style="text-align: right; margin-top: 15px;"><strong>Total: <span class="text-light-blue">GBP 2,450.00</span></strong></h4>

            <!-- Hotel Section -->
            <div class="section-header">🏨 Hotel</div>

            <table class="table">
                <thead>
                    <tr>
                        <th>S#</th>
                        <th>Guest Name</th>
                        <th>Hotel City</th>
                        <th>Hotel Name</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Rooms</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Smith</td>
                        <td>Dubai</td>
                        <td>Burj Al Arab</td>
                        <td>20/10/2024</td>
                        <td>24/10/2024</td>
                        <td>1</td>
                        <td><strong>GBP 800.00</strong></td>
                    </tr>
                </tbody>
            </table>
            <h4 style="text-align: right; margin-top: 15px;"><strong>Total: <span class="text-light-blue">GBP 800.00</span></strong></h4>

            <!-- Summary Section -->
            <div class="summary-section">
                <div>
                    <h4 style="font-weight: 600; margin-bottom: 15px;">Payment Information</h4>
                    <table class="table" style="font-size: 13px;">
                        <thead>
                            <tr>
                                <th>Payment Mode</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Credit Card</td>
                                <td>GBP 2,450.00</td>
                                <td>15/10/2024</td>
                            </tr>
                            <tr>
                                <td>Bank Transfer</td>
                                <td>GBP 800.00</td>
                                <td>15/10/2024</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div>
                    <h4 style="font-weight: 600; margin-bottom: 15px;">Invoice Summary</h4>
                    <div class="summary-item">
                        <span>Sub Total:</span>
                        <strong>GBP 3,250.00</strong>
                    </div>
                    <div class="summary-item">
                        <span>ATOL Charges:</span>
                        <strong>GBP 5.00</strong>
                    </div>
                    <div class="summary-item">
                        <span>Discount:</span>
                        <strong>GBP 0.00</strong>
                    </div>
                    <div class="summary-item">
                        <span>VAT @ 20%:</span>
                        <strong>GBP 651.00</strong>
                    </div>
                    <div class="summary-item total-row">
                        <span>Total Amount:</span>
                        <strong>GBP 3,906.00</strong>
                    </div>
                    <div class="summary-item">
                        <span>Paid:</span>
                        <strong>GBP 3,250.00</strong>
                    </div>
                    <div class="summary-item" style="color: #dc3545; font-weight: 600;">
                        <span>Balance Due:</span>
                        <strong>GBP 656.00</strong>
                    </div>
                </div>
            </div>

            <!-- Remarks -->
            <div style="margin-top: 40px;">
                <h4><strong>Remarks:</strong></h4>
                <p>Thank you for choosing Cloud Travel. Please ensure all travel documents are valid before departure. Reconfirmation of return journey is passenger's responsibility.</p>
            </div>

            <!-- Terms and Conditions -->
            <div class="terms-section">
                <h4>Terms and Conditions</h4>
                <ul>
                    <li><strong>This sale is covered by ATOL number 11867.</strong></li>
                    <li>There is no liability if airline(s) cease to trade, unless Scheduled Airline Failure Insurance (SAFI) has been paid.</li>
                    <li>Passengers travelling to/via USA/CANADA will require an ESTA at least 72 hours prior to travel.</li>
                    <li>Valid travel documentation such as valid passport, visa, and health precautions are passengers' responsibility.</li>
                    <li>Timings are subject to change, please reconfirm with your airline operator before you fly.</li>
                    <li>Any reissue/revalidation/cancellation will incur a fee.</li>
                    <li><strong>Your Financial Protection:</strong> When you buy an ATOL protected flight or flight inclusive holiday from us you will receive an ATOL Certificate.</li>
                </ul>
                <p><strong>Note/Disclaimer:</strong> It is the sole responsibility of the passenger to ensure his/her eligibility to enter the destination country. Cloud Travel accepts no liability in this regard.</p>
            </div>

            <!-- Signature -->
            <div class="signature-section">
                <p><strong>Yours Sincerely,</strong></p>
                <div class="signature-line">
                    <strong>Cloud Travel</strong><br>
                    Authorized Signatory
                </div>
            </div>

            <!-- Footer -->
            <div style="margin-top: 50px; text-align: center; color: #666; font-size: 12px; padding-top: 20px; border-top: 1px solid #26ace2;">
                <p>62 King Street, Southall, Middlesex, UB2 4DB | Tel: 02035000000 | Email: info@cloudtravels.co.uk</p>
                <p>ATOL Number: 11867 | Company Registration: 1234567</p>
                <p><em>This document is confidential and intended for the addressee only.</em></p>
            </div>

            <!-- Print Button -->
            <div class="button-section no-print" style="margin-top: 20px;">
                <button class="print-button" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Invoice
                </button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>