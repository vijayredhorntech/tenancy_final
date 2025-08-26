<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tatkal Undertaking</title>
  <style>
    @page {
      size: A4;
      margin: 1cm;
    }

    html, body {
      font-family: 'Times New Roman', Georgia, serif;
      font-size: 11px;
      line-height: 1.5;
      padding: 0;
      margin: 0;
    }

    body {
      display: flex;
      justify-content: center;
    }

    .container {
      width: 95%;
      max-width: 800px;
      padding: 10px;
      box-sizing: border-box;
    }

    h3, h4 {
      text-align: center;
      text-decoration: underline;
      margin: 10px 0;
    }

    .right {
      text-align: right;
    }

    .center {
      text-align: center;
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

    @media print {
      .print-button {
        display: none;
      }
      
      .container {
        width: 100%;
        margin-bottom: 0;
      }

      table {
        font-size: 10px;
      }

      th, td {
        padding: 2px;
      }
      table {
        page-break-inside: avoid;
      }

       p {
        margin-top: 10px;
      }
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      page-break-inside: avoid;
    }

    th, td {
      border: 1px solid #000;
      padding: 4px;
      vertical-align: top;
    }

    input[type="text"] {
      width: 200px;
      border: none;
      border-bottom: 1px solid black;
      background: transparent;
      padding: 2px;
      box-sizing: border-box;
      outline: none;
    }

    .no-box {
      border: none !important;
      border-bottom: 1px solid white !important;
      background-color: transparent;
      width: 100% !important;
    }

    .italic {
      font-style: italic;
    }

    p {
      margin: 6px 0;
      text-align: justify;
    }

    u {
      text-underline-position: under;
    }

    @media print {
      .container {
        width: 100%;
      }
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
    $arn = $info->arn ?? '';
    $oldPassport = $info->passport_ic_number ?? '';
  @endphp

  <div class="container">
    <h3>Undertaking for Tatkal Scheme</h3>

    <div class="right"><strong><u>(Please Select) Passport applied as: 
      <label><input type="checkbox" class="checkbox"> Fresh or</label> 
      <label><input type="checkbox" class="checkbox"> Re-issue</label></u></strong>
    </div><br>

    <p>
      Applicants applying under Tatkal scheme should fill in the following undertaking: <br>
      ▪ Applicants are required to furnish <b>>original documents </b>along with one set of self-attested photocopies of the same at the Passport Seva Kendra (PSK) for processing. <br>
      ▪ <b>Applicants over the age of 18 years </b> have to submit any <b>three of the documents </b>specified in the below-mentioned <b>List of Acceptable Documents,</b> plus <b>address and non-ECR proofs</b> as applicable. <br>
      ▪ <b>Applicants below the age of 18 years </b>have to submit any <b>two of the documents </b>from serial numbers 1 to 6 specified in the below-mentioned<b> List of Acceptable Documents,</b> plus <b>address and non-ECR proofs</b> as applicable.
    </p>

    <b>A. List of Acceptable Documents:</b><u>Please select only 3 documents in case of applicants over the age of 18 years and 2 documents in case of applicants below the age of 18 years. Please ensure that the details mentioned (such as complete name, Date of Birth, Father's name etc) are the same in all the documents. However, address is not mandatorily required to be same in all the documents submitted by the applicants, but at least one of these documents should match the address
 
fiIlled in the application form.</u>

    <table>
      <tr>
        <th style="width: 5%;">Sr. No.</th>
        <th style="width: 70%;">Documents</th>
        <th style="width: 25%;">Selected by applicant/parent</th>
      </tr>
      <tr><td>1</td><td>I.	PVC Aadhaar Card/Complete Original Aadhaar Letter/ e-Aadhaar Card with digital signature verified mark issued by UIDAi or *Aadhaar Card (Small cut-out Aadhaar card/smart card printed by non-UIDAI entities will not be accepted.)</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>2</td><td>Permanent Account Number (PAN)</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>3</td><td>Student Photo Identity Cards issued by Recognized Educational Institutions</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>4</td><td>Birth Certificate issued under the Registration of Births and Deaths Act, 1969 (18 of 1969)</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>5</td><td>Ration Card (latest or updated)</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>6</td><td>Last Passport issued (in case of re-issue only)</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>7</td><td>Electors Photo Identity Card (EPIC)</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>8</td><td>Driving License (valid and within the jurisdiction of the State of submission of application)</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>9</td><td>9.Bank Passbook or Kisan Passbook or Post Office Passbook (with applicant's photo attested and with the latest transaction updated)	</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>10</td><td>Scheduled Caste / Scheduled Tribe / Other backward class certificates</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>11</td><td>Arms License issued under Arms Act, 1959 (54 of 1959)</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>12</td><td>Pension Documents such as ex-servicemen's Pension book or Pension payment order issued to retired government employees, ex-servicemen's Widow or Dependent Certificates, Old Age Pension Order</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>13</td><td>Service Photo Identity Card issued by State/Central Government, Public Sector Undertakings, Local bodies or Public Limited Companies</td><td><input type="text" class="no-box"></td></tr>
    </table>
    <p>(*e-versions of the documents shall be accepted if the same are shared/uploaded through DigiLocker at the time of online application submission)</p>
    <br>

    <b><u>B. Address Proof:</u></b>Please specify the present address proof document being submitted. In case of adults, address proof should be in the name of the applicant, except in starred (*) cases.
        <footer style="text-align: center; font-size: 10px; position: fixed; bottom: 0; left: 0; right: 0; padding-top: 5px; margin-left: 950px; margin-bottom: 700px;">
  <p><b> page 1 of 2</b></p>
  </footer>        
    <table>
      <tr><td> Aadhaar Card (as mentioned in the above List)</td><td><input type="text" class="no-box"></td><td>Rent Agreement</td><td><input type="text" class="no-box"></td></tr>
      <tr><td> *Parent's passport, in case of minors (First and last pages)</td><td><input type="text" class="no-box"></td><td> **Electricity bill</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>**Telephone (landline or post-paid mobile bill)</td><td><input type="text" class="no-box"></td><td>**Water Bill</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>Proof of Gas Connection</td><td><input type="text" class="no-box"></td><td>Income Tax Assessment Order</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>Certificate from Employer of reputed companies on let!er head (Only public limited companies can give address proof on company letter head along with seal. Computerised print-outs shall not be entertained.)</td><td><input type="text" class="no-box"></td><td>Electors Photo Identity Card (EPIC) (as mentioned in the above List)</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>*Spouse's passport copy (First and last page including family details mentioning applicant's name as spouse of the passport holder), (provided the applicant's present address matches the address mentioned in the spouse's passport)</td><td><input type="text" class="no-box"></td><td>Photo Passbook of running Bank Account and latest transactions updated (Scheduled Public Sector Banks, Scheduled Private Sector Indian Banks and Regional Rural Banks only)</td><td><input type="text" class="no-box"></td></tr>
    </table>
    <p>In case of the online documents (**), the applicants may be asked to show source (Ex. email/official app on the mobile phone).</p>

    <p><strong> C. Non-ECR Document Name:<input type="text" style="width: 70%;"></strong></p>
    <p>
     (In case  of  applicants between  age of 15 to  50 years applying for the first time a  full validity passport  under non-ECR category,  please  specify  the  supporting  original  document  such  as  certificate  or  marksheet  of  10th  or  12th  class  from recognised boards or graduation/post-graduation degree from recognised Universities etc. The complete list of documents required  for ECNR can  be seen at:
          <br><u> https://www.passportindia.gov.in/AppOnlineProject/onlineHtml/NonEcrDocuments.html.)</u>


    </p>
    <br>

    <p><strong><u>Declaration by the applicant:</u></strong></p>
    <p>
     I understand and agree that I have applied under the Tatkaal scheme, and<u> my application may be put on hold in care of documentary insufficiency.</u> In such a case, I agree to submit the required number of documents at a later date given by the Office. <u>I also state that I do not belong to the ineligible categories. I agree that if I am found to be belonging to the ineligible categories at a later stage, my application may be processed as per the guidelines for the said category. I agree that the decision of GO/APO/RPO shall be considered final.
    </u></p>

    <div class="right">
      Signed by applicant or parent (in minor's case): <input type="text" value="{{ $applicantName }}"><br><br>
      Applicant's Name: <input type="text" value="{{ $applicantName }}"> <br><br>
      ARN: <input type="text" value="{{ $arn }}"> <br><br>
      Old Passport No. (in case of re-issue only): <input type="text" value="{{ $oldPassport }}"><br>
    </div>

    <p style="text-align: center;">------------------------------------------------------------------------------------------------------------------------</p>
    <p style="text-align: center;"><strong><u>To be checked by the Office</u></strong></p>
    <p><strong>Previous PVR Status Adverse? Yes or No</strong></p>
  </div>
  <footer style="text-align: center; font-size: 10px; position: fixed; bottom: 0; left: 0; right: 0; padding-top: 5px; margin-left: 950px;">
  <p><b> page 2 of 2</b></p>
  </footer>
</body>
</html>
