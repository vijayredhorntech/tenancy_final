<x-agency.layout>
    @section('title') Visa Application @endsection

    <div class="w-full max-w-6xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden">
        {{-- Header Section with Status Indicator --}}
        <div class="bg-gradient-to-r from-primary to-primaryDarkColor px-8 py-6 relative">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                <div>
                    <h1 class="text-3xl font-bold text-white">Visa Application Details</h1>
                    <p class="text-white/90 text-sm mt-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Submitted on {{ $clientData->created_at ? $clientData->created_at->format('d M Y, h:i A') : 'N/A' }}
                    </p>
                </div>
                <div class="flex flex-col md:flex-row items-start md:items-center space-y-2 md:space-y-0 md:space-x-3">
                    <span class="bg-white/20 px-4 py-1.5 rounded-full text-sm font-semibold text-white shadow-sm">
                        #{{ $clientData->application_number ?? 'N/A' }}
                    </span>
                    <span class="px-4 py-1.5 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800 shadow-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Payment Pending
                    </span>
                </div>
            </div>
            
            {{-- Progress Steps --}}
           

        {{-- Main Content --}}
        <div class="p-8">
            {{-- Applicant Information Card --}}
            <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 mb-8 border border-gray-100 shadow-md">
                <div class="flex flex-col md:flex-row items-start md:items-center mb-6">
                    <div class="bg-primary/10 p-3 rounded-xl mr-5 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $clientData->clint->client_name ?? 'N/A' }}</h2>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mt-2">
                            <p class="text-gray-600 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ $clientData->clint->email ?? 'N/A' }}
                            </p>
                            <p class="text-gray-600 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                {{ $clientData->clint->phone_number ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Visa Type</p>
                        <p class="font-semibold text-gray-800 mt-1">{{ $clientData->visa->name ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Origin</p>
                        <p class="font-semibold text-gray-800 mt-1">{{ $clientData->origin->countryName ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Destination</p>
                        <p class="font-semibold text-gray-800 mt-1">{{ $clientData->destination->countryName ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Application Date</p>
                        <p class="font-semibold text-gray-800 mt-1">{{ $clientData->created_at ? $clientData->created_at->format('d M Y') : 'N/A' }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Total Fee</p>
                        <p class="font-semibold text-primary mt-1">£{{ number_format($clientData->total_amount ?? 0, 2) }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Visa Subtype</p>
                        <p class="font-semibold text-gray-800 mt-1">{{ $clientData->visasubtype->name ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Validity</p>
                        <p class="font-semibold text-gray-800 mt-1">{{ $clientData->visasubtype->validity ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Processing Time</p>
                        <p class="font-semibold text-gray-800 mt-1">{{ $clientData->visasubtype->processing ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            {{-- Payment Summary Card --}}
            <div class="bg-white rounded-xl border border-gray-200 shadow-md mb-8 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Payment Summary
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">Visa Fee</span>
                            <span class="font-medium">£{{ number_format($clientData->visasubtype->price ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-gray-600">Service Fee</span>
                            <span class="font-medium">£{{ number_format($clientData->visasubtype->commission ?? 0, 2) }}</span>
                        </div>
                        
                        @if(isset($clientData->otherclients) && count($clientData->otherclients) > 0)
                            @php
                                $price = $clientData->visasubtype->price ?? 0;
                                $commission = $clientData->visasubtype->commission ?? 0;
                                $tax = ($price + $commission) * 0.10;
                                $total = $price + $commission;
                                $totalMembers = count($clientData->otherclients);
                                $totalAmount = $total * $totalMembers;
                            @endphp
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-600">Total Members ({{$totalMembers}})</span>
                                <span class="font-medium">£{{ number_format($totalAmount, 2) }}</span>
                            </div>
                        @endif

                        <div class="flex justify-between text-lg font-bold pt-4">
                            <span class="text-gray-800">Total Amount</span>
                            <span class="text-primary text-xl">£{{ number_format($clientData->total_amount ?? 0, 2) }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 bg-blue-50/80 border border-blue-200 rounded-xl p-4 backdrop-blur-sm">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="font-semibold text-blue-800 mb-1">Payment Required</h4>
                                <p class="text-sm text-blue-700">Your application will be processed only after successful payment. Please complete the payment to proceed with your visa application.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Other Members Section --}}
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-5 pb-3 border-b border-gray-200 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Travel Group Members
                </h3>

                <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-md">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Passport Number</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Issue Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expiry Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Place of Issue</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($clientData->otherclients as $otherclient)
                                <tr class="hover:bg-gray-50/80 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $otherclient->lastname }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">{{ $otherclient->passport_number ?? '' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $otherclient->passport_issue_date ?? '' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $otherclient->passport_expire_date ?? '' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $otherclient->place_of_issue ?? '' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No additional members in this application</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-10">
                <a href="#" class="inline-flex items-center px-5 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary w-full sm:w-auto justify-center transition-all duration-200 hover:shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                    </svg>
                    Back to Dashboard
                </a>
                
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <!-- 5684.61 -->
                    
                @if($checkBalance)
              <a href="{{route('visaapplication.pay',['id'=>$clientData->id])}}">
              <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-secondary hover:bg-secondary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary w-full sm:w-auto justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Pay Now
                    </button>
                </a>
                @else
                <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-secondary hover:bg-secondary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary w-full sm:w-auto justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Insufficient Balance
                    </button>
            
                @endif 
                            
                    </div>
            </div>
        </div>
    </div>
</x-agency.layout>