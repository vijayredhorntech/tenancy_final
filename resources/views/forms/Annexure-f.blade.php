<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Annexure F - Lost/Damaged Passport Declaration</title>
  <style>
    @media print {
      @page {
        size: A4;
        margin: 25mm 10mm 20mm 10mm; /* top, right, bottom, left */
      }
      body {
        margin: 0;
      }
    }

    body {
      font-family: Arial, sans-serif;
      width: 210mm;
      margin: 0 auto;
      background: white;
      box-sizing: border-box;
      line-height: 1.6;
      font-size: 12pt;
    }
    ol {
  padding-left: 10px; /* typical for ordered lists */
}

    .center {
      text-align: center;
      font-weight: bold;
      text-transform: uppercase;
      margin-bottom: 10px;
    }

    input[type="text"], textarea {
      width: 100%;
      border: none;
      border-bottom: 1px dashed black;
      padding: 4px;
      font-size: 12pt;
      margin-bottom: 0;
      outline: none;
      background: transparent;
    }

    .signature-section {
      display: flex;
      justify-content: space-between;
      margin-top: 40px;
    }

    table {
      width: 85%;
      border-collapse: collapse;
      margin-top: 0px;
      font-size: 9pt;
    }

    table, th, td {
      border: 1px solid black;
    }

    th, td {
      padding: 1px;
      text-align: left;
    }

    .row-input {
      width:100%;
      border: none;
      padding: 1px;
      font-size: 9pt;
      background: transparent;
    }

    .no-box {
      border: none !important;
      background: transparent;
      outline: none;
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
    }

    ol li {
      margin: 6px 0;
      list-style-position: outside;
      text-indent: 0;
    }
    .right{
        text-align: right;
    }
   
  ol.custom-list {
    list-style: none;
    padding-left: 0;
     counter-reset: item var(--start, 0); 
  }

  ol.custom-list > li {
    counter-increment: item;
    margin-bottom: 10px;
    padding-left: 90px;
    text-indent: -25px;
  }

  ol.custom-list > li::before {
    content: counter(item) ". ";
    font-weight: normal;
    display: inline-block;
    width: 25px;
  }
 p {
  margin: 0;
}



  </style>
</head>
<body>
  <button class="print-button" onclick="window.print()">Print Form</button>

  <div class="center">ANNEXURE 'F'</div>
  <div class="center">SPECIMEN DECLARATION OF APPLICANT FOR OBTAINING A PASSPORT IN LIEU OF LOST/<br> DAMAGED PASSPORT</div>

  @php
    $fatherdetails = $clientData->clint->clientinfo->father_details ? json_decode($clientData->clint->clientinfo->father_details) : null;
    $motherdetails = $clientData->clint->clientinfo->mother_details ? json_decode($clientData->clint->clientinfo->mother_details) : null;
    $spouse = $clientData->clint->clientinfo->spouse_details ? json_decode($clientData->clint->clientinfo->spouse_details) : null;
  @endphp

  <p style="margin: 0;">
    I, <input type="text" style="width: 350px;" value="{{ $clientData->clint->client_name ?? '' }}"> S/o, D/o, W/o Shri. <input type="text" style="width: 250px;" value="{{ $fatherdetails->name ?? '' }}">
    <input type="text" style="width: 250px;" value="{{ $clientData->clint->clientinfo->nationality ?? '' }}"> residing at <input type="text" style="width: 425px;" value="{{ $clientData->clint->address ?? '' }}">
    <input type="text" style="width: 770px;" value="{{ $clientData->clint->city ?? '' }} {{ $clientData->clint->country ?? '' }}"> <br>solemnly affirm as follows:
  </p>
  <ol class="custom-list" >
  <li>how and when the passport was lost/damaged and when FIR was lodged at which Police <br>
  Station and how many passports were lost/damaged earlier?</li>

  <li>State whether you travelled on the lost/damaged passport, if so state flight number and date <br>
  and port of entry into India?</li>

  <li>State whether you availed of any TR concessions/FTs allowance and if so details thereof?</li>

  <li>State whether non-resident Indian and if resident abroad, the details of the residence as follows:</li>
</ol>

   <table style="margin-left: 95px;margin-top: -20px;">

    <tr>
      <th rowspan="2" valign="top">S. No.</th>
      <th rowspan="2" valign="top">Name of the Country</th>
      <th rowspan="2" style="vertical-align: top;">
  Length of residence<br>
  <span style="display: inline-block; margin-bottom: 0;">
    From <input type="text" style="width: 100px; margin: 0; padding: 2px;">
  </span>
  <span style="display: inline-block;">
    To <input type="text" style="width: 120px; margin-bottom: 10px; padding: 0px;">
  </span>
</th>
      <th rowspan="2" valign="top">Page Nos. of passport bearing<br>departure and arrival stamps</th>
    </tr>
    <tr>
    </tr>
    <tr>
      <td>1</td>
      <td><input type="text" class="row-input no-box" value="{{ $clientData->clint->country ?? '' }}"></td>
      <td><input type="text" class="row-input no-box"></td>
      <td><input type="text" class="row-input no-box"></td>
     
    </tr>
    <tr>
      <td>2</td>
      <td><input type="text" class="row-input no-box"></td>
      <td><input type="text" class="row-input no-box"></td>
      <td><input type="text" class="row-input no-box"></td>
      
    </tr>
    <tr>
      <td>3</td>
      <td><input type="text" class="row-input no-box"></td>
      <td><input type="text" class="row-input no-box"></td>
      <td><input type="text" class="row-input no-box"></td>
  
    </tr>
  </table>


  <ol  class="custom-list"start="5" style="counter-reset: item 4;">
    <li>State whether the Passport had any objection by the PIA and if so the details thereof.</li>
    <li>State whether you were deported at any time at the expenses of the Government and if so was<br> the expenditure incurred reimbursed to Government of India.</li>
  </ol>

  <p>
    I further affirm that I will take utmost care of my passport if issued and the Government will be at liberty to take any legal action under the Passports Act, 1967, if the lapse is repeated.
  </p>

  <div class="signature-section">
    <div>Date: <input type="text" style="width: 200px;" value="{{ date('d/m/Y') }}"></div></div>
   <br>
    <div class="right">(Signature of applicant)</div>

</body>
</html>
