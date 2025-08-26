<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sri Lankan Nationals - Additional Form</title>
  <style>
    * {
      box-sizing: border-box;
    }

    @page {
      size: A4;
      margin: 10mm;
    }

    @media print {
      body {
        margin: 0;
        background: none;
      }

      .form-container {
        box-shadow: none;
        margin: 0;
        padding: 0;
        width: 100%;
        max-width: 100%;
      }

      .print-button {
        display: none;
      }
    }

    body {
      font-family:  'Times New Roman', Georgia, serif; 
      background: none;
      margin: 0;
      padding: 0;
    }

    .form-container {
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
      background: none;
      padding: 0;
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

    .form-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 13px;
    }

    .form-table td {
      border: 1px solid black;
      padding: 2px 4px;
      vertical-align: middle;
    }

    .form-table input,
    .form-table textarea {
      width: 100%;
      border: none;
      font-family: inherit;
      font-size: 13px;
      background-color: transparent;
    }

    textarea {
      height: 20px;
      resize: vertical;
    }

    .no-box {
      border: none !important;
      border-bottom: 1px solid white !important;
      outline: none !important;
      font-size: 13px;
      background-color: transparent;
      width: 100% !important;
    }

    input[type="text"],
    textarea {
      width: 60%;
      border: none;
      border-bottom: 1px dashed #000;
      font-size: 13px;
      padding: 1px;
      margin-bottom: 6px;
      outline: none;
    }

    .header-container {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 10px;
    }

    .header-text {
      text-align: center;
      flex: 1;
      font-size: 17px;
    }

    .left {
      text-align: left;
    }

    .right {
      text-align: right;
    }

    .signature {
      margin-top: 10px;
    }

    .footer p {
      margin: 4px 0;
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
    $gender = $client->gender ?? '';
    $passportNumber = $info->passport_ic_number ?? '';
    $spouseName = $info->spouse_name ?? '';
    $placeOfBirth = $info->place_of_birth ?? '';
    $occupation = $info->occupation ?? '';
  @endphp

  <div class="form-container">
    <div class="header-container">
      <div class="left">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Emblem_of_India.svg/250px-Emblem_of_India.svg.png" alt="Indian Emblem" height="100">
      </div>
      <div class="header-text">
        <strong><u>HIGH COMMISSION OF INDIA, LONDON (U.K.)</u></strong><br>
        <strong>VISA DEPARTMENT</strong><br>
        <strong>FAX NO: 0044 207 2406312 / 0044 207 632 3302</strong><br><br>
        <strong>TO: HCI/OMIND, COLOMBO</strong><br>
        <span style="margin-left: 40px;"><strong>REF. NO: </strong> <input type="text" style="width: 100px;"> &nbsp;&nbsp;&nbsp;&nbsp;
        <strong>DATE:</strong> </span><br><span style="margin-right: 390px;"><input type="text" style="width: 100px;" value="{{ date('d/m/Y') }}"></span><br><br>
        <strong><u>Additional Form to be filled in by Sri Lankan nationals/Persons of Sri Lankan origin.</u></strong><br>
        <strong><u>(All in Block Letters)</u></strong>
      </div>
    </div>

    <table class="form-table">
      <tr><td>Full Name</td><td><input type="text" class="no-box" value="{{ $applicantName }}"></td></tr>
      <tr><td>Surname</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>Father's Full Name</td><td><input type="text" class="no-box" value="{{ $fatherName }}"></td></tr>
      <tr><td>Spouse's Name</td><td><input type="text" class="no-box" value="{{ $spouseName }}"></td></tr>
      <tr><td>Place of Birth</td><td><input type="text" class="no-box" value="{{ $placeOfBirth }}"></td></tr>
      <tr><td>Date of Birth</td><td><input type="text" class="no-box" value="{{ $dateOfBirth }}"></td></tr>
      <tr><td>Sex</td><td><input type="text" class="no-box" value="{{ $gender }}"></td></tr>
      <tr>
        <td colspan="2">
          <div style="display: flex; justify-content: space-between; align-items: center;">
            <label style="white-space: nowrap;">Sri Lankan passport no: <input type="text" class="no-box" style="width: 120px;"></label>
            <label style="white-space: nowrap;">Date of Issue: <input type="text" class="no-box" style="width: 120px;"></label>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <div style="display: flex; align-items: center;">
            <span style="margin-right: 8px;">Place of Issue:</span> <input type="text" class="no-box" style="flex: 1;">
          </div>
        </td>
      </tr>
      <tr><td>Previous Sri Lankan passport no</td><td><input type="text" class="no-box"></td></tr>
      <tr>
        <td colspan="2">
          <div style="display: flex; justify-content: space-between; align-items: center;">
            <label style="white-space: nowrap;">Previous Place of Issue: <input type="text" class="no-box" style="width: 120px;"></label>
            <label style="white-space: nowrap;">Date of Issue: <input type="text" class="no-box" style="width: 120px;"></label>
          </div>
        </td>
      </tr>
      <tr><td>Present Nationality</td><td><input type="text" class="no-box"></td></tr>
      <tr><td>Passport Number</td><td><input type="text" class="no-box" value="{{ $passportNumber }}"></td></tr>
      <tr>
        <td colspan="2">
          <div style="display: flex; justify-content: space-between; align-items: center;">
            <label style="white-space: nowrap;">Place of Issue: <input type="text" class="no-box" style="width: 120px;"></label>
            <label style="white-space: nowrap;">Date of Issue: <input type="text" class="no-box" style="width: 120px;"></label>
          </div>
        </td>
      </tr>
      <tr><td>Date of Renewal</td><td><input type="text" class="no-box"></td></tr>
      <tr>
        <td colspan="2">
          <div style="display: flex; align-items: center;">
            <span style="margin-right: 8px;">If holding Travel Document, supply details of previous passports:</span>
            <input type="text" class="no-box" style="flex: 1;">
          </div>
        </td>
      </tr>
      <tr><td colspan="2">Details if you are a dual citizen:</td></tr>
      <tr>
        <td colspan="2">
          <div style="display: flex; align-items: center;">
            <span style="margin-right: 8px;">Since when are you residing in country of domicile:</span>
            <input type="text" class="no-box" style="flex: 1;">
          </div>
        </td>
      </tr>
      <tr><td>Address in country of domicile</td><td><textarea class="no-box" style="width: 100%;">{{ $residenceAddress }}</textarea></td></tr>
      <tr><td>Present occupation</td><td><input type="text" class="no-box" value="{{ $occupation }}"></td></tr>
      <tr><td>Date of last visit to India & previous visits</td><td><textarea class="no-box"></textarea></td></tr>
      <tr>
        <td colspan="2">
          <div style="display: flex; align-items: center;">
            <span style="white-space: nowrap;">Whether visa was ever refused. If yes, please give details:</span>
            <input type="text" class="no-box" style="flex: 1;">
          </div>
        </td>
      </tr>
      <tr><td>Address in Sri Lanka</td><td><textarea class="no-box"></textarea></td></tr>
      <tr><td>Exact purpose of visit to India</td><td><textarea class="no-box"></textarea></td></tr>
      <tr><td>Duration</td><td><input type="text" class="no-box"></td></tr>
      <tr>
        <td colspan="2">
          <div style="display: flex; align-items: center;">
            <span style="white-space: nowrap;">Number of visits proposed (Single, double, multiple):</span>
            <input type="text" class="no-box" style="flex: 1;">
          </div>
        </td>
      </tr>
    </table>

    <div class="signature">
      <div class="right">Signature: <input type="text" style="width: 150px;" value="{{ $applicantName }}"><br>
      Date: <input type="text" style="width: 150px;" value="{{ date('d/m/Y') }}"></div>
    </div>

    <div class="footer">
      <div class="left">
        <p>The above applicant has applied for a visa on <input type="text" style="width: 150px;" value="{{ date('d/m/Y') }}">. Grateful for your urgent clearance.</p>
      </div>
      <div class="right"><p><strong>ATTACHE (VISA)</strong></p></div>
      <div class="left"><p>IHC/VFS Form</p></div>
    </div>
  </div>
</body>
</html>

