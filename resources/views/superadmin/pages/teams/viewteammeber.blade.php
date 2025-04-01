<x-front.layout>
    @section('title')
     Team
    @endsection


        <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

            {{-- === Heading Section === --}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Team List</span>
            </div>
            {{-- === heading section code ends here===--}}

            {{-- === Team Details Section === --}}
            <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 p-4">

                {{-- Team Info Section --}}
                <div class="w-full flex flex-col gap-2">
                    <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                        <span class="text-lg font-bold text-ternary">Team Details</span>
                    </div>

                    <div class="w-full grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                        {{-- Left Column --}}
                        <div class="w-full relative group flex flex-col gap-1">
                            <div class="w-full p-3 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40">
                                <span class="font-semibold text-ternary/90 text-sm">Team Name:</span>
                                <p class="text-gray-800 mt-1">{{ $team->team_name }}</p>
                            </div>
                        </div>

                        {{-- Right Column --}}
                        <div class="w-full relative group flex flex-col gap-1">
                            <div class="w-full p-3 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40">
                                <span class="font-semibold text-ternary/90 text-sm">Head Member:</span>
                                <p class="text-gray-800 mt-1">{{ $team->manager->name }}</p>
                            </div>
                        </div>

                        {{-- Left Column --}}
                        <div class="w-full relative group flex flex-col gap-1">
                            <div class="w-full p-3 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40">
                                <span class="font-semibold text-ternary/90 text-sm">Total Members:</span>
                                <p class="text-gray-800 mt-1">{{ $team->members()->count() ?: 0 }}</p>
                            </div>
                        </div>

                        {{-- Right Column --}}
                        <div class="w-full relative group flex flex-col gap-1">
                            <div class="w-full p-3 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40">
                                <span class="font-semibold text-ternary/90 text-sm">Description:</span>
                                <p class="text-gray-800 mt-1">{{ $team->team_name }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Team Members List --}}
                <div class="w-full mt-8">
                    <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                        <span class="text-lg font-bold text-ternary">Team Members</span>
                    </div>

                    @if($team->members->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                            @foreach ($team->members as $member)
                                <div class="flex items-center justify-between p-3 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 hover:bg-gray-50 transition ease-in duration-200">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-semibold">
                                            {{ substr($member->membername->name, 0, 1) }}
                                        </div>
                                        <span class="font-medium text-ternary">{{ $member->membername->name }}</span>
                                    </div>
                                    <a href="{{route('superadmin.teamuserdelete', ['id' => $member->membername->id, 'teamid' => $team->id])}}"
                                       onclick="return confirm('Are you sure you want to delete this user?');">
                                        <button class="text-red-500 hover:text-red-700 p-1 rounded-full hover:bg-red-100 transition ease-in duration-200">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="w-full p-4 mt-4 text-center text-gray-500 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40">
                            No members in this team yet.
                        </div>
                    @endif
                </div>
            </div>
            {{-- === form section code ends here===--}}

        </div>

        <script>
            function removeMember(memberId) {
                if (confirm("Are you sure you want to remove this member?")) {
                    window.location.href = `/team/remove-member/${memberId}`;
                }
            }
        </script></x-front.layout>