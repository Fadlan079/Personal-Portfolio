@extends('layouts.dashboard')
@section('title', 'Overview')

@section('content')
<div class="px-4 md:px-6 py-8 max-w-7xl mx-auto space-y-12">

    <div class="border-b-2 border-dashed border-[var(--color-border)] pb-6 mb-8 flex flex-col md:flex-row md:justify-between items-start md:items-end gap-4">
        <div>
            <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-[var(--color-text)] relative inline-block group">
                Overview
                <span class="absolute -bottom-2 -right-4 text-2xl rotate-12 transition-transform group-hover:rotate-45 duration-300">📌</span>
                <div class="absolute -bottom-1 left-0 w-full h-3 bg-[var(--color-warning)]/50 -rotate-1 -z-10"></div>
            </h1>
            <p class="text-[var(--color-muted)] font-serif italic mt-3 text-lg">
                Catatan ringkas mengenai kondisi terkini portofolio Anda.
            </p>
        </div>
        {{-- <div class="font-mono text-xs font-bold bg-[var(--color-surface)] px-4 py-2 border-2 border-[var(--color-text)] shadow-[4px_4px_0_var(--color-text)] -rotate-2 group cursor-default">
            <i class="fa-regular fa-calendar mr-2 group-hover:animate-bounce"></i> {{ now()->format('d M Y') }}
        </div> --}}
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 md:gap-6">

        <div class="bg-sky-100 p-5 md:p-6 rounded-sm shadow-md border border-gray-200/70 flex flex-col justify-between relative group/tooltip rotate-1 font-serif hover:z-50 hover:scale-105 transition-all">
            <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>
            <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                <i class="fa-solid fa-folder-open text-sky-500"></i> Total Proyek
            </p>
            <h3 class="text-4xl font-bold text-neutral-900 relative z-10">{{ $projectSummary['totalProjects'] ?? 0 }}</h3>
        </div>

        <div class="bg-emerald-100 p-5 md:p-6 rounded-sm shadow-md border border-gray-200/70 flex flex-col justify-between relative group/tooltip -rotate-1 font-serif hover:z-50 hover:scale-105 transition-all">
            <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>
            <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                <i class="fa-solid fa-rocket text-emerald-500"></i> Selesai
            </p>
            <h3 class="text-4xl font-bold text-neutral-900 relative z-10">{{ $projectSummary['statusBreakdown']['Shipped'] ?? 0 }}</h3>
        </div>
        <div class="bg-amber-100 p-5 md:p-6 rounded-sm shadow-md border border-gray-200/70 flex flex-col justify-between relative group/tooltip rotate-2 font-serif hover:z-50 hover:scale-105 transition-all">
            <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>
            <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                <i class="fa-solid fa-person-digging text-amber-500"></i> Dalam Proses
            </p>
            <h3 class="text-4xl font-bold text-neutral-900 relative z-10">{{ $projectSummary['statusBreakdown']['In Progress'] ?? 0 }}</h3>
        </div>

        <div class="bg-rose-100 p-5 md:p-6 rounded-sm shadow-md border border-gray-200/70 flex flex-col justify-between relative group/tooltip -rotate-2 font-serif hover:z-50 hover:scale-105 transition-all">
            <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>
            <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                <i class="fa-solid fa-envelope{{ $unreadMessagesCount > 0 ? '-open-text' : '' }} text-rose-500 {{ $unreadMessagesCount > 0 ? 'animate-bounce' : '' }}"></i> Pesan Baru
            </p>
            <h3 class="text-4xl font-bold relative z-10 {{ $unreadMessagesCount > 0 ? 'text-red-600 animate-pulse' : 'text-neutral-900' }}">
                {{ $unreadMessagesCount }}
            </h3>
        </div>

        <div class="col-span-2 lg:col-span-1 bg-purple-100 p-5 md:p-6 rounded-sm shadow-md border border-gray-200/70 flex flex-col justify-between relative group/tooltip rotate-1 font-serif hover:z-50 hover:scale-105 transition-all">
            <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>
            <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10">
                <i class="fa-solid fa-layer-group text-purple-500"></i> Total Skills
            </p>
            <h3 class="text-4xl font-bold text-neutral-900 relative z-10">{{ $skillSummary['totalSkills'] ?? 0 }}</h3>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12 pt-4">

        <div class="lg:col-span-1 space-y-8 md:space-y-12">
            <div class="bg-indigo-50 p-6 rounded-sm shadow-md border border-gray-200/70 flex flex-col relative group/tooltip rotate-1 font-serif hover:z-50 hover:scale-[1.02] transition-all">

                <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>

                <div class="absolute -top-2 -right-2 bg-indigo-200/80 text-indigo-800 text-[10px] sm:text-xs font-bold px-3 py-1 rounded-full shadow-sm rotate-3 backdrop-blur-sm z-20">
                    #SNAPSHOT
                </div>

                <h3 class="text-xl font-bold text-neutral-800 border-b border-dashed border-gray-300/70 pb-3 mb-5 relative z-10">
                    Top Category
                </h3>

                <div class="flex items-center gap-5 relative z-10">
                    <div class="w-14 h-14 bg-white rounded-full border border-gray-200/70 shadow-sm flex items-center justify-center text-2xl group-hover:-rotate-12 group-hover:scale-110 transition-all">
                        @if(strtolower($topSkillCategory) == 'frontend')
                            <i class="fa-solid fa-code text-sky-400"></i>
                        @elseif(strtolower($topSkillCategory) == 'backend')
                            <i class="fa-solid fa-server text-rose-400"></i>
                        @else
                            <i class="fa-solid fa-screwdriver-wrench text-lime-500"></i>
                        @endif
                    </div>

                    <div>
                        <h4 class="text-2xl font-bold text-neutral-900">{{ $topSkillCategory }}</h4>
                        <p class="font-sans text-[10px] text-gray-500 mt-1 tracking-widest uppercase">
                            {{ $skillSummary[strtolower($topSkillCategory).'Count'] ?? 0 }} Items Logged
                        </p>
                    </div>
                </div>

                <div class="mt-6 border-t border-dashed border-gray-300/70 pt-4 flex justify-between items-center text-xs relative z-10">
                    <a href="{{ route('dashboard.skills.index') }}" class="font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                        Manage Skills
                    </a>
                    <i class="fa-solid fa-arrow-right-long text-indigo-400/50 group-hover:text-indigo-600 transition-colors group-hover:translate-x-1"></i>
                </div>
            </div>

            <div class="bg-[var(--color-surface)] border-2 border-[var(--color-text)] shadow-[6px_6px_0_var(--color-text)] flex flex-col h-full max-h-[450px] relative rounded-sm">
                <div class="absolute -left-3 top-8 w-6 flex flex-col gap-6 z-20">
                    @for($i=0; $i<6; $i++)
                        <div class="w-full h-2 bg-zinc-300 border border-zinc-500 rounded-full shadow-sm"></div>
                    @endfor
                </div>

                <div class="p-4 md:p-5 border-b-2 border-[var(--color-text)] flex justify-between items-center bg-[var(--color-container)] pl-8 rounded-t-sm">
                    <h3 class="text-lg font-bold font-serif italic text-[var(--color-text)]">Recent Mail</h3>
                    <a href="{{ route('dashboard.contacts.index') }}" class="font-mono text-[10px] font-bold uppercase tracking-widest text-[var(--color-text)] bg-[var(--color-warning)] px-2 py-1 border border-[var(--color-text)] hover:shadow-[2px_2px_0_var(--color-text)] transition-shadow">View All</a>
                </div>

                <div class="overflow-y-auto w-full flex-1 custom-scrollbar bg-[var(--color-surface)] pl-6"
                     style="background-image: linear-gradient(var(--color-border) 1px, transparent 1px); background-size: 100% 36px; background-position: 0 35px;">

                    <div class="pt-1 pb-4">
                        @forelse($recentMessages as $msg)
                            <div class="group py-2 px-4 hover:bg-[var(--color-warning)]/10 transition-colors {{ !$msg->is_read ? 'bg-[var(--color-warning)]/20' : '' }} relative">

                                @if(!$msg->is_read)
                                <div class="absolute left-1 top-4 w-2 h-2 rounded-full bg-red-500 animate-pulse"></div>
                                @endif

                                <div class="flex justify-between items-start mb-0.5">
                                    <h4 class="font-bold text-sm text-[var(--color-text)] truncate pr-2">
                                        {{ $msg->sender }}
                                    </h4>
                                    <span class="text-[9px] font-mono text-[var(--color-text)] bg-[var(--color-container)] border border-[var(--color-border)] px-1 relative top-0.5 whitespace-nowrap">{{ $msg->created_at->format('M d') }}</span>
                                </div>
                                <p class="text-xs text-[var(--color-muted)] truncate font-serif italic pr-2">
                                    {{ $msg->subject }}
                                </p>
                            </div>
                        @empty
                            <div class="p-8 text-center text-sm font-serif italic text-[var(--color-muted)] h-full flex items-center justify-center">
                                - Mailbox empty -
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

        <div class="lg:col-span-2 relative z-10 w-full" x-data="{
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

            <div class="bg-[var(--color-surface)] border-2 border-[var(--color-text)] shadow-[8px_8px_0_var(--color-text)] p-4 md:p-8 h-full rounded-sm">

                <div class="flex justify-between items-end border-b-2 border-dashed border-[var(--color-border)] pb-4 mb-8">
                     <div>
                        <h3 class="text-xl md:text-2xl font-bold font-serif italic text-[var(--color-text)]">
                            Recent Log: Projects
                        </h3>
                        <p class="font-mono text-[10px] md:text-xs text-[var(--color-muted)] mt-1 tracking-widest uppercase">Latest deployments</p>
                    </div>
                    <div class="flex gap-2 items-center">
                        <button @click="currentProject = currentProject > 0 ? currentProject - 1 : totalProjects - 1"
                            class="flex items-center justify-center w-8 h-8 border-2 border-[var(--color-text)] bg-[var(--color-surface)] hover:bg-[var(--color-warning)] transition-colors shadow-[2px_2px_0_var(--color-text)] active:translate-y-0.5 active:translate-x-0.5 active:shadow-[0_0_0_var(--color-text)] rounded-sm">
                            <i class="fa-solid fa-arrow-left text-xs"></i>
                        </button>
                        <button @click="currentProject = currentProject < totalProjects - 1 ? currentProject + 1 : 0"
                            class="flex items-center justify-center w-8 h-8 border-2 border-[var(--color-text)] bg-[var(--color-surface)] hover:bg-[var(--color-warning)] transition-colors shadow-[2px_2px_0_var(--color-text)] active:translate-y-0.5 active:translate-x-0.5 active:shadow-[0_0_0_var(--color-text)] rounded-sm">
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </button>
                    </div>
                </div>

                <div class="grid lg:grid-cols-2 gap-8 lg:gap-10 items-center">

                    <div class="flex flex-col items-center w-full order-2 lg:order-1" @mouseenter="stopAuto()" @mouseleave="startAuto()">
                        <div class="relative w-full bg-[var(--color-container)] border-2 border-[var(--color-text)] shadow-lg p-3 md:p-5 overflow-hidden rounded-sm bg-[image:radial-gradient(var(--color-border)_1px,transparent_1px)] bg-[size:16px_16px]">
                            <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-20 h-6 bg-white/40 border border-white/50 shadow-sm backdrop-blur-sm -rotate-2 z-30"></div>

                            <div class="relative mx-auto transition-all duration-500 ease-in-out"
                                :class="{
                                    'w-full aspect-[16/9]': deviceView === 'desktop',
                                    'w-full max-w-[220px] aspect-[3/4]': deviceView === 'tablet',
                                    'w-full max-w-[140px] aspect-[9/16]': deviceView === 'mobile'
                                }">

                                <div class="w-full h-full bg-[var(--color-surface)] p-1.5 shadow-[inset_0_2px_10px_rgba(0,0,0,0.1)] border border-[var(--color-text)] relative group rounded-[4px]">
                                    <div class="relative w-full h-full bg-[var(--color-bg)] overflow-hidden border border-[var(--color-border)] rounded-[2px] cursor-ns-resize">
                                        @foreach ($recentProjects as $index => $project)
                                            <div class="absolute inset-0 w-full h-full overflow-y-auto overflow-x-hidden custom-scrollbar bg-[var(--color-bg)]"
                                                x-show="currentProject === {{ $index }}"
                                                x-transition:enter="duration-500 ease-out"
                                                x-transition:enter-start="opacity-0 scale-105"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="duration-300 ease-in"
                                                x-transition:leave-start="opacity-100"
                                                x-transition:leave-end="opacity-0">

                                                <img :src="{
                                                    'desktop': '{{ $project->image_desktop ? asset('storage/' . $project->image_desktop) : 'https://via.placeholder.com/1280x2500/fdf6e3/1e293b?text=DESKTOP' }}',
                                                    'tablet': '{{ $project->image_tablet ? asset('storage/' . $project->image_tablet) : 'https://via.placeholder.com/768x2500/fdf6e3/1e293b?text=TABLET' }}',
                                                    'mobile': '{{ $project->image_mobile ? asset('storage/' . $project->image_mobile) : 'https://via.placeholder.com/375x2500/fdf6e3/1e293b?text=MOBILE' }}'
                                                }[deviceView]"
                                                    alt="{{ $project->title }}"
                                                    class="w-full h-auto block object-top grayscale hover:grayscale-0 transition-all duration-700">
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="absolute bottom-2 left-1/2 -translate-x-1/2 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span class="bg-[var(--color-text)] text-[var(--color-surface)] text-[8px] font-mono px-2 py-0.5 rounded-full uppercase tracking-widest shadow-lg backdrop-blur-sm">Scrollable</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-center mt-6 gap-2 md:gap-3 flex-wrap relative z-20">
                            @foreach(['desktop' => 'fa-display', 'tablet' => 'fa-tablet-screen-button', 'mobile' => 'fa-mobile-screen'] as $view => $icon)
                                <button @click="setDevice('{{ $view }}')"
                                    class="px-3 py-1.5 transition-all duration-300 transform hover:-translate-y-1 font-mono text-[9px] md:text-[10px] uppercase tracking-[0.2em] font-black border-2 border-[var(--color-text)] rounded-sm"
                                    :class="deviceView === '{{ $view }}' ? 'bg-[var(--color-warning)] text-[var(--color-text)] shadow-[3px_3px_0_var(--color-text)] -rotate-2' : 'bg-[var(--color-surface)] text-[var(--color-muted)] hover:bg-[var(--color-container)] hover:text-[var(--color-text)]'">
                                    <i class="fa-solid {{ $icon }} mr-1.5"></i> {{ $view }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="relative w-full aspect-square md:aspect-[4/3] lg:aspect-auto lg:h-[340px] order-1 lg:order-2" @mouseenter="stopAuto()" @mouseleave="startAuto()">
                        @forelse($recentProjects as $index => $project)
                            <div x-show="currentProject === {{ $index }}"
                                x-transition:enter="transition ease-out duration-500 transform"
                                x-transition:enter-start="opacity-0 translate-x-8 rotate-3"
                                x-transition:enter-end="opacity-100 translate-x-0 rotate-0"
                                x-transition:leave="transition ease-in duration-300 transform absolute"
                                x-transition:leave-start="opacity-100 translate-x-0 rotate-0"
                                x-transition:leave-end="opacity-0 -translate-x-8 -rotate-3"
                                class="absolute inset-0 w-full h-full">

                                 <div class="bg-[var(--color-surface)] p-5 md:p-6 lg:p-8 border border-[var(--color-border)] shadow-xl relative h-full flex flex-col justify-between overflow-hidden">
                                    <div class="absolute top-0 left-0 bottom-0 w-1 bg-[var(--color-warning)]/50"></div>
                                    <div class="absolute top-0 left-2 bottom-0 w-[0.5px] bg-[var(--color-border)]"></div>

                                    <div class="relative z-10">
                                        <div class="flex justify-between items-start mb-3 md:mb-4">
                                            <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-widest bg-[var(--color-warning)] text-[var(--color-text)] border border-[var(--color-text)] shadow-sm -rotate-1">
                                                {{ $project->type }}
                                            </span>
                                            <span class="text-[9px] font-mono text-[var(--color-muted)] uppercase italic">{{ $project->status }}</span>
                                        </div>

                                        <h3 class="text-xl md:text-2xl font-bold mb-2 md:mb-4 text-[var(--color-text)]">{{ $project->title }}</h3>

                                        <p class="text-xs md:text-sm text-[var(--color-muted)] line-clamp-3 md:line-clamp-4 leading-relaxed mb-4 italic font-serif">
                                            "{{ $project->desc }}"
                                        </p>
                                    </div>

                                    <div class="relative z-10 flex flex-col mt-auto">
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            @foreach(array_slice($project->tech ?? [], 0, 3) as $tech)
                                                <span class="text-[9px] font-mono text-[var(--color-muted)] bg-[var(--color-container)] px-1.5 py-0.5 border border-[var(--color-border)]">#{{ $tech }}</span>
                                            @endforeach
                                        </div>

                                        <div class="flex items-center justify-between pt-4 md:pt-6 border-t border-[var(--color-border)]">
                                            <a href="{{ route('dashboard.projects.index') }}" class="font-mono text-[10px] font-bold uppercase tracking-widest text-[var(--color-primary)] hover:opacity-80 flex items-center gap-2 transition-opacity">
                                                <span>Edit Item</span>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>

                                            @if($project->live_url)
                                                <a href="{{ $project->live_url }}" target="_blank" class="w-8 h-8 rounded-full bg-[var(--color-surface)] border border-[var(--color-border)] flex items-center justify-center text-[var(--color-text)] hover:bg-[var(--color-text)] hover:text-[var(--color-surface)] transition-all">
                                                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="flex items-center justify-center w-full h-full border-2 border-dashed border-[var(--color-text)] bg-[var(--color-container)] text-[var(--color-muted)] font-mono text-xs uppercase tracking-widest p-8 text-center italic opacity-60 rounded-sm">
                                [ No Deployments Logged ]
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>

        </div>
    </div>
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
