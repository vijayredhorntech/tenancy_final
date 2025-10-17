<x-agency.layout>
@section('title') Send Document Message @endsection

<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
    <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between items-center">
        <span class="font-semibold text-ternary text-xl">Send Message to Client</span>
        <a href="{{ route('client.documents.movement') }}" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Back to Movement</a>
    </div>

    <div class="w-full p-6">
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-yellow-400"></i>
                </div>
                <div class="ml-3">
                    <div class="text-sm text-yellow-700">
                        <strong>Selected Clients for Document Notification:</strong><br>
                        @foreach($selected as $sel)
                            <span class="inline-block bg-yellow-100 px-2 py-1 rounded text-xs mr-2 mt-1">
                                {{ $sel->booking->clint->client_name ?? 'Unknown' }}
                                ({{ $sel->booking->clint->phone_number ?? 'N/A' }})
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('client.documents.send.notification') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-ternary mb-2">Message Type</label>
                    <select name="message_type" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" required>
                        <option value="">Select Message Type</option>
                        <option value="document_request">Document Request</option>
                        <option value="document_received">Document Received Confirmation</option>
                        <option value="reminder">Reminder</option>
                        <option value="custom">Custom Message</option>
                    </select>
                </div>

                <div class="hidden" id="predefinedMessages">
                    <label class="block text-sm font-semibold text-ternary mb-2">Quick Templates</label>
                    <select id="quickTemplate" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Select a template</option>
                        <option value="document_request" data-message="Dear Client, Please submit the required documents for your visa application. Required: Passport, Photos, Birth Certificate">Document Request</option>
                        <option value="document_received" data-message="Dear Client, We have received your documents. We will process them and get back to you shortly.">Document Received</option>
                        <option value="reminder" data-message="Dear Client, This is a reminder to submit your pending documents ASAP to avoid delays in your application.">Reminder</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-ternary mb-2">Message Subject</label>
                    <input type="text" name="subject" value="Document Notification - {{ $agency->agency_name }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-ternary mb-2">Message</label>
                    <textarea name="message" rows="8" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Enter your message here..." required></textarea>
                    <small class="text-gray-500 mt-1 block">This message will be sent to all selected clients.</small>
                </div>

                <div class="flex gap-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="include_document_details" value="1" class="rounded" checked>
                        <span class="ml-2 text-sm text-ternary">Include recent document details in email</span>
                    </label>
                </div>

                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold text-ternary mb-4">Email Preview</h3>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <div id="previewContent">
                            <p>Preview will appear here when you select a message type...</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <button type="button" onclick="window.history.back()" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-6 py-2 bg-primary text-white rounded-md hover:bg-primary/90">Send Notifications</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messageTypeSelect = document.querySelector('select[name="message_type"]');
    const templateSelect = document.getElementById('quickTemplate');
    const predefinedMessages = document.getElementById('predefinedMessages');
    const messageTextarea = document.querySelector('textarea[name="message"]');

    messageTypeSelect.addEventListener('change', function() {
        const selectedValue = this.value;
        if (selectedValue && selectedValue !== 'custom') {
            predefinedMessages.classList.remove('hidden');
            updatePreview(selectedValue);
        } else {
            predefinedMessages.classList.add('hidden');
            updatePreview('custom');
        }
    });

    templateSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value && selectedOption.dataset.message) {
            messageTextarea.value = selectedOption.dataset.message;
            updatePreview('custom');
        }
    });

    messageTextarea.addEventListener('input', function() {
        updatePreview('custom');
    });

    function updatePreview(type) {
        const previewDiv = document.getElementById('previewContent');
        const message = messageTextarea.value || 'Your message will appear here...';

        // Simple preview (in real implementation, this could be more sophisticated)
        previewDiv.innerHTML = `
            <div class="space-y-2">
                <p><strong>Subject:</strong> ${document.querySelector('input[name="subject"]').value}</p>
                <div class="border-l-4 border-primary pl-4">
                    <pre class="whitespace-pre-wrap text-sm">${message}</pre>
                </div>
            </div>
        `;
    }
});
</script>

</x-agency.layout>
