<style>
@import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600&family=Merriweather:ital,wght@0,300;0,700;1,300&display=swap');

.font-diary-body { font-family: 'Merriweather', serif; }
.font-diary-accent { font-family: 'Caveat', cursive; }

.diary-card-shadow {
    box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.05);
}
</style>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-4">
    @forelse ($skills as $skill)
        @php
            $catStyle = match (strtolower($skill->category)) {
                'frontend' => [
                    'box'  => 'border-blue-300 bg-blue-50 text-blue-800',
                    'icon' => 'group-hover:text-blue-700',
                    'line' => 'bg-blue-300/60',
                ],
                'backend' => [
                    'box'  => 'border-red-300 bg-red-50 text-red-800',
                    'icon' => 'group-hover:text-red-700',
                    'line' => 'bg-red-300/60',
                ],
                'tools' => [
                    'box'  => 'border-amber-300 bg-amber-50 text-amber-800',
                    'icon' => 'group-hover:text-amber-700',
                    'line' => 'bg-amber-300/60',
                ],
                default => [
                    'box'  => 'border-stone-300 bg-stone-100 text-stone-800',
                    'icon' => 'group-hover:text-stone-700',
                    'line' => 'bg-stone-300/60',
                ],
            };
        @endphp

        <div class="group relative flex flex-col justify-between p-6 bg-[#FCFAEF] border border-stone-200 diary-card-shadow hover:-translate-y-1 hover:shadow-[4px_8px_15px_rgba(0,0,0,0.08)] transition-all duration-300 overflow-hidden min-h-[220px] rounded-sm transform {{ $loop->index % 2 == 0 ? 'rotate-[-1deg]' : 'rotate-[1deg]' }} hover:rotate-0">

            <div class="absolute -top-2 left-1/2 w-12 h-5 bg-white/40 backdrop-blur-sm -translate-x-1/2 shadow-sm transform rotate-[-3deg] border border-stone-200/50 z-20"></div>

            <div class="flex justify-between items-start mb-6 relative z-10">
                <div class="flex flex-col gap-1">
                    <span class="inline-block px-2 py-0.5 text-[10px] font-diary-accent uppercase tracking-wider border rounded-sm shadow-sm {{ $catStyle['box'] }} transform -rotate-1">
                        {{ $skill->category }}
                    </span>

                    @if($skill->is_core)
                        <span class="flex items-center gap-1.5 text-[11px] font-diary-accent text-red-600 font-bold ml-1 transform rotate-1">
                            <i class="fa-solid fa-star text-[8px]"></i>
                            Utama
                        </span>
                    @endif
                </div>

                <div class="flex gap-2 opacity-100 lg:opacity-0 lg:group-hover:opacity-100 transition-opacity bg-[#FCFAEF]/90 backdrop-blur-sm p-1.5 rounded-sm border border-stone-200 shadow-sm">
                    <button type="button" class="edit-skill-btn w-6 h-6 flex items-center justify-center text-stone-400 hover:text-stone-800 transition-colors"
                        data-id="{{ $skill->id }}"
                        data-name="{{ $skill->name }}"
                        data-category="{{ $skill->category }}"
                        data-icon="{{ $skill->icon }}"
                        data-description="{{ $skill->description }}"
                        data-is_core="{{ $skill->is_core ? 1 : 0 }}"
                        title="Revisi">
                        <i class="fa-solid fa-pen text-xs"></i>
                    </button>
                    <button type="button" class="delete-skill-btn w-6 h-6 flex items-center justify-center text-stone-400 hover:text-red-500 transition-colors" data-id="{{ $skill->id }}" title="Hapus">
                        <i class="fa-solid fa-eraser text-xs"></i>
                    </button>
                </div>
            </div>

            <div class="mb-6 relative z-10 flex-grow">
                <p class="text-[13px] font-diary-body text-stone-600 leading-relaxed line-clamp-3 group-hover:text-stone-900 transition-colors font-light text-justify">
                    {{ $skill->description ?? 'Catatan kosong. Belum ada deskripsi yang ditulis...' }}
                </p>
            </div>

            <div class="flex items-center gap-4 relative z-10 mt-auto pt-4 border-t border-dashed border-stone-300">

                <div class="shrink-0 w-12 h-12 flex items-center justify-center border-2 border-stone-300 bg-white text-2xl text-stone-400 opacity-80 group-hover:opacity-100 {{ $catStyle['icon'] }} transition-all duration-300 rounded-sm transform -rotate-3 group-hover:rotate-0 group-hover:border-current group-hover:shadow-sm">
                    {!! $skill->icon !!}
                </div>

                <div class="flex-1 flex flex-col min-w-0">
                    <h3 class="text-base font-bold font-diary-body text-stone-800 group-hover:text-black transition-colors truncate">
                        {{ $skill->name }}
                    </h3>

                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-xs font-diary-accent text-stone-500 tracking-wide">
                            Digunakan di <span class="text-stone-800 font-bold border-b border-stone-400 group-hover:border-black">{{ $skill->projects_count }}</span> proyek
                        </span>
                        <div class="h-px flex-1 {{ $catStyle['line'] }} mt-1"></div>
                    </div>
                </div>
            </div>

            @if($skill->is_core)
                <div class="absolute -right-4 -bottom-4 text-7xl font-diary-accent text-stone-200/50 pointer-events-none select-none transform rotate-[-15deg]">
                    ★
                </div>
            @endif
        </div>

    @empty
        <div class="col-span-full bg-[#FCFAEF] border border-stone-300 py-20 px-6 flex flex-col items-center justify-center text-center relative overflow-hidden group shadow-sm min-h-[300px] rounded-sm">

            <div class="absolute inset-0 bg-[linear-gradient(transparent_95%,#cbd5e1_95%)] bg-[length:100%_28px] pointer-events-none opacity-40"></div>

            <i class="fa-solid fa-book-open text-5xl text-stone-300 mb-6 group-hover:text-stone-400 transition-colors duration-500 relative z-10 transform -rotate-3"></i>

            <p class="text-xl font-diary-accent text-stone-500 mb-8 relative z-10">
                Halaman ini masih kosong. Belum ada catatan keahlian.
            </p>

            <button onclick="window.openCreateSkillModal()" class="relative z-10 px-6 py-2 border-2 border-stone-800 bg-transparent text-stone-800 font-diary-body font-bold text-sm hover:bg-stone-800 hover:text-[#FCFAEF] transition-colors shadow-sm transform rotate-1 hover:rotate-0 rounded-sm">
                + Tulis Keahlian Baru
            </button>
        </div>
    @endforelse
</div>

@if ($skills instanceof \Illuminate\Pagination\LengthAwarePaginator && $skills->hasPages())
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
