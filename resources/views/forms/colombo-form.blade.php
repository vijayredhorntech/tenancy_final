<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIGH COMMISSION OF INDIA, LONDON U.K. - VISA DEPARTMENT</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        body {
            font-family: Times New Roman, serif;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 80px;
            float: left;
        }
        .header-text {
            text-align: center;
            margin-bottom: 30px;
        }
        .header-title {
            font-weight: bold;
            font-size: 16px;
            text-decoration: underline;
            margin-bottom: 5px;
        }
        .header-department {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .header-fax {
            font-size: 14px;
            margin-bottom: 15px;
        }
        .header-details {
            text-align: left;
            margin-left: 20%;
            margin-bottom: 15px;
        }
        .form-title {
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
            text-decoration: underline;
        }
        .form-subtitle {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            font-weight: bold;
            width: 40%;
        }
        input {
            width: 95%;
            padding: 4px;
            border: none;
            background-color: transparent;
        }
        .date-input {
            width: 40%;
            text-align: right;
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
        .signature-line {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        .signature, .date {
            margin-top: 15px;
        }
        .footer {
            margin-top: 30px;
        }
        .footer p {
            margin: 5px 0;
        }
        .right-align {
            text-align: right;
        }
        .points {
            text-align: center;
            letter-spacing: 3px;
            margin: 10px 0;
        }
        @media print {
            button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container" id="form-container">
        <div class="header">
        <img src="https://upload.wikimedia.org/wikipedia/commons/5/55/Emblem_of_India.svg" alt="Emblem of India" class="logo" width="100">
         
            <div class="header-text">
                <div class="header-title">HIGH COMMISSION OF INDIA, LONDON U.K.</div>
                <div class="header-department">VISA DEPARTMENT</div>
                <div class="header-fax">FAX NO: 0044 207 2406312 / 0044 207 632 3302</div>
            </div>
            <div class="header-details">
                <p>TO: HICOMIND, COLOMBO</p>
                <p>REF. NO:<input type="text" class="dash"> DATE: <input type="text" class="dash"> </p>
            </div>
        </div>
        
        <div class="points">.............................</div>
        
        <div class="form-title">
            Additional Form to be filled in by Sri Lankan nationals/Persons of Sri Lankan origin.
        </div>
        <div class="form-subtitle">(All in Block Letters)</div>

        <table>
            <tr>
                <th>Full Name</th>
                <td><input type="text"   value=" &nbsp; &nbsp; &nbsp; &nbsp;  {{ $clientData->clint->client_name ?? '' }} " ></td>
            </tr>
            <tr>
                <th>Surname</th>
                <td><input type="text"  value="&nbsp; &nbsp; &nbsp; &nbsp;  {{ $clientData->clint->last_name ?? '' }} " ></td>
            </tr>
            <tr>
                <th>Father's Full Name</th>
                <td><input type="text"  value="&nbsp; &nbsp; &nbsp; &nbsp;  {{ $clientData->clint->clientinfo->father_details ?? '' }} " ></td>
            </tr>
            <tr>
                <th>Spouse's Name</th>
                <td><input type="text"  value="&nbsp; &nbsp; &nbsp; &nbsp;   {{ $clientData->clint->clientinfo->spouse_details ?? '' }} " ></td>
            </tr>
            <tr>
                <th>Place of Birth</th>
                <td><input type="text"  value="&nbsp; &nbsp; &nbsp; &nbsp;  {{ $clientData->clint->clientinfo->place_of_birth ?? '' }}  " ></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><input type="text"  value="&nbsp; &nbsp; &nbsp; &nbsp;  {{ $clientData->clint->date_of_birth ?? '' }}" ></td>
            </tr>
            <tr>
                <th>Sex</th>
                <td><input type="text" value="&nbsp; &nbsp; &nbsp; &nbsp;  {{ $clientData->clint->gender ?? '' }}""></td>
            </tr>
            <tr>
                <th>Sri Lankan passport no</th>
                <td><input type="text" style="width: 55%;"> <span style="float: right;">Date of Issue: <input type="text" class="date-input"  value=" " ></span></td>
            </tr>
            <tr>
                <th>Place of issue</th>
                <td><input type="text"  value=" " ></td>
            </tr>
            <tr>
                <th>Previous Sri Lankan passport no:</th>
                <td><input type="text"  value="" ></td>
            </tr>
            <tr>
                <th>Place of issue:</th>
                <td><input type="text" style="width: 55%;"> <span style="float: right;">Date of Issue: <input type="text" class="date-input"  value="&nbsp; &nbsp; &nbsp; &nbps; {{ $clientData->clint->clientinfo->passport_issue_place ?? '' }} " ></span></td>
            </tr>
            <tr>
                <th>Present Nationality</th>
                <td><input type="text"  value="&nbsp; &nbsp; &nbsp; &nbsp;  {{ $clientData->clint->clientinfo->nationality ?? '' }}  " ></td>
            </tr>
            <tr>
                <th>Passport Number</th>
                <td><input type="text"  value="&nbsp; &nbsp; &nbsp; &nbsp;  {{ $clientData->clint->clientinfo->passport_ic_number ?? '' }}" ></td>
            </tr>
            <tr>
                <th>Place of issue:</th>
                <td><input type="text" style="width: 55%;" value="&nbsp; &nbsp; &nbsp; &nbsp;  {{ $clientData->clint->clientinfo->passport_issue_date ?? '' }} " "> <span style="float: right;">Date of Issue: <input type="text" class="date-input"  value="{{ $clientData->clint->clientinfo->passport_issue_place ?? '' }} " ></span></td>
            </tr>
            <tr>
                <th>Date of renewal</th>
                <td><input type="text"  value="&nbsp; &nbsp; &nbsp; &nbsp;  {{ $clientData->clint->clientinfo->passport_expiry_date ?? '' }} " ></td>
            </tr>
            <tr>
                <th>If holding Travel Document, supply details of previous passports</th>
                <td><input type="text"  value="" ></td>
            </tr>
            <tr>
                <th>Details if you are a dual citizen:</th>
                <td><input type="text"  value=" " ></td>
            </tr>
            <tr>
                <th>Since when are you residing in country of domicile:</th>
                <td><input type="text"  value=" " ></td>
            </tr>
            <tr>
                <th>Address in country of domicile</th>
                <td><input type="text"  value="&nbsp; &nbsp; &nbsp; &nbsp;  {{ $clientData->clint->clientinfo->last_name ?? '' }} " ></td>
            </tr>
            <tr>
                <th>Present occupation</th>
                <td><input type="text"  value="" ></td>
            </tr>
            <tr>
                <th>Date of last visit to India & previous visits</th>
                <td><input type="text"  value="" ></td>
            </tr>
            <tr>
                <th>Whether visa was ever refused. If yes please give details</th>
                <td><input type="text"  value=" " ></td>
            </tr>
            <tr>
                <th>Address in Sri Lanka:</th>
                <td><input type="text"  value="" ></td>
            </tr>
            <tr>
                <th>Exact purpose of visit to India:</th>
                <td><input type="text"  value="" ></td>
            </tr>
            <tr>
                <th>Duration:</th>
                <td><input type="text"  value="" ></td>
            </tr>
            <tr>
                <th>Number of visits proposed (Single, double, multiple)</th>
                <td><input type="text"  value="" ></td>
            </tr>
        </table>

        <div class="signature-line">
            <div class="signature">
                <p>Signature............................</p>
            </div>
            <div class="date">
                <p>Date ......<input type="date"  value="" ></p>
            </div>
        </div>

        <div class="footer">
            <p>The above applicant has applied for a visa on <input type="text" style="width: 150px; border-bottom: 1px dotted black;"> Grateful for your urgent clearance</p>
            <p class="right-align" style="margin-top: 30px;">ATTACHE (VISA)</p>
            <p class="right-align">IHC/VFS Form</p>
        </div>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <button id="generatePDF">Generate PDF</button>
        <!-- <button id="printForm">Print Form</button> -->
    </div>

    <script>
        document.getElementById('generatePDF').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            
            // Create a new jsPDF instance
            const doc = new jsPDF('p', 'mm', 'a4');
            
            // Get the form element
            const formElement = document.getElementById('form-container');
            
            // Use html2canvas to capture the form as an image
            html2canvas(formElement, {
                scale: 2, // Higher scale for better quality
                logging: false,
                useCORS: true
            }).then(canvas => {
                // Convert the canvas to an image
                const imgData = canvas.toDataURL('image/jpeg', 1.0);
                
                // Calculate the width and height to maintain aspect ratio
                const imgWidth = 210; // A4 width in mm
                const pageHeight = 297; // A4 height in mm
                const imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;
                let position = 0;
                
                // Add the image to the PDF
                doc.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
                
                // Add new pages if the content is longer than one page
                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    doc.addPage();
                    doc.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }
                
                // Save the PDF
                doc.save('colombo-form.pdf');
            });
        });

        document.getElementById('printForm').addEventListener('click', function() {
            window.print();
        });
    </script>
</body>
</html>