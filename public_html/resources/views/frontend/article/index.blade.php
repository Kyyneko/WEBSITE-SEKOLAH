@extends('frontend.main')

@section('style')
    <style>
        .section-header {
            margin-top: 0;
            padding: calc(4rem + 70px) 0 3rem;
            background: var(--gradient-primary);
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .section-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }

        .section-header h1 {
            font-size: clamp(1.75rem, 4vw, 2.75rem);
            font-weight: 800;
            text-align: center;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .section-header p {
            text-align: center;
            font-size: 1rem;
            margin-top: 0.75rem;
            opacity: 0.85;
        }

        .section-content {
            padding: 4rem 0;
            background-color: var(--color-bg);
        }

        /* Articles Grid */
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .article-card {
            background: #ffffff;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            border: 1px solid var(--color-border);
        }

        .article-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-xl);
            border-color: transparent;
        }

        .article-card a {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .article-card-image {
            width: 100%;
            height: 210px;
            overflow: hidden;
        }

        .article-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .article-card:hover .article-card-image img {
            transform: scale(1.06);
        }

        .article-card-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .article-meta {
            font-size: 0.7rem;
            color: var(--color-text-light);
            font-weight: 600;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .article-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 0.6rem;
            line-height: 1.4;
        }

        .article-excerpt {
            font-size: 0.875rem;
            color: var(--color-text-light);
            line-height: 1.6;
            flex-grow: 1;
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            margin-top: 1rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--color-primary-light);
            transition: gap 0.3s ease;
        }

        .article-card:hover .read-more {
            gap: 0.7rem;
        }

        @media (max-width: 768px) {
            .section-header { padding: 3rem 0 2rem; }
            .section-content { padding: 3rem 0; }
            .articles-grid { grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1.5rem; }
        }

        @media (max-width: 576px) {
            .articles-grid { grid-template-columns: 1fr; }
        }
    </style>
@endsection

