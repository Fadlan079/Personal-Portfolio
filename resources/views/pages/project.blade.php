@extends('layouts.main')
@section('title', 'Project')
@vite(['resources/css/project.css'])
@section('content')
<section id="projects-hero" class="py-34 max-w-7xl mx-auto px-6 space-y-10 overflow-hidden">
    <p class="text-xs uppercase tracking-widest text-muted">
    index / intro
    </p>

  <h1 class="text-[clamp(3.5rem,9vw,7rem)] font-semibold leading-[1.1]">
    <span class="text-text" data-i18n="project.hero.title"></span>
    <span class="block text-muted font-normal" data-i18n="project.hero.subtitle"></span>
  </h1>

  <p class="text-muted max-w-xl leading-relaxed" data-i18n="project.hero.description"></p>

    <div class="text-xs uppercase tracking-widest text-muted" data-i18n="project.hero.note"></div>
</section>

<section id="projects-index" class="relative max-w-6xl mx-auto px-6 py-32 space-y-24 overflow-hidden">
    <header class="space-y-6 max-w-xl">
        <p class="text-xs uppercase tracking-widest text-muted">
            index / selected
        </p>

        <h2 class="text-[clamp(2.5rem,6vw,4rem)] font-semibold leading-tight" data-i18n="project.index.title"></h2>

        <p class="text-muted leading-relaxed" data-i18n="project.index.description"></p>

        <div class="summary-row">

            <span class="summary-badge">
                {{ $summary['totalProjects'] }}
                <span data-i18n="project.index.summary.projects"></span>
            </span>

            <span class="summary-badge">
                {{ $summary['totalCategories'] }}
                <span data-i18n="project.index.summary.categories"></span>
            </span>

            <span class="summary-badge">
                {{ $summary['activeCount'] }}
                <span data-i18n="project.index.summary.active"></span>
            </span>

            @if ($summary['inactiveCount'] > 0)
                <span class="summary-more">
                    +{{ $summary['inactiveCount'] }}

                    <span class="summary-tooltip">
                        <span data-i18n="project.index.summary.status.shipped"></span>:
                        {{ $summary['statusBreakdown']['Shipped'] }}<br>

                        <span data-i18n="project.index.summary.status.in_progress"></span>:
                        {{ $summary['statusBreakdown']['In Progress'] }}<br>

                        <span data-i18n="project.index.summary.status.prototype"></span>:
                        {{ $summary['statusBreakdown']['Prototype'] }}<br>

                        <span data-i18n="project.index.summary.status.archived"></span>:
                        {{ $summary['statusBreakdown']['Archived'] }}
                    </span>
                </span>
            @endif
        </div>
    </header>

    <div class="flex flex-wrap justify-between items-center gap-4">
        <div class="relative w-full md:w-1/3">
            <input
                type="text"
                id="project-search"
                placeholder="Search projects..."
                class="w-full border border-border px-4 py-2 pl-10 text-sm placeholder:text-muted focus:outline-none focus:ring-1 focus:ring-primary"/>
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-muted">
                <i class="fas fa-search"></i>
            </span>
        </div>

        <div class="flex flex-wrap gap-2">
            <button class="filter-btn px-4 py-2 border border-border text-sm" data-filter="all">All</button>
            <button class="filter-btn px-4 py-2 border border-border text-sm" data-filter="Website">Website</button>
            <button class="filter-btn px-4 py-2 border border-border text-sm" data-filter="Application">Application</button>
            <button class="filter-btn px-4 py-2 border border-border text-sm" data-filter="Design">Design</button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($projects as $project)
            <div class="project-folder group relative border border-border bg-surface p-6 pt-12 ">
                <div class="absolute top-0 left-6 -translate-y-1/2 flex gap-2 z-20">
                    <span class="px-4 py-1 text-xs uppercase tracking-widest badge-primary font-semibold">
                        {{ $project->type}}
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
                            data-id="{{ $project->id }}"
                            data-title="{{ $project->title }}"
                            data-desc="{{ $project->desc }}"
                            data-type="{{ $project->type }}"
                            data-status="{{ $project->status }}"
                            data-created="{{ $project->created_at->format('d M Y') }}"
                            data-updated="{{ $project->updated_at->format('d M Y') }}"
                            data-repo="{{ $project->repo }}"
                            data-role="{{ $project->role }}"
                            data-team="{{ $project->team_size }}"
                            data-responsibilities="{{ $project->responsibilities }}"
                            data-live="{{ $project->live_url }}"
                            data-screenshot='@json(
                                $project->screenshot
                                    ? collect($project->screenshot)
                                        ->map(fn($img) => asset("storage/".$img))
                                        ->values()
                                    : []
                            )'
                            data-tech='@json($project->tech)'>
                        <div>
                            <h3 class="text-xl font-semibold leading-tight">
                                {{ $project->title}}
                            </h3>


                            <p class="text-sm text-muted leading-snug mt-1">
                                {{ $project->desc}}
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
            <div class="col-span-full">
                <p class="text-xs uppercase tracking-widest text-muted">
                    index / empty
                </p>

                <h3 class="mt-6 text-[clamp(1.5rem,4vw,2rem)] font-semibold max-w-xl" data-i18n="project.empty.title"></h3>

                <p class="mt-2 text-muted max-w-md leading-relaxed" data-i18n="project.empty.desc"></p>
            </div>
        @endforelse
    </div>

    @if ($projects->hasPages())
    <div class="flex justify-center">
        <nav class="flex items-center gap-2 text-sm">

            @if ($projects->onFirstPage())
                <span class="px-3 py-2 text-muted border border-border">Prev</span>
            @else
                <a href="{{ $projects->previousPageUrl() }}"
                class="px-3 py-2 border border-border hover:border-primary">
                Prev
                </a>
            @endif

            <span class="px-4 py-2 border border-border">
                {{ $projects->currentPage() }} / {{ $projects->lastPage() }}
            </span>

            @if ($projects->hasMorePages())
                <a href="{{ $projects->nextPageUrl() }}"
                class="px-3 py-2 border border-border hover:border-primary">
                Next
                </a>
            @else
                <span class="px-3 py-2 text-muted border border-border">Next</span>
            @endif

        </nav>
    </div>
    @endif
</section>

<section id="projects-end" class="py-32 border-t border-border overflow-hidden">
  <div class="max-w-6xl mx-auto px-6 space-y-10">

    <p class="text-xs uppercase tracking-widest text-muted">
    index / end
    </p>

    <h3 id="projects-end-title"
        data-i18n="project.end.title"
        class="text-[clamp(2rem,5vw,3rem)] font-semibold leading-tight max-w-2xl">
    </h3>

    <p class="text-muted max-w-xl leading-relaxed" data-i18n="project.end.description"></p>

  </div>
</section>

@endsection

<x-project.detail-modal />

@section('script')
@vite(['resources/js/project/filters.js','resources/js/project/detail-modal.js',])
@endsection
