@php use Illuminate\Support\Facades\Storage; @endphp

<section class="relative border border-border/50 bg-surface/20 p-6 md:p-10 overflow-hidden">
    
    {{-- Background Tech Grid --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.03]" 
         style="background-image: linear-gradient(var(--color-text) 1px, transparent 1px), linear-gradient(90deg, var(--color-text) 1px, transparent 1px); background-size: 24px 24px;">
    </div>

    {{-- Corner Accents --}}
    <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-primary/50"></div>
    <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-primary/50"></div>
    <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-primary/50"></div>
    <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-primary/50"></div>

    {{-- Header --}}
    <header class="relative z-10 space-y-2 border-b border-border/50 pb-6 mb-8">
        <div class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-widest text-primary">
            <span class="w-1.5 h-1.5 bg-primary animate-pulse shadow-[0_0_8px_var(--color-primary)]"></span>
            >> IDENTITY_MODULE
        </div>
        <h2 class="text-2xl md:text-3xl font-bold font-mono tracking-tighter uppercase text-text">
            Profile Registry
        </h2>
        <p class="text-xs font-mono text-muted tracking-wide">
            Update your core user parameters and visual identification matrix.
        </p>
    </header>

    {{-- Email Verification Hidden Form --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Main Form --}}
    <form method="post" action="{{ route('dashboard.account.update') }}" enctype="multipart/form-data"
        class="relative z-10 space-y-10 max-w-2xl">
        @csrf
        @method('patch')

        {{-- Profile Photo Upload --}}
        <div class="space-y-4">
            <label class="flex items-center gap-2 text-[10px] font-mono uppercase tracking-widest text-muted">
                <span class="text-primary">></span> PARAM_00: VISUAL_ID
            </label>

            <div class="flex flex-col sm:flex-row items-start gap-6">
                {{-- Styled Preview Container --}}
                <div class="relative group w-40 cursor-pointer" onclick="document.getElementById('profile_photo_input').click()">
                    
                    {{-- HUD Target Corners --}}
                    <div class="absolute -top-2 -left-2 w-3 h-3 border-t border-l border-primary z-20 transition-all duration-300 group-hover:-top-3 group-hover:-left-3"></div>
                    <div class="absolute -bottom-2 -right-2 w-3 h-3 border-b border-r border-primary z-20 transition-all duration-300 group-hover:-bottom-3 group-hover:-right-3"></div>
                    
                    {{-- ID Label --}}
                    <div class="absolute top-2 -left-6 text-[8px] font-mono text-primary rotate-90 tracking-[0.2em] uppercase origin-bottom-left z-20">
                        FIG.01_USER
                    </div>

                    {{-- Image Box --}}
                    <div class="relative z-10 aspect-[4/5] bg-background border border-border/70 overflow-hidden flex items-center justify-center filter grayscale group-hover:grayscale-0 transition-all duration-500">
                        <img id="profile_preview"
                            src="{{ $user->profile_photo ? Storage::disk('public')->url($user->profile_photo) : asset('profile.jpg') }}"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                            alt="Profile Photo"
                            class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-500">

                        <div style="display:none" class="flex flex-col items-center justify-center w-full h-full font-mono bg-background">
                            <svg class="w-12 h-12 text-primary/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text-[8px] uppercase tracking-widest text-muted">Awaiting_Source</span>
                        </div>

                        {{-- CRT Scanline Overlay --}}
                        <div class="absolute inset-0 z-20 pointer-events-none opacity-20" 
                            style="background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.25) 50%), linear-gradient(90deg, rgba(255, 0, 0, 0.06), rgba(0, 255, 0, 0.02), rgba(0, 0, 255, 0.06)); background-size: 100% 4px, 6px 100%;">
                        </div>

                        {{-- Hover Upload State --}}
                        <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-[#0a0a0a]/70 z-30 backdrop-blur-[2px]">
                            <i class="fa-solid fa-cloud-arrow-up text-primary text-xl mb-2"></i>
                            <span class="text-[9px] font-mono uppercase tracking-widest text-white border border-primary/50 px-2 py-1 bg-primary/20">Init_Upload</span>
                        </div>
                    </div>
                </div>

                {{-- Image Meta Info --}}
                <div class="space-y-2 mt-2">
                    <p class="text-[10px] font-mono text-muted uppercase tracking-widest">
                        Allowed_Formats: <span class="text-text">JPG, PNG, WEBP</span>
                    </p>
                    <p class="text-[10px] font-mono text-muted uppercase tracking-widest">
                        Max_Size: <span class="text-text">2.048 MB</span>
                    </p>
                    <p class="text-[10px] font-mono text-muted uppercase tracking-widest">
                        Aspect_Ratio: <span class="text-text">4:5 (Portrait)</span>
                    </p>

                    @error('profile_photo')
                        <div class="mt-4 text-[10px] font-mono text-red-500 flex items-center gap-2 bg-red-500/10 px-3 py-2 border border-red-500/30 w-max">
                            <i class="fa-solid fa-xmark"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <input type="file" id="profile_photo_input" name="profile_photo" accept="image/jpg,image/jpeg,image/png,image/webp" class="hidden" onchange="previewPhoto(event)">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Name Field --}}
            <div class="space-y-3 relative group">
                <label for="name" class="flex items-center gap-2 text-[10px] font-mono uppercase tracking-widest text-muted group-focus-within:text-primary transition-colors">
                    <span class="text-primary">></span> PARAM_01: ALIAS
                </label>
                <div class="relative">
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                        class="w-full bg-surface/30 border border-border/70 px-4 py-3 font-mono text-sm text-text focus:outline-none focus:border-primary focus:bg-primary/5 transition-colors placeholder:text-muted/50" />
                    {{-- Decorative Blinking Block inside input --}}
                    <div class="absolute right-3 top-1/2 -translate-y-1/2 w-1.5 h-4 bg-primary/30 group-focus-within:bg-primary group-focus-within:animate-pulse pointer-events-none"></div>
                </div>
                @error('name')
                    <p class="text-[10px] font-mono text-red-500 uppercase tracking-wider"><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $message }}</p>
                @enderror
            </div>

            {{-- Email Field --}}
            <div class="space-y-3 relative group">
                <label for="email" class="flex items-center gap-2 text-[10px] font-mono uppercase tracking-widest text-muted group-focus-within:text-primary transition-colors">
                    <span class="text-primary">></span> PARAM_02: COM_NODE
                </label>
                <div class="relative">
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                        class="w-full bg-surface/30 border border-border/70 px-4 py-3 font-mono text-sm text-text focus:outline-none focus:border-primary focus:bg-primary/5 transition-colors placeholder:text-muted/50" />
                    <div class="absolute right-3 top-1/2 -translate-y-1/2 w-1.5 h-4 bg-primary/30 group-focus-within:bg-primary group-focus-within:animate-pulse pointer-events-none"></div>
                </div>
                @error('email')
                    <p class="text-[10px] font-mono text-red-500 uppercase tracking-wider"><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Email Verification Alert --}}
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
            <div class="border-l-2 border-yellow-500 bg-yellow-500/10 p-5 space-y-3 relative overflow-hidden">
                {{-- Glitch background --}}
                <div class="absolute top-0 right-0 w-16 h-full bg-[repeating-linear-gradient(45deg,transparent,transparent_2px,rgba(234,179,8,0.1)_2px,rgba(234,179,8,0.1)_4px)]"></div>
                
                <div class="flex items-center gap-2 text-[11px] font-mono font-bold text-yellow-500 uppercase tracking-widest">
                    <i class="fa-solid fa-triangle-exclamation animate-pulse"></i> SYS_WARNING: UNVERIFIED_NODE
                </div>
                
                <p class="text-xs font-mono text-muted/90">
                    Your communication node (Email) lacks secure verification. Features may be restricted.
                </p>
                
                <button type="submit" form="send-verification" class="inline-flex items-center gap-2 text-[10px] font-mono uppercase tracking-widest text-yellow-500 hover:text-yellow-400 transition-colors border border-yellow-500/30 hover:border-yellow-500 px-3 py-1.5 bg-yellow-500/5">
                    [ RESEND_AUTH_PACKET ] <i class="fa-solid fa-arrow-right-long"></i>
                </button>

                @if (session('status') === 'verification-link-sent')
                    <p class="text-[10px] font-mono text-green-500 uppercase tracking-widest mt-2">
                        > PACKET_SENT_SUCCESSFULLY. AWAITING_CONFIRMATION.
                    </p>
                @endif
            </div>
        @endif

        {{-- Submit Actions --}}
        <div class="flex items-center gap-6 pt-6 border-t border-border/50">
            <button type="submit" class="group relative px-6 py-3 bg-primary/5 border border-primary text-primary font-mono text-xs font-bold uppercase tracking-widest hover:bg-primary hover:text-background transition-colors flex items-center gap-3">
                <span>[ OVERRIDE_DATA ]</span>
                <i class="fa-solid fa-terminal group-hover:animate-pulse"></i>
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms x-init="setTimeout(() => show = false, 3000)"
                    class="text-[10px] font-mono text-primary uppercase tracking-widest flex items-center gap-2 bg-primary/10 px-3 py-1.5 border border-primary/30">
                    <i class="fa-solid fa-check"></i> SYNC_COMPLETE
                </p>
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
                document.getElementById('profile_preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    </script>
@endpush