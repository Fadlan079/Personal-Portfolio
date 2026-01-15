<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portfolio | Fadlan</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
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
  </style>
</head>

<body class="bg-bg text-text">

<!-- Navbar -->
<nav class="fixed w-full bg-bg/80 backdrop-blur border-b border-border z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-primary">Fadlan.dev</h1>
    <ul class="flex gap-6 text-sm">
      <li class="relative group">
        <a href="#home">Home</a>
        <span class="absolute left-0 -bottom-1 h-[2px] w-0 bg-primary transition-all group-hover:w-full"></span>
      </li>
      <li class="relative group">
        <a href="#about">About</a>
        <span class="absolute left-0 -bottom-1 h-[2px] w-0 bg-primary transition-all group-hover:w-full"></span>
      </li>
      <li class="relative group">
        <a href="#experience">Experience</a>
        <span class="absolute left-0 -bottom-1 h-[2px] w-0 bg-primary transition-all group-hover:w-full"></span>
      </li>
      <li class="relative group">
        <a href="#skills">Skills</a>
        <span class="absolute left-0 -bottom-1 h-[2px] w-0 bg-primary transition-all group-hover:w-full"></span>
      </li>
      <li class="relative group">
        <a href="#contact">Contact</a>
        <span class="absolute left-0 -bottom-1 h-[2px] w-0 bg-primary transition-all group-hover:w-full"></span>
      </li>
    </ul>
  </div>
</nav>

<!-- Hero -->
<section id="home" class="min-h-screen flex items-center justify-center text-center px-6">
  <div>
    <h2 class="text-4xl md:text-6xl font-extrabold mb-4">
      Hi, Saya <span class="text-primary">Fadlan</span>
    </h2>
    <p class="text-muted max-w-xl mx-auto mb-2">
      Full Stack Developer (Laravel)
    </p>
    <p class="text-muted max-w-xl mx-auto mb-6">
      Backend • Frontend • Linux Server
    </p>
    <a href="#projects"
      class="inline-block px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:opacity-90 transition">
      Lihat Project
    </a>
  </div>
</section>

<!-- About -->
<section id="about" class="py-20 bg-surface">
  <div class="max-w-6xl mx-auto px-6">
    <h3 class="text-3xl font-bold mb-6 text-primary">Tentang Saya</h3>
    <p class="text-muted leading-relaxed max-w-3xl">
      Saya pelajar SMK jurusan PPLG dengan minat besar di bidang
      <strong>Full Stack Development</strong>. Terbiasa membangun aplikasi
      Laravel, REST API, database MySQL, serta deployment ke server Linux.
    </p>
  </div>
</section>

<!-- Experience -->
<section id="experience" class="py-20">
  <div class="max-w-6xl mx-auto px-6">
    <h3 class="text-3xl font-bold mb-12 text-primary text-center">Pengalaman</h3>
    <div class="space-y-6">
      <div class="bg-surface border border-border rounded-xl p-6">
        <h4 class="font-semibold">Project Sistem Kasir</h4>
        <p class="text-muted text-sm">Laravel • MySQL • Tailwind</p>
      </div>
      <div class="bg-surface border border-border rounded-xl p-6">
        <h4 class="font-semibold">Website Sekolah</h4>
        <p class="text-muted text-sm">Company Profile • Responsive Design</p>
      </div>
      <div class="bg-surface border border-border rounded-xl p-6">
        <h4 class="font-semibold">REST API Auth</h4>
        <p class="text-muted text-sm">JWT • Role Management</p>
      </div>
    </div>
  </div>
</section>

