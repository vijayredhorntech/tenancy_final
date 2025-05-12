<x-front.layout>
    @section('title')Staff @endsection
    <div class="w-full grid xl:grid-cols-5 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 mb-4">

    @php
        $userCount = isset($users) ? $users->count() : 0;
        $teamCount = isset($teams) ? $teams->count() : 0;
        $roleCount = isset($roles) ? $roles->count() : 0;
       $totalPresent=isset($users) ? $users->where('status', 'online')->count() : 0 

   @endphp
    
    
    
    

    </div>


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Staff Attandamce </span>
               <!-- <a href="{{route('superadmin_staffcreate')}}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000" > Create New Staff </a> -->
            </div>
{{--        === heading section code ends here===--}}





{{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
                     <!-- search function  -->
         <form id="filter-form" method="GET" action="{{ route('staff') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Search -->
           


                    <!-- Date Range -->
                    <div>
                        <label for="date_from" class="block text-sm font-medium text-gray-700">Date Range</label>
                        <div class="flex gap-2">
                            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                            <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-success text-white px-4 py-2 rounded-md hover:bg-success/90">
                            Apply Filters
                        </button>
                        <a href="{{ route('staff') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                            Clear Filters
                        </a>
                    </div>
        

                    
                
                </div>

                <!-- Filter Actions -->
                <div class="flex justify-between items-center mt-4">
                    <!-- <div class="flex gap-2">
                        <button type="submit" class="bg-success text-white px-4 py-2 rounded-md hover:bg-success/90">
                            Apply Filters
                        </button>
                        <a href="{{ route('staff') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                            Clear Filters
                        </a>
                    </div> -->
                    <!-- <div class="flex gap-2 items-center">
                        <label for="per_page" class="text-sm font-medium text-gray-700">Show:</label>
                        <select name="per_page" id="per_page" class="rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                onchange="this.form.submit()">
                            @foreach([10, 25, 50, 100] as $perPage)
                                <option value="{{ $perPage }}" {{ request('per_page', 10) == $perPage ? 'selected' : '' }}>
                                    {{ $perPage }}
                                </option>
                            @endforeach
                        </select>
                        <a href="{{ route('studentgenerate.excel') }}?{{ http_build_query(request()->all()) }}" 
                        class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                            Export CSV
                        </a>
                        <a href="{{ route('studentgenerate.pdf') }}?{{ http_build_query(request()->all()) }}"
                            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                Export PDF
                            </a>
                    </div> -->
                </div>
            </form> 
            
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Staff Name</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Employee Id</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Status</td>
                       </tr>

                     
                    
                    @forelse($users as $user)
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$user['name']}}</td>
                            
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">EMP-{{$user['id']}}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                            @php
                                    $currentMonth = now()->month;
                                    $currentYear = now()->year;

                                    $presentCount = $user->attendance->filter(function ($att) {
                                        return $att->attendance_status === 'Present' &&
                                            \Carbon\Carbon::parse($att->date)->month === now()->month &&
                                            \Carbon\Carbon::parse($att->date)->year === now()->year;
                                    })->count();

                                    $absentCount = $user->attendance->filter(function ($att) {
                                        return $att->attendance_status === 'Absent' &&
                                            \Carbon\Carbon::parse($att->date)->month === now()->month &&
                                            \Carbon\Carbon::parse($att->date)->year === now()->year;
                                    })->count();
                                   
                                @endphp


                                <span class="bg-green-500 text-white px-2 py-[2px] rounded text-xs font-semibold">
                                    Present ({{ $presentCount }} Days)
                                </span>

                                <span class="bg-red-500 text-white px-2 py-[2px] rounded text-xs font-semibold ml-2">
                                    Absent ({{ $absentCount }} Days)
                                </span>
                            </td>


                           </tr>


                    @empty
                        <tr>
                            <td colspan="8" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                        </tr>
                    @endforelse


                </table>
            </div>
{{--        === table section code ends here===--}}
<script>
    // Set max date to today


    document.addEventListener("DOMContentLoaded", function () {
        let today = new Date().toISOString().split('T')[0]; 

        const issuedate = document.getElementById('passport_issuedate');
        const birthdate = document.getElementById('date_ofbirth');
        const expiredate = document.getElementById('passport_expiredate');

        if (issuedate) issuedate.setAttribute('max', today);
        if (birthdate) birthdate.setAttribute('max', today);
        if (expiredate) expiredate.setAttribute('min', today);

        function validateDateInput(input, type) {
            input.addEventListener("change", function () {
                // Ensure the input is fully entered (YYYY-MM-DD is 10 characters long)
                if (this.value.length !== 10) return;
       
                let selectedDate = new Date(this.value);

                let minDate = this.getAttribute("min") ? new Date(this.getAttribute("min")) : null;
                let maxDate = this.getAttribute("max") ? new Date(this.getAttribute("max")) : null;
                
                // Check if the entered date is within the allowed range
                if ((minDate && selectedDate < minDate) || (maxDate && selectedDate > maxDate)) {
                    alert(`Invalid ${type}! Please select a valid date.`);
                    this.value = ""; // Reset invalid value
                }
            });
        }

        if (issuedate) validateDateInput(issuedate, "Issue Date");
        if (birthdate) validateDateInput(birthdate, "Birth Date");
        // if (expiredate) validateDateInput(expiredate, "Expiry Date");
    });


</script>
        </div>
</x-front.layout>
