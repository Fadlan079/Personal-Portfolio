<section id="home" class="relative pt-24 md:pt-24 pb-20 px-5 max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-12 lg:gap-20 min-h-[90vh]">
    <div class="w-full md:w-3/5 space-y-8 z-10">

        <div class="gsap-hero-item group relative inline-flex items-center gap-2.5 py-1.5 pl-9 pr-6 text-yellow-900 font-serif transition-all duration-300 w-max opacity-0 translate-y-4 hover:-translate-y-0.5 hover:rotate-1"
            style="filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.06));">

            <div class="absolute inset-0 bg-warning border border-yellow-500 rounded-l-md z-0"
                style="clip-path: polygon(0 0, 100% 0, 93% 50%, 100% 100%, 0 100%);">
            </div>

            <div class="absolute top-1/2 -left-5 w-7 h-[1.5px] bg-[#8B0000]/80 -translate-y-[calc(50%+1px)] origin-right -rotate-12 group-hover:-rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>
            <div class="absolute top-1/2 -left-4 w-6 h-[1.5px] bg-[#B22222]/80 -translate-y-[calc(50%-1px)] origin-right rotate-12 group-hover:rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>

            <div class="absolute left-2.5 top-1/2 -translate-y-1/2 w-2.5 h-2.5 rounded-full bg-surface shadow-[inset_1px_1px_3px_rgba(0,0,0,0.3)] border border-yellow-700/30 z-10"></div>

            <span class="relative flex h-2 w-2 z-10">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-success opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-success"></span>
            </span>

            <span class="relative z-10 text-[10px] sm:text-xs font-black tracking-[0.15em] uppercase text-yellow-900 mt-px"
            data-i18n="home.hero.status">
                Tersedia Untuk Kolaborasi
            </span>
        </div>

        <div class="space-y-2">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black tracking-tighter text-text leading-[1.05]">
                <div class="gsap-hero-item opacity-0 translate-y-4">Fadlan</div>
                <div class="gsap-hero-item text-muted opacity-0 translate-y-4">Firdaus.</div>
            </h1>
        </div>

        <p class="gsap-hero-item text-base md:text-lg text-muted max-w-xl leading-relaxed font-medium opacity-0 translate-y-4"
        data-i18n="home.hero.description">
           Siswa SMK TI Airlangga generasi ke-24 yang berfokus pada pengembangan web full-stack dan tertarik mempelajari teknologi baru.
        </p>

        <div class="gsap-hero-item flex flex-col sm:flex-row items-stretch sm:items-center gap-4 pt-4 opacity-0 translate-y-4">

            <div class="w-full sm:w-auto" style="filter: drop-shadow(0px 4px 6px rgba(0,0,0,0.1));">
                <a href="{{ route('portofolio.projects') }}"
                class="relative flex items-center justify-center gap-3 px-8 pt-4 pb-6 bg-warning text-yellow-900 font-serif font-bold text-center hover:-translate-y-1 transition-transform duration-300 group w-full sm:w-auto"
                style="clip-path: polygon(0% 0%, 100% 0%, 100% 85%, 96% 100%, 92% 82%, 87% 95%, 82% 85%, 77% 100%, 72% 88%, 66% 98%, 60% 85%, 55% 100%, 48% 88%, 42% 95%, 36% 82%, 30% 100%, 25% 85%, 18% 98%, 12% 85%, 6% 95%, 0% 85%);">

                    <div class="absolute top-1 left-0 w-full h-px bg-yellow-900/10 z-0"></div>

                    <span class="relative z-10" data-i18n="home.hero.button_projects">Lihat Proyek</span>
                    <i class="fa-solid fa-arrow-right-long text-sm relative z-10 group-hover:translate-x-1.5 transition-transform"></i>
                </a>
            </div>

            <a href="{{ route('portofolio.contact') }}"
            class="relative w-full sm:w-auto px-10 py-5 bg-[#fffdf0] text-[#18181B] border border-[#E5E5EA] font-serif font-bold text-center hover:scale-105 transition-transform duration-300 flex items-center justify-center gap-3 shadow-[-1px_1px_5px_rgba(0,0,0,0.1)] hover:shadow-[-2px_2px_8px_rgba(0,0,0,0.15)] group"
            style="clip-path: polygon(0% 100%, 0% 15%, 5% 5%, 15% 15%, 25% 0%, 35% 10%, 45% 5%, 55% 15%, 65% 0%, 75% 10%, 85% 5%, 95% 15%, 100% 5%, 100% 100%);">

                <div class="absolute -top-[1.5px] left-0 w-full h-[3px] bg-border/20 z-0"></div>

                <span class="relative z-10 font-serif" data-i18n="home.hero.button_contact">Hubungi Saya</span>
                <i class="fa-solid fa-arrow-right-long text-sm relative z-10 group-hover:translate-x-1.5 transition-transform"></i>

            </a>

        </div>

        <div class="gsap-hero-item flex flex-wrap items-center gap-3 pt-4 border-t border-border mt-8 opacity-0 translate-y-4 font-sans">

            <a href="{{ $ghLink }}" target="_blank" class="group relative flex items-center justify-center gap-2.5 px-1 py-2 border-4 rounded text-text/70 border-text/70 transition-all duration-300 ease-out hover:rotate-2 hover:scale-105 hover:bg-text/5 hover:text-text/100 hover:border-text/100">
                <i class="fa-brands fa-github text-lg"></i>
                <span class="text-xs font-bold uppercase tracking-widest">GitHub</span>

            </a>

            <a href="{{ $liLink }}" target="_blank" class="group relative flex items-center justify-center gap-2.5 px-1.5 py-1.5 border-4 rounded text-blue-600/70 border-blue-600/70 transition-all duration-300 ease-out hover:-rotate-1 hover:scale-105 hover:bg-blue-600/5 hover:text-blue-600/100 hover:border-blue-600/100">
                <i class="fa-brands fa-linkedin text-lg"></i>
                <span class="text-xs font-bold uppercase tracking-widest">LinkedIn</span>
            </a>

            <a href="{{ $emailLink }}" class="group relative flex items-center justify-center gap-2.5 px-1 py-1 border-4 rounded text-rose-500/70 border-rose-500/70 transition-all duration-300 ease-out hover:rotate-3 hover:scale-105 hover:bg-rose-500/5 hover:text-rose-500/100 hover:border-rose-500/100">
                <i class="fa-solid fa-envelope text-lg"></i>
                <span class="text-xs font-bold uppercase tracking-widest">Email</span>
            </a>

        </div>
    </div>

    <div class="gsap-hero-photo w-full md:w-2/5 flex justify-center md:justify-end mt-12 md:-mt-30 relative z-10 opacity-0 translate-y-8">

        <div class="absolute inset-0 bg-[repeating-linear-gradient(45deg,transparent,transparent_10px,var(--color-border)_10px,var(--color-border)_11px)] opacity-20 -z-10 rounded-[2rem] transform translate-x-4 translate-y-4"></div>

        <div class="relative w-80 h-80 sm:w-80 sm:h-80 lg:w-96 lg:h-96 bg-surface shadow-2xl border border-border p-3 transform rotate-3 hover:rotate-0 transition-transform duration-500">

            <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-16 h-8 bg-surface/80 backdrop-blur-sm border border-border/50 shadow-sm rotate-[-4deg] z-20"></div>

            <div class="w-full h-full relative overflow-hidden bg-container border border-border/50">
                <div class="absolute inset-0 opacity-[0.03] pointer-events-none z-10" style="background-image: radial-gradient(var(--color-text) 1px, transparent 1px); background-size: 8px 8px;"></div>

                <img src="{{ $profilePhoto }}"
                alt="Fadlan Photo"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                class="w-full h-full object-cover grayscale-[0.4] hover:grayscale-0 transition-all duration-700">

                <div style="display:none;" class="flex-col items-center justify-center w-full h-full text-muted p-4 text-center bg-surface">
                    <i class="fa-regular fa-image text-3xl opacity-30 mb-2"></i>
                    <span class="text-[9px] uppercase tracking-widest font-bold" data-i18n="home.hero.photo_placeholder">Kliping Kosong</span>
                </div>
            </div>

            <div class="absolute -bottom-3 right-3 rotate-[-6deg]">
                <div class="bg-warning text-yellow-900 px-3 py-1 text-[10px] font-black uppercase tracking-widest shadow-md border-l-4 border-yellow-500 whitespace-nowrap w-max" data-i18n="home.hero.photo_author_tag">
                    Author Profile
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        if (typeof gsap !== 'undefined') {

            const tl = gsap.timeline({ defaults: { ease: "power2.out" } });

            tl.to(".gsap-hero-item", {
                y: 0,
                opacity: 1,
                duration: 0.8,
                stagger: 0.15,
                delay: 0.2
            });

            tl.to(".gsap-hero-photo", {
                y: 0,
                opacity: 1,
                duration: 1,
                ease: "back.out(1.2)"
            }, "-=0.6");
        }
    });
</script>
