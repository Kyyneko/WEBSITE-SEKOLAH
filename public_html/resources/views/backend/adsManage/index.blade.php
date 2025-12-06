<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ads Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <h2 class="text-2xl font-weight-bold mb-2">
                                <i class="fas fa-bullhorn text-danger mr-2"></i>Daftar Iklan
                            </h2>
                            <p class="text-muted mb-0">Kelola iklan dan pengumuman</p>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <a href="{{ route('ads.create') }}" class="btn btn-danger btn-lg">
                                <i class="fas fa-plus mr-2"></i>Tambah Iklan
                            </a>
                        </div>
                    </div>

                    <!-- Statistics Card -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-danger shadow-sm stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-1 small text-danger font-weight-bold">Total Iklan Aktif</p>
                                            <h3 class="mb-0 font-weight-bold text-danger">
                                                {{ $ads->count() }}
                                            </h3>
                                        </div>
                                        <div class="stat-icon bg-danger">
                                            <i class="fas fa-bullhorn fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ads Grid Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse ($ads as $ad)
                        <div class="ad-card mb-4 border rounded shadow-sm">
                            <div class="row g-0">
                                <!-- Image Column -->
                                <div class="col-md-4">
                                    <div class="ad-image-wrapper">
                                        @if($ad->photo_path)
                                            @php
                                                $photoPath = $ad->photo_path;
                                                
                                                // Handle multiple path formats
                                                if (str_starts_with($photoPath, 'public/ads_photos/')) {
                                                    // Format: public/ads_photos/xxx.jpg → storage/ads_photos/xxx.jpg
                                                    $imageUrl = asset('storage/' . str_replace('public/', '', $photoPath));
                                                } elseif (str_starts_with($photoPath, 'public/image/')) {
                                                    // Format: public/image/xxx.jpg → image/xxx.jpg
                                                    $imageUrl = asset(str_replace('public/', '', $photoPath));
                                                } elseif (str_starts_with($photoPath, 'ads_photos/')) {
                                                    // Format: ads_photos/xxx.jpg → storage/ads_photos/xxx.jpg
                                                    $imageUrl = asset('storage/' . $photoPath);
                                                } elseif (str_starts_with($photoPath, 'image/')) {
                                                    // Format: image/xxx.jpg → image/xxx.jpg
                                                    $imageUrl = asset($photoPath);
                                                } else {
                                                    // Fallback: assume it's in storage
                                                    $imageUrl = asset('storage/' . $photoPath);
                                                }
                                            @endphp
                                            
                                            <img src="{{ $imageUrl }}" 
                                                 alt="{{ $ad->title }}"
                                                 class="ad-image"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            
                                            <!-- Fallback Placeholder -->
                                            <div class="ad-image-placeholder" style="display: none;">
                                                <i class="fas fa-image fa-3x text-muted"></i>
                                                <p class="text-muted mt-2 mb-0">Gambar tidak ditemukan</p>
                                                <small class="text-muted">{{ basename($photoPath) }}</small>
                                            </div>
                                        @else
                                            <div class="ad-image-placeholder">
                                                <i class="fas fa-image fa-3x text-muted"></i>
                                                <p class="text-muted mt-2 mb-0">Tidak ada gambar</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Content Column -->
                                <div class="col-md-8">
                                    <div class="ad-content p-4">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div class="flex-grow-1">
                                                <h4 class="font-weight-bold text-dark mb-2">
                                                    <i class="fas fa-bullhorn text-danger mr-2"></i>{{ $ad->title }}
                                                </h4>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="badge badge-danger">
                                                        <i class="fas fa-tag mr-1"></i>Iklan #{{ $loop->iteration }}
                                                    </span>
                                                    @if($ad->photo_path)
                                                        <span class="badge badge-success">
                                                            <i class="fas fa-check-circle mr-1"></i>Ada Gambar
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">
                                                            <i class="fas fa-times-circle mr-1"></i>Tanpa Gambar
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="ad-description mb-3">
                                            <h6 class="font-weight-bold text-muted mb-2">
                                                <i class="fas fa-align-left mr-1"></i>Deskripsi:
                                            </h6>
                                            <div class="description-content">
                                                {!! Str::limit(strip_tags($ad->description), 200) !!}
                                            </div>
                                        </div>

                                        <!-- Meta Info -->
                                        @if($ad->photo_path)
                                            <div class="mb-3">
                                                <small class="text-muted">
                                                    <i class="fas fa-file-image mr-1"></i>
                                                    File: {{ basename($ad->photo_path) }}
                                                </small>
                                            </div>
                                        @endif

                                        <!-- Action Buttons -->
                                        <div class="d-flex flex-wrap gap-2 mt-3">
                                            <a href="{{ route('ads.edit', $ad->id) }}" 
                                               class="btn btn-warning text-white">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </a>
                                            <form action="{{ route('ads.destroy', $ad->id) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus iklan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash mr-1"></i>Hapus
                                                </button>
                                            </form>
                                            <button type="button" 
                                                    class="btn btn-info text-white" 
                                                    onclick="toggleFullDescription({{ $ad->id }})">
                                                <i class="fas fa-eye mr-1"></i>Lihat Detail
                                            </button>
                                            @if($ad->photo_path)
                                                <button type="button" 
                                                        class="btn btn-secondary" 
                                                        onclick="viewFullImage({{ $ad->id }})">
                                                    <i class="fas fa-expand mr-1"></i>Zoom Gambar
                                                </button>
                                            @endif
                                        </div>

                                        <!-- Full Description (Hidden by default) -->
                                        <div id="full-desc-{{ $ad->id }}" class="full-description mt-3" style="display: none;">
                                            <hr>
                                            <h6 class="font-weight-bold text-dark mb-2">
                                                <i class="fas fa-file-alt mr-1"></i>Deskripsi Lengkap:
                                            </h6>
                                            <div class="p-3 bg-light rounded">
                                                {!! $ad->description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-bullhorn fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted mb-2">Belum ada iklan</h5>
                            <p class="text-muted mb-4">Klik tombol "Tambah Iklan" untuk menambahkan iklan baru</p>
                            <a href="{{ route('ads.create') }}" class="btn btn-danger">
                                <i class="fas fa-plus mr-2"></i>Tambah Iklan Pertama
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="imageModalLabel">
                        <i class="fas fa-image mr-2"></i>Preview Gambar Iklan
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center p-0">
                    <img id="modalImage" src="" alt="Full Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFullDescription(adId) {
            const fullDesc = document.getElementById('full-desc-' + adId);
            const button = event.target.closest('button');
            
            if (fullDesc.style.display === 'none') {
                fullDesc.style.display = 'block';
                button.innerHTML = '<i class="fas fa-eye-slash mr-1"></i>Sembunyikan Detail';
                button.classList.remove('btn-info');
                button.classList.add('btn-secondary');
            } else {
                fullDesc.style.display = 'none';
                button.innerHTML = '<i class="fas fa-eye mr-1"></i>Lihat Detail';
                button.classList.remove('btn-secondary');
                button.classList.add('btn-info');
            }
        }

        function viewFullImage(adId) {
            const adCard = event.target.closest('.ad-card');
            const img = adCard.querySelector('.ad-image');
            
            if (img && img.style.display !== 'none') {
                const modalImg = document.getElementById('modalImage');
                modalImg.src = img.src;
                $('#imageModal').modal('show');
            } else {
                alert('Gambar tidak tersedia');
            }
        }
    </script>

    <style>
        .stat-card {
            transition: transform 0.2s, box-shadow 0.2s;
            border-width: 2px;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.9;
        }

        .ad-card {
            transition: all 0.3s ease;
            background: white;
        }

        .ad-card:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important;
            transform: translateY(-2px);
        }

        .ad-image-wrapper {
            height: 100%;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 0.25rem 0 0 0.25rem;
            overflow: hidden;
            position: relative;
        }

        .ad-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .ad-card:hover .ad-image {
            transform: scale(1.05);
        }

        .ad-image-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 2rem;
        }

        .ad-content {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .ad-description {
            color: #6c757d;
            line-height: 1.6;
            flex-grow: 1;
        }

        .description-content {
            font-size: 0.95rem;
            color: #495057;
        }

        .full-description {
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.5rem 0.75rem;
        }

        /* Modal Image */
        #modalImage {
            max-height: 80vh;
            object-fit: contain;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .ad-image-wrapper {
                min-height: 200px;
                border-radius: 0.25rem 0.25rem 0 0;
            }
            
            .ad-content {
                padding: 1.5rem !important;
            }

            .gap-2 {
                gap: 0.5rem;
            }

            .btn {
                font-size: 0.875rem;
                padding: 0.5rem 0.75rem;
            }
        }

        /* Button hover effects */
        .btn {
            transition: all 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        /* Badge spacing */
        .badge + .badge {
            margin-left: 0.5rem;
        }

        /* Meta info styling */
        small.text-muted {
            font-size: 0.8rem;
        }

        /* Image loading state */
        .ad-image-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            z-index: -1;
        }
    </style>
</x-app-layout>
