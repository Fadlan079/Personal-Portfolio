@extends('layouts.dashboard')
@section('title', 'Contact')

@section('content')

    <div class="min-h-screen bg-background pt-12 pb-32 px-4 md:px-6 relative overflow-hidden font-sans">

        {{-- Global Faint Grid --}}
        <div class="absolute inset-0 pointer-events-none opacity-[0.02] z-0"
            style="background-image: linear-gradient(var(--color-text) 1px, transparent 1px), linear-gradient(90deg, var(--color-text) 1px, transparent 1px); background-size: 64px 64px;">
        </div>

        <section class="max-w-7xl mx-auto relative z-10 space-y-8 md:space-y-12">

            {{-- ========================================== --}}
            {{-- 1. HEADER MODULE                           --}}
            {{-- ========================================== --}}
            <header class="relative space-y-6 border-b border-border/50 pb-8 mt-4 md:mt-8">
                <div
                    class="absolute top-0 right-0 w-1/3 h-px bg-linear-to-r from-transparent to-primary/50 pointer-events-none">
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-widest text-primary">
                        <i class="fa-solid fa-satellite-dish"></i>
                        >> SYS_DIR / DASHBOARD / INBOX_TERMINAL
                    </div>

                    <div
                        class="flex items-center gap-3 font-mono text-[10px] uppercase tracking-widest text-muted border border-border/50 px-3 py-1.5 bg-surface/30 w-max">
                        STATUS: <span class="{{ $unreadCount > 0 ? 'text-amber-400 animate-pulse' : 'text-green-500' }}">
                            {{ $unreadCount > 0 ? 'UNREAD_PACKETS_DETECTED' : 'ALL_CLEAR' }}
                        </span>
                    </div>
                </div>

                <div class="flex items-end gap-3 pt-2">
                    <h1
                        class="text-4xl md:text-5xl lg:text-6xl font-bold font-mono tracking-tighter uppercase text-text leading-none">
                        Transmission_Logs
                    </h1>
                    <div
                        class="w-3 md:w-4 h-8 md:h-12 bg-primary animate-pulse mb-1 shadow-[0_0_10px_var(--color-primary)]">
                    </div>
                </div>

                <p class="text-sm font-mono text-muted tracking-wide max-w-2xl leading-relaxed">
                    <span class="text-primary">></span> Encrypted communication array. Review, acknowledge, and manage
                    incoming payloads from external nodes.
                </p>
            </header>

            {{-- SUCCESS LOG --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms x-init="setTimeout(() => show = false, 4000)"
                    class="border-l-2 border-green-500 bg-green-500/10 p-4 flex items-center gap-3 z-10 relative">
                    <i class="fa-solid fa-check text-green-500"></i>
                    <p class="text-[10px] font-mono uppercase tracking-widest text-green-500">> {{ session('success') }}</p>
                </div>
            @endif

            {{-- ========================================== --}}
            {{-- 2. INBOX METRICS                           --}}
            {{-- ========================================== --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                {{-- Total Messages --}}
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-primary/50 transition-colors">
                    <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-primary/50"></div>
                    <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-primary/50"></div>
                    <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-inbox text-primary"></i> Total_Received
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-text">{{ str_pad($totalMessages, 2, '0', STR_PAD_LEFT) }}
                    </h3>
                </div>

                {{-- Unread --}}
                <div
                    class="relative border {{ $unreadCount > 0 ? 'border-amber-400/50 bg-amber-400/5' : 'border-border/50 bg-surface/20' }} p-5 group transition-colors overflow-hidden">
                    <div
                        class="absolute top-0 left-0 w-2 h-2 border-t border-l {{ $unreadCount > 0 ? 'border-amber-400' : 'border-muted' }}">
                    </div>
                    <div
                        class="absolute bottom-0 right-0 w-2 h-2 border-b border-r {{ $unreadCount > 0 ? 'border-amber-400' : 'border-muted' }}">
                    </div>
                    @if ($unreadCount > 0)
                        <div
                            class="absolute inset-0 bg-[repeating-linear-gradient(45deg,transparent,transparent_4px,rgba(251,191,36,0.03)_4px,rgba(251,191,36,0.03)_8px)] pointer-events-none">
                        </div>
                    @endif

                    <p
                        class="text-[9px] font-mono uppercase tracking-widest {{ $unreadCount > 0 ? 'text-amber-400 animate-pulse' : 'text-muted' }} mb-2 flex items-center gap-2 relative z-10">
                        <i class="fa-solid fa-bell"></i> Unread_Alerts
                    </p>
                    <h3
                        class="text-3xl font-mono font-bold {{ $unreadCount > 0 ? 'text-amber-400' : 'text-muted' }} relative z-10">
                        {{ str_pad($unreadCount, 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

                {{-- Project Requests --}}
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-sky-400/50 transition-colors">
                    <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-sky-400/50"></div>
                    <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-sky-400/50"></div>
                    <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-briefcase text-sky-400"></i> Project_Req
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-sky-400">
                        {{ str_pad($projectCount, 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

                {{-- Collabs --}}
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-green-400/50 transition-colors">
                    <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-green-400/50"></div>
                    <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-green-400/50"></div>
                    <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-handshake text-green-400"></i> Collab_Sync
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-green-400">
                        {{ str_pad($collabCount, 2, '0', STR_PAD_LEFT) }}</h3>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- 2.5 ANALYTICS MATRIX (CHART.JS)            --}}
            {{-- ========================================== --}}
            <div x-data="{ expanded: localStorage.getItem('contact_matrix_expanded') !== 'false' }"
                class="relative border border-border/50 bg-surface/10 p-4 md:p-6 space-y-6 mt-6 transition-all duration-300">
                <div class="flex items-center justify-between border-b border-border/50 pb-4">
                    <h3 class="text-[10px] font-mono uppercase tracking-widest text-primary flex items-center gap-2 cursor-pointer"
                        @click="expanded = !expanded; localStorage.setItem('contact_matrix_expanded', expanded)">
                        <i class="fa-solid fa-chart-line"></i> > INBOX_TRAFFIC_ANALYSIS
                    </h3>
                    <div class="flex items-center gap-4">
                        <span x-show="expanded"
                            class="text-[9px] font-mono text-green-400 animate-pulse hidden sm:inline-block">[ LIVE_RENDER
                            ]</span>
                        <button @click="expanded = !expanded; localStorage.setItem('contact_matrix_expanded', expanded)"
                            type="button"
                            class="text-[10px] font-mono text-muted hover:text-primary transition-colors focus:outline-none">
                            <span x-text="expanded ? '[_COLLAPSE_]' : '[_EXPAND_]'"></span>
                        </button>
                    </div>
                </div>

                <div x-show="expanded" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- 1. Contacts per Month (Line Chart) --}}
                    <div class="relative border border-border/30 bg-[#050505] p-4 lg:col-span-2 group">
                        <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-primary/50"></div>
                        <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-4">> INBOUND_TRAFFIC (6
                            MONTHS)</p>
                        <div class="relative h-48 w-full">
                            <canvas id="contactTimelineChart"></canvas>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-6">
                        {{-- 2. Contact Method (Doughnut) --}}
                        <div class="relative border border-border/30 bg-[#050505] p-4 group">
                            <div class="absolute top-0 right-0 w-2 h-2 border-t border-r border-primary/50"></div>
                            <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-4">> PROTOCOL_USAGE</p>
                            <div class="relative h-32 w-full flex justify-center">
                                <canvas id="methodChart"></canvas>
                            </div>
                        </div>

                        {{-- 3. Contact Type (Doughnut) --}}
                        <div class="relative border border-border/30 bg-[#050505] p-4 group">
                            <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-primary/50"></div>
                            <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-4">> PAYLOAD_CATEGORIES
                            </p>
                            <div class="relative h-32 w-full flex justify-center">
                                <canvas id="typeChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ========================================== --}}
            {{-- 3. COMMAND FILTER PANEL                    --}}
            {{-- ========================================== --}}
            <div class="relative border border-border/50 bg-surface/10 p-4 space-y-4">
                <form id="filterForm" method="GET" action="{{ route('dashboard.contacts.index') }}"
                    class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">

                    {{-- Search Terminal --}}
                    <div class="relative w-full md:w-[40%] group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 font-mono text-primary text-sm">></div>
                        <input type="text" name="search" value="{{ $search }}"
                            placeholder="GREP_SENDER_OR_SUBJECT_"
                            class="w-full border border-border/70 bg-surface/30 px-4 py-2.5 pl-8 font-mono text-[10px] sm:text-xs uppercase tracking-widest text-text placeholder:text-muted/50 focus:outline-none focus:border-primary focus:bg-primary/5 transition-colors"
                            onchange="document.getElementById('filterForm').submit();" />
                        <div
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-1.5 h-3 bg-primary/30 group-focus-within:bg-primary group-focus-within:animate-pulse pointer-events-none">
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-2 md:gap-3">
                        {{-- Filter Dropdown --}}
                        <div class="relative">
                            <select name="filter"
                                class="appearance-none border border-border/70 bg-surface/30 px-6 py-2.5 pr-10 font-mono text-[10px] sm:text-xs uppercase tracking-widest text-muted hover:text-text focus:outline-none focus:border-primary transition-colors cursor-pointer"
                                onchange="document.getElementById('filterForm').submit();">
                                <option value="ALL" {{ $filter == 'ALL' ? 'selected' : '' }}>FILTER: ALL_MSGS</option>
                                <option value="UNREAD" {{ $filter == 'UNREAD' ? 'selected' : '' }}>FILTER: UNREAD_ONLY
                                </option>
                                <option value="PROJECT" {{ $filter == 'PROJECT' ? 'selected' : '' }}>TYPE: PROJECT
                                </option>
                                <option value="COLLAB" {{ $filter == 'COLLAB' ? 'selected' : '' }}>TYPE: COLLAB</option>
                            </select>
                            <i
                                class="fa-solid fa-filter absolute right-4 top-1/2 -translate-y-1/2 text-muted text-[10px] pointer-events-none"></i>
                        </div>

                        {{-- Action --}}
                        @if ($unreadCount > 0)
                            <button type="button" onclick="document.getElementById('readAllForm').submit();"
                                class="px-4 py-2.5 border border-border/70 bg-surface/30 font-mono text-[10px] sm:text-xs font-bold uppercase tracking-widest text-muted hover:border-primary hover:text-primary transition-colors">
                                [ MARK_ALL_READ ]
                            </button>
                        @endif
                    </div>
                </form>

                <form id="readAllForm" method="POST" action="{{ route('dashboard.contacts.readAll') }}"
                    class="hidden">
                    @csrf
                </form>
            </div>

            {{-- ========================================== --}}
            {{-- 4. MESSAGE PAYLOAD STREAM                  --}}
            {{-- ========================================== --}}
            <div class="space-y-8">

                @forelse($groupedContacts as $month => $contacts)
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-border/30 pb-2">
                            <h2 class="text-sm font-mono font-bold text-text uppercase tracking-widest">
                                {{ $month }}
                            </h2>
                        </div>

                        <div class="space-y-4">
                            @foreach ($contacts as $msg)
                                @php
                                    $isUnread = !$msg->is_read;

                                    // Style by Type
                                    $typeStyle = match (strtolower($msg->type)) {
                                        'project' => 'text-sky-400 border-sky-400/30 bg-sky-400/10',
                                        'collab' => 'text-green-400 border-green-400/30 bg-green-400/10',
                                        'inquiry' => 'text-primary border-primary/30 bg-primary/10',
                                        default => 'text-muted border-border bg-surface',
                                    };

                                    // Method Icon
                                    $methodIcon =
                                        $msg->method === 'wa'
                                            ? 'fa-brands fa-whatsapp text-green-500'
                                            : 'fa-solid fa-envelope text-primary';
                                @endphp

                                {{-- Interactive Alpine Component for Accordion --}}
                                <div x-data="{ expanded: false }"
                                    class="relative border {{ $isUnread ? 'border-primary/50 bg-primary/5' : 'border-border/50 bg-[#050505]' }} transition-colors duration-300 group"
                                    id="contact-{{ $msg->id }}">

                                    {{-- Unread Indicator Line --}}
                                    @if ($isUnread)
                                        <div
                                            class="absolute left-0 top-0 bottom-0 w-1 bg-primary shadow-[0_0_10px_var(--color-primary)] unread-line">
                                        </div>
                                    @endif

                                    {{-- Closed View (Click to expand) --}}
                                    <div @click="expanded = !expanded"
                                        class="p-4 md:p-6 cursor-pointer flex flex-col md:flex-row md:items-center justify-between gap-4 md:gap-6 hover:bg-surface/30 transition-colors">

                                        {{-- Meta Info (Left) --}}
                                        <div class="flex items-center gap-4 w-full md:w-1/4 shrink-0">
                                            <div
                                                class="w-10 h-10 shrink-0 border border-border/50 bg-background flex items-center justify-center">
                                                <i class="{{ $methodIcon }} text-lg"></i>
                                            </div>
                                            <div class="overflow-hidden">
                                                <p class="text-xs font-mono font-bold text-text truncate group-hover:text-primary transition-colors"
                                                    title="{{ $msg->sender }}">
                                                    {{ $msg->sender }}
                                                </p>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <span
                                                        class="text-[9px] font-mono uppercase tracking-widest border px-1.5 py-0.5 {{ $typeStyle }}">
                                                        {{ $msg->type }}
                                                    </span>
                                                    @if ($isUnread)
                                                        <span
                                                            class="unread-badge text-[9px] font-mono uppercase tracking-widest text-primary animate-pulse border border-primary/50 px-1.5 py-0.5 bg-primary/10">
                                                            NEW
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Subject & Snippet (Middle) --}}
                                        <div class="flex-1 min-w-0">
                                            <h4
                                                class="title-text text-base font-bold text-text truncate {{ $isUnread ? '' : 'opacity-80' }}">
                                                {{ $msg->subject }}
                                            </h4>
                                            <p class="text-xs font-mono text-muted truncate mt-1">
                                                <span class="text-primary/50">></span>
                                                {{ \Illuminate\Support\Str::limit($msg->message, 70) }}
                                            </p>
                                        </div>

                                        {{-- Timestamp & Arrow (Right) --}}
                                        <div
                                            class="flex items-center justify-between md:justify-end gap-6 w-full md:w-auto shrink-0 border-t border-border/30 md:border-none pt-3 md:pt-0">
                                            <div class="text-right">
                                                <p class="text-[10px] font-mono text-muted uppercase tracking-widest">
                                                    {{ $msg->created_at->format('d M Y') }}
                                                </p>
                                                <p
                                                    class="text-[9px] font-mono text-muted/50 uppercase tracking-widest mt-0.5">
                                                    {{ $msg->created_at->format('H:i:s') }}
                                                </p>
                                            </div>

                                            <div class="w-6 h-6 flex items-center justify-center border border-border/50 text-muted transition-transform duration-300"
                                                :class="expanded ? 'rotate-180 bg-primary/10 border-primary text-primary' :
                                                    'group-hover:border-primary group-hover:text-primary'">
                                                <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Expanded View (The actual message payload) --}}
                                    <div x-show="expanded" x-collapse class="border-t border-border/50 bg-[#020202]">
                                        <div class="p-6 md:p-8 space-y-6">

                                            {{-- Terminal Meta Header --}}
                                            <div
                                                class="font-mono text-[10px] text-muted/70 uppercase tracking-widest space-y-1 border-l-2 border-border/50 pl-3">
                                                <p>PACKET_ID...: <span
                                                        class="text-primary">TX_{{ str_pad($msg->id, 4, '0', STR_PAD_LEFT) }}</span>
                                                </p>
                                                <p>ORIGIN_NODE.: <span class="text-text">{{ $msg->sender }}</span></p>
                                                <p>PROTOCOL....: <span
                                                        class="text-text">{{ strtoupper($msg->method) }}</span></p>
                                                <p>TIMESTAMP...: <span
                                                        class="text-text">{{ $msg->created_at->format('Y-m-d H:i:s') }}</span>
                                                </p>
                                            </div>

                                            {{-- Raw Message --}}
                                            <div
                                                class="bg-surface/20 border border-border/30 p-5 font-mono text-sm leading-relaxed text-text/90 relative">
                                                <i
                                                    class="fa-solid fa-quote-left absolute top-4 left-4 text-3xl text-muted/10"></i>
                                                <p class="relative z-10 whitespace-pre-wrap">{{ $msg->message }}</p>
                                            </div>

                                            {{-- Actions --}}
                                            <div
                                                class="flex flex-wrap items-center justify-between gap-3 pt-4 border-t border-border/30">
                                                @if ($msg->method === 'email')
                                                    <a href="mailto:{{ $msg->sender }}?subject=RE: {{ rawurlencode($msg->subject) }}"
                                                        class="px-5 py-2.5 bg-primary/10 border border-primary text-[10px] font-mono font-bold uppercase tracking-widest text-primary hover:bg-primary hover:text-background transition-colors flex items-center gap-2">
                                                        <i class="fa-solid fa-reply"></i> [ REPLY_VIA_SMTP ]
                                                    </a>
                                                @else
                                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->sender) }}?text=Halo,%20terima%20kasih%20telah%20menghubungi%20kami.%20Balasan%20untuk:%20{{ rawurlencode($msg->subject) }}"
                                                        target="_blank"
                                                        class="px-5 py-2.5 bg-green-500/10 border border-green-500 text-[10px] font-mono font-bold uppercase tracking-widest text-green-500 hover:bg-green-500 hover:text-background transition-colors flex items-center gap-2">
                                                        <i class="fa-brands fa-whatsapp"></i> [ REPLY_VIA_WA ]
                                                    </a>
                                                @endif

                                                @if ($isUnread)
                                                    <form method="POST"
                                                        action="{{ route('dashboard.contacts.read', $msg->id) }}">
                                                        @csrf @method('PATCH')
                                                        <button type="submit"
                                                            class="px-5 py-2.5 border border-primary/30 text-[10px] font-mono font-bold uppercase tracking-widest text-primary hover:bg-primary hover:text-background transition-colors group flex items-center gap-2">
                                                            <i
                                                                class="fa-solid fa-check-double opacity-50 group-hover:opacity-100"></i>
                                                            [ MARK_AS_READ ]
                                                        </button>
                                                    </form>
                                                @else
                                                    <div
                                                        class="px-5 py-2.5 border border-border/50 text-[10px] font-mono font-bold uppercase tracking-widest text-muted/50 flex items-center gap-2">
                                                        <i class="fa-solid fa-check"></i>
                                                        [ READ_ACKNOWLEDGED ]
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                        @if ($contacts instanceof \Illuminate\Pagination\LengthAwarePaginator && $contacts->hasPages())
                            <div class="flex justify-center pt-4">
                                <nav class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-widest">
                                    @if ($contacts->onFirstPage())
                                        <span
                                            class="px-4 py-2 text-muted border border-border/50 bg-surface/30 opacity-50 cursor-not-allowed">[
                                            PREV ]</span>
                                    @else
                                        <a href="{{ $contacts->previousPageUrl() }}"
                                            class="px-4 py-2 border border-border hover:border-primary text-muted hover:text-primary transition-colors">[
                                            PREV ]</a>
                                    @endif

                                    <span
                                        class="px-4 py-2 border border-primary bg-primary/5 text-primary font-bold">PG_{{ str_pad($contacts->currentPage(), 2, '0', STR_PAD_LEFT) }}
                                        / {{ str_pad($contacts->lastPage(), 2, '0', STR_PAD_LEFT) }}</span>

                                    @if ($contacts->hasMorePages())
                                        <a href="{{ $contacts->nextPageUrl() }}"
                                            class="px-4 py-2 border border-border hover:border-primary text-muted hover:text-primary transition-colors">[
                                            NEXT ]</a>
                                    @else
                                        <span
                                            class="px-4 py-2 text-muted border border-border/50 bg-surface/30 opacity-50 cursor-not-allowed">[
                                            NEXT ]</span>
                                    @endif
                                </nav>
                            </div>
                        @endif
                    </div>
                @empty
                    {{-- Empty State --}}
                    <div
                        class="border border-border/50 bg-surface/10 py-20 px-6 flex flex-col items-center justify-center text-center relative overflow-hidden group">
                        <div
                            class="absolute inset-0 bg-[repeating-linear-gradient(45deg,transparent,transparent_10px,rgba(255,255,255,0.01)_10px,rgba(255,255,255,0.01)_20px)] pointer-events-none">
                        </div>
                        <i class="fa-solid fa-satellite text-5xl text-muted/30 mb-6 group-hover:animate-pulse"></i>
                        <p class="text-[10px] uppercase tracking-widest text-muted font-mono mb-4">> INBOX_TERMINAL</p>
                        <h3 class="text-xl font-mono font-bold uppercase tracking-widest text-text max-w-xl">
                            NO_INCOMING_TRANSMISSIONS</h3>
                        <p class="mt-3 text-xs font-mono text-muted/70 max-w-md leading-relaxed">System is currently
                            listening for new packets. All frequency channels are clear.</p>
                    </div>
                @endforelse

            </div>



        </section>
    </div>

