<x-main.layout>
    <x-visa.visaresult :visas="$visas" :countries="$countries" :orgin="$orgin" :destination="$destination" />
    
    <!-- Show form only when user wants to apply -->
    <div id="visaFormSection" class="hidden">
        <x-visa.visaclientform :visas="$visas" />
    </div>
</x-main.layout>