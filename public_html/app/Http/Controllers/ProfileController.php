<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $subjects = Subject::all(); // Ambil semua data subject
    
        return view('profile.edit', [
            'user' => $user,
            'subjects' => $subjects, // Kirimkan data subject ke view
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();
    $validatedData = $request->validated();

    if ($request->hasFile('photo')) {
        // Mendapatkan file yang diunggah
        $photo = $request->file('photo');

        // Menyimpan foto ke dalam direktori penyimpanan
        $path = $photo->store('public/photos');

        // Menghapus foto lama jika ada
        if ($user->photo_path) {
            Storage::delete($user->photo_path); // Menghapus foto lama dari penyimpanan
        }

        // Mengupdate path foto pada model user
        $user->photo_path = $path; // Memperbarui kolom photo_path
    }

    // Mengisi data dari request ke model user
    $user->fill([
        'name' => $request->name,
        'email' => $request->email,
        'nik' => $request->nik,
        'nip' => $request->nip,
        'ttl' => $request->ttl,
        'phone' => $request->phone,
    ]);

    // Mengosongkan email_verified_at jika email diubah
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    // Menyimpan perubahan pada model user
    $user->save();

    return redirect()->route('profile.edit')->with('success', 'Profile has been updated');
}

    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
