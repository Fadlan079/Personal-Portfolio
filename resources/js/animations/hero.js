import { gsap } from "gsap";

export function heroAnimation() {
    const tl = gsap.timeline({ defaults: { ease: "power3.out" } });

    tl.from(".hero-badge", {
        y: -30,
        opacity: 0,
        duration: 0.8,
    })

    .from(".hero-title span", {
        y: 40,
        opacity: 0,
        stagger: 0.15,
        duration: 0.8,
    }, "-=0.3")

    .from(".hero-desc", {
        y: 20,
        opacity: 0,
        duration: 0.6,
    }, "-=0.4")
}


function setupMarquee(selector, direction = 1, speed = 80) {
    const track = document.querySelector(selector);
    if (!track) return;
    if (track.dataset.init) return;
    track.dataset.init = "true";

    track.innerHTML += track.innerHTML;

    const width = track.scrollWidth / 2;

    gsap.to(track, {
        x: direction * -width,
        duration: width / speed,
        ease: "none",
        repeat: -1,
        modifiers: {
            x: (x) => `${parseFloat(x) % width}px`
        }
    });
}

export function heroRibbonAnimation() {
    setupMarquee(".ribbon-blue .ribbon-track", 1, 90);
    setupMarquee(".ribbon-white .ribbon-track", -1, 70);

    gsap.from(".ribbon", {
        opacity: 0,
        y: 30,
        duration: 1,
        ease: "power3.out"
    });
}

export function heroFloatingCards() {

    gsap.utils.toArray(".float-icon").forEach((icon, i) => {

        gsap.to(icon, {
            y: gsap.utils.random(-18, 18),
            x: gsap.utils.random(-12, 12),
            duration: gsap.utils.random(4, 7),
            ease: "sine.inOut",
            repeat: -1,
            yoyo: true,
            delay: i * 0.25
        });

    });

}

export function heroIconParallax() {

    if (window.innerWidth < 768) return;
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

    const icons = gsap.utils.toArray(".float-icon");

    window.addEventListener("mousemove", (e) => {

        const mx = (e.clientX - window.innerWidth / 2) / window.innerWidth;
        const my = (e.clientY - window.innerHeight / 2) / window.innerHeight;

        icons.forEach((icon) => {

            const depth = parseFloat(icon.dataset.depth || 1);

            gsap.to(icon, {
                x: mx * 40 * depth,
                y: my * 40 * depth,
                rotateY: mx * 10 * depth,
                rotateX: -my * 10 * depth,
                duration: 0.8,
                ease: "power3.out",
                overwrite: "auto"
            });

        });

    });

    const highlight = document.getElementById('btn-highlight');
const buttons = document.querySelectorAll('.device-btn');

// Set default ke tombol pertama
let activeBtn = buttons[0];
moveHighlight(activeBtn);

// Event klik
buttons.forEach(btn => {
  btn.addEventListener('click', () => {
    activeBtn = btn;
    moveHighlight(btn);
    buttons.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
  });
});

// Fungsi animasi highlight smooth
function moveHighlight(btn) {
  const parentRect = btn.parentElement.getBoundingClientRect();
  const btnRect = btn.getBoundingClientRect();

  const left = btnRect.left - parentRect.left;
  const width = btnRect.width;

  // GSAP smooth dengan duration lebih tinggi + ease
  gsap.to(highlight, {
    x: left,
    width: width,
    duration: 0.6,           // lebih lama = lebih smooth
    ease: "power3.out"
  });
}

}

document.querySelectorAll(".cta-btn").forEach(btn => {
    const bubble = btn.querySelector(".cta-bubble");
    const text = btn.querySelector(".cta-text");

    const tl = gsap.timeline({ paused: true });

    tl.to(bubble, {
        scale: 1,
        y: "-35%",
        duration: 0.55,
        ease: "power4.out"
    });

    btn.addEventListener("mouseenter", () => tl.play());
    btn.addEventListener("mouseleave", () => tl.reverse());
});
