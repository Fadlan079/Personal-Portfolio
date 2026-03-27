<style>
/* Utilities untuk tema diary minimalis (Bisa dihapus jika sudah didefinisikan secara global) */
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

.diary-input {
    background-color: rgba(255, 255, 255, 0.4);
    border: 1px solid #d6d3d1; /* stone-300 */
    color: #292524; /* stone-800 */
    font-family: 'Merriweather', serif;
    font-size: 0.875rem; /* sm */
    border-radius: 2px;
    transition: all 0.2s ease;
}
.diary-input:focus {
    outline: none;
    border-color: #292524; /* stone-800 */
    background-color: rgba(255, 255, 255, 0.7);
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}
</style>

<div id="projectEditModal" class="fixed inset-0 z-70 hidden items-center justify-center bg-stone-900/60 backdrop-blur-sm p-4 md:p-6">

    <div class="relative w-full max-w-3xl max-h-[85vh] overflow-y-auto hide-scrollbar bg-[#FCFAEF] text-stone-800 shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-stone-200/60 rounded-sm">

        <div class="absolute top-0 left-6 w-8 h-12 bg-red-800/80 rounded-b-sm shadow-sm z-0 pointer-events-none"></div>

        <button id="editModalClose" class="absolute top-6 right-6 text-stone-400 hover:text-stone-800 transition-colors z-10 text-xl font-light">
            ✕
        </button>

        <div class="px-8 pt-12 pb-4 md:px-12 relative z-10">
            <div class="flex items-center gap-3 mb-2 font-diary-accent text-xl">
                <span class="text-stone-500 transform rotate-1">Sunting Proyek</span>
            </div>
        </div>

        <div class="w-full h-px bg-stone-300/60 border-t border-dashed border-stone-400 mx-8 md:mx-12 mb-6" style="width: calc(100% - 6rem);"></div>

        <form id="editForm" method="POST" enctype="multipart/form-data" class="px-8 pb-8 md:px-12 space-y-8">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="editId">

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-data="{ visibility: document.getElementById('editVisibility')?.value || 'draft' }" x-init="$watch('visibility', value => { if(value !== 'scheduled') { if(document.getElementById('editPublishedAt')) document.getElementById('editPublishedAt').value = ''; } })">

                    <div>
                        <p class="font-diary-accent text-xl text-stone-500 mb-1">Tipe</p>
                        <select id="editType" name="type" class="w-full px-4 py-2 diary-input">
                            <option value="Website">Website</option>
                            <option value="Web App">Web App</option>
                            <option value="Application">Application</option>
                            <option value="Design">Design</option>
                        </select>
                    </div>

                    <div>
                        <p class="font-diary-accent text-xl text-stone-500 mb-1">Status</p>
                        <select id="editStatus" name="status" class="w-full px-4 py-2 diary-input">
                            <option value="Finished">Finished</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Prototype">Prototype</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <p class="font-diary-accent text-xl text-stone-500 mb-1">Visabilitas</p>
                        <select id="editVisibility" name="visibility" x-model="visibility" class="w-full px-4 py-2 diary-input">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="editTitle" class="font-diary-accent text-xl text-stone-500 mb-1 block">Judul Proyek</label>
                    <input type="text" name="title" id="editTitle" required class="w-full px-4 py-2 diary-input font-bold">
                </div>

                <div>
                    <label for="editDesc" class="font-diary-accent text-xl text-stone-500 mb-1 block">Deskripsi Proyek</label>
                    <textarea name="desc" id="editDesc" rows="3" required class="w-full px-4 py-2 diary-input resize-y"></textarea>
                </div>
            </div>

            <div class="w-full h-px bg-stone-300 border-t border-dashed border-stone-400/50"></div>

            <div class="space-y-8">

                <div>
                    <p class="font-diary-accent text-xl text-stone-500 mb-2 flex items-center gap-2">Device Showcases
                        <span class="text-sm">(Opsional)</span>

                        <span class="relative group cursor-pointer">
                            <span class="text-xs border border-stone-400 text-stone-500 w-4 h-4 flex items-center justify-center rounded-full">
                                ?
                            </span>

                            <span class="absolute left-1/2 -translate-x-1/2 top-6 w-56
                                        bg-[#fffaf3] border border-stone-300 text-stone-600
                                        text-xs p-3 rounded shadow-md
                                        opacity-0 group-hover:opacity-100
                                        transition pointer-events-none z-20">
                                Gambar yang diunggah akan ditampilkan dalam mockup perangkat (desktop, tablet, mobile) pada halaman Beranda .
                            </span>
                        </span>
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <div class="border border-stone-300 p-3 bg-white/40 rounded-sm">
                            <p class="font-diary-body font-bold text-[10px] text-stone-500 uppercase tracking-widest mb-2 border-b border-stone-200 pb-1">Desktop</p>
                            <div id="previewDesktopWrapper" class="hidden mb-2 relative p-1 bg-white border border-stone-200 shadow-sm">
                                <img id="previewDesktop" src="" class="w-full h-20 object-cover filter contrast-[0.95]">
                            </div>
                            <input type="file" name="image_desktop" accept="image/*" class="w-full text-xs text-stone-500 file:mr-2 file:py-1 file:px-2 file:border-0 file:border-stone-800 file:border file:text-[10px] file:uppercase file:bg-stone-100 file:text-stone-800 hover:file:bg-stone-200 file:cursor-pointer file:rounded-sm transition">
                        </div>

                        <div class="border border-stone-300 p-3 bg-white/40 rounded-sm">
                            <p class="font-diary-body font-bold text-[10px] text-stone-500 uppercase tracking-widest mb-2 border-b border-stone-200 pb-1">Tablet</p>
                            <div id="previewTabletWrapper" class="hidden mb-2 relative p-1 bg-white border border-stone-200 shadow-sm">
                                <img id="previewTablet" src="" class="w-full h-20 object-cover filter contrast-[0.95]">
                            </div>
                            <input type="file" name="image_tablet" accept="image/*" class="w-full text-xs text-stone-500 file:mr-2 file:py-1 file:px-2 file:border-0 file:border-stone-800 file:border file:text-[10px] file:uppercase file:bg-stone-100 file:text-stone-800 hover:file:bg-stone-200 file:cursor-pointer file:rounded-sm transition">
                        </div>

                        <div class="border border-stone-300 p-3 bg-white/40 rounded-sm">
                            <p class="font-diary-body font-bold text-[10px] text-stone-500 uppercase tracking-widest mb-2 border-b border-stone-200 pb-1">Mobile</p>
                            <div id="previewMobileWrapper" class="hidden mb-2 relative p-1 bg-white border border-stone-200 shadow-sm">
                                <img id="previewMobile" src="" class="w-full h-20 object-cover filter contrast-[0.95]">
                            </div>
                            <input type="file" name="image_mobile" accept="image/*" class="w-full text-xs text-stone-500 file:mr-2 file:py-1 file:px-2 file:border-0 file:border-stone-800 file:border file:text-[10px] file:uppercase file:bg-stone-100 file:text-stone-800 hover:file:bg-stone-200 file:cursor-pointer file:rounded-sm transition">
                        </div>

                    </div>
                </div>

                <div id="imageUploadEditRegion" x-data="imageUpload({
                    existing: @json(collect($project->screenshot ?? [])->map(fn($path) => [
                            'path' => $path,
                            'url' => asset('storage/' . $path),
                        ]))
                })" class="space-y-4">

                    <p class="font-diary-accent text-xl text-stone-500 mb-2 flex items-center gap-2">Galeri Proyek / Screenshots
                        <span class="text-sm">(8 Maks)</span>

                        <span class="relative group cursor-pointer">
                            <span class="text-xs border border-stone-400 text-stone-500 w-4 h-4 flex items-center justify-center rounded-full">
                                ?
                            </span>

                            <span class="absolute left-1/2 -translate-x-1/2 top-6 w-56
                                        bg-[#fffaf3] border border-stone-300 text-stone-600
                                        text-xs p-3 rounded shadow-md
                                        opacity-0 group-hover:opacity-100
                                        transition pointer-events-none z-20">
                                Menampilkan gambaran visual proyek agar pengguna dapat melihat fitur dan tampilan yang dibuat.
                            </span>
                        </span>
                    </p>

                    <label x-show="totalImages < max" class="flex flex-col items-center justify-center w-full h-32 border border-dashed border-stone-400 bg-white/30 cursor-pointer hover:border-stone-800 hover:bg-white/60 transition group rounded-sm">
                        <div class="text-center space-y-1">
                            <div class="text-stone-400 group-hover:text-stone-800 text-2xl transition-colors font-light">＋</div>
                            <p class="font-diary-body text-xs text-stone-500 group-hover:text-stone-800 transition-colors">Clip images here...</p>
                        </div>
                        <input type="file" multiple accept="image/*" name="new_screenshot[]" class="hidden" x-ref="fileInput" @change="handleFiles($event)">
                    </label>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3" x-show="totalImages">

                        <template x-for="(img, index) in existingImages" :key="'existing-' + index">
                            <div class="relative bg-white p-1.5 shadow-sm border border-stone-200 group transform hover:-translate-y-1 transition-transform">
                                <img :src="img.url" class="w-full h-24 object-cover filter contrast-[0.95] sepia-[0.1]">
                                <button type="button" @click="removeExisting(index)" class="absolute -top-2 -right-2 bg-red-100 border border-red-300 text-red-800 text-xs w-5 h-5 flex items-center justify-center rounded-full opacity-0 group-hover:opacity-100 transition shadow-sm hover:bg-red-200">
                                    ✕
                                </button>
                            </div>
                        </template>

                        <template x-for="(img, index) in newImages" :key="'new-' + index">
                            <div class="relative bg-white p-1.5 shadow-sm border border-stone-200 group transform hover:-translate-y-1 transition-transform">
                                <img :src="img.url" class="w-full h-24 object-cover filter contrast-[0.95] sepia-[0.1]">
                                <button type="button" @click="removeNew(index)" class="absolute -top-2 -right-2 bg-red-100 border border-red-300 text-red-800 text-xs w-5 h-5 flex items-center justify-center rounded-full opacity-0 group-hover:opacity-100 transition shadow-sm hover:bg-red-200">
                                    ✕
                                </button>
                            </div>
                        </template>
                    </div>

                    <template x-for="img in deletedImages">
                        <input type="hidden" name="deleted_screenshots[]" :value="img.path">
                    </template>

                    <p x-show="totalImages >= max" class="font-diary-body text-xs text-red-500/80 italic">
                        Album penuh (maksimal 8 gambar).
                    </p>

                </div>
            </div>

            <div class="w-full h-px bg-stone-300 border-t border-dashed border-stone-400/50"></div>

            <div>
                <p class="font-diary-accent text-xl text-stone-500 mb-2">Tech Stack</p>
                <div id="techStackEditRegion" x-data="tagInputEdit({{ Js::from($technologies) }})" x-ref="techComponent" class="w-full relative space-y-2">

                    <div class="flex flex-wrap gap-1.5 mb-3">
                        <template x-for="(tag, index) in tags" :key="index">
                            <div class="bg-stone-100 border border-stone-300 text-stone-600 px-2 py-1 flex items-center gap-2 text-[11px] uppercase tracking-wider font-mono rounded-sm shadow-sm">
                                <span x-text="tag"></span>
                                <button type="button" @click="removeTag(index)" class="text-stone-400 hover:text-red-500 transition">✕</button>
                            </div>
                        </template>
                    </div>

                    <input type="text" x-model="input" @input="search" @keydown.enter.prevent="addTag(input)" placeholder="Ketik # lalu nama teknologi (misal: #Laravel), tekan Enter untuk menambahkan" class="w-full px-4 py-2 diary-input">

                    <div x-show="filtered.length" x-transition class="absolute left-0 right-0 mt-1 bg-[#FCFAEF] border border-stone-300 shadow-lg max-h-48 overflow-y-auto z-50 rounded-sm">
                        <template x-for="item in filtered" :key="item">
                            <div @click="addTag(item)" class="px-4 py-2 text-sm cursor-pointer font-mono text-stone-600 hover:bg-stone-200 hover:text-stone-900 transition border-b border-stone-100 last:border-0">
                                <span x-text="item"></span>
                            </div>
                        </template>
                    </div>

                    <input type="hidden" name="tech" :value="JSON.stringify(tags)">
                </div>
            </div>

            <div class="w-full h-px bg-stone-300 border-t border-dashed border-stone-400/50"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="editRole" class="font-diary-accent text-xl text-stone-500 mb-1 block">Role</label>
                    <input type="text" name="role" id="editRole" class="w-full px-4 py-2 diary-input">
                </div>
                <div>
                    <label for="editTeamSize" class="font-diary-accent text-xl text-stone-500 mb-1 block">Jumlah Tim</label>
                    <input type="number" name="team_size" id="editTeamSize" class="w-full px-4 py-2 diary-input">
                </div>
            </div>

            <div>
                <label for="editResponsibilities" class="font-diary-accent text-xl text-stone-500 mb-1 block">Tanggung Jawab</label>
                <textarea name="responsibilities" id="editResponsibilities" rows="3" class="w-full px-4 py-2 diary-input resize-y"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="font-diary-accent text-xl text-stone-500 mb-1">Repository URL</p>
                    <input type="url" name="repo" id="editRepo" class="w-full px-4 py-2 diary-input">
                </div>
                <div>
                    <p class="font-diary-accent text-xl text-stone-500 mb-1">Live URL</p>
                    <input type="url" name="live_url" id="editLive" class="w-full px-4 py-2 diary-input">
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-6 mt-4 border-t border-stone-300/60">
                <button type="button" id="cancelEdit" class="px-6 py-2.5 bg-transparent border border-stone-400 text-stone-600 font-diary-body font-bold text-sm hover:border-stone-800 hover:text-stone-800 transition-colors rounded-sm">
                    Batalkan Revisi
                </button>

                <button type="submit" class="px-6 py-2.5 bg-stone-800 border border-stone-800 text-[#FCFAEF] font-diary-body font-bold text-sm hover:bg-stone-900 transition-colors shadow-md rounded-sm">
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>
</div>
