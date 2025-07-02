<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Annexure - E</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  
</head>
<body>

  <div class="container" id="form-container"> 

  <style>
    body {
      font-family: 'Times New Roman', serif;
      line-height: 1.5;
      margin: 0;
      padding: 20px;
    }
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }
    .form-title {
      text-align: center;
      font-weight: bold;
      font-size: 18px;
      margin: 10px 0;
      text-decoration: underline;
    }
    .form-subtitle {
      text-align: center;
      font-weight: bold;
      margin-bottom: 30px;
    }
    p, td, li {
      font-size: 14px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    .nested-table td {
      padding-left: 50px;
    }
    .bottom-section {
      display: flex;
      justify-content: space-between;
      margin-top: 40px;
    }
    .signature {
      text-align: right;
    }
    input {
      border: none;
      border-bottom: 1px dotted black;
      width: 250px;
      background: transparent;
    }
    button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 20px;
    }
    button:hover {
      background-color: #45a049;
    }
    @media print {
      button {
        display: none;
      }
    }
  </style>

    <div class="form-title">Annexure-‘E’</div>
    <div class="form-subtitle">SPECIMEN DECLARATION OF THE APPLICANT ON A PLAIN PAPER</div>

    <p>
      I, <input type="text"> (name), son/ daughter/ wife of Shri <input type="text">, residing at <input type="text">,
      Date of Birth <input type="text">, being an applicant for issue of passport, do hereby solemnly affirm and state the following:
    </p>

    <ol>
      <li>That the names of my parents and spouse are as follows:
        <table class="nested-table">
          <tr><td>(i) Father: <input type="text"></td></tr>
          <tr><td>(ii) Mother: <input type="text"></td></tr>
          <tr><td>(iii) Wife/Husband: <input type="text"></td></tr>
        </table>
      </li>
      <li>That I am a continuous resident at the above-mentioned address from <input type="text"></li>
      <li>That I am a citizen of India by birth/descent/registration/naturalization and that I have neither acquired the citizenship of another country nor have surrendered or been terminated/deprived of my citizenship of India.</li>
      <li>That I have not, at any time during the period of five years immediately preceding the date of this declaration, been convicted by any court in India for any offence involving moral turpitude and sentenced in respect thereof to imprisonment for not less than two years.</li>
      <li>That no proceedings in respect of any criminal offence alleged to have been committed by me are pending before any criminal court in India.</li>
      <li>That no warrant or summons for my appearance, and no warrant for my arrest, has been issued by a court under any law for the time being in force, and that my departure from India has not been prohibited by order of any such court.</li>
      <li>That I have never been repatriated from abroad back to India at the expense of Government of India / I was repatriated from abroad back to India at the expense of Government of India, but reimbursed the expenditure incurred in connection with such repatriation.</li>
      <li>That I will not engage in activities prejudicial to the sovereignty and integrity of India.</li>
      <li>That my departure from India will not be detrimental to the security of India.</li>
      <li>That my presence outside India will not prejudice the friendly relations of India with any foreign country.</li>
    </ol>

    <div class="bottom-section">
      <div>
        Place: <input type="text"><br><br>
        Date: <input type="text">
      </div>
      <div class="signature">
        <b>(Signature of applicant)</b>
      </div>
    </div>
  </div>

  <div style="text-align: center; margin-top: 20px;">
    <button id="generatePDF">Generate PDF</button>
  </div>

  <script>
    document.getElementById('generatePDF').addEventListener('click', function () {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF('p', 'mm', 'a4');
  const formElement = document.getElementById('form-container');

  // ⬇ Replace input with spans for static capture
  const inputs = formElement.querySelectorAll('input');
  inputs.forEach(input => {
    const span = document.createElement('span');
    span.style.borderBottom = '1px dotted black';
    span.style.minWidth = '150px';
    span.style.display = 'inline-block';
    span.textContent = input.value || " ";
    input.parentNode.replaceChild(span, input);
  });

  html2canvas(formElement, {
    scale: 2,
    logging: false,
    useCORS: true
  }).then(canvas => {
    const imgData = canvas.toDataURL('image/jpeg', 1.0);
    const imgWidth = 210;
    const pageHeight = 297;
    const imgHeight = canvas.height * imgWidth / canvas.width;
    let heightLeft = imgHeight;
    let position = 0;

    doc.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight);
    heightLeft -= pageHeight;

    while (heightLeft >= 0) {
      position = heightLeft - imgHeight;
      doc.addPage();
      doc.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight);
      heightLeft -= pageHeight;
    }

    doc.save('annexure-e.pdf');
  });
});
</script>
</body>
</html>
