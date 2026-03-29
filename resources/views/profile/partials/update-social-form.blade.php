<section class="relative bg-surface border-2 border-dashed border-border rounded-2xl p-6 md:p-8 space-y-8 group transition-all duration-500 shadow-sm overflow-hidden font-sans text-text">

    <div class="absolute inset-0 pointer-events-none opacity-[0.05]"
         style="background-image: repeating-linear-gradient(transparent, transparent 27px, var(--color-text) 27px, var(--color-text) 28px); line-height: 28px;">
    </div>
    <header class="relative z-10 border-b-2 border-dashed border-border/50 pb-6 mb-2">
        <div class="relative inline-flex items-center gap-2 py-1.5 pl-8 pr-6 transition-all duration-300 w-max group hover:-translate-y-0.5 hover:rotate-1"
            style="filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.06));">

            <div class="absolute inset-0 bg-emerald-400/90 border border-emerald-500 rounded-l-md z-0 transition-colors"
                style="clip-path: polygon(0 0, 100% 0, 92% 50%, 100% 100%, 0 100%);">
            </div>

            <div class="absolute top-1/2 -left-4 w-6 h-[1.5px] bg-emerald-900/80 -translate-y-[calc(50%+1px)] origin-right -rotate-12 group-hover:-rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>
            <div class="absolute top-1/2 -left-3 w-5 h-[1.5px] bg-emerald-800/80 -translate-y-[calc(50%-1px)] origin-right rotate-12 group-hover:rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>

            <div class="absolute left-2.5 top-1/2 -translate-y-1/2 w-2.5 h-2.5 rounded-full bg-white shadow-[inset_1px_1px_3px_rgba(0,0,0,0.3)] border border-emerald-700/30 z-10"></div>

            <i class="fa-solid fa-share-nodes relative z-10 text-emerald-900 text-[11px] mt-px"></i>

            <span class="relative z-10 text-[10px] sm:text-xs font-black tracking-[0.15em] uppercase text-emerald-950 mt-px">
                Media Sosial
            </span>
        </div>

        <div class="mt-4">
            <h2 class="text-xl md:text-2xl font-serif font-bold tracking-tight text-text">
                Tautan Komunikasi
            </h2>
            <p class="text-[10px] md:text-xs font-medium text-muted mt-1 tracking-wide italic uppercase">
                Hubungkan akun media sosial dan platform profesional Anda.
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('dashboard.account.socials.update') }}" class="relative z-10 space-y-8">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">

            <div class="space-y-2 relative group/input">
                <label for="whatsapp" class="text-[10px] font-bold uppercase tracking-[0.2em] text-muted group-focus-within/input:text-emerald-600 transition-colors flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> WhatsApp
                </label>
                <div class="relative">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 text-muted/40 group-focus-within/input:text-emerald-500 transition-colors">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                    </div>
                    <input type="text" id="whatsapp" name="whatsapp"
                        class="w-full bg-transparent border-0 border-b-2 border-border pl-8 pr-4 py-2 font-serif text-base text-text focus:outline-none focus:border-emerald-500 focus:ring-0 transition-all placeholder:text-muted/30 placeholder:italic"
                        placeholder="+628..." value="{{ old('whatsapp', $user->whatsapp) }}" />
                </div>
            </div>

            <div class="space-y-2 relative group/input">
                <label for="instagram" class="text-[10px] font-bold uppercase tracking-[0.2em] text-muted group-focus-within/input:text-pink-600 transition-colors flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-pink-500"></span> Instagram
                </label>
                <div class="relative">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 text-muted/40 group-focus-within/input:text-pink-500 transition-colors">
                        <i class="fa-brands fa-instagram text-lg"></i>
                    </div>
                    <input type="text" id="instagram" name="instagram"
                        class="w-full bg-transparent border-0 border-b-2 border-border pl-8 pr-4 py-2 font-serif text-base text-text focus:outline-none focus:border-pink-500 focus:ring-0 transition-all placeholder:text-muted/30 placeholder:italic"
                        placeholder="@username" value="{{ old('instagram', $user->instagram) }}" />
                </div>
            </div>

            <div class="space-y-2 relative group/input">
                <label for="github" class="text-[10px] font-bold uppercase tracking-[0.2em] text-muted group-focus-within/input:text-text transition-colors flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-gray-800"></span> GitHub
                </label>
                <div class="relative">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 text-muted/40 group-focus-within/input:text-text transition-colors">
                        <i class="fa-brands fa-github text-lg"></i>
                    </div>
                    <input type="text" id="github" name="github"
                        class="w-full bg-transparent border-0 border-b-2 border-border pl-8 pr-4 py-2 font-serif text-base text-text focus:outline-none focus:border-text focus:ring-0 transition-all placeholder:text-muted/30 placeholder:italic"
                        placeholder="github.com/..." value="{{ old('github', $user->github) }}" />
                </div>
            </div>

            <div class="space-y-2 relative group/input">
                <label for="linkedin" class="text-[10px] font-bold uppercase tracking-[0.2em] text-muted group-focus-within/input:text-sky-600 transition-colors flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span> LinkedIn
                </label>
                <div class="relative">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 text-muted/40 group-focus-within/input:text-sky-500 transition-colors">
                        <i class="fa-brands fa-linkedin-in text-lg"></i>
                    </div>
                    <input type="text" id="linkedin" name="linkedin"
                        class="w-full bg-transparent border-0 border-b-2 border-border pl-8 pr-4 py-2 font-serif text-base text-text focus:outline-none focus:border-sky-500 focus:ring-0 transition-all placeholder:text-muted/30 placeholder:italic"
                        placeholder="linkedin.com/in/..." value="{{ old('linkedin', $user->linkedin) }}" />
                </div>
            </div>

        </div>

        <div class="pt-8 flex items-center gap-6 border-t-2 border-dashed border-border/50">
            <button type="submit"
                class="group relative px-8 py-3 bg-warning border-2 border-yellow-600 text-yellow-900 font-bold text-xs uppercase tracking-[0.2em] hover:-translate-y-1 transition-all shadow-[4px_4px_0px_var(--color-border)] active:shadow-none active:translate-y-0.5 rounded-lg flex items-center gap-3">
                <span>Simpan</span>
                <i class="fa-solid fa-stamp group-hover:rotate-12 transition-transform text-yellow-700"></i>
            </button>

        </div>
    </form>

    <i class="fa-solid fa-paper-plane absolute -bottom-4 -right-4 text-8xl text-muted/5 -rotate-12 pointer-events-none"></i>
</section>
