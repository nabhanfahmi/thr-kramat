@extends('admin.layout.admin')

@section('content')
<h1>Detail Pemesanan #{{ $pemesanans->id }}</h1>

<table class="table">
    <tr><th>User</th><td>{{ $pemesanans->user->name ?? '-' }}</td></tr>
    <tr><th>No. HP</th><td>{{ $pemesanans->user->no_hp ?? '-' }}</td></tr>
    <tr><th>Tiket</th><td>{{ $pemesanans->tiket->nama_tiket ?? '-' }}</td></tr>
    <tr><th>Jumlah</th><td>{{ $pemesanans->jumlah_tiket }}</td></tr>
    <tr><th>Total Harga</th><td>Rp {{ number_format($pemesanans->total_harga, 0, ',', '.') }}</td></tr>
    <tr><th>Status</th><td>{{ ucfirst($pemesanans->status) }}</td></tr>
    <tr><th>Tanggal Pemesanan</th><td>{{ $pemesanans->created_at->format('d-m-Y H:i') }}</td></tr>
</table>

<h3>Status Pemesanan</h3>

@if($pemesanans->status == 'menunggu')
    <div class="alert alert-warning">Menunggu pembayaran dari user.</div>
@elseif($pemesanans->status == 'dibayar')
    <form action="{{ route('admin.pemesanan.updateStatusSelesai', $pemesanans->id) }}" method="POST">
        @csrf
         @method('PATCH')
        <input type="hidden" name="status" value="selesai">
        <button class="btn btn-success mt-2" type="submit"
            onclick="return confirm('Yakin ingin menyelesaikan pemesanan ini?')">
            Konfirmasi Selesai
        </button>
    </form>
@elseif($pemesanans->status == 'selesai')
    <div class="alert alert-success">Pemesanan telah selesai.</div>
@elseif($pemesanans->status == 'tiket terpakai')
    <div class="alert bg-dark text-white">Tiket telah terpakai.</div>
@elseif($pemesanans ->status == 'batal')
    <div class="alert alert-danger">Pemesanan dibatalkan.</div>
@endif

<a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Pemesanan</a>
@endsection
