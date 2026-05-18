@extends('user.layout.user')

@section('content')

<style>

/* =========================
   BODY
========================= */

body{
    background:
        linear-gradient(
            135deg,
            #f3f0ff,
            #ffffff
        );
}

/* =========================
   WRAPPER
========================= */

.history-wrapper{

    min-height:100vh;

    padding:35px 15px;
}

/* =========================
   CONTAINER
========================= */

.history-container{

    width:100%;

    max-width:1250px;

    margin:auto;

    background:#fff;

    border-radius:28px;

    padding:30px;

    box-shadow:
        0 15px 40px rgba(111,66,193,.08);
}

/* =========================
   TITLE
========================= */

.page-title{

    text-align:center;

    margin-bottom:30px;
}

.page-title h2{

    font-size:2rem;

    font-weight:800;

    color:#6f42c1;

    margin-bottom:8px;
}

.page-title p{

    color:#777;

    font-size:.95rem;
}

/* =========================
   ALERT
========================= */

.alert{

    border:none;

    border-radius:16px;

    padding:16px 18px;

    font-weight:500;
}

.alert-success{
    background:#eafaf0;
    color:#18a957;
}

.alert-danger{
    background:#ffeaea;
    color:#dc3545;
}

.alert-info{
    background:#eef4ff;
    color:#355;
}

/* =========================
   TABLE WRAPPER
========================= */

.table-wrapper{
    overflow-x:auto;
}

/* =========================
   TABLE
========================= */

.table{

    width:100%;

    border-collapse:separate;

    border-spacing:0 14px;
}

.table thead th{

    background:
        linear-gradient(
            135deg,
            #6f42c1,
            #9b6dff
        );

    color:#fff;

    border:none;

    padding:16px 14px;

    font-size:.9rem;

    font-weight:700;

    text-align:center;
}

.table thead th:first-child{
    border-radius:16px 0 0 16px;
}

.table thead th:last-child{
    border-radius:0 16px 16px 0;
}

.table tbody tr{

    background:#fff;
    color:#2d2d2d;

    box-shadow:
        0 6px 18px rgba(0,0,0,.05);

    transition:.3s;
}

.table tbody tr:hover{

    transform:translateY(-2px);

    box-shadow:
        0 10px 22px rgba(0,0,0,.08);
}

.table td{

    padding:18px 14px;

    text-align:center;

    vertical-align:middle;

    border:none;

    font-size:.92rem;
    color:#2d2d2d !important;

    font-weight:600;
}

.table tbody td:first-child{
    border-radius:18px 0 0 18px;
}

.table tbody td:last-child{
    border-radius:0 18px 18px 0;
}

/* =========================
   BADGE
========================= */

.badge{

    padding:9px 14px;

    border-radius:999px;

    font-size:.78rem;

    font-weight:700;

    letter-spacing:.3px;
}

/* =========================
   BUTTON
========================= */

.btn{

    border:none !important;

    border-radius:14px !important;

    padding:10px 16px !important;

    font-size:.84rem !important;

    font-weight:700 !important;

    transition:.25s;
}

.btn:hover{
    transform:translateY(-2px);
}

.btn-primary{

    background:
        linear-gradient(
            135deg,
            #6f42c1,
            #9b6dff
        ) !important;
}

.btn-warning{
    background:#ffc107 !important;
}

.btn-download{

    display:inline-flex;

    justify-content:center;

    align-items:center;

    gap:8px;

    background:
        linear-gradient(
            135deg,
            #6f42c1,
            #9b6dff
        );

    color:#fff;

    text-decoration:none;

    padding:11px 16px;

    border-radius:14px;

    font-size:.82rem;

    font-weight:700;

    transition:.25s;
}

.btn-download:hover{

    transform:translateY(-2px);

    color:#fff;
}

/* =========================
   QR
========================= */

.qr-box{

    display:inline-flex;

    justify-content:center;

    align-items:center;

    padding:10px;

    border-radius:18px;

    background:#fff;

    border:1px solid #eee;

    box-shadow:
        0 6px 16px rgba(0,0,0,.05);
}

/* =========================
   PAYMENT SUCCESS
========================= */

.payment-success{

    color:#18a957;

    font-weight:700;

    margin-bottom:4px;
}

/* =========================
   MODAL
========================= */

.modal-content{

    border:none !important;

    border-radius:24px !important;

    overflow:hidden;
}

#ticketFrame{

    width:100%;

    height:650px;

    border:none;

    background:#fff;
}

/* =========================
   MOBILE
========================= */

