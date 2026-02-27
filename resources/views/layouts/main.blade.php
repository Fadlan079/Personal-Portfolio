<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons@7.2.1/css/flag-icons.min.css"/>
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
        background: linear-gradient(
            180deg,
            color-mix(in srgb, var(--color-primary) 90%, white),
            var(--color-primary)
        );
        border-radius: 999px;
        border: 2px solid transparent;
        background-clip: content-box;
        }

        ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(
            180deg,
            color-mix(in srgb, var(--color-primary) 70%, white),
            color-mix(in srgb, var(--color-primary) 90%, black)
        );
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

        /* .page-texture {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background-image:
                linear-gradient(to right, var(--color-surface) 1px, transparent 1px),
                linear-gradient(to bottom, var(--color-surface) 1px, transparent 1px);
            background-size: 60px 60px;
        } */

                /* .page-texture {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 0;
        background-image:
            radial-gradient(rgba(255,255,255,0.03) 1px, transparent 1px);
        background-size: 20px 20px; /* jarak antar titik */
        } */

</style>
</head>
<body class="bg-bg text-text overflow-x-hidden" style="cursor: none;">
    <!-- Invert Cursor (mix-blend-mode: difference) -->
    <div id="cursor-blob" style="
        position: fixed;
        pointer-events: none;
        z-index: 9999;
        top: 0; left: 0;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #ffffff;
        transform: translate(-50%, -50%);
        mix-blend-mode: difference;
        transition: opacity 0.3s ease, width 0.18s ease, height 0.18s ease;
        opacity: 0;
        will-change: left, top;
    "></div>
    <div id="cursor-trail" style="
        position: fixed;
        pointer-events: none;
        z-index: 9998;
        top: 0; left: 0;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #ffffff;
        transform: translate(-50%, -50%);
        mix-blend-mode: difference;
        transition: opacity 0.3s ease;
        opacity: 0;
        will-change: left, top;
    "></div>
    <style>
        *, a, button, [role="button"], input, select, textarea, label, .device-btn {
            cursor: none !important;
        }
    </style>
    <script>
        (function() {
            const blob  = document.getElementById('cursor-blob');
            const trail = document.getElementById('cursor-trail');
            let mouseX = 0, mouseY = 0;
            let trailX = 0, trailY = 0;
            let visible = false;

            document.addEventListener('mousemove', function(e) {
                mouseX = e.clientX;
                mouseY = e.clientY;
                blob.style.left = mouseX + 'px';
                blob.style.top  = mouseY + 'px';
                if (!visible) {
                    blob.style.opacity  = '1';
                    trail.style.opacity = '1';
                    visible = true;
                }
            });

            document.addEventListener('mouseleave', function() {
                blob.style.opacity  = '0';
                trail.style.opacity = '0';
                visible = false;
            });

            // Small trailing dot
            function animate() {
                trailX += (mouseX - trailX) * 0.18;
                trailY += (mouseY - trailY) * 0.18;
                trail.style.left = trailX + 'px';
                trail.style.top  = trailY + 'px';
                requestAnimationFrame(animate);
            }
            animate();

            // Expand on hover over clickable elements
            document.addEventListener('mouseover', function(e) {
                const el = e.target.closest('a, button, [role="button"], .device-btn, input, select, textarea, label');
                if (el) {
                    blob.style.width  = '56px';
                    blob.style.height = '56px';
                } else {
                    blob.style.width  = '28px';
                    blob.style.height = '28px';
                }
            });

            // Shrink on click
            document.addEventListener('mousedown', function() {
                blob.style.width  = '18px';
                blob.style.height = '18px';
            });
            document.addEventListener('mouseup', function() {
                blob.style.width  = '28px';
                blob.style.height = '28px';
            });
        })();
    </script>
    <div class="page-texture"></div>
    <x-navbar
    brand="Fadlan"
    :menus="[
        ['key' => 'nav.home', 'href' => route('portofolio.home')],
        ['key' => 'nav.about', 'href' => route('portofolio.about')],
        ['key' => 'nav.projects', 'href' => route('portofolio.projects')],
        ['key' => 'nav.contact', 'href' => route('portofolio.contact')],
    ]"
    />


    <main id="content" class="relative z-10">
        @yield('content')
    </main>

    <x-footer
    brand="Fadlan"
    :links="[
        ['key' => 'nav.home', 'href' => route('portofolio.home')],
        ['key' => 'nav.about', 'href' => route('portofolio.about')],
        ['key' => 'nav.projects', 'href' => route('portofolio.projects')],
        ['key' => 'nav.contact', 'href' => route('portofolio.contact')],
    ]"
    :socials="[
        ['icon' => 'fa-brands fa-github', 'href' => 'https://github.com/Fadlan079'],
        ['icon' => 'fa-brands fa-linkedin', 'href' => 'https://www.linkedin.com/in/fadlan-firdaus-148344386/'],
        ['icon' => 'fa-brands fa-instagram', 'href' => 'https://instagram.com/fdln007'],
        ['icon' => 'fa-solid fa-envelope', 'href' => 'mailto:fadlanfirdaus220@gmail.com'],
        ['icon' => 'fa-brands fa-whatsapp', 'href' => 'https://wa.me/6282210732928'],
    ]"
    />
    <x-global-modal />

    @yield('script')
</body>
</html>
