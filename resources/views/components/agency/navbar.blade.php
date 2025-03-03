<div class="w-full px-4 py-2 flex xl:justify-between lg:justify-between md:justify-between sm:justify-between justify-between items-center bg-white sticky top-0 border-b-[2px] border-b-ternary/20">
    <div class="flex items-center">
        <div class="rounded-full h-10 w-10 xl:hidden lg:hidden flex justify-center items-center text-secondary"    onclick="document.getElementById('sideBarDiv').classList.toggle('hidden');
                         document.getElementById('sideBarOverlay').classList.toggle('w-full');"><i class="fa fa-bars text-xl" title="Search......"></i></div>
        <span class="font-bold text-ternary text-xl xl:block lg:block md:block sm:block hidden">Agency Dashboard</span>

    </div>
    <div class="w-max flex items-center">
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
