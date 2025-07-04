<x-agency.layout>
    @section('title') Visa View @endsection
      <div class="w-full relative">
          <img class="absolute -top-20 left-0  w-full opacity-20" style="z-index: -1" src="{{asset('assets/images/bgImage.png')}}" alt="">


          <span class="text-secondary lg:text-3xl md:text-2xl text-xl font-semibold">Visa to {{$visas['0']->destinationcountry->countryName}}</span>
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>     
              </div>
          @endif

          <section class="flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-col sm:flex-col flex-col justify-center w-full mt-6">
              {{--    section left div starts here--}}
              <div class="2xl:w-3/4 xl:w-3/4 lg:w-3/4 md:w-full sm:w-full w-full bg-white shadow-lg shadow-black/10 rounded-md p-4">
                      <span class="text-lg text-secondary font-semibold">Visa Details</span>
                  <form action="{{  route('visa.book') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                      @csrf

                          <div class="flex flex-col">
                              <div class="flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-row sm:flex-row flex-col w-full justify-between mt-2 gap-2">
                                  <div class=" lg:w-[33.3%] md:w-1/3  w-full flex flex-col relative" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Visa Category</label>
                                      <input type="hidden" value="{{ $visas['0']->origin }}" name="origin">
                                      <input type="hidden" value="{{ $visas['0']->destination }}" name="destination">
                                      <select class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"  name="typeof" id="typeof">
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

                                  <div class=" lg:w-[33.3%] md:w-1/3  w-full flex flex-col relative" >
                                      <label for="mobile"  class=" font-semibold text-gray-800 text-sm">Visa Types</label>
                                      <select class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" id="category" name="category">
                                          <option value="">

                                          </option>
                                      </select>

                                  </div>

                                  <div class=" lg:w-[33.3%] md:w-1/3  w-full flex flex-col relative" >
                                      <label for="mobile"  class=" font-semibold text-gray-800 text-sm">Processing Time</label>
                                      <select class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" id="processing" name="processing">
                                          <option value="">

                                          </option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="flex flex-wrap gap-4 mt-5 w-full">
                             <div class="flex flex-col">
                                 <label class="block mt-2 font-semibold">Select User Type</label>
                                 <div class="flex gap-2 mt-2">
                                     <button type="button" id="existingUserBtn" class="bg-secondary text-white px-3 py-0.5 text-xs rounded">Existing User</button>
                                     <a href="{{route('client.index')}}">  <button type="button" id="newUserBtn" class="bg-gray-500 text-white px-3 py-1 text-xs rounded">New User</button> </a>
                                 </div>
                             </div>

                              <div id="existingUserSection" class="hidden flex flex-col ">
                                  <label class=" font-semibold text-gray-800 text-sm">Select Existing User</label>
                                  <select class="visa-select w-[250px] mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" id="existingUserDropdown" name="clientId">
                                      <option value="">Select User</option>
                                      <!-- Users will be added dynamically using AJAX -->
                                  </select>
                              </div>
                          </div>
                          <div class="addresspart flex flex-col mt-5 border-[1px] border-secondary/30 p-4"  style="display: none">
                              <div class="w-full grid lg:grid-cols-6 md:grid-cols-6 sm:grid-cols-4 grid-cols-1 gap-1">
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Last Name</label>
                                      <input type="text" name="lastname" id="lastName"  class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" placeholder="As shown in passport" readonly="">
                                  </div>
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">First Name</label>
                                      <input type="text" name="firstname"  id="firstName"  class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" placeholder="As shown in passport" readonly="">

                                  </div>
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Citizenship</label>
                                      <input type="text" name="citizenship" value="" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"  id="citizenship" readonly="">

                                  </div>
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Email</label>
                                      <input type="email" name="email"  id="email"  class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" placeholder="Enter your email" readonly="">

                                  </div>
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Phone Number</label>
                                      <input type="text"  name="phonenumber"   id="phonenumber" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" placeholder="Enter your phone number" readonly="">

                                  </div>
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Date of Entry</label>
                                      <input type="date" name="dateofentry" max="9999-12-31" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                  </div>
                                  <div class=" w-full flex flex-col items-end lg:cols-span-6 md:col-span-6 sm:col-span-4 col-span-1 " >
                                      <button type="button" id="addMoreBtn" max="9999-12-31" class="px-2 py-0.5 text-xs font-semibold rounded-sm  border-[1px] border-success text-success bg-success/10 hover:bg-success hover:text-white transition ease-in duration-2000">Add More</button>
                                  </div>
                              </div>
                          </div>


                          <div id="dynamicFieldsContainer"></div>


                      <div class=" flex w-full justify-end  mt-5">
                          <!-- <a class="bg-secondary text-gray-100 text-lg py-2 px-5 rounded-md submitbutton">Proceed to Payment </a> -->
                                   <input type="submit" class="cursor-pointer bg-secondary text-gray-100 text-lg py-2 px-5 rounded-md submitbutton" value=" Proceed To Payment">
                        </div>

                      

                  </form>
              </div>

              <div class="2xl:w-1/4 sticky top-20 xl:w-1/4 lg:w-1/4 md:w-full sm:w-full w-full  bg-white shadow-lg shadow-black/10 rounded-sm 2xl:mt-0 xl:mt-0 lg:mt-0 md:mt-2 sm:mt-2 mt-2 2xl:ml-5 xl:ml-5 lg:ml-5 md:ml-0 sm:ml-0 ml-0 h-min p-4">

                  <div class="flex flex-col pb-2 border-b-2 border-b-secondary/30">
                      <span class="text-secondary font-semibold text-xl ">Basket Details</span>
                  </div>
                  <div class="flex justify-between mt-3">
                      <span class="text-black text-md font-normal">Visa Fee:</span>
                      <span class="text-secondary text-md font-semibold visa-price">&#8377 235.58</span>
                  </div>
                  <div class="flex justify-between mt-1.5">
                      <span class="text-black text-md font-normal">Service Fee:</span>
                      <span class="text-secondary text-md font-semibold visa-commision">₹5,998.00</span>
                  </div>
                  <div class="flex justify-between mt-1.5 pb-3 border-b-2 border-b-secondary/30 ">
                      <span class="text-black text-md ">Tax:</span>
                      <span class="text-secondary text-md font-semibold"> </span>
                  </div>

                  <div class="flex justify-between mt-3">
                      <span class="text-black text-md font-normal">Total:</span>
                      <span class="text-secondary text-md font-semibold visa-total">&#8377 135.58</span>
                  </div>




              </div>
              {{--    section right div ends here--}}
          </section>
      </div>
    @section('scripts')
    <!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

