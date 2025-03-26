<x-agency.layout>
    @section('title')Clint @endsection

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-4 text-center">Visa Application Form</h2>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 1️⃣ Personal Information -->
        <div class="border-b pb-4 mb-4">
            <h3 class="text-lg font-semibold mb-2">1️⃣ Personal Information</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">First Name</label>
                    <input type="text" name="name" class="w-full p-2 border rounded-lg" 
                           placeholder="Enter First Name" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                

                <div>
                    <label class="block text-sm font-medium">Last Name</label>
                    <input type="text" name="last" class="w-full p-2 border rounded-lg" 
                           placeholder="Enter Last Name" value="{{ old('last') }}">
                    @error('last')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Date of Birth</label>
                    <input type="date" name="dob" class="w-full p-2 border rounded-lg" value="{{ old('dob') }}">
                    @error('dob')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Gender</label>
                    <select name="gender" class="w-full p-2 border rounded-lg">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Marital Status</label>
                    <select name="marital_status" class="w-full p-2 border rounded-lg">
                        <option value="">Select</option>
                        <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Single</option>
                        <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Married</option>
                        <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                        <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                        
                    </select>
                    @error('marital_status')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Nationality</label>
                    <input type="text" name="nationality" class="w-full p-2 border rounded-lg" 
                           placeholder="Enter nationality" value="{{ old('nationality') }}">
                    @error('nationality')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                <label class="block text-sm font-medium">Passport Number</label>
                <input type="number" name="passport_number" class="w-full p-2 border rounded-lg">
                @error('passport_number')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
               </div>

                <div>
                <label class="block text-sm font-medium">Passport Issue Date</label>
                <input type="date" name="passport_issue_date" class="w-full p-2 border rounded-lg">
                @error('passport_issue_date')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
               </div>

            <div>
                <label class="block text-sm font-medium">Passport Expiry Date</label>
                <input type="date" name="passport_expiry_date" class="w-full p-2 border rounded-lg">
                @error('passport_expiry_date')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
            </div>
            </div>
        </div>

        <!-- 2️⃣ Contact Information -->
        <div class="border-b pb-4 mb-4">
            <h3 class="text-lg font-semibold mb-2">2️⃣ Contact Information</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Email Address</label>
                    <input type="email" name="email" class="w-full p-2 border rounded-lg" 
                           placeholder="Enter email" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Phone Number</label>
                    <input type="text" name="phone" class="w-full p-2 border rounded-lg" 
                           placeholder="Enter phone number" value="{{ old('phone') }}">
                    @error('phone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium">Current Address</label>
                    <textarea name="residential_address" class="w-full p-2 border rounded-lg" 
                              placeholder="Enter current address">{{ old('residential_address') }}</textarea>
                    @error('residential_address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- 3️⃣ Family Details -->
        <div class="border-b pb-4 mb-4">
            <h3 class="text-lg font-semibold mb-2">3️⃣ Family Details</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Father’s Name</label>
                    <input type="text" name="father_name" class="w-full p-2 border rounded-lg" value="{{ old('father_name') }}">
                    @error('father_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Mother’s Name</label>
                    <input type="text" name="mother_name" class="w-full p-2 border rounded-lg" value="{{ old('mother_name') }}">
                    @error('mother_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Spouse’s Name (if married)</label>
                    <input type="text" name="spouse_name" class="w-full p-2 border rounded-lg" value="{{ old('spouse_name') }}">
                </div>

                <div>
                    <label class="block text-sm font-medium">Number of Children</label>
                    <input type="number" name="children_count" class="w-full p-2 border rounded-lg" value="{{ old('children_count') }}">
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md">
                Create Client
            </button>
        </div>
    </form>
</div>
</x-agency.layout>

