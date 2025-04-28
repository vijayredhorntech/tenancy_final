<x-agency.layout>
    @section('title')Agency Doc @endsection

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

            {{-- === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Create Document</span>
            </div>
            {{-- === heading section code ends here===--}}

            {{-- === this is code for form section ===--}}
            <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
                <form action="{{ route('create.document') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4 mx-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- 1️⃣ Personal Information --}}
                    <div class="w-full flex flex-col gap-2 px-4 mt-4">
                        <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                            <span class="text-lg font-bold text-ternary">1️⃣ Add Document Information</span>
                        </div>

                        <div class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="name" class="font-semibold text-ternary/90 text-sm">Document Title</label>
                                <div class="w-full relative">
                                    <input type="text" name="doctitle" id="doctitle" placeholder="Enter Document title"
                                           value="{{ old('doctitle') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('name') border-red-500 @enderror">
                                    <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('doctitle')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                         
                           {{-- Document description  --}} 
                           <div class="w-full relative group flex flex-col gap-1 col-span-2">
                                <label for="residential_address" class="font-semibold text-ternary/90 text-sm">Document Description</label>
                                <div class="w-full relative">
                                   <textarea name="documentdescription" id="documentdescription"
                                      class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('residential_address') border-red-500 @enderror"
                                      placeholder="Enter Document Description">{{ old('documentdescription') }}</textarea>
                                    <i class="fa fa-file-alt absolute right-3 top-4 text-sm text-secondary/80"></i>
                                </div>
                                @error('documentdescription')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                           </div>
                        

                             {{-- Uploade file --}} 

                        <div class="w-full relative group flex flex-col gap-1 col-span-2">
                                <label for="email" class="font-semibold text-ternary/90 text-sm">Document File</label>
                                <div class="w-full relative">
                                    <input type="file" name="documentfile" id="file" placeholder="Enter email"
                                           value="{{ old('documentfile') }}"
                                           class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000
                                @error('email') border-red-500 @enderror">
                                    <i class="fa fa-file absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                </div>
                                @error('email')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                    </div>
               </div>
                  

              
            
               
                

                    {{-- Submit Button --}}
                    <div class="w-full flex justify-end px-4 pb-4 gap-2 mt-8">
                        <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')"
                                class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">
                            Cancel
                        </button> -->
                        <button type="submit"
                                class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">
                            Create Document
                        </button>
                    </div>
                </form>
            </div>
            {{-- === form section code ends here===--}}
        </div>
</x-agency.layout>
