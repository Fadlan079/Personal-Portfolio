@extends('layouts.main')
@section('title', 'Portofolio')
@vite(['resources/css/hero.css', 'resources/css/dashboard_project.css'])
@section('content')
    <section id="home" class="hero-section relative min-h-screen flex items-center justify-center overflow-hidden z-10">
        <div class="hero-ribbons pointer-events-none absolute inset-0 overflow-hidden z-0 font-bold">
            <div class="ribbon ribbon-blue">
                <div class="ribbon-track">
                    <div class="ribbon-track-content">
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                    </div>
                    <div class="ribbon-track-content" aria-hidden="true">
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                    </div>
                </div>
            </div>

            <div class="ribbon ribbon-white">
                <div class="ribbon-track">
                    <div class="ribbon-track-content">
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                    </div>
                    <div class="ribbon-track-content" aria-hidden="true">
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                        <span>
                        FULL STACK DEVELOPER
                        <em>◆</em>
                        WEB APPLICATION
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="hero-floats pointer-events-auto">

            <a href="https://github.com/Fadlan079" target="_blank"
            class="float-icon icon-github" data-depth="1.2">
                <i class="fa-brands fa-github"></i>
            </a>

            <a href="https://www.linkedin.com/in/fadlan-firdaus-148344386/"
            target="_blank"
            class="float-icon icon-linkedin" data-depth="0.9">
                <i class="fa-brands fa-linkedin"></i>
            </a>

            <a href="https://instagram.com/fdln007"
            target="_blank"
            class="float-icon icon-instagram" data-depth="0.7">
                <i class="fa-brands fa-instagram"></i>
            </a>

            <a href="mailto:fadlanfirdaus220@gmail.com"
            class="float-icon icon-mail" data-depth="0.6">
                <i class="fa-solid fa-envelope"></i>
            </a>

            <a href="https://wa.me/6282210732928"
            target="_blank"
            class="float-icon icon-whatsapp" data-depth="1.0">
                <i class="fa-brands fa-whatsapp"></i>
            </a>

        </div>

        <div class="hidden md:block fixed top-6 right-4 z-50">
            <div class="flex justify-center">
                @if (!session('is_login'))
                    <a
                        href="/login"
                        class="cta-btn relative overflow-hidden px-4 py-2
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
                            class="cta-btn relative overflow-hidden px-4 py-2
                                border-2 border-border text-text font-semibold"
                            style="--cta-bubble-color: #ef4444;">

                            <span class="cta-bubble"></span>
                            <span class="cta-text relative z-10">Logout</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="hero-center relative z-10 text-center max-w-3xl -top-10">
            <div class="text-center">
                <span
                    data-i18n="hero.collaboration"
                    class="hero-badge inline-flex items-center gap-2 px-4 py-1 mb-6
                    rounded-full border border-border bg-surface text-sm text-muted">
                </span>

                <h2 class="hero-title mb-6 leading-tight text-center">

                    <div
                        class="hero-big hero-solid"
                        data-text="HI">
                        <span data-i18n="hero.hi"></span>
                    </div>

                    <div class="hero-big hero-outline">
                        FADLAN
                    </div>

                    <div class="hero-sub text-muted mt-4 font-semibold">
                        Full Stack Developer
                    </div>

                </h2>

                <p class="hero-desc max-w-xl mb-5 text-sm md:text-base leading-loose
                        tracking-wide text-muted/80 relative">
                    <span class="hero-desc-line"></span>
                    <span data-i18n="hero.description"></span>
                </p>

                <div class="flex gap-4 flex-wrap justify-center text-md">
                    <div class="flex justify-center">
                        <a
                            href="{{route('portofolio.projects')}}"
                            class="cta-btn relative overflow-hidden px-8 py-3
                                bg-primary text-text font-semibold border-2 border-border"
                                style="--cta-bubble-color: var(--color-bg);">
                            <span class="cta-bubble"></span>

                            <span class="cta-text relative z-10" data-i18n="hero.view_projects"> </span>
                        </a>
                    </div>
                    <div class="flex justify-center">
                            <a
                                href="{{route('portofolio.contact')}}"
                                class="cta-btn relative overflow-hidden px-8 py-3
                                    border-2 border-border text-text font-semibold"
                                style="--cta-bubble-color: var(--color-primary);">

                                <span class="cta-bubble"></span>
                                <span class="cta-text relative z-10" data-i18n="hero.contact_me"></span>
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 ">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="rounded-3xl overflow-hidden max-w-full">
                    <div class="relative ">
                        <div
                            id="three-canvas"
                            class="max-w-full h-70 sm:h-90 md:h-105 lg:h-110 rounded-2xl ">
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <div class="flex max-w-full justify-center bg-surface/80 backdrop-blur border border-border rounded-full p-1 text-s overflow-x-hiddden relative">

                            <div id="btn-highlight" class="absolute top-1 left-1 h-[calc(100%-0.5rem)] rounded-full bg-bg z-0"></div>

                            <button data-device="desktop"
                            class="device-btn px-4 py-2 rounded-full font-medium relative z-10">
                            Desktop
                            </button>

                            <button data-device="tablet"
                            class="device-btn px-5 py-2 rounded-full text-muted relative z-10">
                            Tablet
                            </button>

                            <button data-device="mobile"
                            class="device-btn px-5 py-2 rounded-full text-muted relative z-10">
                            Mobile
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4" x-data="{ currentProject: 0, totalProjects: {{ count($recentProjects) }} }">
                <div class="flex justify-between items-end mb-6">
                    <div>
                        <p class="text-sm uppercase tracking-widest text-muted mb-2">
                        Selected Work
                        </p>
                        <h3 class="text-3xl font-semibold leading-tight">
                        Featured Projects
                        </h3>
                    </div>
                    <div class="flex gap-2">
                        <button @click="currentProject = currentProject > 0 ? currentProject - 1 : totalProjects - 1" class="w-10 h-10 rounded-full border border-border flex items-center justify-center hover:bg-surface hover:text-primary transition focus:outline-none">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button @click="currentProject = currentProject < totalProjects - 1 ? currentProject + 1 : 0" class="w-10 h-10 rounded-full border border-border flex items-center justify-center hover:bg-surface hover:text-primary transition focus:outline-none">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <div class="relative w-full h-[clamp(320px,45vw,380px)] perspective-1000">
                    @forelse($recentProjects as $index => $project)
                        <div x-show="currentProject === {{ $index }}"
                             x-transition:enter="transition ease-out duration-500 transform"
                             x-transition:enter-start="opacity-0 translate-x-8 z-10"
                             x-transition:enter-end="opacity-100 translate-x-0 z-10"
                             x-transition:leave="transition ease-in duration-300 transform"
                             x-transition:leave-start="opacity-100 translate-x-0 z-0"
                             x-transition:leave-end="opacity-0 -translate-x-8 z-0"
                             class="project-folder group absolute inset-0 border border-border bg-surface p-6 pt-12 w-full h-full"
                             {{ $index === 0 ? '' : 'style="display: none;"' }}
                             >

                            <div class="absolute top-0 left-6 -translate-y-1/2 flex gap-2 z-20">
                                <span class="px-4 py-1 text-xs uppercase tracking-widest badge-primary font-semibold">
                                    {{ $project->type }}
                                </span>
                                <span class="px-3 py-1 text-[10px] uppercase tracking-wide border {{ $project->statusClass }}">
                                    {{ $project->status }}
                                </span>
                            </div>

                            <div class="folder-files absolute inset-0 z-0">
                                <span class="file border-border bg-bg"></span>
                                <span class="file border-border bg-bg"></span>

                               <a href="{{ route('portofolio.projects', ['search' => $project->title]) }}"
                                    class="file file-front pointer-events-auto p-5 flex flex-col gap-3 justify-between bg-surface border-border">
                                    <div>
                                        <h3 class="text-2xl font-semibold leading-tight group-hover:text-primary transition-colors">
                                            {{ $project->title}}
                                        </h3>
                                        <p class="text-sm text-muted leading-relaxed mt-3">
                                            {{ \Illuminate\Support\Str::limit($project->desc, 150) }}
                                        </p>
                                    </div>
                                    <div class="tech-row mt-auto pt-4 flex gap-2 flex-wrap text-[11px] tracking-widest uppercase text-muted">
                                        @foreach ($project->visibleTechs as $tech)
                                            <span class="px-2 py-1 border border-border bg-bg">{{ strtoupper($tech) }}</span>
                                        @endforeach
                                        @if (count($project->extraTechs) > 0)
                                            <span class="px-2 py-1 border border-border bg-bg">
                                                +{{ count($project->extraTechs) }}
                                            </span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="flex items-center justify-center w-full h-full border border-dashed border-border text-muted">
                            <p>No projects found.</p>
                        </div>
                    @endforelse
                </div>

                <div class="flex justify-center mt-8 gap-3">
                    @foreach($recentProjects as $index => $project)
                        <button @click="currentProject = {{ $index }}"
                            class="w-2.5 h-2.5 rounded-full transition-all duration-300"
                            :class="currentProject === {{ $index }} ? 'bg-primary w-6' : 'bg-border hover:bg-muted'">
                        </button>
                    @endforeach
                </div>
            </div>

            </div>
        </div>

        <div id="html-content" style="position: absolute; top: -9999px; visibility: visible;">
        <h1>Hi, I'm Fadlan</h1>
        <p>Check out my latest projects!</p>
        </div>
    </section>

