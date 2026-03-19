@extends('layouts.main')
@section('title', 'Login')
<style>
    .doodle-check {
        stroke-dasharray: 35;
        stroke-dashoffset: 35;
        transition: stroke-dashoffset 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    input:checked + div .doodle-check {
        stroke-dashoffset: 0;
    }
    input:checked + div svg {
        opacity: 1;
    }
</style>
@section('content')
<div class="min-h-screen flex items-center justify-center bg-bg relative px-4 font-serif mt-10">

    <div class="absolute inset-0 pointer-events-none opacity-[0.03]"
         style="background-image: radial-gradient(var(--color-text) 0.5px, transparent 0.5px); background-size: 12px 12px;">
    </div>

    <div class="w-full max-w-md bg-surface border border-border p-8 md:p-10 shadow-lg relative z-10 rotate-[-0.5deg] hover:rotate-0 transition-transform duration-300">

        <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-24 h-7 bg-warning/20 backdrop-blur-sm rotate-[2deg] shadow-sm pointer-events-none"></div>

        <i class="fa-solid fa-paperclip absolute top-6 -left-3 text-muted text-xl -rotate-12 opacity-60 pointer-events-none"></i>

        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold mb-2 text-text">Login</h1>
            <p class="text-sm font-sans text-muted" data-i18n="login.subtitle"></p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6 font-sans">
            @csrf

            <div>
                <label class="block text-xs font-bold mb-2 text-muted uppercase tracking-wider">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full px-3 py-2 bg-container border-b-2 border-border border-dashed
                              text-text placeholder:text-muted/50 text-sm
                              focus:outline-none focus:border-primary focus:bg-primary/5 transition-colors"
                       placeholder="email@example.com" required autofocus>

                @error('email')
                    <p class="mt-1 text-xs font-bold text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold mb-2 text-muted uppercase tracking-wider">Password</label>
                <input type="password" name="password"
                       class="w-full px-3 py-2 bg-container border-b-2 border-border border-dashed
                              text-text placeholder:text-muted/50 text-sm
                              focus:outline-none focus:border-primary focus:bg-primary/5 transition-colors"
                       placeholder="••••••••" required>

                @error('password')
                    <p class="mt-1 text-xs font-bold text-danger">{{ $message }}</p>
                @enderror
            </div>

            <label class="group relative flex items-center gap-3 cursor-pointer w-max select-none font-sans mt-2">
                <input type="checkbox" name="remember" class="peer sr-only">

                <div class="relative w-5 h-5 flex items-center justify-center text-muted border-2 border-current
                            rounded-[4px_8px_3px_6px/6px_3px_7px_3px] rotate-[-4deg]
                            peer-checked:text-primary peer-checked:rotate-[2deg]
                            transition-all duration-300 group-hover:scale-110">

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                        class="absolute w-7 h-7 -top-2 -right-1.5 drop-shadow-sm opacity-0 transition-opacity duration-150 delay-75">
                        <path d="M5 12 L10 17 L21 5" class="doodle-check" />
                    </svg>
                </div>

                <span class="text-sm font-medium text-muted peer-checked:text-text peer-checked:font-bold transition-all duration-300">
                    Ingat aku
                </span>
            </label>

            <div class="w-full mt-4" style="filter: drop-shadow(0px 4px 6px rgba(0,0,0,0.08));">
                <button type="submit"
                        class="relative flex items-center justify-center gap-3 w-full px-8 pt-4 pb-6 bg-warning text-yellow-900 font-serif font-bold text-center hover:-translate-y-1 transition-transform duration-300 group"
                        style="clip-path: polygon(0% 0%, 100% 0%, 100% 88%, 95% 100%, 89% 86%, 83% 98%, 78% 87%, 72% 100%, 66% 85%, 60% 98%, 54% 86%, 48% 100%, 42% 85%, 36% 97%, 30% 86%, 24% 100%, 18% 87%, 12% 98%, 6% 86%, 0% 96%);">

                    <div class="absolute top-1.5 left-0 w-full h-px bg-white/20 z-0"></div>

                    <span class="relative z-10 uppercase tracking-widest text-sm">Masuk</span>
                    <i class="fa-solid fa-arrow-right-to-bracket text-sm relative z-10 group-hover:translate-x-1.5 transition-transform"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
