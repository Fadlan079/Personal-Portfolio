<footer class="relative border-t border-border bg-surface/20 pt-16 pb-8 z-30 font-mono overflow-hidden">
    
    <div class="absolute inset-0 pointer-events-none opacity-[0.03]" 
         style="background-image: linear-gradient(var(--color-text) 1px, transparent 1px), linear-gradient(90deg, var(--color-text) 1px, transparent 1px); background-size: 32px 32px;">
    </div>

    <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-primary z-10"></div>
    <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-primary z-10"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-8">

            <div class="md:col-span-12 lg:col-span-5 space-y-6">
                <div class="flex items-center gap-3 text-[10px] uppercase tracking-widest text-muted">
                    <span class="w-2 h-2 bg-primary animate-pulse shadow-[0_0_8px_var(--color-primary)]"></span>
                    SYS.IDENTITY_MODULE
                </div>
                
                <div>
                    <h2 class="text-3xl md:text-5xl font-bold tracking-tighter uppercase text-text leading-none">
                        {{ $brand }}
                    </h2>
                    <div class="flex gap-1 mt-3 h-1.5 opacity-50">
                        <div class="w-12 bg-primary"></div>
                        <div class="w-3 bg-primary"></div>
                        <div class="w-1 bg-primary"></div>
                        <div class="w-6 bg-text"></div>
                        <div class="w-2 bg-text"></div>
                    </div>
                </div>

                <p class="text-xs text-muted leading-relaxed max-w-sm font-sans" data-i18n="footer.description">
                    Focus on building modern web applications with clear backend structures, responsive frontend and production-ready systems.
                </p>
            </div>

            <div class="md:col-span-6 lg:col-span-3 lg:col-start-7 space-y-6">
                <p class="text-[10px] uppercase tracking-[0.2em] text-primary" data-i18n="footer.quick_links">>> ROUTING_TABLE</p>
                
                <ul class="flex flex-col gap-4">
                    @foreach ($links as $link)
                        <li>
                            <a href="{{ $link['href'] }}" class="group flex items-center gap-3 text-xs uppercase tracking-widest text-muted hover:text-text transition-colors w-max">
                                <span class="text-border group-hover:text-primary transition-colors">/DIR:</span>
                                <span class="transform group-hover:translate-x-2 transition-transform" data-i18n="{{ $link['key'] }}">
                                    {{ strtoupper(str_replace('nav.', '', $link['key'])) }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="md:col-span-6 lg:col-span-3 space-y-6">
                <p class="text-[10px] uppercase tracking-[0.2em] text-primary" data-i18n="footer.connect">>> EXTERNAL_NODES</p>
                
                <div class="grid grid-cols-5 md:grid-cols-3 gap-2">
                    @foreach ($socials as $social)
                        <a href="{{ $social['href'] }}" target="_blank"
                           class="group flex items-center justify-center aspect-square border border-border/50 bg-surface/30 hover:bg-primary/10 hover:border-primary transition-all duration-300 relative overflow-hidden">
                            
                            <div class="absolute top-0 left-0 w-full h-[1px] bg-primary transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                            
                            <i class="{{ $social['icon'] }} text-muted group-hover:text-primary group-hover:scale-110 transition-all text-lg"></i>
                        </a>
                    @endforeach
                </div>
                
                <div class="pt-4 text-[9px] text-muted uppercase tracking-widest flex items-center gap-2">
                    <i class="fa-solid fa-lock text-[8px]"></i>
                    Secure_Connection
                </div>
            </div>

        </div>

        <div class="mt-16 pt-6 border-t border-border/50 flex flex-col md:flex-row items-center justify-between gap-4 text-[10px] uppercase tracking-widest text-muted">
            
            <div class="flex items-center gap-4">
                <span data-i18n="footer.copyright">© {{ date('Y') }}</span>
                <span class="text-primary font-bold">{{ $brand }}</span>
                <span class="hidden md:inline border-l border-border/50 pl-4">All_Rights_Reserved</span>
            </div>

            <div class="flex items-center gap-4">
                <span class="hidden sm:inline">SYS_VER: 3.0.4</span>
                <div class="border-l border-border/50 pl-4 flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-text">ALL_SYSTEMS_NOMINAL</span>
                </div>
            </div>

        </div>
    </div>
</footer>