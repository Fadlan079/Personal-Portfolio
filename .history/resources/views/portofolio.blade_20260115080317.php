<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portfolio | Fadlan</title>
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

    /* ===== Custom Scrollbar ===== */

/* Firefox */
* {
  scrollbar-width: thin;
  scrollbar-color: #ef4444 transparent; /* merah tailwind red-500 */
}

/* Chrome, Edge, Safari */
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
  ); /* gradasi merah */
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
        <a href="#projects">Project</a>
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
<section
  id="home"
  class="relative min-h-screen flex items-center px-6 overflow-hidden"
>
<!-- Glow Background -->
<div class="absolute inset-0 -z-10 overflow-hidden">
  <!-- Left Top Glow -->
  <div
    class="absolute -top-32 -left-32
           w-[420px] h-[420px]
           bg-primary/25
           blur-[140px]
           rounded-full">
  </div>

  <!-- Right Bottom Glow -->
  <div
    class="absolute -bottom-32 -right-32
           w-[500px] h-[500px]
           bg-primary/20
           blur-[160px]
           rounded-full">
  </div>
</div>


  <div class="max-w-7xl mx-auto w-full grid lg:grid-cols-2 gap-12 items-center">

    <!-- LEFT : TEXT -->
    <div class="text-center lg:text-left">
      <!-- Badge -->
      <span
        class="inline-flex items-center gap-2 px-4 py-1 mb-6
               rounded-full border border-border bg-surface
               text-sm text-muted"
      >
        <i class="fa-solid fa-code text-primary"></i>
        Available for Collaboration
      </span>

      <!-- Title -->
      <h2 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight">
        Hi, Saya
        <span
          class="bg-gradient-to-r from-primary to-red-400
                 bg-clip-text text-transparent"
        >
          Fadlan
        </span>
        <br />
        <span class="text-3xl md:text-4xl text-muted font-semibold">
          Full Stack Developer
        </span>
      </h2>

      <!-- Description -->
      <p class="text-muted max-w-xl mb-8 leading-relaxed">
        Fokus membangun aplikasi web modern menggunakan
        <strong class="text-text">Laravel</strong>,
        backend rapi, frontend responsif,
        serta deployment di
        <strong class="text-text">Linux Server</strong>.
      </p>

      <!-- CTA -->
      <div class="flex gap-4 flex-wrap justify-center lg:justify-start">
        <a
          href="#projects"
          class="px-7 py-3 rounded-xl bg-primary text-white font-semibold
                 hover:opacity-90 transition shadow-lg shadow-primary/30"
        >
          Lihat Project
        </a>

        <a
          href="#contact"
          class="px-7 py-3 rounded-xl border border-border
                 hover:border-primary hover:text-primary transition"
        >
          Kontak Saya
        </a>
      </div>

      <!-- Social Media -->
<div class="mt-8 flex gap-4 justify-center lg:justify-start">
  <!-- GitHub -->
  <a href="https://github.com/Fadlan079" target="_blank"
     class="w-11 h-11 rounded-xl border border-border
            flex items-center justify-center
            text-muted hover:text-primary hover:border-primary
            hover:shadow-lg hover:shadow-primary/30
            transition">
    <i class="fa-brands fa-github text-lg"></i>
  </a>

  <!-- Instagram -->
  <a href="https://instagram.com/fdln007" target="_blank"
     class="w-11 h-11 rounded-xl border border-border
            flex items-center justify-center
            text-muted hover:text-primary hover:border-primary
            hover:shadow-lg hover:shadow-primary/30
            transition">
    <i class="fa-brands fa-instagram text-lg"></i>
  </a>

  <!-- Email -->
  <a href="mailto:fadlanfirdaus220@gmail.com"
     class="w-11 h-11 rounded-xl border border-border
            flex items-center justify-center
            text-muted hover:text-primary hover:border-primary
            hover:shadow-lg hover:shadow-primary/30
            transition">
    <i class="fa-solid fa-envelope text-lg"></i>
  </a>

  <!-- WhatsApp -->
  <a href="https://wa.me/6282210732928" target="_blank"
     class="w-11 h-11 rounded-xl border border-border
            flex items-center justify-center
            text-muted hover:text-primary hover:border-primary
            hover:shadow-lg hover:shadow-primary/30
            transition">
    <i class="fa-brands fa-whatsapp text-lg"></i>
  </a>
