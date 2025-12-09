<x-agency.layout>
    @section('title') Visa View @endsection
      <div class="w-full relative">
          <img class="absolute -top-20 left-0  w-full opacity-20" style="z-index: -1" src="{{asset('assets/images/bgImage.png')}}" alt="">


          <span class="text-secondary lg:text-3xl md:text-2xl text-xl font-semibold">Visa to {{$visas['0']->destinationcountry->countryName}}</span>
     

          <section class="flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-col sm:flex-col flex-col justify-center w-full mt-6">
              {{--    section left div starts here--}}
              <div class="2xl:w-3/4 xl:w-3/4 lg:w-3/4 md:w-full sm:w-full w-full bg-white shadow-lg shadow-black/10 rounded-md p-4">
                      <span class="text-lg text-secondary font-semibold">Visa Details</span>
                  <form id="visaForm" action="{{  route('update.visa.book') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                      @csrf

                          <div class="flex flex-col">
                              <div class="flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-row sm:flex-row flex-col w-full justify-between mt-2 gap-2">
                                  <div class=" lg:w-[33.3%] md:w-1/3  w-full flex flex-col relative" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Visa Category</label>
                                      <input type="hidden" value="{{ $visas['0']->origin }}" name="origin">
                                      <input type="hidden" value="{{ $visas['0']->destination }}" name="destination">
                                      <input type="hidden" value="{{ $visas['0']->id }}" name="selectionid" id="selectionid">
                                      <input type="hidden" value="{{ $applicationData->id }}" name="applicationid" id="applicationid">


                                      
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

                                 
                                                                @php 
                                  $booking      = $applicationData;
                                  $client       = $clientInformation;
                                  $moreInfo     = $client?->clientinfo;

                                  $firstName    = $client?->first_name ?? '';
                                  $lastName     = $client?->last_name ?? '';
                                  $email        = $client?->email ?? '';
                                  $phoneNumber  = $client?->phone_number ?? '';
                                  $citizenship  = $client?->country ?? '';  
                                  $entryDate    = $applicationData?->dateofentry ?? '';
                              @endphp


                              </div>
                          </div>
                          <div class="flex flex-wrap gap-4 mt-5 w-full">
                             <div class="flex flex-col">
                                    <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Date of Entry</label>
                                       <input type="date" name="dateofentry" id="dateofentry" max="9999-12-31" value="{{ $entryDate }}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                
                                        @error('dateofentry')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                 <!-- <label class="block mt-2 font-semibold">Select User Type</label>
                                 <div class="flex gap-2 mt-2">
                                     <button type="button" id="existingUserBtn" class="bg-secondary text-white px-3 py-0.5 text-xs rounded">Existing User</button>
                                     <div id="userLoader" class="hidden text-secondary font-semibold text-sm">
                                            <i class="fa fa-spinner fa-spin"></i> Loading users...
                                        </div>
                                     <a href="{{route('client.index')}}">  <button type="button" id="newUserBtn" class="bg-gray-500 text-white px-3 py-1 text-xs rounded">New User</button> </a>
                                 
                                   
                                </div> -->
                                 @error('clientId')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                             </div>

                              <div id="existingUserSection" class="hidden flex flex-col ">
                                  <label class=" font-semibold text-gray-800 text-sm">Select Existing User</label>
                                  <select class="visa-select w-[250px] mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" id="existingUserDropdown" name="clientId">
                                      <option value="">Select User</option>
                                      <!-- Users will be added dynamically using AJAX -->
                                  </select>
                                 
                              </div>
                          </div>

                          <!-- Self/Family Selection Checkboxes -->
                          <div class="flex gap-4 mt-5 w-full" id="applicantTypeSection" style="display: none;">
                              <label class="flex items-center gap-2 cursor-pointer">
                                  <input type="checkbox" id="selfCheckbox" name="applicant_type[]" value="self" class="w-4 h-4 text-secondary border-gray-300 rounded focus:ring-secondary" checked>
                                  <span class="font-semibold text-gray-800 text-sm">Self</span>
                              </label>
                              <label class="flex items-center gap-2 cursor-pointer">
                                  <input type="checkbox" id="familyCheckbox" name="applicant_type[]" value="family" class="w-4 h-4 text-secondary border-gray-300 rounded focus:ring-secondary">
                                  <span class="font-semibold text-gray-800 text-sm">Family Members</span>
                              </label>
                                
                          </div>

                          <div class="addresspart flex flex-col mt-5 border-[1px] border-secondary/30 p-4"  style="display: none" id="selfDetailsSection">
                              <div class="flex justify-between items-center mb-3">
                                  <span class="font-semibold text-gray-800">Self Details </span>
                              </div>
                              <div class="w-full grid lg:grid-cols-5 md:grid-cols-5 sm:grid-cols-4 grid-cols-1 gap-1">
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Last Name</label>
                                      <input type="text" name="lastname" id="lastName"  class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" placeholder="As shown in passport" readonly="">
                                  </div>
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">First Name</label>
                                      <input type="text" name="firstname"  id="firstName"  class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" placeholder="As shown in passport" readonly="">

                                  </div>
                                     <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Email</label>
                                      <input type="email" name="email"  id="email"  class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" placeholder="Enter your email" readonly="">

                                  </div>
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Nationality</label>
                                      <input type="text" name="citizenship" value="" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"  id="citizenship" readonly="">

                                  </div>
                               
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Phone Number</label>
                                      <input type="text"  name="phonenumber"   id="phonenumber" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" placeholder="Enter your phone number" readonly="">

                                  </div>
                               
                              </div>
                          </div>

                          <!-- Family Members Container -->
                          <!-- <div id="familyMembersContainer" style="display: none;"></div> -->
                           <div id="familyMembersContainer" class="{{ count($familyMembers) ? '' : 'hidden' }}">
                                    @foreach($familyMembers as $member)
                                          @if($member->clientinfo->application_type == 'family')
                                           
                                            <div class="addresspart mt-5 border p-4 family-box">
                                                <label class="flex gap-2">
                                                    <input type="checkbox" class="family-member-checkbox" checked>
                                                    <strong>{{ $member->first_name }} {{ $member->last_name }} ({{ $member->clientinfo->familyMembers->relationship }})</strong>
                                                </label>

                                                <div class="grid lg:grid-cols-5 gap-1 mt-2">
                                                    <input type="hidden" name="family_member_ids[]" value="{{ $member->id }}">

                                                    <input name="family_passengerlastname[]" value="{{ $member->last_name }}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" readonly>
                                                    <input name="family_passengerfirstname[]" value="{{ $member->first_name }}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" readonly>
                                                    <input name="family_passengeremail[]" value="{{ $member->email }}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" readonly>
                                                    <input name="family_passengerplace[]" value="{{ $member->nationality }}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" readonly>
                                                    <input name="family_passengerphonenumber[]" value="{{ $member->phone_number }}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" readonly>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>


                          <!-- Add More Button for Additional Passengers -->
                          <div class="flex justify-end mt-3" id="addMoreBtnContainer" style="display: none;">
                              <button type="button" id="addMoreBtn" class="px-3 py-1.5 text-sm font-semibold rounded-sm border-[1px] border-success text-success bg-success/10 hover:bg-success hover:text-white transition ease-in duration-200">Add More Passenger</button>
                          </div>

                           <div id="dynamicFieldsContainer">
                           @foreach($familyMembers as $member)
                                    @if($member->clientinfo->application_type == 'other')
                                        <div class="addresspart mt-5 border p-4 dynamic-box">
                                            <div class="flex justify-end">
                                                <button type="button" class="removePassenger text-red-500 text-xs">Remove</button>
                                            </div>

                                            <input type="hidden" name="other_member_ids[]" value="{{ $member->id }}">

                                            <div class="grid lg:grid-cols-5 gap-1 mt-2">
                                                <input name="passengerlastname[]" value="{{ $member->last_name }}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                                <input name="passengerfirstname[]" value="{{ $member->first_name }}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                                <input name="passengeremail[]" value="{{ $member->email }}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                                <input name="passengerplace[]" value="{{ $member->nationality }}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                                <input name="passengerphone[]" value="{{ $member->phone_number }}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                               </div>



                      <div class=" flex w-full justify-end  mt-5">
                          <!-- <a class="bg-secondary text-gray-100 text-lg py-2 px-5 rounded-md submitbutton">Proceed to Payment </a> -->
                                   <!-- <input type="submit" class="cursor-pointer bg-secondary text-gray-100 text-lg py-2 px-5 rounded-md submitbutton" value=" Proceed To Payment"   onclick="return confirm('Are all the details correct? Please check before proceeding.');"> -->
                        </div>
                                      <!-- BUTTON -->
                        <button type="button"
                                onclick="openConfirmModal()"
                                class="cursor-pointer bg-secondary text-gray-100 text-lg py-2 px-5 rounded-md submitbutton">
                            Proceed To Payment
                        </button>

                                                

                      

                  </form>
              </div>






              <div class="2xl:w-1/4 sticky top-20 xl:w-1/4 lg:w-1/4 md:w-full sm:w-full w-full  bg-white shadow-lg shadow-black/10 rounded-sm 2xl:mt-0 xl:mt-0 lg:mt-0 md:mt-2 sm:mt-2 mt-2 2xl:ml-5 xl:ml-5 lg:ml-5 md:ml-0 sm:ml-0 ml-0 h-min p-4">

                  <div class="flex flex-col pb-2 border-b-2 border-b-secondary/30">
                      <span class="text-secondary font-semibold text-xl ">Basket Details</span>
                  </div>
                  <div class="flex justify-between mt-3">
                      <span class="text-black text-md font-normal">Visa Fee:</span>
                      <span class="text-secondary text-md font-semibold visa-price">{{ $CURRENCY }}8377 235.58</span>
                  </div>
                  <div class="flex justify-between mt-1.5">
                      <span class="text-black text-md font-normal">Service Fee:</span>
                      <span class="text-secondary text-md font-semibold visa-commision">{{ $CURRENCY }}5,998.00</span>
                  </div>
                  <div class="flex justify-between mt-1.5 pb-3 border-b-2 border-b-secondary/30 ">
                      <span class="text-black text-md ">Tax:</span>
                      <span class="text-secondary text-md font-semibold visa-tax" > </span>
                  </div>

                  <div class="flex justify-between mt-3">
                      <span class="text-black text-md font-normal">Total:</span>
                      <span class="text-secondary text-md font-semibold visa-total">{{ $CURRENCY }}8377 135.58</span>
                  </div>




              </div>
              {{--    section right div ends here--}}

              
