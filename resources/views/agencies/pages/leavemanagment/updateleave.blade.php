<x-agency.layout>
    @section('title')Leave Management @endsection


{{--        === model code ends ===--}}
    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Update Leave </span>
              
            </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
             <form action="{{ route('agency.update.leavestore') }}" method="POST" enctype="multipart/form-data"> 
             @csrf
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                            <input type="hidden" name="id" value="{{$leave->id}}">
                            <input type="hidden" name="type" value="agency">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Leave Name</label>
                             <div class="w-full relative">
                                 <input type="text" name="leave_type" id="leave_type" value="{{$leave->leave_type}}" placeholder="Leave Type name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-leave absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>

                         {{--               === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Total Day </label>
                             <div class="w-full relative">
                                 <input type="number" name="total_day" id="total_day" value="{{$leave->total_days}}" placeholder="Total Day....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-days absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>

                         <div class="w-full relative group flex flex-col gap-1">
                                <span class="font-semibold text-ternary/90 text-sm">Status</span>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2">
                                        <input type="radio" name="status" value="1" class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px] checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0" {{ $leave->status ? 'checked' : '' }}>
                                        Active
                                    </label>
                                    <label class="flex items-center gap-2">
                                        <input type="radio" name="status" value="0" class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px] checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0" {{ !$leave->status ? 'checked' : '' }}>
                                        Inactive
                                    </label>
                                </div>
                            </div>

                            @if($leave->status)
                                <p>Status: Active</p>
                            @else
                                <p>Status: Inactive</p>
                            @endif

                    </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">

                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Update Leave</button>
                     </div>
                 </form>
             </div>
{{--        === form section code ends here===--}}

        </div>
</x-agency.layout>
