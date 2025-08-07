<div class="w-full p-4 grid gap-x-4 gap-y-8 ">
    <div class="w-full flex flex-col overflow-x-auto">
        <div class="pb-2 pr-12 border-b-[2px] border-b-success">
        </div>
        <div class="flex flex-col mt-4 overflow-x-auto gap-6">
            <div class="w-full pb-4">
          
         
            </div>


           <table class="w-full text-left border-collapse text-sm">
    <tbody>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">Unique ID:</th>
            <td class="text-ternary  px-20 py-2 w-[200px]">{{ $client->clientuid ?? 'N/A' }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">First Name:</th>
            <td class="text-ternary  px-20 py-2">{{ $client->first_name ?? 'N/A' }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">Last Name:</th>
            <td class="text-ternary  px-20 py-2">{{ $client->last_name ?? 'N/A' }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">Address:</th>
            <td class="text-ternary  px-20 py-2">{{ $client->permanent_address ?? 'N/A' }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">Zip Code:</th>
            <td class="text-ternary  px-20 py-2">{{ $client->zip_code ?? 'N/A' }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">Country:</th>
            <td class="text-ternary  px-20 py-2">{{ $client->country ?? 'N/A' }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">Phone:</th>
            <td class="text-ternary  px-20 py-2">{{ $client->phone_number ?? 'N/A' }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">Email:</th>
            <td class="text-ternary  px-20 py-2">{{ $client->email ?? 'N/A' }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">Date of Birth:</th>
            <td class="text-ternary  px-20 py-2">{{ $client->date_of_birth ?? 'N/A' }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">Passport Number:</th>
            <td class="text-ternary  px-20 py-2">{{ $client->clientinfo->passport_ic_number ?? 'N/A' }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">Date of Expire:</th>
            <td class="text-ternary  px-20 py-2">{{ $client->clientinfo->passport_expiry_date ?? 'N/A' }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">Date of Issue:</th>
            <td class="text-ternary  px-20 py-2">{{ $client->clientinfo->passport_issue_date ?? 'N/A' }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">Place of Issue:</th>
            <td class="text-ternary  px-20 py-2">{{ $client->clientinfo->passport_issue_place ?? 'N/A' }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">Passport Front:</th>
            <td class="text-ternary  px-20 py-2">N/A</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">Passport Back:</th>
            <td class="text-ternary  px-20 py-2">N/A</td>
        </tr>
        <tr>
            <th class="w-[200px] font-semibold text-lg text-ternary px- py-2">Letter:</th>
            <td class="text-ternary  px-20 py-2">N/A</td>
        </tr>
    </tbody>
</table>

</div>
