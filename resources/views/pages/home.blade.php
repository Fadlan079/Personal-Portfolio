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

            <a href="https://www.linkedin.com/in/fadlan-firdaus-148344386 "
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

            <div class="pt-4" x-data="{
                    currentProject: 0,
                    totalProjects: {{ count($recentProjects) }},
                    timer: null,
                    init() {
                        this.startAuto();
                        this.$el.addEventListener('mouseenter', () => this.stopAuto());
                        this.$el.addEventListener('mouseleave', () => this.startAuto());
                    },
                    startAuto() {
                        this.stopAuto();
                        this.timer = setInterval(() => {
                            this.currentProject = (this.currentProject + 1) % this.totalProjects;
                        }, 4000);
                    },
                    stopAuto() { clearInterval(this.timer); }
                }">
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

<style>
/* ================================================================
   SKILL TREE — AC Origins / Grid Style
   Orthogonal connector lines, grid-dot BG, golden highlights
   ================================================================ */

#skills {
    position: relative;
    overflow: hidden;
}

/* Grid-dot overlay */
#skills::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.022) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events: none;
    z-index: 0;
}

/* ── SVG canvas for the tree ── */
#skt-svg {
    width: 100%;
    max-width: 1000px;
    display: block;
    overflow: visible;
    margin: 0 auto;
}

/* ── Connector lines ── */
.skt-edge {
    fill: none;
    stroke: rgba(200,185,155,0.18);
    stroke-width: 1.5;
    stroke-linecap: square;
    transition: stroke 0.28s, stroke-width 0.28s, filter 0.28s;
}

/* ── SVG node labels ── */
.skt-lbl {
    font-size: 8px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    fill: rgba(200,185,155,0.55);
    text-anchor: middle;
    dominant-baseline: hanging;
    pointer-events: none;
    transition: fill 0.25s;
    font-family: 'Space Grotesk', sans-serif;
}

/* ── Category side labels ── */
.skt-cat { pointer-events: none; }
.skt-cat-title {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.28em;
    text-transform: uppercase;
    text-anchor: middle;
    dominant-baseline: middle;
    font-family: 'Space Grotesk', sans-serif;
}
.skt-cat-sub {
    font-size: 6.5px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    text-anchor: middle;
    dominant-baseline: middle;
    opacity: 0.4;
    font-family: 'Space Grotesk', sans-serif;
}

/* ── Bottom gem bar ── */
.skt-bar {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 4px;
}
.skt-bar-line {
    width: 100px;
    height: 1px;
    background: rgba(200,185,155,0.14);
    position: relative;
}
.skt-bar-gem {
    position: absolute;
    left: 50%; top: 50%;
    transform: translate(-50%, -50%) rotate(45deg);
    width: 7px; height: 7px;
    border: 1.5px solid rgba(251,191,36,0.55);
    background: rgba(251,191,36,0.12);
    box-shadow: 0 0 6px rgba(251,191,36,0.3);
}
.skt-bar-txt {
    font-size: 0.5rem;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: rgba(200,185,155,0.38);
    font-family: 'Space Grotesk', sans-serif;
}

/* ── Tooltip ── */
.skt-tip {
    position: fixed;
    z-index: 9999;
    pointer-events: none;
    opacity: 0;
    width: 210px;
    transition: opacity 0.18s ease;
}
.skt-tip.show { opacity: 1; }
.skt-tip-inner {
    background: rgba(14,12,18,0.97);
    border: 1px solid rgba(200,185,155,0.17);
    box-shadow: 0 0 28px rgba(0,0,0,0.7), 0 0 0 1px rgba(0,0,0,0.5);
    padding: 11px 14px;
    backdrop-filter: blur(18px);
}
.skt-tip-cat {
    font-size: 0.5rem;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    margin-bottom: 3px;
    border-bottom: 1px solid rgba(200,185,155,0.09);
    padding-bottom: 4px;
}
.skt-tip-name {
    font-size: 0.9rem;
    font-weight: 700;
    font-family: 'Space Grotesk', sans-serif;
    margin: 4px 0 2px;
}
.skt-tip-sub {
    font-size: 0.58rem;
    font-style: italic;
    margin-bottom: 8px;
    color: rgba(200,185,155,0.5);
}
.skt-tip-proj {
    font-size: 0.58rem;
    color: rgba(200,185,155,0.65);
    display: flex;
    align-items: center;
    gap: 5px;
}
.skt-tip-proj::before {
    content: '▸';
    opacity: 0.6;
}
</style>

