<!DOCTYPE html>
<html>
<head>
  <title>Personal Particulars Form</title>
 <style>
  @media print {
    @page {
      size: A4;
      margin: 8mm;
    }
    body {
      margin: 0;
    }
    .print-button {
      display: none;
    }
  }

  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: Arial, sans-serif;
    font-size: 15px;
    line-height: 1.05;
    background: white;
  }

  .container {
    width: 180mm;
    padding: 0;
    margin: auto;
    box-sizing: border-box;
  }

  h2 {
    text-align: center;
    font-size: 16px;
    margin: 0;
  }

  .form-group {
    margin-bottom: 3px;
  }

  .label {
    display: inline-block;
    vertical-align: top;
  }

  input[type="text"], input[type="date"] {
    width: 800px;
    padding: 2px;
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: dashed 1px black;
    outline: none;
    line-height: 1.1;
    font-size: 15px;
  }

  .section {
    margin-top: 4px;
  }

  .photo-box {
    border: 1px solid black;
    width: 45mm;
    height: 35mm;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: white;
    position: relative;
    margin-top: 5px;
    flex-shrink: 0;
  }

  .photo-box input[type="file"] {
    opacity: 0;
    width: 100%;
    height: 100%;
    position: absolute;
    cursor: pointer;
  }

  .photo-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  textarea {
    width: 100%;
    height: 45px;
    font-size: 15px;
  }

  .checkbox-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
  }

  .police-box {
    border: 1px solid black;
    padding: 10px;
    margin-top: 15px;
    width: 360px;
    height: 90px;
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
     </style>
    </head>


 <body>
  <button class="print-button" onclick="window.print()">Print Form</button>
  <div class="container">

  <div class="header-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
   <h2 style="margin: 0; font-size: 20px; flex: 1;">PERSONAL PARTICULARS FORM</h2>
   <div class="photo-box" id="photoBox">
     <input type="file" id="photoUpload" accept="image/*">
     <span style="z-index: 1; font-size: 12px; color: white;"></span>
   </div>
 </div>

 @php
   $client = $clientData->clint ?? null;
   $info = $client && isset($client->clientinfo) ? $client->clientinfo : null;
   $fatherdetails = $info && $info->father_details ? json_decode($info->father_details) : null;
   $motherdetails = $info && $info->mother_details ? json_decode($info->mother_details) : null;
   $spouse = $info && $info->spouse_details ? json_decode($info->spouse_details) : null;
   $referenceAddress = $info && $info->reference_address ? json_decode($info->reference_address) : null;
 @endphp

      <script>
  const photoUpload = document.getElementById('photoUpload');
  const photoBox = document.getElementById('photoBox');

  photoUpload.addEventListener('change', function () {
    const file = this.files[0];
    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function (e) {
        photoBox.innerHTML = `
          <input type="file" id="photoUpload" accept="image/*">
          <img src="${e.target.result}" alt="Uploaded Photo">
        `;
        document.getElementById('photoUpload').addEventListener('change', arguments.callee);
      };
      reader.readAsDataURL(file);
    } else {
      photoBox.innerHTML = `
        <input type="file" id="photoUpload" accept="image/*">
        <span style="z-index: 1; font-size: 12px; color: #888;">Click to upload photo</span>
      `;
      alert('Please upload a valid image file.');
      document.getElementById('photoUpload').addEventListener('change', arguments.callee);
    }
  });
