<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">{{ __('Galeri Foto') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

            {{-- Header Card --}}
            <div class="dash-header-card mb-4">
                <div class="dash-header-card-content">
                    <div class="dash-header-card-icon"><i class="fas fa-images"></i></div>
                    <div>
                        <h3 class="dash-header-card-title">Manajemen Galeri Foto</h3>
                        <p class="dash-header-card-desc">Kelola, unggah, dan backup seluruh koleksi foto sekolah</p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            {{-- Stats & Actions Bar --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-4">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div class="d-flex gap-3 flex-wrap">
                            <div class="mgmt-stat">
                                <div class="mgmt-stat-icon" style="background:rgba(37,99,235,0.08);color:#2563eb;"><i class="fas fa-images"></i></div>
                                <div><div class="mgmt-stat-val">{{ $galleries->count() }}</div><div class="mgmt-stat-lbl">Total Foto</div></div>
                            </div>
                            <div class="mgmt-stat">
                                <div class="mgmt-stat-icon" style="background:rgba(16,185,129,0.08);color:#059669;"><i class="fas fa-tags"></i></div>
                                <div><div class="mgmt-stat-val">{{ $categories->count() }}</div><div class="mgmt-stat-lbl">Kategori</div></div>
                            </div>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                <i class="fas fa-cloud-upload-alt me-1"></i> Unggah Foto
                            </button>
                            @if($galleries->count() > 0)
                                <a href="{{ route('gallery.backup') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-download me-1"></i> Backup ZIP
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Category Filter Tabs --}}
            @if($categories->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-3">
                    <div class="gallery-filter-tabs">
                        <button class="gallery-filter-btn active" data-filter="all">
                            <i class="fas fa-th me-1"></i> Semua
                        </button>
                        @foreach($categories as $cat)
                            <button class="gallery-filter-btn" data-filter="{{ Str::slug($cat) }}">{{ $cat }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            {{-- Gallery Grid --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    @if($galleries->count() > 0)
                        <div class="gallery-grid" id="galleryGrid">
                            @foreach($galleries as $photo)
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
                                <div class="gallery-item" data-category="{{ Str::slug($photo->category) }}">
                                    <div class="gallery-card">
                                        <div class="gallery-card-img-wrap">
                                            <img src="{{ $imageUrl }}" alt="{{ $photo->title }}" class="gallery-card-img" loading="lazy"
                                                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                            <div class="gallery-card-img-fallback" style="display:none;">
                                                <i class="fas fa-image"></i>
                                            </div>
                                            <div class="gallery-card-overlay">
                                                <button type="button" class="gallery-card-preview-btn" onclick="openAdminPreview('{{ $imageUrl }}', '{{ addslashes($photo->title) }}')">
                                                    <i class="fas fa-search-plus"></i>
                                                </button>
                                            </div>
                                            <span class="gallery-card-category-badge">{{ $photo->category }}</span>
                                        </div>
                                        <div class="gallery-card-body">
                                            <h6 class="gallery-card-title" title="{{ $photo->title }}">{{ Str::limit($photo->title, 30) }}</h6>
                                            <div class="gallery-card-date">
                                                <i class="fas fa-calendar-alt me-1"></i>{{ $photo->created_at->format('d M Y') }}
                                            </div>
                                            <div class="gallery-card-actions">
                                                <a href="{{ route('gallery.download', $photo->id) }}" class="gallery-action-btn download" title="Download">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                                <form action="{{ route('gallery.destroy', $photo->id) }}" method="POST" class="d-inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="gallery-action-btn delete" title="Hapus">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mgmt-empty">
                                <i class="fas fa-images"></i>
                                <p>Belum ada foto di galeri</p>
                                <small class="text-muted">Mulai unggah koleksi foto sekolah Anda</small>
                                <br>
                                <button type="button" class="btn btn-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                    <i class="fas fa-cloud-upload-alt me-1"></i> Unggah Foto Pertama
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- Upload Modal --}}
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius:var(--dash-radius)!important;border:none!important;">
                <div class="modal-header" style="background:linear-gradient(135deg,var(--dash-primary),var(--dash-primary-light));color:#fff;border-radius:var(--dash-radius) var(--dash-radius) 0 0;">
                    <h5 class="modal-title" id="uploadModalLabel"><i class="fas fa-cloud-upload-alt me-2"></i>Unggah Foto Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="galleryTitle" class="form-label">Judul Foto</label>
                            <input type="text" class="form-control" id="galleryTitle" name="title" placeholder="Contoh: Upacara Bendera 17 Agustus" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="galleryCategory" class="form-label">Kategori</label>
                                <select class="form-select" id="galleryCategory" name="category" required>
                                    <option value="Kegiatan">Kegiatan</option>
                                    <option value="Sarana">Sarana & Prasarana</option>
                                    <option value="Prestasi">Prestasi</option>
                                    <option value="Ekskul">Ekstrakurikuler</option>
                                    <option value="Lingkungan">Lingkungan Sekolah</option>
                                    <option value="Umum" selected>Umum</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="galleryDescription" class="form-label">Keterangan (Opsional)</label>
                                <input type="text" class="form-control" id="galleryDescription" name="description" placeholder="Deskripsi singkat foto">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">File Foto</label>
                            <label for="galleryPhotos" class="upload-zone-premium">
                                <div class="upload-zone-icon"><i class="fas fa-camera"></i></div>
                                <div>
                                    <div class="upload-zone-text">Klik untuk memilih foto</div>
                                    <div class="upload-zone-hint">JPG, JPEG, PNG, GIF, WebP, HEIC — Bisa pilih banyak foto sekaligus</div>
                                </div>
                            </label>
                            <input type="file" class="d-none" id="galleryPhotos" name="photos[]" accept="image/*,.heic,.heif" multiple required>
                            <div id="photoPreviewGrid" class="gallery-upload-preview mt-3"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm" style="background:#f1f5f9;color:var(--dash-text-light);" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-upload me-1"></i> Unggah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Admin Preview Modal --}}
    <div class="admin-preview-overlay" id="adminPreviewOverlay" onclick="closeAdminPreview()">
        <div class="admin-preview-container" onclick="event.stopPropagation()">
            <button class="admin-preview-close" onclick="closeAdminPreview()"><i class="fas fa-times"></i></button>
            <img id="adminPreviewImg" src="" alt="" class="admin-preview-img">
            <div class="admin-preview-title" id="adminPreviewTitle"></div>
        </div>
    </div>

    @push('styles')
    <style>
        /* Gallery Filter Tabs */
        .gallery-filter-tabs {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .gallery-filter-btn {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            border: 1.5px solid var(--dash-border);
            background: #fff;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--dash-text-light);
            cursor: pointer;
            transition: all 0.25s ease;
        }
        .gallery-filter-btn:hover {
            border-color: var(--dash-primary-light);
            color: var(--dash-primary-light);
        }
        .gallery-filter-btn.active {
            background: linear-gradient(135deg, var(--dash-primary), var(--dash-primary-light));
            color: #fff;
            border-color: transparent;
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.25rem;
        }
        .gallery-item {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .gallery-item.hidden {
            opacity: 0;
            transform: scale(0.8);
            position: absolute;
            pointer-events: none;
            width: 0;
            height: 0;
            overflow: hidden;
        }

        /* Gallery Card */
        .gallery-card {
            border-radius: var(--dash-radius) !important;
            border: 1px solid var(--dash-border) !important;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #fff;
        }
        .gallery-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.1) !important;
        }
        .gallery-card-img-wrap {
            position: relative;
            height: 180px;
            overflow: hidden;
            background: var(--dash-bg);
        }
        .gallery-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .gallery-card:hover .gallery-card-img {
            transform: scale(1.08);
        }
        .gallery-card-img-fallback {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-size: 2.5rem;
            background: var(--dash-bg);
        }
        .gallery-card-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .gallery-card:hover .gallery-card-overlay {
            opacity: 1;
        }
        .gallery-card-preview-btn {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: none;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(8px);
            color: #fff;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .gallery-card-preview-btn:hover {
            background: rgba(255,255,255,0.35);
            transform: scale(1.1);
        }
        .gallery-card-category-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 0.25rem 0.65rem;
            border-radius: 6px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(8px);
            color: #fff;
        }
        .gallery-card-body {
            padding: 0.85rem 1rem;
        }
        .gallery-card-title {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--dash-text);
            margin-bottom: 0.25rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .gallery-card-date {
            font-size: 0.7rem;
            color: var(--dash-text-light);
            margin-bottom: 0.5rem;
        }
        .gallery-card-actions {
            display: flex;
            gap: 0.4rem;
        }
        .gallery-action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .gallery-action-btn.download {
            background: rgba(37,99,235,0.08);
            color: #2563eb;
        }
        .gallery-action-btn.download:hover {
            background: rgba(37,99,235,0.15);
            transform: translateY(-1px);
        }
        .gallery-action-btn.delete {
            background: rgba(239,68,68,0.08);
            color: #dc2626;
        }
        .gallery-action-btn.delete:hover {
            background: rgba(239,68,68,0.15);
            transform: translateY(-1px);
        }

        /* Upload Preview */
        .gallery-upload-preview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 0.75rem;
        }
        .gallery-upload-preview-item {
            width: 100%;
            aspect-ratio: 1;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid var(--dash-border);
        }

        /* Admin Preview Overlay */
        .admin-preview-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.85);
            backdrop-filter: blur(12px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .admin-preview-overlay.active {
            display: flex;
        }
        .admin-preview-container {
            position: relative;
            max-width: 90vw;
            max-height: 85vh;
        }
        .admin-preview-img {
            max-width: 90vw;
            max-height: 80vh;
            border-radius: 12px;
            object-fit: contain;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        }
        .admin-preview-close {
            position: absolute;
            top: -16px;
            right: -16px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(8px);
            color: #fff;
            font-size: 1.1rem;
            cursor: pointer;
            z-index: 10;
            transition: all 0.2s ease;
        }
        .admin-preview-close:hover {
            background: rgba(239,68,68,0.6);
            transform: scale(1.1);
        }
        .admin-preview-title {
            text-align: center;
            color: rgba(255,255,255,0.8);
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 1rem;
        }

        @media (max-width: 576px) {
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.75rem;
            }
            .gallery-card-img-wrap {
                height: 140px;
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Category Filter
        document.querySelectorAll('.gallery-filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.gallery-filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const filter = this.dataset.filter;
                document.querySelectorAll('.gallery-item').forEach(item => {
                    if (filter === 'all' || item.dataset.category === filter) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                });
            });
        });

        // File Upload Preview
        document.getElementById('galleryPhotos').addEventListener('change', function(e) {
            const previewGrid = document.getElementById('photoPreviewGrid');
            previewGrid.innerHTML = '';
            Array.from(e.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    const img = document.createElement('img');
                    img.src = ev.target.result;
                    img.className = 'gallery-upload-preview-item';
                    previewGrid.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });

        // Admin Preview
        function openAdminPreview(url, title) {
            document.getElementById('adminPreviewImg').src = url;
            document.getElementById('adminPreviewTitle').textContent = title;
            document.getElementById('adminPreviewOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        function closeAdminPreview() {
            document.getElementById('adminPreviewOverlay').classList.remove('active');
            document.body.style.overflow = '';
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeAdminPreview();
        });
    </script>
    @endpush
</x-app-layout>
