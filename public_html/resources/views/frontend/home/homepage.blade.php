@extends('frontend/main')

@section('style')
<style>
    /* Import font utama (Poppins) */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

    :root {
        --font-main: 'Poppins', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    body {
        font-family: var(--font-main);
    }

    /* ============================
       HERO / CAROUSEL UTAMA
    ============================ */
    #carouselExampleFade {
        max-height: 600px;
        overflow: hidden;
        position: relative;
        margin-top: 70px;
    }

    #carouselExampleFade .carousel-inner img {
        height: 600px;
        width: 100%;
        object-fit: cover;
    }

    .float-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: #fff;
        z-index: 2;
        width: 85%;
        max-width: 700px;
    }

    .float-text h1 {
        font-family: var(--font-main);
        color: #ffffff;
        font-weight: 800;
        font-size: clamp(1.8rem, 4vw, 3rem);
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        margin-bottom: 1rem;
    }

    .float-text h2 {
        font-family: var(--font-main);
        color: #ffffff;
        font-weight: 600;
        font-size: clamp(1.3rem, 3vw, 2.2rem);
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7);
        margin-bottom: 1rem;
    }

    .float-text p {
        font-family: var(--font-main);
        color: #ffffff;
        font-weight: 400;
        font-size: clamp(0.9rem, 2vw, 1.1rem);
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
        margin-bottom: 1.5rem;
    }

    .float-text .btn {
        padding: 0.75rem 2rem;
        font-size: 0.95rem;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        font-family: var(--font-main);
    }

    .float-text .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.4);
    }

    @media (max-width: 768px) {
        #carouselExampleFade {
            max-height: 400px;
        }

        #carouselExampleFade .carousel-inner img {
            height: 400px;
        }

        .float-text {
            width: 90%;
        }
    }

    @media (max-width: 576px) {
        .float-text p {
            display: none;
        }
    }

    .overlay {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    /* ============================
       SECTION / LAYOUT
    ============================ */
    .section-statistics {
        margin-top: -40px;
        position: relative;
        z-index: 999;
    }

    .statistic-item {
        background: linear-gradient(135deg, rgb(19, 123, 191) 0%, rgb(16, 100, 160) 100%);
        border-radius: 12px;
        padding: 2rem 1rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        font-family: var(--font-main);
    }

    .statistic-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .statistic-item h3 {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .statistic-item h4 {
        font-size: 1.9rem;
        font-weight: 400;
    }

    .section-description {
        padding: 5rem 0;
        background-color: #f8fafc;
        font-family: var(--font-main);
    }

    .section-description h1 {
        font-weight: 700;
        font-size: clamp(2rem, 5vw, 3.5rem);
        margin-bottom: 2rem;
        color: #1a202c;
        text-align: center;
    }

    .section-description p {
        font-size: 1rem;
        line-height: 1.8;
        color: #4a5568;
        text-align: justify;
        margin-bottom: 3rem;
    }

    .map-container {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .map-container iframe {
        width: 100%;
        height: 450px;
        border: none;
    }

    /* ============================
       ARTICLE SECTION
    ============================ */
    .section-article {
        padding: 5rem 0;
        font-family: var(--font-main);
    }

    .section-article h1 {
        font-weight: 700;
        font-size: clamp(2rem, 4vw, 3rem);
        margin-bottom: 3rem;
        color: #1a202c;
        text-align: center;
    }

    .article-carousel {
        background: linear-gradient(135deg, rgb(19, 123, 191) 0%, rgb(16, 100, 160) 100%);
        border-radius: 16px;
        padding: 2rem;
    }

    .article-card {
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        border: none;
        font-family: var(--font-main);
    }

    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .article-card img {
        height: 200px;
        object-fit: cover;
    }

    .article-card .card-body {
        padding: 1.25rem;
    }

    .article-meta {
        font-size: 0.75rem;
        color: #718096;
        font-weight: 600;
    }

    .article-card .card-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1a202c;
    }

    .article-card .card-text {
        font-size: 0.95rem;
        color: #2d3748;
        line-height: 1.6;
    }

    /* ============================
       ADS SECTION
    ============================ */
    .section-ads {
        padding: 5rem 0;
        background-color: #f8fafc;
        font-family: var(--font-main);
    }

    .section-ads h2 {
        font-weight: 700;
        font-size: 2.3rem;
        margin-bottom: 3rem;
        color: #1a202c;
        text-align: center;
    }

    .ads-card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        border: 1px solid #e2e8f0;
        font-family: var(--font-main);
    }

    .ads-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .ads-card img {
        height: 200px;
        object-fit: cover;
    }

    .ads-card .card-body {
        padding: 1.5rem;
    }

    .ads-card .card-title {
        font-weight: 700;
        font-size: 1.15rem;
        color: #1a202c;
        margin-bottom: 0.75rem;
    }

    .ads-card .card-text {
        font-size: 0.95rem;
        color: #4a5568;
        line-height: 1.6;
        flex-grow: 1;
    }

    .ads-card .btn {
        background: linear-gradient(135deg, rgb(19, 123, 191) 0%, rgb(16, 100, 160) 100%);
        border: none;
        padding: 0.5rem 1.5rem;
        font-weight: 600;
        border-radius: 8px;
        font-family: var(--font-main);
    }

    .ads-card .btn:hover {
        opacity: 0.9;
    }

    /* ============================
       RESPONSIVE
    ============================ */
    @media (max-width: 768px) {
        .statistic-item {
            margin-bottom: 1rem;
        }

        .section-description,
        .section-article,
        .section-ads {
            padding: 3rem 0;
        }

        .article-carousel {
            padding: 1rem;
        }
    }
</style>
@endsection

@section('content')
    {{-- Title & Hero Text --}}
    <div class="float-text">
        <h1>Lorem Ipsum Dolor Sit</h1>
        <h2>Consectetur Adipiscing Elit Sed Do</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </p>
        <a href="{{ url('/profil') }}" class="btn" style="background-color: rgb(19, 123, 191); color: #ffffff; text-decoration: none;">
            Selengkapnya &raquo;
        </a>
    </div>

    {{-- Carousel Utama --}}
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            <div class="carousel-item active position-relative">
                <div class="overlay"></div>
                <img src="https://placehold.co/1200x600/1a73e8/ffffff?text=Slide+1" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item position-relative">
                <div class="overlay"></div>
                <img src="https://placehold.co/1200x600/34a853/ffffff?text=Slide+2" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item position-relative">
                <div class="overlay"></div>
                <img src="https://placehold.co/1200x600/ea4335/ffffff?text=Slide+3" class="d-block w-100" alt="Slide 3">
            </div>
        </div>
    </div>

    {{-- Statistic --}}
    <section class="section-statistics">
        <div class="container">
            <div class="row justify-content-center g-3">
                <div class="col-12 col-sm-4 col-md-3">
                    <div class="text-center text-light statistic-item shadow">
                        <h3>Lorem</h3>
                        <h4 class="fw-light">24</h4>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-md-3">
                    <div class="text-center text-light statistic-item shadow">
                        <h3>Ipsum</h3>
                        <h4 class="fw-light">12</h4>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-md-3">
                    <div class="text-center text-light statistic-item shadow">
                        <h3>Dolor</h3>
                        <h4 class="fw-light">380</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Deskripsi Sekolah + Maps --}}
    <section class="section-description">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1>Lorem Ipsum Dolor Sit Amet</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore 
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in 
                        culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus 
                        error sit voluptatem accusantium doloremque laudantium.
                    </p>
                </div>
            </div>
            
            <div class="row justify-content-center mt-5">
                <div class="col-lg-10">
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.557638887232!2d120.13798547365488!3d-5.331467094647059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbea74944576b8f%3A0x674d040df0157620!2sSMP%20Negeri%2014%20Bulukumba!5e0!3m2!1sid!2sid!4v1706774689060!5m2!1sid!2sid"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Carousel Article --}}
    <section class="section-article">
        <div class="container">
            <h1>ARTICLE</h1>
            
            <div id="carouselExample" class="carousel slide article-carousel" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @php
                        $dummyArticles = [
                            [
                                'title' => 'Lorem Ipsum Dolor Sit Amet',
                                'author' => 'John Doe',
                                'date' => 'Senin, 15 Januari 2024',
                                'image' => 'https://placehold.co/400x300/4285f4/ffffff?text=Article+1',
                                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
                            ],
                            [
                                'title' => 'Consectetur Adipiscing Elit',
                                'author' => 'Jane Smith',
                                'date' => 'Selasa, 16 Januari 2024',
                                'image' => 'https://placehold.co/400x300/34a853/ffffff?text=Article+2',
                                'description' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
                            ],
                            [
                                'title' => 'Sed Do Eiusmod Tempor',
                                'author' => 'Mike Johnson',
                                'date' => 'Rabu, 17 Januari 2024',
                                'image' => 'https://placehold.co/400x300/fbbc04/ffffff?text=Article+3',
                                'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
                            ],
                            [
                                'title' => 'Incididunt Ut Labore',
                                'author' => 'Sarah Williams',
                                'date' => 'Kamis, 18 Januari 2024',
                                'image' => 'https://placehold.co/400x300/ea4335/ffffff?text=Article+4',
                                'description' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
                            ],
                            [
                                'title' => 'Dolore Magna Aliqua',
                                'author' => 'David Brown',
                                'date' => 'Jumat, 19 Januari 2024',
                                'image' => 'https://placehold.co/400x300/9c27b0/ffffff?text=Article+5',
                                'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.'
                            ],
                            [
                                'title' => 'Quis Nostrud Exercitation',
                                'author' => 'Emily Davis',
                                'date' => 'Sabtu, 20 Januari 2024',
                                'image' => 'https://placehold.co/400x300/00bcd4/ffffff?text=Article+6',
                                'description' => 'Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'
                            ],
                            [
                                'title' => 'Ullamco Laboris Nisi',
                                'author' => 'Robert Miller',
                                'date' => 'Minggu, 21 Januari 2024',
                                'image' => 'https://placehold.co/400x300/ff5722/ffffff?text=Article+7',
                                'description' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.'
                            ],
                            [
                                'title' => 'Aliquip Ex Ea Commodo',
                                'author' => 'Lisa Anderson',
                                'date' => 'Senin, 22 Januari 2024',
                                'image' => 'https://placehold.co/400x300/795548/ffffff?text=Article+8',
                                'description' => 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.'
                            ]
                        ];
                        
                        $chunks = array_chunk($dummyArticles, 4);
                    @endphp

                    @foreach ($chunks as $index => $chunk)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row g-3">
                                @foreach ($chunk as $article)
                                    <div class="col-md-6 col-lg-3">
                                        <div class="card article-card">
                                            <img src="{{ $article['image'] }}" class="card-img-top" alt="{{ $article['title'] }}">
                                            <div class="card-body">
                                                <p class="article-meta mb-2">
                                                    {{ $article['author'] }}<br>
                                                    {{ $article['date'] }}
                                                </p>
                                                <hr class="my-2">
                                                <h5 class="card-title">{{ $article['title'] }}</h5>
                                                <p class="card-text">{{ $article['description'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    {{-- Ads --}}
    <section class="section-ads">
        <div class="container">
            <h2>Lorem Ipsum</h2>
            
            <div class="row g-4 justify-content-center">
                @php
                    $dummyAds = [
                        [
                            'title' => 'Lorem Ipsum',
                            'image' => 'https://placehold.co/400x300/4285f4/ffffff?text=Ad+1',
                            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.',
                            'link' => '#'
                        ],
                        [
                            'title' => 'Dolor Sit Amet',
                            'image' => 'https://placehold.co/400x300/34a853/ffffff?text=Ad+2',
                            'description' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.',
                            'link' => '#'
                        ],
                        [
                            'title' => 'Consectetur',
                            'image' => 'https://placehold.co/400x300/fbbc04/ffffff?text=Ad+3',
                            'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.',
                            'link' => '#'
                        ]
                    ];
                @endphp

                @foreach ($dummyAds as $ad)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ $ad['link'] }}" target="_blank" class="text-decoration-none">
                            <div class="card ads-card">
                                <img src="{{ $ad['image'] }}" class="card-img-top" alt="{{ $ad['title'] }}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $ad['title'] }}</h5>
                                    <p class="card-text">{{ $ad['description'] }}</p>
                                    <span class="btn btn-primary mt-auto">Lorem Ipsum</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new bootstrap.Carousel(document.getElementById('carouselExampleFade'), {
                interval: 3000,
                wrap: true,
            });
        });
    </script>
@endsection
