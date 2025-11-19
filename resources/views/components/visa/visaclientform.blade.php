{{-- <x-main.layout>
<livewire:visa-session :visas="$visas" :status="$status" />

</x-main.layout> --}}

@if ($errors->has('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        {{ $errors->first('error') }}
    </div>
@endif
   <div class="w-full relative">
          <img class="absolute -top-20 left-0  w-full opacity-20" style="z-index: -1" src="{{asset('assets/images/bgImage.png')}}" alt="">


          <span class="text-secondary lg:text-3xl md:text-2xl text-xl font-semibold">Visa to {{$visas['0']->destinationcountry->countryName}}</span>

          <section class="flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-col sm:flex-col flex-col justify-center w-full mt-6">
              {{--    section left div starts here--}}
              <div class="2xl:w-3/4 xl:w-3/4 lg:w-3/4 md:w-full sm:w-full w-full bg-white shadow-lg shadow-black/10 rounded-md p-4">
                      <span class="text-lg text-secondary font-semibold">Visa Details</span>
                  <form action="{{  route('visa.applicationclient.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                      @csrf

                      
                          <div class="flex flex-col">
                              <div class="flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-row sm:flex-row flex-col w-full justify-between mt-2 gap-2">
                                  <div class=" lg:w-[33.3%] md:w-1/3  w-full flex flex-col relative" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Visa Category</label>
                                      <input type="hidden" value="{{ $visas['0']->origin }}" name="origin">
                                      <input type="hidden" value="{{ $visas['0']->destination }}" name="destination">
                                      <input type="hidden" value="{{ $visas['0']->id }}" name="selectionid" id="selectionid">

                                      
                                      <select id="typeof" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"  name="typeof" id="typeof">
                                          @forelse($visas as $visaServiceType)
                                              @if ($visaServiceType->VisaServices)
                                                  <option value="{{ $visaServiceType->VisaServices->id }}" data-id="{{$visaServiceType->id}}">
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
                             
                          </div>
                          <div class="addresspart flex flex-col mt-5 border-[1px] border-secondary/30 p-4"  >
                                    <div class="w-full flex justify-end mb-3">
                                        <button type="button" 
                                                id="openAssignClientModal"
                                                class="bg-secondary text-white px-4 py-2 rounded-md hover:bg-secondary/80 transition">
                                            Existing Client
                                        </button>
                                    </div>
                             <!-- Client Information Section -->
                                <div class="mt-5 border-[1px] border-secondary/30 p-4">
                                    <h3 class="text-secondary font-semibold mb-4">Personal Information</h3>
                                    
                                    <div class="grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 grid-cols-1 gap-4">
                                        <!-- First Name -->
                                         <input
                                                        type="hidden"
                                                        name="clientId"
                                                        id="clientId"
                                                        value="{{ old('clientId') }}"
                                                    >

                                                <div class="w-full flex flex-col">
                                                    <label for="firstName" class="font-semibold text-gray-800 text-sm">First Name</label>
                                                    <input
                                                        type="text"
                                                        name="first_name"
                                                        class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"
                                                        placeholder="As shown in passport"
                                                        value="{{ old('first_name') }}"
                                                    >
                                                    @error('first_name')
                                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- Last Name -->
                                                <div class="w-full flex flex-col">
                                                    <label for="lastName" class="font-semibold text-gray-800 text-sm">Last Name</label>
                                                    <input
                                                        type="text"
                                                        name="last_name"
                                                        class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"
                                                        placeholder="As shown in passport"
                                                        value="{{ old('last_name') }}"
                                                    >
                                                    @error('last_name')
                                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- Email -->
                                                <div class="w-full flex flex-col">
                                                    <label for="email" class="font-semibold text-gray-800 text-sm">Email Address</label>
                                                    <input
                                                        type="email"
                                                        name="email"
                                                        class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"
                                                        placeholder="Enter your email"
                                                        value="{{ old('email') }}"
                                                    >
                                                    @error('email')
                                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- Phone Number -->
                                                <div class="w-full flex flex-col">
                                                    <label for="phoneNumber" class="font-semibold text-gray-800 text-sm">Phone Number</label>
                                                    <input
                                                        type="text"
                                                        name="phone_number"
                                                        class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"
                                                        placeholder="Enter your phone number"
                                                        value="{{ old('phone_number') }}"
                                                    >
                                                    @error('phone_number')
                                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- Nationality -->
                                                <div class="w-full flex flex-col">
                                                    <label for="nationality" class="font-semibold text-gray-800 text-sm">Nationality</label>
                                                    <input
                                                        type="text"
                                                        name="nationality"
                                                        class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"
                                                        placeholder="Your nationality"
                                                         value="{{ old('nationality') }}"
                                                    >
                                                    @error('nationality')
                                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- Zip Code -->
                                                <div class="w-full flex flex-col">
                                                    <label for="zipCode" class="font-semibold text-gray-800 text-sm">Zip/Postal Code</label>
                                                    <input
                                                        type="text"
                                                        name="zip_code"
                                                        class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"
                                                        placeholder="Your zip/postal code"
                                                        value="{{ old('zip_code') }}"
                                                    >
                                                    @error('zip_code')
                                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                                    @enderror
                                           
                                                    
                                                </div>

                                                <!-- Address -->
                                                <div class="w-full flex flex-col lg:col-span-2 md:col-span-2">
                                                    <label for="address" class="font-semibold text-gray-800 text-sm">Address</label>
                                                    <input
                                                        type="text"
                                                        name="address"
                                                        class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"
                                                        placeholder="Your full address"
                                                        value="{{ old('address') }}"
                                                    >
                                                </div>

                                                <!-- City -->
                                                <div class="w-full flex flex-col">
                                                    <label for="city" class="font-semibold text-gray-800 text-sm">City</label>
                                                    <input
                                                        type="text"
                                                        name="city"
                                                        class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"
                                                        placeholder="Your city"
                                                        value="{{ old('city') }}"
                                                    >
                                                </div>

                                                <!-- Date of Entry -->
                                                <div class="w-full flex flex-col">
                                                    <label for="dateOfEntry" class="font-semibold text-gray-800 text-sm">Date of Entry</label>
                                                    <input
                                                            type="date"
                                                            name="date_of_entry"
                                                            class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"
                                                            min="{{ date('Y-m-d') }}"
                                                            value="{{ old('date_of_entry') }}"
                                                        >
                                                  @error('date_of_entry')
                                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                                    @enderror
                                           
                                                </div>

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
                      <span class="text-secondary text-md font-semibold" > </span>
                  </div>

                  <div class="flex justify-between mt-3">
                      <span class="text-black text-md font-normal">Total:</span>
                      <span class="text-secondary text-md font-semibold visa-total">&#8377 135.58</span>
                  </div>




              </div>
              {{--    section right div ends here--}}

              <!-- Assign Client Modal -->

              <!-- Assign Client Modal -->
        <div id="assignClientModal"
            class="fixed inset-0 hidden items-center justify-center z-[99999]"
            style="background: rgba(0,0,0,0.2); backdrop-filter: blur(2px);">

            <div class="bg-white w-[400px] p-6 rounded shadow-xl"
                    style="box-shadow: 0 10px 40px rgba(0,0,0,0.2); border-radius: 8px;">

                    <h2 class="text-lg font-semibold mb-4">Assign Existing Client</h2>

                    <!-- Search Fields -->
                    <div>
                        <label class="text-sm font-semibold">Client ID</label>
                        <input type="text" id="clientIdInput"
                            class="w-full border p-2 mt-1 rounded">

                        <label class="text-sm font-semibold mt-3">Email</label>
                        <input type="text" id="clientEmailInput"
                            class="w-full border p-2 mt-1 rounded">
                    </div>

                    <!-- Search Button -->
                    <button id="searchClientBtn"
                            class="bg-blue-600 text-white px-4 py-2 rounded mt-4 w-full">
                        Search Client
                    </button>

                    <!-- Result Area -->
                    <div id="clientResult"
                        class="mt-4 hidden border p-3 rounded bg-gray-100"></div>

                    <button id="closeAssignClientModal"
                            class="bg-red-600 text-white px-4 py-2 rounded mt-4 w-full">
                        Close
                    </button>

                </div>
            </div>




          </section>
      </div>
    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>

    $(document).ready(function () {
        $('#typeof').on('change', function () {
            let dataId = $(this).find(':selected').data('id');
            $('#selectionid').val(dataId);
        });
    });


$(document).ready(function () {
        $("#openAssignClientModal").click(function () {
            $("#assignClientModal").removeClass("hidden").addClass("flex");
        });

        $("#closeAssignClientModal").click(function () {
            $("#assignClientModal").addClass("hidden").removeClass("flex");
        });
});


function useClient(data) {
    //   dd($data);
    $("#clientId").val(data.id);
    $("input[name='first_name']").val(data.first_name);
    $("input[name='last_name']").val(data.last_name);
    $("input[name='email']").val(data.email);
    $("input[name='phone_number']").val(data.phone_number);
    $("input[name='nationality']").val(data.nationality);
    $("input[name='zip_code']").val(data.zip_code);
    $("input[name='address']").val(data.address);
    $("input[name='city']").val(data.city);
    $("input[name='date_of_entry']").val(data.date_of_entry);

    // Close modal
    $("#assignClientModal").removeClass("flex").addClass("hidden");
}


$("#searchClientBtn").click(function () {
    let clientId = $("#clientIdInput").val().trim();
    let email = $("#clientEmailInput").val().trim();

    // Validation: At least one field must be filled
    if (clientId === "" && email === "") {
        $("#clientResult").removeClass("hidden").html(`
            <p class="text-red-600 font-semibold">Please enter Client ID or Email to search.</p>
        `);
        return; // Stop execution
    }

    $.ajax({
        url: "/client/search",
        type: "GET",
        data: {
            client_id: clientId,
            email: email
        },
        success: function (response) {
            if (response.status === "success") {

                $("#clientResult").removeClass("hidden").html(`
                    <p><b>Name:</b> ${response.data.first_name} ${response.data.last_name}</p>
                    <p><b>Email:</b> ${response.data.email}</p>
                    <p><b>Phone:</b> ${response.data.phone_number}</p>

                    <button onclick='useClient(${JSON.stringify(response.data)})'
                        class="bg-green-600 text-white px-4 py-2 mt-3 rounded w-full">
                        Use This Client
                    </button>
                `);

            } else {
                $("#clientResult").removeClass("hidden").html(`
                    <p class="text-red-600 font-semibold">${response.message}</p>
                `);
            }
        }
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
         var combination_id = $("#selectionid").val();

        
        if (visa_type_id) {
            $.ajax({
                url: "{{ route('get.visa.services') }}", // API for fetching subtypes
                type: "GET",
                data: { 
                visa_type_id: visa_type_id, 
                combination: combination_id 
            },
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
