<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Organisasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;

class ArticleController extends Controller
{

    public function index()
    {
        $user = auth()->user();
    
        $articles = Article::with(['organisasi', 'user'])->when($user->role === 'admin', function ($query) {
            return $query->get();
        }, function ($query) use ($user) {
            return $query->where('author_id', $user->id)->get();
        });
    
        return view('backend.articleManage.index', compact('articles'));
    }
    
    // Create
    public function create()
    {
        $organisasis = Organisasi::all();
        return view('backend.articleManage.create', compact('organisasis'));
    }

    // Validasi Dari Update
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photos.*' => 'file|mimes:jpeg,png,jpg,gif,webp,heic,heif|max:100000', // validasi untuk foto
        ]);

        $user = Auth::user();
        if ($user->role === 'teacher') {
            $organisasi_id = $user->organisasi_id;
        } else {
            $request->validate([
                'organisasi_id' => 'nullable|exists:organisasis,id',
            ]);
            $organisasi_id = $request->organisasi_id;
        }

        // Mendapatkan ID pengguna yang saat ini login
        $author_id = Auth::id();
        // Inisialisasi array untuk menyimpan URL foto
        $photoUrls = [];
        // Memproses foto yang diunggah
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                try {
                    // Menyimpan foto ke dalam direktori penyimpanan
                    $path = ImageOptimizer::compressAndStore($photo, 'article_photos');
                    // Simpan foto ke dalam storage
                    $photoUrls[] = $path; // Dapatkan URL foto
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['photos' => $e->getMessage()])->withInput();
                }
            }
        }
        // Mengonversi array URL foto ke dalam format JSON
        $photoUrlsJson = json_encode($photoUrls);

        // Membuat artikel dengan data yang diberikan serta author_id yang sesuai dan juga path foto
        Article::create([
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title),
            'description' => $request->description,
            'author_id' => $author_id,
            'photo_path' => $photoUrlsJson, // Menyimpan array URL foto ke dalam database dalam format JSON
            'organisasi_id' => $organisasi_id,
        ]);

        return redirect()->route('articles.index')
            ->with('success', 'Article created successfully.');
    }

    // Edit
    public function edit(Article $article)
    {
        $organisasis = Organisasi::all();
        return view('backend.articleManage.edit', compact('article', 'organisasis'));
    }

    // Validasi Edit
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'new_photo.*' => 'file|mimes:jpeg,png,jpg,gif,webp,heic,heif|max:100000', // validasi untuk foto baru
        ]);
    
        $user = Auth::user();
        if ($user->role === 'teacher') {
            $organisasi_id = $user->organisasi_id;
        } else {
            $request->validate([
                'organisasi_id' => 'nullable|exists:organisasis,id',
            ]);
            $organisasi_id = $request->organisasi_id;
        }

        // Perbarui judul dan deskripsi artikel
        $article->title = $request->title;
        $article->description = $request->description;
        $article->organisasi_id = $organisasi_id;
    
        // Menghapus foto-foto yang dipilih untuk dihapus
        $currentPhotos = json_decode($article->photo_path, true) ?? [];
        if ($request->has('delete_photos')) {
            $deletePhotos = $request->delete_photos;
            foreach ($deletePhotos as $deletePhoto) {
                if (($key = array_search($deletePhoto, $currentPhotos)) !== false) {
                    // Hapus foto dari penyimpanan
                    Storage::delete($deletePhoto);
                    // Hapus foto dari array foto_path pada model
                    unset($currentPhotos[$key]);
                }
            }
            $currentPhotos = array_values($currentPhotos);
            $article->photo_path = json_encode($currentPhotos);
        }
    
        // Mengunggah foto-foto baru yang dipilih
        if ($request->hasFile('new_photo')) {
            foreach ($request->file('new_photo') as $newPhoto) {
                try {
                    // Menyimpan foto ke dalam direktori penyimpanan
                    $path = ImageOptimizer::compressAndStore($newPhoto, 'article_photos');
                    // Menambahkan path foto baru ke array foto_path pada model
                    $currentPhotos[] = $path;
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['new_photo' => $e->getMessage()])->withInput();
                }
            }
            $article->photo_path = json_encode($currentPhotos);
        }
    
        // Perbarui slug berdasarkan judul yang baru
        $article->slug = $this->generateUniqueSlug($request->title, $article->id);
        // Simpan perubahan
        $article->save();
    
        return redirect()->route('articles.index')
            ->with('success', 'Article updated successfully');
    }

    public function destroy(Article $article)
    {
        // Hapus foto terkait jika ada
        if ($article->photo_path) {
            // Mengonversi string JSON ke dalam array
            $photoPaths = json_decode($article->photo_path);
            // Hapus setiap file foto dari direktori penyimpanan
            foreach ($photoPaths as $path) {
                Storage::delete($path);
            }
        }
        // Hapus artikel
        $article->delete();
        return redirect()->route('articles.index')
            ->with('success', 'Article deleted successfully');
    }

    // Fungsi untuk menghasilkan slug unik berdasarkan judul baru
    private function generateUniqueSlug($title, $id = 0)
    {
        // Ubah judul menjadi slug
        $slug = Str::slug($title);

        // Jika judul tidak berubah, kembalikan slug yang sama
        if (Article::where('slug', $slug)->where('id', '<>', $id)->exists()) {
            $slug = $slug . '-' . time(); // Tambahkan waktu UNIX sebagai bagian dari slug
        }

        return $slug;
    }
}

