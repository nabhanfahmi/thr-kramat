@extends('user.layout.user')

@section('content')

<style>

/* =========================
   BODY
========================= */

body{
    background:#f5f5fa;
}

/* =========================
   CONTAINER
========================= */

.container{
    background:#fff;
    padding:30px;
    border-radius:18px;
    box-shadow:0 6px 20px rgba(0,0,0,.08);
}

/* =========================
   TITLE
========================= */

h2{
    font-weight:800;
    color:#6f42c1;
    text-align:center;
    margin-bottom:30px;
}

/* =========================
   TABLE
========================= */

.table{
    width:100%;
    border-collapse:collapse;
    overflow:hidden;
}

.table thead{
    background:#6f42c1;
    color:#fff;
}

.table th,
.table td{
    padding:14px 12px;
    border:1px solid #e9e9e9;
    text-align:center;
    vertical-align:middle;
    font-size:.93rem;
}

/* =========================
   BADGE
========================= */

.badge{
    padding:7px 12px;
    border-radius:10px;
    font-size:.8rem;
    font-weight:700;
}

/* =========================
   BUTTON
========================= */

.btn{
    border-radius:10px !important;
    font-size:.85rem !important;
    font-weight:600;
    padding:8px 14px !important;
}

.btn-primary{
    background:#6f42c1 !important;
    border:none !important;
}

.btn-primary:hover{
    background:#5b35a0 !important;
}

.btn-warning{
    border:none !important;
}

.btn-download{
    display:inline-block;
    margin-top:10px;
    background:linear-gradient(135deg,#6f42c1,#9b6dff);
    color:#fff;
    text-decoration:none;
    padding:9px 14px;
    border-radius:12px;
    font-size:.82rem;
    font-weight:700;
    transition:.2s;
}

.btn-download:hover{
    transform:translateY(-2px);
    color:#fff;
}

/* =========================
   QR
========================= */

.qr-box{
    display:inline-block;
    padding:8px;
    background:#fff;
    border-radius:12px;
    border:1px solid #eee;
    box-shadow:0 4px 12px rgba(0,0,0,.05);
}

/* =========================
   ALERT
========================= */

.alert{
    border:none;
    border-radius:12px;
    padding:14px 18px;
}

.alert-info{
    background:#eef4ff;
    color:#345;
}

/* =========================
   MOBILE
========================= */

@media(max-width:768px){

    .container{
        padding:18px;
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
        margin-bottom:16px;
        border:1px solid #eee;
        border-radius:14px;
        overflow:hidden;
        background:#fff;
    }

    .table td{
        text-align:right;
        padding-left:50%;
        position:relative;
        border-bottom:1px solid #f1f1f1;
    }

    .table td:last-child{
        border-bottom:none;
    }

    .table td::before{
        content:attr(data-label);
        position:absolute;
        left:14px;
        top:14px;
        font-weight:700;
        color:#6f42c1;
        text-align:left;
    }

    .btn,
    .btn-download{
        width:100%;
    }

    .qr-box svg{
        width:90px !important;
        height:90px !important;
    }
}

</style>

<div class="container mt-5">

    <h2>Riwayat Pemesanan Tiket</h2>

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

                                        Bayar

                                    </button>

                                @else

                                    <a href="{{ route('user.pemesanan.bayar', $item->id) }}"
                                       class="btn btn-warning btn-sm">

                                        Buat Pembayaran

                                    </a>

                                @endif

                            {{-- DIBAYAR --}}
                            @elseif($item->status == 'dibayar')

                                <div class="text-success fw-bold mb-1">
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

                                        {!! QrCode::size(80)->generate(url('/petugas/pemesanan/' . $item->kode_qr)) !!}

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

    @endif

    {{-- MODAL E-TIKET --}}
<div
    class="modal fade"
    id="ticketModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div
            class="modal-content"
            style="
                border:none;
                border-radius:22px;
                overflow:hidden;
            ">

            {{-- CLOSE --}}
            <button
                type="button"
                class="btn-close position-absolute end-0 m-3"
                data-bs-dismiss="modal"
                style="z-index:10;">
            </button>

            {{-- CONTENT --}}
            <iframe
                id="ticketFrame"
                src=""
                width="100%"
                height="620"
                style="
                    border:none;
                    background:#fff;
                ">
            </iframe>

        </div>

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


// RESET iframe saat modal ditutup
document.getElementById('ticketModal')
.addEventListener('hidden.bs.modal', function () {

    document.getElementById('ticketFrame').src = '';

});

</script>

{{-- BOOTSTRAP JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection