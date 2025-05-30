<x-front.layout>
    @section('title')
        Agency
    @endsection




    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Update Leave: {{ $leave->userName->name ?? '' }}</span>           
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
            <form action="{{ route('updateleave') }}" method="POST" enctype="multipart/form-data"> 
                   @csrf
                     <div class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-2 px-4 py-6">
                     <input type="hidden" type="superadmin" name="usertype" value="superadmin">
                     <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Leave Type : </label>
                             <div class="w-full relative">
                                 <input type="hidden" name="leaveid" value="{{$leave->id}}" id="leaveid">
                                 <input type="text" value="{{$leave->leaveName->leave_type}}" readonly="" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <!-- <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i> -->
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">From : </label>
                             <div class="w-full relative">
                                 <input type="date" name="from" id="from" value="{{$leave->start_date}}"
                                        class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-calendar-day absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"
                                    onclick="document.getElementById('from').showPicker();"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">To: </label>
                             <div class="w-full relative">
                                 <input type="date" name="to" id="to" value="{{$leave->end_date}}"
                                        class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-calendar-day absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"
                                    onclick="document.getElementById('to').showPicker();"></i>
                             </div>
                         </div>
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Status</label>
                             <div class="w-full relative">
                             <select name="status" id="datePicker"
                                    class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 
                                    focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                    
                                    <option value="pending" {{ $leave->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $leave->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $leave->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="cancel" {{ $leave->status == 'cancel' ? 'selected' : '' }}>Canceled</option>
                                </select>
                                 <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                             </div>
                         </div>


                       
        



                         {{--               === textarea input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1 xl:col-span-2 lg:col-span-2 md:col-span-2 col-span-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Reason</label>
                             <div class="w-full relative">
                                 <textarea   name="reason" id="reason" rows="4" placeholder="Description....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">{{$leave->reason}}</textarea>
                                 <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div>

                      
                         

                         <div class="w-full relative group flex flex-col gap-1 xl:col-span-2 lg:col-span-2 md:col-span-2 col-span-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Remark</label>
                             <div class="w-full relative">
                                 <textarea   name="remark" id="remark" rows="4" placeholder="Description....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"></textarea>
                                 <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div>


                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Update</button>
                     </div>
                 </form>


    </div>

        

</x-front.layout>
