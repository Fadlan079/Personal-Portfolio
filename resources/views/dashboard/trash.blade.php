@extends('layouts.dashboard')
@section('title', 'Trash')

@section('content')
    <div class="min-h-screen bg-background pt-12 pb-32 px-4 md:px-6 relative overflow-hidden">

        {{-- Global Faint Grid --}}
        <div class="absolute inset-0 pointer-events-none opacity-[0.02]"
            style="background-image: linear-gradient(var(--color-text) 1px, transparent 1px), linear-gradient(90deg, var(--color-text) 1px, transparent 1px); background-size: 64px 64px;">
        </div>

        <section class="max-w-7xl mx-auto relative z-10 space-y-12">

            {{-- HEADER MODULE --}}
            <header class="relative space-y-6 border-b border-border/50 pb-8 mt-4 md:mt-8">
                <div
                    class="absolute top-0 right-0 w-1/3 h-[1px] bg-gradient-to-r from-transparent to-primary/50 pointer-events-none">
                </div>

                <div class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-widest text-primary">
                    <i class="fa-solid fa-recycle"></i>
                    >> SYS_DIR / DASHBOARD / ARCHIVE_STORAGE
                </div>

                <div class="flex items-end gap-3 pt-2">
                    <h1
                        class="text-4xl md:text-5xl lg:text-6xl font-bold font-mono tracking-tighter uppercase text-text leading-none">
                        Data_Recycle_Bin
                    </h1>
                    <div
                        class="w-3 md:w-4 h-8 md:h-12 bg-primary animate-pulse mb-1 shadow-[0_0_10px_var(--color-primary)]">
                    </div>
                </div>

                <p class="text-sm font-mono text-muted tracking-wide max-w-2xl leading-relaxed">
                    <span class="text-primary">></span> Storage array for archived and soft-deleted node entities. Data
                    pending permanent eradication or restoration.
                </p>
            </header>

            {{-- SUCCESS LOG --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms x-init="setTimeout(() => show = false, 4000)"
                    class="border-l-2 border-green-500 bg-green-500/10 p-4 flex items-center gap-3">
                    <i class="fa-solid fa-check text-green-500"></i>
                    <p class="text-[10px] font-mono uppercase tracking-widest text-green-500">> {{ session('success') }}</p>
                </div>
            @endif

            {{-- METRICS DASHBOARD --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                {{-- Stat 1 --}}
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-primary/50 transition-colors">
                    <div class="absolute top-0 right-0 w-3 h-3 border-t border-r border-primary/50"></div>
                    <p class="text-[10px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-database text-primary"></i> Total_Archived
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-text">{{ $totalTrashed }}</h3>
                </div>

                {{-- Stat 2 --}}
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-sky-400/50 transition-colors">
                    <div class="absolute top-0 right-0 w-3 h-3 border-t border-r border-sky-400/50"></div>
                    <p class="text-[10px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-folder-open text-sky-400"></i> Projects_Node
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-sky-400">{{ $totalTrashedProjects }}</h3>
                </div>

                {{-- Stat 3 --}}
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-red-400/50 transition-colors">
                    <div class="absolute top-0 right-0 w-3 h-3 border-t border-r border-red-400/50"></div>
                    <p class="text-[10px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-code text-red-400"></i> Skills_Node
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-red-400">{{ $totalTrashedSkills }}</h3>
                </div>

                {{-- Stat 4 --}}
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-yellow-400/50 transition-colors overflow-hidden">
                    <div class="absolute top-0 right-0 w-3 h-3 border-t border-r border-yellow-400/50 z-10"></div>
                    <div
                        class="absolute inset-0 bg-[repeating-linear-gradient(45deg,transparent,transparent_4px,rgba(250,204,21,0.03)_4px,rgba(250,204,21,0.03)_8px)] pointer-events-none">
                    </div>
                    <p
                        class="text-[10px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2 relative z-10">
                        <i class="fa-solid fa-hourglass-half text-yellow-400 animate-pulse"></i> Expiring_5D
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-yellow-400 relative z-10">{{ $expiringSoon ?? 0 }}</h3>
                </div>
            </div>

            {{-- CONTROL PANEL & GRID --}}
            <div class="relative border border-border/50 bg-surface/10 p-4 md:p-6 mt-8 space-y-6">

                {{-- Command Bar (Search & Sort) --}}
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4 border-b border-border/50 pb-6">

                    {{-- Terminal Search Input --}}
                    <div class="relative w-full md:w-1/2 group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 font-mono text-primary text-sm">></div>
                        <input type="text" id="search-input" placeholder="SEARCH_QUERY_" value="{{ request('search') }}"
                            class="w-full border border-border/70 bg-surface/30 px-4 py-3 pl-8 font-mono text-xs uppercase tracking-widest text-text placeholder:text-muted/50 focus:outline-none focus:border-primary focus:bg-primary/5 transition-colors" />
                        <div
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-1.5 h-3 bg-primary/30 group-focus-within:bg-primary group-focus-within:animate-pulse pointer-events-none">
                        </div>
                    </div>

                    {{-- Action Toggles --}}
                    <div class="flex flex-wrap sm:flex-nowrap items-center gap-3">
                        <div class="relative">
                            <select id="sort-select"
                                class="appearance-none border border-border/70 bg-surface/30 px-8 py-3 pr-12 font-mono text-xs uppercase tracking-widest text-muted hover:text-text focus:outline-none focus:border-primary transition-colors cursor-pointer">
                                <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>SORT: NEWEST</option>
                                <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>SORT: OLDEST</option>
                            </select>
                            <i
                                class="fa-solid fa-sort absolute right-4 top-1/2 -translate-y-1/2 text-muted pointer-events-none"></i>
                        </div>

                        <button id="toggleSelectMode" type="button"
                            class="px-6 py-3 border border-border/70 bg-surface/30 font-mono text-xs font-bold uppercase tracking-widest text-muted hover:border-primary hover:text-primary transition-colors focus:outline-none focus:border-primary">
                            [ SELECT_MULTI ]
                        </button>
                    </div>
                </div>

                {{-- Filter Tabs (Sangat bergantung pada class JS kamu, jadi base classnya dipertahankan) --}}
                <div class="flex flex-wrap gap-2 border-b border-border/30 pb-4">
                    <button type="button"
                        class="filter-btn px-5 py-2 border border-primary bg-primary/10 text-primary font-mono text-[10px] font-bold uppercase tracking-widest transition-colors focus:outline-none"
                        data-tab="all">
                        ALL_TRASH
                    </button>
                    <button type="button"
                        class="filter-btn px-5 py-2 border border-border font-mono text-[10px] font-bold uppercase tracking-widest text-muted hover:border-primary transition-colors focus:outline-none"
                        data-tab="projects">
                        PROJECTS
                    </button>
                    <button type="button"
                        class="filter-btn px-5 py-2 border border-border font-mono text-[10px] font-bold uppercase tracking-widest text-muted hover:border-primary transition-colors focus:outline-none"
                        data-tab="skills">
                        SKILLS
                    </button>
                </div>

                {{-- Dynamic Content Container --}}
                <div id="trash-grid" class="space-y-16 min-h-[400px] transition-opacity duration-300">
                    @include('dashboard.trash.partials.content')
                </div>

            </div>

            {{-- BULK ACTION BAR (Sticky HUD) --}}
            <div id="bulkBar"
                class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[90]
                   bg-[#0a0a0a]/90 backdrop-blur-md border border-primary/50 p-4 md:px-6 md:py-4
                   flex flex-col sm:flex-row items-center gap-4 shadow-[0_0_30px_rgba(var(--color-primary-rgb),0.15)]
                   opacity-0 pointer-events-none translate-y-4
                   transition-all duration-300 w-[90%] md:w-auto min-w-[320px]">

                {{-- Decorative HUD lines --}}
                <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-primary"></div>
                <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-primary"></div>

                <div
                    class="flex items-center gap-3 border-r border-border/50 pr-4 mr-2 w-full sm:w-auto justify-center sm:justify-start">
                    <i class="fa-solid fa-crosshairs text-primary animate-spin-slow"></i>
                    <span id="selectedCount" class="text-[10px] font-mono font-bold uppercase tracking-widest text-primary">
                        0 SELECTED
                    </span>
                </div>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button type="button" onclick="bulkAction('restore')"
                        class="flex-1 sm:flex-none px-4 py-2 border border-border text-[10px] font-mono font-bold uppercase tracking-widest text-muted hover:border-primary hover:text-primary transition-colors">
                        [ RESTORE ]
                    </button>

                    <button type="button" onclick="bulkAction('delete')"
                        class="flex-1 sm:flex-none px-4 py-2 border border-red-500/50 bg-red-500/10 text-[10px] font-mono font-bold uppercase tracking-widest text-red-500 hover:bg-red-500 hover:text-white transition-colors group">
                        <i class="fa-solid fa-skull mr-1 opacity-50 group-hover:opacity-100 group-hover:animate-ping"></i> [
                        PURGE ]
                    </button>
                </div>
            </div>

            {{-- Hidden Forms --}}
            <form id="bulkForm" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="action_type" id="bulkActionType">
            </form>

            <form id="singleDeleteForm" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>

        </section>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // JS Murni milikmu tetap dipertahankan, karena logikanya sudah sangat baik!
            const tabs = document.querySelectorAll('.filter-btn');
            const searchInput = document.getElementById('search-input');
            const sortSelect = document.getElementById('sort-select');
            const grid = document.getElementById('trash-grid');

            const toggleBtn = document.getElementById('toggleSelectMode');
            const bulkBar = document.getElementById('bulkBar');
            const selectedCountText = document.getElementById('selectedCount');

            let currentTab = 'all';
            let currentSearch = '{{ request('search', '') }}';
            let currentSort = '{{ $sort }}';
            let selectMode = false;
            let debounceTimer;

            function fetchTrash(urlOverride = null) {
                grid.style.opacity = '0.5';
                grid.style.pointerEvents = 'none';

                let targetUrl = urlOverride;

                if (!targetUrl) {
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
                        t.classList.remove('border-primary', 'bg-primary/10',
                            'text-primary');
                        t.classList.add('border-border', 'text-muted');
                    });
                    e.target.classList.remove('border-border', 'text-muted');
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
                    toggleBtn.innerText = '[ CANCEL_MULTI ]';
                    toggleBtn.classList.add('border-red-500', 'text-red-500');
                } else {
                    toggleBtn.innerText = '[ SELECT_MULTI ]';
                    toggleBtn.classList.remove('border-red-500', 'text-red-500');
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
                    bulkBar.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
                    selectedCountText.innerText = totalSelected + ' SELECTED';
                } else {
                    bulkBar.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
                }
            }

            window.bulkAction = function(action) {
                const form = document.getElementById('bulkForm');
                form.innerHTML = '@csrf'; // reset

                const selectedProjects = document.querySelectorAll('.bulk-checkbox:checked');
                const selectedSkills = document.querySelectorAll('.bulk-skill-checkbox:checked');

                if (selectedProjects.length === 0 && selectedSkills.length === 0) return;

                if (action === 'delete') {
                    if (!confirm(
                            'CRITICAL: Are you absolutely sure you want to permanently delete the selected items? This cannot be undone.'
                        )) return;
                }

                let promises = [];

                if (selectedProjects.length > 0) {
                    let formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    if (action === 'delete') {
                        formData.append('_method', 'POST');
                    }
                    selectedProjects.forEach(cb => formData.append('projects[]', cb.value));

                    let url = action === 'restore' ? '{{ route('dashboard.bulkRestore') }}' :
                        '{{ route('dashboard.bulkForceDelete') }}';

                    promises.push(fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }));
                }

                if (selectedSkills.length > 0) {
                    let formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    selectedSkills.forEach(cb => formData.append('skills[]', cb.value));

                    let url = action === 'restore' ? '{{ route('dashboard.skills.bulkRestore') }}' :
                        '{{ route('dashboard.skills.bulkForceDelete') }}';

                    promises.push(fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }));
                }

                Promise.all(promises).then(() => {
                    selectMode = false;
                    toggleBtn.innerText = '[ SELECT_MULTI ]';
                    toggleBtn.classList.remove('border-red-500', 'text-red-500');
                    bulkBar.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
                    fetchTrash();

                    const msg = action === 'restore' ? 'System: Items restored successfully.' :
                        'System: Items permanently purged.';
                    alert(msg);
                }).catch(err => alert("System Error: Failed to process bulk execution."));
            };

            function attachGridEvents() {
                const checkboxes = document.querySelectorAll('.bulk-checkbox, .bulk-skill-checkbox');
                const projectCards = document.querySelectorAll('.project-card');
                const skillCards = document.querySelectorAll('.skill-card');

                const monthButtons = document.querySelectorAll('.month-select');
                const skillsMonthButtons = document.querySelectorAll('.skills-month-select');
                const normalActions = document.querySelectorAll('.normal-actions, .normal-skill-actions');

                checkboxes.forEach(cb => {
                    cb.addEventListener('change', updateBulkBar);
                });

                monthButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const month = button.dataset.month;
                        const monthCheckboxes = document.querySelectorAll(
                            `.project-card[data-month="${month}"] .bulk-checkbox`);
                        const allChecked = [...monthCheckboxes].every(cb => cb.checked);

                        monthCheckboxes.forEach(cb => {
                            cb.checked = !allChecked;
                            const card = cb.closest('.project-card');
                            if (card) {
                                card.classList.toggle('border-primary', !allChecked);
                                card.classList.toggle('bg-primary/5', !allChecked);
                            }
                        });

                        button.innerText = allChecked ? '[ SELECT_ALL ]' : '[ UNSELECT_ALL ]';
                        updateBulkBar();
                    });
                });

                skillsMonthButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const month = button.dataset.month;
                        const skillCheckboxes = document.querySelectorAll(
                            `.skill-card[data-month="${month}"] .bulk-skill-checkbox`);
                        const allChecked = [...skillCheckboxes].every(cb => cb.checked);

                        skillCheckboxes.forEach(cb => {
                            cb.checked = !allChecked;
                            const card = cb.closest('.skill-card');
                            if (card) {
                                card.classList.toggle('border-primary', !allChecked);
                                card.classList.toggle('bg-primary/5', !allChecked);
                            }
                        });

                        button.innerText = allChecked ? '[ SELECT_ALL ]' :
                            '[ UNSELECT_ALL ]';
                        updateBulkBar();
                    });
                });

                const handleCardClick = function(e) {
                    if (!selectMode) return;
                    if (e.target.closest('form') || e.target.tagName === 'BUTTON' || e.target.closest(
                            '.delete-trash-btn') || e.target.closest('a')) return;

                    const checkbox = this.querySelector('.bulk-checkbox, .bulk-skill-checkbox');
                    if (checkbox) {
                        checkbox.checked = !checkbox.checked;
                        this.classList.toggle('border-primary', checkbox.checked);
                        this.classList.toggle('bg-primary/5', checkbox.checked);
                        updateBulkBar();
                    }
                };

                projectCards.forEach(card => card.addEventListener('click', handleCardClick));
                skillCards.forEach(card => card.addEventListener('click', handleCardClick));

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
                            confirmMessage.textContent =
                                'CRITICAL: Are you sure you want to permanently purge this node? Data cannot be recovered.';

                            // Trigger modal tampil (tergantung implementasi modalmu)
                            confirmModal.classList.remove('opacity-0', 'pointer-events-none');
                            confirmModal.style.opacity = '1';

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
                                confirmModal.style.opacity = '0';
                                confirmYes.removeEventListener('click', handleYes);
                                confirmCancel.removeEventListener('click', handleCancel);
                            };

                            confirmYes.addEventListener('click', handleYes);
                            confirmCancel.addEventListener('click', handleCancel);
                        }
                    });
                });

                const paginationLinks = document.querySelectorAll(
                    '.pagination-wrapper a, .pagination-wrapper-skills a');
                paginationLinks.forEach(link => {
                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        const url = e.target.href;
                        fetchTrash(url);
                        grid.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    });
                });

                if (selectMode) {
                    monthButtons.forEach(btn => btn.classList.remove('hidden'));
                    skillsMonthButtons.forEach(btn => btn.classList.remove('hidden'));
                    checkboxes.forEach(cb => cb.classList.remove('opacity-0', 'pointer-events-none'));
                    normalActions.forEach(el => el.classList.add('opacity-0', 'pointer-events-none'));
                } else {
                    monthButtons.forEach(btn => btn.classList.add('hidden'));
                    skillsMonthButtons.forEach(btn => btn.classList.add('hidden'));
                    checkboxes.forEach(cb => {
                        cb.checked = false;
                        cb.classList.add('opacity-0', 'pointer-events-none');
                    });
                    projectCards.forEach(card => card.classList.remove('border-primary', 'bg-primary/5'));
                    skillCards.forEach(card => card.classList.remove('border-primary', 'bg-primary/5'));
                    normalActions.forEach(el => el.classList.remove('opacity-0', 'pointer-events-none'));
                }
            }

            attachGridEvents();
        });
    </script>
    <style>
        /* CSS Utility untuk Putaran Lambat pada Target HUD */
        .animate-spin-slow {
            animation: spin 4s linear infinite;
        }
    </style>
@endpush
