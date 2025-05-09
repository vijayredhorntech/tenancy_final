<x-front.layout>
    @section('title') Visa Application @endsection


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Edit Visa Application </span>
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Agency</button> -->
            </div>
{{--        === heading section code ends here===--}}


{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
             @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-md">
                <strong>Whoops! Something went wrong.</strong>
                <ul class="mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
              @endif
          
      
           <form action="{{route('updateclient.document') }}" method="POST" enctype="multipart/form-data">     
                    @csrf
                    <input type="hidden" name="documentid" value="{{$document->id}}">
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">      
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Document Name</label>
                             <div class="w-full relative">
                                 <input type="text" name="documentname" id="name" value="{{$document->document_name}}" readonly="" readonly="" class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <!-- <i class="fa fa-applicaiton absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i> -->
                             </div>
                         </div>


                         {{-- View Document Button --}}
                    <div class="w-full relative group flex flex-col gap-1 ">
                        <label class="font-semibold text-ternary/90 text-sm">View Uploaded Document</label>
                        <a href="{{ asset('storage/' . $document->document_file) }}" 
                        target="_blank" 
                        class="inline-block bg-blue-600 text-white text-sm px-4 py-1.5 rounded hover:bg-blue-700 transition-all w-fit">
                            View Document
                        </a>
                    </div>
                                        

          

                           

                            {{-- === Select Input for Document Status === --}}
                         

                            {{-- === Select Input for Application Status === --}}
                            <div class="w-full relative group flex flex-col gap-1">
                                <label for="application_status" class="font-semibold text-ternary/90 text-sm">Application Status</label>
                                <div class="w-full relative">
                                    <select name="document_status" id="application_status" 
                                        class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 transition ease-in duration-200">
                                        <option value="0" {{ old('document_status', $document->document_status) == '0' ? 'selected' : '' }}>Pending</option>
                                        <option value="2" {{ old('document_status', $document->document_status) == '2' ? 'selected' : '' }}>Under Process</option>
                                        <option value="1" {{ old('document_status', $document->document_status) == '1' ? 'selected' : '' }}>Complete</option>
                                      </select>
                                    <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                                </div>
                            </div>

                       

              
                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                          <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button> -->
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Update Document</button>
                     </div>
                 </form>
             </div>

                </div>
            <!-- </div>

        </div> -->

        </x-front.layout>
