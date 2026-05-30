<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;

class OrganisasiController extends Controller
{
    public function index()
    {
        $organisasis = Organisasi::all();
        return view('backend.organisasiManage.index', compact('organisasis'));
    }

    public function create()
    {
        return view('backend.organisasiManage.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'description' => 'required',
            'photos.*' => 'file|mimes:jpeg,png,jpg,gif,webp,heic,heif|max:100000', // validasi untuk foto
        ]);

        $photoUrls = [];

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                try {
                    $path = ImageOptimizer::compressAndStore($photo, 'organisasi_photos');
                    $photoUrls[] = $path;
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['photos' => $e->getMessage()])->withInput();
                }
            }
        }

        Organisasi::create([
            'nama' => $request->nama,
            'slug' => $this->generateUniqueSlug($request->nama),
            'description' => $request->description,
            'photo_path' => json_encode($photoUrls), // Menggunakan array numerik
        ]);


        return redirect()->route('organisasi.index')->with('success', 'Organisasi created successfully.');
    }

    public function edit(Organisasi $organisasi)
    {
        return view('backend.organisasiManage.edit', compact('organisasi'));
    }

    public function update(Request $request, Organisasi $organisasi)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'new_photo.*' => 'file|mimes:jpeg,png,jpg,gif,webp,heic,heif|max:100000', // validasi untuk foto baru
        ]);

        // Perbarui nama dan deskripsi organisasi
        $organisasi->nama = $request->name;
        $organisasi->description = $request->description;

        $currentPhotos = json_decode($organisasi->photo_path, true) ?? [];
        // Menghapus foto-foto yang dipilih untuk dihapus
        if ($request->has('delete_photos')) {
            $deletePhotos = $request->delete_photos;
            foreach ($deletePhotos as $deletePhoto) {
                if (($key = array_search($deletePhoto, $currentPhotos)) !== false) {
                    // Hapus foto dari penyimpanan
                    Storage::delete($deletePhoto);
                    // Hapus foto dari array photo_path pada model
                    unset($currentPhotos[$key]);
                }
            }
            $currentPhotos = array_values($currentPhotos);
            $organisasi->photo_path = json_encode($currentPhotos); // Menggunakan array numerik
        }


        // Mengunggah foto-foto baru yang dipilih
        if ($request->hasFile('new_photo')) {
            foreach ($request->file('new_photo') as $newPhoto) {
                try {
                    // Menyimpan foto ke dalam direktori penyimpanan
                    $path = ImageOptimizer::compressAndStore($newPhoto, 'organisasi_photos');
                    // Menambahkan path foto baru ke array photo_path pada model
                    $currentPhotos[] = $path;
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['new_photo' => $e->getMessage()])->withInput();
                }
            }
            $organisasi->photo_path = json_encode($currentPhotos);
        }

        // Simpan perubahan
        $organisasi->save();

        return redirect()->route('organisasi.index')
            ->with('success', 'Organisasi updated successfully');
    }


    public function destroy(Organisasi $organisasi)
    {
        if ($organisasi->photo_path) {
            $photoPaths = json_decode($organisasi->photo_path);
            foreach ($photoPaths as $path) {
                Storage::delete($path);
            }
        }
        $organisasi->delete();
        return redirect()->route('organisasi.index')->with('success', 'Organisasi deleted successfully');
    }

    private function generateUniqueSlug($title, $id = 0)
    {
        $slug = Str::slug($title);

        if (Organisasi::where('slug', $slug)->where('id', '<>', $id)->exists()) {
            $slug = $slug . '-' . time();
        }

        return $slug;
    }
}
