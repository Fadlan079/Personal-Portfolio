<aside
  id="dashboardSidebar"
  class="sidebar-glass fixed top-0 left-0
         h-screen w-50
         bg-surface/60 backdrop-blur-xl
         border-r border-black/5
         shadow-[20px_0_40px_rgba(0,0,0,0.12)]
         transition-transform duration-300
         -translate-x-full md:translate-x-0
         z-50 rounded-r-2xl
         flex flex-col">

  <!-- Header -->
  <div class="h-16 px-6 flex items-center justify-between">
    <span class="text-lg font-semibold text-primary tracking-wide">
      {{ $brand ?? 'Dashboard' }}
    </span>

    <button onclick="closeSidebar()" class="md:hidden text-muted hover:text-primary transition">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>

  <!-- Divider 1 -->
  <div class="px-6">
    <div class="h-px bg-gradient-to-r from-transparent via-border to-transparent"></div>
  </div>

  <!-- Menu -->
  <nav class="p-4 flex flex-col gap-2 text-sm font-medium flex-1 overflow-y-auto">

    @foreach ($menus as $menu)
      @php
        $isActive = request()->routeIs($menu['route'] ?? '');
      @endphp

      <a href="{{ $menu['href'] }}"
         class="group relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                {{ $isActive
                    ? 'bg-primary/10 text-primary'
                    : 'text-muted hover:bg-surface hover:text-primary'
                }}">

        @if($isActive)
          <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-primary"></span>
        @endif

        <i class="{{ $menu['icon'] ?? 'fa-regular fa-circle' }}"></i>
        <span>{{ $menu['label'] }}</span>
      </a>
    @endforeach

  </nav>

  <!-- Divider 2 -->
  <div class="px-6">
    <div class="h-px bg-gradient-to-r from-transparent via-border to-transparent"></div>
  </div>

  <!-- Bottom Section -->
  <div class="p-4 space-y-4">

    <!-- User Info -->
    <div class="text-sm">
      <p class="font-medium text-foreground">
        {{ auth()->user()->name }}
      </p>
        <p class="text-xs text-primary">
        Account Owner
        </p>
    </div>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button
        type="submit"
        class="w-full px-4 py-2 rounded-xl
               bg-red-500/10 text-red-500
               hover:bg-red-500 hover:text-white
               transition flex items-center justify-center gap-2">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
      </button>
    </form>

  </div>

</aside>


<div id="sidebarOverlay"
  onclick="closeSidebar()"
  class="fixed inset-0 bg-black/30 backdrop-blur-sm
         z-998 opacity-0 pointer-events-none transition md:hidden">
</div>

<script>
window.openSidebar = () => {
  dashboardSidebar.classList.remove('-translate-x-full');
  sidebarOverlay.classList.remove('opacity-0','pointer-events-none');
};

window.closeSidebar = () => {
  dashboardSidebar.classList.add('-translate-x-full');
  sidebarOverlay.classList.add('opacity-0','pointer-events-none');
};
</script>
