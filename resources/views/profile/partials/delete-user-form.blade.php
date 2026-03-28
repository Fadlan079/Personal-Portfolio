<section class="relative bg-surface border-2 border-dashed border-red-800/30 rounded-2xl p-6 md:p-10 overflow-hidden mt-12 shadow-sm font-sans text-text">

    {{-- Subtle red hatched background (Vintage Warning Pattern) --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.03]"
         style="background-image: repeating-linear-gradient(-45deg, transparent, transparent 10px, #991b1b 10px, #991b1b 12px);">
    </div>

    {{-- Vintage Photo Corners --}}
    <div class="absolute top-3 left-3 w-4 h-4 border-t-2 border-l-2 border-red-800/40 rounded-tl-sm"></div>
    <div class="absolute top-3 right-3 w-4 h-4 border-t-2 border-r-2 border-red-800/40 rounded-tr-sm"></div>
    <div class="absolute bottom-3 left-3 w-4 h-4 border-b-2 border-l-2 border-red-800/40 rounded-bl-sm"></div>
    <div class="absolute bottom-3 right-3 w-4 h-4 border-b-2 border-r-2 border-red-800/40 rounded-br-sm"></div>

    {{-- Header --}}
    <header class="relative z-10 space-y-3 pb-6 mb-8 max-w-2xl border-b-2 border-red-800/10">
        <div class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-red-700">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <span>Catatan Kritis // Zona Bahaya</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-serif font-bold tracking-tight text-red-900">
            Hapus Lembar Akun
        </h2>
        <p class="text-sm text-muted font-medium leading-relaxed">
            Mengeksekusi tindakan ini akan membakar dan menghapus seluruh lembaran catatan, pengaturan, dan data Anda secara permanen. <span class="font-bold underline decoration-red-500/50 underline-offset-4 text-red-800">Tindakan ini tidak dapat dibatalkan.</span>
        </p>
    </header>

    {{-- Trigger Button --}}
    <div class="relative z-10">
        <button
            x-data
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="group relative px-6 py-3 bg-red-50 border-2 border-red-800 text-red-900 text-xs font-bold uppercase tracking-widest hover:bg-red-800 hover:text-white transition-all flex items-center gap-3 shadow-[3px_4px_0px_#991b1b] hover:shadow-[1px_2px_0px_#991b1b] hover:translate-y-1 w-max rounded-lg focus:outline-none"
        >
            <span>Robek & Hapus Permanen</span>
            <i class="fa-solid fa-trash-can group-hover:animate-bounce"></i>
        </button>
    </div>

    {{-- Alpine Modal --}}
    <div
        x-data="{ show: false }"
        x-on:open-modal.window="if ($event.detail === 'confirm-user-deletion') show = true"
        x-on:close.window="show = false"
        x-show="show"
        class="fixed inset-0 z-[99999] flex items-center justify-center px-4 font-sans"
        style="display: none;"
    >
        {{-- Backdrop --}}
        <div x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0 bg-stone-900/60 backdrop-blur-sm cursor-pointer"
             x-on:click="show = false">
        </div>

        {{-- Modal Box (Memo Card Style) --}}
        <div x-show="show"
             x-transition:enter="transition ease-out duration-300 delay-75"
             x-transition:enter-start="opacity-0 translate-y-8 rotate-3 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 rotate-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             class="relative w-full max-w-[450px] bg-[#fdfbf7] rounded-xl border-2 border-stone-300 shadow-[6px_8px_0px_rgba(153,27,27,0.8)] overflow-hidden">

            {{-- Red Tape Banner --}}
            <div class="h-3 w-full bg-red-800" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.1) 10px, rgba(255,255,255,0.1) 20px);"></div>

            {{-- Form Content --}}
            <form method="post" action="{{ route('dashboard.account.destroy') }}" class="flex flex-col h-full relative z-10">
                @csrf
                @method('delete')

                {{-- Watermark --}}
                <i class="fa-solid fa-stamp absolute -bottom-4 -right-4 text-7xl text-red-100 -rotate-12 pointer-events-none"></i>

                <div class="p-6 md:p-8 flex items-start gap-4">
                    {{-- Icon Box --}}
                    <div class="shrink-0 w-10 h-10 flex items-center justify-center bg-red-100 border border-red-300 text-red-800 rounded-full mt-1 shadow-sm">
                        <i class="fa-solid fa-exclamation"></i>
                    </div>

                    {{-- Text & Input --}}
                    <div class="flex-1 space-y-4">
                        <div>
                            <h2 class="text-xl font-serif font-bold text-stone-800 leading-tight mb-2">
                                Konfirmasi Penghapusan
                            </h2>
                            <p class="text-xs text-stone-500 font-medium leading-relaxed">
                                Tindakan ini tidak dapat dikembalikan. Silakan masukkan kata sandi Anda sebagai cap persetujuan akhir.
                            </p>
                        </div>

                        {{-- Password Input --}}
                        <div class="space-y-2 relative group mt-4">
                            <label for="password" class="block text-[10px] font-bold uppercase tracking-widest text-stone-500 group-focus-within:text-red-800 transition-colors">
                                Kata Sandi Otorisasi
                            </label>

                            <div class="relative">
                                <i class="fa-solid fa-pen absolute left-0 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    class="w-full bg-transparent border-0 border-b-2 border-stone-300 pl-6 pr-4 py-2 font-serif text-base text-stone-800 focus:outline-none focus:border-red-800 focus:ring-0 transition-colors placeholder:text-stone-300 placeholder:italic"
                                    placeholder="Goreskan sandi Anda..."
                                    x-ref="password"
                                />
                            </div>

                            @error('password', 'userDeletion')
                                <p class="text-[10px] font-bold text-red-700 uppercase tracking-wider mt-2 flex items-center gap-1">
                                    <i class="fa-solid fa-xmark"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex p-6 pt-2 gap-4 bg-transparent mt-auto relative z-10">
                    <button
                        type="button"
                        x-on:click="$dispatch('close')"
                        class="flex-1 py-3 px-4 font-bold text-xs uppercase tracking-widest text-stone-500 hover:text-stone-800 transition-colors"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="flex-1 py-3 px-4 bg-red-800 border-2 border-red-900 rounded-lg text-white font-bold text-xs uppercase tracking-widest shadow-[3px_4px_0px_#450a0a] hover:translate-y-1 hover:shadow-[0px_0px_0px_#450a0a] transition-all flex items-center justify-center gap-2 group"
                    >
                        <span>Eksekusi</span>
                        <i class="fa-solid fa-fire group-hover:scale-110 transition-transform"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
