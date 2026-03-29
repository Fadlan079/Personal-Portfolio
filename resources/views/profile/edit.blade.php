@extends('layouts.dashboard')
@section('title', 'Account')

@push('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;600&family=Cormorant:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

<style>
    .bg-diary-texture {
        background-color: var{--color-bg};
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.04'/%3E%3C/svg%3E");
    }


    .diary-page {
        background-color: var{--color-container};
        background-image: repeating-linear-gradient(transparent, transparent 31px, rgba(0, 0, 0, 0.06) 31px, rgba(0, 0, 0, 0.06) 32px);
        background-position: 0 10px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 2px;
        box-shadow: 2px 4px 12px rgba(0,0,0,0.06), -1px 2px 4px rgba(0,0,0,0.03);
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 2rem 2rem;
        line-height: 32px;
    }

    .diary-page:hover {
        box-shadow: 5px 10px 20px rgba(0,0,0,0.08), -2px 5px 10px rgba(0,0,0,0.04);
        z-index: 10;
        position: relative;
    }

    .rotate-hover-right:hover { transform: rotate(1.5deg) scale(1.01); }
    .rotate-hover-left:hover { transform: rotate(-1.5deg) scale(1.01); }

    @keyframes journalEntry {
        from { opacity: 0; transform: translateY(30px) rotateX(-5deg); }
        to { opacity: 1; transform: translateY(0) rotateX(0); }
    }

    .font-cormorant { font-family: 'Cormorant', serif; }
    .font-caveat { font-family: 'Caveat', cursive; }
</style>
@endpush

@section('content')
<x-global-modal />
<div class="min-h-screen bg-diary-texture pt-12 pb-24 px-4 md:px-6 relative overflow-hidden text-[#2c2825]">
    <section class="max-w-5xl mx-auto relative z-10 font-cormorant">

        <header class="relative space-y-6 border-b-2 border-dashed border-border/50 pb-12 mt-4 md:mt-8 mb-16">

            <div class="space-y-6">
                <div class="relative inline-flex items-center gap-2 py-1.5 pl-8 pr-6 transition-all duration-300 w-max group hover:-translate-y-0.5 hover:rotate-1"
                    style="filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.06));">

                    <div class="absolute inset-0 bg-warning border border-yellow-500 rounded-l-md z-0 transition-colors"
                        style="clip-path: polygon(0 0, 100% 0, 92% 50%, 100% 100%, 0 100%);">
                    </div>

                    <div class="absolute top-1/2 -left-4 w-6 h-[1.5px] bg-[#8B0000]/80 -translate-y-[calc(50%+1px)] origin-right -rotate-12 group-hover:-rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>
                    <div class="absolute top-1/2 -left-3 w-5 h-[1.5px] bg-[#B22222]/80 -translate-y-[calc(50%-1px)] origin-right rotate-12 group-hover:rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>

                    <div class="absolute left-2.5 top-1/2 -translate-y-1/2 w-2.5 h-2.5 rounded-full bg-white shadow-[inset_1px_1px_3px_rgba(0,0,0,0.3)] border border-yellow-700/30 z-10"></div>

                    <i class="fa-solid fa-user-gear relative z-10 text-yellow-800 text-[11px] mt-px"></i>

                    <span class="relative z-10 text-[10px] sm:text-xs font-black tracking-[0.15em] uppercase text-yellow-900 mt-px">
                        Manajemen Profil
                    </span>
                </div>

                <h1 class="text-5xl md:text-7xl font-bold tracking-tighter text-text leading-none">
                    Pengaturan Akun
                </h1>
            </div>

            <p class="text-lg italic text-muted tracking-wide mt-10 max-w-2xl leading-relaxed font-caveat text-2xl">
                Kelola identitas diri, kunci akses, dan informasi publik Anda di lembar catatan ini. Pastikan semua data akurat dan aman.
            </p>
        </header>

        <div class="space-y-16">

            <div class="diary-page rotate-hover-right animate-[journalEntry_0.6s_ease-out_both]">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="diary-page rotate-hover-left animate-[journalEntry_0.6s_ease-out_0.1s_both]">
                @include('profile.partials.update-social-form')
            </div>

            <div class="diary-page rotate-hover-right animate-[journalEntry_0.6s_ease-out_0.2s_both]">
                @include('profile.partials.update-password-form')
            </div>
            <div class="diary-page rotate-hover-left animate-[journalEntry_0.6s_ease-out_0.3s_both]">
                @include('profile.partials.delete-user-form')
            </div>

        </div>

    </section>
</div>
@endsection
