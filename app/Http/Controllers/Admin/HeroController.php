<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hero;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function index()
    {
        $data = Hero::latest()->get();
        return view('admin.hero.index', compact('data'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('gambar')->store('hero', 'public');

        Hero::create([
            'gambar' => $path,
        ]);

        return redirect()->route('admin.hero.index')->with('success', 'Background berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $hero = Hero::findOrFail($id);
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request, $id)
    {
        $hero = Hero::findOrFail($id);

        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($hero->gambar);
            $path = $request->file('gambar')->store('hero', 'public');
            $hero->gambar = $path;
        }

        $hero->save();

        return redirect()->route('admin.hero.index')->with('success', 'Background berhasil diupdate.');
    }

    public function destroy($id)
    {
        $hero = Hero::findOrFail($id);
        Storage::disk('public')->delete($hero->gambar);
        $hero->delete();

        return redirect()->route('admin.hero.index')->with('success', 'Background dihapus.');
    }
}
