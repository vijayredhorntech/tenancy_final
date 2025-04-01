<x-agency.layout>
    @section('title') Visa View @endsection
      <div class="w-full  p-4">
          <section class="flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-col sm:flex-col flex-col justify-center w-full">
              {{--    section left div starts here--}}
              <div class="2xl:w-3/4 xl:w-3/4 lg:w-3/4 md:w-full sm:w-full w-full bg-white drop-shadow-2xl rounded-xl p-5">

                  <div class="py-3  ">
                      <span class="text-lg text-black font-semibold">Visa to United States of America</span>
                  </div>



                  <form action="{{  route('visa.book') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="border-2 border-gray-100 px-5 pb-10">

                          <div class="flex flex-col mt-5">
                              <div class="flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-row sm:flex-row flex-col w-full justify-between mt-2 gap-">
                                  <div class=" 2xl:w-1/3 xl:w-1/3 lg:w-1/3 md:w-1/3  w-full flex flex-col relative" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Visa Category</label>
                                      <input type="hidden" value="{{ $visas['0']->origin }}" name="origin">
                                      <input type="hidden" value="{{ $visas['0']->destination }}" name="destination">
                                      <select class="w-full rounded-md text-sm text-black mt-2"  name="typeof" id="typeof">
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
                                  </div>

                                  <div class=" 2xl:w-1/3 xl:w-1/3 lg:w-1/3 md:w-1/3  w-full flex flex-col 2xl:ml-10 xl:ml-10 lg:ml-10 md:ml-10 sm:ml-10 ml-0 2xl:mt-0 xl:mt-0 lg:mt-0 md:mt-0 sm:mt-0 mt-10" >
                                      <label for="mobile"  class=" font-semibold text-gray-800 text-sm">Visa Types</label>
                                      <select class="w-full rounded-md text-sm text-black mt-2" id="category" name="category">
                                          <option value="">
                                              Select
                                          </option>
                                      </select>

                                  </div>

                                  <div class=" 2xl:w-1/3 xl:w-1/3 lg:w-1/3 md:w-1/3  w-full flex flex-col 2xl:ml-10 xl:ml-10 lg:ml-10 md:ml-10 sm:ml-10 ml-0 2xl:mt-0 xl:mt-0 lg:mt-0 md:mt-0 sm:mt-0 mt-10" >
                                      <label for="mobile"  class=" font-semibold text-gray-800 text-sm">Processing Time</label>
                                      <select class="w-full rounded-md text-sm text-black mt-2">
                                          <option>15 business days</option>
                                      </select>
                                  </div>
                              </div>
                          </div>

                          <div class="flex flex-col mt-5">
                              <label class="block mt-2 font-semibold">Select User Type</label>
                              <div class="flex gap-2">
                                  <button type="button" id="existingUserBtn" class="bg-secondary text-white px-3 py-0.5 text-xs rounded">Existing User</button>
                                  <a href="{{route('client.index')}}">  <button type="button" id="newUserBtn" class="bg-gray-500 text-white px-3 py-1 text-xs rounded">New User</button> </a>
                              </div>
                          </div>

                          <div id="existingUserSection" class="mt-3 hidden flex flex-col">
                              <label class=" font-semibold text-gray-800 text-sm">Select Existing User</label>
                              <select class="w-full rounded-md text-sm text-black mt-2" id="existingUserDropdown" name="clientId">
                                  <option value="">Select User</option>
                                  <!-- Users will be added dynamically using AJAX -->
                              </select>
                          </div>

                          <div class="addresspart flex flex-col mt-5" style="display:none">
                              <div class="flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-row sm:flex-row flex-col w-full justify-between mt-2 gap-2">
                                  <div class=" 2xl:w-1/3 xl:w-1/3 lg:w-1/3 md:w-1/3  w-full flex flex-col relative" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Last Name</label>
                                      <input type="text" name="lastname" id="lastName" class="w-full rounded-md text-sm text-black mt-2" placeholder="As shown in passport" readonly="">
                                  </div>
                                  <div class=" 2xl:w-1/3 xl:w-1/3 lg:w-1/3 md:w-1/3  w-full flex flex-col relative" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">First Name</label>
                                      <input type="text" name="firstname"  id="firstName" class="w-full rounded-md text-sm text-black mt-2" placeholder="As shown in passport" readonly="">

                                  </div>
                                  <div class=" 2xl:w-1/3 xl:w-1/3 lg:w-1/3 md:w-1/3  w-full flex flex-col relative" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Citizenship</label>
                                      <input type="text" name="citizenship" value="" class="w-full rounded-md text-sm text-black mt-2"  id="citizenship" readonly="">

                                  </div>
                                  <div class=" 2xl:w-1/3 xl:w-1/3 lg:w-1/3 md:w-1/3  w-full flex flex-col relative" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Email</label>
                                      <input type="email" name="email"  id="email" class="w-full rounded-md text-sm text-black mt-2" placeholder="Enter your email" readonly="">

                                  </div>
                                  <div class=" 2xl:w-1/3 xl:w-1/3 lg:w-1/3 md:w-1/3  w-full flex flex-col relative" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Phone Number</label>
                                      <input type="text"  name="phonenumber"   id="phonenumber" class="w-full rounded-md text-sm text-black mt-2" placeholder="Enter your phone number" readonly="">

                                  </div>
                                  <div class=" 2xl:w-1/3 xl:w-1/3 lg:w-1/3 md:w-1/3  w-full flex flex-col relative" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Date of Entry</label>
                                      <input type="date" name="dateofentry" class="w-full rounded-md text-sm text-black mt-2">
                                  </div>
                                  <div class=" 2xl:w-1/3 xl:w-1/3 lg:w-1/3 md:w-1/3  w-full flex flex-col relative" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">&nbsp</label>
                                      <button type="button" id="addMoreBtn" class="bg-blue-500 text-white px-3 py-2 mt-2 rounded">Add More</button>

                                  </div>
                              </div>
                          </div>
                          <div id="dynamicFieldsContainer" class="mt-3"></div>

                      </div>

                      <div class=" flex w-full  mt-5">
                          <!-- <a class="bg-secondary text-gray-100 text-lg py-2 px-5 rounded-md submitbutton">Proceed to Payment </a> -->
                     <input type="submit" class="bg-secondary text-gray-100 text-lg py-2 px-5 rounded-md submitbutton" value=" Proceed To Payment"> 
                        </div>

                      <div class="insufficientbalance">
                        <span class=" mt-4 showLoader w-full font-semibold text-md bg-danger/80 text-white/90 px-6 py-2 rounded-[3px] border-[1px] border-danger hover:bg-danger hover:text-white transition ease-in duration-2000"
                              label="Book Now"> Insufficient Balance </span>
                          <div class="flex  text-center mt-2 font-semibold text-danger">
                              <p >*** Please contect administrator for funds </p>
                          </div>
                      </div>

                  </form>
              </div>
              <div class="2xl:w-1/4 sticky top-0 xl:w-1/4 lg:w-1/4 md:w-full sm:w-full w-full  bg-white drop-shadow-2xl rounded-xl 2xl:mt-0 xl:mt-0 lg:mt-0 md:mt-2 sm:mt-2 mt-2 2xl:ml-5 xl:ml-5 lg:ml-5 md:ml-0 sm:ml-0 ml-0 h-min p-5">

                  <div class="flex flex-col pb-5 border-b-2 border-b-gray-200">
                      <span class="text-black font-semibold text-xl ">Basket Details</span>
                  </div>
                  <div class="flex justify-between mt-3">
                      <span class="text-black text-md">Visa Fee:</span>
                      <span class="text-black text-md font-semibold visa-price">&#8377 235.58</span>
                  </div>
                  <div class="flex justify-between mt-1.5">
                      <span class="text-black text-md">Service Fee:</span>
                      <span class="text-black text-md font-semibold visa-commision">₹5,998.00</span>
                  </div>
                  <div class="flex justify-between mt-1.5 pb-3 border-b-2 border-b-gray-200 ">
                      <span class="text-black text-md ">Tax:</span>
                      <span class="text-black text-md font-semibold"> </span>
                  </div>

                  <div class="flex justify-between mt-3">
                      <span class="text-black text-md">Total:</span>
                      <span class="text-black text-md font-semibold visa-total">&#8377 135.58</span>
                  </div>




              </div>
              {{--    section right div ends here--}}
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
                console.log(data);
                let html = '<option value="">Select User</option>';
                data.forEach(user => {
                    html += `<option value="${user.id}"  data-nationality="${user.clientinfo?.nationality ?? 'N/A'}" data-name="${user.name}" data-lastname="${user.clientinfo?.last_name}"  data-phone_number="${user.phone_number} " data-email="${user.email}" data-passport="${user.passport_number}">${user.name}</option>`;
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
        var lastName = selectedUser.data("lastname");;
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
