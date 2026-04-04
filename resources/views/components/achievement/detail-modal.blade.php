<style>
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}

@import url('https://fonts.googleapis.com/css2?family=Caveat:wght@500&family=Merriweather:ital,wght@0,300;0,700;1,300&display=swap');

.font-diary-body { font-family: 'Merriweather', serif; }
.font-diary-accent { font-family: 'Caveat', cursive; }
</style>

<div id="achievementDetailModal" class="fixed inset-0 z-70 hidden items-center justify-center bg-stone-900/60 backdrop-blur-sm p-4 md:p-6 transition-opacity duration-300">
    <div class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto hide-scrollbar bg-[#FCFAEF] text-stone-800 shadow-[0_12px_40px_rgba(0,0,0,0.2)] border border-stone-200/60 rounded-sm transform scale-95 opacity-0 transition-all duration-300" id="detailBox">

        <div class="absolute top-0 left-8 w-10 h-14 bg-red-800/80 rounded-b-sm shadow-sm z-0"></div>

        <button id="detailClose" class="absolute top-6 right-6 text-stone-400 hover:text-stone-800 transition-colors z-20 text-xl font-light">
            ✕
        </button>

        <div class="px-8 pt-16 pb-6 md:px-12 relative z-10">
            <div class="flex items-center gap-3 mb-3 text-stone-500 font-diary-accent text-xl">
                 <span id="detailIssuer" class="text-stone-800"></span>
                 <span class="text-stone-300 font-serif">~</span>
                 <span id="detailDate" class="text-stone-500 italic"></span>
            </div>
            <h2 id="detailTitle" class="text-3xl md:text-4xl font-diary-body font-bold text-stone-900 leading-tight"></h2>
        </div>

        <div class="px-8 md:px-12 pb-10 space-y-8 relative z-10">
            <div id="detailImageContainer" class="w-full bg-stone-100 border border-stone-200 shadow-inner rounded overflow-hidden p-2 group">
                <img id="detailImage" src="" alt="Achievement Full Image"
                    class="w-full h-auto object-contain max-h-[50vh] filter contrast-[0.95] sepia-[0.05] rounded-sm transition-transform duration-500 group-hover:scale-[1.02]">
            </div>

            <div class="pt-6 border-t border-dashed border-stone-300 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span id="detailProjectsCount" class="text-[10px] font-black uppercase tracking-widest text-stone-500 bg-stone-200/50 px-3 py-1.5 rounded">0 Proyek</span>
                </div>
                <div class="flex gap-4 items-center">
                    <button id="modalEditBtn" class="flex items-center gap-2 text-stone-500 hover:text-stone-900 font-diary-body text-sm transition-colors group">
                        <i class="fa-regular fa-pen-to-square group-hover:rotate-6 transition-transform"></i>
                        Sunting
                    </button>
                    <span class="text-stone-300 cursor-default">|</span>
                    <button id="modalDeleteBtn" class="flex items-center gap-2 text-red-400 hover:text-red-700 font-diary-body text-sm transition-colors group">
                        <i class="fa-regular fa-trash-can group-hover:scale-110 transition-transform"></i>
                        Hapus
                    </button>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 right-0 w-8 h-8 bg-stone-200/50" style="clip-path: polygon(100% 0, 0 100%, 100% 100%);"></div>
    </div>
</div>
