<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Organisasi Management') }}
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
                                <i class="fas fa-sitemap text-info mr-2"></i>Daftar Organisasi
                            </h2>
                            <p class="text-muted mb-0">Kelola data organisasi sekolah</p>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <a href="{{ route('organisasi.create') }}" class="btn btn-info btn-lg">
                                <i class="fas fa-plus mr-2"></i>Tambah Organisasi
                            </a>
                        </div>
                    </div>

                    <!-- Statistics Card -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-info shadow-sm stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-1 small text-info font-weight-bold">Total Organisasi</p>
                                            <h3 class="mb-0 font-weight-bold text-info">
                                                {{ $organisasis->count() }}
                                            </h3>
                                        </div>
                                        <div class="stat-icon bg-info">
                                            <i class="fas fa-sitemap fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center" width="5%">#</th>
                                    <th width="20%">Nama Organisasi</th>
                                    <th width="35%">Deskripsi</th>
                                    <th class="text-center" width="20%">Foto</th>
                                    <th class="text-center" width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($organisasis as $organisasi)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="org-icon bg-info text-white mr-3">
                                                    <i class="fas fa-sitemap"></i>
                                                </div>
                                                <span class="font-weight-medium">{{ $organisasi->nama }}</span>
                                            </div>
                                        </td>
                                        
                                        <td class="align-middle">
                                            <div class="description-text">
                                                {!! Str::limit(strip_tags($organisasi->description), 150) !!}
                                            </div>
                                        </td>
                                        
                                        <td class="text-center align-middle">
                                            @if ($organisasi->photo_path)
                                                @php
                                                    $photos = json_decode($organisasi->photo_path);
                                                    $photoCount = is_array($photos) ? count($photos) : 0;
                                                @endphp
                                                
                                                @if($photoCount > 0)
                                                    <div class="photo-gallery">
                                                        @php
                                                            $firstPhoto = $photos[0];
                                                            
                                                            // Handle multiple path formats
                                                            if (str_starts_with($firstPhoto, 'public/organisasi_photos/')) {
                                                                $imageUrl = asset('storage/' . str_replace('public/', '', $firstPhoto));
                                                            } elseif (str_starts_with($firstPhoto, 'public/image/')) {
                                                                $imageUrl = asset(str_replace('public/', '', $firstPhoto));
                                                            } elseif (str_starts_with($firstPhoto, 'organisasi_photos/')) {
                                                                $imageUrl = asset('storage/' . $firstPhoto);
                                                            } elseif (str_starts_with($firstPhoto, 'image/')) {
                                                                $imageUrl = asset($firstPhoto);
                                                            } else {
                                                                $imageUrl = asset('storage/' . $firstPhoto);
                                                            }
                                                        @endphp
                                                        
                                                        <img src="{{ $imageUrl }}" 
                                                             alt="{{ $organisasi->nama }}" 
                                                             class="img-thumbnail photo-preview"
                                                             data-toggle="modal" 
                                                             data-target="#photoModal{{ $organisasi->id }}"
                                                             onerror="this.src='{{ asset('image/placeholder-org.png') }}'; this.onerror=null;">
                                                        
                                                        @if($photoCount > 1)
                                                            <span class="badge badge-info mt-2">
                                                                <i class="fas fa-images mr-1"></i>{{ $photoCount }} foto
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <!-- Photo Modal -->
                                                    <div class="modal fade" id="photoModal{{ $organisasi->id }}" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-info text-white">
                                                                    <h5 class="modal-title">
                                                                        <i class="fas fa-images mr-2"></i>Foto {{ $organisasi->nama }}
                                                                    </h5>
                                                                    <button type="button" class="close text-white" data-dismiss="modal">
                                                                        <span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="background: #f8f9fa;">
                                                                    <div class="row">
                                                                        @foreach ($photos as $index => $photo)
                                                                            @php
                                                                                // Handle path for each photo
                                                                                if (str_starts_with($photo, 'public/organisasi_photos/')) {
                                                                                    $photoUrl = asset('storage/' . str_replace('public/', '', $photo));
                                                                                } elseif (str_starts_with($photo, 'public/image/')) {
                                                                                    $photoUrl = asset(str_replace('public/', '', $photo));
                                                                                } elseif (str_starts_with($photo, 'organisasi_photos/')) {
                                                                                    $photoUrl = asset('storage/' . $photo);
                                                                                } elseif (str_starts_with($photo, 'image/')) {
                                                                                    $photoUrl = asset($photo);
                                                                                } else {
                                                                                    $photoUrl = asset('storage/' . $photo);
                                                                                }
                                                                            @endphp
                                                                            
                                                                            <div class="col-md-6 col-lg-4 mb-4">
                                                                                <div class="photo-card">
                                                                                    <img src="{{ $photoUrl }}" 
                                                                                         alt="Foto {{ $index + 1 }}" 
                                                                                         class="img-fluid rounded shadow-sm"
                                                                                         onerror="this.parentElement.innerHTML='<div class=\'photo-error\'><i class=\'fas fa-exclamation-triangle fa-3x text-warning\'></i><p class=\'text-muted mt-2\'>Foto tidak ditemukan</p></div>';">
                                                                                    <div class="photo-number">
                                                                                        <span class="badge badge-info">
                                                                                            <i class="fas fa-image mr-1"></i>Foto #{{ $index + 1 }}
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                        <i class="fas fa-times mr-1"></i>Tutup
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted small">
                                                        <i class="fas fa-image mr-1"></i>Data foto tidak valid
                                                    </span>
                                                @endif
                                            @else
                                                <div class="no-photo-placeholder">
                                                    <i class="fas fa-image text-muted"></i>
                                                    <small class="text-muted d-block mt-1">Tidak ada foto</small>
                                                </div>
                                            @endif
                                        </td>
                                        
                                        <td class="text-center align-middle">
                                            <div class="btn-group-vertical btn-group-sm" role="group">
                                                <a href="{{ route('organisasi.edit', $organisasi->id) }}" 
                                                   class="btn btn-warning text-white mb-1">
                                                    <i class="fas fa-edit mr-1"></i>Edit
                                                </a>
                                                <form action="{{ route('organisasi.destroy', $organisasi->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus organisasi ini beserta semua fotonya?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                                        <i class="fas fa-trash mr-1"></i>Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-sitemap fa-4x text-muted mb-3"></i>
                                                <h5 class="text-muted mb-2">Belum ada organisasi</h5>
                                                <p class="text-muted mb-4">Klik tombol "Tambah Organisasi" untuk menambahkan data baru</p>
                                                <a href="{{ route('organisasi.create') }}" class="btn btn-info">
                                                    <i class="fas fa-plus mr-2"></i>Tambah Organisasi Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if(method_exists($organisasis, 'links'))
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="text-muted small mb-3 mb-sm-0">
                                Menampilkan <strong>{{ $organisasis->firstItem() ?? 0 }}</strong> sampai 
                                <strong>{{ $organisasis->lastItem() ?? 0 }}</strong> dari 
                                <strong>{{ $organisasis->total() }}</strong> organisasi
                            </div>
                            <div>
                                {{ $organisasis->links() }}
                            </div>
                        </div>
                    @elseif($organisasis->count() > 0)
                        <div class="text-center text-muted small mt-4">
                            Total <strong>{{ $organisasis->count() }}</strong> organisasi
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Organization Icon */
        .org-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        /* Statistics Card */
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

        /* Table Styling */
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            background-color: #f8f9fa !important;
            border-bottom: 2px solid #dee2e6;
        }

        .table td {
            vertical-align: middle;
        }

        .description-text {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .font-weight-medium {
            font-weight: 500;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(23, 162, 184, 0.05);
        }

        /* Photo Gallery */
        .photo-gallery {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .photo-preview {
            width: 100px;
            height: 80px;
            object-fit: cover;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid #17a2b8;
        }

        .photo-preview:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(23, 162, 184, 0.3);
            z-index: 10;
        }

        /* No Photo Placeholder */
        .no-photo-placeholder {
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 0.5rem;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
        }

        .no-photo-placeholder i {
            font-size: 1.5rem;
        }

        /* Photo Card in Modal */
        .photo-card {
            position: relative;
            border-radius: 0.5rem;
            overflow: hidden;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }

        .photo-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .photo-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .photo-number {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .photo-error {
            width: 100%;
            height: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
        }

        /* Button Group */
        .btn-group-vertical .btn {
            border-radius: 0.25rem !important;
        }

        /* Empty State */
        .empty-state {
            padding: 3rem 1rem;
        }

        /* Custom scrollbar for table */
        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #17a2b8;
            border-radius: 4px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #138496;
        }

        /* Modal Styling */
        .modal-header {
            border-bottom: 2px solid #e9ecef;
        }

        .modal-body img {
            transition: transform 0.2s;
        }

        .modal-body img:hover {
            transform: scale(1.02);
        }

        /* Badge Styling */
        .badge {
            font-weight: 600;
            padding: 0.4rem 0.6rem;
        }

        /* Smooth transitions */
        button, a {
            transition: all 0.2s ease-in-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .photo-preview {
                width: 80px;
                height: 60px;
            }

            .photo-card img {
                height: 200px;
            }

            .btn-group-vertical .btn {
                font-size: 0.8rem;
                padding: 0.4rem 0.6rem;
            }
        }
    </style>
</x-app-layout>
