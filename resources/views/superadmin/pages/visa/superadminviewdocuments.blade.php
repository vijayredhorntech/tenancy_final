<x-front.layout>
@section('title') Visa Application @endsection



<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Applications List  </span>
            <!-- <a href="{{route('visa.create')}}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000"> Create New Visa </a>  -->
  
        
         </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
        <div class="w-full overflow-x-auto p-4">
       {{-- <form id="filter-form" method="GET" action="{{ route('client.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Search -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                    placeholder="Clientid, Name, Email, Payment Number">
                            </div>
                            <div>
                                <label for="date_from" class="block text-sm font-medium text-gray-700">Date Range</label>
                                <div class="flex gap-2">
                                    <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                    <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                </div>
                            </div>

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
            </form>   --}}
            <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                <tr>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Application Number</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Document Name</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">View Document </th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Status </th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>
                </tr>
               


                @forelse($documents as $document)

                    <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$document->application_number}}</td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$document->document_name }} </td>
                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                <a href="{{ asset('storage/' . $document->document_file) }}" target="_blank">
                                View Document
                            </a>
                      </td>
                            @php
                             [$text, $color] = $document->document_status == 0 ? ['Pending', 'danger'] : ($document->document_status == 2 ? ['Pending for Approval', 'warning'] : ['Done', 'success']);
                              @endphp
                                <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                    <span class="bg-{{ $color }}/10 text-{{ $color }} px-2 py-1 rounded-[3px] font-medium">
                                        {{ $text }}
                                    </span>
                                </td>

                  <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                            <div class="flex gap-2 items-center">
                                @if($document->document_status == 1)              
                                    <div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                        <i class="fa fa-check"></i> <!-- FontAwesome icon -->
                                    </div> 
                                @else
                                
                         
                                    <a href="{{ route('superadminvisaeditdocument.application', ['id' => $document->id]) }}" title="Remind for funds">
                                        <div class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                    </a>

                                @endif

                                <a href="{{ route('superadminvisa.applicationview', ['id' => $document->id]) }}" title="Assign to Visa Request">
                                    <div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                        <i class="fa fa-eye"></i> <!-- FontAwesome icon -->
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
           


        </div>



</x-front.layout>