</script>
  <div class="form-group">
    <label class="label">1. Full name (Initials not allowed):<input type="text" name="fullname" style="width: 450px;" value="{{ $client->last_name ?? '' }}"></label><br>
    <input type="text" name="fullname" style="width: 670px;" value="{{ $client->client_name ?? trim(($client->first_name ?? '').' '.($client->last_name ?? '')) }}">
  </div>

  <div class="form-group">
    <label class="label">2. Sex:Male/Female/Others</label><input type="Text"  value="{{ $client->gender ?? '' }}" style="width: 150px;">
  </div>

  <div class="form-group section">
    (a) Has the applicant ever changed name? <input type="text" value="{{ ($info->previous_name_status ?? 0) ? 'Yes' : 'No' }}" style="width: 100px;"> <br>
    (b) If yes, previous name: <input type="text" name="prevname" style="width: 500px;" value="{{ $info->previous_name ?? '' }}">
  </div>

  <div class="form-group">
     4. Date of Birth:
    <input type="Text" value="{{ $client->date_of_birth ?? '' }}" style="width:220px;">&nbsp;5. Place of Birth:
    <input type="text" value="{{ $info->place_of_birth ?? '' }}" style="width: 220px;">
  </div>

  <div class="form-group">
    <label>6. Profession:</label>
    <input type="text" name="profession" style="width: 570px;" value="{{ $info->present_occupation ?? '' }}">
  </div>

  <div class="form-group">
    <label>7. a) Father:</label>
     <input type="text" name="" style="width: 580px;" value="{{ $fatherdetails->name ?? '' }}"><br>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (Surname) <span style="margin-left: 150px;"> (Name)</span>         
  </div>

  <div class="form-group">
    <label>b) Mother:</label>
     <input type="text" name="" style="width: 590px;" value="{{ $motherdetails->name ?? '' }}"><br>
      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (Surname)<span style="margin-left: 150px;"> (Name) </span>
  </div>

  <div class="form-group">
    <label>c) Husband / Wife:</label>
     <input type="text" name="" style="width: 530px;" value="{{ $spouse->name ?? '' }}"><br>
       &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(Surname) <span style="margin-left: 150px;">(Name)</span>
  </div>

  <div class="form-group">
    <label>8 a) Permanent Address & Tel. No., </label><span style="margin-left: 80px;"></span><label>8 b) Present Residential Address & Tel. No.,along with </label><br>
            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;along with Police Station: <span style="margin-left: 150px;"></span>  &nbsp;Police Station and residing since:<br>
   <span style="margin-left: 30px;"></span> <input type="text" value="{{ $client->permanent_address ?? '' }}" style="width: 250px;"><span style="margin-left: 120px;"></span>
    <input type="text" value="{{ $client->address ?? '' }}" style="width: 250px;"><br>
     <span style="margin-left: 30px;"></span> <input type="text" value="{{ trim(($client->city ?? '').' '.($client->country ?? '').' '.($client->zip_code ?? '')) }}" style="width: 250px;"><span style="margin-left: 120px;"></span>
    <input type="text" value="{{ trim(($client->city ?? '').' '.($client->country ?? '').' '.($client->zip_code ?? '')) }}" style="width: 250px;"><br>
     <span style="margin-left: 30px;"></span> <input type="text" value="{{ trim(($client->phone_number ?? '').' '.($client->email ?? '')) }}" style="width: 250px;"><span style="margin-left: 120px;"></span>
    <input type="text" value="" style="width: 250px;">
  </div>
  <div class="form-group">
    9. If you have not been resident at the address given at COLUMN 8(b) continuously for the last one year, <br>
    please furnish other address(es) with duration(s) resided (Please furnish an additional set of P P Forms <br>
    for each address with Police station).<br><br>

   
  <div style="display: flex; gap: 40px; margin-bottom: 5px;">
    <div>
      From: <input type="text" name="from1" style="width: 120px;">
      To: <input type="text" name="to1" style="width: 120px;">
    </div>
    <div>
      From: <input type="text" name="from2" style="width: 120px;">
      To: <input type="text" name="to2" style="width: 120px;">
    </div>
  </div>

  <div style="display: flex; gap: 40px; margin-bottom: 5px;">
    <input type="text" style="width: 330px;">
    <input type="text" style="width: 330px;">
  </div>
  <div style="display: flex; gap: 40px; margin-bottom: 5px;">
    <input type="text" style="width: 330px;">
    <input type="text" style="width: 330px;">
  </div>
  <div style="display: flex; gap: 40px;">
    <input type="text" style="width: 330px;">
    <input type="text" style="width: 330px;">
  </div>
</div>
  <label><strong>10. Reference:</strong> Name and Addresses of two responsible persons in the applicant's loaclity who can voch <br>for the applicant</label><br>
  (1) Name, Address & Tel. No.  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(2) Name, Address & Tell. No.<br>
  <div style="display: flex; gap: 40px; margin-bottom: 5px;">
    <input type="text" style="width: 330px;" value="{{ $info->reference_name ?? '' }}">
    <input type="text" style="width: 330px;" value="{{ $referenceAddress->reference_address_1 ?? '' }}">
  </div>
  <div style="display: flex; gap: 40px; margin-bottom: 5px;">
    <input type="text" style="width: 330px;" value="{{ $referenceAddress->reference_address_2 ?? '' }}">
    <input type="text" style="width: 330px;" value="">
  </div>
  <div style="display: flex; gap: 40px;">
    <input type="text" style="width: 330px;">
    <input type="text" style="width: 330px;">
  </div>
  </div>

<div class="container">

 
  <div class="form-group" style="display: flex; align-items: center; gap: 30px;">
  <label style="white-space: nowrap;">11. Citizenship of India by:</label>
  <div class="checkbox-group" style="display: flex; gap: 15px;">
    <label>Birth <input type="checkbox" name="citizenship" value="birth"></label>
    <label>Descent <input type="checkbox" name="citizenship" value="descent"></label>
    <label>Registration <input type="checkbox" name="citizenship" value="registration"></label>
    <label>Naturalization <input type="checkbox" name="citizenship" value="naturalization"></label>
  </div>
</div>


  <div class="form-group">
    <label>12. Furnish details of previous passport / travel document, if any:</label><br>
    (i) Passport/Travel document No.:
    <input type="text" name="passport_no" style="width: 110px; margin-right: 30px;" value="{{ $info->passport_ic_number ?? '' }}">
    (ii) Date & Place of issue:
    <input type="text" name="passport_issue" style="width: 250px;" value="{{ trim(($info->passport_issue_date ?? '').' '.($info->passport_issue_place ?? '')) }}">
  </div>

  <div class="form-group" style="display: flex; justify-content: space-between; align-items: flex-start; margin-top: 10px;">
    <div class="police-box">
      <strong><u>For Police Use Only</u></strong><br><br><br>
      Recommended Passport: <strong>YES</strong> / <strong>NO</strong>
    </div>

    <div style="display: flex; flex-direction: column; align-items: flex-end;">
      <div style="width: 250px; text-align: center; border-bottom: 1px dashed black; margin-bottom: 5px; margin-top: 50px;">
        <strong>Signature or Thumb Impression of the applicant</strong>
      </div>
      <div style="font-size: 11px; text-align: center;">
        (Left Hand T.I. if male and Right Hand T.I. if female)
      </div>
    </div>
  </div>

</div> 
</body>
</html>