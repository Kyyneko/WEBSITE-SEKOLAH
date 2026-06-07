<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'UPT SPF SMPN 14 BULUKUMBA') }}</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #198754);
            color: #ffffff;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .welcome-card {
            background-color: #ffffff;
            color: #212529;
            border-radius: 1rem;
            padding: 2.5rem 2rem;
            max-width: 900px;
            width: 100%;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .welcome-title {
            font-size: 1.9rem;
            font-weight: 800;
            color: #136fbf;
            margin-bottom: .25rem;
            text-transform: uppercase;
        }

        .welcome-subtitle {
            font-size: 1.1rem;
            font-weight: 500;
            color: #555;
        }

        .badge-tagline {
            background-color: #e8f4ff;
            color: #136fbf;
            border-radius: 50rem;
            padding: 0.35rem 0.9rem;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .btn-main {
            background-color: #136fbf;
            border-color: #136fbf;
        }

        .btn-main:hover {
            background-color: #0e5a9b;
            border-color: #0e5a9b;
        }

        .school-list {
            font-size: .9rem;
            margin-bottom: 0;
        }

        .school-list li {
            margin-bottom: .25rem;
        }

        .footer-note {
            font-size: 0.8rem;
            color: #888;
        }

        @media (max-width: 768px) {
            .welcome-card {
                border-radius: .75rem;
                padding: 2rem 1.2rem;
            }

            .welcome-title {
                font-size: 1.5rem;
            }

            .welcome-subtitle {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
<div class="container px-3">
    <div class="welcome-card mx-auto">
        <div class="row g-4 align-items-center">
            <div class="col-md-7">
                <span class="badge-tagline mb-3 d-inline-block">
                    Portal Resmi UPT SPF SMPN 14 Bulukumba
                </span>

                <h1 class="welcome-title">
                    Selamat Datang
                </h1>
                <p class="welcome-subtitle mb-3">
                    di Sistem Informasi Website Sekolah
                </p>

                <p class="mb-3">
                    Akses informasi sekolah, artikel, data guru dan siswa, hingga berita terbaru melalui
                    portal ini. Admin dan pengelola konten dapat masuk ke dashboard untuk mengelola
                    seluruh informasi dengan mudah.
                </p>

                <ul class="school-list">
                    <li>📍 Jl. Pendidikan No.15, Jawijawi, Kec. Bulukumpa, Kab. Bulukumba</li>
                    <li>🎓 Jenjang: Sekolah Menengah Pertama (SMP)</li>
                    <li>🖥️ Portal publik & dashboard admin terintegrasi</li>
                </ul>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-main btn-sm">
                                Masuk ke Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-main btn-sm">
                                Login Admin / Guru
                            </a>
                        @endauth
                    @endif

                    <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm">
                        Kunjungi Website Utama
                    </a>
                </div>
            </div>

            <div class="col-md-5">
                <div class="border rounded-4 p-3 text-center h-100">
                    <h5 class="mb-2">Informasi Singkat</h5>
                    <p class="mb-3" style="font-size: .9rem;">
                        Portal ini dibangun menggunakan <strong>Laravel</strong> dan
                        <strong>Bootstrap 5</strong> untuk mendukung kebutuhan informasi sekolah
                        secara modern dan responsif.
                    </p>
                    <hr>
                    <p class="footer-note mb-0">
                        © {{ date('Y') }} UPT SPF SMPN 14 Bulukumba
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
