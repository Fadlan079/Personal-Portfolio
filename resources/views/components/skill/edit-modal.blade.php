<style>
/* Anda bisa menghapus blok style ini jika sudah ada di file layout utama Anda */
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}

.diary-input {
    background-color: rgba(255, 255, 255, 0.4);
    border: 1px solid #d6d3d1;
    color: #292524;
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

<div id="editSkillModal" class="fixed inset-0 z-70 hidden items-center justify-center bg-stone-900/60 backdrop-blur-sm p-4 md:p-6 font-sans">

    <div class="relative w-full max-w-xl max-h-[85vh] overflow-y-auto hide-scrollbar bg-[#FCFAEF] text-stone-800 shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-stone-200/60 rounded-sm">

        <div class="absolute top-0 left-6 w-8 h-12 bg-red-800/80 rounded-b-sm shadow-sm z-0 pointer-events-none"></div>

        <button id="closeEditSkillModal" class="absolute top-6 right-6 text-stone-400 hover:text-stone-800 transition-colors z-10 text-xl font-light">
            ✕
        </button>

        <div class="px-8 pt-12 pb-4 md:px-12 relative z-10">
            <div class="flex items-center gap-3 mb-1">
                <h2 class="font-serif font-bold text-2xl text-stone-700">Edit Skill</h2>
            </div>
        </div>

        <div class="w-full h-px bg-stone-300/60 border-t border-dashed border-stone-400 mx-8 md:mx-12 mb-6" style="width: calc(100% - 6rem);"></div>

        <form id="editSkillForm" method="POST" class="px-8 pb-8 md:px-12 space-y-8">
            @csrf
            @method('PUT')

            <div class="space-y-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-serif font-semibold text-lg text-stone-600 mb-2">Nama Keahlian</label>
                        <input type="text" id="editSkillName" name="name" required class="w-full px-4 py-2 diary-input font-medium font-sans">
                    </div>

                    <div>
                        <label class="block font-serif font-semibold text-lg text-stone-600 mb-2">Kategori</label>
                        <select id="editSkillCategory" name="category" required class="w-full px-4 py-2 diary-input font-sans">
                            <option value="frontend">Frontend</option>
                            <option value="backend">Backend</option>
                            <option value="tools">Tools</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center gap-3 py-2">
                    <input type="checkbox" id="editSkillCore" name="is_core" value="1"
                        class="w-4 h-4 bg-transparent border-stone-400 text-stone-800 focus:ring-stone-800 rounded-sm cursor-pointer">
                    <label for="editSkillCore" class="text-sm text-stone-600 cursor-pointer">
                        Tandai sebagai Core Skill (Tampil meskipun belum ada proyek)
                    </label>
                </div>

                <div class="w-full h-px bg-stone-300 border-t border-dashed border-stone-400/50"></div>

                <div>
                    <label class="block font-serif font-semibold text-lg text-stone-600 mb-2">Catatan Singkat</label>
                    <textarea id="editSkillDescription" name="description" rows="3" class="w-full px-4 py-2 diary-input resize-y font-sans"></textarea>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block font-serif font-semibold text-lg text-stone-600">Ikon / Simbol</label>
                        <a href="https://fontawesome.com/search?o=r&m=free" target="_blank"
                            class="text-xs text-stone-500 hover:text-blue-600 underline transition-colors flex items-center gap-1">
                            Cari Ikon <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        </a>
                    </div>
                    <textarea id="editSkillIcon" name="icon" rows="3" placeholder='e.g. <i class="fa-brands fa-laravel"></i> or <svg>...</svg>'
                        class="w-full px-4 py-2 diary-input font-mono text-xs leading-relaxed resize-y"></textarea>
                    <p class="text-xs text-stone-400 mt-1 italic">Menerima tag `<i>` dari FontAwesome atau kode raw `<svg>`.</p>
                </div>

            </div>

            <div class="flex justify-end gap-3 pt-6 mt-4 border-t border-dashed border-stone-400/50">
                <button type="button" id="cancelEditSkillBtn" class="px-6 py-2 bg-transparent border border-stone-300 text-stone-600 font-semibold text-sm hover:border-stone-500 hover:text-stone-800 transition-colors rounded-sm">
                    Batal
                </button>

                <button type="submit" class="px-6 py-2 bg-stone-800 border border-stone-800 text-[#FCFAEF] font-semibold text-sm hover:bg-stone-900 transition-colors shadow-sm rounded-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    window.openEditSkillModal = function(id, name, category, icon, description, is_core) {
        const modal = document.getElementById('editSkillModal');
        const form = document.getElementById('editSkillForm');

        // Sesuaikan action form ke endpoint yang tepat
        form.action = `/dashboard/skills/${id}`;

        // Isi data ke dalam form
        document.getElementById('editSkillName').value = name;
        document.getElementById('editSkillCategory').value = category;
        document.getElementById('editSkillIcon').value = icon || '';
        document.getElementById('editSkillDescription').value = description || '';

        // Atur nilai checkbox
        document.getElementById('editSkillCore').checked = is_core == 1;

        // Tampilkan modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    };

    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('editSkillModal');
        const closeBtn = document.getElementById('closeEditSkillModal');
        const cancelBtn = document.getElementById('cancelEditSkillBtn');

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        if (closeBtn) closeBtn.addEventListener('click', closeModal);
        if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

        // Tutup saat mengklik area latar belakang
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });
    });
</script>
