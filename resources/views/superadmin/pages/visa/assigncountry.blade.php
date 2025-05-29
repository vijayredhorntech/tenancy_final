<x-front.layout>
    @section('title')Assign Visa Fields @endsection

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex flex-col gap-2 shadow-lg shadow-gray-300">
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20">
            <div class="text-sm text-gray-700">
                <strong>Assign Country Field</strong><br>
                Visa Name: {{$visadetails->VisaServices->name}} <br>
                Country: {{$visadetails->destinationcountry->countryName}} 
            </div>
        </div>

        <div class="w-full overflow-x-auto p-4">
            <form action="{{ route('superadmin.assignclientfieldcountry') }}" method="POST">
                @csrf
                <input type="hidden" name="assigncoutnry" value="{{$visadetails->id}}">

                <div class="rounded bg-white px-8 py-12 shadow-lg border-2 border-gray-400/50">
                    @php 
                        $alreadySelect = $assign && $assign->name_of_field ? json_decode($assign->name_of_field, true) : [];
                  
                    @endphp

                    <div class="flex flex-col gap-6">
                        @foreach ($groupedFields as $group)
                   
                            <div class="flex flex-col gap-3 p-4 bg-gray-50 rounded-lg">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        class="hidden peer main-category"
                                        data-category="{{ $group['slug'] }}"
                                        name="section_name[]"
                                        value="{{ $group['slug'] }}"
                                        @if(count(array_intersect($group['filed'], $alreadySelect)) === count($group['filed'])) checked @endif>
                                    <div class="w-5 h-5 border-2 border-gray-400 rounded flex items-center justify-center peer-checked:bg-secondary/60 peer-checked:border-secondary/90 transition">
                                        <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-gray-700 peer-checked:text-secondary">
                                        {{ $group['name'] }}
                                    </span>
                                </label>

                                <div class="flex flex-wrap gap-4 pl-6">
                                    @foreach ($group['filed'] as $field)
                                        <label class="flex items-center gap-2 cursor-pointer subfield" data-category="{{ $group['slug'] }}">
                                            <input 
                                                type="checkbox" 
                                                value="{{ $field }}" 
                                                name="visa_fields[]" 
                                                class="hidden peer"
                                                {{ in_array($field, $alreadySelect) ? 'checked' : '' }}>
                                            <div class="w-5 h-5 border-2 border-gray-400 rounded-full flex items-center justify-center peer-checked:bg-secondary/60 peer-checked:border-secondary/90 transition">
                                                <svg class="w-2.5 h-2.5 text-white hidden peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <span class="text-gray-600 peer-checked:text-secondary">
                                                {{ $field }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="submit" class="px-4 py-2 bg-success/30 text-ternary font-semibold rounded border-2 border-success/90 hover:bg-success hover:text-white transition">
                            Assign Country
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    $(document).ready(function () {
    function updateMainCheckboxState(category) {
        var mainCheckbox = $(`.main-category[data-category="${category}"]`);
        var subCheckboxes = $(`.subfield[data-category="${category}"] input`);
        var allChecked = subCheckboxes.length && subCheckboxes.filter(':checked').length === subCheckboxes.length;
        var anyChecked = subCheckboxes.filter(':checked').length > 0;

        mainCheckbox.prop('checked', allChecked);
        mainCheckbox.prop('indeterminate', anyChecked && !allChecked);

        mainCheckbox.prop('disabled', !anyChecked);

        if(mainCheckbox.prop('disabled')) {
            mainCheckbox.closest('label').addClass('opacity-50 cursor-not-allowed');
        } else {
            mainCheckbox.closest('label').removeClass('opacity-50 cursor-not-allowed');
        }
    }

    // Initialize main checkboxes state on page load
    $('.main-category').each(function () {
        var category = $(this).data('category');
        updateMainCheckboxState(category);
    });

    // When main checkbox changes, toggle all subfields
    $('.main-category').on('change', function () {
        var category = $(this).data('category');
        var isChecked = $(this).prop('checked');
        $(`.subfield[data-category="${category}"] input`).prop('checked', isChecked).trigger('change');
    });

    // When subfield checkbox changes, update main checkbox accordingly
    $('.subfield input').on('change', function () {
        var category = $(this).closest('.subfield').data('category');
        updateMainCheckboxState(category);
    });
});

    </script>
</x-front.layout>
