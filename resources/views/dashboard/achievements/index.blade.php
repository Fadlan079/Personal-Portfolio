@extends('layouts.dashboard')
@section('title', 'Achievement')

@vite(['resources/css/dashboard_project.css', 'resources/js/app.js'])

@php
    $isBulk = request('bulk_mode') == '1';
@endphp

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400;600;700&family=Merriweather:ital,wght@0,300;0,700;1,300&display=swap');

        .font-diary-body { font-family: 'Merriweather', serif; }
        .font-diary-accent { font-family: 'Caveat', cursive; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <div class="min-h-screen bg-bg pt-6 sm:pt-12 pb-24 px-4 md:px-6 relative overflow-hidden text-text">
        <div class="absolute inset-0 pointer-events-none opacity-[0.04] z-0"
            style="background-image: radial-gradient(#292524 1px, transparent 1px); background-size: 24px 24px;">
        </div>

        <section class="max-w-7xl mx-auto relative z-10 space-y-12 mt-4 md:mt-8">
            <header class="relative space-y-6">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div class="space-y-6">
                        <div class="relative inline-flex items-center gap-2 py-1.5 pl-8 pr-6 transition-all duration-300 w-max group hover:-translate-y-0.5 hover:rotate-1"
                            style="filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.06));">
                            <div class="absolute inset-0 bg-yellow-100 border border-yellow-500 rounded-l-md z-0 transition-colors"
                                style="clip-path: polygon(0 0, 100% 0, 92% 50%, 100% 100%, 0 100%);">
                            </div>
                            <div class="absolute top-1/2 -left-4 w-6 h-[1.5px] bg-[#8B0000]/80 -translate-y-[calc(50%+1px)] origin-right -rotate-12 group-hover:-rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>
                            <div class="absolute top-1/2 -left-3 w-5 h-[1.5px] bg-[#B22222]/80 -translate-y-[calc(50%-1px)] origin-right rotate-12 group-hover:rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>
                            <div class="absolute left-2.5 top-1/2 -translate-y-1/2 w-2.5 h-2.5 rounded-full bg-white shadow-[inset_1px_1px_3px_rgba(0,0,0,0.3)] border border-yellow-700/30 z-10"></div>

                            <i class="fa-solid fa-medal relative z-10 text-yellow-800 text-[11px] mt-px"></i>
                            <span class="relative z-10 text-[10px] sm:text-xs font-black tracking-[0.15em] uppercase text-yellow-900 mt-px">
                                Sertifikat & Penghargaan
                            </span>
                        </div>

                        <h1 class="text-[clamp(2.5rem,6vw,4.5rem)] font-bold tracking-tighter leading-[1.05] text-stone-900">
                            <span class="block font-diary-body">Pencapaian</span>
                            <span class="block text-stone-500 mt-2 text-[clamp(1.5rem,4vw,2.5rem)] font-diary-accent">Rekam Jejak & Validasi</span>
                        </h1>

                        <p class="text-base text-stone-600 max-w-2xl leading-relaxed font-diary-body">
                            Mengelola <span class="font-bold border-b border-stone-400">{{ $summary['total'] }}</span> Catatan Pencapaian yang tercatat.
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="button" id="openCreateAchievementBtn"
                            class="px-4 py-2.5 bg-yellow-100 border-2 border-yellow-600 rounded-lg text-xs font-bold uppercase tracking-widest text-yellow-900 hover:-translate-y-1 hover:rotate-2 transition-all shadow-[4px_4px_0px_rgba(202,138,4,0.4)] group flex items-center gap-2">
                            <i class="fa-solid fa-plus group-hover:rotate-90 transition-transform text-yellow-700"></i>
                            Tambah Pencapaian
                        </button>
                    </div>
                </div>
            </header>

            <div class="bg-surface border-2 border-dashed border-border shadow-sm rounded-2xl p-5 md:p-6 space-y-6 font-sans relative mt-8">
                <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-5 border-b-2 border-dashed border-border/50 pb-6 relative z-20">
                    <div class="relative w-full md:w-1/2 group">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-muted group-focus-within:text-primary transition-colors"></i>
                        <input type="text" id="achievement-search" placeholder="Cari pencapaian..."
                            class="w-full border-2 border-border bg-container rounded-lg px-4 py-3 pl-11 text-sm font-medium text-text placeholder:text-muted placeholder:italic placeholder:font-serif focus:outline-none focus:border-primary focus:ring-0 transition-all shadow-inner"
                            style="background-image: repeating-linear-gradient(transparent, transparent 27px, var(--color-border) 27px, var(--color-border) 28px); line-height: 28px; background-attachment: local;" value="{{ request('search') }}" />
                    </div>

                    <div class="flex flex-wrap sm:flex-nowrap items-center gap-3">
                        <button id="toggleSelectMode" type="button"
                            class="px-6 py-3 border-2 {{ $isBulk ? 'border-red-500 text-red-500' : 'border-border text-muted' }} bg-container rounded-lg text-xs font-bold uppercase tracking-widest hover:border-primary hover:text-primary transition-all shadow-[3px_3px_0px_var(--color-border)] focus:outline-none">
                            {{ $isBulk ? 'BATAL PILIH' : 'Pilih Beberapa' }}
                        </button>

                        <div class="relative z-40">
                            <button id="sort-toggle"
                                class="w-full md:w-auto flex justify-between items-center gap-6 px-5 py-3 border-2 border-border bg-container rounded-lg text-xs font-bold uppercase tracking-widest text-text hover:border-primary hover:text-primary hover:-translate-y-0.5 transition-all shadow-[3px_3px_0px_var(--color-border)] focus:outline-none">
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-arrow-down-short-wide"></i>
                                    <span id="sort-label">Terbaru</span>
                                </span>
                                <i class="fa-solid fa-chevron-down text-[10px]" id="sort-chevron"></i>
                            </button>

                            <div id="sort-menu"
                                class="hidden absolute right-0 top-full mt-3 w-full min-w-48 bg-surface rounded-lg border-2 border-border shadow-[4px_4px_0px_var(--color-border)] overflow-hidden">
                                <button class="sort-option w-full text-left px-5 py-3 text-xs font-bold uppercase tracking-widest text-muted hover:bg-container hover:text-text transition-colors border-b-2 border-dashed border-border/50" data-sort="latest">
                                    Terbaru
                                </button>
                                <button class="sort-option w-full text-left px-5 py-3 text-xs font-bold uppercase tracking-widest text-muted hover:bg-container hover:text-text transition-colors border-b-2 border-dashed border-border/50" data-sort="oldest">
                                    Terlama
                                </button>
                                <button class="sort-option w-full text-left px-5 py-3 text-xs font-bold uppercase tracking-widest text-muted hover:bg-container hover:text-text transition-colors" data-sort="most_projects">
                                    Sering Digunakan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="achievements-container">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pt-4">
                    @forelse($achievements as $index => $ach)
                        @php $rotation = $index % 2 == 0 ? 'rotate-1' : '-rotate-1'; @endphp
                        <div x-data="{ selected: false }"
                             :class="selected ? 'bg-yellow-50 border-yellow-500 shadow-md ring-2 ring-yellow-400/20' : 'bg-[#FCFAEF] border-stone-300'"
                             class="achievement-card border rounded-sm shadow-sm p-4 relative group hover:-translate-y-1 hover:z-20 transition-all {{ $rotation }} hover:rotate-0"
                             @click="{{ $isBulk ? 'selected = !selected; setTimeout(() => window.updateBulkBar(), 0);' : '' }}"
                             data-id="{{ $ach->id }}">

                            <!-- Bulk Checkbox -->
                            <div class="absolute top-4 left-4 z-30 {{ $isBulk ? '' : 'opacity-0 pointer-events-none' }} transition-opacity duration-300 bulk-check-container">
                                <input type="checkbox" name="achievements[]" value="{{ $ach->id }}" x-model="selected" @click.stop="setTimeout(() => window.updateBulkBar(), 0)"
                                    class="bulk-checkbox w-5 h-5 border-2 border-stone-400 rounded appearance-none checked:bg-yellow-600 checked:border-yellow-600 transition-colors cursor-pointer shadow-sm">
                            </div>

                            <div class="absolute -top-3 left-6 w-8 h-10 border-2 border-stone-400/60 rounded-full z-10 rotate-12 pointer-events-none sticky-note-tape" style="clip-path: inset(0 0 50% 0);"></div>
                            <div class="absolute -top-3 left-6 w-8 h-10 border-2 border-stone-400/60 rounded-full z-0 rotate-12 pointer-events-none sticky-note-tape"></div>

                            <div class="flex gap-4 h-full flex-col">
                                @if($ach->image_url)
                                    <div class="w-full h-40 bg-stone-200 border border-stone-300 rounded overflow-hidden">
                                        <img src="{{ asset('storage/'.$ach->image_url) }}" alt="{{ $ach->title }}" class="w-full h-full object-cover filter contrast-[0.95] sepia-[0.1]">
                                    </div>
                                @else
                                    <div class="w-full h-40 bg-[#f5f5dc] border border-stone-300 rounded flex items-center justify-center flex-col gap-2 text-stone-400">
                                        <i class="fa-solid fa-certificate text-4xl opacity-50"></i>
                                        <span class="text-[10px] font-bold uppercase tracking-widest opacity-50">No Certificate</span>
                                    </div>
                                @endif
                                <div class="grow flex flex-col pt-2">
                                    <h3 class="text-lg font-diary-body font-bold text-stone-800 line-clamp-1 mb-1" title="{{ $ach->title }}">{{ $ach->title }}</h3>
                                    <p class="text-sm font-diary-accent text-stone-500 mb-3 line-clamp-2 leading-tight">
                                        {{ $ach->description ?: 'Tanpa deskripsi' }}
                                    </p>
                                    <div class="mt-auto space-y-2">
                                        <div class="flex justify-between items-center text-xs font-diary-body text-stone-600">
                                            <span class="truncate"><i class="fa-solid fa-building mr-1.5 opacity-60"></i>{{ $ach->issuer ?? 'Anonim' }}</span>
                                            <span class="whitespace-nowrap"><i class="fa-regular fa-calendar mr-1.5 opacity-60"></i>{{ $ach->date ? \Carbon\Carbon::parse($ach->date)->format('M Y') : 'Unknown' }}</span>
                                        </div>
                                        <div class="flex justify-between items-center pt-3 border-t border-dashed border-stone-300">
                                            <span class="text-[10px] font-bold uppercase tracking-widest text-stone-500 bg-stone-200/50 px-2 py-1 rounded">
                                                {{ $ach->projects_count }} Proyek
                                            </span>
                                            <div class="flex gap-2 {{ $isBulk ? 'hidden' : '' }} normal-achievement-actions">
                                                <button type="button" class="text-stone-400 hover:text-primary transition-colors edit-achievement-btn" title="Edit"
                                                    data-id="{{ $ach->id }}"
                                                    data-title="{{ $ach->title }}"
                                                    data-issuer="{{ $ach->issuer }}"
                                                    data-date="{{ $ach->date ? \Carbon\Carbon::parse($ach->date)->format('Y-m-d') : '' }}"
                                                    data-description="{{ $ach->description }}"
                                                    data-image="{{ $ach->image_url ? asset('storage/'.$ach->image_url) : '' }}"
                                                    data-image-name="{{ $ach->image_url ? basename($ach->image_url) : '' }}">
                                                    <i class="fa-regular fa-pen-to-square pointer-events-none"></i>
                                                </button>
                                                <button type="button" class="text-stone-400 hover:text-red-500 transition-colors delete-achievement-btn" title="Hapus" data-id="{{ $ach->id }}">
                                                    <i class="fa-regular fa-trash-can pointer-events-none"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 px-6 flex flex-col items-center justify-center text-center bg-[#fdfcf5] border-2 border-dashed border-[#e5e0d0] rounded-xl shadow-[4px_4px_0px_rgba(0,0,0,0.05)] relative font-sans overflow-hidden">
                            <div class="absolute inset-0 z-0 opacity-30" style="background-image: repeating-linear-gradient(transparent, transparent 24px, #e5e0d0 24px, #e5e0d0 25px);"></div>
                            <div class="relative z-20 space-y-3">
                                <i class="fa-solid fa-medal text-5xl text-stone-400/30 mb-2"></i>
                                <h3 class="text-3xl font-medium text-stone-900 font-diary-accent tracking-wide">Pencapaian Kosong</h3>
                                <p class="text-sm text-stone-500 max-w-sm mx-auto italic font-diary-body opacity-90">Belum ada pencapaian yang ditambahkan. Mulai dengan membuat catatan pencapaian baru.</p>
                                <button type="button" id="openCreateAchievementBtnEmpty" class="inline-block mt-6 px-8 py-3 bg-yellow-100 border-2 border-yellow-600 rounded-lg text-xs font-bold uppercase tracking-widest text-yellow-900 hover:-translate-y-1 transition-all shadow-[4px_4px_0px_rgba(202,138,4,0.4)]">
                                    Tambah Pencapaian
                                </button>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if (!$isBulk && $achievements instanceof \Illuminate\Pagination\LengthAwarePaginator && $achievements->hasPages())
                    <div class="flex justify-center pt-12 md:pt-16 pb-8">
                        <nav class="flex flex-wrap sm:flex-nowrap items-center justify-center gap-3 sm:gap-4 font-mono w-full sm:w-auto px-4">
                            @if ($achievements->onFirstPage())
                                <span class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted opacity-30 cursor-not-allowed italic font-serif bg-container"><i class="fa-solid fa-chevron-left text-[10px] sm:text-xs"></i></span>
                            @else
                                <a href="{{ $achievements->previousPageUrl() }}" class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted hover:border-primary hover:text-primary hover:-translate-y-0.5 transition-all shadow-sm bg-container"><i class="fa-solid fa-chevron-left text-[10px] sm:text-xs pointer-events-none"></i></a>
                            @endif

                            <div class="px-4 py-1.5 sm:px-6 sm:py-2 bg-yellow-100 border-2 border-yellow-500 rounded-full shadow-[2px_2px_0px_var(--color-border)] rotate-1 shrink-0">
                                <span class="text-[10px] sm:text-xs font-black text-yellow-900 uppercase tracking-widest whitespace-nowrap">
                                    {{ sprintf('%02d', $achievements->currentPage()) }} <span class="opacity-50 mx-1">/</span> {{ sprintf('%02d', $achievements->lastPage()) }}
                                </span>
                            </div>

                            @if ($achievements->hasMorePages())
                                <a href="{{ $achievements->nextPageUrl() }}" class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted hover:border-primary hover:text-primary hover:-translate-y-0.5 transition-all shadow-sm bg-container"><i class="fa-solid fa-chevron-right text-[10px] sm:text-xs pointer-events-none"></i></a>
                            @else
                                <span class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted opacity-30 cursor-not-allowed italic font-serif bg-container"><i class="fa-solid fa-chevron-right text-[10px] sm:text-xs"></i></span>
                            @endif
                        </nav>
                    </div>
                @endif
                </div>
            </div>
            </div>

            <!-- Bulk Action Bar -->
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
                    <button type="button" onclick="executeBulkAction('trash')"
                        class="flex-1 sm:flex-none px-6 py-2.5 bg-rose-100 border-2 border-rose-500 rounded text-[10px] font-black uppercase tracking-widest text-rose-900 hover:-translate-y-1 hover:rotate-1 transition-all shadow-[3px_3px_0px_rgba(0,0,0,0.05)] group">
                        <i class="fa-solid fa-trash-can mr-2"></i> PINDAHKAN KE TRASH
                    </button>
                    <button type="button" id="cancelSelect" class="text-[9px] font-bold text-muted hover:text-text uppercase tracking-widest underline underline-offset-4 decoration-dashed ml-2">
                        Batal
                    </button>
                </div>
                <div class="absolute bottom-0 right-0 w-4 h-4 bg-yellow-200" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></div>
            </div>

            <form id="bulkActionForm" method="POST" class="hidden">
                @csrf
            </form>
        </section>
    </div>
@endsection

<form id="deleteAchievementForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<x-achievement.create-modal />
<x-achievement.edit-modal />

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const createModal = document.getElementById('createAchievementModal');
        const editModal = document.getElementById('editAchievementModal');
        const openCreateButton = document.getElementById('openCreateAchievementBtn');
        const openCreateButtonEmpty = document.getElementById('openCreateAchievementBtnEmpty');
        const closeCreateButton = document.getElementById('closeCreateAchievementModal');
        const cancelCreateButton = document.getElementById('cancelCreateAchievement');
        const closeEditButton = document.getElementById('closeEditAchievementModal');
        const cancelEditButton = document.getElementById('cancelEditAchievement');

        function openModal(modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal(modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        if (openCreateButton) openCreateButton.addEventListener('click', () => openModal(createModal));
        if (openCreateButtonEmpty) openCreateButtonEmpty.addEventListener('click', () => openModal(createModal));
        if (closeCreateButton) closeCreateButton.addEventListener('click', () => closeModal(createModal));
        if (cancelCreateButton) cancelCreateButton.addEventListener('click', () => closeModal(createModal));
        if (closeEditButton) closeEditButton.addEventListener('click', () => closeModal(editModal));
        if (cancelEditButton) cancelEditButton.addEventListener('click', () => closeModal(editModal));

        window.addEventListener('click', function(e) {
            if (e.target === createModal) {
                closeModal(createModal);
            }
            if (e.target === editModal) {
                closeModal(editModal);
            }
        });

        // Delegate listener for delete
        document.body.addEventListener('click', function(e) {
            const deleteBtn = e.target.closest('.delete-achievement-btn');
            if (deleteBtn) {
                e.preventDefault();
                const id = deleteBtn.dataset.id;

                const confirmModal = document.getElementById('confirm-modal');
                const confirmYes = document.getElementById('confirm-yes');
                const confirmCancel = document.getElementById('confirm-cancel');
                const confirmMessage = document.getElementById('confirm-message');
                const confirmBox = document.getElementById('confirm-box');

                if (confirmModal && confirmYes && confirmCancel) {
                    if (confirmMessage) confirmMessage.textContent = 'Apakah Anda yakin ingin menghapus pencapaian ini secara permanen?';

                    // Reset any previous listeners by cloning
                    const newYes = confirmYes.cloneNode(true);
                    const newCancel = confirmCancel.cloneNode(true);
                    confirmYes.parentNode.replaceChild(newYes, confirmYes);
                    confirmCancel.parentNode.replaceChild(newCancel, confirmCancel);

                    // Show Modal
                    confirmModal.classList.remove('opacity-0', 'pointer-events-none');
                    confirmModal.classList.add('opacity-100', 'pointer-events-auto');
                    confirmModal.style.opacity = '1';
                    confirmModal.style.pointerEvents = 'auto';
                    
                    if(confirmBox) {
                        confirmBox.style.transform = 'scale(1) rotate(0deg)';
                        confirmBox.style.opacity = '1';
                    }

                    const cleanup = () => {
                        confirmModal.classList.add('opacity-0', 'pointer-events-none');
                        confirmModal.classList.remove('opacity-100', 'pointer-events-auto');
                        confirmModal.style.opacity = '0';
                        confirmModal.style.pointerEvents = 'none';
                        if(confirmBox) {
                            confirmBox.style.transform = 'scale(0.95) rotate(1deg)';
                            confirmBox.style.opacity = '0';
                        }
                    };

                    newYes.addEventListener('click', () => {
                        const form = document.getElementById('deleteAchievementForm');
                        form.action = `/dashboard/achievements/${id}`;
                        form.submit();
                        cleanup();
                    });

                    newCancel.addEventListener('click', cleanup);
                    // Also close on backdrop click
                    const backdrop = document.getElementById('confirm-backdrop');
                    if(backdrop) backdrop.onclick = cleanup;
                } else {
                    if (confirm('Apakah Anda yakin ingin menghapus pencapaian ini secara permanen?')) {
                        const form = document.getElementById('deleteAchievementForm');
                        form.action = `/dashboard/achievements/${id}`;
                        form.submit();
                    }
                }
            }
        });

        // AJAX Functions
        async function ajaxNavigate(url) {
            const container = document.querySelector('#achievements-container');
            if (!container) return;

            container.style.opacity = '0.5';
            container.style.pointerEvents = 'none';

            try {
                const response = await fetch(url.toString(), {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                if (!response.ok) throw new Error(`HTTP ${response.status}`);

                const html = await response.text();
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                const newContainer = doc.querySelector('#achievements-container');
                if (newContainer) {
                    container.innerHTML = newContainer.innerHTML;
                }

                window.history.pushState({}, '', url.toString());
                afterSwap();
            } catch (err) {
                console.error('[ajax-nav] Navigation failed:', err);
            } finally {
                container.style.opacity = '';
                container.style.pointerEvents = '';
            }
        }

        function buildUrl(params) {
            const url = new URL(window.location.href);
            for (const [key, value] of Object.entries(params)) {
                if (value === null || value === '') {
                    url.searchParams.delete(key);
                } else {
                    url.searchParams.set(key, value);
                }
            }
            if (!('page' in params)) url.searchParams.delete('page');
            return url;
        }

        function afterSwap() {
            initPaginationLinks();
            bindEditModalsLogic();
            bindEmptyStateBtn();
        }

        function bindEmptyStateBtn() {
            const btnEmpty = document.getElementById('openCreateAchievementBtnEmpty');
            if (btnEmpty && !btnEmpty._bound) {
                btnEmpty._bound = true;
                btnEmpty.addEventListener('click', () => {
                    const modal = document.getElementById('createAchievementModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            }
        }

        function bindEditModalsLogic() {
            document.querySelectorAll('.edit-achievement-btn').forEach(button => {
                if (button._bound) return;
                button._bound = true;
                button.addEventListener('click', function(e) {
                    const btn = e.target.closest('.edit-achievement-btn');
                    const dataset = btn.dataset;

                    document.getElementById('editAchievementId').value = dataset.id;
                    document.getElementById('editAchievementTitle').value = dataset.title;
                    document.getElementById('editAchievementIssuer').value = dataset.issuer;
                    document.getElementById('editAchievementDate').value = dataset.date;
                    document.getElementById('editAchievementDesc').value = dataset.description;

                    const form = document.getElementById('editAchievementForm');
                    form.action = '/dashboard/achievements/' + dataset.id;

                    const placeholder = document.getElementById('placeholderEditAchievement');
                    const previewContainer = document.getElementById('previewEditAchievementContainer');
                    const previewImg = document.getElementById('previewEditAchievement');
                    const fileName = document.getElementById('fileNameEditAchievement');

                    if (dataset.image) {
                        previewImg.src = dataset.image;
                        fileName.innerText = dataset.imageName;
                        placeholder.classList.add('hidden');
                        previewContainer.classList.remove('hidden');
                    } else {
                        previewImg.src = '#';
                        fileName.innerText = '';
                        placeholder.classList.remove('hidden');
                        previewContainer.classList.add('hidden');
                    }

                    openModal(editModal);
                });
            });
        }

        bindEditModalsLogic();

        function initPaginationLinks() {
            const container = document.querySelector('#achievements-container');
            if (!container) return;

            if (container._paginationHandler) {
                container.removeEventListener('click', container._paginationHandler);
            }

            container._paginationHandler = function(e) {
                const anchor = e.target.closest('a[href]');
                if (!anchor) return;

                const href = anchor.getAttribute('href');
                if (!href || href === '#' || href.startsWith('javascript')) return;

                try {
                    const target = new URL(href, window.location.origin);
                    if (target.origin !== window.location.origin) return;
                    e.preventDefault();

                    const icon = anchor.querySelector('i');
                    if(icon && !icon.classList.contains('fa-spinner')) {
                        icon.className = 'fa-solid fa-spinner fa-spin text-primary text-[10px] sm:text-xs';
                        anchor.classList.add('pointer-events-none', 'opacity-70');
                    }

                    ajaxNavigate(target);
                } catch (err) {
                    console.error('[Pagination Error]', err);
                }
            };
            container.addEventListener('click', container._paginationHandler);
        }

        initPaginationLinks();

        // Search logic
        const searchInput = document.getElementById('achievement-search');
        if (searchInput) {
            let searchTimer;
            searchInput.addEventListener('input', () => {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(() => {
                    const url = buildUrl({ search: searchInput.value || null });
                    ajaxNavigate(url);
                }, 500);
            });
            searchInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimer);
                    const url = buildUrl({ search: searchInput.value || null });
                    ajaxNavigate(url);
                }
            });
        }

        // Sort logic
        const sortToggle = document.getElementById('sort-toggle');
        const sortMenu = document.getElementById('sort-menu');
        const sortOptions = document.querySelectorAll('.sort-option');
        const sortLabel = document.getElementById('sort-label');
        const sortChevron = document.getElementById('sort-chevron');

        if (sortToggle && sortMenu) {
            sortToggle.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const isHidden = sortMenu.classList.contains('hidden');
                if (isHidden) {
                    sortMenu.classList.remove('hidden');
                    if (sortChevron) sortChevron.classList.add('rotate-180');
                } else {
                    sortMenu.classList.add('hidden');
                    if (sortChevron) sortChevron.classList.remove('rotate-180');
                }
            });

            document.addEventListener('click', (e) => {
                if (!sortToggle.contains(e.target) && !sortMenu.contains(e.target)) {
                    sortMenu.classList.add('hidden');
                    if (sortChevron) sortChevron.classList.remove('rotate-180');
                }
            });

            sortOptions.forEach(option => {
                option.addEventListener('click', (e) => {
                    e.preventDefault();
                    const sortValue = option.dataset.sort;
                    const labelText = option.innerText || option.textContent;

                    if (sortLabel) sortLabel.textContent = labelText.trim();
                    sortMenu.classList.add('hidden');
                    if (sortChevron) sortChevron.classList.remove('rotate-180');

                    const url = buildUrl({ sort: sortValue });
                    ajaxNavigate(url);
                });
            });

            // Bulk Action logic
            const toggleSelectBtn = document.getElementById('toggleSelectMode');
            const bulkBar = document.getElementById('bulkBar');
            const cancelSelectBtn = document.getElementById('cancelSelect');
            const selectedCountText = document.getElementById('selectedCount');
            
            window.updateBulkBar = function() {
                const checkedCount = document.querySelectorAll('.bulk-checkbox:checked').length;
                if(checkedCount > 0) {
                    bulkBar.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-8');
                    bulkBar.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
                    if(selectedCountText) selectedCountText.innerText = checkedCount + ' TERPILIH';
                } else {
                    bulkBar.classList.add('opacity-0', 'pointer-events-none', 'translate-y-8');
                    bulkBar.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                }
            };

            if(toggleSelectBtn) {
                toggleSelectBtn.addEventListener('click', () => {
                    const isBulkNow = !{{ $isBulk ? 'true' : 'false' }};
                    const url = buildUrl({ bulk_mode: isBulkNow ? '1' : '0' });
                    // Use window.location.href to refresh correctly with the new server-side state
                    window.location.href = url.toString();
                });
            }

            if(cancelSelectBtn) {
                cancelSelectBtn.addEventListener('click', () => toggleSelectBtn.click());
            }

            document.body.addEventListener('change', (e) => {
                if(e.target.classList.contains('bulk-checkbox')) {
                    window.updateBulkBar();
                }
            });

            window.executeBulkAction = function(action) {
                const selected = document.querySelectorAll('.bulk-checkbox:checked');
                
                if (selected.length === 0) {
                    alert('Pilih setidaknya satu pencapaian terlebih dahulu.');
                    return;
                }

                const confirmModal = document.getElementById('confirm-modal');
                const confirmYes = document.getElementById('confirm-yes');
                const confirmCancel = document.getElementById('confirm-cancel');
                const confirmMessage = document.getElementById('confirm-message');
                const confirmBox = document.getElementById('confirm-box');

                if (confirmModal && confirmYes && confirmCancel) {
                    const msg = `Apakah Anda yakin ingin memindahkan ${selected.length} pencapaian ke tempat sampah?`;
                    
                    if (confirmMessage) confirmMessage.textContent = msg;

                    // Reset any previous listeners by cloning (simple way to avoid accumulation)
                    const newYes = confirmYes.cloneNode(true);
                    const newCancel = confirmCancel.cloneNode(true);
                    confirmYes.parentNode.replaceChild(newYes, confirmYes);
                    confirmCancel.parentNode.replaceChild(newCancel, confirmCancel);

                    // Show Modal
                    confirmModal.classList.remove('opacity-0', 'pointer-events-none');
                    confirmModal.classList.add('opacity-100', 'pointer-events-auto');
                    confirmModal.style.opacity = '1';
                    confirmModal.style.pointerEvents = 'auto';
                    
                    if(confirmBox) {
                        confirmBox.style.transform = 'scale(1) rotate(0deg)';
                        confirmBox.style.opacity = '1';
                    }

                    const cleanup = () => {
                        confirmModal.classList.add('opacity-0', 'pointer-events-none');
                        confirmModal.classList.remove('opacity-100', 'pointer-events-auto');
                        confirmModal.style.opacity = '0';
                        confirmModal.style.pointerEvents = 'none';
                        if(confirmBox) {
                            confirmBox.style.transform = 'scale(0.95) rotate(1deg)';
                            confirmBox.style.opacity = '0';
                        }
                    };

                    newYes.addEventListener('click', () => {
                        const form = document.getElementById('bulkActionForm');
                        form.innerHTML = '';
                        // Manual CSRF for safety in innerHTML
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = csrfToken;
                        form.appendChild(csrfInput);

                        selected.forEach(cb => {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'achievements[]';
                            input.value = cb.value;
                            form.appendChild(input);
                        });
                        form.action = '{{ route("dashboard.achievements.bulkTrash") }}';
                        form.submit();
                        cleanup();
                    });

                    newCancel.addEventListener('click', cleanup);
                    // Also close on backdrop click
                    const backdrop = document.getElementById('confirm-backdrop');
                    if(backdrop) backdrop.onclick = cleanup;
                } else {
                    // Fallback to native confirm if modal is missing for some reason
                    if (confirm(`Pindahkan ${selected.length} pencapaian ke tempat sampah?`)) {
                        const form = document.getElementById('bulkActionForm');
                        form.innerHTML = '';
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = csrfToken;
                        form.appendChild(csrfInput);

                        selected.forEach(cb => {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'achievements[]';
                            input.value = cb.value;
                            form.appendChild(input);
                        });
                        form.action = '{{ route("dashboard.achievements.bulkTrash") }}';
                        form.submit();
                    }
                }
            };
        }

        const currentSort = new URLSearchParams(window.location.search).get('sort') || 'latest';
        const activeOption = document.querySelector(`.sort-option[data-sort="${currentSort}"]`);
        if (activeOption && sortLabel) {
            sortLabel.textContent = activeOption.textContent.trim();
        }
    });
</script>
@endpush
