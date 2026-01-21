<div class="max-w-6xl mx-auto px-6">
  <h3 data-i18n="skills" class="text-3xl font-bold mb-12 text-primary text-center"></h3>
  
    <div class="hidden">
        <span class="text-yellow-400 bg-yellow-400/10"></span>
        <span class="text-blue-500 bg-blue-500/10"></span>
        <span class="text-indigo-500 bg-indigo-500/10"></span>
        <span class="text-amber-500 bg-amber-500/10"></span>
        <span class="text-sky-500 bg-sky-500/10"></span>
        <span class="text-orange-500 bg-orange-500/10"></span>
        <span class="text-red-500 bg-red-500/10"></span>
    </div>

  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    <x-skill-card
      icon="fa-brands fa-laravel"
      title="Laravel"
      subtitle="Digunakan sebagai backend utama"
      badge="Pengembangan web berbasis MVC"
      color="red-500"
      :items="[
        'Autentikasi & manajemen user',
        'CRUD & validasi data',
        'REST API dasar',
        'Integrasi database MySQL',
      ]"
    />

    <x-skill-card
      icon="fa-brands fa-php"
      title="PHP (Native)"
      subtitle="Digunakan untuk logika backend"
      badge="Fondasi logika backend"
      color="indigo-500"
      :items="[
        'CRUD & Pengolahan data',
        'Session & Autentikasi',
        'Validasi form & request',
        'Integrasi database MySQL',
      ]"
    />

    <x-skill-card
      icon="fa-solid fa-database"
      title="MySQL"
      subtitle="Manajemen databse relasional"
      badge="Manajemen data applikasi"
      color="blue-500"
      :items="[
        'Query CRUD & filtering data',
        'Perancangan struktur tabel & relasi',
        'Integrasi dengan backend PHP & Laravel',
        'Pemahaman normalisasi data & anomali',
      ]"
    />

    <x-skill-card
      icon="fa-brands fa-html5"
      title="HTML"
      subtitle="Struktur halaman web"
      badge="Fondasi struktur frontend"
      color="orange-500"
      :items="[
        'Struktur semantik HTML',
        'Integrasi dengan CSS & JavaScript',
        'Optimasi struktur untuk SEO dasar',
        'Pemisahan konten & presentasi',
      ]"
    />

    <x-skill-card
      icon="fa-brands fa-css3-alt"
      title="CSS"
      subtitle="Styling layout antarmuka"
      badge="Responsive & UI styling"
      color="sky-500"
      :items="[
        'Responsive layout dengan TailwindCSS',
        'Penggunaan komponen Bootstrap',
        'Pengaturan spacing, warna, dan tipografi',
        'Konsistensi UI antar halaman',
      ]"
    />

    <x-skill-card
      icon="fa-brands fa-js"
      title="JavaScript"
      subtitle="Interaksi sisi klien"
      badge="Frontend interactivity"
      color="yellow-400"
      :items="[
        'Manipulasi DOM',
        'Validasi form sederhana',
        'Interaksi UI dinamis',
        'Integrasi dengan backend',
      ]"
    />

    <x-skill-card
      icon="fa-brands fa-python"
      title="Python"
      subtitle="Scripting & logika dasar"
      badge="Automation ringan"
      color="blue-500"
      :items="[
        'Dasar pemprograman python',
        'Pengolahan data sedderhana',
        'Eksperimen logika & automasi kecil',
        'Eksplorasi library sesuai kebutuhan ',
      ]"
    />

    <x-skill-card
      icon="fa-brands fa-linux"
      title="Linux"
      subtitle="lingkungan server & deployment"
      badge="Server environment"
      color="amber-500"
      :items="[
        'Manajemen file & permission',
        'Konfigurasi web server dasar',
        'Deployment applikasi web',
        'Penggunaan terminal',
      ]"
    />
  </div>
</div>
