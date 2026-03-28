<section class="relative bg-surface border-2 border-dashed border-border rounded-2xl p-6 md:p-8 space-y-8 group transition-all duration-500 shadow-sm overflow-hidden font-sans text-text">

    {{-- Diary Paper Lines Background --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.05]"
         style="background-image: repeating-linear-gradient(transparent, transparent 27px, var(--color-text) 27px, var(--color-text) 28px); line-height: 28px;">
    </div>

    {{-- Header Module --}}
    <header class="relative z-10 border-b-2 border-dashed border-border/50 pb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center border-2 border-primary/20 rotate-[-5deg]">
                <i class="fa-solid fa-address-book text-primary text-lg"></i>
            </div>
            <div>
                <h2 class="text-xl md:text-2xl font-serif font-bold tracking-tight text-text">
                    Daftar Korespondensi
                </h2>
                <p class="text-[10px] md:text-xs font-medium text-muted mt-1 tracking-wide italic uppercase">
                    Hubungkan jejaring sosial dan media komunikasi eksternal Anda.
                </p>
            </div>
        </div>
    </header>

    {{-- Form --}}
    <form method="post" action="{{ route('dashboard.account.socials.update') }}" class="relative z-10 space-y-8">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">

            {{-- WhatsApp Node --}}
            <div class="space-y-2 relative group/input">
                <label for="whatsapp" class="text-[10px] font-bold uppercase tracking-[0.2em] text-muted group-focus-within/input:text-green-600 transition-colors flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> WhatsApp
                </label>
                <div class="relative">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 text-muted/40 group-focus-within/input:text-green-500 transition-colors">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                    </div>
                    <input type="text" id="whatsapp" name="whatsapp"
                        class="w-full bg-transparent border-0 border-b-2 border-border pl-8 pr-4 py-2 font-serif text-base text-text focus:outline-none focus:border-green-500 focus:ring-0 transition-all placeholder:text-muted/30 placeholder:italic"
                        placeholder="+628..." value="{{ old('whatsapp', $user->whatsapp) }}" />
                </div>
            </div>

            {{-- Instagram Node --}}
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

            {{-- GitHub Node --}}
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

            {{-- LinkedIn Node --}}
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

        {{-- Submit Action --}}
        <div class="pt-8 flex items-center gap-6 border-t-2 border-dashed border-border/50">
            <button type="submit"
                class="group relative px-8 py-3 bg-container border-2 border-border text-text font-bold text-xs uppercase tracking-[0.2em] hover:border-primary hover:text-primary hover:-translate-y-1 transition-all shadow-[4px_4px_0px_var(--color-border)] active:shadow-none active:translate-y-0.5 rounded-lg flex items-center gap-3">
                <span>Perbarui Jejaring</span>
                <i class="fa-solid fa-stamp group-hover:rotate-12 transition-transform"></i>
            </button>

            @if (session('status') === 'socials-updated')
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
                    class="text-[10px] font-bold text-green-700 uppercase tracking-widest flex items-center gap-2 bg-green-50 px-4 py-2 border-2 border-green-200 rounded-full rotate-1 shadow-sm">
                    <i class="fa-solid fa-check-circle animate-pulse"></i> Data Tersinkron
                </div>
            @endif
        </div>
    </form>

    {{-- Decorative Background Icon --}}
    <i class="fa-solid fa-paper-plane absolute -bottom-4 -right-4 text-8xl text-muted/5 -rotate-12 pointer-events-none"></i>
</section>
