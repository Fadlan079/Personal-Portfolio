<style>

    @media (max-height: 650px) {
  .project-row-bottom {
    overflow-x: visible;
    justify-content: center;
    gap: 1.5rem;
  }

    .project-card {
    width: 22rem;   /* lebih kecil dari w-105 */
    height: 14rem;  /* lebih pendek */
    padding: 1rem;
  }

  .project-row-top {
    margin-bottom: 1rem;
  }

  .project-row-bottom {
    max-width: 100%;
  }

  .project-row {
  position: relative;
  width: 100%;
}

.project-track {
  display: flex;
  width: max-content;
  will-change: transform;
}

}

</style>
<div class="mx-auto px-6 overflow-hidden "
style="--cta-bubble-color: var(--color-primary);">
@php
  $loopProjects = array_merge($featuredProjects, $featuredProjects);
@endphp


    {{-- <h3 class="text-3xl font-bold text-center mb-4 text-primary" data-i18n="projects"></h3>
    <p class="text-muted text-center mb-16" data-i18n="subtitle.projects"></p> --}}

    <div class="project-row project-row-top md:flex hidden mb-6">
        <div class="project-track flex gap-6">
         @foreach ($loopProjects as $l)
            <div class="project-card relative w-105 h-65 shrink-0 bg-container p-6 ">
                <div class="relative w-full h-full bg-neutral-900 overflow-hidden">
                    <img
                        src="{{ (!empty($l['thumbnail']) && file_exists(public_path('images/projects/'.$l['thumbnail'])))
                            ? asset('images/projects/'.$l['thumbnail'])
                            : asset('images/projects/default.svg') }}"
                        alt="{{ $l['title'] }}"
                        class="absolute inset-0 w-full h-full object-cover">

                    <div class="absolute inset-0 bg-black/40"></div>

                    <div class="relative z-10 p-5 h-full flex flex-col justify-between">

                        <div>
@php
    $status = strtolower($l['status']);

    $statusStyle = match ($status) {
        'finished' => 'text-[var(--color-success)] bg-[color-mix(in_srgb,var(--color-success)_15%,transparent)]',
        'ongoing'  => 'text-[var(--color-warning)] bg-[color-mix(in_srgb,var(--color-warning)_15%,transparent)]',
        'planned'  => 'text-[var(--color-danger)] bg-[color-mix(in_srgb,var(--color-danger)_15%,transparent)]',
        default    => 'text-[var(--color-muted)] bg-transparent',
    };
@endphp

<p class="inline-flex items-center px-2 py-0.5 my-1.5 rounded-full text-xs font-medium tracking-wide {{ $statusStyle }}">
    {{ ucfirst($status) }}
</p>


                            <h4 class="text-lg font-semibold text-white leading-snug">
                                {{ $l['title'] }}
                            </h4>
                        </div>

                        <div class="flex justify-between items-end">
                            <span class="text-xs text-white/50">
                                {{ $l['year'] ?? '2025' }}
                            </span>

                            <a
                                href="{{ $l['repo'] }}"
                                class="text-xs text-white/70 hover:text-white transition">
                                View →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>

    <div class="project-row project-row-bottom flex gap-6 ">
        <div class="project-track flex gap-6">
        @foreach ($loopProjects as $l)
            <div class="project-card relative w-105 h-65 shrink-0 bg-container p-6">
                <div class="relative w-full h-full bg-neutral-900 overflow-hidden">
                    <img
                        src="{{ (!empty($l['thumbnail']) && file_exists(public_path('images/projects/'.$l['thumbnail'])))
                            ? asset('images/projects/'.$l['thumbnail'])
                            : asset('images/projects/default.svg') }}"
                        alt="{{ $l['title'] }}"
                        class="absolute inset-0 w-full h-full object-cover">

                    <div class="absolute inset-0 bg-black/40"></div>

                    <div class="relative z-10 p-5 h-full flex flex-col justify-between">

                        <div>
@php
    $status = strtolower($l['status']);

    $statusStyle = match ($status) {
        'finished' => 'text-[var(--color-success)] bg-[color-mix(in_srgb,var(--color-success)_15%,transparent)]',
        'ongoing'  => 'text-[var(--color-warning)] bg-[color-mix(in_srgb,var(--color-warning)_15%,transparent)]',
        'planned'  => 'text-[var(--color-danger)] bg-[color-mix(in_srgb,var(--color-danger)_15%,transparent)]',
        default    => 'text-[var(--color-muted)] bg-transparent',
    };
@endphp

<p class="inline-flex items-center px-2 py-0.5 my-1.5 rounded-full text-xs font-medium tracking-wide {{ $statusStyle }}">
    {{ ucfirst($status) }}
</p>

                            <h4 class="text-lg font-semibold text-white leading-snug">
                                {{ $l['title'] }}
                            </h4>
                        </div>

                        <div class="flex justify-between items-end">
                            <span class="text-xs text-white/50">
                                {{ $l['year'] ?? '2025' }}
                            </span>

                            <a
                                href="{{ $l['repo'] }}"
                                class="text-xs text-white/70 hover:text-white transition">
                                View →
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>

    {{-- <div class="mt-16 flex justify-center">
        <a
            href="pages.project"
            class="cta-btn relative overflow-hidden px-8 py-3 rounded-2xl
                border-2 border-primary text-text font-semibold">
            <span class="cta-bubble"></span>

            <span class="cta-text relative z-10" data-i18n="more.projects"> </span>
        </a>
    </div> --}}
</div>
