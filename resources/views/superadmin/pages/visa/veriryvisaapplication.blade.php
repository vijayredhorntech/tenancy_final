<x-agency.layout>
    @section('title')Client Application @endsection

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
        {{-- Form Heading --}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Visa Application Form</span>
            <a href="{{ url()->previous() }}" class="text-sm text-primary hover:underline">
              ← Back
           </a>
        </div>
        
        <div class="w-full ">

 
              @if($bookingData->destination->countryName == 'China')
                @include('components.application.chinaviewapplication', ['bookingData' => $bookingData])

            @elseif($bookingData->visa->name == 'Schengen Visa')
                    @include('components.application.Scheneganviewapplication', ['bookingData' => $bookingData])

            @else
                @include('components.application.viewapplication', ['bookingData' => $bookingData])

            @endif

           </div>

      
      
    </div>

  
 

</x-agency.layout>