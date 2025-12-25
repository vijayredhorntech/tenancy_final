<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tenancy</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="font-family:'Public Sans', serif;">

<!-- ================= LOGIN FORM ================= -->
<div id="loginForm" class="w-full h-screen bg-center bg-cover relative"
     style="background-image:url({{ asset('assets/images/loginBanner.jpg') }})">

    <div class="absolute inset-0 flex justify-center items-center bg-ternary/50 p-2">

        <form method="POST" action="{{ route('agency_login') }}"
              class="max-w-[500px] w-full bg-ternary/80 px-6 py-16 flex flex-col
                     border-r-[5px] border-b-[5px] border-ternary/50
                     items-center shadow-lg rounded-[10px]">

            @csrf

            <div class="hidden xl:flex flex-col items-center py-6">
                <span class="text-gray-300 text-2xl font-semibold">
                    Welcome Back! Let's Get You Logged In
                </span>
                <p class="mt-2 text-sm text-gray-400 text-center max-w-md">
                    Please enter your registered email and password to continue.
                </p>
            </div>

            <div class="w-full mt-6 flex flex-col gap-4">

                <div>
                    <label class="text-gray-300 font-semibold">Email</label>
                    <div class="relative">
                        <i class="fa fa-user absolute left-8 top-1/2 -translate-y-1/2 text-gray-300"></i>
                        <input type="email" name="email" required
                               class="w-full px-4 pl-16 py-3 border-2 border-gray-400 bg-transparent text-gray-300 rounded-full">
                    </div>
                </div>

                <div>
                    <label class="text-gray-300 font-semibold">Password</label>
                    <div class="relative">
                        <i class="fa fa-lock absolute left-8 top-1/2 -translate-y-1/2 text-gray-300"></i>
                        <input type="password" name="password" required
                               class="w-full px-4 pl-16 py-3 border-2 border-gray-400 bg-transparent text-gray-300 rounded-full">
                    </div>
                </div>

                <input type="hidden" name="domain" value="{{ $agency->domains->domain_name }}">
                <input type="hidden" name="database" value="{{ $agency->database_name }}">
            </div>

            <div class="mt-10 w-full">
                <button class="w-full py-3 bg-secondary/40 border-2 border-secondary/50 text-gray-200 rounded-full">
                    Log in
                </button>

                <div class="text-center mt-4">
                    <a onclick="showForgot()" class="cursor-pointer text-gray-400 underline">
                        Forgot Password?
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- ================= FORGOT PASSWORD ================= -->
<div id="forgotForm" class="w-full h-screen bg-center bg-cover relative hidden"
     style="background-image:url({{ asset('assets/images/loginBanner.jpg') }})">

    <div class="absolute inset-0 flex justify-center items-center bg-ternary/50 p-2">

        <form id="forgotAjaxForm"
              class="max-w-[500px] w-full bg-ternary/80 px-6 py-16 flex flex-col
                     border-r-[5px] border-b-[5px] border-ternary/50
                     items-center shadow-lg rounded-[10px]">

            @csrf

            <div class="flex flex-col items-center mb-6">
                <span class="text-gray-300 text-2xl font-semibold">
                    Forgot Password
                </span>
                <p class="mt-2 text-sm text-gray-400 text-center max-w-md">
                    Enter your registered email address to receive a one-time password (OTP).
                </p>
            </div>

            <div class="w-full">
                <label class="text-gray-300 font-semibold">Email</label>
                <div class="relative">
                    <i class="fa fa-user absolute left-8 top-1/2 -translate-y-1/2 text-gray-300"></i>
                    <input type="email" name="email" required
                           class="w-full px-4 pl-16 py-3 border-2 border-gray-400 bg-transparent text-gray-300 rounded-full">
                </div>
            </div>

            <input type="hidden" name="domain" value="{{ $agency->domains->domain_name }}">
            <input type="hidden" name="database" value="{{ $agency->database_name }}">
            
     
            <button class="mt-8 w-full py-3 bg-secondary/40 border-2 border-secondary/50 text-gray-200 rounded-full">
                Send OTP
            </button>
               <a href="javascript:void(0)"
                onclick="backToLogin()"
                class="backlogin text-gray-400 underline cursor-pointer mt-4">
                Back to Login
                </a>
           
        </form>
    </div>
</div>

<!-- ================= VERIFY OTP ================= -->
<div id="otpForm" class="w-full h-screen bg-center bg-cover relative hidden"
     style="background-image:url({{ asset('assets/images/loginBanner.jpg') }})">

    <div class="absolute inset-0 flex justify-center items-center bg-ternary/50 p-2">

        <form id="verifyOtpForm"
              class="max-w-[500px] w-full bg-ternary/80 px-6 py-16 flex flex-col
                     border-r-[5px] border-b-[5px] border-ternary/50
                     items-center shadow-lg rounded-[10px]">

            @csrf

            <div class="flex flex-col items-center mb-6">
                <span class="text-gray-300 text-2xl font-semibold">
                    Verify OTP
                </span>
                <p class="mt-2 text-sm text-gray-400 text-center max-w-md">
                    Please enter the OTP sent to your registered email address.
                </p>
            </div>

            <div class="w-full">
                <label class="text-gray-300 font-semibold">OTP</label>
                <div class="relative">
                    <i class="fa fa-key absolute left-8 top-1/2 -translate-y-1/2 text-gray-300"></i>
                    <input type="text" name="otp" required
                           class="w-full px-4 pl-16 py-3 border-2 border-gray-400 bg-transparent text-gray-300 rounded-full">
                </div>
            </div>

             
            <button class="mt-8 w-full py-3 bg-secondary/40 border-2 border-secondary/50 text-gray-200 rounded-full">
                Verify OTP
            </button>

               <a href="javascript:void(0)"
                onclick="backToLogin()"
                class="backlogin text-gray-400 underline cursor-pointer mt-4">
                Back to Login
                </a>
        </form>
    </div>
</div>

<!-- ================= JS ================= -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ================= GET DOM ELEMENTS ================= */
    const loginForm      = document.getElementById('loginForm');
    const forgotForm     = document.getElementById('forgotForm');
    const otpForm        = document.getElementById('otpForm');

    const forgotAjaxForm = document.getElementById('forgotAjaxForm');
    const verifyOtpForm  = document.getElementById('verifyOtpForm');

      /* ================= BACK TO LOGIN ================= */
    window.backToLogin = function () {
        otpForm.classList.add('hidden');
        forgotForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
    };




    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content');

    /* ================= SHOW FORGOT ================= */
    window.showForgot = function () {
        loginForm.classList.add('hidden');
        forgotForm.classList.remove('hidden');
    };

    /* ================= SEND OTP ================= */
    forgotAjaxForm.addEventListener('submit', function (e) {
        e.preventDefault();

        fetch("{{ route('agency.forgot.send.otp') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf
            },
            body: new FormData(forgotAjaxForm)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                forgotForm.classList.add('hidden');
                otpForm.classList.remove('hidden');
            } else {
                alert(data.message);
            }
        })
        .catch(() => {
            alert('Server error while sending OTP');
        });
    });

    /* ================= VERIFY OTP ================= */
    verifyOtpForm.addEventListener('submit', function (e) {
        e.preventDefault();

        fetch("{{ route('agency.forgot.verify.otp') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf
            },
            body: new FormData(verifyOtpForm)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('OTP verified successfully. You can now reset your password.');
                // next step: show reset password form
                window.location.reload(); 
            } else {
                alert(data.message);
            }
        })
        .catch(() => {
            alert('Server error while verifying OTP');
        });
    });

});
</script>


</body>
</html>
