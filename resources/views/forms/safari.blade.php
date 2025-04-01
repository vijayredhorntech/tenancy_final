<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DECLARATION</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        @page {
            size: A4;
            margin: 1in;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .form-container {
            width: 100%;
            max-width: 750px;
            margin: 0 auto 30px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
            text-decoration: underline;
        }
        h1 {
            text-align: center;
            font-size: 16pt;
            margin-bottom: 20pt;
            text-decoration: underline;
        }
        .declaration-text {
            margin-bottom: 15pt;
            text-align: justify;
        }
        .signature-line {
            margin-top: 40pt;
            display: flex;
            justify-content: space-between;
        }
        .bold {
            font-weight: bold;
        }
        /* Input field styling */
        .form-input {
            border: none;
            border-bottom: 1px solid #000;
            background: transparent;
            padding: 0 5px;
            font-family: Arial, sans-serif;
            font-size: 12pt;
            outline: none;
            min-width: 150px;
            display: inline-block;
            margin: 0 2px;
            height: 18px;
            vertical-align: bottom;
        }
        .underline-space {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 50px;
            padding: 0 5px;
        }
        .pdf-button {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }
        .pdf-button:hover {
            background-color: #45a049;
        }
        @media print {
            body {
                padding: 20mm;
            }
            .form-input {
                border-bottom: 1px solid #000 !important;
            }
        }
    </style>
</head>
<body>
    
<div class="form-container" id="form-to-export">
    <h1>DECLARATION</h1>
    
    <div class="declaration-text">
        I  <b> <input type="text" class="form-input" value="{{ $clientData->clint->clientinfo->last_name ?? '' }}"> <b> hereby declare that I am present in the UK on the date of making this application and that all the information given by me here is true, accurate and complete.
    </div>
    
    <div class="declaration-text">
        I understand that my visa application is being handled through VF Services (UK) Limited (VFS), service providers in the United Kingdom appointed by High Commission of India, London. I am aware that the grant or refusal of Service is at the sole discretion of the High Commission of India and VFS is not responsible for the same or for any delay in the receipt of the Service. The processing of your application including processing time is subject to the procedures and timescales of the Indian High Commission over which VFS has no control I hereby agree to the VF Services (UK) Terms and Conditions including Disclaimer and VFS Data Protection Policy current at the date of my application (downloadable from http://in.vfsglobal.co.uk). I accept that application fees are not refundable, except as covered by VFS's refund policy and are payable even if service is not granted. I accept that VFS limits its liability for replacement of lost passports or other travel documents, to refund of my application fee, and reimbursement of government fees in accordance with the VFS refund policy. I am responsible for the accuracy of my application form, and I accept that if VFS checks my application form, it does not guarantee that it will find any errors, and does not verify information I have provided. I accept that VFS excludes all other liability in relation to my application and advice or information given to me, including for breach of contract or negligence.
    </div>
    
    <div class="declaration-text">
        I acknowledge and agree that my application and associated data will be processed in accordance with the VFS Data Protection Policy (downloadable from http://in.vfsglobal.co.uk), and that my data may be processed by an affiliated company which may be a part of the VFS group of companies or a sub-contractor for VFS, and that such processing may take place in India but subject to the same standards as apply in the United Kingdom.
    </div>
    
    <div class="declaration-text">
        Suppression of facts or furnishing misleading/false information will result in denial of service without assigning any reason. The Embassy Fee/Service Fee/Logistic Fee once tendered is non-refundable and subject to change without notice. It is advisable to make travel arrangements after obtaining appropriate travel document and I understand that VFS shall not be responsible for any loss of bookings made in anticipation of obtaining the service (OCI/Passport/Visa/Surrender of Indian Passport).
    </div>
    
    <div class="declaration-text bold">
        I agree and acknowledge that VFS will not be able to assist me in tracking or escalating any misplaced Royal Mail self-addressed envelope which I have provided with my application, I agree and take responsibility of the Royal Mail envelope, its Tracking number and payment receipt, I further confirm that in an event of lost/damaged/delayed/misplaced or untraceable self-addressed Royal Mail envelope, I will be solely responsible in tracking and taking up the matter with Royal Mail without any assistance from VFS.
    </div>
    
    <div class="signature-line">
        <span>PLACE & DATE: <input type="text" class="form-input" value=""></span>
        <span>Signature of the Applicant: <span class="underline-space"></span></span>
    </div>
</div>

    
    <button class="pdf-button" onclick="generatePDF()">Generate PDF</button>
      <!-- ... -->
      <script>
        // Initialize jsPDF
        const { jsPDF } = window.jspdf;

        function generatePDF() {
            const element = document.getElementById('form-to-export');
            const pdfButton = document.querySelector('.pdf-button');
            
            // Temporarily hide the PDF button
            pdfButton.style.visibility = 'hidden';
            
            // Options for html2canvas
            const options = {
                scale: 2, // Higher quality
                useCORS: true,
                allowTaint: true,
                scrollX: 0,
                scrollY: 0,
                windowWidth: document.documentElement.offsetWidth,
                windowHeight: document.documentElement.offsetHeight
            };
            
            html2canvas(element, options).then(canvas => {
                // Show the button again
                pdfButton.style.visibility = 'visible';
                
                // Create PDF
                const pdf = new jsPDF({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: 'a4'
                });
                
                // Calculate dimensions
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 210; // A4 width in mm
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                
                // Add image to PDF
                pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                
                // Save the PDF
                pdf.save('Personal_Particulars_Form.pdf');
            }).catch(error => {
                console.error('Error generating PDF:', error);
                pdfButton.style.visibility = 'visible';
                alert('Error generating PDF. Please try again.');
            });
        }
    </script>
</body>
</html>