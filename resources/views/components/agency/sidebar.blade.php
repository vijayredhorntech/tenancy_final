<div id="sideBarDiv" class="z-20 w-72 p-4 h-[100vh] bg-ternary overflow-x-hidden overflow-y-auto flex-none xl:static lg:static absolute top-0 left-0 z-50 xl:block lg:block hidden ">

<div class="w-full flex flex-col justify-center items-center border-b-[1px] pb-2 border-b-gray-100/20 shadow-lg shadow-gray-700/10">

    {{-- <img src="{{asset($user_data->profile ? 'images/agencies/logo/' . $user_data->profile : 'assets/images/logo.png') }}" class="h-20 w-20 object-cover rounded-full" alt="Cloud Travel"> --}}
    <img src="{{ asset($user_data->type == 'staff' ? 'images/user/agency/profile/' . $user_data->profile : 'images/agencies/logo/' . $user_data->profile) }}"
     onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.png') }}';"
     class="h-20 w-20 object-cover rounded-full"
     alt="Cloud Travel">

        <span class="font-semibold text-white/90 mt-2 text-2xl">{{ ucwords($user_data->name ? $user_data->name : 'Login') }}</span>
        <p class="text-secondary/90 text-xs" ><i class="fa-regular fa-calendar-days mr-1"></i> <span id="clockDiv"></span> </p>
    </div>


    <div class="w-full flex flex-col mt-12 gap-3 ">

    @if($user_data->type != 'staff')
      <a href="{{route('agency_dashboard')}}">
            <div class="{{Route::currentRouteName()==='agency_dashboard'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-tv mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Dashboard</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
        @endif

        @if($user_data->getAllPermissions()->pluck('name')->intersect(['service view', 'manage everything'])->isNotEmpty())

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




            @if(isset($services) && $services->isNotEmpty())

                @foreach($services as $icon => $service)

                    <li class="{{ Route::currentRouteName() === 'dashboard' ? 'border-gray-100/60 bg-primary/90' : 'border-ternary' }}
                        w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative
                        hover:border-gray-100/60 hover:bg-secondary/90 transition ease-in duration-200">

                        <a href="{{ route($service) }}" class="flex items-center w-full">
                            <span class="text-xl mr-2">{!! $icon !!}</span>  <!-- Ensure $icon contains valid HTML -->
                            <span class="text-lg font-medium">{{ ucfirst($service) }}</span>
                        </a>

                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                    
                @endforeach
             @endif


            </ul>
        </div>
     @endif


     @if($user_data->getAllPermissions()->pluck('name')->intersect(['visa view', 'manage everything'])->isNotEmpty())
     @if($visapermission)
        <div class="">
            <div onclick="document.getElementById('visaDiv').classList.toggle('hidden');document.getElementById('visaArrow').classList.toggle('-rotate-90')" class="{{Route::currentRouteName()==='service'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer  relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa-brands fa-cc-visa mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Visa</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-2000 " id="visaArrow"> </i>
            </div>
            <ul id="visaDiv" class="pl-10 mt-2 flex flex-col hidden">
            <a href="{{ route('agency.application', ['type' => 'all']) }}">
                    <li class="{{Route::currentRouteName()==='agency.application'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa fa-eye mr-2 text-sm"></i>
                            <span class="text-lg font-medium">All Application</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>

                <a href="{{ route('agency.application', ['type' => 'pending']) }}">
                    <li class="{{Route::currentRouteName()==='agency.applicationS'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa fa-eye mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Pending Application</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>
                @if($user_data->getAllPermissions()->pluck('name')->intersect(['notification', 'manage everything'])->isNotEmpty())
             <li>  <a href="{{route('agency.notification')}}">
                <div class="{{Route::currentRouteName()==='agency.notification'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                    <div class="flex items-center">
                        <i class="fas fa-bell mr-2 text-sm"></i>
                        <span class="text-lg font-medium">Notification </span>
                    </div>
                    <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                </div>
            </a>
         </li>
            @endif
            @if($user_data->getAllPermissions()->pluck('name')->intersect(['downloadcenter', 'manage everything'])->isNotEmpty())

           <li>
             <a href="{{route('agency.document.download')}}">
                <div class="{{Route::currentRouteName()==='agency.document.download'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                    <div class="flex items-center">
                        <i class="fas fa-download mr-2 text-sm"></i>
                        <span class="text-lg font-medium">Download Center </span>
                    </div>
                    <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                </div>
            </a>
         </li>
            @endif

            </ul>
        </div>
        @endif
        @endif

        @if($user_data->getAllPermissions()->pluck('name')->intersect(['clint', 'manage everything'])->isNotEmpty())
        <a href="{{route('client.index')}}">
            <div class="{{Route::currentRouteName()==='client.index'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-users mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Client / (B2C)</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>

        @endif

        <!-- invoice data -->
         
        @if($user_data->getAllPermissions()->pluck('name')->intersect(['invoice', 'manage everything'])->isNotEmpty())
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
          


            @php
                    // detect “active” state for this link
                    $isActive = Route::currentRouteNamed('invoice.all')
                            && request('type') === 'agencies';  // match the same string you pass
                @endphp

                <li>
                    <a href="{{ route('invoice.all', ['type' => 'agencies']) }}"
                    class="{{ $isActive ? 'border-gray-100/60 bg-primary/90' : 'border-ternary' }}
                            w-full flex justify-between items-center py-2 px-4 rounded-[3px]
                            text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative
                            hover:border-gray-100/60 hover:bg-secondary/90 transition ease-in duration-2000">

                        <div class="flex items-center">
                            <i class="fas fa-file-invoice mr-2 text-sm"></i>
                            <span class="text-lg font-medium">All Invoices</span>
                        </div>

                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-1/2 -translate-y-1/2"></i>
                    </a>
                </li>

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
       @endif
       


        @if($user_data->getAllPermissions()->pluck('name')->intersect(['booking view', 'manage everything'])->isNotEmpty())
                    @php
                        $availableRoutes = array_values($services->toArray()); // Get route names from $services

                        @endphp

            @if(in_array('Hotel', $availableRoutes) || in_array('Hotel', $availableRoutes) || in_array('superadminvisa.booking', $availableRoutes))
                <div>
                    <div onclick="document.getElementById('bookingDiv').classList.toggle('hidden');document.getElementById('bookingArrow').classList.toggle('-rotate-90')"
                        class="{{ Route::currentRouteName() === 'service' ? 'border-gray-100/60 bg-secondary/90' : 'border-ternary' }}
                        w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer relative hover:border-gray-100/60 hover:bg-secondary/90 transition ease-in duration-200">

                        <div class="flex items-center">
                            <i class="fa fa-calendar-days mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Booking</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                        <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-200" id="bookingArrow"></i>
                    </div>

                    <ul id="bookingDiv" class="pl-10 mt-2 flex flex-col hidden">
                        @if(in_array('Flight', $availableRoutes))
                            <a href="{{ route('flight.booking') }}">
                                <li class="{{ Route::currentRouteName() === 'flight.booking' ? 'border-gray-100/60 bg-primary/90' : 'border-ternary' }} w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60 hover:bg-secondary/90 transition ease-in duration-200">
                                    <div class="flex items-center">
                                        <i class="fa fa-plane mr-2 text-sm"></i>
                                        <span class="text-lg font-medium">Flight</span>
                                    </div>
                                    <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                                </li>
                            </a>
                        @endif

                        @if(in_array('Hotel', $availableRoutes))
                            <a href="{{ route('superadminhotel.booking') }}">
                                <li class="{{ Route::currentRouteName() === 'superadminhotel.booking' ? 'border-gray-100/60 bg-primary/90' : 'border-ternary' }} w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60 hover:bg-secondary/90 transition ease-in duration-200">
                                    <div class="flex items-center">
                                        <i class="fa fa-hotel mr-2 text-sm"></i>
                                        <span class="text-lg font-medium">Hotel</span>
                                    </div>
                                    <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                                </li>
                            </a>
                        @endif

                        @if(in_array('Visa', $availableRoutes))
                            <a href="{{ route('superadminvisa.booking') }}">
                                <li class="{{ Route::currentRouteName() === 'superadminvisa.booking' ? 'border-gray-100/60 bg-primary/90' : 'border-ternary' }} w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60 hover:bg-secondary/90 transition ease-in duration-200">
                                    <div class="flex items-center">
                                        <i class="fas fa-passport mr-2 text-sm"></i>
                                        <span class="text-lg font-medium">Visa Application</span>
                                    </div>
                                    <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                                </li>
                            </a>
                        @endif
                    </ul>
                </div>
            @endif

        @endif



        @if($user_data->getAllPermissions()->pluck('name')->intersect(['staff view', 'manage everything'])->isNotEmpty())
        <div class="">
            <div onclick="document.getElementById('staffDiv').classList.toggle('hidden');document.getElementById('staffArrow').classList.toggle('-rotate-90')" class="{{Route::currentRouteName()==='service'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer  relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-users mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Staff / Employee</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-2000 " id="staffArrow"> </i>
            </div>
            <ul id="staffDiv" class="pl-10 mt-2 flex flex-col hidden">
            <a href="{{route('agency.staff')}}">
                    <li class="{{Route::currentRouteName()==='staff'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa fa-eye mr-2 text-sm"></i>
                            <span class="text-lg font-medium">View Staff</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>
                <li class="{{ Route::currentRouteName() === 'agency.staff.attandance' ? 'border-gray-100/60 bg-primary/90' : 'border-ternary' }} w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60 hover:bg-secondary/90 transition ease-in duration-2000">
                    <a href="{{ route('agency.staff.attandance') }}" class="w-full flex justify-between items-center">
                        <div class="flex items-center">
                            <i class="fa fa-hotel mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Staff Attendance Status</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </a>
                </li>

                <li class="{{ Route::currentRouteName() === 'agency.staff.wages' ? 'border-gray-100/60 bg-primary/90' : 'border-ternary' }} w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60 hover:bg-secondary/90 transition ease-in duration-2000">
                    <a href="{{ route('agency.staff.wages') }}" class="w-full flex justify-between items-center">
                        <div class="flex items-center">
                            <i class="fa fa-hotel mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Staff Wage Management</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </a>
                </li>

                <a href="{{ route('add.agency.leave', ['type' => 'agency']) }}">
                    <li class="{{Route::currentRouteName()==='add.agency.leave'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa fa-hotel mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Add Leave</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>

                <a href="{{ route('agency.pending.leave', ['type' => 'agency']) }}">
                    <li class="{{Route::currentRouteName()==='agency.pending.leave'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa-brands fa-cc-visa mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Leave Application </span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>


            </ul>
        </div>
        @endif

        @if($user_data->getAllPermissions()->pluck('name')->intersect(['team', 'manage everything'])->isNotEmpty())
                   <a href="">
                        <div class="{{Route::currentRouteName()==='teammanagment'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                            <div class="flex items-center">
                                <i class="fas fa-user mr-2 text-sm"></i>
                                <span class="text-lg font-medium">Team Managment</span>
                            </div>
                            <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                        </div>
                    </a>
         @endif

         <a href="">
            <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fas fa-tasks mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Assignment</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>

        @if($user_data->getAllPermissions()->pluck('name')->intersect(['expensive', 'manage everything'])->isNotEmpty())
        <a href="">
            <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-user-lock mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Expensive</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
        @endif

        @if($user_data->getAllPermissions()->pluck('name')->intersect(['leave', 'manage everything'])->isNotEmpty())
        <!-- <div class="">
            <div onclick="document.getElementById('leaveDiv').classList.toggle('hidden');document.getElementById('leaveArrow').classList.toggle('-rotate-90')" class="{{Route::currentRouteName()==='service'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] cursor-pointer  relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa-solid fa-umbrella-beach mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Leave Managment</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                <i class="fa fa-angle-down text-xl text-white/90 -rotate-90 transition ease-in duration-2000 " id="leaveArrow"> </i>
            </div>
            <ul id="leaveDiv" class="pl-10 mt-2 flex flex-col hidden">

                <a href="{{ route('add.agency.leave', ['type' => 'agency']) }}">
                    <li class="{{Route::currentRouteName()==='add.agency.leave'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa fa-hotel mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Add Leave</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>

                <a href="{{ route('agency.pending.leave', ['type' => 'agency']) }}">
                    <li class="{{Route::currentRouteName()==='agency.pending.leave'?'border-gray-100/60 bg-primary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                        <div class="flex items-center">
                            <i class="fa-brands fa-cc-visa mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Leave Application </span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </li>
                </a>
            </ul>
        </div> -->
        @endif
     
    @if($user_data->type == 'staff')
        <a href="{{route('agency.profile')}}">
            <div class="{{Route::currentRouteName()==='agency.profile'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-user-lock mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Profile</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
       @endif 

    

      

      {{-- {{dd($user_data->getAllPermissions()->pluck('name'))}} --}}
      @if($user_data->getAllPermissions()->pluck('name')->intersect(['role view', 'manage everything'])->isNotEmpty())

       <a href="{{route('agency.role')}}">
            <div class="{{Route::currentRouteName()==='superadmin.role'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-shield-halved mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Roles</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>

        @endif

        @if($user_data->getAllPermissions()->pluck('name')->intersect(['role view', 'manage everything'])->isNotEmpty())

        <a href="">
            <div class="{{Route::currentRouteName()==='superadmin.termtype'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fas fa-file-contract mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Terms and conditions</span>
                </div>

                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>

        @endif





        <a href="">
            <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-user-lock mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Admin Settings</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>

        @if($user_data->getAllPermissions()->pluck('name')->intersect(['support', 'manage everything'])->isNotEmpty())
        <a href="{{route('agency_support')}}">
            <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa-solid fa-headset mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Support</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
        @endif

        @if($user_data->getAllPermissions()->pluck('name')->intersect(['support', 'manage everything'])->isNotEmpty())
        <a href="{{route('agency_support')}}">
            <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa-solid fa-headset mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Report</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
        @endif



        @if($user_data->getAllPermissions()->pluck('name')->intersect(['support', 'manage everything'])->isNotEmpty())
        <a href="{{route('agency_support')}}">
            <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa-solid fa-headset mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Notification</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
        @endif



        @if($user_data->type=="staff")
        <a href="{{ route('agecy.leaves', ['type' => 'agency']) }} ">
            <div class="{{Route::currentRouteName()==='agecy.leaves'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-user-lock mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Leaves Application</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
        @endif

        <form action="{{route('agency_logout')}}" >
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
