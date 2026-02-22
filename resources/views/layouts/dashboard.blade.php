<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
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
    </style>
</head>

<body id="mainBody"  class="bg-bg text-text overflow-x-hidden">
    <x-sidebar
        brand="Fadlan"
        :menus="[
        ['label' => 'Dashboard', 'href' => route('dashboard.home')],
        ['label' => 'Project', 'href' => route('dashboard.projects.index')],
        ['label' => 'Trash', 'href' => route('dashboard.trash')],
        ['label' => 'Setting', 'href' => route('dashboard.home')],
        ['label' => 'Account', 'href' => route('dashboard.home')],
        ]"
    />

    <x-global-modal />

    <main class="relative z-10 flex-1 md:ml-54 min-h-screen">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
