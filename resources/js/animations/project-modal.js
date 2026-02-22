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
    const openCreateBtn = document.getElementById('openCreateModal');
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
        openCreateBtn?.addEventListener('click', window.openCreateModal);
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

        window.openLightbox = function (src) {

            lightboxImg.src = src;

            lightbox.classList.remove('hidden');
            lightbox.style.display = 'flex';

            detailModal.style.pointerEvents = "none";

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
    }
}
