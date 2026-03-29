<footer class="relative bg-surface border-t border-amber-900/10 pt-20 pb-10 z-30 font-serif"
        style="background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAALHRFWHRDcmVhdGlvbiBUaW1lAFN1biAyMiBPY3QgMjAwNiAxNzoxOToyOCAtMDAwMFM0MmsAAAAHdElNRQfWAhULCRf5PjU5AAAACXBIWXMAAAsSAAALEgHS3X78AAAABGdBTUEAALGPC/xhBQAAADZJREFUeNpjYmBgYGFgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYNIBADk1AbN8N3w4AAAAAElFTkSuQmCC');">

    <div class="absolute -top-4 left-1/4 w-24 h-8 bg-amber-200/60 rotate-[-12deg] shadow-inner pointer-events-none"></div>
    <div class="absolute top-20 right-10 w-20 h-6 bg-amber-100/70 rotate-[25deg] shadow-inner pointer-events-none"></div>
    <div class="absolute bottom-10 left-10 w-16 h-7 bg-amber-200/50 rotate-[-20deg] shadow-inner pointer-events-none"></div>

    <div class="max-w-6xl mx-auto px-6 md:px-10 relative z-10 flex flex-col md:flex-row flex-wrap justify-between gap-12 lg:gap-8">

        <div class="w-full md:w-[calc(50%-1.5rem)] lg:w-[calc(40%-2rem)] flex-shrink-0">
            <div class="relative bg-amber-100 p-8 shadow-xl md:rotate-[-2deg] rounded-lg border border-amber-900/10 group">
                <div class="absolute top-0 right-0 w-16 h-6 bg-amber-200/80 -rotate-45 shadow-inner pointer-events-none origin-top-right"></div>

                <div>
                    <h2 class="text-3xl md:text-4xl font-bold tracking-tight text-amber-950 leading-none">
                        {{ $brand }}
                    </h2>
                    <div class="w-16 h-1 mt-4">
                        <svg width="64" height="4" viewBox="0 0 64 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1C10 2 20 3 32 3C44 3 54 2 63 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="text-primary"/>
                        </svg>
                    </div>
                </div>

                <p class="text-sm text-amber-900 leading-relaxed max-w-sm font-medium mt-6 font-sans"
                   data-i18n="footer.brand_description">
                    Siswa SMK TI Airlangga generasi ke-24 yang tertarik pada pengembangan web full-stack.
                </p>

                <i class="fa-solid fa-pencil text-amber-300 absolute bottom-4 right-4 text-xs opacity-60 group-hover:opacity-100 transition-opacity"></i>
                <i class="fa-solid fa-sparkles text-amber-300 absolute top-4 left-4 text-xs opacity-60 group-hover:opacity-100 transition-opacity"></i>
            </div>
        </div>

        <div class="w-full md:w-[calc(50%-1.5rem)] lg:w-[calc(30%-2rem)] flex-shrink-0">
            <div class="relative bg-white/70 p-8 shadow-lg md:rotate-[1deg] rounded-sm border border-amber-900/10 group">
                 <div class="absolute -top-4 -left-4 w-14 h-6 bg-amber-100/90 rotate-45 shadow-inner pointer-events-none origin-bottom-left"></div>

                <p class="text-[11px] font-bold uppercase tracking-widest text-amber-950 border-b border-amber-900/20 pb-2 mb-6" data-i18n="footer.quick_links_label">
                    Tautan Cepat
                </p>

                <ul class="flex flex-col gap-4">
                    @foreach ($links as $link)
                        <li class="relative">
                            <a href="{{ $link['href'] }}" class="group flex items-center justify-between gap-3 text-sm font-semibold text-amber-900 bg-amber-50 px-4 py-2 shadow-sm rounded-sm transition-all duration-300 hover:bg-amber-100 hover:rotate-1 font-sans">
                                <span class="group-hover:text-primary transition-colors" data-i18n="{{ $link['key'] }}">
                                    {{ ucwords(strtolower(str_replace('nav.', '', __($link['key'])))) }}
                                </span>
                                <i class="fa-solid fa-pen-nib text-amber-300 group-hover:text-primary transition-colors text-xs opacity-0 group-hover:opacity-100 transform translate-x-1 group-hover:translate-x-0 transition-all"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="absolute -bottom-6 right-6 w-8 h-8 pointer-events-none opacity-60 group-hover:opacity-100 transition-opacity">
                    <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-amber-200">
                      <path d="M50 10C50 10 60 40 50 60C40 40 50 10 50 10Z" fill="currentColor"/>
                      <path d="M50 90C50 90 40 60 50 40C60 60 50 90 50 90Z" fill="currentColor"/>
                      <path d="M10 50C10 50 40 40 60 50C40 60 10 50 10 50Z" fill="currentColor"/>
                      <path d="M90 50C90 50 60 60 40 50C60 40 90 50 90 50Z" fill="currentColor"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="w-full md:w-[calc(50%-1.5rem)] lg:w-[calc(30%-2rem)] flex-shrink-0">
            <div class="relative bg-container p-8 shadow-md md:rotate-[-1deg] rounded-md border border-border/50 group">
                <div class="absolute bottom-0 left-0 w-18 h-6 bg-amber-100/80 -rotate-45 shadow-inner pointer-events-none origin-bottom-left"></div>

                <p class="text-[11px] font-bold uppercase tracking-widest text-text border-b border-amber-500/20 pb-2 mb-6" data-i18n="footer.connect_label">
                    Hubungi
                </p>

                <div class="flex flex-wrap gap-4 mb-6">
                    @foreach ($socials as $social)
                        <a href="{{ $social['href'] }}" target="_blank"
                           class="group flex items-center justify-center w-12 h-12 rounded-full shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:rotate-6
                           @if ($social['icon'] == 'fab fa-github') bg-slate-900 hover:bg-slate-700
                           @elseif ($social['icon'] == 'fab fa-linkedin') bg-sky-700 hover:bg-sky-500
                           @elseif ($social['icon'] == 'fab fa-instagram') bg-pink-600 hover:bg-pink-400
                           @elseif ($social['icon'] == 'fab fa-twitter') bg-sky-500 hover:bg-sky-300
                           @else bg-primary hover:bg-primary-dark @endif">
                            <i class="{{ $social['icon'] }} text-white transition-colors text-lg"></i>
                        </a>
                    @endforeach
                </div>

                <div class="pt-4 flex items-center gap-3 bg-amber-50 p-3 rounded-full shadow-inner shadow-amber-900/10 md:rotate-[-3deg] group-hover:rotate-0 transition-transform">
                    <i class="fa-solid fa-stamp text-lg text-amber-500 rotate-15 group-hover:rotate-0 transition-transform"></i>
                    <div class="flex flex-col">
                      <span class="text-[10px] font-bold uppercase tracking-widest text-black/70" data-i18n="footer.location_label">Lokasi</span>
                      <span class="text-sm font-semibold text-amber-900 font-sans">Indonesia</span>
                    </div>
                </div>

                <i class="fa-solid fa-paperclip text-amber-300 absolute top-4 right-4 text-lg opacity-80 group-hover:opacity-100 transition-opacity"></i>
            </div>
        </div>

        <div class="w-full mt-16 pt-8 border-t border-amber-900/10 text-center relative z-20">
            <div class="flex flex-col md:flex-row items-center justify-center gap-3 md:gap-6
                        text-xs font-medium text-text italic font-serif">

                <div class="flex items-center gap-2">
                    <span>© {{ now()->year }}</span>
                    <span class="text-primary font-bold">{{ $brand }}</span>
                </div>

                <span data-i18n="footer.copyright" class="">Hak Cipta Dilindungi</span>
            </div>

            <i class="fa-solid fa-pencil text-amber-200 absolute -bottom-6 left-1/2 -translate-x-1/2 text-2xl opacity-40"></i>
        </div>
    </div>
</footer>
