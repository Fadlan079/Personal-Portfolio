<section class="space-y-12 border-t border-border pt-12">

    {{-- Header --}}
    <header class="space-y-4">
        <h2 class="text-xl font-semibold tracking-tight">
            Update Password
        </h2>

        <p class="text-sm text-muted max-w-md">
            Use a strong and unique password to keep your account secure.
        </p>
    </header>

    {{-- Form --}}
    <form method="post"
          action="{{ route('password.update') }}"
          class="space-y-8 max-w-xl">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div class="space-y-3">
            <label for="update_password_current_password"
                   class="text-xs uppercase tracking-widest text-muted">
                Current Password
            </label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="w-full border border-border bg-surface px-4 py-2 focus:outline-none focus:ring-1 focus:ring-primary"
            />

            @error('current_password', 'updatePassword')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- New Password --}}
        <div class="space-y-3">
            <label for="update_password_password"
                   class="text-xs uppercase tracking-widest text-muted">
                New Password
            </label>

            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="w-full border border-border bg-surface px-4 py-2 focus:outline-none focus:ring-1 focus:ring-primary"
            />

            @error('password', 'updatePassword')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="space-y-3">
            <label for="update_password_password_confirmation"
                   class="text-xs uppercase tracking-widest text-muted">
                Confirm Password
            </label>

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="w-full border border-border bg-surface px-4 py-2 focus:outline-none focus:ring-1 focus:ring-primary"
            />

            @error('password_confirmation', 'updatePassword')
                <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-6 pt-4">

            <button
                type="submit"
                class="px-6 py-2 border border-border text-sm hover:border-primary transition"
            >
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-500"
                >
                    Password updated ✓
                </p>
            @endif

        </div>
    </form>
</section>
