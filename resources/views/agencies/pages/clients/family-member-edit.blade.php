<x-agency.layout>
    @section('title')Edit Family Member@endsection

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
        {{-- Header --}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Edit Family Member</span>
            <a href="{{ route('agencyview.client', $client->id) }}" class="bg-secondary text-white px-4 py-1 rounded hover:bg-secondary/80">
                <i class="fa fa-arrow-left mr-2"></i>Back to Client
            </a>
        </div>

        {{-- Form --}}
        <form action="{{ route('agency.family-member.update', $familyMemberId) }}" method="POST" class="w-full p-4">
            @csrf
            @method('POST')

            <div class="w-full flex flex-col gap-2">
                <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                    <span class="text-lg font-bold text-ternary">Edit {{ ucfirst($familyMember->relationship) }} Details</span>
                </div>

                <div class="w-full grid xl:grid-cols-2 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-4 mt-4">
                    {{-- First Name --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="first_name" class="font-semibold text-ternary/90 text-sm">First Name *</label>
                        <div class="w-full relative">
                            <input type="text" name="first_name" id="first_name" required
                                value="{{ old('first_name', $familyMember->first_name) }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                @error('first_name') border-red-500 @enderror">
                            <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('first_name')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Last Name --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="last_name" class="font-semibold text-ternary/90 text-sm">Last Name</label>
                        <div class="w-full relative">
                            <input type="text" name="last_name" id="last_name"
                                value="{{ old('last_name', $familyMember->last_name) }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                            <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('last_name')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Relationship --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="relationship" class="font-semibold text-ternary/90 text-sm">Relationship *</label>
                        <div class="w-full relative">
                            <select name="relationship" id="relationship" required
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200
                                @error('relationship') border-red-500 @enderror">
                                <option value="">Select Relationship</option>
                                @foreach(\App\Models\ClientFamilyMember::getRelationshipOptions() as $key => $value)
                                    <option value="{{ $key }}" {{ old('relationship', $familyMember->relationship) == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="fa fa-users absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('relationship')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Date of Birth --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="date_of_birth" class="font-semibold text-ternary/90 text-sm">Date of Birth</label>
                        <div class="w-full relative">
                            <input type="date" name="date_of_birth" id="date_of_birth"
                                value="{{ old('date_of_birth', $familyMember->date_of_birth ? $familyMember->date_of_birth->format('Y-m-d') : '') }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                            <i class="fa fa-calendar absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('date_of_birth')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Nationality --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="nationality" class="font-semibold text-ternary/90 text-sm">Nationality</label>
                        <div class="w-full relative">
                            <input type="text" name="nationality" id="nationality"
                                value="{{ old('nationality', $familyMember->nationality) }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                            <i class="fa fa-flag absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('nationality')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Birth Place --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="birth_place" class="font-semibold text-ternary/90 text-sm">Birth Place</label>
                        <div class="w-full relative">
                            <input type="text" name="birth_place" id="birth_place"
                                value="{{ old('birth_place', $familyMember->birth_place) }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                            <i class="fa fa-map-marker absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('birth_place')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Country of Birth --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="country_of_birth" class="font-semibold text-ternary/90 text-sm">Country of Birth</label>
                        <div class="w-full relative">
                            <input type="text" name="country_of_birth" id="country_of_birth"
                                value="{{ old('country_of_birth', $familyMember->country_of_birth) }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                            <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('country_of_birth')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="email" class="font-semibold text-ternary/90 text-sm">Email</label>
                        <div class="w-full relative">
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $familyMember->email) }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                            <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Phone Number --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="phone_number" class="font-semibold text-ternary/90 text-sm">Phone Number</label>
                        <div class="w-full relative">
                            <input type="text" name="phone_number" id="phone_number"
                                value="{{ old('phone_number', $familyMember->phone_number) }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                            <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('phone_number')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Passport Number --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="passport_number" class="font-semibold text-ternary/90 text-sm">Passport Number</label>
                        <div class="w-full relative">
                            <input type="text" name="passport_number" id="passport_number"
                                value="{{ old('passport_number', $familyMember->passport_number) }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                            <i class="fa fa-passport absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('passport_number')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Employment --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="employment" class="font-semibold text-ternary/90 text-sm">Employment</label>
                        <div class="w-full relative">
                            <input type="text" name="employment" id="employment"
                                value="{{ old('employment', $familyMember->employment) }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                            <i class="fa fa-briefcase absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('employment')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Employer Name --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="employer_name" class="font-semibold text-ternary/90 text-sm">Employer Name</label>
                        <div class="w-full relative">
                            <input type="text" name="employer_name" id="employer_name"
                                value="{{ old('employer_name', $familyMember->employer_name) }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                            <i class="fa fa-building absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('employer_name')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Religion --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="religion" class="font-semibold text-ternary/90 text-sm">Religion</label>
                        <div class="w-full relative">
                            <input type="text" name="religion" id="religion"
                                value="{{ old('religion', $familyMember->religion) }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                            <i class="fa fa-pray absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('religion')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Educational Qualification --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="educational_qualification" class="font-semibold text-ternary/90 text-sm">Educational Qualification</label>
                        <div class="w-full relative">
                            <input type="text" name="educational_qualification" id="educational_qualification"
                                value="{{ old('educational_qualification', $familyMember->educational_qualification) }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                            <i class="fa fa-graduation-cap absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('educational_qualification')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- City --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="city" class="font-semibold text-ternary/90 text-sm">City</label>
                        <div class="w-full relative">
                            <input type="text" name="city" id="city"
                                value="{{ old('city', $familyMember->city) }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                            <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('city')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Country --}}
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="country" class="font-semibold text-ternary/90 text-sm">Country</label>
                        <div class="w-full relative">
                            <input type="text" name="country" id="country"
                                value="{{ old('country', $familyMember->country) }}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                            <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                        @error('country')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div class="w-full relative group flex flex-col gap-1 xl:col-span-2 lg:col-span-2 md:col-span-2 sm:col-span-2">
                        <label for="address" class="font-semibold text-ternary/90 text-sm">Address</label>
                        <div class="w-full relative">
                            <textarea name="address" id="address"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200"
                                rows="3">{{ old('address', $familyMember->address) }}</textarea>
                            <i class="fa fa-home absolute right-3 top-4 text-sm text-secondary/80"></i>
                        </div>
                        @error('address')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="w-full flex justify-start px-4 pb-4 gap-2 mt-8">
                    <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-200">
                        <i class="fa fa-save mr-2"></i>Update Family Member
                    </button>
                    <a href="{{ route('agencyview.client', $client->id) }}" class="text-sm bg-gray-500 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-gray-500 text-white hover:bg-gray-600 transition ease-in duration-200">
                        <i class="fa fa-times mr-2"></i>Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-agency.layout>
