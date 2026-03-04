@extends('layouts.main')
@section('title', 'About')
<style>
    .constraint-line {
        opacity: 0.15;
        transform: translateX(-10%);
        white-space: nowrap;
    }
    
    /* Efek scanline untuk foto */
    .scanlines {
        background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(255,255,255,0) 50%, rgba(0,0,0,0.1) 50%, rgba(0,0,0,0.1));
        background-size: 100% 4px;
    }
</style>

@section('content')
<section class="relative max-w-7xl mx-auto px-6 py-32 space-y-32 overflow-x-hidden">
    
    {{-- 1. HERO SECTION --}}
    <div class="space-y-8" id="about-hero">
        <div class="flex items-center gap-4 mb-8 font-mono">
            <span class="px-2 py-1 bg-primary/10 text-primary border border-primary/20 text-[10px] uppercase tracking-widest">
                SYS.DOCS
            </span>
            <span class="text-xs text-muted">/about_operator</span>
        </div>

        <h1 id="about-title" class="text-[clamp(3rem,9vw,8rem)] font-bold tracking-tighter leading-[0.95] text-text uppercase" data-i18n="about.title">
            The Logic
        </h1>
        <h2 id="about-outline" class="text-[clamp(2.5rem,7vw,6rem)] font-bold tracking-tighter leading-tight text-transparent uppercase" style="-webkit-text-stroke: 1px var(--color-text);" data-i18n="about.hero_outline">
            Behind the code.
        </h2>
    </div>

    {{-- 2. THE OPERATOR SPEC SHEET (Diambil dari teaser & di-expand) --}}
    <div class="grid lg:grid-cols-[450px_1fr] gap-12 lg:gap-20 items-start border-t border-border/50 pt-20" id="about-profile">
        
        {{-- Left: Visual Component (Photo) --}}
        <div class="relative group sticky top-24 w-90">
            <div class="absolute -inset-4 border border-border/50 z-0 transition-transform duration-500 group-hover:scale-[1.02]"></div>
            <div class="absolute -top-5 -left-5 w-3 h-3 border-t-2 border-l-2 border-primary z-20"></div>
            <div class="absolute -bottom-5 -right-5 w-3 h-3 border-b-2 border-r-2 border-primary z-20"></div>
            
            <div class="absolute top-4 -right-8 text-[9px] font-mono text-muted -rotate-90 tracking-widest uppercase origin-bottom-right">
                Fig. 01 — Operator
            </div>

            <div class="relative z-10 aspect-[4/5] bg-surface border border-border overflow-hidden flex items-center justify-center filter grayscale group-hover:grayscale-0 transition-all duration-700">
                <img src="{{ $profilePhoto }}" alt="Fadlan" class="w-4/5 h-4/5 object-contain mx-auto my-auto opacity-80 group-hover:opacity-100 transition-all duration-500">
                <div class="absolute inset-0 scanlines pointer-events-none"></div>
            </div>
        </div>

        

        {{-- Right: Detailed Specs & Narrative --}}
        <div class="font-mono space-y-12">
            
            {{-- Quick Stats Table --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-6 py-6 border-b border-border/50 text-xs">
                <div>
                    <p class="text-[10px] text-muted tracking-widest uppercase mb-1">Designation</p>
                    <p class="font-semibold text-text">Full Stack Developer</p>
                </div>
                <div>
                    <p class="text-[10px] text-muted tracking-widest uppercase mb-1">Status</p>
                    <p class="font-semibold text-primary flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                        Operational
                    </p>
                </div>
                <div>
                    <p class="text-[10px] text-muted tracking-widest uppercase mb-1">Location</p>
                    <p class="font-semibold text-text">Indonesia</p>
                </div>
            </div>

            {{-- The Narrative (Versi Lengkap) --}}
            <div class="font-sans space-y-6 text-lg text-muted leading-relaxed">
                <p class="text-text font-medium" data-i18n="about.narrative_1">
                    I am a software developer who believes that writing code is just as much about communication as it is about logic. I build digital products that are not only robust under the hood but also intuitive on the surface.
                </p>
                <p data-i18n="about.narrative_2">
                    My journey started with a deep curiosity about how systems interact. Over the years, I've transitioned from simple scripts to architecting complex full-stack web applications. I focus heavily on clean architecture, scalable databases, and pixel-perfect interfaces. 
                </p>
                <p data-i18n="about.narrative_3">
                    When I'm not debugging or optimizing queries, I'm usually exploring new tech stacks, refining my UI/UX intuition, or figuring out how to make things run just a millisecond faster.
                </p>
            </div>
        </div>
    </div>

    {{-- ==========================================
         SECTION A: BACKGROUND (SYSTEM FOUNDATION)
         ========================================== --}}
    <div class="pt-32 border-t border-border/50" id="about-background">
        <div class="grid md:grid-cols-12 gap-8 lg:gap-16 items-start">
            
            {{-- Left: Tech Label --}}
            <div class="md:col-span-4 font-mono">
                <div class="sticky top-24">
                    <span class="inline-block px-2 py-1 bg-surface border border-border text-[10px] uppercase tracking-widest text-muted mb-4">
                        Phase 01 // Origin
                    </span>
                    <h3 class="text-3xl font-bold tracking-tighter uppercase text-text mb-4">
                        System <br> Foundation
                    </h3>
                    <div class="w-12 h-[2px] bg-primary/50"></div>
                </div>
            </div>

            {{-- Right: Content with CAD styling --}}
            <div class="md:col-span-8 space-y-8 text-muted font-sans text-lg leading-relaxed relative">
                <div class="absolute inset-0 border border-border/30 bg-[linear-gradient(var(--color-border)_1px,transparent_1px),linear-gradient(90deg,var(--color-border)_1px,transparent_1px)] bg-[size:20px_20px] opacity-10 pointer-events-none -z-10 -m-8 p-8"></div>
                
                <p class="text-text font-medium" data-i18n="about.bg_1">
                    Every robust system starts with a solid architecture. My foundation wasn't just built on writing syntax, but on understanding how machines process logic and how humans interact with that processing.
                </p>
                <p data-i18n="about.bg_2">
                    Coming from a background in [Masukkan Jurusan/Latar Belakang Pendidikanmu], I developed a rigorous approach to problem-solving. It taught me to break down monolithic problems into modular, manageable micro-tasks. I don't just look at the code; I look at the entire data lifecycle.
                </p>
                
                {{-- Data Cards for Background --}}
                <div class="grid sm:grid-cols-2 gap-4 pt-6 font-mono">
                    <div class="p-4 border border-border/50 bg-surface/30 relative group">
                        <div class="absolute top-0 left-0 w-full h-[1px] bg-primary transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                        <p class="text-[10px] text-muted tracking-widest uppercase mb-2">Base Knowledge</p>
                        <p class="text-sm font-bold text-text">Computer Science & Logic</p>
                    </div>
                    <div class="p-4 border border-border/50 bg-surface/30 relative group">
                        <div class="absolute top-0 left-0 w-full h-[1px] bg-primary transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                        <p class="text-[10px] text-muted tracking-widest uppercase mb-2">Core Paradigm</p>
                        <p class="text-sm font-bold text-text">Object-Oriented & MVC</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ==========================================
         SECTION B: JOURNEY (EXECUTION PATH / GIT LOG)
         ========================================== --}}
    <div class="pt-32 border-t border-border/50" id="about-journey">
        <div class="mb-16">
            <h3 class="text-[clamp(2rem,5vw,4rem)] font-bold tracking-tighter uppercase leading-none mb-4">Execution Path</h3>
            
            {{-- Terminal Header Frame --}}
            <div class="inline-flex items-center gap-3 px-4 py-2 border border-border bg-surface/50 font-mono text-xs text-muted">
                <span class="text-primary">></span>
                <span class="typing-effect">git log --graph --oneline --decorate --all</span>
                <span class="w-2 h-3 bg-text animate-pulse"></span>
            </div>
        </div>

        <div class="relative max-w-4xl font-mono ml-4 md:ml-8">
            {{-- The Vertical Git Line --}}
            <div class="absolute top-2 bottom-0 left-[7px] w-[2px] bg-border/50"></div>

            <div class="space-y-16">
                {{-- Node 1: Present --}}
                <div class="relative pl-10 md:pl-16 group">
                    <div class="absolute left-0 top-1 w-4 h-4 rounded-full border-[3px] border-primary bg-background z-10 shadow-[0_0_10px_var(--color-primary)] group-hover:scale-125 transition-transform"></div>
                    <div class="absolute left-[7px] top-5 w-[2px] h-full bg-primary/30 origin-top scale-y-0 group-hover:scale-y-100 transition-transform duration-500"></div>
                    
                    <span class="text-[10px] text-primary tracking-widest uppercase mb-2 block bg-primary/10 inline-block px-2 py-0.5 rounded">HEAD -> main</span>
                    <h4 class="text-2xl font-bold text-text mb-2 font-sans">Full Stack Developer</h4>
                    <p class="text-xs text-muted mb-4 uppercase tracking-widest">2024 — Present</p>
                    <p class="text-sm text-muted font-sans leading-relaxed max-w-2xl">
                        Architecting full-scale applications, optimizing database queries, and leading frontend-backend integrations. Currently focusing on building scalable SaaS products and refining system architectures.
                    </p>
                </div>

                {{-- Node 2: Middle --}}
                <div class="relative pl-10 md:pl-16 group opacity-80 hover:opacity-100 transition-opacity">
                    <div class="absolute left-0 top-1 w-4 h-4 rounded-full border-[3px] border-text/50 bg-background z-10 group-hover:border-text transition-colors"></div>
                    
                    <span class="text-[10px] text-muted tracking-widest uppercase mb-2 block">Commit: a1b2c3d</span>
                    <h4 class="text-xl font-bold text-text mb-2 font-sans">Frontend Engineer</h4>
                    <p class="text-xs text-muted mb-4 uppercase tracking-widest">2022 — 2024</p>
                    <p class="text-sm text-muted font-sans leading-relaxed max-w-2xl">
                        Dived deep into client-side rendering. Mastered Vue.js, component-driven design, and state management. Built multiple highly interactive dashboards and landing pages.
                    </p>
                </div>

                {{-- Node 3: Beginning --}}
                <div class="relative pl-10 md:pl-16 group opacity-60 hover:opacity-100 transition-opacity">
                    <div class="absolute left-0 top-1 w-4 h-4 rounded-full border-[3px] border-text/30 bg-background z-10 group-hover:border-text transition-colors"></div>
                    
                    <span class="text-[10px] text-muted tracking-widest uppercase mb-2 block">Commit: Initial</span>
                    <h4 class="text-xl font-bold text-text mb-2 font-sans">The Genesis</h4>
                    <p class="text-xs text-muted mb-4 uppercase tracking-widest">2020 — 2022</p>
                    <p class="text-sm text-muted font-sans leading-relaxed max-w-2xl">
                        Wrote my first lines of code. Transitioned from static HTML/CSS to understanding server logic with PHP. The realization that I could build digital ecosystems from scratch sparked a lifelong obsession.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- ==========================================
         SECTION C: VISIONS / GOALS (DEPLOYMENT ROADMAP)
         ========================================== --}}
    <div class="pt-32 pb-16 border-t border-border/50" id="about-visions">
        <div class="relative border border-border bg-surface/20 p-8 md:p-16 overflow-hidden">
            
            {{-- Target / Radar Background Decorative --}}
            <div class="absolute inset-0 flex items-center justify-end opacity-[0.03] pointer-events-none -mr-32">
                <svg width="600" height="600" viewBox="0 0 100 100" fill="none" stroke="currentColor">
                    <circle cx="50" cy="50" r="45" stroke-width="0.2" stroke-dasharray="1 2"/>
                    <circle cx="50" cy="50" r="30" stroke-width="0.2"/>
                    <circle cx="50" cy="50" r="15" stroke-width="0.2"/>
                    <path d="M50 0 V100 M0 50 H100" stroke-width="0.2"/>
                </svg>
            </div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-3 h-3 bg-primary animate-ping"></div>
                    <span class="font-mono text-[10px] uppercase tracking-widest text-primary">Target Locked</span>
                </div>
                
                <h3 class="text-4xl md:text-5xl font-bold tracking-tighter uppercase mb-12 text-text font-sans">
                    Deployment <br> Vision
                </h3>

                <div class="grid md:grid-cols-2 gap-12 font-mono">
                    
                    {{-- Goal 1: Short Term --}}
                    <div class="relative group">
                        <div class="absolute -left-4 top-0 w-[2px] h-full bg-border group-hover:bg-primary transition-colors"></div>
                        <p class="text-[10px] text-muted tracking-widest uppercase mb-3">Phase_01 // Immediate</p>
                        <h4 class="text-lg font-bold text-text mb-3">Architecting Microservices</h4>
                        <p class="text-sm text-muted font-sans leading-relaxed">
                            Transitioning from monolithic architectures to scalable, decoupled microservices. Exploring advanced DevOps pipelines (Docker, Kubernetes) to ensure zero-downtime deployments.
                        </p>
                    </div>

                    {{-- Goal 2: Long Term --}}
                    <div class="relative group">
                        <div class="absolute -left-4 top-0 w-[2px] h-full bg-border group-hover:bg-text transition-colors"></div>
                        <p class="text-[10px] text-muted tracking-widest uppercase mb-3">Phase_02 // Long-Term</p>
                        <h4 class="text-lg font-bold text-text mb-3">Open Source & Community</h4>
                        <p class="text-sm text-muted font-sans leading-relaxed">
                            Giving back to the developer ecosystem. My ultimate goal is to author open-source packages that simplify complex logic for other developers and mentor the next generation of engineers.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- 3. THE CHANGELOG / EXPERIENCE (Section Baru: Riwayat/Pengalaman) --}}
    <div class="pt-20 border-t border-border/50" id="about-changelog">
        <div class="flex items-center gap-4 mb-16">
            <h3 class="text-3xl font-bold font-mono uppercase tracking-tighter">Operational History</h3>
            <div class="flex-1 h-[1px] bg-border/50"></div>
            <span class="text-[10px] font-mono text-muted tracking-widest">>> SYSTEM.LOG</span>
        </div>

        <div class="space-y-12 max-w-4xl font-mono">
            {{-- Item 1 --}}
            <div class="grid md:grid-cols-[150px_1fr] gap-4 md:gap-12 group">
                <div class="text-xs text-muted pt-1 flex items-start gap-4">
                    <span class="opacity-50">2024 - Present</span>
                </div>
                <div class="relative pl-6 md:pl-0 border-l border-border md:border-none">
                    <div class="absolute -left-[5px] top-1.5 w-2 h-2 rounded-full bg-primary md:hidden"></div>
                    <span class="text-[10px] text-primary tracking-widest uppercase mb-2 block">v3.0.0 — Current Build</span>
                    <h4 class="text-xl font-bold text-text mb-2 font-sans">Full Stack Developer</h4>
                    <p class="text-sm text-muted font-sans leading-relaxed">Focusing on enterprise-level web applications using Laravel and Vue.js. Architecting databases, designing RESTful APIs, and ensuring high-performance server-side rendering.</p>
                </div>
            </div>

            {{-- Item 2 --}}
            <div class="grid md:grid-cols-[150px_1fr] gap-4 md:gap-12 group">
                <div class="text-xs text-muted pt-1 flex items-start gap-4">
                    <span class="opacity-50">2022 - 2024</span>
                </div>
                <div class="relative pl-6 md:pl-0 border-l border-border md:border-none">
                    <div class="absolute -left-[5px] top-1.5 w-2 h-2 rounded-full border border-text bg-background md:hidden"></div>
                    <span class="text-[10px] text-muted tracking-widest uppercase mb-2 block">v2.1.0 — Expansion</span>
                    <h4 class="text-xl font-bold text-text mb-2 font-sans">Frontend Engineer</h4>
                    <p class="text-sm text-muted font-sans leading-relaxed">Specialized in responsive design and interactive user interfaces. Deep dive into JavaScript frameworks, TailwindCSS, and state management.</p>
                </div>
            </div>

            {{-- Item 3 --}}
            <div class="grid md:grid-cols-[150px_1fr] gap-4 md:gap-12 group opacity-70">
                <div class="text-xs text-muted pt-1 flex items-start gap-4">
                    <span class="opacity-50">2020 - 2022</span>
                </div>
                <div class="relative pl-6 md:pl-0 border-l border-border md:border-none">
                    <div class="absolute -left-[5px] top-1.5 w-2 h-2 rounded-full border border-text bg-background md:hidden"></div>
                    <span class="text-[10px] text-muted tracking-widest uppercase mb-2 block">v1.0.0 — Genesis</span>
                    <h4 class="text-xl font-bold text-text mb-2 font-sans">Web Developer Intern</h4>
                    <p class="text-sm text-muted font-sans leading-relaxed">Learned the fundamentals of web architecture, basic PHP, and relational databases. Deployed first live applications.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. VALUES / PRINCIPLES (Versi lama yang dipercantik border-nya) --}}
    <div class="space-y-16 pt-20 border-t border-border/50" id="about-values">
        <div class="space-y-2">
            <h3 class="text-[clamp(2.5rem,6vw,4rem)] font-bold tracking-tighter leading-none text-text uppercase" data-i18n="about.values_title">
                Core Directives
            </h3>
            <p class="text-xs font-mono uppercase tracking-widest text-muted" data-i18n="about.values_subtitle">Guiding principles for every deployment.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-12">
            @for ($i = 0; $i < 4; $i++)
                <div class="value-item group space-y-4 border-t border-text/10 pt-4 hover:border-primary transition-colors">
                    <div class="text-[10px] font-mono text-muted">0{{ $i + 1 }}</div>
                    <div class="value-title text-2xl font-bold leading-none uppercase tracking-tight
                                {{ $i === 1 ? 'text-primary' : 'text-text' }}"
                         data-i18n="about.principles.{{ $i }}.title">
                    </div>
                    <div class="value-desc text-sm text-muted font-sans leading-relaxed"
                         data-i18n="about.principles.{{ $i }}.desc">
                    </div>
                </div>
            @endfor
        </div>
    </div>

    {{-- 5. CONSTRAINTS (Biarkan sama, efek ini selalu keren) --}}
    <div class="relative pt-20" id="about-constraints">
        <div class="constraint-pin h-[50vh] flex items-center overflow-hidden border-y border-border/50 bg-surface/30">
            <div class="constraint-wall space-y-8 w-full">
                <div class="space-y-4 text-[clamp(2rem,5vw,4rem)] font-bold uppercase tracking-tighter leading-none font-sans">
                    <div class="constraint-line text-text" data-i18n="about.constraints_lines.0">Design systems that scale.</div>
                    <div class="constraint-line text-transparent" style="-webkit-text-stroke: 1px var(--color-primary);" data-i18n="about.constraints_lines.1">Write code that humans can read.</div>
                    <div class="constraint-line text-text" data-i18n="about.constraints_lines.2">Refactor ruthlessly.</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 6. END SECTION --}}
