<nav class="fixed w-full bg-bg/80 backdrop-blur border-b border-border z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

    <h1 class="text-xl font-bold text-primary">
      {{ $brand ?? 'App' }}
    </h1>

    <ul class="flex gap-6 text-sm">
      @foreach ($menus as $menu)
        <li class="relative group">
          <a href="{{ $menu['href'] }}" class="{{ request()->is(ltrim($menu['href'], '/')) ? 'text-primary' : '' }}">
            {{ $menu['label'] }}
          </a>
          <span
            class="absolute left-0 -bottom-1 h-[2px] w-0 bg-primary transition-all group-hover:w-full">
          </span>
        </li>
      @endforeach
    </ul>

  </div>
</nav>
