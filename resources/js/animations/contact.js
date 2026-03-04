import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

/* ─────────────────────────────────────────────
   CONTACT PAGE – GSAP ANIMATIONS
   Sections:
   1. Hero entrance (stagger reveal)
   2. Request folder – pinned parallax scrub
   3. Social cards – stagger + counter + hover
   4. End section – cinematic text reveal
───────────────────────────────────────────── */

/* ───── 1. HERO ENTRANCE ───── */
export function contactHeroAnimation() {
    const tl = gsap.timeline({ defaults: { ease: "power3.out" } });

    tl.from("#contact-hero .contact-breadcrumb", {
        y: -24,
        opacity: 0,
        duration: 0.7,
    })
        .from("#contact-hero .contact-title span", {
            y: 60,
            opacity: 0,
            stagger: 0.18,
            duration: 0.9,
            ease: "power4.out",
        }, "-=0.3")
        .from("#contact-hero .contact-desc", {
            y: 28,
            opacity: 0,
            duration: 0.7,
        }, "-=0.4");
}

/* ───── 2. REQUEST FOLDER – PIN + SCRUB ───── */
export function contactFolderAnimation() {
    // Fade-in header on scroll
    gsap.from("#request-header > *", {
        scrollTrigger: {
            trigger: "#request-section",
            start: "top 75%",
            end: "top 40%",
            scrub: 1,
        },
        y: 60,
        opacity: 0,
        stagger: 0.2,
    });

    // Folder float-in from below
    gsap.from("#contact-folder", {
        scrollTrigger: {
            trigger: "#contact-folder",
            start: "top 85%",
            end: "top 50%",
            scrub: 1.2,
        },
        y: 80,
        opacity: 0,
        ease: "power2.out",
    });

    // File stack stagger reveal
    gsap.from(".folder-file-tab > *", {
        scrollTrigger: {
            trigger: "#contact-folder",
            start: "top 80%",
            end: "top 55%",
            scrub: 1,
        },
        x: -30,
        opacity: 0,
        stagger: 0.15,
    });

    // Form fields reveal with scrub
    gsap.from(".form-field", {
        scrollTrigger: {
            trigger: "#contact-folder",
            start: "top 70%",
            end: "top 20%",
            scrub: 1.5,
        },
        y: 40,
        opacity: 0,
        stagger: 0.18,
    });

    // System note
    gsap.from("#system-note", {
        scrollTrigger: {
            trigger: "#system-note",
            start: "top 85%",
            end: "top 60%",
            scrub: 1,
        },
        x: 50,
        opacity: 0,
    });
}

/* ───── 3. SOCIAL CARDS – STAGGER + COUNTERS ───── */
export function contactSocialAnimation() {
    // Section header reveal
    gsap.from("#social-header > *", {
        scrollTrigger: {
            trigger: "#social-section",
            start: "top 80%",
            end: "top 45%",
            scrub: 1,
        },
        y: 50,
        opacity: 0,
        stagger: 0.2,
    });

    // Cards: staggered scrub entrance from below
    gsap.from(".social-card", {
        scrollTrigger: {
            trigger: "#social-cards-grid",
            start: "top 85%",
            end: "top 40%",
            scrub: 1.2,
        },
        y: 100,
        opacity: 0,
        stagger: 0.25,
        ease: "power2.out",
    });

    // Card indicator lines animate in width
    gsap.from(".social-card-line", {
        scrollTrigger: {
            trigger: "#social-cards-grid",
            start: "top 70%",
            end: "top 30%",
            scrub: 1,
        },
        scaleX: 0,
        transformOrigin: "left center",
        stagger: 0.2,
    });

    // Hover magnetic effect
    document.querySelectorAll(".social-card").forEach((card) => {
        card.addEventListener("mousemove", (e) => {
            const rect = card.getBoundingClientRect();
            const cx = rect.left + rect.width / 2;
            const cy = rect.top + rect.height / 2;
            const dx = (e.clientX - cx) / (rect.width / 2);
            const dy = (e.clientY - cy) / (rect.height / 2);

            gsap.to(card, {
                x: dx * 8,
                y: dy * 8,
                rotateX: -dy * 4,
                rotateY: dx * 4,
                duration: 0.4,
                ease: "power2.out",
                transformPerspective: 800,
            });

            const arrow = card.querySelector(".social-arrow");
            if (arrow) {
                gsap.to(arrow, {
                    x: dx * 6,
                    y: dy * 6,
                    duration: 0.35,
                    ease: "power2.out",
                });
            }
        });

        card.addEventListener("mouseleave", () => {
            gsap.to(card, {
                x: 0,
                y: 0,
                rotateX: 0,
                rotateY: 0,
                duration: 0.6,
                ease: "elastic.out(1, 0.4)",
            });

            const arrow = card.querySelector(".social-arrow");
            if (arrow) {
                gsap.to(arrow, {
                    x: 0,
                    y: 0,
                    duration: 0.5,
                    ease: "elastic.out(1, 0.4)",
                });
            }
        });
    });
}

/* ───── 4. END SECTION – CINEMATIC REVEAL ───── */
export function contactEndAnimation() {
    // Pin end section briefly while text reveals
    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: "#contact-end",
            start: "top 70%",
            end: "top 10%",
            scrub: 1.5,
        },
    });

    tl.from("#contact-end .end-breadcrumb", {
        y: -20,
        opacity: 0,
    })
        .from("#contact-end .end-title", {
            y: 80,
            opacity: 0,
            ease: "power3.out",
        }, "-=0.5")
        .from("#contact-end .end-desc", {
            y: 40,
            opacity: 0,
        }, "-=0.6");

    // Subtle horizontal line reveal from left
    gsap.from("#contact-end .end-line", {
        scrollTrigger: {
            trigger: "#contact-end",
            start: "top 80%",
            end: "top 50%",
            scrub: 1,
        },
        scaleX: 0,
        transformOrigin: "left center",
        ease: "none",
    });
}

/* ───── INIT – call all ───── */
export function initContactAnimations() {
    contactHeroAnimation();
    contactFolderAnimation();
    contactSocialAnimation();
    contactEndAnimation();
}
