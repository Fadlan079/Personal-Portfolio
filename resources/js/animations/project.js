import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export function projectAnimation() {

  /* =========================
   * HERO — compress & archive
   * ========================= */
  gsap.timeline({
    scrollTrigger: {
      trigger: "#projects-hero",
      start: "top top",
      end: "+=120%",
      scrub: true,
      pin: true,
      anticipatePin: 1
    }
  })
    .fromTo(
      "#projects-hero h1",
      { scale: 1, y: 0 },
      { scale: 0.6, y: -140, ease: "none" }
    )
    .fromTo(
      "#projects-hero p",
      { opacity: 1, y: 0 },
      { opacity: 0, y: 80, ease: "none" },
      0
    )
    .fromTo(
      "#projects-hero .flex",
      { opacity: 1 },
      { opacity: 0.3 },
      0
    );

  /* =========================
   * INTRO REVEAL
   * ========================= */
  gsap.set(".project-folder", {
    y: 80,
    opacity: 0
  });

  gsap.to(".project-folder", {
    y: 0,
    opacity: 1,
    stagger: 0.15,
    ease: "power3.out",
    scrollTrigger: {
      trigger: "#projects-index",
      start: "top 70%",
      end: "top 30%",
      scrub: true
    }
  });

  /* =========================
   * TECH ROW — subtle system detail
   * ========================= */


  /* =========================
   * ENDING STATEMENT
   * ========================= */
  const title = document.querySelector("#projects-end-title");
  const fullText = title.textContent.trim() || "";
  const chars = fullText.split("");

  gsap.to(
    { count: 0 },
    {
      count: chars.length,
      ease: "none",
      scrollTrigger: {
        trigger: "#projects-end",
        start: "top 75%",
        end: "top 30%",
        scrub: true
      },
      onUpdate() {
        const visible = Math.floor(this.targets()[0].count);
        title.textContent = chars.slice(0, visible).join("");
      }
    }
  );

  gsap.fromTo(
    "#projects-end-title",
    {
      y: 80,
      scale: 0.95,
      opacity: 0.4
    },
    {
      y: 0,
      scale: 1,
      opacity: 1,
      ease: "power3.out",
      scrollTrigger: {
        trigger: "#projects-end",
        start: "top 100%",
        end: "bottom 50%",
        scrub: true
      }
    }
  );

  ScrollTrigger.refresh();
}
