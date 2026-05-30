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
            position: relative;
        }

        .article-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .article-card:hover .article-card-image img {
            transform: scale(1.08);
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

        .article-title {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--color-text);
            line-height: 1.4;
            transition: color 0.2s ease;
        }

        .article-card:hover .article-title {
            color: #2563eb;
        }

        .read-more {
            font-size: 0.75rem;
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

        .read-more i {
            transition: transform 0.2s ease;
        }

        .article-card:hover .read-more i {
            transform: translateX(4px);
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
                @forelse ($articles as $index => $article)
                    <div class="article-card" data-aos="fade-up" data-aos-delay="{{ min($index * 60, 360) }}">
                        <a href="{{ route('article.show', $article->slug) }}">
                            <div class="article-card-image position-relative overflow-hidden">
                                @php $photos = $article->photo_path ? (is_array($article->photo_path) ? $article->photo_path : json_decode($article->photo_path, true)) : []; @endphp
                                @if(count($photos) > 0)
                                    <img src="{{ asset('storage/' . str_replace('public/', '', $photos[0])) }}" alt="{{ $article->title }}">
                                @else
                                    <div class="d-flex align-items-center justify-content-center w-100 h-100" style="min-height: 210px; background: linear-gradient(135deg,#1e3a5f,#2563eb);">
                                        <i class="fas fa-newspaper text-white-50" style="font-size: 2.5rem;"></i>
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
                            
                            <div class="article-card-body d-flex flex-column" style="padding: 1.25rem; min-height: 135px; flex-grow: 1;">
                                <div class="article-reading-time mb-2">
                                    <i class="far fa-clock"></i> {{ max(1, ceil(str_word_count(strip_tags($article->description)) / 200)) }} Menit Baca
                                </div>
                                <h3 class="article-title mb-3" style="font-size: 0.88rem; font-weight: 700; color: var(--color-text); line-height: 1.4; transition: color 0.2s ease; margin: 0;">
                                    {{ Str::limit($article->title, 55) }}
                                </h3>
                                <span class="read-more">
                                    Selengkapnya <i class="fas fa-arrow-right"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-5 w-100" style="grid-column: 1 / -1;">
                        <div style="width:80px;height:80px;border-radius:50%;background:rgba(0,0,0,0.04);display:inline-flex;align-items:center;justify-content:center;margin-bottom:1.25rem;color:#94a3b8;">
                            <i class="fas fa-newspaper" style="font-size:2rem;"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">Belum Ada Artikel</h4>
                        <p class="text-muted mx-auto" style="font-size: 0.95rem; max-width: 400px;">
                            Artikel dan berita sekolah belum diterbitkan. Nantikan informasi terbaru dari kami!
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
