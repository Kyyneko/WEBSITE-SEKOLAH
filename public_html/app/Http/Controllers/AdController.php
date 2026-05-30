<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;

class AdController extends Controller
{

    public function index()
    {
        $ads = Ad::all();
        return view('backend.adsManage.index', compact('ads'));
    }

    public function create()
    {
        return view('backend.adsManage.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:ads,title',
            'link' => 'required',
            'description' => 'required',
            'photo' => 'required|file|mimes:jpeg,png,jpg,gif,webp,heic,heif|max:100000',
        ]);
    
        $ad = new Ad();
    
        $ad->title = $request->title;
        $ad->link = $request->link;
        $ad->description = $request->description;
    
        if ($request->hasFile('photo')) {
            try {
                $image = $request->file('photo');
                $path = ImageOptimizer::compressAndStore($image, 'ads_photos');
                $ad->photo_path = $path;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => $e->getMessage()])->withInput();
            }
        }
    
        $ad->save();
    
        return redirect()->route('ads.index')->with('success','Pengumuman berhasil ditambahkan.');
    }
    

    


    public function edit(Ad $ad)
    {
        return view('backend.adsManage.edit', compact('ad'));
    }


    public function update(Request $request, Ad $ad)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'description' => 'required',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,heic,heif|max:100000',
        ]);

        $ad->title = $request->title;
        $ad->link = $request->link;
        $ad->description = $request->description;

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($ad->photo_path) {
                Storage::delete($ad->photo_path);
            }

            try {
                $image = $request->file('photo');
                $path = ImageOptimizer::compressAndStore($image, 'ads_photos');
                $ad->photo_path = $path;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => $e->getMessage()])->withInput();
            }
        }

        $ad->save();

        return redirect()->route('ads.index')->with('success','Pengumuman berhasil diperbarui.');
    }


    public function destroy(Ad $ad)
    {
        // Hapus foto terkait dari storage jika ada
        if ($ad->photo_path) {
            Storage::delete($ad->photo_path);
        }
    
        // Hapus data iklan dari database
        $ad->delete();
    
        return redirect()->route('ads.index')->with('success','Pengumuman berhasil dihapus.');
    }
    
}
