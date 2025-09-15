<div class="w-full p-4 grid gap-x-4 gap-y-8 ">
    <div class="w-full flex flex-col overflow-x-auto">
        <div class="pb-2 pr-12 border-b-[2px] border-b-success">
        </div>
        <div class="flex flex-col mt-4 overflow-x-auto gap-6">
            <div class="w-full pb-4">
          
         
            </div>


           <table class="w-full text-left border-collapse text-base">
    <tbody>
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
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Address:</th>
            <td class="text-ternary text-lg px-20 py-3">{{ strtoupper($client->permanent_address ?? 'N/A') }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Zip Code:</th>
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
            <td class="text-ternary text-lg px-20 py-3">{{ strtoupper($client->email ?? 'N/A') }} <span class="text-green-600 font-semibold text-base">(Verified)</span></td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Date of Birth:</th>
            <td class="text-ternary text-lg px-20 py-3">{{ strtoupper($client->date_of_birth ?? 'N/A') }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Passport Number:</th>
            <td class="text-ternary text-lg px-20 py-3">{{ strtoupper($client->clientinfo->passport_ic_number ?? 'N/A') }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Date of Expire:</th>
            <td class="text-ternary text-lg px-20 py-3">{{ strtoupper($client->clientinfo->passport_expiry_date ?? 'N/A') }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Date of Issue:</th>
            <td class="text-ternary text-lg px-20 py-3">{{ strtoupper($client->clientinfo->passport_issue_date ?? 'N/A') }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Place of Issue:</th>
            <td class="text-ternary text-lg px-20 py-3">{{ strtoupper($client->clientinfo->passport_issue_place ?? 'N/A') }}</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Passport Front:</th>
            <td class="text-ternary text-lg px-20 py-3">N/A</td>
        </tr>
        <tr class="border-b border-gray-100">
            <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Passport Back:</th>
            <td class="text-ternary text-lg px-20 py-3">N/A</td>
        </tr>
        <tr>
            <th class="w-[200px] font-bold text-xl text-ternary px- py-3">Letter:</th>
            <td class="text-ternary text-lg px-20 py-3">N/A</td>
        </tr>
    </tbody>
</table>

</div>
