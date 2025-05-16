<x-front.layout>
    @section('title')
      Transaction 
    @endsection


    {{--    === this is code for model ===--}}
    <div id="viewServiceModel"
         class="w-full h-full absolute top-0 left-0 bg-white/40 z-20 flex hidden  justify-center items-center cursor-pointer">
        <div
            class="rounded-[3px] bg-white px-8 py-12 shadow-lg shadow-gray-300 border-[2px] border-gray-400/50 max-w-7xl relative">
            <div
                class="absolute top-1 right-1 h-6 w-6 flex rounded-full justify-center items-center bg-danger/30 border-[1px] border-danger/70 text-ternary hover:bg-danger hover:text-white transition ease-in duration-2000"
                onclick="document.getElementById('viewServiceModel').classList.toggle('hidden')">
                <i class="fa fa-xmark"></i>
            </div>
            <span class="font-medium text-lg ">Services for agency  <i class="font-semibold text-secondary"><u>Skyline Tours</u></i></span>

            <div class="w-full grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-3 mt-4">
                <div class="w-full flex justify-center">
                    <span class="font-semibold"># Flight</span>
                </div>
                <div class="w-full flex justify-center">
                    <span class="font-semibold"># Hotel</span>
                </div>
                <div class="w-full flex justify-center">
                    <span class="font-semibold"># Visas</span>
                </div>
            </div>
        </div>
    </div>
    {{--        === model code ends ===--}}
    <div
        class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        {{--        === this is code for heading section ===--}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Approvel List </span>
            <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')"
                    class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">
                Create New Agency
            </button> -->
        </div>
        {{--        === heading section code ends here===--}}



        
        <div class="w-full overflow-x-auto p-4">
        <form id="filter-form" method="GET" action="{{ route('client.account') }}" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <!-- Search -->
                                <div>
                                    <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm"
                                        placeholder="Agency, Invoice, Payment Number">
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
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                        <option value="">All Status</option>
                                        
                                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Complete</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Under Process</option>
                                        <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Rejected</option>

                                    </select>
                                </div>

                                <!-- Payment Method Filter -->
                                <div>
                                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Type</label>
                                    <select name="paymenttype" id="paymenttype" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primaryDark focus:ring-primaryDark sm:text-sm">
                                        <option value="">All</option>
      
                                        <option value="creditcard" {{ request('paymenttype') == 'creditcard' ? 'selected' : '' }}>Credit Card</option>
                                        <option value="debitcard" {{ request('paymenttype') == 'debitcard' ? 'selected' : '' }}>Debit Card</option>
                                        <option value="netbanking" {{ request('paymenttype') == 'netbanking' ? 'selected' : '' }}>Netbanking</option>
                                        <option value="upi" {{ request('paymenttype') == 'upi' ? 'selected' : '' }}>UPI</option>
                                        <option value="cash" {{ request('paymenttype') == 'cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="banktransfer" {{ request('paymenttype') == 'banktransfer' ? 'selected' : '' }}>Bank Transfer</option>
                                        <option value="creditnote" {{ request('paymenttype') == 'creditnote' ? 'selected' : '' }}>Credit Note</option>
                                    </select>

                                </div>


                             

                            
                            </div>

                            <!-- Filter Actions -->
                            <div class="flex justify-between items-center mt-4">
                                <div class="flex gap-2">
                                    <button type="submit" class="bg-success text-white px-4 py-2 rounded-md hover:bg-success/90">
                                        Apply Filters
                                    </button>
                                    <a href="{{ route('client.account') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
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
                <tr>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Agency</td>
                        
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Invoice</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Amount</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Added Date</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Payment Number</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Payment Method</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Payment Received </td>
                        
                      
                </tr>

                @forelse($credits as $request)
            
                    <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000">
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$request->agency->name}}</td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$request->invoice_number}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$request->amount}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$request->added_date}}</td>
                            
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$request->payment_number}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$request->payment_type}}
                                
                            @if($request->paymentstatus == 1 && $request->payment_type == 'creditnote')
                                    <br>
                                    <span class="bg-danger/10 text-danger px-2 py-1 rounded-[3px] font-bold">
                                    Last Date: {{ \Carbon\Carbon::parse($request->creditdate)->format('d-m-Y') }}

                                    </span>
                                @endif
                            </td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">
                                @php
                                            $paymentstatus = $request['paymentstatus'];
                                            $paymentstatusText = $paymentstatus == '1' ? 'Pending' : ($paymentstatus == '0' ? 'Done' : 'Rejected');
                                            $paymentstatusColor = $paymentstatus == '0' ? 'success' : ($paymentstatus == '1' ? 'danger' : 'warning');
                                        @endphp

                                        <span class="bg-{{ $paymentstatusColor }}/10 text-{{ $paymentstatusColor }} px-2 py-1 rounded-[3px] font-bold">
                                            {{ $paymentstatusText }}
                                        </span>
                            </td>

                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                        @php
                                            $status = $request['status'];
                                            $statusText = $status == '0' ? 'Complete' : ($status == '1' ? 'Under Process' : 'Rejected');
                                            $statusColor = $status == '0' ? 'success' : ($status == '1' ? 'warning' : 'danger');
                                        @endphp

                                        <span class="bg-{{ $statusColor }}/10 text-{{ $statusColor }} px-2 py-1 rounded-[3px] font-bold">
                                            {{ $statusText }}
                                        </span>
                                        @if($request->receiptcopy)
                                            <a href="{{ asset('storage/' . $request->receiptcopy) }}" target="_blank">
                                                (View file)
                                            </a>
                                        @endif
                                    </td>
              
                    </tr>

                @empty
                    <tr>
                        <td colspan="9"
                            class="text-center border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                            No Record Found
                        </td>
                    </tr>
                @endforelse


            </table>
        </div>
        {{--        === table section code ends here===--}}
    </div>
</x-front.layout>
