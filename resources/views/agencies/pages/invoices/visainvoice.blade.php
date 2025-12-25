<x-agency.layout>
    @section('title') Visa Application Invoice @endsection


       <div class="mb-4 flex justify-between items-center">
    <h2 class="text-lg font-semibold text-gray-800">
        Visa Application Invoice
    </h2>

    <a href="{{ route('visa.applicationview', $clientData->id) }}"
       class="cursor-pointer flex items-center gap-2 py-1 px-4 rounded-[3px]
                        border border-ternary border-b-[3px] border-r-[3px]
                        hover:bg-secondary/90 transition  inline-flex items-center gap-2 px-4 py-2
              bg-gray-100 hover:bg-gray-200
              text-gray-700 font-semibold text-sm
              rounded-lg transition">
        <i class="fa fa-arrow-left"></i>
        Processed Application
    </a>
</div>


       <x-common.invoice.visa-invoice :booking="$clientData" :termconditon="$termconditon" :agency="$agency" />  





</x-agency.layout>