<section id="skills" class="py-24 border-t border-border bg-bg relative overflow-hidden">

    {{-- Radial glow --}}
    <div class="absolute inset-0 pointer-events-none z-0">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px]"
             style="background: radial-gradient(ellipse 80% 60% at 50% 50%, rgba(251,191,36,0.04) 0%, transparent 65%); pointer-events:none;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">

        {{-- Header --}}
        <div class="text-center mb-12 relative z-20">
            <p class="text-sm uppercase tracking-widest text-muted mb-4">Technical Skills</p>
            <h3 class="text-3xl md:text-4xl font-semibold leading-tight mb-6">Interactive Skill Tree</h3>
            <p class="text-muted max-w-2xl mx-auto leading-loose">
                I build structured, scalable web applications. Explore my core specialization domains and the stack I utilize. Hover and click around!
            </p>
        </div>

        {{-- SVG Tree (all rendered by JS) --}}
        <svg id="skt-svg" viewBox="0 0 1000 520" preserveAspectRatio="xMidYMid meet">
            <defs>
                <filter id="skt-glow" x="-50%" y="-50%" width="200%" height="200%">
                    <feGaussianBlur stdDeviation="3" result="b"/>
                    <feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge>
                </filter>
            </defs>
            <g id="skt-edges"></g>
            <g id="skt-nodes"></g>
            <g id="skt-labels"></g>
            <g id="skt-cats"></g>
        </svg>

        {{-- Bottom bar --}}
        <div class="skt-bar">
            <div class="skt-bar-line"><div class="skt-bar-gem"></div></div>
            <span class="skt-bar-txt">Skill Points</span>
            <div class="skt-bar-line"><div class="skt-bar-gem"></div></div>
        </div>

    </div>
</section>

{{-- Tooltip (fixed, outside section) --}}
<div class="skt-tip" id="sktTip2">
    <div class="skt-tip-inner">
        <p class="skt-tip-cat" id="sT2Cat"></p>
        <p class="skt-tip-name" id="sT2Name"></p>
        <p class="skt-tip-sub"  id="sT2Sub"></p>
        <p class="skt-tip-proj" id="sT2Proj"></p>
    </div>
</div>

