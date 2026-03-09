@extends('layouts.dashboard')
@section('title', 'Skills')

@section('content')
    <div class="min-h-screen bg-background pt-12 pb-32 px-4 md:px-6 relative overflow-hidden">

        {{-- Global Faint Grid --}}
        <div class="absolute inset-0 pointer-events-none opacity-[0.02]"
            style="background-image: linear-gradient(var(--color-text) 1px, transparent 1px), linear-gradient(90deg, var(--color-text) 1px, transparent 1px); background-size: 64px 64px;">
        </div>

        <section class="max-w-7xl mx-auto relative z-10 space-y-12">

            {{-- HEADER MODULE --}}
            <header class="relative space-y-6 border-b border-border/50 pb-8 mt-4 md:mt-8">
                <div
                    class="absolute top-0 right-0 w-1/3 h-[1px] bg-gradient-to-r from-transparent to-primary/50 pointer-events-none">
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-widest text-primary">
                        <i class="fa-solid fa-layer-group"></i>
                        >> SYS_DIR / DASHBOARD / SKILL_NODES
                    </div>

                    {{-- Quick Actions --}}
                    <div class="hidden md:flex items-center gap-3">
                        <button type="button" onclick="window.openCreateSkillModal()"
                            class="px-4 py-2 bg-primary/10 border border-primary text-[10px] font-mono font-bold uppercase tracking-widest text-primary hover:bg-primary hover:text-background transition-colors group flex items-center gap-2 shadow-[0_0_15px_rgba(var(--color-primary-rgb),0.15)]">
                            <i class="fa-solid fa-plus group-hover:rotate-90 transition-transform"></i> [ REGISTER_SKILL ]
                        </button>
                    </div>
                </div>

                <div class="flex items-end gap-3 pt-2">
                    <h1
                        class="text-4xl md:text-5xl lg:text-6xl font-bold font-mono tracking-tighter uppercase text-text leading-none">
                        Skill_Registry
                    </h1>
                    <div
                        class="w-3 md:w-4 h-8 md:h-12 bg-primary animate-pulse mb-1 shadow-[0_0_10px_var(--color-primary)]">
                    </div>
                </div>

                <p class="text-sm font-mono text-muted tracking-wide max-w-2xl leading-relaxed">
                    <span class="text-primary">></span> Initialize tech stack configurations. System currently monitoring
                    {{ $summary['totalSkills'] }} active competencies across the mainframe.
                </p>

                {{-- Mobile Actions --}}
                <div class="flex md:hidden items-center gap-3 mt-4">
                    <button type="button" onclick="window.openCreateSkillModal()"
                        class="flex-1 px-4 py-3 bg-primary/10 border border-primary text-[10px] font-mono font-bold uppercase tracking-widest text-primary text-center">
                        [ NEW_SKILL ]
                    </button>
                </div>
            </header>

            {{-- METRICS DASHBOARD --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                {{-- Stat 1: Total --}}
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-primary/50 transition-colors">
                    <div class="absolute top-0 right-0 w-3 h-3 border-t border-r border-primary/50"></div>
                    <p class="text-[10px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-globe text-primary"></i> Total_Registered
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-text">
                        {{ str_pad($summary['totalSkills'], 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

                {{-- Stat 2: Frontend --}}
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-sky-400/50 transition-colors">
                    <div class="absolute top-0 right-0 w-3 h-3 border-t border-r border-sky-400/50"></div>
                    <p class="text-[10px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-desktop text-sky-400"></i> Client_Side
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-sky-400">
                        {{ str_pad($summary['frontendCount'], 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

                {{-- Stat 3: Backend --}}
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-red-400/50 transition-colors">
                    <div class="absolute top-0 right-0 w-3 h-3 border-t border-r border-red-400/50"></div>
                    <p class="text-[10px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-server text-red-400"></i> Server_Side
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-red-400">
                        {{ str_pad($summary['backendCount'], 2, '0', STR_PAD_LEFT) }}</h3>
                </div>

                {{-- Stat 4: Tools --}}
                <div
                    class="relative border border-border/50 bg-surface/20 p-5 group hover:border-amber-400/50 transition-colors">
                    <div class="absolute top-0 right-0 w-3 h-3 border-t border-r border-amber-400/50"></div>
                    <p class="text-[10px] font-mono uppercase tracking-widest text-muted mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-toolbox text-amber-400"></i> Core_Tools
                    </p>
                    <h3 class="text-3xl font-mono font-bold text-amber-400">
                        {{ str_pad($summary['toolsCount'] + $summary['otherCount'], 2, '0', STR_PAD_LEFT) }}</h3>
                </div>
            </div>
            {{-- ========================================== --}}
            {{-- SKILLS VISUALIZATION MATRIX (CHART.JS)     --}}
            {{-- ========================================== --}}
            <div x-data="{ expanded: localStorage.getItem('skill_matrix_expanded') !== 'false' }"
                class="relative border border-border/50 bg-surface/10 p-4 md:p-6 space-y-6 transition-all duration-300">
                <div class="flex items-center justify-between border-b border-border/50 pb-4">
                    <h3 class="text-[10px] font-mono uppercase tracking-widest text-primary flex items-center gap-2 cursor-pointer"
                        @click="expanded = !expanded; localStorage.setItem('skill_matrix_expanded', expanded)">
                        <i class="fa-solid fa-chart-radar"></i> > SKILL_METRICS_RADAR
                    </h3>
                    <div class="flex items-center gap-4">
                        <span x-show="expanded"
                            class="text-[9px] font-mono text-green-400 animate-pulse hidden sm:inline-block">[ LIVE_RENDER
                            ]</span>
                        <button @click="expanded = !expanded; localStorage.setItem('skill_matrix_expanded', expanded)"
                            type="button"
                            class="text-[10px] font-mono text-muted hover:text-primary transition-colors focus:outline-none">
                            <span x-text="expanded ? '[_COLLAPSE_]' : '[_EXPAND_]'"></span>
                        </button>
                    </div>
                </div>

                <div x-show="expanded" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    {{-- 1. Skills by Category --}}
                    <div
                        class="relative border border-border/30 bg-[#050505] p-4 lg:col-span-2 group hover:border-primary/30 transition-colors">
                        <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-primary/50"></div>
                        <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-4">> CATEGORY_DISTRIBUTION
                        </p>
                        <div class="relative h-56 w-full flex justify-center">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>

                    {{-- 2. Skills Growth per Year --}}
                    <div
                        class="relative border border-border/30 bg-[#050505] p-4 lg:col-span-2 group hover:border-sky-400/30 transition-colors">
                        <div class="absolute top-0 right-0 w-2 h-2 border-t border-r border-sky-400/50"></div>
                        <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-4">> ANNUAL_GROWTH_RATE</p>
                        <div class="relative h-56 w-full">
                            <canvas id="growthChart"></canvas>
                        </div>
                    </div>

                    {{-- 3. Icon Integrity --}}
                    <div
                        class="relative border border-border/30 bg-[#050505] p-4 group hover:border-amber-400/30 transition-colors">
                        <div class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-amber-400/50"></div>
                        <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-4">> ICON_PAYLOAD_STATUS</p>
                        <div class="relative h-40 w-full flex justify-center">
                            <canvas id="iconChart"></canvas>
                        </div>
                    </div>

                    {{-- 4. Description Integrity --}}
                    <div
                        class="relative border border-border/30 bg-[#050505] p-4 group hover:border-green-400/30 transition-colors">
                        <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-green-400/50"></div>
                        <p class="text-[9px] font-mono uppercase tracking-widest text-muted mb-4">> DESC_PAYLOAD_STATUS</p>
                        <div class="relative h-40 w-full flex justify-center">
                            <canvas id="descChart"></canvas>
                        </div>
                    </div>

                </div>
            </div>
            {{-- CONTROL PANEL & TAG CLOUD --}}
            <div class="relative border border-border/50 bg-surface/10 p-4 md:p-6 space-y-6">

                {{-- Command Bar (Search & Sort) --}}
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4 border-b border-border/50 pb-6">

                    {{-- Terminal Search Input --}}
                    <div class="relative w-full md:w-1/2 group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 font-mono text-primary text-sm">></div>
                        <input type="text" id="search-input" placeholder="QUERY_SKILL_"
                            class="w-full border border-border/70 bg-surface/30 px-4 py-3 pl-8 font-mono text-xs uppercase tracking-widest text-text placeholder:text-muted/50 focus:outline-none focus:border-primary focus:bg-primary/5 transition-colors" />
                        <div
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-1.5 h-3 bg-primary/30 group-focus-within:bg-primary group-focus-within:animate-pulse pointer-events-none">
                        </div>
                    </div>

                    {{-- Sort Dropdown --}}
                    <div class="relative w-full md:w-auto">
                        <select id="sort-select"
                            class="appearance-none w-full border border-border/70 bg-surface/30 px-8 py-3 pr-12 font-mono text-xs uppercase tracking-widest text-muted hover:text-text focus:outline-none focus:border-primary transition-colors cursor-pointer">
                            <option value="latest">SORT: LATEST_LOG</option>
                            <option value="most_projects">SORT: HIGH_REF_COUNT</option>
                            <option value="least_projects">SORT: LOW_REF_COUNT</option>
                            <option value="az">SORT: ALPHABETICAL_ASC</option>
                            <option value="za">SORT: ALPHABETICAL_DESC</option>
                        </select>
                        <i
                            class="fa-solid fa-sort absolute right-4 top-1/2 -translate-y-1/2 text-muted pointer-events-none"></i>
                    </div>
                </div>

                {{-- Filter Tabs (dipertahankan class JS nya agar tidak error) --}}
                <div class="flex flex-wrap gap-2 border-b border-border/30 pb-4">
                    <button type="button"
                        class="filter-btn px-5 py-2 border border-primary bg-primary/10 text-primary font-mono text-[10px] font-bold uppercase tracking-widest transition-colors focus:outline-none"
                        data-category="all">
                        ALL_NODES
                    </button>
                    <button type="button"
                        class="filter-btn px-5 py-2 border border-border text-muted font-mono text-[10px] font-bold uppercase tracking-widest hover:border-sky-400 hover:text-sky-400 transition-colors focus:outline-none"
                        data-category="frontend">
                        CLIENT_SIDE
                    </button>
                    <button type="button"
                        class="filter-btn px-5 py-2 border border-border text-muted font-mono text-[10px] font-bold uppercase tracking-widest hover:border-red-400 hover:text-red-400 transition-colors focus:outline-none"
                        data-category="backend">
                        SERVER_SIDE
                    </button>
                    <button type="button"
                        class="filter-btn px-5 py-2 border border-border text-muted font-mono text-[10px] font-bold uppercase tracking-widest hover:border-amber-400 hover:text-amber-400 transition-colors focus:outline-none"
                        data-category="tools">
                        CORE_TOOLS
                    </button>
                </div>

                {{-- Container --}}
                <div id="skills-container" class="transition-opacity duration-300">
                    @include('dashboard.skills.partials.tags')
                </div>

            </div>

        </section>
    </div>

    <x-skill.create-modal />
    <x-skill.edit-modal />

    <form id="deleteSkillForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

@endsection

@push('scripts')
    {{-- Load Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // === KONFIGURASI GLOBAL HUD TEMA TERMINAL ===
            Chart.defaults.color = '#71717a'; // text-muted
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

            const catData = rawData.category || {
                'Frontend': 10,
                'Backend': 8,
                'Tools': 5
            };
            const growData = rawData.growth || {
                '2022': 5,
                '2023': 12,
                '2024': 8
            };
            const iconData = rawData.icon || {
                'Valid Icon': 20,
                'No Icon': 3
            };
            const descData = rawData.desc || {
                'Valid Desc': 15,
                'No Desc': 8
            };

            // Palette Cyberpunk
            const colors = {
                primary: '#a855f7',
                sky: '#38bdf8',
                green: '#4ade80',
                amber: '#fbbf24',
                red: '#f87171',
                bgPrimary: 'rgba(168, 85, 247, 0.2)',
                bgSky: 'rgba(56, 189, 248, 0.2)'
            };

            // 1. CATEGORY DISTRIBUTION (Polar Area / Doughnut)
            new Chart(document.getElementById('categoryChart'), {
                type: 'doughnut',
                data: {
                    labels: Object.keys(catData),
                    datasets: [{
                        data: Object.values(catData),
                        backgroundColor: [colors.sky, colors.red, colors.amber, colors.primary],
                        borderColor: '#050505',
                        borderWidth: 2,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 10,
                                borderRadius: 0
                            }
                        },
                        tooltip: tooltipConfig
                    }
                }
            });

            // 2. ANNUAL GROWTH RATE (Bar)
            new Chart(document.getElementById('growthChart'), {
                type: 'bar',
                data: {
                    labels: Object.keys(growData),
                    datasets: [{
                        label: 'Nodes Added',
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
                        y: {
                            grid: gridConfig,
                            beginAtZero: true
                        },
                        x: {
                            grid: {
                                display: false
                            }
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

            // 3. ICON PAYLOAD (Pie)
            new Chart(document.getElementById('iconChart'), {
                type: 'pie',
                data: {
                    labels: Object.keys(iconData),
                    datasets: [{
                        data: Object.values(iconData),
                        backgroundColor: [colors.amber, '#1f2937'],
                        borderColor: '#050505',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 8
                            }
                        },
                        tooltip: tooltipConfig
                    }
                }
            });

            // 4. DESC PAYLOAD (Pie)
            new Chart(document.getElementById('descChart'), {
                type: 'pie',
                data: {
                    labels: Object.keys(descData),
                    datasets: [{
                        data: Object.values(descData),
                        backgroundColor: [colors.green, '#1f2937'],
                        borderColor: '#050505',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.filter-btn');
            const searchInput = document.getElementById('search-input');
            const sortSelect = document.getElementById('sort-select');
            const container = document.getElementById('skills-container');

            let currentCategory = 'all';
            let currentSearch = '';
            let currentSort = 'latest';
            let debounceTimer;

            function fetchSkills(url = null) {
                // Add loading state
                container.style.opacity = '0.5';
                container.style.pointerEvents = 'none';

                const params = new URLSearchParams({
                    category: currentCategory,
                    search: currentSearch,
                    sort: currentSort
                });

                const fetchUrl = url || `{{ route('dashboard.skills.index') }}?${params.toString()}`;

                fetch(fetchUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        container.innerHTML = html;
                        // Restore normal state
                        container.style.opacity = '1';
                        container.style.pointerEvents = 'auto';
                    })
                    .catch(error => {
                        console.error('Error fetching skills:', error);
                        container.style.opacity = '1';
                        container.style.pointerEvents = 'auto';
                    });
            }

            // Tab Clicks (Disesuaikan dengan styling baru)
            tabs.forEach(tab => {
                tab.addEventListener('click', (e) => {
                    tabs.forEach(t => {
                        t.classList.remove('border-primary', 'bg-primary/10',
                            'text-primary');
                        // Khusus untuk tab aktif, kita reset warnanya sesuai datanya
                        if (t.dataset.category === 'frontend') t.classList.remove(
                            'border-sky-400', 'bg-sky-400/10', 'text-sky-400');
                        if (t.dataset.category === 'backend') t.classList.remove(
                            'border-red-400', 'bg-red-400/10', 'text-red-400');
                        if (t.dataset.category === 'tools') t.classList.remove(
                            'border-amber-400', 'bg-amber-400/10', 'text-amber-400');

                        t.classList.add('border-border', 'text-muted');
                    });

                    e.target.classList.remove('border-border', 'text-muted');

                    // Set active color based on category
                    if (e.target.dataset.category === 'all') e.target.classList.add(
                        'border-primary', 'bg-primary/10', 'text-primary');
                    if (e.target.dataset.category === 'frontend') e.target.classList.add(
                        'border-sky-400', 'bg-sky-400/10', 'text-sky-400');
                    if (e.target.dataset.category === 'backend') e.target.classList.add(
                        'border-red-400', 'bg-red-400/10', 'text-red-400');
                    if (e.target.dataset.category === 'tools') e.target.classList.add(
                        'border-amber-400', 'bg-amber-400/10', 'text-amber-400');

                    currentCategory = e.target.dataset.category;
                    fetchSkills();
                });
            });

            // Search Input (Debounced)
            searchInput.addEventListener('input', (e) => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    currentSearch = e.target.value;
                    fetchSkills();
                }, 300); // 300ms delay
            });

            // Sort Dropdown
            sortSelect.addEventListener('change', (e) => {
                currentSort = e.target.value;
                fetchSkills();
            });

            // Event Delegation for Edit, Delete buttons inside the Container and Pagination Links
            container.addEventListener('click', (e) => {
                // Pagination Intercept
                const anchor = e.target.closest('a');
                if (anchor && anchor.href && anchor.href.includes('page=')) {
                    e.preventDefault();
                    const url = new URL(anchor.href, window.location.origin);
                    url.searchParams.set('category', currentCategory);
                    url.searchParams.set('search', currentSearch);
                    url.searchParams.set('sort', currentSort);
                    fetchSkills(url.toString());
                    return;
                }

                // Edit Button Click
                const editBtn = e.target.closest('.edit-skill-btn');
                if (editBtn) {
                    e.preventDefault();
                    const id = editBtn.dataset.id;
                    const name = editBtn.dataset.name;
                    const category = editBtn.dataset.category;
                    const icon = editBtn.dataset.icon;
                    const description = editBtn.dataset.description;
                    if (window.openEditSkillModal) {
                        window.openEditSkillModal(id, name, category, icon, description);
                    }
                    return;
                }

                // Delete Button Click
                const deleteBtn = e.target.closest('.delete-skill-btn');
                if (deleteBtn) {
                    e.preventDefault();
                    const id = deleteBtn.dataset.id;
                    // Gunakan fungsi confirmAction jika kamu sudah memasangnya di layout global
                    if (typeof window.confirmAction === 'function') {
                        window.confirmAction(
                            'CRITICAL: Are you sure you want to purge this skill node? Data cannot be recovered.',
                            () => {
                                const form = document.getElementById('deleteSkillForm');
                                form.action = `/dashboard/skills/${id}`;
                                form.submit();
                            });
                    } else {
                        // Fallback ke modal bawaan jika fungsi global belum tersedia
                        const confirmModal = document.getElementById('confirm-modal');
                        const confirmYes = document.getElementById('confirm-yes');
                        const confirmCancel = document.getElementById('confirm-cancel');
                        const confirmMessage = document.getElementById('confirm-message');

                        if (confirmModal && confirmYes && confirmCancel) {
                            confirmMessage.textContent =
                                'CRITICAL: Are you sure you want to purge this skill node? Data cannot be recovered.';

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
                        }
                    }
                }
            });

        });
    </script>
@endpush
