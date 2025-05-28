<x-front.layout>
    @section('title')Agency @endsection


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
       
               Assign Country Field <br>
               Visa Name : {{$visadetails->VisaServices->name}}
                <br>
                Country : {{$visadetails->destinationcountry->countryName}}
                <br>
            </div>
{{--        === heading section code ends here===--}}



{{--        === form section code ends here===--}}




            <div class="w-full overflow-x-auto p-4">
            <form action="{{ route('superadmin.assignclientfieldcountry') }}" method="POST" enctype="multipart/form-data">
            @csrf

               <input type="hidden" name="assigncoutnry" value="{{$visadetails->id}}">
                <div class="rounded-[3px] bg-white px-8 py-12 shadow-lg shadow-gray-300 border-[2px] border-gray-400/50  relative">
                    
                     <div class="flex justify-between items-center">
                       
                         <div class="flex gap-2 items-center">
                             <label class="flex items-center space-x-2 ">
                                 <input type="checkbox"  class="hidden peer" disabled>
                                 <div class="w-[20px] h-[20px] border-2 border-gray-400 rounded-full peer-checked:rounded-[3px] flex items-center justify-center peer-checked:bg-secondary/60 peer-checked:border-secondary/90 transition">
                                 </div>
                                 <span class="text-gray-500  peer-checked:text-secondary font-medium ">Not Allowed</span>
                             </label>
                             <label class="flex items-center space-x-2 ">
                                 <input type="checkbox"  class="hidden peer" checked disabled>
                                 <div class="w-[20px] h-[20px] border-2 border-gray-400 rounded-full peer-checked:rounded-[3px] flex items-center justify-center peer-checked:bg-secondary/60 peer-checked:border-secondary/90 transition">
                                 </div>
                                 <span class="text-gray-300  peer-checked:text-secondary font-medium ">Allowed</span>
                             </label>
                         </div>

                     </div>
                     <div class="w-full flex flex-wrap gap-4 mt-12">
                  

                     @php   
                     $alreadySelect = $assign && $assign->name_of_field ? json_decode($assign->name_of_field, true) : [];
                     // Decode stored JSON array
                        @endphp

                        @foreach ($combined as $key => $value)
                            <label class="flex items-center space-x-2 cursor-pointer justify-evenly">
                                <input 
                                    type="checkbox" 
                                    value="{{ $key }}" 
                                    name="visa_fields[]" 
                                    class="hidden peer"
                                    {{ in_array($key, $alreadySelect ?? []) ? 'checked' : '' }}>

                                <div class="w-[20px] h-[20px] border-2 border-gray-400 rounded-full peer-checked:rounded-[3px] flex items-center justify-center peer-checked:bg-secondary/60 peer-checked:border-secondary/90 transition"></div>

                                <span class="text-gray-400 peer-checked:text-secondary font-medium">
                                    {{ ucfirst(str_replace('_', ' ', $key)) }}
                                </span>
                            </label>
                        @endforeach


                    
                            




                     </div>
                     <br> 
                     <br> 
                     <input type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000" value="Assign Country">
                 </div>

            </div>
          
</form>

        </div>
</x-front.layout> 
