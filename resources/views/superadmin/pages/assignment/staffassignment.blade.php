<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

     


<div class="w-full overflow-x-auto p-4">
    <div class="w-full flex flex-wrap">
        <!-- Team Assignment -->
        <div 
            data-tid="teamAssignmentDiv" 
            class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 bg-secondary/40 
                   border-[2px] border-secondary/60 text-lg px-8 py-0.5 
                   hover:bg-secondary/40 hover:border-secondary/60 
                   transition ease-in duration-200 cursor-pointer">
            Team Assignment
        </div>

        <!-- User Assignment -->
        <div 
            data-tid="userAssignmentDiv" 
            class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 
                   text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 
                   transition ease-in duration-200 cursor-pointer">
            User Assignment
        </div>

        <!-- Completed Assignments -->
        <div 
            data-tid="completedAssignmentDiv" 
            class="agency_tab w-max font-semibold text-ternary border-b-[2px] border-ternary/60 
                   text-lg px-8 py-0.5 hover:bg-secondary/40 hover:border-secondary/60 
                   transition ease-in duration-200 cursor-pointer">
            Completed Assignments
        </div>
    </div>
</div>


                <div class="w-full mt-4 ">
                   
                <div id="teamAssignmentDiv" class="tab  ">
                        <div class="w-full grid xl:grid-cols-1 lg:grid-cols-1 gap-4">
                            <div class="w-full ">
                                <div class="  border-[2px] border-primary/70 ">
                                    <div class="flex justify-center bg-primary/40 px-4 py-0.5">
                                        <span class="font-semibold text-ternary text-xl">Team Assignment</span>
                                    </div>
                                    <div class="mt-2 overflow-x-auto px-4 py-0.5">
                                        <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">
                                        <tr>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Assignment Title</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Assigned By</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Assigned To</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Assign Date</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Due Date</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Status</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                                        </tr>
                                        @forelse($teams as $assignment)
                                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000">
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$assignment->title}}</td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                                {{$assignment->user->name}}
                                            
                                            </td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$assignment['assign_to']}}</td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                                {{$assignment['assign_date']}}
                                            </td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm"> {{$assignment['due_date']}}</td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                                {{$assignment['status']}}
                                            </td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                                <div class="flex gap-2 items-center">

                                                    <a href="{{route('assign.edit',['id' => $assignment->id])}}" title="Edit Assignment">
                                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                                            <i class="fa fa-pencil"></i>
                                                        </div>
                                                    </a>
                                                    <a href="{{route('assign.view',['id' => $assignment->id])}}" title="View Assignment">
                                                        <div class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                                            <i class="fa fa-eye"></i>
                                                        </div>
                                                    </a>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                                        </tr>
                                        @endforelse


                                            

                                        </table>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                
                     

                   

                 
                </div>
          <!-- end team assigment  -->
                <div id="userAssignmentDiv" class="tab  hidden ">
                        <div class="w-full grid xl:grid-cols-1 lg:grid-cols-1 gap-4">
                            <div class="w-full ">
                                <div class="  border-[2px] border-primary/70 ">
                                    <div class="flex justify-center bg-primary/40 px-4 py-0.5">
                                        <span class="font-semibold text-ternary text-xl">User Assignment</span>
                                    </div>
                                    <div class="mt-2 overflow-x-auto px-4 py-0.5">
                                    <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">
                                        <tr>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Assignment Title</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Assigned By</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Assigned To</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Assign Date</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Due Date</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Status</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                                        </tr>
                                        @forelse($userassignment as $assignment)
                                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000">
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$assignment->title}}</td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                                {{$assignment->user->name}}
                                            
                                            </td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$assignment['assign_to']}}</td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                                {{$assignment['assign_date']}}
                                            </td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm"> {{$assignment['due_date']}}</td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                                {{$assignment['status']}}
                                            </td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                                <div class="flex gap-2 items-center">

                                                    <a href="{{route('assign.edit',['id' => $assignment->id])}}" title="Edit Assignment">
                                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                                            <i class="fa fa-pencil"></i>
                                                        </div>
                                                    </a>
                                                    <a href="" title="Invoices">
                                                        <div class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                                            <i class="fa fa-eye"></i>
                                                        </div>
                                                    </a>
                                                  
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                                        </tr>
                                        @endforelse


                                            

                                        </table>
                                    </div>
                                </div>
                            </div>
                      
                        </div>
                    </div>
                
                     

                   

                 
                </div>
     <!-- user assignment task -->
                <div id="completedAssignmentDiv" class="tab  hidden">
                        <div class="w-full grid xl:grid-cols-1 lg:grid-cols-1 gap-4">
                            <div class="w-full ">
                                <div class="  border-[2px] border-primary/70 ">
                                    <div class="flex justify-center bg-primary/40 px-4 py-0.5">
                                        <span class="font-semibold text-ternary text-xl">Complete Assignment</span>
                                    </div>
                                    <div class="mt-2 overflow-x-auto px-4 py-0.5">
                                    <table class="w-full border-[2px] border-secondary/40 border-collapse my-4">
                                        <tr>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Assignment Title</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Assigned By</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Assigned To</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Assign Date</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Due Date</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Status</td>
                                            <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                                        </tr>
                                        @forelse($completeassignment as $assignment)
                                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000">
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$assignment->title}}</td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                                {{$assignment->user->name}}
                                            
                                            </td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$assignment['assign_to']}}</td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                                {{$assignment['assign_date']}}
                                            </td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm"> {{$assignment['due_date']}}</td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                                {{$assignment['status']}}
                                            </td>
                                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                                <div class="flex gap-2 items-center">

                                                         <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                                            <i class="fa fa-check"></i>
                                                        </div>
                                                   
                                                    <!-- <a href="" title="View Invoices">
                                                        <div class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                                            <i class="fa fa-file"></i>
                                                        </div>
                                                    </a>
                                                    <a href="" title="View Dashboard">
                                                        <div class=" bg-danger/10 text-danger h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white transition ease-in duration-2000">
                                                            <i class="fa fa-computer"></i>
                                                        </div>
                                                    </a> -->
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                                        </tr>
                                        @endforelse


                                            

                                    </table>
                                    </div>
                                </div>
                            </div>
                       
                        </div>
                    </div>
                
                     

                   

                 
                </div>
         <!-- team assignment task  -->
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
