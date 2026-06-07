<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('image/Logo.png') }}">
    <title>Pemeliharaan Sistem — UPT SPF SMPN 14 BULUKUMBA</title>
    
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary: #1e3a5f;
            --primary-light: #2563eb;
            --bg-start: #0a0f1d;
            --bg-end: #1c2e4a;
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
            opacity: 0.15;
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

        /* Glassmorphism Container */
        .maintenance-card {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 550px;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            z-index: 10;
            position: relative;
            animation: cardEntrance 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animated Icon */
        .icon-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-bg {
            position: absolute;
            inset: 0;
            background: rgba(37, 99, 235, 0.15);
            border-radius: 30px;
            transform: rotate(45deg);
            animation: pulseBg 3s infinite ease-in-out;
        }

        @keyframes pulseBg {
            0%, 100% { transform: rotate(45deg) scale(1); }
            50% { transform: rotate(45deg) scale(1.08); }
        }

        .icon-main {
            font-size: 3.25rem;
            color: #3b82f6;
            z-index: 2;
            animation: spinGear 8s infinite linear;
        }

        @keyframes spinGear {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        h1 {
            font-size: 1.85rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            margin-bottom: 1rem;
            background: linear-gradient(to right, #ffffff, #93c5fd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p {
            font-size: 0.95rem;
            color: var(--text-sub);
            line-height: 1.6;
            margin-bottom: 2rem;
        }



        .contact-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            text-decoration: none;
            padding: 0.85rem 1.75rem;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            border: none;
            cursor: pointer;
        }

        .contact-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
            filter: brightness(1.1);
        }

        .contact-btn:active {
            transform: translateY(0);
        }

        footer {
            margin-top: 2.5rem;
            font-size: 0.72rem;
            color: rgba(255, 255, 255, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
    </style>
</head>
<body>

    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="maintenance-card">
        <div class="icon-wrapper">
            <div class="icon-bg"></div>
            <i class="fas fa-cog icon-main"></i>
        </div>

        <h1>Pemeliharaan Sistem</h1>
        <p>Mohon maaf atas ketidaknyamanan ini. Kami sedang melakukan pemeliharaan rutin dan peningkatan server untuk memberikan pengalaman akses yang lebih baik bagi seluruh warga sekolah.</p>



        <a href="mailto:admin@smpn14bulukumba.sch.id" class="contact-btn">
            <i class="fas fa-envelope"></i> Hubungi Administrator
        </a>

        <footer>
            &copy; 2026 UPT SPF SMPN 14 BULUKUMBA. All Rights Reserved.
        </footer>
    </div>

    <script>
        // Cek status pemeliharaan setiap 5 detik
        setInterval(function() {
            fetch('/maintenance/status')
                .then(response => response.json())
                .then(data => {
                    if (data.maintenance === false) {
                        // Jika pemeliharaan selesai, segarkan halaman atau alihkan ke beranda
                        window.location.href = '/';
                    }
                })
                .catch(error => console.error('Error checking status:', error));
        }, 5000);
    </script>
</body>
</html>
