# Fadlan — Portofolio Pribadi

Web portofolio modern yang dibangun menggunakan framework Laravel dan engine animasi GSAP. Proyek ini dirancang sebagai platform pameran karya, keahlian, dan perjalanan profesional dengan antarmuka yang interaktif, performa yang ringan, dan sistem manajemen konten yang lengkap.

---

## Fitur Utama

### Halaman Publik
- **Beranda (Home):** Hero section dengan animasi GSAP yang dinamis, efek *parallax* pada elemen terapung, lintasan teks berjalan (*marquee*), serta *skill tree* interaktif berbasis SVG.
- **Tentang (About):** Halaman narasi dengan efek *scroll-pinning* dan transisi elemen menggunakan GSAP ScrollTrigger untuk pengalaman membaca yang lebih hidup.
- **Proyek (Projects):** Galeri proyek lengkap dengan fitur pencarian dan filter kategori (Website, App, Design) menggunakan AJAX (HTMX) untuk navigasi cepat tanpa muat ulang halaman.
- **Kontak (Contact):** Formulir kontak yang terintegrasi dengan sistem pengiriman email dan tautan media sosial.

### Dashboard Admin (CMS)
- **Manajemen Proyek:** Sistem CRUD lengkap dengan pengaturan visibilitas (Draft, Scheduled, Published) dan pengelolaan kategori proyek.
- **Sistem Status Proyek:** Melacak perkembangan setiap proyek melalui status *Prototype*, *In Progress*, atau *Finished*.
- **Manajemen Skill:** Pengaturan keahlian yang terhubung langsung dengan proyek-proyek terkait sehingga data tersinkronisasi secara otomatis.
- **Sistem Trash & Bulk Action:** Fitur hapus sementara (Soft Delete), pemulihan data, serta aksi massal untuk efisiensi manajemen konten.

### UI & UX Tingkat Lanjut
- **Sistem Tema Dinamis:** Tersedia tiga pilihan tema visual unik (*Diary*, *Clean*, dan *System Architecture*) yang merubah total tampilan antarmuka secara instan.
- **Mode Gelap/Terang:** Perpindahan mode tampilan yang otomatis mengikuti preferensi sistem atau diatur secara manual melalui pengaturan.
- **Animasi Transisi Halaman:** Transisi antar halaman yang mulus dan elegan menggunakan efek *glitch-wipe* berbasis GSAP untuk kesan modern.
- **Multi-Bahasa (i18n):** Dukungan penuh Bahasa Indonesia dan Bahasa Inggris yang dapat diganti secara instan di seluruh bagian situs.
- **Desain Responsif:** Pengalaman pengguna yang dioptimalkan untuk berbagai ukuran perangkat, mulai dari ponsel hingga desktop resolusi tinggi.

---

## Teknologi yang Digunakan

### Backend
- **Laravel 12** — Framework PHP utama untuk logika server, routing, dan keamanan data.
- **Eloquent ORM** — Manajemen database berbasis objek untuk relasi data yang kompleks.
- **Laravel Breeze** — Sistem autentikasi untuk melindungi area dashboard admin.

### Frontend
- **Tailwind CSS v4** — Framework CSS terbaru (utility-first) untuk pembangunan antarmuka yang cepat dan modern.
- **GSAP 3 + ScrollTrigger** — Inti dari seluruh animasi scroll, *tweening*, dan interaksi visual di situs.
- **Alpine.js** — Memberikan logika reaktif pada komponen UI tanpa beban performa yang berat.
- **HTMX** — Memungkinkan interaksi AJAX yang responsif langsung melalui atribut HTML.
- **Vite 7** — Alat bantu pengembangan (bundler) generasi terbaru untuk aset yang optimal.

---

## Lisensi

Proyek ini berada di bawah lisensi MIT. Hak cipta © 2026 Fadlan Firdaus.

---

*Catatan: Ini adalah proyek portofolio pribadi dan tidak ditujukan untuk instalasi publik oleh orang lain.*