<script>
(function () {
/* ================================================================
   AC Origins Skill Tree — DB-driven
   Data source: #skt-svg[data-skills] (or fallback to inline JSON)
   ================================================================ */

/* ── DB Skills (injected by Blade) ── */
const DB_SKILLS = @json($skills);

/* ── Category config ── */
const CAT = {
    backend:  { label: 'BACKEND',  sub: 'Server · Database · API', color: '#f87171' },
    frontend: { label: 'FRONTEND', sub: 'UI · Markup · Styling',   color: '#38bdf8' },
    tools:    { label: 'TOOLS',    sub: 'Scripting · DevOps',      color: '#a3e635' },
    core:     { label: '',         sub: '',                        color: '#fbbf24' },
};

/* ── Color per category ── */
function catColor(cat) {
    return (CAT[cat] || CAT.tools).color;
}

/* ── ViewBox: 1000 × 520, center = (500, 260) ── */
const CX = 500, CY = 80;   /* root node */

/* ----------------------------------------------------------
   LAYOUT BUILDER
   Reads DB_SKILLS, groups by category, places them on a grid.

   Grid column X values:  [160, 310, 500, 690, 840]
   Grid row    Y values:  [80,  180, 290, 400]

   Core:    (500, 80)   — top center
   Backend  branch:  left side
   Frontend branch:  right side
   Tools    branch:  outer left/right

   This creates the clean diamond / circuit-board look.
   ---------------------------------------------------------- */
function buildLayout() {
    /* Separate by category */
    const bycat = { backend: [], frontend: [], tools: [] };
    DB_SKILLS.forEach(s => {
        const c = bycat[s.category] || bycat.tools;
        c.push(s);
    });

    /* Static skill node positions.
       We place up to the actual number in each category.
       If a category has more skills than slots, they stack. */

    /* Fixed "hub" nodes for categories */
    const nodes = [
        { id: 'root', label: 'Skills', icon: 'fa-solid fa-code', category: 'core',
          color: '#fbbf24', x: 500, y: 80, r: 36, dbSkill: null },
    ];

    const edges = [];

    /* ── Category hub positions ── */
    const hubs = {
        backend:  { id: 'hub-backend',  x: 310, y: 210, r: 28 },
        frontend: { id: 'hub-frontend', x: 690, y: 210, r: 28 },
        tools:    { id: 'hub-tools',    x: 500, y: 310, r: 28 },
    };

    Object.entries(hubs).forEach(([cat, hub]) => {
        if (!bycat[cat].length) return;
        nodes.push({
            id: hub.id, label: CAT[cat].label, icon: catIconFor(cat),
            category: cat, color: catColor(cat),
            x: hub.x, y: hub.y, r: hub.r, dbSkill: null, isHub: true,
        });
        edges.push(['root', hub.id]);
    });

    /* ── Skill node positions per category ── */
    const skillSlots = {
        backend: [
            { x: 160, y: 320 }, { x: 310, y: 360 }, { x: 160, y: 430 },
            { x: 310, y: 460 }, { x: 80,  y: 430 },
        ],
        frontend: [
            { x: 840, y: 320 }, { x: 690, y: 360 }, { x: 840, y: 430 },
            { x: 690, y: 460 }, { x: 920, y: 430 },
        ],
        tools: [
            { x: 370, y: 420 }, { x: 630, y: 420 }, { x: 500, y: 470 },
            { x: 250, y: 470 }, { x: 750, y: 470 },
        ],
    };

    Object.entries(bycat).forEach(([cat, skills]) => {
        const hub = hubs[cat];
        if (!hub || !skills.length) return;
        const slots = skillSlots[cat] || [];
        skills.forEach((s, i) => {
            const slot = slots[i] || { x: hub.x + (i - 2) * 80, y: hub.y + 120 };
            const nid = 'skill-' + s.id;
            nodes.push({
                id: nid, label: s.name, icon: s.icon,
                category: cat, color: catColor(cat),
                x: slot.x, y: slot.y, r: 24,
                dbSkill: s,
            });
            edges.push([hub.id, nid]);
        });
    });

    return { nodes, edges };
}

/* Category hub icons */
function catIconFor(cat) {
    return { backend:'fa-solid fa-server', frontend:'fa-regular fa-window-maximize', tools:'fa-solid fa-toolbox' }[cat] || 'fa-solid fa-circle';
}

/* ----------------------------------------------------------
   SVG helpers
   ---------------------------------------------------------- */
const NS = 'http://www.w3.org/2000/svg';
function svgEl(tag, attrs) {
    const e = document.createElementNS(NS, tag);
    Object.entries(attrs || {}).forEach(([k,v]) => e.setAttribute(k, v));
    return e;
}

/* Orthogonal L-shaped path */
function orthoPath(x1, y1, x2, y2) {
    if (Math.abs(x1 - x2) < 2) return `M${x1} ${y1}L${x2} ${y2}`;
    if (Math.abs(y1 - y2) < 2) return `M${x1} ${y1}L${x2} ${y2}`;
    const my = y1 + (y2 - y1) * 0.5;
    return `M${x1} ${y1}L${x1} ${my}L${x2} ${my}L${x2} ${y2}`;
}

/* ----------------------------------------------------------
   RENDER
   ---------------------------------------------------------- */
const svg       = document.getElementById('skt-svg');
const edgeLayer = document.getElementById('skt-edges');
const nodeLayer = document.getElementById('skt-nodes');
const lblLayer  = document.getElementById('skt-labels');
const catLayer  = document.getElementById('skt-cats');
const tip       = document.getElementById('sktTip2');

const { nodes, edges } = buildLayout();

/* Lookup */
const byId = {};
nodes.forEach(n => byId[n.id] = n);

let activeId = null;

/* ── Draw edges ── */
edges.forEach(([fid, tid]) => {
    const f = byId[fid], t = byId[tid];
    if (!f || !t) return;
    const d = orthoPath(f.x, f.y, t.x, t.y);
    const len = Math.abs(t.x-f.x) + Math.abs(t.y-f.y) + 10;
    const path = svgEl('path', {
        d, class: 'skt-edge',
        'stroke-dasharray': len,
        'stroke-dashoffset': len,
        'data-from': fid, 'data-to': tid,
    });
    edgeLayer.appendChild(path);
    requestAnimationFrame(() => {
        path.style.transition = `stroke-dashoffset ${0.5 + len/900}s ease`;
        path.style.strokeDashoffset = '0';
    });
});

/* ── Draw nodes ── */
nodes.forEach(n => {
    /* Circle */
    const c = svgEl('circle', {
        cx: n.x, cy: n.y, r: n.r,
        fill: 'rgba(22,20,26,0.93)',
        stroke: 'rgba(200,185,155,0.3)',
        'stroke-width': '1.5',
        'data-nid': n.id,
        style: 'cursor:pointer;transition:stroke 0.25s,filter 0.25s;',
    });
    nodeLayer.appendChild(c);

    /* Icon via foreignObject */
    const fs = n.r * 1.1;
    const fo = svgEl('foreignObject', {
        x: n.x - fs/2, y: n.y - fs/2,
        width: fs, height: fs,
        style: 'pointer-events:none;overflow:visible;',
    });
    const div = document.createElement('div');
    div.style.cssText = `width:${fs}px;height:${fs}px;display:flex;align-items:center;justify-content:center;font-size:${fs*0.52}px;color:rgba(210,200,185,0.55);transition:color 0.25s;`;
    div.dataset.nid = n.id;
    /* icon: DB skills store raw HTML, hub nodes store plain class string — handle both */
    const ic = (n.icon || '').trim();
    div.innerHTML = ic.startsWith('<') ? ic : `<i class="${ic}" aria-hidden="true"></i>`;
    fo.appendChild(div);
    nodeLayer.appendChild(fo);

    /* Label */
    const lbl = svgEl('text', {
        x: n.x, y: n.y + n.r + 11,
        class: 'skt-lbl', 'data-nlbl': n.id,
    });
    lbl.textContent = n.label;
    lblLayer.appendChild(lbl);

    /* Events */
    c.addEventListener('mouseenter', (e) => onEnter(n, e));
    c.addEventListener('mousemove',  (e) => moveTip(e));
    c.addEventListener('mouseleave', onLeave);
    c.addEventListener('click',      () => toggleActive(n.id));
});

/* ── Category side labels ── */
const catPlacements = [
    { cat:'backend',  x: 52,  y: 320, angle: -90 },
    { cat:'frontend', x: 948, y: 320, angle:  90 },
    { cat:'tools',    x: 500, y: 500, angle:   0 },
];
catPlacements.forEach(p => {
    const info = CAT[p.cat];
    if (!info) return;
    const g = svgEl('g', { class:'skt-cat', transform:`translate(${p.x},${p.y}) rotate(${p.angle})` });

    const line = svgEl('line', { x1:-30, y1:-13, x2:30, y2:-13,
        stroke: info.color, 'stroke-width':'0.5', opacity:'0.3' });
    const t1 = svgEl('text', { class:'skt-cat-title', fill: info.color, 'font-size':'9', y:'-4' });
    t1.textContent = info.label;
    const t2 = svgEl('text', { class:'skt-cat-sub', fill: info.color, 'font-size':'6', y:'7' });
    t2.textContent = info.sub;

    g.appendChild(line); g.appendChild(t1); g.appendChild(t2);
    catLayer.appendChild(g);
});

/* ── Hover / Active ── */
function onEnter(n, e) {
    if (n.id === activeId) return;
    setNodeHighlight(n.id, n.color, false);
    if (n.dbSkill || n.isHub) showTip(n, e);
}
function onLeave() {
    hideTip();
    if (activeId) return;
    nodes.forEach(n => resetNode(n.id));
}

function toggleActive(id) {
    const prev = activeId;
    activeId = id === activeId ? null : id;
    nodes.forEach(n => {
        if (n.id === activeId) setNodeHighlight(n.id, n.color, true);
        else resetNode(n.id);
    });
    /* Edge highlight */
    edgeLayer.querySelectorAll('.skt-edge').forEach(p => {
        const f = p.dataset.from, t = p.dataset.to;
        const lit = f === activeId || t === activeId;
        const col = lit ? (byId[f]?.color || byId[t]?.color || '#fbbf24') : 'rgba(200,185,155,0.18)';
        p.setAttribute('stroke', col);
        p.setAttribute('stroke-width', lit ? '2.5' : '1.5');
        p.style.filter = lit ? `drop-shadow(0 0 4px ${col})` : '';
    });
}

function setNodeHighlight(id, color, active) {
    const c = nodeLayer.querySelector(`circle[data-nid="${id}"]`);
    const d = nodeLayer.querySelector(`[data-nid="${id}"]`);
    const l = lblLayer.querySelector(`[data-nlbl="${id}"]`);
    if (c) {
        c.setAttribute('stroke', color);
        c.setAttribute('fill', 'rgba(34,30,24,0.96)');
        c.style.filter = `drop-shadow(0 0 ${active ? 9 : 6}px ${color})`;
    }
    if (d) d.style.color = color;
    if (l) l.setAttribute('fill', color);
}
function resetNode(id) {
    const c = nodeLayer.querySelector(`circle[data-nid="${id}"]`);
    const d = nodeLayer.querySelector(`[data-nid="${id}"]`);
    const l = lblLayer.querySelector(`[data-nlbl="${id}"]`);
    if (c) { c.setAttribute('stroke','rgba(200,185,155,0.3)'); c.setAttribute('fill','rgba(22,20,26,0.93)'); c.style.filter=''; }
    if (d) d.style.color = 'rgba(210,200,185,0.55)';
    if (l) l.setAttribute('fill','rgba(200,185,155,0.55)');
}

/* ── Tooltip ── */
function showTip(n, e) {
    const cat = CAT[n.category] || {};
    document.getElementById('sT2Cat').textContent  = cat.label || '';
    document.getElementById('sT2Cat').style.color  = n.color;
    document.getElementById('sT2Name').textContent = n.label;
    document.getElementById('sT2Name').style.color = n.color;
    document.getElementById('sT2Sub').textContent  = n.isHub
        ? (cat.sub || '')
        : (n.dbSkill?.subtitle || '');
    const projEl = document.getElementById('sT2Proj');
    if (n.dbSkill) {
        const pc = n.dbSkill.projects_count || 0;
        projEl.textContent = pc + (pc === 1 ? ' project' : ' projects');
        projEl.style.display = '';
    } else {
        projEl.style.display = 'none';
    }
    moveTip(e);
    tip.classList.add('show');
}
function moveTip(e) {
    const TW = 220, TH = 120;
    let tx = e.clientX + 16, ty = e.clientY - TH / 2;
    if (tx + TW > window.innerWidth)  tx = e.clientX - TW - 16;
    if (ty < 6)                        ty = 6;
    if (ty + TH > window.innerHeight)  ty = window.innerHeight - TH - 6;
    tip.style.left = tx + 'px'; tip.style.top = ty + 'px';
}
function hideTip() { tip.classList.remove('show'); }

/* ── Edge draw-in on scroll into view ── */
const obs = new IntersectionObserver(entries => {
    entries.forEach(en => {
        if (!en.isIntersecting) return;
        edgeLayer.querySelectorAll('.skt-edge').forEach(p => {
            const len = parseFloat(p.getAttribute('stroke-dasharray')) || 400;
            p.style.transition = 'none';
            p.style.strokeDashoffset = len;
            requestAnimationFrame(() => {
                p.style.transition = `stroke-dashoffset ${0.5 + len/900}s ease`;
                p.style.strokeDashoffset = '0';
            });
        });
        obs.unobserve(en.target);
    });
}, { threshold: 0.1 });
obs.observe(document.getElementById('skills'));

})();
</script>

