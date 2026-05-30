@extends('frontend/main')

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

        .staff-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
            gap: 2rem;
        }

        .staff-card {
            background: #ffffff;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            border: 1px solid var(--color-border);
        }

        .staff-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-xl);
            border-color: transparent;
        }

        .staff-card-image {
            width: 100%;
            height: 260px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--color-bg) 0%, var(--color-bg-alt) 100%);
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .staff-card-image::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(37, 99, 235, 0.05);
        }

        .staff-card-image::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(13, 148, 136, 0.05);
        }

        .staff-card-image img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #ffffff;
            box-shadow: var(--shadow-md);
            transition: transform 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .staff-card:hover .staff-card-image img {
            transform: scale(1.05);
        }

        .staff-card-body {
            padding: 1.25rem;
            text-align: center;
        }

        .staff-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 0.35rem;
        }

        .staff-position {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--color-primary-light);
            margin: 0;
        }

        .staff-position.not-assigned {
            color: var(--color-text-light);
            font-style: italic;
            font-weight: 400;
        }

        .position-badge {
            display: inline-block;
            padding: 0.2rem 0.65rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            margin-top: 0.5rem;
            letter-spacing: 0.02em;
        }

        .badge-admin { background-color: rgba(37,99,235,0.08); color: #2563eb; }
        .badge-operator { background-color: rgba(13,148,136,0.08); color: #0d9488; }
        .badge-support { background-color: rgba(245,158,11,0.08); color: #d97706; }
        .badge-other { background-color: rgba(100,116,139,0.08); color: #64748b; }

        @media (max-width: 768px) {
            .section-header { padding: 3rem 0 2rem; }
            .section-content { padding: 3rem 0; }
            .staff-grid { grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1.5rem; }
            .staff-card-image { height: 230px; }
            .staff-card-image img { width: 160px; height: 160px; }
        }

        @media (max-width: 576px) {
            .staff-grid { grid-template-columns: 1fr; gap: 1.5rem; }
        }
    </style>
@endsection

@section('content')
    {{-- Header --}}
    <div class="section-header">
        <div class="container">
            <h1 data-aos="fade-up">Data Staff</h1>
            <p data-aos="fade-up" data-aos-delay="100">Tenaga kependidikan UPT SPF SMPN 14 BULUKUMBA</p>
        </div>
    </div>

    {{-- Breadcrumb --}}
    <nav class="page-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#">Warga Sekolah</a></li>
                <li class="breadcrumb-item active">Data Staff</li>
            </ol>
        </div>
    </nav>

    {{-- Content --}}
    <div class="section-content">
        <div class="container">
            <div class="staff-grid">
                @forelse ($users as $index => $staff)
                    @php
                        $type = 'other';
                        $posLower = strtolower($staff->position ?? '');
                        if (str_contains($posLower, 'tata usaha') || str_contains($posLower, 'administrasi') || str_contains($posLower, 'bendahara') || str_contains($posLower, 'tu')) {
                            $type = 'admin';
                        } elseif (str_contains($posLower, 'operator') || str_contains($posLower, 'pustakawan') || str_contains($posLower, 'laboran')) {
                            $type = 'operator';
                        } elseif (str_contains($posLower, 'penjaga') || str_contains($posLower, 'kebersihan') || str_contains($posLower, 'satpam') || str_contains($posLower, 'keamanan') || str_contains($posLower, 'cs')) {
                            $type = 'support';
                        }
                        
                        $typeName = 'Lainnya';
                        if ($type === 'admin') $typeName = 'Administrasi';
                        elseif ($type === 'operator') $typeName = 'Teknis';
                        elseif ($type === 'support') $typeName = 'Pendukung';
                    @endphp
                    <div class="staff-card" data-aos="fade-up" data-aos-delay="{{ min($index * 60, 360) }}">
                        <div class="staff-card-image">
                            @if($staff->photo_path)
                                <img src="{{ asset('storage/' . str_replace('public/', '', $staff->photo_path)) }}" alt="{{ $staff->name }}">
                            @else
                                <div class="w-100 h-100 rounded-circle d-flex align-items-center justify-content-center bg-light border shadow-sm" style="max-width: 180px; max-height: 180px; aspect-ratio: 1/1;">
                                    <i class="fas fa-users-cog" style="font-size: 4rem; color: #0d9488;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="staff-card-body">
                            <p class="staff-name">{{ $staff->name }}</p>
                            @if (!empty($staff->position))
                                <p class="staff-position">{{ $staff->position }}</p>
                                <span class="position-badge badge-{{ $type }}">
                                    {{ $typeName }}
                                </span>
                            @else
                                <p class="staff-position not-assigned">Belum ditetapkan</p>
                                <span class="position-badge badge-other">Lainnya</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 w-100" style="grid-column: 1 / -1;">
                        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:80px;height:80px;border-radius:50%;background:rgba(30,58,95,0.06);color:#94a3b8;">
                            <i class="fas fa-users-cog" style="font-size:2rem;color:#94a3b8;"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Belum Ada Data Staf</h5>
                        <p class="text-muted mx-auto" style="font-size: 0.95rem; max-width: 400px;">
                            Data tenaga kependidikan belum dimasukkan oleh administrator.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection