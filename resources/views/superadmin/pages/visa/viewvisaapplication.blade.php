<x-agency.layout>
    @section('title') Visa Application @endsection



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Visa List </span>
                <!-- <a href="{{route('visa.create')}}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000"> Create New Visa </a>  -->
                
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Visa</button> -->
            </div>

            
             </div>
<!-- 
            <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex justify-between gap-2 items-center"> -->
                   
                <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4 text-center">Visa Application Details</h2>

             

                <div class="flex gap-4 mb-6 overflow-x-auto">
                    @foreach ($forms as $form)
         
                        <div class="bg-blue-100 border border-blue-300 p-4 rounded-lg min-w-[250px] text-center">
                            <h3 class="text-lg font-semibold">{{ $form->from->form_name }}</h3>
                            <a href="{{asset($form->from->document)}}" target="_blank" class="mt-2 inline-block bg-blue-500 text-white px-4 py-1 rounded-lg hover:bg-blue-700">
                                View Form
                            </a>
                        </div>
                    @endforeach
                </div>

                <table class="w-full border-collapse border border-gray-300">
                <tbody>
                    <tr>
                        <td class="border p-2 font-semibold bg-gray-100">Application ID:</td>
                        <td class="border p-2">{{$clientData->application_number ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 font-semibold bg-gray-100">Full Name:</td>
                        <td class="border p-2">{{$clientData->clint->name ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 font-semibold bg-gray-100">Email:</td>
                        <td class="border p-2">{{$clientData->clint->email ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 font-semibold bg-gray-100">Phone Number:</td>
                        <td class="border p-2">{{$clientData->clint->phone_number ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 font-semibold bg-gray-100">Visa Type:</td>
                        <td class="border p-2">{{$clientData->visa->name ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 font-semibold bg-gray-100">Origin:</td>
                        <td class="border p-2">{{$clientData->origin->name ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 font-semibold bg-gray-100">Destination:</td>
                        <td class="border p-2">{{$clientData->visa->name ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 font-semibold bg-gray-100">Fee (USD):</td>
                        <td class="border p-2">${{ number_format($clientData->total_amount ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 font-semibold bg-gray-100">Application Date:</td>
                        <td class="border p-2">{{$clientData->created_at ? $clientData->created_at->format('d M Y') : 'N/A'}}</td>
                    </tr>
                </tbody>

    </table>

    <div class="text-center mt-6">
        <a href="" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700">
            Back to List
        </a>
    </div>
</div>

                </div>
            <!-- </div>

        </div> -->

        
    </x-agency.layout>
