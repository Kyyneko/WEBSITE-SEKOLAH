<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    public function index()
    {
        $user = auth()->user();
    
        $articles = Article::when($user->role === 'admin', function ($query) {
            return $query->get();
        }, function ($query) use ($user) {
            return $query->where('author_id', $user->id)->get();
        });
    
        return view('backend.articleManage.index', compact('articles'));
    }
    
    // Create
    public function create()
    {
        return view('backend.articleManage.create');
    }

    // Validasi Dari Update
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:100000', // validasi untuk foto
        ]);
        // Mendapatkan ID pengguna yang saat ini login
        $author_id = Auth::id();
        // Inisialisasi array untuk menyimpan URL foto
        $photoUrls = [];
        // Memproses foto yang diunggah
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                // Menyimpan foto ke dalam direktori penyimpanan
                $path = $photo->store('public/article_photos');
                // Simpan foto ke dalam storage
                $photoUrls[] = $path; // Dapatkan URL foto
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
        ]);

        return redirect()->route('articles.index')
            ->with('success', 'Article created successfully.');
    }

    

    // Edit
    public function edit(Article $article)
    {
        return view('backend.articleManage.edit', compact('article'));
    }

    // Validasi Edit
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'new_photo.*' => 'image|mimes:jpeg,png,jpg,gif|max:100000', // validasi untuk foto baru
        ]);
    
        // Perbarui judul dan deskripsi artikel
        $article->title = $request->title;
        $article->description = $request->description;
    
        // Menghapus foto-foto yang dipilih untuk dihapus
        if ($request->has('delete_photos')) {
            $deletePhotos = $request->delete_photos;
            $currentPhotos = json_decode($article->photo_path, true);
            foreach ($deletePhotos as $deletePhoto) {
                if (($key = array_search($deletePhoto, $currentPhotos)) !== false) {
                    // Hapus foto dari penyimpanan
                    Storage::delete($deletePhoto);
                    // Hapus foto dari array foto_path pada model
                    unset($currentPhotos[$key]);
                }
            }
            $article->photo_path = json_encode(array_values($currentPhotos));
        }
    
        // Mengunggah foto-foto baru yang dipilih
        if ($request->hasFile('new_photo')) {
            foreach ($request->file('new_photo') as $newPhoto) {
                // Menyimpan foto ke dalam direktori penyimpanan
                $path = $newPhoto->store('public/article_photos');
                // Menambahkan path foto baru ke array foto_path pada model
                $currentPhotos[] = $path;
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
