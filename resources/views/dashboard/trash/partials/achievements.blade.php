@forelse ($groupedAchievements as $month => $achievements)
    <div class="space-y-6">
        <div class="flex items-center justify-between border-b-2 border-dashed border-border/60 pb-3 relative">
            <div class="absolute -left-2 top-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-background border-2 border-border/60"></div>
            <h2 class="text-2xl font-serif font-bold text-text pl-6 flex items-center gap-3">
                {{ $month }}
                <span class="text-xs font-sans px-2 py-0.5 bg-border/20 text-muted rounded-full">{{ count($achievements) }} Item</span>
            </h2>
            <button type="button"
                class="month-select px-3 py-1.5 bg-surface border-2 border-border text-[10px] font-bold uppercase tracking-widest text-muted hover:border-primary hover:text-primary transition-colors rounded-sm shadow-sm hidden"
                data-month="ach-{{ Str::slug($month) }}">
                Pilih Semua
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($achievements as $index => $ach)
                <div class="achievement-card border-2 border-border bg-[#FCFAEF] p-5 flex flex-col justify-between gap-4 transition-all hover:-translate-y-1 shadow-[4px_4px_0px_var(--color-border)] rounded-sm"
                    data-month="ach-{{ Str::slug($month) }}">
                    
                    <div class="flex gap-4">
                        <div class="relative pt-1">
                            <input type="checkbox"
                                name="achievements[]"
                                value="{{ $ach->id }}"
                                class="bulk-achievement-checkbox w-5 h-5 border-2 border-border rounded appearance-none checked:bg-primary checked:border-primary transition-colors cursor-pointer shadow-sm opacity-0 pointer-events-none">
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold font-serif text-neutral-800 mb-1 line-clamp-1">{{ $ach->title }}</h3>
                            <p class="text-[10px] font-mono text-muted mb-2">
                                <i class="fa-regular fa-clock mr-1"></i> Dihapus: {{ $ach->deleted_at->format('d M Y - H:i') }}
                            </p>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-stone-500 bg-stone-200/50 px-2 py-0.5 rounded italic">
                                {{ $ach->issuer }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-dashed border-border/50 normal-achievement-actions">
                        <button type="button"
                            data-restore-url="{{ route('dashboard.achievements.restore', $ach->id) }}"
                            class="restore-trash-btn flex-1 px-4 py-2 bg-emerald-50 border-2 border-emerald-200 text-emerald-700 text-[10px] font-bold uppercase tracking-widest hover:bg-emerald-100 hover:border-emerald-400 transition-all rounded-sm shadow-sm flex justify-center items-center gap-2">
                            <i class="fa-solid fa-trash-arrow-up"></i> Restore
                        </button>
                        <button type="button"
                            data-delete-url="{{ route('dashboard.achievements.forceDelete', $ach->id) }}"
                            class="delete-trash-btn flex-1 px-4 py-2 bg-rose-50 border-2 border-rose-200 text-rose-600 text-[10px] font-bold uppercase tracking-widest hover:bg-rose-500 hover:text-white hover:border-rose-600 transition-all rounded-sm shadow-sm flex justify-center items-center gap-2">
                            <i class="fa-solid fa-ban"></i> Hapus
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        @if (!$multipleSelect && $achievements instanceof \Illuminate\Pagination\LengthAwarePaginator && $achievements->hasPages())
             <div class="pagination-wrapper-achievements flex justify-center pt-8">
                <!-- Pagination logic standard laravel view items logic but simplified here if needed -->
                {!! $achievements->links() !!}
             </div>
        @endif
    </div>
@empty
    <div class="col-span-full py-16 px-6 flex flex-col items-center justify-center text-center bg-[#fdfcf5] border-2 border-dashed border-[#e5e0d0] rounded-xl mt-8">
        <i class="fa-solid fa-medal text-4xl text-muted/30 mb-4"></i>
        <h3 class="text-xl font-serif font-bold text-neutral-800">Tidak ada pencapaian di tempat sampah</h3>
    </div>
@endforelse
