@extends('frontend/main')

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
            font-weight: 400;
        }

        .section-content {
            padding: 4rem 0;
            background-color: var(--color-bg);
        }

        /* Facilities Grid */
        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 2rem;
        }

        .facility-card {
            background: #ffffff;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--color-border);
        }

        .facility-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-xl);
            border-color: transparent;
        }

        .facility-card-image {
            width: 100%;
            height: 260px;
            overflow: hidden;
            position: relative;
        }

        .facility-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .facility-card:hover .facility-card-image img {
            transform: scale(1.06);
        }

        .facility-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--color-primary);
            color: #ffffff;
            padding: 0.4rem 0.9rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.02em;
        }

        .facility-card-body {
            padding: 1.75rem;
        }

        .facility-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 0.5rem;
            letter-spacing: -0.01em;
        }

        .facility-description {
            font-size: 0.9rem;
            color: var(--color-text-light);
            line-height: 1.7;
            margin-bottom: 1.25rem;
        }

        .facility-features {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
        }

        .feature-tag {
            display: inline-flex;
            align-items: center;
            padding: 0.3rem 0.75rem;
            background: rgba(13, 148, 136, 0.08);
            color: var(--color-accent);
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .feature-tag i {
            margin-right: 0.3rem;
            font-size: 0.65rem;
        }

        /* Stats Section */
        .stats-section {
            background: var(--gradient-primary);
            padding: 3.5rem 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 2rem;
            max-width: 900px;
            margin: 0 auto;
        }

        .stat-item {
            text-align: center;
            color: #ffffff;
        }

        .stat-number {
            font-size: 2.75rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 0.4rem;
        }

        .stat-label {
            font-size: 0.95rem;
            font-weight: 500;
            opacity: 0.85;
        }

        @media (max-width: 768px) {
            .section-header { padding: 3rem 0 2rem; }
            .section-content { padding: 3rem 0; }
            .facilities-grid { grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
            .facility-card-image { height: 220px; }
            .facility-card-body { padding: 1.25rem; }
            .stat-number { font-size: 2.25rem; }
        }

        @media (max-width: 576px) {
            .facilities-grid { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
        }
    </style>
@endsection

@section('content')
    {{-- Header --}}
    <div class="section-header">
        <div class="container">
            <h1 data-aos="fade-up">Fasilitas Sekolah</h1>
            <p data-aos="fade-up" data-aos-delay="100">Sarana dan prasarana penunjang kegiatan belajar mengajar</p>
        </div>
    </div>

    {{-- Breadcrumb --}}
    <nav class="page-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Fasilitas</li>
            </ol>
        </div>
    </nav>

    {{-- Facilities --}}
    <div class="section-content">
        <div class="container">
            <div class="facilities-grid">
                @php
                    $facilities = [
                        [
                            'name' => 'Ruang Kelas',
                            'category' => 'Akademik',
                            'image' => 'https://placehold.co/600x400/1e3a5f/ffffff?text=Ruang+Kelas',
                            'description' => 'Ruang kelas yang nyaman dan dilengkapi dengan meja, kursi, papan tulis, serta ventilasi yang baik untuk menunjang proses belajar mengajar.',
                            'features' => ['Ventilasi Baik', 'Pencahayaan Cukup', 'Kapasitas 32 Siswa']
                        ],
                        [
                            'name' => 'Perpustakaan',
                            'category' => 'Akademik',
                            'image' => 'https://placehold.co/600x400/0d9488/ffffff?text=Perpustakaan',
                            'description' => 'Perpustakaan sekolah menyediakan berbagai koleksi buku pelajaran, buku bacaan umum, dan referensi untuk menunjang literasi siswa.',
                            'features' => ['Koleksi Lengkap', 'Ruang Baca Nyaman']
                        ],
                        [
                            'name' => 'Laboratorium IPA',
                            'category' => 'Akademik',
                            'image' => 'https://placehold.co/600x400/2563eb/ffffff?text=Lab+IPA',
                            'description' => 'Laboratorium IPA dilengkapi peralatan praktikum untuk mata pelajaran Fisika, Kimia, dan Biologi sesuai kurikulum.',
                            'features' => ['Alat Praktikum', 'Ruang Steril', 'Meja Lab', 'Ventilasi Khusus']
                        ],
                        [
                            'name' => 'Laboratorium Komputer',
                            'category' => 'Teknologi',
                            'image' => 'https://placehold.co/600x400/f59e0b/ffffff?text=Lab+Komputer',
                            'description' => 'Ruang komputer dilengkapi unit PC dan jaringan internet untuk kegiatan pembelajaran TIK dan ujian berbasis komputer.',
                            'features' => ['Unit Komputer', 'Koneksi Internet']
                        ],
                        [
                            'name' => 'Lapangan Olahraga',
                            'category' => 'Olahraga',
                            'image' => 'https://placehold.co/600x400/1e3a5f/ffffff?text=Lapangan',
                            'description' => 'Lapangan olahraga untuk kegiatan pendidikan jasmani, upacara bendera, dan berbagai kegiatan luar ruangan.',
                            'features' => ['Lapangan Serbaguna', 'Area Upacara', 'Lintasan']
                        ],
                        [
                            'name' => 'Musholla',
                            'category' => 'Ibadah',
                            'image' => 'https://placehold.co/600x400/0d9488/ffffff?text=Musholla',
                            'description' => 'Tempat ibadah yang bersih dan nyaman untuk kegiatan sholat berjamaah dan kegiatan keagamaan lainnya.',
                            'features' => ['Bersih & Nyaman', 'Perlengkapan Sholat']
                        ]
                    ];
                @endphp

                @foreach ($facilities as $index => $facility)
                    <div class="facility-card" data-aos="fade-up" data-aos-delay="{{ min($index * 80, 400) }}">
                        <div class="facility-card-image">
                            <img src="{{ $facility['image'] }}" alt="{{ $facility['name'] }}">
                            <span class="facility-badge">{{ $facility['category'] }}</span>
                        </div>
                        <div class="facility-card-body">
                            <h3 class="facility-name">{{ $facility['name'] }}</h3>
                            <p class="facility-description">{{ $facility['description'] }}</p>
                            
                            <div class="facility-features">
                                @foreach ($facility['features'] as $feature)
                                    <span class="feature-tag">
                                        <i class="fas fa-check-circle"></i>
                                        {{ $feature }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Stats --}}
    <div class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item" data-aos="fade-up" data-aos-delay="0">
                    <div class="stat-number">12</div>
                    <div class="stat-label">Ruang Kelas</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-number">2</div>
                    <div class="stat-label">Laboratorium</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-number">1</div>
                    <div class="stat-label">Perpustakaan</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-number">6</div>
                    <div class="stat-label">Fasilitas Pendukung</div>
                </div>
            </div>
        </div>
    </div>
@endsection