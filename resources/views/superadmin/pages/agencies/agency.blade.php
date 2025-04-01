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
                <a href="{{ route('generate.pdf') }}"> 
                <button title="Export to pdf"
                            class="bg-danger/20 text-danger h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white  cursor-pointer transition ease-in duration-2000">
                        <i class="fa fa-file-pdf"></i>
                    </button>
                </a>
                @endcanany

                </div>
                <div class="flex items-center gap-2">
                    
               <form action="{{ route('search') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 <input type="hidden" name="type" value="agency">
                    <input type="text" placeholder="Agency name....." name="search"

                           class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000">
                    <button type="submit"
                        class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                        <i class="fa fa-search mr-1"></i> Search
                    </button>
                </form>
               @if($searchback)
                <a href="{{route('agency')}}">   <button type="button" 
                    class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">
                Back
            </button>
           </a> 

           @endif
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
                                    <!-- <div
                                        class=" bg-primary/10 text-primary h-6 w-6 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                        <i class="fa fa-eye"></i>
                                    </div> -->
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
                                <span class="bg-{{$agency->details->status=='0'?'danger':'success'}}/10 text-{{$agency->details->status=='0'?'danger':'success'}} px-2 py-1 rounded-[3px] font-bold"> {{ $agency->details->status == '0' ? 'Inactive' : 'Active' }}</span>

<!-- <span class="bg-success/10 text-success px-2 py-1 rounded-[3px] font-bold">Active</span> -->


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
