<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = $request->user();

        // Pengecualian untuk superadmin (bisa ganti password tanpa OTP)
        if ($user->username === 'superadmin') {
            $user->update([
                'password' => Hash::make($validated['password']),
            ]);

            return back()->with('status', 'password-updated');
        }

        // Jika bukan superadmin, jalankan alur OTP
        $otp = sprintf("%06d", mt_rand(100000, 999999));

        // Simpan data di session (OTP berlaku 10 menit)
        session()->put('password_otp', [
            'code' => $otp,
            'new_password' => Hash::make($validated['password']),
            'expires_at' => now()->addMinutes(10),
        ]);

        // Kirim email OTP
        \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\PasswordOtpMail($otp));

        // Redirect ke halaman verifikasi OTP
        return redirect()->route('password.otp.form');
    }
}
