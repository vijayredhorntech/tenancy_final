{{-- ================== AGENCY HEADER ================== --}}
<div class="w-full z-40 px-4 py-2 flex justify-between items-center bg-white sticky top-0 border-b-[2px] border-b-ternary/20">

    {{-- LEFT --}}
    <div class="flex items-center">
        <div class="rounded-full h-10 w-10 xl:hidden lg:hidden flex justify-center items-center text-secondary cursor-pointer"
            onclick="document.getElementById('sideBarDiv')?.classList.toggle('hidden');
                     document.getElementById('sideBarOverlay')?.classList.toggle('w-full');">
            <i class="fa fa-bars text-xl"></i>
        </div>

        <span class="font-bold text-ternary text-xl hidden xl:block">
            Agency Dashboard
        </span>
    </div>

    {{-- RIGHT --}}
    <div class="w-max flex items-center gap-3">

        {{-- REQUEST FUND / ATTENDANCE / LOGIN TIME --}}
        @if ($user_data->type !== "staff")
            <a href="{{ route('agency.addfund') }}" class="mr-2">
                <button class="cursor-pointer flex items-center gap-2 py-1 px-4 rounded-[3px]
                        border border-ternary border-b-[3px] border-r-[3px]
                        hover:bg-secondary/90 transition">
                    <i class="fa fa-money-bill text-sm"></i>
                    <span class="text-lg font-medium">Request Fund</span>
                </button>
            </a>
        @else
            <a href="{{ route('agency.attendance') }}">
                <button class="cursor-pointer flex items-center gap-2 py-1 px-4 rounded-[3px]
                        border border-ternary border-b-[3px] border-r-[3px]
                        hover:bg-secondary/90 transition">
                    <i class="fa fa-calendar-check text-sm"></i>
                    <span class="text-lg font-medium">Attendance</span>
                </button>
            </a>
        @endif

        {{-- LOGIN TIME SAFE --}}
        @if(!empty($login_time))
            <div class="text-green-600 font-medium">
                <i class="fa fa-clock mr-1"></i>
                Logged in {{ \Carbon\Carbon::parse($login_time)->format('h:i:s A') }}
            </div>
        @endif

        {{-- SEARCH --}}
        <div class="rounded-full h-10 w-10 flex justify-center items-center hover:bg-ternary/60 hover:text-white cursor-pointer">
            <i class="fa fa-search"></i>
        </div>

        {{-- NOTIFICATION --}}
        <div class="relative">
            <div class="rounded-full h-10 w-10 flex justify-center items-center hover:bg-ternary/60 hover:text-white cursor-pointer"
                 onclick="toggleNotificationPanel()">

                <span class="absolute top-0 right-0 text-xs bg-danger text-white h-4 w-4 rounded-full flex items-center justify-center">
                    0
                     </span>

                <i class="fa fa-bell"></i>
            </div>

            {{-- NOTIFICATION PANEL --}}
            <div id="notificationPanel"
                 class="hidden absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-md shadow-lg z-50">

                <div class="p-2 border-b font-semibold">Notifications</div>

                {{-- TABS --}}
                <div class="flex border-b text-sm">
                    <button class="flex-1 py-2 border-b-2 border-secondary text-secondary"
                            onclick="showNotificationTab('visa')">Visa</button>
                    <button class="flex-1 py-2 hover:text-secondary"
                            onclick="showNotificationTab('flight')">Flight</button>
                    <button class="flex-1 py-2 hover:text-secondary"
                            onclick="showNotificationTab('hotel')">Hotel</button>
                </div>

                {{-- CONTENT --}}
                <div class="max-h-80 overflow-y-auto">

                    {{-- VISA --}}
                    <div id="visaNotifications" class="notification-tab">
                      </div>

                    {{-- FLIGHT --}}
                    <div id="flightNotifications" class="notification-tab hidden">
                     </div>

                    {{-- HOTEL --}}
                    <div id="hotelNotifications" class="notification-tab hidden">
                     </div>
                </div>

                <div class="p-2 text-center border-t">
                    <a href="{{ route('notification.index') }}"
                       class="text-secondary text-sm hover:underline">
                        View all notifications
                    </a>
                </div>
            </div>
        </div>

        {{-- SETTINGS --}}
        <div class="rounded-full h-10 w-10 flex justify-center items-center hover:bg-ternary/60 hover:text-white cursor-pointer">
            <i class="fa fa-gear animate-spin"></i>
        </div>

        {{-- PROFILE --}}
        <div class="flex items-center gap-2 mx-2 cursor-pointer">
            <img src="{{ asset(
                $user_data->profile
                    ? ($user_data->type == 'staff'
                        ? 'images/user/agency/profile/'.$user_data->profile
                        : 'images/agencies/logo/'.$user_data->profile)
                    : 'assets/images/logo.png'
            ) }}"
            onerror="this.src='{{ asset('assets/images/logo.png') }}'"
            class="h-10 w-10 rounded-full">

            <div>
                <span class="text-ternary text-sm font-semibold">
                    {{ ucwords($user_data->name ?? 'Login') }}
                </span>
                <span class="block text-ternary/80 text-xs">
                    {{ $user_data->type == 'staff' ? 'Staff' : 'Agency' }}
                </span>
            </div>
        </div>
    </div>
</div>

{{-- ================== SCRIPT ================== --}}
<script>
function toggleNotificationPanel() {
    document.getElementById('notificationPanel').classList.toggle('hidden');
}

function showNotificationTab(tab) {
    document.querySelectorAll('.notification-tab').forEach(el => el.classList.add('hidden'));
    document.getElementById(tab + 'Notifications').classList.remove('hidden');
}

document.addEventListener('click', function (e) {
    const panel = document.getElementById('notificationPanel');
    if (!e.target.closest('.fa-bell') && panel && !panel.contains(e.target)) {
        panel.classList.add('hidden');
    }
});
</script>
