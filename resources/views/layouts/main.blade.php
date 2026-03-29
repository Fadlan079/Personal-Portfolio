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
        html { scroll-behavior: smooth; }
        * { scrollbar-width: thin; scrollbar-color: var(--color-primary) transparent; }
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, color-mix(in srgb, var(--color-primary) 90%, white), var(--color-primary));
            border-radius: 999px; border: 2px solid transparent; background-clip: content-box;
        }
        ::selection {
            background: color-mix(in srgb, var(--color-primary) 25%, transparent); color: var(--color-primary);
        }
    </style>
    @stack ('head')
</head>
<body class="bg-bg text-text overflow-x-hidden">

    <x-navbar brand="Fadlan" :menus="[
        ['key' => 'nav.home', 'href' => route('portofolio.home')],
        ['key' => 'nav.about', 'href' => route('portofolio.about')],
        ['key' => 'nav.projects', 'href' => route('portofolio.projects')],
        ['key' => 'nav.contact', 'href' => route('portofolio.contact')],
    ]" />

    <div id="page-content-wrapper" class="w-full min-h-screen flex flex-col">

        <main id="content" class="relative z-10 flex-1">
            @if (!auth()->check())
                <a href="/login"
                class="hidden md:flex absolute -top-6 right-1 lg:right-8 z-50 flex-col items-center px-4 pt-12 pb-4 bg-[#E7F2FF] border-x border-b border-[#BDE0FE] text-blue-900 shadow-[2px_4px_8px_rgba(0,0,0,0.06)] rotate-[3deg] origin-top hover:rotate-0 hover:translate-y-4 transition-all duration-300 group rounded-b-md cursor-pointer">

                    <span class="text-[10px] font-bold uppercase tracking-widest" data-i18n="nav.login">Masuk</span>

                    <div class="w-2 h-2 rounded-full bg-blue-200/80 mt-2 shadow-[inset_1px_1px_2px_rgba(0,0,0,0.1)] border border-blue-300/50"></div>
                </a>
            @else

            <div class="hidden md:block absolute -top-6 right-1 lg:right-8 z-50 group w-20">
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

                <a href="{{ route('dashboard.home') }}" target="_blank" rel="noopener noreferrer"
                    class="absolute top-0 left-0 z-10 flex flex-col items-center w-full pt-12 pb-4
                    bg-[#FFF4E6] border border-t-0 border-[#FFD6A5] text-orange-900
                    shadow-[0_4px_8px_rgba(0,0,0,0.08)] rounded-b-md
                    origin-top rotate-[6deg] group-hover:rotate-0
                    group-hover:translate-y-[calc(100%-8px)]
                    transition-all duration-300 ease-out">

                    <span class="text-[10px] font-bold uppercase tracking-widest">Dasbor</span>
                    <div class="w-2 h-2 rounded-full bg-orange-200 mt-2 border border-orange-300/50"></div>
                </a>
            </div>
            @endif
            @yield('content')
        </main>

        @php
            $siteUser = \App\Models\User::first();
            $waRaw = $siteUser?->whatsapp;
            $waLink = $waRaw ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $waRaw) : '#';
            $igRaw = $siteUser?->instagram;
            $igLink = $igRaw ? (str_starts_with($igRaw, 'http') ? $igRaw : 'https://instagram.com/' . ltrim($igRaw, '@')) : '#';
            $ghRaw = $siteUser?->github;
            $ghLink = $ghRaw ? (str_starts_with($ghRaw, 'http') ? $ghRaw : 'https://github.com/' . ltrim($ghRaw, '@')) : '#';
            $liRaw = $siteUser?->linkedin;
            $liLink = $liRaw ? (str_starts_with($liRaw, 'http') ? $liRaw : 'https://linkedin.com/in/' . ltrim($liRaw, '@')) : '#';
            $emailLink = $siteUser?->email ? 'mailto:' . $siteUser->email : '#';
        @endphp

        <x-footer brand="Fadlan" :links="[
            ['key' => 'nav.home', 'href' => route('portofolio.home')],
            ['key' => 'nav.about', 'href' => route('portofolio.about')],
            ['key' => 'nav.projects', 'href' => route('portofolio.projects')],
            ['key' => 'nav.contact', 'href' => route('portofolio.contact')],
        ]" :socials="[
            ['icon' => 'fa-brands fa-github', 'href' => $ghLink],
            ['icon' => 'fa-brands fa-linkedin', 'href' => $liLink],
            ['icon' => 'fa-brands fa-instagram', 'href' => $igLink],
            ['icon' => 'fa-solid fa-envelope', 'href' => $emailLink],
            ['icon' => 'fa-brands fa-whatsapp', 'href' => $waLink],
        ]" />
    </div>

    <x-global-modal />
    <x-confirm-modal />

    @stack('script')

    <script>
        // Animasi transisi antar halaman dinonaktifkan untuk load lebih cepat
        document.addEventListener('DOMContentLoaded', () => {
            const body = document.body;
            body.classList.add('page-loaded');

            // Inisialisasi awal khusus untuk theme system jika dibutuhkan
            const prevLayout = localStorage.getItem('ui_layout') || 'diary';
            if (prevLayout === 'system' && window.gsapSystemEntry) {
                window.gsapSystemEntry();
            }

            const layoutBtn = document.getElementById('layoutToggleBtn');
            if(layoutBtn) {
                layoutBtn.addEventListener('click', () => {
                    setTimeout(() => {
                        window.location.reload();
                    }, 50);
                });
            }
        });
    </script>
</body>
</html>
