<section>
    <header class="mb-4">
        <h2 class="text-lg font-weight-bold text-gray-900">
            <i class="fas fa-lock text-warning mr-2"></i>{{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Current Password Field -->
        <div class="form-group">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="font-weight-bold">
                <i class="fas fa-key mr-1 text-primary"></i>
            </x-input-label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <x-text-input id="update_password_current_password" 
                    name="current_password" 
                    type="password" 
                    class="form-control password-input" 
                    autocomplete="current-password"
                    placeholder="Masukkan password saat ini" />
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary toggle-password" type="button" onclick="togglePassword('update_password_current_password')">
                        <i class="fas fa-eye" id="icon-update_password_current_password"></i>
                    </button>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- New Password Field -->
        <div class="form-group">
            <x-input-label for="update_password_password" :value="__('New Password')" class="font-weight-bold">
                <i class="fas fa-key mr-1 text-success"></i>
            </x-input-label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <x-text-input id="update_password_password" 
                    name="password" 
                    type="password" 
                    class="form-control password-input" 
                    autocomplete="new-password"
                    placeholder="Masukkan password baru"
                    oninput="checkPasswordStrength(this.value)" />
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary toggle-password" type="button" onclick="togglePassword('update_password_password')">
                        <i class="fas fa-eye" id="icon-update_password_password"></i>
                    </button>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            
            <!-- Password Strength Indicator -->
            <div id="passwordStrength" class="mt-2" style="display: none;">
                <div class="d-flex align-items-center mb-1">
                    <small class="text-muted mr-2">Kekuatan Password:</small>
                    <span id="strengthText" class="badge"></span>
                </div>
                <div class="progress" style="height: 5px;">
                    <div id="strengthBar" class="progress-bar" role="progressbar" style="width: 0%"></div>
                </div>
                <small class="text-muted mt-1 d-block">
                    <i class="fas fa-info-circle mr-1"></i>Gunakan kombinasi huruf besar, kecil, angka, dan simbol
                </small>
            </div>
        </div>

        <!-- Confirm Password Field -->
        <div class="form-group">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="font-weight-bold">
                <i class="fas fa-check-circle mr-1 text-info"></i>
            </x-input-label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <x-text-input id="update_password_password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="form-control password-input" 
                    autocomplete="new-password"
                    placeholder="Ketik ulang password baru"
                    oninput="checkPasswordMatch()" />
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary toggle-password" type="button" onclick="togglePassword('update_password_password_confirmation')">
                        <i class="fas fa-eye" id="icon-update_password_password_confirmation"></i>
                    </button>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            
            <!-- Password Match Indicator -->
            <div id="passwordMatch" class="mt-2" style="display: none;">
                <small class="match-text"></small>
            </div>
        </div>

        <!-- Security Tips -->
        <div class="alert alert-info" role="alert">
            <h6 class="alert-heading">
                <i class="fas fa-shield-alt mr-2"></i>Tips Keamanan Password:
            </h6>
            <ul class="mb-0 pl-3">
                <li>Minimal 8 karakter</li>
                <li>Kombinasikan huruf besar dan kecil</li>
                <li>Tambahkan angka dan simbol (@, #, $, dll)</li>
                <li>Hindari menggunakan informasi pribadi</li>
                <li>Jangan gunakan password yang sama untuk akun lain</li>
            </ul>
        </div>

        <!-- Save Button -->
        <div class="d-flex align-items-center gap-3 mt-4 pt-3 border-top">
            <x-primary-button class="btn btn-warning btn-lg text-white">
                <i class="fas fa-save mr-2"></i>{{ __('Update Password') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                    class="alert alert-success mb-0 py-2 px-3">
                    <i class="fas fa-check-circle mr-2"></i>{{ __('Password berhasil diperbarui!') }}
                </p>
            @endif
        </div>
    </form>
</section>

<script>
// Toggle Password Visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById('icon-' + fieldId);
    
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

// Check Password Strength
function checkPasswordStrength(password) {
    const strengthIndicator = document.getElementById('passwordStrength');
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');
    
    if (password.length === 0) {
        strengthIndicator.style.display = 'none';
        return;
    }
    
    strengthIndicator.style.display = 'block';
    
    let strength = 0;
    const checks = {
        length: password.length >= 8,
        lowercase: /[a-z]/.test(password),
        uppercase: /[A-Z]/.test(password),
        numbers: /\d/.test(password),
        symbols: /[!@#$%^&*(),.?":{}|<>]/.test(password)
    };
    
    // Calculate strength
    Object.values(checks).forEach(check => {
        if (check) strength += 20;
    });
    
    // Update UI
    strengthBar.style.width = strength + '%';
    
    if (strength <= 40) {
        strengthBar.className = 'progress-bar bg-danger';
        strengthText.className = 'badge badge-danger';
        strengthText.textContent = 'Lemah';
    } else if (strength <= 60) {
        strengthBar.className = 'progress-bar bg-warning';
        strengthText.className = 'badge badge-warning';
        strengthText.textContent = 'Sedang';
    } else if (strength <= 80) {
        strengthBar.className = 'progress-bar bg-info';
        strengthText.className = 'badge badge-info';
        strengthText.textContent = 'Baik';
    } else {
        strengthBar.className = 'progress-bar bg-success';
        strengthText.className = 'badge badge-success';
        strengthText.textContent = 'Kuat';
    }
    
    // Also check match when typing new password
    checkPasswordMatch();
}

// Check Password Match
function checkPasswordMatch() {
    const password = document.getElementById('update_password_password').value;
    const confirmPassword = document.getElementById('update_password_password_confirmation').value;
    const matchIndicator = document.getElementById('passwordMatch');
    const matchText = matchIndicator.querySelector('.match-text');
    
    if (confirmPassword.length === 0) {
        matchIndicator.style.display = 'none';
        return;
    }
    
    matchIndicator.style.display = 'block';
    
    if (password === confirmPassword) {
        matchText.innerHTML = '<i class="fas fa-check-circle text-success mr-1"></i><span class="text-success">Password cocok</span>';
    } else {
        matchText.innerHTML = '<i class="fas fa-times-circle text-danger mr-1"></i><span class="text-danger">Password tidak cocok</span>';
    }
}
</script>

<style>
/* Form Group Spacing */
.form-group {
    margin-bottom: 1.5rem;
}

/* Input Group Styling */
.input-group {
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border-radius: 0.375rem;
    overflow: hidden;
}

.input-group-text {
    border: 1px solid #d1d5db;
    background-color: #f9fafb;
    color: #6b7280;
}

.form-control {
    border: 1px solid #d1d5db;
    padding: 0.625rem 0.875rem;
    font-size: 0.95rem;
    transition: all 0.2s;
}

.form-control:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.1);
    outline: none;
}

/* Toggle Password Button */
.toggle-password {
    border: 1px solid #d1d5db;
    background-color: #fff;
    color: #6b7280;
    cursor: pointer;
    transition: all 0.2s;
}

.toggle-password:hover {
    background-color: #f9fafb;
    color: #374151;
}

.toggle-password:focus {
    box-shadow: none;
    border-color: #ffc107;
}

/* Password Strength Indicator */
#passwordStrength {
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.progress {
    background-color: #e5e7eb;
    border-radius: 0.25rem;
    overflow: hidden;
}

.progress-bar {
    transition: width 0.3s ease, background-color 0.3s ease;
}

/* Password Match Indicator */
#passwordMatch {
    animation: slideDown 0.3s ease;
}

/* Security Tips Alert */
.alert-info {
    background-color: #dbeafe;
    border-color: #93c5fd;
    color: #1e40af;
    border-radius: 0.5rem;
}

.alert-info .alert-heading {
    color: #1e3a8a;
    font-size: 0.95rem;
    margin-bottom: 0.75rem;
}

.alert-info ul {
    margin-bottom: 0;
    font-size: 0.875rem;
}

.alert-info ul li {
    margin-bottom: 0.25rem;
}

/* Labels with Icons */
label {
    color: #374151;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

label i {
    font-size: 0.9rem;
}

/* Button Styling */
.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
    color: white;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    border-radius: 0.5rem;
    transition: all 0.2s;
}

.btn-warning:hover {
    background-color: #f59e0b;
    border-color: #f59e0b;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(245, 158, 11, 0.3);
}

/* Success Alert */
.alert-success {
    background-color: #d1fae5;
    border-color: #6ee7b7;
    color: #065f46;
    border-radius: 0.5rem;
    animation: slideInRight 0.3s ease;
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Border Top */
.border-top {
    border-top: 2px solid #e5e7eb !important;
}

/* Gap Utility */
.gap-3 {
    gap: 1rem;
}

/* Badge Styling */
.badge {
    font-size: 0.75rem;
    padding: 0.35rem 0.6rem;
    font-weight: 600;
}

/* Responsive */
@media (max-width: 768px) {
    .input-group-text {
        padding: 0.5rem 0.75rem;
    }
    
    .toggle-password {
        padding: 0.5rem 0.75rem;
    }
    
    .btn-lg {
        padding: 0.6rem 1.2rem;
        font-size: 0.95rem;
    }
    
    .alert-info ul {
        padding-left: 1rem;
    }
}

/* Input Group Focus State */
.input-group:focus-within .input-group-text {
    border-color: #ffc107;
    background-color: #fff;
    color: #f59e0b;
}

.input-group:focus-within .toggle-password {
    border-color: #ffc107;
}
</style>
