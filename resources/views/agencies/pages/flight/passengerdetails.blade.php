<x-agency.layout>

    @if ($errors->any())
        <div class="rounded-md bg-red-300 py-4 px-8">
            <ol class="list-disc font-semibold">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ol>
        </div>
    @endif

    <form action="{{ route('flight.payment') }}" method="POST">
        @csrf
        <section class=" w-full mx-auto grid lg:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-8 pt-6 px-4">
        <div class="w-full h-max bg-white p-4 rounded-[3px] border-[1px] border-ternary/20 lg:col-span-3 md:col-span-2 col-span-1">
            <div class="p-2 font-semibold text-black text-lg flex flex-col">
                <span>PASSENGER DETAILS </span>
                <span class="text-xs text-gray-700"><span class="text-secondary">Note:</span> Please make sure you enter the Name as per your govt. photo id.</span>
            </div>

            <div class="py-4">
                @for ($adult = 1; $adult <= $flightSearch->adult; $adult++)
                    <div class="p-2 font-semibold bg-secondary/10 text-secondary text-lg">
                        <span><i class="fa-solid fa-user mr-2"></i></span>
                        <span>Adult {{ $adult }}</span>
                    </div>
                    <div class="py-6">
                        <div class="w-full grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-2">
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black font-bold text-sm">Prefix*</label>
                                <select name="adultPrefix[]" required
                                        class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400">
                                    <option value="">Title</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Ms">Ms</option>
                                </select>
                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black font-bold text-sm">First Name*</label>
                                <input type="text"  placeholder="First Name/ Given Name" name="adultFirstName[]" required
                                       class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black font-bold text-sm">Middle Name</label>
                                <input type="text" placeholder="Middle Name" name="adultMiddleName[]"
                                       class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black font-bold text-sm">Last Name*</label>
                                <input type="text" placeholder="Last Name" name="adultLastName[]" required
                                       class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="gender" class="text-black font-bold text-sm">Gender*</label>
                                <select id="gender" name="adultGender[]" required
                                        class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black font-bold text-sm">Date of Birth*</label>
                                <input type="date" name="adultDateOfBirth[]" required
                                       class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="sitting" class="text-black font-bold text-sm">Seating*</label>
                                <select id="sitting" name="adultSeatingPreference[]" required
                                        class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400">
                                    <option value="No preference">No preference</option>
                                    <option value="Aisle seat">Aisle seat</option>
                                    <option value="Bulkhead seat">Bulkhead seat</option>
                                    <option value="Cradle/Baby Basket seat">Cradle/Baby Basket seat</option>
                                    <option value="Exit seat">Exit seat</option>
                                    <option value="Non smoking window seat">Non smoking window seat</option>
                                    <option value="Suitable for disable seat">Suitable for disable seat</option>
                                    <option value="Suitable for disable seat">Suitable for disable seat</option>
                                    <option value="Legspace">Legspace</option>
                                    <option value="Non smoking seat">Non smoking seat</option>
                                    <option value="Overwing seat">Overwing seat</option>
                                    <option value="Smoking seat">Smoking seat</option>
                                    <option value="Window seat">Window seat</option>
                                </select>
                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="assistance" class="text-black font-bold text-sm">Assistance*</label>
                                <select id="assistance" name="adultAssistance[]" required
                                        class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400">
                                    <option selected="selected" value="No preference">No preference</option>
                                    <option value="Overwing seat">Deaf</option>
                                    <option value="Smoking seat">Blind</option>
                                    <option value="Window seat">Wheelchair</option>
                                </select>
                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="meal" class="text-black font-bold text-sm">Meal*</label>
                                <select id="meal" name="adultMealPreference[]" required
                                        class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400">
                                    <option value="No preference">No preference</option>
                                    <option value="BBML">Baby Meal</option>
                                    <option value="BLML">Bland Meal</option>
                                    <option value="CHML">Child Meal Meal</option>
                                    <option value="DBML">Diabetic Meal</option>
                                    <option value="FPML">Fruit Platter Meal</option>
                                    <option value="GFML">Gluten Intolerant Meal</option>
                                    <option value="HNML">Hindu Meal</option>
                                    <option value="KSML">Kosher Meal</option>
                                    <option value="LCML">Low Calorie Meal</option>
                                    <option value="LFML">Low Fat Meal</option>
                                    <option value="NLML">Low Lactose Meal</option>
                                    <option value="LSML">Low Salt Meal</option>
                                    <option value="MOML">Muslim Meal</option>
                                    <option value="RVML">Raw Vegetarian Meal</option>
                                    <option value="SFML">Seafood Meal</option>
                                    <option value="SPML">Special Meal</option>
                                    <option value="AVML">Vegetarian Hindu Meal</option>
                                    <option value="VJML">Vegetarian Jain Meal</option>
                                    <option value="VLML">Vegetarian Lacto-Ovo</option>
                                    <option value="VGML">Vegetarian Meal</option>
                                    <option value="VOML">Vegetarian Oriental Meal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                @endfor

                @for ($child = 1; $child <= $flightSearch->child; $child++)
                    <div class="p-2 font-semibold bg-secondary/10 text-secondary text-lg">
                        <span class=""><i class="fa-solid fa-user mr-2"></i></span>
                        <span class="">Children {{ $child }}</span>
                    </div>
                    <div class="py-6">
                        <div class="w-full grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-2">
                            <div class="w-full relative flex flex-col">
                                <label for="childTitle" class="text-black font-bold text-sm">Prefix*</label>
                                <select id="childTitle" name="childTitle[]" required
                                        class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400">
                                    <option value="">Title</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Ms">Ms</option>
                                </select>
                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="childFirstName" class="text-black font-bold text-sm">First Name*</label>
                                <input type="text" id="childFirstName"  placeholder="First Name/ Given Name" name="childFirstName[]" required
                                       class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black font-bold text-sm">Middle Name</label>
                                <input type="text" placeholder="Middle Name" name="childMiddleName[]"
                                       class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black font-bold text-sm">Last Name*</label>
                                <input type="text" placeholder="Last Name" name="childLastName[]" required
                                       class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="gender" class="text-black font-bold text-sm">Gender*</label>
                                <select id="gender" name="childGender[]" required
                                        class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black font-bold text-sm">Date of Birth*</label>
                                <input type="date" name="childDateOfBirth[]" required
                                       class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="sitting" class="text-black font-bold text-sm">Seating*</label>
                                <select id="sitting" name="childSeatingPreference[]" required
                                        class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400">
                                    <option value="No preference">No preference</option>
                                    <option value="Aisle seat">Aisle seat</option>
                                    <option value="Bulkhead seat">Bulkhead seat</option>
                                    <option value="Cradle/Baby Basket seat">Cradle/Baby Basket seat</option>
                                    <option value="Exit seat">Exit seat</option>
                                    <option value="Non smoking window seat">Non smoking window seat</option>
                                    <option value="Suitable for disable seat">Suitable for disable seat</option>
                                    <option value="Suitable for disable seat">Suitable for disable seat</option>
                                    <option value="Legspace">Legspace</option>
                                    <option value="Non smoking seat">Non smoking seat</option>
                                    <option value="Overwing seat">Overwing seat</option>
                                    <option value="Smoking seat">Smoking seat</option>
                                    <option value="Window seat">Window seat</option>
                                </select>
                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="assistance" class="text-black font-bold text-sm">Assistance*</label>
                                <select id="assistance" name="childAssistance[]" required
                                        class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400">
                                    <option selected="selected" value="No preference">No preference</option>
                                    <option value="Overwing seat">Deaf</option>
                                    <option value="Smoking seat">Blind</option>
                                    <option value="Window seat">Wheelchair</option>
                                </select>
                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="meal" class="text-black font-bold text-sm">Meal*</label>
                                <select id="meal" name="childMealPreference[]" required
                                        class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400">
                                    <option value="No preference">No preference</option>
                                    <option value="BBML">Baby Meal</option>
                                    <option value="BLML">Bland Meal</option>
                                    <option value="CHML">Child Meal Meal</option>
                                    <option value="DBML">Diabetic Meal</option>
                                    <option value="FPML">Fruit Platter Meal</option>
                                    <option value="GFML">Gluten Intolerant Meal</option>
                                    <option value="HNML">Hindu Meal</option>
                                    <option value="KSML">Kosher Meal</option>
                                    <option value="LCML">Low Calorie Meal</option>
                                    <option value="LFML">Low Fat Meal</option>
                                    <option value="NLML">Low Lactose Meal</option>
                                    <option value="LSML">Low Salt Meal</option>
                                    <option value="MOML">Muslim Meal</option>
                                    <option value="RVML">Raw Vegetarian Meal</option>
                                    <option value="SFML">Seafood Meal</option>
                                    <option value="SPML">Special Meal</option>
                                    <option value="AVML">Vegetarian Hindu Meal</option>
                                    <option value="VJML">Vegetarian Jain Meal</option>
                                    <option value="VLML">Vegetarian Lacto-Ovo</option>
                                    <option value="VGML">Vegetarian Meal</option>
                                    <option value="VOML">Vegetarian Oriental Meal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                @endfor

                @for ($infant = 1; $infant <= $flightSearch->infant; $infant++)
                    <div class="p-2 font-semibold bg-secondary/10 text-secondary text-lg">
                        <span><i class="fa-solid fa-user mr-2"></i></span>
                        <span>Infant {{ $infant }}</span>
                    </div>
                    <div class="py-6">
                        <div class="w-full grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-2">
                            <div class="w-full relative flex flex-col">
                                <label for="childTitle" class="text-black font-bold text-sm">Prefix*</label>
                                <select id="childTitle" name="infantPrefix[]" required
                                        class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400">
                                    <option value="">Title</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Ms">Ms</option>
                                </select>
                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="childFirstName" class="text-black font-bold text-sm">First Name*</label>
                                <input type="text" id="childFirstName"  placeholder="First Name/ Given Name" name="infantFirstName[]" required
                                       class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black font-bold text-sm">Middle Name</label>
                                <input type="text" placeholder="Middle Name" name="infantMiddleName[]"
                                       class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black font-bold text-sm">Last Name*</label>
                                <input type="text" placeholder="Last Name" name="infantLastName[]" required
                                       class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="gender" class="text-black font-bold text-sm">Gender*</label>
                                <select id="gender" name="infantGender[]" required
                                        class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                            <div class="w-full relative flex flex-col">
                                <label for="travelClass" class="text-black font-bold text-sm">Date of Birth*</label>
                                <input type="date" name="infantDateOfBirth[]" required
                                       class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                            </div>
                        </div>
                    </div>
                @endfor
            </div>


            <div class="p-2 font-semibold bg-secondary/10 text-secondary text-lg  flex flex-col ">
                <span>PASSENGER ADDRESS </span>
            </div>
            <div class="py-6">
                <div class="w-full grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 grid-col-1 gap-2">
                    <div class="w-full relative flex flex-col">
                        <label for="travelClass" class="text-black font-bold text-sm">Post Code*</label>
                        <input type="text" placeholder="Enter Post Code" name="postcode" required
                               class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                    </div>
                    <div class="w-full relative flex flex-col">
                        <label for="travelClass" class="text-black font-bold text-sm">Address Line 1*</label>
                        <input type="text" placeholder="Enter Address line 1" name="addressLine1" required
                               class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                    </div>
                    <div class="w-full relative flex flex-col">
                        <label for="travelClass" class="text-black font-bold text-sm">Address Line 2</label>
                        <input type="text" placeholder="Enter Address Line 2 " name="addressLine2"
                               class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                    </div>
                    <div class="w-full relative flex flex-col">
                        <label for="travelClass" class="text-black font-bold text-sm">City*</label>
                        <input type="text" placeholder="Enter your town/city name" name="city" required
                               class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                    </div>
                    <div class="w-full relative flex flex-col">
                        <label for="travelClass" class="text-black font-bold text-sm">State*</label>
                        <input type="text" placeholder="Enter your state name" name="state" required
                               class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                    </div>
                    <div class="w-full relative flex flex-col">
                        <label for="country" class="text-black font-bold text-sm">Country*</label>
                        <select id="country" name="country" required
                                class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400">
                            <option value="">--Select--</option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option>
                            <option value="Antigua And Barbuda">Antigua And Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia And Herzegovina">Bosnia And Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option>
                            <option value="British Indian Ocean Territory">British Indian Ocean Territory
                            </option>
                            <option value="Brunei&nbsp;Darussalam">Brunei&nbsp;Darussalam</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman&nbsp;Islands">Cayman&nbsp;Islands</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos&nbsp;(Keeling) Islands">Cocos&nbsp;(Keeling) Islands
                            </option>
                            <option value="Colombia">Colombia</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Congo, The Democratic Republic Of">Congo, The Democratic
                                Republic
                                Of
                            </option>
                            <option value="Cook Islands">Cook Islands</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Cote D'Ivoire">Cote D'Ivoire</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)
                            </option>
                            <option value="Faroe&nbsp;Islands">Faroe&nbsp;Islands</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="French Guiana">French Guiana</option>
                            <option value="French Polynesia">French Polynesia</option>
                            <option value="French Southern Territories">French Southern Territories
                            </option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option>
                            <option value="Greenland">Greenland</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option>
                            <option value="Guam">Guam</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Heard Island And Mcdonald Islands">Heard Island And Mcdonald
                                Islands
                            </option>
                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)
                            </option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran, Islamic Republic Of">Iran, Islamic Republic Of</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic People'S Republic Of">Korea, Democratic
                                People'S
                                Republic Of
                            </option>
                            <option value="Korea,&nbsp;Republic Of">Korea,&nbsp;Republic Of</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Lao People'S Democratic Republic">Lao People'S Democratic
                                Republic
                            </option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Macao">Macao</option>
                            <option value="Macedonia,&nbsp;The Former Yugoslav Republic Of">
                                Macedonia,&nbsp;The
                                Former Yugoslav Republic Of
                            </option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia, Federated States Of">Micronesia, Federated States Of
                            </option>
                            <option value="Moldova, Republic Of">Moldova, Republic Of</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk&nbsp;Island">Norfolk&nbsp;Island</option>
                            <option value="Northern Mariana&nbsp;Islands">Northern Mariana&nbsp;Islands
                            </option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied
                            </option>
                            <option value="Panama">Panama</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option>
                            <option value="Russian Federation">Russian Federation</option>
                            <option value="Russian Federation">Russian Federation</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Helena">Saint Helena</option>
                            <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option>
                            <option value="Saint Lucia">Saint Lucia</option>
                            <option value="Saint Pierre And Miquelon">Saint Pierre And Miquelon</option>
                            <option value="Saint Vincent And The Grenadines">Saint Vincent And The
                                Grenadines
                            </option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome And Principe">Sao Tome And Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Serbia &amp; Montenegro">Serbia &amp; Montenegro</option>
                            <option value="Serbia &amp; Montenegro">Serbia &amp; Montenegro</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Georgia &amp; The South Sandwich Islands">South Georgia
                                &amp;
                                The South Sandwich Islands
                            </option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Svalbard And Jan Mayen">Svalbard And Jan Mayen</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                            <option value="Taiwan, Province Of China">Taiwan, Province Of China</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania,&nbsp;United&nbsp;Republic Of">
                                Tanzania,&nbsp;United&nbsp;Republic
                                Of
                            </option>
                            <option value="Thailand">Thailand</option>
                            <option value="Timor-Leste">Timor-Leste</option>
                            <option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad And Tobago">Trinidad And Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Turks And Caicos&nbsp;Islands">Turks And Caicos&nbsp;Islands
                            </option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                            <option value="United States">United States</option>
                            <option value="United States">United States</option>
                            <option value="United States Minor Outlying Islands">United States Minor
                                Outlying
                                Islands
                            </option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Viet Nam">Viet Nam</option>
                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                            <option value="Wallis And Futuna">Wallis And Futuna</option>
                            <option value="Western Sahara">Western Sahara</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="py-6 mt-4 bg-white">
                <div class="w-full grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-2">
                    <div class="w-full relative flex flex-col">
                        <label for="travelClass" class="text-black font-bold text-sm">Email Id*</label>
                        <input type="email" placeholder="Enter your email id" name="email" required
                               class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>

                    </div>
                    <div class="w-full relative flex flex-col">
                        <label for="travelClass" class="text-black font-bold text-sm">Mobile Number*</label>
                        <input type="number" placeholder="Enter your mobile number" name="phone" required
                               class="w-full mt-2 px-4 py-3 font-medium bg-[#f3f4f6] text-gray-700  rounded-md border-[1px] border-gray-400 focus:border-gray-700 focus:outline-none focus:ring-0 placeholder-gray-400"/>
                    </div>
                </div>
            </div>
             <div class="px-2 py-4 flex justify-end">
                 <button type="submit" class="showLoader w-max font-semibold text-md bg-secondary/80 text-white/90 px-6 py-2 rounded-[3px] border-[1px] border-secondary hover:bg-secondary hover:text-white transition ease-in duration-2000">Proceed to
                     Payment </button>
             </div>

