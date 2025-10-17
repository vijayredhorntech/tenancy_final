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
                        <div class="relative inline-block text-left">
                            <button type="button" onclick="toggleDropdown(event, {{ $member->id }})" class="inline-flex items-center gap-2 px-3 py-1 bg-primary text-white rounded hover:bg-primary/80 font-semibold text-sm">
                                Actions
                            </button>
                            <div id="dropdown-{{ $member->id }}" class="hidden fixed w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-[9999]">
                                <div class="py-1" role="menu">
                                    @if ($viewRouteName && $viewId)
                                        <a href="{{ route($viewRouteName, $viewId) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100 transition-colors duration-150" role="menuitem">
                                            View
                                        </a>
                                    @endif
                                    <button onclick="deleteFamilyMember({{ $member->id }}, '{{ $fullName }}')" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150" role="menuitem">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
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

<script>
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('[id^="dropdown-"]');
        dropdowns.forEach(dropdown => {
            if (!dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
                // Remove active state from all buttons
                document.querySelectorAll('.bg-primary/90').forEach(btn => {
                    if (btn.tagName === 'BUTTON') {
                        btn.classList.remove('bg-primary/90');
                    }
                });
            }
        });
    });
    
    // Toggle dropdown menu
    function toggleDropdown(event, memberId) {
        event.stopPropagation();
        const dropdown = document.getElementById(`dropdown-${memberId}`);
        const button = event.currentTarget;
        
        // Close all other dropdowns
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
            if (el.id !== `dropdown-${memberId}`) {
                el.classList.add('hidden');
            }
        });
        
        // Toggle current dropdown
        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
            
            // Position the dropdown at the button's location
            const buttonRect = button.getBoundingClientRect();
            
            // Calculate if dropdown would go off bottom of screen
            const dropdownHeight = 80; // Approximate height
            const spaceBelow = window.innerHeight - buttonRect.bottom;
            
            if (spaceBelow < dropdownHeight) {
                // Position above button
                dropdown.style.top = `${buttonRect.top + window.scrollY - dropdownHeight}px`;
            } else {
                // Position below button
                dropdown.style.top = `${buttonRect.bottom + window.scrollY}px`;
            }
            
            // Horizontal positioning
            dropdown.style.left = `${buttonRect.left + window.scrollX}px`;
            
            // Add highlight effect to button to show it's active
            button.classList.add('bg-primary/90');
        } else {
            dropdown.classList.add('hidden');
            button.classList.remove('bg-primary/90');
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('[onclick^="toggleDropdown"]')) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                el.classList.add('hidden');
            });
        }
    });

    // Delete family member
    function deleteFamilyMember(memberId, memberName) {
        if (confirm(`Are you sure you want to delete ${memberName}? This action cannot be undone.`)) {
            // Send AJAX request to delete
            fetch(`/agencies/family-member/${memberId}/delete`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Family member deleted successfully!');
                    location.reload(); // Reload to update the list
                } else {
                    alert('Error: ' + (data.message || 'Failed to delete family member'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the family member');
            });
        }
    }
</script>
