<div>
    @section('title') Visa View @endsection
    <div class="w-full relative">
        <img class="absolute -top-20 left-0 w-full opacity-20" style="z-index: -1" src="{{asset('assets/images/bgImage.png')}}" alt="">

        <span class="text-secondary lg:text-3xl md:text-2xl text-xl font-semibold">Visa to {{$visas['0']->destinationcountry->countryName}}</span>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>     
            </div>
        @endif

        <section class="flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-col sm:flex-col flex-col justify-center w-full mt-6">
            <!-- Left Section -->
            <div class="2xl:w-3/4 xl:w-3/4 lg:w-3/4 md:w-full sm:w-full w-full bg-white shadow-lg shadow-black/10 rounded-md p-4">
                <span class="text-lg text-secondary font-semibold">Visa Details</span>
                
                <form wire:submit.prevent="saveClient" class="mt-4">
                    @csrf

                    <!-- Visa Selection Section -->
                    <div class="flex flex-col">
                        <div class="flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-row sm:flex-row flex-col w-full justify-between mt-2 gap-2">
                            <!-- Visa Category -->
                            <div class="lg:w-[33.3%] md:w-1/3 w-full flex flex-col relative">
                                <label for="visaCategory" class="font-semibold text-gray-800 text-sm">Visa Category</label>
                                <select 
                                    wire:model="selectedVisaCategory"
                                    class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" 
                                    id="visaCategory"
                                >
                                    @forelse($visas as $visaServiceType)
                                        @if ($visaServiceType->VisaServices)
                                            <option value="{{ $visaServiceType->VisaServices->id }}">
                                                {{ $visaServiceType->VisaServices->name }}
                                            </option>
                                        @endif
                                    @empty
                                        <option value="">No Visa Categories Available</option>
                                    @endforelse
                                </select>
                            </div>

                            <!-- Visa Types -->
                            <div class="lg:w-[33.3%] md:w-1/3 w-full flex flex-col relative">
                                <label for="visaType" class="font-semibold text-gray-800 text-sm">Visa Types</label>
                                <select 
                                    wire:model.live="selectedVisaType"
                                    class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" 
                                    id="visaType"
                                >
                                    <option value="">Select Visa Type</option>
                                    @foreach($visaTypes as $type)
                                        <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Processing Time -->
                         <div class="lg:w-[33.3%] md:w-1/3 w-full flex flex-col relative">
                                <label for="processingTime" class="font-semibold text-gray-800 text-sm">Processing Time</label>
                              <input 
                                    type="text" 
                                    class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" 
                                    value="{{ $processingTimes }}" 
                                    disabled
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Client Information Section -->
                    <div class="mt-5 border-[1px] border-secondary/30 p-4">
                        <h3 class="text-secondary font-semibold mb-4">Personal Information</h3>
                        
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 grid-cols-1 gap-4">
                            <!-- First Name -->
                            <div class="w-full flex flex-col">
                                <label for="firstName" class="font-semibold text-gray-800 text-sm">First Name</label>
                                <input 
                                    type="text" 
                                    wire:model="firstName"
                                    class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" 
                                    placeholder="As shown in passport"
                                >
                            </div>
                            
                            <!-- Last Name -->
                            <div class="w-full flex flex-col">
                                <label for="lastName" class="font-semibold text-gray-800 text-sm">Last Name</label>
                                <input 
                                    type="text" 
                                    wire:model="lastName"
                                    class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" 
                                    placeholder="As shown in passport"
                                >
                            </div>
                            
                            <!-- Email -->
                            <div class="w-full flex flex-col">
                                <label for="email" class="font-semibold text-gray-800 text-sm">Email Address</label>
                                <input 
                                    type="email" 
                                    wire:model="email"
                                    class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" 
                                    placeholder="Enter your email"
                                >
                            </div>
                            
                            <!-- Phone Number -->
                            <div class="w-full flex flex-col">
                                <label for="phoneNumber" class="font-semibold text-gray-800 text-sm">Phone Number</label>
                                <input 
                                    type="text" 
                                    wire:model="phoneNumber"
                                    class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" 
                                    placeholder="Enter your phone number"
                                >
                            </div>
                            
                            <!-- Nationality -->
                            <div class="w-full flex flex-col">
                                <label for="nationality" class="font-semibold text-gray-800 text-sm">Nationality</label>
                                <input 
                                    type="text" 
                                    wire:model="nationality"
                                    class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" 
                                    placeholder="Your nationality"
                                >
                            </div>
                            
                            <!-- Zip Code -->
                            <div class="w-full flex flex-col">
                                <label for="zipCode" class="font-semibold text-gray-800 text-sm">Zip/Postal Code</label>
                                <input 
                                    type="text" 
                                    wire:model="zipCode"
                                    class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" 
                                    placeholder="Your zip/postal code"
                                >
                            </div>
                            
                            <!-- Address -->
                            <div class="w-full flex flex-col lg:col-span-2 md:col-span-2">
                                <label for="address" class="font-semibold text-gray-800 text-sm">Address</label>
                                <input 
                                    type="text" 
                                    wire:model="address"
                                    class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" 
                                    placeholder="Your full address"
                                >
                            </div>
                            
                            <!-- City -->
                            <div class="w-full flex flex-col">
                                <label for="city" class="font-semibold text-gray-800 text-sm">City</label>
                                <input 
                                    type="text" 
                                    wire:model="city"
                                    class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" 
                                    placeholder="Your city"
                                >
                            </div>
                            
                            <!-- Date of Entry -->
                            <div class="w-full flex flex-col">
                                <label for="dateOfEntry" class="font-semibold text-gray-800 text-sm">Date of Entry</label>
                                <input 
                                    type="date" 
                                    wire:model="dateOfEntry"
                                    class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"
                                    max="9999-12-31"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="flex w-full justify-end mt-5">
                        <button type="submit" class="cursor-pointer bg-secondary text-gray-100 text-lg py-2 px-5 rounded-md submitbutton">
                            Send For Application
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Section (Price Summary) -->
            <div class="2xl:w-1/4 sticky top-20 xl:w-1/4 lg:w-1/4 md:w-full sm:w-full w-full bg-white shadow-lg shadow-black/10 rounded-sm 2xl:mt-0 xl:mt-0 lg:mt-0 md:mt-2 sm:mt-2 mt-2 2xl:ml-5 xl:ml-5 lg:ml-5 md:ml-0 sm:ml-0 ml-0 h-min p-4">
                <div class="flex flex-col pb-2 border-b-2 border-b-secondary/30">
                    <span class="text-secondary font-semibold text-xl">Basket Details</span>
                </div>
                <div class="flex justify-between mt-3">
                    <span class="text-black text-md font-normal">Visa Fee:</span>
                    <span class="text-secondary text-md font-semibold">₹{{ number_format($priceDetails['visa_fee'], 2) }}</span>
                </div>
                <div class="flex justify-between mt-1.5">
                    <span class="text-black text-md font-normal">Service Fee:</span>
                    <span class="text-secondary text-md font-semibold">₹{{ number_format($priceDetails['service_fee'], 2) }}</span>
                </div>
                <div class="flex justify-between mt-1.5 pb-3 border-b-2 border-b-secondary/30">
                    <span class="text-black text-md">Tax:</span>
                    <span class="text-secondary text-md font-semibold">₹{{ number_format($priceDetails['tax'], 2) }}</span>
                </div>
                <div class="flex justify-between mt-3">
                    <span class="text-black text-md font-normal">Total:</span>
                    <span class="text-secondary text-md font-semibold">₹{{ number_format($priceDetails['total'], 2) }}</span>
                </div>
            </div>
        </section>
    </div>
</div>