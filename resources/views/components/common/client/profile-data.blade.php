<div class="w-full p-4 grid gap-x-4 gap-y-8 ">
    <div class="w-full flex flex-col overflow-x-auto">

        <div class="flex flex-col mt-4 overflow-x-auto gap-6">
            <table class="w-full text-left border-collapse text-base">
                <tbody>

                @php
                    $address = $client->permanent_address ?? '';
                    $street = $city = $country = 'N/A';

                    if (!empty($address)) {
                        $parts = array_map('trim', explode(',', $address));
                        $count = count($parts);

                        if ($count >= 2) {
                            // Combine the first two parts for street
                            $street = strtoupper($parts[0] . ', ' . $parts[1]);
                        } elseif ($count == 1) {
                            $street = strtoupper($parts[0]);
                        }

                        if ($count >= 3) {
                            $city = strtoupper($parts[$count - 2]);
                            $country = strtoupper($parts[$count - 1]);
                        } elseif ($count == 2) {
                            $city = strtoupper($parts[1]);
                        }
                    }
                @endphp

                <tr class="border-b border-gray-100">
                    <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Unique ID:</th>
                    <td class="text-ternary text-lg px-20 py-3 w-[200px]">{{ strtoupper($client->clientuid ?? 'N/A') }}</td>
                </tr>

                <tr class="border-b border-gray-100">
                    <th class="w-[200px] font-bold text-xl text-ternary px- py-3">First Name:</th>
                    <td class="text-ternary text-lg px-20 py-3">{{ strtoupper($client->first_name ?? 'N/A') }}</td>
                </tr>

                <tr class="border-b border-gray-100">
                    <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Last Name:</th>
                    <td class="text-ternary text-lg px-20 py-3">{{ strtoupper($client->last_name ?? 'N/A') }}</td>
                </tr>

                {{-- Split Address into Street, City, Country --}}
                <tr class="border-b border-gray-100">
                    <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Street:</th>
                    <td class="text-ternary text-lg px-20 py-3">{{ $street }}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <th class="w-[200px] font-bold text-xl text-ternary px- py-3">City:</th>
                    <td class="text-ternary text-lg px-20 py-3">{{ $city }}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Country:</th>
                    <td class="text-ternary text-lg px-20 py-3">{{ $country }}</td>
                </tr>

                <tr class="border-b border-gray-100">
                    <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Postal Code:</th>
                    <td class="text-ternary text-lg px-20 py-3">{{ strtoupper($client->zip_code ?? 'N/A') }}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Country:</th>
                    <td class="text-ternary text-lg px-20 py-3">{{ strtoupper($client->country ?? 'N/A') }}</td>
                </tr>

                <tr class="border-b border-gray-100">
                    <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Phone:</th>
                    <td class="text-ternary text-lg px-20 py-3">{{ strtoupper($client->phone_number ?? 'N/A') }}</td>
                </tr>

                <tr class="border-b border-gray-100">
                    <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Email:</th>
                    <td class="text-ternary text-lg px-20 py-3">
                        {{ strtoupper($client->email ?? 'N/A') }}
                        <span class="text-green-600 font-semibold text-base">(Verified)</span>
                    </td>
                </tr>

                <tr class="border-b border-gray-100">
                    <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Date of Birth:</th>
                    <td class="text-ternary text-lg px-20 py-3">{{ strtoupper($client->date_of_birth ?? 'N/A') }}</td>
                </tr>

                <tr class="border-b border-gray-100">
                    <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Passport Number:</th>
                    <td class="text-ternary text-lg px-20 py-3">{{ $client->passport_ic_number ?? 'N/A' }}</td>
                </tr>

                <tr class="border-b border-gray-100">
                    <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Date of Issue:</th>
                    <td class="text-ternary text-lg px-20 py-3">
                        {{ $client->passport_issue_date ? \Carbon\Carbon::parse($client->passport_issue_date)->format('d/m/Y') : 'N/A' }}
                    </td>
                </tr>

                <tr class="border-b border-gray-100">
                    <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Date of Expiry:</th>
                    <td class="text-ternary text-lg px-20 py-3">
                        {{ $client->passport_expiry_date ? \Carbon\Carbon::parse($client->passport_expiry_date)->format('d/m/Y') : 'N/A' }}
                    </td>
                </tr>

                <tr class="border-b border-gray-100">
                    <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Place of Issue:</th>
                    <td class="text-ternary text-lg px-20 py-3">{{ $client->passport_issue_place ?? 'N/A' }}</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
