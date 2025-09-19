<x-agency.layout>
    @section('title')Family Member Details@endsection

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
        {{-- Header --}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Family Member Details</span>
            <a href="{{ route('agencyview.client', $client->id) }}" class="bg-secondary text-white px-4 py-1 rounded hover:bg-secondary/80">
                <i class="fa fa-arrow-left mr-2"></i>Back to Client
            </a>
        </div>

        {{-- Content --}}
        <div class="w-full p-4 grid gap-x-4 gap-y-8">
            <div class="w-full flex flex-col overflow-x-auto">
                <div class="pb-2 pr-12 border-b-[2px] border-b-success">
                    <span class="text-lg font-bold text-ternary">{{ $familyMember->full_name }} ({{ ucfirst($familyMember->relationship) }})</span>
                </div>

                <div class="flex flex-col mt-4 overflow-x-auto gap-6">
                    <table class="w-full text-left border-collapse text-base">
                        <tbody>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Full Name:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->full_name }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Relationship:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ ucfirst($familyMember->relationship) }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Date of Birth:</th>
                                <td class="text-ternary text-lg px-20 py-3">
                                    {{ $familyMember->date_of_birth ? $familyMember->date_of_birth->format('d/m/Y') : 'N/A' }}
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Nationality:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->nationality ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Birth Place:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->birth_place ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Country of Birth:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->country_of_birth ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Email:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->email ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Phone Number:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->phone_number ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Passport Number:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->passport_number ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Employment:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->employment ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Employer Name:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->employer_name ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Address:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->address ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">City:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->city ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Country:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->country ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Educational Qualification:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->educational_qualification ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Religion:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->religion ?? 'N/A' }}</td>
                            </tr>
                            @if($familyMember->military_status)
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Military Organization:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->military_organization ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Military Designation:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->military_designation ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Military Rank:</th>
                                <td class="text-ternary text-lg px-20 py-3">{{ $familyMember->military_rank ?? 'N/A' }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-agency.layout>
