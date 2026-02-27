@forelse ($groupedProjects as $month => $projects)
    <div class="space-y-6">
        <div class="flex items-center justify-between border-b border-border pb-3">
            <h2 class="text-2xl font-semibold">
                {{ $month }}
            </h2>
            <button type="button"
                class="month-select text-xs px-3 py-1 border border-border hover:border-primary hidden"
                data-month="{{ Str::slug($month) }}">
                Select All
            </button>
        </div>

        <div class="space-y-4">
            @foreach ($projects as $project)
                <div class="project-card border border-border bg-surface p-6 flex justify-between items-center gap-6 cursor-pointer"
                    data-month="{{ Str::slug($month) }}">

                    <div class="flex items-center gap-4">
                        <input type="checkbox"
                            name="projects[]"
                            value="{{ $project->id }}"
                            class="bulk-checkbox w-4 h-4 opacity-0 pointer-events-none transition">

                        <div>
                            <h3 class="font-semibold">
                                {{ $project->title }}
                            </h3>
                            <p class="text-sm text-muted">
                                Deleted:
                                {{ $project->deleted_at->format('d M Y - H:i') }}
                            </p>

                            @php
                                $retention = config('app.trash_retention_days');
                                $deleteAt = $project->deleted_at->copy()->addDays($retention);
                                $daysLeft = now()->diffInDays($deleteAt, false);
                            @endphp

                            @if($daysLeft > 0)
                                <p class="text-xs text-red-400 mt-1">
                                    Permanently deleted in {{ intval($daysLeft) }} day{{ $daysLeft != 1 ? 's' : '' }}
                                </p>
                            @else
                                <p class="text-xs text-red-500 mt-1 font-semibold">
                                    Scheduled for permanent deletion
                                </p>
                            @endif

                            @if($daysLeft <= 5 && $daysLeft > 0)
                                <p class="text-xs text-yellow-400 mt-1">
                                    ⚠ Only {{ $daysLeft }} days remaining
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-3 normal-actions">
                        <form method="POST"
                            action="{{ route('dashboard.projects.restore', $project->id) }}">
                            @csrf
                            <button class="text-xs px-3 py-1 border border-border hover:border-primary">
                                Restore
                            </button>
                        </form>

                        <button
                            type="button"
                            data-delete-url="{{ route('dashboard.projects.forceDelete', $project->id) }}"
                            class="delete-trash-btn text-xs px-3 py-1 border border-red-500 text-red-400 hover:bg-red-500/10 transition-colors">
                            Delete
                        </button>
                    </div>

                </div>
            @endforeach

            @if(!$multipleSelect && $projects instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="pt-6 pagination-wrapper">
                    <div class="flex justify-center">
                        <nav class="flex items-center gap-2 text-sm">
                            @if ($projects->onFirstPage())
                                <span class="px-3 py-2 text-muted border border-border">Prev</span>
                            @else
                                <a href="{{ $projects->previousPageUrl() }}" class="px-3 py-2 border border-border hover:border-primary">Prev</a>
                            @endif

                            <span class="px-4 py-2 border border-border">
                                {{ $projects->currentPage() }} / {{ $projects->lastPage() }}
                            </span>

                            @if ($projects->hasMorePages())
                                <a href="{{ $projects->nextPageUrl() }}" class="px-3 py-2 border border-border hover:border-primary">Next</a>
                            @else
                                <span class="px-3 py-2 text-muted border border-border">Next</span>
                            @endif
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </div>
@empty
    <div class="border border-border bg-surface py-20 px-6 text-center flex flex-col items-center justify-center gap-6">
        <div class="w-20 h-20 flex items-center justify-center border border-border/50 bg-background/40">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-10 h-10 text-muted"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 7h12M9 7V4h6v3m-7 4v6m4-6v6m5 0a2 2 0 002-2V7H4v10a2 2 0 002 2h12z" />
            </svg>
        </div>
        <h2 class="text-2xl font-semibold tracking-wide">
            No Deleted Projects
        </h2>
        <p class="text-muted text-sm max-w-md">
            There are currently no soft-deleted projects matching your filter.
        </p>
    </div>
@endforelse
