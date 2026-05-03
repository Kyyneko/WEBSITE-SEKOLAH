# Website Sekolah 

[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-^8.1-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=flat&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Vite](https://img.shields.io/badge/Vite-Bundler-646CFF?style=flat&logo=vite&logoColor=white)](https://vitejs.dev/)

Portal informasi resmi sekolah berbasis web, dengan dashboard admin dan guru untuk mengelola konten, artikel, data guru, dokumen perangkat pembelajaran, hingga informasi ekstrakurikuler.

---

## ✨ Fitur Utama

### 🌐 Portal Publik (Frontend)

#### **Beranda / Homepage**
- Hero section dan carousel gambar
- Statistik singkat dan deskripsi sekolah
- Section artikel dan iklan/banner sekolah

#### **Profil Sekolah**
- Informasi singkat tentang sekolah dan alamat

#### **Fasilitas**
- Halaman khusus untuk menampilkan fasilitas sekolah

#### **Prestasi**
- Halaman untuk menampilkan prestasi siswa/sekolah

#### **Artikel & Berita**
- Listing semua artikel
- Detail artikel per slug (`/article/{slug}`)

#### **Ekstrakurikuler & Organisasi**
- Daftar organisasi/ekskul yang dikelola dari backend

#### **Warga Sekolah**
- Data guru (`/wargaSekolah/dataGuru`)
- Data staff (`/wargaSekolah/dataStaff`)
- Alumni (`/wargaSekolah/alumni`)

> **Catatan:** Beberapa view menggunakan data dummy (lorem ipsum & placeholder) untuk keperluan desain UI. Data tersebut dapat diganti dengan data asli dari database.

---

### 🎛️ Dashboard Admin & Guru (Backend)

Akses dashboard memerlukan login & verifikasi email.

#### **Manajemen Pengguna**
- Role utama: **Admin** dan **Teacher (Guru)**
- Fitur Admin:
  - Melihat daftar pengguna (guru & admin)
  - Menambah pengguna baru dengan pemilihan mata pelajaran
  - Edit data pengguna (nama, email, role, mata pelajaran)
  - Reset / ubah password
  - Hapus pengguna

#### **Manajemen Artikel**
- CRUD Artikel (Create, Read, Update, Delete)
- Slug unik otomatis dari judul
- Upload **multi-foto** per artikel (disimpan sebagai JSON path)
- Preview foto utama di tabel artikel
- Pembatasan berdasarkan role:
  - Admin: melihat semua artikel
  - Guru: hanya melihat artikel yang ia buat

#### **Manajemen Mata Pelajaran (Subjects)**
- Admin dapat mengelola daftar mata pelajaran
- Guru dihubungkan ke satu mata pelajaran via `subject_id`

#### **Manajemen Organisasi / Ekstrakurikuler**
- Admin dapat:
  - Menambah organisasi/ekskul (nama, deskripsi, foto)
  - Mengubah nama, deskripsi, dan foto
  - Menghapus organisasi (bersama file fotonya)

#### **Manajemen Iklan / Ads**
- Admin dapat mengelola banner/iklan untuk ditampilkan di halaman depan

#### **Manajemen Dokumen (Perangkat Pembelajaran)**
Menu **Perangkat** (`/perangkat`) untuk mengelola dokumen seperti:
- RPP (Rencana Pelaksanaan Pembelajaran)
- Silabus
- Modul
- Dokumen pendukung lainnya

**Fitur:**
- Upload file (`pdf`, `doc`, `docx`, `xlsx`) dengan batas ukuran tertentu
- Dokumen disimpan di `storage/app/public/dokumen`
- Download dokumen langsung dari sistem
- Hapus dokumen (termasuk file fisiknya)
- User non-admin hanya dapat melihat dokumen tertentu sesuai role/user

---

### 🔐 Autentikasi & Profil

- Sistem login / register standar Laravel (Breeze)
- **Middleware:**
  - `auth` – memastikan user login
  - `verified` – memastikan email sudah terverifikasi untuk akses dashboard
  - `role:admin` – pembatasan fitur admin
- **Halaman Profil:**
  - Edit informasi dasar user
  - Ubah password
  - Hapus akun (opsional)

---

## 🧱 Teknologi yang Digunakan

### Backend
- PHP **8.1+**
- **Laravel 10.x**
- Eloquent ORM
- Middleware auth & verifikasi email

### Frontend
- Laravel Blade
- Vite sebagai bundler
- Tailwind CSS
- Alpine.js
- Bootstrap (sebagian di landing page)

### Database
- MySQL

### Storage
- Disk `local` & `public` (default Laravel)
- Disk `google` sudah disiapkan untuk integrasi Google Drive via package `yaza/laravel-google-drive-storage` (opsional)

---

## 📂 Struktur Proyek

```
WEBSITE-SEKOLAH/
└── public_html/
    ├── app/
    │   ├── Http/
    │   │   └── Controllers/
    │   └── Models/
    ├── config/
    ├── database/
    │   ├── migrations/
    │   └── seeders/
    ├── public/
    ├── resources/
    │   └── views/
    │       ├── frontend/
    │       └── backend/
    ├── routes/
    │   └── web.php
    ├── storage/
    ├── composer.json
    └── package.json
```

> **Catatan:** Project Laravel berada di dalam folder `public_html`, sehingga semua perintah (composer, artisan, npm, dll.) dijalankan dari direktori tersebut.

---

## 🚀 Cara Menjalankan di Lokal

### 1. Clone Repository

```bash
git clone https://github.com/Kyyneko/WEBSITE-SEKOLAH.git
cd WEBSITE-SEKOLAH/public_html
```

### 2. Install Dependency PHP

Pastikan sudah terpasang:
- PHP 8.1+
- Composer
- MySQL

Lalu jalankan:

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file `.env`:

```bash
cp .env.example .env
```

Edit `.env` dan sesuaikan bagian database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=website_sekolah
DB_USERNAME=root
DB_PASSWORD=your_password
```

Generate application key:

```bash
php artisan key:generate
```

### 4. Migrasi Database & Seed (Opsional)

Jalankan migrasi:

```bash
php artisan migrate
```

Jika sudah disiapkan seeder (misalnya user admin, mata pelajaran, dll.):

```bash
php artisan db:seed
```

### 5. Storage Link

Agar file upload (artikel, perangkat pembelajaran, dll.) bisa diakses publik:

```bash
php artisan storage:link
```

### 6. Install Dependency Frontend

Pastikan Node.js & npm sudah terinstall.

```bash
npm install
npm run dev   # untuk mode development
# atau
npm run build # untuk production
```

### 7. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di: **http://127.0.0.1:8000**

---

## ☁️ Konfigurasi Google Drive (Opsional)

Project ini sudah menambahkan disk `google` di `config/filesystems.php`. Untuk mengaktifkan penyimpanan di Google Drive:

1. Tambahkan variabel berikut di `.env`:

```env
FILESYSTEM_DISK=google

GOOGLE_DRIVE_CLIENT_ID=your_client_id
GOOGLE_DRIVE_CLIENT_SECRET=your_client_secret
GOOGLE_DRIVE_REFRESH_TOKEN=your_refresh_token
GOOGLE_DRIVE_FOLDER=folder_id_di_google_drive
```

2. Sesuaikan bagian kode upload/Storage agar menggunakan disk `google` jika ingin menyimpan langsung ke Google Drive.

---

## 🔐 Role & Hak Akses

### Admin
- ✅ Kelola user (admin & guru)
- ✅ Kelola mata pelajaran
- ✅ Kelola organisasi/ekstrakurikuler
- ✅ Kelola artikel & ads
- ✅ Akses semua dokumen perangkat pembelajaran

### Guru (Teacher)
- ✅ Mengelola artikel yang ia buat
- ✅ Upload dokumen perangkat pembelajaran sendiri
- ✅ Mengelola profilnya sendiri

---

## 🧭 Roadmap / Pengembangan Lanjutan

Beberapa ide pengembangan:

- [ ] Mengganti semua data dummy di frontend dengan data asli dari database
- [ ] Menambahkan modul:
  - Data siswa / kelas
  - Agenda kegiatan
  - Galeri foto & video
- [ ] Integrasi penuh dengan Google Drive untuk semua dokumen
- [ ] Role tambahan (misalnya: siswa, operator sekolah)
- [ ] Sistem notifikasi
- [ ] Export data ke Excel/PDF

---

## 📝 Lisensi

Project ini bersifat open source dan dapat digunakan untuk keperluan pendidikan.

---

## 👨‍💻 Pengembang

Dikembangkan oleh **[Kyyneko](https://github.com/Kyyneko)** untuk kebutuhan website sekolah dan eksperimen dengan Laravel, Vite, Tailwind, dan integrasi storage.

---

## 📞 Kontak & Dukungan

Jika ada pertanyaan atau masalah, silakan buat **Issue** di repository ini atau hubungi melalui email.

---

**⭐ Jangan lupa beri Star jika project ini bermanfaat!**
