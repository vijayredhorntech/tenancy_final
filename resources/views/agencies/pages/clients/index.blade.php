<x-agency.layout>
    @section('title')Clint @endsection



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Clint List </span>
              <!-- <button  onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000" > Create New Clint </button> -->
              <a href="{{ route('client.create') }}" 
                class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-200">
                Create New Client
                </a>
 </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 hidden">
                 
        <form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data"> 
           @csrf
              <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">
              
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="name" class="font-semibold text-ternary/90 text-sm">Name</label>
                                <div class="w-full relative">
                                    <input type="text" name="name" id="name" placeholder="clint name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                    <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="name" class="font-semibold text-ternary/90 text-sm">Last</label>
                                <div class="w-full relative">
                                    <input type="text" name="last" id="last" placeholder="last name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                    <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="name" class="font-semibold text-ternary/90 text-sm">Date of Birth</label>
                                <div class="w-full relative">
                                    <input type="text" name="last" id="name" placeholder="last name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                    <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>
                        
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="name" class="font-semibold text-ternary/90 text-sm">Gender</label>
                                <div class="w-full relative">
                                    <input type="text" name="last" id="name" placeholder="last name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                    <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>
                        
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="name" class="font-semibold text-ternary/90 text-sm">Ma</label>
                                <div class="w-full relative">
                                    <input type="text" name="last" id="name" placeholder="last name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                    <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>
                        
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="name" class="font-semibold text-ternary/90 text-sm">Last</label>
                                <div class="w-full relative">
                                    <input type="text" name="last" id="name" placeholder="last name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                    <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>
                        
                        
                        
                        
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="email" class="font-semibold text-ternary/90 text-sm">Email</label>
                             <div class="w-full relative">
                                 <input type="email" name="email" id="email" placeholder="Email....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


             
                 
                         
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Phone</label>
                             <div class="w-full relative">
                                 <input type="number" name="staff_phone" id="staff_phone" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                


                          


                         {{--   === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Zip Code</label>
                             <div class="w-full relative">
                                 <input type="text" name="zip_code" id="zip_code" placeholder="zip code....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                           <!-- <div class="address"> </div>  -->
                           <label for="name" class="font-semibold text-ternary/90 text-sm">Address</label>
                             <div class="w-full relative">
                                 <input type="text" name="address" id="address" placeholder="Address....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">City</label>
                             <div class="w-full relative">
                                 <input type="text" name="city" id="city" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">State</label>
                             <div class="w-full relative">
                                 <input type="text" name="state" id="state" placeholder="State....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-flag absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Country</label>
                             <div class="w-full relative">
                                 <input type="text" name="country" id="country" placeholder="Country....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>

                         

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Passport Number</label>
                             <div class="w-full relative">
                                 <input type="text" name="passport_number" id="passport_number" placeholder="Passport Number....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>

                       

                        
                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                          <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button>
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Create Clint</button>
                     </div>
                 </form>
             </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex justify-between gap-2 items-center">
                     <div class="flex gap-2">
                        <a href="{{route('exportclint')}}"> 
                         <button title="Export to excel" class="bg-success/20 text-success h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white  cursor-pointer transition ease-in duration-2000">
                             <i class="fa fa-file-excel"></i>
                         </button>
                        </a> 
                         <a href="{{route('generateclint.pdf')}}">
                         <button title="Export to pdf" class="bg-danger/20 text-danger h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white  cursor-pointer transition ease-in duration-2000">
                               <i class="fa fa-file-pdf"></i>
                         </button>
                        </a> 
                     </div>
                    <!-- <div class="flex items-center gap-2">
                           <input type="text" placeholder="Client name....." class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000" >
                           <button class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                                <i class="fa fa-search mr-1"></i> Search
                           </button>
                    </div> -->
                    <div class="flex items-center w-max gap-2">
                    <form action="{{ route('search') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                    <input type="hidden" name="type" value="client">
                    <input type="text" placeholder="Client name....." name="search"

                           class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000">
                      <button type="submit"
                        class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                        <i class="fa fa-search mr-1"></i> Search
                      </button>
                  </form>
                  
                        @if($searchback)
                        <a href="{{route('client.index')}}">   <button type="button" 
                            class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">
                             Clear Filter
                            </button>
                        </a> 

                        @endif
                </div>
                </div>
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Clint Id</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Name</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Email</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Phone number</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Passport</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                    </tr>

                    
                    @forelse($clients as $client)
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$client['clientid']}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$client['name']}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">    
                                <div class="flex flex-col">
                                <span><i class="fa fa-envelop text-sm mr-1 text-secondary"></i> {{$client['email']}}</span>
                                
                            </div></td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm"> {{$client['phone_number']}}</td>
                       
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                              {{$client['passport_number']}}
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
