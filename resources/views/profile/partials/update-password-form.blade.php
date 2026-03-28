<section class="relative bg-surface border-2 border-dashed border-border rounded-2xl p-6 md:p-10 overflow-hidden mt-12 shadow-sm font-sans text-text">

    {{-- Diary Paper Lines Background --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.05]"
         style="background-image: repeating-linear-gradient(transparent, transparent 27px, var(--color-text) 27px, var(--color-text) 28px); line-height: 28px;">
    </div>

    {{-- Decorative "Tape" Accent --}}
    <div class="absolute -top-1 right-12 w-16 h-8 bg-primary/10 backdrop-blur-sm -rotate-3 border-x border-primary/20" style="clip-path: polygon(0% 0%, 100% 0%, 95% 100%, 5% 100%);"></div>

    {{-- Header --}}
    <header class="relative z-10 space-y-3 border-b-2 border-dashed border-border/50 pb-8 mb-10 max-w-2xl">
        <div class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-primary">
            <i class="fa-solid fa-key text-[10px]"></i>
            <span class="bg-primary/10 px-2 py-0.5 rounded">Log Keamanan // Kredensial</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-serif font-bold tracking-tight text-text">
            Perbarui Kata Sandi
        </h2>
        <p class="text-sm text-muted font-medium italic leading-relaxed">
            Pastikan integritas catatan Anda tetap terjaga. Ubah kunci otentikasi secara berkala untuk akses yang lebih aman.
        </p>
    </header>

    {{-- Form --}}
    <form method="post" action="{{ route('password.update') }}" class="relative z-10 space-y-10 max-w-2xl">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div class="space-y-3 relative group">
            <label for="update_password_current_password" class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-muted group-focus-within:text-primary transition-colors">
                <i class="fa-solid fa-lock-open text-[8px]"></i> Sandi Saat Ini
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
            {{-- New Password --}}
            <div class="space-y-3 relative group">
                <label for="update_password_password" class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-muted group-focus-within:text-primary transition-colors">
                    <i class="fa-solid fa-signature text-[8px]"></i> Sandi Baru
                </label>
                <div class="relative">
                    <i class="fa-solid fa-pen-nib absolute left-0 top-1/2 -translate-y-1/2 text-muted/40 text-xs group-focus-within:text-primary transition-colors"></i>
                    <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                        placeholder="Goreskan sandi baru..."
                        class="w-full bg-transparent border-0 border-b-2 border-border px-6 py-2 font-serif text-base text-text focus:outline-none focus:border-primary focus:ring-0 transition-all placeholder:text-muted/30 placeholder:italic" />
                </div>
                @error('password', 'updatePassword')
                    <p class="text-[10px] font-bold text-red-500 uppercase tracking-wider flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="space-y-3 relative group">
                <label for="update_password_password_confirmation" class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-muted group-focus-within:text-primary transition-colors">
                    <i class="fa-solid fa-check-double text-[8px]"></i> Konfirmasi Sandi
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

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 pt-8 border-t-2 border-dashed border-border/50">

            <button type="submit"
                class="group relative px-8 py-3 bg-container border-2 border-border text-text font-bold text-xs uppercase tracking-[0.2em] hover:border-primary hover:text-primary hover:-translate-y-1 transition-all shadow-[4px_4px_0px_var(--color-border)] active:shadow-none active:translate-y-0.5 rounded-lg flex items-center gap-3">
                <span>Simpan Perubahan</span>
                <i class="fa-solid fa-floppy-disk group-hover:animate-bounce"></i>
            </button>

            @if (session('status') === 'password-updated')
                <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms x-init="setTimeout(() => show = false, 3000)"
                    class="text-[10px] font-bold text-green-700 uppercase tracking-widest flex items-center gap-2 bg-green-50 px-4 py-2 border-2 border-green-200 rounded-full rotate-1 shadow-sm">
                    <i class="fa-solid fa-check-circle animate-pulse"></i> Data Berhasil Diperbarui
                </div>
            @endif

        </div>
    </form>

    {{-- Decorative Corner Icon --}}
    <i class="fa-solid fa-shield-halved absolute bottom-6 right-8 text-6xl text-muted/5 -rotate-12 pointer-events-none"></i>
</section>
