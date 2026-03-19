{{-- CLEAN MODERN SIDEBAR --}}
<aside id="dashboardSidebar"
    class="fixed top-0 left-0 h-full w-[85%] max-w-[280px] md:w-64 bg-surface border-r border-white/5 flex flex-col transition-transform duration-300 md:translate-x-0 -translate-x-full z-50">
    
    <div class="h-20 flex items-center justify-between px-8 shrink-0">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-primary/10 flex items-center justify-center">
                <div class="w-2 h-2 bg-primary rounded-full animate-ping"></div>
            </div>
            <span class="text-white font-bold tracking-tight text-lg">
                {{ $brand ?? 'Modern' }}
            </span>
        </div>
        <button onclick="closeSidebar()" class="md:hidden text-white/40">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <nav class="flex-1 px-4 py-8 space-y-8 overflow-y-auto hide-scrollbar">
        @foreach ($menuGroups ?? [] as $groupName => $items)
            <div class="space-y-2">
                <span class="px-4 text-[10px] font-bold text-white/20 uppercase tracking-[0.2em]">
                    {{ $groupName }}
                </span>
                
                <div class="space-y-1">
                    @foreach ($items as $menu)
                        @php $isActive = request()->routeIs($menu['route'] ?? ''); @endphp
                        <a href="{{ $menu['href'] }}"
                            class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-300
                                  {{ $isActive ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                            <i class="{{ $menu['icon'] ?? 'fa-solid fa-square-full' }} text-sm {{ $isActive ? '' : 'opacity-40' }}"></i>
                            <span class="text-sm font-semibold">{{ $menu['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </nav>

    <div class="p-6 mt-auto">
        <div class="p-4 rounded-3xl bg-white/5 border border-white/5 flex items-center gap-3 mb-4">
             <img src="{{ auth()->user()?->profile_photo_url ?? asset('profile.jpg') }}" class="w-10 h-10 rounded-xl object-cover">
             <div class="overflow-hidden">
                 <p class="text-sm font-bold text-white truncate">{{ auth()->user()->name }}</p>
                 <p class="text-[10px] text-white/40 font-medium">Administrator</p>
             </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full py-3 rounded-2xl bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all font-bold text-xs uppercase tracking-widest">
                Logout
            </button>
        </form>
    </div>
</aside>

{{-- Mobile Top Bar --}}
<nav class="md:hidden fixed top-0 left-0 w-full h-16 bg-surface/80 backdrop-blur-xl border-b border-white/5 px-6 flex items-center justify-between z-40">
    <span class="text-white font-bold tracking-tight">{{ $brand }}</span>
    <button onclick="openSidebar()" class="text-white">
        <i class="fa-solid fa-bars-staggered"></i>
    </button>
</nav>

{{-- Overlay --}}
<div id="sidebarOverlay" onclick="closeSidebar()" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 opacity-0 pointer-events-none transition-opacity duration-300 md:hidden"></div>

<script>
    window.openSidebar = () => {
        document.getElementById('dashboardSidebar').classList.remove('-translate-x-full');
        document.getElementById('sidebarOverlay').classList.remove('opacity-0', 'pointer-events-none');
    };
    window.closeSidebar = () => {
        document.getElementById('dashboardSidebar').classList.add('-translate-x-full');
        document.getElementById('sidebarOverlay').classList.add('opacity-0', 'pointer-events-none');
    };
</script>
