<!-- Footer -->
<footer class="text-center text-lg-start text-white"
        style="background-color: rgb(41, 123, 191);"
        data-aos="fade-up">

    {{-- Section: Social media --}}
    <section class="d-flex justify-content-between p-4" style="background-color: #0000006c;">
        <div class="me-5">
            <span>Get connected with us on social networks:</span>
        </div>

        <div>
            <a href="#" class="text-white me-4" aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="text-white me-4" aria-label="Twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="text-white me-4" aria-label="Google">
                <i class="fab fa-google"></i>
            </a>
            <a href="#" class="text-white me-4" aria-label="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="text-white me-4" aria-label="LinkedIn">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="https://github.com/kyyneko" target="_blank"
               class="text-white me-4" aria-label="GitHub">
                <i class="fab fa-github"></i>
            </a>
        </div>
    </section>

    {{-- Section: Links --}}
    <section>
        <div class="container text-center text-md-start mt-5">
            <div class="row mt-3">

                {{-- Column: Intro --}}
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">UPT SMPN 14 BULUKUMBA</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto"
                        style="width: 100px; background-color: #7c4dff; height: 2px;" />
                    <p>
                        Selamat datang di website UPT SPF SMPN 14 Bulukumba! Temukan informasi
                        terkini tentang kegiatan dan prestasi kami di sini. Terima kasih atas kunjungan Anda!
                    </p>
                </div>

                {{-- Column: Profile --}}
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Profile</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto"
                        style="width: 60px; background-color: #7c4dff; height: 2px;" />
                    <p><a href="{{ url('/wargaSekolah/dataGuru') }}" class="text-white">Guru</a></p>
                    <p><a href="{{ url('/wargaSekolah/dataStaff') }}" class="text-white">Staff</a></p>
                    <p><a href="{{ url('/alumni') }}" class="text-white">Alumni</a></p>
                    <p><a href="{{ url('/ekstrakurikuler') }}" class="text-white">Ekstrakurikuler</a></p>
                </div>

                {{-- Column: About --}}
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">About</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto"
                        style="width: 60px; background-color: #7c4dff; height: 2px;" />
                    <p><a href="{{ url('/article') }}" class="text-white">Article</a></p>
                    <p><a href="{{ url('/fasilitas') }}" class="text-white">Fasilitas</a></p>
                    <p><a href="{{ url('/prestasi') }}" class="text-white">Prestasi</a></p>
                    <p>
                        <a href="https://guru.kemdikbud.go.id/komunitas/O19oaPwn6v?from=home"
                           target="_blank" class="text-white">
                            Macora14
                        </a>
                    </p>
                </div>

                {{-- Column: Contact --}}
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold">Contact</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto"
                        style="width: 60px; background-color: #7c4dff; height: 2px;" />
                    <p>
                        <i class="fas fa-home me-2"></i>
                        Jl. Pendidikan No.15, Jawijawi, Kec. Bulukumpa, Kabupaten Bulukumba,
                        Sulawesi Selatan 92552
                    </p>
                    <p>
                        <i class="fas fa-envelope me-2"></i>
                        smp14bulukumba@gmail.com
                    </p>
                    <p>
                        <i class="fas fa-phone me-2"></i>
                        0413 2586 276
                    </p>
                    <p>
                        <i class="fas fa-print me-2"></i>
                        +62 812 4104 5704
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Copyright --}}
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2025 Copyright:
        <a class="text-white" href="https://github.com/kyyneko" target="_blank" style="text-decoration: none;">
            <i class="fa-brands fa-github"></i> Kyyneko
        </a>
    </div>
</footer>
