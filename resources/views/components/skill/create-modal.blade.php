<div id="createSkillModal"
     class="fixed inset-0 z-70 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4">

    <div class="relative bg-surface border border-border
                w-full max-w-lg
                max-h-[85vh]
                overflow-y-auto hide-scrollbar
                p-6
                space-y-6">

        <button id="closeCreateSkillModal"
                class="absolute top-4 right-4 text-muted hover:text-text transition">
            ✕
        </button>

        <div class="flex items-center gap-3">
            <span class="px-3 py-1 text-xs uppercase tracking-widest badge-primary font-semibold">
                System
            </span>

            <span class="px-3 py-1 text-[10px] uppercase tracking-wide border border-border text-muted">
                create skill
            </span>
        </div>

        <form action="{{ route('dashboard.skills.store') }}"
              method="POST"
              class="space-y-6">
            @csrf

            <div class="space-y-4">
                <div>
                    <p class="text-muted uppercase tracking-wide text-xs mb-2">Skill Name</p>
                    <input type="text" name="name"
                           class="w-full px-4 py-2 bg-surface border border-border text-sm focus:outline-none focus:border-primary"
                           required>
                </div>

                <div>
                    <p class="text-muted uppercase tracking-wide text-xs mb-2">Category</p>
                    <select name="category"
                            class="w-full px-4 py-2 bg-surface border border-border text-sm focus:outline-none focus:border-primary"
                            required>
                        <option value="frontend">Frontend</option>
                        <option value="backend">Backend</option>
                        <option value="tools">Tools & Core</option>
                        <option value="core">Core (Alias)</option>
                    </select>
                </div>

                <div>
                    <p class="text-muted uppercase tracking-wide text-xs mb-2 flex items-center justify-between">
                        SVG Icon
                        <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" class="text-primary hover:underline text-[10px]">Find Icons On FontAwesome <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                    </p>
                    <textarea name="icon"
                              rows="4"
                              placeholder='e.g. <i class="fa-brands fa-laravel"></i> or <svg>...</svg>'
                              class="w-full font-mono text-xs px-4 py-2 bg-surface border border-border focus:outline-none focus:border-primary"></textarea>
                    <p class="text-xs text-muted mt-1">Accepts FontAwesome `<i>` tags or raw SVG code.</p>
                </div>
            </div>

            <div class="pt-4 border-t border-border flex justify-end gap-3">
                <button type="button" id="cancelCreateSkillBtn"
                        class="px-4 py-2 text-sm border border-transparent text-muted hover:text-text">
                    Cancel
                </button>
                <button type="submit" class="px-6 py-2 bg-primary text-text font-medium text-sm hover:bg-primary/90 transition shadow-sm">
                    Create Skill
                </button>
            </div>
        </form>
    </div>
</div>

<script>
window.openCreateSkillModal = function() {
    const modal = document.getElementById('createSkillModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
};

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('createSkillModal');
    const closeBtn = document.getElementById('closeCreateSkillModal');
    const cancelBtn = document.getElementById('cancelCreateSkillBtn');

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    if(closeBtn) closeBtn.addEventListener('click', closeModal);
    if(cancelBtn) cancelBtn.addEventListener('click', closeModal);
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });
});
</script>
