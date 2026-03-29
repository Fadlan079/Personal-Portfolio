<section id="featured-projects" class="py-16 md:py-24 px-5 max-w-7xl mx-auto relative z-10 border-t border-[var(--color-border)]/50">

    <div class="absolute inset-0 z-0 opacity-[0.03]"
        style="background-image: linear-gradient(var(--color-text) 1px, transparent 1px), linear-gradient(90deg, var(--color-text) 1px, transparent 1px); background-size: 40px 40px;">
    </div>

    <div class="relative z-10" x-data="{
        currentProject: 0,
        totalProjects: {{ count($recentProjects) }},
        deviceView: 'desktop',
        timer: null,
        init() { this.startAuto(); },
        startAuto() {
            this.stopAuto();
            this.timer = setInterval(() => {
                this.currentProject = (this.currentProject + 1) % this.totalProjects;
            }, 5000);
        },
        stopAuto() { clearInterval(this.timer); },
        setDevice(type) {
            this.deviceView = type;
            this.stopAuto();
        }
        }">

        <div class="grid lg:grid-cols-12 gap-6 lg:gap-20 items-center px-4 md:px-8 lg:px-0">

            <div class="order-1 lg:order-2 lg:col-span-5 flex flex-col justify-start lg:min-h-0" @mouseenter="stopAuto()" @mouseleave="startAuto()">
                <div class="flex justify-between items-end mb-8 border-b border-[var(--color-border)]/50 pb-4">
                    <div>
                        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-[var(--color-muted)] mb-4" data-i18n="home.featured_project.label">
                            Karya Unggulan
                        </h3>
                        <h2 class="text-3xl md:text-5xl font-bold tracking-tight text-[var(--color-text)] leading-tight mb-4" data-i18n="home.featured_project.title">
                            Daftar Proyek.
                        </h2>
                        <p class="text-[var(--color-muted)] text-base md:text-lg leading-relaxed mb-8" data-i18n="home.featured_project.description">
                            Beberapa proyek pilihan yang menampilkan karya dan pengalaman pengembangan yang pernah saya buat.
                        </p>
                    </div>
                </div>

                <div class="relative w-full aspect-square md:aspect-square lg:aspect-auto lg:h-[350px] group/nav">
                    <button @click="currentProject = currentProject > 0 ? currentProject - 1 : totalProjects - 1"
                        class="absolute -left-4 lg:-left-10 top-1/2 -translate-y-1/2 z-50
                        flex items-center justify-center w-10 h-10 lg:w-12 lg:h-12
                        bg-[var(--color-surface)] border border-[var(--color-border)]
                        text-[var(--color-text)]
                        rounded-md
                        shadow-md hover:shadow-lg
                        transition-all duration-300
                        hover:scale-110 active:scale-95
                        backdrop-blur-sm">

                        <i class="fa-solid fa-arrow-left-long text-sm"></i>
                    </button>

                    <button @click="currentProject = currentProject < totalProjects - 1 ? currentProject + 1 : 0"
                        class="absolute -right-4 lg:-right-10 top-1/2 -translate-y-1/2 z-50
                        flex items-center justify-center w-10 h-10 lg:w-12 lg:h-12
                        bg-[var(--color-surface)] border border-[var(--color-border)]
                        text-[var(--color-text)]
                        rounded-md
                        shadow-md hover:shadow-lg
                        transition-all duration-300
                        hover:scale-110 active:scale-95
                        backdrop-blur-sm">

                        <i class="fa-solid fa-arrow-right-long text-sm"></i>
                    </button>

                    @forelse($recentProjects as $index => $project)
                        <div x-show="currentProject === {{ $index }}"
                            x-transition:enter="transition ease-out duration-500 transform"
                            x-transition:enter-start="opacity-0 translate-x-12"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition ease-in duration-300 transform"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-12"
                            class="absolute inset-0 w-full h-full">

                             <div class="bg-[var(--color-surface)] p-5 md:p-8 border border-[var(--color-border)] shadow-xl relative h-full flex flex-col justify-between overflow-hidden">
                                <div class="absolute top-0 left-0 bottom-0 w-1 bg-[var(--color-warning)]/50"></div>
                                <div class="absolute top-0 left-2 bottom-0 w-[0.5px] bg-[var(--color-border)]"></div>

                                <div class="relative z-10">
                                    <div class="flex justify-between items-start mb-3 md:mb-4">
                                        <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-widest bg-[var(--color-warning)] text-text border border-[var(--color-text)] shadow-sm md:-rotate-1">
                                            {{ $project->type }}
                                        </span>
                                        <span class="text-[9px] font-mono text-[var(--color-muted)] uppercase italic">{{ $project->status }}</span>
                                    </div>

                                    <h3 class="text-xl md:text-2xl font-bold mb-2 md:mb-4 text-[var(--color-text)]">{{ $project->title }}</h3>
                                    <p class="text-xs md:text-sm text-[var(--color-muted)] line-clamp-3 md:line-clamp-4 leading-relaxed mb-4 md:mb-6 italic font-serif">
                                        "{{ $project->desc }}"
                                    </p>
                                </div>

                                <div class="relative z-10 flex items-center justify-between mt-auto pt-4 md:pt-6 border-t border-[var(--color-border)]">
                                    <a href="{{ route('portofolio.projects', ['search' => $project->title]) }}"
                                        class="text-xs font-bold uppercase tracking-widest text-[var(--color-primary)] hover:opacity-80 flex items-center gap-2 group/btn"
                                        data-i18n="home.featured_project.button_detail">
                                        Lihat Detail
                                        <i class="fa-solid fa-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex items-center justify-center w-full h-full border-2 border-dashed border-[var(--color-border)] bg-[var(--color-container)] rounded-sm text-[var(--color-muted)] font-mono text-xs uppercase tracking-widest p-8 text-center italic">
                            [ null_collection : archive_empty ]
                        </div>
                    @endforelse
                </div>

                <div class="flex justify-start items-center mt-10 gap-3">
                    @foreach ($recentProjects as $index => $project)
                        <button @click="currentProject = {{ $index }}"
                            class="h-1.5 transition-all duration-300 rounded-full"
                            :class="currentProject === {{ $index }} ? 'bg-[var(--color-warning)] w-8 shadow-sm' : 'bg-[var(--color-border)] hover:bg-[var(--color-warning)]/50 w-2.5'">
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="order-2 lg:order-1 lg:col-span-7 flex flex-col items-center w-full" @mouseenter="stopAuto()" @mouseleave="startAuto()">

                <div class="relative w-full bg-[var(--color-container)] border border-[var(--color-border)] shadow-2xl p-5 md:p-10 overflow-hidden rounded-r-3xl border-l-[20px] border-l-[var(--color-text)]"
                    style="background-image: radial-gradient(var(--color-border) 1px, transparent 1px); background-size: 24px 24px;">

                    <div class="relative mx-auto transition-all duration-700 ease-in-out"
                        :class="{
                            'w-full aspect-[16/9] scale-100': deviceView === 'desktop',
                            'w-full max-w-[420px] aspect-[3/4] scale-100': deviceView === 'tablet',
                            'w-full max-w-[280px] aspect-[9/16] scale-100': deviceView === 'mobile'
                        }">

                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-32 h-8 bg-[var(--color-warning)]/40 border border-[var(--color-border)]/50 shadow-sm backdrop-blur-[1px] md:-rotate-3 z-40 flex items-center justify-center">
                             <div class="w-full h-px bg-[var(--color-text)]/10 md:rotate-12"></div>
                        </div>

                        <div class="w-full h-full bg-[var(--color-surface)] p-2 md:p-3 shadow-[10px_10px_30px_rgba(0,0,0,0.1)] border border-[var(--color-border)] relative group">

                            <div class="relative w-full h-full bg-[var(--color-bg)] overflow-hidden border border-[var(--color-border)]">
                                @foreach ($recentProjects as $index => $project)
                                    <div class="absolute inset-0 w-full h-full overflow-y-auto overflow-x-hidden custom-scrollbar bg-[var(--color-bg)]"
                                        x-show="currentProject === {{ $index }}"
                                        x-transition:enter="duration-700 ease-out"
                                        x-transition:enter-start="opacity-0 scale-105"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="duration-300 ease-in"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0">

                                        <img :src="{
                                            'desktop': '{{ $project->image_desktop ? asset('storage/' . $project->image_desktop) : 'https://via.placeholder.com/1280x2500/121212/38bdf8?text=DESKTOP+LAYOUT' }}',
                                            'tablet': '{{ $project->image_tablet ? asset('storage/' . $project->image_tablet) : 'https://via.placeholder.com/768x2500/121212/a3e635?text=TABLET+LAYOUT' }}',
                                            'mobile': '{{ $project->image_mobile ? asset('storage/' . $project->image_mobile) : 'https://via.placeholder.com/375x2500/121212/f87171?text=MOBILE+LAYOUT' }}'
                                        }[deviceView]"
                                            alt="{{ $project->title }}"
                                            class="w-full h-auto block object-top">
                                    </div>
                                @endforeach
                            </div>

                            <div class="absolute bottom-6 left-0 w-full text-center pointer-events-none">
                                <span class="bg-[var(--color-text)]/90 text-[var(--color-surface)] text-[9px] px-3 py-1 font-mono tracking-widest uppercase shadow-lg"
                                      x-text="deviceView + ' view'"></span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex items-center justify-center mt-6 gap-3 md:gap-4 flex-wrap relative z-20">
                    @foreach(['desktop' => 'fa-display', 'tablet' => 'fa-tablet-screen-button', 'mobile' => 'fa-mobile-screen'] as $view => $icon)
                        <button @click="setDevice('{{ $view }}')"
                            class="px-3 py-1.5 transition-all duration-300 transform hover:-translate-y-1 font-mono text-[10px] md:text-xs uppercase tracking-[0.2em] font-black border-2"
                            :class="deviceView === '{{ $view }}' ? 'bg-[var(--color-warning)] text-text border-[var(--color-text)] shadow-[4px_4px_0px_var(--color-text)] md:-rotate-1' : 'bg-[var(--color-surface)] text-[var(--color-muted)] border-[var(--color-border)] hover:border-[var(--color-text)] hover:text-[var(--color-text)]'">
                            <i class="fa-solid {{ $icon }} mr-2"></i> {{ $view }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
