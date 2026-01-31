@vite(['resources/css/hero.css'])
<section id="home" class="hero-section relative min-h-screen flex items-center justify-center overflow-hidden z-10">
    <div class="hero-ribbons pointer-events-none absolute inset-0 overflow-hidden z-0 font-bold">
        <div class="ribbon ribbon-blue">
            <div class="ribbon-track">
                <span>
                FULL STACK DEVELOPER
                <em>◆</em>
                WEB APPLICATION
                </span>
                <span>
                FULL STACK DEVELOPER
                <em>◆</em>
                WEB APPLICATION
                </span>
                <span>
                FULL STACK DEVELOPER
                <em>◆</em>
                WEB APPLICATION
                </span>
                <span>
                FULL STACK DEVELOPER
                <em>◆</em>
                WEB APPLICATION
                </span>
            </div>
        </div>

        <div class="ribbon ribbon-white">
            <div class="ribbon-track">
                <span>
                FULL STACK DEVELOPER
                <em>◆</em>
                WEB APPLICATION
                </span>
                <span>
                FULL STACK DEVELOPER
                <em>◆</em>
                WEB APPLICATION
                </span>
                <span>
                FULL STACK DEVELOPER
                <em>◆</em>
                WEB APPLICATION
                </span>
                <span>
                FULL STACK DEVELOPER
                <em>◆</em>
                WEB APPLICATION
                </span>
            </div>
        </div>
    </div>

    <div class="hero-floats pointer-events-auto">

        <a href="https://github.com/Fadlan079" target="_blank"
        class="float-icon icon-github" data-depth="1.2">
            <i class="fa-brands fa-github"></i>
        </a>

        <a href="https://www.linkedin.com/in/fadlan-firdaus-148344386/"
        target="_blank"
        class="float-icon icon-linkedin" data-depth="0.9">
            <i class="fa-brands fa-linkedin"></i>
        </a>

        <a href="https://instagram.com/fdln007"
        target="_blank"
        class="float-icon icon-instagram" data-depth="0.7">
            <i class="fa-brands fa-instagram"></i>
        </a>

        <a href="mailto:fadlanfirdaus220@gmail.com"
        class="float-icon icon-mail" data-depth="0.6">
            <i class="fa-solid fa-envelope"></i>
        </a>

        <a href="https://wa.me/6282210732928"
        target="_blank"
        class="float-icon icon-whatsapp" data-depth="1.0">
            <i class="fa-brands fa-whatsapp"></i>
        </a>

    </div>

    <div class="hidden md:block fixed top-6 right-4 z-50">
        <div class="flex justify-center">
            @if (!session('is_login'))
                <a
                    href="/login"
                    class="cta-btn relative overflow-hidden px-4 py-2
                        border-2 border-border text-text font-semibold"
                    style="--cta-bubble-color: var(--color-primary);">

                    <span class="cta-bubble"></span>
                    <span class="cta-text relative z-10">Login</span>
                </a>
            @else
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="cta-btn relative overflow-hidden px-8 py-3
                            border-2 border-border text-text font-semibold"
                        style="--cta-bubble-color: #ef4444;">

                        <span class="cta-bubble"></span>
                        <span class="cta-text relative z-10">Logout</span>
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="hero-center relative z-10 text-center max-w-3xl -top-10">
        <div class="text-center">
            <span
                data-i18n="collaboration"
                class="hero-badge inline-flex items-center gap-2 px-4 py-1 mb-6
                rounded-full border border-border bg-surface text-sm text-muted">
            </span>

            <h2 class="hero-title mb-6 leading-tight text-center">

                <div
                    class="hero-big hero-solid"
                    data-text="HI">
                    <span data-i18n="hi"></span>
                </div>

                <div class="hero-big hero-outline">
                    FADLAN
                </div>

                <div class="hero-sub text-muted mt-4 font-semibold">
                    Full Stack Developer
                </div>

            </h2>

            <p class="hero-desc max-w-xl mb-5 text-sm md:text-base leading-loose
                    tracking-wide text-muted/80 relative">
                <span class="hero-desc-line"></span>
                <span data-i18n="hero.description"></span>
            </p>

            <div class="flex gap-4 flex-wrap justify-center text-md">
                <div class="flex justify-center">
                    <a
                        href="pages.project"
                        class="cta-btn relative overflow-hidden px-8 py-3
                            bg-primary text-text font-semibold border-2 border-border"
                            style="--cta-bubble-color: var(--color-bg);">
                        <span class="cta-bubble"></span>

                        <span class="cta-text relative z-10" data-i18n="more.projects"> </span>
                    </a>
                </div>
                <div class="flex justify-center">
                        <a
                            href="{{route('Contact')}}"
                            class="cta-btn relative overflow-hidden px-8 py-3
                                border-2 border-border text-text font-semibold"
                            style="--cta-bubble-color: var(--color-primary);">

                            <span class="cta-bubble"></span>
                            <span class="cta-text relative z-10" data-i18n="contact.me"></span>
                        </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <section class="py-32 bg-bg border-t border-border">
  <div class="max-w-4xl mx-auto px-6 text-center">

    <p class="text-sm uppercase tracking-widest text-muted mb-6">
      What I Do
    </p>

    <h3 class="text-4xl md:text-5xl font-semibold leading-tight mb-10">
      I build web applications<br>
      that feel simple to use.
    </h3>

    <p class="text-muted max-w-2xl mx-auto leading-loose">
      From backend structure to frontend interaction,
      I focus on clarity, maintainability,
      and thoughtful user experience.
    </p>

  </div>
