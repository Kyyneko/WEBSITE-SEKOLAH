@extends('frontend.main')

@section('style')
<style>
    /* ============================
       GALLERY HERO SECTION
    ============================ */
    .gallery-hero {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 60%, var(--color-accent) 100%);
        padding: 7rem 0 4rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .gallery-hero::before {
        content: '';
        position: absolute;
        top: -80px;
        right: -60px;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }
    .gallery-hero::after {
        content: '';
        position: absolute;
        bottom: -100px;
        left: -40px;
        width: 250px;
        height: 250px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
    }
    .gallery-hero-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }
    .gallery-hero-sub {
        font-size: 1rem;
        color: rgba(255,255,255,0.75);
        position: relative;
        z-index: 1;
        max-width: 500px;
        margin: 0 auto;
    }
    .gallery-hero-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: rgba(255,255,255,0.12);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        color: #fff;
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }
    .gallery-hero-count {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 1.2rem;
        border-radius: 20px;
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(8px);
        color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        margin-top: 1rem;
        position: relative;
        z-index: 1;
    }

    /* ============================
       FILTER SECTION
    ============================ */
    .gallery-filter-section {
        padding: 2rem 0 1rem;
        background: var(--color-bg);
        position: sticky;
        top: 70px;
        z-index: 100;
        border-bottom: 1px solid var(--color-border);
    }
    .gallery-filter-wrap {
        display: flex;
        gap: 0.6rem;
        justify-content: center;
        flex-wrap: wrap;
    }
    .gallery-filter-pill {
        padding: 0.5rem 1.25rem;
        border-radius: 25px;
        border: 1.5px solid var(--color-border);
        background: #fff;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--color-text-light);
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .gallery-filter-pill:hover {
        border-color: var(--color-primary-light);
        color: var(--color-primary-light);
        transform: translateY(-1px);
    }
    .gallery-filter-pill.active {
        background: var(--gradient-primary);
        color: #fff;
        border-color: transparent;
        box-shadow: var(--shadow-md);
    }

    /* ============================
       GALLERY MASONRY GRID
    ============================ */
    .gallery-main {
        padding: 2.5rem 0 4rem;
        background: var(--color-bg);
        min-height: 50vh;
    }
    .gallery-masonry {
        columns: 4;
        column-gap: 1.25rem;
    }
    .gallery-masonry-item {
        break-inside: avoid;
        margin-bottom: 1.25rem;
        border-radius: var(--radius-md);
        overflow: hidden;
        position: relative;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .gallery-masonry-item:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }
    .gallery-masonry-item img {
        width: 100%;
        display: block;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .gallery-masonry-item:hover img {
        transform: scale(1.05);
    }
    .gallery-masonry-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 40%, rgba(0,0,0,0.7) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 1rem;
    }
    .gallery-masonry-item:hover .gallery-masonry-overlay {
        opacity: 1;
    }
    .gallery-masonry-overlay-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 0.2rem;
    }
    .gallery-masonry-overlay-cat {
        font-size: 0.7rem;
        color: rgba(255,255,255,0.7);
        font-weight: 500;
    }
    .gallery-masonry-zoom {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.7);
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(8px);
        border: none;
        color: #fff;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
        pointer-events: none;
    }
    .gallery-masonry-item:hover .gallery-masonry-zoom {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }

    .gallery-masonry-item.filtered-out {
        opacity: 0;
        transform: scale(0.8);
        position: absolute;
        pointer-events: none;
        width: 0;
        height: 0;
        margin: 0;
        overflow: hidden;
    }

    /* Empty State */
    .gallery-empty {
        text-align: center;
        padding: 4rem 1rem;
    }
    .gallery-empty-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg, rgba(37,99,235,0.08), rgba(13,148,136,0.08));
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--color-primary-light);
        margin-bottom: 1rem;
    }
    .gallery-empty h4 {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 0.35rem;
    }
    .gallery-empty p {
        color: var(--color-text-light);
        font-size: 0.9rem;
    }

    /* ============================
       LIGHTBOX
    ============================ */
    .lightbox-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.92);
        backdrop-filter: blur(16px);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    .lightbox-overlay.active {
        display: flex;
    }
    .lightbox-content {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .lightbox-img {
        max-width: 88vw;
        max-height: 82vh;
        border-radius: 12px;
        object-fit: contain;
        box-shadow: 0 30px 80px rgba(0,0,0,0.5);
        transition: opacity 0.3s ease;
        user-select: none;
    }
    .lightbox-close {
        position: fixed;
        top: 1.5rem;
        right: 1.5rem;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: none;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(8px);
        color: #fff;
        font-size: 1.3rem;
        cursor: pointer;
        z-index: 10;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .lightbox-close:hover {
        background: rgba(239,68,68,0.5);
        transform: scale(1.1);
    }
    .lightbox-nav {
        position: fixed;
        top: 50%;
        transform: translateY(-50%);
        width: 52px;
        height: 52px;
        border-radius: 50%;
        border: none;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(8px);
        color: #fff;
        font-size: 1.3rem;
        cursor: pointer;
        z-index: 10;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .lightbox-nav:hover {
        background: rgba(255,255,255,0.25);
        transform: translateY(-50%) scale(1.08);
    }
    .lightbox-prev { left: 1.5rem; }
    .lightbox-next { right: 1.5rem; }
    .lightbox-info {
        position: fixed;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        z-index: 10;
    }
    .lightbox-info-title {
        color: #fff;
        font-size: 0.9rem;
        font-weight: 700;
        margin-bottom: 0.3rem;
    }
    .lightbox-info-counter {
        color: rgba(255,255,255,0.5);
        font-size: 0.75rem;
        font-weight: 500;
    }

    /* ============================
       RESPONSIVE
    ============================ */
    @media (max-width: 992px) {
        .gallery-masonry { columns: 3; }
        .gallery-hero-title { font-size: 2rem; }
    }
    @media (max-width: 768px) {
        .gallery-masonry { columns: 2; column-gap: 0.75rem; }
        .gallery-masonry-item { margin-bottom: 0.75rem; }
        .gallery-hero { padding: 6rem 0 3rem; }
        .gallery-hero-title { font-size: 1.6rem; }
        .lightbox-nav { width: 42px; height: 42px; font-size: 1rem; }
        .lightbox-prev { left: 0.75rem; }
        .lightbox-next { right: 0.75rem; }
    }
    @media (max-width: 480px) {
        .gallery-masonry { columns: 2; column-gap: 0.5rem; }
        .gallery-masonry-item { margin-bottom: 0.5rem; border-radius: var(--radius-sm); }
    }
</style>
@endsection

@section('content')

{{-- Hero Section --}}
<section class="gallery-hero">
    <div class="container">
        <div class="gallery-hero-icon" data-aos="fade-down">
            <i class="fas fa-camera-retro"></i>
        </div>
        <h1 class="gallery-hero-title" data-aos="fade-up">Galeri Foto</h1>
        <p class="gallery-hero-sub" data-aos="fade-up" data-aos-delay="100">
            Jelajahi momen-momen berharga dan kegiatan UPT SPF SMPN 14 Bulukumba
        </p>
        <div class="gallery-hero-count" data-aos="fade-up" data-aos-delay="200">
            <i class="fas fa-images"></i> {{ $galleries->count() }} Koleksi Foto
        </div>
    </div>
</section>

{{-- Filter Section --}}
@if($categories->count() > 0)
<section class="gallery-filter-section">
    <div class="container">
        <div class="gallery-filter-wrap">
            <button class="gallery-filter-pill active" data-filter="all">
                <i class="fas fa-th me-1"></i> Semua
            </button>
            @foreach($categories as $cat)
                <button class="gallery-filter-pill" data-filter="{{ Str::slug($cat) }}">{{ $cat }}</button>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Gallery Grid --}}
<section class="gallery-main">
    <div class="container">
        @if($galleries->count() > 0)
            <div class="gallery-masonry" id="galleryMasonry">
                @foreach($galleries as $index => $photo)
                    @php
                        $photoPath = $photo->photo_path;
                        if (str_starts_with($photoPath, 'public/gallery_photos/')) {
                            $imageUrl = asset('storage/' . str_replace('public/', '', $photoPath));
                        } elseif (str_starts_with($photoPath, 'gallery_photos/')) {
                            $imageUrl = asset('storage/' . $photoPath);
                        } else {
                            $imageUrl = asset('storage/' . str_replace('public/', '', $photoPath));
                        }
                    @endphp
                    <div class="gallery-masonry-item" 
                         data-category="{{ Str::slug($photo->category) }}"
                         data-index="{{ $index }}"
                         data-src="{{ $imageUrl }}"
                         data-title="{{ $photo->title }}"
                         onclick="openLightbox({{ $index }})"
                         data-aos="fade-up"
                         data-aos-delay="{{ ($index % 4) * 80 }}">
                        <img src="{{ $imageUrl }}" alt="{{ $photo->title }}" loading="lazy">
                        <div class="gallery-masonry-zoom">
                            <i class="fas fa-search-plus"></i>
                        </div>
                        <div class="gallery-masonry-overlay">
                            <div class="gallery-masonry-overlay-title">{{ Str::limit($photo->title, 35) }}</div>
                            <div class="gallery-masonry-overlay-cat">
                                <i class="fas fa-tag me-1"></i>{{ $photo->category }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="gallery-empty" data-aos="fade-up">
                <div class="gallery-empty-icon">
                    <i class="fas fa-images"></i>
                </div>
                <h4>Belum Ada Foto</h4>
                <p>Galeri foto masih kosong. Nantikan koleksi foto dari berbagai kegiatan sekolah!</p>
            </div>
        @endif
    </div>
</section>

{{-- Lightbox --}}
<div class="lightbox-overlay" id="lightboxOverlay">
    <button class="lightbox-close" onclick="closeLightbox()" aria-label="Tutup"><i class="fas fa-times"></i></button>
    <button class="lightbox-nav lightbox-prev" onclick="prevLightbox()" aria-label="Sebelumnya"><i class="fas fa-chevron-left"></i></button>
    <button class="lightbox-nav lightbox-next" onclick="nextLightbox()" aria-label="Selanjutnya"><i class="fas fa-chevron-right"></i></button>
    <div class="lightbox-content">
        <img id="lightboxImg" class="lightbox-img" src="" alt="">
    </div>
    <div class="lightbox-info">
        <div class="lightbox-info-title" id="lightboxTitle"></div>
        <div class="lightbox-info-counter" id="lightboxCounter"></div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // ============================
    // Category Filter
    // ============================
    document.querySelectorAll('.gallery-filter-pill').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.gallery-filter-pill').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const filter = this.dataset.filter;
            document.querySelectorAll('.gallery-masonry-item').forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.classList.remove('filtered-out');
                } else {
                    item.classList.add('filtered-out');
                }
            });
            // Rebuild lightbox items array
            buildLightboxItems();
        });
    });

    // ============================
    // Lightbox
    // ============================
    let lightboxItems = [];
    let currentLightboxIndex = 0;

    function buildLightboxItems() {
        lightboxItems = [];
        document.querySelectorAll('.gallery-masonry-item:not(.filtered-out)').forEach((item, i) => {
            lightboxItems.push({
                src: item.dataset.src,
                title: item.dataset.title,
                originalIndex: parseInt(item.dataset.index)
            });
        });
    }

    // Initialize on page load
    buildLightboxItems();

    function openLightbox(originalIndex) {
        // Find the item in current filtered list
        const idx = lightboxItems.findIndex(item => item.originalIndex === originalIndex);
        if (idx === -1) return;
        currentLightboxIndex = idx;
        showLightboxImage();
        document.getElementById('lightboxOverlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightboxOverlay').classList.remove('active');
        document.body.style.overflow = '';
    }

    function showLightboxImage() {
        if (lightboxItems.length === 0) return;
        const item = lightboxItems[currentLightboxIndex];
        const img = document.getElementById('lightboxImg');
        img.style.opacity = '0';
        setTimeout(() => {
            img.src = item.src;
            img.alt = item.title;
            img.onload = () => { img.style.opacity = '1'; };
        }, 150);
        document.getElementById('lightboxTitle').textContent = item.title;
        document.getElementById('lightboxCounter').textContent = (currentLightboxIndex + 1) + ' / ' + lightboxItems.length;
    }

    function nextLightbox() {
        currentLightboxIndex = (currentLightboxIndex + 1) % lightboxItems.length;
        showLightboxImage();
    }

    function prevLightbox() {
        currentLightboxIndex = (currentLightboxIndex - 1 + lightboxItems.length) % lightboxItems.length;
        showLightboxImage();
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const overlay = document.getElementById('lightboxOverlay');
        if (!overlay.classList.contains('active')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') nextLightbox();
        if (e.key === 'ArrowLeft') prevLightbox();
    });

    // Click overlay to close
    document.getElementById('lightboxOverlay').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });
</script>
@endpush
