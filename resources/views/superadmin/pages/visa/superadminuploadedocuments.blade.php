<x-front.layout>
@section('title') Visa Application @endsection

<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

    {{-- === this is code for heading section === --}}
    <div class="bg-primary/10 px-3 py-1.5 border-b-[2px] border-b-primary/20 flex justify-between">
        <span class="font-semibold text-ternary text-base">Add Document</span>
    </div>

    {{-- === form section code ends here === --}}
    {{-- === this is code for table section === --}}
    <form method="POST" action="{{ route('upload.document') }}">
        @csrf

        <div class="w-full overflow-x-auto p-2">
            <button id="addBtn" type="button" class="bg-blue-600 text-white px-2 py-1.5 rounded-sm shadow-sm hover:bg-blue-700 mb-4">Add</button>
            <input type="hidden" name="bookingid" value="{{ $booking->id }}">
       
      

            <div id="inputContainer" class="flex flex-wrap">
                <!-- Dynamic inputs will be added here -->
            </div>

            <button id="submitBtn" type="submit" class="mt-4 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 hidden">
                Submit
            </button>
        </div>
    </form>


   <!-- <script>
            const addBtn = document.getElementById('addBtn');
            const inputContainer = document.getElementById('inputContainer');
            const submitBtn = document.getElementById('submitBtn');

            function toggleSubmitButton() {
                const inputs = inputContainer.querySelectorAll('input[type="text"]');
                submitBtn.classList.toggle('hidden', inputs.length === 0);
            }

            addBtn.addEventListener('click', function () {
                const inputDiv = document.createElement('div');
                inputDiv.classList.add('w-full', 'md:w-1/2', 'lg:w-1/3', 'p-2');

                const innerBox = document.createElement('div');
                innerBox.classList.add('flex', 'flex-col', 'bg-white', 'rounded-lg', 'shadow-md', 'p-4', 'border', 'border-gray-200');

                const boxTitle = document.createElement('h3');
                boxTitle.textContent = '📝 Document';
                boxTitle.classList.add('text-lg', 'font-bold', 'text-blue-600', 'mb-3');

                const label = document.createElement('label');
                label.textContent = 'Document Name:';
                label.classList.add('text-base', 'font-semibold', 'text-gray-800', 'mb-2');

                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'documents[]';
                input.classList.add('border', 'p-2', 'rounded-md', 'mb-3', 'w-full', 'border-gray-300', 'focus:ring-2', 'focus:ring-blue-400');
                input.placeholder = 'Enter document name';

                const removeBtn = document.createElement('button');
                removeBtn.textContent = 'Remove';
                removeBtn.classList.add('bg-red-500', 'text-white', 'py-2', 'rounded-md', 'hover:bg-red-600', 'transition-all', 'text-sm');

                removeBtn.addEventListener('click', function () {
                    inputDiv.remove();
                    toggleSubmitButton(); // 👈 Check if submit should hide again
                });

                innerBox.appendChild(boxTitle);
                innerBox.appendChild(label);
                innerBox.appendChild(input);
                innerBox.appendChild(removeBtn);
                inputDiv.appendChild(innerBox);
                inputContainer.appendChild(inputDiv);

                toggleSubmitButton(); // 👈 Show submit if this is first input
    });
</script> -->

<script>
    const addBtn = document.getElementById('addBtn');
    const inputContainer = document.getElementById('inputContainer');
    const submitBtn = document.getElementById('submitBtn');

    function toggleSubmitButton() {
        const inputs = inputContainer.querySelectorAll('input[type="text"]');
        submitBtn.classList.toggle('hidden', inputs.length === 0);
    }

    addBtn.addEventListener('click', function () {
        const inputDiv = document.createElement('div');
        inputDiv.classList.add('w-full', 'md:w-1/2', 'lg:w-1/3', 'p-2');

        const innerBox = document.createElement('div');
        innerBox.classList.add('flex', 'flex-col', 'bg-white', 'rounded-lg', 'shadow-md', 'p-4', 'border', 'border-gray-200');

        const boxTitle = document.createElement('h3');
        boxTitle.textContent = '📝 Document';
        boxTitle.classList.add('text-lg', 'font-bold', 'text-blue-600', 'mb-3');

        // Label + Text input for document name
        const nameLabel = document.createElement('label');
        nameLabel.textContent = 'Document Name:';
        nameLabel.classList.add('text-base', 'font-semibold', 'text-gray-800', 'mb-1');

        const nameInput = document.createElement('input');
        nameInput.type = 'text';
        nameInput.name = 'documents[]';
        nameInput.classList.add('border', 'p-2', 'rounded-md', 'mb-3', 'w-full', 'border-gray-300', 'focus:ring-2', 'focus:ring-blue-400');
        nameInput.placeholder = 'Enter document name';

        // Label + File input for document upload
        const fileLabel = document.createElement('label');
        fileLabel.textContent = 'Upload Document:';
        fileLabel.classList.add('text-base', 'font-semibold', 'text-gray-800', 'mb-1');

        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = 'files[]';
        fileInput.classList.add('mb-3');

        const removeBtn = document.createElement('button');
        removeBtn.textContent = 'Remove';
        removeBtn.type = 'button';
        removeBtn.classList.add('bg-red-500', 'text-white', 'py-2', 'rounded-md', 'hover:bg-red-600', 'transition-all', 'text-sm');

        removeBtn.addEventListener('click', function () {
            inputDiv.remove();
            toggleSubmitButton();
        });

        innerBox.appendChild(boxTitle);
        innerBox.appendChild(nameLabel);
        innerBox.appendChild(nameInput);
        innerBox.appendChild(fileLabel);
        innerBox.appendChild(fileInput);
        innerBox.appendChild(removeBtn);
        inputDiv.appendChild(innerBox);
        inputContainer.appendChild(inputDiv);

        toggleSubmitButton();
    });
</script>


</x-front.layout>
