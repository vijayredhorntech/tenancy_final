
<table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
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


                @forelse($assignments as $assignment)
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
                            <a href="{{route('assign.view',['id' => $assignment->id])}}" title="View">
                                <div class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                    <i class="fa fa-eye"></i>
                                </div>
                            </a>
                            <!-- <a href="" title="View Dashboard">
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
         