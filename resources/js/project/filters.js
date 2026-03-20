/* ================================================================
   PROJECT FILTERS — AJAX (no reload)
   Search: debounce 400ms
   Filter buttons: instant
   Pagination: ajax-page links (delegated)
   ================================================================ */

(function () {

    const searchInput = document.getElementById('project-search');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const grid = document.getElementById('projects-grid');
    const paginationWrap = document.getElementById('projects-pagination');

    if (!grid) return; // not on project page

    // ── State ──────────────────────────────────────────────────
    let currentSearch = new URLSearchParams(window.location.search).get('search') ?? '';
    let currentType = new URLSearchParams(window.location.search).get('type') ?? 'all';
    let currentSort = new URLSearchParams(window.location.search).get('sort') ?? 'latest';
    let currentPage = 1;
    let debounceTimer = null;

    // ── Sort dropdown elements
    const sortToggle = document.getElementById('sort-toggle');
    const sortMenu = document.getElementById('sort-menu');
    const sortLabel = document.getElementById('sort-label');
    const sortChevron = document.getElementById('sort-chevron');

    // ── Set initial UI state ───────────────────────────────────
    if (searchInput) searchInput.value = currentSearch;

    filterBtns.forEach(btn => {
        if (btn.dataset.filter === currentType) {
            btn.classList.add('border-primary', 'bg-primary/10', 'text-primary');
        }
    });

    // ── Core AJAX fetch ────────────────────────────────────────
    async function fetchProjects() {
        const params = new URLSearchParams();
        if (currentSearch) params.set('search', currentSearch);
        if (currentType && currentType !== 'all') params.set('type', currentType);
        if (currentSort !== 'latest') params.set('sort', currentSort);
        if (currentPage > 1) params.set('page', currentPage);

        // Loading state
        grid.style.opacity = '0.4';
        grid.style.pointerEvents = 'none';

        try {
            const res = await fetch(`/projects?${params.toString()}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (!res.ok) throw new Error('Network error');

            const data = await res.json();

            // Update DOM
            grid.innerHTML = data.html;
            if (paginationWrap) paginationWrap.innerHTML = data.pagination;

            // Translate newly injected elements (e.g. empty state text)
            if (typeof window.applyI18n === 'function') window.applyI18n(grid);

            // Re-bind modal openers on newly rendered cards
            bindModalOpeners();

            // Re-apply search highlight
            if (currentSearch) highlightText(currentSearch);

            // Sync URL without reload
            const url = new URL(window.location);
            currentSearch ? url.searchParams.set('search', currentSearch)
                : url.searchParams.delete('search');
            currentType !== 'all' ? url.searchParams.set('type', currentType)
                : url.searchParams.delete('type');
            currentSort !== 'latest' ? url.searchParams.set('sort', currentSort)
                : url.searchParams.delete('sort');
            currentPage > 1 ? url.searchParams.set('page', currentPage)
                : url.searchParams.delete('page');
            window.history.replaceState({}, '', url);

        } catch (e) {
            console.warn('AJAX fetch error:', e);
        } finally {
            grid.style.opacity = '1';
            grid.style.pointerEvents = '';
        }
    }

    // ── Search — debounce 400ms ────────────────────────────────
    if (searchInput) {
        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                currentSearch = searchInput.value.trim();
                currentPage = 1;
                fetchProjects();
            }, 400);
        });
    }

    // ── Sort dropdown ──────────────────────────────────────────
    if (sortToggle && sortMenu) {
        // Set initial label
        if (currentSort === 'oldest') {
            if (sortLabel) sortLabel.textContent = 'SORT: OLDEST';
            sortToggle.classList.add('border-primary', 'text-primary');
        } else {
            if (sortLabel) sortLabel.textContent = 'SORT: NEWEST';
            sortToggle.classList.remove('border-primary', 'text-primary');
        }

        // Toggle open/close
        sortToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            sortMenu.classList.toggle('hidden');
            if (sortChevron) sortChevron.classList.toggle('rotate-180');
        });

        // Close when clicking outside
        document.addEventListener('click', () => {
            sortMenu.classList.add('hidden');
            if (sortChevron) sortChevron.classList.remove('rotate-180');
        });

        // Option click
        document.querySelectorAll('.sort-option').forEach(opt => {
            opt.addEventListener('click', (e) => {
                e.stopPropagation();
                currentSort = opt.dataset.sort;
                
                if (currentSort === 'oldest') {
                    if (sortLabel) sortLabel.textContent = 'SORT: OLDEST';
                    sortToggle.classList.add('border-primary', 'text-primary');
                } else {
                    if (sortLabel) sortLabel.textContent = 'SORT: NEWEST';
                    sortToggle.classList.remove('border-primary', 'text-primary');
                }

                sortMenu.classList.add('hidden');
                if (sortChevron) sortChevron.classList.remove('rotate-180');

                currentPage = 1;
                fetchProjects();
            });
        });
    }

    // ── Filter buttons ─────────────────────────────────────────
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b =>
                b.classList.remove('border-primary', 'bg-primary/10', 'text-primary')
            );
            btn.classList.add('border-primary', 'bg-primary/10', 'text-primary');

            currentType = btn.dataset.filter;
            currentPage = 1;
            fetchProjects();
        });
    });

    // ── Reset Button — Delegated Click ─────────────────────────
    grid.addEventListener('click', (e) => {
        const resetBtn = e.target.closest('#reset-filters-btn');
        if (!resetBtn) return;

        // 1. Reset State
        currentSearch = '';
        currentType = 'all';
        currentSort = 'latest';
        currentPage = 1;

        // 2. Reset UI: Search Input
        if (searchInput) searchInput.value = '';

        // 3. Reset UI: Filter Buttons
        filterBtns.forEach(b => {
            b.classList.remove('border-primary', 'bg-primary/10', 'text-primary');
            if (b.dataset.filter === 'all') {
                b.classList.add('border-primary', 'bg-primary/10', 'text-primary');
            }
        });

        // 4. Reset UI: Sort Dropdown
        if (sortLabel && sortToggle) {
            sortLabel.textContent = 'Newest'; // Sesuaikan teks default sort
            sortToggle.classList.remove('border-primary', 'text-primary');
        }

        // 5. Fetch Ulang Data
        fetchProjects();
    });

    // ── Pagination — delegated click on #projects-pagination ───
    if (paginationWrap) {
        paginationWrap.addEventListener('click', e => {
            const link = e.target.closest('.ajax-page');
            if (!link) return;
            e.preventDefault();
            currentPage = parseInt(link.dataset.page, 10);
            fetchProjects();
            // Scroll to top of grid
            grid.closest('section')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    }

    // ── Re-bind detail modal after AJAX ───────────────────────
    function bindModalOpeners() {
        document.querySelectorAll('.project-open').forEach(card => {
            card.addEventListener('click', () => {
                // copy all data attributes to modal
                const modal = document.getElementById('projectDetailModal');
                if (!modal) return;

                modal.dataset.id = card.dataset.id;
                modal.dataset.tech = card.dataset.tech;
                modal.dataset.type = card.dataset.type;
                modal.dataset.status = card.dataset.status;
                modal.dataset.title = card.dataset.title;
                modal.dataset.desc = card.dataset.desc;
                modal.dataset.role = card.dataset.role;
                modal.dataset.team = card.dataset.team;
                modal.dataset.responsibilities = card.dataset.responsibilities;
                modal.dataset.repo = card.dataset.repo;
                modal.dataset.live = card.dataset.live;
                modal.dataset.screenshot = card.dataset.screenshot;

                // Basic text fields
                document.getElementById('detailType').textContent = card.dataset.type;
                document.getElementById('detailStatus').textContent = card.dataset.status;
                document.getElementById('detailTitle').textContent = card.dataset.title;
                document.getElementById('detailDesc').textContent = card.dataset.desc;
                document.getElementById('detailRole').textContent = card.dataset.role || '-';
                document.getElementById('detailTeamSize').textContent = card.dataset.team || '-';
                document.getElementById('detailResponsibilities').textContent = card.dataset.responsibilities || '-';
                document.getElementById('detailCreated').textContent = card.dataset.created;
                document.getElementById('detailUpdated').textContent = card.dataset.updated;

                // Tech stack
                const techContainer = document.getElementById('detailTech');
                techContainer.innerHTML = '';
                if (card.dataset.tech) {
                    try {
                        JSON.parse(card.dataset.tech).forEach(t => {
                            techContainer.innerHTML += `<span class="px-2 py-1 text-xs border border-border">${t}</span>`;
                        });
                    } catch { techContainer.innerHTML = '-'; }
                }

                // Screenshots
                const screenshotContainer = document.getElementById('detailScreenshots');
                const wrapper = document.getElementById('detailScreenshotsWrapper');
                screenshotContainer.innerHTML = '';

                if (card.dataset.screenshot) {
                    try {
                        const images = JSON.parse(card.dataset.screenshot);
                        if (images.length > 0) {
                            images.forEach(img => {
                                const imgSrc = typeof img === 'object' && img !== null ? img.url : img;
                                screenshotContainer.innerHTML += `
                                    <div class="aspect-video overflow-hidden border border-border/50 bg-surface/40 group">
                                        <img src="${imgSrc}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105 cursor-pointer">
                                    </div>`;
                            });
                            wrapper.classList.remove('hidden');
                        } else {
                            wrapper.classList.add('hidden');
                        }
                    } catch { wrapper.classList.add('hidden'); }
                } else {
                    wrapper.classList.add('hidden');
                }

                // Links
                const live = document.getElementById('detailLive');
                const repo = document.getElementById('detailRepo');
                card.dataset.live ? (live.href = card.dataset.live, live.classList.remove('hidden'))
                    : live.classList.add('hidden');
                card.dataset.repo ? (repo.href = card.dataset.repo, repo.classList.remove('hidden'))
                    : repo.classList.add('hidden');

                window.openProjectModal();
                document.body.classList.add('overflow-hidden');
            });
        });
    }

    // bind on initial page load
    bindModalOpeners();

})();


// ── Helpers ──────────────────────────────────────────────────────
function highlightText(keyword) {
    const safeKeyword = keyword.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    const regex = new RegExp(`(${safeKeyword})`, 'gi');

    document.querySelectorAll('.project-folder h3, .project-folder p, .tech-row span')
        .forEach(el => {
            if (el.children.length > 0) return;
            const orig = el.textContent;
            if (regex.test(orig)) {
                el.innerHTML = orig.replace(regex, '<span class="search-highlight">$1</span>');
            }
        });

    document.querySelectorAll('.tech-tooltip').forEach(tooltip => {
        const orig = tooltip.innerHTML;
        if (regex.test(tooltip.textContent)) {
            tooltip.innerHTML = orig.replace(regex, '<span class="search-highlight">$1</span>');
            tooltip.style.opacity = '1';
            tooltip.style.visibility = 'visible';
            tooltip.closest('.tech-more')?.classList.add('tech-match');
        }
    });
}