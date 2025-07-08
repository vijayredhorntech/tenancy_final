<div id="sideBarDiv" class="z-20 w-72 p-4 h-[100vh] bg-ternary overflow-x-hidden overflow-y-auto flex-none xl:static lg:static absolute top-0 left-0 xl:block lg:block hidden ">
    <div class="w-full flex flex-col justify-center items-center border-b-[1px] pb-2 border-b-gray-100/20 shadow-lg shadow-gray-700/10">
        @if(isset($user->profile))
        <img src="{{ asset('images/user/profile/' . $user->profile) }}" alt="Cloud Travel" class="h-16 w-auto" class="h-24 mr-4" />
        @else
        <img src="{{asset('assets/images/logo.png')}}" class="h-16 w-auto" alt="">
        @endif
        {{-- <img src="" class="h-16 w-auto" alt="Cloud Travel"> --}}
        <span class="font-semibold text-white/90 mt-2 text-2xl">{{$user->name}}</span>
        <p class="text-secondary/90 text-xs"><i class="fa-regular fa-calendar-days mr-1"></i> <span id="clockDiv"></span> </p>
    </div>

    <div class="w-full flex flex-col mt-12 gap-3 ">
    @canany(['view dashboard', 'manage everything'])
        <a href="{{route('dashboard')}}">
            <div class="{{Route::currentRouteName()==='dashboard'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-tv mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Dashboard</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
        @endcanany

        <!-- Services Part -->
        <!-- @canany(['service view', 'manage everything'])
        <div class="">
            <div onclick="document.getElementById('servicesDiv').classList.toggle('hidden');document.getElementById('servicesArrow').classList.toggle('-rotate-90')" class="{{Route::currentRouteName()==='service'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer  relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-plane-departure mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Services</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-2000 " id="servicesArrow"> </i>
            </div>
            <ul id="servicesDiv" class="pl-10 mt-2 flex flex-col hidden">
                <a href="">
                    <li class="{{Route::currentRouteName()==='services'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa fa-plane-departure mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Flights</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>
                <a href="">
                    <li class="{{Route::currentRouteName()==='services'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa fa-hotel mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Hotels</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>
                <a href="">
                    <li class="{{Route::currentRouteName()==='services'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa-brands fa-cc-visa mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Visa</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>
                <a href="">
                    <li class="{{Route::currentRouteName()==='services'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa fa-network-wired mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Others</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>

            </ul>
        </div>
        @endcanany -->

        <!-- Flights Part -->

           <!-- end flights part -->
        <!-- Hotels Part -->

        <!-- Doc sign part -->

        @canany(['docsign', 'manage everything'])
        <a href="{{route('superadmin.docsign')}}">
            <div class="{{Route::currentRouteName()==='superadmin.docsign'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fas fa-file-signature mr-2 text-sm"></i>
                    <span class="text-lg font-medium"> Document Sign </span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
       @endcanany

     {{--   @canany(['doc sign', 'manage everything'])
            <div class="">
                <div onclick="document.getElementById('docSignDiv').classList.toggle('hidden');document.getElementById('docArrow').classList.toggle('-rotate-90')" class="{{Route::currentRouteName()==='visa'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer  relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                    <div class="flex items-center">
                      <i class="fas fa-file-signature mr-2 text-sm"></i>
                        <span class="text-lg font-medium">Document Sign</span>
                    </div>
                    <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-2000 " id="docArrow"> </i>
                </div>
                <ul id="docSignDiv" class="pl-10 mt-2 flex flex-col hidden">
                    <a href="{{route('supplier.hotel')}}">
                        <li class="{{Route::currentRouteName()==='supplier.hotel'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                            <div class="flex items-center">
                            <i class="fa-solid fa-handshake mr-2 text-sm" ></i>
                                <span class="text-lg font-medium"></span>
                            </div>
                            <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                        </li>
                    </a>
                </ul>
            </div>
        @endcanany  --}}

          <!-- Visa Part -->
        @canany(['hotel view', 'manage everything'])
            <div class="">
                <div onclick="document.getElementById('hotelDiv').classList.toggle('hidden');document.getElementById('hotelArrow').classList.toggle('-rotate-90')" class="{{Route::currentRouteName()==='visa'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer  relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                    <div class="flex items-center">
                        <i class="fa fa-hotel mr-2 text-sm"></i>
                        <span class="text-lg font-medium">Hotel</span>
                    </div>
                    <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-2000 " id="hotelArrow"> </i>
                </div>
                <ul id="hotelDiv" class="pl-10 mt-2 flex flex-col hidden">
                    <a href="{{route('supplier.hotel')}}">
                        <li class="{{Route::currentRouteName()==='supplier.hotel'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                            <div class="flex items-center">
                            <i class="fa-solid fa-handshake mr-2 text-sm" ></i>
                                <span class="text-lg font-medium">Supplier Setting</span>
                            </div>
                            <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                        </li>
                    </a>
                </ul>
            </div>
        @endcanany
        <!-- end hotels part  -->
        <!-- Visa Part -->
        @canany(['visa view', 'manage everything'])
        <div class="">
            <div onclick="document.getElementById('visasDiv').classList.toggle('hidden');document.getElementById('visaArrow').classList.toggle('-rotate-90')" class="{{Route::currentRouteName()==='visa'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer  relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa-brands fa-cc-visa mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Visa</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-2000 " id="visaArrow"> </i>
            </div>
            <ul id="visasDiv" class="pl-10 mt-2 flex flex-col hidden">
                 <a href="{{route('superadminview.allapplication')}}">
                    <li class="{{Route::currentRouteName()==='superadminview.allapplication'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                          <i class="fa-solid fa-flag mr-2 text-sm" ></i>
                            <span class="text-lg font-medium">Visa Application </span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>

                <a href="{{route('view.country')}}">
                    <li class="{{Route::currentRouteName()==='view.country'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                          <i class="fa-solid fa-flag mr-2 text-sm" ></i>
                            <span class="text-lg font-medium">Countries</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>
                <a href="{{route('allvisa.view')}}">
                    <li class="{{Route::currentRouteName()==='allvisa.view'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa-brands fa-cc-visa mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Visa</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>
                <a href="{{route('visa.country')}}">
                    <li class="{{Route::currentRouteName()==='visa.country'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa-brands fa-cc-visa mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Visa Country</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>

                <a href="{{route('visa.forms')}}">
                    <li class="{{Route::currentRouteName()==='visa.forms'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa-brands fa-cc-visa mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Forms </span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>
             

            </ul>
        </div>
        @endcanany


    


        <!-- Client Agency Part -->
        @canany(['agency view', 'manage everything'])
        <a href="{{route('agency')}}">
            <div class="{{Route::currentRouteName()==='agency'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa-regular fa-building mr-2 text-sm"></i>
                    <span class="text-lg font-medium"> Client Agency / (B2B)</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>

        @endcanany

 


        <!-- Staff Part -->
        @canany(['staff view', 'manage everything'])
        <div class="">
            <div onclick="document.getElementById('staffDiv').classList.toggle('hidden');document.getElementById('staffArrow').classList.toggle('-rotate-90')" class="{{Route::currentRouteName()==='service'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer  relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-users mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Staff</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-2000 " id="staffArrow"> </i>
            </div>
            <ul id="staffDiv" class="pl-10 mt-2 flex flex-col hidden">
                <a href="{{route('staff')}}">
                    <li class="{{Route::currentRouteName()==='staff'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa fa-eye mr-2 text-sm"></i>
                            <span class="text-lg font-medium">View Staff</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>

                <a href="{{route('staff.attandance')}}">
                
                    <li class="{{Route::currentRouteName()==='staff.attandance'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa fa-hotel mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Staff Attendance Status</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>
                
                <a href="{{route('staff.wages')}}">
                    <li class="{{Route::currentRouteName()==='staff.wages'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa fa-hotel mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Staff Wage Management</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>

            </ul>
        </div>
        @endcanany

        @canany(['staff view', 'manage everything'])
        <div class="">
            <div onclick="document.getElementById('leaveDiv').classList.toggle('hidden');document.getElementById('leaveArrow').classList.toggle('-rotate-90')" class="{{Route::currentRouteName()==='service'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer  relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa-solid fa-umbrella-beach mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Leave Managment</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-2000 " id="leaveArrow"> </i>
            </div>
            <ul id="leaveDiv" class="pl-10 mt-2 flex flex-col hidden">
     
                <a href="{{route('add.leave')}}">
                    <li class="{{Route::currentRouteName()==='services'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa fa-hotel mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Add Leave</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>

                <a href="{{route('pending.leave')}}">
                    <li class="{{Route::currentRouteName()==='pending.leave'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa-brands fa-cc-visa mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Leave Application </span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>
            </ul>
        </div>
        @endcanany

     
  
        @canany(['booking', 'manage everything'])
        <div class="">
            <div onclick="document.getElementById('bookingDiv').classList.toggle('hidden');document.getElementById('bookingArrow').classList.toggle('-rotate-90')" class="{{Route::currentRouteName()==='service'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer  relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa fa-calendar-days mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Booking</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-2000 " id="bookingArrow"> </i>
            </div>
            <ul id="bookingDiv" class="pl-10 mt-2 flex flex-col hidden">
                <a href="{{route('flight.booking')}}">
                    <li class="{{Route::currentRouteName()==='flight.booking'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                           <i class="fa fa-plane mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Flight</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>

                <a href="{{route('superadminhotel.booking')}}">
                
                    <li class="{{Route::currentRouteName()==='superadminhotel.booking'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa fa-hotel mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Hotel</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>

                <a href="{{route('superadminvisa.booking')}}">
                
                <li class="{{Route::currentRouteName()==='superadminvisa.booking'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                    <div class="flex items-center">
                    <i class="fas fa-passport mr-2 text-sm"></i>
                        <span class="text-lg font-medium">Visa Application</span>
                    </div>
                    <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                </li>
            </a>



                
           

            </ul>
        </div>
        @endcanany

        @canany(['supplier view', 'manage everything'])
        <div class="">
            <div onclick="document.getElementById('cancelinvoiceDiv').classList.toggle('hidden');document.getElementById('cancelArrow').classList.toggle('-rotate-90')" class="{{Route::currentRouteName()==='visa'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer  relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa-solid fa-file-invoice mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Invoice</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-2000 " id="cancelArrow"> </i>
            </div>
            <ul id="cancelinvoiceDiv" class="pl-10 mt-2 flex flex-col hidden">
          


               <a href="{{ route('superadmin.allinvoices') }}">
               <li class="{{ Route::currentRouteName() === 'superadmin.allinvoices' ? 'border-gray-100/60 bg-primary/90' : 'border-ternary' }}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60 hover:bg-secondary/90 transition ease-in duration-2000">
                  <div class="flex items-center">
                      <i class="fas fa-file-invoice mr-2 text-sm"></i>
                      <span class="text-lg font-medium">All Invoices</span>
                  </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                </li>
                </a>

                <a href="{{ route('superadmin.editindex') }}">
                    <li class="{{ Route::currentRouteName() === 'superadmin.editindex' ? 'border-gray-100/60 bg-primary/90' : 'border-ternary' }}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60 hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fas fa-edit mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Edited Invoices</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>

                <a href="{{route('superadmin.cancelindex')}}">
                    <li class="{{Route::currentRouteName()==='superadmin.cancelindex'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                              <i class="fas fa-times-circle mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Cancel Invoice</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>
                



            </ul>
        </div>
        @endcanany

        @canany(['supplier view', 'manage everything'])
        <div class="">
            <div onclick="document.getElementById('supplierDiv').classList.toggle('hidden');document.getElementById('supplierArrow').classList.toggle('-rotate-90')" class="{{Route::currentRouteName()==='visa'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer  relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa-solid fa-handshake mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Supplier's Accounts</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-2000 " id="supplierArrow"> </i>
            </div>
            <ul id="supplierDiv" class="pl-10 mt-2 flex flex-col hidden">
          

                <a href="{{route('superadmin.hotel')}}">
                    <li class="{{Route::currentRouteName()==='superadmin.hotel'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                              <i class="fa-solid fa-hotel mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Hotel</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>
                <a href="{{route('superadmin.flight')}}">
                    <li class="{{Route::currentRouteName()==='superadmin.flight'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                        <i class="fa-solid fa-plane mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Flight</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>
          


            </ul>
        </div>
        @endcanany



        <!-- Account part Part -->
        @canany(['account','inventory','expensive', 'manage everything'])
        <div class="">
            <div onclick="document.getElementById('accountDiv').classList.toggle('hidden');document.getElementById('visaArrow').classList.toggle('-rotate-90')" class="{{Route::currentRouteName()==='visa'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer  relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa-brands fa-cc-visa mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Accounts</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-2000 " id="visaArrow"> </i>
            </div>
            <ul id="accountDiv" class="pl-10 mt-2 flex flex-col hidden">
                           
                            <a href="{{route('client.account')}}">
                                <li class="{{Route::currentRouteName()==='client.account'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                                    <div class="flex items-center">
                                        <i class="fa-brands fa-cc-visa mr-2 text-sm"></i>
                                        <span class="text-lg font-medium">B2B Funds  </span>
                                    </div>
                                    <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                                </li>
                            </a>

                        @canany(['inventory', 'manage everything'])
                            <a href="{{route('superadmin.inventory')}}">
                                <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                                    <div class="flex items-center">
                                        <i class="fas fa-boxes-stacked mr-2 text-sm"></i>
                                        <span class="text-lg font-medium">Inventory</span>
                                    </div>
                                    <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                                </div>
                            </a>
                    @endcanany

                    @canany(['expensive', 'manage everything'])
                            <a href="">
                                <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                                    <div class="flex items-center">
                                        <i class="fas fa-money-bill-wave mr-2 text-sm"></i>
                                        <span class="text-lg font-medium">Expensive</span>
                                    </div>
                                    <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                                </div>
                            </a>
                    @endcanany
              </ul>
        </div>
        @endcanany

          <!-- License &  Insurance part Part -->
        @canany(['license', 'manage everything'])
        <div class="">
            <div onclick="document.getElementById('licenseDiv').classList.toggle('hidden');document.getElementById('visaArrow').classList.toggle('-rotate-90')" class="{{Route::currentRouteName()==='visa'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer  relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa-brands fa-cc-visa mr-2 text-sm"></i>
                    <span class="text-lg font-medium">License &  Insurance</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-2000 " id="visaArrow"> </i>
            </div>
            <ul id="licenseDiv" class="pl-10 mt-2 flex flex-col hidden">
                <a href="{{route('view.country')}}">
                    <li class="{{Route::currentRouteName()==='view.country'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                          <i class="fa-solid fa-flag mr-2 text-sm" ></i>
                            <span class="text-lg font-medium">License</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>
                <a href="{{route('visa.view')}}">
                    <li class="{{Route::currentRouteName()==='visa.view'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa-brands fa-cc-visa mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Insurance </span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>

              </ul>
        </div>
        @endcanany


     <!-- Operational -->
        @canany(['permission view','role view','manage everything'])
        <div class="">
            <div onclick="document.getElementById('operationalDiv').classList.toggle('hidden');document.getElementById('staffArrow').classList.toggle('-rotate-90')" class="{{Route::currentRouteName()==='service'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer  relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa-solid fa-bolt mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Operational</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-2000 " id="staffArrow"> </i>
            </div>
            <ul id="operationalDiv" class="pl-10 mt-2 flex flex-col hidden">
            
               @canany(['permission view', 'manage everything'])
                    <a href="{{route('superadmin.permission')}}">
                            <li class="{{Route::currentRouteName()==='superadmin.permission'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                                    <div class="flex items-center">
                                        <i class="fa fa-lock-open mr-2 text-sm"></i>
                                        <span class="text-lg font-medium">Permissions</span>
                                    </div>
                                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                            </li>
                        </a>
                @endcanany

                @canany(['role view', 'manage everything'])
                    <a href="{{route('superadmin.role')}}">
                        <li class="{{Route::currentRouteName()==='superadmin.role'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                                <div class="flex items-center">
                                    <i class="fa fa-shield-halved mr-2 text-sm"></i>
                                    <span class="text-lg font-medium">Roles</span>
                                </div>
                            <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                        </li>
                    </a>
               @endcanany

               @canany(['team managment', 'manage everything'])
                    <a href="{{route('teammanagment')}}">
                        <div class="{{Route::currentRouteName()==='teammanagment'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                            <div class="flex items-center">
                                <i class="fas fa-user mr-2 text-sm"></i>
                                <span class="text-lg font-medium">Team Managment</span>
                            </div>
                            <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                        </div>
                    </a>
             @endcanany
      
            </ul>
        </div>
        @endcanany


        @if($user->type!=="superadmin")
        <a href="{{route('profile')}}">
            <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-user-lock mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Profile</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
        @endif

      


        <a href="{{route('assignment')}}">
            <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fas fa-tasks mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Assignment</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>


        @if($user->type!=="superadmin")
        <a href="{{route('leaves')}}">
            <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-user-lock mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Leaves Application</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
        @endif

        <!-- <a href="">
            <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-user-lock mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Admin Settings</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a> -->

        @canany(['conversation', 'manage everything'])
        <a href="{{route('superadmin.ticket')}}">
            <div class="{{Route::currentRouteName()==='superadmin.conversation'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fas fa-comments mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Conversation</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
        @endcanany


      

        @canany(['transaction', 'manage everything'])
        <a href="{{route('transaction_approvals')}}">
            <div class="{{Route::currentRouteName()==='transaction_approvals'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fas fa-file-invoice-dollar mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Transaction Approvals</span>
                </div>
                @if ($transaction_approvals_count > 0)
                <div class="absolute -top-2 -right-0 h-6 w-6 z-10 rounded-tl-full rounded-tr-full rounded-br-full bg-secondary text-white flex justify-center items-center font-bold text-xs">
                    {{ $transaction_approvals_count }}
                </div>
                @endif
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
        @endcanany

        @canany(['terms', 'manage everything'])
        <a href="{{route('superadmin.termtype')}}">
            <div class="{{Route::currentRouteName()==='superadmin.termtype'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fas fa-file-contract mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Terms and conditions</span>
                </div>

                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
        @endcanany

        <form action="{{route('logout')}}">
            @csrf
            <button type="submit" class="{{Route::currentRouteName()==='logout'?'border-gray-100/60 bg-secondary/90':'border-ternary'}} cursor-pointer w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-right-from-bracket mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Logout</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </button>
        </form>
    </div>


    <div class="w-full flex flex-col mt-20">
        <span class="text-white/90 text-xs font-semibold">Developed by:</span>
        <a href="https://himsoftsolution.com" target="_blank" class="mt-2 text-primary text-md font-semibold hover:text-secondary transition ease-in duration-2000">Him Soft Solution</a>
        <span class="text-white/90 text-sm font-semibold mt-4">Version: 1.0.0</span>
    </div>
</div>

<script>
    // ===function to display time===
    function updateClock() {
        var today = new Date();
        var date = ('0' + today.getDate()).slice(-2) + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + today.getFullYear();
        var time = ('0' + today.getHours()).slice(-2) + ":" + ('0' + today.getMinutes()).slice(-2) + ":" + ('0' + today.getSeconds()).slice(-2);
        var dateTime = date + ' ' + time;
        document.getElementById("clockDiv").textContent = dateTime;
    }
    updateClock();
    // ===function to display time ends===
</script>