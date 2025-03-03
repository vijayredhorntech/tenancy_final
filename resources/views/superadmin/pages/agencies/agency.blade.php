<x-front.layout>
    @section('title')
        Agency
    @endsection


    {{--    === this is code for model ===--}}
    <div id="viewServiceModel"
         class="w-full h-full absolute top-0 left-0 bg-white/40 z-20 flex hidden  justify-center items-center cursor-pointer">
        <div
            class="rounded-[3px] bg-white px-8 py-12 shadow-lg shadow-gray-300 border-[2px] border-gray-400/50 max-w-7xl relative">
            <div
                class="absolute top-1 right-1 h-6 w-6 flex rounded-full justify-center items-center bg-danger/30 border-[1px] border-danger/70 text-ternary hover:bg-danger hover:text-white transition ease-in duration-2000"
                onclick="document.getElementById('viewServiceModel').classList.toggle('hidden')">
                <i class="fa fa-xmark"></i>
            </div>
            <span class="font-medium text-lg ">Services for agency  <i class="font-semibold text-secondary"><u>Skyline Tours</u></i></span>

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
    {{--        === model code ends ===--}}
    <div
        class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        {{--        === this is code for heading section ===--}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Agency List </span>

          @canany(['agency create', 'manage everything'])
          <a href="{{route('create_agency')}}">   <button type="button" 
                    class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">
                Create New Agency
            </button>
        </a> 
         @endcanany


        </div>
        {{--        === heading section code ends here===--}}



        {{--        === this is code for form section ===--}}
        <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 hidden">
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
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Vat Number</label>
                            <div class="w-full relative">
                                <input type="text" name="vat_number" id="vat_number" placeholder="Vat ....."
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-file-invoice absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>
                        <div class="w-full relative group flex flex-col gap-2">
                            <label class="font-semibold text-ternary/90 text-sm">Select Services</label>
                            <div class="flex gap-2 flex-wrap">
                                @forelse($services as $service)
                                    <div class="flex items-center gap-2">
                                        <input type="checkbox" id="service_{{ $service->id }}" name="services[]"
                                               value="{{ $service->id }}"
                                               class="appearance-none w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
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
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Telephone</label>
                            <div class="w-full relative">
                                <input type="number" name="telephone" id="telephone" placeholder="telephone....."
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Phone</label>
                            <div class="w-full relative">
                                <input type="number" name="agency_phone" id="agency_phone" placeholder="Phone....."
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Contact Person</label>
                            <div class="w-full relative">
                                <input type="text" name="contact_name" id="contact_name"
                                       placeholder="Contact Person Name....."
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Contact person Phone</label>
                            <div class="w-full relative">
                                <input type="number" name="contact_phone" id="contact_phone"
                                       placeholder="Contact Phone....."
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
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
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-map-marker-alt absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <!-- <div class="address"> </div>  -->
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Address</label>
                            <div class="w-full relative">
                                <input type="text" name="address" id="address" placeholder="Address....."
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">City</label>
                            <div class="w-full relative">
                                <input type="text" name="city" id="city" placeholder="Phone....."
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-city absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">State</label>
                            <div class="w-full relative">
                                <input type="text" name="state" id="state" placeholder="State....."
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-flag absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Country</label>
                            <div class="w-full relative">
                                <input type="test" name="country" id="country" placeholder="Country....."
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-globe absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
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
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Database Name</label>
                            <div class="w-full relative">
                                <input type="text" name="database_name" id="database_name" placeholder="Phone....."
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-database absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
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
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>


                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Attachment</label>
                            <div class="w-full relative">
                                <input type="file" name="attachment1" id="attachment1" placeholder="attachment....."
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-database absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>

                        

                    </div>
                </div> -->


                
        <div class="w-full flex flex-col gap-2 px-4 mt-8">
            <!-- Header -->
            <div class="border-b-[2px] border-b-secondary/50 w-max pr-20">
                <span class="text-lg font-bold text-ternary">Document Information</span>
            </div>
    
            <!-- Buttons -->
            <div class="flex gap-2 mt-4">
                <button onclick="addInput()" class="p-2 bg-blue-500 text-white rounded">Push</button>
                <button onclick="removeInput()" class="p-2 bg-red-500 text-white rounded">Reduce</button>
            </div>
    
            <!-- Document Container -->
            <div id="documentContainer">
                <!-- Initial Document and Attachment Fields -->
                <div id="inputGroup1" class="w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="document1" class="font-semibold text-ternary/90 text-sm">Document Name</label>
                        <div class="w-full relative">
                            <input type="text" name="document1" id="document1" placeholder="Document name..."
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                            <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                    </div>
    
                    <div class="w-full relative group flex flex-col gap-1">
                        <label for="attachment1" class="font-semibold text-ternary/90 text-sm">Attachment</label>
                        <div class="w-full relative">
                            <input type="file" name="attachment1" id="attachment1"
                                   class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                            <i class="fa fa-database absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                    </div>
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
        {{--        === form section code ends here===--}}


        {{--        === this is code for table section ===--}}
        <div class="w-full overflow-x-auto p-4">
            <div class="w-full flex justify-between gap-2 items-center">
                <div class="flex gap-2">
                @canany(['export excel', 'manage everything'])
                    <a href="{{route('agencies.downloade')}}">
                        <button title="Export to excel"
                                class="bg-success/20 text-success h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white  cursor-pointer transition ease-in duration-2000">
                            <i class="fa fa-file-excel"></i>
                        </button>
                    </a>
                @endcanany

                @canany(['export pdf', 'manage everything'])
                    <button title="Export to pdf"
                            class="bg-danger/20 text-danger h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white  cursor-pointer transition ease-in duration-2000">
                        <i class="fa fa-file-pdf"></i>
                    </button>
                @endcanany

                </div>
                <div class="flex items-center gap-2">
                {{--    <form action="{{ route('search') }}" method="POST" enctype="multipart/form-data">
                 @csrf--}}
                 <input type="hidden" value="agency">
                    <input type="text" placeholder="Agency name....." name="search"

                           class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000">
                    <button type="submit"
                        class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                        <i class="fa fa-search mr-1"></i> Search
                    </button>
                    {{--   </form> --}}
                </div>
            </div>
            <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                <tr>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md ">
                        Sr. No.
                    </td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md w-[150px]">
                        Agency Name
                    </td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">
                        Email
                    </td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md w-[200px]">
                        Contact Person
                    </td>

                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">
                        Services
                    </td>

                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">
                        Fund Allotted
                    </td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">
                        Fund Remaining
                    </td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">
                        Status
                    </td>
                    <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">
                        Action
                    </td>
                </tr>

                @forelse($agencies as $agency)
                    <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000">
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$agency['name']}}</td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$agency['email']}}</td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">
                            <div class="flex flex-col">
                                <span><i class="fa fa-user text-sm mr-1 text-secondary"></i> {{$agency['contact_person']}}</span>
                                <span class="font-medium"> <a href="tel:({{$agency['contact_phone']}} )"><i class="fa fa-phone mr-1 text-sm text-secondary"></i> ({{$agency['contact_phone']}} )</a></span>
                            </div>
                        </td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                            <div class="flex  gap-2">
                                {{ $agency->userAssignments ? $agency->userAssignments->count() : 0 }}
                                <button type="button" title="View Services"
                                        onclick="document.getElementById('viewServiceModel').classList.toggle('hidden')">
                                    <div
                                        class=" bg-primary/10 text-primary h-6 w-6 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                        <i class="fa fa-eye"></i>
                                    </div>
                                </button>
                            </div>
                        </td>

                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                            <div class="flex justify-between gap-2">
                                {{ $agency->balance ? '£ ' . $agency->balance->balance : '0' }}

                                @canany(['add fund', 'manage everything'])
                                    <a href="{{route('agencies.fund',['id' => $agency->id])}}" title="Add Fund">
                                        <div
                                            class=" bg-danger/10 text-danger h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white transition ease-in duration-2000">
                                            <i class="fa-solid fa-sack-dollar"></i>
                                        </div>
                                    </a>
                                @endcanany
                            </div>
                        </td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                            <div class="flex justify-between gap-2">
                                {{ $agency->balance ? '£ ' . $agency->balance->balance : '0' }}
                            </div>
                        </td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
{{--                            <span class="bg-{{$agency['status']==='Inactive'?'danger':'success'}}/10 text-{{$agency['status']==='Inactive'?'danger':'success'}} px-2 py-1 rounded-[3px] font-bold">{{$agency['status']}}</span>--}}
                            <span class="bg-success/10 text-success px-2 py-1 rounded-[3px] font-bold">Active</span>


                        </td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                            <div class="flex gap-2 items-center">

                            @canany(['agency update', 'manage everything'])
                                <a href="{{route('agencies.edit',['id' => $agency->id])}}" title="Edit">
                                    <div
                                        class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                        <i class="fa fa-pen"></i>
                                    </div>
                                </a>
                            @endcanany

