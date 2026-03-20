<style>
    .paper-sidebar {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4' viewBox='0 0 4 4'%3E%3Cpath fill='%239C92AC' fill-opacity='0.05' d='M1 3h1v1H1V3zm2-2h1v1H3V1z'%3E%3C/path%3E%3C/svg%3E");
    }

    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<nav class="paper-sidebar md:hidden fixed top-4 left-0 right-0 mx-auto z-30 w-[95%] bg-container border-2 border-border shadow-lg px-4 py-2 flex justify-between items-center rounded-xl">
    <div class="flex items-center gap-2">
        <h1 class="font-serif font-bold text-base text-text italic">
            {{ $brand ?? 'MY_DIARY' }}
        </h1>
    </div>
    <button onclick="openSidebar()" class="w-10 h-10 rounded-xl flex items-center bg-white border border-gray-300/70 shadow-sm justify-center text-neutral-900 transition-colors shrink-0 ml-2">
        <i class="fa-solid fa-bars-staggered text-sm"></i>
    </button>
</nav>

<div class="md:hidden h-20 w-full"></div>

<div id="sidebarOverlay" onclick="closeSidebar()"
    class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[70] opacity-0 pointer-events-none transition-opacity duration-300 md:hidden">
</div>

<aside id="dashboardSidebar"
    class="paper-sidebar bg-container fixed top-0 left-0 h-full w-[85%] max-w-[320px] md:w-55 flex flex-col transition-transform duration-300 ease-out -translate-x-full md:translate-x-0 z-50 shadow-2xl rounded-r-3xl border-r border-border">

    <div class="h-15 flex items-center justify-between px-6 border-b border-border shrink-0">
        <div class="flex items-center gap-3">
            <span class="font-bold text-base font-serif italic text-text">
                Menu Utama
            </span>
        </div>
        <button onclick="closeSidebar()" class="md:hidden w-10 h-10 flex items-center justify-center rounded-xl bg-white text-muted hover:text-neutral-900 transition-colors border border-gray-300/70 shadow-sm">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 px-5 space-y-3 hide-scrollbar">
        @foreach ($menuGroups ?? [] as $groupName => $items)
            <div class="space-y-3">
                <p class="px-2 text-[10px] font-bold text-muted uppercase tracking-widest">
                    {{ $groupName }}
                </p>

                <div class="space-y-2 flex flex-col gap-2">
                    @foreach ($items as $index => $menu)
                        @php
                            $isActive = request()->routeIs($menu['route'] ?? '');
                            $iconClass = $menu['icon'] ?? 'fa-solid fa-bookmark';
                            $randomRotation = ['rotate-0', 'rotate-1', '-rotate-1', 'rotate-1'][$index % 4];

                            $linkClass = $isActive
                                ? 'bg-white text-primary border-2 border-primary/30 rotate-0 translate-x-1'
                                : 'bg-surface/70 text-muted hover:bg-white hover:text-primary border border-primary/70 ' . $randomRotation;
                        @endphp
                        <a href="{{ $menu['href'] }}"
                            class="group relative flex items-center gap-5 px-3 py-2 rounded-xl font-bold text-sm transition-all duration-300 shadow-sm {{ $linkClass }}">
                            <i class="{{ $iconClass }} w-5 text-center {{ $isActive ? '' : 'opacity-70 group-hover:opacity-100' }}"></i>
                            <span>{{ $menu['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
        <div class="mt-6 pt-3 border-t border-gray-300/70">
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
    </nav>


</aside>

<script>
    window.openSidebar = () => {
        const sidebar = document.getElementById('dashboardSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('opacity-0', 'pointer-events-none');
    };

    window.closeSidebar = () => {
        const sidebar = document.getElementById('dashboardSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('opacity-0', 'pointer-events-none');
    };
</script>
