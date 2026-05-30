# Website Resmi UPT SPF SMPN 14 BULUKUMBA 🏫

[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-%5E8.1-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![SQLite](https://img.shields.io/badge/SQLite-Database-003B57?style=flat&logo=sqlite&logoColor=white)](https://www.sqlite.org/)
[![Vite](https://img.shields.io/badge/Vite-Bundler-646CFF?style=flat&logo=vite&logoColor=white)](https://vitejs.dev/)

Portal informasi dan sistem manajemen resmi sekolah berbasis web terpadu. Sistem ini dilengkapi dengan dashboard administrasi premium bagi **Admin** dan **Guru** untuk mengelola konten, artikel, data warga sekolah (guru & staf), dokumen perangkat pembelajaran, data prestasi, fasilitas, hingga organisasi kesiswaan secara dinamis.

---

## ✨ Fitur Utama & Keunggulan

### 🌐 Portal Publik (Frontend Dinamis & Estetis)

* **Beranda / Homepage**:
  * Slider Hero Carousel dinamis yang fotonya dapat dikonfigurasi langsung dari dashboard admin.
  * Teks dinamis identitas sekolah, visi-misi, dan sambutan kepala sekolah.
  * Statistik terintegrasi database untuk *Jumlah Siswa* dan *Jumlah Guru/Staf*.
  * Grid Artikel Terbaru dengan estimasi waktu baca dinamis (`⏱️ X Menit Baca`), floating glassmorphic category badges, dan tombol read-more interaktif.
  * Banner slide **Pengumuman Sekolah** dinamis.
* **Profil Sekolah (`/profil`)**:
  * Menampilkan deskripsi sekolah, visi-misi, dan identitas fisik.
  * **Mantan Kepala Sekolah**: Menampilkan deretan foto dan periode khidmat mantan kepala sekolah secara dinamis dari database, lengkap dengan avatar siluet sebagai fallback otomatis yang elegan.
* **Fasilitas Sekolah (`/fasilitas`)**:
  * Menampilkan daftar prasarana sekolah secara dinamis (Ruang Kelas, Perpustakaan, Lapangan, dll.).
  * **Statistik Dinamis Real-Time**: Modul pencatat otomatis di bagian bawah menghitung jumlah Ruang Kelas, Lab, Perpustakaan, dan Fasilitas Pendukung langsung dari database secara real-time.
* **Prestasi Sekolah (`/prestasi`)**:
  * Daftar medali (🥇 Emas, 🥈 Perak, 🥉 Perunggu) dan pencapaian membanggakan siswa.
  * **Interactive JS Category Filter**: Penyaringan kartu prestasi instan (Semua, Akademik, Olahraga, Seni, Lainnya) dengan transisi animasi CSS yang halus tanpa memuat ulang halaman.
* **Artikel & Berita (`/article`)**:
  * Halaman listing dinamis 100% dari database dengan visual grid penyesuaian tinggi otomatis.
  * Detail artikel (`/article/{slug}`) memuat deskripsi lengkap (HTML aman), nama penulis, tanggal terbit, estimasi baca, dan **Interactive Fullscreen Lightbox Carousel** untuk menjelajah galeri foto artikel menggunakan tombol keyboard (`←` / `→` / `ESC`) atau panah navigasi.
* **Ekstrakurikuler & Organisasi (`/ekstrakurikuler`)**:
  * 100% dinamis terintegrasi database (OSIS, Pramuka, PMR, Paskibra, dll.) dengan ekstraksi cover image pertama dari galeri foto organisasi.
* **Warga Sekolah (Guru & Staf)**:
  * **Data Guru (`/wargaSekolah/dataGuru`)**: Menampilkan foto profil terkompresi, nama lengkap, dan mata pelajaran yang diampu langsung dari database.
  * **Data Staf (`/wargaSekolah/dataStaff`)**: Menampilkan Tenaga Kependidikan dengan pengelompokan otomatis cerdas (Administrasi, Teknis, Pendukung) berdasarkan kata kunci jabatan mereka.

---

### 🎛️ Dashboard Admin & Guru (Backend CRUD Premium)

Dashboard administrasi dirancang dengan visual konsisten yang premium (.dash-header-card gradien biru tua mewah) serta dioptimalkan untuk performa tinggi.

* **Sistem Keamanan & Otorisasi**:
  * Pembatasan hak akses ketat berbasis peran (**Admin** & **Guru/Teacher**).
  * Sistem login / logout / reset password terintegrasi (Laravel Breeze).
* **Data Warga Sekolah (Users & Staff)**:
  * CRUD Guru & Staf dengan jabatan kustom, penugasan mata pelajaran, dan organisasi diampu.
  * Logika form kondisional: input mata pelajaran/organisasi otomatis disembunyikan jika jabatan adalah staf pendukung.
* **Manajemen Pengumuman (Announcements)**:
  * Pengganti modul "Iklan" konvensional. Digunakan untuk mengunggah pengumuman penting sekolah berupa banner gambar yang langsung tayang di slide beranda.
* **Manajemen Artikel & Berita**:
  * CRUD artikel dengan slug unik otomatis, dukungan multi-photo gallery.
  * **Enforced Security**: Guru hanya diperbolehkan menulis artikel ber-kategori organisasi yang diampunya (dropdown kategori terkunci otomatis dengan ikon gembok). Admin memiliki akses bebas memilih kategori apapun.
* **Manajemen Fasilitas & Prestasi**:
  * CRUD Fasilitas: Fitur penunjang diinput sebagai teks comma-separated di frontend yang otomatis dikonversi menjadi array JSON di database.
  * CRUD Prestasi: Pilihan tingkat medali (Emas, Perak, Perunggu) dengan lencana visual yang serasi.
* **Manajemen Organisasi & Ekskul**:
  * CRUD data ekstrakurikuler sekolah lengkap dengan unggah banyak foto dokumentasi kegiatan.
* **Manajemen Dokumen (Perangkat Ajar)**:
  * Guru dapat mengunggah berkas RPP, Silabus, dan Modul (`.pdf`, `.docx`, `.xlsx`).
  * Admin dapat menyetujui (*approve*) atau menolak (*reject*) berkas guru sebelum diterbitkan.
* **Pengaturan Website & Foto Dinamis**:
  * Tab khusus untuk mengonfigurasi Foto Website: mengganti slider hero beranda dan banner profil secara dinamis.
  * Mengubah teks visi-misi, sejarah sekolah, sambutan kepsek, NPSN, akreditasi, hingga data statistik murid/staf secara live.

---

### 📷 Fitur Pendukung: Image Auto-Compression & HEIC Support
Sistem dilengkapi dengan helper [ImageOptimizer.php](file:///e:/Project/WEBSITE-SEKOLAH/public_html/app/Helpers/ImageOptimizer.php) berbasis GD PHP untuk performa loading maksimal:
* **Kompresi Otomatis**: Semua foto yang diunggah (artikel, profil guru, fasilitas, prestasi, pengumuman) otomatis dipotong/diresize jika lebarnya melebihi `1200px` dan dikompresi ke format JPG universal dengan kualitas `75%`. Ukuran berkas tereduksi secara ekstrim (misal 5MB menjadi 150KB) tanpa penurunan ketajaman visual.
* **Dukungan Format HEIC/HEIF**: Mendukung penuh unggahan berkas foto mentah langsung dari kamera iPhone/iPad, secara otomatis dikonversi menjadi JPEG terkompresi di server (memerlukan PHP extension Imagick).
* **Safe Cleanup**: File foto lama otomatis dihapus dari penyimpanan lokal disk storage ketika data diubah (*update*) atau dihapus (*delete*).

---

## 🧱 Teknologi yang Digunakan

* **Backend**: PHP >= 8.1, **Laravel 10.x** (Eloquent, Middleware, Auth Guard)
* **Database**: SQLite (default aktif untuk performa cepat di lokal), MySQL (siap migrasi)
* **Frontend**: Laravel Blade, Vite Bundler, Vanilla CSS (Premium design tokens), Bootstrap 5 (Responsive utilities), AOS (Animate on Scroll), Alpine.js
* **Storage**: Disk `public` lokal (dengan folder terhubung ke `public/storage`), disk `google` (siap pakai)

---

## 🚀 Cara Menjalankan di Lokal

### 1. Clone Repository & Masuk Folder Project
```bash
git clone https://github.com/Kyyneko/WEBSITE-SEKOLAH.git
cd WEBSITE-SEKOLAH/public_html
```

### 2. Install Dependency PHP & Frontend
```bash
# Install package composer
composer install

# Install package npm & build assets
npm install
npm run build
```

### 3. Konfigurasi Environment (`.env`)
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Secara default, database diset menggunakan SQLite untuk kemudahan dijalankan langsung. Buat berkas database SQLite kosong:
```bash
# Di Windows PowerShell:
New-Item -ItemType File -Path database/database.sqlite
```
Pastikan `.env` Anda memuat konfigurasi koneksi SQLite:
```env
DB_CONNECTION=sqlite
```
*(Jika ingin beralih ke MySQL, silakan sesuaikan variabel `DB_HOST`, `DB_PORT`, `DB_DATABASE`, dll. pada berkas `.env`)*.

Generate application key:
```bash
php artisan key:generate
```

### 4. Jalankan Migrasi Database & Seeding Foto
Terapkan struktur tabel dan populate data awal sekolah lengkap dengan foto-foto asli ter-seed:
```bash
php artisan migrate:fresh --seed
```

### 5. Hubungkan Link Folder Storage
Kaitkan berkas storage agar semua gambar unggahan dapat diakses secara publik oleh browser:
```bash
php artisan storage:link
```

### 6. Jalankan Server Lokal
```bash
php artisan serve
```
Buka peramban Anda di **http://127.0.0.1:8000** dan masuk ke menu dashboard admin menggunakan akun superuser bawaan.

---

## 🔐 Hak Akses Peran (Roles)

### Admin (Administrator)
* Kelola Warga Sekolah (Guru & Staf) & Jabatan.
* Kelola Mata Pelajaran.
* Kelola Fasilitas, Prestasi, Organisasi/Ekskul, Galeri Foto, dan Pengumuman.
* Kelola Artikel & Berita (bebas memilih kategori artikel).
* Persetujuan/Approval dokumen perangkat pembelajaran guru.
* Akses menu Pengaturan Identitas & Foto Website.

### Guru (Teacher)
* Mengelola artikel karyanya sendiri (kategori dikunci otomatis sesuai organisasi diampu).
* Mengunggah dokumen Perangkat Pembelajaran mandiri.
* Mengelola profil & password pribadinya sendiri.

---

## 👨‍💻 Pengembang
Dikembangkan dan dirawat oleh **[Kyyneko](https://github.com/Kyyneko)** untuk kebutuhan portal informasi terpadu sekolah UPT SPF SMPN 14 Bulukumba.

---
**⭐ Berikan Star jika project ini bermanfaat bagi pengembangan website sekolah Anda!**
