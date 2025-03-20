<x-front.layout>
    @section('title') Edit Agency @endsection


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Edit Agency </span>
              </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
             <form action="{{ route('agencies.editstore') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))

                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
                         <!-- <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Agency Logo</label>
                             <div class="w-full relative">
                                 <input type="file" name="logo" id="name" placeholder="Agency name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-file absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div> -->

                                 <input type="hidden" name="id" value="{{ old('name', $edit_agency->id ?? '')  }}" id="id" placeholder="Agency name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Agency Name</label>
                             <div class="w-full relative">
                                 <input type="text" name="name" value="{{ old('name', $edit_agency->name ?? '')  }}" id="name" placeholder="Agency name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="email" class="font-semibold text-ternary/90 text-sm">Email</label>
                             <div class="w-full relative">
                                 <input type="email" name="email" id="email" value="{{ old('email', $edit_agency->email ?? '')  }}" placeholder="Email....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Telephone</label>
                             <div class="w-full relative">
                                 <input type="number" name="telephone" value="{{ old('telephone', isset($edit_agency->details->telephone) ? $edit_agency->details->telephone : '') }}" id="telephone" placeholder="telephone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Phone</label>
                             <div class="w-full relative">
                                 <input type="number" name="agency_phone" value="{{ old('phone', $edit_agency->phone ?? '')  }}" id="agency_phone" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Contact Person</label>
                             <div class="w-full relative">
                                 <input type="text" name="contact_name"  value="{{ old('contact_person', $edit_agency->contact_person ?? '')  }}" id="contact_name" placeholder="Contact Person Name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Contact person Phone</label>
                             <div class="w-full relative">
                                 <input type="number" name="contact_phone" value="{{ old('phone_number', $edit_agency->contact_phone ?? '')  }}" id="contact_phone" placeholder="Contact Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Vat Number</label>
                             <div class="w-full relative">
                                 <input type="text" name="vat_number" id="vat_number" value="{{ old('vat_number', isset($edit_agency->details->vat_number) ? $edit_agency->details->vat_number : '') }}"  placeholder="Vat ....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-file-invoice absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>






                         {{--   === number type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Zip Code</label>
                             <div class="w-full relative">
                                 <input type="text" name="zip_code" id="zip_code" value="{{ old('zip_code', isset($edit_agency->details->zipcode) ? $edit_agency->details->zipcode : '') }}"  placeholder="zip code....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                           <!-- <div class="address"> </div>  -->
                           <label for="name" class="font-semibold text-ternary/90 text-sm">Address</label>
                             <div class="w-full relative">
                                 <input type="text" name="address" id="address" value="{{ old('address', isset($edit_agency->address) ? $edit_agency->address : '') }}"placeholder="Address....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">City</label>
                             <div class="w-full relative">
                                 <input type="text" name="city" id="city" value="{{ old('city', isset($edit_agency->details->city) ? $edit_agency->details->city : '') }}" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">State</label>
                             <div class="w-full relative">
                                 <input type="text" name="state" value="{{ old('state', isset($edit_agency->details->state) ? $edit_agency->details->state : '') }}"  id="state" placeholder="State....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-flag absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Country</label>
                             <div class="w-full relative">
                                 <input type="test" name="country" id="country" value="{{ old('country', $edit_agency->details->country ?? '')  }}" placeholder="Country....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>




                    <!-- checkbox service -->


                         <div class="w-full relative group flex flex-col gap-2">
                             <label class="font-semibold text-ternary/90 text-sm">Select Services</label>
                             <div class="flex gap-2 flex-wrap">
                                 @forelse($services as $service)
                                     <div class="flex items-center gap-2">
                                         <input type="checkbox" id="service_{{ $service->id }}" value="{{ $service->id }}"  name="services[]"
                                                value="{{ $service->id }}" @if($edit_agency->userAssignments->contains('service_id', $service->id)) checked @endif
                                                class="appearance-none w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                         <label for="service_{{ $service->id }}"
                                                class="font-semibold text-ternary/90 text-sm flex items-center gap-2">{{ $service->name }}</label>
                                     </div>
                                 @empty
                                     <div class="text-sm text-red-500">No services available</div>
                                 @endforelse
                             </div>
                         </div>

                         <!-- Agency Status Selection -->
                        <div class="w-full relative group flex flex-col gap-2 mt-4">
                            <label class="font-semibold text-ternary/90 text-sm">Agency Status</label>
                            <div class="flex gap-4">
                                <!-- Active Radio Button -->
                                <div class="flex items-center gap-2">
                                    <input type="radio" id="status_active" name="status" value="1"
                                        @if($edit_agency->details->status == '1') checked @endif
                                        class="appearance-none w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px] checked:bg-success checked:border-success transition ease-in duration-200 focus:outline-none focus:ring-0">
                                    <label for="status_active" class="font-semibold text-ternary/90 text-sm flex items-center gap-2">Active</label>
                                </div>

                                <!-- Inactive Radio Button -->
                                <div class="flex items-center gap-2">
                                    <input type="radio" id="status_inactive" name="status" value="0"
                                        @if($edit_agency->details->status == '0') checked @endif
                                        class="appearance-none w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px] checked:bg-danger checked:border-danger transition ease-in duration-200 focus:outline-none focus:ring-0">
                                    <label for="status_inactive" class="font-semibold text-ternary/90 text-sm flex items-center gap-2">Inactive</label>
                                </div>
                            </div>
                        </div>


                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                           <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Update Agency</button>
                     </div>
                 </form>
             </div>
{{--        === form section code ends here===--}}

        </div>
</x-front.layout>
