<!-- Footer -->
<footer class="site-footer" data-aos="fade-up" data-aos-duration="600">

    {{-- Wave Separator --}}
    <div class="footer-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path fill="currentColor" d="M0,40 C360,100 720,0 1080,60 C1260,90 1380,50 1440,40 L1440,100 L0,100 Z"/>
        </svg>
    </div>

    {{-- Main Footer Content --}}
    <div class="footer-main">
        {{-- Section: Social media --}}
        <section class="footer-social">
            <div class="container d-flex flex-wrap justify-content-between align-items-center">
                <div class="mb-2 mb-md-0">
                    <span class="social-text">Ikuti kami di media sosial</span>
                </div>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="https://github.com/kyyneko" target="_blank" aria-label="GitHub"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </section>

        {{-- Section: Links --}}
        <section class="footer-links">
            <div class="container">
                <div class="row">
                    {{-- Column: Intro --}}
                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                        <div class="footer-brand">
                            <img src="{{ asset('image/Logo.png') }}" alt="Logo" style="width: 48px; height: 48px; border-radius: 50%; margin-bottom: 1rem;">
                            <h5 class="footer-title">UPT SPF SMPN 14 BULUKUMBA</h5>
                        </div>
                        <p class="footer-desc">
                            Sekolah menengah pertama negeri yang berkomitmen mengembangkan potensi siswa secara akademik 
                            maupun non-akademik dengan lingkungan belajar yang kondusif dan inovatif.
                        </p>
                    </div>

                    {{-- Column: Quick Links --}}
                    <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                        <h6 class="footer-heading">Navigasi</h6>
                        <ul class="footer-nav">
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li><a href="{{ url('/profil') }}">Profil Sekolah</a></li>
                            <li><a href="{{ url('/article') }}">Artikel</a></li>
                            <li><a href="{{ url('/prestasi') }}">Prestasi</a></li>
                        </ul>
                    </div>

                    {{-- Column: Information --}}
                    <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                        <h6 class="footer-heading">Informasi</h6>
                        <ul class="footer-nav">
                            <li><a href="{{ url('/wargaSekolah/dataGuru') }}">Data Guru</a></li>
                            <li><a href="{{ url('/wargaSekolah/dataStaff') }}">Data Staff</a></li>
                            <li><a href="{{ url('/ekstrakurikuler') }}">Ekstrakurikuler</a></li>
                            <li><a href="{{ url('/fasilitas') }}">Fasilitas</a></li>
                        </ul>
                    </div>

                    {{-- Column: Contact --}}
                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                        <h6 class="footer-heading">Hubungi Kami</h6>
                        <ul class="footer-contact">
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Kec. Bulukumpa, Kab. Bulukumba, Sulawesi Selatan</span>
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <span>info@smpn14bulukumba.sch.id</span>
                            </li>
                            <li>
                                <i class="fas fa-phone"></i>
                                <span>(0413) XXXXXXX</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Copyright --}}
    <div class="footer-copyright">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} UPT SPF SMPN 14 BULUKUMBA. Dikembangkan oleh
                <a href="https://github.com/kyyneko" target="_blank">
                    <i class="fa-brands fa-github"></i> Kyyneko
                </a>
            </p>
        </div>
    </div>
</footer>

<style>
    .site-footer {
        position: relative;
        font-family: var(--font-main, 'Inter', sans-serif);
    }

    .footer-wave {
        color: var(--color-primary, #1e3a5f);
        line-height: 0;
        margin-bottom: -1px;
    }

    .footer-wave svg {
        width: 100%;
        height: 80px;
    }

    .footer-main {
        background: var(--color-primary, #1e3a5f);
        color: rgba(255, 255, 255, 0.9);
    }

    /* Social Section */
    .footer-social {
        padding: 1.25rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .social-text {
        font-weight: 500;
        font-size: 0.9rem;
        letter-spacing: 0.02em;
    }

    .social-links {
        display: flex;
        gap: 0.75rem;
    }

    .social-links a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .social-links a:hover {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Links Section */
    .footer-links {
        padding: 3rem 0 2rem;
    }

    .footer-brand {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .footer-brand img {
        flex-shrink: 0;
    }

    .footer-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
        letter-spacing: 0.01em;
    }

    .footer-desc {
        font-size: 0.875rem;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .footer-heading {
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #ffffff;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        position: relative;
    }

    .footer-heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 30px;
        height: 2px;
        background: var(--color-accent, #0d9488);
        border-radius: 2px;
    }

    .footer-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-nav li {
        margin-bottom: 0.6rem;
    }

    .footer-nav a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 400;
        transition: all 0.25s ease;
        display: inline-block;
    }

    .footer-nav a:hover {
        color: #ffffff;
        transform: translateX(4px);
    }

    .footer-contact {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-contact li {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 0.85rem;
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        align-items: flex-start;
    }

    .footer-contact li i {
        color: var(--color-accent, #0d9488);
        margin-top: 3px;
        width: 16px;
        flex-shrink: 0;
    }

    /* Copyright */
    .footer-copyright {
        background: rgba(0, 0, 0, 0.3);
        padding: 1.15rem 0;
    }

    .footer-copyright p {
        margin: 0;
        font-size: 0.82rem;
        color: rgba(255, 255, 255, 0.85);
    }

    .footer-copyright a {
        color: #ffffff;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.25s ease;
    }

    .footer-copyright a:hover {
        color: var(--color-accent, #0d9488);
    }

    @media (max-width: 768px) {
        .footer-wave svg {
            height: 50px;
        }

        .footer-links {
            padding: 2rem 0 1rem;
        }

        .footer-social {
            text-align: center;
        }

        .footer-social .container {
            justify-content: center !important;
            flex-direction: column;
            gap: 1rem;
        }

        .social-links {
            justify-content: center;
        }
    }
</style>
