<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PetugasController extends Controller
{
    public function index()
    {
        return view('petugas.index');
    }

    public function scan(Request $request)
    {
        $kode = $request->kode_qr;
        $tiket = Pemesanan::where('kode_qr', $kode)->first();

        if (!$tiket) {
            return response()->json(['status' => 'error', 'message' => 'Tiket tidak ditemukan']);
        }

        if ($tiket->status === 'selesai') {
            $tiket->status = 'tiket terpakai';
            $tiket->save();
            return response()->json(['status' => 'success', 'message' => 'Tiket valid. Silakan masuk!']);
        }

        if ($tiket->status === 'tiket terpakai') {
            return response()->json(['status' => 'error', 'message' => 'Tiket sudah digunakan!']);
        }

        return response()->json(['status' => 'error', 'message' => 'Tiket belum valid']);
    }

    public function showTiket($kode_qr)
    {
        $tiket = Pemesanan::where('kode_qr', $kode_qr)->first();

        if (!$tiket) {
            return view('petugas.konfirmasi', [
                'tiket' => null,
                'message' => '❌ Tiket tidak ditemukan'
            ]);
        }

        return view('petugas.konfirmasi', [
            'tiket' => $tiket,
            'message' => null
        ]);
    }

    public function validasiTiket($kode_qr)
    {
        $tiket = Pemesanan::where('kode_qr', $kode_qr)->first();

        if (!$tiket) {
            return redirect()->back()->with('error', '❌ Tiket tidak ditemukan');
        }

        if ($tiket->status === 'selesai') {
            $tiket->status = 'tiket terpakai';
            $tiket->save();
            return redirect()->back()->with('success', '✅ Tiket berhasil divalidasi');
        }

        return redirect()->back()->with('error', '⚠️ Tiket sudah digunakan');
    }
}