<!-- Projects -->
<section id="projects" class="py-20 bg-bg">
  <div class="max-w-7xl mx-auto px-6">
    <h3 class="text-3xl font-bold text-center mb-4 text-primary">Projects</h3>
    <p class="text-muted text-center mb-12">
      Beberapa project yang pernah saya kerjakan
    </p>

    <div class="grid md:grid-cols-3 gap-8">

      <!-- Project Card -->
      <div class="bg-surface border border-border rounded-2xl p-6 hover:-translate-y-2 transition">
        <div class="flex justify-between items-center mb-3">
          <h4 class="text-xl font-semibold">Sistem Kasir</h4>
          <span class="text-xs px-2 py-1 rounded bg-success/20 text-success">
            Finished
          </span>
        </div>

        <p class="text-muted text-sm mb-4">
          Aplikasi kasir berbasis web untuk manajemen produk, transaksi,
          dan laporan penjualan.
        </p>

        <!-- Tech Stack -->
        <div class="flex flex-wrap gap-2 text-xs mb-4">
          <span class="px-2 py-1 bg-bg border border-border rounded">Laravel</span>
          <span class="px-2 py-1 bg-bg border border-border rounded">MySQL</span>
          <span class="px-2 py-1 bg-bg border border-border rounded">Tailwind</span>
        </div>

        <!-- Action -->
        <a href="#" class="text-primary text-sm font-semibold hover:underline">
          Lihat Detail →
        </a>
      </div>

      <!-- Project Card -->
      <div class="bg-surface border border-border rounded-2xl p-6 hover:-translate-y-2 transition">
        <div class="flex justify-between items-center mb-3">
          <h4 class="text-xl font-semibold">Website Sekolah</h4>
          <span class="text-xs px-2 py-1 rounded bg-warning/20 text-warning">
            Ongoing
          </span>
        </div>

        <p class="text-muted text-sm mb-4">
          Website company profile sekolah dengan desain responsif
          dan admin panel.
        </p>

        <div class="flex flex-wrap gap-2 text-xs mb-4">
          <span class="px-2 py-1 bg-bg border border-border rounded">Laravel</span>
          <span class="px-2 py-1 bg-bg border border-border rounded">Blade</span>
          <span class="px-2 py-1 bg-bg border border-border rounded">CSS</span>
        </div>

        <a href="#" class="text-primary text-sm font-semibold hover:underline">
          Lihat Detail →
        </a>
      </div>

      <!-- Project Card -->
      <div class="bg-surface border border-border rounded-2xl p-6 hover:-translate-y-2 transition">
        <div class="flex justify-between items-center mb-3">
          <h4 class="text-xl font-semibold">REST API Auth</h4>
          <span class="text-xs px-2 py-1 rounded bg-danger/20 text-danger">
            Backend
          </span>
        </div>

        <p class="text-muted text-sm mb-4">
          REST API untuk autentikasi user menggunakan JWT
          dan role-based access.
        </p>

        <div class="flex flex-wrap gap-2 text-xs mb-4">
          <span class="px-2 py-1 bg-bg border border-border rounded">Laravel</span>
          <span class="px-2 py-1 bg-bg border border-border rounded">JWT</span>
          <span class="px-2 py-1 bg-bg border border-border rounded">Postman</span>
        </div>

        <a href="#" class="text-primary text-sm font-semibold hover:underline">
          Lihat Detail →
        </a>
      </div>

    </div>
    <!-- Button Lihat Project Lengkap -->
<div class="mt-16 flex justify-center">
  <a
    href="projects.html"
    class="px-8 py-3 rounded-2xl
           bg-primary text-white font-semibold
           hover:bg-primary/90 transition
           shadow-lg shadow-primary/20"
  >
    Lihat Project Lebih Lengkap →
  </a>
</div>

  </div>
</section>


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
<section id="contact" class="py-20">
  <div class="max-w-xl mx-auto px-6 text-center">
    <h3 class="text-3xl font-bold mb-6 text-primary">Kontak</h3>
    <div class="space-y-3 text-muted">
      <p><i class="fa-solid fa-envelope mr-2"></i> fadlanfirdaus220@gmail.com</p>
      <p><i class="fa-brands fa-github mr-2"></i> github.com/Fadlan079</p>
      <p><i class="fa-solid fa-phone mr-2"></i> 082210732928</p>
      <p><i class="fa-brands fa-instagram mr-2"></i> @fdln007</p>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="py-8 border-t border-border text-center text-muted text-sm">
  <p class="font-semibold text-text">Fadlan Firdaus</p>
  <p>Full Stack Developer • Laravel Enthusiast</p>
  <p class="mt-2">© 2026 All Rights Reserved</p>
</footer>

</body>
</html>
