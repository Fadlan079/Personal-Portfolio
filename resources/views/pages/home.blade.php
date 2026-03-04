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
</section>

@php
    $skillsByCategory = $skills->groupBy('category');
@endphp

<section id="skills-cad" class="py-24 bg-background overflow-hidden relative font-mono text-text selection:bg-primary selection:text-black">
    <div class="absolute inset-0 z-0 opacity-10" style="background-image: linear-gradient(var(--color-border) 1px, transparent 1px), linear-gradient(90deg, var(--color-border) 1px, transparent 1px); background-size: 40px 40px;"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        
        <div class="border-t border-b border-text/20 py-2 flex justify-between text-[10px] uppercase tracking-widest mb-16">
            <span>DWG. NO: SKL-2026-X</span>
            <span>SCALE: 1:1</span>
            <span>REV: 05_FOCUS</span>
        </div>

        <div class="grid lg:grid-cols-2 gap-16 items-start">
            
            <div class="relative sticky top-24">
                <div class="absolute -top-4 -left-4 w-4 h-4 border-t border-l border-primary/50"></div>
                <h3 class="text-5xl md:text-7xl font-bold tracking-tighter uppercase mb-6 leading-[0.9]">
                    <span data-i18n="home.skills_cad.title_system">System</span> <br/> 
                    <span class="text-transparent border-text" style="-webkit-text-stroke: 1px var(--color-text);" data-i18n="home.skills_cad.title_arch">Architecture</span>
                </h3>
                <p class="text-xs uppercase leading-relaxed text-muted max-w-sm border-l border-primary/50 pl-4" data-i18n="home.skills_cad.desc">
                    Specification of technical capabilities. Select a sector to isolate and expand the schematic view.
                </p>
            </div>

            <div class="border border-text/20 relative p-8 min-h-[400px]" id="cad-schematic-box">
                <div class="absolute -top-1 -left-1 w-2 h-2 bg-primary"></div>
                <div class="absolute -bottom-1 -right-1 w-2 h-2 bg-primary"></div>
                <div class="absolute top-0 right-4 -translate-y-full text-[9px] py-1 text-muted">WIDTH: 100%</div>
                
                @php
                    $categories = [
                        ['id' => 'backend', 'name' => 'Backend Logic', 'sec' => 'Sec_A', 'ver' => '8.x', 'color' => '#f87171', 'sub' => 'Server · Database · API'],
                        ['id' => 'frontend', 'name' => 'Client Interface', 'sec' => 'Sec_B', 'ver' => '3.x', 'color' => '#38bdf8', 'sub' => 'UI · Markup · Styling'],
                        ['id' => 'tools', 'name' => 'DevOps & Tools', 'sec' => 'Sec_C', 'ver' => '1.x', 'color' => '#a3e635', 'sub' => 'Scripting · DevOps']
                    ];
                @endphp

                @foreach($categories as $cat)
                {{-- Kategori Block --}}
                <div class="cad-section mb-10 relative transition-all duration-500" id="sec-{{ $cat['id'] }}">
                    <div class="absolute -left-12 top-2 text-[10px] -rotate-90 text-primary uppercase">{{ $cat['sec'] }}</div>
                    
                    <div class="flex justify-between items-end border-b border-text/30 pb-2 mb-4">
                        <div>
                            <span class="text-sm font-bold uppercase tracking-widest">{{ $cat['name'] }}</span>
                            <span class="text-[10px] text-muted ml-2">VER {{ $cat['ver'] }}</span>
                        </div>
                        {{-- Tombol Expand / Focus --}}
                        <button class="cad-focus-btn text-[10px] uppercase tracking-widest text-primary hover:text-text transition-colors bg-transparent border-none cursor-pointer" 
                                onclick="toggleCadFocus('{{ $cat['id'] }}')">
                            [+] ISOLATE
                        </button>
                    </div>

                    {{-- Container Skill (Dengan limit tinggi default) --}}
                    <div class="cad-skill-list flex flex-wrap gap-3 overflow-hidden transition-all duration-700 max-h-[76px]" id="list-{{ $cat['id'] }}">
                        @foreach($skillsByCategory->get($cat['id'], []) as $skill)
                        <span class="skt-node px-3 py-1 border border-text/20 text-xs hover:bg-text hover:text-background transition-colors cursor-crosshair"
                              data-name="{{ $skill->name }}"
                              data-cat="{{ strtoupper($cat['id']) }}"
                              data-color="{{ $cat['color'] }}"
                              data-sub="{{ $cat['sub'] }}"
                              data-desc="{{ $skill->description }}"
                              data-proj="{{ $skill->projects_count }}">
                            {{ $skill->name }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>

<style>
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

{{-- Tooltip (fixed, outside section) --}}
<div class="skt-tip" id="sktTip2">
    <div class="skt-tip-inner">
        <p class="skt-tip-cat" id="sT2Cat"></p>
        <p class="skt-tip-name" id="sT2Name"></p>
        <p class="skt-tip-sub"  id="sT2Sub"></p>
        <p class="skt-tip-desc text-muted mt-2 text-xs leading-relaxed" id="sT2Desc"></p>
        <p class="skt-tip-proj mt-2 pt-2 border-t border-border/50" id="sT2Proj"></p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const tip = document.getElementById('sktTip2');
    const tipCat = document.getElementById('sT2Cat');
    const tipName = document.getElementById('sT2Name');
    const tipSub = document.getElementById('sT2Sub');
    const tipDesc = document.getElementById('sT2Desc');
    const tipProj = document.getElementById('sT2Proj');
    
    // Grab all skill nodes generated by blade
    const nodes = document.querySelectorAll('.skt-node');

    function showTip(e) {
        const t = e.target;
        
        // Extract data
        const cat = t.getAttribute('data-cat') || '';
        const name = t.getAttribute('data-name') || '';
        const color = t.getAttribute('data-color') || '#fbbf24';
        const sub = t.getAttribute('data-sub') || '';
        const desc = t.getAttribute('data-desc') || '';
        const proj = parseInt(t.getAttribute('data-proj') || '0', 10);

        // Update Tooltip DOM
        tipCat.textContent = cat;
        tipCat.style.color = color;
        
        tipName.textContent = name;
        tipName.style.color = color;
        
        tipSub.textContent = sub;
        
        if (desc) {
            tipDesc.textContent = desc;
            tipDesc.style.display = 'block';
        } else {
            tipDesc.style.display = 'none';
        }

        if (proj > 0) {
            tipProj.textContent = proj + (proj === 1 ? ' project' : ' projects');
            tipProj.style.display = 'flex';
        } else {
            tipProj.style.display = 'none';
        }

        moveTip(e);
        tip.classList.add('show');
    }

    function moveTip(e) {
        const TW = 220, TH = tip.offsetHeight || 120;
        let tx = e.clientX + 16, ty = e.clientY - TH / 2;
        
        // Screen bounds checking
        if (tx + TW > window.innerWidth) tx = e.clientX - TW - 16;
        if (ty < 6) ty = 6;
        if (ty + TH > window.innerHeight) ty = window.innerHeight - TH - 6;
        
        tip.style.left = tx + 'px';
        tip.style.top = ty + 'px';
    }

    function hideTip() {
        tip.classList.remove('show');
    }

    // Attach listeners to nodes
    nodes.forEach(node => {
        node.addEventListener('mouseenter', showTip);
        node.addEventListener('mousemove', moveTip);
        node.addEventListener('mouseleave', hideTip);
    });
});

// Logika untuk Focus Mode (Isolate View)
function toggleCadFocus(targetId) {
    const sections = ['backend', 'frontend', 'tools'];
    const targetSec = document.getElementById('sec-' + targetId);
    const isCurrentlyFocused = targetSec.classList.contains('is-focused');

    sections.forEach(id => {
        const sec = document.getElementById('sec-' + id);
        const list = document.getElementById('list-' + id);
        const btn = sec.querySelector('.cad-focus-btn');

        if (!isCurrentlyFocused) {
            // Mau masuk Focus Mode
            if (id === targetId) {
                sec.style.display = 'block';
                sec.classList.add('is-focused');
                list.style.maxHeight = '2000px'; // Buka batas tinggi
                btn.innerHTML = '[-] RETURN';
                btn.classList.replace('text-primary', 'text-red-500'); // Ganti warna tombol buat indikasi balik
            } else {
                sec.style.display = 'none'; // Sembunyikan kategori lain
            }
        } else {
            // Mau balik ke mode Normal (Tampil semua)
            sec.style.display = 'block';
            sec.classList.remove('is-focused');
            list.style.maxHeight = '76px'; // Kembalikan batas tinggi (sesuaikan pixel ini dgn kira-kira 2 baris skill)
            btn.innerHTML = '[+] ISOLATE';
            btn.classList.replace('text-red-500', 'text-primary');
        }
    });
}
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
