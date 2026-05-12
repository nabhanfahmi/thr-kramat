<!-- pengelola/pemesanan/export_excel.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pemesanan Tiket</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 10px;
        }
        .logo img {
            height: 60px;
        }
        h2, h4 {
            text-align: center;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th {
            background-color: #f2f2f2;
        }
        td, th {
            padding: 5px;
            text-align: center;
        }
        .summary {
            margin-top: 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <!-- Logo -->
    <div class="logo">
        <img src="{{ public_path('img/logo/logothr.png') }}" alt="Logo">
    </div>

    <!-- Judul -->
    <h2>Laporan Pemesanan Tiket</h2>
    <h4>Jenis Laporan: {{ ucfirst($jenis) }}</h4>
    <hr>

    <!-- pengelola/pemesanan/export_excel.blade.php -->
<table border="1" cellspacing="0" cellpadding="5">
    <thead>
    <tr>
        <td colspan="8" style="text-align:center; font-weight:bold; font-size:14px;">
            LAPORAN PEMESANAN TIKET
        </td>
    </tr>
    <tr>
        <td colspan="8" style="text-align:center; font-size:12px;">
            Jenis Laporan: {{ ucfirst($jenis) }}
        </td>
    </tr>
    <tr>
        <th>ID</th>
        <th>Nama User</th>
        <th>Nama Tiket</th>
        <th>Jumlah Tiket</th>
        <th>Harga Satuan</th>
        <th>Total Harga</th>
        <th>Status</th>
        <th>Tanggal Pesan</th>
    </tr>
</thead>

    <tbody>
        @php
            $totalPengunjung = 0;
            $totalHargaKeseluruhan = 0;
        @endphp
        @foreach ($data as $pemesanans)
            @php
                $totalHarga = ($pemesanans->tiket->harga ?? 0) * $pemesanans->jumlah_tiket;
                $totalPengunjung += $pemesanans->jumlah_tiket;
                $totalHargaKeseluruhan += $totalHarga;
            @endphp
            <tr>
                <td>{{ $pemesanans->id }}</td>
                <td>{{ $pemesanans->user->name ?? '-' }}</td>
                <td>{{ $pemesanans->tiket->nama_tiket ?? '-' }}</td>
                <td>{{ $pemesanans->jumlah_tiket }}</td>
                <td>{{ number_format($pemesanans->tiket->harga ?? 0, 0, ',', '.') }}</td>
                <td>{{ number_format($totalHarga, 0, ',', '.') }}</td>
                <td>{{ ucfirst($pemesanans->status) }}</td>
                <td>{{ $pemesanans->created_at->format('d-m-Y') }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3"><strong>Total Pengunjung</strong></td>
            <td><strong>{{ $totalPengunjung }}</strong></td>
            <td><strong>Total Harga Keseluruhan</strong></td>
            <td><strong>{{ number_format($totalHargaKeseluruhan, 0, ',', '.') }}</strong></td>
            <td colspan="2"></td>
        </tr>
    </tbody>
</table>


</body>
</html>
