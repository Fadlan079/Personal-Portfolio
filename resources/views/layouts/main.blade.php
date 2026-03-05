<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons@7.2.1/css/flag-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <title>Fadlan | @yield('title')</title>
    <style>
        html {
            scroll-behavior: smooth;
        }

        * {
            scrollbar-width: thin;
            scrollbar-color: var(--color-primary) transparent;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg,
                    color-mix(in srgb, var(--color-primary) 90%, white),
                    var(--color-primary));
            border-radius: 999px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg,
                    color-mix(in srgb, var(--color-primary) 70%, white),
                    color-mix(in srgb, var(--color-primary) 90%, black));
        }

        ::selection {
            background: var(--color-primary);
            color: var(--color-text);
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
    <script>
        if (sessionStorage.getItem('sysTransition')) {
            document.documentElement.classList.add('hide-for-transition');
            document.write('<style id="sys-trans-style">body { visibility: hidden; }</style>');
        }
    </script>
</head>

<body class="bg-bg text-text overflow-x-hidden"
    data-cursor-theme="{{ auth()->check() ? auth()->user()->setting->cursor_theme ?? 'viewfinder' : 'viewfinder' }}"
    style="{{ auth()->check() && (auth()->user()->setting->cursor_theme ?? 'viewfinder') === 'native' ? 'cursor: auto;' : 'cursor: none;' }}">
    <!-- Invert Cursor (mix-blend-mode: difference) -->
    <div id="custom-cursor-container" class="fixed inset-0 pointer-events-none z-[9999]">

        <div class="cursor-theme" id="cursor-viewfinder">
            <div class="v-dot"></div>
            <div class="v-box">
                <div class="v-corner top-left"></div>
                <div class="v-corner top-right"></div>
                <div class="v-corner bottom-left"></div>
                <div class="v-corner bottom-right"></div>
            </div>
        </div>

        <div class="cursor-theme" id="cursor-blob">
            <div class="b-circle">
                <div class="b-plus"></div>
            </div>
            <div class="b-trail"></div>
        </div>

        <div class="cursor-theme" id="cursor-terminal">
            <div class="t-block"></div>
        </div>
    </div>

    <style>
        /* Base Setup */
        body:not([data-cursor-theme="native"]) *,
        body:not([data-cursor-theme="native"]) a,
        body:not([data-cursor-theme="native"]) button,
        body:not([data-cursor-theme="native"]) [role="button"],
        body:not([data-cursor-theme="native"]) input,
        body:not([data-cursor-theme="native"]) select,
        body:not([data-cursor-theme="native"]) textarea,
        body:not([data-cursor-theme="native"]) label {
            cursor: none !important;
        }

        .cursor-theme {
            display: none;
        }

        /* Hide all by default */
        body[data-cursor-theme="viewfinder"] #cursor-viewfinder {
            display: block;
        }

        body[data-cursor-theme="blob"] #cursor-blob {
            display: block;
        }

        body[data-cursor-theme="terminal"] #cursor-terminal {
            display: block;
        }

        /* --- THEME 1: VIEWFINDER --- */
        .v-dot {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--color-primary);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: transform 0.2s, background 0.2s, border 0.2s;
            will-change: left, top;
        }

        .v-box {
            position: absolute;
            width: 32px;
            height: 32px;
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s, transform 0.3s;
            will-change: left, top, width, height, transform;
        }

        .v-corner {
            position: absolute;
            width: 8px;
            height: 8px;
            border-color: color-mix(in srgb, var(--color-primary) 40%, transparent);
            border-style: solid;
            border-width: 0;
            transition: border-width 0.3s, border-color 0.3s;
        }

        .v-corner.top-left {
            top: 0;
            left: 0;
            border-top-width: 1px;
            border-left-width: 1px;
        }

        .v-corner.top-right {
            top: 0;
            right: 0;
            border-top-width: 1px;
            border-right-width: 1px;
        }

        .v-corner.bottom-left {
            bottom: 0;
            left: 0;
            border-bottom-width: 1px;
            border-left-width: 1px;
        }

        .v-corner.bottom-right {
            bottom: 0;
            right: 0;
            border-bottom-width: 1px;
            border-right-width: 1px;
        }

        /* Viewfinder Hover */
        .v-box.is-hovering {
            width: 48px;
            height: 48px;
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .v-box.is-hovering .v-corner {
            border-color: var(--color-primary);
            border-width: 2px;
        }

        .v-dot.is-hovering {
            transform: translate(-50%, -50%) scale(2.5);
            background: transparent;
            border: 1px solid var(--color-primary);
        }

        .v-box.is-clicking {
            width: 20px;
            height: 20px;
        }

        .v-dot.is-clicking {
            transform: translate(-50%, -50%) scale(0.5);
        }

        /* --- THEME 2: INVERTED BLOB --- */
        .b-circle {
            position: absolute;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #ffffff;
            transform: translate(-50%, -50%);
            mix-blend-mode: difference;
            transition: width 0.18s, height 0.18s;
            will-change: left, top;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .b-trail {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ffffff;
            transform: translate(-50%, -50%);
            mix-blend-mode: difference;
            will-change: left, top;
        }

        .b-plus {
            position: relative;
            width: 10px;
            height: 10px;
        }

        .b-plus::before,
        .b-plus::after {
            content: "";
            position: absolute;
            background: black;
        }

        .b-plus::before {
            top: 50%;
            left: 0;
            width: 100%;
            height: 2px;
            transform: translateY(-50%);
        }

        .b-plus::after {
            left: 50%;
            top: 0;
            height: 100%;
            width: 2px;
            transform: translateX(-50%);
        }

        /* Blob Hover */
        .b-circle.is-hovering {
            width: 56px;
            height: 56px;
        }

        .b-circle.is-clicking {
            width: 18px;
            height: 18px;
        }

        /* --- THEME 3: TERMINAL BLOCK --- */
        .t-block {
            position: absolute;
            width: 12px;
            height: 24px;
            background: var(--color-primary);
            transform: translate(0, -50%);
            mix-blend-mode: screen;
            will-change: left, top;
            transition: height 0.2s, transform 0.2s;
            animation: blink 1s step-end infinite;
        }

        @keyframes blink {
            50% {
                opacity: 0;
            }
        }

        /* Terminal Hover */
        .t-block.is-hovering {
            width: 24px;
            height: 2px;
            transform: translate(-50%, 12px);
            animation: none;
            background: var(--color-text);
        }
    </style>

    <script>
        (function() {
            const body = document.body;
            let mouseX = window.innerWidth / 2,
                mouseY = window.innerHeight / 2;

            // Viewfinder elements
            const vDot = document.querySelector('.v-dot');
            const vBox = document.querySelector('.v-box');
            let vBoxX = mouseX,
                vBoxY = mouseY;

            // Blob elements
            const bCircle = document.querySelector('.b-circle');
            const bTrail = document.querySelector('.b-trail');
            let bTrailX = mouseX,
                bTrailY = mouseY;

            // Terminal elements
            const tBlock = document.querySelector('.t-block');

            // Mouse Move
            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                const theme = body.getAttribute('data-cursor-theme');

                if (theme === 'viewfinder') {
                    vDot.style.left = mouseX + 'px';
                    vDot.style.top = mouseY + 'px';
                } else if (theme === 'blob') {
                    bCircle.style.left = mouseX + 'px';
                    bCircle.style.top = mouseY + 'px';
                } else if (theme === 'terminal') {
                    tBlock.style.left = mouseX + 'px';
                    tBlock.style.top = mouseY + 'px';
                }
            });

            // Physics Animation Loop (Lerp)
            function animateCursor() {
                const theme = body.getAttribute('data-cursor-theme');

                if (theme === 'viewfinder') {
                    vBoxX += (mouseX - vBoxX) * 0.15;
                    vBoxY += (mouseY - vBoxY) * 0.15;
                    vBox.style.left = vBoxX + 'px';
                    vBox.style.top = vBoxY + 'px';
                } else if (theme === 'blob') {
                    bTrailX += (mouseX - bTrailX) * 0.18;
                    bTrailY += (mouseY - bTrailY) * 0.18;
                    bTrail.style.left = bTrailX + 'px';
                    bTrail.style.top = bTrailY + 'px';
                }
                requestAnimationFrame(animateCursor);
            }
            animateCursor();

            // Hover Effects
            document.addEventListener('mouseover', (e) => {
                const clickable = e.target.closest(
                    'a, button, [role="button"], .device-btn, input, select, textarea, label');
                if (clickable) {
                    if (vDot) {
                        vDot.classList.add('is-hovering');
                        vBox.classList.add('is-hovering');
                    }
                    if (bCircle) {
                        bCircle.classList.add('is-hovering');
                    }
                    if (tBlock) {
                        tBlock.classList.add('is-hovering');
                    }
                } else {
                    if (vDot) {
                        vDot.classList.remove('is-hovering');
                        vBox.classList.remove('is-hovering');
                    }
                    if (bCircle) {
                        bCircle.classList.remove('is-hovering');
                    }
                    if (tBlock) {
                        tBlock.classList.remove('is-hovering');
                    }
                }
            });

            // Click Effects
            document.addEventListener('mousedown', () => {
                if (vDot) {
                    vDot.classList.add('is-clicking');
                    vBox.classList.add('is-clicking');
                }
                if (bCircle) {
                    bCircle.classList.add('is-clicking');
                }
            });
            document.addEventListener('mouseup', () => {
                if (vDot) {
                    vDot.classList.remove('is-clicking');
                    vBox.classList.remove('is-clicking');
                }
                if (bCircle) {
                    bCircle.classList.remove('is-clicking');
                }
            });
        })();
    </script>

    <x-navbar brand="Fadlan" :menus="[
        ['key' => 'nav.home', 'href' => route('portofolio.home')],
        ['key' => 'nav.about', 'href' => route('portofolio.about')],
        ['key' => 'nav.projects', 'href' => route('portofolio.projects')],
        ['key' => 'nav.contact', 'href' => route('portofolio.contact')],
    ]" />


    <main id="content" class="relative z-10">
        @yield('content')
    </main>

    <x-footer brand="Fadlan" :links="[
        ['key' => 'nav.home', 'href' => route('portofolio.home')],
        ['key' => 'nav.about', 'href' => route('portofolio.about')],
        ['key' => 'nav.projects', 'href' => route('portofolio.projects')],
        ['key' => 'nav.contact', 'href' => route('portofolio.contact')],
    ]" :socials="[
        ['icon' => 'fa-brands fa-github', 'href' => 'https://github.com/Fadlan079'],
        ['icon' => 'fa-brands fa-linkedin', 'href' => 'https://www.linkedin.com/in/fadlan-firdaus-148344386/'],
        ['icon' => 'fa-brands fa-instagram', 'href' => 'https://instagram.com/fdln007'],
        ['icon' => 'fa-solid fa-envelope', 'href' => 'mailto:fadlanfirdaus220@gmail.com'],
        ['icon' => 'fa-brands fa-whatsapp', 'href' => 'https://wa.me/6282210732928'],
    ]" />
    <x-global-modal />

    @yield('script')
</body>

</html>
