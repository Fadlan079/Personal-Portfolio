<section class="relative bg-surface border-2 border-dashed border-border rounded-2xl p-6 md:p-10 overflow-hidden mt-12 shadow-sm font-sans text-text">

    <div class="absolute inset-0 pointer-events-none opacity-[0.05]"
         style="background-image: repeating-linear-gradient(transparent, transparent 27px, var(--color-text) 27px, var(--color-text) 28px); line-height: 28px;">
    </div>

    <div class="absolute -top-1 right-12 w-16 h-8 bg-indigo-500/10 backdrop-blur-sm -rotate-3 border-x border-indigo-500/20" style="clip-path: polygon(0% 0%, 100% 0%, 95% 100%, 5% 100%);"></div>

    <header class="relative z-10 space-y-6 border-b-2 border-dashed border-border/50 pb-8 mb-10 max-w-2xl">
        <div class="relative inline-flex items-center gap-2 py-1.5 pl-8 pr-6 transition-all duration-300 w-max group hover:-translate-y-0.5 hover:rotate-1"
            style="filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.06));">

            <div class="absolute inset-0 bg-indigo-400/90 border border-indigo-500 rounded-l-md z-0 transition-colors"
                style="clip-path: polygon(0 0, 100% 0, 92% 50%, 100% 100%, 0 100%);">
            </div>

            <div class="absolute top-1/2 -left-4 w-6 h-[1.5px] bg-indigo-900/80 -translate-y-[calc(50%+1px)] origin-right -rotate-12 group-hover:-rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>
            <div class="absolute top-1/2 -left-3 w-5 h-[1.5px] bg-indigo-800/80 -translate-y-[calc(50%-1px)] origin-right rotate-12 group-hover:rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>

            <div class="absolute left-2.5 top-1/2 -translate-y-1/2 w-2.5 h-2.5 rounded-full bg-white shadow-[inset_1px_1px_3px_rgba(0,0,0,0.3)] border border-indigo-700/30 z-10"></div>

            <i class="fa-solid fa-key relative z-10 text-indigo-900 text-[11px] mt-px"></i>

            <span class="relative z-10 text-[10px] sm:text-xs font-black tracking-[0.15em] uppercase text-indigo-950 mt-px">
                Keamanan Sandi
            </span>
        </div>

        <div class="space-y-2">
            <h2 class="text-3xl md:text-4xl font-serif font-bold tracking-tight text-text">
                Kata Sandi
            </h2>
            <p class="text-sm text-muted font-medium italic leading-relaxed">
                Pastikan akun Anda tetap aman dengan mengganti kata sandi secara berkala.
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="relative z-10 space-y-10 max-w-2xl">
        @csrf
        @method('put')

        <div class="space-y-3 relative group">
            <label for="update_password_current_password" class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-muted group-focus-within:text-primary transition-colors">
                <i class="fa-solid fa-lock-open text-[8px]"></i> Kata Sandi Lama
            </label>
            <div class="relative">
                <i class="fa-solid fa-pen-nib absolute left-0 top-1/2 -translate-y-1/2 text-muted/40 text-xs group-focus-within:text-primary transition-colors"></i>
                <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                    placeholder="Masukkan sandi lama..."
                    class="w-full bg-transparent border-0 border-b-2 border-border px-6 py-2 font-serif text-base text-text focus:outline-none focus:border-primary focus:ring-0 transition-all placeholder:text-muted/30 placeholder:italic" />
            </div>
            @error('current_password', 'updatePassword')
                <p class="text-[10px] font-bold text-red-500 uppercase tracking-wider flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="space-y-3 relative group">
                <label for="update_password_password" class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-muted group-focus-within:text-primary transition-colors">
                    <i class="fa-solid fa-signature text-[8px]"></i> Kata Sandi Baru
                </label>
                <div class="relative">
                    <i class="fa-solid fa-pen-nib absolute left-0 top-1/2 -translate-y-1/2 text-muted/40 text-xs group-focus-within:text-primary transition-colors"></i>
                    <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                        placeholder="Masukkan sandi baru..."
                        class="w-full bg-transparent border-0 border-b-2 border-border px-6 py-2 font-serif text-base text-text focus:outline-none focus:border-primary focus:ring-0 transition-all placeholder:text-muted/30 placeholder:italic" />
                </div>
                @error('password', 'updatePassword')
                    <p class="text-[10px] font-bold text-red-500 uppercase tracking-wider flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-3 relative group">
                <label for="update_password_password_confirmation" class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-muted group-focus-within:text-primary transition-colors">
                    <i class="fa-solid fa-check-double text-[8px]"></i> Ulangi Kata Sandi
                </label>
                <div class="relative">
                    <i class="fa-solid fa-pen-nib absolute left-0 top-1/2 -translate-y-1/2 text-muted/40 text-xs group-focus-within:text-primary transition-colors"></i>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                        placeholder="Ulangi sandi baru..."
                        class="w-full bg-transparent border-0 border-b-2 border-border px-6 py-2 font-serif text-base text-text focus:outline-none focus:border-primary focus:ring-0 transition-all placeholder:text-muted/30 placeholder:italic" />
                </div>
                @error('password_confirmation', 'updatePassword')
                    <p class="text-[10px] font-bold text-red-500 uppercase tracking-wider flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 pt-8 border-t-2 border-dashed border-border/50">

            <button type="submit"
                class="group relative px-8 py-3 bg-warning border-2 border-yellow-600 text-yellow-900 font-bold text-xs uppercase tracking-[0.2em] hover:-translate-y-1 transition-all shadow-[4px_4px_0px_var(--color-border)] active:shadow-none active:translate-y-0.5 rounded-lg flex items-center gap-3">
                <span>Simpan</span>
                <i class="fa-solid fa-floppy-disk group-hover:animate-bounce text-yellow-700"></i>
            </button>
        </div>
    </form>

    <i class="fa-solid fa-shield-halved absolute bottom-6 right-8 text-6xl text-muted/5 -rotate-12 pointer-events-none"></i>
</section>
