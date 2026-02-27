@extends('layouts.dashboard')

@section('title', 'Manage Skills')

@section('content')
@vite(['resources/js/skill-tree.js'])
<section class="py-20 max-w-6xl mx-auto px-6 space-y-16">
    <header class="space-y-6 max-w-6xl">
        <p class="text-xs uppercase tracking-widest text-muted">
            dashboard / skills
        </p>

        <h1 class="text-[clamp(2.5rem,6vw,4rem)] font-semibold leading-tight">
            Skills Management
            <span class="block text-muted font-normal text-lg mt-2">
                Tech Stack · Mastery · Interactive Tree
            </span>
        </h1>

        <div class="flex items-center justify-between w-full gap-4">

            <div class="relative w-full md:w-1/3">
                <div class="relative w-full">
                    <input type="text" id="search-input" placeholder="Search skills..." 
                           class="w-full border border-border px-4 py-2 pl-10 text-sm placeholder:text-muted bg-surface focus:outline-none focus:ring-1 focus:ring-primary transition-colors">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-muted">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-2 ml-auto">
                <button type="button" onclick="window.openCreateSkillModal()"
                   class="px-4 py-2 border border-border text-sm hover:border-primary transition focus:outline-none focus:ring-1 focus:ring-primary">
                    + Add Skill
                </button>
            </div>

        </div>
    </header>

    <!-- Interactive Full Skill Tree Preview -->
    <div class="bg-surface border border-border p-6 relative overflow-hidden" style="height: 600px;">
        <h2 class="text-lg font-bold mb-4 absolute top-6 left-6 z-20">Full Tree Preview</h2>
        @php
            $treeSkills = \App\Models\Skill::withCount('projects')->get();
        @endphp
        <div id="skill-tree-container" 
             class="w-full h-full relative"
             data-skills="{{ json_encode($treeSkills) }}">
            <!-- Lines layer -->
            <svg id="skill-tree-lines" class="absolute inset-0 w-full h-full pointer-events-none" style="z-index: 0;"></svg>
            <!-- Nodes will be injected by JS -->
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid md:grid-cols-4 gap-6">

        <div class="border border-border bg-surface p-6">
            <p class="text-xs uppercase tracking-widest text-muted mb-2">
                Total Skills
            </p>
            <h3 class="text-3xl font-semibold">
                {{ $summary['totalSkills'] }}
            </h3>
        </div>

        <div class="border border-border bg-surface p-6">
            <p class="text-xs uppercase tracking-widest text-muted mb-2">
                Frontend
            </p>
            <h3 class="text-3xl font-semibold text-sky-400">
                {{ $summary['frontendCount'] }}
            </h3>
        </div>

        <div class="border border-border bg-surface p-6">
            <p class="text-xs uppercase tracking-widest text-muted mb-2">
                Backend
            </p>
            <h3 class="text-3xl font-semibold text-red-400">
                {{ $summary['backendCount'] }}
            </h3>
        </div>

        <div class="border border-border bg-surface p-6">
            <p class="text-xs uppercase tracking-widest text-muted mb-2">
                Tools & Core
            </p>
            <h3 class="text-3xl font-semibold text-yellow-400">
                {{ $summary['toolsCount'] + $summary['otherCount'] }}
            </h3>
        </div>

    </div>



    <!-- Toolbar & Tag Cloud -->
    <div class="bg-surface border border-border p-6 space-y-6">
        
        <!-- Toolbar -->
        <div class="flex flex-wrap justify-between items-center gap-4">
            
            <div class="flex flex-wrap gap-2">
                <button type="button" class="filter-btn px-4 py-2 border border-primary bg-primary/10 text-primary text-sm transition focus:outline-none" data-category="all">
                    All
                </button>
                <button type="button" class="filter-btn px-4 py-2 border border-border text-sm hover:border-primary transition focus:outline-none" data-category="frontend">
                    Frontend
                </button>
                <button type="button" class="filter-btn px-4 py-2 border border-border text-sm hover:border-primary transition focus:outline-none" data-category="backend">
                    Backend
                </button>
                <button type="button" class="filter-btn px-4 py-2 border border-border text-sm hover:border-primary transition focus:outline-none" data-category="tools">
                    Tools & Core
                </button>
            </div>

            <div class="flex items-center gap-2">
                <select id="sort-select" class="border border-border px-4 py-2 text-sm bg-surface focus:outline-none focus:ring-1 focus:ring-primary transition-colors">
                    <option value="latest">Latest Added</option>
                    <option value="most_projects">Most Projects</option>
                    <option value="least_projects">Least Projects</option>
                    <option value="az">A-Z</option>
                    <option value="za">Z-A</option>
                </select>
            </div>
        </div>

        <!-- Tags Grid Container -->
        <div id="skills-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @include('dashboard.skills.partials.tags')
        </div>
        
    </div>

