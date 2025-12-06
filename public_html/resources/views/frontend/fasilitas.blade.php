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

        /* Facilities Grid */
        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2.5rem;
            padding: 0 1rem;
        }

        .facility-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .facility-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .facility-card-image {
            width: 100%;
            height: 280px;
            overflow: hidden;
            background: #e2e8f0;
            position: relative;
        }

        .facility-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .facility-card:hover .facility-card-image img {
            transform: scale(1.05);
        }

        .facility-badge {
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

        .facility-card-body {
            padding: 2rem;
        }

        .facility-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.75rem;
            line-height: 1.3;
        }

        .facility-description {
            font-size: 1rem;
            color: #4a5568;
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .facility-features {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .feature-tag {
            display: inline-flex;
            align-items: center;
            padding: 0.4rem 0.9rem;
            background: #e0f2fe;
            color: #0369a1;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .feature-tag i {
            margin-right: 0.4rem;
            font-size: 0.75rem;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, rgb(19, 123, 191) 0%, rgb(16, 100, 160) 100%);
            padding: 3rem 0;
            margin-top: 3rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .stat-item {
            text-align: center;
            color: #ffffff;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            font-weight: 500;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .section-header {
                padding: 3rem 0 2rem;
            }

            .section-content {
                padding: 3rem 0;
            }

            .facilities-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 2rem;
            }

            .facility-card-image {
                height: 240px;
            }

            .facility-card-body {
                padding: 1.5rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 576px) {
            .facilities-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
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

        .facility-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .facility-card:nth-child(1) { animation-delay: 0.1s; }
        .facility-card:nth-child(2) { animation-delay: 0.2s; }
        .facility-card:nth-child(3) { animation-delay: 0.3s; }
        .facility-card:nth-child(4) { animation-delay: 0.4s; }
        .facility-card:nth-child(5) { animation-delay: 0.5s; }
        .facility-card:nth-child(6) { animation-delay: 0.6s; }
    </style>
@endsection

@section('content')
    {{-- Header Section --}}
    <div class="section-header">
        <div class="container">
            <h1>Lorem Ipsum Fasilitas</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
        </div>
    </div>

    {{-- Facilities Section --}}
    <div class="section-content">
        <div class="container">
            <div class="facilities-grid">
                @php
                    $dummyFacilities = [
                        [
                            'name' => 'Lorem Ipsum Dolor',
                            'category' => 'Category A',
                            'image' => 'https://placehold.co/600x400/4285f4/ffffff?text=Facility+1',
                            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            'features' => ['Feature 1', 'Feature 2', 'Feature 3']
                        ],
                        [
                            'name' => 'Consectetur Adipiscing',
                            'category' => 'Category B',
                            'image' => 'https://placehold.co/600x400/34a853/ffffff?text=Facility+2',
                            'description' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                            'features' => ['Feature 1', 'Feature 2']
                        ],
                        [
                            'name' => 'Sed Do Eiusmod',
                            'category' => 'Category C',
                            'image' => 'https://placehold.co/600x400/fbbc04/ffffff?text=Facility+3',
                            'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                            'features' => ['Feature 1', 'Feature 2', 'Feature 3', 'Feature 4']
                        ],
                        [
                            'name' => 'Tempor Incididunt',
                            'category' => 'Category A',
                            'image' => 'https://placehold.co/600x400/ea4335/ffffff?text=Facility+4',
                            'description' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                            'features' => ['Feature 1', 'Feature 2']
                        ],
                        [
                            'name' => 'Ut Labore Dolore',
                            'category' => 'Category B',
                            'image' => 'https://placehold.co/600x400/9c27b0/ffffff?text=Facility+5',
                            'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.',
                            'features' => ['Feature 1', 'Feature 2', 'Feature 3']
                        ],
                        [
                            'name' => 'Magna Aliqua',
                            'category' => 'Category C',
                            'image' => 'https://placehold.co/600x400/00bcd4/ffffff?text=Facility+6',
                            'description' => 'Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt.',
                            'features' => ['Feature 1', 'Feature 2']
                        ]
                    ];
                @endphp

                @foreach ($dummyFacilities as $facility)
                    <div class="facility-card">
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

    {{-- Stats Section --}}
    <div class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">24</div>
                    <div class="stat-label">Lorem Ipsum</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">12</div>
                    <div class="stat-label">Dolor Sit</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">380</div>
                    <div class="stat-label">Consectetur</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">6</div>
                    <div class="stat-label">Adipiscing</div>
                </div>
            </div>
        </div>
    </div>
@endsection