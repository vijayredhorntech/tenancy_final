<x-agency.layout>
    @section('title') Visa View @endsection

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Assign Form</span>
        </div>

        <div class="carousel w-full relative"></div>
        
      
        <section class="2xl:px-64 xl:px-52 lg:px-24 md:px-5 sm:px-5 px-5">
            <div class="text-sm breadcrumbs">
                <ul>
                    <li class="text-info font-semibold"><a>Cloud-travel.co.uk</a></li>
                    <li><a>India visa for Singapore passport holder living in United Kingdom</a></li>
                </ul>
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


            <!-- <div class="w-full flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-col sm:flex-col flex-col mt-10"> -->
                <div class="container flex justify-center p-5">

                    <div class="form-container bg-white p-5 rounded-lg shadow-lg w-96">
                   
                        <h2 class="text-xl font-bold mb-4">Visa to United States of America</h2>
                        <label class="block mt-2 font-semibold">Visa Category</label>
                        <form action="{{  route('visa.book') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                       <input type="hidden" value="{{ $visas['0']->origin }}" name="origin">
                       <input type="hidden" value="{{ $visas['0']->destination }}" name="destination">
                        <select class="w-full p-2 border rounded"  name="typeof" id="typeof">
                            @forelse($visas as $visaServiceType) 
                                @if ($visaServiceType->VisaServices) 
                                    <option value="{{ $visaServiceType->VisaServices->id }}">
                                        {{ $visaServiceType->VisaServices->name }}
                                    </option>
                                @endif
                            @empty
                                <div class="p-2 flex 2xl:w-full xl:w-full lg:w-full md:w-1-5 sm:w-1/3 w-1/2 flex-col border-l-4 border-l-red-500">
                                    <span class="text-black font-semibold text-xl">No Record found</span>  
                                </div>
                            @endforelse
                                               
                        </select>
                        <label class="block mt-2 font-semibold">Visa Type</label>
                        <select class="w-full p-2 border rounded" id="category" name="category">
                       
                                    <option value="">
                                        Select 
                                    </option>
                           
                                               
                        </select>
                        <label class="block mt-2 font-semibold">Processing Time</label>
                        <select class="w-full p-2 border rounded">
                            <option>15 business days</option>
                        </select>
                        <label class="block mt-2 font-semibold">Last Name</label>
                        <input type="text" name="lastname" class="w-full p-2 border rounded" placeholder="As shown in passport">
                        <label class="block mt-2 font-semibold">First Name</label>
                        <input type="text" name="firstname" class="w-full p-2 border rounded" placeholder="As shown in passport">
                        <label class="block mt-2 font-semibold">Citizenship</label>
                        <select class="w-full p-2 border rounded" name="citizenship">
                            <option>India</option>
                        </select>
                        <label class="block mt-2 font-semibold">Email</label>
                        <input type="email" name="email" class="w-full p-2 border rounded" placeholder="Enter your email">
                        <label class="block mt-2 font-semibold">Phone Number</label>
                        <input type="text"  name="phonenumber" class="w-full p-2 border rounded" placeholder="Enter your phone number">
                        <label class="block mt-2 font-semibold">Date of Entry</label>
                        <input type="date" name="dateofentry" class="w-full p-2 border rounded">
                        <button id="submit" type="submit" class="bg-green-500 text-white px-4 py-2 mt-4 rounded w-full hover:bg-green-600">Save and Continue</button>
                    </div>
                    <div class="summary-container bg-white p-5 rounded-lg shadow-lg w-72 ml-5">
                        <h3 class="text-lg font-bold mb-2">Basket Details</h3>
                        <p class="flex justify-between"><span>Visa Fee:</span> <span class="visa-price">₹16,096.00</span></p>
                        <p class="flex justify-between"><span>Service Fee:</span> <span class="visa-commision">₹5,998.00</span></p>
                        <p class="flex justify-between"><span>Tax:</span> <span></span></p>
                        <h3 class="text-lg font-bold mt-2" >Total: <span class="visa-total"> ₹23,173.82 </span></h3>
                    </div>
                </div>
             </form>
            <!-- </div> -->
        </section>
    </div>

    @section('scripts')
    <script>
$(document).ready(function () {
    function fetchCategories() {
        var visa_type_id = $("#typeof").val();
        if (visa_type_id) {
            $.ajax({
                url: "{{ route('get.visa.services') }}", // API for fetching subtypes
                type: "GET",
                data: { visa_type_id: visa_type_id },
                success: function (data) {
                    var html = ''; // Default option

                    $.each(data, function (index, category) {
                        html += '<option value="' + category.id + '" data-price="' + category.price + '" data-commission="' + category.commission + '">' + category.name + "</option>";
                    });

                    $("#category").empty().append(html); 

                    // **Trigger change event after setting new options**
                    $("#category").trigger("change");
                },
                error: function (xhr) {
                    console.error(xhr.responseText); // Debugging
                },
            });
        } else {
            $("#category").empty().append('<option value="">Select Category</option>'); // Reset category dropdown
            $(".visa-price").text("₹0.00"); // Reset price
            $(".visa-commision").text("₹0.00"); // Reset commission
            $(".visa-total").text("₹0.00"); // Reset total
        }
    }

    // Run AJAX when document is ready
    fetchCategories();

    // Run AJAX when visa type changes
    $("#typeof").on("change", function () {
        fetchCategories();
    });

    // When Category (`#category`) changes, update the price
    $("#category").on("change", function () {
        var selectedOption = $(this).find(":selected");
        var visaPrice = parseFloat(selectedOption.data("price")) || 0;  // Convert to number, default 0
        var commission = parseFloat(selectedOption.data("commission")) || 0;  // Convert to number, default 0

        var total = visaPrice + commission; // Correct addition

        $(".visa-price").text("₹" + visaPrice.toFixed(2)); // Update displayed price
        $(".visa-commision").text("₹" + commission.toFixed(2)); // Update displayed commission
        $(".visa-total").text("₹" + total.toFixed(2)); // Update displayed total
    });
});

  

//   $(document).ready(function () {
//         // Example: Fetch Visa Services when a country is selected
//         $('#typeof').on('change', function () {
//             var country_id = $(this).val(); // Get selected country ID
            
//             if (country_id) {
//                 $.ajax({
//                     url: "{{ route('get.visa.services') }}", // Route to fetch data
//                     type: "GET",
//                     data: { country_id: country_id },
//                     success: function (data) {
//                         var html = ''; // Default option

//                             $.each(data, function(index, visa) {
//                                 html += '<option value="' + visa.id + '">' + visa.name + '</option>';
//                             });

//                             $('#category').empty().append(html); // Clear and append new options

         
//                     }
//                 });
//             } else {
//                 $('#typeof').empty();
//                 $('#typeof').append('<option value="">Select Visa Type</option>');
//             }
//         });
//     });
    </script>
    @endsection
</x-agency.layout>
