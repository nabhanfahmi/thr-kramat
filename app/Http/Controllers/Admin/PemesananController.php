<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Exports\PemesananExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        // Base query with relations
        $baseQuery = Pemesanan::with(['user', 'tiket']);

        // Filters (status, tanggal single)
        if ($request->filled('status')) {
            $baseQuery->where('status', $request->status);
        }
        if ($request->filled('tanggal')) {
            $baseQuery->whereDate('created_at', $request->tanggal);
        }

        // totalPengunjung dari clone query (tanpa pagination)
        $totalPengunjung = (clone $baseQuery)->sum('jumlah_tiket');

        // Pagination (clone agar tidak mempengaruhi sum)
        $pemesanans = (clone $baseQuery)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Kirim pemesanans (utama) + alias data (kompatibilitas) + totalPengunjung
        return view('admin.pemesanan.index', [
            'pemesanans' => $pemesanans,
            'data' => $pemesanans, // alias agar view lama yg pakai $data tetap aman
            'totalPengunjung' => $totalPengunjung,
        ]);
    }

    public function show($id)
    {
        $pemesanans = Pemesanan::findOrFail($id);
        return view('admin.pemesanan.show', compact('pemesanans'));
    }


    /**
     * Export tunggal (pdf atau excel) menggunakan query yang sama
     * akses via route admin.pemesanan.export
     */
    public function export(Request $request)
    {
        $query = Pemesanan::with(['user', 'tiket']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('tanggal')) {
            $jenis = $request->input('jenis', 'harian');
            $tanggal = $request->input('tanggal');

            if ($jenis === 'harian' && $tanggal) {
                $query->whereDate('created_at', $tanggal);
            } elseif ($jenis === 'bulanan' && $tanggal) {
                $month = date('m', strtotime($tanggal));
                $year = date('Y', strtotime($tanggal));
                $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
            } elseif ($jenis === 'tahunan' && $tanggal) {
                $year = date('Y', strtotime($tanggal));
                $query->whereYear('created_at', $year);
            }
        } else {
            $jenis = $request->input('jenis', 'harian');
        }

        $pemesanans = $query->orderBy('created_at', 'desc')->get();
        $totalPengunjung = $pemesanans->sum('jumlah_tiket');

        // 🔹 Cek jika data kosong, batalkan export
        if ($pemesanans->isEmpty()) {
            return redirect()
                ->back()
                ->with('error', 'Tidak ada data pemesanan yang sesuai dengan tanggal yang dipilih.');
        }

        $format = $request->input('format', 'pdf');

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('admin.pemesanan.export_pdf', [
                'pemesanans' => $pemesanans,
                'data' => $pemesanans,
                'totalPengunjung' => $totalPengunjung,
                'jenis' => $jenis,
            ])->setPaper('a4', 'landscape');

            return $pdf->download('laporan_pemesanan_' . now()->format('Ymd_His') . '.pdf');
        }

        if ($format === 'excel') {
            return Excel::download(
                new PemesananExport($pemesanans, $totalPengunjung, $jenis),
                'laporan_pemesanan_' . now()->format('Ymd_His') . '.xlsx'
            );
        }

        return redirect()->back()->with('error', 'Format export tidak didukung.');
    }

    public function updateStatusSelesai($id)
{
    $pemesanans = Pemesanan::findOrFail($id);

    // Ubah status ke selesai
    $pemesanans->status = 'selesai';

    // Generate kode unik jika belum ada
    if (empty($pemesanans->kode_qr)) {
        $pemesanans->kode_qr = Str::uuid()->toString();
    }

    $pemesanans->save();

    // Generate QR code (untuk ditampilkan di view)
    $kodeQR = url('/petugas/pemesanan/' . $pemesanans->kode_qr);
    $qrCodeImage = QrCode::size(200)->generate($kodeQR);

    return view('admin.pemesanan.show', compact('pemesanans', 'qrCodeImage'))
        ->with('success', 'Status pemesanan berhasil diubah menjadi selesai dan QR code dibuat.');
}

}


