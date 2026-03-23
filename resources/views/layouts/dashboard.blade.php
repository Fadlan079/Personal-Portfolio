<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        (function() {
            var valid = ['diary', 'clean', 'system'];
            function getCookie(name) {
                var match = document.cookie.match(new RegExp('(?:^|; )' + name + '=([^;]*)'));
                return match ? decodeURIComponent(match[1]) : null;
            }

            var dbLayout = '{{ auth()->check() ? (auth()->user()->setting->design_theme ?? "diary") : "diary" }}';
            var legacyMap = { diary_book: 'diary', book: 'diary', system_architecture: 'system' };
            dbLayout = legacyMap[dbLayout] || (valid.includes(dbLayout) ? dbLayout : 'diary');

            var cookieLayout = getCookie('ui_layout');
            var savedLayout  = (cookieLayout && valid.includes(cookieLayout))
                ? cookieLayout
                : (localStorage.getItem('ui_layout') || dbLayout);

            if (!valid.includes(savedLayout)) savedLayout = 'diary';
            var savedTheme = localStorage.getItem('ui_theme') || 'light';
            if (savedTheme === 'system') {
                savedTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }

            document.documentElement.setAttribute('data-layout', savedLayout);
            document.documentElement.className = 'theme-' + savedTheme;

            localStorage.setItem('ui_layout', savedLayout);
            if (!cookieLayout || !valid.includes(cookieLayout)) {
                document.cookie = 'ui_layout=' + savedLayout + ';path=/;max-age=31536000;SameSite=Lax';
            }

            document.documentElement.classList.add('is-transitioning');
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons@7.2.1/css/flag-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <title>Fadlan | @yield('title')</title>

    <style>
        html {
            scroll-behavior: smooth;
            overflow-x: hidden;
            overflow-y: auto;
        }
        body {
            min-height: 100vh;
            overflow: visible;
        }
        html { scrollbar-width: thin; scrollbar-color: var(--color-primary) transparent; }
        html::-webkit-scrollbar { width: 10px; }
        html::-webkit-scrollbar-track { background: transparent; }
        html::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, color-mix(in srgb, var(--color-primary) 90%, white), var(--color-primary));
            border-radius: 999px; border: 2px solid transparent; background-clip: content-box;
        }
        ::-selection {
            background: color-mix(in srgb, var(--color-primary) 25%, transparent); color: var(--color-primary);
        }

        /* Transition Styles */
        html.is-transitioning #page-content-wrapper {
            opacity: 0;
            pointer-events: none;
        }

        body.trans-diary #page-content-wrapper {
            transform: translateY(15px);
            transition: opacity 0.6s ease-out, transform 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);
        }
        body.trans-diary.page-exiting #page-content-wrapper {
            transform: rotateY(-90deg);
            transform-origin: left center;
            transition: transform 0.6s ease-in-out, opacity 0.5s ease-in;
            opacity: 0;
        }
        body.trans-diary.page-loaded #page-content-wrapper {
            transform: rotateY(0deg);
            opacity: 1;
            transition: transform 0.6s ease-out, opacity 0.6s ease-out;
        }

        .trans-diary.page-loaded #page-content-wrapper {
            clip-path: inset(0 100% 0 0);
            animation: writeIn 0.8s forwards ease-out;
        }

        @keyframes writeIn {
            to { clip-path: inset(0 0 0 0); }
        }

        body.trans-clean #page-content-wrapper {
            transform: scale(0.98); filter: blur(4px);
            transition: opacity 0.5s ease-out, transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), filter 0.5s ease-out;
        }
        body.trans-clean.page-loaded #page-content-wrapper {
            opacity: 1; transform: scale(1); filter: blur(0); pointer-events: auto;
        }
        body.trans-clean.page-exiting #page-content-wrapper {
            opacity: 0; transform: scale(0.98); filter: blur(4px);
            transition: opacity 0.3s ease-in, transform 0.3s ease-in, filter 0.3s ease-in;
        }
        body.trans-system #page-content-wrapper {
            transform: skewX(-5deg); filter: contrast(1.5) brightness(1.2);
            transition: opacity 0.2s steps(3, end), transform 0.2s steps(2, end), filter 0.2s;
        }
        body.trans-system.page-loaded #page-content-wrapper {
            opacity: 1; transform: skewX(0); filter: contrast(1) brightness(1); pointer-events: auto;
        }
        body.trans-system.page-exiting #page-content-wrapper {
            opacity: 0; transform: skewX(5deg); filter: contrast(1.5) brightness(0.8);
            transition: opacity 0.15s steps(2, end), transform 0.15s, filter 0.15s;
        }

        .cta-bubble {
            position: absolute;
            top: 60%;
            left: 50%;
            width: 240%;
            height: 220%;
            background: var(--cta-bubble-color, var(--color-primary));
            border-radius: 50%;
            transform: translateX(-50%) scale(0);
            z-index: 0;
        }

        [data-i18n] {
            visibility: hidden;
        }

        .text-outline {
            color: transparent;
            -webkit-text-stroke: 1px var(--color-text);
            text-stroke: 1px var(--color-text);
        }

        .text-outline-muted {
            color: transparent;
            -webkit-text-stroke: 1px var(--color-muted);
        }
    </style>
    @stack('head')
