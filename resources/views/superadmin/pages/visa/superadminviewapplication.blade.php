<x-front.layout>
    @section('title') Visa Application @endsection

    @section('title') Visa Application @endsection

<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

    {{-- === Heading Section === --}}
    <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
        <span class="font-semibold text-ternary text-xl">Visa Application Details</span>
    </div>

    {{-- === Visa Forms Section === --}}
    <div class="w-full p-4 bg-gray-50 border-b-[2px] border-b-ternary/10">
        <div class="flex gap-4 overflow-x-auto">
            @foreach ($forms as $form)
                <div class="bg-blue-100 border-[1px] border-b-[2px] border-r-[2px] border-blue-300 p-3 rounded-[3px] rounded-tr-[8px] min-w-[200px] shadow-md">
                    <h3 class="text-md font-semibold text-blue-900">{{ $form->from->form_name }}</h3>
                    <a href="{{ route('view.form', ['viewid' => Str::slug($form->from->form_name), 'id' => $clientData->id]) }}" 
                        target="_blank" 
                        class="mt-2 inline-block bg-blue-500 text-white px-4 py-1 rounded-lg hover:bg-blue-700 transition">
                            View Form
                        </a>
                </div>
            @endforeach
        </div>
    </div>

    {{-- === Application Details Table === --}}
    <div class="w-full p-4 border-b-[2px] border-b-ternary/10">
        <div class="w-full border-collapse">
            @php
                   $details = [
                    'Application ID' => $clientData->application_number ?? 'N/A',
                    'Full Name' => $clientData->clint->client_name ?? 'N/A',
                    'Email' => $clientData->clint->email ?? 'N/A',
                    'Phone Number' => $clientData->clint->phone_number ?? 'N/A',
                    'Visa Type' => $clientData->visa->name ?? 'N/A',
                    'Origin' => $clientData->origin->countryName ?? 'N/A',
                    'Destination' => $clientData->destination->countryName ?? 'N/A',
                    'Fee (USD)' => '£' . number_format($clientData->total_amount ?? 0, 2),
                    'Application Date' => $clientData->created_at ? $clientData->created_at->format('d M Y') : 'N/A'
                ];
            @endphp
            @foreach ($details as $key => $value)
                <div class="flex border-b-[1px] border-b-ternary/20 py-3">
                    <div class="w-1/3 font-semibold bg-gray-100 text-gray-700 p-2 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40">
                        {{ $key }}:
                    </div>
                    <div class="w-2/3 p-2 text-gray-800">
                        {{ $value }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- === Other Members Section === --}}
    <div class="w-full p-4">
        <div class="border-b-[2px] border-b-secondary/50 w-max pr-20 mb-4">
            <span class="text-lg font-bold text-ternary">Other Members</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                <tr class="bg-primary/10">
                    <th class="p-3 text-left font-semibold text-ternary border-b-[2px] border-b-primary/20">Name</th>
                    <th class="p-3 text-left font-semibold text-ternary border-b-[2px] border-b-primary/20">Passport Number</th>
                    <th class="p-3 text-left font-semibold text-ternary border-b-[2px] border-b-primary/20">Issue Date</th>
                    <th class="p-3 text-left font-semibold text-ternary border-b-[2px] border-b-primary/20">Expire Date</th>
                    <th class="p-3 text-left font-semibold text-ternary border-b-[2px] border-b-primary/20">Place of Issue</th>
                </tr>
                </thead>
                <tbody>
                @forelse($clientData->otherclients as $otherclient)
                    <tr class="border-b-[1px] border-b-ternary/20 hover:bg-gray-50 transition">
                        <td class="p-3">{{ $otherclient->lastname}}</td>
                        <td class="p-3">{{ $otherclient->passport_number ?? '' }}</td>
                        <td class="p-3">{{ $otherclient->passport_issue_date ?? '' }}</td>
                        <td class="p-3">{{ $otherclient->passport_expire_date ?? '' }}</td>
                        <td class="p-3">{{ $otherclient->place_of_issue ?? '' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4 text-gray-600">No Record Found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- === Back Button === --}}
    <div class="w-full flex justify-end px-4 pb-4 gap-2 mt-4">
        <a href="#" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">
            Back to List
        </a>
    </div>



  

        </x-front.layout>
