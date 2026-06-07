<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Tambah Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Page Header Card --}}
            <div class="dash-header-card mb-4">
                <div class="dash-header-card-content">
                    <div class="dash-header-card-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div>
                        <h3 class="dash-header-card-title">Tambah Pengguna Baru</h3>
                        <p class="dash-header-card-desc">Lengkapi form di bawah untuk menambahkan pengguna baru ke sistem</p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            {{-- Validation Errors --}}
            @if ($errors->any())
            <div class="create-user-errors mb-4">
                <div class="create-user-errors-header">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Terdapat {{ $errors->count() }} kesalahan pada form</span>
                </div>
                <ul class="create-user-errors-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Form Card --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <form action="{{ route('users.store') }}" method="POST" id="createUserForm" enctype="multipart/form-data">
                        @csrf

                        {{-- Section: Informasi Dasar --}}
                        <div class="create-user-section">
                            <h5 class="create-user-section-title">
                                <i class="fas fa-id-card me-2"></i>Informasi Dasar
                            </h5>

                            <div class="row g-3 mt-1">
                                {{-- Name --}}
                                <div class="col-12">
                                    <div class="create-user-field">
                                        <label for="name" class="create-user-label">
                                            Nama Lengkap <span class="create-user-required">*</span>
                                        </label>
                                        <div class="create-user-input-wrap">
                                            <div class="create-user-input-icon">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <input type="text"
                                                   class="form-control create-user-input @error('name') is-invalid @enderror"
                                                   id="name"
                                                   name="name"
                                                   value="{{ old('name') }}"
                                                   placeholder="Masukkan nama lengkap"
                                                   required>
                                        </div>
                                        @error('name')
                                            <div class="create-user-error-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="col-12">
                                    <div class="create-user-field">
                                        <label for="email" class="create-user-label">
                                            Email <span class="create-user-required">*</span>
                                        </label>
                                        <div class="create-user-input-wrap">
                                            <div class="create-user-input-icon">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <input type="email"
                                                   class="form-control create-user-input @error('email') is-invalid @enderror"
                                                   id="email"
                                                   name="email"
                                                   value="{{ old('email') }}"
                                                   placeholder="contoh@email.com"
                                                   required>
                                        </div>
                                        <div class="create-user-hint">
                                            <i class="fas fa-info-circle me-1"></i>Email akan digunakan untuk login
                                        </div>
                                        @error('email')
                                            <div class="create-user-error-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Photo Profil --}}
                                <div class="col-12 mt-2">
                                    <div class="create-user-field">
                                        <label class="create-user-label">Foto Profil</label>
                                        <div class="upload-zone-premium border-dashed p-3 rounded-lg d-flex flex-column align-items-center justify-content-center text-center cursor-pointer" onclick="document.getElementById('photo').click()" style="border: 2px dashed #cbd5e1; background: #f8fafc; transition: all 0.2s ease; border-radius: 8px;">
                                            <i class="fas fa-cloud-upload-alt text-primary mb-2" style="font-size: 1.75rem;"></i>
                                            <span id="photo-label-text" class="text-sm font-semibold text-slate-600" style="font-size: 0.85rem;">Klik untuk memilih foto profil</span>
                                            <span class="text-xxs text-slate-400 mt-1" style="font-size: 0.7rem; color: #64748b;">Format yang didukung: JPG, PNG, WEBP, HEIC. Otomatis dikompres secara cerdas.</span>
                                            <input type="file" id="photo" name="photo" accept="image/*,.heic,.heif" class="d-none" onchange="updatePhotoLabel(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Section: Role & Mata Pelajaran --}}
                        <div class="create-user-section">
                            <h5 class="create-user-section-title">
                                <i class="fas fa-user-tag me-2"></i>Jabatan & Penugasan
                            </h5>

                            <div class="row g-3 mt-1">
                                {{-- Role --}}
                                <div class="col-md-6">
                                    <div class="create-user-field">
                                        <label for="role" class="create-user-label">
                                            Jabatan <span class="create-user-required">*</span>
                                        </label>
                                        <div class="create-user-input-wrap">
                                            <div class="create-user-input-icon">
                                                <i class="fas fa-shield-alt"></i>
                                            </div>
                                            <select class="form-select create-user-input @error('role') is-invalid @enderror"
                                                    id="role"
                                                    name="role"
                                                    required>
                                                <option value="">-- Pilih Jabatan --</option>
                                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Guru</option>
                                                <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff (Tenaga Kependidikan)</option>
                                            </select>
                                        </div>
                                        @error('role')
                                            <div class="create-user-error-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Position (Jabatan/Posisi) --}}
                                <div class="col-md-6" id="position-field" style="display: none;">
                                    <div class="create-user-field">
                                        <label for="position" class="create-user-label">
                                            Nama Jabatan / Posisi <span class="create-user-required">*</span>
                                        </label>
                                        <div class="create-user-input-wrap">
                                            <div class="create-user-input-icon">
                                                <i class="fas fa-briefcase"></i>
                                            </div>
                                            <input type="text"
                                                   class="form-control create-user-input @error('position') is-invalid @enderror"
                                                   id="position"
                                                   name="position"
                                                   value="{{ old('position') }}"
                                                   placeholder="Contoh: Kepala Tata Usaha, Operator Sekolah, Penjaga">
                                        </div>
                                        @error('position')
                                            <div class="create-user-error-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Subject (Conditional) --}}
                                <div class="col-md-6" id="subject-field" style="display: none;">
                                    <div class="create-user-field">
                                        <label for="subject_id" class="create-user-label">
                                            Mata Pelajaran <span class="create-user-required">*</span>
                                        </label>
                                        <div class="create-user-input-wrap">
                                            <div class="create-user-input-icon">
                                                <i class="fas fa-book"></i>
                                            </div>
                                            <select class="form-select create-user-input @error('subject_id') is-invalid @enderror"
                                                    id="subject_id"
                                                    name="subject_id">
                                                <option value="">-- Pilih Mata Pelajaran --</option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                                        {{ $subject->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('subject_id')
                                            <div class="create-user-error-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Organisasi (Conditional) --}}
                                <div class="col-md-6" id="organisasi-field" style="display: none;">
                                    <div class="create-user-field">
                                        <label for="organisasi_id" class="create-user-label">
                                            Organisasi Yang Diampu
                                        </label>
                                        <div class="create-user-input-wrap">
                                            <div class="create-user-input-icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <select class="form-select create-user-input @error('organisasi_id') is-invalid @enderror"
                                                    id="organisasi_id"
                                                    name="organisasi_id">
                                                <option value="">-- Tanpa Organisasi / Umum --</option>
                                                @foreach ($organisasis as $organisasi)
                                                    <option value="{{ $organisasi->id }}" {{ old('organisasi_id') == $organisasi->id ? 'selected' : '' }}>
                                                        {{ $organisasi->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('organisasi_id')
                                            <div class="create-user-error-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Section: Keamanan --}}
                        <div class="create-user-section">
                            <h5 class="create-user-section-title">
                                <i class="fas fa-lock me-2"></i>Keamanan
                            </h5>

                            <div class="row g-3 mt-1">
                                {{-- Password --}}
                                <div class="col-md-6">
                                    <div class="create-user-field">
                                        <label for="password" class="create-user-label">
                                            Password <span class="create-user-required">*</span>
                                        </label>
                                        <div class="create-user-input-wrap">
                                            <div class="create-user-input-icon">
                                                <i class="fas fa-key"></i>
                                            </div>
                                            <input type="password"
                                                   class="form-control create-user-input @error('password') is-invalid @enderror"
                                                   id="password"
                                                   name="password"
                                                   placeholder="Masukkan password"
                                                   required>
                                            <button class="create-user-toggle-pw" type="button" id="togglePassword">
                                                <i class="fas fa-eye" id="eyeIcon"></i>
                                            </button>
                                        </div>
                                        <div class="create-user-hint">
                                            <i class="fas fa-info-circle me-1"></i>Minimal 6 karakter
                                        </div>
                                        @error('password')
                                            <div class="create-user-error-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Password Confirmation --}}
                                <div class="col-md-6">
                                    <div class="create-user-field">
                                        <label for="password_confirmation" class="create-user-label">
                                            Konfirmasi Password <span class="create-user-required">*</span>
                                        </label>
                                        <div class="create-user-input-wrap">
                                            <div class="create-user-input-icon">
                                                <i class="fas fa-key"></i>
                                            </div>
                                            <input type="password"
                                                   class="form-control create-user-input"
                                                   id="password_confirmation"
                                                   name="password_confirmation"
                                                   placeholder="Masukkan ulang password"
                                                   required>
                                            <button class="create-user-toggle-pw" type="button" id="togglePasswordConfirm">
                                                <i class="fas fa-eye" id="eyeIconConfirm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Info Note --}}
                        <div class="create-user-note">
                            <div class="create-user-note-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div>
                                <div class="create-user-note-title">Catatan</div>
                                <p class="create-user-note-text">
                                    Semua field yang bertanda <span class="create-user-required">*</span> wajib diisi.
                                    Pengguna baru akan menerima email verifikasi sebelum dapat mengakses dashboard.
                                </p>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="create-user-actions">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary create-user-btn-cancel">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary create-user-btn-submit">
                                <i class="fas fa-save me-2"></i>Simpan Pengguna
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
            const password = document.getElementById('password');
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
            const password = document.getElementById('password_confirmation');
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
                labelText.textContent = 'Klik untuk memilih foto profil';
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

    @push('styles')
    <style>
        /* ===== PAGE HEADER ===== */
        .create-user-header {
            background: linear-gradient(135deg, var(--dash-primary, #1e3a5f) 0%, var(--dash-primary-light, #2563eb) 100%);
            border-radius: var(--dash-radius, 12px);
            padding: 1.75rem 2rem;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .create-user-header-content {
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            z-index: 1;
        }

        .create-user-header-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .create-user-header-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin: 0 0 0.15rem;
        }

        .create-user-header-desc {
            font-size: 0.8rem;
            opacity: 0.7;
            margin: 0;
            font-weight: 400;
        }

        .create-user-header-deco1 {
            position: absolute;
            top: -50px;
            right: -20px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }

        .create-user-header-deco2 {
            position: absolute;
            bottom: -60px;
            right: 120px;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }

        /* ===== SECTION TITLES ===== */
        .create-user-section {
            margin-bottom: 1.75rem;
        }

        .create-user-section-title {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--dash-text, #1e293b);
            margin-bottom: 0;
            padding-bottom: 0.6rem;
            border-bottom: 2px solid var(--dash-border, #e2e8f0);
        }

        /* ===== FORM FIELDS ===== */
        .create-user-field {
            margin-bottom: 0;
        }

        .create-user-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--dash-text-light, #64748b);
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.4rem;
            display: block;
        }

        .create-user-required {
            color: var(--dash-danger, #ef4444);
            font-weight: 700;
        }

        .create-user-input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .create-user-input-icon {
            position: absolute;
            left: 0.85rem;
            color: var(--dash-text-light, #64748b);
            font-size: 0.85rem;
            z-index: 2;
            pointer-events: none;
        }

        .create-user-input {
            padding-left: 2.5rem !important;
            border-radius: var(--dash-radius-sm, 8px) !important;
            border: 1.5px solid var(--dash-border, #e2e8f0) !important;
            font-size: 0.875rem;
            padding-top: 0.6rem;
            padding-bottom: 0.6rem;
            transition: all 0.2s ease;
        }

        .create-user-input:focus {
            border-color: var(--dash-primary-light, #2563eb) !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12) !important;
        }

        .create-user-input.is-invalid {
            border-color: var(--dash-danger, #ef4444) !important;
        }

        .create-user-input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12) !important;
        }

        .create-user-toggle-pw {
            position: absolute;
            right: 0.5rem;
            background: none;
            border: none;
            color: var(--dash-text-light, #64748b);
            cursor: pointer;
            padding: 0.35rem 0.5rem;
            border-radius: 6px;
            transition: all 0.2s ease;
            z-index: 2;
        }

        .create-user-toggle-pw:hover {
            background: rgba(0,0,0,0.04);
            color: var(--dash-text, #1e293b);
        }

        .create-user-hint {
            font-size: 0.72rem;
            color: var(--dash-text-light, #64748b);
            margin-top: 0.35rem;
        }

        .create-user-error-text {
            font-size: 0.75rem;
            color: var(--dash-danger, #ef4444);
            margin-top: 0.3rem;
            font-weight: 500;
        }

        /* ===== VALIDATION ERRORS BOX ===== */
        .create-user-errors {
            background: rgba(239, 68, 68, 0.06);
            border: 1px solid rgba(239, 68, 68, 0.15);
            border-radius: var(--dash-radius, 12px);
            padding: 1rem 1.25rem;
        }

        .create-user-errors-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: #dc2626;
            margin-bottom: 0.5rem;
        }

        .create-user-errors-list {
            margin: 0;
            padding-left: 1.25rem;
            font-size: 0.8rem;
            color: #991b1b;
        }

        .create-user-errors-list li {
            margin-bottom: 0.15rem;
        }

        /* ===== INFO NOTE ===== */
        .create-user-note {
            display: flex;
            gap: 0.75rem;
            align-items: flex-start;
            padding: 1rem 1.15rem;
            border-radius: var(--dash-radius-sm, 8px);
            background: rgba(59, 130, 246, 0.06);
            border: 1px solid rgba(59, 130, 246, 0.1);
            margin-bottom: 1.5rem;
        }

        .create-user-note-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(59, 130, 246, 0.1);
            color: var(--dash-info, #3b82f6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .create-user-note-title {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--dash-text, #1e293b);
            margin-bottom: 0.1rem;
        }

        .create-user-note-text {
            font-size: 0.75rem;
            color: var(--dash-text-light, #64748b);
            margin: 0;
            line-height: 1.5;
        }

        /* ===== ACTION BUTTONS ===== */
        .create-user-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            padding-top: 1.25rem;
            border-top: 2px solid var(--dash-border, #e2e8f0);
        }

        .create-user-btn-cancel {
            background: #f1f5f9;
            color: var(--dash-text-light, #64748b);
            border: 1px solid var(--dash-border, #e2e8f0);
            font-size: 0.82rem;
            padding: 0.55rem 1.25rem;
        }

        .create-user-btn-cancel:hover {
            background: #e2e8f0;
            color: var(--dash-text, #1e293b);
        }

        .create-user-btn-submit {
            font-size: 0.82rem;
            padding: 0.55rem 1.5rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .create-user-header { padding: 1.25rem 1.5rem; }
            .create-user-header-title { font-size: 1rem; }
            .create-user-header-icon { display: none; }
            .create-user-actions { flex-direction: column-reverse; }
            .create-user-actions .btn { width: 100%; justify-content: center; }
        }
    </style>
    @endpush
</x-app-layout>