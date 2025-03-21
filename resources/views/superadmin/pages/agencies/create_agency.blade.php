<x-front.layout>
    @section('title')
    Agency
    @endsection


    {{-- === this is code for model ===--}}
    <div id="viewServiceModel"
        class="w-full h-full absolute top-0 left-0 bg-white/40 z-20 flex hidden  justify-center items-center cursor-pointer">
        <div
            class="rounded-[3px] bg-white px-8 py-12 shadow-lg shadow-gray-300 border-[2px] border-gray-400/50 max-w-7xl relative">
            <div
                class="absolute top-1 right-1 h-6 w-6 flex rounded-full justify-center items-center bg-danger/30 border-[1px] border-danger/70 text-ternary hover:bg-danger hover:text-white transition ease-in duration-2000"
                onclick="document.getElementById('viewServiceModel').classList.toggle('hidden')">
                <i class="fa fa-xmark"></i>
            </div>
            <span class="font-medium text-lg ">Services for agency <i class="font-semibold text-secondary"><u>Skyline Tours</u></i></span>

            <div class="w-full grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-3 mt-4">
                <div class="w-full flex justify-center">
                    <span class="font-semibold"># Flight</span>
                </div>
                <div class="w-full flex justify-center">
                    <span class="font-semibold"># Hotel</span>
                </div>
                <div class="w-full flex justify-center">
                    <span class="font-semibold"># Visas</span>
                </div>
            </div>
        </div>
    </div>
    {{-- === model code ends ===--}}
    <div
        class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        {{-- === this is code for heading section ===--}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Agency List </span>



        </div>
        {{-- === heading section code ends here===--}}



        {{-- === this is code for form section ===--}}
        <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
            <form action="{{ route('agencies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))

                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <div class="w-full flex flex-col gap-2 px-4 mt-4">
                    <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                        <span class="text-lg font-bold text-ternary">Basic Information</span>
                    </div>
                    <div class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Agency Logo</label>
                            <div class="w-full relative">
                                <input type="file" name="logo" id="name" placeholder="Agency name....."
                                    class="w-full pl-2 pr-8 py-0.5 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-image absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Agency Name</label>
                            <div class="w-full relative">
                                <input type="text" name="name" id="name" placeholder="Agency name....."
                                    value="{{ old('name') }}"
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000 
                                        @error('name') border-red-500 @enderror">
                                <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>

                            {{-- Validation Error Message --}}
                            @error('name')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Vat Number</label>
                            <div class="w-full relative">
                                <input type="text" name="vat_number" id="vat_number" placeholder="Vat ....."
                                    value="{{ old('vat_number') }}"
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                    @error('vat_number') border-red-500 @enderror">
                                <i class="fa fa-file-invoice absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>

                            @error('vat_number')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full relative group flex flex-col gap-2">
                            <label class="font-semibold text-ternary/90 text-sm">Select Services</label>
                            <div class="flex gap-2 flex-wrap">
                                @forelse($services as $service)
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" id="service_{{ $service->id }}" name="services[]"
                                        value="{{ $service->id }}"
                                        class="appearance-none w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px] checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0"
                                        {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                                    <label for="service_{{ $service->id }}"
                                        class="font-semibold text-ternary/90 text-sm flex items-center gap-2">{{ $service->name }}</label>
                                </div>
                                @empty
                                <div class="text-sm text-red-500">No services available</div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
                <div class="w-full flex flex-col gap-2 px-4 mt-8">
                    <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                        <span class="text-lg font-bold text-ternary">Contact Information</span>
                    </div>
                    <div class="w-full grid xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="email" class="font-semibold text-ternary/90 text-sm">Email</label>
                            <div class="w-full relative">
                                <input type="email" name="email" id="email" placeholder="Email....."
                                    value="{{ old('email') }}"
                                    value="{{ old('email') }}"
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                        @error('email') border-red-500 @enderror">
                                <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>

                            @error('email')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Telephone</label>
                            <div class="w-full relative">
                                <input type="number" name="telephone" id="telephone" placeholder="telephone....."
                                    value="{{ old('telephone') }}"
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                    @error('telephone') border-red-500 @enderror">
                                <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>

                            @error('telephone')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Phone</label>
                            <div class="w-full relative">
                                <input type="number" name="agency_phone" id="agency_phone" placeholder="Phone....."
                                    value="{{ old('agency_phone') }}"
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                    @error('agency_phone') border-red-500 @enderror">
                                <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>

                            @error('agency_phone')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Contact Person</label>
                            <div class="w-full relative">
                                <input type="text" name="contact_name" id="contact_name" placeholder="Contact Person Name....."
                                    value="{{ old('contact_name') }}"
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                    @error('contact_name') border-red-500 @enderror">
                                <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>

                            @error('contact_name')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Contact person Phone</label>
                            <div class="w-full relative">
                                <input type="number" name="contact_phone" id="contact_phone"
                                    placeholder="Contact Phone....."
                                    value="{{ old('contact_phone') }}"
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                    @error('contact_phone') border-red-500 @enderror">
                                <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>

                            @error('contact_phone')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="w-full flex flex-col gap-2 px-4 mt-8">
                    <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                        <span class="text-lg font-bold text-ternary">Address Information</span>
                    </div>
                    <div class="w-full grid xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Zip Code</label>
                            <div class="w-full relative">
                                <input type="text" name="zip_code" id="zip_code" placeholder="zip code....."
                                    value="{{ old('zip_code') }}"
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                    @error('zip_code') border-red-500 @enderror">
                                <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>

                                @error('zip_code')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <button id="searchAddress" type="button" class="mt-2 w-full px-4 py-2 bg-secondary text-white font-semibold rounded-md shadow-md hover:bg-secondary/80 transition duration-200 flex items-center justify-center gap-2">
                                <i class="fa fa-search"></i> Search
                            </button>


                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <!-- <div class="address"> </div>  -->
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Address</label>
                            <div class="w-full relative">
                                <input type="text" name="address" id="address" placeholder="Address....."
                                    value="{{ old('address') }}"
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                    @error('address') border-red-500 @enderror">
                                <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>

                            @error('address')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">City</label>
                            <div class="w-full relative">
                                <input type="text" name="city" id="city" placeholder="Phone....."
                                    value="{{ old('city') }}"
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                    @error('city') border-red-500 @enderror">
                                <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>

                            @error('city')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">State</label>
                            <div class="w-full relative">
                                <input type="text" name="state" id="state" placeholder="State....."
                                    value="{{ old('state') }}"
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                    @error('state') border-red-500 @enderror">
                                <i class="fa fa-flag absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>

                            @error('state')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Country</label>
                            <div class="w-full relative">
                                <input type="test" name="country" id="country" placeholder="Country....."
                                    value="{{ old('country') }}"
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                    @error('country') border-red-500 @enderror">
                                <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>

                            @error('country')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="w-full flex flex-col gap-2 px-4 mt-8">
                    <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                        <span class="text-lg font-bold text-ternary">Database Information</span>
                    </div>
                    <div class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Domain Name</label>
                            <div class="w-full relative">
                                <input type="text" name="domain_name" id="domain_name" placeholder="Domain....."
                                    value="{{ old('domain_name') }}"
                                    value="{{ old('domain_name') }}"
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                        @error('domain_name') border-red-500 @enderror">
                                <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>

                            @error('domain_name')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class=" w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Database Name</label>
                            <div class="w-full relative">
                                <input type="text" name="database_name" id="database_name" placeholder="Phone....."
                                    value="{{ old('database_name') }}"
                                    value="{{ old('database_name') }}"
                                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                    @error('database_name') border-red-500 @enderror">
                                <i class="fa fa-database absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>

                            @error('database_name')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- 
                <div class="w-full flex flex-col gap-2 px-4 mt-8">
                    <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                        <span class="text-lg font-bold text-ternary">Document Information</span>
                    </div>
                    <div class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Document name</label>
                            <div class="w-full relative">
                                <input type="text" name="document1" id="document1" placeholder="Document name....."
                                    value="{{ old('document1') }}"
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                       @error('') border-red-500 @enderror">
                                <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>

                            @error('document1')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Attachment</label>
                            <div class="w-full relative">
                                <input type="file" name="attachment1" id="attachment1" placeholder="attachment....."
                                    value="{{ old('attachment1') }}"
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                       @error('') border-red-500 @enderror">
                                <i class="fa fa-database absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>

                            @error('attachment1')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        

                    </div>
                </div> -->



                <div class="w-full flex flex-col gap-2 px-4 mt-8">
                    <!-- Header -->
                    <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                        <span class="text-lg font-bold text-ternary">Document Information</span>
                    </div>


                    <!-- Document Container -->
                    <div id="documentContainer">
                        <!-- Initial Document and Attachment Fields -->
                        <div id="inputGroup1" class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="document1" class="font-semibold text-ternary/90 text-sm">Document Name</label>
                                <div class="w-full relative">
                                    <input type="text" name="document1" id="document1" placeholder="Document name..."
                                        value="{{ old('document1') }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                        @error('document1') border-red-500 @enderror">
                                    <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>

                                @error('dummy')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="attachment1" class="font-semibold text-ternary/90 text-sm">Attachment</label>
                                <div class="w-full relative">
                                    <input type="file" name="file1" id="file1"
                                        value="{{ old('file1') }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                        @error('file1') border-red-500 @enderror">
                                    <i class="fa fa-database absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>

                                @error('file1')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <button id="addDocumentBtn" class="px-4 py-2 bg-blue-500 text-black rounded">Add File</button>

                            <!-- File Inputs Container -->
                            <div id="fileInputContainer" class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2"></div>
                        </div>
                    </div>

                </div>



                <div class="w-full flex justify-end px-4 pb-4 gap-2 mt-8">
                    <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')"
                        class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">
                        Cancel
                    </button>
                    <button type="submit"
                        class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">
                        Create Agency
                    </button>
                </div>

            </form>
        </div>
        {{-- === form section code ends here===--}}


    </div>
    @section('scripts')
    <script>
        $(document).ready(function() {
            $("#searchAddress").on("click", function(e) {
                e.preventDefault(); // Stop the default behavior

                var postcode = $("#zip_code").val().trim(); // Get postcode input

                if (postcode === "") {
                    alert("Please enter a postcode.");
                    return;
                }

                $.ajax({
                    url: `https://api.postcodes.io/postcodes/${postcode}`,
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.status === 200) {
                            let data = response.result;
                            let address = `${data.nuts}, ${data.admin_ward}`;

                            console.log("API Response:", data);

                            let country = data.country;
                            let state = data.region;
                            let city = data.admin_district || data.parish;


                            // Fill the input fields
                            $("#address").val(address);
                            $("#country").val(country);
                            $("#state").val(state);
                            $("#city").val(city);

                        } else {
                            alert("Invalid postcode. Please try again.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching postcode data:", error);
                        alert("Could not fetch postcode data. Please try again.");
                    }
                });

                return false; // Extra safeguard to prevent page refresh
            });
        });
    </script>
    @endsection

</x-front.layout>