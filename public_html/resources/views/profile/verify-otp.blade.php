<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">{{ __('Verifikasi OTP Ganti Password') }}</h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-body p-4 p-md-5">
                            
                            <div class="text-center mb-4">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 70px; height: 70px; background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; font-size: 2rem;">
                                    <i class="fas fa-envelope-open-text"></i>
                                </div>
                                <h4 class="fw-bold" style="color: var(--dash-text);">Masukkan Kode OTP</h4>
                                <p class="text-muted" style="font-size: 0.95rem;">
                                    Kode verifikasi 6 digit telah dikirim ke email <br><strong>{{ auth()->user()->email }}</strong>.
                                </p>
                            </div>

                            @if (session('status'))
                                <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success mb-4" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger mb-4" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.otp.verify') }}">
                                @csrf

                                <!-- OTP -->
                                <div class="mb-4">
                                    <label for="otp" class="form-label fw-semibold text-muted">Kode OTP</label>
                                    <input id="otp" class="form-control form-control-lg text-center fw-bold" style="letter-spacing: 0.5rem; font-size: 1.5rem;"
                                           type="text" 
                                           name="otp" 
                                           required 
                                           autofocus 
                                           maxlength="6"
                                           placeholder="&bull;&bull;&bull;&bull;&bull;&bull;" />
                                    @error('otp')
                                        <div class="text-danger mt-2" style="font-size: 0.85rem;"><i class="fas fa-info-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid gap-2 mb-4">
                                    <button type="submit" class="btn btn-primary btn-lg" style="background-color: var(--dash-primary); border: none;">
                                        Verifikasi & Simpan Password
                                    </button>
                                </div>
                            </form>

                            <hr class="my-4" style="opacity: 0.1;">

                            <div class="text-center">
                                <p class="text-muted mb-2" style="font-size: 0.9rem;">Belum menerima kode OTP?</p>
                                <form method="POST" action="{{ route('password.otp.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-decoration-none p-0 fw-semibold" style="color: var(--dash-primary); font-size: 0.9rem;">
                                        Kirim Ulang OTP
                                    </button>
                                </form>
                            </div>

                            <div class="text-center mt-4">
                                <a href="{{ route('profile.edit') }}" class="text-decoration-none text-muted" style="font-size: 0.85rem;">
                                    <i class="fas fa-arrow-left me-1"></i> Batal & Kembali ke Profil
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
