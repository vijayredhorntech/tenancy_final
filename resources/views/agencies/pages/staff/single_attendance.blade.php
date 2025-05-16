<x-agency.layout>
    @section('title') Attendance @endsection
    
    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        {{-- === this is code for heading section === --}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Attendance Details</span>
            <span>
                {{ $date_from->format('l, d F Y') }} to {{ $date_to->format('l, d F Y') }}
            </span>
        </div>
        {{-- === heading section code ends here=== --}}

        {{-- === this is code for table section === --}}
        <div class="w-full overflow-x-auto p-4">
            <!-- search function -->
            <form id="filter-form" method="GET" action="{{ route('staff.attandance') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Date Range -->
                    <div>
                        <label for="date_from" class="block text-sm font-medium text-gray-700">Date Range</label>
                        <div class="flex gap-2">
                            <input type="date" name="date_from" id="date_from" value="{{ request('date_from', $date_from->toDateString()) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                            <input type="date" name="date_to" id="date_to" value="{{ request('date_to', $date_to->toDateString()) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-4">
                        <div class="flex gap-2 items-center">
                            <label for="per_page" class="text-sm font-medium text-gray-700">Show:</label>
                            <select name="per_page" id="per_page" class="rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                    onchange="this.form.submit()">
                                @foreach([10, 25, 50, 100] as $perPage)
                                    <option value="{{ $perPage }}" {{ request('per_page', 10) == $perPage ? 'selected' : '' }}>
                                        {{ $perPage }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="bg-success text-white px-4 py-2 rounded-md hover:bg-success/90">
                                Apply Filters
                            </button>
                            <a href="{{ route('staff.attandance') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                                Clear Filters
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                <thead>
                    <tr>
                         <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md text-left">Sr</th>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md text-left">Name</th>
                         <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md text-left">Emp.Id</th>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md text-left">Date</th>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md text-left">Day</th>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paginatedData as $entry)
                        <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000">
                          
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$user['name']}}</td>
                            
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">EMP-{{$user['id']}}</td>
                          <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                            {{ \Carbon\Carbon::parse($entry['date'])->format('d M Y') }}

                            </td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                            {{ \Carbon\Carbon::parse($entry['date'])->format('l') }}

                            </td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                @if($entry['status'] === 'P')
                                <div class="h-4 w-4 bg-success rounded-xs"></div>
                            
                                @elseif($entry['status'] === 'A')
                                <div class="h-4 w-4 bg-danger rounded-xs"></div>
                                @else
                                    {{ $entry['status'] }}
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm text-center">
                                No Attendance Records Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination Links --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $paginatedData->withQueryString()->links() }}
            </div>
        </div>
        {{-- === table section code ends here=== --}}
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Set max date to today for date inputs
            let today = new Date().toISOString().split('T')[0];
            document.getElementById('date_from').setAttribute('max', today);
            document.getElementById('date_to').setAttribute('max', today);
        });
    </script>
</x-agency.layout>