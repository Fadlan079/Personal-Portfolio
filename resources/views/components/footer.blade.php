<footer class="relative bg-bg border-t border-border">
    <div class="max-w-7xl mx-auto px-6 py-14 grid gap-10 md:grid-cols-3">

        <div>
            <h3 class="text-xl font-bold text-primary mb-3">
                {{ $brand }}
            </h3>
            <p class="text-muted leading-relaxed">
                {{ $description }}
            </p>
        </div>

        <div>
            <h4 class="font-semibold mb-4 text-text">Quick Links</h4>
            <ul class="space-y-2 text-muted text-sm grid grid-cols-2">
                @foreach ($links as $link)
                    <li>
                        <a href="{{ $link['href'] }}"
                           class="hover:text-primary transition">
                            {{ $link['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <h4 class="font-semibold mb-4 text-text">Connect</h4>
            <div class="flex gap-4">
                @foreach ($socials as $social)
                    <a href="{{ $social['href'] }}"
                       target="_blank"
                       class="w-10 h-10 rounded-xl border border-border
                              flex items-center justify-center
                              text-muted hover:text-primary hover:border-primary
                              transition">
                        <i class="{{ $social['icon'] }}"></i>
                    </a>
                @endforeach
            </div>
        </div>

    </div>

    <div class="border-t border-border text-center py-4 text-muted text-sm">
        © {{ $year }}
        <span class="text-text font-semibold">{{ $brand }}</span>.
        Built with <span class="text-primary">Laravel</span> & Tailwind CSS.
    </div>
</footer>