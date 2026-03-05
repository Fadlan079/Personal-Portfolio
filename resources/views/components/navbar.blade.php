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

<aside id="mobileSidebar" class="fixed top-0 left-0 h-full w-[80%] max-w-[300px] bg-background/95 backdrop-blur-2xl border-r border-border z-100 -translate-x-full pointer-events-none transition-transform duration-300 flex flex-col shadow-2xl">
  
  <div class="h-16 px-6 flex justify-between items-center border-b border-border/50">
    <div class="flex items-center gap-3">
        <div class="w-6 h-6 rounded bg-primary text-background flex items-center justify-center font-bold text-xs">
            <i class="fa-solid fa-terminal"></i>
        </div>
        <span class="font-mono text-sm font-bold tracking-widest text-text uppercase">
            {{ $brand ?? 'SYS_MENU' }}
        </span>
    </div>
    <button id="mobileCloseBtn" class="w-8 h-8 flex items-center justify-center rounded-md text-muted hover:bg-surface hover:text-text transition-colors">
        <i class="fa-solid fa-xmark"></i>
    </button>
  </div>

  <nav class="p-6 flex flex-col gap-2 text-sm flex-1 overflow-y-auto">
    <p class="text-[10px] font-mono uppercase tracking-widest text-muted mb-2 px-2">Navigation</p>
    
    @foreach ($menus as $menu)
      @php
        $isActive = request()->url() == $menu['href'];
      @endphp
      <a href="{{ $menu['href'] }}" data-i18n="{{ $menu['key'] }}" 
         class="group relative flex items-center gap-3 px-3 py-3 rounded-lg font-medium font-sans transition-all duration-200
                {{ $isActive ? 'bg-primary/10 text-primary' : 'text-muted hover:bg-surface hover:text-text' }}">
        
        @if($isActive)
            <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-4 rounded-r-full bg-primary shadow-[0_0_8px_var(--color-primary)]"></span>
        @endif
        
        <i class="w-5 text-center {{ $menu['icon'] ?? 'fa-regular fa-folder' }} {{ $isActive ? 'text-primary' : 'text-muted group-hover:text-text' }} transition-colors"></i>
        <span>{{ __($menu['key']) }}</span>
      </a>
    @endforeach

    <div class="mt-8 pt-6 border-t border-border/50 space-y-4">
        <p class="text-[10px] font-mono uppercase tracking-widest text-muted px-2">Authentication</p>
        
        @if (!session('is_login'))
            <a href="/login" class="w-full flex items-center justify-center gap-2 px-4 py-3 border border-primary text-primary font-mono text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-primary hover:text-background transition-colors">
                <i class="fa-solid fa-terminal"></i> SYS.LOGIN
            </a>
        @else
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-between px-4 py-3 border border-border text-muted font-mono text-xs uppercase tracking-widest rounded-lg hover:bg-red-500/10 hover:border-red-500/30 hover:text-red-500 transition-colors group">
                    <span>END_SESSION</span>
                    <i class="fa-solid fa-power-off opacity-50 group-hover:opacity-100 group-hover:animate-pulse"></i>
                </button>
            </form>
        @endif
    </div>
  </nav>

  @if($showClock ?? true)
  <div class="p-6 border-t border-border/50 bg-surface/30">
      <div class="flex items-center gap-2 text-primary text-[10px] uppercase font-bold mb-1 font-mono">
          <span class="w-2 h-2 bg-primary rounded-full animate-pulse shadow-[0_0_8px_var(--color-primary)]"></span>
          SYS.TIME
      </div>
      <div id="mobile-live-clock" 
           data-format="{{ $clockFormat ?? '24' }}" 
           data-seconds="{{ $showSeconds ?? '1' }}" 
           class="text-text text-sm font-semibold font-mono tracking-widest">
          00:00:00 WITA
      </div>
      <div id="mobile-live-date" 
           data-date="{{ $showDate ?? '1' }}" 
           class="text-muted text-[10px] font-mono uppercase mt-1 hidden">
          --
      </div>
  </div>
  @endif

</aside>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // --- MOBILE MENU LOGIC ---
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

  // --- MOBILE CLOCK LOGIC ---
  const mClock = document.getElementById('mobile-live-clock');
  const mDate = document.getElementById('mobile-live-date');

  if (mClock) {
      const formatStr = mClock.getAttribute('data-format') || '24';
      const showSecondsStr = mClock.getAttribute('data-seconds') || '1';
      
      const use12Hour = (formatStr === '12');
      const showSeconds = (showSecondsStr === '1');
      
      let showDate = false;
      if (mDate) {
          showDate = (mDate.getAttribute('data-date') === '1');
          if (showDate) mDate.classList.remove('hidden');
      }

      function updateMobileClock() {
          const now = new Date();
          
          const timeOptions = { hour12: use12Hour, hour: '2-digit', minute: '2-digit' };
          if (showSeconds) timeOptions.second = '2-digit';
          
          mClock.innerText = now.toLocaleTimeString('en-US', timeOptions) + ' WITA';

          if (showDate && mDate) {
              mDate.innerText = now.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: '2-digit' }).toUpperCase(); 
          }
      }
      
      updateMobileClock();
      setInterval(updateMobileClock, 1000);
  }
});
</script>
