<x-agency.layout>
    @section('title') Visa View @endsection

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Assign Form</span>
        </div>

        <div class="carousel w-full relative"></div>
        
      
        <section class="2xl:px-64 xl:px-52 lg:px-24 md:px-5 sm:px-5 px-5">
            <div class="text-sm breadcrumbs">
                <ul>
                    <li class="text-info font-semibold"><a>Cloud-travel.co.uk</a></li>
                    <li><a>India visa for Singapore passport holder living in United Kingdom</a></li>
                </ul>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- <div class="w-full flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-col sm:flex-col flex-col mt-10"> -->
                <div class="container flex justify-center p-5">

                    <div class="form-container bg-white p-5 rounded-lg shadow-lg w-96">
                   
                        <h2 class="text-xl font-bold mb-4">Visa to United States of America</h2>
                        <label class="block mt-2 font-semibold">Visa Category</label>
                        <form action="{{  route('visa.book') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                       <input type="hidden" value="{{ $visas['0']->origin }}" name="origin">
                       <input type="hidden" value="{{ $visas['0']->destination }}" name="destination">
                        <select class="w-full p-2 border rounded"  name="typeof" id="typeof">
                            @forelse($visas as $visaServiceType) 
                                @if ($visaServiceType->VisaServices) 
                                    <option value="{{ $visaServiceType->VisaServices->id }}">
                                        {{ $visaServiceType->VisaServices->name }}
                                    </option>
                                @endif
                            @empty
                                <div class="p-2 flex 2xl:w-full xl:w-full lg:w-full md:w-1-5 sm:w-1/3 w-1/2 flex-col border-l-4 border-l-red-500">
                                    <span class="text-black font-semibold text-xl">No Record found</span>  
                                </div>
                            @endforelse
                                               
                        </select>
                        <label class="block mt-2 font-semibold">Visa Type</label>
                        <select class="w-full p-2 border rounded" id="category" name="category">
                       
                                    <option value="">
                                        Select 
                                    </option>
                           
                                               
                        </select>
                        <label class="block mt-2 font-semibold">Processing Time</label>
                        <select class="w-full p-2 border rounded">
                            <option>15 business days</option>
                        </select>
                        <label class="block mt-2 font-semibold">Select User Type</label>
                        <div class="flex gap-2">
                            <button type="button" id="existingUserBtn" class="bg-blue-500 text-white px-3 py-2 rounded">Existing User</button>
                           <a href="{{route('client.index')}}">  <button type="button" id="newUserBtn" class="bg-gray-500 text-white px-3 py-2 rounded">New User</button> </a>
                        </div>

                        <!-- Dropdown for Existing Users (Hidden Initially) -->
                        <div id="existingUserSection" class="mt-3 hidden">
                            <label class="block font-semibold">Select Existing User</label>
                            <select class="w-full p-2 border rounded" id="existingUserDropdown" name="clientId">
                                <option value="">Select User</option>
                                <!-- Users will be added dynamically using AJAX -->
                            </select>
                        </div>
                     
                          <div class="addresspart" style="display:none"> 
                                <label class="block mt-2 font-semibold">Last Name</label>
                                <input type="text" name="lastname" id="lastName" class="w-full p-2 border rounded" placeholder="As shown in passport" readonly="">
                                <label class="block mt-2 font-semibold">First Name</label>
                                <input type="text" name="firstname"  id="firstName" class="w-full p-2 border rounded" placeholder="As shown in passport" readonly="">
                                <label class="block mt-2 font-semibold">Citizenship</label>
                                <!-- <select class="w-full p-2 border rounded" name="citizenship">
                                    <option>India</option>
                                </select> -->
                                <input type="text" name="citizenship" value=""  id="citizenship" readonly=""> 
                                <label class="block mt-2 font-semibold">Email</label>
                                <input type="email" name="email"  id="email" class="w-full p-2 border rounded" placeholder="Enter your email" readonly="">
                                <label class="block mt-2 font-semibold">Phone Number</label>
                                <input type="text"  name="phonenumber"   id="phonenumber" class="w-full p-2 border rounded" placeholder="Enter your phone number" readonly="">
                                <label class="block mt-2 font-semibold">Date of Entry</label>
                                <input type="date" name="dateofentry" class="w-full p-2 border rounded">
                                <button type="button" id="addMoreBtn" class="bg-blue-500 text-white px-3 py-2 mt-3 rounded">Add More</button>

