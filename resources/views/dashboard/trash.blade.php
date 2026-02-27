@extends('layouts.dashboard')
@section('title', 'Trash Items')

@section('content')
<section class="py-20 max-w-6xl mx-auto px-6 space-y-16">

    <header class="space-y-6 max-w-6xl">
        <p class="text-xs uppercase tracking-widest text-muted">
            dashboard / trash
        </p>

        <h1 class="text-[clamp(2.5rem,6vw,4rem)] font-semibold leading-tight">
            Trash Bin
            <span class="block text-muted font-normal text-lg mt-2">
                Archived & soft deleted items
            </span>
        </h1>

        <div class="flex items-center justify-between w-full gap-4">
            <div class="relative w-full md:w-1/3">
                <input
                    type="text"
                    id="search-input"
                    placeholder="Search Trash..."
                    value="{{ request('search') }}"
                    class="w-full border border-border px-4 py-2 pl-10 text-sm placeholder:text-muted bg-surface focus:outline-none focus:ring-1 focus:ring-primary transition-colors"
                />
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-muted">
                    <i class="fas fa-search"></i>
                </span>
            </div>

            <div class="flex items-center gap-2 ml-auto">
                <select
                    id="sort-select"
                    class="border border-border px-4 py-2 text-sm bg-surface focus:outline-none focus:ring-1 focus:ring-primary transition-colors"
                >
                    <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>Newest Deleted</option>
                    <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>Oldest Deleted</option>
                </select>

                <button
                    id="toggleSelectMode"
                    type="button"
                    class="px-4 py-2 border border-border text-sm hover:border-primary transition focus:outline-none focus:ring-1 focus:ring-primary"
                >
                    Select Multiple
                </button>
            </div>
        </div>
    </header>

    <!-- Summary Statistics -->
    <div class="grid md:grid-cols-4 gap-6">
        <div class="border border-border bg-surface p-6">
            <p class="text-xs uppercase tracking-widest text-muted mb-2">
                Total Soft Deleted
            </p>
            <h3 class="text-3xl font-semibold">
                {{ $totalTrashed }}
            </h3>
        </div>

        <div class="border border-border bg-surface p-6">
            <p class="text-xs uppercase tracking-widest text-muted mb-2">
                Deleted Projects
            </p>
            <h3 class="text-3xl font-semibold text-sky-400">
                {{ $totalTrashedProjects }}
            </h3>
        </div>

        <div class="border border-border bg-surface p-6">
            <p class="text-xs uppercase tracking-widest text-muted mb-2">
                Deleted Skills
            </p>
            <h3 class="text-3xl font-semibold text-red-400">
                {{ $totalTrashedSkills }}
            </h3>
        </div>

        <div class="border border-border bg-surface p-6">
            <p class="text-xs uppercase tracking-widest text-muted mb-2">
                Expiring Soon (5 Days)
            </p>
            <h3 class="text-3xl font-semibold text-yellow-400">
                {{ $expiringSoon ?? 0 }}
            </h3>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-500/10 border border-green-500/20 text-green-500 flex items-center gap-3 mb-6">
            <i class="fa-solid fa-circle-check"></i>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Toolbar & Grid -->
    <div class="bg-surface border border-border p-6 space-y-6">
        
        <!-- Filter Tabs -->
        <div class="flex flex-wrap gap-2 border-b border-border pb-4">
            <button type="button" class="filter-btn px-4 py-2 border border-primary bg-primary/10 text-primary text-sm transition focus:outline-none" data-tab="all">
                All Trash
            </button>
            <button type="button" class="filter-btn px-4 py-2 border border-border text-sm hover:border-primary transition focus:outline-none" data-tab="projects">
                Projects Only
            </button>
            <button type="button" class="filter-btn px-4 py-2 border border-border text-sm hover:border-primary transition focus:outline-none" data-tab="skills">
                Skills Only
            </button>
        </div>

        <!-- Dynamic Content Container -->
        <div id="trash-grid" class="space-y-16 min-h-[400px]">
            @include('dashboard.trash.partials.content')
        </div>

    </div>

    <!-- Bulk Action Bar -->
    <div id="bulkBar"
        class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50
                bg-surface border border-border px-6 py-4
                flex gap-4 shadow-lg
                opacity-0 pointer-events-none translate-y-4
                transition-all duration-200">

        <span id="selectedCount"
            class="text-xs uppercase tracking-widest text-muted flex items-center">
            0 Selected
        </span>

        <button type="button"
            onclick="bulkAction('restore')"
            class="px-4 py-2 border border-border text-sm hover:border-primary hover:text-primary transition-colors">
            Restore Selected
        </button>

        <button type="button"
            onclick="bulkAction('delete')"
            class="px-4 py-2 border border-red-500 text-red-500 text-sm hover:bg-red-500/10 transition-colors">
            Delete Permanently
        </button>
    </div>

    <form id="bulkForm" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="action_type" id="bulkActionType">
    </form>
    
    <form id="singleDeleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</section>

