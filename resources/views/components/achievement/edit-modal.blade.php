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

<div id="editAchievementModal" class="fixed inset-0 z-70 hidden items-center justify-center bg-stone-900/60 backdrop-blur-sm p-4 md:p-6">

    <div class="relative w-full max-w-3xl max-h-[85vh] overflow-y-auto hide-scrollbar bg-[#FCFAEF] text-stone-800 shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-stone-200/60 rounded-sm">

        <div class="absolute top-0 left-6 w-8 h-12 bg-red-800/80 rounded-b-sm shadow-sm z-0 pointer-events-none"></div>

        <button id="closeEditAchievementModal" type="button" class="absolute top-6 right-6 text-stone-400 hover:text-stone-800 transition-colors z-10 text-xl font-light">
            ✕
        </button>

        <div class="px-8 pt-12 pb-4 md:px-12 relative z-10">
            <div class="flex items-center gap-3 mb-2 font-diary-accent text-xl">
                <span class="text-stone-500 transform rotate-1">Sunting Pencapaian</span>
            </div>
        </div>

        <div class="w-full h-px bg-stone-300/60 border-t border-dashed border-stone-400 mx-8 md:mx-12 mb-6" style="width: calc(100% - 6rem);"></div>

        <form id="editAchievementForm" method="POST" enctype="multipart/form-data" class="px-8 pb-8 md:px-12 space-y-8">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="editAchievementId">

            <div class="space-y-6">

                <div>
                    <label for="editAchievementTitle" class="font-diary-accent text-xl text-stone-500 mb-1 block">Judul Pencapaian <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="editAchievementTitle" required class="w-full px-4 py-2 diary-input font-bold">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="editAchievementIssuer" class="font-diary-accent text-xl text-stone-500 mb-1 block">Penerbit</label>
                        <input type="text" name="issuer" id="editAchievementIssuer" class="w-full px-4 py-2 diary-input">
                    </div>

                    <div>
                        <label for="editAchievementDate" class="font-diary-accent text-xl text-stone-500 mb-1 block">Tanggal / Bulan</label>
                        <input type="date" name="date" id="editAchievementDate" class="w-full px-4 py-2 diary-input">
                    </div>
                </div>


                <div>
                    <p class="font-diary-accent text-xl text-stone-500 mb-2">Gambar / Sertifikat (Max 10MB)</p>

                    <div class="relative border border-dashed border-stone-400 bg-white/30 rounded-sm p-6 text-center hover:bg-white/60 hover:border-stone-800 transition group cursor-pointer">
                        <input type="file" name="image" id="editAchievementImageInput" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" onchange="previewAchievementImage(event, 'previewEditAchievement')">

                        <div id="placeholderEditAchievement" class="space-y-2 pointer-events-none">
                            <div class="text-stone-400 group-hover:text-stone-800 text-2xl transition-colors font-light">＋</div>
                            <p class="font-diary-body text-xs text-stone-500 group-hover:text-stone-800 transition-colors">Clip image here atau ganti gambar...</p>
                            <p class="text-[10px] text-stone-400 uppercase tracking-widest">PNG, JPG, JPEG (Max. 10MB)</p>
                        </div>

                        <div id="previewEditAchievementContainer" class="hidden relative w-full aspect-video bg-stone-100 rounded-sm overflow-hidden z-10 border border-stone-200">
                            <img id="previewEditAchievement" src="#" alt="Preview" class="w-full h-full object-contain filter contrast-[0.95] sepia-[0.1]">
                            <div class="absolute inset-x-0 bottom-0 bg-stone-900/60 text-white text-xs py-1 px-3 backdrop-blur-sm justify-between items-center hidden group-hover:flex">
                                <span id="fileNameEditAchievement" class="truncate line-clamp-1 inline-block text-left w-3/4">Gambar Saat Ini</span>
                                <span class="underline ml-2">Ganti</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-6 md:pt-8 border-t border-stone-300/60 mt-8">
                <button type="button" id="cancelEditAchievement" class="px-6 py-2.5 bg-transparent border border-stone-400 text-stone-600 font-diary-body font-bold text-sm hover:border-stone-800 hover:text-stone-800 transition-colors rounded-sm">
                    Batalkan Revisi
                </button>

                <button type="submit" class="px-6 py-2.5 bg-stone-800 border border-stone-800 text-[#FCFAEF] font-diary-body font-bold text-sm hover:bg-stone-900 transition-colors shadow-[2px_2px_0px_rgba(0,0,0,0.2)] hover:shadow-none hover:translate-y-0.5 rounded-sm">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
