@extends('layouts.dashboard')
@section('title', 'Overview')

@section('content')
<div class="min-h-screen bg-background pt-12 pb-32 px-4 md:px-6 relative overflow-hidden" 
     x-data="systemOverview()">

    {{-- Global Faint Grid --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.02]"
         style="background-image: linear-gradient(var(--color-text) 1px, transparent 1px), linear-gradient(90deg, var(--color-text) 1px, transparent 1px); background-size: 64px 64px;">
    </div>

    <section class="max-w-7xl mx-auto relative z-10 space-y-8 md:space-y-12">

        {{-- HEADER MODULE & CLOCK --}}
        <header class="relative space-y-6 border-b border-border/50 pb-8 mt-4 md:mt-8">
            <div class="absolute top-0 right-0 w-1/3 h-[1px] bg-gradient-to-r from-transparent to-primary/50 pointer-events-none"></div>

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-widest text-primary">
                    <i class="fa-solid fa-terminal"></i>
                    >> SYS_DIR / DASHBOARD / MAIN_TERMINAL
                </div>
                
                {{-- Live System Clock --}}
                <div class="flex items-center gap-3 font-mono text-[10px] uppercase tracking-widest text-muted border border-border/50 px-3 py-1.5 bg-surface/30 w-max">
                    <span class="text-primary animate-pulse">SYS_TIME:</span>
                    <span x-text="currentTime" class="font-bold text-text">00:00:00</span>
                    <span x-text="currentDate" class="text-muted/70">YYYY-MM-DD</span>
                </div>
            </div>

            <div class="flex items-end gap-3 pt-2">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-mono tracking-tighter uppercase text-text leading-none">
                    Control_Center
                </h1>
                <div class="w-3 md:w-4 h-8 md:h-12 bg-primary animate-pulse mb-1 shadow-[0_0_10px_var(--color-primary)]"></div>
            </div>
            
            <p class="text-sm font-mono text-muted tracking-wide max-w-2xl leading-relaxed">
                <span class="text-primary">></span> Authentication verified. Welcome to the mainframe, Administrator. System is operating at nominal parameters.
            </p>
        </header>

        {{-- METRICS DASHBOARD (4 COLS) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 animate-[fadeIn_0.5s_ease-out]">
            
            {{-- Project Nodes --}}
            <div class="relative border border-border/50 bg-surface/20 p-5 group hover:border-sky-400/50 transition-colors">
                <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-sky-400/50"></div>
                <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-sky-400/50"></div>
                <div class="flex justify-between items-start mb-4">
                    <p class="text-[10px] font-mono uppercase tracking-widest text-muted flex items-center gap-2">
                        <i class="fa-solid fa-cubes text-sky-400"></i> Project_Nodes
                    </p>
                    <a href="{{ route('dashboard.projects.index') }}" class="text-[10px] font-mono text-sky-400 hover:text-sky-300 hover:underline">VIEW ></a>
                </div>
                <div class="flex items-end gap-3">
                    <h3 class="text-4xl font-mono font-bold text-text">{{ str_pad($projectsCount ?? 0, 2, '0', STR_PAD_LEFT) }}</h3>
                    <span class="text-[10px] font-mono text-muted mb-1">Active Instances</span>
                </div>
            </div>

            {{-- Skill Registry --}}
            <div class="relative border border-border/50 bg-surface/20 p-5 group hover:border-primary/50 transition-colors">
                <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-primary/50"></div>
                <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-primary/50"></div>
                <div class="flex justify-between items-start mb-4">
                    <p class="text-[10px] font-mono uppercase tracking-widest text-muted flex items-center gap-2">
                        <i class="fa-solid fa-layer-group text-primary"></i> Skill_Registry
                    </p>
                    <a href="{{ route('dashboard.skills.index') }}" class="text-[10px] font-mono text-primary hover:text-primary/80 hover:underline">VIEW ></a>
                </div>
                <div class="flex items-end gap-3">
                    <h3 class="text-4xl font-mono font-bold text-text">{{ str_pad($skillsCount ?? 0, 2, '0', STR_PAD_LEFT) }}</h3>
                    <span class="text-[10px] font-mono text-muted mb-1">Competencies</span>
                </div>
            </div>

            {{-- Archive/Trash --}}
            <div class="relative border border-border/50 bg-surface/20 p-5 group hover:border-amber-400/50 transition-colors">
                <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-amber-400/50"></div>
                <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-amber-400/50"></div>
                <div class="flex justify-between items-start mb-4">
                    <p class="text-[10px] font-mono uppercase tracking-widest text-muted flex items-center gap-2">
                        <i class="fa-solid fa-recycle text-amber-400"></i> Archive_Queue
                    </p>
                    <a href="{{ route('dashboard.trash') }}" class="text-[10px] font-mono text-amber-400 hover:text-amber-300 hover:underline">VIEW ></a>
                </div>
                <div class="flex items-end gap-3">
                    <h3 class="text-4xl font-mono font-bold text-text">{{ str_pad($trashCount ?? 0, 2, '0', STR_PAD_LEFT) }}</h3>
                    <span class="text-[10px] font-mono text-muted mb-1">Pending Purge</span>
                </div>
            </div>

            {{-- System Health --}}
            <div class="relative border border-border/50 bg-surface/20 p-5 group hover:border-green-400/50 transition-colors overflow-hidden">
                <div class="absolute inset-0 bg-[repeating-linear-gradient(45deg,transparent,transparent_4px,rgba(74,222,128,0.02)_4px,rgba(74,222,128,0.02)_8px)] pointer-events-none"></div>
                <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-green-400/50 z-10"></div>
                <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-green-400/50 z-10"></div>
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <p class="text-[10px] font-mono uppercase tracking-widest text-muted flex items-center gap-2">
                        <i class="fa-solid fa-heart-pulse text-green-400"></i> Sys_Health
                    </p>
                    <span class="text-[10px] font-mono text-green-400 animate-pulse">OPTIMAL</span>
                </div>
                <div class="flex items-end gap-2 relative z-10">
                    <h3 class="text-4xl font-mono font-bold text-green-400">99.9</h3>
                    <span class="text-lg font-mono text-green-400/70 mb-1">%</span>
                </div>
            </div>

        </div>

        {{-- MAIN SPLIT CONTENT --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 md:gap-8">
            
            {{-- LEFT: SIMULATED TERMINAL LOG (Span 8) --}}
            <div class="lg:col-span-8 relative border border-border/50 bg-[#050505] p-1 flex flex-col h-[400px] animate-[fadeIn_0.5s_ease-out_0.2s_both]">
                {{-- Terminal Header --}}
                <div class="flex items-center justify-between px-4 py-2 border-b border-border/30 bg-surface/30">
                    <div class="flex items-center gap-2">
                        <div class="flex gap-1.5">
                            <div class="w-2 h-2 rounded-full bg-red-500/50"></div>
                            <div class="w-2 h-2 rounded-full bg-amber-500/50"></div>
                            <div class="w-2 h-2 rounded-full bg-green-500/50"></div>
                        </div>
                        <span class="ml-2 text-[9px] font-mono text-muted uppercase tracking-widest">root@fadlan-server:~</span>
                    </div>
                    <i class="fa-solid fa-network-wired text-primary/50 text-xs"></i>
                </div>

                {{-- Terminal Body --}}
                <div id="terminal-body" class="flex-1 p-4 font-mono text-[11px] leading-relaxed overflow-y-auto custom-scrollbar flex flex-col gap-1.5 relative">
                    {{-- Default Logs (Bisa diganti data asli dari database jika ada) --}}
                    <div class="text-primary/70">Initializing core components... [OK]</div>
                    <div class="text-primary/70">Mounting database schemas... [OK]</div>
                    <div class="text-primary/70">Establishing secure connection via SSL... [OK]</div>
                    <div class="text-sky-400">> Admin user authenticated successfully.</div>
                    
                    <div class="border-t border-border/30 my-2"></div>
                    
                    {{-- Simulated Live Logs injected by Alpine JS --}}
                    <template x-for="(log, index) in terminalLogs" :key="index">
                        <div class="animate-[fadeIn_0.3s_ease-out]">
                            <span class="text-muted" x-text="log.time"></span> 
                            <span :class="log.color" x-html="log.msg"></span>
                        </div>
                    </template>
                    
                    {{-- Blinking input cursor --}}
                    <div class="flex mt-1 items-center">
                        <span class="text-green-500 mr-2">fadlan@sys:~$</span>
                        <div class="w-2 h-3 bg-primary animate-pulse"></div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: QUICK EXECUTION & RESOURCE (Span 4) --}}
            <div class="lg:col-span-4 space-y-6 animate-[fadeIn_0.5s_ease-out_0.4s_both]">
                
                {{-- Quick Execution Panel --}}
                <div class="border border-border/50 bg-surface/10 p-5 relative">
                    <div class="absolute top-0 right-0 w-8 h-8 border-t-2 border-r-2 border-primary/30"></div>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-widest text-text mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-bolt text-primary"></i> Quick_Execute
                    </h3>
                    
                    <div class="flex flex-col gap-3">
                        <a href="{{ route('dashboard.projects.index') }}" class="px-4 py-3 border border-border/50 bg-surface/30 font-mono text-[10px] font-bold uppercase tracking-widest text-text hover:border-primary hover:text-primary transition-colors flex justify-between items-center group">
                            <span>[ NEW_PROJECT_NODE ]</span>
                            <i class="fa-solid fa-arrow-right-long opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all"></i>
                        </a>
                        
                        <a href="{{ route('dashboard.skills.index') }}" class="px-4 py-3 border border-border/50 bg-surface/30 font-mono text-[10px] font-bold uppercase tracking-widest text-text hover:border-primary hover:text-primary transition-colors flex justify-between items-center group">
                            <span>[ ADD_SKILL_PARAM ]</span>
                            <i class="fa-solid fa-arrow-right-long opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all"></i>
                        </a>

                        <a href="{{ route('dashboard.settings') }}" class="px-4 py-3 border border-border/50 bg-surface/30 font-mono text-[10px] font-bold uppercase tracking-widest text-text hover:border-primary hover:text-primary transition-colors flex justify-between items-center group">
                            <span>[ SYS_PREFERENCES ]</span>
                            <i class="fa-solid fa-arrow-right-long opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all"></i>
                        </a>
                    </div>
                </div>

                {{-- Resource Allocation (Visual Decorative) --}}
                <div class="border border-border/50 bg-surface/10 p-5">
                    <h3 class="text-xs font-mono font-bold uppercase tracking-widest text-text mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-memory text-primary"></i> Memory_Allocation
                    </h3>
                    
                    <div class="space-y-4">
                        {{-- Bar 1 --}}
                        <div>
                            <div class="flex justify-between font-mono text-[9px] text-muted mb-1.5 uppercase">
                                <span>Frontend_Stack</span>
                                <span class="text-sky-400">45%</span>
                            </div>
                            <div class="flex gap-1 h-1.5 w-full">
                                @for($i=0; $i<9; $i++)
                                    <div class="h-full flex-1 {{ $i < 4 ? 'bg-sky-400 shadow-[0_0_5px_var(--color-sky-400)]' : 'bg-surface/50 border border-border/30' }}"></div>
                                @endfor
                            </div>
                        </div>

                        {{-- Bar 2 --}}
                        <div>
                            <div class="flex justify-between font-mono text-[9px] text-muted mb-1.5 uppercase">
                                <span>Backend_Core</span>
                                <span class="text-red-400">65%</span>
                            </div>
                            <div class="flex gap-1 h-1.5 w-full">
                                @for($i=0; $i<9; $i++)
                                    <div class="h-full flex-1 {{ $i < 6 ? 'bg-red-400 shadow-[0_0_5px_var(--color-red-400)]' : 'bg-surface/50 border border-border/30' }}"></div>
                                @endfor
                            </div>
                        </div>

                        {{-- Bar 3 --}}
                        <div>
                            <div class="flex justify-between font-mono text-[9px] text-muted mb-1.5 uppercase">
                                <span>System_Tools</span>
                                <span class="text-amber-400">30%</span>
                            </div>
                            <div class="flex gap-1 h-1.5 w-full">
                                @for($i=0; $i<9; $i++)
                                    <div class="h-full flex-1 {{ $i < 3 ? 'bg-amber-400 shadow-[0_0_5px_var(--color-amber-400)]' : 'bg-surface/50 border border-border/30' }}"></div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
</div>

@endsection

@push('head')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Scrollbar khusus untuk terminal */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: var(--color-primary); }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('systemOverview', () => ({
            currentTime: '',
            currentDate: '',
            terminalLogs: [],
            fakeLogMessages: [
                { msg: "Pinging external API gateways... <span class='text-green-400'>[200 OK]</span>", color: "text-text" },
                { msg: "Running automated security scan...", color: "text-text" },
                { msg: "No vulnerabilities detected in modules.", color: "text-primary" },
                { msg: "Syncing database cache...", color: "text-text" },
                { msg: "Cache optimized. Freed 24MB of RAM.", color: "text-sky-400" },
                { msg: "Awaiting administrator commands...", color: "text-muted" },
                { msg: "Monitoring incoming traffic on port 80/443.", color: "text-text" },
            ],
            
            init() {
                // Mulai Jam
                this.updateClock();
                setInterval(() => this.updateClock(), 1000);

                // Mulai Log Terminal Simulasi
                this.simulateLogs();
            },
            
            updateClock() {
                const now = new Date();
                this.currentTime = now.toLocaleTimeString('en-US', { hour12: false });
                this.currentDate = now.toISOString().split('T')[0];
            },

            simulateLogs() {
                let logIndex = 0;
                
                // Masukkan log pertama segera
                this.pushLog(this.fakeLogMessages[logIndex]);
                logIndex++;

                // Set interval acak untuk memasukkan log berikutnya (seolah-olah sistem sedang bekerja)
                const interval = setInterval(() => {
                    if(logIndex < this.fakeLogMessages.length) {
                        this.pushLog(this.fakeLogMessages[logIndex]);
                        logIndex++;
                    } else {
                        // Reset loop agar terminal tidak pernah mati
                        logIndex = 0;
                    }
                }, Math.floor(Math.random() * 4000) + 2000); // Muncul tiap 2-6 detik
            },

            pushLog(logItem) {
                const timeStr = `[${new Date().toLocaleTimeString('en-US', { hour12: false })}]`;
                this.terminalLogs.push({
                    time: timeStr,
                    msg: logItem.msg,
                    color: logItem.color
                });

                // Batasi jumlah log maksimal agar tidak memenuhi DOM
                if(this.terminalLogs.length > 20) {
                    this.terminalLogs.shift();
                }

                // Auto scroll ke bawah
                this.$nextTick(() => {
                    const terminalBody = document.getElementById('terminal-body');
                    if(terminalBody) {
                        terminalBody.scrollTop = terminalBody.scrollHeight;
                    }
                });
            }
        }));
    });
</script>
@endpush