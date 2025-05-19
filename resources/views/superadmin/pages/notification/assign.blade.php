<x-front.layout>
    @section('title')Assign team @endsection


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        {{-- === this is code for heading section ===--}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Assign Team </span>
           
        </div>
        {{-- === heading section code ends here===--}}



        {{-- === this is code for form section ===--}}
        <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
            <form action="{{ route('assign.user') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                    {{-- === text type input field ===--}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="name" class="font-semibold text-ternary/90 text-sm">Assignment Name</label>
                        <div class="w-full relative">
                            <input type="text" name="title" id="title" placeholder="Assignment title....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                            <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                    </div>



                    {{-- === date type input field ===--}}
                    <!-- <div class="w-full relative group flex flex-col gap-1">
                        <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Due Date</label>
                        <div class="w-full relative">
                            <input type="date" name="duedate" id="duedate"
                                class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                            <i class="fa fa-calendar-day absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"
                                onclick="document.getElementById('duedate').showPicker();"></i>
                        </div>
                    </div> -->

      


                         <div class="w-full relative group flex flex-col gap-1">
                        <span class="font-semibold text-ternary/90 text-sm">Send To</span>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2">
                                <input type="radio" name="sendfor" value="team" checked onchange="toggleSelect()" class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px] checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                Team
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="sendfor" value="user" onchange="toggleSelect()" class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px] checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                User
                            </label>
                       
                        </div>
                    </div>

                    {{-- === Team Selection Dropdown === --}}
                    <div class="w-full relative mt-2" id="teamSelect">
                        <label for="team" class="font-semibold text-ternary/90 text-sm">Select Team</label>
                        <select name="team" id="team" class="w-full px-2 py-1 rounded-md border border-gray-300 focus:outline-none">
                            <option value="">---Select Team---</option>
                            @foreach ($teams as $team)

                        
                                <option value="{{ $team->id }}">{{ $team->team_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- === User Selection Dropdown (Hidden by Default) === --}}
                    <div class="w-full relative mt-2 hidden" id="userSelect">
                        <label for="user" class="font-semibold text-ternary/90 text-sm">Select User</label>
                        <select name="user" id="user" class="w-full px-2 py-1 rounded-md border border-gray-300 focus:outline-none">
                            <option value="">---Select User---</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    
  


                         <div class="w-full relative group flex flex-col gap-1 xl:col-span-3">
                            <label for="description" class="font-semibold text-ternary/90 text-sm">Description</label>
                            <div class="w-full relative">
                                <div id="editor" class="w-full pl-2 pr-8 py-1 border border-gray-300 rounded focus:outline-none focus:border-blue-500" style="height: 150px;">{!! old('description',isset($visa) ? $visa->description : '') !!}</div>

                                <input type="hidden" name="description" id="description" value="{{ old('description',isset($visa) ? $visa->description : '') }}">
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                 
     
     
     
                    {{-- === Radio Input Field === --}}
                    {{-- === Radio Input Field === --}}
             
                </div>
                <div class="w-full flex justify-end px-4 pb-4 gap-2">
                   
                    <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Assign</button>
                </div>
            </form>
        </div>
    
    </div>


    <script>
        
    function toggleSelect() {
        let teamRadio = document.querySelector('input[name="sendfor"][value="team"]').checked;
        let teamSelect = document.getElementById('teamSelect');
        let userSelect = document.getElementById('userSelect');

        if (teamRadio) {
            teamSelect.classList.remove('hidden');
            userSelect.classList.add('hidden');
        } else {
            teamSelect.classList.add('hidden');
            userSelect.classList.remove('hidden');
        }
    }

    // Initialize on page load
    toggleSelect();



        document.addEventListener("DOMContentLoaded", function() {
            let today = new Date().toISOString().split('T')[0];
            const issuedate = document.getElementById('duedate');
            if (issuedate) {
                issuedate.setAttribute('min', today);
            }
        });


        document.getElementById('addFileBtn').addEventListener('click', function() {
            let container = document.getElementById('fileInputContainer');
            let fileInputs = container.getElementsByTagName('input');

            if (fileInputs.length < 10) { // Limit to 10 inputs
                // Create a new wrapper div for input and button
                let fileWrapper = document.createElement('div');
                fileWrapper.className = "flex items-center gap-2";

                // Create new file input
                let newInput = document.createElement('input');
                newInput.type = 'file';
                newInput.name = 'attachment[]';
                newInput.className = "file-input w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200";

                // Append input to wrapper
                fileWrapper.appendChild(newInput);

                // Append wrapper to container
                container.appendChild(fileWrapper);
            } else {
                alert("You can only upload up to 10 files.");
            }
        });
    </script>

</x-front.layout>