<x-agency.layout>
    @section('title') Visa Application @endsection

    <div class="w-full relative">
        <img class="absolute -top-20 left-0 w-full opacity-20" style="z-index: -1" src="{{asset('assets/images/bgImage.png')}}" alt="">
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <form action="{{ route('visaapplication.pay', ['id' => $clientData->id]) }}" method="POST" class="w-full">
           @csrf
            <input type="hidden" name="bookingid" value="{{$clientData->id}}"> 
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
                                Payment Pending
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Progress Steps --}}
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
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
                    </div>
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
                                <div class="space-y-4">
                                    @foreach($clientData->otherclients as $index => $otherclient)
                                 
                         
                                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-primary transition-colors duration-200">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <div class="flex items-center mb-3">
                                                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center mr-3">
                                                            <span class="text-primary font-bold">{{ $index + 1 }}</span>
                                                        </div>
                                                        <div>
                                                            <h4 class="text-base font-semibold text-gray-800">{{ $otherclient->name ?? 'N/A' }} {{ $otherclient->lastname ?? '' }}</h4>
                                                            <p class="text-sm text-gray-500">Travel Group Member</p>
                                                        </div>
                                                    </div>
                                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ml-13">
                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-500 mb-1">Passport Number</label>
                                                            <p class="text-sm text-gray-800 font-medium">{{ $otherclient->passport_number ?? 'N/A' }}</p>
                                                        </div>
                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-500 mb-1">Nationality</label>
                                                            <p class="text-sm text-gray-800 font-medium">{{ $otherclient->citizenship ?? 'N/A' }}</p>
                                                        </div>
                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-500 mb-1">Phone Number</label>
                                                            <p class="text-sm text-gray-800 font-medium">{{ $otherclient->phone ?? 'N/A' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <p class="text-gray-500 font-medium">No additional members in this application</p>
                                    <p class="text-sm text-gray-400 mt-1">Only the main applicant is included</p>
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
                                        <span class="text-primary">£{{ number_format($clientData->total_amount ?? 0, 2) }} </span>
                                    </div>
                                    
                            
                                </div>

                                  <div class="border-t border-gray-200 pt-3 mt-3">
                                    <div class="flex justify-between text-lg font-bold">
                                        <span class="text-success">Old Visa Amount</span>
                                        <span class="text-success">£{{ number_format($amendmentHistory->total_price ?? 0, 2) }} </span>
                                    </div>
                                    
                            
                                </div>

                                @php
                                    $grandTotal = ($clientData->total_amount ?? 0) - ($amendmentHistory->total_price ?? 0);
                                @endphp

                                
                                  <div class="border-t border-gray-200 pt-3 mt-3">
                                    <div class="flex justify-between text-lg font-bold">
                                        <span class="text-gray-800">Grand Total</span>
                                        <span class="text-primary">£{{ number_format($grandTotal, 2) }} </span>
                                    </div>
                                    
                            
                                </div>
                            </div>

                   

                            <div class="mt-6 space-y-3">
                                @if($checkBalance)
                               {{--  <a href="{{route('visaapplication.pay',['id'=>$clientData->id])}}" class="block w-full bg-secondary hover:bg-secondary/90 text-white font-bold py-3 px-4 rounded-lg text-center transition duration-200 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        Pay Now
                                    </a> --}}
                                   
                                  
                                    @if(isset($clientData->visaDocSign->docsign) && $clientData->visaDocSign->docsign->status=="signed")
                                      <button type="submit" class="block w-full bg-secondary hover:bg-secondary/90 text-white font-bold py-3 px-4 rounded-lg text-center transition duration-200 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        Pay Now
                                    </button>
                                    @else

                                    @if(!isset($clientData->visaDocSign->docsign))
                                    <a href="{{ route('send.docsign', [
                                        'id' => $clientData->id,
                                        'type' => 'Visa'
                                            ]) }}"
                                            class="w-full bg-secondary hover:bg-secondary/90 text-white font-bold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center text-center"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                                            </svg>
                                            Generate Doc Sign
                                        </a>
                                    @else
                                    <a href="{{ route('senddocdocument.email', $clientData->visaDocSign->docsign->id) }}">
                                            <button type="button"
                                                    class="w-full bg-secondary hover:bg-secondary/90 text-white font-bold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center text-center">
                                                
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                                                            </svg>
                                                    Resend Email 
                                            </button>
                                    </a>
                     
                                    
                                        <button type="button"
                                                onclick="copyToClipboard('{{ route('document.sign', $clientData->visaDocSign->docsign->signing_token) }}')"
                                                class="w-full bg-secondary hover:bg-secondary/90 text-white font-bold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center text-center"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                                                </svg>
                                                Copy URL
                                        </button>

                     

                                    @endif
               
                                        @endif
                           
                                @else
                                    <button class="w-full bg-gray-400 cursor-not-allowed text-white font-bold py-3 px-4 rounded-lg text-center flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        Insufficient Balance
                                    </button>
                                    <p class="text-sm text-red-500 text-center">Please contact administrator to add funds</p>
                                @endif

                                <a href="{{ route('agency_dashboard') }}" class="block w-full border border-gray-300 text-gray-700 font-medium py-3 px-4 rounded-lg text-center transition duration-200 hover:bg-gray-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                                    </svg>
                                    Back to Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>  
    </div>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function () {
                alert('URL copied to clipboard!');
            }, function (err) {
                console.error('Could not copy text: ', err);
                alert('Failed to copy URL.');
            });
        }
    </script>
    
</x-agency.layout>