</section>

<x-skill.create-modal />
<x-skill.edit-modal />

<form id="deleteSkillForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.filter-btn');
    const searchInput = document.getElementById('search-input');
    const sortSelect = document.getElementById('sort-select');
    const grid = document.getElementById('skills-grid');

    let currentCategory = 'all';
    let currentSearch = '';
    let currentSort = 'latest';
    let debounceTimer;

    function fetchSkills() {
        // Add loading state
        grid.style.opacity = '0.5';
        grid.style.pointerEvents = 'none';

        const params = new URLSearchParams({
            category: currentCategory,
            search: currentSearch,
            sort: currentSort
        });

        fetch(`{{ route('dashboard.skills.index') }}?${params.toString()}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            grid.innerHTML = html;
            // Restore normal state
            grid.style.opacity = '1';
            grid.style.pointerEvents = 'auto';
        })
        .catch(error => {
            console.error('Error fetching skills:', error);
            grid.style.opacity = '1';
            grid.style.pointerEvents = 'auto';
        });
    }

    // Tab Clicks
    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            tabs.forEach(t => {
                t.classList.remove('border-primary', 'bg-primary/10', 'text-primary');
                t.classList.add('border-border');
            });
            e.target.classList.remove('border-border');
            e.target.classList.add('border-primary', 'bg-primary/10', 'text-primary');

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

    // Event Delegation for Edit & Delete buttons inside the Grid
    grid.addEventListener('click', (e) => {
        // Edit Button Click
        const editBtn = e.target.closest('.edit-skill-btn');
        if (editBtn) {
            e.preventDefault();
            const id = editBtn.dataset.id;
            const name = editBtn.dataset.name;
            const category = editBtn.dataset.category;
            const icon = editBtn.dataset.icon;
            if(window.openEditSkillModal) {
                window.openEditSkillModal(id, name, category, icon);
            }
            return;
        }

        // Delete Button Click
        const deleteBtn = e.target.closest('.delete-skill-btn');
        if (deleteBtn) {
            e.preventDefault();
            const id = deleteBtn.dataset.id;
            const confirmModal = document.getElementById('confirm-modal');
            const confirmYes = document.getElementById('confirm-yes');
            const confirmCancel = document.getElementById('confirm-cancel');
            const confirmMessage = document.getElementById('confirm-message');
            
            if (confirmModal && confirmYes && confirmCancel) {
                confirmMessage.textContent = 'Are you sure you want to delete this skill? This action cannot be undone.';
                
                // Show modal
                confirmModal.classList.remove('opacity-0', 'pointer-events-none');
                
                // Define the listener variable so we can remove it later
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
                    confirmYes.removeEventListener('click', handleYes);
                    confirmCancel.removeEventListener('click', handleCancel);
                };

                // Attach events
                confirmYes.addEventListener('click', handleYes);
                confirmCancel.addEventListener('click', handleCancel);
            }
        }
    });

});
</script>
@endsection
