<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Ad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="mb-4 pb-3 border-bottom">
                        <h3 class="text-2xl font-weight-bold text-dark mb-1">
                            <i class="fas fa-ad text-warning mr-2"></i>Edit Iklan
                        </h3>
                        <p class="text-muted mb-0">Perbarui informasi iklan <strong>{{ $ad->title }}</strong></p>
                    </div>

                    <form action="{{ route('ads.update', $ad->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Title Field -->
                        <div class="mb-4">
                            <label for="title" class="form-label font-weight-bold">
                                <i class="fas fa-heading text-primary mr-1"></i>Judul Iklan
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title"
                                   value="{{ old('title', $ad->title) }}" 
                                   placeholder="Masukkan judul iklan"
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
                                <i class="fas fa-info-circle mr-1"></i>URL lengkap tempat iklan akan mengarahkan pengguna
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
                                <trix-editor input="description" placeholder="Tuliskan deskripsi iklan yang menarik..."></trix-editor>
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
                            <label for="photo" class="form-label font-weight-bold">
                                <i class="fas fa-image text-primary mr-1"></i>Foto Iklan
                            </label>
                            <input type="file" 
                                   class="form-control form-control-lg @error('photo') is-invalid @enderror" 
                                   id="photo" 
                                   name="photo"
                                   accept="image/*">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            @if ($ad->photo_path)
                                <div class="mt-3 p-3 border rounded bg-light">
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-eye mr-1"></i>Foto saat ini:
                                    </p>
                                    <img src="{{ asset('storage/' . $ad->photo_path) }}" 
                                         alt="Current Photo"
                                         class="img-thumbnail"
                                         style="max-width: 300px; max-height: 200px; object-fit: cover;">
                                </div>
                            @endif
                            
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Upload foto baru jika ingin mengganti. Format: JPG, PNG, maksimal 2MB
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
                                <i class="fas fa-save mr-2"></i>Update Iklan
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
</x-app-layout>
