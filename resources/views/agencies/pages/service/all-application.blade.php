<x-agency.layout>
    @section('title')Request List @endsection

    <div class="w-full grid xl:grid-cols-5 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 mb-4">
       
      


    </div>

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Request Application List </span>
            </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 hidden">
                 
             </div>
    
            <div class="w-full overflow-x-auto p-4">
            
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Service Name</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Country </td>

                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa Detatils</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Nationality</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Client Information</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Date of Entry</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                    </tr>

                    
                    @forelse($requestDatas as $requestData)
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$requestData->service_type }}</td>
                           
                   
                            <td class="border-[2px] border-secondary/40 px-4 py-0.5 text-ternary/80 font-medium text-sm ">
                            <span class="text-sm text-ternary/80 font-medium flex items-center gap-2 mr-6 whitespace-nowrap">
                                <img src="{{ asset('assets/flags/64x48/' . strtolower($requestData->combination->origincountry->countryCode) . '.png') }}" 
                                    alt="{{ $requestData->combination->origincountry->countryCode }}" 
                                    class="w-5 h-4 object-cover rounded-sm" />
                                {{ $requestData->combination->origincountry->countryName }}

                                <span class="mx-1">to</span>
     
                                <img src="{{ asset('assets/flags/64x48/' . strtolower($requestData->combination->destinationcountry->countryCode) . '.png') }}" 
                                    alt="{{ $requestData->combination->destinationcountry->countryCode }}" 
                                    class="w-5 h-4 object-cover rounded-sm" />
                                {{ $requestData->combination->destinationcountry->countryName }}
                            </span>
                      
                        </td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                  <span class="block leading-tight text-sm">{{ $requestData->visa->name }}</span>
                            <span class="block font-medium text-xs leading-tight">{{ $requestData->visasubtype->name }}</span>
                            </td>
                       
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                               {{$requestData->nationality}}
                            </td>
                             <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm whitespace-nowrap">
                           

                                    <span><i class="fa fa-user mr-1"></i>{{ $requestData->full_name }}</span><br>
                                    <span class="font-medium text-xs"><i class="fa fa-envelope mr-1"></i>{{ $requestData->email }}</span><br>
                                    <span class="font-medium text-xs"><i class="fa fa-phone mr-1"></i>{{ $requestData->phone_number }}</span>
                                    
                                </td>
                    
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                 {{ \Carbon\Carbon::parse($requestData->date_of_entry)->format('d M Y') }}
                            </td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">

                                   <a href="{{ route('applications.view', $requestData->id) }}" title="View Application">
                                            <div class="bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                                <i class="fa fa-eye"></i>
                                            </div>
                                        </a>

         
                                        <a href="{{ route('applications.proceed', $requestData->id) }}" 
                                                title="Proceed Application"
                                                onclick="return confirm('Are you sure you want to proceed with this application?');">
                                                    <div class="bg-warning/10 text-warning h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-warning hover:text-white transition ease-in duration-2000">
                                                        <i class="fa fa-share"></i>
                                                    </div>
                                        </a>


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
