<x-agency.layout>
   
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
              <div>
            <span class="font-semibold  text-lg text-danger">
            Apl.No
            </span>
         <span class="text-sm italic ">
          {{ $clientData->application_number ?? 'N/A' }} 
            </span>
       </div>
       


       <div>
          <span class="font-semibold  text-lg text-danger"> Contact Information </span>
            <span class="text-sm italic ">
            {{ strtoupper($clientData->clint->client_name ?? 'N/A') }}
        <span class="text-sm italic ">( {{ $clientData->clint->email ?? 'N/A' }} , {{ $clientData->clint->phone_number ?? 'N/A' }}   )</span>
            </span>
      </div>

      <div>
          <span class="font-semibold  text-lg text-danger">
            Visa From
            </span>
            <span class="text-sm italic ">
             {{ $clientData->origin->countryName ?? 'N/A' }}  To  {{ $clientData->destination->countryName ?? 'N/A' }}
            </span>
    </div>




            
        </div>

          



        <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex flex-wrap ">
                    

                <div data-tid="ViewApplicationDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] bg-secondary/40 border-[2px] border-secondary/60 border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-file-alt text-ternary"></i>
                    Payment Receipt
                </div>

                

                @if($clientData->sendtoadmin == 3)  

                    <a href="{{ route('verifyvisa.application', ['id' => $clientData->id, 'type' => 'agency']) }}">
                            <div  class=" w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                                    <i class="fas fa-file-alt"></i>
                                    View Application
                            </div>
                    </a>

                    <a href="{{ route('visa.sendtoadmin', ['id' => $clientData->id]) }}" title="Send to Admin" onclick="return confirm('Are you sure you want to send this application to admin?');">
                                <div  class=" w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                                    <i class="fa fa-paper-plane"></i>
                                    Send to Admin 
                                </div>
                    </a>
                    
                    @elseif($clientData->sendtoadmin == 1)
                    <a href="{{ route('verifyvisa.application', ['id' => $clientData->id, 'type' => 'agency']) }}">
                        <div  class=" w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                        <i class="fas fa-file-alt"></i>
                            View Application
                        </div>
                    </a>
                    

                    @else
                    <a href="{{ route('application.client', ['id' => $clientData->id, 'token' => $clientData->agency->agencytoken]) }}">
                        <div  class=" w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                        <i class="fas fa-file-alt"></i>
                            Fill  Application
                        </div>
                    </a>
                @endif

                
                <div data-tid="uploadeDocumentDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                 <i class="fas fa-arrow-up-from-bracket text-ternary"></i>
                    Upload Document
                </div>

                <div data-tid="sendEmailDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-envelope text-ternary"></i>
                    Send Email
                </div>

                <a href="{{ route('agencychat.client', ['id' => $clientData->client_id, 'token' => $clientData->agency->agencytoken]) }}">
                  <div  class=" w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-comments text-ternary"></i>
                    Conversation
                </div>
               </a>


                @if($clientData->applicationworkin_status !== "Complete")   
                @else
                    <div data-tid="downaloadDocumentDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                        <i class="fas fa-file-download text-ternary"></i>
                                Download Document
                    </div>

                    {{-- <div  data-tid="generateInvoiceDiv" class="agency_tab  w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                        <i class="fas fa-file-alt"></i>
                            Generate Invoice
                    </div> --}}

                    @if($clientData->visaInvoiceStatus->invoice==null)             
                        {{-- <div  data-tid="generateInvoiceDiv" class="agency_tab  w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                        <i class="fas fa-file-alt"></i>
                            Generate Invoice
                        </div> --}}
                @else
                        {{-- <div  data-tid="viewInvoiceDiv" class="agency_tab  w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                        <i class="fas fa-file-alt"></i>
                            View Invoice
                        </div> --}}
               @endif

             
                @if($clientData->visaInvoiceStatus->docsign==null)    
                    @if($clientData->visaInvoiceStatus->invoice!=null)
                        {{-- <a href="{{ route('send.docsign', [
                                    'id'   => $clientData->id,
                                    'type' => $clientData->agency->agencytoken  
                                ]) }}">
                                <div class="w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                                    <i class="fas fa-file-alt"></i>
                                    Doc sign
                                </div>
                            </a> --}}
                    @endif
                    @else
                        <div  data-tid="viewDocSignDiv" class="agency_tab  w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                        <i class="fas fa-file-alt"></i>
                            View Doc sign
                        </div>
                @endif

                {{--
                <a href="{{ route('download.application', ['id' => $clientData->id, 'token' => $clientData->agency->agencytoken]) }}">
                            <div class="w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                                <i class="fas fa-file-alt"></i>
                                Download Application
                            </div>
                        </a>

                        --}}
                @endif
            

                <!-- <div data-tid="formsDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-file-alt text-ternary"></i>
                    Forms
                </div> -->

            @if($clientData->applicationworkin_status !== "Complete")   
              @if($clientData->sendtoadmin == 1) 
                 <!-- <div data-tid="uploadeDocumentDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                 <i class="fas fa-arrow-up-from-bracket text-ternary"></i>
                    Upload Document
                </div> -->

                

                <!-- <div data-tid="visaRequestDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                <i class="fas fa-file-download text-ternary"></i>
                     Download Document
                </div>  -->
             @endif

             

            
             @else           
                  <!-- <div data-tid="uploadDocumentDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                        <i class="fas fa-upload text-ternary"></i>
                        Upload Document
                    </div> -->
                    
            @if($clientData->applicationworkin_status == "Complete")
       
                    <!-- <div data-tid="downaloadDocumentDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                       <i class="fas fa-file-download text-ternary"></i>
                            Download Document
                </div> -->
                @endif
             
            @endif 
            <!-- <div data-tid="sendEmailDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-envelope text-ternary"></i>
                    Send Email
                </div>

                <a href="{{ route('agencychat.client', ['id' => $clientData->client_id, 'token' => $clientData->agency->agencytoken]) }}">
                  <div  class=" w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-comments text-ternary"></i>
                    Conversation
                </div>
               </a> -->

              

        
            

            @if($clientData->applicationworkin_status == "Complete")
            
           @endif
               

              </div>
                <div class="w-full mt-4 ">
            <!-- start joing letter  -->

                <!-- view application  -->
                <div id="ViewApplicationDiv" class="tab ">
                    <x-common.viewapplication :clientData="$clientData" />
  
                </div>

                <!-- end applicatoin  -->

                <div id="uploadeDocumentDiv" class="tab hidden">
                    <x-common.documentupload :booking="$clientData" />             
                </div>

      <!-- end joing letter  -->
                    <div id="downaloadDocumentDiv" class="tab  hidden">
                        <x-common.downloaddocument :booking="$clientData" /> 
                    </div>

            <!-- end joing letter  -->
                <div id="formsDiv" class="tab  hidden">
                     <x-common.forms :clientData="$clientData" :forms="$forms" /> 
                 </div>

                    <!-- icard -->
                    <div id="editApplicationDiv" class="tab hidden">
                        <x-common.editapplication :clientData="$clientData" :forms="$forms" :status="true"  /> 
                    </div>

                      <!-- attendance -->
                      <div id="uploadDocumentDiv" class="tab hidden">
                         <x-common.uploadclient :booking="$clientData" :forms="$forms" /> 
                      </div>

                      
                      <div id="sendEmailDiv" class="tab hidden">
                        <x-common.sendemail :clientData="$clientData" :forms="$forms" />  
                    </div>       

                    <div id="generateInvoiceDiv" class="tab hidden">
                        <x-common.generateinvoice :clientData="$clientData" :forms="$forms" />  
                    </div>    

                    
                    <div id="viewInvoiceDiv" class="tab hidden">
                        <x-common.invoice.visa-invoice :booking="$clientData" :termconditon="$termconditon"  />  
                    </div>    

                    <div id="viewDocSignDiv" class="tab hidden">
                        <x-common.invoice.visa-docSign :booking="$clientData" :document="$clientData->visaInvoiceStatus->docsign"  />  
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


    
    </x-agency.layout>