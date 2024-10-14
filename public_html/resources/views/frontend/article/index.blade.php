@extends('frontend.main')

@section('style')
    <style>
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
    <h1 class="fw-bold text-center" style="margin-top: 90px" data-aos="fade-up">ALL ARTICLE</h1>
    <div class="row m-4 p-3 rounded-1" style="background-color: rgb(41, 123, 191)" data-aos="fade-up">
        @foreach ($articles as $article)
            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 18rem;" data-aos="zoom-in">
                <a href="{{ route('article.show', $article->slug) }}" style="text-decoration: none;color:inherit">
                    @php
                        $photo_paths = json_decode($article->photo_path);
                    @endphp
                    @if (!empty($photo_paths) && is_array($photo_paths) && count($photo_paths) > 0)
                        <img src="{{ asset('storage/' . $photo_paths[0]) }}" class="card-img-top" alt="..."
                            width="150">
                    @else
                        <p>No photo available</p>
                    @endif
                    <div class="card-body">
                        <p class="card-text fw-bold" style="font-size: 9px">{{ $article->user->name }} <br>
                            {{ $article->created_at->formatLocalized('%A, %d %B %Y') }}</p>
                        <hr>
                        <p class="card-text">
                            {{ strlen(strip_tags($article->description)) > 100 ? substr(strip_tags($article->description), 0, 100) . '...' : strip_tags($article->description) }}
                        </p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
