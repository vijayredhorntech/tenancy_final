<x-agency.layout>
    @section('title')
        Flight serach
    @endsection

<div class="w-full">
             <div class="w-full bg-white p-4 flex flex-col gap-2 rounded-t-md mx-auto">

                 <span class="font-semibold lg:text-3xl md:text-2xl sm:text-xl text-lg"> Discover, Explore the World with Ease </span>
                  <div class="flex gap-2 py-2 w-full border-b-[1px] border-b-ternary/20">
                     
                  
                  </div>
             </div>
             <div class="w-full mx-auto bg-white rounded-b-md shadow-lg shadow-ternary/30">
          
                     <x-flight-search></x-flight-search>               

             </div>
         </div>
     </div>

     </x-front.layout>