<x-agency.layout>
    @section('title') Visa Application Invoice @endsection

    <div class="w-full relative">
        <img class="absolute -top-20 left-0 w-full opacity-20" style="z-index: -1" src="{{asset('assets/images/bgImage.png')}}" alt="">

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if(session('success'))
                <div class="mb-6 px-4 py-3 rounded-lg bg-green-100 border border-green-200 text-green-700 font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                {{-- Invoice Header --}}
                <div class="bg-gradient-to-r from-primary to-primaryDarkColor px-8 py-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-white">VISA APPLICATION INVOICE</h1>
                            <div class="flex items-center mt-2 text-white/90">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm">Issued on {{ $clientData->created_at->format('d M Y') ?? date('d M Y') }}</span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white border border-white/30">
                                #{{ $clientData->invoice_number ?? 'VISA-'.date('YmdHis') }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Invoice Content --}}
                <div class="p-8">
                    {{-- Agency and Client Info --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <div class="flex items-center mb-6">
                                @if(isset($clientData->agency->profile_picture))
                                    <img src="{{ asset('images/agencies/logo/' . $clientData->agency->profile_picture) }}" alt="Agency Logo" class="h-16 mr-4" />
                                @else
                                    <img src="{{ asset('images/agencies/logo/default.png') }}" alt="Agency Logo" class="h-16 mr-4" />
                                @endif
                                <div>
                                    <h2 class="text-lg font-bold text-gray-800">ISSUED BY</h2>
                                    <p class="text-sm">{{ $clientData->agency->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="text-sm space-y-1">
                                <p>{{ $clientData->agency->address ?? 'N/A' }}</p>
                                <p>{{ $clientData->agency->country ?? 'N/A' }}</p>
                                <p><strong>TEL:</strong> {{ $clientData->agency->phone ?? 'N/A' }}</p>
                                <p><strong>EMAIL:</strong> {{ $clientData->agency->email ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-gray-800 mb-2">BILL TO</h2>
                            <div class="text-sm space-y-1">
                                <p class="font-medium">{{ $clientData->clint->client_name ?? 'N/A' }}</p>
                                <p>{{ $clientData->clint->address ?? 'N/A' }}</p>
                                <p>{{ $clientData->clint->country ?? 'N/A' }}</p>
                                <p><strong>TEL:</strong> {{ $clientData->clint->phone_number ?? 'N/A' }}</p>
                                <p><strong>EMAIL:</strong> {{ $clientData->clint->email ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Application Summary --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-800 border-b border-gray-200 pb-2 mb-4">VISA APPLICATION DETAILS</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-500 uppercase font-medium">Application Number</p>
                                <p class="font-semibold">{{ $clientData->application_number ?? 'N/A' }}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-500 uppercase font-medium">Visa Type</p>
                                <p class="font-semibold">{{ $clientData->visa->name ?? 'N/A' }}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-500 uppercase font-medium">Processing Time</p>
                                <p class="font-semibold">7-10 business days</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-500 uppercase font-medium">Travel From</p>
                                <p class="font-semibold">{{ $clientData->origin->countryName ?? 'N/A' }}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-500 uppercase font-medium">Travel To</p>
                                <p class="font-semibold">{{ $clientData->destination->countryName ?? 'N/A' }}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-500 uppercase font-medium">Status</p>
                                <p class="font-semibold text-yellow-600">Payment Pending</p>
                            </div>
                        </div>
                    </div>

                    {{-- Applicant Details --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-800 border-b border-gray-200 pb-2 mb-4">APPLICANT DETAILS</h3>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Passport</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nationality</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Birth</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">1</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">PRIMARY</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $clientData->clint->client_name ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $clientData->passport_number ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $clientData->clint->country ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $clientData->clint->dob ? date('d M Y', strtotime($clientData->clint->dob)) : 'N/A' }}</td>
                                </tr>
                                @foreach($clientData->otherclients as $index => $otherclient)
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $index + 2 }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">DEPENDENT</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $otherclient->lastname }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $otherclient->passport_number ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $otherclient->nationality ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">{{ $otherclient->dob ? date('d M Y', strtotime($otherclient->dob)) : 'N/A' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Payment Details --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-800 border-b border-gray-200 pb-2 mb-4">PAYMENT DETAILS</h3>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">Visa Application Fee</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">1</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">£{{ number_format($clientData->visa_fee ?? 0, 2) }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">£{{ number_format($clientData->visa_fee ?? 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">Service Fee</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">1</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">£{{ number_format($clientData->service_fee ?? 0, 2) }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">£{{ number_format($clientData->service_fee ?? 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">Tax</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">1</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">£{{ number_format($clientData->tax ?? 0, 2) }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">£{{ number_format($clientData->tax ?? 0, 2) }}</td>
                                </tr>
                                <tr class="bg-gray-50 font-bold">
                                    <td class="px-4 py-3 whitespace-nowrap text-sm" colspan="3">TOTAL AMOUNT DUE</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-primary">£{{ number_format($clientData->total_amount ?? 0, 2) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Notes and Requirements --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 border-b border-gray-200 pb-2 mb-4">IMPORTANT NOTES</h3>
                            <ul class="list-disc pl-5 space-y-2 text-sm text-gray-600">
                                <li>This invoice is valid for payment within 7 days from the date of issue.</li>
                                <li>Your visa application will be processed only after full payment is received.</li>
                                <li>All fees are non-refundable once the application has been submitted.</li>
                                <li>Processing times are estimates and not guaranteed by our agency.</li>
                                <li>Additional documents may be requested during processing.</li>
                                <li>Approval of visa applications is at the sole discretion of the embassy.</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 border-b border-gray-200 pb-2 mb-4">REQUIRED DOCUMENTS</h3>
                            <ul class="list-disc pl-5 space-y-2 text-sm text-gray-600">
                                <li>Original passport with at least 6 months validity</li>
                                <li>Passport-size photographs (2 recent, white background)</li>
                                <li>Proof of accommodation (hotel bookings or invitation letter)</li>
                                <li>Travel itinerary (flight reservations)</li>
                                <li>Proof of financial means (bank statements for last 3 months)</li>
                                <li>Travel insurance covering the entire stay</li>
                                <li>Employment letter or business registration documents</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="mt-12 pt-6 border-t border-gray-200 text-center">
                        <p class="text-sm text-gray-600">Thank you for choosing our visa services.</p>
                        <p class="text-sm font-bold mt-2 text-gray-800">{{ $clientData->agency->name ?? 'Our Agency' }}</p>
                        <p class="text-xs mt-4 text-gray-500">This is computer generated invoice and does not require signature.</p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row justify-center gap-4">
                    <button id="printInvoice" class="bg-primary hover:bg-primaryDarkColor text-white px-6 py-2 rounded-lg transition flex items-center justify-center" onclick="
                        var printContents = document.getElementById('invoiceContainer').innerHTML;
                        var originalContents = document.body.innerHTML;
                        document.body.innerHTML = printContents;
                        window.print();
                        document.body.innerHTML = originalContents;
                    ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Print Invoice
                    </button>
                    <button class="bg-secondary hover:bg-secondary/90 text-white px-6 py-2 rounded-lg transition flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Make Payment
                    </button>
                </div>
            </div>
        </div>
    </div>




        <div class="bg-white shadow-md shadow-ternary/20 border-[2px] border-ternary/30 rounded-lg w-[772px]" style="padding: 50px; display: none" id="invoiceContainer">
            <div class="flex items-center flex-col justify-between ">
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
</x-agency.layout>











