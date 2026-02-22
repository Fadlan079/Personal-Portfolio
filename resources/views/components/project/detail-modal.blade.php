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

        <div class="space-y-4">

            <div class="flex items-center gap-3">
                <span id="detailType"
                      class="px-3 py-1 text-xs uppercase tracking-widest badge-primary font-semibold"></span>

                <span id="detailStatus"
                      class="px-3 py-1 text-[10px] uppercase tracking-wide border border-border text-muted"></span>
            </div>

            <h2 id="detailTitle"
                class="text-2xl font-semibold leading-tight"></h2>

            <p id="detailDesc"
               class="text-muted leading-relaxed text-sm"></p>

            <div>
                <p class="text-muted uppercase tracking-wide text-xs mb-2">Tech Stack</p>
                <div id="detailTech" class="flex flex-wrap gap-2"></div>
            </div>

        </div>

        <div class="grid grid-cols-2 gap-6 text-sm">
            <div>
                <p class="text-muted uppercase tracking-wide text-xs">Role</p>
                <p id="detailRole" class="mt-1 font-medium"></p>
            </div>

            <div>
                <p class="text-muted uppercase tracking-wide text-xs">Team Size</p>
                <p id="detailTeamSize" class="mt-1 font-medium"></p>
            </div>
        </div>

        <div>
            <p class="text-muted uppercase tracking-wide text-xs">Responsibilities</p>
            <p id="detailResponsibilities"
               class="mt-1 text-muted leading-relaxed text-sm"></p>
        </div>

        <div class="h-px bg-border w-full opacity-40"></div>

        <div class="grid grid-cols-2 gap-6 text-sm">
            <div>
                <p class="text-muted uppercase tracking-wide text-xs">Created</p>
                <p id="detailCreated" class="mt-1 font-medium"></p>
            </div>

            <div>
                <p class="text-muted uppercase tracking-wide text-xs">Last Update</p>
                <p id="detailUpdated" class="mt-1 font-medium"></p>
            </div>
        </div>

        <div id="detailScreenshotsWrapper" class="hidden space-y-3">
            <p class="text-muted uppercase tracking-wide text-xs">Project Files</p>

            <div id="detailScreenshots"
                 class="grid grid-cols-2 md:grid-cols-4 gap-3">
            </div>
        </div>

        <div class="flex flex-wrap gap-3 pt-4">

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

<div id="imageLightbox"
     class="fixed inset-0 z-90 hidden items-center justify-center bg-bg/80 backdrop-blur-sm p-6">

    <button id="lightboxClose"
            class="absolute top-6 right-6 text-text text-2xl">
        ✕
    </button>

    <img id="lightboxImage"
         class="max-h-[90vh] max-w-[90vw] object-contain shadow-2xl">
</div>

<form id="deleteProjectForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>
