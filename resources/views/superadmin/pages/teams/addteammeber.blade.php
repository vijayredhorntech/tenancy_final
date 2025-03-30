<x-front.layout>
    @section('title')
     Team
    @endsection


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Team  List </span>
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Team</button> -->
            </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
        

                 <form action="{{route('superadmin.teamstoreupdate')}}" method="POST" enctype="multipart/form-data">
                 @csrf
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                     {{--               === textarea input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Team Name</label>
                             <div class="w-full relative">
                                <input type="hidden" name="teamid" value="{{$team->id}}">
                                 <input type="test"  name="teamname" value="{{$team->team_name}}" id="teamname" readonly="" placeholder="Team Name....." class="quill-editor w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa-regular fa-user absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div>

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Manager Name</label>
                             <div class="w-full relative">
                        
                                 <input type="test"  name="teamname" value="{{$team->manager->name}}" id="teamname" readonly="" placeholder="Team Name....." class="quill-editor w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa-regular fa-user absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         {{--               === textarea input field ===--}}
                      

                         <div class="w-full relative group flex flex-col gap-1">
                                <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Member</label>
                                <div class="w-full relative">
                                    <select id="datePicker" name="member" class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                        <option value="">---Select---</option>
                                        @forelse($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @empty
                                            <option>No record found</option>
                                        @endforelse
                                    </select>
                                    <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                                </div>
                            </div>

                            <!-- Selected members list -->
                            <div class="w-full mt-2" id="displaypart">
                                <label class="font-semibold text-ternary/90 text-sm">Selected Members</label>
                                <div id="selectedMembersContainer" class="flex flex-wrap gap-2 mt-2"></div>
                            </div>

                            <!-- Hidden input field to store multiple values -->
                            <input type="hidden" id="selectedMembersInput" name="selected_members">


                     
                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                          <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button> -->
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Add Member</button>
                     </div>
                 </form>
             </div>
{{--        === form section code ends here===--}}



<script>
  
    document.addEventListener("DOMContentLoaded", function () {
        const selectElement = document.getElementById("datePicker");
        const selectedContainer = document.getElementById("selectedMembersContainer");
        const selectedInput = document.getElementById("selectedMembersInput");

        let selectedValues = [];

        selectElement.addEventListener("change", function () {
             
            let selectedOption = selectElement.options[selectElement.selectedIndex];
            let value = selectedOption.value;
            let text = selectedOption.text;

            if (value && !selectedValues.some(item => item.value === value)) {
                selectedValues.push({ value, text });
                updateSelectedList();
            }
        });

        function updateSelectedList() {
            selectedContainer.innerHTML = "";
            selectedValues.forEach((item, index) => {
                let memberDiv = document.createElement("div");
                memberDiv.classList.add("flex", "items-center", "gap-1", "bg-gray-200", "px-2", "py-1", "rounded-md");

                let span = document.createElement("span");
                span.textContent = item.text;

                let removeBtn = document.createElement("button");
                removeBtn.innerHTML = "&times;";
                removeBtn.classList.add("text-red-500", "font-bold", "cursor-pointer");
                removeBtn.addEventListener("click", function () {
                    removeSelected(index);
                });

                memberDiv.appendChild(span);
                memberDiv.appendChild(removeBtn);
                selectedContainer.appendChild(memberDiv);
            });

            // Update hidden input field
            selectedInput.value = selectedValues.map(item => item.value).join(",");
        }

        function removeSelected(index) {
            selectedValues.splice(index, 1);
            updateSelectedList();
        }
    });

</script>

        </div>
</x-front.layout>
