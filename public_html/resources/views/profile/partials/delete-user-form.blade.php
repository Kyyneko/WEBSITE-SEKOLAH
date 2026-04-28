<section>
    <p style="font-size:0.8rem;color:var(--dash-text-light);line-height:1.5;margin-bottom:1rem;">
        Setelah akun dihapus, semua data dan file akan hilang permanen. Pastikan Anda sudah backup data penting.
    </p>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn btn-danger btn-sm"
    >
        <i class="fas fa-trash-alt me-1"></i>Hapus Akun
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-4 profile-form">
            @csrf
            @method('delete')

            <div class="text-center mb-4">
                <div style="width:56px;height:56px;border-radius:50%;background:rgba(239,68,68,0.1);display:inline-flex;align-items:center;justify-content:center;margin-bottom:0.75rem;">
                    <i class="fas fa-exclamation-triangle" style="font-size:1.5rem;color:var(--dash-danger);"></i>
                </div>
                <h6 style="font-weight:700;color:var(--dash-text);">Hapus Akun Anda?</h6>
                <p style="font-size:0.8rem;color:var(--dash-text-light);margin-bottom:0;">Tindakan ini tidak dapat dibatalkan. Masukkan password untuk konfirmasi.</p>
            </div>

            <div class="form-group mb-4">
                <label for="password" class="profile-label"><i class="fas fa-lock me-1"></i>Password</label>
                <input id="password" name="password" type="password" class="form-control" 
                       placeholder="Masukkan password Anda" required
                       style="font-size:0.84rem;padding:0.5rem 0.75rem;border:1.5px solid var(--dash-border);border-radius:8px;">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1" />
            </div>

            <div class="d-flex justify-content-end gap-2 pt-3" style="border-top:1px solid var(--dash-border);">
                <x-secondary-button x-on:click="$dispatch('close')" class="btn btn-secondary btn-sm">
                    Batal
                </x-secondary-button>
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash-alt me-1"></i>Ya, Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
