<div class="header">
    <nav class="navbar navbar-expand-lg py-1 fixed-top navbar-custom">
        <div class="container-fluid">
            <div class="navbar-header d-flex align-items-center">
                <a class="navbar-brand ml-auto py-2" href="/">
                    <img
                        src="{{ asset('image/Logo.png') }}"
                        alt="Logo UPT SPF SMPN 14 BULUKUMBA"
                        style="width: 46px; height: 46px; object-fit: contain;">
                </a>
                <p class="navbar-brand ml-auto text-wrap navbar-title" style="padding-top: 15px">
                    UPT SPF SMPN 14 BULUKUMBA
                </p>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse pe-2" id="navbarNav" style="justify-content: end">
                <ul class="navbar-nav">
                    <li class="nav-item px-2">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                           href="{{ url('/') }}">
                            Beranda
                        </a>
                    </li>

                    <li class="nav-item px-2">
                        <a class="nav-link {{ request()->is('profil') ? 'active' : '' }}"
                           href="{{ url('/profil') }}">
                            Profil
                        </a>
                    </li>

                    <li class="nav-item px-2 dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('wargaSekolah/*') ? 'active' : '' }}"
                           href="#" id="dropdownWargaSekolah" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Warga Sekolah
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownWargaSekolah">
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

                    <li class="nav-item px-2 dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('kombel/*') ? 'active' : '' }}"
                           href="#" id="dropdownKombel" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Komunitas Belajar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownKombel">
                            <li>
                                <a class="dropdown-item text-white" target="_blank"
                                   href="https://guru.kemdikbud.go.id/komunitas/O19oaPwn6v?from=home">
                                    Macora14
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item px-2 dropdown">
                        <a class="nav-link dropdown-toggle {{ Str::startsWith(request()->path(), ['article', 'ekstrakurikuler', 'fasilitas', 'prestasi', 'galeri']) ? 'active' : '' }}"
                           href="#" id="dropdownLainnya" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Lainnya
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownLainnya">
                            <li><a class="dropdown-item text-white" href="{{ url('/article') }}">Artikel</a></li>
                            <li><a class="dropdown-item text-white" href="{{ url('/galeri') }}">Galeri Foto</a></li>
                            <li><a class="dropdown-item text-white" href="{{ url('/ekstrakurikuler') }}">Organisasi & Ekskul</a></li>
                            <li><a class="dropdown-item text-white" href="{{ url('/fasilitas') }}">Fasilitas</a></li>
                            <li><a class="dropdown-item text-white" href="{{ url('/prestasi') }}">Prestasi</a></li>
                        </ul>
                    </li>

                    <li class="nav-item px-2">
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}"
                           href="{{ url('/login') }}">
                            <i class="fa-solid fa-right-to-bracket"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>