<!-- CUSTOM CONFIRM MODAL -->
<div id="confirmModal"
     class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center">
    
    <div class="bg-white p-6 rounded shadow-lg w-[350px] text-center">
        <h3 class="text-lg font-semibold mb-3">Confirm Details</h3>
        <p class="mb-4">Are all the details correct?</p>

        <div class="flex justify-between">
            <button onclick="submitForm()"
                    class="bg-green-600 text-white px-4 py-2 rounded">
                Yes, all details are confirmed
            </button>

            <button onclick="closeConfirmModal()"
                    class="bg-gray-300 px-4 py-2 rounded">
                Cancel
            </button>
        </div>
    </div>
</div>
          </section>
      </div>
    @section('scripts')
    <!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

const CURRENCYes = "{{ config('app.currency') }}";
let autoTrigger = false;

$(document).ready(function () {

    initializeSelect2();
    bindEvents();
    fetchCategories();
    handleFamilyMemberSelection(); // 🔥 Added

    let existingClientId = "{{ $applicationData->client_id }}";
    let applyFor = "{{ $applicationData->apply_for }}";
    let storedProcessing = "{{ $applicationData->processing_time ?? '' }}";

    if(existingClientId){
        autoTrigger = true;
        $("#existingUserSection").removeClass("hidden");
        $("#userLoader").removeClass("hidden");

        fetchExistingUsers(() => {
            setTimeout(() => {
                $('#existingUserDropdown').val(existingClientId).trigger("change");
                $("#selfCheckbox").prop("checked", true).trigger("change");
                autoTrigger = false;
            }, 300);
        });

        setTimeout(() => {
            if(storedProcessing){
                $("#processing").html(`<option value="${storedProcessing}">${storedProcessing}</option>`);
            }
        }, 600);
    }

    setTimeout(updateVisaPrice, 1200);
});


