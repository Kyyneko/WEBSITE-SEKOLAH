<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Website Resmi UPT SPF SMPN 14 BULUKUMBA - Informasi lengkap seputar profil sekolah, kegiatan, prestasi, dan berita terkini.">

    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Owl Carousel CSS --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">

    {{-- AOS (Animate On Scroll) --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    {{-- Navbar & Global Layout CSS --}}
    <link rel="stylesheet" href="{{ asset('css/frontend/layouts/navbar.css') }}">

    {{-- Global Styles --}}
    <style>
        :root {
            --font-main: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            --color-primary: #1e3a5f;
            --color-primary-light: #2563eb;
            --color-accent: #0d9488;
            --color-accent-light: #14b8a6;
            --color-warm: #f59e0b;
            --color-warm-light: #fbbf24;
            --color-text: #1e293b;
            --color-text-light: #475569;
            --color-bg: #f8fafc;
            --color-bg-alt: #f1f5f9;
            --color-border: #e2e8f0;
            --gradient-primary: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            --gradient-accent: linear-gradient(135deg, var(--color-accent) 0%, var(--color-accent-light) 100%);
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 30px rgba(0,0,0,0.12);
            --shadow-xl: 0 20px 40px rgba(0,0,0,0.15);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-main);
            color: var(--color-text);
            background-color: #ffffff;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Smooth scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--color-bg);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--color-primary);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--color-primary-light);
        }

        /* Global selection */
        ::selection {
            background: var(--color-primary-light);
            color: #ffffff;
        }

        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--gradient-primary);
            color: #ffffff;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: var(--shadow-lg);
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
        }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .back-to-top:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        /* Page loader */
        .page-loader {
            position: fixed;
            inset: 0;
            background: #ffffff;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .page-loader.loaded {
            opacity: 0;
            visibility: hidden;
        }

        .loader-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--color-border);
            border-top-color: var(--color-primary-light);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Breadcrumb global style */
        .page-breadcrumb {
            background: var(--color-bg);
            padding: 1rem 0;
            border-bottom: 1px solid var(--color-border);
        }

        .page-breadcrumb .breadcrumb {
            margin: 0;
            font-size: 0.875rem;
        }

        .page-breadcrumb .breadcrumb-item a {
            color: var(--color-primary-light);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .page-breadcrumb .breadcrumb-item a:hover {
            color: var(--color-primary);
        }

        .page-breadcrumb .breadcrumb-item.active {
            color: var(--color-text-light);
            font-weight: 500;
        }
    </style>

    {{-- Page-specific CSS --}}
    @yield('style')

    <title>UPT SPF SMPN 14 BULUKUMBA</title>
</head>
<body>

    {{-- Page Loader --}}
    <div class="page-loader" id="pageLoader">
        <div class="loader-spinner"></div>
    </div>

    {{-- Navbar & Footer disembunyikan khusus halaman login --}}
    @unless (request()->is('login'))
        @include('frontend.layouts.navbar')
    @endunless

    @yield('content')

    @unless (request()->is('login'))
        @include('frontend.layouts.footer')
    @endunless

    {{-- Back to Top Button --}}
    <button class="back-to-top" id="backToTop" aria-label="Kembali ke atas">
        <i class="fas fa-chevron-up"></i>
    </button>

    {{-- jQuery & Owl Carousel JS --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous">
    </script>

    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/eef377116d.js" crossorigin="anonymous"></script>

    {{-- AOS JS --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    {{-- Global Scripts --}}
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 80
        });

        // Page loader
        window.addEventListener('load', function() {
            document.getElementById('pageLoader').classList.add('loaded');
        });

        // Back to top
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 400) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });
        backToTop.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Navbar scroll effect
        const navbar = document.querySelector('.navbar-custom');
        if (navbar) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        }
    </script>

    {{-- Page-specific JS (optional) --}}
    @stack('scripts')
</body>
</html>
