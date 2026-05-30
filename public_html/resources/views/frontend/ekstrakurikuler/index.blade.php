@extends('frontend.main')

@section('style')
    <style>
        .section-header {
            margin-top: 0;
            padding: calc(4rem + 70px) 0 3rem;
            background: var(--gradient-primary);
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .section-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }

        .section-header h1 {
            font-size: clamp(1.75rem, 4vw, 2.75rem);
            font-weight: 800;
            text-align: center;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .section-header p {
            text-align: center;
            font-size: 1rem;
            margin-top: 0.75rem;
            opacity: 0.85;
        }

        .section-content {
            padding: 4rem 0;
            background-color: var(--color-bg);
        }

        /* Organizations Grid */
        .organizations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .organization-card {
            background: #ffffff;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            border: 1px solid var(--color-border);
        }

        .organization-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-xl);
            border-color: transparent;
        }

        .organization-card a {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .organization-card-image {
            width: 100%;
            height: 210px;
            overflow: hidden;
        }

        .organization-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .organization-card:hover .organization-card-image img {
            transform: scale(1.06);
        }

        .organization-card-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .organization-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.7rem;
            background: rgba(13, 148, 136, 0.08);
            color: var(--color-accent);
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            width: fit-content;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .organization-name {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .organization-description {
            font-size: 0.875rem;
            color: var(--color-text-light);
            line-height: 1.6;
            flex-grow: 1;
        }

        .org-read-more {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            margin-top: 1rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--color-primary-light);
            transition: gap 0.3s ease;
        }

        .organization-card:hover .org-read-more {
            gap: 0.7rem;
        }

        @media (max-width: 768px) {
            .section-header { padding: 3rem 0 2rem; }
            .section-content { padding: 3rem 0; }
            .organizations-grid { grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1.5rem; }
        }

        @media (max-width: 576px) {
            .organizations-grid { grid-template-columns: 1fr; }
        }
    </style>
@endsection

@section('content')
    {{-- Header --}}
    <div class="section-header">
        <div class="container">
            <h1 data-aos="fade-up">Organisasi & Ekstrakurikuler</h1>
            <p data-aos="fade-up" data-aos-delay="100">Wadah pengembangan minat, bakat, dan kreativitas siswa</p>
        </div>
    </div>

    {{-- Breadcrumb --}}
    <nav class="page-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Organisasi & Ekstrakurikuler</li>
            </ol>
        </div>
    </nav>

    {{-- Organizations --}}
    <div class="section-content">
        <div class="container">
            <div class="organizations-grid">
                @forelse ($organisasis ?? [] as $index => $org)
                    @php
                        $photos = json_decode($org->photo_path, true) ?? [];
                        $image = !empty($photos) && isset($photos[0]) 
                            ? asset('storage/' . str_replace('public/', '', $photos[0])) 
                            : 'https://placehold.co/400x300/1e3a5f/ffffff?text=' . urlencode($org->nama);
                        $type = (strtoupper($org->nama) === 'OSIS') ? 'Organisasi' : 'Ekstrakurikuler';
                    @endphp
                    <div class="organization-card" data-aos="fade-up" data-aos-delay="{{ min($index * 60, 360) }}">
                        <a href="{{ url('/ekstrakurikuler/' . $org->slug) }}">
                            <div class="organization-card-image">
                                <img src="{{ $image }}" alt="{{ $org->nama }}">
                            </div>
                            <div class="organization-card-body">
                                <span class="organization-badge">{{ $type }}</span>
                                <h3 class="organization-name">{{ $org->nama }}</h3>
                                <p class="organization-description">{!! Str::limit(strip_tags($org->description), 120) !!}</p>
                                <span class="org-read-more">
                                    Lihat Detail <i class="fas fa-arrow-right"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="mgmt-empty text-muted">
                            <i class="fas fa-sitemap mb-3" style="font-size: 3.5rem; color: #cbd5e1;"></i>
                            <p class="font-semibold text-slate-600 mb-1" style="font-size: 1.1rem; font-weight: 700;">Belum ada data Organisasi / Ekstrakurikuler</p>
                            <small class="text-slate-400">Data akan muncul secara dinamis setelah ditambahkan oleh admin melalui dashboard.</small>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection