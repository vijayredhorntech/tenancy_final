<div class="w-full relative">
    <img class="absolute -top-20 left-0 w-full opacity-20" style="z-index: -1" src="{{asset('assets/images/bgImage.png')}}" alt="">

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Visa Information Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-primary to-secondary p-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-white">Visa Details</h1>
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
                            View Details
                        </span>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-1">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Visa Type</label>
                                <p class="text-gray-800 font-medium text-lg">{{ $visa->name ?? 'Visa Name Not Available' }}</p>
                            </div>

                            
                         
                            </div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Total Country Assign </label>
                                <p class="text-gray-800 font-medium">{{ $visa->visaAssignCountries->count() ?? 0 }}</p>
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
                    {!! $visa->description ?? 'No description provided for this visa.' !!}
                    </div>
                </div>

             

            </div>
        </div>
    </div>
</div>