</div>


<div class="w-full h-max bg-white p-4 rounded-[3px] border-[1px] border-ternary/20 shadow-lg shadow-ternary/10">
            @foreach ($details[3]->AirPricingInfo as $key => $paxPricing)

                       <div class="p-2 font-semibold bg-secondary/10 text-secondary text-lg rounded-t-[3px] grid grid-cols-2 gap-2">
                         <div class="flex flex-col">
                               <span>Passenger Type: </span>
                                <span class="text-xs">
                                       @if ($key == 0)
                                        {{ $flightSearch->adult. ' Adults' }}
                                    @elseif($key == 1)
                                        {{ $flightSearch->child . ' Children' }}
                                    @elseif($key == 2)
                                        {{ $flightSearch->infant . ' Infants' }}
                                    @endif
                                </span>
                         </div>
                        <div class="flex items-center justify-end">
                            @php
                                $count = 1;
                                if ($key == 0) {
                                    $count = $flightSearch->adult;
                                } elseif ($key == 1) {
                                    $count = $flightSearch->child;
                                } elseif ($key == 2) {
                                    $count = $flightSearch->infant;
                                }
                            @endphp
                            <span class="text-secondary"> {{ currencySymbol($flightSearch->currency) }}
                                {{ (float) str_replace($flightSearch->currency, '', $paxPricing->TotalPrice) * $count }}</span>
                        </div>
                    </div>
                        <div class="flex justify-between px-2 pt-2">
                            <span class="text-primaryDarkColor font-semibold text-md">Base Fare x 1</span>
                            <span class="text-secondary font-semibold text-sm">{{ currencySymbol($flightSearch->currency) }}
                                {{ (float) str_replace($flightSearch->currency, '', $paxPricing->BasePrice) }}</span>
                        </div>
                        <div class="flex justify-between px-2 pt-1 pb-2">
                            <span class="text-primaryDarkColor font-semibold text-md">Fee & Surcharge x 1</span>
                            <span class="text-secondary font-semibold text-sm">{{ currencySymbol($flightSearch->currency) }}
                                {{ (float) str_replace($flightSearch->currency, '', $paxPricing->ApproximateTaxes) }}</span>
                        </div>

            @endforeach

            <div class="flex justify-between px-2 py-1 border-b-[1px] border-b-secondary">
                <span class="text-primaryDarkColor font-semibold text-md">Quote Date</span>
                <span class="text-secondary font-semibold text-sm">{{ $details[2]->price->QuoteDate }}</span>
            </div>
            <div class="flex justify-between px-2 py-3">
                <span class="text-primaryDarkColor font-semibold text-lg">Total</span>
                <span class="text-secondary font-semibold text-md">{{ currencySymbol($flightSearch->currency) }}
                    {{ str_replace($flightSearch->currency, '', $details[2]->price->TotalPrice) }}</span>
            </div>

                <input type="text" name="details" class="hidden" value="{{ json_encode($details) }}" required
                       readonly>
                <input type="text" name="flightSearch" class="hidden" value="{{ json_encode($flightSearch) }}"
                       required readonly>
            <div class="w-full p-2">
                <button type="submit" class="showLoader w-full font-semibold text-md bg-secondary/80 text-white/90 px-6 py-2 rounded-[3px] border-[1px] border-secondary hover:bg-secondary hover:text-white transition ease-in duration-2000">Proceed to
                    Payment </button>
            </div>
        </div>
    </section>

         
    </form>


 
</x-agency.layout>