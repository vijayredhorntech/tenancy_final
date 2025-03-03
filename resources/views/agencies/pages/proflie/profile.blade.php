<x-agency.layout>
    @section('title')
        Agency
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
    </style>


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">{{ $user->name ?? 'N/A' }}</span>
            <span class="font-semibold text-ternary text-xl">
                {{ $user->status ?? 'N/A' }} 
                @if (!empty($login_time) && $user->status == 'online')
                <i class="fa fa-clock font-semibold text-ternary text-xl"></i> Logged in  {{ \Carbon\Carbon::createFromFormat('H:i:s',  $login_time)->format('h:i:s A') }} 
            @endif

</span>

            <span class="font-semibold text-ternary text-xl"></span>

            
        </div>

        


        <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex flex-wrap ">

                <div data-tid ="profileDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] bg-secondary/40 border-[2px] border-secondary/60 border-ternary/60   text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer   ">
                        Profile
                    </div>

         
                    <!-- <div data-tid ="bookingDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer ">
                       
                    </div> -->

                    <div data-tid ="icardDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60   text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer   ">
                       ICard
                    </div>

                    <div data-tid ="attendanceDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60   text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer   ">
                       Attendance
                    </div>

                    <div data-tid ="documentDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60   text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer   ">
                       Document
                    </div>
                


                </div>

                <div class="w-full mt-4 ">
             

                    <!-- icard -->
                    <div id="icardDiv" class="tab hidden">
                         
                    <div class="card">
                            <div class="background-pattern"></div>
                            <div class="header">
                                <div class="headerTitle">
                                    {{$agency_data->name}}
                             
                                </div>
                                <div class="logo">
                              
                                <img src="{{ asset($agency_data->profile_picture ? 'images/agencies/logo/' . $agency_data->profile_picture : 'assets/images/logo.png') }}" 
                        alt="{{$agency_data->name}}" class="h-24 mr-4" />

                                </div>
                                
                            </div>
                            <div class="content">
                                <div class="photo">
                                @if(isset($user->profile))
                                <img src="{{ asset($user->type == 'staff' ? 'images/user/agency/profile/' . $user->profile : 'images/agencies/logo/' . $user->profile) }}" 
                                onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.png') }}';"
                                class="h-24 mr-4" 
                                alt="{{$agency_data->name}}">
                                         {{--   <img src="{{ asset('images/user/profile/' . $user->profile) }}" alt="Cloud Travel"  class="h-24 mr-4" />--}}
                                        @else
                                        <img src="{{asset('assets/images/profile_photo.jpg')}}" class="h-40 rounded-md w-auto " alt="">
                                        @endif
                                  
                                </div>
                                <div class="details">
                                    <div class="field">
                                        <span class="field-label">Name:</span>
                                        {{ $user->name ?? 'N/A' }}
                                    </div>
                                    <div class="field">
                                        <span class="field-label">Joining Date:</span>
                                        {{ $user->created_at ? $user->created_at->format('d-m-Y') : 'N/A' }}
                                    </div>
                                    <div class="field">
                                        <span class="field-label">Department:</span>
                                        Customer Service
                                    </div>
                                    <div class="field">
                                        <span class="field-label">Phone Number</span>
                                        {{$user->userdetails->phone_number ?? 'N/A'}}
                                    </div>
                                    <div class="id-number">
                                        EMP- {{ $user->id ?? 'N/A' }}
                                    </div>
                                 
                                </div>
                            </div>
                        </div>

                        
                        <div class="flex w-[772px] justify-center mt-16">
                                <button id="printInvoice" class="bg-secondary text-white text-sm px-2 py-1 rounded-sm"  onclick="
                                var printContents = document.getElementById('icardDiv').innerHTML;
                                var originalContents = document.body.innerHTML;

                                document.body.innerHTML = printContents;
                                window.print();
                                document.body.innerHTML = originalContents;
                                " >
                                    Print Icard
                                </button>
                            </div>

                      </div>

                   

                      <!-- attendance -->
                      <div id="attendanceDiv" class="tab hidden">
                      
                      <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">              
                            <tr>
                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Date</td>
                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Login Time</td>
                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Logout Time</td>
                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Status</td>
                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Working Hours</td>
                            </tr>

                            @forelse($user->attendance as $attendance)
                                    <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000">
                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $loop->iteration }}</td>
                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $attendance->date }}</td>
                                        
                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                            {{ $attendance->login_time ? \Carbon\Carbon::createFromFormat('H:i:s', $attendance->login_time)->format('h:i:s A') : 'N/A' }}
                                        </td>
                                        
                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                            {{ $attendance->logout_time ? \Carbon\Carbon::createFromFormat('H:i:s', $attendance->logout_time)->format('h:i:s A') : 'N/A' }}
                                        </td>

                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $attendance->attendance_status }}</td>
                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $attendance->work_hours ?? '0:00:00' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-2 text-gray-500">No attendance records found.</td>
                                    </tr>
                                @endforelse

                        </table>

                      </div>

                      <div id="documentDiv" class="tab hidden">
                            @if($user->type !== "staff")
                                <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">
                                    <tr>
                                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Document Name</td>
                                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Images</td>
                                    </tr>

                                    @php
                                        $documents = json_decode($agency_data->details->agency_document ?? '[]', true);
                                    @endphp

                                    @forelse($documents as $document)
                                        <tr class="{{ $loop->even ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-200">
                                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $loop->iteration }}</td>
                                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $document['name'] ?? 'N/A' }}</td>
                                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                                @if(!empty($document['file']))
                                                    <a href="{{ asset('images/agencies/documents/' . $document['file']) }}" target="_blank" class="text-blue-500 underline">
                                                        View File
                                                    </a>
                                                @else
                                                    No File Available
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm text-center">
                                                No Record Found
                                            </td>
                                        </tr>
                                    @endforelse
                                </table>
                            @endif
                        </div>

                    <div id="profileDiv" class="tab  ">
                        <div class="w-full border-[1px] border-success/40">
                            <div class="flex bg-success/40 px-4 py-0.5">
                                <span class="font-semibold text-ternary text-xl">Staff Details</span>
                            </div>
                            <div class="w-full p-4 grid lg:grid-cols-3 gap-x-4 gap-y-8 ">
                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-2 pr-12 border-b-[2px] border-b-success">
                                        <span class="font-semibold text-ternary text-lg">Basic Information:</span>
                                    </div>
                                    <div class="flex flex-col mt-4 overflow-x-auto">
                                        <div class="w-full pb-4">
                                      

                                        @if(isset($user->profile))
                                            <img src="{{ asset($user->type == 'staff' ? 'images/user/agency/profile/' . $user->profile : 'images/agencies/logo/' . $user->profile) }}" 
                                            onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.png') }}';"
                                            class="h-24 mr-4" 
                                            alt="{{$agency_data->name}}">
                                                    {{--   <img src="{{ asset('images/user/profile/' . $user->profile) }}" alt="Cloud Travel"  class="h-24 mr-4" />--}}
                                                    @else
                                                    <img src="{{asset('assets/images/profile_photo.jpg')}}" class="h-40 rounded-md w-auto " alt="">
                                        @endif
                                       
                                           
                                        </div>
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">User name: </span>
                                            <span class="text-ternary text-medium italic">   {{$user->name ?? 'N/A'}}</span>
                                        </div>

                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Employee Id</span>
                                            <span class="text-ternary text-medium italic">EMP-{{$user->id ?? 'N/A'}}</span>
                                        </div>

                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Role </span>
                                            <span class="text-ternary text-medium italic"></span>
                                        </div>

                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Department </span>
                                            <span class="text-ternary text-medium italic"></span>
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
                                            <span class="text-ternary text-medium italic">{{$user->email ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Telephone: </span>
                                            <span class="text-ternary text-medium italic">01780-200705 </span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Phone:</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->phone_number ?? 'N/A'}}</span>
                                        </div>
                                    </div>

                                    <!-- <div class="pb-2 pr-12 border-b-[2px] border-b-success mt-8">
                                        <span class="font-semibold text-ternary text-lg">Address :</span>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Address</span>
                                            <span class="text-ternary text-medium italic"> </span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Database: </span>
                                            <span class="text-ternary text-medium italic"> </span>
                                        </div>

                                    </div>  -->

                                    
                                </div>
                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-2 pr-12 border-b-[2px] border-b-success">
                                        <span class="font-semibold text-ternary text-lg">Address Information:</span>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Address:</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->address ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">City: </span>
                                            <span class="text-ternary text-medium italic"> </span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">State:</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->state ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Country:</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->country ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Zip Code:</span>
                                            <span class="text-ternary text-medium italic"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-2 pr-12 border-b-[2px] border-b-success">
                                        <span class="font-semibold text-ternary text-lg">Bank Details:</span>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <div class="flex ">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Account Number</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->account_number ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Short Code </span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->short_code ?? 'N/A'}} </span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Bank Name</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->bank_name ?? 'N/A'}}</span>
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
                                            <span class="text-ternary text-medium italic">{{$user->passport->passport_number ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Place of  Issue</span>
                                            <span class="text-ternary text-medium italic">{{$user->passport->place_of_issue ?? 'N/A'}} </span>
                                        </div>

                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Date of Issue </span>
                                            <span class="text-ternary text-medium italic">{{$user->passport->date_of_issue ?? 'N/A'}} </span>
                                        </div>

                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Date Of Expire</span>
                                            <span class="text-ternary text-medium italic">{{$user->passport->passport_expire_date ?? 'N/A'}}</span>
                                        </div>
                                       
                                    </div>
                                </div>


                                <div class="w-full flex flex-col overflow-x-auto">
                                    <div class="pb-2 pr-12 border-b-[2px] border-b-success">
                                        <span class="font-semibold text-ternary text-lg">Other:</span>
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Emergency Person name</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->emergency_person_name ?? 'N/A'}}</span>
                                        </div>

                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Emergency Person number</span>
                                            <span class="text-ternary text-medium italic">{{$user->userdetails->emergency_contact_number ?? 'N/A'}}</span>
                                        </div>
                                        
                                        <div class="flex mt-2">
                                            <span class="w-[150px] font-semibold text-md text-ternary">Date of Joinng</span>
                                            <span class="text-ternary text-medium italic">{{ $user->created_at ? $user->created_at->format('d-m-Y') : 'N/A' }}</span>
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

</x-agency.layout>