<!-- Container for dynamically added fields -->
                            <div id="dynamicFieldsContainer" class="mt-3"></div>
                            </div>
                     
                           
                            <button id="submit" type="submit" class="bg-green-500 text-white px-4 py-2 mt-4 rounded w-full hover:bg-green-600 button submitbutton" >Save and Continue</button>
                       
                        <br> <br> 
                        <div class="insufficientbalance"> 
                        <span class=" mt-4 showLoader w-full font-semibold text-md bg-danger/80 text-white/90 px-6 py-2 rounded-[3px] border-[1px] border-danger hover:bg-danger hover:text-white transition ease-in duration-2000"
                        label="Book Now"> Insufficient Balance </span>
                        <div class="flex justify-center text-center mt-2 font-semibold text-danger">
                            <p >*** Please contect administrator for funds </p>
                        </div>
                        </div> 
                      
                      
                    </div >
                    <div class="summary-container bg-white p-5 rounded-lg shadow-lg w-72 ml-5">
                        <h3 class="text-lg font-bold mb-2">Basket Details</h3>
                        <p class="flex justify-between"><span>Visa Fee:</span> <span class="visa-price">₹16,096.00</span></p>
                        <p class="flex justify-between"><span>Service Fee:</span> <span class="visa-commision">₹5,998.00</span></p>
                        <p class="flex justify-between"><span>Tax:</span> <span></span></p>
                        <h3 class="text-lg font-bold mt-2" >Total: <span class="visa-total"> ₹23,173.82 </span></h3>
                    </div>
                </div>
                <!-- Add More Button -->

             </form>
            <!-- </div> -->
        </section>
    </div>

    @section('scripts')
    <script>


// Function to get today's date in YYYY-MM-DD format
// Function to get today's date in YYYY-MM-DD format
function getTodayDate() {
    let today = new Date();
    return today.toISOString().split('T')[0]; // Returns YYYY-MM-DD
}

document.getElementById('addMoreBtn').addEventListener('click', function () {
    let container = document.getElementById('dynamicFieldsContainer');

    // Create a div to wrap the inputs
    let fieldWrapper = document.createElement('div');
    fieldWrapper.classList.add('flex', 'gap-2', 'mt-2', 'items-center', 'flex-wrap', 'border', 'p-2', 'rounded');

    // First Name Input
    let firstName = document.createElement('input');
    firstName.setAttribute('type', 'text');
    firstName.setAttribute('name', 'passengerfirstname[]');
    firstName.setAttribute('placeholder', 'First Name');
    firstName.classList.add('w-full', 'p-2', 'border', 'rounded');

    // Last Name Input
    let lastName = document.createElement('input');
    lastName.setAttribute('type', 'text');
    lastName.setAttribute('name', 'passengerlastname[]');
    lastName.setAttribute('placeholder', 'Last Name');
    lastName.classList.add('w-full', 'p-2', 'border', 'rounded');

    // Passport Number Input
    let passportNumber = document.createElement('input');
    passportNumber.setAttribute('type', 'number');
    passportNumber.setAttribute('name', 'passengerpassportn[]');
    passportNumber.setAttribute('placeholder', 'Passport Number');
    passportNumber.classList.add('w-full', 'p-2', 'border', 'rounded');

    // Issue Date Input (Must be before today)
    let issueDate = document.createElement('input');
    issueDate.setAttribute('type', 'date');
    issueDate.setAttribute('name', 'passportissuedate[]');
    issueDate.setAttribute('placeholder', 'Issue Date');
    issueDate.setAttribute('max', getTodayDate()); // Ensures date is before today
    issueDate.classList.add('w-full', 'p-2', 'border', 'rounded');

    // Expiry Date Input (Must be after today)
    let expireDate = document.createElement('input');
    expireDate.setAttribute('type', 'date');
    expireDate.setAttribute('name', 'passportexpiredate[]');
    expireDate.setAttribute('placeholder', 'Expiry Date');
    expireDate.setAttribute('min', getTodayDate()); // Ensures date is after today
    expireDate.classList.add('w-full', 'p-2', 'border', 'rounded');

    // Force calendar to open on click (Fix for browsers where it doesn’t show)
    issueDate.addEventListener('click', function() {
        this.showPicker && this.showPicker();
    });

    expireDate.addEventListener('click', function() {
        this.showPicker && this.showPicker();
    });

    // Place of Issue Input
    let issuePlace = document.createElement('input');
    issuePlace.setAttribute('type', 'text');
    issuePlace.setAttribute('name', 'passengerplace[]');
    issuePlace.setAttribute('placeholder', 'Place of Issue');
    issuePlace.classList.add('w-full', 'p-2', 'border', 'rounded');

    // Remove Button
    let removeBtn = document.createElement('button');
    removeBtn.innerText = 'Remove';
    removeBtn.setAttribute('type', 'button');
    removeBtn.classList.add('bg-red-500', 'text-white', 'px-3', 'py-2', 'rounded');
    removeBtn.addEventListener('click', function () {
        container.removeChild(fieldWrapper);
    });

    // Append elements to wrapper
    fieldWrapper.appendChild(firstName);
    fieldWrapper.appendChild(lastName);
    fieldWrapper.appendChild(passportNumber);
    fieldWrapper.appendChild(issueDate);
    fieldWrapper.appendChild(expireDate);
    fieldWrapper.appendChild(issuePlace);
    fieldWrapper.appendChild(removeBtn);

    // Append wrapper to container
    container.appendChild(fieldWrapper);
});

    /****Ajax for get type of****** */
