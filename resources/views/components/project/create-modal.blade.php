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

.diary-input {
    background-color: rgba(255, 255, 255, 0.4);
    border: 1px solid #d6d3d1;
    color: #292524;
    font-family: 'Merriweather', serif;
    font-size: 0.875rem;
    border-radius: 2px;
    transition: all 0.2s ease;
}
.diary-input:focus {
    outline: none;
    border-color: #292524;
    background-color: rgba(255, 255, 255, 0.7);
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}
</style>

<div id="createProjectModal" class="fixed inset-0 z-70 hidden items-center justify-center bg-stone-900/60 backdrop-blur-sm p-4 md:p-6">

    <div class="relative w-full max-w-3xl max-h-[85vh] overflow-y-auto hide-scrollbar bg-[#FCFAEF] text-stone-800 shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-stone-200/60 rounded-sm">

        <div class="absolute top-0 left-6 w-8 h-12 bg-red-800/80 rounded-b-sm shadow-sm z-0 pointer-events-none"></div>

        <button id="closeCreateModal" class="absolute top-6 right-6 text-stone-400 hover:text-stone-800 transition-colors z-10 text-xl font-light">
            ✕
        </button>

        <div class="px-8 pt-12 pb-4 md:px-12 relative z-10">
            <div class="flex items-center gap-3 mb-2 font-diary-accent text-xl">
                <span class="text-stone-500 transform rotate-1">Proyek Baru</span>
            </div>
        </div>

        <div class="w-full h-px bg-stone-300/60 border-t border-dashed border-stone-400 mx-8 md:mx-12 mb-6" style="width: calc(100% - 6rem);"></div>

        <form action="{{ route('dashboard.projects.store') }}" method="POST" enctype="multipart/form-data" class="px-8 pb-8 md:px-12 space-y-8">
            @csrf

            <div class="space-y-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="font-diary-accent text-xl text-stone-500 mb-1">Tipe Proyek</p>
                        <select name="type" class="w-full px-4 py-2 diary-input">
                            <option>Website</option>
                            <option>Web App</option>
                            <option>Application</option>
                            <option>Design</option>
                        </select>
                    </div>

                    <div>
                        <p class="font-diary-accent text-xl text-stone-500 mb-1">Status Proyek</p>
                        <select name="status" class="w-full px-4 py-2 diary-input">
                            <option>Prototype</option>
                            <option>In Progress</option>
                            <option>Shipped</option>
                            <option>Archived</option>
                        </select>
                    </div>
                </div>

                <div x-data="{ visibility: 'draft' }">
                    <p class="font-diary-accent text-xl text-stone-500 mb-1">Visabilitas</p>
                    <select name="visibility" x-model="visibility" class="w-full px-4 py-2 diary-input">
                        <option value="draft">Draft (Private)</option>
                        <option value="published">Publish (Public)</option>
                    </select>
                </div>

                <div>
                    <p class="font-diary-accent text-xl text-stone-500 mb-1">Judul</p>
                    <input type="text" name="title" required placeholder="Nama Proyek..." class="w-full px-4 py-2 diary-input font-bold">
                </div>

                <div>
                    <p class="font-diary-accent text-xl text-stone-500 mb-1">Deskripsi</p>
                    <textarea name="desc" rows="3" required placeholder="Jelaskan tujuan proyek, fitur utama, dan hasil yang dicapai..." class="w-full px-4 py-2 diary-input resize-y"></textarea>
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
                            <input type="file" name="image_desktop" accept="image/*" class="w-full text-xs text-stone-500 file:mr-2 file:py-1 file:px-2 file:border-0 file:border-stone-800 file:border file:text-[10px] file:uppercase file:bg-stone-100 file:text-stone-800 hover:file:bg-stone-200 file:cursor-pointer file:rounded-sm transition">
                        </div>
                        <div class="border border-stone-300 p-3 bg-white/40 rounded-sm">
                            <p class="font-diary-body font-bold text-[10px] text-stone-500 uppercase tracking-widest mb-2 border-b border-stone-200 pb-1">Tablet</p>
                            <input type="file" name="image_tablet" accept="image/*" class="w-full text-xs text-stone-500 file:mr-2 file:py-1 file:px-2 file:border-0 file:border-stone-800 file:border file:text-[10px] file:uppercase file:bg-stone-100 file:text-stone-800 hover:file:bg-stone-200 file:cursor-pointer file:rounded-sm transition">
                        </div>
                        <div class="border border-stone-300 p-3 bg-white/40 rounded-sm">
                            <p class="font-diary-body font-bold text-[10px] text-stone-500 uppercase tracking-widest mb-2 border-b border-stone-200 pb-1">Mobile</p>
                            <input type="file" name="image_mobile" accept="image/*" class="w-full text-xs text-stone-500 file:mr-2 file:py-1 file:px-2 file:border-0 file:border-stone-800 file:border file:text-[10px] file:uppercase file:bg-stone-100 file:text-stone-800 hover:file:bg-stone-200 file:cursor-pointer file:rounded-sm transition">
                        </div>
                    </div>
                </div>

                <div x-data="imageUpload()" class="space-y-4">
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

                    <label class="flex flex-col items-center justify-center w-full h-32 border border-dashed border-stone-400 bg-white/30 cursor-pointer hover:border-stone-800 hover:bg-white/60 transition group rounded-sm">
                        <div class="text-center space-y-1">
                            <div class="text-stone-400 group-hover:text-stone-800 text-2xl transition-colors font-light">＋</div>
                            <p class="font-diary-body text-xs text-stone-500 group-hover:text-stone-800 transition-colors">Clip images here...</p>
                        </div>
                        <input type="file" multiple accept="image/*" name="screenshot[]" class="hidden" x-ref="fileInput" @change="handleFiles($event)">
                    </label>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3" x-show="newImages.length">
                        <template x-for="(img, index) in newImages" :key="index">
                            <div class="relative bg-white p-1.5 shadow-sm border border-stone-200 group transform hover:-translate-y-1 transition-transform">
                                <img :src="img.url" class="w-full h-24 object-cover filter contrast-[0.95] sepia-[0.1]">
                                <button type="button" @click="removeNew(index)" class="absolute -top-2 -right-2 bg-red-100 border border-red-300 text-red-800 text-xs w-5 h-5 flex items-center justify-center rounded-full opacity-0 group-hover:opacity-100 transition shadow-sm hover:bg-red-200">
                                    ✕
                                </button>
                            </div>
                        </template>
                    </div>

                    <p x-show="newImages.length >= 8" class="font-diary-body text-xs text-red-500/80 italic">
                        Album penuh (maksimal 8 gambar).
                    </p>
                </div>
            </div>

            <div class="w-full h-px bg-stone-300 border-t border-dashed border-stone-400/50"></div>

            <div>
                <p class="font-diary-accent text-xl text-stone-500 mb-2">Tech Stack</p>

                <div x-data="tagInput({{ Js::from($technologies) }})" class="w-full relative">
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
                    <p class="font-diary-accent text-xl text-stone-500 mb-1">Role</p>
                    <input type="text" name="role" placeholder="e.g. Fullstack Developer" class="w-full px-4 py-2 diary-input">
                </div>
                <div>
                    <p class="font-diary-accent text-xl text-stone-500 mb-1">Jumlah Tim</p>
                    <input type="number" name="team_size" placeholder="1" class="w-full px-4 py-2 diary-input">
                </div>
            </div>

            <div>
                <p class="font-diary-accent text-xl text-stone-500 mb-1">Tanggung Jawab</p>
                <textarea name="responsibilities" rows="3" placeholder="Jelaskan peran dan tanggung jawab Anda dalam proyek ini..." class="w-full px-4 py-2 diary-input resize-y"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="font-diary-accent text-xl text-stone-500 mb-1">Repository URL</p>
                    <input type="url" name="repo" placeholder="https://github.com/..." class="w-full px-4 py-2 diary-input">
                </div>
                <div>
                    <p class="font-diary-accent text-xl text-stone-500 mb-1">Live URL</p>
                    <input type="url" name="live_url" placeholder="https://..." class="w-full px-4 py-2 diary-input">
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-6 mt-4">
                <button type="button" id="cancelCreateModal" class="px-6 py-2.5 bg-transparent border border-stone-400 text-stone-600 font-diary-body font-bold text-sm hover:border-stone-800 hover:text-stone-800 transition-colors rounded-sm">
                    Batal
                </button>

                <button type="submit" class="px-6 py-2.5 bg-stone-800 border border-stone-800 text-[#FCFAEF] font-diary-body font-bold text-sm hover:bg-stone-900 transition-colors shadow-md rounded-sm">
                    Tambah Proyek
                </button>
            </div>

        </form>

    </div>
</div>
