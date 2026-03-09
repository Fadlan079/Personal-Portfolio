<section class="py-24 border-t border-border/50 relative overflow-hidden" id="featured-projects">
    <div class="absolute inset-0 z-0 opacity-5"
        style="background-image: linear-gradient(var(--color-text) 1px, transparent 1px), linear-gradient(90deg, var(--color-text) 1px, transparent 1px); background-size: 40px 40px;">
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10" x-data="{
        currentProject: 0,
        totalProjects: {{ count($recentProjects) }},
        deviceView: 'desktop', // desktop, tablet, mobile
        timer: null,
        init() {
            this.startAuto();
        },
        startAuto() {
            this.stopAuto();
            this.timer = setInterval(() => {
                // Auto-slide setiap 5 detik
                this.currentProject = (this.currentProject + 1) % this.totalProjects;
            }, 5000);
        },
        stopAuto() { clearInterval(this.timer); },
        setDevice(type) {
            this.deviceView = type;
            this.stopAuto(); // Pause auto-slide saat user interact ganti device
        }
    }">

        <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            <div class="lg:col-span-7 flex flex-col items-center w-full" @mouseenter="stopAuto()"
                @mouseleave="startAuto()">

                <div
                    class="w-full relative bg-surface/30 border border-border/50 p-4 md:p-8 flex items-center justify-center min-h-[400px] md:min-h-[500px] overflow-hidden">

                    <div class="absolute top-0 left-0 w-4 h-4 border-t border-l border-primary/50"></div>
                    <div class="absolute top-0 right-0 w-4 h-4 border-t border-r border-primary/50"></div>
                    <div class="absolute bottom-0 left-0 w-4 h-4 border-b border-l border-primary/50"></div>
                    <div class="absolute bottom-0 right-0 w-4 h-4 border-b border-r border-primary/50"></div>

                    <div class="absolute top-3 left-4 text-[9px] font-mono text-muted uppercase tracking-widest">
                        Viewport_Sim</div>
                    <div class="absolute top-3 right-4 text-[9px] font-mono text-primary uppercase tracking-widest"
                        x-text="'RES: ' + deviceView.toUpperCase()"></div>

                    <div class="relative bg-background border border-border shadow-[0_0_30px_rgba(0,0,0,0.5)] transition-all duration-700 ease-in-out overflow-hidden flex items-start justify-center group"
                        :class="{
                            'w-full aspect-[16/9] rounded-sm': deviceView === 'desktop',
                            'w-[320px] md:w-[400px] aspect-[3/4] rounded-xl': deviceView === 'tablet',
                            'w-[240px] md:w-[280px] aspect-[9/16] rounded-[2rem] border-4 border-surface': deviceView === 'mobile'
                        }">

                        <div class="absolute inset-0 z-30 pointer-events-none opacity-20"
                            style="background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.25) 50%), linear-gradient(90deg, rgba(255, 0, 0, 0.06), rgba(0, 255, 0, 0.02), rgba(0, 0, 255, 0.06)); background-size: 100% 4px, 6px 100%;">
                        </div>

                        @forelse ($recentProjects as $index => $project)
                            <div class="absolute inset-0 w-full h-full overflow-y-auto overflow-x-hidden custom-scrollbar z-10 bg-background"
                                x-show="currentProject === {{ $index }}"
                                x-transition:enter="ease-out duration-500"
                                x-transition:enter-start="opacity-0 scale-105"
                                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-300"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

                                <img :src="{
                                    'desktop': '{{ $project->image_desktop ? asset('storage/' . $project->image_desktop) : 'https://via.placeholder.com/1280x2500/121212/38bdf8?text=DESKTOP+LAYOUT' }}',
                                    'tablet': '{{ $project->image_tablet ? asset('storage/' . $project->image_tablet) : 'https://via.placeholder.com/768x2500/121212/a3e635?text=TABLET+LAYOUT' }}',
                                    'mobile': '{{ $project->image_mobile ? asset('storage/' . $project->image_mobile) : 'https://via.placeholder.com/375x2500/121212/f87171?text=MOBILE+LAYOUT' }}'
                                } [deviceView]"
                                    x-on:error.once="$el.src = {
                                        'desktop': 'https://via.placeholder.com/1280x2500/121212/38bdf8?text=NO+DESKTOP+IMAGE',
                                        'tablet': 'https://via.placeholder.com/768x2500/121212/a3e635?text=NO+TABLET+IMAGE',
                                        'mobile': 'https://via.placeholder.com/375x2500/121212/f87171?text=NO+MOBILE+IMAGE'
                                    }[deviceView]"
                                    alt="{{ $project->title }}"
                                    class="w-full h-auto block object-top transition-opacity duration-300 ease-in">
                            </div>
                        @empty
                            <div class="absolute inset-0 flex flex-col items-center justify-center bg-background text-muted p-4">
                                <i class="fa-solid fa-image text-4xl mb-3 opacity-20"></i>
                                <span class="font-mono text-[10px] uppercase tracking-widest">[ Null_Data: No Visual Preview ]</span>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div
                    class="flex items-center mt-6 border border-border/70 bg-background/80 backdrop-blur font-mono text-[10px] uppercase tracking-widest divide-x divide-border/70 shadow-lg">

                    <button @click="setDevice('desktop')"
                        class="relative px-5 md:px-6 py-3 flex items-center gap-2.5 transition-all duration-300 group overflow-hidden"
                        :class="deviceView === 'desktop' ? 'text-primary bg-primary/5' :
                            'text-muted hover:text-text hover:bg-surface/50'">

                        <span class="w-1.5 h-1.5 rounded-full transition-colors duration-300"
                            :class="deviceView === 'desktop' ? 'bg-primary shadow-[0_0_8px_var(--color-primary)]' :
                                'bg-border group-hover:bg-muted'"></span>

                        <i class="fa-solid fa-display text-xs"></i>
                        <span class="hidden sm:inline">Desktop</span>
                        <span class="sm:hidden">Desk</span>

                        <span
                            class="absolute bottom-0 left-0 w-full h-[2px] bg-primary transform origin-left transition-transform duration-300"
                            :class="deviceView === 'desktop' ? 'scale-x-100' : 'scale-x-0'"></span>
                    </button>

                    <button @click="setDevice('tablet')"
                        class="relative px-5 md:px-6 py-3 flex items-center gap-2.5 transition-all duration-300 group overflow-hidden"
                        :class="deviceView === 'tablet' ? 'text-primary bg-primary/5' :
                            'text-muted hover:text-text hover:bg-surface/50'">

                        <span class="w-1.5 h-1.5 rounded-full transition-colors duration-300"
                            :class="deviceView === 'tablet' ? 'bg-primary shadow-[0_0_8px_var(--color-primary)]' :
                                'bg-border group-hover:bg-muted'"></span>

                        <i class="fa-solid fa-tablet-screen-button text-xs"></i>
                        <span class="hidden sm:inline">Tablet</span>
                        <span class="sm:hidden">Tab</span>

                        <span
                            class="absolute bottom-0 left-0 w-full h-[2px] bg-primary transform origin-left transition-transform duration-300"
                            :class="deviceView === 'tablet' ? 'scale-x-100' : 'scale-x-0'"></span>
                    </button>

                    <button @click="setDevice('mobile')"
                        class="relative px-5 md:px-6 py-3 flex items-center gap-2.5 transition-all duration-300 group overflow-hidden"
                        :class="deviceView === 'mobile' ? 'text-primary bg-primary/5' :
                            'text-muted hover:text-text hover:bg-surface/50'">

                        <span class="w-1.5 h-1.5 rounded-full transition-colors duration-300"
                            :class="deviceView === 'mobile' ? 'bg-primary shadow-[0_0_8px_var(--color-primary)]' :
                                'bg-border group-hover:bg-muted'"></span>

                        <i class="fa-solid fa-mobile-screen text-xs"></i>
                        <span class="hidden sm:inline">Mobile</span>
                        <span class="sm:hidden">Mob</span>

                        <span
                            class="absolute bottom-0 left-0 w-full h-[2px] bg-primary transform origin-left transition-transform duration-300"
                            :class="deviceView === 'mobile' ? 'scale-x-100' : 'scale-x-0'"></span>
                    </button>

                </div>
            </div>

            <div class="lg:col-span-5" @mouseenter="stopAuto()" @mouseleave="startAuto()">

                <div class="flex justify-between items-end mb-8 border-b border-border/50 pb-4">
                    <div>
                        <p class="text-[10px] font-mono uppercase tracking-widest text-primary mb-2">
                            >> Execution_Logs
                        </p>
                        <h3 class="text-3xl font-bold tracking-tight uppercase" data-i18n="home.featured">
                            Featured Works
                        </h3>
                        <p class="text-sm text-muted mt-3 max-w-2xl" data-i18n="home.featured_desc">
                            Selected projects highlighting practical solutions, clean architecture, and modern web
                            development practices.
                        </p>
                    </div>
                    <div class="flex gap-2">
                        <button @click="currentProject = currentProject > 0 ? currentProject - 1 : totalProjects - 1"
                            class="w-8 h-8 flex items-center justify-center border border-border text-muted hover:text-text hover:border-text transition-colors">
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                        <button @click="currentProject = currentProject < totalProjects - 1 ? currentProject + 1 : 0"
                            class="w-8 h-8 flex items-center justify-center border border-border text-muted hover:text-text hover:border-text transition-colors">
                            <i class="fa-solid fa-angle-right"></i>
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
                            x-transition:leave-end="opacity-0 -translate-x-8 z-0" class="absolute inset-0 w-full h-full"
                            {{ $index === 0 ? '' : 'style="display: none;"' }}>

                            <div
                                class="project-folder group relative border border-border bg-surface p-6 pt-12 w-full h-full">

                                <div class="absolute top-0 left-6 -translate-y-1/2 flex gap-2 z-20">
                                    <span
                                        class="px-4 py-1 text-[10px] uppercase tracking-widest badge-primary font-semibold">
                                        {{ $project->type }}
                                    </span>
                                    <span
                                        class="px-3 py-1 text-[9px] uppercase tracking-wide border {{ $project->statusClass }}">
                                        {{ $project->status }}
                                    </span>
                                </div>

                                <div class="folder-files absolute inset-0 pointer-events-none z-0">
                                    <span class="file border-border bg-bg"></span>
                                    <span class="file border-border bg-bg"></span>

                                    <a href="{{ route('portofolio.projects', ['search' => $project->title]) }}"
                                        class="file file-front pointer-events-auto p-6 flex flex-col justify-between bg-surface border-border hover:border-primary transition-colors duration-300">

                                        <div>
                                            <h3
                                                class="text-2xl font-semibold leading-tight group-hover:text-primary transition-colors">
                                                {{ $project->title }}
                                            </h3>
                                            <p class="text-sm text-muted leading-relaxed mt-4 line-clamp-3">
                                                {{ $project->desc }}
                                            </p>
                                        </div>

                                        <div
                                            class="tech-row mt-auto pt-4 flex gap-2 flex-wrap text-[11px] tracking-widest uppercase text-muted font-mono">
                                            @foreach ($project->visibleTechs as $tech)
                                                <span
                                                    class="px-2 py-1 border border-border bg-bg hover:border-primary hover:text-primary transition-colors">{{ strtoupper($tech) }}</span>
                                            @endforeach

                                            @if (count($project->extraTechs) > 0)
                                                <span
                                                    class="tech-more px-2 py-1 border border-border bg-bg relative group/tooltip cursor-help">
                                                    +{{ count($project->extraTechs) }}
                                                    <span
                                                        class="tech-tooltip absolute bottom-full left-1/2 -translate-x-1/2 mb-2 p-2 bg-text text-background text-[10px] rounded opacity-0 invisible group-hover/tooltip:opacity-100 group-hover/tooltip:visible transition-all whitespace-nowrap z-50">
                                                        @foreach ($project->extraTechs as $extra)
                                                            {{ $extra }}<br>
                                                        @endforeach
                                                    </span>
                                                </span>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="flex items-center justify-center w-full h-full border border-dashed border-border text-muted font-mono text-xs uppercase tracking-widest">
                            [ Null_Data: No Projects Found ]
                        </div>
                    @endforelse
                </div>

                <div class="flex justify-start mt-8 gap-2">
                    @foreach ($recentProjects as $index => $project)
                        <button @click="currentProject = {{ $index }}"
                            class="h-1.5 transition-all duration-300 rounded-full"
                            :class="currentProject === {{ $index }} ? 'bg-primary w-8' :
                                'bg-border hover:bg-muted w-3'">
                        </button>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section>
