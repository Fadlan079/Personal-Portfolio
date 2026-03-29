# Fadlan — Portofolio Pribadi

Web portofolio modern yang dibangun dengan Laravel dan GSAP. Proyek ini dirancang untuk menampilkan karya, keahlian, dan perjalanan profesional saya dengan antarmuka yang interaktif, animasi yang halus, dan sistem manajemen konten yang lengkap.

---

## ✨ Fitur Utama

### 🌐 Halaman Publik
- **Beranda (Home):** Hero section dengan animasi GSAP yang dinamis, efek *parallax* pada elemen terapung, lintasan teks berjalan (*marquee*), dan *skill tree* interaktif berbasis SVG.
- **Tentang (About):** Halaman narasi dengan efek *scroll-pinning* dan transisi elemen menggunakan GSAP ScrollTrigger untuk pengalaman membaca yang lebih hidup.
- **Proyek (Projects):** Galeri proyek dengan fitur pencarian dan filter kategori (Website, App, Design) menggunakan AJAX (HTMX) untuk navigasi tanpa muat ulang. Detail proyek ditampilkan dalam modal interaktif.
- **Kontak (Contact):** Formulir kontak yang terintegrasi dengan pengiriman email dan tautan media sosial.

### 🔒 Dashboard Admin
- **Manajemen Proyek:** Sistem CRUD lengkap dengan pengaturan visibilitas (Draft, Scheduled, Published) dan pengelolaan kategori proyek.
- **Sistem Status Proyek:** Melacak perkembangan setiap proyek melalui status *Prototype*, *In Progress*, atau *Finished*.
- **Sistem Trash & Bulk Action:** Fitur hapus sementara (Soft Delete), pemulihan data, serta aksi massal untuk efisiensi manajemen konten.
- **Manajemen Skill:** Pengaturan keahlian yang terhubung langsung dengan proyek-proyek terkait.

### 🎨 UI & UX Tingkat Lanjut
- **Sistem Tema Dinamis:** Tersedia tiga pilihan tema visual unik (*Diary*, *Clean*, dan *System Architecture*) yang merubah total tampilan antarmuka.
- **Mode Gelap/Terang:** Perpindahan mode tampilan yang otomatis mengikuti preferensi sistem atau diatur secara manual.
- **Animasi Transisi Halaman:** Transisi antar halaman yang mulus menggunakan efek *glitch-wipe* berbasis GSAP untuk kesan modern.
- **Multi-Bahasa:** Dukungan penuh Bahasa Indonesia dan Bahasa Inggris yang dapat diganti secara instan di seluruh bagian situs.
- **Responsive Design:** Pengalaman pengguna yang dioptimalkan untuk berbagai perangkat mulai dari ponsel hingga desktop.

---

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 12** — Framework utama untuk logika server, routing, dan keamanan data.
- **Eloquent ORM** — Manajemen database berbasis objek untuk relasi data yang kompleks.
- **Laravel Breeze** — Sistem autentikasi untuk melindungi dashboard admin.

### Frontend
- **Tailwind CSS v4** — Framework CSS terbaru untuk pembangunan antarmuka yang cepat dan modern.
- **GSAP 3 + ScrollTrigger** — Inti dari seluruh animasi scroll, *tweening*, dan interaksi visual di situs.
- **Alpine.js** — Memberikan logika reaktif pada komponen UI tanpa beban performa yang berat.
- **HTMX** — Memungkinkan interaksi AJAX yang cepat langsung melalui atribut HTML.
- **Vite 7** — Alat bantu pengembangan (bundler) generasi terbaru untuk performa yang sangat cepat.

---

## 📁 Struktur Proyek

- `app/Http/Controllers/` — Logika untuk fitur publik dan dashboard admin.
- `resources/js/animations/` — Kumpulan skrip animasi khusus untuk setiap bagian halaman.
- `resources/views/themes/` — Struktur template Blade yang mendukung sistem multi-tema.
- `resources/css/` — Gaya kustom dan token desain yang terintegrasi dengan Tailwind.
- `routes/web.php` — Semua rute navigasi aplikasi.

---

## 📄 Lisensi

Proyek ini berada di bawah lisensi MIT. Hak cipta © 2026 Fadlan Firdaus.

---

*Catatan: Ini adalah proyek portofolio pribadi dan tidak ditujukan untuk instalasi publik.*
