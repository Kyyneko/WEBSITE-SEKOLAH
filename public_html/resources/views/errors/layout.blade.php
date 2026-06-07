<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('image/Logo.png') }}">
    <title>@yield('title') — UPT SPF SMPN 14 BULUKUMBA</title>
    
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #6366f1;
            --bg-start: #0f172a;
            --bg-end: #1e1b4b;
            --text-main: #f8fafc;
            --text-sub: #94a3b8;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--bg-start) 0%, var(--bg-end) 100%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            padding: 1.5rem;
        }

        /* Abstract Glow Orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            z-index: 1;
            opacity: 0.12;
        }

        .orb-1 {
            width: 400px;
            height: 400px;
            background: var(--primary);
            top: -100px;
            left: -100px;
            animation: floatOrb 12s infinite alternate ease-in-out;
        }

        .orb-2 {
            width: 500px;
            height: 500px;
            background: #0d9488;
            bottom: -150px;
            right: -100px;
            animation: floatOrb 16s infinite alternate-reverse ease-in-out;
        }

        @keyframes floatOrb {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(50px, 40px) scale(1.1); }
        }

        /* Error Card */
        .error-card {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 4rem 2.5rem;
            width: 100%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            z-index: 10;
            position: relative;
            animation: cardEntrance 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Error Code Glow */
        .error-code {
            font-size: 6rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.05em;
            background: linear-gradient(135deg, #a5b4fc 0%, #818cf8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
            filter: drop-shadow(0 4px 12px rgba(99, 102, 241, 0.2));
            animation: pulseCode 3s infinite ease-in-out;
        }

        @keyframes pulseCode {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.03); }
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #f1f5f9;
        }

        p {
            font-size: 0.9rem;
            color: var(--text-sub);
            line-height: 1.6;
            margin-bottom: 2.25rem;
        }

        .icon-container {
            font-size: 3rem;
            color: #818cf8;
            margin-bottom: 1.5rem;
            opacity: 0.85;
            animation: floatIcon 4s infinite ease-in-out;
        }

        @keyframes floatIcon {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .home-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            text-decoration: none;
            padding: 0.8rem 1.75rem;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            border: none;
            cursor: pointer;
        }

        .home-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
            filter: brightness(1.1);
        }

        .home-btn:active {
            transform: translateY(0);
        }

        footer {
            margin-top: 3rem;
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.25);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
    </style>
</head>
<body>

    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="error-card">
        <div class="icon-container">
            @yield('icon')
        </div>
        
        <div class="error-code">@yield('code')</div>
        
        <h2>@yield('heading')</h2>
        
        <p>@yield('message')</p>

        <a href="{{ url('/') }}" class="home-btn">
            <i class="fas fa-home"></i> Kembali ke Beranda
        </a>

        <footer>
            &copy; 2026 UPT SPF SMPN 14 BULUKUMBA
        </footer>
    </div>

</body>
</html>
