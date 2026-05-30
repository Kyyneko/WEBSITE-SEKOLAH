<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Subject') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Page Header Card --}}
            <div class="dash-header-card mb-4">
                <div class="dash-header-card-content">
                    <div class="dash-header-card-icon">
                        <i class="fas fa-book text-white"></i>
                    </div>
                    <div>
                        <h3 class="dash-header-card-title">Edit Mata Pelajaran</h3>
                        <p class="dash-header-card-desc">Perbarui informasi mata pelajaran: <strong>{{ $subject->name }}</strong></p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">

                    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Subject Name Field -->
                        <div class="mb-4">
                            <label for="name" class="form-label font-weight-bold">
                                <i class="fas fa-book text-success mr-1"></i>Nama Mata Pelajaran
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $subject->name) }}"
                                   placeholder="Contoh: Matematika, Bahasa Indonesia, Fisika"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Masukkan nama mata pelajaran dengan jelas
                            </small>
                        </div>

                        <!-- Description Field with Trix Editor -->
                        <div class="mb-4">
                            <label for="description" class="form-label font-weight-bold">
                                <i class="fas fa-align-left text-success mr-1"></i>Deskripsi
                                <span class="text-danger">*</span>
                            </label>
                            <div class="trix-wrapper">
                                <textarea id="description" 
                                          name="description" 
                                          class="form-control @error('description') is-invalid @enderror" 
                                          style="display:none;"
                                          required>{{ old('description', $subject->description) }}</textarea>
                                <trix-editor input="description" 
                                             placeholder="Tuliskan deskripsi mata pelajaran, tujuan pembelajaran, atau informasi penting lainnya..."></trix-editor>
                            </div>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Gunakan editor untuk memformat teks dengan rapi (bold, italic, list, dll)
                            </small>
                        </div>

                        <!-- Alert Warning -->
                        <div class="alert alert-warning" role="alert">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Perhatian:</strong> Pastikan perubahan yang Anda buat sudah benar sebelum menyimpan.
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                            <a href="{{ route('subjects.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning btn-lg text-white">
                                <i class="fas fa-save mr-2"></i>Update Mata Pelajaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
    </style>
</x-app-layout>