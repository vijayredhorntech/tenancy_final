<x-front.layout>
    @section('title')
        Agency
    @endsection



    <div
        class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        {{--        === this is code for heading section ===--}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Transaction Approval</span>
          
        </div>
        {{--        === heading section code ends here===--}}



        {{--        === this is code for form section ===--}}
        <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20">
            <form action="{{ route('transaction_store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))

                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
              
               
                <div class="w-full flex flex-col gap-2 px-4 mt-8">
           
                    <div class="w-full grid xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2">
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="email" class="font-semibold text-ternary/90 text-sm">Agecny Name</label>
                            <div class="w-full relative">
                             <input type="hidden" name="id" id="agency_name" placeholder="Email....." readonly="" value="{{$credits->id}}">
                                <input type="text" name="agency_name" id="agency_name" placeholder="Email....." readonly="" value="{{$credits->agency->name}}"
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>
                        <div class="w-full relative group flex flex-col gap-1">
                            <label for="name" class="font-semibold text-ternary/90 text-sm">Ammount</label>
                            <div class="w-full relative">
                                <input type="number" name="ammount" id="telephone" placeholder="Ammount" value="{{$credits->amount}}"
                                       class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                            </div>
                        </div>

                        <div class="w-full relative group flex flex-col gap-1">
                             <span class="font-semibold text-ternary/90 text-sm">Approve</span>
                             <div class="flex gap-4">
                                 <label class="flex items-center gap-2">
                                     <input type="radio" name="status" value="0" class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0 " checked>
                                    Yes
                                 </label>
                                 <label class="flex items-center gap-2">
                                     <input type="radio" name="status" value="3" class="appearance-none rounded-full text-ternary/90 w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                    No
                                 </label>
                             </div> 
                         </div>

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Remark</label>
                             <div class="w-full relative">
                                 <textarea   name="remark" id="remark" rows="1" placeholder="Remark" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"></textarea>
                                 <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div>

                       </div>
                </div>
      
        
                <div class="w-full flex justify-end px-4 pb-4 gap-2 mt-8">
            
                    <button type="submit"
                            class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">
                        Update fund
                    </button>
                </div>
            </form>
        </div>
     


   
    </div>
</x-front.layout>
