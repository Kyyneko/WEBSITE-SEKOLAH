<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Announcement') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Page Header Card --}}
            <div class="dash-header-card mb-4">
                <div class="dash-header-card-content">
                    <div class="dash-header-card-icon">
                        <i class="fas fa-bullhorn text-white"></i>
                    </div>
                    <div>
                        <h3 class="dash-header-card-title">Edit Pengumuman</h3>
                        <p class="dash-header-card-desc">Perbarui informasi pengumuman: <strong>{{ $ad->title }}</strong></p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">

                    <form action="{{ route('ads.update', $ad->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Title Field -->
                        <div class="mb-4">
                            <label for="title" class="form-label font-weight-bold">
                                <i class="fas fa-heading text-primary mr-1"></i>Judul Pengumuman
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title"
                                   value="{{ old('title', $ad->title) }}" 
                                   placeholder="Masukkan judul pengumuman"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Masukkan judul yang menarik dan deskriptif
                            </small>
                        </div>

                        <!-- Link Field -->
                        <div class="mb-4">
                            <label for="link" class="form-label font-weight-bold">
                                <i class="fas fa-link text-primary mr-1"></i>Link Tujuan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="url" 
                                   class="form-control form-control-lg @error('link') is-invalid @enderror" 
                                   id="link" 
                                   name="link"
                                   value="{{ old('link', $ad->link) }}" 
                                   placeholder="https://example.com"
                                   required>
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>URL lengkap tempat pengumuman akan mengarahkan pengguna
                            </small>
                        </div>

                        <!-- Description Field with Trix Editor -->
                        <div class="mb-4">
                            <label for="description" class="form-label font-weight-bold">
                                <i class="fas fa-align-left text-primary mr-1"></i>Deskripsi
                                <span class="text-danger">*</span>
                            </label>
                            <div class="trix-wrapper">
                                <input id="description" type="hidden" name="description" value="{{ old('description', $ad->description) }}">
                                <trix-editor input="description" placeholder="Tuliskan deskripsi pengumuman yang menarik..."></trix-editor>
                            </div>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Gunakan editor untuk memformat teks dengan rapi (bold, italic, list, dll)
                            </small>
                        </div>

                        <!-- Photo Field -->
                        <div class="mb-4">
                            <label class="form-label font-weight-bold">
                                <i class="fas fa-image text-primary mr-1"></i>Foto Pengumuman
                            </label>
                            <label for="photo" class="upload-zone-premium mb-0">
                                <div class="upload-zone-icon" style="background: rgba(239, 68, 68, 0.08); color: var(--dash-danger);">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div>
                                    <div class="upload-zone-text" id="fileLabel">Klik untuk memilih gambar atau seret ke sini</div>
                                    <div class="upload-zone-hint">Format: JPG, JPEG, PNG, WEBP, HEIC — Otomatis dikompres dengan kualitas terbaik.</div>
                                </div>
                                <input type="file" 
                                       class="d-none @error('photo') is-invalid @enderror" 
                                       id="photo" 
                                       name="photo"
                                       accept="image/*,.heic,.heif"
                                       onchange="previewImage(event)">
                            </label>
                            @error('photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            
                            <!-- Image Preview (New) -->
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <label class="font-weight-bold text-dark mb-2">
                                    <i class="fas fa-eye mr-1"></i>Preview Foto Baru:
                                </label>
                                <div class="position-relative d-inline-block">
                                    <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 200px; object-fit: cover;">
                                    <button type="button" class="btn btn-sm btn-danger position-absolute" style="top: 10px; right: 10px; border-radius: 50%; width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center;" onclick="removePreview()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            
                            @if ($ad->photo_path)
                                <div id="currentPhotoContainer" class="mt-3 p-3 border rounded bg-light transition-all">
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-eye mr-1"></i>Foto saat ini:
                                    </p>
                                    <img src="{{ asset('storage/' . $ad->photo_path) }}" 
                                         alt="Current Photo"
                                         class="img-thumbnail"
                                         style="max-width: 300px; max-height: 200px; object-fit: cover;">
                                </div>
                            @endif
                            
                            <small class="form-text text-muted mt-2">
                                <i class="fas fa-info-circle mr-1"></i>Upload foto baru jika ingin mengganti. Format: JPG, PNG, WEBP, HEIC. Maksimal 100MB.
                            </small>
                        </div>

                        <!-- Alert Warning -->
                        <div class="alert alert-warning" role="alert">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Perhatian:</strong> Pastikan semua perubahan sudah benar sebelum menyimpan.
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                            <a href="{{ route('ads.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning btn-lg text-white">
                                <i class="fas fa-save mr-2"></i>Update Pengumuman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffc107;
            color: #856404;
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
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
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
            background-color: #ffc107;
            color: white;
            border-color: #ffc107;
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

        /* Image Preview Styling */
        .img-thumbnail {
            padding: 0.25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
    </style>

    <script>
        // Image Preview Function
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            const fileLabel = document.getElementById('fileLabel');
            const currentPhoto = document.getElementById('currentPhotoContainer');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block';
                    if (currentPhoto) {
                        currentPhoto.style.opacity = '0.5';
                    }
                    if (fileLabel) {
                        fileLabel.innerHTML = '<i class="fas fa-image mr-2"></i>' + file.name;
                    }
                }
                reader.readAsDataURL(file);
            }
        }

        // Remove Preview Function
        function removePreview() {
            document.getElementById('photo').value = '';
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('preview').src = '';
            const currentPhoto = document.getElementById('currentPhotoContainer');
            if (currentPhoto) {
                currentPhoto.style.opacity = '1';
            }
            const fileLabel = document.getElementById('fileLabel');
            if (fileLabel) {
                fileLabel.innerHTML = 'Klik untuk memilih gambar atau seret ke sini';
            }
        }
    </script>
</x-app-layout>
