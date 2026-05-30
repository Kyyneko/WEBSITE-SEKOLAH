<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::orderBy('id', 'desc')->get();
        return view('backend.achievementManage.index', compact('achievements'));
    }

    public function create()
    {
        return view('backend.achievementManage.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:Akademik,Olahraga,Seni,Lainnya',
            'medal' => 'required|string|in:gold,silver,bronze',
            'student' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,webp,heic,heif|max:10240',
        ]);

        $data = [
            'title' => $request->title,
            'category' => $request->category,
            'medal' => $request->medal,
            'student' => $request->student,
            'date' => $request->date,
            'location' => $request->location,
            'description' => $request->description,
        ];

        if ($request->hasFile('photo')) {
            try {
                $path = ImageOptimizer::compressAndStore($request->file('photo'), 'achievements');
                $data['photo_path'] = $path;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => $e->getMessage()])->withInput();
            }
        }

        Achievement::create($data);

        return redirect()->route('achievements.index')->with('success', 'Prestasi berhasil ditambahkan');
    }

    public function edit(Achievement $achievement)
    {
        return view('backend.achievementManage.edit', compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:Akademik,Olahraga,Seni,Lainnya',
            'medal' => 'required|string|in:gold,silver,bronze',
            'student' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,webp,heic,heif|max:10240',
        ]);

        $data = [
            'title' => $request->title,
            'category' => $request->category,
            'medal' => $request->medal,
            'student' => $request->student,
            'date' => $request->date,
            'location' => $request->location,
            'description' => $request->description,
        ];

        if ($request->hasFile('photo')) {
            if ($achievement->photo_path) {
                Storage::delete($achievement->photo_path);
            }
            try {
                $path = ImageOptimizer::compressAndStore($request->file('photo'), 'achievements');
                $data['photo_path'] = $path;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => $e->getMessage()])->withInput();
            }
        }

        $achievement->update($data);

        return redirect()->route('achievements.index')->with('success', 'Prestasi berhasil diperbarui');
    }

    public function destroy(Achievement $achievement)
    {
        if ($achievement->photo_path) {
            Storage::delete($achievement->photo_path);
        }
        $achievement->delete();

        return redirect()->route('achievements.index')->with('success', 'Prestasi berhasil dihapus');
    }
}
