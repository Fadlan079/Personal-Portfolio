import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

export function aboutAnimation() {
    gsap.timeline({
        scrollTrigger: {
            trigger: "#about-hero",
            start: "top top",
            end: "+=140%",
            scrub: true,
            pin: true,
            anticipatePin: 1
        }
    })

        .fromTo("#about-title",
            { scale: 1, y: 0 },
            { scale: 0.55, y: -120, ease: "none" }
        )
        .fromTo("#about-outline",
            { y: 0, opacity: 1 },
            { y: 160, opacity: 0.40, ease: "none" },
            0
        );

    gsap.from("#about-narrative", {
        scrollTrigger: {
            trigger: "#about-narrative",
            start: "top 80%",
            end: "top 30%",
            scrub: true
        },
        y: 120,
        opacity: 0
    });

    gsap.from(".value-item", {
        scrollTrigger: {
            trigger: "#about-values",
            start: "top 75%",
            end: "bottom 40%",
            scrub: true
        },
        y: 100,
        opacity: 0,
        stagger: 0.2
    });

    gsap.fromTo(
        ".value-desc",
        {
            opacity: 0,
            y: 12
        },
        {
            opacity: 1,
            y: 0,
            ease: "power2.out",
            stagger: 0.15,
            scrollTrigger: {
                trigger: "#about-values",
                start: "top 55%",
                end: "bottom 30%",
                scrub: true
            }
        }
    );

    gsap.fromTo(
        ".value-desc",
        {
            opacity: 0,
            y: 16
        },
        {
            opacity: 1,
            y: 0,
            ease: "power2.out",
            stagger: {
                each: 0.15,
                from: "start"
            },
            scrollTrigger: {
                trigger: ".value-title",
                start: "top 60%",
                end: "top 30%",
                scrub: true
            }
        }
    );


    gsap.utils.toArray(".constraint-line").forEach((line, i) => {
        gsap.to(line, {
            x: "0%",
            opacity: 1,
            scrollTrigger: {
                trigger: "#about-constraints",
                start: () => `top+=${i * 150} center`,
                end: () => `top+=${(i + 1) * 150} center`,
                scrub: true
            }
        });
    });

    gsap.fromTo(
        {
            WebkitTextStrokeColor: "var(--color-primary)",
            scrollTrigger: {
                trigger: "#about-hero",
                start: "top top",
                end: "bottom top",
                scrub: true
            }
        }
    );

    gsap.set("#about-title", {
        y: 80,
        scale: 1.1,
        opacity: 0
    });

    gsap.set("#about-outline", {
        y: 120,
        opacity: 0
    });

    const intro = gsap.timeline({
        defaults: {
            ease: "power3.out"
        }
    });

    intro
        .to("#about-title", {
            y: 0,
            opacity: 1,
            duration: 0.8
        })
        .to("#about-title", {
            scale: 1,
            duration: 0.6
        }, "<")
        .to("#about-outline", {
            y: 0,
            opacity: 1,
            duration: 0.9
        }, "-=0.4");

    intro.fromTo(
        "#about-outline",
        {
            WebkitTextStrokeWidth: "0px"
        },
        {
            WebkitTextStrokeWidth: "2px",
            duration: 0.6,
            ease: "power2.out"
        },
        "-=0.5"
    );
    intro.call(() => {
        ScrollTrigger.refresh();
    });
    intro.to({}, { duration: 0.15 });
}
