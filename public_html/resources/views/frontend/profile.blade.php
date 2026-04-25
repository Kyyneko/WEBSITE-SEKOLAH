@extends('frontend.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/frontend/profile.css') }}">
    <style>
        /* Layout dasar halaman profil */
        .profile-banner {
            margin-top: 70px;
        }

        .profile-banner img {
            width: 100%;
            max-height: 320px;
            object-fit: cover;
            border-radius: 0 0 12px 12px;
        }

        .section-wrapper {
            padding: 4rem 0;
        }

        .section-wrapper:nth-of-type(even) {
            background-color: #f8fafc;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 3rem;
            color: #1a202c;
        }

        .section-title-small {
            font-size: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            color: #2d3748;
        }

        .text-justify {
            text-align: justify;
        }

        /* Kepala Sekolah Hero Section */
        .kepsek-photo {
            max-width: 280px;
            border: 4px solid #ffffff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .kepsek-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
            color: #1a202c;
        }

        .kepsek-role {
            font-size: 1rem;
            color: #718096;
            margin-bottom: 0;
        }

        .kepsek-quote {
            font-size: 1rem;
            line-height: 1.8;
            color: #4a5568;
        }

        /* Card Kepala Sekolah yang Pernah Menjabat */
        .kepsek-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 8px;
        }

        .kepsek-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .kepsek-card img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
        }

        .kepsek-card .card-body {
            padding: 1.25rem 0.75rem;
        }

        .kepsek-card p {
            font-size: 0.85rem;
            font-weight: 500;
            color: #2d3748;
            line-height: 1.4;
        }

        /* Data Sekolah Section */
        .data-sekolah-section {
            background: linear-gradient(135deg, rgb(19, 123, 191) 0%, rgb(16, 100, 160) 100%);
            color: #ffffff;
        }

        .data-sekolah-section .section-title {
            color: #ffffff;
        }

        .data-sekolah-section .bg-white {
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .data-sekolah-section table th {
            font-weight: 600;
            padding: 0.75rem 1rem 0.75rem 0;
            vertical-align: top;
            width: 45%;
            color: #2d3748;
        }

        .data-sekolah-section table td {
            padding: 0.75rem 0;
            vertical-align: top;
            color: #4a5568;
        }

        .data-sekolah-section table tr {
            border-bottom: 1px solid #e2e8f0;
        }

        .data-sekolah-section table tr:last-child {
            border-bottom: none;
        }

        .data-sekolah-section .btn-light {
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .data-sekolah-section .btn-light:hover {
            background-color: #e2e8f0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Visi Misi Section */
        .visi-misi-section ul {
            list-style: none;
            padding-left: 0;
        }

        .visi-misi-section ul li {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 1rem;
            line-height: 1.7;
        }

        .visi-misi-section ul li:before {
            content: "✓";
            position: absolute;
            left: 0;
            top: 0;
            color: rgb(19, 123, 191);
            font-weight: bold;
            font-size: 1.2rem;
        }

        /* Info Sections */
        .info-section-blue {
            background: linear-gradient(135deg, rgb(19, 123, 191) 0%, rgb(16, 100, 160) 100%);
            color: #ffffff;
        }

        .info-section-blue .section-title-small {
            color: #ffffff;
        }

        .info-section-blue a {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1.5rem;
            background-color: #ffffff;
            color: rgb(19, 123, 191);
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .info-section-blue a:hover {
            background-color: #e2e8f0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .section-wrapper {
                padding: 3rem 0;
            }

            .section-title {
                font-size: 1.5rem;
                margin-bottom: 2rem;
            }

            .section-title-small {
                font-size: 1.25rem;
            }

            .kepsek-photo {
                max-width: 220px;
            }

            .kepsek-name {
                font-size: 1.25rem;
            }

            .kepsek-quote {
                font-size: 0.95rem;
            }

            .data-sekolah-section table th {
                width: 45%;
                font-size: 0.9rem;
            }

            .data-sekolah-section table td {
                font-size: 0.9rem;
            }

            .text-center-mobile {
                text-align: center !important;
            }
        }
    </style>
@endsection

@section('content')
    <main>

        {{-- BANNER FOTO PERSEGI PANJANG --}}
        <section class="profile-banner">
            <img
                src="https://placehold.co/1200x320"
                alt="Banner Profil Sekolah Fiktif"
                class="img-fluid">
        </section>

        {{-- HERO KEPALA SEKOLAH --}}
        <section class="section-wrapper">
            <div class="container">
                <h1 class="section-title">Kepala Sekolah</h1>

                <div class="row align-items-center justify-content-center">
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <img
                            src="https://placehold.co/300x400"
                            alt="Foto Kepala Sekolah"
                            class="img-fluid rounded-3 kepsek-photo">
                        <h2 class="kepsek-name">Rina Kartika, M.Pd</h2>
                        <p class="kepsek-role">Kepala Sekolah SMP Fiktif Nusantara</p>
                    </div>

                    <div class="col-md-8">
                        <p class="kepsek-quote text-justify">
                            <strong><i>
                                "Selamat datang di halaman profil SMP Fiktif Nusantara. Semua data dan informasi di halaman ini
                                hanya bersifat contoh tampilan. Halaman ini digunakan untuk pengujian layout, desain, dan konten
                                tanpa merepresentasikan sekolah tertentu di dunia nyata. Silakan gunakan halaman ini sebagai dummy
                                page selama proses pengembangan aplikasi."
                            </i></strong>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- SEJARAH SEKOLAH (FIKTIF) --}}
        <section class="section-wrapper">
            <div class="container">
                <h2 class="section-title">Sejarah Sekolah (Dummy)</h2>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <p class="text-justify mb-3">
                            SMP Fiktif Nusantara berdiri bermula dari sebuah ide sederhana: menyediakan contoh data acak yang dapat
                            digunakan oleh para pengembang untuk menguji tampilan website sekolah. Sekolah fiktif ini tidak memiliki
                            lokasi, siswa, maupun guru sungguhan, tetapi diciptakan sepenuhnya untuk kebutuhan simulasi.
                        </p>
                        <p class="text-justify mb-3">
                            Dalam perjalanannya, sekolah ini sering digunakan sebagai bahan demo, latihan desain, serta uji coba fitur
                            seperti manajemen profil sekolah, pengisian data, hingga penampilan artikel. Setiap angka, tahun, ataupun
                            nama yang tercantum di sini tidak perlu dianggap serius dan boleh diabaikan ketika aplikasi sudah siap
                            diisi dengan data asli.
                        </p>
                        <p class="text-justify mb-0">
                            Pada akhirnya, tujuan utama dari SMP Fiktif Nusantara hanyalah satu: memastikan tampilan dan alur aplikasi
                            berjalan dengan baik sebelum digunakan oleh pengguna sebenarnya. Jika Anda membaca ini di produksi, berarti
                            data dummy ini belum diganti dengan data yang sesungguhnya.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- KEPALA SEKOLAH YANG PERNAH MENJABAT (FIKTIF) --}}
        <section class="section-wrapper">
            <div class="container">
                <h2 class="section-title">Kepala Sekolah yang Pernah Menjabat (Dummy)</h2>

                <div class="row g-4 justify-content-center">
                    @php
                        $kepsekList = [
                            'Budi Santoso',
                            'Siti Lestari',
                            'Agus Pratama',
                            'Dewi Rahmawati',
                            'Andi Fikri',
                            'Nina Kusuma',
                            'Rafi Alamsyah',
                            'Lina Purnama',
                            'Joko Wiryawan',
                            'Mira Anggraini',
                            'Dimas Kurnia',
                            'Rasya Nugraha',
                            'Intan Maharani',
                            'Yudha Saputra',
                        ];
                    @endphp

                    @foreach ($kepsekList as $nama)
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                            <div class="card text-center border-0 shadow-sm h-100 kepsek-card">
                                <div class="card-body d-flex flex-column align-items-center justify-content-start">
                                    <img
                                        src="https://placehold.co/150x190"
                                        class="mb-3"
                                        alt="Foto {{ $nama }}">
                                    <p class="mb-0">
                                        {{ $nama }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- DATA SEKOLAH (DUMMY) --}}
        <section class="section-wrapper data-sekolah-section">
            <div class="container">
                <h2 class="section-title">Data Sekolah (Contoh)</h2>

                <div class="row justify-content-center align-items-start">
                    <div class="col-lg-7 col-xl-6 mb-4 mb-lg-0">
                        <div class="bg-white p-4 rounded-3 shadow-sm">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th class="text-dark">NPSN</th>
                                        <td class="text-dark">99999999</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Nama Sekolah</th>
                                        <td class="text-dark">SMP Fiktif Nusantara</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Kepala Sekolah</th>
                                        <td class="text-dark">Rina Kartika, M.Pd</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Admin</th>
                                        <td class="text-dark">Budi Admin Testing</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Akreditasi</th>
                                        <td class="text-dark">Z (Dummy)</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Kurikulum</th>
                                        <td class="text-dark">Kurikulum Percobaan 4.0</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Status</th>
                                        <td class="text-dark">Sekolah Contoh</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Bentuk Kepemilikan</th>
                                        <td class="text-dark">SMP (Fiktif)</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Status Kepemilikan</th>
                                        <td class="text-dark">Tidak Terdaftar</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">SK Pendirian Sekolah</th>
                                        <td class="text-dark">SK FIKTIF/01/2020</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Tanggal SK Pendirian</th>
                                        <td class="text-dark">2020-01-01</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4">
                            <a class="btn btn-light"
                               href="https://placehold.co/260x260"
                               target="_blank">
                                Tautan Dummy &raquo;
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-5 col-xl-4 text-center">
                        <img
                            src="https://placehold.co/260x260"
                            alt="Logo Dummy Sekolah"
                            class="img-fluid"
                            style="max-width: 280px;">
                    </div>
                </div>
            </div>
        </section>

        {{-- VISI & MISI (DUMMY) --}}
        <section class="section-wrapper visi-misi-section">
            <div class="container">
                <h2 class="section-title">Visi &amp; Misi (Contoh)</h2>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h3 class="section-title-small">Visi</h3>
                        <p class="text-justify mb-4">
                            <strong><i>
                                "Menjadi sekolah contoh yang digunakan untuk pengembangan, pengujian, dan demonstrasi aplikasi
                                pendidikan tanpa terikat data nyata, sehingga pengembang dapat berkreasi dengan bebas."
                            </i></strong>
                        </p>

                        <hr class="my-4">

                        <h3 class="section-title-small">Misi</h3>
                        <ul class="text-justify">
                            <li>Menyediakan data fiktif yang konsisten untuk kebutuhan uji coba tampilan dan fitur aplikasi.</li>
                            <li>Mempermudah proses pengembangan dengan contoh konten yang siap pakai dan mudah diganti.</li>
                            <li>Menjadi sandbox bagi pengembang untuk memodifikasi desain dan struktur informasi sekolah.</li>
                            <li>Mendorong eksperimen UI/UX tanpa risiko mengubah data asli dari sekolah sungguhan.</li>
                            <li>Menyajikan struktur halaman yang lengkap agar mudah diintegrasikan dengan data dinamis nantinya.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- INFO 1 - KEMENDIKBUD (BIARKAN UMUM SAJA) --}}
        <section class="section-wrapper info-section-blue">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-4 text-center mb-4 mb-lg-0">
                        <img
                            src="https://placehold.co/280x280"
                            alt="Logo Kemendikbud (Dummy)"
                            class="img-fluid"
                            style="max-width: 260px;">
                    </div>

                    <div class="col-lg-8">
                        <h3 class="section-title-small">Informasi Pendidikan (Umum)</h3>
                        <p class="text-justify mb-3">
                            Bagian ini dapat digunakan untuk menampilkan tautan atau informasi penting seputar dunia pendidikan,
                            baik itu menuju situs resmi kementerian, dinas pendidikan, ataupun portal lain yang relevan. Saat ini
                            konten yang tampil masih berupa teks contoh dan dapat diganti kapan saja sesuai kebutuhan.
                        </p>
                        <a href="https://www.kemdikbud.go.id/" target="_blank">
                            Buka Situs Resmi &raquo;
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- INFO 2 - MERDEKA BELAJAR (UMUM) --}}
        <section class="section-wrapper">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-8 mb-4 mb-lg-0 order-lg-1 order-2">
                        <h3 class="section-title-small">Contoh Informasi Tambahan</h3>
                        <p class="text-justify mb-0">
                            Bagian ini hanya berfungsi sebagai placeholder untuk menjelaskan program, kegiatan, atau informasi
                            lain yang ingin ditampilkan di halaman profil sekolah. Anda dapat menggantinya dengan deskripsi
                            program unggulan, ekstrakurikuler, atau kebijakan sekolah setelah data asli tersedia.
                        </p>
                    </div>

                    <div class="col-lg-4 text-center order-lg-2 order-1">
                        <img
                            src="https://placehold.co/260x260"
                            alt="Ilustrasi Program Sekolah"
                            class="img-fluid"
                            style="max-width: 260px;">
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
