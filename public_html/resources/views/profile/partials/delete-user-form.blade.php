<section class="space-y-6">
    <header class="mb-4">
        <h2 class="text-lg font-weight-bold text-danger">
            <i class="fas fa-exclamation-triangle mr-2"></i>{{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Warning Card -->
    <div class="alert alert-danger border-danger" role="alert">
        <h6 class="alert-heading font-weight-bold">
            <i class="fas fa-shield-alt mr-2"></i>Konsekuensi Penghapusan Akun
        </h6>
        <ul class="mb-2 pl-3">
            <li><strong>Semua data pribadi</strong> akan dihapus secara permanen</li>
            <li><strong>Artikel dan konten</strong> yang Anda buat akan hilang</li>
            <li><strong>Tidak dapat dikembalikan</strong> setelah proses selesai</li>
            <li><strong>Akses ke sistem</strong> akan langsung dicabut</li>
        </ul>
        <hr class="my-2">
        <p class="mb-0 small">
            <i class="fas fa-info-circle mr-1"></i>
            Pastikan Anda telah membackup semua data penting sebelum melanjutkan.
        </p>
    </div>

    <!-- Delete Button -->
    <div class="d-flex align-items-center gap-3">
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="btn btn-danger btn-lg"
        >
            <i class="fas fa-trash-alt mr-2"></i>{{ __('Delete Account') }}
        </x-danger-button>
        <small class="text-muted">
            <i class="fas fa-lock mr-1"></i>Tindakan ini memerlukan konfirmasi password
        </small>
    </div>

    <!-- Confirmation Modal -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <!-- Modal Header -->
            <div class="modal-header-custom mb-4">
                <div class="warning-icon-large">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h2 class="text-xl font-weight-bold text-danger mb-2">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>
                <p class="text-sm text-gray-600 mb-0">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>
            </div>

            <!-- Impact Summary -->
            <div class="impact-summary mb-4 p-3 bg-light border-left-danger rounded">
                <h6 class="font-weight-bold text-danger mb-3">
                    <i class="fas fa-list-ul mr-2"></i>Yang akan terhapus:
                </h6>
                <div class="row">
                    <div class="col-md-6">
                        <div class="impact-item">
                            <i class="fas fa-user-circle text-danger"></i>
                            <span>Informasi profil</span>
                        </div>
                        <div class="impact-item">
                            <i class="fas fa-newspaper text-danger"></i>
                            <span>Semua artikel</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="impact-item">
                            <i class="fas fa-image text-danger"></i>
                            <span>File & foto</span>
                        </div>
                        <div class="impact-item">
                            <i class="fas fa-clock text-danger"></i>
                            <span>Riwayat aktivitas</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Password Confirmation -->
            <div class="mb-4">
                <x-input-label for="password" value="{{ __('Password') }}" class="font-weight-bold">
                    <i class="fas fa-lock mr-1 text-danger"></i>
                </x-input-label>
                <div class="input-group mt-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-danger text-white">
                            <i class="fas fa-key"></i>
                        </span>
                    </div>
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="form-control password-input-delete"
                        placeholder="{{ __('Masukkan password Anda untuk konfirmasi') }}"
                        required
                    />
                    <div class="input-group-append">
                        <button class="btn btn-outline-danger toggle-password-delete" type="button" onclick="toggleDeletePassword()">
                            <i class="fas fa-eye" id="icon-delete-password"></i>
                        </button>
                    </div>
                </div>
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                <small class="text-muted d-block mt-2">
                    <i class="fas fa-info-circle mr-1"></i>Password diperlukan untuk memverifikasi identitas Anda
                </small>
            </div>

            <!-- Confirmation Checkbox -->
            <div class="custom-control custom-checkbox mb-4">
                <input type="checkbox" class="custom-control-input" id="confirmDelete" required onchange="toggleDeleteButton()">
                <label class="custom-control-label font-weight-medium" for="confirmDelete">
                    Saya memahami bahwa <strong class="text-danger">tindakan ini tidak dapat dibatalkan</strong> dan semua data akan hilang permanen
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <x-secondary-button x-on:click="$dispatch('close')" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left mr-2"></i>{{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="btn btn-danger btn-lg" id="btnDeleteAccount" disabled>
                    <i class="fas fa-trash-alt mr-2"></i>{{ __('Yes, Delete My Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

<script>
// Toggle password visibility in delete modal
function toggleDeletePassword() {
    const field = document.getElementById('password');
    const icon = document.getElementById('icon-delete-password');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Enable delete button only when checkbox is checked
function toggleDeleteButton() {
    const checkbox = document.getElementById('confirmDelete');
    const button = document.getElementById('btnDeleteAccount');
    
    if (checkbox.checked) {
        button.disabled = false;
        button.classList.add('btn-danger-active');
    } else {
        button.disabled = true;
        button.classList.remove('btn-danger-active');
    }
}
</script>

<style>
/* Header Styling */
header h2 {
    color: #dc3545;
}

/* Warning Alert */
.alert-danger {
    background-color: #f8d7da;
    border-color: #dc3545;
    border-width: 2px;
    border-radius: 0.5rem;
}

.alert-danger .alert-heading {
    color: #721c24;
    font-size: 0.95rem;
    margin-bottom: 0.75rem;
}

.alert-danger ul {
    font-size: 0.875rem;
    color: #721c24;
}

.alert-danger ul li {
    margin-bottom: 0.5rem;
}

/* Delete Button */
.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
    font-weight: 600;
    transition: all 0.2s;
}

.btn-danger:hover:not(:disabled) {
    background-color: #c82333;
    border-color: #bd2130;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
}

.btn-danger:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.btn-danger-active {
    animation: pulseRed 2s infinite;
}

@keyframes pulseRed {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
    }
    50% {
        box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
    }
}

/* Modal Header Custom */
.modal-header-custom {
    text-align: center;
}

.warning-icon-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    animation: shake 0.5s ease;
}

.warning-icon-large i {
    font-size: 2.5rem;
    color: white;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-10px); }
    75% { transform: translateX(10px); }
}

/* Impact Summary */
.impact-summary {
    border-left: 4px solid #dc3545;
    background: #fff5f5;
}

.border-left-danger {
    border-left-width: 4px;
    border-left-style: solid;
}

.impact-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
}

