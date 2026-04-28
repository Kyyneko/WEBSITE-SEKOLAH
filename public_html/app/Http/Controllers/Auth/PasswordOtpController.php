<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordOtpMail;

class PasswordOtpController extends Controller
{
    /**
     * Tampilkan halaman form verifikasi OTP.
     */
    public function showVerifyForm()
    {
        if (!session()->has('password_otp')) {
            return redirect()->route('profile.edit')->with('error', 'Sesi OTP tidak valid atau sudah kadaluarsa.');
        }

        return view('profile.verify-otp');
    }

    /**
     * Verifikasi kode OTP.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $otpSession = session('password_otp');

        if (!$otpSession) {
            return redirect()->route('profile.edit')->with('error', 'Sesi OTP tidak valid atau sudah kadaluarsa.');
        }

        if (now()->greaterThan($otpSession['expires_at'])) {
            session()->forget('password_otp');
            return redirect()->route('profile.edit')->with('error', 'Kode OTP sudah kadaluarsa. Silakan ulangi proses ganti kata sandi.');
        }

        if ($request->otp !== $otpSession['code']) {
            return back()->withErrors(['otp' => 'Kode OTP yang Anda masukkan salah.']);
        }

        // Jika OTP benar, update password
        $request->user()->update([
            'password' => $otpSession['new_password'],
        ]);

        // Hapus session OTP
        session()->forget('password_otp');

        return redirect()->route('profile.edit')->with('status', 'password-updated');
    }

    /**
     * Kirim ulang kode OTP.
     */
    public function resendOtp(Request $request)
    {
        $otpSession = session('password_otp');

        if (!$otpSession) {
            return redirect()->route('profile.edit')->with('error', 'Sesi OTP tidak valid. Silakan ulangi proses ganti kata sandi.');
        }

        // Buat OTP baru
        $newOtp = sprintf("%06d", mt_rand(100000, 999999));

        // Update session
        session()->put('password_otp', [
            'code' => $newOtp,
            'new_password' => $otpSession['new_password'],
            'expires_at' => now()->addMinutes(10),
        ]);

        // Kirim email
        Mail::to($request->user()->email)->send(new PasswordOtpMail($newOtp));

        return back()->with('status', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}
