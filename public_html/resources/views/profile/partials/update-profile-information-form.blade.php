<section>
    <header class="mb-4">
        <h2 class="text-lg font-weight-bold text-gray-900">
            <i class="fas fa-user-circle text-primary mr-2"></i>{{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Name Field -->
        <div class="form-group">
            <x-input-label for="name" :value="__('Name')" class="font-weight-bold">
                <i class="fas fa-user mr-1 text-primary"></i>
            </x-input-label>
            <x-text-input id="name" name="name" type="text" 
                class="mt-1 block w-full form-control" 
                :value="old('name', $user->name)"
                required autofocus autocomplete="name" 
                placeholder="Masukkan nama lengkap" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- NIK Field -->
        <div class="form-group">
            <x-input-label for="nik" :value="__('NIK')" class="font-weight-bold">
                <i class="fas fa-id-card mr-1 text-primary"></i>
            </x-input-label>
            <x-text-input id="nik" name="nik" type="text" 
                class="mt-1 block w-full form-control" 
                :value="old('nik', $user->nik)"
                autocomplete="nik" 
                placeholder="Nomor Induk Kependudukan" />
            <x-input-error class="mt-2" :messages="$errors->get('nik')" />
        </div>

        <!-- NIP Field -->
        <div class="form-group">
            <x-input-label for="nip" :value="__('NIP')" class="font-weight-bold">
                <i class="fas fa-id-badge mr-1 text-primary"></i>
            </x-input-label>
            <x-text-input id="nip" name="nip" type="text" 
                class="mt-1 block w-full form-control" 
                :value="old('nip', $user->nip)"
                autocomplete="nip" 
                placeholder="Nomor Induk Pegawai" />
            <x-input-error class="mt-2" :messages="$errors->get('nip')" />
        </div>

        <!-- TTL Field -->
        <div class="form-group">
            <x-input-label for="ttl" :value="__('Tempat, Tanggal Lahir')" class="font-weight-bold">
                <i class="fas fa-birthday-cake mr-1 text-primary"></i>
            </x-input-label>
            <x-text-input id="ttl" name="ttl" type="text" 
                class="mt-1 block w-full form-control" 
                :value="old('ttl', $user->ttl)"
                autocomplete="ttl" 
                placeholder="Contoh: Jakarta, 01 Januari 1990" />
            <x-input-error class="mt-2" :messages="$errors->get('ttl')" />
            <small class="form-text text-muted">
                <i class="fas fa-info-circle mr-1"></i>Format: Tempat Lahir, Tanggal Bulan Tahun
            </small>
        </div>

        <!-- Phone Field -->
        <div class="form-group">
            <x-input-label for="phone" :value="__('No. Telepon')" class="font-weight-bold">
                <i class="fas fa-phone mr-1 text-primary"></i>
            </x-input-label>
            <x-text-input id="phone" name="phone" type="text" 
                class="mt-1 block w-full form-control" 
                :value="old('phone', $user->phone)" 
                placeholder="08xxxxxxxxxx" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>
        
        <!-- Role Field (Admin Only) -->
        @if($user->role === 'admin')
        <div class="form-group">
            <x-input-label for="role" :value="__('Role')" class="font-weight-bold">
                <i class="fas fa-user-tag mr-1 text-primary"></i>
            </x-input-label>
            <select id="role" name="role" class="mt-1 block w-full form-control">
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                    <i class="fas fa-shield-alt"></i> Administrator
                </option>
                <option value="teacher" {{ old('role', $user->role) === 'teacher' ? 'selected' : '' }}>
                    <i class="fas fa-chalkboard-teacher"></i> Guru
                </option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('role')" />
        </div>
        @endif
        
        <!-- Subject Field -->
        <div class="form-group">
            <x-input-label for="subject" :value="__('Mata Pelajaran')" class="font-weight-bold">
                <i class="fas fa-book mr-1 text-primary"></i>
            </x-input-label>
            <div class="mt-2 p-3 bg-light rounded border">
                @isset($user->subject)
                    <div class="d-flex align-items-center">
                        <div class="subject-icon bg-success text-white mr-3">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div>
                            <span class="font-weight-medium d-block">{{ $user->subject->name }}</span>
                            <small class="text-muted">
                                <i class="fas fa-check-circle mr-1"></i>Mata pelajaran yang diampu
                            </small>
                        </div>
                    </div>
                @else
                    <div class="text-center text-muted py-2">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span>Belum ada mata pelajaran yang ditugaskan</span>
                    </div>
                @endisset
            </div>
        </div>

        <!-- Email Field (Hidden) -->
        <div class="d-none">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" 
                class="mt-1 block w-full form-control" 
                :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Photo Field -->
        <div class="form-group">
            <x-input-label for="photo" :value="__('Foto Profile')" class="font-weight-bold">
                <i class="fas fa-camera mr-1 text-primary"></i>
            </x-input-label>
            
            <div class="custom-file mt-2">
                <input id="photo" name="photo" type="file" 
                    class="custom-file-input @error('photo') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/jpg"
                    onchange="previewPhoto(event)">
                <label class="custom-file-label" for="photo" id="photoLabel">
                    <i class="fas fa-cloud-upload-alt mr-2"></i>Pilih foto baru...
                </label>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
            <small class="form-text text-muted">
                <i class="fas fa-info-circle mr-1"></i>Format: JPG, PNG. Maksimal 2MB
            </small>

            @if ($user->photo_path)
                <div class="mt-3">
                    <label class="font-weight-bold d-block mb-2">
                        <i class="fas fa-image mr-1 text-success"></i>Foto Saat Ini:
                    </label>
                    
                    @php
                        $photoPath = $user->photo_path;
                        
                        // Handle multiple path formats
                        if (str_starts_with($photoPath, 'public/photos/')) {
                            $imageUrl = asset('storage/' . str_replace('public/', '', $photoPath));
                        } elseif (str_starts_with($photoPath, 'public/image/')) {
                            $imageUrl = asset(str_replace('public/', '', $photoPath));
                        } elseif (str_starts_with($photoPath, 'photos/')) {
                            $imageUrl = asset('storage/' . $photoPath);
                        } elseif (str_starts_with($photoPath, 'image/')) {
                            $imageUrl = asset($photoPath);
                        } else {
                            $imageUrl = asset('storage/' . $photoPath);
                        }
                    @endphp
                    
                    <div class="current-photo-wrapper">
                        <img src="{{ $imageUrl }}" 
                             alt="Current Photo"
                             id="currentPhoto"
                             class="rounded shadow"
                             onerror="this.src='{{ asset('image/default-avatar.png') }}'; this.classList.add('error-photo');">
                        <div class="photo-info mt-2">
                            <small class="text-muted d-block">
                                <i class="fas fa-file mr-1"></i>
                                {{ basename($user->photo_path) }}
                            </small>
                        </div>
                    </div>
                </div>

                <!-- New Photo Preview -->
                <div id="newPhotoPreview" class="mt-3" style="display: none;">
                    <label class="font-weight-bold d-block mb-2">
                        <i class="fas fa-eye mr-1 text-warning"></i>Preview Foto Baru:
                    </label>
                    <div class="new-photo-wrapper">
                        <img id="previewImage" src="" alt="Preview" class="rounded shadow">
                        <div class="badge badge-warning mt-2">
                            <i class="fas fa-exclamation-triangle mr-1"></i>Belum disimpan
                        </div>
                    </div>
                </div>
            @else
                <!-- No Photo - Show Preview Only -->
                <div id="newPhotoPreview" class="mt-3" style="display: none;">
                    <label class="font-weight-bold d-block mb-2">
                        <i class="fas fa-eye mr-1 text-success"></i>Preview Foto:
                    </label>
                    <div class="new-photo-wrapper">
                        <img id="previewImage" src="" alt="Preview" class="rounded shadow">
                    </div>
                </div>
            @endif
        </div>

        <!-- Save Button -->
        <div class="d-flex align-items-center gap-3 mt-4 pt-3 border-top">
            <x-primary-button class="btn btn-primary btn-lg">
                <i class="fas fa-save mr-2"></i>{{ __('Simpan Perubahan') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                    class="alert alert-success mb-0 py-2 px-3">
                    <i class="fas fa-check-circle mr-2"></i>{{ __('Perubahan berhasil disimpan!') }}
                </p>
            @endif
        </div>
    </form>
</section>

<script>
function previewPhoto(event) {
    const file = event.target.files[0];
    const label = document.getElementById('photoLabel');
    const preview = document.getElementById('newPhotoPreview');
    const previewImg = document.getElementById('previewImage');
    
    if (file) {
        // Update label
        label.innerHTML = '<i class="fas fa-image mr-2"></i>' + file.name;
        
        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
            
            // Scroll to preview
            preview.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        };
        reader.readAsDataURL(file);
    } else {
        label.innerHTML = '<i class="fas fa-cloud-upload-alt mr-2"></i>Pilih foto baru...';
        preview.style.display = 'none';
    }
}
</script>

<style>
/* Form Styling */
.form-group {
    margin-bottom: 1.5rem;
}

.form-control {
    border-radius: 0.375rem;
    border: 1px solid #d1d5db;
    padding: 0.625rem 0.875rem;
    font-size: 0.95rem;
    transition: all 0.2s;
}

.form-control:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
}

/* Label with Icons */
label {
    color: #374151;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

label i {
    font-size: 0.9rem;
}

/* Subject Display */
.subject-icon {
    width: 45px;
    height: 45px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
}

/* Photo Wrapper */
.current-photo-wrapper img,
.new-photo-wrapper img {
    width: 200px;
    height: 200px;
    object-fit: cover;
    border: 3px solid #e5e7eb;
    transition: all 0.3s ease;
}

.current-photo-wrapper img:hover,
.new-photo-wrapper img:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    border-color: #3b82f6;
}

.error-photo {
    opacity: 0.5;
    filter: grayscale(100%);
}

.photo-info {
    max-width: 200px;
}

/* Custom File Input */
.custom-file-label {
    border-radius: 0.375rem;
    border: 1px solid #d1d5db;
    padding: 0.625rem 0.875rem;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.2s;
}

.custom-file-label:hover {
    border-color: #3b82f6;
    background-color: #f9fafb;
}

.custom-file-label::after {
    content: "Browse";
    background-color: #3b82f6;
    border-color: #3b82f6;
    color: white;
    border-radius: 0.375rem;
    padding: 0.625rem 1.25rem;
    transition: all 0.2s;
}

.custom-file-label:hover::after {
    background-color: #2563eb;
}

.custom-file-input.is-invalid ~ .custom-file-label {
    border-color: #ef4444;
}

/* New Photo Preview Badge */
.new-photo-wrapper {
    position: relative;
    display: inline-block;
}

.new-photo-wrapper .badge {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 0.75rem;
    padding: 0.4rem 0.7rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Alert Success */
.alert-success {
    background-color: #d1fae5;
    border-color: #6ee7b7;
    color: #065f46;
    border-radius: 0.5rem;
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Button Styling */
.btn-primary {
    background-color: #3b82f6;
    border-color: #3b82f6;
    color: white;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    border-radius: 0.5rem;
    transition: all 0.2s;
}

.btn-primary:hover {
    background-color: #2563eb;
    border-color: #2563eb;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
}

/* Border Top */
.border-top {
    border-top: 2px solid #e5e7eb !important;
}

/* Gap Utility */
.gap-3 {
    gap: 1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .current-photo-wrapper img,
    .new-photo-wrapper img {
        width: 150px;
        height: 150px;
    }

    .btn-lg {
        padding: 0.6rem 1.2rem;
        font-size: 0.95rem;
    }
}
</style>