<x-agency.layout>
    @section('title')Client Application @endsection

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
        {{-- Form Heading --}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Visa Application Form</span>
        </div>

        {{-- Progress Steps --}}
        <div class="w-full px-4 py-3 border-b border-ternary/10">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="step-indicator  active" id="step-indicator1" data-step="1">
                        <div class="step-number">1</div>
                        <div class="step-label">Personal Info</div>
                    </div>
                    <div class="step-connector"></div>
                    <div class="step-indicator" id="step-indicator2" data-step="2">
                        <div class="step-number">2</div>
                        <div class="step-label">Travel Details</div>
                    </div>
                    <div class="step-connector"></div>
                    <div class="step-indicator" id="step-indicator3" data-step="3">
                        <div class="step-number">3</div>
                        <div class="step-label">Verify Applicaton</div>
                    </div>
                   
                </div>
            </div>
        </div>
 

        {{-- Form Content --}}
        

            {{-- Step 1: Personal Information --}}
   
            <div class="form-step  hidden" id="form-step1" data-step="1">
                <div class="w-full flex flex-col gap-2 px-4 mt-4">
   
                    <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                        <span class="text-lg font-bold text-ternary">Personal Information</span>
                    </div>
                  
                 
                    @php
                            $permission = [];

                            if ($bookingData && $bookingData->clientrequiremtsinfo && $bookingData->clientrequiremtsinfo->name_of_field) {
                                $permission = json_decode($bookingData->clientrequiremtsinfo->name_of_field, true);
                            }

                            // Fields to be removed
                            $fieldsToRemove = [
                                'citizenship_id',
                                'educational_qualification',
                                'identification_marks',
                                'nationality',
                                'additional_passport_info_permission'
                            ];

                            // Filter the array to remove unwanted fields
                            $alreadySelect = array_values(array_diff($permission, $fieldsToRemove));
                        @endphp

                    <input type="hidden" name="booking_id" id="bookingid" value="{{ $bookingData->id }}">
                    <input type="hidden" name="previewDetails" id="previewstep" >
                    <input type="hidden" name="nextDetails" id="nextstep" >

                            


                    <div id="personal_details_permission" class="datashow w-full ">
                        @include('components.application.persionalinfo', ['agency' => $agency, 'bookingData' => $bookingData])
                    </div>

                    <div id="other_details_permission" class="datashow w-full hidden ">
                        @include('components.application.other_details', ['agency' => $agency, 'bookingData' => $bookingData ,'permission'=>$permission])             
                    </div>  
                  
                       <!-- Address  details -->
                       <div id="address_permission" class="datashow w-full hidden ">
                        @include('components.application.addressdetails', ['agency' => $agency, 'bookingData' => $bookingData])             
                    </div>  

                     <!-- get details  -->
                    <div id="wife_details_permission" class="datashow hidden">
                        @include('components.application.selftdetials', ['agency' => $agency, 'bookingData' => $bookingData])             
                    </div>   

                        <!-- Passport details   details -->
                        <div id="passport_details_permission" class="datashow w-full hidden">
                        @include('components.application.passportdetails', ['agency' => $agency, 'bookingData' => $bookingData,'permission'=>$permission])             
                    </div> 

                    <!-- child information -->
                    <div id="children_permission" class="datashow w-full hidden">
                        @include('components.application.childreendetails', ['agency' => $agency, 'bookingData' => $bookingData])             
                    </div>  

                 

                    <!-- Family   details -->
                    <div id="family_details_permission" class="datashow w-full p-4 hidden">
                        @include('components.application.familydetails', ['agency' => $agency, 'bookingData' => $bookingData])             
                    </div>  

                 

                    <!-- Work  details   details -->
                    <div id="occupation_details_permission" class="datashow w-full  hidden">
                        @include('components.application.workdetails', ['agency' => $agency, 'bookingData' => $bookingData])             
                    </div>  

                    <div id="armed_force_details_permission" class="datashow w-full grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4  hidden">
                        @include('components.application.armedforce', ['agency' => $agency, 'bookingData' => $bookingData])             
                    </div>  

                    <!-- <div class="w-full flex justify-end px-4 pb-4 gap-2 mt-8">
                                <button type="button" class="next-step text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                                    Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
                                </button>
                             </div> -->
                </div>
            </div>

            
       

            {{-- Step 2: Contact Details --}}
            <div class="form-step  hidden" id="form-step2" data-step="2">
                <div class="w-full flex flex-col gap-2 px-4 mt-4">
                    <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                        <span class="text-lg font-bold text-ternary">Travel Details</span>
                    </div>
                    
                    <!-- Add your contact details form fields here -->
                    
                    <div id="detailsofvisasought" class="datashow w-full">
                        @include('components.application.detailsofvisasought', ['agency' => $agency, 'bookingData' => $bookingData])
                    </div>
                  
                    
                    <div id="previewvisadetails" class="datashow w-full hidden">
                        @include('components.application.previewvisadetails', ['agency' => $agency, 'bookingData' => $bookingData])
                    </div>






                </div>

                <!-- <div class="w-full flex justify-between px-4 pb-4 gap-2 mt-8">
                    <button type="button" class="prev-step text-sm bg-ternary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/90 text-ternary hover:text-white hover:bg-ternary hover:border-ternary/30 transition ease-in duration-200">
                        <i class="fa fa-arrow-left mr-1"></i> Previous
                    </button>
                    <button type="button" class="next-step text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                        Next: Passport Info <i class="fa fa-arrow-right ml-1"></i>
                    </button>
                </div> -->
            </div>



            {{-- Step 2: Contact Details --}}
            <div class="form-step hidden active" id="form-step3" data-step="3">
                <div class="w-full flex flex-col gap-2 px-4 mt-4">
                    <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                        <span class="text-lg font-bold text-ternary">Verify Application</span>
                    </div>
                    
                    <!-- Add your contact details form fields here -->
                    <div class="w-full ">
                        @include('components.application.viewapplication', ['agency' => $agency, 'bookingData' => $bookingData])          
                
                    </div>
                </div>

                <!-- <div class="w-full flex justify-between px-4 pb-4 gap-2 mt-8">
                    <button type="button" class="prev-step text-sm bg-ternary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/90 text-ternary hover:text-white hover:bg-ternary hover:border-ternary/30 transition ease-in duration-200">
                        <i class="fa fa-arrow-left mr-1"></i> Previous
                    </button>
                    <button type="button" class="next-step text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
                        Next: Passport Info <i class="fa fa-arrow-right ml-1"></i>
                    </button>
                </div> -->
            </div>

</div>
      
    </div>

    <script>

        // function for back
        const alreadySelect = @json($alreadySelect);
        $(document).ready(function () {
                // Get the currently visible element with class `datashow`
                let visibleElementId = $('.datashow:visible').attr('id');
                $("#previewstep").val(visibleElementId);
                let currentIndex = alreadySelect.indexOf(visibleElementId);
                let nextStep = alreadySelect[currentIndex + 1] ?? null;

                if (nextStep) {
                    $("#nextstep").val(nextStep);
                } else {
                    $("#nextstep").val(""); // or handle "no more steps"
                }

                console.log("Next Step ID:", nextStep);
        });

        jQuery(document).ready(function($) {
          
            
            $(document).on('click','.backbutton',function(e) {
            
                e.preventDefault();
                let currentStep = $(this).data('current');
              
                let previewTab = $(this).data('previewtab');
                jQuery("#form_"+currentStep).hide();
                jQuery("#form_"+previewTab).show();
                    
            }) 
        })
        // Preview Name
       
        $(document).ready(function () {
            // Get initial value and show/hide section accordingly
            let value = $("input[name='has_previous_name']:checked").val();
            togglePreviousName(value === 'yes');

            // Listen for changes
            $("input[name='has_previous_name']").on("change", function () {
                let selectedValue = $(this).val();
                togglePreviousName(selectedValue === 'yes');
            });
        });

        function togglePreviousName(show) {
            const section = document.getElementById('previousNameSection');
            if (show) {
                section.classList.remove('hidden');
            } else {
                $("#previous_name").val('');
                section.classList.add('hidden');
            }
        }



        // Material Status
     

        // Child Information
        $(document).ready(function () {
            // Show/hide child section based on selection
            $('input[name="has_child"]').on('change', function () {
                if ($(this).val() === 'yes') {
                    $('#childInfoSection').removeClass('hidden');
                    if ($('#childFieldsContainer').children().length === 0) {
                        $('#childFieldsContainer').append(getChildFields());
                    }
                } else {
                    $('#childInfoSection').addClass('hidden');
                    $('#childFieldsContainer').empty();
                }
            });

            // Add more child info
            $('#addMoreChild').on('click', function () {
                $('#childFieldsContainer').append(getChildFields());
            });

            // Remove child info
            $(document).on('click', '.removeChildBtn', function () {
                $(this).closest('.child-fields').remove();
            });

            // Template for one child entry
            function getChildFields() {
                return `
                    <div class="child-fields border p-4 mb-4 rounded-[3px] rounded-tr-[8px] border-secondary/40 bg-white shadow-sm relative bg-black/10 shadow-lg shadow-black/10">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div>
                                <label class="font-semibold text-sm text-ternary/90">Name</label>
                                <input type="text" name="child_name[]" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                            </div>

                            <div>
                                <label class="font-semibold text-sm text-ternary/90">Date of Birth</label>
                                <input type="date" name="child_dob[]" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                            </div>

                            <div>
                                <label class="font-semibold text-sm text-ternary/90">Nationality</label>
                                <input type="text" name="child_nationality[]" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                            </div>

                            <div class="col-span-full">
                                <label class="font-semibold text-sm text-ternary/90">Address</label>
                                <input type="text" name="child_address[]" class="w-full pl-2 pr-2 py-1 border rounded-[3px] border-secondary/40 focus:outline-none focus:border-secondary/70 transition ease-in duration-200">
                            </div>
                        </div>

                        <button type="button" class="removeChildBtn absolute top-2 right-2 text-red-500 hover:text-white text-xs border border-red-500 hover:bg-red-500 rounded px-2 py-[1px]">
                            Remove
                        </button>
                    </div>
                `;
            }
        });

        // armed form 
        $(document).ready(function () {
            // Show/hide child section based on selection
            $('input[name="has_aermendpermission"]').on('change', function () {
                if ($(this).val() === 'yes') {
                    $('#armInfoSection').removeClass('hidden');
                    
                } else {
                    $('#armInfoSection').addClass('hidden');
                   
                }
            });
        });
        // Address lookup
        $(document).ready(function () {
            $("#searchAddress").on("click", function (e) {
                e.preventDefault();

                const postcode = $("#zip_code").val().trim();

                if (!postcode) {
                    alert("Please enter a postcode.");
                    return;
                }

                $.ajax({
                    url: `https://api.getaddress.io/find/${postcode}?api-key=uz1Ks6ukRke3TO_XZBrjeA22850&expand=true&sort=true`,
                    method: "GET",
                    dataType: "json",
                    success: function (response) {
                        const select = $('#address-select');
                        const wrapper = $('#address-wrapper');
                        select.empty();

                        if (response && response.addresses && response.addresses.length > 0) {
                            select.append(`<option value="">Select an address</option>`);

                            response.addresses.forEach((address) => {
                                const labelText = address.formatted_address.filter(Boolean).join(', ');
                                const option = $(`
                                    <option value="${labelText}"
                                            data-street="${address.line_1 || ''}${address.line_2 ? ', ' + address.line_2 : ''}"
                                            data-county="${address.county || ''}"
                                            data-city="${address.town_or_city || ''}"
                                            data-country="${address.country || ''}">
                                        ${labelText}
                                    </option>
                                `);
                                select.append(option);
                            });

                            wrapper.removeClass('hidden');
                        } else {
                            wrapper.addClass('hidden');
                            alert("Invalid postcode or no addresses found.");
                        }
                    },
                    error: function () {
                        alert("Could not fetch postcode data. Please try again.");
                    }
                });
            });

            $("#address-select").on("change", function () {
                const selected = $(this).find(":selected");

                $("#permanent_address").val(selected.val() || "");
                $("#street").val(selected.data("street") || "");
                $("#city").val(selected.data("city") || "");
                $("#county").val(selected.data("county") || "");
                $("#country").val(selected.data("country") || "");
            });
        });

    
        $(document).ready(function () {    
            $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                    $('.ajax-form').on('submit', function (e) {

                        e.preventDefault();
                        let $form = $(this);
                        let formData = $form.serializeArray(); // ✅ make sure this returns an array
                        let bookingid = $('#bookingid').val(); // get the common bookingid

                        formData.push({ name: 'bookingid', value: bookingid }); // ✅ works now

                        $.ajax({
                            url: "{{ route('client.update') }}", // Same route for all
                            method: "POST",
                            data: formData ,
                            success: function (response) {
                                            let nextStep = $("#nextstep").val();
                                            let previewStep = $("#previewstep").val();
                                            if (nextStep && nextStep.length > 0) {
                                                let currentIndex = alreadySelect.indexOf(nextStep);
                                                let nextStepValue = alreadySelect[currentIndex + 1] ?? null;
                                                $("#nextstep").val(nextStepValue);
                                                $("#" + nextStep).show();
                                                $("#" + previewStep).hide();
                                                $("#previewstep").val(nextStep);
                                            } else {
                                                jQuery(".form-step").removeClass("active").addClass("hide");
                                                jQuery("#form-step2").addClass("active").removeClass("hide").show();
                                                jQuery(".fstep-indicator").removeClass("active").addClass("hide");
                                                jQuery("#step-indicator2").addClass("active").removeClass("hide").show();
                                             }
                                },
                            error: function (xhr) {
                                alert("Error: " + xhr.responseText);
                            }
                        });
                    });
                           
});

$(document).ready(function () {    
            $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                    $('.visaajax-form').on('submit', function (e) {

                        e.preventDefault();
                        let $form = $(this);
                        let formData = $form.serializeArray(); // ✅ make sure this returns an array
                        let bookingid = $('#bookingid').val(); // get the common bookingid

                        formData.push({ name: 'bookingid', value: bookingid }); // ✅ works now

                        $.ajax({
                            url: "{{ route('visadocument.update') }}", // Same route for all
                            method: "POST",
                            data: formData ,
                            success: function (response) {
                                              
                                            if(response.step == 'Done'){
                                                jQuery(".form-step").removeClass("active").addClass("hide");
                                                jQuery("#form-step3").addClass("active").removeClass("hide").show();
                                                jQuery(".fstep-indicator").removeClass("active").addClass("hide");
                                                jQuery("#step-indicator3").addClass("active").removeClass("hide").show();

                                            }
                                            jQuery("#detailsofvisasought").hide(); 
                                            jQuery("#previewvisadetails").show(); 
                                            } 
                                ,
                            error: function (xhr) {
                                alert("Error: " + xhr.responseText);
                            }
                        });
                    });
                           
});





    </script>

 
    
    <style>
        .step-indicator {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #e2e8f0;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }
        
        .step-label {
            font-size: 12px;
            color: #64748b;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .step-connector {
            height: 2px;
            width: 40px;
            background-color: #e2e8f0;
            margin: 0 5px;
        }
        
        .step-indicator.active .step-number {
            background-color: #3b82f6;
            color: white;
        }
        
        .step-indicator.active .step-label {
            color: #3b82f6;
            font-weight: 600;
        }
        
        .step-indicator.completed .step-number {
            background-color: #10b981;
            color: white;
        }
        
        .step-indicator.completed .step-label {
            color: #10b981;
        }
        
        .form-step {
            display: none;
        }
        
        .form-step.active {
            display: block;
        }
    </style>
</x-agency.layout>