@forelse ($groupedContacts as $month => $contacts)
    <div class="space-y-6">
        <div class="flex items-center justify-between border-b-2 border-dashed border-border/60 pb-3 relative">
            <div class="absolute -left-2 top-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-background border-2 border-border/60"></div>
            <h2 class="text-2xl font-serif font-bold text-text pl-6 flex items-center gap-3">
                {{ $month }}
                <span class="text-xs font-sans px-2 py-0.5 bg-border/20 text-muted rounded-full">{{ count($contacts) }} Item</span>
            </h2>
            <button type="button"
                class="month-select px-3 py-1.5 bg-surface border-2 border-border text-[10px] font-bold uppercase tracking-widest text-muted hover:border-primary hover:text-primary transition-colors rounded-sm shadow-sm hidden"
                data-month="con-{{ Str::slug($month) }}">
                Pilih Semua
            </button>
        </div>

        <div class="grid grid-cols-1 gap-4">
            @foreach ($contacts as $index => $msg)
                <div class="contact-trash-card border-2 border-border bg-[#FCFAEF] p-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 transition-all hover:-translate-y-1 shadow-[4px_4px_0px_var(--color-border)] rounded-sm"
                    data-month="con-{{ Str::slug($month) }}">
                    
                    <div class="flex items-start md:items-center gap-5 w-full md:w-auto">
                        <div class="pt-1 md:pt-0 relative">
                            <input type="checkbox"
                                name="contacts[]"
                                value="{{ $msg->id }}"
                                class="bulk-contact-checkbox w-5 h-5 border-2 border-border rounded appearance-none checked:bg-primary checked:border-primary transition-colors cursor-pointer shadow-sm opacity-0 pointer-events-none">
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold font-serif text-neutral-800 mb-1 line-clamp-1 truncate" title="{{ $msg->subject }}">
                                {{ $msg->subject }}
                            </h3>
                            <p class="text-[10px] font-mono text-muted mb-2">
                                <i class="fa-regular fa-envelope mr-1"></i> Dari: {{ $msg->sender }}
                            </p>
                            <p class="text-[9px] font-mono text-muted/60 uppercase tracking-widest">
                                <i class="fa-regular fa-clock mr-1"></i> Dihapus: {{ $msg->deleted_at->format('d M Y - H:i') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 w-full md:w-auto pt-4 md:pt-0 border-t border-dashed border-border/50 md:border-0 mt-2 md:mt-0 normal-contact-actions">
                        <button type="button"
                            data-restore-url="{{ route('dashboard.contacts.restore', $msg->id) }}"
                            class="restore-trash-btn flex-1 md:flex-none w-full md:w-auto px-4 py-2 bg-emerald-50 border-2 border-emerald-200 text-emerald-700 text-[10px] font-bold uppercase tracking-widest hover:bg-emerald-100 hover:border-emerald-400 transition-all rounded-sm shadow-sm flex justify-center items-center gap-2">
                            <i class="fa-solid fa-trash-arrow-up"></i> Restore
                        </button>
                        <button type="button"
                            data-delete-url="{{ route('dashboard.contacts.forceDelete', $msg->id) }}"
                            class="delete-trash-btn flex-1 md:flex-none px-4 py-2 bg-rose-50 border-2 border-rose-200 text-rose-600 text-[10px] font-bold uppercase tracking-widest hover:bg-rose-500 hover:text-white hover:border-rose-600 transition-all rounded-sm shadow-sm flex justify-center items-center gap-2">
                            <i class="fa-solid fa-ban"></i> Hapus
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        @if (!$multipleSelect && $contacts instanceof \Illuminate\Pagination\LengthAwarePaginator && $contacts->hasPages())
             <div class="pagination-wrapper-contacts flex justify-center pt-8">
                {!! $contacts->links() !!}
             </div>
        @endif
    </div>
@empty
    <div class="col-span-full py-16 px-6 flex flex-col items-center justify-center text-center bg-[#fdfcf5] border-2 border-dashed border-[#e5e0d0] rounded-xl mt-8">
        <i class="fa-solid fa-ghost text-4xl text-muted/30 mb-4"></i>
        <h3 class="text-xl font-serif font-bold text-neutral-800">Tidak ada pesan di tempat sampah</h3>
    </div>
@endforelse