</section>

<section class="py-28 bg-surface border-t border-border">
  <div class="max-w-6xl mx-auto px-6">

    <div class="grid md:grid-cols-3 gap-16 text-center">

      <div>
        <h4 class="text-xl font-semibold mb-3">
          Web Applications
        </h4>
        <p class="text-muted text-sm leading-relaxed">
          Laravel-based systems with
          structured backend logic.
        </p>
      </div>

      <div>
        <h4 class="text-xl font-semibold mb-3">
          UI & Dashboards
        </h4>
        <p class="text-muted text-sm leading-relaxed">
          Clean layouts focused on usability
          and consistency.
        </p>
      </div>

      <div>
        <h4 class="text-xl font-semibold mb-3">
          Frontend Integration
        </h4>
        <p class="text-muted text-sm leading-relaxed">
          Smooth interactions and
          component-driven development.
        </p>
      </div>

    </div>
  </div>
</section>



<section class="py-32 bg-surface border-t border-border">
  <div class="max-w-3xl mx-auto px-6 text-center">

    <h3 class="text-4xl font-semibold mb-20">
      How I Work
    </h3>

    <div class="space-y-16">

      <div>
        <h4 class="font-semibold mb-2">Understand</h4>
        <p class="text-muted text-sm">
          I take time to understand the problem
          before touching any code.
        </p>
      </div>

      <div>
        <h4 class="font-semibold mb-2">Build</h4>
        <p class="text-muted text-sm">
          Clean architecture, readable code,
          and thoughtful decisions.
        </p>
      </div>

      <div>
        <h4 class="font-semibold mb-2">Refine</h4>
        <p class="text-muted text-sm">
          Continuous improvement based on feedback
          and real usage.
        </p>
      </div>

    </div>
  </div>
</section>


<section class="relative z-10 py-32 bg-bg border-t border-border text-center">
    <h3 class="text-4xl font-bold mb-6">
        Let’s build something meaningful
    </h3>
    <p class="text-muted mb-10">
        Have a project in mind or just want to talk?
    </p>

    <a href=""
       class="cta-btn inline-block relative overflow-hidden px-10 py-4
              bg-primary text-text font-semibold border-2 border-border">
        Contact Me
    </a>
</section> --}}
