<x-front.layout>
    @section('title')Agency @endsection


{{--    === this is code for model ===--}}
    <div id="viewServiceModel" class="w-full h-full absolute top-0 left-0 bg-white/40 z-20 flex hidden justify-center items-center cursor-pointer" >
                 <div class="rounded-[3px] bg-white px-8 py-12 shadow-lg shadow-gray-300 border-[2px] border-gray-400/50 max-w-5xl relative">
                     <div class="absolute top-1 right-1 h-6 w-6 flex rounded-full justify-center items-center bg-danger/30 border-[1px] border-danger/70 text-ternary hover:bg-danger hover:text-white transition ease-in duration-2000" onclick="document.getElementById('viewServiceModel').classList.toggle('hidden')">
                          <i class="fa fa-xmark"></i>
                     </div>
                     <div class="flex justify-between items-center">
                         <span class="font-medium text-lg ">Permissions for role <i class="font-semibold text-secondary"><u>Super Admin</u></i></span>
                         <div class="flex gap-2 items-center">
                             <label class="flex items-center space-x-2 ">
                                 <input type="checkbox"  class="hidden peer" disabled>
                                 <div class="w-[20px] h-[20px] border-2 border-gray-400 rounded-full peer-checked:rounded-[3px] flex items-center justify-center peer-checked:bg-secondary/60 peer-checked:border-secondary/90 transition">
                                 </div>
                                 <span class="text-gray-500  peer-checked:text-secondary font-medium ">Not Allowed</span>
                             </label>
                             <label class="flex items-center space-x-2 ">
                                 <input type="checkbox"  class="hidden peer" checked disabled>
                                 <div class="w-[20px] h-[20px] border-2 border-gray-400 rounded-full peer-checked:rounded-[3px] flex items-center justify-center peer-checked:bg-secondary/60 peer-checked:border-secondary/90 transition">
                                 </div>
                                 <span class="text-gray-300  peer-checked:text-secondary font-medium ">Allowed</span>
                             </label>
                         </div>

                     </div>
                     <div class="w-full flex flex-wrap gap-4 mt-12">
                         @php
                             $permissions = [
                                 [
                                        'name'=>'Create Users',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'Edit Users',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Delete Users',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'View Users',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Create Roles',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'Edit Roles',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Delete Roles',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'View Roles',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Create Permissions',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'Edit Permissions',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Delete Permissions',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'View Permissions',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Create Agency',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'Edit Agency',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Delete Agency',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'View Agency',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Create Service',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'Edit Service',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Delete Service',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'View Service',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Create Invoice',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'Edit Invoice',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Delete Invoice',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'View Invoice',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Create Payment',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'Edit Payment',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Delete Payment',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'View Payment',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Create Fund',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'Edit Fund',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Delete Fund',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'View Fund',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Create Report',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'Edit Report',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Delete Report',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'View Report',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Create Dashboard',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'Edit Dashboard',
                                        'status'=>0
                                    ],
                                    [
                                        'name'=>'Delete Dashboard',
                                        'status'=>1
                                    ],
                                    [
                                        'name'=>'View Dashboard',
                                        'status'=>0
                                        ]
]
                         @endphp

                         @forelse($permissions as $permission)
                             <label class="flex items center space-x-2 cursor-pointer" style="justify-content: space-evenly" >
                                 <input type="checkbox" value="1" class="hidden peer" {{$permission['status']===1?'checked':''}} >
                                 <div class="w-[20px] h-[20px] border-2 border-gray-400 rounded-full peer-checked:rounded-[3px] flex items-center justify-center peer-checked:bg-secondary/60 peer-checked:border-secondary/90 transition">
                                 </div>
                                 <span class="text-gray-400  peer-checked:text-secondary font-medium ">{{$permission['name']}}</span>
                                </label>
                            @empty
                                <div class="w-full text-center text-gray-500 font-medium">No Permission Found</div>
                            @endforelse





                     </div>
                 </div>
           </div>
{{--        === model code ends ===--}}
    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Roles List </span>
                <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Role</button>
            </div>
{{--        === heading section code ends here===--}}



