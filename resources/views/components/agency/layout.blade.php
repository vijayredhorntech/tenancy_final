<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
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

    <x-agency.sidebar/>
    <div class=" h-[100vh] w-full overflow-y-auto">
        <x-agency.navbar/>
        <div class="p-4 w-full ">
            {{$slot}}
        </div>
    </div>
</div>
@yield('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editors = document.querySelectorAll('.quill-editor');
        editors.forEach(function(editorElement) {
            const quill = new Quill(editorElement, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'header': 1 }, { 'header': 2 }],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'script': 'sub' }, { 'script': 'super' }],
                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                        [{ 'direction': 'rtl' }],
                        [{ 'size': ['small', false, 'large', 'huge'] }],
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'font': [] }],
                        [{ 'align': [] }],
                        ['clean'],
                        ['link', 'image', 'video']
                    ]
                },
                placeholder: 'Compose your content...'
            });

            // Apply custom height using CSS
            editorElement.style.height = "200px";
            editorElement.style.overflow = "auto";
            editorElement.style.border="1px solid #ff421666"
        });
    });
</script>
<script>
        let counter = 1; // Initial counter for unique field names

        document.getElementById('addDocumentBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default behavior

            let container = document.getElementById('documentContainer');

            if (counter < 10) { // Limit to 10 sets
                counter++; // Increment counter

                // Create a new wrapper div
                let docWrapper = document.createElement('div');
                docWrapper.className = "p-4 border border-gray-300 rounded-lg flex flex-col gap-2";

                // Document Name Field
                let documentField = `
                    <div class="w-full flex flex-col gap-1">
                        <label for="document${counter}" class="font-semibold text-gray-700 text-sm">Document Name</label>
                        <div class="w-full relative">
                            <input type="text" name="document${counter}" id="document${counter}" placeholder="Document name..."
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                            <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-gray-500"></i>
                        </div>
                    </div>`;

                // File Upload Field
                let fileField = `
                    <div class="w-full flex flex-col gap-1">
                        <label for="file${counter}" class="font-semibold text-gray-700 text-sm">Attachment</label>
                        <div class="w-full relative">
                            <input type="file" name="file${counter}" id="file${counter}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                            <i class="fa fa-database absolute right-3 top-[50%] translate-y-[-50%] text-sm text-gray-500"></i>
                        </div>
                    </div>`;

                // Remove Button
                let removeBtn = `
                    <button type="button" class="mt-2 px-4 py-1 bg-red-500 text-black rounded remove-btn">Remove</button>
                `;

                // Append fields and button to the wrapper
                docWrapper.innerHTML = documentField + fileField + removeBtn;

                // Append the wrapper to the container
                container.appendChild(docWrapper);

                // Add event listener to remove the section
                docWrapper.querySelector(".remove-btn").addEventListener('click', function() {
                    docWrapper.remove();
                });

            } else {
                alert("You can only add up to 10 documents.");
            }
        });
    </script>


</body>
</html>
