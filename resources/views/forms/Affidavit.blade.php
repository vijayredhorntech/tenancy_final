<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AFFIDAVIT</title>
  <style>
  @media print {
    @page {
      size: A4;
      margin: 12mm;
    }
    body {
      margin: 0;
    }
    .print-button { display: none; }
  }

  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 12mm;
    line-height: 1.3; /* Tighter spacing */
    background-color: white;
    font-size: 14px; /* Slightly smaller font */
  }

  .container {
    max-width: 180mm;
    margin: 0 auto;
  }

  h2 {
    text-align: center;
    text-decoration: underline;
    margin: 0 0 6px;
    font-size: 15px;
  }

  .form-section {
    margin-bottom: 8px;
  }

  input[type="text"] {
    border: none;
    border-bottom: 1px solid black;
    padding: 2px 3px;
    outline: none;
    font-size: 11px;
  }

  textarea {
    border: none;
    border-bottom: 1px solid black;
    height: 50px;
    width: 100%;
    padding: 3px;
    resize: vertical;
    font-size: 11px;
  }

  .declaration, .signature-section, .note {
    margin-top: 12px;
  }

  p {
    margin: 3px 0;
  }

  u {
    text-underline-offset: 1.5px;
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

  </style>
</head>
<body>
  <button class="print-button" onclick="window.print()">Print Form</button>

  @php
    $client = $clientData->clint ?? null;
    $info = $client && isset($client->clientinfo) ? $client->clientinfo : null;
    $fatherdetails = $info && $info->father_details ? json_decode($info->father_details) : null;
    $motherdetails = $info && $info->mother_details ? json_decode($info->mother_details) : null;
    $ukLine1 = $client->address ?? ($client->street ?? '');
    $ukLine2 = trim(($client->city ?? '').' '.($client->zip_code ?? ''));
    $ukLine3 = $client->country ?? '';
    $inLine1 = $client->permanent_address ?? '';
    $inLine2 = $client->city ?? '';
    $inLine3 = $client->country ?? '';
  @endphp

  <div class="container">
    <h2>AFFIDAVIT</h2>
    <p><b><u>For obtaining Passport and consular services (Other than changing photo to match <br>change in appearance).</u></b></p>
    <p><b><u>(Strike off matter i.e. not applicable and append your initials against it).</u></b></p>

    <div class="form-section">
      <p>I solemnly and sincerely declare that:</p>

      <p style="margin-left: 20px;">(a) My personal particulars are:</p>
      <p style="margin-left: 40px;">Name: <input type="text" style="width: 83%;" value="{{ $client->client_name ?? '' }}"></p>
      <p style="margin-left: 40px;">Father’s Name: <input type="text" style="width: 74%;" value="{{ $fatherdetails->name ?? '' }}"></p>
      <p style="margin-left: 40px;">Mother’s Name: <input type="text" style="width: 74%;" value="{{ $motherdetails->name ?? '' }}"></p>
      <p style="margin-left: 40px;">Date of Birth: <input type="text" style="width: 77%;" value="{{ $client->date_of_birth ?? '' }}"></p>

      <p style="margin-left: 40px;">Address in UK:</p>
      <p style="margin-left: 40px;"><input type="text" style="width: 90%;" value="{{ $ukLine1 }}"></p>
      <p style="margin-left: 40px;"><input type="text" style="width: 90%;" value="{{ $ukLine2 }}"></p>
      <p style="margin-left: 40px;"><input type="text" style="width: 90%;" value="{{ $ukLine3 }}"></p>

      <p style="margin-left: 40px;">Address in India:</p>
      <p style="margin-left: 40px;"><input type="text" style="width: 90%;" value="{{ $inLine1 }}"></p>
      <p style="margin-left: 40px;"><input type="text" style="width: 90%;" value="{{ $inLine2 }}"></p>
      <p style="margin-left: 40px;"><input type="text" style="width: 90%;" value="{{ $inLine3 }}"></p>

      <p style="margin-left: 40px;">Telephone Number: <input type="text" style="width: 29%;" value="{{ $client->phone_number ?? '' }}">
        Email ID: <input type="text" style="width: 29%;" value="{{ $client->email ?? '' }}"></p>
    </div>

    <div class="form-section">
      <p style="margin-left: 20px;">(b) I have neither acquired nor applied for any other nationality and nor do I hold any other travel<br> document of any description.</p>
      <p style="margin-left: 20px;">(c) I continue to remain a citizen of India from the date of my &nbsp;arrival in this &nbsp;country till this date.</p>
      <p style="margin-left: 20px;">(d) I have / have not applied for asylum in U.K.</p>
      <p style="margin-left: 20px;">(e) My current landing rights (visa/ILR) are not based on my &nbsp;application for political &nbsp;asylum in<br> U.K.</p>
      <p style="margin-left: 20px;">(f) I have entered &nbsp; illegally / entered legally into UK. &nbsp; I’m mentioning the circumstances of my <br>illegal entry into UK overleaf.</p>
      <p style="margin-left: 20px;">(g) I’m &nbsp;recanting from any earlier&nbsp; position of wishing to &nbsp;sever links with India and I solemnly <br>express my commitment to sovereignty and territorial integrity of India.</p>
      <p style="margin-left: 20px;">(h) I further declare that my previous Passport No. 
        <input type="text" style="width: 90px;" value="{{ $info->passport_ic_number ?? '' }}"> dated: 
        <input type="text" style="width: 90px;" value="{{ $info->passport_issue_date ?? '' }}"> <br>was issued at 
        <input type="text" style="width: 100px;" value="{{ $info->passport_issue_place ?? '' }}"> on 
        <input type="text" style="width: 100px;" value="{{ $info->passport_expiry_date ?? '' }}"> has been lost/ damaged.
      </p>
    </div>

    <div class="declaration">
      <p>I make this solemn declaration conscientiously believing the same to be true and by virtue of the <br>provisions of the Statutory Declaration Act 1835.</p>
    </div>

    <div class="signature-section">
      <p><input type="text" style="width: 280px;"><br>(Signature of Applicant)</p>
      <p>Declared at <input type="text" style="width: 180px;" value="{{ $client->city ?? '' }}"> on this day <input type="text" style="width: 180px;" value="{{ date('d/m/Y') }}">.</p>
    </div>

    <div class="note">
      <p>Signature and designation of the officer (along with seal) before whom the affidavit is made</p>
      <p><strong><u>Note: This affidavit can be notarised at the Consulate at a cost of £10. It can also be notarised <br>from a public notary.</u></strong></p>
    </div>
  </div>
</body>
</html>
