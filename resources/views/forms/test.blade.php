<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Particulars Form</title>
    <style>
        @page {
            size: A4;
            margin: 1in; /* 1-inch margin for proper spacing */
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .form-container {
            width: 100%;
            max-width: 750px;
            margin: auto;
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
    </style>
</head>
<body>

    <div class="form-container">
        <div class="form-title">PERSONAL PARTICULARS FORM</div>

        <div class="section">
            <div class="field">
                1. Full Name (Initials not allowed): 
                <span class="underline">
                    {{$clientData->clint->name ?? ''}} {{$clientData->clint->clientinfo->last_name ?? ''}}
                </span>
            </div>

            <div class="field">
                2. Sex: 
                <input type="checkbox" {{ isset($clientData->clint->clientinfo->gender) && $clientData->clint->clientinfo->gender == 'Male' ? 'checked' : '' }}> Male 
                <input type="checkbox" {{ isset($clientData->clint->clientinfo->gender) && $clientData->clint->clientinfo->gender == 'Female' ? 'checked' : '' }}> Female 
                <input type="checkbox" {{ isset($clientData->clint->clientinfo->gender) && $clientData->clint->clientinfo->gender == 'Other' ? 'checked' : '' }}> Others 
            </div>

            <div class="field">
                3. (a) Has the applicant ever changed name? <span class="underline"></span><br>
                (b) If yes, previous name: <span class="underline"></span>
            </div>

            <div class="field">
                4. Date of Birth: <span class="underline">&nbsp; &nbsp; {{$clientData->clint->clientinfo->dob ?? '' }}</span>  
                5. Place of Birth: <span class="underline">&nbsp; &nbsp; {{$clientData->clint->clientinfo->birth_place ?? ''}}</span>
            </div>

            <div class="field">
                6. Profession: <span class="underline">&nbsp; &nbsp; {{$clientData->clint->clientinfo->profession ?? ''}}</span>
            </div>

            <div class="field">
                7. a) Father: <span class="underline">&nbsp; &nbsp; &nbsp; &nbsp; {{$clientData->clint->clientinfo->father_name ?? ''}}</span><br>
                b) Mother: <span class="underline">&nbsp; &nbsp; &nbsp; &nbsp; {{$clientData->clint->clientinfo->mother_name ?? ''}}</span><br>
                c) Husband / Wife: <span class="underline">&nbsp; &nbsp; &nbsp; &nbsp; {{$clientData->clint->clientinfo->spouse_name ?? ''}}</span>
            </div>
        </div>

        <div class="section">
            <div class="columns">
                <div class="column">
                    <div class="field">
                        8. a) Permanent Address & Tel. No.<br>
                        <span class="underline">&nbsp; &nbsp; &nbsp; &nbsp; {{$clientData->clint->clientinfo->residential_address ?? ''}}</span>
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        8(b) Present Residential Address & Tel. No.<br>
                        <span class="underline">&nbsp; &nbsp; &nbsp; &nbsp; {{$clientData->clint->clientinfo->present_address ?? ''}}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="field">
                9. If not residing at the present address continuously for the last one year, provide details:<br>
                From <span class="underline"></span> To <span class="underline"></span> From <span class="underline"></span> To <span class="underline"></span>
            </div>
        </div>

        <div class="section">
            <div class="field">
                10. References (Two responsible persons who can vouch for the applicant):<br>
                <div class="columns">
                    <div class="column">
                        (1) Name, Address & Tel. No.<br>
                        <span class="underline">&nbsp; &nbsp; {{$clientData->clint->clientinfo->reference1_name ?? ''}}</span><br>
                        <span class="underline">&nbsp; &nbsp; {{$clientData->clint->clientinfo->reference1_address ?? ''}}</span>
                    </div>
                    <div class="column">
                        (2) Name, Address & Tel. No.<br>
                        <span class="underline">&nbsp; &nbsp;  {{$clientData->clint->clientinfo->reference2_name ?? ''}}</span><br>
                        <span class="underline">&nbsp; &nbsp; {{$clientData->clint->clientinfo->reference2_address ?? ''}}</span>
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
                (i) Passport/Travel document No: <span class="underline"> &nbsp; &nbsp; {{$clientData->clint->passport_number ?? ''}}</span><br>
                (ii) Date & Place of Issue: <span class="underline"> &nbsp; &nbsp; {{$clientData->clint->clientinfo->passport_issue_date ?? ''}} / {{$clientData->clint->clientinfo->passport_issue_place ?? ''}}</span>
            </div>
        </div>

        <div class="section">
            <div class="field" style="font-weight: bold;">
                For Police Use Only
            </div>
            <div class="field">
                MOBILE: <span class="underline"></span>
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

</body>
</html>
