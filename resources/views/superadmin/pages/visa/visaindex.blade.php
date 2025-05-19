<x-front.layout>
    @section('title') Visa   @endsection



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Visa Type </span>
                <a href="{{route('visa.create')}}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000"> Create New Visa </a> 
                
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Visa</button> -->
           
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 hidden">
         
                    <form action="{{ route('visa.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">
                                    <!-- Visa Name -->
                                    <div class="w-full relative group flex flex-col gap-1">
                                        <label for="name" class="font-semibold text-ternary/90 text-sm">Visa Name</label>
                                        <div class="w-full relative">
                                            <input type="text" name="name" id="name" placeholder="Visa name..." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000" >
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="w-full relative group flex flex-col gap-1">
                                        <label for="description" class="font-semibold text-ternary/90 text-sm">Description</label>
                                        <div class="w-full relative">
                                            <textarea name="description" id="description" rows="4" placeholder="Description..." class="w-full pl-2 pr-8 py-1 border border-gray-300 rounded focus:outline-none focus:border-blue-500"></textarea>
                                        </div>
                                    </div>
                                </div>

                            <!-- Subtype Fields Container -->
                                <div id="subtypeContainer" class="px-4">
                                    <div class="subtypeGroup w-full p-4 border border-gray-300 rounded-lg relative">
                                        <div class="flex flex-col gap-1">
                                            <label class="font-semibold text-gray-700 text-sm">Subtype Name</label>
                                            <div class="relative">
                                                <input type="text" name="subtype[]" placeholder="Subtype name..." class="w-full pl-2 pr-8 py-1 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                            </div>
                                        </div>

                                        <div class="flex flex-col gap-1 mt-3">
                                            <label class="font-semibold text-gray-700 text-sm">Subtype Price</label>
                                            <div class="relative">
                                                <input type="number" name="subtypeprice[]" placeholder="Subtype price..." class="w-full pl-2 pr-8 py-1 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                            </div>
                                        </div>

                                        <div class="flex flex-col gap-1 mt-3">
                                            <label class="font-semibold text-gray-700 text-sm">Commission</label>
                                            <div class="relative">
                                                <input type="number" name="commission[]" placeholder="Commission..." class="w-full pl-2 pr-8 py-1 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                                            </div>
                                        </div>

                                        <!-- Remove Button (Hidden for First Element) -->
                                        <button type="button" class="removeField hidden mt-3 px-3 py-1 bg-red-500 text-white text-xs rounded">Remove</button>
                                    </div>
                                </div>

                                <!-- Add More Button -->
                                <div class="px-4 mt-4">
                                    <button type="button" id="addMore" class="px-4 py-2 bg-blue-600 text-white rounded shadow">+ Add More</button>
                                </div>

                                <div class="w-full flex justify-end px-4 pb-4 gap-2">
                                <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button>
                                <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Create Visa</button>
                            </div>
                        </form>
                            
                     </div>
                 
             </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex justify-between gap-2 items-center">
                     <div class="flex gap-2">
                         <!-- <button title="Export to excel" class="bg-success/20 text-success h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white  cursor-pointer transition ease-in duration-2000">
                             <i class="fa fa-file-excel"></i>
                         </button>
                         <button title="Export to pdf" class="bg-danger/20 text-danger h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white  cursor-pointer transition ease-in duration-2000">
                               <i class="fa fa-file-pdf"></i>
                         </button> -->
                     </div>
                     <div class="flex items-center gap-2">
                    
                    <form action="{{ route('search') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="type" value="visa">
                         <input type="text" placeholder="visa name....." name="search"
     
                                class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000">
                         <button type="submit"
                             class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                             <i class="fa fa-search mr-1"></i> Search
                         </button>
                     </form>
                     
                    @if(isset($searchback))
                     <a href="{{route('visa.view')}}">   <button type="button" 
                         class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">
                         Clear Filter
                      </button>
                </a> 
     
                @endif
                     </div>
                </div>
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</th>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa name</th>
                        <!-- <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Description</td> -->
                        <!-- <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sub Type</td> -->
                      
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>
                    </tr>
                   


                    @forelse($allvisa as $visa)
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$visa['name']}}</td>
                          {{-- <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{!!$visa['description']!!}</td>
                          --}}     
                  

                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">
                                    <a href="{{ route('visa.edit', ['id' => $visa->id]) }}" title="Remind for funds">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                    </a>
                             
                                    <a href="{{ route('visa.assign', ['id' => $visa->id]) }}" title="Assign to Visa Request">
                                        <div class="bg-blue-100 text-blue-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-blue-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-clipboard-check"></i> <!-- FontAwesome icon -->
                                        </div>
                                    </a>

                                    <!-- <a href="{{ route('visa.view', ['id' => $visa->id]) }}" title="Assign to Visa Request"> -->
                                     <a href="{{ route('visa.viewsubtype', ['id' => $visa->id]) }}" title="View SubType">
                                        <div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                        <i class="fa fa-plane"></i>
                                        </div>
                                    </a>

                                    <a href="{{ route('visa.delete', ['id' => $visa->id]) }}" title="View delete" onclick="return confirm('Are you sure you want to delete this visa?');">
                                        <div class="bg-red-100 text-red-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-red-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-trash"></i> 
                                        </div>
                                    </a>

                                    <!-- <a href="" title="View Dashboard">
                                        <div class=" bg-danger/10 text-danger h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-computer"></i>
                                        </div>
                                    </a> -->


                                </div>
                            </td>
                        </tr>


                    @empty
                        <tr>
                            <td colspan="9" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                        </tr>
                    @endforelse


                </table>
                {{ $allvisa->onEachSide(0)->links() }}


            </div>
{{--        === table section code ends here===--}}
        </div>
      
</x-front.layout>
