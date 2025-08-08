
<div class="w-full bg-ternary lg:px-6 px-4 py-16 border-b-[1px] border-white/20">
   <div class="w-full grid lg:grid-cols-5 md:grid-cols-4 grid-cols-2 gap-x-2 gap-y-12">
       <div class="w-full p-2 lg:col-span-1 md:col-span-4 col-span-2">
           <a href="{{route('home')}}">
               <img src="{{asset('assets/images/logo.png')}}" alt="" class="h-16 w-auto hover:scale-105 transition ease-in duration-2000">
           </a>
       </div>
       <div class="w-full ">
           @php
               $menuList = [
                     [
                         'name' => 'Home',
                         'link' => '#',
                     ],
                     [
                         'name' => 'About Us',
                         'link' => '#',
                     ],
                     [
                         'name' => 'Customer Service',
                         'link' => '#',
                     ],
                     [
                         'name' => 'Travel Conditions',
                         'link' => '#',
                     ],


               ];
           @endphp
           <span class="text-white font-semibold text-xl">Menu</span>
           <ul class="flex flex-col gap-2 mt-3">
                @foreach ($menuList as $menu)
                   <a href="{{$menu['link']}}" class="w-max">
                          <li class="text-white/80 font-medium text-md hover:text-secondary w-max transition ease-in duration-2000">
                             {{$menu['name']}}
                            </li>
                   </a>
                @endforeach
           </ul>
       </div>
       <div class="w-full ">
           @php
               $menuList = [
                     [
                         'name' => 'Destinations',
                         'link' => '#',
                     ],
                     [
                         'name' => 'Supports',
                         'link' => '#',
                     ],
                     [
                         'name' => 'Terms & Conditions',
                         'link' => '#',
                     ],
                     [
                         'name' => 'Privary',
                         'link' => '#',
                     ],


               ];
           @endphp
           <span class="text-white font-semibold text-xl">Information</span>
           <ul class="flex flex-col gap-2 mt-3">
                @foreach ($menuList as $menu)
                   <a href="{{$menu['link']}}" class="w-max">
                          <li class="text-white/80 font-medium text-md hover:text-secondary w-max transition ease-in duration-2000">
                             {{$menu['name']}}
                            </li>
                   </a>
                @endforeach
           </ul>
       </div>
       <div class="w-full ">
           @php
               $menuList = [
                     [
                         'name' => '02035000000',
                         'link' => 'tel:02035000000',
                     ],
                     [
                         'name' => 'info@cloudtravel.co.uk',
                         'link' => 'mailto:info@cloudtravel.co.uk',
                     ],



               ];
           @endphp
           <span class="text-white font-semibold text-xl">Contact Info</span>
           <ul class="flex flex-col gap-2 mt-3">
                @foreach ($menuList as $menu)
                   <a href="{{$menu['link']}}" class="w-max">
                          <li class="text-white/80 font-medium text-md hover:text-secondary w-max transition ease-in duration-2000">
                             {{$menu['name']}}
                            </li>
                   </a>
                @endforeach
           </ul>
       </div>
       <div class="w-full ">
           @php
               $menuList = [
                     [
                         'name' => 'fa-brands fa-facebook',
                         'link' => 'tel:02035000000',
                     ],

                     [
                         'name' => 'fa-brands fa-instagram',
                         'link' => 'tel:02035000000',
                     ],

                     [
                         'name' => 'fa-brands fa-twitter',
                         'link' => 'tel:02035000000',
                     ],

                     [
                         'name' => 'fa-brands fa-pinterest-p',
                         'link' => 'tel:02035000000',
                     ],




               ];
           @endphp
           <span class="text-white font-semibold text-xl">Follow Us On</span>
           <ul class="flex  gap-2 mt-3">
                @foreach ($menuList as $menu)
                   <a href="{{$menu['link']}}" class="w-max">
                          <li class="text-white/80 font-medium text-2xl hover:text-secondary w-max transition ease-in duration-2000">
                              <i class="{{ $menu['name'] }} mr-2"></i>
                            </li>
                   </a>
                @endforeach
           </ul>
       </div>
   </div>
</div>



<div class=" bg-ternary w-full px-4 py-1 flex justify-center ">
        <span class="text-white/80 font-medium text-md w-max text-center">&#169 Copyright 2024 | cloudtravel.co.uk All Rights Reserved </span>
</div>
