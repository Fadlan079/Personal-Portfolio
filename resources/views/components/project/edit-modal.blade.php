<style>
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>

<div id="projectEditModal" class="fixed inset-0 z-70 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4">

    <div
        class="relative bg-surface border border-border
                w-full max-w-3xl
                max-h-[85vh]
                overflow-y-auto hide-scrollbar
                p-6 space-y-6  shadow-lg">

        <button id="editModalClose" class="absolute top-4 right-4 text-muted hover:text-text transition">
            ✕
        </button>

        <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="editId">

            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-6" x-data="{ visibility: document.getElementById('editVisibility')?.value || 'draft' }" x-init="$watch('visibility', value => { if(value !== 'scheduled') { document.getElementById('editPublishedAt').value = ''; } })">
                    <div>
                        <p class="text-muted uppercase tracking-wide text-xs mb-2">Type</p>
                        <select id="editType" name="type"
                            class="w-full px-4 py-2 bg-surface border border-border text-sm focus:outline-none focus:border-primary">
                            <option value="Website">Website</option>
                            <option value="Web App">Web App</option>
                            <option value="Application">Application</option>
                            <option value="Design">Design</option>
                        </select>
                    </div>

                    <div>
                        <p class="text-muted uppercase tracking-wide text-xs mb-2">Status</p>
                        <select id="editStatus" name="status"
                            class="w-full px-4 py-2 bg-surface border border-border text-sm focus:outline-none focus:border-primary">
                            <option value="Shipped">Shipped</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Prototype">Prototype</option>
                            <option value="Archived">Archived</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <p class="text-muted uppercase tracking-wide text-xs mb-2">Visibility</p>
                        <select id="editVisibility" name="visibility" x-model="visibility"
                            class="w-full px-4 py-2 bg-surface border border-border text-sm focus:outline-none focus:border-primary">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="editTitle" class="text-muted uppercase tracking-wide text-xs mb-2 block">Title</label>
                    <input type="text" name="title" id="editTitle"
                        class="w-full border border-border bg-surface px-4 py-2 text-sm focus:ring-1 focus:ring-primary focus:outline-none" required>
                </div>
            </div>

            <div>
                <label for="editDesc" class="text-muted uppercase tracking-wide text-xs mb-2 block">Description</label>
                <textarea name="desc" id="editDesc" rows="3"
                    class="w-full border border-border bg-surface px-4 py-2 text-sm focus:ring-1 focus:ring-primary focus:outline-none" required></textarea>
            </div>

            <div class="h-px bg-border opacity-40"></div>

            <div class="space-y-6">
                <div class="space-y-4">
                    <p class="text-muted uppercase tracking-wide text-xs mb-2">Device Images (Optional)</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="border border-border p-3 bg-surface">
                            <p class="text-[10px] text-muted uppercase tracking-widest mb-2 border-b border-border pb-1">
                                Desktop view</p>
                            <div id="previewDesktopWrapper" class="hidden mb-2 relative">
                                <img id="previewDesktop" src="" class="w-full h-20 object-cover border border-border">
                            </div>
                            <input type="file" name="image_desktop" accept="image/*"
                                class="w-full text-xs text-muted file:mr-2 file:py-1 file:px-2 file:border-0 file:text-[10px] file:uppercase file:bg-primary file:text-background hover:file:bg-primary/90">
                        </div>
                        <div class="border border-border p-3 bg-surface">
                            <p class="text-[10px] text-muted uppercase tracking-widest mb-2 border-b border-border pb-1">
                                Tablet view</p>
                            <div id="previewTabletWrapper" class="hidden mb-2 relative">
                                <img id="previewTablet" src="" class="w-full h-20 object-cover border border-border">
                            </div>
                            <input type="file" name="image_tablet" accept="image/*"
                                class="w-full text-xs text-muted file:mr-2 file:py-1 file:px-2 file:border-0 file:text-[10px] file:uppercase file:bg-primary file:text-background hover:file:bg-primary/90">
                        </div>
                        <div class="border border-border p-3 bg-surface">
                            <p class="text-[10px] text-muted uppercase tracking-widest mb-2 border-b border-border pb-1">
                                Mobile view</p>
                            <div id="previewMobileWrapper" class="hidden mb-2 relative">
                                <img id="previewMobile" src="" class="w-full h-20 object-cover border border-border">
                            </div>
                            <input type="file" name="image_mobile" accept="image/*"
                                class="w-full text-xs text-muted file:mr-2 file:py-1 file:px-2 file:border-0 file:text-[10px] file:uppercase file:bg-primary file:text-background hover:file:bg-primary/90">
                        </div>
                    </div>
                </div>

                <div id="imageUploadEditRegion" x-data="imageUpload({
                    existing: @json(collect($project->screenshot ?? [])->map(fn($path) => [
                            'path' => $path,
                            'url' => asset('storage/' . $path),
                        ]))
                })" class="space-y-4">

                    <p class="text-muted uppercase tracking-wide text-xs">
                        Screenshots (Max 8)
                    </p>

                    <label x-show="totalImages < max"
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
                                Click to upload
                            </p>
                        </div>

                        <input type="file" multiple accept="image/*" name="new_screenshot[]" class="hidden"
                            x-ref="fileInput" @change="handleFiles($event)">
                    </label>

                    <div class="grid grid-cols-4 gap-3" x-show="totalImages">

                        <template x-for="(img, index) in existingImages" :key="'existing-' + index">
                            <div class="relative border border-border bg-surface group rounded overflow-hidden">

                                <img :src="img.url" class="w-full h-24 object-cover">

                                <button type="button" @click="removeExisting(index)"
                                    class="absolute top-1 right-1
                                           bg-black/60 text-white
                                           text-xs px-2 py-0.5
                                           rounded
                                           opacity-0 group-hover:opacity-100
                                           transition">
                                    ✕
                                </button>

                            </div>
                        </template>

                        <template x-for="(img, index) in newImages" :key="'new-' + index">
                            <div class="relative border border-border bg-surface group rounded overflow-hidden">

                                <img :src="img.url" class="w-full h-24 object-cover">

                                <button type="button" @click="removeNew(index)"
                                    class="absolute top-1 right-1
                                           bg-black/60 text-white
                                           text-xs px-2 py-0.5
                                           rounded
                                           opacity-0 group-hover:opacity-100
                                           transition">
                                    ✕
                                </button>

                            </div>
                        </template>

                    </div>

                    <template x-for="img in deletedImages">
                        <input type="hidden" name="deleted_screenshots[]" :value="img.path">
                    </template>

                    <p x-show="totalImages >= max" class="text-xs text-red-400">
                        Maximum 8 images allowed.
                    </p>

                </div>
            </div>

            <div class="h-px bg-border opacity-40"></div>

            <div>
                <p class="text-muted uppercase tracking-wide text-xs mb-2">Tech Stack</p>
                <div id="techStackEditRegion" x-data="tagInputEdit({{ Js::from($technologies) }})" x-ref="techComponent" class="w-full relative space-y-2">
                    <div class="flex flex-wrap gap-2 mb-3">
                        <template x-for="(tag, index) in tags" :key="index">
                            <div class="bg-primary/15 text-primary border border-primary/30
                                        px-3 py-1 flex items-center gap-2
                                        text-xs tracking-wide">
                                <span x-text="'#' + tag"></span>
                                <button type="button" @click="removeTag(index)"
                                    class="text-primary/60 hover:text-primary transition">
                                    ✕
                                </button>
                            </div>
                        </template>
                    </div>

                    <input type="text" x-model="input" @input="search" @keydown.enter.prevent="addTag(input)"
                        placeholder="#Technology..."
                        class="w-full px-4 py-2 bg-surface border border-border text-sm focus:outline-none focus:border-primary transition">

                    <div x-show="filtered.length" x-transition
                        class="absolute left-0 right-0 mt-2
                               bg-surface border border-border shadow-xl
                               max-h-48 overflow-y-auto
                               z-50">

                        <template x-for="item in filtered" :key="item">
                            <div @click="addTag(item)"
                                class="px-4 py-2 text-sm cursor-pointer text-muted hover:bg-primary/10 hover:text-primary transition">
                                <span x-text="'#' + item"></span>
                            </div>
                        </template>
                    </div>

                    <input type="hidden" name="tech" :value="JSON.stringify(tags)">
                </div>
            </div>

            <div class="h-px bg-border opacity-40"></div>

            <div class="grid grid-cols-2 gap-6 text-sm">
                <div>
                    <label for="editRole" class="text-muted uppercase tracking-wide text-xs mb-2 block">Role</label>
                    <input type="text" name="role" id="editRole"
                        class="w-full border border-border bg-surface px-4 py-2 focus:ring-1 focus:ring-primary focus:outline-none">
                </div>

                <div>
                    <label for="editTeamSize" class="text-muted uppercase tracking-wide text-xs mb-2 block">Team Size</label>
                    <input type="number" name="team_size" id="editTeamSize"
                        class="w-full border border-border bg-surface px-4 py-2 focus:ring-1 focus:ring-primary focus:outline-none">
                </div>
            </div>

            <div>
                <label for="editResponsibilities" class="text-muted uppercase tracking-wide text-xs mb-2 block">Responsibilities</label>
                <textarea name="responsibilities" id="editResponsibilities" rows="3"
                    class="w-full border border-border bg-surface px-4 py-2 text-sm focus:ring-1 focus:ring-primary focus:outline-none"></textarea>
            </div>

            <div class="h-px bg-border w-full opacity-40"></div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-muted uppercase tracking-wide text-xs mb-2">Repository URL</p>
                    <input type="url" name="repo" id="editRepo"
                        class="w-full border border-border bg-surface px-4 py-2 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                </div>
                <div>
                    <p class="text-muted uppercase tracking-wide text-xs mb-2">Live URL</p>
                    <input type="url" name="live_url" id="editLive"
                        class="w-full border border-border bg-surface px-4 py-2 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-border/50">
                <button type="button" id="cancelEdit"
                    class="px-4 py-2 border border-border text-sm hover:border-primary transition">
                    Cancel
                </button>

                <button type="submit"
                    class="px-4 py-2 border border-primary text-background bg-primary text-sm hover:bg-primary/90 transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
