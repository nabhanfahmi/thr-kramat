<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;

class PemesananExport implements FromCollection, WithHeadings, WithStyles, WithDrawings
{
    protected $grandTotal;
    protected $totalPengunjung;
    protected $pemesanans;
    protected $jenis;

    public function __construct($pemesanans, $totalPengunjung, $jenis)
    {
        $this->pemesanans = $pemesanans;
        $this->totalPengunjung = $totalPengunjung;
        $this->jenis = $jenis;

        // Hitung grand total langsung di constructor supaya konsisten
        $this->grandTotal = $pemesanans->sum(function ($p) {
            return ($p->tiket->harga ?? 0) * $p->jumlah_tiket;
        });
    }

    public function collection()
    {
        $data = collect([]);
        $no = 1;

        foreach ($this->pemesanans as $p) {
            $totalHarga = ($p->tiket->harga ?? 0) * $p->jumlah_tiket;

            $data->push([
                'No' => $no++,
                'Nama Pemesan' => $p->user->name ?? '-',
                'Tiket' => $p->tiket->nama_tiket ?? '-', // pakai nama_tiket
                'Jumlah' => $p->jumlah_tiket,
                'Total Harga' => $totalHarga,
                'Status' => $p->status ?? '-',
                'Tanggal Pemesanan' => $p->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            ['Laporan Pemesanan Tiket'],
            ['Total Pengunjung: ' . $this->totalPengunjung],
            ['Total Harga Keseluruhan: Rp ' . number_format($this->grandTotal, 0, ',', '.')], // langsung pakai nilai dari constructor
            ["Jenis Laporan: " . ucfirst($this->jenis)],
            [],
            ['No', 'Nama Pemesan', 'Tiket', 'Jumlah', 'Total Harga', 'Status', 'Tanggal Pemesanan']
        ];
    }
    

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:G1');
        $sheet->mergeCells('A2:G2');
        $sheet->mergeCells('A3:G3');

        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(12);

        $sheet->getStyle('A5:G5')->getFont()->setBold(true);

        return [];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo Perusahaan');
        $drawing->setPath(public_path('img/logo/logothr.png'));
        $drawing->setHeight(60);
        $drawing->setCoordinates('G1'); 

        return $drawing;
    }
}
