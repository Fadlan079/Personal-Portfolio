<style>
    /* --- MOBILE HUD NAVBAR STYLES (DASHBOARD EDITION) --- */
    .hud-navbar {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        background-color: color-mix(in srgb, var(--color-background) 85%, transparent);
        border: 1px solid color-mix(in srgb, var(--color-primary) 30%, transparent);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5), inset 0 0 0 1px rgba(255, 255, 255, 0.02);
    }

    .hud-brand {
        font-family: monospace;
        font-weight: 700;
        color: var(--color-primary);
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }

    /* Hide scrollbar tapi tetap bisa scroll */
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}

.hide-scrollbar {
    -ms-overflow-style: none;  /* IE & Edge lama */
    scrollbar-width: none;     /* Firefox */
}
</style>

{{-- ========================================== --}}
{{-- MOBILE HUD NAVBAR (Hanya muncul di HP)     --}}
{{-- ========================================== --}}
<nav class="md:hidden hud-navbar fixed top-4 left-1/2 -translate-x-1/2 w-[calc(100%-2rem)] z-30">

    {{-- Corner HUD Accents --}}
    <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-primary/80 pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-primary/80 pointer-events-none"></div>
    <div class="absolute top-0 right-0 w-8 h-[1px] bg-primary/50 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-8 h-[1px] bg-primary/50 pointer-events-none"></div>

    <div class="px-4 py-1.5 flex justify-between items-center">

        {{-- Brand / Init Sequence --}}
        <div class="flex items-center gap-2 cursor-default select-none group">
            <div class="w-1.5 h-4 bg-primary animate-pulse group-hover:scale-y-125 transition-transform duration-300">
            </div>
            <div class="flex flex-col">
                <h1 class="hud-brand text-xs sm:text-sm leading-none">
                    {{ $brand ?? 'SYS_ADMIN' }}
                </h1>
            </div>
        </div>

        {{-- Control Modules --}}
        <div class="flex items-center gap-4">
            {{-- Theme Toggle --}}
            <button onclick="toggleTheme()"
                class="text-muted hover:text-primary transition-colors flex items-center justify-center"
                title="Toggle UI Theme">
                <i id="themeIcon" class="fa-solid fa-moon text-sm"></i>
            </button>

            {{-- Lang Toggle --}}
            <button id="langToggle"
                class="text-muted hover:text-primary transition-colors flex items-center justify-center grayscale hover:grayscale-0"
                title="Switch Language">
                <span id="langFlag" class="fi fi-id w-4 h-3 rounded-sm"></span>
            </button>

            {{-- Mobile Trigger (Buka Sidebar Dashboard) --}}
            <button onclick="openSidebar()" class="text-primary hover:text-text transition-colors">
                <i class="fa-solid fa-bars-staggered text-lg"></i>
            </button>
        </div>
    </div>
</nav>

{{-- Spacer agar konten tidak tertutup navbar melayang di Mobile --}}
<div class="md:hidden h-20 w-full"></div>


{{-- MOBILE OVERLAY --}}
<div id="sidebarOverlay" onclick="closeSidebar()"
    class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 opacity-0 pointer-events-none transition-all duration-300 md:hidden">
</div>

