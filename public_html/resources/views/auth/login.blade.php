<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — UPT SPF SMPN 14 BULUKUMBA</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            background: #0f172a;
        }

        /* ===== LEFT PANEL ===== */
        .login-left {
            flex: 1;
            background: linear-gradient(160deg, #1e3a5f 0%, #152e4d 40%, #0a1929 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2.5rem 3rem;
            position: relative;
            overflow: hidden;
        }

        /* Glow orbs */
        .login-left::before,
        .login-left::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .login-left::before {
            width: 350px; height: 350px;
            top: -80px; right: -60px;
            background: radial-gradient(circle, rgba(37,99,235,0.1) 0%, transparent 70%);
        }

        .login-left::after {
            width: 300px; height: 300px;
            bottom: -60px; left: -60px;
            background: radial-gradient(circle, rgba(14,184,166,0.07) 0%, transparent 70%);
        }

        .left-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .left-logo {
            width: 72px;
            height: 72px;
            object-fit: contain;
            margin: 0 auto 1.2rem;
            display: block;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));
        }

        .left-title {
            font-size: 1.2rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.35;
            margin-bottom: 0.3rem;
        }

        .left-subtitle {
            font-size: 0.68rem;
            color: rgba(255,255,255,0.35);
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 1.8rem;
        }

        .left-features {
            text-align: left;
            max-width: 300px;
            margin: 0 auto;
        }

        .left-feat {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 0;
        }

        .left-feat-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: rgba(96,165,250,0.1);
            border: 1px solid rgba(96,165,250,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #60a5fa;
            font-size: 0.72rem;
            flex-shrink: 0;
        }

        .left-feat span {
            color: rgba(255,255,255,0.5);
            font-size: 0.75rem;
            font-weight: 500;
        }

        .left-footer {
            position: absolute;
            bottom: 1.2rem;
            left: 0; right: 0;
            text-align: center;
            font-size: 0.6rem;
            color: rgba(255,255,255,0.12);
            z-index: 1;
        }

        /* ===== RIGHT PANEL ===== */
        .login-right {
            width: 520px;
            min-width: 520px;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem;
            position: relative;
            box-shadow: -8px 0 30px rgba(0,0,0,0.08);
        }

        .form-wrap {
            width: 100%;
            max-width: 360px;
            margin: 0 auto;
        }

        /* Heading */
        .form-heading {
            margin-bottom: 1.8rem;
        }

        .form-heading h1 {
            font-size: 1.6rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .form-heading p {
            font-size: 0.82rem;
            color: #94a3b8;
        }

        /* Session status */
        .form-status {
            padding: 0.55rem 0.75rem;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: 8px;
            color: #065f46;
            font-size: 0.78rem;
            margin-bottom: 1.2rem;
        }

        /* Fields */
        .field {
            margin-bottom: 1rem;
        }

        .field label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.4rem;
            text-transform: none;
        }

        .field-input-wrap {
            position: relative;
        }

        .field-input-wrap .fi {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 0.78rem;
            pointer-events: none;
            transition: color 0.2s;
        }

        .field-input {
            width: 100%;
            padding: 0.7rem 0.9rem 0.7rem 2.5rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.84rem;
            font-family: 'Inter', sans-serif;
            color: #1e293b;
            background: #fff;
            transition: all 0.2s;
            outline: none;
        }

        .field-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.08);
        }

        .field-input-wrap:focus-within .fi {
            color: #2563eb;
        }

        .field-input::placeholder {
            color: #cbd5e1;
        }

        .field-error {
            font-size: 0.72rem;
            color: #ef4444;
            margin-top: 0.3rem;
            font-weight: 500;
        }

        /* Actions */
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 0.5rem 0 1.5rem;
        }

        .form-remember {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.78rem;
            color: #64748b;
            cursor: pointer;
        }

        .form-remember input {
            width: 15px; height: 15px;
            accent-color: #2563eb;
            cursor: pointer;
        }

        .form-forgot {
            font-size: 0.78rem;
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .form-forgot:hover { color: #1d4ed8; }

        /* Button */
        .form-btn {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.25s;
            letter-spacing: 0.01em;
        }

        .form-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(37,99,235,0.25);
        }

        .form-btn:active { transform: translateY(0); }

        .form-back {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.78rem;
            color: #94a3b8;
            text-decoration: none;
            font-weight: 500;
            margin-top: 1.5rem;
        }

        .form-back:hover { color: #2563eb; }

        /* ===== OR DIVIDER ===== */
        .form-or {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 1.25rem 0;
            color: #cbd5e1;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .form-or::before,
        .form-or::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        /* ===== GOOGLE BUTTON ===== */
        .google-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            padding: 0.7rem;
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.84rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            color: #374151;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .google-btn:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            color: #374151;
        }

        .google-btn svg {
            width: 18px;
            height: 18px;
        }

        .form-alert-error {
            padding: 0.55rem 0.75rem;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            color: #991b1b;
            font-size: 0.78rem;
            font-weight: 500;
            margin-bottom: 1.2rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 960px) {
            body { flex-direction: column; overflow-y: auto; }

            .login-left {
                min-height: 240px;
                padding: 2rem;
            }

            .left-features, .left-footer { display: none; }
            .left-subtitle { margin-bottom: 0; }

            .login-right {
                width: 100%;
                min-width: auto;
                flex: 1;
                padding: 2rem 1.5rem;
                box-shadow: none;
            }
        }

        @media (max-width: 480px) {
            .login-left { min-height: 180px; padding: 1.5rem; }
            .left-logo { width: 56px; height: 56px; }
            .left-title { font-size: 1rem; }
            .form-wrap { max-width: 100%; }
        }
    </style>
</head>

<body>
    {{-- LEFT --}}
    <div class="login-left">
        <div class="left-content">
            <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="left-logo">
            <h1 class="left-title">UPT SPF SMPN 14<br>BULUKUMBA</h1>
            <p class="left-subtitle">Sistem Informasi Sekolah</p>

            <div class="left-features">
                <div class="left-feat">
                    <div class="left-feat-icon"><i class="fas fa-newspaper"></i></div>
                    <span>Kelola artikel & berita sekolah</span>
                </div>
                <div class="left-feat">
                    <div class="left-feat-icon"><i class="fas fa-file-alt"></i></div>
                    <span>Manajemen perangkat pembelajaran</span>
                </div>
                <div class="left-feat">
                    <div class="left-feat-icon"><i class="fas fa-users"></i></div>
                    <span>Data guru & organisasi sekolah</span>
                </div>
            </div>
        </div>
        <div class="left-footer">&copy; {{ date('Y') }} UPT SPF SMPN 14 BULUKUMBA</div>
    </div>

    {{-- RIGHT --}}
    <div class="login-right">
        <div class="form-wrap">
            <div class="form-heading">
                <h1>Selamat Datang 👋</h1>
                <p>Masuk untuk mengakses dashboard admin</p>
            </div>

            @if (session('status'))
                <div class="form-status">{{ session('status') }}</div>
            @endif

            @if (session('error'))
                <div class="form-alert-error">
                    <i class="fas fa-exclamation-circle" style="margin-right:4px;"></i>{{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="field">
                    <label for="email">Email atau Username</label>
                    <div class="field-input-wrap">
                        <i class="fas fa-user fi"></i>
                        <input id="email" type="text" name="email" class="field-input"
                               value="{{ old('email') }}" required autofocus autocomplete="username"
                               placeholder="Email atau username">
                    </div>
                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="field-input-wrap">
                        <i class="fas fa-lock fi"></i>
                        <input id="password" type="password" name="password" class="field-input"
                               required autocomplete="current-password"
                               placeholder="Masukkan password">
                    </div>
                    @error('password')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <label class="form-remember">
                        <input type="checkbox" name="remember"> Ingat saya
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="form-forgot">Lupa Password?</a>
                    @endif
                </div>

                <button type="submit" class="form-btn">
                    <i class="fas fa-sign-in-alt" style="margin-right:6px;"></i>Masuk
                </button>
            </form>

            <div class="form-or">atau</div>

            <a href="{{ route('auth.google') }}" class="google-btn">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Masuk dengan Google
            </a>

            <a href="/" class="form-back" style="justify-content:center;width:100%;display:flex;margin-top:1rem;">
                <i class="fas fa-globe" style="margin-right:4px;"></i> Kembali ke Website
            </a>
        </div>
    </div>
</body>
</html>
