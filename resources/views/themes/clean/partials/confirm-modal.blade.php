<div id="confirm-modal" class="fixed inset-0 z-99999 flex items-center justify-center px-4 pointer-events-none opacity-0">
    {{-- Modern Minimalist Backdrop --}}
    <div id="confirm-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-md cursor-pointer"></div>

    {{-- Modern Minimalist Box --}}
    <div id="confirm-box"
         class="relative w-full max-w-sm bg-surface border border-white/10 shadow-2xl rounded-3xl p-6 md:p-8 transform scale-95 transition-all duration-300">

        <div class="flex flex-col items-center text-center">
            <div id="confirm-icon-box" class="w-16 h-16 rounded-2xl bg-red-500/10 text-red-500 flex items-center justify-center mb-6">
                <i class="fa-solid fa-triangle-exclamation text-2xl"></i>
            </div>

            <h2 class="text-xl font-bold text-white mb-2">
                Confirmation Required
            </h2>
            
            <p id="confirm-message" class="text-white/60 text-sm leading-relaxed mb-8">
                Are you sure you want to perform this action? This operation might be irreversible.
            </p>

            <div class="flex w-full gap-3">
                <button id="confirm-cancel" class="flex-1 py-3 px-6 rounded-2xl bg-white/5 hover:bg-white/10 text-white font-semibold transition-all">
                    Cancel
                </button>
                <button id="confirm-yes" class="flex-1 py-3 px-6 rounded-2xl bg-red-500 hover:bg-red-600 text-white font-semibold shadow-lg shadow-red-500/20 transition-all">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>
