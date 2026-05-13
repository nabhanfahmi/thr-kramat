<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <title>E-Tiket Wisata</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Segoe UI',sans-serif;
    }

    body{

        background:
            linear-gradient(
                135deg,
                #f4f1ff,
                #ffffff
            );

        min-height:100vh;

        display:flex;

        justify-content:center;

        align-items:center;

        padding:6px;

        overflow-x:hidden;
    }

    /* =========================
       POPUP CARD
    ========================= */

    .ticket-popup{

        width:100%;

        max-width:540px;

        background:#fff;

        border-radius:18px;

        overflow:hidden;

        box-shadow:
            0 8px 24px rgba(0,0,0,.10);

        animation:fadeIn .25s ease;
    }

    @keyframes fadeIn{

        from{
            opacity:0;
            transform:translateY(8px);
        }

        to{
            opacity:1;
            transform:translateY(0);
        }
    }

    /* =========================
       HEADER
    ========================= */

    .ticket-header{

        background:
            linear-gradient(
                135deg,
                #6f42c1,
                #9b6dff
            );

        padding:14px 12px;

        text-align:center;

        color:#fff;
    }

    .ticket-header h1{

        font-size:17px;

        font-weight:800;

        margin-bottom:2px;
    }

    .ticket-header p{

        font-size:9px;

        opacity:.9;
    }

    .ticket-code{

        display:inline-block;

        margin-top:8px;

        background:rgba(255,255,255,.15);

        padding:5px 10px;

        border-radius:999px;

        font-size:9px;

        font-weight:700;
    }

    /* =========================
       BODY
    ========================= */

    .ticket-body{
        padding:14px;
    }

    /* =========================
       TOP SECTION
    ========================= */

    .top-section{

        display:flex;

        align-items:center;

        gap:14px;

        margin-bottom:14px;
    }

    /* =========================
       QR
    ========================= */

    .qr-area{
        text-align:center;
    }

    .qr-box{

        width:115px;
        height:115px;

        background:#fff;

        border-radius:14px;

        border:1px solid #ececec;

        display:flex;

        justify-content:center;

        align-items:center;

        box-shadow:
            0 4px 12px rgba(0,0,0,.04);
    }

    .qr-box svg{

        width:80px !important;
        height:80px !important;
    }

    .qr-text{

        margin-top:6px;

        font-size:8px;

        color:#777;

        line-height:1.4;
    }

    /* =========================
       INFO
    ========================= */

    .info-panel{
        flex:1;
    }

    .ticket-ready{

        font-size:15px;

        font-weight:800;

        color:#2d2d2d;

        margin-bottom:6px;
    }

    .ticket-desc{

        font-size:9px;

        color:#666;

        line-height:1.5;

        margin-bottom:10px;
    }

    .status{

        display:inline-flex;

        align-items:center;

        gap:6px;

        background:#eafaf0;

        color:#18a957;

        padding:5px 10px;

        border-radius:999px;

        font-size:8px;

        font-weight:700;
    }

    .status::before{

        content:"";

        width:6px;
        height:6px;

        border-radius:50%;

        background:#18a957;
    }

    /* =========================
       GRID
    ========================= */

    .ticket-grid{

        display:grid;

        grid-template-columns:repeat(2,minmax(0,1fr));

        gap:10px;

        align-items:stretch;
    }

    .ticket-card{

        background:#faf8ff;

        border:1px solid #ececec;

        border-radius:12px;

        padding:9px;

        min-height:66px;

        display:flex;

        flex-direction:column;

        justify-content:center;
    }

    .full{
        grid-column:span 2;
    }

    .label{

        font-size:7px;

        font-weight:700;

        color:#8b8b8b;

        text-transform:uppercase;

        letter-spacing:.4px;

        margin-bottom:4px;
    }

    .value{

        font-size:10px;

        font-weight:800;

        color:#2d2d2d;

        line-height:1.3;

        overflow:hidden;

        text-overflow:ellipsis;
    }

    /* =========================
       FOOTER
    ========================= */

    .ticket-footer{

        margin-top:12px;

        background:#fafafa;

        border:1px dashed #ddd;

        border-radius:10px;

        padding:9px;

        text-align:center;

        color:#777;

        font-size:8px;

        line-height:1.5;
    }

    /* =========================
       BUTTON
    ========================= */

    .button-group{

        display:flex;

        gap:8px;

        margin-top:12px;
    }

    .btn-ticket{

        flex:1;

        border:none;

        border-radius:10px;

        padding:9px;

        font-size:9px;

        font-weight:800;

        cursor:pointer;

        transition:.2s;
    }

    .btn-ticket:hover{
        transform:translateY(-1px);
    }

    .btn-print{

        background:
            linear-gradient(
                135deg,
                #6f42c1,
                #9b6dff
            );

        color:#fff;
    }

    .btn-close-ticket{

        background:#efefef;

        color:#333;
    }

    /* =========================
       MOBILE
    ========================= */

    @media(max-width:768px){

        body{
            padding:4px;
        }

        .ticket-popup{

            max-width:100%;

            border-radius:14px;
        }

        .ticket-body{
            padding:12px;
        }

        .top-section{

            flex-direction:column;

            text-align:center;

            gap:12px;
        }

        .ticket-grid{
            grid-template-columns:1fr 1fr;
            gap:8px;
        }

        .full{
            grid-column:span 2;
        }

        .button-group{
            flex-direction:column;
        }

        .qr-box{

            width:155px;
            height:155px;
        }

        .qr-box svg{

            width:72px !important;
            height:72px !important;
        }

        .ticket-header h1{
            font-size:15px;
        }

        .ticket-ready{
            font-size:13px;
        }

        .ticket-desc{
            font-size:8px;
        }

        .value{
            font-size:9px;
        }
    }

    /* =========================
       PRINT
    ========================= */

    @media print{

        @page{
            size:A4 portrait;
            margin:3mm;
        }

        body{

            background:#fff !important;

            padding:0 !important;

            zoom:100%;
        }

        .ticket-popup{

            width:165mm !important;

            margin:auto !important;

            box-shadow:none !important;

            border-radius:0 !important;
        }

        .btn-close-ticket,
        .btn-print{
            display:none !important;
        }
    }

