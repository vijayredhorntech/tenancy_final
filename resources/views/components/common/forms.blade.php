<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{-- === Heading Section === --}}
<div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
    <span class="font-semibold text-ternary text-xl">Visa Forms</span>
</div>

{{-- === Visa Forms Section === --}}
<div class="w-full p-4 bg-gray-50 border-b-[2px] border-b-ternary/10">
    <div class="flex gap-4 overflow-x-auto">
        @foreach ($forms as $form)
            <div class="bg-blue-100 border-[1px] border-b-[2px] border-r-[2px] border-blue-300 p-3 rounded-[3px] rounded-tr-[8px] min-w-[200px] shadow-md">
                <h3 class="text-md font-semibold text-blue-900">{{ $form->from->form_name }}</h3>
                <a href="{{ route('view.form', ['viewid' => Str::slug($form->from->form_name), 'id' => $clientData->id]) }}" 
                    target="_blank" 
                    class="mt-2 inline-block bg-blue-500 text-white px-4 py-1 rounded-lg hover:bg-blue-700 transition">
                        View Form
                    </a>
            </div>
        @endforeach
    </div>
</div>
</div>