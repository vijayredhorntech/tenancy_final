<x-front.layout>
    @section('title') Edit Agency @endsection


    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Edit Agency </span>
              </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 ">
             <form action="{{ route('hs_supdatedstore') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))

                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
                         <input type="hidden" name="id" value="{{ old('name', $edit_user->id ?? '')  }}" id="id" placeholder="Agency name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                        

                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">User Name</label>
                             <div class="w-full relative">
                                 <input type="text" name="name" value="{{ old('name', $edit_user->name ?? '')  }}" id="name" placeholder="Agency name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>
                        
                        
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="email" class="font-semibold text-ternary/90 text-sm">Email</label>
                             <div class="w-full relative">
                                 <input type="email" name="email" id="email" value="{{ old('email', $edit_user->email ?? '')  }}" placeholder="Email....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-envelope absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


          
                         
                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Phone</label>
                             <div class="w-full relative">
                                 <input type="number" name="phone" value="{{ old('phone', $edit_user->userdetails->phone_number ?? '')  }}" id="phone" placeholder="Phone....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                 <i class="fa fa-phone absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Role </label>
                             <div class="w-full relative">
                             <select name="role" id="datePicker" class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                        <option value="">---Select---</option>
                                        @if(isset($roles))
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}"   {{ $edit_user?->roles->first()?->id == $role->id ? 'selected' : '' }} >
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option>NO Role</option>
                                        @endif
                                    </select>

                                 <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                             </div>
                         </div>


                         <div class="w-full relative group flex flex-col gap-1">
                             <label for="datePicker" class="font-semibold text-ternary/90 text-sm">Select box</label>
                             <div class="w-full relative">
                                 <select  name="date" id="datePicker"
                                          class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                     <option value="">---Select---</option>
                                     <option value="technical">Technical</option>
                                     <option value="accountant">Accountant</option>
                                  </select>
                                 <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                             </div>
                         </div>

               

                         <div class="w-full relative group flex flex-col gap-2">
                             <label class="font-semibold text-ternary/90 text-sm">Select Leves</label>
                             <div class="flex gap-2 flex-wrap">
                                 @forelse($allleaves as $leave)
                                     <div class="flex items-center gap-2">
                                         <input type="checkbox" id="service_{{ $leave->id }}" value="{{ $leave->id }}"  name="leaves[]"
                                                value="{{ $leave->id }}"  
                                                @if($edit_user->leaves->contains('leave_type', $leave->id)) checked @endif
                                                class="appearance-none w-4 h-4 border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 rounded-[3px]  checked:bg-secondary checked:border-secondary/70 transition ease-in duration-200 focus:outline-none focus:ring-0">
                                        
                                         <label for="service_{{ $leave->id }}"
                                                class="font-semibold text-ternary/90 text-sm flex items-center gap-2">{{ $leave->leave_type }}</label>
                                     </div>
                                 @empty
                                     <div class="text-sm text-red-500">No services available</div>
                                 @endforelse
                             </div>
                         </div>

                      
                     </div>
                     <div class="w-full flex justify-end px-4 pb-4 gap-2">
                           <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Update User</button>
                     </div>
                 </form>
             </div>
{{--        === form section code ends here===--}}

        </div>
</x-front.layout>