.impact-item i {
    font-size: 1.1rem;
    margin-right: 0.75rem;
    width: 20px;
}

/* Input Group Danger Theme */
.input-group-text.bg-danger {
    background-color: #dc3545 !important;
    border-color: #dc3545;
}

.password-input-delete {
    border: 2px solid #dc3545;
    transition: all 0.2s;
}

.password-input-delete:focus {
    border-color: #c82333;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
}

.toggle-password-delete {
    border: 2px solid #dc3545;
    border-left: none;
    background: white;
    color: #dc3545;
    transition: all 0.2s;
}

.toggle-password-delete:hover {
    background: #f8d7da;
    color: #c82333;
}

/* Confirmation Checkbox */
.custom-control-label {
    cursor: pointer;
    user-select: none;
    font-size: 0.9rem;
    color: #495057;
}

.custom-control-input:checked ~ .custom-control-label::before {
    background-color: #dc3545;
    border-color: #dc3545;
}

/* Secondary Button */
.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
    color: white;
    font-weight: 600;
    transition: all 0.2s;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
}

/* Button Sizing */
.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
}

/* Gap Utility */
.gap-3 {
    gap: 1rem;
}

/* Border Top */
.border-top {
    border-top: 2px solid #e5e7eb !important;
}

/* Responsive */
@media (max-width: 768px) {
    .warning-icon-large {
        width: 60px;
        height: 60px;
    }
    
    .warning-icon-large i {
        font-size: 2rem;
    }
    
    .btn-lg {
        padding: 0.6rem 1.2rem;
        font-size: 0.95rem;
    }
    
    .impact-summary .row {
        flex-direction: column;
    }
}
</style>
