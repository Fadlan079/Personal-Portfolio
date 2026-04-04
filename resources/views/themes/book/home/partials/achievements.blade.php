<style>
    @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400;600;700&family=Merriweather:ital,wght@0,300;0,700;1,300&display=swap');

    .font-diary-body { font-family: 'Merriweather', serif; }
    .font-diary-accent { font-family: 'Caveat', cursive; }
</style>

<section id="achievements" class="py-24 px-5 max-w-6xl mx-auto relative z-10 font-sans">

    <div class="mb-16 md:px-4 text-center md:text-left">
        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-stone-500 mb-4">
            Milestones
        </h3>

        <h2 class="text-4xl md:text-5xl font-bold tracking-tight mb-3 text-text leading-tight">
            Sertifikat & Penghargaan
        </h2>

        <p class="text-stone-500 text-lg font-medium max-w-2xl mx-auto md:mx-0 italic font-diary-body">
            Rekam jejak, pencapaian, dan validasi dari perjalanan karir serta pembelajaran saya.
        </p>
    </div>
    <div id="achievements-container">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 md:gap-14 pt-6 mt-4">

            @forelse($achievements as $index => $ach)

                <div class="bg-surface border border-stone-300 rounded-sm shadow-sm p-5 relative group
                    transition-all duration-300 transform flex flex-col h-full
                    hover:-translate-y-2 hover:shadow-[8px_8px_25px_rgba(0,0,0,0.12)] hover:z-20

                    {{ $index % 3 === 1
                        ? 'md:scale-110 md:z-30 md:shadow-[12px_12px_30px_rgba(0,0,0,0.18)]'
                        : ''
                    }}"
                data-image="{{ $ach->image_url ? asset('storage/'.$ach->image_url) : '' }}">

                    <div class="absolute -top-3 left-6 w-8 h-10 border-2 border-stone-400/60 rounded-full z-10 rotate-12 pointer-events-none sticky-note-tape" style="clip-path: inset(0 0 50% 0);"></div>
                    <div class="absolute -top-3 left-6 w-8 h-10 border-2 border-stone-400/60 rounded-full z-0 rotate-12 pointer-events-none sticky-note-tape"></div>

                    @if(isset($ach->projects_count) && $ach->projects_count > 0)
                        <div class="absolute top-3 right-3 z-20">
                            <span class="inline-flex items-center gap-1 px-2 py-1 text-[10px] font-bold uppercase tracking-widest
                                bg-yellow-200 text-yellow-900 border border-yellow-400 rounded shadow-sm">

                                <i class="fa-solid fa-link text-[9px]"></i>
                                +{{ $ach->projects_count }}
                            </span>
                        </div>
                    @endif

                    <div class="flex gap-4 h-full flex-col mt-2">
                        @if($ach->image_url)
                            <div class="w-full h-48 bg-stone-200 border border-stone-300 rounded overflow-hidden">
                                <img src="{{ asset('storage/'.$ach->image_url) }}" alt="{{ $ach->title }}" class="w-full h-full object-cover filter contrast-[0.95] sepia-[0.1] group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @else
                            <div class="w-full h-48 bg-[#f5f5dc] border border-stone-300 rounded flex items-center justify-center flex-col gap-2 text-stone-400">
                                <i class="fa-solid fa-certificate text-5xl opacity-50 mb-2"></i>
                                <span class="text-xs font-bold uppercase tracking-widest opacity-50">No Certificate</span>
                            </div>
                        @endif

                        <div class="grow flex flex-col pt-3">
                            <h3 class="text-xl font-diary-body font-bold text-text line-clamp-2 mb-2" title="{{ $ach->title }}">
                                {{ $ach->title }}
                            </h3>

                            <div class="mt-auto space-y-3">
                                <div class="flex justify-between items-center text-sm font-diary-body text-stone-500">
                                    <span class="truncate pr-2"><i class="fa-solid fa-building mr-1.5 opacity-60"></i>{{ $ach->issuer ?? 'Anonim' }}</span>
                                    <span class="whitespace-nowrap"><i class="fa-regular fa-calendar mr-1.5 opacity-60"></i>{{ $ach->date ? \Carbon\Carbon::parse($ach->date)->format('M Y') : 'Unknown' }}</span>
                                </div>

                                @if(isset($ach->projects_count) && $ach->projects_count > 0)
                                    <div class="pt-3 border-t border-dashed border-stone-300">
                                        <span class="inline-block text-[10px] font-bold uppercase tracking-widest text-stone-600 bg-stone-200/50 px-2 py-1.5 rounded-sm">
                                            <i class="fa-solid fa-folder-open mr-1"></i> {{ $ach->projects_count }} Proyek Terkait
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="absolute bottom-0 right-0 w-6 h-6 bg-stone-200 border-t border-l border-stone-300 shadow-[-2px_-2px_4px_rgba(0,0,0,0.03)] z-10 transition-colors group-hover:bg-stone-300" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></div>

                </div>
            @empty
                <div class="col-span-full py-16 px-6 flex flex-col items-center justify-center text-center bg-[#fdfcf5] border-2 border-dashed border-[#e5e0d0] rounded-xl shadow-[4px_4px_0px_rgba(0,0,0,0.05)] relative overflow-hidden">
                    <div class="absolute inset-0 z-0 opacity-30" style="background-image: repeating-linear-gradient(transparent, transparent 24px, #e5e0d0 24px, #e5e0d0 25px);"></div>
                    <div class="relative z-20 space-y-3">
                        <i class="fa-solid fa-medal text-5xl text-stone-400/30 mb-2"></i>
                        <h3 class="text-3xl font-medium text-stone-900 font-diary-accent tracking-wide">Belum Ada Pencapaian</h3>
                        <p class="text-sm text-stone-500 max-w-sm mx-auto italic font-diary-body opacity-90">Daftar sertifikat atau penghargaan akan ditampilkan di sini setelah ditambahkan.</p>
                    </div>
                </div>
            @endforelse

        </div>

        @if ($achievements instanceof \Illuminate\Pagination\LengthAwarePaginator && $achievements->hasPages())
            <div class="flex justify-center pt-12 md:pt-16 pb-8">
                <nav class="flex flex-wrap sm:flex-nowrap items-center justify-center gap-3 sm:gap-4 font-mono w-full sm:w-auto px-4">

                    {{-- Previous --}}
                    @if ($achievements->onFirstPage())
                        <span class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-stone-300 flex items-center justify-center text-stone-400 opacity-30 cursor-not-allowed bg-white">
                            <i class="fa-solid fa-chevron-left text-[10px] sm:text-xs"></i>
                        </span>
                    @else
                        <a href="{{ $achievements->previousPageUrl() }}"
                        class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-stone-300 flex items-center justify-center text-stone-600 hover:border-yellow-600 hover:text-yellow-700 hover:-translate-y-0.5 transition-all shadow-sm bg-white">
                            <i class="fa-solid fa-chevron-left text-[10px] sm:text-xs"></i>
                        </a>
                    @endif

                    {{-- Page Indicator --}}
                    <div class="px-4 py-1.5 sm:px-6 sm:py-2 bg-yellow-100 border-2 border-yellow-500 rounded-full shadow-[2px_2px_0px_rgba(0,0,0,0.1)] rotate-1 shrink-0">
                        <span class="text-[10px] sm:text-xs font-black text-yellow-900 uppercase tracking-widest whitespace-nowrap">
                            {{ sprintf('%02d', $achievements->currentPage()) }}
                            <span class="opacity-50 mx-1">/</span>
                            {{ sprintf('%02d', $achievements->lastPage()) }}
                        </span>
                    </div>

                    {{-- Next --}}
                    @if ($achievements->hasMorePages())
                        <a href="{{ $achievements->nextPageUrl() }}"
                        class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-stone-300 flex items-center justify-center text-stone-600 hover:border-yellow-600 hover:text-yellow-700 hover:-translate-y-0.5 transition-all shadow-sm bg-white">
                            <i class="fa-solid fa-chevron-right text-[10px] sm:text-xs"></i>
                        </a>
                    @else
                        <span class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-stone-300 flex items-center justify-center text-stone-400 opacity-30 cursor-not-allowed bg-white">
                            <i class="fa-solid fa-chevron-right text-[10px] sm:text-xs"></i>
                        </span>
                    @endif

                </nav>
            </div>
        @endif
    </div>
