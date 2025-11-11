<x-agency.layout>
    @section('title')Call History @endsection




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
                <span class="font-semibold text-ternary text-xl">Edit Call History</span>

                  <a href="{{ route('agency.client.history', $history->client_id) }}" 
                    class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000 flex items-center gap-1">
                        <i class="fa fa-arrow-left text-xs"></i> Back
                    </a>

            </div>

       

         <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 p-6">
                <form action="{{ route('agency.history.update', ['client' => $history->client_id, 'history' => $history->id]) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                 @csrf
                        <input type="hidden" name="client_id" value="{{ $history->client_id }}">
                        <input type="hidden" name="history_id" value="{{ $history->id }}">

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
                    <textarea id="description" name="description" rows="3" placeholder="Enter description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20 sm:text-sm">{{$history->description}}</textarea>

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


        </div>
      
     
    </x-agency.layout>

    