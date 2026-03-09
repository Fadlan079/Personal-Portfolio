@extends('layouts.dashboard')
@section('title', 'Account')

@section('content')
<div class="min-h-screen bg-background pt-12 pb-24 px-4 md:px-6 relative overflow-hidden">

    {{-- Global Faint Grid (Menyatukan semua modul di atas satu blueprint) --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.02]"
         style="background-image: linear-gradient(var(--color-text) 1px, transparent 1px), linear-gradient(90deg, var(--color-text) 1px, transparent 1px); background-size: 64px 64px;">
    </div>

    <section class="max-w-5xl mx-auto relative z-10">

        {{-- MAIN HEADER --}}
        <header class="relative space-y-4 border-b border-border/50 pb-8 mt-4 md:mt-8 mb-12">
            
            {{-- Decorative Top Line --}}
            <div class="absolute top-0 right-0 w-1/3 h-[1px] bg-gradient-to-r from-transparent to-primary/50 pointer-events-none"></div>

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-widest text-primary">
                    <i class="fa-solid fa-folder-tree"></i>
                    SYS_DIR / DASHBOARD / ACCOUNT_CFG
                </div>
                <div class="hidden sm:flex items-center gap-2 font-mono text-[10px] uppercase tracking-widest text-muted border border-border/50 px-3 py-1 bg-surface/30">
                    STATUS: <span class="text-green-500 font-bold flex items-center gap-1.5"><div class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></div> SECURE_CONN</span>
                </div>
            </div>

            <div class="flex items-end gap-3 pt-2">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-mono tracking-tighter uppercase text-text leading-none">
                    User_Registry
                </h1>
                {{-- Master Blinking Cursor --}}
                <div class="w-3 md:w-4 h-8 md:h-12 bg-primary animate-pulse mb-1 shadow-[0_0_10px_var(--color-primary)]"></div>
            </div>

            <p class="text-sm font-mono text-muted tracking-wide mt-4 max-w-2xl leading-relaxed">
                <span class="text-primary">></span> Initialize configuration modules. Manage identity parameters, cryptographic keys, and eradication protocols.
            </p>
        </header>

        {{-- 
            MODULES CONTAINER
            Catatan: Class border, padding, dan background dihapus dari sini 
            karena sudah tertanam langsung di dalam desain masing-masing file partial! 
        --}}
        <div class="space-y-12">
            
            {{-- 1. Profile Information Module --}}
            <div class="transform origin-top transition-all duration-500 animate-[fadeIn_0.5s_ease-out]">
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- 1.5 COMMUNICATION NODES (Medsos & WA) --}}
            <div class="transform origin-top transition-all duration-500 animate-[fadeIn_0.5s_ease-out_0.1s_both]">
                @include('profile.partials.update-social-form')
            </div>

            {{-- 2. Update Password Module --}}
            <div class="transform origin-top transition-all duration-500 animate-[fadeIn_0.5s_ease-out_0.2s_both]">
                @include('profile.partials.update-password-form')
            </div>

            {{-- 3. Delete Account Module --}}
            <div class="transform origin-top transition-all duration-500 animate-[fadeIn_0.5s_ease-out_0.3s_both]">
                @include('profile.partials.delete-user-form')
            </div>

        </div>

    </section>
</div>

{{-- Tambahkan animasi masuk (fade-in slide) jika belum ada di CSS global kamu --}}
@push('head')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@endsection