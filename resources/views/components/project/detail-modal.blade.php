<style>
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
</style>

<div id="projectDetailModal"
     class="fixed inset-0 z-70 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4">

    <div class="relative bg-surface border border-border
                w-full max-w-3xl
                max-h-[85vh]
                overflow-y-auto hide-scrollbar
                p-6
                space-y-6">

        <button id="detailModalClose"
                class="absolute top-4 right-4 text-muted hover:text-text transition">
            ✕
        </button>

        <div class="space-y-2">
            <div class="flex items-center gap-3">
                <span id="detailType"
                      class="px-3 py-1 text-xs uppercase tracking-widest badge-primary font-semibold"></span>

                <span id="detailStatus"
                      class="px-3 py-1 text-[10px] uppercase tracking-wide border border-border text-muted"></span>
            </div>

            <h2 id="detailTitle"
                data-id=""
                data-tech=""
                class="text-2xl font-semibold leading-tight"></h2>
        </div>

        <p id="detailDesc"
           class="text-muted leading-relaxed text-sm"></p>

        <div id="detailScreenshotsWrapper" class="hidden space-y-3">
            <p class="text-muted uppercase tracking-wide text-xs">Project Screenshots</p>

            <div id="detailScreenshots"
                 class="grid grid-cols-2 md:grid-cols-4 gap-3">
            </div>
        </div>

        <div>
            <p class="text-muted uppercase tracking-wide text-xs mb-2">Tech Stack</p>
            <div id="detailTech" class="flex flex-wrap gap-2"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-sm">
            <div>
                <p class="text-muted uppercase tracking-wide text-xs">Role</p>
                <p id="detailRole" class="mt-1 font-medium"></p>
            </div>

            <div>
                <p class="text-muted uppercase tracking-wide text-xs">Team Size</p>
                <p id="detailTeamSize" class="mt-1 font-medium"></p>
            </div>

            <div>
                <p class="text-muted uppercase tracking-wide text-xs">Created</p>
                <p id="detailCreated" class="mt-1 font-medium"></p>
            </div>

            <div>
                <p class="text-muted uppercase tracking-wide text-xs">Updated</p>
                <p id="detailUpdated" class="mt-1 font-medium"></p>
            </div>
        </div>

        <div>
            <p class="text-muted uppercase tracking-wide text-xs">Responsibilities</p>
            <p id="detailResponsibilities"
               class="mt-1 text-muted leading-relaxed text-sm"></p>
        </div>

        <div class="h-px bg-border w-full opacity-40"></div>

        <div class="flex flex-wrap gap-3 pt-2">
            <a id="detailLive"
               target="_blank"
               class="px-4 py-2 border border-border text-sm hover:border-primary transition">
                Live Preview
            </a>

            <a id="detailRepo"
               target="_blank"
               class="px-4 py-2 border border-border text-sm hover:border-primary transition">
                View Repository
            </a>

            @if(request()->routeIs('dashboard.*'))
                @auth
                    <button id="detailEditBtn"
                            class="px-4 py-2 border border-border text-sm hover:border-primary transition">
                        Edit Project
                    </button>

                    <button id="detailDeleteBtn"
                            class="px-4 py-2 border border-danger text-danger text-sm hover:bg-danger/50 hover:text-text transition">
                        Delete Project
                    </button>
                @endauth
            @endif
        </div>

    </div>
</div>

{{-- Lightbox dan delete form tetap tidak diubah --}}
<div id="imageLightbox"
     class="fixed inset-0 z-90 hidden items-center justify-center bg-bg/80 backdrop-blur-sm p-6 group">

    <button id="lightboxClose"
            class="absolute top-6 right-6 text-text text-2xl z-50 hover:text-primary transition">
        ✕
    </button>

    <button id="lightboxPrev"
            class="hidden absolute left-4 md:left-8 z-50 group flex items-center justify-center w-12 h-12 border border-border/50 bg-background/50 backdrop-blur-md text-muted hover:text-primary hover:border-primary hover:bg-primary/10 transition-all duration-300 shadow-[0_0_20px_rgba(0,0,0,0.5)]">
        <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-transparent group-hover:border-primary transition-colors"></span>
        <span class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-transparent group-hover:border-primary transition-colors"></span>
        <i class="fa-solid fa-chevron-left text-lg group-hover:-translate-x-1 transition-transform duration-300"></i>
    </button>

    <button id="lightboxNext"
            class="hidden absolute right-4 md:right-8 z-50 group flex items-center justify-center w-12 h-12 border border-border/50 bg-background/50 backdrop-blur-md text-muted hover:text-primary hover:border-primary hover:bg-primary/10 transition-all duration-300 shadow-[0_0_20px_rgba(0,0,0,0.5)]">
        <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-transparent group-hover:border-primary transition-colors"></span>
        <span class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-transparent group-hover:border-primary transition-colors"></span>
        <i class="fa-solid fa-chevron-right text-lg group-hover:translate-x-1 transition-transform duration-300"></i>
    </button>

    <img id="lightboxImage"
         class="max-h-[90vh] max-w-[90vw] object-contain shadow-2xl relative z-40">
</div>

<form id="deleteProjectForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>
