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

        /* Articles Grid */
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            padding: 0 1rem;
        }

        .article-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #e2e8f0;
        }

        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
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
            height: 220px;
            overflow: hidden;
            background: #e2e8f0;
        }

        .article-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .article-card:hover .article-card-image img {
            transform: scale(1.05);
        }

        .article-card-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .article-meta {
            font-size: 0.75rem;
            color: #718096;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .article-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .article-excerpt {
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

            .articles-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .articles-grid {
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

        .article-card {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
@endsection

@section('content')
    {{-- Header Section --}}
    <div class="section-header">
        <div class="container">
            <h1>Lorem Ipsum Articles</h1>
        </div>
    </div>

    {{-- Articles Section --}}
    <div class="section-content">
        <div class="container">
            <div class="articles-grid">
                @php
                    $dummyArticles = [
                        [
                            'title' => 'Lorem Ipsum Dolor Sit Amet Consectetur',
                            'author' => 'John Doe',
                            'date' => 'Senin, 15 Januari 2024',
                            'slug' => 'lorem-ipsum-dolor-sit',
                            'image' => 'https://placehold.co/400x300/4285f4/ffffff?text=Article+1',
                            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.'
                        ],
                        [
                            'title' => 'Consectetur Adipiscing Elit Sed Do',
                            'author' => 'Jane Smith',
                            'date' => 'Selasa, 16 Januari 2024',
                            'slug' => 'consectetur-adipiscing-elit',
                            'image' => 'https://placehold.co/400x300/34a853/ffffff?text=Article+2',
                            'excerpt' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.'
                        ],
                        [
                            'title' => 'Sed Do Eiusmod Tempor Incididunt',
                            'author' => 'Mike Johnson',
                            'date' => 'Rabu, 17 Januari 2024',
                            'slug' => 'sed-do-eiusmod-tempor',
                            'image' => 'https://placehold.co/400x300/fbbc04/ffffff?text=Article+3',
                            'excerpt' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat.'
                        ],
                        [
                            'title' => 'Incididunt Ut Labore Et Dolore Magna',
                            'author' => 'Sarah Williams',
                            'date' => 'Kamis, 18 Januari 2024',
                            'slug' => 'incididunt-ut-labore',
                            'image' => 'https://placehold.co/400x300/ea4335/ffffff?text=Article+4',
                            'excerpt' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis.'
                        ],
                        [
                            'title' => 'Dolore Magna Aliqua Enim Ad Minim',
                            'author' => 'David Brown',
                            'date' => 'Jumat, 19 Januari 2024',
                            'slug' => 'dolore-magna-aliqua',
                            'image' => 'https://placehold.co/400x300/9c27b0/ffffff?text=Article+5',
                            'excerpt' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo.'
                        ],
                        [
                            'title' => 'Quis Nostrud Exercitation Ullamco',
                            'author' => 'Emily Davis',
                            'date' => 'Sabtu, 20 Januari 2024',
                            'slug' => 'quis-nostrud-exercitation',
                            'image' => 'https://placehold.co/400x300/00bcd4/ffffff?text=Article+6',
                            'excerpt' => 'Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem.'
                        ],
                        [
                            'title' => 'Ullamco Laboris Nisi Ut Aliquip',
                            'author' => 'Robert Miller',
                            'date' => 'Minggu, 21 Januari 2024',
                            'slug' => 'ullamco-laboris-nisi',
                            'image' => 'https://placehold.co/400x300/ff5722/ffffff?text=Article+7',
                            'excerpt' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi.'
                        ],
                        [
                            'title' => 'Aliquip Ex Ea Commodo Consequat',
                            'author' => 'Lisa Anderson',
                            'date' => 'Senin, 22 Januari 2024',
                            'slug' => 'aliquip-ex-ea-commodo',
                            'image' => 'https://placehold.co/400x300/795548/ffffff?text=Article+8',
                            'excerpt' => 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt.'
                        ],
                        [
                            'title' => 'Duis Aute Irure Dolor Reprehenderit',
                            'author' => 'Thomas Wilson',
                            'date' => 'Selasa, 23 Januari 2024',
                            'slug' => 'duis-aute-irure-dolor',
                            'image' => 'https://placehold.co/400x300/607d8b/ffffff?text=Article+9',
                            'excerpt' => 'Ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.'
                        ]
                    ];
                @endphp

                @foreach ($dummyArticles as $article)
                    <div class="article-card">
                        <a href="{{ url('/article/' . $article['slug']) }}">
                            <div class="article-card-image">
                                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}">
                            </div>
                            <div class="article-card-body">
                                <p class="article-meta">
                                    {{ $article['author'] }}<br>
                                    {{ $article['date'] }}
                                </p>
                                <h3 class="article-title">{{ $article['title'] }}</h3>
                                <p class="article-excerpt">{{ $article['excerpt'] }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
