<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Letter of Authorisation</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      background: #fff;
      line-height: 1.6;
    }

    .container {
      max-width: 800px;
      width: 90%;
      margin: auto;
    }

    h2 {
      text-align: center;
      text-decoration: underline;
    }

    input[type="text"], input[type="date"] {
      border: none;
      border-bottom: 1px solid black;
      width: 300px;
      outline: none;
      background: transparent;
    }

    .full-width {
      width: 70%;
    }

    .signature {
      margin-top: 50px;
    }

    .input-line {
      display: inline-block;
      border-bottom: 1px solid black;
      width: 300px;
      height: 20px;
      vertical-align: middle;
    }

    .print-button {
      position: fixed;
      top: 16px;
      right: 16px;
      background: #007bff;
      color: #fff;
      border: none;
      padding: 8px 14px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .print-button:hover { background: #0056b3; }

    @media print {
      .print-button { display: none; }
    }
  </style>
</head>
<body>

  <button class="print-button" onclick="window.print()">Print Form</button>

  @php
    $client = $clientData->clint ?? null;
    $info = $client && isset($client->clientinfo) ? $client->clientinfo : null;
    $fullName = $client->client_name ?? trim((($client->first_name ?? '') . ' ' . ($client->last_name ?? '')));
    $dob = $client->date_of_birth ?? null;
    $dobDay = $dob ? date('d', strtotime($dob)) : '';
    $dobMonth = $dob ? date('m', strtotime($dob)) : '';
    $dobYear = $dob ? date('Y', strtotime($dob)) : '';
  @endphp

  <div class="container">
    <h2>Letter of Authorisation</h2><br>

    <p>Date: <input type="text" style="width: 10%;" value="{{ date('d/m/Y') }}"></p>

    <p>Dear Sir/Madam,</p>

    <p>
      This letter is to confirm that I, 
      <input type="text"  style="width: 58%;" value="{{ $fullName }}"><br>
      (Full Name of Applicant)
    </p>

    <p>
      Date of birth <input type="text" style="width:30px;" value="{{ $dobDay }}"> /
      <input type="text" style="width:30px;" value="{{ $dobMonth }}"> /
      <input type="text" style="width:30px;" value="{{ $dobYear }}">
      &nbsp; Passport number <input type="text" style="width:140px;" value="{{ $info->passport_ic_number ?? '' }}"> 
      &nbsp;authorise my nominee
    </p>

    <p>
      (Name of the authorised nominee with full details) 
      <input type="text" style="width: 40%;"><br>
      <input type="text"  style="width: 85%;"><br>
      <input type="text"  style="width: 85%;">
    </p>

    <p>
      to submit and collect my processed passport for Indian Visa from 
      <strong>India Visa Application Centres</strong> <br>operated by VFS.
    </p>

    <br><br>
    <p>Yours faithfully,</p>

    <div class="signature">
      <p><input type="text"> <i>(Applicant’s Signature)</i></p>
      <p><input type="text" value="{{ $fullName }}"> <i>(Applicant’s Name)</i></p>
    </div>
  </div>

</body>
</html>
