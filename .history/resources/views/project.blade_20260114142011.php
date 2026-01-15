<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Projects | Fadlan</title>

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
    .tag {
  padding: 0.25rem 0.5rem;
  background: var(--color-bg);
  border: 1px solid var(--color-border);
  border-radius: 0.375rem;
}

  </style>
</head>

<body class="bg-bg text-text">

<!-- Navbar -->
<nav class="fixed w-full bg-bg/80 backdrop-blur border-b border-border z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <a href="index.html" class="text-xl font-bold text-primary">Fadlan.dev</a>
    <ul class="flex gap-6 text-sm">
      <li><a href="index.html" class="hover:text-primary">Home</a></li>
      <li><a href="projects.html" class="text-primary font-semibold">Projects</a></li>
      <li><a href="index.html#contact" class="hover:text-primary">Contact</a></li>
    </ul>
  </div>
</nav>

<!-- Header -->
<header class="pt-32 pb-16 text-center">
  <h1 class="text-4xl md:text-5xl font-extrabold mb-4">
    My <span class="text-primary">Projects</span>
  </h1>
  <p class="text-muted max-w-2xl mx-auto">
    Kumpulan project yang pernah saya kerjakan sebagai
    <strong>Full Stack Developer</strong>
  </p>
</header>

<!-- Filter -->
<section class="pb-10">
  <div class="max-w-6xl mx-auto px-6 flex justify-center gap-4 flex-wrap">
    <button class="px-4 py-2 bg-primary text-white rounded-lg text-sm">All</button>
    <button class="px-4 py-2 bg-surface border border-border rounded-lg text-sm hover:text-primary">Backend</button>
    <button class="px-4 py-2 bg-surface border border-border rounded-lg text-sm hover:text-primary">Frontend</button>
    <button class="px-4 py-2 bg-surface border border-border rounded-lg text-sm hover:text-primary">API</button>
  </div>
</section>

