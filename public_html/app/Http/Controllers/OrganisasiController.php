<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:100000', // validasi untuk foto
        ]);

        $photoUrls = [];

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('public/organisasi_photos');
                $photoUrls[] = $path;
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
        'new_photo.*' => 'image|mimes:jpeg,png,jpg,gif|max:100000', // validasi untuk foto baru
    ]);

    // Perbarui nama dan deskripsi organisasi
    $organisasi->nama = $request->name;
    $organisasi->description = $request->description;

        // Menghapus foto-foto yang dipilih untuk dihapus
    if ($request->has('delete_photos')) {
        $deletePhotos = $request->delete_photos;
        $currentPhotos = json_decode($organisasi->photo_path, true);
        foreach ($deletePhotos as $deletePhoto) {
            if (($key = array_search($deletePhoto, $currentPhotos)) !== false) {
                // Hapus foto dari penyimpanan
                Storage::delete($deletePhoto);
                // Hapus foto dari array photo_path pada model
                unset($currentPhotos[$key]);
            }
        }
        $organisasi->photo_path = json_encode(array_values($currentPhotos)); // Menggunakan array numerik
    }


    // Mengunggah foto-foto baru yang dipilih
    if ($request->hasFile('new_photo')) {
        foreach ($request->file('new_photo') as $newPhoto) {
            // Menyimpan foto ke dalam direktori penyimpanan
            $path = $newPhoto->store('public/organisasi_photos');
            // Menambahkan path foto baru ke array photo_path pada model
            $currentPhotos[] = $path;
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
