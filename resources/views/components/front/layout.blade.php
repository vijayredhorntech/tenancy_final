<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    
    <!-- Include Quill CSS and JS (Latest Version) -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.min.js"></script>


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

    <!-- swiffy sldier link and script -->
    <script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/js/swiffy-slider.min.js" crossorigin="anonymous" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/css/swiffy-slider.min.css" rel="stylesheet" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>


</head>
<body class="bg-gray-100 relative"
      style="font-family: 'Public Sans', serif; height: 100vh; width: 100%; overflow:hidden">
{{--===Side bar overlay===--}}
<div id="sideBarOverlay" class="xl:w-0 lg:w-0  h-full bg-black/40 absolute top-0 left-0"
     onclick="document.getElementById('sideBarDiv').classList.toggle('hidden');document.getElementById('sideBarOverlay').classList.toggle('w-full');"></div>
{{--===Side bar overlay ends===--}}

<div class="flex w-full ">
    <x-front.sidebar/>
    <div class=" h-[100vh] w-full overflow-y-auto">
        <x-front.navbar/>
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

<script>
        let documentcounter = 1; // Initial documentcounter for unique field names

        document.getElementById('addDocumentBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default behavior

            let container = document.getElementById('documentContainer');

            if (documentcounter < 10) { // Limit to 10 sets
                documentcounter++; // Increment documentcounter

                // Create a new wrapper div
                let docWrapper = document.createElement('div');
                docWrapper.className = "w-full grid xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4 mt-2";

                // Document Name Field
                let documentField = `
                    <div class="w-full flex flex-col gap-1">
                        <label for="document${documentcounter}" class="font-semibold text-gray-700 text-sm">Document Name</label>
                        <div class="w-full relative">
                            <input type="text" name="document${documentcounter}" id="document${documentcounter}" placeholder="Document name..."
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                            <i class="fa fa-link absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                    </div>`;

                // File Upload Field
                let fileField = `
                    <div class="w-full flex flex-col gap-1">
                        <label for="file${documentcounter}" class="font-semibold text-gray-700 text-sm">Attachment</label>
                        <div class="w-full relative">
                            <input type="file" name="file${documentcounter}" id="file${documentcounter}"
                                class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                            <i class="fa fa-database absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                        </div>
                    </div>`;

                // Remove Button
                let removeBtn = `
                  <div class="w-max flex flex-col gap-1 remove-btn">
                        <label for="file${documentcounter}" class="font-semibold text-gray-700 text-sm">&nbsp</label>
                        <div class="w-full relative">
                          <button type="button" class="w-max h-max text-sm bg-danger/30 px-4 py-1 mt-2 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-danger/90 text-ternary hover:text-white hover:bg-danger hover:border-ternary/30 transition ease-in duration-2000">Remove</button>
                        </div>
                    </div>
                `;

                // Append fields and button to the wrapper
                docWrapper.innerHTML = documentField + fileField + removeBtn;

                // Append the wrapper to the container
                container.appendChild(docWrapper);

                // Add event listener to remove the section
                docWrapper.querySelector(".remove-btn").addEventListener('click', function() {
                  if (documentcounter > 1) documentcounter--;
                    docWrapper.remove();
                });

            } else {
                alert("You can only add up to 10 documents.");
            }
        });



           </script>

</body>
</html>
