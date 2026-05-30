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
            })->get();
        } else {
            $adminDocuments = Document::whereHas('user', function ($query) {
                $query->where('role', 'admin');
            })->get();

            $nonAdminDocuments = Document::whereHas('user', function ($query) {
                $query->where('role', 'teacher');
            })->where(function ($query) {
                $query->where('status', 'approved')
                      ->orWhere('user_id', Auth::id());
            })->get();
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
            'file' => 'required|mimes:pdf,doc,docx,xls,xlsx|max:100240',
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
            $document->status = Auth::user()->role === 'admin' ? 'approved' : 'pending';
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

    public function approve(Document $document)
    {
        $document->status = 'approved';
        $document->save();

        return redirect()->back()->with('success', 'Dokumen berhasil disetujui.');
    }

    public function reject(Document $document)
    {
        $document->status = 'rejected';
        $document->save();

        return redirect()->back()->with('success', 'Dokumen ditolak.');
    }

    public function preview(Document $document)
    {
        if (!Storage::exists($document->file_path)) {
            abort(404);
        }

        $path = Storage::path($document->file_path);

        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
        ]);
    }
}
