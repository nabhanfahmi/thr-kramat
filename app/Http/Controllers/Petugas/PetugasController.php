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

        // Tiket tidak ditemukan
        if (!$tiket) {

            return response()->json([
                'success' => false,
                'message' => '❌ Tiket tidak ditemukan'
            ]);
        }

        // Tiket valid
        if ($tiket->status === 'selesai') {

            $tiket->status = 'tiket terpakai';
            $tiket->save();

            return response()->json([
                'success' => true,
                'message' => '✅ Tiket valid. Silakan masuk!',
                'redirect' => route('petugas.konfirmasi', $tiket->kode_qr)
            ]);
        }

        // Tiket sudah dipakai
        if ($tiket->status === 'tiket terpakai') {

            return response()->json([
                'success' => false,
                'message' => '⚠️ Tiket sudah digunakan!'
            ]);
        }

        // Tiket belum aktif
        return response()->json([
            'success' => false,
            'message' => '⚠️ Tiket belum valid'
        ]);
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
