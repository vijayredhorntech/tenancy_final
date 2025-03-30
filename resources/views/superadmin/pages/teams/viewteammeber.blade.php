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
        
                        <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Team Details</h2>

                {{-- Team Info --}}
                <div class="mb-4 p-4 border border-gray-200 rounded-lg flex flex-col md:flex-row gap-4">
                    <!-- Left Column -->
                    <div class="flex-1">
                        <p><strong>Team Name:</strong> {{ $team->team_name }}</p>
                        <p><strong>Total Members:</strong> {{ $team->members()->count() ?: 0 }}</p>
                    </div>
                    <!-- Right Column -->
                    <div class="flex-1">
                        <p><strong>Head Member:</strong> {{ $team->manager->name }}</p>
                        <p><strong>Total Description:</strong> {{ $team->team_name }}</p>
                    </div>
                </div>


                {{-- Team Members List --}}
                <div class="bg-gray-100 p-4 rounded-lg">
                    <h3 class="text-lg font-medium mb-3">Members</h3>

                    @if($team->members->count() > 0)
                        <ul class="space-y-2">
                            @foreach ($team->members as $member)
                                <li class="flex items-center justify-between bg-white p-3 rounded-lg shadow">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600">
                                     
                                        {{ substr($member->membername->name, 0, 1) }}
                                        </div>
                                        <span class="text-gray-800 font-medium">{{ $member->membername->name }}</span>
                                    </div>
                                    <a href="{{route('superadmin.teamuserdelete', ['id' => $member->membername->id, 'teamid' => $team->id])}}"> <button class="text-red-500 hover:text-red-700"  onclick="return confirm('Are you sure you want to delete this user?');">
                                        ✖
                                    </button> </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">No members in this team yet.</p>
                    @endif
                </div>
            </div>

            <script>
                function removeMember(memberId) {
                
                    if (confirm("Are you sure you want to remove this member?")) {
                        window.location.href = `/team/remove-member/${memberId}`;
                    }
                }
            </script>
               
             </div>
{{--        === form section code ends here===--}}




        </div>
</x-front.layout>
