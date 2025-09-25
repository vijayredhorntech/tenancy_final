<x-agency.layout>
    @section('title')Client Profile@endsection

    <div class="w-full space-y-6">
        {{-- Client Details Section --}}
        <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
            {{-- Header --}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Client Profile</span>
                <div class="flex gap-2">
                    <a href="{{ route('agencyupdate.client', $client->id) }}" class="bg-success text-white px-4 py-1 rounded hover:bg-success/80">
                        <i class="fa fa-edit mr-2"></i>Edit Client
                    </a>
                    <a href="{{ route('client.index') }}" class="bg-secondary text-white px-4 py-1 rounded hover:bg-secondary/80">
                        <i class="fa fa-arrow-left mr-2"></i>Back to Clients
                    </a>
                </div>
            </div>

            {{-- Client Details --}}
            <div class="w-full p-4">
                <div class="border-b-[2px] border-b-secondary/50 w-max pr-20 mb-4">
                    <span class="text-lg font-bold text-ternary">Personal Information</span>
                </div>

                <div class="grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4">
                    <div class="flex flex-col">
                        <span class="font-semibold text-ternary/70 text-sm">Full Name</span>
                        <span class="text-ternary text-lg">{{ $client->first_name }} {{ $client->last_name }}</span>
                    </div>
                    
                    <div class="flex flex-col">
                        <span class="font-semibold text-ternary/70 text-sm">Email</span>
                        <span class="text-ternary text-lg">{{ $client->email ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex flex-col">
                        <span class="font-semibold text-ternary/70 text-sm">Phone Number</span>
                        <span class="text-ternary text-lg">{{ $client->phone_number ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex flex-col">
                        <span class="font-semibold text-ternary/70 text-sm">Nationality</span>
                        <span class="text-ternary text-lg">{{ $client->nationality ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex flex-col">
                        <span class="font-semibold text-ternary/70 text-sm">Date of Birth</span>
                        <span class="text-ternary text-lg">{{ $client->date_of_birth ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex flex-col">
                        <span class="font-semibold text-ternary/70 text-sm">Gender</span>
                        <span class="text-ternary text-lg">{{ $client->gender ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex flex-col">
                        <span class="font-semibold text-ternary/70 text-sm">Marital Status</span>
                        <span class="text-ternary text-lg">{{ $client->marital_status ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex flex-col">
                        <span class="font-semibold text-ternary/70 text-sm">Passport Number</span>
                        <span class="text-ternary text-lg">{{ $client->passport_ic_number ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex flex-col">
                        <span class="font-semibold text-ternary/70 text-sm">City</span>
                        <span class="text-ternary text-lg">{{ $client->city ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex flex-col col-span-full">
                        <span class="font-semibold text-ternary/70 text-sm">Address</span>
                        <span class="text-ternary text-lg">{{ $client->permanent_address ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Family Members Section --}}
        <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
            {{-- Header --}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Family Members</span>
            </div>

            {{-- Family Members Table --}}
            <div class="w-full p-4">
                @if($familyMembers && $familyMembers->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b-2 border-primary/20">
                                    <th class="px-4 py-3 font-semibold text-ternary">Name</th>
                                    <th class="px-4 py-3 font-semibold text-ternary">Relationship</th>
                                    <th class="px-4 py-3 font-semibold text-ternary">Date of Birth</th>
                                    <th class="px-4 py-3 font-semibold text-ternary">Nationality</th>
                                    <th class="px-4 py-3 font-semibold text-ternary">Phone</th>
                                    <th class="px-4 py-3 font-semibold text-ternary">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($familyMembers as $member)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="px-4 py-3 text-ternary">
                                        {{ trim($member->first_name . ' ' . $member->last_name) }}
                                    </td>
                                    <td class="px-4 py-3 text-ternary">
                                        {{ ucfirst($member->relationship) }}
                                    </td>
                                    <td class="px-4 py-3 text-ternary">
                                        {{ $member->date_of_birth ? $member->date_of_birth->format('d/m/Y') : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-ternary">
                                        {{ $member->nationality ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-ternary">
                                        {{ $member->phone_number ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex gap-2">
                                            <a href="{{ route('agency.family-member.view', 'family_' . $member->id) }}" 
                                               class="text-blue-600 hover:text-blue-800 text-sm">
                                                <i class="fa fa-eye mr-1"></i>View
                                            </a>
                                            <a href="{{ route('agency.family-member.edit', 'family_' . $member->id) }}" 
                                               class="text-green-600 hover:text-green-800 text-sm">
                                                <i class="fa fa-edit mr-1"></i>Edit
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-500 text-lg">No family members added yet.</p>
                        <a href="{{ route('agencyupdate.client', $client->id) }}" 
                           class="mt-4 inline-block bg-primary text-white px-4 py-2 rounded hover:bg-primary/80">
                            <i class="fa fa-plus mr-2"></i>Add Family Members
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-agency.layout>