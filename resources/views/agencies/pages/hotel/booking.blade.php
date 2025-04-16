<div>


<!-- {{--    {{ dd($option) }}--}} -->
    <x-splade-form method="POST" href="{{ route('hotel.booking') }}" :default="['option'=>$option]">
        <x-splade-input type="hidden" name="option"/>
        @foreach($option['Rooms'] as $room)
            @if(is_array($room))
                @foreach($room as $r)
                    <div
                        class="flex gap-2 bg-gray-400 hover:bg-gray-300 mb-2 justify-between p-4 rounded-md">
                        <div class="flex flex-col gap-2">
                            <span>Room Id: {{ $r['RoomId'] }}</span>
                            <span>Room Name: {{ $r['RoomName'] }}</span>
                        </div>
                        <div>
                            Room Price: {{ $r['RoomPrice'] }}
                        </div>
                    </div>
                    @php($i = 1)
                    @while($i <= $r['NumAdults'])
                        Adult {{ $i }} Details:
                        <x-splade-input name="titleAdult{{ $r['RoomId'] }}" label="Title" required placeholder="Title"/>
                        <x-splade-input name="firstNameAdult{{ $r['RoomId'] }}" label="First Name" required
                                        placeholder="First Name"/>
                        <x-splade-input name="lastNameAdult{{ $r['RoomId'] }}" label="Last Name" required
                                        placeholder="Last Name"/>
                        @php($i++)
                    @endwhile
                    @php($i = 1)
                    @while($i <= $r['NumChildren'])
                        Child {{ $i }} Details:

                        <x-splade-input name="titleChild{{ $r['RoomId'] }}" label="Title" required placeholder="Title"/>
                        <x-splade-input name="firstNameChild{{ $r['RoomId'] }}" label="First Name" required
                                        placeholder="First Name"/>
                        <x-splade-input name="lastNameChild{{ $r['RoomId'] }}" label="Last Name" required
                                        placeholder="Last Name"/>
                        @php($i++)
                    @endwhile
                @endforeach
            @else
                <div
                    class="flex gap-2 bg-gray-400 hover:bg-gray-300 mb-2 justify-between p-4 rounded-md">
                    <div class="flex flex-col gap-2">
                        <span>Room Id: {{ $room['RoomId'] }}</span>
                        <span>Room Name: {{ $room['RoomName'] }}</span>
                    </div>
                    <div>
                        Room Price: {{ $room['RoomPrice'] }}
                    </div>
                </div>
                @php($i = 1)
                @while($i <= $room['NumAdults'])
                    Adult {{ $i }} Details:

                    <x-splade-input name="titleAdult{{ $room['RoomId'] }}" label="Title" required placeholder="Title"/>
                    <x-splade-input name="firstNameAdult{{ $room['RoomId'] }}" label="First Name" required
                                    placeholder="First Name"/>
                    <x-splade-input name="lastNameAdult{{ $room['RoomId'] }}" label="Last Name" required
                                    placeholder="Last Name"/>
                    @php($i++)
                @endwhile
                @php($i = 1)
                @while($i <= $room['NumChildren'])
                    Child {{ $i }} Details:

                    <x-splade-input name="titleChild{{ $room['RoomId'] }}" label="Title" required placeholder="Title"/>
                    <x-splade-input name="firstNameChild{{ $room['RoomId'] }}" label="First Name" required
                                    placeholder="First Name"/>
                    <x-splade-input name="lastNameChild{{ $room['RoomId'] }}" label="Last Name" required
                                    placeholder="Last Name"/>
                    @php($i++)
                @endwhile
            @endif

        @endforeach
        <x-splade-submit label="Proceed to Payment"
                         class="bg-black text-white font-bold p-2 rounded-md hover:bg-gray-900"/>
    </x-splade-form>
</div>
