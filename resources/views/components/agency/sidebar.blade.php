<div id="sideBarDiv" class="z-20 w-72 p-4 h-[100vh] bg-ternary overflow-x-hidden overflow-y-auto flex-none xl:static lg:static absolute top-0 left-0 xl:block lg:block hidden ">
    <div class="w-full flex flex-col justify-center items-center border-b-[1px] pb-2 border-b-gray-100/20 shadow-lg shadow-gray-700/10">
        <img src="{{asset($user_data->profile ? 'images/agencies/logo/' . $user_data->profile : 'assets/images/logo.png') }}" class="h-20 w-20 object-cover rounded-full" alt="Cloud Travel">
        <span class="font-semibold text-white/90 mt-2 text-2xl">{{ ucwords($user_data->name ? $user_data->name : 'Login') }}</span>
        <p class="text-secondary/90 text-xs" ><i class="fa-regular fa-calendar-days mr-1"></i> <span id="clockDiv"></span> </p>
    </div>

    <div class="w-full flex flex-col mt-12 gap-3 ">
        <a href="{{route('agency_dashboard')}}">
            <div class="{{Route::currentRouteName()==='dashboard'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-tv mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Dashboard</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
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

        <a href="">
            <div class="{{Route::currentRouteName()==='clint'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-users mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Clint</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>


        <a href="">
            <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-user-lock mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Admin Settings</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>

        <a href="{{route('agency_support')}}">
            <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa-solid fa-headset mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Support</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>


        <a href="">
            <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-user-lock mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Expensive</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>


        <a href="">
            <div class="{{Route::currentRouteName()==='logout'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-right-from-bracket mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Logout</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
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
