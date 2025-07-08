<x-front.layout>
    @section('title') Visa   @endsection



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Visa Type </span>
                <a href="{{route('visa.create')}}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000"> Create New Visa </a> 
                
             

      
                 
             </div>

            <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex justify-between gap-2 items-center">
                     <div class="flex gap-2">

                     </div>
                     <div class="flex items-center gap-2">
                    
                    <form action="{{ route('search') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="type" value="visa">
                         <input type="text" placeholder="Visa Name....." name="search"
     
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
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa Name</th>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Total Assign Country</td>
                         <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>
                    </tr>
                   


                    @forelse($allvisa as $visa)
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$visa['name']}}</td>
                             <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$visa->visaAssignCountries->count()}}</td>
                             <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                
                                <div class="flex gap-2 items-center">

                                    <a href="{{ route('visa.view', ['id' => $visa->id]) }}" title="View Details">
                                        <div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </a>
                                    <!-- <a href="{{ route('visa.edit', ['id' => $visa->id]) }}" title="Remind for funds">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                           <i class="fa fa-pencil"></i> 
                                        </div>
                                    </a> -->
                             
                                    <!-- <a href="{{ route('visa.assign', ['id' => $visa->id]) }}" title="Assign to Visa Request">
                                        <div class="bg-blue-100 text-blue-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-blue-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-clipboard-check"></i> 
                                        </div>
                                    </a> -->

                                    <!-- <a href="{{ route('visa.view', ['id' => $visa->id]) }}" title="Assign to Visa Request"> -->
                                     <!-- <a href="{{ route('visa.viewsubtype', ['id' => $visa->id]) }}" title="View SubType">
                                        <div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                        <i class="fa fa-plane"></i>
                                        </div>
                                    </a> -->

                                    <!-- <a href="{{ route('visa.delete', ['id' => $visa->id]) }}" title="View delete" onclick="return confirm('Are you sure you want to delete this visa?');">
                                        <div class="bg-red-100 text-red-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-red-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-trash"></i> 
                                        </div>
                                    </a> -->

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
