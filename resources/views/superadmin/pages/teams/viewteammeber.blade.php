<x-front.layout>
    @section('title')
     Team
    @endsection

    <div class="w-full border border-ternary/20 bg-white rounded-lg shadow-sm">

        {{-- === Heading Section === --}}
        <div class="bg-primary/5 px-6 py-4 border-b border-ternary/20 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <i class="fa fa-users text-primary text-lg"></i>
                <span class="font-semibold text-ternary text-lg">Team Details</span>
            </div>
            <span class="text-sm text-ternary/70 bg-white px-3 py-1 rounded-md border border-ternary/20">
                {{ $team->members()->count() ?: 0 }} Members
            </span>
        </div>

        {{-- === Team Details Section === --}}
        <div id="formDiv" class="w-full p-6 space-y-6">

            {{-- Team Info Section --}}
            <div class="w-full">
                <h2 class="text-lg font-semibold text-ternary mb-4 border-b border-ternary/20 pb-2">Team Information</h2>

                <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- Team Name --}}
                    <div class="bg-white border border-ternary/20 rounded-lg p-4 hover:border-primary/40 transition-colors duration-200">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fa fa-tag text-primary text-sm"></i>
                            <span class="font-medium text-ternary/80 text-sm">Team Name</span>
                        </div>
                        <p class="text-ternary font-medium">{{ $team->team_name }}</p>
                    </div>

                    {{-- Head Member --}}
                    <div class="bg-white border border-ternary/20 rounded-lg p-4 hover:border-primary/40 transition-colors duration-200">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fa fa-user-tie text-secondary text-sm"></i>
                            <span class="font-medium text-ternary/80 text-sm">Team Manager</span>
                        </div>
                        <p class="text-ternary font-medium">{{ $team->manager->name }}</p>
                    </div>

                    {{-- Total Members --}}
                    <div class="bg-white border border-ternary/20 rounded-lg p-4 hover:border-primary/40 transition-colors duration-200">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fa fa-users text-success text-sm"></i>
                            <span class="font-medium text-ternary/80 text-sm">Total Members</span>
                        </div>
                        <p class="text-ternary font-medium">{{ $team->members()->count() ?: 0 }}</p>
                    </div>

                    {{-- Description --}}
                    <div class="bg-white border border-ternary/20 rounded-lg p-4 hover:border-primary/40 transition-colors duration-200">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fa fa-info-circle text-warning text-sm"></i>
                            <span class="font-medium text-ternary/80 text-sm">Description</span>
                        </div>
                        <p class="text-ternary font-medium">{{ $team->team_name }}</p>
                    </div>
                </div>
            </div>

            {{-- Team Members List --}}
            <div class="w-full">
                <h2 class="text-lg font-semibold text-ternary mb-4 border-b border-ternary/20 pb-2">Team Members</h2>

                @if($team->members->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                        @foreach ($team->members as $member)
                            <div class="group">
                                <div class="flex items-center justify-between p-3 bg-white border border-ternary/20 rounded-lg hover:border-primary/40 hover:shadow-sm transition-all duration-200">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center text-primary font-semibold text-sm">
                                            {{ strtoupper(substr($member->membername->name, 0, 1)) }}
                                        </div>
                                        <span class="font-medium text-ternary text-sm">{{ $member->membername->name }}</span>
                                    </div>
                                    <a href="{{route('superadmin.teamuserdelete', ['id' => $member->membername->id, 'teamid' => $team->id])}}"
                                       onclick="return confirm('Are you sure you want to remove this member from the team?');"
                                       class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <button class="w-7 h-7 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-full flex items-center justify-center transition-colors duration-200">
                                            <i class="fa fa-times text-xs"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="w-full p-6 text-center border border-dashed border-ternary/30 bg-ternary/5 rounded-lg">
                        <i class="fa fa-users text-ternary/40 text-2xl mb-2"></i>
                        <p class="text-ternary/60 text-sm">No members in this team yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function removeMember(memberId) {
            if (confirm("Are you sure you want to remove this member?")) {
                window.location.href = `/team/remove-member/${memberId}`;
            }
        }
    </script>
</x-front.layout>