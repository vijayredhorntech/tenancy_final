<x-agency.layout>
    @section('title')Call History @endsection


{{--    === this is code for model ===--}}

{{--        === model code ends ===--}}
<!-- jQuery -->

<!-- DataTables CSS & JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Buttons extension -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<!-- JSZip & pdfmake for Excel/PDF export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">


   
    <!-- Right div with small Back button -->


{{--        === this is code for heading section ===--}}
           <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between items-center">
                <!-- Left: Title -->
                <span class="font-semibold text-ternary text-xl">Call History</span>

                <!-- Right: Buttons -->
                <div class="flex gap-2">
                    <button type="button" 
                            onclick="document.getElementById('formDiv').classList.toggle('hidden')" 
                            class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">
                        Create New Combination
                    </button>

                    <a href="{{ route('agencyview.client', ['id' => $clientDetails->id]) }}" 
                    class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000 flex items-center gap-1">
                        <i class="fa fa-arrow-left text-xs"></i> Back
                    </a>
                </div>
            </div>

{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
         <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 p-6 hidden">
                @if(isset($history))
                <form action="{{ route('agency.history.update', ['client' => $clientDetails->id, 'history' => $history->id]) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @else
                <form action="{{ route('agency.communication') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @endif
                @csrf
            <!-- <form action="{{ route('agency.communication') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4"> -->
                @csrf  
                
                <input type="hidden" name="client_id" value="{{ $clientDetails->id }}">
                <!-- DateTime -->
                <div>
                    <label for="datetime" class="block text-sm font-medium text-gray-700">Date & Time</label>
                   <input type="datetime-local" 
                    id="datetime" 
                    name="datetime" 
                    value="{{ now()->format('Y-m-d\TH:i') }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 sm:text-sm"
                    disabled>
              </div>

                <!-- Employee Name -->
                <div>
                    <label for="employee_name" class="block text-sm font-medium text-gray-700">Employee Name</label>
                    <input type="text" id="employee_name" name="employee_name" value="{{$user->name}}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 sm:text-sm">
                </div>

                <!-- Employee ID -->
                <div>
                    <label for="employee_id" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" id="employee_id" name="employee_id" value="{{$user->email}}" disabled  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 sm:text-sm">
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="3" placeholder="Enter description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 sm:text-sm"></textarea>

                    <!-- <textarea id="description" name="description" rows="3" placeholder="Enter description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 sm:text-sm"></textarea> -->
                </div>

                <!-- Submit Button -->
                <div class="md:col-span-2 flex justify-end">
                    <button class="px-6 py-2 rounded-xl bg-primary text-white font-semibold shadow hover:bg-primary/90">
                        {{ isset($history) ? 'Update Communication' : '+ Add New Communication' }}
                    </button>
                    <!-- <button type="submit" class="px-6 py-2 rounded-xl bg-primary text-white font-semibold shadow hover:bg-primary/90">
                        + Add New Communication
                    </button> -->
                </div>
            </form>

        </div>

{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
    

              <table id="historyTable" class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <thead>
                        <tr>
                            <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</th>
                            <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Details</th>
                            <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Description</th>
                            <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            @forelse($histories as $history)
                            <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000">
                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                    <div class="flex items-center gap-1"><i class="fa fa-calendar text-gray-400"></i> {{ \Carbon\Carbon::parse($history->date_time)->format('d-m-Y H:i') }}</div>
                                    <div class="flex items-center gap-1"><i class="fa fa-user text-gray-400"></i> {{ $history->user->name ?? '-' }}</div>
                                    <div class="flex items-center gap-1"><i class="fa fa-envelope text-gray-400"></i> {{ $history->user->email ?? '-' }}</div>
                                </td>
                           
                               <!-- Description cell: bigger width -->
                                    <td class="border-[2px] border-secondary/40 px-4 py-2 text-ternary/90 font-medium text-base w-[65%] ">
                                        {{ $history->description ?? '-' }}
                                    </td>

                                    <!-- Action cell: smaller width -->
                                    <td class="border-[2px] border-secondary/40 px-2 py-1 text-ternary/80 font-medium text-sm w-[10%] align-middle">
                                        <div class="flex items-center gap-1">
                                            <a href="{{ route('agency.history.edit', ['client' => $clientDetails->id, 'history' => $history->id]) }}"
                                                class="bg-blue-100 text-blue-700 h-6 px-2 flex items-center gap-1 rounded-[3px] hover:bg-blue-600 hover:text-white transition ease-in duration-200 text-xs">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </a>
                                         

                                            @if($user->getAllPermissions()->pluck('name')->intersect(['delete client history', 'manage everything'])->isNotEmpty())
                                                <a href="{{ route('agency.history.delete', ['client' => $clientDetails->id, 'history' => $history->id]) }}"
                                                onclick="return confirm('Are you sure you want to delete this history?')"
                                                class="bg-red-100 text-red-700 h-6 px-2 flex items-center gap-1 rounded-[3px] hover:bg-red-600 hover:text-white transition ease-in duration-200 text-xs">
                                                <i class="fa fa-trash"></i> Delete
                                                </a>
                                            @else
                                                <span>-</span>
                                            @endif
                                        </div>
                                    </td>





                            </tr>
                            @empty
                            
                            @endforelse
                        </tbody>
            </table>

            </div>
{{--        === table section code ends here===--}}
        </div>
        <script>
            $(document).ready(function() {
                $('#historyTable').DataTable({
                    dom: 'Bfrtip', // Show buttons
                    buttons: [
                        {
                            extend: 'copyHtml5',
                            text: '<i class="fa fa-copy"></i> Copy',
                            className: 'bg-gray-200 text-gray-700 h-9 px-3 flex items-center gap-2 rounded-[4px] hover:bg-gray-300 transition'
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel"></i> Excel',
                            className: 'bg-green-100 text-green-700 h-9 px-3 flex items-center gap-2 rounded-[4px] hover:bg-green-600 hover:text-white transition'
                        },
                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-csv"></i> CSV',
                            className: 'bg-blue-100 text-blue-700 h-9 px-3 flex items-center gap-2 rounded-[4px] hover:bg-blue-600 hover:text-white transition'
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf"></i> PDF',
                            className: 'bg-red-100 text-red-700 h-9 px-3 flex items-center gap-2 rounded-[4px] hover:bg-red-600 hover:text-white transition'
                        }
                    ],
                    paging: true,
                    searching: true,
                    ordering: true,
                    order: [[0, 'asc']], // Sort by first column by default
                    lengthChange: false // Hide page length dropdown if you want
                });
            });
        </script>
     
    </x-agency.layout>

    