@extends('frontend.main')

@section('style')
<style>
    /* ============================
       ARTICLE DETAIL LAYOUT
    ============================ */
    .article-container {
        max-width: 800px;
        margin: 70px auto 40px;
        padding: 20px;
    }

    .article-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .article-info {
        font-size: 14px;
        color: #666;
        margin-bottom: 20px;
    }

    .article-description {
        font-size: 16px;
        line-height: 1.6;
    }

    .article-image {
        max-width: 100%;
        height: auto;
        margin-bottom: 20px;
        border-radius: 6px;
    }

    /* ============================
       NAVBAR HOVER UNDERLINE
    ============================ */
    .navbar-nav .nav-item .nav-link {
        position: relative;
        transition: color 0.3s ease-in-out;
    }

    .navbar-nav .nav-item .nav-link::before {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: #000000;
        transition: width 0.3s ease-in-out;
    }

    .navbar-nav .nav-item .nav-link:hover::before {
        width: 100%;
    }

    .navbar-nav .nav-item .nav-link:hover {
        color: #000000;
    }

    @media (max-width: 654px) {
        .article-title {
            font-size: 20px;
        }
    }

    /* ============================
       LOADING OVERLAY (GLOBAL)
    ============================ */
    .loading {
        --speed-of-animation: 0.9s;
        --gap: 6px;
        --first-color: #4c86f9;
        --second-color: #49a84c;
        --third-color: #f6bb02;
        --fourth-color: #f6bb02;
        --fifth-color: #2196f3;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
        background: rgba(255, 255, 255, 0.8);
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999;
    }

    .loading span {
        width: 4px;
        height: 50px;
        background: var(--first-color);
        animation: scale var(--speed-of-animation) ease-in-out infinite;
    }

    .loading span:nth-child(2) {
        background: var(--second-color);
        animation-delay: -0.8s;
    }

    .loading span:nth-child(3) {
        background: var(--third-color);
        animation-delay: -0.7s;
    }

    .loading span:nth-child(4) {
        background: var(--fourth-color);
        animation-delay: -0.6s;
    }

    .loading span:nth-child(5) {
        background: var(--fifth-color);
        animation-delay: -0.5s;
    }

    @keyframes scale {
        0%,
        40%,
        100% {
            transform: scaleY(0.05);
        }

        20% {
            transform: scaleY(1);
        }
    }
</style>
@endsection

@section('content')
    @php
        $photos = json_decode($ekstrakurikuler->photo_path, true) ?? [];
    @endphp

    <div class="article-container">
        <h1 class="article-title">{{ $ekstrakurikuler->nama }}</h1>

        <div class="article-info">
            <p>Published: {{ $ekstrakurikuler->created_at->formatLocalized('%A, %d %B %Y') }}</p>
        </div>

        @if (!empty($photos) && isset($photos[0]))
            <img src="{{ asset('storage/' . $photos[0]) }}"
                 class="article-image"
                 alt="Foto utama ekstrakurikuler {{ $ekstrakurikuler->nama }}">
        @endif

        <div class="article-description">
            {!! $ekstrakurikuler->description !!}
        </div>

        <div class="article-title text-uppercase text-center p-5">
            Foto-foto Lainnya
        </div>

        @if (count($photos) > 1)
            <div class="row">
                @foreach (array_slice($photos, 1) as $photo)
                    <div class="col-md-4 mb-3 mx-auto">
                        <img src="{{ asset('storage/' . $photo) }}"
                             class="img-fluid rounded"
                             alt="Foto ekstrakurikuler {{ $ekstrakurikuler->nama }}">
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
