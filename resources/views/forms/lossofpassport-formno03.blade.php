<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Loss of Passport - Form No. 03</title>
  <style>
    @media print {
      @page {
        size: A4;
        margin: 10mm;
      }
      body {
        margin: 0;
      }
      .print-button {
        display: none;
      }
    }

    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      font-family:'Times New Roman', Georgia, serif;
      line-height: 1.6;
      font-size: 14px;
      display: flex;
      justify-content: center;
      align-items: center;
      background: #fff;
    }

    .print-button {
      position: fixed;
      top: 20px;
      right: 20px;
      background: #007bff;
      color: #fff;
      border: none;
      padding: 8px 14px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
      z-index: 1000;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .print-button:hover {
      background: #0056b3;
    }

    .container {
      width: 90%;
      max-width: 800px;
      margin: auto;
    }

    .form-group {
      margin: 15px 0;
    }

    input[type="text"] {
      border: none;
      border-bottom: 1px solid black;
      width: 200px;
      padding: 2px;
      outline: none;
      background: transparent;
    }

    .long-line {
      display: block;
      width: 100%;
      border-bottom: 1px solid black;
      height: 20px;
      margin: 6px 0;
    }

    .input-wide {
      width: 400px;
    }

    .underline {
      display: inline-block;
      border-bottom: 1px solid black;
      width: 150px;
      margin: 0 5px;
    }

    .multi-line {
      border: none;
      height: 80px;
      width: 100%;
      margin-top: 8px;
      margin-bottom: 10px;
    }

    .section-title {
      text-align: right;
      font-weight: bold;
      margin-right: 230px;
      font-size: 11px;
    }

    .signature-line {
      margin-top: 50px;
    }
  </style>
</head>
<body>

  <button class="print-button" onclick="window.print()">Print Form</button>

  @php
    $client = $clientData->clint ?? null;
    $info = $client && isset($client->clientinfo) ? $client->clientinfo : null;
    $applicantName = $client->client_name ?? '';
    $residenceAddress = $client->address ?? ($client->permanent_address ?? '');
    $city = $client->city ?? '';
    $passportNumber = $info->passport_ic_number ?? '';
    $placeOfIssue = $info->passport_issue_place ?? '';
    $dateOfIssue = $info->passport_issue_date ?? '';
  @endphp

  <div class="container">
   <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
  <h4 style="margin: 0;">Letter to show that police is informed about loss of passport</h4>
  <div style="font-weight: normal; font-size: 12px; margin-right: 100px;" >FORM NO: 03</div>
</div>


    <p>To:<br><br>
    The Consulate General of India,<br><br>
    Birmingham.</p>

    <p>Sir,</p>

    <p>This is to inform you that my Indian Passport No. <input type="text" class="input-wide" value="{{ $passportNumber }}"> issued at <br><input type="text" value="{{ $placeOfIssue }}"> on <input type="text" value="{{ $dateOfIssue }}"> has been stolen/ lost on <br> <input type="text" value="{{ date('d/m/Y') }}">.</p>

    <p>This fact has been reported to the following police station:</p>

    <div class="form-group">
      Name of Police Station: <input type="text" style="width: 55%;">
    </div>

    <div class="form-group">
      Full Address:
      <input type="text" style="width: 64%;" value="{{ $residenceAddress }}"><br>
      <input type="text" style="width: 75%;"><br>
      <input type="text" style="width: 75%;">
    </div>

    <div class="form-group">
      Telephone Number of Police Station: <input type="text" style="width: 47%;"> <br>
      Fax No. Of Police Station: <input type="text" style="width: 55%;">
    </div>

    <div class="form-group">
      Date of Report: <input type="text" value="{{ date('d/m/Y') }}"> &nbsp;&nbsp;&nbsp;
      Report Number: <input type="text" style="width: 22%;">
    </div>

    <p>Please attach a copy of the Police Report. Also write in brief circumstances under which the<br> passport was stolen/ lost/ damaged.</p>

    <div class="signature-line">
      Signature and name of the Applicant: <input type="text" value="{{ $applicantName }}" style="width: 300px; margin-left: 10px;">
    </div>
  </div>

</body>
</html>
