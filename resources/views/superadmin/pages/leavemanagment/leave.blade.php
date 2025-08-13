<x-front.layout>
    @section('title')Leave Management @endsection


{{--        === model code ends ===--}}
    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Leave List </span>
                <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Leave</button>
            </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 hidden">
                <form action="{{ route('leavestore') }}" method="POST" enctype="multipart/form-data"> 
                    @csrf
                            <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                                {{--               === text type input field ===--}}
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="name" class="font-semibold text-ternary/90 text-sm">Leave Name</label>
                                    <div class="w-full relative">
                                        <input type="text" name="leave_type" id="leave_type" placeholder="Leave Type name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                        <i class="fa fa-leave absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                {{--               === number type input field ===--}}
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label for="name" class="font-semibold text-ternary/90 text-sm">Total Day </label>
                                    <div class="w-full relative">
                                        <input type="number" name="total_day" id="total_day" placeholder="Total Day....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                        <i class="fa fa-days absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full flex justify-end px-4 pb-4 gap-2">
                                <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button>
                                <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Create Leave</button>
                            </div>
                    </form>
             </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
            <!-- <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex justify-between gap-2 items-center">
                     <div class="flex gap-2">
                         <button title="Export to excel" class="bg-success/20 text-success h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white  cursor-pointer transition ease-in duration-2000">
                             <i class="fa fa-file-excel"></i>
                         </button>
                         <button title="Export to pdf" class="bg-danger/20 text-danger h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white  cursor-pointer transition ease-in duration-2000">
                               <i class="fa fa-file-pdf"></i>
                         </button>
                     </div>
                    <div class="flex items-center gap-2">
                           <input type="text" placeholder="Leave Type....." class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000" >
                           <button class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                                <i class="fa fa-search mr-1"></i> Search
                           </button>
                    </div> -->
             
               <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex justify-between gap-2 items-center">
                  
                </div>
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Leave Type</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Days</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Satatus</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                    </tr>
           


                    @forelse($leaves as $leave)
      
                                 <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$leave['leave_type']}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$leave['total_days']}}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                    @php
                                        $isActive = $leave['status'] == 1;
                                        $statusLabel = $isActive ? 'Active' : 'Inactive';
                                        $statusColor = $isActive ? 'success' : 'danger';
                                    @endphp
                                    <span class="bg-{{ $statusColor }}/10 text-{{ $statusColor }} px-2 py-1 rounded-[3px] font-bold">
                                        {{ $statusLabel }}
                                    </span>
                                </td>

                          
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
							<div class="flex gap-2 items-center">
                                    <a href="{{ route('superadmin.update.leave', ['id' => $leave->id]) }}" title="Edit leave">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                    </a>
								<form action="{{ route('leave.delete', $leave->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this leave?');">
									@csrf
									@method('DELETE')
									<button type="submit" title="Delete leave">
										<div class=" bg-danger/10 text-danger h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white transition ease-in duration-2000">
											<i class="fa fa-trash"></i>
										</div>
									</button>
								</form>
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
            </div>
            </div>
              
{{--        === table section code ends here===--}}
     
</x-front.layout>
