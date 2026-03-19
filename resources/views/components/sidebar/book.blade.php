<style>
    /* --- PAPER DIARY SIDEBAR STYLES --- */
    .paper-sidebar {
        background-color: #fdfcf5; /* Matches the target container color */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4' viewBox='0 0 4 4'%3E%3Cpath fill='%239C92AC' fill-opacity='0.05' d='M1 3h1v1H1V3zm2-2h1v1H3V1z'%3E%3C/path%3E%3C/svg%3E");
        border-right: 1px solid rgba(209, 213, 219, 0.7); /* border-gray-300/70 */
    }

    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

{{-- MOBILE HUD NAVBAR --}}
<nav class="paper-sidebar md:hidden fixed top-4 left-0 right-0 mx-auto z-30 w-[95%] border-2 border-gray-200/70 shadow-lg px-4 py-2 flex justify-between items-center rounded-xl">
    <div class="flex items-center gap-2">
        <h1 class="font-serif font-bold text-base text-neutral-800 italic">
            {{ $brand ?? 'MY_DIARY' }}
        </h1>
    </div>
    <button onclick="openSidebar()" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white text-gray-500 hover:text-gray-900 border border-gray-300/70 shadow-sm transition-colors">
        <i class="fa-solid fa-bars-staggered text-sm"></i>
    </button>
</nav>

<div class="md:hidden h-20 w-full"></div>

{{-- OVERLAY --}}
<div id="sidebarOverlay" onclick="closeSidebar()"
    class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[70] opacity-0 pointer-events-none transition-opacity duration-300 md:hidden">
</div>

{{-- DIARY SIDEBAR --}}
<aside id="dashboardSidebar"
    class="paper-sidebar fixed top-0 left-0 h-full w-[85%] max-w-[320px] md:w-55     flex flex-col transition-transform duration-300 ease-out -translate-x-full md:translate-x-0 z-[100] shadow-2xl rounded-r-3xl">

    {{-- Header --}}
    <div class="h-20 flex items-center justify-between px-6 border-b border-gray-300/70 shrink-0">
        <div class="flex items-center gap-3">
            <span class="font-bold text-base font-serif italic text-neutral-800">
                Menu Utama
            </span>
        </div>
        <button onclick="closeSidebar()" class="md:hidden w-10 h-10 flex items-center justify-center rounded-xl bg-white text-gray-500 hover:text-neutral-900 border border-gray-300/70 shadow-sm transition-colors">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto py-6 px-5 space-y-6 hide-scrollbar">
        @foreach ($menuGroups ?? [] as $groupName => $items)
            <div class="space-y-3">
                <p class="px-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    {{ $groupName }}
                </p>

                <div class="space-y-2 flex flex-col gap-2">
                    @foreach ($items as $index => $menu)
                        @php
                            $isActive = request()->routeIs($menu['route'] ?? '');
                            $iconClass = $menu['icon'] ?? 'fa-solid fa-bookmark';

                            // Replicated the randomized rotation mapping from the target design
                            $randomRotation = ['rotate-0', 'rotate-1', '-rotate-1', 'rotate-1'][$index % 4];

                            $linkClass = $isActive
                                ? 'bg-white text-amber-600 border-2 border-amber-600/30 rotate-0 translate-x-1'
                                : 'bg-white/70 text-gray-500 hover:bg-white hover:text-neutral-900 border border-gray-300/70 ' . $randomRotation;
                        @endphp
                        <a href="{{ $menu['href'] }}"
                            class="group relative flex items-center gap-4 px-3 py-2 rounded-xl font-bold text-sm transition-all duration-300 shadow-sm {{ $linkClass }}">
                            <i class="{{ $iconClass }} w-5 text-center {{ $isActive ? '' : 'opacity-70 group-hover:opacity-100' }}"></i>
                            <span>{{ $menu['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </nav>

    {{-- Bottom Area --}}
    <div class="p-6 border-t border-gray-300/70 bg-white/50 space-y-4">
        <div class="flex items-center gap-3 bg-white p-3 rounded-xl border border-gray-300/70 shadow-sm">
            <img src="{{ auth()->user()?->profile_photo_url ?? asset('profile.jpg') }}"
                class="w-10 h-10 rounded-lg border border-gray-200 object-cover">
            <div class="overflow-hidden">
                <p class="text-sm font-bold text-neutral-800 truncate">
                    {{ auth()->user()->name ?? 'User' }}
                </p>

            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center p-3 rounded-xl border border-gray-300/70 bg-white text-gray-600 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-colors shadow-sm text-sm font-bold">
                <i class="fa-solid fa-door-open mr-2"></i> Keluar
            </button>
        </form>
    </div>
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
