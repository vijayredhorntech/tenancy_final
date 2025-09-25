@props([
    'familyMembers' => collect(),
    'viewRouteName' => null,
])

@php
    $members = collect($familyMembers);
@endphp

<div class="w-full">
    <table class="w-full border-[2px] border-secondary/40 border-collapse mt-4">
        <thead>
            <tr>
                <th class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md text-left">Sr. No.</th>
                <th class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md text-left">Name</th>
                <th class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md text-left">Relationship</th>
                <th class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md text-left">Nationality</th>
                <th class="border-[1px] border-secondary/50 bg-gray-100/90 px-4 py-1.5 text-ternary/80 font-bold text-md text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $index => $member)
                @php
                    $fullName = trim(($member->first_name ?? '') . ' ' . ($member->last_name ?? ''));
                    $relationship = $member->relationship ?? null;
                    $nationality = $member->nationality ?? null;
                    $viewId = isset($member->id) ? 'family_' . $member->id : null;
                @endphp
                <tr class="hover:bg-secondary/10 transition">
                    <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">{{ $index + 1 }}</td>
                    <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary font-semibold text-sm">
                        {{ $fullName !== '' ? $fullName : 'N/A' }}
                    </td>
                    <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm capitalize">
                        {{ $relationship ?: 'N/A' }}
                    </td>
                    <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">
                        {{ $nationality ?: 'N/A' }}
                    </td>
                    <td class="border-[1px] border-secondary/50 px-4 py-1 text-ternary/80 font-medium text-sm">
                        @if ($viewRouteName && $viewId)
                            <a href="{{ route($viewRouteName, $viewId) }}"
                               class="inline-flex items-center gap-2 text-primary hover:text-primary/80 font-semibold text-sm">
                                <i class="fa fa-eye"></i>
                                View
                            </a>
                        @else
                            <span class="text-ternary/50">—</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border-[1px] border-secondary/50 px-4 py-4 text-center text-ternary/60 text-sm">
                        No family members found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
