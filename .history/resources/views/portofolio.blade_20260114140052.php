<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portfolio | Fadlan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100">

  <!-- Navbar -->
  <nav class="fixed w-full bg-slate-900/80 backdrop-blur border-b border-slate-700 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-xl font-bold text-cyan-400">Fadlan.dev</h1>
      <ul class="flex gap-6 text-sm">
        <li><a href="#home" class="hover:text-cyan-400">Home</a></li>
        <li><a href="#about" class="hover:text-cyan-400">About</a></li>
        <li><a href="#projects" class="hover:text-cyan-400">Projects</a></li>
        <li><a href="#contact" class="hover:text-cyan-400">Contact</a></li>
      </ul>
    </div>
  </nav>

  <!-- Hero -->
  <section id="home" class="min-h-screen flex items-center justify-center text-center px-6">
    <div>
      <h2 class="text-4xl md:text-6xl font-extrabold mb-4">Hi, Saya <span class="text-cyan-400">Fadlan</span></h2>
      <p class="text-slate-400 max-w-xl mx-auto mb-6">Web Developer | Backend & Laravel Enthusiast | Linux Server</p>
      <a href="#projects" class="inline-block px-6 py-3 bg-cyan-500 text-slate-900 font-semibold rounded-xl hover:bg-cyan-400 transition">Lihat Project</a>
    </div>
  </section>

  <!-- About -->
  <section id="about" class="py-20 bg-slate-800">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
      <div>
        <h3 class="text-3xl font-bold mb-4 text-cyan-400">Tentang Saya</h3>
        <p class="text-slate-300 leading-relaxed">
          Saya seorang pelajar SMK jurusan PPLG yang fokus pada pengembangan web,
          backend Laravel, database MySQL, dan setup server Linux.
          Saya suka membangun aplikasi yang rapi, aman, dan scalable.
        </p>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div class="p-4 bg-slate-700 rounded-xl text-center">Laravel</div>
        <div class="p-4 bg-slate-700 rounded-xl text-center">MySQL</div>
        <div class="p-4 bg-slate-700 rounded-xl text-center">Tailwind</div>
        <div class="p-4 bg-slate-700 rounded-xl text-center">Linux Server</div>
      </div>
    </div>
  </section>

  <!-- Projects -->
  <section id="projects" class="py-20">
    <div class="max-w-7xl mx-auto px-6">
      <h3 class="text-3xl font-bold text-center mb-12 text-cyan-400">Project</h3>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-slate-800 rounded-2xl p-6 hover:-translate-y-2 transition">
          <h4 class="text-xl font-semibold mb-2">Sistem Kasir</h4>
          <p class="text-slate-400 text-sm">Aplikasi kasir berbasis Laravel & MySQL.</p>
        </div>
        <div class="bg-slate-800 rounded-2xl p-6 hover:-translate-y-2 transition">
          <h4 class="text-xl font-semibold mb-2">Website Sekolah</h4>
          <p class="text-slate-400 text-sm">Company profile sekolah responsif.</p>
        </div>
        <div class="bg-slate-800 rounded-2xl p-6 hover:-translate-y-2 transition">
          <h4 class="text-xl font-semibold mb-2">API Auth</h4>
          <p class="text-slate-400 text-sm">REST API login JWT & role management.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section id="contact" class="py-20 bg-slate-800">
    <div class="max-w-xl mx-auto px-6 text-center">
      <h3 class="text-3xl font-bold mb-4 text-cyan-400">Kontak</h3>
      <p class="text-slate-400 mb-6">Tertarik bekerja sama atau ingin diskusi?</p>
      <a href="mailto:emailkamu@gmail.com" class="px-6 py-3 bg-cyan-500 text-slate-900 rounded-xl font-semibold hover:bg-cyan-400">Email Saya</a>
    </div>
  </section>

  <footer class="py-6 text-center text-slate-500 text-sm">
    © 2026 Fadlan. All rights reserved.
  </footer>

</body>
</html>
