<x-agency.layout>
    
@section('title')
    Support
@endsection

<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

    <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
        <span class="font-semibold text-ternary text-xl">Conversations</span>
    </div>

    <div class="w-full py-4 flex px-4 gap-4">
        <div class="w-full bg-secondary/20 rounded-[10px]">
            <!-- Conversation list can go here -->
        </div>

        <div class="xl:w-[30%] lg:w-[50%] md:w-[60%] w-full flex-none bg-white shadow-lg shadow-gray-100 border-[2px] border-ternary/10 rounded-[10px] relative">
            <!-- Chat header -->
            <div class="w-full flex justify-between items-center px-4 py-2 bg-white sticky top-0 border-b-[2px] border-b-ternary/10 rounded-t-[10px] gap-4">
                <div class="h-12 w-12 rounded-full flex-none">
 
                @if( $client->gender == 'MALE')
                    <img src="{{ asset('assets/images/man.png') }}" 
                    onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.png') }}';"
                    class="h-20 w-20 object-cover rounded-full" 
                    alt="Cloud Travel">
                    @else
                    <img src="{{ asset('assets/images/female.png') }}" 
                    onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.png') }}';"
                    class="h-20 w-20 object-cover rounded-full" 
                    alt="Cloud Travel">
                    @endif
                </div>
                <div class="w-full flex justify-between">
                    <div class="flex flex-col">
                        <span class="font-semibold text-ternary">{{$client->client_name}}</span>
                        <p class="font-medium text-ternary/60 text-sm">Agency</p>
                    </div>
                    <div class="w-max flex justify-end items-end">
                        <span class="text-sm text-success">
                            <i class="fa fa-circle text-sm mr-2"></i> <span> Active</span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Chat messages area -->
            <div class="p-4 w-full h-[600px] bg-white overflow-y-auto" id="chat-messages">
                @foreach($client->clientchats as $message)
                    @if($message->sender_user_type !== 'client')
                        <!-- Current user's messages (right side) -->
                        <div class="flex flex-col items-end w-full gap-2 mb-4">
                            <div class="w-[70%] flex flex-col items-end">
                                <div class="w-max">
                                    <div class="bg-blue-200 w-max px-6 py-2 rounded-tl-full rounded-br-full rounded-tr-full">
                           
                                        <span>{{ $message->message }}</span>
                                    </div>
                                    <div class="flex justify-end">
                                        <p class="text-secondary text-xs">{{ $message->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Other user's messages (left side) -->
                        <div class="flex flex-col gap-2 w-full mb-4">
                            <div class="w-[70%] flex flex-col">
                                <div class="w-max">
                                    <div class="bg-gray-200 w-max px-6 py-2 rounded-tl-full rounded-bl-full rounded-tr-full">
                                        <span>{{ $message->message }}</span>
                                    </div>
                                    <div class="flex justify-end">
                                        <p class="text-secondary text-xs">{{ $message->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Message input form -->
            <form id="chat-form" action="{{ route('agency.send_message') }}" method="POST" enctype="multipart/form-data" class="w-full border-t-[2px] border-ternary/10 rounded-b-[10px] flex p-2 items-center gap-2">
                    @csrf

                    <!-- Hidden file input -->
                    <input type="file" name="attachment" id="attachment" class="hidden">

                    <!-- File upload icon -->
                    <label for="attachment" class="cursor-pointer text-secondary text-xl hover:opacity-80">
                        <i class="fas fa-paperclip"></i>
                    </label>

                    <input type="text" name="message" placeholder="Type a message" class="flex-grow border-none px-4 focus:outline-none focus:ring-0 text-ternary/80">
                    <input type="hidden" name="clientid" value="{{ $client->id }}">
                    <input type="hidden" name="ticket_number" value="{{ $ticket_number ?? '' }}">
                    <input type="hidden" id="sender_id" name="sender_id" value="{{ $agency->id }}">
                    <input type="hidden" id="recevier_id" name="recevier_id" value="{{ $client->id }}">
                    <input type="hidden" name="type" value="agency">
                    

                    <button type="submit" class="px-4 py-2 bg-secondary text-white font-semibold rounded hover:bg-secondary/80 transition">
                        Send <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </form>


        </div>
    </div>
</div>



<!-- Add JavaScript for real-time functionality -->

<script>
  
    document.getElementById('attachment').addEventListener('change', function () {
        const file = this.files[0];
        const nameSpan = document.getElementById('file-name');
        if (file) {
            nameSpan.textContent = file.name;
            nameSpan.classList.remove('hidden');
        } else {
            nameSpan.classList.add('hidden');
        }
    });


    $(document).ready(function () {
            const $chatForm = $('#chat-form');
            const $chatMessages = $('#chat-messages');

            // Scroll to bottom on load
            $chatMessages.scrollTop($chatMessages[0].scrollHeight);

            $chatForm.on('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);

                $.ajax({
                    url: $chatForm.attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
                    },
                    success: function (data) {
                        if (data.success) {
                     
                            // $chatMessages.append(messageHtml);
                             $chatForm[0].reset();
                            $chatMessages.scrollTop($chatMessages[0].scrollHeight);
                        }
                    },
                    error: function (xhr) {
                        console.error('Error:', xhr.responseText);
                    }
                });
            });
        });
</script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('d1a84316b9cf0243536a', {
        cluster: 'ap1',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-chanal');

    channel.bind('cloudtravel', function(data) {
        var senderId = jQuery("#sender_id").val();
        var clientId = jQuery("#recevier_id").val();
        
     
        if (
                        (clientId === data.sender_id && senderId === data.receiver_id) ||
                        (senderId === data.sender_id && clientId === data.receiver_id)
                    )   {
            let messageHtml = '';
       
            if (data.type !== 'client') {
                            // Right side (current user)
                messageHtml = `
                    <div class="flex flex-col items-end w-full gap-2 mb-4">
                        <div class="w-[70%] flex flex-col items-end">
                            <div class="w-max">
                                <div class="bg-blue-200 w-max px-6 py-2 rounded-tl-full rounded-br-full rounded-tr-full">
                                    <span>${data.message}</span>
                                </div>
                                <div class="flex justify-end">
                                    <p class="text-secondary text-xs">Just now</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            } else {
             
                // Left side (other user)
                messageHtml = `
                    <div class="flex flex-col gap-2 w-full mb-4">
                        <div class="w-[70%] flex flex-col">
                            <div class="w-max">
                                <div class="bg-gray-200 w-max px-6 py-2 rounded-tl-full rounded-bl-full rounded-tr-full">
                                    <span>${data.message}</span>
                                </div>
                                <div class="flex justify-end">
                                 <p class="text-secondary text-xs">Just now</p>

                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }

            // Append message to chat area
            jQuery('#chat-messages').append(messageHtml);

            // Scroll to bottom
            jQuery('#chat-messages').scrollTop(jQuery('#chat-messages')[0].scrollHeight);
        }
    });
</script>
   </x-agency.layout>