{{-- DASHBOARD SIDEBAR (Dengan gaya Glassmorphism HUD) --}}
<aside id="dashboardSidebar"
    class="fixed top-0 left-0 h-full w-[80%] max-w-[300px] md:w-50 bg-background/95 backdrop-blur-2xl border-r border-border flex flex-col transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 z-50 shadow-2xl md:shadow-none">

    <div class="h-16 flex items-center justify-between px-6 border-b border-border/50 shrink-0">
        <div class="flex items-center gap-3">
            <div class="w-6 h-6 rounded bg-primary text-background flex items-center justify-center font-bold text-xs">
                <i class="fa-solid fa-terminal"></i>
            </div>
            <span class="font-mono text-sm font-bold tracking-widest text-text uppercase">
                {{ $brand ?? 'SYS_ADMIN' }}
            </span>
        </div>

        <button onclick="closeSidebar()"
            class="md:hidden w-8 h-8 flex items-center justify-center rounded-md text-muted hover:bg-surface hover:text-text transition-colors">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1 hide-scrollbar">

        @foreach ($menuGroups ?? [] as $groupName => $items)
            @php
                // Check if any item in this group is active
                $isGroupActive = collect($items)->contains(function ($item) {
                    return request()->routeIs($item['route'] ?? '');
                });
            @endphp
            <div class="sidebar-group" data-group="{{ Str::slug($groupName) }}">
                <button type="button"
                    class="w-full flex items-center justify-between px-2 py-1 mb-2 text-[10px] font-mono uppercase tracking-widest text-muted hover:text-text transition-colors group-toggle">
                    <span>{{ $groupName }}</span>
                    <i
                        class="fa-solid fa-chevron-down transition-transform duration-300 {{ $isGroupActive ? 'rotate-180' : '' }}"></i>
                </button>

                <div
                    class="menu-list space-y-1 overflow-hidden transition-all duration-300 ease-in-out origin-top {{ $isGroupActive ? 'max-h-[500px] opacity-100 mt-2' : 'max-h-0 opacity-0 mt-0 pointer-events-none' }}">
                    @foreach ($items as $menu)
                        @php
                            $isActive = request()->routeIs($menu['route'] ?? '');
                            $iconClass = $menu['icon'] ?? 'fa-solid fa-layer-group';
                            // Special animation logic for settings icon if exact match
                            $iconHoverClass = str_contains($iconClass, 'fa-gear')
                                ? 'group-hover:animate-[spin_3s_linear_infinite]'
                                : 'transform group-hover:scale-120 group-hover:-rotate-10';
                        @endphp
                        <a href="{{ $menu['href'] }}"
                            class="group relative flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-medium transition-all duration-200
                                  {{ $isActive ? 'bg-primary/10 text-primary border border-primary/30' : 'text-muted border border-transparent hover:bg-surface hover:border-border hover:text-text' }}">

                            @if ($isActive)
                                <span
                                    class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-4 bg-primary shadow-[0_0_8px_var(--color-primary)]"></span>
                            @endif

                            <i
                                class="w-5 text-center {{ $iconClass }} {{ $isActive ? 'text-primary' : 'text-muted group-hover:text-text' }} transition-all duration-300 {{ $iconHoverClass }}"></i>

                            <span
                                class="transition-transform duration-300 group-hover:translate-x-1 font-mono uppercase tracking-widest">{{ $menu['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach

    </nav>

    {{-- Bottom Action Area --}}
    <div class="p-6 border-t border-border/50 bg-background/50 shrink-0 space-y-4">

        {{-- Admin Identity Display --}}
        <div class="flex items-center gap-3 px-2 cursor-default">
            <div class="relative w-9 h-9 flex-shrink-0 flex items-center justify-center">
                <img src="{{ auth()->user()?->profile_photo_url ?? asset('profile.jpg') }}" 
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                    alt="Photo Profile"
                    class="w-full h-full rounded bg-surface border border-border/50 object-cover">
                
                <div style="display:none" class="flex items-center justify-center w-full h-full rounded bg-surface border border-primary/40">
                    <svg class="w-5 h-5 text-primary/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

            <div class="overflow-hidden">
                <p class="text-xs font-mono font-bold text-text truncate uppercase">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-[9px] font-mono text-primary uppercase tracking-widest flex items-center gap-1 mt-0.5">
                    <span class="w-1.5 h-1.5 bg-primary animate-pulse"></span>
                    Root_Access
                </p>
            </div>
        </div>

        {{-- Logout Button --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full group flex items-center justify-between px-4 py-3 rounded-none text-[10px] font-mono font-bold uppercase tracking-widest text-muted hover:bg-red-500/10 hover:text-red-500 transition-colors border border-border hover:border-red-500/30">
                <span>End_Session</span>
                <i class="fa-solid fa-power-off opacity-50 group-hover:opacity-100 group-hover:animate-pulse"></i>
            </button>
        </form>

    </div>
</aside>

<script>
    window.openSidebar = () => {
        document.getElementById('dashboardSidebar').classList.remove('-translate-x-full');
        const overlay = document.getElementById('sidebarOverlay');
        overlay.classList.remove('opacity-0', 'pointer-events-none');
    };

    window.closeSidebar = () => {
        document.getElementById('dashboardSidebar').classList.add('-translate-x-full');
        const overlay = document.getElementById('sidebarOverlay');
        overlay.classList.add('opacity-0', 'pointer-events-none');
    };

    document.querySelectorAll('.group-toggle').forEach(button => {
        button.addEventListener('click', () => {
            const container = button.nextElementSibling;
            const icon = button.querySelector('.fa-chevron-down');

            // Toggle classes
            if (container.classList.contains('max-h-0')) {
                // Open
                container.classList.remove('max-h-0', 'opacity-0', 'mt-0', 'pointer-events-none');
                container.classList.add('max-h-[500px]', 'opacity-100', 'mt-2');
                icon.classList.add('rotate-180');
            } else {
                // Close
                container.classList.add('max-h-0', 'opacity-0', 'mt-0', 'pointer-events-none');
                container.classList.remove('max-h-[500px]', 'opacity-100', 'mt-2');
                icon.classList.remove('rotate-180');
            }
        });
    });
</script>
