<!-- Do you have a child? -->
<form class="ajax-form" method="post">
    <div class="mb-4">
        <label class="font-semibold text-sm text-ternary/90">Are/have you worked with Armed forces/ Police/ Para Military forces ?</label>
        <div class="flex gap-4 mt-1">
            <label>
                <input type="radio" name="has_aermendpermission" value="yes"
                  > Yes
            </label>
            <label>
                <input type="radio" name="has_aermendpermission" value="no"
                   > No
            </label>
        </div>
    </div>



    <!-- Child Info Section -->
    <div id="armInfoSection" class="mb-4 hidden">
                
            <div class="w-full">
                <label for="spouse_name" class="font-semibold text-ternary/90 text-sm">Organization</label>
                <input type="text" name="spouse_name" id="spouse_name"
                    value="{{ old('spouse_name', $spouse->name ?? '') }}"
                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
            </div>

            <div class="w-full">
                <label for="spouse_nationality" class="font-semibold text-ternary/90 text-sm">Designation</label>
                <input type="text" name="spouse_nationality" id="spouse_nationality"
                    value="{{ old('spouse_nationality', $spouse->nationality ?? '') }}"
                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
            </div>

            <div class="w-full">
                <label for="spouse_birth_place" class="font-semibold text-ternary/90 text-sm"> Place of Posting</label>
                <input type="text" name="spouse_birth_place" id="spouse_birth_place"
                    value="{{ old('spouse_birth_place', $spouse->birth_place ?? '') }}"
                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
            </div>

            <div class="w-full">
                <label for="spouse_previous_nationality" class="font-semibold text-ternary/90 text-sm">Rank</label>
                <input type="text" name="spouse_previous_nationality" id="spouse_previous_nationality"
                    value="{{ old('spouse_previous_nationality', $spouse->previous_nationality ?? '') }}"
                    class="w-full pl-2 pr-8 py-1 rounded-[3px] rounded-tr-[8px] border border-secondary/40 focus:outline-none placeholder-ternary/70 transition">
            </div>
    </div>

    <div class="w-full flex justify-end pb-4 gap-2 xl:col-span-4 lg:col-span-3 md:col-span-2 col-span-1">
        <button type="submit" data-current="4" data-previewtab="3" class="backbutton text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
            Back <i class="fa fa-arrow-right ml-1"></i>
        </button>
        <button type="submit" class="text-sm bg-primary/30 px-4 py-1 rounded-[3px] rounded-tr-[8px] font-semibold border-[2px] border-primary/90 text-ternary hover:text-white hover:bg-primary hover:border-ternary/30 transition ease-in duration-200">
            Next: Contact Details <i class="fa fa-arrow-right ml-1"></i>
        </button>
    </div>
</form>