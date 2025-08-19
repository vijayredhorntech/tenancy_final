<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Self Declaration Form No. 4</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    @page {
      size: A4;
      margin: 15mm 20mm 15mm 20mm;
    }

    @media print {
      body {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        font-size: 11pt;
        line-height: 1.4;
      }

      .container {
        max-width: 100%;
        width: 100%;
        margin: 0;
      }

      input[type="text"], .no-box {
        border-color: black !important;
      }

      .photo-box {
        width: 150px;
        height: 180px;
        font-size: 12px;
        margin: 20px 0;
      }

      h3 {
        font-size: 14pt;
      }

      table td {
        padding-right: 20px;
      }

      .print-button { display: none; }
    }

    body {
      font-family: 'Times New Roman', Georgia, serif;
      display: flex;
      justify-content: center;
      align-items: center;
      background: #fff;
      line-height: 1.6;
      font-size: 13px;
    }

    .container {
      max-width: 800px;
      width: 90%;
      margin: auto;
    }

    h3 {
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      text-decoration: underline;
    }

    input[type="text"] {
      border: none;
      border-bottom: 1px solid black;
      width: 250px;
      outline: none;
    }

    .full-line {
      width: 100%;
    }

    .section {
      margin-top: 20px;
    }

    .signature-right {
      text-align: right;
      margin-top: 10px;
    }

    table {
      width: 100%;
      margin-top: 30px;
    }

    td {
      vertical-align: top;
      padding-right: 40px;
    }

    .no-box {
      border: none !important;
      border-bottom: 1px dashed #faf5f5 !important;
      outline: none !important;
      font-family: inherit;
      font-size: 14px;
      background-color: transparent;
      width: 100% !important;
    }

    .photo-box {
      width: 180px;
      height: 180px;
      border: 2px solid black;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      color: #666;
      cursor: pointer;
      background-size: cover;
      background-position: center;
      margin: 20px 0;
    }

    .photo-box:hover {
      background-color: #f9f9f9;
    }

    #photoInput {
      display: none;
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
  @endphp
  <div class="container">
    <div style="text-align: right; font-weight: bold;">FORM NO. 4</div>
    <h3>Self Declaration to introduce new photo on passport to match current and<br>changed appearance</h3>

    <p>I, the undersigned solemnly and sincerely declare the following:</p>

    <p>a) My father's name is <input type="text" value="{{ $fatherdetails->name ?? '' }}">;</p>
    <p>b) My date of birth is <input type="text" value="{{ $client->date_of_birth ?? '' }}">;</p>
    <p>c) My last Indian passport number is <input type="text" value="{{ $info->passport_ic_number ?? '' }}"> issued on <input type="text" style="width: 150px;" value="{{ $info->passport_issue_date ?? '' }}"> <br>at <input type="text" value="{{ $info->passport_issue_place ?? '' }}"> (photocopy enclosed).</p>
    <p>d) My appearance meanwhile has changed. My photo to match my current appearance is affixed below.</p>
    <p>e) I’m the same person as shown in my previous passport and the photo affixed below.</p>

    <div class="photo-box" id="photoBox"></div>
    <input type="file" id="photoInput" accept="image/*">

    <script>
      const photoBox = document.getElementById('photoBox');
      const photoInput = document.getElementById('photoInput');

      photoBox.addEventListener('click', () => {
        photoInput.click(); // Open file picker
      });

      photoInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            photoBox.style.backgroundImage = `url('${e.target.result}')`;
            photoBox.textContent = ''; // Remove text after image upload
          };
          reader.readAsDataURL(file);
        }
      });
    </script>

    <div class="signature-right" style="margin-right: 100px;">
      Signature of the applicant
    </div>

    <b>_______________________________________________________________________________________________</b><br>

    <div class="section">
      <p>Certification by two Indian Citizens who know the applicant personally.</p>
      <p>
        We know Mr / Mrs <input type="text"> and certify that the claim made by him / her<br>
        regarding change of appearance is true and he / she is the same person shown in the attached passport<br>
        (or copy of it) and the photo affixed above.
      </p>
    </div>

    <table>
      <tr>
        <td>
          <p>Signature</p>
          Name:<input type="text"class="no-box"><br>
          Passport Number:<input type="text" class="no-box"><br>
          Date of Issue:<input type="text" class="no-box"><br>
          Place of Issue:<input type="text" class="no-box">
        </td>
        <td>
          <p>Signature</p>
          Name:<input type="text" class="no-box"><br>
          Passport Number:<input type="text" class="no-box"><br>
          Date of Issue:<input type="text" class="no-box"><br>
          Place of Issue:<input type="text" class="no-box">
        </td>
      </tr>
    </table>

    <br><br>
    <p style="text-align: center; margin-bottom: 2px;">Name, seal and signature of passport officer who examined and accepted.</p>
  </div>
</body>
</html>

