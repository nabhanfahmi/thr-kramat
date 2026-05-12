<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pemesanan Tiket</title>
</head>
<body>
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ public_path('logo.png') }}" height="60">
        <h2>Laporan Pemesanan Tiket</h2>
    </div>

    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
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
            @foreach ($data as $pemesanans)
                <tr>
                    <td>{{ $pemesanans->id }}</td>
                    <td>{{ $pemesanans->user->name ?? '-' }}</td>
                    <td>{{ $pemesanans->tiket->nama_tiket ?? '-' }}</td>
                    <td>{{ $pemesanans->jumlah_tiket }}</td>
                    <td>{{ number_format($pemesanans->tiket->harga ?? 0, 0, ',', '.') }}</td>
                    <td>{{ number_format($pemesanans->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $pemesanans->status }}</td>
                    <td>{{ $pemesanans->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"><strong>Total Pengunjung</strong></td>
                <td><strong>{{ $totalPengunjung }}</strong></td>
                <td><strong>Grand Total</strong></td>
                <td><strong>{{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