</head>

<body class="bg-bg text-text">

    <div id="transition-indicator" class="fixed inset-0 z-8000 bg-bg pointer-events-none flex items-center justify-center opacity-0 transition-opacity duration-300">

        <div id="loader-diary" class="loader-variant hidden flex-col items-center justify-center transform translate-y-6 transition-transform duration-700 z-9999">
            <div class="relative bg-warning p-8 pt-10 border border-yellow-500 shadow-[8px_8px_20px_rgba(0,0,0,0.1)] transform rotate-2 w-64 max-w-[85vw] flex flex-col items-center justify-center font-serif">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-24 h-8 bg-black/10 backdrop-blur-[2px] border border-black/5 shadow-sm z-20 rotate-1"
                    style="clip-path: polygon(2% 10%, 98% 0%, 100% 95%, 0% 100%);">
                </div>
                <div class="relative w-16 h-16 flex items-center justify-center mb-6">
                    <i class="fa-solid fa-book-open text-yellow-900 text-4xl animate-pulse drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)]"></i>
                    <div class="absolute inset-0 rounded-full border-2 border-yellow-800 border-t-transparent animate-spin opacity-40"></div>
                    <div class="absolute inset-[-8px] rounded-full border border-yellow-800 border-b-transparent animate-[spin_2s_reverse_infinite] opacity-20"></div>
                </div>
                <span class="indicator-text font-bold text-sm uppercase tracking-widest text-yellow-900 text-center border-b border-dashed border-yellow-600/50 pb-2">
                    Membuka Halaman...
                </span>
                <div class="absolute bottom-0 right-0 w-6 h-6 bg-yellow-600 border-t border-l border-yellow-700 shadow-[-2px_-2px_4px_rgba(0,0,0,0.05)] z-10"
                    style="clip-path: polygon(100% 0, 0 100%, 100% 100%);">
                </div>
            </div>
        </div>

        <div id="loader-clean" class="loader-variant hidden flex-col items-center gap-3 z-[9999]">
            <span class="indicator-text bg-surface/90 backdrop-blur-xl text-primary px-8 py-4 rounded-full shadow-[0_10px_40px_-10px_var(--color-primary)] border border-primary/30 font-medium text-sm flex items-center gap-4 tracking-wide">
                <i class="fa-solid fa-circle-notch fa-spin text-primary text-xl"></i>
                Memuat...
            </span>
        </div>

        <div id="loader-system" class="loader-variant hidden flex-col items-center gap-2 z-[9999]">
            <span class="indicator-text bg-black/90 text-primary px-5 py-3 border border-primary/50 font-mono text-[11px] uppercase tracking-widest shadow-[0_0_20px_rgba(var(--color-primary-rgb),0.4)]">
                > FETCH_NODE: /...
            </span>
        </div>

    </div>

    <x-sidebar brand="Fadlan" :menuGroups="[
        'Monitoring' => [
            [
                'label' => 'Overview',
                'href' => route('dashboard.home'),
                'route' => 'dashboard.home',
                'icon' => 'fa-solid fa-house',
            ],
        ],
        'Portfolio' => [
            [
                'label' => 'Project',
                'href' => route('dashboard.projects.index'),
                'route' => 'dashboard.projects.*',
                'icon' => 'fa-solid fa-folder',
            ],
            [
                'label' => 'Skills',
                'href' => route('dashboard.skills.index'),
                'route' => 'dashboard.skills.*',
                'icon' => 'fa-solid fa-code-branch',
            ],
            [
                'label' => 'Contacts',
                'href' => route('dashboard.contacts.index'),
                'route' => 'dashboard.contacts.*',
                'icon' => 'fa-solid fa-satellite-dish',
            ],
        ],
        'System' => [
            [
                'label' => 'Trash',
                'href' => route('dashboard.trash'),
                'route' => 'dashboard.trash',
                'icon' => 'fa-solid fa-trash',
            ],
            [
                'label' => 'Account',
                'href' => route('dashboard.account.edit'),
                'route' => 'dashboard.account.*',
                'icon' => 'fa-solid fa-user-astronaut',
            ],
        ],
    ]" />

    <div id="page-content-wrapper" class="w-full">
        <main class="relative z-10 flex-1 md:ml-55">
            <div class="hidden md:block absolute -top-6 right-1 lg:right-8 z-50 group w-24">

                <form method="POST" action="/logout"
                    class="relative z-20 flex flex-col items-center w-full pt-12 pb-4
                    bg-[#E7F2FF] border border-t-0 border-[#BDE0FE] text-blue-900
                    shadow-[0_4px_8px_rgba(0,0,0,0.08)] rounded-b-md
                    origin-top rotate-[3deg] group-hover:rotate-0
                    transition-all duration-300 ease-out">
                    @csrf

                    <button class="text-[10px] font-bold uppercase tracking-widest">Keluar</button>
                    <div class="w-2 h-2 rounded-full bg-blue-200 mt-2 border border-blue-300/50"></div>
                </form>

                <a href="/" target="_blank" rel="noopener noreferrer"
                    class="absolute top-0 left-0 z-10 flex flex-col items-center w-full pt-12 pb-4
                    bg-[#FFF4E6] border border-t-0 border-[#FFD6A5] text-orange-900
                    shadow-[0_4px_8px_rgba(0,0,0,0.08)] rounded-b-md
                    origin-top rotate-[6deg] group-hover:rotate-0
                    group-hover:translate-y-[calc(100%-8px)]
                    transition-all duration-300 ease-out">

                    <span class="text-[10px] font-bold uppercase tracking-widest">Portfolio</span>
                    <div class="w-2 h-2 rounded-full bg-orange-200 mt-2 border border-orange-300/50"></div>
                </a>

            </div>

            @yield('content')
        </main>
    </div>

    <x-global-modal />
    <x-confirm-modal />

    @stack('scripts')

    <script>
        window.triggerPageWipe = function(targetUrl, forceMessage = null) {
            const body = document.body;
            let activeLayout = localStorage.getItem('ui_layout') || 'diary';

            let pathName = new URL(targetUrl).pathname.replace('/', '');
            let pageName = pathName === '' ? 'Beranda' : pathName;
            pageName = pageName.charAt(0).toUpperCase() + pageName.slice(1);

            let msg = forceMessage;

            if (activeLayout === 'system') {
                if(window.gsapSystemExit) return window.gsapSystemExit(targetUrl, forceMessage);
            }

            const indicatorOverlay = document.getElementById('transition-indicator');
            const variants = document.querySelectorAll('.loader-variant');

            if(!msg) {
                if(activeLayout === 'diary') msg = `Membuka Lembar: ${pageName}...`;
                if(activeLayout === 'clean') msg = `<i class="fa-solid fa-circle-notch fa-spin text-primary text-xl"></i> Memuat ${pageName}...`;
            }

            sessionStorage.setItem('nav_msg', msg);
            sessionStorage.setItem('nav_layout', activeLayout);

            variants.forEach(v => v.classList.add('hidden'));
            const activeLoader = document.getElementById('loader-' + activeLayout);
            if (activeLoader) {
                activeLoader.classList.remove('hidden');
                activeLoader.classList.add('flex');
                const textEl = activeLoader.querySelector('.indicator-text');
                if(textEl) textEl.innerHTML = msg;

                if(activeLayout === 'diary') {
                    activeLoader.classList.remove('translate-y-6');
                    setTimeout(() => activeLoader.classList.add('translate-y-0'), 50);
                }
            }

            indicatorOverlay.classList.remove('opacity-0', 'pointer-events-none');
            indicatorOverlay.classList.add('opacity-100', 'pointer-events-auto');

            body.classList.remove('page-loaded');
            body.classList.add('page-exiting');

            let exitDelay = 600;
            if(activeLayout === 'clean') exitDelay = 500;
            if(activeLayout === 'system') exitDelay = 300;

            setTimeout(() => {
                window.location.href = targetUrl;
            }, exitDelay);
        };

        document.addEventListener('DOMContentLoaded', () => {
            const body = document.body;
            const htmlEl = document.documentElement;
            const indicatorOverlay = document.getElementById('transition-indicator');
            const variants = document.querySelectorAll('.loader-variant');

            const currentLayout = localStorage.getItem('ui_layout') || 'diary';
            body.classList.add(`trans-${currentLayout}`);

            const navMsg = sessionStorage.getItem('nav_msg');
            const prevLayout = sessionStorage.getItem('nav_layout') || currentLayout;

            if (navMsg) {
                if(prevLayout === 'system') {
                    if(window.gsapSystemEntry) {
                       window.gsapSystemEntry();
                       htmlEl.classList.remove('is-transitioning');
                       body.classList.add('page-loaded');
                    }
                    sessionStorage.removeItem('nav_msg');
                    sessionStorage.removeItem('nav_layout');
                } else {
                    indicatorOverlay.classList.remove('opacity-0', 'pointer-events-none');
                    indicatorOverlay.classList.add('opacity-100', 'pointer-events-auto');

                    variants.forEach(v => v.classList.add('hidden'));
                    const activeLoader = document.getElementById('loader-' + prevLayout);
                    if (activeLoader) {
                        activeLoader.classList.remove('hidden');
                        activeLoader.classList.add('flex');
                        const textEl = activeLoader.querySelector('.indicator-text');
                        if(textEl) textEl.innerHTML = navMsg;
                    }

                    setTimeout(() => {
                        indicatorOverlay.classList.remove('opacity-100', 'pointer-events-auto');
                        indicatorOverlay.classList.add('opacity-0', 'pointer-events-none');
                        requestAnimationFrame(() => {
                            htmlEl.classList.remove('is-transitioning');
                            body.classList.add('page-loaded');
                            sessionStorage.removeItem('nav_msg');
                            sessionStorage.removeItem('nav_layout');
                        });
                    }, 800);
                }
            } else {
                if(prevLayout === 'system' && window.gsapSystemEntry) {
                   window.gsapSystemEntry();
                }
                requestAnimationFrame(() => {
                    htmlEl.classList.remove('is-transitioning');
                    body.classList.add('page-loaded');
                });
            }

            const links = document.querySelectorAll('a[href]:not([target="_blank"]):not([href^="#"]):not([href^="mailto:"]):not([href^="tel:"])');

            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (e.ctrlKey || e.metaKey || e.shiftKey || e.altKey) return;
                    if (this.hasAttribute('download') || this.hasAttribute('hx-get') || this.hasAttribute('hx-post') || this.classList.contains('no-transition')) return;

                    if (this.href.startsWith(window.location.origin)) {
                        e.preventDefault();
                        window.triggerPageWipe(this.href);
                    }
                });
            });

            const layoutBtn = document.getElementById('layoutToggleBtn');
            if(layoutBtn) {
                layoutBtn.addEventListener('click', () => {
                    const newLayout = localStorage.getItem('ui_layout');
                    if(newLayout){
                        body.classList.remove('trans-diary', 'trans-clean', 'trans-system');
                        body.classList.add(`trans-${newLayout}`);
                    }
                });
            }
        });
    </script>
</body>
</html>
