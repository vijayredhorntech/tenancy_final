<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Change of Appearance - Minor</title>
  <style>
    @media print {
      @page {
        size: A4;
        margin: 25mm 20mm 25mm 20mm; /* top, right, bottom, left */
      }
      body {
        margin: 0;
      }
      .print-button {
        display: none;
      }
    }

    body {
      font-family: Arial, sans-serif;
      width: 210mm;
      min-height: 297mm;
      margin: 0 auto;
      background: white;
      box-sizing: border-box;
      padding: 25mm 20mm;
      font-size: 12pt;
      line-height: 1.6;
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

    .no-box {
      border: none !important;
      outline: none !important;
      background: transparent !important;
      box-shadow: none !important;
    }

    .center {
      text-align: center;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .form-section {
      margin-top: 20px;
    }

    input[type="text"], textarea {
      width: 60%;
      border: none;
      border-bottom: 1px solid #000;
      font-size: 12pt;
      padding: 2px;
      margin-bottom: 12px;
      outline: none;
    }

    .signature {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .signature div {
      text-align: left;
      width: 30%;
    }

    .bottom-section {
      margin-top: 40px;
    }

    label {
      display: inline-block;
      margin-bottom: 4px;
      font-weight: normal;
    }

    p {
      margin: 0 0 10px;
    }
  </style>
</head>
<body>

  <button class="print-button" onclick="window.print()">Print Form</button>

  @php
    $client = $clientData->clint ?? null;
    $info = $client && isset($client->clientinfo) ? $client->clientinfo : null;
    $fatherdetails = $info && $info->father_details ? json_decode($info->father_details) : null;
    $motherdetails = $info && $info->mother_details ? json_decode($info->mother_details) : null;
    $applicantName = $client->client_name ?? '';
    $fatherName = $fatherdetails->name ?? '';
    $motherName = $motherdetails->name ?? '';
    $residenceAddress = $client->address ?? ($client->permanent_address ?? '');
    $city = $client->city ?? '';
    $passportNumber = $info->passport_ic_number ?? '';
    $placeOfIssue = $info->passport_issue_place ?? '';
    $dateOfIssue = $info->passport_issue_date ?? '';
  @endphp

  <div class="center">
    Declaration for Change of Appearance for Minor Applicants
  </div>
  <div class="form-section">
    <p>To,</p>
    <p>The High Commission of India, London or its respective Consulates in Birmingham or Edinburgh,</p><br>

    <p>Dear Sir/Madam,</p>

    <p>
      I/We solemnly and sincerely declare that our/my child has changed appearance due to growing age. 
      He/she is the same person with the changed appearance.
    </p><br>

    <label>Previous Indian Passport Number:</label>
    <input type="text" style="width: 40%;" value="{{ $passportNumber }}"><br><br>

    <label>Place of Issue:</label>
    <input type="text" style="width: 62%;" value="{{ $placeOfIssue }}"><br><br>

    <label>Date of Issue:</label>
    <input type="text" style="width: 63%;" value="{{ $dateOfIssue }}"><br><br>

    <div class="signature">
      <div>
        <p>Signature</p><br><br>
        <p>Father: <input type="text" class="no-box" value="{{ $fatherName }}" style="width: 100%; margin-top: 5px;"></p>
      </div>
      <div>
        <p>Signature</p><br><br>
        <p>Mother: <input type="text" class="no-box" value="{{ $motherName }}" style="width: 100%; margin-top: 5px;"></p>
      </div>
    </div>

    
    <label>Address:</label>
    <input type="text" class="no-box" value="{{ $residenceAddress }}"><br><br>

    <label>Place:</label>
    <input type="text" class="no-box" value="{{ $city }}"><br><br>

    <label>Date:</label>
    <input type="text" class="no-box" value="{{ date('d/m/Y') }}"><br>
  </div>

</body>
</html>
