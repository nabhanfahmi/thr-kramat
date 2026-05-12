<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    // Tampilkan semua data galeri (admin)
    public function index()
    {
        $galeris = Galeri::latest()->get(); // atau ->orderBy('created_at', 'desc')->get();
        return view('admin.galeri.index', compact('galeris'));
    }


    // Form tambah
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Simpan galeri baru
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'keterangan' => 'required|string', // bisa panjang karena pakai TEXT
    ]);

    $path = $request->file('gambar')->store('galeri', 'public');

    Galeri::create([
        'judul' => $request->input('judul'),
        'gambar' => $path,
        'keterangan' => $request->input('keterangan'), // hasil HTML CKEditor
        'admin_id' => auth()->guard('admin')->id(),
    ]);

    return redirect()->route('admin.galeri.index')->with('success', 'Berita berhasil ditambahkan.');
}

    // Form edit galeri
    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * Update galeri
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
{
    $galeri = Galeri::findOrFail($id);

    $request->validate([
        'judul' => 'required|string|max:255',
        'keterangan' => 'required|string', // isi berita
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = [
        'judul' => $request->input('judul'),
        'keterangan' => $request->input('keterangan'),
    ];

    if ($request->hasFile('gambar')) {
        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }
        $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
    }

    $galeri->update($data);

    return redirect()->route('admin.galeri.index')->with('success', 'Berita berhasil diperbarui.');
}

    /**
     * Hapus galeri
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
