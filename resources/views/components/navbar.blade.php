<style>
.nav-float {
  transform-origin: top center;
  will-change: transform;
  backdrop-filter: blur(12px);
  border-radius: 2xl;
  border: 1px solid rgba(0,0,0,0.05);
  box-shadow: 0 10px 40px rgba(0,0,0,0.12);
}

.nav-link {
  position: relative;
  font-weight: 500;
  color: var(--text-color)/80;
  transition: color 0.3s;
}
.nav-link::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 50%;
  width: 0;
  height: 2px;
  background-color: var(--color-primary);
  border-radius: 99px;
  transform: translateX(-50%);
  transition: width 0.3s ease;
}
.nav-link:hover {
  color: var(--text-color);
}
.nav-link:hover::after {
  width: 24px;
}

.sidebar-link {
  display: block;
  padding: 0.5rem 1rem;
  border-radius: 1rem;
  backdrop-filter: blur(6px);
  transition: all 0.3s;
  color: var(--text-color);
}
.sidebar-link:hover {
  background-color: rgba(255,255,255,0.15);
  transform: translateX(4px);
  color: var(--color-primary);
}

.nav-brand {
  font-weight: 600;
  color: var(--color-primary);
  -webkit-text-stroke: 0.5px var(--color-primary);
  text-stroke: 0.5px var(--color-primary);
  font-size: 1.125rem;
  letter-spacing: -0.5px;
}
</style>

<nav id="mainNavbar" class="nav-float fixed top-4 lg:top-6 left-1/2 -translate-x-1/2 
    w-[calc(100%-2rem)] md:w-[90%] md:max-w-2xl lg:max-w-[650px] xl:max-w-3xl 
    bg-surface/50 z-50">

  <div class="px-4 xl:px-6 py-2 flex justify-between items-center">
    <h1 class="nav-brand text-base lg:text-sm xl:text-lg">
      {{ $brand ?? 'App' }}
    </h1>

    <ul class="hidden md:flex items-center gap-4 lg:gap-5 xl:gap-8 text-[13px] lg:text-[12px] xl:text-[15px]">
      @foreach ($menus as $menu)
      <li>
        <a href="{{ $menu['href'] }}" data-i18n="{{ $menu['key'] }}" class="nav-link">
          {{ __($menu['key']) }}
        </a>
      </li>
      @endforeach
    </ul>

    <div class="flex items-center gap-1 xl:gap-2">
      <button onclick="toggleTheme()" class="w-8 h-8 lg:w-7 lg:h-7 xl:w-9 xl:h-9 rounded-full flex items-center justify-center hover:bg-white/20 transition">
        <i id="themeIcon" class="fa-solid fa-moon text-sm xl:text-base"></i>
      </button>

      <button id="langToggle" class="w-8 h-8 lg:w-7 lg:h-7 xl:w-9 xl:h-9 rounded-full flex items-center justify-center hover:bg-white/20 transition">
        <span id="langFlag" class="fi fi-id w-5 h-3 xl:w-6 xl:h-4 rounded-sm"></span>
      </button>

      <button id="mobileMenuBtn" class="md:hidden w-8 h-8 rounded-full flex items-center justify-center hover:bg-white/20 transition">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
  </div>
</nav>

<div id="mobileOverlay" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-70 opacity-0 pointer-events-none transition"></div>

<aside id="mobileSidebar" class="fixed top-0 left-0 h-full w-72 bg-surface/50 backdrop-blur-2xl border-r border-white/20 z-100 -translate-x-full pointer-events-none transition-transform duration-300 rounded-r-3xl">
  <div class="p-6 flex justify-between items-center border-b border-white/20">
    <span class="nav-brand">{{ $brand ?? 'App' }}</span>
    <button id="mobileCloseBtn" class="text-xl"><i class="fa-solid fa-xmark"></i></button>
  </div>

  <nav class="p-6 flex flex-col gap-4 text-sm">
    @foreach ($menus as $menu)
      <a href="{{ $menu['href'] }}" data-i18n="{{ $menu['key'] }}" class="sidebar-link">
        {{ __($menu['key']) }}
      </a>
    @endforeach

    <div class="flex justify-center mt-4">
      @if (!session('is_login'))
        <a
            href="/login"
            class="cta-btn w-full relative overflow-hidden px-4 py-2
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
                class="cta-btn w-full relative overflow-hidden px-8 py-3
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
  const openBtn = document.getElementById('mobileMenuBtn');
  const closeBtn = document.getElementById('mobileCloseBtn');
  const sidebar = document.getElementById('mobileSidebar');
  const overlay = document.getElementById('mobileOverlay');

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
