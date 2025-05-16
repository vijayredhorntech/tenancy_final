<x-agency.layout>
    @section('title')
        Visa Application Invoice
    @endsection

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        @if(session('success'))
            <div class="px-4 py-2 rounded-sm bg-success/40 text-success border-[1px] border-success/50 font-semibold">
               * {{ session('success') }}
            </div>
        @endif
       
        {{-- Heading Section --}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">{{ $clientData->invoice_number ?? 'VISA-'.date('YmdHis') }}</span>
        </div>

        <div class="bg-white shadow-md shadow-ternary/20 border-[2px] border-ternary/30 rounded-lg px-16 w-[772px] py-12" id="invoiceContainer">
            <div class="flex items-center flex-col justify-between">
                <div class="flex items-center border-b-[2px] border-gray-700 w-full">
                    @if(isset($clientData->agency->profile_picture))
                        <img src="{{ asset('images/agencies/logo/' . $clientData->agency->profile_picture) }}" alt="Agency Logo" class="h-24 mr-4" />
                    @else
                        <img src="{{ asset('images/agencies/logo/default.png') }}" alt="Agency Logo" class="h-24 mr-4" />
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2 mt-4">
                <div class="w-full flex">
                    <h1 class="text-2xl font-bold">VISA APPLICATION INVOICE</h1>
                </div>
                <div class="w-full text-right flex flex-col">
                    <div class="flex justify-end items-center">
                        <h1 class="font-bold text-sm">Invoice Date:</h1>
                        <span class="font-normal text-sm ml-2">{{ $clientData->created_at->format('d M Y') ?? date('d M Y') }}</span>
                    </div>
                    <div class="flex justify-end items-center">
                        <h1 class="font-bold text-sm">Invoice No:</h1>
                        <span class="font-normal text-sm ml-2">{{ $clientData->invoice_number ?? 'VISA-'.date('YmdHis') }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 grid grid-cols-2">
                <div class="w-full">
                    <h2 class="text-lg font-bold text-primary">APPLICANT DETAILS</h2>
                    <p class="text-sm">{{ $clientData->clint->client_name ?? 'N/A' }}</p>
                    <p class="text-sm">{{ $clientData->clint->address ?? 'N/A' }}</p>
                    <p class="text-sm">{{ $clientData->clint->country ?? 'N/A' }}</p>
                    <p class="text-sm"><strong>TEL:</strong> {{ $clientData->clint->phone_number ?? 'N/A' }}</p>
                    <p class="text-sm"><strong>E-MAIL:</strong> {{ $clientData->clint->email ?? 'N/A' }}</p>
                </div>

                <div class="w-full text-right">
                    <h2 class="text-lg font-bold text-primary">ISSUED BY</h2>
                    <p class="text-sm">{{ $clientData->agency->name ?? 'N/A' }}</p>
                    <p class="text-sm">{{ $clientData->agency->address ?? 'N/A' }}</p>
                 {{--   <p class="text-sm">{{ $agency_address->city ?? '' }}{{ ($agency_address->city && $agency_address->state) ? ', ' : '' }}{{ $agency_address->state ?? '' }}</p>
                 --}}
                 <p class="text-sm">{{ $clientData->agency->country ?? 'N/A' }}</p>
                    <p class="text-sm">{{ $agency_address->zipcode ?? 'N/A' }}</p>
                    <p class="text-sm"><strong>TEL:</strong> {{ $clientData->agency->phone ?? 'N/A' }}</p>
                    <p class="text-sm"><strong>E-MAIL:</strong> {{ $clientData->agency->email ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="mt-4 w-full">
                <h2 class="text-md font-bold bg-primary p-3 w-max text-white">VISA APPLICATION DETAILS</h2>

                <h3 class="text-md font-bold text-black mt-6">1. Application Summary</h3>
                <div class="grid grid-cols-3 gap-4 mt-2">
                    <div class="bg-gray-50 p-3 rounded border border-gray-200">
                        <p class="text-sm text-gray-600">Application Number</p>
                        <p class="font-semibold">{{ $clientData->application_number ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200">
                        <p class="text-sm text-gray-600">Visa Type</p>
                        <p class="font-semibold">{{ $clientData->visa->name ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200">
                        <p class="text-sm text-gray-600">Processing Time</p>
                        <p class="font-semibold">7-10 business days</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200">
                        <p class="text-sm text-gray-600">Travel From</p>
                        <p class="font-semibold">{{ $clientData->origin->countryName ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200">
                        <p class="text-sm text-gray-600">Travel To</p>
                        <p class="font-semibold">{{ $clientData->destination->countryName ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200">
                        <p class="text-sm text-gray-600">Status</p>
                        <p class="font-semibold text-yellow-600">Payment Pending</p>
                    </div>
                </div>

                <h3 class="text-md font-bold text-black mt-6">2. Applicant Details</h3>
                <div class="w-full overflow-hidden mt-2">
                    <table class="w-full">
                        <tr class="bg-primary/10 text-black font-bold text-sm">
                            <td class="p-2 border-r border-gray-200">S#</td>
                            <td class="p-2 border-r border-gray-200">Applicant Type</td>
                            <td class="p-2 border-r border-gray-200">Full Name</td>
                            <td class="p-2 border-r border-gray-200">Passport Number</td>
                            <td class="p-2 border-r border-gray-200">Nationality</td>
                            <td class="p-2">Date of Birth</td>
                        </tr>

                        <tr class="text-black text-sm border-b border-gray-200">
                            <td class="p-2">1</td>
                            <td class="p-2">PRIMARY</td>
                            <td class="p-2">{{ $clientData->clint->client_name ?? 'N/A' }}</td>
                            <td class="p-2">{{ $clientData->passport_number ?? 'N/A' }}</td>
                            <td class="p-2">{{ $clientData->clint->country ?? 'N/A' }}</td>
                            <td class="p-2">{{ $clientData->clint->dob ? date('d M Y', strtotime($clientData->clint->dob)) : 'N/A' }}</td>
                        </tr>

                        @foreach($clientData->otherclients as $index => $otherclient)
                        <tr class="text-black text-sm border-b border-gray-200">
                            <td class="p-2">{{ $index + 2 }}</td>
                            <td class="p-2">DEPENDENT</td>
                            <td class="p-2">{{ $otherclient->lastname }}</td>
                            <td class="p-2">{{ $otherclient->passport_number ?? 'N/A' }}</td>
                            <td class="p-2">{{ $otherclient->nationality ?? 'N/A' }}</td>
                            <td class="p-2">{{ $otherclient->dob ? date('d M Y', strtotime($otherclient->dob)) : 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                <h3 class="text-md font-bold text-black mt-6">3. Payment Details</h3>
                <div class="w-full overflow-hidden mt-2">
                    <table class="w-full">
                        <tr class="bg-primary/10 text-black font-bold text-sm">
                            <td class="p-2 border-r border-gray-200">Description</td>
                            <td class="p-2 border-r border-gray-200">Quantity</td>
                            <td class="p-2 border-r border-gray-200">Unit Price</td>
                            <td class="p-2">Amount</td>
                        </tr>

                        <tr class="text-black text-sm border-b border-gray-200">
                            <td class="p-2">Visa Application Fee</td>
                            <td class="p-2">1</td>
                            <td class="p-2">£{{ number_format($clientData->visa_fee ?? 0, 2) }}</td>
                            <td class="p-2">£{{ number_format($clientData->visa_fee ?? 0, 2) }}</td>
                        </tr>

                        <tr class="text-black text-sm border-b border-gray-200">
                            <td class="p-2">Service Fee</td>
                            <td class="p-2">1</td>
                            <td class="p-2">£{{ number_format($clientData->service_fee ?? 0, 2) }}</td>
                            <td class="p-2">£{{ number_format($clientData->service_fee ?? 0, 2) }}</td>
                        </tr>

                        <tr class="text-black text-sm border-b border-gray-200">
                            <td class="p-2">Tax</td>
                            <td class="p-2">1</td>
                            <td class="p-2">£{{ number_format($clientData->tax ?? 0, 2) }}</td>
                            <td class="p-2">£{{ number_format($clientData->tax ?? 0, 2) }}</td>
                        </tr>

                        <tr class="text-black text-sm font-bold bg-gray-100">
                            <td class="p-2" colspan="3">TOTAL AMOUNT DUE</td>
                            <td class="p-2">£{{ number_format($clientData->total_amount ?? 0, 2) }}</td>
                        </tr>
                    </table>
                </div>

                <div class="mt-6">
                    <h3 class="text-md font-bold text-black">4. Important Notes</h3>
                    <ul class="list-disc pl-6 mt-2 text-sm">
                        <li>This invoice is valid for payment within 7 days from the date of issue.</li>
                        <li>Your visa application will be processed only after full payment is received.</li>
                        <li>All fees are non-refundable once the application has been submitted to the embassy.</li>
                        <li>Processing times are estimates and not guaranteed by our agency.</li>
                        <li>Additional documents may be requested by the embassy during processing.</li>
                        <li>Approval of visa applications is at the sole discretion of the embassy/consulate.</li>
                    </ul>
                </div>

                <div class="mt-8">
                    <h3 class="text-md font-bold text-black">5. Required Documents</h3>
                    <ul class="list-disc pl-6 mt-2 text-sm">
                        <li>Original passport with at least 6 months validity</li>
                        <li>Passport-size photographs (2 recent, white background)</li>
                        <li>Proof of accommodation (hotel bookings or invitation letter)</li>
                        <li>Travel itinerary (flight reservations)</li>
                        <li>Proof of financial means (bank statements for last 3 months)</li>
                        <li>Travel insurance covering the entire stay</li>
                        <li>Employment letter (if employed) or business registration (if self-employed)</li>
                    </ul>
                </div>

                <div class="mt-12 text-center">
                    <p class="text-sm">Thank you for choosing our visa services.</p>
                    <p class="text-sm font-bold mt-2">{{ $clientData->agency->name ?? 'Our Agency' }}</p>
                    <p class="text-xs mt-4">This is computer generated invoice and does not require signature.</p>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-4 gap-4">
            <button id="printInvoice" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primaryDarkColor transition" onclick="
                var printContents = document.getElementById('invoiceContainer').innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            ">
                Print Invoice
            </button>
            <button class="bg-secondary text-white px-4 py-2 rounded-md hover:bg-secondary/90 transition">
                Make Payment
            </button>
        </div>
    </div>
</x-agency.layout>