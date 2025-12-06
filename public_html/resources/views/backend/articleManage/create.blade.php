<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="mb-4 pb-3 border-bottom">
                        <h3 class="text-2xl font-weight-bold text-dark mb-1">
                            <i class="fas fa-newspaper text-primary mr-2"></i>Tambah Artikel Baru
                        </h3>
                        <p class="text-muted mb-0">Lengkapi form di bawah untuk menambahkan artikel baru</p>
                    </div>

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
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-globe mr-1"></i>/artikel/
                                    </span>
                                </div>
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
                            <label for="photos" class="form-label font-weight-bold">
                                <i class="fas fa-images text-primary mr-1"></i>Foto Artikel
                            </label>
                            <input type="file" 
                                   class="form-control form-control-lg @error('photos') is-invalid @enderror @error('photos.*') is-invalid @enderror" 
                                   id="photos" 
                                   name="photos[]" 
                                   multiple
                                   accept="image/*"
                                   onchange="previewImages(event)">
                            @error('photos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('photos.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Upload satu atau lebih foto pendukung artikel. Format: JPG, PNG. Maksimal 2MB per foto
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
            
            // Clear previous previews
            previewContainer.innerHTML = '';
            
            if (files.length > 0) {
                imagePreview.style.display = 'block';
                
                Array.from(files).forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const col = document.createElement('div');
                            col.className = 'col-md-3 col-sm-6 mb-3';
                            
                            const card = document.createElement('div');
                            card.className = 'card shadow-sm';
                            
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'card-img-top';
                            img.style.height = '150px';
                            img.style.objectFit = 'cover';
                            
                            const cardBody = document.createElement('div');
                            cardBody.className = 'card-body p-2';
                            
                            const badge = document.createElement('span');
                            badge.className = 'badge badge-primary';
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
            font-size: 0.9rem;
            color: #6c757d;
        }

        .input-group-prepend .input-group-text {
            border-right: none;
        }

        .input-group > .form-control:not(:first-child) {
            border-left: none;
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
