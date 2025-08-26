<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Specimen Affidavit</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    @media print {
      @page {
        size: A4;
        margin: 10mm;
      }
      body {
        zoom: 90%;
      }
      .print-button {
        display: none;
      }
    }

    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      display: flex;
      justify-content: center;
      align-items: center;
      background: #fff;
    }

    .container {
      max-width: 800px;
      width: 90%;
      margin: auto;
      padding: 40px;
    }

    h3 {
      text-align: center;
      font-weight: bold;
      text-decoration: underline;
    }

    input[type="text"] {
      border: none;
      border-bottom: 1px solid black;
      width: 250px;
      outline: none;
    }

    .full-width {
      width: 100%;
    }

    p {
      text-align: justify;
    }

    .section {
      margin-top: 20px;
    }

    .note {
      margin-top: 30px;
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
  @endphp

  <div class="container">
    <h3>SPECIMEN AFFIDAVIT FOR RE-ISSUE OF PASSPORT THE VALIDITY<br>OF WHICH HAS EXPIRED FOR MORE THAN ONE YEAR</h3>

    <p>
      I <input type="text" style="width: 62%;" value="{{ $applicantName }}"> son/daughter/wife of<br> 
      <input type="text" style="width: 48%;" value="{{ $fatherName }}"> and presently residing at (full address) <br>
      <input type="text" style="width: 81%;" value="{{ $residenceAddress }}"> do <br>
      solemnly affirm and state as follows:
    </p>
    <div class="section">
     <span style="margin-left: 50px;"> (a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am a citizen of India and holder of Passport No. 
       <input type="text" style="width: 28%;" value="{{ $info->passport_ic_number ?? '' }}"> </span><br>  <span style="margin-left: 50px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dated 
      <input type="text" style="width: 20%;"> issued at 
      <input type="text" style="width: 20%;"> whose validity has </span><br>
       <span style="margin-left: 50px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;expired on <input type="text">.</span>
    </div>

    <div class="section">
       <span style="margin-left: 50px;">(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; I have made an application on <input type="text" style="width: 35%;"> to the High</span><br>  <span style="margin-left: 50px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Commission of India, London for issue of a new Passport.</span>
    </div>

    <div class="section">
       <span style="margin-left: 50px;">(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; I have neither acquired nor applied for any other nationality nor do I hold any </span><br> <span style="margin-left: 50px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;other travel document of any description.
      I continue to remain a citizen of </span><br> <span style="margin-left: 50px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;India since the date of my arrival in this country.</span>
    </div>

    <div class="section">
      <span style="margin-left: 50px;">(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; After the expiry of the above-mentioned passport I had no occasion to leave </span><br>  <span style="margin-left: 50px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;the United Kingdom and had not, therefore, considered it necessary to apply </span><br> <span style="margin-left: 50px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for new passport earlier.
      I was also not aware of the fact that I should have </span><br> <span style="margin-left: 50px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;held a valid passport at all times.</span>
    </div>

    <br><br>
    <p>
      Declared at: <input type="text" value="{{ $city }}"> <br><br>
      Date: <input type="text" value="{{ date('d/m/Y') }}">
    </p>

    <br>
    <p style="text-align:right; margin-right: 50px;">(Signature of Applicant)</p>

    <br>
    <p>(Sign and Seal of the Notary Public)</p>

    <div class="note">
      <p><strong>Note:</strong> The Affidavit can be sworn before /attested by a Notary Public or can be sworn<br>
      before/attested by the passport officer at High Commission of India, London.</p>
    </div>
  </div>
</body>
</html>
