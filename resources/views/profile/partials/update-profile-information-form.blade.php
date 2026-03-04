@php use Illuminate\Support\Facades\Storage; @endphp
<section class="space-y-12">

    {{-- Header --}}
    <header class="space-y-4">
        <h2 class="text-xl font-semibold tracking-tight">
            Profile Information
        </h2>
        <p class="text-sm text-muted max-w-md">
            Update your personal details, email address, and profile photo.
        </p>
    </header>

    {{-- Email Verification --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Form --}}
    <form method="post" action="{{ route('dashboard.account.update') }}" enctype="multipart/form-data"
        class="space-y-10 max-w-xl">
        @csrf
        @method('patch')

        {{-- Profile Photo --}}
        <div class="space-y-4">
            <label class="text-xs uppercase tracking-widest text-muted">Photo Profile</label>

            {{-- Styled Preview (sama desainnya dengan home page) --}}
            <div class="relative group w-48 cursor-pointer"
                onclick="document.getElementById('profile_photo_input').click()">

                {{-- Corner decorations --}}
                <div class="absolute -top-3 -left-3 w-3 h-3 border-t-2 border-l-2 border-primary z-20"></div>
                <div class="absolute -bottom-3 -right-3 w-3 h-3 border-b-2 border-r-2 border-primary z-20"></div>
                <div
                    class="absolute -inset-3 border border-border/50 z-0 transition-transform duration-500 group-hover:scale-[1.02]">
                </div>

                {{-- Fig label --}}
                <div
                    class="absolute top-3 -left-7 text-[9px] font-mono text-muted rotate-90 tracking-widest uppercase origin-bottom-left z-20">
                    Fig. 01 — Lead Dev
                </div>

                {{-- Photo box --}}
                <div
                    class="relative z-10 aspect-[4/5] bg-surface border border-border overflow-hidden
                            flex items-center justify-center
                            filter grayscale group-hover:grayscale-0
                            transition-all duration-700">

                    <img id="profile_preview"
                        src="{{ $user->profile_photo ? Storage::disk('public')->url($user->profile_photo) : asset('profile.jpg') }}"
                        alt="Profile Photo"
                        class="w-4/5 h-4/5 object-contain mx-auto my-auto
                                opacity-80 group-hover:opacity-100
                                transition-all duration-500">

                    {{-- Scanline overlay --}}
                    <div
                        class="absolute inset-0 bg-[linear-gradient(transparent_50%,rgba(0,0,0,0.1)_50%)] bg-[length:100%_4px] pointer-events-none">
                    </div>

                    {{-- Hover hint --}}
                    <div
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/30 z-10">
                        <span class="text-[10px] font-mono uppercase tracking-widest text-white">Click to change</span>
                    </div>
                </div>
            </div>

            {{-- Hidden file input --}}
            <input type="file" id="profile_photo_input" name="profile_photo"
                accept="image/jpg,image/jpeg,image/png,image/webp" class="hidden" onchange="previewPhoto(event)">

            <p class="text-[10px] text-muted tracking-wide">JPG, PNG, or WEBP · Max 2MB</p>

            @error('profile_photo')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Name --}}
        <div class="space-y-3">
            <label for="name" class="text-xs uppercase tracking-widest text-muted">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                autofocus autocomplete="name"
                class="w-full border border-border bg-surface px-4 py-2 focus:outline-none focus:ring-1 focus:ring-primary" />
            @error('name')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="space-y-3">
            <label for="email" class="text-xs uppercase tracking-widest text-muted">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                autocomplete="username"
                class="w-full border border-border bg-surface px-4 py-2 focus:outline-none focus:ring-1 focus:ring-primary" />
            @error('email')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="border border-yellow-500/30 bg-yellow-500/5 p-5 text-sm space-y-3">
                    <p class="text-yellow-600">Your email address is not verified.</p>
                    <button type="submit" form="send-verification"
                        class="text-primary text-sm tracking-wide hover:underline">
                        Resend verification email →
                    </button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="text-green-500 font-medium">Verification link sent successfully.</p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="px-6 py-2 border border-border text-sm hover:border-primary transition">
                Save Changes
            </button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-500">
                    Saved successfully ✓
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
