<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

    {{-- === Heading Section === --}}
    <div class="bg-primary/10 px-3 py-1.5 border-b-[2px] border-b-primary/20 flex justify-between">
        <span class="font-semibold text-ternary text-base">Important Document</span>
    </div>

    {{-- === Validation Errors === --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-2 mb-3 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $existingDocs = json_decode($visaServiceType->required_document ?? '[]', true);
    @endphp

    {{-- === Form Start === --}}
    <form method="POST" action="{{ route('requestdocuments.store') }}">
        @csrf

        <input type="hidden" name="combinationId" value="{{ $visaServiceType->id }}">

        <div class="w-full overflow-x-auto p-2">
            <button id="addBtn" type="button" class="bg-blue-600 text-white px-2 py-1.5 rounded-sm shadow-sm hover:bg-blue-700 mb-4">
                Add
            </button>

            <div id="inputContainer" class="flex flex-wrap">
                {{-- Existing documents (if any) --}}
                @forelse($existingDocs as $doc)
                    <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                        <div class="flex flex-col bg-white rounded-lg shadow-md p-4 border border-gray-200">
                            <h3 class="text-lg font-bold text-blue-600 mb-3">📝 Request Document</h3>
                            <label class="text-base font-semibold text-gray-800 mb-2">Document Name:</label>
                            <input type="text" name="documents[]" value="{{ $doc }}" class="border p-2 rounded-md mb-3 w-full border-gray-300 focus:ring-2 focus:ring-blue-400" placeholder="Enter document name">
                            <button type="button" class="remove-btn bg-red-500 text-white py-2 rounded-md hover:bg-red-600 transition-all text-sm">
                                Remove
                            </button>
                        </div>
                    </div>
                @empty
                    {{-- No documents: JS will auto-add one --}}
                @endforelse
            </div>

            <button id="submitBtn" type="submit" class="mt-4 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 hidden">
                Submit
            </button>
        </div>
    </form>

    {{-- === JavaScript for Add/Remove === --}}
    <script>
        const addBtn = document.getElementById('addBtn');
        const inputContainer = document.getElementById('inputContainer');
        const submitBtn = document.getElementById('submitBtn');

        function toggleSubmitButton() {
            const inputs = inputContainer.querySelectorAll('input[type="text"]');
            submitBtn.classList.toggle('hidden', inputs.length === 0);
        }

        function bindRemoveButtons() {
            inputContainer.querySelectorAll('.remove-btn').forEach(button => {
                button.onclick = function () {
                    this.closest('.w-full').remove();
                    toggleSubmitButton();
                };
            });
        }

        addBtn.addEventListener('click', function () {
            const inputDiv = document.createElement('div');
            inputDiv.classList.add('w-full', 'md:w-1/2', 'lg:w-1/3', 'p-2');

            const innerBox = document.createElement('div');
            innerBox.classList.add('flex', 'flex-col', 'bg-white', 'rounded-lg', 'shadow-md', 'p-4', 'border', 'border-gray-200');

            const boxTitle = document.createElement('h3');
            boxTitle.textContent = '📝 Request Document';
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
            removeBtn.type = 'button';
            removeBtn.textContent = 'Remove';
            removeBtn.classList.add('remove-btn', 'bg-red-500', 'text-white', 'py-2', 'rounded-md', 'hover:bg-red-600', 'transition-all', 'text-sm');

            innerBox.appendChild(boxTitle);
            innerBox.appendChild(label);
            innerBox.appendChild(input);
            innerBox.appendChild(removeBtn);
            inputDiv.appendChild(innerBox);
            inputContainer.appendChild(inputDiv);

            bindRemoveButtons();
            toggleSubmitButton();
        });

        // Initial setup
        toggleSubmitButton();
        bindRemoveButtons();

        @if(empty($existingDocs))
            addBtn.click(); // auto-add one input if empty
        @endif
    </script>
</div>
