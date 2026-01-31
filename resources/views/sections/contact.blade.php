<div class="max-w-5xl mx-auto px-6">
  <div class="text-center mb-14">
    <h3 class="text-4xl font-extrabold text-primary" data-i18n="contact.me"></h3>
    <p class="text-muted max-w-2xl mx-auto mt-3" data-i18n="contact.description"></p>
  </div>

  <div class="grid lg:grid-cols-2 lg:grid-rows-2 gap-8">

    <div class="lg:row-span-2 bg-bg border border-border rounded-2xl p-5">
      <h4 class="text-lg font-semibold mb-6" data-i18n="send.message"></h4>

      <form
        method="POST"
        class="space-y-4">
        @csrf
        <div>
          <label class="text-xs text-muted" data-i18n="name"></label>
          <input type="text" required name="name"
            class="w-full mt-1 px-3 py-2.5 rounded-lg
                   bg-bg border border-border
                   focus:outline-none focus:border-primary">
        </div>

        <div>
          <label class="text-xs text-muted">Email</label>
          <input type="email" required name="email"
            class="w-full mt-1 px-3 py-2.5 rounded-lg
                   bg-bg border border-border
                   focus:outline-none focus:border-primary">
        </div>

        <div>
          <label class="text-xs text-muted" data-i18n="message"></label>
          <textarea rows="5" required  name="message"
            class="w-full mt-1 px-3 py-2.5 rounded-lg
                   bg-bg border border-border
                   focus:outline-none focus:border-primary"></textarea>
        </div>

        <button
          class="mt-4 w-full py-2.5 bg-primary text-white
                 rounded-lg text-sm font-medium
                 hover:opacity-90 transition" data-i18n="send.message">
        </button>
      </form>
    </div>

    <div class="bg-bg border border-border rounded-2xl p-6">
        <h4 class="text-lg font-semibold mb-5" data-i18n="social.media">
        </h4>

        <div class="grid grid-cols-2 gap-4">
            <a href="https://github.com/Fadlan079" class="flex items-center gap-3 p-3 rounded-xl border border-border hover:border-primary transition">
            <i class="fa-brands fa-github text-lg"></i>
            <span class="text-sm font-medium">GitHub</span>
            </a>

            <a href="https://www.linkedin.com/in/fadlan-firdaus-148344386/" class="flex items-center gap-3 p-3 rounded-xl border border-border hover:border-primary transition">
            <i class="fa-brands fa-linkedin-in text-lg"></i>
            <span class="text-sm font-medium">LinkedIn</span>
            </a>

            <a href="https://instagram.com/fdln007" class="flex items-center gap-3 p-3 rounded-xl border border-border hover:border-primary transition">
            <i class="fa-brands fa-instagram text-lg"></i>
            <span class="text-sm font-medium">Instagram</span>
            </a>

            <a href="mailto:fadlanfirdaus220@gmail.com" class="flex items-center gap-3 p-3 rounded-xl border border-border hover:border-primary transition">
            <i class="fa-solid fa-envelope text-lg"></i>
            <span class="text-sm font-medium">Email</span>
            </a>
            <a href="https://wa.me/6282210732928"
            target="_blank"
            class="mt-6 flex items-center justify-center gap-2 col-span-2
                    w-full py-2.5
                    bg-primary text-white
                    rounded-xl text-sm font-medium
                    hover:opacity-90 transition">
            <i class="fa-brands fa-whatsapp text-base"></i>
            Chat via WhatsApp
            </a>
        </div>
    </div>
  </div>
</div>
