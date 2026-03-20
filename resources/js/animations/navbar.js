import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

export function navbarFloatAnimation() {
  // Gunakan ID agar lebih presisi menangkap navbar HUD baru
  const nav = document.getElementById("mainNavbar");
  if (!nav) return;

  gsap.set(nav, {
    scaleX: 0.2,
    scaleY: 0.2,
    y: -40,
    opacity: 0,
    // borderRadius: "999px", <-- DIHAPUS agar desain HUD tetap bersudut tajam/kaku
  });

  gsap.to(nav, {
    scaleX: 1,
    scaleY: 1,
    y: 0,
    opacity: 1,
    duration: 1.5,
    ease: "elastic.out(1, 0.6)",
  });

  // Targetkan div di dalam navbar HUD
  gsap.from("#mainNavbar > div", {
    opacity: 0,
    y: -10,
    duration: 0.4,
    delay: 0.6
  });
}

export function navbarScrollEffect() {
  const nav = document.getElementById("mainNavbar");
  if (!nav) return;

  ScrollTrigger.create({
    start: 0,
    onUpdate(self) {
      gsap.to(nav, {
        // Skala saat scroll-down disesuaikan sedikit ke 0.95 agar HUD tidak terlihat terlalu tipis
        scale: self.direction === 1 ? 0.95 : 1, 
        y: self.direction === 1 ? -15 : 0,
        duration: 0.25,
        ease: "power2.out",
      });
    }
  });
}