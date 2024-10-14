@extends('frontend.main')

@section('style')
    <style>
        .article-container {
            max-width: 800px;
            margin: 0 auto;
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
        }

        /* Add this CSS to your existing stylesheet */
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
            .float-text h1 {
                font-size: 10px;
            }
        }

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
            /* Transparent background overlay */
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
    <div class="article-container" style="margin-top: 70px;">
        <h1 class="article-title" data-aos="fade-up">{{ $article->title }}</h1>
        <div class="article-info" data-aos="fade-up">
            <p>Author: {{ $article->user->name }}</p>
            <p>Published: {{ $article->created_at->formatLocalized('%A, %d %B %Y') }}</p>
        </div>
        <img data-aos="zoom-in" src="{{ asset('storage/' . json_decode($article->photo_path)[0]) }}"
            class="article-image" alt="Article Image">
        <div class="article-description" data-aos="fade-up">
            {!! $article->description !!}
        </div>

        <div class="article-title text-uppercase text-center p-5" data-aos="fade-up">
            Foto-foto Lainnya
        </div>
        @if (count(json_decode($article->photo_path)) > 1)
            <div class="row" data-aos="fade-up">
                @foreach (array_slice(json_decode($article->photo_path), 1) as $photo)
                    <div class="col-md-4 mb-3 mx-auto">
                        <img src="{{ asset('storage/' . $photo,) }}" class="img-fluid" alt="Article Image">
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