<section class="relative z-10 py-40 border-t border-border overflow-hidden bg-background flex items-center justify-center min-h-[60vh]">
    
    <div class="absolute w-[200%] flex whitespace-nowrap opacity-[0.03] hover:opacity-10 transition-opacity duration-700 cursor-default pointer-events-auto z-0 select-none" aria-hidden="true">
        <div class="animate-marquee text-[clamp(8rem,15vw,12rem)] font-extrabold tracking-tighter leading-none flex gap-8 text-text">
            <span data-i18n="home.cta_marquee">LET'S BUILD IT — GOT A PROJECT? —</span>
            <span data-i18n="home.cta_marquee">LET'S BUILD IT — GOT A PROJECT? —</span>
            <span data-i18n="home.cta_marquee" aria-hidden="true">LET'S BUILD IT — GOT A PROJECT? —</span>
            <span data-i18n="home.cta_marquee" aria-hidden="true">LET'S BUILD IT — GOT A PROJECT? —</span>
        </div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-6 text-center flex flex-col items-center group">
        
        <div class="inline-flex items-center gap-2 mb-8 bg-surface/50 border border-border px-4 py-2 rounded-full backdrop-blur-md">
            <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
            <p class="text-xs uppercase tracking-widest text-muted" data-i18n="home.cta_label">Available for work</p>
        </div>

        <h3 class="text-[clamp(3rem,7vw,5rem)] font-semibold leading-[1.05] mb-10 tracking-tight">
            <span data-i18n="home.cta_title">Got a project in mind?</span>
        </h3>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-6">
            <a href="{{ route('portofolio.contact') }}" class="relative overflow-hidden px-10 py-4 bg-primary text-text font-semibold border-2 border-primary hover:bg-transparent transition-all duration-300 transform hover:-translate-y-1 shadow-[0_0_30px_rgba(var(--color-primary-rgb),0.3)] group-hover:shadow-[0_0_50px_rgba(var(--color-primary-rgb),0.5)]">
                <span class="relative z-10 flex items-center gap-3">
                    <span data-i18n="home.cta_btn_primary">Start a Project</span>
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </span>
            </a>

            <a href="mailto:fadlanfirdaus220@gmail.com" class="px-10 py-4 border-2 border-border bg-surface/30 backdrop-blur-sm text-text font-semibold hover:border-primary transition-colors duration-300">
                <span class="flex items-center gap-3">
                    <span data-i18n="home.cta_btn_secondary">Send an Email</span>
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
