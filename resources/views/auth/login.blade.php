<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tenancy</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    {{--    ===google fonts link--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    {{--    ===google fonts link ends--}}

    {{--    ===font awesome link===--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    {{--    ===font awesome link ends===--}}
    <style>
        ::-webkit-scrollbar {
            width: 2px;
            height: 2px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #ff4216;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }


        input[type="date"]::-webkit-datetime-edit {
            color: #172432b3; /* Change placeholder text color */
        }
        input[type="date"]::-webkit-calendar-picker-indicator {
            opacity: 0;
        }


        select {
            -webkit-appearance: none !important; /* Hides the arrow in WebKit-based browsers (Chrome, Safari, Edge) */
            -moz-appearance: none !important;    /* Hides the arrow in Firefox */
            appearance: none !important;         /* Standard property */
            background: white !important ;
            color: rgba(75, 85, 99, 0.7);/* Removes background if needed */
        }
        select option {
            color: rgba(75, 85, 99, 0.7); /* Match placeholder text */
            background-color: #ffffff; /* Ensure options have a white background */
        }

    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="" style="font-family: 'Public Sans', serif;">

<div class="w-full h-screen bg-center bg-cover bg-no-repeat relative" style="background-image: url({{asset('assets/images/loginBanner.jpg')}})">
    <div class="w-full absolute top-0 left-0 w-full h-full flex justify-center items-center bg-ternary/50 p-2">
        <form method="POST" action="{{ route('login') }}" class="max-w-[500px] w-full bg-ternary/80  px-6 py-16 flex flex-col border-r-[5px] border-b-[5px] border-ternary/50 items-center xl:rounded-tl-[50px] ld:rounded-tl-[50px] md:rounded-tl-[50px] rounded-tl-[10px] xl:rounded-br-[50px] lg:rounded-br-[50px] md:rounded-br-[50px] rounded-br-[10px] rounded-tr-[10px] rounded-bl-[10px] flex flex-col items-center  shadow-lg shadow-gray-500">

            <img src="{{asset('assets/images/logo.png')}}" alt="" class="h-[100px] w-auto">
            <div class="w-full xl:flex lg:flex md:flex hidden flex-col items-center py-6">
                <span class="text-gray-300 text-2xl font-semibold">Welcome Back! Let's Get You Logged In</span>
                <p class="text-center mt-2 text-sm text-gray-400">"Enter your credentials to access your account and explore all the exciting features. If you don’t have an account yet, sign up and join our community today!"</p>
            </div>

            @csrf
            <div class="w-full mt-6 flex flex-col items-center gap-4">
                <div class=" w-full flex flex-col gap-1 ">
                    <label for="email" class="font-semibold text-md text-gray-300">Email</label>
                    <div class="relative w-full">
                        <i class="fa fa-user absolute text-gray-300 left-8 top-[50%] translate-y-[-50%]"></i>
                        <input  class="w-full px-4 pl-16 py-3 border-[2px] border-gray-400 bg-transparent text-gray-300 placeholder-gray-400 rounded-full focus:outline-none focus:ring-0 focus:border-gray-300" id="email"  type="email" name="email" :value="old('email')"   placeholder="Enter your email....."/>
                    </div>
                    @error('email') <span class="text-danger font-semibold text-sm mt-1"><i class="fa fa-triangle-exclamation mr-2"></i> {{ $message }}</span> @enderror
                </div>
                <div class=" w-full flex flex-col gap-1 mt-4">
                    <label for="password" class="font-semibold text-md text-gray-300">Password</label>
                    <div class="relative w-full">
                        <i class="fa fa-lock absolute text-gray-300 left-8 top-[50%] translate-y-[-50%]"></i>
                        <input id="password" class="w-full px-4 pl-16 py-3 border-[2px] border-gray-400 bg-transparent text-gray-300 placeholder-gray-400 rounded-full focus:outline-none focus:ring-0 focus:border-gray-300" type="password" name="password"  autocomplete="current-password" placeholder="Enter your password....." />
                    </div>
                    @error('password') <span class="text-danger font-semibold text-sm mt-1"><i class="fa fa-triangle-exclamation mr-2"></i> {{ $message }}</span> @enderror

                </div>
            </div>
            <div class="mt-12 w-full">
                <button class="w-full px-2 xl:py-4 lg:py-4 md:py-4 py-2 border-[2px] border-secondary/50 bg-secondary/40 text-gray-200 font-semibold rounded-full text-lg hover:bg-secondary/80 hover:text-white hover:border-secondary transition ease-in duration-2000" type="submit">
                    {{ __('Log in') }}
                </button>

                @if (Route::has('password.request'))
                    <div class="mr-1 flex justify-center mt-4">
                        <a class="text-md text-gray-400 underline font-semibold hover:text-secondary/80 transition ease-in duration-2000 group" href="{{ route('password.request') }}">
                            <i class="fa fa-lock mr-2 group-hover:hidden"></i> <i class="fa fa-unlock-keyhole mr-2 hidden group-hover:inline-block"></i> {{ __('Forgot Password?') }}
                        </a>
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
</body>
</html>