<!-- Projects List -->
<section class="pb-20">
  <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-8">

    <!-- 1 -->
    <div class="bg-surface border border-border rounded-2xl p-6 hover:-translate-y-2 transition">
      <div class="flex justify-between items-center mb-3">
        <h3 class="text-xl font-semibold">Sistem Kasir</h3>
        <span class="text-xs px-2 py-1 rounded bg-success/20 text-success">Finished</span>
      </div>
      <p class="text-muted text-sm mb-4">
        Aplikasi kasir berbasis web untuk manajemen produk dan laporan.
      </p>
      <div class="flex flex-wrap gap-2 text-xs mb-4">
        <span class="tag">Laravel</span><span class="tag">MySQL</span><span class="tag">Tailwind</span>
      </div>
      <div class="flex justify-between text-sm">
        <span class="text-muted"><i class="fa-solid fa-code mr-1"></i> Backend</span>
        <a href="#" class="text-primary font-semibold hover:underline">Detail →</a>
      </div>
    </div>

    <!-- 2 -->
    <div class="bg-surface border border-border rounded-2xl p-6 hover:-translate-y-2 transition">
      <div class="flex justify-between items-center mb-3">
        <h3 class="text-xl font-semibold">Website Sekolah</h3>
        <span class="text-xs px-2 py-1 rounded bg-warning/20 text-warning">Ongoing</span>
      </div>
      <p class="text-muted text-sm mb-4">
        Company profile sekolah dengan admin panel.
      </p>
      <div class="flex flex-wrap gap-2 text-xs mb-4">
        <span class="tag">Laravel</span><span class="tag">Blade</span><span class="tag">CSS</span>
      </div>
      <div class="flex justify-between text-sm">
        <span class="text-muted"><i class="fa-solid fa-laptop-code mr-1"></i> Full Stack</span>
        <a href="#" class="text-primary font-semibold hover:underline">Detail →</a>
      </div>
    </div>

    <!-- 3 -->
    <div class="bg-surface border border-border rounded-2xl p-6 hover:-translate-y-2 transition">
      <div class="flex justify-between items-center mb-3">
        <h3 class="text-xl font-semibold">REST API Auth</h3>
        <span class="text-xs px-2 py-1 rounded bg-danger/20 text-danger">API</span>
      </div>
      <p class="text-muted text-sm mb-4">
        API autentikasi JWT & role-based access.
      </p>
      <div class="flex flex-wrap gap-2 text-xs mb-4">
        <span class="tag">Laravel</span><span class="tag">JWT</span><span class="tag">Postman</span>
      </div>
      <div class="flex justify-between text-sm">
        <span class="text-muted"><i class="fa-solid fa-server mr-1"></i> Backend</span>
        <a href="#" class="text-primary font-semibold hover:underline">Detail →</a>
      </div>
    </div>

    <!-- 4 -->
    <div class="bg-surface border border-border rounded-2xl p-6 hover:-translate-y-2 transition">
      <h3 class="text-xl font-semibold mb-3">Sistem Absensi</h3>
      <p class="text-muted text-sm mb-4">
        Sistem absensi siswa berbasis web.
      </p>
      <div class="flex flex-wrap gap-2 text-xs mb-4">
        <span class="tag">Laravel</span><span class="tag">MySQL</span>
      </div>
      <span class="text-muted text-sm"><i class="fa-solid fa-user-check mr-1"></i> Backend</span>
    </div>

    <!-- 5 -->
    <div class="bg-surface border border-border rounded-2xl p-6 hover:-translate-y-2 transition">
      <h3 class="text-xl font-semibold mb-3">Blog Pribadi</h3>
      <p class="text-muted text-sm mb-4">
        Blog sederhana dengan sistem CRUD.
      </p>
      <div class="flex flex-wrap gap-2 text-xs mb-4">
        <span class="tag">Laravel</span><span class="tag">Blade</span>
      </div>
      <span class="text-muted text-sm"><i class="fa-solid fa-pen-nib mr-1"></i> Full Stack</span>
    </div>

    <!-- 6 -->
    <div class="bg-surface border border-border rounded-2xl p-6 hover:-translate-y-2 transition">
      <h3 class="text-xl font-semibold mb-3">Landing Page Produk</h3>
      <p class="text-muted text-sm mb-4">
        Landing page promosi produk digital.
      </p>
      <div class="flex flex-wrap gap-2 text-xs mb-4">
        <span class="tag">HTML</span><span class="tag">Tailwind</span>
      </div>
      <span class="text-muted text-sm"><i class="fa-solid fa-paintbrush mr-1"></i> Frontend</span>
    </div>

    <!-- 7 -->
    <div class="bg-surface border border-border rounded-2xl p-6 hover:-translate-y-2 transition">
      <h3 class="text-xl font-semibold mb-3">Manajemen User</h3>
      <p class="text-muted text-sm mb-4">
        Sistem role & permission user.
      </p>
      <div class="flex flex-wrap gap-2 text-xs mb-4">
        <span class="tag">Laravel</span><span class="tag">RBAC</span>
      </div>
      <span class="text-muted text-sm"><i class="fa-solid fa-users mr-1"></i> Backend</span>
    </div>

    <!-- 8 -->
    <div class="bg-surface border border-border rounded-2xl p-6 hover:-translate-y-2 transition">
      <h3 class="text-xl font-semibold mb-3">API Produk</h3>
      <p class="text-muted text-sm mb-4">
        REST API untuk data produk.
      </p>
      <div class="flex flex-wrap gap-2 text-xs mb-4">
        <span class="tag">Laravel</span><span class="tag">REST API</span>
      </div>
      <span class="text-muted text-sm"><i class="fa-solid fa-plug mr-1"></i> API</span>
    </div>

    <!-- 9 -->
    <div class="bg-surface border border-border rounded-2xl p-6 hover:-translate-y-2 transition">
      <h3 class="text-xl font-semibold mb-3">Portfolio Website</h3>
      <p class="text-muted text-sm mb-4">
        Website portfolio pribadi.
      </p>
      <div class="flex flex-wrap gap-2 text-xs mb-4">
        <span class="tag">Tailwind</span><span class="tag">HTML</span>
      </div>
      <span class="text-muted text-sm"><i class="fa-solid fa-id-card mr-1"></i> Frontend</span>
    </div>

  </div>
</section>


<!-- Footer -->
<footer class="border-t border-border py-8 text-center text-muted text-sm">
  <p class="font-semibold text-text">Fadlan Firdaus</p>
  <p>Full Stack Developer • Laravel Enthusiast</p>
  <p class="mt-2">© 2026 All Rights Reserved</p>
</footer>

</body>
</html>
