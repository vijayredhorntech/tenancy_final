<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

    {{-- === this is code for heading section === --}}
    <div class="bg-primary/10 px-3 py-1.5 border-b-[2px] border-b-primary/20 flex justify-between">
        <span class="font-semibold text-ternary text-base">Add Document</span>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


  <div class="w-full overflow-x-auto p-4">
        <div class="grid grid-cols-3 gap-4">
        @php
                        $documents = $booking->downloadDocument && $booking->downloadDocument->documents
                            ? json_decode($booking->downloadDocument->documents, true)
                            : [];

                    @endphp
                    {{--   @foreach($documents as $doc)         
                            <div class="flex flex-col gap-2">
                                <label for="documentfile }}" class="text-sm font-semibold text-ternary">
                                    {{ $doc['name'] }}
                                </label>
                                <a href="{{ route('clientupload.documentdownloadjson', ['file' => urlencode($doc['file'])]) }}"
                                    class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">
                                        Download
                                    </a>
                            </div>
                        @endforeach --}}

            @foreach($documents as $doc)     
               
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:shadow-sm transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center">
                            <i class="fa fa-file mr-2"></i>
                            <p class="font-medium text-ternary">{{ $doc['name'] }}</p>
                         
                        </div>
                     

        

                     <div>
                     <a href="{{ route('clientupload.documentdelete', ['id' => $doc['name'] ,'bookingid'=>$booking->downloadDocument->booking_id]) }}"
                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-red-500 hover:'bg-red-500 focus:outline-none transition-colors">
                           <i class="fa fa-xmark mr-2"></i>
                            Delete
                        </a>

                        <a href="{{ route('clientupload.documentdownloadjson', ['file' => urlencode($doc['file'])]) }}"
                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary/90 focus:outline-none transition-colors">
                            <i class="fa fa-download mr-2"></i>
                            Download
                        </a>
                     </div>

                    </div>
                </div>
            @endforeach
        </div>
 </div>

    <form action="{{ route('upload.document') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="w-full overflow-x-auto p-2">
            <button id="addmore" type="button" class="bg-blue-600 text-white px-2 py-1.5 rounded-sm shadow-sm hover:bg-blue-700 mb-4">Add</button>
            <input type="hidden" name="bookingid" value="{{ $booking->id }}">
       
      

            <div id="uploadContainer" class="flex flex-wrap">
                <!-- Dynamic inputs will be added here -->
            </div>

            <button id="submitUploadBtn" type="submit" class="mt-4 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 hidden">
                Submit
            </button>
        </div>
    </form>

   

<!-- <script>
    const addBtnnew = document.getElementById('addBtn');
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
    // Trigger add button after DOM is ready
    document.addEventListener('DOMContentLoaded', () => {
        addBtnnew.click();
    });
</script> -->
<script>
    const btnAddDocument = document.getElementById('addmore');
    const documentInputWrapper = document.getElementById('uploadContainer');
    const btnSubmitDocuments = document.getElementById('submitUploadBtn');

    function checkIfSubmitShouldShow() {
        const nameInputs = documentInputWrapper.querySelectorAll('input[type="text"]');
        btnSubmitDocuments.classList.toggle('hidden', nameInputs.length === 0);
    }

    btnAddDocument.addEventListener('click', function () {
        const outerDiv = document.createElement('div');
        outerDiv.classList.add('w-full', 'md:w-1/2', 'lg:w-1/3', 'p-2');

        const box = document.createElement('div');
        box.classList.add('flex', 'flex-col', 'bg-white', 'rounded-lg', 'shadow-md', 'p-4', 'border', 'border-gray-200');

        const title = document.createElement('h3');
        title.textContent = '📝 Document';
        title.classList.add('text-lg', 'font-bold', 'text-blue-600', 'mb-3');

        const labelDocName = document.createElement('label');
        labelDocName.textContent = 'Document Name:';
        labelDocName.classList.add('text-base', 'font-semibold', 'text-gray-800', 'mb-1');

        const inputDocName = document.createElement('input');
        inputDocName.type = 'text';
        inputDocName.name = 'documents[]';
        inputDocName.classList.add('border', 'p-2', 'rounded-md', 'mb-3', 'w-full', 'border-gray-300', 'focus:ring-2', 'focus:ring-blue-400');
        inputDocName.placeholder = 'Enter document name';

        const labelFileUpload = document.createElement('label');
        labelFileUpload.textContent = 'Upload Document:';
        labelFileUpload.classList.add('text-base', 'font-semibold', 'text-gray-800', 'mb-1');

        const inputFile = document.createElement('input');
        inputFile.type = 'file';
        inputFile.name = 'files[]';
        inputFile.classList.add('mb-3');

        const btnRemove = document.createElement('button');
        btnRemove.textContent = 'Remove';
        btnRemove.type = 'button';
        btnRemove.classList.add('bg-red-500', 'text-white', 'py-2', 'rounded-md', 'hover:bg-red-600', 'transition-all', 'text-sm');

        btnRemove.addEventListener('click', function () {
            // if (confirm('Are you sure you want to remove this document request?')) {
            //                 inputDiv.remove();
            //                 toggleSubmitButton(); // 👈 Check if submit should hide again
            //             }
            outerDiv.remove();
            checkIfSubmitShouldShow();
        });

        box.appendChild(title);
        box.appendChild(labelDocName);
        box.appendChild(inputDocName);
        box.appendChild(labelFileUpload);
        box.appendChild(inputFile);
        box.appendChild(btnRemove);
        outerDiv.appendChild(box);
        documentInputWrapper.appendChild(outerDiv);

        checkIfSubmitShouldShow();
    });

    

    // Automatically trigger one document box when page loads
    document.addEventListener('DOMContentLoaded', () => {
        btnAddDocument.click();
    });
</script>

</div>