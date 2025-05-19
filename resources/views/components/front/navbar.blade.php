{{--<div class="w-full px-4 py-2 flex xl:justify-between lg:justify-between md:justify-between sm:justify-between justify-between items-center bg-white sticky z-50 top-0 border-b-[2px] border-b-ternary/20">
    <div class="flex items-center">
        <div class="rounded-full h-10 w-10 xl:hidden lg:hidden flex justify-center items-center text-secondary" onclick="document.getElementById('sideBarDiv').classList.toggle('hidden');
                         document.getElementById('sideBarOverlay').classList.toggle('w-full');"><i class="fa fa-bars text-xl" title="Search......"></i></div>
        <span class="font-bold text-ternary text-xl xl:block lg:block md:block sm:block hidden">{{ auth()->user()->getRoleNames()->implode(', ') }}</span>

    </div>



    <div class="w-max flex items-center">


        <!-- <a href="{{route('attendance')}}"><button type="button" class="cursor-pointer w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-black border-[1px] border-b-[3px] border-r-[3px] border-ternary relative hover:border-gray-100/60 hover:bg-secondary/90 transition ease-in duration-200">
            <div class="flex items-center">
                <i class="fa fa-calendar-check mr-2 text-sm"></i>
                <span class="text-lg font-medium">Attendance</span>
            </div>
            <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
        </button> </a> -->



        @if($user->type!=="superadmin")
        @if($user && $user->status == 'offline')

        <!-- Show Attendance Button if User is Offline -->
        <a href="{{ route('attendance', ['type' => 'agency']) }}">
            <button type="button" class="cursor-pointer w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-black border-[1px] border-b-[3px] border-r-[3px] border-ternary relative hover:border-gray-100/60 hover:bg-secondary/90 transition ease-in duration-200">
                <div class="flex items-center">
                    <i class="fa fa-calendar-check mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Attendance</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </button>
        </a>
        @else

        <!-- Show Login Time if User is Logged In -->
        <div class="text-lg font-medium text-green-600">
            <i class="fa fa-clock mr-2"></i> Logged in {{ \Carbon\Carbon::createFromFormat('H:i:s',  $login_time)->format('h:i:s A') }}
        </div>
        @endif
        @endif


        <!-- <div class="rounded-full h-10 w-10 flex justify-center items-center hover:bg-ternary/60 hover:text-white cursor-pointer"><i class="fa fa-search" title="Search......"></i></div>
        <div class="rounded-full h-10 w-10 flex justify-center items-center hover:bg-ternary/60 hover:text-white cursor-pointer relative">
            <div class="absolute top-0 right-0 text-xs text-white bg-primary font-semibol h-4 w-4 rounded-full flex justify-center items-center">5</div>
            <i class="fa fa-bell" title="Search......"></i>
        </div> -->
        <div class="rounded-full h-10 w-10 flex justify-center items-center hover:bg-ternary/60 hover:text-white cursor-pointer"><i class="fa fa-gear animate-spin" title="Search......"></i></div>
        <div class="flex items-center gap-2 mx-4 cursor-pointer">
            <div class="">
                @if(isset($user->profile))
                <img src="{{ asset('images/user/profile/' . $user->profile) }}" alt="Cloud Travel" class="w-auto h-10 rounded-full" class="h-24 mr-4" />
                @else
                <img src="{{asset('assets/images/logo.png')}}" class="w-auto h-10 rounded-full" alt="">
                @endif
                <!-- <img src="{{asset('assets/images/profile_photo.jpg')}}" class="w-auto h-10 rounded-full" alt="Cloud Travels"> -->
            </div>
            <div class="flex flex-col items-start justify-center">
                <span class="text-ternary text-sm font-semibold">{{$user->name}}</span>
                <span class="text-ternary/90 text-xs font-semibol">{{ auth()->user()->getRoleNames()->implode(', ') }}</span>
            </div>

        </div>
    </div>
</div>--}}

