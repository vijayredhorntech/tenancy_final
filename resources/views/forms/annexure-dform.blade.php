<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Annexure D - Minor Passport Declaration</title>
  <style>
    @media print {
      @page {
        size: A4;
        margin: 15mm 20mm 15mm 20mm;
      }
      body {
        padding: 0;
        margin: 0;
      }
      .print-button {
        display: none;
      }
      .container {
        width: 100%;
        max-width: none;
        padding: 0 10mm;
      }
      input[type="text"] {
        border-bottom: 1px solid #000;
        width: 160px;
      }
      .note {
        font-size: 10px;
      }
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      font-size: 13px;
      line-height: 1.4;
      display: flex;
      justify-content: center;
      padding: 10px 0;
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
      max-width: 595px; /* A4 width for print compatibility */
      padding: 10px 20px;
    }

    h3, h4 {
      text-align: center;
      margin: 5px 0;
    }

    .form-group {
      margin-bottom: 5px;
    }

    input[type="text"] {
      border: none;
      border-bottom: 1px dashed #000;
      width: 180px;
      font-size: 13px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 5px;
    }

    td {
      vertical-align: top;
      padding: 2px;
    }

    .section {
      margin-top: 10px;
    }

    .note {
      font-size: 11px;
      margin-top: 10px;
    }

    .no-box {
      border: none !important;
      outline: none !important;
      background: transparent !important;
      box-shadow: none !important;
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
    $dateOfBirth = $client->date_of_birth ?? '';
    $fatherPassport = $fatherdetails->passport_number ?? '';
    $motherPassport = $motherdetails->passport_number ?? '';
    $fatherContact = $fatherdetails->contact_number ?? '';
    $motherContact = $motherdetails->contact_number ?? '';
    $fatherEmail = $fatherdetails->email ?? '';
    $motherEmail = $motherdetails->email ?? '';
    $fatherCitizenship = $fatherdetails->citizenship ?? '';
    $motherCitizenship = $motherdetails->citizenship ?? '';
    $arn = $info->arn ?? '';
  @endphp

  <div class="container">

    <h3><b>ANNEXURE 'D'</b></h3>
    <h4><b>SPECIMEN DECLARATION BY APPLICANT'S PARENT(S) OR GUARDIAN<br>FOR ISSUE OF PASSPORT TO MINOR</b></h4>
    <p style="text-align: center;">(On plain paper)</p>

    <div class="section">
      I/We, parent(s)/legal guardian of minor child whose details are mentioned below solemnly declare and affirm as under:
    </div>

    <div class="section">
     <span style="margin-left: 70px;"> Name of the minor child: <input type="text" value="{{ $applicantName }}"></span><br>
     <span style="margin-left: 70px;"> Date of Birth: <input type="text" style="width: 40%;" value="{{ $dateOfBirth }}"></span>
    </div>

    <table>
      <tr>
        <td>
         <span style="margin-left: 70px;"> Name of father: <input type="text" style="width: 32%;" value="{{ $fatherName }}"></span><br>
          <span style="margin-left: 70px;">Citizenship: <input type="text" style="width: 40%;" value="{{ $fatherCitizenship }}"></span><br>
          <span style="margin-left: 70px;">Passport No.: <input type="text" style="width: 37%;" value="{{ $fatherPassport }}"></span><br>
          <span style="margin-left: 70px;">Contact No.: <input type="text" style="width: 38%;" value="{{ $fatherContact }}"></span><br>
          <span style="margin-left: 70px;">Email ID: <input type="text" style="width: 45%;" value="{{ $fatherEmail }}"></span><br>
          <span style="margin-left: 70px;">Address: <input type="text" style="width: 45%;" value="{{ $residenceAddress }}"></span><br>
          <span style="margin-left: 70px;"><input type="text" style="width: 65%;"></span>
        </td>
        <td>
          <span style="margin-left: 70px;"> Name of Mother: <input type="text"style="width: 32%;" value="{{ $motherName }}"></span><br>
         <span style="margin-left: 70px;">  Citizenship: <input type="text"style="width: 40%;" value="{{ $motherCitizenship }}"></span><br>
          <span style="margin-left: 70px;">Passport No.: <input type="text"style="width: 37%;" value="{{ $motherPassport }}"></span><br>
           <span style="margin-left: 70px;">Contact No.: <input type="text" style="width: 38%;" value="{{ $motherContact }}"></span><br>
          <span style="margin-left: 70px;"> Email ID: <input type="text" style="width: 45%;" value="{{ $motherEmail }}"></span><br>
           <span style="margin-left: 70px;">Address: <input type="text" style="width: 45%;" value="{{ $residenceAddress }}"></span><br>
          <span style="margin-left: 70px;"><input type="text" style="width: 65%;"></span>
        </td>
      </tr>
    </table>

    <div class="section">
      1.<span style="margin-left: 60px;">That I/We am/are the mother/father/parent(s)/legal guardian(s) of the above minor child on whose behalf I/We am/are submitting passport application wide ARN no. <input type="text" value="{{ $arn }}">.</span><br><br>

      2.<span style="margin-left: 60px;"> The minor child mentioned above is a citizen of India. I/We solemnly declare that he/she has not lost, surrendered or has been deprived of his/her citizenship of India.</span><br><br>

      3. <span style="margin-left: 60px;"> I/We undertake the entire responsibility for his/her expenses.</span><br><br>

      4. <span style="margin-left: 60px;">I/We hereby certify and undertake that if any information provided in the above declaration is found incorrect or misleading, following action may be taken by the Passport Authority for:</span><br>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a)<span style="margin-left: 25px;"> Cancellation (impounding/revocation) of the passport issued on the basis of this</span><span style="margin-left: 75px;"> declaration.</span><br>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; b)<span style="margin-left: 25px;"> Initiating criminal proceedings under relevant provisions of Bharatiya Nyaya Sanhita, 2023 </span><span style="margin-left: 75px;">and the Passports Act, 1967</span>
    </div>

    <br>

    <table>
      <tr>
        <td>
          Signature of father/legal guardian <input type="text" style="width: 20%;" value="{{ $fatherName }}"><br><br>
          Name of father: <input type="text" style="width: 58%;" value="{{ $fatherName }}"><br>
          passport No.:(preferably)<input type="text" style="width: 35%;" value="{{ $fatherPassport }}">;or<br>
          Aadhaar Card No.: <input type="text" style="width: 45%;">;or<br>
          Voter ID Card No.: <input type="text" style="width: 45%;">;or<br>
          PAN Card No.: <input type="text" style="width: 53%;">;or<br>
          Driving License No.: <input type="text" style="width: 40%;">
        </td>
        <td>
          Signature of Mother/Legal Guardian <input type="text" style="width: 20%;" value="{{ $motherName }}"><br><br>
          Name of mother: <input type="text" value="{{ $motherName }}"><br>
          passport No.:(preferably)<input type="text" style="width: 38%;" value="{{ $motherPassport }}">;or<br>
          Aadhaar Card No.: <input type="text" style="width: 48% ;">; or<br>
          Voter ID Card No.: <input type="text" style="width: 48%;">;or<br>
          PAN Card No.: <input type="text" style="width: 55%;">;or<br>
          Driving License No.: <input type="text" style="width: 45%;">
        </td>
      </tr>
    </table>

    <div class="section">
      Place: <input type="text" class="no-box" value="{{ $city }}"><br>
      Date: <input type="text" class="no-box" value="{{ date('d/m/Y') }}">
    </div>

    <div class="note">
      <b>Note:</b><br>
      1. In case of 'Legal guardian', copy of court order appointing Legal guardian of minor to be attached.<br>
      2. As per Rule 11 of the Passports Act 1967 read with Rule 5 of the Passports Rules, 1980 it is stipulated that Passport Authority may ask for additional documents/interview of the applicant to furnish such additional information, documents or clarifications, as may be considered necessary by the Passport Authority for the proper disposal of the application required.
    </div>

  </div>

</body>
</html>
