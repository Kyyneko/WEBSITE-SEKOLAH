@extends('frontend/main')

@section('style')
<style>
    /* ============================
       HERO / CAROUSEL UTAMA
    ============================ */
    .hero-wrapper {
        position: relative;
        margin-top: 0;
        overflow: hidden;
    }

    .hero-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 3;
        line-height: 0;
        pointer-events: none;
    }

    .hero-wave svg {
        width: 100%;
        height: 80px;
        display: block;
    }

    #carouselExampleFade {
        max-height: 620px;
        overflow: hidden;
        position: relative;
    }

    #carouselExampleFade .carousel-inner img {
        height: 620px;
        width: 100%;
        object-fit: cover;
        filter: brightness(0.9);
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
        max-width: 720px;
    }

    .float-text h1 {
        color: #ffffff;
        font-weight: 800;
        font-size: clamp(1.8rem, 4vw, 3rem);
        text-shadow: 0 2px 20px rgba(0, 0, 0, 0.4);
        margin-bottom: 0.75rem;
        letter-spacing: -0.02em;
        animation: heroFadeDown 1s ease 0.2s both;
    }

    .float-text h2 {
        color: #ffffff;
        font-weight: 500;
        font-size: clamp(1.1rem, 2.5vw, 1.6rem);
        text-shadow: 0 2px 12px rgba(0, 0, 0, 0.4);
        margin-bottom: 1rem;
        animation: heroFadeDown 1s ease 0.4s both;
    }

    .float-text p {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 400;
        font-size: clamp(0.85rem, 1.5vw, 1rem);
        text-shadow: 0 1px 8px rgba(0, 0, 0, 0.3);
        margin-bottom: 1.75rem;
        line-height: 1.7;
        animation: heroFadeDown 1s ease 0.6s both;
    }

    .float-text .btn-hero {
        padding: 0.75rem 2rem;
        font-size: 0.9rem;
        font-weight: 600;
        border-radius: var(--radius-sm);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
        background: var(--gradient-primary);
        color: #ffffff;
        text-decoration: none;
        border: none;
        display: inline-block;
        letter-spacing: 0.02em;
        animation: heroFadeDown 1s ease 0.8s both;
    }

    .float-text .btn-hero:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.5);
    }

    @keyframes heroFadeDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        #carouselExampleFade { max-height: 420px; }
        #carouselExampleFade .carousel-inner img { height: 420px; }
        .float-text { width: 92%; }
        .hero-wave svg { height: 50px; }
    }

    @media (max-width: 576px) {
        .float-text p { display: none; }
    }

    .overlay {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(180deg, rgba(30, 58, 95, 0.35) 0%, rgba(30, 58, 95, 0.65) 100%);
        z-index: 1;
    }

    /* ============================
       STATISTICS SECTION
    ============================ */
    .section-statistics {
        margin-top: -60px;
        position: relative;
        z-index: 10;
        padding-bottom: 1rem;
    }

    .statistic-item {
        background: var(--gradient-primary);
        border-radius: var(--radius-md);
        padding: 1.75rem 1.25rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .statistic-item::before {
        content: '';
        position: absolute;
        top: -30px;
        right: -30px;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }

    .statistic-item:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-xl);
    }

    .statistic-item .stat-icon {
        font-size: 1.5rem;
        margin-bottom: 0.75rem;
        opacity: 0.85;
    }

    .statistic-item h3 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
        letter-spacing: 0.02em;
    }

    .statistic-item h4 {
        font-size: 2rem;
        font-weight: 800;
    }

    /* ============================
       FEATURES SECTION
    ============================ */
    .section-features {
        padding: 5rem 0 2rem 0;
        background-color: var(--color-bg);
    }

    .feature-card {
        background: #ffffff;
        border: 1px solid var(--color-border);
        border-radius: var(--radius-lg);
        padding: 2rem 1.5rem;
        height: 100%;
        transition: all 0.3s ease;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--color-primary-light);
    }

    .feature-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: rgba(37, 99, 235, 0.1);
        color: var(--color-primary-light);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1.25rem;
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        background: var(--color-primary-light);
        color: #ffffff;
        transform: scale(1.1) rotate(5deg);
    }

    .feature-card h5 {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 0.75rem;
        color: var(--color-text);
    }

    .feature-card p {
        font-size: 0.85rem;
        color: var(--color-text-light);
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* ============================
       PRINCIPAL WELCOME
    ============================ */
    .principal-card {
        background: linear-gradient(145deg, #1e3a5f, #152c4b);
        border-radius: var(--radius-lg);
        padding: 2.5rem;
        color: white;
        position: relative;
        overflow: hidden;
        height: 100%;
        box-shadow: var(--shadow-xl);
    }

    .principal-card::before {
        content: '\f10d'; /* quote-left */
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        top: -10px;
        right: 10px;
        font-size: 8rem;
        color: rgba(255, 255, 255, 0.05);
        z-index: 0;
    }

    .principal-content {
        position: relative;
        z-index: 1;
    }

    /* ============================
       SECTION ABOUT & MAP
    ============================ */
    .section-about {
        padding: 3rem 0 5rem 0;
        background-color: var(--color-bg);
    }

    .map-container {
        border-radius: var(--radius-lg);
        overflow: hidden;
        border: 1px solid var(--color-border);
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        min-height: 250px;
        border: none;
    }

    /* ============================
       ARTICLE SECTION
    ============================ */
    .section-article {
        padding: 5rem 0;
        background: #ffffff;
    }

    .section-heading {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-heading h2 {
        font-weight: 800;
        font-size: clamp(1.75rem, 4vw, 2.5rem);
        color: var(--color-text);
        margin-bottom: 0.5rem;
        letter-spacing: -0.02em;
    }

    .section-heading p {
        color: var(--color-text-light);
        font-size: 1rem;
    }

    .article-carousel {
        background: var(--gradient-primary);
        border-radius: var(--radius-xl);
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    .article-carousel::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
    }

    .article-card {
        background: #ffffff;
        border-radius: var(--radius-md);
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        border: none;
    }

    .article-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .article-card img {
        height: 180px;
        object-fit: cover;
        width: 100%;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .article-card:hover .article-img-container img {
        transform: scale(1.08);
    }

    .article-card .card-body {
        padding: 1.25rem;
    }

    .article-img-container {
        position: relative;
        overflow: hidden;
        border-radius: var(--radius-md) var(--radius-md) 0 0;
    }

    /* Floating Glassmorphic Category Badges on Image */
    .badge-cat-floating {
        position: absolute;
        top: 12px;
        left: 12px;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 0.3rem 0.65rem;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        backdrop-filter: blur(4px);
        z-index: 10;
        transition: all 0.2s ease;
    }

    .badge-cat-org {
        background: rgba(37, 99, 235, 0.9) !important;
        color: #ffffff !important;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .badge-cat-umum {
        background: rgba(30, 41, 59, 0.8) !important;
        color: #ffffff !important;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    /* Floating Date Badge on Image Bottom Right */
    .badge-date-floating {
        position: absolute;
        bottom: 12px;
        right: 12px;
        font-size: 0.65rem;
        font-weight: 600;
        color: #ffffff;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        padding: 0.25rem 0.6rem;
        border-radius: 6px;
        z-index: 10;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.2s ease;
    }

    .article-card:hover .badge-date-floating {
        background: rgba(37, 99, 235, 0.85);
    }

    .article-reading-time {
        font-size: 0.72rem;
        font-weight: 600;
        color: #64748b;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .article-card .card-title {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--color-text);
        line-height: 1.4;
        transition: color 0.2s ease;
    }

    .article-card:hover .card-title {
        color: #2563eb;
    }

    /* Read More Link Styling with Hover Animation */
    .article-readmore {
        font-size: 0.7rem;
        font-weight: 700;
        color: #2563eb;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: flex;
        align-items: center;
        gap: 0.35rem;
        margin-top: auto;
        transition: color 0.2s ease;
    }

    .article-readmore i {
        transition: transform 0.2s ease;
    }

    .article-card:hover .article-readmore i {
        transform: translateX(4px);
    }

    /* ============================
       ADS / PENGUMUMAN SECTION
    ============================ */
    .section-ads {
        padding: 5rem 0;
        background-color: var(--color-bg);
    }

    .ads-card {
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid var(--color-border);
        background: #ffffff;
    }

    .ads-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg);
        border-color: transparent;
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
        font-size: 1.1rem;
        color: var(--color-text);
        margin-bottom: 0.75rem;
    }

    .ads-card .card-text {
        font-size: 0.9rem;
        color: var(--color-text-light);
        line-height: 1.7;
        flex-grow: 1;
    }

    .ads-card .btn-detail {
        background: var(--gradient-primary);
        border: none;
        padding: 0.5rem 1.5rem;
        font-weight: 600;
        border-radius: var(--radius-sm);
        color: #ffffff;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }

    .ads-card .btn-detail:hover {
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        transform: translateY(-2px);
    }

    /* ============================
       RESPONSIVE
    ============================ */
    @media (max-width: 768px) {
        .statistic-item { margin-bottom: 0.75rem; }

        .section-description,
        .section-article,
        .section-ads { padding: 3.5rem 0; }

        .article-carousel { padding: 1.25rem; }
    }
</style>
@endsection

@section('content')
    {{-- Hero Section with Wave --}}
    <div class="hero-wrapper">
        {{-- Title & Hero Text --}}
        <div class="float-text">
            <h1>{{ $settings->school_name }}</h1>
            <h2>{{ $settings->hero_subtitle }}</h2>
            <p>
                {{ $settings->hero_description }}
            </p>
            <a href="{{ url('/profil') }}" class="btn-hero">
                Kenali Lebih Dekat &raquo;
            </a>
        </div>

        {{-- Carousel Utama --}}
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <div class="carousel-item active position-relative">
                    <div class="overlay"></div>
                    <img src="{{ $settings->hero_photo_1 ? asset('storage/' . str_replace('public/', '', $settings->hero_photo_1)) : asset('image/DSCF4229.JPG') }}" class="d-block w-100" alt="Kegiatan Sekolah">
                </div>
                <div class="carousel-item position-relative">
                    <div class="overlay"></div>
                    <img src="{{ $settings->hero_photo_2 ? asset('storage/' . str_replace('public/', '', $settings->hero_photo_2)) : asset('image/DSCF4231.JPG') }}" class="d-block w-100" alt="Lingkungan Sekolah">
                </div>
                <div class="carousel-item position-relative">
                    <div class="overlay"></div>
                    <img src="{{ $settings->hero_photo_3 ? asset('storage/' . str_replace('public/', '', $settings->hero_photo_3)) : asset('image/DSCF4258.JPG') }}" class="d-block w-100" alt="Prestasi Siswa">
                </div>
            </div>
        </div>

        {{-- Wave Shape Bottom --}}
        <div class="hero-wave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none">
                <path fill="#f8fafc" d="M0,0 C240,100 480,20 720,60 C960,100 1200,20 1440,50 L1440,100 L0,100 Z"/>
            </svg>
        </div>
    </div>

    {{-- Statistics --}}
    <section class="section-statistics">
        <div class="container">
            <div class="row justify-content-center g-3">
                <div class="col-6 col-sm-4 col-md-3" data-aos="fade-up" data-aos-delay="0">
                    <div class="text-light statistic-item shadow">
                        <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                        <h3>Tenaga Pendidik</h3>
                        <h4 class="fw-bold">{{ \App\Models\User::where('role', 'teacher')->count() ?: 24 }}</h4>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-light statistic-item shadow">
                        <div class="stat-icon"><i class="fas fa-users-cog"></i></div>
                        <h3>Tenaga Kependidikan</h3>
                        <h4 class="fw-bold">{{ $settings->jumlah_staff ?? 12 }}</h4>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-light statistic-item shadow">
                        <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
                        <h3>Peserta Didik</h3>
                        <h4 class="fw-bold">{{ $settings->jumlah_siswa ?? 380 }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Fitur & Keunggulan --}}
    <section class="section-features">
        <div class="container">
            <div class="section-heading" data-aos="fade-up">
                <h2>Mengapa Memilih Kami?</h2>
                <p>Keunggulan dan program utama di SMPN 14 BULUKUMBA</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-medal"></i></div>
                        <h5>Terakreditasi B</h5>
                        <p>Sekolah dengan status akreditasi B (Baik), menjamin kualitas pendidikan dan standar mutu yang baik.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon" style="color: var(--color-accent); background: rgba(13, 148, 136, 0.1);"><i class="fas fa-book-reader"></i></div>
                        <h5>Kurikulum Merdeka</h5>
                        <p>Menerapkan Kurikulum Merdeka yang berpusat pada minat, bakat, dan pengembangan karakter peserta didik.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon" style="color: var(--color-warm); background: rgba(245, 158, 11, 0.1);"><i class="fas fa-laptop-code"></i></div>
                        <h5>Fasilitas Lengkap</h5>
                        <p>Didukung fasilitas modern seperti Lab Komputer, Perpustakaan, dan sarana yang menunjang eksplorasi siswa.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon" style="color: #8b5cf6; background: rgba(139, 92, 246, 0.1);"><i class="fas fa-users"></i></div>
                        <h5>Ekstrakurikuler Aktif</h5>
                        <p>Beragam wadah pengembangan diri melalui ekskul Pramuka, PMR, Olahraga, dan Seni yang aktif dan berprestasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Sambutan & Maps --}}
    <section class="section-about">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                {{-- Sambutan Kepala Sekolah --}}
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="principal-card">
                        <div class="principal-content">
                            <div class="d-flex align-items-center mb-3">
                                <div style="width: 70px; height: 70px; border-radius: 50%; background: rgba(255,255,255,0.2) url('{{ $settings->kepsek_photo_path ? asset('storage/' . str_replace('public/', '', $settings->kepsek_photo_path)) : 'https://ui-avatars.com/api/?name=' . urlencode($settings->kepsek_name) . '&background=random' }}') center/cover; border: 3px solid rgba(255,255,255,0.4); margin-right: 1rem;"></div>
                                <div>
                                    <h5 class="mb-1 fw-bold">{{ $settings->kepsek_name }}</h5>
                                    <p class="mb-0 text-white-50" style="font-size: 0.85rem;">Kepala {{ $settings->school_name }}</p>
                                </div>
                             </div>
                             <p style="font-size: 0.95rem; line-height: 1.7; font-style: italic; opacity: 0.9; margin-bottom: 0;">
                                 "{{ $settings->kepsek_welcome_text }}"
                             </p>
                        </div>
                    </div>
                </div>

                {{-- Tentang & Maps --}}
                <div class="col-lg-7" data-aos="fade-left">
                    <div class="bg-white p-4 p-md-4 border rounded-4 h-100 shadow-sm d-flex flex-column">
                        <h4 class="fw-bold mb-2" style="color: var(--color-primary);">{{ $settings->about_title }}</h4>
                        <p style="font-size: 0.95rem; line-height: 1.7; color: var(--color-text-light); text-align: justify;" class="mb-4">
                            {{ $settings->about_description }}
                        </p>
                        <div class="map-container flex-grow-1" style="min-height: 220px;">
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
        </div>
    </section>

    {{-- Carousel Article --}}
    <section class="section-article">
        <div class="container">
            <div class="section-heading" data-aos="fade-up">
                <h2>Artikel Terbaru</h2>
                <p>Berita dan informasi terkini seputar kegiatan sekolah</p>
            </div>

            @if($articles->count() > 0)
                @if($articles->count() <= 4)
                    {{-- Static grid for 1-4 articles --}}
                    <div class="article-carousel" data-aos="fade-up" data-aos-delay="100">
                        <div class="row g-3 justify-content-center">
                            @foreach ($articles->take(4) as $article)
                                <div class="col-md-6 col-lg-3">
                                    <a href="{{ route('article.show', $article->slug) }}" class="text-decoration-none">
                                        <div class="card article-card">
                                            <div class="article-img-container">
                                                @php $photos = $article->photo_path ? (is_array($article->photo_path) ? $article->photo_path : json_decode($article->photo_path, true)) : []; @endphp
                                                @if(count($photos) > 0)
                                                    <img src="{{ asset('storage/' . str_replace('public/', '', $photos[0])) }}" class="card-img-top" alt="{{ $article->title }}">
                                                @else
                                                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height:180px;background:linear-gradient(135deg,#1e3a5f,#2563eb);">
                                                        <i class="fas fa-newspaper" style="font-size:2.5rem;color:rgba(255,255,255,0.3);"></i>
                                                    </div>
                                                @endif
                                                
                                                {{-- Floating Category Badge --}}
                                                @if($article->organisasi)
                                                    <span class="badge-cat-floating badge-cat-org">
                                                        <i class="fas fa-users"></i> {{ $article->organisasi->nama }}
                                                    </span>
                                                @else
                                                    <span class="badge-cat-floating badge-cat-umum">
                                                        <i class="fas fa-globe"></i> Umum
                                                    </span>
                                                @endif

                                                {{-- Floating Date Badge --}}
                                                <span class="badge-date-floating">
                                                    <i class="far fa-calendar-alt"></i> {{ $article->created_at->translatedFormat('d M Y') }}
                                                </span>
                                            </div>
                                            <div class="card-body d-flex flex-column" style="min-height: 135px; padding: 1.25rem;">
                                                <div class="article-reading-time mb-2">
                                                    <i class="far fa-clock"></i> {{ max(1, ceil(str_word_count(strip_tags($article->description)) / 200)) }} Menit Baca
                                                </div>
                                                <h5 class="card-title mb-3">{{ Str::limit($article->title, 55) }}</h5>
                                                <div class="article-readmore" style="margin-top: auto;">
                                                    Selengkapnya <i class="fas fa-arrow-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    {{-- Carousel for 5+ articles --}}
                    @php $chunks = $articles->chunk(4); @endphp
                    <div id="carouselExample" class="carousel slide article-carousel" data-bs-ride="carousel" data-aos="fade-up" data-aos-delay="100">
                        <div class="carousel-inner">
                            @foreach ($chunks as $index => $chunk)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="row g-3">
                                        @foreach ($chunk as $article)
                                            <div class="col-md-6 col-lg-3">
                                                <a href="{{ route('article.show', $article->slug) }}" class="text-decoration-none">
                                                    <div class="card article-card">
                                                        <div class="article-img-container">
                                                            @php $photos = $article->photo_path ? (is_array($article->photo_path) ? $article->photo_path : json_decode($article->photo_path, true)) : []; @endphp
                                                            @if(count($photos) > 0)
                                                                <img src="{{ asset('storage/' . str_replace('public/', '', $photos[0])) }}" class="card-img-top" alt="{{ $article->title }}">
                                                            @else
                                                                <div class="card-img-top d-flex align-items-center justify-content-center" style="height:180px;background:linear-gradient(135deg,#1e3a5f,#2563eb);">
                                                                    <i class="fas fa-newspaper" style="font-size:2.5rem;color:rgba(255,255,255,0.3);"></i>
                                                                </div>
                                                            @endif
                                                            
                                                            {{-- Floating Category Badge --}}
                                                            @if($article->organisasi)
                                                                <span class="badge-cat-floating badge-cat-org">
                                                                    <i class="fas fa-users"></i> {{ $article->organisasi->nama }}
                                                                </span>
                                                            @else
                                                                <span class="badge-cat-floating badge-cat-umum">
                                                                    <i class="fas fa-globe"></i> Umum
                                                                </span>
                                                            @endif

                                                            {{-- Floating Date Badge --}}
                                                            <span class="badge-date-floating">
                                                                <i class="far fa-calendar-alt"></i> {{ $article->created_at->translatedFormat('d M Y') }}
                                                            </span>
                                                        </div>
                                                        <div class="card-body d-flex flex-column" style="min-height: 135px; padding: 1.25rem;">
                                                            <div class="article-reading-time mb-2">
                                                                <i class="far fa-clock"></i> {{ max(1, ceil(str_word_count(strip_tags($article->description)) / 200)) }} Menit Baca
                                                            </div>
                                                            <h5 class="card-title mb-3">{{ Str::limit($article->title, 55) }}</h5>
                                                            <div class="article-readmore" style="margin-top: auto;">
                                                                Selengkapnya <i class="fas fa-arrow-right"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                @endif
            @else
                {{-- Empty state --}}
                <div class="article-carousel text-center py-5" data-aos="fade-up">
                    <div style="width:80px;height:80px;border-radius:50%;background:rgba(255,255,255,0.08);display:inline-flex;align-items:center;justify-content:center;margin-bottom:1.25rem;">
                        <i class="fas fa-newspaper" style="font-size:2rem;color:rgba(255,255,255,0.4);"></i>
                    </div>
                    <h5 class="text-white fw-bold mb-2">Belum Ada Artikel</h5>
                    <p style="color:rgba(255,255,255,0.5);font-size:0.9rem;max-width:400px;margin:0 auto;">
                        Artikel dan berita sekolah akan ditampilkan di sini. Nantikan informasi terbaru dari kami!
                    </p>
                </div>
            @endif
        </div>
    </section>

    {{-- Pengumuman / Iklan --}}
    <section class="section-ads">
        <div class="container">
            <div class="section-heading" data-aos="fade-up">
                <h2>Pengumuman & Informasi</h2>
                <p>Informasi penting untuk warga sekolah dan masyarakat</p>
            </div>

            @if($ads->count() > 0)
                <div class="row g-4 justify-content-center">
                    @foreach ($ads as $index => $ad)
                        <div class="col-md-6 col-lg-{{ $ads->count() == 1 ? '6' : ($ads->count() == 2 ? '5' : '4') }}" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <a href="{{ $ad->link ?? '#' }}" target="_blank" class="text-decoration-none">
                                <div class="card ads-card">
                                    @if($ad->photo_path)
                                        <img src="{{ asset('storage/' . str_replace('public/', '', $ad->photo_path)) }}" class="card-img-top" alt="{{ $ad->title }}">
                                    @else
                                        <div class="card-img-top d-flex align-items-center justify-content-center" style="height:200px;background:linear-gradient(135deg,#1e3a5f,#0d9488);">
                                            <i class="fas fa-bullhorn" style="font-size:3rem;color:rgba(255,255,255,0.25);"></i>
                                        </div>
                                    @endif
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $ad->title }}</h5>
                                        <p class="card-text">{{ Str::limit($ad->description, 120) }}</p>
                                        <span class="btn btn-detail mt-auto">Selengkapnya</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Empty state --}}
                <div class="text-center py-5" data-aos="fade-up">
                    <div style="width:80px;height:80px;border-radius:50%;background:rgba(30,58,95,0.06);display:inline-flex;align-items:center;justify-content:center;margin-bottom:1.25rem;">
                        <i class="fas fa-bullhorn" style="font-size:2rem;color:#94a3b8;"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color:#1e293b;">Belum Ada Pengumuman</h5>
                    <p style="color:#94a3b8;font-size:0.9rem;max-width:400px;margin:0 auto;">
                        Pengumuman dan informasi penting akan ditampilkan di sini. Pantau terus halaman ini!
                    </p>
                </div>
            @endif
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new bootstrap.Carousel(document.getElementById('carouselExampleFade'), {
                interval: 4000,
                wrap: true,
            });
        });
    </script>
@endsection
