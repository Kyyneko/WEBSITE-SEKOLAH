<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Kelola Artikel') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

            {{-- Header + Stats --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="art-section-title mb-0" style="border:none; padding-bottom:0;">
                            <i class="fas fa-newspaper me-2"></i>Daftar Artikel
                        </h5>
                        <a href="{{ route('articles.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Artikel
                        </a>
                    </div>

                    {{-- Stats Row --}}
                    <div class="art-stat-row">
                        <div class="art-stat-card">
                            <div class="art-stat-icon" style="background: rgba(37,99,235,0.08); color: #2563eb;">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <div>
                                <div class="art-stat-value">
                                    @if(method_exists($articles, 'total'))
                                        {{ $articles->total() }}
                                    @else
                                        {{ $articles->count() }}
                                    @endif
                                </div>
                                <div class="art-stat-label">Total Artikel</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">#</th>
                                    <th width="30%">Judul Artikel</th>
                                    <th class="text-center" width="15%">Foto</th>
                                    <th class="text-center" width="15%">Kategori</th>
                                    <th class="text-center" width="20%">Penulis</th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($articles as $article)
                                    <tr>
                                        <td class="text-center align-middle">
                                            @if(method_exists($articles, 'currentPage'))
                                                {{ ($articles->currentPage() - 1) * $articles->perPage() + $loop->iteration }}
                                            @else
                                                {{ $loop->iteration }}
                                            @endif
                                        </td>
                                        
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="art-file-icon">
                                                    <i class="fas fa-file-alt"></i>
                                                </div>
                                                <div>
                                                    <div class="art-title">{{ Str::limit($article->title, 50) }}</div>
                                                    <div class="art-date">
                                                        <i class="far fa-clock me-1"></i>{{ $article->created_at->format('d M Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td class="text-center align-middle">
                                            @php
                                                $photos = json_decode($article->photo_path);
                                                $photoCount = is_array($photos) ? count($photos) : 0;
                                            @endphp
                                            
                                            @if($photoCount > 0)
                                                @php
                                                    $firstPhoto = $photos[0];
                                                    if (str_starts_with($firstPhoto, 'public/article_photos/')) {
                                                        $imageUrl = asset('storage/' . str_replace('public/', '', $firstPhoto));
                                                    } elseif (str_starts_with($firstPhoto, 'public/image/')) {
                                                        $imageUrl = asset(str_replace('public/', '', $firstPhoto));
                                                    } elseif (str_starts_with($firstPhoto, 'article_photos/')) {
                                                        $imageUrl = asset('storage/' . $firstPhoto);
                                                    } elseif (str_starts_with($firstPhoto, 'image/')) {
                                                        $imageUrl = asset($firstPhoto);
                                                    } else {
                                                        $imageUrl = asset('storage/' . $firstPhoto);
                                                    }
                                                @endphp
                                                
                                                <div class="art-photo-wrap">
                                                    <img src="{{ $imageUrl }}" 
                                                         alt="{{ $article->title }}" 
                                                         class="art-photo-thumb"
                                                         data-bs-toggle="modal" 
                                                         data-bs-target="#photoModal{{ $article->id }}"
                                                         onerror="this.src='{{ asset('image/placeholder-article.png') }}';">
                                                    @if($photoCount > 1)
                                                        <span class="art-photo-count">+{{ $photoCount - 1 }}</span>
                                                    @endif
                                                </div>

                                                {{-- Photo Modal --}}
                                                <div class="modal fade" id="photoModal{{ $article->id }}" tabindex="-1">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">
                                                                    <i class="fas fa-images me-2"></i>Foto: {{ Str::limit($article->title, 40) }}
                                                                </h6>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body" style="background: var(--dash-bg);">
                                                                <div class="row g-3">
                                                                    @foreach ($photos as $index => $photo)
                                                                        @php
                                                                            if (str_starts_with($photo, 'public/article_photos/')) {
                                                                                $photoUrl = asset('storage/' . str_replace('public/', '', $photo));
                                                                            } elseif (str_starts_with($photo, 'public/image/')) {
                                                                                $photoUrl = asset(str_replace('public/', '', $photo));
                                                                            } elseif (str_starts_with($photo, 'article_photos/')) {
                                                                                $photoUrl = asset('storage/' . $photo);
                                                                            } elseif (str_starts_with($photo, 'image/')) {
                                                                                $photoUrl = asset($photo);
                                                                            } else {
                                                                                $photoUrl = asset('storage/' . $photo);
                                                                            }
                                                                        @endphp
                                                                        <div class="col-md-6 col-lg-4">
                                                                            <div class="art-modal-photo">
                                                                                <img src="{{ $photoUrl }}" 
                                                                                     alt="Foto {{ $index + 1 }}" 
                                                                                     class="img-fluid rounded"
                                                                                     onerror="this.parentElement.innerHTML='<div class=\'art-photo-error\'><i class=\'fas fa-image\'></i><small>Foto tidak ditemukan</small></div>';">
                                                                                <span class="art-modal-badge">#{{ $index + 1 }}</span>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="art-no-photo">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </td>

                                        <td class="text-center align-middle">
                                            @if($article->organisasi)
                                                <span class="badge bg-info text-white" style="font-size: 0.75rem; padding: 0.35rem 0.6rem; font-weight: 600;">
                                                    <i class="fas fa-users me-1"></i>{{ $article->organisasi->nama }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary text-white" style="font-size: 0.75rem; padding: 0.35rem 0.6rem; font-weight: 600;">
                                                    <i class="fas fa-globe me-1"></i>Umum
                                                </span>
                                            @endif
                                        </td>

                                        <td class="text-center align-middle">
                                            <span class="badge badge-primary">
                                                {{ Str::limit($article->user->name, 20) }}
                                            </span>
                                        </td>
                                        
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('articles.edit', $article->id) }}" 
                                                   class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                 <form action="{{ route('articles.destroy', $article->id) }}" 
                                                       method="POST" class="d-inline" id="delete-form-{{ $article->id }}"
                                                       onsubmit="return confirmDelete('delete-form-{{ $article->id }}')">
                                                     @csrf
                                                     @method('DELETE')
                                                     <button type="submit" class="btn btn-sm btn-danger">
                                                         <i class="fas fa-trash"></i>
                                                     </button>
                                                 </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="art-empty">
                                                <i class="fas fa-newspaper"></i>
                                                <p>Belum ada artikel</p>
                                                <small>Klik "Tambah Artikel" untuk mulai menulis</small>
                                                <div class="mt-3">
                                                    <a href="{{ route('articles.create') }}" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-plus me-1"></i> Tambah Artikel Pertama
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if(method_exists($articles, 'links'))
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3 pt-3" style="border-top: 1px solid var(--dash-border);">
                            <div style="font-size: 0.78rem; color: var(--dash-text-light);">
                                Menampilkan <strong>{{ $articles->firstItem() ?? 0 }}</strong> – 
                                <strong>{{ $articles->lastItem() ?? 0 }}</strong> dari 
                                <strong>{{ $articles->total() }}</strong> artikel
                            </div>
                            <div>{{ $articles->links() }}</div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    @push('styles')
    <style>
        .art-section-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--dash-text);
        }

        /* Stat */
        .art-stat-row {
            display: flex;
            gap: 0.75rem;
        }

        .art-stat-card {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border: 1px solid var(--dash-border);
            border-radius: 10px;
        }

        .art-stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .art-stat-value {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--dash-text);
            line-height: 1.2;
        }

        .art-stat-label {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--dash-text-light);
        }

        /* Table items */
        .art-file-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: rgba(37,99,235,0.08);
            color: var(--dash-primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .art-title {
            font-size: 0.84rem;
            font-weight: 600;
            color: var(--dash-text);
        }

        .art-date {
            font-size: 0.7rem;
            color: var(--dash-text-light);
            margin-top: 0.1rem;
        }

        /* Photo */
        .art-photo-wrap {
            position: relative;
            display: inline-block;
        }

        .art-photo-thumb {
            width: 64px;
            height: 48px;
            object-fit: cover;
            border-radius: 6px;
            border: 1.5px solid var(--dash-border);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .art-photo-thumb:hover {
            border-color: var(--dash-primary-light);
            box-shadow: 0 2px 8px rgba(37,99,235,0.15);
            transform: scale(1.05);
        }

        .art-photo-count {
            position: absolute;
            bottom: -4px;
            right: -6px;
            background: var(--dash-primary-light);
            color: #fff;
            font-size: 0.6rem;
            font-weight: 700;
            padding: 0.1rem 0.35rem;
            border-radius: 4px;
            line-height: 1.3;
        }

        .art-no-photo {
            width: 48px;
            height: 36px;
            border-radius: 6px;
            background: var(--dash-bg);
            border: 1.5px solid var(--dash-border);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-size: 0.85rem;
        }

        /* Modal */
        .art-modal-photo {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
            border: 1px solid var(--dash-border);
        }

        .art-modal-photo img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .art-modal-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            background: rgba(0,0,0,0.5);
            color: #fff;
            font-size: 0.6rem;
            font-weight: 700;
            padding: 0.15rem 0.4rem;
            border-radius: 4px;
        }

        .art-photo-error {
            height: 220px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            gap: 0.3rem;
        }

        /* Empty */
        .art-empty {
            color: var(--dash-text-light);
        }

        .art-empty > i {
            font-size: 2.5rem;
            color: #e2e8f0;
            margin-bottom: 0.5rem;
        }

        .art-empty p {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.15rem;
        }

        .art-empty small {
            font-size: 0.78rem;
        }
    </style>
    @endpush
</x-app-layout>
