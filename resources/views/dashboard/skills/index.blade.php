@extends('layouts.dashboard')
@section('title', 'Skills')

@vite(['resources/css/dashboard_project.css', 'resources/js/app.js'])

@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400;600;700&family=Merriweather:ital,wght@0,300;0,700;1,300&display=swap');

        .font-diary-body { font-family: 'Merriweather', serif; }
        .font-diary-accent { font-family: 'Caveat', cursive; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <div class="min-h-screen bg-bg pt-6 sm:pt-12 pb-24 px-4 md:px-6 relative overflow-hidden text-text">

        <div class="absolute inset-0 pointer-events-none opacity-[0.04] z-0"
            style="background-image: radial-gradient(#292524 1px, transparent 1px); background-size: 24px 24px;">
        </div>

        <section class="max-w-7xl mx-auto relative z-10 space-y-12 mt-4 md:mt-8">

            <header class="relative space-y-6">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div class="space-y-6">

                        <h1 class="text-[clamp(2.5rem,6vw,4.5rem)] font-bold tracking-tighter leading-[1.05] text-text">
                            <span class="block font-diary-body">Tech Stack</span>
                            <span class="block text-muted mt-2 text-[clamp(1.5rem,4vw,2.5rem)] font-diary-accent">Keahlian & Teknologi</span>
                        </h1>

                        <p class="text-base text-muted max-w-2xl leading-relaxed font-diary-body">
                            Mengelola dan mengelompokkan <span class="font-bold border-b border-stone-400">{{ $summary['totalSkills'] }}</span> Tech Stack yang tercatat.
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="button" onclick="window.openCreateSkillModal()"
                            class="px-4 py-2.5 bg-yellow-100 border-2 border-yellow-600 rounded-lg text-xs font-bold uppercase tracking-widest text-yellow-900 hover:-translate-y-1 hover:rotate-2 transition-all shadow-[4px_4px_0px_rgba(202,138,4,0.4)] group flex items-center gap-2">
                            <i class="fa-solid fa-plus group-hover:rotate-90 transition-transform text-yellow-700"></i>
                            Tambah Keahlian
                        </button>
                    </div>
                </div>
            </header>

            <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 md:gap-6">

                <div class="bg-amber-100 p-5 rounded-sm shadow-md border border-stone-200/70 flex flex-col justify-between relative group hover:z-50 hover:scale-[1.02] transition-all rotate-1 font-diary-body">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-3 before:bg-white/50 before:shadow-inner before:border-b before:border-stone-200/50"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-stone-500 mb-3 flex items-center gap-2 mt-2">
                        <i class="fa-solid fa-globe text-amber-500"></i> Total
                    </p>
                    <h3 class="text-3xl font-bold text-stone-900">{{ str_pad($summary['totalSkills'], 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

                <div class="bg-sky-100 p-5 rounded-sm shadow-md border border-stone-200/70 flex flex-col justify-between relative group hover:z-50 hover:scale-[1.02] transition-all -rotate-1 font-diary-body">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-3 before:bg-white/50 before:shadow-inner before:border-b before:border-stone-200/50"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-stone-500 mb-3 flex items-center gap-2 mt-2">
                        <i class="fa-solid fa-desktop text-sky-500"></i> Frontend
                    </p>
                    <h3 class="text-3xl font-bold text-stone-900">{{ str_pad($summary['frontendCount'], 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

                <div class="bg-rose-100 p-5 rounded-sm shadow-md border border-stone-200/70 flex flex-col justify-between relative group hover:z-50 hover:scale-[1.02] transition-all rotate-2 font-diary-body">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-3 before:bg-white/50 before:shadow-inner before:border-b before:border-stone-200/50"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-stone-500 mb-3 flex items-center gap-2 mt-2">
                        <i class="fa-solid fa-server text-rose-500"></i> Backend
                    </p>
                    <h3 class="text-3xl font-bold text-stone-900">{{ str_pad($summary['backendCount'], 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

                <div class="bg-orange-100 p-5 rounded-sm shadow-md border border-stone-200/70 flex flex-col justify-between relative group hover:z-50 hover:scale-[1.02] transition-all -rotate-2 font-diary-body">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-3 before:bg-white/50 before:shadow-inner before:border-b before:border-stone-200/50"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-stone-500 mb-3 flex items-center gap-2 mt-2">
                        <i class="fa-solid fa-toolbox text-orange-500"></i> Tools
                    </p>
                    <h3 class="text-3xl font-bold text-stone-900">{{ str_pad($summary['toolsCount'] + $summary['otherCount'], 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

                <div class="bg-emerald-100 p-5 rounded-sm shadow-md border border-stone-200/70 flex flex-col justify-between relative group hover:z-50 hover:scale-[1.02] transition-all rotate-1 font-diary-body">
                    <div class="before:content-[''] before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-1/2 before:h-3 before:bg-white/50 before:shadow-inner before:border-b before:border-stone-200/50"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-stone-500 mb-3 flex items-center gap-2 mt-2">
                        <i class="fa-solid fa-star text-emerald-500"></i> Stack Utama
                    </p>
                    <h3 class="text-3xl font-bold text-stone-900">{{ str_pad($summary['coreCount'], 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

            </div>

            <div x-data="{ expanded: localStorage.getItem('skill_matrix_expanded') !== 'false' }"
                class="bg-surface border-2 border-dashed border-border shadow-sm rounded-xl p-5 md:p-6 space-y-6 font-sans relative mt-8">

                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-20 h-6 bg-muted opacity-20 backdrop-blur-sm -rotate-1 shadow-sm" style="clip-path: polygon(5% 0, 100% 5%, 95% 100%, 0 95%); z-index: 10;"></div>

                <div class="flex items-center justify-between border-b-2 border-dashed border-border/50 pb-4">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-text flex items-center gap-2 cursor-pointer"
                        @click="expanded = !expanded; localStorage.setItem('skill_matrix_expanded', expanded)">
                        <i class="fa-solid fa-chart-pie text-primary"></i> Statistik Keahlian
                    </h3>
                    <div class="flex items-center gap-4">
                        <button @click="expanded = !expanded; localStorage.setItem('skill_matrix_expanded', expanded)"
                            type="button"
                            class="text-xs font-bold text-stone-400 hover:text-stone-800 transition-colors focus:outline-none font-diary-body">
                            <span x-text="expanded ? 'Sembunyikan' : 'Tampilkan'"></span>
                        </button>
                    </div>
                </div>

                <div x-show="expanded" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <div class="space-y-3 lg:col-span-2">
                        <p class="text-[12px] font-bold tracking-wide text-muted font-diary-accent">Distribusi Kategori</p>
                        <div class="relative h-56 w-full flex justify-center bg-container/30 rounded border border-border/50 p-2 shadow-inner">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>

                    <div class="space-y-3 lg:col-span-2">
                        <p class="text-[12px] font-bold tracking-wide text-muted font-diary-accent">Pertumbuhan Tahunan</p>
                        <div class="relative h-56 w-full bg-container/30 rounded border border-border/50 p-2 shadow-inner">
                            <canvas id="growthChart"></canvas>
                        </div>
                    </div>

                    <div class="space-y-3 lg:col-span-2">
                        <p class="text-[12px] font-bold tracking-wide text-muted font-diary-accent">Kelengkapan Ikon</p>
                        <div class="relative h-40 w-full flex justify-center bg-container/30 rounded border border-border/50 p-2 shadow-inner">
                            <canvas id="iconChart"></canvas>
                        </div>
                    </div>

                    <div class="space-y-3 lg:col-span-2">
                        <p class="text-[12px] font-bold tracking-wide text-muted font-diary-accent">Kelengkapan Deskripsi</p>
                        <div class="relative h-40 w-full flex justify-center bg-container/30 rounded border border-border/50 p-2 shadow-inner">
                            <canvas id="descChart"></canvas>
                        </div>
                    </div>

                </div>
            </div>

            <div class="bg-surface border-2 border-dashed border-border shadow-sm rounded-xl p-5 md:p-6 space-y-6 font-sans relative mt-8">

                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-20 h-6 bg-stone-300 opacity-40 backdrop-blur-sm rotate-2 shadow-sm" style="clip-path: polygon(5% 0, 100% 5%, 95% 100%, 0 95%); z-index: 10;"></div>
                <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-5 border-b-2 border-dashed border-border pb-6 relative z-20">
                    <div class="relative w-full md:w-1/2 group">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 group-focus-within:text-stone-800 transition-colors"></i>
                        <input type="text" id="search-input" placeholder="Cari Teknologi atau alat..."
                            class="w-full border-2 border-stone-300 bg-[#FCFAEF] rounded-lg px-4 py-3 pl-11 text-sm font-diary-body text-stone-800 placeholder:text-stone-400 placeholder:italic focus:outline-none focus:border-stone-800 focus:ring-0 transition-all shadow-inner"
                            style="background-image: repeating-linear-gradient(transparent, transparent 27px, #e5e5e5 27px, #e5e5e5 28px); line-height: 28px; background-attachment: local;" />
                    </div>

                    <div class="relative z-40 w-full md:w-auto">
                        <button id="sort-toggle"
                            class="w-full md:w-auto flex justify-between items-center gap-6 px-5 py-3 border-2 border-border bg-container rounded-lg text-xs font-bold uppercase tracking-widest text-text hover:border-primary hover:text-primary hover:-translate-y-0.5 transition-all shadow-[3px_3px_0px_var(--color-border)] focus:outline-none">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-arrow-down-short-wide"></i>
                                <span id="sort-label" data-i18n="project.sort.menu.latest">Terbaru</span>
                            </span>
                            <i class="fa-solid fa-chevron-down text-[10px]" id="sort-chevron"></i>
                        </button>

                        <div id="sort-menu"
                            class="hidden absolute right-0 top-full mt-3 w-full min-w-[12rem] bg-surface rounded-lg border-2 border-border shadow-[4px_4px_0px_var(--color-border)] overflow-hidden">

                            <button class="sort-option w-full text-left px-5 py-3 text-xs font-bold uppercase tracking-widest text-muted hover:bg-container hover:text-text transition-colors border-b-2 border-dashed border-border/50"
                                data-sort="latest" data-i18n="project.sort.menu.latest">
                                Terbaru
                            </button>

                            <button class="sort-option w-full text-left px-5 py-3 text-xs font-bold uppercase tracking-widest text-muted hover:bg-container hover:text-text transition-colors border-b-2 border-dashed border-border/50"
                                data-sort="most_projects">
                                Sering Digunakan
                            </button>

                            <button class="sort-option w-full text-left px-5 py-3 text-xs font-bold uppercase tracking-widest text-muted hover:bg-container hover:text-text transition-colors border-b-2 border-dashed border-border/50"
                                data-sort="least_projects">
                                Jarang Digunakan
                            </button>

                            <button class="sort-option w-full text-left px-5 py-3 text-xs font-bold uppercase tracking-widest text-muted hover:bg-container hover:text-text transition-colors border-b-2 border-dashed border-border/50"
                                data-sort="az">
                                A-Z
                            </button>

                            <button class="sort-option w-full text-left px-5 py-3 text-xs font-bold uppercase tracking-widest text-muted hover:bg-container hover:text-text transition-colors"
                                data-sort="za">
                                Z-A
                            </button>

                        </div>
                    </div>
                </div>

                @php $currentCat = request('category', 'all'); @endphp
                <div class="flex overflow-x-auto no-scrollbar gap-4 pb-2 pt-2 px-2 -mx-2 border-b border-border">
                    <button type="button"
                        class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none {{ $currentCat == 'all' ? 'bg-yellow-100 text-yellow-900 border-2 border-yellow-500 shadow-[2px_3px_0px_rgba(234,179,8,0.4)] -translate-y-1 rotate-1' : 'text-stone-500 bg-white border-2 border-stone-200 shadow-[1px_2px_0px_rgba(214,211,209,0.5)] hover:shadow-[3px_4px_0px_rgba(214,211,209,0.5)] hover:-translate-y-1 hover:-rotate-1' }}"
                        data-category="all">
                        Semua
                    </button>
                    <button type="button"
                        class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none {{ $currentCat == 'frontend' ? 'bg-sky-100 text-sky-900 border-2 border-sky-400 shadow-[2px_3px_0px_rgba(56,189,248,0.4)] -translate-y-1 rotate-1' : 'text-stone-500 bg-white border-2 border-stone-200 shadow-[1px_2px_0px_rgba(214,211,209,0.5)] hover:shadow-[3px_4px_0px_rgba(214,211,209,0.5)] hover:-translate-y-1 hover:rotate-1' }}"
                        data-category="frontend">
                        Frontend
                    </button>
                    <button type="button"
                        class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none {{ $currentCat == 'backend' ? 'bg-rose-100 text-rose-900 border-2 border-rose-400 shadow-[2px_3px_0px_rgba(251,113,133,0.4)] -translate-y-1 rotate-1' : 'text-stone-500 bg-white border-2 border-stone-200 shadow-[1px_2px_0px_rgba(214,211,209,0.5)] hover:shadow-[3px_4px_0px_rgba(214,211,209,0.5)] hover:-translate-y-1 hover:-rotate-1' }}"
                        data-category="backend">
                        Backend
                    </button>
                    <button type="button"
                        class="filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none {{ $currentCat == 'tools' ? 'bg-amber-100 text-amber-900 border-2 border-amber-400 shadow-[2px_3px_0px_rgba(251,191,36,0.4)] -translate-y-1 rotate-1' : 'text-stone-500 bg-white border-2 border-stone-200 shadow-[1px_2px_0px_rgba(214,211,209,0.5)] hover:shadow-[3px_4px_0px_rgba(214,211,209,0.5)] hover:-translate-y-1 hover:rotate-1' }}"
                        data-category="tools">
                        Tools
                    </button>
                </div>

                <div id="skills-container" class="transition-opacity duration-300 pt-4">
                    @include('dashboard.skills.partials.tags')
                </div>

            </div>

        </section>
    </div>

    <form id="deleteSkillForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

@endsection

<x-skill.create-modal />
<x-skill.edit-modal />

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Chart.defaults.color = '#78716c';
            Chart.defaults.font.family = "'Merriweather', serif";
            Chart.defaults.font.size = 11;

            const gridConfig = {
                color: 'rgba(214, 211, 209, 0.4)',
                tickColor: 'transparent'
            };
            const tooltipConfig = {
                backgroundColor: 'rgba(252, 250, 239, 0.95)',
                titleColor: '#292524',
                bodyColor: '#57534e',
                borderColor: '#d6d3d1',
                titleFont: {
                    family: "'Merriweather', serif",
                    size: 12,
                    weight: 'bold'
                },
                bodyFont: {
                    family: "'Merriweather', serif",
                    size: 11
                },
                borderWidth: 1,
                cornerRadius: 4,
                padding: 10
            };

            const rawData = {!! json_encode($chartData ?? []) !!};
            const catData = rawData.category || { 'Frontend': 10, 'Backend': 8, 'Tools': 5 };
            const growData = rawData.growth || { '2022': 5, '2023': 12, '2024': 8 };
            const iconData = rawData.icon || { 'Valid Icon': 20, 'No Icon': 3 };
            const descData = rawData.desc || { 'Valid Desc': 15, 'No Desc': 8 };

            const colors = {
                sky: '#38bdf8',
                green: '#34d399',
                amber: '#fbbf24',
                red: '#fb7185',
                primary: '#818cf8',
                bgSky: 'rgba(56, 189, 248, 0.2)',
                borderLight: '#e7e5e4'
            };

            new Chart(document.getElementById('categoryChart'), {
                type: 'doughnut',
                data: {
                    labels: Object.keys(catData),
                    datasets: [{
                        data: Object.values(catData),
                        backgroundColor: [colors.sky, colors.red, colors.amber, colors.primary],
                        borderColor: '#FCFAEF',
                        borderWidth: 2,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '60%',
                    plugins: {
                        legend: { position: 'right', labels: { boxWidth: 10, borderRadius: 2 } },
                        tooltip: tooltipConfig
                    }
                }
            });

            new Chart(document.getElementById('growthChart'), {
                type: 'bar',
                data: {
                    labels: Object.keys(growData),
                    datasets: [{
                        label: 'Keahlian Baru',
                        data: Object.values(growData),
                        backgroundColor: colors.bgSky,
                        borderColor: colors.sky,
                        borderWidth: 1,
                        borderRadius: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { grid: gridConfig, beginAtZero: true },
                        x: { grid: { display: false } }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: tooltipConfig
                    }
                }
            });

            new Chart(document.getElementById('iconChart'), {
                type: 'pie',
                data: {
                    labels: Object.keys(iconData),
                    datasets: [{
                        data: Object.values(iconData),
                        backgroundColor: [colors.amber, colors.borderLight],
                        borderColor: '#FCFAEF',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { boxWidth: 8 } },
                        tooltip: tooltipConfig
                    }
                }
            });

            new Chart(document.getElementById('descChart'), {
                type: 'pie',
                data: {
                    labels: Object.keys(descData),
                    datasets: [{
                        data: Object.values(descData),
                        backgroundColor: [colors.green, colors.borderLight],
                        borderColor: '#FCFAEF',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { boxWidth: 8 } },
                        tooltip: tooltipConfig
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.filter-btn');
            const searchInput = document.getElementById('search-input');
            const sortToggle = document.getElementById('sort-toggle');
            const sortMenu = document.getElementById('sort-menu');
            const sortLabel = document.getElementById('sort-label');
            const sortOptions = document.querySelectorAll('.sort-option');
            const container = document.getElementById('skills-container');

            let currentCategory = new URLSearchParams(window.location.search).get('category') || 'all';
            let currentSearch = new URLSearchParams(window.location.search).get('search') || '';
            let currentSort = new URLSearchParams(window.location.search).get('sort') || 'latest';
            let debounceTimer;

            function fetchSkills(url = null) {
                container.style.opacity = '0.5';
                container.style.pointerEvents = 'none';

                const params = new URLSearchParams({
                    category: currentCategory,
                    search: currentSearch,
                    sort: currentSort
                });

                const fetchUrl = url || `{{ route('dashboard.skills.index') }}?${params.toString()}`;

                fetch(fetchUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(response => response.text())
                    .then(html => {
                        container.innerHTML = html;
                        container.style.opacity = '1';
                        container.style.pointerEvents = 'auto';
                        window.history.replaceState({}, '', fetchUrl);
                    })
                    .catch(error => {
                        console.error('Error fetching skills:', error);
                        container.style.opacity = '1';
                        container.style.pointerEvents = 'auto';
                    });
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', (e) => {
                    const target = e.currentTarget;

                    tabs.forEach(t => {
                        t.className = "filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest text-stone-500 bg-white border-2 border-stone-200 shadow-[1px_2px_0px_rgba(214,211,209,0.5)] hover:shadow-[3px_4px_0px_rgba(214,211,209,0.5)] hover:-translate-y-1 hover:-rotate-1 transition-all focus:outline-none";
                    });

                    let activeClass = "";
                    if (target.dataset.category === 'all') activeClass = "bg-yellow-100 text-yellow-900 border-yellow-500 shadow-[2px_3px_0px_rgba(234,179,8,0.4)]";
                    if (target.dataset.category === 'frontend') activeClass = "bg-sky-100 text-sky-900 border-sky-400 shadow-[2px_3px_0px_rgba(56,189,248,0.4)]";
                    if (target.dataset.category === 'backend') activeClass = "bg-rose-100 text-rose-900 border-rose-400 shadow-[2px_3px_0px_rgba(251,113,133,0.4)]";
                    if (target.dataset.category === 'tools') activeClass = "bg-amber-100 text-amber-900 border-amber-400 shadow-[2px_3px_0px_rgba(251,191,36,0.4)]";

                    target.className = `filter-btn shrink-0 px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest transition-all focus:outline-none border-2 -translate-y-1 rotate-1 ${activeClass}`;

                    currentCategory = target.dataset.category;
                    fetchSkills();
                });
            });

            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        currentSearch = e.target.value;
                        fetchSkills();
                    }, 300);
                });
            }

            if (sortToggle && sortMenu) {
                sortToggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    sortMenu.classList.toggle('hidden');
                });

                document.addEventListener('click', (e) => {
                    if (!sortToggle.contains(e.target) && !sortMenu.contains(e.target)) {
                        sortMenu.classList.add('hidden');
                    }
                });

                sortOptions.forEach(option => {
                    option.addEventListener('click', (e) => {
                        currentSort = e.currentTarget.dataset.sort;
                        sortLabel.textContent = e.currentTarget.textContent.trim();
                        sortMenu.classList.add('hidden');
                        fetchSkills();
                    });
                });
            }

            container.addEventListener('click', (e) => {
                const pBtn = e.target.closest('nav a');
                if (pBtn && pBtn.href) {
                    e.preventDefault();
                    const url = new URL(pBtn.href, window.location.origin);
                    url.searchParams.set('category', currentCategory);
                    if (currentSearch) url.searchParams.set('search', currentSearch);
                    url.searchParams.set('sort', currentSort);
                    fetchSkills(url.toString());

                    const section = document.getElementById('skills-container');
                    if (section) section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    return;
                }

                const editBtn = e.target.closest('.edit-skill-btn');
                if (editBtn) {
                    e.preventDefault();
                    if (window.openEditSkillModal) {
                        window.openEditSkillModal(
                            editBtn.dataset.id, editBtn.dataset.name, editBtn.dataset.category,
                            editBtn.dataset.icon, editBtn.dataset.description, editBtn.dataset.is_core
                        );
                    }
                    return;
                }

                const deleteBtn = e.target.closest('.delete-skill-btn');
                if (deleteBtn) {
                    e.preventDefault();
                    const id = deleteBtn.dataset.id;

                    const confirmModal = document.getElementById('confirm-modal');
                    const confirmYes = document.getElementById('confirm-yes');
                    const confirmCancel = document.getElementById('confirm-cancel');
                    const confirmMessage = document.getElementById('confirm-message');

                    if (confirmModal && confirmYes && confirmCancel) {
                        if (confirmMessage) confirmMessage.textContent = 'Apakah Anda yakin ingin mencabut catatan keahlian ini secara permanen?';

                        confirmModal.classList.remove('opacity-0', 'pointer-events-none');
                        confirmModal.style.opacity = '1';

                        const handleYes = () => {
                            const form = document.getElementById('deleteSkillForm');
                            form.action = `/dashboard/skills/${id}`;
                            form.submit();
                            cleanup();
                        };

                        const handleCancel = () => {
                            cleanup();
                        };

                        const cleanup = () => {
                            confirmModal.classList.add('opacity-0', 'pointer-events-none');
                            confirmModal.style.opacity = '0';
                            confirmYes.removeEventListener('click', handleYes);
                            confirmCancel.removeEventListener('click', handleCancel);
                        };

                        confirmYes.addEventListener('click', handleYes);
                        confirmCancel.addEventListener('click', handleCancel);
                    } else {
                        if (confirm('Apakah Anda yakin ingin mencabut catatan keahlian ini secara permanen?')) {
                            const form = document.getElementById('deleteSkillForm');
                            form.action = `/dashboard/skills/${id}`;
                            form.submit();
                        }
                    }
                }
            });
        });
    </script>
@endpush
