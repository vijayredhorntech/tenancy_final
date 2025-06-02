<x-front.layout>
    @section('title')Staff @endsection
    <div class="w-full grid xl:grid-cols-5 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2 mb-4">

    </div>


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

           {{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl"> Cancel Invoice Listing </span>
            </div>
             {{--        === heading section code ends here===--}}

             {{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
                     <!-- search function  -->
                {{--     <form id="filter-form" method="GET" action="{{ route('flight.booking') }}" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <!-- Search -->
                                    <div>
                                        <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                            placeholder="Name, Email, Transaction ID">
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

                         

                                    <!-- Payment Method Filter -->
                                    <div>
                                        <label for="payment_method" class="block text-sm font-medium text-gray-700">Supplier type</label>
                                        <select name="supplier" id="supplier" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                            <option value="">All Supplier</option>
                                            @foreach($airlinePassengerTotals as $airline =>$passengerCount)
                                                <option value="{{ $airline }}" {{ request('supplier') == $airline?'selected' : '' }}>
                                                    {{ $airline }}
                                                </option>
                                                @endforeach
                                            </select>     
                                    </div>


                                    <!-- <div>
                                        <label for="payment_method" class="block text-sm font-medium text-gray-700">Agency</label>
                                        <select name="agencyid" id="agencyid" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                            <option value="">All Agency</option>
                                            @foreach($agencies as $agency)
                                                <option value="{{ $agency->id }}" {{ request('agencyid') == $agency->id?'selected' : '' }}>
                                                    {{ $agency->name }}
                                                </option>
                                                @endforeach
                                        </select>     
                                    </div> -->


                                

                                
                                </div>

                                <!-- Filter Actions -->
                                <div class="flex justify-between items-center mt-4">
                                    <div class="flex gap-2">
                                        <button type="submit" class="bg-success text-white px-4 py-2 rounded-md hover:bg-success/90">
                                            Apply Filters
                                        </button>
                                        <a href="{{ route('flight.booking') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
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
                                        <a href="{{ route('superadmin.flightexportexcel') }}?{{ http_build_query(request()->all()) }}" 
                                        class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                            Export CSV
                                        </a>
                                        <a href="{{ route('superadmin.flightexportpdf') }}?{{ http_build_query(request()->all()) }}"
                                            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                                Export PDF
                                            </a>
                                    </div>
                                </div>
                     </form> --}}
            
       

                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                <tr>
                        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>          
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice No.</td>
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Service</td>            
                         <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md"> Amount</td>
                        <td class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                    </tr>

                    
                    @forelse($invoices as $invoice)

                                <tr>
                                    <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>                         
                                    <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">
                                   {{$invoice['invoice_number']}}  </td> 
                                    <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">{{$invoice->service_name['name']}}</td>
                                    <td class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm">£ {{$invoice['amount']}}</td>
                                    <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                        <div class="flex gap-2 items-center">
                                                <a href="{{route('cancelinvoice.edit',['id' => $invoice->id])}}" title="Edit">
                                                    <div
                                                        class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                                        <i class="fa fa-pen"></i>
                                                    </div>
                                                </a>
                                        </div>
                                    </td>
                             </tr>


                            @empty
                                <tr>
                                    <td colspan="6" class="border-[1px] border-secondary/50  px-4 py-1 text-ternary/80 font-medium text-sm text-center">No Record Found</td>
                                </tr>
                            @endforelse


                </table>
            </div>
             {{--        === table section code ends here===--}}

    </div>
</x-front.layout>
