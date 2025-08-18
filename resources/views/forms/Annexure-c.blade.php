<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Annexure C - Passport Declaration</title>
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
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
      background: #fff;
      font-size: 13px;
      line-height: 1.5;
    }

    .content {
      width: 92%;
      max-width: 800px;
      padding: 25px 40px;
      box-sizing: border-box;
      background: white;
      /* Removed box-shadow for no sheet boundary */
    }

    .center {
      text-align: center;
      font-weight: bold;
      margin-bottom: 20px;
    }

    input[type="text"] {
      border: none;
      border-bottom: 1px dashed black;
      width: 220px;
    }

    .block {
      display: block;
      margin-top: 10px;
    }

    .indent {
      margin-left: 60px;
      margin-top: 10px;
    }

    textarea {
      width: 100%;
      border: 1px solid #ccc;
      resize: vertical;
    }

    .right {
      text-align: right;
    }

    .no-box {
      border: none !important;
      outline: none !important;
      background: transparent !important;
      box-shadow: none !important;
    }

    /* Roman numerals with brackets */
    ol[type="I"] {
      counter-reset: item;
      list-style: none;
      padding-left: 20px;
    }

    ol[type="I"] > li {
      counter-increment: item;
      position: relative;
      padding-left: 30px;
    }

    ol[type="I"] > li::before {
      content: "(" counter(item, upper-roman) ")";
      position: absolute;
      left: 0;
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
    $minorName = $client->client_name ?? '';
    $parentApplicantName = $fatherdetails->name ?? ($motherdetails->name ?? '');
    $residenceAddress = $client->address ?? ($client->permanent_address ?? '');
    $city = $client->city ?? '';
  @endphp

  <div class="content">

    <div class="center">Annexure - ‘C’</div>

    <div class="center">
      <p style="font-size: 12px;"><b>SPECIMEN DECLARATION BY APPLICANT'S PARENT OR GUARDIAN FOR ISSUE OF PASSPORT TO MINOR <br> WHEN ONE PARENT HAS NOT GIVEN CONSENT</b></p>
    </div>

    <div class="center">(On plain paper)</div> 

    <p style="margin-left: 30px;">I/We <input type="text" value="{{ $parentApplicantName }}">&nbsp;(name of the parent / guardian applying for passport) resident of <input type="text" value="{{ $residenceAddress }}">, solemnly declare and affirm as under:</p>

    <ol type="I">
      <li>
        That I/we am/are the mother/father/parents/guardian of <input type="text" style="width: 170px;" value="{{ $minorName }}"> (name of the minor<br> child) who is minor and on whose behalf I/we have made an application for his/her passport.
      </li>

      <li>
         Signature/consent of Shri/Smt. <input type="text" style="width: 200px;" value="{{ $fatherdetails->name ?? ($motherdetails->name ?? '') }}"> (name of the father/mother) who is the father/mother/parents of the child has not been obtained by me for the following one or more reasons:
        <br>
        <div class="indent">
          (a) The father/mother of the minor applicant is travelling abroad/ is on sea/ travelling <br>in India and is unable to file consent; or/and<br>
          (b) The father/mother is separated and no court case is pending before the court regarding<br> divorce/marital dispute/custody of the child; or/and<br>
          (c) The father/mother has deserted and the whereabouts are not known; or/and<br>
          (d) There is an ongoing court case for divorce/custody of the minor child and the court has not<br> given any order prohibiting the issue of passport without the consent of father/mother; or/and<br>
          (e) There is a court order for the custody of the minor child with a parent who is applying <br>for the passport and consent of other parent (who has visitation rights) is not available <br>or he/she is refusing to give consent/the other parent is not availing the visitation rights <br>and his/her whereabouts are not known; or/and<br>
          (f) The parents are judicially separated and custody of the minor child has not been defined<br> in the court’s decree; or/and<br>
          (g) The father/mother of <input type="text" style="width: 110px;" value="{{ $minorName }}">(name of minor child) has deserted me after the <br>conception/delivery. That <input type="text" style="width: 100px;" value="{{ $minorName }}">(name of minor child) is exclusively under my care<br>and custody since separation/delivery.
        </div>
      </li>

      <li>
        That I/we am/are taking care of <input type="text" style="width: 180px;" value="{{ $minorName }}"> (name of the minor child) and he/she <br>is exclusively in my/our physical custody.
      </li>

      <li>
        I/we also affirm that in the case of a court case arising due to issue of a passport to the minor <br>child <input type="text" style="width: 130px;" value="{{ $minorName }}">(name of the minor child), I/we would be solely responsible for defending the<br> case and not the Passport Issuing Authority.
      </li>
    </ol>

    <br>
    <div class="right" style="margin-right: 70px;">
      Signature of the parent(s)/<br>guardian(s) applying for the Passport
    </div>

    <div style="margin-left: 20px;">
      <label>Place:</label> <input type="text" class="no-box" value="{{ $city }}"><br>
      <label>Date:</label> <input type="text" class="no-box" value="{{ date('d/m/Y') }}"><br>
      <label>Name:</label> <input type="text"  style="width: 300px;" value="{{ $parentApplicantName }}"><br>
      <label>Address:</label> <input type="text" style="width: 290px;" value="{{ $residenceAddress }}"><br>
      <label>Aadhaar Card No.:</label> <input type="text" >;or<br>
      <label>Voter ID Card No.:</label> <input type="text">;or<br>
      <label>Passport No.:</label> <input type="text" style="width: 250px;" value="{{ $info->passport_ic_number ?? '' }}"><br><br>
    </div>

  </div>

</body>
</html>


