<x-front.layout>
    @section('title') Visa Application @endsection


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Edit Visa Application </span>
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Agency</button> -->
            </div>
{{--        === heading section code ends here===--}}


{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
             @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-md">
                <strong>Whoops! Something went wrong.</strong>
                <ul class="mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
              @endif
          
      
           <form action="{{route('updatevisa.application') }}" method="POST" enctype="multipart/form-data">     
                    @csrf
                    <input type="hidden" name="type" value="superadmin">
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                            <input type="hidden" name="applciationid" value="{{$clientData->id}}">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Application Id</label>
                             <div class="w-full relative">
                                 <input type="text" name="name" id="name" value="{{$clientData->application_number}}" readonly="" readonly="" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <!-- <i class="fa fa-applicaiton absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                             </div>
                         </div>

                         {{--               === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Full Name</label>
                             <div class="w-full relative">
                                 <input type="text" name="name" id="name" value="{{$clientData->clint->client_name}}" readonly="" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <!-- <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                             </div>
                         </div>

                         {{--               === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Phone Number</label>
                             <div class="w-full relative">
                                 <input type="number" name="phonenumber" id="phonenumber" value="{{$clientData->clint->phone_number}}" readonly="" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <!-- <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                             </div>
                         </div>

                         {{--               === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Visa Type</label>
                             <div class="w-full relative">
                                 <input type="text" name="visatype" id="visatype" value="{{$clientData->visa->name}}" readonly="" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <!-- <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                             </div>
                         </div>

                         {{--               === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Origin</label>
                             <div class="w-full relative">
                                 <input type="text" name="origin" id="origin" value="{{$clientData->origin->countryName}}" readonly="" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <!-- <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                             </div>
                         </div>
                         

                         {{--               === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Destination:</label>
                             <div class="w-full relative">
                                 <input type="text" name="destination" id="destination" value="{{$clientData->destination->countryName}}" readonly="" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <!-- <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                             </div>
                         </div>
                         {{--               === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Fee </label>
                             <div class="w-full relative">
                                 <input type="number" name="fee" id="fee" value="{{$clientData->total_amount}}" readonly="" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-=rupees absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>
                         {{-- === Radio Input Field === --}}
                         {{-- === Radio Input for Payment Status === --}}
                            <div class="w-full relative group flex flex-col gap-1">
                                <span class="font-semibold text-ternary/90 text-sm">Payment Status</span>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2">
                                        <input type="radio" name="paymentstatus" value="Paid" 
                                            class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0"
                                            {{ old('paymentstatus', $clientData->payment_status) == 'Paid' ? 'checked' : '' }}>
                                        Paid
                                    </label>
                                    <label class="flex items-center gap-2">
                                        <input type="radio" name="paymentstatus" value="Pending" 
                                            class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0"
                                            {{ old('paymentstatus', $clientData->payment_status) == 'Pending' ? 'checked' : '' }}>
                                        Pending
                                    </label>
                                </div>
                            </div>

                           

                            {{-- === Select Input for Document Status === --}}
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="document_status" class="font-semibold text-ternary/90 text-sm">Document Status</label>
                                <div class="w-full relative">
                                    <select name="document_status" id="document_status"
                                        class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 transition ease-in duration-200">
                                        <option value="Pending" {{ old('document_status', $clientData->document_status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Handed Over" {{ old('document_status', $clientData->document_status) == 'Handed Over' ? 'selected' : '' }}>Handed Over</option>
                                    </select>
                                    <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                                </div>
                            </div>


                            {{-- === Select Input for Application Status === --}}
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="application_status" class="font-semibold text-ternary/90 text-sm">Application Status</label>
                                <div class="w-full relative">
                                    <select name="application_status" id="application_status" 
                                        class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 transition ease-in duration-200">
                                        <option value="Pending" {{ old('application_status', $clientData->applicationworkin_status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Under Process" {{ old('application_status', $clientData->applicationworkin_status) == 'Under Process' ? 'selected' : '' }}>Under Process</option>
                                        <option value="Complete" {{ old('application_status', $clientData->applicationworkin_status) == 'Complete' ? 'selected' : '' }}>Complete</option>
                                        <option value="Rejected" {{ old('application_status', $clientData->applicationworkin_status) == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                                </div>
                            </div>

                         {{--               === textarea input field ===--}}
                         <!-- <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Description</label>
                             <div class="w-full relative">
                                 <textarea   name="description" id="description" rows="3" placeholder="Description....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"></textarea>
                                 <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div> -->


                       

              
                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                          <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button> -->
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Update Application</button>
                     </div>
                 </form>
             </div>

                </div>
            <!-- </div>

        </div> -->

        </x-front.layout>
