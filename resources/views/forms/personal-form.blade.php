<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Particulars Form</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
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
        .section {
            margin-bottom: 15px;
        }
        .field {
            margin-bottom: 10px;
        }
        .underline {
            border-bottom: 1px solid black;
            display: inline-block;
            min-width: 200px;
            padding: 0 5px;
        }
     
        .columns {
            display: flex;
            justify-content: space-between;
        }
        .column {
            width: 48%;
        }
        .signature-box {
            margin-top: 30px;
            text-align: right;
        }
        input[type="text"], textarea {
            border: none;
            border-bottom: 1px solid black;
            background: transparent;
            padding: 0 5px;
            min-width: 200px;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        textarea {
            width: 100%;
            height: 60px;
            resize: vertical;
        }
        input[type="text"]:focus, textarea:focus {
            outline: none;
            background-color: #f0f8ff;
        }
        .checkbox-group {
            display: inline-block;
            margin-right: 15px;
        }
        .missing-data {
            color: red;
            font-size: 10px;
            font-style: italic;
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
    </style>
</head>
<body>

    <div class="form-container" id="form-to-export">
        <div class="form-title">PERSONAL PARTICULARS FORM</div>

        <div class="section">
            <div class="field">
                1. Full Name (Initials not allowed): 
                <input type="text" name="full_name" class="editable" value="{{ $clientData->clint->name ?? '' }} {{ $clientData->clint->clientinfo->last_name ?? '' }}">
            </div>

            <div class="field">
                2. Sex: 
                <div class="checkbox-group">
                    <input type="checkbox" id="male" name="gender" value="Male" 
                        {{ isset($clientData->clint->clientinfo->gender) && $clientData->clint->clientinfo->gender == 'Male' ? 'checked' : '' }}>
                    <label for="male">Male</label>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="female" name="gender" value="Female" 
                        {{ isset($clientData->clint->clientinfo->gender) && $clientData->clint->clientinfo->gender == 'Female' ? 'checked' : '' }}>
                    <label for="female">Female</label>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="other" name="gender" value="Other" 
                        {{ isset($clientData->clint->clientinfo->gender) && $clientData->clint->clientinfo->gender == 'Other' ? 'checked' : '' }}>
                    <label for="other">Others</label>
                </div>
                @if(empty($clientData->clint->clientinfo->gender))
                    <span class="missing-data">Gender not specified</span>
                @endif
            </div>

            <div class="field">
                3. (a) Has the applicant ever changed name? 
                <input type="text" name="name_changed" class="editable" value="{{ $clientData->clint->clientinfo->name_changed ?? '' }}" test="Yes/No">
                <br>
                (b) If yes, previous name: 
                <input type="text" name="previous_name" class="editable" value="{{ $clientData->clint->clientinfo->previous_name ?? '' }}" test="Enter previous name">
            </div>

            <div class="field">
                4. Date of Birth: 
                <input type="text" name="dob" class="editable" test="DD/MM/YYYY" value="{{ $clientData->clint->clientinfo->dob ?? '' }}">
                
                5. Place of Birth: 
                <input type="text" name="birth_place" class="editable" value="{{ $clientData->clint->clientinfo->birth_place ?? '' }}">
            </div>

            <div class="field">
                6. Profession: 
                <input type="text" name="profession" class="editable" value="{{ $clientData->clint->clientinfo->profession ?? '' }}" test="Enter profession">
            </div>

            <div class="field">
                7. a) Father: 
                <input type="text" name="father_name" class="editable" value="{{ $clientData->clint->clientinfo->father_name ?? '' }}" test="Enter father's name">
                <br>
                b) Mother: 
                <input type="text" name="mother_name" class="editable" value="{{ $clientData->clint->clientinfo->mother_name ?? '' }}" test="Enter mother's name">
                <br>
                c) Husband / Wife: 
                <input type="text" name="spouse_name" class="editable" value="{{ $clientData->clint->clientinfo->spouse_name ?? '' }}" test="Enter spouse's name">
            </div>
        </div>

        <div class="section">
            <div class="columns">
                <div class="column">
                    <div class="field">
                        8. a) Permanent Address & Tel. No.<br>
                        <textarea name="permanent_address" class="editable" test="Enter permanent address">{{ $clientData->clint->clientinfo->residential_address ?? '' }}</textarea>
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        8(b) Present Residential Address & Tel. No.<br>
                        <textarea name="present_address" class="editable" test="Enter present address">{{ $clientData->clint->clientinfo->present_address ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="field">
                9. If not residing at the present address continuously for the last one year, provide details:<br>
                From <input type="text" class="editable"> To <input type="text" class="editable"> 
                From <input type="text" class="editable"> To <input type="text" class="editable">
            </div>
        </div>

        <div class="section">
            <div class="field">
                10. References (Two responsible persons who can vouch for the applicant):<br>
                <div class="columns">
                    <div class="column">
                        (1) Name, Address & Tel. No.<br>
                        <input type="text" name="reference1_name" class="editable" value="{{ $clientData->clint->clientinfo->reference1_name ?? '' }}" test="Reference 1 name">
                        <br>
                        <textarea name="reference1_address" class="editable" test="Reference 1 address">{{ $clientData->clint->clientinfo->reference1_address ?? '' }}</textarea>
                    </div>
                    <div class="column">
                        (2) Name, Address & Tel. No.<br>
                        <input type="text" name="reference2_name" class="editable" value="{{ $clientData->clint->clientinfo->reference2_name ?? '' }}" test="Reference 2 name">
                        <br>
                        <textarea name="reference2_address" class="editable" test="Reference 2 address">{{ $clientData->clint->clientinfo->reference2_address ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="field">
                11. Citizenship of India by: 
                <input type="checkbox"> Birth 
                <input type="checkbox"> Descent 
                <input type="checkbox"> Registration 
                <input type="checkbox"> Naturalization
            </div>
        </div>

        <div class="section">
            <div class="field">
                12. Previous Passport / Travel Document (if any):<br>
                (i) Passport/Travel document No: 
                <input type="text" name="passport_number" class="editable" value="{{ $clientData->clint->passport_number ?? '' }}" test="Passport number">
                <br>
                (ii) Date & Place of Issue: 
                <input type="text" name="passport_issue_date" class="editable" value="{{ $clientData->clint->clientinfo->passport_issue_date ?? '' }}" test="Issue date">
                / 
                <input type="text" name="passport_issue_place" class="editable" value="{{ $clientData->clint->clientinfo->passport_issue_place ?? '' }}" test="Issue place">
            </div>
        </div>

        <div class="section">
            <div class="field" style="font-weight: bold;">
                For Police Use Only
            </div>
            <div class="field">
                MOBILE: <input type="text" class="editable">
            </div>
            <div class="field">
                Recommended Passport: <input type="checkbox"> YES <input type="checkbox"> NO
            </div>
        </div>

        <div class="signature-box">
            Signature or Thumb Impression of the applicant<br>
            (Left Hand T.I. if male and Right Hand T.I. if female)
        </div>
    </div>

    <button class="pdf-button" onclick="generatePDF()">Generate PDF</button>

    <!-- Script section remains the same -->
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