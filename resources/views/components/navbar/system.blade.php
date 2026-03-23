<style>
    .hud-navbar {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        background-color: color-mix(in srgb, var(--color-bg) 85%, transparent);
        border: 1px solid color-mix(in srgb, var(--color-primary) 30%, transparent);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5), inset 0 0 0 1px rgba(255, 255, 255, 0.02);
        transform-origin: top center;
        will-change: transform;
    }
    .hud-link {
        position: relative;
        font-family: monospace;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--color-muted);
        transition: color 0.3s ease;
        padding: 0.5rem 0.75rem;
        display: inline-block;
    }
    .hud-link::before,
    .hud-link::after {
        position: absolute;
        opacity: 0;
        color: var(--color-primary);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .hud-link::before { content: '['; left: -4px; transform: translateX(8px); }
    .hud-link::after { content: ']'; right: -4px; transform: translateX(-8px); }
    .hud-link:hover { color: var(--color-text); }
    .hud-link:hover::before, .hud-link:hover::after { opacity: 1; transform: translateX(0); }

    .hud-brand {
        font-family: monospace;
        font-weight: 700;
        color: var(--color-primary);
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }
</style>

<nav id="mainNavbar" class="hud-navbar fixed top-4 lg:top-6 left-1/2 -translate-x-1/2
    w-[calc(100%-2rem)] md:w-[90%] md:max-w-2xl lg:max-w-2xl z-50">

    <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-primary/80"></div>
    <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-primary/80"></div>
    <div class="absolute top-0 right-0 w-8 h-px bg-primary/50"></div>
    <div class="absolute bottom-0 left-0 w-8 h-px bg-primary/50"></div>

    <div class="px-4 xl:px-6 py-1.5 flex justify-between items-center">

        <div id="secret-brand-trigger-desktop" class="flex items-center gap-2 cursor-pointer select-none group" data-target="{{ route('portofolio.settings') }}">
            <div class="w-1.5 h-4 bg-primary animate-pulse group-hover:scale-y-125 transition-transform duration-300"></div>
            <h1 class="hud-brand text-xs sm:text-sm">
                {{ $brand ?? 'Fadlan' }}
            </h1>
        </div>

        <ul class="hidden md:flex items-center gap-1 lg:gap-2">
            @foreach ($menus as $menu)
            <li>
                <a href="{{ $menu['href'] }}" data-i18n="{{ $menu['key'] }}" class="hud-link {{ request()->url() == $menu['href'] ? 'text-text' : '' }}">
                    {{ __($menu['key']) }}
                </a>
            </li>
            @endforeach
        </ul>

        <div class="flex items-center gap-4 md:border-l md:border-border/50 md:pl-4">

            <button id="layoutToggleBtn" class="text-muted hover:text-primary transition-colors flex items-center justify-center" title="Switch Design Layout">
                <i id="layoutIcon" class="fa-solid fa-terminal text-sm"></i>
            </button>

            <button onclick="window.toggleTheme()" class="text-muted hover:text-primary transition-colors flex items-center justify-center" title="Switch Light/Dark Mode">
                <i id="colorIcon" class="fa-solid fa-moon text-sm"></i>
            </button>

            <button id="langToggle" class="text-muted hover:text-primary transition-colors flex items-center justify-center grayscale hover:grayscale-0" title="Switch Language">
                <span id="langFlag" class="fi fi-id w-4 h-3 rounded-sm"></span>
            </button>

            <button id="mobileMenuBtn" class="md:hidden text-primary hover:text-text transition-colors">
                <i class="fa-solid fa-bars-staggered text-lg"></i>
            </button>
        </div>
    </div>
</nav>

<div id="mobileOverlay" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-70 opacity-0 pointer-events-none transition"></div>

<aside id="mobileSidebar" class="fixed top-0 left-0 h-full w-[80%] max-w-[300px] bg-bg/95 backdrop-blur-2xl border-r border-border z-100 -translate-x-full pointer-events-none transition-transform duration-300 flex flex-col shadow-2xl">

    <div class="h-16 px-6 flex justify-between items-center border-b border-border/50">
        <div id="secret-brand-trigger-mobile" class="flex items-center gap-3 cursor-pointer select-none" data-target="{{ route('portofolio.settings') }}">
            <div class="w-6 h-6 rounded bg-primary text-bg flex items-center justify-center font-bold text-xs">
                <i class="fa-solid fa-terminal"></i>
            </div>
            <span class="font-mono text-sm font-bold tracking-widest text-text uppercase">
                {{ $brand ?? 'Fadlan' }}
            </span>
        </div>
        <button id="mobileCloseBtn" class="w-8 h-8 flex items-center justify-center rounded-md text-muted hover:bg-surface hover:text-text transition-colors">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <nav class="p-6 flex flex-col gap-2 text-sm flex-1 overflow-y-auto">
        <p class="text-[10px] font-mono uppercase tracking-widest text-muted mb-2 px-2"
        data-i18n="nav.navigasi">Navigation</p>

        @foreach ($menus as $menu)
        @php $isActive = request()->url() == $menu['href']; @endphp
        <a href="{{ $menu['href'] }}" data-i18n="{{ $menu['key'] }}"
            class="group relative flex items-center gap-3 px-3 py-3 rounded-none border border-transparent font-mono text-xs uppercase tracking-widest transition-all duration-200
                   {{ $isActive ? 'bg-primary/10 border-primary/30 text-primary' : 'text-muted hover:bg-surface hover:border-border hover:text-text' }}">

            @if($isActive)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-4 bg-primary shadow-[0_0_8px_var(--color-primary)]"></span>
            @endif

            <i class="w-5 text-center {{ $menu['icon'] ?? 'fa-solid fa-folder-closed' }} {{ $isActive ? 'text-primary' : 'text-muted group-hover:text-text' }} transition-colors"></i>
            <span>{{ __($menu['key']) }}</span>
        </a>
        @endforeach

        <div class="mt-8 pt-6 border-t border-border/50 space-y-4">
            <p class="text-[10px] font-mono uppercase tracking-widest text-muted px-2"
            data-i18n="nav.authenticated">Autentikasi</p>

            @if (!auth()->check())
                <a href="/login" class="w-full flex items-center justify-center gap-2 px-4 py-3 border border-primary text-primary font-mono text-xs font-bold uppercase tracking-widest hover:bg-primary hover:text-bg transition-colors">
                    <i class="fa-solid fa-terminal"></i>
                    <span data-i18n="nav.login">LOGIN</span>
                </a>
            @else
                <div class="flex gap-2">
                    <a href="{{ route('dashboard.home') }}" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 border border-primary bg-primary/5 text-primary font-mono text-xs uppercase tracking-widest hover:bg-primary hover:text-white transition-colors">
                        <i class="fa-solid fa-gauge"></i>
                        <span data-i18n="navdashboard">DASHBOARD</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-12 h-full flex items-center justify-center border border-border text-muted font-mono text-xs uppercase tracking-widest hover:bg-red-500 hover:text-white transition-colors group">
                            <i class="fa-solid fa-power-off"></i>
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </nav>

    @if($showClock ?? true)
    <div class="p-6 border-t border-border/50 bg-surface/30">
        <div class="flex items-center gap-2 text-primary text-[10px] uppercase font-bold mb-1 font-mono">
            <span class="w-2 h-2 bg-primary animate-pulse shadow-[0_0_8px_var(--color-primary)]"></span>
            Local Time
        </div>
        <div id="mobile-live-clock" data-format="{{ $clockFormat ?? '24' }}" data-seconds="{{ $showSeconds ?? '1' }}" class="text-text text-sm font-semibold font-mono tracking-widest">
            00:00:00 WITA
        </div>
        <div id="mobile-live-date" data-date="{{ $showDate ?? '1' }}" class="text-muted text-[10px] font-mono uppercase mt-1 hidden">
            --
        </div>
    </div>
    @endif
</aside>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const openBtn = document.getElementById('mobileMenuBtn');
    const closeBtn = document.getElementById('mobileCloseBtn');
    const sidebar = document.getElementById('mobileSidebar');
    const overlay = document.getElementById('mobileOverlay');

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full','pointer-events-none');
        overlay.classList.remove('opacity-0','pointer-events-none');
    }

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full','pointer-events-none');
        overlay.classList.add('opacity-0','pointer-events-none');
    }

    openBtn?.addEventListener('click', openSidebar);
    closeBtn?.addEventListener('click', closeSidebar);
    overlay?.addEventListener('click', closeSidebar);

    const mClock = document.getElementById('mobile-live-clock');
    const mDate = document.getElementById('mobile-live-date');

    if (mClock) {
        const formatStr = mClock.getAttribute('data-format') || '24';
        const showSecondsStr = mClock.getAttribute('data-seconds') || '1';

        const use12Hour = (formatStr === '12');
        const showSeconds = (showSecondsStr === '1');

        let showDate = false;
        if (mDate) {
            showDate = (mDate.getAttribute('data-date') === '1');
            if (showDate) mDate.classList.remove('hidden');
        }

        function updateMobileClock() {
            const now = new Date();
            const timeOptions = { hour12: use12Hour, hour: '2-digit', minute: '2-digit' };
            if (showSeconds) timeOptions.second = '2-digit';
            mClock.innerText = now.toLocaleTimeString('en-US', timeOptions) + ' WITA';

            if (showDate && mDate) {
                mDate.innerText = now.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: '2-digit' }).toUpperCase();
            }
        }
        updateMobileClock();
        setInterval(updateMobileClock, 1000);
    }

    const layouts = ['diary', 'clean', 'system'];
    const layoutIcons = {
        'diary':  'fa-solid fa-book',
        'clean':  'fa-brands fa-apple',
        'system': 'fa-solid fa-terminal'
    };

    const layoutBtn = document.getElementById('layoutToggleBtn');
    const layoutIcon = document.getElementById('layoutIcon');
    const htmlEl = document.documentElement;

    let currentLayout = localStorage.getItem('ui_layout') || htmlEl.getAttribute('data-layout') || 'system';
    if (!layouts.includes(currentLayout)) currentLayout = 'system';
    if (layoutIcon) layoutIcon.className = layoutIcons[currentLayout] + ' text-sm';

    layoutBtn?.addEventListener('click', () => {
        let nextIndex = (layouts.indexOf(currentLayout) + 1) % layouts.length;
        currentLayout = layouts[nextIndex];

        htmlEl.setAttribute('data-layout', currentLayout);
        localStorage.setItem('ui_layout', currentLayout);
        document.cookie = `ui_layout=${currentLayout};path=/;max-age=31536000;SameSite=Lax`;

        layoutIcon.className = layoutIcons[currentLayout] + ' text-sm';
        layoutIcon.animate([{ transform: 'rotate(-90deg)' }, { transform: 'rotate(0)' }], { duration: 300 });

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (csrfToken) {
            fetch('/api/layout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ layout: currentLayout })
            }).then(() => { if(window.triggerPageWipe) window.triggerPageWipe(window.location.href, `> REBUILD_LAYOUT: ${currentLayout.toUpperCase()}`); else window.location.reload(); })
              .catch(() => { if(window.triggerPageWipe) window.triggerPageWipe(window.location.href, `> REBUILD_LAYOUT: ${currentLayout.toUpperCase()}`); else window.location.reload(); });
        } else {
            if(window.triggerPageWipe) window.triggerPageWipe(window.location.href, `> REBUILD_LAYOUT: ${currentLayout.toUpperCase()}`); else window.location.reload();
        }
    });

    const langBtn = document.getElementById('langToggle');
    const langFlag = document.getElementById('langFlag');

    let currentLocale = htmlEl.lang || 'id';

    // Initial flags are now globally handled by app.js on DOMContentLoaded

    langBtn?.addEventListener('click', () => {
        let nextLocale = currentLocale === 'id' ? 'en' : 'id';

        if (window.updateLangIcon) window.updateLangIcon(nextLocale);

        localStorage.setItem('locale', nextLocale);
        document.cookie = `locale=${nextLocale};path=/;max-age=31536000;SameSite=Lax`;

        document.body.classList.remove('page-loaded');
        document.body.classList.add('page-exiting');

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (csrfToken) {
            fetch('/api/locale', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ locale: nextLocale })
            }).then(() => {
                if(window.triggerPageWipe) window.triggerPageWipe(window.location.href, `> SWITCH_LANG: [${nextLocale.toUpperCase()}]`); else setTimeout(() => { window.location.reload(); }, 300);
            }).catch(err => {
                console.warn('Locale sync failed:', err);
                if(window.triggerPageWipe) window.triggerPageWipe(window.location.href, `> SWITCH_LANG: [${nextLocale.toUpperCase()}]`); else setTimeout(() => { window.location.reload(); }, 300);
            });
        } else {
            if(window.triggerPageWipe) window.triggerPageWipe(window.location.href, `> SWITCH_LANG: [${nextLocale.toUpperCase()}]`); else setTimeout(() => { window.location.reload(); }, 300);
        }
    });

    function setupEasterEgg(elementId) {
        const trigger = document.getElementById(elementId);
        if (!trigger) return;

        let clickCount = 0;
        let clickTimer = null;

        trigger.addEventListener('click', () => {
            clickCount++;
            clearTimeout(clickTimer);
            clickTimer = setTimeout(() => { clickCount = 0; }, 1500);

            if (clickCount === 7) {
                const targetUrl = trigger.getAttribute('data-target');
                document.body.style.transition = 'filter 0.2s';
                document.body.style.filter = 'invert(1)';

                setTimeout(() => {
                    document.body.style.filter = 'invert(0)';
                    if(targetUrl) window.location.href = targetUrl;
                }, 200);
                clickCount = 0;
            }
        });
    }

    setupEasterEgg('secret-brand-trigger-desktop');
    setupEasterEgg('secret-brand-trigger-mobile');
});
</script>
