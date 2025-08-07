<div class="w-full relative">
    <img class="absolute -top-20 left-0 w-full opacity-20" style="z-index: -1" src="{{asset('assets/images/bgImage.png')}}" alt="">

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Visa Information Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-primary to-secondary p-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-white tracking-wide leading-tight">
                            Visa Combination Details
                        </h1>
                        <div class="flex items-center mt-2 text-white/90">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="text-sm">Visa Information</span>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white border border-white/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            ID: {{ $visaServiceType->id }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-1">
                        <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Origin Country</label>
                            <div class="flex items-center">
                                {{-- Show flag image --}}
                                <img src="{{ $visaServiceType->origincountry->getFlagUrlAttribute() }}" 
                                    alt="Flag" class="w-6 h-4 object-cover mr-2 rounded-sm border" />

                                {{-- Country Name --}}
                                <span class="text-gray-800 font-medium text-lg">
                                    {{ $visaServiceType->origincountry->countryName }}
                                </span>

                                {{-- Country Code --}}
                                <span class="ml-2 px-2 py-1 text-xs bg-gray-100 rounded-md">
                                    {{ $visaServiceType->origincountry->countryCode }}
                                </span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Destination Country</label>
                            <div class="flex items-center">
                                <img src="{{ $visaServiceType->destinationcountry->getFlagUrlAttribute() }}" 
                                    alt="Flag" class="w-6 h-4 object-cover mr-2 rounded-sm border" />

                                <span class="text-gray-800 font-medium text-lg">
                                    {{ $visaServiceType->destinationcountry->countryName }}
                                </span>

                                <span class="ml-2 px-2 py-1 text-xs bg-gray-100 rounded-md">
                                    {{ $visaServiceType->destinationcountry->countryCode }}
                                </span>
                            </div>
                        </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Visa ID</label>
                                <p class="text-gray-800 font-medium">{{ $visaServiceType->VisaServices->name }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <div class="space-y-4">
                            <!-- <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Created At</label>
                                <p class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($visaServiceType->created_at)->format('M d, Y h:i A') }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Updated At</label>
                                <p class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($visaServiceType->updated_at)->format('M d, Y h:i A') }}</p>
                            </div> -->
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $visaServiceType->required ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $visaServiceType->required ? 'Required' : 'Not Required' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description Section -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Description
                    </h3>
                    <div class="prose max-w-none text-gray-700">
                        {!! $visaServiceType->description !!}
                    </div>
                </div>

                <!-- Subvisas Section -->
                @if($visaServiceType->Subvisas && count($visaServiceType->Subvisas) > 0)
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        Visa Subtypes ({{ count($visaServiceType->Subvisas) }})
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($visaServiceType->Subvisas as $subvisa)
                     
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h4 class="font-medium text-gray-800">{{ $subvisa->name ?? 'N/A' }}</h4>
                            <div class="mt-2 text-sm text-gray-600">
                                <div class="flex justify-between">
                                    <span>Processing Time:</span>
                                    <span class="font-medium">{{ $subvisa->processing ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between mt-1">
                                    <span>Validity:</span>
                                    <span class="font-medium">{{ $subvisa->validity ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between mt-1">
                                    <span>Price:</span>
                                    <span class="font-medium">£ {{ $subvisa->price ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between mt-1">
                                    <span>Commission:</span>
                                    <span class="font-medium">£ {{ $subvisa->commission ?? 'N/A' }}</span>
                                </div>

                                <div class="flex justify-between mt-1">
                                    <span>VAT%:</span>
                                    <span class="font-medium">{{ $subvisa->gstin ?? 'N/A' }} %</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>