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

<div id="projectDetailModal" class="fixed inset-0 z-70 hidden items-center justify-center bg-stone-900/60 backdrop-blur-sm p-4 md:p-6">

    <div class="relative w-full max-w-3xl max-h-[85vh] overflow-y-auto hide-scrollbar bg-[#FCFAEF] text-stone-800 shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-stone-200/60 rounded-sm">

        <div class="absolute top-0 left-6 w-8 h-12 bg-red-800/80 rounded-b-sm shadow-sm z-0"></div>

        <button id="detailModalClose" class="absolute top-6 right-6 text-stone-400 hover:text-stone-800 transition-colors z-10 text-xl font-light">
            ✕
        </button>

        <div class="px-8 pt-12 pb-6 md:px-12 relative z-10">
            <div class="flex flex-wrap items-center gap-3 mb-4 font-diary-accent text-xl text-stone-500">
                <div class="flex flex-wrap items-center gap-3 mb-4 font-diary-accent text-xl">

                    <div class="flex items-center gap-1.5 text-stone-500">
                        <span class="text-stone-400">Dibuat:</span>
                        <span id="detailCreated" class="text-stone-800 tracking-wide"></span>
                    </div>

                    <span class="text-stone-300 font-serif">~</span>

                    <div class="flex items-center gap-1.5 text-stone-500">
                        <span class="text-stone-400">Diperbarui:</span>
                        <span id="detailUpdated" class="text-stone-800 tracking-wide"></span>
                    </div>

                    <span class="text-stone-300 font-serif">~</span>

                    <span id="detailType" class="px-2 py-0.5 border border-stone-300 rounded-sm transform -rotate-1 text-stone-600 bg-white/50"></span>
                    <span id="detailStatus" class="px-2 py-0.5 border border-stone-300 rounded-sm transform rotate-1 text-stone-600 bg-white/50"></span>

                </div>
            </div>

            <h2 id="detailTitle" data-id="" data-tech="" class="text-3xl md:text-4xl font-diary-body font-bold text-stone-900 leading-tight"></h2>
        </div>

        <div class="w-full h-px bg-stone-300/60 border-t border-dashed border-stone-400 mx-8 md:mx-12" style="width: calc(100% - 6rem);"></div>

        <div class="px-8 py-8 md:px-12 space-y-10">

            <p id="detailDesc" class="font-diary-body text-stone-700 leading-relaxed text-base font-light text-justify"></p>

            <div id="detailScreenshotsWrapper" class="hidden space-y-4">
                <p class="font-diary-accent text-2xl text-stone-500">Galeri Proyek:</p>
                <div id="detailScreenshots" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                </div>
            </div>

            <div id="detailAchievementsWrapper" class="hidden space-y-4">
                <p class="font-diary-accent text-2xl text-stone-500 flex items-center gap-2"><i class="fa-solid fa-medal text-yellow-600/80"></i>Penghargaan:</p>
                <div id="detailAchievements" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="col-span-1 space-y-6">
                    <div>
                        <p class="font-diary-accent text-xl text-stone-500 mb-1">Role & Team</p>
                        <p id="detailRole" class="font-diary-body font-bold text-sm text-stone-800"></p>
                        <p id="detailTeamSize" class="font-diary-body text-xs text-stone-600 mt-1"></p>
                    </div>

                    <div>
                        <p class="font-diary-accent text-xl text-stone-500 mb-2">Tech Stack</p>
                        <div id="detailTech" class="flex flex-wrap gap-1.5">
                           </div>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <p class="font-diary-accent text-xl text-stone-500 mb-2">Tanggung Jawab</p>
                    <p id="detailResponsibilities" class="font-diary-body text-stone-700 leading-relaxed text-sm font-light pl-4 border-l-2 border-stone-300"></p>
                </div>

            </div>
        </div>

        <div class="bg-stone-100/50 px-8 py-6 md:px-12 border-t border-stone-200/60 flex flex-wrap gap-4 items-center justify-between">
            <div class="flex flex-wrap gap-3">
                <a id="detailLive" target="_blank" class="px-5 py-2 bg-transparent border border-stone-800 text-stone-800 font-diary-body text-sm font-bold hover:bg-stone-800 hover:text-[#FCFAEF] transition-colors rounded-sm hidden">
                    View Live
                </a>
                <a id="detailRepo" target="_blank" class="px-5 py-2 bg-transparent border border-stone-400 text-stone-600 font-diary-body text-sm hover:border-stone-800 hover:text-stone-800 transition-colors rounded-sm hidden">
                    Repository
                </a>
            </div>

            @if(request()->routeIs('dashboard.*'))
                @auth
                    <div class="flex gap-3 items-center">
                        <button id="detailEditBtn" class="text-stone-500 hover:text-stone-900 font-diary-body text-sm transition-colors border-b border-transparent hover:border-stone-900">
                            Sunting Proyek
                        </button>
                        <span class="text-stone-300">|</span>
                        <button id="detailDeleteBtn" class="text-red-400 hover:text-red-700 font-diary-body text-sm transition-colors border-b border-transparent hover:border-red-700">
                            Hapus Proyek
                        </button>
                    </div>
                @endauth
            @endif
        </div>

    </div>
</div>

<div id="imageLightbox"
     class="fixed inset-0 z-90 hidden items-center justify-center bg-stone-900/80 backdrop-blur-sm p-4 md:p-12 group">

    <button id="lightboxClose"
            class="absolute top-6 right-6 md:top-8 md:right-8 text-stone-400 hover:text-[#FCFAEF] transition-colors z-50 text-3xl font-light">
        ✕
    </button>

    <button id="lightboxPrev"
            class="hidden absolute left-4 md:left-8 z-50 items-center justify-center w-12 h-12 md:w-14 md:h-14 rounded-full bg-[#FCFAEF] text-stone-800 hover:bg-stone-200 transition-all hover:-translate-x-1 shadow-[0_4px_15px_rgba(0,0,0,0.3)] border border-stone-300">
        <i class="fa-solid fa-chevron-left text-lg md:text-xl relative -left-0.5"></i>
    </button>

    <button id="lightboxNext"
            class="hidden absolute right-4 md:right-8 z-50 items-center justify-center w-12 h-12 md:w-14 md:h-14 rounded-full bg-[#FCFAEF] text-stone-800 hover:bg-stone-200 transition-all hover:translate-x-1 shadow-[0_4px_15px_rgba(0,0,0,0.3)] border border-stone-300">
        <i class="fa-solid fa-chevron-right text-lg md:text-xl relative -right-0.5"></i>
    </button>

    <div class="relative z-40 bg-[#FCFAEF] p-2 md:p-4 shadow-[0_12px_40px_rgba(0,0,0,0.5)] border border-stone-300">

        <div class="absolute -top-3 left-1/2 w-16 h-6 bg-white/30 backdrop-blur-sm -translate-x-1/2 shadow-sm transform -rotate-2 border border-stone-200/50"></div>

        <img id="lightboxImage"
             class="max-h-[80vh] max-w-[85vw] object-contain filter contrast-[0.95] sepia-[0.05] border border-stone-200/50">
    </div>
</div>

<form id="deleteProjectForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>