</style>

</head>
<body>

<div class="ticket-popup">

    {{-- HEADER --}}
    <div class="ticket-header">

        <h1>E-Tiket Wisata</h1>

        <p>
            THR Kramat Batang
        </p>

        <div class="ticket-code">
            {{ $pemesanan->kode_transaksi }}
        </div>

    </div>

    {{-- BODY --}}
    <div class="ticket-body">

        <div class="top-section">

            {{-- QR --}}
            <div class="qr-area">

                <div class="qr-box">

                    {!! QrCode::size(180)->generate(url('/petugas/pemesanan/' . $pemesanan->kode_qr)) !!}

                </div>

                <div class="qr-text">
                    Scan QR Code untuk validasi tiket wisata
                </div>

            </div>

            {{-- INFO --}}
            <div class="info-panel">

                <div class="ticket-ready">
                    Tiket Siap Digunakan
                </div>

                <div class="ticket-desc">

                    Tunjukkan QR Code kepada petugas saat memasuki area wisata.
                    Tiket hanya berlaku satu kali penggunaan.

                </div>

                <div class="status">
                    Pembayaran Berhasil
                </div>

            </div>

        </div>

        {{-- GRID --}}
        <div class="ticket-grid">

            <div class="ticket-card">

                <div class="label">
                    Nama Pemesan
                </div>

                <div class="value">
                    {{ $pemesanan->user->name }}
                </div>

            </div>

            <div class="ticket-card">

                <div class="label">
                    Nama Tiket
                </div>

                <div class="value">
                    {{ $pemesanan->tiket->nama_tiket }}
                </div>

            </div>

            <div class="ticket-card">

                <div class="label">
                    Jumlah Tiket
                </div>

                <div class="value">
                    {{ $pemesanan->jumlah_tiket }} Tiket
                </div>

            </div>

            <div class="ticket-card">

                <div class="label">
                    Total Pembayaran
                </div>

                <div class="value">
                    Rp{{ number_format($pemesanan->total_harga,0,',','.') }}
                </div>

            </div>

            <div class="ticket-card full">

                <div class="label">
                    Tanggal Kunjungan
                </div>

                <div class="value">
                    {{ \Carbon\Carbon::parse($pemesanan->tanggal_kunjungan)->translatedFormat('d F Y') }}
                </div>

            </div>

        </div>

        {{-- FOOTER --}}
        <div class="ticket-footer">

            E-Tiket ini valid dan hanya dapat digunakan satu kali.
            Simpan tiket ini dan tunjukkan kepada petugas saat memasuki area wisata.

        </div>

        {{-- BUTTON --}}
        <div class="button-group">

            <button
                onclick="window.print()"
                class="btn-ticket btn-print">

                Cetak / Simpan PDF

            </button>

        </div>

    </div>

</div>

</body>
</html>