@media(max-width:768px){

    .history-wrapper{
        padding:20px 10px;
    }

    .history-container{

        padding:20px 15px;

        border-radius:22px;
    }

    .page-title h2{
        font-size:1.5rem;
    }

    .table{
        border-spacing:0 16px;
    }

    .table thead{
        display:none;
    }

    .table,
    .table tbody,
    .table tr,
    .table td{
        display:block;
        width:100%;
    }

    .table tr{

        border-radius:20px;

        overflow:hidden;

        padding:10px 0;
    }

    .table td{

        text-align:right;

        padding:14px 18px 14px 50%;

        position:relative;

        border-bottom:1px solid #f3f3f3;
    }

    .table td:last-child{
        border-bottom:none;
    }

    .table td::before{

        content:attr(data-label);

        position:absolute;

        left:18px;

        top:14px;

        font-weight:700;

        color:#6f42c1;

        text-align:left;
    }

    .table tbody td:first-child,
    .table tbody td:last-child{
        border-radius:0;
    }

    .btn,
    .btn-download{
        width:100%;
    }

    .qr-box svg{

        width:85px !important;
        height:85px !important;
    }

    #ticketFrame{
        height:620px;
    }

    .table td::before{

    content:attr(data-label);

    position:absolute;

    left:18px;

    top:14px;

    font-weight:700;

    color:#6f42c1 !important;

    text-align:left;
}

}

</style>

<div class="history-wrapper">

    <div class="history-container">

        {{-- TITLE --}}
        <div class="page-title">

            <h2>Riwayat Pemesanan Tiket</h2>

            <p>
                Semua tiket wisata yang pernah kamu pesan akan tampil di sini.
            </p>

        </div>

        {{-- FLASH --}}
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

        <div class="table-wrapper">

            <table class="table">

                <thead>

                    <tr>

                        <th>Kode</th>
                        <th>Tiket</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Tanggal</th>
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

                        <td data-label="Total">
                            Rp{{ number_format($item->total_harga,0,',','.') }}
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

                                <span class="badge bg-primary text-white">
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

                            @endif

                        </td>

                        <td data-label="Aksi">

                            {{-- MENUNGGU --}}
                            @if($item->status == 'menunggu')

                                @if($item->snap_token)

                                    <button
                                        class="btn btn-primary btn-sm pay-button"
                                        data-token="{{ $item->snap_token }}">

                                        Bayar Sekarang

                                    </button>

                                @else

                                    <a href="{{ route('user.pemesanan.bayar', $item->id) }}"
                                       class="btn btn-warning btn-sm">

                                        Buat Pembayaran

                                    </a>

                                @endif

                            {{-- DIBAYAR --}}
                            @elseif($item->status == 'dibayar')

                                <div class="payment-success">
                                    Pembayaran Berhasil
                                </div>

                                <small class="text-muted">
                                    Tiket aktif dalam 30 detik...
                                </small>

                                <script>
                                    setTimeout(function () {
                                        location.reload();
                                    }, 30000);
                                </script>

                            {{-- SELESAI --}}
                            @elseif($item->status == 'selesai')

                                @if($item->kode_qr)

                                    <div class="qr-box mb-2">

                                        {!! QrCode::size(85)->generate(url('/petugas/pemesanan/' . $item->kode_qr)) !!}

                                    </div>

                                    <br>

                                    <button
                                        type="button"
                                        class="btn-download open-ticket"
                                        data-url="{{ route('user.tiket.download', $item->id) }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#ticketModal">

                                        Download E-Tiket

                                    </button>

                                @else

                                    <span class="text-danger">
                                        QR belum tersedia
                                    </span>

                                @endif

                            {{-- TERPAKAI --}}
                            @elseif($item->status == 'tiket terpakai')

                                <span class="text-danger fw-bold">
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

        </div>

        @endif

    </div>

</div>

{{-- MODAL --}}
<div
    class="modal fade"
    id="ticketModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <button
                type="button"
                class="btn-close position-absolute end-0 m-3"
                data-bs-dismiss="modal"
                style="z-index:10;">
            </button>

            <iframe
                id="ticketFrame"
                src="">
            </iframe>

        </div>

    </div>

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

<script>

document.querySelectorAll('.open-ticket').forEach(button => {

    button.addEventListener('click', function () {

        let url = this.dataset.url;

        document.getElementById('ticketFrame').src = url;

    });

});

document.getElementById('ticketModal')
.addEventListener('hidden.bs.modal', function () {

    document.getElementById('ticketFrame').src = '';

});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection