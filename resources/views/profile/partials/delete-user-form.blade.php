<section class="space-y-10 border-t border-border pt-10">

    {{-- Header --}}
    <header class="space-y-3 max-w-xl">
        <h2 class="text-xl font-semibold tracking-tight">
            Delete Account
        </h2>

        <p class="text-sm text-muted">
            Once your account is deleted, all of its resources and data will be permanently deleted.
            Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    {{-- Trigger --}}
    <div>
        <button
            x-data
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="px-6 py-2 border border-red-500 text-red-500 text-sm tracking-wide hover:bg-red-500/5 transition"
        >
            Delete Account
        </button>
    </div>

    {{-- Modal --}}
    <div
        x-data="{ show: false }"
        x-on:open-modal.window="if ($event.detail === 'confirm-user-deletion') show = true"
        x-on:close.window="show = false"
        x-show="show"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
    >

        <div class="w-full max-w-lg bg-surface border border-border p-8 space-y-6">

            <form method="post" action="{{ route('dashboard.account.destroy') }}" class="space-y-6">
                @csrf
                @method('delete')

                <div class="space-y-3">
                    <h2 class="text-lg font-semibold">
                        Are you sure you want to delete your account?
                    </h2>

                    <p class="text-sm text-muted">
                        Once your account is deleted, all of its resources and data will be permanently deleted.
                        Please enter your password to confirm.
                    </p>
                </div>

                {{-- Password --}}
                <div class="space-y-2">
                    <label for="password" class="text-xs uppercase tracking-widest text-muted">
                        Password
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="w-full border border-border bg-surface px-4 py-2 focus:outline-none focus:ring-1 focus:ring-red-500"
                        placeholder="Enter your password"
                    />

                    @error('password', 'userDeletion')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-4 pt-4">

                    <button
                        type="button"
                        x-on:click="$dispatch('close')"
                        class="px-5 py-2 border border-border text-sm hover:border-primary transition"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="px-5 py-2 border border-red-500 text-red-500 text-sm hover:bg-red-500/5 transition"
                    >
                        Delete Account
                    </button>

                </div>
            </form>

        </div>
    </div>
</section>
