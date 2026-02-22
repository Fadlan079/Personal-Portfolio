@extends('layouts.dashboard')
@section('title', 'Project')

@vite(['resources/css/dashboard_project.css', 'resources/js/app.js'])

@section('content')
<section id="dashboard-project-hero"
    class="relative py-28 max-w-7xl mx-auto px-6 space-y-12 overflow-hidden">

    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-10">

        <div class="space-y-6 max-w-2xl">

            <p class="text-xs uppercase tracking-widest text-muted">
                Index / Projects
            </p>

            <h1 class="text-[clamp(3rem,7vw,5.5rem)] font-semibold leading-[1.05]">
                <span class="text-text">
                    Project Control
                </span>
                <span class="block text-muted font-normal">
                    Manage · Track · Publish
                </span>
            </h1>

            <p class="text-muted leading-relaxed">
                Centralized workspace to create, edit, organize, and monitor all your portfolio projects.
                Update status, manage repositories, and keep everything production-ready.
            </p>

            <div class="flex flex-wrap gap-3 text-xs uppercase tracking-wide text-muted">

                <span class="px-3 py-1 border border-border">
                    {{ $summary['totalProjects'] }} Total Projects
                </span>

                <span class="px-3 py-1 border border-border">
                    {{ $summary['activeCount'] }} Active
                </span>

                <span class="px-3 py-1 border border-border">
                    {{ $summary['inactiveCount'] }} Archived / Draft
                </span>

            </div>

        </div>

        <div class="flex flex-wrap gap-4">

            <a href="/dashboard/projects/create"
                class="cta-btn relative overflow-hidden px-5 py-3
                    bg-primary text-text font-semibold border-2 border-border"
                style="--cta-bubble-color: var(--color-bg);">

                <span class="cta-bubble"></span>
                <span class="cta-text relative z-10">
                    + Create Project
                </span>
            </a>

            <a href="/dashboard/settings"
                class="cta-btn relative overflow-hidden px-5 py-3
                    border-2 border-border text-text font-semibold"
                style="--cta-bubble-color: #ef4444;">

                <span class="cta-bubble"></span>
                <span class="cta-text relative z-10">
                    System Settings
                </span>
            </a>

        </div>
    </div>

    <div class="h-px bg-border w-full opacity-40"></div>

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

        <div class="project-folder group relative border border-dashed border-border bg-surface p-6 pt-12">
                <div class="absolute top-0 left-6 -translate-y-1/2 flex gap-2 z-20">
                    <span class="px-4 py-1 text-xs uppercase tracking-widest badge-primary font-semibold">
                        SYSTEM
                    </span>
                    <span class="px-3 py-1 text-[10px] uppercase tracking-wide border bg-muted/10 text-muted border-border">
                        CREATE
                    </span>
                </div>

            <div class="folder-files absolute inset-0 pointer-events-none z-0">
                <span class="file"></span>
                <span class="file"></span>

                <div id="openCreateModal"
                class="file file-front pointer-events-auto
                        p-5 flex flex-col items-center justify-center
                        gap-4 text-center">

                    <div class="flex items-center justify-center
                                w-16 h-16 text-6xl text-muted
                                group-hover:text-primary
                                group-hover:border-primary
                                transition">

                        <i class="fas fa-plus"></i>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold">
                            Create Project
                        </h3>

                        <p class="text-sm text-muted mt-1">
                            Add a new portfolio entry
                        </p>
                    </div>

                </div>
            </div>
        </div>

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
@endsection

<x-project.detail-modal />

<x-project.edit-modal />

<x-project.create-modal :technologies="$technologies" />
@section('script')
@vite([
'resources/js/project/detail-modal.js',
'resources/js/project/edit-modal.js',
'resources/js/project/create-modal.js',
'resources/js/project/filtes.js'
])
@endsection
