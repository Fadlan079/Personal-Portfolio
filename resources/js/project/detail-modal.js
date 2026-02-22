/* =========================
   ELEMENT SELECTOR
========================= */

const detailModal = document.getElementById('projectDetailModal');
const screenshotContainer = document.getElementById('detailScreenshots');
const lightboxClose = document.getElementById('lightboxClose');


/* =========================
   OPEN DETAIL MODAL
========================= */

document.querySelectorAll('.project-open').forEach(card => {

    card.addEventListener('click', () => {
        detailModal.dataset.id = card.dataset.id;
        // ===== Basic Info =====
        document.getElementById('detailType').textContent = card.dataset.type;
        document.getElementById('detailStatus').textContent = card.dataset.status;
        document.getElementById('detailTitle').textContent = card.dataset.title;
        document.getElementById('detailDesc').textContent = card.dataset.desc;
        document.getElementById('detailRole').textContent = card.dataset.role || '-';
        document.getElementById('detailTeamSize').textContent = card.dataset.team || '-';
        document.getElementById('detailResponsibilities').textContent =
            card.dataset.responsibilities || '-';
        document.getElementById('detailCreated').textContent = card.dataset.created;
        document.getElementById('detailUpdated').textContent = card.dataset.updated;

        // ===== Tech Stack =====
        const techContainer = document.getElementById('detailTech');
        techContainer.innerHTML = '';

        if (card.dataset.tech) {
            try {
                const techs = JSON.parse(card.dataset.tech);
                techs.forEach(t => {
                    techContainer.innerHTML += `
                        <span class="px-2 py-1 text-xs border border-border">
                            ${t}
                        </span>
                    `;
                });
            } catch {
                techContainer.innerHTML = '-';
            }
        }

        // ===== Screenshots =====
        const wrapper = document.getElementById('detailScreenshotsWrapper');
        screenshotContainer.innerHTML = '';

        if (card.dataset.screenshot) {
            try {
                const images = JSON.parse(card.dataset.screenshot);

                if (images.length > 0) {

                    images.forEach(img => {
                        screenshotContainer.innerHTML += `
                        <div class="aspect-video overflow-hidden border border-border/50 bg-surface/40 group">
                            <img src="${img}"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-105 cursor-pointer">
                        </div>
                        `;
                    });

                    wrapper.classList.remove('hidden');

                } else {
                    wrapper.classList.add('hidden');
                }

            } catch {
                wrapper.classList.add('hidden');
            }
        } else {
            wrapper.classList.add('hidden');
        }

        // ===== Links =====
        const live = document.getElementById('detailLive');
        const repo = document.getElementById('detailRepo');

        card.dataset.live
            ? (live.href = card.dataset.live, live.classList.remove('hidden'))
            : live.classList.add('hidden');

        card.dataset.repo
            ? (repo.href = card.dataset.repo, repo.classList.remove('hidden'))
            : repo.classList.add('hidden');

        // ===== OPEN MODAL =====
        window.openProjectModal();
        document.body.classList.add('overflow-hidden');
    });

});


/* =========================
   LIGHTBOX TRIGGER
========================= */

screenshotContainer?.addEventListener('click', (e) => {
    if (e.target.tagName === "IMG") {
        window.openLightbox(e.target.src);
    }
});

lightboxClose?.addEventListener('click', () => {
    window.closeLightbox();
});

const deleteBtn = document.getElementById('detailDeleteBtn');
const deleteForm = document.getElementById('deleteProjectForm');

if (deleteBtn) {
    deleteBtn.addEventListener('click', () => {

        const projectId = detailModal.dataset.id;

        if (!projectId) return;

        if (confirm('Yakin mau hapus project ini?')) {

            deleteForm.action = `/dashboard/projects/${projectId}`;
            deleteForm.submit();
        }
    });
}
