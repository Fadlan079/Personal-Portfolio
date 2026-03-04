@extends('layouts.main')
@section('title', 'About')
<style>
    .constraint-line {
  opacity: 0.15;
  transform: translateX(-10%);
  white-space: nowrap;
}

</style>
@section('content')
<section class="relative max-w-6xl mx-auto px-6 py-32 space-y-32 overflow-x-hidden">
    <div class="space-y-8" id="about-hero">
        <h1 id="about-title"
            class="text-[clamp(3rem,10vw,9rem)] font-semibold leading-[0.95]
                   text-text" data-i18n="about.title">
        </h1>

        <h2 id="about-outline" data-i18n="about.hero_outline"
            class="text-[clamp(2.5rem,8vw,6rem)] font-semibold leading-tight text-outline">
        </h2>
    </div>

    <div class="grid md:grid-cols-12 gap-8" id="about-narrative">
        <div class="md:col-span-6 md:col-start-6 space-y-6">
            <p class="text-lg text-text leading-relaxed" data-i18n="about.narrative_1"></p>

            <p class="text-muted leading-relaxed" data-i18n="about.narrative_2"></p>
        </div>
    </div>

<div class="space-y-20" id="about-values">
    <div class="space-y-2">
        <h3
            class="text-[clamp(2.5rem,6vw,5rem)]
                font-semibold
                leading-none
                text-text" data-i18n="about.values_title">
        </h3>

        <p class="text-xs uppercase tracking-widest text-muted" data-i18n="about.values_subtitle"></p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @for ($i = 0; $i < 4; $i++)
            <div class="value-item group space-y-2">
                <div
                    class="value-title text-[clamp(1.5rem,4vw,3rem)]
                        font-medium leading-none
                        {{ $i === 1 ? 'text-primary' : 'text-outline-muted' }}"
                    data-i18n="about.principles.{{ $i }}.title">
                </div>

                <div
                    class="value-desc text-xs text-muted opacity-0 translate-y-2"
                    data-i18n="about.principles.{{ $i }}.desc">
                </div>
            </div>
        @endfor
    </div>
</div>

<div class="relative" id="about-constraints">
    <div class="constraint-pin h-screen flex items-center overflow-hidden">
        <div class="constraint-wall px-6 space-y-16 max-w-6xl mx-auto">

            <h3 class="text-[clamp(3rem,8vw,7rem)] font-semibold leading-none" data-i18n="about.constraints_title"></h3>

            <div class="space-y-12 text-[clamp(2rem,5vw,4rem)] leading-tight">
                <div class="constraint-line" data-i18n="about.constraints_lines.0"></div>
                <div class="constraint-line" data-i18n="about.constraints_lines.1"></div>
                <div class="constraint-line" data-i18n="about.constraints_lines.2"></div>
                <div class="constraint-line" data-i18n="about.constraints_lines.3"></div>
            </div>
        </div>
    </div>
</div>
</section>

<section id="about-end" class="relative py-40 border-t border-border overflow-hidden">
    <div class="absolute right-0 bottom-0 opacity-[0.03] pointer-events-none">
        <svg width="400" height="400" viewBox="0 0 100 100" fill="none" stroke="currentColor">
            <circle cx="50" cy="50" r="40" stroke-width="0.5" stroke-dasharray="2 2" />
            <path d="M50 10V90M10 50H90" stroke-width="0.5" />
        </svg>
    </div>

    <div class="max-w-6xl mx-auto px-6 space-y-12 relative z-10">
        <p class="text-xs uppercase tracking-[0.3em] text-muted">
            index / end
        </p>

        <h3 class="text-[clamp(2.5rem,6vw,4.5rem)] font-semibold leading-[1.1] max-w-4xl tracking-tight">
            <span data-i18n="about.end.cta_title">Solid structure,</span><br/>
            <span class="text-muted font-normal" data-i18n="about.end.cta_subtitle">clean execution.</span>
        </h3>

        <div class="flex flex-col md:flex-row md:items-center gap-8 justify-between">
            <p class="text-muted max-w-lg leading-relaxed text-base md:text-lg" data-i18n="about.end.cta_desc">
                Turning complex requirements into scalable web applications. I focus on writing maintainable code and delivering reliable solutions that simply work.
            </p>
            
            <div class="pt-8 md:pt-0">
                <p class="text-xs uppercase tracking-widest text-muted mb-2" data-i18n="about.end.auth_by">Authenticated by</p>
                <p class="font-serif text-4xl italic opacity-80">Fadlan Firdaus</p>
            </div>
        </div>
    </div>
</section>
@endsection
