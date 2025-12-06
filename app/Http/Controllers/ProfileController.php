<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Tampilkan form profile.
     */
    public function edit(Request $request)
    {
        $user = $request->user();
        $subjects = Subject::all(); // kalau mau dipakai di view

        return view('profile.edit', [
            'user' => $user,
            'subjects' => $subjects,
        ]);
    }

    /**
     * Update profile user + simpan foto.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        // Data dasar dari form
        $user->name  = $request->input('name');
        $user->nik   = $request->input('nik');
        $user->nip   = $request->input('nip');
        $user->ttl   = $request->input('ttl');
        $user->phone = $request->input('phone');

        // Role (optional, hanya kalau admin)
        if ($user->role === 'admin' && $request->filled('role')) {
            $user->role = $request->input('role');
        }

        // Kalau pakai email di form (sekarang disembunyikan)
        if ($request->filled('email')) {
            $oldEmail    = $user->email;
            $user->email = $request->input('email');

            if ($oldEmail !== $user->email) {
                $user->email_verified_at = null;
            }
        }

        // Handle upload foto
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],
            ]);

            // Hapus foto lama (kalau ada)
            if ($user->photo_path) {
                Storage::disk('public')->delete($user->photo_path);
            }

            // Simpan foto baru ke disk "public" → storage/app/public/photos
            // Nilai yang masuk ke DB: photos/xxxx.jpg
            $path = $request->file('photo')->store('photos', 'public');
            $user->photo_path = $path;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Hapus akun user.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Opsional: hapus foto ketika akun dihapus
        if ($user->photo_path) {
            Storage::disk('public')->delete($user->photo_path);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
