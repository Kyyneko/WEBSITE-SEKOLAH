@extends('frontend.main')

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

        .section-content {
            padding: 4rem 0;
            background-color: #f8fafc;
        }

        /* Organizations Grid */
        .organizations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            padding: 0 1rem;
        }

        .organization-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #e2e8f0;
        }

        .organization-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .organization-card a {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .organization-card-image {
            width: 100%;
            height: 220px;
            overflow: hidden;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .organization-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .organization-card:hover .organization-card-image img {
            transform: scale(1.05);
        }

        .organization-card-image .no-photo {
            color: #a0aec0;
            font-size: 0.9rem;
        }

        .organization-card-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .organization-meta {
            font-size: 0.75rem;
            color: #718096;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .organization-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .organization-description {
            font-size: 0.95rem;
            color: #4a5568;
            line-height: 1.6;
            flex-grow: 1;
        }

        @media (max-width: 768px) {
            .section-header {
                padding: 3rem 0 2rem;
            }

            .section-content {
                padding: 3rem 0;
            }

            .organizations-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .organizations-grid {
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

        .organization-card {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
@endsection

@section('content')
    {{-- Header Section --}}
    <div class="section-header">
        <div class="container">
            <h1>Lorem Ipsum Organisasi</h1>
        </div>
    </div>

    {{-- Organizations Section --}}
    <div class="section-content">
        <div class="container">
            <div class="organizations-grid">
                @php
                    $dummyOrganizations = [
                        [
                            'name' => 'Lorem Ipsum',
                            'slug' => 'lorem-ipsum',
                            'date' => 'Senin, 15 Januari 2024',
                            'image' => 'https://placehold.co/400x300/4285f4/ffffff?text=Org+1',
                            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
                        ],
                        [
                            'name' => 'Dolor Sit Amet',
                            'slug' => 'dolor-sit-amet',
                            'date' => 'Selasa, 16 Januari 2024',
                            'image' => 'https://placehold.co/400x300/34a853/ffffff?text=Org+2',
                            'description' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
                        ],
                        [
                            'name' => 'Consectetur Adipiscing',
                            'slug' => 'consectetur-adipiscing',
                            'date' => 'Rabu, 17 Januari 2024',
                            'image' => 'https://placehold.co/400x300/fbbc04/ffffff?text=Org+3',
                            'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
                        ],
                        [
                            'name' => 'Sed Do Eiusmod',
                            'slug' => 'sed-do-eiusmod',
                            'date' => 'Kamis, 18 Januari 2024',
                            'image' => 'https://placehold.co/400x300/ea4335/ffffff?text=Org+4',
                            'description' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
                        ],
                        [
                            'name' => 'Tempor Incididunt',
                            'slug' => 'tempor-incididunt',
                            'date' => 'Jumat, 19 Januari 2024',
                            'image' => 'https://placehold.co/400x300/9c27b0/ffffff?text=Org+5',
                            'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.'
                        ],
                        [
                            'name' => 'Ut Labore',
                            'slug' => 'ut-labore',
                            'date' => 'Sabtu, 20 Januari 2024',
                            'image' => 'https://placehold.co/400x300/00bcd4/ffffff?text=Org+6',
                            'description' => 'Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt.'
                        ],
                        [
                            'name' => 'Dolore Magna',
                            'slug' => 'dolore-magna',
                            'date' => 'Minggu, 21 Januari 2024',
                            'image' => 'https://placehold.co/400x300/ff5722/ffffff?text=Org+7',
                            'description' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.'
                        ],
                        [
                            'name' => 'Aliqua Enim',
                            'slug' => 'aliqua-enim',
                            'date' => 'Senin, 22 Januari 2024',
                            'image' => 'https://placehold.co/400x300/795548/ffffff?text=Org+8',
                            'description' => 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.'
                        ],
                        [
                            'name' => 'Quis Nostrud',
                            'slug' => 'quis-nostrud',
                            'date' => 'Selasa, 23 Januari 2024',
                            'image' => 'https://placehold.co/400x300/607d8b/ffffff?text=Org+9',
                            'description' => 'Ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida risus commodo viverra.'
                        ]
                    ];
                @endphp

                @foreach ($dummyOrganizations as $org)
                    <div class="organization-card">
                        <a href="{{ url('/ekstrakurikuler/' . $org['slug']) }}">
                            <div class="organization-card-image">
                                <img src="{{ $org['image'] }}" alt="{{ $org['name'] }}">
                            </div>
                            <div class="organization-card-body">
                                <p class="organization-meta">
                                    {{ $org['name'] }}<br>
                                    {{ $org['date'] }}
                                </p>
                                <h3 class="organization-name">{{ $org['name'] }}</h3>
                                <p class="organization-description">{{ $org['description'] }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection