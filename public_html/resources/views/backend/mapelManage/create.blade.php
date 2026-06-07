<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Subject') }}
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
                        <h3 class="dash-header-card-title">Tambah Mata Pelajaran</h3>
                        <p class="dash-header-card-desc">Lengkapi form di bawah untuk menambahkan mata pelajaran baru ke sistem</p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">

                    <form action="{{ route('subjects.store') }}" method="POST">
                        @csrf
                        
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
                                   value="{{ old('name') }}"
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
                                          required>{{ old('description') }}</textarea>
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

                        <!-- Alert Info -->
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-lightbulb mr-2"></i>
                            <strong>Tips:</strong> Deskripsi yang baik mencakup tujuan pembelajaran, materi yang akan dipelajari, dan manfaat mata pelajaran ini.
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                            <a href="{{ route('subjects.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save mr-2"></i>Simpan Mata Pelajaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Trix Editor Styling */
        .trix-wrapper {
            border: 1.5px solid var(--dash-border);
            border-radius: var(--dash-radius-sm);
            transition: all 0.2s ease;
            background-color: #fff;
            overflow: hidden;
        }

        .trix-wrapper:focus-within {
            border-color: var(--dash-primary-light) !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12) !important;
        }

        trix-editor {
            min-height: 250px;
            max-height: 500px;
            overflow-y: auto;
            padding: 0.75rem;
            border: none;
            color: var(--dash-text) !important;
            font-size: 0.9rem !important;
        }

        trix-toolbar {
            border: none;
            border-bottom: 1px solid var(--dash-border);
            background-color: #f8fafc;
            padding: 0.5rem;
        }

        trix-toolbar .trix-button-group {
            margin-bottom: 0;
        }

        trix-toolbar .trix-button {
            border-color: var(--dash-border) !important;
            background-color: white;
            margin: 0 2px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        trix-toolbar .trix-button:hover {
            background-color: #f1f5f9;
        }

        trix-toolbar .trix-button.trix-active {
            background-color: var(--dash-primary-light) !important;
            color: white !important;
            border-color: var(--dash-primary-light) !important;
        }

        trix-editor:empty:not(:focus)::before {
            color: var(--dash-text-light) !important;
        }

        /* Custom scrollbar for trix editor */
        trix-editor::-webkit-scrollbar {
            width: 8px;
        }
        
        trix-editor::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        
        trix-editor::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        
        trix-editor::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</x-app-layout>