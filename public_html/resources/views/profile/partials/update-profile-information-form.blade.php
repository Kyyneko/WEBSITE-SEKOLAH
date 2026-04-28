<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="profile-form" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-group mb-3">
            <label for="name" class="profile-label"><i class="fas fa-user me-1"></i>Nama</label>
            <input id="name" name="name" type="text" class="form-control" 
                   value="{{ old('name', $user->name) }}" required autofocus placeholder="Nama lengkap">
            <x-input-error class="mt-1" :messages="$errors->get('name')" />
        </div>

        <div class="form-group mb-3">
            <label for="nik" class="profile-label"><i class="fas fa-id-card me-1"></i>NIK</label>
            <input id="nik" name="nik" type="text" class="form-control" 
                   value="{{ old('nik', $user->nik) }}" placeholder="Nomor Induk Kependudukan">
            <x-input-error class="mt-1" :messages="$errors->get('nik')" />
        </div>

        <div class="form-group mb-3">
            <label for="nip" class="profile-label"><i class="fas fa-id-badge me-1"></i>NIP</label>
            <input id="nip" name="nip" type="text" class="form-control" 
                   value="{{ old('nip', $user->nip) }}" placeholder="Nomor Induk Pegawai">
            <x-input-error class="mt-1" :messages="$errors->get('nip')" />
        </div>

        <div class="form-group mb-3">
            <label for="ttl" class="profile-label"><i class="fas fa-birthday-cake me-1"></i>Tempat, Tanggal Lahir</label>
            <input id="ttl" name="ttl" type="text" class="form-control" 
                   value="{{ old('ttl', $user->ttl) }}" placeholder="Contoh: Jakarta, 01 Januari 1990">
            <x-input-error class="mt-1" :messages="$errors->get('ttl')" />
        </div>

        <div class="form-group mb-3">
            <label for="phone" class="profile-label"><i class="fas fa-phone me-1"></i>No. Telepon</label>
            <input id="phone" name="phone" type="text" class="form-control" 
                   value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx">
            <x-input-error class="mt-1" :messages="$errors->get('phone')" />
        </div>

        @if($user->role === 'admin')
        <div class="form-group mb-3">
            <label for="role" class="profile-label"><i class="fas fa-user-tag me-1"></i>Role</label>
            <select id="role" name="role" class="form-control">
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrator</option>
                <option value="teacher" {{ old('role', $user->role) === 'teacher' ? 'selected' : '' }}>Guru</option>
            </select>
            <x-input-error class="mt-1" :messages="$errors->get('role')" />
        </div>
        @endif

        <div class="form-group mb-3">
            <label class="profile-label"><i class="fas fa-book me-1"></i>Mata Pelajaran</label>
            <div class="profile-readonly-field">
                @isset($user->subject)
                    <span class="badge badge-success">{{ $user->subject->name }}</span>
                @else
                    <span style="color:var(--dash-text-light);font-size:0.82rem;">Belum ada mata pelajaran</span>
                @endisset
            </div>
        </div>

        {{-- Email Hidden --}}
        <div class="d-none">
            <input id="email" name="email" type="email" class="form-control" 
                   value="{{ old('email', $user->email) }}" required autocomplete="username">
        </div>

        <div class="form-group mb-3">
            <label for="photo" class="profile-label"><i class="fas fa-camera me-1"></i>Foto Profil</label>
            <input id="photo" name="photo" type="file" class="form-control" accept="image/jpeg,image/png,image/jpg" onchange="previewPhoto(event)">
            <small style="color:var(--dash-text-light);font-size:0.72rem;">Format: JPG, PNG. Maksimal 2MB</small>
            <x-input-error class="mt-1" :messages="$errors->get('photo')" />
        </div>

        @if ($user->photo_path)
            <div class="d-flex gap-3 mb-3">
                <div>
                    <small class="profile-label d-block mb-1">Foto Saat Ini</small>
                    @php
                        $photoPath = $user->photo_path;
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
                    <img src="{{ $imageUrl }}" alt="Foto Profil" class="profile-photo-preview"
                         onerror="this.src='{{ asset('image/default-avatar.png') }}';">
                </div>
                <div id="newPhotoPreview" style="display:none;">
                    <small class="profile-label d-block mb-1" style="color:#d97706;">Foto Baru</small>
                    <img id="previewImage" src="" alt="Preview" class="profile-photo-preview" style="border-color:#d97706;">
                </div>
            </div>
        @else
            <div id="newPhotoPreview" class="mb-3" style="display:none;">
                <small class="profile-label d-block mb-1">Preview</small>
                <img id="previewImage" src="" alt="Preview" class="profile-photo-preview">
            </div>
        @endif

        <div class="d-flex align-items-center gap-2 pt-3" style="border-top:1px solid var(--dash-border);">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-save me-1"></i> Simpan Perubahan
            </button>
            @if (session('status') === 'profile-updated')
                <span class="text-success" style="font-size:0.8rem;"><i class="fas fa-check-circle me-1"></i>Tersimpan!</span>
            @endif
        </div>
    </form>
</section>

<script>
function previewPhoto(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('newPhotoPreview');
    const previewImg = document.getElementById('previewImage');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
}
</script>

@push('styles')
<style>
    .profile-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--dash-text);
        margin-bottom: 0.3rem;
    }

    .profile-form .form-control {
        font-size: 0.84rem;
        padding: 0.5rem 0.75rem;
        border: 1.5px solid var(--dash-border);
        border-radius: 8px;
        transition: border-color 0.2s;
    }

    .profile-form .form-control:focus {
        border-color: var(--dash-primary-light);
        box-shadow: 0 0 0 3px rgba(37,99,235,0.06);
    }

    .profile-readonly-field {
        padding: 0.5rem 0.75rem;
        background: var(--dash-bg);
        border: 1.5px solid var(--dash-border);
        border-radius: 8px;
        font-size: 0.84rem;
    }

    .profile-photo-preview {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid var(--dash-border);
    }
</style>
@endpush