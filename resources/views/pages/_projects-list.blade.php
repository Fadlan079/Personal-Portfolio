{{--
    Partial: project cards grid
    Rendered server-side, injected via AJAX into #projects-grid
--}}
@forelse ($projects as $project)
    <div class="project-folder group relative border border-border bg-surface p-6 pt-12">
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

            <a href="javascript:void(0)" class="file file-front pointer-events-auto p-5 flex flex-col gap-3 project-open"
                data-id="{{ $project->id }}" data-title="{{ $project->title }}" data-desc="{{ $project->desc }}"
                data-type="{{ $project->type }}" data-status="{{ $project->status }}"
                data-created="{{ $project->created_at->format('d M Y') }}"
                data-updated="{{ $project->updated_at->format('d M Y') }}" data-repo="{{ $project->repo }}"
                data-role="{{ $project->role }}" data-team="{{ $project->team_size }}"
                data-responsibilities="{{ $project->responsibilities }}" data-live="{{ $project->live_url }}"
                data-screenshot='@json($project->screenshot ? collect($project->screenshot)->map(fn($img) => asset('storage/' . $img))->values() : [])' data-tech='@json($project->tech)'>

                <div>
                    <h3 class="text-xl font-semibold leading-tight">{{ $project->title }}</h3>
                    <p class="text-sm text-muted leading-snug mt-1 line-clamp-2">{{ \Illuminate\Support\Str::limit($project->desc, 100) }}</p>
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
