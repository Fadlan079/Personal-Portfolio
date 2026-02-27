<div class="space-y-6 mt-8">
    <div class="flex items-center justify-between border-b border-border pb-3">
        <h2 class="text-2xl font-semibold">
            Skills
        </h2>
        <button type="button"
            class="skills-select text-xs px-3 py-1 border border-border hover:border-primary hidden"
            >
            Select All Skills
        </button>
    </div>

    <!-- We use the same 'tags grid' approach for skills to match the aesthetic -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
@forelse ($skills as $skill)
    @php
        $catBorder = match($skill->category) {
            'frontend' => 'border-sky-500',
            'backend'  => 'border-red-500',
            'tools'    => 'border-amber-500',
            default    => 'border-muted',
        };
    @endphp

    <div class="group relative flex flex-col justify-between p-5 border border-border bg-surface transition-all duration-200 hover:z-10 hover:border-primary">
        
        <div class="flex justify-between items-start mb-8">
            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-muted border-b-2 {{ $catBorder }} pb-0.5">
                {{ $skill->category }}
            </span>

            <div class="flex gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                <button type="button" class="edit-skill-btn text-muted hover:text-primary transition-colors"
                        data-id="{{ $skill->id }}" data-name="{{ $skill->name }}">
                    <i class="fa-solid fa-pen text-[10px]"></i>
                </button>
                <button type="button" class="delete-skill-btn text-muted hover:text-red-500 transition-colors"
                        data-id="{{ $skill->id }}">
                    <i class="fa-solid fa-trash text-[10px]"></i>
                </button>
            </div>
        </div>

        <div class="flex items-end gap-4">
            <div class="text-2xl text-muted grayscale group-hover:grayscale-0 group-hover:text-primary transition-all">
                {!! $skill->icon !!}
            </div>
            
            <div class="flex-1 border-b border-border/50 pb-1 flex justify-between items-baseline">
                <h3 class="text-base font-bold uppercase tracking-tight text-text">
                    {{ $skill->name }}
                </h3>
                <span class="text-[10px] font-mono text-muted">
                    {{ str_pad($skill->projects_count, 2, '0', STR_PAD_LEFT) }}
                </span>
            </div>
        </div>

    </div>

@empty
    <div class="col-span-full border border-dashed border-border p-12 text-center">
        <p class="text-xs uppercase tracking-widest text-muted">No Data Found</p>
        <button onclick="window.openCreateSkillModal()" class="mt-4 text-xs font-bold border-b border-text pb-1 hover:text-primary hover:border-primary transition-all">
            + ADD SKILL
        </button>
    </div>
@endforelse
    </div>

    @if(!$multipleSelect && $skills instanceof \Illuminate\Pagination\LengthAwarePaginator && $skills->hasPages())
        <div class="pt-6 pagination-wrapper-skills">
            <div class="flex justify-center">
                <nav class="flex items-center gap-2 text-sm">
                    @if ($skills->onFirstPage())
                        <span class="px-3 py-2 text-muted border border-border">Prev</span>
                    @else
                        <a href="{{ $skills->previousPageUrl() }}" class="px-3 py-2 border border-border hover:border-primary">Prev</a>
                    @endif

                    <span class="px-4 py-2 border border-border">
                        {{ $skills->currentPage() }} / {{ $skills->lastPage() }}
                    </span>

                    @if ($skills->hasMorePages())
                        <a href="{{ $skills->nextPageUrl() }}" class="px-3 py-2 border border-border hover:border-primary">Next</a>
                    @else
                        <span class="px-3 py-2 text-muted border border-border">Next</span>
                    @endif
                </nav>
            </div>
        </div>
    @endif
</div>
