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
document.addEventListener("DOMContentLoaded", function () {
    const mainCategories = document.querySelectorAll('.main-category');

    mainCategories.forEach(mainCheckbox => {
        const category = mainCheckbox.dataset.category;
        const subCheckboxes = document.querySelectorAll(`.subfield[data-category="${category}"] input[type="checkbox"]`);

        // When any subfield is toggled
        subCheckboxes.forEach(sub => {
            sub.addEventListener('change', function () {
                const anyChecked = Array.from(subCheckboxes).some(cb => cb.checked);
                mainCheckbox.checked = anyChecked;
            });
        });

        // When main checkbox is toggled
        mainCheckbox.addEventListener('change', function () {
            subCheckboxes.forEach(cb => {
                cb.checked = mainCheckbox.checked;
            });
        });
    });
});
</script>

</x-front.layout>
