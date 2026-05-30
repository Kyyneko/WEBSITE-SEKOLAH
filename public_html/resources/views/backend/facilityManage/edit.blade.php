<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Fasilitas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Page Header Card --}}
            <div class="dash-header-card mb-4">
                <div class="dash-header-card-content">
                    <div class="dash-header-card-icon">
                        <i class="fas fa-edit text-white"></i>
                    </div>
                    <div>
                        <h3 class="dash-header-card-title">Edit Fasilitas</h3>
                        <p class="dash-header-card-desc">Perbarui data sarana atau prasarana sekolah yang sudah ada</p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">

                    <form action="{{ route('facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Name Field -->
                        <div class="mb-4">
                            <label for="name" class="form-label font-weight-bold">
                                <i class="fas fa-heading text-primary mr-1"></i>Nama Fasilitas
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $facility->name) }}"
                                   placeholder="Contoh: Laboratorium Komputer, Lapangan Basket"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category Field -->
                        <div class="mb-4">
                            <label for="category" class="form-label font-weight-bold">
                                <i class="fas fa-tags text-primary mr-1"></i>Kategori
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-control-lg @error('category') is-invalid @enderror" 
                                    id="category" 
                                    name="category" 
                                    required>
                                <option value="" disabled>Pilih Kategori Fasilitas</option>
                                <option value="Akademik" {{ old('category', $facility->category) == 'Akademik' ? 'selected' : '' }}>Akademik (Ruang Kelas, Lab IPA, Perpustakaan)</option>
                                <option value="Teknologi" {{ old('category', $facility->category) == 'Teknologi' ? 'selected' : '' }}>Teknologi (Lab Komputer, Multimedia)</option>
                                <option value="Olahraga" {{ old('category', $facility->category) == 'Olahraga' ? 'selected' : '' }}>Olahraga (Lapangan, Gym)</option>
                                <option value="Ibadah" {{ old('category', $facility->category) == 'Ibadah' ? 'selected' : '' }}>Ibadah (Musholla, Masjid)</option>
                                <option value="Pendukung" {{ old('category', $facility->category) == 'Pendukung' ? 'selected' : '' }}>Pendukung (Kantin, Toilet, UKS)</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Features Field -->
                        <div class="mb-4">
                            <label for="features" class="form-label font-weight-bold">
                                <i class="fas fa-list-ul text-primary mr-1"></i>Fitur / Spesifikasi Penunjang
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('features') is-invalid @enderror" 
                                   id="features" 
                                   name="features" 
                                   value="{{ old('features', is_array($facility->features) ? implode(', ', $facility->features) : '') }}"
                                   placeholder="Contoh: AC, Proyektor LCD, 32 Unit PC (Pisahkan dengan koma)">
                            @error('features')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Masukkan fitur penunjang dipisahkan dengan tanda koma (`,`)
                            </small>
                        </div>

                        <!-- Photo Upload Field -->
                        <div class="mb-4">
                            <label class="form-label font-weight-bold">
                                <i class="fas fa-image text-primary mr-1"></i>Foto Fasilitas
                            </label>
                            <label for="photo" class="upload-zone-premium mb-0">
                                <div class="upload-zone-icon" style="background: rgba(37, 99, 235, 0.08); color: #2563eb;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div>
                                    <div class="upload-zone-text" id="fileLabel">Klik untuk mengganti gambar atau seret ke sini</div>
                                    <div class="upload-zone-hint">Format: JPG, JPEG, PNG, WEBP, HEIC — Otomatis dikompres dengan kualitas terbaik. Rekomendasi: Rasio 4:3 atau 16:9</div>
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
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-3" style="{{ $facility->photo_path ? 'display: block;' : 'display: none;' }}">
                                <label class="font-weight-bold text-dark mb-2">
                                    <i class="fas fa-eye mr-1"></i>Preview:
                                </label>
                                <div class="preview-container">
                                    <img id="preview" 
                                         src="{{ $facility->photo_path ? asset('storage/' . str_replace('public/', '', $facility->photo_path)) : '' }}" 
                                         alt="Preview" 
                                         class="img-thumbnail">
                                    <button type="button" class="btn btn-sm btn-danger remove-preview" onclick="removePreview()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div class="mb-4">
                            <label for="description" class="form-label font-weight-bold">
                                <i class="fas fa-align-left text-primary mr-1"></i>Deskripsi Fasilitas
                                <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="5"
                                      placeholder="Tuliskan deskripsi lengkap tentang fasilitas ini..."
                                      required>{{ old('description', $facility->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                            <a href="{{ route('facilities.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save mr-2"></i>Simpan Perubahan
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

        .form-control:focus, .form-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }

        .gap-2 {
            gap: 0.5rem;
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
            max-height: 300px;
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
    </style>
</x-app-layout>
