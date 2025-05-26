<x-front.layout>
    @section('title') Visa   @endsection



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Assign Country List </span>
                <a href="{{route('visa.assign')}}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000"> Create New Visa </a> 
                
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Visa</button> -->
            </div>
{{--        === heading section code ends here===--}}

                 
             
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex justify-between gap-2 items-center">
                     <div class="flex gap-2">
                         <button title="Export to excel" class="bg-success/20 text-success h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white  cursor-pointer transition ease-in duration-2000">
                             <i class="fa fa-file-excel"></i>
                         </button>
                         <button title="Export to pdf" class="bg-danger/20 text-danger h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white  cursor-pointer transition ease-in duration-2000">
                               <i class="fa fa-file-pdf"></i>
                         </button>
                     </div>
                    <div class="flex items-center gap-2">
                           <input type="text" placeholder="Country name....." class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000" >
                           <button class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                                <i class="fa fa-search mr-1"></i> Search
                           </button>
                    </div>
                </div>
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</th>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa Name</th>

                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Origin country</th>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Destination Coutnry</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Required</td>
                      
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>
                    </tr>
                   


                    @forelse($visas as $visa)
               
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$visa->VisaServices->name}}</td>

                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm"> {{$visa->origincountry->countryName}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm"> {{$visa->destinationcountry->countryName}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm"> <p> {{ $visa->required == 0 ? 'Required' : 'Not Required' }}</p>
                            </td>

                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">
                                    <a href="{{ route('visa.editcountry', ['id' => $visa->id]) }}" title="Edit Country">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                    </a>

                                    <a href="{{ route('requiredclient.field', ['id' => $visa->id]) }}" title="Assign  Country">
                                        <div class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </a>
                             

                                    <!-- <a href="{{ route('visa.view', ['id' => $visa->id]) }}" title="Assign to Visa Request"> -->
                                    <!-- <a href="{{ route('visa.assigncountry', ['id' => $visa->id]) }}" title="Assign to Visa Request">
                                        <div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-eye"></i>
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
                {{--  {{ $visas->onEachSide(0)->links() }}--}}


            </div>
{{--        === table section code ends here===--}}
        </div>
      
</x-front.layout>
