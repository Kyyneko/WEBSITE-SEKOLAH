<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Article') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Page Header Card --}}
            <div class="dash-header-card mb-4">
                <div class="dash-header-card-content">
                    <div class="dash-header-card-icon">
                        <i class="fas fa-newspaper text-white"></i>
                    </div>
                    <div>
                        <h3 class="dash-header-card-title">Tambah Artikel Baru</h3>
                        <p class="dash-header-card-desc">Lengkapi form di bawah untuk menambahkan artikel baru ke sistem</p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">

                    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Title Field -->
                        <div class="mb-4">
                            <label for="title" class="form-label font-weight-bold">
                                <i class="fas fa-heading text-primary mr-1"></i>Judul Artikel
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   placeholder="Contoh: Prestasi Siswa dalam Kompetisi Sains"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Masukkan judul artikel yang menarik dan deskriptif
                            </small>
                        </div>

                        <!-- Slug Field -->
                        <div class="mb-4">
                            <label for="slug" class="form-label font-weight-bold">
                                <i class="fas fa-link text-primary mr-1"></i>Slug URL
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-globe mr-1"></i>/artikel/
                                </span>
                                <input type="text" 
                                       class="form-control @error('slug') is-invalid @enderror" 
                                       id="slug" 
                                       name="slug" 
                                       value="{{ old('slug') }}"
                                       readonly
                                       style="background-color: #e9ecef;">
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-magic mr-1"></i>Slug otomatis dibuat dari judul artikel
                            </small>
                        </div>

                        <!-- Kategori / Organisasi Field -->
                        <div class="mb-4">
                            <label for="organisasi_id" class="form-label font-weight-bold">
                                <i class="fas fa-tags text-primary mr-1"></i>Kategori / Organisasi
                            </label>
                            @if(auth()->user()->role === 'admin')
                                <select class="form-control form-control-lg @error('organisasi_id') is-invalid @enderror" 
                                        id="organisasi_id" 
                                        name="organisasi_id">
                                    <option value="">Umum (General)</option>
                                    @foreach($organisasis as $organisasi)
                                        <option value="{{ $organisasi->id }}" {{ old('organisasi_id') == $organisasi->id ? 'selected' : '' }}>
                                            {{ $organisasi->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle mr-1"></i>Sebagai Admin, Anda dapat menerbitkan artikel untuk kategori Umum atau Organisasi tertentu.
                                </small>
                            @else
                                @php
                                    $userOrganisasi = auth()->user()->organisasi;
                                @endphp
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light text-warning">
                                        <i class="fas fa-lock mr-1"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control" 
                                           value="{{ $userOrganisasi ? $userOrganisasi->nama : 'Umum (General)' }}" 
                                           readonly 
                                           style="background-color: #e9ecef;">
                                </div>
                                <small class="form-text text-warning mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i>Kategori dikunci ke <strong>{{ $userOrganisasi ? $userOrganisasi->nama : 'Umum' }}</strong> berdasarkan profil penugasan Anda.
                                </small>
                            @endif
                            @error('organisasi_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description Field with Trix Editor -->
                        <div class="mb-4">
                            <label for="description" class="form-label font-weight-bold">
                                <i class="fas fa-align-left text-primary mr-1"></i>Konten Artikel
                                <span class="text-danger">*</span>
                            </label>
                            <div class="trix-wrapper">
                                <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                                <trix-editor input="description" placeholder="Tuliskan konten artikel dengan lengkap dan informatif..."></trix-editor>
                            </div>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Gunakan editor untuk memformat teks dengan rapi (bold, italic, list, heading, dll)
                            </small>
                        </div>

                        <!-- Photos Field -->
                        <div class="mb-4">
                            <label class="form-label font-weight-bold">
                                <i class="fas fa-images text-primary mr-1"></i>Foto Artikel
                            </label>
                            <label for="photos" class="upload-zone-premium mb-0">
                                <div class="upload-zone-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div>
                                    <div class="upload-zone-text" id="fileLabel">Klik untuk memilih gambar atau seret ke sini</div>
                                    <div class="upload-zone-hint">Format: JPG, JPEG, PNG, WEBP, HEIC — Otomatis dikompres dengan kualitas terbaik (Bisa memilih beberapa foto sekaligus)</div>
                                </div>
                                <input type="file" 
                                       class="d-none @error('photos') is-invalid @enderror @error('photos.*') is-invalid @enderror" 
                                       id="photos" 
                                       name="photos[]" 
                                       multiple
                                       accept="image/*,.heic,.heif"
                                       onchange="previewImages(event)">
                            </label>
                            @error('photos')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            @error('photos.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Upload satu atau lebih foto pendukung artikel. Format: JPG, PNG, WEBP, HEIC. Maksimal 100MB per foto.
                            </small>
                            
                            <!-- Image Preview Container -->
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <div class="alert alert-info">
                                    <i class="fas fa-images mr-2"></i>
                                    <strong>Preview Foto:</strong>
                                </div>
                                <div id="previewContainer" class="row"></div>
                            </div>
                        </div>

                        <!-- Alert Info -->
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-lightbulb mr-2"></i>
                            <strong>Tips:</strong> Artikel yang baik memiliki judul menarik, konten informatif dengan struktur jelas (pembukaan, isi, penutup), dan foto yang relevan serta berkualitas.
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                            <a href="{{ route('articles.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save mr-2"></i>Simpan Artikel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-generate slug from title
        document.getElementById('title').addEventListener('input', function() {
            var title = this.value.trim().toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '') // Remove non-word characters
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/-+/g, '-'); // Remove duplicate -

            document.getElementById('slug').value = title;
        });

        // Preview images before upload
        function previewImages(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('previewContainer');
            const imagePreview = document.getElementById('imagePreview');
            const fileLabel = document.getElementById('fileLabel');
            
            // Clear previous previews
            previewContainer.innerHTML = '';
            
            if (files.length > 0) {
                imagePreview.style.display = 'block';
                
                // Update file label
                if (files.length === 1) {
                    fileLabel.innerHTML = '<i class="fas fa-image mr-2"></i>' + files[0].name;
                } else {
                    fileLabel.innerHTML = '<i class="fas fa-images mr-2"></i>' + files.length + ' file dipilih';
                }
                
                Array.from(files).forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const col = document.createElement('div');
                            col.className = 'col-md-3 col-sm-6 mb-3';
                            
                            const card = document.createElement('div');
                            card.className = 'card shadow-sm border-success';
                            
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'card-img-top';
                            img.style.height = '150px';
                            img.style.objectFit = 'cover';
                            
                            const cardBody = document.createElement('div');
                            cardBody.className = 'card-body p-2';
                            
                            const badge = document.createElement('span');
                            badge.className = 'badge badge-success';
                            badge.innerHTML = '<i class="fas fa-image mr-1"></i>Foto ' + (index + 1);
                            
                            const fileName = document.createElement('small');
                            fileName.className = 'text-muted text-truncate d-block mt-1';
                            fileName.textContent = file.name;
                            
                            cardBody.appendChild(badge);
                            cardBody.appendChild(fileName);
                            card.appendChild(img);
                            card.appendChild(cardBody);
                            col.appendChild(card);
                            previewContainer.appendChild(col);
                        };
                        
                        reader.readAsDataURL(file);
                    }
                });
            } else {
                imagePreview.style.display = 'none';
                if (fileLabel) {
                    fileLabel.innerHTML = 'Klik untuk memilih gambar atau seret ke sini';
                }
            }
        }
    </script>

    <style>
        /* Form Styling */
        .form-label {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-control-lg, .input-group-lg > .form-control {
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }

        .border-bottom {
            border-bottom: 2px solid #e5e7eb !important;
        }

        .border-top {
            border-top: 2px solid #e5e7eb !important;
        }

        /* Input Group Styling */
        .input-group-text {
            color: #6c757d;
        }

        /* Trix Editor Styling */
        .trix-wrapper {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .trix-wrapper:focus-within {
            border-color: #4f46e5;
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
        }

        trix-editor {
            min-height: 300px;
            max-height: 500px;
            overflow-y: auto;
            padding: 0.75rem;
            border: none;
            border-radius: 0.25rem;
        }

        trix-toolbar {
            border: none;
            border-bottom: 1px solid #dee2e6;
            background-color: #f8f9fa;
            border-radius: 0.25rem 0.25rem 0 0;
            padding: 0.5rem;
        }

        trix-toolbar .trix-button-group {
            margin-bottom: 0;
        }

        trix-toolbar .trix-button {
            border-color: #dee2e6;
            background-color: white;
            margin: 0 2px;
            border-radius: 0.25rem;
            transition: all 0.2s;
        }

        trix-toolbar .trix-button:hover {
            background-color: #e9ecef;
        }

        trix-toolbar .trix-button.trix-active {
            background-color: #4f46e5;
            color: white;
            border-color: #4f46e5;
        }

        trix-editor:empty:not(:focus)::before {
            color: #6c757d;
        }

        /* Custom scrollbar for trix editor */
        trix-editor::-webkit-scrollbar {
            width: 8px;
        }

        trix-editor::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        trix-editor::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 4px;
        }

        trix-editor::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }

        /* Image Preview Cards */
        #previewContainer .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        #previewContainer .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
        }

        #previewContainer img {
            border-radius: 0.25rem 0.25rem 0 0;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
    </style>
</x-app-layout>
