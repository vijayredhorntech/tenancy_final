<x-front.layout>
    @section('title')Assignment @endsection


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        {{-- === this is code for heading section ===--}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Assignment View </span>
         
        </div>
 
        <div class="w-full overflow-x-auto p-4">
           
        <div class="container mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4">{{ $assignment->title }}</h2>

        <div class="flex flex-wrap">
            <!-- Assignment Image -->
            <div class="w-full md:w-1/3">
            @php
                $images = json_decode($assignment->images, true) ?? []; // Ensure it's an array
              
            @endphp
            <div class="flex gap-6 overflow-x-auto p-2">
                @foreach($images as $image)
                <a href="{{ asset('images/assignment/assignmentpic/' . $image) }}" target="_blank">
                    <div class="flex-shrink-0 w-64">
                        <img src="{{ asset('images/assignment/assignmentpic/' . $image) }}" 
                            alt="Assignment Image" class="w-full h-56 object-cover rounded-lg shadow-lg">
                    </div>
                </a>

                @endforeach
            </div>

                        </div>

            <!-- Assignment Details -->
            <div class="w-full md:w-2/3 px-4">
                <p class="text-gray-700"><strong>Assigned By:</strong> {{ $assignment->user->name ?? 'N/A' }}</p>
                <p class="text-gray-700"><strong>Assigned To:</strong> {{ $assignment->assign_to }}</p>
                <p class="text-gray-700"><strong>Due Date:</strong> {{ $assignment->due_date }}</p>
                <p class="text-gray-700"><strong>Status:</strong> 
                    <span class="px-2 py-1 text-white text-xs rounded 
                        {{ $assignment->status === 'completed' ? 'bg-green-500' : 'bg-yellow-500' }}">
                        {{ ucfirst($assignment->status) }}
                    </span>
                </p>
                <p class="text-gray-700 mt-4"><strong>Description:</strong> {{ $assignment->description }}</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6">
            <a href="{{ route('assignment') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Back</a>

          {{--  <a href="{{ route('assign.edit', $assignment->id) }}" 
               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>

            <a href="{{ route('assign.delete', $assignment->id) }}" 
               class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700"
               onclick="return confirm('Are you sure you want to delete this assignment?');">Delete</a> --}}
        </div>
    </div>
</div>

        
        </div>
        {{-- === table section code ends here===--}}
    </div>


    

</x-front.layout>