

<x-navigation-front />
 
<div class="w-full h-max ">
    <div
        class="w-full h-96 bg-no-repeat bg-center bg-cover bg-[url('https://plus.unsplash.com/premium_photo-1682145930966-712ce7177919?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')]">
 
    </div>
</div>

<div class="lg:w-3/4 md:w-3/4 sm:w-full w-full h-max m-auto  py-4 bg-sky-200 ">

    <div class="w-full h-max flex justify-between lg:flex-row md:flex-row sm:flex-col flex-col relative ">

        <div class="h-max lg:w-3/4 md:w-3/4 sm:w-full w-full flex justify-between  flex-wrap px-12 ">
            <div class=" flex flex-col">
                <span class="m-auto text-xl"><i class="fa-solid fa-arrow-trend-up" style="color: deepskyblue"></i></span>
                <button class=" w-full text-gray-600 text-lg font-semibold ">Trending</button>
            </div>
            <div class=" flex flex-col">
                <span class="m-auto text-xl"><i class="fa-solid fa-gem" style="color: deepskyblue"></i></span>
                <button class=" w-full text-gray-600 text-lg font-semibold ">Luxe</button>
            </div>
            <div class=" flex flex-col">
                <span class="m-auto text-xl"><i class="fa-solid fa-umbrella-beach" style="color: deepskyblue"></i></span>
                <button class=" w-full text-gray-600 text-lg font-semibold ">Beach</button>
            </div>
            <div class=" flex flex-col">
                <span class="m-auto text-xl"><i class="fa-solid fa-person" style="color: deepskyblue"></i></span>
                <button class=" w-full text-gray-600 text-lg font-semibold ">Families</button>
            </div>
            <div class=" flex flex-col">
                <span class="m-auto text-xl"><i class="fa-solid fa-tree" style="color: deepskyblue"></i></span>
                <button class=" w-full text-gray-600 text-lg font-semibold ">Golf</button>
            </div>
            <div class=" flex flex-col">
                <span class="m-auto text-xl"><i class="fa-solid fa-dumbbell" style="color: deepskyblue"></i></span>
                <button class=" w-full text-gray-600 text-lg font-semibold ">Wellness</button>
            </div>
            <div class=" flex flex-col">
                <span class="m-auto text-xl"><i class="fa-solid fa-hotel" style="color: deepskyblue"></i></span>
                <button class=" w-full text-gray-600 text-lg font-semibold ">All Hotels</button>
            </div>
        </div>

        <div id="filterModal" class=" z-10 absolute right-0 lg:w-1/2 md:w-1/2 sm:w-full w-full p-2 h-max bg-white border-4 border-sky-400 rounded-lg hidden">
            <div class="w-full h-max py-3 px-2 flex justify-between bg-gray-100 rounded-md ">
                <span class="text-lg text-black font-semibold">More Filters</span>
                <div class="bg-sky-500 h-max p-1 rounded-md text-white flex" onclick="closeFilterModal()">
                    <i class="fa-solid fa-xmark m-auto" ></i>
                </div>
            </div>

            <div class="border-b-2 border-b-gray-200 w-full h-max p-3">
                <div>
                    <span class="text-black font-semibold">Board Type</span>
                </div>
                <div class="mt-2 py-4 px-2 w-11/12  flex justify-between flex-wrap gap-4">
                    <div class="w-1/4">
                        <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-sky-500 rounded focus:border-sky-500 focus:ring-0 mr-2 ">
                        <span class="text-sm text-gray-900 font-semibold m-auto">Breakfast</span>
                    </div>
                    <div class="w-1/4">
                        <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-sky-500 rounded focus:border-sky-500 focus:ring-0 mr-2 ">
                        <span class="text-sm text-gray-900 font-semibold m-auto">Half Board</span>
                    </div>
                    <div class="w-1/4">
                        <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-sky-500 rounded focus:border-sky-500 focus:ring-0 mr-2 ">
                        <span class="text-sm text-gray-900 font-semibold m-auto">Full Board</span>
                    </div>
                    <div class="w-1/4">
                        <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-sky-500 rounded focus:border-sky-500 focus:ring-0 mr-2 ">
                        <span class="text-sm text-gray-900 font-semibold m-auto">All Inclusive</span>
                    </div>
                </div>

            </div>

            <div class=" w-full h-max p-3 mt-8">
                <div>
                    <span class="text-black font-semibold">Chain</span>
                </div>
                <div class="mt-2 py-4 px-2 w-11/12  flex justify-between flex-wrap gap-4">
                    <div class="w-1/4">
                        <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-sky-500 rounded focus:border-sky-500 focus:ring-0 mr-2 ">
                        <span class="text-sm text-gray-900 font-semibold m-auto">Others</span>
                    </div>
                    <div class="w-1/4">
                        <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-sky-500 rounded focus:border-sky-500 focus:ring-0 mr-2 ">
                        <span class="text-sm text-gray-900 font-semibold m-auto">Kempinski</span>
                    </div>
                    <div class="w-1/4">
                        <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-sky-500 rounded focus:border-sky-500 focus:ring-0 mr-2 ">
                        <span class="text-sm text-gray-900 font-semibold m-auto">Accor</span>
                    </div>
                    <div class="w-1/4">
                        <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-sky-500 rounded focus:border-sky-500 focus:ring-0 mr-2 ">
                        <span class="text-sm text-gray-900 font-semibold m-auto">Maritim</span>
                    </div>
                    <div class="w-1/4">
                        <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-sky-500 rounded focus:border-sky-500 focus:ring-0 mr-2 ">
                        <span class="text-sm text-gray-900 font-semibold m-auto">IHG</span>
                    </div>
                    <div class="w-1/4">
                        <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-sky-500 rounded focus:border-sky-500 focus:ring-0 mr-2 ">
                        <span class="text-sm text-gray-900 font-semibold m-auto">Wyndham Worldwide</span>
                    </div>
                </div>

            </div>

            <div class="mt-4 flex justify-end">
                <button class="px-8 py-2 text-white bg-sky-500 border-0 rounded-md font-semibold text-lg">Apply</button>
            </div>


        </div>

        <div id="refundFilterModal" class="z-10 absolute right-0 lg:w-1/2 md:w-1/2 sm:w-full w-full p-2 h-max bg-white border-4 border-sky-400 rounded-lg hidden">
            <div class="w-full h-max py-3 px-2 flex justify-between bg-gray-100 rounded-md ">
                <span class="text-lg text-black font-semibold">Refundable Filters</span>
                <div class="bg-sky-500 h-max p-1 rounded-md text-white flex" onclick="closeRecomendModal()">
                    <i class="fa-solid fa-xmark m-auto" ></i>
                </div>
            </div>

            <div class="border-b-2 border-b-gray-200 w-full h-max p-3">
                <div class="flex flex-wrap">
                    <span class="text-gray-700 text-lg  font-semibold">This is quick, indicative filter only. On rare occasions some non-refundable rates may slip through despite this filter. Please read and accept the policy on the booking details page, as that will be the one application on booking</span>
                </div>


            </div>

            <div class="mt-4 flex justify-end">
                <button class="px-8 py-2 text-white bg-sky-500 border-0 rounded-md font-semibold text-lg" onclick="closeRecomendModal()">OK</button>
            </div>


        </div>
    </div>
    <div class="w-full mt-10 relative ">
        <div class="flex justify-between px-6">
            <span class="text-black lg:text-2xl md:text-2xl sm:text-xl text-md font-semibold">Trending with other Agents</span>
            <a class=" text-blue-500 text-md font-bold" href="#">View All</a>
        </div>

        <div class="px-6 w-full mt-6 grid lg:grid-cols-4 md:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-6">
            <div class="w-full">
                <div class="h-48">
                    <a href="#"> <img class=" h-full w-full object-cover" src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="">
                    </a>
                </div>
                <div class="flex justify-between bg-white p-2">
                    <div class="flex flex-col">
                        <span class="text-xl">
                            <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                            <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                            <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                            <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                            <i class="fa-solid fa-star" style="color: deepskyblue; margin-right: 5px"></i>
                        </span>

                        <span class="text-black font-semibold text-lg mt-2">Aska Lara Resort & Spa</span>
                        <span  class="text-black font-semibold text-md mt-8">Antalya-Lara</span>
                        <span class="mt-8 text-gray-600 font-normal">from <span class="font-bold text-black">£ 877</span></span>
                        <span class="font-semibold text-md text-gray-400"><span>£ 877</span> total for 1 room </span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold" style="color: deepskyblue"><i class="fa-solid fa-comment"></i>4.4</span>
                        <span class="text-black font-semibold text-md">Excellent</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>