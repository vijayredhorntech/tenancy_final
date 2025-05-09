<x-client.layout>

@section('title')
       Staff
    @endsection

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
        .profileDiv{
            display:block;
        }
    </style>


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">{{ $client->client_name ?? 'N/A' }}</span>
            <span class="font-semibold text-ternary text-xl">
           

</span>

            <span class="font-semibold text-ternary text-xl"></span>

            
        </div>

        


        <div class="w-full overflow-x-auto p-4">
         

                <div class="w-full mt-4 ">
                   

                    <!-- icard -->
                    <div id="icardDiv" class="tab ">
                         
                
                    <div id="profileDiv" class="tab  ">
                        <div class="w-full border-[1px] border-success/40">
                            <div class="flex bg-success/40 px-4 py-0.5">
                                <span class="font-semibold text-ternary text-xl">Clint Details</span>
                            </div>
                            <div class="w-full p-4 grid lg:grid-cols-3 gap-x-4 gap-y-8 ">
                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-2 pr-12 border-b-[2px] border-b-success">
                                        <span class="font-semibold text-ternary text-lg">Basic Information:</span>
                                    </div>
                                    <div class="flex flex-col mt-4 overflow-x-auto">
                                        <div class="w-full pb-4">
                                      
                                     
                                        </div>
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Client name: </span>
                                            <span class="text-ternary text-medium italic">   {{$client->first_name ?? 'N/A'}} {{$client->last_name ?? ''}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Gender</span>
                                            <span class="text-ternary text-medium italic">{{$client->gender ?? ''}}</span>
                                        </div>

                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Date Of Birth</span>
                                            <span class="text-ternary text-medium italic">{{$client->date_of_birth ?? ''}}</span>
                                        </div>

                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Marital Status</span>
                                            <span class="text-ternary text-medium italic">{{$client->marital_status ?? ''}}</span>
                                        </div>


                                     

                                      


                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary"></span>
                                            <span class="text-ternary text-medium italic"> </span>
                                        </div>
                                      
                                    </div>
                                </div>
                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-2 pr-12 border-b-[2px] border-b-success">
                                        <span class="font-semibold text-ternary text-lg">Contact Information:</span>
                                    </div>
                                    <div class="flex flex-col mt-4 ">
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Email:</span>
                                            <span class="text-ternary text-medium italic">{{$client->email ?? 'N/A'}}</span>
                                        </div>
                               
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Phone:</span>
                                            <span class="text-ternary text-medium italic">{{$client->phone_number ?? 'N/A'}}</span>
                                        </div>
                                    </div>

               

                                    
                                </div>
                            
                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-2 pr-12 border-b-[2px] border-b-success">
                                        <span class="font-semibold text-ternary text-lg">Address Information:</span>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Address:</span>
                                            <span class="text-ternary text-medium italic">{{$client->permanent_address ?? ''}}</span>
                                        </div>

                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Zip Code:</span>
                                            <span class="text-ternary text-medium italic">{{$client->zip_code ?? ''}}</span>
                                        </div>

                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Religion:</span>
                                            <span class="text-ternary text-medium italic">{{$client->clientinfo->religion ?? ''}}</span>
                                        </div>

                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Nationality:</span>
                                            <span class="text-ternary text-medium italic">{{$client->clientinfo->past_nationality ?? ''}}</span>
                                        </div>
                                     
                                     
                                    </div>
                                </div>


                          

                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-2 pr-12 border-b-[2px] border-b-success">
                                        <span class="font-semibold text-ternary text-lg">Passport Details:</span>
                                    </div>
                     
                                    <div class="flex flex-col mt-4">
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Passport Number</span>
                                            <span class="text-ternary text-medium italic">{{$client->clientinfo->passport_ic_number ?? ''}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Place of  Issue</span>
                                            <span class="text-ternary text-medium italic">{{$client->clientinfo->passport_issue_place ?? ''}} </span>
                                        </div>

                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Date of Issue </span>
                                            <span class="text-ternary text-medium italic">{{$client->clientinfo->passport_issue_date ?? ''}} </span>
                                        </div>

                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Date Of Expire</span>
                                            <span class="text-ternary text-medium italic">{{$client->clientinfo->passport_expiry_date ?? ''}}</span>
                                        </div>
                                       
                                    </div>
                                </div>


                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-2 pr-12 border-b-[2px] border-b-success">
                                        <span class="font-semibold text-ternary text-lg">Other:</span>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Father Name</span>
                                            <span class="text-ternary text-medium italic">{{$client->clientinfo->father_details ?? ''}}</span>
                                        </div>

                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Mother Name</span>
                                            <span class="text-ternary text-medium italic">{{$client->clientinfo->mother_details ?? ''}}</span>
                                        </div>

                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Spouse Name</span>
                                            <span class="text-ternary text-medium italic">{{$client->clientinfo->spouse_details ?? ''}}</span>
                                        </div>
                                         
                                    </div>
                                </div>




                            </div>

                        </div>
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

 </x-client.layout>