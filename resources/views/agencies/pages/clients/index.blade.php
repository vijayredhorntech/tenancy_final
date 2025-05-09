<x-agency.layout>
    @section('title')Client @endsection



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">ClientList </span>

                <button onclick="copyUrl()">Copy URL</button>

              <!-- <button  onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000" > Create New Client</button> -->
              <a href="{{ route('client.create') }}" 
                class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-200">
                Create New Client
                </a>
 </div>

            <div class="w-full overflow-x-auto p-4">
            <form id="filter-form" method="GET" action="{{ route('client.index') }}" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <!-- Search -->
                                <div>
                                    <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                        placeholder="Clientid, Name, Email, Payment Number">
                                </div>

                            

                                <!-- Date Range -->
                                <div>
                                    <label for="date_from" class="block text-sm font-medium text-gray-700">Date Range</label>
                                    <div class="flex gap-2">
                                        <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                        <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                    </div>
                                </div>

                                <!-- Status Filter -->
                              

                                <!-- Payment Method Filter -->
                            


                             

                            
                            </div>

                            <!-- Filter Actions -->
                            <div class="flex justify-between items-center mt-4">
                                <div class="flex gap-2">
                                    <button type="submit" class="bg-success text-white px-4 py-2 rounded-md hover:bg-success/90">
                                        Apply Filters
                                    </button>
                                    <a href="{{ route('client.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                                        Clear Filters
                                    </a>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <label for="per_page" class="text-sm font-medium text-gray-700">Show:</label>
                                    <select name="per_page" id="per_page" class="rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                            onchange="this.form.submit()">
                                        @foreach([10, 25, 50, 100] as $perPage)
                                            <option value="{{ $perPage }}" {{ request('per_page', 10) == $perPage ? 'selected' : '' }}>
                                                {{ $perPage }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <a href="{{ route('agencies.funddownloade') }}?{{ http_build_query(request()->all()) }}" 
                                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                        Export CSV
                                    </a>
                                    <a href="{{ route('agencies.exportfundpdf') }}?{{ http_build_query(request()->all()) }}"
                                        class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                            Export PDF
                                        </a>
                                </div>
                            </div>
                    </form>   

             
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Client Id</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Name</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Email</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Phone number</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Passport</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                    </tr>

                    
                    @forelse($clients as $client)
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$client['clientuid']}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$client['client_name']}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">    
                                <div class="flex flex-col">
                                <span><i class="fa fa-envelop text-sm mr-1 text-secondary"></i> {{$client['email']}}</span>
                                
                            </div></td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm"> {{$client['phone_number']}}</td>
                       
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                              {{$client->clientinfo->passport_ic_number}}
                            </td>
                            <!-- <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <span class="bg-{{$client['status']==='Inactive'?'danger':'success'}}/10 text-{{$client['status']==='Inactive'?'danger':'success'}} px-2 py-1 rounded-[3px] font-bold">{{$client['status']}}</span>
                            </td> -->
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">

                             

                                    <a href="{{route('agencyview.client',['id' => $client->id])}}" title="Edit">
                                        <div class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </a>

                                    <a href="{{route('agencyupdate.client',['id' => $client->id])}}" title="Edit">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-pen"></i>
                                        </div>
                                    </a>

                                   {{-- <a href="{{route('agencychat.client',['id' => $client->id])}}" title="Edit">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fas fa-comment-dots"></i>
                                        </div>
                                    </a>--}}
                                    <!-- <a href="{{route('agency.clientdelete',['id' => $client->id])}}" title="Delete">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-tace"></i>
                                        </div>
                                    </a> -->

                        


                                </div>
                            </td>
                        </tr>


                    @empty
                        <tr>
                            <td colspan="8" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                        </tr>
                    @endforelse


                </table>
             
            </div>
{{--        === table section code ends here===--}}
<script>
    // Set max date to today
            
        function copyUrl() {
            const token = "<?php echo $agency->agencytoken; ?>";
            
            const url = window.location.origin + "/agencies/clientcreate/" + token;
            navigator.clipboard.writeText(url)
            .then(() => {
            alert("URL copied to clipboard!");
            })
            .catch(err => {
            alert("Failed to copy URL: " + err);
            });
        }


    document.addEventListener("DOMContentLoaded", function () {
        let today = new Date().toISOString().split('T')[0]; 

        const issuedate = document.getElementById('passport_issuedate');
        const birthdate = document.getElementById('date_ofbirth');
        const expiredate = document.getElementById('passport_expiredate');

        if (issuedate) issuedate.setAttribute('max', today);
        if (birthdate) birthdate.setAttribute('max', today);
        if (expiredate) expiredate.setAttribute('min', today);

        function validateDateInput(input, type) {
            input.addEventListener("change", function () {
                // Ensure the input is fully entered (YYYY-MM-DD is 10 characters long)
                if (this.value.length !== 10) return;
       
                let selectedDate = new Date(this.value);

                let minDate = this.getAttribute("min") ? new Date(this.getAttribute("min")) : null;
                let maxDate = this.getAttribute("max") ? new Date(this.getAttribute("max")) : null;
                
                // Check if the entered date is within the allowed range
                if ((minDate && selectedDate < minDate) || (maxDate && selectedDate > maxDate)) {
                    alert(`Invalid ${type}! Please select a valid date.`);
                    this.value = ""; // Reset invalid value
                }
            });
        }

        if (issuedate) validateDateInput(issuedate, "Issue Date");
        if (birthdate) validateDateInput(birthdate, "Birth Date");
        // if (expiredate) validateDateInput(expiredate, "Expiry Date");
    });


</script>
        </div>
</x-agency.layout>
