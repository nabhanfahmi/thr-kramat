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

.payment-wrapper{

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    padding:35px 15px;
}

/* =========================
   CARD
========================= */

.payment-card{

    width:100%;

    max-width:760px;

    background:#fff;

    border-radius:30px;

    padding:35px;

    box-shadow:
        0 15px 40px rgba(111,66,193,.10);

    position:relative;

    overflow:hidden;
}

.payment-card::before{

    content:"";

    position:absolute;

    width:240px;
    height:240px;

    background:
        linear-gradient(
            135deg,
            rgba(111,66,193,.12),
            rgba(155,109,255,.06)
        );

    border-radius:50%;

    top:-100px;
    right:-100px;
}

/* =========================
   TITLE
========================= */

.payment-title{

    text-align:center;

    margin-bottom:30px;

    position:relative;

    z-index:2;
}

.payment-title h2{

    font-size:2rem;

    font-weight:800;

    color:#6f42c1;

    margin-bottom:8px;
}

.payment-title p{

    color:#777;

    font-size:.95rem;
}

/* =========================
   ALERT
========================= */

.alert{

    border:none;

    border-radius:16px;

    padding:14px 18px;

    font-weight:600;

    position:relative;

    z-index:2;
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
   TABLE
========================= */

.payment-table{

    width:100%;

    border-collapse:separate;

    border-spacing:0 14px;

    position:relative;

    z-index:2;
}

.payment-table tr{

    background:#fff;

    box-shadow:
        0 5px 14px rgba(0,0,0,.04);

    transition:.25s;
}

.payment-table tr:hover{

    transform:translateY(-2px);

    box-shadow:
        0 10px 20px rgba(0,0,0,.06);
}

.payment-table th{

    width:35%;

    background:
        linear-gradient(
            135deg,
            #6f42c1,
            #9b6dff
        );

    color:#fff;

    padding:16px;

    border:none;

    border-radius:16px 0 0 16px;

    font-size:.92rem;

    font-weight:700;
}

.payment-table td{

    padding:16px;

    background:#faf8ff;

    border:none;

    border-radius:0 16px 16px 0;

    color:#333;

    font-weight:600;
}

/* =========================
   PRICE
========================= */

.total-price{

    color:#18a957;

    font-size:1.05rem;

    font-weight:800;
}

/* =========================
   BADGE
========================= */

.badge{

    padding:8px 14px;

    border-radius:999px;

    font-size:.8rem;

    font-weight:700;
}

/* =========================
   BUTTONS
========================= */

.button-group{

    margin-top:35px;

    display:flex;

    justify-content:center;

    gap:16px;

    flex-wrap:wrap;

    position:relative;

    z-index:2;
}

.btn-payment{

    border:none;

    padding:14px 24px;

    border-radius:16px;

    font-weight:700;

    font-size:.95rem;

    transition:.25s;

    text-decoration:none;
}

.btn-payment:hover{

    transform:translateY(-2px);
}

.btn-pay{

    background:
        linear-gradient(
            135deg,
            #6f42c1,
            #9b6dff
        );

    color:#fff;
}

.btn-pay:hover{

    color:#fff;

    box-shadow:
        0 12px 24px rgba(111,66,193,.20);
}

.btn-later{

    background:#f1f1f1;

    color:#444;
}

.btn-later:hover{

    background:#e5e5e5;

    color:#222;
}

/* =========================
   MOBILE
========================= */

@media(max-width:768px){

    .payment-card{

        padding:25px 18px;

        border-radius:24px;
    }

    .payment-title h2{
        font-size:1.6rem;
    }

    .payment-table,
    .payment-table tbody,
    .payment-table tr,
    .payment-table th,
    .payment-table td{

        display:block;

        width:100%;
    }

    .payment-table tr{

        margin-bottom:18px;

        border-radius:18px;

        overflow:hidden;
    }

    .payment-table th{

        border-radius:18px 18px 0 0;

        text-align:left;
    }

    .payment-table td{

        border-radius:0 0 18px 18px;

        text-align:left;
    }

    .button-group{

        flex-direction:column;
    }

    .btn-payment{
        width:100%;
    }
}

</style>

<div class="payment-wrapper">

    <div class="payment-card">

        {{-- TITLE --}}
        <div class="payment-title">

            <h2>
                Konfirmasi Pembayaran
            </h2>

            <p>
                Pastikan detail pemesanan tiket wisata sudah benar.
            </p>

        </div>

        {{-- ALERT --}}
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

        {{-- TABLE --}}
        <table class="payment-table">

            <tr>
                <th>Kode Transaksi</th>
                <td>{{ $pemesanans->kode_transaksi }}</td>
            </tr>

            <tr>
                <th>Nama Tiket</th>
                <td>{{ $pemesanans->tiket->nama_tiket ?? '-' }}</td>
            </tr>

            <tr>
                <th>Jumlah Tiket</th>
                <td>{{ $pemesanans->jumlah_tiket }}</td>
            </tr>

            <tr>
                <th>Tanggal Kunjungan</th>
                <td>
                    {{ \Carbon\Carbon::parse($pemesanans->tanggal_kunjungan)->translatedFormat('d F Y') }}
                </td>
            </tr>

            <tr>
                <th>Total Harga</th>
                <td>
                    <span class="total-price">
                        Rp{{ number_format($pemesanans->total_harga, 0, ',', '.') }}
                    </span>
                </td>
            </tr>

            <tr>
                <th>Status</th>

                <td>

                    @if($pemesanans->status == 'menunggu')

                        <span class="badge bg-warning text-dark">
                            Menunggu Pembayaran
                        </span>

                    @elseif($pemesanans->status == 'dibayar')

                        <span class="badge bg-success">
                            Sudah Dibayar
                        </span>

                    @elseif($pemesanans->status == 'batal')

                        <span class="badge bg-danger">
                            Dibatalkan
                        </span>

                    @else

                        <span class="badge bg-secondary">
                            {{ ucfirst($pemesanans->status) }}
                        </span>

                    @endif

                </td>

            </tr>

        </table>

        {{-- BUTTON --}}
        @if($pemesanans->status == 'menunggu')

            <div class="button-group">

                <button
                    id="pay-button"
                    class="btn-payment btn-pay">

                    Bayar Sekarang

                </button>

                <a
                    href="{{ route('user.pemesanan.index') }}"
                    class="btn-payment btn-later">

                    Nanti Saja

                </a>

            </div>

        @else

            <div class="alert alert-info text-center mt-4">
                Pembayaran sudah diproses.
            </div>

        @endif

    </div>

</div>

{{-- Midtrans Snap --}}
<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.clientKey') }}">
</script>

<script type="text/javascript">

const payButton = document.getElementById('pay-button');

if (payButton) {

    payButton.addEventListener('click', function () {

        snap.pay('{{ $snapToken }}', {

            onSuccess: function(result) {

                alert("Pembayaran berhasil!");

                console.log(result);

                window.location.href =
                    "{{ route('user.pemesanan.index') }}";
            },

            onPending: function(result) {

                alert("Menunggu pembayaran!");

                console.log(result);

                window.location.href =
                    "{{ route('user.pemesanan.index') }}";
            },

            onError: function(result) {

                alert("Pembayaran gagal!");

                console.log(result);
            },

            onClose: function() {

                alert('Pembayaran belum diselesaikan.');

                window.location.href =
                    "{{ route('user.pemesanan.index') }}";
            }

        });

    });

}

</script>

@endsection