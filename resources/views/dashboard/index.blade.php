@extends('layouts.dashboard')
@section('title', 'Dashboard')

@vite(['resources/css/dashboard_project.css', 'resources/js/app.js'])

@section('content')

<div class="relative">

    {{-- HERO --}}
    <section id="dashboard-hero"
        class="py-32 max-w-6xl mx-auto px-8 space-y-10 overflow-hidden">

        <p class="text-xs uppercase tracking-widest text-muted">
            Index / dashboard
        </p>

        <h1 class="text-[clamp(3rem,7vw,6rem)] font-semibold leading-[1.1]">
            <span class="text-text">
                Portfolio Dashboard
            </span>
            <span class="block text-muted font-normal">
                Build & Publish
            </span>
        </h1>

        <p class="text-muted max-w-xl leading-relaxed">
            Manage your work in one place.
        </p>

        <div class="flex flex-wrap gap-6">
            <a href="/dashboard/projects/create"
                class="cta-btn relative overflow-hidden px-4 py-2
                    bg-primary text-text font-semibold border-2 border-border"
                style="--cta-bubble-color: var(--color-bg);">
                <span class="cta-bubble"></span>
                <span class="cta-text relative z-10">+ New Project</span>
            </a>

            <a href="/dashboard/settings"
                class="cta-btn relative overflow-hidden px-4 py-2
                    border-2 border-border text-text font-semibold"
                style="--cta-bubble-color: #ef4444;">

                <span class="cta-bubble"></span>
                <span class="cta-text relative z-10">Settings</span>
            </a>
        </div>
    </section>

    {{-- SUMMARY --}}
    <section class="py-28 max-w-6xl mx-auto px-8 space-y-16">

        <p class="text-xs uppercase tracking-widest text-muted">
            index / summary
        </p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-y-16 gap-x-12">
            <div class="space-y-2">
                <p class="text-xs uppercase text-muted">Projects</p>
                <p class="text-3xl font-semibold">12</p>
            </div>

            <div class="space-y-2">
                <p class="text-xs uppercase text-muted">Active</p>
                <p class="text-3xl font-semibold">5</p>
            </div>

            <div class="space-y-2">
                <p class="text-xs uppercase text-muted">Archived</p>
                <p class="text-3xl font-semibold">3</p>
            </div>

            <div class="space-y-2">
                <p class="text-xs uppercase text-muted">Tech</p>
                <p class="text-3xl font-semibold">14</p>
            </div>
        </div>
    </section>

    {{-- RECENT PROJECTS --}}
    <section id="projects-index"
        class="relative max-w-6xl mx-auto px-4 py-28 space-y-20 overflow-hidden">

        <header class="space-y-6 max-w-xl">
            <p class="text-xs uppercase tracking-widest text-muted">
                Index / recent
            </p>

            <h2 class="text-[clamp(2rem,5vw,3.5rem)] font-semibold leading-tight">
                Recent Projects
            </h2>

            <p class="text-muted leading-relaxed">
                Some recent projects that are currently or have been worked on.
            </p>

            <p class="text-muted max-w-xl">
                @if ($latestProject)
                    Latest project updated · {{ $latestProject->updated_at->diffForHumans() }}
                @else
                    No project activity yet
                @endif
            </p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            @forelse ($recentProjects as $project)

                <div class="project-folder group relative border border-border bg-surface p-4 pt-8">

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

                        <a href="{{ $project['repo'] }}" target="_blank"
                           class="file file-front pointer-events-auto p-4 flex flex-col gap-2">
                            <div class="flex flex-col h-full">
                                <div>
                                    <h3 class="text-lg font-semibold leading-tight">
                                        {{ $project->title }}
                                    </h3>

                                    <p class="text-xs text-muted leading-snug mt-2">
                                        {{ $project->desc }}
                                    </p>
                                </div>

                                <div class="mt-auto tech-row">
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
                            </div>
                        </a>
                    </div>

                </div>

            @empty
                <div class="col-span-full">
                    <p class="text-xs uppercase tracking-widest text-muted">
                        index / empty
                    </p>

                    <h3 class="mt-6 text-[clamp(1.5rem,4vw,2rem)] font-semibold max-w-xl">
                        No Projects Yet
                    </h3>

                    <p class="mt-2 text-muted max-w-md leading-relaxed">
                        Start by creating your first project.
                    </p>
                </div>
            @endforelse
        </div>
    </section>
</div>

@endsection
