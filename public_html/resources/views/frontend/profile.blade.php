@extends('frontend.main')

@section('style')
    <style>
        /* Banner */
        .profile-banner {
            margin-top: 0;
            position: relative;
            overflow: hidden;
        }

        .profile-banner img {
            width: 100%;
            max-height: 340px;
            object-fit: cover;
        }

        .profile-banner .banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(30,58,95,0.2) 0%, rgba(30,58,95,0.7) 100%);
        }

        .profile-banner .banner-text {
            position: absolute;
            bottom: 2rem;
            left: 0;
            right: 0;
            text-align: center;
            color: #ffffff;
            z-index: 2;
        }

        .profile-banner .banner-text h1 {
            font-weight: 800;
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            text-shadow: 0 2px 12px rgba(0,0,0,0.3);
            letter-spacing: -0.02em;
        }

        /* Section Wrapper */
        .section-wrapper {
            padding: 4.5rem 0;
        }

        .section-wrapper:nth-of-type(even) {
            background-color: var(--color-bg);
        }

        .section-title {
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 800;
            letter-spacing: -0.02em;
            text-align: center;
            margin-bottom: 0.5rem;
            color: var(--color-text);
        }

        .section-title-desc {
            text-align: center;
            color: var(--color-text-light);
            font-size: 0.95rem;
            margin-bottom: 3rem;
        }

        .section-title-small {
            font-size: 1.35rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            color: var(--color-text);
        }

        .text-justify { text-align: justify; }

        /* Kepala Sekolah */
        .kepsek-photo {
            max-width: 260px;
            border: 3px solid #ffffff;
            box-shadow: var(--shadow-lg);
            border-radius: var(--radius-lg);
        }

        .kepsek-name {
            font-size: 1.35rem;
            font-weight: 700;
            margin-top: 1.25rem;
            margin-bottom: 0.25rem;
            color: var(--color-text);
        }

        .kepsek-role {
            font-size: 0.9rem;
            color: var(--color-text-light);
            margin-bottom: 0;
        }

        .kepsek-quote {
            font-size: 0.95rem;
            line-height: 1.8;
            color: var(--color-text-light);
            position: relative;
            padding-left: 1.5rem;
            border-left: 3px solid var(--color-accent);
        }

        /* Card Kepala Sekolah */
        .kepsek-card {
            transition: all 0.3s ease;
            border-radius: var(--radius-md) !important;
            border: 1px solid var(--color-border) !important;
        }

        .kepsek-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: transparent !important;
        }

        .kepsek-card img {
            max-width: 100%;
            height: auto;
            border-radius: var(--radius-sm);
        }

        .kepsek-card .card-body { padding: 1rem 0.75rem; }

        .kepsek-card p {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--color-text);
            line-height: 1.4;
        }

        /* Data Sekolah Section */
        /* Data Sekolah - Card Grid */
        .data-sekolah-section {
            background: var(--gradient-primary);
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .data-sekolah-section::before {
            content: '';
            position: absolute;
            top: -120px;
            right: -80px;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: rgba(255,255,255,0.03);
        }

        .data-sekolah-section::after {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -60px;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(255,255,255,0.03);
        }

        .data-sekolah-section .section-title,
        .data-sekolah-section .section-title-desc {
            color: #ffffff;
            position: relative;
            z-index: 1;
        }

        .data-card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1rem;
            position: relative;
            z-index: 1;
        }

        .data-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: var(--radius-md);
            padding: 1.25rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .data-card:hover {
            background: rgba(255,255,255,0.14);
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        .data-card-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            margin-bottom: 0.85rem;
            color: rgba(255,255,255,0.9);
        }

        .data-card-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(255,255,255,0.55);
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .data-card-value {
            font-size: 1rem;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.3;
        }

        .data-logo-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: var(--radius-lg);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            grid-column: span 1;
            transition: all 0.3s ease;
        }

        .data-logo-card:hover {
            background: rgba(255,255,255,0.15);
        }

        .data-logo-card img {
            max-width: 120px;
            margin-bottom: 1rem;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.2));
        }

        .data-logo-card .school-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.35rem;
        }

        .data-logo-card .school-tagline {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.6);
        }

        .btn-dapodik {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
            padding: 0.65rem 1.75rem;
            background: #ffffff;
            color: var(--color-primary);
            text-decoration: none;
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .btn-dapodik:hover {
            background: rgba(255,255,255,0.92);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            color: var(--color-primary);
        }

        @media (max-width: 768px) {
            .data-card-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .data-card-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Visi Misi */
        .visi-misi-section .visi-text {
            font-size: 1.05rem;
            line-height: 1.8;
            color: var(--color-text-light);
            border-left: 3px solid var(--color-primary-light);
            padding-left: 1.5rem;
        }

        .visi-misi-section ul {
            list-style: none;
            padding-left: 0;
        }

        .visi-misi-section ul li {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 0.85rem;
            line-height: 1.7;
            color: var(--color-text-light);
            font-size: 0.95rem;
        }

        .visi-misi-section ul li:before {
            content: "";
            position: absolute;
            left: 0;
            top: 6px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--color-accent);
        }

        /* Info Sections */
        .info-section-blue {
            background: var(--gradient-primary);
            color: #ffffff;
        }

        .info-section-blue .section-title-small { color: #ffffff; }

        .info-section-blue p {
            color: rgba(255,255,255,0.85);
        }

        .info-section-blue .btn-outline-light {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.6rem 1.5rem;
            background-color: #ffffff;
            color: var(--color-primary);
            text-decoration: none;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
        }

        .info-section-blue .btn-outline-light:hover {
            background-color: rgba(255,255,255,0.9);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .section-wrapper { padding: 3.5rem 0; }
            .section-title { font-size: 1.35rem; margin-bottom: 0.25rem; }
            .section-title-small { font-size: 1.15rem; }
            .kepsek-photo { max-width: 200px; }
            .kepsek-name { font-size: 1.15rem; }
            .kepsek-quote { font-size: 0.9rem; }
            .data-sekolah-section table th { width: 42%; font-size: 0.85rem; }
            .data-sekolah-section table td { font-size: 0.85rem; }
        }
    </style>
@endsection

@section('content')
    <main>

        {{-- BANNER --}}
        <section class="profile-banner">
            <img src="{{ ($settings->profile_banner_photo && file_exists(public_path('storage/' . str_replace('public/', '', $settings->profile_banner_photo)))) ? asset('storage/' . str_replace('public/', '', $settings->profile_banner_photo)) : asset('image/homePic/1.jpg') }}" alt="Banner UPT SPF SMPN 14 BULUKUMBA" class="img-fluid">
            <div class="banner-overlay"></div>
            <div class="banner-text" data-aos="fade-up">
                <h1>Profil Sekolah</h1>
            </div>
        </section>

        {{-- BREADCRUMB --}}
        <nav class="page-breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Profil</li>
                </ol>
            </div>
        </nav>

        {{-- HERO KEPALA SEKOLAH --}}
        <section class="section-wrapper">
            <div class="container">
                <h1 class="section-title">Kepala Sekolah</h1>
                <p class="section-title-desc">Pimpinan UPT SPF SMPN 14 BULUKUMBA</p>

                <div class="row align-items-center justify-content-center">
                    <div class="col-md-4 text-center mb-4 mb-md-0" data-aos="fade-right">
                        <img src="{{ ($settings->kepsek_photo_path && file_exists(public_path('storage/' . str_replace('public/', '', $settings->kepsek_photo_path)))) ? asset('storage/' . str_replace('public/', '', $settings->kepsek_photo_path)) : 'https://placehold.co/300x400/1e3a5f/ffffff?text=' . urlencode($settings->kepsek_name) }}"
                            alt="Foto Kepala Sekolah" class="img-fluid rounded-3 kepsek-photo">
                        <h2 class="kepsek-name">{{ $settings->kepsek_name }}</h2>
                        <p class="kepsek-role">Kepala {{ $settings->school_name }}</p>
                    </div>

                    <div class="col-md-8" data-aos="fade-left" data-aos-delay="100">
                        <p class="kepsek-quote text-justify">
                            <em>
                                "{{ $settings->kepsek_welcome_text }}"
                            </em>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- SEJARAH SEKOLAH --}}
        <section class="section-wrapper">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">{{ $settings->history_title }}</h2>
                <p class="section-title-desc" data-aos="fade-up">Perjalanan panjang menuju pendidikan yang lebih baik</p>

                <div class="row justify-content-center">
                    <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">
                        <div class="text-justify mb-0" style="line-height: 1.8; color: var(--color-text-light);">
                            {!! nl2br(e($settings->history_description)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- KEPALA SEKOLAH YANG PERNAH MENJABAT --}}
        <section class="section-wrapper">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">Kepala Sekolah yang Pernah Menjabat</h2>
                <p class="section-title-desc" data-aos="fade-up">Deretan pemimpin yang telah mengabdi</p>

                <div class="row g-3 justify-content-center">
                    @forelse ($formerPrincipals ?? [] as $index => $principal)
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ min($index * 50, 300) }}">
                            <div class="card text-center border-0 shadow-sm h-100 kepsek-card">
                                <div class="card-body d-flex flex-column align-items-center justify-content-start p-2.5">
                                    <div class="w-100 rounded bg-slate-100 d-flex align-items-center justify-content-center overflow-hidden mb-2" style="aspect-ratio: 150 / 190; background-color: #f1f5f9 !important;">
                                        @if($principal->photo_path && file_exists(public_path('storage/' . str_replace('public/', '', $principal->photo_path))))
                                            <img src="{{ asset('storage/' . str_replace('public/', '', $principal->photo_path)) }}" alt="Foto {{ $principal->name }}" class="w-100 h-100" style="object-fit: cover;">
                                        @else
                                            <div class="text-center py-4">
                                                <i class="fas fa-user-tie text-slate-400" style="font-size: 3rem; color: #94a3b8 !important;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="mb-1 font-semibold text-slate-700" style="font-size: 0.8rem; line-height: 1.25;">{{ $principal->name }}</p>
                                    @if($principal->period)
                                        <span class="badge bg-light text-slate-500 border px-2 py-0.5" style="font-size: 0.65rem; color: #64748b; font-weight: 500;"><i class="far fa-calendar-alt me-1" style="margin-right: 5px;"></i>{{ $principal->period }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        @php
                            $kepsekList = [
                                'Budi Santoso, S.Pd',
                                'Siti Lestari, M.Pd',
                                'Agus Pratama, S.Pd',
                                'Dewi Rahmawati, M.Pd',
                                'Andi Fikri, S.Pd',
                                'Nina Kusuma, M.Pd',
                                'Rafi Alamsyah, S.Pd',
                                'Lina Purnama, M.Pd',
                                'Joko Wiryawan, S.Pd',
                                'Mira Anggraini, M.Pd',
                                'Dimas Kurnia, S.Pd',
                                'Rasya Nugraha, S.Pd',
                                'Intan Maharani, M.Pd',
                                'Yudha Saputra, S.Pd',
                            ];
                        @endphp

                        @foreach ($kepsekList as $index => $nama)
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ min($index * 50, 300) }}">
                                <div class="card text-center border-0 shadow-sm h-100 kepsek-card">
                                    <div class="card-body d-flex flex-column align-items-center justify-content-start">
                                        <img src="https://placehold.co/150x190/f1f5f9/475569?text={{ urlencode(explode(' ', $nama)[0]) }}"
                                            class="mb-2" alt="Foto {{ $nama }}">
                                        <p class="mb-0" style="font-size: 0.8rem; line-height: 1.25; font-weight: 600;">{{ $nama }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforelse
                </div>
            </div>
        </section>

        {{-- DATA SEKOLAH --}}
        <section class="section-wrapper data-sekolah-section">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">Data Sekolah</h2>
                <p class="section-title-desc" data-aos="fade-up">Informasi identitas dan status sekolah</p>

                <div class="data-card-grid">
                    {{-- Logo Card --}}
                    <div class="data-logo-card" data-aos="fade-up" data-aos-delay="0">
                        <img src="{{ asset('image/Logo.png') }}" alt="Logo">
                        <div class="school-name">{{ $settings->school_name }}</div>
                        <div class="school-tagline">{{ $settings->kabupaten }}</div>
                    </div>

                    @php
                        $dataSekolah = [
                            ['icon' => 'fas fa-hashtag', 'label' => 'NPSN', 'value' => $settings->npsn],
                            ['icon' => 'fas fa-user-tie', 'label' => 'Kepala Sekolah', 'value' => $settings->kepsek_name],
                            ['icon' => 'fas fa-award', 'label' => 'Akreditasi', 'value' => $settings->akreditasi],
                            ['icon' => 'fas fa-book-open', 'label' => 'Kurikulum', 'value' => $settings->kurikulum],
                            ['icon' => 'fas fa-landmark', 'label' => 'Status', 'value' => $settings->status_sekolah],
                            ['icon' => 'fas fa-graduation-cap', 'label' => 'Bentuk Pendidikan', 'value' => $settings->bentuk_pendidikan],
                            ['icon' => 'fas fa-map-pin', 'label' => 'Kecamatan', 'value' => $settings->kecamatan],
                            ['icon' => 'fas fa-map-marked-alt', 'label' => 'Kabupaten', 'value' => $settings->kabupaten],
                            ['icon' => 'fas fa-globe-asia', 'label' => 'Provinsi', 'value' => $settings->provinsi],
                        ];
                    @endphp

                    @foreach ($dataSekolah as $index => $data)
                        <div class="data-card" data-aos="fade-up" data-aos-delay="{{ min(($index + 1) * 50, 400) }}">
                            <div class="data-card-icon">
                                <i class="{{ $data['icon'] }}"></i>
                            </div>
                            <div class="data-card-label">{{ $data['label'] }}</div>
                            <div class="data-card-value">{{ $data['value'] }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center">
                    <a class="btn-dapodik" href="{{ $settings->dapodik_link }}" target="_blank">
                        <i class="fas fa-external-link-alt"></i> Lihat Data Dapodik
                    </a>
                </div>
            </div>
        </section>

        {{-- VISI & MISI --}}
        <section class="section-wrapper visi-misi-section">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">Visi &amp; Misi</h2>
                <p class="section-title-desc" data-aos="fade-up">Pedoman arah pengembangan sekolah</p>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div data-aos="fade-up" data-aos-delay="100">
                            <h3 class="section-title-small">Visi</h3>
                            <p class="visi-text mb-4">
                                <em>
                                    "{{ $settings->visi }}"
                                </em>
                            </p>
                        </div>

                        <hr class="my-4" style="opacity: 0.15">

                        <div data-aos="fade-up" data-aos-delay="200">
                            <h3 class="section-title-small">Misi</h3>
                            <ul class="text-justify">
                                @foreach(explode("\n", str_replace("\r", "", $settings->misi)) as $misiItem)
                                    @if(trim($misiItem) !== '')
                                        <li>{{ trim($misiItem) }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- INFO - KEMENDIKBUD --}}
        <section class="section-wrapper info-section-blue">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-4 text-center mb-4 mb-lg-0" data-aos="fade-right">
                        <img src="{{ asset('image/LogoKemendikbud.png') }}" alt="Logo Kemendikbud"
                            class="img-fluid" style="max-width: 220px;">
                    </div>

                    <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                        <h3 class="section-title-small">Kementerian Pendidikan dan Kebudayaan</h3>
                        <p class="text-justify mb-3">
                            UPT SPF SMPN 14 BULUKUMBA berada di bawah naungan Kementerian Pendidikan, Kebudayaan, 
                            Riset, dan Teknologi Republik Indonesia. Sekolah ini menerapkan kurikulum nasional 
                            yang telah ditetapkan pemerintah sebagai pedoman pembelajaran.
                        </p>
                        <a href="https://www.kemdikbud.go.id/" target="_blank" class="btn-outline-light">
                            Kunjungi Kemendikbud &raquo;
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- INFO - MERDEKA BELAJAR --}}
        <section class="section-wrapper">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-8 mb-4 mb-lg-0 order-lg-1 order-2" data-aos="fade-right">
                        <h3 class="section-title-small">Kurikulum Merdeka</h3>
                        <p class="text-justify mb-0" style="color: var(--color-text-light); line-height: 1.8;">
                            UPT SPF SMPN 14 BULUKUMBA telah menerapkan Kurikulum Merdeka yang memberikan keleluasaan 
                            kepada guru untuk merancang pembelajaran sesuai kebutuhan dan karakteristik peserta didik. 
                            Melalui pendekatan ini, siswa didorong untuk belajar secara aktif, berpikir kritis, 
                            dan mengembangkan berbagai kompetensi yang dibutuhkan di abad ke-21.
                        </p>
                    </div>

                    <div class="col-lg-4 text-center order-lg-2 order-1" data-aos="fade-left" data-aos-delay="100">
                        <img src="{{ asset('image/LogoKurMer.png') }}" alt="Logo Kurikulum Merdeka"
                            class="img-fluid" style="max-width: 220px;">
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
