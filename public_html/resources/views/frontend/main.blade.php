<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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

    {{-- Font Google --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime&display=swap" rel="stylesheet">

    {{-- Navbar & Global Layout CSS --}}
    <link rel="stylesheet" href="{{ asset('css/frontend/layouts/navbar.css') }}">

    {{-- Page-specific CSS --}}
    @yield('style')

    <title>SMP Negeri 14 Bulukumba</title>
</head>
<body>

    {{-- Navbar & Footer disembunyikan khusus halaman login --}}
    @unless (request()->is('login'))
        @include('frontend.layouts.navbar')
    @endunless

    @yield('content')

    @unless (request()->is('login'))
        @include('frontend.layouts.footer')
    @endunless

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

    {{-- Page-specific JS (optional) --}}
    @stack('scripts')
</body>
</html>
