<div class="header">
    <nav class="navbar navbar-expand-lg py-1 rounded-bottom-3 fixed-top navbar-custom"
        style="backdrop-filter: blur(10px); background-color: transparent;">
        <div class="container-fluid">
            <div class="navbar-header d-flex">
                <a class="navbar-brand ml-auto py-2" href="/">
                    <img style="max-height: 50px"
                         src="{{ asset('image/Logo.png') }}"
                         alt="Logo SMPN 14 Bulukumba">
                </a>
                <p class="navbar-brand ml-auto text-wrap navbar-title" style="padding-top: 15px">
                    SMPN 14 BULUKUMBA
                </p>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse pe-2" id="navbarNav" style="justify-content: end">
                <ul class="navbar-nav">
                    <li class="nav-item px-3">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                           href="{{ url('/') }}">
                            Beranda
                        </a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="nav-link {{ request()->is('profil') ? 'active' : '' }}"
                           href="{{ url('/profil') }}">
                            Profile
                        </a>
                    </li>

                    <li class="nav-item px-3 dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('wargaSekolah/*') ? 'active' : '' }}"
                           href="#" id="dropdownWargaSekolah" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Warga Sekolah
                        </a>
                        <ul class="dropdown-menu" style="background-color: rgb(19, 123, 191)"
                            aria-labelledby="dropdownWargaSekolah">
                            <li><a class="dropdown-item text-white" href="{{ url('/wargaSekolah/dataGuru') }}">Data Guru</a></li>
                            <li><a class="dropdown-item text-white" href="{{ url('/wargaSekolah/dataStaff') }}">Data Staff</a></li>
                            <li>
                                <a class="dropdown-item text-white" target="_blank"
                                   href="https://forms.gle/SBm81m6NwGPKLCpo7">
                                    Alumni
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item px-3 dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('kombel/*') ? 'active' : '' }}"
                           href="#" id="dropdownKombel" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Komunitas Belajar
                        </a>
                        <ul class="dropdown-menu" style="background-color: rgb(19, 123, 191)"
                            aria-labelledby="dropdownKombel">
                            <li>
                                <a class="dropdown-item text-white"
                                   href="https://guru.kemdikbud.go.id/komunitas/O19oaPwn6v?from=home">
                                    Macora14
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item px-3 dropdown">
                        <a class="nav-link dropdown-toggle {{ Str::startsWith(request()->path(), ['article', 'ekstrakurikuler', 'fasilitas', 'prestasi']) ? 'active' : '' }}"
                           href="#" id="dropdownLainnya" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Lainnya
                        </a>
                        <ul class="dropdown-menu" style="background-color: rgb(19, 123, 191)"
                            aria-labelledby="dropdownLainnya">
                            <li><a class="dropdown-item text-white" href="{{ url('/article') }}">Article</a></li>
                            <li><a class="dropdown-item text-white" href="{{ url('/ekstrakurikuler') }}">Organisasi</a></li>
                            <li><a class="dropdown-item text-white" href="{{ url('/fasilitas') }}">Fasilitas</a></li>
                            <li><a class="dropdown-item text-white" href="{{ url('/prestasi') }}">Prestasi</a></li>
                        </ul>
                    </li>

                    <li class="nav-item px-3">
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}"
                           href="{{ url('/login') }}">
                            <i class="fa-solid fa-right-to-bracket"></i>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <style>
        /* Font utama Poppins (sama seperti halaman sebelumnya) */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

        :root {
            --font-main: 'Poppins', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .navbar-custom,
        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-title,
        .navbar-custom .nav-link,
        .navbar-custom .dropdown-menu,
        .navbar-custom .dropdown-item {
            font-family: var(--font-main);
        }

        /* Navbar warna teks default (transparan/atas) */
        .navbar-custom .nav-link {
            color: #2d3748 !important;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .navbar-custom .navbar-title {
            color: #2d3748 !important;
            font-weight: 700;
            letter-spacing: 0.04em;
            transition: all 0.3s ease;
        }

        .navbar-custom .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(45, 55, 72, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-custom .nav-link:hover {
            color: rgb(19, 123, 191) !important;
        }

        .navbar-custom .nav-link.active {
            color: rgb(19, 123, 191) !important;
            font-weight: 700;
        }

        /* Navbar warna teks saat scroll (background biru) */
        .navbar-custom.scrolled .nav-link {
            color: #ffffff !important;
        }

        .navbar-custom.scrolled .navbar-title {
            color: #ffffff !important;
        }

        .navbar-custom.scrolled .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-custom.scrolled .nav-link:hover {
            color: #e0f2fe !important;
        }

        .navbar-custom.scrolled .nav-link.active {
            color: #ffffff !important;
            text-decoration: underline;
        }

        /* Dropdown items */
        .dropdown-menu .dropdown-item {
            transition: background-color 0.3s ease;
            font-weight: 500;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>

    <script>
        $(function () {
            function updateNavbarBackground() {
                const scrollPosition = $(window).scrollTop();
                const navbar = $('.navbar-custom');

                if (scrollPosition > 50) {
                    navbar.css('background-color', 'rgba(1, 146, 213, 0.9)');
                    navbar.addClass('scrolled');
                } else {
                    navbar.css('background-color', 'transparent');
                    navbar.removeClass('scrolled');
                }
            }

            updateNavbarBackground();
            $(window).on('scroll', updateNavbarBackground);
        });
    </script>
</div>
