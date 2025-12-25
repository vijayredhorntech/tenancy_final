<x-agency.layout>
    @section('title') View Application @endsection

    <div class="w-full relative">
        <img class="absolute -top-20 left-0 w-full opacity-20" style="z-index: -1" src="{{ asset('assets/images/bgImage.png') }}" alt="">

        {{-- Errors --}}
        <div class="alert alert-danger" style="display:none;">
            <ul>
                <li>Error message 1</li>
                <li>Error message 2</li>
            </ul>
        </div>

        <form action="#" method="POST" class="w-full">
           @csrf
            <input type="hidden" name="bookingid" value="12345"> 
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Application Header --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-primary to-secondary p-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-white">Visa Application </h1>
                            <div class="flex items-center mt-2 text-white/90">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                             <span class="text-sm">
                                    Submitted on {{ \Carbon\Carbon::parse($requestDatas->created_at)->format('d M Y, h:i A') }}
                                </span>
                            </div>
                        </div>
                        {{-- <div class="mt-4 md:mt-0">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white border border-white/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Payment Pending
                            </span>
                        </div> --}}
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
                                            <p class="text-gray-800 font-medium">{{$requestDatas->full_name}}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                                            <p class="text-gray-800 font-medium">{{$requestDatas->email}}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Phone Number</label>
                                            <p class="text-gray-800 font-medium">{{$requestDatas->phone_number}}</p>
                                        </div>

                                         <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Service</label>
                                            <p class="text-gray-800 font-medium">{{$requestDatas->service_type}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Visa Type</label>
                                            <p class="text-gray-800 font-medium">{{$requestDatas->visa->name}}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">From</label>
                                            <p class="text-gray-800 font-medium flex items-center gap-2">
                                                 <img src="{{ asset('assets/flags/64x48/' . strtolower($requestDatas->combination->origincountry->countryCode) . '.png') }}" 
                                                    alt="{{ $requestDatas->combination->origincountry->countryCode }}" 
                                                    class="w-5 h-4 object-cover rounded-sm" />
                                                {{$requestDatas->combination->origincountry->countryName}}
                                            </p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">To</label>
                                            <p class="text-gray-800 font-medium flex items-center gap-2">
                                                 <img src="{{ asset('assets/flags/64x48/' . strtolower($requestDatas->combination->destinationcountry->countryCode) . '.png') }}" 
                                                    alt="{{ $requestDatas->combination->destinationcountry->countryCode }}" 
                                                    class="w-5 h-4 object-cover rounded-sm" />
                                                {{$requestDatas->combination->destinationcountry->countryName}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Travel Group Members --}}
                    {{-- <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Travel Family Members
                            </h3>
                        </div>

                     <div class="p-6">
                        <div class="mb-4 flex items-center space-x-2">
                            <input type="checkbox" id="selfApplyAll" value="yes" checked name="selfapply" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="selfApplyAll" class="text-sm font-medium text-gray-700">Apply for self</label>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Select</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Passport</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Issue Date</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expiry Date</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-3">
                                            <input type="checkbox" value="1" checked name="othermember[0]" class="self-apply-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded">
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">Jane Smith</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">P123456789</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">2020-01-01</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">2030-01-01</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3">
                                            <input type="checkbox" value="2" checked name="othermember[1]" class="self-apply-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded">
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">Robert Johnson</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">P987654321</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">2019-05-05</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">2029-05-05</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                 </div> --}}
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
                                    <span class="font-medium">£{{$requestDatas->visasubtype->price}}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Service Fee</span>
                                    <span class="font-medium">£{{$requestDatas->visasubtype->commission}}</span>
                                </div>

                                <div class="border-t border-gray-200 pt-3 mt-3">
                                    {{-- <div class="flex justify-between">
                                        <span class="text-gray-600">Additional Members (2)</span>
                                        <span class="font-medium">£400.00</span>
                                    </div> --}}
                                </div>

                                <div class="border-t border-gray-200 pt-3 mt-3">
                                    <div class="flex justify-between text-lg font-bold">
                                        <span class="text-gray-800">Total Amount</span>
                                       <span class="text-primary">
                                            £{{ number_format($requestDatas->visasubtype->price + $requestDatas->visasubtype->commission, 2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                      

                            <div class="mt-6 space-y-3">
                                  <a href="{{ route('applications.proceed', $requestDatas->id) }}"
                                        class="block w-full border border-gray-300 text-gray-700 font-medium py-3 px-4 rounded-lg text-center transition duration-200 hover:bg-gray-50 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"/>
                                            </svg>
                                            Proceed Application
                                        </a>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </form>  
</div>
</x-agency.layout>
