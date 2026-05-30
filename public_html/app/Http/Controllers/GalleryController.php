<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;
use ZipArchive;

class GalleryController extends Controller
{
    /**
     * Admin: Tampilkan daftar galeri foto.
     */
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->get();
        $categories = Gallery::select('category')->distinct()->pluck('category');
        return view('backend.galleryManage.index', compact('galleries', 'categories'));
    }

    /**
     * Admin: Simpan foto baru ke galeri.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'photos'   => 'required',
            'photos.*' => 'file|mimes:jpeg,png,jpg,gif,webp,heic,heif|max:100000',
            'description' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                try {
                    $path = ImageOptimizer::compressAndStore($photo, 'gallery_photos');

                    Gallery::create([
                        'title'       => $request->title,
                        'category'    => $request->category,
                        'photo_path'  => $path,
                        'description' => $request->description,
                    ]);
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['photos' => $e->getMessage()])->withInput();
                }
            }
        }

        return redirect()->route('gallery.index')
            ->with('success', 'Foto berhasil diunggah ke galeri!');
    }

    /**
     * Admin: Hapus foto dari galeri.
     */
    public function destroy(Gallery $gallery)
    {
        // Hapus file fisik dari storage
        if ($gallery->photo_path && Storage::exists($gallery->photo_path)) {
            Storage::delete($gallery->photo_path);
        }

        $gallery->delete();

        return redirect()->route('gallery.index')
            ->with('success', 'Foto berhasil dihapus dari galeri.');
    }

    /**
     * Admin: Download satu foto.
     */
    public function download(Gallery $gallery)
    {
        $storagePath = $gallery->photo_path;

        // Handle different path formats
        if (str_starts_with($storagePath, 'public/')) {
            $diskPath = storage_path('app/' . $storagePath);
        } else {
            $diskPath = storage_path('app/public/' . $storagePath);
        }

        if (!file_exists($diskPath)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        $filename = $gallery->title . '_' . $gallery->id . '.' . pathinfo($diskPath, PATHINFO_EXTENSION);
        return response()->download($diskPath, $filename);
    }

    /**
     * Admin: Backup semua foto dalam satu file ZIP.
     */
    public function backup()
    {
        $galleries = Gallery::all();

        if ($galleries->isEmpty()) {
            return back()->with('error', 'Tidak ada foto untuk di-backup.');
        }

        $zipFileName = 'galeri-sekolah-backup-' . date('Y-m-d_His') . '.zip';
        $zipPath = storage_path('app/' . $zipFileName);

        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return back()->with('error', 'Gagal membuat arsip ZIP.');
        }

        foreach ($galleries as $gallery) {
            $storagePath = $gallery->photo_path;

            if (str_starts_with($storagePath, 'public/')) {
                $filePath = storage_path('app/' . $storagePath);
            } else {
                $filePath = storage_path('app/public/' . $storagePath);
            }

            if (file_exists($filePath)) {
                $entryName = $gallery->category . '/' . basename($filePath);
                $zip->addFile($filePath, $entryName);
            }
        }

        $zip->close();

        return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
    }

    /**
     * Public: Tampilkan galeri foto ke publik.
     * Menggabungkan foto dari tabel galleries DAN foto dari tabel articles.
     */
    public function publicIndex()
    {
        // 1. Ambil foto dari tabel galleries
        $galleryPhotos = Gallery::orderBy('created_at', 'desc')->get()->map(function ($g) {
            return (object) [
                'title'      => $g->title,
                'category'   => $g->category,
                'photo_path' => $g->photo_path,
                'created_at' => $g->created_at,
                'source'     => 'gallery',
            ];
        });

        // 2. Ambil foto dari tabel articles (JSON array di kolom photo_path)
        $articlePhotos = collect();
        $articles = Article::whereNotNull('photo_path')->orderBy('created_at', 'desc')->get();

        foreach ($articles as $article) {
            $paths = json_decode($article->photo_path, true);
            if (!is_array($paths)) continue;

            foreach ($paths as $path) {
                $articlePhotos->push((object) [
                    'title'      => $article->title,
                    'category'   => 'Artikel',
                    'photo_path' => $path,
                    'created_at' => $article->created_at,
                    'source'     => 'article',
                ]);
            }
        }

        // 3. Gabungkan dan urutkan berdasarkan tanggal terbaru
        $allPhotos = $galleryPhotos->concat($articlePhotos)->sortByDesc('created_at')->values();

        // 4. Kumpulkan semua kategori unik
        $categories = $allPhotos->pluck('category')->unique()->values();

        return view('frontend.gallery.index', [
            'galleries'  => $allPhotos,
            'categories' => $categories,
        ]);
    }

    /**
     * Resource methods that are unused but required by Route::resource
     */
    public function create() { return redirect()->route('gallery.index'); }
    public function show(Gallery $gallery) { return redirect()->route('gallery.index'); }
    public function edit(Gallery $gallery) { return redirect()->route('gallery.index'); }
    public function update(Request $request, Gallery $gallery) { return redirect()->route('gallery.index'); }
}
