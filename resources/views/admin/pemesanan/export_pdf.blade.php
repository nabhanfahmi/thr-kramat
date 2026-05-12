<!-- resources/views/admin/pemesanan/export_pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Riwayat Pemesanan Tiket THR Kramat Batang</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 70px;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            margin-top: 15px;
            font-weight: bold;
        }

        @media print {
            .footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                text-align: center;
                font-size: 10px;
                border-top: 1px solid #000;
                padding-top: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('img/logo/logothr.png') }}" alt="Logo THR">
        <h2>Riwayat Pemesanan Tiket THR Kramat Batang</h2>
        <small>(Jenis: {{ ucfirst($jenis) }})</small>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>Tiket</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Tanggal Pemesanan</th>
            </tr>
        </thead>
        <tbody>
            @php $totalHargaKeseluruhan = 0; @endphp
            @foreach ($pemesanans as $i => $p)
            @php
                $harga = $p->tiket->harga ?? 0;
                $total = $harga * $p->jumlah_tiket;
                $totalHargaKeseluruhan += $total;
            @endphp
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->tiket->nama_tiket ?? '-' }}</td>
                <td>{{ $p->jumlah_tiket }}</td>
                <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                <td>{{ ucfirst($p->status) }}</td>
                <td>{{ $p->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total Pengunjung: {{ $totalPengunjung }}</p>
    <p class="total">Total Harga Keseluruhan: Rp {{ number_format($totalHargaKeseluruhan, 0, ',', '.') }}</p>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}  
        | Sistem Pemesanan Tiket THR Kramat Batang
    </div>
</body>
</html>
