<div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Edit Visa Application </span>
                <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-secondary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-secondary/90 text-ternary hover:text-white hover:bg-secondary hover:border-ternary/30 transition ease-in duration-2000">Create New Agency</button> -->
            </div>
{{--        === heading section code ends here===--}}


{{--        === this is code for form section ===--}}
          
      
           <form action="{{route('updatevisa.application') }}" method="POST" enctype="multipart/form-data">     
                    @csrf
                    @if(!isset($status))
                        <input type="hidden" name="type" value="superadmin">
                    @endif
                     <div class="w-full grid xl:grid-cols-4 gap-2 px-4 py-6">

                         {{--               === text type input field ===--}}
                         <div class="w-full relative group flex flex-col gap-1">
                            <input type="hidden" name="applciationid" value="{{$clientData->id}}">

                            {{-- === Select Input for Application Status === --}}
                           <div class="w-full relative group flex flex-col gap-1">
                                <label for="application_status" class="font-semibold text-ternary/90 text-sm">Application Status</label>
                                <div class="w-full relative">
                                    <select name="application_status" id="application_status" 
                                        @if(isset($status)) disabled @endif
                                        class="w-full px-2 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 transition ease-in duration-200"
                                        onchange="toggleRejectionReason(this.value)">
                                        <option value="Pending" {{ old('application_status', $clientData->applicationworkin_status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Under Process" {{ old('application_status', $clientData->applicationworkin_status) == 'Under Process' ? 'selected' : '' }}>Under Process</option>
                                        <option value="Complete" {{ old('application_status', $clientData->applicationworkin_status) == 'Complete' ? 'selected' : '' }}>Complete</option>
                                        <option value="Rejected" {{ old('application_status', $clientData->applicationworkin_status) == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    <i class="fa fa-angle-down absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80 cursor-pointer"></i>
                                </div>
                            </div>

                            {{-- Hidden input for rejection reason --}}
                            <div class="w-full relative group flex flex-col gap-1" id="rejection_reason_container" style="display: none;">
                                <label for="rejection_reason" class="font-semibold text-ternary/90 text-sm">Reason for Rejection:</label>
                                <div class="w-full relative">
                                    <input type="text" name="rejection_reason" id="rejection_reason"
                                        value="{{ old('rejection_reason', $clientData->rejection_reason ?? '') }}"
                                        placeholder="Enter rejection reason..."
                                        class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-200">
                                    <!-- Optional icon:
                                    <i class="fa fa-exclamation-circle absolute right-3 top-[50%] translate-y-[-50%] text-sm text-secondary/80"></i>
                                    -->
                                </div>
                            </div>


                         {{--               === textarea input field ===--}}
                         <!-- <div class="w-full relative group flex flex-col gap-1">
                             <label for="name" class="font-semibold text-ternary/90 text-sm">Description</label>
                             <div class="w-full relative">
                                 <textarea   name="description" id="description" rows="3" placeholder="Description....." class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border-[1px] border-b-[2px] border-r-[2px] border-secondary/40 focus:outline-none focus:ring-0 focus:border-secondary/70 placeholder-ternary/70 transition ease-in duration-2000"></textarea>
                                 <i class="fa-regular fa-comment-dots absolute right-3 top-3 text-sm text-secondary/80"></i>
                             </div>
                         </div> -->


                       

              
                     </div>
                     <div class="w-full flex flex-col  px-4 pb-6 gap-2">
                          <label for="rejection_reason" class="font-semibold text-ternary/90 text-sm">&nbsp</label>
                     <!-- <button type="button" onclick="document.getElementById('formDiv').classList.toggle('hidden')" class="text-sm bg-ternary/10 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-ternary/10 hover:bg-ternary/30 hover:border-ternary/30 transition ease-in duration-2000">Cancel</button> -->
                          <button type="submit" class="text-sm bg-success/30 px-4 py-1 w-max  h-max rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-success/90 text-ternary hover:text-white  hover:bg-success hover:border-ternary/30 transition ease-in duration-2000">Update Application</button>
                     </div>
                 </form>
             </div>

                </div>
<script>
    function toggleRejectionReason(value) {
        const reasonContainer = document.getElementById('rejection_reason_container');
        if (value === 'Rejected') {
            reasonContainer.style.display = 'block';
        } else {
            reasonContainer.style.display = 'none';
        }
    }

    // Run on page load (to show field if already selected as 'Rejected')
    document.addEventListener('DOMContentLoaded', function () {
        toggleRejectionReason(document.getElementById('application_status').value);
    });
</script>