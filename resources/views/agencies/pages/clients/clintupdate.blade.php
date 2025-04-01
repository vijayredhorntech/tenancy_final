<x-agency.layout>
    @section('title')Clint @endsection





        <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

            {{-- === Heading Section === --}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Visa Application Form</span>
            </div>
            {{-- === heading section code ends here===--}}

            {{-- === Form Section === --}}
            <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 p-4">
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('updateclient.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- 1️⃣ Personal Information --}}
                    <div class="w-full flex flex-col gap-2">
                        <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                            <span class="text-lg font-bold text-ternary">1️⃣ Personal Information</span>
                        </div>

                        <div class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="name" class="font-semibold text-ternary/90 text-sm">First Name</label>
                                <input type="hidden" value="{{ $client->id ?? 'N/A' }}" name="clint_id">
                                <div class="w-full relative">
                                    <input type="text" name="name" id="name" placeholder="Enter First Name"
                                           value="{{ $client->name ?? 'N/A' }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('name') border-red-500 @enderror">
                                    <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('name')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="last" class="font-semibold text-ternary/90 text-sm">Last Name</label>
                                <div class="w-full relative">
                                    <input type="text" name="last" id="last" placeholder="Enter Last Name"
                                           value="{{ $client->clientinfo->last_name ?? '' }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('last') border-red-500 @enderror">
                                    <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('last')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="dob" class="font-semibold text-ternary/90 text-sm">Date of Birth</label>
                                <div class="w-full relative">
                                    <input type="date" name="dob" id="dob"
                                           value="{{ $client->clientinfo->dob ?? '' }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('dob') border-red-500 @enderror">
                                    <i class="fa fa-calendar absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('dob')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="gender" class="font-semibold text-ternary/90 text-sm">Gender</label>
                                <div class="w-full relative">
                                    <select name="gender" id="gender"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('gender') border-red-500 @enderror">
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ old('gender', $client->clientinfo->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender', $client->clientinfo->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', $client->clientinfo->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    <i class="fa fa-venus-mars absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('gender')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="marital_status" class="font-semibold text-ternary/90 text-sm">Marital Status</label>
                                <div class="w-full relative">
                                    <select name="marital_status" id="marital_status"
                                            class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('marital_status') border-red-500 @enderror">
                                        <option value="">Select</option>
                                        <option value="single" {{ old('marital_status', $client->clientinfo->marital_status ?? '') == 'single' ? 'selected' : '' }}>Single</option>
                                        <option value="married" {{ old('marital_status', $client->clientinfo->marital_status ?? '') == 'married' ? 'selected' : '' }}>Married</option>
                                        <option value="divorced" {{ old('marital_status', $client->clientinfo->marital_status ?? '') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                        <option value="widowed" {{ old('marital_status', $client->clientinfo->marital_status ?? '') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                    <i class="fa fa-heart absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('marital_status')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="nationality" class="font-semibold text-ternary/90 text-sm">Nationality</label>
                                <div class="w-full relative">
                                    <input type="text" name="nationality" id="nationality" placeholder="Enter nationality"
                                           value="{{ $client->clientinfo->nationality ?? '' }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('nationality') border-red-500 @enderror">
                                    <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('nationality')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="passport_number" class="font-semibold text-ternary/90 text-sm">Passport Number</label>
                                <div class="w-full relative">
                                    <input type="number" name="passport_number" id="passport_number"
                                           value="{{ $client->passport_number ?? '' }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('passport_number') border-red-500 @enderror">
                                    <i class="fa fa-passport absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('passport_number')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="passport_issue_date" class="font-semibold text-ternary/90 text-sm">Passport Issue Date</label>
                                <div class="w-full relative">
                                    <input type="date" name="passport_issue_date" id="passport_issue_date"
                                           value="{{ $client->clientinfo->passport_issue_date ?? '' }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('passport_issue_date') border-red-500 @enderror">
                                    <i class="fa fa-calendar-check absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('passport_issue_date')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="passport_expiry_date" class="font-semibold text-ternary/90 text-sm">Passport Expiry Date</label>
                                <div class="w-full relative">
                                    <input type="date" name="passport_expiry_date" id="passport_expiry_date"
                                           value="{{ $client->clientinfo->passport_expiry_date ?? '' }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('passport_expiry_date') border-red-500 @enderror">
                                    <i class="fa fa-calendar-times absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('passport_expiry_date')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- 2️⃣ Contact Information --}}
                    <div class="w-full flex flex-col gap-2 mt-8">
                        <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                            <span class="text-lg font-bold text-ternary">2️⃣ Contact Information</span>
                        </div>

                        <div class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="email" class="font-semibold text-ternary/90 text-sm">Email Address</label>
                                <div class="w-full relative">
                                    <input type="email" name="email" id="email" placeholder="Enter email"
                                           value="{{ $client->email ?? 'N/A' }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('email') border-red-500 @enderror">
                                    <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('email')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="phone" class="font-semibold text-ternary/90 text-sm">Phone Number</label>
                                <div class="w-full relative">
                                    <input type="text" name="phone" id="phone" placeholder="Enter phone number"
                                           value="{{ $client->phone_number ?? 'N/A' }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('phone') border-red-500 @enderror">
                                    <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('phone')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full relative group flex flex-col gap-1 col-span-2">
                                <label for="residential_address" class="font-semibold text-ternary/90 text-sm">Current Address</label>
                                <div class="w-full relative">
                            <textarea name="residential_address" id="residential_address"
                                      class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('residential_address') border-red-500 @enderror"
                                      placeholder="Enter current address">{{ $client->clientinfo->residential_address ?? '' }}</textarea>
                                    <i class="fa fa-home absolute right-3 top-4 text-sm text-secondary/80"></i>
                                </div>
                                @error('residential_address')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- 3️⃣ Family Details --}}
                    <div class="w-full flex flex-col gap-2 mt-8">
                        <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                            <span class="text-lg font-bold text-ternary">3️⃣ Family Details</span>
                        </div>

                        <div class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="father_name" class="font-semibold text-ternary/90 text-sm">Father's Name</label>
                                <div class="w-full relative">
                                    <input type="text" name="father_name" id="father_name"
                                           value="{{ $client->clientinfo->father_name ?? '' }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('father_name') border-red-500 @enderror">
                                    <i class="fa fa-male absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('father_name')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="mother_name" class="font-semibold text-ternary/90 text-sm">Mother's Name</label>
                                <div class="w-full relative">
                                    <input type="text" name="mother_name" id="mother_name"
                                           value="{{ $client->clientinfo->mother_name ?? '' }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('mother_name') border-red-500 @enderror">
                                    <i class="fa fa-female absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('mother_name')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="spouse_name" class="font-semibold text-ternary/90 text-sm">Spouse's Name</label>
                                <div class="w-full relative">
                                    <input type="text" name="spouse_name" id="spouse_name"
                                           value="{{ old('spouse_name') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                    <i class="fa fa-user-friends absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>

                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="children_count" class="font-semibold text-ternary/90 text-sm">Number of Children</label>
                                <div class="w-full relative">
                                    <input type="number" name="children_count" id="children_count"
                                           value="{{ old('children_count') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                    <i class="fa fa-child absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="w-full flex justify-center px-4 pb-4 gap-2 mt-8">
                        <button type="submit"
                                class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">
                            Update Client
                        </button>
                    </div>
                </form>
            </div>
            {{-- === form section code ends here===--}}
        </div>
</x-agency.layout>