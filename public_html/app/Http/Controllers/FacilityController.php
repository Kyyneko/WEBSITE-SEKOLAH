<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::orderBy('id', 'desc')->get();
        return view('backend.facilityManage.index', compact('facilities'));
    }

    public function create()
    {
        return view('backend.facilityManage.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,webp,heic,heif|max:10240',
            'features' => 'nullable|string',
        ]);

        // Process features comma-separated string to array
        $featuresArray = [];
        if ($request->features) {
            $featuresArray = array_filter(array_map('trim', explode(',', $request->features)));
        }

        $data = [
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'features' => $featuresArray,
        ];

        if ($request->hasFile('photo')) {
            try {
                $path = ImageOptimizer::compressAndStore($request->file('photo'), 'facilities');
                $data['photo_path'] = $path;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => $e->getMessage()])->withInput();
            }
        }

        Facility::create($data);

        return redirect()->route('facilities.index')->with('success', 'Fasilitas berhasil ditambahkan');
    }

    public function edit(Facility $facility)
    {
        return view('backend.facilityManage.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,webp,heic,heif|max:10240',
            'features' => 'nullable|string',
        ]);

        // Process features comma-separated string to array
        $featuresArray = [];
        if ($request->features) {
            $featuresArray = array_filter(array_map('trim', explode(',', $request->features)));
        }

        $data = [
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'features' => $featuresArray,
        ];

        if ($request->hasFile('photo')) {
            if ($facility->photo_path) {
                Storage::delete($facility->photo_path);
            }
            try {
                $path = ImageOptimizer::compressAndStore($request->file('photo'), 'facilities');
                $data['photo_path'] = $path;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => $e->getMessage()])->withInput();
            }
        }

        $facility->update($data);

        return redirect()->route('facilities.index')->with('success', 'Fasilitas berhasil diperbarui');
    }

    public function destroy(Facility $facility)
    {
        if ($facility->photo_path) {
            Storage::delete($facility->photo_path);
        }
        $facility->delete();

        return redirect()->route('facilities.index')->with('success', 'Fasilitas berhasil dihapus');
    }
}