@section('content')
    {{-- Header --}}
    <div class="section-header">
        <div class="container">
            <h1 data-aos="fade-up">Artikel & Berita</h1>
            <p data-aos="fade-up" data-aos-delay="100">Informasi terbaru seputar kegiatan dan program sekolah</p>
        </div>
    </div>

    {{-- Breadcrumb --}}
    <nav class="page-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Artikel</li>
            </ol>
        </div>
    </nav>

    {{-- Articles --}}
    <div class="section-content">
        <div class="container">
            <div class="articles-grid">
                @php
                    $articles = [
                        [
                            'title' => 'Pelaksanaan Ujian Akhir Semester Genap 2024',
                            'author' => 'Admin',
                            'date' => 'Senin, 15 Januari 2024',
                            'slug' => 'pelaksanaan-uas-genap',
                            'image' => 'https://placehold.co/400x300/1e3a5f/ffffff?text=UAS+2024',
                            'excerpt' => 'Kegiatan Ujian Akhir Semester Genap tahun ajaran 2023/2024 telah dilaksanakan dengan tertib. Seluruh siswa mengikuti ujian dengan penuh semangat.'
                        ],
                        [
                            'title' => 'Peringatan Hari Pendidikan Nasional',
                            'author' => 'Admin',
                            'date' => 'Kamis, 2 Mei 2024',
                            'slug' => 'hari-pendidikan-nasional',
                            'image' => 'https://placehold.co/400x300/0d9488/ffffff?text=HARDIKNAS',
                            'excerpt' => 'Seluruh warga sekolah memperingati Hari Pendidikan Nasional dengan upacara bendera dan berbagai lomba kreativitas siswa.'
                        ],
                        [
                            'title' => 'Kegiatan Kemah Bakti Pramuka',
                            'author' => 'Pembina Pramuka',
                            'date' => 'Sabtu, 17 Agustus 2024',
                            'slug' => 'kemah-bakti-pramuka',
                            'image' => 'https://placehold.co/400x300/f59e0b/ffffff?text=PRAMUKA',
                            'excerpt' => 'Siswa mengikuti kemah bakti dalam rangka peringatan Hari Kemerdekaan RI ke-79 dengan berbagai kegiatan kepanduan.'
                        ],
                        [
                            'title' => 'Sosialisasi Kurikulum Merdeka',
                            'author' => 'Kurikulum',
                            'date' => 'Jumat, 20 September 2024',
                            'slug' => 'sosialisasi-kurikulum-merdeka',
                            'image' => 'https://placehold.co/400x300/2563eb/ffffff?text=KURIKULUM',
                            'excerpt' => 'Sosialisasi implementasi Kurikulum Merdeka kepada guru dan orang tua siswa untuk peningkatan kualitas pembelajaran.'
                        ],
                        [
                            'title' => 'Tim LCC Raih Juara 2 Tingkat Kabupaten',
                            'author' => 'Kesiswaan',
                            'date' => 'Senin, 5 Oktober 2024',
                            'slug' => 'juara-lcc-kabupaten',
                            'image' => 'https://placehold.co/400x300/1e3a5f/ffffff?text=LCC',
                            'excerpt' => 'Tim cerdas cermat SMPN 14 berhasil meraih Juara 2 dalam kompetisi tingkat Kabupaten Bulukumba tahun 2024.'
                        ],
                        [
                            'title' => 'Workshop Literasi Digital untuk Siswa',
                            'author' => 'BK',
                            'date' => 'Rabu, 15 November 2024',
                            'slug' => 'workshop-literasi-digital',
                            'image' => 'https://placehold.co/400x300/0d9488/ffffff?text=LITERASI',
                            'excerpt' => 'Workshop literasi digital untuk meningkatkan kesadaran siswa dalam penggunaan teknologi secara bijak dan bertanggung jawab.'
                        ],
                        [
                            'title' => 'Pentas Seni Akhir Tahun 2024',
                            'author' => 'OSIS',
                            'date' => 'Jumat, 20 Desember 2024',
                            'slug' => 'pentas-seni-2024',
                            'image' => 'https://placehold.co/400x300/f59e0b/ffffff?text=PENTAS+SENI',
                            'excerpt' => 'Pentas seni akhir tahun menampilkan berbagai bakat siswa dalam bidang musik, tari tradisional, dan drama.'
                        ],
                        [
                            'title' => 'Informasi PPDB Tahun Ajaran 2025/2026',
                            'author' => 'Panitia PPDB',
                            'date' => 'Minggu, 5 Januari 2025',
                            'slug' => 'ppdb-2025',
                            'image' => 'https://placehold.co/400x300/2563eb/ffffff?text=PPDB+2025',
                            'excerpt' => 'Informasi lengkap mengenai jadwal, persyaratan, dan tata cara pendaftaran peserta didik baru tahun ajaran 2025/2026.'
                        ],
                        [
                            'title' => 'Kegiatan Jumat Bersih dan Penghijauan',
                            'author' => 'Admin',
                            'date' => 'Jumat, 24 Januari 2025',
                            'slug' => 'jumat-bersih',
                            'image' => 'https://placehold.co/400x300/0d9488/ffffff?text=LINGKUNGAN',
                            'excerpt' => 'Program Jumat Bersih rutin dilaksanakan untuk menjaga kebersihan lingkungan sekolah dan menanamkan kesadaran lingkungan.'
                        ]
                    ];
                @endphp

                @foreach ($articles as $index => $article)
                    <div class="article-card" data-aos="fade-up" data-aos-delay="{{ min($index * 60, 360) }}">
                        <a href="{{ url('/article/' . $article['slug']) }}">
                            <div class="article-card-image">
                                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}">
                            </div>
                            <div class="article-card-body">
                                <p class="article-meta">
                                    {{ $article['author'] }} &middot; {{ $article['date'] }}
                                </p>
                                <h3 class="article-title">{{ $article['title'] }}</h3>
                                <p class="article-excerpt">{{ $article['excerpt'] }}</p>
                                <span class="read-more">
                                    Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
