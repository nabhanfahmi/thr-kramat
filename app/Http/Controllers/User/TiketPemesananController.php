<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tiket;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Snap;
use Midtrans\Config;

class TiketPemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // AUTO UPDATE STATUS
        foreach ($pemesanans as $item) {

            if (
                $item->status == 'dibayar' &&
                $item->updated_at->diffInSeconds(now()) >= 30
            ) {

                $item->status = 'selesai';

                // Generate QR jika belum ada
                if (empty($item->kode_qr)) {
                    $item->kode_qr = Str::uuid()->toString();
                }

                $item->save();
            }
        }

        // Refresh data setelah update
        $pemesanans = Pemesanan::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.pemesanan.index', compact('pemesanans'));
    }

    public function create($id)
    {
        $tiket = Tiket::findOrFail($id);

        return view('user.pemesanan.create', compact('tiket'));
    }

    public function store(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('user.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'jumlah_tiket' => 'required|integer|min:1',
            'tanggal_kunjungan' => 'required|date|after_or_equal:today',
        ]);

        $tiket = Tiket::findOrFail($id);

        $pemesanans = Pemesanan::create([
            'user_id' => auth()->id(),
            'nama' => Auth::user()->name,
            'email' => Auth::user()->email,
            'no_hp' => Auth::user()->no_hp,
            'tiket_id' => $tiket->id,
            'jumlah_tiket' => $request->jumlah_tiket,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'total_harga' => $tiket->harga * $request->jumlah_tiket,
            'status' => 'menunggu',

            // IMPORTANT: ini yang dipakai callback Midtrans
            'kode_transaksi' => 'THR-' . strtoupper(Str::random(10)),
        ]);

        return redirect()->route('user.pemesanan.bayar', $pemesanans->id);
    }

    public function bayar($id)
    {
        $pemesanans = Pemesanan::with('tiket')
            ->findOrFail($id);

        // Cegah akses user lain
        if ($pemesanans->user_id !== auth()->id()) {
            abort(403);
        }

        // Kalau sudah dibayar
        if ($pemesanans->status == 'dibayar' ||
            $pemesanans->status == 'selesai') {

            return redirect()
                ->route('user.pemesanan.index')
                ->with('success', 'Pembayaran sudah selesai.');
        }

        if ($pemesanans->total_harga <= 0) {

            return redirect()
                ->route('user.pemesanan.index')
                ->with('error', 'Total harga tidak valid.');
        }

        Config::$serverKey =
            config('services.midtrans.serverKey');

        Config::$isProduction =
            config('services.midtrans.isProduction', false);

        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Gunakan token lama jika ada
        if ($pemesanans->snap_token) {

            $snapToken = $pemesanans->snap_token;

        } else {

            $params = [
                'transaction_details' => [
                    'order_id' => $pemesanans->kode_transaksi,
                    'gross_amount' => (int) $pemesanans->total_harga,
                ],

                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
            ];

            try {

                $snapToken = Snap::getSnapToken($params);

                $pemesanans->snap_token = $snapToken;
                $pemesanans->save();

            } catch (\Exception $e) {

                return redirect()
                    ->route('user.pemesanan.index')
                    ->with('error', $e->getMessage());
            }
        }

        return view('user.pemesanan.bayar', compact(
            'pemesanans',
            'snapToken'
        ));
    }

    public function download($id)
    {
        $pemesanans = Pemesanan::findOrFail($id);

        if ($pemesanans->user_id !== auth()->id()) {
            abort(403, 'Tidak diizinkan');
        }

        $filePath = storage_path(
            'app/public/tiket/' . $pemesanans->kode_qr . '.pdf'
        );

        if (!file_exists($filePath)) {
            abort(404, 'Tiket tidak ditemukan');
        }

        return response()->download($filePath);
    }
}