// ---- UI Setup ---- //
function initializeSelect2(){
    $('#existingUserDropdown').select2({
        placeholder: "--- Select User ---",
        allowClear: true
    });
}


// ---- Event Binding ---- //
function bindEvents(){
    $("#typeof").on("change", fetchCategories);
    $("#existingUserDropdown").on("change", onUserSelected);
    $("#selfCheckbox").on("change", toggleSelf);
    $("#familyCheckbox").on("change", toggleFamily);
    $("#addMoreBtn").on("click", () => addPassenger());

    $(document).on("click", ".removePassenger", function(){
        $(this).closest(".dynamic-box").remove();
        updateVisaPrice();
    });

    $(document).on("change keyup", "input, select, .family-member-checkbox", updateVisaPrice);
}


// ---- Fetch VISA subtypes ---- //
function fetchCategories(){
    let visaType = $("#typeof").val();
    let combination = $("#selectionid").val();
    if(!visaType) return;

    $.get("{{ route('get.visa.services') }}", { visa_type_id: visaType, combination }, function(res){

        let options = "";
        res.visa_subtypes.forEach(c => {
            options += `<option value="${c.id}"
                data-processing="${c.processing}"
                data-price="${c.price}"
                data-balance="${res.balance}"
                data-gst="${c.gstin}"
                data-commission="${c.commission}">
                ${c.name}</option>`;
        });

        $("#category").html(options).trigger("change");
    });
}


