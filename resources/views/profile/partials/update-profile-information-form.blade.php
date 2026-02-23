<section class="space-y-12">

    {{-- Header --}}
    <header class="space-y-4">
        <h2 class="text-xl font-semibold tracking-tight">
            Profile Information
        </h2>

        <p class="text-sm text-muted max-w-md">
            Update your personal details and email address associated with your account.
        </p>
    </header>

    {{-- Email Verification --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Form --}}
    <form method="post"
          action="{{ route('dashboard.account.update') }}"
          class="space-y-8 max-w-xl">
        @csrf
        @method('patch')

        {{-- Name --}}
        <div class="space-y-3">
            <label for="name" class="text-xs uppercase tracking-widest text-muted">
                Name
            </label>

            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="w-full border border-border bg-surface px-4 py-2 focus:outline-none focus:ring-1 focus:ring-primary"
            />

            @error('name')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="space-y-3">
            <label for="email" class="text-xs uppercase tracking-widest text-muted">
                Email
            </label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="w-full border border-border bg-surface px-4 py-2 focus:outline-none focus:ring-1 focus:ring-primary"
            />

            @error('email')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror

            {{-- Email not verified --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="border border-yellow-500/30 bg-yellow-500/5 p-5 text-sm space-y-3">
                    <p class="text-yellow-600">
                        Your email address is not verified.
                    </p>

                    <button
                        type="submit"
                        form="send-verification"
                        class="text-primary text-sm tracking-wide hover:underline"
                    >
                        Resend verification email →
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-green-500 font-medium">
                            Verification link sent successfully.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-6 pt-4">

            <button
                type="submit"
                class="px-6 py-2 border border-border text-sm hover:border-primary transition"
            >
                Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-500"
                >
                    Saved successfully ✓
                </p>
            @endif

        </div>
    </form>
</section>
