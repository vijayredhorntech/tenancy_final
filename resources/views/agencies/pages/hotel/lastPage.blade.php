

<x-agency.layout>

<div class="flex justify-center items-center h-screen">
    <div class="w-[50%] mx-auto p-2">
        <img src="{{ asset('assets/images/error.png') }}" alt="Your Image" class="w-60 mx-auto mb-4">
        <div class="text-center">
            <h1 class="text-xl md:text-2xl lg:text-4xl font-semibold">Ugh-ohh, there was a problem while booking<br>your hotel</h1>
            <p class="text-xsm md:text-sm lg:text-xl mt-2 text-gray-700">We are sorry, but you could try next time.</p>
{{--            <p class="text-xsm md:text-sm lg:text-xl text-gray-700">To see if it helps, if the issue persists, please reach out to your admin.</p>--}}
            <a href="https://www.cloudtravels.co.uk/cloudHotel/public" type="button" class="mt-5 focus:outline-none text-white bg-sky-500 hover:bg-sky-600  focus:ring-sky-300 font-medium rounded text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Return to home </a>
        </div>
    </div>
</div>

</x-agency.layout>
