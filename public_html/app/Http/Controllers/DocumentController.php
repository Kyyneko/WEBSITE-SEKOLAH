<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUserRole = Auth::user()->role;

    if ($currentUserRole === 'admin') {
        $adminDocuments = Document::whereHas('user', function ($query) {
            $query->where('role', 'admin');
        })->get();

        $nonAdminDocuments = Document::whereHas('user', function ($query) {
            $query->where('role', 'teacher');
        })->get();; // Tidak ada dokumen non-admin untuk admin
    } else {
        $adminDocuments = Document::whereHas('user', function ($query) {
            $query->where('role', 'admin');
        })->get();; // Tidak ada dokumen admin untuk non-admin

        $nonAdminDocuments = Document::whereHas('user', function ($query) {
            $query->where('role', '!=', 'admin');
        })->where('user_id', Auth::id())->get();
    }

    return view('backend.perangkatManage.perangkat', compact('adminDocuments', 'nonAdminDocuments'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,xlsx|max:100240', // Maksimum 2MB
        ]);
    
        // Proses penyimpanan file jika validasi sukses
        if ($request->file('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/dokumen', $fileName); // Simpan file ke direktori 'storage/dokumen'
    
            // Dapatkan ID pengguna yang saat ini diotentikasi
            $userId = Auth::id();
    
            // Simpan path file ke dalam database bersama dengan user_id
            $document = new Document();
            $document->user_id = $userId;
            $document->file_path = $filePath;
            $document->save();
    
            return redirect()->back()->with('success', 'File berhasil diunggah.');
        }
    
        // Jika validasi gagal atau terjadi kesalahan lainnya, kirimkan pesan error
        return redirect()->back()->with('error', 'Gagal mengunggah file.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    public function download(Document $document)
{
    return Storage::download($document->file_path);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
{
    // Hapus dokumen dari penyimpanan
    Storage::delete($document->file_path);

    // Hapus dokumen dari database
    $document->delete();

    return redirect()->back()->with('success', 'Dokumen berhasil dihapus.');
}
}
