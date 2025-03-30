<x-front.layout>
    @section('title')ticketinformation Edit @endsection


{{--        === model code ends ===--}}
    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Edit Ticket </span>
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Generate Ticket</button> -->
            </div>


{{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
            <form action="{{ route('uperadmin.ticket') }}" method="POST">
                @csrf
              

                <div class="w-full grid xl:grid-cols-4 gap-4 p-6 bg-white shadow-lg rounded-lg">
                    
                    <!-- Ticket Number (Read-Only) -->
                    <div class="w-full flex flex-col">
                        <label class="font-semibold text-gray-700 text-sm">Ticket Number</label>
                        <input type="hidden" value="{{$ticketinformation->id}}" name="ticketid"> 
                        <input type="text" value="{{ $ticketinformation->ticket_id }}" readonly
                            class="w-full px-3 py-2 border rounded-lg bg-gray-100 cursor-not-allowed">
                    </div>

                    <!-- Created At (Read-Only) -->
                    <div class="w-full flex flex-col">
                        <label class="font-semibold text-gray-700 text-sm">Created At</label>
                        <input type="text" value="{{ $ticketinformation->created_at }}" readonly
                            class="w-full px-3 py-2 border rounded-lg bg-gray-100 cursor-not-allowed">
                    </div>

                    <!-- Service Related (Read-Only) -->
                    <div class="w-full flex flex-col">
                        <label class="font-semibold text-gray-700 text-sm">Service Related</label>
                        <input type="text" value="{{ $ticketinformation->type }}" readonly
                            class="w-full px-3 py-2 border rounded-lg bg-gray-100 cursor-not-allowed">
                    </div>

                    <!-- Description (Read-Only) -->
                    <div class="w-full flex flex-col xl:col-span-2">
                        <label class="font-semibold text-gray-700 text-sm">Description</label>
                        <textarea rows="2" readonly
                            class="w-full px-3 py-2 border rounded-lg bg-gray-100 cursor-not-allowed">{{ $ticketinformation->description }}</textarea>
                    </div>

                    <!-- Status (Editable) -->
                    <div class="w-full flex flex-col">
                        <label class="font-semibold text-gray-700 text-sm">Status</label>
                        <select name="status" class="w-full px-3 py-2 border rounded-lg">
                            <option value="open" {{ $ticketinformation->status == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="closed" {{ $ticketinformation->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            <option value="in_progress" {{ $ticketinformation->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="resolved" {{ $ticketinformation->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- View Status (Editable) -->
                    <div class="w-full flex flex-col">
                        <label class="font-semibold text-gray-700 text-sm">View Status</label>
                        <select name="view_status" class="w-full px-3 py-2 border rounded-lg">
                            <option value="unseen" {{ $ticketinformation->view_status == 'unseen' ? 'selected' : '' }}>Unseen</option>
                            <option value="seen" {{ $ticketinformation->view_status == 'seen' ? 'selected' : '' }}>Seen</option>
                        </select>
                    
                        @error('view_status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="w-full flex justify-end p-6 gap-4">
                    <a href="{{ route('superadmin.ticket') }}" class="bg-gray-200 px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-300">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-500 px-4 py-2 rounded-lg text-white hover:bg-blue-700">
                        Update ticketinformation
                    </button>
                </div>
            </form>

            </div>
{{--        === table section code ends here===--}}
        </div>

</x-front.layout>
     