</section>

<div id="imageLightbox"
     class="fixed inset-0 z-70 hidden items-center justify-center bg-black/80 backdrop-blur-sm">

    <button id="lightboxClose"
            class="absolute top-6 right-6 md:top-8 md:right-8 text-stone-400 hover:text-[#FCFAEF] transition-colors z-50 text-3xl font-light">
        ✕
    </button>

    <button id="lightboxPrev"
            class="hidden absolute left-4 md:left-8 z-50 items-center justify-center w-12 h-12 md:w-14 md:h-14 rounded-full bg-[#FCFAEF] text-stone-800 hover:bg-stone-200 transition-all hover:-translate-x-1 shadow-[0_4px_15px_rgba(0,0,0,0.3)] border border-stone-300">
        <i class="fa-solid fa-chevron-left text-lg md:text-xl relative -left-0.5"></i>
    </button>

    <button id="lightboxNext"
            class="hidden absolute right-4 md:right-8 z-50 items-center justify-center w-12 h-12 md:w-14 md:h-14 rounded-full bg-[#FCFAEF] text-stone-800 hover:bg-stone-200 transition-all hover:translate-x-1 shadow-[0_4px_15px_rgba(0,0,0,0.3)] border border-stone-300">
        <i class="fa-solid fa-chevron-right text-lg md:text-xl relative -right-0.5"></i>
    </button>
    <div class="relative z-40 bg-[#FCFAEF] p-2 md:p-4 shadow-[0_12px_40px_rgba(0,0,0,0.5)] border border-stone-300">
        <div class="absolute -top-3 left-1/2 w-16 h-6 bg-white/30 backdrop-blur-sm -translate-x-1/2 shadow-sm transform -rotate-2 border border-stone-200/50"></div>
        
        <img id="lightboxImage"
            class="max-w-[90vw] max-h-[85vh] object-contain rounded shadow-lg">
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const container = document.getElementById('achievements-container');
    const lightbox = document.getElementById('imageLightbox');
    const img = document.getElementById('lightboxImage');
    const btnPrev = document.getElementById('lightboxPrev');
    const btnNext = document.getElementById('lightboxNext');
    const btnClose = document.getElementById('lightboxClose');

    if (!container) return;

    let images = [];
    let currentIndex = 0;

    // =========================
    // COLLECT IMAGES
    // =========================
    function refreshImages() {
        images = [...container.querySelectorAll('[data-image]')]
            .map(el => el.dataset.image)
            .filter(src => src && src.trim() !== '');
    }

    function showImage(index) {
        if (!images.length) return;

        currentIndex = index;
        img.src = images[currentIndex];

        btnPrev.style.display = currentIndex > 0 ? 'flex' : 'none';
        btnNext.style.display = currentIndex < images.length - 1 ? 'flex' : 'none';
    }

    // =========================
    // MAIN CLICK HANDLER
    // =========================
    container.addEventListener('click', async function(e) {

        // =====================
        // 1. PAGINATION AJAX
        // =====================
        const paginationLink = e.target.closest('nav a[href]');
        if (paginationLink) {
            const url = new URL(paginationLink.href);

            if (!url.searchParams.has('page')) return;

            e.preventDefault();

            try {
                container.style.opacity = '0.5';
                container.style.pointerEvents = 'none';

                const response = await fetch(url.toString(), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) throw new Error('Failed request');

                const html = await response.text();

                container.innerHTML = html;

                window.history.pushState({}, '', url);

            } catch (err) {
                console.error('Pagination AJAX error:', err);
            } finally {
                container.style.opacity = '';
                container.style.pointerEvents = '';
            }

            return; // ⛔ stop supaya ga lanjut ke lightbox
        }

        // =====================
        // 2. LIGHTBOX OPEN
        // =====================
        const card = e.target.closest('[data-image]');
        if (!card) return;

        const image = card.dataset.image;
        if (!image) return;

        refreshImages();

        const index = images.indexOf(image);
        if (index === -1) return;

        showImage(index);

        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
    });

    // =========================
    // LIGHTBOX NAVIGATION
    // =========================
    btnPrev?.addEventListener('click', () => {
        if (currentIndex > 0) showImage(currentIndex - 1);
    });

    btnNext?.addEventListener('click', () => {
        if (currentIndex < images.length - 1) showImage(currentIndex + 1);
    });

    // =========================
    // CLOSE LIGHTBOX
    // =========================
    btnClose?.addEventListener('click', () => {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
    });

    lightbox?.addEventListener('click', (e) => {
        if (e.target === lightbox) {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
        }
    });

    // =========================
    // BACK BUTTON SUPPORT
    // =========================
    window.addEventListener('popstate', async () => {
        try {
            const response = await fetch(window.location.href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const html = await response.text();
            container.innerHTML = html;

        } catch (err) {
            console.error('Popstate load error:', err);
        }
    });

});
</script>
