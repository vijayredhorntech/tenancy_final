<div class="w-full relative">
        <img class="absolute -top-20 left-0 w-full opacity-20" style="z-index: -1" src="{{asset('assets/images/bgImage.png')}}" alt="">

        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Application Header --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-primary to-secondary p-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-white">Visa Application #{{ $clientData->application_number ?? 'N/A' }}</h1>
                            <div class="flex items-center mt-2 text-white/90">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm">Submitted on {{ $clientData->created_at ? $clientData->created_at->format('d M Y, h:i A') : 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white border border-white/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Payment Paid
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Progress Steps --}}
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <!-- <div class="flex justify-between items-center">
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white font-bold">1</div>
                            <span class="text-xs mt-1 text-gray-600">Application</span>
                        </div>
                        <div class="flex-1 h-1 bg-gray-200 mx-2">
                            <div class="h-1 bg-primary" style="width: 100%"></div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold">2</div>
                            <span class="text-xs mt-1 text-gray-600">Payment</span>
                        </div>
                        <div class="flex-1 h-1 bg-gray-200 mx-2">
                            <div class="h-1 bg-gray-200" style="width: 0%"></div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold">3</div>
                            <span class="text-xs mt-1 text-gray-600">Processing</span>
                        </div>
                        <div class="flex-1 h-1 bg-gray-200 mx-2">
                            <div class="h-1 bg-gray-200" style="width: 0%"></div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold">4</div>
                            <span class="text-xs mt-1 text-gray-600">Completed</span>
                        </div>
                    </div> -->
                </div>
            </div>

            {{-- Main Content --}}
            <div class="flex flex-col lg:flex-row gap-6">
                {{-- Left Column --}}
                <div class="lg:w-2/3">
                    {{-- Applicant Information --}}
                    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Applicant Information
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row gap-6">
                                <div class="flex-1">
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label>
                                            <p class="text-gray-800 font-medium">{{ $clientData->clint->client_name ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                                            <p class="text-gray-800 font-medium">{{ $clientData->clint->email ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Phone Number</label>
                                            <p class="text-gray-800 font-medium">{{ $clientData->clint->phone_number ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Visa Type</label>
                                            <p class="text-gray-800 font-medium">{{ $clientData->visa->name ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">From</label>
                                            <p class="text-gray-800 font-medium">{{ $clientData->origin->countryName ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">To</label>
                                            <p class="text-gray-800 font-medium">{{ $clientData->destination->countryName ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Travel Group Members --}}
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Travel Group Members
                            </h3>
                        </div>
                        <div class="p-6">

                            @if(count($clientData->otherclients) > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Passport</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Issue Date</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expiry Date</th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($clientData->otherclients as $otherclient)
                                            <tr>
                                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $otherclient->name  ?? 'N/A' }} {{ $otherclient->lastname  ?? 'N/A' }}</td>
                                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $otherclient->passport_number ?? 'N/A' }}</td>
                                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $otherclient->passport_issue_date ?? 'N/A' }}</td>
                                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $otherclient->passport_expire_date ?? 'N/A' }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4 text-gray-500">
                                    No additional members in this application
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Right Column --}}
                <div class="lg:w-1/3">
                    {{-- Payment Summary --}}
                    <div class="bg-white rounded-xl shadow-md overflow-hidden sticky top-6">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Payment Summary
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Visa Fee</span>
                                    <span class="font-medium">£{{ number_format($clientData->visasubtype->price ?? 0, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Service Fee</span>
                                    <span class="font-medium">£{{ number_format($clientData->visasubtype->commission ?? 0, 2) }}</span>
                                </div>

                                @if(isset($clientData->otherclients) && count($clientData->otherclients) > 0)
                                    <div class="border-t border-gray-200 pt-3 mt-3">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Additional Members ({{ count($clientData->otherclients) }})</span>
                                            <span class="font-medium">£{{ number_format(($clientData->visasubtype->price + $clientData->visasubtype->commission) * count($clientData->otherclients), 2) }}</span>
                                        </div>
                                    </div>
                                @endif

                                <div class="border-t border-gray-200 pt-3 mt-3">
                                    <div class="flex justify-between text-lg font-bold">
                                        <span class="text-gray-800">Total Amount</span>
                                        <span class="text-primary">£{{ number_format($clientData->total_amount ?? 0, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 bg-blue-50 border border-blue-100 rounded-lg p-4">
                                <div class="flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <h4 class="font-semibold text-blue-800">Payment Required</h4>
                                        <p class="text-sm text-blue-600 mt-1">Complete your payment to proceed with the visa processing.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 space-y-3">
                            
                                
                               

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>