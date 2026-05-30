# PANDUAN PENGGUNAAN WEBSITE & DASHBOARD ADMIN UPT SPF SMPN 14 BULUKUMBA

Panduan resmi ini disusun untuk membantu Administrator (Admin) dan Guru (Teacher) dalam mengelola seluruh konten, dokumen, warga sekolah, serta konfigurasi website resmi UPT SPF SMPN 14 Bulukumba melalui panel dashboard yang interaktif.

---

## BAGIAN 1: AKSES LOGIN DUA PERAN

Aplikasi memiliki dua level otorisasi akses (peran) yang dibatasi secara ketat demi keamanan data:
1. **Administrator (Admin)**: Memiliki kendali penuh atas sistem, manajemen pengguna, data akademik, pengaturan sekolah, persetujuan berkas, dan semua konten informasi website.
2. **Guru (Teacher)**: Memiliki hak khusus untuk mengunggah berkas ajar mandiri, menulis artikel berita (terkunci sesuai ekskul yang diampu), dan mengelola profil akun pribadinya.

### Kredensial Login Administrator Bawaan (Default)
Tepat setelah database disemai (seeded), Anda dapat masuk menggunakan akun default berikut:
* **Halaman Login**: Buka browser dan akses `http://127.0.0.1:8000/login`
* **Username / Email**: `superuser`
* **Password**: `superuser123`

> [!IMPORTANT]
> Demi keamanan website sekolah Anda, disarankan untuk segera mengubah kata sandi superuser bawaan ini di menu Edit Profil setelah masuk untuk pertama kali.

---

## BAGIAN 2: PANDUAN KHUSUS ADMINISTRATOR (ADMIN)

Berikut adalah panduan langkah demi langkah untuk setiap modul pengelolaan data di bawah wewenang administrator sekolah. Seluruh modul dikelompokkan dengan rapi pada sidebar dashboard sebelah kiri.

---

### 1. Kelola Data Warga Sekolah (Guru & Staf)
Modul ini digunakan untuk mendaftarkan akun login Guru serta menampilkan data Guru & Tenaga Kependidikan di halaman publik website.

#### **A. Menambah Guru Baru**:
1. Buka menu **Warga Sekolah (Guru/Staf)**, klik **Tambah Pengguna**.
2. Masukkan *Nama*, *Email* (digunakan untuk login), *Password*, dan pilih peran **Guru**.
3. Kolom kondisional akan otomatis muncul:
   * **Mata Pelajaran**: Pilih mata pelajaran spesifik yang diajarkan Guru tersebut.
   * **Organisasi Diampu**: Pilih ekstrakurikuler yang dibina Guru tersebut (misal: Pramuka). Ini akan otomatis mengunci kategori artikel berita yang ditulis Guru tersebut nantinya.
   * **Jabatan**: Masukkan gelar penugasan khusus (misal: *Wali Kelas IX-A* atau *Pembina Pramuka*).
4. Klik **Simpan Pengguna**.

#### **B. Menambah Staf Kependidikan Baru**:
1. Pada form tambah pengguna, pilih peran **Staff**.
2. Kolom kondisional Mata Pelajaran & Organisasi akan disembunyikan otomatis, sedangkan kolom **Jabatan/Posisi** akan wajib diisi (Contoh: *Kepala Tata Usaha*, *Operator Sekolah*, *Penjaga Perpustakaan*).
3. **Catatan**: Sistem website di bagian publik (`/wargaSekolah/dataStaff`) secara cerdas akan menyematkan lencana kategori (*Administrasi*, *Teknis*, atau *Pendukung*) berdasarkan kata kunci jabatan yang Anda masukkan.
4. Klik **Simpan Pengguna**.

---

### 2. Kelola Mata Pelajaran (Subjects)
Mata pelajaran harus diinput terlebih dahulu agar bisa dipilih pada form pendaftaran Guru.
1. Buka menu **Mata Pelajaran**, klik **Tambah Mata Pelajaran**.
2. Masukkan *Nama Mata Pelajaran* (Contoh: *Matematika*, *Pendidikan Pancasila*) dan tulis *Kode Mapel* unik.
3. Klik **Simpan**.

