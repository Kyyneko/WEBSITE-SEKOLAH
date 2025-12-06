@extends('frontend/main')

@section('style')
    <style>
        .section-header {
            margin-top: 80px;
            padding: 4rem 0 3rem;
            background: linear-gradient(135deg, rgb(19, 123, 191) 0%, rgb(16, 100, 160) 100%);
            color: #ffffff;
        }

        .section-header h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            text-align: center;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .section-header p {
            text-align: center;
            font-size: 1.1rem;
            margin-top: 1rem;
            opacity: 0.9;
        }

        .section-content {
            padding: 4rem 0;
            background-color: #f8fafc;
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 0.75rem 2rem;
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 25px;
            font-weight: 600;
            color: #4a5568;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-tab:hover {
            border-color: rgb(19, 123, 191);
            color: rgb(19, 123, 191);
        }

        .filter-tab.active {
            background: linear-gradient(135deg, rgb(19, 123, 191) 0%, rgb(16, 100, 160) 100%);
            color: #ffffff;
            border-color: transparent;
        }

        /* Achievements Grid */
        .achievements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            padding: 0 1rem;
        }

        .achievement-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            position: relative;
        }

        .achievement-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .achievement-card-image {
            width: 100%;
            height: 250px;
            overflow: hidden;
            background: #e2e8f0;
            position: relative;
        }

        .achievement-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .achievement-card:hover .achievement-card-image img {
            transform: scale(1.05);
        }

        /* Medal Badge */
        .medal-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .medal-gold {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        }

        .medal-silver {
            background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%);
        }

        .medal-bronze {
            background: linear-gradient(135deg, #cd7f32 0%, #e8a87c 100%);
        }

        /* Category Badge */
        .category-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(19, 123, 191, 0.95);
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .achievement-card-body {
            padding: 1.5rem;
        }

        .achievement-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .achievement-meta {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #4a5568;
        }

        .meta-item i {
            color: rgb(19, 123, 191);
            width: 20px;
        }

        .achievement-description {
            font-size: 0.95rem;
            color: #4a5568;
            line-height: 1.6;
        }

        /* Timeline Style for certain achievements */
        .timeline-section {
            padding: 4rem 0;
            background: #ffffff;
        }

        .timeline-section h2 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 3rem;
        }

        .timeline {
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
            padding: 0 1rem;
        }

        .timeline-item {
            display: flex;
            gap: 2rem;
            margin-bottom: 3rem;
            position: relative;
        }

        .timeline-year {
            flex-shrink: 0;
            width: 100px;
            font-size: 1.5rem;
            font-weight: 700;
            color: rgb(19, 123, 191);
            text-align: right;
        }

        .timeline-content {
            flex-grow: 1;
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 12px;
            border-left: 4px solid rgb(19, 123, 191);
        }

        .timeline-content h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.5rem;
        }

        .timeline-content p {
            color: #4a5568;
            line-height: 1.6;
            margin: 0;
        }

        @media (max-width: 768px) {
            .section-header {
                padding: 3rem 0 2rem;
            }

            .section-content {
                padding: 3rem 0;
            }

            .filter-tabs {
                gap: 0.5rem;
            }

            .filter-tab {
                padding: 0.6rem 1.5rem;
                font-size: 0.9rem;
            }

            .achievements-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 1.5rem;
            }

            .achievement-card-image {
                height: 220px;
            }

            .timeline-item {
                flex-direction: column;
                gap: 1rem;
            }

            .timeline-year {
                text-align: left;
                width: auto;
            }
        }

        @media (max-width: 576px) {
            .achievements-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .achievement-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .achievement-card:nth-child(1) { animation-delay: 0.1s; }
        .achievement-card:nth-child(2) { animation-delay: 0.2s; }
        .achievement-card:nth-child(3) { animation-delay: 0.3s; }
        .achievement-card:nth-child(4) { animation-delay: 0.4s; }
        .achievement-card:nth-child(5) { animation-delay: 0.5s; }
        .achievement-card:nth-child(6) { animation-delay: 0.6s; }
    </style>
@endsection

@section('content')
    {{-- Header Section --}}
    <div class="section-header">
        <div class="container">
            <h1>Lorem Ipsum Prestasi</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit</p>
        </div>
    </div>

    {{-- Filter Tabs --}}
    <div class="section-content">
        <div class="container">
            <div class="filter-tabs">
                <button class="filter-tab active">Semua</button>
                <button class="filter-tab">Akademik</button>
                <button class="filter-tab">Olahraga</button>
                <button class="filter-tab">Seni</button>
                <button class="filter-tab">Lainnya</button>
            </div>

            {{-- Achievements Grid --}}
            <div class="achievements-grid">
                @php
                    $dummyAchievements = [
                        [
                            'title' => 'Lorem Ipsum Dolor Sit',
                            'category' => 'Akademik',
                            'medal' => 'gold',
                            'student' => 'John Doe',
                            'date' => 'Januari 2024',
                            'location' => 'Lorem City',
                            'image' => 'https://placehold.co/600x400/4285f4/ffffff?text=Achievement+1',
                            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.'
                        ],
                        [
                            'title' => 'Consectetur Adipiscing',
                            'category' => 'Olahraga',
                            'medal' => 'silver',
                            'student' => 'Jane Smith',
                            'date' => 'Februari 2024',
                            'location' => 'Ipsum Town',
                            'image' => 'https://placehold.co/600x400/34a853/ffffff?text=Achievement+2',
                            'description' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.'
                        ],
                        [
                            'title' => 'Sed Do Eiusmod',
                            'category' => 'Seni',
                            'medal' => 'bronze',
                            'student' => 'Mike Johnson',
                            'date' => 'Maret 2024',
                            'location' => 'Dolor District',
                            'image' => 'https://placehold.co/600x400/fbbc04/ffffff?text=Achievement+3',
                            'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse.'
                        ],
                        [
                            'title' => 'Tempor Incididunt',
                            'category' => 'Akademik',
                            'medal' => 'gold',
                            'student' => 'Sarah Williams',
                            'date' => 'April 2024',
                            'location' => 'Sit Region',
                            'image' => 'https://placehold.co/600x400/ea4335/ffffff?text=Achievement+4',
                            'description' => 'Excepteur sint occaecat cupidatat non proident sunt in culpa.'
                        ],
                        [
                            'title' => 'Ut Labore Dolore',
                            'category' => 'Olahraga',
                            'medal' => 'gold',
                            'student' => 'David Brown',
                            'date' => 'Mei 2024',
                            'location' => 'Amet Province',
                            'image' => 'https://placehold.co/600x400/9c27b0/ffffff?text=Achievement+5',
                            'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem.'
                        ],
                        [
                            'title' => 'Magna Aliqua Enim',
                            'category' => 'Seni',
                            'medal' => 'silver',
                            'student' => 'Emily Davis',
                            'date' => 'Juni 2024',
                            'location' => 'Consectetur Area',
                            'image' => 'https://placehold.co/600x400/00bcd4/ffffff?text=Achievement+6',
                            'description' => 'Totam rem aperiam eaque ipsa quae ab illo inventore veritatis.'
                        ]
                    ];
                @endphp

                @foreach ($dummyAchievements as $achievement)
                    <div class="achievement-card">
                        <div class="achievement-card-image">
                            <img src="{{ $achievement['image'] }}" alt="{{ $achievement['title'] }}">
                            
                            {{-- Medal Badge --}}
                            <div class="medal-badge medal-{{ $achievement['medal'] }}">
                                @if($achievement['medal'] == 'gold')
                                    🥇
                                @elseif($achievement['medal'] == 'silver')
                                    🥈
                                @else
                                    🥉
                                @endif
                            </div>

                            {{-- Category Badge --}}
                            <span class="category-badge">{{ $achievement['category'] }}</span>
                        </div>
                        
                        <div class="achievement-card-body">
                            <h3 class="achievement-title">{{ $achievement['title'] }}</h3>
                            
                            <div class="achievement-meta">
                                <div class="meta-item">
                                    <i class="fas fa-user"></i>
                                    <span>{{ $achievement['student'] }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ $achievement['date'] }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $achievement['location'] }}</span>
                                </div>
                            </div>
                            
                            <p class="achievement-description">{{ $achievement['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Timeline Section --}}
    <div class="timeline-section">
        <div class="container">
            <h2>Lorem Timeline Prestasi</h2>
            
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-year">2024</div>
                    <div class="timeline-content">
                        <h3>Lorem Ipsum Dolor</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2023</div>
                    <div class="timeline-content">
                        <h3>Consectetur Adipiscing</h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2022</div>
                    <div class="timeline-content">
                        <h3>Sed Do Eiusmod Tempor</h3>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2021</div>
                    <div class="timeline-content">
                        <h3>Incididunt Ut Labore</h3>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection