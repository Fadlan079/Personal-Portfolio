import { gsap } from "gsap";

export function projectModalAnimation() {

    /* =====================================================
       PROJECT DETAIL MODAL (SUDAH ADA PUNYA LU)
    ===================================================== */

    const detailModal = document.getElementById('projectDetailModal');
    const lightbox = document.getElementById('imageLightbox');
    const lightboxImg = document.getElementById('lightboxImage');

    if (detailModal) {

        const modalBox = detailModal.querySelector('.relative');
        const detailCloseBtn = document.getElementById('detailModalClose');

        window.openProjectModal = function () {

            detailModal.classList.remove('hidden');
            detailModal.style.display = 'flex';
            document.body.classList.add('overflow-hidden');

            gsap.set(modalBox, { y: 40, scale: 0.96, opacity: 0 });
            gsap.set(detailModal, { opacity: 0 });

            gsap.timeline()
                .to(detailModal, {
                    opacity: 1,
                    duration: 0.25,
                    ease: "power2.out"
                })
                .to(modalBox, {
                    y: 0,
                    scale: 1,
                    opacity: 1,
                    duration: 0.45,
                    ease: "power3.out"
                }, "-=0.1");
        };

        const detailEditBtn = document.getElementById('detailEditBtn');


        detailEditBtn?.addEventListener('click', () => {

            const d = detailModal.dataset;

            const project = {
                id: d.id,
                tech: d.tech,
                type: d.type,
                status: d.status,
                visibility: d.visibility,
                published: d.published !== 'undefined' ? d.published : '',
                title: d.title,
                desc: d.desc,
                role: d.role !== 'undefined' ? d.role : '',
                team_size: d.team !== 'undefined' ? d.team : '',
                responsibilities: d.responsibilities !== 'undefined' ? d.responsibilities : '',
                repo: d.repo !== 'undefined' ? d.repo : '',
                live: d.live !== 'undefined' ? d.live : '',
                screenshot: d.screenshot,
                image_desktop: d.imageDesktop !== 'undefined' ? d.imageDesktop : '',
                image_tablet: d.imageTablet !== 'undefined' ? d.imageTablet : '',
                image_mobile: d.imageMobile !== 'undefined' ? d.imageMobile : ''
            };

            window.openEditModal(project);
            window.closeProjectModal();
        });


        window.closeProjectModal = function () {

            gsap.timeline({
                onComplete: () => {
                    detailModal.classList.add('hidden');
                    detailModal.style.display = '';
                    document.body.classList.remove('overflow-hidden');
                }
            })
                .to(modalBox, {
                    y: 30,
                    scale: 0.97,
                    opacity: 0,
                    duration: 0.35,
                    ease: "power3.in"
                })
                .to(detailModal, {
                    opacity: 0,
                    duration: 0.2,
                    ease: "power2.in"
                }, "-=0.2");
        };

        // tombol X
        detailCloseBtn?.addEventListener('click', window.closeProjectModal);

        // klik luar modal
        detailModal.addEventListener('click', (e) => {
            if (e.target === detailModal) {
                window.closeProjectModal();
            }
        });
    }


    /* =====================================================
       CREATE PROJECT MODAL (BARU)
    ===================================================== */

    const createModal = document.getElementById('createProjectModal');
    const openCreateBtns = document.querySelectorAll('.open-create-modal');
    const closeCreateBtn = document.getElementById('closeCreateModal');
    const cancelCreateBtn = document.getElementById('cancelCreateModal');

    if (createModal) {

        const createBox = createModal.querySelector('.relative');

        window.openCreateModal = function () {

            createModal.classList.remove('hidden');
            createModal.style.display = 'flex';
            document.body.classList.add('overflow-hidden');

            gsap.set(createBox, { y: 40, scale: 0.95, opacity: 0 });
            gsap.set(createModal, { opacity: 0 });

            gsap.timeline()
                .to(createModal, {
                    opacity: 1,
                    duration: 0.25,
                    ease: "power2.out"
                })
                .to(createBox, {
                    y: 0,
                    scale: 1,
                    opacity: 1,
                    duration: 0.45,
                    ease: "power3.out"
                }, "-=0.1");
        };

        window.closeCreateModal = function () {

            gsap.timeline({
                onComplete: () => {
                    createModal.classList.add('hidden');
                    createModal.style.display = '';
                    document.body.classList.remove('overflow-hidden');
                }
            })
                .to(createBox, {
                    y: 30,
                    scale: 0.96,
                    opacity: 0,
                    duration: 0.35,
                    ease: "power3.in"
                })
                .to(createModal, {
                    opacity: 0,
                    duration: 0.2,
                    ease: "power2.in"
                }, "-=0.2");
        };

        // BUTTON EVENTS
        openCreateBtns.forEach(btn => {
            btn.addEventListener('click', window.openCreateModal);
        });
        closeCreateBtn?.addEventListener('click', window.closeCreateModal);
        cancelCreateBtn?.addEventListener('click', window.closeCreateModal);

        // CLICK OUTSIDE CLOSE
        createModal.addEventListener('click', (e) => {
            if (e.target === createModal) {
                window.closeCreateModal();
            }
        });
    }


    /* =====================================================
       LIGHTBOX (SUDAH ADA PUNYA LU)
    ===================================================== */

    if (lightbox) {

        const lightboxPrev = document.getElementById('lightboxPrev');
        const lightboxNext = document.getElementById('lightboxNext');
        let currentImages = [];
        let currentIndex = 0;

        window.openLightbox = function (src) {

            // Find all images currently in the detail modal to create the gallery
            const imgs = Array.from(document.querySelectorAll('#detailScreenshots img'));
            currentImages = imgs.map(img => img.src);
            
            // Find index of clicked image
            currentIndex = currentImages.indexOf(src);
            if (currentIndex === -1) {
                currentImages = [src];
                currentIndex = 0;
            }

            lightboxImg.src = src;

            lightbox.classList.remove('hidden');
            lightbox.style.display = 'flex';

            detailModal.style.pointerEvents = "none";

            // Show/hide arrows based on if there's more than 1 image
            if (currentImages.length > 1) {
                lightboxPrev?.classList.remove('hidden');
                lightboxNext?.classList.remove('hidden');
            } else {
                lightboxPrev?.classList.add('hidden');
                lightboxNext?.classList.add('hidden');
            }

            gsap.set(lightbox, { opacity: 0 });
            gsap.set(lightboxImg, { scale: 0.9, opacity: 0, y: 30 });

            gsap.timeline()
                .to(lightbox, {
                    opacity: 1,
                    duration: 0.25,
                    ease: "power2.out"
                })
                .to(lightboxImg, {
                    scale: 1,
                    opacity: 1,
                    y: 0,
                    duration: 0.4,
                    ease: "power3.out"
                }, "-=0.1");
        };

        window.closeLightbox = function () {

            gsap.timeline({
                onComplete: () => {
                    lightbox.classList.add('hidden');
                    lightbox.style.display = '';
                    detailModal.style.pointerEvents = "auto";
                }
            })
                .to(lightboxImg, {
                    scale: 0.92,
                    opacity: 0,
                    y: 20,
                    duration: 0.3,
                    ease: "power3.in"
                })
                .to(lightbox, {
                    opacity: 0,
                    duration: 0.2,
                    ease: "power2.in"
                }, "-=0.15");
        };

        const navigateLightbox = (direction) => {
            if (currentImages.length <= 1) return;
            
            if (direction === 'next') {
                currentIndex = (currentIndex + 1) % currentImages.length;
            } else {
                currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
            }
            
            const nextSrc = currentImages[currentIndex];
            
            gsap.to(lightboxImg, {
                opacity: 0,
                scale: 0.98,
                duration: 0.15,
                onComplete: () => {
                    lightboxImg.src = nextSrc;
                    gsap.to(lightboxImg, {
                        opacity: 1,
                        scale: 1,
                        duration: 0.2
                    });
                }
            });
        };

        lightboxPrev?.addEventListener('click', (e) => {
            e.stopPropagation();
            navigateLightbox('prev');
        });

        lightboxNext?.addEventListener('click', (e) => {
            e.stopPropagation();
            navigateLightbox('next');
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!lightbox.classList.contains('hidden')) {
                if (e.key === 'ArrowRight') navigateLightbox('next');
                if (e.key === 'ArrowLeft') navigateLightbox('prev');
            }
        });
    }
}

/* =====================================================
   EDIT PROJECT MODAL (ANIMATED)
===================================================== */

const editModal = document.getElementById('projectEditModal');

if (editModal) {

    const editBox = editModal.querySelector('.relative');
    const editCloseBtn = document.getElementById('editModalClose');
    const cancelEditBtn = document.getElementById('cancelEdit');

        window.openEditModal = function (project) {

        window.currentEditTech = project.tech;

        setTimeout(() => {
            const techEl = document.getElementById('techStackEditRegion');
            if (techEl && techEl._x_dataStack) {
                try {
                    techEl._x_dataStack[0].tags = JSON.parse(project.tech);
                } catch (e) {
                    techEl._x_dataStack[0].tags = [];
                }
            }
            
            const imgEl = document.getElementById('imageUploadEditRegion');
            if (imgEl && imgEl._x_dataStack && project.screenshot) {
                try {
                    const images = JSON.parse(project.screenshot);
                    imgEl._x_dataStack[0].existingImages = images;
                    imgEl._x_dataStack[0].newImages = [];
                    imgEl._x_dataStack[0].deletedImages = [];
                } catch (e) {
                    imgEl._x_dataStack[0].existingImages = [];
                }
            }
        }, 50);

        const editForm = document.getElementById('editForm');

        // SET FORM ACTION
        editForm.action = `/dashboard/projects/${project.id}`;

        // FILL DATA
        document.getElementById('editId').value = project.id;
        document.getElementById('editType').value = project.type || 'Website';
        document.getElementById('editStatus').value = project.status || 'Shipped';
        
        const visibilityEl = document.getElementById('editVisibility');
        visibilityEl.value = project.visibility || 'draft';
        visibilityEl.dispatchEvent(new Event('change')); // Trigger alpine change
        
        const publishedEl = document.getElementById('editPublishedAt');
        if (publishedEl) {
            publishedEl.value = project.published || '';
        }

        document.getElementById('editTitle').value = project.title || '';
        document.getElementById('editDesc').value = project.desc || '';
        document.getElementById('editRepo').value = project.repo || '';
        document.getElementById('editLive').value = project.live || '';

        document.getElementById('editRole').value = project.role || '';
        document.getElementById('editTeamSize').value = project.team_size || '';
        document.getElementById('editResponsibilities').value = project.responsibilities || '';
        
        // DEVICES PREVIEW
        const deskWrapper = document.getElementById('previewDesktopWrapper');
        const deskImg = document.getElementById('previewDesktop');
        if (project.image_desktop) {
            deskImg.src = project.image_desktop;
            deskWrapper.classList.remove('hidden');
        } else {
            deskWrapper.classList.add('hidden');
            deskImg.src = '';
        }

        const tabWrapper = document.getElementById('previewTabletWrapper');
        const tabImg = document.getElementById('previewTablet');
        if (project.image_tablet) {
            tabImg.src = project.image_tablet;
            tabWrapper.classList.remove('hidden');
        } else {
            tabWrapper.classList.add('hidden');
            tabImg.src = '';
        }

        const mobWrapper = document.getElementById('previewMobileWrapper');
        const mobImg = document.getElementById('previewMobile');
        if (project.image_mobile) {
            mobImg.src = project.image_mobile;
            mobWrapper.classList.remove('hidden');
        } else {
            mobWrapper.classList.add('hidden');
            mobImg.src = '';
        }

        // SHOW MODAL
        editModal.classList.remove('hidden');
        editModal.style.display = 'flex';
        document.body.classList.add('overflow-hidden');

        // ANIMATION
        gsap.set(editBox, { y: 40, scale: 0.95, opacity: 0 });
        gsap.set(editModal, { opacity: 0 });

        gsap.timeline()
            .to(editModal, {
                opacity: 1,
                duration: 0.25,
                ease: "power2.out"
            })
            .to(editBox, {
                y: 0,
                scale: 1,
                opacity: 1,
                duration: 0.45,
                ease: "power3.out"
            }, "-=0.1");
    };

    window.closeEditModal = function () {

        const editForm = document.getElementById('editForm');

        gsap.timeline({
            onComplete: () => {
                editModal.classList.add('hidden');
                editModal.style.display = '';
                document.body.classList.remove('overflow-hidden');
                editForm.reset();
            }
        })
            .to(editBox, {
                y: 30,
                scale: 0.96,
                opacity: 0,
                duration: 0.35,
                ease: "power3.in"
            })
            .to(editModal, {
                opacity: 0,
                duration: 0.2,
                ease: "power2.in"
            }, "-=0.2");
    };

    // BUTTON EVENTS
    editCloseBtn?.addEventListener('click', window.closeEditModal);
    cancelEditBtn?.addEventListener('click', window.closeEditModal);

    // CLICK OUTSIDE
    editModal.addEventListener('click', (e) => {
        if (e.target === editModal) {
            window.closeEditModal();
        }
    });

    // ESC CLOSE
    document.addEventListener('keydown', (e) => {
        if (e.key === "Escape" && !editModal.classList.contains('hidden')) {
            window.closeEditModal();
        }
    });
}