$(document).ready(function() {
   
        $('#existingUserDropdown').select2({
            placeholder: "---Select USer---",
            allowClear: true,
            containerCssClass: 'visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60'
        });
      
    });

// Function to get today's date in YYYY-MM-DD format
// Function to get today's date in YYYY-MM-DD format
function getTodayDate() {
    let today = new Date();
    return today.toISOString().split('T')[0]; // Returns YYYY-MM-DD
}

document.getElementById('addMoreBtn').addEventListener('click', function () {
    let container = document.getElementById('dynamicFieldsContainer');

    // Create the main wrapper div with the same classes as the original
    let fieldWrapper = document.createElement('div');
    fieldWrapper.classList.add('addresspart', 'flex', 'flex-col', 'mt-5', 'border-[1px]', 'border-secondary/30', 'p-4');

    // Create the grid container div with the same grid classes
    let gridContainer = document.createElement('div');
    gridContainer.classList.add('w-full', 'grid', 'lg:grid-cols-6', 'md:grid-cols-6', 'sm:grid-cols-4', 'grid-cols-1', 'gap-1');

    // First Name Input
    let firstNameDiv = document.createElement('div');
    firstNameDiv.classList.add('w-full', 'flex', 'flex-col');

    let firstNameLabel = document.createElement('label');
    firstNameLabel.setAttribute('for', 'passengerfirstname');
    firstNameLabel.classList.add('font-semibold', 'text-gray-800', 'text-sm');
    firstNameLabel.textContent = 'First Name';

    let firstNameInput = document.createElement('input');
    firstNameInput.setAttribute('type', 'text');
    firstNameInput.setAttribute('name', 'passengerfirstname[]');
    firstNameInput.setAttribute('placeholder', 'First Name');
    firstNameInput.classList.add('visa-select', 'w-full', 'mt-2', 'py-1.5', 'font-medium', 'text-black/80', 'text-sm', 'rounded-[3px]', 'border-[1px]', 'border-secondary/50', 'bg-[#f3f4f6]', 'focus:outline-none', 'focus:ring-0', 'placeholder-black/60');

    firstNameDiv.appendChild(firstNameLabel);
    firstNameDiv.appendChild(firstNameInput);

    // Last Name Input
    let lastNameDiv = document.createElement('div');
    lastNameDiv.classList.add('w-full', 'flex', 'flex-col');

    let lastNameLabel = document.createElement('label');
    lastNameLabel.setAttribute('for', 'passengerlastname');
    lastNameLabel.classList.add('font-semibold', 'text-gray-800', 'text-sm');
    lastNameLabel.textContent = 'Last Name';

    let lastNameInput = document.createElement('input');
    lastNameInput.setAttribute('type', 'text');
    lastNameInput.setAttribute('name', 'passengerlastname[]');
    lastNameInput.setAttribute('placeholder', 'Last Name');
    lastNameInput.classList.add('visa-select', 'w-full', 'mt-2', 'py-1.5', 'font-medium', 'text-black/80', 'text-sm', 'rounded-[3px]', 'border-[1px]', 'border-secondary/50', 'bg-[#f3f4f6]', 'focus:outline-none', 'focus:ring-0', 'placeholder-black/60');

    lastNameDiv.appendChild(lastNameLabel);
    lastNameDiv.appendChild(lastNameInput);

    // Passport Number Input
    let passportDiv = document.createElement('div');
    passportDiv.classList.add('w-full', 'flex', 'flex-col');

    let passportLabel = document.createElement('label');
    passportLabel.setAttribute('for', 'passengerpassportn');
    passportLabel.classList.add('font-semibold', 'text-gray-800', 'text-sm');
    passportLabel.textContent = 'Passport Number';

    let passportInput = document.createElement('input');
    passportInput.setAttribute('type', 'number');
    passportInput.setAttribute('name', 'passengerpassportn[]');
    passportInput.setAttribute('placeholder', 'Passport Number');
    passportInput.classList.add('visa-select', 'w-full', 'mt-2', 'py-1.5', 'font-medium', 'text-black/80', 'text-sm', 'rounded-[3px]', 'border-[1px]', 'border-secondary/50', 'bg-[#f3f4f6]', 'focus:outline-none', 'focus:ring-0', 'placeholder-black/60');

    passportDiv.appendChild(passportLabel);
    passportDiv.appendChild(passportInput);

    // Issue Date Input
    let issueDateDiv = document.createElement('div');
    issueDateDiv.classList.add('w-full', 'flex', 'flex-col');

    let issueDateLabel = document.createElement('label');
    issueDateLabel.setAttribute('for', 'passportissuedate');
    issueDateLabel.classList.add('font-semibold', 'text-gray-800', 'text-sm');
    issueDateLabel.textContent = 'Issue Date';

    let issueDateInput = document.createElement('input');
    issueDateInput.setAttribute('type', 'date');
    issueDateInput.setAttribute('name', 'passportissuedate[]');
    issueDateInput.setAttribute('max', getTodayDate());
    issueDateInput.classList.add('visa-select', 'w-full', 'mt-2', 'py-1.5', 'font-medium', 'text-black/80', 'text-sm', 'rounded-[3px]', 'border-[1px]', 'border-secondary/50', 'bg-[#f3f4f6]', 'focus:outline-none', 'focus:ring-0', 'placeholder-black/60');

    issueDateDiv.appendChild(issueDateLabel);
    issueDateDiv.appendChild(issueDateInput);

    // Expiry Date Input
    let expireDateDiv = document.createElement('div');
    expireDateDiv.classList.add('w-full', 'flex', 'flex-col');

    let expireDateLabel = document.createElement('label');
    expireDateLabel.setAttribute('for', 'passportexpiredate');
    expireDateLabel.classList.add('font-semibold', 'text-gray-800', 'text-sm');
    expireDateLabel.textContent = 'Expiry Date';

    let expireDateInput = document.createElement('input');
    expireDateInput.setAttribute('type', 'date');
    expireDateInput.setAttribute('name', 'passportexpiredate[]');
    expireDateInput.setAttribute('min', getTodayDate());
    expireDateInput.classList.add('visa-select', 'w-full', 'mt-2', 'py-1.5', 'font-medium', 'text-black/80', 'text-sm', 'rounded-[3px]', 'border-[1px]', 'border-secondary/50', 'bg-[#f3f4f6]', 'focus:outline-none', 'focus:ring-0', 'placeholder-black/60');

    expireDateDiv.appendChild(expireDateLabel);
    expireDateDiv.appendChild(expireDateInput);

    // Place of Issue Input
    let issuePlaceDiv = document.createElement('div');
    issuePlaceDiv.classList.add('w-full', 'flex', 'flex-col');

    let issuePlaceLabel = document.createElement('label');
    issuePlaceLabel.setAttribute('for', 'passengerplace');
    issuePlaceLabel.classList.add('font-semibold', 'text-gray-800', 'text-sm');
    issuePlaceLabel.textContent = 'Place of Issue';

    let issuePlaceInput = document.createElement('input');
    issuePlaceInput.setAttribute('type', 'text');
    issuePlaceInput.setAttribute('name', 'passengerplace[]');
    issuePlaceInput.setAttribute('placeholder', 'Place of Issue');
    issuePlaceInput.classList.add('visa-select', 'w-full', 'mt-2', 'py-1.5', 'font-medium', 'text-black/80', 'text-sm', 'rounded-[3px]', 'border-[1px]', 'border-secondary/50', 'bg-[#f3f4f6]', 'focus:outline-none', 'focus:ring-0', 'placeholder-black/60');

    issuePlaceDiv.appendChild(issuePlaceLabel);
    issuePlaceDiv.appendChild(issuePlaceInput);

    // Remove Button Div (spanning all columns)
    let removeBtnDiv = document.createElement('div');
    removeBtnDiv.classList.add('w-full', 'flex', 'flex-col', 'items-end', 'lg:cols-span-6', 'md:col-span-6', 'sm:col-span-4', 'col-span-1', 'mt-2');

    let removeBtn = document.createElement('button');
    removeBtn.setAttribute('type', 'button');
    removeBtn.textContent = 'Remove';
    removeBtn.classList.add('px-2', 'py-0.5', 'text-xs', 'font-semibold', 'rounded-sm', 'border-[1px]', 'border-red-500', 'text-red-500', 'bg-red-500/10', 'hover:bg-red-500', 'hover:text-white', 'transition', 'ease-in', 'duration-200');
    removeBtn.addEventListener('click', function () {
        container.removeChild(fieldWrapper);
    });

    removeBtnDiv.appendChild(removeBtn);

    // Append all input divs to the grid container
    gridContainer.appendChild(firstNameDiv);
    gridContainer.appendChild(lastNameDiv);
    gridContainer.appendChild(passportDiv);
    gridContainer.appendChild(issueDateDiv);
    gridContainer.appendChild(expireDateDiv);
    gridContainer.appendChild(issuePlaceDiv);

    // Append the grid container and remove button to the main wrapper
    fieldWrapper.appendChild(gridContainer);
    fieldWrapper.appendChild(removeBtnDiv);

    // Append the wrapper to the container
    container.appendChild(fieldWrapper);

    // Force calendar to open on click for date inputs
    issueDateInput.addEventListener('click', function() {
        this.showPicker && this.showPicker();
    });

    expireDateInput.addEventListener('click', function() {
        this.showPicker && this.showPicker();
    });
});