<!-- Confirm Modal (Uses layout's built-in global confirm modal) -->
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.filter-btn');
    const searchInput = document.getElementById('search-input');
    const sortSelect = document.getElementById('sort-select');
    const grid = document.getElementById('trash-grid');
    
    const toggleBtn = document.getElementById('toggleSelectMode');
    const bulkBar = document.getElementById('bulkBar');
    const selectedCountText = document.getElementById('selectedCount');

    let currentTab = 'all';
    let currentSearch = '{{ request("search", "") }}';
    let currentSort = '{{ $sort }}';
    let selectMode = false;
    let debounceTimer;

    function fetchTrash(urlOverride = null) {
        grid.style.opacity = '0.5';
        grid.style.pointerEvents = 'none';

        let targetUrl = urlOverride;
        
        if(!targetUrl) {
            const params = new URLSearchParams({
                tab: currentTab,
                search: currentSearch,
                sort: currentSort,
                multiple_select: selectMode ? '1' : '0'
            });
            targetUrl = `{{ route('dashboard.trash') }}?${params.toString()}`;
        }

        fetch(targetUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            grid.innerHTML = html;
            grid.style.opacity = '1';
            grid.style.pointerEvents = 'auto';
            attachGridEvents();
            updateBulkBar();
        })
        .catch(error => {
            console.error('Error fetching trash:', error);
            grid.style.opacity = '1';
            grid.style.pointerEvents = 'auto';
        });
    }

    // Tab Clicks
    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            tabs.forEach(t => {
                t.classList.remove('border-primary', 'bg-primary/10', 'text-primary');
                t.classList.add('border-border');
            });
            e.target.classList.remove('border-border');
            e.target.classList.add('border-primary', 'bg-primary/10', 'text-primary');

            currentTab = e.target.dataset.tab;
            fetchTrash();
        });
    });

    // Search Input (Debounced)
    searchInput.addEventListener('input', (e) => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            currentSearch = e.target.value;
            fetchTrash();
        }, 300);
    });

    // Sort Dropdown
    sortSelect.addEventListener('change', (e) => {
        currentSort = e.target.value;
        fetchTrash();
    });

    // --- Select Multiple Logic ---
    toggleBtn.addEventListener('click', () => {
        selectMode = !selectMode;
        
        if (selectMode) {
            toggleBtn.innerText = 'Cancel Selection';
            toggleBtn.classList.add('border-red-500', 'text-red-400');
        } else {
            toggleBtn.innerText = 'Select Multiple';
            toggleBtn.classList.remove('border-red-500', 'text-red-400');
            if (bulkBar) bulkBar.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
        }
        
        fetchTrash();
    });

    function updateBulkBar() {
        if (!selectMode || !bulkBar) return;

        const selectedProjects = document.querySelectorAll('.bulk-checkbox:checked').length;
        const selectedSkills = document.querySelectorAll('.bulk-skill-checkbox:checked').length;
        const totalSelected = selectedProjects + selectedSkills;

        if (totalSelected > 0) {
            bulkBar.classList.remove('opacity-0','pointer-events-none','translate-y-4');
            selectedCountText.innerText = totalSelected + ' Selected';
        } else {
            bulkBar.classList.add('opacity-0','pointer-events-none','translate-y-4');
        }
    }

    window.bulkAction = function(action) {
        const form = document.getElementById('bulkForm');
        form.innerHTML = '@csrf'; // reset
        
        const selectedProjects = document.querySelectorAll('.bulk-checkbox:checked');
        const selectedSkills = document.querySelectorAll('.bulk-skill-checkbox:checked');

        if(selectedProjects.length === 0 && selectedSkills.length === 0) return;

        // Since we can't easily cross-post arrays to two controllers in one HTTP request natively without a unified bulk endpoint,
        // we'll append the inputs and post to a unified bulk endpoint, OR intercept it.
        // For simplicity, we assume they select ONLY projects OR ONLY skills. If mixed, we submit to JS fetch.

        if(action === 'delete') {
            if(!confirm('Are you absolutely sure you want to permanently delete the selected items? This cannot be undone.')) return;
        }

        // We will execute fetch promises for both arrays if they exist to keep things clean instead of unified routing hacks
        let promises = [];

        if(selectedProjects.length > 0) {
            let formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            if(action === 'delete') {
                formData.append('_method', 'POST'); 
            }
            selectedProjects.forEach(cb => formData.append('projects[]', cb.value));
            
            let url = action === 'restore' ? '{{ route("dashboard.bulkRestore") }}' : '{{ route("dashboard.bulkForceDelete") }}';
            
            promises.push(fetch(url, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }));
        }

        if(selectedSkills.length > 0) {
            let formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            selectedSkills.forEach(cb => formData.append('skills[]', cb.value));
            
            let url = action === 'restore' ? '{{ route("dashboard.skills.bulkRestore") }}' : '{{ route("dashboard.skills.bulkForceDelete") }}';
            
            promises.push(fetch(url, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }));
        }

        Promise.all(promises).then(() => {
            selectMode = false;
            toggleBtn.innerText = 'Select Multiple';
            toggleBtn.classList.remove('border-red-500', 'text-red-400');
            bulkBar.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
            fetchTrash();
            
            // Show global modal natively over AJAX
            const msg = action === 'restore' ? 'Items restored successfully!' : 'Items permanently deleted!';
            alert(msg); // fallback or inject global modal logic if desired
        }).catch(err => alert("Error processing bulk action."));
    };

    function attachGridEvents() {
        const checkboxes = document.querySelectorAll('.bulk-checkbox, .bulk-skill-checkbox');
        const projectCards = document.querySelectorAll('.project-card');
        const skillCards = document.querySelectorAll('.skill-card');
        
        // Month group buttons for projects
        const monthButtons = document.querySelectorAll('.month-select');
        // Select all skills button
        const skillsButtons = document.querySelectorAll('.skills-select');
        
        const normalActions = document.querySelectorAll('.normal-actions, .normal-skill-actions');

        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateBulkBar);
        });

        monthButtons.forEach(button => {
            button.addEventListener('click', () => {
                const month = button.dataset.month;
                const monthCheckboxes = document.querySelectorAll(`[data-month="${month}"] .bulk-checkbox`);
                const allChecked = [...monthCheckboxes].every(cb => cb.checked);

                monthCheckboxes.forEach(cb => {
                    cb.checked = !allChecked;
                    const card = cb.closest('.project-card');
                    card.classList.toggle('border-primary', !allChecked);
                    card.classList.toggle('bg-primary/5', !allChecked);
                });

                button.innerText = allChecked ? 'Select All' : 'Unselect All';
                updateBulkBar();
            });
        });

        skillsButtons.forEach(button => {
             button.addEventListener('click', () => {
                const skillCheckboxes = document.querySelectorAll('.bulk-skill-checkbox');
                const allChecked = [...skillCheckboxes].every(cb => cb.checked);

                skillCheckboxes.forEach(cb => {
                    cb.checked = !allChecked;
                    const card = cb.closest('.skill-card');
                    card.classList.toggle('border-primary', !allChecked);
                    card.classList.toggle('bg-primary/5', !allChecked);
                });

                button.innerText = allChecked ? 'Select All Skills' : 'Unselect All Skills';
                updateBulkBar();
            });
        });

        // Click on Cards
        const handleCardClick = function(e) {
            if (!selectMode) return;
            if (e.target.closest('form') || e.target.tagName === 'BUTTON' || e.target.closest('.delete-trash-btn')) return;

            const checkbox = this.querySelector('.bulk-checkbox, .bulk-skill-checkbox');
            if(checkbox) {
                checkbox.checked = !checkbox.checked;
                this.classList.toggle('border-primary', checkbox.checked);
                this.classList.toggle('bg-primary/5', checkbox.checked);
                updateBulkBar();
            }
        };

        projectCards.forEach(card => card.addEventListener('click', handleCardClick));
        skillCards.forEach(card => card.addEventListener('click', handleCardClick));

        // Delete Confirm Logic
        const deleteButtons = document.querySelectorAll('.delete-trash-btn');
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const url = this.dataset.deleteUrl;
                const confirmModal = document.getElementById('confirm-modal');
                const confirmYes = document.getElementById('confirm-yes');
                const confirmCancel = document.getElementById('confirm-cancel');
                const confirmMessage = document.getElementById('confirm-message');
                
                if (confirmModal && confirmYes && confirmCancel) {
                    confirmMessage.textContent = 'Are you sure you want to permanently delete this? Data cannot be recovered.';
                    
                    confirmModal.classList.remove('opacity-0', 'pointer-events-none');
                    
                    const handleYes = () => {
                        const form = document.getElementById('singleDeleteForm');
                        form.action = url;
                        form.submit();
                        cleanup();
                    };

                    const handleCancel = () => {
                        cleanup();
                    };

                    const cleanup = () => {
                        confirmModal.classList.add('opacity-0', 'pointer-events-none');
                        confirmYes.removeEventListener('click', handleYes);
                        confirmCancel.removeEventListener('click', handleCancel);
                    };

                    confirmYes.addEventListener('click', handleYes);
                    confirmCancel.addEventListener('click', handleCancel);
                }
            });
        });

        // Pagination Ajax Interception
        const paginationLinks = document.querySelectorAll('.pagination-wrapper a, .pagination-wrapper-skills a');
        paginationLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const url = e.target.href;
                fetchTrash(url);
                // scroll to top of grid
                grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        // Apply visual states based on SelectMode
        if (selectMode) {
            monthButtons.forEach(btn => btn.classList.remove('hidden'));
            skillsButtons.forEach(btn => btn.classList.remove('hidden'));
            checkboxes.forEach(cb => cb.classList.remove('opacity-0', 'pointer-events-none'));
            normalActions.forEach(el => el.classList.add('opacity-0', 'pointer-events-none')); // hide forms and buttons
        } else {
            monthButtons.forEach(btn => btn.classList.add('hidden'));
            skillsButtons.forEach(btn => btn.classList.add('hidden'));
            checkboxes.forEach(cb => {
                cb.checked = false;
                cb.classList.add('opacity-0', 'pointer-events-none');
            });
            projectCards.forEach(card => card.classList.remove('border-primary', 'bg-primary/5'));
            skillCards.forEach(card => card.classList.remove('border-primary', 'bg-primary/5'));
            normalActions.forEach(el => el.classList.remove('opacity-0', 'pointer-events-none'));
        }
    }

    // Initial Event Bind
    attachGridEvents();
});
</script>
@endpush
