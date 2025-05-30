<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/css/swiffy-slider.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
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
    @yield('styles')

   
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


 
     <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/js/swiffy-slider.min.js" crossorigin="anonymous" defer></script>
    <style>

        * {
            margin: 0px;
            padding: 0px;
        }


        .dropdown-option {
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 2.5rem;
            padding-right: 2.5rem;
            border-top: 1px solid #f3f4f6;
            border-bottom: 1px solid #f3f4f6;
        }

        .dropdown-option:hover {
            background-color: rgba(255, 66, 22, 0.13);
            border-bottom:1px solid #ff4216;
            border-top:1px solid #ff4216;
            cursor: pointer;
            transition: all 0.6s;
        }

         input[type="date"]::-webkit-inner-spin-button,
         input[type="date"]::-webkit-calendar-picker-indicator {
             display: none !important;
             -webkit-appearance: none !important;
         }
        select {
            -webkit-appearance: none !important; /* Hides the arrow in WebKit-based browsers (Chrome, Safari, Edge) */
            -moz-appearance: none !important;    /* Hides the arrow in Firefox */
            appearance: none !important;         /* Standard property */
            background: #f3f4f6 !important ;         /* Removes background if needed */
        }
    </style>

</head>
<body class="bg-gray-100 relative"
      style="font-family: 'Public Sans', serif; height: 100vh; width: 100%; overflow:hidden">





{{--===Side bar overlay===--}}
<div id="sideBarOverlay" class="xl:w-0 lg:w-0  h-full bg-black/40 absolute top-0 left-0"
     onclick="document.getElementById('sideBarDiv').classList.toggle('hidden');document.getElementById('sideBarOverlay').classList.toggle('w-full');"></div>
{{--===Side bar overlay ends===--}}

<div class="flex w-full ">

    <x-client.sidebar/>
    <div class=" h-[100vh] w-full overflow-y-auto">
        <x-client.navbar/>
        <div class="p-4 w-full ">
            {{$slot}}
        </div>
    </div>
</div>
@yield('scripts')

<script>
    // Initialize Quill Editor
    document.addEventListener("DOMContentLoaded", function () {
    var editorElement = document.getElementById("editor");

    // Check if editor exists before initializing Quill
    if (editorElement) {
        var quill = new Quill("#editor", {
            theme: "snow",
            placeholder: "Type your description here...",
            modules: {
                toolbar: [
                    ["bold", "italic", "underline"], // Bold, italic, underline
                    [{ list: "ordered" }, { list: "bullet" }], // Lists
                    [{ align: [] }], // Text alignment
                    ["link"], // Insert links
                ],
            },
        });

        // Function to sync Quill content with hidden input field
        function syncContent() {
            var descriptionInput = document.getElementById("description");
            if (descriptionInput) {
                descriptionInput.value = quill.root.innerHTML;
            }
        }

        // Use MutationObserver Instead of Deprecated Events
        const config = { childList: true, subtree: true };
        const observer = new MutationObserver(syncContent);
        observer.observe(editorElement, config);

        // Ensure content syncs when Quill content changes
        quill.on("text-change", syncContent);
    }
});

</script>


</body>
</html>
