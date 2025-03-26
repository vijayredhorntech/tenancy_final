<x-front.layout>
    @section('title')Clint @endsection
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-4 text-center">Visa Application Details</h2>

    <table class="w-full border-collapse border border-gray-300">
        <tbody>
            <tr>
                <td class="border p-2 font-semibold bg-gray-100">Application ID:</td>
                <td class="border p-2">VISA-20250325153609145-XMPV</td>
            </tr>
            <tr>
                <td class="border p-2 font-semibold bg-gray-100">Full Name:</td>
                <td class="border p-2">Shivani Rajput</td>
            </tr>
            <tr>
                <td class="border p-2 font-semibold bg-gray-100">Email:</td>
                <td class="border p-2">shivanirajput6402@gmail.com</td>
            </tr>
            <tr>
                <td class="border p-2 font-semibold bg-gray-100">Phone Number:</td>
                <td class="border p-2">8580984998</td>
            </tr>
            <tr>
                <td class="border p-2 font-semibold bg-gray-100">Visa Type:</td>
                <td class="border p-2">Tourist Visa B2 (DS-160 Form)</td>
            </tr>
            <tr>
                <td class="border p-2 font-semibold bg-gray-100">Description:</td>
                <td class="border p-2">Aute sint aut quae v</td>
            </tr>
            <tr>
                <td class="border p-2 font-semibold bg-gray-100">Origin:</td>
                <td class="border p-2">India</td>
            </tr>
            <tr>
                <td class="border p-2 font-semibold bg-gray-100">Destination:</td>
                <td class="border p-2">Ukraine</td>
            </tr>
            <tr>
                <td class="border p-2 font-semibold bg-gray-100">Fee (USD):</td>
                <td class="border p-2">$848.00</td>
            </tr>
            <tr>
                <td class="border p-2 font-semibold bg-gray-100">Application Date:</td>
                <td class="border p-2">25 Mar 2025</td>
            </tr>
        </tbody>
    </table>

    <div class="text-center mt-6">
        <a href="{{ url('/visa') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700">
            Back to List
        </a>
    </div>
</div>
</x-front.layout>
