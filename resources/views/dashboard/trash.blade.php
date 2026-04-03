@extends('layouts.dashboard')
@section('title', 'Trash Bin')

@section('content')
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <div class="min-h-screen bg-background pt-6 sm:pt-12 pb-32 px-4 md:px-6 relative overflow-hidden font-sans">

        <div class="absolute inset-0 pointer-events-none opacity-[0.03] z-0"
            style="background-image: radial-gradient(var(--color-text) 1px, transparent 1px); background-size: 24px 24px;">
        </div>

        <section class="max-w-7xl mx-auto relative z-10 space-y-12 mt-4 md:mt-8">

            <header class="relative space-y-6">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div class="space-y-6">
                        <div class="relative inline-flex items-center gap-2 py-1.5 pl-8 pr-6 transition-all duration-300 w-max group hover:-translate-y-0.5 hover:-rotate-1"
                            style="filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.06));">

                            <div class="absolute inset-0 bg-red-100 border border-red-300 rounded-l-md z-0 transition-colors"
                                style="clip-path: polygon(0 0, 100% 0, 92% 50%, 100% 100%, 0 100%);">
                            </div>

                            <div class="absolute top-1/2 -left-4 w-6 h-[1.5px] bg-[#8B0000]/80 -translate-y-[calc(50%+1px)] origin-right -rotate-12 group-hover:-rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>
                            <div class="absolute top-1/2 -left-3 w-5 h-[1.5px] bg-[#B22222]/80 -translate-y-[calc(50%-1px)] origin-right rotate-12 group-hover:rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>

                            <div class="absolute left-2.5 top-1/2 -translate-y-1/2 w-2.5 h-2.5 rounded-full bg-surface shadow-[inset_1px_1px_3px_rgba(0,0,0,0.3)] border border-red-700/30 z-10"></div>

                            <i class="fa-solid fa-trash-can relative z-10 text-red-800 text-[11px] mt-px"></i>

                            <span class="relative z-10 text-[10px] sm:text-xs font-black tracking-[0.15em] uppercase text-red-900 mt-px">
                                Arsip Terhapus
                            </span>
                        </div>

                        <h1 class="text-[clamp(2.5rem,6vw,4.5rem)] font-bold tracking-tighter leading-[1.05] text-text font-serif">
                            <span class="block">Tempat Sampah</span>
                        </h1>

                        <p class="text-base text-muted max-w-2xl leading-relaxed font-medium italic">
                            Data di sini akan dihapus secara permanen setelah melewati batas waktu retensi. Silakan tinjau kembali jika ada yang perlu dipulihkan.
                        </p>
                    </div>
                </div>
            </header>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">

                <div class="bg-stone-100 p-5 md:p-6 rounded-sm shadow-md border border-border flex flex-col justify-between relative group/tooltip rotate-1 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                        <i class="fa-solid fa-trash text-stone-600"></i> Total Sampah
                    </p>
                    <h3 class="text-4xl font-bold text-black relative z-10">{{ $totalTrashed }}</h3>
                </div>

                <div class="bg-sky-100 p-5 md:p-6 rounded-sm shadow-md border border-border flex flex-col justify-between relative group/tooltip -rotate-1 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                        <i class="fa-solid fa-folder-tree text-sky-600"></i> Proyek
                    </p>
                    <h3 class="text-4xl font-bold text-black relative z-10">{{ $totalTrashedProjects }}</h3>
                </div>

                <div class="bg-amber-100 p-5 md:p-6 rounded-sm shadow-md border border-border flex flex-col justify-between relative group/tooltip rotate-1 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                        <i class="fa-solid fa-layer-group text-amber-600"></i> Skill
                    </p>
                    <h3 class="text-4xl font-bold text-black relative z-10">{{ $totalTrashedSkills }}</h3>
                </div>

                <div class="bg-yellow-100 p-5 md:p-6 rounded-sm shadow-md border border-border flex flex-col justify-between relative group/tooltip rotate-1 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                        <i class="fa-solid fa-medal text-yellow-600"></i> Achievement
                    </p>
                    <h3 class="text-4xl font-bold text-black relative z-10">{{ $totalTrashedAchievements }}</h3>
                </div>

                <div class="bg-rose-100 p-5 md:p-6 rounded-sm shadow-md border border-border flex flex-col justify-between relative group/tooltip -rotate-1 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                        <i class="fa-solid fa-envelope-open-text text-rose-600"></i> Kontak
                    </p>
                    <h3 class="text-4xl font-bold text-black relative z-10">{{ $totalTrashedContacts }}</h3>
                </div>

                <div class="bg-red-50 p-5 md:p-6 rounded-sm shadow-md border border-red-200 flex flex-col justify-between relative group/tooltip -rotate-1 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-red-600 mb-4 flex items-center gap-2 relative z-10">
                        <i class="fa-solid fa-hourglass-half animate-pulse text-red-600"></i> Segera Dihapus
                    </p>
                    <h3 class="text-4xl font-bold text-red-700 relative z-10">{{ $expiringSoon ?? 0 }}</h3>
                </div>
            </div>

            <div class="bg-surface border-2 border-dashed border-border shadow-sm rounded-2xl p-5 md:p-6 space-y-6 relative">

                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-20 h-6 bg-muted opacity-20 backdrop-blur-sm -rotate-2" style="clip-path: polygon(5% 0, 100% 5%, 95% 100%, 0 95%); z-index: 10;"></div>

                <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-5 border-b-2 border-dashed border-border/50 pb-6 relative z-20">

                    <div class="relative w-full md:w-1/2 group">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-muted group-focus-within:text-primary transition-colors"></i>
                        <input type="text" id="search-input" placeholder="Cari arsip yang terhapus..." value="{{ request('search') }}"
                            class="w-full border-2 border-border bg-container rounded-lg px-4 py-3 pl-11 text-sm font-medium text-text placeholder:text-muted placeholder:italic focus:outline-none focus:border-primary focus:ring-0 transition-all shadow-inner"
                            style="background-image: repeating-linear-gradient(transparent, transparent 27px, var(--color-border) 27px, var(--color-border) 28px); line-height: 28px; background-attachment: local;" />
                    </div>

                    <div class="flex flex-wrap sm:flex-nowrap items-center gap-3">
                        <div class="relative z-40">
                            <select id="sort-select"
                                class="w-full md:w-auto appearance-none flex justify-between items-center gap-6 px-5 py-3 border-2 border-border bg-container rounded-lg text-xs font-bold uppercase tracking-widest text-text hover:border-primary hover:-translate-y-0.5 transition-all shadow-[3px_3px_0px_var(--color-border)] focus:outline-none pr-10 cursor-pointer">
                                <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>Terbaru Dihapus</option>
                                <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>Terlama Dihapus</option>
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-[10px] text-muted pointer-events-none"></i>
                        </div>

                        <button id="toggleSelectMode" type="button"
                            class="px-6 py-3 border-2 border-border bg-container rounded-lg text-xs font-bold uppercase tracking-widest text-muted hover:border-primary hover:text-primary transition-all shadow-[3px_3px_0px_var(--color-border)] focus:outline-none">
                            Pilih Beberapa
                        </button>
                    </div>
                </div>

                <div class="flex overflow-x-auto no-scrollbar gap-4 pb-2 pt-2 px-2 -mx-2">
                    <button type="button"
                        class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none border-2 border-border shadow-[1px_2px_0px_var(--color-border)]"
                        data-tab="all">
                        Semua
                    </button>
                    <button type="button"
                        class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none border-2 border-border shadow-[1px_2px_0px_var(--color-border)]"
                        data-tab="projects">
                        Proyek
                    </button>
                    <button type="button"
                        class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none border-2 border-border shadow-[1px_2px_0px_var(--color-border)]"
                        data-tab="skills">
                        Skill
                    </button>
                    <button type="button"
                        class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none border-2 border-border shadow-[1px_2px_0px_var(--color-border)]"
                        data-tab="achievements">
                        Achievement
                    </button>
                    <button type="button"
                        class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none border-2 border-border shadow-[1px_2px_0px_var(--color-border)]"
                        data-tab="contacts">
                        Kontak
                    </button>
                </div>

                <div id="trash-grid" class="space-y-10 min-h-[400px] transition-opacity duration-300">
                    @include('dashboard.trash.partials.content')
                </div>

            </div>

            <div id="bulkBar"
                class="fixed bottom-8 left-1/2 -translate-x-1/2 z-90 bg-[#FEFCE8] border-2 border-yellow-500/30 p-4 md:px-8 md:py-5 flex flex-col sm:flex-row items-center gap-6 shadow-[8px_8px_0px_rgba(0,0,0,0.1)] opacity-0 pointer-events-none translate-y-8 rotate-1 transition-all duration-300 w-[90%] md:w-auto min-w-[400px]">

                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-16 h-4 bg-white/60 backdrop-blur-sm border border-black/5 rotate-1"></div>

                <div class="flex items-center gap-4 border-r-2 border-dashed border-yellow-600/20 pr-6 mr-2 w-full sm:w-auto justify-center sm:justify-start">
                    <div class="w-10 h-10 rounded-full bg-yellow-400/20 flex items-center justify-center border border-yellow-500 animate-pulse">
                        <i class="fa-solid fa-check-double text-yellow-700"></i>
                    </div>
                    <div class="flex flex-col">
                        <span id="selectedCount" class="text-xs font-black uppercase tracking-widest text-yellow-900">0 TERPILIH</span>
                        <span class="text-[9px] font-bold text-yellow-900/40 uppercase tracking-tighter">Operasi Massal</span>
                    </div>
                </div>

                <div class="flex items-center gap-4 w-full sm:w-auto">
                    <button type="button" onclick="bulkAction('restore')"
                        class="flex-1 sm:flex-none px-6 py-2.5 bg-emerald-100 border-2 border-emerald-500 rounded text-[10px] font-black uppercase tracking-widest text-emerald-900 hover:-translate-y-1 hover:-rotate-1 transition-all shadow-[3px_3px_0px_rgba(0,0,0,0.05)]">
                        RESTORE SEMUA
                    </button>
                    <button type="button" onclick="bulkAction('delete')"
                        class="flex-1 sm:flex-none px-6 py-2.5 bg-rose-100 border-2 border-rose-500 rounded text-[10px] font-black uppercase tracking-widest text-rose-900 hover:-translate-y-1 hover:rotate-1 transition-all shadow-[3px_3px_0px_rgba(0,0,0,0.05)] group">
                        <i class="fa-solid fa-skull mr-2"></i> HAPUS PERMANEN
                    </button>
                    <button type="button" id="cancelSelect" class="text-[9px] font-bold text-muted hover:text-text uppercase tracking-widest underline underline-offset-4 decoration-dashed ml-2">
                        Batal
                    </button>
                </div>
                <div class="absolute bottom-0 right-0 w-4 h-4 bg-yellow-200" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></div>
            </div>

            <form id="bulkForm" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="action_type" id="bulkActionType">
            </form>

            <form id="singleActionForm" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="_method" id="singleActionMethod" value="DELETE">
            </form>

        </section>
    </div>
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
            const cancelBtn = document.getElementById('cancelSelect');

            let currentTab = 'all';
            let currentSearch = '{{ request('search', '') }}';
            let currentSort = '{{ $sort }}';
            let selectMode = false;
            let debounceTimer;

            function updateActiveTabStyles() {
                tabs.forEach(t => {
                    const isActive = t.dataset.tab === currentTab;
                    if (isActive) {
                        t.className = "filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none bg-warning text-yellow-900 border-2 border-yellow-500 shadow-[2px_3px_0px_var(--color-border)] -translate-y-1 rotate-1";
                    } else {
                        t.className = "filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest text-muted bg-container border-2 border-border shadow-[1px_2px_0px_var(--color-border)] hover:shadow-[3px_4px_0px_var(--color-border)] hover:-translate-y-1 hover:-rotate-1 transition-all focus:outline-none";
                    }
                });
            }

            updateActiveTabStyles();

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

            tabs.forEach(tab => {
                tab.addEventListener('click', (e) => {
                    currentTab = e.target.dataset.tab;
                    updateActiveTabStyles();
                    fetchTrash();
                });
            });

            searchInput.addEventListener('input', (e) => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    currentSearch = e.target.value;
                    fetchTrash();
                }, 300);
            });

            sortSelect.addEventListener('change', (e) => {
                currentSort = e.target.value;
                fetchTrash();
            });

            toggleBtn.addEventListener('click', () => {
                selectMode = !selectMode;

                if (selectMode) {
                    toggleBtn.innerText = 'BATAL PILIH';
                    toggleBtn.classList.add('border-red-500', 'text-red-500');
                } else {
                    toggleBtn.innerText = 'Pilih Beberapa';
                    toggleBtn.classList.remove('border-red-500', 'text-red-500');
                    if (bulkBar) bulkBar.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
                }

                fetchTrash();
            });

            if (cancelBtn) {
                cancelBtn.onclick = () => toggleBtn.click();
            }

            function updateBulkBar() {
                if (!selectMode || !bulkBar) return;

                const selectedProjects = document.querySelectorAll('.bulk-checkbox:checked').length;
                const selectedSkills = document.querySelectorAll('.bulk-skill-checkbox:checked').length;
                const selectedAchievements = document.querySelectorAll('.bulk-achievement-checkbox:checked').length;
                const selectedContacts = document.querySelectorAll('.bulk-contact-checkbox:checked').length;
                const totalSelected = selectedProjects + selectedSkills + selectedAchievements + selectedContacts;

                if (totalSelected > 0) {
                    bulkBar.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
                    selectedCountText.innerText = totalSelected + ' TERPILIH';
                } else {
                    bulkBar.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
                }
            }

            window.bulkAction = function(action) {
                const selectedProjects = document.querySelectorAll('.bulk-checkbox:checked');
                const selectedSkills = document.querySelectorAll('.bulk-skill-checkbox:checked');
                const selectedAchievements = document.querySelectorAll('.bulk-achievement-checkbox:checked');
                const selectedContacts = document.querySelectorAll('.bulk-contact-checkbox:checked');

                if (selectedProjects.length === 0 && selectedSkills.length === 0 && selectedAchievements.length === 0 && selectedContacts.length === 0) return;

                const confirmModal = document.getElementById('confirm-modal');
                const confirmYes = document.getElementById('confirm-yes');
                const confirmCancel = document.getElementById('confirm-cancel');
                const confirmMessage = document.getElementById('confirm-message');

                if (confirmModal && confirmYes && confirmCancel) {
                    if (confirmMessage) {
                        confirmMessage.textContent = action === 'restore' 
                            ? 'Apakah Anda yakin ingin memulihkan item terpilih ke publik?' 
                            : 'PENTING: Apakah Anda yakin ingin menghapus item terpilih secara permanen? Data ini tidak bisa dikembalikan.';
                    }

                    confirmModal.classList.remove('opacity-0', 'pointer-events-none');
                    confirmModal.style.opacity = '1';

                    const executeBulk = () => {
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

                        if (selectedAchievements.length > 0) {
                            let formData = new FormData();
                            formData.append('_token', '{{ csrf_token() }}');
                            selectedAchievements.forEach(cb => formData.append('achievements[]', cb.value));

                            let url = action === 'restore' ? '{{ route('dashboard.achievements.bulkRestore') }}' :
                                '{{ route('dashboard.achievements.bulkForceDelete') }}';

                            promises.push(fetch(url, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            }));
                        }

                        if (selectedContacts.length > 0) {
                            let formData = new FormData();
                            formData.append('_token', '{{ csrf_token() }}');
                            selectedContacts.forEach(cb => formData.append('contacts[]', cb.value));

                            let url = action === 'restore' ? '{{ route('dashboard.contacts.bulkRestore') }}' :
                                '{{ route('dashboard.contacts.bulkForceDelete') }}';

                            promises.push(fetch(url, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            }));
                        }

                        Promise.all(promises).then(responses => {
                            return responses[0].text();
                        }).then(html => {
                            selectMode = false;
                            toggleBtn.innerText = 'Pilih Beberapa';
                            toggleBtn.classList.remove('border-red-500', 'text-red-500');
                            bulkBar.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
                            fetchTrash();

                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newModal = doc.getElementById('global-modal');

                            if (newModal) {
                                const oldModal = document.getElementById('global-modal');
                                if (oldModal) oldModal.remove();

                                document.body.appendChild(newModal);

                                const backdrop = document.getElementById('modal-backdrop');
                                const modalBox = document.getElementById('modal-box');
                                const closeBtn = document.getElementById('modal-close-btn');

                                if (backdrop && modalBox) {
                                    setTimeout(() => {
                                        backdrop.style.opacity = '1';
                                        modalBox.style.opacity = '1';
                                        modalBox.style.transform = 'scale(1) translateY(0)';
                                    }, 50);

                                    const hideModal = () => {
                                        backdrop.style.opacity = '0';
                                        modalBox.style.opacity = '0';
                                        modalBox.style.transform = 'scale(0.9) translateY(30px)';
                                        setTimeout(() => newModal.remove(), 300);
                                    };

                                    if (closeBtn) closeBtn.addEventListener('click', hideModal);
                                    backdrop.addEventListener('click', hideModal);
                                    setTimeout(hideModal, 4000);
                                }
                            }
                        }).catch(err => alert("Kesalahan Sistem: Gagal memproses eksekusi massal."));

                        cleanup();
                    };

                    const cleanup = () => {
                        confirmModal.classList.add('opacity-0', 'pointer-events-none');
                        confirmModal.style.opacity = '0';
                        confirmYes.removeEventListener('click', executeBulk);
                        confirmCancel.removeEventListener('click', cleanup);
                    };

                    confirmYes.addEventListener('click', executeBulk);
                    confirmCancel.addEventListener('click', cleanup);
                } else {
                    if (action === 'delete') {
                        if (!confirm('PENTING: Apakah Anda yakin ingin menghapus item terpilih secara permanen? Data ini tidak bisa dikembalikan.')) return;
                    } else {
                        if (!confirm('Apakah Anda yakin ingin memulihkan item terpilih ke publik?')) return;
                    }

                    // Fallback using manual form logic if modal UI fails
                    const form = document.getElementById('bulkForm');
                    form.innerHTML = '@csrf'; 
                    // To keep things simple, reload if UI is broken
                    window.location.reload();
                }
            };

            function attachGridEvents() {
                const checkboxes = document.querySelectorAll('.bulk-checkbox, .bulk-skill-checkbox, .bulk-achievement-checkbox, .bulk-contact-checkbox');
                const projectCards = document.querySelectorAll('.project-card');
                const skillCards = document.querySelectorAll('.skill-card');
                const achievementCards = document.querySelectorAll('.achievement-card');
                const contactCards = document.querySelectorAll('.contact-trash-card');

                const monthButtons = document.querySelectorAll('.month-select, .skills-month-select');
                const normalActions = document.querySelectorAll('.normal-actions, .normal-skill-actions, .normal-achievement-actions, .normal-contact-actions');

                checkboxes.forEach(cb => {
                    cb.addEventListener('change', updateBulkBar);
                });

                monthButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const month = button.dataset.month;
                        const selector = month.startsWith('ach-') ? '.achievement-card .bulk-achievement-checkbox'
                                       : month.startsWith('con-') ? '.contact-trash-card .bulk-contact-checkbox'
                                       : month.startsWith('skill-') ? '.skill-card .bulk-skill-checkbox'
                                       : '.project-card .bulk-checkbox';
                        
                        const monthCheckboxes = document.querySelectorAll(
                            `${selector.split(' ')[0]}[data-month="${month}"] ${selector.split(' ')[1]}`);
                        const allChecked = [...monthCheckboxes].every(cb => cb.checked);

                        monthCheckboxes.forEach(cb => {
                            cb.checked = !allChecked;
                            const card = cb.closest('.card, .project-card, .skill-card, .achievement-card, .contact-trash-card');
                            if (card) {
                                card.classList.toggle('border-primary', !allChecked);
                                card.classList.toggle('bg-primary/5', !allChecked);
                            }
                        });

                        button.innerText = allChecked ? 'Pilih Semua' : 'Batal Semua';
                        updateBulkBar();
                    });
                });

                const handleCardClick = function(e) {
                    if (!selectMode) return;
                    if (e.target.closest('form') || e.target.tagName === 'BUTTON' || e.target.closest('.delete-trash-btn') || e.target.closest('a')) return;

                    const checkbox = this.querySelector('.bulk-checkbox, .bulk-skill-checkbox, .bulk-achievement-checkbox, .bulk-contact-checkbox');
                    if (checkbox) {
                        checkbox.checked = !checkbox.checked;
                        this.classList.toggle('border-primary', checkbox.checked);
                        this.classList.toggle('bg-primary/5', checkbox.checked);
                        updateBulkBar();
                    }
                };

                projectCards.forEach(card => card.addEventListener('click', handleCardClick));
                skillCards.forEach(card => card.addEventListener('click', handleCardClick));
                achievementCards.forEach(card => card.addEventListener('click', handleCardClick));
                contactCards.forEach(card => card.addEventListener('click', handleCardClick));

                const actionButtons = document.querySelectorAll('.delete-trash-btn, .restore-trash-btn');
                actionButtons.forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        const isRestore = this.classList.contains('restore-trash-btn');
                        const url = isRestore ? this.dataset.restoreUrl : this.dataset.deleteUrl;

                        const confirmModal = document.getElementById('confirm-modal');
                        const confirmYes = document.getElementById('confirm-yes');
                        const confirmCancel = document.getElementById('confirm-cancel');
                        const confirmMessage = document.getElementById('confirm-message');

                        if (confirmModal && confirmYes && confirmCancel) {
                            if (confirmMessage) {
                                confirmMessage.textContent = isRestore 
                                    ? 'Apakah Anda yakin ingin memulihkan item ini ke publik?' 
                                    : 'PENTING: Apakah Anda yakin ingin menghapus item ini secara permanen? Data tidak dapat dipulihkan.';
                            }

                            confirmModal.classList.remove('opacity-0', 'pointer-events-none');
                            confirmModal.style.opacity = '1';

                            const executeAction = () => {
                                const form = document.getElementById('singleActionForm');
                                form.action = url;
                                document.getElementById('singleActionMethod').value = isRestore ? 'POST' : 'DELETE';
                                form.submit();
                                cleanup();
                            };

                            const cleanup = () => {
                                confirmModal.classList.add('opacity-0', 'pointer-events-none');
                                confirmModal.style.opacity = '0';
                                confirmYes.removeEventListener('click', executeAction);
                                confirmCancel.removeEventListener('click', cleanup);
                            };

                            confirmYes.addEventListener('click', executeAction);
                            confirmCancel.addEventListener('click', cleanup);
                        } else {
                            const msg = isRestore ? 'Apakah Anda yakin ingin memulihkan item ini ke publik?' : 'PENTING: Apakah Anda yakin ingin menghapus item ini secara permanen? Data tidak dapat dipulihkan.';
                            if (confirm(msg)) {
                                const form = document.getElementById('singleActionForm');
                                form.action = url;
                                document.getElementById('singleActionMethod').value = isRestore ? 'POST' : 'DELETE';
                                form.submit();
                            }
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
                    checkboxes.forEach(cb => cb.classList.remove('opacity-0', 'pointer-events-none'));
                    normalActions.forEach(el => el.classList.add('opacity-0', 'pointer-events-none', 'hidden'));
                } else {
                    monthButtons.forEach(btn => btn.classList.add('hidden'));
                    checkboxes.forEach(cb => {
                        cb.checked = false;
                        cb.classList.add('opacity-0', 'pointer-events-none');
                    });
                    projectCards.forEach(card => card.classList.remove('border-primary', 'bg-primary/5'));
                    skillCards.forEach(card => card.classList.remove('border-primary', 'bg-primary/5'));
                    achievementCards.forEach(card => card.classList.remove('border-primary', 'bg-primary/5'));
                    contactCards.forEach(card => card.classList.remove('border-primary', 'bg-primary/5'));
                    normalActions.forEach(el => el.classList.remove('opacity-0', 'pointer-events-none', 'hidden'));
                }
            }

            attachGridEvents();
        });
    </script>
@endpush
