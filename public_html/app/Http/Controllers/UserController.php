<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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
    return view('backend.usersManage.create', compact('subjects'));
}


public function store(Request $request)
{
    // Validasi data
    $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required|in:admin,teacher',
    ];

    // subject_id hanya wajib jika role adalah teacher
    if ($request->role === 'teacher') {
        $rules['subject_id'] = 'required|exists:subjects,id';
    }

    $request->validate($rules);

    // Enkripsi password
    $password = Hash::make($request->password);

    // Simpan data ke dalam database
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $password,
        'role' => $request->role,
        'subject_id' => $request->role === 'teacher' ? $request->subject_id : null,
    ]);

    return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
}




    public function edit(User $user)
    {
        $subjects = Subject::all();
        return view('backend.usersManage.edit', compact('user', 'subjects'));
    }

 // Fungsi update di kontroler
    public function update(Request $request, User $user)
    {
        // Validasi data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,teacher', // Menambahkan validasi untuk peran
        ]);
    
        // Memperbarui data pengguna
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);
    
        // Memperbarui kata sandi jika ada kata sandi baru yang dimasukkan
        if ($request->filled('new_password')) {
            $user->update(['password' => bcrypt($request->new_password)]);
        }
    
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }


    public function destroy(User $user)
    {
        // Hapus user dari database
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

}