// Helper function to get today's date in YYYY-MM-DD format
function getTodayDate() {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

    /****Ajax for get type of****** */
$(document).ready(function () {
    // alert('heelo');
    // jQuery('.submitbutton').hide();
    function fetchCategories() {
        var visa_type_id = $("#typeof").val();
        if (visa_type_id) {
            $.ajax({
                url: "{{ route('get.visa.services') }}", // API for fetching subtypes
                type: "GET",
                data: { visa_type_id: visa_type_id },
                success: function (data) {

                    var html = ''; // Default option

                    // $.each(data.visa_subtypes, function (index, category) {
                    //     html += '<option value="' + category.id + '"data-processing=+  category.processing data-price="' + category.price +'" data-balance="' + data.balance.balance + ' " data-commission="' + category.commission + '">' + category.name + "</option>";
                    // });
                    $.each(data.visa_subtypes, function (index, category) {
                            html += '<option value="' + category.id + '" ' +
                                    'data-processing="' + category.processing + '" ' +
                                    'data-price="' + category.price + '" ' +
                                    'data-balance="' + data.balance.balance + '" ' +
                                    'data-commission="' + category.commission + '">' +
                                    category.name + '</option>';
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
        var processing = selectedOption.data("processing") || "";





        var total = visaPrice + commission; // Correct addition
       

        $(".visa-price").text("£" + visaPrice.toFixed(2)); // Update displayed price
        $(".visa-commision").text("£" + commission.toFixed(2)); // Update displayed commission
        $(".visa-total").text("£" + total.toFixed(2)); // Update displayed total
        $("#processing").html(`<option value="${processing}">${processing}</option>`);

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
                    html += `<option value="${user.id}"  data-nationality="${user.clientinfo?.nationality ?? 'N/A'}" data-name="${user.first_name}" data-lastname="${user.last_name}"  data-phone_number="${user.phone_number} " data-email="${user.email}" data-passport="${user.passport_number}">${user.client_name}</option>`;
                });
                $("#existingUserDropdown").html(html);
            }
        });

    }

    // Auto-fill address when user is selected
    $("#existingUserDropdown").on("change", function () {
        // alert("heelo");
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
