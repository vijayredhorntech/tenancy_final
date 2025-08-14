<div id="sideBarDiv" class="z-20 w-72 p-4 h-[100vh] bg-ternary overflow-x-hidden overflow-y-auto flex-none xl:static lg:static absolute top-0 left-0 xl:block lg:block hidden ">

<div class="w-full flex flex-col justify-center items-center border-b-[1px] pb-2 border-b-gray-100/20 shadow-lg shadow-gray-700/10">
      
    {{-- <img src="{{asset($user_data->profile ? 'images/agencies/logo/' . $user_data->profile : 'assets/images/logo.png') }}" class="h-20 w-20 object-cover rounded-full" alt="Cloud Travel"> --}} 
              @if($user_data->gender === 'MALE')
                    <img src="{{ asset('assets/images/man.png') }}" 
                        onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.png') }}';"
                        class="h-20 w-20 object-cover rounded-full" 
                        alt="Cloud Travel">
                @elseif($user_data->gender === 'FEMALE')
                    <img src="{{ asset('assets/images/female.png') }}" 
                        onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.png') }}';"
                        class="h-20 w-20 object-cover rounded-full" 
                        alt="Cloud Travel">
                @else
                    {{-- Default image (man.png) if gender is null or not set --}}
                    <img src="{{ asset('assets/images/man.png') }}" 
                        onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.png') }}';"
                        class="h-20 w-20 object-cover rounded-full" 
                        alt="Cloud Travel">
                @endif

        <span class="font-semibold text-white/90 mt-2 text-2xl">{{ ucwords($user_data->client_name ? $user_data->client_name : 'Login') }}</span>
        <p class="text-secondary/90 text-xs" ><i class="fa-regular fa-calendar-days mr-1"></i> <span id="clockDiv"></span> </p>
    </div>


    <div class="w-full flex flex-col mt-12 gap-3 ">
  


      

    <a href="{{route('client.profile')}}">
            <div class="{{Route::currentRouteName()==='agency.profile'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa fa-user-lock mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Profile</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
     
        
    <a href="{{route('client.application')}}">
            <div class="{{Route::currentRouteName()==='client.application'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fas fa-clipboard mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Application </span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>

        <a href="{{route('client.document.download')}}">
            <div class="{{Route::currentRouteName()==='client.document.download'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fas fa-download mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Download Center </span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>

  


        <a href="#">
            <div class="{{Route::currentRouteName()===''?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fas fa-file-invoice mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Invoice</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>

   
   

        <a href="{{route('client.notification')}}">
            <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fas fa-bell mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Notification</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>

      
        <a href="{{route('client.support')}}">
            <div class="{{Route::currentRouteName()==='admin_setting'?'border-gray-100/60 bg-secondary/90':'border-ternary'}}  w-full flex justify-between items-center py-2 px-4 rounded-[3px] text-white/90 border-[1px] border-b-[3px] border-r-[3px] relative hover:border-gray-100/60  hover:bg-secondary/90 transition ease-in duration-2000">
                <div class="flex items-center">
                    <i class="fa-solid fa-headset mr-2 text-sm"></i>
                    <span class="text-lg font-medium">Support</span>
                </div>
                <i class="fa fa-caret-left text-2xl text-ternary absolute -right-1.5 top-[50%] translate-y-[-50%]"></i>
            </div>
        </a>
  



        <form action="{{route('client.logout')}}" >
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