// ---- Load Users ---- //
function fetchExistingUsers(callback){
    $.get("{{ route('get.existing.users') }}", function(res){
        let html = '<option value="">Select User</option>';
        res.forEach(u => {
            html += `<option value="${u.id}"
                data-name="${u.first_name}"
                data-lastname="${u.last_name}"
                data-email="${u.email}"
                data-phone="${u.phone_number}"
                data-nationality="${u.clientinfo?.nationality ?? ''}">
                ${u.client_name}</option>`;
        });

        $("#existingUserDropdown").html(html);

        if(callback) callback();
        $("#userLoader").addClass("hidden");
    });
}


// ---- When User Selected ---- //
function onUserSelected(){
    let u = $(this).find(":selected");
    let id = $(this).val();
    if(!id) return;

    window.selectedUser = {
        id,
        first: u.data("name"),
        last: u.data("lastname"),
        email: u.data("email"),
        phone: u.data("phone"),
        nationality: u.data("nationality")
    };

    $("#applicantTypeSection").show();

    if(!autoTrigger){
        $("#selfCheckbox, #familyCheckbox").prop("checked", false).trigger("change");
    }
}


// ---- Self Section ---- //
function toggleSelf(){

    if(!$("#selfCheckbox").is(":checked")){
        $("#selfDetailsSection").hide();
        if(!$("#familyCheckbox").is(":checked"))
            $("#addMoreBtnContainer").hide();
        updateVisaPrice();
        return;
    }

    let u = window.selectedUser;
    if(!u) return;

    $("#lastName").val(u.last);
    $("#firstName").val(u.first);
    $("#email").val(u.email);
    $("#phonenumber").val(u.phone);
    $("#citizenship").val(u.nationality);

    $("#selfDetailsSection").show();
    $("#addMoreBtnContainer").show();

    updateVisaPrice();
}

// Handle family member selection
function handleFamilyMemberSelection() {

    // On submit, disable unchecked inputs so they are NOT submitted
    $("form").on("submit", function () {
        $(".family-box").each(function () {
            const checkbox = $(this).find(".family-member-checkbox");
            if (!checkbox.is(":checked")) {
                $(this).find("input").prop("disabled", true);
            } else {
                $(this).find("input").prop("disabled", false);
            }
        });
    });

    // When any member is checked/unchecked -> enable/disable fields for editing
    $(document).on("change", ".family-member-checkbox", function () {
        const box = $(this).closest(".family-box");

        if ($(this).is(":checked")) {
            box.find("input").prop("readonly", false);
        } else {
            box.find("input").prop("readonly", true);
        }

        updateFamilyMainCheckbox();
    });

    // Main Family Checkbox → select/deselect all
    $("#familyCheckbox").on("change", function () {
        const checked = $(this).is(":checked");
        $(".family-member-checkbox").prop("checked", checked).trigger("change");
    });
}

// Auto adjust main checkbox based on children
function updateFamilyMainCheckbox() {
    const total = $(".family-member-checkbox").length;
    const checked = $(".family-member-checkbox:checked").length;

    $("#familyCheckbox").prop("checked", total > 0 && total === checked);
}

