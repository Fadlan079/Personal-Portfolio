<aside
  id="dashboardSidebar"
  class="sidebar-glass fixed top-0 left-0
         h-screen w-52
         bg-surface/50
         border-r border-black/5
         shadow-[20px_0_40px_rgba(0,0,0,0.12)]
         transition-transform duration-300
         -translate-x-full md:translate-x-0
         z-50 rounded-r-2xl
         flex flex-col">

  <!-- Header -->
  <div class="h-16 px-6 flex items-center justify-between border-b border-black/5">
    <span class="text-lg font-semibold text-primary">
      {{ $brand ?? 'Dashboard' }}
    </span>

    <button onclick="closeSidebar()" class="md:hidden">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>

  <!-- Menu -->
  <nav class="p-4 flex flex-col gap-1 text-sm font-medium">
    @foreach ($menus as $menu)
      <a href="{{ $menu['href'] }}"
         class="px-4 py-2 rounded-xl hover:bg-surface transition">
        {{ $menu['label'] }}
      </a>
    @endforeach
  </nav>

  <!-- Logout (BOTTOM) -->
  <div class="mt-auto p-4 border-t border-black/5">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button
        type="submit"
        class="w-full px-4 py-2 rounded-xl
               text-red-500 hover:bg-red-500/10
               transition flex items-center gap-2">
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
