@extends('user.layout.user')

@section('content')

<style>
    body {
        background-color: #f5f5fa;
    }

    .container {
        background: #ffffff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        max-width: 100%;
    }

    h2 {
        font-weight: bold;
        color: #6f42c1;
        text-align: center;
        margin-bottom: 30px;
    }

    .table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }

    .table thead {
        background-color: #6f42c1;
        color: #fff;
        text-align: center;
    }

    .table th,
    .table td {
        padding: 14px 12px;
        border: 1px solid #dee2e6;
        font-size: 0.95rem;
        vertical-align: middle;
        text-align: center;
    }

    .badge {
        font-size: 0.85rem;
        padding: 6px 12px;
        border-radius: 10px;
        font-weight: 500;
    }

    .btn-primary {
        background-color: #6f42c1;
        border: none;
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 0.85rem;
    }

    .btn-primary:hover {
        background-color: #5a339e;
    }

    .alert-info {
        background-color: #e9f2ff;
        color: #2c5282;
        padding: 15px;
        border-left: 5px solid #6f42c1;
        border-radius: 10px;
    }

    @media (max-width: 768px) {
        .table thead {
            display: none;
        }

        .table,
        .table tbody,
        .table tr,
        .table td {
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

<div class="container mt-5">
    <h2>Riwayat Pemesanan Tiket</h2>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($pemesanans->isEmpty())
        <div class="alert alert-info">
            Kamu belum pernah memesan tiket.
        </div>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Nama Tiket</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pemesanans as $item)
                    <tr>
                        <td data-label="Kode">
                            {{ $item->kode_transaksi }}
                        </td>

                        <td data-label="Nama Tiket">
                            {{ $item->tiket->nama_tiket ?? '-' }}
                        </td>

                        <td data-label="Jumlah">
                            {{ $item->jumlah_tiket }}
                        </td>

                        <td data-label="Total Harga">
                            Rp{{ number_format($item->total_harga, 0, ',', '.') }}
                        </td>

                        <td data-label="Tanggal">
                            {{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->translatedFormat('d M Y') }}
                        </td>

                        <td data-label="Status">
                            @if($item->status == 'menunggu')
                                <span class="badge bg-warning text-dark">
                                    Menunggu
                                </span>

                            @elseif($item->status == 'dibayar')
                                <span class="badge bg-success">
                                    Dibayar
                                </span>

                            @elseif($item->status == 'selesai')
                                <span class="badge bg-primary">
                                    Selesai
                                </span>

                            @elseif($item->status == 'batal')
                                <span class="badge bg-danger">
                                    Batal
                                </span>

                            @elseif($item->status == 'tiket terpakai')
                                <span class="badge bg-dark">
                                    Tiket Terpakai
                                </span>

                            @else
                                <span class="badge bg-secondary">
                                    {{ ucfirst($item->status) }}
                                </span>
                            @endif
                        </td>

                        <td data-label="Aksi">

                            {{-- STATUS MENUNGGU --}}
                            @if($item->status == 'menunggu')

                                @if($item->snap_token)

                                    <button 
                                        class="btn btn-sm btn-primary pay-button"
                                        data-token="{{ $item->snap_token }}">
                                        Bayar
                                    </button>

                                @else

                                    <a href="{{ route('user.pemesanan.bayar', $item->id) }}"
                                    class="btn btn-sm btn-warning">
                                        Buat Pembayaran
                                    </a>

                                @endif

                            {{-- STATUS DIBAYAR --}}
                            @elseif($item->status == 'dibayar')

                                <span class="text-success">
                                    Pembayaran berhasil
                                </span>

                            {{-- STATUS SELESAI --}}
                            @elseif($item->status == 'selesai')

                                <div>
                                    <span class="text-muted d-block mb-2">
                                        Tiket Siap Digunakan
                                    </span>

                                    @if($item->kode_qr)

                                        {!! QrCode::size(120)->generate(url('/petugas/pemesanan/' . $item->kode_qr)) !!}

                                        <br>

                                        <a href="{{ route('user.tiket.download', $item->id) }}"
                                           class="btn btn-sm btn-primary mt-2">
                                            Download QR
                                        </a>

                                        <a href="{{ route('user.tiket.qr', $item->id) }}"
                                           class="btn btn-sm btn-success mt-2">
                                            Lihat QR Code
                                        </a>

                                    @else

                                        <span class="text-danger">
                                            QR Code belum tersedia
                                        </span>

                                    @endif
                                </div>

                            {{-- STATUS TIKET TERPAKAI --}}
                            @elseif($item->status == 'tiket terpakai')

                                <span class="text-danger">
                                    Tiket Sudah Digunakan
                                </span>

                            @else

                                <span class="text-muted">-</span>

                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

{{-- MIDTRANS --}}
<script 
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.clientKey') }}">
</script>

<script>
    document.querySelectorAll('.pay-button').forEach(button => {

        button.addEventListener('click', function () {

            let snapToken = this.dataset.token;

            if (!snapToken) {
                alert('Snap token tidak ditemukan!');
                return;
            }

            snap.pay(snapToken, {

                onSuccess: function(result) {
                    alert("Pembayaran berhasil!");
                    console.log(result);

                    window.location.reload();
                },

                onPending: function(result) {
                    alert("Menunggu pembayaran...");
                    console.log(result);

                    window.location.reload();
                },

                onError: function(result) {
                    alert("Pembayaran gagal!");
                    console.log(result);
                },

                onClose: function() {
                    alert('Popup pembayaran ditutup.');
                }

            });

        });

    });
</script>

@endsection