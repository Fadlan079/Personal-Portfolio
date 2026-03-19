<div id="confirm-modal" class="fixed inset-0 z-[99999] flex items-center justify-center px-4 overflow-hidden select-none pointer-events-none opacity-0" style="font-family: 'Kalam', 'Segoe UI', cursive;">
    {{-- Backdrop --}}
    <div id="confirm-backdrop" class="absolute inset-0 bg-[#E5E4DF]/70 backdrop-blur-sm cursor-pointer"></div>

    {{-- Sticky Note Container --}}
    <div id="confirm-box"
         class="relative w-full max-w-[360px] p-6 md:p-8 shadow-xl rounded-sm rotate-1"
         style="background-color: #fee2e2; color: #991b1b; transition: all 0.3s ease-out; background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAYAAACp8Z5+AAAAIklEQVQIW2NkQAKrVq36z8gAFkNnw4XAKpBF4IpgFTg5AK4WDREEYL5mAAAAAElFTkSuQmCC');">

        {{-- Tape effect --}}
        <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-24 h-7 bg-[#fecaca] opacity-80 shadow-inner -rotate-1 z-10"
             style="clip-path: polygon(0% 0%, 100% 0%, 98% 100%, 2% 100%);">
        </div>

        <div class="flex flex-col items-center text-center gap-4 relative z-20">
            <div id="confirm-icon-box" class="shrink-0 text-3xl opacity-80 mt-2">
                 <i class="fa-solid fa-circle-question"></i>
            </div>

            <div class="flex-1 w-full">
                <h2 class="text-xl md:text-2xl font-bold tracking-wide mb-2">
                    Yakin nih?
                </h2>

                <p id="confirm-message" class="text-sm leading-relaxed font-sans opacity-95">
                    Pikirkan baik-baik sebelum lanjut ya...
                </p>

                <div class="mt-6 flex gap-3">
                    <button id="confirm-cancel" class="flex-1 py-2 px-4 rounded-md border border-black/10 hover:bg-black/5 transition-colors font-sans text-sm font-bold">
                        Nggak jadi
                    </button>
                    <button id="confirm-yes" class="flex-1 py-2 px-4 rounded-md bg-[#991b1b] text-white hover:bg-[#7f1d1d] transition-colors font-sans text-sm font-bold shadow-md">
                        Yap, lanjut!
                    </button>
                </div>
            </div>
        </div>

        {{-- Folding paper effect --}}
        <div class="absolute bottom-0 right-0 w-4 h-4 bg-black/5 rounded-tl-full pointer-events-none"></div>
    </div>
</div>
