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

<body class="bg-bg text-text overflow-x-hidden" style="cursor: none;">
    <!-- Invert Cursor (mix-blend-mode: difference) -->
 <div id="sys-cursor-dot"></div>
    <div id="sys-cursor-box">
        <div class="sys-corner top-left"></div>
        <div class="sys-corner top-right"></div>
        <div class="sys-corner bottom-left"></div>
        <div class="sys-corner bottom-right"></div>
    </div>

    <style>
        /* Sembunyikan kursor bawaan */
        *, a, button, [role="button"], input, select, textarea, label, .device-btn {
            cursor: none !important;
        }

        /* Titik Presisi di Tengah */
        #sys-cursor-dot {
            position: fixed;
            top: 0; left: 0;
            width: 4px; height: 4px;
            background: var(--color-primary);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 9999;
            box-shadow: 0 0 10px var(--color-primary);
            transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275), background 0.2s, border 0.2s;
            will-change: left, top;
        }

        /* Kotak Scanner/Viewfinder di Luar */
        #sys-cursor-box {
            position: fixed;
            top: 0; left: 0;
            width: 32px; height: 32px;
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 9998;
            transition: width 0.3s ease, height 0.3s ease, transform 0.3s ease;
            will-change: left, top, width, height, transform;
        }

        /* 4 Sudut Viewfinder (Brackets) */
        .sys-corner {
            position: absolute;
            width: 8px; height: 8px;
            border-color: color-mix(in srgb, var(--color-primary) 40%, transparent);
            border-style: solid;
            border-width: 0;
            transition: border-color 0.3s, border-width 0.3s;
        }
        .top-left { top: 0; left: 0; border-top-width: 1px; border-left-width: 1px; }
        .top-right { top: 0; right: 0; border-top-width: 1px; border-right-width: 1px; }
        .bottom-left { bottom: 0; left: 0; border-bottom-width: 1px; border-left-width: 1px; }
        .bottom-right { bottom: 0; right: 0; border-bottom-width: 1px; border-right-width: 1px; }

        /* =========================================
           HOVER STATES (Saat kena tombol/link)
           ========================================= */
        #sys-cursor-box.is-hovering {
            width: 48px; 
            height: 48px;
            /* Berputar jadi diamond */
            transform: translate(-50%, -50%) rotate(45deg); 
        }
        #sys-cursor-box.is-hovering .sys-corner {
            border-color: var(--color-primary);
            border-width: 2px;
        }

        #sys-cursor-dot.is-hovering {
            transform: translate(-50%, -50%) scale(2.5);
            background: transparent;
            border: 1px solid var(--color-primary);
            box-shadow: inset 0 0 8px color-mix(in srgb, var(--color-primary) 30%, transparent);
        }

        /* =========================================
           CLICK STATES (Saat mouse ditekan)
           ========================================= */
        #sys-cursor-box.is-clicking {
            width: 20px; 
            height: 20px;
        }
        #sys-cursor-dot.is-clicking {
            transform: translate(-50%, -50%) scale(0.5);
        }
    </style>

    <script>
        (function() {
            const dot = document.getElementById('sys-cursor-dot');
            const box = document.getElementById('sys-cursor-box');
            
            let mouseX = window.innerWidth / 2, mouseY = window.innerHeight / 2;
            let boxX = mouseX, boxY = mouseY;
            let isVisible = false;

            // Update koordinat mouse
            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                
                // Titik tengah pindah instan (tanpa delay) untuk presisi klik
                dot.style.left = mouseX + 'px';
                dot.style.top = mouseY + 'px';

                if (!isVisible) {
                    dot.style.opacity = '1';
                    box.style.opacity = '1';
                    isVisible = true;
                }
            });

            document.addEventListener('mouseleave', () => {
                dot.style.opacity = '0';
                box.style.opacity = '0';
                isVisible = false;
            });

            // Animasi lerp untuk kotak luar (delay mengikuti mouse)
            function renderBox() {
                // Kecepatan ngikutin mouse (0.15 = smooth delay)
                boxX += (mouseX - boxX) * 0.15;
                boxY += (mouseY - boxY) * 0.15;
                
                box.style.left = boxX + 'px';
                box.style.top = boxY + 'px';
                
                requestAnimationFrame(renderBox);
            }
            renderBox();

            // Efek Hover pada elemen yang bisa diklik
            document.addEventListener('mouseover', (e) => {
                const clickable = e.target.closest('a, button, [role="button"], .device-btn, input, select, textarea, label');
                if (clickable) {
                    dot.classList.add('is-hovering');
                    box.classList.add('is-hovering');
                } else {
                    dot.classList.remove('is-hovering');
                    box.classList.remove('is-hovering');
                }
            });

            // Efek saat diklik
            document.addEventListener('mousedown', () => {
                dot.classList.add('is-clicking');
                box.classList.add('is-clicking');
            });
            document.addEventListener('mouseup', () => {
                dot.classList.remove('is-clicking');
                box.classList.remove('is-clicking');
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
