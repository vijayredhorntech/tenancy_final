<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Client Login</title>

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
<div id="loginForm"


     class="w-full h-screen bg-center bg-cover relative"
     style="background-image:url({{ asset('assets/images/loginBanner.jpg') }})">
 
    <div class="absolute inset-0 flex justify-center items-center bg-ternary/50 p-2">

        <form method="POST" action="{{ route('clientloginstore') }}"
              class="max-w-[500px] w-full bg-ternary/80 px-6 py-16 flex flex-col
                     border-r-[5px] border-b-[5px] border-ternary/50
                     items-center shadow-lg rounded-[10px]">

            @csrf

            <div class="hidden xl:flex flex-col items-center py-6">
                <span class="text-gray-300 text-2xl font-semibold">
                    Welcome Back! Let's Get You Logged In
                </span>
                <p class="mt-2 text-sm text-gray-400 text-center">
                    Please enter your registered email and password to continue.
                </p>
            </div>

            <div class="w-full mt-6 flex flex-col gap-4">

                <!-- EMAIL -->
                <div>
                    <label class="text-gray-300 font-semibold">Email</label>
                    <div class="relative">
                        <i class="fa fa-user absolute left-8 top-1/2 -translate-y-1/2 text-gray-300"></i>
                        <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                class="w-full px-4 pl-16 py-3 border-2 border-gray-400
                                    bg-transparent text-gray-300 rounded-full
                                    placeholder-gray-400 focus:outline-none focus:ring-0
                                    focus:border-gray-300"
                                placeholder="Enter your email"
                            />
                            @error('email')
                            <p class="text-red-400 text-sm mt-1 flex items-center gap-2">
                                <i class="fa fa-triangle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror

                    </div>
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="text-gray-300 font-semibold">Password</label>
                    <div class="relative">
                        <i class="fa fa-lock absolute left-8 top-1/2 -translate-y-1/2 text-gray-300"></i>
                        <input type="password" name="password" required
                               class="w-full px-4 pl-16 py-3 border-2 border-gray-400
                                      bg-transparent text-gray-300 rounded-full"
                               placeholder="Enter your password">
                    </div>
                </div>
            </div>

            <div class="mt-10 w-full">
                <button class="w-full py-3 bg-secondary/40 border-2 border-secondary/50
                               text-gray-200 rounded-full font-semibold">
                    Log in
                </button>

                <div class="text-center mt-4">
                    <a onclick="showForgot()"
                       class="cursor-pointer text-gray-400 underline">
                        Forgot Password?
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- ================= FORGOT PASSWORD ================= -->
<div id="forgotForm"
     class="hidden w-full h-screen bg-center bg-cover relative"
     style="background-image:url({{ asset('assets/images/loginBanner.jpg') }})">

    <div class="absolute inset-0 flex justify-center items-center bg-ternary/50 p-2">

        <form id="forgotAjaxForm"
              class="max-w-[500px] w-full bg-ternary/80 px-6 py-16 flex flex-col
                     border-r-[5px] border-b-[5px] border-ternary/50
                     items-center shadow-lg rounded-[10px]">

            @csrf

            <span class="text-gray-300 text-2xl font-semibold mb-2">
                Forgot Password
            </span>
            <p class="text-sm text-gray-400 text-center mb-6">
                Enter your registered email to receive an OTP.
            </p>

            <div class="w-full">
                <label class="text-gray-300 font-semibold">Email</label>
                <div class="relative">
                    <i class="fa fa-user absolute left-8 top-1/2 -translate-y-1/2 text-gray-300"></i>
                    <input type="email" name="email" required
                           class="w-full px-4 pl-16 py-3 border-2 border-gray-400
                                  bg-transparent text-gray-300 rounded-full"
                           placeholder="Enter your email">
                </div>
            </div>

            <button class="mt-8 w-full py-3 bg-secondary/40 border-2 border-secondary/50
                           text-gray-200 rounded-full">
                Send OTP
            </button>

            <div class="mt-4">
                <a onclick="backToLogin()" class="text-gray-400 underline cursor-pointer">
                    Back to Login
                </a>
            </div>
        </form>
    </div>
</div>

<!-- ================= VERIFY OTP ================= -->
<div id="otpForm"
     class="hidden w-full h-screen bg-center bg-cover relative"
     style="background-image:url({{ asset('assets/images/loginBanner.jpg') }})">

    <div class="absolute inset-0 flex justify-center items-center bg-ternary/50 p-2">

        <form id="verifyOtpForm"
              class="max-w-[500px] w-full bg-ternary/80 px-6 py-16 flex flex-col
                     border-r-[5px] border-b-[5px] border-ternary/50
                     items-center shadow-lg rounded-[10px]">

            @csrf

            <span class="text-gray-300 text-2xl font-semibold mb-2">
                Verify OTP
            </span>
            <p class="text-sm text-gray-400 text-center mb-6">
                Enter the OTP sent to your email.
            </p>

            <div class="w-full">
                <label class="text-gray-300 font-semibold">OTP</label>
                <div class="relative">
                    <i class="fa fa-key absolute left-8 top-1/2 -translate-y-1/2 text-gray-300"></i>
                    <input type="text" name="otp" required
                           class="w-full px-4 pl-16 py-3 border-2 border-gray-400
                                  bg-transparent text-gray-300 rounded-full"
                           placeholder="Enter OTP">
                </div>
            </div>

            <button class="mt-8 w-full py-3 bg-secondary/40 border-2 border-secondary/50
                           text-gray-200 rounded-full">
                Verify OTP
            </button>

            <div class="mt-4">
                <a onclick="backToLogin()" class="text-gray-400 underline cursor-pointer">
                    Back to Login
                </a>
            </div>
        </form>
    </div>
</div>

<!-- ================= JS ================= -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const loginForm  = document.getElementById('loginForm');
    const forgotForm = document.getElementById('forgotForm');
    const otpForm    = document.getElementById('otpForm');

    const forgotAjaxForm = document.getElementById('forgotAjaxForm');
    const verifyOtpForm  = document.getElementById('verifyOtpForm');

    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    window.showForgot = function () {
        loginForm.classList.add('hidden');
        forgotForm.classList.remove('hidden');
    };

    window.backToLogin = function () {
        otpForm.classList.add('hidden');
        forgotForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
    };

    /* SEND OTP */
    forgotAjaxForm.addEventListener('submit', function (e) {
        e.preventDefault();

        fetch("{{ route('client.forgot.send.otp') }}", {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf },
            body: new FormData(forgotAjaxForm)
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                forgotForm.classList.add('hidden');
                otpForm.classList.remove('hidden');
            } else {
                alert(d.message);
            }
        });
    });

    /* VERIFY OTP */
    verifyOtpForm.addEventListener('submit', function (e) {
        e.preventDefault();

        fetch("{{ route('client.forgot.verify.otp') }}", {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf },
            body: new FormData(verifyOtpForm)
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                window.location.href = d.redirect;
            } else {
                alert(d.message);
            }
        });
    });

});
</script>

</body>
</html>
