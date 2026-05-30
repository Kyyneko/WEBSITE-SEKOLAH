<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Announcement') }}
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
                        <h3 class="dash-header-card-title">Tambah Pengumuman Baru</h3>
                        <p class="dash-header-card-desc">Lengkapi form di bawah untuk menambahkan pengumuman baru ke sistem</p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">

                    <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Title Field -->
                        <div class="mb-4">
                            <label for="title" class="form-label font-weight-bold">
                                <i class="fas fa-heading text-danger mr-1"></i>Judul Pengumuman
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   placeholder="Contoh: Pendaftaran Siswa Baru 2024, Lomba Cerdas Cermat"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Masukkan judul yang menarik dan informatif
                            </small>
                        </div>

                        <!-- Photo Upload Field -->
                        <div class="mb-4">
                            <label class="form-label font-weight-bold">
                                <i class="fas fa-image text-danger mr-1"></i>Foto/Gambar Pengumuman
                                <span class="text-danger">*</span>
                            </label>
                            <label for="photo" class="upload-zone-premium mb-0">
                                <div class="upload-zone-icon" style="background: rgba(239, 68, 68, 0.08); color: var(--dash-danger);">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div>
                                    <div class="upload-zone-text" id="fileLabel">Klik untuk memilih gambar atau seret ke sini</div>
                                    <div class="upload-zone-hint">Format: JPG, JPEG, PNG, WEBP, GIF, HEIC — Otomatis dikompres dengan kualitas terbaik. Rekomendasi: 1200x630px</div>
                                </div>
                                <input type="file" 
                                       class="d-none @error('photo') is-invalid @enderror" 
                                       id="photo" 
                                       name="photo" 
                                       accept="image/*,.heic,.heif"
                                       onchange="previewImage(event)"
                                       required>
                            </label>
                            @error('photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <label class="font-weight-bold text-dark mb-2">
                                    <i class="fas fa-eye mr-1"></i>Preview:
                                </label>
                                <div class="preview-container">
                                    <img id="preview" src="" alt="Preview" class="img-thumbnail">
                                    <button type="button" class="btn btn-sm btn-danger remove-preview" onclick="removePreview()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Link Field -->
                        <div class="mb-4">
                            <label for="link" class="form-label font-weight-bold">
                                <i class="fas fa-link text-danger mr-1"></i>Link Terkait
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">
                                    <i class="fas fa-globe"></i>
                                </span>
                                <input type="url" 
                                       class="form-control @error('link') is-invalid @enderror" 
                                       id="link" 
                                       name="link" 
                                       value="{{ old('link') }}"
                                       placeholder="https://example.com/pendaftaran"
                                       required>
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>URL lengkap untuk info lebih lanjut atau pendaftaran
                            </small>
                        </div>

                        <!-- Description Field with Trix Editor -->
                        <div class="mb-4">
                            <label for="description" class="form-label font-weight-bold">
                                <i class="fas fa-align-left text-danger mr-1"></i>Deskripsi Pengumuman
                                <span class="text-danger">*</span>
                            </label>
                            <div class="trix-wrapper">
                                <input id="description" 
                                       type="hidden" 
                                       name="description" 
                                       value="{{ old('description') }}"
                                       required>
                                <trix-editor input="description" 
                                             placeholder="Tuliskan detail pengumuman, informasi penting, syarat, tanggal, atau hal lain yang perlu diketahui..."></trix-editor>
                            </div>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Gunakan editor untuk memformat teks dengan rapi (bold, italic, list, dll)
                            </small>
                        </div>

                        <!-- Alert Info -->
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-lightbulb mr-2"></i>
                            <strong>Tips:</strong> Pastikan gambar berkualitas baik dan deskripsi jelas agar pengumuman menarik perhatian.
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                            <a href="{{ route('ads.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="fas fa-save mr-2"></i>Simpan Pengumuman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Image Preview Function
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            const fileLabel = document.getElementById('fileLabel');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block';
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
            const fileLabel = document.getElementById('fileLabel');
            if (fileLabel) {
                fileLabel.innerHTML = 'Klik untuk memilih gambar atau seret ke sini';
            }
        }
    </script>

    <style>
        .form-label {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-control-lg {
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
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

        /* Image Preview Styling */
        .preview-container {
            position: relative;
            display: inline-block;
            max-width: 100%;
        }

        .preview-container img {
            max-width: 100%;
            max-height: 400px;
            border-radius: 0.5rem;
            object-fit: contain;
        }

        .remove-preview {
            position: absolute;
            top: 10px;
            right: 10px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        /* Trix Editor Styling */
        .trix-wrapper {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .trix-wrapper:focus-within {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
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
            background-color: #dc3545;
            color: white;
            border-color: #dc3545;
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

        /* Input Group Styling */
        .input-group-text {
            background-color: #f8f9fa;
            border-color: #ced4da;
        }

        .input-group:focus-within .input-group-text {
            border-color: #dc3545;
        }
    </style>
</x-app-layout>