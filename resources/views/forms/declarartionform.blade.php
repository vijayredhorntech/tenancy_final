<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Declaration Form</title>
  <style>
    @media print {
      @page {
        size: A4;
        margin: 15mm 20mm 15mm 20mm; /* top, right, bottom, left - equal horizontal margins */
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
      font-family: Arial, sans-serif;
      font-size: 14px;
      line-height: 1.4;
      display: flex;
      justify-content: center;
      background: white;
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
      display: flex;
      flex-direction: column;
      width: 170mm; /* A4 width (210mm) - 20mm*2 = 170mm usable width */
      padding: 0;
      box-sizing: border-box;
    }

    h2 {
      text-align: center;
      text-decoration: underline;
      margin: 12px 0;
      font-size: 19px;
      margin-right: 100px;
      font-weight: bold;
    }

    .content {
      text-align: justify;
    }

    .bold {
      font-weight: bold;
    }

    .relation-bold {
      font-weight: bold;
      color: #000;
    }

    input[type="text"] {
      border: none;
      border-bottom: 1px dashed black;
      font-family: inherit;
      font-size: 13px;
      outline: none;
      font-weight: bold;
      color: #000;
    }

    .wide-input {
      width: 150px;
    }

    .signature {
      margin-top: 30px;
    }

    .signature-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .signature-row label {
      display: flex;
      align-items: center;
      font-size: 13px;
    }

    .signature-row input {
      width: 160px;
      margin-left: 8px;
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
  @endphp

  <div class="container">
    <h2>DECLARATION</h2>

    <div class="content">
      <p>
        I <input type="text" class="wide-input relation-bold" value="{{ $applicantName }}"> hereby declare that I am present in the UK on the date <br>
        of making this application and that all the information given by me here is true, accurate and <br>
        complete.
      </p>

      <p>
        I understand that my visa application is being handled through VF Services (UK) Limited (VFS), <br>
        service providers in the United Kingdom appointed by High Commission of India, London. I am <br>
        aware that the grant or refusal of Service is at the sole discretion of the High Commission of India <br>
        and VFS is not responsible for the same or for any delay in the receipt of the Service. The <br>
        processing of your application including processing time is subject to the procedures and <br>
        timescales of the Indian High Commission over which VFS has no control. I hereby agree to the VF <br>
        Services (UK) Terms and Conditions including Disclaimer and VFS Data Protection Policy current <br>
        at the date of my application (downloadable from http://in.vfsglobal.co.uk). I accept that application <br>
        fees are not refundable, except as covered by VFS's refund policy and are payable even if service <br>
        is not granted. I accept that VFS limits its liability for replacement of lost passports or other travel <br>
        documents, to refund of my application fee, and reimbursement of government fees in accordance <br>
        with the VFS refund policy. I am responsible for the accuracy of my application form, and I accept <br>
        that if VFS checks my application form, it does not guarantee that it will find any errors, and does <br>
        not verify information I have provided. I accept that VFS excludes all other liability in relation to my <br>
        application and advice or information given to me, including for breach of contract or negligence.
      </p>

      <p>
        I acknowledge and agree that my application and associated data will be processed in accordance <br>
        with the VFS Data Protection Policy (downloadable from http://in.vfsglobal.co.uk), and that my <br>
        data may be processed by an affiliated company which may be a part of the VFS group of <br>
        companies or a sub-contractor for VFS, and that such processing may take place in India but <br>
        subject to the same standards as apply in the United Kingdom.
      </p>

      <p>
        Suppression of facts or furnishing misleading/false information will result in denial of service <br>
        without assigning any reason. The Embassy Fee/Service Fee/Logistic Fee once tendered is non-<br>
        refundable and subject to change without notice. It is advisable to make travel arrangements after <br>
        obtaining appropriate travel document and I understand that VFS shall not be responsible for any <br>
        loss of bookings made in anticipation of obtaining the service (OCI/Passport/Visa/Surrender of <br>
        Indian Passport).
      </p>

      <p class="bold">
        I agree and acknowledge that VFS will not be able to assist me in tracking or escalating any <br>
        misplaced Royal Mail self-addressed envelope which I have provided with my application. I <br>
        agree and take responsibility of the Royal Mail envelope, its Tracking number and payment <br>
        receipt. I further confirm that in an event of lost/damaged/delayed/misplaced or untraceable <br>
        self-addressed Royal Mail envelope, I will be solely responsible in tracking and taking up <br>
        the matter with Royal Mail without any assistance from VFS.
      </p>
    </div>

    <div class="signature">
      <div class="signature-row">
        <label>PLACE & DATE:<input type="text" class="relation-bold" style="width: 40%;" value="{{ $city }}, {{ date('d/m/Y') }}"></label>
        <label>Signature of the Applicant:<input type="text" class="relation-bold" style="width: 30%;" value="{{ $applicantName }}"></label>
      </div>
    </div>
  </div>

</body>
</html>
