<x-front.layout>
       @section('title')Document Create  @endsection

       <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">



           {{-- === this is code for heading section ===--}}
           <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
               <span class="font-semibold text-ternary text-xl"> Document Create </span>
           </div>
           {{-- === heading section code ends here===--}}



           {{-- === this is code for form section ===--}}
           <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
           @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
               <form action="{{ route('superadmindocument.store') }}" method="POST" enctype="multipart/form-data">
                   @csrf
                   <div class="w-full grid xl:grid-cols-2 gap-2 px-4 py-6">

                        <div class="w-full relative group flex flex-col gap-1">
                                <label for="name" class="font-semibold text-ternary/90 text-sm">Document Name <span class="text-red-600">*</span></label>
                                <div class="w-full relative">
                                    <input type="text" name="name" id="name" placeholder="Document  Name....."
                                        value="{{ old('name') }}"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                        @error('name') border-red-500 @enderror">
                                    <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>

                                @error('name')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                        </div>
               
                        <div class="w-full relative group flex flex-col gap-1">
                                <label for="clientid" class="font-semibold text-ternary/90 text-sm">
                                    Select Client <span class="text-red-600">*</span>
                                </label>
                                
                                <div class="w-full relative">
                                    <select name="clientid" id="clientid"
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 text-sm text-ternary/90
                                        @error('clientid') border-red-500 @enderror">
                                        <option value="">-- Select Client --</option>
                                        @foreach ($agencies as $agency)
                                            <option value="{{ $agency->id }}" {{ old('clientid') == $agency->id ? 'selected' : '' }}>
                                                {{ $agency->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>

                                @error('clientid')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                          </div>

                </div>
                      
                        <!-- <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">
                                <div class="w-full relative group flex flex-col gap-1">
                                        <label for="name" class="font-semibold text-ternary/90 text-sm">Document Type <span class="text-red-600">*</span></label>
                                        <div class="w-full relative">
                                        <select name="destinationcountry" id="destinationcountry" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                                        <option value="">---Select Document Type---</option>
                                                        <option value="">Flight Details</option>
                                                        <option value="">Hotel Details</option>
                                                        <option value="">Visa Details </option>

                                                    
                                                    </select>
                                                    <i class="fa fa-angle-down absolute right-3 top-1/2 -translate-y-1/2 text-sm text-secondary/80 pointer-events-none"></i>
                                    
                                        </div>

                                        @error('name')
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="w-full relative group flex flex-col gap-1">
                                        <label for="name" class="font-semibold text-ternary/90 text-sm">Document Name <span class="text-red-600">*</span></label>
                                        <div class="w-full relative">
                                            <input type="text" name="name" id="name" placeholder="Staff Name....."
                                                value="{{ old('name') }}"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                                @error('name') border-red-500 @enderror">
                                            <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                        </div>

                                        @error('name')
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="w-full relative group flex flex-col gap-1">
                                        <label for="name" class="font-semibold text-ternary/90 text-sm">Document File <span class="text-red-600">*</span></label>
                                        <div class="w-full relative">
                                            <input type="file" name="name" id="name" 
                                                value="{{ old('name') }}"
                                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                                @error('name') border-red-500 @enderror">
                                            <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                        </div>

                                        @error('name')
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="w-full relative group flex flex-col gap-1">
                                        <label for="name" class="font-semibold text-ternary/90 text-sm">Terms and Conditions<span class="text-red-600">*</span></label>
                                        <div class="w-full relative">
                                            <select name="termandcondition" id="destinationcountry" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                                <option value="">---Select Term and Conditions ---</option>
                                                <option value="tcbeforesale">T&Cs Before Sale</option>
                                                <option value="visatermcondition">Visa Term and Condition</option> 
                                            </select>
                                            <i class="fa fa-angle-down absolute right-3 top-1/2 -translate-y-1/2 text-sm text-secondary/80 pointer-events-none"></i>
                                    </div>
                                        @error('name')
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                </div>
                    </div> -->

                     <!-- Container for all dynamic sections -->
                        <div id="document-section-container" class="space-y-4">
                            <div class="document-section w-full grid xl:grid-cols-4 gap-2 px-4 py-6 border border-gray-200 rounded relative">
                                <!-- Document Type -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label class="font-semibold text-ternary/90 text-sm">Document Type <span class="text-red-600">*</span></label>
                                    <div class="w-full relative">
                                        <select name="document_type[]" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                        @error('name') border-red-500 @enderror">
                                            <option value="">---Select Document Type---</option>
                                            <option value="flight">Flight Details</option>
                                            <option value="hotel">Hotel Details</option>
                                            <option value="visa">Visa Details</option>
                                        </select>
                                        <i class="fa fa-angle-down absolute right-3 top-1/2 -translate-y-1/2 text-sm text-secondary/80 pointer-events-none"></i>
                                    </div>
                                </div>

                                <!-- Document Name -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label class="font-semibold text-ternary/90 text-sm">Document Name <span class="text-red-600">*</span></label>
                                    <div class="w-full relative">
                                        <input type="text" name="document_name[]" placeholder="Document  Name..." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                        @error('name') border-red-500 @enderror" />
                                        <i class="fa fa-user absolute right-3 top-1/2 -translate-y-1/2 text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <!-- Document File -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label class="font-semibold text-ternary/90 text-sm">Document File <span class="text-red-600">*</span></label>
                                    <div class="w-full relative">
                                        <input type="file" name="document_file[]" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                        @error('name') border-red-500 @enderror" />
                                        <i class="fa fa-file-alt absolute right-3 top-1/2 -translate-y-1/2 text-sm text-secondary/80"></i>
                                    </div>
                                </div>

                                <!-- Terms & Conditions -->
                                <div class="w-full relative group flex flex-col gap-1">
                                    <label class="font-semibold text-ternary/90 text-sm">Terms and Conditions <span class="text-red-600">*</span></label>
                                    <div class="w-full relative">
                                        <select name="termandcondition[]" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                        @error('name') border-red-500 @enderror">
                                            <option value="">---Select Term and Conditions---</option>
                                            <option value="tcbeforesale">T&Cs Before Sale</option>
                                            <option value="visatermcondition">Visa Term and Condition</option>
                                        </select>
                                        <i class="fa fa-angle-down absolute right-3 top-1/2 -translate-y-1/2 text-sm text-secondary/80 pointer-events-none"></i>
                                    </div>
                                </div>

                                <!-- Remove button (shown only for duplicated sections) -->
                                <button type="button" class="remove-section-btn absolute top-2 right-2 bg-red-500 text-white px-2 py-1 text-xs rounded hidden">Remove</button>
                            </div>
                        </div>

                        <!-- Add More Button -->
                        <div class="px-4 py-2">
                            <button type="button" id="add-section-btn" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                + Add More
                            </button>
                        </div>


                  
                   <!-- Term and condition -->

                   @forelse($termconditions as $termcondition)
                        <div class="w-full flex flex-col gap-2 px-4 mt-8">
                            <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                                <span class="text-lg font-bold text-ternary">{{ $termcondition->type }}</span>
                            </div>
                            <input type="hidden" value="{{ $termcondition->id }}" name="termstype[]">
                            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-4 mt-4">
                            @forelse ($termcondition->terms as $term)
                               
                                 <label class="flex items center space-x-2 cursor-pointer" >
                                 
                                        <input 
                                            type="checkbox" 
                                            value="{{ $term->id }}" 
                                            name="terms_{{ $termcondition->id }}[]" 
                                            class="hidden peer" 
                                        >
                                        <div class="w-[20px] h-[20px] flex-none border-2 border-gray-400 rounded-full peer-checked:rounded-[3px] flex items-center justify-center peer-checked:bg-secondary/60 peer-checked:border-secondary/90 transition">
                                            </div>
                                        
                                        <span class="text-black text-justify text-sm peer-checked:text-secondary font-normal ">
                                            {{ $term->heading }}
                                        </span>
                                    </label>
                                 
                            @empty
                                <div class="w-full text-center text-gray-500 font-medium">No Permission Found</div>
                            @endforelse
                            </div>


                        </div>
                    @empty
                       <p class="text-sm text-gray-500 px-4">No term conditions found.</p>
                   @endforelse
         


                   <div class="w-full flex justify-end px-4 pb-4 gap-2">
                       <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button> -->
                       <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Create Document</button>
                   </div>
               </form>
           </div>
           {{-- === form section code ends here===--}}


           {{-- === table section code ends here===--}}




       </div>

       @section('scripts')
                <script>
                        $(document).ready(function () {
                            const $container = $('#document-section-container');
                            const $addBtn = $('#add-section-btn');

                            $addBtn.on('click', function () {
                                // Clone the first document section
                                const $firstSection = $container.find('.document-section').first();
                                const $clone = $firstSection.clone();

                                // Clear all inputs and selects
                                $clone.find('input, select').val('');

                                // Show and bind remove button
                                $clone.find('.remove-section-btn').removeClass('hidden').off('click').on('click', function () {
                                    $clone.remove();
                                });

                                $container.append($clone);
                            });

                            // Attach remove logic to existing remove buttons (if any)
                            $container.on('click', '.remove-section-btn', function () {
                                $(this).closest('.document-section').remove();
                            });
                        });
            </script>

       @endsection
   </x-front.layout>