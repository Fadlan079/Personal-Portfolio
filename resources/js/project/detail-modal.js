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
        detailModal.dataset.tech = card.dataset.tech;
        detailModal.dataset.type = card.dataset.type;
        detailModal.dataset.status = card.dataset.status;
        detailModal.dataset.visibility = card.dataset.visibility;
        detailModal.dataset.title = card.dataset.title;
        detailModal.dataset.desc = card.dataset.desc;
        detailModal.dataset.role = card.dataset.role;
        detailModal.dataset.team = card.dataset.team;
        detailModal.dataset.responsibilities = card.dataset.responsibilities;
        detailModal.dataset.repo = card.dataset.repo;
        detailModal.dataset.live = card.dataset.live;
        detailModal.dataset.screenshot = card.dataset.screenshot;
        detailModal.dataset.achievements = card.dataset.achievements;

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
                        const imgSrc = typeof img === 'object' && img !== null ? img.url : img;
                        screenshotContainer.innerHTML += `
                        <div class="aspect-video overflow-hidden border border-border/50 bg-surface/40 group">
                            <img src="${imgSrc}"
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

        // ===== Achievements =====
        const achWrapper = document.getElementById('detailAchievementsWrapper');
        const achContainer = document.getElementById('detailAchievements');

        if (achWrapper && achContainer) {
            achContainer.innerHTML = '';
            if (card.dataset.achievements) {
                try {
                    const achievements = JSON.parse(card.dataset.achievements);
                    if (achievements.length > 0) {
                        achievements.forEach(ach => {
                            const imgSrc = ach.image_url ? `/storage/${ach.image_url}` : '';
                            if (!imgSrc) return;

                            achContainer.innerHTML += `
                                <div class="aspect-video overflow-hidden border border-border/50 bg-surface/40 group relative">
                                    <img src="${imgSrc}"
                                        class="w-full h-full object-cover transition duration-500 group-hover:scale-105 cursor-pointer">
                                </div>
                            `;
                        });
                        achWrapper.classList.remove('hidden');
                    } else {
                        achWrapper.classList.add('hidden');
                    }
                } catch {
                    achWrapper.classList.add('hidden');
                }
            } else {
                achWrapper.classList.add('hidden');
            }
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

        // Fetch Likes & Comments
        if (typeof window.fetchInteractions === 'function') {
            window.fetchInteractions(card.dataset.id);
        }
    });

});


/* =========================
   LIGHTBOX TRIGGER
========================= */

screenshotContainer?.addEventListener('click', (e) => {
    if (e.target.tagName === "IMG") {
        window.openLightbox(e.target.src, '#detailScreenshots img');
    }
});

document.getElementById('detailAchievements')?.addEventListener('click', (e) => {
    if (e.target.tagName === "IMG") {
        window.openLightbox(e.target.src, '#detailAchievements img');
    }
});

lightboxClose?.addEventListener('click', () => {
    window.closeLightbox();
});

const deleteBtn = document.getElementById('detailDeleteBtn');
const deleteForm = document.getElementById('deleteProjectForm');

if (deleteBtn) {
    deleteBtn.addEventListener('click', async () => {

        const projectId = detailModal.dataset.id;
        if (!projectId) return;

        const confirmed = await showConfirm(
            'Yakin mau hapus project ini?'
        );

        if (!confirmed) return;

        deleteForm.action = `/dashboard/projects/${projectId}`;
        deleteForm.submit();
    });
}

/* =========================
   LIKES & COMMENTS LOGIC
========================= */

const btnLikeProject = document.getElementById('btnLikeProject');
const btnCommentProject = document.getElementById('btnCommentProject');
const likeIcon = document.getElementById('likeIcon');
const likeCount = document.getElementById('likeCount');
const commentCount = document.getElementById('commentCount');
const commentsOverlay = document.getElementById('commentsOverlay');
const closeCommentsBtn = document.getElementById('closeCommentsBtn');
const commentsList = document.getElementById('commentsList');
const commentForm = document.getElementById('commentForm');
const commentInput = document.getElementById('commentInput');
const replyToText = document.getElementById('replyToText');
const replyToName = document.getElementById('replyToName');
const cancelReplyBtn = document.getElementById('cancelReplyBtn');

let currentComments = [];
let replyToId = null;

window.fetchInteractions = async function(projectId) {
    if(!btnLikeProject || !btnCommentProject) return;

    btnLikeProject.disabled = true;
    btnCommentProject.disabled = true;
    btnLikeProject.classList.add('opacity-50', 'cursor-default');
    btnCommentProject.classList.add('opacity-50', 'cursor-default');
    likeCount.textContent = '...';
    commentCount.textContent = '...';

    try {
        const res = await fetch(`/projects/${projectId}/interactions`);
        if (!res.ok) throw new Error('Network error');
        const data = await res.json();

        likeCount.textContent = data.likes_count;
        commentCount.textContent = data.comments_count;

        if (data.user_liked) {
            likeIcon.classList.replace('fa-regular', 'fa-solid');
            likeIcon.classList.add('text-red-500');
        } else {
            likeIcon.classList.replace('fa-solid', 'fa-regular');
            likeIcon.classList.remove('text-red-500');
        }

        btnLikeProject.disabled = false;
        btnCommentProject.disabled = false;
        btnLikeProject.classList.remove('opacity-50', 'cursor-default');
        btnCommentProject.classList.remove('opacity-50', 'cursor-default');

        currentComments = data.comments;
        renderComments();
    } catch (err) {
        console.error(err);
        likeCount.textContent = '0';
        commentCount.textContent = '0';
    }
};

function renderComments() {
    if (!commentsList) return;
    commentsList.innerHTML = '';

    if (currentComments.length === 0) {
        commentsList.innerHTML = '<p class="text-stone-400 font-diary-body text-center mt-10">Belum ada komentar.</p>';
        return;
    }

    currentComments.forEach(c => {
        const commentHTML = `
            <div class="flex gap-4">
                <img src="${c.user.profile_photo_url}" class="w-10 h-10 rounded-full object-cover shrink-0 border border-stone-300">
                <div class="flex-1 space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="font-bold font-diary-body text-sm text-stone-800">${c.user.name}</span>
                        ${c.user.role === 'admin' ? `
                            <span class="px-2 py-0.5 bg-gradient-to-tr from-stone-900 to-stone-700 text-amber-200 text-[8px] font-black rounded-full border border-amber-500/30 uppercase tracking-[0.15em] shadow-sm">
                                Creator
                            </span>
                        ` : ''}
                        <span class="text-xs text-stone-400 font-diary-body">${c.created_at}</span>
                    </div>
                    <p class="font-diary-body text-sm text-stone-600 leading-relaxed">${c.content}</p>
                    <button class="text-xs font-bold text-stone-400 hover:text-stone-800 transition-colors btn-reply" data-id="${c.id}" data-name="${c.user.name}">Balas</button>

                    ${c.replies.length > 0 ? `
                        <div class="mt-4 space-y-4 border-l-2 border-stone-200 pl-4">
                            ${c.replies.map(r => `
                                <div class="flex gap-3">
                                    <img src="${r.user.profile_photo_url}" class="w-8 h-8 rounded-full object-cover shrink-0 border border-stone-300">
                                    <div class="flex-1 space-y-0.5">
                                        <div class="flex flex-wrap items-center gap-1.5 mb-0.5">
                                            <span class="font-bold font-diary-body text-xs text-stone-800">${r.user.name}</span>
                                            ${r.user.role === 'admin' ? '<span class="px-1.5 py-px bg-stone-800 text-[#FCFAEF] text-[8px] font-bold rounded-sm uppercase tracking-wide">Creator</span>' : ''}
                                            <i class="fa-solid fa-play text-[8px] mx-0.5 text-stone-300"></i>
                                            <span class="font-bold font-diary-body text-[11px] text-stone-500">${c.user.name}</span>
                                            <span class="text-[10px] text-stone-400 font-diary-body ml-auto">${r.created_at}</span>
                                        </div>
                                        <p class="font-diary-body text-sm text-stone-600 leading-relaxed">${r.content}</p>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    ` : ''}
                </div>
            </div>
        `;
        commentsList.insertAdjacentHTML('beforeend', commentHTML);
    });

    document.querySelectorAll('.btn-reply').forEach(btn => {
        btn.addEventListener('click', (e) => {
            replyToId = btn.dataset.id;
            replyToName.textContent = btn.dataset.name;
            replyToText.classList.remove('hidden');
            if(commentInput) {
                commentInput.focus();
            } else {
                alert("Silakan login untuk membalas komentar.");
            }
        });
    });
}

if(cancelReplyBtn) {
    cancelReplyBtn.addEventListener('click', () => {
        replyToId = null;
        replyToText.classList.add('hidden');
    });
}

if(btnLikeProject) {
    btnLikeProject.addEventListener('click', async () => {
        const projectId = detailModal.dataset.id;
        if (!projectId) return;

        let isLiked = likeIcon.classList.contains('fa-solid');
        let currentCount = parseInt(likeCount.textContent) || 0;

        if (isLiked) {
            likeIcon.classList.replace('fa-solid', 'fa-regular');
            likeIcon.classList.remove('text-red-500');
            likeCount.textContent = currentCount - 1;
        } else {
            likeIcon.classList.replace('fa-regular', 'fa-solid');
            likeIcon.classList.add('text-red-500');
            likeCount.textContent = currentCount + 1;
        }
        btnLikeProject.classList.add('pointer-events-none');

        try {
            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            if (!csrfTokenMeta) {
                alert("CSRF token not found. Please log in.");
                throw new Error("Missing CSRF Token");
            }
            const res = await fetch(`/projects/${projectId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfTokenMeta.content,
                    'Accept': 'application/json'
                }
            });

            if (res.status === 401 || res.status === 403) {
                alert("Silakan login untuk menyukai project.");
                throw new Error("Unauthorized");
            }

            if (!res.ok) throw new Error("Failed");

            const data = await res.json();
            likeCount.textContent = data.count;
            if (data.liked) {
                likeIcon.classList.replace('fa-regular', 'fa-solid');
                likeIcon.classList.add('text-red-500');
            } else {
                likeIcon.classList.replace('fa-solid', 'fa-regular');
                likeIcon.classList.remove('text-red-500');
            }
        } catch (err) {
            if (isLiked) {
                likeIcon.classList.replace('fa-regular', 'fa-solid');
                likeIcon.classList.add('text-red-500');
                likeCount.textContent = currentCount;
            } else {
                likeIcon.classList.replace('fa-solid', 'fa-regular');
                likeIcon.classList.remove('text-red-500');
                likeCount.textContent = currentCount;
            }
        } finally {
            btnLikeProject.classList.remove('pointer-events-none');
        }
    });
}

if(btnCommentProject) {
    btnCommentProject.addEventListener('click', () => {
        commentsOverlay.classList.remove('translate-y-full');
    });
}

if(closeCommentsBtn) {
    closeCommentsBtn.addEventListener('click', () => {
        commentsOverlay.classList.add('translate-y-full');
        replyToId = null;
        if(replyToText) replyToText.classList.add('hidden');
    });
}

if(commentForm) {
    commentForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const projectId = detailModal.dataset.id;
        const content = commentInput.value.trim();
        if (!content || !projectId) return;

        const submitBtn = commentForm.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i>';

        try {
            const url = replyToId
                ? `/projects/${projectId}/reply`
                : `/projects/${projectId}/comment`;

            const body = replyToId
                ? { content, parent_id: replyToId }
                : { content };

            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(body)
            });

            if (res.status === 401 || res.status === 403) {
                alert("Silakan login untuk berkomentar.");
                throw new Error("Unauthorized");
            }

            if (!res.ok) throw new Error("Failed");

            const data = await res.json();

            if (data.success) {
                commentInput.value = '';
                replyToId = null;
                replyToText.classList.add('hidden');

                await window.fetchInteractions(projectId);
            }
        } catch (err) {
            console.error(err);
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Kirim';
        }
    });
}

/* =========================
   DETAIL MODAL CLOSE RESET
========================= */
const modalClose = document.getElementById('detailModalClose');
if (modalClose) {
    modalClose.addEventListener('click', () => {
        commentsOverlay?.classList.add('translate-y-full');
    });
}