$(document).ready(function () {
    // alert('heelo');
    jQuery('.submitbutton').hide(); 
    function fetchCategories() {
        var visa_type_id = $("#typeof").val();
        if (visa_type_id) {
            $.ajax({
                url: "{{ route('get.visa.services') }}", // API for fetching subtypes
                type: "GET",
                data: { visa_type_id: visa_type_id },
                success: function (data) {
                    console.log(data.visa_subtypes);
                    var html = ''; // Default option

                    $.each(data.visa_subtypes, function (index, category) {
                        html += '<option value="' + category.id + '" data-price="' + category.price +'" data-balance="' + data.balance.balance + ' " data-commission="' + category.commission + '">' + category.name + "</option>";
                    });

                    $("#category").empty().append(html); 

                    // **Trigger change event after setting new options**
                    $("#category").trigger("change");
                },
                error: function (xhr) {
                    console.error(xhr.responseText); // Debugging
                },
            });
        } else {
            $("#category").empty().append('<option value="">Select Category</option>'); // Reset category dropdown
            $(".visa-price").text("0.00"); // Reset price
            $(".visa-commision").text("0.00"); // Reset commission
            $(".visa-total").text("₹0.00"); // Reset total
        }
    }

    // Run AJAX when document is ready
    fetchCategories();

    // Run AJAX when visa type changes
    $("#typeof").on("change", function () {
        fetchCategories();
    });

    // When Category (`#category`) changes, update the price
    $("#category").on("change", function () {
        var selectedOption = $(this).find(":selected");
        var visaPrice = parseFloat(selectedOption.data("price")) || 0;  // Convert to number, default 0
        var commission = parseFloat(selectedOption.data("commission")) || 0;  // Convert to number, default 0
        var balance = parseFloat(selectedOption.data("balance")) || 0; 


        var total = visaPrice + commission; // Correct addition
        if (balance < total) {  // Corrected condition
            jQuery(".submitbutton").hide(); 
            jQuery(".insufficientbalance").show(); 
        } else {
            jQuery(".submitbutton").show(); 
            jQuery(".insufficientbalance").hide(); 
        }

        $(".visa-price").text("£" + visaPrice.toFixed(2)); // Update displayed price
        $(".visa-commision").text("£" + commission.toFixed(2)); // Update displayed commission
        $(".visa-total").text("£" + total.toFixed(2)); // Update displayed total
    });
});

  
/****Check user ******/
$("#existingUserBtn").on("click", function () {
        $("#existingUserSection").removeClass("hidden"); // Show dropdown
        fetchExistingUsers(); // Fetch users from DB
    });

    $("#newUserBtn").on("click", function () {
        $("#existingUserSection").addClass("hidden"); // Hide dropdown
        resetFields(); // Clear fields
    });

    // Fetch existing users (AJAX)
    function fetchExistingUsers() {
              $.ajax({
            url: "{{ route('get.existing.users') }}", // Update with correct route
            type: "GET",
            success: function (data) {
                console.log(data[0]);
                let html = '<option value="">Select User</option>';
                data.forEach(user => {
                    html += `<option value="${user.id}"  data-nationality="${user.clientinfo?.nationality ?? 'N/A'}" data-name="${user.name}"  data-phone_number="${user.phone_number} " data-email="${user.email}" data-passport="${user.passport_number}">${user.name}</option>`;
                });
                $("#existingUserDropdown").html(html);
            }
        });
  
    }

    // Auto-fill address when user is selected
    $("#existingUserDropdown").on("change", function () {
        let selectedUser = $(this).find(":selected");
         var fullName=selectedUser.data("name");
        var email=selectedUser.data("email");
        var phone_number=selectedUser.data("phone_number");
        var nameParts = fullName.split(",").map(function(item) {
                    return item.trim();
                });
        var firstName = nameParts[0] || ""; 
        var lastName = nameParts[1] || ""; 
        var country=selectedUser.data("nationality");
      
        $(".addresspart").show();
        $("#lastName").val(lastName || "");
        $("#firstName").val(firstName || "");
        $("#citizenship").val(country || "");
        $("#email").val(email || "");
        $("#phonenumber").val(phone_number || "");
    });

    // Reset address fields for new user
    function resetFields() {
        $("#address, #city, #state, #country, #zip_code").val("");
    }
    </script>
    @endsection
</x-agency.layout>
