<style>
/* Hide everything by default in print */
@media print {
    body * {
        visibility: hidden;        /* still occupies space but invisible */
    }

    /* Make the invoice and its children visible */
    #viewInvoiceDiv,
    #viewInvoiceDiv * {
        visibility: visible;
    }

    /* Keep the invoice at the top‑left and use full width */
    #viewInvoiceDiv {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    /* Optionally hide buttons or other screen‑only elements */
    .no-print {
        display: none !important;
    }
}
</style>
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
                                            <p class="text-gray-800 font-medium">{{ $clientData->clint->email ?? $clientData->clint->client->email ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Phone Number</label>
                                            <p class="text-gray-800 font-medium">{{ $clientData->clint->phone_number ?? $clientData->clint->client->phone_number ?? 'N/A' }}</p>
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
             
                      {{-- Travel Group Members --}}
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Travel Family Members
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
                                                            <h4 class="text-base font-semibold text-gray-800">{{ $otherclient->client_name ?? 'N/A' }} </h4>
                                                            <p class="text-sm text-gray-500">Travel Group Member</p>
                                                        </div>
                                                    </div>
                                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ml-13">
                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-500 mb-1">Passport Number</label>
                                                            <p class="text-sm text-gray-800 font-medium">{{ $otherclient->passport_ic_number ?? 'N/A' }}</p>
                                                        </div>
                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-500 mb-1">Nationality</label>
                                                      
                                                            <p class="text-sm text-gray-800 font-medium">{{ $otherclient->clientinfo->nationality ?? 'N/A' }}</p>
                                                        </div>
                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-500 mb-1">Phone Number</label>
                                                            <p class="text-sm text-gray-800 font-medium">{{ $otherclient->phone_number ?? 'N/A' }}</p>
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
                                        <span class="text-primary">£{{ number_format($clientData->total_amount ?? 0, 2) }}</span>
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

    
    <div class="flex justify-center mt-4">
  
 </div>