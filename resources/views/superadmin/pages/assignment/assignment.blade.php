<x-front.layout>
    @section('title')Assignment @endsection


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        {{-- === this is code for heading section ===--}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Assignment List </span>
            @canany(['assignment create', 'manage everything'])

            <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Assignment</button>
            @endcanany
        </div>
        {{-- === heading section code ends here===--}}



        {{-- === this is code for form section ===--}}
        <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 hidden">
            <form action="{{ route('assignment.store') }}" method="POST" enctype="multipart/form-data">
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
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Due Date</label>
                        <div class="w-full relative">
                            <input type="date" name="duedate" id="duedate"
                                class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                            <i class="fa fa-calendar-day absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"
                                onclick="document.getElementById('duedate').showPicker();"></i>
                        </div>
                    </div>

                    <!-- 
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Attachment</label>
                             <div class="w-full relative">
                                <input type="file" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div> -->


                    <div class="w-full relative group flex flex-col gap-1">
                        <label class="font-semibold text-ternary/90 text-sm"> Attachment</label>

                        <!-- File Input Container -->
                        <div id="fileInputContainer" class="w-full relative flex flex-col gap-2">
                            <div class="flex items-center gap-2">
                                <input type="file" name="attachment[]" class="file-input w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">

                                <!-- Plus Button -->
                                <button type="button" id="addFileBtn" class="p-2 bg-secondary/40 text-white rounded-full hover:bg-secondary/70 transition">
                                    +
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- === textarea input field ===--}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="name" class="font-semibold text-ternary/90 text-sm">Description</label>
                        <div class="w-full relative">
                            <textarea name="description" id="description" rows="3" placeholder="Description....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"></textarea>
                            <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                        </div>
                    </div>
     
     
     
                    {{-- === Radio Input Field === --}}
                    {{-- === Radio Input Field === --}}
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
                </div>
                <div class="w-full flex justify-end px-4 pb-4 gap-2">
                    <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button>
                    <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Create Assignment</button>
                </div>
            </form>
        </div>
        {{-- === form section code ends here===--}}


        {{-- === this is code for table section ===--}}
        <div class="w-full overflow-x-auto p-4">
            <div class="w-full flex justify-between gap-2 items-center">
                <div class="flex gap-2">
                    @canany(['export excel', 'manage everything'])
                    <!-- <button title="Export to excel" class="bg-success/20 text-success h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white  cursor-pointer transition ease-in duration-2000">
                        <i class="fa fa-file-excel"></i>
                    </button> -->
                    @endcanany
                    @canany(['export pdf', 'manage everything'])
                    <!-- <button title="Export to pdf" class="bg-danger/20 text-danger h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white  cursor-pointer transition ease-in duration-2000">
                        <i class="fa fa-file-pdf"></i>
                    </button> -->
                    @endcanany
                </div>
                <div class="flex items-center gap-2">
                    <input type="text" placeholder="Assignment  name....." class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000">
                    <button class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                        <i class="fa fa-search mr-1"></i> Search
                    </button>
                </div>
            </div>
            @if( auth()->user()->type === 'superadmin')
             {{-- This will stop execution if the user is super admin --}}
            @include('superadmin.pages.assignment.supperassignment', ['assignments' => $assignments])
        @else
         {{--  This will stop execution if the user is NOT a super admin --}}
            @include('superadmin.pages.assignment.staffassignment', ['teams' => $filteredTeams,'userassignment'=>$userassignement,'completeassignment'=>$completeassignment])
        @endif
        </div>
        {{-- === table section code ends here===--}}
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