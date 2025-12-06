@extends('frontend.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/frontend/profile.css') }}">
    <style>
        /* Layout dasar halaman profil */
        .profile-banner {
            margin-top: 80px;
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
                alt="Banner Profil Sekolah"
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
                        <h2 class="kepsek-name">Andi Tenri Awaru, S.Pd</h2>
                        <p class="kepsek-role">Kepala Sekolah UPT SPF SMPN 14 Bulukumba</p>
                    </div>

                    <div class="col-md-8">
                        <p class="kepsek-quote text-justify">
                            <strong><i>
                                "Selamat datang di website resmi UPT SPF SMPN 14 Bulukumba! Kami dengan bangga menyambut Anda
                                untuk menjelajahi berbagai informasi terkini seputar kegiatan, prestasi, dan perkembangan pendidikan
                                di sekolah kami. Melalui platform ini, kami berkomitmen memperkuat kolaborasi antara sekolah, siswa,
                                orang tua, dan masyarakat. Terima kasih atas dukungan Anda dalam mewujudkan visi dan misi kami untuk
                                memberikan pendidikan berkualitas dan mempersiapkan generasi masa depan yang tangguh. Selamat menikmati
                                pengalaman menjelajahi website ini!"
                            </i></strong>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- SEJARAH SEKOLAH --}}
        <section class="section-wrapper">
            <div class="container">
                <h2 class="section-title">Sejarah SMPN 14 Bulukumba</h2>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <p class="text-justify mb-3">
                            SMP Negeri 14 Bulukumba yang dulunya bernama SMP Negeri 1 berdiri di atas tanah persawahan yang
                            diwakafkan oleh masyarakat di Tanete - Bulukumpa. Pada tahun 1961, di bawah pimpinan Distrik
                            atau Karaeng Tanete Andi Abd. Syukur, dirintis pendirian sekolah sederhana bernama
                            SMP Negeri 1 Tanete. Usaha tersebut dilanjutkan oleh Karaeng Mansur, seiring perubahan sistem
                            pemerintahan distrik Bulukumpa menjadi Kecamatan Bulukumpa.
                        </p>
                        <p class="text-justify mb-3">
                            Sejak saat itu SMP Negeri 1 Bulukumpa (kini SMPN 14 Bulukumba) berkembang menjadi salah satu sekolah
                            favorit dan telah melahirkan banyak generasi muda bagi bangsa. Perkembangan sarana prasarana,
                            tenaga pendidik, staf, dan peserta didik terus mengalami peningkatan sejalan dengan tuntutan zaman.
                        </p>
                        <p class="text-justify mb-0">
                            Pada tahun 2012 SMP Negeri 1 Bulukumpa resmi berubah status menjadi SMP Negeri 14 Bulukumba
                            berdasarkan kebijakan Pemerintah Daerah Kabupaten Bulukumba dalam rangka penataan pendidikan
                            menengah pertama. Hal ini diperkuat dengan Keputusan Bupati Bulukumba
                            Nomor: Kpts.241/V/2012 tentang penetapan sekolah menengah pertama negeri dan sekolah menengah pertama
                            negeri satu atap di wilayah Kabupaten Bulukumba.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- KEPALA SEKOLAH YANG PERNAH MENJABAT --}}
        <section class="section-wrapper">
            <div class="container">
                <h2 class="section-title">Kepala Sekolah yang Pernah Menjabat</h2>

                <div class="row g-4 justify-content-center">
                    @php
                        $kepsekList = [
                            'Abd. Wahab Dg. Culle',
                            'Muh. Ansar Dg. Djuppa',
                            'Muh. Yahya Nur',
                            'A. Ambo Tuwo Paki',
                            'Abd. Muin Hamili',
                            'Muslimin Bibu',
                            'Abd. Latif Nonci',
                            'Mahamuddin',
                            'A. Makmur Andi Accing',
                            'A. Muh. Jafar Beddang',
                            'A. Pananrangi',
                            'Abd. Muis',
                            'Amiruddin Umar',
                            'Jumrah',
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

        {{-- DATA SEKOLAH --}}
        <section class="section-wrapper data-sekolah-section">
            <div class="container">
                <h2 class="section-title">Data Sekolah</h2>

                <div class="row justify-content-center align-items-start">
                    <div class="col-lg-7 col-xl-6 mb-4 mb-lg-0">
                        <div class="bg-white p-4 rounded-3 shadow-sm">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th class="text-dark">NPSN</th>
                                        <td class="text-dark">40304206</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Kepala Sekolah</th>
                                        <td class="text-dark">Andi Tenri Awaru, S.Pd</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Admin</th>
                                        <td class="text-dark">Muhammad Amin</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Akreditasi</th>
                                        <td class="text-dark">B</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Kurikulum</th>
                                        <td class="text-dark">Kurikulum Merdeka</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Status</th>
                                        <td class="text-dark">Negeri</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Bentuk Kepemilikan</th>
                                        <td class="text-dark">SMP</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Status Kepemilikan</th>
                                        <td class="text-dark">Pemerintah Daerah</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">SK Pendirian Sekolah</th>
                                        <td class="text-dark">-</td>
                                    </tr>
                                    <tr>
                                        <th class="text-dark">Tanggal SK Pendirian</th>
                                        <td class="text-dark">1960-01-01</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4">
                            <a class="btn btn-light"
                               href="https://placehold.co/260x260"
                               target="_blank">
                                Selengkapnya di Dapodik &raquo;
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-5 col-xl-4 text-center">
                        <img
                            src="https://placehold.co/260x260"
                            alt="Logo SMPN 14 Bulukumba"
                            class="img-fluid"
                            style="max-width: 280px;">
                    </div>
                </div>
            </div>
        </section>

        {{-- VISI & MISI --}}
        <section class="section-wrapper visi-misi-section">
            <div class="container">
                <h2 class="section-title">Visi &amp; Misi</h2>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <h3 class="section-title-small">Visi</h3>
                        <p class="text-justify mb-4">
                            <strong><i>
                                "Berprestasi dalam bidang akademik dan non akademik berdasarkan imtaq serta berperan aktif
                                dalam mencegah pencemaran dan kerusakan lingkungan hidup berdasarkan imtaq, iptek, dan norma."
                            </i></strong>
                        </p>

                        <hr class="my-4">

                        <h3 class="section-title-small">Misi</h3>
                        <ul class="text-justify">
                            <li>Melaksanakan penerimaan siswa baru secara bertahap, transparan, dan objektif.</li>
                            <li>Meningkatkan kedisiplinan warga sekolah untuk menciptakan SDM berkualitas dan sekolah berwawasan lingkungan.</li>
                            <li>Melaksanakan Kurikulum Merdeka/K13 secara efisien dengan inovasi pembelajaran bernuansa IMTAQ, IPTEK, dan lingkungan.</li>
                            <li>Menyediakan dan memanfaatkan sarana prasarana akademik untuk pengembangan sekolah dan peningkatan mutu pendidikan.</li>
                            <li>Melaksanakan evaluasi belajar (ulangan, analisis, remedial, pengayaan) secara optimal.</li>
                            <li>Menerapkan manajemen partisipatif dengan melibatkan masyarakat, komite sekolah, dan pemerintah.</li>
                            <li>Memberdayakan potensi lingkungan untuk pengembangan keterampilan produktif dan kepedulian lingkungan.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- INFO 1 - KEMENDIKBUD --}}
        <section class="section-wrapper info-section-blue">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-4 text-center mb-4 mb-lg-0">
                        <img
                            src="https://placehold.co/280x280"
                            alt="Logo Kemendikbud"
                            class="img-fluid"
                            style="max-width: 260px;">
                    </div>

                    <div class="col-lg-8">
                        <h3 class="section-title-small">Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi</h3>
                        <p class="text-justify mb-3">
                            Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi (Kemendikbudristek) adalah kementerian
                            yang menyelenggarakan urusan pendidikan, kebudayaan, penelitian, riset, dan pengembangan teknologi
                            di Indonesia. Kemendikbudristek berada di bawah dan bertanggung jawab kepada Presiden Republik
                            Indonesia dan dipimpin oleh seorang Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi.
                        </p>
                        <a href="https://www.kemdikbud.go.id/" target="_blank">
                            Selengkapnya &raquo;
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- INFO 2 - MERDEKA BELAJAR --}}
        <section class="section-wrapper">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-8 mb-4 mb-lg-0 order-lg-1 order-2">
                        <h3 class="section-title-small">Merdeka Belajar</h3>
                        <p class="text-justify mb-0">
                            Merdeka Belajar merupakan kebijakan yang memberikan ruang bagi satuan pendidikan, guru, dan siswa
                            untuk lebih leluasa berinovasi, berkreasi, dan berkolaborasi dalam proses pembelajaran. Fokusnya
                            adalah pada penguatan kompetensi, karakter, serta relevansi pembelajaran dengan kehidupan nyata
                            sehingga peserta didik siap menghadapi tantangan masa depan.
                        </p>
                    </div>

                    <div class="col-lg-4 text-center order-lg-2 order-1">
                        <img
                            src="https://placehold.co/260x260"
                            alt="Logo Merdeka Belajar"
                            class="img-fluid"
                            style="max-width: 260px;">
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection