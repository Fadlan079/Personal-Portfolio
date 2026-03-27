@extends('layouts.main')
@section('title', 'Project')
@vite(['resources/css/project.css'])

@section('content')
    <style>
        .diary-page { border-radius: 1rem; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <div class="relative min-h-screen bg-bg overflow-hidden font-sans text-text">
        <div class="absolute inset-0 pointer-events-none opacity-[0.03] z-0"
            style="background-image: radial-gradient(var(--color-text) 1px, transparent 1px); background-size: 24px 24px;">
        </div>

        <section class="relative z-10 pt-32 pb-16 max-w-7xl mx-auto px-6 space-y-6">

            <div class="relative inline-flex items-center gap-2 py-1.5 pl-8 pr-6 transition-all duration-300 w-max group hover:-translate-y-0.5 hover:rotate-1"
                style="filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.06));">

                <div class="absolute inset-0 bg-warning border border-yellow-500 rounded-l-md z-0 transition-colors"
                    style="clip-path: polygon(0 0, 100% 0, 92% 50%, 100% 100%, 0 100%);">
                </div>

                <div class="absolute top-1/2 -left-4 w-6 h-[1.5px] bg-[#8B0000]/80 -translate-y-[calc(50%+1px)] origin-right -rotate-12 group-hover:-rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>
                <div class="absolute top-1/2 -left-3 w-5 h-[1.5px] bg-[#B22222]/80 -translate-y-[calc(50%-1px)] origin-right rotate-12 group-hover:rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>

                <div class="absolute left-2.5 top-1/2 -translate-y-1/2 w-2.5 h-2.5 rounded-full bg-surface shadow-[inset_1px_1px_3px_rgba(0,0,0,0.3)] border border-yellow-700/30 z-10"></div>

                <i class="fa-regular fa-folder-open relative z-10 text-yellow-800 text-[11px] mt-px"></i>

                <span class="relative z-10 text-[10px] sm:text-xs font-black tracking-[0.15em] uppercase text-yellow-900 mt-px"
                data-i18n="project.header.label">
                    Arsip Proyek
                </span>
            </div>

            <h1 class="text-[clamp(3rem,8vw,6rem)] font-bold tracking-tighter leading-[1.05] text-text">
                <span class="block" data-i18n="project.header.main_title">Daftar Proyek.</span>
                <span class="block text-muted mt-2 text-[clamp(2rem,5vw,3.5rem)]" data-i18n="project.header.subtitle">Karya & Eksplorasi</span>
            </h1>

            <p class="text-base md:text-lg text-muted max-w-2xl leading-relaxed font-medium" data-i18n="project.header.description">
                Kumpulan dokumentasi dari aplikasi web, sistem informasi, dan eksperimen antarmuka yang telah saya rancang dan kembangkan.
            </p>
        </section>

        <section class="relative z-20 max-w-7xl mx-auto px-6 py-10 space-y-12">

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
                <div class="bg-sky-100 p-6 rounded-sm shadow-md border border-border flex flex-col justify-between relative group/tooltip rotate-1 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>

                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                        <i class="fa-solid fa-layer-group text-sky-700"></i>
                        <span data-i18n="project.stats.totalProjects">Total Proyek</span>
                    </p>
                    <h3 class="text-4xl font-bold text-black relative z-10">{{ $summary['totalProjects'] }}</h3>
                </div>

                <div class="bg-indigo-100 p-6 rounded-sm shadow-md border border-border flex flex-col justify-between relative group/tooltip rotate-2 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>

                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                        <i class="fa-solid fa-tags text-indigo-500"></i>
                        <span data-i18n="project.stats.totalCategories">Total Kategori</span>
                    </p>
                    <h3 class="text-4xl font-bold text-black relative z-10">{{ $summary['totalCategories'] }}</h3>
                </div>

                <div class="bg-green-100 p-6 rounded-sm shadow-md border border-border flex flex-col justify-between relative group/tooltip rotate--1 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>

                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                        <i class="fa-solid fa-circle-check text-green-700"></i>
                        <span data-i18n="project.stats.finished">Selesai</span>
                    </p>
                    <h3 class="text-4xl font-bold text-black relative z-10">{{ $summary['statusBreakdown']['Finished'] ?? 0 }}</h3>
                </div>
                <div class="bg-amber-100 p-6 rounded-sm shadow-md border border-border flex flex-col justify-between relative group/tooltip rotate--1 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>

                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                        <i class="fa-solid fa-spinner text-amber-700"></i>
                        <span data-i18n="project.stats.inProgress">Dalam Proses</span>
                    </p>
                    <h3 class="text-4xl font-bold text-black relative z-10">{{ $summary['statusBreakdown']['In Progress'] ?? 0 }}</h3>
                </div>
            </div>

            <div class="bg-surface border-2 border-dashed border-border shadow-sm rounded-2xl p-5 md:p-6 space-y-6 font-sans relative">

                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-20 h-6 bg-muted opacity-20 backdrop-blur-sm -rotate-2" style="clip-path: polygon(5% 0, 100% 5%, 95% 100%, 0 95%); z-index: 10;"></div>

                <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-5 border-b-2 border-dashed border-border/50 pb-6 relative z-20">

                    <div class="relative w-full md:w-1/2 group">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-muted group-focus-within:text-primary transition-colors"></i>
                        <input type="text" id="project-search" placeholder="{{ $projectPlaceholders }}"
                            class="w-full border-2 border-border bg-container rounded-lg px-4 py-3 pl-11 text-sm font-medium text-text placeholder:text-muted placeholder:italic placeholder:font-serif focus:outline-none focus:border-primary focus:ring-0 transition-all shadow-inner"
                            style="background-image: repeating-linear-gradient(transparent, transparent 27px, var(--color-border) 27px, var(--color-border) 28px); line-height: 28px; background-attachment: local;" />
                    </div>

                    <div class="relative z-40">
                        <button id="sort-toggle"
                            class="w-full md:w-auto flex justify-between items-center gap-6 px-5 py-3 border-2 border-border bg-container rounded-lg text-xs font-bold uppercase tracking-widest text-text hover:border-primary hover:text-primary hover:-translate-y-0.5 transition-all shadow-[3px_3px_0px_var(--color-border)] focus:outline-none">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-arrow-down-short-wide"></i>
                                <span id="sort-label" data-i18n="project.sort.menu.latest">Terbaru</span>
                            </span>
                            <i class="fa-solid fa-chevron-down text-[10px]" id="sort-chevron"></i>
                        </button>

                        <div id="sort-menu"
                            class="hidden absolute right-0 top-full mt-3 w-full min-w-[12rem] bg-surface rounded-lg border-2 border-border shadow-[4px_4px_0px_var(--color-border)] overflow-hidden">
                            <button class="sort-option w-full text-left px-5 py-3 text-xs font-bold uppercase tracking-widest text-muted hover:bg-container hover:text-text transition-colors border-b-2 border-dashed border-border/50" data-sort="latest"
                            data-i18n="project.sort.menu.latest">
                                Terbaru
                            </button>
                            <button class="sort-option w-full text-left px-5 py-3 text-xs font-bold uppercase tracking-widest text-muted hover:bg-container hover:text-text transition-colors" data-sort="oldest"
                            data-i18n="project.sort.menu.oldest">
                                Terlama
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex overflow-x-auto no-scrollbar gap-4 pb-4 pt-2 px-2 -mx-2">

                    <button class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none bg-warning text-yellow-900 border-2 border-yellow-500 shadow-[2px_3px_0px_var(--color-border)] -translate-y-1 rotate-1" data-filter="all"
                    data-i18n="project.filter.all">
                        Semua
                    </button>

                    <button class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest text-muted bg-container border-2 border-border shadow-[1px_2px_0px_var(--color-border)] hover:shadow-[3px_4px_0px_var(--color-border)] hover:-translate-y-1 hover:-rotate-1 transition-all focus:outline-none" data-filter="Website"
                    data-i18n="project.filter.website">
                        Website
                    </button>

                    <button class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest text-muted bg-container border-2 border-border shadow-[1px_2px_0px_var(--color-border)] hover:shadow-[3px_4px_0px_var(--color-border)] hover:-translate-y-1 hover:rotate-1 transition-all focus:outline-none" data-filter="Application"
                    data-i18n="project.filter.application">
                        Aplikasi
                    </button>

                    <button class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest text-muted bg-container border-2 border-border shadow-[1px_2px_0px_var(--color-border)] hover:shadow-[3px_4px_0px_var(--color-border)] hover:-translate-y-1 hover:-rotate-1 transition-all focus:outline-none" data-filter="Design"
                    data-i18n="project.filter.design">
                        Desain
                    </button>

                </div>
            </div>

            <div id="projects-grid">
                @include('themes.book.project.partials.project-list')
            </div>

            <div id="projects-pagination">
                @include('themes.book.project.partials.project-pagination')
            </div>

        </section>

        <section class="relative py-16 border-t border-border/50 text-center">

            <div class="w-2 h-2 bg-muted rounded-full mx-auto mb-6"></div>

            <h3 class="text-sm font-bold uppercase tracking-widest text-muted mb-2" data-i18n="project.notes.title">
                Project Notes
            </h3>

            <p class="text-xs text-muted/70" data-i18n="project.notes.description">
                Detail proyek dan pembaruan akan terus dikembangkan.
            </p>

            <a href="#top"
            class="mt-8 inline-flex items-center justify-center w-12 h-12 bg-surface rounded-full border border-border shadow-sm text-muted hover:text-text hover:-translate-y-1 transition-all">
                <i class="fa-solid fa-arrow-up text-sm"></i>
            </a>

        </section>

    </div>

@endsection

<x-project.detail-modal />

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const initProjectSliders = () => {
                document.querySelectorAll('.project-slider').forEach(slider => {
                    const slides = slider.querySelectorAll('.slide');
                    if (slides.length <= 1) return;

                    let index = 0;
                    let interval = null;

                    function showSlide(i) {
                        slides.forEach((slide, k) => {
                            slide.classList.toggle('opacity-100', k === i);
                            slide.classList.toggle('opacity-0', k !== i);
                        });
                    }

                    function startSlider() {
                        if (interval) return;
                        interval = setInterval(() => {
                            index = (index + 1) % slides.length;
                            showSlide(index);
                        }, 1500);
                    }

                    function stopSlider() {
                        clearInterval(interval);
                        interval = null;
                        index = 0;
                        showSlide(index);
                    }

                    if (!slider.dataset.sliderInit) {
                        slider.addEventListener('mouseenter', startSlider);
                        slider.addEventListener('mouseleave', stopSlider);
                        slider.dataset.sliderInit = 'true';
                    }
                });
            };

            initProjectSliders();

            document.body.addEventListener('projects-loaded', () => {
                initProjectSliders();
            });

            window.openProjectModal = function() {
                const modal = document.getElementById('projectDetailModal');
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }
            };

            window.closeProjectModal = function() {
                const modal = document.getElementById('projectDetailModal');
                if (modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.classList.remove('overflow-hidden');
                }
            };

            const detailModal = document.getElementById('projectDetailModal');
            if(detailModal) {
                detailModal.addEventListener('click', (e) => {
                    if (e.target === detailModal) window.closeProjectModal();
                });
            }
        });
    </script>


    @vite(['resources/js/project/filters.js', 'resources/js/project/detail-modal.js'])
@endpush