{{--        === this is code for form section ===--}}
             <div id="formDiv" class="w-full border-b-[2px] border-b-ternary/10 shadow-lg shadow-ternary/20 hidden">
                <form action="{{route('superadmin_rolestore')}}" method="POST" enctype="multipart/form-data">
                @csrf
                             <div class="flex justify-end px-4 py-2">
                                 <div class="xl:w-[400px] lg:w-[400px] md:w-[300px] w-full  relative group flex flex-col gap-1">
                                     <label for="name" class="font-semibold text-ternary/90 text-sm">Role Name</label>
                                     <div class="w-full relative">
                                         <input type="text" name="name" id="name" placeholder="Role name....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000">
                                         <i class="fa fa-user absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                     </div>
                                 </div>
                             </div>
                             <div class="w-full flex justify-end px-4 py-4 gap-2">
                                  <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button>
                                  <button type="submit" class="text-sm bg-success/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Create Role</button>
                             </div>
                         </form>
             </div>
{{--        === form section code ends here===--}}


{{--        === this is code for table section ===--}}
            <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex justify-between gap-2 items-center">
                     <div class="flex gap-2">
                         <button title="Export to excel" class="bg-success/20 text-success h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white  cursor-pointer transition ease-in duration-2000">
                             <i class="fa fa-file-excel"></i>
                         </button>
                         <button title="Export to pdf" class="bg-danger/20 text-danger h-8 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white  cursor-pointer transition ease-in duration-2000">
                               <i class="fa fa-file-pdf"></i>
                         </button>
                     </div>
                    <div class="flex items-center gap-2">
                           <input type="text" placeholder="Agency name....." class="w-[200px] px-2 py-0.5 border-[1px] text-ternary border-success/80 placeholder-success rounded-l-[3px] focus:outline-none focus:ring-0 focus:border-success transition ease-in duration-2000" >
                           <button class="bg-success/60 px-2 py-0.5 rounded-r-[3px] text-ternary font-bold border-[1px] border-success/80 hover:bg-success hover:text-white transition ease-in duration-2000">
                                <i class="fa fa-search mr-1"></i> Search
                           </button>
                    </div>
                </div>
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                    <tr>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Role Name</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Created At</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Permissions</td>
                        <td class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</td>
                    </tr>


                    @forelse($roles as $role)
                        <tr class="{{$loop->iteration%2===0?'bg-gray-100/40':''}} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000" >
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$loop->iteration}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-bold text-sm">{{$role['name']}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">{{$role['created_at']}}</td>
                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex justify-between gap-2">
                                {{$role->permissions->count()}}
                                        <div onclick="document.getElementById('viewServiceModel').classList.toggle('hidden')" class=" bg-success/10 text-success h-6 w-6 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-lock-open"></i>
                                        </div>
                                </div>
                            </td>

                            <td class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">
                                <div class="flex gap-2 items-center">
                                    <a href="" title="Remind for funds">
                                        <div class=" bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-bell"></i>
                                        </div>
                                    </a>
                                    <a href="" title="View Invoices">
                                        <div class=" bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-file"></i>
                                        </div>
                                    </a>
                                    <a href="" title="View Dashboard">
                                        <div class=" bg-danger/10 text-danger h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-danger hover:text-white transition ease-in duration-2000">
                                            <i class="fa fa-computer"></i>
                                        </div>
                                    </a>


                                </div>
                            </td>
                        </tr>


                    @empty
                        <tr>
                            <td colspan="8" class="border-[2px] border-secondary/40  px-4 py-1 text-ternary/80 font-medium text-sm">No Record Found</td>
                        </tr>
                    @endforelse


                </table>
            </div>
{{--        === table section code ends here===--}}
        </div>
</x-front.layout>
