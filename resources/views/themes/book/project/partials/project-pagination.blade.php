@if (isset($projects) && $projects->hasPages())
    <div class="flex justify-center pt-12 md:pt-16 pb-8">
        <nav class="flex flex-wrap sm:flex-nowrap items-center justify-center gap-3 sm:gap-4 font-mono w-full sm:w-auto px-4">
            @if ($projects->onFirstPage())
                <span class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted opacity-30 cursor-not-allowed italic font-serif bg-container"><i class="fa-solid fa-chevron-left text-[10px] sm:text-xs"></i></span>
            @else
                <a href="{{ $projects->previousPageUrl() }}" class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted hover:border-primary hover:text-primary hover:-translate-y-0.5 transition-all shadow-sm bg-container"><i class="fa-solid fa-chevron-left text-[10px] sm:text-xs pointer-events-none"></i></a>
            @endif

            <div class="px-4 py-1.5 sm:px-6 sm:py-2 bg-warning border-2 border-yellow-500 rounded-full shadow-[2px_2px_0px_var(--color-border)] rotate-1 shrink-0">
                <span class="text-[10px] sm:text-xs font-black text-yellow-900 uppercase tracking-widest whitespace-nowrap">
                    {{ sprintf('%02d', $projects->currentPage()) }} <span class="opacity-50 mx-1">/</span> {{ sprintf('%02d', $projects->lastPage()) }}
                </span>
            </div>

            @if ($projects->hasMorePages())
                <a href="{{ $projects->nextPageUrl() }}" class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted hover:border-primary hover:text-primary hover:-translate-y-0.5 transition-all shadow-sm bg-container"><i class="fa-solid fa-chevron-right text-[10px] sm:text-xs pointer-events-none"></i></a>
            @else
                <span class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted opacity-30 cursor-not-allowed italic font-serif bg-container"><i class="fa-solid fa-chevron-right text-[10px] sm:text-xs"></i></span>
            @endif
        </nav>
    </div>
@endif