@endsection

@push('scripts')
    {{-- Load Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // === KONFIGURASI GLOBAL HUD ===
            Chart.defaults.color = '#71717a';
            Chart.defaults.font.family = 'monospace';
            Chart.defaults.font.size = 10;

            const gridConfig = {
                color: 'rgba(255, 255, 255, 0.05)',
                tickColor: 'transparent'
            };
            const tooltipConfig = {
                backgroundColor: 'rgba(5, 5, 5, 0.95)',
                titleFont: {
                    family: 'monospace',
                    size: 11
                },
                bodyFont: {
                    family: 'monospace',
                    size: 10
                },
                borderColor: 'rgba(168, 85, 247, 0.5)',
                borderWidth: 1,
                cornerRadius: 0,
                padding: 10
            };

            // Parse Data dari Controller
            const rawData = {!! json_encode($chartData ?? []) !!};

            const timelineData = rawData.timeline || {
                'Jan': 0,
                'Feb': 0
            };
            const methodData = rawData.method || {
                'Email (SMTP)': 0,
                'WhatsApp': 0
            };
            const typeData = rawData.type || {
                'project': 0,
                'collab': 0,
                'inquiry': 0
            };

            // Warna Neons HUD
            const colors = {
                primary: '#a855f7',
                sky: '#38bdf8',
                green: '#4ade80',
                amber: '#fbbf24',
                bgSky: 'rgba(56, 189, 248, 0.1)',
                borderGreen: 'rgba(74, 222, 128, 0.5)'
            };

            // 1. INBOUND TRAFFIC TIMELINE (Line)
            new Chart(document.getElementById('contactTimelineChart'), {
                type: 'line',
                data: {
                    labels: Object.keys(timelineData),
                    datasets: [{
                        label: 'Packets Received',
                        data: Object.values(timelineData),
                        borderColor: colors.primary,
                        backgroundColor: 'rgba(168, 85, 247, 0.1)',
                        borderWidth: 2,
                        pointBackgroundColor: colors.primary,
                        pointBorderColor: '#050505',
                        pointRadius: 4,
                        fill: true,
                        tension: 0.3,
                        stepped: true // Stepped line memberikan kesan digital/tech
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            grid: gridConfig,
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        },
                        x: {
                            grid: gridConfig
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: tooltipConfig
                    }
                }
            });

            // 2. PROTOCOL USAGE (Doughnut)
            new Chart(document.getElementById('methodChart'), {
                type: 'doughnut',
                data: {
                    labels: Object.keys(methodData),
                    datasets: [{
                        data: Object.values(methodData),
                        backgroundColor: [colors.primary, colors.green],
                        borderColor: '#050505',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 8
                            }
                        },
                        tooltip: tooltipConfig
                    }
                }
            });

            // 3. PAYLOAD CATEGORIES (Doughnut)
            new Chart(document.getElementById('typeChart'), {
                type: 'doughnut',
                data: {
                    labels: Object.keys(typeData).map(t => t.toUpperCase()),
                    datasets: [{
                        data: Object.values(typeData),
                        backgroundColor: [colors.sky, colors.green, colors.amber, '#1f2937'],
                        borderColor: '#050505',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 8
                            }
                        },
                        tooltip: tooltipConfig
                    }
                }
            });
        });
    </script>
@endpush
