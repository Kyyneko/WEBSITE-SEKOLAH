<!DOCTYPE html>
<html>
<head>
    <title>Kode OTP Perubahan Kata Sandi</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h2 style="color: #1e3a5f; text-align: center;">UPT SPF SMPN 14 BULUKUMBA</h2>
        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin-bottom: 20px;">
        <p>Halo,</p>
        <p>Kami menerima permintaan untuk mengubah kata sandi akun Anda. Silakan gunakan kode OTP berikut untuk memverifikasi perubahan tersebut:</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <span style="display: inline-block; padding: 15px 30px; font-size: 24px; font-weight: bold; background-color: #f1f5f9; color: #1e3a5f; border-radius: 8px; letter-spacing: 5px;">
                {{ $otp }}
            </span>
        </div>
        
        <p style="color: #64748b; font-size: 14px;">Kode OTP ini hanya berlaku selama 10 menit. <strong>Jangan berikan kode ini kepada siapapun</strong>.</p>
        <p style="color: #64748b; font-size: 14px;">Jika Anda tidak meminta perubahan kata sandi, harap abaikan email ini dan pastikan akun Anda aman.</p>
        
        <br>
        <p>Terima kasih,<br>Tim Administrator SMPN 14 BULUKUMBA</p>
    </div>
</body>
</html>