</div>


      <!-- Tech Stack -->
      <div class="mt-10 flex gap-6 text-muted text-sm flex-wrap
                  justify-center lg:justify-start">
        <span class="flex items-center gap-2">
          <i class="fa-brands fa-laravel text-primary"></i> Laravel
        </span>
        <span class="flex items-center gap-2">
          <i class="fa-solid fa-database"></i> MySQL
        </span>
        <span class="flex items-center gap-2">
          <i class="fa-brands fa-linux"></i> Linux
        </span>
        <span class="flex items-center gap-2">
          <i class="fa-brands fa-html5"></i> Tailwind
        </span>
      </div>
    </div>

    <!-- RIGHT : PHOTO -->
    <div class="relative flex justify-center">
      <!-- Glow -->
      <div
        class="absolute -inset-4 rounded-full
               bg-primary/30 blur-3xl"
      ></div>

      <!-- Frame -->
      <div
        class="relative w-72 h-72 md:w-80 md:h-80
               rounded-3xl overflow-hidden
               border border-border
               bg-surface shadow-xl"
      >
        <!-- GANTI src FOTO -->
        <img
          src="profil.jpg"
          alt="Fadlan"
          class="w-full h-full object-cover"
        />
      </div>
    </div>

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

<!-- Education -->
<section id="education" class="py-24 bg-bg">
  <div class="max-w-6xl mx-auto px-6">

    <!-- Heading -->
    <div class="mb-16 text-center">
      <h3 class="text-4xl font-extrabold">
        Pendidikan
        <span class="text-primary">Saya</span>
      </h3>
      <p class="text-muted mt-3 max-w-2xl mx-auto">
        Latar belakang pendidikan yang membentuk skill teknis
        dan minat saya di dunia pengembangan web.
      </p>
    </div>

    <!-- Timeline Wrapper -->
    <div class="relative pl-8 md:pl-12">

      <!-- Vertical Line -->
      <div class="absolute left-3 top-0 h-full w-[2px] bg-border"></div>

      <!-- Item -->
      <div class="relative mb-12">
        <!-- Dot -->
        <div class="absolute -left-[2px] top-2">
          <span
            class="block w-4 h-4 rounded-full bg-primary
                   shadow-lg shadow-primary/40">
          </span>
        </div>

        <!-- Card -->
        <div
          class="bg-surface border border-border rounded-2xl p-6
                 hover:-translate-y-1 transition"
        >
          <div class="flex flex-wrap items-center gap-3 mb-2">
            <h4 class="text-xl font-semibold">
              SMK – PPLG (Pengembangan Perangkat Lunak & Gim)
            </h4>
            <span
              class="text-xs px-3 py-1 rounded-full
                     bg-success/20 text-success"
            >
              Aktif
            </span>
          </div>

          <p class="text-sm text-muted mb-3">
            2023 – Sekarang
          </p>

          <p class="text-muted leading-relaxed">
            Mendalami pengembangan web modern dengan
            <strong class="text-text">Laravel</strong>,
            REST API, database MySQL, Tailwind CSS,
            serta deployment ke Linux server.
          </p>
        </div>
      </div>

      <!-- Item -->
      <div class="relative mb-12">
        <!-- Dot -->
        <div class="absolute -left-[2px] top-2">
          <span
            class="block w-4 h-4 rounded-full bg-primary/70
                   shadow-lg shadow-primary/30">
          </span>
        </div>

        <!-- Card -->
        <div
          class="bg-surface border border-border rounded-2xl p-6
                 hover:-translate-y-1 transition"
        >
          <h4 class="text-xl font-semibold mb-1">
            Sekolah Menengah Pertama (SMP)
          </h4>

          <p class="text-sm text-muted mb-3">
            2020 – 2023
          </p>

          <p class="text-muted leading-relaxed">
            Mulai tertarik dengan dunia IT, komputer,
            dan belajar logika pemrograman dasar secara mandiri.
          </p>
        </div>
      </div>

      <!-- Item -->
      <div class="relative">
        <!-- Dot -->
        <div class="absolute -left-[2px] top-2">
          <span
            class="block w-4 h-4 rounded-full bg-primary/40
                   shadow-lg shadow-primary/20">
          </span>
        </div>

        <!-- Card -->
        <div
          class="bg-surface border border-border rounded-2xl p-6
                 hover:-translate-y-1 transition"
        >
          <h4 class="text-xl font-semibold mb-1">
            Sekolah Dasar (SD)
          </h4>

          <p class="text-sm text-muted mb-3">
            2014 – 2020
          </p>

          <p class="text-muted leading-relaxed">
            Pendidikan dasar dan awal mengenal komputer
            serta teknologi digital.
          </p>
        </div>
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
    <h4 class="text-xl font-semibold">Sistem Manajemen Parkir</h4>
    <span class="text-xs px-2 py-1 rounded bg-success/20 text-success">
      Finished
    </span>
  </div>

  <p class="text-muted text-sm mb-4">
    Aplikasi manajemen parkir berbasis web untuk pencatatan kendaraan,
    monitoring slot parkir, dan laporan transaksi parkir.
  </p>

  <!-- Tech Stack -->
  <div class="flex flex-wrap gap-2 text-xs mb-4">
    <span class="px-2 py-1 bg-bg border border-border rounded">Laravel</span>
    <span class="px-2 py-1 bg-bg border border-border rounded">MySQL</span>
    <span class="px-2 py-1 bg-bg border border-border rounded">Tailwind</span>
  </div>

  <!-- Action -->
  <a href="https://github.com/Fadlan079/Sistem-Manajemen-Parkir.git" class="text-primary text-sm font-semibold hover:underline">
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
        href="project"
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


