<x-front.layout>
    @section('title')Agency @endsection

    <div class="w-full border-[1px] border-t-[4px] border-ternary/20 border-t-primary bg-white flex gap-2 flex-col shadow-lg shadow-gray-300">

        {{-- Heading --}}
        <div class="bg-primary/10 px-4 py-2 border-b-[2px] border-b-primary/20 flex justify-between">
            <span class="font-semibold text-ternary text-xl">Agency Request List</span>
        </div>

        {{-- Table --}}
        <div class="w-full overflow-x-auto p-4">
            <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
                <tr>
                    <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Sr. No.</th>
                    <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Agency Name</th>
                    <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Created At</th>
                    <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Services</th>
                    <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Status</th>
                    {{-- <th class="border-[2px] border-secondary/40 bg-gray-100 px-4 py-1.5 text-ternary/80 font-bold text-md">Action</th> --}}
                </tr>

                @forelse($agencies as $agency)
                    <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100/40' : '' }} hover:bg-secondary/10 cursor-pointer transition ease-in duration-2000">
                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $loop->iteration + ($agencies->currentPage()-1) * $agencies->perPage() }}</td>
                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-bold text-sm">{{ $agency->agency_name }}</td>
                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $agency->created_at->format('d-m-Y') }}</td>
                     <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                            <div class="flex gap-2 items-center">
                                @if(!empty($agency->services))
                                    {{ implode(', ', $agency->services) }}
                                @else
                                    No Services
                                @endif
                                <button type="button" title="View Services" onclick="document.getElementById('viewServiceModel').classList.toggle('hidden')">
                                    {{-- <div class="bg-primary/10 text-primary h-6 w-6 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                        <i class="fa fa-eye"></i>
                                    </div> --}}
                                </button>
                            </div>
                        </td>
                        <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                            <span class="bg-{{ $agency->approved ? 'success' : 'danger' }}/10 text-{{ $agency->approved ? 'success' : 'danger' }} px-2 py-1 rounded-[3px] font-bold">
                                {{ $agency->approved ? 'Approved' : 'Pending' }}
                            </span>
                        </td>
                        {{-- <td class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm">
                            <div class="flex gap-2 items-center">
                                <a href="#" title="View Details">
                                    <div class="bg-primary/10 text-primary h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-primary hover:text-white transition ease-in duration-2000">
                                        <i class="fa fa-eye"></i>
                                    </div>
                                </a>
                                <a href="#" title="Edit">
                                    <div class="bg-success/10 text-success h-6 w-8 flex justify-center items-center rounded-[3px] hover:bg-success hover:text-white transition ease-in duration-2000">
                                        <i class="fa fa-edit"></i>
                                    </div>
                                </a>
                            </div>
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border-[2px] border-secondary/40 px-4 py-1 text-ternary/80 font-medium text-sm text-center">No Record Found</td>
                    </tr>
                @endforelse
            </table>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $agencies->links() }}
            </div>
        </div>
    </div>
</x-front.layout>
