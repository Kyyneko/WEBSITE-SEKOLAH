<?php

namespace App\Http\Controllers;

use App\Models\FormerPrincipal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;

class FormerPrincipalController extends Controller
{
    public function index()
    {
        $principals = FormerPrincipal::orderBy('id', 'asc')->get();
        return view('backend.formerPrincipal.index', compact('principals'));
    }

    public function create()
    {
        return view('backend.formerPrincipal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'period' => 'nullable|string|max:255',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,webp,heic,heif|max:10240',
        ]);

        $data = [
            'name' => $request->name,
            'period' => $request->period,
        ];

        if ($request->hasFile('photo')) {
            try {
                $path = ImageOptimizer::compressAndStore($request->file('photo'), 'former_principals');
                $data['photo_path'] = $path;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => $e->getMessage()])->withInput();
            }
        }

        FormerPrincipal::create($data);

        return redirect()->route('former-principals.index')->with('success', 'Mantan Kepala Sekolah berhasil ditambahkan');
    }

    public function edit(FormerPrincipal $formerPrincipal)
    {
        return view('backend.formerPrincipal.edit', compact('formerPrincipal'));
    }

    public function update(Request $request, FormerPrincipal $formerPrincipal)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'period' => 'nullable|string|max:255',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,webp,heic,heif|max:10240',
        ]);

        $data = [
            'name' => $request->name,
            'period' => $request->period,
        ];

        if ($request->hasFile('photo')) {
            if ($formerPrincipal->photo_path) {
                Storage::delete($formerPrincipal->photo_path);
            }
            try {
                $path = ImageOptimizer::compressAndStore($request->file('photo'), 'former_principals');
                $data['photo_path'] = $path;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => $e->getMessage()])->withInput();
            }
        }

        $formerPrincipal->update($data);

        return redirect()->route('former-principals.index')->with('success', 'Mantan Kepala Sekolah berhasil diperbarui');
    }

    public function destroy(FormerPrincipal $formerPrincipal)
    {
        if ($formerPrincipal->photo_path) {
            Storage::delete($formerPrincipal->photo_path);
        }
        $formerPrincipal->delete();

        return redirect()->route('former-principals.index')->with('success', 'Mantan Kepala Sekolah berhasil dihapus');
    }
}
