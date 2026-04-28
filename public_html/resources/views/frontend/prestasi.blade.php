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
        }

        .section-content {
            padding: 4rem 0;
            background-color: var(--color-bg);
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 0.6rem 1.5rem;
            background: #ffffff;
            border: 1px solid var(--color-border);
            border-radius: 24px;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--color-text-light);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-tab:hover {
            border-color: var(--color-primary-light);
            color: var(--color-primary-light);
        }

        .filter-tab.active {
            background: var(--gradient-primary);
            color: #ffffff;
            border-color: transparent;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
        }

        /* Achievements Grid */
        .achievements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
        }

        .achievement-card {
            background: #ffffff;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--color-border);
            position: relative;
        }

        .achievement-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-xl);
            border-color: transparent;
        }

        .achievement-card-image {
            width: 100%;
            height: 230px;
            overflow: hidden;
            position: relative;
        }

        .achievement-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .achievement-card:hover .achievement-card-image img {
            transform: scale(1.06);
        }

        .medal-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: var(--shadow-md);
        }

        .medal-gold { background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); }
        .medal-silver { background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%); }
        .medal-bronze { background: linear-gradient(135deg, #cd7f32 0%, #e8a87c 100%); }

        .category-badge {
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

        .achievement-card-body { padding: 1.5rem; }

        .achievement-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .achievement-meta {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            margin-bottom: 0.75rem;
            font-size: 0.85rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--color-text-light);
        }

        .meta-item i {
            color: var(--color-primary-light);
            width: 16px;
            font-size: 0.8rem;
        }

        .achievement-description {
            font-size: 0.875rem;
            color: var(--color-text-light);
            line-height: 1.6;
        }

        /* Timeline */
        .timeline-section {
            padding: 4.5rem 0;
            background: #ffffff;
        }

        .timeline-section .section-heading {
            text-align: center;
            margin-bottom: 3rem;
        }

        .timeline-section .section-heading h2 {
            font-size: clamp(1.75rem, 3vw, 2.25rem);
            font-weight: 800;
            color: var(--color-text);
            letter-spacing: -0.02em;
        }

        .timeline {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            padding: 0 1rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 92px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--color-border);
        }

        .timeline-item {
            display: flex;
            gap: 2rem;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 86px;
            top: 8px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: var(--color-primary-light);
            border: 3px solid #ffffff;
            box-shadow: 0 0 0 2px var(--color-primary-light);
            z-index: 1;
        }

        .timeline-year {
            flex-shrink: 0;
            width: 80px;
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--color-primary-light);
            text-align: right;
        }

        .timeline-content {
            flex-grow: 1;
            background: var(--color-bg);
            padding: 1.25rem 1.5rem;
            border-radius: var(--radius-md);
            border-left: 3px solid var(--color-primary-light);
            margin-left: 1rem;
        }

        .timeline-content h3 {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 0.4rem;
        }

        .timeline-content p {
            color: var(--color-text-light);
            line-height: 1.6;
            margin: 0;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .section-header { padding: 3rem 0 2rem; }
            .section-content { padding: 3rem 0; }
            .filter-tabs { gap: 0.4rem; }
            .filter-tab { padding: 0.5rem 1.2rem; font-size: 0.8rem; }
            .achievements-grid { grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
            .achievement-card-image { height: 200px; }
            .timeline-item { flex-direction: column; gap: 0.75rem; }
            .timeline-year { text-align: left; width: auto; }
            .timeline::before { display: none; }
            .timeline-item::before { display: none; }
            .timeline-content { margin-left: 0; }
        }

        @media (max-width: 576px) {
            .achievements-grid { grid-template-columns: 1fr; }
        }
    </style>
@endsection

@section('content')
    {{-- Header --}}
    <div class="section-header">
        <div class="container">
            <h1 data-aos="fade-up">Prestasi Sekolah</h1>
            <p data-aos="fade-up" data-aos-delay="100">Capaian membanggakan siswa-siswi UPT SPF SMPN 14 BULUKUMBA</p>
        </div>
    </div>

    {{-- Breadcrumb --}}
    <nav class="page-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Prestasi</li>
            </ol>
        </div>
    </nav>

    {{-- Filter + Grid --}}
    <div class="section-content">
        <div class="container">
            <div class="filter-tabs" data-aos="fade-up">
                <button class="filter-tab active">Semua</button>
                <button class="filter-tab">Akademik</button>
                <button class="filter-tab">Olahraga</button>
                <button class="filter-tab">Seni</button>
                <button class="filter-tab">Lainnya</button>
            </div>

            <div class="achievements-grid">
                @php
                    $achievements = [
                        [
                            'title' => 'Juara 2 Lomba Cerdas Cermat Kabupaten',
                            'category' => 'Akademik',
                            'medal' => 'silver',
                            'student' => 'Tim LCC SMPN 14',
                            'date' => 'Oktober 2024',
                            'location' => 'Kab. Bulukumba',
                            'image' => 'https://placehold.co/600x400/1e3a5f/ffffff?text=LCC',
                            'description' => 'Tim cerdas cermat berhasil meraih juara 2 dalam lomba tingkat kabupaten mengalahkan puluhan tim dari sekolah lain.'
                        ],
                        [
                            'title' => 'Juara 1 Lomba Lari 100m Tingkat Kecamatan',
                            'category' => 'Olahraga',
                            'medal' => 'gold',
                            'student' => 'Ahmad Fauzan',
                            'date' => 'Agustus 2024',
                            'location' => 'Kec. Bulukumpa',
                            'image' => 'https://placehold.co/600x400/0d9488/ffffff?text=ATLETIK',
                            'description' => 'Siswa kelas IX meraih medali emas cabang lari 100 meter dalam perlombaan peringatan HUT RI ke-79.'
                        ],
                        [
                            'title' => 'Juara 3 Festival Seni Budaya Daerah',
                            'category' => 'Seni',
                            'medal' => 'bronze',
                            'student' => 'Tim Seni SMPN 14',
                            'date' => 'November 2024',
                            'location' => 'Kab. Bulukumba',
                            'image' => 'https://placehold.co/600x400/f59e0b/ffffff?text=SENI',
                            'description' => 'Penampilan tari tradisional dari tim seni berhasil meraih juara 3 dalam Festival Seni Budaya tingkat kabupaten.'
                        ],
                        [
                            'title' => 'Juara 1 Olimpiade Matematika Kecamatan',
                            'category' => 'Akademik',
                            'medal' => 'gold',
                            'student' => 'Nurhalisa',
                            'date' => 'September 2024',
                            'location' => 'Kec. Bulukumpa',
                            'image' => 'https://placehold.co/600x400/2563eb/ffffff?text=OLIMPIADE',
                            'description' => 'Siswi kelas VIII meraih medali emas dalam Olimpiade Matematika tingkat kecamatan dan mewakili ke tingkat kabupaten.'
                        ],
                        [
                            'title' => 'Juara 1 Turnamen Bola Voli Antar SMP',
                            'category' => 'Olahraga',
                            'medal' => 'gold',
                            'student' => 'Tim Voli Putra',
                            'date' => 'Juli 2024',
                            'location' => 'Kec. Bulukumpa',
                            'image' => 'https://placehold.co/600x400/1e3a5f/ffffff?text=VOLI',
                            'description' => 'Tim bola voli putra meraih juara 1 dalam turnamen antar SMP se-kecamatan Bulukumpa.'
                        ],
                        [
                            'title' => 'Juara 2 Lomba Pidato Bahasa Indonesia',
                            'category' => 'Seni',
                            'medal' => 'silver',
                            'student' => 'Siti Aisyah',
                            'date' => 'Mei 2024',
                            'location' => 'Kab. Bulukumba',
                            'image' => 'https://placehold.co/600x400/0d9488/ffffff?text=PIDATO',
                            'description' => 'Siswi kelas VIII meraih juara 2 dalam lomba pidato Bahasa Indonesia tingkat kabupaten dengan tema pendidikan karakter.'
                        ]
                    ];
                @endphp

                @foreach ($achievements as $index => $achievement)
                    <div class="achievement-card" data-aos="fade-up" data-aos-delay="{{ min($index * 80, 400) }}">
                        <div class="achievement-card-image">
                            <img src="{{ $achievement['image'] }}" alt="{{ $achievement['title'] }}">
                            <div class="medal-badge medal-{{ $achievement['medal'] }}">
                                @if($achievement['medal'] == 'gold') 🥇
                                @elseif($achievement['medal'] == 'silver') 🥈
                                @else 🥉
                                @endif
                            </div>
                            <span class="category-badge">{{ $achievement['category'] }}</span>
                        </div>
                        
                        <div class="achievement-card-body">
                            <h3 class="achievement-title">{{ $achievement['title'] }}</h3>
                            <div class="achievement-meta">
                                <div class="meta-item"><i class="fas fa-user"></i><span>{{ $achievement['student'] }}</span></div>
                                <div class="meta-item"><i class="fas fa-calendar"></i><span>{{ $achievement['date'] }}</span></div>
                                <div class="meta-item"><i class="fas fa-map-marker-alt"></i><span>{{ $achievement['location'] }}</span></div>
                            </div>
                            <p class="achievement-description">{{ $achievement['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Timeline --}}
    <div class="timeline-section">
        <div class="container">
            <div class="section-heading" data-aos="fade-up">
                <h2>Jejak Prestasi</h2>
            </div>
            
            <div class="timeline">
                <div class="timeline-item" data-aos="fade-up" data-aos-delay="0">
                    <div class="timeline-year">2024</div>
                    <div class="timeline-content">
                        <h3>Tahun Penuh Prestasi</h3>
                        <p>Meraih 6 penghargaan di berbagai bidang lomba tingkat kecamatan dan kabupaten, termasuk akademik, olahraga, dan seni budaya.</p>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="timeline-year">2023</div>
                    <div class="timeline-content">
                        <h3>Peningkatan Mutu Pendidikan</h3>
                        <p>Implementasi Kurikulum Merdeka diikuti peningkatan partisipasi siswa dalam berbagai kegiatan akademik dan non-akademik.</p>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="timeline-year">2022</div>
                    <div class="timeline-content">
                        <h3>Pemulihan Pasca Pandemi</h3>
                        <p>Kegiatan pembelajaran tatap muka kembali dilaksanakan secara penuh dengan fokus pemulihan pembelajaran dan kegiatan siswa.</p>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="timeline-year">2021</div>
                    <div class="timeline-content">
                        <h3>Adaptasi Pembelajaran Daring</h3>
                        <p>Sekolah berhasil mengadaptasi model pembelajaran daring dan luring (hybrid) untuk memastikan kelanjutan pendidikan di masa pandemi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection