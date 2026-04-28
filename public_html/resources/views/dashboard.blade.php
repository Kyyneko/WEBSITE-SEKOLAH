<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Welcome Banner --}}
            <div class="dash-welcome-banner mb-4">
                <div class="dash-welcome-content">
                    <div class="dash-welcome-text">
                        <p class="dash-welcome-greeting">Selamat Datang 👋</p>
                        <h2 class="dash-welcome-name">{{ auth()->user()->name }}</h2>
                        <p class="dash-welcome-role">
                            <i class="fas {{ auth()->user()->role === 'admin' ? 'fa-shield-alt' : 'fa-chalkboard-teacher' }} me-1"></i>
                            {{ ucfirst(auth()->user()->role === 'admin' ? 'Administrator' : 'Guru') }}
                            &middot; UPT SPF SMPN 14 BULUKUMBA
                        </p>
                    </div>
                    <div class="dash-welcome-avatar">
                        @php
                            $photoPath = auth()->user()->photo_path;
                            $photoUrl = null;
                            if ($photoPath) {
                                if (str_starts_with($photoPath, 'public/photos/')) {
                                    $photoUrl = asset('storage/' . str_replace('public/', '', $photoPath));
                                } elseif (str_starts_with($photoPath, 'public/image/')) {
                                    $photoUrl = asset(str_replace('public/', '', $photoPath));
                                } elseif (str_starts_with($photoPath, 'photos/')) {
                                    $photoUrl = asset('storage/' . $photoPath);
                                } elseif (str_starts_with($photoPath, 'image/')) {
                                    $photoUrl = asset($photoPath);
                                } else {
                                    $photoUrl = asset('storage/' . $photoPath);
                                }
                            }
                        @endphp

                        @if ($photoUrl)
                            <img src="{{ $photoUrl }}" alt="User Photo" class="dash-avatar-img"
                                 onerror="this.style.display='none'; document.getElementById('fallback-{{ auth()->user()->id }}').style.display='flex';">
                            <div id="fallback-{{ auth()->user()->id }}" class="dash-avatar-fallback" style="display:none;">
                                <i class="fas fa-user"></i>
                            </div>
                        @else
                            <div class="dash-avatar-fallback">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="dash-welcome-deco1"></div>
                <div class="dash-welcome-deco2"></div>
            </div>

            {{-- Stats Row --}}
            @if(auth()->user()->role === 'admin')
            <div class="row g-3 mb-4">
                @php
                    $stats = [
                        ['icon' => 'fas fa-users', 'label' => 'Total User', 'value' => \App\Models\User::count(), 'color' => '#2563eb', 'bg' => 'rgba(37,99,235,0.08)'],
                        ['icon' => 'fas fa-newspaper', 'label' => 'Artikel', 'value' => \App\Models\Article::count(), 'color' => '#0d9488', 'bg' => 'rgba(13,148,136,0.08)'],
                        ['icon' => 'fas fa-sitemap', 'label' => 'Organisasi', 'value' => \App\Models\Organisasi::count(), 'color' => '#7c3aed', 'bg' => 'rgba(124,58,237,0.08)'],
                        ['icon' => 'fas fa-book', 'label' => 'Mata Pelajaran', 'value' => \App\Models\Subject::count(), 'color' => '#d97706', 'bg' => 'rgba(245,158,11,0.08)'],
                    ];
                @endphp
                @foreach($stats as $stat)
                <div class="col-6 col-lg-3">
                    <div class="dash-stat-card">
                        <div class="dash-stat-icon" style="background: {{ $stat['bg'] }}; color: {{ $stat['color'] }};">
                            <i class="{{ $stat['icon'] }}"></i>
                        </div>
                        <div class="dash-stat-info">
                            <div class="dash-stat-value">{{ $stat['value'] }}</div>
                            <div class="dash-stat-label">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- Main Content --}}
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4">
                            <h5 class="dash-section-title">
                                <i class="fas fa-user-circle me-2"></i>Informasi Profil
                            </h5>
                            
                            <div class="row g-3 mt-1">
                                @php
                                    $fields = [
                                        ['icon' => 'fas fa-id-card', 'label' => 'NIK', 'value' => auth()->user()->nik, 'color' => '#2563eb', 'bg' => 'rgba(37,99,235,0.07)'],
                                        ['icon' => 'fas fa-id-badge', 'label' => 'NIP', 'value' => auth()->user()->nip, 'color' => '#0d9488', 'bg' => 'rgba(13,148,136,0.07)'],
                                        ['icon' => 'fas fa-calendar-alt', 'label' => 'Tempat, Tanggal Lahir', 'value' => auth()->user()->ttl, 'color' => '#d97706', 'bg' => 'rgba(245,158,11,0.07)'],
                                        ['icon' => 'fas fa-phone-alt', 'label' => 'No. Telepon', 'value' => auth()->user()->phone, 'color' => '#059669', 'bg' => 'rgba(16,185,129,0.07)'],
                                    ];
                                @endphp

                                @foreach($fields as $field)
                                <div class="col-sm-6">
                                    <div class="dash-info-card">
                                        <div class="dash-info-icon" style="background: {{ $field['bg'] }}; color: {{ $field['color'] }};">
                                            <i class="{{ $field['icon'] }}"></i>
                                        </div>
                                        <div>
                                            <div class="dash-info-label">{{ $field['label'] }}</div>
                                            @if($field['value'])
                                                <div class="dash-info-value">{{ $field['value'] }}</div>
                                            @else
                                                <div class="dash-info-empty">Belum diisi</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                                <div class="col-12">
                                    <div class="dash-info-card">
                                        <div class="dash-info-icon" style="background: rgba(99,102,241,0.07); color: #6366f1;">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div>
                                            <div class="dash-info-label">Email</div>
                                            <div class="dash-info-value">{{ auth()->user()->email }}</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="dash-info-card">
                                        <div class="dash-info-icon" style="background: rgba(236,72,153,0.07); color: #db2777;">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <div>
                                            <div class="dash-info-label">Mata Pelajaran</div>
                                            @if (auth()->user()->subject_id)
                                                <div class="dash-info-value">{{ \App\Models\Subject::find(auth()->user()->subject_id)->name ?? 'Tidak ditemukan' }}</div>
                                            @else
                                                <div class="dash-info-empty">Belum diisi</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    {{-- Quick Actions --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-4">
                            <h5 class="dash-section-title">
                                <i class="fas fa-bolt me-2"></i>Aksi Cepat
                            </h5>
                            <div class="d-grid gap-2 mt-3">
                                <a href="{{ route('profile.edit') }}" class="dash-action-btn">
                                    <div class="dash-action-icon" style="background: rgba(37,99,235,0.08); color: #2563eb;">
                                        <i class="fas fa-user-edit"></i>
                                    </div>
                                    <div>
                                        <div class="dash-action-title">Edit Profil</div>
                                        <div class="dash-action-desc">Kelola informasi akun</div>
                                    </div>
                                    <i class="fas fa-chevron-right dash-action-arrow"></i>
                                </a>
                                <a href="{{ route('articles.index') }}" class="dash-action-btn">
                                    <div class="dash-action-icon" style="background: rgba(13,148,136,0.08); color: #0d9488;">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                    <div>
                                        <div class="dash-action-title">Kelola Artikel</div>
                                        <div class="dash-action-desc">Tambah & edit berita</div>
                                    </div>
                                    <i class="fas fa-chevron-right dash-action-arrow"></i>
                                </a>
                                <a href="{{ route('perangkat') }}" class="dash-action-btn">
                                    <div class="dash-action-icon" style="background: rgba(245,158,11,0.08); color: #d97706;">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div>
                                        <div class="dash-action-title">Perangkat</div>
                                        <div class="dash-action-desc">Dokumen pembelajaran</div>
                                    </div>
                                    <i class="fas fa-chevron-right dash-action-arrow"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Info Card --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4">
                            <div class="dash-tip">
                                <div class="dash-tip-icon">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <div>
                                    <div class="dash-tip-title">Tips</div>
                                    <p class="dash-tip-text">
                                        Klik nama Anda di pojok kanan atas, lalu pilih <strong>Profile</strong> untuk mengubah data profil.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        /* ===== WELCOME BANNER ===== */
        .dash-welcome-banner {
            background: linear-gradient(135deg, var(--dash-primary, #1e3a5f) 0%, var(--dash-primary-light, #2563eb) 100%);
            border-radius: 16px;
            padding: 2rem 2.25rem;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .dash-welcome-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 1;
        }

        .dash-welcome-greeting {
            font-size: 0.85rem;
            opacity: 0.75;
            margin-bottom: 0.15rem;
            font-weight: 500;
        }

        .dash-welcome-name {
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
            letter-spacing: -0.02em;
        }

        .dash-welcome-role {
            font-size: 0.82rem;
            opacity: 0.65;
            margin: 0;
            font-weight: 500;
        }

        .dash-welcome-deco1 {
            position: absolute;
            top: -50px;
            right: -20px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }

        .dash-welcome-deco2 {
            position: absolute;
            bottom: -70px;
            right: 130px;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }

        .dash-avatar-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255,255,255,0.25);
        }

        .dash-avatar-fallback {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: rgba(255,255,255,0.6);
            border: 3px solid rgba(255,255,255,0.15);
        }

        /* ===== STAT CARDS ===== */
        .dash-stat-card {
            background: #fff;
            border: 1px solid var(--dash-border, #e2e8f0);
            border-radius: 12px;
            padding: 1.15rem;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            transition: all 0.2s ease;
        }

        .dash-stat-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            transform: translateY(-2px);
        }

        .dash-stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .dash-stat-value {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--dash-text, #1e293b);
            line-height: 1.2;
        }

        .dash-stat-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--dash-text-light, #64748b);
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        /* ===== SECTION TITLE ===== */
        .dash-section-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--dash-text, #1e293b);
            margin-bottom: 0;
            padding-bottom: 0.65rem;
            border-bottom: 2px solid var(--dash-border, #e2e8f0);
        }

        /* ===== INFO CARDS ===== */
        .dash-info-card {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem;
            border-radius: 10px;
            border: 1px solid var(--dash-border, #e2e8f0);
            transition: all 0.2s ease;
        }

        .dash-info-card:hover {
            border-color: transparent;
            box-shadow: 0 3px 10px rgba(0,0,0,0.06);
        }

        .dash-info-icon {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .dash-info-label {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--dash-text-light, #64748b);
            margin-bottom: 0.1rem;
        }

        .dash-info-value {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--dash-text, #1e293b);
        }

        .dash-info-empty {
            font-size: 0.85rem;
            font-weight: 500;
            color: #cbd5e1;
            font-style: italic;
        }

        /* ===== ACTION BUTTONS ===== */
        .dash-action-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem;
            border-radius: 10px;
            border: 1px solid var(--dash-border, #e2e8f0);
            text-decoration: none;
            transition: all 0.2s ease;
            color: inherit;
        }

        .dash-action-btn:hover {
            border-color: transparent;
            box-shadow: 0 3px 10px rgba(0,0,0,0.06);
            color: inherit;
            transform: translateX(2px);
        }

        .dash-action-icon {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .dash-action-title {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--dash-text, #1e293b);
        }

        .dash-action-desc {
            font-size: 0.7rem;
            color: var(--dash-text-light, #64748b);
        }

        .dash-action-arrow {
            margin-left: auto;
            font-size: 0.65rem;
            color: #cbd5e1;
            transition: all 0.2s ease;
        }

        .dash-action-btn:hover .dash-action-arrow {
            color: var(--dash-primary-light, #2563eb);
            transform: translateX(3px);
        }

        /* ===== TIP BOX ===== */
        .dash-tip {
            display: flex;
            gap: 0.75rem;
            align-items: flex-start;
        }

        .dash-tip-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: rgba(245,158,11,0.08);
            color: #d97706;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .dash-tip-title {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--dash-text, #1e293b);
            margin-bottom: 0.2rem;
        }

        .dash-tip-text {
            font-size: 0.78rem;
            color: var(--dash-text-light, #64748b);
            margin: 0;
            line-height: 1.5;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .dash-welcome-banner { padding: 1.5rem; }
            .dash-welcome-name { font-size: 1.25rem; }
            .dash-welcome-avatar { display: none; }
            .dash-stat-card { padding: 0.85rem; }
            .dash-stat-value { font-size: 1.1rem; }
        }
    </style>
    @endpush
</x-app-layout>