<section id="home" class="hero-section relative min-h-screen flex items-center justify-center overflow-hidden z-10">
    <div class="hero-ribbons pointer-events-none absolute inset-0 overflow-hidden z-0 font-bold">
        <div class="ribbon ribbon-blue">
            <div class="ribbon-track">
                <div class="ribbon-track-content">
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                </div>
                <div class="ribbon-track-content" aria-hidden="true">
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                </div>
            </div>
        </div>

        <div class="ribbon ribbon-white">
            <div class="ribbon-track">
                <div class="ribbon-track-content">
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                </div>
                <div class="ribbon-track-content" aria-hidden="true">
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                    <span>FULL STACK DEVELOPER<em>◆</em>WEB APPLICATION</span>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-floats pointer-events-auto">
        <a href="{{ $ghLink }}" target="_blank" class="float-icon icon-github group" data-depth="1.2">
            <i class="fa-brands fa-github"></i>
            <span class="float-label">Github</span>
        </a>

        <a href="{{ $liLink }}" target="_blank" class="float-icon icon-linkedin group" data-depth="0.9">
            <i class="fa-brands fa-linkedin"></i>
            <span class="float-label">LinkedIn</span>
        </a>

        <a href="{{ $igLink }}" target="_blank" class="float-icon icon-instagram group" data-depth="0.7">
            <i class="fa-brands fa-instagram"></i>
            <span class="float-label">Instagram</span>
        </a>

        <a href="{{ $emailLink }}" class="float-icon icon-mail group" data-depth="0.6">
            <i class="fa-solid fa-envelope"></i>
            <span class="float-label">Email</span>
        </a>

        <a href="{{ $waLink }}" target="_blank" class="float-icon icon-whatsapp group" data-depth="1.0">
            <i class="fa-brands fa-whatsapp"></i>
            <span class="float-label">Whatsapp</span>
        </a>
    </div>

    @if ($showClock ?? true)
        <div class="hidden md:flex fixed top-8 left-6 z-50 flex-col gap-1 font-mono tracking-widest cursor-default">
            <div class="flex items-center gap-2 text-primary text-[10px] uppercase font-bold">
                <span
                    class="w-2 h-2 bg-primary rounded-full animate-pulse shadow-[0_0_8px_var(--color-primary)]"></span>
                CURRENT TIME
            </div>
            <div id="hero-live-clock" data-format="{{ $clockFormat ?? '24' }}" data-seconds="{{ $showSeconds ?? '1' }}"
                class="text-text text-sm font-semibold opacity-80">
                00:00:00 WITA
            </div>
            <div id="hero-live-date" data-date="{{ $showDate ?? '1' }}" class="text-muted text-[10px] hidden"></div>
            <div class="text-muted text-[9px] uppercase mt-1 border-t border-border/50 pt-1 w-max">
                Local Env
            </div>
        </div>
    @endif

    <div class="hidden md:block fixed top-7.5 right-4 z-50">
        <div class="flex justify-center">
            @if (!session('is_login'))
                <a href="/login"
                    class="cta-btn relative overflow-hidden px-4 py-2 border-2 border-border text-text font-mono text-xs font-bold uppercase tracking-widest"
                    style="--cta-bubble-color: var(--color-primary);">
                    <span class="cta-bubble"></span>
                    <span class="cta-text relative z-10 flex items-center gap-2">
                        LOGIN
                    </span>
                </a>
            @else
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="group flex items-center gap-3 px-4 py-2 text-xs font-mono uppercase tracking-widest text-muted hover:bg-red-500/10 hover:text-red-500 transition-colors border border-border hover:border-red-500/20">
                        <span>End_Session</span>
                        <i class="fa-solid fa-power-off opacity-50 group-hover:opacity-100 group-hover:animate-pulse"></i>
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="hero-center relative z-10 text-center max-w-3xl -top-10">
        <div class="text-center">
            <span data-i18n="hero.collaboration"
                class="hero-badge inline-flex items-center gap-2 px-4 py-1 mb-6 rounded-none border border-border bg-surface text-sm font-mono tracking-widest text-muted uppercase"></span>

            <h2 class="hero-title mb-6 leading-tight text-center">
                <div class="hero-big hero-solid" data-text="HI">
                    <span data-i18n="hero.hi">Hi, I'm</span>
                </div>
                <div class="hero-big hero-outline">FADLAN</div>
                <div class="hero-sub text-muted mt-4 font-semibold">Full Stack Developer</div>
            </h2>

            <p
                class="hero-desc max-w-xl mx-auto mb-5 text-sm md:text-base leading-loose tracking-wide text-muted/80 relative">
                <span class="hero-desc-line"></span>
                <span data-i18n="hero.description">
                    Focus on building modern web applications with clear <strong class='text-text'>backend</strong> structures, responsive <strong class='text-text'>frontend</strong> and production-ready systems.
                </span>
            </p>

            <div class="flex gap-4 flex-wrap justify-center text-sm font-mono uppercase tracking-widest font-bold mt-2">
                <a href="{{ route('portofolio.projects') }}"
                    class="cta-btn relative overflow-hidden px-6 py-3 bg-primary text-background border-2 border-primary"
                    style="--cta-bubble-color: var(--color-bg);">
                    <span class="cta-bubble"></span>
                    <span class="cta-text relative z-10 flex items-center gap-2">
                       <span data-i18n="home.cta_btn_primary">PROJECTS</span>
                    </span>
                </a>

                <a href="{{ route('portofolio.contact') }}"
                    class="cta-btn relative overflow-hidden px-6 py-3 border-2 border-border text-text"
                    style="--cta-bubble-color: var(--color-primary);">
                    <span class="cta-bubble"></span>
                    <span class="cta-text relative z-10 flex items-center gap-2">
                        <span data-i18n="home.cta_btn_secondary">CONTACT</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>