---

### 3. Kelola Fasilitas Sekolah
Modul ini digunakan untuk mengelola sarana dan prasarana yang tayang secara dinamis di halaman `/fasilitas`.

1. Buka menu **Fasilitas Sekolah**, klik **Tambah Fasilitas**.
2. Masukkan *Nama Fasilitas* (Contoh: *Laboratorium Komputer*).
3. Pilih *Kategori* yang serasi (Akademik, Teknologi, Olahraga, Ibadah, Pendukung). Kategori ini memengaruhi kalkulasi statistik dinamis di bagian bawah halaman publik.
4. **Fitur/Spesifikasi Penunjang**: Masukkan fasilitas penunjang dipisahkan dengan tanda koma (`,`).
   * *Contoh*: `AC, Proyektor LCD, 32 Unit PC Core i5, Internet Serat Optik`
   * *Hasil di Frontend*: Kalimat di atas otomatis dipecah menjadi tag-tag lencana hijau premium yang tertata rapi.
5. **Foto Fasilitas**: Unggah foto nyata dari prasarana tersebut (Format: JPG/PNG/WEBP/HEIC).
6. Tulis deskripsi lengkap mengenai fasilitas tersebut, lalu klik **Simpan**.

---

### 4. Kelola Prestasi Sekolah
Modul ini digunakan untuk mengapresiasi medali dan pencapaian membanggakan siswa di halaman `/prestasi`.

1. Buka menu **Prestasi Sekolah**, klik **Tambah Prestasi**.
2. Masukkan *Nama / Judul Prestasi* (Contoh: *Juara 1 Olimpiade Sains Nasional*).
3. Pilih *Kategori* (Akademik, Olahraga, Seni, Lainnya) untuk mendukung penyaringan filter instan di halaman publik.
4. Pilih *Tingkat Medali*: **Emas / Juara 1**, **Perak / Juara 2**, atau **Perunggu / Juara 3**.
5. Masukkan nama *Peraih Prestasi* (bisa berupa nama siswa tunggal atau tim/kelompok), *Tanggal/Bulan*, dan *Lokasi Wilayah* perlombaan.
6. Unggah foto penyerahan piala dan tulis deskripsi perjuangan siswa. Klik **Simpan**.

---

### 5. Kelola Organisasi & Ekskul
Modul untuk memperbarui data organisasi OSIS dan deretan kegiatan ekstrakurikuler yang tayang di halaman `/ekstrakurikuler`.

1. Buka menu **Organisasi & Ekskul**, klik **Tambah Organisasi**.
2. Masukkan nama ekskul (Contoh: *Pramuka*, *PMR*).
3. Unggah foto dokumentasi kegiatan. Anda dapat mengunggah banyak foto sekaligus (*multiple files*) sebagai galeri kegiatan ekskul tersebut.
4. Tulis deskripsi atau visi-misi ekskul, lalu klik **Simpan**.

---

### 6. Kelola Galeri Foto Sekolah
Seksi untuk menambahkan foto-foto kegiatan sekolah secara live ke portal galeri foto utama.
1. Buka menu **Galeri Foto**, klik **Tambah Galeri**.
2. Berikan judul kegiatan (Contoh: *Upacara Hardiknas 2026*).
3. Unggah satu atau beberapa foto kegiatan sekaligus di dropzone premium yang tersedia, lalu klik **Simpan**.

---

### 7. Kelola Pengumuman Sekolah
Modul ini digunakan untuk memajang banner/gambar pengumuman penting (seperti *Penerimaan Siswa Baru*, *Jadwal Kelulusan*) langsung di slider carousel halaman beranda depan.

