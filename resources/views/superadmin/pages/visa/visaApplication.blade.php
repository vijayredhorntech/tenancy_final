<x-agency.layout>
    @section('title') Visa Application @endsection



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Applications List  </span>
                <!-- <a href="{{route('visa.create')}}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000"> Create New Visa </a>  -->
                
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Visa</button> -->
            </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
            
             </div>
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
                    <!-- <div class="flex items-center gap-2">
                           <input type="text" placeholder="Application name....." class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000" >
                           <button class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                                <i class="fa fa-search mr-1"></i> Search
                           </button>
                    </div> -->
                    <form action="{{ route('search') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 <input type="hidden" name="type" value="application_all">
                    <input type="text" placeholder="Application ....." name="search"

                           class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000">
                    <button type="submit"
                        class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                        <i class="fa fa-search mr-1"></i> Search
                    </button>
                </form>
               @if(isset($searchback))
                    <a href="{{ route('agency.application', ['type' => 'all']) }}">   <button type="button" 
                        class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">
                    Back
                      </button>
                 </a> 
               @endif
                </div>
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Application Number</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Client Details</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa To </th>
                
                   
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Total</th> 
                      
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Booking Date  </th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Passport Submit</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Application status</th>
                        <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th>




                        <!-- <td class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Description</td> -->
                        <!-- <td class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Sub Type</td> -->
                      
             
                    </tr>
                   

    
                    @forelse($allbookings as $booking)

                
                    
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$booking->application_number}}</td>

                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">
                            @php
                                $fullName = $booking->clint->name;
                                $cleanName = str_replace(',', '', $fullName);
                            @endphp
                                <span>{{$cleanName}}</span><br>
                                <span class="font-medium text-xs">{{$booking->clint->email}}</span><br>
                                <span class="font-medium text-xs">{{$booking->clint->phone_number}}</span>
                            </td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                 <span>{{$booking->visa->name }}</span><br>
                                <span class="font-medium text-xs">{{$booking->visasubtype->name }}</span><br>
                         
                       
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$booking->origin->name }} To {{$booking->destination->name }}</td>
                          
                       
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$booking->total_amount}}</td>
                          
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{ $booking->created_at->format('d M Y') }}</td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                        <span class="bg-{{ $booking->document_status === 'Pending' ? 'danger' : 'success' }}/10 
                                                    text-{{ $booking->document_status === 'Pending' ? 'danger' : 'success' }} 
                                                    px-2 py-1 rounded-[3px] font-medium">
                                            {{ $booking->document_status }}
                                        </span>
                                    </td>

                            {{--        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                        <span class="bg-{{ $booking->applicationworkin_status === 'Pending' ? 'danger' : 'success' }}/10 
                                                    text-{{ $booking->applicationworkin_status === 'Pending' ? 'danger' : 'success' }} 
                                                    px-2 py-1 rounded-[3px] font-medium">
                                            {{ $booking->applicationworkin_status }}
                                        </span>
                                    </td> --}}

                                    <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                        @php
                                            $status = $booking->applicationworkin_status;
                                            $statusColors = [
                                                'Pending' => ['bg' => 'bg-red-200', 'text' => 'text-red-700'],
                                                'Complete' => ['bg' => 'bg-green-200', 'text' => 'text-green-700'],
                                                'Under Process' => ['bg' => 'bg-blue-200', 'text' => 'text-blue-700'],
                                                'Rejected' => ['bg' => 'bg-red-200', 'text' => 'text-red-700']
                                            ];
                                            $colors = $statusColors[$status] ?? ['bg' => 'bg-gray-200', 'text' => 'text-gray-700'];
                                        @endphp

                                        <span class="{{ $colors['bg'] }} {{ $colors['text'] }} px-2 py-1 rounded-[3px] font-medium">
                                            {{ $status }}
                                        </span>
                                    </td>

                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">
                                    @if($booking->applicationworkin_status == "Complete")              
                                        <div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-check"></i> <!-- FontAwesome icon -->
                                        </div> 
                                    @else
                                        <a href="{{ route('visaedit.application', ['id' => $booking->id]) }}" title="Remind for funds">
                                            <div class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-200">
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                        </a>
                                    @endif

                                    <!-- <a href="{{ route('visa.assign', ['id' => $booking->id]) }}" title="Assign to Visa Request">
                                        <div class="bg-blue-100 text-blue-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-blue-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-clipboard-check"></i> 
                                        </div>
                                    </a> -->

                                    <a href="{{ route('visa.applicationview', ['id' => $booking->id]) }}" title="Assign to Visa Request">
                                        <div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-eye"></i> <!-- FontAwesome icon -->
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
                {{ $allbookings->onEachSide(0)->links() }}


            </div>
{{--        === table section code ends here===--}}
        </div>

        
    </x-agency.layout>