// Run this along with your existing functions
$(document).ready(function () {
    handleFamilyMemberSelection();
});



// ---- Family Section ---- //
function toggleFamily(){
    if(!$("#familyCheckbox").is(":checked")){
        $("#familyMembersContainer").hide().empty();
        updateVisaPrice();
        return;
    }
    loadFamilyMembers(window.selectedUser.id);
}


// ---- Load Family from DB ---- //
function loadFamilyMembers(id){
    $.get("{{ url('/agencies/get-family-members') }}/" + id, function(res){
        $("#familyMembersContainer").empty().toggle(res.family_members.length > 0);

        res.family_members.forEach((m,i)=>{
            $("#familyMembersContainer").append(familyCard(m,i));
        });
        updateVisaPrice();
    });
}


// ---- UI Templates ---- //
function familyCard(m,i){
return `<div class="addresspart mt-5 border p-4 family-box">
    <label class="flex gap-2">
        <input type="checkbox" class="family-member-checkbox" checked>
        <strong>${m.first_name} ${m.last_name} (${m.relationship})</strong>
    </label>

    <div class="grid lg:grid-cols-5 gap-1 mt-2">

        <input name="family_passengerlastname[]" value="${m.last_name}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" />
        <input name="family_passengerfirstname[]" value="${m.first_name}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" />
        <input name="family_passengeremail[]" value="${m.email ?? ''}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" />
        <input name="family_passengerplace[]" value="${m.nationality ?? ''}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" />
        <input name="family_passengerphonenumber[]" value="${m.phone_number ?? ''}" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" />

    </div>
</div>`;
}


// ---- Add Extra Passenger ---- //
function addPassenger(){
    $("#dynamicFieldsContainer").append(`
    <div class="addresspart mt-5 border p-4 dynamic-box">
        <div class="flex justify-end"><button type="button" class="removePassenger text-red-500 text-xs">Remove</button></div>
        <div class="grid lg:grid-cols-5 gap-1">
            <input name="passengerlastname[]" placeholder="Last Name" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" />
            <input name="passengerfirstname[]" placeholder="First Name" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" />
            <input name="passengeremail[]" placeholder="Email" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" />
            <input name="passengerplace[]" placeholder="Nationality" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" />
            <input name="passengerphone[]" placeholder="Phone" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" />
        </div>
    </div>`);
    updateVisaPrice();
}


// ---- Visa Cost Update ---- //
function updateVisaPrice(){

    let sel = $("#category").find(":selected");
    let price = parseFloat(sel.data("price") || 0);
    let commiss = parseFloat(sel.data("commission") || 0);
    let gst = parseFloat(sel.data("gst") || 0);

    let gstAmt = ((price + commiss) * gst) / 100;
    let perPerson = price + commiss + gstAmt;

    let pax = 0;
    if($("#selfCheckbox").is(":checked")) pax++;
    pax += $(".family-box input:checked").length;
    pax += $(".dynamic-box").length;

    $(".visa-price").text(CURRENCYes + price.toFixed(2));
    $(".visa-commision").text(CURRENCYes + commiss.toFixed(2));
    $(".visa-tax").text(CURRENCYes + gstAmt.toFixed(2));
    $(".visa-total").text(CURRENCYes + (perPerson * pax).toFixed(2));
}


// ---- Processing Time Change ---- //
$("#category").on("change", function(){
    let p = $(this).find(":selected").data("processing");
    $("#processing").html(`<option value="${p}">${p}</option>`);
    updateVisaPrice();
});


// ---- Confirm Modal Controls ---- //
function openConfirmModal(){
    if(validateForm()) $("#confirmModal").removeClass("hidden");
}
function closeConfirmModal(){
    $("#confirmModal").addClass("hidden");
}
function submitForm(){
    $("#visaForm").submit();
}


// ---- Validation ---- //
function validateForm(){
    let errors = [];

    if(!$("#typeof").val()) errors.push("Select Visa Category");
    if(!$("#category").val()) errors.push("Select Visa Type");
    if(!$("#existingUserDropdown").val()) errors.push("Select User");
    if(!$("input[name='applicant_type[]']:checked").length)
        errors.push("Select Self / Family");

    if(errors.length){
        alert(errors.join("\n"));
        return false;
    }
    return true;
}

</script>

    @endsection
</x-agency.layout>
