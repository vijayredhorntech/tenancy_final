<x-agency.layout>
    @section('title')
        Agency_Dashboard
    @endsection


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Add Fund </span>
              </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
             <form action="{{ route('deduction') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))

                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
                         <input type="hidden" name="id" value="{{ old('name', $agency->id ?? '')  }}" id="id" placeholder="Agency name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                        
                         <input type="hidden" value="{{$agency->id}}" name="agency_id">
                         <input type="hidden" value="4" name="service_id">
                  

                        
                        
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="email" class="font-semibold text-ternary/90 text-sm">Ammount Detials</label>
                             <div class="w-full relative">
                                 <input type="number" name="balance" id="balance"  readonly="" value="" placeholder="Total balance....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


          
                         
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Add balance</label>
                             <div class="w-full relative">
                                 <input type="number" name="add_ammount" value="{{ old('add_ammount')  }}" id="phone" placeholder="Emter ammount ....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                             @error('service_name')
                             <div class="text-danger">{{ $message }}</div> @enderror+
                         </div>


                         
               

                      
                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                           <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000"> Add Fund</button>
                     </div>
                 </form>
             </div>
{{--        === form section code ends here===--}}

        </div>
    </x-front.layout>