<div class="w-full px-4 py-2 flex xl:justify-between lg:justify-between md:justify-between sm:justify-between justify-between items-center bg-white sticky z-50 top-0 border-b-[2px] border-b-ternary/20">
    <div class="flex items-center">
        <div class="rounded-full h-10 w-10 xl:hidden lg:hidden flex justify-center items-center text-secondary" onclick="document.getElementById('sideBarDiv').classList.toggle('hidden');
                         document.getElementById('sideBarOverlay').classList.toggle('w-full');"><i class="fa fa-bars text-xl" title="Search......"></i></div>
        <span class="font-bold text-ternary text-xl xl:block lg:block md:block sm:block hidden">{{ auth()->user()->getRoleNames()->implode(', ') }}</span>
    </div>

    <div class="w-max flex items-center">
        @if($user->type!=="superadmin")
            @if($user && $user->status == 'offline')
                <!-- Show Attendance Button if User is Offline -->
                <a href="{{ route('attendance', ['type' => 'agency']) }}">
                    <button type="button" class="cursor-pointer w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-black border-[1px] border-b-[3px] border-r-[3px] border-ternary relative hover:border-gray-100/60 hover:bg-secondary/90 transition ease-in duration-200">
                        <div class="flex items-center">
                            <i class="fa fa-calendar-check mr-2 text-sm"></i>
                            <span class="text-lg font-medium">Attendance</span>
                        </div>
                        <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                    </button>
                </a>
            @else
                <!-- Show Login Time if User is Logged In -->
                <div class="text-lg font-medium text-green-600">
                    <i class="fa fa-clock mr-2"></i> Logged in {{ \Carbon\Carbon::createFromFormat('H:i:s',  $login_time)->format('h:i:s A') }}
                </div>
            @endif
        @endif

        <!-- Notification Bell -->
        <div class="relative ml-4">
           <div class="rounded-full h-10 w-10 flex justify-center items-center hover:bg-ternary/60 hover:text-white cursor-pointer" onclick="toggleNotificationPanel()">
                <div id="notificationBadge" class="absolute top-0 right-0 text-xs text-white bg-primary font-semibold h-4 w-4 rounded-full flex justify-center items-center hidden"> </div>
                <div class="absolute top-0 right-0 text-xs text-white bg-primary font-semibol h-4 w-4 rounded-full flex justify-center items-center">{{ isset($pendingNotifications) ? $pendingNotifications->count() : 0 }}</div>
            
                <i class="fa fa-bell" title="Notifications"></i>
            </div>

            <!-- Notification Panel -->
            <div id="notificationPanel" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg border border-gray-200 z-50">
                <div class="p-2 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold text-gray-700">Notifications</h3>
                        <!-- <button class="text-xs text-secondary hover:text-primary">Mark all as read</button> -->
                    </div>
                </div>

                <!-- Notification Tabs -->
                <div class="flex border-b border-gray-200">
                    <button class="flex-1 py-2 text-sm font-medium text-center border-b-2 border-secondary text-secondary" onclick="showNotificationTab('visa')">Visa</button>
                    <button class="flex-1 py-2 text-sm font-medium text-center border-b-2 border-transparent hover:text-secondary" onclick="showNotificationTab('flight')">Flight</button>
                    <button class="flex-1 py-2 text-sm font-medium text-center border-b-2 border-transparent hover:text-secondary" onclick="showNotificationTab('hotel')">Hotel</button>
                </div>

                <!-- Notification Content -->
                <div class="max-h-80 overflow-y-auto">
                    <!-- Visa Notifications -->
                 
                    <div id="visaNotifications" class="notification-tab">
               
                            @forelse($pendingNotifications->where('service',3) as $notification)
                        
                            <div class="p-3 border-b border-gray-100 hover:bg-gray-50">
                                <div class="flex items-start justify-between">
                                    <!-- Left Side: Icon and Invoice -->
                                    <div class="flex items-start">
                                        <div class="bg-primary/10 p-2 rounded-full mr-3">
                                            <i class="fa fa-passport text-primary"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium">{{ $notification->invoice_number }}</p>
                                        </div>
                                    </div>

                                    <!-- Right Side: View Button/Text -->
                                  <a href="{{ route('notifications.view', ['id' => $notification->id]) }}">
                                        <div>
                                            <p class="text-xs text-blue-600 hover:underline cursor-pointer">View</p>
                                        </div>
                                  </a>     
                                </div>
                            </div>

                            @empty
                        <div class="p-3 border-b border-gray-100 hover:bg-gray-50">
                            <div class="flex items-start">
                                <div class="bg-green-100 p-2 rounded-full mr-3">
                                    <i class="fa fa-check text-green-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">No pending visa applications</p>
                                  
                                </div>
                            </div>
                        </div>
                    @endforelse
                    
                  
                    </div>

                    <!-- Flight Notifications -->
                    <div id="flightNotifications" class="notification-tab hidden">
                       
                        @forelse($pendingNotifications->where('service',2) as $notification)
                           <div class="p-3 border-b border-gray-100 hover:bg-gray-50">
                            <div class="flex items-start justify-between">
                                <!-- Left Side: Icon and Invoice -->
                                <div class="flex items-start">
                                    <div class="bg-primary/10 p-2 rounded-full mr-3">
                                       <i class="fa fa-plane text-blue-500"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">{{ $notification->invoice_number }}</p>
                                    </div>
                                </div>

                                <!-- Right Side: View Button/Text -->
                                  <a href="{{ route('notifications.view', ['id' => $notification->id]) }}">
                                        <div>
                                            <p class="text-xs text-blue-600 hover:underline cursor-pointer">View</p>
                                        </div>
                                  </a>  
                            </div>
                        </div>

                        @empty
                    <div class="p-3 border-b border-gray-100 hover:bg-gray-50">
                        <div class="flex items-start">
                            <div class="bg-green-100 p-2 rounded-full mr-3">
                                <i class="fa fa-check text-green-500"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium">No pending visa applications</p>
                              
                            </div>
                        </div>
                    </div>
                @endforelse
                
                       
                    </div>

                    <!-- Hotel Notifications -->
                    <div id="hotelNotifications" class="notification-tab hidden">
                        @forelse($pendingNotifications->where('service',1) as $notification)
                            <div class="p-3 border-b border-gray-100 hover:bg-gray-50">
                                <div class="flex items-start justify-between">
                                    <!-- Left Side: Icon and Invoice -->
                                    <div class="flex items-start">
                                        <div class="bg-primary/10 p-2 rounded-full mr-3">
                                        <i class="fa fa-hotel text-green-500"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium">{{ $notification->invoice_number }}</p>
                                        </div>
                                    </div>

                                    <!-- Right Side: View Button/Text -->
                                    <a href="{{ route('notifications.view', ['id' => $notification->id]) }}">
                                        <div>
                                            <p class="text-xs text-blue-600 hover:underline cursor-pointer">View</p>
                                        </div>
                                  </a>  
                                </div>
                            </div>
                        @empty
                            <div class="p-3 border-b border-gray-100 hover:bg-gray-50">
                                <div class="flex items-start">
                                    <div class="bg-green-100 p-2 rounded-full mr-3">
                                        <i class="fa fa-check text-green-500"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">No pending visa applications</p>
                                    
                                    </div>
                                </div>
                            </div>
                       @endforelse
                    </div>
                </div>

                <div class="p-2 border-t border-gray-200 text-center">
                    <a href="{{route('notification.index')}}" class="text-sm text-secondary hover:underline">View all notifications</a>
                </div>
            </div>
        </div>

        <!-- Settings Gear -->
        <div class="rounded-full h-10 w-10 flex justify-center items-center hover:bg-ternary/60 hover:text-white cursor-pointer ml-2">
            <i class="fa fa-gear animate-spin" title="Settings"></i>
        </div>

        <!-- User Profile -->
        <div class="flex items-center gap-2 mx-4 cursor-pointer">
            <div class="">
                @if(isset($user->profile))
                    <img src="{{ asset('images/user/profile/' . $user->profile) }}" alt="Cloud Travel" class="w-auto h-10 rounded-full" class="h-24 mr-4" />
                @else
                    <img src="{{asset('assets/images/logo.png')}}" class="w-auto h-10 rounded-full" alt="">
                @endif
            </div>
            <div class="flex flex-col items-start justify-center">
                <span class="text-ternary text-sm font-semibold">{{$user->name}}</span>
                <span class="text-ternary/90 text-xs font-semibol">{{ auth()->user()->getRoleNames()->implode(', ') }}</span>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle notification panel visibility
    function toggleNotificationPanel() {
        const panel = document.getElementById('notificationPanel');
        panel.classList.toggle('hidden');

        // Hide badge when panel is opened
        if (!panel.classList.contains('hidden')) {
            document.getElementById('notificationBadge').classList.add('hidden');
        }
    }

    // Show specific notification tab
    function showNotificationTab(tabName) {
        // Hide all tabs
        document.querySelectorAll('.notification-tab').forEach(tab => {
            tab.classList.add('hidden');
        });

        // Show selected tab
        document.getElementById(tabName + 'Notifications').classList.remove('hidden');

        // Update active tab styling
        const tabButtons = document.querySelectorAll('#notificationPanel > div:nth-child(2) button');
        tabButtons.forEach(button => {
            if (button.textContent.toLowerCase() === tabName) {
                button.classList.add('text-secondary', 'border-secondary');
                button.classList.remove('border-transparent');
            } else {
                button.classList.remove('text-secondary', 'border-secondary');
                button.classList.add('border-transparent');
            }
        });
    }

    // Close notification panel when clicking outside
    document.addEventListener('click', function(event) {
        const notificationPanel = document.getElementById('notificationPanel');
        const notificationBell = document.querySelector('.fa-bell').parentElement;

        if (!notificationPanel.contains(event.target) && !notificationBell.contains(event.target)) {
            notificationPanel.classList.add('hidden');
        }
    });
</script>

<style>
    /* Animation for notification badge */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    #notificationBadge {
        animation: pulse 1.5s infinite;
    }

    /* Smooth transitions for notification panel */
    #notificationPanel {
        transition: all 0.3s ease;
    }
</style>