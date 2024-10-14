<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $ad = new Ad();
    
        $ad->title = $request->title;
        $ad->link = $request->link;
        $ad->description = $request->description;
    
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time().'.'.$image->extension();
            // Simpan foto ke dalam direktori storage
            $path = $image->storeAs('public/ads_photos', $imageName);
            // Simpan path foto ke dalam database tanpa awalan 'storage/'
            $ad->photo_path = 'public/ads_photos/' . $imageName;
        }
    
        $ad->save();
    
        return redirect()->route('ads.index')->with('success','Ad created successfully.');
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
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $ad->title = $request->title;
    $ad->link = $request->link;
    $ad->description = $request->description;

    if ($request->hasFile('photo')) {
        // Hapus foto lama jika ada
        if ($ad->photo_path) {
            Storage::delete($ad->photo_path);
        }

        $image = $request->file('photo');
        $imageName = time().'.'.$image->extension();
        $path = $image->storeAs('public/ads_photos', $imageName);
        $ad->photo_path = 'public/ads_photos/' . $imageName;
    }

    $ad->save();

    return redirect()->route('ads.index')->with('success','Ad updated successfully.');
}


    public function destroy(Ad $ad)
    {
        // Hapus foto terkait dari storage jika ada
        if ($ad->photo_path) {
            Storage::delete($ad->photo_path);
        }
    
        // Hapus data iklan dari database
        $ad->delete();
    
        return redirect()->route('ads.index')->with('success','Ad deleted successfully.');
    }
    
}
