<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Tiket;
use Illuminate\Http\Request;
use App\Models\TiketPemesanan;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Response;

class UserTiketController extends Controller
{
    public function index()
    {
        $tikets = Tiket::all(); // Ambil semua data tiket dari DB
        return view('user.tiket.index', compact('tikets'));
    }
    // Tampilkan form pemesanan tiket
    public function create()
    {
        return view('user.tiket.form'); // pastikan file view-nya ada
    }

    // Proses simpan tiket
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
            'tanggal_kunjungan' => 'required|date|after_or_equal:today',
            'jumlah_tiket' => 'required|integer|min:1',
        ]);

        $harga_per_tiket = 25000; // harga bisa disesuaikan
        $total = $harga_per_tiket * $request->jumlah_tiket;

       

        Pemesanan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'jumlah_tiket' => $request->jumlah_tiket,
            'total_harga' => $total,
        ]);
        return redirect()->back()->with('success', 'Pemesanan berhasil! Silakan cek email Anda.');
    }

    // (opsional) Riwayat tiket user
    public function riwayat()
    {
        $tiket = Pemesanan::latest()->get(); // bisa filter berdasarkan user
        return view('user.tiket.index', compact('tiket'));
    }

    public function showQr($id)
    {
        $pemesanan = Pemesanan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($pemesanan->status !== 'selesai') {
            abort(403, 'QR Code hanya tersedia jika status tiket selesai.');
        }

        $qr = QrCode::size(250)->generate($pemesanan->kode_qr);

        return view('user.tiket.qr', compact('pemesanan', 'qr'));
    }
}
