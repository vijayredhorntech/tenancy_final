<!DOCTYPE html>
<html>
<head>
  <title>Annexure-D</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 17px;
      background: white;
      margin: 0;
      padding: 0;
    }

    .a4-sheet {
      width: 250mm;
      min-height: 297mm;
      margin: auto;
      padding: 25mm;
      box-sizing: border-box;
    }

    .form-wrapper {
      max-width: 1000px;
      margin: 0 auto;
    }

    h3, h5 {
      text-align: center;
      margin: 10px 0;
      font-size: 13px;
    }

    .form-group {
      margin-bottom: 15px;
      width: 100%;
    }

    .line {
      display: flex;
      align-items: center;
      margin-bottom: 8px;
    }

    .line label {
      white-space: nowrap;
      margin-right: 10px;
    }


    .no-box {
  flex: 1; /* ← this makes it take up available space */
  border: none;
  border-bottom: 1px dashed white;
  background: transparent;
  outline: none;
  font-size: 16px;
  padding: 2px 5px;
  margin-left: 10px;
}
input[type="text"]:not(.no-box) {
  flex: 1;
  border: none;
  border-bottom: 1px dashed #000;
  outline: none;
  background: transparent;
  padding: 2px;
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
  
  body, html {
    width: 210mm;
    height: 297mm;
    margin: 0;
    padding: 0;
  }
}
    .flex-container {
  display: flex;
  flex-direction: column;
  gap: 20px;
  width: 100%;
  padding: 0; /* remove horizontal padding */
  margin-left: 0; /* optional: align to left */
}

      

    .row {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 0;
    }

    .row input {
      border: none;
      border-bottom: 1px dashed black;
      outline: none;
    }

    .spacer {
      width: 70px;
    }

  </style>
</head>
<body>
  <button class="print-button" onclick="window.print()">Print Form</button>
  
  <div class="a4-sheet">
    <div class="form-wrapper">
      <h3><b>Annexure-'D'</b></h3>
      <h3><b>SPECIMEN DECLARATION BY APPLICANT'S PARENT(S) OR GUARDIAN FOR ISSUE OF PASSPORT TO MINOR</b></h3>
      <h5><b>(On plain paper)</b></h5>

      @php
        $fatherdetails = $clientData->clint->clientinfo->father_details ? json_decode($clientData->clint->clientinfo->father_details) : null;
        $motherdetails = $clientData->clint->clientinfo->mother_details ? json_decode($clientData->clint->clientinfo->mother_details) : null;
        $spouse = $clientData->clint->clientinfo->spouse_details ? json_decode($clientData->clint->clientinfo->spouse_details) : null;
      @endphp

      <div class="form-group">
        <div class="line"><label>I/we,</label> <input type="text" value="{{ $clientData->clint->client_name ?? '' }}"> <label>resident of</label> <input type="text" value="{{ $clientData->clint->address ?? $clientData->clint->permanent_address ?? '' }}"> <label>hereby affirm that the</label></div>
        <div class="line"><label>particulars given below are of</label> <input type="text" style="width: 120px;" value="{{ $clientData->clint->client_name ?? '' }}"> <label>(name of the child), son/daughter of Shri</label></div>
        <div class="line"><input type="text" style="width: 0;" value="{{ $fatherdetails->name ?? '' }}"> <label>and Smt</label> <input type="text" style="width: 0;" value="{{ $motherdetails->name ?? '' }}"> <label>of whom I/we am/are the parents /guardian.</label></div>
      </div>

      <div class="form-group">
       <label style="display: inline-block; margin-bottom: 10px;"><u>Particulars of minor child</u></label>
        <div class="line"><label>Name:</label><input type="text" class="no-box" value="{{ $clientData->clint->client_name ?? '' }}"></div>
        <div class="line"><label>Date of birth:</label><input type="text" class="no-box" value="{{ $clientData->clint->date_of_birth ?? '' }}"></div>
        <div class="line"><label>Place of birth:</label><input type="text" class="no-box" value="{{ $clientData->clint->clientinfo->place_of_birth ?? '' }}"></div>
      </div>

      <div class="form-group">
        <p>2. &nbsp; The minor child mentioned above is a citizen of India.</p>
        <p>3. &nbsp; I/We undertake the entire responsibility for his/her expenses.</p>
        <p>4. &nbsp; I/we &nbsp;solemnly &nbsp;declare &nbsp; that &nbsp; he/she &nbsp;has &nbsp; not &nbsp;lost,&nbsp;surrendered&nbsp; or&nbsp; been &nbsp;deprived of his /her <br>citizenship of India and that the information given in respect of him/her in this application is true.</p>
        <p>5. &nbsp; It is also certified that I/we am/are holding / not holding valid India passport(s).</p>
      </div>

      <div class="form-group">
        <div class="line"><label>Place:</label><input type="text" class="no-box" value="{{ $clientData->clint->city ?? '' }}"></div><br>
        <div class="line"><label>Date:</label><input type="text" class="no-box" value="{{ date('d/m/Y') }}"></div>
      </div>
  <div class="flex-container">
  <div class="row">
    <div>Signature of father</div>
    <div class="spacer"></div>
    <div>Signature of mother</div>
    <div class="spacer"></div>
    <div>Signature of legal guardian(s)</div>
  </div>


  <div class="row">
    <label>Passport No.
    <input type="text" style="width: 70px;" value="{{ $clientData->clint->clientinfo->passport_ic_number ?? '' }}">; or</label>

    
    <label style="margin-left: 40px;">Passport No.
    <input type="text" style="width: 70px;">; or</label>

    
    <label style="margin-left: 35px;">Passport No.
    <input type="text" style="width: 70px;">; or</label>
  </div>


  <div class="row">
    <label>Aadhaar Card No.
    <input type="text" style="width: 30px;">; or</label>

    
    <label style="margin-left: 40px;">Aadhaar Card No.
    <input type="text" style="width: 30px;">; or</label>

  
    <label style="margin-left: 40px;">Aadhaar Card No.
    <input type="text" style="width: 30px;">; or</label>
  </div>


  <div class="row">
    <label>Voter ID Card No.
    <input type="text" style="width: 50px;">;</label>

  
    <label style="margin-left: 40px;">Voter ID Card No.
    <input type="text" style="width: 50px;"></label>

    
    <label style="margin-left: 50px;">Voter ID Card No.
    <input type="text" style="width: 50px;"></label>
  </div>
</div>
</div>
  </div>
</body>
</html>