{{--                                <a href="{{route('agencies.invoice')}}" title="View Invoices">--}}
{{--                                    <div--}}
{{--                                        class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">--}}
{{--                                        <i class="fa fa-file"></i>--}}
{{--                                    </div>--}}
{{--                                </a>--}}

                            @canany(['view agencydashboard', 'manage everything'])
                                <a href="{{route('agencies.history',['id' => $agency->id])}}" title="View funds details">
                                    <div
                                        class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                        <i class="fa fa-database"></i>
                                    </div>
                                </a>
                             @endcanany
                                <a href="{{$agency->domains->full_url}}" title="View dashboard">
                                    <div
                                        class=" bg-danger/10 text-danger h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white transition ease-in duration-2000">
                                        <i class="fa fa-computer"></i>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="9"
                            class="text-center border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                            No Record Found
                        </td>
                    </tr>
                @endforelse


            </table>
        </div>

        <script> 

        let counter = 1; // Initial counter for input names/IDs

        function addInput() {
            counter++; // Increment counter

            let container = document.getElementById("documentContainer");

            // Create a new div for document and attachment
            let inputGroup = document.createElement("div");
            inputGroup.classList.add("w-full", "grid", "xl:grid-cols-4", "lg:grid-cols-4", "md:grid-cols-3", "sm:grid-cols-2", "grid-cols-1", "gap-4", "mt-2");
            inputGroup.setAttribute("id", `inputGroup${counter}`);

            // Add Document Name and Attachment fields
            inputGroup.innerHTML = `
                <div class="w-full relative group flex flex-col gap-1">
                    <label for="document${counter}" class="font-semibold text-ternary/90 text-sm">Document Name</label>
                    <div class="w-full relative">
                        <input type="text" name="document${counter}" id="document${counter}" placeholder="Document name..."
                               class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                        <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                    </div>
                </div>

                <div class="w-full relative group flex flex-col gap-1">
                    <label for="attachment${counter}" class="font-semibold text-ternary/90 text-sm">Attachment</label>
                    <div class="w-full relative">
                        <input type="file" name="attachment${counter}" id="attachment${counter}"
                               class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                        <i class="fa fa-database absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                    </div>
                </div>
            `;

            // Append to documentContainer
            container.appendChild(inputGroup);
        }

        function removeInput() {
            if (counter > 1) {
                let lastInputGroup = document.getElementById(`inputGroup${counter}`);
                if (lastInputGroup) {
                    lastInputGroup.remove(); // Remove last added inputs
                    counter--; // Decrement counter
                }
            }
        }
    </script>
    
        {{--        === table section code ends here===--}}
    </div>
</x-front.layout>
