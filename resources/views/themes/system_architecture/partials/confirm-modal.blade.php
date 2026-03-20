<div id="confirm-modal" class="fixed inset-0 z-99999 flex items-center justify-center font-sans px-4 pointer-events-none opacity-0">

    <div id="confirm-backdrop" class="absolute inset-0 bg-[#0a0a0a]/80 backdrop-blur-sm cursor-pointer"></div>

    <div id="confirm-box" 
         class="relative w-full max-w-[400px] bg-background border border-border shadow-[0_0_50px_rgba(239,68,68,0.15)] overflow-hidden"
         style="border-top-color: #ef4444; border-top-width: 2px;">

        <div class="flex justify-between items-center px-4 py-2 border-b border-border/50 bg-red-500/5">
            <div class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-widest text-red-500">
                <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse shadow-[0_0_8px_#ef4444]"></span>
                SYS.DIALOG // CONFIRM_ACTION
            </div>
        </div>

        <div class="p-6 md:p-8 flex items-start gap-5">
            
            <div id="confirm-icon-box" class="shrink-0 w-12 h-12 flex items-center justify-center border bg-surface/30 mt-1 relative border-red-500/40 text-red-500">
                 <div class="absolute top-0 left-0 w-1.5 h-1.5 border-t border-l border-red-500"></div>
                 <div class="absolute bottom-0 right-0 w-1.5 h-1.5 border-b border-r border-red-500"></div>
                 <i class="fa-solid fa-triangle-exclamation text-xl"></i>
            </div>

            <div class="flex-1">
                <h2 class="text-lg md:text-xl font-bold uppercase tracking-wide mb-1 font-mono text-red-500">
                    AWAITING_CONFIRM
                </h2>
                <p id="confirm-message" class="text-sm text-text leading-relaxed font-sans opacity-90">
                    Are you sure you want to proceed?
                </p>
            </div>
            
        </div>

        <div class="flex border-t border-border/50 bg-surface/30">
            <button id="confirm-cancel" class="flex-1 py-4 px-4 font-mono text-xs font-bold uppercase tracking-widest text-muted hover:text-text hover:bg-surface transition-colors border-r border-border/50">
                [ Abort ]
            </button>
            
            <button id="confirm-yes" class="flex-1 py-4 px-4 font-mono text-xs font-bold uppercase tracking-widest text-red-500 hover:bg-red-500 hover:text-white transition-colors group flex items-center justify-center gap-2">
                <span>[ Execute ]</span>
                <i class="fa-solid fa-bolt text-[10px] opacity-50 group-hover:opacity-100 group-hover:animate-pulse"></i>
            </button>
        </div>

    </div>
</div>
