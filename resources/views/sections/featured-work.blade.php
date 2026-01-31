<section class="py-16 bg-bg border-t border-border">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div>
        <div class="rounded-3xl bg-bg overflow-hidden max-w-full">
            <div class="relative ">
                <div
                    id="three-canvas"
                      class="max-w-full h-70 sm:h-90 md:h-105 lg:h-110 rounded-2xl bg-bg ">
                </div>

                {{-- <div id="device-screen" class="bsolute z-20 top-[14%] left-[10%] w-[80%] h-[62%] rounded-lg overflow-hidden bg-black">
                    <iframe src=""
                    class="w-full h-full rounded-xl">
                    </iframe>
                </div> --}}
            </div>

            <div class="flex justify-center">
                <div class="flex max-w-full justify-center bg-surface/80 backdrop-blur border border-border rounded-full p-1 text-s overflow-x-hiddden relative">

                    <div id="btn-highlight" class="absolute top-1 left-1 h-[calc(100%-0.5rem)] rounded-full bg-bg z-0"></div>

                    <button data-device="desktop"
                    class="device-btn px-4 py-2 rounded-full font-medium relative z-10">
                    Desktop
                    </button>

                    <button data-device="tablet"
                    class="device-btn px-5 py-2 rounded-full text-muted relative z-10">
                    Tablet
                    </button>

                    <button data-device="mobile"
                    class="device-btn px-5 py-2 rounded-full text-muted relative z-10">
                    Mobile
                    </button>
                </div>
            </div>
        </div>
      </div>

      <div class="pt-4">
        <p class="text-sm uppercase tracking-widest text-muted mb-4">
          Selected Work
        </p>

        <h3 class="text-3xl font-semibold leading-tight mb-6">
          Dashboard Management System
        </h3>

        <p class="text-muted leading-loose mb-8 max-w-xl">
          A web-based dashboard built with Laravel,
          focusing on clarity, performance,
          and maintainable backend structure.
        </p>

        <div class="flex flex-wrap gap-2 mb-10">
          <span class="px-3 py-1 text-xs rounded-full border border-border">
            Laravel
          </span>
          <span class="px-3 py-1 text-xs rounded-full border border-border">
            Tailwind CSS
          </span>
          <span class="px-3 py-1 text-xs rounded-full border border-border">
            HTMX
          </span>
        </div>

        <div class="space-y-4">

          <button class="w-full text-left p-4 rounded-xl border border-border
                         hover:bg-surface transition">
            <p class="font-medium">Dashboard System</p>
            <p class="text-sm text-muted">Admin & analytics interface</p>
          </button>

          <button class="w-full text-left p-4 rounded-xl border border-border
                         hover:bg-surface transition">
            <p class="font-medium">Portfolio Website</p>
            <p class="text-sm text-muted">Personal branding site</p>
          </button>

          <button class="w-full text-left p-4 rounded-xl border border-border
                         hover:bg-surface transition">
            <p class="font-medium">Landing Page</p>
            <p class="text-sm text-muted">Marketing focused layout</p>
          </button>

        </div>

      </div>

    </div>
  </div>
</section>

<script>
  const buttons = document.querySelectorAll('.device-btn');
  const views = document.querySelectorAll('.device-view');

  buttons.forEach(btn => {
    btn.addEventListener('click', () => {

      const device = btn.dataset.device;

      buttons.forEach(b => {
        b.classList.remove('bg-bg', 'text-text');
        b.classList.add('text-muted');
      });

      btn.classList.add('bg-bg', 'text-text');
      btn.classList.remove('text-muted');

      views.forEach(view => {
        view.classList.toggle(
          'hidden',
          view.dataset.view !== device
        );
      });

    });
  });
</script>

@vite(['resources/js/three-viewer.js'])
