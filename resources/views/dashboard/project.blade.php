@extends('layouts.dashboard')
@section('title', 'Projects')
@vite(['resources/css/dashboard_project.css', 'resources/js/app.js'])

@section('content')

    @if ($errors->any())
        <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms
            class="fixed top-24 left-1/2 -translate-x-1/2 z-100 w-[90%] max-w-lg border-l-2 border-red-500 bg-red-500/10 p-4 shadow-[0_0_20px_rgba(239,68,68,0.2)] backdrop-blur-md">
            <div class="flex justify-between items-start">
                <div class="flex gap-3 text-red-500">
                    <i class="fa-solid fa-triangle-exclamation mt-1 animate-pulse"></i>
                    <div>
                        <h4 class="text-[10px] font-mono font-bold uppercase tracking-widest mb-1">SYS_ERROR:
                            COMPILATION_FAILED</h4>
                        <ul class="list-disc list-inside text-xs font-mono opacity-90 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button @click="show = false" class="text-red-500/50 hover:text-red-500">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
    @endif

    <style>
        .diary-page { border-radius: 1rem; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <div class="min-h-screen bg-background pt-6 sm:pt-12 pb-24 px-4 md:px-6 relative overflow-hidden">

        <div class="absolute inset-0 pointer-events-none opacity-[0.03] z-0"
            style="background-image: radial-gradient(var(--color-text) 1px, transparent 1px); background-size: 24px 24px;">
        </div>

        <section class="max-w-7xl mx-auto relative z-10 space-y-12 mt-4 md:mt-8">

            <header class="relative space-y-6">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div class="space-y-6">
                        <div class="relative inline-flex items-center gap-2 py-1.5 pl-8 pr-6 transition-all duration-300 w-max group hover:-translate-y-0.5 hover:rotate-1"
                            style="filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.06));">

                            <div class="absolute inset-0 bg-warning border border-yellow-500 rounded-l-md z-0 transition-colors"
                                style="clip-path: polygon(0 0, 100% 0, 92% 50%, 100% 100%, 0 100%);">
                            </div>

                            <div class="absolute top-1/2 -left-4 w-6 h-[1.5px] bg-[#8B0000]/80 -translate-y-[calc(50%+1px)] origin-right -rotate-12 group-hover:-rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>
                            <div class="absolute top-1/2 -left-3 w-5 h-[1.5px] bg-[#B22222]/80 -translate-y-[calc(50%-1px)] origin-right rotate-12 group-hover:rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>

                            <div class="absolute left-2.5 top-1/2 -translate-y-1/2 w-2.5 h-2.5 rounded-full bg-surface shadow-[inset_1px_1px_3px_rgba(0,0,0,0.3)] border border-yellow-700/30 z-10"></div>

                            <i class="fa-regular fa-folder-open relative z-10 text-yellow-800 text-[11px] mt-px"></i>

                            <span class="relative z-10 text-[10px] sm:text-xs font-black tracking-[0.15em] uppercase text-yellow-900 mt-px">
                                Arsip Proyek
                            </span>
                        </div>

                        <h1 class="text-[clamp(2.5rem,6vw,4.5rem)] font-bold tracking-tighter leading-[1.05] text-text">
                            <span class="block">Manajer Proyek</span>
                            <span class="block text-muted mt-2 text-[clamp(1.5rem,4vw,2.5rem)]">Karya & Eksplorasi</span>
                        </h1>

                        <p class="text-base text-muted max-w-2xl leading-relaxed font-medium">
                            Mengelola, memantau, dan memperbarui portofolio Anda.
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('dashboard.trash') }}"
                            class="px-3 py-1.5 bg-container border-2 border-border rounded-lg text-xs font-bold uppercase tracking-widest text-muted hover:border-red-500 hover:text-red-500 hover:-translate-y-1 hover:-rotate-2 transition-all shadow-[3px_3px_0px_var(--color-border)] group flex items-center gap-2">
                            <i class="fa-solid fa-trash-can group-hover:scale-110 transition-transform"></i>
                            Trash Bin
                        </a>
                        <button
                            class="open-create-modal px-3 py-1.5 bg-warning border-2 border-yellow-600 rounded-lg text-xs font-bold uppercase tracking-widest text-yellow-900 hover:-translate-y-1 hover:rotate-2 transition-all shadow-[4px_4px_0px_var(--color-border)] group flex items-center gap-2">
                            <i class="fa-solid fa-plus group-hover:rotate-90 transition-transform text-yellow-700"></i>
                            New Project
                        </button>
                    </div>
                </div>
            </header>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 gap-4 md:gap-6 mb-8">

                <div class="bg-amber-100 p-6 rounded-sm shadow-md border border-gray-200/70 flex flex-col justify-between relative group/tooltip rotate-1 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>

                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                        <i class="fa-solid fa-layer-group text-blue-500"></i>
                        <span data-i18n="project.stats.totalProjects">Total Proyek</span>
                    </p>
                    <h3 class="text-4xl font-bold text-neutral-900 relative z-10">{{ $summary['totalProjects'] }}</h3>
                </div>

                <div class="bg-emerald-100 p-6 rounded-sm shadow-md border border-gray-200/70 flex flex-col justify-between relative group/tooltip rotate-2 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>

                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                        <i class="fa-solid fa-tags text-indigo-500"></i>
                        <span data-i18n="project.stats.totalCategories">Total Kategori</span>
                    </p>
                    <h3 class="text-4xl font-bold text-neutral-900 relative z-10">{{ $summary['totalCategories'] }}</h3>
                </div>

                <div class="bg-sky-100 p-6 rounded-sm shadow-md border border-gray-200/70 flex flex-col justify-between relative group/tooltip -rotate-1 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>

                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                        <i class="fa-solid fa-globe text-emerald-500"></i>
                        <span data-i18n="project.stats.activeCount">Live / Aktif</span>
                    </p>
                    <h3 class="text-4xl font-bold text-neutral-900 relative z-10">{{ $summary['activeCount'] }}</h3>
                </div>

                <div class="bg-rose-100 p-6 rounded-sm shadow-md border border-gray-200/70 flex flex-col justify-between relative group/tooltip rotate-1 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>

                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-muted flex items-center gap-2">
                            <i class="fa-solid fa-box-archive text-amber-500"></i>
                            <span data-i18n="project.stats.inactiveCount">Arsip</span>
                        </p>
                        @if ($summary['inactiveCount'] > 0)
                            <i class="fa-solid fa-circle-info text-rose-400 cursor-help hover:text-rose-600 transition-colors"></i>
                        @endif
                    </div>
                    <h3 class="text-4xl font-bold text-neutral-900 relative z-10">{{ $summary['inactiveCount'] }}</h3>

                    @if ($summary['inactiveCount'] > 0)
                        <div class="absolute right-0 top-full -translate-y-5 w-48 bg-yellow-50/95 border border-yellow-200/70 p-4 opacity-0 pointer-events-none group-hover/tooltip:opacity-100 transition-all duration-300 z-50 shadow-lg text-xs space-y-3 -rotate-2 group-hover/tooltip:rotate-0 origin-bottom-right rounded-sm backdrop-blur-sm">

                            <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-12 h-4 bg-white/60 backdrop-blur-[1px] border border-black/5 rotate-1 shadow-sm"></div>

                            <p class="font-bold uppercase tracking-widest text-yellow-800/60 text-[9px] border-b border-dashed border-yellow-600/30 pb-2 mb-2 font-sans">
                                Status Breakdown
                            </p>

                            <div class="space-y-2 font-serif">
                                <div class="flex gap-4 justify-between items-center">
                                    <span class="text-yellow-900/70 font-medium" data-i18n="project.stats.statusBreakdown.Shipped">Shipped</span>
                                    <span class="font-bold text-emerald-600">{{ $summary['statusBreakdown']['Shipped'] ?? 0 }}</span>
                                </div>
                                <div class="flex gap-4 justify-between items-center">
                                    <span class="text-yellow-900/70 font-medium" data-i18n="project.stats.statusBreakdown.In Progress">In Progress</span>
                                    <span class="font-bold text-amber-600">{{ $summary['statusBreakdown']['In Progress'] ?? 0 }}</span>
                                </div>
                                <div class="flex gap-4 justify-between items-center">
                                    <span class="text-yellow-900/70 font-medium" data-i18n="project.stats.statusBreakdown.Prototype">Prototype</span>
                                    <span class="font-bold text-sky-600">{{ $summary['statusBreakdown']['Prototype'] ?? 0 }}</span>
                                </div>
                                <div class="flex gap-4 justify-between items-center">
                                    <span class="text-yellow-900/70 font-medium" data-i18n="project.stats.statusBreakdown.Archived">Archived</span>
                                    <span class="font-bold text-rose-600">{{ $summary['statusBreakdown']['Archived'] ?? 0 }}</span>
                                </div>
                            </div>

                            <div class="absolute bottom-0 right-0 w-3 h-3 bg-yellow-200/50 border-t border-l border-yellow-300/50" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></div>
                        </div>
                    @endif
                </div>

            </div>

            <div x-data="{ expanded: localStorage.getItem('project_matrix_expanded') !== 'false' }"
                class="bg-surface border-2 border-dashed border-border shadow-sm rounded-2xl p-5 md:p-6 space-y-6 font-sans relative">

                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-20 h-6 bg-muted opacity-20 backdrop-blur-sm -rotate-1" style="clip-path: polygon(5% 0, 100% 5%, 95% 100%, 0 95%); z-index: 10;"></div>

                <div class="flex items-center justify-between border-b-2 border-dashed border-border/50 pb-4">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-text flex items-center gap-2 cursor-pointer"
                        @click="expanded = !expanded; localStorage.setItem('project_matrix_expanded', expanded)">
                        <i class="fa-solid fa-chart-pie text-primary"></i> Data_Visualization_Matrix
                    </h3>
                    <div class="flex items-center gap-4">
                        <span x-show="expanded"
                            class="text-[10px] font-bold text-green-600 hidden sm:inline-block italic font-serif">Generating Live Report...</span>
                        <button @click="expanded = !expanded; localStorage.setItem('project_matrix_expanded', expanded)"
                            type="button"
                            class="text-xs font-bold text-muted hover:text-primary transition-colors focus:outline-none">
                            <span x-text="expanded ? '[_HIDE_]' : '[_SHOW_]'"></span>
                        </button>
                    </div>
                </div>

                <div x-show="expanded" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-8">

                    <div class="space-y-4">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-muted italic font-serif border-l-2 border-primary pl-3">Node Types Distribution</p>
                        <div class="relative h-48 w-full flex justify-center bg-container/30 rounded-lg p-2 border border-border/50">
                            <canvas id="typeChart"></canvas>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-muted italic font-serif border-l-2 border-green-500 pl-3">Node Status Metrics</p>
                        <div class="relative h-48 w-full bg-container/30 rounded-lg p-2 border border-border/50">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-4">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-muted italic font-serif border-l-2 border-sky-400 pl-3">Productivity Timeline (Last 6 Months)</p>
                        <div class="relative h-64 w-full bg-container/30 rounded-lg p-4 border border-border/50">
                            <canvas id="timelineChart"></canvas>
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-4">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-muted italic font-serif border-l-2 border-amber-400 pl-3">Team Allocation (Solo vs Team)</p>
                        <div class="relative h-48 w-full flex justify-center bg-container/30 rounded-lg p-2 border border-border/50">
                            <canvas id="teamChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            @php $currentType = request('type', 'all'); @endphp
            <div class="bg-surface border-2 border-dashed border-border shadow-sm rounded-2xl p-5 md:p-6 space-y-6 font-sans relative">

                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-20 h-6 bg-muted opacity-20 backdrop-blur-sm -rotate-2" style="clip-path: polygon(5% 0, 100% 5%, 95% 100%, 0 95%); z-index: 10;"></div>

                <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-5 border-b-2 border-dashed border-border/50 pb-6 relative z-20">

                    <div class="relative w-full md:w-1/2 group">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-muted group-focus-within:text-primary transition-colors"></i>
                        <input type="text" id="project-search" placeholder="{{ $projectPlaceholders }}"
                            class="w-full border-2 border-border bg-container rounded-lg px-4 py-3 pl-11 text-sm font-medium text-text placeholder:text-muted placeholder:italic placeholder:font-serif focus:outline-none focus:border-primary focus:ring-0 transition-all shadow-inner"
                            style="background-image: repeating-linear-gradient(transparent, transparent 27px, var(--color-border) 27px, var(--color-border) 28px); line-height: 28px; background-attachment: local;" />
                    </div>

                    <div class="flex flex-wrap sm:flex-nowrap items-center gap-3">
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

                        <button id="toggleSelectMode" type="button"
                            class="px-6 py-3 border-2 border-border bg-container rounded-lg text-xs font-bold uppercase tracking-widest text-muted hover:border-primary hover:text-primary transition-all shadow-[3px_3px_0px_var(--color-border)] focus:outline-none">
                            Pilih Beberapa
                        </button>
                    </div>
                </div>

                <div class="flex overflow-x-auto no-scrollbar gap-4 pb-2 pt-2 px-2 -mx-2">
                    <button
                        class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none {{ $currentType == 'all' ? 'bg-warning text-yellow-900 border-2 border-yellow-500 shadow-[2px_3px_0px_var(--color-border)] -translate-y-1 rotate-1' : 'text-muted bg-container border-2 border-border shadow-[1px_2px_0px_var(--color-border)] hover:shadow-[3px_4px_0px_var(--color-border)] hover:-translate-y-1 hover:-rotate-1' }}"
                        data-filter="all">Semua</button>
                    <button
                        class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none {{ $currentType == 'Website' ? 'bg-warning text-yellow-900 border-2 border-yellow-500 shadow-[2px_3px_0px_var(--color-border)] -translate-y-1 rotate-1' : 'text-muted bg-container border-2 border-border shadow-[1px_2px_0px_var(--color-border)] hover:shadow-[3px_4px_0px_var(--color-border)] hover:-translate-y-1 hover:rotate-1' }}"
                        data-filter="Website">Website</button>
                    <button
                        class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none {{ $currentType == 'Application' ? 'bg-warning text-yellow-900 border-2 border-yellow-500 shadow-[2px_3px_0px_var(--color-border)] -translate-y-1 rotate-1' : 'text-muted bg-container border-2 border-border shadow-[1px_2px_0px_var(--color-border)] hover:shadow-[3px_4px_0px_var(--color-border)] hover:-translate-y-1 hover:rotate-1' }}"
                        data-filter="Application">Aplikasi</button>
                    <button
                        class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none {{ $currentType == 'Design' ? 'bg-warning text-yellow-900 border-2 border-yellow-500 shadow-[2px_3px_0px_var(--color-border)] -translate-y-1 rotate-1' : 'text-muted bg-container border-2 border-border shadow-[1px_2px_0px_var(--color-border)] hover:shadow-[3px_4px_0px_var(--color-border)] hover:-translate-y-1 hover:rotate-1' }}"
                        data-filter="Design">Desain</button>
                </div>
            </div>

            </div>

            <div id="projects-container">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                    @forelse ($projects as $index => $project)
                        @php
                            $rotation = $index % 2 === 0 ? 'rotate-1' : '-rotate-1';
                        @endphp
                        <div class="group relative p-4 pt-12 shadow-inner bg-container rounded-xl {{ $rotation }} hover:rotate-0 transition-transform duration-500">

                            <div class="absolute top-4 left-6 z-20">
                                <span class="px-4 py-1.5 text-[10px] font-black tracking-widest bg-warning text-yellow-900 border-l-4 border-yellow-500 shadow-md -rotate-3 inline-block uppercase">
                                    {{ $project->status }}
                                </span>
                            </div>

                            <div class="absolute top-4 right-6 z-30">
                                <input type="checkbox" name="projects[]" value="{{ $project->id }}"
                                    class="bulk-checkbox w-5 h-5 opacity-0 pointer-events-none transition-all cursor-pointer border-2 border-primary rounded appearance-none checked:bg-primary checked:border-primary">
                            </div>

                            <div class="bg-surface p-4 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.15)] border border-border h-full flex flex-col relative overflow-hidden">
                                <div class="checkbox-tape absolute -top-1 -right-8 w-24 h-8 bg-primary/20 -rotate-12 opacity-0 transition-opacity pointer-events-none"></div>

                                <a href="javascript:void(0)"
                                    class="project-open block grow"
                                    data-id="{{ $project->id }}" data-title="{{ $project->title }}"
                                    data-desc="{{ $project->desc }}" data-type="{{ $project->type }}"
                                    data-status="{{ $project->status }}" data-visibility="{{ $project->visibility }}"
                                    data-published="{{ $project->published_at ? $project->published_at->format('Y-m-d\TH:i') : '' }}"
                                    data-created="{{ $project->created_at->format('d M Y') }}"
                                    data-updated="{{ $project->updated_at->format('d M Y') }}"
                                    data-repo="{{ $project->repo }}" data-role="{{ $project->role }}"
                                    data-team="{{ $project->team_size }}"
                                    data-responsibilities="{{ $project->responsibilities }}"
                                    data-live="{{ $project->live_url }}" data-screenshot='@json(
                                        $project->screenshot
                                            ? collect($project->screenshot)->map(fn($img) => ['path' => $img, 'url' => asset('storage/' . $img)])->values()
                                            : []
                                    )'
                                    data-image-desktop="{{ $project->image_desktop ? asset('storage/' . $project->image_desktop) : '' }}"
                                    data-image-tablet="{{ $project->image_tablet ? asset('storage/' . $project->image_tablet) : '' }}"
                                    data-image-mobile="{{ $project->image_mobile ? asset('storage/' . $project->image_mobile) : '' }}"
                                    data-tech='@json($project->tech)'>

                                    <div class="aspect-video w-full bg-bg overflow-hidden mb-5 border border-border shadow-inner relative">
                                        <div class="absolute inset-0 opacity-[0.03] pointer-events-none z-10" style="background-image: radial-gradient(var(--color-text) 0.5px, transparent 0.5px); background-size: 8px 8px;"></div>

                                        <div class="relative w-full h-full overflow-hidden project-slider">
                                            @if($project->screenshot && count((array)$project->screenshot) > 0)
                                                @foreach((array)$project->screenshot as $i => $shot)
                                                    <img src="{{ asset('storage/' . $shot) }}"
                                                        class="slide absolute inset-0 w-full h-full object-cover transition-all duration-500 {{ $i === 0 ? 'opacity-100 grayscale-[0.3] group-hover:grayscale-0' : 'opacity-0 grayscale-0' }} group-hover:scale-105"
                                                        alt="preview">
                                                @endforeach
                                            @else
                                                <div class="flex flex-col items-center justify-center w-full h-full text-muted p-4 text-center bg-surface">
                                                    <i class="fa-regular fa-image text-3xl opacity-30 mb-2"></i>
                                                    <span class="text-[9px] uppercase tracking-widest font-bold">No Preview Available</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="px-1 pb-1 flex flex-col flex-grow">
                                        <div class="flex justify-between items-start mb-1">
                                            <span class="text-[9px] font-bold text-muted uppercase tracking-widest">{{ $project->type }}</span>
                                            <span class="text-[9px] px-2 py-0.5 border border-border text-muted uppercase">{{ $project->visibility }}</span>
                                        </div>

                                        <h3 class="text-xl font-bold text-text leading-tight mb-3 group-hover:text-primary transition-colors line-clamp-1">
                                            {{ $project->title }}
                                        </h3>

                                        <p class="text-sm text-muted line-clamp-3 mb-4 font-serif italic opacity-90">
                                            {{ $project->desc }}
                                        </p>

                                        <div class="pt-3 border-t border-dashed border-border/50 flex justify-between items-center mt-auto">
                                            <div class="flex gap-1 flex-wrap">
                                                @foreach (collect($project->tech)->take(3) as $tech)
                                                    <span class="text-[8px] font-bold uppercase tracking-tighter text-muted border border-border px-1.5 py-0.5 bg-container/50">{{ $tech }}</span>
                                                @endforeach
                                                @if(count((array)$project->tech) > 3)
                                                    <span class="text-[8px] font-bold text-muted">+{{ count((array)$project->tech) - 3 }}</span>
                                                @endif
                                            </div>

                                            <div class="w-8 h-8 rounded-full bg-bg flex items-center justify-center text-muted group-hover:bg-primary group-hover:text-white transition-all border border-border group-hover:border-primary shadow-sm">
                                                <i class="fa-solid fa-arrow-right-long text-xs shadow-none"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 px-6 flex flex-col items-center justify-center text-center bg-[#fdfcf5] border-2 border-dashed border-[#e5e0d0] rounded-xl shadow-[4px_4px_0px_rgba(0,0,0,0.05)] relative font-sans overflow-hidden">
                            <div class="absolute inset-0 z-0 opacity-30" style="background-image: repeating-linear-gradient(transparent, transparent 24px, #e5e0d0 24px, #e5e0d0 25px);"></div>
                            <div class="relative z-20 space-y-3">
                                <i class="fa-solid fa-ghost text-5xl text-muted/30 mb-2"></i>
                                <h3 class="text-3xl font-medium text-black font-handwriting tracking-wide">Arsip Kosong</h3>
                                <p class="text-sm text-muted max-w-sm mx-auto italic font-serif opacity-90">System directory is empty. Initialize a new project node to begin data tracking.</p>
                                <button class="open-create-modal mt-6 px-8 py-3 bg-warning border-2 border-yellow-600 rounded-lg text-xs font-bold uppercase tracking-widest text-yellow-900 hover:-translate-y-1 transition-all shadow-[4px_4px_0px_var(--color-border)]">
                                    [ INIT_FIRST_NODE ]
                                </button>
                            </div>
                        </div>
                    @endforelse

                @if ($projects instanceof \Illuminate\Pagination\LengthAwarePaginator && $projects->hasPages())
                    <div class="flex justify-center pt-16">
                        <nav class="flex items-center gap-4 font-mono">
                            @if ($projects->onFirstPage())
                                <span class="w-10 h-10 rounded-full border-2 border-border flex items-center justify-center text-muted opacity-30 cursor-not-allowed italic font-serif"><i class="fa-solid fa-chevron-left"></i></span>
                            @else
                                <a href="{{ $projects->previousPageUrl() }}" class="w-10 h-10 rounded-full border-2 border-border flex items-center justify-center text-muted hover:border-primary hover:text-primary hover:-translate-y-0.5 transition-all shadow-sm"><i class="fa-solid fa-chevron-left"></i></a>
                            @endif

                            <div class="px-6 py-2 bg-warning border-2 border-yellow-500 rounded-full shadow-[2px_2px_0px_var(--color-border)] rotate-1">
                                <span class="text-xs font-black text-yellow-900 uppercase tracking-widest">
                                    PG_{{ sprintf('%02d', $projects->currentPage()) }} / {{ sprintf('%02d', $projects->lastPage()) }}
                                </span>
                            </div>

                            @if ($projects->hasMorePages())
                                <a href="{{ $projects->nextPageUrl() }}" class="w-10 h-10 rounded-full border-2 border-border flex items-center justify-center text-muted hover:border-primary hover:text-primary hover:-translate-y-0.5 transition-all shadow-sm"><i class="fa-solid fa-chevron-right"></i></a>
                            @else
                                <span class="w-10 h-10 rounded-full border-2 border-border flex items-center justify-center text-muted opacity-30 cursor-not-allowed italic font-serif"><i class="fa-solid fa-chevron-right"></i></span>
                            @endif
                        </nav>
                    </div>
                @endif

            </div>

            <div id="bulkBar"
                class="fixed bottom-8 left-1/2 -translate-x-1/2 z-90 bg-[#FEFCE8] border-2 border-yellow-500/30 p-4 md:px-8 md:py-5 flex flex-col sm:flex-row items-center gap-6 shadow-[8px_8px_0px_rgba(0,0,0,0.1)] opacity-0 pointer-events-none translate-y-8 rotate-1 transition-all duration-300 w-[90%] md:w-auto min-w-[400px]">

                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-16 h-4 bg-white/60 backdrop-blur-sm border border-black/5 rotate-1"></div>

                <div class="flex items-center gap-4 border-r-2 border-dashed border-yellow-600/20 pr-6 mr-2 w-full sm:w-auto justify-center sm:justify-start">
                    <div class="w-10 h-10 rounded-full bg-yellow-400/20 flex items-center justify-center border border-yellow-500 animate-pulse">
                        <i class="fa-solid fa-check-double text-yellow-700"></i>
                    </div>
                    <div class="flex flex-col">
                        <span id="selectedCount" class="text-xs font-black uppercase tracking-widest text-yellow-900">0 SELECTED</span>
                        <span class="text-[9px] font-bold text-yellow-900/40 uppercase tracking-tighter">Bulk Operations</span>
                    </div>
                </div>

                <div class="flex items-center gap-4 w-full sm:w-auto">
                    <button type="button" onclick="bulkAction('publish')"
                        class="flex-1 sm:flex-none px-6 py-2.5 bg-emerald-100 border-2 border-emerald-500 rounded text-[10px] font-black uppercase tracking-widest text-emerald-900 hover:-translate-y-1 hover:-rotate-1 transition-all shadow-[3px_3px_0px_rgba(0,0,0,0.05)]">
                        PUBLISH_ALL
                    </button>
                    <button type="button" onclick="bulkAction('delete')"
                        class="flex-1 sm:flex-none px-6 py-2.5 bg-rose-100 border-2 border-rose-500 rounded text-[10px] font-black uppercase tracking-widest text-rose-900 hover:-translate-y-1 hover:rotate-1 transition-all shadow-[3px_3px_0px_rgba(0,0,0,0.05)] group">
                        <i class="fa-solid fa-trash-can mr-2"></i> DELETE_ALL
                    </button>
                    <button type="button" id="cancelSelect" class="text-[9px] font-bold text-muted hover:text-text uppercase tracking-widest underline underline-offset-4 decoration-dashed ml-2">
                        Cancel
                    </button>
                </div>
                <div class="absolute bottom-0 right-0 w-4 h-4 bg-yellow-200" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></div>
            </div>

            <form id="bulkForm" method="POST" class="hidden">
                @csrf
            </form>

        </section>
    </div>

@endsection

<x-project.detail-modal />
<x-project.edit-modal :technologies="$technologies" />
<x-project.create-modal :technologies="$technologies" />

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Chart.defaults.color = '#71717a';
            Chart.defaults.font.family = 'monospace';
            Chart.defaults.font.size = 10;

            const gridConfig = {
                color: 'rgba(255, 255, 255, 0.05)',
                tickColor: 'transparent'
            };
            const tooltipConfig = {
                backgroundColor: 'rgba(5, 5, 5, 0.9)',
                titleFont: {
                    family: 'monospace',
                    size: 11
                },
                bodyFont: {
                    family: 'monospace',
                    size: 10
                },
                borderColor: 'rgba(56, 189, 248, 0.5)',
                borderWidth: 1,
                cornerRadius: 0,
                padding: 10
            };

            const rawStatusData = {!! json_encode(
                $summary['statusBreakdown'] ?? ['Shipped' => 5, 'In Progress' => 3, 'Prototype' => 2, 'Archived' => 1],
            ) !!};
            const typeData = {!! json_encode($chartData['types'] ?? ['Website' => 10, 'Web App' => 6, 'Application' => 4, 'Design' => 3]) !!};
            const timelineData = {!! json_encode(
                $chartData['timeline'] ?? ['Sep' => 1, 'Oct' => 3, 'Nov' => 2, 'Dec' => 5, 'Jan' => 4, 'Feb' => 7],
            ) !!};
            const teamData = {!! json_encode($chartData['team'] ?? ['Solo' => 15, 'Team' => 5]) !!};

            const colors = {
                sky: '#0ea5e9',
                green: '#10b981',
                amber: '#f59e0b',
                red: '#ef4444',
                primary: '#8b5cf6',
                bgSky: 'rgba(14, 165, 233, 0.1)',
                bgGreen: 'rgba(16, 185, 129, 0.1)',
                bgAmber: 'rgba(245, 158, 11, 0.1)'
            };

            new Chart(document.getElementById('typeChart'), {
                type: 'doughnut',
                data: {
                    labels: Object.keys(typeData),
                    datasets: [{
                        data: Object.values(typeData),
                        backgroundColor: [colors.sky, colors.primary, colors.amber, colors.green],
                        borderColor: '#050505',
                        borderWidth: 2,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 10,
                                borderRadius: 0
                            }
                        },
                        tooltip: tooltipConfig
                    },
                    cutout: '70%'
                }
            });

            new Chart(document.getElementById('statusChart'), {
                type: 'bar',
                data: {
                    labels: Object.keys(rawStatusData),
                    datasets: [{
                        label: 'Nodes Count',
                        data: Object.values(rawStatusData),
                        backgroundColor: [colors.green, colors.amber, colors.sky, colors.red],
                        borderWidth: 1,
                        borderColor: [colors.green, colors.amber, colors.sky, colors.red],
                        borderRadius: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            grid: gridConfig,
                            beginAtZero: true
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: tooltipConfig
                    }
                }
            });

            new Chart(document.getElementById('timelineChart'), {
                type: 'line',
                data: {
                    labels: Object.keys(timelineData),
                    datasets: [{
                        label: 'Commits/Deploys',
                        data: Object.values(timelineData),
                        borderColor: colors.sky,
                        backgroundColor: colors.bgSky,
                        borderWidth: 2,
                        pointBackgroundColor: colors.sky,
                        pointBorderColor: '#050505',
                        pointRadius: 4,
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            grid: gridConfig,
                            beginAtZero: true
                        },
                        x: {
                            grid: gridConfig
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: tooltipConfig
                    }
                }
            });

            new Chart(document.getElementById('teamChart'), {
                type: 'pie',
                data: {
                    labels: Object.keys(teamData),
                    datasets: [{
                        data: Object.values(teamData),
                        backgroundColor: [colors.primary, colors.amber],
                        borderColor: '#050505',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 10
                            }
                        },
                        tooltip: tooltipConfig
                    }
                }
            });
        });
    </script>

    <script>
        window.bulkAction = function(action) {
            const selected = Array.from(document.querySelectorAll('.bulk-checkbox:checked')).map(cb => cb.value);
            if (selected.length === 0) return;

            let confirmMsg = action === 'delete'
                ? 'Apakah Anda yakin ingin menghapus proyek terpilih?'
                : 'Apakah Anda yakin ingin mempublikasikan proyek terpilih?';

            if (confirm(confirmMsg)) {
                submitBulkForm(action, selected);
            }
        };

        function submitBulkForm(action, selectedIds) {
            const form = document.getElementById('bulkForm');
            if (!form) return;

            if (action === 'delete') {
                form.action = "{{ route('dashboard.bulkDeleteProjects') }}";
            } else if (action === 'publish') {
                form.action = "{{ route('dashboard.bulkPublishProjects') }}";
            }

            form.innerHTML = '@csrf';
            selectedIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'projects[]';
                input.value = id;
                form.appendChild(input);
            });

            form.submit();
        }

        document.addEventListener('DOMContentLoaded', function() {

            const toggleBtn = document.getElementById('toggleSelectMode');
            const bulkBar = document.getElementById('bulkBar');
            const selectedCountText = document.getElementById('selectedCount');

            let selectMode = new URL(window.location.href).searchParams.has('multiple_select');

            async function ajaxNavigate(url) {
                const container = document.querySelector('#projects-container');
                if (!container) return;

                container.style.opacity = '0.5';
                container.style.pointerEvents = 'none';

                try {
                    const response = await fetch(url.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    if (!response.ok) throw new Error(`HTTP ${response.status}`);

                    const html = await response.text();
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    const newContainer = doc.querySelector('#projects-container');
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
                initDetailModalListeners();
                initPaginationLinks();
                attachCardEvents();
                updateBulkBar();
                highlightSearch();
            }

            function initDetailModalListeners() {
                const detailModal = document.getElementById('projectDetailModal');
                if (!detailModal) return;

                document.querySelectorAll('.project-open').forEach(card => {
                    if (card._detailBound) return;
                    card._detailBound = true;

                    card.addEventListener('click', () => {
                        detailModal.dataset.id = card.dataset.id;
                        detailModal.dataset.tech = card.dataset.tech;
                        detailModal.dataset.type = card.dataset.type;
                        detailModal.dataset.status = card.dataset.status;
                        detailModal.dataset.visibility = card.dataset.visibility;
                        detailModal.dataset.title = card.dataset.title;
                        detailModal.dataset.desc = card.dataset.desc;
                        detailModal.dataset.role = card.dataset.role;
                        detailModal.dataset.team = card.dataset.team;
                        detailModal.dataset.responsibilities = card.dataset.responsibilities;
                        detailModal.dataset.repo = card.dataset.repo;
                        detailModal.dataset.live = card.dataset.live;
                        detailModal.dataset.screenshot = card.dataset.screenshot;

                        document.getElementById('detailType').textContent = card.dataset.type;
                        document.getElementById('detailStatus').textContent = card.dataset.status;
                        document.getElementById('detailTitle').textContent = card.dataset.title;
                        document.getElementById('detailDesc').textContent = card.dataset.desc;
                        document.getElementById('detailRole').textContent = card.dataset.role ||
                            '-';
                        document.getElementById('detailTeamSize').textContent = card.dataset.team ||
                            '-';
                        document.getElementById('detailResponsibilities').textContent = card.dataset
                            .responsibilities || '-';
                        document.getElementById('detailCreated').textContent = card.dataset.created;
                        document.getElementById('detailUpdated').textContent = card.dataset.updated;

                        const techContainer = document.getElementById('detailTech');
                        techContainer.innerHTML = '';
                        if (card.dataset.tech) {
                            try {
                                JSON.parse(card.dataset.tech).forEach(t => {
                                    techContainer.innerHTML +=
                                        `<span class="px-2 py-1 text-xs border border-border">${t}</span>`;
                                });
                            } catch {
                                techContainer.innerHTML = '-';
                            }
                        }

                        const wrapper = document.getElementById('detailScreenshotsWrapper');
                        const sc = document.getElementById('detailScreenshots');
                        sc.innerHTML = '';
                        if (card.dataset.screenshot) {
                            try {
                                const images = JSON.parse(card.dataset.screenshot);
                                if (images.length > 0) {
                                    images.forEach(img => {
                                        const imgSrc = typeof img === 'object' && img !==
                                            null ? img.url : img;
                                        sc.innerHTML +=
                                            `<div class="aspect-video overflow-hidden border border-border/50 bg-surface/40 group"><img src="${imgSrc}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105 cursor-pointer"></div>`;
                                    });
                                    wrapper.classList.remove('hidden');
                                } else {
                                    wrapper.classList.add('hidden');
                                }
                            } catch {
                                wrapper.classList.add('hidden');
                            }
                        } else {
                            wrapper.classList.add('hidden');
                        }

                        const live = document.getElementById('detailLive');
                        const repo = document.getElementById('detailRepo');
                        card.dataset.live ? (live.href = card.dataset.live, live.classList.remove(
                            'hidden')) : live.classList.add('hidden');
                        card.dataset.repo ? (repo.href = card.dataset.repo, repo.classList.remove(
                            'hidden')) : repo.classList.add('hidden');

                        window.openProjectModal();
                        document.body.classList.add('overflow-hidden');
                    });
                });
            }

            function initPaginationLinks() {
                const container = document.querySelector('#projects-container');
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
                        ajaxNavigate(target);
                    } catch {
                    }
                };

                container.addEventListener('click', container._paginationHandler);
            }

            const searchInput = document.getElementById('project-search');

            if (searchInput) {
                let searchTimer;

                searchInput.addEventListener('input', () => {
                    clearTimeout(searchTimer);
                    searchTimer = setTimeout(() => {
                        const url = buildUrl({
                            search: searchInput.value || null
                        });
                        ajaxNavigate(url);
                    }, 500);
                });

                searchInput.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        clearTimeout(searchTimer);
                        const url = buildUrl({
                            search: searchInput.value || null
                        });
                        ajaxNavigate(url);
                    }
                });
            }

            function initFilterButtons() {
                const filterButtons = document.querySelectorAll('.filter-btn');
                const currentType = new URLSearchParams(window.location.search).get('type') ?? 'all';

                filterButtons.forEach(btn => {
                    const isActive = btn.dataset.filter === currentType;

                    if (isActive) {
                        btn.className = "filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none bg-warning text-yellow-900 border-2 border-yellow-500 shadow-[2px_3px_0px_var(--color-border)] -translate-y-1 rotate-1";
                    } else {
                        btn.className = "filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest text-muted bg-container border-2 border-border shadow-[1px_2px_0px_var(--color-border)] hover:shadow-[3px_4px_0px_var(--color-border)] hover:-translate-y-1 hover:-rotate-1 transition-all focus:outline-none";
                    }

                    if (btn._ajaxBound) return;
                    btn._ajaxBound = true;

                    btn.addEventListener('click', () => {
                        const filter = btn.dataset.filter;
                        const url = buildUrl({
                            type: filter === 'all' ? null : filter
                        });
                        ajaxNavigate(url).then(() => initFilterButtons());
                    });
                });
            }

            initFilterButtons();

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
                        const labelText = option.dataset.i18n ? (option.innerText || option.textContent) : option.textContent;

                        if (sortLabel) sortLabel.textContent = labelText.trim();
                        sortMenu.classList.add('hidden');
                        if (sortChevron) sortChevron.classList.remove('rotate-180');

                        const url = buildUrl({ sort: sortValue });
                        ajaxNavigate(url);
                    });
                });

                const currentSort = new URLSearchParams(window.location.search).get('sort') || 'desc';
                const activeOption = document.querySelector(`.sort-option[data-sort="${currentSort}"]`);
                if (activeOption && sortLabel) {
                    sortLabel.textContent = activeOption.textContent.trim();
                }
            }

            function highlightSearch() {
                const keyword = new URLSearchParams(window.location.search).get('search');
                if (!keyword) return;

                const safe = keyword.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                const regex = new RegExp(`(${safe})`, 'gi');

                document.querySelectorAll('.group h3, .group p, [class*="bg-container/"]').forEach(el => {
                    if (el.children.length > 0) return;
                    const text = el.textContent;
                    if (regex.test(text)) {
                        el.innerHTML = text.replace(regex, '<span class="search-highlight">$1</span>');
                    }
                });

                document.querySelectorAll('.tech-tooltip').forEach(tooltip => {
                    const original = tooltip.innerHTML;
                    if (regex.test(tooltip.textContent)) {
                        tooltip.innerHTML = original.replace(regex,
                            '<span class="search-highlight">$1</span>');
                        tooltip.style.opacity = '1';
                        tooltip.style.visibility = 'visible';
                        const parent = tooltip.closest('.tech-more');
                        if (parent) parent.classList.add('tech-match');
                    }
                });
            }

            highlightSearch();

            function updateBulkBar() {
                if (!selectMode || !bulkBar) return;
                const selected = document.querySelectorAll('.bulk-checkbox:checked').length;
                if (selected > 0) {
                    bulkBar.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
                    selectedCountText.innerText = selected + ' SELECTED';
                } else {
                    bulkBar.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
                }
            }

            function attachCardEvents() {
                const cards = document.querySelectorAll('.group.relative.p-4.pt-12');
                const checkboxes = document.querySelectorAll('.bulk-checkbox');

                if (selectMode) {
                    checkboxes.forEach(cb => cb.classList.remove('opacity-0', 'pointer-events-none'));
                } else {
                    checkboxes.forEach(cb => {
                        cb.checked = false;
                        cb.classList.add('opacity-0', 'pointer-events-none');
                    });
                    cards.forEach(card => {
                        const tape = card.querySelector('.checkbox-tape');
                        if(tape) tape.classList.add('opacity-0');
                    });
                }

                cards.forEach(card => {
                    const checkbox = card.querySelector('.bulk-checkbox');
                    if(!checkbox) return;

                    card.addEventListener('click', function(e) {
                        if (!selectMode) return;

                        const anchor = e.target.closest('.project-open');
                        if (anchor) {
                            e.preventDefault();
                            e.stopImmediatePropagation();
                        }

                        if (e.target.closest('.open-create-modal') || e.target.tagName === 'BUTTON' || e.target.tagName === 'INPUT')
                            return;

                        checkbox.checked = !checkbox.checked;
                        const tape = card.querySelector('.checkbox-tape');
                        if(tape) tape.classList.toggle('opacity-100', checkbox.checked);
                        updateBulkBar();
                    }, true);

                    checkbox.addEventListener('change', () => {
                        const tape = card.querySelector('.checkbox-tape');
                        if(tape) tape.classList.toggle('opacity-100', checkbox.checked);
                        updateBulkBar();
                    });
                });

                const cancelBtn = document.getElementById('cancelSelect');
                if(cancelBtn) {
                   cancelBtn.onclick = () => toggleBtn.click();
                }
            }

            attachCardEvents();
            initPaginationLinks();

            if (selectMode) {
                toggleBtn.innerText = 'BATAL PILIH';
                toggleBtn.classList.add('border-red-500', 'text-red-500');
            }

            toggleBtn.addEventListener('click', async () => {
                const wasSelectMode = selectMode;
                selectMode = !selectMode;

                const url = new URL(window.location.href);
                const originalText = toggleBtn.innerText;
                toggleBtn.innerText = 'Memproses...';
                toggleBtn.disabled = true;

                if (selectMode) {
                    url.searchParams.set('multiple_select', '1');
                    toggleBtn.classList.add('border-red-500', 'text-red-500');
                } else {
                    url.searchParams.delete('multiple_select');
                    toggleBtn.classList.remove('border-red-500', 'text-red-500');
                    if (bulkBar) bulkBar.classList.add('opacity-0', 'pointer-events-none',
                        'translate-y-4');
                }

                try {
                    const response = await fetch(url.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) throw new Error('Network response was not ok');

                    const html = await response.text();
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    const newContainer = doc.querySelector('#projects-container');
                    if (newContainer) {
                        document.querySelector('#projects-container').innerHTML = newContainer
                            .innerHTML;
                    }

                    window.history.pushState({}, '', url.toString());
                    toggleBtn.innerText = selectMode ? 'BATAL PILIH' : 'Pilih Beberapa';

                    afterSwap();

                } catch (error) {
                    console.error('Error fetching data:', error);
                    selectMode = wasSelectMode;
                    if (!selectMode) {
                        toggleBtn.classList.remove('border-red-500', 'text-red-500');
                    } else {
                        toggleBtn.classList.add('border-red-500', 'text-red-500');
                    }
                    toggleBtn.innerText = originalText;
                    alert('SYS_ERROR: Interaction failed.');
                } finally {
                    toggleBtn.disabled = false;
                }
            });

        });
    </script>
    @vite(['resources/js/project/detail-modal.js', 'resources/js/project/filters.js'])
@endpush
