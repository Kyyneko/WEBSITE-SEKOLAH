<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Page Header Card --}}
            <div class="dash-header-card mb-4">
                <div class="dash-header-card-content">
                    <div class="dash-header-card-icon">
                        <i class="fas fa-user-edit text-white"></i>
                    </div>
                    <div>
                        <h3 class="dash-header-card-title">Edit Pengguna</h3>
                        <p class="dash-header-card-desc">Perbarui informasi pengguna: <strong>{{ $user->name }}</strong></p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">

                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Photo Profil Field -->
                        <div class="mb-4">
                            <label class="form-label font-weight-bold">
                                <i class="fas fa-image text-primary mr-1"></i>Foto Profil
                            </label>
                            <div class="d-flex align-items-center mb-3">
                                <div class="mr-4">
                                    <div class="rounded-circle border overflow-hidden bg-light shadow-sm d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; aspect-ratio: 1/1;">
                                        @if($user->photo_path)
                                            <img src="{{ asset('storage/' . str_replace('public/', '', $user->photo_path)) }}" alt="{{ $user->name }}" class="w-100 h-100 object-fit-cover">
                                        @else
                                            <i class="fas fa-user-circle text-gray-400" style="font-size: 3rem;"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="upload-zone-premium border-dashed p-3 rounded-lg d-flex flex-column align-items-center justify-content-center text-center cursor-pointer" onclick="document.getElementById('photo').click()" style="border: 2px dashed #cbd5e1; background: #f8fafc; transition: all 0.2s ease; border-radius: 8px;">
                                        <i class="fas fa-cloud-upload-alt text-primary mb-2" style="font-size: 1.5rem;"></i>
                                        <span id="photo-label-text" class="text-sm font-semibold text-slate-600" style="font-size: 0.85rem;">Klik untuk mengganti foto profil (JPG, PNG, WEBP, HEIC)</span>
                                        <input type="file" id="photo" name="photo" accept="image/*,.heic,.heif" class="d-none" onchange="updatePhotoLabel(this)">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Name Field -->
                        <div class="mb-4">
                            <label for="name" class="form-label font-weight-bold">
                                <i class="fas fa-user text-primary mr-1"></i>Nama Lengkap
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}"
                                   placeholder="Masukkan nama lengkap"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="email" class="form-label font-weight-bold">
                                <i class="fas fa-envelope text-primary mr-1"></i>Email
                                <span class="text-danger">*</span>
                            </label>
                            <input type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}"
                                   placeholder="contoh@email.com"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role Field -->
                        <div class="mb-4">
                            <label for="role" class="form-label font-weight-bold">
                                <i class="fas fa-user-tag text-primary mr-1"></i>Jabatan
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-lg @error('role') is-invalid @enderror" 
                                    id="role" 
                                    name="role" 
                                    required>
                                <option value="">-- Pilih Jabatan --</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="teacher" {{ old('role', $user->role) == 'teacher' ? 'selected' : '' }}>Guru</option>
                                <option value="staff" {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}>Staff (Tenaga Kependidikan)</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Position Field (Conditional) -->
                        <div class="mb-4" id="position-field" style="display: {{ in_array(old('role', $user->role), ['teacher', 'staff']) ? 'block' : 'none' }};">
                            <label for="position" class="form-label font-weight-bold">
                                <i class="fas fa-briefcase text-primary mr-1"></i>Nama Jabatan / Posisi
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('position') is-invalid @enderror" 
                                   id="position" 
                                   name="position" 
                                   value="{{ old('position', $user->position) }}"
                                   placeholder="Contoh: Kepala Tata Usaha, Operator Sekolah, Penjaga">
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Subject Field (Conditional) -->
                        <div class="mb-4" id="subject-field" style="display: {{ old('role', $user->role) == 'teacher' ? 'block' : 'none' }};">
                            <label for="subject_id" class="form-label font-weight-bold">
                                <i class="fas fa-book text-primary mr-1"></i>Mata Pelajaran
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-lg @error('subject_id') is-invalid @enderror" 
                                    id="subject_id" 
                                    name="subject_id">
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}" 
                                        {{ old('subject_id', $user->subject_id) == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Pilih mata pelajaran yang diampu
                            </small>
                        </div>

                        <!-- Organisasi Field (Conditional) -->
                        <div class="mb-4" id="organisasi-field" style="display: {{ old('role', $user->role) == 'teacher' ? 'block' : 'none' }};">
                            <label for="organisasi_id" class="form-label font-weight-bold">
                                <i class="fas fa-users text-primary mr-1"></i>Organisasi Yang Diampu
                            </label>
                            <select class="form-select form-select-lg @error('organisasi_id') is-invalid @enderror" 
                                    id="organisasi_id" 
                                    name="organisasi_id">
                                <option value="">-- Tanpa Organisasi / Umum --</option>
                                @foreach ($organisasis as $organisasi)
                                    <option value="{{ $organisasi->id }}" 
                                        {{ old('organisasi_id', $user->organisasi_id) == $organisasi->id ? 'selected' : '' }}>
                                        {{ $organisasi->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('organisasi_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Pilih organisasi jika guru ini ditugaskan sebagai pembina/penanggung jawab
                            </small>
                        </div>

                        <!-- Password Section Divider -->
                        <hr class="my-4">
                        <div class="mb-3">
                            <h5 class="font-weight-bold text-dark">
                                <i class="fas fa-key text-warning mr-2"></i>Ubah Password
                            </h5>
                            <p class="text-muted small mb-0">Kosongkan jika tidak ingin mengubah password</p>
                        </div>

                        <!-- New Password Field -->
                        <div class="mb-4">
                            <label for="new_password" class="form-label font-weight-bold">
                                <i class="fas fa-lock text-primary mr-1"></i>Password Baru
                            </label>
                            <div class="input-group input-group-lg">
                                <input type="password" 
                                       class="form-control @error('new_password') is-invalid @enderror" 
                                       id="new_password" 
                                       name="new_password" 
                                       placeholder="Masukkan password baru (opsional)">
                                <button class="btn btn-outline-secondary" 
                                        type="button" 
                                        id="togglePassword">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </button>
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Password minimal 8 karakter. Kosongkan jika tidak ingin mengubah.
                            </small>
                        </div>

                        <!-- Password Confirmation Field -->
                        <div class="mb-4">
                            <label for="new_password_confirmation" class="form-label font-weight-bold">
                                <i class="fas fa-lock text-primary mr-1"></i>Konfirmasi Password Baru
                            </label>
                            <div class="input-group input-group-lg">
                                <input type="password" 
                                       class="form-control" 
                                       id="new_password_confirmation" 
                                       name="new_password_confirmation" 
                                       placeholder="Masukkan ulang password baru">
                                <button class="btn btn-outline-secondary" 
                                        type="button" 
                                        id="togglePasswordConfirm">
                                    <i class="fas fa-eye" id="eyeIconConfirm"></i>
                                </button>
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Masukkan password yang sama dengan di atas
                            </small>
                        </div>

                        <!-- Alert Info -->
                        <div class="alert alert-warning" role="alert">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Perhatian:</strong> Pastikan data yang Anda masukkan sudah benar sebelum menyimpan perubahan.
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning btn-lg text-white">
                                <i class="fas fa-save mr-2"></i>Update Pengguna
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('new_password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
            const password = document.getElementById('new_password_confirmation');
            const eyeIcon = document.getElementById('eyeIconConfirm');
            
            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        function updatePhotoLabel(input) {
            const labelText = document.getElementById('photo-label-text');
            if (input.files && input.files[0]) {
                labelText.textContent = `File terpilih: ${input.files[0].name}`;
                labelText.style.color = '#0d9488';
            } else {
                labelText.textContent = 'Klik untuk mengganti foto profil';
                labelText.style.color = '';
            }
        }

        // Show/hide fields based on role
        document.getElementById('role').addEventListener('change', function() {
            const subjectField = document.getElementById('subject-field');
            const subjectSelect = document.getElementById('subject_id');
            const organisasiField = document.getElementById('organisasi-field');
            const organisasiSelect = document.getElementById('organisasi_id');
            const positionField = document.getElementById('position-field');
            const positionInput = document.getElementById('position');
            
            if (this.value === 'teacher') {
                subjectField.style.display = 'block';
                subjectSelect.required = true;
                organisasiField.style.display = 'block';
                
                positionField.style.display = 'block';
                positionInput.required = false;
                positionInput.placeholder = 'Contoh: Wali Kelas VII-A (Opsional)';
            } else if (this.value === 'staff') {
                subjectField.style.display = 'none';
                subjectSelect.required = false;
                subjectSelect.value = '';
                organisasiField.style.display = 'none';
                organisasiSelect.value = '';
                
                positionField.style.display = 'block';
                positionInput.required = true;
                positionInput.placeholder = 'Contoh: Kepala Tata Usaha, Operator Sekolah';
            } else {
                subjectField.style.display = 'none';
                subjectSelect.required = false;
                subjectSelect.value = '';
                organisasiField.style.display = 'none';
                organisasiSelect.value = '';
                
                positionField.style.display = 'none';
                positionInput.required = false;
                positionInput.value = '';
            }
        });

        // Trigger on page load if old value exists
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const subjectField = document.getElementById('subject-field');
            const subjectSelect = document.getElementById('subject_id');
            const organisasiField = document.getElementById('organisasi-field');
            const positionField = document.getElementById('position-field');
            const positionInput = document.getElementById('position');
            
            if (roleSelect.value === 'teacher') {
                subjectField.style.display = 'block';
                subjectSelect.required = true;
                organisasiField.style.display = 'block';
                positionField.style.display = 'block';
            } else if (roleSelect.value === 'staff') {
                positionField.style.display = 'block';
                positionInput.required = true;
            }
        });
    </script>

    <style>
        .form-label {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-control-lg, .form-select-lg {
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }

        .form-control:focus, .form-select:focus {
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

        .input-group .btn {
            border-left: none;
        }

        .input-group .form-control:focus + .btn {
            border-color: #ffc107;
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

        hr {
            border-top: 2px solid #e5e7eb;
        }
    </style>
</x-app-layout>