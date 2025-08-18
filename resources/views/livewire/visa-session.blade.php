<div>
      <div class="w-full relative">
          <img class="absolute -top-20 left-0  w-full opacity-20" style="z-index: -1" src="{{asset('assets/images/bgImage.png')}}" alt="">


          <span class="text-secondary lg:text-3xl md:text-2xl text-xl font-semibold">Visa to {{$visas['0']->destinationcountry->countryName}}</span>
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>     
              </div>
          @endif

          <section class="flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-col sm:flex-col flex-col justify-center w-full mt-6">
              {{--    section left div starts here--}}
              <div class="2xl:w-3/4 xl:w-3/4 lg:w-3/4 md:w-full sm:w-full w-full bg-white shadow-lg shadow-black/10 rounded-md p-4">
                      <span class="text-lg text-secondary font-semibold">Visa Details</span>
                   

                  <form action="{{  route('visa.book') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                      @csrf

                          <div class="flex flex-col">
                              <div class="flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-row sm:flex-row flex-col w-full justify-between mt-2 gap-2">
                                  <div class=" lg:w-[33.3%] md:w-1/3  w-full flex flex-col relative" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Visa Category</label>
                                      <input type="hidden" value="{{ $visas['0']->origin }}" name="origin">
                                      <input type="hidden" value="{{ $visas['0']->destination }}" name="destination">
                                      <select class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"  name="typeof" id="typeof">
                                          @forelse($visas as $visaServiceType)
                                              @if ($visaServiceType->VisaServices)
                                                  <option value="{{ $visaServiceType->VisaServices->id }}">
                                                      {{ $visaServiceType->VisaServices->name }}
                                                  </option>
                                              @endif
                                          @empty
                                              <div class="p-2 flex 2xl:w-full xl:w-full lg:w-full md:w-1-5 sm:w-1/3 w-1/2 flex-col border-l-4 border-l-red-500">
                                                  <span class="text-black font-semibold text-xl">No Record found</span>
                                              </div>
                                          @endforelse

                                      </select>
                                  </div>

                                  <!-- <div class=" lg:w-[33.3%] md:w-1/3  w-full flex flex-col relative" >
                                      <label for="mobile"  class=" font-semibold text-gray-800 text-sm">Visa Types</label>
                                      <select class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" id="category" name="category">
                                          <option value="">

                                          </option>
                                      </select>

                                  </div> -->
                                  <div class="lg:w-[33.3%] md:w-1/3 w-full flex flex-col relative">
                                            <label for="mobile" class="font-semibold text-gray-800 text-sm">Visa Types</label>
                                            <select 
                                                class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" 
                                                id="category" 
                                                name="category"
                                                wire:model="selectedVisaSubtype">

                                                @foreach($visaSubtype as $subtype)
                                                    <option value="{{ $subtype->id }}">
                                                        {{ $subtype->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="lg:w-[33.3%] md:w-1/3 w-full flex flex-col relative">
                                                <label for="processing" class="font-semibold text-gray-800 text-sm">Processing Time</label>
                                                <select 
                                                    class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" 
                                                    id="processing" 
                                                    name="processing"
                                                    wire:model="selectedProcessing"
                                                >

                                                    @foreach($visaProcessing as $processing)
                                                        <option value="{{ $processing->id }}">
                                                            {{ $processing->processing ?? 'N/A' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                              </div>
                          </div>
                          
                          <div class="flex flex-wrap gap-4 mt-5 w-full">
                             <div class="flex flex-col">
                                 <label class="block mt-2 font-semibold">Select User Type</label>
                                 <div class="flex gap-2 mt-2">
                                     <button type="button" id="existingUserBtn" class="bg-secondary text-white px-3 py-0.5 text-xs rounded">Existing User</button>
                                     <a href="{{route('client.index')}}">  <button type="button" id="newUserBtn" class="bg-gray-500 text-white px-3 py-1 text-xs rounded">New User</button> </a>
                                 </div>
                             </div>

                              <div id="existingUserSection" class="hidden flex flex-col ">
                                  <label class=" font-semibold text-gray-800 text-sm">Select Existing User</label>
                                  <select class="visa-select w-[250px] mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" id="existingUserDropdown" name="clientId">
                                      <option value="">Select User</option>
                                      <!-- Users will be added dynamically using AJAX -->
                                  </select>
                              </div>
                          </div>
                          <div class="addresspart flex flex-col mt-5 border-[1px] border-secondary/30 p-4"  style="display: none">
                              <div class="w-full grid lg:grid-cols-6 md:grid-cols-6 sm:grid-cols-4 grid-cols-1 gap-1">
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Last Name</label>
                                      <input type="text" name="lastname" id="lastName"  class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" placeholder="As shown in passport" readonly="">
                                  </div>
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">First Name</label>
                                      <input type="text" name="firstname"  id="firstName"  class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" placeholder="As shown in passport" readonly="">

                                  </div>
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Citizenship</label>
                                      <input type="text" name="citizenship" value="" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"  id="citizenship" readonly="">

                                  </div>
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Email</label>
                                      <input type="email" name="email"  id="email"  class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" placeholder="Enter your email" readonly="">

                                  </div>
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Phone Number</label>
                                      <input type="text"  name="phonenumber"   id="phonenumber" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60" placeholder="Enter your phone number" readonly="">

                                  </div>
                                  <div class=" w-full flex flex-col" >
                                      <label for="email"  class=" font-semibold text-gray-800 text-sm">Date of Entry</label>
                                      <input type="date" name="dateofentry" max="9999-12-31" class="visa-select w-full mt-2 py-1.5 font-medium text-black/80 text-sm rounded-[3px] border-[1px] border-secondary/50 bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                                  </div>
                                  <div class=" w-full flex flex-col items-end lg:cols-span-6 md:col-span-6 sm:col-span-4 col-span-1 " >
                                      <button type="button" id="addMoreBtn" max="9999-12-31" class="px-2 py-0.5 text-xs font-semibold rounded-sm  border-[1px] border-success text-success bg-success/10 hover:bg-success hover:text-white transition ease-in duration-2000">Add More</button>
                                  </div>
                              </div>
                          </div>

                          

                          <div id="dynamicFieldsContainer"></div>


                          
                      <div class=" flex w-full justify-end  mt-5">
                          <!-- <a class="bg-secondary text-gray-100 text-lg py-2 px-5 rounded-md submitbutton">Proceed to Payment </a> -->
                                   <input type="submit" class="cursor-pointer bg-secondary text-gray-100 text-lg py-2 px-5 rounded-md submitbutton" value=" Proceed To Payment">
                        </div>

                      

                  </form>
              </div>
             

              <div class="2xl:w-1/4 sticky top-20 xl:w-1/4 lg:w-1/4 md:w-full sm:w-full w-full  bg-white shadow-lg shadow-black/10 rounded-sm 2xl:mt-0 xl:mt-0 lg:mt-0 md:mt-2 sm:mt-2 mt-2 2xl:ml-5 xl:ml-5 lg:ml-5 md:ml-0 sm:ml-0 ml-0 h-min p-4">

                  <div class="flex flex-col pb-2 border-b-2 border-b-secondary/30">
                      <span class="text-secondary font-semibold text-xl ">Basket Details</span>
                  </div>
                  <div class="flex justify-between mt-3">
                      <span class="text-black text-md font-normal">Visa Fee:</span>
                      <span class="text-secondary text-md font-semibold visa-price">&#8377 235.58</span>
                  </div>
                  <div class="flex justify-between mt-1.5">
                      <span class="text-black text-md font-normal">Service Fee:</span>
                      <span class="text-secondary text-md font-semibold visa-commision">₹5,998.00</span>
                  </div>
                  <div class="flex justify-between mt-1.5 pb-3 border-b-2 border-b-secondary/30 ">
                      <span class="text-black text-md ">Tax:</span>
                      <span class="text-secondary text-md font-semibold" > </span>
                  </div>

                  <div class="flex justify-between mt-3">
                      <span class="text-black text-md font-normal">Total:</span>
                      <span class="text-secondary text-md font-semibold visa-total">&#8377 135.58</span>
                  </div>


                  

              </div>
              {{--    section right div ends here--}}
          </section>
      </div>
   
</div>