<!-- Footer -->
<footer class="relative border-t border-border bg-bg">
  <!-- Glow -->
  <div class="absolute inset-0 -z-10">
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2
                w-[400px] h-[400px]
                bg-primary/20 blur-[120px] rounded-full"></div>
  </div>

  <div class="max-w-7xl mx-auto px-6 py-14 grid gap-10 md:grid-cols-3">

    <!-- Brand -->
    <div>
      <h3 class="text-xl font-bold text-primary mb-3">Fadlan.dev</h3>
      <p class="text-muted leading-relaxed">
        Full Stack Developer yang fokus pada pengembangan
        aplikasi web modern menggunakan Laravel,
        frontend responsif, dan backend yang scalable.
      </p>
    </div>

    <!-- Quick Links -->
    <div>
      <h4 class="font-semibold mb-4 text-text">Quick Links</h4>
      <ul class="space-y-2 text-muted text-sm">
        <li>
          <a href="#home" class="hover:text-primary transition">Home</a>
        </li>
        <li>
          <a href="#projects" class="hover:text-primary transition">Projects</a>
        </li>
        <li>
          <a href="#contact" class="hover:text-primary transition">Contact</a>
        </li>
      </ul>
    </div>

    <!-- Social -->
    <div>
      <h4 class="font-semibold mb-4 text-text">Connect</h4>
      <div class="flex gap-4">
        <a href="https://github.com/Fadlan079" target="_blank"
           class="w-10 h-10 rounded-xl border border-border
                  flex items-center justify-center
                  text-muted hover:text-primary hover:border-primary
                  transition">
          <i class="fa-brands fa-github"></i>
        </a>
        <a href="https://instagram.com/fdln007" target="_blank"
           class="w-10 h-10 rounded-xl border border-border
                  flex items-center justify-center
                  text-muted hover:text-primary hover:border-primary
                  transition">
          <i class="fa-brands fa-instagram"></i>
        </a>
        <a href="mailto:fadlanfirdaus220@gmail.com"
           class="w-10 h-10 rounded-xl border border-border
                  flex items-center justify-center
                  text-muted hover:text-primary hover:border-primary
                  transition">
          <i class="fa-solid fa-envelope"></i>
        </a>
      </div>
    </div>

  </div>

  <!-- Bottom -->
  <div class="border-t border-border text-center py-4 text-muted text-sm">
    © 2026 <span class="text-text font-semibold">Fadlan Firdaus</span>.
    Built with <span class="text-primary">Laravel</span> & Tailwind CSS.
  </div>
</footer>


</body>
</html>
