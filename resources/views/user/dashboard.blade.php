@extends('user.layout.user')

<style>
    .dashboard-container {
        background: #ffffff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        width: 100%;
        max-width: 900px;
    }

    h2, h4 {
        color: #6f42c1;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .table th, .table td {
        padding: 14px 12px;
        text-align: center;
        border: 1px solid #dee2e6;
    }

    .badge {
        font-size: 0.85rem;
        padding: 6px 12px;
        border-radius: 10px;
    }

    @media (max-width: 768px) {
        .table thead {
            display: none;
        }

        .table, .table tbody, .table tr, .table td {
            display: block;
            width: 100%;
        }

        .table tr {
            margin-bottom: 15px;
            border-bottom: 2px solid #eee;
        }

        .table td {
            text-align: left;
            padding-left: 50%;
            position: relative;
        }

        .table td::before {
            content: attr(data-label);
            position: absolute;
            left: 12px;
            width: 45%;
            padding-right: 10px;
            font-weight: bold;
            color: #6f42c1;
        }
    }
</style>

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light px-2">
    <div class="dashboard-container">
        <h2>Dashboard Pengguna</h2>
        <p>Selamat datang, {{ Auth::user()->name }}</p>

        <hr>

        <h4>Riwayat Pemesanan Tiket</h4>
        @if ($pemesanans->isEmpty())
            <p>Kamu belum pernah memesan tiket.</p>
        @else
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Nama Tiket</th>
                        <th>Jumlah</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemesanans as $p)
                        <tr>
                            <td data-label="Nama Tiket">{{ $p->tiket->nama_tiket }}</td>
                            <td data-label="Jumlah">{{ $p->jumlah_tiket }}</td>
                            <td data-label="Tanggal Kunjungan">{{ \Carbon\Carbon::parse($p->tanggal_kunjungan)->translatedFormat('d M Y') }}</td>
                            <td data-label="Status">
                                @switch($p->status)
                                    @case('dibayar')
                                        <span class="badge bg-success">Dibayar</span>
                                        @break
                                    @case('selesai')
                                        <span class="badge bg-primary text-white">Selesai</span>
                                        @break
                                    @case('menunggu')
                                        <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                                        @break
                                    @case('gagal')
                                    @case('batal')
                                        <span class="badge bg-danger">Gagal</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ ucfirst($p->status) }}</span>
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
