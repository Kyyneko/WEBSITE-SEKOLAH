<div class="header">
    <nav class="navbar navbar-expand-lg navbar-dark text-light py-1 rounded-bottom-3 fixed-top"
        style="background-color: backdrop-filter: blur(10px); /* Sesuaikan dengan tingkat blur yang diinginkan */
            background-color: rgba(1, 146, 213, 0.7);">
        <div class="container-fluid">
            <div class="navbar-header d-flex">
                <a class="navbar-brand ml-auto py-2" href="/"
                    style="font-family: 'Cambria', sans-serif; font-weight: bold;">
                    <img style="max-height: 50px" src="{{ asset('image/Logo.png') }}" alt="">
                </a>
                <p class="navbar-brand ml-auto text-wrap" style="padding-top: 15px">
                    SMPN 14 BULUKUMBA
                </p>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse pe-2" id="navbarNav" style="justify-content: end">
                <ul class="navbar-nav">
                    <li class="nav-item px-3" style="font-family: 'Cambria', sans-serif; font-weight: bold;">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                            href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item px-3" style="font-family: 'Cambria', sans-serif; font-weight: bold;">
                        <a class="nav-link {{ request()->is('profil') ? 'active' : '' }}"
                            href="{{ url('/profil') }}">Profile</a>
                    </li>
                    <li class="nav-item px-3 dropdown" style="font-family: 'Cambria', sans-serif; font-weight: bold;">
                        <a class="nav-link dropdown-toggle {{ request()->is('wargaSekolah/*') ? 'active' : '' }}"
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Warga Sekolah
                        </a>
                        <ul class="dropdown-menu" style="background-color: rgb(19, 123, 191)"
                            aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ url('/wargaSekolah/dataGuru') }}">Data
                                    Guru</a></li>
                            <li><a class="dropdown-item" href="{{ url('/wargaSekolah/dataStaff') }}">Data
                                    Staff</a>
                            </li>
                            <li><a class="dropdown-item" target="blank" href="https://forms.gle/SBm81m6NwGPKLCpo7">Alumni</a>
                            </li>
                            <!-- Tambahkan item dropdown lainnya sesuai kebutuhan -->
                        </ul>
                    </li>
                    <li class="nav-item px-3 dropdown" style="font-family: 'Cambria', sans-serif; font-weight: bold;">
                        <a class="nav-link dropdown-toggle {{ request()->is('kombel/*') ? 'active' : '' }}"
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Komunitas Belajar
                        </a>
                        <ul class="dropdown-menu" style="background-color: rgb(19, 123, 191)"
                            aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item"
                                    href="https://guru.kemdikbud.go.id/komunitas/O19oaPwn6v?from=home">Macora14</a>
                            </li>
                            <!-- Tambahkan item dropdown lainnya sesuai kebutuhan -->
                        </ul>
                    </li>
                    <li class="nav-item px-3 dropdown" style="font-family: 'Cambria', sans-serif; font-weight: bold;">
                        <a class="nav-link dropdown-toggle {{ Str::startsWith(request()->path(), ['article', 'ekstrakurikuler', 'fasilitas', 'prestasi']) ? 'active' : '' }}"
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Lainnya
                        </a>
                        <ul class="dropdown-menu" style="background-color: rgb(19, 123, 191)"
                            aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ url('/article') }}">Article</a></li>
                            <li><a class="dropdown-item" href="{{ url('/ekstrakurikuler') }}">Organisasi</a></li>
                            <li><a class="dropdown-item" href="{{ url('/fasilitas') }}">Fasilitas</a></li>
                            <li><a class="dropdown-item" href="{{ url('/prestasi') }}">Prestasi</a>
                            </li>
                            <!-- Tambahkan item dropdown lainnya sesuai kebutuhan -->
                        </ul>
                    </li>

                    <li class="nav-item px-3" style="font-family: 'Cambria', sans-serif; font-weight: bold;">
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ url('/login') }}"><i
                                class="fa-solid fa-right-to-bracket"></i></a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <script>
        $(document).ready(function() {
            // Fungsi untuk mengubah warna latar belakang navbar
            function updateNavbarBackground() {
                var scrollPosition = $(window).scrollTop();

                // Sesuaikan nilai 600 dengan posisi scroll yang diinginkan
                if (scrollPosition > 50) {
                    $('.navbar').css('background-color', 'rgba(1, 146, 213, 0.7)');
                } else {
                    $('.navbar').css('background-color', 'transparent');
                }
            }

            // Panggil fungsi saat halaman dimuat dan saat terjadi peristiwa scroll
            updateNavbarBackground();
            $(window).scroll(updateNavbarBackground);
        });
    </script>

    <!-- Running text info -->
    <marquee behavior="scroll" class="fixed-top" direction="left" style="background-color: rgba(1, 146, 213, 0.7); color: black; font-size: 15px; padding: 2px;">
    <span style="animation: glow 2s infinite alternate;"><i class="fas fa-volume-up"></i> Mohon maaf akses masih terbatas karena website masih dalam masa pengembangan, Terima Kasih</span>
</marquee>
 <script>
        // Skrip JavaScript untuk mengubah warna latar belakang navbar saat scrolling
        $(document).ready(function() {
            // Fungsi untuk mengubah warna latar belakang navbar
            function updateNavbarBackground() {
                var scrollPosition = $(window).scrollTop();

                // Sesuaikan nilai 600 dengan posisi scroll yang diinginkan
                if (scrollPosition > 50) {
                    $('.navbar').css('background-color', 'rgba(1, 146, 213, 0.7)');
                } else {
                    $('.navbar').css('background-color', 'transparent');
                }
            }

            // Panggil fungsi saat halaman dimuat dan saat terjadi peristiwa scroll
            updateNavbarBackground();
            $(window).scroll(updateNavbarBackground);
        });
    </script>
</div>
