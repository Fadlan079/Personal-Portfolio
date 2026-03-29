# Fadlan — Portofolio Pribadi

Web portofolio modern yang dibangun dengan Laravel, GSAP, dan Three.js. Proyek ini dirancang untuk menampilkan karya, keahlian, dan perjalanan profesional saya dengan antarmuka yang interaktif dan visual yang menarik.

---

## ✨ Fitur Utama

### 🌐 Halaman Publik
- **Beranda (Home):** Hero section dengan animasi GSAP yang halus, carousel proyek unggulan dalam format 3D, dan *skill tree* interaktif berbasis SVG.
- **Tentang (About):** Halaman narasi perjalanan saya menggunakan animasi *scroll-pin* GSAP untuk pengalaman membaca yang imersif.
- **Proyek (Projects):** Daftar proyek lengkap dengan fitur pencarian AJAX, filter berdasarkan kategori (Website, Application, Design), dan pengurutan tanpa muat ulang halaman. Tersedia juga detail proyek dalam modal dengan galeri foto.
- **Kontak (Contact):** Formulir kontak terintegrasi dengan pengiriman email dan tautan media sosial.

### 🔒 Dashboard Admin
- **Manajemen Proyek:** CRUD (Create, Read, Update, Delete) lengkap untuk proyek, termasuk pengaturan *visibility* (Published, Scheduled, Draft).
- **Sistem Status Proyek:** Melacak perkembangan setiap karya dengan label status: *Prototype*, *In Progress*, atau *Finished*.
- **Manajemen Skill:** Pengaturan keahlian dengan relasi *many-to-many* ke proyek terkait.
- **Fitur Lanjutan:** Aksi massal (bulk action) untuk hapus/publish, sistem tempat sampah (Trash) dengan fitur pemulihan, dan optimasi unggah gambar ke penyimpanan lokal.

### 🎨 UI & UX Tingkat Lanjut
- **Mode Gelap/Terang:** Perpindahan tema yang otomatis mengikuti preferensi sistem atau manual.
- **Tema Beragam:** Tersedia pilihan tema visual yang unik seperti *Diary* (estetika buku tua), *Clean*, dan *System Architecture*.
- **Animasi Imersif:** Penggunaan GSAP ScrollTrigger untuk efek *parallax*, *pinning*, dan transisi antar halaman yang mulus.
- **Elemen Interaktif:** Cursor kustom yang interaktif, interaksi keyboard 3D menggunakan Three.js, dan desain yang sepenuhnya responsif di semua perangkat.
- **Multi-Bahasa:** Dukungan penuh Bahasa Indonesia dan Bahasa Inggris yang bisa diganti secara instan tanpa muat ulang.

---

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 12** — Framework utama untuk logika server, routing, dan manajemen database.
- **Eloquent ORM** — Manajemen database yang efisien dengan relasi kompleks.
- **Laravel Breeze** — Sistem autentikasi untuk keamanan dashboard admin.

### Frontend
## 📸 Halaman Utama

| | |
|---|---|
| Home — Hero & Skill Tree | Projects — AJAX Filter |
| About — Scroll Animation | Contact — Form |

---

## 📄 License

MIT © [Fadlan Firdaus](https://github.com/Fadlan079)
