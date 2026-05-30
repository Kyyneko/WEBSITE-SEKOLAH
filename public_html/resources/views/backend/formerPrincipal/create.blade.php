<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">{{ __('Tambah Mantan Kepala Sekolah') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Error Message Alert --}}
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-md shadow-sm">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle text-red-500 text-lg mr-3"></i>
                        <span class="text-sm font-bold text-red-800">Mohon perbaiki kesalahan berikut:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Header Card --}}
            <div class="dash-header-card mb-4">
                <div class="dash-header-card-content">
                    <div class="dash-header-card-icon"><i class="fas fa-plus text-white"></i></div>
                    <div>
                        <h3 class="dash-header-card-title">Tambah Mantan Kepala Sekolah</h3>
                        <p class="dash-header-card-desc">Tambahkan mantan kepala sekolah baru lengkap dengan nama, periode jabatan, dan foto profil.</p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            {{-- Card Container --}}
            <div class="bg-white overflow-hidden shadow-md rounded-xl border border-gray-100">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('former-principals.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            {{-- Nama Lengkap --}}
                            <div class="col-md-6">
                                <label for="name" class="block text-xs font-bold text-gray-600 uppercase mb-2">Nama Lengkap & Gelar <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Drs. H. Budi Santoso, M.Pd" required>
                                </div>
                            </div>

                            {{-- Masa Jabatan / Periode --}}
                            <div class="col-md-6">
                                <label for="period" class="block text-xs font-bold text-gray-600 uppercase mb-2">Masa Jabatan (Periode) <span class="text-red-500">*</span></label>
                                <input type="text" id="period" name="period" value="{{ old('period') }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: 2018 - 2022" required>
                                <p class="text-xxs text-gray-400 mt-1"><i class="fas fa-info-circle mr-1"></i>Akan ditampilkan secara teratur di halaman profil sekolah.</p>
                            </div>

                            {{-- Foto Profil (Premium Dropzone) --}}
                            <div class="col-12 mt-3">
                                <label class="block text-xs font-bold text-gray-600 uppercase mb-2">Foto Profil Mantan Kepala Sekolah</label>
                                <label for="photo" class="upload-zone-premium mb-0 w-full d-flex flex-column align-items-center justify-content-center border-dashed py-4 bg-slate-50 cursor-pointer rounded-lg" style="border: 2px dashed #cbd5e1;">
                                    <div class="upload-zone-icon text-blue-500 mb-2" style="font-size: 1.8rem;">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <div>
                                        <div class="upload-zone-text font-semibold text-slate-700 text-sm text-center" id="fileLabel">Klik untuk memilih gambar atau seret ke sini</div>
                                        <div class="upload-zone-hint text-slate-400 text-xxs text-center mt-1">Format: JPG, JPEG, PNG, WEBP, HEIC — Otomatis dikompres dengan kualitas terbaik.</div>
                                    </div>
                                    <input type="file" 
                                           class="d-none" 
                                           id="photo" 
                                           name="photo" 
                                           accept="image/*,.heic,.heif"
                                           onchange="previewImage(event)">
                                </label>
                                @error('photo')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Image Preview Container --}}
                            <div class="col-12 mt-3" id="imagePreviewContainer" style="display: none;">
                                <label class="block text-xs font-bold text-gray-600 uppercase mb-2"><i class="fas fa-eye mr-1"></i>Preview Foto Yang Dipilih</label>
                                <div class="w-40 h-48 border rounded-lg bg-gray-50 flex items-center justify-center overflow-hidden shadow-sm relative group">
                                    <img id="preview" src="" class="w-full h-full object-cover">
                                    <button type="button" class="btn btn-sm btn-danger position-absolute" style="top: 8px; right: 8px; border-radius: 50%; width: 28px; height: 28px; padding: 0; display: flex; align-items: center; justify-content: center;" onclick="removePreview()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-8 pt-4 border-t border-gray-100 flex items-center justify-end space-x-3">
                            <a href="{{ route('former-principals.index') }}" class="py-2 px-5 text-sm font-semibold text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors flex items-center">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="py-2 px-6 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow-md hover:shadow-lg transition-all flex items-center">
                                <i class="fas fa-save mr-2"></i>Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    {{-- File upload helper script --}}
    @push('scripts')
    <script>
        function previewImage(event) {
            const input = event.target;
            const fileLabel = document.getElementById('fileLabel');
            const previewContainer = document.getElementById('imagePreviewContainer');
            const previewImage = document.getElementById('preview');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                fileLabel.textContent = file.name;

                // Preview photo
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }

        function removePreview() {
            const input = document.getElementById('photo');
            const fileLabel = document.getElementById('fileLabel');
            const previewContainer = document.getElementById('imagePreviewContainer');
            const previewImage = document.getElementById('preview');

            input.value = '';
            fileLabel.textContent = 'Klik untuk memilih gambar atau seret ke sini';
            previewImage.src = '';
            previewContainer.style.display = 'none';
        }
    </script>
    @endpush
</x-app-layout>
