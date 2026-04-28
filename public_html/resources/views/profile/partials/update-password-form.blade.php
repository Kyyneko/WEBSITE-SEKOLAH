<section>
    <form method="post" action="{{ route('password.update') }}" class="profile-form">
        @csrf
        @method('put')

        <div class="form-group mb-3">
            <label for="update_password_current_password" class="profile-label">
                <i class="fas fa-key me-1"></i>Password Saat Ini
            </label>
            <input id="update_password_current_password" name="current_password" type="password" 
                   class="form-control" autocomplete="current-password" placeholder="Password saat ini">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1" />
        </div>

        <div class="form-group mb-3">
            <label for="update_password_password" class="profile-label">
                <i class="fas fa-lock me-1"></i>Password Baru
            </label>
            <input id="update_password_password" name="password" type="password" 
                   class="form-control" autocomplete="new-password" placeholder="Password baru">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
        </div>

        <div class="form-group mb-3">
            <label for="update_password_password_confirmation" class="profile-label">
                <i class="fas fa-check-circle me-1"></i>Konfirmasi Password
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                   class="form-control" autocomplete="new-password" placeholder="Ketik ulang password baru">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="d-flex align-items-center gap-2 pt-3" style="border-top:1px solid var(--dash-border);">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-save me-1"></i> Update Password
            </button>
            @if (session('status') === 'password-updated')
                <span class="text-success" style="font-size:0.8rem;"><i class="fas fa-check-circle me-1"></i>Tersimpan!</span>
            @endif
        </div>
    </form>
</section>
