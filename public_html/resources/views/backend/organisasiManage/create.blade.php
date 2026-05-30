<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Organisasi') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Page Header Card --}}
            <div class="dash-header-card mb-4">
                <div class="dash-header-card-content">
                    <div class="dash-header-card-icon">
                        <i class="fas fa-sitemap text-white"></i>
                    </div>
                    <div>
                        <h3 class="dash-header-card-title">Tambah Organisasi</h3>
                        <p class="dash-header-card-desc">Lengkapi form di bawah untuk menambahkan organisasi baru ke sistem</p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">

                    <form action="{{ route('organisasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Nama Organisasi Field -->
                        <div class="mb-4">
                            <label for="nama" class="form-label font-weight-bold">
                                <i class="fas fa-sitemap text-info mr-1"></i>Nama Organisasi
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('nama') is-invalid @enderror" 
                                   id="nama" 
                                   name="nama" 
                                   value="{{ old('nama') }}"
                                   placeholder="Contoh: OSIS, Pramuka, PMR"
                                   required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Masukkan nama organisasi dengan jelas
                            </small>
                        </div>

                        <!-- Description Field with Trix Editor -->
                        <div class="mb-4">
                            <label for="description" class="form-label font-weight-bold">
                                <i class="fas fa-align-left text-info mr-1"></i>Deskripsi
                                <span class="text-danger">*</span>
                            </label>
                            <div class="trix-wrapper">
                                <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                                <trix-editor input="description" placeholder="Tuliskan deskripsi organisasi, visi misi, kegiatan, atau informasi penting lainnya..."></trix-editor>
                            </div>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Gunakan editor untuk memformat teks dengan rapi (bold, italic, list, dll)
                            </small>
                        </div>

                        <!-- Photos Field -->
                        <div class="mb-4">
                            <label class="form-label font-weight-bold">
                                <i class="fas fa-images text-info mr-1"></i>Foto Organisasi
                            </label>
                            <label for="photos" class="upload-zone-premium mb-0">
                                <div class="upload-zone-icon" style="background: rgba(13,148,136,0.08); color: var(--dash-accent);">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div>
                                    <div class="upload-zone-text">Klik untuk memilih gambar atau seret ke sini</div>
                                    <div class="upload-zone-hint">Format: JPG, JPEG, PNG, WEBP, HEIC — Otomatis dikompres dengan kualitas terbaik (Bisa memilih beberapa foto sekaligus)</div>
                                </div>
                                <input type="file" 
                                       class="d-none" 
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
                                <i class="fas fa-info-circle mr-1"></i>Upload satu atau lebih foto. Format: JPG, PNG, WEBP, HEIC. Maksimal 100MB per foto.
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
                            <strong>Tips:</strong> Deskripsi yang baik mencakup tujuan organisasi, kegiatan yang dilakukan, dan manfaat bergabung dengan organisasi ini.
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                            <a href="{{ route('organisasi.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-info btn-lg">
                                <i class="fas fa-save mr-2"></i>Simpan Organisasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
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
                            
                            const fileName = document.createElement('small');
                            fileName.className = 'text-muted text-truncate d-block';
                            fileName.textContent = file.name;
                            
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

        .form-control-lg {
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #17a2b8;
            box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
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

        /* Trix Editor Styling */
        .trix-wrapper {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .trix-wrapper:focus-within {
            border-color: #17a2b8;
            box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
        }

        trix-editor {
            min-height: 250px;
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
            background-color: #17a2b8;
            color: white;
            border-color: #17a2b8;
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
    </style>
</x-app-layout>
