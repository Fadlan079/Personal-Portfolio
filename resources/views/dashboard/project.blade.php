@extends('layouts.dashboard')
@section('title', 'Projects')
@vite(['resources/css/dashboard_project.css', 'resources/js/app.js'])

@section('content')

    {{-- Global Error Handler --}}
    @if ($errors->any())
        <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms
            class="fixed top-24 left-1/2 -translate-x-1/2 z-[100] w-[90%] max-w-lg border-l-2 border-red-500 bg-red-500/10 p-4 shadow-[0_0_20px_rgba(239,68,68,0.2)] backdrop-blur-md">
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

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-widest text-primary">
                        <i class="fa-solid fa-microchip"></i>
                        >> SYS_DIR / DASHBOARD / PROJECT_NODES
                    </div>

                    {{-- Quick Actions --}}
                    <div class="hidden md:flex items-center gap-3">
                        <a href="{{ route('dashboard.trash') }}"
                            class="px-4 py-2 border border-border text-[10px] font-mono font-bold uppercase tracking-widest text-muted hover:border-red-500 hover:text-red-500 transition-colors group flex items-center gap-2">
                            <i class="fa-solid fa-trash-can group-hover:scale-110 transition-transform"></i> [ RECYCLE_BIN ]
                        </a>
                        <button
                            class="open-create-modal px-4 py-2 bg-primary/10 border border-primary text-[10px] font-mono font-bold uppercase tracking-widest text-primary hover:bg-primary hover:text-background transition-colors group flex items-center gap-2 shadow-[0_0_15px_rgba(var(--color-primary-rgb),0.15)]">
                            <i class="fa-solid fa-plus group-hover:rotate-90 transition-transform"></i> [ NEW_INSTANCE ]
                        </button>
                    </div>
                </div>

                <div class="flex items-end gap-3 pt-2">
                    <h1
                        class="text-4xl md:text-5xl lg:text-6xl font-bold font-mono tracking-tighter uppercase text-text leading-none">
                        Project_Manager
                    </h1>
                    <div
                        class="w-3 md:w-4 h-8 md:h-12 bg-primary animate-pulse mb-1 shadow-[0_0_10px_var(--color-primary)]">
                    </div>
                </div>

                <p class="text-sm font-mono text-muted tracking-wide max-w-2xl leading-relaxed">
                    <span class="text-primary">></span> Initialize, track, and deploy portfolio instances. System monitors
                    {{ $summary['activeCount'] }} active nodes.
                </p>

                {{-- Mobile Actions --}}
                <div class="flex md:hidden items-center gap-3 mt-4">
                    <button
                        class="open-create-modal flex-1 px-4 py-3 bg-primary/10 border border-primary text-[10px] font-mono font-bold uppercase tracking-widest text-primary text-center">
                        [ NEW ]
                    </button>
                    <a href="{{ route('dashboard.trash') }}"
                        class="flex-1 px-4 py-3 border border-border text-[10px] font-mono font-bold uppercase tracking-widest text-muted text-center hover:text-red-500">
                        [ BIN ]
                    </a>
                </div>
            </header>

            {{-- METRICS DASHBOARD --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                {{-- Stat 1 --}}
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-primary/50 transition-colors">
                    <div class="absolute top-0 right-0 w-3 h-3 border-t border-r border-primary/50"></div>
                    <p class="text-[10px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-cubes text-primary"></i> Total_Instances
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-text">{{ $summary['totalProjects'] }}</h3>
                </div>

                {{-- Stat 2 --}}
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-green-400/50 transition-colors">
                    <div class="absolute top-0 right-0 w-3 h-3 border-t border-r border-green-400/50"></div>
                    <p class="text-[10px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-circle-play text-green-400"></i> Active_Nodes
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-green-400">{{ $summary['activeCount'] }}</h3>
                </div>

                {{-- Stat 3 --}}
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-yellow-400/50 transition-colors">
                    <div class="absolute top-0 right-0 w-3 h-3 border-t border-r border-yellow-400/50"></div>
                    <p class="text-[10px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-power-off text-yellow-400"></i> Inactive_Drafts
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-yellow-400">{{ $summary['inactiveCount'] }}</h3>
                </div>

                {{-- Stat 4 --}}
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-sky-400/50 transition-colors">
                    <div class="absolute top-0 right-0 w-3 h-3 border-t border-r border-sky-400/50"></div>
                    <p class="text-[10px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-tags text-sky-400"></i> Categories
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-sky-400">{{ $summary['totalCategories'] }}</h3>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- ANALYTICS MATRIX (CHART.JS)                --}}
            {{-- ========================================== --}}
            <div x-data="{ expanded: localStorage.getItem('project_matrix_expanded') !== 'false' }"
                class="relative border border-border/50 bg-surface/10 p-4 md:p-6 space-y-6 transition-all duration-300">
                <div class="flex items-center justify-between border-b border-border/50 pb-4">
                    <h3 class="text-[10px] font-mono uppercase tracking-widest text-primary flex items-center gap-2 cursor-pointer"
                        @click="expanded = !expanded; localStorage.setItem('project_matrix_expanded', expanded)">
                        <i class="fa-solid fa-chart-pie"></i> > DATA_VISUALIZATION_MATRIX
                    </h3>
                    <div class="flex items-center gap-4">
                        <span x-show="expanded"
                            class="text-[9px] font-mono text-green-400 animate-pulse hidden sm:inline-block">[ LIVE_RENDER
                            ]</span>
                        <button @click="expanded = !expanded; localStorage.setItem('project_matrix_expanded', expanded)"
                            type="button"
                            class="text-[10px] font-mono text-muted hover:text-primary transition-colors focus:outline-none">
                            <span x-text="expanded ? '[_COLLAPSE_]' : '[_EXPAND_]'"></span>
                        </button>
                    </div>
                </div>

                <div x-show="expanded" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    {{-- 1. Projects by Type (Doughnut) --}}
                    <div class="relative border border-border/30 bg-[#050505] p-4 group">
                        <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-primary/50"></div>
                        <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-4">> NODE_TYPES_DISTRIBUTION
                        </p>
                        <div class="relative h-48 w-full flex justify-center">
                            <canvas id="typeChart"></canvas>
                        </div>
                    </div>

                    {{-- 2. Project Status (Bar) --}}
                    <div class="relative border border-border/30 bg-[#050505] p-4 group">
                        <div class="absolute top-0 right-0 w-2 h-2 border-t border-r border-primary/50"></div>
                        <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-4">> NODE_STATUS_METRICS</p>
                        <div class="relative h-48 w-full">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>

                    {{-- 3. Projects per Month/Year (Line) - FULL WIDTH --}}
                    <div class="relative border border-border/30 bg-[#050505] p-4 lg:col-span-2 group">
                        <div class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-primary/50"></div>
                        <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-4">> PRODUCTIVITY_TIMELINE
                            (LAST 6 MONTHS)</p>
                        <div class="relative h-64 w-full">
                            <canvas id="timelineChart"></canvas>
                        </div>
                    </div>

                    {{-- 4. Team Size Distribution (Doughnut) --}}
                    <div class="relative border border-border/30 bg-[#050505] p-4 lg:col-span-2 group">
                        <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-primary/50"></div>
                        <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-4">> TEAM_ALLOCATION (SOLO VS
                            TEAM)</p>
                        <div class="relative h-48 w-full flex justify-center">
                            <canvas id="teamChart"></canvas>
                        </div>
                    </div>

                </div>
            </div>

            {{-- CONTROL PANEL --}}
            @php $currentType = request('type', 'all'); @endphp
            <div class="relative border border-border/50 bg-surface/10 p-4 md:p-6 space-y-6">

                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4 border-b border-border/50 pb-6">

                    {{-- Terminal Search Input --}}
                    <div class="relative w-full md:w-1/2 group">
                        <form method="GET">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 font-mono text-primary text-sm">></div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="QUERY_PROJECT_"
                                class="w-full border border-border/70 bg-surface/30 px-4 py-3 pl-8 font-mono text-xs uppercase tracking-widest text-text placeholder:text-muted/50 focus:outline-none focus:border-primary focus:bg-primary/5 transition-colors" />
                            <div
                                class="absolute right-4 top-1/2 -translate-y-1/2 w-1.5 h-3 bg-primary/30 group-focus-within:bg-primary group-focus-within:animate-pulse pointer-events-none">
                            </div>
                        </form>
                    </div>

                    {{-- Action Toggles --}}
                    <div class="flex flex-wrap sm:flex-nowrap items-center gap-3">
                        <form method="GET" class="relative">
                            @foreach (request()->except('sort', 'page') as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                            <select name="sort" onchange="this.form.submit()"
                                class="appearance-none border border-border/70 bg-surface/30 px-8 py-3 pr-12 font-mono text-xs uppercase tracking-widest text-muted hover:text-text focus:outline-none focus:border-primary transition-colors cursor-pointer">
                                <option value="desc" {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>SORT:
                                    NEWEST</option>
                                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>SORT: OLDEST
                                </option>
                            </select>
                            <i
                                class="fa-solid fa-sort absolute right-4 top-1/2 -translate-y-1/2 text-muted pointer-events-none"></i>
                        </form>

                        <button id="toggleSelectMode" type="button"
                            class="px-6 py-3 border border-border/70 bg-surface/30 font-mono text-xs font-bold uppercase tracking-widest text-muted hover:border-primary hover:text-primary transition-colors focus:outline-none focus:border-primary">
                            [SELECT_MULTI]
                        </button>
                    </div>
                </div>

                {{-- Filter Tabs (menggunakan logic JS lama) --}}
                <div class="flex flex-wrap gap-2 border-b border-border/30 pb-4">
                    <button
                        class="filter-btn px-5 py-2 border font-mono text-[10px] font-bold uppercase tracking-widest transition-colors focus:outline-none {{ $currentType == 'all' ? 'border-primary bg-primary/10 text-primary' : 'border-border text-muted hover:border-primary' }}"
                        data-filter="all">ALL_NODES</button>
                    <button
                        class="filter-btn px-5 py-2 border font-mono text-[10px] font-bold uppercase tracking-widest transition-colors focus:outline-none {{ $currentType == 'Website' ? 'border-primary bg-primary/10 text-primary' : 'border-border text-muted hover:border-primary' }}"
                        data-filter="Website">WEBSITE</button>
                    <button
                        class="filter-btn px-5 py-2 border font-mono text-[10px] font-bold uppercase tracking-widest transition-colors focus:outline-none {{ $currentType == 'Application' ? 'border-primary bg-primary/10 text-primary' : 'border-border text-muted hover:border-primary' }}"
                        data-filter="Application">APPLICATION</button>
                    <button
                        class="filter-btn px-5 py-2 border font-mono text-[10px] font-bold uppercase tracking-widest transition-colors focus:outline-none {{ $currentType == 'Design' ? 'border-primary bg-primary/10 text-primary' : 'border-border text-muted hover:border-primary' }}"
                        data-filter="Design">DESIGN</button>
                </div>

            </div>

            {{-- PROJECT GRID CONTAINER (Struktur bawaanmu dipertahankan 100%) --}}
            <div id="projects-container">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    {{-- Create Node Folder --}}
                    @if (
                        $projects instanceof \Illuminate\Pagination\LengthAwarePaginator &&
                            $projects->currentPage() == 1 &&
                            $projects->count())
                        <div class="project-folder group relative border border-dashed border-border bg-surface p-6 pt-12">
                            <div class="absolute top-0 left-6 -translate-y-1/2 flex gap-2 z-20">
                                <span
                                    class="px-4 py-1 text-xs uppercase tracking-widest badge-primary font-semibold">SYSTEM</span>
                                <span
                                    class="px-3 py-1 text-[10px] uppercase tracking-wide border bg-muted/10 text-muted border-border">CREATE</span>
                            </div>
                            <div class="folder-files absolute inset-0 pointer-events-none z-0">
                                <span class="file"></span>
                                <span class="file"></span>
                                <div
                                    class="open-create-modal file file-front pointer-events-auto p-5 flex flex-col items-center justify-center gap-4 text-center">
                                    <div
                                        class="flex items-center justify-center w-16 h-16 text-6xl text-muted group-hover:text-primary group-hover:border-primary transition">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold">Create Project</h3>
                                        <p class="text-sm text-muted mt-1">Add a new portfolio entry</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Loop Projects --}}
                    @forelse ($projects as $project)
                        <div class="project-folder group relative border border-border bg-surface p-6 pt-12 ">
                            <div class="absolute top-0 left-6 -translate-y-1/2 flex gap-2 z-20">
                                <span
                                    class="px-4 py-1 text-xs uppercase tracking-widest badge-primary font-semibold">{{ $project->type }}</span>
                                <span
                                    class="px-3 py-1 text-[10px] uppercase tracking-wide border {{ $project->statusClass }}">{{ $project->status }}</span>
                            </div>

                            <input type="checkbox" name="projects[]" value="{{ $project->id }}"
                                class="bulk-checkbox w-4 h-4 opacity-0 pointer-events-none transition absolute top-3 right-3 z-30">

                            <div class="folder-files absolute inset-0 z-0">
                                <span class="file"></span>
                                <span class="file"></span>
                                <a href="javascript:void(0)"
                                    class="file file-front pointer-events-auto p-5 flex flex-col gap-3 project-open"
                                    data-id="{{ $project->id }}" data-title="{{ $project->title }}"
                                    data-desc="{{ $project->desc }}" data-type="{{ $project->type }}"
                                    data-status="{{ $project->status }}" data-visibility="{{ $project->visibility }}"
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
                                    data-tech='@json($project->tech)'>

                                    <div>
                                        <h3 class="text-xl font-semibold leading-tight">{{ $project->title }}</h3>
                                        <p class="text-sm text-muted leading-snug mt-1">
                                            {{ \Illuminate\Support\Str::limit($project->desc, 100) }}</p>
                                        @if (strlen($project->desc) > 100)
                                            <button
                                                @click="$dispatch('open-desc-modal', { title: '{{ addslashes($project->title) }}', desc: `{!! addslashes($project->desc) !!}` })"
                                                class="text-xs font-medium text-primary mt-1 hover:underline">Selengkapnya</button>
                                        @endif
                                    </div>
                                    <div class="tech-row">
                                        @foreach ($project->visibleTechs as $tech)
                                            <span>{{ strtoupper($tech) }}</span>
                                        @endforeach
                                        @if (count($project->extraTechs) > 0)
                                            <span class="tech-more">+{{ count($project->extraTechs) }}
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
                            class="col-span-full border border-border bg-surface py-20 px-6 flex flex-col items-center justify-center text-center relative overflow-hidden group">
                            <div
                                class="absolute inset-0 bg-[repeating-linear-gradient(45deg,transparent,transparent_10px,rgba(255,255,255,0.01)_10px,rgba(255,255,255,0.01)_20px)] pointer-events-none">
                            </div>
                            <i class="fa-solid fa-ghost text-5xl text-muted/30 mb-6 group-hover:animate-bounce"></i>
                            <h3 class="text-xl font-mono font-bold uppercase tracking-widest text-muted"
                                data-i18n="project.empty.title">NO_NODES_FOUND</h3>
                            <p class="mt-2 text-xs font-mono text-muted/70 max-w-md leading-relaxed"
                                data-i18n="project.empty.desc">System directory is empty. Initialize a new project node to
                                begin data tracking.</p>
                            <button
                                class="open-create-modal mt-8 px-6 py-3 bg-primary/10 border border-primary text-[10px] font-mono font-bold uppercase tracking-widest text-primary hover:bg-primary hover:text-background transition-colors shadow-[0_0_15px_rgba(var(--color-primary-rgb),0.15)] relative z-10">
                                [ INIT_FIRST_NODE ]
                            </button>
                        </div>
                    @endforelse

                </div>

                {{-- PAGINATION --}}
                @if ($projects instanceof \Illuminate\Pagination\LengthAwarePaginator && $projects->hasPages())
                    <div class="flex justify-center pt-12">
                        <nav class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-widest">
                            @if ($projects->onFirstPage())
                                <span
                                    class="px-4 py-2 text-muted border border-border/50 bg-surface/30 opacity-50 cursor-not-allowed">[
                                    PREV ]</span>
                            @else
                                <a href="{{ $projects->previousPageUrl() }}"
                                    class="px-4 py-2 border border-border text-muted hover:border-primary hover:text-primary transition-colors">[
                                    PREV ]</a>
                            @endif

                            <span class="px-4 py-2 border border-primary bg-primary/5 text-primary font-bold">
                                PG_{{ sprintf('%02d', $projects->currentPage()) }} /
                                {{ sprintf('%02d', $projects->lastPage()) }}
                            </span>

                            @if ($projects->hasMorePages())
                                <a href="{{ $projects->nextPageUrl() }}"
                                    class="px-4 py-2 border border-border text-muted hover:border-primary hover:text-primary transition-colors">[
                                    NEXT ]</a>
                            @else
                                <span
                                    class="px-4 py-2 text-muted border border-border/50 bg-surface/30 opacity-50 cursor-not-allowed">[
                                    NEXT ]</span>
                            @endif
                        </nav>
                    </div>
                @endif

            </div>{{-- end #projects-container --}}

            {{-- BULK ACTION BAR (Sticky HUD) --}}
            <div id="bulkBar"
                class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[90] bg-[#0a0a0a]/90 backdrop-blur-md border border-primary/50 p-4 md:px-6 md:py-4 flex flex-col sm:flex-row items-center gap-4 shadow-[0_0_30px_rgba(var(--color-primary-rgb),0.15)] opacity-0 pointer-events-none translate-y-4 transition-all duration-300 w-[90%] md:w-auto min-w-[320px]">

                <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-primary"></div>
                <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-primary"></div>

                <div
                    class="flex items-center gap-3 border-r border-border/50 pr-4 mr-2 w-full sm:w-auto justify-center sm:justify-start">
                    <i class="fa-solid fa-crosshairs text-primary animate-[spin_4s_linear_infinite]"></i>
                    <span id="selectedCount"
                        class="text-[10px] font-mono font-bold uppercase tracking-widest text-primary">0 SELECTED</span>
                </div>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button type="button" onclick="bulkAction('publish')"
                        class="flex-1 sm:flex-none px-4 py-2 border border-border text-[10px] font-mono font-bold uppercase tracking-widest text-muted hover:border-primary hover:text-primary transition-colors">
                        [ PUBLISH ]
                    </button>
                    <button type="button" onclick="bulkAction('delete')"
                        class="flex-1 sm:flex-none px-4 py-2 border border-red-500/50 bg-red-500/10 text-[10px] font-mono font-bold uppercase tracking-widest text-red-500 hover:bg-red-500 hover:text-white transition-colors group">
                        <i class="fa-solid fa-trash-can mr-1 opacity-50 group-hover:opacity-100"></i> [ DELETE ]
                    </button>
                </div>
            </div>

            <form id="bulkForm" method="POST" class="hidden">
                @csrf
            </form>

        </section>
    </div>

@endsection

{{-- Modals dipertahankan utuh di luar wrapper utama --}}
<x-project.detail-modal />
<x-project.edit-modal :technologies="$technologies" />
<x-project.create-modal :technologies="$technologies" />

@push('scripts')
    {{-- Load Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // === KONFIGURASI GLOBAL CHART.JS UNTUK TEMA TERMINAL HUD ===
            Chart.defaults.color = '#71717a'; // text-muted
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
                cornerRadius: 0, // Sudut tajam terminal
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

            // Warna Neons HUD
            const colors = {
                sky: '#38bdf8',
                green: '#4ade80',
                amber: '#fbbf24',
                red: '#f87171',
                primary: '#a855f7',
                bgSky: 'rgba(56, 189, 248, 0.2)',
                bgGreen: 'rgba(74, 222, 128, 0.2)',
                bgAmber: 'rgba(251, 191, 36, 0.2)'
            };

            // 1. PROJECT BY TYPE (Doughnut)
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

            // 2. PROJECT STATUS (Bar)
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

            // 3. PRODUCTIVITY TIMELINE (Line)
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
                        tension: 0.3 // Efek kurva halus
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

            // 4. TEAM SIZE DISTRIBUTION (Doughnut / Solo vs Team)
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

    {{-- Kode Javascript dipertahankan 100% tanpa ubahan agar fungsi AJAX jalan sempurna --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const toggleBtn = document.getElementById('toggleSelectMode');
            const bulkBar = document.getElementById('bulkBar');
            const selectedCountText = document.getElementById('selectedCount');

            let selectMode = new URL(window.location.href).searchParams.has('multiple_select');

            // ══════════════════════════════════════════════════════════════════════════
            // AJAX FETCH + SWAP HELPER
            // ══════════════════════════════════════════════════════════════════════════

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

            // ══════════════════════════════════════════════════════════════════════════
            // AFTER-SWAP: re-init all listeners after #projects-container replaced
            // ══════════════════════════════════════════════════════════════════════════

            function afterSwap() {
                initDetailModalListeners();
                initPaginationLinks();
                attachCardEvents();
                updateBulkBar();
                highlightSearch();
            }

            // ══════════════════════════════════════════════════════════════════════════
            // DETAIL MODAL RE-INIT (for cards created by AJAX swap)
            // ══════════════════════════════════════════════════════════════════════════

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

            // ══════════════════════════════════════════════════════════════════════════
            // PAGINATION LINK INTERCEPTION
            // ══════════════════════════════════════════════════════════════════════════

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
                        /* let native navigation handle */
                    }
                };

                container.addEventListener('click', container._paginationHandler);
            }

            // ══════════════════════════════════════════════════════════════════════════
            // SEARCH
            // ══════════════════════════════════════════════════════════════════════════

            const searchForm = document.querySelector('header form') || document.querySelector('.group form');
            const searchInput = searchForm ? searchForm.querySelector('input[name="search"]') : null;

            if (searchForm && searchInput) {
                searchForm.addEventListener('submit', e => {
                    e.preventDefault();
                    const url = buildUrl({
                        search: searchInput.value || null
                    });
                    ajaxNavigate(url);
                });

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
            }

            // ══════════════════════════════════════════════════════════════════════════
            // FILTER BUTTONS (AJAX)
            // ══════════════════════════════════════════════════════════════════════════

            function initFilterButtons() {
                const filterButtons = document.querySelectorAll('.filter-btn');
                const currentType = new URLSearchParams(window.location.search).get('type') ?? 'all';

                filterButtons.forEach(btn => {
                    const isActive = btn.dataset.filter === currentType;
                    // Disesuaikan dengan class desain baru
                    btn.classList.toggle('border-primary', isActive);
                    btn.classList.toggle('bg-primary/10', isActive);
                    btn.classList.toggle('text-primary', isActive);
                    btn.classList.toggle('border-border', !isActive);
                    btn.classList.toggle('text-muted', !isActive);

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

            // ══════════════════════════════════════════════════════════════════════════
            // SORT DROPDOWN
            // ══════════════════════════════════════════════════════════════════════════

            const sortSelect = document.querySelector('select[name="sort"]');
            if (sortSelect) {
                const sortForm = sortSelect.closest('form');

                sortSelect.onchange = null;
                sortSelect.removeAttribute('onchange');

                sortSelect.addEventListener('change', (e) => {
                    e.preventDefault();
                    const url = buildUrl({
                        sort: sortSelect.value
                    });
                    ajaxNavigate(url);
                });

                if (sortForm) {
                    sortForm.addEventListener('submit', e => e.preventDefault());
                }
            }

            // ══════════════════════════════════════════════════════════════════════════
            // HIGHLIGHT SEARCH RESULTS
            // ══════════════════════════════════════════════════════════════════════════

            function highlightSearch() {
                const keyword = new URLSearchParams(window.location.search).get('search');
                if (!keyword) return;

                const safe = keyword.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                const regex = new RegExp(`(${safe})`, 'gi');

                document.querySelectorAll('.project-folder h3, .project-folder p, .tech-row span').forEach(el => {
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

            // ══════════════════════════════════════════════════════════════════════════
            // BULK BAR + CARD SELECT
            // ══════════════════════════════════════════════════════════════════════════

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
                const cards = document.querySelectorAll('.project-folder');
                const checkboxes = document.querySelectorAll('.bulk-checkbox');

                if (selectMode) {
                    checkboxes.forEach(cb => cb.classList.remove('opacity-0', 'pointer-events-none'));
                } else {
                    checkboxes.forEach(cb => {
                        cb.checked = false;
                        cb.classList.add('opacity-0', 'pointer-events-none');
                    });
                    cards.forEach(card => card.classList.remove('border-primary', 'bg-primary/5'));
                }

                cards.forEach(card => {
                    card.addEventListener('click', function(e) {
                        if (!selectMode) return;

                        const anchor = e.target.closest('.project-open');
                        if (anchor) {
                            e.preventDefault();
                            e.stopImmediatePropagation();
                        }

                        if (e.target.closest('.open-create-modal') || e.target.tagName === 'BUTTON')
                            return;

                        const checkbox = card.querySelector('.bulk-checkbox');
                        if (!checkbox) return;

                        checkbox.checked = !checkbox.checked;
                        card.classList.toggle('border-primary', checkbox.checked);
                        card.classList.toggle('bg-primary/5', checkbox.checked);
                        updateBulkBar();
                    }, true);
                });
            }

            // ── initial attach ───────────────────────────────────────────────────────

            attachCardEvents();
            initPaginationLinks();

            if (selectMode) {
                toggleBtn.innerText = '[ CANCEL_MULTI ]';
                toggleBtn.classList.add('border-red-500', 'text-red-500');
            }

            // ══════════════════════════════════════════════════════════════════════════
            // TOGGLE SELECT MODE (AJAX)
            // ══════════════════════════════════════════════════════════════════════════

            toggleBtn.addEventListener('click', async () => {
                const wasSelectMode = selectMode;
                selectMode = !selectMode;

                const url = new URL(window.location.href);
                const originalText = toggleBtn.innerText;
                toggleBtn.innerText = '[ PROCESSING... ]';
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
                    toggleBtn.innerText = selectMode ? '[ CANCEL_MULTI ]' : '[ SELECT_MULTI ]';

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
