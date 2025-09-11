<x-client.layout>
@section('title') Visa Application @endsection

<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Applications List  </span>
            <!-- <a href="{{route('visa.create')}}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000"> Create New Visa </a>  -->
  
        
         </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
        <div class="w-full overflow-x-auto p-4">
 
            <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                <tr>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Application Number</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Client Details</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa</th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Visa To </th>
            
               
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Total</th> 
                  
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Booking Date  </th>
                    <th class="border-[2px] border-secondary/40 bg-secondary/10 px-4 py-1.5 text-ternary/80 font-bold text-md">Document Submit</th>
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
                                    $fullName = isset($booking->clint) && isset($booking->clint->name) && isset($booking->clint->name) 
                                                ? $booking->clint->name 
                                                : '';
                                    $cleanName = str_replace(',', '', $fullName);

                                    $email = isset($booking->clint) && isset($booking->clint) && isset($booking->clint->email) 
                                            ? $booking->clint->email 
                                            : '';

                                    $phone = isset($booking->clint) && isset($booking->clint) && isset($booking->clint->phone_number) 
                                            ? $booking->clint->phone_number 
                                            : '';
                                @endphp

                                <span>{{ $cleanName }}</span><br>
                                <span class="font-medium text-xs">{{ $email }}</span><br>
                                <span class="font-medium text-xs">{{ $phone }}</span>
                        </td>
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                             <span>{{$booking->visa->name }}</span><br>
                            <span class="font-medium text-xs">{{$booking->visasubtype->name }}</span><br> 
                          

                     
                   
                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$booking->origin->countryName }} To {{$booking->destination->countryName }}</td>
                      
                   
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
                                            'Rejected' => ['bg' => 'bg-red-200', 'text' => 'text-red-700'],
                                            'Custom Message' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-600']
                                        ];
                                        $colors = $statusColors[$status] ?? ['bg' => 'bg-gray-200', 'text' => 'text-gray-700'];
                                    @endphp

                                            @if($status === 'Custom Message' && !empty($booking->custom_message))
            <span class="px-2 py-1 rounded-[3px] font-medium cursor-pointer text-sm" 
                  style="background-color: #26ace2; color: white;"
                  title="Click on it"
                  onclick="showCustomMessage('{{ addslashes($booking->custom_message) }}')">
                Message
            </span>
        @else
            <span class="{{ $colors['bg'] }} {{ $colors['text'] }} px-2 py-1 rounded-[3px] font-medium">
                {{ $status }}
            </span>
        @endif
                                </td>

                        <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                            <div class="flex gap-2 items-center">
                                @if($booking->applicationworkin_status == "Complete")              
                                    <div class="bg-green-100 text-green-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-green-600 hover:text-white transition ease-in duration-200">
                                        <i class="fa fa-check"></i> <!-- FontAwesome icon -->
                                    </div> 
                                @else
                                    <a href="{{ route('superadminvisaedit.application', ['id' => $booking->id]) }}" title="Remind for funds">
                                        <div class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                    </a>

                                    <a href="{{ route('superadminvisasendemail.application', ['id' => $booking->id]) }}" title="Remind for funds">
                                        <div class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-200">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                    </a>
                                @endif

                                <!-- <a href="{{ route('visa.assign', ['id' => $booking->id]) }}" title="Assign to Visa Request">
                                    <div class="bg-blue-100 text-blue-600 h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-blue-600 hover:text-white transition ease-in duration-200">
                                        <i class="fa fa-clipboard-check"></i> 
                                    </div>
                                </a> -->

                                <a href="{{ route('superadminvisa.applicationview', ['id' => $booking->id]) }}" title="Assign to Visa Request">
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

<script>
    // Custom Message Modal Functions
    function showCustomMessage(message) {
        // Create modal if it doesn't exist
        let modal = document.getElementById('customMessageModal');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'customMessageModal';
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            modal.innerHTML = `
                <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4 relative">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Custom Message</h3>
                        <button onclick="closeCustomMessage()" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                    </div>
                    <div class="mb-4">
                        <p class="text-gray-700 leading-relaxed" id="customMessageText"></p>
                    </div>
                    <div class="flex justify-end">
                        <button onclick="closeCustomMessage()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                            Close
                        </button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
        }
        
        // Set the message content
        document.getElementById('customMessageText').textContent = message;
        
        // Show modal
        modal.style.display = 'flex';
    }

    function closeCustomMessage() {
        const modal = document.getElementById('customMessageModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('customMessageModal');
        if (modal && e.target === modal) {
            closeCustomMessage();
        }
    });
</script>

 </x-client.layout>