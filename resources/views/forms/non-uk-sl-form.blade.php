<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIGH COMMISSION OF INDIA, LONDON - Additional Form</title>
    <!-- Add the required libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        .dotted-input {
            border: none;
            border-bottom: 1px dotted #000;
            width: 60%;
            background-color: transparent;
            padding: 4px 0;
            font-family: Arial, sans-serif;
            outline: none;
            border-radius: 0;
            box-shadow: none;
        }
        
        /* Remove focus outline/highlight */
        .dotted-input:focus {
            outline: none;
            border-bottom: 1px dotted #000;
            background-color: transparent;
        }
        
        /* Style for the form group */
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: inline-block;
            width: 250px;
            font-weight: bold;
        }
        
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .logo {
            width: 100px;
        }
        .header-text {
            text-align: right;
            max-width: 70%;
        }
        .header-text h2, .header-text h3 {
            margin: 5px 0;
            color: #5c1e1a;
        }
        .form-title {
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group input[type="checkbox"] {
            width: auto;
        }
        .dotted-line {
            border: none;
            border-bottom: 1px dotted #000;
            display: inline-block;
            width: 60%;
            height: 20px;
            background-color: transparent;
            padding: 4px 0;
        }
        .office-use {
            margin-top: 30px;
            border-top: 1px solid #000;
            padding-top: 20px;
        }
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .signature {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div id="form-to-export" class="form-container">
        <div class="header">
            <div class="logo">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/55/Emblem_of_India.svg" alt="Emblem of India" width="100">
            </div>
            <div class="header-text">
                <h2>HIGH COMMISSION OF INDIA, LONDON</h2>
                <h3>Visa Department</h3>
                <p>India House, Aldwych<br>
                London WC2B 4NA<br>
                Fax No: 0044 207 632 3302 or<br>
                0044 207 240 6312</p>
            </div>
        </div>

        <div class="form-title">
            ADDITIONAL FORM TO BE FILLED BY NON UK RESIDENTS (IN BLOCK LETTERS)
        </div>

        <div class="form-group">
            <label for="surname">SURNAME:</label>
            <input type="text" id="surname" name="surname"  value="&nbsp;&nbsp;&nbsp;&nbsp;{{ $clientData->clint->last_name ?? '' }} "class="dotted-input">
        </div>

        <div class="form-group">
            <label for="firstname">FIRST NAME:</label>
            <input type="text" id="firstname" value="&nbsp;&nbsp;&nbsp;&nbsp;{{ $clientData->clint->first_name ?? '' }} " name="firstname" class="dotted-input">
        </div>

        <div class="form-group">
            <label for="nationality">NATIONALITY:</label>
            <input type="text" id="nationality" value="&nbsp;&nbsp;&nbsp;&nbsp;{{ $clientData->clint->clientinfo->nationality ?? '' }}  name="nationality" class="dotted-input">
        </div>
        @php
                   $fatherdetails = $clientData->clint->clientinfo->father_details ? json_decode($clientData->clint->clientinfo->father_details) : null;
                   $motherdetails = $clientData->clint->clientinfo->father_details ? json_decode($clientData->clint->clientinfo->father_details) : null;
                   $spouse = $clientData->clint->clientinfo->spouse_details ? json_decode($clientData->clint->clientinfo->spouse_details) : null;
                                  
            @endphp
        <div class="form-group">
            <label for="fathername">FATHER'S NAME:</label>
            <input type="text" id="fathername"  value="&nbsp;&nbsp;&nbsp;&nbsp;{{ $fatherdetails->name ?? '' }} " name="fathername" class="dotted-input">
        </div>

        <div class="form-group">
            <label for="dob">DATE & PLACE OF BIRTH:</label>
            <input type="text" id="dob" value="&nbsp;&nbsp;&nbsp;&nbsp; {{ $clientData->clint->date_of_birth ?? '' }} &{{ $clientData->clint->clientinfo->place_of_birth ?? '' }} "  name="dob" class="dotted-input">
        </div>

        <div class="form-group">
            <label for="passport">PASSPORT NO:</label>
            <input type="text" id="passport" value="&nbsp;&nbsp;&nbsp;&nbsp;{{ $clientData->clint->clientinfo->passport_ic_number ?? '' }}"  name="passport" class="dotted-input">
        </div>

        <div class="form-group">
            <label for="issuedetails">DATE & PLACE OF ISSUE:</label>
            <input type="text" id="issuedetails" value="&nbsp;&nbsp;&nbsp;&nbsp;{{ $clientData->clint->clientinfo->passport_issue_date ?? '' }} &{{ $clientData->clint->clientinfo->passport_issue_place ?? '' }} " name="issuedetails" class="dotted-input">
        </div>

        <div class="form-group">
            <label for="ukaddress">PERMANENET ADDRESS IN<br>UNITED KINGDOM:</label>
            <input type="text" id="ukaddress1" value="&nbsp;&nbsp;&nbsp;&nbsp;{{ $clientData->clint->permanent_address ?? '' }} "name="ukaddress1" class="dotted-input"><br>
            <label></label>
            <input type="text" id="ukaddress2" name="ukaddress2" class="dotted-input"><br>
            <label></label>
            <input type="text" id="ukaddress3" name="ukaddress3" class="dotted-input">
        </div>
        
        <div class="form-group">
            <label for="homeaddress">ADDRESS IN COUNTRY OF ORIGIN:</label>
            <input type="text" id="homeaddress1"  value="&nbsp;&nbsp;&nbsp;&nbsp;{{ $clientData->clint->client_name ?? '' }} " name="homeaddress1" class="dotted-input"><br>
            <label></label>
            <input type="text" id="homeaddress2"  value="&nbsp;&nbsp;&nbsp;&nbsp;{{ $clientData->clint->client_name ?? '' }} " name="homeaddress2" class="dotted-input"><br>
            <label></label>
            <input type="text" id="homeaddress3" name="homeaddress3" class="dotted-input">
        </div>

        <div class="form-group">
            <label for="profession">PROFESSION:</label>
            <input type="text" id="profession" value="&nbsp;&nbsp;&nbsp;&nbsp;{{ $clientData->clint->designation ?? '' }} "  name="profession" class="dotted-input">
        </div>

        <div class="form-group">
            <label for="visatype">TYPE OF VISA:</label>
            <input type="text" id="visatype" value="&nbsp;&nbsp;&nbsp;&nbsp;{{ $clientData->visa->name ?? '' }} "  name="visatype" class="dotted-input">
        </div>

        <div class="form-group signature">
            <label for="signature">SIGNATURE OF THE APPLICANT:</label>
            <input type="text" id="signature" name="signature" class="dotted-input">
        </div>

        <div class="office-use">
            <h4>(FOR OFFICE USE)</h4>
            <div class="form-group">
                <label for="no">No:</label>
                <input type="text" id="no" name="no" class="dotted-input" style="width: 30%;">
                <label for="dated" style="width: 80px;">Dated:</label>
                <input type="text" id="dated" name="dated" class="dotted-input" style="width: 30%;">
            </div>
            <p>TO: HICOMIND/IND EMBASSY / CONGENDIA</p>
            <p>WE SHALL BE GRATEFUL IF YOU COULD KINDLY CONVEY YOUR<br>
            URGENT CLEARANCE/NO OBJECTION TO ISSUE THE VISA.</p>
            <p style="margin-top: 30px;">ATTACHE (VISA)</p>
            <p>IHC/VFS form</p>
        </div>
    </div>
    
    <div class="btn-container">
        <button class="btn pdf-button" onclick="generatePDF()">Generate PDF</button>
    </div>

    <script>
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
                
                // Create PDF using the jsPDF library
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: 'a4'
                });
                
                // Calculate dimensions
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 210; // A4 width in mm
                const pageHeight = 297; // A4 height in mm
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                
                // Add image to PDF
                pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                
                // Save the PDF
                pdf.save('India_Visa_Additional_Form.pdf');
            }).catch(error => {
                console.error('Error generating PDF:', error);
                pdfButton.style.visibility = 'visible';
                alert('Error generating PDF. Please try again. Error: ' + error.message);
            });
        }
    </script>
</body>
</html>