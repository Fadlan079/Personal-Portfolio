<div id="sidebarOverlay" onclick="closeSidebar()"
    class="fixed inset-0 bg-background/80 backdrop-blur-sm z-40 opacity-0 pointer-events-none transition-all duration-300 md:hidden">
</div>

<aside id="dashboardSidebar"
    class="fixed top-0 left-0 h-screen w-50 bg-surface border-r border-border flex flex-col transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 z-50 shadow-2xl md:shadow-none">

    <div class="h-16 flex items-center justify-between px-6 border-b border-border/50">
        <div class="flex items-center gap-3">
            <div class="w-6 h-6 rounded bg-primary text-background flex items-center justify-center font-bold text-xs">
                <i class="fa-solid fa-terminal"></i>
            </div>
            <span class="font-mono text-sm font-bold tracking-widest text-text uppercase">
                {{ $brand ?? 'SYS_ADMIN' }}
            </span>
        </div>

        <button onclick="closeSidebar()"
            class="md:hidden w-8 h-8 flex items-center justify-center rounded-md text-muted hover:bg-border hover:text-text transition-colors">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

<nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1 custom-scrollbar">
        <p class="px-2 text-[10px] font-mono uppercase tracking-widest text-muted mb-4">Core Modules</p>

        @foreach ($menus as $menu)
            @php
                $isActive = request()->routeIs($menu['route'] ?? '');
            @endphp

            <a href="{{ $menu['href'] }}"
                class="group relative flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                      {{ $isActive ? 'bg-primary/10 text-primary' : 'text-muted hover:bg-border/50 hover:text-text' }}">

                @if ($isActive)
                    <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-4 rounded-r-full bg-primary shadow-[0_0_8px_var(--color-primary)]"></span>
                @endif

                <i class="w-5 text-center {{ $menu['icon'] ?? 'fa-solid fa-layer-group' }} {{ $isActive ? 'text-primary' : 'text-muted group-hover:text-text' }} transition-all duration-300 group-hover:scale-125 group-hover:-translate-y-0.5"></i>
                
                <span class="transition-transform duration-300 group-hover:translate-x-1">{{ $menu['label'] }}</span>
            </a>
        @endforeach

        <div class="pt-6 mt-6 border-t border-border/50"></div>
        <p class="px-2 text-[10px] font-mono uppercase tracking-widest text-muted mb-4">System Config</p>

        @php
            $isSettingsActive = request()->routeIs('dashboard.settings'); 
        @endphp

        <a href="{{ route('dashboard.settings') }}" 
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                  {{ $isSettingsActive ? 'bg-primary/10 text-primary' : 'text-muted hover:bg-border/50 hover:text-text' }}">
            
            @if ($isSettingsActive)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-4 rounded-r-full bg-primary shadow-[0_0_8px_var(--color-primary)]"></span>
            @endif

            <i class="w-5 text-center fa-solid fa-gear {{ $isSettingsActive ? 'text-primary' : 'text-muted group-hover:text-text' }} transition-all duration-300 group-hover:animate-[spin_3s_linear_infinite]"></i>
            
            <span class="transition-transform duration-300 group-hover:translate-x-1">Settings</span>
        </a>
    </nav>

    <div class="p-4 border-t border-border/50 bg-background/50">

        <a href="{{ route('dashboard.account.edit') }}" class="flex items-center gap-3 px-2 mb-4">
            <img src="{{ auth()->user()?->profile_photo_url ?? asset('profile.jpg') }}" alt="Photo Profile"
                class="w-9 h-9 rounded-full bg-border flex items-center justify-center text-text font-bold text-sm border border-border/50">

            </img>
            <div class="overflow-hidden">
                <p class="text-sm font-medium text-text truncate">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-[10px] font-mono text-primary uppercase tracking-widest">
                    Root_Access
                </p>
            </div>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full group flex items-center justify-between px-3 py-2 rounded-lg text-xs font-mono uppercase tracking-widest text-muted hover:bg-red-500/10 hover:text-red-500 transition-colors border border-border hover:border-red-500/20">
                <span>Terminate Session</span>
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
</script>
