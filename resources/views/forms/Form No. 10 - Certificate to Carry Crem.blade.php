<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form No. 10 - Certificate to Carry Cremated Remains</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      font-size: 12pt;
      background: #fff;
    }

    @page {
      size: A4;
      margin: 20mm 25mm 20mm 25mm;
    }

    @media print {
      body {
        width: 100%;
        margin: 0;
        padding: 0;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }

      .container {
        width: 100%;
        max-width: 100%;
        margin: 0;
      }

      input {
        border-color: black !important;
      }

      .print-button {
        display: none;
      }
    }

    .container {
      width: 90%;
      max-width: 800px;
      margin: auto;
    }

    .center {
      text-align: center;
    }

    .right {
      float: right;
    }

    .form-line {
      margin-bottom: 15px;
    }

    input[type="text"], input[type="date"] {
      border: none;
      border-bottom: 2px solid black;
      padding: 4px;
      width: 200px;
      outline: none;
      background: transparent;
    }

    .blue-underline {
      border-bottom: 2px solid blue !important;
      background: transparent;
    }

    .long-input {
      width: 350px;
    }

    .full-width-input {
      width: 100%;
    }

    .form-row {
      margin-top: 30px;
    }

    .form-row input[type="text"] {
      width: 150px;
    }

    .header-container {
      position: relative;
      text-align: center;
      margin-bottom: 20px;
    }

    .header-container img {
      position: absolute;
      left: 0;
      top: 0;
      height: 110px;
    }

    .header-text {
      font-weight: normal;
      display: inline-block;
      line-height: 1.5;
      font-size: 14px;
    }

    .signature {
      margin-top: 60px;
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
      z-index: 1000;
    }

    .print-button:hover { background: #0056b3; }
  </style>
</head>
<body>
  <button class="print-button" onclick="window.print()">Print Form</button>

  @php
    $client = $clientData->clint ?? null;
    $info = $client && isset($client->clientinfo) ? $client->clientinfo : null;
    $fileNo = $client->clientuid ?? '';
    $fullName = $client->client_name ?? '';
    $city = $client->city ?? '';
    $country = $client->country ?? '';
    $addressLine = trim(($client->address ?? '').' '.($client->city ?? '').' '.($client->zip_code ?? ''));
  @endphp

  <div class="container">
     <p style="text-align: right; font-size: 12px; margin-right: 80px;"> FORM NO-10</p>
    <div class="header-container">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Emblem_of_India.svg/250px-Emblem_of_India.svg.png" alt="Emblem of India">
      <div class="header-text">
        <strong>Consulate General of India</strong><br>
        2 Darnley Road<br>
        Birmingham B16 8TE<br>
        www.cgibirmingham.gov.in
      </div>
    </div>
<br>
<br>
    <div class="form-row">
     <span style="margin-left: 50px;"> File No. <input type="text" class="blue-underline" style="width:120px;" value="{{ $fileNo }}"> </span>
      <span class="right" style="margin-right: 95px;">Dated: <input type="text" class="blue-underline" style="width: 120px;" value="{{ date('d/m/Y') }}"></span>
    </div>

    <h3 class="center" style="margin-top: 60px; font-weight: normal; font-size: 13px;"><u>TO WHOM IT MAY CONCERN</u></h3>
    <span style="font-family: 'Times New Roman', serif; font-weight: bold; font-size: 20px;">
          <h4 style="text-align: center;"> Subject: Certificate to carry cremated remains (ashes)</h4>
</span>


    <p style="font-size: 14px;">
      On the basis of Death Certificate No. <strong><input type="text"></strong> dated <b><input type="text"></b> of the Registrar,<br>
      Registration District <b><input type="text" style="width: 250px;" value="{{ $city }}"></b>, Administrative area <b><input type="text" style="width: 270px;" value="{{ $country }}"></b>,<br>
      ,<input type="text" style="width: 290px;" value=""> is to certify that Mr./Mrs. <input type="text" style="width: 300px;" value="{{ $fullName }}"> died <br>at the age of 
      <input type="text" style="width: 100px;"> at <input type="text" style="width: 570px;" value="{{ $addressLine }}">,<br>
      <input type="text" style="width: 150px;"> on <input type="text" style="width: 150px;">.
    </p>

    <p style="font-size: 14px;">
      2. According to the Cremation Certificate bearing Cremation No. <input type="text" style="width: 160px;"> dated <input type="text" style="width: 160px;"><br>
      issued by <input type="text" style="width: 370px;">, the mortal remains of the deceased were cremated on <br>
      <input type="text">.
      M/s <input type="text" style="width: 170px;"> Funeral Directors have certified that the cremated ashes of <br>late
      Mr./Mrs. <input type="text" class="long-input" value="{{ $fullName }}"> have been kept in a container, duly packed.
    </p>

    <p style="font-size: 14px;">
      3. It is now proposed to send the Urn, which should contain only the cremated remains of late<br>
      Mr./Mrs. <input type="text" class="long-input" value="{{ $fullName }}"> to India.
    </p>
    <br>

    <div class="signature">
      <p class="right"><b>Signature of Consular Officer</b></p>
    </div>

  </div>
</body>
</html>
