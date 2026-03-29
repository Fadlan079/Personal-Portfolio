@extends('layouts.main')
@section('title', 'About Me')

<style>
    .bg-journal {
        background-color: var(--color-bg);
        position: relative;
    }

    .bg-journal::before {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;

        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.15'/%3E%3C/svg%3E");
    }

    .bg-journal {
        background-color: var(--color-bg);
        box-shadow: inset 0 0 80px rgba(0,0,0,0.05);
    }
    .diary-paper {
        background-color: var(--color-surface);
        border: 1px solid var(--color-border);
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.05);
        border-radius: 1.5rem;
    }
    .washi-tape {
        position: absolute;
        width: 80px;
        height: 25px;
        background-color: color-mix(in srgb, var(--color-surface) 60%, transparent);
        backdrop-filter: blur(4px);
        border: 1px solid color-mix(in srgb, var(--color-border) 40%, transparent);
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        z-index: 20;
    }
</style>

@section('content')
    <div class="bg-journal min-h-screen font-sans text-text pb-20 selection:bg-muted/30">

    <section id="about-teaser" class="py-30 px-5 max-w-6xl mx-auto relative z-10">

        <div class="relative inline-flex items-center gap-2.5 py-2 pl-9 pr-7 mb-6 transition-all duration-300 w-max group hover:-translate-y-0.5 hover:rotate-1"
            style="filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.06));">

            <div class="absolute inset-0 bg-warning border border-yellow-500 rounded-l-md z-0 transition-colors"
                style="clip-path: polygon(0 0, 100% 0, 93% 50%, 100% 100%, 0 100%);">
            </div>

            <div class="absolute top-1/2 -left-5 w-7 h-[1.5px] bg-[#8B0000]/80 -translate-y-[calc(50%+1px)] origin-right -rotate-12 group-hover:-rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>
            <div class="absolute top-1/2 -left-4 w-6 h-[1.5px] bg-[#B22222]/80 -translate-y-[calc(50%-1px)] origin-right rotate-12 group-hover:rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>

            <div class="absolute left-3 top-1/2 -translate-y-1/2 w-3 h-3 rounded-full bg-surface shadow-[inset_1px_1px_3px_rgba(0,0,0,0.3)] border border-yellow-700/30 z-10"></div>

            <i class="fa-regular fa-user relative z-10 text-yellow-800 text-xs mt-px group-hover:translate-x-0.5 transition-transform duration-300"></i>

            <span class="relative z-10 text-[10px] sm:text-[11px] font-black tracking-[0.15em] uppercase text-yellow-900 mt-px"
            data-i18n="about.teaser.label">
               Profil Saya
            </span>
        </div>

        <div class="relative bg-surface rounded-lg shadow-[0_15px_40px_-15px_rgba(0,0,0,0.1)] border border-border p-8 md:p-14 lg:p-20 flex flex-col md:flex-row gap-12 lg:gap-16 items-center overflow-hidden">

            <div class="absolute inset-0 pointer-events-none opacity-[0.03]" style="background-image: radial-gradient(var(--color-text) 1px, transparent 1px); background-size: 20px 20px;"></div>

            <div class="absolute top-0 bottom-0 left-0 w-10 bg-container border-r border-border/50 flex flex-col justify-center gap-16 items-center py-10 shadow-inner">
                <div class="w-4 h-4 rounded-full bg-bg shadow-inner border border-border/70"></div>
                <div class="w-4 h-4 rounded-full bg-bg shadow-inner border border-border/70"></div>
                <div class="w-4 h-4 rounded-full bg-bg shadow-inner border border-border/70"></div>
                <div class="w-4 h-4 rounded-full bg-bg shadow-inner border border-border/70"></div>
            </div>

            <div class="w-full md:w-3/5 pl-6 sm:pl-10 relative z-10">

                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight mb-6 text-text leading-[1.1]">
                    <span data-i18n="about.title">Tentang Saya</span><br/>
                    <span class="text-muted font-medium italic font-serif" data-i18n="about.subtitle">Latar belakang</span>
                </h2>

                <p class="text-base md:text-lg text-muted leading-relaxed mb-8 font-medium" data-i18n="about.description">
                    Saya adalah siswa SMK TI Airlangga generasi ke-24 yang berfokus pada pengembangan web full-stack.
                    Saat ini saya sedang mempelajari Laravel dan Vue, serta senang mengeksplorasi berbagai teknologi baru untuk mengembangkan kemampuan saya.
                </p>

                <div class="flex flex-wrap gap-3 mb-10">
                    <span class="px-3 py-1.5 bg-bg text-muted border border-border text-[10px] font-bold uppercase tracking-widest shadow-sm rotate-1">
                        <i class="fa-solid fa-location-dot text-primary mr-1"></i> Indonesia
                    </span>
                    <span class="px-3 py-1.5 bg-bg text-muted border border-border text-[10px] font-bold uppercase tracking-widest shadow-sm -rotate-1">
                        <i class="fa-solid fa-code text-primary mr-1"></i> Aplikasi Web
                    </span>
                    <span class="px-3 py-1.5 bg-success/10 text-success border border-success/20 text-[10px] font-bold uppercase tracking-widest shadow-sm rotate-1 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-success animate-pulse"></span> Tersedia
                    </span>
                </div>
            </div>

            <div class="hidden w-full md:w-2/5 md:flex justify-center relative z-10 mt-8 md:mt-0">

                <div class="relative bg-white p-3 pb-16 shadow-[0_15px_30px_-5px_rgba(0,0,0,0.15)] border border-border/50 w-64 sm:w-72 transform rotate-3 hover:rotate-0 transition-transform duration-500">

                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-20 h-6 bg-surface/80 border border-border/50 shadow-sm backdrop-blur-md -rotate-2 z-20"></div>

                    <div class="aspect-[4/5] overflow-hidden bg-container border border-border/50 relative">
                        <div class="absolute inset-0 opacity-[0.03] pointer-events-none z-10" style="background-image: radial-gradient(#000 0.5px, transparent 0.5px); background-size: 6px 6px;"></div>

                        <img src="{{ $profilePhoto }}" alt="Foto Fadlan"
                            onerror="this.style.display='none'; document.getElementById('fallback-profile').style.display='flex';"
                            class="w-full h-full object-cover grayscale-[0.3] hover:grayscale-0 transition-all duration-700">

                        <div id="fallback-profile" style="display:none;" class="flex-col items-center justify-center w-full h-full text-muted p-4 text-center bg-surface">
                            <i class="fa-regular fa-image text-3xl opacity-30 mb-2"></i>
                            <span class="text-[9px] uppercase tracking-widest font-bold" data-i18n="about.photo_placeholder">Kliping Kosong</span>
                        </div>
                    </div>

                    <div class="absolute -bottom-3 right-3 rotate-[-6deg]">
                        <div class="bg-warning text-yellow-900 px-3 py-1 text-[10px] font-black uppercase tracking-widest shadow-md border-l-4 border-yellow-500 whitespace-nowrap w-max"
                        data-i18n="about.author_label">
                            Profil Penulis
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="w-full md:w-2/5 flex justify-center md:justify-end mt-22 md:mt-0 relative z-10  md:hidden -translate-y-8">

            <div class="absolute inset-0 bg-[repeating-linear-gradient(45deg,transparent,transparent_10px,var(--color-border)_10px,var(--color-border)_11px)] opacity-20 -z-10 rounded-[2rem] transform translate-x-4 translate-y-4"></div>

            <div class="relative w-80 h-80 sm:w-80 sm:h-80 lg:w-96 lg:h-96 bg-surface shadow-2xl border border-border p-3 transform md:rotate-3 hover:rotate-0 transition-transform duration-500">

                <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-16 h-8 bg-surface/80 backdrop-blur-sm border border-border/50 shadow-sm rotate-[-4deg] z-20"></div>

                <div class="w-full h-full relative overflow-hidden bg-container border border-border/50">
                    <div class="absolute inset-0 opacity-[0.03] pointer-events-none z-10" style="background-image: radial-gradient(var(--color-text) 1px, transparent 1px); background-size: 8px 8px;"></div>

                    <img src="{{ $profilePhoto }}"
                    alt="Fadlan Photo"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                    class="w-full h-full object-cover grayscale-[0.4] hover:grayscale-0 transition-all duration-700">

                    <div style="display:none;" class="flex-col items-center justify-center w-full h-full text-muted p-4 text-center bg-surface">
                        <i class="fa-regular fa-image text-3xl opacity-30 mb-2"></i>
                        <span class="text-[9px] uppercase tracking-widest font-bold" data-i18n="about.photo_placeholder">Kliping Kosong</span>
                    </div>
                </div>

                <div class="absolute -bottom-3 right-3 rotate-[-6deg]">
                    <div class="bg-warning text-yellow-900 px-3 py-1 text-[10px] font-black uppercase tracking-widest shadow-md border-l-4 border-yellow-500 whitespace-nowrap w-max" data-i18n="about.author_label">
                        Author Profile
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-5 md:px-8 py-20 border-t border-dashed border-border/70 relative z-10">

        <div class="text-center mb-16 relative">
            <h3 class="text-3xl md:text-5xl font-serif font-bold tracking-tight text-text mb-4">
                Perjalanan Karir
            </h3>
            <p class="text-muted font-medium italic font-serif">
                Proses yang membentuk pemahaman dan pengalaman saya.
            </p>
            <svg class="absolute left-1/2 -translate-x-1/2 -bottom-6 w-32 h-auto text-border opacity-70" viewBox="0 0 100 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M5,10 Q25,20 50,10 T95,10" />
            </svg>
        </div>

        <div class="relative flex flex-col gap-12 md:gap-24 mt-10">

            <div class="relative w-full md:w-3/4 mx-auto transform md:-rotate-1 hover:rotate-0 transition-transform duration-500">
                <div class="washi-tape -top-3 left-1/2 -translate-x-1/2 rotate-2 z-20"></div>

                <div class="diary-paper p-8 md:p-10 relative overflow-hidden group">
                    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: linear-gradient(var(--color-text) 1px, transparent 1px), linear-gradient(90deg, var(--color-text) 1px, transparent 1px); background-size: 20px 20px;"></div>

                    <div class="flex flex-col md:flex-row gap-6 relative z-10">
                        <div class="md:w-1/4 border-b-2 md:border-b-0 md:border-r-2 border-dashed border-border/50 pb-4 md:pb-0 md:pr-6 flex flex-col justify-center">
                            <span class="font-serif text-2xl font-bold text-text">2024 - Sekarang</span>
                            <span class="text-xs font-bold uppercase tracking-widest text-primary mt-1">Langkah Awal</span>
                        </div>
                        <div class="md:w-3/4">
                            <h4 class="text-xl font-bold text-text mb-1">SMKTI AirLangga</h4>
                            <p class="text-[10px] font-bold text-primary/70 uppercase tracking-[0.2em] mb-4 italic" data-i18n="roadmap.school.major">
                                Pengembangan Perangkat Lunak dan Gim (PPLG)
                            </p>
                            <p class="text-muted font-medium leading-relaxed mb-4">
                                Saya memulai dari dasar pemrograman dan struktur website, lalu berkembang membangun aplikasi dengan PHP Native, MySQL, dan konsep MVC, OOP, serta CRUD, hingga berlanjut ke Laravel dan diperkuat melalui ekstrakurikuler pengembangan web.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="absolute -right-4 md:-right-10 -bottom-6 bg-warning text-yellow-900 p-4 shadow-[2px_4px_10px_rgba(0,0,0,0.1)] rotate-6 z-20 w-32 border border-yellow-500/30">
                    <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-10 h-4 bg-white/40 backdrop-blur-sm border border-black/5 shadow-sm rotate-[-4deg]"></div>
                    <p class="text-xs font-bold text-center leading-tight">First "Hello World!"</p>
                </div>
            </div>

        {{-- <div class="relative w-full md:w-3/4 mx-auto transform rotate-2 hover:rotate-0 transition-transform duration-500 md:translate-x-10">
                <div class="washi-tape -top-4 left-10 rotate-[-3deg] z-20 w-24"></div>
                <div class="washi-tape -bottom-4 right-10 rotate-[4deg] z-20 w-16"></div>

                <div class="diary-paper p-8 md:p-10 relative bg-container/50">
                    <div class="flex flex-col md:flex-row gap-6 relative z-10">
                        <div class="md:w-1/4 border-b-2 md:border-b-0 md:border-r-2 border-dashed border-border/50 pb-4 md:pb-0 md:pr-6 flex flex-col justify-center">
                            <span class="font-serif text-2xl font-bold text-text">Saat Ini</span>
                            <span class="text-xs font-bold uppercase tracking-widest text-success mt-1 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-success animate-pulse"></span> Eksplorasi
                            </span>
                        </div>
                        <div class="md:w-3/4">
                            <h4 class="text-xl font-bold text-text mb-3">Memperdalam Framework</h4>
                            <p class="text-muted font-medium leading-relaxed mb-4">
                                Fokus mengembangkan keterampilan pengembangan full-stack. Saat ini sedang mendalami arsitektur Laravel untuk backend dan reaktivitas Vue.js untuk antarmuka pengguna.
                            </p>
                            <div class="flex gap-2">
                                <span class="px-2 py-1 bg-surface border border-border text-[10px] font-bold text-primary rounded-sm shadow-sm">Laravel</span>
                                <span class="px-2 py-1 bg-surface border border-border text-[10px] font-bold text-primary rounded-sm shadow-sm">Vue.js</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative w-full md:w-3/4 mx-auto transform -rotate-1 hover:rotate-0 transition-transform duration-500 md:-translate-x-5">
                <div class="washi-tape -top-3 left-1/2 -translate-x-1/2 rotate-[-1deg] z-20"></div>

                <div class="diary-paper p-8 md:p-10 relative">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-[repeating-linear-gradient(45deg,transparent,transparent_2px,var(--color-border)_2px,var(--color-border)_4px)] opacity-20 rounded-bl-3xl"></div>

                    <div class="flex flex-col md:flex-row gap-6 relative z-10">
                        <div class="md:w-1/4 border-b-2 md:border-b-0 md:border-r-2 border-dashed border-border/50 pb-4 md:pb-0 md:pr-6 flex flex-col justify-center">
                            <span class="font-serif text-2xl font-bold text-text">Masa Depan</span>
                            <span class="text-xs font-bold uppercase tracking-widest text-primary mt-1">Visi Karir</span>
                        </div>
                        <div class="md:w-3/4">
                            <h4 class="text-xl font-bold text-text mb-3">Full-Stack Web Developer</h4>
                            <p class="text-muted font-medium leading-relaxed">
                                Membangun solusi digital yang skalabel dan efisien. Berkontribusi pada proyek open-source, dan beradaptasi dengan teknologi baru seperti arsitektur cloud dan ekosistem serverless.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="absolute -left-4 md:-left-12 top-10 rotate-[-15deg] z-20">
                    <span class="text-danger font-bold text-sm tracking-wider border-2 border-danger px-2 py-0.5 rounded-sm shadow-sm transform inline-block" style="font-family: 'Comic Sans MS', cursive, sans-serif;">
                        Tujuan Utama!
                    </span>
                </div>
            </div> --}}

        </div>
    </section>

    <section class="max-w-6xl mx-auto px-5 md:px-8 py-20 mt-10 border-t border-border/50">

        <div class="flex flex-col md:flex-row gap-12 lg:gap-20">
            <div class="w-full md:w-1/3">
                <h3 class="text-4xl font-bold tracking-tight text-text leading-tight mb-4"
                data-i18n="about.career_roadmap.title">
                    Visi.
                </h3>
                <p class="text-sm text-muted font-medium"
                data-i18n="about.career_roadmap.description">
                    Hal yang ingin saya capai dalam perjalanan belajar web development.
                </p>
            </div>

            <div class="w-full md:w-2/3 grid sm:grid-cols-2 gap-6">

            <div class="diary-paper p-8 flex flex-col hover:-translate-y-1 transition-transform">
                <p class="text-[10px] font-bold text-muted tracking-widest uppercase mb-4 border-b border-border/50 pb-2"
                data-i18n="about.career_roadmap.short_term.label">
                    Jangka Pendek
                </p>

                <h4 class="text-xl font-bold text-text mb-3"
                data-i18n="about.career_roadmap.short_term.title">
                    Memperkuat Dasar
                </h4>

                <p class="text-sm text-muted font-medium leading-relaxed"
                data-i18n="about.career_roadmap.short_term.description">
                    Fokus mempelajari Laravel, Vue, dan teknologi web lainnya sambil membangun berbagai proyek untuk memperkuat pemahaman dalam pengembangan web full-stack.
                </p>
            </div>

            <div class="diary-paper p-8 flex flex-col hover:-translate-y-1 transition-transform bg-container">
                <p class="text-[10px] font-bold text-muted tracking-widest uppercase mb-4 border-b border-border/50 pb-2"
                data-i18n="about.career_roadmap.long_term.label">
                    Jangka Panjang
                </p>

                <h4 class="text-xl font-bold text-text mb-3"
                data-i18n="about.career_roadmap.long_term.title">
                    Menjadi Web Developer
                </h4>

                <p class="text-sm text-muted font-medium leading-relaxed"
                data-i18n="about.career_roadmap.long_term.description">
                    Terus mengembangkan kemampuan dalam membangun aplikasi web yang bermanfaat, serta memperdalam pengalaman sebagai developer full-stack.
                </p>
            </div>

            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-5 md:px-8 py-20 border-t border-border/50">

        <div class="flex flex-col md:flex-row gap-12 lg:gap-20">
            <div class="w-full md:w-1/3">
                <h3 class="text-4xl font-bold tracking-tight text-text leading-tight mb-4"
                data-i18n="about.mission.title">
                    Misi.
                </h3>
                <p class="text-sm text-muted font-medium"
                data-i18n="about.mission.description">
                    Hal-hal yang saya lakukan secara konsisten untuk mewujudkan Visi.
                </p>
            </div>

            <div class="w-full md:w-2/3 grid sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-4">

                <div class="relative bg-yellow-100 text-slate-800 p-6 shadow-md md:-rotate-2 hover:rotate-0 transition-transform duration-300 ease-out flex flex-col">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-12 h-4 bg-white/40 shadow-sm rotate-2"></div>

                    <h4 class="text-lg font-bold mb-3"
                    data-i18n="about.mission.item1.title">
                        Belajar Konsisten
                    </h4>
                    <p class="text-sm font-medium leading-relaxed opacity-90"
                    data-i18n="about.mission.item1.description">
                        Belajar secara rutin dengan fokus pada pemahaman fundamental, tanpa terburu-buru ke hal yang lebih kompleks.
                    </p>
                </div>

                <div class="relative bg-orange-50 text-slate-800 p-6 shadow-md md:rotate-2 hover:rotate-0 transition-transform duration-300 ease-out flex flex-col sm:mt-8">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-12 h-4 bg-white/50 shadow-sm -rotate-2"></div>

                    <h4 class="text-lg font-bold mb-3"
                    data-i18n="about.mission.item2.title">
                        Praktik & Eksplorasi
                    </h4>
                    <p class="text-sm font-medium leading-relaxed opacity-90"
                    data-i18n="about.mission.item2.description">
                        Menerapkan apa yang dipelajari melalui proyek kecil. Proses ini membantu memahami error dan menemukan solusi secara mandiri.
                    </p>
                </div>

                <div class="relative bg-white text-slate-800 p-6 shadow-md md:-rotate-1 hover:rotate-0 transition-transform duration-300 ease-out flex flex-col sm:col-span-2 lg:col-span-1 lg:mt-4">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-12 h-4 bg-gray-200/50 shadow-sm rotate-1"></div>

                    <h4 class="text-lg font-bold mb-3"
                    data-i18n="about.mission.item3.title">
                        Dokumentasi
                    </h4>
                    <p class="text-sm font-medium leading-relaxed opacity-90"
                    data-i18n="about.mission.item3.description">
                        Mencatat hal-hal penting dari proses belajar dan pengerjaan proyek sebagai referensi untuk penggunaan di masa mendatang.
                    </p>
                </div>

            </div>
        </div>
    </section>
    </div>
@endsection
