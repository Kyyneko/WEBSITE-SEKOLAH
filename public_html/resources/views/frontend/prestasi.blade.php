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



        @media (max-width: 768px) {
            .section-header { padding: 3rem 0 2rem; }
            .section-content { padding: 3rem 0; }
            .filter-tabs { gap: 0.4rem; }
            .filter-tab { padding: 0.5rem 1.2rem; font-size: 0.8rem; }
            .achievements-grid { grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
            .achievement-card-image { height: 200px; }
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
                <button class="filter-tab active" data-category="all">Semua</button>
                <button class="filter-tab" data-category="Akademik">Akademik</button>
                <button class="filter-tab" data-category="Olahraga">Olahraga</button>
                <button class="filter-tab" data-category="Seni">Seni</button>
                <button class="filter-tab" data-category="Lainnya">Lainnya</button>
            </div>

            <div class="achievements-grid">
                @php
                    $hasDbAchievements = isset($achievements) && $achievements->count() > 0;
                    $displayAchievements = [];
                    
                    if ($hasDbAchievements) {
                        foreach ($achievements as $achievement) {
                            $displayAchievements[] = [
                                'title' => $achievement->title,
                                'category' => $achievement->category,
                                'medal' => $achievement->medal,
                                'student' => $achievement->student,
                                'date' => $achievement->date,
                                'location' => $achievement->location,
                                'image' => ($achievement->photo_path && file_exists(public_path('storage/' . str_replace('public/', '', $achievement->photo_path)))) ? asset('storage/' . str_replace('public/', '', $achievement->photo_path)) : 'https://placehold.co/600x400/1e3a5f/ffffff?text=' . urlencode($achievement->title),
                                'description' => $achievement->description,
                            ];
                        }
                    } else {
                        $displayAchievements = [
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
                    }
                @endphp

                @foreach ($displayAchievements as $index => $achievement)
                    <div class="achievement-card" data-category="{{ $achievement['category'] }}" data-aos="fade-up" data-aos-delay="{{ min($index * 80, 400) }}">
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


@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.filter-tab');
        const cards = document.querySelectorAll('.achievement-card');

        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');

                const category = this.getAttribute('data-category');

                cards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    if (category === 'all' || cardCategory === category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endpush