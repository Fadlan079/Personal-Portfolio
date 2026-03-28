@extends('layouts.dashboard')
@section('title', 'Buku Log Pengguna')

@section('content')
<div class="min-h-screen bg-[#fcfaf7] pt-12 pb-24 px-4 md:px-6 relative overflow-hidden">

    {{-- Diary Background Texture (Efek Kertas Serat) --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.03]"
         style="background-image: url('https://www.transparenttextures.com/patterns/paper-fibers.png');">
    </div>

    {{-- Decorative Side Binder (Kesan spiral atau jilidan buku di sisi kiri) --}}
    <div class="absolute left-0 top-0 bottom-0 w-2 md:w-4 bg-gradient-to-r from-border/20 to-transparent border-r border-border/10"></div>

    <section class="max-w-5xl mx-auto relative z-10">

        {{-- MAIN HEADER (Diary Title Style) --}}
        <header class="relative space-y-6 border-b-2 border-dashed border-border/40 pb-12 mt-4 md:mt-8 mb-16">

            {{-- Decorative Bookmark --}}
            <div class="absolute -top-12 right-8 w-12 h-24 bg-primary/20 backdrop-blur-sm rounded-b-lg border-x border-b border-primary/10 shadow-sm flex items-end justify-center pb-2">
                <i class="fa-solid fa-feather text-primary/40 text-xl"></i>
            </div>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-3 font-serif text-xs italic tracking-widest text-primary/70">
                    <i class="fa-solid fa-pen-nib"></i>
                    <span>Catatan Perjalanan / Pengaturan Akun</span>
                </div>

                <div class="flex items-center gap-2 font-sans text-[10px] uppercase tracking-[0.2em] text-muted bg-surface px-4 py-1.5 rounded-full border border-border/50 shadow-inner">
                    <span class="w-2 h-2 rounded-full bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.4)]"></span>
                    Sesi Aktif: <span class="text-text font-bold">Terautentikasi</span>
                </div>
            </div>

            <div class="relative inline-block pt-4">
                <h1 class="text-5xl md:text-7xl font-serif font-black tracking-tighter text-text leading-none">
                    Log_Identitas
                </h1>
                {{-- Handwritten Underline --}}
                <svg class="absolute -bottom-4 left-0 w-full h-4 text-primary/30" viewBox="0 0 300 20" preserveAspectRatio="none">
                    <path d="M0,10 Q75,20 150,10 T300,10" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                </svg>
            </div>

            <p class="text-base font-serif italic text-muted/80 tracking-wide mt-8 max-w-2xl leading-relaxed">
                <span class="text-primary font-bold not-italic">“</span>
                Halaman ini berisi catatan inti mengenai eksistensi Anda dalam sistem. Kelola identitas, kunci akses, dan integritas data pribadi Anda di sini.
            </p>
        </header>

        {{--
            MODULES CONTAINER
            Masing-masing modul (Partial) akan tampil seperti lembaran kertas yang ditumpuk.
        --}}
        <div class="space-y-20">

            {{-- 1. Profile Information Module --}}
            <div class="transform transition-all duration-700 animate-[journalEntry_0.6s_ease-out_both]">
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- 1.5 COMMUNICATION NODES --}}
            <div class="transform transition-all duration-700 animate-[journalEntry_0.6s_ease-out_0.1s_both]">
                @include('profile.partials.update-social-form')
            </div>

            {{-- 2. Update Password Module --}}
            <div class="transform transition-all duration-700 animate-[journalEntry_0.6s_ease-out_0.2s_both]">
                @include('profile.partials.update-password-form')
            </div>

            {{-- 3. Delete Account Module --}}
            <div class="transform transition-all duration-700 animate-[journalEntry_0.6s_ease-out_0.3s_both]">
                @include('profile.partials.delete-user-form')
            </div>

        </div>

        {{-- Footer Note --}}
        <footer class="mt-24 text-center">
            <div class="inline-flex items-center gap-3 text-muted/30 font-serif italic text-sm">
                <div class="h-[1px] w-12 bg-border/50"></div>
                Akhir dari Catatan Pengaturan
                <div class="h-[1px] w-12 bg-border/50"></div>
            </div>
        </footer>

    </section>
</div>

@push('head')
<style>
    /* Animasi seolah-olah halaman buku sedang dibuka/muncul */
    @keyframes journalEntry {
        from {
            opacity: 0;
            transform: translateY(30px) rotateX(-5deg);
        }
        to {
            opacity: 1;
            transform: translateY(0) rotateX(0);
        }
    }

    /* Kustomisasi scrollbar agar lebih halus dan masuk tema */
    ::-webkit-scrollbar {
        width: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #fcfaf7;
    }
    ::-webkit-scrollbar-thumb {
        background: var(--color-border);
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: var(--color-primary);
    }
</style>
@endpush

@endsection
