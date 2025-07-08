   <!-- In your Blade template head section -->
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Before closing body tag -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@props([
    'id',
    'name',
    'options' => [],
    'selected' => null,
    'placeholder' => '---Select Option---'
])

<select
    name="{{ $name }}"
    id="{{ $id }}"
    class="visa-select w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"
>
    <option></option> {{-- Required for placeholder --}}
    @foreach($options as $value => $label)
        <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>

@push('scripts')
<script>
    $(document).ready(function () {
        $('#{{ $id }}').select2({
            placeholder: "{{ $placeholder }}",
            allowClear: true
        });
    });
</script>
@endpush
