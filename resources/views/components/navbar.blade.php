<style>
.nav-float {
  transform-origin: top center;
  will-change: transform;
}
</style>

<nav class="nav-float fixed top-6 left-1/2 -translate-x-1/2
    w-[calc(100%-2rem)] max-w-5xl
    md:w-[90%] md:max-w-3xl

bg-white/70 dark:bg-black/40
backdrop-blur-xl
border border-black/5 dark:border-white/10
shadow-[0_10px_40px_rgba(0,0,0,0.12)]
    z-50">

  <div class="px-4 py-1 flex justify-between items-center">

    <h1 class="text-lg font-semibold text-primary/90 tracking-tight">
      {{ $brand ?? 'App' }}
    </h1>

    <ul class="hidden md:flex gap-8 text-[15px] font-medium">

      @foreach ($menus as $menu)
        <li class="relative group">
            <a href="{{ $menu['href'] }}"
            data-i18n="{{ $menu['key'] }}"
              class="relative text-text/80 hover:text-text transition">
            </a>
<span
  class="absolute left-1/2 -bottom-1 h-0.5 w-0
         -translate-x-1/2
         bg-primary/70
         rounded-full
         transition-all duration-300
         group-hover:w-6">
</span>


        </li>
      @endforeach
    </ul>

    <div class="flex items-center gap-2">
        <button onclick="toggleTheme()"
class="w-9 h-9 rounded-full
       bg-white/10 dark:bg-black/20
       backdrop-blur-md
       border border-white/20
       shadow-inner shadow-white/10
       flex items-center justify-center
       hover:bg-white/20 transition">
            <i id="themeIcon" class="fa-solid fa-moon"></i>
        </button>

        <button id="langToggle"
class="w-9 h-9 rounded-full
       bg-white/10 dark:bg-black/20
       backdrop-blur-md
       border border-white/20
       shadow-inner shadow-white/10
       flex items-center justify-center
       hover:bg-white/20 transition"

        aria-label="Toggle language">

    <span id="langFlag"
            class="fi fi-id w-6 h-4 rounded-sm"></span>
    </button>

      <button id="mobileMenuBtn"
        class="md:hidden w-9 h-9 rounded-full
       bg-white/10 dark:bg-black/20
       backdrop-blur-md
       border border-white/20
       shadow-inner shadow-white/10
       flex items-center justify-center
       hover:bg-white/20 transition">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>

  </div>
</nav>

<div id="mobileOverlay"
  class="fixed inset-0
         bg-black/30 backdrop-blur-sm
         z-40 opacity-0 pointer-events-none transition">
</div>


<aside id="mobileSidebar"
  class="fixed top-0 left-0 h-full w-72
         bg-white/10 dark:bg-black/25
         backdrop-blur-2xl
         border-r border-white/20
         shadow-[16px_0_40px_rgba(0,0,0,0.3)]
         z-50
         -translate-x-full pointer-events-none
         transition-transform duration-300
         rounded-r-3xl">


<div class="p-6 flex justify-between items-center
            border-b border-white/20">

    <span class="font-bold text-lg text-primary">
      {{ $brand ?? 'App' }}
    </span>

    <button id="mobileCloseBtn" class="text-xl">
      <i class="fa-solid fa-xmark"></i>
    </button>
  </div>

  <nav class="p-6 flex flex-col gap-4 text-sm">
    @foreach ($menus as $menu)
<a href="{{ $menu['href'] }}"
   data-i18n="{{ $menu['key'] }}"
   class="block py-2 px-3 rounded-xl
          bg-white/0
          hover:bg-white/15
          transition backdrop-blur-sm">
</a>

    @endforeach
        <div class="flex justify-center">
            @if (!session('is_login'))
                <a
                    href="/login"
                    class="w-full cta-btn relative overflow-hidden px-4 py-2
                        border-2 border-border text-text font-semibold"
                    style="--cta-bubble-color: var(--color-primary);">

                    <span class="cta-bubble"></span>
                    <span class="cta-text relative z-10">Login</span>
                </a>
            @else
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="w-full cta-btn relative overflow-hidden px-8 py-3
                            border-2 border-border text-text font-semibold"
                        style="--cta-bubble-color: #ef4444;">

                        <span class="cta-bubble"></span>
                        <span class="cta-text relative z-10">Logout</span>
                    </button>
                </form>
            @endif
        </div>
  </nav>
</aside>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const openBtn  = document.getElementById('mobileMenuBtn');
  const closeBtn = document.getElementById('mobileCloseBtn');
  const sidebar  = document.getElementById('mobileSidebar');
  const overlay  = document.getElementById('mobileOverlay');

  function openSidebar() {
    sidebar.classList.remove('-translate-x-full','pointer-events-none');
    overlay.classList.remove('opacity-0','pointer-events-none');
  }

  function closeSidebar() {
    sidebar.classList.add('-translate-x-full','pointer-events-none');
    overlay.classList.add('opacity-0','pointer-events-none');
  }

  openBtn?.addEventListener('click', openSidebar);
  closeBtn?.addEventListener('click', closeSidebar);
  overlay?.addEventListener('click', closeSidebar);
});
</script>
