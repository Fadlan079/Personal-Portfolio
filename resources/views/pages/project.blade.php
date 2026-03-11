@extends('layouts.main')
@section('title', 'Projects')
@vite(['resources/css/project.css'])

@section('content')
    <div class="relative min-h-screen bg-background overflow-hidden font-sans">
        <div class="absolute inset-0 pointer-events-none opacity-[0.02] z-0"
            style="background-image: linear-gradient(var(--color-text) 1px, transparent 1px), linear-gradient(90deg, var(--color-text) 1px, transparent 1px); background-size: 64px 64px;">
        </div>

        <section id="projects-hero" class="relative z-10 pt-32 pb-16 max-w-7xl mx-auto px-6 space-y-8">

            <div class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-widest text-primary mb-4">
                <span class="w-2 h-2 bg-primary animate-pulse shadow-[0_0_8px_var(--color-primary)]"></span>
                >> SYS_DIR / PUBLIC / PORTFOLIO_NODES
            </div>

            <h1
                class="text-[clamp(3.5rem,9vw,7rem)] font-bold font-mono tracking-tighter leading-[1] uppercase flex flex-col md:flex-row md:items-end gap-2 md:gap-6">
                <div>
                    <span class="text-text block" data-i18n="project.hero.title"></span>
                    <span class="block text-muted/50 text-[clamp(2rem,5vw,4rem)]" data-i18n="project.hero.subtitle"></span>
                </div>

                <div class="hidden md:block w-6 h-16 bg-primary animate-pulse mb-3 shadow-[0_0_15px_var(--color-primary)]">
                </div>
            </h1>

            <p class="text-sm md:text-base font-mono text-muted max-w-2xl leading-relaxed border-l-2 border-primary/50 pl-4"
                data-i18n="project.hero.description"></p>

            <div class="text-[10px] font-mono uppercase tracking-widest text-muted/70 bg-surface/30 w-max px-3 py-1 border border-border/50"
                data-i18n="project.hero.note"></div>
        </section>

        <section id="projects-index" class="relative z-10 max-w-7xl mx-auto px-6 py-16 space-y-12">

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-primary/50 transition-colors">
                    <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-primary/50"></div>
                    <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-primary/50"></div>
                    <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-database text-primary"></i> <span
                            data-i18n="project.index.summary.projects">Total_Nodes</span>
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-text">
                        {{ str_pad($summary['totalProjects'], 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-sky-400/50 transition-colors">
                    <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-sky-400/50"></div>
                    <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-sky-400/50"></div>
                    <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-tags text-sky-400"></i> <span
                            data-i18n="project.index.summary.categories">Categories</span>
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-sky-400">
                        {{ str_pad($summary['totalCategories'], 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-green-400/50 transition-colors">
                    <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-green-400/50"></div>
                    <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-green-400/50"></div>
                    <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-circle-play text-green-400"></i> <span
                            data-i18n="project.index.summary.active">Active_Sync</span>
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-green-400">
                        {{ str_pad($summary['activeCount'], 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-amber-400/50 transition-colors">
                    <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-amber-400/50"></div>
                    <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-amber-400/50"></div>
                    <div class="flex justify-between items-start mb-2">
                        <p class="text-[9px] font-mono uppercase tracking-widest text-muted flex items-center gap-2">
                            <i class="fa-solid fa-pause-circle text-amber-400"></i> Archive_Queue
                        </p>
                        @if ($summary['inactiveCount'] > 0)
                            <div class="relative group/tooltip cursor-help">
                                <i
                                    class="fa-solid fa-circle-info text-muted hover:text-amber-400 transition-colors text-[10px]"></i>
                                <div
                                    class="absolute right-0 top-full mt-2 w-max bg-[#0a0a0a] border border-border/50 p-3 opacity-0 pointer-events-none group-hover/tooltip:opacity-100 transition-opacity z-50 text-[10px] font-mono text-muted space-y-1 shadow-xl">
                                    <div><span class="text-text"
                                            data-i18n="project.index.summary.status.shipped">Shipped</span>: <span
                                            class="text-primary">{{ $summary['statusBreakdown']['Shipped'] }}</span></div>
                                    <div><span class="text-text" data-i18n="project.index.summary.status.in_progress">In
                                            Progress</span>: <span
                                            class="text-amber-400">{{ $summary['statusBreakdown']['In Progress'] }}</span>
                                    </div>
                                    <div><span class="text-text"
                                            data-i18n="project.index.summary.status.prototype">Prototype</span>: <span
                                            class="text-sky-400">{{ $summary['statusBreakdown']['Prototype'] }}</span></div>
                                    <div><span class="text-text"
                                            data-i18n="project.index.summary.status.archived">Archived</span>: <span
                                            class="text-red-400">{{ $summary['statusBreakdown']['Archived'] }}</span></div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <h3 class="text-3xl font-mono font-bold text-amber-400">
                        {{ str_pad($summary['inactiveCount'], 2, '0', STR_PAD_LEFT) }}</h3>
                </div>
            </div>

            <div class="relative border border-border/50 bg-surface/10 p-4 md:p-6 space-y-6">
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4 border-b border-border/50 pb-6">

                    <div class="relative w-full md:w-1/2 group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 font-mono text-primary text-sm">></div>
                        <input type="text" id="project-search" placeholder="SEARCH_PROJECT_NODES_"
                            class="w-full border border-border/70 bg-surface/30 px-4 py-3 pl-8 font-mono text-xs uppercase tracking-widest text-text placeholder:text-muted/50 focus:outline-none focus:border-primary focus:bg-primary/5 transition-colors" />
                        <div
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-1.5 h-3 bg-primary/30 group-focus-within:bg-primary group-focus-within:animate-pulse pointer-events-none">
                        </div>
                    </div>

                    <div class="relative" id="sort-dropdown-wrapper">
                        <button id="sort-toggle"
                            class="w-full md:w-auto flex justify-between items-center gap-4 px-6 py-3 border border-border/70 bg-surface/30 font-mono text-[10px] font-bold uppercase tracking-widest text-muted hover:border-primary hover:text-primary transition-colors focus:outline-none">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-sort"></i>
                                <span id="sort-label">SORT: NEWEST</span>
                            </span>
                            <i class="fa-solid fa-chevron-down text-[10px]" id="sort-chevron"></i>
                        </button>

                        <div id="sort-menu"
                            class="hidden absolute right-0 top-full mt-2 w-full min-w-[12rem] bg-[#0a0a0a]/95 backdrop-blur-md border border-primary/50 shadow-[0_0_20px_rgba(var(--color-primary-rgb),0.1)] z-50">
                            <button
                                class="sort-option w-full text-left px-5 py-3 font-mono text-[10px] uppercase tracking-widest text-muted hover:bg-primary/10 hover:text-primary transition-colors border-b border-border/50"
                                data-sort="latest">
                                > NEWEST_FIRST
                            </button>
                            <button
                                class="sort-option w-full text-left px-5 py-3 font-mono text-[10px] uppercase tracking-widest text-muted hover:bg-primary/10 hover:text-primary transition-colors"
                                data-sort="oldest">
                                > OLDEST_FIRST
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-2 pb-2">
                    <button
                        class="filter-btn px-5 py-2 border font-mono text-[10px] font-bold uppercase tracking-widest transition-colors focus:outline-none border-primary bg-primary/10 text-primary"
                        data-filter="all">[ ALL ]</button>
                    <button
                        class="filter-btn px-5 py-2 border border-border font-mono text-[10px] font-bold uppercase tracking-widest text-muted hover:border-primary transition-colors focus:outline-none"
                        data-filter="Website">[ WEBSITE ]</button>
                    <button
                        class="filter-btn px-5 py-2 border border-border font-mono text-[10px] font-bold uppercase tracking-widest text-muted hover:border-primary transition-colors focus:outline-none"
                        data-filter="Application">[ APPLICATION ]</button>
                    <button
                        class="filter-btn px-5 py-2 border border-border font-mono text-[10px] font-bold uppercase tracking-widest text-muted hover:border-primary transition-colors focus:outline-none"
                        data-filter="Design">[ DESIGN ]</button>
                </div>
            </div>

            <div id="projects-grid"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 transition-opacity duration-300 min-h-[400px]">
                @forelse ($projects as $project)

                    <div class="project-folder group relative border border-border bg-surface p-6 pt-12 ">
                        <div class="absolute top-0 left-6 -translate-y-1/2 flex gap-2 z-20">
                            <span class="px-4 py-1 text-xs uppercase tracking-widest badge-primary font-semibold">
                                {{ $project->type }}
                            </span>
                            <span class="px-3 py-1 text-[10px] uppercase tracking-wide border {{ $project->statusClass }}">
                                {{ $project->status }}
                            </span>
                        </div>

                        <div class="folder-files absolute inset-0 pointer-events-none z-0">
                            <span class="file"></span>
                            <span class="file"></span>

                            <a href="javascript:void(0)"
                                class="file file-front pointer-events-auto p-5 flex flex-col gap-3 project-open"
                                data-id="{{ $project->id }}" data-title="{{ $project->title }}"
                                data-desc="{{ $project->desc }}" data-type="{{ $project->type }}"
                                data-status="{{ $project->status }}"
                                data-created="{{ $project->created_at->format('d M Y') }}"
                                data-updated="{{ $project->updated_at->format('d M Y') }}"
                                data-repo="{{ $project->repo }}" data-role="{{ $project->role }}"
                                data-team="{{ $project->team_size }}"
                                data-responsibilities="{{ $project->responsibilities }}"
                                data-live="{{ $project->live_url }}" data-screenshot='@json($project->screenshot ? collect($project->screenshot)->map(fn($img) => asset('storage/' . $img))->values() : [])'
                                data-tech='@json($project->tech)'>
                                <div>
                                    <h3 class="text-xl font-semibold leading-tight">
                                        {{ $project->title }}
                                    </h3>

                                    <p class="text-sm text-muted leading-snug mt-1 line-clamp-2">
                                        {{ \Illuminate\Support\Str::limit($project->desc, 100) }}
                                    </p>
                                </div>

                                <div class="tech-row">
                                    @foreach ($project->visibleTechs as $tech)
                                        <span>{{ strtoupper($tech) }}</span>
                                    @endforeach

                                    @if (count($project->extraTechs) > 0)
                                        <span class="tech-more">
                                            +{{ count($project->extraTechs) }}
                                            <span class="tech-tooltip">
                                                @foreach ($project->extraTechs as $extra)
                                                    {{ $extra }}<br>
                                                @endforeach
                                            </span>
                                        </span>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full border border-border/50 bg-surface/10 py-20 px-6 flex flex-col items-center justify-center text-center relative overflow-hidden group">
                        <div
                            class="absolute inset-0 bg-[repeating-linear-gradient(45deg,transparent,transparent_10px,rgba(255,255,255,0.01)_10px,rgba(255,255,255,0.01)_20px)] pointer-events-none">
                        </div>

                        <i class="fa-solid fa-ghost text-5xl text-muted/30 mb-6 group-hover:animate-bounce"></i>

                        <p class="text-[10px] uppercase tracking-widest text-muted font-mono mb-4">
                            > SYS_ALERT
                        </p>

                        <h3 class="text-xl font-mono font-bold uppercase tracking-widest text-text max-w-xl">
                            NO_RECORDS_FOUND
                        </h3>

                        <p class="mt-3 text-xs font-mono text-muted/70 max-w-md leading-relaxed">
                            Current query parameters yielded zero results from the database matrix.
                        </p>

                        <button id="reset-filters-btn"
                            class="mt-8 px-6 py-3 bg-primary/10 border border-primary text-primary hover:bg-primary hover:text-background transition-colors text-[10px] font-mono font-bold uppercase tracking-widest flex items-center gap-3 relative z-10 shadow-[0_0_15px_rgba(var(--color-primary-rgb),0.15)]">
                            <i class="fa-solid fa-rotate-right"></i>
                            <span>FLUSH_FILTERS</span>
                        </button>
                    </div>
                @endforelse
            </div>

            @if ($projects->hasPages())
                <div class="flex justify-center pt-8" id="projects-pagination">
                    <nav class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-widest">

                        @if ($projects->onFirstPage())
                            <span
                                class="px-4 py-2 text-muted border border-border/50 bg-surface/30 opacity-50 cursor-not-allowed">[
                                PREV ]</span>
                        @else
                            <a href="javascript:void(0)" data-page="{{ $projects->currentPage() - 1 }}"
                                class="ajax-page px-4 py-2 border border-border text-muted hover:border-primary hover:text-primary transition-colors">[
                                PREV ]</a>
                        @endif

                        <span class="px-4 py-2 border border-primary bg-primary/5 text-primary font-bold">
                            PG_{{ sprintf('%02d', $projects->currentPage()) }} /
                            {{ sprintf('%02d', $projects->lastPage()) }}
                        </span>

                        @if ($projects->hasMorePages())
                            <a href="javascript:void(0)" data-page="{{ $projects->currentPage() + 1 }}"
                                class="ajax-page px-4 py-2 border border-border text-muted hover:border-primary hover:text-primary transition-colors">[
                                NEXT ]</a>
                        @else
                            <span
                                class="px-4 py-2 text-muted border border-border/50 bg-surface/30 opacity-50 cursor-not-allowed">[
                                NEXT ]</span>
                        @endif

                    </nav>
                </div>
            @else
                <div id="projects-pagination"></div>
            @endif

        </section>

        <section id="projects-end" class="relative py-24 border-t border-border/50 overflow-hidden bg-surface/5">
            <div
                class="absolute left-0 bottom-0 opacity-[0.05] pointer-events-none -translate-x-1/4 translate-y-1/4 text-primary">
                <svg width="400" height="400" viewBox="0 0 100 100" fill="none" stroke="currentColor">
                    <rect x="20" y="20" width="60" height="60" stroke-width="0.5" stroke-dasharray="2 2" />
                    <circle cx="50" cy="50" r="30" stroke-width="0.5" />
                    <line x1="20" y1="20" x2="80" y2="80" stroke-width="0.5" />
                    <line x1="80" y1="20" x2="20" y2="80" stroke-width="0.5" />
                    <circle cx="50" cy="50" r="45" stroke-width="0.2" stroke-dasharray="1 3" />
                </svg>
            </div>

            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="flex justify-between items-end border-b border-border/40 pb-6 mb-10">
                    <div class="flex items-center gap-2 text-[10px] font-mono uppercase tracking-widest text-primary">
                        <span class="w-1.5 h-1.5 bg-primary"></span>
                        SYS_EOF // END_OF_FILE
                    </div>
                    <p class="text-[9px] font-mono uppercase tracking-[0.2em] text-muted hidden md:block border border-border/50 px-2 py-1 bg-surface/30"
                        data-i18n="project.end.tags">
                        SYSTEMS_·_INTERFACES_·_TOOLS
                    </p>
                </div>

                <div class="grid md:grid-cols-[1fr_auto] gap-10 items-end">
                    <div>
                        <h3 id="projects-end-title" data-i18n="project.end.title"
                            class="text-[clamp(2rem,5vw,3.5rem)] font-bold font-mono uppercase tracking-tighter text-text leading-[1.1] mb-4">
                            AWAITING_NEW_INPUT
                        </h3>
                        <p class="text-sm font-mono text-muted max-w-xl leading-relaxed border-l border-primary/30 pl-4"
                            data-i18n="project.end.description">
                            Further system integration is possible. Contact administrator to initialize new project modules.
                        </p>
                    </div>

                    <div class="hidden md:flex flex-col items-center">
                        <a href="#projects-hero"
                            class="group flex items-center justify-center w-14 h-14 border border-border bg-surface/30 hover:bg-primary/10 hover:border-primary transition-all duration-300 relative">
                            <div
                                class="absolute top-0 left-0 w-1.5 h-1.5 border-t border-l border-primary/50 group-hover:border-primary transition-colors">
                            </div>
                            <div
                                class="absolute bottom-0 right-0 w-1.5 h-1.5 border-b border-r border-primary/50 group-hover:border-primary transition-colors">
                            </div>

                            <i
                                class="fa-solid fa-arrow-up text-muted group-hover:text-primary transition-all duration-300 group-hover:-translate-y-1"></i>
                        </a>
                        <span class="mt-4 text-[9px] font-mono uppercase tracking-widest text-muted"
                            data-i18n="project.end.back_to_top">[ EXEC_RETURN_TOP ]</span>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection

<x-project.detail-modal />

@push('script')
    <script>
        // Provide the global functions expected by detail-modal.js
        window.openProjectModal = function() 
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

        window.openLightbox = function(src) {
            const lightbox = document.getElementById('imageLightbox');
            const lightboxImg = document.getElementById('lightboxImage');
            if (lightbox && lightboxImg) {
                lightboxImg.src = src;
                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');
            }
        };

        window.closeLightbox = function() {
            const lightbox = document.getElementById('imageLightbox');
            if (lightbox) {
                lightbox.classList.add('hidden');
                lightbox.classList.remove('flex');
            }
        };

        // Attach close event to modal background and close button
        document.addEventListener('DOMContentLoaded', () => {
             const detailModal = document.getElementById('projectDetailModal');
             const closeBtn = document.getElementById('detailModalClose');

             if(closeBtn) {
                 closeBtn.addEventListener('click', window.closeProjectModal);
             }

             if(detailModal) {
                 detailModal.addEventListener('click', (e) => {
                     if (e.target === detailModal) {
                         window.closeProjectModal();
                     }
                 });
             }
        });
    </script>
    @vite(['resources/js/project/filters.js', 'resources/js/project/detail-modal.js'])
@endpush
