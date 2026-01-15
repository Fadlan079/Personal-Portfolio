<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portfolio | Fadlan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            bg: 'var(--color-bg)',
            surface: 'var(--color-surface)',
            border: 'var(--color-border)',
            text: 'var(--color-text)',
            muted: 'var(--color-muted)',
            primary: 'var(--color-primary)',
            success: 'var(--color-success)',
            danger: 'var(--color-danger)',
            warning: 'var(--color-warning)',
          }
        }
      }
    }
  </script>
  <style>
    :root {
      --color-bg: #1c1c1e;
      --color-surface: #262629;
      --color-border: #3a3a3d;
      --color-text: #f4f4f5;
      --color-muted: #a1a1aa;
      --color-primary: #b91c1c;
      --color-success: #6fbf8f;
      --color-danger:  #ef4444;
      --color-warning: #eab308;
    }

    html {
      scroll-behavior: smooth;
    }

* {
  scrollbar-width: thin;
  scrollbar-color: #ef4444 transparent;
}

::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  background: transparent;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(
    180deg,
    #ef4444,
    #dc2626
  );
  border-radius: 999px;
  border: 2px solid transparent;
  background-clip: content-box;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(
    180deg,
    #f87171,
    #ef4444
  );
}

  </style>
</head>

<body class="bg-bg text-text">
  <header> @include('components.header') </header>
  <main>
    <section id="home" class="relative min-h-screen flex items-center px-6 overflow-hidden">  @include('sections.hero')</section>
    <section id="about" class="py-20 bg-surface">@include('sections.about')</section>
    <section id="experience" class="py-20">@include('sections.experience')</section>
    <section id="education" class="py-24 bg-bg">@include('sections.education')</section>
    <section id="projects" class="py-20 bg-bg">@include('sections.project')</section>
  </main>



<!-- Skills -->
<section id="skills" class="py-20 bg-surface">
  <div class="max-w-6xl mx-auto px-6">
    <h3 class="text-3xl font-bold mb-12 text-primary text-center">Skills & Bahasa</h3>

    <div class="grid md:grid-cols-3 gap-6 text-center">
      <div class="bg-bg border border-border rounded-xl p-6">
        <i class="fa-brands fa-laravel text-4xl text-primary mb-3"></i>
        <h4 class="font-semibold">Laravel</h4>
      </div>
      <div class="bg-bg border border-border rounded-xl p-6">
        <i class="fa-solid fa-database text-4xl text-primary mb-3"></i>
        <h4 class="font-semibold">MySQL</h4>
      </div>
      <div class="bg-bg border border-border rounded-xl p-6">
        <i class="fa-brands fa-linux text-4xl text-primary mb-3"></i>
        <h4 class="font-semibold">Linux Server</h4>
      </div>
      <div class="bg-bg border border-border rounded-xl p-6">
        <i class="fa-brands fa-html5 text-4xl text-warning mb-3"></i>
        <h4 class="font-semibold">HTML</h4>
      </div>
      <div class="bg-bg border border-border rounded-xl p-6">
        <i class="fa-brands fa-css3-alt text-4xl text-warning mb-3"></i>
        <h4 class="font-semibold">CSS / Tailwind</h4>
      </div>
      <div class="bg-bg border border-border rounded-xl p-6">
        <i class="fa-brands fa-js text-4xl text-warning mb-3"></i>
        <h4 class="font-semibold">JavaScript</h4>
      </div>
    </div>
  </div>
</section>

<!-- Contact -->
<section id="contact" class="py-24 bg-bg">
  <div class="max-w-5xl mx-auto px-6">

    <!-- Heading -->
    <div class="text-center mb-14">
      <h3 class="text-4xl font-extrabold mb-3">
        Kontak <span class="text-primary">Saya</span>
      </h3>
      <p class="text-muted max-w-2xl mx-auto">
        Tertarik kerja sama, project freelance, atau diskusi seputar web & Laravel?
        Hubungi saya melalui platform di bawah ini.
      </p>
    </div>

    <!-- Contact Cards -->
    <div class="grid sm:grid-cols-2 gap-6">

      <!-- Email -->
      <a href="mailto:fadlanfirdaus220@gmail.com"
         class="group bg-surface border border-border rounded-2xl p-6
                flex items-center gap-5
                hover:border-primary hover:-translate-y-1 transition">
        <div class="w-14 h-14 rounded-xl flex items-center justify-center
                    bg-primary/20 text-primary text-xl">
          <i class="fa-solid fa-envelope"></i>
        </div>
        <div>
          <p class="text-sm text-muted">Email</p>
          <p class="font-semibold group-hover:text-primary transition">
            fadlanfirdaus220@gmail.com
          </p>
        </div>
      </a>

      <!-- GitHub -->
      <a href="https://github.com/Fadlan079" target="_blank"
         class="group bg-surface border border-border rounded-2xl p-6
                flex items-center gap-5
                hover:border-primary hover:-translate-y-1 transition">
        <div class="w-14 h-14 rounded-xl flex items-center justify-center
                    bg-primary/20 text-primary text-xl">
          <i class="fa-brands fa-github"></i>
        </div>
        <div>
          <p class="text-sm text-muted">GitHub</p>
          <p class="font-semibold group-hover:text-primary transition">
            github.com/Fadlan079
          </p>
        </div>
      </a>

      <!-- Phone -->
      <a href="tel:082210732928"
         class="group bg-surface border border-border rounded-2xl p-6
                flex items-center gap-5
                hover:border-primary hover:-translate-y-1 transition">
        <div class="w-14 h-14 rounded-xl flex items-center justify-center
                    bg-primary/20 text-primary text-xl">
          <i class="fa-solid fa-phone"></i>
        </div>
        <div>
          <p class="text-sm text-muted">WhatsApp / Phone</p>
          <p class="font-semibold group-hover:text-primary transition">
            0822-1073-2928
          </p>
        </div>
      </a>

      <!-- Instagram -->
      <a href="https://instagram.com/fdln007" target="_blank"
         class="group bg-surface border border-border rounded-2xl p-6
                flex items-center gap-5
                hover:border-primary hover:-translate-y-1 transition">
        <div class="w-14 h-14 rounded-xl flex items-center justify-center
                    bg-primary/20 text-primary text-xl">
          <i class="fa-brands fa-instagram"></i>
        </div>
        <div>
          <p class="text-sm text-muted">Instagram</p>
          <p class="font-semibold group-hover:text-primary transition">
            @fdln007
          </p>
        </div>
      </a>

    </div>

    <!-- CTA -->
    <div class="text-center mt-16">
      <p class="text-muted mb-4">
        Siap berkolaborasi dan membangun aplikasi bersama?
      </p>
      <a href="mailto:fadlanfirdaus220@gmail.com"
         class="inline-block px-8 py-3 bg-primary text-white
                rounded-2xl font-semibold
                hover:opacity-90 transition shadow-lg shadow-primary/30">
        Hubungi Sekarang 
      </a>
    </div>

  </div>
</section>


  <footer class="relative border-t border-border bg-bg"></footer>
</body>
</html>