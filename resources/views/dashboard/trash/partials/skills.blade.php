<div class="space-y-10 mt-8 font-sans">
    @forelse ($groupedSkills as $month => $skills)
        <div class="space-y-6">

            <div class="flex items-center justify-between border-b-2 border-dashed border-border/60 pb-3 relative">
                <div class="absolute -left-2 top-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-background border-2 border-border/60"></div>

                <h2 class="text-2xl font-serif font-bold text-text pl-6 flex items-center gap-3">
                    {{ $month }}
                    <span class="text-xs font-sans px-2 py-0.5 bg-border/20 text-muted rounded-full">{{ count($skills) }} Item</span>
                </h2>

                <button type="button"
                    class="skills-month-select px-3 py-1.5 bg-surface border-2 border-border text-[10px] font-bold uppercase tracking-widest text-muted hover:border-primary hover:text-primary transition-colors rounded-sm shadow-sm hidden"
                    data-month="{{ Str::slug($month) }}">
                    Pilih Semua
                </button>
            </div>

            <div class="grid grid-cols-1 gap-4">
                @foreach ($skills as $index => $skill)
                    @php
                        $rotation = $index % 2 === 0 ? 'rotate-[0.5deg]' : '-rotate-[0.5deg]';
                    @endphp

                    <div class="skill-card border-2 border-border bg-[#FCFAEF] p-5 md:p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 transition-all hover:-translate-y-1 shadow-[4px_4px_0px_var(--color-border)] rounded-sm {{ $rotation }} hover:rotate-0"
                        data-month="{{ Str::slug($month) }}">

                        <div class="flex items-start md:items-center gap-5 w-full md:w-auto">
                            <div class="pt-1 md:pt-0 relative">
                                <input type="checkbox" name="skills[]" value="{{ $skill->id }}"
                                    class="bulk-skill-checkbox w-5 h-5 border-2 border-border rounded appearance-none checked:bg-primary checked:border-primary transition-colors cursor-pointer shadow-sm opacity-0 pointer-events-none">
                            </div>

                            <div class="text-2xl text-muted w-12 h-12 shrink-0 flex items-center justify-center bg-surface border-2 border-dashed border-border shadow-sm rotate-3">
                                {!! $skill->icon !!}
                            </div>

                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="text-lg font-bold font-serif text-neutral-800 line-clamp-1">
                                        {{ $skill->name }}
                                    </h3>
                                    <span class="px-2 py-0.5 text-[9px] font-bold uppercase tracking-widest border border-border/50 bg-background/50 text-muted rounded-sm">
                                        {{ $skill->category }}
                                    </span>
                                </div>

                                <p class="text-xs font-mono text-muted mb-2">
                                    <i class="fa-regular fa-clock mr-1"></i> Dihapus: {{ $skill->deleted_at->format('d M Y - H:i') }}
                                </p>

                                @php
                                    $retention = config('app.trash_retention_days', 30);
                                    $deleteAt = $skill->deleted_at->copy()->addDays($retention);
                                    $daysLeft = now()->diffInDays($deleteAt, false);
                                @endphp

                                <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded bg-surface border border-border text-[10px] uppercase font-bold tracking-wider shadow-inner">
                                    @if ($daysLeft > 0)
                                        @if ($daysLeft <= 5)
                                            <i class="fa-solid fa-triangle-exclamation text-yellow-500 animate-pulse"></i>
                                            <span class="text-yellow-600">Sisa {{ intval($daysLeft) }} hari</span>
                                        @else
                                            <i class="fa-solid fa-hourglass-half text-muted"></i>
                                            <span class="text-muted">Hapus dalam {{ intval($daysLeft) }} hari</span>
                                        @endif
                                    @else
                                        <i class="fa-solid fa-fire text-red-500"></i>
                                        <span class="text-red-600 font-black">Dijadwalkan untuk dihapus</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 w-full md:w-auto pt-4 md:pt-0 border-t border-dashed border-border/50 md:border-0 mt-2 md:mt-0 normal-skill-actions">
                            <button type="button"
                                data-restore-url="{{ route('dashboard.skills.restore', $skill->id) }}"
                                class="restore-trash-btn flex-1 md:flex-none w-full md:w-auto px-4 py-2 bg-emerald-50 border-2 border-emerald-200 text-emerald-700 text-xs font-bold uppercase tracking-widest hover:bg-emerald-100 hover:border-emerald-400 transition-colors rounded-sm shadow-sm flex justify-center items-center gap-2">
                                <i class="fa-solid fa-trash-arrow-up"></i> Restore
                            </button>

                            <button type="button"
                                data-delete-url="{{ route('dashboard.skills.forceDelete', $skill->id) }}"
                                class="delete-trash-btn flex-1 md:flex-none px-4 py-2 bg-red-50 border-2 border-red-200 text-red-600 text-xs font-bold uppercase tracking-widest hover:bg-red-500 hover:text-white hover:border-red-600 transition-colors rounded-sm shadow-sm flex justify-center items-center gap-2">
                                <i class="fa-solid fa-ban"></i> Hapus Permanen
                            </button>
                        </div>

                    </div>
                @endforeach
            </div>

            @if (!$multipleSelect && $skills instanceof \Illuminate\Pagination\LengthAwarePaginator && $skills->hasPages())
                <div class="flex justify-center pt-12 md:pt-16 pb-8">
                    <nav class="flex flex-wrap sm:flex-nowrap items-center justify-center gap-3 sm:gap-4 font-mono w-full sm:w-auto px-4">
                        @if ($skills->onFirstPage())
                            <span class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted opacity-30 cursor-not-allowed italic font-serif bg-container"><i class="fa-solid fa-chevron-left text-[10px] sm:text-xs"></i></span>
                        @else
                            <a href="{{ $skills->previousPageUrl() }}" class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted hover:border-primary hover:text-primary hover:-translate-y-0.5 transition-all shadow-sm bg-container"><i class="fa-solid fa-chevron-left text-[10px] sm:text-xs pointer-events-none"></i></a>
                        @endif

                        <div class="px-4 py-1.5 sm:px-6 sm:py-2 bg-warning border-2 border-yellow-500 rounded-full shadow-[2px_2px_0px_var(--color-border)] rotate-1 shrink-0">
                            <span class="text-[10px] sm:text-xs font-black text-yellow-900 uppercase tracking-widest whitespace-nowrap">
                                {{ sprintf('%02d', $skills->currentPage()) }} <span class="opacity-50 mx-1">/</span> {{ sprintf('%02d', $skills->lastPage()) }}
                            </span>
                        </div>

                        @if ($skills->hasMorePages())
                            <a href="{{ $skills->nextPageUrl() }}" class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted hover:border-primary hover:text-primary hover:-translate-y-0.5 transition-all shadow-sm bg-container"><i class="fa-solid fa-chevron-right text-[10px] sm:text-xs pointer-events-none"></i></a>
                        @else
                            <span class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted opacity-30 cursor-not-allowed italic font-serif bg-container"><i class="fa-solid fa-chevron-right text-[10px] sm:text-xs"></i></span>
                        @endif
                    </nav>
                </div>
            @endif
        </div>
    @empty
        <div class="col-span-full py-20 px-6 flex flex-col items-center justify-center text-center bg-[#fdfcf5] border-2 border-dashed border-[#e5e0d0] rounded-xl shadow-[4px_4px_0px_rgba(0,0,0,0.05)] relative overflow-hidden mt-8">
            <div class="absolute inset-0 z-0 opacity-30" style="background-image: repeating-linear-gradient(transparent, transparent 24px, #e5e0d0 24px, #e5e0d0 25px);"></div>

            <div class="relative z-20 space-y-4">
                <div class="w-20 h-20 mx-auto rounded-full bg-surface border-2 border-dashed border-border flex items-center justify-center -rotate-3 shadow-sm">
                    <i class="fa-solid fa-box-open text-3xl text-muted/50"></i>
                </div>
                <h3 class="text-3xl font-serif font-bold text-neutral-800 tracking-wide">Tempat Sampah Bersih</h3>
                <p class="text-sm text-muted max-w-sm mx-auto italic opacity-90">
                    Tidak ada *skill* yang sedang dalam masa penghapusan saat ini.
                </p>
                <a href="{{ route('dashboard.skills.index') }}" class="inline-block mt-4 px-6 py-2 bg-surface border-2 border-border rounded-lg text-xs font-bold uppercase tracking-widest text-text hover:border-primary transition-colors shadow-sm">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    @endforelse
</div>