1. Buka menu **Pengumuman**, klik **Tambah Pengumuman**.
2. Masukkan *Judul Pengumuman* (Contoh: *PPDB Online UPT SPF SMPN 14 Bulukumba Tahun Ajaran 2026/2027*).
3. Masukkan **Link Tujuan**: Masukkan URL lengkap (Contoh: `https://ppdb.bulukumbakab.go.id`) ke mana pengguna akan diarahkan saat mengklik banner pengumuman tersebut.
4. Tulis deskripsi singkat pengumuman.
5. Unggah gambar banner pengumuman (Rekomendasi rasio horizontal 16:9), lalu klik **Simpan**.

---

### 8. Persetujuan Berkas (Approval Perangkat Ajar Guru)
Ketika seorang Guru mengunggah berkas ajar seperti RPP atau Modul, berkas tersebut tidak akan langsung tayang ke publik sebelum disetujui oleh Administrator.

1. Buka menu **Perangkat Pembelajaran** (Menu Utama).
2. Anda akan melihat daftar seluruh berkas yang diunggah oleh semua guru.
3. Berkas yang baru masuk akan bertanda status **Pending**.
4. Klik tombol **Pratinjau (Preview)** atau **Unduh (Download)** untuk memeriksa keabsahan isi dokumen berkas tersebut.
5. Lakukan persetujuan berkas:
   * Klik tombol **Setujui (Approve)** jika berkas sudah benar. Status akan berubah menjadi **Disetujui** dan berkas langsung tayang di portal Guru publik.
   * Klik tombol **Tolak (Reject)** jika berkas salah atau tidak sesuai. Status akan berubah menjadi **Ditolak** dan guru harus mengunggah ulang berkas yang benar.

---

### 9. Pengaturan Identitas & Foto Website (Live Configuration)
Admin dapat merubah seluruh teks identitas sekolah dan foto-foto carousel utama beranda tanpa menyentuh satu baris kode pemrograman pun.

1. Buka menu **Pengaturan Sekolah** di bagian paling bawah.
2. Form dibagi menjadi 3 Tab Premium:
   * **Tab 1: Identitas Sekolah**: Edit Nama Sekolah, Alamat Lengkap, NPSN, Akreditasi, Visi-Misi, Sejarah Singkat, Sambutan Kepala Sekolah, Nama Kepala Sekolah Aktif, serta **Statistik Live** (Jumlah Siswa Aktif & Jumlah Tenaga Pendidik) yang langsung menyinkronkan data counter di halaman utama.
   * **Tab 2: Informasi Kontak**: Perbarui Email Resmi Sekolah, Nomor Telepon, Link Google Maps, dan akun Sosial Media (Facebook, Instagram, YouTube) sekolah.
   * **Tab 3: Foto Website**: Ganti foto slider Hero Carousel Slide #1, Slide #2, Slide #3 di beranda depan, serta Banner Foto Atas halaman profil secara live dengan mengunggah foto baru.
3. Klik **Simpan Pengaturan** untuk menerapkan perubahan secara instan di seluruh halaman website publik.

---

## BAGIAN 3: PANDUAN KHUSUS GURU (TEACHER)

Guru memiliki wewenang khusus untuk berkontribusi secara mandiri mengisi portal ajar sekolah dan artikel berita.

---

### 1. Menulis & Mengelola Artikel Berita
Modul ini digunakan oleh Guru untuk menulis esai, catatan pembelajaran, liputan kegiatan, atau kabar terbaru dari organisasi kesiswaan yang dibinanya.

1. Buka menu **Artikel & Berita** (Menu Utama), klik **Tambah Artikel**.
2. Tulis *Judul Artikel* yang menarik. Sistem otomatis akan menghasilkan link slug ramah SEO yang unik berdasarkan judul Anda.
3. **Penyelarasan Kategori Otomatis (Enforced Category)**:
   * Kolom input **Kategori / Organisasi** akan otomatis **TERKUNCI (Readonly)** dengan ikon gembok kuning. Kategori ini terisi otomatis berdasarkan Organisasi Kesiswaan yang ditugaskan kepada Anda oleh Admin (Misal: *Pramuka*).
   * Jika Anda tidak diplot membina ekskul apapun, artikel akan otomatis ber-kategori **Umum**.