<section id="skills" class="py-24 border-t border-border bg-bg relative overflow-hidden">
    <!-- Subtle background elements -->
    <div class="absolute inset-0 pointer-events-none z-0">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary/5 rounded-full blur-[100px]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 block w-full">

        <!-- Section Header -->
        <div class="text-center mb-16 relative z-20">
            <p class="text-sm uppercase tracking-widest text-muted mb-4">
                Technical Skills
            </p>

            <h3 class="text-3xl md:text-4xl font-semibold leading-tight mb-6">
                Interactive Skill Tree
            </h3>

            <p class="text-muted max-w-2xl mx-auto leading-loose">
                I build structured, scalable web applications. Explore my core specialization domains and the stack I utilize. Hover and click around!
            </p>
        </div>

        <!-- Skills Tree Interactive Container -->
        <div class="relative w-full h-[600px] md:h-[700px] mx-auto flex items-center justify-center overflow-visible" id="skill-tree-container" data-skills="{{ $skills->toJson() }}">
            <svg id="skill-tree-lines" class="absolute inset-0 w-full h-full pointer-events-none z-0 overflow-visible"></svg>
            <!-- Nodes will be injected dynamically via JS -->
        </div>

    </div>
</section>

<section class="relative z-10 py-36 border-t border-border overflow-hidden">

    <div class="relative max-w-4xl mx-auto px-6 text-center">

        <!-- Small Label -->
        <p class="text-sm uppercase tracking-widest text-muted mb-6">
            Let’s Collaborate
        </p>

        <!-- Headline -->
        <h3 class="text-4xl md:text-5xl font-semibold leading-tight mb-6">
            Let’s build something meaningful together.
        </h3>

        <!-- Description -->
        <p class="text-muted max-w-2xl mx-auto mb-12 leading-loose">
            Whether you need a structured web application,
            a modern dashboard system, or a clean portfolio site —
            I’m ready to help turn your ideas into scalable solutions.
        </p>

        <!-- CTA Buttons -->
        <div class="flex justify-center gap-6 flex-wrap">

            <a href="{{ route('portofolio.contact') }}"
               class="cta-btn relative overflow-hidden px-10 py-4
                      bg-primary text-text font-semibold border-2 border-border"
               style="--cta-bubble-color: var(--color-bg);">

                <span class="cta-bubble"></span>
                <span class="cta-text relative z-10">
                    Start a Project
                </span>
            </a>

            <a href="mailto:fadlanfirdaus220@gmail.com"
               class="cta-btn relative overflow-hidden px-10 py-4
                      border-2 border-border text-text font-semibold"
               style="--cta-bubble-color: var(--color-primary);">

                <span class="cta-bubble"></span>
                <span class="cta-text relative z-10">
                    Send Email
                </span>
            </a>

        </div>

    </div>
</section>


@endsection
@vite(['resources/js/three-viewer.js', 'resources/js/skill-tree.js'])
<script>
const buttons = document.querySelectorAll('.device-btn');
const views = document.querySelectorAll('.device-view');

buttons.forEach(btn => {
    btn.addEventListener('click', () => {

    const device = btn.dataset.device;

    buttons.forEach(b => {
        b.classList.remove('bg-bg', 'text-text');
        b.classList.add('text-muted');
    });

    btn.classList.add('bg-bg', 'text-text');
    btn.classList.remove('text-muted');

    views.forEach(view => {
        view.classList.toggle(
        'hidden',
        view.dataset.view !== device
        );
    });

    });
});
</script>
