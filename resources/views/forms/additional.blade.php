<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Additional Form - Non UK Residents</title>
  <style>
    @page {
      size: A4;
      margin: 25mm;
    }

    html, body {
      margin: 0;
      padding: 0;
      font-family: "Times New Roman", serif;
      font-size: 14px;
      background: white;
    }
    .form-group.no-gap {
  margin-bottom: 0;
}
   .form-group.gap{
    margin-bottom: 25px;
   }

    .container {
      width: 210mm;
      min-height: 297mm;
      padding: 25mm;
      box-sizing: border-box;
      margin: auto;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }

    .header img {
      height: 90px;
    }

    .header-text {
      text-align: right;
    }

    .section-title {
      font-weight: bold;
      margin: 10px 0 20px 0;
      font-size: 17.5px;
    }

    .form-group {
      display: flex;
      align-items: flex-start;
      margin-bottom: 10px;
    }

    .label {
      width: 300px;
      font-weight: bold;
    }

    .input-wrap {
      width: 60%;
    }

    input[type="text"], textarea {
      border: none;
      border-bottom: 2px dashed black;
      background: transparent;
      width: 100%;
      font-family: inherit;
      font-size: 14px;
      font-weight: bold;
      padding: 2px 4px;
      box-sizing: border-box;
      outline: none;
    }

    textarea {
      height: 40px;
      resize: vertical;
    }

    .for-office {
      border-top: 1px solid #000;
      margin-top: 20px;
      padding-top: 3px;
      font-weight: bold;
      margin-bottom: 3px;
    }
    .for-office .form-group {
  margin-bottom: 5px;
}

.for-office p {
  margin-top: 4px; 
}
  

    .center {
      text-align: center;
    }

    .right {
      text-align: right;
    }

    .print-button {
      position: fixed;
      top: 20px;
      right: 20px;
      background: #007bff;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
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
      
      input[type="text"], textarea {
        color: black;
        -webkit-print-color-adjust: exact;
      }

      .container {
        box-shadow: none;
      }
    }
    .heading{
        font-size: 22px;
    }
  </style>
</head>
<body>
  <button class="print-button" onclick="window.print()">Print Form</button>
  
  <div class="container">

    <div class="header">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Emblem_of_India.svg/250px-Emblem_of_India.svg.png" alt="India Emblem">
      <div class="header-text">
        <div class="heading">HIGH COMMISSION OF INDIA, LONDON</div>
        Visa Department<br>
        India House, Aldwych<br>
        London WC2B 4NA<br>
        Fax No: 0044 207 632 3200 or<br>
        0044 207 240 6312
      </div>
    </div>

    <div class="section-title">
      ADDITIONAL FORM TO BE FILLED BY NON UK RESIDENTS (IN BLOCK<br>
      LETTERS)
    </div>
    
    @php
      $fatherdetails = $clientData->clint->clientinfo->father_details ? json_decode($clientData->clint->clientinfo->father_details) : null;
      $motherdetails = $clientData->clint->clientinfo->mother_details ? json_decode($clientData->clint->clientinfo->mother_details) : null;
      $spouse = $clientData->clint->clientinfo->spouse_details ? json_decode($clientData->clint->clientinfo->spouse_details) : null;
    @endphp

    <div class="form-group">
      <div class="label">SURNAME:</div>
      <div class="input-wrap"><input type="text" value="{{ $clientData->clint->last_name ?? '' }}"></div>
    </div>

    <div class="form-group">
      <div class="label">FIRST NAME:</div>
      <div class="input-wrap"><input type="text" value="{{ $clientData->clint->first_name ?? '' }}"></div>
    </div>

    <div class="form-group">
      <div class="label">NATIONALITY:</div>
      <div class="input-wrap"><input type="text" value="{{ $clientData->clint->clientinfo->nationality ?? '' }}"></div>
    </div>

    <div class="form-group">
      <div class="label">FATHER'S NAME:</div>
      <div class="input-wrap"><input type="text" value="{{ $fatherdetails->name ?? '' }}"></div>
    </div>

    <div class="form-group">
      <div class="label">DATE & PLACE OF BIRTH:</div>
      <div class="input-wrap"><input type="text" value="{{ $clientData->clint->date_of_birth ?? '' }} {{ $clientData->clint->clientinfo->place_of_birth ?? '' }}"></div>
    </div>

    <div class="form-group">
      <div class="label">PASSPORT NO:</div>
      <div class="input-wrap"><input type="text" value="{{ $clientData->clint->clientinfo->passport_ic_number ?? '' }}"></div>
    </div>

    <div class="form-group gap">
      <div class="label">DATE & PLACE OF ISSUE:</div>
      <div class="input-wrap"><input type="text" value="{{ $clientData->clint->clientinfo->passport_issue_date ?? '' }} {{ $clientData->clint->clientinfo->passport_issue_place ?? '' }}"></div>
    </div>

    <div class="form-group gap">
      <div class="label">PERMANENT ADDRESS IN UNITED KINGDOM:</div>
      <div class="input-wrap">
        <input type="text" value="{{ $clientData->clint->address ?? '' }}"><br>
        <input type="text" value="{{ $clientData->clint->street ?? '' }}"><br>
        <input type="text" value="{{ $clientData->clint->city ?? '' }} {{ $clientData->clint->zip_code ?? '' }}">
      </div>
    </div>

    <div class="form-group gap">
      <div class="label">ADDRESS IN COUNTRY OF ORIGIN:</div>
      <div class="input-wrap">
        <input type="text" value="{{ $clientData->clint->permanent_address ?? '' }}"><br>
        <input type="text" value="{{ $clientData->clint->street ?? '' }}"><br>
        <input type="text" value="{{ $clientData->clint->city ?? '' }} {{ $clientData->clint->country ?? '' }}">
      </div>
    </div>

    <div class="form-group">
      <div class="label">PROFESSION:</div>
      <div class="input-wrap"><input type="text" value="{{ $clientData->clint->clientinfo->present_occupation ?? '' }}"></div>
    </div>

    <div class="form-group no-gap">
      <div class="label">TYPE OF VISA:</div>
      <div class="input-wrap"><input type="text"></div>
    </div>

    <div class="form-group">
      <div class="label">SIGNATURE OF THE APPLICANT:</div>
      <div class="input-wrap"><input type="text"></div>
    </div>
    <div class="for-office">
     <div class="center" style="margin-bottom: 20px;"><strong><u>(FOR OFFICE USE)</u></strong></div>


  <div class="form-group">
    <div class="label">No:<input type="text" style="width: 200px;"></div>
    <div class="label">Date:<input type="text" style="width: 200px;" value="{{ date('d/m/Y') }}"></div>
  </div>
   <div class="section-title"> <p>TO: HCI/OMI/IND EMBASSY / CONSENDIA<br>
        WE SHALL BE GRATEFUL IF YOU COULD KINDLY CONVEY YOUR <br>URGENT CLEARANCE / NO OBJECTION TO ISSUE THE VISA.</p></div>
       <br>
  
  <p class="right"><strong>ATTACHE (VISA)</strong></p>
  <p style="font-weight: normal;">IHC/VFS form</p>

</div>

</body>
</html>