4. Tulis isi artikel secara leluasa di editor teks Trix Rich Editor yang didukung pemformatan teks tebal (*bold*), miring (*italic*), poin list, hingga penyematan link.
5. Unggah satu foto utama artikel, serta satu atau beberapa foto pendukung di dropzone galeri foto artikel.
6. Klik **Simpan Artikel**. Artikel Anda akan langsung terbit di halaman depan beranda dengan badge kategori yang indah!

---

### 2. Mengunggah Perangkat Pembelajaran Mandiri
Guru diwajibkan untuk mendokumentasikan dokumen perangkat mengajarnya di sistem berkas sekolah.

1. Buka menu **Perangkat Pembelajaran** (Menu Utama).
2. Anda akan disajikan dengan tabel berkas khusus yang **hanya berisi berkas milik Anda sendiri**.
3. Untuk mengunggah berkas ajar baru:
   * Isi kolom *Nama Dokumen* (Contoh: *RPP Matematika Kelas VIII Semester Ganjil*).
   * Pilih jenis berkas (RPP / Silabus / Modul / Lainnya).
   * Unggah dokumen Anda (Format: PDF / Word / Excel, batas file maks 10MB).
   * Klik **Upload File**.
4. Berkas Anda akan masuk ke tabel dengan status awal **Pending**.
5. Silakan hubungi Administrator sekolah untuk memverifikasi dan menyetujui berkas Anda agar dapat diterbitkan secara resmi.

---

## BAGIAN 4: SPESIFIKASI BERKAS & DUKUNGAN GAMBAR

Agar performa website tetap ringan diakses oleh siswa dan wali murid yang menggunakan paket data seluler, sistem website dilengkapi dengan teknologi optimasi gambar cerdas otomatis:

### 1. Kompresi Gambar Cerdas (Otomatis)
* Setiap kali Admin atau Guru mengunggah gambar ke sistem, sistem ImageOptimizer akan bekerja di balik layar:
  * Mengompresi kualitas gambar ke tingkat optimal **75%** guna menghemat ruang penyimpanan.
  * Mengecilkan lebar dimensi foto secara proporsional jika lebarnya melebihi **1200 piksel** (tetap mempertahankan aspek rasio gambar).
  * Menghapus file gambar lama secara otomatis di server jika Anda mengunggah gambar pengganti baru.

### 2. Dukungan Format HEIC / HEIF (Kamera iPhone)
* Anda dapat langsung mengunggah foto mentah berformat `.heic` atau `.heif` langsung dari galeri kamera iPhone atau iPad Anda tanpa perlu repot melakukan konversi manual terlebih dahulu.
* Sistem server akan mendeteksi file HEIC secara otomatis dan mengonversinya menjadi format `.jpg` universal yang terkompresi secara instan, sehingga dapat langsung terbaca dengan tajam di semua browser laptop maupun Android.

### Batas Ukuran Dokumen Perangkat Ajar:
* Batas maksimal ukuran dokumen perangkat ajar yang diunggah Guru adalah **10 MB** per file. Format yang didukung meliputi `.pdf`, `.doc`, `.docx`, `.xls`, `.xlsx`.

---

## BAGIAN 5: KONTAK DUKUNGAN TEKNIS
Jika Anda menemui kendala teknis lebih lanjut terkait bug sistem atau integrasi hosting, silakan ajukan laporan kendala ke pengembang web resmi sekolah:
* **Pengembang Utama**: [Kyyneko](https://github.com/Kyyneko)
* **Status Kerja**: Portal Terintegrasi SQLite Dinamis 100% Selesai & Teruji.

---
*UPT SPF SMPN 14 Bulukumba — Cerdas, Berkarakter, Unggul!*
