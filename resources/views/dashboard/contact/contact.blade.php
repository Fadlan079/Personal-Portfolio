@extends('layouts.dashboard')
@section('title', 'Contact')

@section('content')

    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms x-init="setTimeout(() => show = false, 4000)"
            class="fixed top-24 left-1/2 -translate-x-1/2 z-[100] w-[90%] max-w-lg border-l-2 border-emerald-500 bg-emerald-500/10 p-4 shadow-[0_0_20px_rgba(16,185,129,0.2)] backdrop-blur-md">
            <div class="flex justify-between items-start">
                <div class="flex gap-3 text-emerald-600">
                    <i class="fa-solid fa-check-circle mt-1"></i>
                    <div>
                        <h4 class="text-[10px] font-bold uppercase tracking-widest mb-1 font-sans">BERHASIL</h4>
                        <p class="text-xs font-serif italic opacity-90">{{ session('success') }}</p>
                    </div>
                </div>
                <button @click="show = false" class="text-emerald-600/50 hover:text-emerald-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
    @endif

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .paper-ruled { background-image: repeating-linear-gradient(transparent, transparent 27px, var(--color-border) 27px, var(--color-border) 28px); line-height: 28px; background-attachment: local; }
    </style>

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

                            <i class="fa-solid fa-envelope-open-text relative z-10 text-yellow-800 text-[11px] mt-px"></i>

                            <span class="relative z-10 text-[10px] sm:text-xs font-black tracking-[0.15em] uppercase text-yellow-900 mt-px">
                                Kotak Masuk
                            </span>
                        </div>

                        <h1 class="text-[clamp(2.5rem,6vw,4.5rem)] font-bold tracking-tighter leading-[1.05] text-text">
                            <span class="block">Pesan & Kontak</span>
                            <span class="block text-muted mt-2 text-[clamp(1.5rem,4vw,2.5rem)] font-serif italic">Jejak Komunikasi</span>
                        </h1>

                        <p class="text-base text-muted max-w-2xl leading-relaxed font-medium">
                            Tinjau dan kelola pesan masuk, permintaan proyek, serta ajakan kolaborasi.
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="px-4 py-2 bg-container border-2 border-border rounded-lg text-xs font-bold uppercase tracking-widest text-muted shadow-[3px_3px_0px_var(--color-border)] flex items-center gap-3">
                            STATUS:
                            <span class="{{ $unreadCount > 0 ? 'text-amber-500 animate-pulse' : 'text-emerald-500' }}">
                                {{ $unreadCount > 0 ? 'PESAN BARU' : 'SEMUA TERBACA' }}
                            </span>
                        </div>
                    </div>
                </div>
            </header>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
                <div class="bg-amber-100 p-6 rounded-sm shadow-md border border-gray-200/70 flex flex-col justify-between relative group/tooltip rotate-1 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10 font-sans">
                        <i class="fa-solid fa-inbox text-blue-500"></i> Total Pesan
                    </p>
                    <h3 class="text-4xl font-bold text-neutral-900 relative z-10">{{ str_pad($totalMessages, 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

                <div class="bg-rose-100 p-6 rounded-sm shadow-md border border-gray-200/70 flex flex-col justify-between relative group/tooltip -rotate-1 font-serif hover:z-50 hover:scale-[1.02] transition-all overflow-hidden">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>
                    @if ($unreadCount > 0)
                        <div class="absolute inset-0 bg-[repeating-linear-gradient(45deg,transparent,transparent_10px,rgba(244,63,94,0.05)_10px,rgba(244,63,94,0.05)_20px)] pointer-events-none"></div>
                    @endif
                    <p class="text-[10px] font-bold uppercase tracking-widest {{ $unreadCount > 0 ? 'text-rose-500 animate-pulse' : 'text-muted' }} mb-4 flex items-center gap-2 relative z-10 font-sans">
                        <i class="fa-solid fa-bell"></i> Belum Dibaca
                    </p>
                    <h3 class="text-4xl font-bold {{ $unreadCount > 0 ? 'text-rose-600' : 'text-neutral-900' }} relative z-10">{{ str_pad($unreadCount, 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

                <div class="bg-sky-100 p-6 rounded-sm shadow-md border border-gray-200/70 flex flex-col justify-between relative group/tooltip rotate-2 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10 font-sans">
                        <i class="fa-solid fa-briefcase text-sky-500"></i> Inisiasi Proyek
                    </p>
                    <h3 class="text-4xl font-bold text-neutral-900 relative z-10">{{ str_pad($projectCount, 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

                <div class="bg-emerald-100 p-6 rounded-sm shadow-md border border-gray-200/70 flex flex-col justify-between relative group/tooltip -rotate-2 font-serif hover:z-50 hover:scale-[1.02] transition-all">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-4 before:bg-white/50 before:shadow-inner"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-muted mb-4 flex items-center gap-2 relative z-10 font-sans">
                        <i class="fa-solid fa-handshake text-emerald-500"></i> Kolaborasi
                    </p>
                    <h3 class="text-4xl font-bold text-neutral-900 relative z-10">{{ str_pad($collabCount, 2, '0', STR_PAD_LEFT) }}</h3>
                </div>
            </div>

            <div x-data="{ expanded: localStorage.getItem('contact_matrix_expanded') !== 'false' }"
                class="bg-surface border-2 border-dashed border-border shadow-sm rounded-2xl p-5 md:p-6 space-y-6 font-sans relative">

                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-20 h-6 bg-muted opacity-20 backdrop-blur-sm -rotate-1" style="clip-path: polygon(5% 0, 100% 5%, 95% 100%, 0 95%); z-index: 10;"></div>

                <div class="flex items-center justify-between border-b-2 border-dashed border-border/50 pb-4">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-text flex items-center gap-2 cursor-pointer"
                        @click="expanded = !expanded; localStorage.setItem('contact_matrix_expanded', expanded)">
                        <i class="fa-solid fa-chart-line text-amber-500"></i> Statistik Pesan
                    </h3>
                    <div class="flex items-center gap-4">
                        <button @click="expanded = !expanded; localStorage.setItem('contact_matrix_expanded', expanded)"
                            type="button"
                            class="text-xs font-bold text-muted hover:text-amber-500 transition-colors focus:outline-none">
                            <span x-text="expanded ? 'Sembunyikan' : 'Tampilkan'"></span>
                        </button>
                    </div>
                </div>

                <div x-show="expanded" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <div class="lg:col-span-2 space-y-4">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-muted italic font-serif border-l-2 border-amber-500 pl-3">Trafik Pesan (6 Bulan)</p>
                        <div class="relative h-48 w-full bg-container/30 rounded-lg p-4 border border-border/50">
                            <canvas id="contactTimelineChart"></canvas>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-6">
                        <div class="relative h-40 w-full flex justify-center items-center">
                            <canvas id="inboxChart"></canvas>

                            <div class="absolute text-center top-8">
                                <p class="text-xs text-muted">Total</p>
                                <p class="text-lg font-bold">
                                    {{ $chartData['inbox']['total'] }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-muted italic font-serif border-l-2 border-sky-400 pl-3">Kategori Pesan</p>
                            <div class="relative h-32 w-full flex justify-center bg-container/30 rounded-lg p-2 border border-border/50">
                                <canvas id="typeChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="bg-surface border-2 border-dashed border-border shadow-sm rounded-2xl p-5 md:p-6 space-y-4 font-sans relative">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-20 h-6 bg-muted opacity-20 backdrop-blur-sm -rotate-2" style="clip-path: polygon(5% 0, 100% 5%, 95% 100%, 0 95%); z-index: 10;"></div>

                <form id="filterForm" method="GET" action="{{ route('dashboard.contacts.index') }}"
                    class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-5 relative z-20">

                    <div class="relative w-full md:w-1/2 group">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-muted group-focus-within:text-amber-500 transition-colors"></i>
                        <input type="text" name="search" value="{{ $search }}"
                            placeholder="Cari nama pengirim atau subjek..."
                            class="w-full border-2 border-border bg-container rounded-lg px-4 py-3 pl-11 text-sm font-medium text-text placeholder:text-muted placeholder:italic placeholder:font-serif focus:outline-none focus:border-amber-500 focus:ring-0 transition-all shadow-inner paper-ruled"
                            onchange="document.getElementById('filterForm').submit();" />
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <div class="relative">
                            <select name="filter"
                                class="appearance-none border-2 border-border bg-container rounded-lg px-5 py-3 pr-10 text-xs font-bold uppercase tracking-widest text-muted hover:text-text hover:border-amber-500 focus:outline-none focus:border-amber-500 transition-colors cursor-pointer shadow-[3px_3px_0px_var(--color-border)]"
                                onchange="document.getElementById('filterForm').submit();">
                                <option value="ALL" {{ $filter == 'ALL' ? 'selected' : '' }}>Semua Pesan</option>
                                <option value="UNREAD" {{ $filter == 'UNREAD' ? 'selected' : '' }}>Belum Dibaca</option>
                                <option value="PROJECT" {{ $filter == 'PROJECT' ? 'selected' : '' }}>Tipe: Project</option>
                                <option value="COLLAB" {{ $filter == 'COLLAB' ? 'selected' : '' }}>Tipe: Collab</option>
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-muted text-[10px] pointer-events-none"></i>
                        </div>

                        @if ($unreadCount > 0)
                            <button type="button" onclick="document.getElementById('readAllForm').submit();"
                                class="px-5 py-3 border-2 border-border bg-container rounded-lg text-xs font-bold uppercase tracking-widest text-muted hover:border-emerald-500 hover:text-emerald-500 hover:-translate-y-0.5 transition-all shadow-[3px_3px_0px_var(--color-border)]">
                                Tandai Terbaca
                            </button>
                        @endif
                    </div>
                </form>

                <form id="readAllForm" method="POST" action="{{ route('dashboard.contacts.readAll') }}" class="hidden">
                    @csrf
                </form>
            </div>

            <div class="space-y-10 mt-8">

                @forelse($groupedContacts as $month => $contacts)
                    <div class="space-y-5">
                        <div class="flex items-center justify-between border-b-2 border-dashed border-border/50 pb-2 relative">
                            <h2 class="text-xl font-serif font-bold text-text italic">
                                {{ $month }}
                            </h2>
                            <div class="absolute -bottom-1 left-0 w-12 h-[2px] bg-amber-500"></div>
                        </div>

                        <div class="space-y-4">
                            @foreach ($contacts as $msg)
                                @php
                                    $isUnread = !$msg->is_read;

                                    $typeStyle = match (strtolower($msg->type)) {
                                        'project' => 'text-sky-600 border-sky-300 bg-sky-50',
                                        'collab' => 'text-emerald-600 border-emerald-300 bg-emerald-50',
                                        'inquiry' => 'text-amber-600 border-amber-300 bg-amber-50',
                                        default => 'text-muted border-border bg-container',
                                    };

                                    $methodIcon = $msg->method === 'wa'
                                        ? 'fa-brands fa-whatsapp text-emerald-500'
                                        : 'fa-solid fa-envelope text-amber-500';
                                @endphp

                                <div x-data="{ expanded: false }"
                                    class="relative border-2 border-dashed {{ $isUnread ? 'border-rose-400 bg-rose-50/30' : 'border-border bg-container' }} rounded-xl transition-all duration-300 group shadow-sm hover:shadow-md hover:-translate-y-0.5"
                                    id="contact-{{ $msg->id }}">

                                    @if ($isUnread)
                                        <div class="absolute -left-2 -top-2 w-8 h-8 rounded-full bg-rose-500 text-white flex items-center justify-center text-[8px] font-bold shadow-md z-20 rotate-12">
                                            NEW
                                        </div>
                                    @endif

                                    <div @click="expanded = !expanded"
                                        class="p-4 md:p-6 cursor-pointer flex flex-col md:flex-row md:items-center justify-between gap-4 md:gap-6">

                                        <div class="flex items-center gap-4 w-full md:w-1/4 shrink-0">
                                            <div class="w-10 h-10 shrink-0 rounded-full border border-border bg-surface flex items-center justify-center shadow-inner">
                                                <i class="{{ $methodIcon }} text-lg"></i>
                                            </div>
                                            <div class="overflow-hidden">
                                                <p class="text-sm font-bold text-text truncate group-hover:text-amber-600 transition-colors font-sans" title="{{ $msg->sender }}">
                                                    {{ $msg->sender }}
                                                </p>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <span class="text-[9px] font-bold uppercase tracking-widest border rounded px-2 py-0.5 {{ $typeStyle }}">
                                                        {{ $msg->type }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-base font-bold text-text truncate {{ $isUnread ? '' : 'opacity-80' }} font-serif">
                                                {{ $msg->subject }}
                                            </h4>
                                            <p class="text-xs text-muted truncate mt-1 italic font-serif">
                                                {{ \Illuminate\Support\Str::limit($msg->message, 70) }}
                                            </p>
                                        </div>

                                        <div class="flex items-center justify-between md:justify-end gap-6 w-full md:w-auto shrink-0 border-t border-border/30 md:border-none pt-3 md:pt-0">
                                            <div class="text-right">
                                                <p class="text-[10px] font-bold text-muted uppercase tracking-widest font-sans">
                                                    {{ $msg->created_at->format('d M Y') }}
                                                </p>
                                                <p class="text-[9px] text-muted/60 uppercase tracking-widest mt-0.5 font-sans">
                                                    {{ $msg->created_at->format('H:i') }}
                                                </p>
                                            </div>

                                            <div class="w-8 h-8 rounded-full flex items-center justify-center border border-border text-muted transition-all duration-300 bg-surface shadow-sm"
                                                :class="expanded ? 'rotate-180 bg-amber-100 border-amber-300 text-amber-600' : 'group-hover:border-amber-300 group-hover:text-amber-500 group-hover:bg-amber-50'">
                                                <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div x-show="expanded" x-collapse class="border-t-2 border-dashed border-border/50 bg-[#FEFCE8] rounded-b-xl relative overflow-hidden">

                                        <div class="absolute top-0 left-0 bottom-0 w-8 border-r border-red-200/50 flex flex-col items-center py-2 gap-1 opacity-50 pointer-events-none">
                                            <div class="w-2 h-2 rounded-full border border-red-200"></div>
                                            <div class="w-2 h-2 rounded-full border border-red-200"></div>
                                            <div class="w-2 h-2 rounded-full border border-red-200"></div>
                                            <div class="w-2 h-2 rounded-full border border-red-200"></div>
                                        </div>

                                        <div class="p-6 md:p-8 pl-12 space-y-6">
                                            <div class="flex justify-between items-start border-b border-border/30 pb-4">
                                                <div class="font-sans text-[10px] text-muted uppercase tracking-widest space-y-1">
                                                    <p>Dari: <span class="font-bold text-neutral-800">{{ $msg->sender }}</span></p>
                                                    <p>Tanggal: <span class="text-neutral-800">{{ $msg->created_at->format('d M Y - H:i:s') }}</span></p>
                                                </div>
                                                <div class="bg-white/50 px-3 py-1 rounded border border-border/50 text-[10px] font-bold text-muted shadow-sm rotate-1">
                                                    ID: TX_{{ str_pad($msg->id, 4, '0', STR_PAD_LEFT) }}
                                                </div>
                                            </div>

                                            <div class="font-serif text-sm leading-relaxed text-neutral-800 relative min-h-[100px] paper-ruled pt-1">
                                                <p class="whitespace-pre-wrap">{{ $msg->message }}</p>
                                            </div>

                                            <div class="flex flex-wrap items-center justify-between gap-3 pt-6">
                                                @if ($msg->method === 'email')
                                                    <a href="mailto:{{ $msg->sender }}?subject=RE: {{ rawurlencode($msg->subject) }}"
                                                        class="px-5 py-2.5 bg-amber-100 border-2 border-amber-400 rounded-lg text-xs font-bold uppercase tracking-widest text-amber-900 hover:-translate-y-1 transition-all shadow-[3px_3px_0px_rgba(0,0,0,0.05)] flex items-center gap-2">
                                                        <i class="fa-solid fa-reply"></i> Balas Email
                                                    </a>
                                                @else
                                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->sender) }}?text=Halo,%20terima%20kasih%20telah%20menghubungi%20kami.%20Balasan%20untuk:%20{{ rawurlencode($msg->subject) }}"
                                                        target="_blank"
                                                        class="px-5 py-2.5 bg-emerald-100 border-2 border-emerald-400 rounded-lg text-xs font-bold uppercase tracking-widest text-emerald-900 hover:-translate-y-1 transition-all shadow-[3px_3px_0px_rgba(0,0,0,0.05)] flex items-center gap-2">
                                                        <i class="fa-brands fa-whatsapp text-lg"></i> Balas WhatsApp
                                                    </a>
                                                @endif

                                                @if ($isUnread)
                                                    <form method="POST" action="{{ route('dashboard.contacts.read', $msg->id) }}">
                                                        @csrf @method('PATCH')
                                                        <button type="submit"
                                                            class="px-5 py-2.5 bg-surface border-2 border-border rounded-lg text-xs font-bold uppercase tracking-widest text-muted hover:border-text hover:text-text hover:-translate-y-1 transition-all shadow-[3px_3px_0px_var(--color-border)] flex items-center gap-2">
                                                            <i class="fa-solid fa-check"></i> Tandai Selesai
                                                        </button>
                                                    </form>
                                                @else
                                                    <div class="px-5 py-2.5 border-2 border-dashed border-border/50 rounded-lg text-[10px] font-bold uppercase tracking-widest text-muted/50 flex items-center gap-2 bg-container/50">
                                                        <i class="fa-solid fa-check-double"></i> Telah Dibaca
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($contacts instanceof \Illuminate\Pagination\LengthAwarePaginator && $contacts->hasPages())
                            <div class="flex justify-center pt-8">
                                <nav class="flex flex-wrap sm:flex-nowrap items-center justify-center gap-3 sm:gap-4 font-mono w-full sm:w-auto px-4">
                                    @if ($contacts->onFirstPage())
                                        <span class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted opacity-30 cursor-not-allowed italic font-serif bg-container"><i class="fa-solid fa-chevron-left text-[10px] sm:text-xs"></i></span>
                                    @else
                                        <a href="{{ $contacts->previousPageUrl() }}" class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted hover:border-amber-500 hover:text-amber-500 hover:-translate-y-0.5 transition-all shadow-sm bg-container"><i class="fa-solid fa-chevron-left text-[10px] sm:text-xs pointer-events-none"></i></a>
                                    @endif

                                    <div class="px-4 py-1.5 sm:px-6 sm:py-2 bg-warning border-2 border-yellow-500 rounded-full shadow-[2px_2px_0px_var(--color-border)] rotate-1 shrink-0">
                                        <span class="text-[10px] sm:text-xs font-black text-yellow-900 uppercase tracking-widest whitespace-nowrap">
                                            Halaman {{ str_pad($contacts->currentPage(), 2, '0', STR_PAD_LEFT) }} <span class="opacity-50 mx-1">/</span> {{ str_pad($contacts->lastPage(), 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </div>

                                    @if ($contacts->hasMorePages())
                                        <a href="{{ $contacts->nextPageUrl() }}" class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted hover:border-amber-500 hover:text-amber-500 hover:-translate-y-0.5 transition-all shadow-sm bg-container"><i class="fa-solid fa-chevron-right text-[10px] sm:text-xs pointer-events-none"></i></a>
                                    @else
                                        <span class="shrink-0 w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-border flex items-center justify-center text-muted opacity-30 cursor-not-allowed italic font-serif bg-container"><i class="fa-solid fa-chevron-right text-[10px] sm:text-xs"></i></span>
                                    @endif
                                </nav>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="py-20 px-6 flex flex-col items-center justify-center text-center bg-[#fdfcf5] border-2 border-dashed border-[#e5e0d0] rounded-xl shadow-[4px_4px_0px_rgba(0,0,0,0.05)] relative font-sans overflow-hidden">
                        <div class="absolute inset-0 z-0 opacity-30" style="background-image: repeating-linear-gradient(transparent, transparent 24px, #e5e0d0 24px, #e5e0d0 25px);"></div>
                        <div class="relative z-20 space-y-3">
                            <i class="fa-solid fa-ghost text-5xl text-muted/30 mb-2"></i>
                            <h3 class="text-3xl font-medium text-black font-serif tracking-wide italic">Kotak Masuk Kosong</h3>
                            <p class="text-sm text-muted max-w-sm mx-auto italic font-serif opacity-90">Belum ada pesan yang masuk saat ini. Terus berkarya untuk menarik perhatian.</p>
                        </div>
                    </div>
                @endforelse

            </div>
        </section>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Chart.defaults.color = '#71717a';
            Chart.defaults.font.family = 'monospace';
            Chart.defaults.font.size = 10;

            const gridConfig = {
                color: 'rgba(0, 0, 0, 0.05)',
                tickColor: 'transparent'
            };
            const tooltipConfig = {
                backgroundColor: 'rgba(255, 255, 255, 0.95)',
                titleColor: '#1f2937',
                bodyColor: '#4b5563',
                titleFont: { family: 'serif', size: 12, weight: 'bold' },
                bodyFont: { family: 'sans-serif', size: 11 },
                borderColor: 'rgba(0, 0, 0, 0.1)',
                borderWidth: 1,
                cornerRadius: 4,
                padding: 10,
                boxPadding: 4
            };

            const rawData = {!! json_encode($chartData ?? []) !!};

            const timelineData = rawData.timeline || { 'Jan': 0, 'Feb': 0 };
            const methodData = rawData.method || { 'Email': 0, 'WhatsApp': 0 };
            const typeData = rawData.type || { 'project': 0, 'collab': 0, 'inquiry': 0 };

            const colors = {
                amber: '#f59e0b',
                bgAmber: 'rgba(245, 158, 11, 0.1)',
                emerald: '#10b981',
                sky: '#0ea5e9',
                rose: '#f43f5e',
                dark: '#1f2937'
            };

            new Chart(document.getElementById('contactTimelineChart'), {
                type: 'line',
                data: {
                    labels: Object.keys(timelineData),
                    datasets: [{
                        label: 'Pesan Masuk',
                        data: Object.values(timelineData),
                        borderColor: colors.amber,
                        backgroundColor: colors.bgAmber,
                        borderWidth: 2,
                        pointBackgroundColor: colors.amber,
                        pointBorderColor: '#fff',
                        pointRadius: 4,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { grid: gridConfig, beginAtZero: true, ticks: { stepSize: 1 } },
                        x: { grid: gridConfig }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: tooltipConfig
                    }
                }
            });

            const chartData = @json($chartData);
            const inboxData = chartData.inbox;
            new Chart(document.getElementById('inboxChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Unread', 'Read'],
                    datasets: [{
                        data: [inboxData.unread, inboxData.read],
                        backgroundColor: ['#f97316', '#22c55e'],
                    }]
                },
                options: {
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            new Chart(document.getElementById('typeChart'), {
                type: 'doughnut',
                data: {
                    labels: Object.keys(typeData).map(t => t.charAt(0).toUpperCase() + t.slice(1)),
                    datasets: [{
                        data: Object.values(typeData),
                        backgroundColor: [colors.sky, colors.emerald, colors.amber, colors.dark],
                        borderColor: '#FEFCE8',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: { position: 'right', labels: { boxWidth: 10, borderRadius: 2 } },
                        tooltip: tooltipConfig
                    }
                }
            });
        });
    </script>
@endpush
