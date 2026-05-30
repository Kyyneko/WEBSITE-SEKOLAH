<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Organisasi') }}
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
                        <h3 class="dash-header-card-title">Edit Organisasi</h3>
                        <p class="dash-header-card-desc">Perbarui informasi organisasi: <strong>{{ $organisasi->nama }}</strong></p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">

                    <form action="{{ route('organisasi.update', $organisasi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Nama Organisasi Field -->
                        <div class="mb-4">
                            <label for="name" class="form-label font-weight-bold">
                                <i class="fas fa-sitemap text-primary mr-1"></i>Nama Organisasi
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name"
                                   value="{{ old('name', $organisasi->nama) }}" 
                                   placeholder="Masukkan nama organisasi"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Masukkan nama organisasi dengan jelas
                            </small>
                        </div>

                        <!-- Description Field with Trix Editor -->
                        <div class="mb-4">
                            <label for="description" class="form-label font-weight-bold">
                                <i class="fas fa-align-left text-primary mr-1"></i>Deskripsi
                                <span class="text-danger">*</span>
                            </label>
                            <div class="trix-wrapper">
                                <input id="description" type="hidden" name="description" value="{{ old('description', $organisasi->description) }}">
                                <trix-editor input="description" placeholder="Tuliskan deskripsi organisasi, visi misi, kegiatan, atau informasi penting lainnya..."></trix-editor>
                            </div>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Gunakan editor untuk memformat teks dengan rapi (bold, italic, list, dll)
                            </small>
                        </div>

                        <!-- Existing Photos Section -->
                        @if ($organisasi->photo_path)
                            @php
                                $photos = json_decode($organisasi->photo_path);
                                $hasPhotos = is_array($photos) && count($photos) > 0;
                            @endphp
                            
                            @if($hasPhotos)
                                <div class="mb-4">
                                    <label class="form-label font-weight-bold">
                                        <i class="fas fa-images text-primary mr-1"></i>Foto Saat Ini
                                        <span class="badge badge-info ml-2">{{ count($photos) }} foto</span>
                                    </label>
                                    <div class="existing-photos-container p-3 border rounded bg-light">
                                        <div class="row">
                                            @foreach ($photos as $index => $photo)
                                                @php
                                                    // Handle multiple path formats
                                                    if (str_starts_with($photo, 'public/organisasi_photos/')) {
                                                        $imageUrl = asset('storage/' . str_replace('public/', '', $photo));
                                                    } elseif (str_starts_with($photo, 'public/image/')) {
                                                        $imageUrl = asset(str_replace('public/', '', $photo));
                                                    } elseif (str_starts_with($photo, 'organisasi_photos/')) {
                                                        $imageUrl = asset('storage/' . $photo);
                                                    } elseif (str_starts_with($photo, 'image/')) {
                                                        $imageUrl = asset($photo);
                                                    } else {
                                                        $imageUrl = asset('storage/' . $photo);
                                                    }
                                                @endphp
                                                
                                                <div class="col-md-4 col-sm-6 mb-3">
                                                    <div class="photo-item card shadow-sm">
                                                        <div class="photo-wrapper">
                                                            <img src="{{ $imageUrl }}" 
                                                                 alt="Photo {{ $index + 1 }}"
                                                                 class="card-img-top photo-img"
                                                                 data-toggle="modal"
                                                                 data-target="#previewModal{{ $index }}"
                                                                 onerror="this.src='{{ asset('image/placeholder-org.png') }}'; this.classList.add('error-image');">
                                                            <div class="photo-overlay">
                                                                <i class="fas fa-search-plus fa-2x text-white"></i>
                                                            </div>
                                                            <span class="photo-number badge badge-primary">
                                                                <i class="fas fa-image mr-1"></i>#{{ $index + 1 }}
                                                            </span>
                                                        </div>
                                                        <div class="card-body p-2">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" 
                                                                       class="custom-control-input delete-checkbox" 
                                                                       id="delete_photo_{{ $index }}" 
                                                                       name="delete_photos[]" 
                                                                       value="{{ $photo }}"
                                                                       onchange="updateDeleteCount()">
                                                                <label class="custom-control-label text-danger small" for="delete_photo_{{ $index }}">
                                                                    <i class="fas fa-trash mr-1"></i>Hapus foto ini
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Preview Modal -->
                                                <div class="modal fade" id="previewModal{{ $index }}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title">
                                                                    <i class="fas fa-image mr-2"></i>Preview Foto #{{ $index + 1 }}
                                                                </h5>
                                                                <button type="button" class="close text-white" data-dismiss="modal">
                                                                    <span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center p-0" style="background: #000;">
                                                                <img src="{{ $imageUrl }}" 
                                                                     alt="Preview" 
                                                                     class="img-fluid"
                                                                     style="max-height: 80vh;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        <!-- Delete Counter -->
                                        <div id="deleteCounter" class="alert alert-danger mt-3" style="display: none;">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            <strong><span id="deleteCount">0</span> foto</strong> akan dihapus
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>Centang foto yang ingin dihapus. Klik foto untuk melihat preview ukuran penuh
                                    </small>
                                </div>
                            @endif
                        @endif

                        <!-- New Photos Field -->
                        <div class="mb-4">
                            <label class="form-label font-weight-bold">
                                <i class="fas fa-upload text-primary mr-1"></i>Tambah Foto Baru
                            </label>
                            <label for="new_photo" class="upload-zone-premium mb-0">
                                <div class="upload-zone-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div>
                                    <div class="upload-zone-text" id="fileLabel">Klik untuk memilih gambar atau seret ke sini</div>
                                    <div class="upload-zone-hint">Format: JPG, JPEG, PNG, WEBP, HEIC — Otomatis dikompres dengan kualitas terbaik (Bisa memilih beberapa foto sekaligus)</div>
                                </div>
                                <input type="file" 
                                       class="d-none" 
                                       id="new_photo" 
                                       name="new_photo[]" 
                                       multiple
                                       accept="image/*,.heic,.heif"
                                       onchange="previewNewImages(event)">
                            </label>
                            @error('new_photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            @error('new_photo.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Upload satu atau lebih foto baru. Format: JPG, PNG, WEBP, HEIC. Maksimal 100MB per foto.
                            </small>
                            
                            <!-- New Images Preview Container -->
                            <div id="newImagePreview" class="mt-3" style="display: none;">
                                <div class="alert alert-success">
                                    <i class="fas fa-images mr-2"></i>
                                    <strong>Preview Foto Baru</strong> (<span id="newPhotoCount">0</span> foto dipilih)
                                </div>
                                <div id="newPreviewContainer" class="row"></div>
                            </div>
                        </div>

                        <!-- Alert Warning -->
                        <div class="alert alert-warning" role="alert">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Perhatian:</strong> Pastikan perubahan yang Anda buat sudah benar sebelum menyimpan.
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex flex-wrap gap-2 justify-content-end mt-4 pt-3 border-top">
                            <a href="{{ route('organisasi.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning btn-lg text-white">
                                <i class="fas fa-save mr-2"></i>Update Organisasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Update delete counter
        function updateDeleteCount() {
            const checkboxes = document.querySelectorAll('.delete-checkbox:checked');
            const count = checkboxes.length;
            const counter = document.getElementById('deleteCounter');
            const countSpan = document.getElementById('deleteCount');
            
            if (count > 0) {
                counter.style.display = 'block';
                countSpan.textContent = count;
            } else {
                counter.style.display = 'none';
            }
        }

        // Preview new images
        function previewNewImages(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('newPreviewContainer');
            const imagePreview = document.getElementById('newImagePreview');
            const fileLabel = document.getElementById('fileLabel');
            const photoCount = document.getElementById('newPhotoCount');
            
            // Clear previous previews
            previewContainer.innerHTML = '';
            
            if (files.length > 0) {
                imagePreview.style.display = 'block';
                photoCount.textContent = files.length;
                
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
                            col.className = 'col-md-4 col-sm-6 mb-3';
                            
                            const card = document.createElement('div');
                            card.className = 'card shadow-sm border-success';
                            
                            const wrapper = document.createElement('div');
                            wrapper.className = 'photo-wrapper';
                            
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'card-img-top photo-img';
                            
                            const badge = document.createElement('span');
                            badge.className = 'photo-number badge badge-success';
                            badge.innerHTML = '<i class="fas fa-plus mr-1"></i>Baru #' + (index + 1);
                            
                            const cardBody = document.createElement('div');
                            cardBody.className = 'card-body p-2 bg-light';
                            
                            const fileName = document.createElement('small');
                            fileName.className = 'text-muted text-truncate d-block';
                            fileName.title = file.name;
                            fileName.innerHTML = '<i class="fas fa-file-image mr-1"></i>' + file.name;
                            
                            const fileSize = document.createElement('small');
                            fileSize.className = 'text-muted d-block';
                            fileSize.innerHTML = '<i class="fas fa-weight mr-1"></i>' + formatFileSize(file.size);
                            
                            wrapper.appendChild(img);
                            wrapper.appendChild(badge);
                            cardBody.appendChild(fileName);
                            cardBody.appendChild(fileSize);
                            card.appendChild(wrapper);
                            card.appendChild(cardBody);
                            col.appendChild(card);
                            previewContainer.appendChild(col);
                        };
                        
                        reader.readAsDataURL(file);
                    }
                });
            } else {
                imagePreview.style.display = 'none';
                fileLabel.innerHTML = '<i class="fas fa-cloud-upload-alt mr-2"></i>Pilih file gambar...';
            }
        }

        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
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

        /* Existing Photos Container */
        .existing-photos-container {
            background-color: #f8f9fa;
        }

        .photo-item {
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
        }

        .photo-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
        }

        /* Photo Wrapper with Overlay */
        .photo-wrapper {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .photo-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .photo-wrapper:hover .photo-img {
            transform: scale(1.1);
        }

        .photo-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .photo-wrapper:hover .photo-overlay {
            opacity: 1;
        }

        .photo-number {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
            font-size: 0.75rem;
            padding: 0.35rem 0.6rem;
        }

        .error-image {
            opacity: 0.5;
            filter: grayscale(100%);
        }

        .custom-control-label {
            cursor: pointer;
            user-select: none;
            font-size: 0.875rem;
        }

        .custom-control-input:checked ~ .custom-control-label {
            font-weight: 600;
        }

        /* Custom File Input */
        .custom-file-label {
            height: calc(2.875rem + 2px);
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }

        .custom-file-label::after {
            height: calc(2.875rem);
            padding: 0.75rem 1rem;
            background-color: #ffc107;
            border-color: #ffc107;
            color: white;
            content: "Browse";
        }

        /* New Preview Cards */
        #newPreviewContainer .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        #newPreviewContainer .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3) !important;
        }

        .border-success {
            border-width: 2px !important;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.35rem 0.6rem;
            font-weight: 600;
        }

        /* Delete Counter Animation */
        #deleteCounter {
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .photo-img {
                height: 150px;
            }

            .btn-lg {
                padding: 0.6rem 1.2rem;
                font-size: 0.95rem;
            }
        }
    </style>
</x-app-layout>
