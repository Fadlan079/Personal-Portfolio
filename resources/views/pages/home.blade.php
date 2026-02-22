@extends('layouts.main')
@section('title', 'Portofolio')
@vite(['resources/css/hero.css'])
@section('content')
    <section id="home" class="hero-section relative min-h-screen flex items-center justify-center overflow-hidden z-10">
        <div class="hero-ribbons pointer-events-none absolute inset-0 overflow-hidden z-0 font-bold">
            <div class="ribbon ribbon-blue">
                <div class="ribbon-track">
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

            <div class="ribbon ribbon-white">
                <div class="ribbon-track">
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
                            href="{{route('portofolio.project')}}"
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

            <div class="pt-4">
                <p class="text-sm uppercase tracking-widest text-muted mb-4">
                Selected Work
                </p>

                <h3 class="text-3xl font-semibold leading-tight mb-6">
                Dashboard Management System
                </h3>

                <p class="text-muted leading-loose mb-8 max-w-xl">
                A web-based dashboard built with Laravel,
                focusing on clarity, performance,
                and maintainable backend structure.
                </p>

                <div class="flex flex-wrap gap-2 mb-10">
                <span class="px-3 py-1 text-xs rounded-full border border-border">
                    Laravel
                </span>
                <span class="px-3 py-1 text-xs rounded-full border border-border">
                    Tailwind CSS
                </span>
                <span class="px-3 py-1 text-xs rounded-full border border-border">
                    HTMX
                </span>
                </div>

                <div class="space-y-4">

                <button class="w-full text-left p-4 rounded-xl border border-border
                                hover:bg-surface transition">
                    <p class="font-medium">Dashboard System</p>
                    <p class="text-sm text-muted">Admin & analytics interface</p>
                </button>

                <button class="w-full text-left p-4 rounded-xl border border-border
                                hover:bg-surface transition">
                    <p class="font-medium">Portfolio Website</p>
                    <p class="text-sm text-muted">Personal branding site</p>
                </button>

                <button class="w-full text-left p-4 rounded-xl border border-border
                                hover:bg-surface transition">
                    <p class="font-medium">Landing Page</p>
                    <p class="text-sm text-muted">Marketing focused layout</p>
                </button>

                </div>

            </div>

            </div>
        </div>

        <div id="html-content" style="position: absolute; top: -9999px; visibility: visible;">
        <h1>Hi, I'm Fadlan</h1>
        <p>Check out my latest projects!</p>
        </div>
    </section>
<section id="skills" class="py-24 border-t border-border bg-bg">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Section Header -->
        <div class="text-center mb-16">
            <p class="text-sm uppercase tracking-widest text-muted mb-4">
                Technical Skills
            </p>

            <h3 class="text-3xl md:text-4xl font-semibold leading-tight mb-6">
                Technologies I Work With
            </h3>

            <p class="text-muted max-w-2xl mx-auto leading-loose">
                I build structured, scalable web applications with clean backend
                architecture and interactive frontend experiences.
            </p>
        </div>

        <!-- Skills Grid -->
        <div class="grid md:grid-cols-3 gap-8">

            <!-- Backend -->
            <div class="skill-card group p-8 rounded-2xl border border-border bg-surface hover:-translate-y-2 transition duration-500">
                <h4 class="text-lg font-semibold mb-6 text-primary">
                    Backend
                </h4>

                <div class="space-y-4 text-sm">

                    <div class="flex justify-between">
                        <span>Laravel</span>
                        <span class="text-muted">Advanced</span>
                    </div>

                    <div class="flex justify-between">
                        <span>PHP</span>
                        <span class="text-muted">Advanced</span>
                    </div>

                    <div class="flex justify-between">
                        <span>MySQL</span>
                        <span class="text-muted">Intermediate</span>
                    </div>

                    <div class="flex justify-between">
                        <span>REST API</span>
                        <span class="text-muted">Advanced</span>
                    </div>

                </div>
            </div>

            <!-- Frontend -->
            <div class="skill-card group p-8 rounded-2xl border border-border bg-surface hover:-translate-y-2 transition duration-500">
                <h4 class="text-lg font-semibold mb-6 text-primary">
                    Frontend
                </h4>

                <div class="space-y-4 text-sm">

                    <div class="flex justify-between">
                        <span>JavaScript</span>
                        <span class="text-muted">Advanced</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Tailwind CSS</span>
                        <span class="text-muted">Advanced</span>
                    </div>

                    <div class="flex justify-between">
                        <span>HTMX</span>
                        <span class="text-muted">Intermediate</span>
                    </div>

                    <div class="flex justify-between">
                        <span>GSAP</span>
                        <span class="text-muted">Intermediate</span>
                    </div>

                </div>
            </div>

            <!-- Tools -->
            <div class="skill-card group p-8 rounded-2xl border border-border bg-surface hover:-translate-y-2 transition duration-500">
                <h4 class="text-lg font-semibold mb-6 text-primary">
                    Tools & Workflow
                </h4>

                <div class="space-y-4 text-sm">

                    <div class="flex justify-between">
                        <span>Git & GitHub</span>
                        <span class="text-muted">Advanced</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Figma</span>
                        <span class="text-muted">Intermediate</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Vite</span>
                        <span class="text-muted">Advanced</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Responsive Design</span>
                        <span class="text-muted">Advanced</span>
                    </div>

                </div>
            </div>

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
@vite(['resources/js/three-viewer.js'])
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
