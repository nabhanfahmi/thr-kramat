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

    padding:30px 15px;
}

/* =========================
   CARD
========================= */

.payment-card{

    width:100%;

    max-width:600px;

    background:#fff;

    border-radius:30px;

    padding:40px 35px;

    box-shadow:
        0 15px 40px rgba(111,66,193,.10);

    position:relative;

    overflow:hidden;

    text-align:center;
}

.payment-card::before{

    content:"";

    position:absolute;

    width:240px;
    height:240px;

    border-radius:50%;

    background:
        linear-gradient(
            135deg,
            rgba(111,66,193,.12),
            rgba(155,109,255,.05)
        );

    top:-100px;
    right:-100px;
}

/* =========================
   ICON
========================= */

.payment-icon{

    width:90px;
    height:90px;

    margin:0 auto 20px;

    border-radius:50%;

    display:flex;

    justify-content:center;

    align-items:center;

    background:
        linear-gradient(
            135deg,
            #6f42c1,
            #9b6dff
        );

    color:#fff;

    font-size:2rem;

    font-weight:800;

    position:relative;

    z-index:2;
}

/* =========================
   TITLE
========================= */

.payment-title{

    position:relative;

    z-index:2;
}

.payment-title h3{

    font-size:2rem;

    font-weight:800;

    color:#6f42c1;

    margin-bottom:10px;
}

.payment-title p{

    color:#777;

    font-size:.95rem;

    margin-bottom:30px;
}

/* =========================
   TOTAL
========================= */

.total-box{

    background:#faf8ff;

    border:1px solid #ece8ff;

    border-radius:22px;

    padding:24px;

    margin-bottom:30px;

    position:relative;

    z-index:2;
}

.total-label{

    font-size:.9rem;

    color:#777;

    margin-bottom:8px;
}

.total-price{

    font-size:2rem;

    font-weight:800;

    color:#18a957;
}

/* =========================
   ALERT
========================= */

.alert{

    border:none;

    border-radius:18px;

    padding:16px;

    font-weight:600;

    position:relative;

    z-index:2;
}

.alert-danger{

    background:#ffeaea;

    color:#dc3545;
}

/* =========================
   BUTTON
========================= */

.btn-payment{

    width:100%;

    border:none;

    border-radius:18px;

    padding:15px;

    font-size:1rem;

    font-weight:700;

    color:#fff;

    background:
        linear-gradient(
            135deg,
            #6f42c1,
            #9b6dff
        );

    transition:.25s;

    position:relative;

    z-index:2;
}

.btn-payment:hover{

    transform:translateY(-2px);

    box-shadow:
        0 12px 24px rgba(111,66,193,.20);
}

/* =========================
   MOBILE
========================= */

@media(max-width:768px){

    .payment-card{

        padding:30px 22px;

        border-radius:24px;
    }

    .payment-title h3{
        font-size:1.6rem;
    }

    .total-price{
        font-size:1.6rem;
    }
}

</style>

<div class="payment-wrapper">

    <div class="payment-card">

        {{-- ICON --}}
        <div class="payment-icon">
            Rp
        </div>

        {{-- TITLE --}}
        <div class="payment-title">

            <h3>
                Selesaikan Pembayaran
            </h3>

            <p>
                Lanjutkan pembayaran tiket wisata kamu dengan aman.
            </p>

        </div>

        {{-- TOTAL --}}
        <div class="total-box">

            <div class="total-label">
                Total Pembayaran
            </div>

            <div class="total-price">
                Rp{{ number_format($pemesanans->total_harga, 0, ',', '.') }}
            </div>

        </div>

        {{-- ALERT --}}
        @if (!$snapToken)

            <div class="alert alert-danger">

                Token pembayaran tidak tersedia.
                Silakan coba lagi nanti atau hubungi admin.

            </div>

        @else

            <button
                id="pay-button"
                class="btn-payment">

                Bayar Sekarang

            </button>

        @endif

    </div>

</div>

{{-- Snap.js Midtrans --}}
<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.client_Key') }}">
</script>

<script type="text/javascript">

document.getElementById('pay-button')
.addEventListener('click', function () {

    snap.pay('{{ $snapToken }}', {

        onSuccess: function(result){

            alert("Pembayaran berhasil!");

            window.location.href =
                "{{ route('user.pemesanan.index') }}";
        },

        onPending: function(result){

            alert("Menunggu pembayaran.");

            window.location.href =
                "{{ route('user.pemesanan.index') }}";
        },

        onError: function(result){

            alert("Pembayaran gagal.");

            console.error(result);
        },

        onClose: function(){

            alert(
                "Kamu menutup popup tanpa menyelesaikan pembayaran"
            );
        }

    });

});

</script>

@endsection