<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portfolio | Fadlan</title>

  <!-- Tailwind CDN + Custom Theme -->
  <script src="https://cdn.tailwindcss.com"></script>
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
  </style>
</head>

<body class="bg-bg text-text">

  <!-- Navbar -->
  <nav class="fixed w-full bg-bg/80 backdrop-blur border-b border-border z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-xl font-bold text-primary">Fadlan.dev</h1>
      <ul class="flex gap-6 text-sm">
        <li><a href="#home" class="hover:text-primary transition">Home</a></li>
        <li><a href="#about" class="hover:text-primary transition">About</a></li>
        <li><a href="#projects" class="hover:text-primary transition">Projects</a></li>
        <li><a href="#contact" class="hover:text-primary transition">Contact</a></li>
      </ul>
    </div>
  </nav>

  <!-- Hero -->
  <section id="home" class="min-h-screen flex items-center justify-center text-center px-6">
    <div>
      <h2 class="text-4xl md:text-6xl font-extrabold mb-4">
        Hi, Saya <span class="text-primary">Fadlan</span>
      </h2>
      <p class="text-muted max-w-xl mx-auto mb-6">
        Web Developer | Backend & Laravel Enthusiast | Linux Server
      </p>
      <a href="#projects"
        class="inline-block px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:opacity-90 transition">
        Lihat Project
      </a>
    </div>
  </section>

  <!-- About -->
  <section id="about" class="py-20 bg-surface">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
      <div>
        <h3 class="text-3xl font-bold mb-4 text-primary">Tentang Saya</h3>
        <p class="text-muted leading-relaxed">
          Saya seorang pelajar SMK jurusan PPLG yang fokus pada pengembangan web,
          backend Laravel, database MySQL, dan setup server Linux.
          Saya suka membangun aplikasi yang rapi, aman, dan scalable.
        </p>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div class="p-4 bg-bg border border-border rounded-xl text-center">Laravel</div>
        <div class="p-4 bg-bg border border-border rounded-xl text-center">MySQL</div>
        <div class="p-4 bg-bg border border-border rounded-xl text-center">Tailwind</div>
        <div class="p-4 bg-bg border border-border rounded-xl text-center">Linux Server</div>
      </div>
    </div>
  </section>

  <!-- Projects -->
  <section id="projects" class="py-20">
    <div class="max-w-7xl mx-auto px-6">
      <h3 class="text-3xl font-bold text-center mb-12 text-primary">Project</h3>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-surface border border-border rounded-2xl p-6 hover:-translate-y-2 transition">
          <h4 class="text-xl font-semibold mb-2">Sistem Kasir</h4>
          <p class="text-muted text-sm">Aplikasi kasir berbasis Laravel & MySQL.</p>
        </div>
        <div class="bg-surface border border-border rounded-2xl p-6 hover:-translate-y-2 transition">
          <h4 class="text-xl font-semibold mb-2">Website Sekolah</h4>
          <p class="text-muted text-sm">Company profile sekolah responsif.</p>
        </div>
        <div class="bg-surface border border-border rounded-2xl p-6 hover:-translate-y-2 transition">
          <h4 class="text-xl font-semibold mb-2">API Auth</h4>
          <p class="text-muted text-sm">REST API login JWT & role management.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section id="contact" class="py-20 bg-surface">
    <div class="max-w-xl mx-auto px-6 text-center">
      <h3 class="text-3xl font-bold mb-4 text-primary">Kontak</h3>
      <p class="text-muted mb-6">Tertarik bekerja sama atau ingin diskusi?</p>
      <a href="mailto:emailkamu@gmail.com"
        class="px-6 py-3 bg-primary text-white rounded-xl font-semibold hover:opacity-90 transition">
        Email Saya
      </a>
    </div>
  </section>

  <footer class="py-6 text-center text-muted text-sm">
    © 2026 Fadlan. All rights reserved.
  </footer>

</body>
</html>
