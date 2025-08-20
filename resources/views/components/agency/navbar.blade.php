    <div class="w-full z-40 px-4 py-2 flex xl:justify-between lg:justify-between md:justify-between sm:justify-between justify-between items-center bg-white sticky top-0 border-b-[2px] border-b-ternary/20">
    <div class="flex items-center">
        <div class="rounded-full h-10 w-10 xl:hidden lg:hidden flex justify-center items-center text-secondary"    onclick="document.getElementById('sideBarDiv').classList.toggle('hidden');
                         document.getElementById('sideBarOverlay').classList.toggle('w-full');"><i class="fa fa-bars text-xl" title="Search......"></i></div>
        <span class="font-bold text-ternary text-xl xl:block lg:block md:block sm:block hidden">Agency Dashboard</span>

    </div>
    <div class="w-max flex items-center">

    @if ($user_data->type !== "staff")
            <a href="{{ route('agency.addfund') }}" class="mr-2">
                <button type="button" class="cursor-pointer w-full flex justify-between items-center py-0.5 px-4 rounded-[3px] text-black border-[1px] border-b-[3px] border-r-[3px] border-ternary relative hover:border-gray-100/60 hover:bg-secondary/90 transition ease-in duration-200">
                    <div class="flex items-center">
                        <i class="fa fa-money-bill mr-2 text-sm"></i>
                        <span class="text-lg font-medium">Request Fund</span>

                        
                    </div>
                    <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                </button>
            </a>
             <!-- Notification  -->
                <!-- Success Alert -->
                @if (session('success'))
                    <div id="success-alert" class="alert flex items-center justify-between p-4 mb-4 text-sm font-medium text-white border-2 border-success/30 rounded-lg bg-success shadow-md transition-all duration-300" role="alert">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-4l-3-3 1.414-1.414L9 11.172l4.586-4.586L15 8l-6 6z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button onclick="dismissAlert('success-alert')" class="alert ml-4 text-white hover:text-gray-200 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    
                @endif

                <!-- Error Alert -->
                @if (session('error'))
                    <div id="error-alert" class="alert flex items-center justify-between p-4 mb-4 text-sm font-medium text-white border-2 border-danger/30 rounded-lg bg-danger shadow-md transition-all duration-300" role="alert">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9 8a1 1 0 112 0v4a1 1 0 11-2 0V8zm1 6a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button onclick="dismissAlert('error-alert')" class=" alert ml-4 text-white hover:text-gray-200 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                @endif

        @else
        @if($user_data->type=="staff")
            <a href="{{ route('agency.attendance') }}"> {{-- Replace with your actual route --}}
                <button type="button" class="cursor-pointer w-full flex justify-between items-center py-0.5 px-4 rounded-[3px] text-black border-[1px] border-b-[3px] border-r-[3px] border-ternary relative hover:border-gray-100/60 hover:bg-secondary/90 transition ease-in duration-200">
                    <div class="flex items-center">
                        <i class="fa fa-calendar-check mr-2 text-sm"></i>
                        <span class="text-lg font-medium">Attendance</span>
                    </div>
                    <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
                </button>
            </a>
      @else
        <div class="text-lg font-medium text-green-600">
           <i class="fa fa-clock mr-2"></i> Logged in {{ \Carbon\Carbon::createFromFormat('H:i:s',  $login_time)->format('h:i:s A') }}
         </div>
      @endif
          
        @endif

        <div class="rounded-full h-10 w-10 flex justify-center items-center hover:bg-ternary/60 hover:text-white cursor-pointer"><i class="fa fa-search" title="Search......"></i></div>
        <div class="rounded-full h-10 w-10 flex justify-center items-center hover:bg-ternary/60 hover:text-white cursor-pointer relative">
            <div class="absolute top-0 right-0 text-xs text-white bg-primary font-semibol h-4 w-4 rounded-full flex justify-center items-center">5</div>
            <i class="fa fa-bell" title="Search......"></i>
        </div>
        <div class="rounded-full h-10 w-10 flex justify-center items-center hover:bg-ternary/60 hover:text-white cursor-pointer"><i class="fa fa-gear animate-spin" title="Search......"></i></div>
        <div class="flex items-center gap-2 mx-4 cursor-pointer">
            <div class="">
               {{-- <img src="{{asset($user_data->profile ? 'images/agencies/logo/' . $user_data->profile : 'assets/images/profile_photo.jpg') }}" class="w-auto h-10 rounded-full" alt="Cloud Travels"> --}}
               <img src="{{ asset($user_data->type == 'staff' ? 'images/user/agency/profile/' . $user_data->profile : 'images/agencies/logo/' . $user_data->profile) }}"
     onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.png') }}';"
     class="w-auto h-10 rounded-full"
     alt="Cloud Travel">
            </div>
            <div class="flex flex-col items-start justify-center">
                <span class="text-ternary text-sm font-semibold">{{ ucwords($user_data->name ? $user_data->name : 'Login') }}</span>
                <span class="text-ternary/90 text-xs font-semibol">{{ $user_data->type == 'staff' ? 'Staff' : 'Agency' }}
                </span>
            </div>

        </div>
    </div>
</div>
<script>
      // Auto-hide all alerts with class 'alert' after 5 seconds
                                                                    setTimeout(() => {
                                        const alerts = [...document.getElementsByClassName('alert')];
                                        alerts.forEach(hideAlert); // Cleaner iteration
                                    }, 5000);

                                function hideAlert(element) {
                                    if (!element) return;

                                    // Add Tailwind classes to fade out and collapse
                                    element.classList.add('opacity-0', 'h-0', 'overflow-hidden', 'mb-0', 'transition-all', 'duration-300');

                                    // Remove the element after transition (300ms)
                                    setTimeout(() => {
                                        element.style.display = 'none';
                                    }, 300);
                                }

                                function dismissAlert(alertId) {
                                    const alert = document.getElementById(alertId);
                                    if (alert) {
                                        hideAlert(alert);
                                    }
                                }
</script>