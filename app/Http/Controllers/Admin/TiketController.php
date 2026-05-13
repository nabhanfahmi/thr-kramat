<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tiket;

class TiketController extends Controller
{
    public function index()
    {
        $tikets = Tiket::latest()->get();
        return view('admin.tiket.index', compact('tikets'));
    }

    public function create()
    {
        return view('admin.tiket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tiket' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar_tiket' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $gambarPath = null;

        if ($request->hasFile('gambar_tiket')) {
            $file = $request->file('gambar_tiket');
            $namaFile = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/tiket'), $namaFile);
            $gambarPath = 'uploads/tiket/' . $namaFile;
        }

        Tiket::create([
            'nama_tiket' => $request->nama_tiket,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'gambar_tiket' => $gambarPath,
        ]);

        return redirect()->route('admin.tiket.index')->with('success', 'Tiket berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tiket = Tiket::findOrFail($id);
        return view('admin.tiket.edit', compact('tiket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tiket' => 'required|string|max:255',
            'kategori' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'gambar_tiket' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $tiket = Tiket::findOrFail($id);

        // kalau ada gambar baru
        if ($request->hasFile('gambar_tiket')) {

            // hapus gambar lama (optional tapi disarankan)
            if ($tiket->gambar_tiket && file_exists(public_path($tiket->gambar_tiket))) {
                unlink(public_path($tiket->gambar_tiket));
            }

            $file = $request->file('gambar_tiket');
            $namaFile = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/tiket'), $namaFile);

            $tiket->gambar_tiket = 'uploads/tiket/' . $namaFile;
        }

        $tiket->nama_tiket = $request->nama_tiket;
        $tiket->kategori = $request->kategori;
        $tiket->harga = $request->harga;
        $tiket->stok = $request->stok;
        $tiket->deskripsi = $request->deskripsi;

        $tiket->save();

        return redirect()->route('admin.tiket.index')->with('success', 'Tiket berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tiket = Tiket::findOrFail($id);
        $tiket->delete();

        return redirect()->route('admin.tiket.index')->with('success', 'Tiket berhasil dihapus.');
    }
}
