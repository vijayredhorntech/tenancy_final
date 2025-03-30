<x-agency.layout>
    @section('title') Visa Application @endsection

    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-lg border border-gray-200 mt-8 p-6">
        
        {{-- === Heading Section === --}}
        <div class="bg-primary/10 px-6 py-3 border-b-2 border-primary/20 flex justify-between items-center rounded-t-lg">
            <h2 class="text-2xl font-bold text-primary">Visa Application Details</h2>
        </div>

        {{-- === Visa Forms Section === --}}
        <div class="flex gap-4 mt-6 overflow-x-auto p-4 bg-gray-50 rounded-lg">
            @foreach ($forms as $form)
                <div class="bg-blue-100 border border-blue-300 p-4 rounded-lg min-w-[250px] text-center shadow-md">
                    <h3 class="text-lg font-semibold text-blue-900">{{ $form->from->form_name }}</h3>
        {{--   <a href="{{ route('view.form', ['viewid' => $form->from->form_name, 'id' => $clientData->id]) }}" 
              target="_blank" 
       class="mt-2 inline-block bg-blue-500 text-white px-4 py-1 rounded-lg hover:bg-blue-700 transition">
        View Form
    </a>--}}
    <a href="{{ route('view.form', ['viewid' => \Illuminate\Support\Str::slug($form->from->form_name), 'id' => $clientData->id]) }}" 
   target="_blank" 
   class="mt-2 inline-block bg-blue-500 text-white px-4 py-1 rounded-lg hover:bg-blue-700 transition">
    View Form
</a>


                </div>
            @endforeach
        </div>

        {{-- === Application Details Table === --}}
        <div class="mt-6">
            <table class="w-full border-collapse bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden">
                <tbody>
                    @php
                        $details = [
                            'Application ID' => $clientData->application_number ?? 'N/A',
                            'Full Name' => $clientData->clint->name ?? 'N/A',
                            'Email' => $clientData->clint->email ?? 'N/A',
                            'Phone Number' => $clientData->clint->phone_number ?? 'N/A',
                            'Visa Type' => $clientData->visa->name ?? 'N/A',
                            'Origin' => $clientData->origin->name ?? 'N/A',
                            'Destination' => $clientData->destination->name ?? 'N/A',
                            'Fee (USD)' => '$' . number_format($clientData->total_amount ?? 0, 2),
                            'Application Date' => $clientData->created_at ? $clientData->created_at->format('d M Y') : 'N/A'
                        ];
                    @endphp
                    @foreach ($details as $key => $value)
                        <tr class="border-b border-gray-200">
                            <td class="border p-4 font-semibold bg-gray-100 text-gray-700">{{ $key }}:</td>
                            <td class="border p-4 text-gray-800">{{ $value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- === Other Members Section === --}}
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-primary mb-4">Other Members</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 shadow-md rounded-lg bg-white">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="border p-3">Name</th>
                            <th class="border p-3">Passport Number</th>
                            <th class="border p-3">Issue Date</th>
                            <th class="border p-3">Expire Date</th>
                            <th class="border p-3">Place of Issue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientData->otherclients as $otherclient)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 transition">
                            <td class="border p-3">{{ $otherclient->lastname}} </td>
                            <td class="border p-3">{{ $otherclient->passport_number ?? '' }}</td>
                            <td class="border p-3">{{ $otherclient->passport_issue_date ?? '' }}</td>
                            <td class="border p-3">{{ $otherclient->passport_expire_date ?? '' }}</td>
                            <td class="border p-3">{{ $otherclient->place_of_issue ?? '' }}</td>
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
        <div class="text-center mt-8">
            <a href="#" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
                Back to List
            </a>
        </div>
        
    </div>
</x-agency.layout>
