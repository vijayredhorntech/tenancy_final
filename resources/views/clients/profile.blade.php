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

        <div class="bg-gradient-to-r from-primary/20 to-secondary/20 px-6 py-4 border-b-[2px] border-b-primary/30">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-primary/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-2xl text-primary"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-2xl text-ternary">{{ $client->client_name ?? 'N/A' }}</h1>
                        <p class="text-ternary/70 text-sm">Client Profile</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-sm text-ternary/60">Client ID</div>
                    <div class="font-mono text-lg font-bold text-primary">{{ $client->id ?? 'N/A' }}</div>
                </div>
            </div>
        </div>

        


        <div class="w-full overflow-x-auto p-4">
         

                <div class="w-full mt-4 ">
                   

                    <!-- icard -->
                    <div id="icardDiv" class="tab ">
                         
                
                    <div id="profileDiv" class="tab  ">
                        <div class="w-full border-[1px] border-success/40 rounded-lg overflow-hidden">
                            <div class="flex bg-gradient-to-r from-success/50 to-success/30 px-6 py-3">
                                <i class="fas fa-user-circle text-success mr-3 text-xl"></i>
                                <span class="font-bold text-ternary text-xl">Client Details</span>
                            </div>
                            <div class="w-full p-6 grid lg:grid-cols-3 gap-x-6 gap-y-8 bg-white">
                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-3 pr-12 border-b-[2px] border-b-success">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-info-circle text-success text-lg"></i>
                                            <span class="font-bold text-ternary text-lg">Basic Information</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col mt-4 overflow-x-auto">
                                        <div class="w-full pb-4">
                                      
                                     
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Client Name:</span>
                                            <span class="text-ternary text-medium font-medium">{{$client->first_name ?? 'N/A'}} {{$client->last_name ?? ''}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Gender:</span>
                                            <span class="text-ternary text-medium font-medium">{{$client->gender ?? 'N/A'}}</span>
                                        </div>

                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Date of Birth:</span>
                                            <span class="text-ternary text-medium font-medium">{{$client->date_of_birth ?? 'N/A'}}</span>
                                        </div>

                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Marital Status:</span>
                                            <span class="text-ternary text-medium font-medium">{{$client->marital_status ?? 'N/A'}}</span>
                                        </div>


                                     

                                      


                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary"></span>
                                            <span class="text-ternary text-medium italic"> </span>
                                        </div>
                                      
                                    </div>
                                </div>
                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-3 pr-12 border-b-[2px] border-b-success">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-phone text-success text-lg"></i>
                                            <span class="font-bold text-ternary text-lg">Contact Information</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col mt-4 ">
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Email:</span>
                                            <span class="text-ternary text-medium font-medium">{{$client->email ?? 'N/A'}}</span>
                                        </div>
                               
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Phone:</span>
                                            <span class="text-ternary text-medium font-medium">{{$client->phone_number ?? 'N/A'}}</span>
                                        </div>
                                    </div>

               

                                    
                                </div>
                            
                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-3 pr-12 border-b-[2px] border-b-success">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-map-marker-alt text-success text-lg"></i>
                                            <span class="font-bold text-ternary text-lg">Address Information</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Address:</span>
                                            <span class="text-ternary text-medium font-medium">{{$client->permanent_address ?? 'N/A'}}</span>
                                        </div>

                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Zip Code:</span>
                                            <span class="text-ternary text-medium font-medium">{{$client->zip_code ?? 'N/A'}}</span>
                                        </div>

                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Religion:</span>
                                            <span class="text-ternary text-medium font-medium">{{$client->clientinfo->religion ?? 'N/A'}}</span>
                                        </div>

                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Nationality:</span>
                                            <span class="text-ternary text-medium font-medium">{{$client->clientinfo->past_nationality ?? 'N/A'}}</span>
                                        </div>
                                     
                                     
                                    </div>
                                </div>


                          

                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-3 pr-12 border-b-[2px] border-b-success">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-passport text-success text-lg"></i>
                                            <span class="font-bold text-ternary text-lg">Passport Details</span>
                                        </div>
                                    </div>
                     
                                    <div class="flex flex-col mt-4">
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Passport Number:</span>
                                            <span class="text-ternary text-medium font-medium">{{$client->clientinfo->passport_ic_number ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Place of Issue:</span>
                                            <span class="text-ternary text-medium font-medium">{{$client->clientinfo->passport_issue_place ?? 'N/A'}}</span>
                                        </div>

                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Date of Issue:</span>
                                            <span class="text-ternary text-medium font-medium">{{$client->clientinfo->passport_issue_date ?? 'N/A'}}</span>
                                        </div>

                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Date of Expiry:</span>
                                            <span class="text-ternary text-medium font-medium">{{$client->clientinfo->passport_expiry_date ?? 'N/A'}}</span>
                                        </div>
                                       
                                    </div>
                                </div>


                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-3 pr-12 border-b-[2px] border-b-success">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-users text-success text-lg"></i>
                                            <span class="font-bold text-ternary text-lg">Family Details</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        @php
                                            $fatherDetails = $client->clientinfo->father_details ? json_decode($client->clientinfo->father_details, true) : null;
                                            $motherDetails = $client->clientinfo->mother_details ? json_decode($client->clientinfo->mother_details, true) : null;
                                            $spouseDetails = $client->clientinfo->spouse_details ? json_decode($client->clientinfo->spouse_details, true) : null;
                                        @endphp
                                        
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Father Name:</span>
                                            <span class="text-ternary text-medium font-medium">{{ $fatherDetails['name'] ?? 'N/A' }}</span>
                                        </div>
                                        @if($fatherDetails && isset($fatherDetails['nationality']))
                                        <div class="flex items-center py-1 px-3 ml-[150px] bg-blue-50 rounded-lg mb-2">
                                            <span class="text-ternary text-sm font-medium text-blue-700">Nationality: {{ $fatherDetails['nationality'] ?? 'N/A' }}</span>
                                        </div>
                                        @endif

                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Mother Name:</span>
                                            <span class="text-ternary text-medium font-medium">{{ $motherDetails['name'] ?? 'N/A' }}</span>
                                        </div>
                                        @if($motherDetails && isset($motherDetails['nationality']))
                                        <div class="flex items-center py-1 px-3 ml-[150px] bg-blue-50 rounded-lg mb-2">
                                            <span class="text-ternary text-sm font-medium text-blue-700">Nationality: {{ $motherDetails['nationality'] ?? 'N/A' }}</span>
                                        </div>
                                        @endif

                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg mb-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Spouse Name:</span>
                                            <span class="text-ternary text-medium font-medium">{{ $spouseDetails['name'] ?? 'N/A' }}</span>
                                        </div>
                                        @if($spouseDetails && isset($spouseDetails['nationality']))
                                        <div class="flex items-center py-1 px-3 ml-[150px] bg-blue-50 rounded-lg mb-2">
                                            <span class="text-ternary text-sm font-medium text-blue-700">Nationality: {{ $spouseDetails['nationality'] ?? 'N/A' }}</span>
                                        </div>
                                        @endif
                                         
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