<style>
.sidebar-glass {
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
}
</style>

<aside
  id="dashboardSidebar"
  class="sidebar-glass
        rounded-r-2xl
         fixed md:static
         top-0 left-0
         h-screen w-50
         z-50

         bg-white/70 dark:bg-black/40
         border-r border-black/5 dark:border-white/10
         shadow-[20px_0_40px_rgba(0,0,0,0.12)]

         transition-transform duration-300
         -translate-x-full md:translate-x-0">

  <div class="h-16 px-6 flex items-center justify-between
              border-b border-black/5 dark:border-white/10">

    <span class="text-lg font-semibold text-primary tracking-tight">
      {{ $brand ?? 'Dashboard' }}
    </span>

    <button id="sidebarClose"
      class="md:hidden w-8 h-8 rounded-full
             bg-white/10 dark:bg-black/20
             border border-white/20
             flex items-center justify-center">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>

  <nav class="p-4 flex flex-col gap-1 text-[15px] font-medium">
    @foreach ($menus as $menu)
      <a href="{{ $menu['href'] }}"
         class="group flex items-center gap-3
                px-4 py-2.5 rounded-xl
                text-text/80

                hover:text-text
                hover:bg-white/40 dark:hover:bg-white/10
                transition">

        @isset($menu['icon'])
        <i class="fa-solid {{ $menu['icon'] }}
                  text-sm text-text/60
                  group-hover:text-primary transition"></i>
        @endisset

        <span>{{ $menu['label'] }}</span>

        <span
          class="ml-auto h-2 w-2 rounded-full
                 bg-primary/70
                 opacity-0 group-hover:opacity-100 transition">
        </span>
      </a>
    @endforeach

  </nav>

  <div class="absolute bottom-4 left-4 right-4
              p-4 rounded-2xl
              bg-white/40 dark:bg-black/30
              border border-white/20
              text-sm text-text/70">

    <div class="flex items-center gap-3">
      <div class="w-9 h-9 rounded-full bg-primary/20"></div>
      <div>
        <div class="font-semibold text-text">{{ auth()->user()->name ?? 'User' }}</div>
        <div class="text-xs opacity-70">Administrator</div>
      </div>
    </div>

  </div>

</aside>

<div id="sidebarOverlay"
  class="fixed inset-0 bg-black/30 backdrop-blur-sm
         z-40 opacity-0 pointer-events-none transition md:hidden">
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.getElementById('dashboardSidebar');
  const overlay = document.getElementById('sidebarOverlay');
  const close   = document.getElementById('sidebarClose');

  window.openSidebar = () => {
    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('opacity-0','pointer-events-none');
  };

  window.closeSidebar = () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('opacity-0','pointer-events-none');
  };

  close?.addEventListener('click', closeSidebar);
  overlay?.addEventListener('click', closeSidebar);
});
</script>
