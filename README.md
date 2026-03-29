<div align="center">

<h1>🗂️ Fadlan — Personal Portfolio</h1>

<p>Full-stack portfolio website built with Laravel, GSAP, and Three.js.<br>Menampilkan proyek, skill tree interaktif, halaman kontak, dan dashboard admin lengkap.</p>

<p>
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel&logoColor=white"/>
  <img src="https://img.shields.io/badge/TailwindCSS-4-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white"/>
  <img src="https://img.shields.io/badge/Vite-7-646CFF?style=flat-square&logo=vite&logoColor=white"/>
  <img src="https://img.shields.io/badge/GSAP-3-88CE02?style=flat-square&logo=greensock&logoColor=white"/>
  <img src="https://img.shields.io/badge/Three.js-0.182-black?style=flat-square&logo=three.js&logoColor=white"/>
  <img src="https://img.shields.io/badge/Alpine.js-3-77C1D2?style=flat-square&logo=alpine.js&logoColor=white"/>
</p>

<p>
  <a href="https://github.com/Fadlan079/Personal-Portfolio">
    <img src="https://img.shields.io/github/last-commit/Fadlan079/Personal-Portfolio?style=flat-square"/>
  </a>
  <img src="https://img.shields.io/badge/license-MIT-green?style=flat-square"/>
</p>

</div>

---

## ✨ Fitur Utama

### 🌐 Public Portfolio
| Halaman | Deskripsi |
|---|---|
| **Home** | Hero section dengan animasi GSAP ribbon & parallax, featured projects carousel 3D (Three.js viewer), skill tree interaktif berbasis SVG |
| **About** | Halaman narasi dengan pin scroll GSAP, nilai & prinsip, constraints text animation |
| **Projects** | Daftar proyek dengan AJAX search, filter tipe, dan paginate tanpa reload; detail modal dengan screenshot lightbox |
| **Contact** | Form kontak dengan pengiriman email via Laravel Mail, social links |

### 🔒 Dashboard Admin
- CRUD project lengkap (judul, deskripsi, tech stack, screenshot, repo, live URL)
- CRUD skill dengan relasi many-to-many ke projects
- Bulk action: publish, delete, restore
- Trash dengan tab Projects & Skills (AJAX), soft delete, bulk restore & force delete
- Upload screenshot ke `storage/`
- Manajemen visibility project: `published` / `scheduled` / `draft`
- **Manajemen Proyek:** Sistem CRUD lengkap dengan pengaturan visibilitas (Draft, Scheduled, Published) dan pengelolaan kategori proyek.
- **Sistem Status Proyek:** Melacak perkembangan setiap proyek melalui status *Prototype*, *In Progress*, atau *Finished*.
- **Sistem Trash & Bulk Action:** Fitur hapus sementara (Soft Delete), pemulihan data, serta aksi massal untuk efisiensi manajemen konten.
- **Manajemen Skill:** Pengaturan keahlian yang terhubung langsung dengan proyek-proyek terkait sehingga data tersinkronisasi secara otomatis.

### 🎨 UI & UX Tingkat Lanjut
- **Sistem Tema Dinamis:** Tersedia tiga pilihan tema visual unik (*Diary*, *Clean*, dan *System Architecture*) yang merubah total tampilan antarmuka secara instan.
- **Mode Gelap/Terang:** Perpindahan mode tampilan yang otomatis mengikuti preferensi sistem atau diatur secara manual melalui pengaturan.
- **Animasi Transisi Halaman:** Transisi antar halaman yang mulus menggunakan efek *glitch-wipe* berbasis GSAP untuk memberikan kesan modern dan futuristik.
- **Multi-Bahasa:** Dukungan penuh Bahasa Indonesia dan Bahasa Inggris (i18n) yang dapat diganti secara instan di seluruh bagian situs.
- **Responsive Design:** Pengalaman pengguna yang dioptimalkan untuk berbagai perangkat mulai dari ponsel hingga desktop resolusi tinggi.

---

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 12** — Framework PHP utama untuk logika server, routing, dan keamanan data tingkat lanjut.
- **Eloquent ORM** — Manajemen database berbasis objek untuk relasi data yang kompleks dengan cara yang elegan.
- **Laravel Breeze** — Sistem autentikasi yang ringan dan aman untuk melindungi area dashboard admin.

### Frontend
Portfolio/
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php         # public pages (home, about, project, contact)
│   │   ├── ProjectController.php      # dashboard CRUD project
│   │   ├── ContactController.php      # kirim email
│   │   └── Dashboard/
│   │       ├── SkillController.php    # CRUD skill
│   │       └── TrashController.php   # trash (project + skill)
│   ├── Models/
│   │   ├── Project.php  (soft delete, scopes: search, filterType, public, recent)
│   │   └── Skill.php    (soft delete, belongsToMany Project)
│   └── Mail/ContactMail.php
├── resources/
│   ├── js/
│   │   ├── app.js                    # entry point, i18n, GSAP init, skeleton removal
│   │   ├── animations/               # hero, about, project, navbar, modal animations
│   │   ├── project/                  # filters.js (AJAX), detail-modal.js, edit-modal.js
│   │   ├── skill-tree.js             # SVG skill tree interaktif
│   │   └── three-viewer.js           # Three.js 3D project viewer
│   ├── css/
│   │   ├── app.css                   # base + custom tokens
│   │   ├── hero.css, project.css     # page-specific styles
│   │   └── contact.css, keyboard.css
│   └── views/
│       ├── layouts/main.blade.php    # layout utama
│       ├── pages/                    # home, about, project, contact
│       ├── components/               # navbar, footer, modals
│       └── dashboard/                # admin views
├── routes/web.php
└── database/migrations/
```

---

## 🚀 Cara Menjalankan

### Requirement
- PHP >= 8.2
- Composer
- Node.js >= 18
- SQLite atau MySQL

### Install

```bash
# Clone repo
git clone https://github.com/Fadlan079/Personal-Portfolio.git
cd Personal-Portfolio

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate --seed

# Storage link (untuk screenshot upload)
php artisan storage:link
```

### Jalankan Development Server

```bash
# Terminal 1 — Laravel
php artisan serve

# Terminal 2 — Vite (HMR)
npm run dev
```

Buka `http://localhost:8000`

### Build Production

```bash
npm run build
```

---

## 🔑 Konfigurasi `.env`

```env
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# atau MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_DATABASE=portfolio
# DB_USERNAME=root
# DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=fadlanfirdaus220@gmail.com
MAIL_FROM_NAME="Fadlan Firdaus"
```

---

## 📸 Halaman Utama

| | |
|---|---|
| Home — Hero & Skill Tree | Projects — AJAX Filter |
| About — Scroll Animation | Contact — Form |

---

## 📄 License

MIT © [Fadlan Firdaus](https://github.com/Fadlan079)
