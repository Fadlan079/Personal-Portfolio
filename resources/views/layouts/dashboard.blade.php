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

        .cursor-plus {
            position: relative;
            width: 10px;
            height: 10px;
        }

        .cursor-plus::before,
        .cursor-plus::after {
            content: "";
            position: absolute;
            background: black;
            /* supaya kontras dengan white blob */
        }

        /* Horizontal */
        .cursor-plus::before {
            top: 50%;
            left: 0;
            width: 100%;
            height: 2px;
            transform: translateY(-50%);
        }

        /* Vertical */
        .cursor-plus::after {
            left: 50%;
            top: 0;
            height: 100%;
            width: 2px;
            transform: translateX(-50%);
        }
    </style>

    <script>
        (function() {
            // Get user's saved preferences from Laravel (fallback to 'system')
            const userTheme = '{{ auth()->check() ? auth()->user()->theme : 'system' }}';
            const userLocale = '{{ auth()->check() && auth()->user()->locale ? auth()->user()->locale : '' }}';

            // Sync Database values to Frontend Storage (so app.js respects them)
            localStorage.setItem('theme', userTheme);
            if (userLocale) {
                localStorage.setItem('locale', userLocale);
                document.cookie = `locale=${userLocale};path=/;max-age=31536000`;
            }

            function applyTheme(theme) {
                if (theme === 'dark') {
                    document.documentElement.classList.add('theme-dark');
                    document.documentElement.classList.remove('theme-light');
                } else if (theme === 'light') {
                    document.documentElement.classList.add('theme-light');
                    document.documentElement.classList.remove('theme-dark');
                } else {
                    // System preference
                    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        document.documentElement.classList.add('theme-dark');
                        document.documentElement.classList.remove('theme-light');
                    } else {
                        document.documentElement.classList.add('theme-light');
                        document.documentElement.classList.remove('theme-dark');
                    }
                }
            }

            applyTheme(userTheme);

            // Listen for system theme changes if set to system
            if (userTheme === 'system') {
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                    if (e.matches) {
                        document.documentElement.classList.add('theme-dark');
                        document.documentElement.classList.remove('theme-light');
                    } else {
                        document.documentElement.classList.add('theme-light');
                        document.documentElement.classList.remove('theme-dark');
                    }
                });
            }
        })();
    </script>
</head>

<body id="mainBody" class="bg-bg text-text overflow-x-hidden" style="cursor: none;">
    <!-- Invert Cursor (mix-blend-mode: difference) -->
    <div id="cursor-blob"
        style="
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
        display: flex;
        align-items: center;
        justify-content: center;
    ">
        <div class="cursor-plus"></div>
    </div>
    <div id="cursor-trail"
        style="
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
    ">
    </div>
    <style>
        *,
        a,
        button,
        [role="button"],
        input,
        select,
        textarea,
        label,
        .device-btn {
            cursor: none !important;
        }
    </style>
    <script>
        (function() {
            const blob = document.getElementById('cursor-blob');
            const trail = document.getElementById('cursor-trail');
            let mouseX = 0,
                mouseY = 0;
            let trailX = 0,
                trailY = 0;
            let visible = false;

            document.addEventListener('mousemove', function(e) {
                mouseX = e.clientX;
                mouseY = e.clientY;
                blob.style.left = mouseX + 'px';
                blob.style.top = mouseY + 'px';
                if (!visible) {
                    blob.style.opacity = '1';
                    trail.style.opacity = '1';
                    visible = true;
                }
            });

            document.addEventListener('mouseleave', function() {
                blob.style.opacity = '0';
                trail.style.opacity = '0';
                visible = false;
            });

            function animate() {
                trailX += (mouseX - trailX) * 0.18;
                trailY += (mouseY - trailY) * 0.18;
                trail.style.left = trailX + 'px';
                trail.style.top = trailY + 'px';
                requestAnimationFrame(animate);
            }
            animate();

            document.addEventListener('mouseover', function(e) {
                const el = e.target.closest(
                    'a, button, [role="button"], .device-btn, input, select, textarea, label');
                if (el) {
                    blob.style.width = '56px';
                    blob.style.height = '56px';
                } else {
                    blob.style.width = '28px';
                    blob.style.height = '28px';
                }
            });

            document.addEventListener('mousedown', function() {
                blob.style.width = '18px';
                blob.style.height = '18px';
            });
            document.addEventListener('mouseup', function() {
                blob.style.width = '28px';
                blob.style.height = '28px';
            });
        })();
    </script>
    <x-sidebar brand="Fadlan" :menus="[
        [
            'label' => 'Overview',
            'href' => route('dashboard.home'),
            'route' => 'dashboard.home',
            'icon' => 'fa-solid fa-house',
        ],
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
            'label' => 'Trash',
            'href' => route('dashboard.trash'),
            'route' => 'dashboard.trash',
            'icon' => 'fa-solid fa-trash',
        ],
    
        // [
        //     'label' => 'Setting',
        //     'href'  => route('dashboard.settings'),
        //     'route' => 'dashboard.settings*',
        //     'icon'  => 'fa-solid fa-gear'
        // ],
    ]" />

    <x-global-modal />
    <x-confirm-modal />

    <main class="relative z-10 flex-1 md:ml-54 min-h-screen">
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>
