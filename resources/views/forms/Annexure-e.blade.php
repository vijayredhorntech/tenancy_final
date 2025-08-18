<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Annexure - E</title>
  <style>
    @media print {
      @page {
        size: A4;
        margin: 20mm;
      }
      html, body {
        width: 210mm;
        height: 297mm;
        margin: 0 auto;
      }
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0 auto;
      padding: 20mm;
      width: 210mm;
      height: auto;
      box-sizing: border-box;
      line-height: 1.5;
      font-size: 10pt;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
   
    .container {
      max-width: 180mm;
    }

    .center {
      text-align: center;
      font-weight: bold;
    }

    input[type="text"], textarea {
      border: none;
      border-bottom: 1px dashed #000;
      font-size: 12pt;
      width: 200px;
      margin: 0 5px;
      outline: none;
    }

    ul {
      list-style: none;
      padding-left: 0;
    }

    .signature {
      text-align: right;
      margin-top: 30px;
    }

  ul li {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 0;
  }

  input.no-box {
      border: none;
      border-bottom: 1px solid #fcfbfb;
      outline: none;
      width: 300px;
      font-size: 14px;
      padding: 2px;
    }
  .inline-label {
    display: inline-block;
    width: 120px;
  }
  li{
    margin-bottom: 10px;
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

 
</style>
</head>
<body>
  <button class="print-button" onclick="window.print()">Print Form</button>
  
  <div class="container">
    <h3 class="center">Annexure-'E'</h3>
    <h4 class="center">SPECIMEN DECLARATION OF THE APPLICANT ON A PLAIN PAPER</h4>

    @php
      $fatherdetails = $clientData->clint->clientinfo->father_details ? json_decode($clientData->clint->clientinfo->father_details) : null;
      $motherdetails = $clientData->clint->clientinfo->mother_details ? json_decode($clientData->clint->clientinfo->mother_details) : null;
      $spouse = $clientData->clint->clientinfo->spouse_details ? json_decode($clientData->clint->clientinfo->spouse_details) : null;
    @endphp
    
    <p>
      I, <input type="text" style="width: 80px;" value="{{ $clientData->clint->client_name ?? ''}}">(name), son/ daughter/ wife of Shri <input type="text" style="width: 90px;" value="{{ $fatherdetails->name ?? '' }}"> residing at <input type="text" style="width: 80px;" value="{{ $clientData->clint->address ?? $clientData->clint->permanent_address ?? '' }}"><br>
      Date of Birth <input type="text" style="width: 70px;" value="{{ $clientData->clint->date_of_birth ?? '' }}">being an applicant for issue of passport, do hereby solemnly affirm and <br> state the following:
    </p>

    <ol>
      <li>
        That the names of my parents and spouse are as follows:</li>
       
      <ul>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(i) Father: <input type="text" style="width: 200px;" class="no-box" value="{{ $fatherdetails->name ?? '' }}"></li><br>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ii) Mother:<input type="text" style="width: 200px;" class="no-box" value="{{ $motherdetails->name ?? '' }}"></li><br>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(iii) Wife/Husband: <input type="text" style="width: 200px;" class="no-box" value="{{ $spouse->name ?? '' }}"></li><br>
      </ul>
      </li>
      <li>That I am a continuous resident at the above mentioned address from <input type="text" style="width: 130px;" value="{{ $clientData->clint->address ?? $clientData->clint->permanent_address ?? '' }}"></li>
      <li>That I am a citizen of India by birth/descent/registration/naturalization and that I have neither <br>acquired the citizenship of another country nor have surrendered or been terminated/deprived <br>of my citizenship of India.</li>
      <li>That I have not, at any time during the period of five years immediately preceding the date of<br> this declaration, been convicted by any court in India for any offence involving moral turpitude<br> and sentenced in respect thereof to imprisonment for not less than two years.</li>
      <li>That no proceedings in respect of any criminal offence alleged to have been committed by me <br>are pending before any criminal court in India.</li>
      <li>That no warrant or summons for my appearance, and no warrant for my arrest, has been issued<br> by a court under any law for the time being in force, and that my departure from India has not<br> been prohibited by order of any such court.</li>
      <li>That I have never been repatriated from abroad back to India at the expense of Government of <br>India / I was repatriated from abroad back to India at the expense of Government of India, but<br> reimbursed expenditure incurred in connection with such repatriation.</li>
      <li>That I will not engage in activities prejudicial to the sovereignty and integrity of India.</li>
      <li>That my departure from India will not be detrimental to the security of India.</li>
      <li>That my presence outside India will not prejudice the friendly relations of India with any foreign<br> country.</li>
    </ol>

    <p>
      Place: <input type="text" class="no-box" value="{{ $clientData->clint->city ?? '' }}"><br><br>
      Date: <input type="text" class="no-box" value="{{ date('d/m/Y') }}">
    </p>

    <div class="signature">
      <strong>(Signature of applicant)</strong>
    </div>
  </div>
</body>
</html>

