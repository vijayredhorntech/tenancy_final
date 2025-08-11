<div class="w-full lg:px-6 px-4 flex justify-between items-center bg-white sticky top-0 z-50 py-3 border-b-[1px] border-b-ternary/50">
    <div class="lg:hidden flex gap-2 justify-between items-center w-full">
         <div class="flex gap-2 items-center">
           <div class=" relative">
               <label class="bg-primaryColor rounded-sm text-white px-4 py-2 lg:hidden" onclick="document.getElementById('mobileNav').classList.toggle('hidden')">
                   <i class="fa fa-bars"></i>
               </label>
               <div id="mobileNav" class="absolute top-[100%] z-50 left-0 pt-4 hidden">
                   <ul  class=" p-2 bg-primary rounded-sm w-max">
                       <a href=""><li class="text-white font-semibold w-[90vw] py-2 border-b-[1px] border-b-primaryColor"><i class="fa fa-plane-departure mr-2"></i>FLIGHTS</li></a>
                       <a href=""><li class=" text-white font-semibold w-[90vw] py-2 border-b-[1px] border-b-primaryColor"><i class="fa fa-hotel mr-2"></i> HOTELS</li></a>
                       <a href=""><li class=" text-white font-semibold w-[90vw] py-2 border-b-[1px] border-b-primaryColor"><i class="fa fa-ticket mr-2"></i> FLIGHTS & HOTELS</li></a>
                       <a href=""><li class=" text-white font-semibold w-[90vw] py-2 border-b-[1px] border-b-primaryColor"> <i class="fa fa-gift mr-2"></i> OFFERS</li></a>
                       <a href=""><li class=" text-white font-semibold w-[90vw] py-2 border-b-[1px] border-b-primaryColor"><i class="fa-brands fa-cc-visa mr-2"></i> VISA</li></a>
                   </ul>
               </div>

           </div>
           <a class="btn btn-ghost normal-case text-xl" href="{{ env('APP_URL') }}">
               <img src="{{asset('assets/images/logo.png')}}" class="h-12 object-cover" alt="">
           </a>
       </div>


 



        <button  class="bg-primaryColor text-white px-4 py-2 rounded-sm font-semibold w-max">Sign In</button>
    </div>


    <div class="lg:flex hidden gap-6 justify-between items-center w-full">
           <div class="w-max flex items-center">
               <a class="" href="{{ env('APP_URL') }}">
                   <img src="{{asset('assets/images/logo.png')}}" class="h-16 object-cover" alt="">
               </a>
           </div>

            <div class="flex items-center">
                <ul  class="w-max flex gap-6">
                    @php
                      $navLists = [
                            [
                                'name' => 'flight',
                                'icon' => 'fa fa-plane-departure',
                                'link' => '#',
                            ],
                            [
                                'name' => 'hotels',
                                'icon' => 'fa fa-hotel',
                                'link' => '#',
                            ],
                            [
                                'name' => 'flights & hotels',
                                'icon' => 'fa fa-ticket',
                                'link' => '#',
                            ],
                            [
                                'name' => 'offers',
                                'icon' => 'fa fa-gift',
                                'link' => '#',
                            ],
                            [
                                'name' => 'visa',
                                'icon' => 'fa-brands fa-cc-visa',
                                'link' => '#',
                            ],
                      ];
                    @endphp
                    @foreach($navLists as $navList)
                        <a href="{{ $navList['link'] }}">
                            <li class="{{$loop->iteration==1?'text-secondary border-b-secondary ':'text-black border-b-whiteColor hover:text-primary hover:border-b-primary'}}  border-b-[1px] text-lg font-semibold  transition ease-in duration-2000">
                                <i class="{{ $navList['icon'] }} mr-2"></i>
                                {{ strtoupper($navList['name']) }}
                            </li>
                        </a>
                    @endforeach
                </ul>
{{--                <div class=" flex flex-col justify-start align-middle 2xl:block xl:block  lg:block  md:hidden ml-8 ">--}}
{{--                    <a href="" class="flex flex-col items-center">--}}
{{--                        <h3 class="text-redColor text-xl font-semibold">0203 500 0000</h3>--}}
{{--                        <p class=" text-primaryDarkColor text-[10px]">24 hours a day / 7 days a week</p>--}}
{{--                    </a>--}}
{{--                </div>--}}
            </div>


            <div class="flex gap-2 items-center ">
               <a href="{{ route('agency.login') }}" 
                        class="bg-transparent hover:bg-secondary text-primary hover:text-red border-[1px] border-primary hover:border-secondary px-4 py-1 rounded-sm font-semibold w-max hover:scale-105 transition ease-in text-lg duration-2000">
                            Login
                        </a>
                {{-- <button class="bg-primaryColor hover:bg-secondary text-white  border-[1px] border-primary hover:border-secondary px-4 py-1 rounded-sm font-semibold w-max hover:scale-105 transition ease-in text-lg duration-2000">Sign Up</button> --}}
            </div>


    </div>
</div>
