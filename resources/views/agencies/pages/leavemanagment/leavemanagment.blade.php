<x-agency.layout>
    @section('title')
        Agency
    @endsection


        

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

        @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


        <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex flex-wrap ">

                <div data-tid ="leaveDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px]   bg-secondary/40 border-[2px] border-secondary/60 border-secondary/60 border-ternary/60   text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer   ">
                      Leave List
                    </div>

         
                    <!-- <div data-tid ="bookingDiv" class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer ">
                       
                    </div> -->

                    <div data-tid ="addleaveapplication" class="agency_tab w-max font-semibold text-ternary border-b-[2px]   border-ternary/60 border-secondary/60   text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 transition ease-in duration-2000 cursor-pointer   ">
                      Add Leave Application
                    </div>

                </div>

                <div class="w-full mt-4 ">
                
                    <!-- icard -->
                 
                      <!-- attendance -->
                      <div id="leaveDiv" class="tab">
                      
                      <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">              
                            <tr>
                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Type Of leave</td>
                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Start Date</td>
                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">End Date</td>
                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Status</td>
                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Reason</td>       
                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                            </tr>

                            @forelse($user->applyLeaves as $leave)
                  
                                <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000">
                                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $loop->iteration }}</td>
                                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{$leave->leave->leave_type ?? '0:00:00' }}</td>
                                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">{{ $leave->start_date ?? '0:00:00' }}</td>
                                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $leave->end_date ?? 'N/A' }}</td>
                                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $leave->status_of_leave ?? '0:00:00' }}</td>
                                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $leave->reason ?? '0:00:00' }}</td>
                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">
                                  
                                 @if($leave->status_of_leave=='pending')
                                          
                                 <a href="{{route('leave.edit',['leaveid'=>$leave->id])}}" title="Remind for funds">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                    </a>
                                    <a href="{{route('leave.cancel',['leaveid'=>$leave->id])}}" title="View Invoices">
                                        <div class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-cancel"></i>
                                        </div>
                                    </a>
                                 @elseif($leave->status_of_leave=='cancel')      
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-times-circle text-danger"></i>
                                        </div>  
                                @else
                                <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-check"></i>
                                        </div>        
                                @endif


                                </div>
                            </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm text-center">
                                        No Record Found
                                    </td>
                                </tr>
                            @endforelse
                        </table>

                      </div>


                    <div id="addleaveapplication" class="tab hidden">

                    <!-- start table -->

                    <div class="w-full grid  lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-4">
                            <div class="w-full">
                                <div class="  border-[2px] border-primary/70 ">
                                    <div class="flex justify-center bg-primary/40 px-4 py-0.5">
                                        <span class="font-semibold text-ternary text-xl">Apply Leave</span>
                                    </div>
                                    <div class="mt-2 overflow-x-auto px-4 py-0.5">
                                    <!-- add form    -->
                <form action="{{ route('agency.application_leave',['type','agency']) }}" method="POST" enctype="multipart/form-data"> 
                   @csrf
                     <div class="w-full grid xl:grid-cols-2 gap-2 px-4 py-6">

                     <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Leave Type : </label>
                             <div class="w-full relative">
                                 <select  name="leave_type" id="leave_type"
                                          class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                     <option value="">---Select---</option>
                                     @forelse($user->leaves  as $leave)
                                            <option value="{{ $leave->leave->id}}">{{ $leave->leave->leave_type }}</option>
                                     @empty
                                       <option value="">Select Leave</option>
                                     @endforelse
                                 </select>
                                 <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">From : </label>
                             <div class="w-full relative">
                                 <input type="date" name="from" max="2099-12-31" id="from"
                                        class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-calendar-day absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"
                                    onclick="document.getElementById('from').showPicker();"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">To: </label>
                             <div class="w-full relative">
                                 <input type="date" name="to" id="to" max="2099-12-31"
                                        class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-calendar-day absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"
                                    onclick="document.getElementById('to').showPicker();"></i>
                             </div>
                         </div>

                       
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Attachment</label>
                             <div class="w-full relative">
                                <input type="file" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div>
                     



                         {{--               === textarea input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Message</label>
                             <div class="w-full relative">
                                 <textarea   name="reason" id="reason" rows="4" placeholder="Description....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"></textarea>
                                 <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div>

                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Send</button>
                     </div>
                 </form>
                                    <!-- end form  -->
                                    </div>
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="  border-[2px] border-danger/70 ">
                                    <div class="flex justify-center bg-danger/40 px-4 py-0.5">
                                        <span class="font-semibold text-ternary text-xl">Leaves</span>
                                    </div>
                                    <div class="mt-2 overflow-x-auto px-4 py-0.5">
                                        <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">
                                            <tr>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Type Leave</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Allow</td>
                                                <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Used</td>
                                                <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Balance</td>
                                            </tr>

                                            @forelse($user->leaves  as $leave)
                                             
                                                    <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{ $leave->leave->leave_type ?? 'No Leave Assigned' }}</td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{ $leave->leave->total_days ?? 'No Leave Assigned' }}</td>
                                                    <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm"> {{ $leave->leave->Leavesbalance->used ?? '0' }} </td>
                                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{ $leave->leave->Leavesbalance->balance ?? $leave->leave->total_days }}</td>
                                                    
                                          
                                                </tr>


                                            @empty
                                                <tr>
                                                    <td colspan="6" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm text-center">No Record Found</td>
                                                </tr>
                                            @endforelse


                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- end table -->
                      
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




                document.addEventListener("DOMContentLoaded", function () {
                let today = new Date().toISOString().split('T')[0]; 

                const issuedate = document.getElementById('from');
                const birthdate = document.getElementById('to');

                if (issuedate) {
                    issuedate.setAttribute('min', today);
                    
                    issuedate.addEventListener('change', function () {
                        let selectedDate = this.value;
                        if (birthdate) {
                            birthdate.setAttribute('min', selectedDate); // Set 'to' min as 'from' value
                        }
                    });
                }

                if (birthdate) {
                    birthdate.setAttribute('min', today); // Default min as today
                }
            });

        </script>

</x-agency.layout>
