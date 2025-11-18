<x-agency.layout>
    @section('title')Agency @endsection

    

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Conversations </span>
        </div>

        <div class="w-full py-4 flex px-4 gap-4">
            <div class="w-full bg-secondary/20 rounded-[10px]">

            </div>

                <div class="xl:w-[30%] lg:w-[50%] md:w-[60%] w-full flex-none  bg-white shadow-lg shadow-gray-100  border-[2px] border-ternary/10 rounded-[10px] relative ">
                    <div class="w-full flex justify-between items-center px-4 py-2 bg-white sticky top-0 border-b-[2px] border-b-ternary/10 rounded-t-[10px] gap-4">
                        <div class="h-12 w-12 rounded-full flex-none">
                            <img src="{{asset('assets/images/profile_photo.jpg')}}"  class="rounded-full" alt="">
                        </div>
                        <div class="w-full flex  justify-between">
                               <div class="flex flex-col">
                                   <span class="font-semibold text-ternary">User Name</span>
                                   <p class="font-medium text-ternary/60 text-sm">Member</p>
                               </div>
                                <div class="w-max flex justify-end items-end">
{{--                                      <span class="text-sm text-secondary ">--}}
{{--                                          <i class="fa fa-circle text-sm mr-2"></i> <span> 1h ago</span>--}}
{{--                                      </span>--}}
                                      <span class="text-sm text-success ">
                                          <i class="fa fa-circle text-sm mr-2"></i> <span> Active</span>
                                      </span>
                                </div>
                        </div>
                    </div>
                    <div class="p-4  w-full h-[600px] bg-white overflow-y-auto ">
                                   @foreach($messages as $message)
                                        @if($message->sender_id == $detials->agency_id)
                                            {{-- Client chat div --}}
                                            <div class="flex flex-col gap-2 w-full">
                                                <div class="w-[70%] flex flex-col">
                                                    <div class="w-max">
                                                        <div class="bg-gray-200 w-max px-6 py-2 rounded-tl-full rounded-bl-full rounded-tr-full">
                                                            <span>{{ $message->message }}</span>
                                                        </div>
                                                        <div class="flex justify-end">
                                                            <p class="text-secondary text-xs">{{ $message->created_at->format('d-m-Y') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Client chat div ends here --}}
                                        @else
                                            {{-- Executive chat start here --}}
                                            <div class="flex flex-col items-end w-full gap-2">
                                                <div class="w-[70%] flex flex-col items-end">
                                                    <div class="w-max">
                                                        <div class="bg-blue-200 w-max px-6 py-2 rounded-tl-full rounded-br-full rounded-tr-full">
                                                            <span>{{ $message->message }}</span>
                                                        </div>
                                                        <div class="flex justify-end">
                                                            <p class="text-secondary text-xs">{{ $message->created_at->format('d-m-Y') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Executive chat ends here --}}
                                        @endif
                                    @endforeach
{{--                        executive chat ends here--}}



                         




                    </div>
                    <form action="{{ route('send_message') }}" method="POST" enctype="multipart/form-data" class="w-full h-10 border-t-[2px] border-ternary/10 rounded-b-[10px]  flex">
                    @csrf

                    
                       <input type="text" placeholder="Type a message" name="message" class="w-full border-none px-4 focus:outline-none focus:ring-0 focus:border-none text-ternary/80 rounded-bl-[10px]">
                        <input type="hidden" name="ticket_number" value="{{$detials->ticket_id}}"> 
                        <input type="hidden"  name="recevier_id" value="{{$current_user->id}}"> 
                        <input type="hidden"  name="sender_id" value="{{$detials->agency_id}}">
                        <input type="hidden"  name="id" value="{{$detials->id}}">
                        <input type="hidden" name="agency" value="agency">
                        <button class="w-40 px-4 bg-secondary/30 text-ternary font-semibold hover:bg-secondary hover:text-white transition ease-in duration-2000 rounded-br-[10px]">
                             Send  <i class="fas fa-paper-plane text-sm ml-2"></i>
                        </button>
                    </form>
                </div>
        </div>

    </div>


</x-agency.layout>
     