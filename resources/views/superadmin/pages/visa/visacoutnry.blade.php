<x-front.layout>
    @section('title') Visa   @endsection


    <!-- In your Blade template head section -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Before closing body tag -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- script for serach -->

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Assign Country List </span>
                <a href="{{route('visa.assign')}}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000"> Create New Visa </a> 
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Visa</button> -->
            </div>
       
            <div class="w-full overflow-x-auto p-4">
            <form id="filter-form" method="GET" action="{{ route('visa.country') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
         
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Type of Visa</label>
                        <select name="visatype" id="visatype" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                            <option value="">All Visa</option>
                            @foreach($visas as $visa)
                                <option value="{{ $visa->id }}" {{ request('visatype') == $visa->id?'selected' : '' }}>
                                    {{ $visa->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Depart ment Range -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Origin country</label>
                        <select name="origincountry" id="origincountry" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                            <option value="">Origin country</option>
                     
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ request('origincountry') == $country->id?'selected' : '' }}>
                                    {{ $country->countryName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Destination Coutnry</label>
                        <select name="destinationcountry" id="destinationcountry" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                            <option value="">Destination country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ request('destinationcountry') == $country->id?'selected' : '' }}>
                                    {{ $country->countryName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date Range -->
                    <div>
                        <label for="date_from" class="block text-sm font-medium text-gray-700">Date Range</label>
                        <div class="flex gap-2">
                            <input type="date" name="date_from" id="date_from" max="2099-12-31" value="{{ request('date_from') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                            <input type="date" name="date_to" id="date_to" max="2099-12-31" value="{{ request('date_to') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Required</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                            <option value="">All Status</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Required</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Not Required</option>
                        </select>
                    </div>

                    

                
                </div>

                <!-- Filter Actions -->
                <div class="flex justify-between items-center mt-4">
                    <div class="flex gap-2">
                        <button type="submit" class="bg-success text-white px-4 py-2 rounded-md hover:bg-success/90">
                            Apply Filters
                        </button>
                        <a href="{{ route('visa.country') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
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
                        <a href="{{ route('studentgenerate.excel') }}?{{ http_build_query(request()->all()) }}" 
                        class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                            Export CSV
                        </a>
                        <a href="{{ route('studentgenerate.pdf') }}?{{ http_build_query(request()->all()) }}"
                            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                Export PDF
                            </a>
                    </div>
                </div>
            </form> 

                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</th>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa Name</th>

                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Origin country</th>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Destination Coutnry</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Required</td>
                      
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>
                    </tr>
                   


                    @forelse($applyCountires as $visa)
               
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$visa->VisaServices->name}}</td>

                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm"> {{$visa->origincountry->countryName}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm"> {{$visa->destinationcountry->countryName}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm"> <p> {{ $visa->required == 0 ? 'Required' : 'Not Required' }}</p>
                            </td>

                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">

                                <a href="{{ route('visa.viewcountry', ['id' => $visa->id]) }}" title="Edit Country">
                                        <div class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </a>



                               
                               {{--     <a href="{{ route('visa.editcountry', ['id' => $visa->id]) }}" title="Edit Country">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                    </a>
                                    --}}
                                    <a href="{{ route('requiredclient.field', ['id' => $visa->id]) }}" title="Assign  Country">
                                        <div class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </a>
                             

                                    <!-- <a href="{{ route('visa.view', ['id' => $visa->id]) }}" title="Assign to Visa Request"> -->
                                    <!-- <a href="{{ route('visa.assigncountry', ['id' => $visa->id]) }}" title="Assign to Visa Request">
                                        <div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </a> -->


                                    <!-- <a href="" title="View Dashboard">
                                        <div class=" bg-danger/10 text-danger h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-computer"></i>
                                        </div>
                                    </a> -->


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
                {{ $applyCountires->withQueryString()->links() }}

                </div>


            </div>
{{--        === table section code ends here===--}}
        </div>

        <script>
                         $(document).ready(function() {
                            $('#origincountry').select2({
                                placeholder: "---Select Country---",
                                allowClear: true,
                                containerCssClass: 'visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60'
                            });
                            $('#destinationcountry').select2({
                                placeholder: "---Select Country---",
                                allowClear: true,
                                containerCssClass: 'visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60'
                            });
                        
                            $('#visatype').select2({
                                placeholder: "---Select Visa---",
                                allowClear: true,
                                containerCssClass: 'visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60'
                            });

                            
                 });
            </script>
      
</x-front.layout>
