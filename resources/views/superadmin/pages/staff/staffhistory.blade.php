<x-front.layout>
    @section('title')
        Staff History
    @endsection

    <style> 
              .card {
            width: 600px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            position: relative;
            border: 2px solid #26ace2;
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
        
        @media print {
            body * {
                visibility: hidden;
            }
            .card, .card * {
                visibility: visible;
            }
            .card {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                width: 400px;
                height: auto;
                margin: 0;
                box-shadow: none;
                border: 2px solid #26ace2;
            }
            .card .header {
                background: #26ace2 !important;
            }
            .card .content {
                padding: 20px;
            }
            .card .photo img {
                width: 120px;
                height: 150px;
                object-fit: cover;
            }
            .card .details .field {
                margin-bottom: 10px;
                font-size: 14px;
            }
            .card .id-number {
                font-size: 16px;
                font-weight: bold;
                color: #26ace2;
                margin-top: 15px;
            }
        }
    </style>


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">{{ $user->name ?? 'N/A' }}</span>
            <span class="font-semibold text-ternary text-xl">
                {{ $user->status ?? 'N/A' }} 
                @if (!empty($login_time) && $user->status == 'online')
                <i class="fa fa-clock font-semibold text-ternary text-xl"></i> Logged in {{ \Carbon\Carbon::createFromFormat('H:i:s',  $login_time)->format('h:i:s A') }}
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
                    <div data-tid ="documentsDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px]  border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer ">
                        Documents
                    </div>

                    <div data-tid ="deductionsDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px]  border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer ">
                    Deductions
                    </div>

                    <div data-tid ="joiningLettersDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px]  border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer ">
                        Joining Letter 
                    </div>

                    <div data-tid ="officialsDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px]  border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer ">
                        Official Document
                    </div>

                    <div data-tid ="fundsDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px]  border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer ">
                        Logs
                    </div>


                </div>

                <div class="w-full mt-4 ">
            <!-- start joing letter  -->

            <div id="joiningLettersDiv" class="tab hidden">
                <div class="w-full grid xl:grid-cols-1 lg:grid-cols-1 gap-4">
                    <div class="w-full">
                        <div class="border-2 border-primary/70">
                            <div class="flex justify-center bg-primary/40 px-4 py-0.5">
                                <span class="font-semibold text-ternary text-xl">Joining Letter</span>
                            </div>
                            <div class="mt-2 overflow-x-auto px-4 py-0.5">
                                <!-- <div class="container">
                                    <div class="card">
                                        <div class="card-body"> -->
                                            <!-- <h2 class="text-center text-2xl font-bold mb-4">Joining Letter</h2> -->
                                            <p>Date: {{ $user->created_at ? $user->created_at->format('d M Y') : 'N/A' }}
                                            </p>
                                            <p>To,</p>
                                            <p><strong>{{ $user->name ?? 'N/A' }}</strong></p>
                                            <p><strong></strong></p>
                                            <p><strong></strong></p>
                                            <p>Dear {{ $user->name ?? 'N/A' }},</p>
                                            <p>We are pleased to inform you that you have been selected for the position of <strong>{{ $user->designation ?? 'N/A' }}</strong> in our organization, effective from <strong>{{ $user->created_at ? $user->created_at->format('d M Y') : 'N/A' }}
                                            </strong>.</p>
                                            <p>You will be reporting to <strong>{{ $user->reporting_manager ?? 'N/A' }}</strong> at <strong>{{ $user->office_location ?? 'N/A' }}</strong>.</p>
                                            <p>We welcome you to our team and look forward to your valuable contributions.</p>
                                            <p>Sincerely,</p>
                                            <p><strong>Cloud</strong></p>
                                            
                                            <p class="text-sm">62 KING STREET,</p>
                                            <p class="text-sm">SOUTHALL,</p>
                                            <p class="text-sm">MIDDLESEX,</p>
                                            <p class="text-sm">UB2 4DB</p>
                                            <p class="text-sm"><strong>TEL:</strong> 02035000000</p>
                                            <p class="text-sm"><strong>E-MAIL:</strong> info@cloudtravels.co.uk</p>
                                            
                                        <!-- </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-4">
                    <button id="printJoiningLetter" class="bg-success text-white text-sm px-6 py-2 rounded-md hover:bg-success/80 transition ease-in duration-200" onclick="printJoiningLetter()">
                        <i class="fas fa-print mr-2"></i>Print Joining Letter
                    </button>
                </div>
            </div>

      <!-- end joing letter  -->
                    <div id="officialsDiv" class="tab  hidden">
                        <div class="w-full grid xl:grid-cols-1 lg:grid-cols-1 gap-4">
                            <div class="w-full ">
                                <div class="  border-[2px] border-primary/70 ">
                                    <div class="flex justify-center bg-primary/40 px-4 py-0.5">
                                        <span class="font-semibold text-ternary text-xl">Salary Slip</span>
                                    </div>
                                    <div class="mt-2 overflow-x-auto px-4 py-0.5">
                                        <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">
                                                <tr>
                                                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Month</td>
                                                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Generate Date </td>
                                                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                                                </tr>


                                                @forelse($user->salaryshilp as $shilp)
                                                    
                                                    <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-200">
                                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                                            {{ $loop->iteration }}
                                                        </td>

                                                        {{-- Display month name and year (e.g., "February 2025") --}}
                                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                                                {{ $shilp->start_date ? \Carbon\Carbon::parse($shilp->start_date)->format('F Y') : 'N/A' }}
                                                            </td>

                                                        {{-- Display created_at in "28 Feb, 2025" format --}}
                                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                                            {{ optional($shilp->created_at)->format('d M, Y') ?? 'N/A' }}
                                                        </td>

                                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                                            {{-- Placeholder if this column is empty --}}
                                                            --
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm text-center">
                                                            No Record Found
                                                        </td>
                                                    </tr>
                                                @endforelse



                                        </table>
                                   </div>
                                </div>
                            </div>
                         
                        </div>
                    </div>





            <!-- end joing letter  -->
           


                <div id="fundsDiv" class="tab  hidden">
                        <div class="w-full grid xl:grid-cols-1 lg:grid-cols-1 gap-4">
                            <div class="w-full ">
                                <div class="  border-[2px] border-primary/70 ">
                                    <div class="flex justify-center bg-primary/40 px-4 py-0.5">
                                        <span class="font-semibold text-ternary text-xl">Logs</span>
                                    </div>
                                    <div class="mt-2 overflow-x-auto px-4 py-0.5">
                                        <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">
                                            <tr>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">User Name</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Url </td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Date</td>
                                        


                                            </tr>



                                            @forelse($user->log as $log)

                                                <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{ $user->name ?? 'N/A' }}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$log->url ?? 'N/A'}}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$log->created_at ?? 'N/A'}}</td>
                                              

                                                </tr>


                                            @empty
                                                <tr>
                                                    <td colspan="8" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm text-center">No Record Found</td>
                                                </tr>
                                            @endforelse


                                        </table>
                                    </div>
                                </div>
                            </div>
                         
                        </div>
                    </div>

                    <!-- icard -->
                    <div id="icardDiv" class="tab hidden">
                        <div class="w-full flex justify-center">
                            <div class="card">
                                <div class="background-pattern"></div>
                                <div class="header">
                                    <div class="headerTitle">
                                        Cloud Travel
                                    </div>
                                    <div class="logo">
                                        <img src="{{ asset('assets/images/logo.png') }}" alt="Cloud Travel" class="h-24 mr-4" />
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="photo">
                                        @if(isset($user->profile))
                                            <img src="{{ asset('images/user/profile/' . $user->profile) }}" alt="Cloud Travel" class="h-24 mr-4" />
                                        @else
                                            <img src="{{asset('assets/images/profile_photo.jpg')}}" class="h-40 rounded-md w-auto" alt="">
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
                                            {{$user->userdetails->department ?? 'N/A'}}
                                        </div>
                                        <div class="field">
                                            <span class="field-label">Phone Number:</span>
                                            {{$user->userdetails->phone_number ?? 'N/A'}}
                                        </div>
                                        <div class="id-number">
                                            EMP- {{ $user->id ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex w-full justify-center mt-8">
                            <button id="printIcard" class="bg-secondary text-white text-sm px-6 py-2 rounded-md hover:bg-secondary/80 transition ease-in duration-200" onclick="printIcard()">
                                <i class="fas fa-print mr-2"></i>Print I-Card
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

                      
                      <div id="documentsDiv" class="tab hidden">
                      <div class="w-full grid xl:grid-cols-1 lg:grid-cols-1 gap-4">
                            <div class="w-full ">
                                <div class="  border-[2px] border-primary/70 ">
                                    <div class="flex justify-center bg-primary/40 px-4 py-0.5">
                                        <span class="font-semibold text-ternary text-xl">Passport</span>
                                    </div>
                                    <div class="mt-2 overflow-x-auto px-4 py-0.5">
                                    </div>
                                </div>
                            </div>

                            <div class="w-full ">
                                <div class="  border-[2px] border-primary/70 ">
                                    <div class="flex justify-center bg-primary/40 px-4 py-0.5">
                                        <span class="font-semibold text-ternary text-xl">Education document</span>
                                    </div>
                                    <div class="mt-2 overflow-x-auto px-4 py-0.5">
                                    <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">              
                                    <tr>
                                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Class</td>
                                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Marksheet</td>
                                    </tr>

                                        @php
                                      
                                        $educations = $user->userdetails->education ? json_decode($user->userdetails->education, true) : [];
                                        @endphp
                                        @forelse($educations as $education)
                                            <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000">
                                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $loop->iteration }}</td>
                                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $education['name'] }}</td>
                                                
                                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                                <a href="{{ asset('images/user/marksheets/' . $education['file']) }}" target="_blank" class="text-blue-500 underline">
                                                                            View File
                                                                            </a>
                                                </td>
                                                
                                                </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-2 text-gray-500">No attendance records found.</td>
                                            </tr>
                                        @endforelse
                            </table>

                                    </div>
                                </div>
                            </div>


                            <div class="w-full ">
                                <div class="  border-[2px] border-danger/70 ">
                                    <div class="flex justify-center bg-danger/40 px-4 py-0.5">
                                        <span class="font-semibold text-ternary text-xl">Other Document</span>
                                    </div>
                            <div class="mt-2 overflow-x-auto px-4 py-0.5">
                               <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">              
                                    <tr>
                                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Name</td>
                                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Images</td>
                                    </tr>

                                        @php
                                        $documents = $user->passport->other_doc_details ? json_decode($user->passport->other_doc_details, true) : [];
                                        @endphp
                                        @forelse($documents as $document)
                                            <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000">
                                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $loop->iteration }}</td>
                                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $document['name'] }}</td>
                                                
                                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                                <a href="{{ asset('images/user/documents/' . $document['file']) }}" target="_blank" class="text-blue-500 underline">
                                                                            View File
                                                                            </a>
                                                </td>
                                                
                                                </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-2 text-gray-500">No attendance records found.</td>
                                            </tr>
                                        @endforelse
                            </table>
                           </div>
                                </div>
                            </div>
                        </div>
                    </div>



                      <div id="deductionsDiv" class="tab hidden">
                        <div class="w-full grid xl:grid-cols-1 lg:grid-cols-1 gap-4">
                                <div class="w-full ">
                                    <div class="  border-[2px] border-primary/70 ">
                                        <div class="flex justify-center bg-primary/40 px-4 py-0.5">
                                            <span class="font-semibold text-ternary text-xl"> Deduction </span>
                                        </div>
                                        <div class="mt-2 overflow-x-auto px-4 py-0.5">
                                            <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">              
                                                            <tr>
                                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Category</td>
                                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Value</td>
                                                            </tr>

                                                            @php
                                                                $deduction = $user->userdeduction; // Assuming it's a single object
                                                                $other_data = json_decode($deduction->other ?? '{}', true); // Decode JSON safely
                                                                $index = 1;
                                                            @endphp

                                                            
                                                            <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">              
                                                            <tr>
                                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Category</td>
                                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Value</td>
                                                            </tr>

                                                            @if ($deduction)
                                                                {{-- Display Direct Properties --}}
                                                                @foreach (['accommodation', 'cab', 'food'] as $key)
                                                                    <tr class="{{ $index % 2 === 0 ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-200">
                                                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $index++ }}</td>
                                                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ ucfirst($key) }}</td>
                                                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">{{ $deduction->$key }}</td>
                                                                    </tr>
                                                                @endforeach

                                                                {{-- Display JSON "other" Properties --}}
                                                                @foreach ($other_data as $sub_key => $sub_value)
                                                                    <tr class="{{ $index % 2 === 0 ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-200">
                                                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $index++ }}</td>
                                                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ ucfirst($sub_key) }}</td>
                                                                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">{{ $sub_value }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="3" class="text-center py-2 text-gray-500">No deduction data found.</td>
                                                                </tr>
                                                            @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <div class="w-full ">
                                <div class="  border-[2px] border-danger/70 ">
                                    <div class="flex justify-center bg-danger/40 px-4 py-0.5">
                                        <span class="font-semibold text-ternary text-xl">Taxes</span>
                                    </div>
                                    <div class="mt-2 overflow-x-auto px-4 py-0.5">
                                        <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">              
                                                <tr>
                                                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Name</td>
                                                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Images</td>
                                                </tr>

                                                    @php
                                                    $documents = $user->passport->other_doc_details ? json_decode($user->passport->other_doc_details, true) : [];
                                                    @endphp
                                                    @forelse($documents as $document)
                                                        <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000">
                                                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $loop->iteration }}</td>
                                                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $document['name'] }}</td>
                                                            
                                                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                                            <a href="{{ asset('images/user/documents/' . $document['file']) }}" target="_blank" class="text-blue-500 underline">
                                                                                        View File
                                                                                        </a>
                                                            </td>
                                                            
                                                            </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center py-2 text-gray-500">No attendance records found.</td>
                                                        </tr>
                                                    @endforelse
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>





                    <div id="bookingDiv" class="tab hidden">
                      
                     </div>
                    <div id="profileDiv" class="tab">
                        <div class="w-full border-[1px] border-primary/20 bg-white rounded-lg shadow-sm">
                            <div class="flex bg-primary/10 px-6 py-3 border-b border-primary/20">
                                <span class="font-semibold text-ternary text-xl flex items-center">
                                    <i class="fas fa-user-circle mr-2 text-primary"></i>
                                    Staff Details
                                </span>
                            </div>
                            <div class="w-full p-6 grid lg:grid-cols-3 gap-6">
                                <div class="w-full flex flex-col">
                                    <div class="pb-3 border-b-2 border-primary/30 mb-4">
                                        <span class="font-semibold text-ternary text-lg flex items-center">
                                            <i class="fas fa-info-circle mr-2 text-primary"></i>
                                            Basic Information
                                        </span>
                                    </div>
                                    <div class="flex flex-col space-y-4">
                                        <div class="w-full pb-4">
                                            @if(isset($user->profile))
                                                <img src="{{ asset($user->type == 'staff' ? 'images/user/agency/profile/' . $user->profile : 'images/agencies/logo/' . $user->profile) }}" 
                                                onerror="this.onerror=null; this.src='{{ asset('assets/images/profile_photo.jpg') }}';"
                                                class="w-full h-48 object-contain bg-gray-100 rounded-lg" 
                                                alt="{{$user->name}}">
                                            @else
                                                <img src="{{asset('assets/images/profile_photo.jpg')}}" class="w-full h-48 object-contain bg-gray-100 rounded-lg" alt="">
                                            @endif
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">User Name:</span>
                                            <span class="text-ternary font-medium">{{$user->name ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Employee ID:</span>
                                            <span class="text-primary font-semibold">EMP-{{$user->id ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Role:</span>
                                            <span class="text-ternary font-medium">{{$user->getRoleNames()->first() ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Department:</span>
                                            <span class="text-ternary font-medium">{{$user->userdetails->department ?? 'N/A'}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full flex flex-col">
                                    <div class="pb-3 border-b-2 border-primary/30 mb-4">
                                        <span class="font-semibold text-ternary text-lg flex items-center">
                                            <i class="fas fa-phone mr-2 text-primary"></i>
                                            Contact Information
                                        </span>
                                    </div>
                                    <div class="flex flex-col space-y-4">
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Email:</span>
                                            <span class="text-ternary font-medium">{{$user->email ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Telephone:</span>
                                            <span class="text-ternary font-medium">01780-200705</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Phone:</span>
                                            <span class="text-ternary font-medium">{{$user->userdetails->phone_number ?? 'N/A'}}</span>
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
                                <div class="w-full flex flex-col">
                                    <div class="pb-3 border-b-2 border-primary/30 mb-4">
                                        <span class="font-semibold text-ternary text-lg flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2 text-primary"></i>
                                            Address Information
                                        </span>
                                    </div>
                                    <div class="flex flex-col space-y-4">
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Address:</span>
                                            <span class="text-ternary font-medium">{{$user->userdetails->address ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">City:</span>
                                            <span class="text-ternary font-medium">{{$user->userdetails->city ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">State:</span>
                                            <span class="text-ternary font-medium">{{$user->userdetails->state ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Country:</span>
                                            <span class="text-ternary font-medium">{{$user->userdetails->country ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Zip Code:</span>
                                            <span class="text-ternary font-medium">{{$user->userdetails->zip_code ?? 'N/A'}}</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="w-full flex flex-col">
                                    <div class="pb-3 border-b-2 border-primary/30 mb-4">
                                        <span class="font-semibold text-ternary text-lg flex items-center">
                                            <i class="fas fa-university mr-2 text-primary"></i>
                                            Bank Details
                                        </span>
                                    </div>
                                    <div class="flex flex-col space-y-4">
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Account Number:</span>
                                            <span class="text-ternary font-medium">{{$user->userdetails->account_number ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Short Code:</span>
                                            <span class="text-ternary font-medium">{{$user->userdetails->short_code ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Bank Name:</span>
                                            <span class="text-ternary font-medium">{{$user->userdetails->bank_name ?? 'N/A'}}</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="w-full flex flex-col">
                                    <div class="pb-3 border-b-2 border-primary/30 mb-4">
                                        <span class="font-semibold text-ternary text-lg flex items-center">
                                            <i class="fas fa-passport mr-2 text-primary"></i>
                                            Passport Details
                                        </span>
                                    </div>
                                    <div class="flex flex-col space-y-4">
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Passport Number:</span>
                                            <span class="text-ternary font-medium">{{$user->passport->passport_number ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Place of Issue:</span>
                                            <span class="text-ternary font-medium">{{$user->passport->place_of_issue ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Date of Issue:</span>
                                            <span class="text-ternary font-medium">{{$user->passport->date_of_issue ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Date of Expiry:</span>
                                            <span class="text-ternary font-medium">{{$user->passport->passport_expire_date ?? 'N/A'}}</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="w-full flex flex-col">
                                    <div class="pb-3 border-b-2 border-primary/30 mb-4">
                                        <span class="font-semibold text-ternary text-lg flex items-center">
                                            <i class="fas fa-ellipsis-h mr-2 text-primary"></i>
                                            Other Information
                                        </span>
                                    </div>
                                    <div class="flex flex-col space-y-4">
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Emergency Contact:</span>
                                            <span class="text-ternary font-medium">{{$user->userdetails->emergency_person_name ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Emergency Phone:</span>
                                            <span class="text-ternary font-medium">{{$user->userdetails->emergency_contact_number ?? 'N/A'}}</span>
                                        </div>
                                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-md">
                                            <span class="w-[140px] font-semibold text-sm text-ternary/80">Date of Joining:</span>
                                            <span class="text-primary font-semibold">{{ $user->created_at ? $user->created_at->format('d-m-Y') : 'N/A' }}</span>
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

        function printIcard() {
            var card = document.querySelector('#icardDiv .card');
            var printWindow = window.open('', '_blank', 'width=800,height=600');
            
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>I-Card Print</title>
                    <style>
                        body {
                            margin: 0;
                            padding: 20px;
                            font-family: Arial, sans-serif;
                            background: white;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            min-height: 100vh;
                        }
                        .print-card {
                            width: 400px;
                            background: white;
                            border: 2px solid #26ace2;
                            border-radius: 12px;
                            overflow: hidden;
                            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                        }
                        .print-header {
                            background: #26ace2;
                            color: white;
                            padding: 15px 20px;
                            font-size: 24px;
                            border-bottom-right-radius: 50px;
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                        }
                        .print-logo {
                            width: 60px;
                            height: 60px;
                            background: white;
                            border-radius: 50%;
                            padding: 5px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }
                        .print-logo img {
                            width: 100%;
                            height: 100%;
                            object-fit: contain;
                        }
                        .print-content {
                            padding: 20px;
                            display: flex;
                            gap: 20px;
                        }
                        .print-photo {
                            width: 120px;
                            height: 150px;
                            background: #f0f0f0;
                            border-radius: 8px;
                            overflow: hidden;
                            flex-shrink: 0;
                        }
                        .print-photo img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        }
                        .print-details {
                            flex: 1;
                        }
                        .print-field {
                            margin-bottom: 12px;
                            font-size: 14px;
                        }
                        .print-field-label {
                            font-weight: bold;
                            margin-right: 10px;
                            color: #333;
                        }
                        .print-id-number {
                            color: #26ace2;
                            font-weight: bold;
                            font-size: 16px;
                            margin-top: 15px;
                        }
                        @media print {
                            body {
                                padding: 0;
                            }
                            .print-card {
                                box-shadow: none;
                                border: 2px solid #26ace2;
                            }
                        }
                    </style>
                </head>
                <body>
                    <div class="print-card">
                        <div class="print-header">
                            <div>Cloud Travel</div>
                            <div class="print-logo">
                                <img src="${window.location.origin}/assets/images/logo.png" alt="Cloud Travel" />
                            </div>
                        </div>
                        <div class="print-content">
                            <div class="print-photo">
                                <img src="${card.querySelector('.photo img').src}" alt="Profile" />
                            </div>
                            <div class="print-details">
                                <div class="print-field">
                                    <span class="print-field-label">Name:</span>
                                    ${card.querySelector('.field:nth-child(1)').textContent.replace('Name:', '').trim()}
                                </div>
                                <div class="print-field">
                                    <span class="print-field-label">Joining Date:</span>
                                    ${card.querySelector('.field:nth-child(2)').textContent.replace('Joining Date:', '').trim()}
                                </div>
                                <div class="print-field">
                                    <span class="print-field-label">Department:</span>
                                    ${card.querySelector('.field:nth-child(3)').textContent.replace('Department:', '').trim()}
                                </div>
                                <div class="print-field">
                                    <span class="print-field-label">Phone Number:</span>
                                    ${card.querySelector('.field:nth-child(4)').textContent.replace('Phone Number:', '').trim()}
                                </div>
                                <div class="print-id-number">
                                    ${card.querySelector('.id-number').textContent.trim()}
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
                </html>
            `);
            
            printWindow.document.close();
            printWindow.focus();
            
            // Wait for images to load, then print
            printWindow.onload = function() {
                setTimeout(function() {
                    printWindow.print();
                    printWindow.close();
                }, 500);
            };
        }

        function printJoiningLetter() {
            var printContents = document.getElementById('joiningLettersDiv').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            
            // Reinitialize the tab functionality after printing
            jQuery(document).ready(function () {
                jQuery(document).on("click", ".agency_tab", function () {
                    var id = jQuery(this).data('tid');
                    jQuery(".agency_tab").removeClass("bg-secondary/40 border-[2px] border-secondary/60");
                    jQuery(this).addClass("bg-secondary/40 border-[2px] border-secondary/60");
                    jQuery(".tab").hide();
                    jQuery("#" + id).show();
                });
            });
        }
        </script>

</x-front.layout>
