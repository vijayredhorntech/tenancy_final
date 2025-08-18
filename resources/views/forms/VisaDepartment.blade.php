<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Visa Application Form</title>
  <style>
    /* Core layout */
    body {
      font-family: Arial, sans-serif;
      margin: 0 auto;
      padding: 10px;
      max-width: 190mm;       /* Keeps the content within A4 width */
      box-sizing: border-box;
      line-height: 1.3;
      font-size: 12px;
    }

    /* A4 print settings */
    @media print {
      @page {
        size: A4;
        margin: 10mm;
      }
      body {
        margin: 0;
        padding: 0;
        max-width: 100%;       /* Let A4 page controls the layout */
      }
      .header-container {
        gap: 160px;
      }
      .print-button {
        display: none;
      }
    }

    .center {
      text-align: center;
      font-weight: bold;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }

    td {
      border: 1px solid black;
      padding: 4px;
      vertical-align: top;
      font-size: 12px;
    }

    input[type="text"], textarea {
      width: 100%;
      border: none;
      border-bottom: 1px solid black;
      font-size: 12px;
      box-sizing: border-box;
      padding: 2px;
      font-family: Arial, sans-serif;
      outline: none;
    }

    textarea {
      resize: vertical;
      height: 50px;
    }

    .inline-input {
      border: none;
      border-bottom: 1px solid black;
      width: 100px;
      padding: 2px;
      font-size: 12px;
    }

    .no-box {
      border: none !important;
      background: transparent;
      box-shadow: none;
    }

    .header-container {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      gap: 110px;              
      margin-top: 10px;
    }

    .header-text {
      font-weight: bold;
      text-align: center;
      line-height: 1.3;
      font-size: 19px;
    }

    .signature-section {
      margin-top: 30px;
    }

    .right {
      text-align: right;
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

  </style>
</head>

<body>
  <button class="print-button" onclick="window.print()">Print Form</button>

  <div class="header-container">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Emblem_of_India.svg/250px-Emblem_of_India.svg.png" alt="Indian Emblem" height="90">
    <div class="header-text">
      VISA DEPARTMENT<br><br>
      HIGH COMMISSION OF INDIA TO UK<br>
      TO: IND EMBASSY, BEIJING
    </div>
  </div>
<br>

  @php
    $client = $clientData->clint ?? null;
    $info = $client && isset($client->clientinfo) ? $client->clientinfo : null;
    $fatherdetails = $info && $info->father_details ? json_decode($info->father_details) : null;
    $spouse = $info && $info->spouse_details ? json_decode($info->spouse_details) : null;
    // helpers for compact address strings
    $domicileAddress = trim(($client->address ?? '').' '.($client->city ?? '').' '.($client->country ?? '').' '.($client->zip_code ?? ''));
    $lastVisitDuration = trim(($info->date_from ?? '').($info->date_from && $info->date_to ? ' to ' : '').($info->date_to ?? ''));
  @endphp

  <p>
    <strong>REF. NO.</strong>
    <input type="text" style="width: 200px;">
    <strong style="margin-left: 20px;">DATE:</strong>
    <input type="text" style="width: 200px;" value="{{ date('d/m/Y') }}">
  </p>
  <p>
    Additional Form to be filled in by Chinese nationals
  </p>

  <p class="center">(All in Block Letters)</p>

  <table>
    <tr><td>Full Name</td><td><input type="text" class="no-box" value="{{ $client->client_name ?? '' }}"></td></tr>
    <tr><td>Surname</td><td><input type="text" class="no-box" value="{{ $client->last_name ?? '' }}"></td></tr>
    <tr><td>Father’s full name</td><td><input type="text" class="no-box" value="{{ $fatherdetails->name ?? '' }}"></td></tr>
    <tr><td>Spouse’s name</td><td><input type="text" class="no-box" value="{{ $spouse->name ?? '' }}"></td></tr>
    <tr><td>Place of birth</td><td><input type="text" class="no-box" value="{{ $info->place_of_birth ?? '' }}"></td></tr>
    <tr><td>Date of birth</td><td><input type="text" class="no-box" value="{{ $client->date_of_birth ?? '' }}"></td></tr>
    <tr><td>Sex</td><td><input type="text" class="no-box" value="{{ $client->gender ?? '' }}"></td></tr>
    <tr><td colspan="2"> Chinese Passport No. <input type="text" class="no-box" style="width: 300px;" value="{{ $info->passport_ic_number ?? '' }}"> Date of Issue: <input type="text" class="no-box" style="width: 100px;" value="{{ $info->passport_issue_date ?? '' }}"></td>
    <tr><td>Place of issue</td><td><input type="text" class="no-box" value="{{ $info->passport_issue_place ?? '' }}"></td></tr>
    <tr><td>Date of expiry</td><td><input type="text" class="no-box" value="{{ $info->passport_expiry_date ?? '' }}"></td></tr>
    <tr><td>Since when residing in country of domicile</td><td><input type="text" class="no-box" value="{{ $info->date_from ?? '' }}"></td></tr>
    <tr><td>Address in the country of domicile</td><td><input type="text" class="no-box" value="{{ $domicileAddress }}"></td></tr>
    <tr><td>Present occupation</td><td><input type="text" class="no-box" value="{{ $info->present_occupation ?? '' }}"></td></tr>
    <tr><td>Duration of last visit to India</td><td><input type="text" class="no-box" value="{{ $lastVisitDuration }}"></td></tr>
    <tr><td>Whether visa was ever refused. If yes, please give details</td><td><input type="text" class="no-box"></td></tr>
    <tr><td>Address in China</td><td><input type="text" class="no-box" value="{{ $client->permanent_address ?? '' }}"></td></tr>
    <tr><td>Exact purpose of visit to India</td><td><input type="text" class="no-box" value="{{ $info->duty ?? '' }}"></td></tr>
    <tr><td>Duration</td><td><input type="text" class="no-box" value="{{ $lastVisitDuration }}"></td></tr>
    <tr><td>No. of visits proposed (Single, double, multiple)</td><td><input type="text" class="no-box"></td></tr>
  </table>

  <div class="signature-section">
    Signature: <input type="text" style="width: 200px;"><br><br>
    Date: <input type="text" style="width: 200px;" value="{{ date('d/m/Y') }}">
  </div>

  <p>The above applicant has applied for a visa on <input type="text" style="width: 380px;" value="{{ date('d/m/Y') }}">. Grateful for clearance.</p>
  <p class="left">
     Attache (Visa)<br><br>
    Ref: Beij(China)
  </p>

  <p class="right">
    w.e.f. 14/02/2006
  </p>
</body>
</html>
