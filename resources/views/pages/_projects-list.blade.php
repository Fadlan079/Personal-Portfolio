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
                    <h3 class="text-xl font-semibold leading-tight">{{ $project->title }}</h3>
                    <p class="text-sm text-muted leading-snug mt-1">{{ $project->desc }}</p>
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
        <p class="text-xs uppercase tracking-widest text-muted">index / empty</p>
        <h3 class="mt-6 text-[clamp(1.5rem,4vw,2rem)] font-semibold max-w-xl" data-i18n="project.empty.title"></h3>
        <p class="mt-2 text-muted max-w-md leading-relaxed" data-i18n="project.empty.desc"></p>
    </div>
@endforelse
