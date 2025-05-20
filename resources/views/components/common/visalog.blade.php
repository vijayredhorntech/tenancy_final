<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Application Log  </span>
            <!-- <a href="{{route('visa.create')}}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000"> Create New Visa </a>  -->
  
        
         </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
        <div class="w-full overflow-x-auto p-4">
      
            <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                <tr>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Application Number</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">User Type </th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Date  </th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Time</th>
               </tr>
               


                @forelse($logs as $log)

                    <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$log->application_number}}</td>
                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{$log->audit_name }}</td>
                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">{{$log->user_type }}</td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm"> {{ \Carbon\Carbon::parse($log->audit_date)->format('d-m-Y') }}  </td>  
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{ \Carbon\Carbon::parse($log->audit_time)->format('h:i A') }} </td>
                    </tr>


                @empty
                    <tr>
                        <td colspan="9" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                    </tr>
                @endforelse


            </table>
           


        </div>
  </div>
