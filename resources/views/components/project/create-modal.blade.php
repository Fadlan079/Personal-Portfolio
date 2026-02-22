<div id="createProjectModal"
     class="fixed inset-0 z-70 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4">

    <div class="relative bg-surface border border-border
                w-full max-w-3xl
                max-h-[85vh]
                overflow-y-auto hide-scrollbar
                p-6
                space-y-6">

        <button id="closeCreateModal"
                class="absolute top-4 right-4 text-muted hover:text-text transition">
            ✕
        </button>

        <div class="flex items-center gap-3">
            <span class="px-3 py-1 text-xs uppercase tracking-widest badge-primary font-semibold">
                System
            </span>

            <span class="px-3 py-1 text-[10px] uppercase tracking-wide border border-border text-muted">
                create
            </span>
        </div>

        <form action="{{ route('dashboard.projects.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">

            @csrf

            <div class="space-y-4">

                <div>
                    <p class="text-muted uppercase tracking-wide text-xs mb-2">Title</p>
                    <input type="text" name="title"
                           class="w-full px-4 py-2 bg-surface border border-border text-sm focus:outline-none focus:border-primary"
                           required>
                </div>

                <div>
                    <p class="text-muted uppercase tracking-wide text-xs mb-2">Description</p>
                    <textarea name="desc"
                              rows="3"
                              class="w-full px-4 py-2 bg-surface border border-border text-sm focus:outline-none focus:border-primary"
                              required></textarea>
                </div>

                <div class="grid grid-cols-2 gap-6">

                    <div>
                        <p class="text-muted uppercase tracking-wide text-xs mb-2">Type</p>
                        <select name="type"
                                class="w-full px-4 py-2 bg-surface border border-border text-sm focus:outline-none focus:border-primary">
                            <option>Website</option>
                            <option>Web App</option>
                            <option>Application</option>
                            <option>Design</option>
                        </select>
                    </div>

                    <div>
                        <p class="text-muted uppercase tracking-wide text-xs mb-2">Status</p>
                        <select name="status"
                                class="w-full px-4 py-2 bg-surface border border-border text-sm focus:outline-none focus:border-primary">
                            <option>Prototype</option>
                            <option>In Progress</option>
                            <option>Shipped</option>
                            <option>Archived</option>
                        </select>
                    </div>

                </div>

            </div>

            <div class="h-px bg-border opacity-40"></div>

            <div class="grid grid-cols-2 gap-6 text-sm">

                <div>
                    <p class="text-muted uppercase tracking-wide text-xs mb-2">Role</p>
                    <input type="text" name="role"
                           class="w-full px-4 py-2 bg-surface border border-border focus:outline-none focus:border-primary">
                </div>

                <div>
                    <p class="text-muted uppercase tracking-wide text-xs mb-2">Team Size</p>
                    <input type="number" name="team_size"
                           class="w-full px-4 py-2 bg-surface border border-border focus:outline-none focus:border-primary">
                </div>

            </div>

            <div>
                <p class="text-muted uppercase tracking-wide text-xs mb-2">Responsibilities</p>
                <textarea name="responsibilities"
                          rows="3"
                          class="w-full px-4 py-2 bg-surface border border-border text-sm focus:outline-none focus:border-primary"></textarea>
            </div>

            <div class="h-px bg-border opacity-40"></div>

            <div class="grid grid-cols-2 gap-6">

                <div>
                    <p class="text-muted uppercase tracking-wide text-xs mb-2">Repository URL</p>
                    <input type="url" name="repo"
                           class="w-full px-4 py-2 bg-surface border border-border text-sm focus:outline-none focus:border-primary">
                </div>

                <div>
                    <p class="text-muted uppercase tracking-wide text-xs mb-2">Live URL</p>
                    <input type="url" name="live_url"
                           class="w-full px-4 py-2 bg-surface border border-border text-sm focus:outline-none focus:border-primary">
                </div>

            </div>

            <div x-data="tagInput({{ Js::from($technologies) }})" class="w-full relative">

                <div class="flex flex-wrap gap-2 mb-3">
                    <template x-for="(tag, index) in tags" :key="index">
                        <div class="bg-primary/15 text-primary border border-primary/30
                                    px-3 py-1  flex items-center gap-2
                                    text-xs tracking-wide">

                            <span x-text="'#' + tag"></span>

                            <button type="button"
                                    @click="removeTag(index)"
                                    class="text-primary/60 hover:text-primary transition">
                                ✕
                            </button>
                        </div>
                    </template>
                </div>

                <input type="text"
                    x-model="input"
                    @input="search"
                    @keydown.enter.prevent="addTag(input)"
                    placeholder="#Technology..."
                    class="w-full px-4 py-2
                        bg-surface border border-border
                        text-sm
                        focus:outline-none focus:border-primary
                        transition">

                <div x-show="filtered.length"
                    x-transition
                    class="absolute left-0 right-0 mt-2
                        bg-surface border border-border shadow-xl
                        max-h-48 overflow-y-auto
                        z-50">

                    <template x-for="item in filtered" :key="item">
                        <div
                            @click="addTag(item)"
                            class="px-4 py-2 text-sm
                                cursor-pointer
                                text-muted
                                hover:bg-primary/10
                                hover:text-primary
                                transition">
                            <span x-text="'#' + item"></span>
                        </div>
                    </template>
                </div>

                <input type="hidden" name="tech" :value="JSON.stringify(tags)">
            </div>

<div x-data="imageUpload()" class="space-y-3">

    <p class="text-muted uppercase tracking-wide text-xs">
        Screenshots (Max 8)
    </p>

    <!-- Upload Area -->
    <label
        class="flex flex-col items-center justify-center
               w-full h-40
               border border-dashed border-border
               bg-surface
               cursor-pointer
               hover:border-primary
               transition">

        <div class="text-center space-y-2">
            <div class="text-primary text-lg">＋</div>
            <p class="text-sm text-muted">
                Click to upload (max 8 images)
            </p>
        </div>

        <input type="file"
               multiple
               accept="image/*"
               name="screenshot[]"
               class="hidden"
               @change="handleFiles($event)">
    </label>

    <!-- Preview -->
    <div class="grid grid-cols-4 gap-3" x-show="images.length">
        <template x-for="(img, index) in images" :key="index">
            <div class="relative border border-border bg-surface group">

                <img :src="img.url"
                     class="w-full h-24 object-cover">

                <button type="button"
                        @click="removeImage(index)"
                        class="absolute top-1 right-1
                               bg-black/60 text-white
                               text-xs px-2 py-0.5
                               opacity-0 group-hover:opacity-100
                               transition">
                    ✕
                </button>
            </div>
        </template>
    </div>

    <!-- Limit Warning -->
    <p x-show="images.length >= 8"
       class="text-xs text-red-400">
       Maximum 8 images allowed.
    </p>

</div>

            <div class="flex justify-end gap-3 pt-4">

                <button type="button"
                        id="cancelCreateModal"
                        class="px-4 py-2 border border-border text-sm hover:border-primary transition">
                    Cancel
                </button>

                <button type="submit"
                        class="px-4 py-2 border border-primary text-primary text-sm hover:bg-primary hover:text-white transition">
                    Save Project
                </button>

            </div>

        </form>

    </div>
</div>
