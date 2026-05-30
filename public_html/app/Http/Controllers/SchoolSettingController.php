<?php

namespace App\Http\Controllers;

use App\Models\SchoolSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolSettingController extends Controller
{
    /**
     * Show the form for editing the school settings.
     */
    public function edit()
    {
        $settings = SchoolSetting::first() ?? SchoolSetting::createDefault();
        return view('backend.settingsManage.edit', compact('settings'));
    }

    /**
     * Update the school settings in storage.
     */
    public function update(Request $request)
    {
        $settings = SchoolSetting::first();

        // If for some reason it doesn't exist, create default first
        if (!$settings) {
            $settings = SchoolSetting::createDefault();
        }

        $request->validate([
            'school_name' => 'required|string|max:255',
            'npsn' => 'required|string|max:50',
            'akreditasi' => 'required|string|max:50',
            'kurikulum' => 'required|string|max:100',
            'status_sekolah' => 'required|string|max:50',
            'bentuk_pendidikan' => 'required|string|max:50',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'dapodik_link' => 'required|url|max:255',
            'kepsek_name' => 'required|string|max:255',
            'kepsek_welcome_text' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'jumlah_siswa' => 'required|integer|min:0',
            'jumlah_staff' => 'required|integer|min:0',
            'kepsek_photo' => 'nullable|file|mimes:jpeg,png,jpg,webp,heic,heif|max:10240',
            'hero_subtitle' => 'required|string|max:255',
            'hero_description' => 'required|string',
            'about_title' => 'required|string|max:255',
            'about_description' => 'required|string',
            'history_title' => 'required|string|max:255',
            'history_description' => 'required|string',
            'hero_photo_1' => 'nullable|file|mimes:jpeg,png,jpg,webp,heic,heif|max:10240',
            'hero_photo_2' => 'nullable|file|mimes:jpeg,png,jpg,webp,heic,heif|max:10240',
            'hero_photo_3' => 'nullable|file|mimes:jpeg,png,jpg,webp,heic,heif|max:10240',
            'profile_banner_photo' => 'nullable|file|mimes:jpeg,png,jpg,webp,heic,heif|max:10240',
        ]);

        $data = $request->except(['_token', '_method', 'kepsek_photo', 'hero_photo_1', 'hero_photo_2', 'hero_photo_3', 'profile_banner_photo']);

        // Handle Kepsek Photo
        if ($request->hasFile('kepsek_photo')) {
            try {
                if ($settings->kepsek_photo_path) {
                    Storage::delete($settings->kepsek_photo_path);
                }
                $path = \App\Helpers\ImageOptimizer::compressAndStore($request->file('kepsek_photo'), 'sekolah');
                $data['kepsek_photo_path'] = $path;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['kepsek_photo' => $e->getMessage()])->withInput();
            }
        }

        // Handle Website Photos
        $photoFields = [
            'hero_photo_1' => 'hero_photo_1',
            'hero_photo_2' => 'hero_photo_2',
            'hero_photo_3' => 'hero_photo_3',
            'profile_banner_photo' => 'profile_banner_photo',
        ];

        foreach ($photoFields as $field => $dbField) {
            if ($request->hasFile($field)) {
                try {
                    if ($settings->$dbField) {
                        Storage::delete($settings->$dbField);
                    }
                    $path = \App\Helpers\ImageOptimizer::compressAndStore($request->file($field), 'sekolah');
                    $data[$dbField] = $path;
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors([$field => $e->getMessage()])->withInput();
                }
            }
        }

        $settings->update($data);

        return redirect()->route('settings.edit')->with('success', 'Pengaturan sekolah dan foto website berhasil diperbarui.');
    }
}
