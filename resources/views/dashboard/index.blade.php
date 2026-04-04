@extends('layouts.dashboard')
@section('title', 'Overview')

@section('content')
<div class="min-h-screen bg-background pt-6 sm:pt-12 pb-24 px-4 md:px-6 relative overflow-hidden">

    <div class="absolute inset-0 pointer-events-none opacity-[0.03] z-0"
        style="background-image: radial-gradient(var(--color-text) 1px, transparent 1px); background-size: 24px 24px;">
    </div>

    <section class="max-w-7xl mx-auto relative z-10 space-y-12 mt-4 md:mt-8">

        <header class="relative space-y-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="space-y-6">
                    <div class="relative inline-flex items-center gap-2 py-1.5 pl-8 pr-6 transition-all duration-300 w-max group hover:-translate-y-0.5 hover:rotate-1"
                        style="filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.06));">
                        <div class="absolute inset-0 bg-warning border border-yellow-500 rounded-l-md z-0 transition-colors"
                            style="clip-path: polygon(0 0, 100% 0, 92% 50%, 100% 100%, 0 100%);">
                        </div>
                        <div class="absolute top-1/2 -left-4 w-6 h-[1.5px] bg-[#8B0000]/80 -translate-y-[calc(50%+1px)] origin-right -rotate-12 group-hover:-rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>
                        <div class="absolute top-1/2 -left-3 w-5 h-[1.5px] bg-[#B22222]/80 -translate-y-[calc(50%-1px)] origin-right rotate-12 group-hover:rotate-6 transition-transform duration-300 rounded-l-full z-0"></div>
                        <div class="absolute left-2.5 top-1/2 -translate-y-1/2 w-2.5 h-2.5 rounded-full bg-surface shadow-[inset_1px_1px_3px_rgba(0,0,0,0.3)] border border-yellow-700/30 z-10"></div>

                        <i class="fa-solid fa-chart-pie relative z-10 text-yellow-800 text-[11px] mt-px"></i>
                        <span class="relative z-10 text-[10px] sm:text-xs font-black tracking-[0.15em] uppercase text-yellow-900 mt-px">
                            Ringkasan
                        </span>
                    </div>

                    <h1 class="text-[clamp(2.5rem,6vw,4.5rem)] font-bold tracking-tighter leading-[1.05] text-text">
                        <span class="block">Dashboard</span>
                        <span class="block text-muted mt-2 text-[clamp(1.5rem,4vw,2.5rem)]">Status & Analitik</span>
                    </h1>

                    <p class="text-base text-muted max-w-2xl leading-relaxed font-medium">
                        Catatan ringkas mengenai kondisi terkini portofolio Anda.
                    </p>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 md:gap-6 pt-4">
            {{-- Top Category (Project) --}}
            <div class="bg-indigo-50 p-5 rounded-sm shadow-md border border-border flex flex-col relative group/tooltip rotate-1 font-serif hover:z-20 hover:scale-[1.02] transition-all">
                <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-2 before:bg-white/50 before:shadow-inner"></div>
                <div class="absolute -top-1.5 -right-1.5 bg-indigo-200/80 text-indigo-800 text-[8px] font-bold px-2 py-0.5 rounded-full shadow-sm rotate-3 backdrop-blur-sm z-20">
                    #SNAPSHOT
                </div>
                <h4 class="text-[10px] font-bold uppercase tracking-[0.2em] text-muted mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-objects-column text-indigo-400"></i> Kategori Terbanyak
                </h4>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-full border border-border shadow-sm flex items-center justify-center text-indigo-500 group-hover:-rotate-6 transition-all">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-black">{{ $topProjectCategory }}</h3>
                        <p class="text-[9px] text-muted uppercase font-sans tracking-widest">Type Proyek</p>
                    </div>
                </div>
            </div>

            {{-- Status Dominan --}}
            <div class="bg-emerald-50 p-5 rounded-sm shadow-md border border-border flex flex-col relative group/tooltip -rotate-1 font-serif hover:z-20 hover:scale-[1.02] transition-all">
                <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-2 before:bg-white/50 before:shadow-inner"></div>
                <div class="absolute -top-1.5 -right-1.5 bg-emerald-200/80 text-emerald-800 text-[8px] font-bold px-2 py-0.5 rounded-full shadow-sm -rotate-3 backdrop-blur-sm z-20">
                    #SNAPSHOT
                </div>
                <h4 class="text-[10px] font-bold uppercase tracking-[0.2em] text-muted mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-400"></i> Status Dominan
                </h4>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-full border border-border shadow-sm flex items-center justify-center text-emerald-500 group-hover:rotate-6 transition-all">
                        <i class="fa-solid fa-spinner"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-black">{{ $topProjectStatus }}</h3>
                        <p class="text-[9px] text-muted uppercase font-sans tracking-widest">Alur Proyek</p>
                    </div>
                </div>
            </div>

            {{-- Skill Snapshot (Leader) --}}
            <div class="bg-sky-50 p-5 rounded-sm shadow-md border border-border flex flex-col relative group/tooltip -rotate-2 font-serif hover:z-20 hover:scale-[1.02] transition-all">
                <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-2 before:bg-white/50 before:shadow-inner"></div>
                <div class="absolute -top-1.5 -right-1.5 bg-sky-200/80 text-sky-800 text-[8px] font-bold px-2 py-0.5 rounded-full shadow-sm -rotate-12 backdrop-blur-sm z-20">
                    #SNAPSHOT
                </div>
                <h4 class="text-[10px] font-bold uppercase tracking-[0.2em] text-muted mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-brain text-sky-400"></i> Fokus Utama
                </h4>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-full border border-border shadow-sm flex items-center justify-center text-sky-500 group-hover:scale-110 transition-all">
                        <i class="fa-solid {{ $topSkillIcon }} {{ $topSkillColor }}"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-black">{{ $topSkillCategory }}</h3>
                        <p class="text-[9px] text-muted uppercase font-sans tracking-widest">Keahlian Aktif</p>
                    </div>
                </div>
            </div>

            {{-- Top Tech (History) --}}
            <div class="bg-amber-50 p-5 rounded-sm shadow-md border border-border flex flex-col relative group/tooltip rotate-1 font-serif hover:z-20 hover:scale-[1.02] transition-all">
                <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-2 before:bg-white/50 before:shadow-inner"></div>
                <div class="absolute -top-1.5 -right-1.5 bg-amber-200/80 text-amber-800 text-[8px] font-bold px-2 py-0.5 rounded-full shadow-sm rotate-12 backdrop-blur-sm z-20">
                    #SNAPSHOT
                </div>
                <h4 class="text-[10px] font-bold uppercase tracking-[0.2em] text-muted mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-microchip text-amber-400"></i> Tech Favorit
                </h4>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-full border border-border shadow-sm flex items-center justify-center text-amber-500 group-hover:-scale-110 transition-all">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-black">{{ $topTechStackAllTime }}</h3>
                        <p class="text-[9px] text-muted uppercase font-sans tracking-widest">History Tech</p>
                    </div>
                </div>
            </div>

            {{-- Recent Trend (7 Days) --}}
            <div class="bg-rose-50 p-5 rounded-sm shadow-md border border-border flex flex-col relative group/tooltip -rotate-2 font-serif hover:z-20 hover:scale-[1.02] transition-all">
                <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-2 before:bg-white/50 before:shadow-inner"></div>
                <div class="absolute -top-1.5 -right-1.5 bg-rose-200/80 text-rose-800 text-[8px] font-bold px-2 py-0.5 rounded-full shadow-sm -rotate-12 backdrop-blur-sm z-20">
                    #SNAPSHOT
                </div>
                <h4 class="text-[10px] font-bold uppercase tracking-[0.2em] text-muted mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-bolt text-rose-400"></i> Tren 7 Hari
                </h4>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-full border border-border shadow-sm flex items-center justify-center text-rose-500 group-hover:scale-110 transition-all">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-black">{{ $topTechStackMonth }}</h3>
                        <p class="text-[9px] text-muted uppercase font-sans tracking-widest">Tren Terbaru</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-16 pt-4">
            <div class="w-full max-w-5xl mx-auto" x-data="{
                    currentProject: 0,
                    totalProjects: {{ count($recentProjects) }},
                    deviceView: 'desktop',
                    screenWidth: window.innerWidth,
                    timer: null,
                    init() {
                        this.startAuto();
                        window.addEventListener('resize', () => {
                            this.screenWidth = window.innerWidth;
                        });
                    },
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

                <div class="flex flex-col gap-12">
                    <div class="flex flex-col justify-start gap-8" @mouseenter="stopAuto()" @mouseleave="startAuto()">
                        <div class="flex justify-between items-end border-b-2 border-dashed border-[var(--color-border)] pb-4">
                            <div>
                                <h3 class="text-xl md:text-2xl font-bold font-serif italic text-text">
                                    Catatan Terbaru Proyek
                                </h3>
                                <p class="font-mono text-[10px] md:text-xs text-muted mt-1 tracking-widest uppercase">Proyek Terbaru</p>
                            </div>
                        </div>

                        <div class="relative w-full lg:h-auto group/nav">
                            <button @click="currentProject = currentProject > 0 ? currentProject - 1 : totalProjects - 1"
                                x-show="screenWidth < 1024"
                                class="absolute -left-4 lg:-left-10 top-1/2 -translate-y-1/2 z-50 flex items-center justify-center w-10 h-10 lg:w-12 lg:h-12 bg-surface border border-border text-text rounded-md shadow-md hover:shadow-lg transition-all duration-300 hover:scale-110 active:scale-95 backdrop-blur-sm">
                                <i class="fa-solid fa-arrow-left-long text-sm"></i>
                            </button>

                            <button @click="currentProject = currentProject < totalProjects - 1 ? currentProject + 1 : 0"
                                x-show="screenWidth < 1024"
                                class="absolute -right-4 lg:-right-10 top-1/2 -translate-y-1/2 z-50 flex items-center justify-center w-10 h-10 lg:w-12 lg:h-12 bg-surface border border-border text-text rounded-md shadow-md hover:shadow-lg transition-all duration-300 hover:scale-110 active:scale-95 backdrop-blur-sm">
                                <i class="fa-solid fa-arrow-right-long text-sm"></i>
                            </button>

                            <div :class="screenWidth >= 1024 ? 'grid grid-cols-3 gap-6' : 'relative aspect-square md:aspect-square lg:aspect-auto lg:h-[350px]'">
                                @forelse($recentProjects as $index => $project)
                                    <div x-show="screenWidth >= 1024 || currentProject === {{ $index }}"
                                        @click="if(screenWidth >= 1024) currentProject = {{ $index }}"
                                        x-transition:enter="transition ease-out duration-500 transform"
                                        x-transition:enter-start="opacity-0 translate-x-12"
                                        x-transition:enter-end="opacity-100 translate-x-0"
                                        x-transition:leave="transition ease-in duration-300 transform absolute"
                                        x-transition:leave-start="opacity-100 translate-x-0"
                                        x-transition:leave-end="opacity-0 -translate-x-12"
                                        class="w-full h-full transition-all duration-300"
                                        :class="{
                                            'absolute inset-0': screenWidth < 1024,
                                            'relative cursor-pointer hover:-translate-y-1': screenWidth >= 1024,
                                            'z-10': currentProject === {{ $index }}
                                        }">

                                         <div class="bg-surface p-5 md:p-6 border-2 shadow-xl relative h-full flex flex-col justify-between overflow-hidden rounded-sm transition-all duration-300"
                                              :class="currentProject === {{ $index }} ? 'border-warning ring-2 ring-warning/20 scale-[1.02]' : 'border-border grayscale-[0.3] opacity-80 hover:grayscale-0 hover:opacity-100'">
                                            <div class="absolute top-0 left-0 bottom-0 w-1" :class="currentProject === {{ $index }} ? 'bg-warning' : 'bg-muted/30'"></div>
                                            <div class="absolute top-0 left-2 bottom-0 w-[0.5px] bg-border"></div>

                                            <div class="relative z-10">
                                                <div class="flex justify-between items-start mb-3">
                                                    <span class="px-2 py-0.5 text-[9px] font-bold uppercase tracking-widest border border-text shadow-sm md:-rotate-1"
                                                          :class="currentProject === {{ $index }} ? 'bg-warning text-text' : 'bg-container text-muted'">
                                                        @php
                                                            $displayType = match (strtolower($project->type)) {
                                                                'project' => 'Proyek',
                                                                'collab' => 'Kolaborasi',
                                                                'inquiry' => 'Pertanyaan',
                                                                'feedback' => 'Kritik & Saran',
                                                                default => $project->type,
                                                            };
                                                        @endphp
                                                        {{ $displayType }}
                                                    </span>
                                                    <span class="text-[8px] font-mono text-muted uppercase italic">{{ $project->status }}</span>
                                                </div>

                                                <h3 class="text-lg font-bold mb-2 text-text line-clamp-1" :class="currentProject === {{ $index }} ? 'text-black' : 'text-muted'">{{ $project->title }}</h3>
                                                <p class="text-[11px] text-muted line-clamp-3 leading-relaxed mb-4 italic font-serif">
                                                    "{{ $project->desc }}"
                                                </p>
                                            </div>

                                            <div class="relative z-10 flex flex-col mt-auto pt-4 border-t border-border">
                                                <div class="flex flex-wrap gap-1.5 mb-3">
                                                    @foreach(array_slice($project->tech ?? [], 0, 2) as $tech)
                                                        <span class="text-[8px] font-mono text-muted bg-container px-1 py-0.5 border border-border">#{{ $tech }}</span>
                                                    @endforeach
                                                </div>

                                                <div class="flex items-center justify-between">
                                                    <a href="{{ route('dashboard.projects.index') }}" class="font-mono text-[9px] font-bold uppercase tracking-widest text-[#2563eb] hover:opacity-80 flex items-center gap-1.5 transition-opacity">
                                                        <span>Edit</span>
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </a>

                                                    @if($project->live_url)
                                                        <a href="{{ $project->live_url }}" target="_blank" class="w-6 h-6 rounded-full bg-surface border border-border flex items-center justify-center text-text hover:bg-text hover:text-surface transition-all">
                                                            <i class="fa-solid fa-arrow-up-right-from-square text-[8px]"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-full py-20 px-6 flex flex-col items-center justify-center text-center bg-[#fdfcf5] border border-[#e5e0d0] rounded-xl shadow-[4px_4px_0px_rgba(0,0,0,0.05)] relative font-sans overflow-hidden">

                                        <div class="absolute inset-0 z-0 opacity-30"
                                            style="background-image: repeating-linear-gradient(transparent, transparent 24px, #e5e0d0 24px, #e5e0d0 25px);">
                                        </div>

                                        <div class="absolute top-0 left-10 bottom-0 w-0.5 bg-red-300 z-10 opacity-60"></div>

                                        <div class="absolute bottom-4 right-6 text-3xl text-muted/50 rotate-12 z-10">
                                            <i class="fa-solid fa-pencil-alt relative -right-2 top-1"></i>
                                            <i class="fa-solid fa-pen-nib relative -rotate-12"></i>
                                        </div>

                                        <div class="relative z-20 space-y-3">
                                            <h3 class="text-3xl font-medium text-black font-handwriting tracking-wide">
                                                Arsip Kosong
                                            </h3>

                                            <p class="text-sm text-[var(--color-muted)] max-w-sm mx-auto italic font-serif opacity-90 leading-relaxed">
                                                Belum ada proyek yang disorot untuk saat ini.
                                            </p>
                                        </div>

                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="flex justify-start items-center mt-4 gap-3 lg:hidden">
                            @foreach ($recentProjects as $index => $project)
                                <button @click="currentProject = {{ $index }}"
                                    class="h-1.5 transition-all duration-300 rounded-full"
                                    :class="currentProject === {{ $index }} ? 'bg-warning w-8 shadow-sm' : 'bg-border hover:bg-warning/50 w-2.5'">
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex flex-col items-center w-full" @mouseenter="stopAuto()" @mouseleave="startAuto()">
                        <div class="relative w-full bg-[var(--color-container)] border border-[var(--color-border)] shadow-2xl p-5 md:p-10 overflow-hidden rounded-r-3xl border-l-[20px] border-l-[var(--color-text)]"
                            style="background-image: radial-gradient(var(--color-border) 1px, transparent 1px); background-size: 24px 24px;">

                            <div class="relative mx-auto transition-all duration-700 ease-in-out"
                                :class="{
                                    'w-full aspect-[16/9] scale-100': deviceView === 'desktop',
                                    'w-full max-w-[420px] aspect-[3/4] scale-100': deviceView === 'tablet',
                                    'w-full max-w-[280px] aspect-[9/16] scale-100': deviceView === 'mobile'
                                }">

                                <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-32 h-8 bg-warning/40 border border-border/50 shadow-sm backdrop-blur-[1px] md:-rotate-3 z-40 flex items-center justify-center">
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
                                                    class="w-full h-auto block object-top transition-all duration-700">
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
                                    class="px-3 py-1.5 transition-all duration-300 transform hover:-translate-y-1 font-mono text-[10px] md:text-xs uppercase tracking-[0.2em] font-black border-2 border-[var(--color-text)] rounded-sm"
                                    :class="deviceView === '{{ $view }}' ? 'bg-warning text-text shadow-[4px_4px_0px_var(--color-text)] md:-rotate-1' : 'bg-surface text-muted border-border hover:border-text hover:text-text'">
                                    <i class="fa-solid {{ $icon }} mr-2"></i> {{ $view }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12">
                <div class="bg-surface border-2 border-text shadow-[6px_6px_0_var(--color-text)] flex flex-col min-h-[400px] relative rounded-sm">
                    <div class="absolute -left-3 top-8 w-6 flex flex-col gap-6 z-20">
                        @for($i=0; $i<6; $i++)
                            <div class="w-full h-2 bg-zinc-300 border border-zinc-500 rounded-full shadow-sm"></div>
                        @endfor
                    </div>
                    <div class="p-4 md:p-5 border-b-2 border-text flex justify-between items-center bg-container pl-8 rounded-t-sm">
                        <h3 class="text-lg font-bold font-serif italic text-text">Recent Mail</h3>
                        <a href="{{ route('dashboard.contacts.index') }}" class="font-mono text-[10px] font-bold uppercase tracking-widest text-text bg-warning px-2 py-1 border border-text hover:shadow-[2px_2px_0_var(--color-text)] transition-shadow">View All</a>
                    </div>
                    <div class="overflow-y-auto w-full flex-1 custom-scrollbar bg-surface pl-6"
                         style="background-image: linear-gradient(var(--color-border) 1px, transparent 1px); background-size: 100% 36px; background-position: 0 35px;">
                        <div class="pt-1 pb-4">
                            @forelse($recentMessages as $msg)
                                <div class="group py-2 px-4 hover:bg-warning/10 transition-colors {{ !$msg->is_read ? 'bg-warning/20' : '' }} relative">
                                    @if(!$msg->is_read)
                                        <div class="absolute left-1 top-4 w-2 h-2 rounded-full bg-red-500 animate-pulse"></div>
                                    @endif
                                    <div class="flex justify-between items-start mb-0.5">
                                        <h4 class="font-bold text-sm text-text truncate pr-2">
                                            {{ $msg->sender }}
                                        </h4>
                                        <span class="text-[9px] font-mono text-text bg-container border border-border px-1 relative top-0.5 whitespace-nowrap">{{ $msg->created_at->format('M d') }}</span>
                                    </div>
                                    <p class="text-xs text-muted truncate font-serif italic pr-2">
                                        {{ $msg->subject }}
                                    </p>
                                </div>
                            @empty
                                <div class="p-8 text-center text-sm font-serif italic text-muted h-full flex items-center justify-center">
                                    - Mailbox empty -
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 items-center pt-2">
                    <a href="{{ route('dashboard.projects.index') }}"
                        class="group flex items-center gap-3 px-6 py-3 bg-emerald-100 border-2 border-text rounded-sm shadow-[4px_4px_0_var(--color-text)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all duration-200 -rotate-1 hover:rotate-0">
                        <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-600 border border-emerald-500/30 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-folder-plus text-sm"></i>
                        </div>
                        <span class="font-mono text-[10px] md:text-xs font-black uppercase tracking-widest text-text">Proyek Saya</span>
                    </a>

                    <a href="{{ route('dashboard.skills.index') }}"
                        class="group flex items-center gap-3 px-6 py-3 bg-sky-100 border-2 border-text rounded-sm shadow-[4px_4px_0_var(--color-text)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all duration-200 rotate-1 hover:rotate-0">
                        <div class="w-8 h-8 rounded-full bg-sky-500/20 flex items-center justify-center text-sky-600 border border-sky-500/30 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-layer-group text-sm"></i>
                        </div>
                        <span class="font-mono text-[10px] md:text-xs font-black uppercase tracking-widest text-text">Edit Skills</span>
                    </a>

                    <a href="{{ route('dashboard.contacts.index') }}"
                        class="group flex items-center gap-3 px-6 py-3 bg-amber-100 border-2 border-text rounded-sm shadow-[4px_4px_0_var(--color-text)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all duration-200 -rotate-1 hover:rotate-0">
                        <div class="w-8 h-8 rounded-full bg-amber-500/20 flex items-center justify-center text-amber-600 border border-amber-500/30 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-paper-plane text-sm"></i>
                        </div>
                        <span class="font-mono text-[10px] md:text-xs font-black uppercase tracking-widest text-text">Lihat Pesan</span>
                    </a>

                    <a href="{{ route('dashboard.account.edit') }}"
                        class="group flex items-center gap-3 px-6 py-3 bg-violet-100 border-2 border-text rounded-sm shadow-[4px_4px_0_var(--color-text)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all duration-200 rotate-1 hover:rotate-0">
                        <div class="w-8 h-8 rounded-full bg-violet-500/20 flex items-center justify-center text-violet-600 border border-violet-500/30 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-user-astronaut text-sm"></i>
                        </div>
                        <span class="font-mono text-[10px] md:text-xs font-black uppercase tracking-widest text-text">Edit Account</span>
                    </a>
                </div>
            </div>
        </div>
        </div>
    </section>
</div>
@endsection

@push('head')
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: var(--color-container); border-left: 1px dashed var(--color-border); }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: var(--color-muted); border-radius: 0px; opacity: 0.5; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: var(--color-text); }
</style>
@endpush
