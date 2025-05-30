<x-front.layout>
    @section('title') Visa Application @endsection



    <style> 
      .card {
            width: 600px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            position: relative;
        }

        .background-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(45deg,
            rgba(128,128,128,0.05) 0px,
            rgba(128,128,128,0.05) 2px,
            transparent 2px,
            transparent 8px
            );
            z-index: 0;
        }

        .header {
            color: white;
            padding: 15px 0px;
            font-size: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 1;
        }
        .headerTitle
        {
            background: #0066cc;
            color: white;
            padding: 15px 20px;
            font-size: 24px;
            border-bottom-right-radius: 50px;
            border-top-right-radius: 50px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .content {
            padding: 20px;
            display: flex;
            gap: 20px;
            position: relative;
            z-index: 1;
        }

        .photo {
            width: 120px;
            height: 150px;
            background: #f0f0f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .details {
            flex: 1;
        }

        .field {
            margin-bottom: 15px;
        }

        .field-label {
            font-weight: bold;
            margin-right: 10px;
        }

        .barcode {
            margin-top: 20px;
            text-align: center;
        }

        .barcode img {
            height: 50px;
            width: 80%;
        }

        .id-number {
            color: #0066cc;
            font-weight: bold;
            margin-top: 10px;
        }


        .container { width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; }
        .header { text-align: center; font-size: 20px; font-weight: bold; }
        .details { margin-top: 20px; }
        .details table { width: 100%; border-collapse: collapse; }
        .details th, .details td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; }
    </style>


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl"></span>
            <span class="font-semibold text-ternary text-xl">
              Application Number : {{ $clientData->application_number ?? 'N/A' }} 
                

</span>

            <span class="font-semibold text-ternary text-xl"></span>

            
        </div>

        


        <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex flex-wrap ">

                <div data-tid="ViewApplicationDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] bg-secondary/40 border-[2px] border-secondary/60 border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-file-alt text-ternary"></i>
                    Application
                </div>

                <div data-tid="formsDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-file-alt text-ternary"></i>
                    Forms
                </div>

            @if($clientData->applicationworkin_status !== "Complete")      
                <div data-tid="requestDocumentDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-file-signature text-ternary"></i>
                    Request Document
                </div>

                <div data-tid="visaRequestDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-eye text-ternary"></i>
                    View Request Document
                </div>

             

                <div data-tid="editApplicationDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-edit text-ternary"></i>
                    Edit Application
                </div>
            
             @else           
                  <div data-tid="uploadDocumentDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                        <i class="fas fa-upload text-ternary"></i>
                        Upload Document
                    </div>
             
            @endif 
            <div data-tid="sendEmailDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-envelope text-ternary"></i>
                    Send Email
                </div>

                <a href="{{ route('superadminvisachat.client', ['id' => $clientData->client_id, 'token' => $clientData->agency->agencytoken]) }}">
                  <div  class=" w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-comments text-ternary"></i>
                    Conversation
                </div>
               </a>

               <div data-tid="logDataDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-eye text-ternary"></i>
                    Log Data 
                </div>

                <!-- <div data-tid="applicationDataDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-eye text-ternary"></i>
                    View Application  
                </div> -->
                <a href="{{ route('verifyvisa.application', ['id' => $clientData->id, 'type' => 'superadmin']) }}">
                <div  class="w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-eye text-ternary"></i>
                    View Application  
                </div>
    </a>

              </div>

                <div class="w-full mt-4 ">
            <!-- start joing letter  -->

        
                <!-- view application  -->
                <div id="ViewApplicationDiv" class="tab  ">
                    <x-common.viewapplication :clientData="$clientData" />
  
                </div>

                <!-- end applicatoin  -->

                <div id="requestDocumentDiv" class="tab hidden">
                    <x-common.requestdocument :booking="$clientData" />             
                </div>

      <!-- end joing letter  -->
                    <div id="visaRequestDiv" class="tab  hidden">
                        <x-common.viewrequrestdoc :documents="$clientData->clientrequestdocuments" /> 
                    </div>

            <!-- end joing letter  -->
                <div id="formsDiv" class="tab  hidden">
                     <x-common.forms :clientData="$clientData" :forms="$forms" /> 
                 </div>

                    <!-- icard -->
                    <div id="editApplicationDiv" class="tab hidden">
                        <x-common.editapplication :clientData="$clientData" :forms="$forms" /> 
                    </div>

                      <!-- attendance -->
                      <div id="uploadDocumentDiv" class="tab hidden">
                         <x-common.uploadclient :booking="$clientData" :forms="$forms" /> 
                      </div>

                      
                      <div id="sendEmailDiv" class="tab hidden">
                        <x-common.sendemail :clientData="$clientData" :forms="$forms" />  
                    </div>       

                    <div id="logDataDiv" class="tab  hidden">
                        <x-common.visalog :logs="$clientData->applicationlog->sortByDesc('created_at')" /> 
                    </div>

                    <div id="applicationDataDiv" class="tab hidden">
                        <!-- here -->
                    <div class="w-full flex flex-col gap-2 px-4 mt-4">
                    <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                        <span class="text-lg font-bold text-ternary">Verify Application</span>
                    </div>
                    @php
                    $permission = $clientData && $clientData->clientrequiremtsinfo->name_of_field ? json_decode($clientData->clientrequiremtsinfo->name_of_field, true) : [];
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
                    <input type="hidden" name="booking_id" id="bookingid" value="{{ $clientData->id }}">

             
                    <!-- Add your contact details form fields here -->
                    <div class="w-full" >
                            @include('components.application.viewapplication', ['bookingData' => $clientData, 'type' => 'superadmin'])          
                        </div>

                </div>
                <!-- here -->
                    </div>

                </div>

            </div>
        </div>

        <script>
        jQuery(document).ready(function () {
            jQuery(document).on("click", ".agency_tab", function () {
                                var id = jQuery(this).data('tid');
                                  jQuery(".agency_tab").removeClass("bg-secondary/40 border-[2px] border-secondary/60");
                                jQuery(this).addClass("bg-secondary/40 border-[2px] border-secondary/60");

                                // Hide all tabs and show the selected one
                                jQuery(".tab").hide();
                                jQuery("#" + id).show();
                            });
                });

        </script>

        </x-front.layout>
