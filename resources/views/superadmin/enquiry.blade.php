<x-front.layout>
    @section('title')Enquiry @endsection



    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

{{--        === this is code for heading section ===--}}
            <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
                <span class="font-semibold text-ternary text-xl">Contact List </span>
               </div>


            <div class="w-full overflow-x-auto p-4">
                <div class="w-full flex justify-between gap-2 items-center">
                     <div class="flex gap-2">
                     
                     </div>
                    <div class="flex items-center gap-2">
                  
                    </div>
                </div>
                <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                   <tr>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</th>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Name</th>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Email</th>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Subject</th>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Message</th>
                        <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Created At</th>
                        {{-- <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th> --}}
                    </tr>

             



                   @forelse($contacts as $contact)

           
                        <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000">
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                {{ $contacts->firstItem() + $loop->index }}
                            </td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">
                                {{ $contact->name }}
                            </td>
                              <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                {{ $contact->email }}
                            </td>
                           
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                {{ $contact->subject }}
                            </td>
                            <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                {{ Str::limit($contact->message, 50) }}
                            </td>
                             <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                {{ $contact->created_at->format('d-m-Y') }}
                            </td>
                            {{-- <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                                <a href="{{ route('superadmin.contact.view', $contact->id) }}" class="text-primary hover:underline">View</a>
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm text-center">
                                No Record Found
                            </td>
                        </tr>
                    @endforelse



                </table>
                <div class="mt-4">
                {{ $contacts->links('pagination::tailwind') }}
            </div>
            </div>
{{--        === table section code ends here===--}}
        </div>
</x-front.layout>
