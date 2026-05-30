<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\Organisasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;

class UserController extends Controller
{
    public function index()
    {
        $users = User::simplePaginate(8); // Menggunakan pagination dengan 8 item per halaman
        $subjects = Subject::all();
        return view('backend.usersManage.index', compact('users', 'subjects'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $organisasis = Organisasi::all();
        return view('backend.usersManage.create', compact('subjects', 'organisasis'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,teacher,staff',
            'position' => 'nullable|string|max:255',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,webp,heic,heif|max:100000',
        ];

        // subject_id & organisasi_id hanya valid jika role adalah teacher
        if ($request->role === 'teacher') {
            $rules['subject_id'] = 'required|exists:subjects,id';
            $rules['organisasi_id'] = 'nullable|exists:organisasis,id';
        }

        $request->validate($rules);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'position' => in_array($request->role, ['teacher', 'staff']) ? $request->position : null,
            'subject_id' => $request->role === 'teacher' ? $request->subject_id : null,
            'organisasi_id' => $request->role === 'teacher' ? $request->organisasi_id : null,
        ];

        if ($request->hasFile('photo')) {
            try {
                $path = ImageOptimizer::compressAndStore($request->file('photo'), 'profile_photos');
                $data['photo_path'] = $path;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => $e->getMessage()])->withInput();
            }
        }

        $user = User::create($data);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        $subjects = Subject::all();
        $organisasis = Organisasi::all();
        return view('backend.usersManage.edit', compact('user', 'subjects', 'organisasis'));
    }

    public function update(Request $request, User $user)
    {
        // Validasi data
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,teacher,staff',
            'position' => 'nullable|string|max:255',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,webp,heic,heif|max:100000',
        ];
        
        if ($request->role === 'teacher') {
            $rules['subject_id'] = 'required|exists:subjects,id';
            $rules['organisasi_id'] = 'nullable|exists:organisasis,id';
        }

        $request->validate($rules);
    
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'position' => in_array($request->role, ['teacher', 'staff']) ? $request->position : null,
            'subject_id' => $request->role === 'teacher' ? $request->subject_id : null,
            'organisasi_id' => $request->role === 'teacher' ? $request->organisasi_id : null,
        ];
        
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo_path) {
                Storage::delete($user->photo_path);
            }
            try {
                $path = ImageOptimizer::compressAndStore($request->file('photo'), 'profile_photos');
                $data['photo_path'] = $path;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => $e->getMessage()])->withInput();
            }
        }
    
        $user->update($data);
    
        // Memperbarui kata sandi jika ada kata sandi baru yang dimasukkan
        if ($request->filled('new_password')) {
            $user->update(['password' => Hash::make($request->new_password)]);
        }
    
        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        // Hapus foto profil dari storage jika ada
        if ($user->photo_path) {
            Storage::delete($user->photo_path);
        }
        
        // Hapus user dari database
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
