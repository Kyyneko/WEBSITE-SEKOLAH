<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::simplePaginate(6); // Menggunakan simplePaginate dengan 6 item per halaman
        return view('backend.mapelManage.index', compact('subjects'));
    }

    public function create()
    {
        return view('backend.mapelManage.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Tambahkan validasi untuk kolom lainnya sesuai kebutuhan
        ]);

        Subject::create($request->all());

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('backend.mapelManage.edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string', // Tambahkan validasi untuk deskripsi
        ]);

        $subject->update($request->all());

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }
}
