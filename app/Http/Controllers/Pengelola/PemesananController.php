<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Exports\PemesananExport;

class PemesananController extends Controller
{
    public function index(Request $request)
{
    // Query dasar dengan relasi
    $query = Pemesanan::with(['user', 'tiket'])->orderBy('created_at', 'desc');

    // Filter berdasarkan status (jika dipilih)
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Pagination untuk web
    $pemesanans = $query->paginate(10)->withQueryString();

    // Hitung total pengunjung sesuai filter
    $totalPengunjung = $query->sum('jumlah_tiket');

    return view('pengelola.pemesanan.index', compact('pemesanans', 'totalPengunjung'));
}


    public function exportExcel(Request $request)
{
    // Query dasar
    $query = Pemesanan::with(['user', 'tiket'])->orderBy('created_at', 'desc');

    // Filter status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter jenis tiket
    if ($request->filled('jenis')) {
        $query->whereHas('tiket', function ($q) use ($request) {
            $q->where('jenis', $request->jenis);
        });
    }

    // Ambil data
    $pemesanans = $query->get();
    $totalPengunjung = $pemesanans->sum('jumlah_tiket');

    // Ambil jenis dari filter (atau default)
    $jenis = $request->jenis ?? 'Semua Jenis';

    // Download Excel
    return Excel::download(
        new PemesananExport($pemesanans, $totalPengunjung, $jenis),
        'laporan_pemesanan.xlsx'
    );
}


    public function exportPdf()
    {
        $pemesanans = Pemesanan::orderBy('created_at', 'desc')->get();
        $totalPengunjung = $pemesanans->sum('jumlah_tiket');

        $pdf = PDF::loadView('pengelola.pemesanan.export_pdf', compact('pemesanans', 'totalPengunjung'));
        return $pdf->download('laporan_pemesanan.pdf');
    }
}
