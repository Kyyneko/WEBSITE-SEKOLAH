<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="mb-4 pb-3 border-bottom">
                        <h3 class="text-2xl font-weight-bold text-dark mb-1">
                            <i class="fas fa-user-edit text-warning mr-2"></i>Edit Pengguna
                        </h3>
                        <p class="text-muted mb-0">Perbarui informasi pengguna: <strong>{{ $user->name }}</strong></p>
                    </div>

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
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
                            </select>
                            @error('role')
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

        // Show/hide subject field based on role
        document.getElementById('role').addEventListener('change', function() {
            const subjectField = document.getElementById('subject-field');
            const subjectSelect = document.getElementById('subject_id');
            
            if (this.value === 'teacher') {
                subjectField.style.display = 'block';
                subjectSelect.required = true;
            } else {
                subjectField.style.display = 'none';
                subjectSelect.required = false;
                subjectSelect.value = '';
            }
        });

        // Trigger on page load if role is teacher
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            if (roleSelect.value === 'teacher') {
                document.getElementById('subject-field').style.display = 'block';
                document.getElementById('subject_id').required = true;
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