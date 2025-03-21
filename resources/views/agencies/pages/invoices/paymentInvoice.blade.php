<x-agency.layout>
    @section('title')
    Payment_invoice
    @endsection


    <div
        class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        {{-- === this is code for heading section ===--}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">{{$agency_data->invoice_number}} </span>
        </div>

        <div class="w-full overflow-x-auto p-4 ">

            <div class="bg-white shadow-md shadow-ternary/20 border-[2px] border-ternary/30 rounded-lg px-16 w-[772px] py-12" id="invoiceContainer">
                <div class="flex items-center  flex-col justify-between">
                    <div class="flex items-center border-b-[2px] border-gray-700 w-full">
                        <img src="https://cloud-travel.co.uk/software/public/images/logo.png" alt="Cloud Travel"
                            class="h-24 mr-4" />
                    </div>
                </div>



                <div class="grid grid-cols-2 gap-2 mt-4">

                    <div class="w-full flex ">
                        <h1 class="text-2xl font-bold">PAYMENT INVOICE</h1>
                    </div>
                    <div class=" w-full text-left flex flex-col">
                        <div class="flex justify-end items-center">
                            <h1 class="font-bold text-sm ">Invoice Date:</h1>
                            <span class="font-normal text-sm ml-2">{{$agency_data->added_date}}</span>
                        </div>
                        <div class="flex justify-end items-center">
                            <h1 class="font-bold text-sm ">Invoice No:</h1>
                            <span class="font-normal text-sm ml-2">{{$agency_data->invoice_number}}</span>
                        </div>



                    </div>
                </div>
                <div class="mt-4 grid grid-cols-2 ">
                    <div class="w-full ">
                        <h2 class="text-lg font-bold text-[#26ace2]">TO</h2>
                        <p class="text-sm">
                            {{$agency_data->agency->name}}
                        </p>
                        <p class="text-sm">{{$agency_data->agency->address}}</p>
                        <p class="text-sm">{{$agency_data->agency->country}}</p>

                        <p class="text-sm"><strong>TEL:</strong> {{$agency_data->agency->phone}}</p>
                        <p class="text-sm"><strong>E-MAIL:</strong> {{$agency_data->agency->email}} </p>
                    </div>

                    <div class="w-full text-right">
                        <h2 class="text-lg font-bold text-[#26ace2]">ISSUED BY</h2>
                        <p class="text-sm">62 KING STREET,</p>
                        <p class="text-sm">SOUTHALL,</p>
                        <p class="text-sm">MIDDLESEX,</p>
                        <p class="text-sm">UB2 4DB</p>
                        <p class="text-sm"><strong>TEL:</strong> 02035000000</p>
                        <p class="text-sm"><strong>E-MAIL:</strong> info@cloudtravels.co.uk</p>
                    </div>
                </div>
                <div class="mt-4 w-full">

                    <h3 class="text-md font-bold text-black mt-6"> Payment Detail</h3>
                    <div class="w-full overflow-hidden mt-2">
                        <table class="w-full">
                            <tr class="bg-[#aed6f1] text-black font-bold text-sm">
                                <td class="p-1 border-r-[1px] border-gray-100">Transaction Date</td>
                                <td class="p-1 border-r-[1px] border-gray-100">Amount </td>
                                <td class="p-1 border-r-[1px] border-gray-100">Mode of Payment </td>
                                <td class="p-1 border-r-[1px] border-gray-100">Transaction/ Receipt Number </td>


                            </tr>

                            <tr class="text-black text-sm border-b-[1px] border-blue-100">
                                <td class="p-1">{{$agency_data->added_date}}</td>
                                <td class="p-1">{{$agency_data->amount}}</td>
                                <td class="p-1">{{$agency_data->payment_type}}</td>
                                <td class="p-1">{{$agency_data->payment_number}}</td>

                            </tr>
                        </table>
                        <h3 class="text-md font-medium text-[#26ace2] ">Remark - * {{$agency_data->remark}}</h3>

                    </div>
                </div>

                <div class="flex flex-col mt-4">
                    <span>Terms and Conditions</span>
                    <strong>Notes:</strong>
                    {!! $termcondition && $termcondition->description ? $termcondition->description : 'No terms and conditions available.' !!}

                    {{--{!! $termcondition->description ? $termcondition->description : 'No terms and conditions available.' !!}
--}}
                    <span class="mt-20 text-right">Yours Sincerely</span>
                </div>
            </div>

            <div class="flex w-[772px] justify-center mt-16">
                <button id="printInvoice" class="bg-secondary text-white text-sm px-2 py-1 rounded-sm" onclick="
                                var printContents = document.getElementById('invoiceContainer').innerHTML;
                                var originalContents = document.body.innerHTML;

                                document.body.innerHTML = printContents;
                                window.print();
                                document.body.innerHTML = originalContents;
                                ">
                    Print Invoice
                </button>
            </div>

        </div>
    </div>
</x-agency.layout>