@extends('user.layout.user')

@section('content')

<style>
    body {
        background: #f5f5fa;
    }

    .qr-container {
        max-width: 500px;
        margin: 50px auto;
        background: white;
        padding: 35px;
        border-radius: 20px;
        text-align: center;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    .qr-container h2 {
        color: #6f42c1;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .qr-container p {
        color: #666;
        margin-bottom: 25px;
    }

    .qr-box {
        background: #fafafa;
        padding: 20px;
        border-radius: 16px;
        display: inline-block;
    }

    .info {
        margin-top: 25px;
        text-align: left;
    }

    .info p {
        margin-bottom: 10px;
        color: #444;
    }

    .info strong {
        color: #6f42c1;
    }

    .btn-back {
        margin-top: 25px;
        background: #6f42c1;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-back:hover {
        background: #5a339e;
        color: white;
    }
</style>

<div class="container">

    <div class="qr-container">

        <h2>QR Code Tiket</h2>

        <p>
            Tunjukkan QR Code ini kepada petugas saat masuk wisata.
        </p>

        <div class="qr-box">

            {!! QrCode::size(250)->generate(url('/petugas/pemesanan/' . $pemesanan->kode_qr)) !!}

        </div>

        <div class="info">

            <p>
                <strong>Kode Transaksi:</strong>
                {{ $pemesanan->kode_transaksi }}
            </p>

            <p>
                <strong>Nama Tiket:</strong>
                {{ $pemesanan->tiket->nama_tiket ?? '-' }}
            </p>

            <p>
                <strong>Jumlah Tiket:</strong>
                {{ $pemesanan->jumlah_tiket }}
            </p>

            <p>
                <strong>Tanggal Kunjungan:</strong>
                {{ \Carbon\Carbon::parse($pemesanan->tanggal_kunjungan)->translatedFormat('d F Y') }}
            </p>

        </div>

        <a href="{{ url()->previous() }}" class="btn-back">
            Kembali
        </a>

    </div>

</div>

@endsection