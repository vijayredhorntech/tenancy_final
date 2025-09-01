<x-client.layout>
   
    @section('title') Visa Application @endsection

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
              <div>
            <span class="font-semibold  text-lg text-danger">
            Apl.No
            </span>
         <span class="text-sm italic ">
          {{ $booking->application_number ?? 'N/A' }} 
            </span>
       </div>
       
       <div>
          <span class="font-semibold  text-lg text-danger"> Contact Information </span>
            <span class="text-sm italic ">
            {{ strtoupper($booking->clint->client_name ?? 'N/A') }}
        <span class="text-sm italic ">( {{ $booking->clint->email ?? 'N/A' }} , {{ $booking->clint->phone_number ?? 'N/A' }}   )</span>
            </span>
      </div>

      <div>
          <span class="font-semibold  text-lg text-danger">
            Visa From
            </span>
            <span class="text-sm italic ">
             {{ $booking->origin->countryName ?? 'N/A' }}  To  {{ $booking->destination->countryName ?? 'N/A' }}
            </span>
    </div>
        </div>

        <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex flex-wrap ">
                    
                <div data-tid="ViewApplicationDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-file-alt text-ternary"></i>
                    Payment Receipt
                </div>

                <div data-tid="viewApplicationDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] bg-secondary/40 border-[2px] border-secondary/60 border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                    <i class="fas fa-file-alt text-ternary"></i>
                    View Application
                </div>


                <div data-tid="uploadeDocumentDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                 <i class="fas fa-arrow-up-from-bracket text-ternary"></i>
                    Upload Document
                </div>

                
                @if($booking->applicationworkin_status !== "Complete")   
                @else
                    <div data-tid="downaloadDocumentDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                        <i class="fas fa-file-download text-ternary"></i>
                                Download Document
                    </div>

                    @if($booking->visaInvoiceStatus->invoice==null)             
                        <!-- Invoice not generated yet -->
                @else
                        <!-- Invoice exists -->
               @endif

             
                @if($booking->visaInvoiceStatus->docsign==null)    
                    @if($booking->visaInvoiceStatus->invoice!=null)
                        <!-- Doc sign not sent yet -->
                    @endif
                    @else
                        <div  data-tid="viewDocSignDiv" class="agency_tab  w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer flex items-center gap-2">
                        <i class="fas fa-file-alt"></i>
                            View Doc sign
                        </div>
                @endif
                @endif
              </div>

                <div class="w-full mt-4 ">
                <!-- Payment Receipt -->
                <div id="ViewApplicationDiv" class="tab hidden">
                    <x-common.viewapplication :clientData="$booking" />
                </div>

                                 <!-- View Application -->
                 <div id="viewApplicationDiv" class="tab">
                     @if($booking->destination->countryName == 'China')
                         @include('components.application.chinaviewapplication', ['bookingData' => $booking,'type'=>'client'])
                     @elseif($booking->visa->name == 'Schengen Visa')
                         @include('components.application.Scheneganviewapplication', ['bookingData' => $booking,'type'=>'client'])
                     @else
                         @include('components.application.viewapplication', ['bookingData' => $booking,'type'=>'client'])
                     @endif
                 </div>

             
                <!-- Upload Document -->
                <div id="uploadeDocumentDiv" class="tab hidden">
                    <x-common.documentupload :booking="$booking" />             
                </div>

                <!-- Conversation -->
                <div id="conversationDiv" class="tab hidden">
                    @php
                        $messages = \App\Models\Message::where('client_id', $booking->client_id)->get();
                    @endphp
                    @include('clients.conversation', ['client_data' => $booking->clint, 'agency' => $booking->agency, 'messages' => $messages, 'booking' => $booking])
                </div>

                <!-- Download Document -->
                <div id="downaloadDocumentDiv" class="tab  hidden">
                    <x-common.downloaddocument :booking="$booking" /> 
                </div>

                <!-- Forms -->
                <div id="formsDiv" class="tab  hidden">
                     <x-common.forms :clientData="$booking" :forms="$forms" /> 
                 </div>

                <!-- Edit Application -->
                <div id="editApplicationDiv" class="tab hidden">
                    <x-common.editapplication :clientData="$booking" :forms="$forms" :status="true"  /> 
                </div>

                <!-- Upload Client Document -->
                <div id="uploadDocumentDiv" class="tab hidden">
                     <x-common.uploadclient :booking="$booking" :forms="$forms" /> 
                </div>

                <!-- Send Email -->
                <div id="sendEmailDiv" class="tab hidden">
                    <x-common.sendemail :clientData="$booking" :forms="$forms" />  
                </div>

                <!-- Visa Updation Log Data -->
                <div id="VisaupdationlogDataDiv" class="tab  hidden">
                    <x-common.invoice.VisaApplicationlog :logs="$booking->visaapplicationlog->sortByDesc('created_at')" /> 
                </div>       

                <!-- Generate Invoice -->
                <div id="generateInvoiceDiv" class="tab hidden">
                    <x-common.generateinvoice :clientData="$booking" :forms="$forms" />  
                </div>    

                <!-- View Invoice -->
                <div id="viewInvoiceDiv" class="tab hidden">
                    <x-common.invoice.visa-invoice :booking="$booking" :termconditon="$termconditon"  />  
                </div>    

                <!-- View Doc Sign -->
                <div id="viewDocSignDiv" class="tab hidden">
                    <x-common.invoice.visa-docSign :booking="$booking" :document="$booking->visaInvoiceStatus->docsign"  />  
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
        <script>
    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('textarea.auto-expand').forEach(textarea => {
            autoResize(textarea); // Resize on load
            textarea.addEventListener('input', () => autoResize(textarea)); // Resize on input
        });
    });
</script>

    </x-client.layout>
