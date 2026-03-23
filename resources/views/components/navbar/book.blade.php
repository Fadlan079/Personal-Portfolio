<style>
    .paper-tab-nav {
        background-color: var(--color-container);
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4' viewBox='0 0 4 4'%3E%3Cpath fill='%239C92AC' fill-opacity='0.05' d='M1 3h1v1H1V3zm2-2h1v1H3V1z'%3E%3C/path%3E%3C/svg%3E");
        border: 1px solid var(--color-border);
        box-shadow: 3px 3px 0px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .nav-tab-item {
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border: 1px solid transparent;
    }

    #mobileSidebar {
        background-color: var(--color-container);
        border-left: 1px solid var(--color-border);
    }

    .nav-tab-item.active-home { background-color: #FFF8E7; }
    .nav-tab-item.active-about { background-color: #E7F2FF; }
    .nav-tab-item.active-projects { background-color: #E7FFF2; }
    .nav-tab-item.active-contact { background-color: #FFE7E1; }

    .nav-tab-item.active-paper-tab {
        border-color: #e5e0d0;
        border-bottom-color: #ffffff;
        transform: translateY(-1px) rotate(0deg) !important;
        box-shadow: 0 -2px 5px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
    }

    @media (min-width: 768px) {
        .nav-tab-item:not(.active-paper-tab):hover {
            background-color: #ffffff;
            transform: translateY(-3px) rotate(0deg) !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-color: #e5e0d0;
        }
    }

    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
<nav class="paper-tab-nav fixed top-4 md:top-6 left-0 right-0 mx-auto z-50 w-[95%] md:w-full max-w-full md:max-w-2xl lg:max-w-3xl rounded-xl flex items-center justify-between px-3 md:px-4 py-2 overflow-hidden border-b-2 border-r-2 border-gray-200/70 shadow-lg">

    <div class="shrink-0 flex items-center h-full">
        <div id="secret-brand-trigger-desktop" class="flex items-center justify-center cursor-pointer select-none group" data-target="{{ route('portofolio.settings') }}">
            <span class="font-bold text-base text-text group-hover:text-primary transition-colors font-serif italic">
                {{ $brand ?? 'Fadlan'}}
            </span>
        </div>
        <div class="w-px h-6 bg-gray-300 mx-3 hidden md:block"></div>
    </div>

    <div class="flex-1 overflow-x-auto no-scrollbar mx-1 md:mx-2 hidden md:flex justify-center h-full items-end mt-1">
        <ul class="flex items-end justify-center gap-1 w-max mx-auto font-sans pt-1">
            @foreach ($menus as $index => $menu)
                @php
                    $isActive = request()->url() == $menu['href'];
                    $menuKey = $menu['key'];
                    $menuText = ucwords(strtolower(__($menu['key'])));

                    $randomRotation = ['rotate-0', 'rotate-1', '-rotate-1', 'rotate-1'][$index % 4];

                    $navLinkClass = $isActive
                        ? "active-paper-tab active-{$menuKey} text-primary"
                        : "text-muted hover:text-neutral-900 {$randomRotation}";
                @endphp
                <li>
                    <a href="{{ $menu['href'] }}" title="{{ $menuText }}"
                       class="nav-tab-item relative px-4 py-2 text-[13px] font-bold transition-all duration-300 flex items-center justify-center gap-2 rounded-t-lg shadow-sm {{ $navLinkClass }}">
                        <span data-i18n="{{ $menu['key'] }}">{{ $menuText }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="w-full h-px bg-gray-300 absolute bottom-[9px] left-0 z-0 hidden md:block"></div>
    </div>

    <div class="flex items-center justify-end shrink-0 pl-1 h-full md:border-l md:border-gray-300 ml-2">

        <div class="hidden md:flex items-center w-max gap-1">
            {{-- <button id="layoutToggleBtn" class="w-8 h-8 rounded-lg flex items-center justify-center text-muted hover:text-primary hover:bg-neutral-100 transition-colors shrink-0" title="Switch Design Layout">
                <i id="layoutIcon" class="fa-solid fa-book text-[13px]"></i>
            </button> --}}

            <button onclick="window.toggleTheme()" id="colorToggleBtn" class="w-8 h-8 rounded-lg flex items-center justify-center text-muted hover:text-warning hover:bg-neutral-100 transition-colors shrink-0" title="Switch Light/Dark Mode">
                <i id="colorIcon" class="fa-solid fa-moon text-[13px]"></i>
            </button>

            <button id="langToggle" class="w-8 h-8 rounded-lg flex items-center justify-center text-muted hover:bg-neutral-100 transition-colors grayscale hover:grayscale-0 shrink-0" title="Switch Language">
                <span id="langFlag" class="fi fi-id text-sm rounded-sm"></span>
            </button>
        </div>

        <button id="mobileMenuBtn" class="md:hidden w-10 h-10 rounded-xl flex items-center bg-white border border-gray-300/70 shadow-sm justify-center text-neutral-900 transition-colors shrink-0 ml-2">
            <i class="fa-solid fa-bars-staggered text-sm"></i>
        </button>

        <div class="w-full h-px bg-gray-300 absolute bottom-[9px] left-0 z-0 hidden md:block"></div>
    </div>
</nav>

<div id="mobileOverlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[70] opacity-0 pointer-events-none transition-opacity duration-300"></div>

<aside id="mobileSidebar" class="fixed top-0 right-0 h-full w-[85%] max-w-[320px] bg-[#fdfcf5] border-l border-gray-300/70 z-[100] translate-x-full pointer-events-none transition-transform duration-300 ease-out flex flex-col shadow-2xl rounded-l-3xl">

    <div class="h-20 px-6 flex justify-between items-center border-b border-gray-300/70">
        <div id="secret-brand-trigger-mobile" class="flex items-center gap-3 cursor-pointer select-none" data-target="{{ route('portofolio.settings') }}">
            <span class="font-bold text-sm text-text font-serifitalic" data-i18n="nav.main_menu">Menu Utama</span>
        </div>
        <button id="mobileCloseBtn" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white text-muted hover:text-neutral-900 transition-colors border border-gray-300/70 shadow-sm">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
    </div>

    <nav class="p-6 flex flex-col gap-2 flex-1 overflow-y-auto">
        <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 px-2" data-i18n="nav.navigasi">Navigasi</p>

        @foreach ($menus as $index => $menu)
            @php
                $isActive = request()->url() == $menu['href'];
                $menuText = ucwords(strtolower(str_replace('nav.', '', __($menu['key']))));
                $randomRotation = ['rotate-0', 'rotate-1', '-rotate-1', 'rotate-1'][$index % 4];
                $mobileLinkClass = $isActive
                    ? 'bg-white text-primary border-2 border-primary/30 rotate-0 translate-x-1'
                    : 'bg-surface text-muted hover:bg-white hover:text-neutral-900 border border-primary/70 ' . $randomRotation;
            @endphp
            <a href="{{ $menu['href'] }}"
                class="group relative flex items-center gap-5 px-3 py-2 rounded-xl font-bold text-sm transition-all duration-300 shadow-sm {{ $mobileLinkClass }}">

                <span data-i18n="{{ $menu['key'] }}">{{ $menuText }}</span>
            </a>
        @endforeach

        <div class="mt-6 pt-6 border-t border-gray-300/70">
            <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 px-2">Personalisasi</p>
            <div class="flex gap-2 px-2">
                {{-- <button id="layoutToggleBtnMobile" class="flex-1 h-10 rounded-xl flex items-center justify-center border border-gray-300/70 bg-white text-muted hover:text-primary transition-colors shadow-sm" title="Switch Design Layout">
                    <i id="layoutIconMobile" class="fa-solid fa-book text-sm"></i>
                </button> --}}

                <button onclick="window.toggleTheme()" id="colorToggleBtnMobile" class="flex-1 h-10 rounded-xl flex items-center justify-center border border-gray-300/70 bg-white text-muted hover:text-warning transition-colors shadow-sm" title="Switch Light/Dark Mode">
                    <i id="colorIconMobile" class="fa-solid fa-moon text-sm"></i>
                </button>

                <button id="langToggleMobile" class="flex-1 h-10 rounded-xl flex items-center justify-center border border-gray-300/70 bg-white text-muted transition-colors grayscale hover:grayscale-0 shadow-sm" title="Switch Language">
                    <span id="langFlagMobile" class="fi fi-id text-sm rounded-sm"></span>
                </button>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-gray-300/70">
            <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 px-2" data-i18n="nav.authenticated">Autentikasi</p>
            @if (!auth()->check())
                <a href="/login" class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-gray-300/70 bg-white text-neutral-900 rounded-xl font-bold text-sm hover:bg-neutral-50 transition-colors shadow-sm"
                data-i18n="nav.login">
                    Masuk
                </a>
            @else
                <div class="flex gap-2 relative">
                    <a href="{{ route('dashboard.home') }}" class="flex-1 flex items-center justify-center gap-2 px-4 py-3.5 bg-white text-primary rounded-xl font-bold text-sm hover:bg-neutral-50 transition-colors border-2 border-primary/30 shadow-sm">
                        <i class="fa-solid fa-gauge"></i>
                        <span data-i18n="nav.dashboard">Dasbor</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="w-auto">
                        @csrf
                        <button type="submit" class="w-12 h-[52px] flex items-center justify-center rounded-xl bg-white text-muted hover:bg-red-50 hover:text-white border border-gray-300/70 shadow-sm transition-colors" title="Keluar">
                            <i class="fa-solid fa-power-off"></i>
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </nav>
</aside>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const openBtn = document.getElementById('mobileMenuBtn');
    const closeBtn = document.getElementById('mobileCloseBtn');
    const sidebar = document.getElementById('mobileSidebar');
    const overlay = document.getElementById('mobileOverlay');

    function openSidebar() {
        sidebar.classList.remove('translate-x-full', 'pointer-events-none');
        overlay.classList.remove('opacity-0', 'pointer-events-none');
    }

    function closeSidebar() {
        sidebar.classList.add('translate-x-full', 'pointer-events-none');
        overlay.classList.add('opacity-0', 'pointer-events-none');
    }

    openBtn?.addEventListener('click', openSidebar);
    closeBtn?.addEventListener('click', closeSidebar);
    overlay?.addEventListener('click', closeSidebar);

    const layouts = ['diary', 'clean', 'system'];
    const layoutIconsMap = {
        'diary':  'fa-solid fa-book',
        'clean':  'fa-brands fa-apple',
        'system': 'fa-solid fa-terminal'
    };

    const layoutBtns = [document.getElementById('layoutToggleBtn'), document.getElementById('layoutToggleBtnMobile')];
    const layoutIcons = [document.getElementById('layoutIcon'), document.getElementById('layoutIconMobile')];
    const htmlEl = document.documentElement;

    let currentLayout = localStorage.getItem('ui_layout') || htmlEl.getAttribute('data-layout') || 'diary';
    if (!layouts.includes(currentLayout)) currentLayout = 'diary';

    if (layoutIcons[0]) layoutIcons[0].className = layoutIconsMap[currentLayout] + ' text-[13px]';
    if (layoutIcons[1]) layoutIcons[1].className = layoutIconsMap[currentLayout] + ' text-sm';

    layoutBtns.forEach(btn => {
        btn?.addEventListener('click', () => {
            let nextIndex = (layouts.indexOf(currentLayout) + 1) % layouts.length;
            currentLayout = layouts[nextIndex];

            htmlEl.setAttribute('data-layout', currentLayout);
            localStorage.setItem('ui_layout', currentLayout);
            document.cookie = `ui_layout=${currentLayout};path=/;max-age=31536000;SameSite=Lax`;

            if (layoutIcons[0]) {
                layoutIcons[0].className = layoutIconsMap[currentLayout] + ' text-[13px]';
                layoutIcons[0].animate([{ transform: 'rotate(-90deg)' }, { transform: 'rotate(0)' }], { duration: 300 });
            }
            if (layoutIcons[1]) {
                layoutIcons[1].className = layoutIconsMap[currentLayout] + ' text-sm';
                layoutIcons[1].animate([{ transform: 'rotate(-90deg)' }, { transform: 'rotate(0)' }], { duration: 300 });
            }

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
                })
                .then(() => triggerPageReload(`Mengganti desain ke ${currentLayout}...`))
                .catch(() => triggerPageReload(`Mengganti desain ke ${currentLayout}...`));
            } else {
                triggerPageReload(`Mengganti desain ke ${currentLayout}...`);
            }
        });
    });

    const langBtns = [document.getElementById('langToggle'), document.getElementById('langToggleMobile')];
    const langFlags = [document.getElementById('langFlag'), document.getElementById('langFlagMobile')];

    let currentLocale = htmlEl.lang || 'id';

    langBtns.forEach(btn => {
        btn?.addEventListener('click', () => {
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
                    triggerPageReload(`Mengganti bahasa tulisan ke ${nextLocale.toUpperCase()}...`, 300);
                }).catch(() => {
                    triggerPageReload(`Mengganti bahasa tulisan ke ${nextLocale.toUpperCase()}...`, 300);
                });
            } else {
                triggerPageReload(`Mengganti bahasa tulisan ke ${nextLocale.toUpperCase()}...`, 300);
            }
        });
    });

    function triggerPageReload(message, delay = 0) {
        if (window.triggerPageWipe) {
            window.triggerPageWipe(window.location.href, message);
        } else {
            setTimeout(() => window.location.reload(), delay);
        }
    }

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
<script>
document.addEventListener('DOMContentLoaded', () => {
    gsap.registerPlugin(ScrollTrigger);

    const navbar = document.querySelector('.paper-tab-nav');

    gsap.from(navbar, {
        y: -150,
        rotationZ: -2,
        opacity: 0,
        duration: 1,
        ease: "back.out(1.2)",
        delay: 0.2,
        clearProps: "all"
    });

    let isNavHidden = false;

    ScrollTrigger.create({
        start: "top top",
        end: "max",
        onUpdate: (self) => {
            if (self.direction === 1 && self.scroll() > 50) {
                if (!isNavHidden) {
                    gsap.to(navbar, {
                        y: -150,
                        rotationZ: 1,
                        duration: 0.35,
                        ease: "power2.inOut",
                        overwrite: "auto"
                    });
                    isNavHidden = true;
                }
            }

            else if (self.direction === -1 || self.scroll() <= 50) {
                if (isNavHidden || self.scroll() <= 50) {
                    gsap.to(navbar, {
                        y: 0,
                        rotationZ: 0,
                        duration: 0.35,
                        ease: "power2.out",
                        overwrite: "auto"
                    });
                    isNavHidden = false;
                }
            }
        }
    });
});
</script>
