@php use Illuminate\Support\Facades\Storage; @endphp

<section class="relative bg-surface border-2 border-dashed border-border rounded-2xl p-6 md:p-10 overflow-hidden shadow-sm font-sans text-text">

    {{-- Diary Paper Lines Background --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.05]"
         style="background-image: repeating-linear-gradient(transparent, transparent 27px, var(--color-text) 27px, var(--color-text) 28px); line-height: 28px;">
    </div>

    {{-- Header --}}
    <header class="relative z-10 space-y-3 border-b-2 border-dashed border-border/50 pb-8 mb-10 max-w-2xl">
        <div class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-primary">
            <i class="fa-solid fa-address-card text-[10px]"></i>
            <span class="bg-primary/10 px-2 py-0.5 rounded">Personal Journal // Identitas</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-serif font-bold tracking-tight text-text">
            Profil Pengguna
        </h2>
        <p class="text-sm text-muted font-medium italic leading-relaxed">
            Perbarui parameter diri Anda dan visualisasi karakter untuk catatan perjalanan ini.
        </p>
    </header>

    {{-- Email Verification Hidden Form --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Main Form --}}
    <form method="post" action="{{ route('dashboard.account.update') }}" enctype="multipart/form-data"
        class="relative z-10 space-y-12 max-w-2xl">
        @csrf
        @method('patch')

        {{-- Profile Photo Upload (Polaroid Style) --}}
        <div class="space-y-6">
            <label class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-muted">
                <i class="fa-solid fa-camera-retro"></i> Foto Profil (Visual ID)
            </label>

            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-10">
                {{-- Styled Polaroid Preview --}}
                <div class="relative group cursor-pointer" onclick="document.getElementById('profile_photo_input').click()">

                    {{-- Washi Tape Accents --}}
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-16 h-8 bg-primary/20 backdrop-blur-sm rotate-2 z-20 border-x border-primary/10"></div>

                    {{-- Polaroid Frame --}}
                    <div class="relative z-10 p-3 pb-10 bg-white border border-border/40 shadow-xl rotate-[-2deg] transition-transform duration-500 group-hover:rotate-0 group-hover:scale-105">
                        <div class="w-40 aspect-[4/5] bg-gray-100 overflow-hidden flex items-center justify-center border border-border/10">
                            <img id="profile_preview"
                                src="{{ $user->profile_photo ? Storage::disk('public')->url($user->profile_photo) : '' }}"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                alt="Profile Photo"
                                class="w-full h-full object-cover grayscale-[0.3] group-hover:grayscale-0 transition-all duration-500">

                            <div style="display:none" class="flex flex-col items-center justify-center w-full h-full bg-surface/50 text-muted">
                                <i class="fa-solid fa-user-plus text-2xl mb-2"></i>
                                <span class="text-[8px] uppercase tracking-tighter">Tambah Foto</span>
                            </div>
                        </div>

                        {{-- Handwritten Caption --}}
                        <div class="absolute bottom-2 left-0 right-0 text-center">
                            <span class="font-serif text-[10px] italic text-muted/60 tracking-wider">Self_Portrait.jpg</span>
                        </div>

                        {{-- Hover Overlay --}}
                        <div class="absolute inset-3 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-primary/20 backdrop-blur-[1px] z-30">
                            <div class="bg-surface px-3 py-1.5 rounded-full shadow-lg border border-primary/20">
                                <i class="fa-solid fa-pen-to-square text-primary text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Photo Meta (Margin Notes Style) --}}
                <div class="flex-1 space-y-4 pt-4">
                    <div class="bg-primary/5 border-l-2 border-primary p-4 rounded-r-lg">
                        <h4 class="text-[10px] font-bold uppercase tracking-widest text-primary mb-2">Ketentuan Gambar:</h4>
                        <ul class="space-y-1.5">
                            <li class="text-[10px] font-medium text-muted/80 flex items-center gap-2">
                                <i class="fa-solid fa-paperclip text-[8px] text-primary/40"></i> Format: JPG, PNG, WEBP
                            </li>
                            <li class="text-[10px] font-medium text-muted/80 flex items-center gap-2">
                                <i class="fa-solid fa-paperclip text-[8px] text-primary/40"></i> Ukuran Maks: 2 MB
                            </li>
                            <li class="text-[10px] font-medium text-muted/80 flex items-center gap-2">
                                <i class="fa-solid fa-paperclip text-[8px] text-primary/40"></i> Rasio: 4:5 (Portrait)
                            </li>
                        </ul>
                    </div>

                    @error('profile_photo')
                        <div class="text-[10px] font-bold text-red-500 flex items-center gap-2 bg-red-50 px-3 py-2 border-2 border-dashed border-red-200">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <input type="file" id="profile_photo_input" name="profile_photo" accept="image/jpg,image/jpeg,image/png,image/webp" class="hidden" onchange="previewPhoto(event)">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            {{-- Name Field --}}
            <div class="space-y-3 relative group">
                <label for="name" class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-muted group-focus-within:text-primary transition-colors">
                    <i class="fa-solid fa-signature text-[8px]"></i> Nama Alias
                </label>
                <div class="relative">
                    <i class="fa-solid fa-feather-pointed absolute left-0 top-1/2 -translate-y-1/2 text-muted/40 text-xs group-focus-within:text-primary transition-colors"></i>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus
                        class="w-full bg-transparent border-0 border-b-2 border-border px-6 py-2 font-serif text-base text-text focus:outline-none focus:border-primary focus:ring-0 transition-all" />
                </div>
                @error('name')
                    <p class="text-[10px] font-bold text-red-500 uppercase tracking-wider"><i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}</p>
                @enderror
            </div>

            {{-- Email Field --}}
            <div class="space-y-3 relative group">
                <label for="email" class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-muted group-focus-within:text-primary transition-colors">
                    <i class="fa-solid fa-envelope text-[8px]"></i> Titik Komunikasi
                </label>
                <div class="relative">
                    <i class="fa-solid fa-at absolute left-0 top-1/2 -translate-y-1/2 text-muted/40 text-xs group-focus-within:text-primary transition-colors"></i>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                        class="w-full bg-transparent border-0 border-b-2 border-border px-6 py-2 font-serif text-base text-text focus:outline-none focus:border-primary focus:ring-0 transition-all" />
                </div>
                @error('email')
                    <p class="text-[10px] font-bold text-red-500 uppercase tracking-wider"><i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Email Verification Alert --}}
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
            <div class="bg-[#fef9c3] border-2 border-dashed border-[#eab308]/40 p-6 rounded-xl space-y-3 relative overflow-hidden shadow-sm rotate-[-0.5deg]">
                <div class="flex items-center gap-2 text-[11px] font-bold text-yellow-700 uppercase tracking-widest">
                    <i class="fa-solid fa-thumbtack -rotate-45 text-red-500 mr-1"></i> Perhatian: Email Belum Terverifikasi
                </div>

                <p class="text-xs font-medium text-yellow-800/80 leading-relaxed italic">
                    Alamat email Anda belum terkonfirmasi dalam sistem. Beberapa fitur mungkin akan tertunda hingga verifikasi selesai.
                </p>

                <button type="submit" form="send-verification"
                    class="inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-yellow-800 hover:text-yellow-900 transition-colors border-2 border-yellow-800/20 hover:border-yellow-800/50 px-4 py-2 bg-white/50 rounded-lg">
                    Kirim Ulang Tautan Verifikasi <i class="fa-solid fa-paper-plane text-[8px]"></i>
                </button>

                @if (session('status') === 'verification-link-sent')
                    <p class="text-[10px] font-bold text-green-700 uppercase tracking-widest mt-3 flex items-center gap-1">
                        <i class="fa-solid fa-check-circle"></i> Tautan baru telah dikirimkan ke kotak masuk Anda.
                    </p>
                @endif
            </div>
        @endif

        {{-- Submit Actions --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 pt-8 border-t-2 border-dashed border-border/50">
            <button type="submit"
                class="group relative px-8 py-3 bg-container border-2 border-border text-text font-bold text-xs uppercase tracking-[0.2em] hover:border-primary hover:text-primary hover:-translate-y-1 transition-all shadow-[4px_4px_0px_var(--color-border)] active:shadow-none active:translate-y-0.5 rounded-lg flex items-center gap-3">
                <span>Simpan Profil</span>
                <i class="fa-solid fa-bookmark group-hover:scale-125 transition-transform"></i>
            </button>

            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms x-init="setTimeout(() => show = false, 3000)"
                    class="text-[10px] font-bold text-green-700 uppercase tracking-widest flex items-center gap-2 bg-green-50 px-4 py-2 border-2 border-green-200 rounded-full rotate-1 shadow-sm">
                    <i class="fa-solid fa-check-circle animate-pulse"></i> Sinkronisasi Berhasil
                </div>
            @endif
        </div>
    </form>
</section>

@push('scripts')
    <script>
        function previewPhoto(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                const preview = document.getElementById('profile_preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
                if(preview.nextElementSibling) preview.nextElementSibling.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    </script>
@endpush
