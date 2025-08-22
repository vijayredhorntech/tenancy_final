<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Application for Schengen Visa</title>
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 13px;
        margin: 0;
        line-height: 1.4;
        padding: 20px;
    }
    .a4 {
        width: 210mm;
        min-height: 297mm;
        padding: 15mm;
        margin: auto;
        background: white;
        border: 1px solid #000;
        box-sizing: border-box;
        page-break-after: always;
    }
    h2 {
        text-align: center;
        margin:  0;
    }
    
    .full-width-text {
      border: 1px solid #000;
      border-top: none;
      padding: 10px;
      text-align: justify;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }
    td, th {
        border: 1px solid #000;
        padding: 4px;
        vertical-align: top;
    }
    .checkbox {
        display: inline-block;
        width: 12px;
        height: 12px;
        border: 1px solid #000;
        margin-right: 5px;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
        margin-bottom: 30px;
    }
    .header img {
        width: 150px;
    }
    .photo-box {
       width: 120px;
            height: 150px;
            border: 1px solid #000;
              text-align: center;
              color: blue;
        position: relative;
        cursor: pointer;
        background-color: #d6e9ef;
        overflow: hidden;
    }
    .photo-box:hover {
        background-color: #e8f4fc;
    }
    .photo-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
        position: absolute;
        top: 0;
        left: 0;
    }
    .photo-input {
        display: none;
    }
          
    .small-text {
        font-size: 10px;
    }
    .form-wrapper {
        display: grid;
        grid-template-columns: 70% 30%; /* left form + right official use */
        gap: 0;
    }
    .official-box {
        border-left: 1px solid #000;
        padding: 5px;
        font-size: 11px;
    }
    .official-box h4 {
        margin: 0 0 5px 0;
        text-align: center;
        text-transform: uppercase;
    }
    .official-box p {
        margin: 3px 0;
    }
      .section-title {
      font-weight: bold;
    }
    .right-col {
      width: 20%;
      text-align: center;
      vertical-align: top;
    }
    .left-col {
      width: 80%;
    }
   
        .boxed-text {
            border: 1px solid #bbb;
            padding: 15px;
            margin: 15px 0;
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        p {
            margin-bottom: 12px;
        }
      
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .signature-table td {
            padding: 12px;
            vertical-align: top;
            border: 1px solid #ccc;
            background-color: #fff;
        }
        .footer-note {
            margin-top: 15px;
            font-style: italic;
            color: #666;
            font-size: 0.9em;
            text-align: left;
        }
        input[type="text"] {
          outline: none;
          text-decoration: none;
           border-bottom: 1px solid #ededed;
           border:none;
        }
</style>
</head>
<body>

<!-- PAGE 1 -->
<div class="a4">

    <!-- Header -->
    <div class="header">
      <div style="display: flex; flex-direction: column; align-items: flex-start; justify-content: flex-start;">
        <div style="font-size: 11px; margin-bottom: 5px; text-align: left;">Harmonised application form (1)</div>
        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b7/Flag_of_Europe.svg" alt="EU Flag">
          </div>
          <div>
            <h2>Application for Schengen Visa</h2>
            <p style="text-align:center;">This application form is free.</p>
        </div>
         <div class="photo-box" id="photoContainer">
        <div style="text-align: center;">Photo</div>
        <img id="photoPreview" class="photo-preview" alt="Photo preview">
        <input type="file" id="photoInput" class="photo-input" accept="image/*">
    </div>
</div>
    <!-- Form + Official Use -->
    <div class="form-wrapper">

        <!-- LEFT: Application Form -->
   <table>
    <tr>
        <td>1. Surname (Family name)</td>
        <td><input type="text"></td>
    </tr>
    <tr>
        <td>2. Surname at birth (Former family name(s))</td>
        <td><input type="text"></td>
    </tr>
    <tr>
        <td>3. First name(s) (Given name(s))</td>
        <td><input type="text"></td>
    </tr>
    <tr>
        <td>4. Date of birth (day-month-year)</td>
        <td>5. Place of birth <input type="text"></td>
    </tr>
    <tr>
        <td>6. Country of birth</td>
        <td>7. Current nationality / Nationality at birth, if different <input type="text"></td>
    </tr>
    <tr>
        <td>
            8. Sex<br>
            <input type="checkbox"> Male 
            <input type="checkbox"> Female
        </td>
        <td>
            9. Marital status<br>
            <input type="checkbox"> Single 
            <input type="checkbox"> Married
            <input type="checkbox"> Separated 
            <input type="checkbox"> Divorced
            <input type="checkbox"> Widow(er) 
            <input type="checkbox"> Other
        </td>
    </tr>
    <tr>
        <td colspan="2">10. In the case of minors: 
            <input type="text" style="width:80%">
        </td>
    </tr>
    <tr>
        <td colspan="2">11. National identity number, where applicable 
            <input type="text" style="width:50%">
        </td>
    </tr>
    <tr>
        <td colspan="2">12. Type of travel document<br>
            <input type="checkbox"> Ordinary passport
            <input type="checkbox"> Diplomatic passport
            <input type="checkbox"> Service passport
            <input type="checkbox"> Official passport
            <input type="checkbox"> Special passport
            <input type="checkbox"> Other
        </td>
    </tr>
    <tr>
        <td>13. Number of travel document <input type="text"></td>
        <td>14. Date of issue <input type="text"></td>
    </tr>
    <tr>
        <td>15. Valid until <input type="text"></td>
        <td>16. Issued by <input type="text"></td>
    </tr>
    <tr>
        <td>17. Applicant's home address and e-mail address <input type="text" style="width:90%"></td>
        <td>Telephone number(s) <input type="text"></td>
    </tr>
    <tr>
        <td colspan="2">18. Residence in a country other than the country of current nationality<br>
            <input type="checkbox"> No 
            <input type="checkbox"> Yes, Residence permit No <input type="text" style="width:100px"> Valid until <input type="text" style="width:100px">
        </td>
    </tr>
    <tr>
        <td colspan="2">19. Current occupation <input type="text" style="width:80%"></td>
    </tr>
    <tr>
        <td colspan="2">20. Employer and employer's address and telephone number. For students, name and address of educational establishment. 
            <input type="text" style="width:90%">
        </td>
    </tr>
    <tr>
        <td colspan="2">21. Main purpose(s) of the journey<br>
            <input type="checkbox"> Tourism 
            <input type="checkbox"> Business
            <input type="checkbox"> Visiting family or friends 
            <input type="checkbox"> Cultural
            <input type="checkbox"> Sports 
            <input type="checkbox"> Official visit
            <input type="checkbox"> Medical reasons 
            <input type="checkbox"> Study
            <input type="checkbox"> Transit 
            <input type="checkbox"> Airport transit
            <input type="checkbox"> Other
        </td>
    </tr>
</table>

<!-- RIGHT: Official Use Only -->
<div class="official-box">
    <h4>FOR OFFICIAL USE ONLY</h4>


    Date of application: <input type="text" style="width:150px"><br><br>
    Application number: <input type="text" style="width:150px"><br><br>
    Application lodged at: <input type="text" style="width:150px"><br><br>
    Consulate: <input type="text" style="width:150px"><br><br>
    Service provider: <input type="text" style="width:150px"><br><br>
    Commercial intermediary: <input type="text" style="width:150px"><br><br>
    Other: <input type="text" style="width:150px"><br><br>

    File handled by: <input type="text" style="width:150px"><br><br>

    Supporting documents:<br>
    <input type="checkbox"> Travel document<br>
    <input type="checkbox"> Means of subsistence<br>
    <input type="checkbox"> Invitation<br>
    <input type="checkbox"> Means of transport<br>
    <input type="checkbox"> Other: <input type="text" style="width:120px"><br><br>

    Visa decision:<br>
    <input type="checkbox"> Refused<br>
    <input type="checkbox"> Issued: A / C / D / LTV<br><br>

    Valid: From <input type="text" style="width:100px"> Until <input type="text" style="width:100px"><br><br>
    Number of entries: <input type="checkbox"> 1 <input type="checkbox"> 2 <input type="checkbox"> Multiple<br><br>
    Number of days: <input type="text" style="width:100px">
</div>

    </div><!-- /form-wrapper -->

    <p class="small-text">(1) No logo is required for Norway, Iceland and Switzerland.</p>

<!-- /Page 1 -->

<!-- PAGE 2 -->
<!-- PAGE 2 -->
  <div class="form-wrapper">
    
    <!-- LEFT SIDE FORM (70%) -->
    <div class="form-left">
    <table>
        <tr>
          <td><b>22</b> Member State(s) of destination</td>
        </tr>
        <tr>
          <td><b>23</b> Member State of first entry</td>
        </tr>
        <tr>
          <td>
            <b>24</b> Number of entries requested<br>
            <label><input type="checkbox"> Single entry</label> 
            <label><input type="checkbox"> Two entries</label> 
            <label><input type="checkbox"> Multiple entries</label>
          </td>
        </tr>
        <tr>
          <td>
            <b>25</b> Duration of the intended stay or transit<br>
            Indicate number of days: <input type="text" style="width:150px;">
          </td>
        </tr>
        <tr>
          <td>
            <b>26</b> Schengen visas issued during the past three years<br>
            <label><input type="checkbox"> No</label> 
            <label><input type="checkbox"> Yes. Date(s) of validity from <input type="text" style="width:120px;"> to <input type="text" style="width:120px;"></label>
          </td>
        </tr>
        <tr>
          <td>
            <b>27</b> Fingerprints collected previously for the purpose of applying for a Schengen visa<br>
            <label><input type="checkbox"> No</label> 
            <label><input type="checkbox"> Yes — Date, if known: <input type="text" style="width:150px;"></label>
          </td>
        </tr>
        <tr>
          <td>
            <b>28</b> Entry permit for the final country of destination, where applicable<br>
            Issued by <input type="text" style="width:150px;"> 
            Valid from <input type="text" style="width:120px;"> until <input type="text" style="width:120px;">
          </td>
        </tr>
        <tr>
          <td>
            <b>29</b> Intended date of arrival in the Schengen area <input type="text" style="width:150px;"><br>
            <b>30</b> Intended date of departure from the Schengen area <input type="text" style="width:150px;">
          </td>
        </tr>
        <tr>
          <td>
            <b>31</b> Surname and first name of the inviting person(s) in the Member State(s).<br>
            If not applicable, name of hotel(s) or temporary accommodation(s).<br><br>
            Address and e-mail address of inviting person(s)/hotel(s)/temporary accommodation(s)<br><br>
            Telephone and telefax<br>
            <input type="text" style="width:100%;">
          </td>
        </tr>
        <tr>
          <td>
            <b>32</b> Name and address of inviting company/organisation<br>
            Telephone and telefax of company/organisation<br><br>
            Surname, first name, address, telephone, telefax, and e-mail address of contact person in company/organisation<br>
            <input type="text" style="width:100%;">
          </td>
        </tr>
        <tr>
          <td>
            <b>33</b> Cost of travelling and living during the applicant's stay is covered<br>
            <label><input type="checkbox"> by the applicant himself/herself</label><br>
            Means of support:<br>
            <label><input type="checkbox"> Cash</label> 
            <label><input type="checkbox"> Traveller's cheques</label> 
            <label><input type="checkbox"> Credit card</label> 
            <label><input type="checkbox"> Pre-paid accommodation</label> 
            <label><input type="checkbox"> Pre-paid transport</label> 
            <label><input type="checkbox"> Other (please specify)</label> <input type="text" style="width:150px;"><br><br>

            <label><input type="checkbox"> by a sponsor (host, company, organisation), please specify</label><br>
            <label><input type="checkbox"> referred to in field 31 or 32</label> 
            <label><input type="checkbox"> Other (please specify)</label> <input type="text" style="width:150px;"><br>
            Means of support:<br>
            <label><input type="checkbox"> Cash</label> 
            <label><input type="checkbox"> Accommodation provided</label> 
            <label><input type="checkbox"> All expenses covered during the stay</label> 
            <label><input type="checkbox"> Pre-paid transport</label> 
            <label><input type="checkbox"> Other (please specify)</label> <input type="text" style="width:150px;">
          </td>
        </tr>
      </table>
    </div>

    <!-- RIGHT SIDE (30%) -->
    <div class="official-box">
    
    </div>

  </div>

<!-- PAGE 3 -->
   <div class="form-wrapper">
   <div class="form-left">
<table>

  <!-- 34 -->
  <tr>
    <td colspan="2"><strong>34</strong> Personal data of the family member who is an EU, EEA or CH citizen</td>
  </tr>
  <tr>
    <td>
      Surname <input type="text"><br>
      First name(s) <input type="text">
    </td>
    <td>
      Date of birth <input type="text"><br>
      Nationality <input type="text"><br>
      Number of travel document or ID card <input type="text">
    </td>
  </tr>

  <!-- 35 -->
  <tr>
    <td colspan="2">
      <strong>35</strong> Family relationship with an EU, EEA or CH citizen<br>
      <input type="checkbox"> Spouse 
      <input type="checkbox"> Child 
      <input type="checkbox"> Grandchild 
      <input type="checkbox"> Dependent ascendant
    </td>
  </tr>

  <!-- 36 + 37 -->
  <tr>
    <td>
      <strong>36</strong> Place and date 
      <input type="text">
    </td>
    <td>
      <strong>37</strong> Signature (for minors, signature of parental authority/legal guardian): 
      <input type="text">
    </td>
  </tr>

</table>

    </td>
    </div>

       <!-- RIGHT SIDE (30%) -->
    <div class="official-box">
    
    </div>

</table>
</div>



  <!-- Full width text paragraphs -->
     <div class="form-section">
            <div class="boxed-text">
                <p>I am aware that the visa fee is not refunded if the visa is refused.</p>
            </div>

            <div class="boxed-text">
                <p><strong>Applicable in case a multiple-entry visa is applied for (cf. field no 24):</strong></p>
                <p>I am aware of the need to have an adequate travel medical insurance for my first stay and any subsequent visits to the territory of Member States.</p>
            </div>

            <div class="boxed-text">
                <p>I am aware of and consent to the following: the collection of the data required by this application form and the taking of my photograph and, if applicable, the taking of fingerprints, are mandatory for the examination of the visa application; and any personal data concerning me which appear on the visa application form, as well as my fingerprints and my photograph will be supplied to the relevant authorities of the Member States and processed by those authorities, for the purposes of a decision on my visa application.</p>
        


            
                <p>Such data as well as data concerning the decision taken on my application or a decision whether to annul, revoke or extend a visa issued will be entered into, and stored in the Visa Information System (VIS) (1) for a maximum period of five years, during which it will be accessible to the visa authorities and the authorities competent for carrying out checks on visas at external borders and within the Member States, immigration and asylum authorities in the Member States for the purposes of verifying whether the conditions for the legal entry into, stay and residence on the territory of the Member States are fulfilled, of identifying persons who do not or who no longer fulfil these conditions, of examining an asylum application and of determining responsibility for such examination. Under certain conditions the data will be also available to designated authorities of the Member States and to Europol for the purpose of the prevention, detection and investigation of terrorist offences and of other serious criminal offences. The authority of the Member State responsible for processing the data is the Danish Immigration Service, Ryesgade 53, DK-2100 Copenhagen Ø, Denmark, e-mail: us@us.dk.</p>
      


            
                <p>I am aware that I have the right to obtain in any of the Member States notification of the data relating to me recorded in the VIS and of the Member State which transmitted the data, and to request that data relating to me which are inaccurate be corrected and that data relating to me processed unlawfully be deleted. At my express request, the authority examining my application will inform me of the manner in which I may exercise my right to check the personal data concerning me and have them corrected or deleted, including the related remedies according to the national law of the State concerned. The national supervisory authority of that Member State (the Danish Data Protection Agency, Borgergade 28, 5, DK-1300 Copenhagen K, Denmark, e-mail: dt@datatilsynet.dk) will hear claims concerning the protection of personal data.</p>
    

            
                <p>I declare that to the best of my knowledge all particulars supplied by me are correct and complete. I am aware that any false statements will lead to my application being rejected or to the annulment of a visa already granted and may also render me liable to prosecution under the law of the Member State which deals with the application.</p>
    


            
                <p>I undertake to leave the territory of the Member States before the expiry of the visa, if granted. I have been informed that possession of a visa is only one of the prerequisites for entry into the European territory of the Member States. The mere fact that a visa has been granted to me does not mean that I will be entitled to compensation if I fail to comply with the relevant provisions of Article 5(1) of Regulation (EC) No 562/2006 (Schengen Borders Code) and I am therefore refused entry. The prerequisites for entry will be checked again on entry into the European territory of the Member States.</p>
            </div>

            <table class="signature-table">
                <tr>
                    <td width="50%"><strong>Place and date</strong></td>
                    <td width="50%"><strong>Signature (for minors, signature of parental authority/legal guardian):</strong></td>
                </tr>
            </table>

            <p class="footer-note">(1) In so far as the VIS is operational</p>
        </div>
    </div>
     <script>
    document.addEventListener('DOMContentLoaded', function() {
        const photoContainer = document.getElementById('photoContainer');
        const photoInput = document.getElementById('photoInput');
        const photoPreview = document.getElementById('photoPreview');
        
        // Click on photo box to trigger file input
        photoContainer.addEventListener('click', function() {
            photoInput.click();
        });
        
        // Handle file selection
        photoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                
                reader.addEventListener('load', function() {
                    photoPreview.src = reader.result;
                    photoPreview.style.display = 'block';
                    photoContainer.querySelector('div').style.display = 'none';
                });
                
                reader.readAsDataURL(file);
            }
        });
    });
</script>
</div>

</body>
</html>