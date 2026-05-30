{{-- Sidebar Navigation --}}
<aside class="dash-sidebar" id="dashSidebar">

    {{-- Sidebar Header --}}
    <div class="dash-sidebar-header">
        <img src="{{ asset('image/Logo.png') }}" alt="Logo">
        <div class="dash-sidebar-brand">
            <div class="dash-sidebar-brand-name">UPT SPF SMPN 14 BULUKUMBA</div>
            <div class="dash-sidebar-brand-sub">Bulukumba</div>
        </div>
    </div>

    {{-- Navigation Links --}}
    <nav class="dash-sidebar-nav">
        <div class="dash-sidebar-label">Menu Utama</div>

        <a href="{{ route('dashboard') }}"
           class="dash-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('perangkat') }}"
           class="dash-nav-item {{ request()->routeIs('perangkat') ? 'active' : '' }}">
            <i class="fas fa-file-alt"></i>
            <span>Perangkat Pembelajaran</span>
        </a>

        <a href="{{ route('articles.index') }}"
           class="dash-nav-item {{ request()->routeIs('articles.*') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i>
            <span>Artikel & Berita</span>
        </a>

        @if (auth()->user()->role === 'admin')
            <div class="dash-sidebar-label">Kelola Warga & Akademik</div>

            <a href="{{ route('users.index') }}"
               class="dash-nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Warga Sekolah (Guru/Staf)</span>
            </a>

            <a href="{{ route('subjects.index') }}"
               class="dash-nav-item {{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                <i class="fas fa-book"></i>
                <span>Mata Pelajaran</span>
            </a>

            <div class="dash-sidebar-label">Konten Informasi Sekolah</div>

            <a href="{{ route('facilities.index') }}"
               class="dash-nav-item {{ request()->routeIs('facilities.*') ? 'active' : '' }}">
                <i class="fas fa-building"></i>
                <span>Fasilitas Sekolah</span>
            </a>

            <a href="{{ route('achievements.index') }}"
               class="dash-nav-item {{ request()->routeIs('achievements.*') ? 'active' : '' }}">
                <i class="fas fa-trophy"></i>
                <span>Prestasi Sekolah</span>
            </a>

            <a href="{{ route('organisasi.index') }}"
               class="dash-nav-item {{ request()->routeIs('organisasi.*') ? 'active' : '' }}">
                <i class="fas fa-sitemap"></i>
                <span>Organisasi & Ekskul</span>
            </a>

            <a href="{{ route('gallery.index') }}"
               class="dash-nav-item {{ request()->routeIs('gallery.*') ? 'active' : '' }}">
                <i class="fas fa-images"></i>
                <span>Galeri Foto</span>
            </a>

            <a href="{{ route('ads.index') }}"
               class="dash-nav-item {{ request()->routeIs('ads.*') ? 'active' : '' }}">
                <i class="fas fa-bullhorn"></i>
                <span>Pengumuman</span>
            </a>

            <a href="{{ route('former-principals.index') }}"
               class="dash-nav-item {{ request()->routeIs('former-principals.*') ? 'active' : '' }}">
                <i class="fas fa-history"></i>
                <span>Mantan Kepala Sekolah</span>
            </a>

            <div class="dash-sidebar-label">Sistem & Konfigurasi</div>

            <a href="{{ route('settings.edit') }}"
               class="dash-nav-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <i class="fas fa-school"></i>
                <span>Pengaturan Sekolah</span>
            </a>
        @endif

        <div class="dash-sidebar-label">Akun</div>

        <a href="{{ route('profile.edit') }}"
           class="dash-nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <i class="fas fa-user-cog"></i>
            <span>Edit Profil</span>
        </a>
    </nav>

    {{-- Sidebar Footer --}}
    <div class="dash-sidebar-footer">
        <div class="dash-sidebar-user">
            <div class="dash-sidebar-user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <div class="dash-sidebar-user-name">{{ Auth::user()->name }}</div>
                <div class="dash-sidebar-user-role">
                    {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Guru' }}
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dash-sidebar-logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Log Out</span>
            </button>
        </form>
    </div>
</aside>
