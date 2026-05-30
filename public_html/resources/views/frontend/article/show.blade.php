@extends('frontend.main')

@section('style')
    <style>
        .article-detail-container {
            margin-top: 80px;
            padding: 4rem 0;
            background-color: #f8fafc;
        }

        .article-content-wrapper {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .article-hero-image {
            width: 100%;
            height: 450px;
            overflow: hidden;
            background: #e2e8f0;
            position: relative;
        }

        .article-hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-content {
            padding: 3rem;
        }

        .article-header {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .article-detail-title {
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: #1a202c;
            line-height: 1.3;
            margin-bottom: 1.25rem;
            font-family: 'Cambria', Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        .article-detail-meta {
            display: flex;
            gap: 2rem;
            font-size: 0.95rem;
            color: #718096;
        }

        .article-detail-meta p {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .article-detail-meta strong {
            color: #2d3748;
        }

        .article-body {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #2d3748;
        }

        .article-body p {
            margin-bottom: 1.5rem;
        }

        .article-body h2,
        .article-body h3 {
            margin-top: 2.5rem;
            margin-bottom: 1.25rem;
            color: #1a202c;
            font-weight: 700;
        }

        .article-gallery-section {
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 2px solid #e2e8f0;
        }

        .gallery-title {
            font-size: 1.75rem;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            color: #1a202c;
            margin-bottom: 2.5rem;
            letter-spacing: 0.05em;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .gallery-item {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
        }

        .gallery-item::after {
            content: '\f00e'; /* search-plus zoom icon */
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            inset: 0;
            background: rgba(30, 58, 95, 0.4);
            backdrop-filter: blur(2px);
            color: #ffffff;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 12px 24px rgba(30, 58, 95, 0.15);
        }

        .gallery-item:hover::after {
            opacity: 1;
        }

        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ============================
           LIGHTBOX SLIDER STYLE
        ============================ */
        .lightbox-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .lightbox-overlay.show {
            display: flex;
            opacity: 1;
        }

        .lightbox-content {
            position: relative;
            max-width: 85%;
            max-height: 80vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .lightbox-content img {
            max-width: 100%;
            max-height: 80vh;
            object-fit: contain;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            transform: scale(0.95);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .lightbox-overlay.show .lightbox-content img {
            transform: scale(1);
        }

        .lightbox-btn {
            position: absolute;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
            font-size: 2rem;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            user-select: none;
            z-index: 10000;
        }

        .lightbox-btn:hover {
            background: rgba(37, 99, 235, 0.85);
            border-color: rgba(37, 99, 235, 1);
            box-shadow: 0 0 15px rgba(37, 99, 235, 0.4);
            transform: scale(1.08);
        }

        .lightbox-close {
            top: 30px;
            right: 30px;
            font-size: 1.5rem;
        }

        .lightbox-prev {
            left: 40px;
            top: 50%;
            transform: translateY(-50%);
        }

        .lightbox-next {
            right: 40px;
            top: 50%;
            transform: translateY(-50%);
        }

        .lightbox-counter {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            font-weight: 600;
            margin-top: 1rem;
            background: rgba(15, 23, 42, 0.6);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Responsive Lightbox buttons */
        @media (max-width: 768px) {
            .lightbox-btn {
                width: 45px;
                height: 45px;
                font-size: 1.5rem;
            }
            .lightbox-prev {
                left: 15px;
            }
            .lightbox-next {
                right: 15px;
            }
            .lightbox-close {
                top: 20px;
                right: 20px;
            }
        }

        @media (max-width: 768px) {
            .article-content {
                padding: 2rem 1.5rem;
            }

            .article-hero-image {
                height: 300px;
            }

            .article-detail-meta {
                flex-direction: column;
                gap: 0.75rem;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1rem;
            }

            .gallery-item img {
                height: 200px;
            }
        }

        @media (max-width: 576px) {
            .gallery-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="article-detail-container">
        <div class="container">
            <div class="article-content-wrapper">
                {{-- Hero Image --}}
                <div class="article-hero-image">
                    @php $photos = $article->photo_path ? (is_array($article->photo_path) ? $article->photo_path : json_decode($article->photo_path, true)) : []; @endphp
                    @if(count($photos) > 0)
                        <img src="{{ asset('storage/' . str_replace('public/', '', $photos[0])) }}" alt="{{ $article->title }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center w-100 h-100" style="background: linear-gradient(135deg,#1e3a5f,#2563eb);">
                            <i class="fas fa-newspaper text-white-50" style="font-size: 5rem;"></i>
                        </div>
                    @endif
                </div>

                {{-- Article Content --}}
                <div class="article-content">
                    {{-- Header --}}
                    <div class="article-header">
                        <div class="d-flex align-items-center mb-3">
                            @if($article->organisasi)
                                <span class="badge" style="background: rgba(37, 99, 235, 0.12); color: #3b82f6; font-size: 0.75rem; font-weight: 700; padding: 0.3rem 0.75rem; border-radius: 6px; text-transform: uppercase; border: 1px solid rgba(37, 99, 235, 0.2); display: inline-flex; align-items: center; gap: 0.35rem;">
                                    <i class="fas fa-users"></i> {{ $article->organisasi->nama }}
                                </span>
                            @else
                                <span class="badge" style="background: rgba(100, 116, 139, 0.1); color: #64748b; font-size: 0.75rem; font-weight: 700; padding: 0.3rem 0.75rem; border-radius: 6px; text-transform: uppercase; border: 1px solid rgba(100, 116, 139, 0.15); display: inline-flex; align-items: center; gap: 0.35rem;">
                                    <i class="fas fa-globe"></i> Umum
                                </span>
                            @endif
                        </div>
                        
                        <h1 class="article-detail-title">{{ $article->title }}</h1>
                        
                        <div class="article-detail-meta">
                            <p><i class="fas fa-user text-primary"></i> Penulis: <strong>{{ $article->user->name ?? 'Admin' }}</strong></p>
                            <p><i class="fas fa-calendar-alt text-primary"></i> Diterbitkan: <strong>{{ $article->created_at->translatedFormat('l, d F Y') }}</strong></p>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="article-body">
                        {!! $article->description !!}
                    </div>

                    {{-- Gallery Section --}}
                    @if(count($photos) > 0)
                        <div class="article-gallery-section">
                            <h2 class="gallery-title">Galeri Foto</h2>
                            <div class="gallery-grid">
                                @foreach($photos as $index => $photo)
                                    <div class="gallery-item" onclick="openLightbox({{ $index }})">
                                        <img src="{{ asset('storage/' . str_replace('public/', '', $photo)) }}" alt="Galeri {{ $index + 1 }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Interactive Lightbox Modal --}}
    <div id="custom-lightbox" class="lightbox-overlay">
        <button class="lightbox-btn lightbox-close" onclick="closeLightbox()" aria-label="Tutup">&times;</button>
        <button class="lightbox-btn lightbox-prev" onclick="changeLightboxImage(-1)" aria-label="Sebelumnya">&lsaquo;</button>
        <div class="lightbox-content">
            <img id="lightbox-img" src="" alt="Lightbox Preview" style="transition: opacity 0.15s ease;">
            <div id="lightbox-counter" class="lightbox-counter"></div>
        </div>
        <button class="lightbox-btn lightbox-next" onclick="changeLightboxImage(1)" aria-label="Berikutnya">&rsaquo;</button>
    </div>

    <script>
        // Array of photo URLs
        const galleryImages = [
            @foreach($photos as $photo)
                "{{ asset('storage/' . str_replace('public/', '', $photo)) }}",
            @endforeach
        ];
        
        let currentImageIndex = 0;
        const lightbox = document.getElementById('custom-lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const lightboxCounter = document.getElementById('lightbox-counter');
        
        function openLightbox(index) {
            currentImageIndex = index;
            updateLightboxContent();
            lightbox.classList.add('show');
            document.body.style.overflow = 'hidden'; // Prevent page scroll
        }
        
        function closeLightbox() {
            lightbox.classList.remove('show');
            document.body.style.overflow = ''; // Restore page scroll
        }
        
        function updateLightboxContent() {
            lightboxImg.style.opacity = '0';
            setTimeout(() => {
                lightboxImg.src = galleryImages[currentImageIndex];
                lightboxCounter.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
                lightboxImg.style.opacity = '1';
            }, 150);
        }
        
        function changeLightboxImage(direction) {
            currentImageIndex += direction;
            if (currentImageIndex >= galleryImages.length) {
                currentImageIndex = 0; // Wrap around to start
            } else if (currentImageIndex < 0) {
                currentImageIndex = galleryImages.length - 1; // Wrap around to end
            }
            updateLightboxContent();
        }
        
        // Close on background click
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox) {
                closeLightbox();
            }
        });
        
        // Keyboard Support
        document.addEventListener('keydown', function(e) {
            if (!lightbox.classList.contains('show')) return;
            
            if (e.key === 'Escape' || e.key === 'Esc') {
                closeLightbox();
            } else if (e.key === 'ArrowRight') {
                changeLightboxImage(1);
            } else if (e.key === 'ArrowLeft') {
                changeLightboxImage(-1);
            }
        });
    </script>
@endsection