<section id="about-end" class="relative py-40 border-t border-border overflow-hidden">
    <div class="absolute right-0 bottom-0 opacity-[0.03] pointer-events-none">
        <svg width="400" height="400" viewBox="0 0 100 100" fill="none" stroke="currentColor">
            <circle cx="50" cy="50" r="40" stroke-width="0.5" stroke-dasharray="2 2" />
            <path d="M50 10V90M10 50H90" stroke-width="0.5" />
        </svg>
    </div>

    <div class="max-w-6xl mx-auto px-6 space-y-12 relative z-10">
        <p class="text-xs font-mono uppercase tracking-[0.3em] text-muted">
            index / end
        </p>

        <h3 class="text-[clamp(2.5rem,6vw,4.5rem)] font-bold leading-[1.1] max-w-4xl tracking-tighter uppercase font-sans">
            <span data-i18n="about.end.cta_title">Solid structure,</span><br/>
            <span class="text-muted" data-i18n="about.end.cta_subtitle">clean execution.</span>
        </h3>

        <div class="flex flex-col md:flex-row md:items-end gap-8 justify-between border-t border-border/50 pt-8 mt-12">
            <p class="text-muted max-w-lg leading-relaxed text-sm md:text-base font-sans" data-i18n="about.end.cta_desc">
                Turning complex requirements into scalable web applications. I focus on writing maintainable code and delivering reliable solutions that simply work.
            </p>
            
            <div class="pt-8 md:pt-0 text-right">
                <p class="text-[10px] font-mono uppercase tracking-widest text-muted mb-2" data-i18n="about.end.auth_by">Authenticated by</p>
                <p class="font-serif text-3xl italic opacity-80 text-text">Fadlan Firdaus</p>
            </div>
        </div>
    </div>
</section>
@endsection