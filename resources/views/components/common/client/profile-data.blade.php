<div class="w-full p-4 grid gap-x-4 gap-y-8 ">
    <div class="w-full flex flex-col overflow-x-auto">
        <div class="pb-2 pr-12 border-b-[2px] border-b-success">
        </div>
        <div class="flex flex-col mt-4 overflow-x-auto gap-6">
            <div class="w-full pb-4">
          
         
            </div>

            <div class="flex ">
                <span class="w-[200px] font-semibold text-lg text-ternary">Unique Id: </span>
                <span class="text-ternary text-medium italic"> {{$client->clientuid ?? 'N/A'}}</span>
            </div>
            <div class="flex ">
                <span class="w-[200px] font-semibold text-lg text-ternary">First Name: </span>
                <span class="text-ternary text-medium italic">   {{$client->first_name ?? 'N/A'}}</span>
            </div>
            <div class="flex ">
                <span class="w-[200px] font-semibold text-lg text-ternary">Last name: </span>
                <span class="text-ternary text-medium italic">  {{$client->last_name ?? ''}}</span>
            </div>
            <div class="flex ">
                <span class="w-[200px] font-semibold text-lg text-ternary">Address:</span>
                <span class="text-ternary text-medium italic">{{$client->permanent_address ?? ''}}</span>
            </div>
            <div class="flex ">
                <span class="w-[200px] font-semibold text-lg text-ternary">Zip Code:</span>
                <span class="text-ternary text-medium italic">{{$client->zip_code ?? ''}}</span>
            </div>
            <div class="flex ">
                <span class="w-[200px] font-semibold text-lg text-ternary">Country:</span>
                <span class="text-ternary text-medium italic">{{$client->country ?? ''}}</span>
            </div>
            <div class="flex mt-2">
                <span class="w-[200px] font-semibold text-lg text-ternary">Phone:</span>
                <span class="text-ternary text-medium italic"> {{$client->phone_number ?? 'N/A'}}</span>
            </div>
             <div class="flex ">
                <span class="w-[200px] font-semibold text-lg text-ternary">Email:</span>
                <span class="text-ternary text-medium italic">{{$client->email ?? 'N/A'}}</span>
            </div>
            <div class="flex mt-2">
                <span class="w-[200px] font-semibold text-lg text-ternary">Date Of Birth:</span>
                <span class="text-ternary text-medium italic">{{$client->date_of_birth ?? ''}}</span>
            </div>
            <div class="flex ">
                <span class="w-[200px] font-semibold text-lg text-ternary">Passport Number:</span>
                <span class="text-ternary text-medium italic">{{$client->clientinfo->passport_ic_number ?? ''}}</span>
            </div>
            <div class="flex mt-2">
                <span class="w-[200px] font-semibold text-lg text-ternary">Date Of Expire:</span>
                <span class="text-ternary text-medium italic">{{$client->clientinfo->passport_expiry_date ?? ''}}</span>
            </div>
            <div class="flex mt-2">
                <span class="w-[200px] font-semibold text-lg text-ternary">Date of Issue: </span>
                <span class="text-ternary text-medium italic">{{$client->clientinfo->passport_issue_date ?? ''}} </span>
            </div>
            <div class="flex mt-2">
                <span class="w-[200px] font-semibold text-lg text-ternary">Place of  Issue:</span>
                <span class="text-ternary text-medium italic">{{$client->clientinfo->passport_issue_place ?? ''}} </span>
            </div>
            <div class="flex mt-2">
                <span class="w-[200px] font-semibold text-lg text-ternary">Passport Front:</span>
                <span class="text-ternary text-medium italic"></span>
            </div>
            <div class="flex mt-2">
                <span class="w-[200px] font-semibold text-lg text-ternary">Passport Back:</span>
                <span class="text-ternary text-medium italic"></span>
            </div>
            <div class="flex mt-2">
                <span class="w-[200px] font-semibold text-lg text-ternary">Letter:</span>
                <span class="text-ternary text-medium italic"></span>
            </div>

            <!-- <div class="flex mt-2">
                <span class="w-[150px] font-semibold text-md text-ternary">Gender</span>
                <span class="text-ternary text-medium italic">{{$client->gender ?? ''}}</span>
            </div>
            <div class="flex mt-2">
                <span class="w-[150px] font-semibold text-md text-ternary">Marital Status</span>
                <span class="text-ternary text-medium italic">{{$client->marital_status ?? ''}}</span>
            </div> -->


         

          
<!-- 

            <div class="flex mt-2">
                <span class="w-[150px] font-semibold text-md text-ternary"></span>
                <span class="text-ternary text-medium italic"> </span>
            </div> -->
          
        <!-- </div>
    </div>
    <div class="w-full flex flex-col overflow-x-auto">
        <div class="pb-2 pr-12 border-b-[2px] border-b-success">
            <span class="font-semibold text-ternary text-lg">Contact Information:</span>
        </div>
        <div class="flex flex-col mt-4 ">
        </div> -->


<!-- 
        
    </div>

    <div class="w-full flex flex-col overflow-x-auto">
        <div class="pb-2 pr-12 border-b-[2px] border-b-success">
            <span class="font-semibold text-ternary text-lg">Address Information:</span>
        </div>
        <div class="flex flex-col mt-4">
            <div class="flex ">
                <span class="w-[150px] font-semibold text-md text-ternary">Religion:</span>
                <span class="text-ternary text-medium italic">{{$client->clientinfo->religion ?? ''}}</span>
            </div>

            <div class="flex ">
                <span class="w-[150px] font-semibold text-md text-ternary">Nationality:</span>
                <span class="text-ternary text-medium italic">{{$client->clientinfo->past_nationality ?? ''}}</span>
            </div>
         
         
        </div>
    </div>




    <div class="w-full flex flex-col overflow-x-auto">
        <div class="pb-2 pr-12 border-b-[2px] border-b-success">
            <span class="font-semibold text-ternary text-lg">Passport Details:</span>
        </div>

        <div class="flex flex-col mt-4">
           
        </div>
    </div> -->


    {{-- <div class="w-full flex flex-col overflow-x-auto">
        <div class="pb-2 pr-12 border-b-[2px] border-b-success">
            <span class="font-semibold text-ternary text-lg">Other:</span>
        </div>
        <div class="flex flex-col mt-4">
            <div class="flex mt-2">
                <span class="w-[150px] font-semibold text-md text-ternary">Father Name</span>
                <span class="text-ternary text-medium italic">{{$client->clientinfo->father_details ?? ''}}</span>
            </div>

            <div class="flex mt-2">
                <span class="w-[150px] font-semibold text-md text-ternary">Mother Name</span>
                <span class="text-ternary text-medium italic">{{$client->clientinfo->mother_details ?? ''}}</span>
            </div>

            <div class="flex mt-2">
                <span class="w-[150px] font-semibold text-md text-ternary">Spouse Name</span>
                <span class="text-ternary text-medium italic">{{$client->clientinfo->spouse_details ?? ''}}</span>
            </div>
             
        </div>
    </div> --}}




</div>
