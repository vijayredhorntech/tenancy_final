<x-front.layout>
    @section('title') Visa From  @endsection
<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include jQuery (required by Select2) and Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Form List </span>
                <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New From</button>
            </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 hidden">
             <form action="{{ route('visaform.store') }}" method="POST" enctype="multipart/form-data">  
                   @csrf
                     <div class="w-full grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-4  sm:grid-cols-2 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Form Name</label>
                             <div class="w-full relative">
                                 <input type="text" name="name" id="name" placeholder="Form name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>



                         {{-- === select input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Origin</label>
                             <div class="w-full relative">
                                 <select  name="origincoutnry" id="origincoutnry"
                                          class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                     <option value="">---Select---</option>
                                     @forelse($countries as $country)
                                     <option value="{{$country->id}}">{{$country->countryName}}</option>
                                     @empty
                                     <option value="">NO record found</option>
                                     @endforelse
                          
                                 </select>
                                 <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                                 @error('origincoutnry')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Destination</label>
                             <div class="w-full relative">
                                 <select  name="destination" id="datePicker"
                                          class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                     <option value="">---Select---</option>
                                     @forelse($countries as $country)
                                     <option value="{{$country->id}}">{{$country->countryName}}</option>
                                     @empty
                                     <option value="">NO record found</option>
                                     @endforelse
                                 </select>
                                 <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                                 @error('destination')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                </div>
                         </div>

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Form Upload</label>
                             <div class="w-full relative">
                                 <input type="file" name="form_upload" id="form_upload" placeholder="Form name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


 
                         {{--               === textarea input field ===--}}
                         <div class="w-full relative group flex flex-col xl:col-span-4  lg:col-span-3 md:col-span-4 sm:col-span-2  gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Description</label>
                             <div class="w-full relative">
                                 <textarea   name="description" id="description" rows="5" placeholder="Description....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"></textarea>
                                 <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div>


                    
                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                          <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button>
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Create Form</button>
                     </div>
                 </form>
             </div>
{{--        === form section code ends here===--}}

{{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex justify-between gap-2 items-center">
                     <div class="flex gap-2">
                         <!-- <button title="Export to excel" class="bg-success/20 text-success h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white  cursor-pointer transition ease-in duration-2000">
                             <i class="fa fa-file-excel"></i>
                         </button>
                         <button title="Export to pdf" class="bg-danger/20 text-danger h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white  cursor-pointer transition ease-in duration-2000">
                               <i class="fa fa-file-pdf"></i>
                         </button> -->
                     </div>

                    <!-- <div class="flex items-center gap-2">
                           <input type="text" placeholder="Form name....." class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000" >
                           <button class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                                <i class="fa fa-search mr-1"></i> Search
                           </button>
                    </div> -->
                    <div class="flex items-center gap-2">
                    

                </div>
                </div> 
                   <form id="filter-form" method="GET" action="{{ route('visa.forms') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                            placeholder="Name, Email, Transaction ID">
                    </div>

                    
                     <div>
                                            <label for="origin_id" class="block text-sm font-medium text-gray-700">Country Range</label>
                                           <div class="flex gap-2 mt-1">
                                        <!-- Origin Country -->
                                        <select name="origin_id" id="origin_id"
                                            class="select2 mt-1 block w-full text-gray-200 rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                            <option value="">Select Origin Country</option>
                                            @foreach($countries as $country)
                                                <option 
                                                    value="{{ $country->id }}" 
                                                    data-flag="{{ $country->getFlagUrlAttribute() }}"
                                                    {{ request('origin_id') == $country->id ? 'selected' : '' }}>
                                                    {{ $country->countryName }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <!-- Destination Country -->
                                        <select name="destination_id" id="destination_id"
                                            class="select2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                            <option value="">Select Destination Country</option>
                                            @foreach($countries as $country)
                                                <option 
                                                    value="{{ $country->id }}" 
                                                    data-flag="{{ $country->getFlagUrlAttribute() }}"
                                                    {{ request('destination_id') == $country->id ? 'selected' : '' }}>
                                                    {{ $country->countryName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                        </div>

                    <!-- Date Range -->
                    <!-- <div>
                        <label for="date_from" class="block text-sm font-medium text-gray-700">Date Range</label>
                        <div class="flex gap-2">
                            <input type="date" name="date_from" id="date_from" max="2099-12-31" value="{{ request('date_from') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                            <input type="date" name="date_to" id="date_to" max="2099-12-31" value="{{ request('date_to') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                        </div>
                    </div> -->

                    <!-- Status Filter -->
                    <!-- <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                            <option value="">All Status</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Online</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Offline</option>
                        </select>
                    </div>  -->
                </div>

                <!-- Filter Actions -->
                <div class="flex justify-between items-center mt-4">
                    <div class="flex gap-2">
                        <button type="submit" class="bg-success text-white px-4 py-2 rounded-md hover:bg-success/90">
                            Apply Filters
                        </button>
                        <a href="{{ route('visa.forms') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
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
                        <!-- <a href="{{ route('studentgenerate.excel') }}?{{ http_build_query(request()->all()) }}" 
                        class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                            Export CSV
                        </a>
                        <a href="{{ route('studentgenerate.pdf') }}?{{ http_build_query(request()->all()) }}"
                            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                Export PDF
                            </a> -->
                    </div>
                </div>
            </form>
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Form Name</td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Form Description</td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Total Assign Country</td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">View Form</td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>

                    </tr>
                   


                    @forelse($forms as $form)
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$form['form_name']}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$form['form_description']}}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">

                                <div class="flex items-center gap-2">
                                        {{ $form->countries ? $form->countries->count() : 0 }} 
                                   <a href="{{route('form.assigncountry',['id' => $form->id])}}"><button  title="Add Accessory" class="bg-success/20 text-success h-6 w-6 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white cursor-pointer transition ease-in duration-2000" fdprocessedid="sl25i6">
                                           <i class="fa fa-plus text-xs"></i>
                                       </button></a>

                                       <a href="{{route('form.viewform',['id' => $form->id])}}"><button  title="Add Accessory" class="bg-success/20 text-success h-6 w-6 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white cursor-pointer transition ease-in duration-2000" fdprocessedid="sl25i6">
                                           <i class="fa fa-eye text-xs"></i>
                                       </button></a>

                                    </div>
                                
                            </td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                            <a href="{{asset($form['document'])}}" target="_blank">  
                               View form
                           </a> 
                            </td>
                           
                            
                    
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">
                                    <!-- <a href="" title="View All Form">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </a> -->
                                    <!-- <a href="" title="View Edit">
                                        <div class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-edit"></i>
                                        </div>
                                    </a> -->

                               
                                    <a href="{{route('form.delete',['id' => $form->id])}}" title="Delete From" onclick="return confirm('Are you sure you want to Delete this item?');">
                                        <div class=" bg-danger/10 text-danger h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-trash"></i>
                                        </div>
                                    </a>


                                </div>
                            </td>
                        </tr>


                    @empty
                        <tr>
                            <td colspan="9" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                        </tr>
                    @endforelse


                </table>
               <div class="mt-4">
                 {{ $forms->withQueryString()->links() }}
                </div>



            </div>
{{--        === table section code ends here===--}}
        </div>
        <script>
    $(document).ready(function () {
        function formatCountry (country) {
            if (!country.id) {
                return country.text;
            }

            const flagUrl = $(country.element).data('flag');
            const countryName = country.text;

            if (flagUrl) {
                return $(`
                    <span class="flex items-center gap-2">
                        <img src="${flagUrl}" class="w-5 h-4 object-cover rounded-sm" />
                        <span>${countryName}</span>
                    </span>
                `);
            }

            return countryName;
        }

        // Initialize all select2 elements with flag template
        $('.select2').select2({
            templateResult: formatCountry,
            templateSelection: formatCountry,
            width: '100%'
        });
    });
</script>
</x-front.layout>
